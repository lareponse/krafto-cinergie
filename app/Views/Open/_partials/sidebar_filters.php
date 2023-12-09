<?php
$action = $action ?? '';
$offcanvas_id = $offcanvas_id ?? 'filtre-sidebar';
?>

<aside class="sidebar filtres d-none d-lg-block">
    <div id="filtres" class="shadow d-none d-xl-block">

        <form action="<?= $action; ?>" method="GET">
            <header>
                <span class="fs-5"><i class="bi bi-sliders me-2" aria-label="Filtrer"></i></span>
                <button type="reset" class="clean-filtres">Tout effacer</button>
            </header>

            <hr>

            <?= $this->section('content'); ?>

            <footer>
                <button type="submit" class="btn btn-primary submit-filters mt-4">Afficher</button>
            </footer>

        </form>
    </div>

</aside>

<div class="sidebar filtres">
    <div class="offcanvas offcanvas-start" tabindex="-1" id="<?= $offcanvas_id ?>">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filtrer</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="<?= $action; ?>" method="GET">
                <header>
                    <span class="fs-5"><i class="bi bi-sliders me-2"></i>Filtrer</span>
                    <button type="reset" class="clean-filtres">Tout effacer</button>
                </header>

                <hr>
                <?= $this->section('content'); ?>
                <footer>
                    <button type="submit" class="btn btn-primary submit-filters mt-4">Afficher</button>
                </footer>

            </form>
        </div>
    </div>
</div>