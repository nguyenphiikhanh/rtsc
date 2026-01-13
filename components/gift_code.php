<?php
require_once __DIR__ . '/../helper/helper.php';
require_once __DIR__ . '/../modules/giftcode.php';
$gift_code_list = __get_gift_codes();
?>

<div class="box--content">
    <div class="main__news">
        <div class="limit__game">
            <ul class="breadcrumb p-r" data-aos="fade-up">
                <li class="current"><a href="<?= define_url("home.php") ?>">Trang chủ</a></li>
                <li><span>Thông tin</span></li>
            </ul>
            <div class="main-content-news" data-aos="fade-up">

                <div class="text-detail detail-post bg-top-nap">

                    <div class="d-flex-center">
                        <div class="box-list-new box-border p-r bg-blue-200" style="width: 100%; min-height: 500px;">
                            <div class="tab-new clearfix f-utm_facebook">
                                <div class="tab-link custom-border current" data-tab="tab-giftcode" data-more="viewhuong-dan">
                                    <span>Danh sách giftcode</span></div>
                            </div>

                            <div class="tab-content">
                                <!--        xem giftcode-->
                                <div class="tab-detail current" id="tab-giftcode">
                                    <?php if (count($gift_code_list)) { ?>
                                        <div class="w-full overflow-x-auto">
                                            <table class="w-full min-w-full border border-slate-700 rounded-xl overflow-hidden">
                                                <thead class="bg-slate-800">
                                                <tr>
                                                    <th class="px-4 py-3 text-center text-2xl font-semibold text-slate-300">
                                                        STT
                                                    </th>
                                                    <th class="px-4 py-3 text-center text-2xl font-semibold text-slate-300">
                                                        Giftcode
                                                    </th>
                                                </tr>
                                                </thead>

                                                <tbody class="divide-y divide-slate-700 bg-slate-900">
                                                <?php foreach ($gift_code_list as $index => $gift_code) {  ?>
                                                    <tr class="hover:bg-slate-800 transition">
                                                        <td class="px-4 py-3 text-center text-slate-200"><?= $index + 1 ?></td>
                                                        <td class="px-4 py-3 text-center font-mono text-indigo-400">
                                                            <?= htmlspecialchars($gift_code['code']) ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } else { ?>
                                        <a href="javascript:void(0);" class="item-new-box f-Roboto-Regular">
                                            <div class="cat-des">
                                                <span style="color: red">Chưa có giftcode.</span>
                                            </div>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="icon-rau rau-left-bottom"></div>
                            <div class="icon-rau rau-right-top"></div>
                        </div>
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