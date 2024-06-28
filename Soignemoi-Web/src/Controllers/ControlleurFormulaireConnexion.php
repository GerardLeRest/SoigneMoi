<?php

namespace  App\Controllers;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;
use Slim\Views\PhpRenderer;


class ControlleurFormulaireConnexion{

    private EntityManager $entityManager;
    private array $donnees =[];

    public  function __construct(EntityManager $entityManager){
        $this->entityManager = $entityManager;
    }   

    public function verification(Request $request, Response $response, array $args): Response
    {
        $errors=[];
        $renderer = new PhpRenderer(__DIR__ . '/../Views'); //création de l'instance $renderer
        // récupération des données
        $this->donnees = $request->getParsedBody();
        // affectation des variables
        $email = $this->donnees['email'];
        $motDePasse =$this->donnees['motDePasse'];

        // test
        //Adresse Email
        if (!isset($email) || empty($email)){
            $errors["email1"] = 'le champs "Adresse Email" n\'a pas été rempli';
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email1'] = "Le format de l'adresse e-mail n'est pas valide.";
        }

        //mot de passe
        if (!isset($motDePasse) || empty($motDePasse)){
            $errors['motDePasse'] = "le mot de passe n'a pas été saisi";
        }
    
        //Recupération de l'utilisateur par l'email
        try {
            $query = $this->entityManager->createQuery('SELECT p FROM App\Models\Patient p WHERE p.email = :email');
            $query->setParameter('email', $email); // Liaison du paramètre
            $utilisateur = $query->getOneOrNullResult();

            if (!$utilisateur) {
                $errors['email2'] = "L'email ou le mot de passe est incorrect.";
            } else {
                // vérification du mot de passe
                $motDePasseHache = $utilisateur->getMotDePasse();
                if (password_verify($motDePasse, $motDePasseHache)) {
                    // Mot de passe correct
                    $response->getBody()->write("Connexion réussie");
                    return $response;
                } else {
                    $errors['motDePasse'] = "L'email ou le mot de passe est incorrect.";
                }
            }

            // traitement des erreurs
            if (count($errors) > 0) {
                return $renderer->render($response, 'formulaireConnexion.php', ['errors' => $errors]);
            } else {
                return $renderer->render($response, 'accueil.php'); 
            }

        } catch (Exception $e) {
            $response->getBody()->write("Erreur: " . $e->getMessage());
            return $response;
        }
    }
}
