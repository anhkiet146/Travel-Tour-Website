<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tour_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
// Kiểm tra session để đảm bảo người dùng đã đăng nhập
// Kiểm tra tình huống (ví dụ: người dùng chưa đăng nhập)
if (!isset($_SESSION['username'])) {
    $_SESSION['notification'] = [
        'message' => 'Bạn cần đăng nhập để đánh giá!',
        'type' => 'error' // 'success' hoặc 'error' tùy thuộc vào thông báo
    ];
    // Hiển thị thông báo trước khi redirect
    header("Location: chitiettour.php?tour_id=$tour_id");
    exit();
}

// Lấy dữ liệu từ form
$MaKH = $_SESSION['makhach']; // Mã khách hàng từ session
$TourID = isset($_POST['TourID']) ? $_POST['TourID'] : 0; // Lấy TourID từ form
$NoiDung = $_POST['NoiDung'];
$NgayDG = date("Y-m-d"); // Lấy ngày hiện tại

// Kiểm tra xem TourID có tồn tại trong bảng tour không
$tourCheckStmt = $conn->prepare("SELECT COUNT(*) FROM tour WHERE TourID = ?");
$tourCheckStmt->bind_param("s", $TourID);
$tourCheckStmt->execute();
$tourCheckStmt->bind_result($tourExists);
$tourCheckStmt->fetch();
$tourCheckStmt->close();

if ($tourExists > 0) {
    // Nếu TourID hợp lệ, thêm đánh giá vào bảng
    $stmt = $conn->prepare("INSERT INTO danh_gia (MaKH, TourID, NgayDG, NoiDung) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $MaKH, $TourID, $NgayDG, $NoiDung);

    if ($stmt->execute()) {
        $_SESSION['notification'] = [
            'message' => 'Đánh giá đã được gửi thành công!',
            'type' => 'success'
        ];
    } else {
        $_SESSION['notification'] = [
            'message' => 'Có lỗi xảy ra khi gửi đánh giá. Vui lòng thử lại!',
            'type' => 'error'
        ];
    }

    $stmt->close();
} else {
    $_SESSION['notification'] = [
        'message' => 'Tour bạn chọn không tồn tại.',
        'type' => 'error'
    ];
}

// Chuyển hướng người dùng đến trang chi tiết tour sau khi lưu thông báo
header("Location: chitiettour.php?tour_id=$TourID");
exit(); // Đảm bảo mã dừng lại ở đây sau khi chuyển hướng


$conn->close();
?>