<?php
require_once __DIR__ . '/../helper/helper.php';
require_once __DIR__ . '/../config/config.php';
global $logo;
global $fanpage;
global $zalo_box_url;
?>

<div class="footer-ace f-tahoma footer__game __6 tUpper p-r">
    <div class="link-other dFlex aCenter jCenter">
        <a href="<?= $fanpage ?>" title="" class=" " target="_blank">
            <img src="<?= define_url("assets/frontend/teaser/images/footer_game/img-fp.png")?>" alt="">
        </a>
        <a href="<?= $zalo_box_url ?>" title="" class=" " target="_blank">
            <img src="<?= define_url("assets/frontend/teaser/images/footer_game/img-gr.png")?>" alt="">
        </a>
        <a href="<?= $fanpage ?>" title="" class=" " target="_blank">
            <img src="<?= define_url("assets/frontend/teaser/images/footer_game/img-yt.png")?>" alt="">
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
            <p class="tCenter footer-text">NGƯỜI CHỊU TRÁCH NHIỆM NỘI DUNG: NGUYỄN QUỐC DUY</p>
            <p class="tCenter footer-text">HOTLINE: 0325238490</p>
            <p class="tCenter footer-text">EMAIL HỖ TRỢ: DUYNGUYENKEM20400@GMAIL.COM</p>
            <p class="tCenter footer-text">THỜI GIAN: 8:00 - 22:00 CÁC NGÀY (GMT+7)</p>


            <img src="<?= define_url("assets/frontend/events/phucloinap2025/images/undo18.png"); ?>" width="70" height="101" class="footer-ace-18">
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
        background: url(<?= $logo ?>) 0 0 no-repeat;
        background-size: contain;
        width: 250px;
        height: 130px;
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
