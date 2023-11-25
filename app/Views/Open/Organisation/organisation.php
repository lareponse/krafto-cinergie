<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout') ?>

<div class="container my-5 pb-5" id="organisation-single">
    <article class="w-75 mx-auto">

        <h1><?= $record ?></h1>
        <hr class="my-4">

        <div class="share">
            <span>Partager sur</span>
            <span class="socials">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="mx-1 bi bi-twitter-x"></i></a>
                <a href="#"><i class="bi bi-envelope-fill"></i></a>
            </span>
        </div>
        <div class="row g-0 mt-4">

            <div class="col-lg-5">
                <img class="img-fluid w-100" src="<?= $record->profilePicture() ?>" alt="organisation" />
            </div>


            <div class="col-lg-7 ps-lg-5 col-md-8" id="infos">
                <p class="text-primary"><strong><?= implode(', ', $praxes); ?></strong></p>
                <?= $this->insert('Open::_partials/contact_info', ['contact' => $record]); ?>
            </div>
        </div>

        <?php
        if (!empty($record->get('content'))) {
        ?>
            <section id="bio" class="my-5">
                <h2 class="pb-0">Présentation</h2>
                <hr>
                <p><?= $record->get('content') ?></p>
            </section>
        <?php
        }
        ?>
    </article>
    
    <?= $this->insert('Open::_partials/related_articles', ['related_articles' => $related_articles ?? []]) ?>

    <article class="w-75 mx-auto">

        <?= $this->insert('Open::_partials/photos', ['photos' => $related_photos]); ?>

        <?= $this->insert('Open::Professional/filmotheque', ['movies' => $related_movies]); ?>

        <!-- Modal -->
        <?php
        $modal_reference = 'modal-nouvelle-organisation';
        echo Marker::a('#', "Une erreur, une modification? Dites-le nous !", ['class' => 'cta', 'data-bs-toggle' => "modal", 'data-bs-target' => "#$modal_reference"]);
        ?>
        <?= $this->insert('Open::Organisation/modal_alter', ['record' => $record, 'data-bs-target' => $modal_reference]); ?>
    </article>
</div>



</div>