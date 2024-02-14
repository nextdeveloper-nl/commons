<?php

namespace NextDeveloper\Commons\Services;

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

        $defaultCdn = config('commons.cdn.default');

        switch ($defaultCdn) {
            case 'publitio':
                $uploadMedia = Publitio::upload($data['file']);
                break;
            default:
                // If any other CDN is selected, it will be uploaded to local storage
                $uploadMedia = self::localStore($data['file'], $data['file']);
                // TODO: Add warning stating that the file was uploaded to local storage
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
     * @param string $fileName
     * @param string|null $localFile
     * @return array
     */
    protected static function localStore(string $file, string $fileName, string $localFile = null): array
    {
        // TODO: Move this file from temporary folder to public folder set in config
        return [
            'cdn_url'           => URL::to(Storage::url($localFile)),
            'file_name'         => $fileName,
            'mime_type'         => mime_content_type($file),
            'disk'              => 'local',
            'size'              => filesize($file),
            'manipulations'     => 'N/A',
            'custom_properties' => json_encode([
                'file_name'     => $fileName,
            ]),
        ];
    }
}
