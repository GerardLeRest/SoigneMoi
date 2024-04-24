<?php

namespace App\Controllers;

use DateTime;
use Doctrine\ORM\EntityManager;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;


class ControlleurDonnees
{
    private $entityManager; 
    private array $donnees; //données de la requête
  

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function recuperationDonnees(): array
        {
            $tableauFinal = [];
            foreach ($this->donnees as $donnee) {
                $tableauCoordonnees = [
                    'idPatient' => $donnee['idPatient'],
                    'prenom' => $donnee['prenom'],  
                    'nom' => $donnee['nom'],
                    'adressePostale' => $donnee['adressePostale']
                ];
                if (!in_array($tableauCoordonnees, $tableauFinal)) {  //élimine les doublons
                    array_push($tableauFinal, $tableauCoordonnees);
                }
            }
            return $tableauFinal; // Retourne après avoir traité tous les éléments
        }


    public function donneesTous (Request $request, Response $response) : Response
    {
        try{
            $query = $this->entityManager->createQuery('
                SELECT s.dateDebut, s.dateFin, p.idPatient, p.prenom, p.nom, p.adressePostale
                FROM App\Models\Sejour s 
                JOIN s.patient p
                WHERE  s.dateDebut = CURRENT_DATE() OR s.dateFin = CURRENT_DATE()
                ');
            $this->donnees = $query->getResult();
            $tableauEntreesSorties = $this->recuperationDonnees();
            $donneesJSON = json_encode($tableauEntreesSorties);
            $response->getBody()->write($donneesJSON); 
            return $response->withHeader('Content-Type', 'application/json');
        } catch( Exception $e){ 
            $response->getBody()->write("Erreur: " . $e->getMessage());
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
        }
    }

    // Entrées
    public function donneesEntrees (Request $request, Response $response) : Response
    {
        try{
            $query = $this->entityManager->createQuery('
                SELECT s.dateDebut, s.dateFin, p.idPatient, p.prenom, p.nom, p.adressePostale 
                FROM App\Models\Sejour s 
                JOIN s.patient p
                WHERE  s.dateDebut = CURRENT_DATE()');
            $this->donnees = $query->getResult();
            $tableauEntrees = $this->recuperationDonnees();        
            $donneesJSON = json_encode($tableauEntrees);
            $response->getBody()->write($donneesJSON); 
            return $response->withHeader('Content-Type', 'application/json');
        } catch(Exception $e){
            $response->getBody()->write("Erreur: " . $e->getmessage());
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');

        }
    }

     // Sorties
     public function donneesSorties (Request $request, Response $response) : Response
    {
        $query = $this->entityManager->createQuery('
            SELECT s.dateDebut, s.dateFin, p.idPatient, p.prenom, p.nom, p.adressePostale 
            FROM App\Models\Sejour s 
            JOIN s.patient p
            WHERE  s.dateFin = CURRENT_DATE()');
        $this->donnees = $query->getResult();
        $tableauSorties = $this->recuperationDonnees();        
        $donneesJSON = json_encode($tableauSorties);
        $response->getBody()->write($donneesJSON); 
        return $response->withHeader('Content-Type', 'application/json');
    }
}