<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => $page->label()]) ?>
<div class="container">
    <div class="row">
        <aside id="sidebar" class="col-12 col-xl-3 mb-5 mb-xl-0">
            <?= $this->insert('Open::Movie/sidebar'); ?>
        </aside>

        <div class="col-12 col-xl-8 offset-xl-1">
            <h3>Tous les films</h3>
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