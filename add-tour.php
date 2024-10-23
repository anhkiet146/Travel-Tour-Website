<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kết nối cơ sở dữ liệu
    $connection = mysqli_connect('localhost', 'root', '', 'tour_db');

    // Kiểm tra kết nối
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Lấy thông tin từ biểu mẫu
    $tourName = $_POST['tour_name'];
    $moTa = $_POST['tour_desc'];
    $giaTreEm = $_POST['child_price'];
    $giaNguoiLon = $_POST['adult_price'];
    $thoiGian = $_POST['tour_duration'];
    $ngayBatDau = $_POST['start_date'];
    $ngayKetThuc = $_POST['end_date'];
    $soCho = $_POST['available_seats'];
    $hinhAnh = $_FILES['tour_image']['name'];
    $maLoai = $_POST['ma_loai'];
    $maKM = $_POST['ma_km'];
    $maAD = $_SESSION['username']; // Lấy username từ phiên đăng nhập

    // Xử lý tệp hình ảnh
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($hinhAnh);
    
    // Di chuyển tệp hình ảnh vào thư mục uploads
    if (!move_uploaded_file($_FILES['tour_image']['tmp_name'], $targetFile)) {
        die("Error uploading the image.");
    }

    // Sử dụng Prepared Statement để chèn dữ liệu vào bảng tour
    $stmtTour = $connection->prepare("INSERT INTO tour (TourID, TourName, MoTa, GiaVeTreEm, GiaVeNguoiLon, ThoiGianTour, NgayBatDau, NgayKetThuc, SoCho, HinhAnh, MaAD, MaLoai) VALUES (UUID(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmtTour->bind_param("ssddissssss", $tourName, $moTa, $giaTreEm, $giaNguoiLon, $thoiGian, $ngayBatDau, $ngayKetThuc, $soCho, $hinhAnh, $maAD, $maLoai);

    // Thực hiện truy vấn chèn vào bảng tour
    if ($stmtTour->execute()) {
        echo "New tour added successfully.";

        // Lấy TourID vừa chèn vào
        $tourID = $stmtTour->insert_id; // ID của tour vừa chèn

        // Thêm điểm đến
        if (isset($_POST['destination'])) {
            $destinations = $_POST['destination']; // Mảng chứa các điểm đến
            $destinationCodes = $_POST['destination_code']; // Mảng chứa mã điểm đến
            foreach ($destinations as $index => $destination) {
                if (!empty($destination) && !empty($destinationCodes[$index])) {
                    // Chèn vào bảng tour_diemden
                    $stmtDiemDen = $connection->prepare("INSERT INTO tour_diemden (TourID, MaDD, TenDD) VALUES (?, ?, ?)");
                    $stmtDiemDen->bind_param("iss", $tourID, $destinationCodes[$index], $destination);
                    if (!$stmtDiemDen->execute()) {
                        echo "Error adding destination: " . $stmtDiemDen->error;
                    }
                }
            }
        }

    } else {
        echo "Error: " . $stmtTour->error;
    }

    // Đóng statement và kết nối
    $stmtTour->close();
    mysqli_close($connection);
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand fw-bold" href="index.php">E-Tour</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto me-md-4 mb-2 mb-lg-0">
                    <li class="nav-item dropdown d-flex text-light">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-regular fa-user"></i> Admin
                        </a>
                        <ul class="dropdown-menu border-0 bg-light ms-auto">
                            <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                </ul>
                </li>
            </div>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- sidebar -->
    <div class="offcanvas offcanvas-start bg-purple text-white sidebar-nav" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header shadow-sm d-block text-center">
            <div class="offcanvas-title" id="offcanvasExampleLabel">
                <a class="navbar-brand fw-bold" href="index.php">E-Tour</a>
            </div>
        </div>
        <div class="offcanvas-body pt-3 p-0">
            <nav class="navbar-dark">
                <ul class="navbar-nav sidenav">
                    <li class="nav-link bordered px-3">
                        <a href="index.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link bordered px-3">
                        <a class="nav-link px-3 sidebar-link active" data-bs-toggle="collapse" href="#collapseExample"
                            role="button" aria-expanded="false" aria-controls="collapseExample">
                            <span class="me-2">
                                <i class="bi bi-people-fill"></i>
                            </span>
                            <span>Tours</span>
                            <span class="right-icon ms-auto">
                                <i class="bi bi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="collapse show" id="collapseExample">
                            <div>
                                <ul class="navbar-nav ps-3">
                                    <li>
                                        <a href="add-tour.php" class="nav-link px-3 active">
                                            <span class="me-2"><i class="bi bi-1-circle"></i></span>
                                            <span>Add Tour</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="all-tours.php" class="nav-link px-3">
                                            <span class="me-2"><i class="bi bi-2-circle"></i></span>
                                            <span>All Tours</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-link bordered px-3">
                        <a href="departments.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-intersect"></i></span>
                            <span>Departments</span>
                        </a>
                    </li>

                    <li class="nav-link bordered px-3">
                        <a href="programs.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-journal-text"></i></span>
                            <span>Program</span>
                        </a>
                    </li>
                    <li class="nav-link bordered px-3">
                        <a href="profile.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-person"></i></span>
                            <span>Profile</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- sidebar end -->

    <main class="mt-3 p-2">
    <div class="container">
        <div class="page-title">
            <div style="font-weight: 500;" class="fs-3">Add Tour</div>
        </div>
        <nav class="mt-2 mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Tour</li>
            </ol>
        </nav>

        <div class="latest-added mt-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="page-title fs-5 fw-bold mb-4">
                        Add New Tour
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <!-- Tour Name -->
                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="tour_name" class="form-label">Tour Name</label>
                                    <input class="form-control" placeholder="Tour Name" type="text" id="tour_name" name="tour_name" >
                                </div>
                            </div>
                            
                            <!-- MoTa -->
                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="tour_desc" class="form-label">Mô tả tour</label>
                                    <textarea class="form-control" id="tour_desc" name="tour_desc" placeholder="Tour Description" ></textarea>
                                </div>
                            </div>

                            <!-- TourID -->
                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="tour_id" class="form-label">Tour ID</label>
                                    <input class="form-control" placeholder="Tour ID" type="text" id="tour_id" name="tour_id" >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="ngay_bat_dau" class="form-label">Thời gian bắt đầu</label>
                                    <input class="form-control" type="date" id="ngay_bat_dau" name="ngay_bat_dau">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="ngay_ket_thuc" class="form-label">Thời gian kết thúc</label>
                                    <input class="form-control" type="date" id="ngay_ket_thuc" name="ngay_ket_thuc">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="so_cho" class="form-label">Số chỗ trống</label>
                                    <input class="form-control" type="number" id="so_cho" name="so_cho" >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="gia_ve_nguoi_lon" class="form-label">Giá vé người lớn</label>
                                    <input class="form-control" type="number" step="0.01" id="gia_ve_nguoi_lon" name="gia_ve_nguoi_lon" >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="gia_ve_tre_em" class="form-label">Giá vé trẻ em</label>
                                    <input class="form-control" type="number" step="0.01" id="gia_ve_tre_em" name="gia_ve_tre_em" >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="ngay_them" class="form-label">Ngày thêm</label>
                                    <input class="form-control" type="date" id="ngay_them" name="ngay_them">
                                </div>
                            </div>
                            
                            <!-- Điểm đến -->
                             <!-- Điểm đến -->
                             <div class="col-md-12">
                                <div class="mb-3 px-2">
                                    <label for="destination" class="form-label">Destinations</label>
                                    <div id="destination-container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input class="form-control mb-2" placeholder="Destination Code" type="text" name="destination_code[]" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control mb-2" placeholder="Destination" type="text" name="destination[]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary" id="add-destination">+</button>
                                </div>
                            </div>

                            <!-- Hình ảnh -->
                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="tour_image" class="form-label">Tour Image</label>
                                    <input class="form-control" type="file" id="tour_image" name="tour_image" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="mo_ta" class="form-label">Mô tả điểm đến</label>
                                    <textarea class="form-control" id="mo_ta" name="mo_ta" placeholder="Description"></textarea>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="vi_tri" class="form-label">Vị trí</label>
                                    <input class="form-control" placeholder="Location" type="text" id="vi_tri" name="vi_tri">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="so_ngay" class="form-label">Số ngày</label>
                                    <input class="form-control" placeholder="Number of Days" type="number" id="so_ngay" name="so_ngay">
                                </div>
                            </div>

                            <!-- Dia Diem Xuat Phat -->
                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="diem_xuat_phat_id" class="form-label">Mã điểm xuất phát</label>
                                    <input class="form-control" placeholder="Departure Location ID" type="text" id="diem_xuat_phat_id" name="diem_xuat_phat_id" >
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="ten_dxp" class="form-label">Tên điểm xuất phát</label>
                                    <input class="form-control" placeholder="Departure Name" type="text" id="ten_dxp" name="ten_dxp" >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="dia_chi" class="form-label">Địa chỉ</label>
                                    <textarea class="form-control" id="dia_chi" name="dia_chi" placeholder="Address"></textarea>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="mo_ta_dxp" class="form-label">Mô tả điểm xuất phát</label>
                                    <textarea class="form-control" id="mo_ta_dxp" name="mo_ta_dxp" placeholder="Description"></textarea>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="thoi_gian_xp" class="form-label">Thời gian xuất phát</label>
                                    <input class="form-control" type="time" id="thoi_gian_xp" name="thoi_gian_xp">
                                </div>
                            </div>

                            <!-- Huong Dan Vien -->
                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="huong_dan_vien_id" class="form-label">Mã hướng dẫn viên</label>
                                    <input class="form-control" placeholder="Guide ID" type="text" id="huong_dan_vien_id" name="huong_dan_vien_id" >
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="ten_hdv" class="form-label">Tên hướng dẫn viên</label>
                                    <input class="form-control" placeholder="Guide Name" type="text" id="ten_hdv" name="ten_hdv" >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="kinh_nghiem" class="form-label">Kinh nghiệm</label>
                                    <textarea class="form-control" id="kinh_nghiem" name="kinh_nghiem" placeholder="Experience"></textarea>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="sdt_hdv" class="form-label">Số điện thoại</label>
                                    <input class="form-control" placeholder="Phone Number" type="text" id="sdt_hdv" name="sdt_hdv">
                                </div>
                            </div>

                            <!-- Khach San -->
                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="khach_san_id" class="form-label">Mã khách sạn</label>
                                    <input class="form-control" placeholder="Hotel ID" type="text" id="khach_san_id" name="khach_san_id" >
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="ten_luu_tru" class="form-label">Tên khách sạn</label>
                                    <input class="form-control" placeholder="Hotel Name" type="text" id="ten_luu_tru" name="ten_luu_tru" >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="dia_chi_khach_san" class="form-label">Địa chỉ khách sạn</label>
                                    <textarea class="form-control" id="dia_chi_khach_san" name="dia_chi_khach_san" placeholder="Hotel Address"></textarea>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="gia_mot_dem" class="form-label">Giá một đêm</label>
                                    <input class="form-control" placeholder="Price" type="number" step="0.01" id="gia_mot_dem" name="gia_mot_dem">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 px-2">
                                    <label for="rating" class="form-label">Rating</label>
                                    <input class="form-control" placeholder="Rating" type="number" step="0.1" min="0" max="5" id="rating" name="rating">
                                </div>
                            </div>
                        </div> 
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Add Tour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>


    <!-- main content end-->

    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap5.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/javascript.js"></script>
</body>

</html>