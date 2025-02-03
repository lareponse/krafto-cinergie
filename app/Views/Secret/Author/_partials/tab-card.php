<?php 
$model = new App\Models\Author();
$model->import($target);

$route = $controller->urlFor('Author', 'edit', $model); ?>

<div class="card border-0">

    <a href="<?= $route ?>" class="card-body text-center">
        <div class="avatar avatar-xl avatar-circle">
            <?php
            if (empty($model->profilePicturePath()))
                echo $this->icon('author', 60, ['class' => 'avatar-img']);
            else {
                echo $this->DOM()::img($model->profilePicturePath(), 'photo de auteur', ['class' => 'avatar-img']);
            }
            ?>
        </div>

        <h3 class="card-title mt-3 mb-1"><?= $model->get('label') ?></h3>
        <?php
        if (!empty($model->get('city'))) {
        ?>
            <span class="fs-5 text-muted text-uppercase"><?= $model->get('city') ?></span>
        <?php
        }
        ?>

    </a>
    <?php
    if (!empty($model->get('gsm') . $model->get('email') . $model->get('tel'))) {
    ?>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <ul class="list-inline mb-0">
                <li class="list-inline-item"><a class="badge text-bg-light mt-3 p-2" href="tel:<?= $model->get('gsm') ?>"><?= $model->get('gsm') ?></a></li>
                <li class="list-inline-item"><a class="badge text-bg-light mt-3 p-2" href="mailto:<?= $model->get('email') ?>"><?= $model->get('email') ?></a></li>
                <li class="list-inline-item"><a class="badge text-bg-light mt-3 p-2" href="tel:<?= $model->get('tel') ?>"><?= $model->get('tel') ?></a></li>
            </ul>
        </div>
    <?php
    }
    ?>

    <div class="card-footer d-flex align-items-center justify-content-between">
        <?php
            printf('<form action="%s" method="POST">', $controller->router()->hyp('dash_relation_unlink'));
            echo $this->Form()::hidden('return_to', $controller->router()->url().'?tab=Author');
            echo $this->Form()::hidden('relation', $relation);
            echo $this->Form()::hidden('source', $controller->loadModel()->id());
            echo $this->Form()::hidden('target', $model->id());
            echo $this->DOM()::button('Détacher', ['class' => 'btn btn-outline-primary btn-sm']);
            echo '</form>';
        ?>
      
        <a href="<?= $route ?>" class="btn btn-sm btn-secondary">Voir</a>
    </div>

</div>