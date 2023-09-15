<form action="<?= $controller->router()->hyp('organisation_add') ?>" class="form-horizontal" id="nouvelle-organisation" method="POST" role="form">
    <section class="row mb-3">
        <label for="nom-organisation" class="col-sm-2 col-form-label">Nom <span>*</span></label>
        <div class="col-sm-10">
            <input type="text" id="nom" name="nom-organisation" value="" class="form-control" minlength="2" placeholder="nom officiel de votre organisation" required="">
        </div>
    </section>

    <section class="row mb-3">
        <label for="abbreviation-organisation" class="col-sm-2 col-form-label">Abbréviation
            <span>*</span></label>
        <div class="col-sm-10">
            <input type="text" id="abbreviation" name="abbreviation-organisation" value="" class="form-control" minlength="2" placeholder="accronyme, autre nom, ..." required="">
        </div>
    </section>

    <section class="row mb-3">
        <label for="adresse-organisation" class="col-sm-2 col-form-label">Adresse <span>*</span></label>
        <div class="col-sm-10">
            <input type="text" id="adresse" name="adresse-organisation" value="" class="form-control" minlength="2" placeholder="rue, numéro, boîte" required="">
        </div>
    </section>

    <section class="row mb-3">
        <label for="cp-organisation" class="col-sm-2 col-form-label">Code postal <span>*</span></label>
        <div class="col-sm-10">
            <input type="text" id="cp" name="cp-organisation" value="" class="form-control" minlength="2" placeholder="code postal..." required="">
        </div>
    </section>

    <section class="row mb-3">
        <label for="ville-organisation" class="col-sm-2 col-form-label">Ville <span>*</span></label>
        <div class="col-sm-10">
            <input type="text" id="ville" name="ville-organisation" value="" class="form-control" minlength="2" placeholder="localité" required="">
        </div>
    </section>

    <section class="row mb-3">
        <label for="province-organisation" class="col-sm-2 col-form-label">Province
            <span>*</span></label>
        <div class="col-sm-10">
            <input type="text" id="province" name="province-organisation" value="" class="form-control" minlength="2" placeholder="province..." required="">
        </div>
    </section>

    <section class="row mb-3">
        <label for="pays-organisation" class="col-sm-2 col-form-label">Pays <span>*</span></label>
        <div class="col-sm-10">
            <input type="text" id="pays" name="pays-organisation" value="" class="form-control" minlength="2" placeholder="pays..." required="">
        </div>
    </section>

    <section class="row mb-3">
        <label for="telephone-organisation" class="col-sm-2 col-form-label">Téléphone
            <span>*</span></label>
        <div class="col-sm-10">
            <input type="text" id="telephone" name="telephone-organisation" value="" class="form-control" minlength="2" placeholder="téléphone" required="">
        </div>
    </section>

    <section class="row mb-3">
        <label for="fax-organisation" class="col-sm-2 col-form-label">Fax <span>*</span></label>
        <div class="col-sm-10">
            <input type="text" id="fax" name="fax-organisation" value="" class="form-control" minlength="2" placeholder="fax..." required="">
        </div>
    </section>

    <section class="row mb-3">
        <label for="gsm-organisation" class="col-sm-2 col-form-label">Gsm <span>*</span></label>
        <div class="col-sm-10">
            <input type="text" id="gsm" name="gsm-organisation" value="" class="form-control" minlength="2" placeholder="numéro de gsm" required="">
        </div>
    </section>

    <section class="row mb-3">
        <label for="email-organisation" class="col-sm-2 col-form-label">E-mail <span>*</span></label>
        <div class="col-sm-10">
            <input type="email" id="email" name="email-organisation" value="" class="form-control" minlength="2" placeholder="adresse e-mail..." required="">
        </div>
    </section>

    <section class="row mb-3">
        <label for="site-organisation" class="col-sm-2 col-form-label">Site <span>*</span></label>
        <div class="col-sm-10">
            <input type="text" id="site" name="site-organisation" value="" class="form-control" minlength="2" placeholder="site web..." required="">
        </div>
    </section>

    <section class="row mb-3">
        <label for="commentaire-organisation" class="col-sm-2 col-form-label">Commentaire
            <span>*</span></label>
        <div class="col-sm-10">
            <textarea name="commentaire-organisation" id="commentaire" class="form-control" rows="10" placeholder="domaine(s) d'activité, remarque et/ou demande que vous auriez concernant la fiche de votre organisation sur notre site..."></textarea>
        </div>
    </section>


    <section class="row">
        <p class="mb-0">
            <small>Les champs marqués
                <span style="color:#eb0101; font-size: 30px;"><sub>*</sub></span> sont
                obligatoires</small>
        </p>
    </section>
</form>