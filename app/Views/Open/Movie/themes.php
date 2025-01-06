<?php 

use \HexMakina\Marker\Marker;

$links = [];
foreach($themes as $tag){

    $href = $controller->router()->hyp('movies') . '?theme=' . $tag->id();
    $links []= Marker::a($href, $tag);
}
echo implode(' &bull; ', $links);
