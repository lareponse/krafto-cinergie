<?php

use \HexMakina\Marker\Marker; ?>
<?php
$this->layout('Open::layout', ['title' => $page->label()]) ?>

<div class="container">
    <section class="row my-5 d-none d-sm-none d-md-none d-lg-block" id="agenda-widget">
        <div class="p-5 text-center">
            <div class="mb-5">
                <button class="btn text-agenda-1" id="allEvents">Tous</button>
                <button class="btn text-agenda-2" id="category1">Avant-première</button>
                <button class="btn text-agenda-3" id="category2">Évènement</button>
                <button class="btn text-agenda-4" id="category3">Ciné-club</button>
                <button class="btn text-agenda-5" id="category4">Festival</button>
                <button class="btn text-agenda-6" id="category5">Sortie</button>
                <button class="btn text-agenda-7" id="category6">Programmation TV</button>
                <button class="btn text-agenda-8" id="category7">Séances</button>
            </div>
            <div id='calendar'></div>
        </div>
    </section>

    <section class="row my-5" id="listing-agenda">
        <div class="title-agenda">
            <h3 class="h5"><span class="text-primary"><?= $current['month_string'] ?></span> <?= $current['year'] ?></h3>
            <p class="ms-auto">
                <a href="<?=$controller->router()->hyp('events_month', $previous)?>">< <?= $previous['month_string'] ?> <?= $previous['year'] ?></a></p>
            <p class="ms-5">
                <a href="<?=$controller->router()->hyp('events_month', $next)?>"><?= $next['month_string'] ?> <?= $next['year'] ?> ></a></p>
        </div>
        <hr class="mt-3 mb-5">
        <?php
        foreach($events as $event){
            ?>
            <article class="card shadow p-0 listing mb-3 px-lg-0">
            <a href="<?=$event->link()?>">
                <div class="row g-0">
                    <div class="col-2" id="date">
                        <span><?= substr($event->get('starts'), -2,2)?></span>
                        <span><?= mb_strtoupper(mb_substr($current['month_string'], 0,3))?></span>
                    </div>
                    <div class="col-10">
                        <div class="card-body">
                            <h6 class="card-title">Festival</h6>
                            <h5 class="card-title mb-0"><?= $event?></h5>
                            <div class="details">
                                <p class="card-text text-secondary"><small>jusqu'au 10 Novembre 2022</small></p>
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
    </section>

</div>

<?= $this->insert('Open::Event/scripts', ['current' => $current])?>