<?php
use HexMakina\Marker\Marker;

$activeSection = $actionSection ?? $controller->activeSection();

$menu = [
    Marker::a($controller->router()->hyp('articles'), 'Articles', ['class' => ('Article' == $activeSection ? 'active' : null)]),
    Marker::a($controller->router()->hyp('events'), 'Agenda', ['class' => ('Event ' == $activeSection ? 'active' : '')]),
    Marker::a($controller->router()->hyp('movies'), 'Filmothèque', ['class' => ('Movie' == $activeSection ? 'active' : '')]),
    Marker::a($controller->router()->hyp('professionals'), 'Professionnel·le·s', ['class' => ('Professional' == $activeSection ? 'active' : '')]),
    Marker::a($controller->router()->hyp('organisations'), 'Organisations', ['class' => ('Organisation' == $activeSection ? 'active' : '')]),
    Marker::a($controller->router()->hyp('jobs'), 'Castings & Jobs', ['class' => ('Job' == $activeSection ? 'active' : '')]),
    Marker::a($controller->router()->hyp('shop'), 'Boutique', ['class' => ('Shop' == $activeSection ? 'active' : '')]),
    Marker::a('/podcast', 'Podcast', ['class' => ('Podcast' == $activeSection ? 'active' : '')])
];
?>
<form id="search-bar" class="d-print-none" action="<?= $controller->router()->hyp('search') ?>">
    <div class="fixed-layout">
        <input type="search" value="" autocomplete="off" placeholder="Rechercher" name="s" value="<?= $controller->router()->params('s') ?>" class="form-control">
        <button class="btn btn-primary" type="submit" title="Rechercher">
            <?= $this->bi('search'); ?>
        </button>
    </div>
</form>
<header>
    <div class="fixed-layout">
        <a href="<?= $controller->router()->hyp('home') ?>" title="CINERGIE">
            <img src="/public/assets/img/logo-cinergie.svg" alt="Logo de Cinergie.be" class="logo">
        </a>

        <nav id="primary-navigation" role="navigation">
            <ul> <?php foreach ($menu as $item) {
                        echo '<li>' . $item . '</li>';
                    } ?>
            </ul>
        </nav>

        <div class="nav-controls">
            <button class="toggler" type="button" aria-controls="search-bar" aria-expanded="false" aria-label="Toggle navigation">
                <?= $this->bi('search'); ?>
            </button>

            <button class="toggler" type="button" aria-controls="primary-navigation" aria-expanded="false" aria-label="Toggle navigation">
                <?= $this->bi('filter-right'); ?>
            </button>
        </div>
    </div>
</header>