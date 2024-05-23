  
                     Installation du site we "soignemoi-web"
                     --------------------------------------
                     
  
  1 - Création de la branche locale "soignemoi-web"
  -------------------------------------------------
- Ouvrir un terminal
- git clone git@github.com:GerardLeRest/SoigneMoi.git
- git branch  (branches locales - on ne voit que la branche master)
- git branch -r (liste de branches distantes)
- git checkout soignemoi-web (création de la branche locale et basculement sur la branche)
- git branch (pour véridier que l'on est sur la branche soignemoi-web)


  2 - Configuration de l'application "SoigneMoi"
  ----------------------------------------------
- lancer son IDE et ouvrir le projet "Soignemoi-Web"
- créer un dossier .env à la racine de projet
- et y mettre:
	# Variables de la base de données
	DB_USER = "utilisateur"
	DB_PASS = "MotDePasseBaseDeDonnees"
	DB_NAME = "Soignemoi"
- ouvrir un terminal pour installer les dépendances manquantes du projet:
	composer install 
	
	
  3 - Mise en pace sur le serveur
---------------------------------
- renommer le dossier Soignemoi-Web en soignemoi-web
- déplacer le dossier dans /var/www/html
- lancer le site en executant http://localhost/soignemoi-web/accueil dans un navigateur internet.
 http://localhost/soignemoi-web/formulaireMedecin permet de rentrer les inforation d'un medecin.
