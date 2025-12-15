<?php
require_once __DIR__ . '/../../helper/helper.php';
require_once __DIR__ . '/../../modules/info.php';
DEFINE('HT_TD', 0);
DEFINE('HT_NM', 1);
DEFINE('HT_XD', 2);
$figure_info = _get_figure_info();
if($figure_info){
    // Khởi tạo các biến để lưu giá trị chỉ số
    $chuoiChiSo = $figure_info['data_point'];
    $chiSo = json_decode($chuoiChiSo, true);
    $sucManh = $tiemNang = $mau = $theLuc = $sucDanhGoc = $giapGoc = $chiMang = '';
    // Lấy danh sách các chỉ số cần lấy
    $chiSoCanLay = array_intersect_key($chiSo, array_flip(['1', '2', '5', '6', '7', '8', '9']));
    // Hiển thị các chỉ số sư phụ nếu có
    foreach ($chiSoCanLay as $key => $value) {
        switch ($key) {
            case '1':
                $sucManh = number_format($value);
                break;

            case '2':
                $tiemNang = number_format($value);
                break;

            case '5':
                $mau = number_format($value);
                break;

            case '6':
                $theLuc = number_format($value);
                break;

            case '7':
                $sucDanhGoc = number_format($value);
                break;

            case '8':
                $giapGoc = number_format($value);
                break;

            case '9':
                $chiMang = number_format($value);
                break;
        }
    }
}
$acc_info = __get_account_info();
?>

<div class="box-list-new box-border p-r" style="width: 100%; min-height: 500px;">
    <div class="tab-new clearfix f-utm_facebook">

        <div class="tab-link custom-border current" data-tab="tab-nhan-vat" data-more="viewtin-tuc"><span>Nhân vật</span></div>
        <div class="tab-link custom-border" data-tab="tab-kich-hoat" data-more="viewsu-kien"><span>Kích hoạt</span></div>
        <div class="tab-link custom-border" data-tab="tab-doi-mk" data-more="viewhuong-dan"><span>Đổi mật khẩu</span></div>
        <div class="tab-link custom-border" data-tab="tab-giftcode" data-more="viewhuong-dan"><span>Giftcode riêng</span></div>
    </div>

    <div class="tab-content">
<!--        info nhan vat-->
        <div class="tab-detail current" id="tab-nhan-vat">
            <?php if(!$figure_info){ ?>
                <a href="javascript:void(0);" class="item-new-box f-Roboto-Regular">
                    <div class="cat-des">
                        <span style="color: red">Bạn chưa tạo nhân vật</span>
                    </div>
                </a>
            <?php } else { ?>
                <a href="javascript:void(0);" class="item-new-box f-Roboto-Regular">
                    <div class="cat-des">
                        [Tên] <?=$figure_info['name']?>
                    </div>
                </a>
                <a href="javascript:void(0);" class="item-new-box f-Roboto-Regular">
                    <div class="cat-des">
                        [Hành tinh] <?=$figure_info['gender'] == HT_TD ? 'Trái Đất' : ($figure_info['gender'] == HT_NM ? 'Namec' : ($figure_info['gender'] == HT_XD ? 'Xayda' : 'Không xác định'))?>
                    </div>
                </a>
                <a href="javascript:void(0);" class="item-new-box f-Roboto-Regular">
                    <div class="cat-des">
                        [Sức mạnh] <?=$sucManh?>
                    </div>
                </a>
                <a href="javascript:void(0);" class="item-new-box f-Roboto-Regular">
                    <div class="cat-des">
                        [Tiềm năng] <?=$tiemNang?>
                    </div>
                </a>
                <a href="javascript:void(0);" class="item-new-box f-Roboto-Regular">
                    <div class="cat-des">
                        [HP Gốc] <?=$mau?>
                    </div>
                </a>
                <a href="javascript:void(0);" class="item-new-box f-Roboto-Regular">
                    <div class="cat-des">
                        [KI Gốc] <?=$theLuc?>
                    </div>
                </a>
                <a href="javascript:void(0);" class="item-new-box f-Roboto-Regular">
                    <div class="cat-des">
                        [Sức đánh gốc] <?=$sucDanhGoc?>
                    </div>
                </a>
                <a href="javascript:void(0);" class="item-new-box f-Roboto-Regular">
                    <div class="cat-des">
                        [Giáp gốc] <?=$giapGoc?>
                    </div>
                </a>
                <a href="javascript:void(0);" class="item-new-box f-Roboto-Regular">
                    <div class="cat-des">
                        [Chí mạng gốc] <?=$chiMang?>
                    </div>
                </a>
            <?php } ?>
        </div>
