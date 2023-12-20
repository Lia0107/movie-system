-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2023-07-20 01:55:06
-- 服务器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `cinema`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin@hotmail.com', '11111111');

-- --------------------------------------------------------

--
-- 表的结构 `bill`
--

CREATE TABLE `bill` (
  `paymentID` int(11) NOT NULL,
  `itemName` varchar(200) NOT NULL,
  `itemDetail` text NOT NULL,
  `amount` double NOT NULL,
  `method` varchar(50) NOT NULL,
  `userID` int(11) NOT NULL,
  `qrCode` text NOT NULL,
  `movieID` int(11) NOT NULL,
  `movieOftime` time NOT NULL,
  `movieOfdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `bill`
--

INSERT INTO `bill` (`paymentID`, `itemName`, `itemDetail`, `amount`, `method`, `userID`, `qrCode`, `movieID`, `movieOftime`, `movieOfdate`) VALUES
(23, 'Popcorn\r\nSeat', 'F10 E12 F12', 115.45, 'cash', 146, 'qrcodes/F10 E12 F122023-08-240747 PM141.png', 2, '09:07:47', '2023-06-01'),
(24, 'Popcorn\r\nSeat', 'F10 E12 F12', 115.99, 'cash', 146, 'qrcodes/F10 E12 F122023-08-240747 PM141.png', 1, '10:07:47', '2023-08-17'),
(26, 'Popcorn\r\nSeat', 'F10 E12 F12', 115.99, 'cash', 146, 'qrcodes/F10 E12 F122023-08-240747 PM141.png', 1, '00:07:47', '2023-08-17'),
(27, 'Popcorn\nSeat', 'A13 B13 C13 A14 B14 C14', 205.99, 'cash', 163, 'qrcodes/A13 B13 C13 A14 B14 C142023-08-240747 PM141.png', 1, '00:07:47', '2023-08-24'),
(28, 'Popcorn\r\nSeat', 'A13 B13 C13 A14 B14 C14', 205.99, 'cash', 163, 'qrcodes/A13 B13 C13 A14 B14 C142023-08-240747 PM141.png', 1, '00:07:47', '2023-08-24'),
(49, 'Popcorn\r\nSeat', 'A13 B13 C13 A14 B14 C14', 205.99, 'cash', 163, 'qrcodes/A13 B13 C13 A14 B14 C142023-08-240747 PM141.png', 1, '00:07:47', '2023-08-24'),
(50, 'Popcorn\r\nSeat', 'A13 B13 C13 A14 B14 C14', 205.99, 'cash', 163, 'qrcodes/A13 B13 C13 A14 B14 C142023-08-240747 PM141.png', 1, '00:07:47', '2023-08-24'),
(51, 'Popcorn\r\nSeat', 'A13 B13 C13 A14 B14 C14', 205.99, 'cash', 163, 'qrcodes/A13 B13 C13 A14 B14 C142023-08-240747 PM141.png', 1, '00:07:47', '2023-08-24'),
(53, 'Seat', 'A1', 123, 'cash', 147, 'qrcodes/A12023-07-170548 PM112.png', 1, '00:05:48', '2023-07-17'),
(54, 'Seat', 'A1 A2 A3', 369, 'cash', 147, 'qrcodes/A1 A2 A32023-07-170505 PM111.png', 1, '00:05:05', '2023-07-17'),
(55, 'Seat', 'A1 A2', 246, 'cash', 147, 'qrcodes/A1 A22023-07-200509 PM112.png', 1, '00:05:09', '2023-07-20'),
(56, 'Seat', 'A1 A2', 246, 'cash', 147, 'qrcodes/A1 A22023-07-171206 PM111.png', 1, '00:12:06', '2023-07-17'),
(57, 'Seat', 'A1 A2', 246, 'cash', 147, 'qrcodes/A1 A22023-07-170120 PM111.png', 1, '00:01:20', '2023-07-17'),
(58, 'Seat', 'A1 A2', 246, 'cash', 147, 'qrcodes/A1 A22023-07-171224 PM111.png', 1, '00:12:24', '2023-07-17'),
(59, 'Seat', 'A1 A2', 246, 'cash', 147, 'qrcodes/A1 A22023-07-271229 PM111.png', 1, '00:12:29', '2023-07-27'),
(60, 'Seat', 'A1 A2', 246, 'cash', 147, 'qrcodes/A1 A22023-07-270129 PM111.png', 1, '00:01:29', '2023-07-27'),
(61, 'Seat', 'A1 A2', 246, 'cash', 147, 'qrcodes/A1 A22023-07-190337 PM111.png', 1, '00:03:37', '2023-07-19'),
(62, 'Seat', 'A1 A2 A3', 369, 'cash', 147, 'qrcodes/A1 A2 A32023-07-190439 PM111.png', 1, '00:04:39', '2023-07-19'),
(63, 'Popcorn\nSeat', 'A6 A7', 2502.99, 'cash', 147, 'qrcodes/A6 A72023-07-190439 PM111.png', 1, '00:04:39', '2023-06-09'),
(64, 'Seat', 'B1 B2', 2502.99, 'cash', 147, 'qrcodes/B1 B22023-07-190439 PM111.png', 1, '00:04:39', '2023-07-19'),
(65, 'Seat', 'A1 A2 A3 A4', 2748.99, 'cash', 147, 'qrcodes/A1 A2 A3 A42023-07-280352 PM111.png', 1, '00:03:52', '2023-07-28'),
(66, 'Seat', 'A1 A2 A3', 369, 'cash', 147, 'qrcodes/A1 A2 A32023-07-200442 PM111.png', 1, '00:04:42', '2023-07-20'),
(73, 'Seat', 'A1 A2', 246, 'cash', 147, 'qrcodes/A1 A22023-07-250248 AM111.png', 1, '00:02:48', '2023-07-25'),
(74, 'Seat', 'A3 A4', 246, 'cash', 147, 'qrcodes/A3 A42023-07-290254 AM111.png', 1, '00:02:54', '2023-07-29'),
(75, 'Seat', 'G1 G2 G3 G4', 492, 'online', 147, 'qrcodes/G1 G2 G3 G42023-07-290254 AM1115.png', 1, '00:02:54', '2023-07-29'),
(76, 'Seat', 'A1 A2 A3', 96, 'online', 147, 'qrcodes/A1 A2 A32023-07-210340 PM11171.png', 11, '00:03:40', '2023-07-21'),
(77, 'Seat', 'A1 A2 A3', 63, 'online', 147, 'qrcodes/A1 A2 A32023-07-180224 PM1111.png', 1, '00:02:24', '2023-07-18'),
(78, 'Seat', '', 0, 'online', 0, 'qrcodes/.png', 0, '00:00:00', '0000-00-00'),
(80, 'Seat', 'A1 A2', 30, 'online', 147, 'qrcodes/A1 A22023-07-200525 PM2111.png', 2, '00:05:25', '2023-07-20');

-- --------------------------------------------------------

--
-- 表的结构 `bookingfilm`
--

CREATE TABLE `bookingfilm` (
  `movieOfdate` date NOT NULL,
  `movieID` varchar(50) NOT NULL,
  `seatID` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `packageID` int(11) NOT NULL,
  `movieOftime` time NOT NULL,
  `userID` int(11) NOT NULL,
  `room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `bookingfilm`
--

INSERT INTO `bookingfilm` (`movieOfdate`, `movieID`, `seatID`, `branch`, `packageID`, `movieOftime`, `userID`, `room`) VALUES
('2023-07-17', '1', 'A3', '1', 1, '00:00:00', 147, 0),
('2023-07-17', '1', 'A4', '1', 1, '00:00:00', 147, 0),
('2023-07-17', '1', 'A5', '1', 1, '00:00:00', 147, 0),
('2023-07-17', '1', 'A6', '1', 1, '00:00:00', 147, 0),
('2023-07-17', '1', 'A7', '1', 1, '00:00:00', 147, 0),
('2023-07-17', '1', 'A8', '1', 1, '00:00:00', 147, 0),
('2023-07-17', '1', 'B1', '1', 1, '00:00:00', 147, 0),
('2023-07-17', '1', 'B2', '1', 1, '00:00:00', 147, 0),
('2023-07-17', '1', 'B3', '1', 1, '00:00:00', 147, 0),
('2023-07-17', '1', 'B4', '1', 1, '00:00:00', 147, 0),
('2023-07-17', '1', 'B5', '1', 1, '00:00:00', 147, 0),
('2023-07-17', '1', 'B6', '1', 1, '00:00:00', 147, 0),
('2023-07-17', '1', 'B7', '1', 1, '00:00:00', 147, 0),
('2023-07-17', '1', 'C7', '1', 1, '00:00:00', 147, 0),
('2023-07-17', '1', 'D7', '1', 1, '00:00:00', 147, 0),
('2023-07-17', '2', 'A3', '2', 2, '00:00:00', 147, 0),
('2023-07-18', '1', 'A1', '1', 1, '14:24:00', 147, 1),
('2023-07-18', '1', 'A1', '1', 1, '17:23:00', 149, 0),
('2023-07-18', '1', 'A1', '1', 1, '17:25:00', 147, 0),
('2023-07-18', '1', 'A2', '1', 1, '14:24:00', 147, 1),
('2023-07-18', '1', 'A2', '1', 1, '17:25:00', 147, 0),
('2023-07-18', '1', 'A3', '1', 1, '14:24:00', 147, 1),
('2023-07-18', '1', 'A3', '1', 1, '17:25:00', 147, 0),
('2023-07-18', '1', 'A4', '1', 1, '14:24:00', 147, 1),
('2023-07-18', '1', 'A7', '1', 1, '17:25:00', 140, 0),
('2023-07-18', '1', 'C4', '1', 1, '14:24:00', 165, 1),
('2023-07-18', '1', 'C5', '1', 1, '14:24:00', 165, 1),
('2023-07-18', '1', 'C6', '1', 1, '14:24:00', 165, 1),
('2023-07-18', '1', 'D5', '1', 1, '18:12:00', 165, 1),
('2023-07-18', '1', 'D6', '1', 1, '18:12:00', 165, 1),
('2023-07-18', '1', 'E6', '1', 1, '18:12:00', 165, 1),
('2023-07-18', '1', 'F5', '1', 1, '18:12:00', 165, 1),
('2023-07-20', '2', 'A1', '1', 1, '17:25:00', 147, 1),
('2023-07-20', '2', 'A2', '1', 1, '17:25:00', 147, 1),
('2023-07-21', '11', 'A1', '1', 7, '15:40:00', 147, 1),
('2023-07-21', '11', 'A2', '1', 7, '15:40:00', 147, 1),
('2023-07-21', '11', 'A3', '1', 7, '15:40:00', 147, 1),
('2023-07-29', '1', 'A1', '1', 1, '02:54:00', 147, 0),
('2023-07-29', '1', 'A2', '1', 1, '02:54:00', 147, 0),
('2023-07-29', '1', 'A3', '1', 1, '02:54:00', 147, 5),
('2023-07-29', '1', 'A4', '1', 1, '02:54:00', 147, 5),
('2023-07-29', '1', 'G1', '1', 1, '02:54:00', 147, 5),
('2023-07-29', '1', 'G2', '1', 1, '02:54:00', 147, 5),
('2023-07-29', '1', 'G3', '1', 1, '02:54:00', 147, 5),
('2023-07-29', '1', 'G4', '1', 1, '02:54:00', 147, 5);

-- --------------------------------------------------------

--
-- 表的结构 `branch`
--

CREATE TABLE `branch` (
  `branchID` int(11) NOT NULL,
  `branchName` varchar(123) NOT NULL,
  `address` text NOT NULL,
  `phoneNumber` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `branch`
--

INSERT INTO `branch` (`branchID`, `branchName`, `address`, `phoneNumber`) VALUES
(1, 'MP Subang Jaya', 'SS 15/4G, Ss 15, 47500 Subang Jaya, Selangor', '+60135790864'),
(2, 'MP Bandar Sunway', '7, Jalan PJS 11/7, Bandar Sunway, 47500 Subang Jaya, Selangor', '+60124680975'),
(3, 'MP Klang', 'No. 2112, KM2, Jln Meru, Kawasan 17, 41050 Klang, Selangor', '+60157908642'),
(4, 'MP Kepong', 'Block E-B2-1, Plaza Arkadia, 3, Jalan Intisari, Desa Parkcity, 52200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur', '+60146809764'),
(5, 'MP Puchong', 'Lot ET11, Phase 2, 3rd Floor, Batu 9, Jalan Puchong, Bandar Puchong Jaya, 47170 Puchong, Selangor.', '+60168097531');

-- --------------------------------------------------------

--
-- 表的结构 `movie`
--

CREATE TABLE `movie` (
  `movieID` int(11) NOT NULL,
  `movieName` varchar(200) NOT NULL,
  `Synopsis` text NOT NULL,
  `Director` varchar(200) NOT NULL,
  `Starring` text NOT NULL,
  `RunningTime` text NOT NULL,
  `Genre` text NOT NULL,
  `image` text NOT NULL,
  `status` text NOT NULL,
  `Trailers` text NOT NULL,
  `Fee` double NOT NULL,
  `Date` date NOT NULL DEFAULT '1970-01-01',
  `package` varchar(100) NOT NULL,
  `language` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `movie`
--

INSERT INTO `movie` (`movieID`, `movieName`, `Synopsis`, `Director`, `Starring`, `RunningTime`, `Genre`, `image`, `status`, `Trailers`, `Fee`, `Date`, `package`, `language`) VALUES
(1, 'Barbie Movie', 'Barbie and Ken are having the time of their lives in the colorful and seemingly perfect world of Barbie Land. However, when they get a chance to go to the real world, they soon discover the joys and perils of living among humans.\r\n', 'Greta Gerwig', 'Margot Robbie, Ryan Gosling, Simu Liu, Will Ferrell, and more.', '1hr 40min', 'Romance', '47f7b504f5213d168da10e4bf0ecdbc3.jpg', 'soon', 'https://www.youtube.com/watch?v=pBk4NYhWNMM', 21, '2023-07-21', 'IMAX', 'English'),
(2, 'Evil Dead Rise', 'A reunion between two estranged sisters gets cut short by the rise of flesh-possessing demons, thrusting them into a primal battle for survival as they face the most nightmarish version of family imaginable.', 'Lee Cronin', 'Alyssa Sutherland, Lily Sullivan, Bruce Campbell, and more.', '1hr 36min', 'Horror', '04187068e223aa831eac09906addfc30.jpg', 'released', 'https://www.youtube.com/watch?v=smTK_AeAPHs', 15, '2023-04-21', 'IMAX', 'English'),
(3, 'Spiderman: Spiderverse', 'After reuniting with Gwen Stacy, Brooklyn’s full-time, friendly neighborhood Spider-Man is catapulted across the Multiverse, where he encounters a team of Spider-People charged with protecting its very existence. ', 'Joaquim Dos Santos, Kemp Powers, Justin K. Thompso', 'Oscar Isaac, Shameik Moore, Hailee Steinfeld, and more.', '2hr 21min', 'Action', '61d57d1f73f3cecd7555e07f0747c03d.jpg', 'top', 'https://www.youtube.com/watch?v=shW9i6k8cB0', 19, '2023-06-02', 'IMAX', 'English'),
(4, 'Fast X', 'Dominic Toretto must protect his crew and family from Cipher, who has joined forces with Dante, the son of Hernan Reyes.', 'Louis Leterrier', 'in Diesel, Michelle Rodriguez, Jason Momoa, John Cena, Jason Statham, and more.', '2hr 20min', 'Action', 'dcada8bdb1c537d78440b12cd6d83f41.jpg', 'top', 'https://www.youtube.com/watch?v=32RAq6JzY-w', 18, '2023-05-18', 'IMAX', 'English'),
(5, 'Little Mermaid', 'Princess Ariel is a mermaid who dreams of exploring the human world. As she falls in love with a prince above-ground, she`s desperate enough to make a dangerous deal with sea witch Ursula. ', 'Rob Marshall', 'Halle Bailey, Jonah Hauer-King, Daveed Diggs, and more.', '2hr 16min', 'Mystery', '44fc8a543a26684723e90c6ca56422f7.jpg', 'released', 'https://www.youtube.com/watch?v=kpGo2_d3oYE', 18, '2023-05-25', 'IMAX', 'English'),
(6, 'Super Mario Bros', 'With help from Princess Peach, Mario gets ready to square off against the all-powerful Bowser to stop his plans from conquering the world.', 'Aaron Horvath, Michael Jelenic', 'Chris Pratt, Anya Taylor-Joy, Charlie Day, Jack Black, and more.', '1hr 33min', 'Comedy', '903c39ebc26aa6ec4669a56a800ed65a.jpg', 'released', 'https://www.youtube.com/watch?v=TnGl01FkMMo', 16, '2023-04-20', 'IMAX', 'English'),
(7, 'Transformers', 'Optimus Prime and the Autobots take on their biggest challenge yet. When a new threat capable of destroying the entire planet emerges, they must team up with a powerful faction of Transformers known as the Maximals to save Earth.', 'Steven Caple Jr.', 'Anthony Ramos, Pete Davidson,  and more.', '2hr 7min', 'Action', '7d398a8ee8b049c2b5534832dfbf1f1f.jpg', 'released', 'https://www.youtube.com/watch?v=itnqEauWQZM', 18, '2023-06-09', 'IMAX!!', 'English'),
(9, 'Elemental', 'In a city where fire, water, land, and air residents live together, a fiery young woman and a go-with-the-flow guy discover something elemental: how much they actually have in common.', 'Peter Sohn', 'Leah Lewis, Mamoudou Athie, Joe Hara, and more.', '1hr 42min', 'Comedy', 'e4e7d2fe09f1e42a246751a5e0c87431.jpg', 'released', 'https://www.youtube.com/watch?v=PN0Mm9dtfmo', 15, '2023-06-16', 'IMAX!!', 'English'),
(10, 'Polis Evo 3', 'Dalam kesibukan sebagai anggota polis, keluarga Inspektor Khai (Shaheizy Sam) dan Inspektor Sani (Zizan Razak) sedang melakukan persiapan perkahwinan Sani dengan tunangnya, Khadijah. ', 'Syafiq Yusof', 'Shaheizy Sam, Zizan Razak, and more.', '1hr 53min', 'Action', 'cfcb64764c726ffc56323974e8076fd9.jpg', 'top', 'https://www.youtube.com/watch?v=WOYEyBo3Q9U', 17, '1970-05-25', 'Deluxe', 'Bahasa Malaysia'),
(11, 'Oppenheimer', 'The film follows the story of American scientist J. Robert Oppenheimer and his role in the development of the atomic bomb.', 'Christopher Nolan', 'Cillian Murphy, Robert Downey Jr., Emily Blunt, and more.', '2hr 50min', 'Action', '0d1703b4589a3a1345afb14e8ba38040.jpg', 'soon', 'https://www.youtube.com/watch?v=bK6ldnjE3Y0', 22, '2023-08-21', 'IMAX', 'English'),
(12, 'The Childe', 'Marco, a boxer living in the Philippines, struggles to make a living by participating in illegal matches while taking care of his ailing mother. In order to raise money for her surgery, he sets off to meet his father whom he has never seen before in Korea. ', 'Park Hoon-jung', 'Kim Seon-ho, Go Ara, Kang Tae-jooKim Seon-ho, Go Ara, Kang Tae-joo', '2hr', 'Mystery', 'a9aff4bcb03220db2f2e93857a3a765a.jpg', 'top', 'https://www.youtube.com/watch?v=KTnvYKPXBpw', 19, '2023-06-29', 'IMAX', 'Korean');

-- --------------------------------------------------------

--
-- 表的结构 `moviepurchase`
--

CREATE TABLE `moviepurchase` (
  `movieID` int(11) NOT NULL,
  `branchID` int(11) NOT NULL,
  `dateOfmovie` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `moviepurchase`
--

INSERT INTO `moviepurchase` (`movieID`, `branchID`, `dateOfmovie`) VALUES
(1, 1, '2023-06-14'),
(1, 1, '2023-06-15'),
(1, 1, '2023-06-23'),
(1, 1, '2023-07-17'),
(1, 1, '2023-07-18'),
(1, 1, '2023-07-19'),
(1, 1, '2023-07-20'),
(1, 1, '2023-07-22'),
(1, 1, '2023-07-23'),
(1, 1, '2023-07-25'),
(1, 1, '2023-07-26'),
(1, 1, '2023-07-27'),
(1, 1, '2023-07-28'),
(1, 1, '2023-07-29'),
(1, 1, '2023-07-31'),
(1, 1, '2023-08-02'),
(1, 1, '2023-08-03'),
(1, 1, '2023-08-04'),
(1, 1, '2023-08-05'),
(1, 2, '2023-06-14'),
(1, 2, '2023-07-17'),
(1, 2, '2023-07-18'),
(1, 2, '2023-07-20'),
(1, 3, '2023-06-01'),
(1, 4, '2023-08-24'),
(1, 5, '2023-06-30'),
(2, 1, '2023-06-14'),
(2, 1, '2023-07-20'),
(2, 1, '2023-07-27'),
(3, 3, '2023-07-21'),
(9, 1, '2023-07-27'),
(10, 2, '2023-07-26'),
(11, 1, '2023-07-21');

-- --------------------------------------------------------

--
-- 表的结构 `package`
--

CREATE TABLE `package` (
  `packageID` int(11) NOT NULL,
  `packageName` varchar(200) NOT NULL,
  `packageDetail` text NOT NULL,
  `keyword` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `package`
--

INSERT INTO `package` (`packageID`, `packageName`, `packageDetail`, `keyword`) VALUES
(1, 'IMAX', 'Enter the setting of your film. The most engaging cinematic experience, provided by IMAX, allows you to participate in the movie rather than merely watch it. This is immersion at its finest with a maximum-coverage screen and undeniable acoustics.', 'Bigger Is Better'),
(2, 'Deluxe', 'Relaxation has never been introduced in a more intimate format. Here is where class and comfort meet to provide the pampering you deserve together with a little luxury at the section.', 'Relax And Recline'),
(6, 'Beanie', 'Our cinema is your home here, only bigger and better. However you would like to enjoy your movie be it sitting, lying down, or slumping in, Beanie is in all forms adaptable to what you prefer and how you want it.', 'Just Sink In'),
(7, '3D', '3D cinema content is even more vivid and realistic when seen on Onyx. Featuring high-brightness and industry-leading 3D dimensional depth, this specialised composition brings visual details to the forefront and allows for subtitles to be easier to read.', 'More of What Matters');

-- --------------------------------------------------------

--
-- 表的结构 `package_movie`
--

CREATE TABLE `package_movie` (
  `TimeSlotID` int(11) NOT NULL,
  `packageID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `branchID` int(11) NOT NULL,
  `dateOfmovie` date NOT NULL,
  `timeOfmovie` time NOT NULL,
  `Room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `package_movie`
--

INSERT INTO `package_movie` (`TimeSlotID`, `packageID`, `movieID`, `branchID`, `dateOfmovie`, `timeOfmovie`, `Room`) VALUES
(3, 1, 1, 1, '2023-07-17', '00:00:00', 1),
(4, 1, 1, 1, '2023-07-17', '03:55:00', 1),
(11, 1, 1, 1, '2023-07-17', '18:55:00', 1),
(12, 1, 1, 1, '2023-07-17', '07:55:00', 1),
(13, 1, 1, 1, '2023-07-18', '14:24:00', 1),
(14, 1, 1, 1, '2023-07-18', '18:12:00', 1),
(16, 1, 1, 1, '2023-07-29', '02:54:00', 5),
(19, 1, 1, 1, '2023-07-19', '05:27:00', 1),
(20, 1, 1, 1, '2023-07-19', '08:27:00', 1),
(22, 1, 1, 1, '2023-07-19', '11:27:00', 1),
(23, 1, 1, 1, '2023-07-17', '00:11:00', 2),
(24, 1, 1, 1, '2023-07-17', '03:11:00', 2),
(25, 1, 10, 2, '2023-07-26', '16:38:00', 1),
(26, 7, 11, 1, '2023-07-21', '15:40:00', 1),
(27, 1, 2, 1, '2023-07-20', '17:25:00', 1);

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 转存表中的数据 `product`
--

INSERT INTO `product` (`productID`, `productName`, `price`, `image`) VALUES
(1, 'Family Bundle', 60, '3d3e0e9e0755daacf1d218633cd7fc4a.jpg'),
(3, 'Classic Popcorn', 15, '41a30250dfd5a75707d6ae247b241e36.jpg'),
(4, 'Cheesy Nachos', 21, 'aba078a017ef363a6c8e24cadac0deff.jpg'),
(5, 'Beverages', 6, '10c795d23edaceb8332acbb05b49a85d.png'),
(6, 'Classic Bundle', 29, 'cffa552ea0c7ddfb0667de1170ca8e8f.jpg'),
(13, 'Double Bundle', 38, '3aaf3824632a1add730a519b4d994546.png');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `firstName`, `lastName`, `email`, `phoneNumber`, `password`, `gender`, `image`) VALUES
(140, 'pqwe', 'qwe', '222@gmail.com', '1231231231', '$2y$10$zr5N/xfwwE3Uq.z7jgLZou0ol5clGEKzAnblVjJVf8o60uU9wADIW', 'male', 'a63ed781d621adc48c26c998c9b0cc77.png'),
(146, 'perth', 'wongs', '11@gmail.com', '1231231232', '$2y$10$M6X9mfi.Yra285pfR0UdsOOiOay0MiOTsPxA8DAtUaMNT1o6T04Du', 'male', '6e816d6bab6f6e0d8d03119fca68508d.png'),
(147, 'Perth', 'qwqw', 'perth_0@Hotmail.com', '1212121212', '$2y$10$zjpOesh1i.Lb/XadSwCYAeQFzd7vd3RD0NUa5YDiheykaHd8utZze', 'male', '08fee14868e721285dbf3bd7092a3f82.png'),
(149, 'pqwe', 'qwe', 'wonglooperth0@gmail.com', '1231231231', '$2y$10$E1UIRCA3RyfMtCSwtAnwLuBVJkxyDnqkZGmdirzFQLCFPR57PBq3a', 'Male', 'facebookanon.jpg'),
(152, 'pqwe', 'qwe', '111212@gmail.com', '0123123123', '$2y$10$bUV6p11Xq5FhqHvAqfrcX.Bs20dT2mWpjCeI2zdD7pjIeJwUJEq4S', 'male', 'aee25dc5d42777cfad96ff148d6cba99.png'),
(153, 'pqwe', 'qwe', '11221@gmail.com', '0123123123', '$2y$10$XBjUZzpmIjDcKpVkoH7i8e1uqZcTP25ZPpGeHLpE1QAwgh4pddiFm', 'Male', 'facebookanon.jpg'),
(154, 'pqwe', 'qwe', '2212@gmail.com', '1231231231', '$2y$10$zr5N/xfwwE3Uq.z7jgLZou0ol5clGEKzAnblVjJVf8o60uU9wADIW', 'male', 'a63ed781d621adc48c26c998c9b0cc77.png'),
(155, 'perth', 'wongs', '111@gmail.com', '1231231232', '$2y$10$M6X9mfi.Yra285pfR0UdsOOiOay0MiOTsPxA8DAtUaMNT1o6T04Du', 'male', '6e816d6bab6f6e0d8d03119fca68508d.png'),
(158, 'pqwe', 'qwe', '33313@gmail.com', '1231231231', '$2y$10$E1UIRCA3RyfMtCSwtAnwLuBVJkxyDnqkZGmdirzFQLCFPR57PBq3a', 'Male', 'facebookanon.jpg'),
(159, 'pqwe', 'qwe', '111231@gmail.com', '0123123123', '$2y$10$i7Er/r2tRepY9H5NfHNR8uCjnlO3P1BJ.7zzNxoc68G4Hjmn0.bWu', 'male', ''),
(161, 'pqwe', 'qwe', '112341212@gmail.com', '0123123123', '$2y$10$bUV6p11Xq5FhqHvAqfrcX.Bs20dT2mWpjCeI2zdD7pjIeJwUJEq4S', 'male', 'aee25dc5d42777cfad96ff148d6cba99.png'),
(162, 'pqwe', 'qwe', '11234221@gmail.com', '0123123123', '$2y$10$XBjUZzpmIjDcKpVkoH7i8e1uqZcTP25ZPpGeHLpE1QAwgh4pddiFm', 'Male', 'facebookanon.jpg'),
(163, 'pqwe', 'qwe', '1@gmail.com', '1111111111', '$2y$10$4rrFP8Wiq8QxbALNhscjye/nbUlFWToCP9XG29x3ARrZnQQF1oQTS', 'male', 'facebookanon.jpg'),
(165, 'ryan', 'jee', 'jeemengzhe@gmail.com', '0129042981', '$2y$10$V.IYWO1YfniDcwOF0t/2Ae6GsPX.EZGdmwu67KvZ0x3NbH.2K1p8u', 'female', 'facebookanon.jpg');

--
-- 转储表的索引
--

--
-- 表的索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- 表的索引 `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`paymentID`);

--
-- 表的索引 `bookingfilm`
--
ALTER TABLE `bookingfilm`
  ADD PRIMARY KEY (`movieOfdate`,`movieID`,`seatID`,`branch`,`packageID`,`movieOftime`);

--
-- 表的索引 `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branchID`);

--
-- 表的索引 `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movieID`);

--
-- 表的索引 `moviepurchase`
--
ALTER TABLE `moviepurchase`
  ADD PRIMARY KEY (`movieID`,`branchID`,`dateOfmovie`);

--
-- 表的索引 `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`packageID`);

--
-- 表的索引 `package_movie`
--
ALTER TABLE `package_movie`
  ADD PRIMARY KEY (`TimeSlotID`);

--
-- 表的索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `bill`
--
ALTER TABLE `bill`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- 使用表AUTO_INCREMENT `branch`
--
ALTER TABLE `branch`
  MODIFY `branchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用表AUTO_INCREMENT `movie`
--
ALTER TABLE `movie`
  MODIFY `movieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用表AUTO_INCREMENT `package`
--
ALTER TABLE `package`
  MODIFY `packageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `package_movie`
--
ALTER TABLE `package_movie`
  MODIFY `TimeSlotID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- 使用表AUTO_INCREMENT `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
