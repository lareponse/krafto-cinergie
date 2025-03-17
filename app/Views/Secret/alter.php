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
        <!-- <button
            data-antidoteapi_jsconnect_lanceoutil="C"
            data-antidoteapi_jsconnect_groupe_id="grp-01">
            Vérifier le texte avec Antidote
        </button> -->
        <?= $this->section('afterForm') ?>

    </div>
</div>

<?php $this->unshift('scripts') ?>
<script src="/public/assets/quill/quill.js"></script>
<script>

</script>
<?php $this->end() ?>

<?php $this->unshift('html_head') ?>
<!-- <script src="/public/assets/Antidote-API_JS-Connect-v2.2-R1-fr/Antidote-API_JS-Connect.js"></script>
<link rel="stylesheet" href="/public/assets/Antidote-API_JS-Connect-v2.2-R1-fr/Antidote-API_JS-Connect.css"> -->

<link href="/public/assets/quill/quill.snow.css" rel="stylesheet" />
<?php $this->end() ?>