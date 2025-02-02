<?php
$columns = get_class($model)::table()->columns();
$legacyValues = [];
foreach ($columns as $col) {
    if (strpos($col->name(),'legacy_') === 0 ) {
        $value = trim($controller->formModel()->get($col->name()));
        $icon = $this->icon('info', 18, ['class' => 'me-2', 'title' => $col->name(), 'alt' => $col->name()]);
        if('' !== $value) {
            $legacyValues[] = $this->DOM()::li($icon.$value, ['class' => 'py-2'], false);
        }
    }
}
if(!empty($legacyValues)){
    ?>
<div class="card border-0 pt-3">
    <div class="card-body pt-0">
    <h3 class="h6 small text-secondary text-uppercase mb-3">Legacy</h3>
    <ul class="list-unstyled text-muted">
        <?= implode('', $legacyValues)?>
    </ul>
    </div>
</div>
<?php
}
?>