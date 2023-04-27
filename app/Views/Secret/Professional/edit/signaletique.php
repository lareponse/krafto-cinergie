<div class="row mb-4">
    <div class="col-lg-3">
        <label for="lastname" class="col-form-label">Nom</label>
    </div>

    <div class="col-lg">
        <input type="text" class="form-control" id="lastname" value="<?= $controller->formModel()->get('lastname') ?>">
        <div class="invalid-feedback">Vous n'avez pas précisé cette information</div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg-3">
        <label for="firstname" class="col-form-label">Prénom</label>
    </div>

    <div class="col-lg">
        <input type="text" class="form-control" id="firstname" value="<?= $controller->formModel()->get('firstname') ?>">
        <div class="invalid-feedback">Vous n'avez pas précisé cette information</div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg-3">
        <label for="gender" class="col-form-label">Genre</label>
    </div>

    <div class="col-lg">
        <select class="form-select" name="gender" id="gender">
            <?php $this->insert('Secret::_partials/form/options-gender', ['selected' => $controller->formModel()->get('gender')]) ?>
        </select>
        <div class="invalid-feedback">Vous n'avez pas précisé cette information</div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg-3">
        <label for="birth" class="col-form-label">Naissance</label>
    </div>

    <div class="col-lg-3">
        <input type="date" class="form-control" id="birth" name="birth" value="<?= $controller->formModel()->get('birth') ?>">
        <div class="invalid-feedback">Vous n'avez pas précisé cette information</div>
    </div>
    <div class="col-lg-3">
        <label for="death" class="col-form-label">Décès</label>
    </div>

    <div class="col-lg-3">
        <input type="date" class="form-control" id="death" name="death" value="<?= $controller->formModel()->get('death') ?>">
        <div class="invalid-feedback">Vous n'avez pas précisé cette information</div>
    </div>
</div>

<div class="d-flex justify-content-end mt-5">
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</div>