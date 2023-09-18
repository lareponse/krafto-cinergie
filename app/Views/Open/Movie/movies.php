<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => $page->label()]) ?>

<div class="container my-5">
    <section class="row">
        <?= $this->insert('Open::Movie/sidebar'); ?>
        <div class="col-12 col-xl-8 offset-xl-1">

            <h3>Tous les films</h3>
            <section class="row" id="filmotheque">
            <?php
                if (empty($paginator->records()))
                    echo Marker::strong('Pas de résultats correspondant à vos critères');
                else {

                    foreach ($paginator->records() as $record) {
                        ?>
                    <div class="col-lg-4 mb-5" id="film-item">
                        <article class="card shadow">
                            <div class="card-body">
                                <a href="<?=$controller->router()->hyp('movie', ['slug' => $record->slug()])?>">
                                    <img src="<?=$record->profilePicture()?>" class="card-img-top mb-3" alt="Photo du film <?= $record->get('label');?>">
                                </a>
                                <div class="px-3 pb-3">
                                    <a href="<?=$controller->router()->hyp('movie', ['slug' => $record->slug()])?>">
                                        <div class="meta">
                                            <p class="date"><small class="text-secondary"><?= $record->get('released');?></small></p>
                                            <p class="categorie"><small class="text-primary"><?= $record->get('genre');?></small></p>
                                        </div>
                                        <h5 class="card-title"><?= $record->get('label');?></h5>
                                        <p class="auteur"><?= $record->get('directors');?></p>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                    <?php
                    }
                }
                ?>
    
            </section>
            <?= $this->insert('Open::_partials/pagination', ['route' => 'movies', 'paginator' => $paginator]); ?>
        </div>
    </section>
</div>