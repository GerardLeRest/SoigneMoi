<?php

use Slim\App;
use App\Controllers\StudentController;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

return function (App $app) {
    //route de test
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello, World!');
        return $response;
    });
   //Appel de la méthode createUser de la classe StudentContreller à l'aide de l'URL "localhost:8082/create/student"
    $app->post('/create/student', StudentController::class . ':createStudent'); //Create
    $app->get('/read/student/{id}', StudentController::class . ':readStudent'); //Readd
    $app->put('/update/student/{id}', StudentController::class . ':updateStudent'); //Update
    $app->delete('/delete/student/{id}', StudentController::class . ':deleteStudent'); //Delete
};