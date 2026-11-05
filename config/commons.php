<?php

return [
    'scopes' => [
        'global' => [
            '\NextDeveloper\IAM\Database\Scopes\AuthorizationScope',
            '\NextDeveloper\Commons\Database\GlobalScopes\LimitScope',
        ]
    ],

    /*
    | Project-wide command history (who did what through the API, in any module). See CommandLogsService and the
    | CommandHistory middleware. Table: common_command_logs (schemas/common_command_logs.sql).
    */
    'command_logs' => [
        // Master switch. Off = the middleware does nothing and record() returns without writing.
        'enabled' => env('COMMONS_COMMAND_LOGS_ENABLED', true),

        // Queue the write job goes to. Null = the default queue (a named queue needs a worker listening to it).
        'queue' => env('COMMONS_COMMAND_LOGS_QUEUE'),

        // Cache store holding each account's settings so the middleware never reads the database per request.
        'cache_store' => env('COMMONS_COMMAND_LOGS_CACHE_STORE', 'redis'),
        'settings_ttl' => env('COMMONS_COMMAND_LOGS_SETTINGS_TTL', 86400),

        // What an account follows until it chooses otherwise. delete (and every system event) is always logged.
        'defaults' => ['create' => true, 'update' => true, 'delete' => true, 'read' => false],

        // Paths (Laravel is() patterns) that are never logged: the history endpoints themselves and health checks.
        'exclude' => ['commons/command-logs*', 'commons/command-log-settings*', 'health*', 'up'],

        // Live feed on NATS (needs the Events module with events.nats.enabled). Every stored command is published once to the
        // acting user's own subject (a member only ever receives their own commands, like GET /commons/command-logs, and
        // only a reduced payload: no ip address, context or error) and once, in full, to the platform subject for live
        // monitoring (server side only, browsers are never granted it).
        // {account_uuid} and {user_uuid} are replaced with the uuids. Set a subject to null to switch that feed off.
        'nats' => [
            'enabled' => env('COMMONS_COMMAND_LOGS_NATS_ENABLED', true),
            'client_subject' => 'client.{account_uuid}.{user_uuid}.commands',
            'platform_subject' => 'platform.commands',
        ],

        // Rows older than this many days are removed by commons:prune-command-logs, per operation. null = kept forever.
        'retention_days' => ['read' => 90, 'create' => 365, 'update' => 365, 'delete' => null, 'system' => null],
    ],

    'cache' => [
        // Seconds a model's transformer output stays cached (CacheHelper::rememberTransformed).
        'transformed_ttl' => env('COMMONS_TRANSFORMED_CACHE_TTL', 3600),
    ],

    'media' => [
        // Minutes a signed link to a file on a filesystem disk stays valid. MediaTransformer puts
        // one in cdn_url when a file has no public address. Unset, such files get no link (the
        // identity documents of the platform app rely on that).
        'signed_url_minutes' => env('COMMONS_MEDIA_SIGNED_URL_MINUTES'),
    ],

    'response' => [
        // true: a list endpoint with no rows answers 404 ERROR-NOT-FOUND (the old behavior).
        // false: it answers 200 with an empty `data` (and pagination meta when paginated).
        // Default is now false: an empty list is a valid result, not a missing object.
        'empty_collection_is_not_found' => env('COMMONS_EMPTY_COLLECTION_IS_NOT_FOUND', false),
    ],

    'failed_jobs' => [
        // Shared secret allowing token-based access to GET /commons/failed-jobs
        // for callers (e.g. AI agents) that have no IAM user/OAuth token.
        // Leave unset to disable the token path entirely (system-admin users
        // can still use the endpoint via their normal session).
        'api_token' => env('FAILED_JOBS_API_TOKEN'),
    ],

    'configuration' => [
        'actions' => [
            'save_in_db' => env('ACTIONS_SAVE_IN_DB', true),
            'log_in_file' => env('ACTIONS_LOG_IN_FILE', true),
        ],
        'domains' => [
            'allow_non_fqdn' => env('ALLOW_NON_FQDN', false),
        ],
        'system_user_email'   =>  env('SYSTEM_USER_EMAIL', 'leo@plusclouds.com'),
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

    'pusher' => [
        //  How long (minutes) a "pending" push log has to sit untouched before
        //  it is considered stuck and eligible for automatic retry.
        'stale_after_minutes' => env('COMMON_PUSHER_STALE_AFTER_MINUTES', 15),

        //  Max automatic retry attempts per push log before we give up on it.
        'max_retries' => env('COMMON_PUSHER_MAX_RETRIES', 5),
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

        // Google Gmail Configuration
        [
            'id'          => 'google_gmail',
            'name'        => 'Google Gmail',
            'description' => 'Gmail is a free email service developed by Google.',
            'status'      => env('GOOGLE_GMAIL_SERVICE_STATUS', false),
            'scopes'      => [
                'https://www.googleapis.com/auth/gmail.send',
            ],
        ],

        // Google Calendar Configuration
        [
            'id'          => 'google_calendar',
            'name'        => 'Google Calendar',
            'description' => 'Google Calendar is a time-management and scheduling calendar service developed by Google.',
            'status'      => env('GOOGLE_CALENDAR_SERVICE_STATUS', false),
            'scopes'      => [
                'https://www.googleapis.com/auth/calendar.readonly',
            ],
        ],

        // Google Contacts Configuration
        [
            'id'          => 'google_contacts',
            'name'        => 'Google Contacts',
            'description' => 'Google Contacts is a contact management tool developed by Google.',
            'status'      => env('GOOGLE_CONTACTS_SERVICE_STATUS', false),
            'scopes'      => [
                'https://www.googleapis.com/auth/contacts.readonly',
            ],
        ],
    ],
];

