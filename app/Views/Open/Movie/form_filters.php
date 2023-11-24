<?php use \HexMakina\Marker\Form; ?>
<form action="<?= $controller->router()->hyp('movies'); ?>" method="GET">

    <header>
        <h6>Filtres</h6>
        <a href="<?= $controller->router()->hyp('movies'); ?>" class="clean-filtres"><strong>Tout effacer</strong></a>
    </header>

    <hr>

    <label class="form-label mt-3">Type</label>

    <select class="form-select" name="type">
        <option value="">Tout</option>
        <?= Form::options($genres, $controller->router()->params('type')); ?>
    </select>


    <label class="form-label mt-3">Durée</label>

    <select class="form-select" name="metrage">
        <option value="">Tout</option>
        <?= Form::options($metrages, $controller->router()->params('metrage')); ?>
    </select>


    <label class="form-label mt-3">Thème</label>

    <select class="form-select" name="theme">
        <option value="">Tout</option>
        <?= Form::options($themes, $controller->router()->params('theme')); ?>
    </select>


    <hr class="mt-4 mb-1">

    <label class="form-label mt-3">Titre</label>
    <input class="form-control" type="text" placeholder="Titre" name="label" value="<?= $controller->router()->params('label') ?>" />

    <label class="form-label mt-3">Réalisateur</label>
    <input class="form-control" type="text" placeholder="Réalisateur" name="director" value="<?= $controller->router()->params('director') ?>" />

    <label class="form-label mt-3">Organisation</label>
    <input class="form-control" type="text" placeholder="Organisation" name="organisation" value="<?= $controller->router()->params('organisation') ?>" />

    <label class="form-label mt-3">Professionnel</label>
    <input class="form-control" type="text" placeholder="Professionnel" name="professional" value="<?= $controller->router()->params('professional') ?>" />

    <label class="form-label mt-3">Année de sortie</label>
    <input class="form-control" type="text" placeholder="Année de sortie" name="released" value="<?= $controller->router()->params('released') ?>" />

    <hr>

    <label class="form-label">Trier par</label>

    <select class="form-select" name="order_by">
        <?= Form::options($order_by, $controller->router()->params('order_by')); ?>
    </select>

    <footer>
        <button class="btn btn-primary submit-filters mt-4">Afficher</button>
    </footer>
</form>