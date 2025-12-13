<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../helper/helper.php';
global $ios_link;
global $adr_link;
global $pc_link;
global $fanpage;
?>

<div class="list-link-dl">
    <!-- tai ios -->
    <a target="_blank" href="<?= $ios_link ?>" class="item-link link-apple">
        <img class="img-ac" src="<?= define_url("assets/frontend/home/v1/images/btn-dl/btn-dl.png") ?>" alt=""/>
        <img class="img-hv" src="<?= define_url("assets/frontend/home/v1/images/btn-dl/btn-dl-hv.png") ?>" alt=""/>
    </a>

    <!-- tai apk -->
    <a target="_blank" href="<?= $adr_link ?>" class="item-link link-android">
        <img class="img-ac" src="<?= define_url("assets/frontend/home/v1/images/btn-dl/btn-dl-android.png") ?>" alt=""/>
        <img class="img-hv" src="<?= define_url("assets/frontend/home/v1/images/btn-dl/btn-dl-android-hv.png") ?>" alt=""/>
    </a>
    <!-- tai pc -->
    <a target="_blank" href="<?= $pc_link ?>" class="item-link link-android">
        <img class="img-ac" src="<?= define_url("assets/frontend/home/v1/images/btn-dl/btn-dl-apk.png") ?>" alt=""/>
        <img class="img-hv" src="<?= define_url("assets/frontend/home/v1/images/btn-dl/btn-dl-apk-hv.png") ?>" alt=""/>
    </a>

    <!-- Nap -->
    <a target="_blank" href="<?= define_url('napatm.php') ?>" class="item-link link-card">
        <img class="img-ac" src="<?= define_url("assets/frontend/home/v1/images/btn-dl/btn-card.png") ?>" alt=""/>
        <img class="img-hv" src="<?= define_url("assets/frontend/home/v1/images/btn-dl/btn-card-hv.png") ?>" alt=""/>
    </a>

    <!-- fanpage -->
    <a target="_blank" href="<?= $fanpage ?>" class="item-link link-fb">
        <img class="img-ac" src="<?= define_url("assets/frontend/home/v1/images/btn-dl/btn-fb.png") ?>" alt=""/>
        <img class="img-hv" src="<?= define_url("assets/frontend/home/v1/images/btn-dl/btn-fb-hv.png") ?>" alt=""/>
    </a>
</div>

