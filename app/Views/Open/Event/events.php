<?php $this->layout('Open::layout', ['title' => $page->label()]) ?>

<div class="container">


    <div class="row my-5" id="listing-agenda">
        <?php
        $prev_next_format = urlencode(json_encode(['month' => 'long', 'year' => 'numeric']));
        $href_prev = $controller->router()->hyp('events_month', ['year' => $previousMonth->format('Y'), 'month' => $previousMonth->format('m')]);
        $href_next = $controller->router()->hyp('events_month', ['year' => $nextMonth->format('Y'), 'month' => $nextMonth->format('m')]);
        ?>

        <div class="title-agenda">
            <h3 class="h5"><span class="text-primary otto-date" otto-format="<?= urlencode(json_encode(['month' => 'long'])) ?>"><?= $currentDate->format('Y-m-d') ?></span> <?= $currentDate->format('Y') ?></h3>
            <p class="ms-auto">
                <a href="<?= $href_prev ?>#listing-agenda">
                    &lt; <span class="otto-date" otto-format="<?= $prev_next_format ?>"><?= $previousMonth->format('Y-m-d') ?></span></a>
            </p>
            <p class="ms-5">
                <a href="<?= $href_next ?>#listing-agenda">
                    <span class="otto-date" otto-format="<?= $prev_next_format ?>"><?= $nextMonth->format('Y-m-d') ?></span> &gt;</a>
            </p>
        </div>

        <hr>

        <div class="row mb-5 d-none d-sm-none d-md-none d-lg-block" id="agenda-widget">
            <?php $this->insert('Open/Event/fullcalendar'); ?>
        </div>

        <?php
        foreach ($events as $event) {
            $this->insert('Open/Event/card', ['event' => $event]);
        }
        ?>
    </div>

</div>
<?= $this->insert('Open/Event/scripts', ['current' => $currentDate]) ?>