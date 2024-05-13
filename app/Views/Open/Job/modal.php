<form action="<?= $controller->router()->hyp('submission_submit') ?>" method="POST" class="form-horizontal submission-form">

    <div class="modal fade" id="modal_job" tabindex="-1" aria-labelledby="modal_job-label" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal_job-label">Nouvelle annonce</h1>
                    <button type="button" class="btn-close  btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="checkboxes-fields">

                        <fieldset>
                            <legend class="text-primary">Rémunéré *</legend>
                            <label for="remun-oui">
                                <input class="form-check-input" type="radio" name="remun" value="remun-oui" id="remun-oui" required />
                                Oui</label>

                            <label for="remun-non">
                                <input class="form-check-input" type="radio" name="remun" value="remun-non" id="remun-non" />
                                Non</label>
                        </fieldset>

                        <fieldset>

                            <legend class="text-primary">Catégorie *</legend>

                            <label>
                                <input class="form-check-input" type="radio" name="categorie" value="benevolat" id="benevolat" required />
                                Bénévolat</label>

                            <label for="casting-form">
                                <input class="form-check-input" type="radio" name="categorie" value="casting-form" id="casting-form" />
                                Casting</label>

                            <label for="divers">
                                <input class="form-check-input" type="radio" name="categorie" value="divers" id="divers" />
                                Divers</label>

                            <label for="job">
                                <input class="form-check-input" type="radio" name="categorie" value="job" id="job" />
                                Job</label>

                            <label for="stage">
                                <input class="form-check-input" type="radio" name="categorie" value="stage" id="stage" />
                                Stage</label>

                        </fieldset>

                        <fieldset>
                            <legend class="text-primary">Type *</legend>
                            <div>
                                <input class="form-check-input" type="radio" name="type" value="proposition" id="proposition" required />
                                <label for="proposition">
                                    Proposition<span>vous proposez vos services, du matériel, etc.</span></label>

                                <input class="form-check-input" type="radio" name="type" value="demande" id="demande" />
                                <label for="demande">
                                    Demande<span>vous recherchez quelqu'un ou quelque chose</span></label>
                            </div>
                        </fieldset>
                    </div>

                    <div class="free-fields">
                        <div>
                            <fieldset>
                                <label for="label" class="text-primary">Titre</label>
                                <input type="text" name="label" id="label" class="form-control" minlength="2" required>
                                <span>libellé succinct de votre annonce</span>
                            </fieldset>

                            <fieldset>
                                <label for="content" class="text-primary">Texte</label>
                                <textarea name="content" id="content" class="form-control text" minlength="3" rows="10" required></textarea>
                                <span>description complète de votre annonce</span>
                            </fieldset>
                        </div>
                        <div>
                            <fieldset>
                                <label for="identity" class="text-primary">Annonceur</label>
                                <input type="text" name="identity" id="identity" class="form-control" minlength="2" required>
                            </fieldset>

                            <fieldset>
                                <label for="phone" class="text-primary">Téléphone</label>
                                <input type="text" name="phone" id="phone" class="form-control" minlength="2" required>
                            </fieldset>

                            <fieldset>
                                <label for="email" class="text-primary">Email</label>
                                <input type="email" name="email" id="email" class="form-control" minlength="2" required>
                            </fieldset>

                            <fieldset>
                                <label for="url" class="text-primary">Site web</label>
                                <input type="text" name="url" id="url" class="form-control" minlength="2">
                            </fieldset>
                        </div>
                    </div>
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