<aside id="sidebar" class="col-12 col-xl-3 mb-5 mb-xl-0">
    <div id="filtre-mobile">
        <button id="filtreBtn" class="btn btn-black" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtre-sidebar">
            <button id="filtreBtn" class="btn btn-black" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtre-sidebar">
                <i class="bi bi-sliders me-2"></i>Filtrer
            </button>
            <?php //include('parts/filtres/offcanvas/sidebar-mobile-professionnels.php'); ?>
    </div>
    <h3 class="d-none d-xl-block">Rechercher</h3>
    <div id="filtres" class="shadow">
        <?= $this->insert('Open::Professional/form_filters'); ?>

    </div>
    <button class="btn btn-outline-primary add-btn mt-4" data-bs-toggle="modal" data-bs-target="#modal-nouvelle-fiche-professionnel">
        <i class="bi bi-plus-circle"></i>
        Ajouter votre fiche professionnel
    </button>
    <?= $this->insert('Open::Professional/form_fiche', ['target' => 'modal-fiche-professionnel']); ?>
</aside>
