<?php $this->layout('Secret::edit', ['title' => 'brols']) ?>

<div class="card border-0 scroll-mt-3" id="SignalétiqueSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Signalétique</h2>
    </div>

    <div class="card-body">
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="lastname" class="col-form-label">Nom</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="label" name="label" value="<?= $controller->formModel()->get('label') ?>">
            </div>
        </div>


        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="abbrev" class="col-form-label">Abbreviation</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="abbrev" name="abbrev" value="<?= $controller->formModel()->get('abbrev') ?>">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="profilePicture" class="col-form-label">Photo principale</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="profilePicture" name="profilePicture" value="<?= $controller->formModel()->profilePicturePath() ?>">
            </div>
        </div>



        <div class="d-flex justify-content-end mt-5">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
</div>


<?= $this->insert('Secret::_partials/contact/form-card', ['model' => $controller->formModel()]) ?>

<?= $this->insert('Secret::_partials/address/form-card', ['model' => $controller->formModel()]) ?>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'content', 'title' => 'Contenu', 'id' => 'ContentSection']) ?>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'filmography', 'title' => 'Filmographie', 'id' => 'FilmographieSection']) ?>


<div class="card border-0 scroll-mt-3" id="PublicationSection">
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
                    <h3 class="h4 mb-0">isPartner</h3>
                    <p class="small text-muted mb-0">Est une organisation partenaire ?</p>
                </div>
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" role="switch" id="isPartner" name="isPartner" <?= $controller->formModel()->get('isPartner') ? 'checked="checked"' : '' ?>">
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                <div class="me-2">
                    <h3 class="h4 mb-0">isLink</h3>
                    <p class="small text-muted mb-0">?</p>
                </div>
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" role="switch" id="isLink" name="isLink" <?= $controller->formModel()->get('isLink') ? 'checked="checked"' : '' ?>">
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                <div class="me-2">
                    <h3 class="h4 mb-0">isListed</h3>
                    <p class="small text-muted mb-0">Présent dans l'annuaire ?</p>
                </div>
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" role="switch" id="isListed" name="isListed" <?= $controller->formModel()->get('isListed') ? 'checked="checked"' : '' ?>">
                </div>
            </li>

        </ul>

        <div class="row my-4">
            <div class="col-lg-3">
                <label for="slug" class="col-form-label">Slug</label>
            </div>

            <div class="col-lg">
                <input disabled type="text" class="form-control" id="slug" name="slug" value="<?= $controller->formModel()->get('slug') ?>">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-2">
                <label for="created_on" class="col-form-label">Création</label>
            </div>

            <div class="col-lg-4">
                <input disabled type="text" class="form-control" id="created_on" name="created_on" value="<?= $controller->formModel()->get('created_on') ?>">
            </div>
            <div class="col-lg-2">
                <label for="updated_on" class="col-form-label">Mise à jour</label>
            </div>

            <div class="col-lg-4">
                <input disabled type="text" class="form-control" id="updated_on" name="updated_on" value="<?= $controller->formModel()->get('updated_on') ?>">
            </div>
        </div>

        <div class="d-flex justify-content-end mt-5">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>

</div>


<div class="card border-0 scroll-mt-3" id="LegalSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Légal</h2>
    </div>

    <div class="card-body">


        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="BIC" class="col-form-label">BIC</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="BIC" name="BIC" value="<?= $controller->formModel()->get('BIC') ?>">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="IBAN" class="col-form-label">IBAN</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="IBAN" name="IBAN" value="<?= $controller->formModel()->get('IBAN') ?>">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="TVA" class="col-form-label">TVA</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="TVA" name="TVA" value="<?= $controller->formModel()->get('TVA') ?>">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="numero_entreprise" class="col-form-label">Numéro Entreprise</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="numero_entreprise" name="numero_entreprise" value="<?= $controller->formModel()->get('numero_entreprise') ?>">
            </div>
        </div>
    </div>
</div>

<?= $this->start('deleteForm'); ?>
<?= $this->insert('Secret::deleteForm') ?>
<?= $this->stop() ?>