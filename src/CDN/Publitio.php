<?php

namespace NextDeveloper\Commons\CDN;

use Publitio\API;
use Publitio\BadJSONResponse;

class Publitio
{

    public static function connection(): API
    {
        // Create a new API object with your API key and API secret
        $api_key    = config('commons.cdn.publitio.api_key');
        $api_secret = config('commons.cdn.publitio.api_secret');
        return new API($api_key, $api_secret);
    }


    /**
     * This method uploads a file to the CDN.
     *
     * @param string $file
     * @param array $options
     * @return array
     * @throws BadJSONResponse
     * @throws \Exception
     */
    public static function upload(string $file, array $options = []): array
    {

        $publitio = self::connection();
        $uploadToPublitio = $publitio->uploadFile(file: fopen($file, 'r'), args: $options);

        // Check if upload was successful and return data
        if (isset($uploadToPublitio->success) && $uploadToPublitio->success) {
            $data = [
                'cdn_url'           => $uploadToPublitio->url_preview,
                'mime_type'         => $uploadToPublitio->type,
                'disk'              => 'publitio',
                'size'              => $uploadToPublitio->size,
                'custom_properties' => [
                    'id'            => $uploadToPublitio->id,
                    'public_id'     => $uploadToPublitio->public_id,
                    'type'          => $uploadToPublitio->type,
                    'extension'     => $uploadToPublitio->extension,
                    'privacy'       => $uploadToPublitio->privacy,
                    'download_url'  => $uploadToPublitio->url_download,
                    'created_at'    => $uploadToPublitio->created_at,
                ],
            ];
            unlink($file);
            return $data;
        }

        return [];
    }

}