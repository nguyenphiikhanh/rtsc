<?php
/**
 * Webhook nhận giao dịch SePay / BankAPI
 * - Đọc JSON POST
 * - Parse accountId từ description hoặc content theo mẫu: vuinro{ID}
 * - Ghi log vào lichsunap_seapay
 * - Chống cộng trùng theo referenceCode
 * - Cộng tiền + thưởng vào account (vnd, tongnap)
 * - Ghi lịch sử vào lichsu_yeucaunap (name, username, total, payment_status, date)
 * - Trả JSON thuần (không echo iframe/HTML)
 */

require_once __DIR__ . '/./config/config.php';
global $config;

header('Content-Type: application/json; charset=utf-8');

// Đọc request body
$body = file_get_contents('php://input');
file_put_contents('log_webhook.txt', '[' . date('Y-m-d H:i:s') . "] $body" . PHP_EOL, FILE_APPEND);

// Parse JSON
$data = json_decode($body, true);
if (!$data || !isset($data['transferAmount']) || (!isset($data['description']) && !isset($data['content']))) {
    http_response_code(400);
    echo json_encode(['status' => 'fail', 'reason' => 'Invalid data']);
    exit;
}

// Lấy các trường
$gateway        = (string)($data['gateway'] ?? 'SePay');
$transactionAt  = (string)($data['transactionDate'] ?? date('Y-m-d H:i:s'));
$accountNumber  = (string)($data['accountNumber'] ?? '');
$code           = isset($data['code']) ? (string)$data['code'] : null;
$content        = (string)($data['content'] ?? '');
$description    = (string)($data['description'] ?? '');
$transferType   = (string)($data['transferType'] ?? '');
$amount         = (float)$data['transferAmount'];
$referenceCode  = (string)($data['referenceCode'] ?? '');
$createdNow     = date('Y-m-d H:i:s');

// Chỉ nhận tiền vào
if (strtolower($transferType) !== 'in') {
    http_response_code(200);
    echo json_encode(['status' => 'ignored', 'reason' => 'Not an incoming transfer']);
    exit;
}

// Tách accountId từ description hoặc content: "assassin{ID}"
$accountId = null;
if (preg_match('/assassin(\d+)/i', $description, $m)) {
    $accountId = (int)$m[1];
} elseif (preg_match('/assassin(\d+)/i', $content, $m)) {
    $accountId = (int)$m[1];
}

if (!$accountId || $amount <= 0) {
    http_response_code(400);
    echo json_encode(['status' => 'fail', 'reason' => 'Invalid transaction format or amount']);
    exit;
}

// BẮT ĐẦU TRANSACTION để tránh cộng trùng/partial
$config->begin_transaction();

try {
    // 1) Chống cộng trùng: nếu reference_number đã có thì bỏ qua cộng lại
    //    (Khuyến nghị: đặt UNIQUE KEY cho lichsunap_seapay.reference_number)
    $stmtChk = $config->prepare("SELECT id FROM lichsunap_seapay WHERE reference_number = ? LIMIT 1");
    $stmtChk->bind_param("s", $referenceCode);
    $stmtChk->execute();
    $rsChk = $stmtChk->get_result();
    $alreadyLogged = $rsChk && $rsChk->num_rows > 0;
    $stmtChk->close();

    // 2) Lấy username theo accountId
    $stmtAcc = $config->prepare("SELECT username FROM account WHERE id = ?");
    $stmtAcc->bind_param("i", $accountId);
    $stmtAcc->execute();
    $rsAcc = $stmtAcc->get_result();
    if (!$rsAcc || $rsAcc->num_rows === 0) {
        throw new Exception('Invalid account ID');
    }
    $username = $rsAcc->fetch_assoc()['username'];
    $stmtAcc->close();

    // 3) Luôn log lichsunap_seapay nếu chưa có reference_number (idempotent theo ref)
    if (!$alreadyLogged) {
        $txnContent = ($description !== '') ? $description : $content;
        $stmtLog = $config->prepare("
				INSERT INTO lichsunap_seapay
				(gateway, transaction_date, account_number, amount_in, code, transaction_content, reference_number, body)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?)
			");
        $stmtLog->bind_param(
            "sssdssss",
            $gateway,
            $transactionAt,
            $accountNumber,
            $amount,
            $code,
            $txnContent,
            $referenceCode,
            $body
        );
        $stmtLog->execute();
        $stmtLog->close();
    }

    // 4) Nếu đã log rồi (trùng ref) thì không cộng tiền lần nữa
    if ($alreadyLogged) {
        $config->commit();
        http_response_code(200);
        echo json_encode(['status' => 'ok', 'detail' => 'duplicate_ref_ignored']);
        exit;
    }

    // 5) Tính thưởng
    if ($amount <= 500000) {
        $real_amount = $amount * 1;
    } elseif ($amount <= 2000000) {
        $real_amount = $amount * 1;
    } elseif ($amount <= 5000000) {
        $real_amount = $amount * 1;
    } else {
        $real_amount = $amount * 1;
    }

    // 6) Cộng tiền vào account (vnd + thưởng, tongnap + số gốc)
    $stmtUpd = $config->prepare("UPDATE account SET vnd = vnd + ?, tongnap = tongnap + ? WHERE id = ?");
    $stmtUpd->bind_param("ddi", $real_amount, $amount, $accountId);
    $stmtUpd->execute();
    if ($stmtUpd->affected_rows < 1) {
        throw new Exception('Failed to update account balance');
    }
    $stmtUpd->close();

    // 7) Ghi lịch sử nạp cho UI đọc (ĐỒNG BỘ cột: name, username, total, payment_status)
    $name = "vuinro{$accountId}";
    $stmtHis = $config->prepare("
        INSERT INTO lichsu_yeucaunap (name, username, total, payment_status)
        VALUES (?, ?, ?, 'Paid')
    ");
    $stmtHis->bind_param("ssd", $name, $username, $amount);
    $stmtHis->execute();
    $stmtHis->close();

    // HOÀN TẤT
    $config->commit();
    http_response_code(200);
    echo json_encode(['status' => 'ok']);

} catch (Throwable $e) {
    // ROLLBACK khi có lỗi
    $config->rollback();
    http_response_code(500);
    echo json_encode(['status' => 'fail', 'reason' => $e->getMessage()]);
}
