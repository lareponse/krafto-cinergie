<?php $this->layout('Open::layout', ['title' => $page->label()]) ?>

<?php
$navigation_date_format = urlencode('{"month":"long","year":"numeric"}');
$href_prev = $controller->router()->hyp('events_month', ['year' => $previousMonth->format('Y'), 'month' => $previousMonth->format('m')]);
$href_next = $controller->router()->hyp('events_month', ['year' => $nextMonth->format('Y'), 'month' => $nextMonth->format('m')]);
?>
<nav role="navigation">
    <h2>
        <span class="text-primary otto-date" otto-format="<?= urlencode('{"month":"long"}') ?>"><?= $currentDate->format('Y-m-d') ?></span>
        <?= $currentDate->format('Y') ?>
    </h2>
    <ol>
        <li><a href="<?= $href_prev ?>#listing-agenda" title="Mois précédent" aria-label="Mois précédent">
                &lt; <span class="otto-date" otto-format="<?= $navigation_date_format ?>"><?= $previousMonth->format('Y-m-d') ?></span>
            </a></li>
        <li>
            <a href="<?= $href_next ?>#listing-agenda" title="Mois suivant" aria-label="Mois suivant">
                <span class="otto-date" otto-format="<?= $navigation_date_format ?>"><?= $nextMonth->format('Y-m-d') ?></span> &gt;
            </a>
        </li>
    </ol>
    </div>
</nav>

<div id="listing-agenda">


    <hr>

    <div id="agenda-widget">
        <?php $this->insert('Open/Event/fullcalendar'); ?>
    </div>

    <?php
    foreach ($events as $event) {
        $this->insert('Open/Event/card', ['event' => $event]);
    }
    ?>
</div>

<?= $this->insert('Open/Event/scripts', ['current' => $currentDate]) ?>