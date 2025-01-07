<?php

use \HexMakina\Marker\Form;

$this->layout('Open/_partials/sidebar_filters', ['action' => $controller->router()->hyp('organisations')]);

?>

<label class="form-label">Filtrer par catégorie</label>
<select class="form-select" name="activites">
    <option value="">Toutes</option>
    <?= Form::options($praxis, $controller->router()->params('activites')); ?>
</select>

<hr class="my-4 mb-1">

<label class="form-label mt-3">Rechercher par nom</label>
<input class="form-control" type="text" name="nom" placeholder="Indiquez le nom" value="<?= $controller->router()->params('nom'); ?>" />