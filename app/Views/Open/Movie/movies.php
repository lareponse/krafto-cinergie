<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => $page->label()]) ?>
<div class="container">
    <button id="filtreBtn" class="btn btn-black d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtre-sidebar">
        <h5><i class="bi bi-sliders me-2"></i>Filtrer</h5>
    </button>

    <div id="filmotheque" class="filmotheque catalog">
        <?php
        $this->insert('Open/Movie/sidebar_filters');

        if (empty($paginator->records()))
            echo Marker::strong('Pas de résultats correspondant à vos critères');
        else {
            foreach ($paginator->records() as $record) {
                $this->insert('Open::Movie/card', ['record' => $record]);
            }
        }
        ?>
    </div>
    <?= $this->insert('Open::_partials/pagination', ['route' => 'movies', 'paginator' => $paginator]); ?>
</div>