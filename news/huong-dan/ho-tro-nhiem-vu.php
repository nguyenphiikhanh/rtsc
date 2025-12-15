<?php
require_once __DIR__ . '/../../helper/helper.php';
?>
<!DOCTYPE html>
<html lang="vi" class="__roots root__page">

<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<?php
$title_label = 'Hỗ Trợ Nhiệm Vụ';
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
                <li><span>HỖ TRỢ NHIỆM VỤ</span></li>
            </ul>
            <div class="main-content-news" data-aos="fade-up" data-aos-duration="700" data-aos-delay="1000">
                <div class="title-main-new">
                    <div class="title-left"><span class="f-tahomabold"></span>HỖ TRỢ NHIỆM VỤ</div>
                    <div class="date-open-right  hidden-mobile">14/12/2025</div>
                </div>

                <div class="text-detail detail-post">
                    <p><strong>◈&nbsp;</strong><strong>HỖ TRỢ NHIỆM VỤ</strong></p>

                    <p><strong>Tính năng hỗ trợ nhiệm vụ</strong></p>

                    <p>
                        <span style="color:#FF0000"><strong>◈ -  Gặp NPC taih Đảo kame ấn vào ô Skip Nhiệm Vụ</strong></span>

                    <p><strong>Để có thể bỏ qua các nhiệm vụ như:</strong></p>


                    <p><span style="color:#FF0000"><strong>◈ - Kết bạn với người Trái đất</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - Kết bạn với người Namex</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - Kết bạn với người Xayda</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - Gia nhập bang có 3 thành viên</strong></span>

                    <p>
                        <span style="color:#FF0000"><strong>◈ - nhiệm vụ heo rừng - bulon có thể tự tạo pt và đánh 1 mình</strong></span>


                </div>

            </div>
        </div>
    </div>
</div>

<!--    footer-->
<?php include_once __DIR__ . '/../../layout/footer.php'; ?>
<!--end footer-->

<?php require_once __DIR__ . '/../../components/sidebar-right.php'; ?>

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
