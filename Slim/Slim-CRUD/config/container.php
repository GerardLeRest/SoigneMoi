<?php

use Slim\App;
use Slim\Factory\AppFactory;
use Doctrine\DBAL\DriverManager; 
use Doctrine\ORM\EntityManager; 
use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerInterface; 

return[
    'settings' => function () {
        $settings = require __DIR__ . '/settings.php';
        return $settings;
    },
    // Construction de l'instance EntutyManager
    EntityManager::class => function (ContainerInterface $container) : EntityManager {

        $settings = (array)$container->get('settings')['doctrine'];
        
        
        $paths = [$settings['pathToModels']]; //chemin de l'entité
        $isDevMode = $settings['isDevMode']; // est-ce en développement?

        // paramètres de connexion
        $dbParams = $settings['connectionMysql']; //connexion de la base de données
         
        // construction er retour de l'instance AppFactory
        $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
        $connection = DriverManager::getConnection($dbParams, $config);
        return new EntityManager($connection, $config);   
    },

    // construction de l'application $app
    App::class => function (ContainerInterface $container) {
        $app = AppFactory::createFromContainer($container);

        // Register routes
        (require __DIR__ . '/routes.php')($app);

        // Register middleware
        (require __DIR__ . '/middleware.php')($app);

        return $app;
    }
];
