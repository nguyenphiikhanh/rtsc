<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../constants/constants.php';
require_once __DIR__ . '/../auth/auth.php';
function get_receive_data(){
    global $config;

    $userinfo = get_auth_info();
    $username = $userinfo['username'];
    $sql = "SELECT id, username, create_time, ban FROM account WHERE username = $username";
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

function receive($day){
    global $config;

    $userinfo = get_auth_info();
    $username = $userinfo['username'];
    $thongbao = '';
    try{
        $sql = "SELECT account.id, ban, account.username, player.name
                FROM account INNER JOIN player ON account.id = player.account_id 
                WHERE account.username = '$username'";
        $results = $config->query($sql);
        if($results->num_rows > 0){
            $account = $results->fetch_assoc();
            $account_id = $account['id'];
            $is_banned = $account['ban'];
            if($is_banned) {
                $thongbao = 'Tài khoản của bạn đã bị khóa, không thể nhận quà!';
            } else{
                $start = date("Y-m-d 00:00:00");
                $end   = date("Y-m-d 23:59:59");
                $receiveSql =  "SELECT * FROM qua_dang_nhap_history WHERE account_id = $account_id AND date_received BETWEEN '$start' AND '$end'";
                $receive_results = $config->query($receiveSql);
                if($receive_results->num_rows == 0){
                    $now_str = date("Y-m-d H:i:s");
                    $insertSql = "INSERT INTO qua_dang_nhap_history (account_id, date_received, day) VALUES ($account_id, '$now_str', $day)";
                    mysqli_query($config,$insertSql);
                    $thongbao = 'Nhận quà thành công, vui lòng kiểm tra trong game!';
                }
                else{ // đã nhận quà
                    $thongbao = 'Tham lam vừa thôi, đmm!';
                }
            }
        }
        else{
            $thongbao = 'Vui lòng tạo nhân vật trong game để nhận quà!';
        }
        $script = ' var thongbao = ' . json_encode($thongbao) . ';
            if (thongbao !== "") {
                alert(thongbao);
                window.location.href = window.location.pathname;
            }
            ';

        echo '<script>' . $script . '</script>';
        exit();
    }
    catch (Exception $e){
        die('Lỗi hệ thống, vui lòng thử lại sau!'. $e->getMessage());
        $thongbao = 'Lỗi hệ thống, vui lòng thử lại sau!';
        $script = ' var thongbao = ' . json_encode($thongbao) . ';
            if (thongbao !== "") {
                alert(thongbao);
                window.location.href = window.location.pathname;
            }
            ';

        echo '<script>' . $script . '</script>';
        exit();
    }
}

if(isset($_POST['day'])){
    $day = intval($_POST['day']);
    receive($day);
}