<?php use \HexMakina\Marker\Form; ?>
<form action="<?= $controller->router()->hyp('movies'); ?>" method="GET">
    <header>
        <h6>Filtres</h6>
        <a href="<?= $controller->router()->hyp('movies'); ?>" class="clean-filtres"><strong>Tout effacer</strong></a>
    </header>

    <hr>

    <label for="label" class="form-label mt-3">Titre</label>
    <input class="form-control" type="text" name="label" value="<?=$controller->router()->params('label')?>" />

    <label for="director" class="form-label mt-3">Réalisateur</label>
    <input class="form-control" type="text" name="director" value="<?=$controller->router()->params('director')?>" />

    <label for="organisation" class="form-label mt-3">Organisation</label>
    <input class="form-control" type="text" name="organisation" value="<?=$controller->router()->params('organisation')?>" />

    <label for="professional" class="form-label mt-3">Professionnel</label>
    <input class="form-control" type="text" name="professional" value="<?=$controller->router()->params('professional')?>" />

    <label for="released" class="form-label mt-3">Année de sortie</label>
    <input class="form-control" type="text" name="released" value="<?=$controller->router()->params('released')?>" />


    <hr class="mt-4 mb-1">

    <label for="" class="form-label mt-3">Type</label>
    <select class="form-select" name="type">

        <option value="">Tout</option>
        <?= Form::options($genres,$controller->router()->params('type')); ?>
    </select>


    <label for="" class="form-label mt-3">Durée</label>
    <select class="form-select" name="metrage">
        <option value="">Tout</option>
        <?= Form::options($metrages,$controller->router()->params('metrage')); ?>

    </select>


    <label for="" class="form-label mt-3">Thème</label>
    <select class="form-select" name="theme">
        <option value="">Tout</option>
        <?= Form::options($themes,$controller->router()->params('theme')); ?>
    </select>

    <hr class="mt-4 mb-1">

    <label for="" class="form-label">Trier par</label>

    <select class="form-select" name="order_by">
        <?= Form::options($order_by,$controller->router()->params('order_by')); ?>
    </select>

    <footer>
        <button href="#" class="btn btn-primary submit-filters mt-4">Afficher</button>
    </footer>
</form>