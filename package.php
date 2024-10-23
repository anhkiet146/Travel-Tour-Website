<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>

    <!-- swiper css link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>" type="text/css">
</head>
<body>
    <!-- Header Section Start -->
    <section class="header">
        <a href="home.php" class="logo">Globetrotter.</a>

        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="package.php">Package</a>
            <a href="book.php">Book</a>
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
    <!-- Header Section End -->

    <div class="breadcrumb">
        <a href="home.php">Home</a> &gt; 
        <a href="about.php">Package</a>
    </div>
    
    <!-- Package Section Start-->
    <div class="heading" style="background: url(images/Tour.jpg) no-repeat">
        <h1>packages</h1>
    </div>

    <section class="packages">
        <h1 class="heading-title">Choose Your Trips</h1>
        <div class="box-container">
            <div class="box">
                <div class="image">
                    <img src="images/bg_ba-na-hills.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Đà Nẵng - Huế</h3>
                    <p>Vẻ đẹp của thành phố đáng sống nhất Việt Nam và cố đô Huế trong một chuyến đi</p>
                    <a href="book.php" class="btn">Book Now</a>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="images/bg_hagiang1.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Hà Giang</h3>
                    <p>Điểm cực tây của đất nước với những ngọn núi hùng vĩ là điều không thể bỏ qua.</p>
                    <a href="book.php" class="btn">Book Now</a>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="images/boats-2835848_1280.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Cần Thơ</h3>
                    <p>Tây đô của vùng Đồng Bằng sông Cửu Long, nổi tiếng với vẻ đẹp vừa truyền thống vừa hiện đại.</p>
                    <a href="book.php" class="btn">Book Now</a>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="images/vungtau.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Vũng Tàu</h3>
                    <p>Những bãi biển vô cùng xinh đẹp và trong xanh sẽ là lựa chọn tuyệt vời cho mùa hè này.</p>
                    <a href="book.php" class="btn">Book Now</a>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="images/hanoi.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Hà Nội</h3>
                    <p>Thủ đô nghìn năm văn hiến của Việt Nam, đẹp đẽ và cổ kính, mang vẻ đẹp của một Việt Nam đang phát triển.</p>
                    <a href="book.php" class="btn">Book Now</a>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="images/travel-3344520_1280.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Ninh Bình</h3>
                    <p>Rừng cây và cố đô, sông nước và núi non. Vẻ đẹp nơi đây là điều không thể bỏ lỡ.</p>
                    <a href="book.php" class="btn">Book Now</a>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="images/pexels-photo-28797295.webp" alt="">
                </div>
                <div class="content">
                    <h3>Tây Ninh</h3>
                    <p>Vùng đất níu chân người đi xa bằng vẻ đẹp tự nhiên và những con người thật thà, tình nghĩa.</p>
                    <a href="book.php" class="btn">Book Now</a>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="images/mountains-9017059_1280.webp" alt="">
                </div>
                <div class="content">
                    <h3>Yên Bái - Cao Bằng</h3>
                    <p>Tận mắt chứng kiến sự hùng vĩ của núi non và những cánh đồng lúa nước của người dân.</p>
                    <a href="book.php" class="btn">Book Now</a>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="images/city-6849761_1280.jpg" alt="">
                </div>
                <div class="content">
                    <h3>TP Hồ Chí Minh</h3>
                    <p>Hoa lệ, rộng lớn, đây là trung tâm kinh tế, văn hóa, du lịch hàng đầu Việt Nam</p>
                    <a href="book.php" class="btn">book now</a>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="images/vuon-quoc-gia-tram-chim-dong-thap-7-6617.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Đồng Tháp</h3>
                    <p>Vùng đất màu mở miền đồng bằng sông nước, được thiên nhiên ban tặng những cảnh vật thiên nhiên độc đáo.</p>
                    <a href="book.php" class="btn">Book Now</a>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="images/pexels-phoco13830765.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Hội An</h3>
                    <p>Một trung tâm giao lưu thương mại từ nhiều thế kỉ trước, vẫn giữ được vẻ đẹp cổ xưa và nhã nhặn.</p>
                    <a href="book.php" class="btn">Book Now</a>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="images/halong.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Quảng Ninh</h3>
                    <p>Đây là điều bạn không nên bỏ lỡ, Quảng Ninh có một vẻ đẹp thiên nhiên tuyệt vời và độc đáo</p>
                    <a href="book.php" class="btn">Book Now</a>
                </div>
            </div>

            
        </div>
        <div class="load-more">
                <span class="btn">Load More</a>
        </div>
    </section>
    <!-- Package Section End-->
    <!-- Footer Section Start -->
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>Quick links</h3>
                <a href="home.php"><i class="fas fa-angle-right"></i> Home</a>
                <a href="about.php"><i class="fas fa-angle-right"></i>About</a>
                <a href="package.php"><i class="fas fa-angle-right"></i>Package</a>
                <a href="book.php"><i class="fas fa-angle-right"></i>Book</a>
            </div>

            <div class="box">
                <h3>Extra links</h3>
                <a href="#"><i class="fas fa-angle-right"></i>ask questions</a>
                <a href="#"><i class="fas fa-angle-right"></i>about us</a>
                <a href="#"><i class="fas fa-angle-right"></i>privacy policy</a>
                <a href="#"><i class="fas fa-angle-right"></i>terms of use</a>
            </div>

            <div class="box">
                <h3>Contact info</h3>
                <a href="#"><i class="fas fa-phone"></i>+123-456-7890</a>
                <a href="#"><i class="fas fa-phone"></i>+111-222-3333</a>
                <a href="#"><i class="fas fa-envelope"></i>globetrotter@gmail.com</a>
                <a href="#"><i class="fas fa-map"></i>Ninh Kiều, Cần Thơ</a>
            </div>

            <div class="box">
                <h3>Follow us</h3>
                <a href="#"><i class="fab fa-facebook-f"></i>facebook</a>
                <a href="#"><i class="fab fa-twitter"></i>twitter</a>
                <a href="#"><i class="fab fa-instagram"></i>instagram</a>
                <a href="#"><i class="fab fa-linkedin"></i>linkedin</a>
            </div>
        </div>
    </section>
    <!-- Footer Section End -->
    <!-- swiper js link  -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <!-- custom js file link  -->
    <script type="text/javascript" src="js/script.js?v=<?php echo time();?>"></script>
</body>
</html>