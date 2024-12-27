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
            <a href="#top"><?=$this->bi('arrow-up-circle');?></a>
        </nav>
    </main>

    <?php $this->insert('Open::_partials/footer') ?>

    <?php $this->insert('Open::_partials/scripts') ?>
</body>

</html>