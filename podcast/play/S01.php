<?php

$season_tag = 1;
$episode_count = 10;
$season = [];
for($i=0; $i<=$episode_count; ++$i){
  $key = sprintf('S%02dE%02d', $season_tag, $i);
  $season[$key] = require_once($key.'/related.php');
}

return $season;
