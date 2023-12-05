<div class="row">
    <div class="col-md-4 col-xxl-3">

    <div class="card border-0 pt-3">
            <div class="card-body pt-0">
                <h3 class="h6 small text-secondary text-uppercase mb-3">Technique</h3>

                <ul class="list-unstyled">
                    <?php
                    $fields = [
                        'slug' => 'http',
                        'publication' => 'calendar',
                        'runtime' => 'time',
                        'format' => 'video-format',
                        'genre_id' => 'genre',
                        'metrage_id' => 'metrage',
                        'url' => 'http',
                        'url_trailer' => 'video-player'
                    ];
                    $list_item = '<li class="py-2">%s %s</li>';

                    foreach ($fields as $name => $icon) {
                        if (!empty($controller->loadModel()->get($name))) {
                            $label = $controller->loadModel()->get($name);
                            switch ($name) {
                                case 'url':
                                    $label = '<a href="' . $label . '">site</a>';
                                    break;

                                case 'metrage_id':
                                case 'genre_id':
                                    $label = $this->DOM()::span($label, ['class'=> "otto-id-label", 'otto-urn'=>"Tag:$label"]);
                                    break;
                                case 'publication':
                                    $label = $this->DOM()::span($label, ['class' => 'otto-date']);

                            }
                            printf($list_item, $this->icon($icon, 14, ['class' => 'me-2']), $label);
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php $this->insert('Secret::_partials/legacy_view', ['model' => $controller->loadModel()]) ?>
    </div>

    <div class="col">

        <div class="card border-0">
            <div class="card-body">
                <h2 class="h3">Abstract</h2>
                <?php
                if (empty($controller->loadModel()->get('abstract'))) {
                    echo $this->DOM()::a($controller->url('edit').'#abstractSection', 'Ajouter', ['class' => 'btn btn-sm btn-warning']);
                } else {
                    echo $controller->loadModel()->get('abstract');
                }
                ?>
            </div>
        </div>

        <div class="card border-0">
            <div class="card-body">
                <h2 class="h3">Contenu</h2>
                <?php
                if (empty($controller->loadModel()->get('content'))) {
                    echo $this->DOM()::a($controller->url('edit').'#contentSection', 'Ajouter', ['class' => 'btn btn-sm btn-warning']);
                } else {
                    echo $controller->loadModel()->get('content');
                }
                ?>
            </div>
        </div>

        <div class="card border-0">
            <div class="card-body">
                <h2 class="h3">Vidéo</h2>
                <?php
                if (empty($controller->loadModel()->get('embedVideo'))) {
                    echo $this->DOM()::a($controller->url('edit').'#videoSection', 'Ajouter', ['class' => 'btn btn-sm btn-warning']);
                } else {
                    echo $controller->loadModel()->get('embedVideo');
                }
                ?>
            </div>
        </div>
    </div>
</div>