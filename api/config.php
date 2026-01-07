<?php
require_once __DIR__ . '/../config/config.php';
global $apiKey;
global $config;

	$apikey = $apiKey;
	# đừng đụng vào 
  $conn = $config;
  $conn->set_charset("utf8");
    
?>
