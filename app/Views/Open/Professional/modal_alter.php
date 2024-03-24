<?php
$modal_reference ??= 'modal-fiche-professionnel';
$title = empty($record) ? 'Nouvelle fiche professionelle' : 'Modifier ' . $record;
?>

<!-- Modal -->
<form action="<?= $controller->router()->hyp('submission_submit') ?>" method="POST" role="form" class="submission-form">
    <div class="modal fade" id="<?= $modal_reference ?>" tabindex="-1" aria-labelledby="modal-nouvelle-fiche-professionnel-label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content shadow-lg">
                <div class="modal-header">
                    <h1 class="modal-title p-3 fs-3" id="modal-nouvelle-fiche-professionnel-label"><?= $title ?></h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <p>
                        &rarr; Veuillez compléter les données
                        <br>
                        &rarr; Envoyez-nous votre photo par email à l'adresse <a href="mailto:info@cinergie.be">info@cinergie.be</a>
                        <br>
                        <strong>Cinergie vous remercie de votre collaboration!</strong>
                    </p>
                    <hr>
                    <fieldset>
                        <label for="nom-fiche-professionnel">Nom</label>
                        <input type="text" id="nom" name="nom-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="nom officiel de votre organisation" required="">

                        <label for="date-naiss-fiche-professionnel">Date de naissance</label>
                        <input type="date" id="date-naiss" name="date-naiss-fiche-professionnel" value="" class="form-control" required="">

                        <label for="adresse-fiche-professionnel">Adresse</label>
                        <input type="text" id="adresse" name="adresse-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="rue, numéro, boîte" required="">

                        <label for="cp-fiche-professionnel">Code postal</label>
                        <input type="text" id="cp" name="cp-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="code postal..." required="">

                        <label for="ville-fiche-professionnel">Ville</label>
                        <input type="text" id="ville" name="ville-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="localité" required="">

                        <label for="province-fiche-professionnel">Province</label>
                        <input type="text" id="province" name="province-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="province..." required="">

                        <label for="pays-fiche-professionnel">Pays</label>
                        <input type="text" id="pays" name="pays-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="pays..." required="">

                        <label for="telephone-fiche-professionnel">Téléphone</label>
                        <input type="text" id="telephone" name="telephone-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="téléphone" required="">

                        <label for="fax-fiche-professionnel">Fax</label>
                        <input type="text" id="fax" name="fax-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="fax..." required="">

                        <label for="gsm-fiche-professionnel">Gsm</label>
                        <input type="text" id="gsm" name="gsm-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="numéro de gsm" required="">

                        <label for="email-fiche-professionnel">E-mail</label>
                        <input type="email" id="email" name="email-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="adresse e-mail..." required="">

                        <label for="site-fiche-professionnel">Site</label>
                        <input type="text" id="site" name="site-fiche-professionnel" value="" class="form-control" minlength="2" placeholder="site web..." required="">
                        
                        <label for="commentaire-fiche-professionnel">Commentaire</label>
                        <textarea name="commentaire-fiche-professionnel" id="commentaire" class="form-control" rows="10" placeholder="détaillez vos métiers ici! indiquez une remarque et/ou demande que vous auriez concernant votre fiche professionnelle sur notre site..."></textarea>

                    </fieldset>

                    <p class="mb-0">
                        <small>Les champs marqués
                            <span style="color:#eb0101; font-size: 30px;"><sub>*</sub></span> sont
                            obligatoires</small>
                    </p>

                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" name="submit-nouvelle-fiche-professionnel" value="Envoyer">
                </div>
            </div>
        </div>
    </div>
    </div>