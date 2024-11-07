<?php
// Database.php
class Database
{
   private $host = "localhost";
   private $db_name = "tour_db";
   private $username = "root";
   private $password = "";
   public $conn;

   public function getConnection()
   {
      $this->conn = null;
      try {
         $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
         $this->conn->exec("set names utf8");
      } catch (PDOException $exception) {
         echo "Connection error: " . $exception->getMessage();
      }

      return $this->conn;
   }
}

class KhachSan
{
   private $conn;
   private $table_name = "khach_san";

   private $MaLuuTru;
   private $TenLuuTru;
   private $DiaChi;
   private $GiaMotDem;
   private $Rating;
   private $LoaiPhong;
   private $SDT;
   private $NgayO;

   public function __construct($db)
   {
      $this->conn = $db;
   }

   // Phương thức thêm nhiều điểm đến
   public function createMultipleKS($khachSanArray)
   {
      // Câu truy vấn chuẩn bị để chèn nhiều bản ghi
      $query = "INSERT INTO " . $this->table_name . " (MaLuuTru, TenLuuTru, DiaChi, GiaMotDem, Rating, LoaiPhong, SDT, NgayO) VALUES ";

      // Tạo các placeholders cho mỗi bản ghi
      $values = [];
      foreach ($khachSanArray as $khachSan) {
         $values[] = "(?, ?, ?, ?, ?, ?, ?, ?)";
      }

      // Nối các placeholders lại với nhau
      $query .= implode(", ", $values);

      // Chuẩn bị câu lệnh
      $stmt = $this->conn->prepare($query);

      // Ràng buộc dữ liệu cho tất cả các bản ghi
      $index = 1;
      foreach ($khachSanArray as $khachSan) {
         $stmt->bindValue($index++, $khachSan['MaLuuTru']);
         $stmt->bindValue($index++, $khachSan['TenLuuTru']);
         $stmt->bindValue($index++, $khachSan['DiaChi']);
         $stmt->bindValue($index++, $khachSan['GiaMotDem']);
         $stmt->bindValue($index++, $khachSan['Rating']);
         $stmt->bindValue($index++, $khachSan['LoaiPhong']);
         $stmt->bindValue($index++, $khachSan['SDT']);
         $stmt->bindValue($index++, $khachSan['NgayO']);
      }

      // Thực thi câu lệnh
      if ($stmt->execute()) {
         return true;
      }
      return false;
   }
}

if ($_POST) {

   // Kết nối cơ sở dữ liệu
   $database = new Database();
   $db = $database->getConnection();

   // Tạo đối tượng DiemDen
   $khach_san = new KhachSan($db);

   // Lấy dữ liệu từ form
   $khachSanArray = [];
   $MaLuuTru = $_POST['MaLuuTru'];
   $TenLuuTru = $_POST['TenLuuTru'];
   $DiaChi = $_POST['DiaChi'];
   $GiaMotDem = $_POST['GiaMotDem'];
   $Rating = $_POST['Rating'];
   $LoaiPhong = $_POST['LoaiPhong'];
   $SDT = $_POST['SDT'];
   $NgayO = $_POST['NgayO'];

   for ($i = 0; $i < count($MaLuuTru); $i++) {
      $khachSanArray[] = [
         'MaLuuTru' => $MaLuuTru[$i],
         'TenLuuTru' => $TenLuuTru[$i],
         'DiaChi' => $DiaChi[$i],
         'GiaMotDem' => $GiaMotDem[$i],
         'Rating' => $Rating[$i],
         'LoaiPhong' => $LoaiPhong[$i],
         'SDT' => $SDT[$i],
         'NgayO' => $NgayO[$i]
      ];
   }

   // Gọi phương thức để thêm nhiều điểm đến
   if ($khach_san->createMultipleKS($khachSanArray)) {
      echo "<div>Thêm các Khach San thành công!</div>";
   } else {
      echo "<div>Lỗi! Không thể thêm Khach San.</div>";
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Tour</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
   <link rel="stylesheet" href="../admin-dashboard/css/bootstrap.css">
   <link rel="stylesheet" href="../admin-dashboard/css/style.css">
   <link rel="stylesheet" href="../admin-dashboard/css/dataTables.bootstrap5.min.css">
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
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                              <a href="../admin-dashboard/add-tour.php" class="nav-link px-3 active">
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
            <div style="font-weight: 500;" class="fs-3">Add Destination</div>
         </div>
         <nav class="mt-2 mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="../admin-dashboard/index.php">Home</a></li>
               <li class="breadcrumb-item active"> <a href="../admin-dashboard/add-tour.php">Add Tour</a></li>
               <li class="breadcrumb-item active" aria-current="page">Add Destination</li>
            </ol>
         </nav>

         <div class="latest-added mt-5">
            <div class="card border-0 shadow-sm">
               <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                     <!-- Khách sạn -->
                     <h3 class="mt-5">Thông tin khách sạn</h3>
                     <div id="hotelContainer">
                        <div class="row hotel-entry mb-3">
                           <h5 class="col-12">Khách sạn thứ 1</h5>
                           <div class="col-md-6 mb-3">
                              <label for="MaLuuTru[]" class="form-label">Mã Khách Sạn</label>
                              <input class="form-control" type="text" name="MaLuuTru[]" required>
                           </div>
                           <div class="col-md-6 mb-3">
                              <label for="TenLuuTru[]" class="form-label">Tên Khách Sạn</label>
                              <input class="form-control" type="text" name="TenLuuTru[]" required>
                           </div>
                           <div class="col-md-6 mb-3">
                              <label for="DiaChi[]" class="form-label">Địa chỉ</label>
                              <input class="form-control" type="text" name="DiaChi[]" required>
                           </div>
                           <div class="col-md-6 mb-3">
                              <label for="GiaMotDem[]" class="form-label">Giá Một Đêm</label>
                              <input class="form-control" type="number" step="0.01" name="GiaMotDem[]">
                           </div>
                           <div class="col-md-6 mb-3">
                              <label for="Rating[]" class="form-label">Đánh Giá</label>
                              <input class="form-control" type="number" step="0.1" name="Rating[]">
                           </div>
                           <div class="col-md-6 mb-3">
                              <label for="LoaiPhong[]" class="form-label">Loại Phòng</label>
                              <input class="form-control" type="text" name="LoaiPhong[]" required>
                           </div>
                           <div class="col-md-6 mb-3">
                              <label for="SDT[]" class="form-label">Số Điện Thoại</label>
                              <input class="form-control" type="text" name="SDT[]" required>
                           </div>
                           <div class="col-md-6 mb-3">
                              <label for="NgayO[]" class="form-label">Ngày Ở</label>
                              <input class="form-control" type="date" name="NgayO[]" required>
                           </div>
                        </div>
                     </div>
                     <button type="button" class="btn btn-secondary" id="addHotel">Thêm Khách Sạn +</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </main>
   <script src="../admin-dashboard/js/javascript.js"></script>
   <script src="../admin-dashboard/js/jquery-3.5.1.js"></script>
   <script src="../admin-dashboard/js/jquery.dataTables.min.js"></script>
   <script src="../admin-dashboard/js/dataTables.bootstrap5.min.js"></script>
   <script src="../admin-dashboard/js/bootstrap.bundle.min.js"></script>

</body>

</html>