
<div class="row">
    <div class="col-md-6 col-xl-4 col-xxl-3">
        <form method="POST" action="<?= $controller->router()->hyp('dash_relation_link') ?>">
            <input type="hidden" name="relation" value="<?= $relation ?>" />
            <input type="hidden" name="parent_id" value="<?= $parent->getID()?>" />

            <?php 
            foreach($children as $child){
                echo $this->Form()::hidden('children_ids[]', $child->getID());
            }
            ?>
            <div class="card border-0">
                <div class="card-body p-3 pt-0">
                    <div class="w-100 otto-link">
                        <ul class="list-group otto-list mb-3" otto-ids="children_ids[]"></ul>
                        <input class="form-control list-search ms-md-auto mb-md-0 otto-search" type="search" placeholder="Ajouter" otto-search-fields="<?= implode(',', $searchFields) ?>" otto-entity="<?= $searchEntity ?>">
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