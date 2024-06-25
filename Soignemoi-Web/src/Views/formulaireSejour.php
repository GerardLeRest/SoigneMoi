<!doctype html>
<html lang="fr">
    
  <?php require_once('commun/head1.php') ?>
  
  <body class="d-flex flex-column min-vh-100">
    <?php require_once('commun/header.php'); ?>
    <br>
    <br>
    <main class="container">
      <form action="/soignemoi-web/formulaireSejour" method="post">
        <div class="row text-center">
          <div class="col-lg-6 col-md-12 col-xs-12 mb-3">
            <div class="form-group">
              <label for="input_from">De</label>
              <input type="text" class="form-control" id="input_from" name="dateDebut" placeholder="Date de Début">
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-xs-12 mb-3">
            <div class="form-group">
              <label for="input_to">À</label>
              <input type="text" class="form-control" id="input_to" name="dateFin" placeholder="Date de fin">
            </div>
          </div>
        </div> 
        <div class="mb-3 col-lg-12 col-md-12 col-xs-12">
          <label for="motifSejour" class="form-label">Motif du séjour</label>
          <textarea class="form-control" id="motifSejour" name="motifSejour" rows="3"></textarea>
        </div> 
        <div class="row justify-content-center">
          <div class="mb-3 col-lg-6 col-md-12 col-xs-12">
            <label for="specialite" class="form-label">Spécialité</label>
            <input type="text" class="form-control" id="specialite" name="specialite" required>
          </div>
          <div class="mb-3 col-lg-6 col-md-12 col-xs-12">
            <label for="medecinSouhaite" class="form-label">Médecin souhaité</label>
            <input type="text" class="form-control" id="medecinSouhaite" name="medecinSouhaite">
          </div>
        </div> 
        <br>
        <div class="col-12 text-center">
            <button type="submit" class="btn bouton-perso">Valider</button>
        </div>
      </form>
      <div class="row">
        <!-- affichage des erreurs -->
        <?php
          if (isset($errors) && count($errors) > 0) {
            foreach ($errors as $cle => $valeur) {
              echo htmlspecialchars($cle) . ": " . htmlspecialchars($valeur) . '<br>';
            }
          }
        ?>
      </div>
    </main>
    <!-- Include footer -->
    <footer class="mt-auto">
      <?php require_once('commun/footer.php'); ?>
    </footer>
    <!-- Include JS files -->
    <script src="public/assets/js/calendriers/jquery-3.3.1.min.js"></script>
    <script src="public/assets/js/calendriers/popper.min.js"></script>
    <script src="public/assets/js/calendriers/bootstrap.min.js"></script>
    <script src="public/assets/js/calendriers/picker.js"></script>
    <script src="public/assets/js/calendriers/picker.date.js"></script>
    <script src="public/assets/js/calendriers/main.js"></script>
  </body>
</html>



