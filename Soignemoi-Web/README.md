# Installation du site web local "soignemoi-web"

## 1 Création de la branche locale "soignemoi-web"

Ouvrir un terminal

```bash
git clone git@github.com:GerardLeRest/SoigneMoi.git
```

Voici les branches locales - on ne voit que la branche master

```bash
git branch
```

Voici la liste des branches distantes

```bash
git branch -r
```

Créer la branche locale et le basculement sur cette branche

```bash
git checkout soignemoi-web
```

Pour vérifier le bon changement de branche  

```bash
git branch
```

  On peut alors copier le dossier dans son propre projet

## 2 Configuration de l'application "SoigneMoi"

- lancer son IDE et ouvrir le projet "Soignemoi-Web"

- Créer un dossier .env à la racine de projet

- Et y mettre:
  \# Variables de la base de données:
  
  ```php
  DB_USER = "utilisateur"
  DB_PASS = "MotDePasseBaseDeDonnees"
  DB_NAME = "Soignemoi"
  ```

- ouvrir un terminal pour installer les dépendances manquantes du projet: composer install 

- $app->setBasePath('/soignemoi-web'); - doit être décommenté dans le fichier config/container.php

- \<base href="\<?= "/soignemoi-web" ?\>/"/\> dans src/Views/commun/head.php"

## 3 Mise en place sur le serveur

- renommer le dossier Soignemoi-Web en soignemoi-web

- déplacer le dossier dans /var/www/html

- changer les propriétaires:
  
  ```bash
  sudo chown -R $USER:www-data /var/www/html/soignemoi-web
  ```

- changer les droits:
  
  ```bash
  chmod -R a-rwx,u+rwX,g+rX /var/www/html/soignemoi-web
  ```

- Suivre la documentation: https://www.slimframework.com/docs/v3/start/web-servers.html

- lancer le site en executant http://localhost/soignemoi-web/accueil dans un navigateur internet.
  http://localhost/soignemoi-web/formulaireMedecin permet de rentrer les inforation d'un medecin.
