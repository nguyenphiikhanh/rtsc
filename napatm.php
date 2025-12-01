<?php
require_once __DIR__ . '/./auth/auth.php';
require_once __DIR__ . '/./helper/helper.php';
auth();
?>
<!DOCTYPE html>
<html lang="vi" class="__roots root__page">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang Chủ - Nro Ghost</title>
    <link rel="shortcut icon" type="ico" href="favicon.ico"/>

    <meta name="description"
          content="Rồng Thần Siêu Cấp, Game chiến thuật trên mobile đề tài Dragon ball với nhiều tính năng hấp dẫn, tính chiến thuật cao và đầy đủ các nhân vật như Songoku, Vegeta, Android 18, Bulma,..."/>
    <meta name="keywords"
          content="Dragon ball, game dragon ball, songoku, vegeta, quy lão tiên sinh, game dragon ball mobile, game chiến thuật"/>

    <meta property="fb:app_id" content=""/>
    <meta property="og:locale" content="vi_VN"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content=" Trang Chủ - Nro Ghost "/>
    <meta property="og:description"
          content="Rồng Thần Siêu Cấp, Game chiến thuật trên mobile đề tài Dragon ball với nhiều tính năng hấp dẫn, tính chiến thuật cao và đầy đủ các nhân vật như Songoku, Vegeta, Android 18, Bulma,..."/>

    <meta property="og:site_name" content=" Trang Chủ - Nro Ghost"/>
    <meta property="og:image" content="assets/frontend/teaser/images/thumb.jpg"/>
    <meta property="og:image:alt"
          content="Rồng Thần Siêu Cấp, Game chiến thuật trên mobile đề tài Dragon ball với nhiều tính năng hấp dẫn, tính chiến thuật cao và đầy đủ các nhân vật như Songoku, Vegeta, Android 18, Bulma,..."/>

    <?php
    echo load_css([
        'assets/frontend/events/phucloinap2025/css/lib.css',
        'assets/frontend/events/phucloinap2025/css/style.css',
    ]);
    ?>

    <link rel="stylesheet" href="assets/frontend/home/v1/css/slick-theme.css"/>
    <link rel="stylesheet" href="assets/frontend/home/v1/css/slick.css"/>
    <link rel="stylesheet" href="assets/frontend/home/v1/css/jquery.fancybox.min.css"/>
    <link rel="stylesheet" href="assets/frontend/home/v1/css/aos.css"/>
    <link rel="stylesheet" href="assets/frontend/home/v1/css/stylea6ca.css?v=919"/>

    <!-- Add ATM section styles (no bootstrap) -->
    <style>
        /* ATM section styles (keeps home look) */
        .atm-section { padding: 30px 0; }
        .atm-card { background: rgba(28,28,28,0.95); border:2px solid #ffc107; border-radius: 12px; padding:18px; box-shadow:0 8px 30px rgba(0,0,0,0.6); color:#fff; }
        .atm-title { font-family: 'Be Vietnam Pro', sans-serif; color:#ffcc00; font-weight:900; text-transform:uppercase; text-align:center; text-shadow:0 0 6px #ffeb3b; margin-bottom:18px; }
        .two-col { display:flex; gap:18px; flex-wrap:wrap; align-items:stretch; }
        .two-col .col { flex:1 1 300px; min-width:260px; }
        .qr-img { max-width:100%; border-radius:6px; border:2px solid #fff; display:block; margin: 0 auto; }
        .glow-box { border-radius:10px; padding:14px; border:2px solid #ffc107; box-shadow:0 0 18px #ffc107; background: linear-gradient(180deg, rgba(30,30,30,0.95), rgba(22,22,22,0.9)); height:100%; }
        .glow-text { color:#fff; font-weight:800; text-shadow:0 0 8px #ffeb3b; margin-bottom:12px; text-align:center; }
        .info-table td { padding:8px 6px; color:#fff; }
        .textinfo { border-radius:6px; padding:12px; background: rgba(0,0,0,0.5); border:1px solid #ffc107; color:#ffc107; font-weight:700; text-align:center; }
        .btn-confirm { display:inline-block; background:linear-gradient(#ffc107,#ff9800); color:#000; font-weight:900; padding:12px 30px; border-radius:40px; box-shadow:0 0 18px #ffc107; border:none; cursor:pointer; text-transform:uppercase; }
        .btn-home { display:inline-flex; align-items:center; color:#ddd; text-decoration:none; padding:8px 18px; border-radius:30px; background:rgba(0,0,0,0.6); border:1px solid rgba(255,255,255,0.12); font-weight:700; }
        .btn-home:hover { color:#ffc107; border-color:#ffc107; transform:translateX(-4px); }
        .spinner { display:inline-block; width:14px; height:14px; border-radius:50%; border:2px solid rgba(255,193,7,0.25); border-top-color:#ffc107; animation:spin 0.9s linear infinite; margin-left:8px; vertical-align:middle; }
        @keyframes spin{0%{transform:rotate(0deg);}100%{transform:rotate(360deg);}}
        /* Modal */
        .modal-overlay { position:fixed; inset:0; display:none; justify-content:center; align-items:center; background:rgba(0,0,0,0.75); z-index:9999; }
        .modal-overlay.active { display:flex; }
        .modal-box { background:#151515; border:2px solid #ffc107; border-radius:10px; padding:20px; width:95%; max-width:420px; text-align:center; color:#fff; box-shadow:0 0 30px #ffc107; transform:scale(0.95); transition:transform .2s ease; }
        .modal-box h3 { color:#ffcc00; margin-bottom:8px; text-transform:uppercase; }
        .modal-box p { color:#ddd; margin-bottom:12px; }
        .btn-close-modal { background:#444; color:#fff; padding:8px 20px; border-radius:20px; border:1px solid #666; cursor:pointer; }
        .btn-close-modal:hover { background:#ffc107; color:#000; }

        /* New: make atm-section width match the centered video (videoBgPC)
           - Use a sensible centered max-width (1200px) which typically matches the video container.
           - On small screens fall back to 90vw so layout remains responsive.
        */
        .atm-section { width:100%; }
        .atm-section > .limit__game { max-width: 1200px; width: 100%; margin: 0 auto; padding-left: 16px; padding-right: 16px; box-sizing: border-box; }
        .atm-card { max-width: 1100px; margin: 0 auto; } /* keep card constrained inside the same centered band */

        @media (max-width: 1300px) {
            .atm-section > .limit__game { max-width: 1000px; }
            .atm-card { max-width: 960px; }
        }
        @media (max-width: 900px) {
            .atm-section > .limit__game { max-width: 90vw; padding-left: 8px; padding-right: 8px; }
            .atm-card { max-width: 100%; }
            .two-col { gap:12px; }
        }
    </style>

    <!-- ...existing code... -->
</head>
<body>
<!--    header-->
<?php require_once __DIR__ . '/./layout/header.php'; ?>
<!--end header-->
<section class="__section game--brand__show __1">
    <div class="bg_video">
        <video id="videoBgPC" class="videobg hidden__mobile" muted="" loop="" preload="none" webkit-playsinline=""
               playsinline="">
            <source src="assets/frontend/teaser/videos/g.mp4" type="video/mp4"/>
        </video>
    </div>
    <div class="limit__game">
        <div class="main--game__show">
            <!-- <div class="logo t-center">
            <a href="#">
              <img src="/assets/frontend/home/v1/rtsc.png" alt="">
            </a>
          </div> -->
            <div class="text--brand t-center m-auto p-relative" data-aos="fade-down" data-aos-duration="700"
                 data-aos-delay="100">
                <a href="https://www.youtube.com/" data-fancybox="" style="display: none">
                    <img class="icon-play" src="assets/frontend/home/v1/images/icon-play.png" alt=""/>
                </a>
                <img src="assets/frontend/home/v1/images/textgame.png" alt="" class="textgame__game"/>
            </div>
        </div>

        <div class="box--download jCenter">


            <!-- Insert ATM section here (keeps site header/footer/background) -->
            <section class="__section atm-section">
                <div class="limit__game">
                    <div class="atm-card">
                        <h2 class="atm-title">Nạp ATM - Chuyển khoản</h2>
                        <div class="two-col" id="atm_box">
                            <div class="col">
                                <div class="glow-box">
                                    <div class="glow-text">Cách 1: Quét mã QR</div>
                                    <img src="https://qr.sepay.vn/img?bank=MBBank&acc=6004012002&template=compact&des=assassin12345" alt="QR" class="qr-img" />
                                    <div style="text-align:center; margin-top:12px; font-weight:700; color:#ffc107;">
                                        <span>⏳ Trạng thái:</span>
                                        <span style="color:#fff; margin-left:6px">Chờ thanh toán...</span>
                                        <span class="spinner" aria-hidden="true"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="glow-box" style="display:flex; flex-direction:column; justify-content:center;">
                                    <div class="glow-text">Cách 2: Chuyển khoản thủ công</div>
                                    <img src="https://qr.sepay.vn/assets/img/banklogo/MB.png" alt="MB" style="max-height:44px; display:block; margin:0 auto 8px">
                                    <p style="text-align:center; font-weight:800; color:#fff; margin:0 0 10px;">Ngân hàng MBBank</p>

                                    <table class="info-table" style="width:100%; margin-bottom:8px;">
                                        <tbody>
                                        <tr><td style="width:45%; color:#ccc;">Chủ tài khoản:</td><td><strong style="color:#ffc107">NGUYEN QUOC DUY</strong></td></tr>
                                        <tr><td style="color:#ccc;">Số tài khoản:</td><td><strong style="color:#00d1ff; font-size:1.1rem">6004012002</strong></td></tr>
                                        <tr><td style="color:#ccc;">Nội dung:</td><td><strong style="background:#fff; padding:2px 6px; border-radius:3px; color:#d32f2f">assassin12345</strong></td></tr>
                                        </tbody>
                                    </table>

                                    <div style="font-size:0.9rem; margin-top:6px;">
                                        <div style="background:#0d0d0d; padding:8px; border-radius:6px; color:#fff; margin-bottom:6px;">💡 Copy chính xác <b>Nội dung</b> (Mã GD).</div>
                                        <div style="background:#0d0d0d; padding:8px; border-radius:6px; color:#fff;">💡 Hệ thống tự động duyệt sau 30s - 1p.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="text-align:center; margin-top:16px;">
                            <button class="btn-confirm" type="button" onclick="showAtmModal()">
                                <i class="fas fa-check-circle" style="margin-right:8px"></i> Xác nhận đã chuyển khoản
                            </button>
                        </div>

                        <h4 style="text-align:center; color:#fff; font-weight:800; margin-top:20px; text-shadow:0 0 6px #000;">Bảng giá Ủng Hộ</h4>
                        <div class="textinfo" style="margin-top:10px;">
                            <p class="m-0">- 10.000đ = 12.000 Coin (x1.2)</p>
                            <p class="m-0">- 20.000đ = 24.000 Coin (x1.2)</p>
                            <p class="m-0">- 50.000đ = 60.000 Coin (x1.2)</p>
                            <p class="m-0">- 100.000đ = 120.000 Coin (x1.2)</p>
                            <p class="m-0">- 200.000đ = 240.000 Coin (x1.2)</p>
                            <p class="m-0">- 500.000đ = 600.000 Coin (x1.2)</p>
                            <p class="m-0" style="color:#ff5722">- 2.000.000đ = 2.600.000 Coin (x1.3)</p>
                        </div>

                        <div style="color:#fff; margin-top:12px; font-size:0.9rem;">
                            <div>- Lưu ý: Chuyển đúng nội dung bao gồm cả DẤU CÁCH</div>
                            <div>- Chuyển khoản ít nhất 1.000Đ mới Thành công</div>
                            <div>- Quá 30 Phút chưa nhận được Coin hãy liên hệ Admin.</div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End ATM section -->

            <!-- Modal overlay (vanilla JS) -->
            <div class="modal-overlay" id="atmModal" aria-hidden="true">
                <div class="modal-box" role="dialog" aria-modal="true">
                    <div style="width:48px; height:48px; border-radius:50%; border:4px solid #333; border-top-color:#ffc107; margin:0 auto 12px; animation:spin 1s linear infinite;"></div>
                    <h3>ĐANG XỬ LÝ...</h3>
                    <p>Hệ thống đã ghi nhận yêu cầu. Vui lòng đợi <b>30s - 1 phút</b> để hệ thống tự động cộng tiền.</p>
                    <p style="font-size:0.85rem; color:#bbb">Nếu quá 5 phút chưa nhận được, vui lòng chụp ảnh giao dịch và liên hệ Admin.</p>
                    <div style="margin-top:10px;"><button class="btn-close-modal" onclick="closeAtmModal()">Đã hiểu, đóng lại</button></div>
                </div>
            </div>


        </div>

        <div class="tCenter hidden__PC">
            <a target="_blank" href="./news/phuc-loi-nap-2025.php">
                <img src="assets/frontend/home/v1/images/bn__gift_now.png" class="gift__site">
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

<!--    footer-->
<?php include_once __DIR__ . '/./layout/footer.php'; ?>
<!--end footer-->
</div>
</div>
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
        background: url(assets/frontend/home/v1/images/) 0 0 no-repeat;
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

<div class="sidebar_right hidden__mobile mo" style="    top: 35%;">
    <div class="sidebar_right-content tCenter">
        <img src="assets/frontend/home/v1/images/sibarRight/qr.png" alt="" class="icon-right"/>

        <div class="tCenter t-lineok">
            <img src="assets/frontend/home/v1/images/sibarRight/line.png" alt="" class="line"/>
        </div>

        <a target="_blank" href="https://apps.apple.com/vn/app/id6446673495?l=vi" class="link-dlgame img-hv p-r">
            <img src="assets/frontend/home/v1/images/sibarRight/ios.png" alt="" class="img-bt"/>
            <img src="assets/frontend/home/v1/images/sibarRight/ios-hv.png" alt="" class="img-hv p-a in-img-hv"/>
        </a>

        <a target="_blank" href="https://play.google.com/store/apps/details?id=com.rtsc.ultracombo"
           class="link-dlgame linkdks-android img-hv p-r">
            <img src="assets/frontend/home/v1/images/sibarRight/android.png" alt="" class="img-bt"/>
            <img src="assets/frontend/home/v1/images/sibarRight/android-hv.png" alt="" class="img-hv p-a in-img-hv"/>
        </a>

        <div class="clickGet m__inline">
            <a target="_blank" href="./news/phuc-loi-nap-2025.php"
               class="a100 f-tahomabold tCenter tUpper dFlex aCenter jCenter">
                Done
            </a>
        </div>

        <div class="go-top">
            <img src="assets/frontend/home/v1/images/sibarRight/top.png" alt=""/>
        </div>
    </div>
    <span class="ctFixRight dFlex aCenter jCenter ctFixRight-mo">
      <img src="assets/frontend/home/v1/images/sibarRight/img-arrow.png" class="imgCtr"/>
    </span>

    <a target="_blank" href="./news/phuc-loi-nap-2025.php">
        <img src="assets/frontend/home/v1/images/bn__gift_now.png" class="gift__site__pc">
    </a>
    <style>
        .gift__site__pc {
            position: absolute;
            bottom: -202px;
            left: 0;
        }
    </style>
</div>
</div>


<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PRJRSS5"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
</body>


<script type="text/javascript" src="assets/frontend/home/v1/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/frontend/home/v1/js/ScrollMagic.min.js"></script>
<script type="text/javascript" src="assets/frontend/home/v1/js/aos.js"></script>
<script type="text/javascript" src="assets/frontend/home/v1/js/slick.min.js"></script>
<script type="text/javascript" src="assets/frontend/home/v1/js/jquery.fancybox.min.js"></script>
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

<script>
    function showAtmModal() {
        var m = document.getElementById('atmModal');
        if (!m) return;
        m.classList.add('active');
        m.setAttribute('aria-hidden','false');
    }
    function closeAtmModal() {
        var m = document.getElementById('atmModal');
        if (!m) return;
        m.classList.remove('active');
        m.setAttribute('aria-hidden','true');
    }

    // click outside to close
    document.addEventListener('click', function(e){
        var m = document.getElementById('atmModal');
        if (!m || !m.classList.contains('active')) return;
        var box = m.querySelector('.modal-box');
        if (box && !box.contains(e.target)) closeAtmModal();
    });

    document.addEventListener('keydown', function(e){
        if (e.key === 'Escape') closeAtmModal();
    });
</script>
</body>
</html>