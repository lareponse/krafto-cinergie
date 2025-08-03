<?php
$sidemenu = [
    ['#signaletiqueSection', 'info', 'Signalétique'],
    ['#publicationSection', 'info', 'Publication']
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
                <input type="text" class="form-control" id="label" name="label" value="<?= $this->e($controller->formModel()->get('label')) ?>" required>
                <div class="invalid-feedback">Title is required</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="slug" class="col-form-label">Slug</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="slug" name="slug" value="<?= $this->e($controller->formModel()->get('slug')) ?>" required>
                <div class="invalid-feedback">Slug is required</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="publication" class="col-form-label">Publication & Fin</label>
            </div>

            <div class="col-lg">
                <input type="date" class="form-control" id="starts" name="starts" value="<?= $controller->formModel()->get('starts') ?>" required>
                <div class="invalid-feedback">Start date is required</div>
            </div>

            <div class="col-lg">
                <input type="date" class="form-control" id="stops" name="stops" value="<?= $controller->formModel()->get('stops') ?>" required>
                <div class="invalid-feedback">End date is required</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="type_id" class="col-form-label">Catégorie</label>
            </div>

            <div class="col-lg">
                <?= $this->Form()::select('type_id', $types, $controller->formModel()->get('type_id'), ['class' => 'form-control']); ?>
                <div class="invalid-feedback">Category is required</div>
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
                <input type="text" class="form-control" id="url_internal" name="url_internal" value="<?= $this->e($controller->formModel()->get('url_internal')) ?>">
                <div class="invalid-feedback">Valid internal URL required</div>
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
                <div class="invalid-feedback">Valid external URL required</div>
            </div>
        </div>

        <?= $this->submitDashly(); ?>

    </div>
</div>

<?= $this->insert('Secret::_partials/form/alter-card-publication') ?>

<?php $this->unshift('scripts') ?>
<script type="module">
    import OneToMany from '/public/assets/js/otto/otto-complete/OneToMany.js';

    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll('.otto-OneToMany').forEach(container => {
            new OneToMany(container);
        })
    });
</script>
<?php $this->end() ?>