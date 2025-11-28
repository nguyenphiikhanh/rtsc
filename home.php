<?php 
// require_once './module/auth.php';
require_once __DIR__ . '/./auth/auth.php';
require_once __DIR__ . '/./middleware/auth.php';
global $is_authenticated;
?>
<!DOCTYPE html>
<html lang="vi" class="__roots root__page">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Combo Siêu Cấp - Rồng Thần Siêu Cấp - Game Đấu Tướng Dragonball</title>
  <link rel="shortcut icon" type="ico" href="favicon.ico" />

  <meta name="description" content="Rồng Thần Siêu Cấp, Game chiến thuật trên mobile đề tài Dragon ball với nhiều tính năng hấp dẫn, tính chiến thuật cao và đầy đủ các nhân vật như Songoku, Vegeta, Android 18, Bulma,..." />
  <meta name="keywords" content="Dragon ball, game dragon ball, songoku, vegeta, quy lão tiên sinh, game dragon ball mobile, game chiến thuật" />
  
  <meta property="fb:app_id" content="" />
  <meta property="og:locale" content="vi_VN" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content=" Combo Siêu Cấp - Rồng Thần Siêu Cấp - Game Đấu Tướng Dragonball " />
  <meta property="og:description" content="Rồng Thần Siêu Cấp, Game chiến thuật trên mobile đề tài Dragon ball với nhiều tính năng hấp dẫn, tính chiến thuật cao và đầy đủ các nhân vật như Songoku, Vegeta, Android 18, Bulma,..." />

  <meta property="og:site_name" content=" Combo Siêu Cấp - Rồng Thần Siêu Cấp - Game Đấu Tướng Dragonball" />
  <meta property="og:image" content="assets/frontend/teaser/images/thumb.jpg" />
  <meta property="og:image:alt" content="Rồng Thần Siêu Cấp, Game chiến thuật trên mobile đề tài Dragon ball với nhiều tính năng hấp dẫn, tính chiến thuật cao và đầy đủ các nhân vật như Songoku, Vegeta, Android 18, Bulma,..." />
  
  <link rel="stylesheet" href="./assets/frontend/events/phucloinap2025/css/lib.css"/>
  <link rel="stylesheet" href="./assets/frontend/events/phucloinap2025/css/style.css"/>  


  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'../www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PRJRSS5');</script>
<!-- End Google Tag Manager -->
    
    <link rel="stylesheet" href="assets/frontend/home/v1/css/slick-theme.css" />
    <link rel="stylesheet" href="assets/frontend/home/v1/css/slick.css" />
    <link rel="stylesheet" href="assets/frontend/home/v1/css/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="assets/frontend/home/v1/css/aos.css" />
    <link rel="stylesheet" href="assets/frontend/home/v1/css/stylea6ca.css?v=919" />
</head>

