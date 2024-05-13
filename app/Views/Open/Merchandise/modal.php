<!-- Modal -->
<form class="submission-form" id="nouvelle-commande-dvd" method="POST" action="<?= $controller->router()->hyp('submission_submit');?>">

    <div class="modal fade" id="modal-order" tabindex="-1" aria-labelledby="modal_order" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="modal_order">Nouvelle commande</h2>
                    <button type="button" class="btn-close  btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <h2 class="titrefilm modal-titre text-right"></h2>
                    <h3 class="prix-film modal-prix text-right"></h3>
                    
                    <div>
                        <strong class="h4">Comment commander?</strong>
                        <p>Pour commander un DVD ou un livre, il vous suffit de remplir ce formulaire avec vos nom, prénom, adresse, numéro de téléphone, etc..</p>
                        <p>Les frais d'envoi <strong>en Belgique</strong> sont compris dans le prix du DVD/livre. Les frais d'envoi hors frontières sont calculés selon la destination (Europe +8€).</p>
                        <p>Le numéro de compte bancaire de Cinergie asbl est:&nbsp;<br> IBAN : BE10 0012 4446 1904<br>BIC : GEBABEBB</p>
                    </div>


                    <h4>Contact</h4>
                    <fieldset>
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" value="" id="nom" class="form-control" minlength="2" required="required">

                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" value="" id="prenom" class="form-control" minlength="2" required="required">

                        <label for="telephone">Téléphone</label>
                        <input type="text" name="telephone" value="" id="telephone" class="form-control" minlength="2" required="required">

                        <label for="email">Email</label>
                        <input type="email" name="email" value="" id="email" class="form-control" minlength="2" required="required">
                    </fieldset>


                    <h4 class="mt-5">Expédition</h4>
                    <fieldset>
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
                </div>
                <div class="modal-footer">
                    <small>Les champs marqués <span style="color:#eb0101; font-size: 30px;"><sub>*</sub></span> sont obligatoires</small>
                    <input class="btn btn-primary" type="submit" name="submit-nouvelle-annonce" value="Commander">
                </div>
            </div>
        </div>
    </div>
</form>

<script nonce="<?= $CSP_nonce ?>">
    const modal = document.getElementById('modal-order');
    const titreModal = modal.querySelector('.modal-titre');
    const prixModal = modal.querySelector('.modal-prix');

    const btnsCommander = document.querySelectorAll('.btn-commander');
    btnsCommander.forEach(btn => {
        btn.addEventListener('click', function() {
            const titre = btn.getAttribute('data-titre');
            const prix = btn.getAttribute('data-prix');

            titreModal.textContent = titre;
            prixModal.textContent = prix + ' €';
        });
    });
</script>