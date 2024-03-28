Hôpital SoigneMoi - Slim-CRUD2

les routes sont séparées de fonctions correspondantes:
-routes.php dans le dossier config
- le fonctions dans src/Controllers/RoutingContollers.php

lancer le serveur interne php-v sur le port 8082
php -S localhost:8082
les différentes routes:
- localhost:8082/create
-localhost:8082/read/2
-locahost:8082/update/0
-localhost:8082/delete/2

composer.json
    "require": {
        "slim/slim": "4.*",
        "slim/psr7": "^1.6"
    },
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}

dans le terminal, ajouter la deuxième parte du fichier composer.json:
puis, composer dump-autoloadnfiguration:

