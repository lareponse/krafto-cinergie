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

<script>
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


<script>
    const compare = function(ids, asc) {
        return function(row1, row2) {
            const tdValue = function(row, ids) {
                return row.querySelector('.card-title').textContent;
            };

            const tri = function(v1, v2) {
                if (!isNaN(v1) && !isNaN(v2)) {
                    return asc ? v1.localeCompare(v2) : v2.localeCompare(v1);
                } else {
                    return asc ? v1.localeCompare(v2) : v2.localeCompare(v1);
                }
            };

            return tri(tdValue(row1, ids), tdValue(row2, ids));
        };
    };

    const selectElement = document.querySelector('#filtreBoutique');
    selectElement.addEventListener('change', function() {
        const container = document.querySelector('.tab-pane.show.active .row');
        const elementsToSort = Array.from(container.querySelectorAll('.item-boutique'));

        let classe = elementsToSort.sort(compare(0, true)); // Triez par le titre

        classe.forEach(function(element) {
            container.appendChild(element);
        });
    });
</script>