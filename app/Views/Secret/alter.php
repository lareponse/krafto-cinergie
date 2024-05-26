<?php $this->layout('Secret::dashboard') ?>

<div class="row mb-7">
    <?php
    if (!empty($sidemenu) && !empty($controller))
    ?><div class="col-md-4 col-xxl-3">
        <?= $this->insert('Secret::_partials/alter-side', ['sidemenu' => $sidemenu, 'controller' => $controller]);
        ?></div><?php

                ?>
    <div class="col">
        <?= $this->section('beforeForm') ?>

        <form action="<?= $controller->router()->hyp('dash_record_save', ['nid' => $controller->nid()]); ?>" method="POST" novalidate>
            <?php if ($controller->loadModel()) {
            ?>
                <input type="hidden" name="id" value="<?= $controller->loadModel()->id(); ?>" />
            <?php
            }
            ?>

            <?= $this->section('content') ?>

        </form>
        <?= $this->section('afterForm') ?>

    </div>
</div>


<?php $this->unshift('scripts') ?>

<!-- Include the Quill library -->
<script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.core.js"></script>

<!-- Initialize Quill editor -->
<script>
    document.querySelectorAll('.tinymce').forEach((el) => {
        const quill = new Quill(el, {
            theme: "snow",
        });
    });


</script>

<?php $this->end() ?>