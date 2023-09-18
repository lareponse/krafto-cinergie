<?php if($contact->canDisplay('zip') || $contact->canDisplay('city')){

?><p><strong>Ville :</strong> <?=$contact->canDisplay('zip') ? $contact->get('zip').' ' : ''?><?=$contact->canDisplay('city') ? $contact->get('city'): '' ?></p><?php
}
?>
<?php if ($contact->canDisplay('province'))
{
?><p><strong>Province :</strong> <?=$contact->get('province')?></p><?php
}
?>

<?php if ($contact->canDisplay('country'))
{
?><p><strong>Pays :</strong> <?=$contact->get('country')?></p><?php
}
?>
<?php if ($contact->canDisplay('email'))
{
?><p><strong>Email :</strong> <?=$contact->get('email')?></p><?php
}
?>

<?php if ($contact->canDisplay('mobile'))
{
?><p><strong>GSM :</strong> <?=$contact->get('mobile')?></p><?php
}
?>
<?php if ($contact->canDisplay('tel'))
{
?><p><strong>Tel :</strong> <?=$contact->get('tel')?></p><?php
}
?>            
<?php if ($contact->canDisplay('fax'))
{
?><p><strong>Fax :</strong> <?=$contact->get('fax')?></p><?php
}
?>
<?php if ($contact->canDisplay('birth'))
{
?><p><strong>Date de naissance :</strong> <span class="otto-date"><?= $contact->get('birth')?></span></p><?php
}
?>

<?php if ($contact->canDisplay('birth'))
{
?>
   <p><a class="cta" href="<?=$contact->get('url')?>" target="_blank"><strong>Site web</strong></a></p>
   <?php
}
?>