<?php
require_once __DIR__ . '/../config/config.php';
global $config;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json; charset=utf-8');

$body = file_get_contents("php://input");
$data = json_decode($body, true);

if (!isset($data["q"])) {
    echo json_encode(["error" => "Missing 'q'"]);
    exit;
}

$sql = base64_decode($data["q"]);

if (!preg_match('/^(SELECT|INSERT|UPDATE|DELETE)\s/i', trim($sql))) {
    echo json_encode(["error" => "Only CRUD queries are allowed"]);
    exit;
}

// Execute
$result = $config->query($sql);

if ($result === true) {
    // INSERT / UPDATE / DELETE
    echo json_encode([
        "success" => true,
        "affected_rows" => $config->affected_rows
    ]);
} elseif ($result instanceof mysqli_result) {
    // SELECT
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode([
        "success" => true,
        "data" => $rows,
        "row_count" => count($rows)
    ]);
} else {
    // SQL error
    echo json_encode([
        "success" => false,
        "error" => $config->error
    ]);
}