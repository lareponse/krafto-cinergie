<form class="form-horizontal submission-form" id="nouvelle-annonce" method="post">
    <!-- Modal -->
    <div class="modal fade" id="<?= $modal_id ?? 'modal-nouvelle-annonce' ?>" tabindex="-1" aria-labelledby="modal-nouvelle-annonce-label" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal-nouvelle-annonce-label">Nouvelle annonce</h1>
                    <button type="button" class="btn-close  btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <fieldset class="mb-3">
                        <label for="type-annonce" class="h5">Rémunéré *</label>
                        <div>
                            <div>
                                <input class="form-check-input" type="radio" name="remun" value="remun-oui" id="remun-oui" />
                                <span class="control form-check-label ms-2" for="remun-oui">Oui</span>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="remun" value="remun-non" id="remun-non" />
                                <span class="control form-check-label ms-2" for="remun-non">Non</span>
                            </div>
                        </div>

                        <label for="type-annonce" class="h5">Catégorie *</label>
                        <div>
                            <div>
                                <input class="form-check-input" type="radio" name="categorie-annonce" value="benevolat" id="benevolat" />
                                <span class="control form-check-label ms-2" for="benevolat">Bénévolat</span>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="categorie-annonce" value="casting-form" id="casting-form" />
                                <span class="control form-check-label ms-2" for="casting-form">Casting</span>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="categorie-annonce" value="divers" id="divers" />
                                <span class="control form-check-label ms-2" for="divers">Divers</span>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="categorie-annonce" value="job" id="job" />
                                <span class="control form-check-label ms-2" for="job">Job</span>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="categorie-annonce" value="stage" id="stage" />
                                <span class="control form-check-label ms-2" for="stage">Stage</span>
                            </div>
                        </div>

                        <label for="type-annonce" class="h5">Type *</label>
                        <div>
                            <div>
                                <input class="form-check-input" type="radio" name="type-annonce" value="proposition" id="proposition" />
                                <span class="control form-check-label ms-2">Proposition (vous proposez vos services, du matériel, etc.)</span>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="type-annonce" value="demande" id="demande" />
                                <span class="control form-check-label ms-2">Demande (vous recherchez quelqu'un ou quelque chose)</span>
                            </div>
                        </div>

                        <label for="titre-annonce" class="h5">Titre</label>
                        <input type="text" name="titre-annonce" id="titre-annonce" class="form-control" minlength="2" placeholder="libellé succinct de votre annonce..." required="">

                        <label for="text-annonce" class="h5">Texte</label>
                        <textarea name="text-annonce" id="text-annonce" class="form-control text-annonce" minlength="3" placeholder="description complète de votre annonce..." required=""></textarea>

                        <label for="auteur-annonce" class="h5">Auteur</label>
                        <input type="text" name="auteur-annonce" id="auteur-annonce" class="form-control" minlength="2" placeholder="votre nom..." required="">

                        <label for="telephone-annonce" class="h5">Téléphone</label>
                        <input type="text" name="telephone-annonce" id="telephone-annonce" class="form-control" minlength="2" placeholder="numéro de téléphone de contact..." required="">

                        <label for="email-annonce" class="h5">Email</label>
                        <input type="email" name="email-annonce" id="email-annonce" class="form-control" minlength="2" placeholder="adresse mail de contact..." required="">

                        <label for="url-annonce" class="h5">Site web</label>
                        <input type="text" name="url-annonce" id="url-annonce" class="form-control" minlength="2" placeholder="site web pour compléments d'information...">
                    </fieldset>
                </div>

                <div class="modal-footer">
                    <small>Les champs marqués <span style="color:#eb0101; font-size: 30px;"><sub>*</sub></span> sont
                        obligatoires</small>
                    <input class="btn btn-primary" type="submit" name="submit-nouvelle-annonce" value="Envoyer">
                </div>
            </div>
        </div>
    </div>
</form>