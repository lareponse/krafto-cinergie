<aside class="collapse" id="searchBAR">
    <div class="bg-dark p-4 d-print-none">
        <div class="container">
            <div class="mx-auto col-lg-6">
                <form class="search-form ms-2" action="<?= $controller->router()->hyp('search')?>">
                    <div class="input-group mb-3">
                        <input type="search" value="" autocomplete="off" placeholder="Rechercher" name="s" value="<?=$controller->router()->params('s')?>" class="form-control">
                        <button class="btn btn-primary" type="submit" title="Rechercher">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</aside>

<header class="navbar navbar-expand-xl  py-3" id="header">
    <div class="container">

        <a class="navbar-brand" href="<?=$controller->router()->hyp('home')?>">
            <img src="/public/assets/img/logo-cinergie.svg" alt="Logo CINERGIE" id="logo">
        </a>

        <div class="socials d-block d-xl-none ms-auto">
            <a type="button" data-bs-toggle="collapse" data-bs-target="#searchBAR" aria-controls="searchBAR" aria-expanded="false" aria-label="Toggle navigation" href="#" class="mx-1">
                <img src="/public/assets/wejune/img/icons/search.svg" alt="Recherche sur le site" />
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="bi bi-filter-right"></span>
        </button>

        <nav class="collapse navbar-collapse" id="navigation">
            <?php
            vd($controller->activeSection());
            ?>
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $controller->activeSection() == 'Article' ? 'active' : '' ?>" href="<?= $controller->router()->hyp('articles'); ?>">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $controller->activeSection() == 'Event' ? 'active' : '' ?>" href="<?= $controller->router()->hyp('events'); ?>">Agenda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $controller->activeSection() == 'Movie' ? 'active' : '' ?>" href="<?= $controller->router()->hyp('movies'); ?>">Filmoth&egrave;que</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $controller->activeSection() == 'Professional' ? 'active' : '' ?>" href="<?= $controller->router()->hyp('professionals'); ?>">Professionnels</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $controller->activeSection() == 'Organisation' ? 'active' : '' ?>" href="<?= $controller->router()->hyp('organisations'); ?>">Organisations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $controller->activeSection() == 'Job' ? 'active' : '' ?>" href="<?= $controller->router()->hyp('jobs'); ?>">Castings & Jobs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $controller->activeSection() == 'Shop' ? 'active' : '' ?>" href="<?= $controller->router()->hyp('shop'); ?>">Boutique</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $controller->activeSection() == 'Podcast' ? 'active' : '' ?>" href="https://www.cinergie.be/podcast">Podcast</a>
                </li>
            </ul>
            <div class="socials d-none d-xl-block">
                <a type="button" data-bs-toggle="collapse" data-bs-target="#searchBAR" aria-controls="searchBAR" aria-expanded="false" aria-label="Toggle navigation" href="#" class="mx-1"><img src="/public/assets/wejune/img/icons/search.svg" alt="Recherche sur le site" /></a>
            </div>
        </nav>
    </div>
</header>