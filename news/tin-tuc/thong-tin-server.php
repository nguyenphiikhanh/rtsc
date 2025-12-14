<?php
require_once __DIR__ . '/../../helper/helper.php';
?>
<!DOCTYPE html>
<html lang="vi" class="__roots root__page">

<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<?php
$title_label = '[UPDATE] Thông tin chi tiết sever';
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
                <li class="current"><a href="../../home.php">Trang chủ</a></li>
                <li><span>[UPDATE] Thông tin chi tiết sever</span></li>
            </ul>
            <div class="main-content-news" data-aos="fade-up" data-aos-duration="700" data-aos-delay="1000">
                <div class="title-main-new">
                    <div class="title-left"><span class="f-tahomabold"></span> [UPDATE] Thông tin chi tiết sever</div>
                    <div class="date-open-right  hidden-mobile">14/12/2025</div>
                </div>

                <div class="text-detail detail-post">
                    <h3 dir="ltr" style="text-align:center"><strong>Thông tin chi tiết sever</strong></h3>

                    <h3 dir="ltr" style="text-align:center"><strong>Tất cả đệ tử sever đều có thể săn được</strong></h3>


                    <p>
                        <span style="color:#FF0000"><strong>◈ - Đệ tử Mabu : Săn Boss Super Broly nhận trứng Đệ tử Mabu</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - Đệ tử Berus : Giết Boss Whis (Săn Đệ) tại Tương lai nhận Đệ tử Berus</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - Đệ tử Zeno : Giết Boss Zeno tại Cold nhận Hồn Zeno và đọc Thông tin Hồn Zeno để biết thêm chi tiết</strong></span>

                    <p>
                        <span style="color:#FF0000"><strong>◈ - Đệ tử Ngộ Không : Giết Boss Ngộ Không tại ngũ hành sơn</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - Đệ tử itachi : Giết Boss itachi (Cần rất đông thành viên bang mới ăn được)</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - Đệ tử Kaido : Giết Boss Kaido (Cần rất đông thành viên bang mới ăn được)</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - Đệ tử Đệ VIP - Tiên Hắc Ám : Giết Boss Tiên Hắc Ám (Cần rất đông thành viên bang mới ăn được)</strong></span>


                </div>

            </div>
        </div>
    </div>
</div>

<!--    footer-->
<?php include_once __DIR__ . '/../../layout/footer.php'; ?>
<!--end footer-->

<?php require_once __DIR__ . '/../../components/sidebar-right.php'; ?>

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PRJRSS5"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
</body>


<script type="text/javascript" src="<?= define_url("assets/frontend/home/v1/js/jquery.min.js") ?>"></script>
<script type="text/javascript" src="<?= define_url("assets/frontend/home/v1/js/ScrollMagic.min.js") ?>"></script>
<script type="text/javascript" src="<?= define_url("assets/frontend/home/v1/js/aos.js") ?>"></script>
<script type="text/javascript" src="<?= define_url("assets/frontend/home/v1/js/slick.min.js") ?>"></script>
<script type="text/javascript" src="<?= define_url("assets/frontend/home/v1/js/jquery.fancybox.min.js") ?>"></script>
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
        $("html,body").animate({scrollTop: 0}, 100);
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
