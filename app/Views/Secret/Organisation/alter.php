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
                <input type="text" class="form-control" id="label" name="label" required value="<?= $controller->formModel()->get('label') ?>">
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
        <!-- <div class="row mb-4">
            <div class="col-lg-3">
                <label for="profilePicture" class="col-form-label">Photo principale</label>
            </div>

            <div class="col-lg">
                <input type="text" class="form-control" id="profilePicture" name="profilePicture" value="<?= $controller->formModel()->profilePicturePath() ?>">
            </div>
        </div> -->



        <?= $this->submitDashly(); ?>

    </div>
</div>


<?= $this->insert('Secret::_partials/contact/form-card', ['model' => $controller->formModel()]) ?>

<?= $this->insert('Secret::_partials/address/form-card', ['model' => $controller->formModel()]) ?>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'content', 'title' => 'Contenu', 'id' => 'contentSection']) ?>

<?= $this->insert('Secret::_partials/form/textarea-card', ['name' => 'filmography', 'title' => 'Filmographie', 'id' => 'FilmographieSection']) ?>


<?= $this->insert('Secret::_partials/form/alter-card-publication', [
    'add' => [
        'isPartner' => ['Partenaire', 'Présent dans les listes de partenaires ?']
    ]
]) ?>


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
                <input type="text"
                    class="form-control"
                    id="BIC"
                    name="BIC"
                    pattern="[A-Z]{6}[A-Z0-9]{2}([A-Z0-9]{3})?"
                    minlength="8"
                    maxlength="11"
                    placeholder="e.g., DEUTDEFF500"
                    title="BIC format: 8 or 11 characters (letters or numbers)"
                    value="<?= $controller->formModel()->get('BIC') ?>"
                    autocapitalize="characters">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="IBAN" class="col-form-label">IBAN</label>
            </div>

            <div class="col-lg">
                <input type="text"
                    class="form-control"
                    id="IBAN"
                    name="IBAN"
                    pattern="[A-Z]{2}[0-9]{2}[A-Z0-9]{4}[0-9]{7}([A-Z0-9]?){0,16}"
                    minlength="15"
                    maxlength="34"
                    placeholder="e.g., DE89370400440532013000"
                    title="IBAN format: 15-34 characters starting with country code"
                    value="<?= $controller->formModel()->get('IBAN') ?>"
                    autocapitalize="characters"
                    onkeyup="this.value = this.value.replace(/[^A-Z0-9]/g, '')">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="TVA" class="col-form-label">TVA</label>
            </div>

            <div class="col-lg">
                <input type="text"
                    class="form-control"
                    id="TVA"
                    name="TVA"
                    pattern="[A-Z]{2}[0-9]{2,12}"
                    minlength="4"
                    maxlength="14"
                    placeholder="e.g., FR12345678901"
                    title="VAT format: 2-letter country code followed by 2-12 numbers"
                    value="<?= $controller->formModel()->get('TVA') ?>"
                    autocapitalize="characters"
                    onkeyup="this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '')">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="numero_entreprise" class="col-form-label">Numéro Entreprise</label>
            </div>

            <div class="col-lg">
                <input type="text"
                    class="form-control"
                    id="numero_entreprise"
                    name="numero_entreprise"
                    pattern="[0-9]{10}"
                    minlength="10"
                    maxlength="10"
                    placeholder="e.g., 0123456789"
                    title="Company number format: 10 digits"
                    value="<?= $controller->formModel()->get('numero_entreprise') ?>"
                    onkeyup="this.value = this.value.replace(/[^0-9]/g, '')">
            </div>
        </div>
    </div>
</div>