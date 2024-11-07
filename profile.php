<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['username'])) {
    header("Location: login_form.php");
    exit();
}

// Kết nối cơ sở dữ liệu
$connection = mysqli_connect('localhost', 'root', '', 'tour_db');

// Lấy thông tin khách hàng từ bảng khachhang
$username = $_SESSION['username'];
$stmt = $connection->prepare("SELECT hoten, username, ngaydangky, avatar, matkhau, ngaysinh, gioitinh, email, sodienthoai FROM khachhang WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra xem có kết quả không
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    $error = "Không tìm thấy thông tin người dùng.";
}

// Xử lý form thay đổi mật khẩu
if (isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Kiểm tra mật khẩu hiện tại
    if (password_verify($current_password, $row['matkhau'])) {
        if ($new_password == $confirm_password) {
            // Mã hóa mật khẩu mới và cập nhật
            $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $stmt = $connection->prepare("UPDATE khachhang SET matkhau = ? WHERE username = ?");
            $stmt->bind_param("ss", $new_hashed_password, $username);
            if ($stmt->execute()) {
                header("Location: profile.php");
                exit();
            } else {
                $error = "Có lỗi khi cập nhật mật khẩu.";
            }
        } else {
            $error = "Mật khẩu mới không khớp.";
        }
    } else {
        $error = "Mật khẩu hiện tại không chính xác.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Cá Nhân</title>
    <link rel="stylesheet" href="css/profile.css?v=<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function openTab(tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByTagName("button");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            event.currentTarget.className += " active";
        }

        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("defaultOpen").click(); // Mở tab mặc định
        });
    </script>
</head>
<body>
    <div class="breadcrumb">
        <a href="home.php">Home</a> &gt; 
        <a href="profile.php">Profile</a>
    </div>
    
    <div class="tab">
        <button class="tablinks" onclick="openTab('view-info')" id="defaultOpen">Thông tin cá nhân</button>
        <button class="tablinks" onclick="openTab('edit-info')">Sửa thông tin</button>
        <button class="tablinks" onclick="openTab('change-password')">Đổi mật khẩu</button>
    </div>

    <div id="view-info" class="tab-content">
        <h1>Thông Tin Cá Nhân</h1>
        <?php if (isset($error)): ?>
            <p class="error-msg"><?php echo $error; ?></p>
        <?php else: ?>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center">
                        <?php if ($row['avatar']): ?>
                            <img src="uploads/<?php echo htmlspecialchars($row['avatar']); ?>" alt="Avatar" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                        <?php else: ?>
                            <div class="user-icon" style="font-size: 150px; color: #007bff;">
                                <i class="fas fa-user-circle"></i> <!-- Biểu tượng người dùng -->
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-8">
                        <p><strong>Họ tên:</strong> <?php echo htmlspecialchars($row['hoten']); ?></p>
                        <p><strong>Tên đăng nhập:</strong> <?php echo htmlspecialchars($row['username']); ?></p>
                        <p><strong>Ngày đăng ký:</strong> <?php echo htmlspecialchars($row['ngaydangky']); ?></p>
                        <p><strong>Email:</strong> <?php echo !empty($row['email']) ? htmlspecialchars($row['email']) : ''; ?></p>
                        <p><strong>Ngày sinh:</strong> <?php echo !empty($row['ngaysinh']) ? htmlspecialchars($row['ngaysinh']) : ''; ?></p>
                        <p><strong>Số điện thoại:</strong> <?php echo !empty($row['sodienthoai']) ? htmlspecialchars($row['sodienthoai']) : ''; ?></p>
                        <p><strong>Giới tính:</strong> <?php echo !empty($row['gioitinh']) ? htmlspecialchars($row['gioitinh']) : ''; ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>



    <div id="edit-info" class="tab-content">
        <h1>Chỉnh Sửa Thông Tin</h1>
            <div class="form-container">
                <div class="form-card">
                    <form action="edit_profile.php" method="post" enctype="multipart/form-data">
                    <label for="hoten">Họ tên:</label>
                    <input type="text" id="hoten" name="hoten" value="<?php echo htmlspecialchars($row['hoten']); ?>" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>">

                    <label for="ngaysinh">Ngày sinh:</label>
                    <input type="date" id="ngaysinh" name="ngaysinh" value="<?php echo htmlspecialchars($row['ngaysinh']); ?>">

                    <label for="gioitinh">Giới tính:</label>
                    <select id="gioitinh" name="gioitinh">
                        <option value="Nam" <?php echo (!empty($row['gioitinh']) && $row['gioitinh'] == 'Nam') ? 'selected' : 'selected'; ?>>Nam</option>
                        <option value="Nữ" <?php echo (!empty($row['gioitinh']) && $row['gioitinh'] == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                        <option value="Khác" <?php echo (!empty($row['gioitinh']) && $row['gioitinh'] == 'Khác') ? 'selected' : ''; ?>>Khác</option>
                    </select>
                    <label for="sodienthoai">Số điện thoại:</label>
                    <input type="text" id="sodienthoai" name="sodienthoai" value="<?php echo htmlspecialchars($row['sodienthoai']); ?>">

                    <label for="avatar">Chọn ảnh đại diện:</label>
                    <input type="file" name="avatar" id="avatar">
                    <input type="submit" name="update" value="Cập nhật">
                </form>
            </div>
        </div>
    </div>


    <div id="change-password" class="tab-content">
        <h1>Đổi Mật Khẩu</h1>
        <form action="" method="post">
            <label for="current_password">Mật khẩu hiện tại:</label>
            <input type="password" name="current_password" id="current_password" required>
            
            <label for="new_password">Mật khẩu mới:</label>
            <input type="password" name="new_password" id="new_password" required>
            
            <label for="confirm_password">Xác nhận mật khẩu:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            
            <input type="submit" name="change_password" value="Đổi mật khẩu">
        </form>
    </div>
</body>
</html>