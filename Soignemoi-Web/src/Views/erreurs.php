<div class="row">
    <div id="erreur-container" class="col-12 mt-4">
        <!-- Conteneur pour afficher la liste des messages d'erreur -->
        <ul id="erreur-list" class="list-group"></ul>
    </div>
</div>

<!-- $erreurs est-il présent? -->
<?php
    if (!isset($erreurs)) {
        $erreurs = [];
    }
?>