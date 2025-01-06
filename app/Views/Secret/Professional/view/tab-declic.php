<div class="row">
    <div class="col">
        <div class="card border-0">
            <div class="card-header border-0">
                <h2 class="h3"><?= $controller->formModel()->get('declic_signature');?></h2>
            </div>
            <div class="card-body">
                <?= $controller->formModel()->get('declic_texte');?>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card border-0">
            <div class="card-body">
                <img src="/<?= $controller->formModel()->get('declic_image');?>" class="img-fluid"/>
            </div>
        </div>
    </div>
</div>
