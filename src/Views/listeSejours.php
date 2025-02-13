<!doctype html>
<html lang="fr">
    <?php require_once('commun/head.php'); ?>

    <body class="d-flex flex-column min-vh-100">
        <?php require_once('commun/header.php'); ?>

        <main class="container">
            <br><br><br>
            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Date de début</th>
                            <th scope="col">Date de fin</th>
                            <th scope="col">Motif du Séjour</th>
                            <th scope="col">Spécialité</th>
                            <th scope="col">Médecin souhaité</th>
                        </tr>
                    </thead>
                    <tbody id="tbodySejours">
                        <!-- Les lignes seront insérées ici via JavaScript -->
                    </tbody>
                </table>
            </div>
        </main>

        <!-- Pied de page -->
        <?php require_once('commun/footer.php'); ?>

        <script>
            const donneesJSON = <?php echo json_encode($donnees, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); ?>;
            const tbody = document.getElementById("tbodySejours");

            if (Array.isArray(donneesJSON) && donneesJSON.length > 0) {
                donneesJSON.forEach(item => {
                    const dateDebut = item.dateDebut ? new Date(item.dateDebut).toLocaleDateString("fr-FR") : 'Non spécifiée';
                    const dateFin = item.dateFin ? new Date(item.dateFin).toLocaleDateString("fr-FR") : 'Non spécifiée';
                    const medecinSouhaite = item.medecinSouhaite || 'Non spécifié';

                    const row = `<tr>
                        <td>${dateDebut}</td>
                        <td>${dateFin}</td>
                        <td>${item.motifSejour}</td>
                        <td>${item.specialite}</td>
                        <td>${medecinSouhaite}</td>
                    </tr>`;

                    tbody.insertAdjacentHTML("beforeend", row);
                });
            }
        </script>
    </body>
</html>

