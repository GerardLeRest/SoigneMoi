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
            <form action="/soignemoi-web/formulaireConnexion" method="post">
                <div class="row justify-content-center">
                <div class="mb-2 col-lg-5 col-md-8 col-xs-12 ">
                    <label for="email" class="form-label">Adresse Email</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="prenom.nom@exemple.fr">
                <br>
                <div class="mb-2 col-lg-8 col-md-12 ">
                    <label for="motDePasse" class="form-label">Password</label>
                    <input type="password" id="motDePasse" class="form-control" aria-describedby="passwordHelpBlock" name="motDePasse" required>
                </div>    
                <br>
            <div class="col-lg-10 col-md-12 col-xs-12 md-5 offse-2 text-center">
              <button type="submit" class="btn bouton-perso">Valider</button>
            </div>
            </form>  
            <!-- affichage des erreurs -->
            <br>
            <div class="row">
                 <?php
                    if (isset($errors) && count($errors) > 0) {
                        foreach ($errors as $cle => $valeur) {
                            // htmlspecialchars: échappement des caractères - < est converti en son équivalent HTML &lt;
                            echo htmlspecialchars($cle) . ": " . htmlspecialchars($valeur) . '<br>';
                        }
                    }
                ?>
            </div>
        </main> 
        <!-- bas de page-->
        <footer>
            <?php require_once('commun/footer.php'); ?>
        </footer>
    </body>
</html>

    
