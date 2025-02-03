<?php

$sidemenu = [
    ['#signaletiqueSection', 'info', 'Signalétique'],
    ['#loginSection', 'info', 'Login'],
];

$this->layout('Secret::alter', ['sidemenu' => $sidemenu, 'controller' => $controller]);
?>

<div class="card border-0 scroll-mt-3" id="signaletiqueSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Signalétique</h2>
    </div>

    <div class="card-body">
        <?php
        $fields = [
            'name' => 'Nom',
            'email' => 'Email',
            'home' => 'Accueil',
            'phone' => 'Téléphone',
            'language_code' => 'Code de langue',
            'note' => 'Note',
        ];
        foreach ($fields as $field => $label) {
        ?>
            <div class="row mb-4">
                <div class="col-lg-3">
                    <label for="<?= $field ?>" class="col-form-label"><?= $label ?></label>
                </div>
                <div class="col-lg">
                    <input type="text" class="form-control" id="<?= $field ?>" name="<?= $field ?>" value="<?= $controller->formModel()->get($field) ?>">
                </div>
            </div>

        <?php
        }


        ?>


        <?= $this->submitDashly(); ?>
    </div>
</div>

<div class="card border-0 scroll-mt-3" id="loginSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Login</h2>
    </div>

    <div class="card-body">
        <?php
        $label = 'Login';
        $field = 'username';
        ?>
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="<?= $field ?>" class="col-form-label"><?= $label ?></label>
            </div>
            <div class="col-lg">
                <input type="text" class="form-control" id="<?= $field ?>" name="<?= $field ?>" value="<?= $controller->formModel()->get($field) ?>">
            </div>
        </div>

        <?php
        $label = 'Mot de passe';
        $field = 'password';
        ?>
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="<?= $field ?>" class="col-form-label"><?= $label ?></label>
            </div>
            <div class="col-lg">
                <input type="text" class="form-control" id="<?= $field ?>" name="<?= $field ?>" value="">
            </div>
        </div>

        <?php

        $label = 'Actif';
        $name = 'active';
        $description = 'L\'opérateur peut se connecter';
        ?>
        <div class="row mb-4">
            <div class="col-lg-3">
                <label for="publication-form-<?= $name ?>" class="col-form-label"><?= $label ?></label>
            </div>
            <div class="col-lg">
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" role="switch" id="publication-form-<?= $name ?>" name="<?= $name ?>" <?= $controller->formModel()->get($name) ? 'checked="checked"' : '' ?>">
                    <span class="d-block small text-muted mb-0"><?= $description ?></spân>
                </div>
            </div>
        </div>
        <?= $this->submitDashly(); ?>
    </div>

</div>