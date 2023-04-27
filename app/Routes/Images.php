<?php

$routes = [
  ['GET', 'images/[*:path]', 'Images::legacy', 'legacy_image_path']
];


array_walk($routes, function(&$v, $k){
  $v[2] = 'Open\\'.$v[2];
});

return $routes;
