<?php

use \HexMakina\Marker\Marker;

$modal_id = 'modal_job';

?>

<?php $this->layout('Open/layout', ['title' => $page->get('label')]) ?>

<div class="container" id="casting">
    <div class="row my-5">
        <section class="col-lg-8 col-xl-7 pe-lg-4" id="listing-casting">
            <h2 class="line-left"><span class="text-primary h3"></span>Offres et demandes dans le cinéma belge</h2>

            <div class="d-flex justify-content-between mb-3">
                <button id="filtreBtn" class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtre-sidebar">
                    <span class="text-white"><?= $this->bi('sliders', ['class' => 'me-2']); ?>Filtrer</span>
                </button>

                <button type="button" class="btn btn-outline-primary shadow-box-trigger add-btn" data-shadow-template="template_add_job">
                    <?= $this->bi('plus-circle') ?>
                    <span><span class="d-none d-sm-inline">Ajoutez</span> votre annonce</span>
                </button>
            </div>

            <?php
            foreach ($paginator->records() as $job) {
                $this->insert('Open/Job/card', ['job' => $job]);
            }

            $this->insert('Open/_partials/pagination', ['route' => 'jobs', 'paginator' => $paginator]);
            ?>
        </section>

        <aside class="col-lg-4 col-xl-5 ps-lg-5" id="sidebar">
            <?= $this->insert('Open/Article/latest', ['articles' => $latestArticles]); ?>
        </aside>
    </div>
</div>

<!-- modal responsive filtering -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="filtre-sidebar">
    <div class="offcanvas-header">
        <h4 class="offcanvas-title" id="offcanvasExampleLabel">Annonces</h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?= $this->insert('Open/Job/form_filters'); ?>
    </div>
</div>

<?= $this->insert('Open/Job/modal'); ?>