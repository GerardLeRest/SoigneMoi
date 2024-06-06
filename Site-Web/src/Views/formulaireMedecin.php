<!doctype html>
<html lang="fr">
    <?php require_once('commun/head.php'); ?>
    <body class="d-flex flex-column min-vh-100 ">
        <?php require_once('commun/header.php'); ?>
        <main class="container">
            <div class="row text-center">
                <div class="col-12">
                    <br>
                    <h4>Médecins</h4>
                    <br>
                </div>
            </div>
            <form action="/formulaireMedecin" method="post">
                <div class="row justify-content-center">
                    <div class="mb-2 col-lg-6 col-md-12 col-xs-12">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="mb-2 col-lg-6 col-md-12 col xs-12">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                </div>
                <div class="mb-2 col-lg-8 col-md-10 col-xs-12">
                    <label for="specialite" class="form-label">Spécialité</label>
                    <input type="text" class="form-control" id="specialite" name="specialite" required>
                </div>
                <div class="mb-2 col-lg-8 col-md-10 col-xs-12">
                    <label for="matricule" class="form-label">Matricule</label>
                    <input type="text" class="form-control" id="matricule" name="matricule" required>
                </div>
                <br>
                <div class="col-lg-12 col-md-12 col-xs-12 md-5 text-center">
              <button type="submit" class="btn bouton-perso">Valider</button>
            </div>
            </form>  
            <div class = "row">
                <!-- affichage des erreurs -->
                <?php
                    if (isset($errors) && count($errors) > 0) {
                        foreach ($errors as $cle => $valeur) {
                            // htmlspecialchars: échappement des caractères - < est converti en son équivalent HTML &lt;
                            echo htmlspecialchars($cle) . ": " . htmlspecialchars($valeur) . '<br>';
                        }
                    }
                ?>
            <</div>
        </main> 
        <footer class="mt-auto">
            <!-- bas de page-->
            <?php require_once('commun/footer.php'); ?>
        </footer>
    </body>
</html>
