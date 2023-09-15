<?php $this->layout('Open::layout') ?>

<div class="container my-5 pb-5" id="boutique-single">
    <article class="mx-auto">

        <h1><?= $movie->get('label') ?></h1>
        <h6 class="text-primary">Fiction &bull; Relations (inter)personnelles &bull; Belgique</h6>
        <hr class="my-4" />

        <div class="share" id="share">
            <span>Partager sur</span>
            <span class="socials">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="mx-1 bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-envelope-fill"></i></a>
            </span>
        </div>


        <section class="row g-0 mt-4">

            <div class="col-lg-5">
                <img class="img-fluid w-100" src="<?= $movie->profilePicture() ?>" alt="Photo du film <?= $movie->get('label') ?>" />
            </div>

            <div class="col-lg-7 ps-lg-5" id="infos">
                <p class="text-primary"><b><span class="text-dark">de </span> Yvan Govar</b></p>
                <p><b>Date de sortie :</b> <?= $movie->get('released') ?></p>
                <p><b>Pays :</b> <?= $movie->get('legacy_origine') ?></p>
                <p><b>Genre :</b> Fiction</p>
                <p><b>Durée :</b> <?= $movie->get('runtime') ?></p>
                <br>
                <?= $movie->get('casting') ?>

                <?php
                if ($dvd) {
                ?>
                    <p class="mt-5">
                    <aside class="input-group big" id="commander-boutique">
                        <button class="form-control">
                            Commander </button>
                        <span class="input-group-text" id="prix">18,00 &euro;</span>
                    </aside>
                    </p>
                <?php
                }
                ?>
            </div>
        </section>


        <section id="bio" class="my-5">
            <h2 class="pb-0">Synopsis</h2>
            <hr />
            <p><?= $movie->get('content') ?></p>
        </section>

        <section class="my-5" id="related-posts">
            <div class="slide dots" id="single-post-slider">
                <article class="card paysage mr-4 mb-4">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <a href="article-single.php">
                                <img src="https://www.cinergie.be/images/actualite/film/_0/1985/1985--4-.jpg" class="card-img-left img-fluid rounded-start" alt="...">
                            </a>
                        </div>

                        <div class="col-md-8">
                            <a href="article-single.php">
                                <div class="card-body">
                                    <p class="date">16 janvier 2023</p>
                                    <h5 class="card-title">L'ambitieuse série 1985</h5>
                                    <a href="" class="cta">Lire l'article</a>
                                </div>
                            </a>
                        </div>

                    </div>
                </article>

                <article class="card paysage mr-4 mb-4">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="https://www.cinergie.be/images/actualite/film/_0/1985/1985--4-.jpg" class="card-img-left img-fluid rounded-start" alt="...">
                        </div>

                        <div class="col-md-8">
                            <a href="article-single.php">
                                <div class="card-body">
                                    <p class="date">16 janvier 2023</p>
                                    <h5 class="card-title">L'ambitieuse série 1985</h5>
                                    <a href="" class="cta">Lire l'article</a>
                                </div>
                            </a>
                        </div>

                    </div>
                </article>

                <article class="card paysage mr-4 mb-4">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="https://www.cinergie.be/images/actualite/film/_0/1985/1985--4-.jpg" class="card-img-left img-fluid rounded-start" alt="...">
                        </div>

                        <div class="col-md-8">
                            <a href="article-single.php">
                                <div class="card-body">
                                    <p class="date">16 janvier 2023</p>
                                    <h5 class="card-title">L'ambitieuse série 1985</h5>
                                    <a href="" class="cta">Lire l'article</a>
                                </div>
                            </a>
                        </div>

                    </div>
                </article>

                <article class="card paysage mr-4 mb-4">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="https://www.cinergie.be/images/actualite/film/_0/1985/1985--4-.jpg" class="card-img-left img-fluid rounded-start" alt="...">
                        </div>

                        <div class="col-md-8">
                            <a href="article-single.php">
                                <div class="card-body">
                                    <p class="date">16 janvier 2023</p>
                                    <h5 class="card-title">L'ambitieuse série 1985</h5>
                                    <a href="" class="cta">Lire l'article</a>
                                </div>
                            </a>
                        </div>

                    </div>
                </article>

                <article class="card paysage mr-4 mb-4">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="https://www.cinergie.be/images/actualite/film/_0/1985/1985--4-.jpg" class="card-img-left img-fluid rounded-start" alt="...">
                        </div>

                        <div class="col-md-8">
                            <a href="article-single.php">
                                <div class="card-body">
                                    <p class="date">16 janvier 2023</p>
                                    <h5 class="card-title">L'ambitieuse série 1985</h5>
                                    <a href="" class="cta">Lire l'article</a>
                                </div>
                            </a>
                        </div>

                    </div>
                </article>
            </div>
        </section>
        <?php
        if (!empty($movie->get('url_trailer'))) {
        ?>
            <section id="bande-annonce" class="my-5">
                <h2 class="pb-0">Bande annonce</h2>
                <hr />
                <iframe class="iframe-size-single-post" src="<?= $movie->get('url_trailer') ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </section>
        <?php
        }
        ?>
        <section class="row" id="galerie">
            <h2 class="pb-0">Galerie photos</h2>
            <hr />
            <div class="slide arrow" id="single-post-slider">
                <div class="col-lg-4">
                    <a href="https://www.cinergie.be/picture/actualite/370x370/images/actualite/film/_b/biere-amere/biere-amere.jpg" data-lightbox="roadtrip">
                        <img class="img-galerie img-fluid w-100" src="https://www.cinergie.be/picture/actualite/370x370/images/actualite/film/_b/biere-amere/biere-amere.jpg" alt="">
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://www.cinergie.be/picture/actualite/370x370/images/actualite/film/_b/biere-amere/biere-amere.jpg" data-lightbox="roadtrip">
                        <img class="img-galerie img-fluid w-100" src="https://www.cinergie.be/images/actualite/film/_l/lapin-perdu/lapin_perdu_dessine.jpg" alt="">
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://www.cinergie.be/picture/actualite/370x370/images/actualite/film/_b/biere-amere/biere-amere.jpg" data-lightbox="roadtrip">
                        <img class="img-galerie img-fluid w-100" src="https://www.cinergie.be/picture/actualite/370x370/images/actualite/film/_b/biere-amere/biere-amere.jpg" alt="">
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://www.cinergie.be/picture/actualite/370x370/images/actualite/film/_b/biere-amere/biere-amere.jpg" data-lightbox="roadtrip">
                        <img class="img-galerie img-fluid w-100" src="https://www.cinergie.be/images/actualite/film/_l/lapin-perdu/lapin_perdu_dessine.jpg" alt="">
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://www.cinergie.be/picture/actualite/370x370/images/actualite/film/_b/biere-amere/biere-amere.jpg" data-lightbox="roadtrip">
                        <img class="img-galerie img-fluid w-100" src="https://www.cinergie.be/picture/actualite/370x370/images/actualite/film/_b/biere-amere/biere-amere.jpg" alt="">
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://www.cinergie.be/picture/actualite/370x370/images/actualite/film/_b/biere-amere/biere-amere.jpg" data-lightbox="roadtrip">
                        <img class="img-galerie img-fluid w-100" src="https://www.cinergie.be/images/actualite/film/_l/lapin-perdu/lapin_perdu_dessine.jpg" alt="">
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://www.cinergie.be/picture/actualite/370x370/images/actualite/film/_b/biere-amere/biere-amere.jpg" data-lightbox="roadtrip">
                        <img class="img-galerie img-fluid w-100" src="https://www.cinergie.be/picture/actualite/370x370/images/actualite/film/_b/biere-amere/biere-amere.jpg" alt="">
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://www.cinergie.be/picture/actualite/370x370/images/actualite/film/_b/biere-amere/biere-amere.jpg" data-lightbox="roadtrip">
                        <img class="img-galerie img-fluid w-100" src="https://www.cinergie.be/images/actualite/film/_l/lapin-perdu/lapin_perdu_dessine.jpg" alt="">
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://www.cinergie.be/picture/actualite/370x370/images/actualite/film/_b/biere-amere/biere-amere.jpg" data-lightbox="roadtrip">
                        <img class="img-galerie img-fluid w-100" src="https://www.cinergie.be/picture/actualite/370x370/images/actualite/film/_b/biere-amere/biere-amere.jpg" alt="">
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://www.cinergie.be/picture/actualite/370x370/images/actualite/film/_b/biere-amere/biere-amere.jpg" data-lightbox="roadtrip">
                        <img class="img-galerie img-fluid w-100" src="https://www.cinergie.be/images/actualite/film/_l/lapin-perdu/lapin_perdu_dessine.jpg" alt="">
                    </a>
                </div>
            </div>
        </section>

        <section class="row my-5" id="equipe-belge">
            <h2 class="pb-0">L'équipe belge</h2>
            <hr />
            <div class="logo-equipe col-lg-2">
                <a href="organisation-single.php">
                    <img src="https://www.cinergie.be/images/organisation/_b/belfilm-asbl/logo.jpg" alt="Belfilm" class="img-fluid w-100">
                </a>
            </div>
            <div class="titre-equipe col-lg-7">
                <h4><a href="#belfilm-asbl">Belfilm ASBL</a></h4>
            </div>
            <div class="distributeur col-lg-3">
                <p>Distributeur</p>
            </div>
        </section>

    </article>

</div>