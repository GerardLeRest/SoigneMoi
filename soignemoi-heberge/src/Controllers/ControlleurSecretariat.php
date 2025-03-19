<?php

namespace App\Controllers;

use Doctrine\ORM\EntityManager;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use DateTime; // Add this line to import the DateTime class


class ControlleurSecretariat
{
    private EntityManager $entityManager; 
    private array $donnees; //données de la requête
  

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    //tous
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
            return $this->transformationJSON($this->donnees, $response);
        } catch( Exception $e){ 
            $response->getBody()->write("Erreur: " . $e->getMessage());
            return $response;
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
            return $this->transformationJSON($this->donnees, $response);
        } catch(Exception $e){
            $response->getBody()->write("Erreur: " . $e->getmessage());
            return $response;
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
        return $this->transformationJSON($this->donnees, $response);
        } catch (Exception $e){
            $response->getBody()->write("Erreur: " . $e->getmessage());
            return $response;
        }    
    }

    public function transformationJSON($tableau, Response $response ) : Response 
    {
        $donneesJSON = json_encode($tableau);
        $response->getBody()->write($donneesJSON); 
        return $response->withHeader('Content-Type', 'application/json');
    }

    //---------------------------------------------------------------------------------------------------

    public function details (Request $request, Response $response, array $args) : Response
    {
        try{
            $id = $args['id'];
            //------------------------------------------------------------------------------------------      
            //Sejour
            $querySejours = $this->entityManager->createQuery('
            SELECT p.prenom, p.nom, s.dateDebut, s.dateFin, s.motifSejour, s.specialite, s.medecinSouhaite,
                    p.email
            FROM App\Models\Patient p
            JOIN p.sejours s
            WHERE p.idPatient = :idPatient
            ');
            $querySejours->setParameter('idPatient', $id);    
            $this->donnees = $querySejours->getResult();
            
            // transformation des dates sur tous les enregistrements
            // !!! avec & toute modification apportée à $donnee sera directement appliquée à $this->donnees dans le tableau.
            foreach ($this->donnees as &$donnee) {
                // Les objets DateTime retournés par Doctrine sont déjà des objets DateTime, donc pas besoin de reconversion
                $donnee['dateDebut'] = $donnee['dateDebut']->format('Y-m-d');
                $donnee['dateFin'] = $donnee['dateFin'] ? $donnee['dateFin']->format('Y-m-d') : null;
            }
            
            $tableauSejours = $this->donnees;
           
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
            
            $tableauMedecins = $this->donnees;
            
            //------------------------------------------------------------------------------------------  
            // Avis
            $queryAvis = $this->entityManager->createQuery('
            SELECT m.nom, m.prenom, av.date, av.libelle, av.description
            FROM App\Models\Patient p
            JOIN p.aviss av
            JOIN av.medecin m
            WHERE p.idPatient = :idPatient
            ');
            $queryAvis->setParameter('idPatient', $id);
            $this->donnees = $queryAvis->getResult();
            // transformation des dates sur tous les enregistrements
            foreach ($this->donnees as &$donnee) {
                $donnee['date'] = $donnee['date']->format('Y-m-d');
            }
            
            $tableauAvis = $this->donnees;
            
            //------------------------------------------------------------------------------------------      
            // Prescriptions
            $queryPrescriptions = $this->entityManager->createQuery('
            SELECT m.prenom, m.nom, pr.nomMedicament, pr.posologie, pr.dateDeDebut, pr.dateDeFin
            FROM App\Models\Patient p
            JOIN p.prescriptions pr
            JOIN pr.medecin m
            WHERE p.idPatient = :idPatient  
            ');
            $queryPrescriptions->setParameter('idPatient', $id);    
            $this->donnees = $queryPrescriptions->getResult();
            // transformation des dates sur tous les enregistrements
            foreach ($this->donnees as &$donnee) {
                $donnee['dateDeDebut'] = $donnee['dateDeDebut']->format('Y-m-d');
                $donnee['dateDeFin'] = $donnee['dateDeFin'] ? $donnee['dateDeFin']->format('Y-m-d') : null;
            }
                           
            $tableauPrescriptions = $this->donnees;

            $tableauFinal = [$tableauSejours,$tableauMedecins, $tableauPrescriptions, $tableauPrescriptions];

            $donneesJSON = json_encode($tableauFinal);
            $response->getBody()->write($donneesJSON); 
            return $response->withHeader('Content-Type', 'application/json');        
        
        } catch (Exception $e){
                $response->getBody()->write("Erreur: " . $e->getmessage());
                return $response;
                }    
    }
}