<?php
$href = $href ?? $controller->router()->hyp('organisation', ['slug' => $record->slug()]);
?>
<!-- <article class="card mb-4 shadow">
    <div class="card-body text-center">
        <a href="<?= $href ?>">
            <img src="<?= $record->profilePicture(); ?>" class="card-img-top mb-3" alt="Photo <?= $record->get('label'); ?>" />
            <h5 class="card-title"><?= $record->get('label'); ?></h5>
            <p class="card-text mt-3"><small class="text-secondary"><?= $record->get('praxes'); ?></small></p>
        </a>
    </div>
</article> -->

<a class="card shadow" href="<?= $href ?>">
    <img src="<?= $record->profilePicture(); ?>" class="card-img-top mb-3" alt="Photo <?= $record->get('label'); ?>" />
    <h5 class="card-title p-2 text-center"><?= $record->get('label'); ?></h5>
    <p class="card-text p-2 text-center">
        <?php
        foreach ($record->praxisIds() as $id) {
            printf('<small class="comma text-secondary otto-id-label" otto-urn="Tag:%d">Tag:%d</small>', $id, $id);
        }
        ?>
    </p>
</a>