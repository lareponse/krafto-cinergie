<?php

use \HexMakina\Marker\Marker;

$this->layout('Open::layout', ['title' => 'RÉSULTATS DE VOTRE RECHERCHE']);
?>
<div class="container mb-lg-5 pb-5" id="boutique">
    <ul class="nav nav-tabs align-items-end" id="boutiqueTabs">
        <li class="nav-item pb-0">
            <?php $active = empty($controller->router()->params('tab')) || $controller->router()->params('tab') == 'art' ? 'active' : ''; ?>
            <a href="#recherche-articles" class="nav-link <?= $active ?>" data-bs-toggle="tab"><i class="bi bi-newspaper"></i>Articles (<?= $articles->totalRecords() ?>)</a>
        </li>
        <li class="nav-item pb-0">
            <?php $active = $controller->router()->params('tab') == 'pro' ? 'active' : ''; ?>
            <a href="#recherche-professionnels" class="nav-link <?= $active ?>" data-bs-toggle="tab"><i class="bi bi-person"></i>Professionnels (<?= $professionals->totalRecords() ?>)</a>
        </li>
        <li class="nav-item pb-0">
            <?php $active = $controller->router()->params('tab') == 'mov' ? 'active' : ''; ?>

            <a href="#recherche-films" class="nav-link <?= $active ?>" data-bs-toggle="tab"><i class="bi bi-film"></i>Films (<?= $movies->totalRecords() ?>)</a>
        </li>
        <li class="nav-item pb-0">
            <?php $active = $controller->router()->params('tab') == 'org' ? 'active' : ''; ?>

            <a href="#recherche-organisations" class="nav-link <?= $active ?>" data-bs-toggle="tab"><i class="bi bi-building"></i>Organisations (<?= $organisations->totalRecords() ?>)</a>
        </li>
    </ul>

    <div class="tab-content">
        <?php $active = empty($controller->router()->params('tab')) || $controller->router()->params('tab') == 'art' ? 'show active' : ''; ?>
        <div class="tab-pane fade <?= $active ?>" id="recherche-articles">
            <?= $this->insert('Open::Search/tab/articles'); ?>

        </div>

        <?php $active = $controller->router()->params('tab') == 'pro' ? 'show active' : ''; ?>
        <div class="tab-pane fade <?= $active ?>" id="recherche-professionnels">
            <?= $this->insert('Open::Search/tab/professionals'); ?>
        </div>

        <?php $active = $controller->router()->params('tab') == 'mov' ? 'show active' : ''; ?>
        <div class="tab-pane fade <?= $active ?>" id="recherche-films">
            <?= $this->insert('Open::Search/tab/movies'); ?>

        </div>

        <?php $active = $controller->router()->params('tab') == 'org' ? 'show active' : ''; ?>

        <div class="tab-pane fade <?= $active ?>" id="recherche-organisations">
            <?= $this->insert('Open::Search/tab/organisations'); ?>

        </div>
    </div>
</div>