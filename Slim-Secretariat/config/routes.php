<?php

use Slim\App;
use App\Controllers\ControlleurDonnees; // Add the missing import statement
use App\Controllers\ControlleurDetails; // Add the missing import statement

return function (App $app) {
    
   //Appel de la méthode infosimple de la classe InfoContreller à l'aide de l'URL "localhost:8082/infosimple/{id}"
   $app->get('/tous', ControlleurDonnees::class . ':donneesTous'); 
   $app->get('/entrees', ControlleurDonnees::class . ':donneesEntrees');
   $app->get('/sorties', ControlleurDonnees::class . ':donneesSorties');
};