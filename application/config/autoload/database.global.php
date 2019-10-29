<?php

declare(strict_types=1);

return [
    'db' => [
        'driver' => 'Mysqli',
        'database' => 'blog',
        'username' => 'root',
        'password' => 'example',
        'hostname' => 'database',
        'port' => '3306'
    ],
    'authentication' => [
        'pdo' => [
            'dsn' => 'mysql:host=database;dbname=blog',
            'username' => 'root',
            'password' => 'example',
        ]
    ]
];
