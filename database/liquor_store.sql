-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 13, 2022 at 06:11 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  PRIMARY KEY (`proID`),
  KEY `cate_FK` (`cateID`),
  KEY `disc_FK` (`disID`)
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
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `image`, `fistName`, `lastName`, `dob`, `gender`, `role`, `status`, `email`, `password`, `address`) VALUES
(17, '16471940011.jpg', 'Bunney', 'ThiaReuth', '2000-09-20', 1, 3, 1, 'thiareuht@gmail.com', 'admin', 'PP'),
(18, '1647194064Koala.jpg', 'Ly', 'Nita', '2000-04-12', 2, 1, 1, 'nita@gmail.com', 'sale', 'PP'),
(19, '1647194166Penguins.jpg', 'Hong', 'Davit', '2003-01-22', 1, 2, 1, 'davit@gmail.com', 'stock', 'PP'),
(20, '1647194347noimage.png', 'Admin', 'IT', '2000-10-02', 1, 3, 0, 'adminit@gmail.com', 'adminit', 'PP');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `cate_FK` FOREIGN KEY (`cateID`) REFERENCES `tbl_category` (`cateId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disc_FK` FOREIGN KEY (`disID`) REFERENCES `tbl_discount` (`disID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
