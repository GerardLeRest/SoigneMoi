<!doctype html>
<html lang="fr">

    <?php require_once('head.php') ?>
    
    <body>

        <?php require_once('header.php'); ?>
        
        <main class="container">
            <form action="/slim-secretariat-web/validation-formulaire" method="post">
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
                        <label for="email" class="form-label">Adresse Email</label>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="prenom.nom@exemple.fr">
                    </div>
                </div>
                <div class ="row">
                    <div class="mb-2 col-5 offset-2">
                        <label for="motDePasse" class="form-label">Password</label>
                        <input type="password" id="motDePasse" class="form-control" aria-describedby="passwordHelpBlock" name="motDePasse" required>
                        <div id="motDePasse" class="form-text">
                            Le mot de passe doit contenir entre 8 et 20 caractères, incluant au moins une lettre minuscule, une lettre majuscule, un chiffre, et un caractère spécial.
                        </div>
                    </div>    
                </div> 
                <div class ="row justify-content-center">
                    <div class="col-10 offset 2 text-center">
                        <button type="submit" class="btn bouton-perso">Valider</button>
                    </div>
                </div>
            </form>
        </main>
        <!-- bas de page-->
        <?php require_once('footerEnBas.php'); ?>
    </body>
</html>
