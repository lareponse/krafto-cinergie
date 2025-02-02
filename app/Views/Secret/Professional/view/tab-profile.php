<div class="row">
    <div class="col-md-4 col-xl-4 col-xxl-3">
        <?= $this->insert('Secret::_partials/praxis/sidebar-card', ['context' => 'professional_praxis']) ?>
        <?= $this->insert('Secret::_partials/contact/sidebar-card') ?>
        <?= $this->insert('Secret::_partials/address/sidebar-card') ?>
    </div>

    <div class="col">
        <div class="card border-0">
            <div class="card-body">
                <h2 class="h3">Biographie</h2>
                <?php
                if (empty($controller->loadModel()->get('content'))) {
                    echo $this->DOM()::a($controller->url('edit'), 'Ajouter', ['class' => 'btn btn-sm btn-warning'], false);
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
                    echo $this->DOM()::a($controller->url('edit'), 'Ajouter', ['class' => 'btn btn-sm btn-warning'], false);
                } else {
                    echo $controller->loadModel()->get('filmography');
                }
                ?>
            </div>
        </div>
    </div>
</div>