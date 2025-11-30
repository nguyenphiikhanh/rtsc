<?php ?>
<!DOCTYPE html>
<html lang="vi" class="__roots root__page">

<!-- Mirrored from rongthansieucap.vn/su-kien/uoc-nguyen-ngay-xuan by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Nov 2025 05:24:07 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
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
    <meta property="og:image" content="../assets/frontend/events/tet2024/images/tms.jpg" />
    <meta property="og:image:alt" content="Rồng Thần Siêu Cấp, Game chiến thuật trên mobile đề tài Dragon ball với nhiều tính năng hấp dẫn, tính chiến thuật cao và đầy đủ các nhân vật như Songoku, Vegeta, Android 18, Bulma,..." />

    <link rel="stylesheet" href="../assets/frontend/events/tet2024/css/lib.css"/>
    <link rel="stylesheet" href="../assets/frontend/events/tet2024/css/APlayer.min.css"/>
    <link rel="stylesheet" href="../assets/frontend/events/tet2024/css/style3860.css?v=1"/>  

    <script type="text/javascript" src="../assets/frontend/events/tet2024/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="../assets/frontend/events/tet2024/js/lib.js"></script>
    <script type="text/javascript" src="../assets/frontend/events/tet2024/js/APlayer.min.js"></script>
    
</head>

<body class="__bodys page wpage page__ev">

<div class="fireworks"></div>
<div class="fireworks"></div>
<div class="fireworks fireworks2"></div>
<div class="fireworks fireworks3"></div>

<div id="idMS__play" style="display: none;"></div>
  <span class="link__fl tCenter toggleSoundButton unsound" id="toggleSoundButton">
    <img src="../assets/frontend/events/tet2024/images/audio.png" alt="">
  </span>

  <script>
    
     // __play
     const __ap = new APlayer({
        container: document.getElementById('idMS__play'),
        mini: false,
        autoplay: true,
        theme: '#FADFA3',
        loop: 'all',
        order: 'list',
        preload: 'auto',
        volume: 0.99,
        mutex: false,
        listFolded: false,
        listMaxHeight: 90,
        audio: [
            
            {
                name: 'Game',
                artist: 'Sound game',
                url: '/assets/frontend/events/tet2024/bgms.mp3',
                theme: '#b7daff'
            },
        ]
    });
    __ap.on('play', function () {
      $('#toggleSoundButton').removeClass('unsound')
    });
    __ap.on('pause', function () {
      $('#toggleSoundButton').addClass('unsound')
    });
    $('#toggleSoundButton').click(function() {
        __ap.toggle()
    })

</script>

<div class="main_head __zero">
    <input id="toggle-menu__header-page" type="checkbox" style="display:none">

    <div class="navbar">
        <div class="limit__game">

            <a href="../home.html" class=" hidden__mobile">
                <img src="../assets/frontend/events/tet2024/images/cbsc.png" alt="" class="logo-top">
            </a>
            <a href="../home.html" class=" hidden__mobile logoTT2Right">
                <img src="../assets/frontend/events/tet2024/images/rtsc.png" alt="" class="logo-top">
            </a>

            <div class="left-header hidden__PC">

                <div class="icon-name-game dFlex ">
                    <div class="icon-game">
                        <img src="../assets/frontend/events/tet2024/images/banner1.png" alt="">
                        <!-- <img src="/assets/frontend/events/tet2024/images/rtsc.png" class="lgU__ic"> -->
                    </div>
                    <div class="icon-game">
                        <img src="../assets/frontend/events/tet2024/images/banner2.png" alt="">
                        <!-- <img src="/assets/frontend/events/tet2024/images/cbsc.png" class="lgU__ic"> -->
                    </div>
                    <!-- <div class="txt-name-game c-white">
                        <div class="name-game f-sVN-Avengeance">Rồng thần siêu cấp</div>
                        <div class="txt-des">Game Mobile tam quốc</div>
                    </div> -->
                </div>
            </div>

            <div class="navbar-content tCenter">
                <ul id="menu" class="fsairaM">
                    <li>
                        <a target="_blank" href="../home.html" class="">Trang chủ</a>
                    </li>
                    <li>
                        <a target="_blank" href="https://www.facebook.com/rongthansieucap" class="">Fanpage</a>
                    </li>
                    <li class="">
                        <a target="_blank" href="https://www.facebook.com/groups/958640695290292" class="">Group</a>
                    </li>

                </ul>
            </div>

            <div class="dl__hbgsG dFlex aCenter jCenter  hidden__PC">
                <div class="link-download tCenter hidden__PC btn-fls ac">
                    <a target="_blank" href="https://rongthansieucap.onelink.me/WqrK/download" class="a100 dFlex aCenter jCenter fRobotoM tUpper btYellow tCenter c-pointer tCenter ">
                        Tải game
                    </a>
                    <a target="_blank" href="https://pay.acegame.vn/game/db186" class="a100 dFlex aCenter jCenter fRobotoM tUpper tCenter btRed c-pointer tCenter ">
                        Nạp thẻ
                    </a>
                </div>
                <div class="icon-hamburger  hidden__PC">
                    <label for="toggle-menu__header-page" id="menu__header-page">
                        <div class="inner-menu__header-page"></div>
                    </label>
                </div>
            </div>

        </div>
    </div>
