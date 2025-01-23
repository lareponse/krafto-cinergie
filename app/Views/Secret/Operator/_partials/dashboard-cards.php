<div class="row">

    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
        <a href="<?= $controller->router()->hyp('dash_records', ['nid' => $controller->nid()]); ?>" class="card border-0 flex-fill w-100">

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-muted fw-semibold mb-2">Total</h5>
                        <h2 class="mb-0"><?= $counters['operators']; ?></h2>
                    </div>
                    <div class="col-auto">
                        <?= $this->icon('relations', 30, ['class' => 'text-primary']); ?>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
        <a href="<?= $controller->router()->hyp('dash_operators_by_segment', ['segment' => 'editor']); ?>" class="card border-0 flex-fill w-100">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-muted fw-semibold mb-2">Editeurs</h5>
                        <h2 class="mb-0"><?= $counters['editors']; ?></h2>
                    </div>
                    <div class="col-auto">
                        <?= $this->icon('partners', 30, ['class' => 'text-primary']); ?>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
        <a href="<?= $controller->router()->hyp('dash_operators_by_segment', ['segment' => 'author']); ?>" class="card border-0 flex-fill w-100">

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-muted fw-semibold mb-2">Auteurs</h5>
                        <h2 class="mb-0"><?= $counters['authors']; ?></h2>
                    </div>
                    <div class="col-auto">
                        <?= $this->icon('disable', 30, ['class' => 'text-primary']); ?>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
        <a href="<?= $controller->router()->hyp('dash_operators_by_segment', ['segment' => 'inactives']); ?>" class="card border-0 flex-fill w-100">

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-muted fw-semibold mb-2">Inactifs</h5>
                        <h2 class="mb-0"><?= $counters['inactives']; ?></h2>
                    </div>
                    <div class="col-auto">
                        <?= $this->icon('disable', 30, ['class' => 'text-primary']); ?>
                    </div>
                </div>
            </div>
        </a>
    </div>

</div>