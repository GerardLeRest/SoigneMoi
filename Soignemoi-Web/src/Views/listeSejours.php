<!doctype html>
<html lang="fr">
    <?php require_once('commun/head.php'); ?>
    
    <body class="d-flex flex-column min-vh-100">
        <?php require_once('commun/header.php'); ?>
        <main  class="container">
            <br>
            <br>
            <br>
            <row>
                <table class="table">
                    <thead class="thead-dark"> <!--enttête du tableau-->
                        <tr>
                        <th scope="col"></th>
                        <th scope="col">Date de début</th>
                        <th scope="col">Date de fin</th>
                        <th scope="col">Motif du Séjour</th>
                        <th scope="col">Spécialité</th>
                        <th scope="col">Médecin souhaité</th>
                        </tr>
                    </thead>
                    <tbody> <!--corps du tabelau-->
                    <?php for ($i = 0; $i < count($donnees); $i++): ?>
                        <tr>
                            <th scope="row"><?= $i + 1 ?></th>
                            <td><?= $donnees[$i]['dateDebut']->format('d-m-Y') ?></td>
                            <td>
                                <?php if ($donnees[$i]['dateFin']): ?>
                                    <?= $donnees[$i]['dateFin']->format('d-m-Y') ?>
                                <?php else: ?>
                                    &nbsp;          <!-- créer un espace à la plave de la date de fin si elle est de type null -->
                                <?php endif; ?>
                            </td>
                            <td><?= isset($donnees[$i]['motifSejour']) ? htmlspecialchars($donnees[$i]['motifSejour']) : '' ?></td>
                            <td><?= isset($donnees[$i]['specialite']) ? htmlspecialchars($donnees[$i]['specialite']) : '' ?></td>
                            <td><?= isset($donnees[$i]['medecinSouhaite']) ? htmlspecialchars($donnees[$i]['medecinSouhaite']) : '' ?></td>
                        </tr>
                    <?php endfor; ?>
                    </tbody>
                </table>
            </row>
        </main>
        <footer class="mt-auto">
            <!-- include footer -->
            <?php require_once('commun/footer.php'); ?>
        </footer>
    </body>
</html> 
