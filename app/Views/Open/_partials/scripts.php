<script src="/public/assets/wejune/js/jquery.min.js"></script>
<script src="/public/assets/wejune/js/slick.min.js"></script>
<script src="/public/assets/wejune/js/lightbox.min.js"></script>
<script src="/public/assets/wejune/js/script.js"></script>
<script type="module" src="/public/assets/js/cinergie.js"></script>
<script type="module" nonce="<?= $CSP_nonce ?>">
    document.addEventListener("DOMContentLoaded", () => {
        <?= $this->section('onLoaded') ?>
    });
</script>