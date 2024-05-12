<?php
$gioBatDau = $gioKetThuc = $tienThanhToan = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gioBatDau = $_POST["gioBatDau"];
    $gioKetThuc = $_POST["gioKetThuc"];

    if ($gioBatDau < 10 || $gioKetThuc > 24 || $gioBatDau >= $gioKetThuc) {
        $tienThanhToan = "Giờ không hợp lệ";
    } else {
        $tienBanNgay = $tienBanDem = 0;

        // Tính tiền ban ngày từ 10h đến 17h
        if ($gioBatDau < 17) {
            $endDay = min($gioKetThuc, 17);
            $tienBanNgay = max(0, $endDay - max($gioBatDau, 10)) * 20000;
        }

        // Tính tiền ban đêm từ 17h đến 24h
        if ($gioKetThuc > 17) {
            $startNight = max($gioBatDau, 17);
            $tienBanDem = ($gioKetThuc - $startNight) * 45000;
        }

        $tienThanhToan = $tienBanNgay + $tienBanDem;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tính Tiền Karaoke</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #87CEFA; }
        form { 
            background-color: #008B8B; 
            padding: 20px; 
            margin-top: 50px;
            width: 300px; 
            border-radius: 5px;
            color: white;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h2>TÍNH TIỀN KARAOKE</h2>
        Giờ bắt đầu: <input type="text" name="gioBatDau" value="<?php echo $gioBatDau;?>">
        Giờ kết thúc: <input type="text" name="gioKetThuc" value="<?php echo $gioKetThuc;?>">
        Tiền thanh toán: <input type="text" value="<?php echo $tienThanhToan;?>" disabled>
        <input type="submit" value="Tính">
    </form>
</body>
</html>
