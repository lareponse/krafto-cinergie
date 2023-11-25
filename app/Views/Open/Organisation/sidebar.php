<div class="row">
    <div class="col-4 mt-4">
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
                    <?= $this->insert('Open::Organisation/form_filters'); ?>
                </div>
            </div>
        </div>
    </div>
    <h3 class="d-none d-xl-block">Rechercher</h3>
    <div id="filtres" class="shadow d-none d-xl-block">
        <?= $this->insert('Open::Organisation/form_filters'); ?>
    </div>

    <!-- Modal -->
    <button class="btn btn-outline-primary add-btn mt-4 col-12 col-sm-8 col-lg-12" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-organisation">
    <i class="bi bi-plus-circle"></i>
        Ajouter votre organisation
    </button>
    <?= $this->insert('Open::Organisation/modal_alter', ['data-bs-target' => "modal-nouvelle-organisation"]); ?>

</div>