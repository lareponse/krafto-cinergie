<?php $this->layout('Open::layout') ?>

<div class="container my-5 pb-5" id="professionnel-single">
    <article class="w-75 mx-auto">

        <h1><?= $record ?></h1>
        <hr class="my-4">
        <?= $this->insert('Open::_partials/share_print', ['label' => $record->get('label')]); ?>


        <section class="row g-0 mt-4">

            <div class="col-lg-5">
                <img class="img-fluid w-100" src="<?= $record->profilePicture() ?>" alt="professionnel">
            </div>
            <div class="col-lg-7 ps-lg-5" id="infos">

                <p class="text-primary">
                    <?php
                    foreach ($praxes as $praxis) {
                        echo $this->DOM()::strong("$praxis", ['kx-gender' => $record->get('gender'), 'class' => 'd-block']);
                    }
                    ?>
                </p>

                <?= $this->insert('Open::_partials/contact_info', ['contact' => $record]); ?>
            </div>
        </section>
        <?php
        if (!empty($record->get('content'))) {
        ?>
            <section id="bio" class="my-5">
                <h2 class="pb-0">Biographie</h2>
                <hr>
                <p><?= $record->get('content') ?></p>
            </section>
        <?php
        }
        ?>

        <?= $this->insert('Open::_partials/photos', ['photos' => $related_photos]); ?>

        <?php
        if (!empty($record->get('filmography'))) {
        ?>
            <section class="my-5">
                <h2 class="pb-0">Filmographie</h2>
                <hr>
                <p><?= $record->get('filmography') ?></p>
            </section>
        <?php
        }
        ?>

        <?= $this->insert('Open::Professional/filmotheque', ['movies' => $related_movies]); ?>


        <div class="text-center mt-5">
            <a class="cta" data-bs-toggle="modal" data-bs-target="#modal-update-fiche-professionnel">
                Une erreur, une modification? Dites-le nous !
            </a>
            <!-- Modal -->
            <div class="modal fade" id="modal-update-fiche-professionnel" tabindex="-1" aria-labelledby="modal-update-fiche-professionnel-label" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modal-update-fiche-professionnel-label">Mise à jour de la fiche
                                professionnel</h1>
                            <button type="button" class="btn-close  btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-5  text-start">
                            <p>

                                → Veuillez compléter les données
                                <br>
                                → Envoyez-nous votre photo par email à l'adresse <a href="mailto:info@cinergie.be">info@cinergie.be</a>
                                <br>
                                <strong>Cinergie vous remercie de votre collaboration!</strong>
                            </p>
                            <hr>
                            <form action="" class="form-horizontal" id="update-fiche-professionnel" method="post" role="form">

                                <section class="row mb-3">
                                    <label for="nom-fiche-professionnel" class="col-sm-2 col-form-label">Nom <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="nom" name="db-nom-fiche-professionnel" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="nom officiel de votre organisation" disabled="">
                                        <input type="text" id="nom" name="nom-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="nom officiel de votre organisation" required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="date-naiss-fiche-professionnel" class="col-sm-2 col-form-label">Date de naissance
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="date" id="date-naiss" name="db-date-naiss-fiche-professionnel" value="Ancienne valeur DB" class="form-control" disabled="">
                                        <input type="date" id="date-naiss" name="date-naiss-fiche-professionnel" value="" class="form-control" required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="adresse-fiche-professionnel" class="col-sm-2 col-form-label">Adresse
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="adresse" name="db-adresse-fiche-professionnel" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="rue, numéro, boîte" disabled="">
                                        <input type="text" id="adresse" name="adresse-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="rue, numéro, boîte" required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="cp-fiche-professionnel" class="col-sm-2 col-form-label">Code postal
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="cp" name="db-cp-fiche-professionnel" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="code postal..." disabled="">
                                        <input type="text" id="cp" name="cp-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="code postal..." required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="ville-fiche-professionnel" class="col-sm-2 col-form-label">Ville
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="ville" name="db-ville-fiche-professionnel" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="localité" disabled="">
                                        <input type="text" id="ville" name="ville-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="localité" required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="province-fiche-professionnel" class="col-sm-2 col-form-label">Province
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="province" name="db-province-fiche-professionnel" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="province..." disabled="">
                                        <input type="text" id="province" name="province-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="province..." required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="pays-fiche-professionnel" class="col-sm-2 col-form-label">Pays
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="pays" name="db-pays-fiche-professionnel" value="Ancienne valeur DB" class="form-control" minlength="2" placeholder="pays..." disabled="">
                                        <input type="text" id="pays" name="pays-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="pays..." required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="telephone-fiche-professionnel" class="col-sm-2 col-form-label">Téléphone
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="telephone" name="db-telephone-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="téléphone" disabled="">
                                        <input type="text" id="telephone" name="telephone-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="téléphone" required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="fax-fiche-professionnel" class="col-sm-2 col-form-label">Fax <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="fax" name="db-fax-fiche-professionnel" value="ancienne valeur DB" class="form-control" minlength="2" placeholder="fax..." disabled="">
                                        <input type="text" id="fax" name="fax-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="fax..." required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="gsm-fiche-professionnel" class="col-sm-2 col-form-label">Gsm <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="gsm" name="db-gsm-fiche-professionnel" value="ancienne valeur DB" class="form-control" minlength="2" placeholder="numéro de gsm" disabled="">
                                        <input type="text" id="gsm" name="gsm-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="numéro de gsm" required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="email-fiche-professionnel" class="col-sm-2 col-form-label">E-mail
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="email" id="email" name="db-email-fiche-professionnel" value="ancienne valeur DB" class="form-control" minlength="2" placeholder="adresse e-mail..." disabled="">
                                        <input type="email" id="email" name="email-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="adresse e-mail..." required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="site-fiche-professionnel" class="col-sm-2 col-form-label">Site
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="site" name="db-site-fiche-professionnel" value="ancienne valeur DB" class="form-control" minlength="2" placeholder="site web..." disabled="">
                                        <input type="text" id="site" name="site-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="site web..." required="">
                                    </div>
                                </section>

                                <section class="row mb-3">
                                    <label for="commentaire-fiche-professionnel" class="col-sm-2 col-form-label">Commentaire
                                        <span>*</span></label>
                                    <div class="col-sm-10">
                                        <textarea name="db-commentaire-fiche-professionnel" id="commentaire" class="form-control" rows="3" placeholder="Ancienne valeur DB" disabled=""></textarea>
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

                            </form>
                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-primary" type="submit" name="submit-update-fiche-professionnel" value="Envoyer">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </article>
</div>