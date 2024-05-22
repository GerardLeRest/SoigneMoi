  
                    Installation du site web "soignemoi-web"
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
                    
                    
                     Installation de "Secretariat"
                     --------------------------------------
                     
  
  1 - Installation de Soignemoi-web
  -------------------------------------------------
- voir le README de Soignemoi-Web

  2 - Préparation de la base de données
  -------------------------------------
 - Modifier des dates de sortie et de rentrée en les mettant à la date du jour
  
  3 - Installation de Secretariat
  ----------------------------------------------
- Ouvrir un IDE et son terminal.
- Tapper "python3 Secretariat.py
                     
                     Installation de "Medecin"
                     --------------------------------------
                     
  
  1 - Installation de Soignemoi-web
  -------------------------------------------------
- voir le README de Soignemoi-Web

  2 - Changement de l'adresse IP du serveur
  -----------------------------------------
 - Changer les adresses IP du serveur dans les fichiers
(vous pouvez faire une recherche dans les fichier avec "192.168")
  
  3 - Installation de Medecin
  ----------------------------------------------
- Contruisez le fichier apk (Build -> Bundles/APK -> Build APKs
- Déplacer le fichier APK sur le téléphone
(https://www.clubic.com/tutoriels/article-844849-1-comment-installer-fichier-apk-telephone-android.html ). 
- installer ce fichier.
-Il existe aussi Android Debug Bridge (adb)  qui permet d'installer directement l'application sur le téléphone depuis l'ordinateur
