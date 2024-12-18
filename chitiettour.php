<?php
session_start(); 
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tour_db";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lấy ID tour từ URL
$tour_id = isset($_GET['tour_id']) ? intval($_GET['tour_id']) : 0;
$TourID = isset($_GET['tour_id']) ? $_GET['tour_id'] : 0;

// Kiểm tra xem có thông báo nào trong session không
if (isset($_SESSION['notification'])) {
    $notification = $_SESSION['notification'];
    $message = $notification['message'];
    $type = $notification['type'];

    // Chọn kiểu thông báo: 'error' hoặc 'success'
    if ($type === 'error') {
        echo "<div class='notification error'>$message</div>";
    } else {
        echo "<div class='notification success'>$message</div>";
    }

    // Xóa thông báo sau khi hiển thị
    unset($_SESSION['notification']);
}

// Truy vấn thông tin tour và kết nối các bảng
$sql = "SELECT t.TourName, t.MoTa, t.GiaVeTreEm, t.GiaVeNguoiLon, 
               t.ThoiGianTour, t.NgayThem, t.NgayBatDau, t.NgayKetThuc, 
               t.SoCho, t.HinhAnh, 
               lt.TenLoai AS TenLoaiTour, 
               km.TenKM AS TenKhuyenMai
        FROM tour t
        LEFT JOIN loai_tour lt ON t.MaLoai = lt.MaLoai
        LEFT JOIN khuyen_mai km ON t.MaKM = km.MaKM
        WHERE t.TourID = ?";

// Truy vấn thông tin lịch trình tour
$sql_lich_trinh = "SELECT FileLT FROM lich_trinh_tour WHERE TourID = ?";
$stmt_lich_trinh = $conn->prepare($sql_lich_trinh);
$stmt_lich_trinh->bind_param("i", $tour_id);
$stmt_lich_trinh->execute();
$result_lich_trinh = $stmt_lich_trinh->get_result();

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $tour_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $tour = $result->fetch_assoc();
} else {
    echo "<p>Tour not found.</p>";
    exit;
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Tour</title>
    
    <!-- swiper css link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/chitiettour.css?v=<?php echo time(); ?>" type="text/css">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="images/favicon-32x32.png" type="image/x-icon">
</head>
<body>
   <!-- Header Section Start -->
   <section class="header">
        <a style="text-decoration: none;" href="home.php" class="logo">Globetrotter.</a>

        <nav class="navbar">
            <a style="text-decoration: none;" href="home.php">Home</a>
            <a style="text-decoration: none;" href="about.php">About</a>
            <a style="text-decoration: none;" href="package.php">Package</a>
            <a style="text-decoration: none;" href="book.php">Book</a>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

        <div class="user-account">
            <div class="user-icon">
                <?php if (isset($_SESSION['username'])): ?>
                    <?php
                        // Kết nối cơ sở dữ liệu
                        $connection = mysqli_connect('localhost', 'root', '', 'tour_db');

                        // Kiểm tra kết nối
                        if (!$connection) {
                            die("Kết nối thất bại: " . mysqli_connect_error());
                        }

                        // Lấy ảnh đại diện từ cơ sở dữ liệu
                        $username = $_SESSION['username'];
                        $stmt = $connection->prepare("SELECT avatar FROM khachhang WHERE username = ?");
                        $stmt->bind_param("s", $username);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $avatar = $row['avatar']; // Đường dẫn tới ảnh đại diện
                        } else {
                            $avatar = ''; // Không có ảnh đại diện
                        }
                    ?>

                    <?php if (!empty($avatar) && file_exists('./uploads/'.$avatar)): ?>
                        <img src="<?php echo htmlspecialchars('./uploads/'.$avatar); ?>" alt="Avatar" class="avatar-img">
                        <span class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <?php else: ?>
                        <span class="fas fa-user"></span>
                        <span class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="fas fa-user"></span>
                    <span class="account-text">Tài Khoản</span>
                <?php endif; ?>
            </div>
            <div class="dropdown">
                <div class="dropdown-content">
                    <?php if (isset($_SESSION['username'])): ?>
                        <a class="profile" href="profile.php">Xem Thông Tin</a>
                        <a class="logout" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    <?php else: ?>
                        <a class="login-btn" href="login_form.php"><p style="margin-left: 24px">Đăng Nhập</p></a>
                        <div class="register-container">
                            <span>Chưa có tài khoản?</span>
                            <a href="register_form.php"><u>Đăng ký</u></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</head>
