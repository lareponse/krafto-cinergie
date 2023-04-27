<?php
$list_item = '<li class="py-2">%s %s</li>';
?>
<div class="card border-0 pt-3">


  <div class="card-body pt-0">
    <h3 class="h6 small text-secondary text-uppercase mb-3">Technique</h3>

    <ul class="list-unstyled mb-7">
      <?php
      $fields = [
        'legacy_origine' => 'origine',
        'released' => 'calendar',
        'runtime' => 'time',
        'format' => 'video-format',
        'genre_id' => 'genre',
        'metrage_id' => 'metrage',
        'url' => 'http',
        'url_trailer' => 'video-player'
      ];

      foreach ($fields as $name => $icon) {
        if (!empty($controller->loadModel()->get($name))) {
          $label = $controller->loadModel()->get($name);
          switch ($name) {
            case 'url':
              $label = '<a href="' . $label . '">site</a>';
              break;

            case 'metrage_id':
            case 'genre_id':
              $label = $tags[$label];
              break;
          }
          printf($list_item, $this->icon($icon, 14, ['class' => 'me-2']), $label);
        }
      }
      ?>
    </ul>
    <h3 class="h6 small text-secondary text-uppercase mb-3">Thèmes</h3>
    <ul class="list-unstyled mb-7">
      <?php 
      foreach($tagIdsByCategory['movie_theme'] as $id){
          ?>
          <li class="py-2">
              <?= $this->icon('tag', 14, ['class' => 'me-2']) ?>
              <span class="otto-tag-label" otto-id="<?= $id ?>"><?= $id ?></span>
          </li>
          <?php
      }
      ?>
    </ul>
    
    <h3 class="h6 small text-secondary text-uppercase mb-3">Thésaurus</h3>
    <ul class="list-unstyled mb-7">
      <?php 
      foreach($controller->loadModel()->thesaurusIds() as $id){
          ?>
          <li class="py-2">
              <?= $this->icon('tag', 14, ['class' => 'me-2']) ?>
              <span class="otto-thesaurus-label" otto-id="<?= $id ?>"><?= $id ?></span>
          </li>
          <?php
      }
      ?>
    </ul>
    <ul class="list-unstyled mb-7">
      <?php
      $fields = [
        'unesco_id' => 'tags',
        'unesco_bis_id' => 'tags',
        'unesco_ter_id' => 'tags'
      ];
      foreach ($fields as $name => $icon) {
        if (!empty($controller->loadModel()->get($name))) {
          $thesaurus_id = $controller->loadModel()->get($name);

          $label = isset($unesco_authorities) && isset($unesco_authorities[$thesaurus_id]) ? $unesco_authorities[$thesaurus_id]->get('label') : $thesaurus_id;

          printf($list_item, $this->icon($icon, 14, ['class' => 'me-2']), $label);
        }
      }
      ?>
    </ul>

    <h3 class="h6 small text-secondary text-uppercase mb-3">Mise à jour</h3>
    <div class="mb-7">
      <span class="humanDate"><?= $controller->loadModel()->get('legacy_maj') ?></span>
    </div>
  </div>
</div>