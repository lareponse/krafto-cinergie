<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => $page->label()]) ?>

<div class="container my-lg-5 pb-5" id="boutique">
    <ul class="nav nav-tabs align-items-end d-flex justify-content-center" id="boutiqueTabs">
        <li class="nav-item pb-0 order-md-1 order-2">
            <a href="#dvds" class="nav-link active" data-bs-toggle="tab"><i class="bi bi-disc-fill"></i>DVDs</a>
        </li>
        <li class="nav-item pb-0 order-md-1 order-2">
            <a href="#livres" class="nav-link" data-bs-toggle="tab"><i class="bi bi-book-fill"></i>Livres</a>
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
                        <?php $this->insert('Open::Merchandise/card', ['record' => $record]); ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="tab-pane fade" id="livres">
            <div class="row mt-4 fBi">
                <?php foreach ($books ?? [] as $record) { ?>
                    <div class="item-boutique col-12 col-md-6">
                        <?php $this->insert('Open::Merchandise/card', ['record' => $record]); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>

<?php $this->insert('Open::Merchandise/modal_order') ?>

<script>
    let modal = document.getElementById('modal-order');
    let titreModal = modal.querySelector('.modal-titre');
    let prixModal = modal.querySelector('.modal-prix');

    let btnsCommander = document.querySelectorAll('.btn-commander');
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