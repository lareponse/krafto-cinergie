<div class="card border-0 scroll-mt-3" id="<?= $id ?>">
    <div class="card-header">
        <h2 class="h3 mb-0"><?= $title ?? 'Contenu' ?></h2>
    </div>

    <div class="card-body">
        <div class="wysiwyg"><?= $controller->formModel()->get($name); ?></div>
        <?php 
        /*
        <textarea class="form-control" name="<?= $name ?>" id="<?= $name ?>" rows="<?= $rows ?? 4; ?>"><?= $controller->formModel()->get($name); ?></textarea>
        <div class="invalid-feedback">Please tell something about yourself</div>
        */
        ?>

        <?= $this->submitDashly(); ?>

    </div>
</div>