<?php
$list_item = '<li class="py-2">%s %s</li>';
?>

<?= $this->insert('Secret::_partials/praxis/sidebar-card', ['list_item' => $list_item])?>
<?= $this->insert('Secret::_partials/contact/sidebar-card', ['list_item' => $list_item])?>
<?= $this->insert('Secret::_partials/address/sidebar-card', ['list_item' => $list_item])?>


