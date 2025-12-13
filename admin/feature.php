<?php
// =======================================================
// ADMIN PANEL (HARDENED, AUTO-RECOVER FROM CSRF FAILURE)
// =======================================================
// BẮT BUỘC: KHÔNG có ký tự/echo nào trước đoạn này
// Chống "headers already sent" do BOM/echo sớm
ob_start();

// ================== SESSION SETTINGS ==================
$cookieDomain = $_SERVER['HTTP_HOST'] ?? '';
if (strpos($cookieDomain, ':') !== false) $cookieDomain = explode(':', $cookieDomain)[0]; // bỏ port
if ($cookieDomain === 'localhost') $cookieDomain = ''; // để trống trên localhost

session_set_cookie_params([
    'lifetime' => 60*60*24*7,
    'path'     => '/',
    // 'domain'   => $cookieDomain, // <-- có thể BỎ dòng này trên localhost
    'secure'   => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
    'httponly' => true,
    'samesite' => 'Lax',
]);

ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_secure', (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? '1' : '0');
ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 7);

// [SEC] Ẩn lỗi khỏi người dùng, log vào file
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php-error.log');

session_start();

// ------------------ Helpers cơ bản ------------------
function is_https(): bool {
    return !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
}
function current_url(): string {
    $scheme = is_https() ? 'https' : 'http';
    $script = $_SERVER['SCRIPT_NAME'] ?? '/';
    $host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
    return $scheme . '://' . $host . $script;
}
if (!function_exists('h')) {
    function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
}


function fmtn(int|float $n): string {
    return number_format((int)$n, 0, '.', '.');
}


// Xoá 1 cookie tiện lợi (không set domain để không lỗi localhost)
function delete_cookie(string $name): void {
    setcookie($name, '', [
        'expires'  => time() - 3600,
        'path'     => '/',
        'secure'   => is_https(),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
}

// [SEC] Nhật ký tác vụ admin (ghi file log)
function audit_log(string $action, array $extra = []): void {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $msg = sprintf('[ADMIN] %s ip=%s ua=%s extra=%s', $action, $ip, $ua, json_encode($extra, JSON_UNESCAPED_UNICODE));
    error_log($msg);
}

// Redirect mang theo message (303) sau POST + giữ thêm query state nếu cần
function redirect_msg(string $target, array $flash = [], array $qs = [], int $code = 303) {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    foreach ($flash as $k => $v) $_SESSION['flash'][$k] = $v;
    if (!empty($qs)) {
        $target .= (strpos($target, '?') === false ? '?' : '&') . http_build_query($qs);
    }
    header('Location: ' . $target, true, $code);
    exit;
}

function render_flash(): void {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    $flash = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']); // dùng xong xoá

    foreach ($flash as $k => $msg) {
        $isErr = (bool)preg_match('/err(or)?$/i', $k);
        $cls   = $isErr ? 'alert-danger' : 'alert-success';
        echo '<div class="alert '.$cls.'" role="alert">'
           . htmlspecialchars($msg, ENT_QUOTES)
           . '</div>';
    }
}

// Tạo CSRF token nếu chưa có
if (empty($_SESSION['secret_csrf'])) {
    $_SESSION['secret_csrf'] = bin2hex(random_bytes(16));
}

// Khi CSRF fail: auto xoá cookie + session rồi quay về trang nhập khoá
function csrf_fail_and_reset(string $why = 'CSRF invalid'): void {
    audit_log('csrf_fail_reset', ['why' => $why, 'uri' => ($_SERVER['REQUEST_URI'] ?? '')]);

    // Xoá cookie phiên PHPSESSID
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', [
            'expires'  => time() - 3600,
            'path'     => $p['path'] ?: '/',
            // không set domain để tránh lỗi trên localhost
            'secure'   => is_https(),
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }

    // Xoá cookie ghi nhớ thiết bị
    delete_cookie('admin_device');

    // Huỷ session hiện tại
    session_unset();
    session_destroy();

    // Đưa người dùng về trang gate với message
    $msg = 'Phiên không hợp lệ hoặc đã hết hạn. Hệ thống đã xoá cookie. Vui lòng nhập khoá truy cập lại.';
    header('X-CSRF-Status: invalid');
    header('Location: ' . current_url() . '?acct_err=' . rawurlencode($msg));
    exit();
}

// -------------- Global CSRF Guard cho mọi POST --------------
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $sess = $_SESSION['secret_csrf'] ?? '';
    $post = (string)($_POST['_csrf'] ?? '');
    if ($sess === '' || $post === '' || !hash_equals($sess, $post)) {
        // Tự động xoá cookie & buộc nhập khoá lại
        csrf_fail_and_reset('Global guard mismatch');
    }
}

// ================== DB CONFIG ==================
require_once __DIR__ . '/../config/config.php';

// ================== ADMIN SECRET (Gate) ==================
require_once __DIR__ . '/./config.php'; // chứa: define('ADMIN_SECRET_HASH','<hash>');
global $config;
$secretHash = getenv('ADMIN_SECRET_HASH');
if (!$secretHash && defined('ADMIN_SECRET_HASH')) $secretHash = ADMIN_SECRET_HASH;
if (!$secretHash || !is_string($secretHash)) {
    http_response_code(500);
    exit('Thiếu ADMIN_SECRET_HASH (env hoặc app_config.php).');
}

// -------- Helpers riêng gate --------
function device_token(string $secretHash): string {
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    return hash_hmac('sha256', $ua . '|admin_device', $secretHash);
}

// ================== CSRF + BRUTE FORCE ==================
$_SESSION['admin_attempts']   = $_SESSION['admin_attempts']   ?? 0;
$_SESSION['admin_lock_until'] = $_SESSION['admin_lock_until'] ?? 0;
$locked = time() < $_SESSION['admin_lock_until'];

// Cookie nhớ thiết bị
if (empty($_SESSION['admin_auth']) && !empty($_COOKIE['admin_device'])) {
    $expected = device_token($secretHash);
    if (hash_equals($_COOKIE['admin_device'], $expected)) {
        $_SESSION['admin_auth'] = true;
        $_SESSION['admin_auth_time'] = time();
        $_SESSION['admin_attempts'] = 0;
        $_SESSION['admin_lock_until'] = 0;
        $_SESSION['admin_auth_fingerprint'] = hash('sha256', $_SERVER['HTTP_USER_AGENT'] ?? '');
    }
}

$errorGate = null;

