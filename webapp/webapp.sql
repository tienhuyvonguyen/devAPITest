-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-server
-- Generation Time: Mar 07, 2023 at 04:16 AM
-- Server version: 8.0.19
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `picture` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '../../../uploads/products/PRODUCTS-ICON.png',
  `stock` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `price`, `name`, `picture`, `stock`) VALUES
(4, '10.00', 'meow heart attack', '../uploads/products/IMG_0256.JPG', 9),
(5, '34.00', 'pointer like $h1t', '../uploads/products/IMG_1353.JPG', 4),
(6, '20.00', '$h1tty c0d3', '../uploads/products/IMG_0715.JPG', 10),
(7, '30.00', 'private ip bea', '../uploads/products/IMG_1215.JPG', 10),
(8, '10.00', 'wowy fill me duh', '../uploads/products/IMG_1290.JPG', 0),
(9, '500.00', 'CCS', '../uploads/products/IMG_0953.JPG', -1),
(10, '40.00', 'resp code in the nutshell', '../uploads/products/IMG_1004.JPG\r\n', 3),
(11, '300.00', 'data scientist ', '../uploads/products/IMG_1220.JPG\r\n', 10),
(12, '30.00', 'bmw roast benz', '../uploads/products/IMG_1297.JPG', 0),
(13, '50.00', 'compression in the nutshell', '../uploads/products/IMG_1229.JPG', 4),
(14, '300.00', 'amdin pls', '../uploads/products/IMG_1262.PNG', 10),
(16, '30.00', 'udp $uck', '../uploads/products/IMG_1315.JPG', 3),
(17, '30.00', 'hecker be like', '../uploads/products/IMG_1316.JPG', 50),
(18, '300.00', 'the war never ended', '../uploads/products/IMG_1321.PNG', 10),
(19, '10.00', 'chemms programming', '../uploads/products/IMG_1372.JPG', 50),
(20, '300.00', 'wtf elon?', '../uploads/products/IMG_1356.JPG', 10),
(21, '30.00', 'random $hjt on the net', '../uploads/products/IMG_1320.JPG', 10),
(22, '10.00', 'me & my friend', '../uploads/products/IMG_1298.JPG\r\n', 3),
(23, '400.00', 'netcat for real', '../uploads/products/IMG_1292.JPG', 2),
(24, '0.00', 'end of the year... ', '../uploads/products/IMG_1358.JPG', 100000),
(25, '10.50', 'hello', '../../../uploads/products/PRODUCTS-ICON.png', 10),
(26, '10.50', 'test', '../../../uploads/products/PRODUCTS-ICON.png', 10),
(27, '10.50', 'test', '../../../uploads/products/PRODUCTS-ICON.png', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int NOT NULL,
  `status` int DEFAULT '0',
  `username` varchar(200) NOT NULL,
  `userPassword` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `userEmail` varchar(500) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `creditCard` int DEFAULT NULL,
  `avatar` varchar(1000) NOT NULL DEFAULT '../../uploads/avatars/ava.png',
  `balance` decimal(15,2) DEFAULT '0.00',
  `premiumTier` int DEFAULT '0',
  `premireExpire` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `status`, `username`, `userPassword`, `userEmail`, `phone`, `firstname`, `lastname`, `creditCard`, `avatar`, `balance`, `premiumTier`, `premireExpire`) VALUES
(8, 0, 'HUHU', '$2y$10$iqTKfc54Pfkc5zz3K78AauaA0ncCVaNEs6YoUt34WcnXzSmQbdoES', '', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(9, 0, 'MEO', '$2y$10$f6ZOMC2ZSeLwJelIaMCHme3ZYCzjH1WqaVpRm8mtn2NM7bvxR5fou', 'hello@gmail.com', NULL, NULL, NULL, 123, '../../uploads/avatars/ava.png', '3000.00', 3, '2023-11-23'),
(11, 0, 'THU', '$2y$10$LFk7LzdYLZfEPncMYC8JK.Yp6QceB/z8rmK463xl5SQZ80v/rvXQW', '', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(12, 0, 'CAT', '$2y$10$OqXaqz9NjMMF7F2m2KpUyuVAhuFw3Se6egoAgJ4qA6Rn/3VqXwTui', '', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(13, 0, '', '$2y$10$oFPRkbPbTJ4RQB78Dd07NeGOELUfDSZ8dh.Q1g1Kqzs3pL/rmgLNm', NULL, NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(15, 0, 'ASDA', '$2y$10$LqbBdbg8bnWhBuM5wt01puMLwkXSX/6m0Bcr44UnzGKv69oW9NAKO', 'meow@gmail.com', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(16, 1, 'ADMIN', 'admin123', 'admin@gmail.com', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(39, 0, 'ASDASD', 'asdasd', 'asdasdas', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(51, 0, 'MEOMEO', '$2y$10$wCYNA8NG156QSCjfJQ8Wge9RwwxhgyG32xmXMt2I39GG.g4wi/F8.', 'asdasdas@gmail.com', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(52, 1, 'DORA', '$2y$10$dICnqLZ/3XBRFl6BFwzHdujeTR3XZRupVSdwIz611t44Egz.pz7pS', 'dora', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(55, 0, 'ECHO', '$2y$10$pDqYY9eKQFVe1AblMHPzIePq3Ect5ZIJbBrN.YmXMhk4Jgz0qGDci', 'echo@gmail.com', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(58, 0, 'ECHO1', '$2y$10$WaKEkMrSl7hJq.CuXJwbyOW0Rkbvn7k3cOLVHtIFryilhYEG.sMgq', 'echo@gmail.com', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(59, 0, 'EC', '$2y$10$awLgk/craiPnl9NTuJr8e.54GGPjg5wb.nlsBQDcYQX3Mz.OxlP1q', 'echo@gmail.com', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(62, 0, 'EC12', '$2y$10$KLMKBRbptdXs/qMZsd.b7OvWFSRFOZW1BpiIhs6lS7OAVM7kaQYT6', 'echo@gmail.com', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(63, 0, 'TESTREGIS', '$2y$10$0s4w0K4ERmqAnWmcuiL4e.VW0ioKaA.L1.WjW9Uoln864bCe5/h2G', 'testregis@gmail.com', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(65, 0, 'TESTREGIS1', '$2y$10$al0S4612EVtGfaMwYJNLLex.Ugx6VoLvwi2yEc8gpPZ4MwZGdC02G', 'testregis@gmail.com', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(67, 1, 'TESTREGIS12', '$2y$10$KKaM0FFmZmC1mnE3ZEAGJ.COwKVEC9gb4xRmjODzdBXL6bQftV7bm', 'testregis@gmail.com', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(68, 0, 'TEST', '$2y$10$oriqgjpw0XJPIZIIFS3/X.fhoq7X5aqRL21cLUB/gJsix3.7fkZ06', 'test@gmail.com', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(70, 0, 'TESTNEW', '$2y$10$r4wtgxGV8sHCs8mHRAYpJ.JounnGJPc689ciXgQnOKTm18gII5Q4a', 'test@gmail.com', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(72, 0, 'TEST123', '$2y$10$qss3D2OUlrHgu9avw2DJtuP6to7ORqkBKiaBMS/ox2owncydhHUSu', 'test@gmail.com', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL),
(76, 0, 'TEST1234', '$2y$10$ZmqlNAxWFrgW5ttHdIQPpOVuV9EvXVmRWHZ8R4SFxX0STn4WDlU6C', 'test@gmail.com', NULL, NULL, NULL, NULL, '../../uploads/avatars/ava.png', '0.00', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
