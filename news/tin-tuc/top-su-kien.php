<?php
require_once __DIR__ . '/../../helper/helper.php';
require_once __DIR__ . '/../../modules/top-su-kien.php';

$data_top_events = __get_top_event();
?>
<!DOCTYPE html>
<html lang="vi" class="__roots root__page">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<?php
$title_label = 'Cao thủ sự kiện';
require_once __DIR__ . '/../../layout/head.php';
?>

<body class="body-news">

<!--    header-->
<?php require_once __DIR__ . '/../../layout/header.php'; ?>
<!--end header-->
<?php require_once __DIR__ . '/../../components/banner.php'; ?>


<div class="box--content">
    <div class="main__news">
        <div class="limit__game">
            <ul class="breadcrumb p-r" data-aos="fade-up" data-aos-duration="700" data-aos-delay="700">
                <li class="current"><a href="<?= define_url("home.php") ?>">Trang chủ</a></li>
                <li><span>Top Sự Kiện</span></li>
            </ul>
            <div class="main-content-news" data-aos="fade-up" data-aos-duration="700" data-aos-delay="1000">
                <div class="title-main-new">
                    <div class="title-left"><span class="f-tahomabold"></span>Top Sự Kiện</div>
                </div>

                <div class="text-detail detail-post bg-top-nap">
                    <div class="tCenter" style="margin:0 0 18px;">
                        <h2 class="title-inline" aria-level="2" role="heading" style="margin:0;">
                            <div class="clickGet m__inline">
                                <span class="a100 f-tahomabold tCenter tUpper dFlex aCenter jCenter">
                                    Top Sự Kiện
                                    </span>
                            </div>
                        </h2>
                    </div>

                    <?php if(count($data_top_events)){ ?>
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
                                    <p dir="ltr" style="text-align:center"><strong>Điểm Sự Kiện</strong></p>
                                </td>
                                <td>
                                    <p dir="ltr" style="text-align:center"><strong>Phúc lợi</strong></p>
                                </td>
                            </tr>
                            <?php foreach ($data_top_events as $index => $data) { ?>
                                <tr>
                                    <td>
                                        <p dir="ltr" style="text-align:center; color: white"><?= $index + 1 ?></p>
                                    </td>
                                    <td>
                                        <p dir="ltr" style="text-align:center;color: white"><?= htmlspecialchars($data['name']) ?></p>
                                    </td>
                                    <td>
                                        <p dir="ltr" style="text-align:center;color: white"><?= number_format($data['su_kien_new'] ?? 0) ?> <sup>Điểm</sup></p>
                                    </td>
                                    <td>
                                        <p dir="ltr" style="text-align:left;color: white">- Mạnh top <?= $index + 1 ?> server, trong thiên hạ không có đối thủ.</p>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php } else {
                        echo "<p>Chưa có dữ liệu Sự Kiện.</p>";
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
    .bg-top-nap{
        /*background: url("../../assets/frontend/events/flashsalecuoituan2023/images/full__big.jpg");*/
        background: url("../../assets/frontend/home/v1/images/bigFT.png");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
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
