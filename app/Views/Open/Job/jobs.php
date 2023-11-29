<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => $page->get('label')]) ?>


<div class="container" id="casting">

    <div id="filtres" class="row align-items-end pb-3 pe-lg-4">
        <div class="col-lg-8 col-6">
            <?= $this->insert('Open::Job/form_filters'); ?>
        </div>

        <div class="col-lg-4 col-6 ps-lg-5 mt-sm-3 mt-lg-0">
            <button type="button" class="btn btn-outline-primary add-btn col-12" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-annonce">
                <i class="bi bi-plus-circle"></i> Ajoutez votre annonce
            </button>
            <?= $this->insert('Open::Job/modal_new'); ?>
        </div>
    </div>

    <section class="row my-5">
        <div class="col-lg-8 pe-lg-4" id="listing-casting">
            <h2 class="line-left"><span class="text-primary h3"></span>Offres et demandes dans le cinéma belge</h2>
            <?php
            foreach ($paginator->records() as $work) {
                $this->insert('Open::Job/card', ['work' => $work]);
            }
            ?>
            <?= $this->insert('Open::_partials/pagination', ['route' => 'jobs', 'paginator' => $paginator]); ?>
        </div>
        <aside class="col-lg-4 ps-lg-5" id="sidebar">
            <?= $this->insert('Open::Article/latest', ['articles' => $latestArticles]); ?>
        </aside>
    </section>


</div>