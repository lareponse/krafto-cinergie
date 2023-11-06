<?php 

use \HexMakina\Marker\Marker;

$links = [];

foreach($tags as $tag){
    if($tag->get('parent_slug') != 'movie_theme')
        continue;

    $href = $controller->router()->hyp('movies') . '?theme=' . $tag->id();
    $links []= Marker::a($href, $tag);
}
echo implode(' &bull; ', $links);
