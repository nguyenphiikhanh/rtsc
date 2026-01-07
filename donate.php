<?php
require_once __DIR__ . '/./auth/auth.php';
require_once __DIR__ . '/./helper/helper.php';
require_once __DIR__ . '/./config/config.php';

global $link_QR, $bank_name, $bank_img, $bank_acc, $bank_acc_name, $bank_description, $config, $webname;

$auth_info = get_auth_info();

$transfer_content = $bank_description . $auth_info['user_id'];
$_username = $auth_info['username'];

// --- LOGIC LẤY DANH SÁCH THẺ (CURL) ---
$card_list_html = "";
try {
    $cdurl = curl_init("https://thesieutoc.net/card_info.php");
    curl_setopt($cdurl, CURLOPT_FAILONERROR, true);
    curl_setopt($cdurl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($cdurl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cdurl, CURLOPT_SSL_VERIFYPEER, false);
    $obj = json_decode(curl_exec($cdurl), true);
    curl_close($cdurl);

    if($obj){
        $length = count($obj);
        for ($i = 0; $i < $length; $i++) {
            if ($obj[$i]['status'] == 1) {
                $card_list_html .= '<option value="' . $obj[$i]['name'] . '">' . $obj[$i]['name'] . '</option>';
            }
        }
    }
} catch (Exception $e) {}
?>

<!DOCTYPE html>
<html lang="vi" class="__roots root__page">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate - <?= $webname ?></title>
    <link rel="shortcut icon" type="ico" href="favicon.ico"/>

    <?php
    echo load_css([
        'assets/frontend/events/phucloinap2025/css/lib.css',
        'assets/frontend/events/phucloinap2025/css/style.css',
    ]);
    ?>
    <link rel="stylesheet" href="assets/frontend/home/v1/css/slick-theme.css"/>
    <link rel="stylesheet" href="assets/frontend/home/v1/css/slick.css"/>
    <link rel="stylesheet" href="assets/frontend/home/v1/css/aos.css"/>
    <link rel="stylesheet" href="assets/frontend/home/v1/css/stylea6ca.css?v=919"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'db-gold': '#ffc107',
                        'db-gold-dark': '#ff9800',
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                }
            }
        }
    </script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 12px; }
        ::-webkit-scrollbar-track { background: #1a1a1a; }
        ::-webkit-scrollbar-thumb { background: #ffc107; border-radius: 6px; border: 2px solid #1a1a1a; }

        /* Animated Background */
        body {
            background-color: #050505;
            background-image:
                    radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%),
                    radial-gradient(at 50% 0%, hsla(225,39%,30%,1) 0, transparent 50%),
                    radial-gradient(at 100% 0%, hsla(339,49%,30%,1) 0, transparent 50%);
            background-attachment: fixed;
            background-size: cover;
        }

        /* Particle overlay effect */
        .stars {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none;
            background-image:
                    radial-gradient(white, rgba(255,255,255,.2) 2px, transparent 3px),
                    radial-gradient(white, rgba(255,255,255,.15) 1px, transparent 2px),
                    radial-gradient(white, rgba(255,255,255,.1) 2px, transparent 3px);
            background-size: 550px 550px, 350px 350px, 250px 250px;
            background-position: 0 0, 40px 60px, 130px 270px;
            z-index: -1;
            animation: starMove 100s linear infinite;
        }
        @keyframes starMove { from { background-position: 0 0, 40px 60px, 130px 270px; } to { background-position: 550px 550px, 390px 410px, 380px 520px; } }

        .tab-btn.active {
            background: linear-gradient(to right, #ffc107, #ff9800);
            color: black;
            font-weight: 800;
            box-shadow: 0 0 20px rgba(255, 193, 7, 0.6);
            border-color: #ffeb3b;
            transform: scale(1.05);
        }

        .form-input-db {
            background-color: rgba(20, 20, 20, 0.8);
            border: 2px solid #333;
            color: white;
            padding: 16px; /* Tăng padding */
            font-size: 1.25rem; /* Text to */
            border-radius: 12px;
            width: 100%;
            transition: all 0.3s;
        }
        .form-input-db:focus {
            border-color: #ffc107;
            background-color: rgba(0, 0, 0, 0.9);
            box-shadow: 0 0 15px rgba(255, 193, 7, 0.4);
            outline: none;
        }

        .tab-content { display: none; animation: zoomIn 0.4s ease-out; }
        .tab-content.active { display: block; }
        @keyframes zoomIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }

        /* Glass Panel */
        .glass-panel {
            background: rgba(18, 18, 18, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 193, 7, 0.2);
        }
    </style>
</head>
<body class="text-gray-100 font-sans antialiased text-xl leading-relaxed">

<div class="stars"></div>

<?php require_once __DIR__ . '/./layout/header.php'; ?>
<?php require_once __DIR__ . '/./components/banner.php'; ?>

<div class="box--content relative z-10 pb-24">
    <div class="w-full px-4 md:px-8 mt-12 max-w-[1400px] mx-auto">

        <div class="text-center mb-12" data-aos="fade-down">
            <h2 class="text-5xl md:text-6xl font-black uppercase text-transparent bg-clip-text bg-gradient-to-b from-yellow-300 via-yellow-500 to-yellow-700 drop-shadow-[0_4px_4px_rgba(0,0,0,0.9)] animate-float">
                HỆ THỐNG DONATE
            </h2>
            <div class="h-2 w-48 bg-gradient-to-r from-transparent via-yellow-500 to-transparent mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="flex flex-wrap justify-center gap-6 mb-10" data-aos="fade-up">
            <button onclick="switchTab('tab-atm')" id="btn-tab-atm" class="tab-btn active px-8 py-4 rounded-2xl border-2 border-yellow-500/30 text-yellow-500 hover:bg-yellow-500/20 transition-all text-2xl font-bold uppercase tracking-wider">
                <i class="fas fa-university mr-3"></i> ATM
            </button>
            <button onclick="switchTab('tab-card')" id="btn-tab-card" class="tab-btn px-8 py-4 rounded-2xl border-2 border-yellow-500/30 text-yellow-500 hover:bg-yellow-500/20 transition-all text-2xl font-bold uppercase tracking-wider">
                <i class="fas fa-mobile-alt mr-3"></i> Thẻ Cào
            </button>
            <button onclick="switchTab('tab-history')" id="btn-tab-history" class="tab-btn px-8 py-4 rounded-2xl border-2 border-yellow-500/30 text-yellow-500 hover:bg-yellow-500/20 transition-all text-2xl font-bold uppercase tracking-wider">
                <i class="fas fa-history mr-3"></i> Lịch Sử
            </button>
        </div>

        <div class="relative group" data-aos="fade-up" data-aos-delay="100">
            <div class="absolute -inset-1 bg-gradient-to-r from-yellow-600 via-yellow-400 to-yellow-600 rounded-3xl blur opacity-30 group-hover:opacity-60 transition duration-1000"></div>

            <div class="relative glass-panel rounded-3xl p-6 md:p-12 shadow-2xl min-h-[600px]">

                <div id="tab-card" class="tab-content">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                        <div>
                            <h3 class="text-3xl font-black text-yellow-400 mb-8 uppercase border-b-2 border-yellow-500/30 pb-4 inline-block">
                                <i class="fas fa-bolt mr-3"></i> Nhập thông tin thẻ
                            </h3>

                            <form id="myform" method="POST" action="#">
                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-gray-300 mb-2 font-bold text-lg uppercase tracking-wide">Tài khoản:</label>
                                        <input type="text" class="form-input-db bg-gray-800/50 text-gray-400 cursor-not-allowed font-mono" value="<?php echo $_username; ?>" readonly>
                                        <input type="hidden" name="username" value="<?php echo $_username; ?>">
                                    </div>

                                    <div>
                                        <label class="block text-gray-300 mb-2 font-bold text-lg uppercase tracking-wide">Loại nhà mạng:</label>
                                        <select name="card_type" class="form-input-db cursor-pointer" required>
                                            <option value="">-- Chọn loại thẻ --</option>
                                            <?= $card_list_html ?>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-gray-300 mb-2 font-bold text-lg uppercase tracking-wide">Mệnh giá thẻ:</label>
                                        <select name="card_amount" class="form-input-db cursor-pointer" required>
                                            <option value="">-- Chọn đúng mệnh giá --</option>
                                            <option value="10000">10.000đ - 12.000 Coin</option>
                                            <option value="20000">20.000đ - 24.000 Coin</option>
                                            <option value="30000">30.000đ - 36.000 Coin</option>
                                            <option value="50000">50.000đ - 60.000 Coin</option>
                                            <option value="100000">100.000đ - 120.000 Coin</option>
                                            <option value="200000">200.000đ - 240.000 Coin</option>
                                            <option value="300000">300.000đ - 360.000 Coin</option>
                                            <option value="500000">500.000đ - 600.000 Coin</option>
                                            <option value="1000000">1.000.000đ - 1.200.000 Coin</option>
                                        </select>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-gray-300 mb-2 font-bold text-lg uppercase tracking-wide">Số Seri:</label>
                                            <input type="text" name="serial" class="form-input-db" placeholder="Nhập mã Seri..." required>
                                        </div>
                                        <div>
                                            <label class="block text-gray-300 mb-2 font-bold text-lg uppercase tracking-wide">Mã Thẻ (Pin):</label>
                                            <input type="text" name="pin" class="form-input-db" placeholder="Nhập mã thẻ..." required>
                                        </div>
                                    </div>

                                    <div class="pt-6">
                                        <button type="submit" class="w-full relative inline-flex items-center justify-center px-12 py-5 text-2xl font-black text-black transition-all duration-300 bg-gradient-to-r from-yellow-300 via-yellow-500 to-yellow-600 rounded-2xl hover:scale-[1.02] hover:shadow-[0_0_40px_rgba(255,193,7,0.6)] uppercase tracking-widest">
                                            <i class="fas fa-paper-plane mr-3"></i> NẠP THẺ NGAY
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div id="status_alert" class="mt-6 text-xl"></div>
                        </div>

                        <div class="bg-gray-900/60 p-8 rounded-2xl border border-gray-600 h-fit backdrop-blur-sm">
                            <h3 class="text-2xl font-bold text-red-500 mb-6 uppercase flex items-center">
                                <i class="fas fa-exclamation-triangle mr-3 text-3xl"></i> Lưu ý quan trọng
                            </h3>
                            <ul class="space-y-4 text-gray-200 list-disc list-inside text-xl">
                                <li>Vui lòng chọn <b>ĐÚNG MỆNH GIÁ</b>. Sai mệnh giá sẽ bị <b class="text-red-500 uppercase">MẤT THẺ</b>.</li>
                                <li>Hệ thống nạp thẻ tự động 100%, xử lý siêu tốc trong <b>5s - 30s</b>.</li>
                                <li>Hãy kiểm tra kỹ <b>Số Seri</b> và <b>Mã Thẻ</b> trước khi ấn Nạp.</li>
                                <li>Nếu quá 30 phút chưa nhận được Coin, vui lòng liên hệ Admin.</li>
                            </ul>

                            <div class="mt-8 p-6 bg-gradient-to-br from-red-900/50 to-black/50 border-l-8 border-red-500 rounded-xl relative overflow-hidden">
                                <div class="absolute top-0 right-0 w-32 h-32 bg-red-500/20 rounded-full blur-2xl -mr-16 -mt-16"></div>
                                <p class="font-black text-yellow-400 text-2xl mb-2">🎁 KHUYẾN MÃI:</p>
                                <p class="text-lg">⚡ Nạp thẻ cào nhận thêm <span class="text-white font-black text-2xl">20%</span> giá trị.</p>
                                <p class="text-lg">⚡ Nạp ATM nhận thêm <span class="text-white font-black text-2xl">30%</span> giá trị.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tab-atm" class="tab-content active">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                        <div class="bg-white/5 rounded-3xl p-10 border border-white/10 flex flex-col items-center justify-center relative backdrop-blur-md shadow-inner">
                            <h3 class="text-3xl font-bold text-yellow-400 mb-8 uppercase text-center">Quét Mã QR</h3>
                            <div class="relative group cursor-pointer w-full max-w-md mx-auto">
                                <img src="<?= $link_QR.$auth_info['user_id'] ?>" alt="QR Code" class="w-full rounded-2xl border-4 border-yellow-500 shadow-2xl transition-transform transform group-hover:scale-105 duration-300"/>
                                <div class="absolute inset-0 border-4 border-yellow-400 rounded-2xl animate-pulse"></div>
                            </div>
                            <div class="mt-8 flex items-center justify-center space-x-4 w-full bg-black/40 p-4 rounded-xl">
                                <span class="animate-spin inline-flex h-6 w-6 border-4 border-yellow-500 border-t-transparent rounded-full"></span>
                                <span class="text-2xl font-bold text-gray-300">Trạng thái: <span class="text-yellow-400 animate-pulse">Chờ thanh toán...</span></span>
                            </div>
                        </div>

                        <div class="flex flex-col space-y-8">
                            <h3 class="text-4xl font-bold text-yellow-400 mb-4 uppercase">Thông tin chuyển khoản</h3>
                            <div class="bg-gray-800/80 rounded-2xl p-8 border border-gray-600 shadow-lg">
                                <div class="flex items-center mb-8 bg-white/10 p-4 rounded-xl w-fit">
                                    <img src="<?=$bank_img?>" alt="Bank" class="h-16 bg-white rounded-lg px-3 py-1">
                                    <span class="ml-6 font-bold text-3xl text-white tracking-widest"><?=$bank_name?></span>
                                </div>
                                <div class="space-y-6">
                                    <div class="flex justify-between items-center border-b border-gray-600 pb-4">
                                        <span class="text-gray-400 text-xl">Chủ Tài Khoản:</span>
                                        <span class="text-yellow-400 font-bold text-2xl uppercase tracking-wider"><?= $bank_acc_name?></span>
                                    </div>
                                    <div>
                                        <span class="text-gray-400 block mb-2 text-xl">Số Tài Khoản:</span>
                                        <div class="flex items-center bg-black/60 p-4 rounded-xl border border-gray-500 hover:border-yellow-500 transition">
                                            <span class="flex-1 font-mono text-3xl text-cyan-400 font-bold tracking-widest" id="text-stk"><?=$bank_acc?></span>
                                            <button onclick="copyText('text-stk')" class="ml-4 bg-gray-700 hover:bg-yellow-500 hover:text-black text-white p-3 rounded-lg transition shadow-lg"><i class="fas fa-copy fa-xl"></i></button>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="text-gray-400 block mb-2 text-xl">Nội dung chuyển khoản <span class="text-red-500">(Bắt buộc)</span>:</span>
                                        <div class="flex items-center bg-red-900/30 p-4 rounded-xl border border-red-500/60 hover:border-red-500 transition relative overflow-hidden">
                                            <span class="flex-1 font-mono text-2xl text-white font-bold tracking-wide pl-2" id="text-noidung"><?=$transfer_content?></span>
                                            <button onclick="copyText('text-noidung')" class="ml-4 bg-red-800 hover:bg-red-600 text-white p-3 rounded-lg transition shadow-lg"><i class="fas fa-copy fa-xl"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button onclick="swal('Thông báo', 'Hệ thống sẽ tự động duyệt sau 1-2 phút. Nếu lâu hơn vui lòng liên hệ Admin.', 'info')" class="w-full py-5 text-2xl font-black text-black bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 rounded-2xl hover:scale-[1.02] shadow-[0_0_30px_rgba(255,193,7,0.5)] transition-all uppercase">
                                <i class="fas fa-check-circle mr-3"></i> XÁC NHẬN ĐÃ CHUYỂN
                            </button>
                        </div>
                    </div>
                </div>

                <div id="tab-history" class="tab-content">
                    <h3 class="text-3xl font-bold text-yellow-400 mb-8 uppercase text-center"><i class="fas fa-history mr-2"></i> Lịch sử giao dịch</h3>
                    <div class="overflow-x-auto rounded-2xl border border-gray-600 shadow-xl">
                        <table class="w-full text-left border-collapse">
                            <thead>
                            <tr class="bg-gradient-to-r from-yellow-600 to-yellow-800 text-black uppercase text-base md:text-lg leading-normal">
                                <th class="py-4 px-6 font-black text-center border-r border-yellow-500/30">STT</th>
                                <th class="py-4 px-6 font-black text-center border-r border-yellow-500/30">Loại Thẻ</th>
                                <th class="py-4 px-6 font-black text-center border-r border-yellow-500/30">Mệnh Giá</th>
                                <th class="py-4 px-6 font-black text-center border-r border-yellow-500/30">Seri</th>
                                <th class="py-4 px-6 font-black text-center border-r border-yellow-500/30">Pin</th>
                                <th class="py-4 px-6 font-black text-center border-r border-yellow-500/30">Thời Gian</th>
                                <th class="py-4 px-6 font-black text-center">Trạng Thái</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-200 text-lg font-light bg-gray-900/80" id="history_body">
                            <?php
                            if(isset($config)) {
                                $query = "SELECT * FROM trans_log WHERE name = '" . $_username . "' ORDER BY id DESC LIMIT 10";
                                $result = $config->query($query);
                                $stt = 1;
                                if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $status_text = '';
                                        $status_class = '';
                                        if ($row['status'] == 1) {
                                            $status_text = 'Thành công';
                                            $status_class = 'bg-green-600/20 text-green-400 border border-green-500 rounded-lg px-3 py-1 font-bold';
                                        } elseif ($row['status'] == 2) {
                                            $status_text = 'Thất bại';
                                            $status_class = 'bg-red-600/20 text-red-400 border border-red-500 rounded-lg px-3 py-1 font-bold';
                                        } else {
                                            $status_text = 'Đang xử lý';
                                            $status_class = 'bg-yellow-500/20 text-yellow-400 border border-yellow-500 rounded-lg px-3 py-1 font-bold animate-pulse';
                                        }
                                        echo "<tr class='border-b border-gray-700 hover:bg-gray-800 transition'>";
                                        echo "<td class='py-4 px-6 text-center font-bold text-gray-400'>{$stt}</td>";
                                        echo "<td class='py-4 px-6 text-center font-bold text-yellow-500 uppercase'>{$row['type']}</td>";
                                        echo "<td class='py-4 px-6 text-center text-green-400 font-bold'>" . number_format($row['amount']) . "đ</td>";
                                        echo "<td class='py-4 px-6 text-center font-mono'>{$row['seri']}</td>";
                                        echo "<td class='py-4 px-6 text-center text-gray-500'>{$row['pin']}</td>";
                                        echo "<td class='py-4 px-6 text-center text-sm'>{$row['date']}</td>";
                                        echo "<td class='py-4 px-6 text-center'><span class='{$status_class}'>{$status_text}</span></td>";
                                        echo "</tr>";
                                        $stt++;
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='py-10 text-center text-2xl text-gray-500 font-bold'>Bạn chưa có giao dịch nào.</td></tr>";
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/./layout/footer.php'; ?>
<?php require_once __DIR__ . '/./components/sidebar-right.php'; ?>

<script src="<?= define_url("assets/frontend/home/v1/js/jquery.min.js")?>"></script>
<script src="<?= define_url("assets/frontend/home/v1/js/ScrollMagic.min.js")?>"></script>
<script src="<?= define_url("assets/frontend/home/v1/js/aos.js")?>"></script>
<script src="<?= define_url("assets/frontend/home/v1/js/slick.min.js")?>"></script>
<script src="<?= define_url("assets/frontend/home/v1/js/jquery.fancybox.min.js")?>"></script>

<script>
    AOS.init({ once: true, offset: 50, duration: 800 });

    function switchTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
        document.getElementById(tabId).classList.add('active');
        document.getElementById('btn-' + tabId).classList.add('active');
    }

    function copyText(elementId) {
        var text = document.getElementById(elementId).innerText;
        navigator.clipboard.writeText(text).then(function() {
            toastr.success('Đã sao chép: ' + text);
        }, function(err) {
            toastr.error('Lỗi sao chép');
        });
    }

    $(document).ready(function () {
        $("#myform").submit(function (e) {
            e.preventDefault();
            let btn = $(this).find('button[type="submit"]');
            let originalText = btn.html();
            btn.html('<i class="fas fa-spinner fa-spin"></i> Đang xử lý...').prop('disabled', true);

            $.ajax({
                url: "./ajax/card.php",
                type: 'post',
                data: $("#myform").serialize(),
                success: function (data) {
                    $("#status_alert").html(data);
                    document.getElementById("myform").reset();
                    btn.html(originalText).prop('disabled', false);
                },
                error: function() {
                    toastr.error('Có lỗi xảy ra, vui lòng thử lại sau.');
                    btn.html(originalText).prop('disabled', false);
                }
            });
        });

        $('.ctFixRight').click(function () {
            $('.sidebar_right').toggleClass('mo');
            $(this).toggleClass('ctFixRight-mo');
        });
        $(".go-top").click(function () {
            $("html,body").animate({scrollTop: 0}, 100);
        });
    });
</script>

</body>
</html>