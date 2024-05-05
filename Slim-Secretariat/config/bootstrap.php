<?php

use DI\ContainerBuilder;
use Slim\App;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

// permet de charger les données .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Construire l'instance de container de type PHP-DI
$container = (new ContainerBuilder())
    ->addDefinitions(__DIR__ . '/container.php')
    ->build();

//  renvoyer l'instance de du container
return $container->get(App::class);