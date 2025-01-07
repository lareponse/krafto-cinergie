<?php

use \HexMakina\Marker\Marker;

$this->layout('Open/layout', ['title' => $page->label()])
?>

<button class="btn btn-outline-primary add-btn ms-auto" data-shadow-box-template="template_alter_prorg">
    <?= $this->bi('plus-circle') ?>
    <span><span class="d-none d-lg-inline">Ajouter</span> votre organisation</span>
</button>

<div class="catalog">

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
<?= $this->insert('Open::_partials/modalter_prorg', ['record' => new \App\Models\Organisation()]); ?>