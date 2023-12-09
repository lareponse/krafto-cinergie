<!DOCTYPE html>
<html lang="fr">

<head>
    <?php $this->insert('Open::_partials/head') ?>
</head>

<body data-bs-spy="scroll" data-bs-target="#navigation">

    <?php $this->insert('Open::_partials/searchbar') ?>
    <?php $this->insert('Open::_partials/header') ?>

    <main id="content" class="<?php isset($pageClass) ? $pageClass : ''?>">

        <?php if (isset($title)) {
        ?>
            <div class="mb-5 d-none d-lg-block"><h1 class="line-center"><?= $title; ?></h1></div>
        <?php
        }
        ?>

        <?= $this->section('content') ?>
        
        <div id="scroll-to-top">
            <a href="#top">
                <img src="/public/assets/wejune/img/icons/scroll-top.svg" alt="scroll to top" class="img-fluid w-100">
            </a>
        </div>

    </main>

    <?php $this->insert('Open::_partials/footer') ?>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="/public/assets/wejune/js/lightbox.min.js"></script>
    <script src="/public/assets/wejune/js/script.js"></script>
    <script type="module">
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

            <?= $this->section('onLoaded') ?>
        });
    </script>
</body>

</html>