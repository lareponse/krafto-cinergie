<a class="card shadow" href="<?= $controller->router()->hyp('professional', ['slug' => $record->slug()]) ?>">
    <img src="<?= $record->profilePicture(); ?>" class="card-img-top mb-3" alt="Photo de <?= $record->fullName(); ?>" />
    <strong class="card-title"><?= $record; ?></strong>
    <p class="card-text">
        <?php
        foreach ($record->praxisIds() as $id) {
            printf('<small class="comma text-secondary otto-id-label" kx-gender="%s" otto-urn="Tag:%d">Tag:%d</small>', $record->get('gender'), $id, $id);
        }
        ?>
    </p>
</a>