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
        <label for="abbrev" class="col-form-label">abbrev</label>
    </div>

    <div class="col-lg">
        <input type="text" class="form-control" id="abbrev" name="abbrev" value="<?= $controller->formModel()->get('abbrev') ?>">
    </div>
</div>
<div class="row mb-4">
    <div class="col-lg-3">
        <label for="profilePicture" class="col-form-label">Photo principale</label>
    </div>

    <div class="col-lg">
        <input type="text" class="form-control" id="profilePicture" name="profilePicture" value="<?= $controller->formModel()->profilePicturePath() ?>">
    </div>
</div>



<div class="d-flex justify-content-end mt-5">
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</div>