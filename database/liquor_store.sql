-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 19, 2022 at 11:12 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `liquor_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_card`
--

DROP TABLE IF EXISTS `tbl_card`;
CREATE TABLE IF NOT EXISTS `tbl_card` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `ivnum` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `cateId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`cateId`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cateId`, `name`, `description`, `status`) VALUES
(2, 'White Wines', 'White Wines', 1),
(3, 'Rosé Wines', 'New Stock', 0),
(4, 'Sparkling Wines', 'New Stock', 1),
(5, 'Dessert Wines', 'New Stock', 0),
(32, 'Fortified Wines', 'Fortified Wines', 1),
(33, 'Cabernet Sauvignon', ' Full-Bodied Red Wine', 0),
(34, 'Syrah', 'Full-Bodied Red Wine', 1),
(35, 'Zinfandel', 'Zin-fan-dell', 1),
(36, 'Pinot Noir', 'Lighter-bodied Red Wine', 1),
(38, 'Sauvignon Blanc', 'Light- to Medium-Bodied White Wine', 1),
(39, 'Pinot Gris', 'Light-Bodied White Wine', 1),
(40, 'Riesling', 'Reese-ling', 1),
(108, 'Red Wines', 'For Red wine', 1),
(110, 'Rosé Wines', 'Rosé Wines', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discount`
--

DROP TABLE IF EXISTS `tbl_discount`;
CREATE TABLE IF NOT EXISTS `tbl_discount` (
  `disID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `discountPerent` int NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`disID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_discount`
--

INSERT INTO `tbl_discount` (`disID`, `name`, `description`, `discountPerent`, `startDate`, `endDate`, `status`) VALUES
(1, 'For Red wine', 'Red wine 10%', 10, '2022-03-01', '2022-03-05', 1),
(2, 'No Discount', 'Of discount', 0, '2022-03-06', '2022-03-12', 1),
(3, 'White Wines', 'White Wines 0.55%', 15, '2022-03-13', '2022-03-19', 1),
(11, 'Rosé Wines', 'Rosé Wines', 20, '2022-04-22', '2022-04-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_import`
--

DROP TABLE IF EXISTS `tbl_import`;
CREATE TABLE IF NOT EXISTS `tbl_import` (
  `impID` int NOT NULL AUTO_INCREMENT,
  `date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pid` int DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `userid` int DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`impID`),
  KEY `pid_FK` (`pid`),
  KEY `userId_FK` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_import`
--

INSERT INTO `tbl_import` (`impID`, `date`, `pid`, `price`, `qty`, `userid`, `desc`) VALUES
(1, '2022-03-29', 10, '13.00', '12', 30, 'up stock'),
(3, '2022-03-29', 4, '25.00', '15', 46, 'up stock'),
(4, '2022-03-29', 9, '10.00', '30', 30, 'up stock'),
(5, '2022-03-29', 11, '12.00', '10', 46, 'up stock'),
(6, '2022-04-20', 12, '19.00', '20', 46, 'up stock'),
(7, '2022-04-21', 4, '25.00', '120', 30, 'up stock'),
(8, '2022-04-22', 2, '60.00', '76', 46, 'up stock');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

DROP TABLE IF EXISTS `tbl_invoice`;
CREATE TABLE IF NOT EXISTS `tbl_invoice` (
  `invID` int NOT NULL AUTO_INCREMENT,
  `invNumber` int NOT NULL,
  `Date` date NOT NULL,
  `userID` int NOT NULL,
  `status` int NOT NULL,
  `not` varchar(100) NOT NULL,
  PRIMARY KEY (`invID`),
  UNIQUE KEY `invNumber` (`invNumber`),
  KEY `userInv_FK` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`invID`, `invNumber`, `Date`, `userID`, `status`, `not`) VALUES
(21, 1650267640, '2022-04-18', 19, 1, 'not1'),
(23, 1650341825, '2022-04-19', 19, 1, 'not2'),
(30, 1650618296, '2022-04-22', 19, 1, 'not3'),
(35, 1650647686, '2022-04-23', 19, 1, 'not4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoicedetail`
--

DROP TABLE IF EXISTS `tbl_invoicedetail`;
CREATE TABLE IF NOT EXISTS `tbl_invoicedetail` (
  `invDetailID` int NOT NULL AUTO_INCREMENT,
  `invNumber` int DEFAULT NULL,
  `proID` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`invDetailID`),
  KEY `proID_FK` (`proID`),
  KEY `invumber_FK` (`invNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_invoicedetail`
--

INSERT INTO `tbl_invoicedetail` (`invDetailID`, `invNumber`, `proID`, `price`, `qty`, `amount`) VALUES
(62, 1650267640, 2, '60.00', 2, '120.00'),
(63, 1650267640, 3, '29.00', 2, '58.00'),
(67, 1650341825, 2, '60.00', 3, '180.00'),
(68, 1650341825, 11, '10.80', 3, '32.40'),
(79, 1650618296, 2, '60.00', 3, '180.00'),
(80, 1650618296, 3, '29.00', 2, '58.00'),
(85, 1650647686, 2, '60.00', 2, '120.00'),
(86, 1650647686, 3, '29.00', 3, '87.00'),
(87, 1650647686, 6, '8.00', 5, '40.00'),
(88, 1650647686, 11, '10.80', 3, '32.40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

DROP TABLE IF EXISTS `tbl_products`;
CREATE TABLE IF NOT EXISTS `tbl_products` (
  `pro_id` int NOT NULL AUTO_INCREMENT,
  `pro_image` varchar(255) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `cateID` int NOT NULL,
  `pro_stock` int NOT NULL,
  `pro_price` decimal(10,2) NOT NULL,
  `pro_discount` int NOT NULL,
  `pro_date` date NOT NULL,
  `pro_description` varchar(255) NOT NULL,
  `userID` int NOT NULL,
  PRIMARY KEY (`pro_id`),
  KEY `cate_FK` (`cateID`),
  KEY `discount_FK` (`pro_discount`),
  KEY `user_FK` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`pro_id`, `pro_image`, `pro_name`, `cateID`, `pro_stock`, `pro_price`, `pro_discount`, `pro_date`, `pro_description`, `userID`) VALUES
(2, '1648195460product661_1.jpg', 'Beringer - Main & Vine', 2, 74, '60.00', 2, '2022-03-25', 'Beringer - Main & Vine - Pinot Grigio | Californian White Wine on VivinoWine', 46),
(3, '1648482419st_regis_chardonnay__02883.1343683816.jpg', 'St.Regis Chardonnay', 2, 114, '29.00', 2, '2022-03-25', 'St.Regis Chardonnay (Non-Alcoholic Wine), 25.4 Fl Oz', 31),
(4, '16481960331353416_s.jpg', 'Kimberly Main & Vine', 2, 120, '25.00', 2, '2022-03-25', 'Kimberly, Vinegar Champagne, 12.7 Ounce', 31),
(5, '1648204158product660_2.jpg', 'Beringer - Main & Vine', 35, 24, '18.00', 3, '2022-03-25', 'Manila Wine\r\nBeringer - Main & Vine - White Zinfandel | Californian Pink Wine', 31),
(6, '16482213030008520000059_1_A1C1_0600.png', ' Meijer Sutter Home White', 35, 1, '8.00', 2, '2022-03-25', 'Meijer\r\nSutter Home White Zinfandel Wine, 1.5 lt', 46),
(7, '1648221384product660_2 (1).jpg', 'Beringer - Main & Vine', 35, 20, '12.90', 3, '2022-03-25', 'Manila Wine\r\nBeringer - Main & Vine', 46),
(9, '1648221525702812367692600-A.jpg', 'Beachfront White', 35, 30, '10.00', 1, '2022-03-25', 'ALDI UK\r\nBeachfront White', 46),
(10, '1648221577Italian-Zinfandel-A.jpg', 'Italian Zinfandel', 35, 12, '13.00', 2, '2022-03-25', 'ALDI UK\r\nItalian Zinfandel', 46),
(11, '1648221648asc.jpg', 'Hilmar Springs Zinfandel', 35, 7, '12.00', 1, '2022-03-25', 'Drink Supermarket Hilmar Springs Zinfandel', 46),
(12, '1648743861scarlett-dark-red-wine-blend-xl-blog0316.jpg', 'Their Sweet Red Wine Blends', 108, 20, '19.00', 1, '2022-03-31', 'Americans Sure Do Love Their Sweet Red Wine Blends | Food & Wine', 46),
(13, '1650553860Italian-Zinfandel-A.jpg', 'Italian Red Wine Merlot 750 Ml', 108, 21, '29.00', 1, '2022-03-31', 'Alibaba\r\nItalian Red Wine Merlot 750 Ml', 46),
(14, '1650646230U0e4624d0f13b4f7bb67916b643709b9eO.jpg', 'Classic Red Wine Trio', 110, 200, '25.00', 11, '2022-04-22', 'Classic Red Wine Trio', 46);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `fistName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` int NOT NULL,
  `role` int NOT NULL,
  `status` int NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `password` (`password`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `image`, `fistName`, `lastName`, `dob`, `gender`, `role`, `status`, `email`, `password`, `address`) VALUES
(19, '1647194166Penguins.jpg', 'Hong', 'Davit', '2000-01-22', 1, 1, 1, 'davit@gmail.com', 'aead07469380d05a0ce17d36503e7adb', 'PP'),
(29, '1647421813employee wellness center_hero.jpg', 'Chong', 'Lina', '1998-10-02', 0, 1, 1, 'lina@gmail.com', 'f6f4deb7dad1c2e5e0b4d6569dc3c1c5', 'PP'),
(30, '1647428298Max-R_Headshot (1).jpg', 'Leng', 'Dina', '1992-10-02', 1, 2, 1, 'dina@gmail.com', 'e274648aed611371cf5c30a30bbe1d65', 'PP'),
(31, '1647428420d5jA8OZv.jpg', 'Seng', 'Dara', '1992-12-02', 1, 3, 1, 'dara@gmai.com', 'e5606dfd4d68db8b3d696d0b715892de', 'PP'),
(32, '16474285204.jpg', 'Meng', 'kakNika', '1992-09-12', 0, 2, 1, 'kaknika@gmail.com', '15152999e4f8d343989729e38793678e', 'ST'),
(46, '16484874371.jpg', 'Bunney', 'ThiaReuth', '2000-09-20', 1, 3, 1, 'bunneythiareuth@gmail.com', '202cb962ac59075b964b07152d234b70', '#207,st2011, Phnom Penh');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_import`
--
ALTER TABLE `tbl_import`
  ADD CONSTRAINT `pid_FK` FOREIGN KEY (`pid`) REFERENCES `tbl_products` (`pro_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userId_FK` FOREIGN KEY (`userid`) REFERENCES `tbl_user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD CONSTRAINT `userInv_FK` FOREIGN KEY (`userID`) REFERENCES `tbl_user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_invoicedetail`
--
ALTER TABLE `tbl_invoicedetail`
  ADD CONSTRAINT `invumber_FK` FOREIGN KEY (`invNumber`) REFERENCES `tbl_invoice` (`invNumber`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proID_FK` FOREIGN KEY (`proID`) REFERENCES `tbl_products` (`pro_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `cate_FK` FOREIGN KEY (`cateID`) REFERENCES `tbl_category` (`cateId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discount_FK` FOREIGN KEY (`pro_discount`) REFERENCES `tbl_discount` (`disID`),
  ADD CONSTRAINT `user_FK` FOREIGN KEY (`userID`) REFERENCES `tbl_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
