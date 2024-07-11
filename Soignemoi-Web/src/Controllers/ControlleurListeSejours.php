<?php

namespace  App\Controllers;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
use Exception;

    class ControlleurListeSejours{

        private EntityManager $entityManager;
        private array $donnees;

            public function __construct(EntityManager $entityManager){
                $this->entityManager = $entityManager; 
            }    

            public function requeteSejours(Request $request, Response $response, array $args) : Response 
            {
                $renderer = new PhpRenderer(__DIR__ . '/../Views'); //création de l'instance $renderer
                $id=1;
                
                try{
                    $query = $this->entityManager->createQuery('SELECT s.dateDebut, s.dateFin, s.motifSejour, s.specialite,
                                                                s.medecinSouhaite FROM App\Models\Patient p JOIN p.sejours s WHERE p.idPatient =:id');
                    $query->setParameter('id', $id);   
                    $this->donnees = $query->getResult(); 
                } catch (Exception $e) {
                    $response->getBody()->write("Erreur: " . $e->getMessage());
                    return $response;
                }
                 
                return $renderer->render($response,'listeSejours.php', ['donnees' => $this->donnees]);
            }
    }
