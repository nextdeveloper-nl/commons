<?php

return [
    'scopes'    =>  [
        'global' => [
            //  Dont do this here because it makes infinite loop with user object.
            '\NextDeveloper\IAM\Database\Scopes\AuthorizationScope'
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
        'domain'    =>  \NextDeveloper\Commons\Database\Models\Domains::class,
        'media'     =>  \NextDeveloper\Commons\Database\Models\Media::class,
    ],

    'cdn'   =>  [
        'default'   =>  env('DEFAULT_CDN', 'publitio'),
        'publitio'  =>  [
            'api_key'       =>  env('PUBLITIO_API_KEY'),
            'api_secret'    =>  env('PUBLITIO_API_SECRET'),
            'domain'        =>  env('PUBLITIO_DOMAIN')
        ]
    ],
];