</div><section class="st__ come__on __1">
    <div class="limit__game">
        <div class="name__ev tCenter m__inline">
            <img src="../assets/frontend/events/tet2024/images/textgame.png" class="">
        </div>

        <div class="card3Day__game flex act jct tCenter">
            <div class="eaCard3__day p-r  ">
                <img src="../assets/frontend/events/tet2024/images/come__on/baoNot.png" class="notImg">
                <img src="../assets/frontend/events/tet2024/images/come__on/baoOpen.png" class="openImg">

                <div class="cTNT__cardLX pa">

                    <div class="infoCode3day__">
                        <div class="nameC3day_ fatf_hylilianghel tup tct">Lì Xì Tết Ta Mùng 1</div>
                        <div class="codeOKC3day_ fatf_hylilianghel m__inline tct"></div>
                                                <div class="noteCode3day__ m__inline tct">Xin hãy chờ đến Tết Ta để nhận Lì Xì này!</div>
                                            </div>

                    <div class="btnOpen__g3day flex act jct cp pa tup fatf_hylilianghel bd__red2 no-open-lixi">Chưa mở</div>
                    <div class="nameCardLX pa fRobotoB tup tct">Lì Xì Mùng 1</div>
                </div>
            </div>

            <div class="eaCard3__day p-r ">
                <img src="../assets/frontend/events/tet2024/images/come__on/baoNot.png" class="notImg">
                <img src="../assets/frontend/events/tet2024/images/come__on/baoOpen.png" class="openImg">

                <div class="cTNT__cardLX pa">

                    <div class="infoCode3day__">
                        <div class="nameC3day_ fatf_hylilianghel tup tct">Lì Xì Tết Ta Mùng 2</div>
                        <div class="codeOKC3day_ fatf_hylilianghel m__inline tct"></div>
                                                <div class="noteCode3day__ m__inline tct">Xin hãy chờ đến Tết Ta để nhận Lì Xì này!</div>
                                            </div>

                    <div class="btnOpen__g3day flex act jct cp pa tup fatf_hylilianghel bd__red2 no-open-lixi">Chưa mở</div>
                    <div class="nameCardLX pa fRobotoB tup tct">Lì Xì Mùng 2</div>
                </div>
            </div>

            <div class="eaCard3__day p-r ">
                <img src="../assets/frontend/events/tet2024/images/come__on/baoNot.png" class="notImg">
                <img src="../assets/frontend/events/tet2024/images/come__on/baoOpen.png" class="openImg">

                <div class="cTNT__cardLX pa">
                    <div class="infoCode3day__">
                        <div class="nameC3day_ fatf_hylilianghel tup tct">Lì Xì Tết Ta Mùng 3</div>
                        <div class="codeOKC3day_ fatf_hylilianghel m__inline tct"></div>
                                                <div class="noteCode3day__ m__inline tct">Xin hãy chờ đến Tết Ta để nhận Lì Xì này!</div>
                                            </div>

                    <div class="btnOpen__g3day flex act jct cp pa tup fatf_hylilianghel bd__red2 no-open-lixi">Chưa mở</div>
                    <div class="nameCardLX pa fRobotoB tup tct">Lì Xì Mùng 3</div>
                </div>
            </div>
        </div>

    </div>
