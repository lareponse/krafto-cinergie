<form class="form-horizontal" id="nouvelle-commande-dvd" method="post">
    <fieldset>
        <legend>Contact</legend>
        <div class="row mb-3">
            <div class="col-lg-6">
                <label for="nom-commande" class="col-form-label">Nom <span>*</span></label>
                <input type="text" name="nom-commande" value="" id="nom-commande" class="form-control" minlength="2" placeholder="" required="">
            </div>

            <div class="col-lg-6">
                <label for="prenom-commande" class="col-form-label">Prénom <span>*</span></label>
                <input type="text" name="prenom-commande" value="" id="prenom-commande" class="form-control" minlength="2" placeholder="" required="">
            </div>
            <div class="col-lg-4">
                <label for="telephone-commande" class="col-form-label">Téléphone <span>*</span></label>
                <input type="text" name="telephone-commande" value="" id="telephone-commande" class="form-control" minlength="2" placeholder="" required="">
            </div>

            <div class="col-lg-8">
                <label for="email-commande" class="col-form-label">Email <span>*</span></label>
                <input type="email" name="email-commande" value="" id="email-commande" class="form-control" minlength="2" placeholder="" required="">
            </div>
        </div>
    </fieldset>



    <fieldset class="mt-4">
        <legend>Expédition</legend>

        <label for="adresse-commande" class="col-form-label">Adresse <span>*</span></label>
        <input type="text" name="adresse-commande" value="" id="adresse-commande" class="form-control" minlength="2" placeholder="" required="">

        <div class="row mb-3">
            <div class="col-lg-4">
                <label for="cp-commande" class="col-form-label">Code postal <span>*</span></label>
                <input type="text" name="cp-commande" value="" id="cp-commande" class="form-control" minlength="2" placeholder="" required="">
            </div>
            <div class="col-lg-8">
                <label for="ville-commande" class="col-form-label">Ville <span>*</span></label>
                <input type="text" name="ville-commande" value="" id="ville-commande" class="form-control" minlength="2" placeholder="" required="">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-6">
                <label for="province-commande" class="col-form-label">Province <span>*</span></label>
                <input type="text" name="province-commande" value="" id="province-commande" class="form-control" minlength="2" placeholder="" required="">
            </div>

            <div class="col-lg-6">
                <label for="pays-commande" class="col-form-label">Pays <span>*</span></label>
                <input type="text" name="pays-commande" value="" id="pays-commande" class="form-control" minlength="2" placeholder="" required="">
            </div>
        </div>


    </fieldset>



    <div class="row mb-3">
        <div class="col-lg-12">
            <label for="commentaire-commande" class="col-form-label">Commentaire<span>*</span></label>
            <textarea name="commentaire-commande" id="commentaire-commande" class="form-control" rows="10" placeholder=""></textarea>
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