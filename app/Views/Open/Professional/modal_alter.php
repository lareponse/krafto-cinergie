<?php
$modal_reference ??= 'modal-fiche-professionnel';
$title = empty($record) ? 'Nouvelle fiche professionelle' : 'Modifier ' . $record;
?>

<!-- Modal -->
<form action="<?= $controller->router()->hyp('submission_submit') ?>" method="POST" role="form">

    <div class="modal fade" id="<?= $modal_reference ?>" tabindex="-1" aria-labelledby="modal-nouvelle-fiche-professionnel-label" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content shadow-lg">
                <div class="modal-header">
                    <h1 class="modal-title p-3 fs-3" id="modal-nouvelle-fiche-professionnel-label"><?= $title ?></h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <p>
                        &rarr; Veuillez compléter les données
                        <br>
                        &rarr; Envoyez-nous votre photo par email à l'adresse <a href="mailto:info@cinergie.be">info@cinergie.be</a>
                        <br>
                        <strong>Cinergie vous remercie de votre collaboration!</strong>
                    </p>
                    <hr>
                    <section class="row mb-3">
                        <label for="nom-fiche-professionnel" class="col-lg-3 col-form-label">Nom <span>*</span></label>
                        <div class="col-lg-9">
                            <input type="text" id="nom" name="nom-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="nom officiel de votre organisation" required="">
                        </div>
                    </section>

                    <section class="row mb-3">
                        <label for="date-naiss-fiche-professionnel" class="col-lg-2 col-form-label">Date de naissance
                            <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="date" id="date-naiss" name="date-naiss-fiche-professionnel" value="" class="form-control" required="">
                        </div>
                    </section>

                    <section class="row mb-3">
                        <label for="adresse-fiche-professionnel" class="col-lg-2 col-form-label">Adresse <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" id="adresse" name="adresse-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="rue, numéro, boîte" required="">
                        </div>
                    </section>

                    <section class="row mb-3">
                        <label for="cp-fiche-professionnel" class="col-lg-2 col-form-label">Code postal <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" id="cp" name="cp-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="code postal..." required="">
                        </div>
                    </section>

                    <section class="row mb-3">
                        <label for="ville-fiche-professionnel" class="col-lg-2 col-form-label">Ville <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" id="ville" name="ville-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="localité" required="">
                        </div>
                    </section>

                    <section class="row mb-3">
                        <label for="province-fiche-professionnel" class="col-lg-2 col-form-label">Province
                            <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" id="province" name="province-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="province..." required="">
                        </div>
                    </section>

                    <section class="row mb-3">
                        <label for="pays-fiche-professionnel" class="col-lg-2 col-form-label">Pays <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" id="pays" name="pays-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="pays..." required="">
                        </div>
                    </section>

                    <section class="row mb-3">
                        <label for="telephone-fiche-professionnel" class="col-lg-2 col-form-label">Téléphone
                            <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" id="telephone" name="telephone-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="téléphone" required="">
                        </div>
                    </section>

                    <section class="row mb-3">
                        <label for="fax-fiche-professionnel" class="col-lg-2 col-form-label">Fax <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" id="fax" name="fax-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="fax..." required="">
                        </div>
                    </section>

                    <section class="row mb-3">
                        <label for="gsm-fiche-professionnel" class="col-lg-2 col-form-label">Gsm <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" id="gsm" name="gsm-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="numéro de gsm" required="">
                        </div>
                    </section>

                    <section class="row mb-3">
                        <label for="email-fiche-professionnel" class="col-lg-2 col-form-label">E-mail <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="email" id="email" name="email-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="adresse e-mail..." required="">
                        </div>
                    </section>

                    <section class="row mb-3">
                        <label for="site-fiche-professionnel" class="col-lg-2 col-form-label">Site <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" id="site" name="site-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="site web..." required="">
                        </div>
                    </section>

                    <section class="row mb-3">
                        <label for="commentaire-fiche-professionnel" class="col-lg-2 col-form-label">Commentaire
                            <span>*</span></label>
                        <div class="col-lg-10">
                            <textarea name="commentaire-fiche-professionnel" id="commentaire" class="form-control" rows="10" placeholder="détaillez vos métiers ici! indiquez une remarque et/ou demande que vous auriez concernant votre fiche professionnelle sur notre site..."></textarea>
                        </div>
                    </section>


                    <section class="row">
                        <p class="mb-0">
                            <small>Les champs marqués
                                <span style="color:#eb0101; font-size: 30px;"><sub>*</sub></span> sont
                                obligatoires</small>
                        </p>
                    </section>

                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" name="submit-nouvelle-fiche-professionnel" value="Envoyer">
                </div>
            </div>
        </div>
    </div>
    </div>