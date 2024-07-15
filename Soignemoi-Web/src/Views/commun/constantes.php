<?php 

$liensURL = ['href="accueil"', 'hreF="services"', 'href="patients"', 'href="professionnels"',
             'href="listeSejours"', 'href="formulaireSejour"','href="formulaireConnexion"'];
   
$titres = ["Accueil", "Services", "Patients", "Professionnels", "Liste des séjours", "Créer un séjour", "Connexion"];

$titrePrincipaux = ["Hôpital SoigneMoi","Services", "Patients", "Professionnels", "Espace Utilisateur", "Créer un séjour", "Connexion"];

$indice = 0; //indice du menu

// détermination de la page courante - nom du fichier de la page courante sans extension
$pageCourante = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), ".php");

// détermination de l'indice $indice servant à se repérer dans le menu
for($i = 0; $i < count($liensURL); $i++){
    $NomDuFichierActuel = substr($liensURL[$i], 6, -1); // enlève href=" et le dernier "
    if ($pageCourante === $NomDuFichierActuel){
        //cas normal
        if (!isset($urlr)){ 
            $liensURL[$i] = 'aria-current="#"';
            $indice = $i;
        }
        // renvoi vers la page d'accueil (formulaires web)
        else{
            $liensURL[0] = 'aria-current="#"';
            $indice = 0;
        }
        
        break; // sortir de la boucle une fois la page courante trouvée
    }
}
