<!doctype html>
<html lang="fr">
    <?php require_once('commun/head.php'); ?>
    
    <body class="d-flex flex-column min-vh-100">
        <?php require_once('commun/header.php'); ?>
        <main  class="container">
            <br>
            <br>
            <br>
            <row>
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Date de début</th>
                            <th scope="col">Date de fin</th>
                            <th scope="col">Motif du Séjour</th>
                            <th scope="col">Spécialité</th>
                            <th scope="col">Médecin souhaité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <script>
                            // Encodage du tableau PHP en JSON pour le rendre disponible en JavaScript
                            const donneesJSON = <?php echo json_encode($donnees); ?>;
                            console.log(donneesJSON);
                            
                            // Parcourir les données et écrire chaque ligne
                            donneesJSON.forEach(function(item) {
                                const dateDebut = new Date(item.dateDebut);
                                const dateFin = item.dateFin ? new Date(item.dateFin) : null;
                                const medecinSouhaite = item.medecinSouhaite || 'Non spécifié';

                                // Début de la ligne
                                document.write('<tr>');

                                // Colonne pour la date de début
                                document.write('<td>' + dateDebut.toLocaleDateString() + '</td>');

                                // Colonne pour la date de fin
                                document.write('<td>' + (dateFin ? dateFin.toLocaleDateString() : 'Non spécifiée') + '</td>');

                                // Colonne pour le motif du séjour
                                document.write('<td>' + item.motifSejour + '</td>');

                                // Colonne pour la spécialité
                                document.write('<td>' + item.specialite + '</td>');

                                // Colonne pour le médecin souhaité
                                document.write('<td>' + medecinSouhaite + '</td>');

                                // Fin de la ligne
                                document.write('</tr>');
                            });

                            // Fermeture de la table
                        </script>
                    </tbody>
                </table>
            </row>
        </main>
        <!-- pied de page -->
        <?php require_once('commun/footer.php'); ?>
    </body>
</html> 
