<?php

return [
    'scopes' => [
        'global' => [
            '\NextDeveloper\IAM\Database\Scopes\AuthorizationScope',
            '\NextDeveloper\Commons\Database\GlobalScopes\LimitScope',
        ]
    ],

    'configuration' => [
        'actions' => [
            'save_in_db' => env('ACTIONS_SAVE_IN_DB', true),
            'log_in_file' => env('ACTIONS_LOG_IN_FILE', true),
        ],
        'domains' => [
            'allow_non_fqdn' => env('ALLOW_NON_FQDN', false),
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
    'taggable_objects' => [
        'common_domain' => \NextDeveloper\Commons\Database\Models\Domains::class,
        'common_media' => \NextDeveloper\Commons\Database\Models\Media::class,
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
    'local' => [
        //  This is the root for local uploads
        'disk' => env('LOCAL_STORAGE_DISK', 'public'),

        //  This is the directory for local uploads
        'directory' => env('LOCAL_STORAGE_DIRECTORY', 'media')
    ],

    'cdn' => [
        'default' => env('DEFAULT_CDN'),
        'publitio' => [
            'api_key' => env('PUBLITIO_API_KEY'),
            'api_secret' => env('PUBLITIO_API_SECRET'),
            'domain' => env('PUBLITIO_DOMAIN')
        ],
    ],

    'exchange_rate' => [
        'url'       => env('COMMON_EXCHANGE_RATE_URL', 'http://www.tcmb.gov.tr/kurlar/today.xml'),
        'schedule'  => [
            'enabled'   => env('COMMON_EXCHANGE_RATE_SCHEDULE_ENABLED', false),
            'cron'      => env('COMMON_EXCHANGE_RATE_SCHEDULE_CRON', '0 * * * *'), // Every hour
        ]
    ],

    'task_scheduler' => [
        'schedule' => [
            'enabled'   => env('COMMON_TASK_SCHEDULER_ENABLED', false),
            'cron'      => env('COMMON_TASK_SCHEDULER_CRON', '0 * * * *'), // Every hour
        ]
    ],



    /*
    |--------------------------------------------------------------------------
    | External Services Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration file manages the integration settings for various
    | external services used in your application. Each service is organized
    | by provider and includes necessary scopes and credentials.
    |
    | Each service includes:
    | - status: Toggle to enable/disable the service
    | - scopes: Required OAuth2 scopes for the service
    | - fields: Validation rules for required service parameters
    |
    */
    'external_services' => [

        // Google Sheets Configuration
        [
            'id' => 'google_sheets',
            'name' => 'Google Sheets',
            'description' => 'Google Sheets is a web-based application that allows users to create, update, and modify spreadsheets.',
            'status' => env('GOOGLE_SHEET_SERVICE_STATUS', false),
            'scopes' => [
                'https://www.googleapis.com/auth/spreadsheets',
                //'https://www.googleapis.com/auth/drive',
            ],
            'fields' => [
                'spreadsheet_id' => [
                    'type' => 'string',
                    'required' => true,
                ],
            ],
        ],

        // Google Calendar Configuration
       [
            'id' => 'google_calendar',
            'name' => 'Google Calendar',
            'description' => 'Google Calendar is a time-management and scheduling calendar service developed by Google.',
            'status' => env('GOOGLE_CALENDAR_SERVICE_STATUS', false),
            'scopes' => [
                //'https://www.googleapis.com/auth/calendar',
                //'https://www.googleapis.com/auth/calendar.events',
                'https://www.googleapis.com/auth/calendar.readonly',
            ],
           ],

        // Google Drive Configuration
         [
            'id' => 'google_drive',
            'name' => 'Google Drive',
            'description' => 'Google Drive is a file storage and synchronization service developed by Google.',
            'status' => env('GOOGLE_DRIVE_SERVICE_STATUS', false),
            'scopes' => [
                'https://www.googleapis.com/auth/drive',
                'https://www.googleapis.com/auth/drive.file',
                'https://www.googleapis.com/auth/drive.readonly',
            ],
        ],

        // Gmail Configuration
        [
            'id' => 'google_gmail',
            'name' => 'Google Gmail',
            'description' => 'Gmail is a free email service developed by Google.',
            'status' => env('GOOGLE_GMAIL_SERVICE_STATUS', false),
            'scopes' => [
                'https://www.googleapis.com/auth/gmail.readonly',
                'https://www.googleapis.com/auth/gmail.send',
                //'https://www.googleapis.com/auth/gmail.compose',
            ],
        ],
    ],
];

