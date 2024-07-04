<?php

namespace  App\Controllers;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Medecin;
use Exception;
use Slim\Views\PhpRenderer;

class ControlleurFormulaireMedecin{

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
        $prenom = $this->donnees['nom'];
        $nom = $this->donnees['prenom'];
        $specialite = $this->donnees['specialite'];
        $matricule =$this->donnees['matricule'];

        // Données de test
       /*  $prenom = "";
        $nom = "";
        $specialite = "";
        $matricule =""; */

        // test
        if (!isset($prenom) || empty($prenom)){
            $errors['prenom'] = " le champ du prénom n'a pas été complété";
        }
        if (!isset($nom) || empty($nom)){
            $errors['nom'] = " le champ du nom n'a pas été complété";
        }
        if (!isset($specialite) || empty($specialite)){
            $errors['specialite'] = " le champ de la spécialité n'a pas été complété";
        }
        if (!isset($matricule) || empty($matricule)){
            $errors['matricule'] = " le champ du matricule n'a pas été complété";
        }
        // traitement des erreurs
        if (count($errors)>0){
            return $renderer->render($response,'formulaireMedecin.php', ['errors' => $errors]);
        }
        else{
            $this->validation($response, $prenom, $nom, $specialite, $matricule);
            return $renderer->render($response, 'accueil.php'); 
        }
    }

    public function validation(Response $response, string $prenom, string $nom, string $specialite, $matricule) : Response
    {
        $medecin = new Medecin;
        $medecin->SetPrenom($this->donnees['prenom']);
        $medecin->SetNom($this->donnees['nom']);
        $medecin->SetSpecialite($this->donnees['specialite']);
        $medecin->SetMatricule($this->donnees['matricule']);
        try{
            $this->entityManager->persist($medecin);
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
