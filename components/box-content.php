<?php
require_once __DIR__ . '/../helper/helper.php';
?>

<div class="box--content">
    <section class="__section box__new __2 clearfix">
        <div class="tit-frame d-flex justify-center tCenter">
            <img src="<?= define_url("assets/frontend/home/v1/images/ttsk.png") ?>" style="width: 60%; max-width: 411px"/>
        </div>
        <div class="limit__game">
            <div class="main--box__new" data-aos="fade-up" data-aos-duration="700" data-aos-delay="400">
                <div class="list-slide box-border p-r">
                    <div class="listSlide__new">
                        <a href="<?= define_url("home.php")?>">
                            <img src="<?= define_url("uploads/01.jpg") ?>" alt="Slide tin tức">
                        </a>
                        <a target="self" href="<?= define_url("home.php")?>">
                            <img src="<?= define_url("uploads/02.jpg") ?>" alt="Slide tin tức">
                        </a>
                        <a target="self" href="<?= define_url("home.php")?>">
                            <img src="<?= define_url("uploads/04.jpg") ?>" alt="Slide tin tức">
                        </a>
                        <a target="self" href="<?= define_url("home.php")?>">
                            <img src="<?= define_url("uploads/05.jpg") ?>" alt="Slide tin tức">
                        </a>
                        <a target="self" href="<?= define_url("home.php")?>">
                            <img src="<?= define_url("uploads/03.jpg") ?>" alt="Slide tin tức">
                        </a>
                    </div>

                    <div class="icon-rau rau-left-top"></div>
                    <div class="icon-rau rau-right-bottom"></div>
                </div>

                <div class="box-list-new box-border p-r">
                    <div class="tab-new clearfix f-utm_facebook">

                        <div class="tab-link custom-border current" data-tab="tab-tin-tuc" data-more="viewtin-tuc">
                            <span>Tin tức</span></div>
                        <div class="tab-link custom-border " data-tab="tab-su-kien" data-more="viewsu-kien">
                            <span>Sự kiện</span>
                        </div>
                        <div class="tab-link custom-border " data-tab="tab-huong-dan" data-more="viewhuong-dan">
                            <span>Hướng dẫn</span>
                        </div>
                    </div>

                    <div class="tab-content">

                        <div class="tab-detail current" id="tab-tin-tuc">

                            <a href="<?= define_url("news/tin-tuc.php") ?>" class="item-new-box f-Roboto-Regular">
                                <div class="cat-des">
                                    [Tin tức] Thông tin quan trọng nhất
                                </div>
                                <div class="date-open">14/12</div>
                            </a>

                            <a href="<?= define_url("news/tin-tuc.php") ?>" class="item-new-box f-Roboto-Regular">
                                <div class="cat-des">
                                    [Tin tức] Thông tin chi tiết sever
                                </div>
                                <div class="date-open">14/12</div>
                            </a>

                            <a href="<?= define_url("news/tin-tuc.php") ?>" class="item-new-box f-Roboto-Regular">
                                <div class="cat-des">
                                    [Tin tức] [UPDATE] Các tính năng
                                </div>
                                <div class="date-open">14/12</div>
                            </a>


                        </div>
                        <div class="tab-detail " id="tab-su-kien">
                            <a href="<?= define_url("news/su-kien.php") ?>" class="item-new-box f-Roboto-Regular">
                                <div class="cat-des">
                                    [Sự kiện] CHÚC MỪNG NĂM MỚI 2026
                                </div>
                                <div class="date-open">14/12</div>
                            </a>
                        </div>
                        <div class="tab-detail " id="tab-huong-dan">

                            <a href="<?= define_url("news/huong-dan.php") ?>" class="item-new-box f-Roboto-Regular">
                                <div class="cat-des">
                                    [Hướng dẫn] Tổng hợp về trang bị
                                </div>
                                <div class="date-open">14/12</div>
                            </a>

                            <a href="<?= define_url("news/huong-dan.php") ?>" class="item-new-box f-Roboto-Regular">
                                <div class="cat-des">
                                    [Hướng dẫn] Hỗ trợ nhiệm vụ
                                </div>
                                <div class="date-open">14/12</div>
                            </a>
                        </div>

                    </div>

                    <div class="view-more">
                        <a href="<?= define_url("news/tin-tuc.php")?>" id="viewtin-tuc" class="events a100 link-more current"></a>
                        <a href="<?= define_url("news/su-kien.php")?>" id="viewsu-kien" class="events a100 link-more "></a>
                        <a href="<?= define_url("news/huong-dan.php")?>" id="viewhuong-dan" class="events a100 link-more "></a>
                    </div>

                    <div class="icon-rau rau-left-bottom"></div>
                    <div class="icon-rau rau-right-top"></div>
                </div>
            </div>
        </div>
    </section>

    <?php require_once __DIR__ . '/./boxlink.php'; ?>
</div>