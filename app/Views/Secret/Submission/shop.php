<?php
$this->layout('Secret::dashboard');

$order = json_decode($submission->get('submitted'), true);
$submitter = json_decode($submission->get('submitted_by'), true);
?>
<div class="container submission">

    <h2>Détails de la Commande</h2>
    <div class="submission-job my-3">
        <strong>Nom :</strong> <span><?php echo htmlspecialchars($order['nom'] . ' ' . $order['prenom']); ?></span>
        <strong>Téléphone :</strong> <span><?php echo htmlspecialchars($order['telephone']); ?></span>
        <strong>Email :</strong> <span><?php echo htmlspecialchars($order['email']); ?></span>
        <strong>Adresse :</strong> <span><?php echo htmlspecialchars($order['adresse']); ?></span>
        <strong>Code Postal :</strong> <span><?php echo htmlspecialchars($order['cp']); ?></span>
        <strong>Ville :</strong> <span><?php echo htmlspecialchars($order['ville']); ?></span>
        <strong>Province :</strong> <span><?php echo htmlspecialchars($order['province']); ?></span>
        <strong>Pays :</strong> <span><?php echo htmlspecialchars($order['pays']); ?></span>
        <strong>Commentaire :</strong> <span><?php echo htmlspecialchars($order['commentaire']); ?></span>
    </div>

    <h3>Articles Commandés :</h3>
    <div class="submission-job my-3">
        <ul>
            <?php
            foreach ($order['items'] as $id => $quantity) {
                echo '<li><a href="'.$controller->router()->hyp('dash_record_edit', ['nid' => 'Merchandise', 'id' => $id]).'">' . implode(' : ', json_decode($quantity)) . "</a></li>";
            }
            ?>
        </ul>
    </div>

    <?= $this->insert('Secret::Submission/view/submitted_by', ['submitter' => $submitter]); ?>
</div>
