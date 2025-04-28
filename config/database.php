<?php

return [
    'host' => env('DB_HOST') ?? 'mysql-8.4.local',
    'port' => env('DB_PORT') ?? '3306',
    'database' => env('DB_DATABASE') ?? 'db_flowaxy',
    'username' => env('DB_USERNAME') ?? 'root',
    'password' => env('DB_PASSWORD') ?? '',
    'charset' => 'utf8mb4',
];
