<?php

namespace NextDeveloper\Commons\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
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
            if(strpos( $data['object_type'], '-' )) {
                $exploded = explode('-', $data['object_type']);

                if(count($exploded) > 2) {
                    $data['object_type'] = $exploded[0] . '\\' . $exploded[1] . '\\Database\\Models\\' . $exploded[2];
                }

                if(count($exploded) == 2) {
                    $data['object_type'] = 'NextDeveloper\\' . $exploded[0] . '\\Database\\Models\\' . $exploded[1];
                }
            }

            $data['object_id'] = app($data['object_type'])->where('uuid', $data['object_id'])->first()->id;
        }

        $defaultCdn = config('commons.cdn.default');

        switch ($defaultCdn) {
            case 'publitio':
                $uploadMedia = Publitio::upload($data['file']);
                break;
            default:
                // If any other CDN is selected, it will be uploaded to local storage
                $uploadMedia = self::saveToLocalStorage($data['file'], $data['file_name']);
                break;
        }

        $data = array_merge($data, $uploadMedia);
        unset($data['file']);

        return parent::create($data);
    }


    /**
     * This model prepares the data to be stored in the database.
     * When local storage is used, the file is stored in the local storage and the file path is returned.
     *
     * @param string $file
     * @return array
     */
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
