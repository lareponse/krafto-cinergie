<?php

$routes = [
  ['GET', 'events/contests.json', 'Calendar::contests', 'event_contest'],
  ['GET', 'events/events.json/[*:params]?', 'Calendar::events', 'event_events'],
  ['GET', 'tag/[a:context]/[*:context_value]/term/[*:term]', 'Tagging::parentReference', 'tag_filter'],
  ['GET', 'tags/ids/[*:ids]/labels.json', 'Tagging::labelsForIds', 'tag_ids'],
  ['GET', 'thesaurus/ids/[*:ids]/labels.json', 'Thesaurus::labelsForIds', 'thesaurus_label_for_ids'],
  ['GET', 'thesaurus/[a:field]/[*:term]', 'Thesaurus::filter', 'thesaurus_filter'],
  ['GET', 'id-label/[a:handle]/term/[*:term]', 'IdLabel::byTerm', 'idlabel_search'],

];


array_walk($routes, function(&$v, $k){
  $v[1] = 'api/'.$v[1];
  $v[2] = 'API\\'.$v[2];
  $v[3] = 'api_'.$v[3];
});
return $routes;
