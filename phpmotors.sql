-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Dec 07, 2021 at 06:44 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used'),
(37, 'Electric');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(7, 'Daniel', 'Rogers', 'danielirogers3@gmail.com', '$2y$10$L/xAhACBAlrSVHhU0y79OurXPkRD3gGllqjbpWoQ.4O5F0wr6BBki', '1', NULL),
(9, 'Katherine', 'McCombs', 'Katherine@McCombs.com', '$2y$10$RWoppdtu02GYoHE4ub.E/e6VhDXEvXX1iwXZv/Yr9XkFEnIulpi4y', '1', NULL),
(10, 'Jane', 'Doe', 'Jane@Doe.com', '$2y$10$FXtDC45d7Gsy2Q1.r2M1busm0lI1M1351kgOt8TLxq2gMx64DUI1S', '1', NULL),
(11, 'James', 'Cordin', 'James@Cordin.com', '$2y$10$L.Z4JiShn1WE6/FHDS0L8.eYit0EHa2g8PBjM59I9InVYYWk3u3lu', '1', NULL),
(12, 'Sam', 'Smith', 'Sam@smith.com', '$2y$10$ie/cDVeKT8i38vBVEaGijOrqzkRamFK0DYhlgHq6CpNAvSd3WCPl.', '1', NULL),
(14, 'Admin', 'User', 'admin@cse340.net', '$2y$10$PEM8/ICAMZ.Iew8rXm.5ee55fgh47FOQjpxd2I5D6GP5qPq1Bl8yq', '3', NULL),
(15, 'Ian', 'Rogers', 'ian@Rogers.com', '$2y$10$leqsO1ll/vp8d0TX0.qd4eXaUNLVQgxhU4FtHP.XkhNdi09IGJWGu', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int NOT NULL,
  `invId` int NOT NULL,
  `imgName` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `imgPath` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `imgPrimary` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(3, 3, 'adventador.jpg', '/phpmotors/uploads/images/adventador.jpg', '2021-11-27 04:02:49', 1),
(4, 3, 'adventador-tn.jpg', '/phpmotors/uploads/images/adventador-tn.jpg', '2021-11-27 04:02:49', 1),
(5, 1, 'wrangler.jpg', '/phpmotors/uploads/images/wrangler.jpg', '2021-11-27 04:03:43', 1),
(6, 1, 'wrangler-tn.jpg', '/phpmotors/uploads/images/wrangler-tn.jpg', '2021-11-27 04:03:43', 1),
(7, 2, 'model-t.jpg', '/phpmotors/uploads/images/model-t.jpg', '2021-11-27 04:04:00', 1),
(8, 2, 'model-t-tn.jpg', '/phpmotors/uploads/images/model-t-tn.jpg', '2021-11-27 04:04:00', 1),
(9, 4, 'monster-truck.jpg', '/phpmotors/uploads/images/monster-truck.jpg', '2021-11-27 04:04:10', 1),
(10, 4, 'monster-truck-tn.jpg', '/phpmotors/uploads/images/monster-truck-tn.jpg', '2021-11-27 04:04:10', 1),
(11, 5, 'mechanic.jpg', '/phpmotors/uploads/images/mechanic.jpg', '2021-11-27 04:04:27', 1),
(12, 5, 'mechanic-tn.jpg', '/phpmotors/uploads/images/mechanic-tn.jpg', '2021-11-27 04:04:27', 1),
(13, 6, 'batmobile.jpg', '/phpmotors/uploads/images/batmobile.jpg', '2021-11-27 04:04:54', 1),
(14, 6, 'batmobile-tn.jpg', '/phpmotors/uploads/images/batmobile-tn.jpg', '2021-11-27 04:04:54', 1),
(15, 7, 'mystery-van.jpg', '/phpmotors/uploads/images/mystery-van.jpg', '2021-11-27 04:05:07', 1),
(16, 7, 'mystery-van-tn.jpg', '/phpmotors/uploads/images/mystery-van-tn.jpg', '2021-11-27 04:05:07', 1),
(17, 8, 'fire-truck.jpg', '/phpmotors/uploads/images/fire-truck.jpg', '2021-11-27 04:05:19', 1),
(18, 8, 'fire-truck-tn.jpg', '/phpmotors/uploads/images/fire-truck-tn.jpg', '2021-11-27 04:05:19', 1),
(19, 9, 'crwn-vic.jpg', '/phpmotors/uploads/images/crwn-vic.jpg', '2021-11-27 04:05:29', 1),
(20, 9, 'crwn-vic-tn.jpg', '/phpmotors/uploads/images/crwn-vic-tn.jpg', '2021-11-27 04:05:29', 1),
(21, 10, 'camaro.jpg', '/phpmotors/uploads/images/camaro.jpg', '2021-11-27 04:05:42', 1),
(22, 10, 'camaro-tn.jpg', '/phpmotors/uploads/images/camaro-tn.jpg', '2021-11-27 04:05:42', 1),
(23, 11, 'escalade.jpg', '/phpmotors/uploads/images/escalade.jpg', '2021-11-27 04:05:56', 1),
(24, 11, 'escalade-tn.jpg', '/phpmotors/uploads/images/escalade-tn.jpg', '2021-11-27 04:05:56', 1),
(25, 13, 'aerocar.jpg', '/phpmotors/uploads/images/aerocar.jpg', '2021-11-27 04:06:23', 1),
(26, 13, 'aerocar-tn.jpg', '/phpmotors/uploads/images/aerocar-tn.jpg', '2021-11-27 04:06:23', 1),
(27, 14, 'van.jpg', '/phpmotors/uploads/images/van.jpg', '2021-11-27 04:06:35', 1),
(28, 14, 'van-tn.jpg', '/phpmotors/uploads/images/van-tn.jpg', '2021-11-27 04:06:35', 1),
(29, 18, 'no-image.png', '/phpmotors/uploads/images/no-image.png', '2021-11-27 04:06:52', 1),
(30, 18, 'no-image-tn.png', '/phpmotors/uploads/images/no-image-tn.png', '2021-11-27 04:06:52', 1),
(31, 19, 'delorean.jpg', '/phpmotors/uploads/images/delorean.jpg', '2021-11-27 04:09:05', 1),
(32, 19, 'delorean-tn.jpg', '/phpmotors/uploads/images/delorean-tn.jpg', '2021-11-27 04:09:05', 1),
(33, 1, 'Jeep.jpeg', '/phpmotors/uploads/images/Jeep.jpeg', '2021-11-27 04:09:35', 0),
(34, 1, 'Jeep-tn.jpeg', '/phpmotors/uploads/images/Jeep-tn.jpeg', '2021-11-27 04:09:35', 0),
(35, 1, 'JeepW.jpeg', '/phpmotors/uploads/images/JeepW.jpeg', '2021-11-27 04:11:55', 0),
(36, 1, 'JeepW-tn.jpeg', '/phpmotors/uploads/images/JeepW-tn.jpeg', '2021-11-27 04:11:55', 0),
(37, 2, 'modelt1.jpg.jpeg', '/phpmotors/images/vehicles/modelt1.jpg.jpeg', '2021-11-27 19:32:28', 0),
(38, 2, 'modelt1.jpg-tn.jpeg', '/phpmotors/images/vehicles/modelt1.jpg-tn.jpeg', '2021-11-27 19:32:28', 0),
(39, 2, 'modelt2.jpg.jpeg', '/phpmotors/images/vehicles/modelt2.jpg.jpeg', '2021-11-27 19:32:36', 0),
(40, 2, 'modelt2.jpg-tn.jpeg', '/phpmotors/images/vehicles/modelt2.jpg-tn.jpeg', '2021-11-27 19:32:36', 0),
(41, 3, 'adventador1.jpg', '/phpmotors/images/vehicles/adventador1.jpg', '2021-11-27 19:34:16', 0),
(42, 3, 'adventador1-tn.jpg', '/phpmotors/images/vehicles/adventador1-tn.jpg', '2021-11-27 19:34:16', 0),
(43, 3, 'aventador2.jpg', '/phpmotors/images/vehicles/aventador2.jpg', '2021-11-27 19:34:25', 0),
(44, 3, 'aventador2-tn.jpg', '/phpmotors/images/vehicles/aventador2-tn.jpg', '2021-11-27 19:34:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep ', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!', '/phpmotors/images/vehicles/wrangler.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '28045', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.', '/phpmotors/images/vehicles/model-t.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '30000', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/phpmotors/images/vehicles/adventador.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '417650', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '150000', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. However, with a little tender loving care it will run as good a new.', '/phpmotors/images/vehicles/mechanic.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '100', 1, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.', '/phpmotors/images/vehicles/batmobile.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '65000', 1, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '10000', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '50000', 1, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '10000', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '25000', 10, 'Silver', 3),
(11, 'Cadillac', 'Escalade', 'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '75195', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '58800', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!', '/phpmotors/images/vehicles/aerocar.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '1000000', 1, 'Red', 2),
(14, 'FBI', 'Surveillance Van', 'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month. ', '/phpmotors/images/vehicles/van.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '20000', 1, 'Green', 1),
(15, 'Dog ', 'Car', 'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.', '/phpmotors/images/vehicles/no-image.png', '/phpmotors/images/vehicles/no-image-tn.png', '35000', 1, 'Brown', 2),
(18, 'Tesla', 'Model X', 'Teslas Mid crossover. Seats 7 people comfortably and extremely fast!', '/phpmotors/images/vehicles/no-image.png', '/phpmotors/images/vehicles/no-image-tn.png', '78000', 2, 'Blue', 37),
(19, 'DMC', 'Delorean', 'Amazing Car', '/image', '/image', '21000', 1, 'white', 3);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invId` int NOT NULL,
  `clientId` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(58, 'This is one of the rarest classic cars out there! It is a fun drive!', '2021-12-06 21:07:46', 2, 14),
(59, 'Here is another Review of this car.', '2021-12-06 21:31:07', 2, 14),
(60, 'Here is a review.', '2021-12-06 21:31:23', 13, 14),
(61, 'Stuff', '2021-12-06 21:37:22', 13, 14),
(66, 'blah', '2021-12-07 04:41:10', 2, 14),
(67, 'This is a comment from Ian! And tested with the Edit.', '2021-12-07 04:47:43', 2, 15),
(68, 'blah', '2021-12-07 05:30:34', 4, 14),
(70, 'We need to actually add a review.', '2021-12-07 06:36:11', 3, 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `FK_inv_images` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_client` (`clientId`),
  ADD KEY `FK_reviews_inventory` (`invId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_client` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
