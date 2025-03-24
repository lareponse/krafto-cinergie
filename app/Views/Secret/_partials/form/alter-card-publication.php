<?php
if (!$controller->operator()->hasPermission('editor') && !$controller->operator()->hasPermission('root')) {
    $this->insert('Secret::_partials/form/alter-card-publication-author');
}
else{
    $this->insert('Secret::_partials/form/alter-card-publication-editor');
}
