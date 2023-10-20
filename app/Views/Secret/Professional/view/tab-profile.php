<div class="row">
    <div class="col-md-4 col-xl-4 col-xxl-3">

        <div class="card border-0 pt-3">
            <div class="card-body pt-0">

                <h3 class="h6 small text-secondary text-uppercase mb-3">Métier(s)</h3>


                <?php $list_item = '<li class="py-2">%s %s</li>'; ?>
                <?= $this->insert('Secret::_partials/otto/otto-praxis', [
                    'parent' => $controller->loadModel(),
                    'relation' => 'professional-hasAndBelongsToMany-tag',

                    'childrenType' => 'tag',
                    'data-filter-parent' => 'professional_praxis',

                ]); ?>
     


            </div>
        </div>
        <?= $this->insert('Secret::_partials/contact/sidebar-card', ['list_item' => $list_item]) ?>
        <?= $this->insert('Secret::_partials/address/sidebar-card', ['list_item' => $list_item]) ?>
    </div>

    <div class="col">

        <div class="card border-0">
            <div class="card-body">
                <h2 class="h3">Biographie</h2>
                <?php
                if (empty($controller->loadModel()->get('content'))) {
                    ?><a class="btn btn-sm btn-warning" href="<?= $controller->url('edit') ?>">Ajouter</a><?php
                } else {
                    echo $controller->loadModel()->get('content');
                }
                    ?>
            </div>
        </div>

        <div class="card border-0">
            <div class="card-body">
                <h2 class="h3">Filmographie</h2>
                <?php
                if (empty($controller->loadModel()->get('filmography'))) {
                    ?><a class="btn btn-sm btn-warning" href="<?= $controller->url('edit') ?>">Ajouter</a><?php
                } else {
                    echo $controller->loadModel()->get('filmography');
                }
                ?>
            </div>
        </div>
    </div>
</div>