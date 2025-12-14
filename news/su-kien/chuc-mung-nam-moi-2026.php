<?php
require_once __DIR__ . '/../../helper/helper.php';
?>
<!DOCTYPE html>
<html lang="vi" class="__roots root__page">

<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<?php
$title_label = 'Tổng Hợp Về Trang Bị';
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
                <li><span>Tích Lũy Nạp 19/11 - 21/11</span></li>
            </ul>
            <div class="main-content-news" data-aos="fade-up" data-aos-duration="700" data-aos-delay="1000">
                <div class="title-main-new">
                    <div class="title-left"><span class="f-tahomabold"></span> Tích Lũy Nạp 19/11 - 21/11</div>
                    <div class="date-open-right  hidden-mobile">18/11/2025</div>
                </div>

                <div class="text-detail detail-post">

                    <h3 dir="ltr"><strong>SỰ KIỆN THU THẬP BÁNH TẾT:</strong></h3>

                    <p><span style="color:#FF0000"><strong>◈ - Mỗi lần nạp mệnh giá 50.000đ sẽ nhận được 1 Gifcode (1.000 nghìn các loại vật phẩm quy đổi sự kiện)</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - (Khi Mở Hộp Sẽ Được Tính Điểm 10Đ/1 Hộp)</strong></span>

                    <h3 dir="ltr"><strong>Cách Thức Tham Gia Sự Kiện:</strong></h3>

                    <p><span style="color:#FF0000"><strong>◈ - Đánh quái tại các map (Cánh Đồng Tuyết - Dòng Sông Băng - Rừng Băng)</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - Thu thập 4 loại vật phẩm (Thịt heo / Thúng nếp / Thúng đậu xanh / Lá dong )</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - Thu thập Bánh tét / Bánh chưng ở các boss (Sơn Tinh / Thuỷ Tinh / Mị Nương / Khủng Long 1 Đến Khủng Long 7 )</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - Quy Đổi Tại Đảo Kame ( Nồi Bánh )</strong></span>

                    <h3 dir="ltr"><strong>CÁC PHẦN QUÀ CỰC KÌ HẤP DẪN ĐANG CHỜ BẠN Ở SỰ KIỆN TẾT</strong></h3>


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
