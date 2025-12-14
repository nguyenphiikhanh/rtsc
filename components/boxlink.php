<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../helper/helper.php';
global $ios_link;
global $adr_link;
global $pc_link;
global $fanpage;
global $zalo_box_url;
?>

<div class="box-link">
    <div class="container">
        <div class="main-box-link">
            <!-- link group  -->
            <a href="<?= $zalo_box_url ?>" class="item-box-link" data-aos="fade-up" data-aos-duration="700"
               data-aos-delay="400">
                <img class="img-ac" src="<?= define_url("assets/frontend/home/v1/images/box-link/img-gr.png") ?>"
                     alt=""/>
                <img class="img-hv" src="<?= define_url("assets/frontend/home/v1/images/box-link/img-gr-hv.png") ?>"
                     alt=""/>
            </a>

            <!-- link fb -->
            <a href="<?= $fanpage ?>" class="item-box-link hidden-mobile" target="_blank"
               data-aos="fade-up" data-aos-duration="700"
               data-aos-delay="600">
                <img class="img-ac" src="<?= define_url("assets/frontend/home/v1/images/box-link/img-fb.png") ?>"
                     alt=""/>
                <img class="img-hv" src="<?= define_url("assets/frontend/home/v1/images/box-link/img-fb-hv.png") ?>"
                     alt=""/>
            </a>

            <!-- link gc -->
            <a target="_blank" href="<?= define_url("news/huong-dan-nhap-giftcode_34.php") ?>" class="item-box-link"
               data-aos="fade-up"
               data-aos-duration="700" data-aos-delay="800">
                <img class="img-ac" src="<?= define_url("assets/frontend/home/v1/images/box-link/img-gc.png") ?>"
                     alt=""/>
                <img class="img-hv" src="<?= define_url("assets/frontend/home/v1/images/box-link/img-gc-hv.png") ?>"
                     alt=""/>
            </a>
        </div>
    </div>
</div>
