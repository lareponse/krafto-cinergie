<?php if ($contact->canDisplay('zip') || $contact->canDisplay('city')) {

?><p><strong>Ville :</strong> <?= $contact->canDisplay('zip') ? $contact->get('zip') . ' ' : '' ?><?= $contact->canDisplay('city') ? $contact->get('city') : '' ?></p><?php
                                                                                                                                                                     }
                                                                                                                                                                        ?>
<?php if ($contact->canDisplay('province')) {
?><p><strong>Province :</strong> <?= $contact->get('province') ?></p><?php
                                                                  }
                                                                     ?>

<?php if ($contact->canDisplay('country')) {
?><p><strong>Pays :</strong> <?= $contact->get('country') ?></p><?php
                                                               }
                                                                  ?>
<?php if ($contact->canDisplay('email')) {
?>
   <p><strong>Email :</strong> <span class="otto-email" otto-subject="Prise de contact par cinergie.be: <?= $record; ?>" otto-content="Bonjour"><?= $contact->get('email') ?></span></p>
<?php
}
?>

<?php if ($contact->canDisplay('mobile')) {
?>
   <p><strong>GSM :</strong> <span class="otto-phone"><?= $contact->get('mobile') ?></span></p><?php
}
?>
<?php if ($contact->canDisplay('tel')) {
?><p><strong>Tel :</strong> <span class="otto-phone"><?= $contact->get('tel') ?></span></p><?php
   }
?>
<?php if ($contact->canDisplay('fax')) {
?><p><strong>Fax :</strong> <?= $contact->get('fax') ?></p><?php
}
?>
<?php if ($contact->canDisplay('birth')) {
?><p><strong>Date de naissance :</strong> <span class="otto-date"><?= $contact->get('birth') ?></span></p><?php
}
?>

<?php if ($contact->canDisplay('birth')) {
?>
   <p><a class="cta" href="<?= $contact->get('url') ?>" target="_blank"><strong>Site web</strong></a></p>
<?php
}
?>