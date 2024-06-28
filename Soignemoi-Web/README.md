  
                     Installation du site we "soignemoi-web"
                     --------------------------------------
                     
  
  1 - Création de la branche locale "soignemoi-web"
  -------------------------------------------------
- Ouvrir un terminal
- git clone git@github.com:GerardLeRest/SoigneMoi.git
- git branch  (branches locales - on ne voit que la branche master)
- git branch -r (liste de branches distantes)
- git checkout soignemoi-web (création de la branche locale et basculement sur la branche)
- git branch (pour vérifier que l'on est sur la branche soignemoi-web)
- on peut alors copier le dossier dans son propre projet

  2 - Configuration de l'application "SoigneMoi"
  ----------------------------------------------
- lancer son IDE et ouvrir le projet "Soignemoi-Web"
- créer un dossier .env à la racine de projet
- et y mettre:
	# Variables de la base de données
	DB_USER = "utilisateur"
	DB_PASS = "MotDePasseBaseDeDonnees"
	DB_NAME = "Soignemoi"
- ouvrir un terminal pour installer les dépendances manquantes du projet: composer install 
- //$app->setBasePath('/soignemoi-web'); - doit être commenté dans le fichier config/container.php
- <base href="<?= "/soignemoi-web" ?>/"/> dans src/Views/commun/head.php"
- les liens doivent intégrer maintenant commencer par public/ Exemple:
"href="public/assets/css/styles.css"
	
  3 - Mise en place sur le serveur
---------------------------------
- renommer le dossier Soignemoi-Web en soignemoi-web
- déplacer le dossier dans /var/www/html
- changer les propriétaires:
    sudo chown -R $USER:www-data /var/www/html/soignemoi-web
- changer les droits:
    chmod -R a-rwx,u+rwX,g+rX /var/www/html/soignemoi-web
- Suivre la documentation: https://www.slimframework.com/docs/v3/start/web-servers.html
- lancer le site en executant http://localhost/soignemoi-web/accueil dans un navigateur internet.
 http://localhost/soignemoi-web/formulaireMedecin permet de rentrer les inforation d'un medecin.
