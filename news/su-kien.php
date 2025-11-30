<?php require_once __DIR__ . '/../helper/helper.php'; ?>
<!DOCTYPE html>
<html lang="vi" class="__roots root__page">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang Chủ - Nro Ghost</title>
  <link rel="shortcut icon" type="ico" href="../favicon.ico" />

  <meta name="description" content="Rồng Thần Siêu Cấp, Game chiến thuật trên mobile đề tài Dragon ball với nhiều tính năng hấp dẫn, tính chiến thuật cao và đầy đủ các nhân vật như Songoku, Vegeta, Android 18, Bulma,..." />
  <meta name="keywords" content="Dragon ball, game dragon ball, songoku, vegeta, quy lão tiên sinh, game dragon ball mobile, game chiến thuật" />
  
  <meta property="fb:app_id" content="" />
  <meta property="og:locale" content="vi_VN" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content=" Trang Chủ - Nro Ghost " />
  <meta property="og:description" content="Rồng Thần Siêu Cấp, Game chiến thuật trên mobile đề tài Dragon ball với nhiều tính năng hấp dẫn, tính chiến thuật cao và đầy đủ các nhân vật như Songoku, Vegeta, Android 18, Bulma,..." />

  <meta property="og:site_name" content=" Trang Chủ - Nro Ghost" />
  <meta property="og:image" content="../assets/frontend/teaser/images/thumb.png" />
  <meta property="og:image:alt" content="Rồng Thần Siêu Cấp, Game chiến thuật trên mobile đề tài Dragon ball với nhiều tính năng hấp dẫn, tính chiến thuật cao và đầy đủ các nhân vật như Songoku, Vegeta, Android 18, Bulma,..." />

    <?php
    echo load_css([
        'assets/frontend/events/phucloinap2025/css/lib.css',
        'assets/frontend/events/phucloinap2025/css/style.css',
    ]);
    ?>

  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'../../www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PRJRSS5');</script>
<!-- End Google Tag Manager -->
    
    <link rel="stylesheet" href="../assets/frontend/home/v1/css/slick-theme.css" />
    <link rel="stylesheet" href="../assets/frontend/home/v1/css/slick.css" />
    <link rel="stylesheet" href="../assets/frontend/home/v1/css/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="../assets/frontend/home/v1/css/aos.css" />
    <link rel="stylesheet" href="../assets/frontend/home/v1/css/stylea6ca.css?v=919" />
</head>

<body class="body-news">

