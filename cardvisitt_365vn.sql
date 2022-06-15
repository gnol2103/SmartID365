-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2022 at 09:15 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cardvisitt_365vn`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(11) NOT NULL,
  `user_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_name`, `password`, `created_at`, `updated_at`) VALUES
(3, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE IF NOT EXISTS `bills` (
`id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Họ tên',
  `phone` int(11) NOT NULL COMMENT 'Số điện thoại',
  `city_id` int(11) NOT NULL COMMENT 'ID thành phố',
  `district_id` int(11) NOT NULL COMMENT 'ID quận',
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Địa chỉ',
  `card_name` int(50) NOT NULL DEFAULT '0' COMMENT 'Tên in trên thẻ',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ghi chú, yêu cầu',
  `total_price` float NOT NULL,
  `total_trans` float NOT NULL,
  `total_voucher` float NOT NULL,
  `voucher` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0.Chưa duyệt, 1.Duyệt'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `id_user`, `name`, `phone`, `city_id`, `district_id`, `address`, `card_name`, `note`, `total_price`, `total_trans`, `total_voucher`, `voucher`, `created_at`, `status`) VALUES
(9, 0, 'Hùng Mo', 348273927, 1, 1, 'hàn quốc', 123, '123', 833400, 0, 0, '', 1647328896, 0),
(10, 0, 'Hùng Mo', 348273927, 1, 1, 'hàn quốc', 123, '123', 833400, 0, 0, '', 1647330340, 0),
(11, 0, 'Hùng Mo', 348273927, 1, 1, 'hàn quốc', 123, '123', 833400, 0, 0, '', 1647330396, 0),
(12, 0, 'Hùng Mo', 348273927, 1, 1, 'hàn quốc', 123, '123', 833400, 0, 0, '', 1647330434, 0),
(13, 0, 'Hùng Mo', 348273927, 1, 1, 'hàn quốc', 1, '2', 198000, 0, 0, '', 1647330483, 0),
(14, 0, 'Hùng Mo', 348273927, 1, 1, 'hàn quốc', 1, '2', 198000, 0, 0, '', 1647330503, 0),
(15, 0, '2', 1, 2, 1, '3', 4, '5', 218700, 0, 0, '', 1647330522, 0),
(16, 0, '1', 2, 1, 2, 'hàn quốc', 123, '123', 120000, 0, 0, '', 1647330633, 0),
(17, 0, 'HNCX00161', 1, 1, 1, 'hàn quốc', 1, '2', 198000, 0, 0, '', 1647330684, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bill_details`
--

CREATE TABLE IF NOT EXISTS `bill_details` (
`id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL COMMENT 'Giá sản phẩm sau khi đã giảm giá',
  `amount` int(11) NOT NULL COMMENT 'Số lượng'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_details`
--

INSERT INTO `bill_details` (`id`, `bill_id`, `product_id`, `price`, `amount`) VALUES
(3, 9, 82, 218700, 2),
(4, 9, 81, 198000, 2),
(5, 10, 82, 218700, 2),
(6, 10, 81, 198000, 2),
(7, 12, 82, 218700, 1),
(8, 12, 81, 198000, 1),
(9, 13, 81, 198000, 1),
(10, 15, 82, 218700, 1),
(11, 16, 83, 120000, 1),
(12, 17, 81, 198000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `card_link`
--

CREATE TABLE IF NOT EXISTS `card_link` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` int(11) NOT NULL COMMENT 'Mã số thẻ',
  `created_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '0.Số điện thoại, 1.Email, 2.Địa chỉ, 3.Skype, 4.Facebook, 5.Instagram, 6.Twitter, 7.Tiktok, 8.Zalo, 9.Youtube, 10.Snapchat, 11.LinkedIn, 12.Pinterest, 13.Behance, 14.Ví momo , 15.Paypal, 16.Tài khoản ngân hàng, 17.Đường dẫn',
  `subtitle` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tiêu đề phụ',
  `content` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'VD: Số điện thoại, Link facebook,...',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `evaluates`
--

CREATE TABLE IF NOT EXISTS `evaluates` (
`id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên hiển thị',
  `star` int(11) NOT NULL COMMENT 'Đánh giá',
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ảnh đánh giá',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nội dung đánh giá',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên sản phẩm',
  `introduce` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Giới thiệu sản phẩm',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Mô tả',
  `price` int(11) NOT NULL COMMENT 'Giá ',
  `type_sale` int(11) NOT NULL DEFAULT '0' COMMENT 'Loại giảm giá (1.Nhập %, 2.Nhập tiền)',
  `sale` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL COMMENT 'Số lượng',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ảnh sản phẩm',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `hot` int(11) NOT NULL DEFAULT '0' COMMENT '0.Không, 1.Hot',
  `color` int(11) NOT NULL COMMENT '0.Đen, 1.Trắng',
  `alias` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `introduce`, `description`, `price`, `type_sale`, `sale`, `amount`, `image`, `created_at`, `updated_at`, `hot`, `color`, `alias`) VALUES
