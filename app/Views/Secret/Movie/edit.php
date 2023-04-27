<?php $this->layout('Secret::edit') ?>


<div class="card border-0 scroll-mt-3" id="signaletique">
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


        <div class="d-flex justify-content-end mt-5">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
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
                    <?php $this->insert('Secret::Movie/edit/options-genre', ['selected' => $controller->formModel()->get('genre_id')]) ?>
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
                    <?php $this->insert('Secret::Movie/edit/options-metrage', ['selected' => $controller->formModel()->get('metrage_id')]) ?>
                </select>
                <div class="invalid-feedback">Please add your metrage</div>
            </div>
        </div>
    </div>

</div>

<div class="card border-0 scroll-mt-3" id="synopsisSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Synopsis</h2>
    </div>

    <div class="card-body">
        <textarea class="form-control tinymce" id="content" name="content" rows="20"><?= $controller->formModel()->get('content');?></textarea>
        <div class="invalid-feedback">Please tell something about yourself</div>

        <div class="d-flex justify-content-end mt-5">

        
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
</div>

<div class="card border-0 scroll-mt-3" id="castingSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Casting</h2>
    </div>

    <div class="card-body">
        <textarea class="form-control tinymce" id="casting" name="casting" rows="20"><?= $controller->formModel()->get('casting');?></textarea>
        <div class="invalid-feedback">Please tell something about yourself</div>

        <div class="d-flex justify-content-end mt-5">

        
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
</div>

<div class="card border-0 scroll-mt-3" id="commentSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Commentaires</h2>
    </div>

    <div class="card-body">
        <textarea class="form-control tinymce" id="comment" name="comment" rows="20"><?= $controller->formModel()->get('comment');?></textarea>
        <div class="invalid-feedback">Please tell something about yourself</div>

        <div class="d-flex justify-content-end mt-5">

        
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
</div>

<div class="card border-0 scroll-mt-3" id="thesaurusSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Thésaurus</h2>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <?php $this->insert('Secret::Thesaurus/otto-complete', ['reference' =>'unesco_id', 'label' => 'Unesco 1', 'value' => $controller->formModel()->get('unesco_id')]) ?>
        </div>
        
        <div class="row mb-4">
            <?php $this->insert('Secret::Thesaurus/otto-complete', ['reference' =>'unesco_bis_id', 'label' => 'Unesco 2', 'value' => $controller->formModel()->get('unesco_bis_id')]) ?>
        </div>

        <div class="row mb-4">
            <?php $this->insert('Secret::Thesaurus/otto-complete', ['reference' =>'unesco_ter_id', 'label' => 'Unesco 3', 'value' => $controller->formModel()->get('unesco_ter_id')]) ?>
        </div>

        <div class="d-flex justify-content-end mt-5">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
</div>

<div class="card border-0 scroll-mt-3" id="themeSection">

        
    <div class="card-header">
        <h2 class="h3 mb-0">Thèmes</h2>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <?php $this->insert('Secret::Thesaurus/otto-complete', ['reference' =>'unesco_id', 'label' => 'Unesco 1', 'value' => $controller->formModel()->get('unesco_id')]) ?>
        </div>
        
        <div class="row mb-4">
            <?php $this->insert('Secret::Thesaurus/otto-complete', ['reference' =>'unesco_bis_id', 'label' => 'Unesco 2', 'value' => $controller->formModel()->get('unesco_bis_id')]) ?>
        </div>

        <div class="row mb-4">
            <?php $this->insert('Secret::Thesaurus/otto-complete', ['reference' =>'unesco_ter_id', 'label' => 'Unesco 3', 'value' => $controller->formModel()->get('unesco_ter_id')]) ?>
        </div>

        <div class="d-flex justify-content-end mt-5">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
</div>

<?= $this->start('deleteForm');?>
    <?= $this->insert('Secret::deleteForm')?>
<?= $this->stop()?>


<?php $this->unshift('scripts') ?>
    <script src="/public/assets/js/otto-complete.js"></script>
<?php $this->end() ?>