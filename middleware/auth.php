<?php
session_start();
global $is_authenticated;
$is_authenticated = $_SESSION['is_authenticated'] ?? '';