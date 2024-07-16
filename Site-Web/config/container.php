<?php

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Doctrine\DBAL\DriverManager; 
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager; 
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Doctrine\DBAL\Connection; // Add this line to import the Connection class


return[
    'settings' => function () {
        $settings = require __DIR__ . '/settings.php';
        return $settings;
    },

     // connexion à la base de données
    Connection::class => function (ContainerInterface $container) {
        $settings = (array)$container->get('settings')['doctrine'];
        // paramètres de connexion
        $dbParams = $settings['connectionMysql']; 
        $config = $container->get('doctrineConfig');
        return DriverManager::getConnection($dbParams, $config);
    },

    //Configuration
    'doctrineConfig' => function (ContainerInterface $container) {
        $settings = (array)$container->get('settings')['doctrine'];
        return ORMSetup::createAttributeMetadataConfiguration(
            [$settings['pathToModels']], //chemin des entités
            $settings['isDevMode'] //est-on en developpement?
        );
    },

    //EntityManager
    EntityManager::class => function (ContainerInterface $container) : EntityManager {
        $settings = (array)$container->get('settings')['doctrine'];
        // gestion du cache
        $cache = $settings['isDevMode'] ?
            new ArrayAdapter() : 
            new FilesystemAdapter(directory: $settings['cache_dir']);
        $connection = $container->get(Connection::class); 
        $config = $container->get('doctrineConfig');
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

