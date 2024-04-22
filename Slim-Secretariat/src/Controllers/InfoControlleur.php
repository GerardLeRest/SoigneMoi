<?php

namespace App\Controllers;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class InfoControlleur
{
    private  $entityManager;

    public function __construct(EntityManager $entityManager){
        $this->entityManager = $entityManager;
    }
            public function tableau(Request $request, Response $response , array $args) : Response
    {
        //$query = $this->entityManager->createQuery('SELECT p.prenom, p.nom, p.adressePostale FROM App\Models\Patient p WHERE p.idPatient = :id');
        //$query = $this->entityManager->createQuery('SELECT p.idPatient, p.prenom, p.nom, p.adressePostale FROM App\Models\Patient p');        //ne marhe pas:
        //$query = $this->entityManager->createQuery("SELECT a FROM App\Models\Avis a");
        // jointure Patient-Sejour:
        //$query =$this->entityManager->createQuery('SELECT p.nom,p.prenom, s.idSejour, s.specialite FROM App\Models\Patient p JOIN p.sejours s ');
        // requête tableau Python
        //$query = $this->entityManager->createQuery('SELECT p.idPatient, p.prenom, p.nom, p.adressePostale FROM App\Models\Patient p');        
        // jointure Medecin-Avis
        //$query = $this->entityManager->createQuery('SELECT m.prenom,m.nom, a.libelle, a.description FROM App\Models\Medecin m JOIN m.aviss a');        
        // jointure Medecin-Prescrition
        //$query = $this->entityManager->createQuery('SELECT m.prenom, m.nom, p.nomMedicament, p.posologie FROM App\Models\Medecin m JOIN m.prescriptions p'); 
        //jointure Patients-Medecins
        $query = $this->entityManager->createQuery('SELECT p.email, p.adressePostale, m.prenom, m.nom FROM App\Models\Auscultation a JOIN a.medecin m JOIN a.patient p'); 
        $patientsData = $query->getResult();
        $query =$this->entityManager->createQuery('Select p.nom FROM App\Models\Patient p');
        array_push($patientsData,$query->getResult());
        $patientJSON = json_encode ($patientsData); // conversion au format JSON
        $response->getBody()->write($patientJSON); 
        return $response->withHeader('Content-Type', 'application/json');
        //p.nom, p.prenom, p.motDePasse,p.email, p.adressePostale
        //, s.dateDebut, s.motifSejour, s.specialite, s.medecinSouhaite , s.dateDebut, s.motifSejour, s.specialite, s.medecinSouhaite 
        //JOIN p.sejours s
    }
}