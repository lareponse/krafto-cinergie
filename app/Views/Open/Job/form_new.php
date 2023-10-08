<form action="" class="form-horizontal" id="nouvelle-annonce" method="POST" role="form">

    <section class="row mb-3">
        <label for="remunere" class="col-sm-2 col-form-label">Rémunéré? <span>*</span></label>
        <div class="col-sm-10">
            <div class="d-flex">
                <input type="radio" id="remun-oui" name="remunere" value="job_paid">
                <span class="ms-2 text-lable">Oui</span>
            </div>
            <div class="d-flex">
                <input type="radio" id="remun-non" name="remunere" value="job_free">
                <span class="ms-2 text-lable">Non</span>
            </div>
        </div>
    </section>


    <section class="row mb-3">
        <label for="categorie-annonce" class="col-sm-2 col-form-label">Catégorie <span>*</span></label>
        <div class="col-sm-10">
            <div class="d-flex">
                <input type="radio" id="categorie-annonce" name="categorie-annonce" value="benevolat">
                <span class="ms-2 text-lable">Bénévolat</span>
            </div>
            <div class="d-flex">
                <input type="radio" id="categorie-annonce" name="categorie-annonce" value="castin g"><span class="ms-2 text-lable">Casting</span>
            </div>
            <div class="d-flex">
                <input type="radio" id="categorie-annonce" name="categorie-annonce" value="divers">
                <span class="ms-2 text-lable">Divers</span>
            </div>
            <div class="d-flex">
                <input type="radio" id="categorie-annonce" name="categorie-annonce" value="job"><span class="ms-2 text-lable">Job</span>
            </div>
            <div class="d-flex">
                <input type="radio" id="categorie-annonce" name="categorie-annonce" value="stage">
                <span class="ms-2 text-lable">Stage</span>
            </div>
        </div>
    </section>

    <section class="row mb-3">
        <label for="type-annonce" class="col-sm-2 col-form-label">Type <span>*</span></label>
        <div class="col-sm-10">
            <div class="d-flex">
                <input type="radio" id="type-annonce" name="type-annonce" value="proposition">
                <span class="ms-2 text-lable">Proposition (vous proposez vos services, du matériel, etc.)</span>
            </div>
            <div class="d-flex">
                <input type="radio" id="type-annonce" name="type-annonce" value="demande">
                <span class="ms-2 text-lable">Demande (vous recherchez quelqu'un ou quelque chose)</span>
            </div>
        </div>
    </section>

    <section class="row mb-3">
        <label for="titre-annonce" class="col-sm-2 col-form-label">Titre <span>*</span></label>
        <div class="col-sm-10">
            <input type="text" id="titre" name="titre-annonce" value="" class="form-control" minlength="2" placeholder="libellé succinct de votre annonce..." required="">
        </div>
    </section>

    <section class="row mb-3">
        <label for="text-annonce" class="col-sm-2 col-form-label">Texte <span>*</span></label>
        <div class="col-sm-10">
            <textarea id="texte" name="text-annonce" class="form-control text-annonce" minlength="3" placeholder="description complète de votre annonce..." required=""></textarea>
        </div>
    </section>

    <section class="row mb-3">
        <label for="auteur-annonce" class="col-sm-2 col-form-label">Auteur <span>*</span></label>
        <div class="col-sm-10">
            <input type="text" id="auteur" name="auteur-annonce" value="" class="form-control" minlength="2" placeholder="votre nom..." required="">
        </div>
    </section>

    <section class="row mb-3">
        <label for="telephone-annonce" class="col-sm-2 col-form-label">Téléphone <span>*</span></label>
        <div class="col-sm-10">
            <input type="text" id="tel" name="telephone-annonce" value="" class="form-control" minlength="2" placeholder="numéro de téléphone de contact..." required="">
        </div>
    </section>

    <section class="row mb-3">
        <label for="email-annonce" class="col-sm-2 col-form-label">Email <span>*</span></label>
        <div class="col-sm-10">
            <input type="email" id="email" name="email-annonce" value="" class="form-control" minlength="2" placeholder="adresse mail de contact..." required="">
        </div>
    </section>

    <section class="row mb-3">
        <label for="url-annonce" class="col-sm-2 col-form-label">Site web</label>
        <div class="col-sm-10">
            <input type="text" id="url" name="url-annonce" value="" class="form-control" minlength="2" placeholder="site web pour compléments d'information...">
        </div>
    </section>


    <section class="row">
        <p class="mb-0">
            <small>Les champs marqués <span style="color:#eb0101; font-size: 30px;"><sub>*</sub></span> sont obligatoires</small>
        </p>
    </section>
</form>