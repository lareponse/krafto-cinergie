<!-- Modal -->
<div class="modal fade" id="<?= $modal_id ?? 'modal-nouvelle-annonce' ?>" tabindex="-1" aria-labelledby="modal-nouvelle-annonce-label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-nouvelle-annonce-label">Nouvelle annonce</h1>
                <button type="button" class="btn-close  btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">

            <?= $this->insert('Open/Job/form_new'); ?>

            </div>

        </div>
    </div>
</div>