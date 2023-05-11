
<div class="card border-0 pt-3">
    <div class="card-body pt-0">
        <h3 class="h6 small text-secondary text-uppercase mb-3">Auteur(s)</h3>
        <ul class="list-unstyled mb-7">
            <?php 
            foreach($authors as $author){
                $route_view = $controller->urlFor('Author', 'view', $author); 
                ?>
                <li class="py-2">
                    <?= $this->icon('author', 18, ['class' => 'me-2']) ?>
                    <a href="<?=$route_view ?>"><?= $author ?></a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>

<div class="card border-0 pt-3">
    <div class="card-body pt-0">
    <?php $this->insert('Secret::_partials/legacy_view', ['model' => $controller->loadModel()])?>
    </div>
</div>