</section>
<section class="st__ play__game __end p-r">

    <div class="top__fvip m__inline dFlex aCenter">

        <div class="l_btn__tplg dFlex aCenter jCenter tup">
                        <div class="btn__lrmhc dFlex aCenter jCenter fRobotoB btRed c-pointer tCenter btn-tranY show__login">Đăng nhập</div>
                        <a target="_blank" href="../news/tin-tuc/uoc-nguyen-ngay-xuan_55.html" class="btn__lrmhc dFlex aCenter jCenter fRobotoB btRed c-pointer tCenter btn-tranY show__rule_Bk">Thể lệ</a>
            <div class="btn__lrmhc dFlex aCenter jCenter fRobotoB btRed c-pointer tCenter btn-tranY show__mission">Nhận lượt</div>
            <div class="btn__lrmhc dFlex aCenter jCenter fRobotoB btRed c-pointer tCenter btn-tranY show__history">Lịch sử</div>
            <a target="_blank" href="https://pay.acegame.vn/game/db186" class="btn__lrmhc dFlex aCenter jCenter fRobotoB btRed c-pointer tCenter btn-tranY ">Nạp thẻ</a>
        </div>
    </div>


    <div class="mel__playGame  dFlex aCenter jCenter m__inline pr">

        
        <div class="imgMRong__ flex act jct">
            <img src="../assets/frontend/events/tet2024/images/game/rong2.png" alt="">
        </div>

        <div class="handle__radar dFlex aCenter jCenter tup pa">
            <div class="btn__hd_rd btDream fatf_hylilianghel  c-pointer tCenter btn-tranY" onclick="truytimAjx('x1');">Ước Nguyện 1 Lần</div>
            <div class="btn__hd_rd btDream fatf_hylilianghel c-pointer tCenter btn-tranY" onclick="truytimAjx('x10');">Ước Nguyện 10 Lần</div>
        </div>

    </div>



</section><section class="st__ make__cake __2">

    <div class="title__frame yl m__inline tCenter">
        <img src="../assets/frontend/events/tet2024/images/imgTit/letter.png" style="width:95%;max-width: 789px;">
    </div>

    <div class="tCenter">
        <a  href="javascript:;" class="all__num__ofmy all__num__ofmy2 tup show__rule">
            Hướng Dẫn Đổi Quà Chi Tiết
        </a>
    </div>

    <div class="men__psnl custom__ar dFlex aCenter jCenter m__inline mainShop">
    </div>

</section><section class="st__ personal__ __end">
    <div class="title__frame yl m__inline tCenter">
        <img src="../assets/frontend/events/tet2024/images/imgTit/ps.png" style="width:95%;max-width: 789px;">
    </div>

    <div class="tCenter">
        <div class="all__num__ofmy all__num__ofmy3 tup">
            Tổng Lì Xì của Chiến Binh: <span class="c-orange fRobotoB user-score2">0</span>
        </div>
    </div>


    <div class="men__psnl custom__ar dFlex aCenter jCenter m__inline quaCaNhan">
    </div>

    <div class="note_end__ tCenter c-black"><i>(Hệ thống sẽ làm mới mỗi 15 phút, vui lòng kiểm tra lại sau nếu chưa nhận được quà.)</i></div>
    <style>
        .note_end__ {
            margin-top: 0%;
            font-size: clamp(13px, 3vw, 22px);
        }
        @media only screen and (max-width: 1199px) {
            .note_end__ {
                margin-top: 8%;
            }
        }
    </style>

</section>

