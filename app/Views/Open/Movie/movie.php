<?php $this->layout('Open::layout');
$collection_href = $controller->router()->hyp('movies');
?>

<div class="container my-5 pb-5" id="boutique-single">
    <article class="mx-auto">
        <h1><?= $record->get('label') ?></h1>
        <hr class="" />
        <div class="d-flex justify-content-between">
            <h6 class="text-primary"><?= $this->insert('Open::Movie/themes', ['themes' => $themes]) ?></h6>
            <span><?= implode(' &bull; ', $thesaurus) ?></span>
        </div>

        <div class="row g-0 mt-4">

            <div class="col-lg-5">
                <img class="img-fluid w-100 mb-2" src="<?= $record->profilePicture() ?>" alt="Photo du film <?= $record->get('label') ?>" />
                <?= $this->insert('Open::_partials/share_print', ['label' => $record]); ?>

                <?php
                    if (!empty($record->get('prix_cinergie'))) {
                        echo $this->DOM()::img('/public/assets/img/prix_cinergie.png', 'Badge prix cinergie', ['width' => '120']);
                        echo $this->DOM()::strong($record->get('prix_cinergie'));
                    }
                ?>
            </div>

            <div class="col-lg-7 ps-lg-5 infos">

                <?php if (!empty($directors)) { ?>
                    <p class="text-primary mb-2">
                        <strong class="text-dark">de
                            <?php
                            foreach ($directors as $director) {
                                $href = $controller->router()->hyp('professional', ['slug' => $director->slug()]);
                                echo $this->DOM()::a($href, $director, ['class' => 'otto-id-label', 'otto-urn' => "Tag:{$director->id()}"]);
                            }
                            ?>
                        </strong>
                    </p>
                <?php } ?>

                <dl class="signaletique">
                    <?php
                    if (!empty($record->get('released'))) {
                        $href = $collection_href . '?' . http_build_query(['released' => $record->get('released')]);
                        $filter_link = $this->DOM()::a($href, $record->get('released'));
                        echo $this->DOM()::dt('Date de sortie : ') . $this->DOM()::dd("$filter_link");
                    }

                    if (!empty($record->get('legacy_origine'))) {
                        echo $this->DOM()::dt('Pays : ') . $this->DOM()::dd($record->get('legacy_origine'));
                    }

                    if (!empty($record->get('genre_id'))) {
                        $href = $collection_href . '?' . http_build_query(['type' => $record->get('genre_id')]);
                        $filter_link = $this->DOM()::a($href, $record->get('genre_id'), ['class' => 'otto-id-label', 'otto-urn' => "Tag:{$record->get('genre_id')}"]);
                        echo $this->DOM()::dt('Genre : ') . $this->DOM()::dd("$filter_link");
                    }

                    if (!empty($record->get('metrage_id'))) {
                        $href = $collection_href . '?' . http_build_query(['metrage' => $record->get('metrage_id')]);
                        $filter_link = $this->DOM()::a($href, $record->get('genre_id'), ['class' => 'otto-id-label', 'otto-urn' => "Tag:{$record->get('metrage_id')}"]);
                        echo $this->DOM()::dt('Metrage : ') . $this->DOM()::dd("$filter_link");
                    }

                    if (!empty($record->get('runtime'))) {
                        echo $this->DOM()::dt('Durée : ') . $this->DOM()::dd($record->get('runtime'));
                    }
                    ?>
                </dl>
                <?php
  

                if (!empty($record->get('casting'))) {
                    echo $this->DOM()::strong('Casting : ', ['class' => 'd-block']);
                    echo $record->get('casting');
                }
                ?>

                <?php if (!empty($merchandises)) { ?>

                    <div class="mt-4">
                        <h2 class="pb-0 line-left">Boutique</h2>
                        <?php
                        foreach ($merchandises as $merch) {
                        ?>
                            <aside class="input-group big commander-boutique">
                                <button class="form-control btn-commander" data-bs-toggle="modal" data-bs-target="#modal-order" data-delivery-be="<?= $merch->get('deliveryBe'); ?>" data-delivery-eu="<?= $merch->get('deliveryEu'); ?>" data-titre="<?= $merch ?>" data-prix="<?= $merch->get('price') ?>">
                                    <?= $this->bi('cart-plus-fill') ?> </button>
                                <span class="input-group-text prix"><?= $merch->get('price') ?> &euro;</span>
                            </aside>
                        <?php
                        }
                        ?>
                    </div>
            </div>
        <?php } ?>
        </div>

        <?php
        if (!empty($record->get('content'))) {
        ?>
            <div id="bio" class="my-5">
                <h2 class="pb-0 line-left">Synopsis</h2>
                <p><?= $record->get('content') ?></p>
            </div>
        <?php
        }
        ?>
        <?php
        if ((count($professionals) + count($organisations)) > 1) {
        ?>
            <section class="row my-5" id="equipe-belge">
                <h2 class="pb-0 line-left ">L'équipe belge</h2>
                <?php
                foreach (['professional' => $professionals, 'organisation' => $organisations] as $route_name => $annuaire) {
                    foreach ($annuaire as $item) {
                        $href = $controller->router()->hyp($route_name, ['slug' => $item->slug()]);
                        $this->insert('Open::_partials/related_prorg', ['item' => $item, 'href' => $href]);
                    }
                }
                ?>
            </section>

            <?= $this->insert('Open::_partials/related_articles', ['related_articles' => $articles]); ?>

            <?php
            if (!empty($record->get('url_trailer'))) {
            ?>
                <div id="bande-annonce" class="my-5">
                    <h2 class="pb-0 line-left ">Bande annonce</h2>
                    <iframe class="iframe-size-single-post" src="https://www.youtube.com/embed/<?= $record->get('url_trailer') ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            <?php
            }
            ?>

            <?= $this->insert('Open::_partials/photos', ['photos' => $related_photos]); ?>

</div>
<?php
        }
?>
</article>
</div>


<?php $this->insert('Open::Merchandise/modal'); ?>