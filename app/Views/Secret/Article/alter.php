<?php 
$sidemenu = [
    ['#signaletiqueSection', 'info', 'Signalétique'],
    ['#abstractSection', 'text', 'Abstract'],
    ['#contentSection', 'text', 'Contenu'],
    ['#videoSection', 'video', 'Video'],
    ['#publicationSection', 'info', 'Publication'],
    ['#commentSection', 'comment', 'Commentaires']
];

$this->layout('Secret::alter', ['sidemenu' => $sidemenu]) 
?>

<div class="card border-0 scroll-mt-3" id="signaletiqueSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Signalétique</h2>
    </div>

    <div class="card-body">

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="label" class="col-form-label">Titre</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="label" name="label" required value="<?= $controller->formModel()->get('label') ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="publication" class="col-form-label">Sortie</label>
            </div>

            <div class="col-lg">
                <input type="date" class="form-control" id="publication" name="publication" value="<?= $controller->formModel()->get('publication') ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="publication" class="col-form-label">Catégorie</label>
            </div>

            <div class="col-lg">
                <?= $this->Form()::select('type_id', $types, $controller->formModel()->get('type_id'), ['class' => 'form-control']); ?>
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <?= $this->submitDashly(); ?>

    </div>
</div>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'abstract', 'title' => 'Abstract', 'id' => 'abstractSection']) ?>
<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'content', 'title' => 'Contenu', 'id' => 'contentSection']) ?>
<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'embedVideo', 'title' => 'Vidéo', 'id' => 'videoSection']) ?>

<div class="card border-0 scroll-mt-3" id="publicationSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Publication</h2>
    </div>

    <div class="card-body">

        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                <div class="me-2">
                    <h3 class="h4 mb-0">Actif</h3>
                    <p class="small text-muted mb-0">Visible sur le site ?</p>
                </div>
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" role="switch" id="active" name="active" <?= $controller->formModel()->isActive() ? 'checked="checked"' : '' ?>">
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                <div class="me-2">
                    <h3 class="h4 mb-0">Archivé</h3>
                    <p class="small text-muted mb-0">Présent dans les premiers résultats de recherche ?</p>
                </div>
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" role="switch" id="isArchived" name="isArchived" <?= $controller->formModel()->get('isArchived') ? 'checked="checked"' : '' ?>">
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                <div class="me-2">
                    <h3 class="h4 mb-0">Diaporama</h3>
                    <p class="small text-muted mb-0">Présent dans le diaporama de la page d'accueil ?</p>
                </div>
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" role="switch" id="isDiaporama" name="isDiaporama" <?= $controller->formModel()->get('isDiaporama') ? 'checked="checked"' : '' ?>">
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                <div class="me-2">
                    <h3 class="h4 mb-0">Ordre</h3>
                    <p class="small text-muted mb-0">Tri</p>
                </div>
                <div class="form-check form-switch mb-0">
                    <input type="number" class="form-control" id="rank" name="rank" value="<?= $controller->formModel()->get('rank') ?>">
                </div>
            </li>

        </ul>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="slug" class="col-form-label">Slug</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="slug" name="slug" value="<?= $controller->formModel()->get('slug') ?>">
                <div class="invalid-feedback">Ce champs n'est pas correct</div>
            </div>
        </div>
        <?= $this->submitDashly(); ?>
    </div>

</div>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'comment', 'title' => 'Commentaires', 'id' => 'commentSection']) ?>