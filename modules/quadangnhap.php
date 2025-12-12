<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../constants/constants.php';
require_once __DIR__ . '/../auth/auth.php';
require_once __DIR__ . '/../helper/helper.php';
function get_receive_data(){
    global $config;

    $userinfo = get_auth_info();
    $username = $userinfo['username'];
    $sql = "SELECT id, username, create_time, ban FROM account WHERE username = '$username'";
    $results = $config->query($sql);

    if($results->num_rows > 0){
        $account = $results->fetch_assoc();
        if ($account['create_time']) {
            $create_day = date("Y-m-d", strtotime($account['create_time']));
            $create_time = strtotime($create_day . " 00:00:00");
        } else {
            $create_day = date("Y-m-d");
            $create_time = strtotime($create_day . " 00:00:00");

            $sql = "UPDATE account SET create_time = '$create_day 00:00:00' WHERE username = '$username'";
            mysqli_query($config, $sql);
        }
        $today = strtotime(date("Y-m-d") . " 00:00:00");
        $days = floor(($today - $create_time) / 86400);
        // Cập nhật trạng thái đăng nhập theo ngày;
        $dayInCycle = ($days % 7) + 1;

        //check xem quà nhận chưa
        $account_id = $account['id'];
        $start = date("Y-m-d 00:00:00");
        $end   = date("Y-m-d 23:59:59");
        $receiveSql =  "SELECT * FROM qua_dang_nhap_history WHERE account_id = $account_id AND date_received BETWEEN '$start' AND '$end'";
        $receive_results = $config->query($receiveSql);
        $received = NOT_RECEIVED;
        if($receive_results->num_rows > 0){
            $received = RECEIVED;
        }

        return [
            'day' => $dayInCycle,
            'received' => $received
        ];
    }
}

function get_gift_data(){
    global $config;
    $sql = "SELECT * FROM qua_dang_nhap ORDER BY day ASC";

    $gift_data = [];
    $results = $config->query($sql);
    if($results->num_rows > 0){
        $gift_data = $results->fetch_all(MYSQLI_ASSOC);
    }
    return $gift_data;
}

function receive($day) {
    global $config;

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $userinfo = get_auth_info();
    $username = $userinfo['username'];
    $thongbao = '';

    try {
        $config->begin_transaction();

        /* =========================
         * 1. LẤY ACCOUNT + PLAYER
         * ========================= */
        $stmt = $config->prepare("
            SELECT 
                account.id AS account_id,
                account.ban,
                player.id AS player_id
            FROM account
            INNER JOIN player ON account.id = player.account_id
            WHERE account.username = ?
            LIMIT 1
        ");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception('Vui lòng tạo nhân vật trong game để nhận quà!');
        }

        $account = $result->fetch_assoc();

        if ($account['ban']) {
            throw new Exception('Tài khoản của bạn đã bị khóa!');
        }

        $account_id = (int)$account['account_id'];
        $player_id  = (int)$account['player_id'];

        /* =========================
         * 2. INSERT HISTORY (ANTI DUP)
         * ========================= */
        $stmt = $config->prepare("
            INSERT INTO qua_dang_nhap_history (account_id, date_received, day)
            VALUES (?, NOW(), ?)
        ");
        $stmt->bind_param("ii", $account_id, $day);
        $stmt->execute();
        // Nếu đã nhận → UNIQUE KEY sẽ throw exception

        /* =========================
         * 3. LẤY QUÀ
         * ========================= */
        $stmt = $config->prepare("SELECT items FROM qua_dang_nhap WHERE day = ?");
        $stmt->bind_param("i", $day);
        $stmt->execute();
        $giftResult = $stmt->get_result();

        if ($giftResult->num_rows === 0) {
            throw new Exception('Không tìm thấy quà cho ngày này!');
        }

        $giftData = json_decode($giftResult->fetch_assoc()['items'], true);

        /* =========================
         * 4. LẤY HÀNH TRANG
         * ========================= */
        $stmt = $config->prepare("SELECT items_bag FROM player WHERE id = ?");
        $stmt->bind_param("i", $player_id);
        $stmt->execute();
        $bagResult = $stmt->get_result();
        $bagItems = json_decode($bagResult->fetch_assoc()['items_bag'], true);

        if (!is_array($bagItems)) {
            throw new Exception('Dữ liệu hành trang lỗi!');
        }

        $emptySlots = [];
        foreach ($bagItems as $i => $slot) {
            if ($slot['temp_id'] == NULL_TEMP_ID) {
                $emptySlots[] = $i;
            }
        }

        /* =========================
         * 5. LẤY ITEM TEMPLATE
         * ========================= */
        $giftItemIds = array_column($giftData, 'id');
        $in = implode(',', array_fill(0, count($giftItemIds), '?'));
        $types = str_repeat('i', count($giftItemIds));

        $stmt = $config->prepare("
            SELECT id, is_up_to_up 
            FROM item_template 
            WHERE id IN ($in)
        ");
        $stmt->bind_param($types, ...$giftItemIds);
        $stmt->execute();
        $tempResult = $stmt->get_result();

        $templates = [];
        while ($row = $tempResult->fetch_assoc()) {
            $templates[$row['id']] = $row;
        }

        /* =========================
         * 6. XỬ LÝ NHẬN QUÀ
         * ========================= */
        $nowMs = (int)(microtime(true) * 1000);

        foreach ($giftData as $gift) {
            $options = [];
            foreach ($gift['options'] ?? [] as $opt) {
                $options[] = [$opt['id'], $opt['param']];
            }

            $foundStack = false;

            if (!empty($templates[$gift['id']]['is_up_to_up'])) {
                foreach ($bagItems as &$slot) {
                    if (
                        $slot['temp_id'] == $gift['id'] &&
                        normalizeOptions($slot['option']) === normalizeOptions($options)
                    ) {
                        $slot['quantity'] += $gift['quantity'];
                        $slot['create_time'] = $nowMs;
                        $foundStack = true;
                        break;
                    }
                }
            }

            if (!$foundStack) {
                if (empty($emptySlots)) {
                    throw new Exception('Hành trang không đủ chỗ trống!');
                }

                $slotIndex = array_shift($emptySlots);
                $bagItems[$slotIndex] = [
                    'temp_id' => $gift['id'],
                    'quantity' => $gift['quantity'],
                    'create_time' => $nowMs,
                    'option' => $options
                ];
            }
        }

        /* =========================
         * 7. UPDATE HÀNH TRANG (1 LẦN)
         * ========================= */
        $bagJson = json_encode($bagItems, JSON_UNESCAPED_UNICODE);
        $stmt = $config->prepare("UPDATE player SET items_bag = ? WHERE id = ?");
        $stmt->bind_param("si", $bagJson, $player_id);
        $stmt->execute();

        $config->commit();
        $thongbao = 'Nhận quà thành công! Vui lòng kiểm tra trong game.';

    } catch (Exception $e) {
        $config->rollback();
        $thongbao = $e->getMessage();
    }

    echo "<script>
        alert(" . json_encode($thongbao) . ");
        window.location.href = window.location.pathname;
    </script>";
    exit;
}


if(isset($_POST['day'])){
    $day = intval($_POST['day']);
    receive($day);
}