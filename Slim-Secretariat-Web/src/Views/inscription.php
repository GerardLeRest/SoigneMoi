<!doctype html>
<html lang="fr">

    <?php require_once('head.php') ?>
    
    <body>

        <?php require_once('header.php'); ?>
             
        <main class="container">
            <div class ="row text-center">
                <div class="col-12">
                    <br>
                    <br>
                    <h4> Inscription</h4>
                    <br>
                </div>
            </div>
            <div class ="row justify-content-center">
                <div class="mb-2 col-4">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name ="prenom" required>
                </div>
                 <div class="mb-2 col-4">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
            </div>
            <div class ="row">
                <div class="mb-2 col-10 offset-2">
                    <label for="adressePostale" class="form-label">Adresse Postale</label>
                    <input type="text" class="form-control" id="adressePostale" name="adressePostale" required>
                </div>
            </div> 
            <div class ="row">
                <div class="mb-2 col-5 offset-2">
                    <label for="courrierElectronique" class="form-label">Adresse Email</label>
                    <input type="email" class="form-control" id="courrierElectronique" name="courrierElectronique" required placeholder="prenom.nom@exemple.fr">
                </div>
            </div>
            <div class ="row">
                <div class="mb-2 col-5 offset-2">
                    <label for="motDePasse" class="form-label">Password</label>
                    <input type="password" id="motDePasse" class="form-control" aria-describedby="passwordHelpBlock" name="motDePasse" required>
                    <div id="motDePasse" class="form-text">
                        La longueur de votre mot passe doit être supérieur à 8 caractères doit contenir 1 chiffre, 1 majuscule et des minuscules.
                    </div>
                </div>    
            </div> 
            <div class ="row justify-content-center">
                <div class="col-10 offset 2 text-center">
                    <button type="submit" class="btn bouton-perso">Valider</button>
                </div>
            </div>
        </main>
        <!-- bas de page-->
        <?php require_once('footerEnBas.php'); ?>
    </body>
</html>
