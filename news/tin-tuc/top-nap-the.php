<?php
require_once __DIR__ . '/../../helper/helper.php';
require_once __DIR__ . '/../../modules/topnap.php';

$data_top_nap = __get_top_nap();
?>
<!DOCTYPE html>
<html lang="vi" class="__roots root__page">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang Chủ - Nro Ghost</title>
    <link rel="shortcut icon" type="ico" href="../../favicon.ico" />

    <meta name="description" content="Rồng Thần Siêu Cấp, Game chiến thuật trên mobile đề tài Dragon ball với nhiều tính năng hấp dẫn, tính chiến thuật cao và đầy đủ các nhân vật như Songoku, Vegeta, Android 18, Bulma,..." />
    <meta name="keywords" content="Dragon ball, game dragon ball, songoku, vegeta, quy lão tiên sinh, game dragon ball mobile, game chiến thuật" />

    <meta property="fb:app_id" content="" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content=" Trang Chủ - Nro Ghost " />
    <meta property="og:description" content="Rồng Thần Siêu Cấp, Game chiến thuật trên mobile đề tài Dragon ball với nhiều tính năng hấp dẫn, tính chiến thuật cao và đầy đủ các nhân vật như Songoku, Vegeta, Android 18, Bulma,..." />

    <meta property="og:site_name" content=" Trang Chủ - Nro Ghost" />
    <meta property="og:image" content="../../assets/frontend/teaser/images/thumb.jpg" />
    <meta property="og:image:alt" content="Rồng Thần Siêu Cấp, Game chiến thuật trên mobile đề tài Dragon ball với nhiều tính năng hấp dẫn, tính chiến thuật cao và đầy đủ các nhân vật như Songoku, Vegeta, Android 18, Bulma,..." />

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            '../../../www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PRJRSS5');</script>
    <!-- End Google Tag Manager -->

    <link rel="stylesheet" href="../../assets/frontend/home/v1/css/slick-theme.css" />
    <link rel="stylesheet" href="../../assets/frontend/home/v1/css/slick.css" />
    <link rel="stylesheet" href="../../assets/frontend/home/v1/css/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="../../assets/frontend/home/v1/css/aos.css" />
    <link rel="stylesheet" href="../../assets/frontend/home/v1/css/stylea6ca.css?v=919" />
</head>

<body class="body-news">

<!--    header-->
<?php require_once __DIR__ . '/../../layout/header.php'; ?>
<!--end header-->
<section class="__section game--brand__show __1">
    <div class="bg_video">
        <video id="videoBgPC" class="videobg hidden__mobile" muted="" loop="" preload="none" webkit-playsinline=""
               playsinline="">
            <source src="../../assets/frontend/teaser/videos/g.mp4" type="video/mp4" />
        </video>
    </div>
    <div class="limit__game">
        <div class="main--game__show">
            <div class="text--brand t-center m-auto p-relative" data-aos="fade-down" data-aos-duration="700"
                 data-aos-delay="100">
                <a href="https://www.youtube.com/" data-fancybox="" style="display: none">
                    <img class="icon-play" src="../../assets/frontend/home/v1/images/icon-play.png" alt="" />
                </a>
                <img src="../../assets/frontend/home/v1/images/textgame.png" alt="" class="textgame__game" />
            </div>
        </div>

        <div class="box--download jCenter">

            <div class="list-link-dl">
                <!-- tai game apple -->
                <a target="_blank" href="https://apps.apple.com/vn/app/id6446673495?l=vi" class="item-link link-apple">
                    <img class="img-ac" src="../../assets/frontend/home/v1/images/btn-dl/btn-dl.png" alt="" />
                    <img class="img-hv" src="../../assets/frontend/home/v1/images/btn-dl/btn-dl-hv.png" alt="" />
                </a>

                <!-- tai game android https://play.google.com/store/apps/details?id=com.rongthansieucap.gg -->

                <a  href="https://play.google.com/store/apps/details?id=com.rtsc.ultracombo" class="item-link link-android">
                    <img class="img-ac" src="../../assets/frontend/home/v1/images/btn-dl/btn-dl-android.png" alt="" />
                    <img class="img-hv" src="../../assets/frontend/home/v1/images/btn-dl/btn-dl-android-hv.png" alt="" />
                </a>
                <!-- tai game apk -->
                <a target="_blank" href="https://cdn.acegame.vn/RongThan.apk" class="item-link link-android">
                    <img class="img-ac" src="../../assets/frontend/home/v1/images/btn-dl/btn-dl-apk.png" alt="" />
                    <img class="img-hv" src="../../assets/frontend/home/v1/images/btn-dl/btn-dl-apk-hv.png" alt="" />
                </a>

                <!-- tai game nap the -->
                <a target="_blank" href="https://pay.acegame.vn/game/db186" class="item-link link-card">
                    <img class="img-ac" src="../../assets/frontend/home/v1/images/btn-dl/btn-card.png" alt="" />
                    <img class="img-hv" src="../../assets/frontend/home/v1/images/btn-dl/btn-card-hv.png" alt="" />
                </a>

                <!-- tai game fanpage -->
                <a target="_blank" href="https://www.facebook.com/rongthansieucap" class="item-link link-fb">
                    <img class="img-ac" src="../../assets/frontend/home/v1/images/btn-dl/btn-fb.png" alt="" />
                    <img class="img-hv" src="../../assets/frontend/home/v1/images/btn-dl/btn-fb-hv.png" alt="" />
                </a>
            </div>



        </div>

        <div class="tCenter hidden__PC">
            <a target="_blank" href="../../su-kien/phuc-loi-nap-2025.php">
                <img src="../../assets/frontend/home/v1/images/bn__gift_now.png" class="gift__site">
            </a>
        </div>

        <style>
            .gift__site {
                width: 23vw;
                max-width: 170px;
            }
        </style>

    </div>
