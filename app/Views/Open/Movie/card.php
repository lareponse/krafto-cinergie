<?php
$url = $controller->router()->hyp('movie', ['slug' => $record->slug()]);

?>
<a class="card-movie shadow" href="<?= $url ?>">
    <img src="<?= $record->profilePicture() ?>" class="card-img-top" alt="Couverture du film <?= $record->get('label'); ?>">
    <em>

        <span class="meta">
            <small class="categorie otto-id-label" otto-urn="Tag:<?= $record->get('genre_id'); ?>"><?= $record->get('genre_id'); ?></small>
            <?php if(!empty($record->get('runtime'))){ ?><small class="runtime"><?= $record->get('runtime'); ?></small><?php }?>
            <small class="date"><?= $record->get('released'); ?></small>
        </span>

        <strong><?= $record->get('label'); ?></strong>
        <?php
        if (!empty($record->get('directors'))) {
            echo $this->DOM()::strong('de ' . $record->get('directors'), ['class' => 'meta professional']);
        }
        ?>
    </em>
</a>