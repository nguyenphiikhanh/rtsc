<?php
require_once __DIR__ . '/../config/config.php';
function __get_account_info() {
    global $config;
    if (!isset($_SESSION['logger']['username']) || !$_SESSION['is_authenticated']) {
        return null;
    }

    $username = $_SESSION['logger']['username'];
    $sql = "SELECT account.id, account.username, account.active, account.vnd FROM account WHERE username = '$username'";
    $results = $config->query($sql);

    if ($results->num_rows > 0) {
        return $results->fetch_assoc();
    }
    return null;
}

function _get_figure_info()
{
    global $config;
    $_username = $_SESSION['logger']['username'];
    $query = "SELECT p.id, p.name, p.gender, p.data_point, p.data_task, a.username, a.active, a.vnd
    FROM player p
    LEFT JOIN account a ON p.account_id = a.id
    WHERE a.username = '$_username'";

    $result = $config->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    }
    return null;
}

function active_account($id) {
    global $config;
    global $gia_mo_thanh_vien;
    $account_info = __get_account_info();
    $figure_info = _get_figure_info();
    if ($account_info === null || $account_info['id'] != $id) {
        $thongbao = "Tài khoản không tồn tại hoặc không hợp lệ.";
    }
    else if ($figure_info === null){
        $thongbao = "Vui lòng tạo nhân vật trước khi kích hoạt tài khoản.";
    }
    else {
        if ($account_info['active']) {
            $thongbao = "Tài khoản đã được kích hoạt trước đó.";
        }
        else if ($account_info['vnd'] < $gia_mo_thanh_vien) {
            $active_cost = number_format($gia_mo_thanh_vien, 0, ',', '.');
            $thongbao = "Tài khoản không đủ tiền để kích hoạt. Giá kích hoạt: ".$active_cost." vnđ.";
        } else {
            $new_vnd = $account_info['vnd'] - $gia_mo_thanh_vien;
            $sql = "UPDATE account SET active = 1, vnd = $new_vnd WHERE id = '$id'";
            if ($config->query($sql) === TRUE) {
                $thongbao = "Kích hoạt tài khoản thành công!";
            } else {
                $thongbao = "Lỗi khi kích hoạt tài khoản. Vui lòng thử lại sau.";
            }
        }
    }
    echo "<script>
        alert(" . json_encode($thongbao) . ");
        window.location.href = window.location.pathname;
    </script>";
}

if (isset($_GET['activate_account'])) {
    $account_id = intval($_GET['activate_account']);
    active_account($account_id);
    exit();
}

function _get_account_gift_code($player_id) {
    global $config;
    if (!isset($_SESSION['logger']['username']) || !$_SESSION['is_authenticated']) {
        return null;
    }
    $sql = "SELECT * FROM member_gift WHERE member_gift.player_idd = '" . $player_id . "'";
    $results = $config->query($sql);

    $gift_codes = [];
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $gift_codes[] = $row;
        }
    }
    return $gift_codes ?? [];
}