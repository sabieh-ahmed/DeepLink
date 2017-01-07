<?php


return [

    /*
    |--------------------------------------------------------------------------
    | ONE SIGNAL CONFIGURATION
    |--------------------------------------------------------------------------
    |  This config bellow takes care of configuring your one signal
    |  Application from which you can enable push notifications for
    |  you app.
    */
    'one_signal_app_id' => env('ONE_SIGNAL_APP_ID', null),
    'one_signal_api_key' => env('ONE_SIGNAL_API_KEY', null),


    /*
    |--------------------------------------------------------------------------
    | CLOUDINARY CONFIG
    |--------------------------------------------------------------------------
    |  This config bellow takes care of configuring your cloudinary
    |  Application from which you can enable direct file upload to cloudinary
    |
    */

    "cloudinary_cloud_name" => env('CLOUDINARY_CLOUD_NAME', null),
    "cloudinary_api_key" => env('CLOUDINARY_API_KEY', null),
    "cloudinary_api_secret" => env('CLOUDINARY_API_SECRET', null),



    /*
    |--------------------------------------------------------------------------
    | USER CONFIG
    |--------------------------------------------------------------------------
    |
    */

    'user_class'=>'App\User'



];