<!-- Modal -->
<div class="modal fade" id="modal-order" tabindex="-1" aria-labelledby="modal-nouvelle-commande-label-dvd" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="modal-nouvelle-commande-label-dvd">Nouvelle commande</h2>
                <button type="button" class="btn-close  btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <h2 class="titrefilm modal-titre text-right"></h2>
                    <h3 class="prix-film modal-prix text-right"></h3>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <?= $this->insert('Open::Merchandise/form_order') ?>
                    </div>
                    <div class="col">
                        <strong class="h4">Comment commander?</strong>
                        <p>Pour commander un DVD ou un livre, il vous suffit de remplir ce formulaire avec vos nom, prénom, adresse, numéro de téléphone, etc..</p>
                        <p>Les frais d'envoi <strong>en Belgique</strong> sont compris dans le prix du DVD/livre. Les frais d'envoi hors frontières sont calculés selon la destination (Europe +8€).</p>
                        <p>Le numéro de compte bancaire de Cinergie asbl est:&nbsp;<br> IBAN : BE10 0012 4446 1904<br>BIC : GEBABEBB</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script  nonce="<?= $CSP_nonce?>">
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

