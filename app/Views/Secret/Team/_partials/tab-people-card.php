<div class="card border-0">

    <div class="card-body text-center">
        <?php
        if(!empty($person->profilePicture())){
            ?>
            <div class="avatar avatar-xl avatar-circle">
                <img src="<?= $person->profilePicture() ?>" alt="..." class="avatar-img">
            </div>
            <?php
        }
        ?>

        <h3 class="card-title mt-3 mb-1"><?= $person->fullName() ?></h3>
        
        <?php
        if(!empty($person->get('title'))){
            ?><h4 class="text-muted mt-3 mb-1"><?= $person->get('title') ?></h4><?php
        }
        if(!empty($person->get('comment'))){
            ?><h4 class="text-muted mt-3 mb-1"><?= $person->get('comment') ?></h4><?php
        }
        if(!empty($person->get('title'))){
            ?>
            <ul class="list-inline mb-0">
                <li class="list-inline-item"><a class="badge text-bg-light p-2" href="javascript: void(0);"><?= $person->get('email') ?></a></li>
            </ul>
            <?php
        }
        ?>
        
    </div>


    <div class="card-footer d-flex align-items-center justify-content-between">
    <a href="<?= $controller->router()->hyp('dash_'.$person->model_type().'_toggle', ['id' => $person->id()])?>" class="btn btn-secondary btn-sm">Toggle</a>


        <a href="<?= $controller->router()->hyp('dash_record_edit', ['nid' => $person->nid(), 'id' => $person->id()])?>" class="btn btn-primary btn-sm">Modifier</a>
    </div>
</div>
