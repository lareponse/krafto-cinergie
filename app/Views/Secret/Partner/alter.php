<?php $this->layout('Secret::alter') ?>

<div class="card border-0 scroll-mt-3" id="SignalétiqueSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Signalétique</h2>
    </div>

    <div class="card-body">
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="label" class="col-form-label">Label</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="label" name="label" value="<?= $controller->formModel()->get('label') ?>">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="url" class="col-form-label">URL</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="url" name="url" value="<?= $controller->formModel()->get('url') ?>">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="url" class="col-form-label">Photo</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="url" name="url" value="<?= $controller->formModel()->profilePicturePath() ?>">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-3">
                <label class="h4 mb-0">Actif</label>
                <p class="small text-muted mb-0">Visible sur le site ?</p>
            </div>
            <div class="col-lg">

                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" role="switch" id="active" name="active" <?= $controller->formModel()->isActive() ? 'checked="checked"' : '' ?>">
                </div>
            </div>
        </div>
        <?= $this->submitDashly(); ?>

    </div>
    <div class="card-footer text-muted">
        <?= $controller->formModel()->get('created_on') ?>
        <br />active: <?= $controller->formModel()->get('public') ?>
        <br />slug: <?= $controller->formModel()->get('slug') ?>
        <br />rank: <?= $controller->formModel()->get('rank') ?>
        <br />id:<?= $controller->formModel()->get('legacy_id') ?>
    </div>
</div>