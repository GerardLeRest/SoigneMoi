<?php 
$liensURL = ['href="accueil"', 'hreF="services"', 'href="patients"', 'href="professionnels"',
             'href="listeSejours"', 'href="formulaireSejour"','href="formulaireConnexion"'];
   
$titres = ["Accueil", "Services", "Patients", "Professionnels", "Liste les séjours", "Créer un séjour", "Connexion"];

$titrePrincipaux = ["Hôpital SoigneMoi","Services", "Patients", "Professionnels", "Espace Utilisateur", "Créer un séjour", "Connexion"];

$indice = 0; // indice de déplacement du tableau $footerURL

// détermination de la page courante - nom du fichier de la page courante sans extension
$pageCourante = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), ".php");

// remplacement de la valeur du tableau $liensURL de la page courante par 
for($i = 0; $i < count($liensURL); $i++){
    $NomDuFichierActuel = substr($liensURL[$i], 6, -1); // enlève href=" et le dernier "
    if ($pageCourante === $NomDuFichierActuel){
        $liensURL[$i] = 'aria-current="#"';
        $indice = $i;
        break; // sortir de la boucle une fois la page courante trouvée
        
    }
}