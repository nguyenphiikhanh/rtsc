<?php
require_once __DIR__ . '/../modules/info.php';
$account_info = __get_account_info();
?>

<div class="box--content">
    <div class="main__news">
        <div class="limit__game">
            <ul class="breadcrumb p-r" data-aos="fade-up" data-aos-duration="700" data-aos-delay="700">
                <li class="current"><a href="<?= define_url("home.php") ?>">Trang chủ</a></li>
                <li><span>Thông tin</span></li>
            </ul>
            <div class="main-content-news" data-aos="fade-up" data-aos-duration="700" data-aos-delay="1000">
                <div class="title-main-new">
                    <div class="title-left"><span class="f-tahomabold"></span>Thông tin người chơi</div>
                </div>

                <div class="text-detail detail-post bg-top-nap">
                    <div class="tCenter" style="display: flex; justify-content: center;">
                        <img src="<?= define_url("assets/frontend/home/v1/images/a2.png") ?>" alt="avt"/>
                    </div>
                    <div class="tCenter" style="margin-top: 20px; text-align: center; color: white">
                        <span>Xin chào <strong style="color: red"><?= $account_info['username'] ?></strong></span>
                        <span> - Số dư: <strong><?= number_format($account_info['vnd']) ?> vnđ</strong></span>
                    </div>

                    <div class="d-flex-center">
                        <?php require_once __DIR__ . '/../components/child/account-menu.php'; ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .bg-top-nap {
        background: url("../assets/frontend/home/v1/images/bigFT.png");
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        min-height: 600px;
    }
    .d-flex-center{
        display: flex;
        justify-content: center;
    }
</style>