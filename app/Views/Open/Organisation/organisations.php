<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => "Le répertoire des organisations belges de cinéma"]) ?>


<div class="container my-5">
    <section class="row">

        <?= $this->insert('Open::Organisation/sidebar'); ?>

        <div class="col-12 col-xl-8 offset-xl-1">
            <h3>Toutes les organisations</h3>
            <section class="row" id="organisations">

                <?php
                if (empty($paginator->records()))
                    echo Marker::strong('Pas de résultats correspondant à vos critères');
                else {
                    foreach ($paginator->records() as $record) {
                ?>
                        <div class="col-lg-4 col-md-6" id="organisation-item">
                            <article class="card mb-4 shadow">
                                <div class="card-body text-center">
                                    <a href="<?= $controller->router()->hyp('organisation', ['slug' => $record->slug()]) ?>">
                                        <img src="<?= $record->profilePicture(); ?>" class="card-img-top mb-3" alt="Photo <?= $record->get('label'); ?>" />
                                        <h5 class="card-title"><?= $record->get('label'); ?></h5>
                                        <p class="card-text"><small class="text-secondary"><?= $record->get('praxes'); ?></small></p>

                                    
                                    </a>
                                </div>
                            </article>
                        </div>
                <?php
                    }
                }
                ?>

            </section>
            <?= $this->insert('Open::_partials/pagination', ['route' => 'organisations', 'paginator' => $paginator]); ?>

        </div>

    </section>
</div>