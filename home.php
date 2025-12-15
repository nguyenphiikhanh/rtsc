<?php
require_once __DIR__ . '/./middleware/auth.php';
require_once __DIR__ . '/./helper/helper.php';
require_once __DIR__ . '/./modules/audit.php';
if (empty($_SESSION['audit_load'])) {
    audit_server_load();
    $_SESSION['audit_load'] = true;
}
?>
<!DOCTYPE html>
<html lang="vi" class="__roots root__page">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<?php
$title_label = 'Trang chủ';
require_once __DIR__ . '/./layout/head.php';
?>

<body>

<!--    header-->
<?php require_once __DIR__ . '/./layout/header.php'; ?>
<!--end header-->
<?php require_once __DIR__ . '/./components/banner.php'; ?>

<?php require_once __DIR__ . '/./components/box-content.php'; ?>

<?php require_once __DIR__ . '/./components/tinhnang-carousel.php'; ?>

<!--    footer-->
<?php include_once __DIR__ . '/./layout/footer.php'; ?>
<!--end footer-->

<?php require_once __DIR__ . '/./components/sidebar-right.php'; ?>

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PRJRSS5"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
</body>


<script type="text/javascript" src="<?= define_url("assets/frontend/home/v1/js/jquery.min.js")?>"></script>
<script type="text/javascript" src="<?= define_url("assets/frontend/home/v1/js/ScrollMagic.min.js")?>"></script>
<script type="text/javascript" src="<?= define_url("assets/frontend/home/v1/js/aos.js")?>"></script>
<script type="text/javascript" src="<?= define_url("assets/frontend/home/v1/js/slick.min.js")?>"></script>
<script type="text/javascript" src="<?= define_url("assets/frontend/home/v1/js/jquery.fancybox.min.js")?>"></script>
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

    function validateForm(event) {
        // Ngăn form gửi đi để demo hiển thị SweetAlert
        event.preventDefault();

        // Lấy giá trị input
        const username = $('#username_register').val();
        // const password = document.querySelector('input[name="password"]').value;

        // Demo logic kiểm tra đơn giản
        if (!/^[a-zA-Z0-9]+$/.test(username)) {
            alert('Tên người dùng không hợp lệ! (Chỉ chữ và số)');
            return false;
        }

        // gửi form đi
        event.target.submit();
    }

</script>
<?php echo load_script([
    'assets/js/modal-helper.js'
]) ?>
</html>