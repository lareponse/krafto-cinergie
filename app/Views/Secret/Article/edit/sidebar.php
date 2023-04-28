
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
            <span class="small text-secondary fw-semibold"><?= $controller->formModel()->get('label');?></span>
        </div>

        <!-- Divider -->
        <hr class="mb-0">
    </div>

    <ul class="scrollspy mb-5" id="account" data-scrollspy='{"offset": "30"}'>

        <li>
            <a href="#signaletiqueSection" class="d-flex align-items-center py-3"><?= $this->icon('info', 14, ['class' => 'me-2']);?> Signalétique</a>
        </li>

        <li>
            <a href="#abstractSection" class="d-flex align-items-center py-3"><?= $this->icon('text', 14, ['class' => 'me-2']);?> Abstract</a>
        </li>

        <li>
            <a href="#contentSection" class="d-flex align-items-center py-3"><?= $this->icon('text', 14, ['class' => 'me-2']);?> Contenu</a>
        </li>

        <li>
            <a href="#videoSection" class="d-flex align-items-center py-3"><?= $this->icon('video', 14, ['class' => 'me-2']);?> Video</a>
        </li>

        <li>
            <a href="#publicationSection" class="d-flex align-items-center py-3"><?= $this->icon('info', 14, ['class' => 'me-2']);?> Publication</a>
        </li>

        <li>
            <a href="#commentSection" class="d-flex align-items-center py-3"><?= $this->icon('comment', 14, ['class' => 'me-2']);?> Commentaires</a>
        </li>

        <li>
            <a href="#deleteSection" class="d-flex align-items-center py-3"><?= $this->icon('delete', 14, ['class' => 'me-2']);?> Supprimer</a>
        </li>

    </ul>

    <div class="card-footer text-center">
    
        <a href="<?= $controller->loadModel() ? $controller->url('view') : $controller->url('list')?>" class="btn btn-secondary">Retour</a>
    </div>
</div>