<!--        info kich hoat-->
        <div class="tab-detail" id="tab-kich-hoat">
            <?php if(!$acc_info['active']){ ?>
                <a href="javascript:void(0)" class="item-new-box f-Roboto-Regular">
                    <div class="cat-des" style="color: red; display: flex; align-items: center">
                        Tài khoản của bạn chưa được kích hoạt.
                    </div>
                    <div class="date-open btn-active"
                         onclick="window.location.href = window.location.pathname + '?activate_account=<?= $acc_info['id'] ?>'"
                         style="text-align: center">
                        <span style="color: white">Kích hoạt ngay</span>
                    </div>
                </a>
                <p class="item-new-box f-Roboto-Regular"></p>
            <?php } else {?>
                <a href="javascript:void(0)" class="item-new-box f-Roboto-Regular">
                    <div class="cat-des" style="color: green">
                        Tài khoản của bạn đã được kích hoạt.
                    </div>
                </a>
                <p class="item-new-box f-Roboto-Regular"></p>
            <?php } ?>
        </div>
<!--        doi mk-->
        <div class="tab-detail" id="tab-doi-mk">
            <a href="javascript:void(0);" class="item-new-box f-Roboto-Regular">
                <div class="cat-des">
                    <span style="color: red">[Đang phát triển] Đợi tí, tính năng đang phát triển :V</span>
                </div>
                <div class="date-open">16.10</div>
            </a>
        </div>
<!--        xem giftcode-->
        <div class="tab-detail" id="tab-giftcode">
            <?php if(!$figure_info){ ?>
                <a href="javascript:void(0);" class="item-new-box f-Roboto-Regular">
                    <div class="cat-des">
                        <span style="color: red">Bạn chưa tạo nhân vật</span>
                    </div>
                </a>
            <?php } else {
                $gift_codes = _get_account_gift_code($figure_info['id']);
                if(count($gift_codes)){
                    foreach($gift_codes as $gift_code){ ?>
                        <a href="javascript:void(0)" class="item-new-box f-Roboto-Regular">
                            <div class="cat-des">
                                <span style="color: red">[Đang phát triển] Đợi tí, tính năng đang được phát triển... :v</span>
                            </div>
                            <div class="date-open">16.12</div>
                        </a>
                    <?php }
                } else { ?>
                    <a href="javascript:void(0);" class="item-new-box f-Roboto-Regular">
                        <div class="cat-des">
                            <span style="color: red">Bạn chưa có giftcode riêng, vui lòng bơm thêm tiền :V</span>
                        </div>
                    </a>
            <?php }
            } ?>
        </div>

    </div>

    <div class="icon-rau rau-left-bottom"></div>
    <div class="icon-rau rau-right-top"></div>
</div>

<style>
    .btn-active {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 18px;
        border-radius: 8px;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        user-select: none;
        transition: all 0.25s ease;
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.35);
    }

    .btn-active span {
        pointer-events: none;
    }

    /* Hover */
    .btn-active:hover {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 10px 22px rgba(239, 68, 68, 0.55);
    }

    /* Click */
    .btn-active:active {
        transform: translateY(0) scale(0.98);
        box-shadow: 0 4px 10px rgba(239, 68, 68, 0.4);
    }
    .btn-active:hover::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: inherit;
        box-shadow: 0 0 18px rgba(239, 68, 68, 0.7);
    }
</style>