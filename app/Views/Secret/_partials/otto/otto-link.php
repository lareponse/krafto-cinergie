<?php

$records = $controller->viewport($relation) ?? [];
?>

<form class="otto-link" method="POST" action="<?= $controller->router()->hyp('dash_relation_link') ?>">

    <input type="hidden" name="relation" value="<?= $relation ?>" />
    <input type="hidden" name="parent_id" value="<?= $parent->getID() ?>" />
    <!-- hidden children inputs are spawned by js -->

    <div class="w-100">
        <input class="form-control list-search ms-md-auto mb-md-0 otto-search" type="search" placeholder="Ajouter" otto-entity="<?= $searchEntity ?>">
        <ul class="list-group list-group-flush otto-suggestions"></ul>
        <ul class="list-group my-3 otto-list"></ul>
    </div>

    <div class="d-flex align-items-center justify-content-between d-none mt-2 otto-link-submit">
        <span class="fs-5 text-secondary text-truncate">Confirmer pour enregistrer</span>
        <button type="submit" class="btn btn-primary btn-sm">Confirmer</a>
    </div>
</form>