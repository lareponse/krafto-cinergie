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

<link rel="stylesheet" href="/public/assets/wejune/css/slick-theme.css">
<link rel="stylesheet" href="/public/assets/wejune/css/slick.min.css">
<link rel="stylesheet" href="/public/assets/wejune/css/lightbox.min.css">
<link rel="stylesheet" href="/public/assets/css/sib-styles.css">

<link rel="stylesheet" href="/public/assets/wejune/css/style.css"><!-- original custom css -->
<link rel="stylesheet" href="/public/assets/css/lareponse.css"><!-- fixes to the custom css -->
<link href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.core.css" rel="stylesheet" />

<script src="/public/assets/js/tarteaucitron.js-1.19.0/tarteaucitron.min.js"></script>
<script type="text/javascript" nonce="<?= $CSP_nonce ?>">
    tarteaucitron.init({
        "privacyUrl": "",
        /* Privacy policy url */
        "bodyPosition": "bottom",
        /* or top to bring it as first element for accessibility */

        "hashtag": "#tarteaucitron",
        /* Open the panel with this hashtag */
        "cookieName": "tarteaucitron",
        /* Cookie name */

        "orientation": "middle",
        /* Banner position (top - bottom) */

        "groupServices": false,
        /* Group services by category */
        "showDetailsOnClick": true,
        /* Click to expand the description */
        "serviceDefaultState": "wait",
        /* Default state (true - wait - false) */

        "showAlertSmall": false,
        /* Show the small banner on bottom right */
        "cookieslist": false,
        /* Show the cookie list */

        "closePopup": false,
        /* Show a close X on the banner */

        "showIcon": true,
        /* Show cookie icon to manage cookies */
        //"iconSrc": "", /* Optionnal: URL or base64 encoded image */
        "iconPosition": "BottomRight",
        /* BottomRight, BottomLeft, TopRight and TopLeft */

        "adblocker": false,
        /* Show a Warning if an adblocker is detected */

        "DenyAllCta": true,
        /* Show the deny all button */
        "AcceptAllCta": true,
        /* Show the accept all button when highPrivacy on */
        "highPrivacy": true,
        /* HIGHLY RECOMMANDED Disable auto consent */
        "alwaysNeedConsent": false,
        /* Ask the consent for "Privacy by design" services */

        "handleBrowserDNTRequest": false,
        /* If Do Not Track == 1, disallow all */

        "removeCredit": false,
        /* Remove credit link */
        "moreInfoLink": true,
        /* Show more info link */

        "useExternalCss": false,
        /* If false, the tarteaucitron.css file will be loaded */
        "useExternalJs": false,
        /* If false, the tarteaucitron.js file will be loaded */

        //"cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for multisite */

        "readmoreLink": "",
        /* Change the default readmore link */

        "mandatory": true,
        /* Show a message about mandatory cookies */
        "mandatoryCta": true,
        /* Show the disabled accept button when mandatory on */

        //"customCloserId": "", /* Optional a11y: Custom element ID used to open the panel */

        "googleConsentMode": true,
        /* Enable Google Consent Mode v2 for Google ads and GA4 */

        "partnersList": false /* Show the number of partners on the popup/middle banner */
    });
</script>