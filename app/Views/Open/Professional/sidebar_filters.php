<?php

use \HexMakina\Marker\Form;

$this->layout('Open/_partials/sidebar_filters', ['action' => $controller->router()->hyp('organisations')]);

?>

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
