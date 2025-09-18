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

    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Cache configuration for API responses to improve performance.
    |
    */
    'cache' => [
        'enabled' => env('ENLACE2_CACHE_ENABLED', true),
        'ttl' => env('ENLACE2_CACHE_TTL', 3600), // 1 hour
        'store' => env('ENLACE2_CACHE_STORE', 'default'),
        'prefix' => env('ENLACE2_CACHE_PREFIX', 'enlace2:'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Retry Configuration
    |--------------------------------------------------------------------------
    |
    | Retry failed requests with exponential backoff.
    |
    */
    'retry' => [
        'enabled' => env('ENLACE2_RETRY_ENABLED', true),
        'attempts' => env('ENLACE2_RETRY_ATTEMPTS', 3),
        'delay' => env('ENLACE2_RETRY_DELAY', 1000), // milliseconds
        'multiplier' => env('ENLACE2_RETRY_MULTIPLIER', 2),
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    |
    | Log API requests and responses for debugging and monitoring.
    |
    */
    'logging' => [
        'enabled' => env('ENLACE2_LOGGING_ENABLED', false),
        'channel' => env('ENLACE2_LOG_CHANNEL', 'default'),
        'level' => env('ENLACE2_LOG_LEVEL', 'info'),
        'log_requests' => env('ENLACE2_LOG_REQUESTS', true),
        'log_responses' => env('ENLACE2_LOG_RESPONSES', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    |
    | Input validation settings.
    |
    */
    'validation' => [
        'strict_urls' => env('ENLACE2_STRICT_URL_VALIDATION', true),
        'max_url_length' => env('ENLACE2_MAX_URL_LENGTH', 2048),
        'allowed_protocols' => ['http', 'https'],
    ],
];