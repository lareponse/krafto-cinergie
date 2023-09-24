<div class="row">
    <div class="col-md-4 col-xxl-3">
        <?php $this->insert('Secret::Article/view/tab-profile-sidebar') ?>
    </div>

    <div class="col">
        
        <div class="card border-0">
            <div class="card-body">
                <h2 class="h3">Abstract</h2>
                <?php
                if(empty($controller->loadModel()->get('abstract'))){
                    ?><a class="btn btn-sm btn-warning" href="<?= $controller->url('edit')?>">Ajouter</a><?php
                }
                else{
                    echo $controller->loadModel()->get('abstract');
                }
                ?>
            </div>
        </div>
        <?php if(!empty($controller->loadModel()->get('embedVideo'))){ ?>
        <div class="card border-0">
            <div class="card-body">
                <h2 class="h3">Video</h2>
                <?= $controller->loadModel()->get('embedVideo'); ?>
            </div>
        </div>
        <?php } ?>
        
        <div class="card border-0">
            <div class="card-body">
                <h2 class="h3">Contenu</h2>
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
    </div>
</div> 
