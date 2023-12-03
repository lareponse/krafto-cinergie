<?php $this->layout('Open::layout') ?>

<div id="auteur-single">
    <div class="w-75 my-5 pb-5 mx-auto">

        <div class="row">
            <div class="col-lg-4">
                <img class="img-fluid w-100" src="<?= $record->profilePicture() ?>" alt="auteur" />
            </div>

            <div class="col-lg-8 ps-lg-5 mt-5 mt-lg-0">
                <h2 class="line-left"><?= $record->fullName() ?></h2>

                <?php if (isset($professional)) { ?>
                    <p class="role">
                        <?= implode(', ', $professional->praxis()); ?>
                    </p>
                <?php } ?>

                <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                    nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
                    erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
                    et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est
                    Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur
                    sadipscing elitr, sed diam nonumy eirmod
                </p>
                <div class="share" id="share">
                    <span>Partager sur</span>
                    <span class="socials">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="mx-1 bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-envelope-fill"></i></a>
                    </span>
                </div>
            </div>
        </div>

    </div>

    <div class="my-5" id="related-posts">
        <h3 class="line-center articles-auteur my-4"><?= count($articles) ?> articles rédigés par cet auteur</h3>

        <?php // include('parts/pages/related-posts-listing.php'); 
        ?>
    </div>

</div>


<div id="auteur-single">
    <article class="w-75 mx-auto">

        <section class="row g-0 mt-4">

            <div class="col-lg-5">
                <img class="img-fluid w-100" src="<?= $record->profilePicture() ?>" alt="professionnel">
            </div>
            <?php if (isset($professional)) { ?>
                <div class="col-lg-7 ps-lg-5" id="infos">
                    <p class="text-primary"><strong><?= implode(', ', $professional->praxis()); ?></strong></p>
                    <?= $this->insert('Open::_partials/contact_info', ['contact' => $professional]); ?>
                </div>
            <?php } ?>

        </section>
    </article>

    <section class="my-5" id="related-posts">
        <h3 class="line-center articles-auteur my-4"><?= count($articles) ?> articles rédigés par cet auteur</h3>

        <section class="row">
            <?php
            foreach ($articles as $article) {
            ?>
                <div class="col-lg-6">
                    <article class="card shadow paysage mb-4">
                        <a href="<?= $controller->router()->hyp('article', ['slug' => $article->slug()]) ?>">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="<?= $article->profilePicture(); ?>" class="card-img-left img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <p class="date otto-date"><?= $article->get('publication'); ?></p>
                                        <h5 class="card-title"><?= $article->get('label'); ?></h5>
                                        <p class="cta">Lire l'article</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                </div>
            <?php
            }
            ?>

        </section>
    </section>
</div>