<form class="form-horizontal" id="nouvelle-annonce" method="post">

    <div class="row mb-3">
        <p class="h5 col-xl-3 col-form-label">Rémunéré *</p>
        <div class="col-xl-9 form-check">
            <div class="d-flex">
                <input class="control_indicator form-check-input" type="radio" name="remun" value="remun-oui" id="remun-oui" />
                <label class="control form-check-label ms-2" for="remun-oui">Oui</label>
            </div>
            <div class="d-flex">
                <input class="control_indicator form-check-input" type="radio" name="remun" value="remun-non" id="remun-non" />
                <label class="control form-check-label ms-2" for="remun-non">Non</label>
            </div>
        </div>
    </div>


    <div class="row mb-3">
        <p class="h5 col-xl-3 col-form-label">Catégorie *</p>
        <div class="col-xl-9 form-check">
            <div class="d-flex">
                <input class="control_indicator form-check-input" type="radio" name="categorie-annonce" value="benevolat" id="benevolat" />
                <label class="control form-check-label ms-2" for="benevolat">Bénévolat</label>
            </div>
            <div class="d-flex">
                <input class="control_indicator form-check-input" type="radio" name="categorie-annonce" value="casting-form" id="casting-form" />
                <label class="control form-check-label ms-2" for="casting-form">Casting</label>
            </div>
            <div class="d-flex">
                <input class="control_indicator form-check-input" type="radio" name="categorie-annonce" value="divers" id="divers" />
                <label class="control form-check-label ms-2" for="divers">Divers</label>
            </div>
            <div class="d-flex">
                <input class="control_indicator form-check-input" type="radio" name="categorie-annonce" value="job" id="job" />
                <label class="control form-check-label ms-2" for="job">Job</label>
            </div>
            <div class="d-flex">
                <input class="control_indicator form-check-input" type="radio" name="categorie-annonce" value="stage" id="stage" />
                <label class="control form-check-label ms-2" for="stage">Stage</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <p class="h5 col-xl-3 col-form-label">Type *</p>
        <div class="col-xl-9 form-check">
            <div class="d-flex">
                <input class="control_indicator form-check-input" type="radio" name="type-annonce" value="proposition" id="proposition" />
                <label for="proposition" class="control form-check-label ms-2">Proposition (vous proposez vos services, du matériel, etc.)</label>
            </div>
            <div class="d-flex">
                <input class="control_indicator form-check-input" type="radio" name="type-annonce" value="demande" id="demande" />
                <label for="demande" class="control form-check-label ms-2">Demande (vous recherchez quelqu'un ou quelque chose)</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="titre-annonce" class="col-xl-3 col-form-label">Titre <span>*</span></label>
        <div class="col-xl-9">
            <input type="text" name="titre-annonce" value="titre-annonce" id="titre-annonce" class="form-control" minlength="2" placeholder="libellé succinct de votre annonce..." required="">
        </div>
    </div>

    <div class="row mb-3">
        <label for="text-annonce" class="col-xl-3 col-form-label">Texte <span>*</span></label>
        <div class="col-xl-9">
            <textarea name="text-annonce" id="text-annonce" class="form-control text-annonce" minlength="3" placeholder="description complète de votre annonce..." required=""></textarea>
        </div>
    </div>

    <div class="row mb-3">
        <label for="auteur-annonce" class="col-xl-3 col-form-label">Auteur <span>*</span></label>
        <div class="col-xl-9">
            <input type="text" name="auteur-annonce" value="auteur-annonce" id="auteur-annonce" class="form-control" minlength="2" placeholder="votre nom..." required="">
        </div>
    </div>

    <div class="row mb-3">
        <label for="telephone-annonce" class="col-xl-3 col-form-label">Téléphone <span>*</span></label>
        <div class="col-xl-9">
            <input type="text" name="telephone-annonce" value="telephone-annonce" id="telephone-annonce" class="form-control" minlength="2" placeholder="numéro de téléphone de contact..." required="">
        </div>
    </div>

    <div class="row mb-3">
        <label for="email-annonce" class="col-xl-3 col-form-label">Email <span>*</span></label>
        <div class="col-xl-9">
            <input type="email" name="email-annonce" value="email-annonce" id="email-annonce" class="form-control" minlength="2" placeholder="adresse mail de contact..." required="">
        </div>
    </div>

    <div class="row mb-3">
        <label for="url-annonce" class="col-xl-3 col-form-label">Site web</label>
        <div class="col-xl-9">
            <input type="text" name="url-annonce" value="url-annonce" id="url-annonce" class="form-control" minlength="2" placeholder="site web pour compléments d'information...">
        </div>
    </div>


    <div class="row">
        <p class="mb-0">
            <small>Les champs marqués
                <span style="color:#eb0101; font-size: 30px;"><sub>*</sub></span> sont
                obligatoires</small>
        </p>
    </div>
    <div class="modal-footer">
        <input class="btn btn-primary" type="submit" name="submit-nouvelle-annonce" value="Envoyer">
    </div>
</form>