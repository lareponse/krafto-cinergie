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

<hr class="mt-3 mb-5">

<?php
foreach ($events as $event) {
    $this->insert('Open/Event/card', ['event' => $event]);
}
?>