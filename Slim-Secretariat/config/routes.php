<?php

use Slim\App;
use App\Controllers\ControlleurDonnees; // Add the missing import statement


return function (App $app) {
    
   //Appel de méthodes la classe ContrellerDonnes à l'aide de l'URL "localhost:8082/...."
   $app->get('/tous', ControlleurDonnees::class . ':donneesTous'); 
   $app->get('/entrees', ControlleurDonnees::class . ':donneesEntrees');
   $app->get('/sorties', ControlleurDonnees::class . ':donneesSorties');
   $app->get('/details/{id}', ControlleurDonnees::class . ':details');
};