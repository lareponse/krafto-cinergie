<form class="otto-link-with-qualifier" method="POST" action="<?= $controller->router()->hyp('dash_relation_link') ?>">
    <input type="hidden" name="relation" value="<?= $relation ?>" />
    <input type="hidden" name="parent_id" value="<?= $controller->loadModel()->getID() ?>">

    <ul class="list-group my-3 otto-list d-none"></ul>

    <div class="w-100 otto-link-qualified">
        <ul class="list-group list-group-flush otto-result"></ul>
        <input class="form-control list-search ms-md-auto mb-md-0 otto-search" type="search" placeholder="<?= $placeholder ?? 'Chercher' ?>" otto-entity="<?= $searchEntity; ?>">
        <ul class="list-group list-group-flush otto-suggestions"></ul>
    </div>
    <div class="w-100 otto-link-qualifier mt-1">
        <ul class="list-group list-group-flush otto-result"></ul>
        <input class="form-control list-search ms-md-auto mb-md-0 otto-search" type="search" placeholder="Rôle" data-filter-parent="<?= $qualifierRestriction ?>">
        <ul class="list-group list-group-flush otto-suggestions"></ul>
    </div>

    <div class="d-flex align-items-center justify-content-between">
        <span class="fs-5 text-secondary text-truncate">Confirmer pour enregistrer</span>
        <button type="submit" class="btn btn-primary btn-sm">Confirmer</a>
    </div>
</form>