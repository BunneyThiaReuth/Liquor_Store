-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 24, 2022 at 01:05 PM
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
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `cateId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`cateId`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cateId`, `name`, `description`, `status`) VALUES
(2, 'White Wines', 'New Import', 1),
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
(40, 'Riesling', 'Reese-ling', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discount`
--

DROP TABLE IF EXISTS `tbl_discount`;
CREATE TABLE IF NOT EXISTS `tbl_discount` (
  `disID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `discountPerent` decimal(10,2) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`disID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_discount`
--

INSERT INTO `tbl_discount` (`disID`, `name`, `description`, `discountPerent`, `startDate`, `endDate`, `status`) VALUES
(1, 'For Red wine', 'Red wine 10%', '10.00', '2022-03-01', '2022-03-05', 0),
(2, 'No Discount', 'Of discount', '0.00', '2022-03-06', '2022-03-12', 1),
(3, 'White Wines', 'White Wines 0.55%', '0.55', '2022-03-13', '2022-03-19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

DROP TABLE IF EXISTS `tbl_products`;
CREATE TABLE IF NOT EXISTS `tbl_products` (
  `proID` int NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `cateID` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `disID` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `userID` int NOT NULL,
  PRIMARY KEY (`proID`),
  KEY `cate_FK` (`cateID`),
  KEY `disc_FK` (`disID`),
  KEY `user_FK` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `image`, `fistName`, `lastName`, `dob`, `gender`, `role`, `status`, `email`, `password`, `address`) VALUES
(18, '1647869892259897-sky-landscape.jpg', 'Lyna', 'Nita', '2000-04-12', 1, 1, 0, 'nita@gmail.com', 'e70b59714528d5798b1c8adaf0d0ed15', 'PP'),
(19, '1647194166Penguins.jpg', 'Hong', 'Davit', '2000-01-22', 1, 1, 1, 'davit@gmail.com', 'aead07469380d05a0ce17d36503e7adb', 'PP'),
(29, '1647421813employee wellness center_hero.jpg', 'Chong', 'Lina', '1998-10-02', 0, 2, 1, 'lina@gmail.com', 'f6f4deb7dad1c2e5e0b4d6569dc3c1c5', 'PP'),
(30, '1647428298Max-R_Headshot (1).jpg', 'Leng', 'Dina', '1992-10-02', 1, 2, 1, 'dina@gmail.com', 'e274648aed611371cf5c30a30bbe1d65', 'PP'),
(31, '1647428420d5jA8OZv.jpg', 'Seng', 'Dara', '1992-12-02', 1, 3, 0, 'dara@gmai.com', 'e5606dfd4d68db8b3d696d0b715892de', 'PP'),
(32, '16474285204.jpg', 'Meng', 'kakNika', '1992-09-12', 0, 2, 1, 'kaknika@gmail.com', 'bba577da2b09f14ba9a32205a7ca05e6', 'ST'),
(46, '16478554151.jpg', 'Bunney', 'ThiaReuth', '2000-09-20', 1, 3, 1, 'bunneythiareuth@gmail.com', '202cb962ac59075b964b07152d234b70', 'PP'),
(47, '1647945189Hydrangeas.jpg', 'User', 'Admin', '2022-03-22', 1, 3, 1, 'admin@gmail.com', 'b433ce675b32a824e24d762ca0fa1ba9', 'PP');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `cate_FK` FOREIGN KEY (`cateID`) REFERENCES `tbl_category` (`cateId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disc_FK` FOREIGN KEY (`disID`) REFERENCES `tbl_discount` (`disID`),
  ADD CONSTRAINT `user_FK` FOREIGN KEY (`userID`) REFERENCES `tbl_user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
