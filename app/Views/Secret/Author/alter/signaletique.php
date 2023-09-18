<div class="row mb-4">
    <div class="col-lg-3">
        <label for="lastname" class="col-form-label">Nom</label>
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
        <label for="professional_slug" class="col-form-label">Fiche professionel</label>
    </div>

    <div class="col-lg">
        <input type="text" class="form-control" id="professional_slug" name="professional_slug" value="<?= $controller->formModel()->get('professional_slug') ?>">
    </div>
</div>
<div class="row mb-4">
    <div class="col-lg-3">
        <label for="profilePicture" class="col-form-label">Photo principale</label>
    </div>

    <div class="col-lg">
        <input type="text" class="form-control" id="profilePicture" name="profilePicture" value="<?= $controller->formModel()->get($controller->formModel()->profilePictureField()) ?>">
    </div>
</div>


<div class="d-flex justify-content-end mt-5">
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</div>