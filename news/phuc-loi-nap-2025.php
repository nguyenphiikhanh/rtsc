<?php
require_once __DIR__ . '/../middleware/auth.php';
require_once __DIR__ . '/../helper/helper.php';
global $is_authenticated;
?>

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
    <meta property="og:image" content="../assets/frontend/events/phucloinap2025/images/share.jpg" />
    <meta property="og:image:alt" content="Rồng Thần Siêu Cấp, Game chiến thuật trên mobile đề tài Dragon ball với nhiều tính năng hấp dẫn, tính chiến thuật cao và đầy đủ các nhân vật như Songoku, Vegeta, Android 18, Bulma,..." />

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            '../../www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PRJRSS5');</script>
    <!-- End Google Tag Manager -->

    <link rel="stylesheet" href="../assets/frontend/events/phucloinap2025/css/lib.css"/>
    <link rel="stylesheet" href="../assets/frontend/events/phucloinap2025/css/style.css"/>
    <script src="../module/auth.js"></script>
</head>

<body class="__bodys page wpage page__ev">

<div class="main_head __zero">
    <input id="toggle-menu__header-page" type="checkbox" style="display:none">

    <div class="navbar">
        <div class="limit__game">
            <!-- <a href="/home" class=" hidden__mobile">
                <img src="/assets/frontend/events/phucloinap2025/images/rtsc.png" alt="" class="logo-top">
            </a> -->
            <div class="left-header hidden__PC">

                <div class="icon-name-game dFlex ">
                    <div class="icon-game">
                        <img src="../assets/frontend/events/phucloinap2025/images/bannergame.png" alt="">
                    </div>
                    <div class="txt-name-game c-white">
                        <div class="name-game fkufamB tUpper">Rồng thần siêu cấp</div>
                    </div>
                </div>
            </div>

            <div class="navbar-content tCenter">
                <ul id="menu" class="fkufam">
                    <li>
                        <a href="<?= define_url("home.php") ?>" class="">
                            <img src="../assets/frontend/events/phucloinap2025/images/icons/home.png" class="hidden__MB">
                            <span class="hidden__PC">Trang chủ</span>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://www.facebook.com/rongthansieucap" class="">
                            <img src="../assets/frontend/events/phucloinap2025/images/icons/fb.png" class="hidden__MB">
                            <span class="hidden__PC">Fanpage</span>
                        </a>
                    </li>
                    <li class="">
                        <a target="_blank" href="https://www.facebook.com/groups/958640695290292" class="">
                            <img src="../assets/frontend/events/phucloinap2025/images/icons/gr.png" class="hidden__MB">
                            <span class="hidden__PC">Group</span>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="link-download tCenter hidden__PC btDLG ac">

                <a href="https://rongthansieucap.onelink.me/WqrK/taigame" class="a100 c-black fatf_dragonball">
                    Tải Game
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
<section class="__section game__game __1">

    <div class="limit__game">

        <div class="m__GGIF">
            <div class="tg__GG">
                <img src="../assets/frontend/events/phucloinap2025/images/textgame.png" alt="">
            </div>

            <div class="logo__ifGG">
                <div class="t__logoGG hidden__MB dFlex aCenter jCenter">
                    <img src="../assets/frontend/events/phucloinap2025/images/rtsc.png" alt="">
                    <img src="../assets/frontend/events/phucloinap2025/images/cbsc.png" alt="">
                </div>

                <div style="<?php echo $is_authenticated ? 'opacity: 0;' : '' ?>">
                    <div class="bIF__lcard m__inline">
                        <div class="log__card fkufamB dFlex aCenter jCenter">
                            <div class="bt__logcard dFlex aCenter jCenter c-p btn-tranY bd-black btLog2 sl__ show__login">Đăng Nhập</div>
                            <a target="_blank" href="https://pay.acegame.vn/game/db186" class="bt__logcard dFlex aCenter jCenter c-p btn-tranY bd-black btLog2">Nạp Thẻ</a>
                        </div>
                    </div >

                    <div class="rule__his m__inline dFlex aCenter jCenter pr">
                        <a href="javascrip:void(0);" class="btRHIS cp show-rule show__rule">Thể Lệ</a>
                        <div class="btRHIS cp show__history">Lịch Sử</div>
                    </div>

                    <div class="tCenter">
                        <a target="_blank" href="https://pay.acegame.vn/" class="cardLink frobotoB">Nạp thẻ</a>
                    </div>
                </div>

            </div>
        </div>

    </div>

