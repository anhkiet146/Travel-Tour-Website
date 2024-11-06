<?php
// Database configuration
$host = 'localhost';  // Địa chỉ máy chủ, thường là 'localhost'
$dbname = 'tour_db';  // Tên của cơ sở dữ liệu
$username = 'root';  // Tên người dùng để kết nối đến CSDL
$password = '';  // Mật khẩu của người dùng

// Thiết lập kết nối PDO
try {
    // PDO sẽ kết nối đến cơ sở dữ liệu với các tham số được truyền vào
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Thiết lập chế độ lỗi PDO để xử lý ngoại lệ khi có sự cố
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Hiển thị thông báo lỗi khi kết nối thất bại
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}
?>
