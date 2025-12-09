<?php
require_once __DIR__ . '/../modules/quadangnhap.php';
require_once __DIR__ . '/../constants/constants.php';
$received_data = get_receive_data();
$gift_data = get_gift_data();
?>

<section class="__section log7day__ __2">
    <div class="limit__game">
        <div class="tit__st tCenter">
            <img src="../assets/frontend/events/phucloinap2025/images/fuck/log1_new.png"  class="hidden__PC" style="width: 60%;max-width: 488px;">
            <img src="../assets/frontend/events/phucloinap2025/images/fuck/log_2.png" class="hidden__MB" style="width: 90%;max-width: 836px;">
        </div>
        <div class="lst__logday fkufamB dFlex aCenter jCenter quaDangNhap">
            <?php foreach ($gift_data as $gift) { $gift_items = json_decode($gift['items'], true); ?>
            <div class="ea__logday ">
                <div class="day__log tCenter">Ngày <?= $gift['day'] ?></div>
                <div class="listGift__cG list-img m__inline dFlex mt-2per">
                <?php foreach ($gift_items as $gift_item) { ?>
                        <div class="thumb-img p-r dFlex aCenter jCenter" title="">
                            <img src="../assets/frontend/events/phucloinap2025/images/omg/nap7ngay/1/1.png" alt="<?= $gift_item['id'].', số lượng: ' . $gift_item['quantity'] ?>">
                        </div>
                <?php } ?>
                </div>
                <div class="tCenter">
                    <?php if($received_data['day'] == $gift['day']) {
                        if($received_data['received'] == NOT_RECEIVED){ ?>
                            <div class="bt__gGCF_cg dFlex aCenter jCenter cp btn-tranY not-received" onclick="giftReceive(<?= $gift['day'] ?>)">Nhận quà</span></div>
                        <?php } else { ?>
                            <div class="bt__gGCF_cg dFlex aCenter jCenter cp btn-tranY received">Đã nhận</div>
                        <?php } ?>
                     <?php } else { ?>
                        <div class="bt__gGCF_cg dFlex aCenter jCenter cp btn-tranY">Chưa đạt</div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
            <form action="" method="POST" style="display: none;" id="receive_day_gift">
                <input type="hidden" name="day" id="day-receive" value="">
            </form>
            <style>
                .received {
                    color: gray;
                }
                .not-received {
                   color: green;
                }
            </style>
        </div>
    </div>
</section>