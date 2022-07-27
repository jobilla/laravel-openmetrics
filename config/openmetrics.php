<?php

return [
    'enabled' => env('OPENMETRICS_ENABLED', true),

    // Allowed values: 'redis', 'apc', 'apcng', 'memory' (default).
    'adapter' => env('OPENMETRICS_ADAPTER', 'memory'),

    // This configuration is only needed, and used, for the "redis" adapter.
    'redis' => [
        'host' => env('OPENMETRICS_REDIS_HOST', '127.0.0.1'),
        'port' => env('OPENMETRICS_REDIS_PORT', 6379),
        'password' => env('OPENMETRICS_REDIS_PASSWORD', null),
        'database' => env('OPENMETRICS_REDIS_DATABASE', 0),
        'timeout' => env('OPENMETRICS_REDIS_TIMEOUT', 0.1),
        'read_timeout' => env('OPENMETRICS_REDIS_READ_TIMEOUT', 10),
        'persistent_connections' => env('OPENMETRICS_REDIS_PERSISTENT_CONNECTIONS', false),
    ],

    'handles' => [
        'database' => env('OPENMETRICS_HANDLE_DATABASE', true),
    ]
];