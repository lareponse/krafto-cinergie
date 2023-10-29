<?php
$qualifiedEndpoint = '/api/id-label/'.$context.'/term/';
$qualifierEndpoint = '/api/tag/'.$qualifierContext.'/term/';
?>
<form class="otto-link-with-qualifier" method="POST" action="<?= $controller->router()->hyp('dash_relation_link') ?>">
    <input type="hidden" name="relation" value="<?= $relation ?>" />
    <input type="hidden" name="source" value="<?= $controller->loadModel()->getID() ?>">

    <ul class="otto-list list-group my-3 list-group-flush d-none"></ul>

    <div class="w-100 otto-link-qualified">
        <ul class="otto-result list-group list-group-flush"></ul>
        <input type="search" placeholder="<?= $placeholder ?? 'Chercher' ?>" otto-endpoint="<?= $qualifiedEndpoint; ?>" otto-context="<?= $context; ?>" class="otto-search form-control list-search ms-md-auto mb-md-0">
        <ul class="otto-suggestions list-group list-group-flush"></ul>
    </div>
    <div class="w-100 otto-link-qualifier mt-1">
        <ul class="otto-result list-group list-group-flush"></ul>
        <input type="search" placeholder="Rôle" otto-endpoint="<?= $qualifierEndpoint ?>" otto-context="<?= $qualifierContext ?>" class="otto-search form-control list-search ms-md-auto mb-md-0">
        <ul class="otto-suggestions list-group list-group-flush "></ul>
    </div>

    <div class="d-flex align-items-center justify-content-between mt-3">
        <span class="fs-5 text-secondary text-truncate">Confirmer pour enregistrer</span>
        <button type="submit" class="btn btn-primary btn-sm">Confirmer</a>
    </div>
</form>