<header class="navbar navbar-expand-xl py-3" id="header">
    <div class="container">

        <a class="navbar-brand" href="<?= $controller->router()->hyp('home') ?>">
            <img src="/public/assets/img/logo-cinergie.svg" alt="Logo CINERGIE" class="logo">
        </a>
        <div class="socials d-block d-xl-none ms-auto">
            <button type="button" data-bs-toggle="collapse" data-bs-target="#searchBAR" aria-controls="searchBAR" aria-expanded="false" aria-label="Toggle navigation" class="mx-1 btn-search">
                <?= $this->bi('search'); ?>
            </button>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <?= $this->bi('filter-right'); ?>
        </button>

        <?= $this->insert('Open::_partials/navbar') ?>
    </div>
</header>