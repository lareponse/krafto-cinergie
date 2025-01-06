<!-- Modal -->
<template id="merchandise_order">
    
    <form
        action="<?= $controller->router()->hyp('submission_submit'); ?>"
        method="POST"
        class="submission-form shadow-box modal-box"
        id="nouvelle-commande-dvd"
        aria-labelledby="modal_order"
        aria-hidden="true">

        <header>
            <h2 id="modal_order">Nouvelle commande</h2>
        </header>

        <main>
            <strong>Les champs marqués <span style="color:#eb0101; font-size: 30px;"><sub>*</sub></span> sont obligatoires</strong>

            <h2 class="titrefilm modal-titre text-right"></h2>
            <h3 class="prix-film modal-prix text-right"></h3>

            <div>
                <strong class="h4">Comment commander?</strong>
                <p>Pour commander un DVD ou un livre, il vous suffit de remplir ce formulaire avec vos nom, prénom, adresse, numéro de téléphone, etc..</p>
                <p>Les frais d'envoi <strong>en Belgique</strong> sont de <span class="deliveryBeCost"></span>. En europe, les frais sont de <span class="deliveryCostEu"></span>.</p>
                <p>Le numéro de compte bancaire de Cinergie asbl est:&nbsp;<br> IBAN : BE10 0012 4446 1904<br>BIC : GEBABEBB</p>
            </div>

            <fieldset>
                <legend>Contact</legend>
                <label for="nom">Nom</label>
                <input type="text" name="nom" value="" id="nom" class="form-control" minlength="2" required="required">

                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" value="" id="prenom" class="form-control" minlength="2" required="required">

                <label for="telephone">Téléphone</label>
                <input type="text" name="telephone" value="" id="telephone" class="form-control" minlength="2" required="required">

                <label for="email">Email</label>
                <input type="email" name="email" value="" id="email" class="form-control" minlength="2" required="required">
            </fieldset>


            <fieldset>
                <legend>Adresse de livraison</legend>
                <label for="adresse">Adresse</label>
                <input type="text" name="adresse" value="" id="adresse" class="form-control" minlength="2" required="required">

                <label for="cp">Code postal</label>
                <input type="text" name="cp" value="" id="cp" class="form-control" minlength="2" required="required">

                <label for="ville">Ville</label>
                <input type="text" name="ville" value="" id="ville" class="form-control" minlength="2" required="required">

                <label for="province">Province</label>
                <input type="text" name="province" value="" id="province" class="form-control" minlength="2" required="required">

                <label for="pays">Pays</label>
                <input type="text" name="pays" value="" id="pays" class="form-control" minlength="2" required="required">

                <label for="commentaire">Commentaire</label>
                <textarea name="commentaire" id="commentaire" class="form-control" rows="10"></textarea>
            </fieldset>
        </main>
        <footer>
            <input class="btn btn-primary btn-confirm-modal" name="submit-nouvelle-annonce" type="submit" value="Commander">
            <button type="button" role="button" id="btn-cancel-modal" class="btn btn-secondary btn-cancel-modal" aria-label="Fermer la fenetre de soumission">Fermer</button>
        </footer>

        <script nonce="<?= $CSP_nonce ?>">
            const modal = document.getElementById('modal-order');
            const titreModal = modal.querySelector('.modal-titre');
            const prixModal = modal.querySelector('.modal-prix');
            const deliveryBeCost = modal.querySelector('.deliveryBeCost');
            const deliveryCostEu = modal.querySelector('.deliveryCostEu');

            const btnsCommander = document.querySelectorAll('.btn-commander');
            btnsCommander.forEach(btn => {
                btn.addEventListener('click', function() {
                    const titre = btn.getAttribute('data-titre');
                    const prix = btn.getAttribute('data-prix');
                    const deliveryBe = btn.getAttribute('data-delivery-be');
                    const deliveryEu = btn.getAttribute('data-delivery-eu');

                    titreModal.textContent = titre;
                    prixModal.textContent = prix + ' €';
                    deliveryBeCost.textContent = deliveryBe + ' €';
                    deliveryCostEu.textContent = deliveryEu + ' €';
                });
            });
        </script>
    </form>
</template>