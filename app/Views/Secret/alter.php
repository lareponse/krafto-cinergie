<?php $this->layout('Secret::dashboard') ?>

<div class="row">
    <?php 
    $navbarPath = 'Secret::'.$controller->nid().'/alter-side';
    if ($this->engine->exists($navbarPath)){
        ?><div class="col-md-4 col-xxl-3"><?=$this->insert($navbarPath) ?></div><?php
    }
    
    ?>
    <div class="col">
        <form action="<?= $controller->router()->hyp('dash_record_save', ['nid' => $controller->nid()]);?>" method="POST" novalidate>
        <?php if ($controller->loadModel()){
            ?>
            <input type="hidden" name="id" value="<?= $controller->loadModel()->id();?>" />
            <?php
        }
        ?>

        <?=$this->section('content')?>
        </form>
        
        <?php if ($controller->loadModel()){
            echo $this->insert('Secret::deleteForm');
        }

        ?>        
    </div>
</div>

<?php $this->unshift('scripts') ?>
<script src="/public/assets/js/tinymce/tinymce.min.js"></script>
<script src="/public/assets/js/tinymce.config.js"></script>
<?php $this->end() ?>