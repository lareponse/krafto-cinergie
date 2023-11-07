<?php $this->layout('Secret::alter') ?>

<div class="card border-0 scroll-mt-3" id="SignalétiqueSection">
    <div class="card-header">
        <h2 class="h3 mb-0">Signalétique</h2>
    </div>

    <div class="card-body">
        <?= $this->insert('Secret::Author/alter/signaletique') ?>
    </div>
</div>

<?= $this->insert('Secret::_partials/form/alter-card-publication', [
    'add' => [
        'isCollaborator' => ['Collaborateur', 'Présent dans les listes de collaborateurs ?']
        ]
    ]) ?>
