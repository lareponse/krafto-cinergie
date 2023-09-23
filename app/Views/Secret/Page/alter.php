<?php $this->layout('Secret::edit') ?>

<form action="" method="POST">

    <div class="card border-0 scroll-mt-3" id="SignalétiqueSection">
        <div class="card-header">
            <h2 class="h3 mb-0">Signalétique</h2>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-lg-3">
                    <label for="lastname" class="col-form-label">Titre</label>
                </div>
                <div class="col-lg">
                    <input type="text" class="form-control" id="label" name="label" value="<?= $controller->formModel()->get('label') ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 scroll-mt-3" id="synopsisSection">
        <div class="card-header">
            <h2 class="h3 mb-0">Contenu</h2>
        </div>

        <div class="card-body">
            <textarea class="form-control tinymce" id="content" name="content" rows="20"><?= $controller->formModel()->get('content'); ?></textarea>
            <div class="d-flex justify-content-end mt-5">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>

    <div class="card border-0 scroll-mt-3" id="synopsisSection">
        <div class="card-header">
            <h2 class="h3 mb-0">Description</h2>
        </div>

        <div class="card-body">
            <textarea class="form-control tinymce" id="abstract" name="abstract" rows="10"><?= $controller->formModel()->get('abstract'); ?></textarea>

            <div class="d-flex justify-content-end mt-5">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>




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

            </ul>

            <div class="row my-4">
                <div class="col-lg-3">
                    <label for="slug" class="col-form-label">Slug</label>
                </div>

                <div class="col-lg-3">
                    <input disabled type="text" class="form-control" id="slug" name="slug" value="<?= $controller->formModel()->get('slug') ?>">
                </div>

                <div class="col-lg-3">
                    <label for="created_on" class="col-form-label">Création</label>
                </div>

                <div class="col-lg-3">
                    <input disabled type="text" class="form-control" id="created_on" name="created_on" value="<?= $controller->formModel()->get('created_on') ?>">
                </div>

            </div>

            <div class="d-flex justify-content-end mt-5">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>

    </div>
</form>