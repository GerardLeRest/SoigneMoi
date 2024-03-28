<?php

use Slim\Factory\AppFactory;

// charher les bibliothèques
require __DIR__ . '/../vendor/autoload.php';

// créer l'application 
$app = AppFactory::create();

// Charger les routes
(require __DIR__ . '/../config/routes.php')($app);

//démarrer l'application
$app->run();