<body>
    
    <div class="containerCTT">
        <!-- Khung hình ảnh -->
        <div class="image-sectionCTT">
            <!-- <h2>Hình Ảnh Tour</h2> -->
            <img src="images/<?php echo htmlspecialchars($tour['HinhAnh']); ?>" alt="<?php echo htmlspecialchars($tour['TourName']); ?>" class="img-fluid">
        </div>

        <!-- Khung thông tin tour -->
        <div class="info-sectionCTT">
            <h2 class="title-tab">Thông Tin Tour</h2>
            <h1><?php echo htmlspecialchars($tour['TourName']); ?></h1>
                <div class="description">
                    <p><?php echo htmlspecialchars($tour['MoTa']); ?></p>
                </div>
                <div class="price">
                    <h3 class="price1"><strong>Giá vé trẻ em: </strong><?php echo number_format($tour['GiaVeTreEm'], 0, ',', '.'); ?> VNĐ</h3>
                    <h3 class="price2"><strong>Giá vé người lớn: </strong> <?php echo number_format($tour['GiaVeNguoiLon'], 0, ',', '.'); ?> VNĐ</h3>
                </div>
                <div class="additional-info">
                    <p><strong>Thời gian:</strong> <?php echo htmlspecialchars($tour['ThoiGianTour']); ?> ngày</p>
                    <p><strong>Ngày thêm:</strong> <?php echo htmlspecialchars(date("d/m/Y", strtotime($tour['NgayThem']))); ?></p>
                    <p><strong>Ngày bắt đầu:</strong> <?php echo htmlspecialchars(date("d/m/Y", strtotime($tour['NgayBatDau']))); ?></p>
                    <p><strong>Ngày kết thúc:</strong> <?php echo htmlspecialchars(date("d/m/Y", strtotime($tour['NgayKetThuc']))); ?></p>
                    <p><strong>Số chỗ trống:</strong> <?php echo htmlspecialchars($tour['SoCho']); ?></p>
                    <p><strong>Loại tour:</strong> <?php echo htmlspecialchars($tour['TenLoaiTour']); ?></p>
                    <p><strong>Khuyến mãi:</strong> <?php echo htmlspecialchars($tour['TenKhuyenMai'] ?? 'Không có khuyến mãi'); ?></p>
                    <a href="book.php">
                      <button >Đặt Vé</button>
                    </a>
                </div>
        </div>

        <!-- Khung mô tả lịch trình tour -->
        <div class="itinerary-sectionCTT">
        <h2 class="title-tab">Lịch Trình Tour</h2>
           <div class="schedule lt">
               <?php
                    // Các dòng muốn in đậm toàn bộ
                    $bold_lines_full = [1, 7]; // Ví dụ: Dòng 1 và 3 in đậm toàn bộ
        
                    // Các dòng muốn in đậm một số từ đầu tiên và số từ cần in đậm
                    $bold_lines_partial = [
                       2 => 2, // Dòng 2, in đậm 2 từ đầu
                       4 => 2, // Dòng 4, in đậm 2 từ đầu
                       5 => 1, // Dòng 5, in đậm 1 từ đầu
                       6 => 1, // Dòng 6, in đậm 1 từ đầu
                       8 => 2, // Dòng 8, in đậm 2 từ đầu
                       9 => 1, // Dòng 9, in đậm 1 từ đầu
                       11 => 2, // Dòng 11, in đậm 2 từ đầu
                       12 => 2  // Dòng 12, in đậm 2 từ đầu
                    ];

                    if ($result_lich_trinh->num_rows > 0) {
                       while ($row_lich_trinh = $result_lich_trinh->fetch_assoc()) {
                            $file_path = 'LichTrinh/' . $row_lich_trinh['FileLT'];
                            if (file_exists($file_path)) {
                                $file_lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                                echo "<pre>";
                                foreach ($file_lines as $index => $line) {
                                    // Kiểm tra nếu dòng cần in đậm toàn bộ
                                    if (in_array($index + 1, $bold_lines_full)) {
                                        // In đậm toàn bộ dòng với màu khác
                                        echo "<span class='highlight'>" . htmlspecialchars($line) . "</span><br>";
                                    } 
                                    // Kiểm tra nếu dòng cần in đậm một số từ đầu
                                    elseif (array_key_exists($index + 1, $bold_lines_partial)) {
                                        $bold_word_count = $bold_lines_partial[$index + 1]; // Số từ đầu cần in đậm
                                        $words = explode(" ", $line);
                            
                                        // Lấy một số từ đầu và in đậm chúng
                                        $bold_words = array_slice($words, 0, $bold_word_count);
                                        $bold_words = "<span class='highlight1'>" . implode(" ", $bold_words) . "</span>";
                            
                                        // Ghép lại với các từ còn lại trong dòng
                                        $remaining_words = implode(" ", array_slice($words, $bold_word_count));
                                        $formatted_line = $bold_words . " " . $remaining_words;
                            
                                        // In ra dòng đã được định dạng với màu sắc
                                        echo $formatted_line . "<br>";
                                    } 
                                    // Các dòng còn lại không in đậm
                                    else {
                                       echo htmlspecialchars($line) . "<br>";
                                    }
                                }
                                echo "</pre>";
                            } else {
                                echo "<p>Không tìm thấy lịch trình chi tiết.</p>";
                            }
                        }
                    } else {
                        echo "<p>Không có lịch trình cho tour này.</p>";
                    }
                 ?>
            </div>
        </div>

        <!-- Khung đánh giá -->
        <div class="review-sectionCTT">
            <h2>Đánh Giá Của Bạn</h2>
            <form action="submit_review.php" method="POST">
            <input type="hidden" name="TourID" value="<?php echo htmlspecialchars($TourID); ?>">
                <textarea name="NoiDung" rows="4" placeholder="Viết đánh giá tại đây..." required></textarea>
                <button type="submit">Gửi đánh giá</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

        