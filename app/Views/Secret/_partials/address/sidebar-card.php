<div class="card border-0 pt-3">
  <div class="card-body pt-0">
    <h3 class="h6 small text-secondary text-uppercase mb-3">Adresse</h3>
    <?= implode('<br/>', $controller->formModel()->address()); ?>
  </div>
</div>