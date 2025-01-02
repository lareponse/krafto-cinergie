<?php

use \HexMakina\Marker\Marker;

$this->layout('Open::layout')

?>

<div class="container my-5 pb-5" id="professionnel-single">
    <article class="w-75 mx-auto">

        <h1><?= $record ?></h1>
        <hr class="my-4">
        <?= $this->insert('Open::_partials/share_print', ['label' => $record->get('label')]); ?>

        <section class="row g-0 my-4">

            <div class="col-lg-5">
                <img class="img-fluid w-100" src="<?= $record->profilePicture() ?>" alt="professionnel">
            </div>
            
            <div class="col-lg-7 ps-lg-5" id="infos">

                <p class="text-primary">
                    <?php
                    foreach ($praxes as $praxis) {
                        echo $this->DOM()::strong("$praxis", ['kx-gender' => $record->get('gender'), 'class' => 'd-block']);
                    }
                    ?>
                </p>

                <?= $this->insert('Open::_partials/contact_info', ['contact' => $record]); ?>
            </div>
        </section>
        <?php
        if (!empty($record->get('content'))) {
        ?>
            <section id="bio" class="my-5">
                <h2 class="pb-0">Biographie</h2>
                <hr>
                <p><?= $record->get('content') ?></p>
            </section>
        <?php
        }
        ?>

        <?= $this->insert('Open::_partials/photos', ['photos' => $related_photos]); ?>


        <?= $this->insert('Open::Professional/filmotheque', ['movies' => $related_movies]); ?>


        <?php
        if (!empty($record->get('filmography'))) {
        ?>
            <section class="my-5 long-text-container" id="pro-filmography">
                <h2 class="pb-0">Filmographie</h2>
                <hr>
                <div class="long-text-content"><?= $record->get('filmography') ?></div>
            </section>
        <?php
        }
        ?>

        <?= $this->insert('Open::_partials/related_articles', ['related_articles' => $articles]); ?>

        <!-- Modal -->
        <?php
        echo Marker::a('#', "Une erreur, une modification? Dites-le nous !", ['class' => 'cta shadow-box-trigger', 'data-shadow-template' => 'template_alter_prorg']);
        ?>
    </article>
</div>
<?= $this->insert('Open::_partials/modalter_prorg', ['record' => $record]); ?>