<?php
$url = $controller->router()->hyp('movie', ['slug' => $record->slug()]);

?>
<article class="film-item card shadow">
    <div class="card-body">
        <a href="<?= $url ?>">
            <img src="<?=$record->profilePicture()?>" class="card-img-top mb-3" alt="Couverture du film <?= $record->get('label');?>">
        </a>
        <div class="px-3">
            <a href="<?= $url ?>">
                <div class="meta d-flex justify-content-between mb-3">
                    <small class="date text-secondary"><?= $record->get('released');?></small>
                    <small class="text-primary categorie otto-id-label" otto-urn="Tag:<?= $record->get('genre_id');?>"><?= $record->get('genre_id');?></small>
                </div>
                <h5 class="card-title"><?= $record->get('label'); ?></h5>
                <p class="auteur"><?= $record->get('directors'); ?></p>
            </a>
        </div>
    </div>
</article>