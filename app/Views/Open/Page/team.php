<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => $page->get('label')]) ?>

<div class="container my-5">
    <div class="row">
        <div class="col-12">

            <section class="row my-5">
                <?= Marker::p($page->get('content')) ?>
            </section>

            <section class="row my-5" id="equipe">
                <h2>L'équipe</h2>

                <?php
                foreach ($team['equipe'] as $person) {
                ?>
                    <div class="col-lg-3 col-md-6" id="professionnel-item">
                        <article class="card mb-4 shadow">
                            <div class="card-body">
                                <a href="professionnel-single.php">
                                    <img src="/images/<?= $person->profilePicture(); ?>" class="card-img-top mb-3" alt="Photo de <?= $person->fullName() ?>">
                                </a>
                                <div class="p-3">
                                    <h5 class="card-title"><?= $person->fullName() ?></h5>
                                    <p class="card-text"><small class="text-secondary"><?= $person->get('title') ?></small></p>
                                    <p><a href="mailto:dimitra.bouras@cinergie.be"><?= $person->get('email') ?></a></p>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php
                }
                ?>
            </section>

            <section class="row my-5" id="collabo">
                <h2>Collaborateurs réguliers</h2>

                <?php
                foreach ($team['collaborateur'] as $person) {
                ?>
                    <div class="col-lg-3 col-md-6" id="professionnel-item">
                        <article class="card mb-4 shadow">
                            <div class="card-body">
                                <a href="<?= $controller->router()->hyp('author', ['slug' => $person->slug()]) ?>">
                                    <img src="<?= $person->profilePicture(); ?>" class="card-img-top mb-3" alt="...">
                                </a>
                                <div class="p-3">
                                    <h5 class="card-title"><?= $person->fullName(); ?></h5>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php
                }
                ?>

            </section>

            <section class="row my-5">
                <?php

                if (isset($team['CA'])) {
                    $content = [];
                    foreach ($team['CA'] as $person) {
                        $content[] = $person->get('title') . ' : ' . $person->fullName();
                    }

                    echo Marker::h3("Conseil d'administration");
                    echo Marker::p(implode(Marker::br(), $content));
                }

                if (isset($team['membre'])) {

                    $content = [];
                    foreach ($team['membre'] as $person) {
                        $content[] = $person->fullName();
                    }

                    echo Marker::h3('Membres');
                    echo Marker::p(implode(Marker::br(), $content));
                }

                if (isset($team['observateur'])) {

                    $content = [];

                    foreach ($team['observateur'] as $person) {
                        $content[] = Marker::strong($person->get('title')) . Marker::br() . $person->fullName();
                    }
                    echo Marker::h3('Observateur·trice·s');
                    echo Marker::p(implode(Marker::br(), $content));
                }
                ?>
            </section>
        
        </div>
    </div>
</div>