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
        $erreurs = [];
        $this->donnees = $request->getParsedBody();
        $dateDebut = $this->donnees['dateDebut'];
        $dateFin = $this->donnees['dateFin'];
        $motifSejour = $this->donnees['motifSejour'];
        $specialite = $this->donnees['specialite'];
        $medecinSouhaite = $this->donnees['medecinSouhaite'];
        if (isset($this->donnees['pasDateFin'])){
            $pasDateFin = $this->donnees['pasDateFin'];
        }
        else{
            $pasDateFin = null;
        }
 
        
        // Données de test
        /* $dateDebut = "";
        $dateFin = "";
        $motifSejour = "";
        $specialite = "";
        $medecinSouhaite = ""; */

        //tests
        if (!isset($dateDebut) || empty($dateDebut)){
            $erreurs['dateDebut'] = "la date de début n'a pas été saisie";
        }
        if (!isset($motifSejour) || empty($motifSejour)){
            $erreurs['motifSejour'] = "le motif de séjour n'a pas été saisie";
        }
        if (!isset($specialite) || empty($specialite)){
            $erreurs['specialite'] = "la specialite n'a pas été saisie";
        }
        if (!isset($medecinSouhaite) || empty($medecinSouhaite)){
            $erreurs['smedecinSouhaite'] = "le medecin souhaité n'a pas été saisie";
        }

        if ($pasDateFin){
            $dateFin =''; // null ne passe pas à ce niveau
        }

        // traitement des erreurs
        if (count($erreurs)>0){
            return $renderer ->render($response,'formulaireSejour.php', ['erreurs' => $erreurs]);
            }
        else{
            $this->validation($response, $dateDebut, $dateFin, $motifSejour, $specialite, $medecinSouhaite);
            return $renderer->render($response, 'accueil.php', ['urlr' => 0]); //urlr : voir page constantes.php
        }
    }

        public function validation(Response $response, string $dateDebut, string $dateFin, string $motifSejour, string $specialite, string $medecinSouhaite) : Response
        {
            $sejour =  new Sejour;
            // transformation en format dateTime
            $dateDebut = new DateTime($dateDebut);
            //affectation de $dateDebut
            $sejour->setDateDebut($dateDebut);
            // DateFin -envoyé uniquement si la valeur de fin a été renseigné
        if (!empty($dateFin)) {
            $dateFin = new DateTime($dateFin);
            $sejour->setDateFin($dateFin);
        }
            // Remove the redundant line
            // Motif du séjour
            $sejour->setMotifSejour($motifSejour);
            $sejour->setSpecialite($specialite);
            $sejour->setMedecinSouhaite($medecinSouhaite);

            $patient = $this->entityManager->find(Patient::class, 1); // $idPatient = 1 - simulation
            $sejour->setPatient($patient);
             
            try{
                $this->entityManager->persist($sejour);
                $this->entityManager->flush();
                $response->getBody()->write(" ");
                return $response;
            }
                catch (Exception $e) {
                echo 'Erreur de transfert: ', $e->getMessage(), "\n";
            }
        }
    }