</section>


<div class="box--content">
    <div class="main__news">
        <div class="limit__game">
            <ul class="breadcrumb p-r" data-aos="fade-up" data-aos-duration="700" data-aos-delay="700">
                <li class="current"><a href="<?= define_url("home.php") ?>">Trang chủ</a></li>
                <li><span>Top Nạp Thẻ</span></li>
            </ul>
            <div class="main-content-news" data-aos="fade-up" data-aos-duration="700" data-aos-delay="1000">
                <div class="title-main-new">
                    <div class="title-left"><span class="f-tahomabold"></span>Top Nạp Thẻ</div>
<!--                    <div class="date-open-right hidden-mobile">29/04/2025</div>-->
                </div>

                <div class="text-detail detail-post">
                    <h2 dir="ltr" style="text-align:center"><big><strong>Top Nạp Thẻ</strong></big></h2>

                    <?php if(count($data_top_nap)){ ?>
                        <table align="center">
                            <tbody>
                            <tr>
                                <td>
                                    <p dir="ltr" style="text-align:center"><strong>Top</strong></p>
                                </td>
                                <td>
                                    <p dir="ltr" style="text-align:center"><strong>Người chơi</strong></p>
                                </td>
                                <td>
                                    <p dir="ltr" style="text-align:center"><strong>Tổng nạp</strong></p>
                                </td>
                                <td>
                                    <p dir="ltr" style="text-align:center"><strong>Phúc lợi</strong></p>
                                </td>
                            </tr>
                            <?php foreach ($data_top_nap as $index => $data) { ?>
                                <tr>
                                    <td>
                                        <p dir="ltr" style="text-align:center"><?= $index + 1 ?></p>
                                    </td>
                                    <td>
                                        <p dir="ltr" style="text-align:center"><?= htmlspecialchars($data['name']) ?></p>
                                    </td>
                                    <td>
                                        <p dir="ltr" style="text-align:center"><?= number_format($data['tongnap'], 0, ',', '.'); ?> tỷ vnđ</p>
                                    </td>
                                    <td>
                                        <p dir="ltr" style="text-align:left">- Mạnh top <?= $index + 1 ?> server, trong thiên hạ không có đối thủ.</p>
                                        <p dir="ltr" style="text-align:left">- Được búng vào dái thằng ad <?= 100 - $index*10 ?> phát.</p>
                                        <p dir="ltr" style="text-align:left">- Được búng vào dái thằng ad <?= 100 - $index*10 ?> phát.</p>
                                        <p dir="ltr" style="text-align:left">- Được búng vào dái thằng ad <?= 100 - $index*10 ?> phát(quan trọng nhắc lại 3 lần :v).</p>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php } else {
                        echo "<p>Chưa có dữ liệu nạp thẻ.</p>";
                    } ?>
                </div>

            </div>
        </div>
    </div>
</div>

<!--    footer-->
<?php include_once __DIR__ . '/../../layout/footer.php'; ?>
<!--end footer-->
<style>

    .footer-ace {
        width: 100%;
        padding: 40px 0 30px;
        text-align: center;
        color: #fff;
        background: #181818;
        font-family: Tahoma, Arial, Helvetica, sans-serift;
        font-size: 14px;
        line-height: 1.5;
    }
    .footer-link-privacy {
        margin-bottom: 10px;
    }
    .footer-link-privacy a {
        color: #fff;
        text-decoration: none;
    }
    .footer-link-privacy a:hover {
        color: #ffa000;
    }
    .footer-ace p {
        margin-bottom: 6px;
    }
    .footer-ace-inner {
        width: 100%;
        max-width: 1000px;
        color: #fff;
        font-size: 13px;
        text-align: center;
        position: relative;
        margin: 0 auto
    }

    .faq-tink {
        position: absolute;
        display: block;
        text-indent: -999em;
        background: url(../../assets/frontend/home/v1/images/logoNew) 0 0 no-repeat;
        background-size: contain;
        width: 110px;
        height: 55px;
        left: 0;
        top: -10px;
    }

    .footer-ace-18 {
        position: absolute;
        right: 0;
        top: 0;
        max-width: 160px;
        object-fit: contain;
        object-position: top center;
    }

    /*media */
    @media (max-width: 768px) {
        .faq-tink {
            position: inherit;
            top: 0;
            margin: 0 auto 10px;
        }
        .footer-ace-18 {
            display: block;
            position: relative;
            left: 50%;
            margin-top: 10px;
            /* margin-left: -30px; */
            transform: translateX(-50%);
            margin-left: 0;
        }
    }
</style>

<?php require_once __DIR__ . '/../../components/sidebar-right.php'; ?>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PRJRSS5"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>


<script type="text/javascript" src="../../assets/frontend/home/v1/js/jquery.min.js"></script>
<script type="text/javascript" src="../../assets/frontend/home/v1/js/ScrollMagic.min.js"></script>
<script type="text/javascript" src="../../assets/frontend/home/v1/js/aos.js"></script>
<script type="text/javascript" src="../../assets/frontend/home/v1/js/slick.min.js"></script>
<script type="text/javascript" src="../../assets/frontend/home/v1/js/jquery.fancybox.min.js"></script>
<script>
    function goBack() {
        window.history.back();
    }
    $('.ctFixRight').click(function () {
        $('.sidebar_right').toggleClass('mo');
        $(this).toggleClass('ctFixRight-mo');
    });
    // anchor click Nav Right
    $(".i-control").click(function () {
        $(".nav-right").toggleClass("open");
        $(this).toggleClass("i-control-open"); // active bg btn
    });
    // gotop
    var offset = 1080;
    go_top = $(".go-top");
    go_top.click(function () {
        $("html,body").animate({ scrollTop: 0 }, 100);
    });
</script>

<script>
    if ($(".main__news")[0]) {
        setTimeout(function () {
            $("html, body").animate(
                {
                    scrollTop: $(".main__news").offset().top,
                },
                500
            );
        }, 500);
    }
    AOS.init({
        once: true,
    });

    // sllick slide new
    $(".listSlide__new").slick({
        dots: true,
        prevArrow: false,
        nextArrow: false,
        autoplay: true,
        speed: 500,
    });

    const animationLogo = document.querySelector(".text--brand");
    animationLogo.classList.add("active");
    setInterval(() => {
        animationLogo.classList.remove("active");
        setTimeout(() => {
            animationLogo.classList.add("active");
        }, 200);
    }, 7000);

    $(document).ready(function () {
        function handlePlay() {
            let _width = $(window).width();
            if (_width >= 1200) {
                $("#videoBgPC").get(0).play();
                $(".textgame__game").css("opacity", 0);
            } else {
                // $('#videoBgMb').get(0).play()
                $(".textgame__game").css("opacity", 1);
            }
        }
        $(window).on("resize", function () {
            handlePlay();
        });
        $(window).on("scroll load", function () {
            handlePlay();
        });

        $(".slide__feature").slick({
            infinite: true,
            autoplay: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            dots: true,
        });

        // tab new
        $(".tab-new .tab-link").click(function () {
            var tab_id = $(this).attr("data-tab");
            var tab_view = $(this).attr("data-more");

            $(".tab-new .tab-link").removeClass("current");
            $(".tab-detail").removeClass("current");
            $(".link-more").removeClass("current");

            $(this).addClass("current");
            $("#" + tab_id).addClass("current");
            $("#" + tab_view).addClass("current");
        });
    });
</script>
<?php echo load_script([
    'assets/js/modal-helper.js'
]) ?>

</html>
