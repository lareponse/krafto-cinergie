<?php
$this->layout('Open::layout', ['title' => $page->label()])
?>

<div class="container my-5 pb-5" id="prix">

    <div class="row">
        <section class="row g-0 mb-5 col-lg-8 order-1 align-items-start">
            <div class="col-lg bg-light p-4 p-lg-5 text-justify">
                <?= $page->get('abstract'); ?>
            </div>
        </section>

        <aside id="meta" class="d-none d-sm-block col-lg-3 mb-5 order-3 order-sm-3 order-md-3 order-lg-2 offset-lg-1 shadow">
                <?= $this->insert('Open::_partials/share_print', ['class' => 'tiny', 'label' => $page->label()]); ?>
        </aside>

        <section class="w-75 mb-5 order-2 order-sm-2 order-md-2 order-lg-3 mx-auto text-justify">

            <?php echo $page->get('content'); ?>
            <?= $this->insert('Open::_partials/share_print', ['label' => $page->get('label')]); ?>

        </section>
    </div>
</div>