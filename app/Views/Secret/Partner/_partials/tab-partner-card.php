<div class="card border-0">

    <div class="card-body text-center">
        <div >
            <img src="/<?= $partner->profilePicture() ?>" alt="..." class="avatar-img">
        </div>

        
        <h3 class="card-title mt-3 mb-1"><?= $partner->get('label') ?></h3>
        <p class="fs-5 mb-6 text-muted otto-url"><?= $partner->get('url') ?></p>
    </div>

    <div class="card-footer d-flex align-items-center justify-content-between">
        <span class="fs-5 text-secondary text-truncate"></span>

        <a href="<?= $controller->router()->hyp('dash_partner_edit', ['id' => $partner->getID()])?>" class="btn btn-primary btn-sm">Modifier</a>
    </div>
</div>
