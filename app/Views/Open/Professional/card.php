<article class="professionnel-item card mb-4 shadow">
    <a href="<?= $controller->router()->hyp('professional', ['slug' => $record->slug()]) ?>">
        <div class="card-body">
            <img src="<?= $record->profilePicture(); ?>" class="card-img-top mb-3" alt="Photo de <?= $record->fullName(); ?>" />
            <div class="p-3">
                <h5 class="card-title"><?= $record; ?></h5>
                <p class="card-text"> <?php
                foreach ($record->praxisIds() as $id) {
                    printf('<small class="d-block text-secondary otto-id-label" otto-urn="Tag:%d">Tag:%d</small>', $id, $id);
                }
                ?></p>
            </div>
        </div>
    </a>
</article>