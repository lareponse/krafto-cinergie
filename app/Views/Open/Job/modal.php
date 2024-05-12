<form action="<?= $controller->router()->hyp('submission_submit') ?>" method="POST" class="form-horizontal submission-form">

    <div class="modal fade" id="<?= $modal_id ?? 'modal_job' ?>" tabindex="-1" aria-labelledby="modal_job-label" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal_job-label">Nouvelle annonce</h1>
                    <button type="button" class="btn-close  btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="checkboxes-field">

                        <fieldset>
                            <legend class="text-primary">Rémunéré</legend>
                            <div>

                                <input class="form-check-input" type="radio" name="remun" value="remun-oui" id="remun-oui" />
                                <label class="form-check-label" for="remun-oui">Oui</label>

                                <input class="form-check-input" type="radio" name="remun" value="remun-non" id="remun-non" />
                                <label class="form-check-label" for="remun-non">Non</label>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="text-primary">Catégorie *</legend>

                            <div>
                                <input class="form-check-input" type="radio" name="categorie" value="benevolat" id="benevolat" />
                                <label class="form-check-label" for="benevolat">Bénévolat</label>

                                <input class="form-check-input" type="radio" name="categorie" value="casting-form" id="casting-form" />
                                <label class="form-check-label" for="casting-form">Casting</label>

                                <input class="form-check-input" type="radio" name="categorie" value="divers" id="divers" />
                                <label class="form-check-label" for="divers">Divers</label>

                                <input class="form-check-input" type="radio" name="categorie" value="job" id="job" />
                                <label class="form-check-label" for="job">Job</label>

                                <input class="form-check-input" type="radio" name="categorie" value="stage" id="stage" />
                                <label class="form-check-label" for="stage">Stage</label>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="text-primary">Type *</legend>
                            <div>
                                <input class="form-check-input" type="radio" name="type" value="proposition" id="proposition" />
                                <label class="form-check-label" for="proposition">Proposition (vous proposez vos services, du matériel, etc.)</label>

                                <input class="form-check-input" type="radio" name="type" value="demande" id="demande" />
                                <label class="form-check-label" for="demande">Demande (vous recherchez quelqu'un ou quelque chose)</label>
                            </div>
                        </fieldset>
                    </div>

                    <fieldset>
                        <label for="label" class="text-primary">Titre</label>
                        <input type="text" name="label" id="label" class="form-control" minlength="2" placeholder="libellé succinct de votre annonce..." required="">
                    </fieldset>

                    <fieldset>
                        <label for="content" class="text-primary">Texte</label>
                        <textarea name="content" id="content" class="form-control text" minlength="3" placeholder="description complète de votre annonce..." required=""></textarea>
                    </fieldset>

                    <fieldset>
                        <label for="identity" class="text-primary">Annonceur</label>
                        <input type="text" name="identity" id="identity" class="form-control" minlength="2" placeholder="votre nom..." required="">
                    </fieldset>

                    <fieldset>
                        <label for="phone" class="text-primary">Téléphone</label>
                        <input type="text" name="phone" id="phone" class="form-control" minlength="2" placeholder="numéro de téléphone de contact..." required="">
                    </fieldset>

                    <fieldset>
                        <label for="email" class="text-primary">Email</label>
                        <input type="email" name="email" id="email" class="form-control" minlength="2" placeholder="adresse mail de contact..." required="">
                    </fieldset>

                    <fieldset>
                        <label for="url" class="text-primary">Site web</label>
                        <input type="text" name="url" id="url" class="form-control" minlength="2" placeholder="site web pour compléments d'information...">
                    </fieldset>

                </div>

                <div class="modal-footer">
                    <small>Les champs marqués <span style="color:#eb0101; font-size: 30px;"><sub>*</sub></span> sont
                        obligatoires</small>
                    <input class="btn btn-primary" type="submit" value="Envoyer">
                </div>
            </div>
        </div>
    </div>
</form>