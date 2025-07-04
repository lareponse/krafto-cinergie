<script src="/public/assets/wejune/js/wejune.bundle.js" crossorigin="anonymous" nonce="<?= $CSP_nonce ?>"></script>

<script
    type="module"
    src="/public/assets/js/cinergie.js"
    crossorigin="anonymous"
    nonce="<?= $CSP_nonce ?>"></script>

<script type="module" nonce="<?= $CSP_nonce ?>">
    document.addEventListener("DOMContentLoaded", () => {
        <?= $this->section('onLoaded') ?>
    });
</script>