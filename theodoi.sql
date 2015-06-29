-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2015 at 02:39 PM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `theodoi`
--

-- --------------------------------------------------------

--
-- Table structure for table `ds_hv_vang`
--

CREATE TABLE IF NOT EXISTS `ds_hv_vang` (
  `ma_hocvien` char(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ma_theodoi` int(11) NOT NULL,
  `phep` varchar(5) DEFAULT '1',
  PRIMARY KEY (`ma_hocvien`,`ma_theodoi`),
  KEY `ma_theodoi` (`ma_theodoi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ds_hv_vang`
--

INSERT INTO `ds_hv_vang` (`ma_hocvien`, `ma_theodoi`, `phep`) VALUES
('140301', 1, '1'),
('140301', 6, '1'),
('140303', 3, '1'),
('140304', 2, '0'),
('140307', 2, '1'),
('140501', 9, '1'),
('140503', 9, '1'),
('140507', 9, '1');

-- --------------------------------------------------------

--
-- Table structure for table `giao_vien`
--

CREATE TABLE IF NOT EXISTS `giao_vien` (
  `mail` char(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sdt` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `ho` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gioitinh` int(11) DEFAULT NULL,
  `mat_khau` char(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cap_bac` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sdt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `giao_vien`
--

INSERT INTO `giao_vien` (`mail`, `sdt`, `ho`, `ten`, `gioitinh`, `mat_khau`, `cap_bac`) VALUES
('huynhthanhxuancnttqk9@gmail.com', '01214972969', 'Huỳnh Thanh', 'Xuân', NULL, 'e10adc3949ba59abbe56e057f20f883e', 2),
('ndmhoang91@gmail.com', '01299506597', 'Nguyễn Đặng Minh', 'Hoàng', NULL, 'e10adc3949ba59abbe56e057f20f883e', 1),
('ptd1107kdn@gmail.com', '01682836876', 'Phạm Trường', 'Duy', NULL, 'e10adc3949ba59abbe56e057f20f883e', 1),
('thanhtuoi2008@gmail.com', '0932885489', 'Nguyễn Thành', 'Tươi', NULL, 'e10adc3949ba59abbe56e057f20f883e', 1),
('nhtrung09@gmail.com', '0949845449', 'Nguyễn Hữu', 'Trung', NULL, 'e10adc3949ba59abbe56e057f20f883e', 1),
('n.k.huan91@gmail.com', '0989826331', 'Nguyễn Khoa', 'Huân', 1, 'e10adc3949ba59abbe56e057f20f883e', 2);

-- --------------------------------------------------------

--
-- Table structure for table `hoc_vien`
--

CREATE TABLE IF NOT EXISTS `hoc_vien` (
  `ma_hocvien` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `ma_pc_cn` int(11) NOT NULL,
  `ho_hocvien` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ten_hocvien` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_sinh` date NOT NULL,
  `doi_tuong` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `que_quan` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tinh_trang` char(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'hoc',
  PRIMARY KEY (`ma_hocvien`),
  KEY `ma_pc` (`ma_pc_cn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hoc_vien`
--

INSERT INTO `hoc_vien` (`ma_hocvien`, `ma_pc_cn`, `ho_hocvien`, `ten_hocvien`, `ngay_sinh`, `doi_tuong`, `que_quan`, `tinh_trang`) VALUES
('140301', 36, 'Lê Thành', 'Công', '0000-00-00', '', '', 'HOC'),
('140302', 36, 'Lê Minh', 'Dương', '0000-00-00', '', '', 'HOC'),
('140303', 36, 'Lê Văn', 'Giàu', '0000-00-00', '', '', 'HOC'),
('140304', 36, 'Võ Hữu', 'Hưng', '0000-00-00', '', '', 'HOC'),
('140305', 36, 'Phạm Chí', 'Miền', '0000-00-00', '', '', 'HOC'),
('140306', 36, 'Nguyễn Thanh', 'Tâm', '0000-00-00', '', '', 'HOC'),
('140307', 36, 'Phan Văn', 'Thắm', '0000-00-00', '', '', 'HOC'),
('140308', 36, 'Dư Văn', 'Toàn', '0000-00-00', '', '', 'HOC'),
('140501', 37, 'Nguyễn Văn', 'Khắp', '0000-00-00', '', '', 'HOC'),
('140502', 37, 'Nguyễn My', 'Sol', '0000-00-00', '', '', 'HOC'),
('140503', 37, 'Trang Sỹ Ngọc', 'Ẩn', '0000-00-00', '', '', 'HOC'),
('140504', 37, 'Lê Minh', 'Quân', '0000-00-00', '', '', 'HOC'),
('140505', 37, 'Trịnh Thanh', 'Liêm', '0000-00-00', '', '', 'HOC'),
('140506', 37, 'Võ Tuấn', 'Anh', '0000-00-00', '', '', 'HOC'),
('140507', 37, 'Trần Đắc', 'Duy', '0000-00-00', '', '', 'HOC'),
('140508', 37, 'Nguyễn Thanh', 'Vĩnh', '0000-00-00', '', '', 'HOC'),
('140509', 37, 'Nguyễn Công', 'Hậu', '0000-00-00', '', '', 'HOC'),
('140510', 37, 'Trần Hữu', 'Đức', '0000-00-00', '', '', 'HOC'),
('140511', 37, 'Nguyễn Lê Anh', 'Tuấn', '0000-00-00', '', '', 'HOC'),
('150401', 38, 'Lê Công Tấn', 'Anh', '0000-00-00', '', '', 'HOC'),
('150402', 38, 'Phan Tấn', 'Đạt', '0000-00-00', '', '', 'HOC'),
('150403', 38, 'Võ Khánh', 'Duy', '0000-00-00', '', '', 'HOC'),
('150404', 38, 'Trần Vũ An', 'Khang', '0000-00-00', '', '', 'HOC'),
('150405', 38, 'Trần Văn Nhựt', 'Khanh', '0000-00-00', '', '', 'HOC'),
('150406', 38, 'Nguyễn Phú', 'Khánh', '0000-00-00', '', '', 'HOC'),
('150407', 38, 'Lê Chí', 'Linh', '0000-00-00', '', '', 'HOC'),
('150408', 38, 'Lê Ý', 'Nguyện', '0000-00-00', '', '', 'HOC'),
('150409', 38, 'Nguyễn Hoàng', 'Sang', '0000-00-00', '', '', 'HOC'),
('150410', 38, 'Võ Thanh', 'Sang', '0000-00-00', '', '', 'HOC'),
('150411', 38, 'Phạm Tấn', 'Tài', '0000-00-00', '', '', 'HOC'),
('150412', 38, 'Nguyễn Tấn', 'Thịnh', '0000-00-00', '', '', 'HOC'),
('150501', 39, 'Nguyễn Châu Tuấn', 'Duy', '0000-00-00', '', '', 'NGHI'),
('150502', 39, 'Lê Minh', 'Hiếu', '0000-00-00', '', '', 'HOC'),
('150503', 39, 'Bùi Thị Bạch', 'Huyền', '0000-00-00', '', '', 'HOC'),
('150504', 39, 'Nguyễn Quốc', 'Khánh', '0000-00-00', '', '', 'HOC'),
('150505', 39, 'Đặng Minh', 'Không', '0000-00-00', '', '', 'HOC'),
('150506', 39, 'Lê Vũ', 'Linh', '0000-00-00', '', '', 'HOC'),
('150507', 39, 'Nguyễn Thanh', 'Lâm', '0000-00-00', '', '', 'HOC'),
('150508', 39, 'Trương Thanh', 'Nam', '0000-00-00', '', '', 'HOC'),
('150509', 39, 'Ngô Đình Hữu', 'Nghĩa', '0000-00-00', '', '', 'HOC');

-- --------------------------------------------------------

--
-- Table structure for table `khoa_hoc`
--

CREATE TABLE IF NOT EXISTS `khoa_hoc` (
  `ma_khoa` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `ten_khoa` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ma_khoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='sinh vi�n thu?c kh�a h?c';

--
-- Dumping data for table `khoa_hoc`
--

INSERT INTO `khoa_hoc` (`ma_khoa`, `ten_khoa`) VALUES
('K12', 'Khóa 12'),
('K13', 'Khóa 13'),
('K14', 'Khóa 14'),
('K15', 'Khóa 15'),
('k16', 'Khóa 16');

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

CREATE TABLE IF NOT EXISTS `lop` (
  `ma_lop` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `ten_lop` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ma_lop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`ma_lop`, `ten_lop`) VALUES
('KTSCLRMT', 'Kỹ Thuật Sơ Cấp Lắp Ráp Máy Tính'),
('UDPM', 'Ứng Dụng Phần Mềm');

-- --------------------------------------------------------

--
-- Table structure for table `mon_hoc`
--

CREATE TABLE IF NOT EXISTS `mon_hoc` (
  `ma_mon` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `ten_mon` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ly_thuyet` int(11) NOT NULL,
  `thuc_hanh` int(11) NOT NULL,
  PRIMARY KEY (`ma_mon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mon_hoc`
--

INSERT INTO `mon_hoc` (`ma_mon`, `ten_mon`, `ly_thuyet`, `thuc_hanh`) VALUES
('CSDL', 'Cơ Sở Dữ Liệu', 60, 100),
('CTDLGT', 'Cấu Trúc Dữ Liệu & Giải Thuật', 30, 30),
('LTVBN', 'Lập Trình VN.NET', 10, 30),
('PTTKHTTT', 'Phân Tích Thiết Kế HTTT', 10, 30),
('TKW', 'Thiết Kế Web', 30, 60);

-- --------------------------------------------------------

--
-- Table structure for table `phan_cong`
--

CREATE TABLE IF NOT EXISTS `phan_cong` (
  `sdt` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `ma_mon` char(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`sdt`,`ma_mon`),
  KEY `ma_mon` (`ma_mon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phan_cong`
--

INSERT INTO `phan_cong` (`sdt`, `ma_mon`) VALUES
('01214972969', 'PTTKHTTT'),
('01214972969', 'TKW');

-- --------------------------------------------------------

--
-- Table structure for table `phan_cong_cn`
--

CREATE TABLE IF NOT EXISTS `phan_cong_cn` (
  `ma_pc_cn` int(11) NOT NULL AUTO_INCREMENT,
  `sdt` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `ma_lop` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `ma_khoa` char(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ma_lop`,`ma_khoa`),
  UNIQUE KEY `ma_pc` (`ma_pc_cn`),
  KEY `ma_khoa` (`ma_khoa`),
  KEY `sdt` (`sdt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

--
-- Dumping data for table `phan_cong_cn`
--

INSERT INTO `phan_cong_cn` (`ma_pc_cn`, `sdt`, `ma_lop`, `ma_khoa`) VALUES
(41, '01299506597', 'KTSCLRMT', 'K13'),
(36, '01214972969', 'KTSCLRMT', 'K14'),
(38, '01682836876', 'KTSCLRMT', 'K15'),
(40, '0949845449', 'UDPM', 'K13'),
(37, '01214972969', 'UDPM', 'K14'),
(39, '01682836876', 'UDPM', 'K15');

-- --------------------------------------------------------

--
-- Table structure for table `phong_hoc`
--

CREATE TABLE IF NOT EXISTS `phong_hoc` (
  `ma_phong` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `ten_phong` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ma_phong`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phong_hoc`
--

INSERT INTO `phong_hoc` (`ma_phong`, `ten_phong`) VALUES
('H1', 'H1'),
('H2', 'H2'),
('HT1', 'Hội Trường 1'),
('HT2', 'Hội Trường 2'),
('HT3', 'Hội Trường 3');

-- --------------------------------------------------------

--
-- Table structure for table `so_theo_doi`
--

CREATE TABLE IF NOT EXISTS `so_theo_doi` (
  `ma_theodoi` int(11) NOT NULL AUTO_INCREMENT,
  `ngay` date NOT NULL,
  `ma_buoi` char(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'SANG',
  `ma_lop` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `sdt` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `ma_khoa` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `ma_mon` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `ma_phong` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `loai` char(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'LT',
  `quan_so` int(11) NOT NULL,
  `hien_dien` int(11) NOT NULL,
  `vang` int(11) NOT NULL,
  `danh_sach_vang` text COLLATE utf8_unicode_ci NOT NULL,
  `de_cuong` int(11) NOT NULL DEFAULT '0',
  `giao_an` int(11) NOT NULL DEFAULT '0',
  `so_tay` int(11) NOT NULL DEFAULT '0',
  `ghi_chu` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`ngay`,`ma_buoi`,`ma_lop`,`sdt`,`ma_khoa`,`ma_mon`),
  UNIQUE KEY `ma_theodoi` (`ma_theodoi`),
  KEY `FK_Relationship_1` (`sdt`),
  KEY `FK_Relationship_3` (`ma_phong`),
  KEY `FK_Relationship_4` (`ma_mon`),
  KEY `ma_khoa` (`ma_khoa`),
  KEY `ma_lop` (`ma_lop`),
  KEY `ma_buoi` (`ma_buoi`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `so_theo_doi`
--

INSERT INTO `so_theo_doi` (`ma_theodoi`, `ngay`, `ma_buoi`, `ma_lop`, `sdt`, `ma_khoa`, `ma_mon`, `ma_phong`, `loai`, `quan_so`, `hien_dien`, `vang`, `danh_sach_vang`, `de_cuong`, `giao_an`, `so_tay`, `ghi_chu`) VALUES
(5, '2015-06-21', 'CHIEU', 'KTSCLRMT', '01214972969', 'K14', 'PTTKHTTT', 'H1', 'TH', 8, 8, 0, '', 1, 1, 1, ''),
(7, '2015-06-21', 'CHIEU', 'KTSCLRMT', '01214972969', 'K14', 'TKW', 'H1', 'LT', 8, 8, 0, '', 1, 1, 1, ''),
(9, '2015-06-21', 'CHIEU', 'UDPM', '01214972969', 'K14', 'PTTKHTTT', 'H1', 'TH', 11, 8, 3, '', 1, 1, 1, ''),
(4, '2015-06-21', 'SANG', 'KTSCLRMT', '01214972969', 'K14', 'PTTKHTTT', 'H1', 'LT', 8, 8, 0, '', 1, 1, 1, ''),
(6, '2015-06-21', 'SANG', 'KTSCLRMT', '01214972969', 'K14', 'TKW', 'H1', 'LT', 8, 7, 1, '', 1, 1, 1, ''),
(8, '2015-06-21', 'SANG', 'UDPM', '01214972969', 'K14', 'PTTKHTTT', 'H1', 'LT', 11, 11, 0, '', 1, 1, 1, ''),
(2, '2015-06-22', 'CHIEU', 'KTSCLRMT', '01214972969', 'K14', 'PTTKHTTT', 'H2', 'TH', 8, 6, 2, '', 1, 1, 1, ''),
(1, '2015-06-22', 'SANG', 'KTSCLRMT', '01214972969', 'K14', 'PTTKHTTT', 'H1', 'LT', 8, 7, 1, '', 1, 1, 1, ''),
(3, '2015-06-22', 'SANG', 'KTSCLRMT', '01214972969', 'K14', 'TKW', 'H1', 'LT', 8, 7, 1, '', 1, 1, 1, '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ds_hv_vang`
--
ALTER TABLE `ds_hv_vang`
  ADD CONSTRAINT `ds_hv_vang_ibfk_2` FOREIGN KEY (`ma_hocvien`) REFERENCES `hoc_vien` (`ma_hocvien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ds_hv_vang_ibfk_3` FOREIGN KEY (`ma_theodoi`) REFERENCES `so_theo_doi` (`ma_theodoi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hoc_vien`
--
ALTER TABLE `hoc_vien`
  ADD CONSTRAINT `hoc_vien_ibfk_1` FOREIGN KEY (`ma_pc_cn`) REFERENCES `phan_cong_cn` (`ma_pc_cn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phan_cong`
--
ALTER TABLE `phan_cong`
  ADD CONSTRAINT `phan_cong_ibfk_1` FOREIGN KEY (`sdt`) REFERENCES `giao_vien` (`sdt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phan_cong_ibfk_2` FOREIGN KEY (`ma_mon`) REFERENCES `mon_hoc` (`ma_mon`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phan_cong_cn`
--
ALTER TABLE `phan_cong_cn`
  ADD CONSTRAINT `phan_cong_cn_ibfk_2` FOREIGN KEY (`ma_lop`) REFERENCES `lop` (`ma_lop`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phan_cong_cn_ibfk_3` FOREIGN KEY (`ma_khoa`) REFERENCES `khoa_hoc` (`ma_khoa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phan_cong_cn_ibfk_4` FOREIGN KEY (`sdt`) REFERENCES `giao_vien` (`sdt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `so_theo_doi`
--
ALTER TABLE `so_theo_doi`
  ADD CONSTRAINT `so_theo_doi_ibfk_10` FOREIGN KEY (`ma_lop`) REFERENCES `phan_cong_cn` (`ma_lop`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `so_theo_doi_ibfk_4` FOREIGN KEY (`ma_phong`) REFERENCES `phong_hoc` (`ma_phong`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `so_theo_doi_ibfk_7` FOREIGN KEY (`ma_mon`) REFERENCES `phan_cong` (`ma_mon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `so_theo_doi_ibfk_8` FOREIGN KEY (`sdt`) REFERENCES `phan_cong` (`sdt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `so_theo_doi_ibfk_9` FOREIGN KEY (`ma_khoa`) REFERENCES `phan_cong_cn` (`ma_khoa`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
