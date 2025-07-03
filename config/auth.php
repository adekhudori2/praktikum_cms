<?php

return [

    'defaults' => [
        'guard' => 'mahasiswa',
        'passwords' => 'mahasiswa',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
        'mahasiswa' => [
            'driver' => 'session',
            'provider' => 'mahasiswa',
        ],
    ],

    'providers' => [
        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Models\Mahasiswa::class,
        ],
        'mahasiswa' => [
            'driver' => 'eloquent',
            'model' => App\Models\Mahasiswa::class,
        ],
    ],

    'passwords' => [
        'admin' => [
            'provider' => 'admin',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'mahasiswa' => [
            'provider' => 'mahasiswa',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];
