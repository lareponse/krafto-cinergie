<?php

use \HexMakina\Marker\Marker; ?>

<?php $this->layout('Open::layout', ['title' => $page->get('label')]) ?>

<div class="row" id="concours">
    <?php
    if (empty($contests)) {
        echo Marker::strong($page->get('content'), ['class' => 'text-center text-primary my-5']);
    } else {
        foreach ($contests as $contest) {
            echo '<div class="col-lg-4 col-md-6 my-5 concours-item">';
            $this->insert('Open::Contest/card', ['contest' => $contest]);
            echo '</div>';
        }
    }
    ?>
</div>