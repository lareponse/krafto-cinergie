<?php
$sidemenu = [
    ['#signaletiqueSection', 'identity', 'Signalétique'],
    ['#BiographieSection', 'text', 'Biographie'],
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
                <label for="lastname" class="col-form-label">Nom</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="label" name="label" value="<?= $controller->formModel()->get('label') ?>">
                <div class="invalid-feedback">Vous n'avez pas précisé cette information</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="group" class="col-form-label">Groupe</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="group" name="group" value="<?= $controller->formModel()->get('group') ?>">
                <div class="invalid-feedback">Vous n'avez pas précisé cette information</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="title" class="col-form-label">Titre</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="title" name="title" value="<?= $controller->formModel()->get('title') ?>">
                <div class="invalid-feedback">Vous n'avez pas précisé cette information</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="email" class="col-form-label">Email</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="email" name="email" value="<?= $controller->formModel()->get('email') ?>">
                <div class="invalid-feedback">Vous n'avez pas précisé cette information</div>
            </div>
        </div>  
          
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="comment" class="col-form-label">Commentaire</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="comment" name="comment" value="<?= $controller->formModel()->get('comment') ?>">
                <div class="invalid-feedback">Vous n'avez pas précisé cette information</div>
            </div>
        </div>        

        <?= $this->submitDashly(); ?>

    </div>
</div>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'content', 'title' => 'Biographie', 'id' => 'BiographieSection']) ?>
<?= $this->insert('Secret::_partials/form/alter-card-publication') ?>