<body>

    <section class="__section main_head __zero">
      <input id="toggle-menu__header-page" type="checkbox" style="display: none" />

      <div class="navbar">
        <div class="limit__game">
          <a href="#" class="hidden__mobile">
            <img src="assets/frontend/home/v1/images/rtsc.png" alt="" class="logo-top" />
          </a>
          <div class="left-header hidden__PC">
            <div class="icon-name-game dFlex">
              <div class="icon-game">
                <img src="assets/frontend/home/v1/images/bannergame.png" alt="" />
              </div>
              <div class="txt-name-game c-white">
                <div class="name-game f-sVN-Avengeance">rồng thần siêu cấp</div>
                <!-- <div class="txt-des">Game Mobile tam quốc</div> -->
              </div>
            </div>
          </div>

          <div class="navbar-content tCenter">
            <ul id="menu" class="f-Roboto-Regular">
              <li>
                <a  href="./home.php" class="">Trang chủ</a>
              </li>
              <li>
                <a  href="news/tin-tuc.html" class="">Tin tức</a>
              </li>
              <li>
                <a  href="news/su-kien.html" class="">Sự kiện</a>
              </li>
              <li>
                <a  href="news/huong-dan.html" class="">Hướng dẫn</a>
              </li>
              <li class="">
                <a target="_blank" href="https://www.facebook.com/rongthansieucap" class="">Fanpage</a>
              </li>
              <li class="">
                <?php if($is_authenticated){ ?>
                  <a href="./auth/logout.php" class="">Đăng xuất</a>
                <?php } else { ?>
                  <a href="#" class="show__login">Đăng nhập</a>
                <?php } ?>
              </li>
              <?php if(!$is_authenticated){ ?>
              <li class="">
                  <a href="#" class="show__register">Đăng ký</a>
              </li>
              <?php } ?>
            </ul>
          </div>
          <div class="link-download btn-red_bk tCenter hidden__PC">
            <a href="#" class="a100">
              <!-- <img src="/assets/frontend/home/v1/header/nhanfree.png" alt=""> -->
            </a>
          </div>
          <div class="icon-hamburger hidden__PC">
            <label for="toggle-menu__header-page" id="menu__header-page">
              <div class="inner-menu__header-page"></div>
            </label>
          </div>
        </div>
      </div>
    </section>
    <section class="__section game--brand__show __1">
      <div class="bg_video">
        <video id="videoBgPC" class="videobg hidden__mobile" muted="" loop="" preload="none" webkit-playsinline=""
          playsinline="">
          <source src="assets/frontend/teaser/videos/g.mp4" type="video/mp4" />
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
              <img class="icon-play" src="assets/frontend/home/v1/images/icon-play.png" alt="" />
            </a>
            <img src="assets/frontend/home/v1/images/textgame.png" alt="" class="textgame__game" />
          </div>
        </div>

        <div class="box--download jCenter">
          <!-- <div class="icon-game t-center" data-aos="fade-down" data-aos-duration="700" data-aos-delay="400">
          <img src="/assets/frontend/home/v1/icon-game.png" alt="">
        </div> -->

          <div class="list-link-dl">
            <!-- tai game apple -->
                        <a target="_blank" href="https://apps.apple.com/vn/app/id6446673495?l=vi" class="item-link link-apple">
              <img class="img-ac" src="assets/frontend/home/v1/images/btn-dl/btn-dl.png" alt="" />
              <img class="img-hv" src="assets/frontend/home/v1/images/btn-dl/btn-dl-hv.png" alt="" />
            </a>

            <!-- tai game android https://play.google.com/store/apps/details?id=com.rongthansieucap.gg -->

            <a  href="https://play.google.com/store/apps/details?id=com.rtsc.ultracombo" class="item-link link-android">
              <img class="img-ac" src="assets/frontend/home/v1/images/btn-dl/btn-dl-android.png" alt="" />
              <img class="img-hv" src="assets/frontend/home/v1/images/btn-dl/btn-dl-android-hv.png" alt="" />
            </a>
            <!-- tai game apk -->
            <a target="_blank" href="https://cdn.acegame.vn/RongThan.apk" class="item-link link-android">
              <img class="img-ac" src="assets/frontend/home/v1/images/btn-dl/btn-dl-apk.png" alt="" />
              <img class="img-hv" src="assets/frontend/home/v1/images/btn-dl/btn-dl-apk-hv.png" alt="" />
            </a>

            <!-- tai game nap the -->
            <a target="_blank" href="https://pay.acegame.vn/game/db186" class="item-link link-card">
              <img class="img-ac" src="assets/frontend/home/v1/images/btn-dl/btn-card.png" alt="" />
              <img class="img-hv" src="assets/frontend/home/v1/images/btn-dl/btn-card-hv.png" alt="" />
            </a>

            <!-- tai game fanpage -->
            <a target="_blank" href="https://www.facebook.com/rongthansieucap" class="item-link link-fb">
              <img class="img-ac" src="assets/frontend/home/v1/images/btn-dl/btn-fb.png" alt="" />
              <img class="img-hv" src="assets/frontend/home/v1/images/btn-dl/btn-fb-hv.png" alt="" />
            </a>
          </div>

          

        </div>

        <div class="tCenter hidden__PC">
          <a target="_blank" href="su-kien/phuc-loi-nap-2025.html">
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

    <div class="modal" id="modal__login2" style="display: none;">
    <div class="content-modal p-r" id="login-form">
        <div class="wrapper-modal">
            <div class="title-modal tCenter tUpper fkufamB dFlex aCenter jCenter">
                <span>đăng nhập</span>
            </div>
            <div class="m--modal f-svn-freude mt-3per">
               <form action="" method="POST">
                  <div>
                    <div class="form-control m__inline box-input tCenter mt-3per">
                        <input class="text tCenter fs20 f-svn_bjola" type="text" name="username" placeholder="Tài Khoản" />
                    </div>
                    <div class="form-control m__inline box-input tCenter mt-3per">
                        <input class="password tCenter fs20 f-svn_bjola" type="password" name="password" placeholder="Mật Khẩu" />
                    </div>

                    <div class="tCenter mt-3per">
                        <button name="submit" class="btn-log btLog fkufamB tUpper mt-2per c-white bd-black c-pointer btn-tranY">Đăng Nhập</button>
                    </div>
                    <div class="note m__inline c-black">
                        <p class="tCenter">
                            <a href="https://id.acegame.vn/ForgotInfo" class="c-red">Quên mật khẩu?</a> Chưa có tài khoản?
                            <a href="/dangky.php" target="_blank" class="c-blue">Đăng ký</a>
                        </p>
                    </div>

                    <p class="note m__inline tCenter  c-black">Hoặc đăng nhập bằng</p>
                    <div class="other-login tct dFlex aCenter jCenter tUpper">
                        <a href="javascript:;" data-href="https://id.acegame.vn/Oauth?partner=google&amp;Returnurl=https%3A%2F%2Frongthansieucap.vn%2Fauth%2Fopenid-oauth" class="btn-openid-login login-gg dFlex aCenter jCenter">
                            <img src="../assets/frontend/events/phucloinap2025/images/modal/img-gg.png" alt="" />
                        </a>
                        <a href="javascript:;" data-href="https://id.acegame.vn/Oauth?partner=facebook&amp;Returnurl=https%3A%2F%2Frongthansieucap.vn%2Fauth%2Fopenid-oauth" class="btn-openid-login login-fb2 dFlex aCenter jCenter">
                            <img src="../assets/frontend/events/phucloinap2025/images/modal/img-fb.png" alt="" />
                        </a>
                    </div>
                </div>
               </form>
            </div>
            <div class="close_modal"></div>
    </div>
    </div>
    <div class="content-modal p-r" id="register-form">
      <div class="wrapper-modal">
            <div class="title-modal tCenter tUpper fkufamB dFlex aCenter jCenter">
                <span>đăng ký</span>
            </div>
            <div class="m--modal f-svn-freude mt-3per">
               <form action="" method="POST">
                  <div>
                    <div class="form-control m__inline box-input tCenter mt-3per">
                        <input id="username_register" class="text tCenter fs20 f-svn_bjola" pattern="[a-zA-Z0-9]+" title="Chỉ được nhập chữ và số" type="text" name="username" placeholder="Tài Khoản" required/>
                    </div>
                    <div class="form-control m__inline box-input tCenter mt-3per">
                        <input id="password_register" class="password tCenter fs20 f-svn_bjola" type="password" name="password" placeholder="Mật Khẩu" required/>
                    </div>

                    <div class="tCenter mt-3per">
                        <button name="submit_register" class="btn-log btLog fkufamB tUpper mt-2per c-white bd-black c-pointer btn-tranY">Đăng Ký</button>
                    </div>
                    <div class="note m__inline c-black">
                        <p class="tCenter">
                            <a href="https://id.acegame.vn/ForgotInfo" class="c-red">Quên mật khẩu?</a> Chưa có tài khoản?
                            <a href="/dangky.php" target="_blank" class="c-blue">Đăng ký</a>
                        </p>
                    </div>

                    <p class="note m__inline tCenter  c-black">Hoặc đăng nhập bằng</p>
                    <div class="other-login tct dFlex aCenter jCenter tUpper">
                        <a href="javascript:;" data-href="https://id.acegame.vn/Oauth?partner=google&amp;Returnurl=https%3A%2F%2Frongthansieucap.vn%2Fauth%2Fopenid-oauth" class="btn-openid-login login-gg dFlex aCenter jCenter">
                            <img src="../assets/frontend/events/phucloinap2025/images/modal/img-gg.png" alt="" />
                        </a>
                        <a href="javascript:;" data-href="https://id.acegame.vn/Oauth?partner=facebook&amp;Returnurl=https%3A%2F%2Frongthansieucap.vn%2Fauth%2Fopenid-oauth" class="btn-openid-login login-fb2 dFlex aCenter jCenter">
                            <img src="../assets/frontend/events/phucloinap2025/images/modal/img-fb.png" alt="" />
                        </a>
                    </div>
                </div>
               </form>
            </div>
            <div class="close_modal"></div>
    </div>
    </div>

