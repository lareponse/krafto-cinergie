<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => "Le répertoire des professionnels du cinéma belge"]) ?>

<div class="container my-5">
    <section class="row">
        <?= $this->insert('Open::Professional/sidebar'); ?>
        <div class="col-12 col-xl-8 offset-xl-1">
             <h3>Tous les professionnels</h3>

            <section class="row" id="professionnels">
                <?php
                if (empty($paginator->records()))
                    echo Marker::strong('Pas de résultats correspondant à vos critères');
                else {
                    foreach ($paginator->records() as $record) {
                ?>
                        <div class="col-lg-4 col-md-6" id="professionnel-item">
                            <article class="card mb-4 shadow">
                                <a href="<?= $controller->router()->hyp('professional', ['slug' => $record->slug()]) ?>">
                                    <div class="card-body">
                                        <img src="<?= $record->profilePicture(); ?>" class="card-img-top mb-3" alt="Photo de <?= $record->fullName(); ?>">
                                        <div class="p-3">
                                            <h5 class="card-title"><?= $record->fullName(); ?></h5>
                                            <p class="card-text"><small class="text-secondary"><?= $record->get('praxes'); ?></small></p>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        </div>
                <?php
                    }
                }
                ?>
            </section>

            <?= $this->insert('Open::_partials/pagination', ['route' => 'professionals', 'paginator' => $paginator]); ?>
        </div>
    </section>
</div>