<?php

return [
    'scopes'    =>  [
        'global' => [
            '\NextDeveloper\IAM\Database\Scopes\AuthorizationScope',
            '\NextDeveloper\Commons\Database\GlobalScopes\LimitScope',
        ]
    ],

    /**
     * Why do we need this, if we can tag anything ?
     *
     * The reason is; since tagging is a generic thing which can be applied to all objects in the project,
     * and since the tagging requests in this module is also generic, we just dont want to expose the full
     * class name to tag. When we get our request to tag a object we should be able to get the Alias (or the name)
     * and the id of that object only. Like;
     *
     * POST .../tag-object
     * params:
     * - object: 'Domain'
     * - object_id: '....something-fancy-or-boring....'
     * - tag: 'tag'
     *
     * Also dont forget to add taggables to the TagHelper while initiating your own packages.
     */
    'taggable_objects'  =>  [
        'common_domain'    =>  \NextDeveloper\Commons\Database\Models\Domains::class,
        'common_media'     =>  \NextDeveloper\Commons\Database\Models\Media::class,
    ],

    /**
     * This is the default storage configuration for the media files.
     * You can change the default storage configuration from the .env file.
     *
     * LOCAL_STORAGE_DISK: The disk name for the local storage. Default is 'public'
     * LOCAL_STORAGE_DIRECTORY: The directory name for the local storage. Default is 'media'
     *
     * You can also add more storage configurations to the 'cdn' array.
     */
    'local'    =>  [
        'disk'      =>  env('LOCAL_STORAGE_DISK', 'public'),
        'directory' =>  env('LOCAL_STORAGE_DIRECTORY', 'media')
    ],

    'cdn'   =>  [
        'default'   =>  env('DEFAULT_CDN'),
        'publitio'  =>  [
            'api_key'       =>  env('PUBLITIO_API_KEY'),
            'api_secret'    =>  env('PUBLITIO_API_SECRET'),
            'domain'        =>  env('PUBLITIO_DOMAIN')
        ],
    ],
];

