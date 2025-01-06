<div class="card border-0 scroll-mt-3" id="<?= $id ?>">
    <div class="card-header">
        <h2 class="h3 mb-0"><?= $title ?? 'Contenu' ?></h2>
    </div>

    <div class="card-body">
        <textarea class="form-control tinymce" name="<?= $name?>" id="<?= $name?>" rows="<?= $rows ?? 4;?>"><?= $controller->formModel()->get($name); ?></textarea>
        <div class="invalid-feedback">Please tell something about yourself</div>

        <?= $this->submitDashly(); ?>

    </div>
</div>