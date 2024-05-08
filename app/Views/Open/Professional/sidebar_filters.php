<?php

use \HexMakina\Marker\Form;

?>
<div class="card sidebar filtres shadow">
    <form action="<?= $controller->router()->hyp('organisations') ?>" method="GET">
        <header>
            <span class="fs-5"><i class="bi bi-sliders me-2" aria-label="Filtrer"></i></span>
            <a href="<?= $controller->router()->hyp('organisations') ?>" class="clean-filtres">Tout effacer</a>
        </header>

        <hr>


        <label class="form-label mt-3">Métier</label>
        <select class="form-select" name="metier">
            <option value="">Tout</option>
            <?= Form::options($praxis, $controller->router()->params('metier')); ?>
        </select>

        <label class="form-label mt-3">Tranche d'âge</label>
        <select class="form-select" name="tranche-age">
            <option value="">Tout</option>

            <?= Form::options($controller::AGE_RANGES, $controller->router()->params('tranche-age')); ?>
        </select>

        <label class="form-label mt-3">Genre</label>
        <select class="form-select" name="genre">
            <option value="">Tout</option>

            <?= Form::options($controller::ALLOWED_GENDERS, $controller->router()->params('genre')); ?>
        </select>

        <hr class="mt-4 mb-1">

        <label class="form-label mt-3">Rechercher par nom</label>
        <input class="form-control" type="text" name="nom" placeholder="Indiquez le nom" value="<?= $controller->router()->params('nom'); ?>">
        <footer>
            <button type="submit" class="btn btn-primary submit-filters mt-4">Afficher</button>
        </footer>

    </form>
</div>

