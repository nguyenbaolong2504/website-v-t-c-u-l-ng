-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 01, 2026 lúc 12:28 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_banhang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `MaDonHang` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `TenSP` varchar(255) DEFAULT NULL,
  `HinhAnh` varchar(255) DEFAULT NULL,
  `SoLuong` int(11) DEFAULT NULL CHECK (`SoLuong` > 0),
  `DonGia` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`MaDonHang`, `MaSP`, `TenSP`, `HinhAnh`, `SoLuong`, `DonGia`) VALUES
(31, 27, NULL, NULL, 1, 980000.00),
(31, 32, NULL, NULL, 1, 3800000.00),
(31, 41, NULL, NULL, 1, 1000000.00),
(32, 17, NULL, NULL, 1, 1200000.00),
(32, 20, NULL, NULL, 4, 550000.00),
(32, 26, NULL, NULL, 1, 1200000.00),
(1001, 101, NULL, NULL, 1, 2500000.00),
(1002, 102, NULL, NULL, 1, 1800000.00),
(1002, 103, NULL, NULL, 1, 1200000.00),
(1003, 104, NULL, NULL, 1, 150000.00),
(1004, 102, NULL, NULL, 1, 1800000.00),
(1006, 101, NULL, NULL, 2, 2500000.00),
(1007, 103, NULL, NULL, 4, 1200000.00),
(2001, 102, NULL, NULL, 1, 200000.00),
(2002, 103, NULL, NULL, 1, 1200000.00),
(2003, 102, NULL, NULL, 1, 700000.00),
(2004, 103, NULL, NULL, 1, 200000.00),
(2005, 104, NULL, NULL, 1, 500000.00),
(2006, 101, NULL, NULL, 1, 700000.00),
(2007, 101, NULL, NULL, 1, 700000.00),
(2008, 104, NULL, NULL, 1, 1500000.00),
(2009, 102, NULL, NULL, 1, 1500000.00),
(2010, 104, NULL, NULL, 1, 1800000.00),
(2011, 102, NULL, NULL, 1, 1000000.00),
(2012, 102, NULL, NULL, 1, 1700000.00),
(2013, 103, NULL, NULL, 1, 900000.00),
(2014, 102, NULL, NULL, 1, 300000.00),
(2015, 104, NULL, NULL, 1, 900000.00),
(2016, 103, NULL, NULL, 1, 400000.00),
(2017, 104, NULL, NULL, 1, 700000.00),
(2018, 102, NULL, NULL, 1, 600000.00),
(2019, 101, NULL, NULL, 1, 300000.00),
(2020, 102, NULL, NULL, 1, 200000.00),
(2021, 101, NULL, NULL, 1, 10000000.00),
(2022, 102, NULL, NULL, 1, 1100000.00),
(2023, 101, NULL, NULL, 1, 900000.00),
(2024, 101, NULL, NULL, 1, 900000.00),
(2025, 103, NULL, NULL, 1, 1700000.00),
(2026, 104, NULL, NULL, 1, 10000000.00),
(2027, 103, NULL, NULL, 1, 200000.00),
(2028, 102, NULL, NULL, 1, 1400000.00),
(2029, 102, NULL, NULL, 1, 1000000.00),
(2030, 101, NULL, NULL, 1, 300000.00),
(2031, 104, NULL, NULL, 1, 1500000.00),
(2032, 104, NULL, NULL, 1, 700000.00),
(2033, 102, NULL, NULL, 1, 500000.00),
(2034, 104, NULL, NULL, 1, 900000.00),
(2035, 103, NULL, NULL, 1, 300000.00),
(2036, 103, NULL, NULL, 1, 800000.00),
(2037, 104, NULL, NULL, 1, 1200000.00),
(2038, 101, NULL, NULL, 1, 800000.00),
(2039, 104, NULL, NULL, 1, 1800000.00),
(2040, 101, NULL, NULL, 1, 1300000.00),
(2041, 101, NULL, NULL, 1, 1900000.00),
(2042, 102, NULL, NULL, 1, 7500000.00),
(2043, 104, NULL, NULL, 1, 1700000.00),
(2044, 104, NULL, NULL, 1, 1200000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietgiohang`
--

CREATE TABLE `chitietgiohang` (
  `MaGioHang` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuong` int(11) DEFAULT NULL CHECK (`SoLuong` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietkho`
--

CREATE TABLE `chitietkho` (
  `MaKho` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuongTon` int(11) DEFAULT NULL CHECK (`SoLuongTon` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietphieunhap`
--

CREATE TABLE `chitietphieunhap` (
  `MaPhieuNhap` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuongNhap` int(11) DEFAULT NULL CHECK (`SoLuongNhap` > 0),
  `DonGiaNhap` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietphieunhap`
--

INSERT INTO `chitietphieunhap` (`MaPhieuNhap`, `MaSP`, `SoLuongNhap`, `DonGiaNhap`) VALUES
(1, 1, 10, 3800000.00),
(1, 4, 20, 1500000.00),
(2, 2, 15, 2800000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgia`
--

CREATE TABLE `danhgia` (
  `MaDanhGia` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `MaKH` int(11) NOT NULL,
  `SoSao` int(11) DEFAULT NULL CHECK (`SoSao` between 1 and 5),
  `NoiDung` text DEFAULT NULL,
  `NgayDanhGia` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `MaDanhMuc` int(11) NOT NULL,
  `TenDanhMuc` varchar(100) NOT NULL,
  `MoTa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`MaDanhMuc`, `TenDanhMuc`, `MoTa`) VALUES
(1, 'Vợt cầu lông', 'Các loại vợt thi đấu và phong trào'),
(2, 'Giày cầu lông', 'Giày chuyên dụng cầu lông'),
(3, 'Bao vợt', 'Bao đựng vợt cầu lông'),
(4, 'Quần áo cầu lông', 'Trang phục thi đấu cầu lông');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `MaDonHang` int(11) NOT NULL,
  `MaKH` int(11) DEFAULT NULL,
  `TenKH` varchar(255) DEFAULT NULL,
  `SDT` varchar(20) DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `NgayDat` datetime DEFAULT current_timestamp(),
  `TongTien` decimal(12,2) DEFAULT NULL,
  `PhuongThucTT` varchar(50) DEFAULT 'cod',
  `GhiChu` text DEFAULT NULL,
  `TrangThai` varchar(50) DEFAULT 'ChoDuyet',
  `MaVoucher` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`MaDonHang`, `MaKH`, `TenKH`, `SDT`, `DiaChi`, `Email`, `NgayDat`, `TongTien`, `PhuongThucTT`, `GhiChu`, `TrangThai`, `MaVoucher`) VALUES
(31, 2, 'nguyen  hoang anh', '0865997683', '36, hong van, ha noi', '20230828@eaut.edu.vn', '2026-02-01 06:15:16', 5610000.00, 'momo', 'kcj', 'DaThanhToan', NULL),
(32, 2, 'nguyen  le loi', '0848473321', 'ra, ra, ar', '20230828@eaut.edu.vn', '2026-02-01 06:17:10', 3250000.00, 'cod', 'nnnn', 'DangGiao', NULL),
(1001, 1, 'Nguyen Van A', '0909123456', 'Ha Noi', NULL, '2026-02-01 06:19:20', 2500000.00, 'momo', NULL, 'DaGiao', NULL),
(1002, 1, 'Tran Van B', '0909123457', 'HCM', NULL, '2026-02-01 06:19:20', 3200000.00, 'momo', NULL, 'DaThanhToan', NULL),
(1003, 1, 'Le Thi C', '0909123458', 'Da Nang', NULL, '2026-01-31 06:19:20', 150000.00, 'cod', NULL, 'DaGiao', NULL),
(1004, 1, 'Pham Van D', '0909123459', 'Can Tho', NULL, '2026-01-29 06:19:20', 1800000.00, 'cod', NULL, 'DaGiao', NULL),
(1005, 1, 'Khach Huy Don', '0909000000', 'Hue', NULL, '2026-01-28 06:19:20', 5000000.00, 'cod', NULL, 'Huy', NULL),
(1006, 1, 'Dai Gia A', '0912345678', 'Ha Noi', NULL, '2026-01-27 06:19:20', 5000000.00, 'momo', NULL, 'DaGiao', NULL),
(1007, 1, 'Dai Gia B', '0912345679', 'Ha Noi', NULL, '2026-01-27 06:19:20', 5000000.00, 'momo', NULL, 'DaThanhToan', NULL),
(1008, 1, 'Khach Dang Cho', '0988888888', 'Hai Phong', NULL, '2026-01-26 06:19:20', 2000000.00, 'cod', NULL, 'DangGiao', NULL),
(2001, 1, 'Khach Test 2001', '09090002001', 'Dia Chi Test', NULL, '2026-01-01 00:00:00', 200000.00, 'momo', NULL, 'DaGiao', NULL),
(2002, 1, 'Khach Test 2002', '09090002002', 'Dia Chi Test', NULL, '2026-01-02 00:00:00', 1200000.00, 'momo', NULL, 'Huy', NULL),
(2003, 1, 'Khach Test 2003', '09090002003', 'Dia Chi Test', NULL, '2026-01-02 00:00:00', 700000.00, 'momo', NULL, 'DaGiao', NULL),
(2004, 1, 'Khach Test 2004', '09090002004', 'Dia Chi Test', NULL, '2026-01-02 00:00:00', 200000.00, 'momo', NULL, 'DaGiao', NULL),
(2005, 1, 'Khach Test 2005', '09090002005', 'Dia Chi Test', NULL, '2026-01-03 00:00:00', 500000.00, 'momo', NULL, 'DaThanhToan', NULL),
(2006, 1, 'Khach Test 2006', '09090002006', 'Dia Chi Test', NULL, '2026-01-03 00:00:00', 700000.00, 'momo', NULL, 'Huy', NULL),
(2007, 1, 'Khach Test 2007', '09090002007', 'Dia Chi Test', NULL, '2026-01-04 00:00:00', 700000.00, 'momo', NULL, 'DaGiao', NULL),
(2008, 1, 'Khach Test 2008', '09090002008', 'Dia Chi Test', NULL, '2026-01-04 00:00:00', 1500000.00, 'momo', NULL, 'DaGiao', NULL),
(2009, 1, 'Khach Test 2009', '09090002009', 'Dia Chi Test', NULL, '2026-01-05 00:00:00', 1500000.00, 'momo', NULL, 'DaThanhToan', NULL),
(2010, 1, 'Khach Test 2010', '09090002010', 'Dia Chi Test', NULL, '2026-01-07 00:00:00', 1800000.00, 'momo', NULL, 'DaGiao', NULL),
(2011, 1, 'Khach Test 2011', '09090002011', 'Dia Chi Test', NULL, '2026-01-08 00:00:00', 1000000.00, 'momo', NULL, 'DaGiao', NULL),
(2012, 1, 'Khach Test 2012', '09090002012', 'Dia Chi Test', NULL, '2026-01-09 00:00:00', 1700000.00, 'momo', NULL, 'DaGiao', NULL),
(2013, 1, 'Khach Test 2013', '09090002013', 'Dia Chi Test', NULL, '2026-01-11 00:00:00', 900000.00, 'momo', NULL, 'DaGiao', NULL),
(2014, 1, 'Khach Test 2014', '09090002014', 'Dia Chi Test', NULL, '2026-01-11 00:00:00', 300000.00, 'momo', NULL, 'DaGiao', NULL),
(2015, 1, 'Khach Test 2015', '09090002015', 'Dia Chi Test', NULL, '2026-01-12 00:00:00', 900000.00, 'momo', NULL, 'DaGiao', NULL),
(2016, 1, 'Khach Test 2016', '09090002016', 'Dia Chi Test', NULL, '2026-01-14 00:00:00', 400000.00, 'momo', NULL, 'DaThanhToan', NULL),
(2017, 1, 'Khach Test 2017', '09090002017', 'Dia Chi Test', NULL, '2026-01-18 00:00:00', 700000.00, 'momo', NULL, 'DaGiao', NULL),
(2018, 1, 'Khach Test 2018', '09090002018', 'Dia Chi Test', NULL, '2026-01-18 00:00:00', 600000.00, 'momo', NULL, 'DaGiao', NULL),
(2019, 1, 'Khach Test 2019', '09090002019', 'Dia Chi Test', NULL, '2026-01-19 00:00:00', 300000.00, 'momo', NULL, 'DaGiao', NULL),
(2020, 1, 'Khach Test 2020', '09090002020', 'Dia Chi Test', NULL, '2026-01-19 00:00:00', 200000.00, 'momo', NULL, 'Huy', NULL),
(2021, 1, 'Khach Test 2021', '09090002021', 'Dia Chi Test', NULL, '2026-01-19 00:00:00', 10000000.00, 'momo', NULL, 'DaGiao', NULL),
(2022, 1, 'Khach Test 2022', '09090002022', 'Dia Chi Test', NULL, '2026-01-21 00:00:00', 1100000.00, 'momo', NULL, 'DaGiao', NULL),
(2023, 1, 'Khach Test 2023', '09090002023', 'Dia Chi Test', NULL, '2026-01-21 00:00:00', 900000.00, 'momo', NULL, 'DaGiao', NULL),
(2024, 1, 'Khach Test 2024', '09090002024', 'Dia Chi Test', NULL, '2026-01-21 00:00:00', 900000.00, 'momo', NULL, 'DaGiao', NULL),
(2025, 1, 'Khach Test 2025', '09090002025', 'Dia Chi Test', NULL, '2026-01-22 00:00:00', 1700000.00, 'momo', NULL, 'DaGiao', NULL),
(2026, 1, 'Khach Test 2026', '09090002026', 'Dia Chi Test', NULL, '2026-01-22 00:00:00', 10000000.00, 'momo', NULL, 'DaGiao', NULL),
(2027, 1, 'Khach Test 2027', '09090002027', 'Dia Chi Test', NULL, '2026-01-22 00:00:00', 200000.00, 'momo', NULL, 'DaGiao', NULL),
(2028, 1, 'Khach Test 2028', '09090002028', 'Dia Chi Test', NULL, '2026-01-23 00:00:00', 1400000.00, 'momo', NULL, 'DaGiao', NULL),
(2029, 1, 'Khach Test 2029', '09090002029', 'Dia Chi Test', NULL, '2026-01-23 00:00:00', 1000000.00, 'momo', NULL, 'DaGiao', NULL),
(2030, 1, 'Khach Test 2030', '09090002030', 'Dia Chi Test', NULL, '2026-01-25 00:00:00', 300000.00, 'momo', NULL, 'DaGiao', NULL),
(2031, 1, 'Khach Test 2031', '09090002031', 'Dia Chi Test', NULL, '2026-01-27 00:00:00', 1500000.00, 'momo', NULL, 'DaThanhToan', NULL),
(2032, 1, 'Khach Test 2032', '09090002032', 'Dia Chi Test', NULL, '2026-01-27 00:00:00', 700000.00, 'momo', NULL, 'DaGiao', NULL),
(2033, 1, 'Khach Test 2033', '09090002033', 'Dia Chi Test', NULL, '2026-01-28 00:00:00', 500000.00, 'momo', NULL, 'DaGiao', NULL),
(2034, 1, 'Khach Test 2034', '09090002034', 'Dia Chi Test', NULL, '2026-01-28 00:00:00', 900000.00, 'momo', NULL, 'DaGiao', NULL),
(2035, 1, 'Khach Test 2035', '09090002035', 'Dia Chi Test', NULL, '2026-01-30 00:00:00', 300000.00, 'momo', NULL, 'DaGiao', NULL),
(2036, 1, 'Khach Test 2036', '09090002036', 'Dia Chi Test', NULL, '2026-01-31 00:00:00', 800000.00, 'momo', NULL, 'DaGiao', NULL),
(2037, 1, 'Khach Test 2037', '09090002037', 'Dia Chi Test', NULL, '2026-02-01 00:00:00', 1200000.00, 'momo', NULL, 'DaGiao', NULL),
(2038, 1, 'Khach Test 2038', '09090002038', 'Dia Chi Test', NULL, '2026-02-04 00:00:00', 800000.00, 'momo', NULL, 'DaGiao', NULL),
(2039, 1, 'Khach Test 2039', '09090002039', 'Dia Chi Test', NULL, '2026-02-04 00:00:00', 1800000.00, 'momo', NULL, 'DaGiao', NULL),
(2040, 1, 'Khach Test 2040', '09090002040', 'Dia Chi Test', NULL, '2026-02-04 00:00:00', 1300000.00, 'momo', NULL, 'DaGiao', NULL),
(2041, 1, 'Khach Test 2041', '09090002041', 'Dia Chi Test', NULL, '2026-02-08 00:00:00', 1900000.00, 'momo', NULL, 'DaGiao', NULL),
(2042, 1, 'Khach Test 2042', '09090002042', 'Dia Chi Test', NULL, '2026-02-08 00:00:00', 7500000.00, 'momo', NULL, 'DaGiao', NULL),
(2043, 1, 'Khach Test 2043', '09090002043', 'Dia Chi Test', NULL, '2026-02-10 00:00:00', 1700000.00, 'momo', NULL, 'DaGiao', NULL),
(2044, 1, 'Khach Test 2044', '09090002044', 'Dia Chi Test', NULL, '2026-02-10 00:00:00', 1200000.00, 'momo', NULL, 'DaThanhToan', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `MaGioHang` int(11) NOT NULL,
  `MaKH` int(11) DEFAULT NULL,
  `NgayTao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `MaKH` int(11) NOT NULL,
  `TenKH` varchar(100) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `SoDienThoai` varchar(15) DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `NgayDangKy` datetime DEFAULT current_timestamp(),
  `MaTK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`MaKH`, `TenKH`, `Email`, `SoDienThoai`, `DiaChi`, `NgayDangKy`, `MaTK`) VALUES
(1, 'Nguyễn Hùng', 'hung@gmail.com', '0901111111', 'Hà Nội', '2026-01-29 16:42:15', 2),
(2, 'Trần Nam', 'nam@gmail.com', '0902222222', 'TP HCM', '2026-01-29 16:42:15', 3),
(3, 'Lê Phúc', 'phuc@gmail.com', '0903333333', 'Đà Nẵng', '2026-01-29 16:42:15', 4),
(4, 'Phạm Khoa', 'khoa@gmail.com', '0904444444', 'Cần Thơ', '2026-01-29 16:42:15', 5),
(5, 'Võ Tuấn', 'tuan@gmail.com', '0905555555', 'Hải Phòng', '2026-01-29 16:42:15', 6),
(6, 'Đinh Vinh', 'vinh@gmail.com', '0906666666', 'Huế', '2026-01-29 16:42:15', 7),
(7, 'Ngô Anh', 'anh@gmail.com', '0907777777', 'Bình Dương', '2026-01-29 16:42:15', 8),
(8, 'Bùi Duy', 'duy@gmail.com', '0908888888', 'Đồng Nai', '2026-01-29 16:42:15', 9),
(9, 'Hoàng Lâm', 'lam@gmail.com', '0909999999', 'Nha Trang', '2026-01-29 16:42:15', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kho`
--

CREATE TABLE `kho` (
  `MaKho` int(11) NOT NULL,
  `TenKho` varchar(100) DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `kho`
--

INSERT INTO `kho` (`MaKho`, `TenKho`, `DiaChi`) VALUES
(1, 'Kho Hà Nội', 'Quận Cầu Giấy'),
(2, 'Kho TP HCM', 'Quận 7'),
(3, 'Kho Đà Nẵng', 'Quận Hải Châu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `MaKM` int(11) NOT NULL,
  `TenKM` varchar(255) NOT NULL,
  `Code` varchar(50) NOT NULL,
  `LoaiKM` enum('tien','phantram') NOT NULL DEFAULT 'tien',
  `GiamGia` int(11) NOT NULL,
  `NgayBatDau` date NOT NULL,
  `NgayKetThuc` date NOT NULL,
  `TrangThai` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyenmai`
--

INSERT INTO `khuyenmai` (`MaKM`, `TenKM`, `Code`, `LoaiKM`, `GiamGia`, `NgayBatDau`, `NgayKetThuc`, `TrangThai`) VALUES
(2, 'Noen', 'NOEN', 'phantram', 30, '2026-01-26', '2026-02-08', 1),
(3, 'Sale Tet', 'TET2026', 'tien', 200000, '2026-01-26', '2026-02-15', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `MaNCC` int(11) NOT NULL,
  `TenNCC` varchar(100) NOT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `SoDienThoai` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--

INSERT INTO `nhacungcap` (`MaNCC`, `TenNCC`, `DiaChi`, `SoDienThoai`, `Email`) VALUES
(1, 'Yonex Việt Nam', 'TP HCM', '028111111', 'yonex@vn.com'),
(2, 'Lining Việt Nam', 'Hà Nội', '024222222', 'lining@vn.com'),
(3, 'Victor Việt Nam', 'TP HCM', '028333333', 'victor@vn.com'),
(4, 'Mizuno Việt Nam', 'Hà Nội', '024444444', 'mizuno@vn.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieunhap`
--

CREATE TABLE `phieunhap` (
  `MaPhieuNhap` int(11) NOT NULL,
  `MaNCC` int(11) NOT NULL,
  `NgayNhap` datetime DEFAULT current_timestamp(),
  `TongTien` decimal(12,2) DEFAULT NULL,
  `GhiChu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieunhap`
--

INSERT INTO `phieunhap` (`MaPhieuNhap`, `MaNCC`, `NgayNhap`, `TongTien`, `GhiChu`) VALUES
(1, 1, '2026-01-29 16:01:59', 50000000.00, 'Nhập hàng Yonex'),
(2, 2, '2026-01-29 16:01:59', 30000000.00, 'Nhập hàng Lining');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` int(11) NOT NULL,
  `TenSP` varchar(150) NOT NULL,
  `Gia` decimal(12,2) DEFAULT NULL CHECK (`Gia` > 0),
  `SoLuong` int(11) DEFAULT NULL CHECK (`SoLuong` >= 0),
  `MoTa` varchar(500) DEFAULT NULL,
  `HinhAnh` varchar(255) DEFAULT NULL,
  `TrangThai` tinyint(4) DEFAULT NULL CHECK (`TrangThai` in (0,1)),
  `MaDanhMuc` int(11) DEFAULT NULL,
  `MaNCC` int(11) DEFAULT NULL,
  `MaKho` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `Gia`, `SoLuong`, `MoTa`, `HinhAnh`, `TrangThai`, `MaDanhMuc`, `MaNCC`, `MaKho`) VALUES
(1, 'Yonex Astrox 77', 3800000.00, 20, 'Vợt tấn công mạnh mẽ', 'image.png', 1, 1, 1, 1),
(2, 'Yonex Astrox 88S', 4200000.00, 18, 'Vợt cầu sau chính xác', 'yonex-astrox-88s.jpg', 1, 1, 1, 2),
(3, 'Yonex Astrox 100ZZ', 4800000.00, 15, 'Vợt cao cấp chuyên nghiệp', 'yonex-astrox-100zz.jpg', 1, 1, 1, 3),
(4, 'Yonex Arcsaber 7', 3200000.00, 25, 'Vợt kiểm soát cầu tốt', 'yonex-arcsaber-7.jpg', 1, 1, 1, 1),
(5, 'Yonex Nanoflare 800', 3900000.00, 22, 'Vợt nhẹ, phản tay nhanh', 'yonex-nanoflare-800.jpg', 1, 1, 1, 2),
(6, 'Lining Aeronaut 6000', 3500000.00, 20, 'Vợt toàn diện', 'lining-aeronaut-6000.jpg', 1, 1, 2, 1),
(7, 'Lining Aeronaut 7000', 4100000.00, 17, 'Vợt tấn công kiểm soát', 'lining-aeronaut-7000.jpg', 1, 1, 2, 2),
(8, 'Lining Turbo X90', 2800000.00, 30, 'Vợt phong trào cao cấp', 'lining-turbo-x90.jpg', 1, 1, 2, 3),
(9, 'Lining Windstorm 78+', 2600000.00, 28, 'Vợt nhẹ cho người mới', 'lining-windstorm-78.jpg', 1, 1, 2, 1),
(10, 'Lining BladeX 900', 4300000.00, 16, 'Vợt phản cầu nhanh', 'lining-bladex-900.jpg', 1, 1, 2, 2),
(11, 'Victor Thruster K 9900', 4000000.00, 18, 'Vợt tấn công uy lực', 'victor-thruster-k9900.jpg', 1, 1, 3, 1),
(12, 'Victor Thruster F', 3600000.00, 20, 'Vợt tấn công – kiểm soát', 'victor-thruster-f.jpg', 1, 1, 3, 2),
(14, 'Victor Brave Sword 11', 3400000.00, 19, 'Vợt tốc độ', 'victor-brave-sword-12.jpg', 1, 1, 3, 1),
(15, 'Victor Jetspeed S12', 3700000.00, 17, 'Vợt phản tay nhanh', NULL, 1, 1, 3, 2),
(16, 'Yonex Bao cầu lông AS-30', 850000.00, 50, 'Ống cầu thi đấu', NULL, 1, 3, 1, 1),
(17, 'Yonex Bao cầu lông AS-50', 1200000.00, 40, 'Cầu lông cao cấp', NULL, 1, 3, 1, 2),
(18, 'Lining A+300', 650000.00, 60, 'Cầu lông phong trào', NULL, 1, 2, 2, 1),
(19, 'Victor Master Ace', 900000.00, 45, 'Cầu lông thi đấu', NULL, 1, 2, 3, 2),
(20, 'ProAce Platinum', 550000.00, 70, 'Cầu lông giá rẻ', NULL, 1, 2, 3, 3),
(21, 'Giày Yonex Comfort Z3', 2500000.00, 25, 'Giày cầu lông cao cấp', NULL, 1, 2, 1, 1),
(22, 'Giày Yonex Power Cushion', 2200000.00, 28, 'Giày chống chấn thương', NULL, 1, 2, 1, 2),
(23, 'Giày Lining Ranger', 1800000.00, 30, 'Giày bền – nhẹ', NULL, 1, 2, 2, 1),
(24, 'Giày Victor A970', 2100000.00, 24, 'Giày chuyên nghiệp', NULL, 1, 2, 3, 2),
(25, 'Giày Kawasaki K-068', 1500000.00, 35, 'Giày phong trào', NULL, 1, 2, 2, 3),
(26, 'Balo Yonex Pro', 1200000.00, 20, 'Balo đựng vợt chuyên nghiệp', NULL, 1, 3, 1, 1),
(27, 'Túi vợt Lining 6 ngăn', 980000.00, 22, 'Túi vợt thể thao', NULL, 1, 3, 2, 2),
(28, 'Quấn cán Yonex Super Grap', 25000.00, 200, 'Quấn cán thấm mồ hôi', NULL, 1, 4, 1, 3),
(29, 'Áo cầu lông Yonex Nam', 350000.00, 40, 'Áo thể thao nam', NULL, 1, 4, 1, 2),
(30, 'Quần cầu lông Lining', 320000.00, 45, 'Quần thể thao', NULL, 1, 4, 2, 1),
(31, 'Yonex Astrox 99 Pro', 4500000.00, 20, 'Vợt tấn công cao cấp', NULL, 1, 1, 1, 1),
(32, 'Yonex Nanoflare 700', 3800000.00, 15, 'Vợt nhẹ, dễ kiểm soát', NULL, 1, 1, 1, 2),
(33, 'Lining Aeronaut 9000C', 4200000.00, 18, 'Vợt công thủ toàn diện', NULL, 1, 1, 2, 1),
(34, 'Victor Thruster K Falcon', 3600000.00, 25, 'Vợt cầu lông tấn công', NULL, 1, 1, 3, 2),
(35, 'Yonex Arcsaber 11 Pro', 3900000.00, 22, 'Vợt điều cầu chính xác', NULL, 1, 1, 1, 3),
(36, 'Lining Turbo Charging 75', 2500000.00, 30, 'Vợt phong trào', NULL, 1, 1, 2, 1),
(37, 'Victor Brave Sword 12', 3200000.00, 20, 'Vợt tốc độ', NULL, 1, 1, 3, 2),
(38, 'Yonex Astrox 88D', 4100000.00, 17, 'Vợt đánh đôi cầu sau', NULL, 1, 1, 1, 3),
(39, 'Lining Windstorm 72', 2100000.00, 35, 'Vợt nhẹ cho người mới', NULL, 1, 1, 2, 1),
(41, 'Yonex 100ZZ', 1000000.00, 12, 'Vợt cao cấp hàng yonex, thiên công , vợt cứng', 'tải xuống.jpg', 1, 1, NULL, NULL),
(42, 'Yonex 100ZZ NaUy', 245346546.00, 32, 'Vợt siêu đẹp cứng, cao cấp', 'tải xuống.jpg', 1, 1, NULL, NULL),
(101, 'Vợt Yonex Astrox 77 (Test)', 2500000.00, 100, 'Hàng test', 'default.png', NULL, NULL, NULL, NULL),
(102, 'Vợt Lining Calibar 900 (Test)', 1800000.00, 100, 'Hàng test', 'default.png', NULL, NULL, NULL, NULL),
(103, 'Giày Yonex 65Z3 (Test)', 1200000.00, 100, 'Hàng test', 'default.png', NULL, NULL, NULL, NULL),
(104, 'Áo cầu lông Victor (Test)', 150000.00, 100, 'Hàng test', 'default.png', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `MaTK` int(11) NOT NULL,
  `TenDangNhap` varchar(50) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `VaiTro` enum('ADMIN','KHACHHANG') NOT NULL,
  `TrangThai` tinyint(4) DEFAULT NULL CHECK (`TrangThai` in (0,1))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`MaTK`, `TenDangNhap`, `MatKhau`, `VaiTro`, `TrangThai`) VALUES
(1, 'admin', 'admin123', 'ADMIN', 1),
(2, 'user1', '123', 'KHACHHANG', 1),
(3, 'kh_hung', '123456', 'KHACHHANG', 1),
(4, 'kh_nam', '123456', 'KHACHHANG', 1),
(5, 'kh_phuc', '123456', 'KHACHHANG', 1),
(6, 'kh_khoa', '123456', 'KHACHHANG', 1),
(7, 'kh_tuan', '123456', 'KHACHHANG', 1),
(8, 'kh_vinh', '123456', 'KHACHHANG', 1),
(9, 'kh_anh', '123456', 'KHACHHANG', 1),
(10, 'kh_duy', '123456', 'KHACHHANG', 1),
(11, 'kh_lam', '123456', 'KHACHHANG', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`MaDonHang`,`MaSP`),
  ADD KEY `FK_CTDH_SP` (`MaSP`);

--
-- Chỉ mục cho bảng `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  ADD PRIMARY KEY (`MaGioHang`,`MaSP`),
  ADD KEY `FK_CTGH_SP` (`MaSP`);

--
-- Chỉ mục cho bảng `chitietkho`
--
ALTER TABLE `chitietkho`
  ADD PRIMARY KEY (`MaKho`,`MaSP`),
  ADD KEY `FK_CTK_SP` (`MaSP`);

--
-- Chỉ mục cho bảng `chitietphieunhap`
--
ALTER TABLE `chitietphieunhap`
  ADD PRIMARY KEY (`MaPhieuNhap`,`MaSP`),
  ADD KEY `FK_CTPN_SP` (`MaSP`);

--
-- Chỉ mục cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`MaDanhGia`),
  ADD KEY `FK_DG_KH` (`MaKH`),
  ADD KEY `idx_dg_sp` (`MaSP`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`MaDanhMuc`),
  ADD UNIQUE KEY `TenDanhMuc` (`TenDanhMuc`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`MaDonHang`),
  ADD KEY `FK_DH_KH` (`MaKH`),
  ADD KEY `idx_dh_ngay` (`NgayDat`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`MaGioHang`),
  ADD UNIQUE KEY `MaKH` (`MaKH`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MaKH`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `MaTK` (`MaTK`);

--
-- Chỉ mục cho bảng `kho`
--
ALTER TABLE `kho`
  ADD PRIMARY KEY (`MaKho`);

--
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`MaKM`);

--
-- Chỉ mục cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`MaNCC`);

--
-- Chỉ mục cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD PRIMARY KEY (`MaPhieuNhap`),
  ADD KEY `FK_PN_NCC` (`MaNCC`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `FK_SP_DM` (`MaDanhMuc`),
  ADD KEY `FK_SP_NCC` (`MaNCC`),
  ADD KEY `FK_SP_KHO` (`MaKho`),
  ADD KEY `idx_sp_ten` (`TenSP`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`MaTK`),
  ADD UNIQUE KEY `TenDangNhap` (`TenDangNhap`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `MaDanhGia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `MaDanhMuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `MaDonHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2045;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `MaGioHang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MaKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `kho`
--
ALTER TABLE `kho`
  MODIFY `MaKho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `MaKM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `MaNCC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  MODIFY `MaPhieuNhap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `MaTK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `FK_CTDH_DH` FOREIGN KEY (`MaDonHang`) REFERENCES `donhang` (`MaDonHang`),
  ADD CONSTRAINT `FK_CTDH_SP` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  ADD CONSTRAINT `FK_CTGH_GH` FOREIGN KEY (`MaGioHang`) REFERENCES `giohang` (`MaGioHang`),
  ADD CONSTRAINT `FK_CTGH_SP` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `chitietkho`
--
ALTER TABLE `chitietkho`
  ADD CONSTRAINT `FK_CTK_KHO` FOREIGN KEY (`MaKho`) REFERENCES `kho` (`MaKho`),
  ADD CONSTRAINT `FK_CTK_SP` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `chitietphieunhap`
--
ALTER TABLE `chitietphieunhap`
  ADD CONSTRAINT `FK_CTPN_PN` FOREIGN KEY (`MaPhieuNhap`) REFERENCES `phieunhap` (`MaPhieuNhap`),
  ADD CONSTRAINT `FK_CTPN_SP` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD CONSTRAINT `FK_DG_KH` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MaKH`),
  ADD CONSTRAINT `FK_DG_SP` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `FK_DH_KH` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MaKH`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `FK_GH_KH` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MaKH`);

--
-- Các ràng buộc cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD CONSTRAINT `FK_KH_TK` FOREIGN KEY (`MaTK`) REFERENCES `taikhoan` (`MaTK`);

--
-- Các ràng buộc cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD CONSTRAINT `FK_PN_NCC` FOREIGN KEY (`MaNCC`) REFERENCES `nhacungcap` (`MaNCC`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `FK_SP_DM` FOREIGN KEY (`MaDanhMuc`) REFERENCES `danhmuc` (`MaDanhMuc`),
  ADD CONSTRAINT `FK_SP_KHO` FOREIGN KEY (`MaKho`) REFERENCES `kho` (`MaKho`),
  ADD CONSTRAINT `FK_SP_NCC` FOREIGN KEY (`MaNCC`) REFERENCES `nhacungcap` (`MaNCC`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
