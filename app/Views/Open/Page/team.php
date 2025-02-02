<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => $page->get('label')]) ?>

<div class="container my-5" id="page_team">

    <?= Marker::p($page->get('content'), [], false) ?>

    <section class="team-grid">
        <h2>L'équipe</h2>

        <?php
        foreach ($team['equipe'] as $person) {
        ?>
            <article class="shadow">
                <img src="<?= $controller->avatarFor($person) ?>" class="card-img-top mb-3" alt="Photo de <?= $person->fullName() ?>">
                <div>
                    <h3><?= $person->fullName() ?></h3>
                    <div><small class="text-secondary"><?= $person->get('title') ?></small></div>
                    <a href="mailto:dimitra.bouras@cinergie.be"><?= $person->get('email') ?></a>
                </div>
            </article>
        <?php
        }
        ?>
    </section>

    <section class="team-grid">
        <h2>Collaborateur&middot;trice&middot;s régulier&middot;ère&middot;s</h2>

        <?php
        foreach ($team['collaborateur'] as $person) {
        ?>
            <article class="shadow">
                <a href="<?= $controller->router()->hyp('author', ['slug' => $person->slug()]) ?>">
                    <img src="<?= $controller->avatarFor($person) ?>" class="card-img-top mb-3" alt="">
                </a>
                <div>
                    <h5><?= $person->fullName(); ?></h5>
                </div>
            </article>
        <?php
        }
        ?>
    </section>

    <section class="d-flex justify-content-between flex-wrap">
        <div>
            <?php
            if (isset($team['CA'])) {
                $content = [];
                foreach ($team['CA'] as $person) {
                    $content[] = $person->get('title') . ' : ' . $person->fullName();
                }

                echo Marker::h3("Conseil d'administration");
                echo Marker::p(implode(Marker::br(), $content), [], false);
            }
            ?>

        </div>
        <div>
            <?php

            if (isset($team['membre'])) {

                $content = [];
                foreach ($team['membre'] as $person) {
                    $content[] = $person->fullName();
                }

                echo Marker::h3('Membres');
                echo Marker::p(implode(Marker::br(), $content), [], false);
            }
            ?>

        </div>
        <div>
            <?php

            if (isset($team['observateur'])) {

                $content = [];

                foreach ($team['observateur'] as $person) {
                    $content[] = Marker::strong($person->get('title')) . Marker::br() . $person->fullName();
                }
                echo Marker::h3('Observateur·trice·s');
                echo Marker::p(implode(Marker::br(), $content), [], false);
            }
            ?>
        </div>
    </section>

</div>