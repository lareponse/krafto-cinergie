<?php
$list_item = '<li class="py-2">%s %s</li>';
?>
<div class="card border-0 pt-3">
    <div class="card-body pt-0">
        <h3 class="h6 small text-secondary text-uppercase mb-3">Technique</h3>

        <ul class="list-unstyled mb-7">
            <?php
            $fields = [
                'legacy_origine' => 'origine',
                'released' => 'calendar',
                'runtime' => 'time',
                'format' => 'video-format',
                'genre_id' => 'genre',
                'metrage_id' => 'metrage',
                'url' => 'http',
                'url_trailer' => 'video-player'
            ];

            foreach ($fields as $name => $icon) {
                if (!empty($controller->loadModel()->get($name))) {
                    $label = $controller->loadModel()->get($name);
                    switch ($name) {
                        case 'url':
                            $label = '<a href="' . $label . '">site</a>';
                            break;

                        case 'metrage_id':
                        case 'genre_id':
                            $label = $this->DOM()::span($label, ['class' => 'otto-id-label', 'otto-urn' => "Tag:$label"]);
                            break;
                    }
                    printf($list_item, $this->icon($icon, 14, ['class' => 'me-2']), $label);
                }
            }
            ?>
        </ul>

        <h3 class="h6 small text-secondary text-uppercase mb-3">Mise à jour</h3>
        <div class="mb-7">
            <span class="otto-date"><?= $controller->loadModel()->get('legacy_maj') ?></span>
        </div>
    </div>
</div>

<div class="card border-0 pt-3">
    <div class="card-body pt-0">
        
        <h3 class="h6 small text-secondary text-uppercase mb-3">Thèmes</h3>

        <?php
        foreach ($themes as $id) {
        ?>
            <form method="POST" class="d-flex mb-2 align-items-center" action="<?= $controller->router()->hyp('dash_relation_unlink') ?>">
                <input type="hidden" name="relation" value="movie-hasAndBelongsToMany-tag" />
                <input type="hidden" name="source" value="<?= $controller->loadModel()->getID() ?>" />
                <input type="hidden" name="target" value="<?= $id ?>" />

                <span class="otto-id-label" otto-urn="Tag:<?= $id ?>"><?= $id ?></span>
                <button type="submit" class="btn btn-sm text-danger ms-auto pe-0">
                    <?= $this->icon('delete', 14) ?>
                </button>
            </form>
        <?php
        }
        $this->insert('Secret::_partials/otto/otto-complete/OneToMany', [
            'parent' => $controller->loadModel(),
            'relation' => 'movie-hasAndBelongsToMany-tag',
            'placeholder' => 'Thème',
            'ottoLinkEndPoint' => '/api/tag/movie_theme/term/'
        ])

        ?>
</div>
</div>

<div class="card border-0 pt-3">
    <div class="card-body pt-0">
        <h3 class="h6 small text-secondary text-uppercase mb-3">Thésaurus</h3>
        <ul class="list-unstyled">
            <?php
            foreach ($thesaurus as $id) {
            ?>

            <form method="POST" class="d-flex mb-2 align-items-center" action="<?= $controller->router()->hyp('dash_relation_unlink') ?>">
                <input type="hidden" name="relation" value="movie-hasAndBelongsToMany-thesaurus" />
                <input type="hidden" name="source" value="<?= $controller->loadModel()->getID() ?>" />
                <input type="hidden" name="target" value="<?= $id ?>" />

                <span class="otto-id-label" otto-urn="Thesaurus:<?= $id ?>" otto-id="<?= $id ?>"><?= $id ?></span>
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
            'relation' => 'movie-hasAndBelongsToMany-thesaurus',
            'context' => 'Thesaurus',
            'placeholder' => 'Mot clé',
            'ottoLinkEndPoint' => '/api/id-label/Thesaurus/term/'
        ])
        ?>
    </div>
</div>