<?php

use \HexMakina\Marker\Form; ?>

<form action="<?= $controller->router()->hyp('professionals'); ?>" method="GET">
    <header class="row">
        <h6 class="col">Filtres</h6>
        <div class="col">
            <a href="<?= $controller->router()->hyp('professionals') ?>" class="clean-filtres">Tout effacer</a>
        </div>
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

        <?= Form::options([
            '20' => '&lt; 20 ans',
            '30' => '20 → 30 ans',
            '40' => '30 → 40 ans',
            '50' => '40 → 50 ans',
            '60' => '50 → 60 ans',
            '100' => '&gt; 60 ans'
        ], $controller->router()->params('tranche-age')); ?>
    </select>

    <label class="form-label mt-3">Genre</label>
    <select class="form-select" name="genre">
        <option value="">Tout</option>

        <?= Form::options([
            'h' => 'Hommes',
            'f' => 'Femmes',
            'nb' => 'Autres'
        ], $controller->router()->params('genre')); ?>
    </select>

    <hr class="mt-4 mb-1">

    <label class="form-label mt-3">Rechercher par nom</label>
    <input class="form-control" type="text" name="nom" placeholder="Indiquez le nom" value="<?= $controller->router()->params('nom');?>">

    <footer>
        <button type="submit" class="btn btn-primary submit-filters mt-4">Afficher</button>
    </footer>
</form>