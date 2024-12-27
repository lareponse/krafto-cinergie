<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => $page->label()]) ?>

<div class="container">
    <div class="d-flex justify-content-between mb-4">


        <button class="btn btn-outline-primary add-btn ms-auto" data-bs-toggle="modal" data-bs-target="#modalter_prorg">
            <?= $this->bi('plus-circle'); ?>
            <span class="d-none d-lg-inline">Ajouter</span> votre fiche professionnelle
        </button>
    </div>

    <div id="professionals" class="catalog">
        <div><!-- here for grid span 2 -->
            <?= $this->insert('Open/Professional/sidebar_filters'); ?>
        </div>
        <?php
        if (empty($paginator->records()))
            echo Marker::strong('Aucun résultat ne correspond à vos critères');
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

<?= $this->insert('Open::_partials/modalter_prorg', ['record' => new \App\Models\Professional()]); ?>