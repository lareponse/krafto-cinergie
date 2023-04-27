<?php
$routes = [];
$route_prefix = 'dash';
$controller_prefix = 'Secret';

// CUSTOM ROUTES

array_push($routes,
    ['GET', 'pages/prix_cinergie', 'Page::award', 'page_cinergie_award'],
    ['GET', 'pages/equipe', 'Page::team', 'page_team'],
    ['GET', 'pages/[*:slug]', 'Page::slug', 'page_slug']
);

array_push($routes,
    ['GET', 'organisations/segment/[a:segment]', 'Organisation::home', 'organisations_by_segment'],
);

array_push($routes,
    ['POST', 'relations/[a:parent]/[a:child]', 'Relation::link', 'relation_link'],
    ['POST', 'relations/unlink', 'Relation::unlink', 'relation_unlink'],
);

array_push($routes,
    ['POST', 'upload', 'Upload::upload', 'upload_file']
);

array_push($routes,
    ['GET', 'image/[*:reference]/supprimer', 'Image::delete', 'image_delete'],
    ['GET', 'image/[*:reference]/detail', 'Image::delete', 'image_view'],
);



// GENERIC CRUD ROUTES
array_push($routes,
    ['GET',  '[a:controller]', '::home', 'records'],
    ['GET',  '[a:controller]/[i:id]', '::view', 'record'],
    ['POST',  '[a:controller]/[i:id]/upload', '::imageUpload', 'record_upload'],
    ['POST',  '[a:controller]/[i:id]/images/supprimer', '::imageUnlink', 'record_image_unlink'],

    ['GET',  '[a:controller]/nouveau', '::new', 'record_new'],
    ['GET',  '[a:controller]/[i:id]/modifier', '::edit', 'record_edit'],
    ['GET',  '[a:controller]/[*:slug]/modifier', '::editBySlug', 'record_edit_by_slug'],
    ['GET',  '[a:controller]/[i:id]/toggle', '::toggle', 'record_toggle'],

    ['POST', '[a:controller]/supprimer', '::delete', 'record_delete'],
    ['POST', '[a:controller]/enregistrer', '::save', 'record_save']
);



array_walk($routes, function (&$v, $k) use ($route_prefix, $controller_prefix) {
    $v[1] = $route_prefix . '/' . $v[1];
    $v[2] = $controller_prefix . '\\' . $v[2];
    $v[3] = $route_prefix . '_' . $v[3];
});

array_unshift($routes, ['GET', 'dash', $controller_prefix.'\\Home::home', 'dashboard']);

return $routes;
