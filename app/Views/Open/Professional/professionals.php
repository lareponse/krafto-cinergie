<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => "Le répertoire des professionnels du cinéma belge"]) ?>


<div class="container my-5">
    <section class="row">

        <?= $this->insert('Open::Professional/sidebar'); ?>

        <div class="col-12 col-xl-8 offset-xl-1">

            <section class="row my-5" id="professionnels">


                <?php
                if (empty($paginator->records()))
                    echo Marker::strong('Pas de résultats correspondant à vos critères');
                else{
                    echo Marker::strong($paginator->recordCount() . ' professionnels');

                    foreach ($paginator->records() as $record) {
                        ?>
                    <div class="col-lg-4 col-md-6" id="professionnel-item">
                        <article class="card mb-4 shadow">
                            <a href="<?= $controller->router()->hyp('professional', ['slug' => $record->slug()]) ?>">
                                <div class="card-body">
                                    <img src="<?= $record->profilePicture(); ?>" class="card-img-top mb-3" alt="Photo de <?= $record->fullName(); ?>">
                                    <div class="p-3">
                                        <h5 class="card-title"><?= $record->fullName(); ?></h5>
                                        <p class="card-text"><small class="text-secondary">
                                            <?php
                                                foreach ($record->praxisIds() as $praxisId) {
                                                    echo $praxis[$praxisId] . Marker::br();
                                                }
                                                ?>
                                            </small></p>
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