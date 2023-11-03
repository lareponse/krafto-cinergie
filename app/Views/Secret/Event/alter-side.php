<div class="card border-0 sticky-md-top top-10px">
    <div class="card-body">
        <div class="text-center mb-5">
            <h3 class="mb-0"><?= $controller->formModel()->get('firstname'); ?> <?= $controller->formModel()->get('lastname'); ?></h3>
            <span class="small text-secondary fw-semibold"><?= $controller->formModel()->get('label'); ?></span>
        </div>

        <!-- Divider -->
        <hr class="mb-0">
    </div>

    <ul class="scrollspy mb-5" id="account" data-scrollspy='{"offset": "30"}'>

        <li>
            <a href="#signaletiqueSection" class="d-flex align-items-center py-3"><?= $this->icon('info', 14, ['class' => 'me-2']); ?> Signalétique</a>
        </li>

        <li>
            <a href="#contentSection" class="d-flex align-items-center py-3"><?= $this->icon('text', 14, ['class' => 'me-2']); ?> Contenu</a>
        </li>

        <li>
            <a href="#publicationSection" class="d-flex align-items-center py-3"><?= $this->icon('info', 14, ['class' => 'me-2']); ?> Publication</a>
        </li>
        <?php if ($controller->loadModel()){
        ?>
        <li>
            <a href="<?= $controller->router()->hyp('dash_delete', ['authority' => $controller->loadModel()->authority(), 'id' => $controller->loadModel()->id()])?>" class="d-flex align-items-center py-3"><?= $this->icon('delete', 14, ['class' => 'me-2']); ?> Supprimer</a>
        </li>
        <?php
        }
        ?>
    </ul>
    <div class="p-2">
        
    </div>

    <div class="card-footer text-center">
        <a href="<?= $controller->loadModel() ? $controller->url('view') : $controller->url('list') ?>" class="btn btn-secondary">Retour</a>
    </div>
</div>