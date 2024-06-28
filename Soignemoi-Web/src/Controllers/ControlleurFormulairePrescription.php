<?php

namespace App\Controllers;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;
use Slim\Views\PhpRenderer;
use App\Models\Prescription;
use App\Models\Patient;
use App\Models\Medecin;
use DateTime; 

class ControlleurFormulairePrescription{

    private EntityManager $entityManager;
    private int $idMedecin;
    private array $donnees;
    //private donnees = ["nomMedicament"=>"Levthyrox", "posologie"=>"2 fois par jour", "dateDeDebut"=>"20/5/2024", "dateDeFin"=>"27/06/2024"];
   
    public function __construct (EntityManager $entityManager){
        $this->entityManager = $entityManager;
    }

    public function verification (Request $request, Response $response, array $Args ){
        $renderer = new PhpRenderer(__DIR__ . '/../Views'); //création de l'instance $renderer
        $this->donnees = $request->getParsedBody();
        $nomMedicament = $this->donnees['nomMedicament'];
        $posologie = $this->donnees['posologie'];
        $dateDeDebut = $this->donnees["dateDeDebut"];
        $dateDeFin = $this->donnees["dateDeFin"];
        
                        
        //Vérification des données
        if(!isset($nomMedicament) || empty($nomMedicament)
            || !isset($posologie) || empty($posologie)
            || !isset($dateDeDebut) || empty($dateDeDebut)
            || !isset($dateDeFin) || empty($dateDeFin)){
                $response->getBody()->write("erreur de saisie dans au moins un champ");
                return $response;
                }
            else{
                $this->validation();
                return $renderer->render($response, 'accueil.php'); 
        }
    }

    public function validation(){
        $prescription = new Prescription();
        $patient = $this->entityManager->find(Patient::class, 1); // $idPatient = 1 - simulation
        $medecin = $this->entityManager->find(Medecin::class, 3); // $idPatient = 1 - simulation
        $prescription->setNomMedicament($this->donnees['nomMedicament']);
        $prescription->setMedecin($medecin);
        $prescription->setPatient($patient);
        $prescription->setPosologie($this->donnees['posologie']);
        // changement de la string (DD/MM/YYYY) dateDeDebut en DateTime (YYYY/MM/DD)
        $dateDeDebutObject = DateTime::createFromFormat('d/m/Y', $this->donnees['dateDeDebut']);
        $prescription->setDateDeDebut($dateDeDebutObject);
        // changement de la string (DD/MM/YYYY) dateDeFin en DateTime (YYYY/MM/DD)
        $dateDeFinObject = DateTime::createFromFormat('d/m/Y', $this->donnees['dateDeFin']);
        $prescription->setDateDeFin($dateDeFinObject);
        try{
            $this->entityManager->persist($prescription);
            $this->entityManager->flush();
        }
            catch (Exception $e) {
            echo 'Erreur de transfert: '. $e->getMessage(), "\n";
        }
    }
}

