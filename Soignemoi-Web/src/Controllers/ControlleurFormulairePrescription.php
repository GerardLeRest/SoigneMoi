<?php

namespace App\Controllers;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;
use App\Models\Prescription;
use App\Models\Patient;
use App\Models\Medecin;
use DateTime; 

class ControlleurFormulairePrescription{

    private EntityManager $entityManager;
    private array $donnees;
    //private donnees = ["nomMedicament"=>"Levthyrox", "posologie"=>"2 fois par jour", "dateDeDebut"=>"20/5/2024", "dateDeFin"=>"27/06/2024"];
   
    public function __construct (EntityManager $entityManager){
        $this->entityManager = $entityManager;
    }

    public function verification (Request $request, Response $response, array $Args ) : Response{
        $this->donnees = $request->getParsedBody();
        $nomMedicament = $this->donnees['nomMedicament'];
        $posologie = $this->donnees['posologie'];
        $dateDeDebut = $this->donnees["dateDeDebut"];
        $dateDeFin = $this->donnees["dateDeFin"];
        $idMedecin = (int)$this->donnees['idMedecin'];  // transformation de la chaine de caravtère en entier    
        $idPatient = (int)$this->donnees['idPatient'];  // transformation de la chaine de caravtère en entier   
                        
        //Vérification des données
        if(!isset($nomMedicament) || empty($nomMedicament)
            || !isset($posologie) || empty($posologie)
            || !isset($dateDeDebut) || empty($dateDeDebut)
            || !isset($dateDeFin) || empty($dateDeFin)
            || !isset($idMedecin) || empty($idMedecin)
            || !isset($idPatient) || empty($idPatient)){
            $response->getBody()->write("erreur de saisie dans au moins un champ");
            }                
        else{
            $this->validation($response, $nomMedicament, $posologie, $dateDeDebut, $dateDeFin, $idMedecin, $idPatient );    
            $response->getBody()->write("les champs sont bien complétés");         
        }
        return $response;
    }

    public function validation(Response $response, string $nomMedicament, string $posologie, string $dateDeDebut, string $dateDeFin, int $idMedecin, int $idPatient) : Response
    {
        $prescription = new Prescription();
        // simulation:
        //$patient = $this->entityManager->find(Patient::class, 1); // $idPatient = 1 - simulation
        //$medecin = $this->entityManager->find(Medecin::class, 3); // $idPatient = 1 - simulation
        $prescription->setNomMedicament($nomMedicament);

        // Récupération des entités Patient et Medecin
        $patient = $this->entityManager->find(Patient::class, $idPatient);
        $medecin = $this->entityManager->find(Medecin::class, $idMedecin);

        $prescription->setMedecin($medecin);
        $prescription->setPatient($patient);
        $prescription->setPosologie($posologie);
        // changement de la string (DD/MM/YYYY) dateDeDebut en DateTime (YYYY/MM/DD)
        $dateDeDebutObject = DateTime::createFromFormat('d/m/Y', $dateDeDebut);
        $prescription->setDateDeDebut($dateDeDebutObject);
        // changement de la string (DD/MM/YYYY) dateDeFin en DateTime (YYYY/MM/DD)
        $dateDeFinObject = DateTime::createFromFormat('d/m/Y', $dateDeFin);
        $prescription->setDateDeFin($dateDeFinObject);
        try{
            $this->entityManager->persist($prescription);
            $this->entityManager->flush();
            $response->getBody->write("données enregistrées");
            return $response;
        }
        catch (Exception $e) {
            $response->getBody->write('Erreur de transfert: '. $e->getMessage());
            return $response;
        }
    }
}

