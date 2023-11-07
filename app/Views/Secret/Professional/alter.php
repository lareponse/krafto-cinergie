<?php 
$sidemenu = [
    ['#signaletiqueSection', 'identity', 'Signalétique'],
    ['#ContactSection', 'phone', 'Contact'],
    ['#AdresseSection', 'origine', 'Adresse'],
    ['#BiographieSection', 'text', 'Biographie'],
    ['#FilmographieSection', 'text', 'Filmographie'],
    ['#publicationSection', 'info', 'Publication']

];

$this->layout('Secret::alter', ['sidemenu' => $sidemenu]) 
?>

<div class="card border-0 scroll-mt-3" id="signaletiqueSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Signalétique</h2>
    </div>

    <div class="card-body">
        <?= $this->insert('Secret::Professional/edit/signaletique') ?>
    </div>
</div>


<?= $this->insert('Secret::_partials/contact/form-card', ['model' => $controller->formModel()]) ?>
<?= $this->insert('Secret::_partials/address/form-card', ['model' => $controller->formModel()]) ?>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'content', 'title' => 'Biographie', 'id' => 'BiographieSection']) ?>
<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'filmography', 'title' => 'Filmographie', 'id' => 'FilmographieSection']) ?>

<?= $this->insert('Secret::_partials/form/alter-card-publication') ?>