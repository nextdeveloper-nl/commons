<?php

return [
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
    'google' => [
        // Google Sheets Configuration
        'sheet' => [
            'status' => env('GOOGLE_SHEET_SERVICE_STATUS', false),
            'scopes' => [
                'https://www.googleapis.com/auth/spreadsheets',
                'https://www.googleapis.com/auth/drive',
            ],
            'fields' => [
                'spreadsheet_id' => [
                    'type' => 'string',
                    'required' => true,
                ],
            ],
        ],

        // Google Calendar Configuration
        'calendar' => [
            'status' => env('GOOGLE_CALENDAR_SERVICE_STATUS', false),
            'scopes' => [
                'https://www.googleapis.com/auth/calendar',
                'https://www.googleapis.com/auth/calendar.events',
                'https://www.googleapis.com/auth/calendar.readonly',
            ],
        ],

        // Google Drive Configuration
        'drive' => [
            'status' => env('GOOGLE_DRIVE_SERVICE_STATUS', false),
            'scopes' => [
                'https://www.googleapis.com/auth/drive',
                'https://www.googleapis.com/auth/drive.file',
                'https://www.googleapis.com/auth/drive.readonly',
            ],
        ],

        // Gmail Configuration
        'gmail' => [
            'status' => env('GOOGLE_GMAIL_SERVICE_STATUS', false),
            'scopes' => [
                'https://www.googleapis.com/auth/gmail.readonly',
                'https://www.googleapis.com/auth/gmail.send',
                'https://www.googleapis.com/auth/gmail.compose',
            ],
        ],
    ],
];