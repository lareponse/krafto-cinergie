<template id="template_add_job">
    <form
        action="<?= $controller->router()->hyp('submission_submit') ?>"
        method="POST"
        aria-labelledby="modal_job-label"
        aria-hidden="true"
        class="shadow-box add-job">
        <header>
            <h2 id="modal_job-label">Nouvelle annonce</h1>
        </header>

        <main>
            <strong>Les champs marqués <span style="color:#eb0101; font-size: 30px;"><sub>*</sub></span> sont
                obligatoires</strong>
            <?php if ($record) { ?>
                <input type="hidden" name="urn" value="<?= $record->urn() ?>">
            <?php } ?>
            <fieldset>
                <legend class="text-primary">Type *</legend>
                <label for="proposition">
                    <input class="form-check-input" type="radio" name="type" value="proposition" id="proposition" required />
                    Proposition <small>(vous proposez vos services, du matériel, etc.)</small></label>

                <label for="demande">
                    <input class="form-check-input" type="radio" name="type" value="demande" id="demande" />
                    Demande <small>(vous recherchez quelqu'un ou quelque chose)</small></label>
            </fieldset>
            </div>

            <div class="free-fields">
                <div>
                    <fieldset>
                        <label for="label" class="text-primary">Titre</label>
                        <input type="text" name="label" id="label" class="form-control" minlength="2" required>
                        <small>libellé succinct de votre annonce</small>
                    </fieldset>

                    <fieldset>
                        <label for="content" class="text-primary">Texte</label>
                        <textarea name="content" id="content" class="form-control text" minlength="3" rows="10" required></textarea>
                        <small>description complète de votre annonce</small>
                    </fieldset>
                </div>
                <div>
                    <fieldset>
                        <legend class="text-primary">Rémunéré *</legend>
                        <label for="remun-oui">
                            <input class="form-check-input" type="radio" name="remun" value="remun-oui" id="remun-oui" required />
                            Oui</label>

                        <label for="remun-non">
                            <input class="form-check-input" type="radio" name="remun" value="remun-non" id="remun-non" />
                            Non</label>
                    </fieldset>

                    <fieldset class="d-flex flex-column">
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
        </main>
        <footer>
            <input class="btn btn-primary btn-confirm-modal" type="submit" value="Envoyer">
            <button type="button" role="button" id="btn-cancel-modal" class="btn btn-secondary btn-cancel-modal" aria-label="Fermer la fenetre de soumission">Fermer</button>
        </footer>
    </form>
</template>