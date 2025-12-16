<?php
require_once __DIR__ . '/../config/config.php';
function __get_account_info($get_password = false) {
    global $config;
    if (!isset($_SESSION['logger']['username']) || !$_SESSION['is_authenticated']) {
        return null;
    }

    $username = $_SESSION['logger']['username'];
    $sql = "SELECT account.id, account.username, account.active, account.vnd FROM account WHERE username = '$username'";
    if($get_password) {
        $sql = "SELECT account.id, account.password, account.username, account.active, account.vnd FROM account WHERE username = '$username'";
    }
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
    $sql = "
    SELECT
        mg.coded,
        CASE 
            WHEN mgl.coded IS NOT NULL THEN 1
            ELSE 0
        END AS is_used
    FROM member_gift mg
    LEFT JOIN member_gift_lichsu mgl 
        ON mgl.coded = mg.coded
    WHERE mg.player_idd = '" . $player_id . "'
    ";
    $results = $config->query($sql);

    $gift_codes = [];
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $gift_codes[] = $row;
        }
    }
    return $gift_codes ?? [];
}

function change_password() {
    global $config;
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $old_password = mysqli_real_escape_string($config, $old_password);
    $new_password = mysqli_real_escape_string($config, $new_password);
    $confirm_password = mysqli_real_escape_string($config, $confirm_password);
    $account_info = __get_account_info(true);
    if ($account_info === null) {
        $thongbao = "Tài khoản không tồn tại hoặc không hợp lệ.";
    } else if ($old_password !== $account_info['password']) {
        $thongbao = "Mật khẩu hiện tại không đúng.";
    } else if( $new_password !== $confirm_password) {
        $thongbao = "Mật khẩu mới và xác nhận mật khẩu không khớp.";
    } else {
        $account_id = $account_info['id'];
        $sql = "UPDATE account SET password = '$new_password' WHERE id = '$account_id'";
        if ($config->query($sql) === TRUE) {
            $thongbao = "Đổi mật khẩu thành công!";
        } else {
            $thongbao = "Lỗi khi đổi mật khẩu. Vui lòng thử lại sau.";
        }
    }
    echo "<script>
        alert(" . json_encode($thongbao) . ");
        window.location.href = window.location.pathname;
    </script>";
}

if (isset($_POST['submit_change_password'])) {
    change_password();
    exit();
}