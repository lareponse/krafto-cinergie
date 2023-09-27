<aside id="sidebar" class="col-12 col-xl-3 mb-5 mb-xl-0">
    <div id="filtre-mobile">
        <button id="filtreBtn" class="btn btn-black" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtre-sidebar">
            <i class="bi bi-sliders me-2"></i>Filtrer
        </button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="filtre-sidebar">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filtrer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <?= $this->insert('Open::Professional/form_filters'); ?>
            </div>
        </div>
    </div>


    <h3 class="d-none d-xl-block">Rechercher</h3>
    <div id="filtres" class="shadow">
        <?= $this->insert('Open::Professional/form_filters'); ?>

        <button class="btn btn-outline-primary add-btn mt-4" data-bs-toggle="modal" data-bs-target="#modal-fiche-professionnel">
            <i class="bi bi-plus-circle"></i> Ajouter votre fiche professionnelle
        </button>

        <?= $this->insert('Open::Professional/form_fiche', ['target' => 'modal-fiche-professionnel']); ?>
</aside>