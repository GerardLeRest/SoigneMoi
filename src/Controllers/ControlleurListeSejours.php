<?php

namespace  App\Controllers;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
use Exception;
use DateTime;

class ControlleurListeSejours {

    private EntityManager $entityManager;
    private array $donnees = [];

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function requeteSejours(Request $request, Response $response, array $args): Response {
        $renderer = new PhpRenderer(__DIR__ . '/../Views'); // création de l'instance $renderer
        $id = 1; // On simule uniquement pour le patient 1

        try {
            $query = $this->entityManager->createQuery(
                'SELECT s.dateDebut, s.dateFin, s.motifSejour, s.specialite, s.medecinSouhaite
                 FROM App\Models\Patient p
                 JOIN p.sejours s
                 WHERE p.idPatient = :id'
            );
            $query->setParameter('id', $id);
            $this->donnees = $query->getResult();

            $tableau = $this->creationTableau($this->donnees);
            return $renderer->render($response, 'listeSejours.php', ['donnees' => $tableau]);
        } catch (Exception $e) {
            $response->getBody()->write("Erreur: " . $e->getMessage());
        }

        return $response;
    }

    public function creationTableau(array $tab): array {
        $data = [];
        foreach ($tab as $element) {
            $data[] = [
                'dateDebut' => $element['dateDebut']->format('Y/m/d'),
                'dateFin' => isset($element['dateFin']) ? $element['dateFin']->format('Y/m/d') : "",
                'motifSejour' => $element['motifSejour'],
                'specialite' => $element['specialite'],
                'medecinSouhaite' => isset($element['medecinSouhaite']) ? $element['medecinSouhaite'] : "",
            ];
        }
        return $data;
    }
}
