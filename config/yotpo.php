<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Yotpo ApI Keys
    |--------------------------------------------------------------------------
    |
    | Log into the portal to create your API key
    |
    */


    'client_id' => env('YOTPO_API_CLIENT_ID'),

    'client_secret' => env('YOTPO_API_CLIENT_SECRET'),

    'app_key' => env('YOTPO_APP_KEY'),

    'database' => [
        'connection' => env('DB_YOTPO_CONNECTION'),
    ],
];
