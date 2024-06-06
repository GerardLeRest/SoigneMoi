<?php

namespace App\Controllers;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
use App\Models\Sejour;
use Exception;
use DateTime; 
use App\Models\Patient;

class ControlleurFormulaireSejour{

    private array $donnees;
    private Entitymanager $entityManager;

    public function __construct(EntityManager $entityManager){
        $this->entityManager = $entityManager;
    }

    public function verification(Request $request, Response $response, $args ) : Response
    {
        $renderer = new PhpRenderer(__DIR__ . '/../Views'); //création de l'instance $renderer
        $errors = [];
        $this->donnees = $request->getParsedBody();
        $dateDebut = $this->donnees['dateDebut'];
        $dateFin = $this->donnees['dateFin'];
        $motifSejour = $this->donnees['motifSejour'];
        $specialite = $this->donnees['specialite'];
        $medecinSouhaite = $this->donnees['medecinSouhaite'];

        // Données de test
        /* $dateDebut = "";
        $dateFin = "";
        $motifSejour = "";
        $specialite = "";
        $medecinSouhaite = ""; */

        //tests
        if (!isset($dateDebut) || empty($dateDebut)){
            $errors['dateDebut'] = "la date de début n'a pas été saisie";
        }
        if (!isset($motifSejour) || empty($motifSejour)){
            $errors['motifSejour'] = "le motif de séjour n'a pas été saisie";
        }
        if (!isset($specialite) || empty($specialite)){
            $errors['specialite'] = "la specialite n'a pas été saisie";
        }
        // traitement des erreurs
        if (count($errors)>0){
            return $renderer ->render($response,'formulaireSejour.php', ['errors' => $errors]);
            }
        else{
            $this->validation();
            $response->getBody()->write("la vérification est bonne");
            return $response;
        }
    }

        public function validation() : void
        {
            $sejour =  new Sejour;
            // transformation en format dateTime
            $dateDeDebut = new DateTime($this->donnees['dateDebut']);
            // affectation de la date
            $sejour->setDateDebut($dateDeDebut);
            // date de fin
            $dateDeFin = new DateTime($this->donnees['dateFin']);
            $sejour->setDateFin($dateDeFin);
            $sejour->setMotifSejour($this->donnees['motifSejour']);
            $sejour->setSpecialite($this->donnees['specialite']);
            $sejour->setMedecinSouhaite($this->donnees['medecinSouhaite']);

            $patient = $this->entityManager->find(Patient::class, 1); // $idPatient = 1 - simulation
            $sejour->setPatient($patient);
             
            try{
                $this->entityManager->persist($sejour);
                $this->entityManager->flush();
            }
                catch (Exception $e) {
                echo 'Erreur de transfert: ', $e->getMessage(), "\n";
            }
            }
    }