<?php
if (empty($sidemenu) || empty($controller))
    throw new \Exception('Missing $sidemenu or $controller');
?>
<div class="card border-0 sticky-md-top top-10px">
    <div class="card-body">
        <ul class="scrollspy mb-5" id="account" data-scrollspy='{"offset": "200"}'>
            <?php

            if ($controller->loadModel()) {
                $delete_url = $controller->router()->hyp('dash_delete', ['nid' => $controller->loadModel()->nid(), 'id' => $controller->loadModel()->id()]);
                array_push($sidemenu, [$delete_url, 'delete', 'Supprimer']);
            }
            
            foreach ($sidemenu as [$href, $icon, $label]) {
                $content = $this->icon($icon, 14, ['class' => 'me-2']) . ' ' . $label;
                // vd($content);
                echo $this->DOM()::li(
                    (string)$this->DOM()::a($href, $content, ['class' => 'd-flex align-items-center py-3'], false)
                ,[], false);
            }
            ?>

        </ul>
    </div>

    <div class="card-footer text-center">
        <a href="<?= $controller->loadModel() ? $controller->url('view') : $controller->url('list') ?>" class="btn btn-secondary">Retour</a>
    </div>
</div>