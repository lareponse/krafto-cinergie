<script src="/public/assets/wejune/js/jquery.min.js"></script>
<script src="/public/assets/wejune/js/bootstrap.min.js"></script>
<script src="/public/assets/wejune/js/slick.min.js"></script>
<script src="/public/assets/wejune/js/lightbox.min.js"></script>
<script src="/public/assets/wejune/js/script.js"></script>
<script src="/public/assets/js/cinergie.js"></script>
<script type="module" nonce="<?= $CSP_nonce ?>">
    import OttoIdLabel from '/public/assets/js/otto/otto-id-label.js';
    import OttoLink from '/public/assets/js/otto/otto-link.js';
    import OttoFormatDate from '/public/assets/js/otto/otto-format-date.js';
    import OttoEpicene from '/public/assets/js/otto/otto-epicene.js';

    document.addEventListener("DOMContentLoaded", () => {

        const ottoIdLabel = new OttoIdLabel('.otto-id-label')
        ottoIdLabel.replace()

        OttoEpicene.choose('kx-gender')

        OttoLink.urlLinks()
        OttoLink.emailLinks()
        OttoLink.callLinks()

        OttoFormatDate.searchAndFormat('.otto-date');


        document.querySelectorAll("a.print").forEach(function(link) {
            link.addEventListener("click", function(e) {
                window.print();
            });
        });

        <?= $this->section('onLoaded') ?>
    });
</script>


<!-- <script src="https://cmp.osano.com/AzZnJIUCHjnL131rn/2f06d2d4-d0d9-4a55-a88a-21b761aed3cd/osano.js"></script> -->