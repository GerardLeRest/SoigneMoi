<?php

namespace App\Controllers;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;
use Slim\Views\PhpRenderer;

class ControlleurFormulaireConnexion
{
    private EntityManager $entityManager;
    private array $donnees;
    private array $erreurs;
    private PhpRenderer $renderer;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->renderer = new PhpRenderer(__DIR__ . '/../Views'); // création de l'instance $renderer
        $this->erreurs = []; // Initialisation du tableau d'erreurs
    }

    public function verification(Request $request, Response $response, array $args): Response
    {
        // récupération des données
        $this->donnees = $request->getParsedBody();
        // affectation des variables
        $email = $this->donnees['email'];
        $motDePasse = $this->donnees['motDePasse'];

        // Adresse Email
        if (empty($email) || !isset($email)) {
            $this->erreurs["saisieEmail"] = 'Le champ "Adresse Email" n\'a pas été saisi';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->erreurs['validiteEmail'] = "Le format de l'adresse e-mail n'est pas valide.";
        }

        // mot de passe
        if (empty($motDePasse) || !isset($motDePasse)) {
            $this->erreurs['saisieMotDePasse'] = "Le mot de passe n'a pas été saisi";
        }

        if (count($this->erreurs) > 0) {
            return $this->affichageErreurs($response);
        } else {
            return $this->validation($response, $email, $motDePasse);
        }
    }

    public function validation(Response $response, string $email, string $motDePasse): Response
    {
        // Récupération de l'utilisateur par l'email
        try {
            $query = $this->entityManager->createQuery('SELECT p FROM App\Models\Patient p WHERE p.email = :email');
            $query->setParameter('email', $email); // Liaison du paramètre
            $utilisateur = $query->getOneOrNullResult();

            if (!$utilisateur) {
                $this->erreurs['erreurSaisie1'] = "L'email ou le mot de passe est incorrect.";
            } else {
                // vérification du mot de passe
                $motDePasseHache = $utilisateur->getMotDePasse();
                if (password_verify($motDePasse, $motDePasseHache)) {
                    // mot de passe correct
                    return $this->renderer->render($response, 'accueil.php', ['urlr' => 0]); //urlr : voir page constantes.php
                } else {
                    // mot de passe incorrect
                    $errors['ErreurSaisie2'] = "L'email ou le mot de passe est incorrect.";
                    $this->erreurs['ErreurSaisie2'] = "L'email ou le mot de passe est incorrect.";
                }
            }
        } catch (Exception $e) {
            $response->getBody()->write("Erreur: " . $e->getMessage());
            return $response;
        }
        return $this->affichageErreurs($response);
    }

    public function affichageErreurs(Response $response): Response
    {
        // traitement des erreurs
        if (count($this->erreurs) > 0) {
            return $this->renderer->render($response, 'formulaireConnexion.php', ['erreurs' => $this->erreurs]);
        } else {
            return $this->renderer->render($response, 'accueil.php');
        }
    }
}
