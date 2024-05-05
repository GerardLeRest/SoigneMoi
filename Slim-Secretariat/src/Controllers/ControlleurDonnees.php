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
                SELECT p.idPatient, p.prenom, p.nom, p.adressePostale
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
                SELECT p.idPatient, p.prenom, p.nom, p.adressePostale 
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
        try{
            $query = $this->entityManager->createQuery('
            SELECT p.idPatient, p.prenom, p.nom, p.adressePostale 
            FROM App\Models\Sejour s 
            JOIN s.patient p
            WHERE  s.dateFin = CURRENT_DATE()');
            
            $this->donnees = $query->getResult();
            $tableauSorties = $this->recuperationDonnees();        
            $donneesJSON = json_encode($tableauSorties);
            $response->getBody()->write($donneesJSON); 
            return $response->withHeader('Content-Type', 'application/json');
        } catch (Exception $e){
            $response->getBody()->write("Erreur: " . $e->getmessage());
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
        }    
    
    }

    public function details (Request $request, Response $response, array $args) : Response
    {
        try{
            $id = $args['id'];
        //------------------------------------------------------------------------------------------      
            //Sejour
            $querySejours = $this->entityManager->createQuery('
            SELECT s.dateDebut, s.dateFin, s.motifSejour, s.specialite, s.medecinSouhaite,
                   p.email
            FROM App\Models\Patient p
            JOIN p.sejours s
            WHERE p.idPatient = :idPatient
           ');
            $querySejours->setParameter('idPatient', $id);    
            $this->donnees = $querySejours->getResult();
           // Transformation des données en format JSON
            $tableauSejours = [];
            foreach ($this->donnees as $donnee) {
                $donnee['dateDebut'] = $donnee['dateDebut']->format('Y-m-d');
                $donnee['dateFin'] = $donnee['dateFin'] ? $donnee['dateFin']->format('Y-m-d') : null; //opérateur ternaire (condition)
                $tableauCoordonnees = [
                    'dateDebut' => $donnee['dateDebut'],
                    'dateFin' => $donnee['dateFin'],
                    'motifSejour' => $donnee['motifSejour'],
                    'specialiteSejour' => $donnee['specialite'],  
                    'medecinSouhaite' => $donnee['medecinSouhaite'],
                    'emailPatient' => $donnee['email']
                ];
                if (!in_array($tableauCoordonnees, $tableauSejours)) {  //élimine les doublons
                    array_push($tableauSejours, $tableauCoordonnees);
                }
            }
        //------------------------------------------------------------------------------------------  
            //Medecin
            $queryMedecins = $this->entityManager->createQuery('
            SELECT m.prenom, m.nom, m.matricule, m.specialite
            FROM App\Models\Auscultation a
            JOIN a.patient p
            JOIN a.medecin m
            WHERE p.idPatient = :idPatient
            ');
            $queryMedecins->setParameter('idPatient', $id);    
            $this->donnees = $queryMedecins->getResult();
            // Transformation des données en format JSON
            $tableauMedecins = [];
            foreach ($this->donnees as $donnee) {
                $tableauCoordonnees = [
                    'prenom' => $donnee['prenom'],
                    'nom' => $donnee['nom'],
                    'matricule' => $donnee['matricule'],
                    'specialiteMedecin' => $donnee['specialite'] 
                ];
                if (!in_array($tableauCoordonnees, $tableauMedecins)) {  //élimine les doublons
                    array_push($tableauMedecins, $tableauCoordonnees);
                }
            }
        //------------------------------------------------------------------------------------------  
            // Avis
            $queryAvis = $this->entityManager->createQuery('
            SELECT a.date, a.libelle, a.description
            FROM App\Models\Patient p
            JOIN p.aviss a
            WHERE p.idPatient = :idPatient
            ');
            $queryAvis->setParameter('idPatient', $id);    
            $this->donnees = $queryAvis->getResult();
            // Transformation des données en format JSON
            $tableauAvis = [];
            foreach ($this->donnees as $donnee) {
                // formatage de la date
                $donnee['date'] = $donnee['date']->format('Y-m-d');  //doit être dans cette boucle et non seul dans une boucle
                $tableauCoordonnees = [
                    'date' => $donnee['date'],
                    'libelle' => $donnee['libelle'],
                    'description' => $donnee['description']
                ];
                if (!in_array($tableauCoordonnees, $tableauAvis)) {  //élimine les doublons
                    array_push($tableauAvis, $tableauCoordonnees);
                }
            }
        //------------------------------------------------------------------------------------------      
            // Prescriptions
            $queryPrescriptions = $this->entityManager->createQuery('
            SELECT pr.nomMedicament, pr.posologie, pr.dateDeDebut, pr.dateDeFin
            FROM App\Models\Patient p
            JOIN p.prescriptions pr
            WHERE p.idPatient = :idPatient
            ');
            $queryPrescriptions->setParameter('idPatient', $id);    
            $this->donnees = $queryPrescriptions->getResult();
            // Transformation des données en format JSON
            $tableauPrescriptions = [];
            foreach ($this->donnees as $donnee) {
                // formatage des dates
                $donnee['dateDeDebut'] = $donnee['dateDeDebut']->format('Y-m-d');
                $donnee['dateDeFin'] = $donnee['dateDeFin']->format('Y-m-d');
                $tableauCoordonnees = [
                    'nomMedicament' => $donnee['nomMedicament'],
                    'posologie' => $donnee['posologie'],
                    'dateDeDebut' => $donnee['dateDeDebut'],
                    'dateDeFin' => $donnee['dateDeFin']
                ];
                if (!in_array($tableauCoordonnees, $tableauPrescriptions)) {  //élimine les doublons
                    array_push($tableauPrescriptions, $tableauCoordonnees);
                }
            }
            $tableauFinal = [$tableauSejours, $tableauMedecins, $tableauAvis, $tableauPrescriptions];
            //$tableauFinal = [$tableauPrescriptions];
            $donneesJSON = json_encode($tableauFinal);
            $response->getBody()->write($donneesJSON); 
            return $response->withHeader('Content-Type', 'application/json');        
        } catch (\Throwable $e){
                $response->getBody()->write("Erreur: " . $e->getmessage());
                return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
            }    
    }
    
}