<div class="card border-0 pt-3">
  <div class="card-body pt-0">

    <h3 class="h6 small text-secondary text-uppercase mb-3">Contacts</h3>
    <ul class="list-unstyled">
      <?php
      $fields = [
        'tel' => 'phone',
        'gsm' => 'mobile',
        'fax' => 'fax',
        'email' => 'email',
        'url' => 'http'
      ];

      foreach ($fields as $name => $icon) {
        if (!empty($controller->formModel()->get($name))) {
          $label = $controller->formModel()->get($name);
          switch ($name) {
            case 'url':
              $label = sprintf('<a href="%s">%s</a>', $label, parse_url($label, PHP_URL_HOST));
              break;

            case 'metrage_id':
            case 'genre_id':
              $label = $tags[$label];
              break;
          }
          printf($list_item, $this->icon($icon, 18, ['class' => 'me-2']), $label);
        }
      } 
      ?>
    </ul>


  </div>
</div>