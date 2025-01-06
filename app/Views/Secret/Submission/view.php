<?php
$this->layout('Secret::dashboard');

$modified_array = $modified->to_table_row()->export();
?>

<div class="container submission">
    <div class="row">
        <section class="col">
            <h3>Original</h3>
            <?= $this->insert('Secret::Professional/_partials/signaletique-card', ['model' => $original]) ?>
            <?= $this->insert('Secret::_partials/contact/form-card', ['model' => $original]) ?>
            <?= $this->insert('Secret::_partials/address/form-card', ['model' => $original]) ?>


        </section>

        <section class="col">
            <h3>Soumission</h3>
            <?= $this->insert('Secret::Professional/_partials/signaletique-card', ['model' => $modified]) ?>
            <?= $this->insert('Secret::_partials/contact/form-card', ['model' => $modified]) ?>
            <?= $this->insert('Secret::_partials/address/form-card', ['model' => $modified]) ?>
        </section>
    </div>
</div>