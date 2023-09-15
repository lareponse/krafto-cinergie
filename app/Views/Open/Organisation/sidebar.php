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
                <?= $this->insert('Open::Organisation/form_filters'); ?>
            </div>
        </div>
    </div>

    <h3 class="d-none d-xl-block">Rechercher</h3>
    <div id="filtres" class="shadow">
        <?= $this->insert('Open::Organisation/form_filters'); ?>
    </div>


    <button class="btn btn-outline-primary add-btn mt-4" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-organisation">
        <i class="bi bi-plus-circle"></i>
        Ajouter votre organisation
    </button>
    <!-- Modal -->
    <div class="modal fade" id="modal-nouvelle-organisation" tabindex="-1" aria-labelledby="modal-nouvelle-organisation-label" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal-nouvelle-organisation-label">Nouvelle organisation</h1>
                    <button type="button" class="btn-close  btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <p>
                        → Veuillez compléter les données
                        <br>
                        → Envoyez-nous votre logo par email à l'adresse <a href="mailto:info@cinergie.be">info@cinergie.be</a>
                        <strong>Cinergie vous remercie de votre collaboration!</strong>
                    </p>
                    <hr>
                    <?= $this->insert('Open::Organisation/form_fiche'); ?>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" name="submit-nouvelle-organisation" value="Envoyer">
                </div>
            </div>
        </div>
    </div>
</aside>