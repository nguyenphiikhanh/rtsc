<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../helper/helper.php';
require_once __DIR__ . '/../middleware/auth.php';

function register(){
    global $config;
    global $is_authenticated;
    if($is_authenticated){ // đã login
        redirectHome();
        exit();
    }
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($config, $username);
	$password = mysqli_real_escape_string($config, $password);

    $sql = "SELECT * FROM account WHERE username = '$username'";
    $redirect_path = define_url('home.php');
    $account = mysqli_query($config,$sql);
        if(mysqli_num_rows($account) > 0){
            $thongbao = 'Tài khoản đã tồn tại';
            $script = '
            var thongbao = ' . json_encode($thongbao) . ';
            if (thongbao !== "") {
                alert(thongbao);
                window.location = "' . $redirect_path . '";
            }
            ';
            
            echo '<script>' . $script . '</script>';
        } else {
            $sql = "INSERT INTO account (username, password) VALUES ('$username', '$password')";
            $result = mysqli_query($config,$sql);
            if($result){
                $thongbao = 'Đăng ký thành công!';
            }else {
                $thongbao = 'Có lỗi xảy ra, vui lòng thử lại!';
            }
            $script = '
            var thongbao = ' . json_encode($thongbao) . ';
            if (thongbao !== "") {
                alert(thongbao);
                window.location = "' . $redirect_path . '";
            }
            ';

            echo '<script>' . $script . '</script>';
        }
    exit();
}

function login(){
    global $config;
    global $is_authenticated;
    if($is_authenticated){ // đã login
        redirectHome();
        exit();
    }
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($config, $username);
	$password = mysqli_real_escape_string($config, $password);

    $sql = "SELECT * FROM account WHERE username = '$username' AND password = '$password'";
    $redirect_path = define_url('home.php');
    $account = mysqli_query($config,$sql);
    if(mysqli_num_rows($account) > 0){
        $account_info = $account->fetch_assoc();
        session_start();

        $_SESSION['is_authenticated'] = true;
        $_SESSION['logger']['username'] = $username;
        $_SESSION['logger']['user_id'] = $account_info['id'];

        $thongbao = 'Đăng nhập thành công';
        $script = '
        var thongbao = ' . json_encode($thongbao) . ';
        if (thongbao !== "") {
            alert(thongbao);
            window.location = "' . $redirect_path . '";
        }
        ';
        
        echo '<script>' . $script . '</script>';
    } else {
        $thongbao = 'Sai tài khoản hoặc mật khẩu!';
        $redirect_path = define_url('home.php');
        $script = '
        var thongbao = ' . json_encode($thongbao) . ';
        if (thongbao !== "") {
            alert(thongbao);
            window.location = "' . $redirect_path . '";
        }
        ';

        echo '<script>' . $script . '</script>';
    }
    exit();
}

function get_auth_info(){
    auth();
    return [
        'username' => $_SESSION['logger']['username'] ?? '',
        'user_id' => $_SESSION['logger']['user_id'] ?? '',
    ];
}

if(isset($_POST['submit'])){
    login();
}

if(isset($_POST['submit_register'])){
    register();
}

function logout(){
    session_start();
    session_destroy();
    $redirect_path = define_url('home.php');
    header('Location: '.$redirect_path);
}


function auth(){
    global $is_authenticated;
    if (!$is_authenticated){
        $thongbao = 'Vui lòng đăng nhập để tiếp tục!';
        $redirect_path = define_url('home.php');
        $script = '
            var thongbao = ' . json_encode($thongbao) . ';
            if (thongbao !== "") {
                alert(thongbao);
                window.location = "' . $redirect_path . '";
            }
            ';

        echo '<script>' . $script . '</script>';
//        logout();
    }
}