<script nonce="<?= $CSP_nonce ?>">
    <?php
    echo '// START wejune scripts' . PHP_EOL;
    echo PHP_EOL . file_get_contents(DOCUMENT_ROOT . '/public/assets/wejune/js/jquery.min.js');
    echo PHP_EOL . file_get_contents(DOCUMENT_ROOT . '/public/assets/wejune/js/slick.min.js');
    echo PHP_EOL . file_get_contents(DOCUMENT_ROOT . '/public/assets/wejune/js/lightbox.min.js');
    echo PHP_EOL . file_get_contents(DOCUMENT_ROOT . '/public/assets/wejune/js/script.js');
    echo '// EOF  wejune scripts' . PHP_EOL;
    ?>
</script>
<script type="module" nonce="<?= $CSP_nonce ?>">
    <?php
    echo PHP_EOL . file_get_contents(DOCUMENT_ROOT . '/public/assets/js/cinergie.js');
    ?>
</script>

<script type="module" nonce="<?= $CSP_nonce ?>">
    document.addEventListener("DOMContentLoaded", () => {
        <?= $this->section('onLoaded') ?>
    });
</script>