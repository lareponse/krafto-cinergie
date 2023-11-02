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

        <li>
            <a href="#deleteSection" class="d-flex align-items-center py-3"><?= $this->icon('delete', 14, ['class' => 'me-2']); ?> Supprimer</a>
        </li>
    </ul>
    <div class="p-2">
        
    </div>

    <div class="card-footer text-center">
        <a href="<?= $controller->loadModel() ? $controller->url('view') : $controller->url('list') ?>" class="btn btn-secondary">Retour</a>
    </div>
</div>
<div class="card border-0 sticky-md-top top-10px">
    <div class="card-body">
    <h3 class="h6 small text-secondary text-uppercase mb-3">Articles</h3>
        <ul class="list-unstyled">
            <?php
            foreach ($articles as $article) {
            ?>
                <form method="POST" class="d-flex mb-2 align-items-center" action="<?= $controller->router()->hyp('dash_relation_unlink') ?>">
                    <input type="hidden" name="relation" value="event-hasAndBelongsToMany-article" />
                    <input type="hidden" name="source" value="<?= $controller->loadModel()->getID() ?>" />
                    <input type="hidden" name="target" value="<?= $article->getID() ?>" />

                    <span><?= $article ?></span>
                    <button type="submit" class="btn btn-sm text-danger ms-auto pe-0">
                        <?= $this->icon('delete', 14) ?>
                    </button>
                </form>
            <?php
            }
            ?>
        </ul>

        <?php
        $this->insert('Secret::_partials/otto/otto-complete/OneToMany', [
            'parent' => $controller->loadModel(),
            'relation' => 'event-hasAndBelongsToMany-article',
            'context' => 'Article',
            'placeholder' => 'Mot clé',
            'ottoLinkEndPoint' => '/api/id-label/Article/term/'
        ])
        ?>
    </div>
</div>
