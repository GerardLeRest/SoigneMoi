<?php require('constantes.php'); ?>

<header class="container">
    <nav class="navbar sticky-top navbar-expand-lg navbar navbar-light bg-light">
        <!-- Logo de la barre de naviguation -->
        <a class="navbar-brand" href="/soignemoi-web/accueil"><img src="assets/images/logo_120_120.png"
        width="60" height="60" alt="Logo">
        </a>
        <!--menu-->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- boucle for en php dans du html -->
                <ul class="navbar-nav">
                    <?php for ($i = 0; $i < count($liensURL); $i++): ?>
                        <li class="nav-item px-3">
                            <a class="nav-link" <?php echo $liensURL[$i]; ?>><?php echo $titres[$i]; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </ul>
        </div>
    </nav>
        <div class="row justify-content-center align-self-center">
            <div class="col-8 border-bottom">
                <!--Titre principal du site-->
                <h2 class="text-center py-3"><?php echo $titrePrincipaux[$indice];?></h2>
            </div>                                               
        </div>
</header>                                           