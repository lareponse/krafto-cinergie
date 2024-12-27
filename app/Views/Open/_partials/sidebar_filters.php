<?php
$action = $action ?? '';
$offcanvas_id = $offcanvas_id ?? 'filtre-sidebar';
?>

<aside class="card filtres shadow">
    <form action="<?= $action; ?>" method="GET">
        <header>
            <span class="fs-5">
                <?= $this->bi('sliders', ['class' => 'me-2', 'arial-label' => 'Filtrer']); ?>
            </span>
            <a href="<?= $action; ?>" class="clean-filtres">Tout effacer</a>
        </header>

        <hr>

        <?= $this->section('content'); ?>

        <footer>
            <button type="submit" class="btn btn-primary submit-filters mt-4">Afficher</button>
        </footer>

    </form>
</aside>