<div class="frame frame-rank">
    <div class="title__frame yl m__inline tCenter">
        <img src="../assets/frontend/events/tet2024/images/imgTit/rank.png" style="width:95%;max-width: 789px;">
    </div>

    <div class="limit__game">

        <div class="top10-rank m__inline p-r">
            <div class="rank-top10 fRobotoB m__inline">
                <div class="row-rank row-head tUpper">
                    <div class="column">Top</div>
                    <div class="column">Chiến Binh</div>
                    <div class="column">máy chủ</div>
                    <div class="column">Tổng Lì Xì</div>
                </div>
                                                            <div class="row-rank rr-content">
                            <div class="column">1</div>
                            <div class="column">??ngB?t?</div>
                            <div class="column">S11</div>
                            <div class="column">6408</div>
                        </div>
                                                                                <div class="row-rank rr-content">
                            <div class="column">2</div>
                            <div class="column">?GT?Naruto</div>
                            <div class="column">S85</div>
                            <div class="column">6179</div>
                        </div>
                                                                                <div class="row-rank rr-content">
                            <div class="column">3</div>
                            <div class="column">Min</div>
                            <div class="column">S44</div>
                            <div class="column">5492</div>
                        </div>
                                                                                <div class="row-rank rr-content">
                            <div class="column">4</div>
                            <div class="column">Croy</div>
                            <div class="column">S88</div>
                            <div class="column">5068</div>
                        </div>
                                                                                <div class="row-rank rr-content">
                            <div class="column">5</div>
                            <div class="column">HGTr?mH?T?y</div>
                            <div class="column">S1</div>
                            <div class="column">4482</div>
                        </div>
                                                                                <div class="row-rank rr-content">
                            <div class="column">6</div>
                            <div class="column">7up-h?ng2</div>
                            <div class="column">S6</div>
                            <div class="column">4279</div>
                        </div>
                                                                                <div class="row-rank rr-content">
                            <div class="column">7</div>
                            <div class="column">THANG</div>
                            <div class="column">S138</div>
                            <div class="column">4070</div>
                        </div>
                                                                                <div class="row-rank rr-content">
                            <div class="column">8</div>
                            <div class="column">R?ng7M?u</div>
                            <div class="column">S103</div>
                            <div class="column">3571</div>
                        </div>
                                                                                <div class="row-rank rr-content">
                            <div class="column">9</div>
                            <div class="column">Th?nch?t9999</div>
                            <div class="column">S91</div>
                            <div class="column">3559</div>
                        </div>
                                                                                <div class="row-rank rr-content">
                            <div class="column">10</div>
                            <div class="column">Th?nhch?c</div>
                            <div class="column">S142</div>
                            <div class="column">3533</div>
                        </div>
                                    
                            </div>

        </div>

        <div class="tCenter">
            <a target="_blank" href="../news/tin-tuc/uoc-nguyen-ngay-xuan_55.html" class="btn-tks btn-quatop btDream fatf_hylilianghel   tUpper tCenter c-pointer p-r m__inline btn-tranY show-thuong">
                <span class="name-link">QUÀ ĐUA TOP</span>
            </a>
        </div>

    </div>
</div>
<div class="footer-ace  footer__game __end tUpper p-r">
    <div class="link-other dFlex aCenter jCenter">
        <a href="https://www.facebook.com/rongthansieucap" title="" class=" " target="_blank">
            <img src="../assets/frontend/teaser/images/footer_game/img-fp.png" alt="">
        </a>
        <a href="https://www.facebook.com/groups/958640695290292" title="" class=" " target="_blank">
            <img src="../assets/frontend/teaser/images/footer_game/img-gr.png" alt="">
        </a>
        <a href="#" title="" class=" " target="_blank">
            <img src="../assets/frontend/teaser/images/footer_game/img-yt.png" alt="">
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
                <a href="../policy.html" title="Điều Khoản" class="bs" target="_blank">Điều Khoản</a>
            </p>
            <p class="tCenter footer-text">CHƠI QUÁ 180 PHÚT MỘT NGÀY SẼ ẢNH HƯỞNG XẤU ĐẾN SỨC KHỎE</p>
            <p class="tCenter footer-text">CÔNG TY CỔ PHẦN ACEGAME</p>
            <p class="tCenter footer-text">NGƯỜI CHỊU TRÁCH NHIỆM NỘI DUNG: LÊ VĂN HIẾU</p>
            <p class="tCenter footer-text">ĐỊA CHỈ: TẦNG 14, TÒA NHÀ HM TOWN, 412 NGUYỄN THỊ MINH KHAI, PHƯỜNG 05, QUẬN 03, TP HỒ CHÍ MINH</p>
            <p class="tCenter footer-text">HOTLINE: 1900955519</p>
            <p class="tCenter footer-text">EMAIL HỖ TRỢ: INFO@ACEGAME.VN</p>
            <p class="tCenter footer-text">THỜI GIAN: 8:00 - 22:00 CÁC NGÀY (GMT+7)</p>
            <p class="tCenter footer-text">GIẤY PHÉP NỘI DUNG SỐ: 506/QĐ-BTTTT DO BỘ THÔNG TIN VÀ TRUYỀN THÔNG CẤP NGÀY 31/03/2023</p>


            <img src="../assets/frontend/events/tet2024/images/undo18.png" width="70" height="101" class="footer-ace-18">
        </div>
    </div>
