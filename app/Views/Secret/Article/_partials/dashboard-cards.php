<div class="row">

    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
        <a href="<?= $controller->router()->hyp('dash_records', ['nid' => $controller->nid()]); ?>" class="card border-0 flex-fill w-100">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-muted fw-semibold mb-2">Disponibles</h5>
                        <h2 class="mb-0"><?= $counters['published']; ?></h2>
                    </div>
                    <div class="col-auto">
                        <?= $this->icon('relations', 30, ['class' => 'text-primary']); ?>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
        <a href="<?= $controller->router()->hyp('dash_articles_by_segment', ['segment' => 'inactives']); ?>" class="card border-0 flex-fill w-100">

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
        <a href="<?= $controller->router()->hyp('dash_articles_by_segment', ['segment' => 'withoutAbstract']); ?>" class="card border-0 flex-fill w-100">

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-muted fw-semibold mb-2">Sans chapeau</h5>
                        <h2 class="mb-0"><?= $counters['withoutAbstract']; ?></h2>
                    </div>
                    <div class="col-auto">
                        <?= $this->icon('disable', 30, ['class' => 'text-primary']); ?>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
        <a href="<?= $controller->router()->hyp('dash_articles_by_segment', ['segment' => 'withoutContent']); ?>" class="card border-0 flex-fill w-100">

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
        <a href="<?= $controller->router()->hyp('dash_articles_by_segment', ['segment' => 'withoutProfilePicture']); ?>" class="card border-0 flex-fill w-100">

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-muted fw-semibold mb-2">Sans photo</h5>
                        <h2 class="mb-0"><?= $counters['withoutProfilePicture']; ?></h2>
                    </div>
                    <div class="col-auto">
                        <?= $this->icon('avatar', 30, ['class' => 'text-primary']); ?>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
        <div class="card border-0 flex-fill w-100">

            <div class="card-body">
                <h5 class="text-uppercase text-muted fw-semibold mb-2">Filtrer par type</h5>

                <select id="typeSelector" class="form-select">
                    <option value="">Choisir</option>
                    <?php foreach ($types as $type):
                        $href = $controller->url('list', ['type_id' => $type->get('id')]);
                    ?>
                        <option value="<?= $href; ?>">
                            <?= $type->get('label'); ?> (<?= $counters[$type->get('slug')]; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('typeSelector').addEventListener('change', function() {
        if (this.value) {
            window.location.href = this.value;
        }
    });
</script>