<?php 

namespace App\Controllers;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;

Class ControlleurIdMedecin{
    // ramène l'idMedcin à partir du nom et du prénom

    private EntityManager $entityManager;
    private array $donnees =[];
   
    public  function __construct(EntityManager $entityManager){
        $this->entityManager = $entityManager;
    }   

    public function acquisitionIdMedecin(Request $request, Response $response, array $arg) : Response{
        // récupération des donnéegetBody->write("");
        $this->donnees = $request->getParsedBody();
        // affectation du prenom et du nom
        $prenom = $this->donnees['prenom'];
        $nom =$this->donnees["nom"];
        $response->getBody()->write("");
        
        if ($prenom == null || (!isset($prenom))
            || $nom == null || (!isset($nom))){
            $response->getBody()->write("Les champs du médecins doivent être remplis");
        }
        else{
            $this->determinationIdMedecin($response, $prenom, $nom);
        }
        return $response;     
        
    }

    public function determinationIdMedecin(Response $response, string $prenom, string $nom) : Response{
        try{
            $query = $this->entityManager->createQuery('
                    SELECT m.idMedecin, m.prenom, m.nom FROM App\Models\Medecin m 
                    WHERE  m.prenom = :prenom AND m.nom = :nom');

            $query->setParameter('prenom', $prenom); // fin requête préparée
            $query->setParameter('nom', $nom); // fin requête préparée

            $resultat = $query->getOneOrNullResult(); // Récupération du résultat

            if ($resultat) {
                $idString = strval($resultat['idMedecin']);
                $response->getBody()->write(json_encode(['idMedecin' => $idString]));
                return $response->withHeader('Content-Type', 'application/json');
            } 
            else {
                $response->getBody()->write(json_encode(['idMedecin' => null]));
                return $response->withHeader('Content-Type', 'application/json');
            }

       }catch (Exception $e){
        $response->getBody()->write("Erreur: " . $e->getMessage());
        return $response;
       }
    }
        
}