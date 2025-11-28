<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../helper/helper.php';

function register(){
    global $config;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($config, $username);
	$password = mysqli_real_escape_string($config, $password);

    $sql = "SELECT * FROM account WHERE username = '$username'";
    $account = mysqli_query($config,$sql);
        if(mysqli_num_rows($account) > 0){
            $thongbao = 'Tài khoản đã tồn tại';
            $basePath = getBaseUrl();
            $redirect_path = $basePath . 'home.php';
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
            $thongbao = '';
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
            }
            ';

            echo '<script>' . $script . '</script>';
        }
    exit();
}

function login(){
    global $config;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($config, $username);
	$password = mysqli_real_escape_string($config, $password);

    $sql = "SELECT * FROM account WHERE username = '$username' AND password = '$password'";
    $account = mysqli_query($config,$sql);
    if(mysqli_num_rows($account) > 0){
        session_start();
        
        $_SESSION['logger']['username'] = $username;
        $_SESSION['logger']['password'] = $password;
        $_SESSION['account'] = $username;
        $_SESSION['is_authenticated'] = true;
        
        $thongbao = 'Đăng nhập thành công';
        $basePath = getBaseUrl();
        $redirect_path = $basePath . '/home.php';
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
        $script = '
        var thongbao = ' . json_encode($thongbao) . ';
        if (thongbao !== "") {
            alert(thongbao);
        }
        ';

        echo '<script>' . $script . '</script>';
    }
    exit();
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
    $basePath = getBaseUrl();
    $newURL = '../home.php';
    header('Location: '.$newURL);
}