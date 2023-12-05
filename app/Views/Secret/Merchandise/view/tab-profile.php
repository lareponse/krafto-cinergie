<div class="row">
    <div class="col-md-4 col-xxl-3">
        <?php $this->insert('Secret::Merchandise/view/tab-profile-sidebar') ?>
    </div>

    <div class="col">

        <div class="card border-0">
            <div class="card-body">
                <h2 class="h3">Synopsis</h2>
                <?= $controller->loadModel()->get('content'); ?>
            </div>
        </div>
    </div>
</div>