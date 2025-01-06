<?php 
$sidemenu = [
    ['#signaletiqueSection', 'info', 'Signalétique'],
    ['#ContactSection', 'contact', 'Contact'],
    ['#AdresseSection', 'address', 'Adresse'],
    ['#contentSection', 'text', 'Contenu'],
    ['#FilmographieSection', 'text', 'Filmographie'],
    ['#publicationSection', 'info', 'Publication'],
    ['#LegalSection', 'address', 'Légal']
];
$this->layout('Secret::alter', ['sidemenu' => $sidemenu]) 
?>

<div class="card border-0 scroll-mt-3" id="signaletiqueSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Signalétique</h2>
    </div>

    <div class="card-body">
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="lastname" class="col-form-label">Nom</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="label" name="label" value="<?= $controller->formModel()->get('label') ?>">
            </div>
        </div>


        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="abbrev" class="col-form-label">Abbreviation</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="abbrev" name="abbrev" value="<?= $controller->formModel()->get('abbrev') ?>">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="profilePicture" class="col-form-label">Photo principale</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="profilePicture" name="profilePicture" value="<?= $controller->formModel()->profilePicturePath() ?>">
            </div>
        </div>



        <?= $this->submitDashly(); ?>

    </div>
</div>


<?= $this->insert('Secret::_partials/contact/form-card', ['model' => $controller->formModel()]) ?>

<?= $this->insert('Secret::_partials/address/form-card', ['model' => $controller->formModel()]) ?>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'content', 'title' => 'Contenu', 'id' => 'contentSection']) ?>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'filmography', 'title' => 'Filmographie', 'id' => 'FilmographieSection']) ?>

<div class="card border-0 scroll-mt-3" id="LegalSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Entreprise</h2>
    </div>

    <div class="card-body">


        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="BIC" class="col-form-label">BIC</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="BIC" name="BIC" value="<?= $controller->formModel()->get('BIC') ?>">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="IBAN" class="col-form-label">IBAN</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="IBAN" name="IBAN" value="<?= $controller->formModel()->get('IBAN') ?>">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="TVA" class="col-form-label">TVA</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="TVA" name="TVA" value="<?= $controller->formModel()->get('TVA') ?>">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="numero_entreprise" class="col-form-label">Numéro Entreprise</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="numero_entreprise" name="numero_entreprise" value="<?= $controller->formModel()->get('numero_entreprise') ?>">
            </div>
        </div>
    </div>
</div>

<?= $this->insert('Secret::_partials/form/alter-card-publication', [
    'add' => [
        'isPartner' => ['Partenaire', 'Présent dans les listes de partenaires ?']
        ]
    ]) ?>

