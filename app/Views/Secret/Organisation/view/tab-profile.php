<div class="row">
    <div class="col-md-4 col-xxl-3">
        <?php $this->insert('Secret::Organisation/view/tab-profile-sidebar') ?>
    </div>
    <div class="col">
        <div class="card border-0">
            <div class="card-body">
                <h2 class="h3">Biographie</h2>
                <?= $controller->loadModel()->get('content');?>
            </div>
        </div>
        
        <div class="card border-0">
            <div class="card-body">
                <h2 class="h3">Filmographie</h2>
                <?= $controller->loadModel()->get('filmography');?>
            </div>
        </div>
    </div>
</div> 
