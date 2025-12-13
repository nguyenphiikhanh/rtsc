<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../helper/helper.php';

global $banner_video;
?>

<section class="__section game--brand__show __1">
    <div class="bg_video">
        <video id="videoBgPC" class="videobg hidden__mobile" muted="" loop="" preload="none" webkit-playsinline=""
               playsinline="">
            <source src="<?= $banner_video ?>" type="video/mp4"/>
        </video>
    </div>
    <div class="limit__game">
        <div class="main--game__show">
            <div class="text--brand t-center m-auto p-relative" data-aos="fade-down" data-aos-duration="700"
                 data-aos-delay="100">
                <a href="https://www.youtube.com/" data-fancybox="" style="display: none">
                    <img class="icon-play" src="assets/frontend/home/v1/images/icon-play.png" alt=""/>
                </a>
                <img src="assets/frontend/home/v1/images/textgame.png" alt="" class="textgame__game hidden-mobile"/>
            </div>
        </div>

        <div class="box--download jCenter">
            <?php require_once __DIR__ . '/../components/download.php'; ?>
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
