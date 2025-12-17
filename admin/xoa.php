<?php

require_once __DIR__ . '/../config/config.php';
global $config;

$sql = "SELECT DISTINCT `icon_id` FROM `item_template` WHERE `icon_id` IS NOT NULL";

$result = $config->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row['icon_id'];
    }
}

$dir = __DIR__ . '/./public/public-assets/icon';
$keep = [];

foreach ($data as $icon_id) {
    $keep[] = (string)$icon_id . '.png';
}

$deleted = [];
$count = 0;
if (is_dir($dir)) {
    foreach (glob(rtrim($dir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . '*.png') as $file) {
        $filename = basename($file);
        if (!in_array($filename, $keep, true)) {
            $count++;
            if (@unlink($file)) {
                $deleted[] = $filename;
            }
        }
    }
}
header('Content-Type: application/json; charset=utf-8');
echo json_encode(['deleted' => count($data)."-". $count]);