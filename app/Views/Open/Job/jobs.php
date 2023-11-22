<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => $page->get('label')]) ?>


<div class="container" id="casting">

    <section class="row align-items-end pb-3 pe-lg-4">
        <div class="col-lg-8">
            <?= $this->insert('Open::Job/form_filters'); ?>
        </div>

        <!-- Modal nouvelles annonce -->
        <div class="col-lg-4 ps-lg-5">
            <button type="button" class="btn btn-outline-primary add-btn" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-annonce">
                <i class="bi bi-plus-circle"></i> Ajoutez votre annonce
            </button>
            <?= $this->insert('Open::Job/modal_new'); ?>

        </div>

    </section>


    <section class="row my-5">
        <div class="col-lg-8 pe-lg-4" id="listing-casting">
            <h2 class="line-left"><span class="text-primary h3"></span>Offres et demandes dans le cinéma belge</h2>
            <?php
            foreach ($paginator->records() as $work) {
            ?>
                <article class="card shadow listing mb-4">
                    <a href="<?= $controller->router()->hyp('work', ['slug' => $work->slug()]) ?>">
                        <div class="card-body">
                            <section class="card-text d-flex justify-content-between">
                                <p><span class="categorie mb-2">
                                        <?= $work->get('isPaid') ? 'Rémunéré' : 'Non rémunéré' ?></span>
                                    &bull; <span class="type"><?= $work->get('isOffer') ? $job_proposal['job_offer'] : $job_proposal['job_request']; ?></span>
                                    &bull; <span class="type"><?= $work->get('category_label') ?></span>
                                <p><span class="date-casting text-primary otto-date"><?= $work->get('starts') ?></span></p>
                            </section>
                            <h5 class="card-title"><?= $work->get('label'); ?></h5>
                            <div class="cta">Lire l'annonce</div>
                        </div>
                    </a>
                </article>
            <?php
            }
            ?>
            <?= $this->insert('Open::_partials/pagination', ['route' => 'works', 'paginator' => $paginator]); ?>
        </div>
        <aside class="col-lg-4 ps-lg-5" id="sidebar">
            <?= $this->insert('Open::Article/latest', ['articles' => $latestArticles]); ?>
        </aside>
    </section>


</div>