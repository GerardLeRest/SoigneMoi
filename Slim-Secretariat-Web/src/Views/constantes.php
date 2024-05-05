<?php 
$liensURL = ['href="accueil"', 'href = "services"', 'href = "patients"', 'href = "professionnels"'];
   
$titres = ["Accueil", "Services", "Patients", "Professionnels"];

$titrePrincipaux = ["Hôpital SoigneMoi","Services", "Patients", "Professionnels"];

$indice=0; //indice de déplacement du tableau $footerURL
    
// détermination de la page courante
$pageCourante = basename($_SERVER['PHP_SELF']); //nom du fichier de la page courante 'aria-current="#"'

// remplacement de la valeur du tableau $footerURL de la page courante par 
for($i=0; $i<count($liensURL); $i++){
    $NomDeFichierActuel = substr($liensURL[$i], 8, strlen($liensURL[$i])-9); // enlève http://
    if ($pageCourante === $NomDeFichierActuel){
        $liensURL[$i] = 'aria-current="#"';
        $indice = $i;
    }
}
