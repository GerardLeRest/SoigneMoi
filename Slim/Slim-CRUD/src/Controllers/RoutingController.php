<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

 class RoutingController{
    private $footballers;

    public function __construct (){
        $this->footballers = [["nom"=> "Bourigeaud", "prenom"=> "Benjamin", "age"=> 30],
                        ["nom"=> "Mbappé", "prenom"=> "Kylian", "age"=> 25],
                        ["nom"=> "De Bruyne", "prenom"=> "Kevin", "age"=> 32],
                        ["nom"=> "Modrić", "prenom"=> "Luka", "age"=> 38]];
                    }
    public function create(Request $request, Response $response, array $args) : Response{
        $footballer = $request->getParsedBody(); //récupération des données du corps de la requête POST sous forme d'un tableau
        array_push($this->footballers,$footballer);
        //affichage des joueurs
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getbody()->write($footballer['nom'] . " est le joueur ajouté");
        // on utilise json_encode pour les tableaux et les objets, pour un string $response->getBody()->write("chaine de caratère);
        $response->getBody()->write(json_encode($this->footballers));
        return $response;
    }

    public function read(Request $request, Response $response, array $args) : Response{
        $id = $args['id']; //recuperation de l'id
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write("le joueur sélectionné est: ");
        $response->getBody()->Write(json_encode($this->footballers[$id]));
        return $response;
    }

    public function update (Request $request, Response $response, array $args) : Response{
        $id = $args['id'];
        $updateJoueur = $request->getParsedBody(); // récupération des données envoyées par le client
        $this->footballers[$id] = $updateJoueur;
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($this->footballers));
        return $response;
    }

    public function delete (Request $request, Response $response, array $args) : Response{
        $id = $args['id'];
        unset($thisfootballers[$id]);  
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write("Un joueur a été supprimé");
        $response->getBody()->write(json_encode($this->footballers));
        return $response;
    }
   
}