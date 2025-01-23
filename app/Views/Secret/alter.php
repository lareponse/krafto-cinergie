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

<script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>

<?php $this->unshift('html_head') ?>
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
<?php $this->end() ?>

<?php $this->unshift('onLoaded') ?>
<script>
    const options_for_wysiwyg_editor = {
        modules: {
            toolbar: [
                [{
                    header: [1, 2, false]
                }],
                ['bold', 'italic', 'underline'],
                ['link', 'code-block'],
            ],
            history: {
                delay: 2000,
                maxStack: 500,
                userOnly: true
            },
        },
        placeholder: 'Compose an epic...',
        theme: 'snow', // or 'bubble'
    };

    document.querySelectorAll('.wysiwyg').forEach((el) => {
        console.log('applying quill to', el);
        const quill = new Quill(el, options_for_wysiwyg_editor);
    });
</script>
<?php $this->end() ?>