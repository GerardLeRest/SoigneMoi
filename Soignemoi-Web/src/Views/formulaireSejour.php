<!doctype html>
<html lang="fr"> <!-- https://colorlib.com/wp/template/calendar-13/ -->

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/fonts/calendriers/icomoon/style.css">
    <link rel="stylesheet" href="assets/css/calendriers/classic.css">
    <link rel="stylesheet" href="assets/css/calendriers/classic.date.css">

    <!-- Styles perso de l'auteur-->
    <link rel="stylesheet" href="assets/css/calendriers/style.css">
    <!--fichiers css bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"> <!-- on se positionne par rapporu au dossier public -->
    <!-- Styles personnel --> 
    <link rel="stylesheet"  href="assets/css/styles.css"> 
  </head>
    <body>
        <?php require_once('commun/header.php'); ?>
        <br>
        <br>
        <main class="container">
          <form action="/soignemoi-web/formulaireSejour" method="post">
            <div class="row justify-content-center">
              <div class="col-lg-7">
                  <div class ="row">
                    <div class="col-6">
                        <div class="form-group">
                          <label for="input_from">De</label>
                          <input type="text" class="form-control" id="input_from" name="dateDebut" placeholder="Date de Début">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                          <label for="input_to">À</label>
                          <input type="text" class="form-control" id="input_to" name="dateFin" placeholder="Date de fin">
                        </div>
                    </div>
                  </div>
            </div>
            <div class="mb-3 col-12">
              <label for="motifSejour" class="form-label">Motif du séjour</label>
              <textarea class="form-control" id="motifSejour" name="motifSejour" rows="3"></textarea>
            </div>
            <row class="row justify-content-center">
              <div class="mb-3 col-6">
                <label for="specialite" class="form-label">Spécialité</label>
                <input type="text" class="form-control" id="specialite" name="specialite" required>
              </div>
              <div class="mb-3 col-6">
                <label for="medecinSouhaite" class="form-label">Médecin souhaité</label>
                <input type="text" class="form-control" id="medecinSouhaite" name="medecinSouhaite" >
              </div>
            </div>
            <br>
            <div class="col-12 md-5 text-center">
              <button type="submit" class="btn bouton-perso">Valider</button>
            </div>
          </form>  
          <div class ="row">
            <!-- affichage des erreurs -->
            <?php foreach ($errors as $cle => $valeur) {
                    //htmlspecialchars: échappement des caractères - < est converti en son équivalent HTML &lt;
                    echo htmlspecialchars($cle) . ": " . htmlspecialchars($valeur) . '<br>';
                  }                       
                ?>   
          <div>
        </main>      
        <!-- include footer -->
        <script src="assets/js/calendriers/jquery-3.3.1.min.js"></script>
        <script src="assets/js/calendriers/popper.min.js"></script>
        <script src="assets/js/calendriers/bootstrap.min.js"></script>
        <script src="assets/js/calendriers/picker.js"></script>
        <script src="assets/js/calendriers/picker.date.js"></script>
        <script src="assets/js/calendriers/main.js"></script>
        <!--fichier Bootstrap JS -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <?php require_once('commun/footerEnBas.php'); ?>
    </body>
</html>
