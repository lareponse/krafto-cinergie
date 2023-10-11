<?php $this->layout('Open::layout');

use \HexMakina\Marker\Marker;

$collection_href = $controller->router()->hyp('movies');
?>

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
                <?php if(!empty($record->get('directors'))){
                    ?>
                    <p class="text-primary"><b><span class="text-dark">de </span> <?=$record->get('directors')?></b></p>
                    <?php
                }
                ?>
                <?php if (!empty($record->get('released'))) {
                    $href = $controller->router()->withFreeParams($collection_href, ['released' => $record->get('released')]);
                    ?><p><b>Date de sortie :</b> <a href="<?= $href?>"><?= $record->get('released') ?></a></p><?php
                }   
                
                ?>

                <?php if (!empty($record->get('legacy_origine'))) {
                    ?><p><b>Pays :</b> <?= $record->get('legacy_origine') ?></p><?php
                }
                ?>
                <p><b>Genre :</b> 
                <?php
                $href = $controller->router()->withFreeParams($collection_href, ['type' => $record->get('genre_id')]);
                ?>
                
                <a href="<?=$href?>" otto-tag-id="<?= $record->get('genre_id');?>"><?= $record->get('genre_id');?></a>
                
                <p><b>Metrage :</b> 
                <?php
                $href = $controller->router()->withFreeParams($collection_href, ['metrage' => $record->get('metrage_id')]);
                ?>
                <a href="<?=$href?>" otto-tag-id="<?= $record->get('metrage_id');?>"><?= $record->get('metrage_id');?></a>
                
                <p><b>Durée :</b> <?= $record->get('runtime') ?></p>
                <?= $record->get('casting') ?>

                <?php
                foreach ($merchandise as $merch) {
                ?>
                    <p class="mt-5">
                        <aside class="input-group big" id="commander-boutique">
                            <button class="form-control"><?=$merch->get('isBook')? 'Livre' : 'DVD'?></button>
                            <span class="input-group-text" id="prix">Boutique</span>
                        </aside>
                    </p>
                <?php
                }
                ?>
            </div>
        </section>
            
        <?php
        if (!empty($record->get('content'))) {
        ?>
        <section id="bio" class="my-5">
            <h2 class="pb-0">Synopsis</h2>
            <hr />
            <p><?= $record->get('content') ?></p>
        </section>
        <?php
        }
        ?>
        
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