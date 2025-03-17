<div class="card border-0 scroll-mt-3" id="<?= $id ?>">
    <div class="card-header">
        <h2 class="h3 mb-0"><?= $title ?? 'Contenu' ?></h2>
    </div>
    <div class="card-body">
        <?php
        if (!isset($wysiwyg) || $wysiwyg == true) {
        ?>
            <div class="wysiwyg"
                data-name="<?= $name ?>"
                data-antidoteapi_jsconnect_groupe_id="grp-01"><?= $controller->formModel()->get($name); ?></div>
        <?php
        } else {
        ?>
            <textarea class="form-control" name="<?= $name ?>" id="<?= $name ?>" rows="<?= $rows ?? 4; ?>"><?= $controller->formModel()->get($name); ?></textarea>
        <?php
        }
        ?>
        <?= $this->submitDashly(); ?>
    </div>
</div>