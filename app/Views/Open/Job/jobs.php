<?php $this->layout('Open/layout', ['title' => $page->get('label')]) ?>

<div class="container" id="casting">
    <section id="listing-casting">
        <h2 class="line-left"><span class="text-primary h3"></span>Offres et demandes dans le cinéma belge</h2>

        <div class="d-flex justify-content-between mb-3">
            <button id="filtreBtn" class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtre-sidebar">
                <span class="text-white"><?= $this->bi('sliders', ['class' => 'me-2']); ?>Filtrer</span>
            </button>
            <button id="filter_jobs" class="btn btn-primary shadow-box-trigger" data-offcanvas-toggle="template_filtre_sidebar" type="button">
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
    <aside>
        <h2 class="h4 mb-4">Les dernières actualités</h2>
        <?php foreach ($latestArticles as $article) { ?>
            <a class="responsive-card shadow" href="<?= $controller->router()->hyp('article', ['slug' => $article->slug()]); ?>" title="">
                <img src="<?= $article->profilePicture(); ?>" alt="Profile picture for article">
                <span>
                    <span class="otto-date date"><?= $article->get('publication'); ?></span>
                    <strong><?= $article->get('label'); ?></strong>
                    <small class="cta">Lire notre <span class="otto-id-label" otto-urn="Tag:<?= $article->get('type_id') ?>"> article</span></small>
                </span>
            </a>
        <?php
        }
        ?>
    </aside>
</div>
<?= $this->insert('Open/Job/filters'); ?>
<?= $this->insert('Open/Job/modal'); ?>