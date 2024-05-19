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
    private int $idMedecin;
    
    public function __construct (EntityManager $entityManager){
        $this->entityManager = $entityManager;
    }

    public function verification (Request $request, Response $response, array $Args ){
        $renderer = new PhpRenderer(__DIR__ . '/../Views'); //création de l'instance $renderer
        //$donnees = $request->getParsedBody();
        $donnees = ['libelle'=>'titre', 'prenom'=>'Marie', 'nom'=>'Curie', 'date'=>'18/05/2024', 'description'=>'mal de genou'];
        $libelle = $donnees['libelle'];
        $prenom = $donnees["prenom"];
        $nom = $donnees["nom"];
        $date = $donnees['date'];
        $description = $donnees['description'];

        //récupération de l'id idMedcin
        try{
            $query = $this->entityManager->createQuery('SELECT m.idMedecin FROM App\Models\Medecin m WHERE m.prenom=:prenom AND m.nom=:nom');
            $query->setParameter('prenom',$prenom);
            $query->setParameter('nom',$nom);
            $ligne = $query->getOneOrNullResult();
            $this->idMedecin = $ligne['idMedecin'];
                        
            //Vérification des données
            if(!isset($libelle) || empty($libelle)
                || !isset($prenom) || empty($prenom)
                || !isset($nom) || empty($nom)
                || !isset($date) || empty($date)
                || !isset($description) || empty($description)){
                    $response->getBody()->write("erreur de saisie dans au moins un formulaire");
                    return $response;
                }
            else{
                $this->validation();
                return $renderer->render($response, 'accueil.php'); 
            }
        }catch (Exception $e){
            $response->getBody()->write("Erreur: " . $e->getmessage());
            return $response;
        }   
    }

    public function validation(){
        $avis = new Avis();
        $donnees = ['libelle'=>'titre', 'prenom'=>'Marie', 'nom'=>'Curie', 'date'=>'18/05/2024', 'description'=>'mal de dos'];
        $patient = $this->entityManager->find(Patient::class, 1); // $idPatient = 1 - simulation
        $medecin = $this->entityManager->find(Medecin::class, $this->idMedecin);
        $avis->setLibelle($donnees['libelle']);
        $avis->setMedecin($medecin);
        $avis->setPatient($patient);
        // changement de la string (DD/MM/YYYY) date en DateTime (YYYY/MM/DD)
        $dateObject = DateTime::createFromFormat('d/m/Y', $donnees['date']);
        $avis->setDate($dateObject);
        $avis->setDescription($donnees['description']);
        try{
            $this->entityManager->persist($avis);
            $this->entityManager->flush();
        }
            catch (Exception $e) {
            echo 'Erreur de transfert: '. $e->getMessage(), "\n";
        }
    }
}
