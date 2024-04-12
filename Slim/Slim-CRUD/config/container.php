<?php

use Slim\App;
use Slim\Factory\AppFactory;
use Doctrine\DBAL\DriverManager; 
use Doctrine\ORM\EntityManager; 
use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputOption;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

return[
    'settings' => function () {
        $settings = require __DIR__ . '/settings.php';
        return $settings;
    },
    // Construction de l'instance EntutyManager
    EntityManager::class => function (ContainerInterface $container) : EntityManager {

        $settings = (array)$container->get('settings')['doctrine'];
        
        $cache = $settings['isDevMode'] ?
            new ArrayAdapter() : 
            new FilesystemAdapter(directory: $settings['cache_dir']);
        
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
    },
    //console
    Application::class => function (ContainerInterface $container) {
        $application = new Application();

        $application->getDefinition()->addOption(
            new InputOption('--env', '-e', InputOption::VALUE_REQUIRED, 'The Environment name.', 'dev')
        );

        foreach ($container->get('settings')['commands'] as $class) {
            $application->add($container->get($class));
        }

        return $application;
    }
];
