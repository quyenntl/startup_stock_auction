-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2017 at 04:16 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mocmien_car1`
--

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `type` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `link`, `type`) VALUES
(1, 'http://hn.24h.com.vn/', 'jpg'),
(2, 'dantri.com.vn', 'jpg'),
(3, 'adfasd.com', 'Ã¡dfa'),
(4, 'http://hn.24h.com.vn/image/test', 'jpg'),
(5, '', 'bmp');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `order` int(11) NOT NULL COMMENT 'Thứ tự hiển thị',
  `source` varchar(500) COLLATE utf8_unicode_ci DEFAULT '0' COMMENT 'Navbar menu system',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `url`, `level`, `parent_id`, `order`, `source`) VALUES
(1, 'Home', 'home', 1, 0, 1, '0'),
(3, 'Menu Admin', 'navsystem', 2, 2, 1, NULL),
(5, 'Admin user', 'user', 1, 0, 2, '0'),
(33, 'Config', 'config_sys', 1, 0, 2, '0'),
(34, 'Report', 'report', 1, 0, 2, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_about`
--

CREATE TABLE IF NOT EXISTS `tbl_about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ảnh đại diện',
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordering` int(11) NOT NULL,
  `time_create` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=55 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bid`
--

CREATE TABLE IF NOT EXISTS `tbl_bid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_code` varchar(20) NOT NULL,
  `price` int(11) NOT NULL COMMENT 'Số tiền / 1 cổ phẩn',
  `num_stocks` int(11) NOT NULL COMMENT 'Tổng số cổ phần mua',
  `time_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `tbl_bid`
--

INSERT INTO `tbl_bid` (`id`, `user_code`, `price`, `num_stocks`, `time_created`) VALUES
(23, 'NDT0041', 2000000, 20, 1501139290),
(24, 'NDT0054', 2000000, 50, 1501139879),
(25, 'NDT0031', 20000, 22, 1501693665),
(26, 'NDT0043', 2000000, 100, 1501166229),
(27, 'NDT0039', 2000000, 50, 1501141639),
(28, 'NDT0047', 2000000, 50, 1501144060),
(29, 'NDT0032', 2000000, 450, 1501865960),
(30, 'NDT0040', 2000000, 50, 1501146240),
(31, 'NDT0069', 2000000, 25, 1501147371),
(32, 'NDT0033', 2000000, 25, 1501148445),
(33, 'NDT0067', 2000000, 25, 1501153341),
(34, 'NDT0053', 2000000, 25, 1501158757),
(35, 'NDT0055', 2000000, 25, 1501163078),
(36, 'NDT0072', 2000000, 25, 1501164653),
(37, 'NDT0050', 2000000, 50, 1501165603);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bid_hist`
--

CREATE TABLE IF NOT EXISTS `tbl_bid_hist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_code` varchar(20) NOT NULL,
  `price` int(11) NOT NULL COMMENT 'Số tiền / 1 cổ phẩn',
  `num_stocks` int(11) NOT NULL COMMENT 'Tổng số cổ phần mua',
  `time_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `tbl_bid_hist`
--

