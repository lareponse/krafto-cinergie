<?php 
$article = new App\Models\Article();
$article->import($model);
$model = $article;
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
        <form action="<?= $controller->router()->hyp('dash_relation_unlink') ?>" method="POST">
            <input type="hidden" name="parent_id" value="" />
            <input type="hidden" name="child_id" value="" />
            <button class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-between">
                <span class="otto-tag-label" otto-id="<?= $model->get('worked_as');?>"><?= $model->get('worked_as');?></span>
                <?= $this->icon('delete', 14, ['class' => 'ms-6']);?>
            </button>

        </form>
        <a href="<?= $route_edit ?>" class="btn btn-sm btn-secondary">Modifier</a>
    </div>
</div>