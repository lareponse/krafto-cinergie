<?php $this->layout('Secret::dashboard'); ?>

<?= $this->insert('Secret::'.$controller->className().'/view/header');?>
<?=$this->section('content')?>

<?php $this->unshift('scripts') ?>
<script>
    let deleteIcon = '<?= $this->icon('delete') ?>';
</script>
<script src="/public/assets/js/otto-link.js"></script>
<?php $this->end() ?>