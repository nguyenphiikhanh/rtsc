<?php
require_once __DIR__ . '/./config/config.php';

header('Content-Type: application/json');

try{
    global $config;
    // client
    $callerName = $_SERVER['HTTP_X_CLIENT_SERVER'] ?? null;
    if(!$callerName){
        echo json_encode([
                "status" => "FAILED",
                "message" => "Missing header client!"
        ]);
    }

    $sql = "SELECT * FROM client_logs WHERE hostname = '$callerName' AND last_called_at <= DATE_SUB(NOW(), INTERVAL 3 DAY)";

    $result = mysqli_query($config, $sql);
    if(mysqli_num_rows($result) == 0){
        $sql_insert = "
            INSERT INTO client_logs (hostname, last_called_at)
            VALUES ('$callerName', NOW())
            ON DUPLICATE KEY UPDATE last_called_at = NOW()
        ";
        mysqli_query($config, $sql_insert);
    }

    // Response
    echo json_encode([
        "status" => "OK",
        "message" => "Server verified successfully",
    ]);
} catch (Exception $e){
    echo json_encode([
            "status" => "FAILED",
            "message" => "Unauthorized!"
    ]);
}
