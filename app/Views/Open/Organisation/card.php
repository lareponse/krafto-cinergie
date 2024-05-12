<?php
$href = $href ?? $controller->router()->hyp('organisation', ['slug' => $record->slug()]);
?>
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