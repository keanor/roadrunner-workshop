<?php

declare(strict_types=1);

return [
    'db' => [
        'driver' => 'Mysqli',
        'database' => 'blog',
        'username' => 'root',
        'password' => 'example',
        'hostname' => 'db'
    ],
    'authentication' => [
        'pdo' => [
            'dsn' => 'mysql:host=db;dbname=blog',
            'username' => 'root',
            'password' => 'example',
        ]
    ]
];
