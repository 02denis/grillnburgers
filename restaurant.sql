-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2023 at 12:52 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(4, 'adminn', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(7, 9, 'MATEAȘ DENIS-MIHAI', 'deniisddenis@gmail.com', '0758421744', 'MI-A PLACUT\r\n'),
(8, 9, 'MATEAȘ DENIS-MIHAI', 'deniisddenis@gmail.com', '0758421744', 'NU MI-A PLACUT'),
(10, 10, 'Denis Mihai', 'denis.mateas02@e-uvt.ro', '0854364554', 'GENIAL'),
(11, 10, 'Denis Mihai', 'denis.mateas02@e-uvt.ro', '0854364554', 'CEL MAI BUN'),
(12, 10, 'Denis Mihai', 'denis.mateas02@e-uvt.ro', '0854364554', 'MAI VENIM');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `meeting_time` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `res_status` varchar(20) NOT NULL DEFAULT 'in asteptare'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `meeting_time`, `total_products`, `total_price`, `placed_on`, `res_status`) VALUES
(33, 10, 'Denis Mihai', '0854364554', 'denis.mateas02@e-uvt.ro', 'cash', '2023-01-01T19:30', 'Rezervare (1 x 1) - ', 0, '2023-01-10', 'confirmat'),
(34, 10, 'Denis Mihai', '0854364554', 'denis.mateas02@e-uvt.ro', 'cash', '2023-01-01T19:30', 'Rezervare (1 x 1) - ', 0, '2023-01-11', 'confirmat'),
(35, 10, 'Denis Mihai', '0854364554', 'denis.mateas02@e-uvt.ro', 'cash', '2023-01-01T19:30', 'Rezervare (1 x 1) - ', 0, '2023-01-11', 'in asteptare');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`) VALUES
(1, 'Rezervare', 'rezervare', 1, 'mese.png'),
(2, 'apa', 'bautura', 55, 'drink-1.png'),
(3, 'asdf', 'bautura', 5, 'cocacola.jpg'),
(5, 'paste', 'fel_principal', 5, 'drink-3.png'),
(6, 'Apa plataa', 'bautura', 8, 'pizza-2.png'),
(7, 'Denis', 'desert', 1, 'pizza-3.png'),
(8, 'Apa plata', 'aperitiv', 1, 'dessert-2.png'),
(9, 'f', 'aperitiv', 5, 'dessert-5.png'),
(10, 'fasf', 'desert', 5, 'dish-2.png'),
(11, 'pui', 'fel_principal', 5, 'dish-4.png'),
(12, 'DenisMihai', 'desert', 2, 'drink-5.png'),
(13, 'MATEAȘ DENIS-MIHAI', 'desert', 1, 'drink-1.png'),
(14, 'admin', 'aperitiv', 88, 'dessert-3.png'),
(15, 'admind', 'fel_principal', 1, 'dish-4.png'),
(16, 'adminddd', 'desert', 21, 'drink-5.png'),
(17, 'Denissss', 'bautura', 4, 'burger-1.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(9, 'MATEAȘ DENIS-MIHAI', 'deniisddenis@gmail.com', '0758421744', 'f84316c4ffdb39a23f6abc926bb66b052d3aa7aa', ''),
(10, 'Denis Mihai', 'denis.mateas02@e-uvt.ro', '0854364554', 'f84316c4ffdb39a23f6abc926bb66b052d3aa7aa', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
