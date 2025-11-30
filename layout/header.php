<?php
require_once __DIR__ . '/../middleware/auth.php';
require_once __DIR__ . '/../helper/helper.php';
$page_home = define_url('home.php');
$page_tintuc = define_url('news/tin-tuc.php');
$page_sukien = define_url('news/su-kien.php');
$page_huongdan = define_url('news/huong-dan.php');

$page_logout = define_url('auth/logout.php');
global $is_authenticated;
?>

<section class="__section main_head __zero">
    <input id="toggle-menu__header-page" type="checkbox" style="display: none" />
    <!-- <div Thay logo ở phía dưới </div> -->
    <div class="navbar">
        <div class="limit__game">
            <a href="#" class="hidden__mobile">
                <img src="assets/frontend/home/v1/images/" alt="" class="logo-top" />
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
                        <a href="<?php echo $page_home; ?>" class="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="<?php echo $page_tintuc; ?>" class="">Tin tức</a>
                    </li>
                    <li>
                        <a href="<?php echo $page_sukien; ?>" class="">Sự kiện</a>
                    </li>
                    <li>
                        <a href="<?php echo $page_huongdan; ?>" class="">Hướng dẫn</a>
                    </li>
                    <li class="">
                        <a target="_blank" href="https://www.facebook.com/rongthansieucap" class="">Fanpage</a>
                    </li>
                    <li class="">
                        <?php if($is_authenticated){ ?>
                            <a href="<?php echo $page_logout; ?>" class="">Đăng xuất</a>
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

<?php
require_once __DIR__ . '/../components/auth-modal.php';
?>