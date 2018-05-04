<?php

declare(strict_types=1);

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn'    => sprintf('sqlite:%s/data/blog.db', realpath(getcwd())),
    ],
];
