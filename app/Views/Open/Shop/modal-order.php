<template id="template_korbo">
<form id="korbo" class="shadow-box modal-box" role="dialog" aria-labelledby="korbo-title" aria-describedby="korbo-description" aria-hidden="true">
    <header>
        <h2>Votre panier</h2>
    </header>
    <main>
        <div id="korbo-container"><!-- JS --></div>

        <h2 class="line-left">Comment commander?</h2>
        <p>Pour commander un DVD ou un livre, il vous suffit de remplir ce formulaire avec vos nom, prénom, adresse, numéro de téléphone, etc..</p>
        <div class="bank">
            <span>Le numéro de compte bancaire de Cinergie asbl est</span>
            <span>IBAN :</span>
            <span>BE10 0012 4446 1904</span>
            <span>BIC :</span>
            <span> GEBABEBB</span>
        </div>


        <fieldset>
            <legend class="line-left">Contact</legend>
            <label for="nom">Nom</label>
            <input type="text" name="nom" value="" id="nom" class="form-control" minlength="2" required="required">

            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" value="" id="prenom" class="form-control" minlength="2" required="required">

            <label for="telephone">Téléphone</label>
            <input type="text" name="telephone" value="" id="telephone" class="form-control" minlength="2" required="required">

            <label for="email">Email</label>
            <input type="email" name="email" value="" id="email" class="form-control" minlength="2" required="required">
        </fieldset>

        <fieldset id="korbo_delivery">
            <legend class="line-left">Adresse de livraison</legend>
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" value="" id="adresse" class="form-control" minlength="2" required="required">

            <div>
                <div>
                    <label for="cp">Code postal</label>
                    <input type="text" name="cp" value="" id="cp" class="form-control" minlength="2" required="required">
                </div>
                <div>
                    <label for="ville">Ville</label>
                    <input type="text" name="ville" value="" id="ville" class="form-control" minlength="2" required="required">
                </div>
            </div>
            <div>
                <div>
                    <label for="province">Province</label>
                    <input type="text" name="province" value="" id="province" class="form-control" minlength="2" required="required">
                </div>
                <div>
                    <label for="pays">Pays</label>
                    <input type="text" name="pays" value="" id="pays" class="form-control" minlength="2" required="required">
                </div>
            </div>

            <label for="commentaire">Commentaire</label>
            <textarea name="commentaire" id="commentaire" class="form-control" rows="10"></textarea>
        </fieldset>
    </main>
    <footer>
        <button type="submit" role="submit" class="btn btn-primary btn-confirm-modal" name="submit-nouvelle-annonce">Commander</button>
        <button type="button" role="button" class="btn btn-outline-primary btn-reset-modal" aria-label="Fermer la fenetre de soumission">Vider</button>
        <button type="button" role="button" class="btn btn-secondary btn-cancel-modal" aria-label="Fermer la fenetre de soumission">Fermer</button>
    </footer>


    <script type="module" nonce="<?= $CSP_nonce ?>">
        import Korbo from '/public/assets/js/korbo.js';
        let k = new Korbo('#korbo-container', '#template_korbo_item');
    </script>
</form>
</template>

<template id="template_korbo_item">
    <article class="korbo-item" data-item-id="-1">
        <div data-kx-id="title"></div>
        <div>
            <span data-kx-id="price" class="currency"></span><small> +
                <span data-kx-id="delivery" class="currency"></span> de frais d'envoi</small>
        </div>
        <input data-kx-id="quantity" type="number" name="quantity" value="1" min="1" />
        <div data-kx-id="total" class="currency"></div>
        <button type="button" class="btn btn-danger" aria-label="Supprimer cet article">Supprimer</button>
    </article>
</template>