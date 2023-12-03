<div id="filtre-mobile" class="d-block d-xl-none">
    <button id="filtreBtn" class="btn btn-black" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtre-sidebar">
        <i class="bi bi-sliders me-2"></i>Filtrer
    </button>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="filtre-sidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filtrer</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <?= $this->insert('Open::Movie/form_filters') ?>
        </div>
    </div>

</div>

<h3 class="d-none d-xl-block invisible">Rechercher</h3>
<div id="filtres" class="shadow d-none d-xl-block">
    <?= $this->insert('Open::Movie/form_filters') ?>
</div>