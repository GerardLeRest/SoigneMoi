<?php

use App\Controllers\InfoControlleur;
use Slim\App;

return function (App $app) {
    
   //Appel de la méthode infosimple de la classe InfoContreller à l'aide de l'URL "localhost:8082/infosimple/{id}"
    $app->get('/tableau', InfoControlleur::class . ':tableau');
};