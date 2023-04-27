<div class="card border-0 pt-3">
    <div class="card-body pt-0">

    <h3 class="h6 small text-secondary text-uppercase mb-3">Métier(s)</h3>
    <ul class="list-group list-group-flush list-group-compact">
      <?php
      foreach (explode(',',$controller->formModel()->get('praxis_ids')) as $praxis_id)
        echo sprintf('<li class="list-group-item otto-tag-label" otto-id="%s">%s</li>', $praxis_id, $praxis_id);
      ?>
    </ul>

    </div>
</div>