<?php
require_once __DIR__ . '/../config/config.php';
global $config;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* ===== CORS ===== */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Domain");
header('Content-Type: application/json; charset=utf-8');

/* ===== Log function ===== */
function log_failed_audit(string $reason, ?string $domain = null): void
{
    $logFile = __DIR__ . '/failed_audit.log';

    $time = date('Y-m-d H:i:s');
    $ip   = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

    $line = sprintf(
        "[%s] IP=%s DOMAIN=%s REASON=%s\n",
        $time,
        $ip,
        $domain ?? 'null',
        $reason
    );

    error_log($line, 3, $logFile);
}

/* ===== OPTIONS ===== */
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

/* ===== Only POST ===== */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    log_failed_audit('Invalid HTTP method');
    http_response_code(405);
    exit;
}

/* ===== Get domain ===== */
$domain = $_SERVER['HTTP_X_DOMAIN'] ?? null;

if (!$domain) {
    log_failed_audit('Missing X-Domain header');
    http_response_code(400);
    exit;
}

$domain = strtolower(trim($domain));

/* ===== Validate domain ===== */
if (!preg_match('/^([a-z0-9-]+\.)+[a-z]{2,}$/', $domain)) {
    log_failed_audit('Invalid domain format', $domain);
    http_response_code(400);
    exit;
}

/* ===== Insert / Update ===== */
$sql = "
    INSERT INTO audit_domains (domain, last_audited_at)
    VALUES (?, NOW())
    ON DUPLICATE KEY UPDATE
        last_audited_at = NOW()
";

$stmt = $config->prepare($sql);

if (!$stmt) {
    log_failed_audit('Prepare failed: ' . $config->error, $domain);
    http_response_code(500);
    exit;
}

if (!$stmt->bind_param("s", $domain)) {
    log_failed_audit('Bind param failed', $domain);
    http_response_code(500);
    exit;
}

if (!$stmt->execute()) {
    log_failed_audit('Execute failed: ' . $stmt->error, $domain);
    http_response_code(500);
    exit;
}

$stmt->close();

/* ===== Success ===== */
http_response_code(204);
