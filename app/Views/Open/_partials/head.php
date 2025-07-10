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

<!-- Bootstrap 5.3 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>

<!-- FullCalendar 6.18 -->
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.18/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.18/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.18/index.global.min.js'></script>


<style data-import="slick, slick-time, lightbox, sib-styles">
    <?= file_get_contents(DOCUMENT_ROOT . '/public/assets/wejune/css/slick.min.css') ?><?= file_get_contents(DOCUMENT_ROOT . '/public/assets/wejune/css/slick-theme.css') ?><?= file_get_contents(DOCUMENT_ROOT . '/public/assets/wejune/css/lightbox.min.css') ?><?= file_get_contents(DOCUMENT_ROOT . '/public/assets/css/sib-styles.css') ?>
</style>

<link rel="stylesheet" href="/public/assets/wejune/css/style.css"><!-- original custom css -->
<link rel="stylesheet" href="/public/assets/css/lareponse.css"><!-- fixes to the custom css -->