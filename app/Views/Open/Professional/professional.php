<?php $this->layout('Open::layout') ?>

<div class="container my-5 pb-5" id="professionnel-single">
    <article class="w-75 mx-auto">

        <h1><?= $record ?></h1>
        <hr class="my-4">
        <?= $this->insert('Open::_partials/share_print', ['label' => $record->get('label')]); ?>


        <section class="row g-0 mt-4">

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

        <?php
        if (!empty($record->get('filmography'))) {
        ?>
            <section class="my-5">
                <h2 class="pb-0">Filmographie</h2>
                <hr>
                <p><?= $record->get('filmography') ?></p>
            </section>
        <?php
        }
        ?>

        <?= $this->insert('Open::Professional/filmotheque', ['movies' => $related_movies]); ?>


        <!-- Modal -->
        <?php
        echo Marker::a('#', "Une erreur, une modification? Dites-le nous !", ['class' => 'cta', 'data-bs-toggle' => "modal", 'data-bs-target' => "#modalter_prorg"]);
        ?>
        <?= $this->insert('Open::_partials/modalter_prorg', ['record' => $record]); ?>
    </article>
</div>