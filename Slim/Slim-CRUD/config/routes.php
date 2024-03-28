<?php

use Slim\App;
use App\Controllers\RoutingController;

return function (App $app) {
// à patrtir de l'URL "localhost:8082/create" on appelle la méthode create de la classe RoutingController
    $app->addBodyParsingMiddleware(); //evite que la récupération getParsedBody() soit NULL
    $app->post('/create', RoutingController::class . ':create');
    $app->get('/read/{id}', RoutingController::class . ':read');
    $app->put('/update/{id}', RoutingController::class . ':update');
    $app->delete('/delete/{id}', RoutingController::class . ':delete');
};
