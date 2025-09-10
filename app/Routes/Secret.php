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
    ['GET', 'operators/segment/[a:segment]', 'Operator::home', 'operators_by_segment'],
    ['GET', 'organisations/segment/[a:segment]', 'Organisation::home', 'organisations_by_segment'],
    ['GET', 'profesionnals/segment/[a:segment]', 'Professional::home', 'professionals_by_segment'],
    ['GET', 'articles/segment/[a:segment]', 'Article::home', 'articles_by_segment'],
    ['GET', 'articles/type/[i:type_id]', 'Article::home', 'articles_by_type'],
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
    ['GET', 'Submission/[i:id]/approve', 'Submission::approve', 'submission_approve'],
    ['GET', 'Submission/[i:id]/reject', 'Submission::reject', 'submission_reject'],
);


array_push(
    $routes,
    ['GET', 'Sanitize/Agenda', 'Sanitize::agenda', 'sanitize_agenda'],
    ['GET', 'Export', 'Export::home', 'admin_export'],
    ['POST', 'Export/csv', 'Export::csv', 'export_csv'],
);

array_push(
    $routes,
    ['GET|POST', 'delete/[*:nid]/[i:id]', 'Delete::delete', 'delete'],

    ['GET', 'image/details/[a:externalController]/slug/[*:slug]/file/[*:filename]', 'Image::details', 'image_details'],
    ['POST', 'image/delete/[a:externalController]/slug/[*:slug]/file/[*:filename]', 'Image::delete', 'image_delete'],

    ['GET', 'image/avatar/[a:nid]/[i:id]/[*:filename]?', 'Image::avatar', 'image_set_avatar'],

    
    ['GET', 'images/deadlinks/[a:externalController]', 'Image::deadlinks', 'images_deadlinks'],
    ['GET', 'images/alternates', 'Image::alternates', 'images_alternates'],
    ['GET', 'images/scan', 'Image::scan', 'images_scan'],
    
    ['GET', 'image/[*:filename]', 'Image::view', 'image_view'],
    ['POST',  '[a:nid]/[i:id]/upload', 'Image::dropzoneUpload', 'image_upload'],
);




// GENERIC CRUD ROUTES
array_push(
    $routes,
    ['GET',  '[a:nid]/[i:id]/images/setProfile/[*:path]', '::setProfilePicture', 'record_set_profile_picture'],
    ['GET',  '[a:nid]/[i:id]/images/unsetProfile', '::unsetProfilePicture', 'record_unset_profile_picture'],
    ['GET',  '[a:nid]/[i:id]/images/setBanner/[*:path]', '::setBannerPicture', 'record_set_banner_picture'],
    ['GET',  '[a:nid]/[i:id]/images/unsetBanner', '::unsetBannerPicture', 'record_unset_banner_picture'],

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
