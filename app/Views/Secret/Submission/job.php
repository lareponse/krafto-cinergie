<?php
$this->layout('Secret::dashboard');

$order = json_decode($submission->get('submitted'), true);
?>
<div class="container submission">

    <h2>Détails de l'annonce</h2>
    <div class="submission-job my-3">
        <strong>isOffer :</strong> <span><?php echo htmlspecialchars($order['isOffer']); ?></span>
        <strong>isPaid :</strong> <span><?php echo htmlspecialchars($order['isPaid']); ?></span>
        <strong>Catégorie :</strong> <span><?php echo htmlspecialchars($order['category_id']); ?></span>
        <strong>Label :</strong> <span><?php echo htmlspecialchars($order['label']); ?></span>
        <strong>Contenu :</strong> <span><?php echo htmlspecialchars($order['content']); ?></span>
        <strong>Date de début :</strong> <span><?php echo htmlspecialchars($order['starts']); ?></span>
        <strong>Date de fin :</strong> <span><?php echo htmlspecialchars($order['stops']); ?></span>
        <strong>Identité :</strong> <span><?php echo htmlspecialchars($order['identity']); ?></span>
        <strong>Téléphone :</strong> <span><?php echo htmlspecialchars($order['phone']); ?></span>
        <strong>Email :</strong> <span><?php echo htmlspecialchars($order['email']); ?></span>
        <strong>URL :</strong> <span><?php echo htmlspecialchars($order['url']); ?></span>
    </div>

    <?= $this->insert('Secret::Submission/view/submitted_by', ['submitter' => $submitter]); ?>
</div>