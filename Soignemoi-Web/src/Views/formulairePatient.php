<!doctype html>
<html lang="fr">

    <?php require_once('commun/head.php') ?>
    
    <body class="d-flex flex-column min-vh-100">

        <?php require_once('commun/header.php'); ?>
        
        <main class="container">
            <form action="/soignemoi-web/formulairePatient" method="post"> <!-- /slim-secretariat-web/formulairePatient : route -->
                <div class ="row text-center">
                    <div class="col-12">
                        <br>
                        <br>
                        <h4> Inscription</h4>
                        <br>
                    </div>
                </div>
                <br>
                <br>
                <div class ="row justify-content-center">
                    <div class="mb-2 col-lg-4 col-sm-6 col-xs-12 ">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name ="prenom" required>
                    </div>
                    <div class="mb-2 col-lg-4 col-sm-6 col-xs-12">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                </div>
                <div class="mb-2 col-lg-10 offset-lg-2 col-sm-12 col-xs-12">
                    <label for="adressePostale" class="form-label">Adresse Postale</label>
                    <input type="text" class="form-control" id="adressePostale" name="adressePostale" required>
                </div>
                <div class="mb-2 col-lg-5 offset-lg-2 col-sm-8 col-xs-12">
                    <label for="email" class="form-label">Adresse Email</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="prenom.nom@exemple.fr">
                </div>
                <div class="mb-2 col-lg-5 offset-lg-2 col-sm-8 col-xs-12">
                    <label for="motDePasse" class="form-label">Password</label>
                    <input type="password" id="motDePasse" class="form-control" aria-describedby="passwordHelpBlock" name="motDePasse" required>
                    <div id="motDePasse" class="form-text">
                        Le mot de passe doit contenir entre 8 et 20 caractères, incluant au moins une lettre minuscule, une lettre majuscule, un chiffre, et un caractère spécial.
                    </div>
                </div>    
                <br>
                <div class="col-12 text-center">
                    <button type="submit" class="btn bouton-perso">Valider</button>
                </div>
            </form>
            <div class ="row">
            <!-- affichage des erreurs -->
                <?php
                    if (isset($errors) && count($errors) > 0) {
                        foreach ($errors as $cle => $valeur) {
                            // htmlspecialchars: échappement des caractères - < est converti en son équivalent HTML &lt;
                            echo htmlspecialchars($cle) . ": " . htmlspecialchars($valeur) . '<br>';
                        }
                    }
                ?>
            </div>
            <br>
            <br>
        </main>
        <footer class="mt-auto">
            <!-- bas de page-->
            <?php require_once('commun/footer.php'); ?>
        </footer>
    </body>
</html>