</section>
<?php include_once __DIR__ . '/../components/qua7days.php'; ?>
<section class="__section cardGame__ __3">
    <div class="limit__game">

<!--        --><?php //include_once __DIR__ . '/../components/quatichluy.php'; ?>

        <style>
            .note_end__ {
                /*margin-top: -4%;*/
                font-size: clamp(13px, 3vw, 22px);
            }
        </style>

    </div>
</section>
<!--    footer-->
<?php include_once __DIR__ . '/../layout/footer.php'; ?>
<!--end footer-->

<style>

    .footer-ace {
        width: 100%;
        padding: 40px 0 30px;
        text-align: center;
        color: #fff;
        background: #000000;
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
        /* background: url(https://rongthan.vn/bundles/web/logoace.png) 0 0 no-repeat;
        background-size: contain; */
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

<div class="sidebar_right hidden__mobile mo">

    <div class="sidebar_right-content tCenter">
        <div class="icon-right p-r">
            <img src="../assets/frontend/events/phucloinap2025/images/sibarRight/qr.png" alt="" class="">
        </div>

        <div class="tCenter t-lineok">
            <img src="../assets/frontend/events/phucloinap2025/images/sibarRight/line.png" alt="" class="line">
        </div>

        <div class="clickGet m__inline">
            <a target="#" href="<?= define_url("news/tin-tuc/top-nap-the.php") ?>" class="a100 fkufamB c-black tCenter tUpper dFlex aCenter jCenter">
                Top Nạp
            </a>
        </div>

        <div class="clickGet m__inline">
            <a target="#" href="https://pay.acegame.vn/game/db186" class="a100 fkufamB c-black tCenter tUpper dFlex aCenter jCenter">
                Top Sự Kiện
            </a>
        </div>

        <div class="go-top">
            <img src="../assets/frontend/events/phucloinap2025/images/sibarRight/top.png" alt="">
        </div>
    </div>
    <span class="dieu_khien dFlex aCenter jCenter dieu_khien-mo">
		<img src="../assets/frontend/events/phucloinap2025/images/sibarRight/img-arrow.png" class="imgCtr">
	</span>
</div>

<?php
require_once __DIR__ . '/../components/auth-modal.php';
?>

<div class="modal modal__content" id="modal__rule" style="display: none;">
    <div class="content-modal">
        <div class="wrapper-modal wpct_bk">


            <div class="title-modal tCenter tUpper fkufamB dFlex aCenter jCenter">
                <span>thể lệ</span>
            </div>

            <div class="main-modal mt-3per">
                <div class="content-rule c-xam fkufam">
                    <div class="te-content">
                        <h2 dir="ltr">Thời gian:</h2>

<p dir="ltr"><strong>- </strong>Thời gian t&iacute;nh t&iacute;ch lũy nạp<strong>: </strong>từ<strong> 0h ng&agrave;y 07/01/2025 </strong>đến<strong>&nbsp;khi c&oacute; th&ocirc;ng b&aacute;o kết th&uacute;c</strong>.</p>

<h2 dir="ltr">Thể lệ:</h2>

<p dir="ltr">- Chiến Binh cần đăng nhập v&agrave;o trang sự kiện để hệ thống ghi nhận th&ocirc;ng tin v&agrave; nhận qu&agrave;: <a href="phuc-loi-nap-2025.php">https://rongthansieucap.vn/su-kien/phuc-loi-nap-2025</a></p>

<h2 dir="ltr">7 Ng&agrave;y, Mỗi Ng&agrave;y Nạp Bất Kỳ:</h2>

<p dir="ltr">- Từ ng&agrave;y <strong>07/01/2025</strong>, sau lần đầu chiến binh đăng nhập v&agrave;o trang sự kiện, mỗi ng&agrave;y, khi chiến binh nạp bất kỳ sẽ nhận được qu&agrave; t&iacute;ch lũy ng&agrave;y nạp.</p>

<p dir="ltr">- Tổng cộng c&oacute; 7 phần qu&agrave; tương ứng với số ng&agrave;y nạp bất kỳ. Mỗi mốc chỉ nhận được 1 lần qu&agrave; duy nhất tr&ecirc;n mỗi t&agrave;i khoản.</p>

<p dir="ltr">- 7 Ng&agrave;y Nạp Bất Kỳ chỉ đếm tổng số ng&agrave;y nạp v&agrave;o game qua trang <a href="https://pay.acegame.vn/game/db186">https://pay.acegame.vn/game/db186</a> hoặc thanh to&aacute;n trực tiếp qu&agrave; CHPlay v&agrave; Appstore, kh&ocirc;ng bắt buộc phải nạp c&aacute;c ng&agrave;y li&ecirc;n tiếp.</p>

<p dir="ltr">- Sau khi đạt mốc t&iacute;ch lũy ng&agrave;y nạp th&igrave; chiến binh sẽ nhận được 1 m&atilde; Giftcode, xem lại th&ocirc;ng tin m&atilde; n&agrave;y ở phần Lịch Sử.</p>

<p dir="ltr">- Phần thưởng như sau:</p>

<table align="center" border="0" cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<td style="text-align:center"><strong>Y&ecirc;u cầu</strong></td>
			<td style="text-align:center"><strong>Thưởng</strong></td>
		</tr>
		<tr>
			<td rowspan="3">
			<p style="text-align:center">T&iacute;ch Lũy Nạp 1 Ng&agrave;y</p>
			</td>
			<td rowspan="3">
			<p style="text-align:center">V&agrave;ngx100,000<br />
			V&eacute; Triệu Hồi Đ&aacute; Rồngx3<br />
			Nước Th&aacute;nh (IV)x10</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="3">
			<p style="text-align:center">T&iacute;ch Lũy Nạp 2 Ng&agrave;y</p>
			</td>
			<td rowspan="3">
			<p style="text-align:center">Đ&aacute; Rồngx100<br />
			Ch&igrave;a Kh&oacute;a Rương Trang Bịx5<br />
			Bentox5</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="3">
			<p style="text-align:center">T&iacute;ch Lũy Nạp 3 Ng&agrave;y</p>
			</td>
			<td rowspan="3">
			<p style="text-align:center">V&agrave;ngx200,000<br />
			V&eacute; Đ&aacute; Rồng Chi&ecirc;u Thứcx5<br />
			Rương Quyểnx20</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="3">
			<p style="text-align:center">T&iacute;ch Lũy Nạp 4 Ng&agrave;y</p>
			</td>
			<td rowspan="3">
			<p style="text-align:center">Đ&aacute; Rồngx200<br />
			<strong>Đ&aacute; Thức Tỉnhx10</strong><br />
			Hộp Đ&aacute; Tăng Phẩmx10</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="3">
			<p style="text-align:center">T&iacute;ch Lũy Nạp 5 Ng&agrave;y</p>
			</td>
			<td rowspan="3">
			<p style="text-align:center">V&agrave;ngx300,000<br />
			Bentox5<br />
			Rương Chiến Binh Triệu Hồi-15 (Ngẫu)x1</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="3">
			<p style="text-align:center">T&iacute;ch Lũy Nạp 6 Ng&agrave;y</p>
			</td>
			<td rowspan="3">
			<p style="text-align:center">Đ&aacute; Rồngx500<br />
			V&eacute; Đ&aacute; Rồng Chi&ecirc;u Thứcx10<br />
			Thuốc Thực Phẩm-IIIx10</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="3">
			<p style="text-align:center">T&iacute;ch Lũy Nạp 7 Ng&agrave;y</p>
			</td>
			<td rowspan="3">
			<p style="text-align:center">V&agrave;ngx400,000<br />
			Hộp Đ&aacute; Tăng Phẩmx30<br />
			Rương Chiến Binh Triệu Hồi-15 (Chọn)x1</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
	</tbody>
</table>

<h2 dir="ltr">Nạp Đ&uacute;ng Mốc:</h2>

<p dir="ltr">- Từ ng&agrave;y <strong>07/01/2025</strong>, sau lần đầu chiến binh đăng nhập v&agrave;o trang sự kiện, nạp Đ&Uacute;NG MỐC sẽ nhận được qu&agrave; Nạp Đ&uacute;ng Mốc tương ứng.</p>

<p dir="ltr">- Sự kiện chỉ t&iacute;nh c&aacute;c mốc nạp tại trang <strong><a href="https://pay.acegame.vn/game/db186">https://pay.acegame.vn/game/db186</a></strong></p>

<p dir="ltr">- Tổng cộng c&oacute; 8 phần qu&agrave; tương ứng với 8 mốc nạp. Mỗi mốc chỉ nhận được 1 lần qu&agrave; duy nhất tr&ecirc;n mỗi t&agrave;i khoản.</p>

<p dir="ltr">- Sau khi nạp đ&uacute;ng mốc th&igrave; chiến binh sẽ nhận được 1 m&atilde; Giftcode, xem lại th&ocirc;ng tin m&atilde; n&agrave;y ở phần Lịch Sử.</p>

<p dir="ltr">- Phần thưởng như sau:</p>

<table align="center">
	<tbody>
		<tr>
			<td>
			<p dir="ltr" style="text-align:center"><strong>Y&ecirc;u cầu</strong></p>
			</td>
			<td>
			<p dir="ltr" style="text-align:center"><strong>Thưởng</strong></p>
			</td>
		</tr>
		<tr>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">Nạp Đ&uacute;ng Mốc 100.000</p>
			</td>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">V&agrave;ng x300,000<br />
			Rương V&eacute; (Chọn) x5<br />
			Hộp Đ&aacute; Tăng Phẩm x30<br />
			Bento x5</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">Nạp Đ&uacute;ng Mốc 200.000</p>
			</td>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">Đ&aacute; Rồng x300<br />
			Rương V&eacute; (Chọn) x7<br />
			Hộp Đ&aacute; Tăng Phẩm x40<br />
			Bento x10</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">Nạp Đ&uacute;ng Mốc 300.000</p>
			</td>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">V&agrave;ng x500,000<br />
			Rương V&eacute; (Chọn) x10<br />
			Thuốc Thực Phẩm-III x20<br />
			Hộp Đ&aacute; Tăng Phẩm x50</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">Nạp Đ&uacute;ng Mốc 600.000</p>
			</td>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">Đ&aacute; Rồng x400<br />
			Rương V&eacute; (Chọn) x15<br />
			Thuốc Thực Phẩm-III x30<br />
			Đ&aacute; Thức Tỉnh x20</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">Nạp Đ&uacute;ng Mốc 1.000.000</p>
			</td>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">V&agrave;ng x800,000<br />
			Rương V&eacute; (Chọn) x20<br />
			Hộp Huy Hiệu 5 Sao x1<br />
			Tinh Hoa Chi&ecirc;u Thức x1000</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">Nạp Đ&uacute;ng Mốc 2.000.000</p>
			</td>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">Đ&aacute; Rồng x500<br />
			Rương V&eacute; (Chọn) x25<br />
			Rương Chi&ecirc;u Thức Đỏ - Ngẫu Nhi&ecirc;n x1<br />
			Tinh Hoa Chi&ecirc;u Thức x2000</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">Nạp Đ&uacute;ng Mốc 3.000.000</p>
			</td>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">V&agrave;ng x1,000,000<br />
			Rương V&eacute; (Chọn) x30<br />
			Rương Chi&ecirc;u Thức Đỏ (Chọn) x1<br />
			Tinh Hoa Chi&ecirc;u Thức x3000</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">Nạp Đ&uacute;ng Mốc 5.000.000</p>
			</td>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">Đ&aacute; Rồng x1000<br />
			Thuốc Thực Phẩm-III x40<br />
			Rương Văn Chương Ch&iacute; T&ocirc;n x1<br />
			Tinh Hoa Chi&ecirc;u Thức x4000</p>
			</td>
		</tr>
	</tbody>
</table>

<h2 dir="ltr">Tổng T&iacute;ch Lũy Nạp:</h2>

<p dir="ltr">- Từ ng&agrave;y <strong>07/01/2025</strong>, sau lần đầu chiến binh đăng nhập v&agrave;o trang sự kiện, tổng t&iacute;ch lũy nạp đạt điều kiện sẽ nhận được qu&agrave; Tổng T&iacute;ch Lũy Nạp tương ứng.</p>

<p dir="ltr">- Tổng cộng c&oacute; 8 phần qu&agrave; tương ứng với 8 mốc Tổng T&iacute;ch Lũy Nạp. Mỗi mốc chỉ nhận được 1 lần qu&agrave; duy nhất tr&ecirc;n mỗi t&agrave;i khoản.</p>

<p dir="ltr">- Tổng T&iacute;ch Lũy Nạp chỉ t&iacute;nh tổng số tiền đ&atilde; nạp v&agrave;o game qua trang <a href="https://pay.acegame.vn/game/db186">https://pay.acegame.vn/game/db186</a> hoặc thanh to&aacute;n trực tiếp qu&agrave; CHPlay v&agrave; Appstore</p>

<p dir="ltr">- Sau khi đạt mốc Tổng T&iacute;ch Lũy Nạp th&igrave; chiến binh sẽ nhận được 1 m&atilde; Giftcode, xem lại th&ocirc;ng tin m&atilde; n&agrave;y ở phần Lịch Sử.</p>

<p>&nbsp;</p>

<table align="center" style="width:500px">
	<tbody>
		<tr>
			<td>
			<p dir="ltr" style="text-align:center"><strong>Y&ecirc;u cầu</strong></p>
			</td>
			<td>
			<p dir="ltr" style="text-align:center"><strong>Thưởng</strong></p>
			</td>
		</tr>
		<tr>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">T&iacute;ch Lũy Nạp 1.500.000</p>
			</td>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">V&agrave;ng x1,000,000<br />
			Rương Mảnh Tướng-14 (Chọn) x1<br />
			Rương V&eacute; (Chọn) x10<br />
			Hộp Đ&aacute; Tăng Phẩm x30</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">T&iacute;ch Lũy Nạp 2.000.000</p>
			</td>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">Đ&aacute; Rồng x500<br />
			Rương Chi&ecirc;u Thức Đỏ - Ngẫu Nhi&ecirc;n x1<br />
			Ch&igrave;a Kh&oacute;a Rương Trang Bị x10<br />
			Đ&aacute; Đột Ph&aacute; x10</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">T&iacute;ch Lũy Nạp 4.000.000</p>
			</td>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">V&agrave;ng x2,000,000<br />
			Thuốc Thực Phẩm-III x30&nbsp;<br />
			Rương Chi&ecirc;u Thức Đỏ (Chọn) x1<br />
			Đ&aacute; Đột Ph&aacute; x20</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">T&iacute;ch Lũy Nạp 7.000.000</p>
			</td>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">Đ&aacute; Rồng x1000<br />
			Rương Tinh Ph&aacute;ch Huy Hiệu (Chọn) x1<br />
			Rương Tinh Ph&aacute;ch S&aacute;ch (Chọn) x1<br />
			Rương Chiến Binh-15 (Chọn) x1</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">T&iacute;ch Lũy Nạp 10.000.000</p>
			</td>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">V&agrave;ng x3,000,000<br />
			Rương chọn Mảnh Son Goku Perfect hoặc Future Gohan hoặc Son Goku SSGSS&amp;Vegeta x30<br />
			Rương Chọn Rune Truyền Thuyết x1<br />
			Đ&aacute; Đột Ph&aacute; x40</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">T&iacute;ch Lũy Nạp 15.000.000</p>
			</td>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">Đ&aacute; Rồng x3000<br />
			Rương chọn Mảnh Son Goku Perfect hoặc Future Gohan hoặc Son Goku SSGSS&amp;Vegeta x50<br />
			Mảnh Vạn Năng Cao Cấp x30<br />
			Rương Chiến Binh-15 (Chọn) x1</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">T&iacute;ch Lũy Nạp 25.000.000</p>
			</td>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">V&agrave;ng x5,000,000<br />
			Rương chọn Mảnh Son Goku Perfect hoặc Future Gohan hoặc Son Goku SSGSS&amp;Vegeta x70<br />
			Rương Chọn Rune Truyền Thuyết x1<br />
			Mảnh VK Vạn Năng-15 x30</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">T&iacute;ch Lũy Nạp 35.000.000</p>
			</td>
			<td rowspan="4">
			<p dir="ltr" style="text-align:center">Đ&aacute; Rồng x5000<br />
			Rương Hồn Vũ Kh&iacute; Son Goku Perfect hoặc Future Gohan hoặc Son Goku SSGSS&amp;Vegeta x1<br />
			Hộp Chọn Huy Hiệu 6 Sao-III x1<br />
			Rương Tinh Hoa Huy Hiệu x5</p>
			</td>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
	</tbody>
</table>

<table align="center" border="0" cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
	</tbody>
</table>

<p dir="ltr"><strong>Ch&uacute; th&iacute;ch vật phẩm:</strong></p>

<p dir="ltr">- <strong>Bento</strong>: D&ugrave;ng nhận 30 Thể lực</p>

<p dir="ltr">- <strong>Rương Chiến Binh Triệu Hồi-15 (Ngẫu nhi&ecirc;n)</strong>: Mở ngẫu nhi&ecirc;n 1 chiến binh tư chất 15 trong danh s&aacute;ch sau Whis, Kefla, Devil Demigra, Jiren (Full Power), Cumber, Zamasu Hợp Thể|</p>

<p dir="ltr">- <strong>Rương Chiến Binh Triệu Hồi-15 (Chọn)</strong>: Mở chọn 1 chiến binh tư chất 15 trong danh s&aacute;ch sau Whis, Kefla, Devil Demigra, Jiren (Full Power), Cumber, Zamasu Hợp Thể</p>

<p dir="ltr">- <strong>Hộp Chọn Huy Hiệu 6 Sao-III</strong>: Mở rương nhận 1 trong số: Super Android 17 [Huy Hiệu Linh Hồn]*1, Bardock [Huy Hiệu Linh Hồn]*1, Kẻ Mặt Đen [Huy Hiệu Linh Hồn]*1, Trunks SS [Huy Hiệu Linh Hồn]*1, Vegeta SS God [Huy Hiệu Linh Hồn]*1, Rồng 1 Sao Si&ecirc;u Cấp [Huy Hiệu Linh Hồn]*1, Cell [Huy Hiệu Linh Hồn]*1, Beerus [Huy Hiệu Linh Hồn]*1</p>

<p dir="ltr">-&nbsp;<strong>Rương Chiến Binh-15 (Chọn)[T&iacute;ch Lũy Nạp 7m]</strong>: Mở rương chọn nhận: [Mảnh]*150 trong số c&aacute;c chiến binh: Broly (DBS), Vados, Moro, Vegeta (Perfect), Evil Bardock, Towa, Super Mira,Son GoKu (Ultra)<br />
- <strong>Rương Chiến Binh-15 (Chọn) x1[T&iacute;ch Lũy Nạp 15m]</strong>: Mở rương chọn nhận: [Mảnh]*150 trong số c&aacute;c chiến binh: Vegito SSGSS, Gogeta SSGSS, Gogeta SS4, Broly SS4, Vegeta (Ultra Ego), Super Saiyan ROSE3, Vegito SS4, Bardock SS4</p>

<p dir="ltr">◈ Lưu &yacute;:</p>

<p>- <strong>&nbsp;</strong>Sự kiện n&agrave;y<strong> KH&Ocirc;NG &aacute;p dụng </strong>khi<strong> d&ugrave;ng V&eacute; Nạp mua c&aacute;c g&oacute;i trong game.</strong></p>

<p><strong>- Mỗi loại m&atilde; thưởng g&oacute;i chỉ c&oacute; thể d&ugrave;ng 1 lần / 1 t&agrave;i khoản. H&atilde;y c&acirc;n nhắc thật kỹ trước khi mua v&agrave; sử dụng m&atilde; thưởng.</strong></p>

<p dir="ltr">- <strong>Kh&ocirc;ng cung cấp, mua b&aacute;n, trao đổi m&atilde; thưởng với người chơi kh&aacute;c để tr&aacute;nh lừa đảo.</strong></p>

<p dir="ltr">- BQT kh&ocirc;ng hỗ trợ c&aacute;c trường hợp mua b&aacute;n giữa người chơi, đ&acirc;y l&agrave; sự kiện c&ocirc;ng khai tất cả người chơi đều c&oacute; thể tham gia mua g&oacute;i v&agrave; nhận thưởng.</p>

                    </div>
                </div>
            </div>
            <div class="close_modal"></div>
        </div>
    </div>
</div>

<div class="modal" id="modal__confirm" style="display: none;">

    <div class="content-modal p-r">

        <div class="wrapper-modal">

            <div class="title-modal tCenter tUpper fkufamB dFlex aCenter jCenter">
                <span>Xác nhận</span>
            </div>

            <div class="main-modal mt-4per">
                <div class="helloUser tCenter">
                    Bạn đồng ý tiêu <span class="c-red">10.000</span> Xu mua gói quà sự kiện? (<span class="c-red">10.000</span> Xu là giá mua gói hiển thị ở nút mua)
                </div>

                <div class="tCenter dFlex aCenter jCenter grBtnAcpt">
                    <div class="btn-copy btn-tranY c-pointer btLog  c-white bd-black fkufamB tUpper mt-2per  dFlex aCenter jCenter btn__close">Huỷ</div>
                    <button class="btn-copy btn-tranY c-pointer btLog  c-white bd-black fkufamB tUpper mt-2per show__giftcode">Xác nhận</button>
                </div>


            </div>
            <div class="close_modal"></div>
        </div>
    </div>
</div>
<div class="modal" id="modal__giftcode" style="display: none;">
    <div class="content-modal p-r">

        <div class="wrapper-modal">


            <div class="title-modal tCenter tUpper fkufamB dFlex aCenter jCenter">
                <span>nhận code</span>
            </div>

            <div class="main-modal mt-4per">
                <div class="helloUser tCenter">
                    Chúc mừng Rồng Thần đã nhận được giftcode
                </div>

                <div class="box-input boxGiftCode tCenter m__inline mt-2per p-r">
                    <input class=" tCenter" type="text" value="AHoang1212LDJSe" id="myGiftcode">
                </div>
                <div class="tCenter">
                    <button class="btn-copy c-pointer btLog fkufamB tUpper mt-2per c-white bd-black" onclick="copyCode()">Copy</button>
                </div>


            </div>
            <div class="close_modal"></div>
        </div>
    </div>
</div>

<div class="modal" id="modal__alert" style="display: none;">

    <div class="content-modal p-relative">

        <div class="wrapper-modal">

            <div class="title-modal tCenter tUpper fkufamB dFlex aCenter jCenter">
                <span>thông báo</span>
            </div>
            <div class="main-modal mt-2per">

                <div class="detail-alert fkufam c-black">
                    <p class="tCenter text-alert">Chúc mừng đã nhận thành công quà tích lũy nạp. Vui lòng kiểm tra lịch sử để xem tình trạng gửi quà</p>
                </div>

            </div>
            <div class="close_modal"></div>
        </div>
    </div>
</div>

<script type="text/javascript" src="../assets/frontend/events/phucloinap2025/js/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="../assets/frontend/events/phucloinap2025/js/lib.js"></script>

<script>
    var customAlert = function (message) {
        $('#modal__alert').find('.text-alert').html(message);
        $('#modal__alert').show();
    };

    var isLogin = function (){
         return false;
            }

    $('.show__login').click(function () {
        $('#modal__login2').show();
    });

    $('.btn-openid-login').on('click', function (e) {
        e.preventDefault();
        window.open($(this).attr('data-href'),"_blank","height=500,width=500,left=400, top=180 ","resizable=yes","scrollbars=no","toolbar=no","status=no");
    });

    var chooseServer = function(){
        $('#modal__server').remove();
        $.get('phuc-loi-nap-2025/chon-nhan-vat.html', resp => {
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
        $.get('https://rongthansieucap.vn/su-kien/phuc-loi-nap-2025/lich-su/'+code+'?p='+page, response => {
            $('body').append(response);
            $('#modal__history').show();
        });
    }
    var getMission = function () {
        $('#modal__mission').remove();
        $.get('phuc-loi-nap-2025/nhiem-vu.html', response => {
            $('body').append(response);
            $('#modal__mission').show();
        });
    }
    var getRule = function () {
        $('#modal__rule').show();
    }

    $('.show__history').click(function () {
        if(isLogin()) getHistory();
        else $('#modal__login2').show();
    });

    $('.show__mission').click(function () {
        if(isLogin()) getMission();
        else $('#modal__login2').show();
    });

    $('.show__rule').click(function () {
        getRule();
    });

            
                                                                                                            
        
    
    var loadGiftForUser = function () {
        $.get('phuc-loi-nap-2025/qua-ca-nhan.html', response => {
            $('.quaCaNhan').html(response);
            $('#quaCaNhan').slick({
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
                            slidesToShow: 4,
                            slidesToScroll: 4,
                        }
                    }
                ]
            });
        });
    }

    var loadGiftLoginForUser = function () {
        $.get('phuc-loi-nap-2025/qua-dang-nhap.html', response => {
            $('.quaDangNhap').html(response);
        });
    }

    var loadGiftMilestoneForUser = function () {
        $.get('phuc-loi-nap-2025/qua-dat-moc.html', response => {
            $('.main-qua-dat-moc').html(response);
            $('.main-qua-dat-moc .quaDatMoc').slick({
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
                            slidesToShow: 4,
                            slidesToScroll: 4,
                        }
                    }
                ]
            });
        });
    }

                                                        loadGiftLoginForUser();
    loadGiftMilestoneForUser();
    loadGiftForUser();

    var nhanQuaDatMoc = function (giftCode) {
        $.post('https://rongthansieucap.vn/su-kien/phuc-loi-nap-2025/nhan-qua-dat-moc/'+giftCode, response => {
            if(response.status == 1) {
                loadGiftMilestoneForUser();
            }
            customAlert(response.message);
        }, 'json');
    }

    var nhanQuaCaNhan = function (giftCode) {
        $.post('https://rongthansieucap.vn/su-kien/phuc-loi-nap-2025/nhan-qua-ca-nhan/'+giftCode, response => {
            if(response.status == 1) {
                loadGiftForUser();
            }
            customAlert(response.message);
        }, 'json');
    }

    var kiemTraQuaNapMoiNgay = function() {
        customAlert("Đang làm mới dữ liệu, vui lòng đợi!");
        $.get('phuc-loi-nap-2025/check-nap.html', function (resp) {
            if(resp.status == 1){
                loadGiftLoginForUser();
                loadGiftMilestoneForUser();
                loadGiftForUser();
            }
            customAlert(resp.message);
        });
    };
