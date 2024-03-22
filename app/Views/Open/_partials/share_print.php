<div class="share <?= $class ?? '' ?>">
    <span class="title me-4">Partager sur</span>
    <div class="actions">
        <span class="socials">
            <a href="https://twitter.com/intent/tweet?url=<?= urlencode($controller->router()->url()) ?>&text=<?= urlencode($page) ?>">
                <i class="bi bi-facebook"></i></a>

            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= $controller->meta('url') ?>&title=<?= urlencode($controller->meta('title')) ?>">
                <i class="bi bi-twitter-x"></i></a>

            <a href="mailto:?subject=<?= 'Trouvé sur cinergie.be: ' . $controller->meta('title') ?>&body=<?= urlencode($controller->router()->url()) ?>">
                <i class="bi bi-envelope-fill icon"></i></a>

            <a target="_blank" href="https://www.pinterest.com/pin/create/button/?url=<?= $controller->meta('url') ?>&media=<?= $controller->meta('image') ?>&description=<?= urlencode($controller->meta('title')) ?>">
                <i class="bi bi-instagram icon"></i></a>
        </span>

        <a class="print"><i class="bi bi-printer-fill"></i>Imprimer</a>
    </div>
</div>