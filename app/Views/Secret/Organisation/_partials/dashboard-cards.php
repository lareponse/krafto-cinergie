<div class="row">

    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
        <a href="<?= $controller->router()->hyp('dash_records', ['nid'=>$controller->nid()]); ?>" class="card border-0 flex-fill w-100">

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-muted fw-semibold mb-2">Total</h5>
                        <h2 class="mb-0"><?= $counters['organisations']; ?></h2>
                    </div>
                    <div class="col-auto">
                        <?= $this->icon('relations', 30, ['class' => 'text-primary']); ?>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
        <a href="<?= $controller->router()->hyp('dash_organisations_by_segment', ['segment' => 'partenaires']); ?>" class="card border-0 flex-fill w-100">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-muted fw-semibold mb-2">Partenaires</h5>
                        <h2 class="mb-0"><?= $counters['partners']; ?></h2>
                    </div>
                    <div class="col-auto">
                        <?= $this->icon('partners', 30, ['class' => 'text-primary']); ?>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
        <a href="<?= $controller->router()->hyp('dash_organisations_by_segment', ['segment' => 'inactives']); ?>" class="card border-0 flex-fill w-100">

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

    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
        <a href="<?= $controller->router()->hyp('dash_organisations_by_segment', ['segment' => 'unlisted']); ?>" class="card border-0 flex-fill w-100">

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-muted fw-semibold mb-2">Non Listé</h5>
                        <h2 class="mb-0"><?= $counters['unlisted']; ?></h2>
                    </div>
                    <div class="col-auto">
                        <?= $this->icon('disable', 30, ['class' => 'text-primary']); ?>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
        <a href="<?= $controller->router()->hyp('dash_organisations_by_segment', ['segment' => 'withoutContent']); ?>" class="card border-0 flex-fill w-100">

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-muted fw-semibold mb-2">Sans contenu</h5>
                        <h2 class="mb-0"><?= $counters['withoutContent']; ?></h2>
                    </div>
                    <div class="col-auto">
                        <?= $this->icon('text', 30, ['class' => 'text-primary']); ?>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
        <a href="<?= $controller->router()->hyp('dash_organisations_by_segment', ['segment' => 'withoutProfilePicture']); ?>" class="card border-0 flex-fill w-100">

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-muted fw-semibold mb-2">Sans photo</h5>
                        <h2 class="mb-0"><?= $counters['withoutProfilePicture']; ?></h2>
                    </div>
                    <div class="col-auto">
                        <?= $this->icon('profilePicture', 30, ['class' => 'text-primary']); ?>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>