</div>

<style>

    .footer-ace {
        width: 100%;
        padding: 40px 0 30px;
        text-align: center;
        color: #fff;
        background: #020202;
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
        /* background: url(https://rongthan.vn/bundles/web/logoace.png) 0 0 no-repeat; */
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
            margin-left: -30px;
        }
    }
</style>

<div class="sidebar_right hidden__mobile mo ">

    <div class="sidebar_right-content tCenter">
        <img src="../assets/frontend/events/tet2024/images/sibarRight/qr.png" alt="" class="icon-right">

        <div class="tCenter t-lineok">
            <img src="../assets/frontend/events/tet2024/images/sibarRight/line3.png" alt="" class="line">
        </div>
        <div class="tCenter fRobotoM t-dks" style="color: #fff1b8;">
            Tải game ngay tại
        </div>

        <a href="https://apps.apple.com/vn/app/id6446673495?l=vi" class="link-dlgame img-hv p-r">
            <img src="../assets/frontend/events/tet2024/images/sibarRight/ios.png" alt="" class="img-bt">
            <img src="../assets/frontend/events/tet2024/images/sibarRight/ios-hv.png" alt="" class="img-hv p-a in-img-hv">
        </a>

        <a href="https://play.google.com/store/apps/details?id=com.rtsc.ultracombo" class="link-dlgame linkdks-android img-hv p-r">
            <img src="../assets/frontend/events/tet2024/images/sibarRight/android.png" alt="" class="img-bt">
            <img src="../assets/frontend/events/tet2024/images/sibarRight/android-hv.png" alt="" class="img-hv p-a in-img-hv">
        </a>
        <div class="clickGet m__inline">
            <a target="_blank" href="https://pay.acegame.vn/game/db186" class="a100 fRobotoM tCenter tUpper dFlex aCenter jCenter">
                Nạp thẻ
            </a>
        </div>

        <div class="go-top">
            <img src="../assets/frontend/events/tet2024/images/sibarRight/top.png" alt="">
        </div>
    </div>
    <span class="dieu_khien dFlex aCenter jCenter dieu_khien-mo">
		<img src="../assets/frontend/events/tet2024/images/sibarRight/img-arrow.png" class="imgCtr">
	</span>
</div>


<div class="modal" id="modal__login" style="display: none;">
    <div class="content-modal p-r">
        <div class="wrapper-modal">

            <div class="title-modal tCenter tUpper fRobotoB">
                <div class="name__tit">đăng nhập</div>
                <img src="../assets/frontend/events/tet2024/images/modal/img__bt_tit.png" class="imgStarTp">
            </div>

            <div class="m--modal f-svn-freude mt-3per">
                <div>
                    <div class="form-control m__inline box-input tCenter mt-3per">
                        <input class="text tCenter fs20 f-svn_bjola" type="text" name="username" placeholder="Tài Khoản" />
                    </div>
                    <div class="form-control m__inline box-input tCenter mt-3per">
                        <input class="password tCenter fs20 f-svn_bjola" type="password" name="password" placeholder="Mật Khẩu" />
                    </div>


                    <div class="tCenter mt-3per">
                        <button onclick="login();"  class="btn-log btRed fRobotoB  c-pointer tUpper tCenter btn-tranY">Đăng Nhập</button>
                    </div>
                    <div class="note m__inline">
                        <p class="tCenter">
                            <a href="https://id.acegame.vn/ForgotInfo" class="">Quên mật khẩu?</a> Chưa có tài khoản?
                            <a href="https://id.acegame.vn/SignUp" target="_blank" class="">Đăng ký</a>
                        </p>
                    </div>

                    <p class="note m__inline tCenter">Hoặc đăng nhập bằng</p>
                    <div class="other-login tct dFlex aCenter jCenter tUpper">
                        <a href="javascript:;" data-href="https://id.acegame.vn/Oauth?partner=google&amp;Returnurl=https%3A%2F%2Frongthansieucap.vn%2Fauth%2Fopenid-oauth" class="btn-openid-login login-gg dFlex aCenter jCenter">
                            <img src="../assets/frontend/events/tet2024/images/modal/img-gg.png" alt="" />
                        </a>
                        <a href="javascript:;" data-href="https://id.acegame.vn/Oauth?partner=facebook&amp;Returnurl=https%3A%2F%2Frongthansieucap.vn%2Fauth%2Fopenid-oauth" class="btn-openid-login login-fb2 dFlex aCenter jCenter">
                            <img src="../assets/frontend/events/tet2024/images/modal/img-fb.png" alt="" />
                        </a>
                    </div>
                </div>
            </div>
            <div class="close_modal"></div>
        </div>
    </div>
