<?php

use \HexMakina\Marker\Form;
// $this->layout('Open/_partials/sidebar_filters', ['action' => ]);

?>
<div class="card sidebar filtres shadow">
    <form action="<?= $controller->router()->hyp('organisations') ?>" method="GET">
        <header>
            <span class="fs-5"><i class="bi bi-sliders me-2" aria-label="Filtrer"></i></span>
            <a href="<?= $controller->router()->hyp('organisations') ?>"  class="clean-filtres">Tout effacer</a>
        </header>

        <hr>

        <label class="form-label">Trier par catégorie</label>
        <select class="form-select" name="activites">
            <option value="">Toutes</option>
            <?= Form::options($praxis, $controller->router()->params('activites')); ?>
        </select>

        <hr class="my-4 mb-1">

        <label class="form-label mt-3">Rechercher par nom</label>
        <input class="form-control" type="text" name="nom" placeholder="Indiquez le nom" value="<?= $controller->router()->params('nom'); ?>" />

        <footer>
            <button type="submit" class="btn btn-primary submit-filters mt-4">Afficher</button>
        </footer>

    </form>
</div>