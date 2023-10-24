<?php 
$model = new App\Models\Organisation();
$model->import($target);

$route = $controller->urlFor('Organisation', 'view', $model); ?>

<div class="card border-0">
    <a href="<?= $route ?>" class="card-image-background" style="background-image:url('<?= $model->profilePicture(); ?>');"></a>

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
        if(!empty($model->get('worked_as'))){
            echo implode('',array_map(function($praxis_id) use ($controller, $model){
                return sprintf(
                    '<form action="%s" method="POST">
                     <input type="hidden" name="movie" value=%d" />
                     <input type="hidden" name="organisation" value="%d" />
                     <input type="hidden" name="praxis" value="%d" />
                     <button class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-between">
                        %s
                        <span class="otto-tag-label" otto-id="%d">%d</span>
                     </button>
                    </form>',
                            $controller->router()->hyp('dash_relation_unlink'),
                            $controller->loadModel()->getID(),
                            $model->getID(),
                            $praxis_id,

                            $this->icon('delete', 14, ['class' => 'me-2']), 
                            $praxis_id, 
                            $praxis_id
                );
            }, explode(',',$model->get('worked_as'))));
        }
        else
        {
            printf('<form action="%s" method="POST">', $controller->router()->hyp('dash_relation_unlink'));
            echo $this->Form()::hidden('return_to', $controller->router()->url().'?tab=Organisation');
            echo $this->Form()::hidden('relation', $relation);
            echo $this->Form()::hidden('source', $controller->loadModel()->getID());
            echo $this->Form()::hidden('target', $model->getID());
            echo $this->DOM()::button('Détacher', ['class' => 'btn btn-outline-primary btn-sm']);
            echo '</form>';
        }
        ?>
            <a href="<?= $route ?>" class="btn btn-sm btn-secondary">Voir</a>
    </div>
</div>