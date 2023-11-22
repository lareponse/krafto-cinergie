<?php $this->layout('Open::layout', ['title' => $page->label()]) ?>

<div class="container">
    <div class="row my-5 d-none d-sm-none d-md-none d-lg-block" id="agenda-widget">

        <div class="p-5 text-center">
            <div class="mb-5">
                <button class="btn evt-all" id="allEvents">Tous</button>
                <button class="btn evt-avant_premiere" id="evt-avant_premiere">Avant-première</button>
                <button class="btn evt-evenement_agenda" id="evt-evenement_agenda">Évènement</button>
                <button class="btn evt-cineclub" id="evt-cineclub">Ciné-club</button>
                <button class="btn evt-festival" id="evt-festival">Festival</button>
                <button class="btn evt-sortie_en_salle" id="evt-sortie_en_salle">Sortie</button>
                <button class="btn evt-programmation_tv" id="evt-programmation_tv">Programmation TV</button>
                <button class="btn evt-_autre_agenda" id="evt-_autre_agenda">Séances</button>
            </div>
            <div id='calendar'></div>

            <!-- parts/modal/fullCalModal.php -->
            <div class="modal fade" id="fullCalModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 id="modalTitle" class="modal-title"></h4>
                            <button type="button" class="btn-close  btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div id="modalBody" class="modal-body">
                            <strong id="modalBodyDescription"></strong><br><br>
                            <a id="eventUrlInternal" class="btn btn-primary" target="_blank" style="margin-right: 1em; display: inline-block;" href="">Infos Cinergie</a>
                            <a id="eventUrlExternal" class="btn btn-primary" target="_blank" href="" style="display: inline-block;">Infos pratiques</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-5" id="listing-agenda">

            <div class="title-agenda">
                <h3 class="h5"><span class="text-primary"><?= $current['month_string'] ?></span> <?= $current['year'] ?></h3>
                <p class="ms-auto">
                    <a href="<?= $controller->router()->hyp('events_month', $previous) ?>">
                        &lt; <?= $previous['month_string'] ?> <?= $previous['year'] ?></a>
                </p>
                <p class="ms-5">
                    <a href="<?= $controller->router()->hyp('events_month', $next) ?>"><?= $next['month_string'] ?> <?= $next['year'] ?> &gt;</a>
                </p>
            </div>
            <hr class="mt-3 mb-5">

            <?php
            foreach ($events as $event) {
            ?>
                <article class="card shadow p-0 listing mb-3 px-lg-0">
                    <a href="<?= $event->link() ?>">
                        <div class="row g-0">
                            <div class="col-2 date-item">
                                <span><?= substr($event->get('starts'), -2, 2) ?></span>
                                <span><?= mb_strtoupper(mb_substr($current['month_string'], 0, 3)) ?></span>
                            </div>
                            <div class="col-10">
                                <div class="card-body">
                                    <h6 class="card-title otto-tag-label"><?= $event->get('type_id') ?></h6>
                                    <h5 class="card-title mb-0"><?= $event ?></h5>
                                    <div class="details">
                                        <p class="card-text text-secondary"><small>jusqu'au <span class="otto-date"><?= $event->get('stops');?></span></small></p>
                                        <p class="card-text cta"><small>En savoir plus</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </article>
            <?php
            }
            ?>
        </div>

    </div>

    <?= $this->insert('Open::Event/scripts', ['current' => $current]) ?>