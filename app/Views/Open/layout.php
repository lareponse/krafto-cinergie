<!DOCTYPE html>
<html lang="fr">

<head>
    <?php $this->insert('Open::_partials/head') ?>
</head>

<body data-bs-spy="scroll">
    <?php $this->insert('Open::_partials/header') ?>
    <main id="<?= $controller->activeSection() ?>" <?= $page !== null && $page->get('slug') !== 'home' ? 'class="fixed-layout"' : '' ?>>

        <?= isset($title) ? '<h1>' . $title . '</h1>' : '' ?>
        <?= $this->section('content') ?>
        <nav id="scroll-to-top">
            <a href="#top"><?= $this->bi('arrow-up-circle'); ?></a>
        </nav>
    </main>
    <?php $this->insert('Open::_partials/footer') ?>
    <?php $this->insert('Open::_partials/cookie') ?>
    <?php $this->insert('Open::_partials/scripts') ?>
</body>

</html>