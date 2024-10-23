<?php
session_start(); 
// Kết nối cơ sở dữ liệu
$connection = mysqli_connect('localhost', 'root', '', 'tour_db');

if (isset($_POST['submit'])) {
    // Bảo mật đầu vào
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập trong bảng khachhang
    $stmt = $connection->prepare("SELECT * FROM khachhang WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Sử dụng password_verify để kiểm tra mật khẩu
        if (password_verify($password, $row['matkhau'])) {
            // Thiết lập session cho user
            $_SESSION['username'] = $row['username'];
            $_SESSION['makhach'] = $row['makhach'];
            $_SESSION['role'] = 'user'; // Gán role là user
            header('location: home.php');
            exit(); // Ngăn không cho mã tiếp tục chạy
        } else {
            $error[] = 'Tên người dùng hoặc mật khẩu không đúng';
        }
    } else {
        // Kiểm tra thông tin đăng nhập trong bảng admin
        $stmt = $connection->prepare("SELECT * FROM admin WHERE Username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Sử dụng password_verify để kiểm tra mật khẩu
            if (password_verify($password, $row['PasswdHash'])) {
                // Thiết lập session cho admin
                $_SESSION['username'] = $row['Username'];
                $_SESSION['maad'] = $row['MaAD'];
                $_SESSION['role'] = 'admin'; // Gán role là admin
                header('Location: /Travel-Tour-Website/admin-dashboard/index.php'); // Đường dẫn đúng
                exit(); // Ngăn không cho mã tiếp tục chạy
            } else {
                $error[] = 'Tên người dùng hoặc mật khẩu không đúng';
            }
        } else {
            $error[] = 'Tên người dùng hoặc mật khẩu không đúng';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <!-- Swiper CSS Link -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Custom CSS File Link -->
    <link rel="stylesheet" href="css/login-register.css?v=<?php echo time(); ?>" type="text/css">
</head>
<body>
    <!-- Start Login Form -->
    <div class="form-container">
        <form action="" method="post">
            <h3>Đăng nhập ngay</h3>
            <?php
                // Kiểm tra xem biến $error có tồn tại và là một mảng không
                if (isset($error) && is_array($error)) {
                    foreach ($error as $err) {
                        echo '<span class="error-msg">' . htmlspecialchars($err) . '</span>';
                    }
                } elseif (isset($error) && is_string($error)) {
                    echo '<span class="error-msg">' . htmlspecialchars($error) . '</span>';
                }
            ?>

            <input type="text" name="username" required placeholder="Nhập tên người dùng của bạn">
            <input type="password" name="password" required placeholder="Nhập mật khẩu của bạn">
            <input type="submit" name="submit" value="Đăng nhập" class="form-btn">
            <p>Chưa có tài khoản? <a href="register_form.php">Đăng ký ngay</a></p>
        </form>
    </div>
    <!-- End Login Form -->
    <!-- Swiper JS Link -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <!-- Custom JS File Link -->
    <script type="text
