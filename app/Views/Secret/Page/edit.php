<?php $this->layout('Secret::edit') ?>

<form action="" method="POST">
<div class="card border-0 scroll-mt-3" id="synopsisSection">
        <div class="card-header">
            <h2 class="h3 mb-0">Sommaire</h2>
        </div>

        <div class="card-body">
            <textarea class="form-control tinymce" id="abstract" name="abstract" rows="10"><?= $controller->formModel()->get('abstract');?></textarea>

            <div class="d-flex justify-content-end mt-5">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
    <div class="card border-0 scroll-mt-3" id="synopsisSection">
        <div class="card-header">
            <h2 class="h3 mb-0">Contenu</h2>
        </div>

        <div class="card-body">
            <textarea class="form-control tinymce" id="content" name="content" rows="20"><?= $controller->formModel()->get('content');?></textarea>
            <div class="d-flex justify-content-end mt-5">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</form>
