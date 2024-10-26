-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2024 at 05:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tour_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `MaAD` varchar(30) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `PasswdHash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`MaAD`, `Username`, `PasswdHash`) VALUES
('AD01', 'Benald', '$2y$10$WcDUrtQt7lL70./hVR7c6umWOfRHg9roXQ/q3LhUgMjDLb925Hy3m');

-- --------------------------------------------------------

--
-- Table structure for table `danh_gia`
--

CREATE TABLE `danh_gia` (
  `MaKH` varchar(30) NOT NULL,
  `TourID` varchar(30) NOT NULL,
  `NgayDG` date DEFAULT NULL,
  `NoiDung` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diemden_tour`
--

CREATE TABLE `diemden_tour` (
  `MaDD` varchar(30) NOT NULL,
  `TourID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `diemden_tour`
--

INSERT INTO `diemden_tour` (`MaDD`, `TourID`) VALUES
('DDXF01', 'TITFT001');

-- --------------------------------------------------------

--
-- Table structure for table `diem_den`
--

CREATE TABLE `diem_den` (
  `MaDD` varchar(30) NOT NULL,
  `TenDD` varchar(100) NOT NULL,
  `HinhAnh` text DEFAULT NULL,
  `MoTa` text DEFAULT NULL,
  `ViTri` varchar(100) DEFAULT NULL,
  `SoNgay` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `diem_den`
--

INSERT INTO `diem_den` (`MaDD`, `TenDD`, `HinhAnh`, `MoTa`, `ViTri`, `SoNgay`) VALUES
('DDXF01', 'Hội An', 'pexels-phoco13830765.jpeg', 'Cổ kính và hoài niệm. Hãy thử một lần đắm chìm trong vẻ đẹp đó', 'Hạ lưu sông Thu Bồn, tỉnh Quảng Nam', 2);

-- --------------------------------------------------------

--
-- Table structure for table `diem_xuat_phat`
--

CREATE TABLE `diem_xuat_phat` (
  `MaDXP` varchar(30) NOT NULL,
  `TenDXP` varchar(100) NOT NULL,
  `DiaChi` text DEFAULT NULL,
  `MoTa` text DEFAULT NULL,
  `ThoiGianXP` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `diem_xuat_phat`
--

INSERT INTO `diem_xuat_phat` (`MaDXP`, `TenDXP`, `DiaChi`, `MoTa`, `ThoiGianXP`) VALUES
('DXPT01', 'Noi Bai Airport', 'Noi Bai, Hanoi', 'Main departure point', '07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hoa_don`
--

CREATE TABLE `hoa_don` (
  `MaHD` varchar(30) NOT NULL,
  `NgayTT` date NOT NULL,
  `TongTien` decimal(15,2) NOT NULL,
  `PhuongThuc` varchar(50) DEFAULT NULL,
  `MaBooking` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `huong_dan_vien`
--

CREATE TABLE `huong_dan_vien` (
  `MaHDV` varchar(30) NOT NULL,
  `TenHDV` varchar(100) NOT NULL,
  `KinhNghiem` text DEFAULT NULL,
  `SDT` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `huong_dan_vien`
--

INSERT INTO `huong_dan_vien` (`MaHDV`, `TenHDV`, `KinhNghiem`, `SDT`) VALUES
('HDT01', 'Nguyễn Tấn Minh Tiến', '5', '0981234567');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `makhach` varchar(30) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `ngaydangky` timestamp NOT NULL DEFAULT current_timestamp(),
  `avatar` varchar(255) DEFAULT NULL,
  `ngaysinh` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sodienthoai` varchar(15) DEFAULT NULL,
  `gioitinh` enum('Nam','Nữ','Others') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`makhach`, `hoten`, `username`, `matkhau`, `ngaydangky`, `avatar`, `ngaysinh`, `email`, `sodienthoai`, `gioitinh`) VALUES
('KHT01', 'Nguyễn Kiệt', 'kietou167', '$2y$10$oWjqPPNgn56XZFg/x2bMruP3uj1EnBqnhr89aTtH.lMrjvLcdcA/e', '2024-10-09 13:18:07', 'Anhkiet (1).jpg', '2024-10-25', 'anhkiet4624@gmail.com', '8459349029', 'Nam'),
('KHT02', 'Nguyễn Tấn Toàn Minh', 'ming', '$2y$10$8F2GpVqyncGHP9rYbrj37eH4XRbYC79qGsIVTJOoZK5KpEHA0Wum.', '2024-10-10 04:49:24', 'Screenshot 2024-04-16 112728.png', '0000-00-00', '', '', 'Nam'),
('KHT03', 'Chiêm Trường An', 'angrybirds', '$2y$10$uqUc3EYCQor2Ti.oGkVdg.J294xWnKSiUangc6PI8rjw7QP/ucPdm', '2024-10-16 10:11:38', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `khachsan_tour`
--

CREATE TABLE `khachsan_tour` (
  `MaLuuTru` varchar(30) NOT NULL,
  `TourID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `khachsan_tour`
--

INSERT INTO `khachsan_tour` (`MaLuuTru`, `TourID`) VALUES
('NLT01', 'TITFT001');

-- --------------------------------------------------------

--
-- Table structure for table `khach_san`
--

CREATE TABLE `khach_san` (
  `MaLuuTru` varchar(30) NOT NULL,
  `TenLuuTru` varchar(100) NOT NULL,
  `DiaChi` text DEFAULT NULL,
  `GiaMotDem` decimal(10,2) DEFAULT NULL,
  `Rating` decimal(2,1) DEFAULT NULL,
  `LoaiPhong` varchar(50) DEFAULT NULL,
  `SDT` varchar(15) DEFAULT NULL,
  `NgayO` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `khach_san`
--

INSERT INTO `khach_san` (`MaLuuTru`, `TenLuuTru`, `DiaChi`, `GiaMotDem`, `Rating`, `LoaiPhong`, `SDT`, `NgayO`) VALUES
('NLT01', 'Muong Thanh Holiday Hoi An Hotel', 'Lot 9, Phuoc Trach - Phuoc Hai New Residence Area, Au Co, Cửa Đại, Hội An, Việt Nam ', 900226.00, 4.5, 'Phòng Đôi', '0236789123', '2024-10-17');

-- --------------------------------------------------------

--
-- Table structure for table `khuyen_mai`
--

CREATE TABLE `khuyen_mai` (
  `MaKM` varchar(30) NOT NULL,
  `HanSuDung` date DEFAULT NULL,
  `TenKM` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lich_trinh_tour`
--

CREATE TABLE `lich_trinh_tour` (
  `MaLT` varchar(30) NOT NULL,
  `FileLT` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `lich_trinh_tour`
--

INSERT INTO `lich_trinh_tour` (`MaLT`, `FileLT`) VALUES
('LTT102', 'LT1_HOIAN.txt');

-- --------------------------------------------------------

--
-- Table structure for table `loai_tour`
--

CREATE TABLE `loai_tour` (
  `MaLoai` varchar(30) NOT NULL,
  `TenLoai` varchar(100) NOT NULL,
  `MoTa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `loai_tour`
--

INSERT INTO `loai_tour` (`MaLoai`, `TenLoai`, `MoTa`) VALUES
('LTT01', 'Gia đình', 'Phù hợp với các chuyến đi gia đình.');

-- --------------------------------------------------------

--
-- Table structure for table `phuong_tien_di_chuyen`
--

CREATE TABLE `phuong_tien_di_chuyen` (
  `MaPT` varchar(30) NOT NULL,
  `TenPT` varchar(100) NOT NULL,
  `MoTa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `phuong_tien_di_chuyen`
--

INSERT INTO `phuong_tien_di_chuyen` (`MaPT`, `TenPT`, `MoTa`) VALUES
('PTDCX01', 'Bus', 'Thoải mải và thuận tiện giúp chuyến đi càng thêm thú vị.');

-- --------------------------------------------------------

--
-- Table structure for table `ptdc_tour`
--

CREATE TABLE `ptdc_tour` (
  `MaPT` varchar(30) NOT NULL,
  `TourID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thong_tin_dat_tour`
--

CREATE TABLE `thong_tin_dat_tour` (
  `MaBooking` varchar(30) NOT NULL,
  `NgayDat` date NOT NULL,
  `TrangThai` varchar(50) DEFAULT NULL,
  `GhiChu` text DEFAULT NULL,
  `SoCho` int(11) DEFAULT NULL,
  `MaKH` varchar(30) DEFAULT NULL,
  `TourID` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE `tour` (
  `TourID` varchar(30) NOT NULL,
  `TourName` varchar(100) NOT NULL,
  `MoTa` text DEFAULT NULL,
  `GiaVeTreEm` decimal(10,2) DEFAULT NULL,
  `GiaVeNguoiLon` decimal(10,2) DEFAULT NULL,
  `ThoiGianTour` int(11) DEFAULT NULL,
  `NgayThem` timestamp NULL DEFAULT NULL,
  `NgayBatDau` date DEFAULT NULL,
  `NgayKetThuc` date DEFAULT NULL,
  `SoCho` int(11) DEFAULT NULL,
  `HinhAnh` text DEFAULT NULL,
  `MaAD` varchar(30) DEFAULT NULL,
  `MaLoai` varchar(30) DEFAULT NULL,
  `MaDXP` varchar(30) DEFAULT NULL,
  `MaKM` varchar(30) DEFAULT NULL,
  `MaHDV` varchar(30) DEFAULT NULL,
  `MaLT` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `tour`
--

INSERT INTO `tour` (`TourID`, `TourName`, `MoTa`, `GiaVeTreEm`, `GiaVeNguoiLon`, `ThoiGianTour`, `NgayThem`, `NgayBatDau`, `NgayKetThuc`, `SoCho`, `HinhAnh`, `MaAD`, `MaLoai`, `MaDXP`, `MaKM`, `MaHDV`, `MaLT`) VALUES
('TITFT001', 'Hội An', 'Cổ kính và hoài niệm. Hãy thử một lần đắm chìm trong vẻ đẹp đó', 3599999.00, 4899999.00, 2, '2024-10-01 17:00:00', '2024-10-21', '2024-10-23', 15, 'pexels-phoco13830765.jpeg', 'AD01', 'LTT01', 'DXPT01', NULL, 'HDT01', 'LTT102'),
('TITFT002', 'Hà Nội', 'Thủ đô nghìn năm văn hiến của Việt Nam, đẹp đẽ và cổ kính, mang vẻ đẹp của một Việt Nam đang phát triển.', 3499999.00, 5399999.00, 4, '2024-10-16 18:26:26', '2024-11-09', '2024-11-14', 15, 'hanoi.jpg', 'AD01', NULL, NULL, NULL, NULL, NULL),
('TITFT003', 'Đà Nẵng', 'Vẻ đẹp của thành phố đáng sống nhất Việt Nam và cố đô Huế trong một chuyến đi', 4799999.00, 6399999.00, 5, '2024-10-16 18:26:40', '2024-11-14', '2024-11-20', 12, 'bg_ba-na-hills.jpg', 'AD01', NULL, NULL, NULL, NULL, NULL),
('TITFT004', 'Ninh Bình', 'mota', 3599000.00, 5599000.00, 3, '2024-10-17 00:45:42', '2024-12-12', '2024-12-16', 10, 'travel-3344520_1280.jpg', 'AD01', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`MaAD`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD PRIMARY KEY (`MaKH`,`TourID`),
  ADD KEY `danh_gia_ibfk_2` (`TourID`);

--
-- Indexes for table `diemden_tour`
--
ALTER TABLE `diemden_tour`
  ADD PRIMARY KEY (`MaDD`,`TourID`),
  ADD KEY `diemden_tour_ibfk_2` (`TourID`);

--
-- Indexes for table `diem_den`
--
ALTER TABLE `diem_den`
  ADD PRIMARY KEY (`MaDD`);

--
-- Indexes for table `diem_xuat_phat`
--
ALTER TABLE `diem_xuat_phat`
  ADD PRIMARY KEY (`MaDXP`);

--
-- Indexes for table `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`MaHD`),
  ADD KEY `hoa_don_ibfk_1` (`MaBooking`);

--
-- Indexes for table `huong_dan_vien`
--
ALTER TABLE `huong_dan_vien`
  ADD PRIMARY KEY (`MaHDV`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`makhach`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- Indexes for table `khachsan_tour`
--
ALTER TABLE `khachsan_tour`
  ADD PRIMARY KEY (`MaLuuTru`,`TourID`),
  ADD KEY `khachsan_tour_ibfk_2` (`TourID`);

--
-- Indexes for table `khach_san`
--
ALTER TABLE `khach_san`
  ADD PRIMARY KEY (`MaLuuTru`);

--
-- Indexes for table `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  ADD PRIMARY KEY (`MaKM`);

--
-- Indexes for table `lich_trinh_tour`
--
ALTER TABLE `lich_trinh_tour`
  ADD PRIMARY KEY (`MaLT`);

--
-- Indexes for table `loai_tour`
--
ALTER TABLE `loai_tour`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Indexes for table `phuong_tien_di_chuyen`
--
ALTER TABLE `phuong_tien_di_chuyen`
  ADD PRIMARY KEY (`MaPT`);

--
-- Indexes for table `ptdc_tour`
--
ALTER TABLE `ptdc_tour`
  ADD PRIMARY KEY (`MaPT`,`TourID`),
  ADD KEY `ptdc_tour_ibfk_2` (`TourID`);

--
-- Indexes for table `thong_tin_dat_tour`
--
ALTER TABLE `thong_tin_dat_tour`
  ADD PRIMARY KEY (`MaBooking`),
  ADD KEY `thong_tin_dat_tour_ibfk_1` (`MaKH`),
  ADD KEY `thong_tin_dat_tour_ibfk_2` (`TourID`);

--
-- Indexes for table `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`TourID`),
  ADD KEY `tour_ibfk_1` (`MaAD`),
  ADD KEY `tour_ibfk_2` (`MaLoai`),
  ADD KEY `tour_ibfk_3` (`MaKM`),
  ADD KEY `tour_ibfk_4` (`MaDXP`),
  ADD KEY `MaHDV` (`MaHDV`),
  ADD KEY `MaLT` (`MaLT`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD CONSTRAINT `danh_gia_ibfk_1` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`makhach`),
  ADD CONSTRAINT `danh_gia_ibfk_2` FOREIGN KEY (`TourID`) REFERENCES `tour` (`TourID`);

--
-- Constraints for table `diemden_tour`
--
ALTER TABLE `diemden_tour`
  ADD CONSTRAINT `diemden_tour_ibfk_1` FOREIGN KEY (`MaDD`) REFERENCES `diem_den` (`MaDD`),
  ADD CONSTRAINT `diemden_tour_ibfk_2` FOREIGN KEY (`TourID`) REFERENCES `tour` (`TourID`);

--
-- Constraints for table `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD CONSTRAINT `hoa_don_ibfk_1` FOREIGN KEY (`MaBooking`) REFERENCES `thong_tin_dat_tour` (`MaBooking`);

--
-- Constraints for table `khachsan_tour`
--
ALTER TABLE `khachsan_tour`
  ADD CONSTRAINT `khachsan_tour_ibfk_1` FOREIGN KEY (`MaLuuTru`) REFERENCES `khach_san` (`MaLuuTru`),
  ADD CONSTRAINT `khachsan_tour_ibfk_2` FOREIGN KEY (`TourID`) REFERENCES `tour` (`TourID`);

--
-- Constraints for table `ptdc_tour`
--
ALTER TABLE `ptdc_tour`
  ADD CONSTRAINT `ptdc_tour_ibfk_1` FOREIGN KEY (`MaPT`) REFERENCES `phuong_tien_di_chuyen` (`MaPT`),
  ADD CONSTRAINT `ptdc_tour_ibfk_2` FOREIGN KEY (`TourID`) REFERENCES `tour` (`TourID`);

--
-- Constraints for table `thong_tin_dat_tour`
--
ALTER TABLE `thong_tin_dat_tour`
  ADD CONSTRAINT `thong_tin_dat_tour_ibfk_1` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`makhach`),
  ADD CONSTRAINT `thong_tin_dat_tour_ibfk_2` FOREIGN KEY (`TourID`) REFERENCES `tour` (`TourID`);

--
-- Constraints for table `tour`
--
ALTER TABLE `tour`
  ADD CONSTRAINT `tour_ibfk_1` FOREIGN KEY (`MaAD`) REFERENCES `admin` (`MaAD`),
  ADD CONSTRAINT `tour_ibfk_2` FOREIGN KEY (`MaLoai`) REFERENCES `loai_tour` (`MaLoai`),
  ADD CONSTRAINT `tour_ibfk_3` FOREIGN KEY (`MaKM`) REFERENCES `khuyen_mai` (`MaKM`),
  ADD CONSTRAINT `tour_ibfk_4` FOREIGN KEY (`MaDXP`) REFERENCES `diem_xuat_phat` (`MaDXP`),
  ADD CONSTRAINT `tour_ibfk_5` FOREIGN KEY (`MaHDV`) REFERENCES `huong_dan_vien` (`MaHDV`),
  ADD CONSTRAINT `tour_ibfk_6` FOREIGN KEY (`MaLT`) REFERENCES `lich_trinh_tour` (`MaLT`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
