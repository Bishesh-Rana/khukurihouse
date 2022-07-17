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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '368211801399053',
        'client_secret' => 'b0c39b69c0dfa8c82eec7360b1097314',
        'redirect' => 'https://kukurihouse.com/auth/facebook/callback',
    ],
    'google' => [
        'client_id' => '877997820661-crq691mqo462jmpob8lqj5j2c6jad2dh.apps.googleusercontent.com',
        'client_secret' => 'O4rQhI-9adYSp9xwbjIxKvgK',
        'redirect' => 'http://127.0.0.1:8080/auth/google/callback',
    ],

];
