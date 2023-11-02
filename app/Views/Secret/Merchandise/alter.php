<?php $this->layout('Secret::alter') ?>

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
            <div class="col-md-2 col-lg-3">
                <label for="people" class="col-form-label">Auteurs</label>
            </div>

            <div class="col">
                <input type="text" class="form-control" id="people" name="people" value="<?= $controller->formModel()->get('people') ?>">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-2 col-lg-3">
                <label for="price" class="col-form-label">Prix</label>
            </div>

            <div class="col-md-2">
                <input type="number" class="form-control" id="price" name="price" value="<?= $controller->formModel()->get('price') ?>">
            </div>

            <div class="col-md-2 col-lg-2">
                <label for="deliveryBe" class="col-form-label">Frais Belgique</label>
            </div>

            <div class="col-md-2 col-lg-1">
                <input type="number" class="form-control" id="deliveryBe" name="deliveryBe" value="<?= $controller->formModel()->get('deliveryBe') ?>">
            </div>

            <div class="col-md-2">
                <label for="deliveryEu" class="col-form-label">Frais Europe</label>
            </div>
            <div class="col-md-2 col-lg-1">
                <input type="number" class="form-control" id="deliveryEu" name="deliveryEu" value="<?= $controller->formModel()->get('deliveryEu') ?>">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="profilePicture" class="col-form-label">Photo principale</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="profilePicture" name="profilePicture" value="<?= $controller->formModel()->get($controller->formModel()->profilePictureField()) ?>">
            </div>
        </div>


        <div class="d-flex justify-content-end mt-5">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
</div>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'content', 'title' => 'Contenu', 'id' => 'contentSection']) ?>

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
                    <h3 class="h4 mb-0">Livre ?</h3>
                </div>
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" role="switch" id="isPartner" name="isPartner" <?= $controller->formModel()->get('isBook') ? 'checked="checked"' : '' ?>">
                </div>
            </li>
        </ul>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="legacy_lien" class="col-form-label">URL</label>
            </div>
            <div class="col-lg">
                <input type="text" class="form-control" id="legacy_lien" name="legacy_lien" value="<?= $controller->formModel()->get('legacy_lien') ?>">
            </div>
        </div>

        <div class="row my-4">
            <div class="col-lg-3">
                <label for="slug" class="col-form-label">Slug</label>
            </div>

            <div class="col-lg">
                <input disabled type="text" class="form-control" id="slug" name="slug" value="<?= $controller->formModel()->get('slug') ?>">
            </div>
        </div>



        <div class="d-flex justify-content-end mt-5">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>

</div>

<?= $this->start('deleteForm'); ?>
<?= $this->insert('Secret::deleteForm') ?>
<?= $this->stop() ?>