INSERT INTO `tbl_bid_hist` (`id`, `user_code`, `price`, `num_stocks`, `time_created`) VALUES
(1, 'NDT0020', 6000, 500, 1500629048),
(2, 'NDT0020', 13000, 900, 1500629156),
(3, 'NDT0020', 13000, 900, 1500629164),
(4, 'NDT0020', 13000, 900, 1500629252),
(5, 'NDT0020', 20000, 100, 1500647187),
(6, 'NDT0020', 20000, 2000, 1500651618),
(7, 'NDT0020', 2451000, 10, 1500651655),
(8, 'NDT0020', 4000000, 10, 1500696736),
(9, 'NDT0026', 1900000, 30, 1500997338),
(10, 'NDT0026', 1900000, 50, 1500998538),
(11, 'NDT0026', 1900000, 50, 1500998541),
(12, 'NDT0029', 1800000, 90, 1500998924),
(13, 'NDT0029', 1800000, 90, 1500998930),
(14, 'NDT0024', 2000, 1000, 1500999308),
(15, 'NDT0024', 2000, 1000, 1500999312),
(16, 'NDT0030', 2450, 100, 1501000221),
(17, 'NDT0030', 2450, 100, 1501000226),
(18, 'NDT0030', 2450, 35, 1501086941),
(19, 'NDT0030', 2000, 20, 1501120983),
(20, 'NDT0071', 2150000, 30, 1501126221),
(21, 'NDT0071', 2450000, 40, 1501126245),
(22, 'NDT0024', 2100000, 18, 1501126290),
(23, 'NDT0024', 2450000, 20, 1501126362),
(24, 'NDT0024', 2250000, 16, 1501126376),
(25, 'NDT0024', 2450000, 20, 1501126444),
(26, 'NDT0071', 2100000, 40, 1501128455),
(27, 'NDT0071', 2150000, 40, 1501128506),
(28, 'NDT0071', 2000000, 50, 1501129682),
(29, 'NDT0041', 2000000, 20, 1501139290),
(30, 'NDT0054', 2000000, 50, 1501139879),
(31, 'NDT0031', 2000000, 50, 1501140006),
(32, 'NDT0043', 2000000, 150, 1501140602),
(33, 'NDT0039', 2000000, 50, 1501141563),
(34, 'NDT0039', 2000000, 50, 1501141639),
(35, 'NDT0047', 2000000, 50, 1501144003),
(36, 'NDT0032', 2000000, 20, 1501144011),
(37, 'NDT0032', 2000000, 20, 1501144012),
(38, 'NDT0047', 2000000, 25, 1501144036),
(39, 'NDT0047', 2000000, 50, 1501144060),
(40, 'NDT0032', 2000000, 30, 1501144060),
(41, 'NDT0032', 2000000, 20, 1501144079),
(42, 'NDT0032', 2000000, 25, 1501144122),
(43, 'NDT0032', 2000000, 450, 1501144240),
(44, 'NDT0032', 2000000, 25, 1501144257),
(45, 'NDT0040', 2000000, 50, 1501146240),
(46, 'NDT0069', 2000000, 25, 1501147371),
(47, 'NDT0033', 2000000, 20, 1501148107),
(48, 'NDT0033', 2000000, 5, 1501148154),
(49, 'NDT0033', 2000000, 25, 1501148445),
(50, 'NDT0067', 2000000, 25, 1501153341),
(51, 'NDT0053', 2000000, 25, 1501158757),
(52, 'NDT0055', 2000000, 25, 1501163078),
(53, 'NDT0072', 2000000, 25, 1501164651),
(54, 'NDT0072', 2000000, 25, 1501164653),
(55, 'NDT0050', 2000000, 50, 1501165603),
(56, 'NDT0050', 2000000, 50, 1501165603),
(57, 'NDT0043', 2000000, 100, 1501166229),
(58, 'NDT0031', 2000000, 50, 1501251398),
(59, 'NDT0031', 2000000, 50, 1501251545),
(60, 'NDT0031', 2000000, 50, 1501692833),
(61, 'NDT0031', 2000000, 50, 1501692835),
(62, 'NDT0031', 111111, 1, 1501692874),
(63, 'NDT0031', 10000, 20, 1501693438),
(64, 'NDT0031', 20000, 1, 1501693536),
(65, 'NDT0031', 20000, 1, 1501693538),
(66, 'NDT0031', 10000, 22, 1501693549),
(67, 'NDT0031', 20000, 22, 1501693665),
(68, 'NDT0032', 2000000, 450, 1501865960);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL COMMENT 'Tên',
  `name_ascii` varchar(128) NOT NULL COMMENT 'Tên theo mã ascii',
  `parent_id` int(11) NOT NULL COMMENT 'Id của danh mục cha',
  `level` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL COMMENT 'Trật tự sắp xếp',
  `active` int(11) NOT NULL COMMENT '1: active, 2: no active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`, `name_ascii`, `parent_id`, `level`, `ordering`, `active`) VALUES
