<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cinergie | <?= $controller->meta('title') ?></title>
<meta name="description" content="<?= $controller->meta('description') ?>">
<!-- Standard OG meta tags -->
<meta property="og:title" content="<?= $controller->meta('title') ?>">
<meta property="og:description" content="<?= $controller->meta('description') ?>">
<meta property="og:url" content="<?= $controller->meta('url') ?>">
<meta property="og:type" content="<?= $controller->meta('type') ?>">
<meta property="og:image" content="<?= $controller->meta('image') ?>">

<!-- Optional OG tags -->
<meta property="og:site_name" content="Cinergie.be">
<meta property="og:locale" content="fr_FR">

<!-- Twitter Card (optional) -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:title" content="<?= $controller->meta('title') ?>" />
<meta property="twitter:description" content="<?= $controller->meta('description') ?>" />
<meta property="twitter:image" content="<?= $controller->meta('image') ?>" />
<meta property="twitter:site" content="@Cinergie" />
<meta property="twitter:creator" content="@Cinergie" />

<link rel="stylesheet" href="/public/assets/wejune/css/bootstrap.min.css">
<link rel="stylesheet" href="/public/assets/wejune/css/bootstrap-print.min.css" media="print">

<style data-import="slick, slick-time, lightbox, sib-styles">
    <?= file_get_contents(DOCUMENT_ROOT. '/public/assets/wejune/css/slick.min.css') ?>
    <?= file_get_contents(DOCUMENT_ROOT. '/public/assets/wejune/css/slick-theme.css') ?>
    <?= file_get_contents(DOCUMENT_ROOT. '/public/assets/wejune/css/lightbox.min.css') ?>
    <?= file_get_contents(DOCUMENT_ROOT. '/public/assets/css/sib-styles.css') ?>
</style>

<link rel="stylesheet" href="/public/assets/wejune/css/style.css"><!-- original custom css -->
<link rel="stylesheet" href="/public/assets/css/lareponse.css"><!-- fixes to the custom css -->
