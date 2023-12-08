<?php $this->layout('Open::layout', ['title' => $page->label()]) ?>

<div class="container">

    <div class="row my-5 d-none d-sm-none d-md-none d-lg-block" id="agenda-widget">
        <?php $this->insert('Open/Event/fullcalendar'); ?>
    </div>

    <div class="row my-5" id="listing-agenda">
        <?php $this->insert('Open/Event/list'); ?>
    </div>

</div>
<?= $this->insert('Open::Event/scripts', ['current' => $current]) ?>