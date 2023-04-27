<div class="row">
    <div class="col-md-6 col-xl-4 col-xxl-3">
        <form method="POST" action="<?= $controller->router()->hyp('dash_relation_link', ['parent' => $parent, 'child' => $child]) ?>">
            <input type="hidden" name="<?= $controller->modelClassName()::model_type(); ?>_id" value="<?= $controller->loadModel()->getID() ?>">

            <div class="card border-0">
                <div class="card-body p-3 pt-0">
                    <div class="w-100 otto-link">
                        <ul class="list-group otto-list mb-3" otto-ids="<?= strtolower($className); ?>_ids[]"></ul>
                        <input class="form-control list-search ms-md-auto mb-md-0 otto-search" type="search" placeholder="Professionel" otto-search-fields="<?= implode(',', $fields) ?>" otto-entity="<?= $className; ?>">
                        <ul class="list-group list-group-flush otto-suggestions"></ul>
                    </div>
                    <div class="w-100 otto-link">
                        <ul class="list-group otto-list mb-3" otto-ids="<?= strtolower($className); ?>_ids[]"></ul>
                        <input class="form-control list-search ms-md-auto mb-md-0 otto-search" type="search" placeholder="Rôle" otto-search-fields="<?= implode(',', $fields) ?>" otto-entity="<?= $className; ?>">
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
    foreach ($cards as $card) {
        echo '<div class="col-md-6 col-xl-4 col-xxl-3">';
        $this->insert('Secret::' . $className . '/_partials/tab-card', ['model' => $card]);
        echo '</div>';
    }
    ?>
</div>