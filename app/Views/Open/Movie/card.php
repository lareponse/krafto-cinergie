<?php
$url = $controller->router()->hyp('movie', ['slug' => $record->slug()]);

?>
<article class="film-item card shadow">
    <div class="card-body">
        <a href="<?= $url ?>">
            <img src="<?= $record->profilePicture() ?>" class="card-img-top" alt="Couverture du film <?= $record->get('label'); ?>">
        </a>
            <a class="d-block px-3" href="<?= $url ?>">
                <div class="d-flex justify-content-between">
                    <small class="date text-secondary"><?= $record->get('released'); ?></small>
                    <small class="text-primary categorie otto-id-label" otto-urn="Tag:<?= $record->get('genre_id'); ?>"><?= $record->get('genre_id'); ?></small>
                </div>

                <h5 class="card-title"><?= $record->get('label'); ?></h5>
                <?php
                if(!empty($record->get('directors'))){
                    echo $this->DOM()::span('de '.$record->get('directors'), ['class' => 'd-block text-end']);
                }
                ?>
            </a>
    </div>
</article>