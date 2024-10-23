<?php
session_start(); 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "tour_db"; 

// Tạo kết nối
$connection = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($connection->connect_error) {
    die("Kết nối thất bại: " . $connection->connect_error);
}

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}

$username = $_SESSION['username'];

// Lấy thông tin người dùng từ cơ sở dữ liệu
$stmt = $connection->prepare("SELECT * FROM khachhang WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Kiểm tra và xử lý cập nhật thông tin
if (isset($_POST['update'])) {
    // Lấy dữ liệu từ form
    $hoten = $_POST['hoten'];
    $email = $_POST['email'];
    $ngaysinh = $_POST['ngaysinh'];
    $gioitinh = $_POST['gioitinh'];
    $sodienthoai = $_POST['sodienthoai'];

    // Xử lý upload ảnh
    if ($_FILES['avatar']['name']) {
        $avatar = $_FILES['avatar']['name'];
        $target = "uploads/" . basename($avatar);
        
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $target)) {
            // Cập nhật avatar trong cơ sở dữ liệu
            $stmt = $connection->prepare("UPDATE khachhang SET avatar = ? WHERE username = ?");
            $stmt->bind_param("ss", $avatar, $username);
            $stmt->execute();
        } else {
            $error = "Có lỗi trong việc tải lên ảnh.";
        }
    }

    // Cập nhật thông tin khác
    $stmt = $connection->prepare("UPDATE khachhang SET hoten = ?, email = ?, ngaysinh = ?, gioitinh = ?, sodienthoai = ? WHERE username = ?");
    $stmt->bind_param("ssssss", $hoten, $email, $ngaysinh, $gioitinh, $sodienthoai, $username);
    $stmt->execute();

    header("Location: profile.php"); // Chuyển hướng lại trang profile
    exit();
}
?>