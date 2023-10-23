<?php 
$model = new App\Models\Movie();
$model->import($target);

$route_edit = $controller->urlFor('Movie', 'edit', $model); 
$route_view = $controller->urlFor('Movie', 'view', $model); 
?>

<div class="card">
    <a href="<?= $route_view ?>" class="card-image-background" style="background-image:url('<?= $model->profilePicture(); ?>');"></a>
    <a href="<?= $route_view ?>" class="card-body text-center">

        <h3 class="card-title mt-3 mb-1"><?= $model->get('label'); ?></h3>
        <span class="fs-5 mb-4 text-muted text-uppercase"><?= implode(' | ', [$model->get('runtime'), $model->get('released'), $model->get('format')]); ?></span>
        <span class="d-block" otto-tag-id="<?= $model->get('genre_id')?>" ><?= $model->get('genre_id') ?? '&mdash;'; ?></span>
    </a>

    <div class="card-footer d-flex align-items-center justify-content-between">
        
        <form action="<?= $controller->router()->hyp('dash_relation_unlink') ?>" method="POST">
            <input type="hidden" name="parent_id" value="" />
            <input type="hidden" name="child_id" value="" />
            <?= $this->DOM()::button('Détacher', ['class' => 'btn btn-outline-primary btn-sm'])?>
            <button class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-between">
                <span ><?= $model->get('praxis_ids');?></span>
                <?= $this->icon('delete', 14, ['class' => 'ms-6']);?>
            </button>

        </form>
        <a href="<?= $route_edit ?>" class="btn btn-sm btn-secondary">Modifier</a>
    </div>
</div>