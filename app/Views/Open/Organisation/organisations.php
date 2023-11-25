<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => $page->label()]) ?>

<div class="container">
    <div class="row my-5">
        <aside id="sidebar" class="col-12 col-xl-3 mb-5 mb-xl-0">
            <?= $this->insert('Open::Organisation/sidebar'); ?>
        </aside>

        <div class="col-12 col-xl-8 offset-xl-1">
            <div class="row my-5 organisations">

                <?php
                if (empty($paginator->records()))
                    echo Marker::strong('Pas de résultats correspondant à vos critères');
                else {
                    foreach ($paginator->records() as $record) {
                        $href = $controller->router()->hyp('organisation', ['slug' => $record->slug()]);
                ?>

                        <div class="col-lg-4 col-md-6 organisation-item">
                            <article class="card mb-4 shadow">
                                <div class="card-body text-center">
                                    <a href="<?= $href ?>">
                                        <img src="<?= $record->profilePicture(); ?>" class="card-img-top mb-3" alt="Photo <?= $record->get('label'); ?>" />
                                        <h5 class="card-title"><?= $record->get('label'); ?></h5>
                                        <p class="card-text mt-3"><small class="text-secondary"><?= $record->get('praxes'); ?></small></p>
                                    </a>
                                </div>
                            </article>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <?= $this->insert('Open::_partials/pagination', ['route' => 'organisations', 'paginator' => $paginator]); ?>
        </div>

    </div>
</div>