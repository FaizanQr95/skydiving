<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'square' => [
        'sandbox_token' => env('SQUARE_SANDBOX_TOKEN'),
    ],


    'cometchat' => [
        'app_id'   => env('COMETCHAT_APP_ID'),
        'api_key'  => env('COMETCHAT_API_KEY'), // Server-to-Server REST API Key
        'region'   => env('COMETCHAT_REGION'),
        'auth_key' => env('COMETCHAT_AUTH_KEY'), // For generating client-side auth tokens
    ],
];
