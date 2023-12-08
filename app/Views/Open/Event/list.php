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
    $this->insert('Open/Event/card', ['event' => $event]);
}
?>