(36, 'Ford Ranger', 'ford-ranger', 0, 1, 1, 1),
(37, 'Ford Ecosport', 'ford-ecosport', 0, 1, 2, 1),
(38, 'Ford Everest', 'ford-everest', 0, 1, 3, 1),
(39, 'Ford Fiesta', 'ford-fiesta', 0, 1, 4, 1),
(40, 'Ford Forcus', 'ford-forcus', 0, 1, 5, 1),
(41, 'Ford Transit', 'ford-transit', 0, 1, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_config_system`
--

CREATE TABLE IF NOT EXISTS `tbl_config_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `key` varchar(100) DEFAULT NULL,
  `value` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `time_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_config_system`
--

INSERT INTO `tbl_config_system` (`id`, `name`, `key`, `value`, `status`, `time_created`) VALUES
(1, 'SO_LUONG_CP', 'SO_LUONG', '1000', 1, 1501118032),
(2, 'TIME', 'END_TIME', '2017/08/05 23:58:00', 1, 1501865931);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE IF NOT EXISTS `tbl_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `time_create` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `name`, `email`, `phone`, `title`, `content`, `time_create`) VALUES
(1, 'admin', 'anhth@gmail.net', '0903382812', 'Cần mua xe eco', 'Xin shop cho giá tốt nhất có thể', 1488432976),
(2, 'car', 'anh.tang.777@abc.com', '0903382812', 'test', 'sfds', 1488437976),
(3, 'Ford Ecosport', 'anhth@gmail.ne', '0903382812', 'get user mkt', 'abc', 1488438137),
(4, 'a', '"attacker \\'' -oQ/tmp/ -Xassets/home/img/a.php anyt', 'aaaaaaaaaaaaaaa', 'aaaaaaaaaa', 'aaaaaaaaaaaaa', 1490372250);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(64) NOT NULL,
  `fullname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) NOT NULL,
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ndt_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price_current` int(11) NOT NULL,
  `sig_deposit_amt` int(11) NOT NULL DEFAULT '0',
  `price_fix` float NOT NULL DEFAULT '0',
  `email` varchar(128) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'status user',
  `time_created` int(11) NOT NULL,
  `time_last_visited` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `fullname`, `password`, `code`, `ndt_id`, `price_current`, `sig_deposit_amt`, `price_fix`, `email`, `phone`, `role`, `status`, `time_created`, `time_last_visited`) VALUES
(25, 'admin', 'admin', 'ed2b1f468c5f915f3f1cf75d7068baae', '', '', 0, 0, 0, 'admin@gmail.com', '', '1', 1, 1500946426, 1501864306),
(31, '', 'AA0111', '', 'AA0111', 'NDT0031', 20000, 100000000, 0, '0', '0', '2', 1, 1501057853, 1501602455),
(32, '', 'AA1110', '', 'AA1110', 'NDT0032', 2000000, 900000000, 900000000, '0', '0', '2', 1, 1501058008, 1501864328),
(33, '', 'AB1101', '', 'AB1101', 'NDT0033', 2000000, 50000000, 0, '0', '0', '2', 1, 1501058573, 1501139567),
(34, '', 'AB1110', '', 'AB1110', 'NDT0034', 0, 50000000, 0, '0', '0', '2', 1, 1501058598, 1501115877),
(35, '', 'AB0111', '', 'AB0111', 'NDT0035', 0, 50000000, 0, '0', '0', '2', 1, 1501058626, 1501115914),
(36, '', 'BA2101', '', 'BA2101', 'NDT0036', 0, 100000000, 0, '0', '0', '2', 1, 1501058669, 1501116771),
(37, '', 'BA2110', '', 'BA2110', 'NDT0037', 0, 60000000, 0, '0', '0', '2', 1, 1501058708, 0),
(38, '', 'BA0112', '', 'BA0112', 'NDT0038', 0, 200000000, 0, '0', '0', '2', 1, 1501058737, 0),
(39, '', 'BB2110', '', 'BB2110', 'NDT0039', 2000000, 100000000, 0, '0', '0', '2', 1, 1501058788, 1501141535),
(40, '', 'BB0112', '', 'BB0112', 'NDT0040', 2000000, 100000000, 0, '0', '0', '2', 1, 1501058831, 1501156936),
(41, '', 'CA1013', '', 'CA1013', 'NDT0041', 2000000, 60000000, 0, '0', '0', '2', 1, 1501058872, 1501139184),
(42, '', 'CA3101', '', 'CA3101', 'NDT0042', 0, 100000000, 0, '0', '0', '2', 1, 1501058902, 0),
(43, '', 'CA3110', '', 'CA3110', 'NDT0043', 2000000, 300000000, 0, '0', '0', '2', 1, 1501058930, 1501140732),
(44, '', 'CA0113', '', 'CA0113', 'NDT0044', 0, 50000000, 0, '0', '0', '2', 1, 1501058981, 0),
(45, '', 'CB1013', '', 'CB1013', 'NDT0045', 0, 100000000, 0, '0', '0', '2', 1, 1501059012, 1501143726),
(46, '', 'CB3101', '', 'CB3101', 'NDT0046', 0, 260000000, 0, '0', '0', '2', 1, 1501059044, 1501164228),
(47, '', 'CB3110', '', 'CB3110', 'NDT0047', 2000000, 100000000, 0, '0', '0', '2', 1, 1501059089, 1501143904),
(48, '', 'CB0113', '', 'CB0113', 'NDT0048', 0, 100000000, 0, '0', '0', '2', 1, 1501059114, 0),
(49, '', 'DA1014', '', 'DA1014', 'NDT0049', 0, 100000000, 0, '0', '0', '2', 1, 1501059140, 0),
(50, '', 'DA4101', '', 'DA4101', 'NDT0050', 2000000, 112000000, 0, '0', '0', '2', 1, 1501059167, 1501165509),
(51, '', 'DA4110', '', 'DA4110', 'NDT0051', 0, 150000000, 0, '0', '0', '2', 1, 1501059194, 0),
(52, '', 'DA0114', '', 'DA0114', 'NDT0052', 0, 150000000, 0, '0', '0', '2', 1, 1501059241, 0),
(53, '', 'DB1014', '', 'DB1014', 'NDT0053', 2000000, 50000000, 0, '0', '0', '2', 1, 1501059268, 1501158696),
(54, '', 'DB4101', '', 'DB4101', 'NDT0054', 2000000, 200000000, 0, '0', '0', '2', 1, 1501059310, 1501139838),
(55, '', 'DB4110', '', 'DB4110', 'NDT0055', 2000000, 50000000, 0, '0', '0', '2', 1, 1501059335, 1501163011),
(56, '', 'DB0114', '', 'DB0114', 'NDT0056', 0, 50000000, 0, '0', '0', '2', 1, 1501059361, 0),
(57, '', 'EA1015', '', 'EA1015', 'NDT0057', 0, 150000000, 0, '0', '0', '2', 1, 1501059388, 0),
(58, '', 'EA5101', '', 'EA5101', 'NDT0058', 0, 50000000, 0, '0', '0', '2', 1, 1501059413, 0),
(59, '', 'EA5110', '', 'EA5110', 'NDT0059', 0, 58000000, 0, '0', '0', '2', 1, 1501059439, 0),
(60, '', 'EA0115', '', 'EA0115', 'NDT0060', 0, 50000000, 0, '0', '0', '2', 1, 1501059620, 0),
(61, '', 'EB1015', '', 'EB1015', 'NDT0061', 0, 100000000, 0, '0', '0', '2', 1, 1501059653, 0),
(62, '', 'EB5101', '', 'EB5101', 'NDT0062', 0, 200000000, 0, '0', '0', '2', 1, 1501059678, 0),
(63, '', 'EB5110', '', 'EB5110', 'NDT0063', 0, 200000000, 0, '0', '0', '2', 1, 1501059704, 1501146588),
(64, '', 'EB0115', '', 'EB0115', 'NDT0064', 0, 200000000, 0, '0', '0', '2', 1, 1501059747, 1501139755),
(65, '', 'FA1016', '', 'FA1016', 'NDT0065', 0, 120000000, 0, '0', '0', '2', 1, 1501059779, 0),
(66, '', 'FA6101', '', 'FA6101', 'NDT0066', 0, 500000000, 0, '0', '0', '2', 1, 1501059802, 0),
(67, '', 'FA6110', '', 'FA6110', 'NDT0067', 2000000, 100000000, 0, '0', '0', '2', 1, 1501059836, 1501153280),
(68, '', 'FA0116', '', 'FA0116', 'NDT0068', 0, 112280000, 0, '0', '0', '2', 1, 1501059864, 0),
(69, '', 'BB1012', '', 'BB1012', 'NDT0069', 2000000, 50000000, 0, '0', '0', '2', 1, 1501060739, 1501147340),
(70, '', 'FB1016', '', 'FB1016', 'NDT0070', 0, 200000000, 0, '0', '0', '2', 1, 1501081752, 1501116007),
(72, '', 'AA1011', '', 'AA1011', 'NDT0072', 2000000, 50000000, 50000000, '0', '0', '2', 1, 1501129487, 1501164357),
(73, '', 'AA1101', '', 'AA1101', 'NDT0073', 0, 100000000, 0, '0', '0', '2', 1, 1501129526, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
