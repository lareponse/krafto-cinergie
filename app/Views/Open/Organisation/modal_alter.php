<?php
$modal_reference ??= 'modal-nouvelle-organisation';

$title = $record ?? 'Nouvelle organisation';

$route_options = [];

if ($record) {
    $title = $record;
}

$action = $controller->router()->hyp('submission_submit');
?>

<!-- <class="form-horizontal" id="nouvelle-organisation"> -->
<div class="modal fade" id="<?= $modal_reference ?>" tabindex="-1" aria-labelledby="<?= $modal_reference ?>-label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <form action="<?= $action ?>" class="modal-content" method="POST">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="<?= $modal_reference ?>-label"><?= $title ?></h2>
                <button type="button" class="btn-close  btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <p>
                    &rarr; Veuillez compléter les données
                    <br>
                    &rarr; Envoyez-nous votre logo par email à l'adresse <a href="mailto:info@cinergie.be">info@cinergie.be</a>
                    <br /><strong>Cinergie vous remercie de votre collaboration!</strong>
                </p>

                <hr>

                <form action="<?= $action ?>" class="form-horizontal" id="nouvelle-organisation" method="POST">

                    <div class="row mb-3">
                        <label for="label" class="col-xl-3 col-form-label">Nom <span>*</span></label>
                        <div class="col-xl-9">
                            <input type="text" id="label" name="label" value="<?= is_null($record) ? '' : $record->get('label'); ?>" class="form-control" minlength="2" required />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="abbrev" class="col-xl-3 col-form-label">Abbréviation
                        </label>
                        <div class="col-xl-9">
                            <input type="text" id="abbrev" name="abbrev" value="<?= is_null($record) ? '' : $record->get('abbrev'); ?>" class="form-control" minlength="2">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="street" class="col-xl-3 col-form-label">Adresse </label>
                        <div class="col-xl-9">
                            <input type="text" id="street" name="street" value="<?= is_null($record) ? '' : $record->get('street'); ?>" class="form-control" minlength="2" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="zip" class="col-xl-3 col-form-label">Code postal </label>
                        <div class="col-xl-9">
                            <input type="text" id="zip" name="zip" value="<?= is_null($record) ? '' : $record->get('zip'); ?>" class="form-control" minlength="2" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="city" class="col-xl-3 col-form-label">Ville </label>
                        <div class="col-xl-9">
                            <input type="text" id="city" name="city" value="<?= is_null($record) ? '' : $record->get('city'); ?>" class="form-control" minlength="2" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="province" class="col-xl-3 col-form-label">Province
                        </label>
                        <div class="col-xl-9">
                            <input type="text" id="province" name="province" value="<?= is_null($record) ? '' : $record->get('province'); ?>" class="form-control" minlength="2" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="country" class="col-xl-3 col-form-label">Pays </label>
                        <div class="col-xl-9">
                            <input type="text" id="country" name="country" value="<?= is_null($record) ? '' : $record->get('country'); ?>" class="form-control" minlength="2" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tel" class="col-xl-3 col-form-label">Téléphone
                        </label>
                        <div class="col-xl-9">
                            <input type="text" id="tel" name="tel" value="<?= is_null($record) ? '' : $record->get('tel'); ?>" class="form-control" minlength="2" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="fax" class="col-xl-3 col-form-label">Fax </label>
                        <div class="col-xl-9">
                            <input type="text" id="fax" name="fax" value="<?= is_null($record) ? '' : $record->get('fax'); ?>" class="form-control" minlength="2" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="gsm" class="col-xl-3 col-form-label">Gsm </label>
                        <div class="col-xl-9">
                            <input type="text" id="gsm" name="gsm" value="<?= is_null($record) ? '' : $record->get('gsm'); ?>" class="form-control" minlength="2" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-xl-3 col-form-label">E-mail <span>*</span></label>
                        <div class="col-xl-9">
                            <input type="text" id="email" name="email" value="<?= is_null($record) ? '' : $record->get('email'); ?>" class="form-control" minlength="2" required />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="url" class="col-xl-3 col-form-label">Site </label>
                        <div class="col-xl-9">
                            <input type="text" id="url" name="url" value="<?= is_null($record) ? '' : $record->get('url'); ?>" class="form-control" minlength="2" placeholder="site web..." />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="commentaire" class="col-xl-3 col-form-label">Commentaire
                        </label>
                        <div class="col-xl-9">
                            <textarea name="commentaire" id="commentaire" class="form-control" rows="10" placeholder="domaine(s) d'activité, remarque et/ou demande que vous auriez concernant la fiche de votre organisation sur notre site..."></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <p class="mb-0">
                            <small>Les champs marqués
                                <span style="color:#eb0101; font-size: 30px;"><sub>*</sub></span> sont
                                obligatoires</small>
                        </p>
                    </div>
            </div>
            <div class="modal-footer">
                <input class="btn btn-primary" type="submit" value="Envoyer">
            </div>
        </form>
    </div>
</div>