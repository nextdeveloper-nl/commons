<?php

return [
    'scopes'    =>  [
        'global' => [
            //  Dont do this here because it makes infinite loop with user object.
            '\NextDeveloper\IAM\Database\Scopes\AuthorizationScope'
        ]
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