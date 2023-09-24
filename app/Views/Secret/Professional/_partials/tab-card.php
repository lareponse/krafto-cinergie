<?php $route = $controller->urlFor('Professional', 'view', $model); ?>


<div class="card border-0">
    <!-- <a href="<?= $route ?>" class="card-image-background" style="background-image:url('<?= $model->profilePicture(); ?>');"></a> -->

    <a href="<?= $route ?>" class="card-body text-center">
        <div class="avatar avatar-xl avatar-circle">
            <?php
            if (empty($model->profilePicture()))
                echo $this->icon('professional', 60, ['class' => 'avatar-img']);
            else {
                echo $this->DOM()::img($model->profilePicture(), 'photo du professionel', ['class' => 'avatar-img']);
            }
            ?>
        </div>

        <h3 class="card-title mt-3 mb-1"><?= $model->fullName() ?></h3>
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
          $table = get_class($model)::model_type();
          $table_b = get_class($controller->loadModel())::model_type();

          printf('<form action="%s" method="POST">%s%s%s</form>', 
              $controller->router()->hyp('dash_relation_unlink'),
              $this->Form()::hidden($table, $model->getID()),
              $this->Form()::hidden($table_b, $controller->loadModel()->getID()),
              $this->DOM()::button('Détacher', ['class' => 'btn btn-outline-primary btn-sm'])
          );
        ?>
      
        <a href="<?= $route ?>" class="btn btn-sm btn-secondary">Voir</a>
    </div>

</div>