</div>

<div class="modal modal__content" id="modal__rule" style="display: none;">
    <div class="content-modal">
        <div class="wrapper-modal wpct">

            <div class="title-modal tCenter fRobotoB">
                <div class="name__tit">Hướng Dẫn Đổi Quà</div>
                <img src="../assets/frontend/events/tet2024/images/modal/img__bt_tit.png" class="imgStarTp">
            </div>

            <div class="main-modal mt-3per">
                <div class="content-rule c-xam f-roboto-r">

                    <div class="te-content">
                        <div class="tCenter">
                            <div class="all__num__ofmy cRed show__rule">
                                Chữ Đang Có
                            </div>
                        </div>

                        <div class="div__has__rule jCenter">
                            <p>- Số chữ tết: <span class="chuTet">0</span></p>
                            <p>- Số chữ 2024: <span class="chu2024">0</span></p>
                        </div>

                        <div class="tCenter">
                            <div class="all__num__ofmy cRed show__rule">
                                Cách Đổi Quà
                            </div>
                        </div>

                        <div class="div__has__rule jCenter">
                            <p>- Tốn 2 chữ tết + 2 chữ 2024 đổi được 1 Quà Tết 2024 I</p>
                            <p>- Tốn 4 chữ tết + 4 chữ 2024 đổi được 1 Quà Tết 2024 II</p>
                            <p>- Tốn 6 chữ tết + 6 chữ 2024 đổi được 1 Quà Tết 2024 III</p>
                            <p>- Tốn 8 chữ tết + 8 chữ 2024 đổi được 1 Quà Tết 2024 IV</p>
                            <p>- Tốn 10 chữ tết + 12 chữ 2024 đổi được 1 Quà Tết 2024 V</p>
                            <p>- Tốn 12 chữ tết + 10 chữ 2024 đổi được 1 Quà Tết 2024 VI</p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="close_modal"></div>
        </div>
    </div>
</div>

<div class="modal" id="modal__result"  style="display: none;">

    <div class="content-modal">
        <div class="wrapper-modal">

            <div class="title-modal tCenter fRobotoB">
                <div class="name__tit">Thông Báo</div>
                <img src="../assets/frontend/events/tet2024/images/modal/img__bt_tit.png" class="imgStarTp">
            </div>

            <div class="main-modal m__inline tCenter mt-3per">
                <div class="helloUser tCenter alert"></div>
                <div class="listGiftCongrat list-img m__inline dFlex aCenter jCenter mt-2per">

                </div>

            </div>
            <div class="close_modal"></div>
        </div>
    </div>
</div>

<div class="modal" id="modal__alert" style="display: none;">

    <div class="content-modal p-relative">

        <div class="wrapper-modal">

            <div class="title-modal tCenter tUpper fRobotoB">
                <div class="name__tit">thông báo</div>
                <img src="../assets/frontend/events/tet2024/images/modal/img__bt_tit.png" class="imgStarTp">
            </div>

            <div class="main-modal mt-2per">

                <div class="detail-alert ">
                    <p class="tCenter text-alert">Chúc mừng đã nhận thành công quà tích lũy nạp. Vui lòng kiểm tra lịch sử để xem tình trạng gửi quà</p>
                </div>

            </div>
            <div class="close_modal"></div>
        </div>
    </div>
</div>