</div>
        
    <div class="box--content">
      <section class="__section box__new __2 clearfix">
        <div class="tit-frame tCenter">
          <img src="assets/frontend/home/v1/images/ttsk.png" style="width: 60%; max-width: 411px" />
        </div>
        <div class="limit__game">
          <div class="main--box__new" data-aos="fade-up" data-aos-duration="700" data-aos-delay="400">
            <div class="list-slide box-border p-r">
              <div class="listSlide__new">
                                                        <a target="_blank" href="news/tin-tuc/chinh-thuc-ra-mat_33.html">
                                                    <img src="uploads/momo.png" alt="Slide tin tức">
                      </a>
                                        <a target="_blank" href="news/tin-tuc/chinh-thuc-ra-mat_33.html">
                                                    <img src="uploads/01.jpg" alt="Slide tin tức">
                      </a>
                                        <a target="self" href="news/su-kien/chuoi-su-kien-may-chu-moi_32.html">
                                                    <img src="uploads/02.jpg" alt="Slide tin tức">
                      </a>
                                        <a target="self" href="news/tin-tuc/huong-dan-nap-the_36.html">
                                                    <img src="uploads/04.jpg" alt="Slide tin tức">
                      </a>
                                        <a target="self" href="news/huong-dan/dac-quyen-vip_35.html">
                                                    <img src="uploads/05.jpg" alt="Slide tin tức">
                      </a>
                                        <a target="self" href="news/huong-dan/huong-dan-nhap-giftcode_34.html">
                                                    <img src="uploads/03.jpg" alt="Slide tin tức">
                      </a>
                                                </div>

              <div class="icon-rau rau-left-top"></div>
              <div class="icon-rau rau-right-bottom"></div>
            </div>

            <div class="box-list-new box-border p-r">
              <div class="tab-new clearfix f-utm_facebook">
                
                                    <div class="tab-link custom-border current" data-tab="tab-tin-tuc" data-more="viewtin-tuc"><span>Tin tức</span></div>
                                    <div class="tab-link custom-border " data-tab="tab-su-kien" data-more="viewsu-kien"><span>Sự kiện</span></div>
                                    <div class="tab-link custom-border " data-tab="tab-huong-dan" data-more="viewhuong-dan"><span>Hướng dẫn</span></div>
                              </div>

              <div class="tab-content">
               
                                    <div class="tab-detail current" id="tab-tin-tuc">
                                                                                    
                                <a href="news/tin-tuc/trung-thu-2025_89.html" class="item-new-box f-Roboto-Regular">
                                  <div class="cat-des">
                                    [Tin tức] Quà Tri Ân VIP Trung Thu 2025
                                  </div>
                                  <div class="date-open">02.10</div>
                                </a>
                                                            
                                <a href="news/tin-tuc/update-songokussgss-vegeta_87.html" class="item-new-box f-Roboto-Regular">
                                  <div class="cat-des">
                                    [Tin tức] [UPDATE] MỞ ĐẲNG CẤP THẦN THIÊN SỨ: SON GOKU SSGSS&amp;VEGETA
                                  </div>
                                  <div class="date-open">23.06</div>
                                </a>
                                                            
                                <a href="news/tin-tuc/update-gohan-beast_85.html" class="item-new-box f-Roboto-Regular">
                                  <div class="cat-des">
                                    [Tin tức] [UPDATE] MỞ ĐẲNG CẤP THẦN THIÊN SỨ: GOHAN BEAST
                                  </div>
                                  <div class="date-open">23.06</div>
                                </a>
                                                            
                                <a href="news/tin-tuc/super-mira-vs-towa_71.html" class="item-new-box f-Roboto-Regular">
                                  <div class="cat-des">
                                    [Tin tức] [UPDATE] MỞ ĐẲNG CẤP THẦN THIÊN SỨ: SUPER MIRA VÀ TOWA
                                  </div>
                                  <div class="date-open">30.05</div>
                                </a>
                                                            
                                <a href="news/tin-tuc/qua-tri-an-vip-30-04-2025_83.html" class="item-new-box f-Roboto-Regular">
                                  <div class="cat-des">
                                    [Tin tức] Quà Tri Ân VIP Đại Lễ 2025
                                  </div>
                                  <div class="date-open">29.04</div>
                                </a>
                                                                        </div>
                                    <div class="tab-detail " id="tab-su-kien">
                                                                                    
                                <a href="news/su-kien/tich-luy-nap-19-11-21-11_91.html" class="item-new-box f-Roboto-Regular">
                                  <div class="cat-des">
                                    [Sự kiện] Tích Lũy Nạp 19/11 - 21/11
                                  </div>
                                  <div class="date-open">18.11</div>
                                </a>
                                                            
                                <a href="news/su-kien/flash-sale_48.html" class="item-new-box f-Roboto-Regular">
                                  <div class="cat-des">
                                    [Sự kiện] Event Web - Flash Sale 11/11/2025
                                  </div>
                                  <div class="date-open">10.11</div>
                                </a>
                                                            
                                <a href="news/su-kien/web-dai-chien-frieza_64.html" class="item-new-box f-Roboto-Regular">
                                  <div class="cat-des">
                                    [Sự kiện] Web - Đại Chiến Frieza 14
                                  </div>
                                  <div class="date-open">07.11</div>
                                </a>
                                                            
                                <a href="news/su-kien/tich-luy-nap-31-10-02-11-86_90.html" class="item-new-box f-Roboto-Regular">
                                  <div class="cat-des">
                                    [Sự kiện] Tích Lũy Nạp 31/10 - 02/11/2025
                                  </div>
                                  <div class="date-open">30.10</div>
                                </a>
                                                            
                                <a href="news/su-kien/shop-xu-may-man_88.html" class="item-new-box f-Roboto-Regular">
                                  <div class="cat-des">
                                    [Sự kiện] SHOP XU MAY MẮN
                                  </div>
                                  <div class="date-open">30.06</div>
                                </a>
                                                                        </div>
                                    <div class="tab-detail " id="tab-huong-dan">
                                                                                    
                                <a href="news/huong-dan/tong-hop-huy-hieu_70.html" class="item-new-box f-Roboto-Regular">
                                  <div class="cat-des">
                                    [Hướng dẫn] Tổng Hợp Về Huy Hiệu Linh Hồn
                                  </div>
                                  <div class="date-open">17.10</div>
                                </a>
                                                            
                                <a href="news/huong-dan/dac-quyen-vip_35.html" class="item-new-box f-Roboto-Regular">
                                  <div class="cat-des">
                                    [Hướng dẫn] Đặc Quyền VIP
                                  </div>
                                  <div class="date-open">28.09</div>
                                </a>
                                                            
                                <a href="news/huong-dan/huong-dan-lien-ket-tai-khoan_43.html" class="item-new-box f-Roboto-Regular">
                                  <div class="cat-des">
                                    [Hướng dẫn] Hướng Dẫn Liên Kết Tài Khoản
                                  </div>
                                  <div class="date-open">18.07</div>
                                </a>
                                                            
                                <a href="news/huong-dan/huong-dan-nhap-giftcode_34.html" class="item-new-box f-Roboto-Regular">
                                  <div class="cat-des">
                                    [Hướng dẫn] Hướng Dẫn Nhập Giftcode
                                  </div>
                                  <div class="date-open">27.06</div>
                                </a>
                                                            
                                <a href="news/huong-dan/huong-dan-cai-lai-chien-binh_42.html" class="item-new-box f-Roboto-Regular">
                                  <div class="cat-des">
                                    [Hướng dẫn] Hướng Dẫn Cài Lại Chiến Binh
                                  </div>
                                  <div class="date-open">12.06</div>
                                </a>
                                                                        </div>
                
              </div>

              <div class="view-more">
                                    <a href="news/tin-tuc.html" id="viewtin-tuc" class="events a100 link-more current"></a>
                                    <a href="news/su-kien.html" id="viewsu-kien" class="events a100 link-more "></a>
                                    <a href="news/huong-dan.html" id="viewhuong-dan" class="events a100 link-more "></a>
                              </div>

              <div class="icon-rau rau-left-bottom"></div>
              <div class="icon-rau rau-right-top"></div>
            </div>
          </div>
        </div>
      </section>

      <div class="box-link">
        <div class="container">
          <div class="main-box-link">
            <!-- link group  -->
            <a href="https://www.facebook.com/groups/958640695290292" class="item-box-link" data-aos="fade-up" data-aos-duration="700" data-aos-delay="400">
              <img class="img-ac" src="assets/frontend/home/v1/images/box-link/img-gr.png" alt="" />
              <img class="img-hv" src="assets/frontend/home/v1/images/box-link/img-gr-hv.png" alt="" />
            </a>

            <!-- link fb -->
            <a href="https://www.facebook.com/rongthansieucap" class="item-box-link hidden-mobile" data-aos="fade-up" data-aos-duration="700"
              data-aos-delay="600">
              <img class="img-ac" src="assets/frontend/home/v1/images/box-link/img-fb.png" alt="" />
              <img class="img-hv" src="assets/frontend/home/v1/images/box-link/img-fb-hv.png" alt="" />
            </a>

            <!-- link gc -->
            <a  target="_blank" href="news/huong-dan/huong-dan-nhap-giftcode_34.html" class="item-box-link" data-aos="fade-up" data-aos-duration="700" data-aos-delay="800">
              <img class="img-ac" src="assets/frontend/home/v1/images/box-link/img-gc.png" alt="" />
              <img class="img-hv" src="assets/frontend/home/v1/images/box-link/img-gc-hv.png" alt="" />
            </a>
          </div>
        </div>
      </div>
    </div>

    <section class="__section box_game ftg__sl __3">
      <div class="limit__game">
        <div class="tit-frame tCenter">
          <img src="assets/frontend/teaser/images/ten_box_game/tit-tinhnang.png"
            style="width: 60%; max-width: 411px" />
        </div>

        <div class="bg__sl_ft p-r m__inline">
          <img src="assets/frontend/teaser/images/ftgame/bg-tn.png" style="width: 100%" />
          <div class="slide__tinhnang slide__feature p-a slick-custom-dots">
            <img src="assets/frontend/teaser/images/ftgame/teaser1.jpg" />
            <img src="assets/frontend/teaser/images/ftgame/teaser2.jpg" />
            <img src="assets/frontend/teaser/images/ftgame/teaser3.jpg" />
            <img src="assets/frontend/teaser/images/ftgame/teaser4.jpg" />
            <img src="assets/frontend/teaser/images/ftgame/teaser5.jpg" />
          </div>
        </div>
      </div>
    </section>


  

    
    <div class="footer-ace f-tahoma footer__game __6 tUpper p-r">
    <div class="link-other dFlex aCenter jCenter">
      <a href="https://www.facebook.com/rongthansieucap" title="" class=" " target="_blank">
        <img src="assets/frontend/teaser/images/footer_game/img-fp.png" alt="">
      </a>
      <a href="https://www.facebook.com/groups/958640695290292" title="" class=" " target="_blank">
        <img src="assets/frontend/teaser/images/footer_game/img-gr.png" alt="">
      </a>
      <a href="#" title="" class=" " target="_blank">
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
          <p class="tCenter footer-text">NGƯỜI CHỊU TRÁCH NHIỆM NỘI DUNG: LÊ VĂN HIẾU</p>
          <p class="tCenter footer-text">Tầng 14, Tòa nhà HM Town, Số 412 Nguyễn Thị Minh Khai, Phường Bàn Cờ, Thành phố Hồ Chí Minh, Việt Nam</p>
          <p class="tCenter footer-text">HOTLINE: 1900955519</p>
          <p class="tCenter footer-text">EMAIL HỖ TRỢ: INFO@ACEGAME.VN</p>
          <p class="tCenter footer-text">THỜI GIAN: 8:00 - 22:00 CÁC NGÀY (GMT+7)</p>
          <p class="tCenter footer-text">GIẤY PHÉP NỘI DUNG SỐ: 506/QĐ-BTTTT DO BỘ THÔNG TIN VÀ TRUYỀN THÔNG CẤP NGÀY 31/03/2023</p>
          
      
          <img src="assets/frontend/home/v1/images/18_new.png" width="255" height="100" class="footer-ace-18">
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
      background: url(assets/frontend/home/v1/images/logo_ACE.png) 0 0 no-repeat;
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
      <img src="assets/frontend/home/v1/images/sibarRight/qr.png" alt="" class="icon-right" />

      <div class="tCenter t-lineok">
        <img src="assets/frontend/home/v1/images/sibarRight/line.png" alt="" class="line" />
      </div>

        <a  target="_blank" href="https://apps.apple.com/vn/app/id6446673495?l=vi" class="link-dlgame img-hv p-r">
        <img src="assets/frontend/home/v1/images/sibarRight/ios.png" alt="" class="img-bt" />
        <img src="assets/frontend/home/v1/images/sibarRight/ios-hv.png" alt="" class="img-hv p-a in-img-hv" />
      </a>

      <a target="_blank" href="https://play.google.com/store/apps/details?id=com.rtsc.ultracombo" class="link-dlgame linkdks-android img-hv p-r">
        <img src="assets/frontend/home/v1/images/sibarRight/android.png" alt="" class="img-bt" />
        <img src="assets/frontend/home/v1/images/sibarRight/android-hv.png" alt="" class="img-hv p-a in-img-hv" />
      </a>

      <div class="clickGet m__inline">
        <a target="_blank" href="/su-kien/phuc-loi-nap-2025.html" class="a100 f-tahomabold tCenter tUpper dFlex aCenter jCenter">
          Nạp thẻ
        </a>
      </div>

      <div class="go-top">
        <img src="assets/frontend/home/v1/images/sibarRight/top.png" alt="" />
      </div>
    </div>
    <span class="ctFixRight dFlex aCenter jCenter ctFixRight-mo">
      <img src="assets/frontend/home/v1/images/sibarRight/img-arrow.png" class="imgCtr" />
    </span>

     <a target="_blank" href="su-kien/phuc-loi-nap-2025.html">
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
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PRJRSS5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
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

    $('.show__login').click(function () {
        $('#register-form').hide();
        $('#login-form').show();
        $('#modal__login2').show();
    });

    $('.show__register').click(function () {
        $('#login-form').hide();
        $('#register-form').show();
        $('#modal__login2').show();
    });

    $("body").on("click", ".close_modal, .btn__close", function () {
      $(this).parents(".modal").hide()
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
</html>