<?php
$url = $controller->router()->hyp('movie', ['slug' => $record->slug()]);

?>
<a class="card-movie  shadow" href="<?= $url ?>">
    <img src="<?= $record->profilePicture() ?>" class="card-img-top" alt="Couverture du film <?= $record->get('label'); ?>">

    <small class="date text-secondary"><?= $record->get('released'); ?></small>
    <small class="categorie otto-id-label" otto-urn="Tag:<?= $record->get('genre_id'); ?>"><?= $record->get('genre_id'); ?></small>

    <h5 class="card-title"><?= $record->get('label'); ?></h5>
    <?php
    // if (!empty($record->get('directors'))) {
    //     echo $this->DOM()::span('de ' . $record->get('directors'), ['class' => 'd-block text-end']);
    // }
    ?>
</a>