<script>
    var customAlert = function (message) {
        $('#modal__alert').find('.text-alert').html(message);
        $('#modal__alert').show();
    };

    var isLogin = function (){
         return false;
            }

    function login(){
        $.post(
            '/auth/loginAjax',
            { username: $('input[name="username"]').val(), password: $('input[name="password"]').val() },
            response => {
                if (response.status == 1) {
                    window.location.href = "uoc-nguyen-ngay-xuan.html";
                } else {
                    $('.login-mess').text(response.mess);
                    $('.login-mess').attr('style','display:block; margin-bottom: 20px;');
                }
            }, 'json');
    }

    // Start Login wit Face/google
    var popupOpenIdLoginSuccess = function () {
        if(window.opener) {
                        window.opener.location.href = 'uoc-nguyen-ngay-xuan.html';
                        window.close();
        } else {
                        window.location.href = 'uoc-nguyen-ngay-xuan.html';
                    }
    };

    $('.btn-openid-login').on('click', function (e) {
        e.preventDefault();
        window.open($(this).attr('data-href'),"_blank","height=500,width=500,left=400, top=180 ","resizable=yes","scrollbars=no","toolbar=no","status=no");
    });

    var chooseServer = function(){
        $('#modal__server').remove();
        $.get('uoc-nguyen-ngay-xuan/chon-nhan-vat.html', resp => {
            $('body').append(resp);
            $('#modal__server').fadeIn();
        });
    }

    var isServer = function(){
                return false;
            }

    if(isServer()) chooseServer();

    var getHistory = function (code, page = 1) {
        $('#modal__history').remove();
        $.get('https://rongthansieucap.vn/su-kien/uoc-nguyen-ngay-xuan/lich-su/'+code+'?p='+page, response => {
            $('body').append(response);
            $('#modal__history').show();
        });
    }
    var getMission = function () {
        $('#modal__mission').remove();
        $.get('uoc-nguyen-ngay-xuan/nhiem-vu.html', response => {
            $('body').append(response);
            $('#modal__mission').show();
        });
    }
    var getRule = function () {
        $('#modal__rule').remove();
        $.get('uoc-nguyen-ngay-xuan/rule.html', response => {
            $('body').append(response);
            $('#modal__rule').show();
        });
    }

    $('.show__history').click(function () {
        if(isLogin()) getHistory();
        else $('#modal__login').show();
    });

    $('.show__mission').click(function () {
        if(isLogin()) getMission();
        else $('#modal__login').show();
    });

    $('.show__login').click(function () {
        $('#modal__login').show();
    });

    // $('.show__rule').click(function () {
    //     getRule();
    // });

    var getUserInfo = function () {
        $.get('uoc-nguyen-ngay-xuan/user-info.json', response => {
            if(response) {
                $('.user-turn').text(response.turn);
                $('.user-turn1').text(response.turn);
                $('.user-score1').text(response.score);
                $('.user-score2').text(response.score);
                $('.user-score').text(response.score);
                $('.scoreNoel').text(response.scoreNoel);
                $('.turnNoel').text(response.turnNoel);
                $('.turnUsed').text(response.turnUsed);
                $('.turnUsed1').text(response.turnUsed);
            }
        }, 'json');
    }

    var loadGiftForUser = function () {
        $.get('uoc-nguyen-ngay-xuan/qua-ca-nhan.html', response => {
            $('.quaCaNhan').html(response);
            $('.quaCaNhan').slick({
                rows: 2,
                dots: false,
                arrows: true,
                infinite: false,
                speed: 300,
                autoPlay: false,
                slidesToShow: 2,
                slidesToScroll: 1,
                mobileFirst: true,
                responsive: [
                    {
                        breakpoint: 800,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    }
                ]
            });
        });
    }
    loadGiftForUser();

    var nhanQuaCaNhan = function (giftCode) {
        $.post('https://rongthansieucap.vn/su-kien/uoc-nguyen-ngay-xuan/nhan-qua-ca-nhan/'+giftCode, response => {
            if(response.status == 1) {
                loadGiftForUser();
            }
            customAlert(response.message);
        }, 'json');
    }

    var nhanQuaGhepManh = function (pack_code) {
        $.post('https://rongthansieucap.vn/su-kien/uoc-nguyen-ngay-xuan/nhan-qua-ghepmanh/' + pack_code, response => {
            if(response.status == 1) {
                loadGiftPieceForUser();
            }
            customAlert(response.message);
        }, 'json');
    }

    var loadGiftPieceForUser = function () {
        $.get('uoc-nguyen-ngay-xuan/qua-ghepmanh.html', response => {
            $('.mainShop').html(response);

            $('.mainShop').slick({
                rows: 2,
                dots: false,
                arrows: true,
                infinite: false,
                speed: 300,
                autoPlay: false,
                slidesToShow: 2,
                slidesToScroll: 1,
                mobileFirst: true,
                responsive: [
                    {
                        breakpoint: 800,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    }
                ]
            });
        });
    }

    loadGiftPieceForUser();
