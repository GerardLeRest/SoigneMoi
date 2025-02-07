<!doctype html>
<html lang="fr">
    <?php require_once('commun/head.php'); ?>
    <body class="d-flex flex-column  min-vh-100">
        <?php require_once('commun/header.php'); ?>
        <main class="container flex-grow-1">
            <div class="row text-center">
            </div>
            <br>
            <br>
            <form action="/slim-soignemoi/formulaireConnexion" method="post">
                <div class="row justify-content-center">
                    <!-- adresse email -->
                    <div class="mb-2 col-lg-5 col-md-8 col-xs-12 ">
                        <label for="email" class="form-label">Adresse Email</label>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="prenom.nom@exemple.fr">
                    <br>
                    <!--mot de passe -->
                    <div class="mb-2 col-lg-8 col-md-12 ">
                        <label for="motDePasse" class="form-label">Password</label>
                        <input type="password" id="motDePasse" class="form-control" aria-describedby="passwordHelpBlock" name="motDePasse" required>
                    </div>    
                    <br>
                    <div class="col-lg-10 col-md-12 col-xs-12 md-5 offse-2 text-center">
                        <button type="submit" class="btn bouton-perso">Valider</button>
                </div>
            </form>  

            <!-- Inclusion du fichier php -erreurs.php -->
            <?php require_once('erreurs.php'); ?>    

        </main> 

        <!-- pied de page -->
        <?php require_once('commun/footer.php'); ?>

        <!-- Script JavaScript pour la gestion des erreurs -->
        <script src="assets/js/afficherErreurs.js"></script>
        <script>
            // Injection du tableau JSON dans une variable JavaScript
            const erreursDeValidation = <?php echo json_encode($erreurs); ?>;
            // appel de la fonction afficherErreurs
            afficherErreurs(erreursDeValidation);
        </script>

    </body>
</html>

    
