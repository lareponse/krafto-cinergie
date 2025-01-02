<?php

use \HexMakina\Marker\Marker;

?>

<?php $this->layout('Open/layout', ['title' => $page->label()]) ?>
<div class="container">

    <div class="text-right mb-4">
        <button class="btn btn-outline-primary add-btn ms-auto shadow-box-trigger" data-shadow-template="template_alter_prorg">
            <?= $this->bi('plus-circle') ?>
            <span><span class="d-none d-lg-inline">Ajouter</span> votre organisation</span>
        </button>
    </div>

    <div id="organisations" class="catalog">

        <?php
        $this->insert('Open/Organisation/sidebar_filters');

        if (empty($paginator->records()))
            echo Marker::strong('Aucun résultat ne correspond à vos critères');
        else {
            foreach ($paginator->records() as $record) {
                $this->insert('Open/Organisation/card', ['record' => $record]);
            }
        }
        ?>
    </div>
    <?= $this->insert('Open::_partials/pagination', ['route' => 'organisations', 'paginator' => $paginator]); ?>

</div>

<?= $this->insert('Open::_partials/modalter_prorg', ['record' => new \App\Models\Organisation()]); ?>