<?php
    session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>

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
                            <a href="register_form.php"><strong>Đăng ký</strong></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <div class="breadcrumb">
        <a href="home.php">Home</a> &gt; 
        <a href="about.php">About</a>
    </div>

    <!-- Header Section End -->
    <!-- About Section Start-->
    <div class="heading" style="background: url(images/flowering-4841884_1280.jpg) no-repeat">
        <h1>About Us</h1>
    </div>
    <section class="about">
        <div class="image">
            <img src="images/why-choose-us-sign-on-white-background-vector-51497204.jpg" alt="">
        </div>

        <div class="content">
            <h3>why choose us?</h3>
            <p>Chúng tôi mang đến cho bạn những trải nghiệm du lịch độc đáo và đáng nhớ nhất. Với đội ngũ hướng dẫn viên chuyên nghiệp, am hiểu văn hóa địa phương, bạn sẽ được khám phá những điểm đến thú vị mà không nơi nào có. Chúng tôi cam kết cung cấp dịch vụ chất lượng cao với giá cả hợp lý, đảm bảo an toàn và tiện nghi cho mỗi hành trình.</p>
            <p>Ngoài ra, chúng tôi luôn lắng nghe và thấu hiểu nhu cầu của khách hàng, từ đó thiết kế những tour du lịch phù hợp nhất. Hãy cùng chúng tôi khám phá thế giới!.</p>
            <div class="icons-container">
                <div class="icon">
                    <i class="fas fa-map"></i>
                    <span>Top distnations</span>
                </div>

                <div class="icon">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>Affordable price</span>
                </div>

                <div class="icon" style="height: 120px;">
                    <i class="fas fa-headset"></i>
                    <span>24/7 services</span>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End-->

    <!-- Reviews Section Start -->
    <section class="reviews">
        <h1 class="heading-title">CO-FOUNDERS</h1>
        <div class="swiper reviews-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide">
                    <p></p>
                    <h3>Kiet</h3>
                    <img src="images/couser1.png" alt="">
                </div>

                <div class="swiper-slide slide">
                    <p></p>
                    <h3>Thang</h3>
                    <img src="images/couser1.png" alt="">
                </div>

                <div class="swiper-slide slide">
                    <p></p>
                    <h3>Thien</h3>
                    <img src="images/couser1.png" alt="">
                </div>

                <div class="swiper-slide slide">
                    <p></p>
                    <h3>Vinh</h3>
                    <img src="images/couser1.png" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- Reviews Section End -->
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