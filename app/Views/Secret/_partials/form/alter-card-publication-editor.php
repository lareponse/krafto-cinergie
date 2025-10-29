<?php

$publication_booleans = [
    'public' => ['Publique', 'Visible sur le site ?'],
    'pick' => ['Accueil', 'Présent dans les sélections de la page d\'accueil ?'],
    // 'listable' => ['Listable', 'Désactivé, ne pas montrer dans les listes. Toujours accessible par son url directe, recherche et données liées'],
    // 'searchable' => ['Recherchable', 'Présent dans les résultats de recherche'],
];
?>

<div class="card border-0 scroll-mt-3" id="publicationSection">

    <div class="card-header">
        <h2 class="h3 mb-0">Publication</h2>
    </div>

    <div class="card-body">
        <?php
        if (!empty($add)) {
        ?>
            <ul class="list-group list-group-flush mb-4">
                <?php
                foreach ($add as $name => [$old_ref, $description]) {
                ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <div class="me-2">
                            <label for="publication-form-<?= $name ?>" class="h4 mb-0 text-primary"><?= $old_ref ?></label>
                            <span class="d-block small text-muted mb-0"><?= $description ?></spân>
                        </div>
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" role="switch" id="publication-form-<?= $name ?>" name="<?= $name ?>" <?= $controller->formModel()->get($name) ? 'checked="checked"' : '' ?>">
                        </div>
                    </li>

                <?php
                }
                ?>
            </ul>
        <?php
        }
        ?>
        <ul class="list-group list-group-flush">

            <?php
            foreach ($publication_booleans as $name => [$old_ref, $description]) {
            ?>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <div class="me-2">
                        <label for="publication-form-<?= $name ?>" class="h4 mb-0"><?= $old_ref ?></label>
                        <span class="d-block small text-muted mb-0"><?= $description ?></spân>
                    </div>
                    <div class="form-check form-switch mb-0">
                        <input class="form-check-input" type="checkbox" role="switch" id="publication-form-<?= $name ?>" name="<?= $name ?>" <?= $controller->formModel()->get($name) ? 'checked="checked"' : '' ?>">
                    </div>
                </li>

            <?php
            }
            ?>

            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                <div class="me-2">
                    <label for="publication-form-rank" class="h4 mb-0">Ordre</label>
                    <span class="d-block small text-muted mb-0">Tri</spân>
                </div>
                <div class="mb-0">
                    <input type="text" class="form-control" id="publication-form-rank" name="rank" value="<?= $controller->formModel()->get('rank') ?>">
                    <div class="invalid-feedback">Ce champs n'est pas correct</div>
                </div>
            </li>
            <?php if ('App\Models\Article' === get_class($controller->formModel())): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <?= $this->insert('Secret::_partials/form/review_status'); ?>
                </li>
            <?php endif; ?>
        </ul>

        <label for="publication-form-slug" class="col-form-label text-primary">Slug</label>
        <input type="text" class="form-control border-primary" id="publication-form-slug" name="slug" value="<?= $controller->formModel()->get('slug') ?>">
        <span class="d-block small text-primary">Non, vraiment, faut pas toucher à ce truc..</span>
        <div class="invalid-feedback">Ce champs n'est pas correct</div>



        <div class="row mt-4">
            <div class="col-lg-2">
                <label for="created" class="col-form-label">Création</label>
            </div>

            <div class="col-lg-4">
                <input disabled type="text" class="form-control" id="created" name="created" value="<?= $controller->formModel()->get('created') ?>">
            </div>
            <div class="col-lg-2">
                <label for="updated_on" class="col-form-label">Mise à jour</label>
            </div>

            <div class="col-lg-4">
                <input disabled type="text" class="form-control" id="updated_on" name="updated_on" value="<?= $controller->formModel()->get('leg_maj') ?>">
            </div>
        </div>

        <?= $this->submitDashly(); ?>

    </div>

<?php if(method_exists($controller->formModel(), 'isSecret')): ?>
    <div class="card-header">
        <h2 class="h3 mb-0 text-danger">Champs confidentiels</h2>
    </div>

    <div class="card-body">
        <p class="small text-muted mb-3">
            Cochez les champs qui <strong>ne doivent pas être visibles publiquement</strong>.<br>
            Ils resteront enregistrés mais seront masqués lors de l’affichage.
        </p>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 mb-4">
            <?php foreach ($controller->formModel()::legacyMapping() as $new_ref => $old_ref): ?>

                <div class="col">
                    <div class="border rounded-3 p-3 h-100 d-flex justify-content-between align-items-center">
                        <div class="form-check form-switch mb-0">
                            <label class="d-block small text-muted"><?= htmlspecialchars($old_ref) ?>
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    role="switch"
                                    id="secret-form-<?= $new_ref ?>"
                                    name="secret_fields[]"
                                    value="<?= $old_ref ?>"
                                    <?= $controller->formModel()->isSecret($new_ref) ? 'checked="checked"' : '' ?>>
                            </label>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>


        <!-- hidden field that stores the final semicolon string -->
        <input type="hidden" id="secret" name="secret" value="<?= ($raw) ?>">

    </div>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const checkboxes = document.querySelectorAll('input[name="secret_fields[]"]');
        const hidden = document.querySelector('#secret');

        const updateHidden = () => {
            const selected = Array.from(checkboxes)
                .filter(c => c.checked)
                .map(c => c.value);
            hidden.value = selected.join(';');
        };

        checkboxes.forEach(c => c.addEventListener('change', updateHidden));
    });
</script>