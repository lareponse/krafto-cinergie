<?php
$model = new App\Models\Organisation();
// $model->import($target);
$model->import(['id' => $target]);

$route = $controller->urlFor('Organisation', 'view', $model); ?>

<div class="card border-0">
    <a href="<?= $route ?>" class="card-image-background" style="background-image:url('<?= $model->profilePicturePath(); ?>');"></a>

    <div class="card-body text-center">
        <h3 class="card-title mt-3 mb-1"><?= $model->get('label') ?></h3>
        <p class="fs-5 mb-6 text-muted text-uppercase"><a href="<?= $model->get('url') ?>"><?= $model->get('url') ?></a></p>
        <ul class="list-inline mb-0">
            <li class="list-inline-item"><a class="badge text-bg-light p-2" href="javascript: void(0);"><?= $model->get('country'); ?></a></li>
            <li class="list-inline-item"><a class="badge text-bg-light p-2" href="tel:<?= $model->get('tel'); ?>"><?= $model->get('tel'); ?></a></li>
            <li class="list-inline-item"><a class="badge text-bg-light p-2" href="tel:<?= $model->get('gsm'); ?>"><?= $model->get('gsm'); ?></a></li>
            <li class="list-inline-item"><a class="badge text-bg-light p-2" href="mailto:<?= $model->get('email'); ?>"><?= $model->get('email'); ?></a></li>
        </ul>
    </div>
    <div class="card-footer d-flex align-items-center justify-content-between">
        <?php

        $common_fields = $this->Form()::hidden('return_to', $controller->router()->url() . '?tab=Organisation')
            . $this->Form()::hidden('relation', $relation)
            . $this->Form()::hidden('source', $controller->loadModel()->id())
            . $this->Form()::hidden('target', $model->id());

        if (!empty($model->get('praxis_ids'))) {
            $button = $this->DOM()::button($this->icon('delete', 14, ['class' => 'me-2']), ['class' => 'btn btn-sm text-danger ms-auto pe-0']);

            echo '<div>';
            foreach ($model->praxisIds() as $praxis_id) {
                printf(
                    '<form class="d-flex mb-2 align-items-center" action="%s" method="POST">%s%s%s%s</form>',
                    $controller->router()->hyp('dash_relation_unlink'),
                    $common_fields,
                    $this->Form()::hidden('qualifier', $praxis_id),
                    $this->Form()::label('qualifier', $praxis_id, ['class' => 'otto-id-label', 'otto-urn' => 'Tag:' . $praxis_id]),
                    $button
                );
            }
            echo '</div>';
        } else {
            printf('<form action="%s" method="POST">', $controller->router()->hyp('dash_relation_unlink'));
            echo $this->Form()::hidden('return_to', $controller->router()->url() . '?tab=Organisation');
            echo $this->Form()::hidden('relation', $relation);
            echo $this->Form()::hidden('source', $controller->loadModel()->id());
            echo $this->Form()::hidden('target', $model->id());
            echo $this->DOM()::button('Détacher', ['class' => 'btn btn-outline-primary btn-sm']);
            echo '</form>';
        }
        ?>
        <a href="<?= $route ?>" class="btn btn-sm btn-secondary">Voir</a>
    </div>
</div>