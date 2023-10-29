<?php 
$model = new App\Models\Article();
$model->import($target);

$route_edit = $controller->urlFor('Article', 'edit', $model);
$route_view = $controller->urlFor('Article', 'view', $model); 
?>

<div class="card">
    <a href="<?= $route_view ?>" class="card-image-background" style="background-image:url('<?= $model->profilePicture(); ?>');"></a>
    <a href="<?= $route_view ?>" class="card-body text-center">

        <h3 class="card-title mt-3 mb-1"><?= $model->get('label'); ?></h3>
        <span class="fs-5 mb-4 text-muted"><span class="otto-date"><?= $model->get('publication') ?? '&mdash;'; ?></span> | <?= $model->get('type_label') ?? '&mdash;'; ?></span>
    </a>

    <div class="card-footer d-flex align-items-center justify-content-between">
        <?php
            printf('<form action="%s" method="POST">', $controller->router()->hyp('dash_relation_unlink'));
            echo $this->Form()::hidden('return_to', $controller->router()->url().'?tab=Article');
            echo $this->Form()::hidden('relation', $relation);
            echo $this->Form()::hidden('source', $controller->loadModel()->getID());
            echo $this->Form()::hidden('target', $model->getID());
            echo $this->DOM()::button('Détacher', ['class' => 'btn btn-outline-primary btn-sm']);
            echo '</form>';
        ?>
      
        <a href="<?= $route_view ?>" class="btn btn-sm btn-secondary">Voir</a>
    </div>
</div>

