<?php

namespace NextDeveloper\Commons\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use NextDeveloper\Commons\CDN\Publitio;
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
        $data = self::prepareData($data);

        $defaultCdn = config('commons.cdn.default');

        switch ($defaultCdn) {
            case 'publitio':
                $uploadMedia = Publitio::upload($data['file']);
                break;
            default:
                // If any other CDN is selected, it will be uploaded to local storage
                $uploadMedia = self::localStorage($data['file'], $data['file_name']);
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
    protected static function localStorage(string $file): array
    {
        $localDisk = config('commons.cdn.local.disk');
        $localDirectory = config('commons.cdn.local.directory');

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
                'id' => $localFile,
                'public_id' => $localFile,
                'type' => File::type($file),
                'extension' => File::extension($file),
                'privacy' => 'public',
                'download_url' => URL::to(Storage::url($localFile)),
                'created_at' => now(),
            ],
        ];
    }

    /**
     * Prepares data to be stored in the database.
     *
     * @param array $data
     * @return array
     */
    protected static function prepareData(array $data): array
    {
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
