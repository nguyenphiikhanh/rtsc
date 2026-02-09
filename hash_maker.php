<?php
// hash_maker.php — Tạo bcrypt hash và (tùy chọn) ghi C:/passbimat/app_config.php
// KHÔNG dùng declare(strict_types=1) ở file này để tránh lỗi vị trí.

error_reporting(E_ALL);
ini_set('display_errors', '1');

$error = null;
$hash = null;
$snippet = null;
$written = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = (string)($_POST['password'] ?? '');
    $cost     = (int)($_POST['cost'] ?? 12);
    if ($cost < 8)  $cost = 8;
    if ($cost > 14) $cost = 14;

    if ($password === '') {
        $error = 'Vui lòng nhập mật khẩu.';
    } else {
        $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => $cost]);
        if ($hash === false) {
            $error = 'Không tạo được hash.';
        } else {
            // Nội dung dành cho app_config.php (file này MỚI có declare và nằm đầu file)
            $snippet = "<?php\n".
                       "declare(strict_types=1);\n".
                       "define('ADMIN_SECRET_HASH', '".addslashes($hash)."');\n";

            if (!empty($_POST['write_file'])) {
                $path = 'C:/passbimat/app_config.php';
                $dir  = dirname($path);
                if (!is_dir($dir)) {
                    @mkdir($dir, 0700, true);
                }
                $ok = @file_put_contents($path, $snippet, LOCK_EX);
                if ($ok === false) {
                    $written = "Không ghi được file: $path. Kiểm tra quyền thư mục hoặc đường dẫn.";
                } else {
                    $written = "ĐÃ GHI file: $path";
                }
            }
        }
    }
}
?>
<!doctype html>
<html lang="vi">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tạo bcrypt hash cho ADMIN_SECRET_HASH</title>
<style>
  :root{
    --bg:#0f172a; --panel:#111827; --text:#e2e8f0; --muted:#cbd5e1;
    --border:#334155; --input:#0b1220; --accent:#22c55e; --danger:#ef4444;
  }
  *{box-sizing:border-box}
  html,body{background:var(--bg);color:var(--text);font-family:system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;margin:0}
  .wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px}
  .card{background:var(--panel);border:1px solid var(--border);border-radius:16px;box-shadow:0 10px 30px rgba(0,0,0,.35);width:min(680px,94vw);padding:24px}
  h1{margin:0 0 12px;font-size:20px}
  label{display:block;margin:10px 0 6px}
  input[type=password], input[type=number], textarea{
    width:100%;padding:12px 14px;border-radius:10px;border:1px solid var(--border);
    background:var(--input);color:var(--text);outline:none
  }
  input:focus, textarea:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(34,197,94,.2)}
  .row{display:grid;grid-template-columns:1fr 140px;gap:12px}
  .muted{opacity:.8;font-size:12px}
  .btn{display:inline-flex;align-items:center;justify-content:center;padding:10px 16px;border-radius:10px;border:0;cursor:pointer;font-weight:700}
  .btn-green{background:var(--accent);color:#0b1220}
  .btn-outline{background:transparent;color:var(--text);border:1px solid var(--border)}
  .alert{border-radius:10px;padding:10px 12px;margin:12px 0}
  .alert-err{background:#7f1d1d;color:#fecaca}
  .alert-ok{background:#064e3b;color:#a7f3d0;border:1px solid #065f46}
  code, pre{font-family:ui-monospace,SFMono-Regular,Menlo,Consolas,monospace}
  textarea{min-height:130px}
  .row2{display:flex;align-items:center;gap:10px;margin:10px 0}
</style>
</head>
<body>
<div class="wrap"><div class="card">
  <h1>Tạo bcrypt hash cho <code>ADMIN_SECRET_HASH</code></h1>
  <form method="post" autocomplete="off">
    <label>Mật khẩu muốn dùng cho trang admin</label>
    <div class="row">
      <input type="password" name="password" required placeholder="••••••••••">
      <div>
        <label>Cost</label>
        <input type="number" name="cost" min="8" max="14" value="<?php echo isset($_POST['cost'])?(int)$_POST['cost']:12; ?>">
      </div>
    </div>

    <div class="row2">
      <label style="display:inline-flex;align-items:center;gap:8px;">
        <input type="checkbox" name="write_file" value="1">
        Ghi luôn vào <code>C:/passbimat/app_config.php</code>
      </label>
    </div>

    <button class="btn btn-green" type="submit">Tạo hash</button>
    <button class="btn btn-outline" type="reset">Xoá</button>
  </form>

  <?php if ($error): ?>
    <div class="alert alert-err"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
  <?php endif; ?>

  <?php if ($hash): ?>
    <div class="alert alert-ok">ĐÃ TẠO HASH thành công (bcrypt):<br>
      <code><?php echo htmlspecialchars($hash, ENT_QUOTES, 'UTF-8'); ?></code>
    </div>

    <label>Sao chép toàn bộ nội dung bên dưới để dán vào <code>app_config.php</code></label>
    <textarea readonly onclick="this.select()"><?php echo htmlspecialchars($snippet, ENT_NOQUOTES, 'UTF-8'); ?></textarea>

    <?php if ($written): ?>
      <div class="alert <?php echo (strpos($written,'ĐÃ GHI')===0)?'alert-ok':'alert-err'; ?>">
        <?php echo htmlspecialchars($written, ENT_QUOTES, 'UTF-8'); ?>
      </div>
    <?php endif; ?>

    <p class="muted">
      * Lưu ý cho <code>app_config.php</code>:
      <br>- Lưu file với mã hóa <b>UTF-8 (không BOM)</b>.
      <br>- Dòng đầu tiên phải là <code>&lt;?php</code>, dòng thứ 2 là <code>declare(strict_types=1);</code>, không có ký tự trống trước đó.
    </p>
  <?php endif; ?>
</div></div>
</body>
</html>
