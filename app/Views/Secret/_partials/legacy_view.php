<h3 class="h6 small text-secondary text-uppercase mb-3">Legacy</h3>

<ul class="list-unstyled text-muted">
<?php
$columns = get_class($model)::table()->columns();
foreach ($columns as $col) {
    if (strpos($col->name(),'legacy_') === 0 ) {
        $value = trim($controller->formModel()->get($col->name()));
        $icon = $this->icon('info', 18, ['class' => 'me-2', 'title' => $col->name(), 'alt' => $col->name()]);
        if('' !== $value) {
            echo $this->DOM()::li($icon.$value, ['class' => 'py-2']);
        }
    }
}

?>
</ul>