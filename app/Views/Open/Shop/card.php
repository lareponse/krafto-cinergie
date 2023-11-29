<article class="card shadow paysage boutique mb-4">
    <div class="row g-0">

        <div class="col-md-4">
            <a href="boutique-single.php">
                <img src="<?= $record->profilePicture() ?>" class="img-fluid w-100 rounded-start" alt="DVD du film <?= $record ?>">
            </a>
        </div>

        <div class="col-md-8">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p class="genre">Fiction</p>
                    <p class="date"><?= $record->get('released'); ?></p>
                </div>
                <h5 class="card-title mb-3 titre-film"><?= $record; ?></h5>
                <p class="author"><i class="bi bi-person-fill pe-1"></i>Yvan Govar</p>
                <aside class="input-group commander-boutique">
                    <button class="form-control btn-commander" 
                        data-bs-toggle="modal" 
                        data-bs-target="#modal-order" 
                        data-titre="<?= $record; ?>" 
                        data-prix="<?= $record->get('price'); ?>">
                            <i class="bi bi-cart-plus-fill"></i> </button>
                    <span class="input-group-text prix"><?= number_format($record->get('price'), 2) ?> &euro;</span>
                </aside>
				<small class="mt-3 frais"><?= $record->get('price'); ?>&euro; + <?= $record->get('deliveryBe') ?>&euro; de frais d'envoi en Belgique ou <?= $record->get('deliveryEu') ?>&euro; en Europe</small>
            </div>
        </div>
    </div>
</article>