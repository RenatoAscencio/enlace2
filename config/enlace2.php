<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Enlace2 API Key
    |--------------------------------------------------------------------------
    |
    | Your Enlace2 API key. You can get this from your Enlace2 dashboard
    | after registering an account.
    |
    */
    'api_key' => env('ENLACE2_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Base URL
    |--------------------------------------------------------------------------
    |
    | The base URL for the Enlace2 API. You shouldn't need to change this
    | unless you're using a custom instance.
    |
    */
    'base_url' => env('ENLACE2_BASE_URL', 'https://enlace2.com/api/'),

    /*
    |--------------------------------------------------------------------------
    | Request Timeout
    |--------------------------------------------------------------------------
    |
    | The timeout for API requests in seconds.
    |
    */
    'timeout' => env('ENLACE2_TIMEOUT', 30),

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting
    |--------------------------------------------------------------------------
    |
    | Enable rate limiting protection. When enabled, the package will
    | respect the API's rate limits (30 requests per minute).
    |
    */
    'rate_limiting' => env('ENLACE2_RATE_LIMITING', true),
];