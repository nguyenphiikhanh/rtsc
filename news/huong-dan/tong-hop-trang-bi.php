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
                <li><span>Tổng Hợp Về Trang Bị</span></li>
            </ul>
            <div class="main-content-news" data-aos="fade-up" data-aos-duration="700" data-aos-delay="1000">
                <div class="title-main-new">
                    <div class="title-left"><span class="f-tahomabold"></span> Tổng Hợp Về Trang Bị</div>
                    <div class="date-open-right  hidden-mobile">14/12/2025</div>
                </div>

                <div class="text-detail detail-post">
                    <p dir="ltr"><strong>Tổng Hợp Về Trang Bị</strong></p>

                    <h3><strong>1.Set Kích hoạt thông thường:</strong></h3>


                    <p><span style="color:#FF0000"><strong>◈ - Sét kích hoạt thường các bạn có thể mua trực tiếp tại santa...</strong></span>


                    <h3 dir="ltr"><strong>2. Set Kích hoạt Thần Linh:</strong></h3>

                    <p><span style="color:#FF0000"><strong>◈ - Cách 1: Đem 3 món đồ huỷ diệt ngẫu nhiên tới vách kakarot...</strong></span>

                    <p>
                        <span style="color:#FF0000"><strong>◈ - gặp Thợ rèn để nâng cấp trang bị Set Kích Hoạt VIP</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - (Ngẫu nhiên nhận đượng trang bị Set Kích Hoạt Thường hoặc Thần Linh đúng theo hành tinh của mình)</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - Cách 2: Mang 3 món đồ thiên sứ ngẫu nhiên tới hành tinh Bill</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - gặp NPC Whis để nâng cấp set kích hoạt thiên sứ</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - (Ngẫu nhiên nhận đượng trang bị Set Kích Hoạt Thần Linh,Huỷ diệt,Thiên sứ)</strong></span>

                    <h3 dir="ltr"><strong>3. Set Kích hoạt huỷ diệt:</strong></h3>

                    <p><span style="color:#FF0000"><strong>◈ - Cách 1:Mang 3 món đồ thiên sứ ngẫu nhiên tới hành tinh Bill</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - gặp NPC Whis để nâng cấp set kích hoạt thiên sứ</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - (Ngẫu nhiên nhận đượng trang bị Set Kích Hoạt Thần Linh,Huỷ diệt,Thiên sứ)</strong></span>

                    <h3 dir="ltr"><strong>4. Set Kích hoạt Thiên Sứ:</strong></h3>

                    <p><span style="color:#FF0000"><strong>◈ - Cách 1:Mang 3 món đồ thiên sứ ngẫu nhiên tới hành tinh Bill</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - gặp NPC Whis để nâng cấp set kích hoạt thiên sứ</strong></span>

                    <p><span style="color:#FF0000"><strong>◈ - (Ngẫu nhiên nhận đượng trang bị Set Kích Hoạt Thần Linh,Huỷ diệt,Thiên sứ)</strong></span>


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
