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
          $class = '';

          switch ($name) {
            case 'email':
              $class = 'otto-email';
              break;
              
            case 'url':
              $class = 'otto-url';
              break;
            case 'tel':
            case 'gsm':
            case 'fax':
              $class = 'otto-phone';
              break;
            case 'metrage_id':
            case 'genre_id':
              $label = $tags[$label];
              break;
              
  
          }

          printf('<li class="py-2">%s %s</li>', $this->icon($icon, 18, ['class' => 'me-2']), $this->DOM()::span($label, ['class' => $class]));
        }
      } 
      ?>
    </ul>


  </div>
</div>