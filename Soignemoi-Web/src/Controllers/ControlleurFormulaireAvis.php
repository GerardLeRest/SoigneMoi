<?php

namespace App\Controllers;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;
use App\Models\Avis;
use App\Models\Patient;
use App\Models\Medecin;
use DateTime; 

class ControlleurFormulaireAvis{

    private EntityManager $entityManager;
    private array $donnees = [];
    
    public function __construct (EntityManager $entityManager){
        $this->entityManager = $entityManager;
        //$this->donnees = ['libelle'=>'titre', 'prenom'=>'Marie', 'nom'=>'Curie', 'date'=>'18/05/2024', 'description'=>'mal de genou'];
    }

    public function verification (Request $request, Response $response, array $Args ) : Response
    {
        $this->donnees = $request->getParsedBody();
        $libelle = $this->donnees['libelle'];
        $idMedecin = (int)$this->donnees['idMedecin'];
        $idPatient = (int)$this->donnees["idPatient"]; // $idPatient est un entier
        $date = $this->donnees['date'];
        $description = $this->donnees['description'];
        $response->getBody()->write("");
	
	//tests
	//$libelle = "";
    //$idMedecin = "";
    //$idPatient = "";
    //$date = "";
    //$description = "";

	
        //Vérification des données
        if(!isset($libelle) || empty($libelle)
            || !isset($idMedecin) || empty($idMedecin)
            || !isset($idPatient) || empty($idPatient)
            || !isset($date) || empty($date)
            || !isset($description) || empty($description)){
                $response->getBody()->write("erreur de saisie dans au moins un champ");
                return $response;
                }
            else{
                return $this->validation($response, $libelle, $idMedecin, $idPatient, $date, $description);
            }
    }

    public function validation(Response $response, string $libelle, int $idMedecin, int $idPatient, string $date, string $description ) : Response
    {
        $avis = new Avis();

        // Récupération des entités Patient et Medecin
        $patient = $this->entityManager->find(Patient::class, $idPatient);
        $medecin = $this->entityManager->find(Medecin::class, $idMedecin);

        $avis->setLibelle($libelle);
        $avis->setMedecin($medecin);
        $avis->setPatient($patient); 
        // changement de la string (DD/MM/YYYY) date en DateTime (YYYY/MM/DD)
        $dateObject = DateTime::createFromFormat('d/m/Y', $date);
        $avis->setDate($dateObject);
        $avis->setDescription($description);
        try{
            $this->entityManager->persist($avis);
            $this->entityManager->flush();
            $response->getBody()->write("données enregistrées");
            return $response;
        }
            catch (Exception $e) {
                $response->getBody->write('Erreur de transfert: '. $e->getMessage());
                return $response;
        }
    }
}
