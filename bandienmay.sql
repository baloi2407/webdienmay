-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 21, 2024 at 11:51 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bandienmay`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `matkhau` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `email`, `matkhau`) VALUES
(1, 'Nguyen Loi', 'admin123@email.com', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'admin2', 'admin2@email.com', '21232f297a57a5a743894a0e4a801fc3'),
(3, 'admin3', 'admin3@email.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_baiviet`
--

CREATE TABLE `tbl_baiviet` (
  `baiviet_id` int(11) NOT NULL,
  `tenbaiviet` varchar(200) NOT NULL,
  `tomtat` text NOT NULL,
  `noidung` text NOT NULL,
  `danhmuctin_id` int(11) NOT NULL,
  `baiviet_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_baiviet`
--

INSERT INTO `tbl_baiviet` (`baiviet_id`, `tenbaiviet`, `tomtat`, `noidung`, `danhmuctin_id`, `baiviet_image`) VALUES
(1, 'Bài 1 There is NO SALVATION without repentance and trusting in Jesus. After repentance, water baptism by full immersion is a BIBLICAL COMMAND. ', 'There is NO SALVATION without repentance and trusting in Jesus. After repentance, water baptism by full immersion is a BIBLICAL COMMAND. BEWARE of any religious teacher in a church, crusade, or on the airwaves that uses psychology, philosophy,or endless talking, but DOES NOT use the BIBLE or does not teach repentance followed by water baptism by immersion. Infant and sprinkling baptism are SATAN′S COUNTERFEITS.', 'The Rapture (which is called the “translation” and “caught up” in the Bible) WILL OCCUR on the Jewish Feast of Trumpets (usually in September). It could happen between now (2022) and the next three years. Have you REPENTED AND BEEN baptized by full immersion afterwards? Do you read and/or hear and obey the Bible? FEW DO, and ONLY those FEW will be raptured. Faith ONLY comes from GOD′S WORD. Do you encourage others to repent? Millions will soon be LEFT BEHIND, crying, “Lord, Lord open to us”‐Mt 25:11.\r\n     The Bible reveals diseases and public unrest shall increase in these latter days. The coronavirus and riots are only the beginning of more hardships that are coming before the Rapture (also called the “Caught Up” or Translation). The horrible Tribulation and Battle of Armageddon follow the Rapture.', 1, 'm1.jpg'),
(2, 'Bài 2 There is NO SALVATION without repentance and trusting in Jesus. After repentance, water baptism by full immersion is a BIBLICAL COMMAND. ', '', '', 2, 'm9.jpg'),
(3, 'Bài 3', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti rem dicta iusto. Doloremque minus perspiciatis similique porro ea rem ullam architecto, ipsum fuga, excepturi amet. Dolor similique repellat beatae dolorem.\r\n', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti rem dicta iusto. Doloremque minus perspiciatis similique porro ea rem ullam architecto, ipsum fuga, excepturi amet. Dolor similique repellat beatae dolorem.\r\n', 2, 'mm6.jpg'),
(5, 'iPhone 14 về cơ bản chỉ là một chiếc iPhone 13s và đây là lý do', 'Nếu các báo cáo xuất hiện thời gian qua là chính xác, Apple dường như đang có kế hoạch mang đến những thay đổi cực lớn cho các mẫu iPhone 14 cơ bản nhằm thúc đẩy người dùng lựa chọn model iPhone 14 Pro\r\n', 'iPhone 14 chỉ là một chiếc iPhone 13s\r\n- Theo một báo cáo gần đây, iPhone 14 và có thể là cả iPhone 14 Max sẽ không sử dụng chipset như dòng iPhone 14 Pro. Cụ thể, các model “Pro” sẽ có chipset A16 mới của Apple, có chính 48MP ở mặt sau và sử dụng thiết kế đục lỗ hình tròn + đục lỗ hình viên thuốc để chứa camera selfie cũng như các cảm biến Face ID. Ngoài ra, bạn cũng sẽ nhận được máy quét LiDAR trên dòng iPhone 14 Pro.\r\n- Trong khi đó, theo các nguồn tin, iPhone 14 chỉ sử dụng một phiên bản sửa đổi nhẹ của chipset A15 hiện tại được sử dụng trong dòng iPhone 13. Ngoài ra, cả iPhone 14 và iPhone 14 Max đều sẽ giữ nguyên cảm biến camera chính 12MP như trước đây và không có điện thoại nào sẽ nhận được thiết kế đục lỗ mới.\r\n- Trên thực tế, khía cạnh duy nhất mà iPhone 14 và iPhone 14 Max được quan tâm thực sự là ở bộ phận RAM. Cả hai điện thoại dường như sẽ có cùng dung lượng RAM như iPhone 13 Pro và iPhone 13 Pro Max, ở mức 6GB thay vì 4GB. Tất nhiên, điều này sẽ giúp cải thiện hiệu suất, nhưng điện thoại vẫn sẽ bị tụt hậu rất nhiều so với các mẫu Pro mới với chip A16 Bionic hoàn toàn mới.\r\nTại sao Apple lại làm điều này?\r\n- Trong một thế giới lý tưởng, mọi người đều sẽ mua iPhone Pro của Apple. Bạn sẽ nhận được thông số kỹ thuật, hiệu suất tốt hơn, và Apple sẽ kiếm được nhiều tiền hơn. Nhưng chúng ta không sống trong một thế giới lý tưởng, vì hầu hết mọi người không có khả năng mua các model “Pro” hoặc một số người có thể mua chúng nhưng cảm thấy không cần thiết. Dù bằng cách nào, các mẫu giá rẻ luôn là lựa chọn phổ biến nhất.\r\n- Để bán được nhiều mẫu Pro hơn của mình, Apple phải thực sự tạo ra sự khác biệt. Tất cả chúng ta đều biết các mẫu Pro có camera tốt hơn, nhưng sự khác biệt này chỉ xuất hiện ở những thế hệ đầu tiên. Giờ đây, các điện thoại này có CPU mới hơn, tốt hơn, hệ thống camera được cải tiến đáng kể và một thiết kế khác, nhờ vào việc thay thế phần tai thỏ bằng thiết kế lỗ đục mới.\r\n- Thông thường, nếu muốn có một chiếc iPhone lớn nhất có thể, người dùng sẽ phải mua mẫu Pro Max. Vào năm 2022, điều này sẽ không xảy ra khi iPhone 14 Max giá rẻ sẽ có màn hình kích thước tương tự như iPhone 14 Pro Max nhưng đi cùng thông số kỹ thuật và phần cứng như iPhone 14.\r\nTạm kết\r\n- Khi quyết định loại bỏ iPhone 14 Mini và thay thế nó bằng iPhone 14 Max, Apple có lẽ đã nhận thức rõ rằng, chiếc điện thoại mới này có thể ảnh hưởng đến doanh số của mẫu Pro Max lớn hơn. Tất nhiên, đây không phải là điều mà hãng muốn, vì vậy hãng bắt đầu nghĩ cách để buộc mọi người hướng tới các mẫu Pro và Pro Max. Và cách tốt nhất để làm điều đó? Làm cho iPhone 14 và iPhone 14 Max trở thành các tùy chọn kém hấp dẫn hơn nhiều bằng cách loại bỏ các tính năng tương ứng của chúng.', 3, 'iphone-14-cover.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_danhmuc`
--

CREATE TABLE `tbl_danhmuc` (
  `danhmuc_id` int(11) NOT NULL,
  `danhmuc_ten` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_danhmuc`
--

INSERT INTO `tbl_danhmuc` (`danhmuc_id`, `danhmuc_ten`) VALUES
(1, 'Điện thoại'),
(2, 'Thiết bị lớn'),
(3, 'TV');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_danhmuc_tin`
--

CREATE TABLE `tbl_danhmuc_tin` (
  `danhmuctin_id` int(11) NOT NULL,
  `tendanhmuc` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_danhmuc_tin`
--

INSERT INTO `tbl_danhmuc_tin` (`danhmuctin_id`, `tendanhmuc`) VALUES
(1, 'Kiến thức điện tử'),
(2, 'Kiến thức máy lạnh'),
(3, 'Kiến thức điện thoại');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_diachi`
--

CREATE TABLE `tbl_diachi` (
  `id_diachi` int(11) NOT NULL,
  `diachi` varchar(200) NOT NULL,
  `tennguoinhan` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_diachi`
--

INSERT INTO `tbl_diachi` (`id_diachi`, `diachi`, `tennguoinhan`, `phone`, `user_id`) VALUES
(1, 'E30/61A ấp 5 xã Hưng Long , huyện Bình Chánh', 'Kha Banh', '1235778888', 38),
(2, 'chung cu a, quan 1, thanh pho ho chi minh', 'Nguyen Thang', '0904376888', 39),
(3, '', '', '', 40),
(4, '', '', '', 41),
(5, '', '', '', 42),
(6, '', '', '', 46),
(7, '', '', '', 47),
(8, '', '', '', 33),
(9, '', '', '', 34),
(10, '', '', '', 48),
(11, '', '', '', 49),
(12, '', '', '', 50),
(13, '273 An D. Vương, Phường 3, Quận 5', 'ba loi', '0123456789', 51);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_donhang`
--

CREATE TABLE `tbl_donhang` (
  `donhang_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `khachhang_id` int(11) NOT NULL,
  `sanpham_id` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `mahang` varchar(200) NOT NULL,
  `ngaythang` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tinhtrang` int(11) NOT NULL,
  `huydon` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_donhang`
--

INSERT INTO `tbl_donhang` (`donhang_id`, `user_id`, `khachhang_id`, `sanpham_id`, `soluong`, `mahang`, `ngaythang`, `tinhtrang`, `huydon`) VALUES
(150, 39, 120, 46, 1, '44855', '2022-05-19 08:19:50', 1, 0),
(151, 39, 121, 44, 1, '46950', '2022-05-19 09:16:24', 1, 0),
(152, 39, 122, 42, 1, '11049', '2022-05-19 08:57:56', 0, 0),
(153, 39, 122, 38, 2, '46264', '2022-05-19 09:15:19', 1, 0),
(154, 51, 123, 45, 1, '45205', '2024-05-21 08:08:32', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gia`
--

CREATE TABLE `tbl_gia` (
  `id_gia` int(11) NOT NULL,
  `gia` varchar(100) NOT NULL,
  `loaigia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_gia`
--

INSERT INTO `tbl_gia` (`id_gia`, `gia`, `loaigia`) VALUES
(1, '1000000', 'Dưới 1 triệu'),
(2, '5000000', 'Dưới 5 triệu'),
(3, '10000000', 'Dưới 10 triệu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_giaodich`
--

CREATE TABLE `tbl_giaodich` (
  `giaodich_id` int(11) NOT NULL,
  `khachhang_id` int(11) NOT NULL,
  `sanpham_id` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `magiaodich` varchar(200) NOT NULL,
  `ngaythang` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tinhtrang` int(11) NOT NULL DEFAULT 0,
  `huydon` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_giaodich`
--

INSERT INTO `tbl_giaodich` (`giaodich_id`, `khachhang_id`, `sanpham_id`, `soluong`, `magiaodich`, `ngaythang`, `tinhtrang`, `huydon`, `user_id`) VALUES
(91, 45, 36, 1, '87314', '2022-04-15 14:18:59', 0, 0, 1),
(92, 46, 35, 1, '19968', '2022-04-15 14:19:37', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_giohang`
--

CREATE TABLE `tbl_giohang` (
  `giohang_id` int(11) NOT NULL,
  `sanpham_id` int(11) NOT NULL,
  `tensanpham` varchar(200) NOT NULL,
  `giasanpham` int(11) NOT NULL,
  `hinhanh` varchar(200) NOT NULL,
  `soluong` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_giohang`
--

INSERT INTO `tbl_giohang` (`giohang_id`, `sanpham_id`, `tensanpham`, `giasanpham`, `hinhanh`, `soluong`, `user_id`) VALUES
(170, 46, 'Máy lạnh Casper Inverter 1 HP IC-09TL32 ', 7111100, 'casper-ic-09tl32-1.-550x160.jpg', 1, 39);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_khachhang`
--

CREATE TABLE `tbl_khachhang` (
  `khachhang_id` int(11) NOT NULL,
  `khachhang_name` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `khachhang_address` varchar(200) NOT NULL,
  `giaohang` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_khachhang`
--

INSERT INTO `tbl_khachhang` (`khachhang_id`, `khachhang_name`, `phone`, `khachhang_address`, `giaohang`, `user_id`) VALUES
(120, 'Nguyen Thang', '0904376888', 'chung cu a, quan 1, thanh pho ho chi minh', 0, 39),
(121, 'Nguyen Thang', '0904376888', 'chung cu a, quan 1, thanh pho ho chi minh', 0, 39),
(122, 'Nguyen Thang', '0904376888', 'chung cu a, quan 1, thanh pho ho chi minh', 0, 39),
(123, 'ba loi', '0123456789', '273 An D. Vương, Phường 3, Quận 5', 0, 51);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_khachhang_account`
--

CREATE TABLE `tbl_khachhang_account` (
  `id` int(11) NOT NULL,
  `tendangnhap` varchar(200) NOT NULL,
  `matkhau` varchar(200) NOT NULL,
  `hoten` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ngaysinh` date NOT NULL,
  `phai` tinyint(1) NOT NULL DEFAULT 0,
  `ngaydangky` datetime NOT NULL DEFAULT current_timestamp(),
  `idgroup` tinyint(4) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `randomkey` varchar(100) NOT NULL,
  `sodutk` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_khachhang_account`
--

INSERT INTO `tbl_khachhang_account` (`id`, `tendangnhap`, `matkhau`, `hoten`, `email`, `ngaysinh`, `phai`, `ngaydangky`, `idgroup`, `active`, `randomkey`, `sodutk`) VALUES
(33, 'baloixyz', '827ccb0eea8a706c4c34a16891f84e7b', 'loi nguyen', 'nguyenbaloi2407@gmail.com', '2000-02-12', 1, '2022-03-31 05:48:21', 1, 1, 'csacsdc', ''),
(34, 'baloiabc', '827ccb0eea8a706c4c34a16891f84e7b', 'loi nguyen', 'baloiabc@email.com', '2222-02-02', 1, '2022-03-31 05:48:21', 2, 1, 'csacsdc', ''),
(35, 'long1234', '827ccb0eea8a706c4c34a16891f84e7b', 'long nguyen', 'long1234@email.com', '2222-02-02', 1, '2022-03-31 05:48:21', 3, 1, 'csacsdc', ''),
(36, 'vuong123', '25d55ad283aa400af464c76d713c07ad', 'Vuong Pham', 'vuong@email.com', '2000-02-02', 1, '2022-04-25 09:34:01', 0, 0, '8091588a3968da46e3e4', ''),
(37, 'minhthang', '25d55ad283aa400af464c76d713c07ad', 'minh thang', 'thang@email.com', '2000-02-02', 1, '2022-04-25 16:02:34', 0, 0, '3b465a97076b0db0e0c6', ''),
(38, 'banh10nam', '25d55ad283aa400af464c76d713c07ad', 'Kha Banh', 'banh@email.com', '2000-02-02', 1, '2022-04-27 20:30:09', 0, 0, 'd108ce39d7f265448f15', ''),
(39, 'thang123', '25d55ad283aa400af464c76d713c07ad', 'Nguyen Thang', 'thang123@email.com', '2002-01-02', 1, '2022-04-28 13:21:34', 3, 0, 'd6edad9c15c50b44d19d', '19900921092'),
(40, 'abc123', '25d55ad283aa400af464c76d713c07ad', 'abc12345', 'abc123@email.com', '2000-02-02', 1, '2022-04-28 15:34:18', 0, 0, 'cbfb1ba0abb2c4fc1689', ''),
(41, 'tuan123', '25d55ad283aa400af464c76d713c07ad', 'Nguyen Tuan', 'tuan123@email.com', '2000-02-02', 1, '2022-05-03 22:15:12', 0, 0, 'defda3da9cbf5cb1aa15', ''),
(48, 'abcdeefg', '25d55ad283aa400af464c76d713c07ad', 'abcde', 'abc@email.com', '0003-03-03', 0, '2022-05-19 16:04:33', 0, 0, 'cd7a3678e92f33f1affa', '0'),
(49, 'baloi12653', '25d55ad283aa400af464c76d713c07ad', 'loi nguyen', '12333333@email.com', '2222-02-22', 0, '2022-05-19 17:16:54', 0, 0, 'aba5d6a59e6e1d77c270', '0'),
(50, 'abc123abc', '25d55ad283aa400af464c76d713c07ad', '122331431', '1233333344@email.com', '2222-02-22', 0, '2022-05-19 17:17:58', 0, 0, '5020d4740d9dc02092f0', '0'),
(51, 'loi123', 'c87157c65386218e9957e99bf31aa88d', 'loi', 'loi@email.com', '2000-01-11', 0, '2024-05-21 15:07:04', 0, 0, '707d6f1e950271113400', '9.99999999999897e19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nhomquyen`
--

CREATE TABLE `tbl_nhomquyen` (
  `id_quyen` int(11) NOT NULL,
  `maquyen` int(11) NOT NULL,
  `tenquyen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quyen`
--

CREATE TABLE `tbl_quyen` (
  `id` int(11) NOT NULL,
  `quanlysp` int(11) NOT NULL DEFAULT 0,
  `quanlybaiviet` int(11) NOT NULL DEFAULT 0,
  `quanlytaikhoan` int(11) NOT NULL DEFAULT 0,
  `quanlydonhang` int(11) NOT NULL DEFAULT 0,
  `quanlykh` int(11) NOT NULL DEFAULT 0,
  `taikhoankh` int(11) NOT NULL DEFAULT 0,
  `quanlyslider` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_quyen`
--

INSERT INTO `tbl_quyen` (`id`, `quanlysp`, `quanlybaiviet`, `quanlytaikhoan`, `quanlydonhang`, `quanlykh`, `taikhoankh`, `quanlyslider`, `user_id`) VALUES
(9, 0, 0, 0, 0, 0, 0, 0, 34),
(10, 0, 0, 0, 0, 0, 0, 0, 33),
(11, 1, 0, 0, 1, 1, 1, 0, 35),
(12, 1, 1, 0, 1, 1, 1, 1, 39);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sanpham`
--

CREATE TABLE `tbl_sanpham` (
  `sanpham_id` int(11) NOT NULL,
  `danhmuc_id` int(11) NOT NULL,
  `sanpham_name` varchar(200) NOT NULL,
  `sanpham_mota` text NOT NULL,
  `sanpham_chitiet` text NOT NULL,
  `sanpham_gia` varchar(200) NOT NULL,
  `sanpham_giakhuyenmai` varchar(200) NOT NULL DEFAULT '0',
  `sanpham_active` int(11) NOT NULL,
  `sanpham_hot` int(11) NOT NULL,
  `sanpham_soluong` int(11) NOT NULL,
  `sanpham_image` varchar(200) NOT NULL,
  `luotmua` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sanpham`
--

INSERT INTO `tbl_sanpham` (`sanpham_id`, `danhmuc_id`, `sanpham_name`, `sanpham_mota`, `sanpham_chitiet`, `sanpham_gia`, `sanpham_giakhuyenmai`, `sanpham_active`, `sanpham_hot`, `sanpham_soluong`, `sanpham_image`, `luotmua`) VALUES
(24, 1, 'Iphone 6', '', '', '6000000', '10', 0, 0, 0, 'mk1.jpg', 0),
(26, 3, 'TV', 'Độ phân giải 4K hiển thị hình ảnh sắc nét, chi tiết gấp 4 lần Full HD\r\nCông nghệ PurColor mang đến khung hình rực rỡ với dải màu rộng hơn\r\n', 'Hình ảnh chi tiết, độ tương phản cao với công nghệ UHD Dimming\r\nCông nghệ Dolby Digital Plus mang đến âm thanh sống động mạnh mẽ\r\n', '5000000', '3', 0, 0, 0, '10049954.jpg', 0),
(28, 1, 'Iphone 7', 'Đang cập nhật', 'Đang cập nhật', '6000000', '5', 0, 0, 1, 'm1.jpg', 2),
(29, 1, 'Oppo', 'Đang cập nhật', 'Đang cập nhật', '5000000', '4', 0, 0, 6, 'm2.jpg', 2),
(30, 1, 'Iphone 8', 'Đang cập nhật', 'Đang cập nhật', '7000000', '6', 0, 1, 0, 'mk2.jpg', 2),
(38, 1, 'Điện thoại iPhone 11 64GB', 'Thời lượng pin tốt nhất từ trước tới nay', '', '14999000', '5', 0, 0, 8, 'iphone-xi-do-600x600.jpg', 1),
(39, 1, 'Điện thoại iPhone 11 Pro 64GB', 'Khi hiệu năng vượt qua mọi giới hạn\r\nCamera là một bước tiến lớn\r\n', 'Với 4 GB RAM và 64 GB bộ nhớ trong thì máy tự tin là một chiếc điện thoại chơi game rất mạnh có thể chơi mọi tựa game dù có đồ họa khủng tới đâu đi nữa đang có mặt trên Apple Store.', '20000000', '15', 0, 0, 4, 'iphone-11-pro-vang-600x600-600x600.jpg', 1),
(40, 1, 'Điện thoại Samsung Galaxy S22 Ultra 5G 128GB  ', 'Sở hữu một diện mạo đầy nổi bật\r\nCấu hình mạnh mẽ với Snapdragon 8 Gen 1\r\n', 'chiếc smartphone cao cấp nhất trong bộ 3 Galaxy S22 series mà Samsung đã cho ra mắt. Tích hợp bút S Pen hoàn hảo trong thân máy, trang bị vi xử lý mạnh mẽ cho các tác vụ sử dụng vô cùng mượt mà và nổi bật hơn với cụm camera không viền độc đáo mang đậm dấu ấn riêng', '30990000', '5', 0, 0, 10, 'Galaxy-S22-Ultra-Burgundy-600x600.jpg', 0),
(41, 3, 'Sony Android TV KD-50X80J', 'Công nghệ phân giải hình ảnh chất lượng 4K UHD\r\nTrang bị các cổng kết hỗ trợ nhu cầu chia sẻ của bạn\r\n', 'Tích hợp tiện ích tìm kiếm bằng giọng nói thông minh\r\nThiết kế hiện đại, tăng thêm vẻ tinh tế cho không gian\r\n', '169000000', '5', 0, 0, 3, '10047251-android-tivi-tcl-4k-50-inch-50p618-1_uem0-15.jpg', 0),
(42, 3, 'Smart Tivi Casper 32 inch 32HX6200', 'Tấm nền IPS giúp hình ảnh có màu sắc tự nhiên, chân thực\r\nCông nghệ Dolby Audio mang đến âm thanh vòm sống động \r\n', 'Thiết kế hiện đại sang trọng tô điểm không gian nội thất\r\nMàn hình 32 inch độ phân giải HD hiển thị hình ảnh rõ nét\r\n', '5000000', '1', 0, 0, 8, '10048227-smart-tivi-casper-32-inch-32hx6200-1_yj0s-gj.jpg', 1),
(43, 3, 'Android Tivi Casper 4K 50 inch 50UG6100', 'Hệ điều hành Android 9.0 Pie với kho ứng dụng giải trí phong phú đa dạng\r\nTrợ lý ảo Google Assistant, tìm kiếm bằng giọng nói hỗ trợ Tiếng Việt\r\n', 'Màn hình vô cực, góc cạnh tinh tế sang trọng tô điểm không gian nội thất\r\nĐộ phân giải 4K Ultra HD hiển thị hình ảnh sắc nét đến từng chi tiết\r\n', '123456789', '2', 0, 0, 7, '10048571-android-tivi-casper-4k-50-inch-50ug6100-1.jpg', 0),
(44, 3, 'Smart Tivi Samsung Crystal UHD 4K 43 inch UA43AU9000KXXV', 'Công nghệ UHD Dimming tăng cường độ chi tiết hiển thị của hình ảnh\r\nTrải nghiệm hình ảnh mượt mà với công nghệ Motion Xcelerator Turbo\r\n', 'Màn hình Airslim UHD 4K (3840 x 2160) hiển thị hình ảnh sắc nét\r\nCông nghệ Crystal 4K tối ưu hóa nâng cấp độ chi tiết của từng gam màu\r\n', '34678901', '23', 0, 0, 5, '10048778-smart-tivi-samsung-crystal-uhd-4k-43-inch-ua43au9000kxxv-1_ehqa-4g.jpg', 2),
(45, 3, 'Smart Tivi Samsung Crystal UHD 4K 50 inch UA50AU7000KXXV', 'Công nghệ PurColor tái hiện rực rỡ sắc màu cuộc sống\r\nSmart Tivi Samsung Crystal UHD 4K 50 inch UA50AU7000KXXV thuộc dòng smart tivi hiện đại với những công nghệ nổi bật mang đến cho bạn trải nghiệm xem hoàn hảo đậm chất điện ảnh. Công nghệ PurColor có khả năng tăng cường thêm nhiều dải màu sắc giúp những khung hình thêm rực rỡ và gần với màu tự nhiên nhất.', 'Màn hình Airslim UHD 4K hiển thị hình ảnh sắc nét đến từng chi tiết\r\nCông nghệ Crystal 4K tối ưu hóa nâng cấp độ chi tiết của từng gam màu\r\nCảm nhận chi tiết và sắc thái hoàn mỹ được hỗ trợ công nghệ HDR10+\r\nCông nghệ UHD Dimming tăng cường độ chi tiết hiển thị của hình ảnh\r\nCông nghệ Dynamic Crystal Color hiển thị chính xác một tỷ sắc màu\r\nTrải nghiệm hình ảnh mượt mà nhờ công nghệ Motion Xcelerator', '13390000', '23', 0, 0, 9, '10048777-smart-tivi-samsung-crystal-uhd-4k-50-inch-ua50au7000kxxv-1.jpg', 1),
(46, 2, 'Máy lạnh Casper Inverter 1 HP IC-09TL32 ', 'Máy lạnh Casper Inverter 1 HP IC-09TL32 sở hữu gam màu trắng trang nhã, vỏ bằng nhựa được bo cạnh viền thanh lịch, trên máy có màn hình hiển thị nhiệt độ dễ dàng quan sát khi sử dụng.\r\n\r\nDàn nóng có ống dẫn gas bằng đồng, độ bền cao, giúp máy làm lạnh nhanh chóng kết hợp với lá tản nhiệt bằng nhôm mang đến kích thước gọn nhẹ dễ dàng cho việc lắp đặt.', 'Máy lạnh Casper Inverter 1 HP IC-09TL32 trang bị chế độ Follow me tự động điều chỉnh nhiệt độ mát theo vị trí đặt remote hiện đại kết hợp với màn hình hiển thị nhiệt độ ngay trên vỏ nên dễ dàng theo dõi nhiệt độ đang sử dụng.', '7990000', '11', 0, 0, 6, 'casper-ic-09tl32-1.-550x160.jpg', 4),
(47, 2, 'Máy lạnh LG Inverter 1 HP V10API1', '', '', '1189000', '11', 0, 0, 0, 'lg-v10api1-12-550x160.jpg', 7),
(48, 2, 'Máy lạnh Toshiba 1 HP Inverter RAS-H10C4KCVG-V', 'Dàn lạnh: Máy lạnh Toshiba 1 HP Inverter RAS-H10C4KCVG-V mang sắc trắng, vỏ bằng nhựa, thiết kế viền bo tròn, trơn nhẵn, bề mặt sáng bóng dễ lau chùi.\r\n\r\nDàn nóng: Có ống dẫn gas bằng đồng làm lạnh nhanh chóng và hạn chế ăn mòn qua thời gian sử dụng. Lá tản nhiệt bằng nhôm sẽ gọn nhẹ hơn so với lá tản nhiệt bằng đồng, dễ dàng lắp đặt.', 'Máy lạnh Toshiba 1 HP Inverter RAS-H10C4KCVG-V sử dụng công nghệ Hybrid Inverter và chế độ Eco nhờ đó máy hoạt động ổn định, êm ái và tiết kiệm điện năng. Được trang bị các công nghệ khử khuẩn như bộ lọc chống nấm mốc, bộ lọc Toshiba IAQ và công nghệ chống bám bẩn Magic Coil mang đến không khí trong lành.', '29900000', '10', 0, 0, 10, 'toshiba-1-hp-inverter-ras-h10c4kcvg-v-1.-550x160.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `slider_id` int(11) NOT NULL,
  `slider_image` varchar(200) NOT NULL,
  `slider_active` int(11) NOT NULL DEFAULT 0,
  `slider_caption` varchar(200) NOT NULL,
  `slider_title` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`slider_id`, `slider_image`, `slider_active`, `slider_caption`, `slider_title`) VALUES
(1, 'b2.jpg', 1, 'Săn sale khuyến mãi', 'Banner tháng 5'),
(2, 'b4.jpg', 1, 'Khuyến mãi tháng 6', 'Banner tháng 7');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thongke`
--

CREATE TABLE `tbl_thongke` (
  `id` int(11) NOT NULL,
  `ngaydat` varchar(30) NOT NULL,
  `donhang` int(11) NOT NULL,
  `doanhthu` varchar(100) NOT NULL,
  `soluongban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_thongke`
--

INSERT INTO `tbl_thongke` (`id`, `ngaydat`, `donhang`, `doanhthu`, `soluongban`) VALUES
(9, '2021-04-17', 5, '2000000', 13),
(11, '2021-04-18', 4, '21500000', 5),
(12, '2021-05-19', 7, '3000000', 18),
(14, '2021-05-20', 7, '3000000', 18),
(15, '2022-06-17', 5, '3000000', 13),
(16, '2022-04-18', 4, '24500000', 5),
(17, '2022-04-19', 7, '3200000', 18),
(18, '2022-07-20', 7, '3100000', 18),
(19, '2022-04-25', 3, '18280000', 3),
(20, '2022-05-19', 3, '48062903.77', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thongkesp`
--

CREATE TABLE `tbl_thongkesp` (
  `id` int(11) NOT NULL,
  `sanpham_id` int(11) NOT NULL,
  `danhmuc_id` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `tongtien` varchar(200) NOT NULL,
  `ngaythang` varchar(100) NOT NULL,
  `danhmuc_ten` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_thongkesp`
--

INSERT INTO `tbl_thongkesp` (`id`, `sanpham_id`, `danhmuc_id`, `soluong`, `tongtien`, `ngaythang`, `danhmuc_ten`) VALUES
(26, 46, 2, 1, '7111100', '2022-05-19', 'Thiết bị lớn'),
(27, 44, 3, 1, '26702754', '2022-05-19', 'TV'),
(28, 42, 3, 1, '4950000', '2022-05-19', 'TV'),
(29, 38, 1, 2, '14249050', '2022-05-19', 'Điện thoại'),
(30, 45, 3, 1, '10310300', '2024-05-21', 'TV');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_baiviet`
--
ALTER TABLE `tbl_baiviet`
  ADD PRIMARY KEY (`baiviet_id`);

--
-- Indexes for table `tbl_danhmuc`
--
ALTER TABLE `tbl_danhmuc`
  ADD PRIMARY KEY (`danhmuc_id`);

--
-- Indexes for table `tbl_danhmuc_tin`
--
ALTER TABLE `tbl_danhmuc_tin`
  ADD PRIMARY KEY (`danhmuctin_id`);

--
-- Indexes for table `tbl_diachi`
--
ALTER TABLE `tbl_diachi`
  ADD PRIMARY KEY (`id_diachi`);

--
-- Indexes for table `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  ADD PRIMARY KEY (`donhang_id`);

--
-- Indexes for table `tbl_gia`
--
ALTER TABLE `tbl_gia`
  ADD PRIMARY KEY (`id_gia`);

--
-- Indexes for table `tbl_giaodich`
--
ALTER TABLE `tbl_giaodich`
  ADD PRIMARY KEY (`giaodich_id`);

--
-- Indexes for table `tbl_giohang`
--
ALTER TABLE `tbl_giohang`
  ADD PRIMARY KEY (`giohang_id`);

--
-- Indexes for table `tbl_khachhang`
--
ALTER TABLE `tbl_khachhang`
  ADD PRIMARY KEY (`khachhang_id`);

--
-- Indexes for table `tbl_khachhang_account`
--
ALTER TABLE `tbl_khachhang_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tendangnhap` (`tendangnhap`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_nhomquyen`
--
ALTER TABLE `tbl_nhomquyen`
  ADD PRIMARY KEY (`id_quyen`);

--
-- Indexes for table `tbl_quyen`
--
ALTER TABLE `tbl_quyen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD PRIMARY KEY (`sanpham_id`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `tbl_thongke`
--
ALTER TABLE `tbl_thongke`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_thongkesp`
--
ALTER TABLE `tbl_thongkesp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_baiviet`
--
ALTER TABLE `tbl_baiviet`
  MODIFY `baiviet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_danhmuc`
--
ALTER TABLE `tbl_danhmuc`
  MODIFY `danhmuc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_danhmuc_tin`
--
ALTER TABLE `tbl_danhmuc_tin`
  MODIFY `danhmuctin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_diachi`
--
ALTER TABLE `tbl_diachi`
  MODIFY `id_diachi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  MODIFY `donhang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `tbl_gia`
--
ALTER TABLE `tbl_gia`
  MODIFY `id_gia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_giaodich`
--
ALTER TABLE `tbl_giaodich`
  MODIFY `giaodich_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `tbl_giohang`
--
ALTER TABLE `tbl_giohang`
  MODIFY `giohang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `tbl_khachhang`
--
ALTER TABLE `tbl_khachhang`
  MODIFY `khachhang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `tbl_khachhang_account`
--
ALTER TABLE `tbl_khachhang_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_nhomquyen`
--
ALTER TABLE `tbl_nhomquyen`
  MODIFY `id_quyen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quyen`
--
ALTER TABLE `tbl_quyen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  MODIFY `sanpham_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_thongke`
--
ALTER TABLE `tbl_thongke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_thongkesp`
--
ALTER TABLE `tbl_thongkesp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
