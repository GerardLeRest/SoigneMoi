<?php

use App\Controllers\ControlleurFormulaireMedecin;
use App\Controllers\ControlleurFormulaireSejour;
use Slim\App;
use App\Controllers\ControlleurSecretariat;
use App\Controllers\ControlleurFormulairePatient;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
use App\Controllers\ControlleurListeSejours;
use App\Controllers\ControlleurFormulaireConnexion;

//pages Web - icônes de menu
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

$app->get('/formulairePatient', function (Request $request, Response $response, $args) use ($renderer) {
   return $renderer->render($response, 'formulairePatient.php');
});

$app->get('/formulaireSejour', function (Request $request, Response $response, $args) use ($renderer) {
   return $renderer->render($response, 'formulaireSejour.php');
});

$app->get('/formulaireMedecin', function (Request $request, Response $response, $args) use ($renderer) {
   return $renderer->render($response, 'formulaireMedecin.php');
});

$app->get('/formulaireConnexion', function (Request $request, Response $response, $args) use ($renderer) {
   return $renderer->render($response, 'formulaireConnexion.php');
});

return function (App $app) {
    
   // Application bureautique - Entrés/Sorties des patients
   $app->get('/tous', ControlleurSecretariat::class . ':donneesTous');  // l'ensemble des entrées/sorties des patients
   $app->get('/entrees', ControlleurSecretariat::class . ':donneesEntrees'); // les entrées des patients
   $app->get('/sorties', ControlleurSecretariat::class . ':donneesSorties'); // les sorties des patients
   $app->get('/details/{id}', ControlleurSecretariat::class . ':details'); // les détails des patients
   

   //site web - formulaires et requête  pour la liste des séjours
   $app->post("/formulairePatient", ControlleurFormulairePatient::class . ':verification'); //validation du formulaire du patient
   $app->post('/formulaireSejour', ControlleurFormulaireSejour::class . ':verification'); //validation du formulaire des du sejour
   $app->post('/formulaireMedecin',ControlleurFormulaireMedecin::class .':verification'); //validation du formulaire du médecin
   $app->post('/formulaireConnexion', ControlleurFormulaireConnexion::class . ':verification'); //validation du formulaire du médecin
   $app->get('/listeSejours', ControlleurListeSejours::class . ':requeteSejours'); //récupération des données du séjour 
};

