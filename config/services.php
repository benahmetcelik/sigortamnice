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

    'nippon' => [
        'wsdl' => env('NIPPON_WSDL'),
        'username' => env('NIPPON_USERNAME'),
        'password' => env('NIPPON_PASSWORD'),
    ],

    'allianz' => [
        'wsdl' => env('ALLIANZ_WSDL'),
        'username' => env('ALLIANZ_USERNAME'),
        'password' => env('ALLIANZ_PASSWORD'),
    ],

    'axa' => [
        'wsdl' => env('AXA_WSDL'),
        'username' => env('AXA_USERNAME'),
        'password' => env('AXA_PASSWORD'),
    ],

    'mapfre' => [
        'wsdl' => env('MAPFRE_WSDL'),
        'username' => env('MAPFRE_USERNAME'),
        'password' => env('MAPFRE_PASSWORD'),
    ],

    'anadolu' => [
        'wsdl' => env('ANADOLU_WSDL'),
        'username' => env('ANADOLU_USERNAME'),
        'password' => env('ANADOLU_PASSWORD'),
    ],

];
