<?php

namespace NextDeveloper\Commons\Services;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\File as HttpFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\CDN\Publitio;
use NextDeveloper\Commons\Common\Enums\GenericErrorCodes;
use NextDeveloper\Commons\Database\Filters\MediaQueryFilter;
use NextDeveloper\Commons\Database\Models\Media;
use NextDeveloper\Commons\Exceptions\CannotCreateModelException;
use NextDeveloper\Commons\Helpers\ObjectHelper;
use NextDeveloper\Commons\Services\AbstractServices\AbstractMediaService;
use Publitio\BadJSONResponse;

/**
 * This class is responsible from managing the data for Media
 *
 * Class MediaService.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class MediaService extends AbstractMediaService
{

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
    public static function get(?MediaQueryFilter $filter = null, array $params = []): \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return parent::get($filter, $params);
    }

    /**
     * This method creates a new media. It also uploads the file to the CDN.
     * When any other CDN is selected, it will be uploaded to local storage.
     *
     *
     * @param array $data
     * @return mixed
     * @throws BadJSONResponse
     * @throws \Exception
     */
    public static function create(array $data): mixed
    {
        $data = self::resolveObject($data);

        //  A file that already has an address is registered, not uploaded: the row points at it.
        if (!isset($data['file']) && !empty($data['cdn_url'])) {
            unset($data['storage']);

            $data['file_name'] = $data['file_name'] ?? basename((string) parse_url($data['cdn_url'], PHP_URL_PATH));
            $data['custom_properties'] = array_merge((array) ($data['custom_properties'] ?? []), ['source' => 'url']);

            return parent::create($data);
        }

        $data = self::processMediaUploadData($data);

        // A caller may pin a single upload to a specific storage target, regardless of the CDN the
        // rest of the application uses. This is how files that may not leave our own infrastructure
        // (identity documents and other personal data) stay off the public CDN.
        $storage = (string) ($data['storage'] ?? config('commons.cdn.default'));
        unset($data['storage']);

        switch ($storage) {
            case 'publitio':
                $uploadMedia = Publitio::upload($data['file']);
                break;
            case 'local':
            case '':
                $uploadMedia = self::saveToLocalStorage($data['file']);
                break;
            default:
                //  Any other value is the name of a disk in config/filesystems.php. If no such disk
                //  is configured we keep the old behaviour and fall back to local storage.
                $uploadMedia = config('filesystems.disks.' . $storage)
                    ? self::saveToDisk($data['file'], $storage)
                    : self::saveToLocalStorage($data['file']);
                break;
        }

        $data = array_merge($data, $uploadMedia);
        unset($data['file']);

        return parent::create($data);
    }

    /**
     * A file uploaded before the record it belongs to exists is attached afterwards by updating
     * object_type and object_id, which arrive in the API's form and are translated here.
     */
    public static function update($id, array $data)
    {
        return parent::update($id, self::resolveObject($data));
    }

    /**
     * The record a file belongs to arrives as object_type - the model class, or its public
     * Vendor\Package\Model form - and the record's uuid; the columns hold the model class and the
     * internal id. The caller must be able to see the record. object_id null detaches the file.
     *
     * An integer object_id from an internal caller is stored as given.
     *
     * @param array $data
     * @return array
     */
    protected static function resolveObject(array $data): array
    {
        if (!array_key_exists('object_id', $data) && !array_key_exists('object_type', $data)) {
            return $data;
        }

        if (array_key_exists('object_id', $data) && $data['object_id'] === null) {
            $data['object_type'] = null;

            return $data;
        }

        if (isset($data['object_id']) && is_int($data['object_id'])) {
            return $data;
        }

        $class = ObjectHelper::getModelClass($data['object_type'] ?? null);

        if (!$class) {
            self::refuse('object_type', 'object_type must name a model, for example NextDeveloper\\Support\\Tickets.');
        }

        if (!isset($data['object_id']) || !is_string($data['object_id']) || !Str::isUuid($data['object_id'])) {
            self::refuse('object_id', 'object_id must be the uuid of the record the file belongs to.');
        }

        $object = $class::where('uuid', $data['object_id'])->first();

        if (!$object) {
            self::refuse('object_id', 'object_id must be the id of an existing record you can see.');
        }

        $data['object_type'] = $class;
        $data['object_id'] = $object->id;

        return $data;
    }

    private static function refuse(string $field, string $message): never
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation failed. Please fix the values you are providing and try again.',
            'code' => GenericErrorCodes::VALIDATION_FAILED,
            'errors' => [$field => [$message]],
        ], 422));
    }

    /**
     * Stores the file on the given Laravel filesystem disk as a private object and returns the
     * media columns describing it.
     *
     * Files stored this way have no public URL at all: the object key is kept in
     * custom_properties.path and the file can only be read back by streaming it through an
     * endpoint that authorises the reader. The key is a random uuid because the original file
     * name of a personal document is itself personal data.
     *
     * @param string $file Absolute path of the temporary, already uploaded file
     * @param string $disk Name of the disk in config/filesystems.php
     * @return array
     */
    #[ArrayShape(['cdn_url' => "null", 'disk' => "string", 'size' => "int", 'mime_type' => "false|string", 'custom_properties' => "array"])]
    protected static function saveToDisk(string $file, string $disk): array
    {
        $directory  = trim(config('commons.local.directory', 'media'), '/');
        $extension  = File::extension($file);
        $objectName = Str::uuid()->toString() . ($extension ? '.' . $extension : '');
        $objectPath = $directory . '/' . $objectName;

        $size       = File::size($file);
        $mimeType   = File::mimeType($file);
        $type       = File::type($file);

        Storage::disk($disk)->putFileAs($directory, new HttpFile($file), $objectName, 'private');

        // The temporary copy holds personal data in clear text, it may not stay on the server
        if (file_exists($file)) {
            @unlink($file);
        }

        return [
            'cdn_url' => null,
            'disk' => $disk,
            'size' => $size,
            'mime_type' => $mimeType,
            'custom_properties' => [
                'id'            => $objectPath,
                'public_id'     => $objectPath,
                'path'          => $objectPath,
                'type'          => $type,
                'extension'     => $extension,
                'privacy'       => 'private',
                'created_at'    => now(),
            ],
        ];
    }


    /**
     * This model prepares the data to be stored in the database.
     * When local storage is used, the file is stored in the local storage and the file path is returned.
     *
     * @param string $file
     * @return array
     */
    #[ArrayShape(['cdn_url' => "string", 'disk' => "string", 'size' => "int", 'mime_type' => "false|string", 'custom_properties' => "array"])]
    protected static function saveToLocalStorage(string $file): array
    {
        $localDisk      = config('commons.local.disk');
        $localDirectory = config('commons.local.directory');

        if (!Storage::disk($localDisk)->exists($localDirectory)) {
            Storage::disk($localDisk)->makeDirectory($localDirectory);
        }

        $localFile = Storage::disk($localDisk)->putFile($localDirectory, $file);

        $size       = File::size($file);
        $mimeType   = File::mimeType($file);
        $type       = File::type($file);
        $extension  = File::extension($file);

        //  The upload's temporary copy has been stored; left behind it would pile up on the local disk.
        if (Str::startsWith($file, Storage::disk('local')->path('tmp'))) {
            @unlink($file);
        }

        return [
            'cdn_url' => URL::to(Storage::url($localFile)),
            'disk' => 'public',
            'size' => $size,
            'mime_type' => $mimeType,
            'custom_properties' => [
                'id'            => $localFile,
                'public_id'     => $localFile,
                'type'          => $type,
                'extension'     => $extension,
                'privacy'       => 'public',
                'download_url'  => URL::to(Storage::url($localFile)),
                'created_at'    => now(),
            ],
        ];
    }

    /**
     * Prepares data to be stored in the database.
     *
     * @param array $data
     * @return array
     * @throws CannotCreateModelException
     */
    protected static function processMediaUploadData(array $data): array
    {

        if (!isset($data['file'])) {
            throw new CannotCreateModelException('File field is required');
        }

        // check if is already an url
        if (filter_var($data['file'], FILTER_VALIDATE_URL)) {
            // check file name from url
            $fileName = basename($data['file']);
            $data['file_name'] = $fileName;
            return $data;
        }

        // a file the application already wrote to its own disk
        if (is_string($data['file'])) {
            if (!is_file($data['file'])) {
                throw new CannotCreateModelException('File field is required');
            }

            $data['file_name'] = $data['file_name'] ?? basename($data['file']);

            return $data;
        }

        $file       = $data['file'];
        $fileName   = $file->getClientOriginalName();

        //  Stored on the local disk and read back through that disk's own root: since Laravel 11
        //  the local disk lives in storage/app/private, and assuming storage/app made every upload
        //  fail with "file does not exist".
        $uploadToLocalStore = $file->store('tmp', ['disk' => 'local']);
        $data['file']       = Storage::disk('local')->path($uploadToLocalStore);
        $data['file_name']  = $fileName;

        return $data;
    }
}
