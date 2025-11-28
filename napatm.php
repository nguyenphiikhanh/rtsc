<?php ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nạp ATM - Chuyển khoản</title>

    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">

    <style>
        body {
            background-color: #1a1a1a;
            background-image: url('https://wallpaperaccess.com/full/1155015.jpg');
            background-size: cover;
            background-attachment: fixed;
            font-family: 'Arial', sans-serif;
            padding-bottom: 50px;
        }

        .container-custom {
            max-width: 800px;
            margin: 0 auto;
        }

        /* --- CSS MỚI: Nút Quay lại trang chủ --- */
        .btn-home {
            display: inline-flex;
            align-items: center;
            color: #ddd;
            text-decoration: none !important;
            font-weight: bold;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            padding: 8px 20px;
            background: rgba(0, 0, 0, 0.6); /* Nền đen mờ */
            border-radius: 30px; /* Bo tròn viên thuốc */
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 15px; /* Cách box dưới */
        }

        .btn-home:hover {
            color: #ffc107; /* Chữ chuyển vàng */
            border-color: #ffc107;
            background: rgba(0, 0, 0, 0.9);
            box-shadow: 0 0 10px rgba(255, 193, 7, 0.3); /* Phát sáng nhẹ */
            transform: translateX(-5px); /* Hiệu ứng trượt sang trái */
        }
        
        .btn-home i {
            font-size: 0.9rem;
            margin-right: 8px;
        }

        /* --- CSS CŨ --- */
        .textinfo {
            border: 1px solid #ffc107;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            text-align: center;
            font-weight: bold;
            color: #ffc107;
            border-radius: 5px;
            line-height: 1.8;
        }

        .glow-box {
            border: 2px solid #ffc107;
            border-radius: 10px;
            box-shadow: 0 0 15px #ffc107;
            background: #1c1c1c;
            color: #fff;
            transition: 0.3s;
            height: 100%;
        }

        .glow-box:hover {
            box-shadow: 0 0 25px #ffeb3b;
            transform: scale(1.02);
        }

        .glow-text {
            text-shadow: 0 0 8px #ffeb3b, 0 0 12px #ffc107;
            color: #fff;
            font-weight: bold;
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        .styled-heading {
            font-family: 'Be Vietnam Pro', sans-serif;
            font-size: 2rem;
            font-weight: 900;
            color: #ffcc00;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 25px;
            text-shadow: 0 0 5px #ffeb3b, 0 0 10px #ffc107;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .table-responsive {
            border-radius: 5px;
            overflow: hidden;
        }
        
        .history-table th {
            padding: 12px;
            text-align: left;
            border: 1px solid #444;
            background-color: #00d0ff;
            color: #000;
            font-weight: bold;
            text-shadow: none;
        }

        .history-table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #444;
            color: white;
            background-color: rgba(0,0,0,0.5);
        }

        .main-box {
            background-color: rgba(57,57,57, 0.9); 
            border-radius: 7px; 
            box-shadow: 0px 5px 15px black; 
            margin-bottom: 20px;
            padding: 15px;
        }

        .btn-custom {
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .info-table td {
            padding: 8px 5px;
            border: none;
            text-align: left;
        }
        .info-table td:first-child {
            width: 40%;
            color: #ccc;
        }
        .info-table {
            margin-bottom: 0;
        }

        .qr-img {
            max-width: 100%;
            border-radius: 5px;
            border: 2px solid white;
        }

        .btn-confirm {
            background: linear-gradient(to bottom, #ffc107, #ff9800);
            border: none;
            color: #000;
            font-family: 'Be Vietnam Pro', sans-serif;
            font-weight: 900;
            font-size: 1.2rem;
            padding: 12px 40px;
            border-radius: 50px;
            box-shadow: 0 0 15px #ffc107;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            outline: none !important;
        }

        .btn-confirm:hover {
            transform: scale(1.05);
            box-shadow: 0 0 30px #ffeb3b, 0 0 10px #fff;
            color: #000;
        }
        
        /* Modal CSS */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            display: none; 
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-box {
            background: #1c1c1c;
            width: 90%;
            max-width: 400px;
            border: 2px solid #ffc107;
            border-radius: 10px;
            box-shadow: 0 0 30px #ffc107;
            padding: 20px;
            text-align: center;
            color: white;
            transform: scale(0.8);
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }

        .modal-box h3 {
            color: #ffcc00;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 15px;
            text-shadow: 0 0 10px #ffcc00;
        }

        .modal-box p {
            font-size: 1rem;
            color: #ddd;
            margin-bottom: 20px;
        }

        .loader {
            border: 4px solid #333;
            border-top: 4px solid #ffc107;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 15px auto;
        }

        .btn-close-modal {
            background: #444;
            color: white;
            border: 1px solid #666;
            padding: 8px 25px;
            border-radius: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-close-modal:hover {
            background: #ffc107;
            color: black;
            box-shadow: 0 0 10px #ffc107;
        }

        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }
        .modal-overlay.active .modal-box {
            transform: scale(1);
        }
    </style>
</head>
<body>

<div class="container container-custom mt-4">

    <div>
        <a href="/" class="btn-home">
            <i class="fas fa-arrow-left"></i> Quay lại trang chủ
        </a>
    </div>
    <div class="main-box">
        <div class="d-flex justify-content-center align-items-center">
            <a href="#" class="btn btn-lg btn-dark mx-2 btn-custom w-50 active">Nạp ATM</a>
        </div>
    </div>

    <div class="main-box">
        <h1 class="styled-heading">✨ Thông tin Chuyển khoản ✨</h1>

        <div class="row px-2 mb-2" id="checkout_box">
            
            <div class="col-md-6 mb-3">
                <div class="p-3 text-center glow-box">
                    <p class="glow-text">Cách 1: Quét mã QR</p>
                    <div class="my-2">
                        <img src="https://qr.sepay.vn/img?bank=MBBank&acc=6004012002&template=compact&des=assassin12345" class="qr-img">
                        <div class="mt-3 text-warning fw-bold" style="font-size: 0.9rem;">
                            <span>⏳ Trạng thái:</span> <span class="text-white">Chờ thanh toán...</span>
                            <div class="spinner-border spinner-border-sm text-warning ml-1" role="status"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="p-3 text-center glow-box d-flex flex-column justify-content-center">
                    <p class="glow-text">Cách 2: Chuyển khoản thủ công</p>
                    
                    <img src="https://qr.sepay.vn/assets/img/banklogo/MB.png" class="img-fluid mb-2 mx-auto" style="max-height:40px">
                    <p class="fw-bold text-white mb-3">Ngân hàng MBBank</p>

                    <table class="table info-table text-white">
                        <tbody>
                            <tr>
                                <td>Chủ tài khoản:</td>
                                <td><span class="text-warning font-weight-bold">NGUYEN QUOC DUY</span></td>
                            </tr>
                            <tr>
                                <td>Số tài khoản:</td>
                                <td><span class="text-info font-weight-bold" style="font-size: 1.2rem;">6004012002</span></td>
                            </tr>
                            <tr>
                                <td>Nội dung:</td>
                                <td><span class="text-danger font-weight-bold" style="font-size: 1.2rem; background: white; padding: 2px 5px; border-radius: 3px;">assassin12345</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-3" style="font-size: 0.85rem;">
                        <p class="bg-dark text-light p-2 rounded mb-1">💡 Copy chính xác <b>Nội dung</b> (Mã GD).</p>
                        <p class="bg-dark text-light p-2 rounded mb-0">💡 Hệ thống tự động duyệt sau 30s - 1p.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-2 mb-4">
            <button type="button" class="btn-confirm" onclick="showModal()">
                <i class="fas fa-check-circle mr-2"></i> XÁC NHẬN ĐÃ CHUYỂN KHOẢN
            </button>
        </div>
        
        <h4 class="text-white text-center font-weight-bold mt-4 mb-3" style="text-shadow: 2px 2px 2px #000;">Bảng giá Ủng Hộ</h4>
        <div class="textinfo mb-3">
            <p class="m-0">- 10.000đ = 12.000 Coin (x1.2)</p>
            <p class="m-0">- 20.000đ = 24.000 Coin (x1.2)</p>
            <p class="m-0">- 50.000đ = 60.000 Coin (x1.2)</p>
            <p class="m-0">- 100.000đ = 120.000 Coin (x1.2)</p>
            <p class="m-0">- 200.000đ = 240.000 Coin (x1.2)</p>
            <p class="m-0">- 500.000đ = 600.000 Coin (x1.2)</p>
            <p class="m-0" style="color: #ff5722;">- 2.000.000đ = 2.600.000 Coin (x1.3)</p>
        </div>

        <div class="text-white small pl-2">
            <div>- Lưu ý: Chuyển đúng nội dung bao gồm cả DẤU CÁCH</div>
            <div>- Chuyển khoản ít nhất 1.000Đ mới Thành công</div>
            <div>- Quá 30 Phút chưa nhận được Coin hãy liên hệ Admin.</div>
        </div>
    </div>

    <div class="main-box">
        <h3 class="styled-heading" style="font-size: 1.5rem;">Lịch Sử Chuyển khoản</h3>
        
        <div class="table-responsive">
            <table class="table history-table mb-0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tài Khoản</th>
                        <th>Mệnh Giá</th>
                        <th>Thời Gian</th>
                        <th>Trạng Thái</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>demo_account</td>
                        <td>50,000đ</td>
                        <td>28/11/2025 10:30</td>
                        <td style="color: #00ff00; font-weight: bold;">Thành công</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>demo_account</td>
                        <td>20,000đ</td>
                        <td>27/11/2025 15:45</td>
                        <td style="color: #ff0000; font-weight: bold;">Thất bại</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="modal-overlay" id="paymentModal">
    <div class="modal-box">
        <div class="loader"></div>
        <h3>ĐANG XỬ LÝ...</h3>
        <p>Hệ thống đã ghi nhận yêu cầu.</p>
        <p>Vui lòng đợi <b>30 giây - 1 phút</b> để hệ thống tự động cộng tiền.</p>
        <p class="small text-muted">Nếu quá 5 phút chưa nhận được, vui lòng chụp ảnh giao dịch và liên hệ Admin.</p>
        <button class="btn-close-modal" onclick="closeModal()">Đã hiểu, Đóng lại</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<script>
    function showModal() {
        $('#paymentModal').addClass('active');
    }

    function closeModal() {
        $('#paymentModal').removeClass('active');
    }

    $(document).mouseup(function(e) {
        var container = $(".modal-box");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            closeModal();
        }
    });
</script>

</body>
</html>