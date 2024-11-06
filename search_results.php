<?php
require 'config.php';

// Lấy giá trị từ form gửi qua GET
$tour_name = isset($_GET['tour_name']) ? $_GET['tour_name'] : '';

if (empty($tour_name)) {
    echo "<p class='alert'>Vui lòng nhập tên tour để tìm kiếm.</p>";
    exit;
}

// Chuẩn bị truy vấn SQL
$sql = "SELECT TourID, TourName, MoTa, NgayBatDau, NgayKetThuc, ThoiGianTour, GiaVeNguoiLon 
        FROM tour 
        WHERE TourName LIKE :tour_name";

$stmt = $pdo->prepare($sql);

// Dùng dấu % để tìm kiếm những tên tour có chứa chuỗi tour_name
$stmt->bindValue(':tour_name', "%$tour_name%");
$stmt->execute();

// Lấy kết quả trả về
$tours = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }

        .alert {
            color: #e74c3c;
            text-align: center;
            font-size: 16px;
            margin-top: 50px;
        }

        .tour-list {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }

        .tour-item {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .tour-item:hover {
            transform: translateY(-5px);
        }

        .tour-item h3 {
            color: #2980b9;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .tour-item p {
            font-size: 0.95rem;
            color: #7f8c8d;
            margin-bottom: 10px;
        }

        .tour-item .price {
            font-weight: bold;
            color: #e67e22;
        }

        .tour-item .dates {
            font-size: 0.9rem;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .tour-item .description {
            font-size: 0.9rem;
            color: #7f8c8d;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .tour-list {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 480px) {
            .tour-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<h2>Kết quả tìm kiếm cho '<?php echo htmlspecialchars($tour_name); ?>'</h2>

<?php
if ($tours) {
    echo "<div class='tour-list'>";
    foreach ($tours as $tour) {
        echo "<div class='tour-item'>
                <h3>{$tour['TourName']}</h3>
                <p class='dates'>Ngày bắt đầu: {$tour['NgayBatDau']} - Ngày kết thúc: {$tour['NgayKetThuc']} - Thời gian: {$tour['ThoiGianTour']} ngày</p>
                <p class='price'>Giá vé: " . number_format($tour['GiaVeNguoiLon'], 0, ',', '.') . " VND</p>
                <p class='description'>{$tour['MoTa']}</p>
              </div>";
    }
    echo "</div>";
} else {
    echo "<p class='alert'>Không tìm thấy kết quả cho '$tour_name'.</p>";
}
?>

</body>
</html>
