<?php

use App\Packages\Asaas\Job\DefaultWebhookProcessorJob;

return [

    /*
    |--------------------------------------------------------------------------
    | Access token
    |--------------------------------------------------------------------------
    |
    | This value is the access token needed to make request to Asaas's Http Api.
    |
    */
    "access_token" => env('ASAAS_TOKEN', ''),

    /*
    |--------------------------------------------------------------------------
    | Is Sandbox environment
    |--------------------------------------------------------------------------
    |
    | This value indicates if you want to request to sanbox environment (TRUE) or
    | production environment.
    */
    "is_sandbox" => env('ASAAS_IS_SANDBOX', ''),

    /*
    |--------------------------------------------------------------------------
    | Sandbox URL
    |--------------------------------------------------------------------------
    |
    | This value is only used when "is_sandbox" is TRUE, it indicate the sandbox url.
    |
    */
    "sandbox_url" => env('ASAAS_SANDBOX_URL', ''),

    /*
    |--------------------------------------------------------------------------
    | Production URL
    |--------------------------------------------------------------------------
    |
    | This value is only used when "is_sandbox" is FALSE, it indicate the production url.
    |
    */
    "production_url" => env('ASAAS_PRODUCTION_URL', ''),

    /*
    |--------------------------------------------------------------------------
    | Webhook config
    |--------------------------------------------------------------------------
    |
    */
    "webhook" => [
        'processor' => DefaultWebhookProcessorJob::class
    ]
];
