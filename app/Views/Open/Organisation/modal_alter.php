<?php
$modal_reference ??= 'modal-nouvelle-organisation';
$title = empty($record) ? 'Nouvelle organisation' : 'Modifier ' . $record;
$record ??= new App\Models\Organisation();
?>

<!-- <class="form-horizontal" id="nouvelle-organisation"> -->
<form action="<?= $controller->router()->hyp('submission_submit') ?>" method="POST" class="submission-form">
    <div class="modal fade" id="<?= $modal_reference ?>" tabindex="-1" aria-labelledby="<?= $modal_reference ?>-label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
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

                    <fieldset>
                        <label for="label">Nom</label>
                        <input type="text" id="label" name="label" value="<?= $_POST['label'] ?? $record->get('label') ?? '' ?>" class="form-control" minlength="2" />
                        <label class="secret-checkbox" title="Ne pas publier sur cinergie.be">
                            &nbsp;
                        </label>
                    </fieldset>

                    <fieldset>
                        <label for="abbrev">Abbréviation</label>
                        <input type="text" id="abbrev" name="abbrev" value="<?= $_POST['abbrev'] ?? $record->get('abbrev') ?? '' ?>" class="form-control" minlength="2">
                        <label class="secret-checkbox" title="Ne pas publier sur cinergie.be">
                            &nbsp;
                        </label>
                    </fieldset>

                    <fieldset>
                        <label for="street">Adresse </label>
                        <input type="text" id="street" name="street" value="<?= $_POST['street'] ?? '' ?>" class="form-control" minlength="2" />
                        <label class="secret-checkbox" title="Ne pas publier sur cinergie.be">
                            <input type="checkbox" name="secret[street]" value="1" <?= isset($_POST['secret']['street']) ? 'checked' : '' ?>>
                            <span class="checkmark"></span>
                        </label>
                    </fieldset>

                    <fieldset>
                        <label for="zip">Code postal </label>
                        <input type="text" id="zip" name="zip" value="<?= $_POST['zip'] ?? '' ?>" class="form-control" minlength="2" />
                        <label class="secret-checkbox" title="Ne pas publier sur cinergie.be">
                            <input type="checkbox" name="secret[zip]" value="1" <?= isset($_POST['secret']['zip']) ? 'checked' : '' ?>>
                            <span class="checkmark"></span>
                        </label>
                    </fieldset>

                    <fieldset>
                        <label for="city">Ville </label>
                        <input type="text" id="city" name="city" value="<?= $_POST['city'] ?? '' ?>" class="form-control" minlength="2" />
                        <label class="secret-checkbox" title="Ne pas publier sur cinergie.be">
                            <input type="checkbox" name="secret[city]" value="1" <?= isset($_POST['secret']['city']) ? 'checked' : '' ?>>
                            <span class="checkmark"></span>
                        </label>
                    </fieldset>

                    <fieldset>
                        <label for="province">Province</label>
                        <input type="text" id="province" name="province" value="<?= $_POST['province'] ?? '' ?>" class="form-control" minlength="2" />
                        <label class="secret-checkbox" title="Ne pas publier sur cinergie.be">
                            <input type="checkbox" name="secret[province]" value="1" <?= isset($_POST['secret']['province']) ? 'checked' : '' ?>>
                            <span class="checkmark"></span>
                        </label>
                    </fieldset>

                    <fieldset>
                        <label for="country">Pays </label>
                        <input type="text" id="country" name="country" value="<?= $_POST['country'] ?? '' ?>" class="form-control" minlength="2" />
                        <label class="secret-checkbox" title="Ne pas publier sur cinergie.be">
                            <input type="checkbox" name="secret[country]" value="1" <?= isset($_POST['secret']['country']) ? 'checked' : '' ?>>
                            <span class="checkmark"></span>
                        </label>
                    </fieldset>
                    
                    <fieldset>

                        <label for="tel">Téléphone</label>
                        <input type="text" id="tel" name="tel" value="<?= $_POST['tel'] ?? '' ?>" class="form-control" minlength="2" placeholder="+32" />

                        <label class="secret-checkbox" title="Ne pas publier sur cinergie.be">
                            <input type="checkbox" name="secret[tel]" value="1" <?= isset($_POST['secret']['tel']) ? 'checked' : '' ?>>
                            <span class="checkmark"></span>
                        </label>
                    </fieldset>

                    <fieldset>
                        <label for="fax">Fax </label>
                        <input type="text" id="fax" name="fax" value="<?= $_POST['fax'] ?? '' ?>" class="form-control" minlength="2" placeholder="+32" />
                        <label class="secret-checkbox" title="Ne pas publier sur cinergie.be">
                            <input type="checkbox" name="secret[fax]" value="1" <?= isset($_POST['secret']['fax']) ? 'checked' : '' ?>>
                            <span class="checkmark"></span>
                        </label>
                    </fieldset>

                    <fieldset>
                        <label for="gsm">GSM </label>
                        <input type="text" id="gsm" name="gsm" value="<?= $_POST['gsm'] ?? '' ?>" class="form-control" minlength="2" placeholder="+32" />
                        <label class="secret-checkbox" title="Ne pas publier sur cinergie.be">
                            <input type="checkbox" name="secret[gsm]" value="1" <?= isset($_POST['secret']['gsm']) ? 'checked' : '' ?>>
                            <span class="checkmark"></span>
                        </label>
                    </fieldset>

                    <fieldset>
                        <label for="email">E-mail</label>
                        <input type="text" id="email" name="email" value="<?= $_POST['email'] ?? '' ?>" class="form-control" minlength="2" />
                        <label class="secret-checkbox" title="Ne pas publier sur cinergie.be">
                            <input type="checkbox" name="secret[email]" value="1" <?= isset($_POST['secret']['email']) ? 'checked' : '' ?>>
                            <span class="checkmark"></span>
                        </label>
                    </fieldset>

                    <fieldset>
                        <label for="url">Site </label>
                        <input type="text" id="url" name="url" value="<?= $_POST['url'] ?? '' ?>" class="form-control" minlength="2" placeholder="https://" />
                        <label class="secret-checkbox" title="Ne pas publier sur cinergie.be">
                            <input type="checkbox" name="secret[url]" value="1" <?= isset($_POST['secret']['url']) ? 'checked' : '' ?>>
                            <span class="checkmark"></span>
                        </label>
                    </fieldset>


                    <label for="commentaire">Commentaire</label>
                    <textarea name="commentaire" id="commentaire" class="form-control" rows="10" placeholder="domaine(s) d'activité, remarque et/ou demande que vous auriez concernant la fiche de votre organisation sur notre site..."></textarea>

                    </fieldset>

                    <p class="mb-0">
                        <small>Les champs marqués
                            <span style="color:#eb0101; font-size: 30px;"><sub>*</sub></span> sont
                            obligatoires</small>
                    </p>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" value="Envoyer">
                </div>
            </div>
        </div>
    </div>