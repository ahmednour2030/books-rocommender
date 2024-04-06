<?php

    /*
    |--------------------------------------------------------------------------
    | Author is Ahmed Mohamed
    |--------------------------------------------------------------------------
    |
    */


return [
    /*
    |--------------------------------------------------------------------------
    | Provider Type
    |--------------------------------------------------------------------------
    |
    | This value is the type of your providers, which will be used when the
    | Sms providers needs to place the application's providers in a notification or
    | send Sms.
    |
    */

    'provider' => env('SMS_PROVIDER', 'one'),


    /*
    |--------------------------------------------------------------------------
    | Providers Classes
    |--------------------------------------------------------------------------
    |
    | This value is the class of your sms provider, which will be used when the
    | framework needs to place the application's provider in a notification or
    | send Sms.
    |
    */

    'providers' => [
        'one' => App\Libs\SMS\Services\SmsOneProvider::class,
        'two' => App\Libs\SMS\Services\SmsTwoProvider::class
    ]
];
