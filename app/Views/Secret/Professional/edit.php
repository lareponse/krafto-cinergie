<?php $this->layout('Secret::edit') ?>

<div class="card border-0 scroll-mt-3" id="SignalétiqueSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Signalétique</h2>
    </div>

    <div class="card-body">
        <?= $this->insert('Secret::Professional/edit/signaletique') ?>
    </div>
</div>

<div class="card border-0 scroll-mt-3" id="jobSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Métiers</h2>
    </div>

    <div class="card-body">
        <?= $this->insert('Secret::Professional/_partials/otto-praxis'); ?>

        <div class="d-flex justify-content-end mt-5">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
</div>

<?= $this->insert('Secret::_partials/contact/form-card', ['model' => $controller->formModel()]) ?>
<?= $this->insert('Secret::_partials/address/form-card', ['model' => $controller->formModel()]) ?>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'content', 'title' => 'Biographie', 'id' => 'BiographieSection']) ?>
<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'filmography', 'title' => 'Filmographie', 'id' => 'FilmographieSection']) ?>
