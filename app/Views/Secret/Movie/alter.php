<?php 
$sidemenu = [
    ['#signaletiqueSection', 'signaletique', 'Signalétique'],
    ['#techniqueSection', 'technique', 'Technique'],
    ['#synopsisSection', 'text', 'Synopsis'],
    ['#castingSection', 'text', 'Casting'],
    ['#publicationSection', 'info', 'Publication'],
    ['#commentSection', 'comment', 'Commentaires']
];


$this->layout('Secret::alter', ['sidemenu' => $sidemenu]) ?>

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
                <input type="text" class="form-control" id="label" name="label" value="<?= $controller->formModel()->get('label') ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="label" class="col-form-label">Titre original</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="original_title" name="original_title" value="<?= $controller->formModel()->get('original_title') ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="released" class="col-form-label">Sortie</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="released" name="released" value="<?= $controller->formModel()->get('released') ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="url" class="col-form-label">Site</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="url" name="url" value="<?= $controller->formModel()->get('url') ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="url_trailer" class="col-form-label">Bande annonce</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="url_trailer" name="url_trailer" value="<?= $controller->formModel()->get('url_trailer') ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="legacy_origine" class="col-form-label">Pays</label>
            </div>

            <div class="col-lg">
                    <div class="mb-4">

                        <select class="form-select" name="legacy_origine" id="legacy_origine" required autocomplete="off" data-select='{
                            "placeholder": "Pays"
                        }'
                                data-option-template='<span class="d-flex align-items-center py-2"><span class="text-truncate ms-2">[[text]]</span></span>'
                                data-item-template='<span class="d-flex align-items-center"><span class="text-truncate ms-2">[[text]]</span></span>'>
                            <?php $this->insert('Secret::_partials/form/options-country', ['selected' => $controller->formModel()->get('country')]) ?>
                        </select>
                        <div class="invalid-feedback">Please select a country</div>
                    </div>

            </div>
        </div> 


        <?= $this->submitDashly(); ?>

    </div>
</div>

<div class="card border-0 scroll-mt-3" id="techniqueSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Technique</h2>
    </div>

    <div class="card-body">
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="runtime" class="col-form-label">Durée</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="runtime" name="runtime" value="<?= $controller->formModel()->get('runtime') ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="format" class="col-form-label">Format</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="format" name="format" value="<?= $controller->formModel()->get('format') ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="genre_id" class="col-form-label">Genre</label>
            </div>

            <div class="col-lg">
                <select class="form-select" name="genre_id" id="genre_id">
                </select>
                <div class="invalid-feedback">Please add your genre</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="metrage_id" class="col-form-label">Metrage</label>
            </div>

            <div class="col-lg">
                <select class="form-select" name="metrage_id" id="metrage_id">
                </select>
                <div class="invalid-feedback">Please add your metrage</div>
            </div>
        </div>
    </div>

</div>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'content', 'title' => 'Synopsis', 'id' => 'synopsisSection']) ?>
<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'casting', 'title' => 'Casting', 'id' => 'castingSection']) ?>
<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'comment', 'title' => 'Commentaires', 'id' => 'commentSection']) ?>