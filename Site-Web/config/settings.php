<?php

// Should be set to 0 in production
error_reporting(0);

// Should be set to '0' in production
ini_set('display_errors', '0');

$settings = [
    'doctrine' => [
        'pathToModels' => __DIR__ . '/../src/Models',
        'isDevMode' => true,
        'connectionMysql' => [
            'driver' => 'pdo_mysql',
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASS'],
            'host' => "91.216.107.186",
            'port' => 3306
        ],
    ]
];
    
return $settings;
