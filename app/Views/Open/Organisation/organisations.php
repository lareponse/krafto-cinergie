<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open/layout', ['title' => $page->label()]) ?>
<div class="container">

    <div class="d-flex justify-content-between mb-4">
        <button id="filtreBtn" class="btn btn-black d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtre-sidebar">
            <h5><i class="bi bi-sliders me-2"></i>Filtrer</h5>
        </button>

        <h5 class="d-none d-xl-block  invisible"><i class="bi bi-sliders me-2"></i>Filtrer</h5>

        <button class="btn btn-outline-primary add-btn" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-organisation">
            <i class="bi bi-plus-circle"></i>
            Ajouter votre organisation
        </button>

    </div>

    <div class="row">
        <aside id="sidebar" class="col-12 col-xl-3 mb-5 mb-xl-0">
            <div id="filtres" class="shadow d-none d-xl-block">
                <?= $this->insert('Open/Organisation/form_filters'); ?>
            </div>
        </aside>

        <div class="col-12 col-xl-8 offset-xl-1">
            <div class="row mb-5 organisations">
                <?php
                if (empty($paginator->records()))
                    echo Marker::strong('Pas de résultats correspondant à vos critères');
                else {
                    foreach ($paginator->records() as $record) {
                ?>
                        <div class="col-lg-4 col-md-6 organisation-item">
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

<div class="offcanvas offcanvas-start" tabindex="-1" id="filtre-sidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="bi bi-sliders me-2"></i>Filtrer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?= $this->insert('Open/Organisation/form_filters'); ?>
    </div>
</div>
<?= $this->insert('Open/Organisation/modal_alter', ['data-bs-target' => "modal-nouvelle-organisation"]); ?>