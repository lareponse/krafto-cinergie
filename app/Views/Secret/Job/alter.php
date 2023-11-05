<?php 
$sidemenu = [
    ['#signaletiqueSection', 'info', 'Signalétique'],
    ['#annonceurSection', 'text', 'Annonceur'],
    ['#contentSection', 'text', 'Contenu'],
    ['#publicationSection', 'info', 'Publication'],
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
                <input type="text" class="form-control" id="label" name="label" value="<?= $this->e($controller->formModel()->get('label')) ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="publication" class="col-form-label">Publication & Fin</label>
            </div>

            <div class="col-lg">
                <input type="date" class="form-control" id="starts" name="starts" value="<?= $controller->formModel()->get('starts') ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>

            <div class="col-lg">
                <input type="date" class="form-control" id="stops" name="stops" value="<?= $controller->formModel()->get('stops') ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="category_id" class="col-form-label">Catégorie</label>
            </div>

            <div class="col-lg">
                <?= $this->Form()::select('category_id', $types, $controller->formModel()->get('category_id'), ['class' => 'form-control']); ?>
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="label" class="col-form-label">Offre ?</label>
            </div>

            <div class="col-lg">
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" role="switch" id="isOffer" name="isOffer" <?= $controller->formModel()->isOffer() ? 'checked="checked"' : '' ?>">
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="label" class="col-form-label">Rémunéré ?</label>
            </div>

            <div class="col-lg">
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" role="switch" id="isPaid" name="isPaid" <?= $controller->formModel()->isPaid() ? 'checked="checked"' : '' ?>">
                </div>
            </div>
        </div>


        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="label" class="col-form-label">Photo</label>
            </div>

            <div class="col-lg">
                <input type="file" class="form-control" id="profilePicture" name="profilePicture" value="<?= $this->e($controller->formModel()->get('profilePicture')) ?>">
                <div class="invalid-feedback">Please add your email</div>
            </div>
        </div>

        <?= $this->submitDashly(); ?>

    </div>
</div>

<div class="card border-0 scroll-mt-3" id="annonceurSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Annonceur</h2>
    </div>

    <div class="card-body">

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="identity" class="col-form-label">Identité</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="identity" name="identity" value="<?= $this->e($controller->formModel()->get('identity')) ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label class="col-form-label">Email & Phone</label>
            </div>

            <div class="col-lg">
                <input type="email" class="form-control" id="startemails" name="email" value="<?= $controller->formModel()->get('email') ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="phone" name="phone" value="<?= $controller->formModel()->get('phone') ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label class="col-form-label">Tracabilité</label>
            </div>

            <div class="col-lg">
                <input type="email" class="form-control" id="work_ip" name="work_ip" value="<?= $controller->formModel()->get('work_ip') ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="work_timestamp" name="work_timestamp" value="<?= $controller->formModel()->get('work_timestamp') ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <?= $this->submitDashly(); ?>

    </div>
</div>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'content', 'title' => 'Contenu', 'id' => 'contentSection']) ?>

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
