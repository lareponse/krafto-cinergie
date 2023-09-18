<?php 

use \HexMakina\Marker\Marker;

$links = [];

foreach($tags as $tag){
    if($tag->get('parent_reference') != 'movie_theme')
        continue;

    $href = $controller->router()->hyp('movies') . '?theme=' . $tag->getID();
    $links []= Marker::a($href, $tag);
}
echo implode(' &bull; ', $links);
