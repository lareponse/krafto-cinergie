<?php
$this->layout('Secret::dashboard');

$order = json_decode($submission->get('submitted'), true);
?>
<div class="container submission">

    <div class="order-details">
        <h2>Détails de la Proposition</h2>

        <p><strong>Type :</strong> <?php echo htmlspecialchars($order['type']); ?></p>
        <p><strong>Rémunération :</strong> <?php echo htmlspecialchars($order['remun']); ?></p>
        <p><strong>Catégorie :</strong> <?php echo htmlspecialchars($order['categorie']); ?></p>
        <p><strong>Label :</strong> <?php echo htmlspecialchars($order['label']); ?></p>
        <p><strong>Contenu :</strong> <?php echo htmlspecialchars($order['content']); ?></p>
        <p><strong>Date de début :</strong> <?php echo htmlspecialchars($order['starts']); ?></p>
        <p><strong>Date de fin :</strong> <?php echo htmlspecialchars($order['stops']); ?></p>
        <p><strong>Identité :</strong> <?php echo htmlspecialchars($order['identity']); ?></p>
        <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($order['phone']); ?></p>
        <p><strong>Email :</strong> <?php echo htmlspecialchars($order['email']); ?></p>
        <p><strong>URL :</strong> <?php echo htmlspecialchars($order['url']); ?></p>
    </div>
</div>