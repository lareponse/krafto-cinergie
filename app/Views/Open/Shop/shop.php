<?php

use \HexMakina\Marker\Marker;
?>

<?php $this->layout('Open::layout', ['title' => $page->label()]) ?>

<div class="container my-lg-5 pb-5" id="boutique">
    <ul class="nav nav-tabs align-items-end d-flex justify-content-center" id="boutiqueTabs">
        <li class="nav-item pb-0 order-md-1 order-2">
            <a href="#dvds" class="nav-link active" data-bs-toggle="tab"><?= $this->bi('disc-fill', ['class' => 'me-2']); ?> DVDs</a>
        </li>
        <li class="nav-item pb-0 order-md-1 order-2">
            <a href="#livres" class="nav-link" data-bs-toggle="tab"><?= $this->bi('book-fill', ['class' => 'me-2']); ?> Livres</a>
        </li>
        <li id="filtres-boutique" class="col-12 col-md-4 ms-auto order-md-2 order-1 pb-1">
            <div class="row">
                <div class="col-lg-8 mt-3 ms-auto">
                    <label class="form-label">Trier par</label>
                    <select class="form-select" name="categorie-boutique" id="filtreBoutique">
                        <option value="" selected>Titre</option>
                        <option value="">Réalisateurs</option>
                        <option value="">Sortie</option>
                    </select>
                </div>

            </div>
        </li>
    </ul>


    <div class="tab-content">
        <div class="tab-pane fade show active" id="dvds">
            <div class="row mt-4">
                <?php foreach ($dvds ?? [] as $record) { ?>
                    <div class="item-boutique col-12 col-md-6">
                        <?php $this->insert('Open::Merchandise/basket_item', ['record' => $record]); ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="tab-pane fade" id="livres">
            <div class="row mt-4 fBi">
                <?php foreach ($books ?? [] as $record) { ?>
                    <div class="item-boutique col-12 col-md-6">
                        <?php $this->insert('Open::Merchandise/basket_item', ['record' => $record]); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>

<?php $this->insert('Open::Merchandise/modal') ?>

<div class="korbo-trigger"><button class="btn btn-primary" data-shadow-box-template="template_korbo">Votre panier</button></div>

<script type="module" nonce="<?= $CSP_nonce ?>">
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


    import Korbo from '/public/assets/js/korbo.js';
    let korbo = new Korbo();
    let orderButtons = document.querySelectorAll('.add_to_cart');
    orderButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            korbo.add({
                id: button.dataset.id,
                title: button.dataset.titre,
                price: button.dataset.prix,
                deliveryBe: button.dataset.deliveryBe,
                deliveryEu: button.dataset.deliveryEu
            });
        });
    });
</script>

<template id="template_korbo">
    <form id="korbo" class="shadow-box modal-box" role="dialog" aria-labelledby="korbo-title" aria-describedby="korbo-description" aria-hidden="true">
        <main>
            <h2>Comment commander?</h2>
            <p>Pour commander un DVD ou un livre, il vous suffit de remplir ce formulaire avec vos nom, prénom, adresse, numéro de téléphone, etc..</p>
            <div class="bank">
                <span>Le numéro de compte bancaire de Cinergie asbl est</span>
                <span>IBAN :</span>
                <span>BE10 0012 4446 1904</span>
                <span>BIC :</span>
                <span> GEBABEBB</span>
            </div>

            <table id="korbo-table" class="table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Prix</th>
                        <th>Frais de port</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="korbo-body">
                    <script type="module" nonce="<?= $CSP_nonce ?>">
                        let stored = JSON.parse(localStorage.getItem('korbo'));
                        console.log(stored);
                        stored.forEach(item => {
                            let row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${item.title}</td>
                                <td>${item.price}</td>
                                <td>${item.deliveryBe}</td>
                                <td><input type="number" value="${item.quantity}" min="1" /></td>
                                <td>${parseFloat(item.price) + parseFloat(item.deliveryBe)}</td>
                                <td><button type="button" class="btn btn-danger" aria-label="Supprimer cet article">Supprimer</button></td>
                            `;
                            document.querySelector('#korbo-body').appendChild(row);
                        });
                    </script>
                </tbody>
            </table>

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
    </form>
</template>