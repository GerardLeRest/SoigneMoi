<?php

use Slim\App;
use App\Controllers\ControlleurDonnees;
use App\Controllers\ControlleurFormulaire;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
use App\Controllers\ControlleurSejours;


//pages Web
$renderer = new PhpRenderer(__DIR__ . '/../src/Views');

$app->get('/accueil', function (Request $request, Response $response, $args) use ($renderer) {
   return $renderer->render($response, 'accueil.php'); 
});

$app->get('/services', function(Request $request, Response $response, $arg) use ($renderer) {
   return $renderer->render($response, 'services.php');
});

$app->get('/patients', function (Request $request, Response $response, $args) use ($renderer) {
   return $renderer->render($response, 'patients.php'); 
});

$app->get('/professionnels', function (Request $request, Response $response, $args) use ($renderer) {
   return $renderer->render($response, 'professionnels.php'); 
});

$app->get('/inscription', function (Request $request, Response $response, $args) use ($renderer) {
   return $renderer->render($response, 'inscription.php');
});


return function (App $app) {
    
   // Application bureautique - Entrés/Sorties des patients
   $app->get('/tous', ControlleurDonnees::class . ':donneesTous');  // l'ensemble des entrées/sorties des patients
   $app->get('/entrees', ControlleurDonnees::class . ':donneesEntrees'); // les entrées des patients
   $app->get('/sorties', ControlleurDonnees::class . ':donneesSorties'); // les sorties des patients
   $app->get('/details/{id}', ControlleurDonnees::class . ':details'); // les détails des patients

   //site//web
   $app->post("/validation-formulaire", ControlleurFormulaire::class . ':verification'); //validation du formulaire
   $app->get('/sejours', ControlleurSejours::class . ':requeteSejours'); //récupération des données du séjour 
};
