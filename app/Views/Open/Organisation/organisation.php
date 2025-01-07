<?php

use \HexMakina\Marker\Marker;

$this->layout('Open::layout')

?>

<div id="organisation-single">
    <article class="w-75 mx-auto">

        <h1><?= $record ?></h1>
        <hr class="my-4">
        <?= $this->insert('Open::_partials/share_print', ['class' => 'compact', 'label' => $record->get('label')]); ?>

        <div class="row g-0 mt-4">

            <div class="col-md-4 col-lg-5">
                <img class="img-fluid" src="<?= $controller->avatarFor($record) ?>" alt="organisation" />
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
        <?= $this->insert('Open::_partials/related_articles', ['related_articles' => $related_articles ?? []]) ?>

        <?php if(!empty($related_professionals)) { ?>
        <section class="row my-5" id="equipe-belge">
            <h2 class="pb-0 line-left ">L'équipe belge</h2>
            <?php
                foreach ($related_professionals as $item) {
                    $href = $controller->router()->hyp('professional', ['slug' => $item->slug()]);
                    $this->insert('Open::_partials/related_prorg', ['item' => $item, 'href' => $href]);
                }
            ?>
        </section>
        <?php } ?>
    </article>


    <article class="w-75 mx-auto mb-5">

        <?= $this->insert('Open::_partials/photos', ['photos' => $related_photos]); ?>

        <?= $this->insert('Open::Professional/filmotheque', ['movies' => $related_movies]); ?>

        <!-- Modal -->
        <?php
        echo Marker::a('#', "Une erreur, une modification? Dites-le nous !", ['class' => 'cta', 'data-shadow-box-template' => 'template_alter_prorg']);
        ?>
    </article>
</div>

<?= $this->insert('Open::_partials/modalter_prorg', ['record' => $record]); ?>