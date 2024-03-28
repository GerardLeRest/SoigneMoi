1 - dans un terminal, exécuter: php -S localhost:8082 -t public
2 - Démarrer VSCode
3 - Ouvrir POSTMAN et exécuter les commande suivante:
	* localhost:8082/create - (POST)
	* localhost:8082/read{i} - (GET) - i entre 0 et 3
	* localhost:8082/update{i} - (PUT) - i entre 0 et 3
	* localhost:8082/delete - (DELETE) - i entre 0 et 3