<!--    header-->
<?php require_once __DIR__ . '/../layout/header.php'; ?>
<!--end header-->
    <section class="__section game--brand__show __1">
      <div class="bg_video">
        <video id="videoBgPC" class="videobg hidden__mobile" muted="" loop="" preload="none" webkit-playsinline=""
          playsinline="">
          <source src="../assets/frontend/teaser/videos/g.mp4" type="video/mp4" />
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
              <img class="icon-play" src="../assets/frontend/home/v1/images/icon-play.png" alt="" />
            </a>
            <img src="../assets/frontend/home/v1/images/textgame.png" alt="" class="textgame__game" />
          </div>
        </div>

        <div class="box--download jCenter">
          <!-- <div class="icon-game t-center" data-aos="fade-down" data-aos-duration="700" data-aos-delay="400">
          <img src="/assets/frontend/home/v1/icon-game.png" alt="">
        </div> -->

          <div class="list-link-dl">
            <!-- tai game apple -->
                        <a target="_blank" href="https://apps.apple.com/vn/app/id6446673495?l=vi" class="item-link link-apple">
              <img class="img-ac" src="../assets/frontend/home/v1/images/btn-dl/btn-dl.png" alt="" />
              <img class="img-hv" src="../assets/frontend/home/v1/images/btn-dl/btn-dl-hv.png" alt="" />
            </a>

            <!-- tai game android https://play.google.com/store/apps/details?id=com.rongthansieucap.gg -->

            <a  href="https://play.google.com/store/apps/details?id=com.rtsc.ultracombo" class="item-link link-android">
              <img class="img-ac" src="../assets/frontend/home/v1/images/btn-dl/btn-dl-android.png" alt="" />
              <img class="img-hv" src="../assets/frontend/home/v1/images/btn-dl/btn-dl-android-hv.png" alt="" />
            </a>
            <!-- tai game apk -->
            <a target="_blank" href="https://cdn.acegame.vn/RongThan.apk" class="item-link link-android">
              <img class="img-ac" src="../assets/frontend/home/v1/images/btn-dl/btn-dl-apk.png" alt="" />
              <img class="img-hv" src="../assets/frontend/home/v1/images/btn-dl/btn-dl-apk-hv.png" alt="" />
            </a>

            <!-- tai game nap the -->
            <a target="_blank" href="https://pay.acegame.vn/game/db186" class="item-link link-card">
              <img class="img-ac" src="../assets/frontend/home/v1/images/btn-dl/btn-card.png" alt="" />
              <img class="img-hv" src="../assets/frontend/home/v1/images/btn-dl/btn-card-hv.png" alt="" />
            </a>

            <!-- tai game fanpage -->
            <a target="_blank" href="https://www.facebook.com/rongthansieucap" class="item-link link-fb">
              <img class="img-ac" src="../assets/frontend/home/v1/images/btn-dl/btn-fb.png" alt="" />
              <img class="img-hv" src="../assets/frontend/home/v1/images/btn-dl/btn-fb-hv.png" alt="" />
            </a>
          </div>

          

        </div>

        <div class="tCenter hidden__PC">
          <a target="_blank" href="../news/phuc-loi-nap-2025.php">
            <img src="../assets/frontend/home/v1/images/bn__gift_now.png" class="gift__site">
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
            <li class="current"><a href="../home.php">Trang chủ</a></li>
            <li class=""><span></span></li>
            <li class=""><span></span></li>
            <li class="current"><span>Sự kiện</span></li>
            <li class=""><span></span></li>
            <li class=""><span></span></li>
          </ul>
          <div class="main-content-news" data-aos="fade-up" data-aos-duration="700" data-aos-delay="1000">
            <div class="title-main-new">
              <div class="title-left"><span class="f-tahomabold">[Tin tức]</span></div>
            </div>

            <div class="list-new-page">
              
                              <div class="item-new clearfix item-tranYTop">
                 
                  <a cat="su-kien" code="tich-luy-nap-19-11-21-11.php" href="su-kien/tich-luy-nap-19-11-21-11_91.php" class="a100">
                    <div class="thumb f-left">
                      <img src="../assets/frontend/home/v1/images/img-su-kien.png" alt="thumb">
                    </div>
                    <div class="full-text f-left">
                      <div class="title-new-date clearfix">
                        <h2 class="title-new f-left"><span class="f-tahomabold">[Sự kiện]</span> Tích Lũy Nạp 19/11 - 21/11</h2>
                        <div class="date-open f-right hidden-mobile">18/11</div>
                      </div>
                      <div class="des-text"></div>
                    </div>
                  </a>
                </div>
                
                              <div class="item-new clearfix item-tranYTop">
                 
                  <a cat="su-kien" code="flash-sale.php" href="su-kien/flash-sale_48.php" class="a100">
                    <div class="thumb f-left">
                      <img src="../assets/frontend/home/v1/images/img-su-kien.png" alt="thumb">
                    </div>
                    <div class="full-text f-left">
                      <div class="title-new-date clearfix">
                        <h2 class="title-new f-left"><span class="f-tahomabold">[Sự kiện]</span> Event Web - Flash Sale 11/11/2025</h2>
                        <div class="date-open f-right hidden-mobile">10/11</div>
                      </div>
                      <div class="des-text"></div>
                    </div>
                  </a>
                </div>
                
                              <div class="item-new clearfix item-tranYTop">
                 
                  <a cat="su-kien" code="web-dai-chien-frieza.php" href="su-kien/web-dai-chien-frieza_64.php" class="a100">
                    <div class="thumb f-left">
                      <img src="../assets/frontend/home/v1/images/img-su-kien.png" alt="thumb">
                    </div>
                    <div class="full-text f-left">
                      <div class="title-new-date clearfix">
                        <h2 class="title-new f-left"><span class="f-tahomabold">[Sự kiện]</span> Web - Đại Chiến Frieza 14</h2>
                        <div class="date-open f-right hidden-mobile">07/11</div>
                      </div>
                      <div class="des-text"></div>
                    </div>
                  </a>
                </div>
                
                              <div class="item-new clearfix item-tranYTop">
                 
                  <a cat="su-kien" code="tich-luy-nap-31-10-02-11-86.php" href="su-kien/tich-luy-nap-31-10-02-11-86_90.php" class="a100">
                    <div class="thumb f-left">
                      <img src="../assets/frontend/home/v1/images/img-su-kien.png" alt="thumb">
                    </div>
                    <div class="full-text f-left">
                      <div class="title-new-date clearfix">
                        <h2 class="title-new f-left"><span class="f-tahomabold">[Sự kiện]</span> Tích Lũy Nạp 31/10 - 02/11/2025</h2>
                        <div class="date-open f-right hidden-mobile">30/10</div>
                      </div>
                      <div class="des-text"></div>
                    </div>
                  </a>
                </div>
                
                              <div class="item-new clearfix item-tranYTop">
                 
                  <a cat="su-kien" code="shop-xu-may-man.php" href="su-kien/shop-xu-may-man_88.php" class="a100">
                    <div class="thumb f-left">
                      <img src="../assets/frontend/home/v1/images/img-su-kien.png" alt="thumb">
                    </div>
                    <div class="full-text f-left">
                      <div class="title-new-date clearfix">
                        <h2 class="title-new f-left"><span class="f-tahomabold">[Sự kiện]</span> SHOP XU MAY MẮN</h2>
                        <div class="date-open f-right hidden-mobile">30/06</div>
                      </div>
                      <div class="des-text"></div>
                    </div>
                  </a>
                </div>

                
                              <div class="item-new clearfix item-tranYTop">
                 
                  <a cat="su-kien" code="mung-sn-2-tuoi.php" href="su-kien/mung-sn-2-tuoi_84.php" class="a100">
                    <div class="thumb f-left">
                      <img src="../assets/frontend/home/v1/images/img-su-kien.png" alt="thumb">
                    </div>
                    <div class="full-text f-left">
                      <div class="title-new-date clearfix">
                        <h2 class="title-new f-left"><span class="f-tahomabold">[Sự kiện]</span> Mừng Sinh Nhật 2 Tuổi</h2>
                        <div class="date-open f-right hidden-mobile">30/05</div>
                      </div>
                      <div class="des-text"></div>
                    </div>
                  </a>
                </div>
                
                              <div class="item-new clearfix item-tranYTop">
                 
                  <a cat="su-kien" code="valentine-ngot-ngao.php" href="su-kien/valentine-ngot-ngao_81.php" class="a100">
                    <div class="thumb f-left">
                      <img src="../assets/frontend/home/v1/images/img-su-kien.png" alt="thumb">
                    </div>
                    <div class="full-text f-left">
                      <div class="title-new-date clearfix">
                        <h2 class="title-new f-left"><span class="f-tahomabold">[Sự kiện]</span> Valentine Trắng 2025</h2>
                        <div class="date-open f-right hidden-mobile">17/03</div>
                      </div>
                      <div class="des-text"></div>
                    </div>
                  </a>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    


  

    
     
    <div class="footer-ace f-tahoma footer__game __6 tUpper p-r">
    <div class="link-other dFlex aCenter jCenter">
      <a href="https://zalo.me/g/oeifth254" title="" class=" " target="_blank">
        <img src="assets/frontend/teaser/images/footer_game/img-fp.png" alt="">
      </a>
      <a href="https://www.facebook.com/profile.php?id=61582689654261" title="" class=" " target="_blank">
        <img src="assets/frontend/teaser/images/footer_game/img-gr.png" alt="">
      </a>
      <a href="https://www.facebook.com/nguyen.quoc.duy.515067" title="" class=" " target="_blank">
        <img src="assets/frontend/teaser/images/footer_game/img-yt.png" alt="">
      </a>
    </div>
      <div class="max_rank">

          
      <div class="footer-ace-inner" itemscope="" itemtype="http://schema.org/Organization">
          <a href="#" class="faq-tink" style="" target="_blank"><span itemprop="legalName">VMGE</span></a>
          <p class="footer-link-privacy">
              <a href="#" title="Hỗ Trợ" class="bs" target="_blank">Hỗ Trợ</a>
              |
              <a href="#" target="_blank" class="bs">Cài Đặt</a>
            |
              <a href="https://thanthugo.vn/policy" title="Điều Khoản" class="bs" target="_blank">Điều Khoản</a>
          </p>
          <p class="tCenter footer-text">CHƠI QUÁ 180 PHÚT MỘT NGÀY SẼ ẢNH HƯỞNG XẤU ĐẾN SỨC KHỎE</p>
          <p class="tCenter footer-text">CÔNG TY CỔ PHẦN ACEGAME</p>
          <p class="tCenter footer-text">NGƯỜI CHỊU TRÁCH NHIỆM NỘI DUNG: NGUYỄN QUỐC DUY</p>
          <p class="tCenter footer-text">EMAIL HỖ TRỢ: DUYNGUYENKEM20400@GMAIL.COM</p>
          <p class="tCenter footer-text">THỜI GIAN: 8:00 - 22:00 CÁC NGÀY (GMT+7)</p>
          
      
          <img src="../assets/frontend/home/v1/images/18_new.png" width="255" height="100" class="footer-ace-18">
      </div>
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
      background: url(../assets/frontend/home/v1/images/logoNEW) 0 0 no-repeat;
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
      <img src="../assets/frontend/home/v1/images/sibarRight/qr.png" alt="" class="icon-right" />

      <div class="tCenter t-lineok">
        <img src="../assets/frontend/home/v1/images/sibarRight/line.png" alt="" class="line" />
      </div>

        <a  target="_blank" href="https://apps.apple.com/vn/app/id6446673495?l=vi" class="link-dlgame img-hv p-r">
        <img src="../assets/frontend/home/v1/images/sibarRight/ios.png" alt="" class="img-bt" />
        <img src="../assets/frontend/home/v1/images/sibarRight/ios-hv.png" alt="" class="img-hv p-a in-img-hv" />
      </a>

      <a target="_blank" href="https://play.google.com/store/apps/details?id=com.rtsc.ultracombo" class="link-dlgame linkdks-android img-hv p-r">
        <img src="../assets/frontend/home/v1/images/sibarRight/android.png" alt="" class="img-bt" />
        <img src="../assets/frontend/home/v1/images/sibarRight/android-hv.png" alt="" class="img-hv p-a in-img-hv" />
      </a>

      <div class="clickGet m__inline">
        <a target="_blank" href="https://pay.acegame.vn/game/db186" class="a100 f-tahomabold tCenter tUpper dFlex aCenter jCenter">
          Nạp thẻ
        </a>
      </div>

      <div class="go-top">
        <img src="../assets/frontend/home/v1/images/sibarRight/top.png" alt="" />
      </div>
    </div>
    <span class="ctFixRight dFlex aCenter jCenter ctFixRight-mo">
      <img src="../assets/frontend/home/v1/images/sibarRight/img-arrow.png" class="imgCtr" />
    </span>

     <a target="_blank" href="../news/phuc-loi-nap-2025.php">
      <img src="../assets/frontend/home/v1/images/bn__gift_now.png" class="gift__site__pc">
    </a>
    <style>
      .gift__site__pc {
        position: absolute;
          bottom: -202px;
        left: 0;
      }
    </style>
  </div>
   
    

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PRJRSS5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>


    <script type="text/javascript" src="../assets/frontend/home/v1/js/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/frontend/home/v1/js/ScrollMagic.min.js"></script>
    <script type="text/javascript" src="../assets/frontend/home/v1/js/aos.js"></script>
    <script type="text/javascript" src="../assets/frontend/home/v1/js/slick.min.js"></script>
    <script type="text/javascript" src="../assets/frontend/home/v1/js/jquery.fancybox.min.js"></script>
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
