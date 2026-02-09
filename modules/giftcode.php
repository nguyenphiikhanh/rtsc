<?php
require_once __DIR__ . '/../config/config.php';

function __get_gift_codes()
{
    global $config;
    $query = "SELECT * FROM giftcode";

    $result = $config->query($query);
    $data = [];
    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}