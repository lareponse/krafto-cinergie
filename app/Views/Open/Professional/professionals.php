<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => $page->label()]) ?>

<div class="container my-5">
    <section class="row">
        <?= $this->insert('Open::Professional/sidebar'); ?>
        <div class="col-12 col-xl-8 offset-xl-1">
            <h3>Tous les professionnels</h3>

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
    </section>
</div>