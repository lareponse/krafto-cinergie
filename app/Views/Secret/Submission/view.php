<?php
$this->layout('Secret::dashboard');
if(isset($original, $modified))
{
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
<?php
}
else
{
    if($submission->get('urn') === 'boutique'){
        $this->insert('Secret::Submission/shop', ['submission' => $submission]);
    }
    else if($submission->get('urn') === 'annonces'){
        $this->insert('Secret::Submission/job', ['submission' => $submission]);
    }
    else
    {
        ddt($submission);
    }
}