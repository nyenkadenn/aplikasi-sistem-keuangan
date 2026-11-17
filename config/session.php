<?php

return [
    'driver' => env('SESSION_DRIVER', 'cookie'),
    'lifetime' => 120,
    'expire_on_close' => false,
    'encrypt' => false,
    'cookie' => 'si_keuangan_session',
    'path' => '/',
    'domain' => env('SESSION_DOMAIN'),
    'secure' => env('SESSION_SECURE_COOKIE', true),
    'http_only' => true,
    'same_site' => 'lax',
];
