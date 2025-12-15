<?php
require_once __DIR__ . '/../middleware/auth.php';
require_once __DIR__ . '/../helper/helper.php';
require_once __DIR__ . '/../config/config.php';
$page_home = define_url('home.php');
$page_tintuc = define_url('news/tin-tuc.php');
$page_sukien = define_url('news/su-kien.php');
$page_huongdan = define_url('news/huong-dan.php');
$page_logout = define_url('auth/logout.php');
global $is_authenticated;
global $banner_img;
global $sm_banner_img;
global $webname;
global $fanpage;
global $logo;
?>

    <style>
        body {
            margin: 0;
            font-family: "tahoma";
            font-size: 15px;
            line-height: 1.5;
            font-weight: 300;
            color: #ffffff;
            background-color: #f6f4ea;
            min-height: 100vh;
            overflow-x: hidden !important;
            background: url(<?= $banner_img?>) #f6f4ea;
            background-repeat: no-repeat;
            background-position: center top;
            background-size: auto
        }

        @media only screen and (max-width: 1023px) {
            body {
                background: url(<?= $sm_banner_img ?>) #f6f4ea;
                object-fit: cover;
                background-repeat: no-repeat;
                background-size: contain;
                background-position: center top;
            }
        }
    </style>

    <section class="__section main_head __zero">
        <input id="toggle-menu__header-page" type="checkbox" style="display: none"/>
        <!-- <div Thay logo ở phía dưới </div> -->
        <div class="navbar">
            <div class="limit__game">
                <a href="<?= $page_home ?>" class="hidden__mobile">
                    <img src="<?= $logo ?>" alt="" class="logo-top"
                         style="max-height:180px; max-width: 300px; object-fit:cover;"/>
                </a>
                <div class="left-header hidden__PC">
                    <div class="icon-name-game dFlex">
                        <div class="icon-game">
                            <a href="<?= $page_home ?>">
                                <img src="<?= $logo ?>" alt=""/>
                            </a>
                        </div>
                        <div class="txt-name-game c-white">
                            <div class="name-game f-sVN-Avengeance"><?= $webname ?></div>
                        </div>
                    </div>
                </div>

                <div class="navbar-content tCenter">
                    <ul id="menu" class="f-Roboto-Regular">
                        <li>
                            <a href="<?= $page_home; ?>" class="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="<?= $page_tintuc; ?>" class="">Tin tức</a>
                        </li>
                        <li>
                            <a href="<?= $page_sukien; ?>" class="">Sự kiện</a>
                        </li>
                        <li>
                            <a href="<?= $page_huongdan; ?>" class="">Hướng dẫn</a>
                        </li>
                        <li class="">
                            <a target="_blank" href="<?= $fanpage; ?>" class="">Fanpage</a>
                        </li>
                        <?php if($is_authenticated){ ?>
                            <li class="">
                                <a href="<?= define_url("profile/info.php") ?>" class="">Tài khoản</a>
                            </li>
                        <?php } ?>
                        <li class="">
                            <?php if ($is_authenticated) { ?>
                                <a href="<?php echo $page_logout; ?>" class="">Đăng xuất</a>
                            <?php } else { ?>
                                <a href="javascript:void(0);" class="show__login">Đăng nhập</a>
                            <?php } ?>
                        </li>
                        <?php if (!$is_authenticated) { ?>
                            <li class="">
                                <a href="javascript:void(0);" class="show__register">Đăng ký</a>
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

<?php
require_once __DIR__ . '/../components/auth-modal.php';
?>