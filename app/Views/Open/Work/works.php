<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => "Les petites annonces Cinergie.be"]) ?>


<div class="container" id="casting">

    <section class="row align-items-end pb-3 pe-lg-4">
        <div class="col-lg-8">
            <?= $this->insert('Open::Work/form_filters'); ?>
        </div>

        <!-- Modal nouvelles annonce -->
        <div class="col-lg-4 ps-lg-5">
            <button type="button" class="btn btn-outline-primary add-btn" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-annonce">
                <i class="bi bi-plus-circle"></i> Ajoutez votre annonce
            </button>
            <?= $this->insert('Open::Work/modal_new'); ?>

        </div>

    </section>


    <section class="row my-5">
        <div class="col-lg-8 pe-lg-4" id="listing-casting">
            <h2 class="line-left"><span class="text-primary h3"></span>Offres et demandes dans le cinéma belge</h2>
            <?php
            foreach ($paginator->records() as $work) {
            ?>
                <article class="card shadow listing mb-4">
                    <a href="<?=$controller->router()->hyp('work', ['slug' => $work->slug()])?>">
                    </a>
                    <div class="card-body"><a href="<?=$controller->router()->hyp('work', ['slug' => $work->slug()])?>">
                            <section class="card-text d-flex justify-content-between">
                                <p><span class="categorie mb-2">
                                    <?= $work->get('isPaid') ? 'Rémunéré' : 'Non rémunéré' ?></span>
                                     • <span class="type"><?= $work->get('type_label')?></span>
                                     • <span class="type"><?= $work->get('legacy_subject')?></span>
                                    </p>
                                <p><span class="date-casting text-primary otto-date"><?= $work->get('starts')?></span> <span class="date-casting text-primary otto-date"><?= $work->get('stops')?></span></p>
                            </section>
                            <h5 class="card-title"><?= $work->get('legacy_title');?></h5>
                        </a><a class="cta" href="<?=$controller->router()->hyp('work', ['slug' => $work->slug()])?>">Lire l'annonce</a>
                    </div>

                </article>
            <?php
            }
            ?>
            <?= $this->insert('Open::_partials/pagination', ['route' => 'works', 'paginator' => $paginator]); ?>
        </div>
        <aside class="col-lg-4 ps-lg-5" id="sidebar">
            <?= $this->insert('Open::Article/latest', ['articles' => $latestArticles]);?>
        </aside>
    </section>


</div>