</script>
<script>
    var rItval;

    function randomFT(f, t) {
        return Math.floor(Math.random() * t) + f;
    }

    let isStart = 1;

    var truytimAjx = function (turn, vitri = 0) {
        if(!isLogin()) return $('#modal__login').show();

        rItval = setInterval(function() {
            $('.dot__rdg').removeClass('active')
            $('.dot__rdg'+randomFT(1, 7)).addClass('active')
        }, 200);

        if(isStart) {
            isStart = 0;
            let rd1 = Math.floor(Math.random() * 10) + 1
            if(turn == 'x1') {
                $('.cpg'+rd1).addClass('active')
            } else {
                $('.card__playgame').addClass('active')
            }

            $.get('https://rongthansieucap.vn/su-kien/uoc-nguyen-ngay-xuan/lat-the/' + turn + '?vitri='+vitri, response => {
                if(response.status == 1) {
                    let html_show_quay = '';
                    if(response.data && response.data.length > 0){
                        for(var i = 0; i < response.data.length; i++) {
                            html_show_quay += `<div class="thumb-img p-r dFlex aCenter jCenter" title="`+ response.data[i]['name'] + `">`;
                            if(response.data[i]['image'] == null){
                                html_show_quay += `<img src="/assets/frontend/events/tet2024/images/demo.png" alt="">`;
                            } else {
                                html_show_quay += `<img src="/assets/frontend/events/tet2024/images/ga__g/`+response.data[i]['image']+`" alt="">`;
                            }
                            html_show_quay += `<span class="sl p-a brbr10 c-white">x`+ response.data[i]['number'] + `</span>`;
                            html_show_quay += `</div>`;
                        }
                        $('#modal__result .listGiftCongrat').html(html_show_quay);
                    }
                    $('#modal__result .alert').html(response.message);
                    setTimeout(function() {
                        isStart = 1
                        $('#modal__result').show();
                        getUserInfo();
                        clearInterval(rItval);

                        if(turn == 'lat-hinh') loadGiftForUserLatHinh();
                    }, 600)
                } else {
                    isStart = 1
                    customAlert(response.message);
                    clearInterval(rItval);
                }
            }, 'json');
        } else {
            customAlert('Vui lòng đợi xong lượt lật thẻ...');
        }
    }

    $('.dieu_khien').click(function () {
        $('.sidebar_right').toggleClass('mo');
        $(this).toggleClass('dieu_khien-mo');
    });
    // gotop
    var offset = 1080
    go_top = $('.go-top');
    go_top.click(function () { $('html,body').animate({ scrollTop: 0 }, 100); });

    function copyCode() {
        var copyText = document.getElementById("myGiftcode");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
        alert("Copied: " + copyText.value);
    }
</script>

<script>
    $(document).ready(function () {
        $("body").on("click", ".close_modal, .btn__close", function () {
            $(this).parents(".modal").hide()
        });

        // $('.show__login').click(function () {
        //     $('#modal__login').show()
        // });
        // $('.show__mission').click(function () {
        //     $('#modal__mission').show()
        // });
        $('.show__rule').click(function () {
            $('#modal__rule').show()
        });
        $('.no-open-lixi').click(function () {
            customAlert('Xin hãy chờ đến Tết Ta để nhận Lì Xì này!');
        });

    });

</script>
</body>

<!-- Mirrored from rongthansieucap.vn/su-kien/uoc-nguyen-ngay-xuan by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Nov 2025 05:24:15 GMT -->
</html>