// Xử lý submit mật khẩu (POST đã được Global Guard kiểm tra CSRF)
if (isset($_POST['admin_secret_submit']) && !$locked) {
    $accessKey = trim((string)($_POST['access_key'] ?? ''));
    if (password_verify($accessKey, $secretHash)) {
        session_regenerate_id(true);
        $_SESSION['admin_auth'] = true;
        $_SESSION['admin_attempts'] = 0;
        $_SESSION['admin_lock_until'] = 0;
        $_SESSION['admin_auth_time'] = time();
        $_SESSION['admin_auth_fingerprint'] = hash('sha256', $_SERVER['HTTP_USER_AGENT'] ?? '');

        setcookie('admin_device', device_token($secretHash), [
            'expires'  => time() + 60*60*24*30,
            'path'     => '/',
            // 'domain'   => $cookieDomain, // <-- có thể BỎ dòng này trên localhost
            'secure'   => is_https(),
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        header('Location: ' . current_url());
        exit();
    } else {
        $_SESSION['admin_attempts']++;
        if ($_SESSION['admin_attempts'] >= 5) {
            $_SESSION['admin_lock_until'] = time() + 10 * 60;
        }
        $errorGate = 'Khóa truy cập không đúng.';
    }
}

// Fingerprint
if (!empty($_SESSION['admin_auth']) && !empty($_SESSION['admin_auth_fingerprint'])) {
    $fpNow = hash('sha256', $_SERVER['HTTP_USER_AGENT'] ?? '');
    if (!hash_equals($_SESSION['admin_auth_fingerprint'], $fpNow)) {
        unset($_SESSION['admin_auth'], $_SESSION['admin_auth_fingerprint'], $_SESSION['admin_auth_time']);
    }
}

// [SEC] Idle timeout 30 phút
if (!empty($_SESSION['admin_auth'])) {
    $IDLE = 30 * 60;
    if (!empty($_SESSION['admin_auth_time']) && (time() - $_SESSION['admin_auth_time']) > $IDLE) {
        // Khi idle timeout: cũng xoá thiết bị để chắc ăn
        delete_cookie('admin_device');
        session_unset();
        session_destroy();
        header('Location: ' . current_url() . '?acct_err=' . rawurlencode('Phiên đã hết hạn do không hoạt động. Vui lòng đăng nhập lại.'));
        exit();
    } else {
        $_SESSION['admin_auth_time'] = time();
    }
}

// =============== CLEAR COOKIES (manual button) ===============
if (isset($_POST['clear_cookies'])) {
    // Qua được global guard rồi => an toàn; cứ xoá sạch và tạo phiên mới trắng
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', [
            'expires'  => time() - 3600,
            'path'     => $p['path'] ?: '/',
            'secure'   => is_https(),
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }
    delete_cookie('admin_device');
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['secret_csrf'] = bin2hex(random_bytes(16));
    header('Location: ' . current_url() . '?acct_msg=' . rawurlencode('Đã xoá cookie phiên. Vui lòng đăng nhập lại.'));
    exit();
}

// ---- Gate form (chưa xác thực) ----
if (empty($_SESSION['admin_auth'])) {
    $remain = $locked ? max(0, $_SESSION['admin_lock_until'] - time()) : 0; ?>
    <!DOCTYPE html><html lang="vi"><head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Nhập khóa truy cập</title>
    <meta name="robots" content="noindex,nofollow">
    <style>
      body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;background:#0f172a;color:#e2e8f0;display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0}
      .card{background:#111827;padding:28px 24px;border-radius:16px;box-shadow:0 10px 30px rgba(0,0,0,.35);width:min(420px,92vw)}
      h1{margin:0 0 14px;font-size:20px}
      label{display:block;margin:10px 0 6px}
      input[type=password]{width:100%;padding:12px 14px;border-radius:10px;border:1px solid #334155;background:#0b1220;color:#e2e8f0;outline:none}
      button{margin-top:14px;width:100%;padding:12px 14px;border:0;border-radius:10px;background:#22c55e;color:#0b1220;font-weight:700;cursor:pointer}
      .err{background:#7f1d1d;color:#fecaca;padding:10px 12px;border-radius:10px;margin-bottom:10px}
      .muted{opacity:.8;font-size:12px;margin-top:8px}
      .lock{background:#1f2937;border:1px dashed #374151;color:#cbd5e1;padding:10px;border-radius:10px;margin-bottom:10px}
    </style></head><body>
      <div class="card">
        <h1>Khoá truy cập bí mật</h1>
        <?php if (isset($_GET['acct_msg'])): ?><div class="muted" style="background:#0b3d2e;color:#b6f0d0;border-radius:10px;padding:8px 10px;margin-bottom:10px"><?= h($_GET['acct_msg']) ?></div><?php endif; ?>
        <?php if (isset($_GET['acct_err'])): ?><div class="err"><?= h($_GET['acct_err']) ?></div><?php endif; ?>
        <?php if (!empty($errorGate)): ?><div class="err"><?= h($errorGate) ?></div><?php endif; ?>
        <?php if ($locked): ?>
          <div class="lock">Bạn đã nhập sai quá nhiều lần. Vui lòng thử lại sau <b><?= ceil($remain/60) ?></b> phút.</div>
        <?php else: ?>
          <form method="post" autocomplete="off">
            <input type="hidden" name="_csrf" value="<?= h($_SESSION['secret_csrf']) ?>">
            <label for="access_key">Nhập khóa truy cập</label>
            <input id="access_key" name="access_key" type="password" required placeholder="••••••••••">
            <button type="submit" name="admin_secret_submit" value="1">Xác minh</button>
            <div class="muted">* Chỉ quản trị viên được cung cấp khóa này.</div>
          </form>
          <form method="post" style="margin-top:10px">
            <input type="hidden" name="_csrf" value="<?= h($_SESSION['secret_csrf']) ?>">
            <button class="btn btn-outline" type="submit" name="clear_cookies" value="1" style="width:100%;padding:10px 14px;border-radius:10px;background:transparent;color:#e2e8f0;border:1px solid #334155;cursor:pointer">
              Xoá cookie phiên (sửa lỗi CSRF)
            </button>
            <div class="muted" style="margin-top:6px">
              Nếu bạn gặp thông báo “CSRF không hợp lệ”, bấm nút này để xóa cookie và thử lại.
            </div>
          </form>
        <?php endif; ?>
      </div>
    </body></html>
    <?php exit();
}

// [SEC] Security headers (chỉ set HSTS khi chạy HTTPS)
if (is_https()) {
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
}
header("Content-Security-Policy: ".
       "default-src 'self'; ".
       "img-src 'self' data: blob:; ".
       "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net; ".
       "font-src 'self' https://fonts.gstatic.com https://cdn.jsdelivr.net; ".
       "script-src 'self' 'unsafe-inline' https://unpkg.com; ".
       "frame-ancestors 'none'");
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: no-referrer');

// ================== PAGE ACTIONS / DATA FEEDS ==================
$linkadmin = 'admin.php';

// ===== Gift: base icon path (đổi cho đúng alias tĩnh của bạn) =====
$ICON_BASE_URL = define_url("admin/public/public-assets/icon/");

// ---- Feed dữ liệu UI: Player/Items/Options/Types ----
$playersList = [];
if ($qrP = $config->query("SELECT id, name FROM player ORDER BY name ASC")) {
    while ($r = $qrP->fetch_assoc()) $playersList[] = $r;
}
$itemTypes = [];
if ($qrT = $config->query("SELECT DISTINCT type FROM Item_template ORDER BY type")) {
    while ($r = $qrT->fetch_assoc()) $itemTypes[] = (int)$r['type'];
}
$itemTemplates = [];
if ($qrI = $config->query("SELECT id,type,gender,name,description,icon_id,part,is_up_to_up,Power_require FROM Item_template ORDER BY name ASC")) {
    while ($r = $qrI->fetch_assoc()) $itemTemplates[] = $r;
}
$optionTemplates = [];
if ($qrO = $config->query("SELECT id,name,type FROM item_option_template ORDER BY type, id")) {
    while ($r = $qrO->fetch_assoc()) $optionTemplates[] = $r;
}

// --- Map nhanh template & option để render tên/icon/option ---
$templateById = [];
foreach ($itemTemplates as $t) { $templateById[(int)$t['id']] = $t; }
$optById = [];
foreach ($optionTemplates as $o) { $optById[(int)$o['id']] = $o; }

// ============= Helpers render lịch sử giao dịch =============
/**
 * Nhận vào chuỗi lưu vật phẩm giao dịch (thường là JSON).
 * Trả về HTML gọn gàng; nếu không parse được thì trả nguyên gốc đã escape.
 */
function render_grouped_items_html($raw): string {
    if ($raw === null || $raw === '') return '<span class="muted">—</span>';
    $html = '';
    $data = json_decode($raw, true);
    if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
        // fallback — không phải JSON đúng chuẩn
        return '<span>'.h($raw).'</span>';
    }

    // Chuẩn hoá về mảng items: mỗi item có temp_id|id, quantity, option (mảng [id,param] hoặc {id,param})
    $items = [];
    foreach ($data as $it) {
        if (!is_array($it)) continue;
        $tid = $it['temp_id'] ?? $it['id'] ?? null;
        $qty = $it['quantity'] ?? 0;
        $opt = $it['option'] ?? $it['options'] ?? [];
        if (!is_numeric($tid) || !is_numeric($qty)) continue;
        $items[] = ['tid' => (int)$tid, 'qty' => (int)$qty, 'opt' => $opt];
    }
    if (!$items) return '<span class="muted">—</span>';

    // Dùng biến toàn cục đã map sẵn meta
    global $templateById, $optById, $ICON_BASE_URL;

    foreach ($items as $it) {
        $tid = $it['tid']; $qty = $it['qty']; $opts = is_array($it['opt']) ? $it['opt'] : [];
        $tpl = $templateById[$tid] ?? null;
        $name = $tpl['name'] ?? ('#'.$tid);
        $icon = ($tpl && !empty($tpl['icon_id'])) ? ($ICON_BASE_URL.$tpl['icon_id'].'.png') : '';
        $html .= '<div style="display:flex;gap:8px;align-items:center;margin:2px 0">';
        if ($icon) $html .= '<img src="'.h($icon).'" alt="" style="width:20px;height:20px;image-rendering:pixelated;object-fit:contain;border-radius:4px;border:1px solid #334155;background:#0b1220">';
        $html .= '<div><b>'.h($name).'</b> x '.(int)$qty;
        // options
        $chips = [];
        foreach ($opts as $pair) {
            if (is_array($pair)) {
                // dạng [id,param] hoặc {'id':..,'param':..}
                $oid = $pair[0] ?? ($pair['id'] ?? null);
                $par = $pair[1] ?? ($pair['param'] ?? null);
                if (is_numeric($oid) && is_numeric($par)) {
                    $oname = $optById[(int)$oid]['name'] ?? ('#'.$oid);
                    $chips[] = h($oname).': '.(int)$par;
                }
            }
        }
        if ($chips) $html .= '<div class="muted" style="margin-top:2px">'.implode(' • ', $chips).'</div>';
        $html .= '</div></div>';
    }
    return $html ?: '<span class="muted">—</span>';
}
// --- Helper: chuẩn hóa cấu trúc items ---
function normalize_items_json($raw, array &$errs, string $label = 'items'): ?string {
    if ($raw === null) $raw = '[]';
    $raw = trim((string)$raw);
    if ($raw === '') {
        // Trả về mảng rỗng nhưng vẫn là JSON hợp lệ
        return json_encode([], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    $arr = json_decode($raw, true);
    if (json_last_error() !== JSON_ERROR_NONE || !is_array($arr)) {
        $errs[] = "Danh sách vật phẩm ($label) không hợp lệ.";
        return null;
    }

    $out = [];
    foreach ($arr as $i => $it) {
        if (!isset($it['id'], $it['quantity'])) {
            $errs[] = "Hàng #".($i+1)." thiếu id/quantity.";
            return null;
        }
        if (!is_numeric($it['id']) || !is_numeric($it['quantity'])) {
            $errs[] = "Hàng #".($i+1)." id/quantity phải là số.";
            return null;
        }

        $opts = [];
        if (isset($it['options'])) {
            if (!is_array($it['options'])) {
                $errs[] = "Hàng #".($i+1)." options phải là mảng.";
                return null;
            }
            foreach ($it['options'] as $j => $op) {
                if (!isset($op['id'], $op['param'])) {
                    $errs[] = "Hàng #".($i+1)." option #".($j+1)." thiếu id/param.";
                    return null;
                }
                if (!is_numeric($op['id']) || !is_numeric($op['param'])) {
                    $errs[] = "Hàng #".($i+1)." option #".($j+1)." id/param phải là số.";
                    return null;
                }
                // Giữ đúng thứ tự key: param → id
                $opts[] = ['param' => (int)$op['param'], 'id' => (int)$op['id']];
            }
        }

        // Giữ đúng thứ tự key: quantity → options → id
        $row = [
            'quantity' => (int)$it['quantity'],
            'options'  => $opts,
            'id'       => (int)$it['id'],
        ];
        $out[] = $row;
    }

    return json_encode($out, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

// --- Khởi tạo $inspect mặc định ---
$inspect = [
  'ok'         => false,
  'err'        => '',
  'player'     => null,
  'items_body' => [],
  'items_bag'  => [],
  'items_box'  => [],
  'pet_info'   => null,
  'pet_body'   => [],
  'agg'        => [],
];

// --- Xử lý tra cứu khi có GET ?inspect=1&inspect_pid=...
if (isset($_GET['inspect']) && $_GET['inspect'] === '1') {
  $pid = (int)($_GET['inspect_pid'] ?? 0);

  if ($pid <= 0) {
    $inspect['err'] = 'Thiếu hoặc sai player_id.';
  } else {
    $stmt = $config->prepare("
      SELECT id,name,items_body,items_bag,items_box,pet_info,pet_body
      FROM player WHERE id=? LIMIT 1
    ");
    $stmt->bind_param("i", $pid);

    if ($stmt->execute()) {
      $res = $stmt->get_result();
      if ($row = $res->fetch_assoc()) {
        $inspect['player'] = ['id' => (int)$row['id'], 'name' => $row['name']];
        $dec = function ($s) { $arr = json_decode($s ?? '', true); return is_array($arr) ? $arr : []; };
        $inspect['items_body'] = $dec($row['items_body']);
        $inspect['items_bag']  = $dec($row['items_bag']);
        $inspect['items_box']  = $dec($row['items_box']);
        $inspect['pet_info']   = json_decode($row['pet_info'] ?? '', true);
        $inspect['pet_body']   = $dec($row['pet_body']);

        $agg = [];
        foreach ([$inspect['items_bag'], $inspect['items_box']] as $src) {
          if (!is_array($src)) continue;
          foreach ($src as $it) {
            $tid = isset($it['temp_id']) ? (int)$it['temp_id'] : -1;
            $qty = isset($it['quantity']) ? (int)$it['quantity'] : 0;
            if ($tid > 0 && $qty > 0) $agg[$tid] = ($agg[$tid] ?? 0) + $qty;
          }
        }
        if (!empty($agg)) arsort($agg, SORT_NUMERIC);
        $inspect['agg'] = $agg;
        $inspect['ok'] = true;
      } else {
        $inspect['err'] = 'Không tìm thấy nhân vật.';
      }
    } else {
      $inspect['err'] = 'Lỗi truy vấn player.';
    }
    $stmt->close();
  }
}

/* ====== LỊCH SỬ GIAO DỊCH (TRADE) ====== */
$tradeHist = [
    'ok'    => false,
    'err'   => '',
    'rows'  => [],
    'page'  => 1,
    'per'   => 20,
    'total' => 0,
    'player'=> null,
];

if (isset($_GET['hist']) && $_GET['hist'] === '1') {
    $pid  = (int)($_GET['hist_pid'] ?? 0);
    $page = max(1, (int)($_GET['page'] ?? 1));
    $per  = max(10, min(100, (int)($_GET['per'] ?? 20)));

    if ($pid <= 0) {
        $tradeHist['err'] = 'Thiếu hoặc sai player_id.';
    } else {
        // Lấy thông tin người chơi theo ID
        $stmt = $config->prepare("SELECT id, name FROM player WHERE id = ? LIMIT 1");
        if (!$stmt) {
            $tradeHist['err'] = 'Lỗi chuẩn bị truy vấn player: '.$config->error;
        } else {
            $stmt->bind_param("i", $pid);
            if ($stmt->execute()) {
                $res = $stmt->get_result();
                if ($row = $res->fetch_assoc()) {
                    $tradeHist['player'] = ['id' => (int)$row['id'], 'name' => $row['name']];

                    // Bảng server lưu dạng "Tên (ID)" → dò theo '%(ID)%'
                    $like   = '%(' . $pid . ')%';
                    $offset = ($page - 1) * $per;

                    // Lấy trang dữ liệu
                    $sqlRows = "
                        SELECT
                            player_1       AS p1,
                            player_2       AS p2,
                            item_player_1  AS it1,
                            item_player_2  AS it2,
                            time_tran      AS t
                        FROM history_transaction
                        WHERE player_1 LIKE ? OR player_2 LIKE ?
                        ORDER BY t DESC
                        LIMIT ?, ?
                    ";
                    $st2 = $config->prepare($sqlRows);
                    if (!$st2) {
                        $tradeHist['err'] = 'Lỗi chuẩn bị truy vấn lịch sử: '.$config->error;
                    } else {
                        $st2->bind_param("ssii", $like, $like, $offset, $per);
                        if ($st2->execute()) {
                            $r2 = $st2->get_result();
                            while ($r = $r2->fetch_assoc()) {
                                $tradeHist['rows'][] = $r;
                            }
                            $st2->close();

                            // Đếm tổng để phân trang
                            $sqlCnt = "
                                SELECT COUNT(*) AS c
                                FROM history_transaction
                                WHERE player_1 LIKE ? OR player_2 LIKE ?
                            ";
                            $st3 = $config->prepare($sqlCnt);
                            if ($st3) {
                                $st3->bind_param("ss", $like, $like);
                                if ($st3->execute()) {
                                    $cRes = $st3->get_result();
                                    $tradeHist['total'] = (int)($cRes->fetch_assoc()['c'] ?? 0);
                                }
                                $st3->close();
                            }

                            $tradeHist['ok']   = true;
                            $tradeHist['page'] = $page;
                            $tradeHist['per']  = $per;
                        } else {
                            $tradeHist['err'] = 'Lỗi thực thi truy vấn lịch sử.';
                            $st2->close();
                        }
                    }
                } else {
                    $tradeHist['err'] = 'Không tìm thấy nhân vật.';
                }
            } else {
                $tradeHist['err'] = 'Lỗi truy vấn player.';
            }
            $stmt->close();
        }
    }
}

// --- Gift: create handler (gift riêng) ---
if (isset($_POST['make_code'])) {
    $errs = [];

    $player_name = trim((string)($_POST['player_name'] ?? ''));
    $typed       = (int)($_POST['typed'] ?? 0);
    $coded       = trim((string)($_POST['coded'] ?? ''));
    $goldd       = (int)($_POST['goldd'] ?? 0);
    $gemd        = (int)($_POST['gemd'] ?? 0);
    $rubyd       = (int)($_POST['rubyd'] ?? 0);
    $statusd    = isset($_POST['statusd']) ? (int)$_POST['statusd'] : 0;
    $actived     = isset($_POST['actived'])  ? (int)$_POST['actived']  : 0;
    $items_json  = (string)($_POST['items_json'] ?? '[]');

    if ($coded === '')       $errs[] = 'Chưa nhập tên giftcode.';
    if ($player_name === '') $errs[] = 'Chưa nhập tên nhân vật.';

    // map player_id theo tên (nên kiểm tra prepare)
    if ($player_name !== '') {
        $stmt = $config->prepare("SELECT id FROM player WHERE name = ? LIMIT 1");
        if (!$stmt) {
            $errs[] = 'Lỗi chuẩn bị truy vấn player: '.$config->error;
        } else {
            $stmt->bind_param("s", $player_name);
            if ($stmt->execute()) {
                $stmt->bind_result($pid);
                $stmt->fetch();
                $stmt->close();
                if (empty($pid)) $errs[] = 'Không tìm thấy nhân vật: '.$player_name;
            } else {
                $errs[] = 'Lỗi thực thi truy vấn player: '.$stmt->error;
                $stmt->close();
            }
        }
    }

    // chuẩn hóa items
    $items_str = normalize_items_json($items_json, $errs, 'itemsd');

    if (empty($errs)) {
        // 1) Tạo bảng (có kiểm tra lỗi)
        $sqlCreate = "CREATE TABLE IF NOT EXISTS `member_gift` (
            `idd` INT AUTO_INCREMENT PRIMARY KEY,
            `player_idd` INT NOT NULL,
            `typed` TINYINT NOT NULL,
            `coded` VARCHAR(64) NOT NULL UNIQUE,
            `goldd` INT DEFAULT 0,
            `gemd` INT DEFAULT 0,
            `rubyd` INT DEFAULT 0,
            `itemsd` TEXT NOT NULL,
            `statusd` TINYINT DEFAULT 0,
            `actived` TINYINT DEFAULT 0,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        if (!$config->query($sqlCreate)) {
            $errs[] = 'Không tạo được bảng Member_gift: '.$config->error;
        }
    }

    if (empty($errs)) {
        // 2) Chuẩn bị INSERT (có kiểm tra lỗi)
		// SAU KHI SỬA (đúng với schema đang có)
		$stmt = $config->prepare("INSERT INTO Member_gift
		   (player_idd, typed, coded, goldd, gemd, rubyd, itemsd, statusd, actived)
		   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            $errs[] = 'Lỗi chuẩn bị INSERT member_gift: '.$config->error;
        } else {
            $stmt->bind_param("iisiiisii", $pid, $typed, $coded, $goldd, $gemd, $rubyd, $items_str, $statusd, $actived);
            if ($stmt->execute()) {
                $stmt->close();
                audit_log('make_code', ['code'=>$coded, 'player_id'=>$pid]);

                $items_count = 0;
                if ($items_str !== '') {
                    $tmp = json_decode($items_str, true);
                    if (is_array($tmp)) $items_count = count($tmp);
                }
                $msg = "Tạo giftcode RIÊNG: {$coded} cho {$player_name} | Type {$typed} | Vàng +".fmtn($goldd)." | Ngọc +".fmtn($gemd)." | Hồng +".fmtn($rubyd)." | Vật phẩm: {$items_count}";
                redirect_msg($linkadmin, ['gift_msg' => $msg]);
            } else {
                // Bắt duplicate code thân thiện
                if (strpos($stmt->error, 'Duplicate') !== false) {
                    $errs[] = 'Tên giftcode đã tồn tại. Vui lòng chọn tên khác.';
                } else {
                    $errs[] = 'Lỗi lưu giftcode: '.$stmt->error;
                }
                $stmt->close();
            }
        }
    }

    if (!empty($errs)) {
        redirect_msg($linkadmin, ['gift_err' => implode(' | ', $errs)]);
    }
}
// ====== GIFT CODE CHUNG (toàn server) ======
if (isset($_POST['make_server_code'])) {
    $errs = [];

    $type       = (int)($_POST['g_type'] ?? 0);
    $code       = trim((string)($_POST['g_code'] ?? ''));
    $gold       = (int)($_POST['g_gold'] ?? 0);
    $gem        = (int)($_POST['g_gem']  ?? 0);
    $ruby       = (int)($_POST['g_ruby'] ?? 0);
    $status     = isset($_POST['g_status']) ? (int)$_POST['g_status'] : 0;
    $active     = isset($_POST['g_active']) ? (int)$_POST['g_active'] : 0;
    $items_json = (string)($_POST['g_items_json'] ?? '[]');

    if ($code === '') $errs[] = 'Chưa nhập tên giftcode chung.';

    // chuẩn hóa items theo cấu trúc yêu cầu
    $items_str = normalize_items_json($items_json, $errs, 'items');

    if (empty($errs)) {
        $config->query("CREATE TABLE IF NOT EXISTS gift_codes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            type TINYINT NOT NULL,
            code VARCHAR(64) NOT NULL UNIQUE,
            gold INT DEFAULT 0,
            gem INT DEFAULT 0,
            ruby INT DEFAULT 0,
            items TEXT NOT NULL,
            status TINYINT DEFAULT 0,
            active TINYINT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $stmt = $config->prepare("INSERT INTO gift_codes
            (type, code, gold, gem, ruby, items, status, active)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isiiisii", $type, $code, $gold, $gem, $ruby, $items_str, $status, $active);

        if ($stmt->execute()) {
            $stmt->close();
            audit_log('make_server_code', ['code'=>$code]);$items_count = 0;
			if (!empty($items_str)) {
				$tmp = json_decode($items_str, true);
				if (is_array($tmp)) $items_count = count($tmp);
			}
			$msg = "Tạo giftcode CHUNG: {$code} | Type {$type} | Trạng thái: {$status} | Đối tượng: {$active} | Vàng +".fmtn($gold)." | Ngọc +".fmtn($gem)." | Hồng +".fmtn($ruby)." | Vật phẩm: {$items_count}";
			redirect_msg($linkadmin, ['gift2_msg' => $msg]);
        } else {
            $err = $stmt->error;
            $stmt->close();
            $errs[] = "Lỗi lưu gift code chung: $err";
        }
    }
    if (!empty($errs)) redirect_msg($linkadmin, ['gift2_err' => implode(' | ', $errs)]);
}

/* ==== HANDLER: block / unlock theo IP cho phần Kiểm tra clone ==== */
if (isset($_POST['block_ip']) || isset($_POST['unlock_ip'])) {
    $target_ip = trim((string)($_POST['target_ip'] ?? ''));
    // [SEC] Validate IP
    if (!filter_var($target_ip, FILTER_VALIDATE_IP)) {
        redirect_msg($linkadmin, ['clone_err' => 'IP không hợp lệ.']);
    }

    $banVal = isset($_POST['block_ip']) ? 1 : 0;
    $stmt = $config->prepare("UPDATE account SET ban = ? WHERE ip_address = ?");
    $stmt->bind_param("is", $banVal, $target_ip);
    if ($stmt->execute()) {
        $stmt->close();
        audit_log($banVal ? 'block_ip' : 'unlock_ip', ['ip'=>$target_ip]);
        redirect_msg(
		  $linkadmin,
		  ['clone_msg' => ($banVal ? "ĐÃ KHÓA IP {$target_ip}" : "ĐÃ MỞ KHÓA IP {$target_ip}")],
		  ['inspect_clone' => 1]
		);
    } else {
        $err = $stmt->error;
        $stmt->close();
        redirect_msg($linkadmin, ['clone_err' => "Lỗi cập nhật: $err"]);
    }
}

// ====== Tải danh sách username cho datalist (giới hạn 2000) ======
$accountsList = [];
$qrAcc = $config->query("SELECT username FROM account ORDER BY username ASC LIMIT 2000");
if ($qrAcc) while ($r = $qrAcc->fetch_assoc()) $accountsList[] = $r['username'];

// ====== Xử lý chọn tài khoản để hiển thị (GET) ======
$acctPick = null;
if (!empty($_GET['acct_u'])) {
  $u = trim($_GET['acct_u']);
  $stmt = $config->prepare("SELECT id, username, vnd, tongnap, COALESCE(tongnap_7ngay,0) AS tongnap_7ngay, ban, active, is_admin FROM account WHERE username=? LIMIT 1");
  $stmt->bind_param("s", $u);
  if ($stmt->execute()) {
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) $acctPick = $row;
  }
  $stmt->close();
}

// ====== Xử lý form quản lý tài khoản (POST) ======
if (isset($_POST['acct_manage'])) {
  $errs = [];

  $username = trim((string)($_POST['acct_username'] ?? ''));
  $op       = (string)($_POST['op'] ?? '');
	$delta = 0;
	switch ($op) {
	  case 'add_vnd':
	  case 'sub_vnd':
		$delta = (int)($_POST['delta_vnd'] ?? 0);
		break;
	  case 'add_coin':
	  case 'sub_coin':
		$delta = (int)($_POST['delta_coin'] ?? 0);
		break;
	  case 'add_top7':
	  case 'sub_top7':
		$delta = (int)($_POST['delta_top7'] ?? 0);
		break;
	}

  // [SEC] Validate username
  if ($username === '' || !preg_match('/^[a-z0-9_\.]{3,32}$/i', $username)) $errs[] = 'Tên tài khoản không hợp lệ.';
  if ($op === '') $errs[] = 'Thiếu thao tác.';

  // Lấy thông tin tài khoản (và chặn thao tác với admin)
  $acc = null;
  if (empty($errs)) {
    $sql  = "SELECT id, username, vnd, tongnap, COALESCE(tongnap_7ngay,0) AS tongnap_7ngay, ban, active, is_admin
             FROM account WHERE username=? LIMIT 1";
    $stmt = $config->prepare($sql);
    if (!$stmt) {
      $errs[] = 'Lỗi chuẩn bị truy vấn (lookup): '.$config->error;
    } else {
      $stmt->bind_param("s", $username);
      if ($stmt->execute()) {
        $res = $stmt->get_result();
        if ($row = $res->fetch_assoc()) {
          if ((int)$row['is_admin'] === 1) {
            $errs[] = 'Không thể thao tác với tài khoản admin.';
          } else {
            $acc = $row;
          }
        } else {
          $errs[] = 'Không tìm thấy tài khoản.';
        }
      } else {
        $errs[] = 'Lỗi truy vấn tài khoản: '.$stmt->error;
      }
      $stmt->close();
    }
  }

  // Helper thực thi UPDATE an toàn
  $doUpdate = function(string $sql, string $types, array $params) use ($config, &$errs) : bool {
    $st = $config->prepare($sql);
    if (!$st) { $errs[] = 'Lỗi SQL: '.$config->error; return false; }
    $st->bind_param($types, ...$params);
    $ok = $st->execute();
    if (!$ok) $errs[] = 'Lỗi thực thi: '.$st->error;
    $st->close();
    return $ok;
  };

  if (empty($errs)) {
    // Những thao tác cộng/trừ cần > 0
    $needPos = ['add_vnd','sub_vnd','add_coin','sub_coin','add_top7','sub_top7'];
    if (in_array($op, $needPos, true) && $delta <= 0) {
      $errs[] = 'Giá trị thay đổi phải > 0.';
    }

    if (empty($errs)) {
      $msg = null; // thêm 1 biến để gom thông báo

		switch ($op) {
		  case 'add_vnd': {
			$before = (int)$acc['vnd'];
			$after  = $before + $delta;
			if ($doUpdate("UPDATE account SET vnd = vnd + ? WHERE username=?", "is", [$delta, $username])) {
			  audit_log('add_vnd', ['u'=>$username,'delta'=>$delta]);
			  $msg = "Cộng VND cho {$username}: +".fmtn($delta)." (".fmtn($before)." → ".fmtn($after).")";
			}
			break;
		  }

		  case 'sub_vnd': {
			if ($delta > (int)$acc['vnd']) { $errs[] = 'Không đủ VND để trừ.'; break; }
			$before = (int)$acc['vnd'];
			$after  = $before - $delta;
			if ($doUpdate("UPDATE account SET vnd = vnd - ? WHERE username=?", "is", [$delta, $username])) {
			  audit_log('sub_vnd', ['u'=>$username,'delta'=>$delta]);
			  $msg = "Trừ VND của {$username}: -".fmtn($delta)." (".fmtn($before)." → ".fmtn($after).")";
			}
			break;
		  }

		  case 'add_coin': {
			$before = (int)$acc['tongnap'];
			$after  = $before + $delta;
			if ($doUpdate("UPDATE account SET tongnap = tongnap + ? WHERE username=?", "is", [$delta, $username])) {
			  audit_log('add_coin(tongnap)', ['u'=>$username,'delta'=>$delta]);
			  $msg = "Cộng COIN cho {$username}: +".fmtn($delta)." (".fmtn($before)." → ".fmtn($after).")";
			}
			break;
		  }

		  case 'sub_coin': {
			if ($delta > (int)$acc['tongnap']) { $errs[] = 'Không đủ Coin để trừ.'; break; }
			$before = (int)$acc['tongnap'];
			$after  = $before - $delta;
			if ($doUpdate("UPDATE account SET tongnap = GREATEST(0, tongnap - ?) WHERE username=?", "is", [$delta, $username])) {
			  audit_log('sub_coin(tongnap)', ['u'=>$username,'delta'=>$delta]);
			  $msg = "Trừ COIN của {$username}: -".fmtn($delta)." (".fmtn($before)." → ".fmtn($after).")";
			}
			break;
		  }

		  case 'add_top7': {
			$before = (int)$acc['tongnap_7ngay'];
			$after  = $before + $delta;
			if ($doUpdate("UPDATE account SET tongnap_7ngay = COALESCE(tongnap_7ngay,0) + ? WHERE username=?", "is", [$delta, $username])) {
			  audit_log('add_top7', ['u'=>$username,'delta'=>$delta]);
			  $msg = "Cộng Tổng nạp 7 ngày cho {$username}: +".fmtn($delta)." (".fmtn($before)." → ".fmtn($after).")";
			}
			break;
		  }

		  case 'sub_top7': {
			if ($delta > (int)$acc['tongnap_7ngay']) { $errs[] = 'Không đủ tổng nạp 7 ngày để trừ.'; break; }
			$before = (int)$acc['tongnap_7ngay'];
			$after  = $before - $delta;
			if ($doUpdate("UPDATE account SET tongnap_7ngay = GREATEST(0, COALESCE(tongnap_7ngay,0) - ?) WHERE username=?", "is", [$delta, $username])) {
			  audit_log('sub_top7', ['u'=>$username,'delta'=>$delta]);
			  $msg = "Trừ Tổng nạp 7 ngày của {$username}: -".fmtn($delta)." (".fmtn($before)." → ".fmtn($after).")";
			}
			break;
		  }

		  case 'ban': {
			if ($doUpdate("UPDATE account SET ban = 1 WHERE username=?", "s", [$username])) {
			  audit_log('ban', ['u'=>$username]);
			  $msg = "ĐÃ KHÓA tài khoản {$username}.";
			}
			break;
		  }

		  case 'unban': {
			if ($doUpdate("UPDATE account SET ban = 0 WHERE username=?", "s", [$username])) {
			  audit_log('unban', ['u'=>$username]);
			  $msg = "ĐÃ MỞ KHÓA tài khoản {$username}.";
			}
			break;
		  }

		  case 'activate': {
			if ($doUpdate("UPDATE account SET active = 1 WHERE username=?", "s", [$username])) {
			  audit_log('activate', ['u'=>$username]);
			  $msg = "Kích hoạt thành viên cho {$username} thành công.";
			}
			break;
		  }

		  default:
			$errs[] = 'Thao tác không hợp lệ.';
		}

		if (!empty($errs)) {
		  redirect_msg($linkadmin, ['acct_err'=>implode(' | ', array_filter($errs))], ['acct_u'=>$username]);
		} else {
		  // nếu vì lý do gì đó $msg rỗng, fallback
		  $msg = $msg ?: 'Thao tác thành công.';
		  redirect_msg($linkadmin, ['acct_msg'=>$msg], ['acct_u'=>$username]);
		}
      }
    }


  if (!empty($errs)) {
    redirect_msg($linkadmin, ['acct_err' => implode(' | ', array_filter($errs))], ['acct_u' => $username]);
  } else {
    redirect_msg($linkadmin, ['acct_msg' => 'Thao tác thành công.'], ['acct_u' => $username]);
  }
}

// ====== Xử lý RESET (POST) ======
if (isset($_POST['do_reset'])) {
  $errs = [];

  $mode = (string)($_POST['reset_mode'] ?? '');
  $confirm = trim((string)($_POST['confirm_text'] ?? ''));

  // [SEC] Step-up re-auth: bắt nhập lại admin secret
  $accessConfirm = trim((string)($_POST['access_key_confirm'] ?? ''));
  if ($accessConfirm === '' || !password_verify($accessConfirm, $secretHash)) {
      $errs[] = 'Xác thực lại khóa admin thất bại.';
  }

  if ($mode === 'server') {
    if ($confirm !== 'RESET SERVER') $errs[] = 'Chuỗi xác nhận không đúng (cần nhập: RESET SERVER).';
    if (empty($errs)) {
      $config->begin_transaction();
      try {
        $config->query("SET FOREIGN_KEY_CHECKS=0");
        $config->query("TRUNCATE TABLE player");
        $config->query("TRUNCATE TABLE gift_code_histories");
        $config->query("TRUNCATE TABLE clan_sv1");
        $config->query("TRUNCATE TABLE history_transaction");
        $config->query("UPDATE account SET ban=0, active=0, vnd=0, tongnap=0, tongnap_7ngay=0 WHERE is_admin=0");
        $config->query("SET FOREIGN_KEY_CHECKS=1");
        $config->commit();
        audit_log('reset_server');
        redirect_msg($linkadmin, ['acct_msg'=>'ĐÃ RESET SERVER: xoá player/gift/clan/history + đặt lại số dư tài khoản non-admin.']);
      } catch (Throwable $e) {
        $config->rollback();
        error_log('[ADMIN] reset_server error: '.$e->getMessage());
        $errs[] = 'Lỗi hệ thống khi reset server.';
      }
    }
    if (!empty($errs)) redirect_msg($linkadmin, ['acct_err'=>implode(' | ', $errs)]);
  }
  elseif ($mode === 'accounts') {
    if ($confirm !== 'RESET ACCOUNT') $errs[] = 'Chuỗi xác nhận không đúng (cần nhập: RESET ACCOUNT).';
    if (empty($errs)) {
      if ($config->query("UPDATE account SET ban=0, active=0, vnd=0, tongnap=0, tongnap_7ngay=0 WHERE is_admin=0")) {
        audit_log('reset_accounts');
        redirect_msg($linkadmin, ['acct_msg'=>'ĐÃ reset dữ liệu tài khoản non-admin (ban/active/vnd/tongnap/tongnap_7ngay = 0).']);
      } else {
        $errs[] = 'Lỗi hệ thống khi reset accounts.';
      }
    }
    if (!empty($errs)) redirect_msg($linkadmin, ['acct_err'=>implode(' | ', $errs)]);
  } else {
    redirect_msg($linkadmin, ['acct_err'=>'Chế độ reset không hợp lệ.']);
  }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>

  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" type="image/png" href="img/logo_nro.png" />
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <style>
    :root{--bg:#0f172a;--panel:#111827;--text:#e2e8f0;--muted:#cbd5e1;--border:#334155;--input:#0b1220;--accent:#22c55e;--danger:#ef4444;--warn:#f59e0b;--info:#0ea5e9}
    *{box-sizing:border-box}
    html,body{background:var(--bg);color:var(--text);font-family:system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;margin:0}
    a{color:#93c5fd}
    .container{max-width:1100px;margin:24px auto;padding:0 16px;position:relative;z-index:1}
    .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:16px}
    .hero-text,.card{background:var(--panel);border:1px solid var(--border);border-radius:16px;padding:24px;box-shadow:0 10px 30px rgba(0,0,0,.35)}
    h1,h2,h3{margin:0 0 12px} h2{color:var(--text)}
    form{background:transparent!important;padding:0!important;box-shadow:none!important}
    label{display:block;margin:8px 0 6px}
    input[type=text],input[type=password],input[type=number],input.form-control,.input{width:100%;padding:12px 14px;border-radius:10px;border:1px solid var(--border);background:var(--input);color:var(--text);outline:none}
    input:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(34,197,94,.2)}
    button,.btn{display:inline-flex;align-items:center;justify-content:center;padding:10px 16px;border-radius:10px;border:0;cursor:pointer;font-weight:700}
    .btn-green{background:var(--accent);color:#0b1220}.btn-red{background:var(--danger);color:#0b1220}.btn-outline{background:transparent;color:var(--text);border:1px solid var(--border)}
    .btn-yellow{background:var(--warn);color:#0b1220}
    .row-actions{display:flex;gap:10px;flex-wrap:wrap;justify-content:center}
    .alert{border-radius:10px;padding:10px 12px;margin-top:12px}.alert-danger{background:#7f1d1d;color:#fecaca}.alert-success{background:#064e3b;color:#a7f3d0;border:1px solid #065f46}
    .table{width:100%;border-collapse:collapse;font-size:14px}
    .table th,.table td{padding:12px 14px;border-bottom:1px solid var(--border);text-align:left}
    .table thead th{position:sticky;top:0;background:#0b1220;z-index:2}
    .table tbody tr:nth-child(even){background:rgba(148,163,184,.06)} .table tbody tr:hover{background:rgba(148,163,184,.1)}
    small.muted,.muted{opacity:.8}

    /* Night sky */
    html,body{min-height:100%}
    html{background:radial-gradient(ellipse at bottom,#1B2735 0%,#090A0F 100%)}
    .star-layer{position:fixed;inset:0 auto auto 0;width:1px;height:1px;background:transparent;pointer-events:none;z-index:0;will-change:transform}
    .star-layer::after{content:"";position:absolute;top:2000px;left:0;width:inherit;height:inherit;background:transparent}
    #stars{width:1px;height:1px;animation:animStar 30s linear infinite}
    #stars2{width:2px;height:2px;animation:animStar 60s linear infinite}
    #stars3{width:3px;height:3px;animation:animStar 90s linear infinite}
    @keyframes animStar{from{transform:translateY(0)}to{transform:translateY(-2000px)}}

    .table-wrap{border:1px solid var(--border);border-radius:12px;overflow:auto;background:rgba(148,163,184,.04)}
	  /* giúp xuống dòng gọn cho cột vật phẩm */
	 td.wrap { white-space: normal; line-height: 1.45; }
  </style>
</head>
<body>
  <div id="stars" class="star-layer" aria-hidden="true"></div>
  <div id="stars2" class="star-layer" aria-hidden="true"></div>
  <div id="stars3" class="star-layer" aria-hidden="true"></div>

  <div class="container">
	<?php render_flash(); ?>

    <!-- ========= Tổng quan ========= -->
    <div class="hero-text">
      <form method="POST" style="padding-top:10px;padding-bottom:10px;">
        <?php
        $row  = mysqli_fetch_array(mysqli_query($config,"SELECT SUM(player.tong_nap) AS total_vnd FROM player INNER JOIN account ON account.id = player.account_id WHERE account.is_admin = 0 AND player.name != 'toansoi'"));
        $rowf = mysqli_fetch_array(mysqli_query($config,"SELECT SUM(amount) AS atm FROM mb_bank WHERE status = 1"));
        $rowk = mysqli_fetch_array(mysqli_query($config,"SELECT COUNT(*) as total FROM account WHERE active = 1 AND account.is_admin = 0"));
        $row1 = mysqli_fetch_array(mysqli_query($config,"SELECT SUM(amount) AS total_the FROM trans_log WHERE status = 1"));
        $darut = 0;
        $tongdoangthu = ((int)$row1['total_the'] * 80 / 100) + (int)$rowf['atm'] - $darut;
        ?>
        <h2 style="color:#ef4444">Quản lý Server</h2>
        <center><h3>Tổng Doanh Thu: <span style="color:#73F400;">+ <?= number_format($tongdoangthu) ?><sup>đ</sup></span></h3></center>
        <center><h3>Tổng Thẻ Cào: <span style="color:#0CC0DF;">+ <?= number_format(((int)$row1['total_the'] * 80) / 100) ?><sup>đ</sup></span></h3></center>
        <center><h3>Tổng ATM: <span style="color:#FF3131;">+ <?= number_format((int)$rowf['atm']) ?><sup>đ</sup></span></h3></center>
        <center><h3>Tổng Tài khoản MTV: <span style="color:#0CC0DF;"><?= (int)$rowk['total'] ?> tài khoản</span></h3></center>
      </form>
    </div>

    <br><br>
<!-- ========= Tra cứu & quản lý tài khoản ========= -->
<div class="card">
  <h2>Tra cứu & quản lý tài khoản</h2>

  <?php if (isset($_GET['acct_msg'])): ?>
    <div class="alert" style="background:#064e3b;color:#a7f3d0;border:1px solid #065f46"><?= h($_GET['acct_msg']) ?></div>
  <?php endif; ?>
  <?php if (isset($_GET['acct_err'])): ?>
    <div class="alert alert-danger"><?= h($_GET['acct_err']) ?></div>
  <?php endif; ?>

  <!-- Tìm tài khoản -->
  <form method="get" style="display:flex;gap:12px;align-items:end;flex-wrap:wrap;margin-bottom:10px">
    <div style="min-width:280px">
      <label>Tên tài khoản</label>
      <input name="acct_u" list="acctList" class="input" placeholder="Nhập username..." value="<?= h($_GET['acct_u'] ?? '') ?>">
      <datalist id="acctList">
        <?php foreach ($accountsList as $u): ?>
          <option value="<?= h($u) ?>">
        <?php endforeach; ?>
      </datalist>
    </div>
    <div>
      <button class="btn btn-green" type="submit">Tìm</button>
    </div>
  </form>

  <?php if ($acctPick): ?>
    <!-- Thông tin tài khoản -->
    <div class="table-wrap" style="margin:8px 0 16px">
      <table class="table">
        <thead><tr><th>ID</th><th>Username</th><th>VND</th><th>Coin</th><th>Tổng nạp 7 ngày</th><th>Ban</th><th>Active</th></tr></thead>
        <tbody>
          <tr>
            <td><?= h($acctPick['id']) ?></td>
            <td><?= h($acctPick['username']) ?></td>
            <td><?= number_format((int)$acctPick['vnd'],0,'.','.') ?></td>
            <td><?= number_format((int)$acctPick['tongnap'],0,'.','.') ?></td>
            <td><?= number_format((int)$acctPick['tongnap_7ngay'],0,'.','.') ?></td>
            <td><?= (int)$acctPick['ban'] ? 'ĐANG BAN' : 'KHÔNG' ?></td>
            <td><?= (int)$acctPick['active'] ? 'Đã mở TV' : 'Chưa' ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Thao tác -->
    <form method="post" id="acctForm" style="display:flex;flex-direction:column;gap:12px">
      <input type="hidden" name="_csrf" value="<?= h($_SESSION['secret_csrf']) ?>">
      <input type="hidden" name="acct_manage" value="1">
      <input type="hidden" name="acct_username" value="<?= h($acctPick['username']) ?>">

      <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:12px">
        <div class="hero-text" style="padding:16px">
          <h3 style="margin:0 0 8px">Cộng / Trừ VND</h3>
          <div style="display:flex;gap:8px;align-items:center">
            <input type="number" class="input" name="delta_vnd"  min="1" value="1" style="max-width:160px">
            <button class="btn btn-green" type="submit" name="op" value="add_vnd">+ VND</button>
            <button class="btn btn-red"   type="submit" name="op" value="sub_vnd">- VND</button>
          </div>
        </div>

        <div class="hero-text" style="padding:16px">
          <h3 style="margin:0 0 8px">Cộng / Trừ Coin</h3>
          <div style="display:flex;gap:8px;align-items:center">
            <input type="number" class="input" name="delta_coin" min="1" value="1" style="max-width:160px">
            <button class="btn btn-green" type="submit" name="op" value="add_coin">+ Coin</button>
            <button class="btn btn-red"   type="submit" name="op" value="sub_coin">- Coin</button>
          </div>
        </div>

        <div class="hero-text" style="padding:16px">
          <h3 style="margin:0 0 8px">Cộng / Trừ Tổng nạp 7 ngày</h3>
          <div style="display:flex;gap:8px;align-items:center">
            <input type="number" class="input" name="delta_top7" min="1" value="1" style="max-width:160px">
            <button class="btn btn-green" type="submit" name="op" value="add_top7">+ Top 7 ngày</button>
            <button class="btn btn-red"   type="submit" name="op" value="sub_top7">- Top 7 ngày</button>
          </div>
        </div>
      </div>

      <div class="hero-text" style="padding:16px">
        <h3 style="margin:0 0 8px">Trạng thái tài khoản</h3>
        <div style="display:flex;gap:8px;flex-wrap:wrap">
          <button class="btn btn-red"   type="submit" name="op" value="ban">Ban</button>
          <button class="btn btn-green" type="submit" name="op" value="unban">Mở khóa</button>
          <button class="btn btn-yellow" type="submit" name="op" value="activate">Mở Thành viên</button>
        </div>
      </div>
    </form>
  <?php else: ?>
    <div class="muted">* Nhập và chọn chính xác username, sau đó bấm <b>Tìm</b> để hiển thị thao tác.</div>
  <?php endif; ?>
</div>

<br><br>

<!-- ========= Reset dữ liệu ========= -->
<div class="card">
  <h2>Reset</h2>
  <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:16px">
    <!-- Reset server -->
    <form method="post" class="hero-text" style="padding:18px">
      <input type="hidden" name="_csrf" value="<?= h($_SESSION['secret_csrf']) ?>">
      <input type="hidden" name="do_reset" value="1">
      <input type="hidden" name="reset_mode" value="server">
      <h3 style="margin:0 0 8px">Reset Server (nguy hiểm)</h3>
      <ul class="muted" style="margin:0 0 10px 18px">
        <li>Xóa toàn bộ dữ liệu: <code>player</code>, <code>gift_code_histories</code>, <code>clan_sv1</code>, <code>history_transaction</code></li>
        <li>Đặt lại <code>ban, active, vnd, tongnap, tongnap_7ngay</code> = 0 (tài khoản không phải admin)</li>
      </ul>
      <label>Xác nhận (gõ chính xác): <code>RESET SERVER</code></label>
      <input name="confirm_text" class="input" placeholder="RESET SERVER">
      <!-- [SEC] Step-up re-auth -->
      <label style="margin-top:8px">Nhập lại khóa admin</label>
      <input name="access_key_confirm" type="password" class="input" placeholder="••••••••">
      <div style="margin-top:10px">
        <button class="btn btn-red" type="submit" onclick="return confirm('Thao tác nguy hiểm! Bạn chắc chắn?')">Thực hiện Reset Server</button>
      </div>
    </form>

    <!-- Reset dữ liệu tài khoản -->
    <form method="post" class="hero-text" style="padding:18px">
      <input type="hidden" name="_csrf" value="<?= h($_SESSION['secret_csrf']) ?>">
      <input type="hidden" name="do_reset" value="1">
      <input type="hidden" name="reset_mode" value="accounts">
      <h3 style="margin:0 0 8px">Reset dữ liệu tài khoản</h3>
      <ul class="muted" style="margin:0 0 10px 18px">
        <li>Đặt lại <code>ban, active, vnd, tongnap, tongnap_7ngay</code> = 0 (tài khoản không phải admin)</li>
      </ul>
      <label>Xác nhận (gõ chính xác): <code>RESET ACCOUNT</code></label>
      <input name="confirm_text" class="input" placeholder="RESET ACCOUNT">
      <!-- [SEC] Step-up re-auth -->
      <label style="margin-top:8px">Nhập lại khóa admin</label>
      <input name="access_key_confirm" type="password" class="input" placeholder="••••••••">
      <div style="margin-top:10px">
        <button class="btn btn-yellow" type="submit" onclick="return confirm('Bạn chắc chắn reset dữ liệu tài khoản?')">Thực hiện Reset Accounts</button>
      </div>
    </form>
  </div>
</div>

<br><br>
<div class="card">
  <h2>Tra cứu vật phẩm người chơi</h2>

  <form method="get" onsubmit="return ensureInspectSelected()">
    <input type="hidden" name="inspect" value="1">
    <input type="hidden" id="inspect_pid" name="inspect_pid">

    <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px">
      <div>
        <label>Tên nhân vật</label>
        <input id="pvName" list="pvList" class="input" placeholder="Nhập (không dấu cũng được)">
        <datalist id="pvList"></datalist>
        <div id="pvPreview" class="muted" style="margin-top:6px"></div>
        <small class="muted">* Gõ vài ký tự → chọn đúng gợi ý; hệ thống map sang <code>player_id</code>.</small>
      </div>
      <div style="display:flex;align-items:end">
        <button class="btn btn-green" type="submit">Kiểm tra</button>
      </div>
    </div>
  </form>

  <?php if (!$inspect['ok'] && !empty($_GET['inspect'])): ?>
    <div class="alert alert-danger" style="margin-top:12px"><?php echo h($inspect['err']); ?></div>
  <?php endif; ?>

  <?php if ($inspect['ok']): ?>
    <hr style="border-color:#334155;margin:16px 0">
    <h3 style="margin:0 0 8px">Kết quả cho: <?php echo h($inspect['player']['name']); ?> (ID <?php echo (int)$inspect['player']['id']; ?>)</h3>

    <!-- Trang bị đang mặc (SƯ PHỤ / items_body) -->
    <div class="table-wrap" style="margin-top:12px">
      <table class="table">
        <thead>
          <tr>
            <th style="width:52px">#</th>
            <th>Trang bị (Sư phụ)</th>
            <th style="width:120px">temp_id</th>
            <th>Chỉ số</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=1;
          foreach ($inspect['items_body'] as $it):
            $tid = (int)($it['temp_id'] ?? -1);
            $qty = (int)($it['quantity'] ?? 0);
            if ($tid <= 0 || $qty <= 0) continue;
            $tpl = $templateById[$tid] ?? null;
            $iname = $tpl['name'] ?? ('#'.$tid);
            $icon  = ($tpl && !empty($tpl['icon_id'])) ? ($ICON_BASE_URL.$tpl['icon_id'].'.png') : '';
            $opts  = is_array($it['option'] ?? null) ? $it['option'] : [];
          ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td>
              <div style="display:flex;gap:10px;align-items:center">
                <?php if ($icon): ?><img src="<?php echo h($icon); ?>" alt="" style="width:28px;height:28px;image-rendering:pixelated;object-fit:contain;border-radius:6px;border:1px solid #334155;background:#0b1220"><?php endif; ?>
                <div>
                  <div><?php echo h($iname); ?></div>
                  <?php if (!empty($tpl['description'])): ?><small class="muted"><?php echo h($tpl['description']); ?></small><?php endif; ?>
                </div>
              </div>
            </td>
            <td><?php echo $tid; ?></td>
            <td>
              <?php if ($opts): ?>
                <?php foreach ($opts as $pair):
                  $oid = (int)($pair[0] ?? -1);
                  $par = (int)($pair[1] ?? 0);
                  $oname = $optById[$oid]['name'] ?? ('#'.$oid);
                ?>
                  <span style="display:inline-flex;gap:6px;align-items:center;border:1px solid #334155;border-radius:999px;padding:3px 8px;margin:2px;background:#0b1220">
                    <?php echo h($oname); ?>: <?php echo $par; ?>
                  </span>
                <?php endforeach; ?>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php if ($i===1): ?>
            <tr><td colspan="4" class="muted">Không có trang bị.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Trang bị đang mặc (ĐỆ TỬ / pet_body) -->
    <div class="table-wrap" style="margin-top:16px">
      <table class="table">
        <thead>
          <tr>
            <th style="width:52px">#</th>
            <th>Trang bị (Đệ tử)</th>
            <th style="width:120px">temp_id</th>
            <th>Chỉ số</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=1;
          foreach ($inspect['pet_body'] as $it):
            $tid = (int)($it['temp_id'] ?? -1);
            $qty = (int)($it['quantity'] ?? 0);
            if ($tid <= 0 || $qty <= 0) continue;
            $tpl = $templateById[$tid] ?? null;
            $iname = $tpl['name'] ?? ('#'.$tid);
            $icon  = ($tpl && !empty($tpl['icon_id'])) ? ($ICON_BASE_URL.$tpl['icon_id'].'.png') : '';
            $opts  = is_array($it['option'] ?? null) ? $it['option'] : [];
          ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td>
              <div style="display:flex;gap:10px;align-items:center">
                <?php if ($icon): ?><img src="<?php echo h($icon); ?>" alt="" style="width:28px;height:28px;image-rendering:pixelated;object-fit:contain;border-radius:6px;border:1px solid #334155;background:#0b1220"><?php endif; ?>
                <div>
                  <div><?php echo h($iname); ?></div>
                  <?php if (!empty($tpl['description'])): ?><small class="muted"><?php echo h($tpl['description']); ?></small><?php endif; ?>
                </div>
              </div>
            </td>
            <td><?php echo $tid; ?></td>
            <td>
              <?php if ($opts): ?>
                <?php foreach ($opts as $pair):
                  $oid = (int)($pair[0] ?? -1);
                  $par = (int)($pair[1] ?? 0);
                  $oname = $optById[$oid]['name'] ?? ('#'.$oid);
                ?>
                  <span style="display:inline-flex;gap:6px;align-items:center;border:1px solid #334155;border-radius:999px;padding:3px 8px;margin:2px;background:#0b1220">
                    <?php echo h($oname); ?>: <?php echo $par; ?>
                  </span>
                <?php endforeach; ?>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php if ($i===1): ?>
            <tr><td colspan="4" class="muted">Không có trang bị.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Tổng hợp túi + rương -->
    <div class="table-wrap" style="margin-top:16px">
      <table class="table">
        <thead>
          <tr>
            <th style="width:52px">#</th>
            <th>Vật phẩm (Túi + Rương)</th>
            <th style="width:120px">temp_id</th>
            <th style="width:120px">Tổng SL</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=1;
          foreach ($inspect['agg'] as $tid => $qty):
            $tpl  = $templateById[$tid] ?? null;
            $iname= $tpl['name'] ?? ('#'.$tid);
            $icon = ($tpl && !empty($tpl['icon_id'])) ? ($ICON_BASE_URL.$tpl['icon_id'].'.png') : '';
          ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td>
              <div style="display:flex;gap:10px;align-items:center">
                <?php if ($icon): ?><img src="<?php echo h($icon); ?>" alt="" style="width:28px;height:28px;image-rendering:pixelated;object-fit:contain;border-radius:6px;border:1px solid #334155;background:#0b1220"><?php endif; ?>
                <div>
                  <div><?php echo h($iname); ?></div>
                  <?php if (!empty($tpl['description'])): ?><small class="muted"><?php echo h($tpl['description']); ?></small><?php endif; ?>
                </div>
              </div>
            </td>
            <td><?php echo (int)$tid; ?></td>
            <td><?php echo number_format((int)$qty); ?></td>
          </tr>
          <?php endforeach; ?>
          <?php if ($i===1): ?>
            <tr><td colspan="4" class="muted">Không có vật phẩm ở túi & rương.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

  <?php endif; ?>
</div>
<br><br>
<div class="card">
  <h2>Lịch sử giao dịch (trade)</h2>

  <form method="get" onsubmit="return ensureHistSelected()" style="display:flex;gap:12px;align-items:end;flex-wrap:wrap;margin-bottom:10px">
    <input type="hidden" name="hist" value="1">
    <input type="hidden" id="hist_pid" name="hist_pid">
    <div style="min-width:280px">
      <label>Tên nhân vật</label>
      <input id="histName" list="histList" class="input" placeholder="Nhập (không dấu cũng được)">
      <datalist id="histList"></datalist>
      <div id="histPreview" class="muted" style="margin-top:6px"></div>
      <small class="muted">* Chọn đúng gợi ý để map chính xác <code>player_id</code>.</small>
    </div>
    <div>
      <label>Hiển thị / trang</label>
      <input type="number" name="per" class="input" min="10" max="100" value="<?= h((int)($_GET['per'] ?? 20)) ?>" style="width:120px">
    </div>
    <div>
      <button class="btn btn-green" type="submit">Xem lịch sử</button>
    </div>
  </form>

  <?php if (!$tradeHist['ok'] && isset($_GET['hist'])): ?>
    <div class="alert alert-danger"><?= h($tradeHist['err']) ?></div>
  <?php endif; ?>

  <?php if ($tradeHist['ok']): ?>
    <div class="muted" style="margin-bottom:8px">
      Kết quả cho: <b><?= h($tradeHist['player']['name']) ?></b> (ID <?= (int)$tradeHist['player']['id'] ?>).
      Tổng bản ghi: <b><?= (int)$tradeHist['total'] ?></b>.
      Trang <?= (int)$tradeHist['page'] ?> / <?= max(1, (int)ceil($tradeHist['total'] / max(1,$tradeHist['per']))) ?>.
    </div>

			<div class="table-wrap" style="margin-top:12px">
			  <table class="table">
				<thead>
				  <tr>
					<th style="width:180px">Thời gian</th>
					<th>Người A</th>
					<th>Người B</th>
					<th>Vật phẩm A → B</th>
					<th>Vật phẩm B → A</th>
				  </tr>
				</thead>
				<tbody>
				  <?php
				  if ($tradeHist['ok'] && !empty($tradeHist['rows'])):
					foreach ($tradeHist['rows'] as $r):
					  $p1  = $r['p1']  ?? $r['player_1']      ?? '';
					  $p2  = $r['p2']  ?? $r['player_2']      ?? '';
					  $it1 = $r['it1'] ?? $r['item_player_1'] ?? '';
					  $it2 = $r['it2'] ?? $r['item_player_2'] ?? '';
					  $t   = $r['t']   ?? $r['time_tran']     ?? '';
				  ?>
					<tr>
					  <td><?= h($t) ?></td>
					  <td><?= h($p1) ?></td>
					  <td><?= h($p2) ?></td>
					  <td class="wrap"><?= render_grouped_items_html($it1) ?></td>
					  <td class="wrap"><?= render_grouped_items_html($it2) ?></td>
					</tr>
				  <?php
					endforeach;
				  else:
				  ?>
					<tr><td colspan="5" style="text-align:center" class="muted">Không có dữ liệu</td></tr>
				  <?php endif; ?>
				</tbody>
			  </table>
			</div>

    <?php
      $pid   = (int)$tradeHist['player']['id'];
      $per   = (int)$tradeHist['per'];
      $page  = (int)$tradeHist['page'];
      $pages = max(1, (int)ceil($tradeHist['total'] / max(1,$per)));
      $mk = function($p) use ($pid,$per) {
        return '?hist=1&hist_pid='.$pid.'&per='.$per.'&page='.$p;
      };
    ?>
    <div style="margin-top:10px;display:flex;gap:8px;flex-wrap:wrap">
      <?php if ($page > 1): ?>
        <a class="btn btn-outline" href="<?= h($mk($page-1)) ?>">« Trang trước</a>
      <?php endif; ?>
      <?php if ($page < $pages): ?>
        <a class="btn btn-outline" href="<?= h($mk($page+1)) ?>">Trang sau »</a>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>

<br><br>
<div class="card">
  <h2>Tạo Giftcode chung (toàn server)</h2>

  <?php if (isset($_GET['gift2_msg'])): ?>
    <div class="alert" style="background:#064e3b;color:#a7f3d0;border:1px solid #065f46">
      <?php echo h($_GET['gift2_msg']); ?>
    </div>
  <?php endif; ?>
  <?php if (isset($_GET['gift2_err'])): ?>
    <div class="alert alert-danger">
      <?php echo h($_GET['gift2_err']); ?>
    </div>
  <?php endif; ?>

  <form method="post" id="giftFormG" onsubmit="return buildItemsJsonG()">
    <input type="hidden" name="_csrf" value="<?php echo h($_SESSION['secret_csrf']); ?>">
    <input type="hidden" name="make_server_code" value="1">
    <input type="hidden" id="g_items_json" name="g_items_json" value="[]">

    <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px">
      <div>
        <label>Type (0/1/2)</label>
        <select name="g_type" required class="input">
          <option value="0">0 - 1 người nhập</option>
          <option value="1">1 - Nhiều người nhập</option>
          <option value="2">2 - Khác</option>
        </select>
      </div>

      <div>
        <label>Tên giftcode</label>
        <input type="text" name="g_code" required placeholder="VD: SERVER2025" class="input">
      </div>

      <div><label>Vàng (gold)</label><input type="number" name="g_gold" min="0" value="0" class="input"></div>
      <div><label>Ngọc (gem)</label><input type="number" name="g_gem"  min="0" value="0" class="input"></div>
      <div><label>Hồng ngọc (ruby)</label><input type="number" name="g_ruby" min="0" value="0" class="input"></div>

      <div>
        <label>Trạng thái</label>
        <select name="g_status" class="input">
          <option value="1">1 - Đã sử dụng - hoặc khoá</option>
          <option value="0">0 - Kích hoạt - Cho phép nhận</option>
        </select>
      </div>

      <div>
        <label>Đối tượng</label>
        <select name="g_active" class="input" title="1 = chỉ tài khoản MTV, 0 = mọi người">
          <option value="0">0 - Mọi người chơi</option>
          <option value="1">1 - Chỉ tài khoản MTV</option>
        </select>
      </div>
    </div>

    <hr style="border-color:#334155;margin:16px 0">

    <h3 style="margin:0 0 8px">Thêm vật phẩm cho gift code chung</h3>
    <div class="grid" style="grid-template-columns:240px 1fr 120px 160px;gap:10px;align-items:end">
      <div>
        <label>Lọc theo type</label>
        <select id="g_fType" class="input"></select>
      </div>
      <div>
        <label>Chọn vật phẩm theo tên</label>
        <input list="g_itemList" id="g_itemSearch" class="input" placeholder="Gõ tên để lọc nhanh...">
        <datalist id="g_itemList"></datalist>
        <small class="muted" id="g_itemDesc"></small>
      </div>
      <div>
        <label>Số lượng</label>
        <input type="number" id="g_qty" min="1" value="1" class="input">
      </div>
      <div>
        <button type="button" class="btn btn-green" onclick="addItemG()">+ Thêm vật phẩm</button>
      </div>
    </div>

    <div id="g_itemPreview" style="display:flex;gap:12px;align-items:center;margin:8px 0"></div>

    <div class="table-wrap" style="margin-top:12px">
      <table class="table">
        <thead>
          <tr>
            <th style="width:52px">#</th>
            <th>Vật phẩm</th>
            <th style="width:90px">SL</th>
            <th>Chỉ số (options)</th>
            <th style="width:140px">Tuỳ Chọn</th>
          </tr>
        </thead>
        <tbody id="g_itemsBody"></tbody>
      </table>
    </div>

    <div style="margin-top:12px;display:flex;gap:10px;flex-wrap:wrap">
      <button class="btn btn-green" type="submit">Lưu gift code chung</button>
      <button class="btn btn-outline" type="button" onclick="resetGiftG()">Làm lại</button>
    </div>
  </form>
</div>

<br><br>

<!-- ========= Tạo Giftcode ========= -->
<div class="card">
  <h2>Tạo Giftcode riêng cho người chơi</h2>

  <?php if (isset($_GET['gift_msg'])): ?>
    <div class="alert" style="background:#064e3b;color:#a7f3d0;border:1px solid #065f46"><?= h($_GET['gift_msg']) ?></div>
  <?php endif; ?>
  <?php if (isset($_GET['gift_err'])): ?>
    <div class="alert alert-danger"><?= h($_GET['gift_err']) ?></div>
  <?php endif; ?>

  <form method="post" id="giftForm" onsubmit="return ensurePlayerSelected() && buildItemsJson()">
    <input type="hidden" name="_csrf" value="<?= h($_SESSION['secret_csrf']) ?>">
    <input type="hidden" name="make_code" value="1">
    <input type="hidden" id="items_json" name="items_json" value="[]">
    <input type="hidden" name="player_idd" id="player_idd">

    <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px">
      <div>
        <label>Tên nhân vật (map sang <code>player_idd</code>)</label>
        <input id="playerName" name="player_name" list="playerList" required placeholder="Nhập tên (không dấu cũng được)" class="input">
        <datalist id="playerList"></datalist>
        <div id="playerPreview" class="muted" style="margin-top:6px"></div>
        <small class="muted">* Gõ vài ký tự → chọn đúng gợi ý; hệ thống tự điền ID nhân vật.</small>
      </div>

      <div>
        <label>Type (0/1/2)</label>
        <select name="typed" required class="input">
          <option value="0">0 - 1 người nhập</option>
          <option value="1">1 - Nhiều người nhập</option>
          <option value="2">2 - Khác</option>
        </select>
      </div>

      <div>
        <label>Tên giftcode</label>
        <input type="text" name="coded" required placeholder="VD: TET2025VIP" class="input">
      </div>

      <div><label>Vàng (goldd)</label><input type="number" name="goldd" min="0" value="0" class="input"></div>
      <div><label>Ngọc (gemd)</label><input type="number" name="gemd" min="0" value="0" class="input"></div>
      <div><label>Hồng ngọc (rubyd)</label><input type="number" name="rubyd" min="0" value="0" class="input"></div>

      <div>
        <label>Kích hoạt</label>
        <select name="startusd" class="input">
          <option value="1">1 - Đã sử dụng - hoặc khoá</option>
          <option value="0">0 - Kích hoạt - Cho phép nhận</option>
        </select>
      </div>

      <div>
        <label>Đối tượng</label>
        <select name="actived" class="input" title="1 = chỉ tài khoản MTV, 0 = mọi người">
          <option value="0">0 - Mọi người chơi</option>
          <option value="1">1 - Chỉ tài khoản MTV</option>
        </select>
      </div>
    </div>

    <hr style="border-color:#334155;margin:16px 0">

    <h3 style="margin:0 0 8px">Thêm vật phẩm cho giftcode</h3>
    <div class="grid" style="grid-template-columns:240px 1fr 120px 160px;gap:10px;align-items:end">
      <div>
        <label>Lọc theo type</label>
        <select id="fType" class="input"></select>
      </div>
      <div>
        <label>Chọn vật phẩm theo tên</label>
        <input list="itemList" id="itemSearch" class="input" placeholder="Gõ tên để lọc nhanh...">
        <datalist id="itemList"></datalist>
        <small class="muted" id="itemDesc"></small>
      </div>
      <div>
        <label>Số lượng</label>
        <input type="number" id="qty" min="1" value="1" class="input">
      </div>
      <div>
        <button type="button" class="btn btn-green" onclick="addItem()">+ Thêm vật phẩm</button>
      </div>
    </div>

    <div id="itemPreview" style="display:flex;gap:12px;align-items:center;margin:8px 0"></div>

    <div class="table-wrap" style="margin-top:12px">
      <table class="table" id="itemsTable">
        <thead>
          <tr>
            <th style="width:52px">#</th>
            <th>Vật phẩm</th>
            <th style="width:90px">SL</th>
            <th>Chỉ số (options)</th>
            <th style="width:140px">Thao tác</th>
          </tr>
        </thead>
        <tbody id="itemsBody"></tbody>
      </table>
    </div>

    <div style="margin-top:12px;display:flex;gap:10px;flex-wrap:wrap">
      <button class="btn btn-green" type="submit">Lưu giftcode</button>
      <button class="btn btn-outline" type="button" onclick="resetGift()">Làm lại</button>
    </div>
  </form>
</div>

<br><br>

<!-- ========= Kiểm tra tiền trong server ========= -->
<div class="card">
  <?php
  $moneyType = isset($_GET['money_type']) ? (string)$_GET['money_type'] : 'tv'; // tv | gx | vnd | coin | rb
  $limit     = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
  $limit     = max(1, min(200, $limit));

  $cfg = [
    'tv'   => ['title' => 'LƯỢNG THỎI VÀNG TRONG SV', 'unit' => 'Thỏi vàng'],
    'gx'   => ['title' => 'LƯỢNG NGỌC XANH TRONG SV', 'unit' => 'Ngọc Xanh'],
    'rb'   => ['title' => 'LƯỢNG HỒNG NGỌC TRONG SV', 'unit' => 'Hồng Ngọc'],
    'vnd'  => ['title' => 'LƯỢNG VNĐ TRONG SV', 'unit' => 'VNĐ'],
    'coin' => ['title' => 'LƯỢNG COIN TRONG SV', 'unit' => 'Coin'],
  ];
  if (!isset($cfg[$moneyType])) $moneyType = 'tv';
  ?>
  <h2><?= h($cfg[$moneyType]['title']) ?></h2>

  <form method="get" style="display:flex;gap:12px;align-items:end;flex-wrap:wrap;margin:10px 0 14px">
    <div>
      <label>Loại thống kê</label>
      <select name="money_type" class="input">
        <option value="tv"   <?= $moneyType==='tv'   ? 'selected' : '' ?>>Thỏi vàng</option>
        <option value="gx"   <?= $moneyType==='gx'   ? 'selected' : '' ?>>Ngọc Xanh</option>
        <option value="rb"   <?= $moneyType==='rb'   ? 'selected' : '' ?>>Hồng Ngọc</option>
        <option value="vnd"  <?= $moneyType==='vnd'  ? 'selected' : '' ?>>VNĐ</option>
        <option value="coin" <?= $moneyType==='coin' ? 'selected' : '' ?>>Coin</option>
      </select>
    </div>
    <div>
      <label>Hiển thị Top</label>
      <input type="number" name="limit" min="1" max="200" value="<?= h($limit) ?>" class="input" style="width:120px">
    </div>
    <div>
      <button class="btn btn-green" type="submit">Xem</button>
    </div>
  </form>

  <div class="table-wrap">
    <table class="table">
      <thead>
        <tr>
          <th style="width:70px">STT</th>
          <th>Tên</th>
          <th style="width:220px">Hiện có</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $rows = null;

      if ($moneyType === 'tv') {
        $sql = "
          SELECT p.name AS name, p.thoi_vang AS val
          FROM player p
          INNER JOIN account a ON a.id = p.account_id
          WHERE a.is_admin = 0 AND a.ban = 0
          ORDER BY val DESC
          LIMIT $limit
        ";
        $rows = $config->query($sql);
      }
      elseif ($moneyType === 'gx') {
        $sql = "
          SELECT p.name AS name,
                 CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(p.data_inventory, ',', 2), ',', -1) AS UNSIGNED) AS val
          FROM player p
          INNER JOIN account a ON a.id = p.account_id
          WHERE a.is_admin = 0 AND a.ban = 0
          ORDER BY val DESC
          LIMIT $limit
        ";
        $rows = $config->query($sql);
      }
      elseif ($moneyType === 'rb') {
        $sql = "
          SELECT p.name AS name,
                 CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(p.data_inventory, ',', 3), ',', -1) AS UNSIGNED) AS val
          FROM player p
          INNER JOIN account a ON a.id = p.account_id
          WHERE a.is_admin = 0 AND a.ban = 0
          ORDER BY val DESC
          LIMIT $limit
        ";
        $rows = $config->query($sql);
      }
      elseif ($moneyType === 'vnd') {
        $sql = "
          SELECT a.username AS name, a.vnd AS val
          FROM account a
          WHERE a.is_admin = 0 AND a.ban = 0
          ORDER BY val DESC
          LIMIT $limit
        ";
        $rows = $config->query($sql);
      }
      else { // coin = tongnap
        $sql = "
          SELECT a.username AS name, a.tongnap AS val
          FROM account a
          WHERE a.is_admin = 0 AND a.ban = 0
          ORDER BY val DESC
          LIMIT $limit
        ";
        $rows = $config->query($sql);
      }

      $stt = 1;
      if ($rows === false) {
        echo '<tr><td colspan="3" style="text-align:center;color:#fecaca">Lỗi truy vấn SQL</td></tr>';
      } elseif ($rows && $rows->num_rows > 0) {
        while ($r = $rows->fetch_assoc()) {
          echo '<tr>
                  <td>'. $stt .'</td>
                  <td>'. h($r['name']) .'</td>
                  <td>'. number_format((int)$r['val'], 0, '.', '.') .' ['. h($cfg[$moneyType]['unit']) .']</td>
                </tr>';
          $stt++;
        }
      } else {
        echo '<tr><td colspan="3" style="text-align:center;opacity:.8">&lt;&lt; Không có dữ liệu &gt;&gt;</td></tr>';
      }
      ?>
      </tbody>
    </table>
  </div>
</div>

<br><br>

<!-- ========= Kiểm tra clone theo IP ========= -->
<div class="card">
  <h2>Kiểm tra clone theo IP</h2>

  <?php if (isset($_GET['clone_msg'])): ?>
    <div class="alert" style="background:#064e3b;color:#a7f3d0;border:1px solid #065f46">
      <?= h($_GET['clone_msg']) ?>
    </div>
  <?php endif; ?>
  <?php if (isset($_GET['clone_err'])): ?>
    <div class="alert alert-danger">
      <?= h($_GET['clone_err']) ?>
    </div>
  <?php endif; ?>

  <!-- Nút kiểm tra -->
  <form method="get" style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;margin-bottom:12px">
    <input type="hidden" name="inspect_clone" value="1">
    <label class="muted">Chỉ hiện IP có từ</label>
    <input type="number" name="min_cnt" min="2" value="<?= h((int)($_GET['min_cnt'] ?? 2)) ?>" class="input" style="width:100px">
    <label class="muted">tài khoản trở lên (mặc định: 2)</label>
    <button class="btn btn-yellow" type="submit">Kiểm tra clone</button>
  </form>

  <?php
  $groups = [];
  $minCnt = max(2, (int)($_GET['min_cnt'] ?? 2));

  if (isset($_GET['inspect_clone']) && $_GET['inspect_clone'] === '1') {
      $stmt = $config->prepare("
        SELECT ip_address, COUNT(*) AS cnt
        FROM account
        WHERE ip_address IS NOT NULL AND ip_address <> ''
        GROUP BY ip_address
        HAVING cnt >= ?
        ORDER BY cnt DESC, ip_address
        LIMIT 20
      ");
      $stmt->bind_param("i", $minCnt);
      if ($stmt->execute()) {
          $res = $stmt->get_result();
          while ($r = $res->fetch_assoc()) $groups[] = ['ip' => $r['ip_address'], 'cnt' => (int)$r['cnt']];
      }
      $stmt->close();
  }
  ?>

  <?php if (!empty($groups)): ?>
    <div class="table-wrap">
      <table class="table">
        <thead>
          <tr>
            <th style="width:60px">#</th>
            <th>IP</th>
            <th style="width:120px">Số tài khoản</th>
            <th>Tài khoản dùng IP này</th>
            <th style="width:220px">Thao tác</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $idx = 1;
        foreach ($groups as $g) {
            $ip  = $g['ip'];
            $cnt = $g['cnt'];
            $users = [];
            $stmt2 = $config->prepare("SELECT id, username, active, ban FROM account WHERE ip_address = ? ORDER BY id LIMIT 100");
            $stmt2->bind_param("s", $ip);
            if ($stmt2->execute()) {
                $res2 = $stmt2->get_result();
                while ($u = $res2->fetch_assoc()) $users[] = $u;
            }
            $stmt2->close();

            echo '<tr>';
            echo '<td>'.h($idx).'</td>';
            echo '<td><code>'.h($ip).'</code></td>';
            echo '<td><b>'.h($cnt).'</b></td>';
            echo '<td>';

            if (!empty($users)) {
                $sample = array_slice($users, 0, 5);
                $more   = max(0, count($users) - count($sample));

                echo '<details>';
                echo '<summary style="cursor:pointer">';
                $names = [];
                foreach ($sample as $u) $names[] = h($u['username']).($u['ban'] ? ' (bị khóa)' : '');
                echo implode(', ', $names);
                if ($more > 0) echo ' ... và '.h($more).' tài khoản khác';
                echo '</summary>';

                echo '<ul style="margin:8px 0 0 18px;padding:0;list-style:disc">';
                foreach ($users as $u) {
                  $tag = $u['ban'] ? ' <span style="color:#fca5a5">(bị khóa)</span>' : '';
                  echo '<li>['.h($u['id']).'] '.h($u['username']).' — MTV: '.h($u['active']).$tag.'</li>';
                }
                echo '</ul>';
                echo '</details>';
            } else {
                echo '<span class="muted">Không có dữ liệu.</span>';
            }
            echo '</td>';

            echo '<td>';
            echo '<form method="post" style="display:inline-block;margin-right:6px">';
            echo '<input type="hidden" name="_csrf" value="'.h($_SESSION['secret_csrf']).'">';
            echo '<input type="hidden" name="target_ip" value="'.h($ip).'">';
            echo '<button class="btn btn-red" type="submit" name="block_ip">Block IP</button>';
            echo '</form>';

            echo '<form method="post" style="display:inline-block">';
            echo '<input type="hidden" name="_csrf" value="'.h($_SESSION['secret_csrf']).'">';
            echo '<input type="hidden" name="target_ip" value="'.h($ip).'">';
            echo '<button class="btn btn-outline" type="submit" name="unlock_ip">Mở khóa</button>';
            echo '</form>';
            echo '</td>';

            echo '</tr>';
            $idx++;
        }
        ?>
        </tbody>
      </table>
    </div>
  <?php elseif (isset($_GET['inspect_clone'])): ?>
    <div class="alert">Không tìm thấy IP nào có từ <?= h($minCnt) ?> tài khoản trở lên.</div>
  <?php else: ?>
    <small class="muted">Nhấn "Kiểm tra clone" để hiển thị 20 IP có nhiều tài khoản nhất (chỉ hiển thị IP từ <?= h($minCnt) ?> tài khoản).</small>
  <?php endif; ?>
</div>

  </div><!-- /container -->
  <script src="https://unpkg.com/scrollreveal"></script>
  <script src="js/script.js"></script>

  <script>
  // ===== Background star field (random shadows) =====
  (function(){
    function makeShadows(n){
      const arr=[]; for(let i=0;i<n;i++){
        const x=Math.floor(Math.random()*2000), y=Math.floor(Math.random()*2000);
        arr.push(`${x}px ${y}px #FFF`);
      } return arr.join(', ');
    }
    function apply(id,n){
      const el=document.getElementById(id); if(!el) return;
      const s=makeShadows(n); el.style.boxShadow=s;
      const sheet=document.createElement('style');
      sheet.textContent=`#${id}{box-shadow:${s}} #${id}::after{box-shadow:${s}}`;
      document.head.appendChild(sheet);
    }
    apply('stars',700); apply('stars2',200); apply('stars3',100);
  })();

  // ==================== GIFT UI SCRIPTS ====================
  // ---- Feed từ PHP ----
  const PLAYERS     = <?php echo json_encode($playersList, JSON_UNESCAPED_UNICODE); ?>;
  const ITEM_TYPES  = <?php echo json_encode($itemTypes, JSON_UNESCAPED_UNICODE); ?>;
  const ITEMS       = <?php echo json_encode($itemTemplates, JSON_UNESCAPED_UNICODE); ?>;
  const OPTS        = <?php echo json_encode($optionTemplates, JSON_UNESCAPED_UNICODE); ?>;
  const ICON_BASE   = <?php echo json_encode($ICON_BASE_URL); ?>;

  // ---- Index nhanh ----
  const ITEM_BY_ID  = new Map(ITEMS.map(i => [Number(i.id), i]));
  const OPT_BY_ID   = new Map(OPTS.map(o => [Number(o.id), o]));

  // ---- State ----
  let selectedItems = []; // [{id, quantity, options:[{id,param},...]}]

  // ---- Helpers ----
  function el(tag, attrs={}, ...kids){
    const e=document.createElement(tag);
    for(const [k,v] of Object.entries(attrs)){
      if(k==='class') e.className=v; else if(k==='html') e.innerHTML=v; else e.setAttribute(k,v);
    }
    for(const k of kids) e.appendChild(typeof k==='string'?document.createTextNode(k):k);
    return e;
  }
  function escapeHtml(s){return String(s).replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));}
  function iconUrl(icon_id){return icon_id ? (ICON_BASE + String(icon_id) + '.png') : '';}
  function vnStrip(s=''){return String(s).normalize('NFD').replace(/[\u0300-\u036f]/g,'').replace(/đ/g,'d').replace(/Đ/g,'D');}

  // ---- Player filter + map ID ----
  function fillPlayerList(){
    const inp=document.getElementById('playerName'), list=document.getElementById('playerList');
    if(!inp||!list) return;
    const q=inp.value.trim(), qs=vnStrip(q).toLowerCase();
    const rows = qs ? PLAYERS.filter(p=>vnStrip(p.name).toLowerCase().includes(qs)) : PLAYERS.slice(0,100);
    list.innerHTML = rows.slice(0,300).map(p=>`<option value="${escapeHtml(p.name)}">`).join('');
  }
  function setPlayerByName(){
    const name=(document.getElementById('playerName')?.value||'').trim();
    const hidden=document.getElementById('player_idd'), prev=document.getElementById('playerPreview');
    if(!hidden) return true;
    const norm=vnStrip(name).toLowerCase();
    const exact=PLAYERS.filter(p=>vnStrip(p.name).toLowerCase()===norm);
    if(exact.length===1){ hidden.value=exact[0].id; if(prev) prev.textContent=`Đã chọn: ${exact[0].name} (ID ${exact[0].id})`; return true; }
    hidden.value=''; if(prev) prev.textContent = exact.length>1 ? 'Nhiều nhân vật trùng tên (không dấu). Hãy chọn đúng từ gợi ý.' : ''; return false;
  }
  function ensurePlayerSelected(){
    const ok=setPlayerByName(); const pid=document.getElementById('player_idd')?.value||'';
    if(!ok || !pid){ alert('Vui lòng chọn TÊN NHÂN VẬT từ gợi ý để hệ thống map đúng player_idd.'); document.getElementById('playerName')?.focus(); return false; }
    return true;
  }
  (function initPlayerPicker(){
    const input=document.getElementById('playerName'); if(!input) return;
    fillPlayerList(); input.addEventListener('input', ()=>{fillPlayerList(); setPlayerByName();});
    input.addEventListener('change', setPlayerByName); input.addEventListener('focus', fillPlayerList);
  })();

  // ---- Items: filter & preview ----
  function fillTypes(){
    const fType=document.getElementById('fType');
    fType.innerHTML = '<option value="">(Tất cả)</option>' + ITEM_TYPES.map(t=>`<option value="${t}">${t}</option>`).join('');
  }
  function fillItemList(){
    const list=document.getElementById('itemList'), type=document.getElementById('fType').value;
    const s=document.getElementById('itemSearch').value.trim().toLowerCase();
    const rows=ITEMS.filter(i => (type===''||String(i.type)===String(type)) && (s===''||String(i.name).toLowerCase().includes(s)));
    list.innerHTML = rows.map(i=>`<option value="${escapeHtml(i.name)}">`).join('');

    const hit=rows.find(i => i.name.toLowerCase()===s);
    const box=document.getElementById('itemPreview'); const desc=document.getElementById('itemDesc');
    if(hit){
      box.innerHTML=''; const img=el('img',{src:iconUrl(hit.icon_id),alt:hit.name,style:'width:32px;height:32px;image-rendering:pixelated;object-fit:contain;border-radius:6px;border:1px solid #334155;background:#0b1220'});
      const t=el('div',{}, el('div',{}, hit.name), el('small',{class:'muted'}, hit.description||'')); desc.textContent=hit.description||'';
      box.appendChild(img); box.appendChild(t);
    } else { box.innerHTML=''; desc.textContent=''; }
  }
  function getItemIdByName(name){ const it=ITEMS.find(i=>i.name===name); return it?Number(it.id):null; }

  function addItem(){
    const name=document.getElementById('itemSearch').value.trim();
    const id=getItemIdByName(name);
    const qty=Math.max(1, parseInt(document.getElementById('qty').value||'1',10));
    if(!id){ alert('Vui lòng chọn đúng vật phẩm từ danh sách.'); return; }
    selectedItems.push({ id, quantity: qty, options: [] });
    document.getElementById('itemSearch').value=''; document.getElementById('qty').value=1; renderItems();
  }
  function removeItem(idx){ selectedItems.splice(idx,1); renderItems(); }

  const OPT_DATALIST_HTML = OPTS.map(o => `<option value="${o.id} - ${escapeHtml(o.name)} (type ${o.type})">`).join('');
  function getOptionIdFromInput(val){
    if(!val) return null; const m=String(val).match(/^\s*(\d+)/); if(m) return Number(m[1]);
    const hit=OPTS.find(o=>o.name.toLowerCase()===String(val).toLowerCase()); return hit?Number(hit.id):null;
  }
  function uiAddOption(idx){
    const nameEl = document.getElementById(`optName-${idx}`);
    const paramEl = document.getElementById(`optParam-${idx}`);
    if (!nameEl || !paramEl) return;
    const oid = getOptionIdFromInput(nameEl.value.trim());
    if (oid === null || oid === undefined || !OPT_BY_ID.has(Number(oid))) { alert('Vui lòng chọn đúng chỉ số từ danh sách.'); return; }
    const param = Number(paramEl.value);
    if (!Number.isFinite(param)) { alert('Param phải là số.'); return; }
    if (!selectedItems[idx].options) selectedItems[idx].options = [];
    selectedItems[idx].options.push({ id: Number(oid), param });
    nameEl.value = ''; paramEl.value = 1; renderItems();
  }
  function removeOption(idx, oidx){ selectedItems[idx].options.splice(oidx,1); renderItems(); }

  function renderItems(){
    const tb=document.getElementById('itemsBody'); tb.innerHTML='';
    selectedItems.forEach((it, idx) => {
      const meta=ITEM_BY_ID.get(Number(it.id))||{name:'#'+it.id}, name=meta.name || ('#'+it.id), icon=iconUrl(meta.icon_id);
      const optWrap=el('div');
      (it.options||[]).forEach((op, oidx) => {
        const metaOpt=OPT_BY_ID.get(Number(op.id));
        const chip=el('span',{style:'display:inline-flex;gap:6px;align-items:center;border:1px solid #334155;border-radius:999px;padding:3px 8px;margin:2px;background:#0b1220'},
          `${metaOpt ? metaOpt.name : ('#'+op.id)}: ${op.param}`,
          el('button',{type:'button',class:'btn btn-outline',style:'padding:2px 8px;margin-left:6px',onclick:`removeOption(${idx},${oidx})`},'x')
        ); optWrap.appendChild(chip);
      });
      const controls=el('div',{style:'display:flex;gap:8px;align-items:center;margin-top:8px;flex-wrap:wrap'},
        el('div',{style:'min-width:260px;flex:1'}, el('input',{id:`optName-${idx}`,list:`optList-${idx}`,placeholder:'VD: 30 - Sức đánh',class:'input'})),
        el('datalist',{id:`optList-${idx}`,html:OPT_DATALIST_HTML}),
        el('input',{id:`optParam-${idx}`,type:'number',min:'0',value:'1',style:'width:110px',class:'input'}),
        el('button',{type:'button',class:'btn btn-outline',onclick:`uiAddOption(${idx})`},'+ Thêm')
      );
      const row=el('tr',{},
        el('td',{}, String(idx+1)),
        el('td',{}, el('div',{style:'display:flex;gap:10px;align-items:center'},
          icon ? el('img',{src:icon,alt:name,style:'width:28px;height:28px;image-rendering:pixelated;object-fit:contain;border-radius:6px;border:1px solid #334155;background:#0b1220'}) : el('span',{},''),
          el('div',{}, el('div',{}, name), el('small',{class:'muted'}, meta.description||''))
        )),
        el('td',{}, String(it.quantity)),
        el('td',{}, optWrap, controls),
        el('td',{}, el('div',{style:'display:flex;gap:8px;flex-wrap:wrap'}, el('button',{type:'button',class:'btn btn-red',onclick:`removeItem(${idx})`},'Xóa')))
      ); tb.appendChild(row);
    });
  }

  function buildItemsJson(){
    const data = selectedItems.map(it => ({
      id: Number(it.id),
      quantity: Number(it.quantity),
      options: (it.options||[]).map(op => ({ id: Number(op.id), param: Number(op.param) }))
    }));
    document.getElementById('items_json').value = JSON.stringify(data);
    if (data.length === 0 && !confirm('Giftcode chưa có vật phẩm. Vẫn tiếp tục lưu chỉ với vàng/ngọc?')) return false;
    return true;
  }
  function resetGift(){ selectedItems=[]; renderItems(); }

  // init
  fillTypes(); fillItemList();
  document.getElementById('fType').addEventListener('change', fillItemList);
  document.getElementById('itemSearch').addEventListener('input', fillItemList);

  // ====== STATE riêng cho gift chung ======
  let selectedItemsG = [];

  function fillTypesG(){
    const elSel = document.getElementById('g_fType');
    if(!elSel) return;
    elSel.innerHTML = '<option value="">(Tất cả)</option>' + ITEM_TYPES.map(t=>`<option value="${t}">${t}</option>`).join('');
  }
  function fillItemListG(){
    const list = document.getElementById('g_itemList');
    const type = document.getElementById('g_fType').value;
    const s    = (document.getElementById('g_itemSearch').value || '').trim().toLowerCase();
    const rows = ITEMS.filter(i => (type==='' || String(i.type)===String(type)) && (s==='' || String(i.name).toLowerCase().includes(s)));
    list.innerHTML = rows.map(i=>`<option value="${escapeHtml(i.name)}">`).join('');
    const hit = rows.find(i => i.name.toLowerCase() === s);
    const box = document.getElementById('g_itemPreview');
    const desc= document.getElementById('g_itemDesc');
    if (hit){
      box.innerHTML='';
      const img = el('img',{src:iconUrl(hit.icon_id),alt:hit.name,style:'width:32px;height:32px;image-rendering:pixelated;object-fit:contain;border-radius:6px;border:1px solid #334155;background:#0b1220'});
      const t   = el('div',{}, el('div',{}, hit.name), el('small',{class:'muted'}, hit.description||''));
      desc.textContent = hit.description || '';
      box.appendChild(img); box.appendChild(t);
    } else { box.innerHTML=''; desc.textContent=''; }
  }
  function getItemIdByNameG(name){ const it=ITEMS.find(i=>i.name===name); return it?Number(it.id):null; }

  function addItemG(){
    const name = (document.getElementById('g_itemSearch').value || '').trim();
    const id   = getItemIdByNameG(name);
    const qty  = Math.max(1, parseInt(document.getElementById('g_qty').value||'1',10));
    if (!id){ alert('Vui lòng chọn đúng vật phẩm từ danh sách.'); return; }
    selectedItemsG.push({ id, quantity: qty, options: [] });
    document.getElementById('g_itemSearch').value=''; document.getElementById('g_qty').value=1;
    renderItemsG();
  }
  function removeItemG(idx){ selectedItemsG.splice(idx,1); renderItemsG(); }

  function uiAddOptionG(idx){
    const nameEl = document.getElementById(`g_optName-${idx}`);
    const paramEl = document.getElementById(`g_optParam-${idx}`);
    if (!nameEl || !paramEl) return;
    const oid = getOptionIdFromInput(nameEl.value.trim());
    if (oid === null || oid === undefined || !OPT_BY_ID.has(Number(oid))) { alert('Vui lòng chọn đúng chỉ số từ danh sách.'); return; }
    const param = Number(paramEl.value);
    if (!Number.isFinite(param)) { alert('Param phải là số.'); return; }
    if (!selectedItemsG[idx].options) selectedItemsG[idx].options = [];
    selectedItemsG[idx].options.push({ id: Number(oid), param });
    nameEl.value = ''; paramEl.value = 1; renderItemsG();
  }
  function removeOptionG(idx, oidx){ selectedItemsG[idx].options.splice(oidx,1); renderItemsG(); }

  function renderItemsG(){
    const tb = document.getElementById('g_itemsBody'); tb.innerHTML = '';
    selectedItemsG.forEach((it, idx) => {
      const meta=ITEM_BY_ID.get(Number(it.id)) || {name:('#'+it.id)};
      const name=meta.name || ('#'+it.id);
      const icon=iconUrl(meta.icon_id);
      const optWrap = el('div');
      (it.options||[]).forEach((op, oidx) => {
        const metaOpt = OPT_BY_ID.get(Number(op.id));
        const chip = el('span',{style:'display:inline-flex;gap:6px;align-items:center;border:1px solid #334155;border-radius:999px;padding:3px 8px;margin:2px;background:#0b1220'},
          `${metaOpt ? metaOpt.name : ('#'+op.id)}: ${op.param}`,
          el('button',{type:'button',class:'btn btn-outline',style:'padding:2px 8px;margin-left:6px',onclick:`removeOptionG(${idx},${oidx})`},'x')
        );
        optWrap.appendChild(chip);
      });
      const controls = el('div',{style:'display:flex;gap:8px;align-items:center;margin-top:8px;flex-wrap:wrap'},
        el('div',{style:'min-width:260px;flex:1'},
          el('input',{ id:`g_optName-${idx}`, list:`g_optList-${idx}`, placeholder:'VD: 30 - Sức đánh', class:'input' })
        ),
        el('datalist',{id:`g_optList-${idx}`, html: OPT_DATALIST_HTML}),
        el('input',{ id:`g_optParam-${idx}`, type:'number', min:'0', value:'1', style:'width:110px', class:'input' }),
        el('button',{type:'button',class:'btn btn-outline',onclick:`uiAddOptionG(${idx})`},'+ Thêm')
      );
      const row = el('tr',{},
        el('td',{}, String(idx+1)),
        el('td',{}, el('div',{style:'display:flex;gap:10px;align-items:center'},
          icon ? el('img',{src:icon,alt:name,style:'width:28px;height:28px;image-rendering:pixelated;object-fit:contain;border-radius:6px;border:1px solid #334155;background:#0b1220'}) : el('span',{},''),
          el('div',{}, el('div',{}, name), el('small',{class:'muted'}, meta.description || ''))
        )),
        el('td',{}, String(it.quantity)),
        el('td',{}, optWrap, controls),
        el('td',{}, el('div',{style:'display:flex;gap:8px;flex-wrap:wrap'}, el('button',{type:'button',class:'btn btn-red',onclick:`removeItemG(${idx})`},'Xóa')))
      );
      tb.appendChild(row);
    });
  }

  function buildItemsJsonG(){
    const data = selectedItemsG.map(it => ({
      id: Number(it.id),
      quantity: Number(it.quantity),
      options: (it.options||[]).map(op => ({ id: Number(op.id), param: Number(op.param) }))
    }));
    document.getElementById('g_items_json').value = JSON.stringify(data);
    return true;
  }
  function resetGiftG(){ selectedItemsG = []; renderItemsG(); }

  // init UI gift chung
  fillTypesG(); fillItemListG();
  document.getElementById('g_fType').addEventListener('change', fillItemListG);
  document.getElementById('g_itemSearch').addEventListener('input', fillItemListG);

  // ==== Bộ lọc chọn tên cho TRA CỨU ====
  function fillPlayerListInspect(){
    const inp  = document.getElementById('pvName');
    const list = document.getElementById('pvList');
    if (!inp || !list) return;
    const q  = inp.value.trim();
    const qs = vnStrip(q).toLowerCase();
    const rows = qs ? PLAYERS.filter(p => vnStrip(p.name).toLowerCase().includes(qs)) : PLAYERS.slice(0, 100);
    list.innerHTML = rows.slice(0, 300).map(p => `<option value="${escapeHtml(p.name)}">`).join('');
  }
  function setInspectPlayerByName(){
    const name   = (document.getElementById('pvName')?.value || '').trim();
    const hidden = document.getElementById('inspect_pid');
    const prev   = document.getElementById('pvPreview');
    if (!hidden) return true;
    const norm = vnStrip(name).toLowerCase();
    const matches = PLAYERS.filter(p => vnStrip(p.name).toLowerCase() === norm);
    if (matches.length === 1){
      hidden.value = matches[0].id;
      if (prev) prev.textContent = `Đã chọn: ${matches[0].name} (ID ${matches[0].id})`;
      return true;
    } else {
      hidden.value = '';
      if (prev) prev.textContent = matches.length > 1 ? 'Có nhiều nhân vật trùng tên (không dấu). Hãy chọn đúng từ gợi ý.' : '';
      return false;
    }
  }
  function ensureInspectSelected(){
    const ok = setInspectPlayerByName();
    const pid = document.getElementById('inspect_pid')?.value || '';
    if (!ok || !pid){
      alert('Vui lòng chọn TÊN NHÂN VẬT từ gợi ý để kiểm tra.');
      document.getElementById('pvName')?.focus();
      return false;
    }
    return true;
  }
  (function initInspectPicker(){
    const input = document.getElementById('pvName');
    if (!input) return;
    fillPlayerListInspect();
    input.addEventListener('input', () => { fillPlayerListInspect(); setInspectPlayerByName(); });
    input.addEventListener('change', setInspectPlayerByName);
    input.addEventListener('focus',  fillPlayerListInspect);
  })();
  // ===== Picker cho LỊCH SỬ GIAO DỊCH =====
  function fillPlayerListHist(){
    const inp = document.getElementById('histName');
    const list= document.getElementById('histList');
    if(!inp||!list) return;
    const q  = inp.value.trim();
    const qs = vnStrip(q).toLowerCase();
    const rows = qs ? PLAYERS.filter(p => vnStrip(p.name).toLowerCase().includes(qs))
                    : PLAYERS.slice(0,100);
    list.innerHTML = rows.slice(0,300).map(p => `<option value="${escapeHtml(p.name)}">`).join('');
  }
  function setHistPlayerByName(){
    const name = (document.getElementById('histName')?.value || '').trim();
    const hidden = document.getElementById('hist_pid');
    const prev   = document.getElementById('histPreview');
    if(!hidden) return true;
    const norm = vnStrip(name).toLowerCase();
    const matches = PLAYERS.filter(p => vnStrip(p.name).toLowerCase() === norm);
    if(matches.length === 1){
      hidden.value = matches[0].id;
      if(prev) prev.textContent = `Đã chọn: ${matches[0].name} (ID ${matches[0].id})`;
      return true;
    } else {
      hidden.value = '';
      if(prev) prev.textContent = matches.length>1 ? 'Nhiều nhân vật trùng tên. Hãy chọn đúng từ gợi ý.' : '';
      return false;
    }
  }
  function ensureHistSelected(){
    const ok  = setHistPlayerByName();
    const pid = document.getElementById('hist_pid')?.value || '';
    if(!ok || !pid){
      alert('Vui lòng chọn TÊN NHÂN VẬT từ gợi ý để xem lịch sử giao dịch.');
      document.getElementById('histName')?.focus();
      return false;
    }
    return true;
  }
  (function initHistPicker(){
    const input = document.getElementById('histName');
    if(!input) return;
    fillPlayerListHist();
    input.addEventListener('input', ()=>{ fillPlayerListHist(); setHistPlayerByName(); });
    input.addEventListener('change', setHistPlayerByName);
    input.addEventListener('focus',  fillPlayerListHist);
  })();
  </script>
</body>
</html>
