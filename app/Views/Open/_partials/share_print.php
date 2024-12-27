<div class="share <?= $class ?? '' ?>">
    <span class="title me-4">Partager sur</span>
    <div class="actions">
        <span class="socials">
            <a href="https://twitter.com/intent/tweet?url=<?= urlencode($controller->router()->url()) ?>&text=<?= urlencode($page) ?>">
                <?= $this->bi('twitter') ?>
            </a>

            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= $controller->meta('url') ?>&title=<?= urlencode($controller->meta('title')) ?>">
                <?= $this->bi('facebook') ?>
            </a>

            <a href="mailto:?subject=<?= 'Trouvé sur cinergie.be: ' . $controller->meta('title') ?>&body=<?= urlencode($controller->router()->url()) ?>">
                <?= $this->bi('envelope-fill') ?>
            </a>

            <a target="_blank" href="https://www.pinterest.com/pin/create/button/?url=<?= $controller->meta('url') ?>&media=<?= $controller->meta('image') ?>&description=<?= urlencode($controller->meta('title')) ?>">
                <?= $this->bi('pinterest') ?>
            </a>
        </span>

        <a class="print"><?= $this->bi('printer-fill') ?>Imprimer</a>
    </div>
</div>