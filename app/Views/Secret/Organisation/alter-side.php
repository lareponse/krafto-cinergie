
<div class="card border-0 sticky-md-top top-10px">
    <div class="card-body">
        <div class="text-center mb-5">
            <div class=" mb-5">
                <label class="d-block cursor-pointer">
                    <span class="position-absolute bottom-0 end-0 m-0 text-bg-primary w-30px h-30px rounded-circle d-flex align-items-center justify-content-center">
                        <?= $this->icon('edit', 30)?>
                      
                    </span>
                    <input type="file" name="avatar" class="d-none">
                </label>
                <img src="<?= $controller->formModel()->hasProfilePicture() ? $controller->formModel()->profilePicture() : '' ?>" alt="..." class="img-fluid">
            </div>

            <h3 class="mb-0"><?= $controller->formModel()->get('firstname'); ?> <?= $controller->formModel()->get('label'); ?></h3>
        </div>

        <hr class="mb-0">
    </div>

    <ul class="scrollspy mb-5" id="account" data-scrollspy='{"offset": "30"}'>
        <li class="active">
            <a href="#SignalétiqueSection" class="d-flex align-items-center py-3">
                <?= $this->icon('info', 14, ['class' => 'me-3']); ?> Signalétique
            </a>
        </li>

        <li>
            <a href="#ContactSection" class="d-flex align-items-center py-3">
                <?= $this->icon('contact', 14, ['class' => 'me-3']); ?> Contact
            </a>
        </li>
        <li>
            <a href="#AdresseSection" class="d-flex align-items-center py-3">
                <?= $this->icon('address', 14, ['class' => 'me-3']); ?> Adresse
            </a>
        </li>

        <li>
            <a href="#ContentSection" class="d-flex align-items-center py-3">
                <?= $this->icon('text', 14, ['class' => 'me-3']); ?> Contenu
            </a>
        </li>

        <li>
            <a href="#FilmographieSection" class="d-flex align-items-center py-3">
                <?= $this->icon('text', 14, ['class' => 'me-3']); ?> Filmographie
            </a>
        </li>

        <li>
            <a href="#PublicationSection" class="d-flex align-items-center py-3">
             <?= $this->icon('text', 14, ['class' => 'me-3']); ?> Publication
            </a>
        </li>

        <li>
            <a href="#LegalSection" class="d-flex align-items-center py-3">
                <?= $this->icon('address', 14, ['class' => 'me-3']); ?> Légal
            </a>
        </li>

        <li>
            <a href="#deleteSection" class="d-flex align-items-center py-3">
                 <?= $this->icon('delete', 14, ['class' => 'me-3']); ?> Supprimer
            </a>
        </li>
    </ul>

    <div class="card-footer text-center">
        <a href="<?= $controller->url('view')?>" class="btn btn-secondary">Retour</a>

    </div>
</div>