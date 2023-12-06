<?php
$href = $href ?? $controller->router()->hyp('organisation', ['slug' => $record->slug()]);
?>
<article class="card mb-4 shadow">
    <div class="card-body text-center">
        <a href="<?= $href ?>">
            <img src="<?= $record->profilePicture(); ?>" class="card-img-top mb-3" alt="Photo <?= $record->get('label'); ?>" />
            <h5 class="card-title"><?= $record->get('label'); ?></h5>
            <p class="card-text mt-3"><small class="text-secondary"><?= $record->get('praxes'); ?></small></p>
        </a>
    </div>
</article>