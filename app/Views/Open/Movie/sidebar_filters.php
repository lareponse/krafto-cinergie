<?php

use \HexMakina\Marker\Form;

$this->layout('Open/_partials/sidebar_filters', ['action' => $controller->router()->hyp('movies')]);

?>

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

<a href="#" class="mt-3 d-block text-secondary" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    <i class="bi bi-chevron-down"></i>
    D'autres critères ?
</a>
<div class="collapse" id="collapseExample">
    <hr class="mb-1">
    <label class="form-label mt-3">Titre</label>
    <input class="form-control" type="text" name="label" value="<?= $controller->router()->params('label') ?>" />

    <label class="form-label mt-3">Réalisateur</label>
    <input class="form-control" type="text" name="director" value="<?= $controller->router()->params('director') ?>" />

    <label class="form-label mt-3">Organisation</label>
    <input class="form-control" type="text" name="organisation" value="<?= $controller->router()->params('organisation') ?>" />

    <label class="form-label mt-3">Professionnel</label>
    <input class="form-control" type="text" name="professional" value="<?= $controller->router()->params('professional') ?>" />

    <label class="form-label mt-3">Année de sortie</label>
    <input class="form-control" type="text" name="released" value="<?= $controller->router()->params('released') ?>" />

</div>



<hr>

<label class="form-label">Trier par</label>

<select class="form-select" name="order_by">
    <?= Form::options($order_by, $controller->router()->params('order_by')); ?>
</select>