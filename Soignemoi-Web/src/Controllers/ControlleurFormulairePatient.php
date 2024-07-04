<?php

namespace  App\Controllers;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Patient;
use Exception;
use Slim\Views\PhpRenderer;

class ControlleurFormulairePatient{

    private EntityManager $entityManager;
    private array $donnees =[];

    public  function __construct(EntityManager $entityManager){
        $this->entityManager = $entityManager;
    }   

    public function verification(Request $request, Response $response, array $args): Response
    {
        $renderer = new PhpRenderer(__DIR__ . '/../Views'); //création de l'instance $renderer
        // récupération des données
        $this->donnees = $request->getParsedBody();
        // affectation des variables
        $prenom = $this->donnees['prenom'];
        $nom = $this->donnees['nom'];
        $adressePostale = $this->donnees["adressePostale"];
        $email = $this->donnees['email'];
        $motDePasse = $this->donnees["motDePasse"];
        $motDePasseHache="";
        $errors =[];
        
        // Données de test
       /*  $prenom = "";
        $nom = "";
        $adressePostale = "";
        $email = "";
        $motDePasse = ""; */

        // Prenom
        if (!isset($prenom) || empty($prenom)){
            $errors["prenom"] = 'le champs "Prénom" n\'a pas été rempli';
        }

        // nom
        if (!isset($nom) || empty($nom)){
            $errors["nom"] = 'le champs "Nom" n\'a pas été rempli';
        }
        
        // Adresse postale
        if (!isset($adressePostale) || empty($adressePostale)){
            $errors["adressePostale"] = 'le champs "Adresse Postale" n\'a pas été rempli';
        }
    
        //Adresse Email
        if (!isset($email) || empty($email)){
            $errors["email"] = 'le champs "Adresse Email" n\'a pas été rempli';
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Le format de l'adresse e-mail n'est pas valide.";
        }
        // présence d'un email identique
        else{
            $query = $this->entityManager->createQuery('Select p.email from App\Models\Patient p WHERE p.email = :email');
            $query->setParameter('email',$email);
            $emaiIdentique = $query->getOneOrNullResult();
            if (isset($emaiIdentique)){
                $errors['email'] = "votre email est déjà enregistré";
            }
        }
        // mot de passe
        //^: début de chaine - \d: au moins 1 nombre -?=.*[^a-zA-Z\d]: au moins un caractère spécial -{8-20}: mot de passe entre 8 et 20 carctères
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).{8,20}$/', $motDePasse)) { 
            $errors['password'] = "Le mot de passe doit contenir entre 8 et 20 caractères, incluant au moins une lettre minuscule, une lettre majuscule, un chiffre, et un caractère spécial.";
        }
        $motDePasseHache = password_hash($motDePasse, PASSWORD_DEFAULT); 
 
        if (count($errors)>0){
            return $renderer->render($response,'formulairePatient.php', ['errors' => $errors]);
            }
        else{
            $this->validation($response, $prenom, $nom, $adressePostale, $email, $motDePasseHache);
            return $renderer->render($response, 'accueil.php'); 
        }
    }

    public function validation(Response $response, string $prenom, string $nom, string $adressePostale, string $email, string $motDePasseHache) : Response
    {
        $patient = new Patient;
        $patient->setPrenom($prenom);
        $patient->setNom($nom);
        $patient->setAdressePostale($adressePostale);
        $patient->setEmail($email);
        $patient->setMotDePasse($motDePasseHache);
        //transfert des données du nouveau patient
        try{
            $this->entityManager->persist($patient);
            $this->entityManager->flush();
            $response->getBody()->write("données enregistrées");
            return $response;
        }
            catch (Exception $e) {
                $response->getBody()->write('Erreur de transfert: ', $e->getMessage(), "\n");
                return $response;
        }
    }
}