</script>

<script>


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

        // $('.show__login').click(function () {
        //     $('#modal__login22').show()
        // });
        // $('.show__rule').click(function () {
        //     $('#modal__rule').show()
        // });
        // $('.show__history').click(function () {
        //     $('#modal__history').show()
        // });
        // $('.show__confirm').click(function () {
        //     $('#modal__confirm').show()
        // });
        // $('.show__giftcode').click(function () {
        //     $('#modal__giftcode').show()
        // });

        // $('.lst__cG_').slick({
        //     rows: 2,
        //     dots: false,
        //     arrows: true,
        //     infinite: false,
        //     speed: 300,
        //     autoPlay: false,
        //     slidesToShow: 2,
        //     slidesToScroll: 1,
        //     mobileFirst: true,
        //     responsive: [
        //         {
        //             breakpoint: 800,
        //             settings: {
        //                 slidesToShow: 3,
        //                 slidesToScroll: 3,
        //             }
        //         },
        //         {
        //             breakpoint: 1200,
        //             settings: {
        //                 slidesToShow: 4,
        //                 slidesToScroll: 4,
        //             }
        //         }
        //     ]
        // });

    });

</script>
<?php echo load_script([
    'assets/js/modal-helper.js',
    'assets/js/gift-receive.js',
]) ?>
</body>

</html>
