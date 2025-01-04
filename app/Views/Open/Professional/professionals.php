<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => $page->label()]) ?>

<button class="btn btn-outline-primary add-btn ms-auto shadow-box-trigger" data-shadow-template="template_alter_prorg">
    <?= $this->bi('plus-circle') ?>
    <span><span class="d-none d-lg-inline">Ajouter</span> votre fiche professionnelle</span>
</button>

<?= $this->insert('Open::_partials/modalter_prorg', ['record' => new \App\Models\Professional()]); ?>

<div class="catalog professionals">
    <div><!-- here for grid span 2, sidebar filters are legion -->
        <?= $this->insert('Open/Professional/sidebar_filters'); ?>
    </div>
    <?php
    if (empty($paginator->records()))
        echo Marker::strong('Aucun résultat ne correspond à vos critères');
    else {
        foreach ($paginator->records() as $record) {
            echo $this->insert('Open::Professional/card', ['record' => $record]);
        }
    }
    ?>
</div>
<?= $this->insert('Open::_partials/pagination', ['route' => 'professionals', 'paginator' => $paginator]); ?>