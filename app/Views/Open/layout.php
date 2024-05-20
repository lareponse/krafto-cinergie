<!DOCTYPE html>
<html lang="fr">

<head>
    <?php $this->insert('Open::_partials/head') ?>
</head>

<body data-bs-spy="scroll" data-bs-target="#navigation">

    <?php $this->insert('Open::_partials/searchbar') ?>
    <?php $this->insert('Open::_partials/header') ?>

    <main id="content" class="<?php isset($pageClass) ? $pageClass : '' ?>">

        <?php if (isset($title)) {
        ?>
            <div class="mb-5 d-none d-lg-block">
                <h1 class="line-center"><?= $title; ?></h1>
            </div>
        <?php
        }
        ?>

        <?= $this->section('content') ?>

        <nav id="scroll-to-top">
            <a href="#top">
                <img src="/public/assets/img/scroll-top.svg" alt="scroll to top" class="img-fluid">
            </a>
        </nav>
    </main>

    <?php $this->insert('Open::_partials/footer') ?>

    <script src="/public/assets/wejune/js/jquery.min.js"></script>
    <script src="/public/assets/wejune/js/bootstrap.min.js"></script>
    <script src="/public/assets/wejune/js/slick.min.js"></script>
    <script src="/public/assets/wejune/js/lightbox.min.js"></script>
    <script src="/public/assets/wejune/js/script.js"></script>
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
</body>

</html>