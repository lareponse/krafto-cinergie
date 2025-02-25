<template id="template_add_job">
    <form
        action="<?= $controller->router()->hyp('submission_submit') ?>"
        method="POST"
        aria-labelledby="add_job_label"
        aria-hidden="true"
        class="shadow-box modal-box add-job">
        <header>
            <h2 id="add_job_label">Nouvelle annonce</h1>
        </header>

        <main>
            <strong>Les champs marqués <span style="color:#eb0101; font-size: 30px;"><sub>*</sub></span> sont
                obligatoires</strong>
            <?php if ($record) { ?>
                <input type="hidden" name="urn" value="<?= $record->urn() ?>">
            <?php } ?>

            <fieldset id="add_job_classified">
                <legend class="line-left">Classification</legend>

                <label for="proposition">
                    <input class="form-check-input" type="radio" name="isOffer" value="1" id="proposition" required />
                    Proposition <small>(vous proposez vos services, du matériel, etc.)</small></label>

                <label for="demande">
                    <input class="form-check-input" type="radio" name="isOffer" value="0" id="demande" />
                    Demande <small>(vous recherchez quelqu'un ou quelque chose)</small></label>

                <div>
                    <div>
                        <label for="isPaid">Rémunéré</label>
                        <select name="isPaid" id="isPaid" class="form-control" required>
                            <option value="1">Oui</option>
                            <option value="0">Non</option>
                        </select>
                    </div>
                    <div>
                        <label for="category_id">Catégorie</label>
                        <?= $this->Form()::select('category_id', $job_category, null, ['class'=>'form-control', 'required']) ?>
                    </div>
                </div>
            </fieldset>

            <fieldset id="add_job_content">
                <legend class="line-left">Annonce</legend>

                <label for="label">Titre</label>
                <input type="text" name="label" id="label" class="form-control" minlength="2" required>
                <small>libellé succinct de votre annonce</small>

                <label for="content">Annonce</label>
                <textarea name="content" id="content" class="form-control text" minlength="3" rows="10" required></textarea>
                <small>description complète de votre annonce</small>

                <div class="dates">
                    <div>

                        <label for="starts">Début</label>
                        <input type="date" name="starts" id="starts" class="form-control" required>
                    </div>
                    <div>
                        <label for="stops">Fin</label>
                        <input type="date" name="stops" id="stops" class="form-control">
                    </div>
                </div>
            </fieldset>

            <fieldset id="add_job_annonceur">
                <legend class="line-left">Annonceur</legend>
                <label for="identity">Nom</label>
                <input type="text" name="identity" id="identity" class="form-control" minlength="2" required>
                <label for="phone">Téléphone</label>
                <input type="text" name="phone" id="phone" class="form-control" minlength="2" required>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" minlength="2" required>
                <label for="url">Site web</label>
                <input type="text" name="url" id="url" class="form-control" minlength="2">
            </fieldset>
        </main>
        <footer>
            <input class="btn btn-primary btn-confirm-modal" type="submit" value="Envoyer">
            <button type="button" role="button" id="btn-cancel-modal" class="btn btn-secondary btn-cancel-modal" aria-label="Fermer la fenetre de soumission">Fermer</button>
        </footer>
    </form>
</template>