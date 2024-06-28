<?php

namespace App\Controllers;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;
use Slim\Views\PhpRenderer;
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

    public function verification (Request $request, Response $response, array $Args ){
        $renderer = new PhpRenderer(__DIR__ . '/../Views'); //création de l'instance $renderer
        $this->donnees = $request->getParsedBody();
        $libelle = $this->donnees['libelle'];
        $idPatient = $this->donnees["idPatient"];
        $date = $this->donnees['date'];
        $description = $this->donnees['description'];

        //Vérification des données
        if(!isset($libelle) || empty($libelle)
            || !isset($idPatient) || empty($idPatient)
            || !isset($date) || empty($date)
            || !isset($description) || empty($description)){
                $response->getBody()->write("erreur de saisie dans au moins un champ");
                return $response;
                }
            else{
                $this->validation();
                return $renderer->render($response, 'accueil.php'); 
            }
    }

    public function validation(){
        $avis = new Avis();
        $patient = $this->entityManager->find(Patient::class, $this->donnees["idPatient"]); 
        // récupération du patient ayant l'id  $this->donnees["idPatient"] 
        // ex: recuperation dunom echo "Nom du Patient : " . $patient->getNom() . "\n";
        $medecin = $this->entityManager->find(Medecin::class, 3); // $idPatient = 2 - simulation
        $avis->setLibelle($this->donnees['libelle']);
        $avis->setMedecin($medecin);
        $avis->setPatient($patient); 
        // changement de la string (DD/MM/YYYY) date en DateTime (YYYY/MM/DD)
        $dateObject = DateTime::createFromFormat('d/m/Y', $this->donnees['date']);
        $avis->setDate($dateObject);
        $avis->setDescription($this->donnees['description']);
        try{
            $this->entityManager->persist($avis);
            $this->entityManager->flush();
        }
            catch (Exception $e) {
            echo 'Erreur de transfert: '. $e->getMessage(), "\n";
        }
    }
}
