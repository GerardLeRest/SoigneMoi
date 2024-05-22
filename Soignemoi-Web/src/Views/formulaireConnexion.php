<!doctype html>
<html lang="fr">
    <?php require_once('commun/head.php'); ?>
    <body>
        <?php require_once('commun/header.php'); ?>

        <main class="container">
            <div class="row text-center">
            </div>
            <br>
            <br>
            <form action="/soignemoi-web/formulaireConnexion" method="post">
                <div class="row justify-content-center">
                <div class="mb-2 col-5 ">
                    <label for="email" class="form-label">Adresse Email</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="prenom.nom@exemple.fr">
                <br>
                <div class="mb-2 col-8 ">
                    <label for="motDePasse" class="form-label">Password</label>
                    <input type="password" id="motDePasse" class="form-control" aria-describedby="passwordHelpBlock" name="motDePasse" required>
                </div>    
                <br>
                <div class="col-10 md-5 text-center">
              <button type="submit" class="btn bouton-perso">Valider</button>
            </div>
            </form>  
            <!-- affichage des erreurs -->
            <br>
            <?php foreach ($errors as $valeur) {
                    //htmlspecialchars: échappement des caractères - < est converti en son équivalent HTML &lt;
                    echo htmlspecialchars($valeur) . '<br>';
                  }                       
                ?>   
        </main> 
        <!-- bas de page-->
        <?php require_once('commun/footerEnBas.php'); ?>
    </body>
</html>

    
