<h3>Informations du Soumetteur :</h3>
<div class="submission-job my-3">
    <strong>Adresse IP :</strong> <span><?php echo htmlspecialchars($submitter['REMOTE_ADDR']); ?></span>
    <strong>User-Agent :</strong> <span><?php echo htmlspecialchars($submitter['HTTP_USER_AGENT']); ?></span>
    <strong>Referer :</strong> <span><?php echo htmlspecialchars($submitter['HTTP_REFERER']); ?></span>
    <strong>URL de Soumission :</strong> <span><?php echo htmlspecialchars($submitter['REQUEST_URI']); ?></span>
    <strong>Méthode :</strong> <span><?php echo htmlspecialchars($submitter['REQUEST_METHOD']); ?></span>
    <strong>Horodatage :</strong> <span><?php echo date('Y-m-d H:i:s', $submitter['REQUEST_TIME']); ?></span>
    <strong>Langue Acceptée :</strong> <span><?php echo htmlspecialchars($submitter['HTTP_ACCEPT_LANGUAGE']); ?></span>
    <strong>Hôte HTTP :</strong> <span><?php echo htmlspecialchars($submitter['HTTP_HOST']); ?></span>
</div>

<div class="btn-group mx-auto">
    <a href="<?php echo $controller->router()->hyp('dash_submission_approve', ['id' => $submission->id()]); ?>" class="btn btn-success">Accepter</a>
    <a href="<?php echo $controller->router()->hyp('dash_submission_reject', ['id' => $submission->id()]); ?>" class="btn btn-danger">Refuser</a>
</div>