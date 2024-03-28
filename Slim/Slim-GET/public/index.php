<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$app = AppFactory::create();

$app->get('/hello', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

// $app->get('/prenom/{prenom}'... peut ne pas fonctionner!
// Itinéraire pour "/prenom/{prenom}"
$app->get('/prenom/{prenom}', function (Request $request, Response $response, array $args) {
    $prenom = $args['prenom'];
    $response->getBody()->write("Bonjour, " . $prenom . "!");
    return $response;
});

$app->get('/json', function(Request $request, Response $response, array $args) {
    $personne = ["nom"=> "LE REST",
                 "prenom"=> "Gérard",
                 "age"=> 56];  
    $response = $response->withHeader('Content-Type', 'application/json');
    $response->getBody()->write(json_encode($personne));
    return $response;
});

$app->run();