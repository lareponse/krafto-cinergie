<?php
$href = $href ?? $controller->router()->hyp('organisation', ['slug' => $record->slug()]);
?>
<a class="card shadow" href="<?= $href ?>">
   <img src="<?= $controller->defaultAvatar();?>" loading="lazy" data-src="<?= $controller->avatarFor($record); ?>" class="card-img-top mb-3" alt="Photo <?= $record->get('label'); ?>" />
    <strong class="h5 card-title"><?= $record->get('label'); ?></strong>
    <span>
        <?php
        foreach ($record->praxisIds() as $id) {
            printf('<small class="comma text-secondary otto-id-label" otto-urn="Tag:%d">Tag:%d</small>', $id, $id);
        }
        ?>
    </span>
</a>