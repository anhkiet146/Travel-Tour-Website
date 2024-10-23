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

class DiemDen
{
   private $conn;
   private $table_name = "diem_den";

   private $MaDD;
   private $TenDD;
   private $HinhAnh;
   private $MoTa;
   private $ViTri;
   private $SoNgay;

   public function __construct($db)
   {
      $this->conn = $db;
   }

   // Phương thức thêm nhiều điểm đến
   public function createMultipleDD($diemDenArray)
   {
      // Câu truy vấn chuẩn bị để chèn nhiều bản ghi
      $query = "INSERT INTO " . $this->table_name . " (MaDD, TenDD, HinhAnh, MoTa, ViTri, SoNgay) VALUES ";

      // Tạo các placeholders cho mỗi bản ghi
      $values = [];
      foreach ($diemDenArray as $diemDen) {
         $values[] = "(?, ?, ?, ?, ?, ?)";
      }

      // Nối các placeholders lại với nhau
      $query .= implode(", ", $values);

      // Chuẩn bị câu lệnh
      $stmt = $this->conn->prepare($query);

      // Ràng buộc dữ liệu cho tất cả các bản ghi
      $index = 1; // Dùng để xác định vị trí các placeholder
      foreach ($diemDenArray as $diemDen) {
         $stmt->bindValue($index++, $diemDen['MaDD']);
         $stmt->bindValue($index++, $diemDen['TenDD']);
         $stmt->bindValue($index++, $diemDen['HinhAnh']);
         $stmt->bindValue($index++, $diemDen['MoTa']);
         $stmt->bindValue($index++, $diemDen['ViTri']);
         $stmt->bindValue($index++, $diemDen['SoNgay']);
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
   $diem_den = new DiemDen($db);

   // Lấy dữ liệu từ form
   $diemDenArray = [];
   $MaDD = $_POST['MaDD'];
   $TenDD = $_POST['TenDD'];
   $HinhAnh = $_FILES['HinhAnhDD']['name'];
   $MoTa = $_POST['MoTaDD'];
   $ViTri = $_POST['ViTriDD'];
   $SoNgay = $_POST['SoNgay'];

   for ($i = 0; $i < count($MaDD); $i++) {
      $diemDenArray[] = [
         'MaDD' => $MaDD[$i],
         'TenDD' => $TenDD[$i],
         'HinhAnh' => $HinhAnh[$i],
         'MoTa' => $MoTa[$i],
         'ViTri' => $ViTri[$i],
         'SoNgay' => $SoNgay[$i]
      ];
   }

   // Gọi phương thức để thêm nhiều điểm đến
   if ($diem_den->createMultipleDD($diemDenArray)) {
      echo "<div>Thêm các Điểm Đến thành công!</div>";
   } else {
      echo "<div>Lỗi! Không thể thêm Điểm Đến.</div>";
   }
}

class HuongDanVien
{
   private $conn;
   private $table_name = "huong_dan_vien";

   private $MaHDV;
   private $TenHDV;
   private $KinhNghiem;
   private $SDTHDV;

   public function __construct($db)
   {
      $this->conn = $db;
   }

   // Getter cho MaDD
   public function getMaHDV()
   {
      return $this->MaHDV;
   }

   // Setter cho MaDD
   public function setMaHDV($MaHDV)
   {
      $this->MaHDV = $MaHDV;
   }

   // Getter cho TenHDV
   public function getTenHDV()
   {
      return $this->TenHDV;
   }

   // Setter cho TenHDV
   public function setTenHDV($TenHDV)
   {
      $this->TenHDV = $TenHDV;
   }

   // Getter cho HinhAnh
   public function getKinhNghiem()
   {
      return $this->KinhNghiem;
   }

   // Setter cho HinhAnh
   public function setKinhNghiem($KinhNghiem)
   {
      $this->KinhNghiem = $KinhNghiem;
   }

   // Getter cho MoTa
   public function getSDTHDV()
   {
      return $this->SDTHDV;
   }

   // Setter cho SDTHDV
   public function setSDTHDV($SDTHDV)
   {
      $this->SDTHDV = $SDTHDV;
   }

   // Phương thức thêm dữ liệu vào bảng
   public function createHDV()
   {
      $query = "INSERT INTO " . $this->table_name . " SET MaHDV=:MaHDV, TenHDV=:TenHDV, KinhNghiem=:KinhNghiem, SDT=:SDTHDV";

      $stmt = $this->conn->prepare($query);

      // Ràng buộc dữ liệu
      $stmt->bindParam(":MaHDV", $this->MaHDV);
      $stmt->bindParam(":TenHDV", $this->TenHDV);
      $stmt->bindParam(":KinhNghiem", $this->KinhNghiem);
      $stmt->bindParam(":SDTHDV", $this->SDTHDV);

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
   $huong_dan_vien = new HuongDanVien($db);

   // Gán giá trị cho các thuộc tính
   $huong_dan_vien->setMaHDV($_POST['MaHDV']);
   $huong_dan_vien->setTenHDV($_POST['TenHDV']);
   $huong_dan_vien->setKinhNghiem($_POST['KinhNghiem']);
   $huong_dan_vien->setSDTHDV($_POST['SDTHDV']);

   // Gọi phương thức tạo mới dữ liệu
   if ($huong_dan_vien->createHDV()) {
      echo "<div>Thêm Huong Dan Vien thành công!</div>";
   } else {
      echo "<div>Lỗi! Không thể thêm Huong Dan Vien. Vui lòng kiểm tra dữ liệu đầu vào hoặc thử lại sau.</div>";
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
      $index = 1; // Dùng để xác định vị trí các placeholder
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