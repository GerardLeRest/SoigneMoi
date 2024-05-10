<?php

namespace App\Controllers;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
use App\Models\Sejour;
use Exception;

class ControlleurFormulaireSejour{

    private array $donnees;
    private Entitymanager $entityManager;

    public function __construct(EntityManager $entityManager){
        $thisEntityManager = $entityManager;
    }

    public function verification(Request $request, Response $response, $args ){
        $renderer = new PhpRenderer(__DIR__ . '/../Views'); //création de l'instance $renderer
        $errors = [];
        $this->donnees = $request->getParsedBody();
        $dateDebut = $this->donnees['dateDebut'];
        $dateFin = $this->donnees['dateFin'];
        $motifSejour = $this->donnees['motifSejour'];
        $specialite = $this->donnees['specialite'];
        $medecinSouhaite = $this->donnees['medecinSouhaite'];

        $dateDebut="";
        $dateFin ="";
        $motifSejour = "";
        $specialite = "CHIRURGIE";
        $medecinSouhaite = "";

        //tests
        if (!isset($dateDebut) || empty($dateDebut)){
            $errors['dateDebut'] = "la date de début n'a pas été saisie";
        }
        if (!isset($dateFin) || empty($dateFin)){
            $errors['datefin'] = "la date de fin n'a pas été saisie";
        }
        if (!isset($motifSejour) || empty($motifSejour)){
            $errors['motifSejour'] = "le motif de séjour n'a pas été saisie";
        }
        if (!isset($specialite) || empty($specialite)){
            $errors['specialite'] = "la specialite n'a pas été saisie";
        }
        if (!isset($medecinSouhaite) || empty($medecinSouhaite)){
            $errors['medecinSouhaite'] = "le medecin souhaité n'a pas été saisie";
        }
        // traitement des erreurs
        if (count($errors)>0){
            return $renderer ->render($response,'formulairePatient.php', ['errors' => $errors]);
            }
        else{
            $this->validation();
        }
    }

        public function validation(){
            $sejour =  new Sejour;
            $sejour->setDateDebut($this->donnees['dateDebut']);
            $sejour->setDateFin(($this->donnees['dateFin']));
            $sejour->setMotifSejour($this->donnees['motifSejour']);
            $sejour->setSpecialite($this->donnees['specialite']);
            $sejour->setMedecinSouhaite($this->donnees['medecinSouhaite']);
            try{
                $this->entityManager->persist($sejour);
                $this->entityManager->flush();
            }
            catch (Exception $e) {
                echo 'Erreur de transfert: ', $e->getMessage(), "\n";
            }
        }
    }