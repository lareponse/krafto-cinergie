<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open/layout', ['title' => $page->label()]) ?>
<div class="container">

    <div class="d-flex justify-content-between mb-4">
        <button id="filtreBtn" class="btn btn-black d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtre-sidebar">
            <h5><i class="bi bi-sliders me-2"></i>Filtrer</h5>
        </button>

        <button class="btn btn-outline-primary add-btn ms-auto" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-organisation">
            <i class="bi bi-plus-circle"></i>
            <span class="d-none d-lg-inline">Ajouter</span> votre organisation
        </button>
    </div>

    <div class="row">
        <div class="col-xl-3">
            <?= $this->insert('Open/Organisation/sidebar_filters'); ?>
        </div>

        <div class="col-xl-8 offset-xl-1">
            <div class="row mb-5 organisations">
                <?php
                if (empty($paginator->records()))
                    echo Marker::strong('Pas de résultats correspondant à vos critères');
                else {
                    foreach ($paginator->records() as $record) {
                ?>
                        <div class="col-lg-4 col-md-6">
                            <?= $this->insert('Open/Organisation/card', ['record' => $record]) ?>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <?= $this->insert('Open/_partials/pagination', ['route' => 'organisations', 'paginator' => $paginator]); ?>
        </div>

    </div>
</div>

<?= $this->insert('Open/Organisation/modal_alter', ['data-bs-target' => "modal-nouvelle-organisation"]); ?>