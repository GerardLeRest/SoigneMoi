<?php

return [
        'doctrine' => [
            'pathToModels' => __DIR__ . '/../src/Models',
            'isDevMode' => true,
            'connectionMysql' => [
                'driver' => 'pdo_mysql',
                'dbname' => $_ENV['DB_NAME'],
                'user' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASS'],
                'host' => "localhost",
                'port' => 3306
            ],
        ],
        'commands' => [
            \App\Console\ExampleCommand::class,
            // Add more here...
        ]
    ];    
    