<?php

namespace NextDeveloper\Commons\Services;

use Illuminate\Http\File as HttpFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;
use NextDeveloper\Commons\CDN\Publitio;
use NextDeveloper\Commons\Database\Filters\MediaQueryFilter;
use NextDeveloper\Commons\Database\Models\Media;
use NextDeveloper\Commons\Exceptions\CannotCreateModelException;
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
    public static function get(MediaQueryFilter $filter = null, array $params = []): \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $items = parent::get($filter, $params);

        $media = Media::orderBy('id', 'desc')->get();

        $items->merge($media);

        return $items;
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
        $data = self::processMediaUploadData($data);

        if(array_key_exists('object_type', $data)) {
            if(strpos( $data['object_type'], '\\' )) {
                $exploded = explode('\\', $data['object_type']);

                if(count($exploded) > 2) {
                    $data['object_type'] = $exploded[0] . '\\' . $exploded[1] . '\\Database\\Models\\' . $exploded[2];
                }

                if(count($exploded) == 2) {
                    $data['object_type'] = 'NextDeveloper\\' . $exploded[0] . '\\Database\\Models\\' . $exploded[1];
                }
            }

            $data['object_id'] = app($data['object_type'])->where('uuid', $data['object_id'])->first()->id;
        }

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

        return [
            'cdn_url' => URL::to(Storage::url($localFile)),
            'disk' => 'public',
            'size' => File::size($file),
            'mime_type' => File::mimeType($file),
            'custom_properties' => [
                'id'            => $localFile,
                'public_id'     => $localFile,
                'type'          => File::type($file),
                'extension'     => File::extension($file),
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

        $file       = $data['file'];
        $fileName   = $file->getClientOriginalName();
        $directory  = storage_path('tmp');

        // Create temporary folder, if not exist
        if (!File::isDirectory($directory))
        {
            File::makeDirectory($directory, 0775, false, false);
        }

        $uploadToLocalStore = $file->store('tmp');
        $data['file']       = storage_path('app/' . $uploadToLocalStore);
        $data['file_name']  = $fileName;

        return $data;
    }
}
