<div class="row">
    <div class="col-md-6 col-xl-4 col-xxl-3">
        <form method="POST" action="<?= $controller->router()->hyp('dash_relation_link') ?>">
            <input type="hidden" name="relation" value="<?= $relation ?>" />
            <input type="hidden" name="parent_id" value="<?= $controller->loadModel()->getID() ?>">

            <div class="card border-0">
                <div class="card-body p-3 otto-link-with-qualifier">
                    <div class="w-100 otto-link-qualified">
                        <ul class="list-group list-group-flush otto-result"></ul>
                        <input class="form-control list-search ms-md-auto mb-md-0 otto-search" type="search" placeholder="<?=$placeholder ?? 'Chercher'?>" otto-entity="<?= $searchEntity; ?>">
                        <ul class="list-group list-group-flush otto-suggestions"></ul>
                    </div>
                    <div class="w-100 otto-link-qualifier mt-1">
                        <ul class="list-group list-group-flush otto-result"></ul>
                        <input class="form-control list-search ms-md-auto mb-md-0 otto-search" type="search" placeholder="Rôle" data-filter-parent="<?= $qualifierRestriction ?>">
                        <ul class="list-group list-group-flush otto-suggestions"></ul>
                    </div>
                </div>

                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="fs-5 text-secondary text-truncate">Confirmer pour enregistrer</span>
                    <button type="submit" class="btn btn-primary btn-sm">Confirmer</a>
                </div>
            </div>
        </form>
    </div>

    <?php
    foreach ($children as $child) {
        echo '<div class="col-md-6 col-xl-4 col-xxl-3">';
        $this->insert($childrenTemplate, ['model' => $child]);
        echo '</div>';
    }
    ?>
</div>