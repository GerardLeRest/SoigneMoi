- Installation
---------------------------------------------------------
dans le terminal de VSCode
 * composer require slim/slim:"4.*"
 * composer require slim/psr7  --with-all-dependencies
 * créer ç la racine un dosier public
 * mettre l'exemple de Slim dans un fichier index.php
 
 routes
 -------------------------------------
1 - php -S localhost:8100 - t public (index.php est dans le dossier public)
2 - lancer VSCode avec le debogueur.
  - lancer Postman ou un naviguateur internet et inscrire la route:
  * 1ere route: localhost:8100/Hello
  * 2ème route: localhost:8100/prenom/David
  * 3ème route: localhost:8100/json
