<?php
$routes = [];

// CUSTOM ROUTES
array_push(
    $routes,
    ['GET', 'pages/prix_cinergie', 'Page::award', 'page_cinergie_award'],
    ['GET', 'pages/equipe', 'Page::team', 'page_team'],
    ['GET', 'pages/[*:slug]', 'Page::slug', 'page_slug']
);

array_push(
    $routes,
    ['GET', 'organisations/segment/[a:segment]', 'Organisation::home', 'organisations_by_segment'],
);

array_push(
    $routes,
    ['GET', 'Merchandise/Books', 'Merchandise::books', 'bookshop'],
    ['GET', 'Merchandise/DVDs', 'Merchandise::dvds', 'videostore'],
);
array_push(
    $routes,
    ['POST', 'relations/link', 'Relation::link', 'relation_link'],
    ['POST', 'relations/unlink', 'Relation::unlink', 'relation_unlink'],
);


array_push(
    $routes,
    ['GET|POST', 'delete/[*:nid]/[i:id]', 'Delete::delete', 'delete'],

    ['GET', 'image/details/[a:externalController]/slug/[*:slug]/file/[*:filename]', 'Image::details', 'image_details'],
    ['POST', 'image/delete/[a:externalController]/slug/[*:slug]/file/[*:filename]', 'Image::delete', 'image_delete'],

    ['GET', 'image/avatar/[a:nid]/[i:id]/[*:filename]?', 'Image::avatar', 'image_set_avatar'],

    ['GET', 'image/[*:filename]', 'Image::view', 'image_view'],

    ['GET', 'images/deadlinks/[a:externalController]', 'Image::deadlinks', 'images_deadlinks'],
    ['GET', 'images/alternates', 'Image::alternates', 'images_alternates'],

    ['POST',  '[a:nid]/[i:id]/upload', 'Image::dropzoneUpload', 'image_upload'],
);



// GENERIC CRUD ROUTES
array_push(
    $routes,
    ['GET',  '[a:nid]/[i:id]/images/setProfile/[*:path]', '::setProfilePicture', 'record_set_profile_picture'],
    ['GET',  '[a:nid]/[i:id]/images/unsetProfile', '::unsetProfilePicture', 'record_unset_profile_picture'],

    ['POST', '[a:nid]/[i:id]/toggle/[a:field]', '::toggle', 'record_toggle'],
    ['POST', '[a:nid]/supprimer', '::delete', 'record_delete'],
    ['POST', '[a:nid]/enregistrer', '::save', 'record_save'],

    ['GET',  '[a:nid]/new', '::alter', 'record_new'],
    ['GET',  '[a:nid]/[i:id]', '::view', 'record'],
    ['GET',  '[a:nid]/[i:id]/edit', '::alter', 'record_edit'],
    ['GET',  '[a:nid]/modifier/[*:slug]', '::editBySlug', 'record_edit_by_slug'],
    ['GET',  '[a:nid]/[*:params]?', '::home', 'records'],
);

$route_prefix = 'dash';
$controller_prefix = 'Secret';

array_walk($routes, function (&$v, $k) use ($route_prefix, $controller_prefix) {
    $v[1] = $route_prefix . '/' . $v[1];
    $v[2] = $controller_prefix . '\\' . $v[2];
    $v[3] = $route_prefix . '_' . $v[3];
});

array_unshift($routes, ['GET', 'dash', $controller_prefix . '\\Article::home', 'dashboard']);

return $routes;
