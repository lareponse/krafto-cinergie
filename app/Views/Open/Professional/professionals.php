<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => $page->label()]) ?>

<div class="container">
    <div class="d-flex justify-content-between mb-4">
        <button id="filtreBtn" class="btn btn-black d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtre-sidebar">
            <h5><i class="bi bi-sliders me-2"></i>Filtrer</h5>
        </button>

        <button class="btn btn-outline-primary add-btn ms-auto" data-bs-toggle="modal" data-bs-target="#modal-fiche-professionnel">
            <i class="bi bi-plus-circle"></i>
            <span class="d-none d-lg-inline">Ajouter</span> votre fiche professionnelle
        </button>
    </div>

    <div id="professionals" class="catalog">
        <?= $this->insert('Open/Professional/sidebar_filters'); ?>
        <?php
        if (empty($paginator->records()))
            echo Marker::strong('Pas de résultats correspondant à vos critères');
        else {
            foreach ($paginator->records() as $record) {
        ?>
                <?= $this->insert('Open::Professional/card', ['record' => $record]); ?>
        <?php
            }
        }
        ?>

    </div>
    <?= $this->insert('Open::_partials/pagination', ['route' => 'professionals', 'paginator' => $paginator]); ?>

</div>

<?= $this->insert('Open/Professional/modal_alter', ['data-bs-target' => 'modal-fiche-professionnel']); ?>