<?php

return [
    'default' => env('DB_CONNECTION', 'pgsql'),

    'connections' => [
        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'aws-1-ap-northeast-1.pooler.supabase.com'),
            'port' => env('DB_PORT', '6543'),
            'database' => env('DB_DATABASE', 'postgres'),
            'username' => env('DB_USERNAME', 'postgres.pphlbdwggoirhujkrbin'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'require',
            'options' => extension_loaded('pdo_pgsql') ? [
                PDO::ATTR_EMULATE_PREPARES => true,
            ] : [],
        ],
    ],

    'migrations' => 'migrations',
];
