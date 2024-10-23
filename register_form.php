<?php
if (isset($_POST['submit'])) {
    // Kết nối đến cơ sở dữ liệu
    $connection = mysqli_connect('localhost', 'root', '', 'tour_db');

    // Nhận dữ liệu từ biểu mẫu
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $cpassword = mysqli_real_escape_string($connection, $_POST['cpassword']);

    // Kiểm tra độ dài mật khẩu
    if (strlen($password) < 6) {
        $error[] = "Mật khẩu phải có ít nhất 6 ký tự.";
    }

    // Kiểm tra tính duy nhất của tên người dùng
    if (empty($error)) {
        $checkUsername = "SELECT * FROM KHACHHANG WHERE username = '$username'";
        $result = mysqli_query($connection, $checkUsername);

        if (mysqli_num_rows($result) > 0) {
            $error[] = "Tên người dùng đã tồn tại. Vui lòng chọn tên khác.";
        } else {
            // Kiểm tra mật khẩu
            if ($password !== $cpassword) {
                $error[] = "Mật khẩu không khớp.";
            } else {
                // Mã hóa mật khẩu
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Lấy mã khách hàng cuối cùng
                $lastCustomerQuery = "SELECT makhach FROM KHACHHANG ORDER BY makhach DESC LIMIT 1";
                $lastCustomerResult = mysqli_query($connection, $lastCustomerQuery);
                $lastCustomer = mysqli_fetch_assoc($lastCustomerResult);

                // Kiểm tra nếu đã có mã khách hàng nào trước đó
                if ($lastCustomer) {
                    // Tách phần số của mã khách hàng cuối cùng và tăng lên 1
                    $lastCustomerNumber = (int)substr($lastCustomer['makhach'], 3);
                    $newCustomerNumber = $lastCustomerNumber + 1;
                    // Tạo mã khách hàng mới theo định dạng KHT + số tăng dần
                    $newCustomerID = 'KHT' . str_pad($newCustomerNumber, 2, '0', STR_PAD_LEFT);
                } else {
                    // Nếu chưa có khách hàng nào, mã đầu tiên sẽ là KHT01
                    $newCustomerID = 'KHT01';
                }

                // Chèn dữ liệu vào bảng với mã khách hàng mới
                $insert = "INSERT INTO KHACHHANG(makhach, hoten, username, matkhau, ngaydangky) 
                           VALUES ('$newCustomerID', '$name', '$username', '$hashedPassword', NOW())";
                mysqli_query($connection, $insert);
                header('location: login_form.php');
                exit();
            }
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

    <link rel="stylesheet" href="css/login-register.css?v=<?php echo time(); ?>" type="text/css">
</head>
<body>
    <!-- Form HTML -->
    <div class="form-container">
        <form action="" method="post">
            <h3>Đăng ký ngay</h3>
            <?php
                // Kiểm tra xem biến $error có tồn tại và là một mảng không
                if (isset($error) && is_array($error)) {
                    foreach ($error as $err) { // Đổi tên biến trong vòng lặp để tránh nhầm lẫn
                        echo '<span class="error-msg">' . htmlspecialchars($err) . '</span>'; // Bảo vệ đầu ra
                    }
                } elseif (isset($error) && is_string($error)) {
                    // Nếu $error là một chuỗi, bạn có thể hiển thị nó trực tiếp
                    echo '<span class="error-msg">' . htmlspecialchars($error) . '</span>'; // Bảo vệ đầu ra
                }
            ?>

            <input type="text" name="name" required placeholder="Nhập tên của bạn">
            <input type="text" name="username" required placeholder="Nhập tên người dùng">
            <input type="password" name="password" required placeholder="Nhập mật khẩu">
            <input type="password" name="cpassword" required placeholder="Xác nhận mật khẩu">
            <input type="submit" name="submit" value="Đăng ký ngay" class="form-btn">
            <p>Đã có tài khoản? <a href="login_form.php">Đăng nhập ngay</a></p>
        </form>
    </div>
    <!-- End Login Form -->
    <!-- Swiper JS Link -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <!-- Custom JS File Link -->
    <script type="text/javascript" src="js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>
