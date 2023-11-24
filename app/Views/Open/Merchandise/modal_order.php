<!-- Modal -->
<div class="modal fade" id="modal-nouvelle-commande-dvd" tabindex="-1" aria-labelledby="modal-nouvelle-commande-label-dvd" aria-hidden="true">
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
                            <input type="text" name="nom-commande" value="nom-commande" id="nom-commande" class="form-control" minlength="2" placeholder="votre nom..." required="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="prenom-commande" class="col-lg-2 col-form-label">Prénom <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="prenom-commande" value="prenom-commande" id="prenom-commande" class="form-control" minlength="2" placeholder="votre prénom..." required="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="telephone-commande" class="col-lg-2 col-form-label">Téléphone <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="telephone-commande" value="telephone-commande" id="telephone-commande" class="form-control" minlength="2" placeholder="numéro de téléphone de contact..." required="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email-commande" class="col-lg-2 col-form-label">Email <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="email" name="email-commande" value="email-commande" id="email-commande" class="form-control" minlength="2" placeholder="adresse mail de contact..." required="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="adresse-commande" class="col-lg-2 col-form-label">Adresse <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="adresse-commande" value="adresse-commande" id="adresse-commande" class="form-control" minlength="2" placeholder="rue, numéro, boîte" required="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="cp-commande" class="col-lg-2 col-form-label">Code postal <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="cp-commande" value="cp-commande" id="cp-commande" class="form-control" minlength="2" placeholder="code postal..." required="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="ville-commande" class="col-lg-2 col-form-label">Ville <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="ville-commande" value="ville-commande" id="ville-commande" class="form-control" minlength="2" placeholder="localité" required="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="province-commande" class="col-lg-2 col-form-label">Province
                            <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="province-commande" value="province-commande" id="province-commande" class="form-control" minlength="2" placeholder="province..." required="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="pays-commande" class="col-lg-2 col-form-label">Pays <span>*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="pays-commande" value="pays-commande" id="pays-commande" class="form-control" minlength="2" placeholder="pays..." required="">
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

<script>
    const modal = document.getElementById('modal-nouvelle-commande-dvd');
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