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

     'google' => [
    'client_id' => '780983425083-0g4maib68j13l3mt31f53p3ambd15ok2.apps.googleusercontent.com',
    'client_secret' => '-EobM4Z9DLZ5zjQz54Y60GlI',
    'redirect' => 'http://localhost:8000/ecommerce/callback/google',
  ], 
  'facebook' => [
    'client_id' => '353490785875030',
    'client_secret' => 'c0b4c2dc924e20294911f20c0473f3ec',
    'redirect' => 'http://localhost:8000/ecommerce/callback/facebook',
  ], 
];
