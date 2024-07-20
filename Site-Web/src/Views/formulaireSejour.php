<!doctype html>
<html lang="fr">
    
  <?php require_once('commun/head1.php') ?>
  
  <body class="d-flex flex-column min-vh-100">
    <?php require_once('commun/header.php'); ?>
   
    <main class="container flex-grow-1">
      <form action="/formulaireSejour" method="post">
        <br>
        <br>
        <div class="row text-center">
          <!-- date de début -->
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
        <!-- checkbox Dans une rangée car éléments à droite-->
        <div class="row justify-content-end">
          <div class = "form-check col-auto">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="pasDateFin"> 
            <label class="form-check-label" for="flexCheckDefault">
              Pas de date fin
            </label>
          </div>
        </div>
        <!-- motif su séjour -->
        <div class="mb-3 col-lg-12 col-md-12 col-xs-12">
          <label for="motifSejour" class="form-label">Motif du séjour</label>
          <textarea class="form-control" id="motifSejour" name="motifSejour" rows="3"></textarea>
        </div> 
        <!-- médecin souhaité et spécialité -->
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
        <!-- bouton de validation -->
        <div class="col-12 text-center mh-3">
            <button type="submit" class="btn bouton-perso">Valider</button>
        </div>
      </form>
      
    </main>
    
    <!-- Pied de page -->
    <?php require_once('commun/footer.php'); ?>
    <!-- Include JS files -->
    <script src="assets/js/calendriers/jquery-3.3.1.min.js"></script>
    <script src="assets/js/calendriers/popper.min.js"></script>
    <script src="assets/js/calendriers/bootstrap.min.js"></script>
    <script src="assets/js/calendriers/picker.js"></script>
    <script src="assets/js/calendriers/picker.date.js"></script>
    <script src="assets/js/calendriers/main.js"></script>
  </body>
 
</html>



