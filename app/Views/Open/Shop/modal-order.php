<!-- Modal -->
<div class="modal fade" id="modal-order" tabindex="-1" aria-labelledby="modal-nouvelle-commande-label-dvd"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="modal-nouvelle-commande-label-dvd">Nouvelle commande</h2>
                <button type="button" class="btn-close  btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <form class="form-horizontal" id="nouvelle-commande-dvd" method="post">

                    <div class="row mb-3">
                        <div class="col-sm-10 titre-nouvelle-commande row">
                            <h2 class="titrefilm modal-titre col-auto"></h2>
                            <h3 class="prix-film modal-prix col-4 align-self-end"><span> &euro;</span></h3>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="nom-commande" class="col-lg-2 col-form-label">Nom <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="nom-commande" value="" id="nom-commande" class="form-control" minlength="2" placeholder="votre nom..." required="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="prenom-commande" class="col-lg-2 col-form-label">Prénom <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="prenom-commande" value="" id="prenom-commande" class="form-control" minlength="2" placeholder="votre prénom..." required="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="telephone-commande" class="col-lg-2 col-form-label">Téléphone <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="telephone-commande" value="" id="telephone-commande" class="form-control" minlength="2" placeholder="numéro de téléphone de contact..." required="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email-commande" class="col-lg-2 col-form-label">Email <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="email" name="email-commande" value="" id="email-commande" class="form-control" minlength="2" placeholder="adresse mail de contact..." required="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="adresse-commande" class="col-lg-2 col-form-label">Adresse <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="adresse-commande" value="" id="adresse-commande" class="form-control" minlength="2" placeholder="rue, numéro, boîte" required="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="cp-commande" class="col-lg-2 col-form-label">Code postal <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="cp-commande" value="" id="cp-commande" class="form-control"  minlength="2" placeholder="code postal..." required="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="ville-commande" class="col-lg-2 col-form-label">Ville <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="ville-commande" value="" id="ville-commande" class="form-control"  minlength="2" placeholder="localité" required="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="province-commande" class="col-lg-2 col-form-label">Province
                            <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="province-commande" value="" id="province-commande" class="form-control" minlength="2" placeholder="province..." required="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="pays-commande" class="col-lg-2 col-form-label">Pays <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="pays-commande" value="" id="pays-commande" class="form-control" minlength="2" placeholder="pays..." required="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="commentaire-commande" class="col-lg-2 col-form-label">Commentaire<span>*</span></label>
                        <div class="col-lg-10">
                            <textarea name="commentaire-commande" id="commentaire-commande" class="form-control" rows="10" placeholder="commentaire sur votre commande..."></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <p class="mb-0">
                            <small>Les champs marqués<span style="color:#eb0101; font-size: 30px;"><sub>*</sub></span> sont obligatoires</small>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-primary" type="submit" name="submit-nouvelle-annonce" value="Commander">
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>