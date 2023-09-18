<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout') ?>

<div class="container my-5 pb-5" id="organisation-single">
    <article class="w-75 mx-auto">

        <h1><?= $record ?></h1>
        <hr class="my-4">

        <div class="share" id="share">
            <span>Partager sur</span>
            <span class="socials">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="mx-1 bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-envelope-fill"></i></a>
            </span>
        </div>


        <section class="row g-0 mt-4">

            <div class="col-lg-5 col-md-4">
                <img class="img-fluid w-100" src="<?= $record->profilePicture() ?>" alt="organisation">
            </div>

            <div class="col-lg-7 ps-lg-5 col-md-8" id="infos">
                <p class="text-primary"><strong><?= implode(', ', $praxes); ?></strong></p>
                <?= $this->insert('Open::_partials/contact_info', ['contact' => $record]); ?>
            </div>

        </section>

        <?php
        if (!empty($record->get('content'))) {
        ?>
            <section id="bio" class="my-5">
                <h2 class="pb-0">Présentation</h2>
                <hr>
                <p><?= $record->get('content') ?></p>
            </section>
        <?php
        }
        ?>

        <?= $this->insert('Open::_partials/photos', ['photos' => $related_photos]); ?>

        <?= $this->insert('Open::Professional/filmotheque', ['movies' => $related_movies]); ?>
    </article>


    <div class="text-center">
        <a class="cta" data-bs-toggle="modal" data-bs-target="#modal-update-organisation">
            Une erreur, une modification? Dites-le nous !
        </a>
        <!-- Modal -->
        <div class="modal fade" id="modal-update-organisation" tabindex="-1" aria-labelledby="modal-update-organisation-label" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal-update-organisation-label">Mise à jour de la fiche
                            organisation</h1>
                        <button type="button" class="btn-close  btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-5 text-start">
                        <p>

                            → Veuillez compléter les données
                            <br>
                            → Envoyez-nous votre logo par email à l'adresse <a href="mailto:info@cinergie.be">info@cinergie.be</a>
                            <br>
                            <strong>Cinergie vous remercie de votre collaboration!</strong>
                        </p>
                        <hr>
                        <form action="" class="form-horizontal" id="update-organisation" method="post" role="form">

                            <section class="row mb-3">
                                <label for="nom-organisation" class="col-sm-2 col-form-label">Nom <span>*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="nom" name="db-nom-organisation" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="nom officiel de votre organisation" disabled="">
                                    <input type="text" id="nom" name="nom-organisation" value="" class="form-control" minlength="2" placeholder="nom officiel de votre organisation" required="">
                                </div>
                            </section>

                            <section class="row mb-3">
                                <label for="abbreviation-organisation" class="col-sm-2 col-form-label">Abbréviation
                                    <span>*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="abbreviation" name="db-abbreviation-organisation" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="accronyme, autre nom, ..." disabled="">
                                    <input type="text" id="abbreviation" name="abbreviation-organisation" value="" class="form-control" minlength="2" placeholder="accronyme, autre nom, ..." required="">
                                </div>
                            </section>

                            <section class="row mb-3">
                                <label for="adresse-organisation" class="col-sm-2 col-form-label">Adresse
                                    <span>*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="adresse" name="db-adresse-organisation" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="rue, numéro, boîte" disabled="">
                                    <input type="text" id="adresse" name="adresse-organisation" value="" class="form-control" minlength="2" placeholder="rue, numéro, boîte" required="">
                                </div>
                            </section>

                            <section class="row mb-3">
                                <label for="cp-organisation" class="col-sm-2 col-form-label">Code postal
                                    <span>*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="cp" name="db-cp-organisation" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="code postal..." disabled="">
                                    <input type="text" id="cp" name="cp-organisation" value="" class="form-control" minlength="2" placeholder="code postal..." required="">
                                </div>
                            </section>

                            <section class="row mb-3">
                                <label for="ville-organisation" class="col-sm-2 col-form-label">Ville
                                    <span>*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="ville" name="db-ville-organisation" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="localité" disabled="">
                                    <input type="text" id="ville" name="ville-organisation" value="" class="form-control" minlength="2" placeholder="localité" required="">
                                </div>
                            </section>

                            <section class="row mb-3">
                                <label for="province-organisation" class="col-sm-2 col-form-label">Province
                                    <span>*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="province" name="db-province-organisation" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="province..." disabled="">
                                    <input type="text" id="province" name="province-organisation" value="" class="form-control" minlength="2" placeholder="province..." required="">
                                </div>
                            </section>

                            <section class="row mb-3">
                                <label for="pays-organisation" class="col-sm-2 col-form-label">Pays
                                    <span>*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="pays" name="db-pays-organisation" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="pays..." disabled="">
                                    <input type="text" id="pays" name="pays-organisation" value="" class="form-control" minlength="2" placeholder="pays..." required="">
                                </div>
                            </section>

                            <section class="row mb-3">
                                <label for="telephone-organisation" class="col-sm-2 col-form-label">Téléphone
                                    <span>*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="telephone" name="db-telephone-organisation" value="" class="form-control" minlength="2" placeholder="téléphone" disabled="">
                                    <input type="text" id="telephone" name="telephone-organisation" value="" class="form-control" minlength="2" placeholder="téléphone" required="">
                                </div>
                            </section>

                            <section class="row mb-3">
                                <label for="fax-organisation" class="col-sm-2 col-form-label">Fax <span>*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="fax" name="db-fax-organisation" value="ancienne valeur DB" class="form-control" minlength="2" placeholder="fax..." disabled="">
                                    <input type="text" id="fax" name="fax-organisation" value="" class="form-control" minlength="2" placeholder="fax..." required="">
                                </div>
                            </section>

                            <section class="row mb-3">
                                <label for="gsm-organisation" class="col-sm-2 col-form-label">Gsm <span>*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="gsm" name="db-gsm-organisation" value="ancienne valeur DB" class="form-control" minlength="2" placeholder="numéro de gsm" disabled="">
                                    <input type="text" id="gsm" name="gsm-organisation" value="" class="form-control" minlength="2" placeholder="numéro de gsm" required="">
                                </div>
                            </section>

                            <section class="row mb-3">
                                <label for="email-organisation" class="col-sm-2 col-form-label">E-mail
                                    <span>*</span></label>
                                <div class="col-sm-10">
                                    <input type="email" id="email" name="db-email-organisation" value="ancienne valeur DB" class="form-control" minlength="2" placeholder="adresse e-mail..." disabled="">
                                    <input type="email" id="email" name="email-organisation" value="" class="form-control" minlength="2" placeholder="adresse e-mail..." required="">
                                </div>
                            </section>

                            <section class="row mb-3">
                                <label for="site-organisation" class="col-sm-2 col-form-label">Site
                                    <span>*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="site" name="db-site-organisation" value="ancienne valeur DB" class="form-control" minlength="2" placeholder="site web..." disabled="">
                                    <input type="text" id="site" name="site-organisation" value="" class="form-control" minlength="2" placeholder="site web..." required="">
                                </div>
                            </section>

                            <section class="row mb-3">
                                <label for="commentaire-organisation" class="col-sm-2 col-form-label">Commentaire
                                    <span>*</span></label>
                                <div class="col-sm-10">
                                    <textarea name="db-commentaire-organisation" id="commentaire" class="form-control" rows="3" placeholder="Ancienne valeur DB" disabled=""></textarea>
                                    <textarea name="commentaire-organisation" id="commentaire" class="form-control" rows="10" placeholder="domaine(s) d'activité, remarque et/ou demande que vous auriez concernant la fiche de votre organisation sur notre site..."></textarea>
                                </div>
                            </section>


                            <section class="row">
                                <p class="mb-0">
                                    <small>Les champs marqués
                                        <span style="color:#eb0101; font-size: 30px;"><sub>*</sub></span> sont
                                        obligatoires</small>
                                </p>
                            </section>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-primary" type="submit" name="submit-update-organisation" value="Envoyer">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>