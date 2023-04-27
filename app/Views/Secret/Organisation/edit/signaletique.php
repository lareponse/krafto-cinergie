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
        <label for="legacy_photo" class="col-form-label">legacy_photo</label>
    </div>

    <div class="col-lg">
        <input type="text" class="form-control" id="legacy_photo" name="legacy_photo" value="<?= $controller->formModel()->get('legacy_photo') ?>">
    </div>
</div>



<div class="d-flex justify-content-end mt-5">
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</div>