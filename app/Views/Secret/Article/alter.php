<?php
$sidemenu = [
    ['#signaletiqueSection', 'info', 'Signalétique'],
    ['#abstractSection', 'text', 'Abstract'],
    ['#contentSection', 'text', 'Contenu'],
    ['#videoSection', 'video', 'Video'],
    ['#publicationSection', 'info', 'Publication'],
    ['#commentSection', 'comment', 'Commentaires']
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
                <input type="text" class="form-control" id="label" name="label" required value="<?= $controller->formModel()->get('label') ?>">

                <div class="d-flex justify-content-between">
                    <span class="small text-muted">Garder le titre court, dans les 100 caractères</span>
                    <span class="caracter_count">0</span>
                </div>
                <div class="invalid-feedback">Please add your full name</div>
            </div>
            <script>
                let input = document.getElementById('label');
                let counter = input.parentElement.querySelector('.caracter_count');
                console.log(input, input.parentElement, counter);

                counter.textContent = input.value.length;

                input.addEventListener('input', function() {
                    counter.textContent = input.value.length;
                });
            </script>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="publication" class="col-form-label">Sortie</label>
            </div>

            <div class="col-lg">
                <input type="date" class="form-control" id="publication" name="publication" value="<?= $controller->formModel()->get('publication') ?>">
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="publication" class="col-form-label">Catégorie</label>
            </div>

            <div class="col-lg">
                <?= $this->Form()::select('type_id', $types, $controller->formModel()->get('type_id'), ['class' => 'form-control']); ?>
                <div class="invalid-feedback">Please add your full name</div>
            </div>
        </div>

        <?= $this->submitDashly(); ?>

    </div>
</div>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'abstract', 'title' => 'Abstract', 'id' => 'abstractSection']) ?>
<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'content', 'title' => 'Contenu', 'id' => 'contentSection']) ?>
<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'embedVideo', 'title' => 'Vidéo', 'id' => 'videoSection']) ?>

<?= $this->insert('Secret::_partials/form/alter-card-publication') ?>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'comment', 'title' => 'Commentaires', 'id' => 'commentSection']) ?>