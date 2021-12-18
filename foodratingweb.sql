-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 22, 2021 lúc 02:30 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `foodratingweb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `isAdmin` int(11) NOT NULL DEFAULT 0,
  `postID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`username`, `password`, `name`, `email`, `isAdmin`, `postID`) VALUES
('admin', 'admin', 'admin', 'admin@gmail.com', 1, NULL),
('anhngoc', '12345', 'Phan Anh Ngoc', 'anhngoc@gmail.com', 0, NULL),
('justhoaian', '123', 'An', 'hoaian@gmail.com', 0, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `commentID` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `word` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `point` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`commentID`, `username`, `content`, `time`, `word`, `point`) VALUES
(1, 'anhngoc', 'amazing', '2021-05-22 00:16:57', 'amazing, ', 10),
(2, 'justhoaian', 'This is amazing', '2021-05-22 00:27:08', 'amazing, ', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `drink`
--

CREATE TABLE `drink` (
  `postID` int(11) NOT NULL,
  `rating` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '5',
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `workingTime` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `priceRange` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `phoneNumber` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `drinkName` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `drink`
--

INSERT INTO `drink` (`postID`, `rating`, `address`, `image`, `workingTime`, `priceRange`, `phoneNumber`, `drinkName`) VALUES
(4, '5', 'HCM', 'img/thom.jpg', '8am-8pm', '20.000-50.000', '0387144625', 'Thơm Tea House'),
(6, '5', 'Binh Thanh District', 'img/koo.png', '7:00 - 23:00', '35.000đ - 70.000đ', '0316184561', 'Koo Cafe'),
(7, '5', 'District 1', 'img/blanchys.jpg', '8pm-3am', '200-1000', '0939262999', 'Blanchys Lounge');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `drinkstalltype`
--

CREATE TABLE `drinkstalltype` (
  `postID` int(11) NOT NULL,
  `drinkStallType` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `drinkstalltype`
--

INSERT INTO `drinkstalltype` (`postID`, `drinkStallType`) VALUES
(4, 'Takeaway'),
(6, 'Coffee&Tea'),
(7, 'Lounge');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `food`
--

CREATE TABLE `food` (
  `postID` int(11) NOT NULL,
  `rating` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '5',
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `workingTime` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `priceRange` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `phoneNumber` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `foodName` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `food`
--

INSERT INTO `food` (`postID`, `rating`, `address`, `image`, `workingTime`, `priceRange`, `phoneNumber`, `foodName`) VALUES
(1, '5', 'Nguyen Dinh Chieu, District 3', 'img/dmaris.jpg', '10am - 9pm', '45-90', '023145', 'DMaris'),
(2, '5', 'District 10', 'img/thom.jpg', '3pm - 10pm', '25-60', '090909', 'Thơm House'),
(3, '10', 'District 2', 'img/food2.jpg', '10am - 9pm', '200-300', '090909', 'Marcel Burger');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `foodstalltype`
--

CREATE TABLE `foodstalltype` (
  `postID` int(11) NOT NULL,
  `foodStallType` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `foodstalltype`
--

INSERT INTO `foodstalltype` (`postID`, `foodStallType`) VALUES
(1, 'Buffet'),
(2, 'Street Food'),
(3, 'Restaurant');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `isadmin`
--

CREATE TABLE `isadmin` (
  `isAdmin` int(11) NOT NULL,
  `isAdmin_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `isadmin`
--

INSERT INTO `isadmin` (`isAdmin`, `isAdmin_name`) VALUES
(0, 'user'),
(1, 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `postID` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rating` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '5',
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `workingTime` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `priceRange` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `phoneNumber` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post`
--

INSERT INTO `post` (`postID`, `name`, `rating`, `address`, `image`, `workingTime`, `priceRange`, `phoneNumber`) VALUES
(1, 'DMaris', '5', 'Nguyen Dinh Chieu, District 3', 'img/dmaris.jpg', '10am - 9pm', '45-90', '023145'),
(2, 'Thơm House', '5', 'District 10', 'img/thom.jpg', '3pm - 10pm', '25-60', '090909'),
(3, 'Marcel Burger', '10', 'District 2', 'img/food2.jpg', '10am - 9pm', '200-300', '090909'),
(4, 'Thơm Tea House', '5', 'HCM', 'img/thom.jpg', '8am-8pm', '20.000-50.000', '0387144625'),
(6, 'Koo Cafe', '5', 'Binh Thanh District', 'img/koo.png', '7:00 - 23:00', '35.000đ - 70.000đ', '0316184561'),
(7, 'Blanchys Lounge', '5', 'District 1', 'img/blanchys.jpg', '8pm-3am', '200-1000', '0939262999');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `preferences`
--

CREATE TABLE `preferences` (
  `postID` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `commentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `preferences`
--

INSERT INTO `preferences` (`postID`, `username`, `commentID`) VALUES
(3, 'anhngoc', 1),
(3, 'justhoaian', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sentimentalword`
--

CREATE TABLE `sentimentalword` (
  `word` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `weight` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sentimentalword`
--

INSERT INTO `sentimentalword` (`word`, `weight`) VALUES
('acceptable', 8),
('adorable', 10),
('agreeable', 10),
('amazing', 10),
('appetizing', 10),
('attractive', 10),
('awesome', 10),
('beautiful', 10),
('charming', 10),
('clean', 10),
('considerate', 10),
('cool', 8),
('courteous', 10),
('cute', 10),
('delicious', 10),
('delightful', 10),
('diligent', 10),
('elegant', 10),
('enthusiastic', 10),
('excellent', 10),
('fabulous', 10),
('fair', 7),
('fantastic', 10),
('generous', 10),
('good', 8),
('gorgeous', 10),
('happy', 10),
('heavenly', 10),
('helpful', 10),
('incredible', 10),
('inventive', 10),
('likable', 10),
('mind-blowing', 10),
('mouthwatering', 10),
('outstanding', 10),
('passionate', 10),
('pleasant', 10),
('reliable', 10),
('resourceful', 10),
('satisfied', 10),
('sensible', 10),
('sincere', 10),
('sleek', 10),
('splendid', 10),
('tasty', 10),
('tempting', 10),
('toothsome', 10),
('trustworthy', 10),
('wonderful', 10),
('yummy', 10);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`),
  ADD KEY `fk_account_isAdmin` (`isAdmin`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentID`);

--
-- Chỉ mục cho bảng `drink`
--
ALTER TABLE `drink`
  ADD PRIMARY KEY (`postID`);

--
-- Chỉ mục cho bảng `drinkstalltype`
--
ALTER TABLE `drinkstalltype`
  ADD PRIMARY KEY (`postID`);

--
-- Chỉ mục cho bảng `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`postID`);

--
-- Chỉ mục cho bảng `foodstalltype`
--
ALTER TABLE `foodstalltype`
  ADD PRIMARY KEY (`postID`);

--
-- Chỉ mục cho bảng `isadmin`
--
ALTER TABLE `isadmin`
  ADD PRIMARY KEY (`isAdmin`);

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postID`);

--
-- Chỉ mục cho bảng `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`postID`,`username`,`commentID`),
  ADD KEY `fk_preferences_account` (`username`),
  ADD KEY `fk_preferences_comment` (`commentID`);

--
-- Chỉ mục cho bảng `sentimentalword`
--
ALTER TABLE `sentimentalword`
  ADD PRIMARY KEY (`word`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `fk_account_isAdmin` FOREIGN KEY (`isAdmin`) REFERENCES `isadmin` (`isAdmin`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `fk_preferences_account` FOREIGN KEY (`username`) REFERENCES `account` (`username`),
  ADD CONSTRAINT `fk_preferences_comment` FOREIGN KEY (`commentID`) REFERENCES `comment` (`commentID`),
  ADD CONSTRAINT `fk_preferences_post` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
