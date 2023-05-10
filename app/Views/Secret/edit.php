<?php $this->layout('Secret::dashboard') ?>

<div class="row">
    <?php 
    $navbarPath = 'Secret::'.$controller->className().'/edit/sidebar';
    if ($this->engine->exists($navbarPath)){
        ?><div class="col-md-4 col-xxl-3"><?=$this->insert($navbarPath) ?></div><?php
    }

    ?>
    <div class="col">
        <form action="<?= $controller->router()->hyp('dash_record_save', ['controller' => $controller->className()]);?>" method="POST" novalidate>
        <input type="hidden" name="id" value="<?= $controller->formModel()->getID();?>" />
        <?=$this->section('content')?>
        </form>
        
        <?=$this->section('deleteForm')?>
        
    </div>
</div>

<?php $this->unshift('scripts') ?>
<script src="/public/assets/js/tinymce/tinymce.min.js"></script>
<script src="/public/assets/js/tinymce.config.js"></script>
<?php $this->end() ?>