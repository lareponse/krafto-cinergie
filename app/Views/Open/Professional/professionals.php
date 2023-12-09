<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => $page->label()]) ?>
<div class="container">

    <div class="d-flex justify-content-between mb-4">

        <button id="filtreBtn" class="btn btn-black d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtre-sidebar">
            <h5><i class="bi bi-sliders me-2"></i>Filtrer</h5>
        </button>
        <h5 class="d-none d-xl-block"><i class="bi bi-sliders me-2"></i>Filtrer</h5>

        <button class="btn btn-outline-primary add-btn" data-bs-toggle="modal" data-bs-target="#modal-fiche-professionnel">
            <i class="bi bi-plus-circle"></i>
            Ajouter votre fiche professionnelle
        </button>

    </div>

    <div class="row">
        <aside id="sidebar" class="d-none d-xl-block col-xl-3 mb-5 mb-xl-0">
            <div class="shadow pb-3">
                <?= $this->insert('Open::Professional/form_filters'); ?>
            </div>
        </aside>

        <div id="filtre-mobile" class="d-block d-xl-none">
            <div class="offcanvas offcanvas-start" tabindex="-1" id="filtre-sidebar">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="bi bi-sliders me-2"></i>Filtrer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <?= $this->insert('Open::Professional/form_filters'); ?>
                </div>
            </div>
        </div>

        <div class="col-xl-8 offset-xl-1">
            <div class="row mb-5" id="professionnels">
                <?php
                if (empty($paginator->records()))
                    echo Marker::strong('Pas de résultats correspondant à vos critères');
                else {
                    foreach ($paginator->records() as $record) {
                ?>
                        <div class="col-lg-4 col-md-6 ">
                            <?= $this->insert('Open::Professional/card', ['record' => $record]); ?>
                        </div>
                <?php
                    }
                }
                ?>
            </div>

            <?= $this->insert('Open::_partials/pagination', ['route' => 'professionals', 'paginator' => $paginator]); ?>
        </div>
    </div>
</div>

<?= $this->insert('Open::Professional/modal_alter', ['data-bs-target' => 'modal-fiche-professionnel']); ?>
<?= $this->insert('Open::Professional/form_fiche', ['target' => 'modal-fiche-professionnel']); ?>