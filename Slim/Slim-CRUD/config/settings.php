<?php

// settings.php
return [
    'doctrine' => [
        'pathToModels' => '__DIR__ . /../src/Models',
        'isDevMode' => true,
        'connectionMysql' => [
            'driver' => 'pdo_mysql',
            'dbname' => 'university',
            'user' => 'gerard',
            'password' => 'q0In942kg91o!',
        ],
    ],
];