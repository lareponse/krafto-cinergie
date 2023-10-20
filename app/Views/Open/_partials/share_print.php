<div class="share" id="share">
    <span>Partager sur</span>
    <span>
        <a target="_blank" href="https://twitter.com/intent/tweet?url=<?= urlencode($controller->router()->url()) ?>&text=<?= urlencode($page) ?>">
            <i class="bi bi-twitter-x icon"></i>
        </a>

        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= $controller->meta('url') ?>&title=<?= urlencode($controller->meta('title')) ?>">
            <i class="bi bi-facebook icon"></i>
        </a>
        <a href="mailto:?subject=<?= 'Trouvé sur cinergie.be: ' . $controller->meta('title') ?>&body=<?= urlencode($controller->router()->url()) ?>">
            <i class="bi bi-envelope-fill icon"></i>
        </a>
        <a target="_blank" href="https://www.pinterest.com/pin/create/button/?url=<?= $controller->meta('url') ?>&media=<?= $controller->meta('image') ?>&description=<?= urlencode($controller->meta('title')) ?>">
            <i class="bi bi-pinterest icon"></i>
        </a>
    </span>
</div>
<div class="mt-2" id="print">
    <a onclick="window.print()" class="print"><i class="bi bi-printer-fill me-1"></i>Imprimer</a>
</div>