(81, 'Card Visit đẹp 01', 'Thẻ cá nhân thông minh SmartID365 phiên bản màu Đen, hoạ tiết công nghệ màu trắng mang lại sự sang trọng, tối giản cho chủ sở hữu.\r\n\r\nChỉ cần chạm chiếc thẻ này và điện thoại của người đối diện để chia sẻ ngay lập tức:\r\n\r\nThông tin liên lạc, sđt, email\r\nTự động lưu danh bạ chỉ với 1 nút bấm\r\nKết nối tài khoản mạng xã hội như Facebook, Zalo, Instagram, TikTok…\r\nTài khoản ngân hàng, Ví điện tử Momo …', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit sagittis leo ut gravida. Vivamus ultrices risus eu placerat vestibulum. Quisque mattis velit at nulla rhoncus laoreet. Sed tincidunt justo in leo semper, a porta odio commodo. Curabitur in odio placerat, consectetur nibh vehicula, semper lacus. Cras vitae consequat velit. Morbi felis felis, porta id massa at, euismod imperdiet massa. Donec sit amet hendrerit lacus. Suspendisse vitae nisi ut turpis commodo feugiat. Duis vitae faucibus mauris. Fusce diam arcu, tincidunt in libero id, malesuada bibendum ipsum. Ut consequat mattis mauris, nec tempor velit aliquet eget. Sed bibendum tortor est, quis posuere leo vulputate sodales.\r\n\r\nSuspendisse eros ex, imperdiet ac consectetur ut, molestie id odio. Aliquam vel varius arcu. Aenean volutpat sagittis tincidunt. Pellentesque mollis tristique lectus, et iaculis magna euismod vel. Sed nec lacinia odio, non placerat justo. Aenean odio ante, vestibulum sed ornare laoreet, vestibulum quis turpis. Fusce convallis molestie orci eget elementum.\r\n\r\nProin eleifend nisi et fringilla consequat. Morbi non turpis ex. Aliquam ut laoreet lorem, ac maximus lorem. Mauris suscipit lacus eu convallis gravida. Vivamus malesuada, est vestibulum egestas congue, diam augue hendrerit ligula, eget faucibus lacus ligula fringilla neque. Mauris maximus metus justo, et tincidunt risus maximus vitae. Donec faucibus egestas sodales. Suspendisse potenti. Aliquam tempus ex a sem sodales, quis semper mauris molestie. Quisque convallis eros sit amet accumsan ornare.\r\n\r\nMauris ac cursus elit, et dictum velit. Donec ipsum leo, vestibulum ut libero vitae, sagittis feugiat est. Curabitur ac ipsum non tortor euismod venenatis eget et libero. Aliquam sagittis ultrices nisl bibendum vestibulum. Ut non tellus eget risus tristique mollis id sit amet ante. Proin auctor erat sit amet dui condimentum tempus. Pellentesque ac lacinia velit. Aliquam sagittis, turpis posuere dignissim euismod, sapien eros finibus elit, at lacinia metus tellus nec leo. Vivamus malesuada euismod tellus, nec posuere est maximus eu. Morbi non semper dolor. Morbi turpis quam, placerat et ex id, feugiat lobortis sapien. Aliquam eget leo in lacus venenatis dictum a sit amet turpis. Proin quis feugiat quam.\r\n\r\nNulla pharetra erat placerat nibh elementum blandit. Quisque felis elit, tempus ut purus a, semper laoreet velit. Quisque massa justo, tempus at tempor eu, congue eu lacus. Curabitur porttitor lorem sit amet leo facilisis imperdiet. Aenean congue sollicitudin neque, pharetra venenatis nulla bibendum in. Ut eleifend nec libero sed semper. Aliquam commodo placerat diam, eget tincidunt eros dictum sed. Ut suscipit, tortor ac finibus finibus, ipsum ante ultrices massa, ut rutrum sapien nunc vitae lacus. Donec vel elementum nibh. Mauris scelerisque finibus felis. Integer tempor enim posuere efficitur interdum. Nunc egestas sapien ac augue porttitor, eget lobortis tellus mollis. Nulla facilisis lobortis tellus ut pellentesque.', 220000, 1, 10, 1000, '107146b0762ce8c77b1b8234f48fcc65.png', 1646615568, 1647301803, 1, 0, 'card-visit-dep-01'),
(82, 'Card Visit đẹp 02', 'Thẻ cá nhân thông minh SmartID365 phiên bản màu Đen, hoạ tiết công nghệ màu trắng mang lại sự sang trọng, tối giản cho chủ sở hữu.\r\n\r\nChỉ cần chạm chiếc thẻ này và điện thoại của người đối diện để chia sẻ ngay lập tức:\r\n\r\nThông tin liên lạc, sđt, email\r\nTự động lưu danh bạ chỉ với 1 nút bấm\r\nKết nối tài khoản mạng xã hội như Facebook, Zalo, Instagram, TikTok…\r\nTài khoản ngân hàng, Ví điện tử Momo …\r\nLink website và vô vàn các ứng dụng khác', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit sagittis leo ut gravida. Vivamus ultrices risus eu placerat vestibulum. Quisque mattis velit at nulla rhoncus laoreet. Sed tincidunt justo in leo semper, a porta odio commodo. Curabitur in odio placerat, consectetur nibh vehicula, semper lacus. Cras vitae consequat velit. Morbi felis felis, porta id massa at, euismod imperdiet massa. Donec sit amet hendrerit lacus. Suspendisse vitae nisi ut turpis commodo feugiat. Duis vitae faucibus mauris. Fusce diam arcu, tincidunt in libero id, malesuada bibendum ipsum. Ut consequat mattis mauris, nec tempor velit aliquet eget. Sed bibendum tortor est, quis posuere leo vulputate sodales.\r\n\r\nSuspendisse eros ex, imperdiet ac consectetur ut, molestie id odio. Aliquam vel varius arcu. Aenean volutpat sagittis tincidunt. Pellentesque mollis tristique lectus, et iaculis magna euismod vel. Sed nec lacinia odio, non placerat justo. Aenean odio ante, vestibulum sed ornare laoreet, vestibulum quis turpis. Fusce convallis molestie orci eget elementum.\r\n\r\nProin eleifend nisi et fringilla consequat. Morbi non turpis ex. Aliquam ut laoreet lorem, ac maximus lorem. Mauris suscipit lacus eu convallis gravida. Vivamus malesuada, est vestibulum egestas congue, diam augue hendrerit ligula, eget faucibus lacus ligula fringilla neque. Mauris maximus metus justo, et tincidunt risus maximus vitae. Donec faucibus egestas sodales. Suspendisse potenti. Aliquam tempus ex a sem sodales, quis semper mauris molestie. Quisque convallis eros sit amet accumsan ornare.\r\n\r\nMauris ac cursus elit, et dictum velit. Donec ipsum leo, vestibulum ut libero vitae, sagittis feugiat est. Curabitur ac ipsum non tortor euismod venenatis eget et libero. Aliquam sagittis ultrices nisl bibendum vestibulum. Ut non tellus eget risus tristique mollis id sit amet ante. Proin auctor erat sit amet dui condimentum tempus. Pellentesque ac lacinia velit. Aliquam sagittis, turpis posuere dignissim euismod, sapien eros finibus elit, at lacinia metus tellus nec leo. Vivamus malesuada euismod tellus, nec posuere est maximus eu. Morbi non semper dolor. Morbi turpis quam, placerat et ex id, feugiat lobortis sapien. Aliquam eget leo in lacus venenatis dictum a sit amet turpis. Proin quis feugiat quam.\r\n\r\nNulla pharetra erat placerat nibh elementum blandit. Quisque felis elit, tempus ut purus a, semper laoreet velit. Quisque massa justo, tempus at tempor eu, congue eu lacus. Curabitur porttitor lorem sit amet leo facilisis imperdiet. Aenean congue sollicitudin neque, pharetra venenatis nulla bibendum in. Ut eleifend nec libero sed semper. Aliquam commodo placerat diam, eget tincidunt eros dictum sed. Ut suscipit, tortor ac finibus finibus, ipsum ante ultrices massa, ut rutrum sapien nunc vitae lacus. Donec vel elementum nibh. Mauris scelerisque finibus felis. Integer tempor enim posuere efficitur interdum. Nunc egestas sapien ac augue porttitor, eget lobortis tellus mollis. Nulla facilisis lobortis tellus ut pellentesque.', 243000, 1, 10, 12200, '7e218bf85c808d847354662a85991269.png', 1646615618, 0, 1, 1, 'card-visit-dep-02'),
(83, 'Card Visit đẹp 03', 'Thẻ cá nhân thông minh SmartID365 phiên bản màu Đen, hoạ tiết công nghệ màu trắng mang lại sự sang trọng, tối giản cho chủ sở hữu.\r\n\r\nChỉ cần chạm chiếc thẻ này và điện thoại của người đối diện để chia sẻ ngay lập tức:\r\n\r\nThông tin liên lạc, sđt, email\r\nTự động lưu danh bạ chỉ với 1 nút bấm\r\nKết nối tài khoản mạng xã hội như Facebook, Zalo, Instagram, TikTok…\r\nTài khoản ngân hàng, Ví điện tử Momo …\r\nLink website và vô vàn các ứng dụng khác', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit sagittis leo ut gravida. Vivamus ultrices risus eu placerat vestibulum. Quisque mattis velit at nulla rhoncus laoreet. Sed tincidunt justo in leo semper, a porta odio commodo. Curabitur in odio placerat, consectetur nibh vehicula, semper lacus. Cras vitae consequat velit. Morbi felis felis, porta id massa at, euismod imperdiet massa. Donec sit amet hendrerit lacus. Suspendisse vitae nisi ut turpis commodo feugiat. Duis vitae faucibus mauris. Fusce diam arcu, tincidunt in libero id, malesuada bibendum ipsum. Ut consequat mattis mauris, nec tempor velit aliquet eget. Sed bibendum tortor est, quis posuere leo vulputate sodales.\r\n\r\nSuspendisse eros ex, imperdiet ac consectetur ut, molestie id odio. Aliquam vel varius arcu. Aenean volutpat sagittis tincidunt. Pellentesque mollis tristique lectus, et iaculis magna euismod vel. Sed nec lacinia odio, non placerat justo. Aenean odio ante, vestibulum sed ornare laoreet, vestibulum quis turpis. Fusce convallis molestie orci eget elementum.\r\n\r\nProin eleifend nisi et fringilla consequat. Morbi non turpis ex. Aliquam ut laoreet lorem, ac maximus lorem. Mauris suscipit lacus eu convallis gravida. Vivamus malesuada, est vestibulum egestas congue, diam augue hendrerit ligula, eget faucibus lacus ligula fringilla neque. Mauris maximus metus justo, et tincidunt risus maximus vitae. Donec faucibus egestas sodales. Suspendisse potenti. Aliquam tempus ex a sem sodales, quis semper mauris molestie. Quisque convallis eros sit amet accumsan ornare.\r\n\r\nMauris ac cursus elit, et dictum velit. Donec ipsum leo, vestibulum ut libero vitae, sagittis feugiat est. Curabitur ac ipsum non tortor euismod venenatis eget et libero. Aliquam sagittis ultrices nisl bibendum vestibulum. Ut non tellus eget risus tristique mollis id sit amet ante. Proin auctor erat sit amet dui condimentum tempus. Pellentesque ac lacinia velit. Aliquam sagittis, turpis posuere dignissim euismod, sapien eros finibus elit, at lacinia metus tellus nec leo. Vivamus malesuada euismod tellus, nec posuere est maximus eu. Morbi non semper dolor. Morbi turpis quam, placerat et ex id, feugiat lobortis sapien. Aliquam eget leo in lacus venenatis dictum a sit amet turpis. Proin quis feugiat quam.\r\n\r\nNulla pharetra erat placerat nibh elementum blandit. Quisque felis elit, tempus ut purus a, semper laoreet velit. Quisque massa justo, tempus at tempor eu, congue eu lacus. Curabitur porttitor lorem sit amet leo facilisis imperdiet. Aenean congue sollicitudin neque, pharetra venenatis nulla bibendum in. Ut eleifend nec libero sed semper. Aliquam commodo placerat diam, eget tincidunt eros dictum sed. Ut suscipit, tortor ac finibus finibus, ipsum ante ultrices massa, ut rutrum sapien nunc vitae lacus. Donec vel elementum nibh. Mauris scelerisque finibus felis. Integer tempor enim posuere efficitur interdum. Nunc egestas sapien ac augue porttitor, eget lobortis tellus mollis. Nulla facilisis lobortis tellus ut pellentesque.', 130000, 2, 10000, 220, '9e3eee7bc12bcc0167ecc48ab4c21818.png', 1646615657, 0, 0, 1, 'card-visit-dep-03'),
(84, 'Card Visit đẹp 04', 'Thẻ cá nhân thông minh SmartID365 phiên bản màu Đen, hoạ tiết công nghệ màu trắng mang lại sự sang trọng, tối giản cho chủ sở hữu.\r\n\r\nChỉ cần chạm chiếc thẻ này và điện thoại của người đối diện để chia sẻ ngay lập tức:\r\n\r\nThông tin liên lạc, sđt, email\r\nTự động lưu danh bạ chỉ với 1 nút bấm\r\nKết nối tài khoản mạng xã hội như Facebook, Zalo, Instagram, TikTok…\r\nTài khoản ngân hàng, Ví điện tử Momo …\r\nLink website và vô vàn các ứng dụng khác', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit sagittis leo ut gravida. Vivamus ultrices risus eu placerat vestibulum. Quisque mattis velit at nulla rhoncus laoreet. Sed tincidunt justo in leo semper, a porta odio commodo. Curabitur in odio placerat, consectetur nibh vehicula, semper lacus. Cras vitae consequat velit. Morbi felis felis, porta id massa at, euismod imperdiet massa. Donec sit amet hendrerit lacus. Suspendisse vitae nisi ut turpis commodo feugiat. Duis vitae faucibus mauris. Fusce diam arcu, tincidunt in libero id, malesuada bibendum ipsum. Ut consequat mattis mauris, nec tempor velit aliquet eget. Sed bibendum tortor est, quis posuere leo vulputate sodales.\r\n\r\nSuspendisse eros ex, imperdiet ac consectetur ut, molestie id odio. Aliquam vel varius arcu. Aenean volutpat sagittis tincidunt. Pellentesque mollis tristique lectus, et iaculis magna euismod vel. Sed nec lacinia odio, non placerat justo. Aenean odio ante, vestibulum sed ornare laoreet, vestibulum quis turpis. Fusce convallis molestie orci eget elementum.\r\n\r\nProin eleifend nisi et fringilla consequat. Morbi non turpis ex. Aliquam ut laoreet lorem, ac maximus lorem. Mauris suscipit lacus eu convallis gravida. Vivamus malesuada, est vestibulum egestas congue, diam augue hendrerit ligula, eget faucibus lacus ligula fringilla neque. Mauris maximus metus justo, et tincidunt risus maximus vitae. Donec faucibus egestas sodales. Suspendisse potenti. Aliquam tempus ex a sem sodales, quis semper mauris molestie. Quisque convallis eros sit amet accumsan ornare.\r\n\r\nMauris ac cursus elit, et dictum velit. Donec ipsum leo, vestibulum ut libero vitae, sagittis feugiat est. Curabitur ac ipsum non tortor euismod venenatis eget et libero. Aliquam sagittis ultrices nisl bibendum vestibulum. Ut non tellus eget risus tristique mollis id sit amet ante. Proin auctor erat sit amet dui condimentum tempus. Pellentesque ac lacinia velit. Aliquam sagittis, turpis posuere dignissim euismod, sapien eros finibus elit, at lacinia metus tellus nec leo. Vivamus malesuada euismod tellus, nec posuere est maximus eu. Morbi non semper dolor. Morbi turpis quam, placerat et ex id, feugiat lobortis sapien. Aliquam eget leo in lacus venenatis dictum a sit amet turpis. Proin quis feugiat quam.\r\n\r\nNulla pharetra erat placerat nibh elementum blandit. Quisque felis elit, tempus ut purus a, semper laoreet velit. Quisque massa justo, tempus at tempor eu, congue eu lacus. Curabitur porttitor lorem sit amet leo facilisis imperdiet. Aenean congue sollicitudin neque, pharetra venenatis nulla bibendum in. Ut eleifend nec libero sed semper. Aliquam commodo placerat diam, eget tincidunt eros dictum sed. Ut suscipit, tortor ac finibus finibus, ipsum ante ultrices massa, ut rutrum sapien nunc vitae lacus. Donec vel elementum nibh. Mauris scelerisque finibus felis. Integer tempor enim posuere efficitur interdum. Nunc egestas sapien ac augue porttitor, eget lobortis tellus mollis. Nulla facilisis lobortis tellus ut pellentesque.', 340000, 0, 0, 200, '2811dc5a197e2c58ed30e8a06fe562d0.png', 1646615691, 0, 0, 0, 'card-visit-dep-04'),
(85, 'Card Visit đẹp 05', 'Thẻ cá nhân thông minh SmartID365 phiên bản màu Đen, hoạ tiết công nghệ màu trắng mang lại sự sang trọng, tối giản cho chủ sở hữu.\r\n\r\nChỉ cần chạm chiếc thẻ này và điện thoại của người đối diện để chia sẻ ngay lập tức:\r\n\r\nThông tin liên lạc, sđt, email\r\nTự động lưu danh bạ chỉ với 1 nút bấm\r\nKết nối tài khoản mạng xã hội như Facebook, Zalo, Instagram, TikTok…\r\nTài khoản ngân hàng, Ví điện tử Momo …\r\nLink website và vô vàn các ứng dụng khác', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit sagittis leo ut gravida. Vivamus ultrices risus eu placerat vestibulum. Quisque mattis velit at nulla rhoncus laoreet. Sed tincidunt justo in leo semper, a porta odio commodo. Curabitur in odio placerat, consectetur nibh vehicula, semper lacus. Cras vitae consequat velit. Morbi felis felis, porta id massa at, euismod imperdiet massa. Donec sit amet hendrerit lacus. Suspendisse vitae nisi ut turpis commodo feugiat. Duis vitae faucibus mauris. Fusce diam arcu, tincidunt in libero id, malesuada bibendum ipsum. Ut consequat mattis mauris, nec tempor velit aliquet eget. Sed bibendum tortor est, quis posuere leo vulputate sodales.\r\n\r\nSuspendisse eros ex, imperdiet ac consectetur ut, molestie id odio. Aliquam vel varius arcu. Aenean volutpat sagittis tincidunt. Pellentesque mollis tristique lectus, et iaculis magna euismod vel. Sed nec lacinia odio, non placerat justo. Aenean odio ante, vestibulum sed ornare laoreet, vestibulum quis turpis. Fusce convallis molestie orci eget elementum.\r\n\r\nProin eleifend nisi et fringilla consequat. Morbi non turpis ex. Aliquam ut laoreet lorem, ac maximus lorem. Mauris suscipit lacus eu convallis gravida. Vivamus malesuada, est vestibulum egestas congue, diam augue hendrerit ligula, eget faucibus lacus ligula fringilla neque. Mauris maximus metus justo, et tincidunt risus maximus vitae. Donec faucibus egestas sodales. Suspendisse potenti. Aliquam tempus ex a sem sodales, quis semper mauris molestie. Quisque convallis eros sit amet accumsan ornare.\r\n\r\nMauris ac cursus elit, et dictum velit. Donec ipsum leo, vestibulum ut libero vitae, sagittis feugiat est. Curabitur ac ipsum non tortor euismod venenatis eget et libero. Aliquam sagittis ultrices nisl bibendum vestibulum. Ut non tellus eget risus tristique mollis id sit amet ante. Proin auctor erat sit amet dui condimentum tempus. Pellentesque ac lacinia velit. Aliquam sagittis, turpis posuere dignissim euismod, sapien eros finibus elit, at lacinia metus tellus nec leo. Vivamus malesuada euismod tellus, nec posuere est maximus eu. Morbi non semper dolor. Morbi turpis quam, placerat et ex id, feugiat lobortis sapien. Aliquam eget leo in lacus venenatis dictum a sit amet turpis. Proin quis feugiat quam.\r\n\r\nNulla pharetra erat placerat nibh elementum blandit. Quisque felis elit, tempus ut purus a, semper laoreet velit. Quisque massa justo, tempus at tempor eu, congue eu lacus. Curabitur porttitor lorem sit amet leo facilisis imperdiet. Aenean congue sollicitudin neque, pharetra venenatis nulla bibendum in. Ut eleifend nec libero sed semper. Aliquam commodo placerat diam, eget tincidunt eros dictum sed. Ut suscipit, tortor ac finibus finibus, ipsum ante ultrices massa, ut rutrum sapien nunc vitae lacus. Donec vel elementum nibh. Mauris scelerisque finibus felis. Integer tempor enim posuere efficitur interdum. Nunc egestas sapien ac augue porttitor, eget lobortis tellus mollis. Nulla facilisis lobortis tellus ut pellentesque.', 233333, 1, 12, 333, '5739cb7be18a16371cd5fec8f351b02d.png', 1646615734, 0, 1, 0, 'card-visit-dep-05'),
(86, 'Card Visit đẹp 06', 'Thẻ cá nhân thông minh SmartID365 phiên bản màu Đen, hoạ tiết công nghệ màu trắng mang lại sự sang trọng, tối giản cho chủ sở hữu.\r\n\r\nChỉ cần chạm chiếc thẻ này và điện thoại của người đối diện để chia sẻ ngay lập tức:\r\n\r\nThông tin liên lạc, sđt, email\r\nTự động lưu danh bạ chỉ với 1 nút bấm\r\nKết nối tài khoản mạng xã hội như Facebook, Zalo, Instagram, TikTok…\r\nTài khoản ngân hàng, Ví điện tử Momo …\r\nLink website và vô vàn các ứng dụng khác', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit sagittis leo ut gravida. Vivamus ultrices risus eu placerat vestibulum. Quisque mattis velit at nulla rhoncus laoreet. Sed tincidunt justo in leo semper, a porta odio commodo. Curabitur in odio placerat, consectetur nibh vehicula, semper lacus. Cras vitae consequat velit. Morbi felis felis, porta id massa at, euismod imperdiet massa. Donec sit amet hendrerit lacus. Suspendisse vitae nisi ut turpis commodo feugiat. Duis vitae faucibus mauris. Fusce diam arcu, tincidunt in libero id, malesuada bibendum ipsum. Ut consequat mattis mauris, nec tempor velit aliquet eget. Sed bibendum tortor est, quis posuere leo vulputate sodales.\r\n\r\nSuspendisse eros ex, imperdiet ac consectetur ut, molestie id odio. Aliquam vel varius arcu. Aenean volutpat sagittis tincidunt. Pellentesque mollis tristique lectus, et iaculis magna euismod vel. Sed nec lacinia odio, non placerat justo. Aenean odio ante, vestibulum sed ornare laoreet, vestibulum quis turpis. Fusce convallis molestie orci eget elementum.\r\n\r\nProin eleifend nisi et fringilla consequat. Morbi non turpis ex. Aliquam ut laoreet lorem, ac maximus lorem. Mauris suscipit lacus eu convallis gravida. Vivamus malesuada, est vestibulum egestas congue, diam augue hendrerit ligula, eget faucibus lacus ligula fringilla neque. Mauris maximus metus justo, et tincidunt risus maximus vitae. Donec faucibus egestas sodales. Suspendisse potenti. Aliquam tempus ex a sem sodales, quis semper mauris molestie. Quisque convallis eros sit amet accumsan ornare.\r\n\r\nMauris ac cursus elit, et dictum velit. Donec ipsum leo, vestibulum ut libero vitae, sagittis feugiat est. Curabitur ac ipsum non tortor euismod venenatis eget et libero. Aliquam sagittis ultrices nisl bibendum vestibulum. Ut non tellus eget risus tristique mollis id sit amet ante. Proin auctor erat sit amet dui condimentum tempus. Pellentesque ac lacinia velit. Aliquam sagittis, turpis posuere dignissim euismod, sapien eros finibus elit, at lacinia metus tellus nec leo. Vivamus malesuada euismod tellus, nec posuere est maximus eu. Morbi non semper dolor. Morbi turpis quam, placerat et ex id, feugiat lobortis sapien. Aliquam eget leo in lacus venenatis dictum a sit amet turpis. Proin quis feugiat quam.\r\n\r\nNulla pharetra erat placerat nibh elementum blandit. Quisque felis elit, tempus ut purus a, semper laoreet velit. Quisque massa justo, tempus at tempor eu, congue eu lacus. Curabitur porttitor lorem sit amet leo facilisis imperdiet. Aenean congue sollicitudin neque, pharetra venenatis nulla bibendum in. Ut eleifend nec libero sed semper. Aliquam commodo placerat diam, eget tincidunt eros dictum sed. Ut suscipit, tortor ac finibus finibus, ipsum ante ultrices massa, ut rutrum sapien nunc vitae lacus. Donec vel elementum nibh. Mauris scelerisque finibus felis. Integer tempor enim posuere efficitur interdum. Nunc egestas sapien ac augue porttitor, eget lobortis tellus mollis. Nulla facilisis lobortis tellus ut pellentesque.', 443000, 0, 0, 145, '5365ecb9f63084a1278ad2c47fcd2298.png', 1646615767, 1647300900, 0, 0, 'card-visit-dep-6'),
(87, 'Card Visit đẹp 07', 'Thẻ cá nhân thông minh SmartID365 phiên bản màu Đen, hoạ tiết công nghệ màu trắng mang lại sự sang trọng, tối giản cho chủ sở hữu.\r\n\r\nChỉ cần chạm chiếc thẻ này và điện thoại của người đối diện để chia sẻ ngay lập tức:\r\n\r\nThông tin liên lạc, sđt, email\r\nTự động lưu danh bạ chỉ với 1 nút bấm\r\nKết nối tài khoản mạng xã hội như Facebook, Zalo, Instagram, TikTok…\r\nTài khoản ngân hàng, Ví điện tử Momo …\r\nLink website và vô vàn các ứng dụng khác', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit sagittis leo ut gravida. Vivamus ultrices risus eu placerat vestibulum. Quisque mattis velit at nulla rhoncus laoreet. Sed tincidunt justo in leo semper, a porta odio commodo. Curabitur in odio placerat, consectetur nibh vehicula, semper lacus. Cras vitae consequat velit. Morbi felis felis, porta id massa at, euismod imperdiet massa. Donec sit amet hendrerit lacus. Suspendisse vitae nisi ut turpis commodo feugiat. Duis vitae faucibus mauris. Fusce diam arcu, tincidunt in libero id, malesuada bibendum ipsum. Ut consequat mattis mauris, nec tempor velit aliquet eget. Sed bibendum tortor est, quis posuere leo vulputate sodales.\r\n\r\nSuspendisse eros ex, imperdiet ac consectetur ut, molestie id odio. Aliquam vel varius arcu. Aenean volutpat sagittis tincidunt. Pellentesque mollis tristique lectus, et iaculis magna euismod vel. Sed nec lacinia odio, non placerat justo. Aenean odio ante, vestibulum sed ornare laoreet, vestibulum quis turpis. Fusce convallis molestie orci eget elementum.\r\n\r\nProin eleifend nisi et fringilla consequat. Morbi non turpis ex. Aliquam ut laoreet lorem, ac maximus lorem. Mauris suscipit lacus eu convallis gravida. Vivamus malesuada, est vestibulum egestas congue, diam augue hendrerit ligula, eget faucibus lacus ligula fringilla neque. Mauris maximus metus justo, et tincidunt risus maximus vitae. Donec faucibus egestas sodales. Suspendisse potenti. Aliquam tempus ex a sem sodales, quis semper mauris molestie. Quisque convallis eros sit amet accumsan ornare.\r\n\r\nMauris ac cursus elit, et dictum velit. Donec ipsum leo, vestibulum ut libero vitae, sagittis feugiat est. Curabitur ac ipsum non tortor euismod venenatis eget et libero. Aliquam sagittis ultrices nisl bibendum vestibulum. Ut non tellus eget risus tristique mollis id sit amet ante. Proin auctor erat sit amet dui condimentum tempus. Pellentesque ac lacinia velit. Aliquam sagittis, turpis posuere dignissim euismod, sapien eros finibus elit, at lacinia metus tellus nec leo. Vivamus malesuada euismod tellus, nec posuere est maximus eu. Morbi non semper dolor. Morbi turpis quam, placerat et ex id, feugiat lobortis sapien. Aliquam eget leo in lacus venenatis dictum a sit amet turpis. Proin quis feugiat quam.\r\n\r\nNulla pharetra erat placerat nibh elementum blandit. Quisque felis elit, tempus ut purus a, semper laoreet velit. Quisque massa justo, tempus at tempor eu, congue eu lacus. Curabitur porttitor lorem sit amet leo facilisis imperdiet. Aenean congue sollicitudin neque, pharetra venenatis nulla bibendum in. Ut eleifend nec libero sed semper. Aliquam commodo placerat diam, eget tincidunt eros dictum sed. Ut suscipit, tortor ac finibus finibus, ipsum ante ultrices massa, ut rutrum sapien nunc vitae lacus. Donec vel elementum nibh. Mauris scelerisque finibus felis. Integer tempor enim posuere efficitur interdum. Nunc egestas sapien ac augue porttitor, eget lobortis tellus mollis. Nulla facilisis lobortis tellus ut pellentesque.', 167000, 0, 0, 266, 'b3b616c2ae85cc057aa5aaf4dfc09a90.png', 1646615897, 0, 0, 1, 'card-visit-dep-07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên hiển thị',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'Ảnh đại diện',
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'Ảnh bìa',
  `full_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'Họ tên',
  `date_birth` int(11) NOT NULL DEFAULT '0' COMMENT 'Ngày sinh',
  `company` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'Công ty',
  `position` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'Chức vụ',
  `descrip` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Mô tả',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `user_name`, `password`, `avatar`, `cover`, `full_name`, `date_birth`, `company`, `position`, `descrip`, `created_at`, `updated_at`) VALUES
(1, 'ngothithuytrang06042000@gmail.com', 'Thùy trang', '1e184ab537f0d6d6d94bbb5790b1fee0', '0', '0', '0', 0, '0', '0', '', 1646470108, 0),
(2, 'ngothithuytrang06042018@gmail.com', 'Ngô Trang', '1e184ab537f0d6d6d94bbb5790b1fee0', '0', '0', '0', 0, '0', '0', '', 1646470711, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_details`
--
ALTER TABLE `bill_details`
 ADD PRIMARY KEY (`id`), ADD KEY `bill_id` (`bill_id`), ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `card_link`
--
ALTER TABLE `card_link`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `evaluates`
--
ALTER TABLE `evaluates`
 ADD PRIMARY KEY (`id`), ADD KEY `product_id` (`product_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `bill_details`
--
ALTER TABLE `bill_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `card_link`
--
ALTER TABLE `card_link`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `evaluates`
--
ALTER TABLE `evaluates`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill_details`
--
ALTER TABLE `bill_details`
ADD CONSTRAINT `bill_details_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`),
ADD CONSTRAINT `bill_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `card_link`
--
ALTER TABLE `card_link`
ADD CONSTRAINT `card_link_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `evaluates`
--
ALTER TABLE `evaluates`
ADD CONSTRAINT `evaluates_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
ADD CONSTRAINT `evaluates_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
