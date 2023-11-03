<?php
foreach(['controller', 'parent', 'ottoLinkEndPoint', 'relation'] as $var)
{
    if(!isset($$var)){
        throw new \InvalidArgumentException('Partial::'.__FILE__.', missing $'.$var);
    }

}

$records = $controller->viewport($relation) ?? [];
?>

<form class="otto-OneToMany" method="POST" action="<?= $controller->router()->hyp('dash_relation_link') ?>">

    <input type="hidden" name="relation" value="<?= $relation ?>" />
    <input type="hidden" name="source" value="<?= $parent->id() ?>" />
    <!-- hidden children inputs are spawned by js -->

    <div class="w-100">
        <ul class="otto-list list-group list-group-flush"></ul>
        <input type="search" placeholder="Ajouter" otto-endpoint="<?=$ottoLinkEndPoint?>" class="otto-search form-control list-search ms-md-auto mb-md-0">
        <ul class="otto-suggestions list-group list-group-flush"></ul>
    </div>

    <div class="d-flex align-items-center justify-content-between d-none mt-2 otto-link-submit">
        <span class="fs-5 text-secondary text-truncate">Confirmer pour enregistrer</span>
        <button type="submit" class="btn btn-primary btn-sm">Confirmer</a>
    </div>
</form>