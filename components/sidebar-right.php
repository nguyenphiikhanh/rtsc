<?php
require_once __DIR__ . '/../helper/helper.php';
?>

<div class="sidebar_right hidden__mobile mo" style="top: 35%;">
    <div class="sidebar_right-content tCenter">
        <img src="<?= define_url("assets/frontend/home/v1/images/sibarRight/qr.png") ?>" alt="" class="icon-right"/>

        <div class="tCenter t-lineok">
            <img src="<?= define_url("assets/frontend/home/v1/images/sibarRight/line.png") ?>" alt="" class="line"/>
        </div>

        <div class="clickGet m__inline">
            <a href="<?= define_url("news/tin-tuc/top-donate.php") ?>"
               class="a100 f-tahomabold tCenter tUpper dFlex aCenter jCenter">
                Top Donate
            </a>
        </div>

        <div class="clickGet m__inline">
            <a href="<?= define_url("news/tin-tuc/top-su-kien.php") ?>"
               class="a100 f-tahomabold tCenter tUpper dFlex aCenter jCenter">
                Top Sự Kiện
            </a>
        </div>

        <div class="go-top">
            <img src="<?= define_url("assets/frontend/home/v1/images/sibarRight/top.png") ?>" alt=""/>
        </div>
    </div>
    <span class="ctFixRight dFlex aCenter jCenter ctFixRight-mo">
      <img src="<?= define_url("assets/frontend/home/v1/images/sibarRight/img-arrow.png") ?>" class="imgCtr"/>
    </span>

    <a href="<?= define_url("news/phuc-loi-nap-2025.php") ?>">
        <img src="<?= define_url("assets/frontend/home/v1/images/bn__gift_now.png") ?>" class="gift__site__pc">
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