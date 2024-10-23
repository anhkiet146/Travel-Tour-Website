<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Globetrotter</title>

    <!-- swiper css link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="images/favicon-32x32.png" type="image/x-icon">

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
    <form action="search_tour.php" method="GET" class="search-form">
            <input type="text" name="noidi" placeholder="Nhập nơi bạn muốn đến">
            <button type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
    <!-- Home Section Start -->
    <section class="home">
        <div class="swiper home-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide" style="background-image:url(images/bg_images1909456.jpg)">
                    <div class="content">
                        <span>explore, discover, travel</span>
                        <h3>travel around the world</h3>
                    </div>
                </div>
    
                <div class="swiper-slide slide" style="background-image:url(images/bg_sapa.jpg)">
                    <div class="content">
                        <span>explore, discover, travel</span>
                        <h3>discover new places</h3>
                    </div>
                </div>
    
                <div class="swiper-slide slide" style="background-image:url(images/bg_KINH\ THANH\ HUE.jpg)">
                    <div class="content">
                        <span>explore, discover, travel</span>
                        <h3>make your tour worthwhile</h3>
                    </div>
                </div>
            </div>
        </div>

    </section>
    
    <!-- Home Section End -->
    <!-- Services Section Start-->
    <section class="services">
        <h1 class="heading-title"> our services </h1>
        <div class="box-container">
            <div class="box">
                <img src="images/icon-1.png" alt="">
                <h3>adventure</h3>
            </div>

            <div class="box">
                <img src="images/icon-2.png" alt="">
                <h3>tour guide</h3>
            </div>

            <div class="box">
                <img src="images/icon-3.png" alt="">
                <h3>balo</h3>
            </div>

            <div class="box">
                <img src="images/icon-4.png" alt="">
                <h3>camp fire</h3>
            </div>

            <div class="box">
                <img src="images/icon-5.png" alt="">
                <h3>journey</h3>
            </div>

            <div class="box">
                <img src="images/icon-6.png" alt="">
                <h3>homestay</h3>
            </div>
        </div>
    </section>
    <!-- Services Section End -->
    <!-- Home -> About Section Start -->
    <section class="home-about">
        <div class="image">
            <img src="images/about-sec1.png" alt="">
        </div>

        <div class="content">
            <h3>About Us</h3>
            <p style="text-align: justify;"><strong>"Du lịch không chỉ là một hành trình đến những nơi mới, mà còn là một cuộc phiêu lưu trong tâm hồn, nơi bạn tìm thấy bản thân và mở rộng tầm nhìn của mình."</strong> Đối với chúng tôi, mang đến một hành trình tuyệt vời cho khách hàng là yêu cầu và cũng là trách nhiệm.</p>
            <a href="about.php" class="btn">Read More</a>
        </div>
    </section>
    <!-- Home -> About Section End-->
    <!-- Home -> Package Section Start -->
    <?php
    // Kết nối cơ sở dữ liệu
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tour_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Truy vấn dữ liệu từ bảng tour, giới hạn 3 tour
    $sql = "SELECT TourID, TourName, HinhAnh, MoTa FROM tour LIMIT 3";
    $result = $conn->query($sql);

    ?>

    <section class="home-packages">
        <h1 class="heading-title">Our Packages</h1>
        <div class="box-container">
            <?php
            if ($result->num_rows > 0) {
                // Lặp qua từng kết quả và hiển thị
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="box">
                        <div class="image">
                            <img src="images/<?php echo $row['HinhAnh']; ?>" alt="">
                        </div>
                        <div class="content">
                            <h3><?php echo $row['TourName']; ?></h3>
                            <p><?php echo $row['MoTa']; ?></p>
                            <a href="chitiettour.php?tour_id=<?php echo $row['TourID']; ?>" class="btn">Book Now</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No tours available</p>";
            }
            ?>
        </div>
        <div class="load-more">
            <a href="package.php" class="btn">Load More</a>
        </div>
    </section>
    <!-- Home -> Package Section End -->
    <!-- Home -> Offer Section Start -->
    <section class="home-offer">
        <div class="content">
            <h3>up to 50% off</h3>
            <p>Hãy theo dõi và đón chờ những khuyến mãi cực khủng của chúng tôi.</p>
            <a href="book.php" class="btn">Book Now!</a>
        </div>
    </section>
    <!-- Home -> Offer Section End -->
    <!-- Footer Section start -->
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
    <script>
        var swiper = new Swiper('.home-slider', {
          loop: true, // Lặp lại các slide
          autoplay: {
            delay: 3000, // Thời gian giữa các lần chuyển (3000ms = 3 giây)
            disableOnInteraction: false, // Vẫn tiếp tục autoplay sau khi người dùng tương tác
          },
        });
      </script>
      
</body>
</html>
<?php
// Đóng kết nối
$conn->close();
?>
