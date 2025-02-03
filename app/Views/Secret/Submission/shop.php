<?php
$this->layout('Secret::dashboard');

$order = json_decode($submission->get('submitted'), true);
?>
<div class="container submission">

    <div class="order-details">
        <h2>Détails de la Commande</h2>

        <p><strong>Nom :</strong> <?php echo htmlspecialchars($order['nom'] . ' ' . $order['prenom']); ?></p>
        <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($order['telephone']); ?></p>
        <p><strong>Email :</strong> <?php echo htmlspecialchars($order['email']); ?></p>
        <p><strong>Adresse :</strong> <?php echo htmlspecialchars($order['adresse']); ?></p>
        <p><strong>Code Postal :</strong> <?php echo htmlspecialchars($order['cp']); ?></p>
        <p><strong>Ville :</strong> <?php echo htmlspecialchars($order['ville']); ?></p>
        <p><strong>Province :</strong> <?php echo htmlspecialchars($order['province']); ?></p>
        <p><strong>Pays :</strong> <?php echo htmlspecialchars($order['pays']); ?></p>
        <p><strong>Commentaire :</strong> <?php echo htmlspecialchars($order['commentaire']); ?></p>

        <h3>Articles Commandés :</h3>
        <?php

        $output = "<ul>";
        foreach ($order['items'] as $id => $quantity) {
            $output .= '<li><a href="'.$controller->router()->hyp('dash_record_edit', ['nid' => 'Merchandise', 'id' => $id]).'">' . implode(' : ', json_decode($quantity))."</a></li>";
        }
        $output .= "</ul>";
        echo $output;
        ?>
    </div>
</div>