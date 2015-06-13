-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2015 at 08:35 AM
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
  PRIMARY KEY (`ma_hocvien`,`ma_theodoi`),
  KEY `ma_theodoi` (`ma_theodoi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ds_hv_vang`
--

INSERT INTO `ds_hv_vang` (`ma_hocvien`, `ma_theodoi`) VALUES
('k13.01', 32),
('k13.01', 40);

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
('tuan@tuan.com', '0123456789', 'Trần', 'Tuấn', NULL, 'e10adc3949ba59abbe56e057f20f883e', 2),
('n.h.khoa@live.com', '0976586653', 'Nguyễn Hoàng', 'Khoa', NULL, 'e10adc3949ba59abbe56e057f20f883e', 1),
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
  `tinh_trang` char(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'hoc',
  PRIMARY KEY (`ma_hocvien`),
  KEY `ma_pc` (`ma_pc_cn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hoc_vien`
--

INSERT INTO `hoc_vien` (`ma_hocvien`, `ma_pc_cn`, `ho_hocvien`, `ten_hocvien`, `ngay_sinh`, `tinh_trang`) VALUES
('ccb', 25, 'Mai', 'Cồ', '0000-00-00', 'HOC'),
('k12.01', 28, 'Nguyễn', 'Tâm', '0000-00-00', 'HOC'),
('k12.02', 28, 'Lâm', 'Như', '0000-00-00', 'HOC'),
('k12.03', 28, 'Trần', 'Trụi', '0000-00-00', 'HOC'),
('k12.05', 30, 'Bụi', 'Đời', '0000-00-00', 'HOC'),
('k12.06', 30, 'Tín', 'Phạm', '0000-00-00', 'HOC'),
('k12.07', 28, 'Huỳnh', 'Tuấn', '0000-00-00', 'HOC'),
('k12.08', 28, 'Tuấn', 'Vũ', '0000-00-00', 'HOC'),
('k13.01', 29, 'Trần Minh', 'Tím', '0000-00-00', 'HOC'),
('k13.02', 29, 'Đặng', 'Hùng', '0000-00-00', 'HOC'),
('k13.03', 29, 'Đặng', 'Mình', '0000-00-00', 'HOC'),
('k15.01', 25, 'Đoàn', 'Dự', '0000-00-00', 'HOC');

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
('K15', 'Khóa 15');

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
('TKMMT', 'Thiết Kế Mạng Máy Tính'),
('UDPM', 'Ứng dụng phần mềm');

-- --------------------------------------------------------

--
-- Table structure for table `mon_hoc`
--

CREATE TABLE IF NOT EXISTS `mon_hoc` (
  `ma_mon` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `ten_mon` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `so_tiet` int(11) NOT NULL,
  PRIMARY KEY (`ma_mon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mon_hoc`
--

INSERT INTO `mon_hoc` (`ma_mon`, `ten_mon`, `so_tiet`) VALUES
('CSDL', 'Cơ Sở Dữ Liệu', 0),
('LTVBN', 'Lập Trình VN.NET', 90),
('LTW', 'Lập Trình Web', 0),
('PTTKHTTT', 'Phân Tích Thiết Kế HTTT', 0);

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
('0976586653', 'CSDL'),
('0989826331', 'CSDL'),
('0976586653', 'LTVBN'),
('0976586653', 'LTW'),
('0989826331', 'LTW');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `phan_cong_cn`
--

INSERT INTO `phan_cong_cn` (`ma_pc_cn`, `sdt`, `ma_lop`, `ma_khoa`) VALUES
(28, '0989826331', 'KTSCLRMT', 'K12'),
(29, '0989826331', 'KTSCLRMT', 'K13'),
(26, '0123456789', 'TKMMT', 'K12'),
(27, '0123456789', 'TKMMT', 'K14'),
(30, '0989826331', 'UDPM', 'K12'),
(25, '0989826331', 'UDPM', 'K15');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=43 ;

--
-- Dumping data for table `so_theo_doi`
--

INSERT INTO `so_theo_doi` (`ma_theodoi`, `ngay`, `ma_buoi`, `ma_lop`, `sdt`, `ma_khoa`, `ma_mon`, `ma_phong`, `quan_so`, `hien_dien`, `vang`, `danh_sach_vang`, `de_cuong`, `giao_an`, `so_tay`, `ghi_chu`) VALUES
(34, '2015-06-03', 'CHIEU', 'KTSCLRMT', '0989826331', 'K13', 'CSDL', 'H1', 3, 3, 0, '', 1, 1, 1, ''),
(32, '2015-06-03', 'SANG', 'KTSCLRMT', '0989826331', 'K13', 'CSDL', 'H1', 3, 2, 1, '', 1, 1, 1, ''),
(42, '2015-06-04', 'CHIEU', 'KTSCLRMT', '0989826331', 'K13', 'CSDL', 'HT3', 3, 3, 0, '', 1, 1, 1, ''),
(40, '2015-06-04', 'SANG', 'KTSCLRMT', '0989826331', 'K13', 'CSDL', 'H1', 3, 2, 1, '', 1, 1, 1, '');

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
