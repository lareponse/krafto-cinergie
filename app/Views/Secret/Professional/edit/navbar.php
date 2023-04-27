<div class="card border-0 sticky-md-top top-10px">
    <div class="card-body">
        <div class="text-center mb-5">
            <div class="avatar avatar-xxl avatar-circle mb-5">
                <label class="d-block cursor-pointer">
                    <span class="position-absolute bottom-0 end-0 m-0 text-bg-primary w-30px h-30px rounded-circle d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="14" width="14"><g><path d="M2.65,16.4a.5.5,0,0,0-.49-.13.52.52,0,0,0-.35.38L.39,23a.51.51,0,0,0,.6.6l6.36-1.42a.52.52,0,0,0,.38-.35.5.5,0,0,0-.13-.49Z" style="fill: currentColor"/><path d="M17.85,7.21l-11,11a.24.24,0,0,0,0,.35l1.77,1.77a.5.5,0,0,0,.71,0L20,9.68A.48.48,0,0,0,20,9L18.21,7.21A.25.25,0,0,0,17.85,7.21Z" style="fill: currentColor"/><path d="M16.79,5.79,15,4a.48.48,0,0,0-.7,0L3.71,14.63a.51.51,0,0,0,0,.71l1.77,1.77a.24.24,0,0,0,.35,0l11-11A.25.25,0,0,0,16.79,5.79Z" style="fill: currentColor"/><path d="M22.45,1.55a4,4,0,0,0-5.66,0l-.71.71a.51.51,0,0,0,0,.71l5,4.95a.52.52,0,0,0,.71,0l.71-.71A4,4,0,0,0,22.45,1.55Z" style="fill: currentColor"/></g></svg>
                    </span>
                    <input type="file" name="avatar" class="d-none">
                </label>
                <img src="<?= $controller->formModel()->get('legacy_photo')?>" alt="..." class="avatar-img" width="112" height="112">
            </div>

            <h3 class="mb-0"><?= $controller->formModel()->get('firstname');?> <?= $controller->formModel()->get('lastname');?></h3>
            <span class="small text-secondary fw-semibold">Assistant Manager</span>
        </div>

        <!-- Divider -->
        <hr class="mb-0">
    </div>

    <ul class="scrollspy mb-5" id="account" data-scrollspy='{"offset": "30"}'>
    <li class="active">
            <a href="#SignalétiqueSection" class="d-flex align-items-center py-3">
                <?= $this->icon('identity', 14, ['class' => 'me-3']); ?> Signalétique
            </a>
        </li>

        <li>
            <a href="#jobSection" class="d-flex align-items-center py-3">
                <?= $this->icon('praxis', 14, ['class' => 'me-3']); ?> Métiers
            </a>
        </li>

        <li>
            <a href="#ContactSection" class="d-flex align-items-center py-3">
                <?= $this->icon('phone', 14, ['class' => 'me-3']); ?> Contact
            </a>
        </li>
        <li>
            <a href="#AdresseSection" class="d-flex align-items-center py-3">
                <?= $this->icon('origine', 14, ['class' => 'me-3']); ?> Adresse
            </a>
        </li>

        <li>
            <a href="#BiographieSection" class="d-flex align-items-center py-3">
            <?= $this->icon('text', 14, ['class' => 'me-3']); ?> Biographie
            </a>
        </li>

        <li>
            <a href="#FilmographieSection" class="d-flex align-items-center py-3">
             <?= $this->icon('text', 14, ['class' => 'me-3']); ?> Filmographie
            </a>
        </li>

      

        <li>
            <a href="#deleteSection" class="d-flex align-items-center py-3">
                <svg viewBox="0 0 24 24" height="14" width="14" class="me-3" xmlns="http://www.w3.org/2000/svg"><path d="M18.177,23.25H7.677a1.5,1.5,0,0,1-1.5-1.5V8.25h13.5v13.5A1.5,1.5,0,0,1,18.177,23.25Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path d="M10.677 18.75L10.677 12.75" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path d="M15.177 18.75L15.177 12.75" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path d="M2.427 6.212L21.501 2.158" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path d="M13.541.783l-4.4.935A1.5,1.5,0,0,0,7.984,3.5L8.3,4.965l7.336-1.56L15.32,1.938A1.5,1.5,0,0,0,13.541.783Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>
                Supprimer
            </a>
        </li>
    </ul>

    <div class="card-footer text-center">
        <a href="<?= $controller->router()->hyp('dash_professional', ['id' => $controller->formModel()->getID()])?>" class="btn btn-secondary">Retour</a>
    </div>
</div>
