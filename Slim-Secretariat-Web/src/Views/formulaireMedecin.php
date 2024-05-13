<!doctype html>
<html lang="fr">
    <?php require_once('head.php'); ?>

    <body>
        <?php require_once('header.php'); ?>

        <main class="container">
            <div class="row text-center">
                <div class="col-12">
                    <br>
                    <h4>Médecins</h4>
                    <br>
                </div>
            </div>
            <form action="/slim-secretariat-web/formulaireMedecin" method="post">
                <div class="row justify-content-center">
                    <div class="mb-2 col-6">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="mb-2 col-6">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                </div>
                <div class="mb-2 col-8">
                    <label for="specialite" class="form-label">Spécialité</label>
                    <input type="text" class="form-control" id="specialite" name="specialite" required>
                </div>
                <div class="mb-2 col-8">
                    <label for="matricule" class="form-label">Matricule</label>
                    <input type="text" class="form-control" id="matricule" name="matricule" required>
                </div>
                <br>
                <div class="col-10 md-5 text-center">
              <button type="submit" class="btn bouton-perso">Valider</button>
            </div>
            </form>  
            <!-- affichage des erreurs -->
            <?php foreach ($errors as $cle => $valeur) {
                    //htmlspecialchars: échappement des caractères - < est converti en son équivalent HTML &lt;
                    echo htmlspecialchars($cle) . ": " . htmlspecialchars($valeur) . '<br>';
                  }                       
                ?>   
        </main> 
    </body>
</html>
