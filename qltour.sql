-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2024 at 04:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qltour`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `MaAD` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `PasswdHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `danh_gia`
--

CREATE TABLE `danh_gia` (
  `MaKH` int(11) NOT NULL,
  `TourID` int(11) NOT NULL,
  `NgayDG` date DEFAULT NULL,
  `NoiDung` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------


--
-- Table structure for table `diem_den`
--

CREATE TABLE `diem_den` (
  `MaDD` int(11) NOT NULL,
  `TenDD` varchar(100) NOT NULL,
  `HinhAnh` text DEFAULT NULL,
  `MoTa` text DEFAULT NULL,
  `ViTri` varchar(100) DEFAULT NULL,
  `SoNgay` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diemden_tour`
--

CREATE TABLE `diemden_tour` (
  `MaDD` int(11) NOT NULL,
  `TourID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diem_xuat_phat`
--

CREATE TABLE `diem_xuat_phat` (
  `MaDXP` int(11) NOT NULL,
  `TenDXP` varchar(100) NOT NULL,
  `DiaChi` text DEFAULT NULL,
  `MoTa` text DEFAULT NULL,
  `ThoiGianXP` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hdv_tour`
--

CREATE TABLE `hdv_tour` (
  `MaHDV` int(11) NOT NULL,
  `TourID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoa_don`
--

CREATE TABLE `hoa_don` (
  `MaHD` int(11) NOT NULL,
  `NgayTT` date NOT NULL,
  `TongTien` decimal(15,2) NOT NULL,
  `PhuongThuc` varchar(50) DEFAULT NULL,
  `MaBooking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `huong_dan_vien`
--

CREATE TABLE `huong_dan_vien` (
  `MaHDV` int(11) NOT NULL,
  `TenHDV` varchar(100) NOT NULL,
  `KinhNghiem` text DEFAULT NULL,
  `SDT` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khachsan_tour`
--

CREATE TABLE `khachsan_tour` (
  `MaLuuTru` int(11) NOT NULL,
  `TourID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khach_hang`
--

CREATE TABLE `khachhang` (
  `makhach` int(11) NOT NULL,
  `HoTen` varchar(100) NOT NULL,
  `NgaySinh` date DEFAULT NULL,
  `DiaChi` text DEFAULT NULL,
  `SDT` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Username` varchar(50) NOT NULL,
  `PasswdHash` varchar(255) NOT NULL,
  `NgayTao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khach_san`
--

CREATE TABLE `khach_san` (
  `MaLuuTru` int(11) NOT NULL,
  `TenLuuTru` varchar(100) NOT NULL,
  `DiaChi` text DEFAULT NULL,
  `GiaMotDem` decimal(10,2) DEFAULT NULL,
  `Rating` decimal(2,1) DEFAULT NULL,
  `LoaiPhong` varchar(50) DEFAULT NULL,
  `SDT` varchar(15) DEFAULT NULL,
  `NgayO` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khuyen_mai`
--

CREATE TABLE `khuyen_mai` (
  `MaKM` int(11) NOT NULL,
  `HanSuDung` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lich_trinh_tour`
--

CREATE TABLE `lich_trinh_tour` (
  `MaLT` int(11) NOT NULL,
  `FileLT` text DEFAULT NULL,
  `TourID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loai_tour`
--

CREATE TABLE `loai_tour` (
  `MaLoai` int(11) NOT NULL,
  `TenLoai` varchar(100) NOT NULL,
  `MoTa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phuong_tien_di_chuyen`
--

CREATE TABLE `phuong_tien_di_chuyen` (
  `MaPT` int(11) NOT NULL,
  `TenPT` varchar(100) NOT NULL,
  `MoTa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ptdc_tour`
--

CREATE TABLE `ptdc_tour` (
  `MaPT` int(11) NOT NULL,
  `TourID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thong_tin_dat_tour`
--

CREATE TABLE `thong_tin_dat_tour` (
  `MaBooking` int(11) NOT NULL,
  `NgayDat` date NOT NULL,
  `TrangThai` varchar(50) DEFAULT NULL,
  `GhiChu` text DEFAULT NULL,
  `SoCho` int(11) DEFAULT NULL,
  `MaKH` int(11) DEFAULT NULL,
  `TourID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE `tour` (
  `TourID` int(11) NOT NULL,
  `TourName` varchar(100) NOT NULL,
  `MoTa` text DEFAULT NULL,
  `GiaVeTheoTuoi` decimal(10,2) DEFAULT NULL,
  `ThoiGianTour` int(11) DEFAULT NULL,
  `NgayThem` date DEFAULT NULL,
  `NgayBatDau` date DEFAULT NULL,
  `NgayKetThuc` date DEFAULT NULL,
  `SoCho` int(11) DEFAULT NULL,
  `HinhAnh` text DEFAULT NULL,
  `MaAD` int(11) DEFAULT NULL,
  `MaLoai` int(11) DEFAULT NULL,
  `MaKM` int(11) DEFAULT NULL,
  `MaDXP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`MaAD`);

--
-- Indexes for table `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD PRIMARY KEY (`MaKH`,`TourID`),
  ADD KEY `TourID` (`TourID`);

--
-- Indexes for table `diemden_tour`
--
ALTER TABLE `diemden_tour`
  ADD PRIMARY KEY (`MaDD`,`TourID`),
  ADD KEY `TourID` (`TourID`);

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
-- Indexes for table `hdv_tour`
--
ALTER TABLE `hdv_tour`
  ADD PRIMARY KEY (`MaHDV`,`TourID`),
  ADD KEY `TourID` (`TourID`);

--
-- Indexes for table `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`MaHD`)
  ADD KEY `MaBooking` (`MaBooking`);

--
-- Indexes for table `huong_dan_vien`
--
ALTER TABLE `huong_dan_vien`
  ADD PRIMARY KEY (`MaHDV`);

--
-- Indexes for table `khachsan_tour`
--
ALTER TABLE `khachsan_tour`
  ADD PRIMARY KEY (`MaLuuTru`,`TourID`),
  ADD KEY `TourID` (`TourID`);

--
-- Indexes for table `khach_hang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`makhach`);

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
  ADD PRIMARY KEY (`MaLT`),
  ADD KEY `TourID` (`TourID`);

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
  ADD KEY `TourID` (`TourID`);

--
-- Indexes for table `thong_tin_dat_tour`
--
ALTER TABLE `thong_tin_dat_tour`
  ADD PRIMARY KEY (`MaBooking`),
  ADD KEY `MaKH` (`MaKH`),
  ADD KEY `TourID` (`TourID`);

--
-- Indexes for table `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`TourID`),
  ADD KEY `MaAD` (`MaAD`),
  ADD KEY `MaLoai` (`MaLoai`),
  ADD KEY `MaKM` (`MaKM`),
  ADD KEY `MaDXP` (`MaDXP`);

--
-- Constraints for dumped tables
--
ALTER TABLE `hoa_don`
ADD CONSTRAINT `hoa_don_ibfk_1` FOREIGN KEY (`MaBooking`) REFERENCES `thong_tin_dat_tour` (`MaBooking`);

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
-- Constraints for table `hdv_tour`
--
ALTER TABLE `hdv_tour`
  ADD CONSTRAINT `hdv_tour_ibfk_1` FOREIGN KEY (`MaHDV`) REFERENCES `huong_dan_vien` (`MaHDV`),
  ADD CONSTRAINT `hdv_tour_ibfk_2` FOREIGN KEY (`TourID`) REFERENCES `tour` (`TourID`);

--
-- Constraints for table `khachsan_tour`
--
ALTER TABLE `khachsan_tour`
  ADD CONSTRAINT `khachsan_tour_ibfk_1` FOREIGN KEY (`MaLuuTru`) REFERENCES `khach_san` (`MaLuuTru`),
  ADD CONSTRAINT `khachsan_tour_ibfk_2` FOREIGN KEY (`TourID`) REFERENCES `tour` (`TourID`);

--
-- Constraints for table `lich_trinh_tour`
--
ALTER TABLE `lich_trinh_tour`
  ADD CONSTRAINT `lich_trinh_tour_ibfk_1` FOREIGN KEY (`TourID`) REFERENCES `tour` (`TourID`);

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
  ADD CONSTRAINT `tour_ibfk_4` FOREIGN KEY (`MaDXP`) REFERENCES `diem_xuat_phat` (`MaDXP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
