<div class="row">
    <div class="col-md-4 col-xl-4 col-xxl-3">
        <?php $list_item = '<li class="py-2">%s %s</li>'; ?>
        <?= $this->insert('Secret::_partials/praxis/sidebar-card', ['list_item' => $list_item])?>
        <?= $this->insert('Secret::_partials/contact/sidebar-card', ['list_item' => $list_item])?>
        <?= $this->insert('Secret::_partials/address/sidebar-card', ['list_item' => $list_item])?>
    </div>

    <div class="col">
        
        <div class="card border-0">
            <div class="card-body">
                <h2 class="h3">Biographie</h2>
                <?php
                if(empty($controller->loadModel()->get('content'))){
                    ?><a class="btn btn-sm btn-warning" href="<?= $controller->url('edit')?>">Ajouter</a><?php
                }
                else{
                    echo $controller->loadModel()->get('content');
                }
                ?>
            </div>
        </div>
        
        <div class="card border-0">
            <div class="card-body">
                <h2 class="h3">Filmographie</h2>
                <?php
                if(empty($controller->loadModel()->get('filmography'))){
                    ?><a class="btn btn-sm btn-warning" href="<?= $controller->url('edit')?>">Ajouter</a><?php
                }
                else{
                    echo $controller->loadModel()->get('filmography');
                }
                ?>
            </div>
        </div>
    </div>
</div> 
