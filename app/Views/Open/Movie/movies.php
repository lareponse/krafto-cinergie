<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => $page->label()]) ?>
<div class="container">
    <button id="filtreBtn" class="btn btn-black d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtre-sidebar">
        <h5><i class="bi bi-sliders me-2"></i>Filtrer</h5>
    </button>

    <div class="row">
        <div class="col-xl-3">
            <?= $this->insert('Open/Movie/sidebar_filters'); ?>
        </div>

        <div class="col-12 col-xl-8 offset-xl-1">
            <div class="row filmotheque">
                <?php
                if (empty($paginator->records()))
                    echo Marker::strong('Pas de résultats correspondant à vos critères');
                else {
                    foreach ($paginator->records() as $record) {
                ?>
                        <div class="col-lg-4 mb-5">
                            <?= $this->insert('Open::Movie/card', ['record' => $record]); ?>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <?= $this->insert('Open::_partials/pagination', ['route' => 'movies', 'paginator' => $paginator]); ?>
        </div>
    </div>
</div>