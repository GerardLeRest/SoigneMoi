README.md

1 - télécharger le dossier sur github et ouvrir dans un ide

2 - installer vendor - composer install

3 - installer node_modules.js (fonctionne sans - cope des fichiers bootstap css et js dans ls dossiers)

4 - # Variables de la base de données dans le fichier .env du projet 
DB_USER = "username"
DB_PASS = "passsword"
DB_NAME = "databasenamei"

5 - Attention au chemin du site. Dans le fichier config/ontainer.php
$app->setBasePath('/soignemoi-web'); 

6 -  Placer votre dossier slim-secretariat-web dans le dossier /var/www/html

7 - depuis un naviguateur, lancer dans la barre de niguation 
 localhost/soignemoi-web/accueil 
