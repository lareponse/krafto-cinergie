<?php $this->layout('Open::layout');

$collection_href = $controller->router()->hyp('movies');
?>

<div class="container my-5 pb-5" id="boutique-single">
    <article class="mx-auto">

        <h1><?= $record->get('label') ?></h1>
        <h6 class="text-primary"><?= $this->insert('Open::Movie/themes') ?></h6>
        <hr class="my-4" />

        <div class="share" id="share">
            <span>Partager sur</span>
            <span class="socials">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="mx-1 bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-envelope-fill"></i></a>
            </span>
        </div>


        <div class="row g-0 mt-4">

            <div class="col-lg-5">
                <img class="img-fluid w-100" src="<?= $record->profilePicture() ?>" alt="Photo du film <?= $record->get('label') ?>" />
            </div>

            <div class="col-lg-7 ps-lg-5 infos">

                <?php if (!empty($record->get('directors'))) {
                ?>
                    <p class="text-primary"><b><span class="text-dark">de </span> <?= $record->get('directors') ?></b></p>
                <?php
                }
                ?>
                <?php if (!empty($record->get('released'))) {
                    $href = $collection_href . '?' . http_build_query(['released' => $record->get('released')]);
                ?><p><b>Date de sortie :</b> <a href="<?= $href ?>"><?= $record->get('released') ?></a></p><?php
                                                                                                        }

                                                                                                            ?>

                <?php if (!empty($record->get('legacy_origine'))) {
                ?><p><b>Pays :</b> <?= $record->get('legacy_origine') ?></p><?php
                                                                        }
                                                                            ?>
                <p><b>Genre :</b>
                    <?php
                    $href = $collection_href . '?' . http_build_query(['type' => $record->get('genre_id')]);
                    ?>

                    <a href="<?= $href ?>" class="otto-id-label" otto-urn="Tag:<?= $record->get('genre_id'); ?>"><?= $record->get('genre_id'); ?></a>

                <p><b>Metrage :</b>
                    <?php
                    $href = $collection_href . '?' . http_build_query(['metrage' => $record->get('metrage_id')]);

                    ?>
                    <a href="<?= $href ?>" class="otto-id-label" otto-urn="Tag:<?= $record->get('metrage_id'); ?>"><?= $record->get('metrage_id'); ?></a>

                <p><b>Durée :</b> <?= $record->get('runtime') ?></p>
                <?php 
                if (!empty($record->get('runtime'))) {
                    echo $this->DOM()::strong('Durée : ');
                    echo $record->get('runtime');
                }
                if (!empty($record->get('casting'))) {
                    echo $this->DOM()::strong('Casting : ');
                    echo $record->get('casting');
                }
                ?>

                <div class="mt-4">
                    <?php
                    foreach ($merchandises as $merch) {
                    ?>
                        <aside class="input-group big commander-boutique">
                            <button class="form-control btn-commander" data-bs-toggle="modal" data-bs-target="#modal-order" data-titre="<?= $merch ?>" data-prix="<?= $merch->get('price') ?>">
                                <i class="bi bi-cart-plus-fill"></i> </button>
                            <span class="input-group-text prix"><?= $merch->get('price') ?> &euro;</span>
                        </aside>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php
        if (!empty($record->get('content'))) {
        ?>
            <div id="bio" class="my-5">
                <h2 class="pb-0">Synopsis</h2>
                <hr />
                <p><?= $record->get('content') ?></p>
            </div>
        <?php
        }
        ?>

        <?= $this->insert('Open::_partials/related_articles', ['related_articles' => $articles]); ?>

        <?php
        if (!empty($record->get('url_trailer'))) {
        ?>
            <div id="bande-annonce" class="my-5">
                <h2 class="pb-0">Bande annonce</h2>
                <hr />
                <iframe class="iframe-size-single-post" src="<?= $record->get('url_trailer') ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        <?php
        }
        ?>

        <?= $this->insert('Open::_partials/photos', ['photos' => $related_photos]); ?>

        <?php
        if ((count($professionals) + count($organisations)) > 1) {
        ?>
            <div class="row my-5" id="equipe-belge">
                <h2 class="pb-0">L'équipe belge</h2>
                <hr />
            </div>
            <?= $this->insert('Open::Movie/worked_on', ['professional' => $professionals, 'organisation' => $organisations]); ?>
</div>
<?php
        }
?>
</article>
</div>


<?php $this->insert('Open::Merchandise/modal_order'); ?>