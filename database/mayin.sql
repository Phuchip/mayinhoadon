-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2021 at 11:09 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mayin`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
`id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `sapo` text NOT NULL,
  `create_time` int(50) NOT NULL,
  `modify_time` int(50) NOT NULL,
  `status` int(11) NOT NULL,
  `delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `name`, `phone`, `email`, `image`, `address`, `sapo`, `create_time`, `modify_time`, `status`, `delete`) VALUES
(1, 'admin', '25d55ad283aa400af464c76d713c07ad', ' Administrator', '', '', '', '', '', 0, 0, 1, 0),
(6, 'phuchip', '25d55ad283aa400af464c76d713c07ad', 'Phúc Híp', '0912870820', 'buiphuc044@gmail.com', '', '68 ngõ 151 Nguyễn Đức Cảnh', 'Đây là phúc', 1639445942, 1640320007, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_time` int(50) NOT NULL,
  `modify_time` int(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`, `created_time`, `modify_time`, `status`) VALUES
(1, 'Máy in Đơn truyền nhiệt', 1638954424, 1638954424, 1),
(2, 'Máy in Kim', 1638954424, 1639189225, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE IF NOT EXISTS `tbl_comments` (
`id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `isAdmin` int(11) NOT NULL,
  `gender` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL,
  `comment` text NOT NULL,
  `images` text NOT NULL,
  `created_time` varchar(50) NOT NULL,
  `modify_time` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_comments`
--

INSERT INTO `tbl_comments` (`id`, `id_product`, `parent`, `isAdmin`, `gender`, `name`, `email`, `phone`, `ip_address`, `rate`, `comment`, `images`, `created_time`, `modify_time`, `status`) VALUES
(1, 6, 0, 0, 1, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', '::1', 5, 'test thử ', '', '1640685298', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_connector`
--

CREATE TABLE IF NOT EXISTS `tbl_connector` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_time` int(50) NOT NULL,
  `modify_time` int(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_connector`
--

INSERT INTO `tbl_connector` (`id`, `name`, `created_time`, `modify_time`, `status`) VALUES
(1, 'Cổng USB', 1638954424, 1638954424, 1),
(2, 'Cổng USB + LAN', 1638954424, 1638954424, 1),
(3, 'Bluetooth - in không dây', 1638954424, 1638954424, 1),
(4, 'Cổng Lan', 1638954424, 1638954424, 1),
(5, 'Cổng USB + Wifi', 1638954424, 1638954424, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_order`
--

CREATE TABLE IF NOT EXISTS `tbl_detail_order` (
`id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(100) NOT NULL,
  `created_time` varchar(100) NOT NULL,
  `modify_time` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_detail_order`
--

INSERT INTO `tbl_detail_order` (`id`, `id_order`, `id_product`, `quantity`, `price`, `created_time`, `modify_time`, `status`) VALUES
(1, 1, 4, 3, '2.790.000', '1639628713', '1639628713', 1),
(2, 1, 3, 1, '3.457.000', '1639628713', '1639628713', 1),
(3, 2, 3, 3, '3.457.000', '1639629024', '1639629024', 1),
(4, 2, 4, 4, '2.790.000', '1639629024', '1639629024', 1),
(5, 3, 4, 6, '2.790.000', '1639629073', '1639629073', 1),
(6, 4, 6, 2, '3.818.000', '1639629121', '1639629121', 1),
(7, 4, 5, 4, '2.380.000', '1639629121', '1639629121', 1),
(8, 5, 3, 1, '3.457.000', '1639638189', '1639638189', 1),
(9, 5, 1, 4, '2.237.000', '1639638189', '1639638189', 1),
(10, 6, 1, 1, '2.424.000', '1640135441', '1640135441', 1),
(11, 7, 4, 3, '3.100.000', '1640421077', '1640421077', 1),
(12, 8, 5, 2, '2.380.000', '1640505306', '1640505306', 1),
(13, 8, 6, 1, '3.818.000', '1640505307', '1640505307', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manufacturer`
--

CREATE TABLE IF NOT EXISTS `tbl_manufacturer` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_time` int(50) NOT NULL,
  `modify_time` int(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_manufacturer`
--

INSERT INTO `tbl_manufacturer` (`id`, `name`, `created_time`, `modify_time`, `status`) VALUES
(1, 'ANTEC', 1638954424, 1638954424, 1),
(2, 'ANTECH', 1638954424, 1638954424, 1),
(3, 'APOS', 1638954424, 1638954424, 1),
(4, 'ROCO', 1638954424, 1639187093, 1),
(5, 'EPSON', 1638954424, 1639187105, 1),
(6, 'XPRINTER', 1638954424, 1639187119, 1),
(8, 'Cannon', 1639187147, 1639188486, 1),
(9, 'HP', 1639469983, 1639469983, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_modules`
--

CREATE TABLE IF NOT EXISTS `tbl_modules` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `alias` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_modules`
--

INSERT INTO `tbl_modules` (`id`, `name`, `alias`) VALUES
(1, 'Sản phẩm', 'san-pham'),
(2, 'Hãng sản xuất', 'hang-san-xuat'),
(3, 'Loại máy in', 'loai-may-in'),
(4, 'Đơn hàng', 'cong-ket-noi'),
(5, 'Khổ giấy', 'kho-giay'),
(6, 'Đơn hàng', 'don-hang'),
(7, 'Bình luận', 'binh-luan'),
(8, 'Quản lý tài khoản', 'tai-khoan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `ship_name` varchar(255) NOT NULL,
  `ship_phone` varchar(50) NOT NULL,
  `ship_address` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` varchar(50) NOT NULL,
  `created_time` int(50) NOT NULL,
  `modify_time` int(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `name`, `email`, `phone`, `address`, `ship_name`, `ship_phone`, `ship_address`, `note`, `quantity`, `total`, `created_time`, `modify_time`, `status`, `delete`) VALUES
(1, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', 'Phúc Híp', '0912870820', '68 ngọc hồi', 'a', 4, '11.827.000', 1639628713, 1639628713, 1, 0),
(2, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', 'Phúc Híp', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', 'Ship nhanh nhé', 7, '21.531.000', 1639629024, 1639629024, 1, 0),
(3, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', 'Phúc Híp', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', '', 6, '16.74.000', 1639629073, 1639629073, 1, 0),
(4, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', 'Phúc Híp', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', '', 6, '17.156.000', 1639629121, 1639629121, 1, 0),
(5, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', 'Phúc Híp', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', '', 5, '12.405.000', 1639638189, 1639638189, 1, 0),
(6, 'Nguyễn Quang Huy', 'nqhuy160720@gmail.com', '0349688482', '22', 'Nguyễn Quang Huy', '0349688482', '22', 'ádsadsad', 1, '2.424.000', 1640135441, 1640135441, 1, 0),
(7, 'Phúc Híp', 'buiphuc044@gmail.com', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', 'Phúc Híp', '0912870820', '68 ngõ 151 Nguyễn Đức Cảnh', '', 3, '9.300.000', 1640421077, 1640421077, 1, 0),
(8, 'Phuc Bui', 'buiphuc044@gmail.com', '0912870820', 'Hà Nội ', 'Phuc Bui', '0912870820', 'Hà Nội ', '', 3, '8.578.000', 1640505306, 1640505306, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paper_size`
--

CREATE TABLE IF NOT EXISTS `tbl_paper_size` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_time` int(50) NOT NULL,
  `modify_time` int(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_paper_size`
--

INSERT INTO `tbl_paper_size` (`id`, `name`, `created_time`, `modify_time`, `status`) VALUES
(1, 'K80 (80mm)', 1638954424, 1639358692, 1),
(2, 'K58 (57MM)', 1638954424, 1639358778, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
`id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `alias` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `price_old` varchar(50) NOT NULL,
  `discount` float NOT NULL,
  `code_product` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `des_images` text NOT NULL COMMENT 'Ảnh mô tả sản phẩm',
  `insurance` int(11) NOT NULL COMMENT 'Bảo hành',
  `view` int(11) NOT NULL,
  `category` varchar(50) NOT NULL COMMENT 'Loại máy in',
  `manufacturer` varchar(50) NOT NULL COMMENT 'Hãng sản xuất',
  `connector` varchar(50) NOT NULL COMMENT 'Cổng kết nối',
  `paper_size` varchar(50) NOT NULL COMMENT 'Khổ giấy',
  `rate` float NOT NULL,
  `total_rate` int(11) NOT NULL,
  `review_product` text NOT NULL COMMENT 'Đánh giá sản phẩm',
  `cong_nghe` varchar(255) NOT NULL,
  `do_phan_giai` varchar(255) NOT NULL,
  `kho_in` varchar(100) NOT NULL,
  `toc_do` varchar(50) NOT NULL COMMENT 'Tốc độ in tối đa',
  `kho_giay_in` varchar(100) NOT NULL,
  `mo_ta` varchar(255) NOT NULL,
  `thuong_hieu` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `tinh_nang` text NOT NULL,
  `ket_noi` varchar(255) NOT NULL,
  `toc_do_in` varchar(50) NOT NULL,
  `kich_co` varchar(100) NOT NULL,
  `trong_luong` varchar(50) NOT NULL,
  `xuat_xu` varchar(50) NOT NULL,
  `bao_hanh` varchar(100) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `contact` int(5) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `created_time` int(11) NOT NULL,
  `modify_time` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `name`, `alias`, `image`, `price_old`, `discount`, `code_product`, `quantity`, `des_images`, `insurance`, `view`, `category`, `manufacturer`, `connector`, `paper_size`, `rate`, `total_rate`, `review_product`, `cong_nghe`, `do_phan_giai`, `kho_in`, `toc_do`, `kho_giay_in`, `mo_ta`, `thuong_hieu`, `model`, `tinh_nang`, `ket_noi`, `toc_do_in`, `kich_co`, `trong_luong`, `xuat_xu`, `bao_hanh`, `tag`, `contact`, `title`, `description`, `keyword`, `created_time`, `modify_time`, `status`, `delete`) VALUES
(1, 'HPRT TP80BE CÓ DRIVER MACBOOK', 'hprt-tp80be-co-driver-macbook', 'hprt-tp80be-co-driver-macbook/hprt-tp80be-co-driver-macbook.png', '3.729.000', 35, 'INTR30', 25, 'hprt-tp80be-co-driver-macbook/hprt-tp80be-co-driver-macbook-0.png,hprt-tp80be-co-driver-macbook/hprt-tp80be-co-driver-macbook-1.png,hprt-tp80be-co-driver-macbook/hprt-tp80be-co-driver-macbook-2.png', 24, 211, '1', '9', '5,4,3', '2', 5, 1, '<p>&nbsp;</p>\r\n\r\n<p><strong>M&aacute;y in HPRT TP80BE</strong></p>\r\n\r\n<p>C&oacute; khả năng in hiệu suất cao với mức gi&aacute; phải chăng. Mang lại bản in chất lượng cao c&ugrave;ng với khả năng in từ điện thoại.<br />\r\nChất lượng huyền thoại, gi&aacute; cả phải chăng đến kh&ocirc;ng ngờ<br />\r\nM&aacute;y in laze nhỏ m&agrave; c&oacute; v&otilde;, chất lượng vượt trội, nhất qu&aacute;n. Cho ra m&agrave;u đen đậm v&agrave; văn bản cũng như đồ họa sắc n&eacute;t. An t&acirc;m với m&aacute;y in laser c&oacute; hiệu suất cao v&agrave; mức gi&aacute; phải chăng.<br />\r\nTốc độ in l&ecirc;n đến 20 trang/ph&uacute;t.&nbsp;<br />\r\nChất lượng in đen (tốt nhất) l&ecirc;n tới tối đa 1.200 x 1.200 dpi</p>\r\n\r\n<p style="text-align:center"><img alt="" height="363" src="http://localhost:8182/pictures/images/Rectangle%20156(1).png" width="638" /></p>\r\n\r\n<p><strong><span style="white-space:pre-wrap;">Thiết kể nhỏ gọn, dễ d&agrave;ng sử dụng </span></strong></p>\r\n\r\n<p>Được thiết kế để vừa với kh&ocirc;ng gian của bạn</p>\r\n\r\n<p>Bạn c&oacute; thể đặt chiếc m&aacute;y in nhỏ gọn n&agrave;y ở gần như mọi chỗ.</p>\r\n\r\n<p>Dễ d&agrave;ng in tr&ecirc;n thiết bị di động với ứng dụng HP Smart</p>\r\n\r\n<p>C&oacute; được thiết lập đơn giản, in ấn từ điện thoại của bạn với ứng dụng HP Smart.</p>\r\n\r\n<p>Dễ d&agrave;ng in từ nhiều loại điện thoại th&ocirc;ng minh v&agrave; m&aacute;y t&iacute;nh bảng.<br />\r\nDễ d&agrave;ng chia sẻ t&agrave;i nguy&ecirc;n &ndash; truy cập v&agrave; in bằng c&aacute;ch kết nối mạng kh&ocirc;ng d&acirc;y</p>\r\n\r\n<p style="text-align:center"><img alt="" height="360" src="http://localhost:8182/pictures/images/Rectangle%20157.png" width="636" /></p>\r\n', 'In nhiệt trực tiếp', '03dpi, 8dots/mm', '48/76 mm', '', '', '', 'HPRT', 'TP80BE', 'Công nghệ: In nhiệt trực tiếp|Độ phân giải: 203dpi, 8dots/mm|Khổ in: 48/76 mm|Tốc độ in (Tối đa): 230 mm/second|Khổ giấy in: 58mm/80mm (±1mm)|Đường kính cuộn giấy (Tối đa): 83mm (±1mm)|Ram/Flash: 2Mb/4Mb|Tự động cắt giấy: Có', 'Có Driver cho Macbook - kết nối USB + LAN', '230 mm/second', '164 (L) x 141 (W) x 127 (H) mm', '1.64 kg', 'Trung Quốc', '24 tháng cho toàn bộ thân máy - đầu in - adapter', '1,5', 1, 'MÁY IN HÓA ĐƠN HPRT TP80BE CÓ DRIVER MACBOOK', 'Có khả năng in hiệu suất cao với mức giá phải chăng. Mang lại bản in chất lượng cao cùng với khả năng in từ điện thoại.', 'MÁY IN HÓA ĐƠN HPRT TP80BE CÓ DRIVER MACBOOK', 1640578817, 1640600564, 1, 0),
(3, 'Laser trắng đen CANON LBP 2900', 'may-in-laser-trang-den-canon-lbp-2900', 'may-in-laser-trang-den-canon-lbp-2900/may-in-laser-trang-den-canon-lbp-2900.png', '4.609.000', 25, 'INTR31', 12, 'may-in-laser-trang-den-canon-lbp-2900/may-in-laser-trang-den-canon-lbp-2900-0.png,may-in-laser-trang-den-canon-lbp-2900/may-in-laser-trang-den-canon-lbp-2900-1.png,may-in-laser-trang-den-canon-lbp-2900/may-in-laser-trang-den-canon-lbp-2900-2.png', 24, 55, '1', '8', '5,1', '1', 0, 0, '<p style="margin-bottom: 1rem; font-family: Roboto, sans-serif; font-size: 14px;">Với thiết kế nhỏ gọn nhưng mạnh mẽ,&nbsp;<span style="font-weight: bolder;">M&aacute;y in laser trắng đen CANON LBP 2900</span>&nbsp;rất ph&ugrave; hợp với văn ph&ograve;ng l&agrave;m việc diện t&iacute;ch nhỏ. M&aacute;y được trang bị đầy đủ những t&iacute;nh năng ưu việt của một&nbsp;m&aacute;y in&nbsp;văn ph&ograve;ng. Nhớ đ&oacute; Laser&nbsp;Canon&nbsp;LBP-2900 c&oacute; thể đem đến cho bạn những bản in ho&agrave;n hảo trong thời gian cực ngắn, chất lượng laser, độ ph&acirc;n giải cao l&ecirc;n tới 2400 x 600 dpi, v&agrave; thao t&aacute;c in kh&ocirc;ng bị kẹt giấy.</p>\r\n\r\n<p style="margin-bottom: 1rem; font-family: Roboto, sans-serif; font-size: 14px;"><img alt="" height="600" src="http://localhost:8182/pictures/images/43867_prl_hp_1000a_4ry22a_c.jpg" width="600" /></p>\r\n\r\n<p style="margin-bottom: 1rem; font-family: Roboto, sans-serif; font-size: 14px;">&nbsp;</p>\r\n\r\n<h3 style="margin-top: 0px; margin-bottom: 0.5rem; font-weight: 500; line-height: 1.3; font-size: 16px; color: rgb(51, 51, 51); font-family: Roboto, sans-serif;">Đặc điểm m&aacute;y in laser trắng đen CANON LBP 2900</h3>\r\n\r\n<ul style="padding-left: 2rem; margin-bottom: 1rem; font-family: Roboto, sans-serif; font-size: 14px;">\r\n	<li>Thiết kế hiện đại, sang trọng, lớp sơn ngo&agrave;i sạch sẽ v&agrave; đặc biệt l&agrave; nhỏ gọn, &iacute;t tốn diện t&iacute;ch nơi đặt</li>\r\n	<li>M&aacute;y sở hữu c&ocirc;ng nghệ in ti&ecirc;n tiến của&nbsp;Canon&nbsp;l&agrave; CAPT, kiến th&uacute;c n&eacute;n th&ocirc;ng minh Hi-ScoA cho tốc độ in nhanh, chất lượng tốt</li>\r\n	<li>Thời gian l&agrave;m n&oacute;ng m&aacute;y nhanh n&ecirc;n bạn kh&ocirc;ng phải chờ đợi l&acirc;u</li>\r\n</ul>\r\n\r\n<h3 style="margin-top: 0px; margin-bottom: 0.5rem; font-weight: 500; line-height: 1.3; font-size: 16px; color: rgb(51, 51, 51); font-family: Roboto, sans-serif;">Chi tiết t&iacute;nh năng&nbsp;m&aacute;y in laser trắng đen CANON LBP 2900</h3>\r\n\r\n<h4 style="margin-top: 0px; margin-bottom: 0.5rem; font-weight: 500; line-height: 1.3; font-size: 14px; color: rgb(51, 51, 51); font-family: Roboto, sans-serif;">THIẾT KẾ HIỆN ĐẠI</h4>\r\n\r\n<p style="margin-bottom: 1rem; font-family: Roboto, sans-serif; font-size: 14px;"><span style="font-weight: bolder;">M&aacute;y in laser trắng đen CANON LBP 2900</span>&nbsp;được thiết kế nhỏ gọn, hiện đại, ph&ugrave; hợp với những văn ph&ograve;ng vừa v&agrave; nhỏ. Lớp vỏ m&agrave;u trắng trang nh&atilde; th&iacute;ch nghi với nhiều kh&ocirc;ng gian v&agrave; gi&uacute;p bạn dễ d&agrave;ng ph&aacute;t hiện vết bẩn để vệ sinh, lau ch&ugrave;i.</p>\r\n\r\n<p style="margin-bottom: 1rem; font-family: Roboto, sans-serif; font-size: 14px;">&nbsp;</p>\r\n\r\n<h4 style="margin-top: 0px; margin-bottom: 0.5rem; font-weight: 500; line-height: 1.3; font-size: 14px; color: rgb(51, 51, 51); font-family: Roboto, sans-serif;">IN KHỔ A4 TỐC ĐỘ NHANH</h4>\r\n\r\n<p style="margin-bottom: 1rem; font-family: Roboto, sans-serif; font-size: 14px;"><span style="font-weight: bolder;">M&aacute;y in laser trắng đen CANON LBP 2900</span>&nbsp;với tốc độ in nhanh 12 trang A4 mỗi ph&uacute;t v&agrave; 2400 x 600 dpi,&nbsp;Canon&nbsp;LBP-2900 mang lại cả tốc độ v&agrave; chất lượng trong c&ugrave;ng một thiết bị. Bạn c&oacute; thể in c&aacute;c văn bản, t&agrave;i liệu thuyết tr&igrave;nh &hellip; đen trắng một c&aacute;ch r&otilde; n&eacute;t trong thởi gian ngắn.</p>\r\n\r\n<h4 style="margin-top: 0px; margin-bottom: 0.5rem; font-weight: 500; line-height: 1.3; font-size: 14px; color: rgb(51, 51, 51); font-family: Roboto, sans-serif;">KHẢ NĂNG XỬ L&Yacute; CAPT 2.1</h4>\r\n\r\n<p style="margin-bottom: 1rem; font-family: Roboto, sans-serif; font-size: 14px;">Nhờ vận dụng sức mạnh từ c&ocirc;ng nghệ in ti&ecirc;n tiến của&nbsp;Canon&nbsp;(CAPT) v&agrave; kiến tr&uacute;c n&eacute;n th&ocirc;ng minh (Hi-ScoA),&nbsp;<span style="font-weight: bolder;">m&aacute;y in laser trắng đen CANON LBP 2900</span>&nbsp;c&oacute; thể xử l&yacute; c&aacute;c dữ liệu h&igrave;nh ảnh nhanh hơn c&aacute;c&nbsp;m&aacute;y in&nbsp;th&ocirc;ng thường. Gi&uacute;p tốc độ in si&ecirc;u cao m&agrave; kh&ocirc;ng tốn chi ph&iacute; n&acirc;ng cấp bộ nhớ&nbsp;m&aacute;y in.</p>\r\n\r\n<p style="margin-bottom: 1rem; font-family: Roboto, sans-serif; font-size: 14px;">&nbsp;</p>\r\n\r\n<h4 style="margin-top: 0px; margin-bottom: 0.5rem; font-weight: 500; line-height: 1.3; font-size: 14px; color: rgb(51, 51, 51); font-family: Roboto, sans-serif;">BẢN IN ĐẦU NHANH SAU 9 GI&Acirc;Y</h4>\r\n\r\n<p style="margin-bottom: 1rem; font-family: Roboto, sans-serif; font-size: 14px;">Nhanh ch&oacute;ng c&oacute; kết quả in với chất lượng cao m&agrave; kh&ocirc;ng mất thời gian chờ đợi, đ&oacute; l&agrave; nhờ c&ocirc;ng nghệ sấy theo nhu cầu độc quyền của&nbsp;Canon, gi&uacute;p truyền nhiệt ngay khi được k&iacute;ch hoạt. Điều n&agrave;y gi&uacute;p t&agrave;i liệu được in nhanh hơn v&agrave; gi&uacute;p bạn tiết kiệm chi ph&iacute; năng lượng.</p>\r\n', 'In nhiệt trực tiếp', '2400 x 600 dpi', 'A4, B5, A5, LGL, LTR, Executive, Giấy in bì thư C5/COM10/DL, Monarch', '12 ppm (Độ phủ 5%)', '58mm/80mm (±1mm)', 'Hệ điều hành hỗ trợ :  Windows 98/ME/2000/XP/7/10, Linux (CUPS)', 'CANON', 'LBP 2900', '', 'Cổng USB 2.0 tốc độ cao', '12 ppm (Độ phủ 5%)', '164 (L) x 141 (W) x 127 (H) mm', '1.64 kg', 'Trung Quốc', '24 tháng cho toàn bộ thân máy - đầu in - adapter', '1,3,5', 0, '', '', '', 1639469018, 1639469468, 1, 0),
(4, 'Phun màu EPSON L805', 'may-in-phun-mau-epson-l805', 'may-in-phun-mau-epson-l805/may-in-phun-mau-epson-l805.png', '3.100.000', 0, 'INTR32', 4, 'may-in-phun-mau-epson-l805/may-in-phun-mau-epson-l805-0.png,may-in-phun-mau-epson-l805/may-in-phun-mau-epson-l805-1.png,may-in-phun-mau-epson-l805/may-in-phun-mau-epson-l805-2.png', 12, 344, '1', '8', '5,4', '2', 0, 0, '<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><strong>M&aacute;y in laser Canon LBP6030</strong>&nbsp;l&agrave; một sản phẩm mới của&nbsp;<a href="https://www.phucanh.vn/may-in-canon.html" style="color: rgb(0, 0, 255);" title="Máy in Canon tại Phúc Anh">Canon</a>, với ti&ecirc;u ch&iacute; nhỏ gọn ph&ugrave; hợp với mọi kh&ocirc;ng gian văn ph&ograve;ng, nhưng vẫn duy tr&igrave; được hiệu suất hoạt động cao v&agrave; tiết kiệm năng lượng.&nbsp;<a href="https://www.phucanh.vn/may-in-theo-hang.html?filter=%2C24322%2C" style="color: rgb(0, 0, 255);" title="Máy in laser đen trắng tại Phúc Anh">Máy in laser đen trắng</a>&nbsp;n&agrave;y ho&agrave;n to&agrave;n c&oacute; thể đ&aacute;p ứng nhu cầu l&agrave;m việc của bạn.</p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;">&nbsp;</p>\r\n\r\n<h3 style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; text-align: justify;">Ph&ugrave; hợp nhiều kh&ocirc;ng gian</h3>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><strong>Máy in laser đen trắng Canon LBP6030&nbsp;</strong>sở hữu&nbsp;thiết kế&nbsp;hiện đại&nbsp;đi c&ugrave;ng t&ocirc;ng m&agrave;u trắng sang trọng sẽ mang lại t&iacute;nh thẩm mỹ cao cho kh&ocirc;ng gian l&agrave;m việc của bạn. Kiểu d&aacute;ng nhỏ gọn gi&uacute;p bạn dễ d&agrave;ng di chuyển v&agrave; lắp đặt&nbsp;<a href="https://www.phucanh.vn/may-in-theo-hang.html" style="color: rgb(0, 0, 255);" title="Máy in tại Phúc Anh">m&aacute;y in</a>&nbsp;tại nhiều vị tr&iacute; trong văn ph&ograve;ng l&agrave;m việc.</p>\r\n\r\n<h3 style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; text-align: justify;">Đ&aacute;p ứng hiệu quả c&ocirc;ng việc cao</h3>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><a href="https://www.phucanh.vn/may-in-canon.html?filter=%2C24322%2C" style="color: rgb(0, 0, 255);" title="Máy in laser trắng đen&nbsp;Canon tại Phúc Anh">M&aacute;y in laser Canon</a>&nbsp;n&agrave;y&nbsp;c&oacute; tốc độ hoạt động l&ecirc;n tới 18 trang/ph&uacute;t c&ugrave;ng&nbsp;tổng c&ocirc;ng suất tối đa 5.000 trang/th&aacute;ng, đ&aacute;p ứng được hiệu quả c&ocirc;ng việc cường độ cao&nbsp;của văn ph&ograve;ng bạn. Với độ ph&acirc;n giải 600 x 600 dpi sẽ in ra những trang t&agrave;i liệu c&oacute; r&otilde; n&eacute;t, kh&ocirc;ng bị mờ nh&ograve;e chữ. Chất lượng bản in cho ra từ&nbsp;<strong>m&aacute;y in laser Canon LBP6030</strong>&nbsp;dễ nh&igrave;n, r&otilde; n&eacute;t gi&uacute;p bạn tự tin khi đưa bản thảo tới đối t&aacute;c, đồng nghiệp.</p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><img alt="" height="1002" src="http://localhost:8182/pictures/images/17768_canon_lbp_6030___2_.jpg" width="1000" /></p>\r\n\r\n<h3 style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; text-align: justify;">Thuận tiện khi in ấn</h3>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><strong>M&aacute;y in laser Canon LBP6030</strong>&nbsp;c&oacute; khay giấy ti&ecirc;u chuẩn 150 tờ, tiện lợi trong qu&aacute; tr&igrave;nh l&agrave;m việc. Thiết kế chống kẹt giấy th&ocirc;ng minh sẽ giảm thiểu đến mức thấp nhất t&igrave;nh trạng kẹt giấy, gi&uacute;p c&ocirc;ng việc của bạn&nbsp;được th&ocirc;ng suốt.</p>\r\n\r\n<h3 style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; text-align: justify;">C&ocirc;ng nghệ sấy theo nhu cầu</h3>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><strong>C&ocirc;ng nghệ sấy</strong>&nbsp;theo nhu cầu độc quyền của Canon gi&uacute;p m&aacute;y l&agrave;m n&oacute;ng c&aacute;c bộ phận nhanh hơn v&agrave; ti&ecirc;u hao &iacute;t năng lượng so với thiết kế cuộn sấy truyền thống, v&igrave; vậy sẽ l&agrave;m n&oacute;ng m&aacute;y nhanh hơn v&agrave; nhanh ch&oacute;ng thực hiện bản in đầu ti&ecirc;n.</p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><img alt="" height="1002" src="http://localhost:8182/pictures/images/17768_canon_lbp_6030___3_.jpg" width="1000" /></p>\r\n\r\n<h3 style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; text-align: justify;">Kết nối in nhanh ch&oacute;ng</h3>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><strong>Canon LBP6030</strong>&nbsp;kết nối nhanh ch&oacute;ng để in nhờ cổng USB được trang bị tr&ecirc;n m&aacute;y gi&uacute;p bạn kết nối m&aacute;y in với&nbsp;<a href="https://www.phucanh.vn/may-tinh-de-ban.html" style="color: rgb(0, 0, 255);" title="Máy tính để bàn tại Phúc Anh">m&aacute;y t&iacute;nh</a>&nbsp;v&agrave; c&aacute;c thiết bị kh&aacute;c dễ d&agrave;ng, thao t&aacute;c in nhanh ch&oacute;ng v&agrave; tiện lợi</p>\r\n\r\n<h3 style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; text-align: justify;">Tiết kiệm điện năng ti&ecirc;u thụ.</h3>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;">Chế độ chờ v&agrave; tắt m&aacute;y tự động, kết hợp với c&ocirc;ng nghệ sấy ti&ecirc;n tiến, gi&uacute;p&nbsp;<strong>m&aacute;y in Laser Canon LBP6030</strong>&nbsp;tiết kiệm cho doanh nghiệp, vừa ti&ecirc;u hao điện năng thấp vừa g&oacute;p phần bảo vệ m&ocirc;i trường vẫn đ&aacute;p ứng nhu cầu l&agrave;m việc.</p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;">Tới&nbsp;<span style="color: rgb(0, 0, 255);"><strong><a href="https://www.phucanh.vn/" style="color: rgb(0, 0, 255);">Ph&uacute;c Anh</a></strong></span>&nbsp;để được tư vấn v&agrave; sở hữu c&aacute;c sản phẩm c&ocirc;ng nghệ,&nbsp;<span style="color: rgb(0, 0, 255);"><strong><a href="https://www.phucanh.vn/laptop.html" style="color: rgb(0, 0, 255);">laptop</a>,&nbsp;<a href="https://www.phucanh.vn/may-tinh-de-ban.html" style="color: rgb(0, 0, 255);">PC</a>,&nbsp;<a href="https://www.phucanh.vn/camera-theo-hang.html" style="color: rgb(0, 0, 255);">camera,</a>&nbsp;<a href="https://www.phucanh.vn/linh-kien-pc-lap-rap.html" style="color: rgb(0, 0, 255);">linh kiện m&aacute;y t&iacute;nh</a>,&nbsp;<a href="https://www.phucanh.vn/thiet-bi-van-phong.html" style="color: rgb(0, 0, 255);">thiết bị văn ph&ograve;ng</a></strong></span>,... ch&iacute;nh h&atilde;ng, uy t&iacute;n c&ugrave;ng chất lượng dịch vụ tốt nhất hiện nay.</p>\r\n', 'In nhiệt trực tiếp', '03dpi, 8dots/mm', '48/76 mm', '12 ppm (Độ phủ 5%)', '58mm/80mm (±1mm)', '', 'CANON', 'LBP6030', 'Công nghệ: In nhiệt trực tiếp|Độ phân giải: 203dpi, 8dots/mm|Khổ in: 48/76 mm|Tốc độ in (Tối đa): 230 mm/second|Khổ giấy in: 58mm/80mm (±1mm)|Đường kính cuộn giấy (Tối đa): 83mm (±1mm)|Ram/Flash: 2Mb/4Mb|Tự động cắt giấy: Có', 'Có Driver cho Macbook - kết nối USB + LAN', '230 mm/second', '164 (L) x 141 (W) x 127 (H) mm', '1.64 kg', 'Trung Quốc', '12 tháng cho toàn bộ thân máy - đầu in - adapter', '1,2,5', 0, '', '', '', 1639469875, 1639707138, 1, 0),
(5, 'laser đen trắng HP LaserJet Pro M12W - T0L46A', 'may-in-laser-den-trang-hp-laserjet-pro-m12w-t0l46a', 'may-in-laser-den-trang-hp-laserjet-pro-m12w-t0l46a/may-in-laser-den-trang-hp-laserjet-pro-m12w-t0l46a.png', '2.800.000', 15, 'INTR33', 23, 'may-in-laser-den-trang-hp-laserjet-pro-m12w-t0l46a/may-in-laser-den-trang-hp-laserjet-pro-m12w-t0l46a-0.png,may-in-laser-den-trang-hp-laserjet-pro-m12w-t0l46a/may-in-laser-den-trang-hp-laserjet-pro-m12w-t0l46a-1.png,may-in-laser-den-trang-hp-laserjet-pro-m12w-t0l46a/may-in-laser-den-trang-hp-laserjet-pro-m12w-t0l46a-2.png,may-in-laser-den-trang-hp-laserjet-pro-m12w-t0l46a/may-in-laser-den-trang-hp-laserjet-pro-m12w-t0l46a-3.png', 24, 239, '1', '9', '4,3', '2', 0, 0, '<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;">sở hữu chất lượng đ&aacute;ng tin cậy v&agrave; văn bản đen sắc n&eacute;t với gi&aacute; th&agrave;nh hợp l&yacute;. In nhanh ch&oacute;ng v&agrave; dễ d&agrave;ng với chiếc m&aacute;y in nhỏ gọn cho kh&ocirc;ng gian l&agrave;m việc. In từ hầu hết mọi nơi v&agrave; c&agrave;i đặt đơn giản tr&ecirc;n điện thoại của bạn.</p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><img alt="" height="600" src="http://localhost:8182/pictures/images/38098_hp_107w__ha1.jpg" width="600" /></p>\r\n\r\n<h3 style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; text-align: justify;">Ph&ugrave; hợp mọi kh&ocirc;ng gian văn ph&ograve;ng</h3>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><strong>HP 107W - 4ZB78A</strong>&nbsp;c&oacute; thiết kế ph&ugrave; hợp mọi kh&ocirc;ng gian. Bạn c&oacute; thể đặt&nbsp;<span style="color: rgb(0, 0, 255);"><a href="https://www.phucanh.vn/may-in-theo-hang.html" style="color: rgb(0, 0, 255);" title="Máy in theo hãng tại Phúc Anh">m&aacute;y in</a></span>&nbsp;nhỏ gọn n&agrave;y ở hầu hết mọi nơi trong văn ph&ograve;ng l&agrave;m việc. K&iacute;ch cỡ nhỏ gọn gi&uacute;p bạn dễ d&agrave;ng di chuyển v&agrave; tiết kiệm diện t&iacute;ch lắp đặt m&aacute;y.</p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><img alt="" height="600" src="http://localhost:8182/pictures/images/38098_hp_107w__ha2.jpg" width="600" /></p>\r\n\r\n<h3 style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; text-align: justify;">Chất lượng in sắc n&eacute;t</h3>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><strong>M&aacute;y in laser đen trắng HP 107W</strong>&nbsp;c&oacute; độ ph&acirc;n giải l&ecirc;n đến 1200x1200 dpi mang đến chất lượng in vượt trội, ổn định qua từng trang in cho bản in sắc n&eacute;t, chuy&ecirc;n nghiệp. Tạo n&ecirc;n những văn bản in đen trắng đậm n&eacute;t v&agrave; đồ họa sắc sảo.</p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><img alt="" height="600" src="http://localhost:8182/pictures/images/38098_hp_107w__ha3.jpg" width="600" /></p>\r\n\r\n<h3 style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; text-align: justify;">Hiệu suất in cao</h3>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;">Với tốc độ in 20 trang mỗi ph&uacute;t (A4) gi&uacute;p c&ocirc;ng việc in ấn của bạn trở n&ecirc;n nhanh ch&oacute;ng, tiết kiệm thời gian.&nbsp;<span style="color: rgb(0, 0, 255);"><a href="https://www.phucanh.vn/may-in-hp.html?filter=%2C24322%2C" style="color: rgb(0, 0, 255);" title="Máy in laser đen trắng HP tại Phúc Anh">M&aacute;y in laser đen trắng HP</a></span>&nbsp;được trang bị khay giấy đầu v&agrave;o 150 tờ v&agrave; đầu ra 100 tờ cho bạn trải nghiệm in li&ecirc;n tục m&agrave; kh&ocirc;ng mất thời gian th&ecirc;m giấy. Hơn nữa mỗi th&aacute;ng&nbsp;<span style="color: rgb(0, 0, 255);"><a href="https://www.phucanh.vn/may-in-laser-den-trang.html" style="color: rgb(0, 0, 255);" title="Máy in laser đen trắng tại Phúc Anh">m&aacute;y in laser đen trắng</a></span>&nbsp;c&oacute; số lượng in l&ecirc;n tới 1.500 trang, phục vụ đắc lực cho nhu cầu in ấn của bạn.</p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><img alt="" height="600" src="http://localhost:8182/pictures/images/38098_hp_107w__ha4.jpg" width="600" /></p>\r\n\r\n<h3 style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; text-align: justify;">In mọi l&uacute;c, mọi nơi</h3>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;">Kết nối kh&ocirc;ng gi&acirc;y được t&iacute;ch hợp tr&ecirc;n m&aacute;y in mang lại sự tiện lợi cho người sử dụng gi&uacute;p bạn c&oacute; thể in ngay cả khi đang di chuyển trong kh&ocirc;ng gian lắp đặt m&aacute;y.</p>\r\n', 'In nhiệt trực tiếp', '03dpi, 8dots/mm', '48/76 mm', '230 mm/second', '', '', 'HP', 'M12W - T0L46A', 'Tốc độ in màu đen (ISO, A4) : Lên đến 20 trang/phút|Trang ra đầu tiên đen (A4, sẵn sàng) : Nhanh 8,3 giây|Chu kỳ hoạt động (hàng tháng, A4): Lên đến 10.000 trang', 'Có Driver cho Macbook - kết nối USB + LAN', 'Tối đa 1.200 x 1.200 dpi', '331 x 350 x 248 mm', '4,16 kg', 'Sản xuất tại Trung Quốc (Hộp mực in laser màu đen ', '1 Năm', '3,9,10', 0, '', '', '', 1639470325, 1639724457, 1, 0),
(6, 'Epson LQ310', 'may-in-kim-epson-lq310', 'may-in-kim-epson-lq310/may-in-kim-epson-lq310.png', '5.090.000', 25, 'INTR34', 19, 'may-in-kim-epson-lq310/may-in-kim-epson-lq310-0.png,may-in-kim-epson-lq310/may-in-kim-epson-lq310-1.png,may-in-kim-epson-lq310/may-in-kim-epson-lq310-2.png,may-in-kim-epson-lq310/may-in-kim-epson-lq310-3.png', 24, 289, '2', '5', '5,2', '2', 5, 1, '<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><span style="font-size: 10pt;">L&agrave; nh&agrave; sản xuất m&aacute;y in kim h&agrave;ng đầu tr&ecirc;n thế giới, Epson vừa tr&igrave;nh l&agrave;ng&nbsp;<strong><span style="color: rgb(128, 0, 128);"><a href="https://www.phucanh.vn/may-in-kim-epson-lq310.html" style="color: rgb(128, 0, 128);">máy in kim Epson LQ310</a></span></strong>&nbsp;khổ hẹp 24 kim thay thế cho d&ograve;ng m&aacute;y LQ 300 huyền thoại, với tốc độ v&agrave; tuổi thọ cao hơn hẳn.</span></p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><span style="font-size: 10pt;"><img alt="" height="350" src="http://localhost:8182/pictures/images/14479_MayinkimEpsonLQ310-4.jpg" width="670" /></span></p>\r\n\r\n<h3 style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; text-align: justify;"><span style="color: rgb(0, 0, 255);"><strong><span style="font-size: 10pt;">Đặc điểm nổi bật của máy in kim Epson LQ310</span></strong></span></h3>\r\n\r\n<ol style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;">\r\n	<li style="padding-left: 30px;"><span style="font-size: 10pt;">D&ograve;ng m&aacute;y&nbsp;in kim cực nhanh</span></li>\r\n	<li style="padding-left: 30px;"><span style="font-size: 10pt;">Tuổi thọ cao hơn, kết nối linh hoạt</span></li>\r\n	<li style="padding-left: 30px;"><span style="font-size: 10pt;">Hiệu năng cao với t&agrave;i liệu in nhiều bản</span></li>\r\n</ol>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><span style="font-size: 10pt;">&nbsp;<img alt="" height="600" src="http://localhost:8182/pictures/images/14479_MayinkimEpsonLQ310-5.jpg" width="800" /></span></p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><strong><span style="font-size: 10pt; color: rgb(0, 0, 255);">D&ograve;ng m&aacute;y&nbsp;in kim cực nhanh</span></strong></p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><span style="font-size: 10pt;"><strong><span style="color: rgb(128, 0, 128);"><a href="https://www.phucanh.vn/may-in.html" style="color: rgb(128, 0, 128);">M&aacute;y in</a></span></strong>&nbsp;kim Epson LQ-310&nbsp;được hỗ trợ bộ nhớ đệm 128KB c&oacute; dung lượng gấp đ&ocirc;i so với c&aacute;c m&aacute;y in trước, t&iacute;nh năng n&agrave;y gi&uacute;p tốc độ m&aacute;y in l&ecirc;n đến 416 k&yacute; tự/gi&acirc;y, nhanh gần 40% so với d&ograve;ng m&aacute;y LQ 300. D&ograve;ng m&aacute;y in n&agrave;y ch&iacute;nh l&agrave; lựa chọn tiết kiệm v&agrave; th&ocirc;ng minh cho c&aacute;c doanh nghiệp cần in ấn h&oacute;a đơn.</span></p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><span style="font-size: 10pt;">&nbsp;<img alt="" height="350" src="http://localhost:8182/pictures/images/14479_MayinkimEpsonLQ310-4(1).jpg" width="670" /></span></p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><strong><span style="font-size: 10pt; color: rgb(0, 0, 255);">Tuổi thọ cao hơn, kết nối linh hoạt</span></strong></p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><span style="font-size: 10pt;">M&aacute;y in kim&nbsp;<strong><span style="color: rgb(128, 0, 128);"><a href="https://www.phucanh.vn/may-in-epson" style="color: rgb(128, 0, 128);">Epson</a></span></strong>&nbsp;LQ-310&nbsp;c&oacute; tuổi thọ cao hơn 67% so với d&ograve;ng m&aacute;y LQ 300 huyền thoại vốn cũng đ&atilde; nổi tiếng với tuổi thọ rất cao. Epson LQ-310 được xếp hạng MTBF với 10.000 POH so với 6.000 POH của d&ograve;ng m&aacute;y cũ.</span></p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><span style="font-size: 10pt;">Đặc biệt, với cổng USB, Serial v&agrave; giao diện song song,&nbsp;m&aacute;y in kim Epson LQ-310&nbsp;c&oacute; thể kết nối với bất cứ thiết bị đầu ra n&agrave;o m&agrave; bạn cần.</span></p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><span style="font-size: 10pt;"><img alt="" height="286" src="http://localhost:8182/pictures/images/14479_MayinkimEpsonLQ310-2.jpg" width="500" /></span></p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><strong><span style="font-size: 10pt; color: rgb(0, 0, 255);">Hiệu năng cao với t&agrave;i liệu in nhiều bản</span></strong></p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><span style="font-size: 10pt;">M&aacute;y in kim Epson LQ-310&nbsp;đạt hiệu quả tối đa với t&iacute;nh năng in t&agrave;i liệu th&agrave;nh 4 bản (1 bản gốc v&agrave; 3 bản sao). Hơn nữa, với k&iacute;ch cỡ nhỏ gọn, LQ-310 dễ d&agrave;ng cho người d&ugrave;ng bố tr&iacute; trong mọi kh&ocirc;ng gian. Đồng thời, d&ograve;ng m&aacute;y n&agrave;y cũng duy tr&igrave; một độ ồn kh&aacute; thấp kh&ocirc;ng g&acirc;y ảnh hưởng tới mọi người xung quanh.</span></p>\r\n\r\n<h4 style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><strong><span style="font-size: 10pt; color: rgb(0, 0, 255);">Đặc t&iacute;nh kỹ thuật của&nbsp;m&aacute;y in kim&nbsp;EPSON LQ-310</span></strong></h4>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;"><strong><span style="font-size: 10pt; color: rgb(0, 0, 255);"><img alt="" height="282" src="http://localhost:8182/pictures/images/14479_MayinkimEpsonLQ310-1.jpg" width="500" /></span></strong></p>\r\n\r\n<p style="color: rgb(34, 34, 34); font-family: arial, verdana, sans-serif; font-size: 14px; text-align: justify;">-&nbsp;<span style="font-size: 10pt;">M&aacute;y in 24 kim, khổ hẹp.</span><br />\r\n<span style="font-size: 10pt;">- Tốc độ in : 416 k&yacute; tự/gi&acirc;y (High Speed Draft 12cpi).</span><br />\r\n<span style="font-size: 10pt;">- Kỹ thuật in : Impact dot matrix.</span><br />\r\n<span style="font-size: 10pt;">- Khổ giấy : Rộng: 100-257mm, D&agrave;i: 100-364mm.</span><br />\r\n<span style="font-size: 10pt;">- Khổ giấy in li&ecirc;n tục : Rộng: 101.6 - 254mm, D&agrave;i : 101.6 &ndash; 558.8mm.</span><br />\r\n<span style="font-size: 10pt;">- Khổ giấy cuộn: Rộng 216mm.</span><br />\r\n<span style="font-size: 10pt;">- C&aacute;c bộ k&yacute; tự : Italic table, PC437 (US Standard Europe), PC850 (Multilingual), PC860 (Portuguese), PC861 (Icelandic), PC863 (Canadian-French), PC865 (Nordic), Abicomp, BRASCII, Roman 8, ISO Latin 1, PC 858, ISO 8859-15.</span><br />\r\n<span style="font-size: 10pt;">- Bitmap Fonts: Epson Draft: 10, 12, 15 cpi; Epson Roman &amp; San Serif: 10, 12, 15 cpi, Proportional; Epson Courier: 10, 12, 15 cpi; Epson Prestige: 10, 12 cpi; Epson Script, OCR-B, Orator &amp; Orator-S: 10cpi; Epson Script C: Proporational.</span><br />\r\n<span style="font-size: 10pt;">- Đường đi của giấy: Manual Insertion: Rear in, Top out; Tractor: Rear in, Top out.</span><br />\r\n<span style="font-size: 10pt;">- Khả năng sao chụp: 01 bản ch&iacute;nh, 3 bản sao.</span><br />\r\n<span style="font-size: 10pt;">- Chiều in: in 2 chiều.</span><br />\r\n<span style="font-size: 10pt;">- Bộ nhớ đệm: 128KB.</span><br />\r\n<span style="font-size: 10pt;">- Số k&yacute; tự mỗi d&ograve;ng: 80, 96, 120, 137, 160.</span><br />\r\n<span style="font-size: 10pt;">- Cổng kết nối: Bi-directional parallel interface (IEEE-1284 nibble mode supported); Serial interface; USB interface 2.0 Full-Speed.</span><br />\r\n<span style="font-size: 10pt;">- K&iacute;ch thước: 362 (W) x 275 (D) x 154 (H) mm.</span><br />\r\n<span style="font-size: 10pt;">- Trọng lượng: 4.1 kg.</span></p>\r\n', 'Máy in 24 kim, khổ hẹp', '03dpi, 8dots/mm', '48/76 mm', '347 ký tự/giây(10cpi)', '58mm/80mm (±1mm)', '', 'EPSON', 'LQ310', 'Các bộ ký tự : Italic table, PC437 (US Standard Europe), PC850 (Multilingual), PC860 (Portuguese), PC861 (Icelandic), PC863 (Canadian-French), PC865 (Nordic), Abicomp, BRASCII, Roman 8, ISO Latin 1, PC 858, ISO 8859-15.|Bitmap Fonts: Epson Draft: 10, 12, 15 cpi; Epson Roman & San Serif: 10, 12, 15 cpi, Proportional; Epson Courier: 10, 12, 15 cpi; Epson Prestige: 10, 12 cpi; Epson Script, OCR-B, Orator & Orator-S: 10cpi; Epson Script C: Proporational.|Đường đi của giấy: Manual Insertion: Rear in, Top out; Tractor: Rear in, Top out.', 'Bi-directional parallel interface (IEEE-1284 nibble mode supported); Serial interface; USB interface 2.0 Full-Speed.', ' 416 ký tự/giây (High Speed Draft 12cpi).', '362 (W) x 275 (D) x 154 (H) mm', '4.1 kg.', 'Nhật Bản', '24 tháng cho toàn bộ thân máy - đầu in - adapter', '3,6,7', 0, '', '', '', 1639470881, 1639724465, 1, 0),
(7, 'kim Epson LQ2190', 'may-in-kim-epson-lq2190', 'may-in-kim-epson-lq2190/may-in-kim-epson-lq2190.png', '16.199.000', 40, 'INEP072', 12, 'may-in-kim-epson-lq2190/may-in-kim-epson-lq2190-0.png,may-in-kim-epson-lq2190/may-in-kim-epson-lq2190-1.png,may-in-kim-epson-lq2190/may-in-kim-epson-lq2190-2.png,may-in-kim-epson-lq2190/may-in-kim-epson-lq2190-3.png', 36, 32, '2', '5', '2', '2', 0, 0, '<div class="nd title_box_scroll_content_2019" style="padding: 10px 10px 120px; border-radius: 3px; box-shadow: rgba(152, 165, 185, 0.2) 0px 0px 4px 0px; color: rgb(34, 34, 34); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; font-size: 16px;">\r\n<p><span style="font-weight: 700;"><a href="https://news.hanoicomputer.vn/huong-dan-kich-hoat-bao-hanh-may-in-va-cac-san-pham-cua-epson-khac/" rel="noopener" style="cursor: pointer; transition: all 0.2s ease 0s; color: rgb(0, 90, 255) !important;" target="_blank">Hướng dẫn k&iacute;ch hoạt bảo h&agrave;nh online m&aacute;y in v&agrave; c&aacute;c sản phẩm của Epson</a></span></p>\r\n\r\n<h3 style="margin-top: 0px;">In kim khổ lớn</h3>\r\n\r\n<p>M&aacute;y in kim Epson LQ2190 c&oacute; 24-pin, khổ rộng n&agrave;y gi&uacute;p c&ocirc;ng việc in ấn khổ giấy lớn kh&ocirc;ng c&oacute; sai s&oacute;t. V&igrave; thế bạn c&oacute; thể dựa v&agrave;o kết quả chất lượng cao dựa tr&ecirc;n chiều rộng của khổ giấy trong khi đ&oacute; tốc độ đạt 575 cps( v&ograve;ng / gi&acirc;y) (13 inch) thật ho&agrave;n hảo khi in ấn số lượng lớn.</p>\r\n\r\n<p>Tốc độ in l&agrave; ho&agrave;n hảo của Epson LQ 2190 sử dụng cho c&ocirc;ng việc khối lượng lớn rất tốt. C&ugrave;ng với thiết bị mạnh mẽ n&agrave;y m&aacute;y in kim Epson LQ2190 trở n&ecirc;n đ&aacute;ng tin cậy v&agrave; c&oacute; tuổi thọ đầu in l&ecirc;n tới 400 triệu n&eacute;t / điện t&iacute;n, tuổi thọ đạt từ tr&ecirc;n 20.000 giờ.</p>\r\n\r\n<p style="text-align:center"><img alt="Máy in kim Epson LQ2190" class="loading" data-was-processed="true" height="500" src="https://hanoicomputercdn.com/media/product/10898_chinh_dien_may_in_kim_epson_lq2190.jpg" style="border-width: initial; border-style: none; max-width: 100%; height: auto;" /></p>\r\n\r\n<h3 style="margin-top: 0px;">Linh hoạt</h3>\r\n\r\n<p>C&oacute; ph&iacute;m lựa chọn ph&iacute;a tr&ecirc;n, dưới, trước v&agrave; đường dẫn giấy ph&iacute;a sau gi&uacute;p cho bạn kiểm so&aacute;t nhiều hơn quản l&yacute;. V&agrave; việc bổ sung một giao diện USB c&oacute; nghĩa l&agrave; linh hoạt hơn trong kết nối.</p>\r\n\r\n<h3 style="margin-top: 0px;">Tuổi thọ cao</h3>\r\n\r\n<p>Tuổi thọ m&aacute;y in Epson LQ2190 cao với 20,000POH bằng khoảng 15 triệu k&yacute; tự, linh kiện hoạt động bền bỉ sẽ tạo ra hiệu quả kinh doanh lớn v&agrave; thời gian bảo tr&igrave; thấp.</p>\r\n\r\n<h3 style="margin-top: 0px;">Kết nối to&agrave;n diện với mạng văn ph&ograve;ng</h3>\r\n\r\n<p>Máy in kim Epson LQ2190 kết nối to&agrave;n diện với USB, giao diện Parallel cũng như m&aacute;y in chủ.</p>\r\n</div>\r\n', 'In nhiệt trực tiếp', '03dpi, 8dots/mm', '48/76 mm', '230 mm/second', 'A3/A4', 'Dùng mực: C13S015531', 'Epson', 'LQ2190', 'Manual Insertion (Front or rear in, top out), Push Tractor (Front or rear in, top out), Pull Tractor (Front or rear or bottom in, top out)', 'USB/ LPT', '230 mm/second', '164 (L) x 141 (W) x 127 (H) mm', '1.64 kg', 'Trung Quốc', '24 tháng cho toàn bộ thân máy - đầu in - adapter', '6,8', 0, '', '', '', 1640143281, 1640143281, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE IF NOT EXISTS `tbl_role` (
  `id_user` int(11) NOT NULL,
  `id_modules` int(11) NOT NULL,
  `view` int(11) NOT NULL,
  `add` int(11) NOT NULL,
  `edit` int(11) NOT NULL,
  `delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id_user`, `id_modules`, `view`, `add`, `edit`, `delete`) VALUES
(1, 1, 1, 1, 1, 1),
(1, 2, 1, 1, 1, 1),
(1, 3, 1, 1, 1, 1),
(1, 4, 1, 1, 1, 1),
(1, 5, 1, 1, 1, 1),
(1, 6, 1, 1, 1, 1),
(1, 7, 1, 1, 1, 1),
(1, 8, 1, 1, 1, 1),
(6, 1, 1, 1, 1, 1),
(6, 2, 1, 1, 1, 1),
(6, 3, 1, 1, 1, 1),
(6, 4, 1, 1, 1, 1),
(6, 5, 1, 1, 1, 1),
(6, 6, 1, 1, 1, 1),
(6, 7, 1, 1, 1, 1),
(6, 8, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tags`
--

CREATE TABLE IF NOT EXISTS `tbl_tags` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_tags`
--

INSERT INTO `tbl_tags` (`id`, `name`, `alias`) VALUES
(1, 'Hãng máy in HPRT', 'hang-may-in-hprt'),
(2, 'Hãng máy in Xprinter', 'may-in-hprt'),
(3, 'Máy in hóa đơn Cannon', 'may-in-hoa-don-cannon'),
(4, 'Máy in phun', 'may-in-phun'),
(5, 'Máy in màu', 'may-in-mau'),
(6, 'Hãng máy in Epson', 'hang-may-in-epson'),
(7, 'Máy in Đơn truyền nhiệt', 'may-in-don-truyen-nhiet'),
(8, 'Máy in kim', 'may-in-kim'),
(9, 'Hãng máy in Roco', 'hang-may-in-roco'),
(10, 'Máy in laser trắng đen', 'may-in-laser-trang-den');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_connector`
--
ALTER TABLE `tbl_connector`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_manufacturer`
--
ALTER TABLE `tbl_manufacturer`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_paper_size`
--
ALTER TABLE `tbl_paper_size`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tags`
--
ALTER TABLE `tbl_tags`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_connector`
--
ALTER TABLE `tbl_connector`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_manufacturer`
--
ALTER TABLE `tbl_manufacturer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_modules`
--
ALTER TABLE `tbl_modules`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_paper_size`
--
ALTER TABLE `tbl_paper_size`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_tags`
--
ALTER TABLE `tbl_tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
