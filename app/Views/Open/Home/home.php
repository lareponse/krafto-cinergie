<?php $this->layout('Open::layout') ?>

<div id="banner" class="container-custom-banner">
    <?php
    foreach ($articlesDiaporama as $article) {
        $href = $controller->router()->hyp('article', ['slug' => $article->slug()]);

    ?>
        <article class="card slide">
            <img src="<?= $article->profilePicture() ?>" class="card-img" alt="<?= $article->get('label'); ?> - <?= $article->get('author_label'); ?>">
            <div class="card-img-overlay">
                <h3 class="card-title h1"><?= $article->get('label'); ?></h3>
                <p class="card-text"><small class="text-primary"><?= $article->get('author_label'); ?></small></p>
                <p class="card-text">
                    <?= substr(strip_tags($article->get('abstract')), 0, 400); ?>...
                </p>
                <p><a href="<?= $href ?>" class="btn btn-primary">En savoir plus</a></p>
            </div>
            <div class="card carrousel card-img-overlay">
            </div>
        </article>
    <?php
    }
    ?>

</div>


<div class="container">
    <?php
    if (!empty($entrevues)) {
        $this->insert('Open::Home/section_entrevue', ['entrevues' => $entrevues]);
    }

    if (!empty($contests)) {
        $this->insert('Open::Home/section_contest', ['contests' => $contests]);
    }

    if (!empty($sousLaLoupe)) {
        $this->insert('Open::Home/section_loupe', ['sousLaLoupe' => $sousLaLoupe]);
    }
    ?>
</div>
</div>

<div class="d-lg-block bg-light py-5 mt-5" id="home-rdv-annonce">
    <div class="container">
        <section class="row">
            <div class="col-lg-5">
                <?php $this->insert('Open::Home/section_event', ['events' => $events]); ?>
            </div>
            
            <div class="offset-lg-1 col-lg-5">
                <?php $this->insert('Open::Home/section_job', ['jobs' => $jobs]); ?>
            </div>
        </section>
    </div>
</div>