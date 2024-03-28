<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;



require __DIR__ . '/../vendor/autoload.php';

 
    $app = AppFactory::create();
    $app->addBodyParsingMiddleware(); //evite la récupération getParsedBody() soit NULL
    
    $footballers = [["nom"=> "Bourigeaud", "prenom"=> "Benjamin", "age"=> 30],
                    ["nom"=> "Mbappé", "prenom"=> "Kylian", "age"=> 25],
                    ["nom"=> "De Bruyne", "prenom"=> "Kevin", "age"=> 32],
                    ["nom"=> "Modrić", "prenom"=> "Luka", "age"=> 38]
                ];

    // Create
    $app->post('/create', function (Request $request, Response $response, array $args) use($footballers) {
        $footballer = $request->getParsedBody(); //récupération des données du corps de la requête POST sous forme d'un tableau
        array_push($footballers,$footballer);
        //affichage des joueurs
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->GETbODY()->write($footballer['nom'] . " est le joueur ajouté");
        // on utilise json_encode pour les tableaux et les objets, pour un string $response->getBody()->write("chaine de caratère);
        $response->getBody()->write(json_encode($footballers));
        return $response;
    });

    //Read
    $app->get('/read/{id}', function (Request $request, Response $response, array $args) use($footballers) {
        $id = $args['id'];
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write("le joueur sélectionné est: ");
        $response->getBody()->Write(json_encode($footballers[$id]));
        return $response;
    });

    //Update
    $app->put('/update/{id}', function(Request $request, Response $response, array $args) use($footballers) {
        $id = $args['id'];
        $updateJoueur = $request->getParsedBody();
        $footballers[$id] = $updateJoueur;
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($footballers));
        return $response;
    });

    //Delete
    $app->delete('/delete/{id}', function(Request $request, Response $response, array $args) use($footballers){
        $id = $args['id'];
        $joueurSupprime = $footballers[$id];
        unset($footballers[$id]);  
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write("Un joueur a été supprimé");
        $response->getBody()->write(json_encode($footballers));
        return $response;
    });

    $app->run();