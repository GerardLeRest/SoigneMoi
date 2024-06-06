<!DOCTYPE html>
<html lang="fr">
    <?php require_once('commun/head.php'); ?>
    <body>
        <?php require_once('commun/header.php'); ?>
        <main class="container">
            <div class="row" >
                <div class = "col-12b py-3">  <!-- py: padding sur l'axe y - de 0 à 5 -->
                    <h4> Historique de l'hôpital </h4>
            </div>
            <div class =row>
                <div class = "col-xs-12 col-sm-12 col-lg-9" >
                    <p>
                        Bienvenue à l'Hôpital SoigneMoi, un havre de paix et de guérison situé dans la région Lilloise. Fondé dans les années 1920, notre
                        établissement combine le charme d'une architecture historique avec les équipements médicaux les plus modernes. Malgré les épreuves 
                        du temps, notamment un incendie tragique après la Seconde Guerre mondiale qui a causé la perte de 9 précieuses vies et laissé 16
                        blessés, SoigneMoi a été reconstruit pour offrir sécurité et confort, témoignant de la résilience et de l'engagement de notre
                        communauté envers le soin et le bien-être.
                    </p>
                    <p> <!-- sources:  https://www.calameo.com/read/005552956571a9c2174ee -->
                        Aujourd'hui, SoigneMoi s'étend sur un site magnifiquement restauré, où une vue apaisante sur la ville de Chtibuck, encourageant la
                        guérison et la tranquillité d'esprit. L'hôpital est doté de 212 lits et emploie une équipe médicale de 28 médecins (sage-femmes, 
                        practicines, etc...) environ 90 infirmières, 120 aides-soignantes et 112 autres personnels, tous formés pour fournir des soins
                        exceptionnels avec une touche humaine et empathique. 
                    </p>
                    <p> Chez SoigneMoi, nous croyons que l'environnement joue un rôle crucial dans le processus de guérison. C'est pourquoi nous nous
                        efforçons de faire de votre séjour chez nous une expérience aussi agréable et réconfortante que possible, dans un cadre qui allie
                        histoire, calme et excellence médicale.
                    </p>
                </div>   
                <!-- image de l'hôpital -->
                <div class="center col-xs-12 col-sm-12 col-lg-3">
                    <figure class="figure">
                        <img src="assets/images/Hopital-500x500.webp" class="figure-img img-fluid rounded" alt="image de l'hôpital">
                        <figcaption class="figure-caption text-end">Vue de l'hôpital</figcaption>
                    </figure>
            </div>
            </div>
            <div class=row>
                <div class=co1-12>
                    <h4>
                        Les différents services de l'hôpital
                    </h4>
                    <p>
                    À l'Hôpital SoigneMoi, nous sommes fiers de proposer une gamme étendue de services médicaux spécialisés, conçus pour répondre à
                    tous les besoins de santé avec efficacité et compassion. Nos services incluent le Département d'Urgence, prêt à réagir rapidement
                    à toute situation critique, le Centre de Chirurgie, équipé des technologies les plus avancées pour les interventions mineures et
                    majeures, et le Service de Radiologie, offrant des diagnostics précis grâce à des équipements à la pointe de la technologie comme
                    le scanner. En outre, notre Unité de Soins Intensifs assure une surveillance et des soins continus pour les cas les plus
                    sérieux, tandis que notre Service de Maternité offre un environnement sécurisé et chaleureux pour les naissances. Chaque service est
                    soutenu par une équipe dédiée de professionnels de santé, y compris des infirmières, des aides-soignantes et des agents hospitaliers,
                    tous engagés à fournir des soins de la plus haute qualité.
                    </p>
                </div>
            </div>
            <div class = "row">
                <!--Carroussel-->
                <div class = "col-sm-12 col-md-4 col-lg-4">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="10000">
                                <img src="assets/images/salle_d_operation-500x500.webp" class="d-block w-100" alt="salle d'opération">
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                                <img src="assets/images/salle_de_reeducation-500x500.webp" class="d-block w-100" alt="salle de rééducation">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/images/scanner-500x500.webp" class="d-block w-100" alt="scanner">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class = "col-sm-12 col-md-8 col-lg-8">
                    <p>
                        - Une salle de chirurgie moderne dispose de technologies médicales avancées. Elle illustre un environnement stérile et bien équipé, idéal
                        pour des opérations chirurgicales de précision.
                    </p>
                    <p>
                        - Le service de radiologie est équipé d'un scanner de pointe. Cette salle démontre l'utilisation des technologies de diagnostic
                        avancées de l'hôpital, créant un environnement confortable et professionnel pour les patients et le personnel médical.
                    </p>
                    <p>
                        - La salle de rééducation est optimisée pour le rétablissement et la convalescence, la salle de rééducation de l'hôpital SoigneMoi
                        offre un espace moderne et spacieux. Chaque détail est conçu pour favoriser une guérison sécurisée et efficace.
                    </p>
                    <div class="text-center">
                        <a href="/formulairePatient" class="btn bouton-perso">S'incrire</a>
                    </div>
                    <br>
                    <br>
                    <div class="text-center">
                        <img src="assets/images/logo_120_120.png" class="rounded mx-auto d-block" alt="logo de l'hôpital">   
                    </div>
                    <br>
                </div>
            </div>
        </main>
        <footer>
            <!-- bas de page-->
            <?php require_once('commun/footer.php'); ?>
        </footer
    </body>
</html>
