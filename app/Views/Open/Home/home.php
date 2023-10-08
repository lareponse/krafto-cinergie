<?php $this->layout('Open::layout') ?>


<div class="container-custom-banner">
    <section id="banner">
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

    </section>
</div>


<div class="container">
    <section class="my-5" id="entrevues-filmees">
        <h2 class="line-left"><span class="text-primary">Entrevues</span> filmées</h2>

        <section class="row">
            <?php
            foreach ($entrevuesFilmees as $article) {
                $href = $controller->router()->hyp('article', ['slug' => $article->slug()]);
            ?>
                <div class="col-lg-4" id="article-item">
                    <article class="card mb-4 shadow">
                        <a href="<?= $href ?>">
                            <img src="<?= $article->profilePicture() ?>" class="card-img-top" alt="<?= $article->get('label'); ?> - <?= $article->get('author_label'); ?>">
                        </a>
                        <div class="card-body">
                            <a href="<?= $href ?>" class="btn btn-sm btn-primary taxo-cat">Catégorie</a>
                            <a href="<?= $href ?>">
                                <p class="date otto-date"><?= $article->get('publication'); ?></p>
                                <h5 class="card-title"><?= $article->get('label'); ?></h5>
                                <a href="<?= $href ?>" class="cta cta-card">Lire l'article</a>
                            </a>
                        </div>
                    </article>
                </div>
            <?php
            }
            ?>
        </section>

        <aside class="my-5 mx-auto text-center" id="call-to-action">
            <p>
                <a class="cta" href="<?= $controller->router()->hyp('articles') ?>?<?= http_build_query(['ac[]' => '50']) ?>">Plus d'entrevues</a>
            </p>
        </aside>
    </section>
    <?php
    if (!empty($contests)) {
    ?>
        <section class="my-5" id="concours">
            <h2 class="line-left"><span class="text-primary">Concours</span> du moment</h2>

            <section id="concours-du-moment">
                <?php
                foreach ($contests as $contest) {
                ?>
                    <div class="slide" id="concours-item">
                        <article class="card concours mx-1">
                            <a href="article-single.php">
                                <img src="<?= $contest->profilePicture() ?>" class="card-img-top" alt="...">
                            </a>
                            <div class="card-body px-4 py-3">
                                <p class="date">3 octobre 2022</p>
                                <h5 class="card-title">17e édition du concours À Films Ouverts</h5>
                                <a href="article-single.php" class="cta">Consulter</a>
                            </div>
                        </article>
                    </div>
                <?php
                }
                ?>
            </section>

            <aside class="my-5 mx-auto text-center" id="call-to-action">
                <p>
                    <a class="cta" href="<?= $controller->router()->hyp('contests') ?>">Tous les concours</a>
                </p>
            </aside>
        </section>
    <?php
    }
    ?>
    <section class="my-5" id="cinema-belge-loupe">
        <h2 class="line-left"><span class="text-primary">Le cin&eacute;ma belge</span> sous la loupe</h2>

        <section class="row">
            <?php
            foreach ($sousLaLoupe as $article) {
                $href = $controller->router()->hyp('article', ['slug' => $article->slug()]);

            ?>
                <div class="col-lg-4" id="article-item">
                    <article class="card mb-4 shadow">
                        <a href="<?= $href ?>">
                            <img src="<?= $article->profilePicture() ?>" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <a href="<?= $href ?>" class="btn btn-sm btn-primary taxo-cat">Catégorie</a>
                            <a href="<?= $href ?>">
                                <p class="date otto-date"><?= $article->get('publication') ?></p>
                                <h5 class="card-title"><?= $article->get('label') ?></h5>
                                <a class="cta cta-card">Lire l'article</a>
                            </a>
                        </div>
                    </article>
                </div>
            <?php
            }
            ?>
        </section>

        <aside class="my-5 mx-auto text-center" id="call-to-action">
            <p>
                <a class="cta" href="<?= $controller->router()->hyp('articles') ?>">Plus d'actualit&eacute;</a>
            </p>
        </aside>
    </section>
</div>

<section class="d-lg-block bg-light py-5 mt-5" id="home-rdv-annonce">
    <div class="container">
        <section class="row">
            <div class="col-lg-5">
                <h3 class="line-left overflow h4">
                    <span class="text-primary">Vos rendez-vous</span>
                    <br>avec le cin&eacute;ma belge
                </h3>
                <?php
                foreach ($events as $event) {
                ?>
                    <article class="card listing mb-3">
                        <div class="row g-0">
                            <div class="col-md-4" id="date">
                                <span>10</span>
                                <span>NOV</span>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $event->get('label') ?></h5>
                                    <p class="card-text">jusqu'au <span class="text-primary otto-date"><?= $event->get('stops') ?></span></p>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php
                }
                ?>
                <aside class="my-5" id="call-to-action">
                    <a class="cta" href="<?= $controller->router()->hyp('events') ?>">Consulter l'agenda</a>
                </aside>
            </div>
            
            <div class="offset-lg-1 col-lg-5">
                <h3 class="line-left overflow h4">
                    <span class="text-primary">Les petites annonces</span>
                    <br>du cin&eacute;ma belge
                </h3>
                <?php
                foreach ($jobs as $job) {
                ?>
                    <article class="card listing mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= $job ?></h5>
                            <p class="card-text d-flex justify-content-between">
                                <span class="type"><?= $job->get('category_label'); ?></span>
                                <span class="text-primary otto-date"><?= $job->get('starts') ?></span>
                            </p>
                        </div>
                    </article>
                <?php
                }
                ?>

                <aside class="my-5" id="call-to-action">
                    <a class="cta" href="<?= $controller->router()->hyp('jobs') ?>">Plus d'annonces</a>
                </aside>
            </div>
        </section>
    </div>

</section>

</div>