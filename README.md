# README.md "Soignemoi"
                
# 1 . Installation du site web local "soignemoi-web" 

## 1.1 Création de la branche locale "soignemoi-web"
- Ouvrir un terminal
- git clone git@github.com:GerardLeRest/SoigneMoi.git
- git branch  (branches locales - on ne voit que la branche master)
- git branch -r (liste de branches distantes)
- git checkout soignemoi-web (création de la branche locale et basculement sur la branche)
- git branch (pour vérifier que l'on est sur la branche soignemoi-web)
- on peut alors copier le dossier dans son propre projet

## 1.2 Configuration de l'application "SoigneMoi"
- lancer son IDE et ouvrir le projet "Soignemoi-Web"
- créer un dossier .env à la racine de projet
- et y mettre:
\# Variables de la base de données:
DB_USER = "utilisateur"
DB_PASS = "MotDePasseBaseDeDonnees"
DB_NAME = "Soignemoi"
- ouvrir un terminal pour installer les dépendances manquantes du projet: composer install 
- $app->setBasePath('/soignemoi-web'); - doit être décommenté dans le fichier config/container.php
- <base href="<?= "/soignemoi-web" ?>/"/> dans src/Views/commun/head.php"
	
## 1.3 Mise en place sur le serveur
- renommer le dossier Soignemoi-Web en soignemoi-web
- déplacer le dossier dans /var/www/html
- changer les propriétaires:
    sudo chown -R $USER:www-data /var/www/html/soignemoi-web
- changer les droits:
    chmod -R a-rwx,u+rwX,g+rX /var/www/html/soignemoi-web
- Suivre la documentation: https://www.slimframework.com/docs/v3/start/web-servers.html
- lancer le site en executant http://localhost/soignemoi-web/accueil dans un navigateur internet.
 http://localhost/soignemoi-web/formulaireMedecin permet de rentrer les inforation d'un medecin.
                    
            
# 2 . Installation de "Secretariat"

## 2.1 Préparation de la base de données
- Modifier des dates de sortie et de rentrée en les mettant à la date du jour
 
## 2.2 Installation des dépendances
- sudo apt-get install python3-tk
- sudo apt-get install python3-pil python3-pil.imagetk
  
## 2.3 Configuration des adresses:
* Pour un fonctionnement sur un serveur local local: 
    Vérifier les adresses qui doivent commencer par "http:/localhost/soignemoi-web/.... (5 adresses en tout)
* Pour un fonctionnement en mode hébergé:
    Vérifier les adresses qui doivent commencer par "https://www.soignemoi.net/.... (5 adresses en tout)	

## 2.4 lancement de l'application
- Ouvrir le dossier dans un IDE. Ouvrir un terminal.
- Taper "python3 Secretariat.py dans le terminal de l'IDE pour lancer l'application

                 
# 3 . Installation de "Medecin"
               
## 3.1 Configuration  de l'adresse IP du serveur
* En local:
- Changer les adresses IP du serveur dans les fichiers
(vous pouvez faire une recherche dans les fichier avec "http")
- créer un fichier app/res/xml/network-security-config.xml (autorisation http)
<?xml version="1.0" encoding="utf-8"?>
<network-security-config>
    <domain-config cleartextTrafficPermitted="true">
        <domain includeSubdomains="true">192.168.X.X</domain> 
    </domain-config>
</network-security-config> (adresse à adapter)
et dans le fichier app/manifets/AndroidManifest.xml, ajouter:
android:networkSecurityConfig="@xml/network_security_config" 

* En hébergé: 
- supprimer le fichier app/res/xml/network-security-config.xml et la ligne citée ci-avant
- Vérifier que les adresses web soient "https://www.soignemoi.net/" dans les fichiers ActiviteAvis.java et ActivitePrescription.java
  
## 3.2 Installation de Medecin
- construire le fichier apk (Build -> Build App Bundles(s)/APK(s) -> Build APK(s)
- Récupérer le fichier apk dans le dossier "app/build/outputs/apk/debug/"
- Déplacer le fichier apk sur le téléphone
(https://www.clubic.com/tutoriels/article-844849-1-comment-installer-fichier-apk-telephone-android.html ). 
- installer ce fichier.
- Il existe aussi Android Debug Bridge (adb) qui permet d'installer directement l'application sur le téléphone depuis l'ordinateur:
   -  installation:
   sudo apt install adb
    - utilisation: 
    adb install app-debug.apk
                     
