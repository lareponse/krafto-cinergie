<?php $this->layout('Secret::alter') ?>

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
                <label for="type_id" class="col-form-label">Catégorie</label>
            </div>

            <div class="col-lg">
                <?= $this->Form()::select('type_id', $types, $controller->formModel()->get('type_id'), ['class' => 'form-control']); ?>
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>


        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="url_internal" class="col-form-label">
                    <?php
                    $label = 'URL Interne';
                    $url = $controller->formModel()->get('url_internal');
                    echo empty($url) ? $label : $this->DOM()::a($url, $label, ['target' => '_blank'])
                    ?>
                </label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="url_internal" name="laurl_internalbel" value="<?= $this->e($controller->formModel()->get('url_internal')) ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="url_site" class="col-form-label">
                    <?php
                    $label = 'URL Externe';
                    $url = $controller->formModel()->get('url_site');
                    echo empty($url) ? $label : $this->DOM()::a($url, $label, ['target' => '_blank'])
                    ?>
                </label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="url_site" name="url_site" value="<?= $this->e($controller->formModel()->get('url_site')) ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-5">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
</div>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'content', 'title' => 'Contenu', 'id' => 'contentSection']) ?>

<div class="card border-0 scroll-mt-3" id="publicationSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Articles</h2>
    </div>
    <div class="card-body">

        <?php 
        $linked_urn = 'Article';
        $this->insert('Secret::_partials/otto/otto-complete/OneToMany', [
            'parent' => $controller->loadModel(),
            'relation' => 'event-hasAndBelongsToMany-article',
            'context' => $linked_urn,
            'ottoLinkEndPoint' => '/api/id-label/' . $linked_urn . '/term/',
            'placeholder' => 'Qualifié',
            'childrenTemplate' => 'Secret::' . $linked_urn . '/_partials/tab-card'
        ]);

        ?>
    </div>
</div>

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

<?= $this->start('deleteForm'); ?>
<?= $this->insert('Secret::deleteForm') ?>
<?= $this->stop() ?>

<?php $this->unshift('scripts') ?>
    <script type="module">
        import OneToMany from '/public/assets/js/otto/otto-complete/OneToMany.js';

        document.addEventListener("DOMContentLoaded", () => {
            console.log(document.querySelectorAll('.otto-OneToMany'))

            document.querySelectorAll('.otto-OneToMany').forEach(container => {
                console.log(container)
                new OneToMany(container);
            })
        });
    </script>
<?php $this->end() ?>