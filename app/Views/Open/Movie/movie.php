<?php $this->layout('Open::layout');

use \HexMakina\Marker\Marker; ?>

<div class="container my-5 pb-5" id="boutique-single">
    <article class="mx-auto">

        <h1><?= $record->get('label') ?></h1>
        <h6 class="text-primary"><?= $this->insert('Open::Movie/themes')?></h6>
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
                <img class="img-fluid w-100" src="<?= $record->profilePicture() ?>" alt="Photo du film <?= $record->get('label') ?>" />
            </div>

            <div class="col-lg-7 ps-lg-5" id="infos">
                <p class="text-primary"><b><span class="text-dark">de </span> HARDCODED</b></p>
                <p><b>Date de sortie :</b> <?= $record->get('released') ?></p>

                <p><b>Pays :</b> <?= $record->get('legacy_origine') ?></p>
                <p><b>Genre :</b> <?= $tags[$record->get('genre_id')]; ?></p>
                <p><b>Durée :</b> <?= $record->get('runtime') ?></p>
                <br>
                <?= $record->get('casting') ?>

                <?php
                if ($dvd) {
                ?>
                    <p class="mt-5">
                    <aside class="input-group big" id="commander-boutique">
                        <button class="form-control">
                            Commander </button>
                        <span class="input-group-text" id="prix">HARDCODE &euro;</span>
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
            <p><?= $record->get('content') ?></p>
        </section>

        <?=$this->insert('Open::_partials/related_articles', ['related_articles' => $articles]);?>

        <?php
        if (!empty($record->get('url_trailer'))) {
        ?>
            <section id="bande-annonce" class="my-5">
                <h2 class="pb-0">Bande annonce</h2>
                <hr />
                <iframe class="iframe-size-single-post" src="<?= $record->get('url_trailer') ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </section>
        <?php
        }
        ?>

        <?= $this->insert('Open::_partials/photos', ['photos' => $related_photos]); ?>

        <?php
        if((count($professionals) + count($organisations)) > 1){
            ?>
            <section id="equipe-belge">
            <h2 class="pb-0">L'équipe belge</h2>
            <hr />
            <?= $this->insert('Open::Movie/worked_on', ['professional' => $professionals, 'organisation' => $organisations]);?>
        </section>
            <?php
        }
        ?>
    </article>
</div>