# Installation du site web du projet
                     
Page d'accueil du site; https://www.soignemoi.net/accueil                     
                     
## 1 - Création de la branche locale "site-web"
  -------------------------------------------------
- Ouvrir un terminal
- git clone git@github.com:GerardLeRest/SoigneMoi.git
- git branch  (branches locales - on ne voit que la branche master)
- git branch -r (liste de branches distantes)
- git checkout site-web (création de la branche locale et basculement sur la branche)
- git branch (pour vérifier que l'on est sur la branche soignemoi-web)

## 2 - Configuration de l'application "Site-Web"
  ----------------------------------------------
- lancer son IDE et ouvrir le projet "Site-Web"
- créer un dossier .env à la racine de projet
- et y mettre:
	# Variables de la base de données \
	DB_USER = "utilisateur" \
	DB_PASS = "MotDePasseBaseDeDonnees" \
	DB_NAME = "Soignemoi" \
- changer "localhost" par l'adresse IP du site dans le fichiers config/settings (hébergeur)
- ouvrir un terminal pour installer les dépendances manquantes du projet:
	composer install 
		
## 3 - Mise en place sur le serveur
---------------------------------
- Compresser le dossier ZIP. 
- Le déposer dans le "Panel" du site dans le dossier "htdocs".
- Décompresser le dossier. 
- Extraire le contenu du dossier et le mettre dans htdocs. Le dossier vide peu-être alors effacé.
- Pour la base de données, il suffit de l'importer avec phpMyAdmin.
