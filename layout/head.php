<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../helper/helper.php';
require_once __DIR__ . '/../constants/constants.php';
require_once __DIR__ . '/../constants/seo.php';
global $webname;
global $banner_img;
function page_title($title_label = 'Trang Chủ') {
    return $title_label;
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= page_title($title_label ?? 'Trang chủ') ?> - <?= SEO_WEB_NAME ?></title>
    <link rel="shortcut icon" type="ico" href="<?= define_url("favicon.ico")?>"/>

    <meta name="description"
          content="<?=SEO_WEB_DESCRIPTION?>"/>
    <meta name="keywords"
          content="<?=SEO_WEB_KEYWORDS?>"/>

    <meta property="fb:app_id" content=""/>
    <meta property="og:locale" content="vi_VN"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="<?= page_title($title_label ?? 'Trang chủ') ?> - <?= SEO_WEB_NAME ?>"/>
    <meta property="og:description"
          content="<?=SEO_WEB_OG_DESCRIPTION?>"/>

    <meta property="og:site_name" content="<?= page_title($title_label ?? 'Trang chủ') ?> - <?= SEO_WEB_NAME ?>"/>
    <meta property="og:image" content="<?= $banner_img ?>"/>
    <meta property="og:image:alt"
          content="<?=SEO_WEB_DESCRIPTION?>"/>

    <?php
    echo load_css([
        'assets/frontend/events/phucloinap2025/css/lib.css',
        'assets/frontend/events/phucloinap2025/css/style.css',
    ]);
    ?>

    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                '../../../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PRJRSS5');</script>
    <!-- End Google Tag Manager -->

    <link rel="stylesheet" href="<?= define_url("assets/frontend/home/v1/css/slick-theme.css") ?>"/>
    <link rel="stylesheet" href="<?= define_url("assets/frontend/home/v1/css/slick.css") ?>"/>
    <link rel="stylesheet" href="<?= define_url("assets/frontend/home/v1/css/jquery.fancybox.min.css") ?>"/>
    <link rel="stylesheet" href="<?= define_url("assets/frontend/home/v1/css/aos.css") ?>"/>
    <link rel="stylesheet" href="<?= define_url("assets/frontend/home/v1/css/stylea6ca.css?v=919") ?>"/>
</head>
