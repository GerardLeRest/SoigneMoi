function afficherErreurs(erreursDeValidation){
    // Sélection de l'élément ul où les erreurs seront affichées
    const elementListeErreurs = document.getElementById('erreur-list');
    // Parcourir chaque erreur dans le tableau associatif et l'afficher
    for (const champ in erreursDeValidation) {
        // affectation du message d'erreur à erreurMessage
        const erreurMessage = erreursDeValidation[champ];
        //creation du <li>
        const elementListe = document.createElement('li');
        //ajout de erreurMessage dans le <li>
        elementListe.textContent = erreurMessage; 
        document.getElementById('erreur-list').appendChild(elementListe);
    }
}