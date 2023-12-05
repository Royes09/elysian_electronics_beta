-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2023 at 03:19 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pcgarbage`
--

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
  `image` varchar(100) NOT NULL
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
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `cat_id` int(2) NOT NULL DEFAULT 0,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cat_id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`) VALUES
(24, 0, 'Ultrabook ASUS 13.3&#39;&#39; Zenbook S 13 Flip OLED UP5302ZA, 2.8K Touch, Procesor Intel® Core™ i7-', 'Denumire:	\r\nUltrabook ASUS 13.3&#39;&#39; Zenbook S 13 Flip OLED UP5302ZA, 2.8K Touch, Procesor Intel® Core™ i7-1260P (18M Cache, up to 4.70 GHz), 16GB DDR5, 1TB SSD, Intel Iris Xe, Win 11 Pro, Ponder Blue\r\nCod producator:	\r\nUP5302ZA-LX084X\r\nGarantie comerciala:	\r\n24 luni, 12 luni acumulator\r\nGarantie de conformitate:	24 luni', 8298.00, '11.jpg', '12.jpg', '13.jpg'),
(25, 0, 'Laptop DELL 15.6&#39;&#39; Inspiron 3511, FHD, Procesor Intel® Core™ i5-1135G7 (8M Cache, up to 4.20', 'Denumire:	\r\nLaptop DELL 15.6&#39;&#39; Inspiron 3511, FHD, Procesor Intel® Core™ i5-1135G7 (8M Cache, up to 4.20 GHz), 8GB DDR4, 512GB SSD, Intel Iris Xe, Linux, Carbon Black, 2Yr CIS\r\nCod producator:	\r\nDI3511I58512UBU, DI3511FI51135G78GB512GBU2Y-05, DINS3511I58512UBU\r\nGarantie comerciala:	\r\n24 luni, acumulator 6 luni\r\nGarantie de conformitate:	24 luni', 1998.00, '21.jpg', '22.jpg', '23.jpg'),
(26, 0, 'Laptop Lenovo Gaming 16&#39;&#39; Legion Pro 5 16IRX8, WQXGA IPS 240Hz G-Sync, Procesor Intel® Core™', 'Denumire:	\r\nLaptop Lenovo Gaming 16&#39;&#39; Legion Pro 5 16IRX8, WQXGA IPS 240Hz G-Sync, Procesor Intel® Core™ i7-13700HX (30M Cache, up to 5.00 GHz), 16GB DDR5, 512GB SSD, GeForce RTX 4060 8GB, No OS, Onyx Grey, 3Yr Onsite Premium Care\r\nCod producator:	\r\n82WK007XRM\r\nGarantie comerciala:	\r\n36 luni, 12 luni acumulator\r\nGarantie de conformitate:	24 luni', 8498.00, '31.jpg', '32.jpg', '33.jpg'),
(27, 0, 'Laptop GIGABYTE Gaming 16&#39;&#39; AERO 16 YE5, UHD+ OLED, Procesor Intel® Core™ i9-12900HK (24M Ca', 'Denumire:	\r\nLaptop GIGABYTE Gaming 16&#39;&#39; AERO 16 YE5, UHD+ OLED, Procesor Intel® Core™ i9-12900HK (24M Cache, up to 5.00 GHz), 32GB DDR5, 2x 1TB SSD, GeForce RTX 3080 Ti 16GB, Win 11 Pro, Silver\r\nCod producator:	\r\nAERO 16 YE5-94EE948HP\r\nGarantie comerciala:	\r\n24 luni, 12 luni acumulator\r\nGarantie de conformitate:	24 luni', 18998.00, '41.jpg', '42.jpg', '43.jpg'),
(28, 0, ' Laptop Apple 16.2&#39;&#39; MacBook Pro 16 Liquid Retina XDR, Apple M2 Pro chip (12-core CPU), 16GB', 'Denumire:	\r\nLaptop Apple 16.2&#39;&#39; MacBook Pro 16 Liquid Retina XDR, Apple M2 Pro chip (12-core CPU), 16GB, 512GB SSD, Apple M2 Pro 19-core GPU, macOS Ventura, Space Grey, INT keyboard, 2023\r\nCod producator:	\r\nMNW83ZE/A\r\nGarantie comerciala:	\r\n24 luni, persoane fizice, 12 luni, persoane juridice, 12 luni, acumulator\r\nGarantie de conformitate:	24 luni', 14398.00, '51.jpg', '52.jpg', '53.jpg'),
(29, 0, 'Laptop ASUS 15.6&#39;&#39; X515KA, FHD, Procesor Intel® Pentium® Silver N6000 (4M Cache, up to 3.30 ', 'Cod producator:	\r\nX515KA-EJ020\r\nGarantie comerciala:	\r\n24 luni, 12 luni acumulator\r\nGarantie de conformitate:	24 luni', 1248.00, '61.jpg', '62.jpg', '63.jpg'),
(30, 1, 'Telefon mobil Samsung Galaxy A14, Dual SIM, 4GB RAM, 64GB, 4G, Black', 'test', 6799.00, '71.jpg', '72.jpg', '73.jpg'),
(31, 1, 'Smartphone OnePlus 10T, Octa Core, 256GB, 16GB RAM, Dual SIM, 5G, 4-Camere, Jade Green', 'test', 3799.00, '81.jpg', '82.jpg', '83.jpg'),
(32, 1, 'Smartphone Samsung Galaxy S22, Dynamic AMOLED 2X, 128GB, 8GB RAM, Dual SIM, 5G, 4-Camere, Phantom Bl', 'test', 2948.00, '91.jpg', '92.jpg', '93.jpg'),
(33, 0, 'Laptop Lenovo 15.6&#39;&#39; IdeaPad 1 15IGL7, HD, Procesor Intel® Celeron® N4020 (4M Cache, up to 2', 'test', 1048.00, '4.jpg', '5.jpg', '6.jpg'),
(34, 0, 'Laptop Lenovo 15.6&#39;&#39; V15 G3 ABA, FHD, Procesor AMD Ryzen™ 3 5425U (8M Cache, up to 4.1 GHz),', 'test', 1598.00, '101.jpg', '102.jpg', '103.jpg'),
(35, 0, 'Laptop HP 15.6&#39;&#39; 15s-fq5050q, FHD, Procesor Intel® Core™ i3-1215U (10M Cache, up to 4.40 GHz', 'test', 1698.00, '104.jpg', '105.jpg', '106.jpg'),
(36, 2, 'PC Gaming Dark Blade, Intel i3-10105F 3.7GHz, 8GB DDR4, 512GB SSD, GTX 1050 Ti 4GB GDDR5, Iluminare ', 'test', 2295.00, '107.jpg', '108.jpg', '109.jpg'),
(37, 2, 'PC Gaming Corvus, AMD Ryzen 3 3200G 3.6GHz, 16GB DDR4, 250GB SSD, AMD Radeon™ Vega 8, Iluminare RGB', 'test', 1679.00, '24.jpg', '25.jpg', '26.jpg'),
(38, 2, 'PC Office Expert C312, Intel i3-12100 3.3GHz, 16GB DDR4, 1TB SSD', 'test', 2249.00, '27.jpg', '28.jpg', '29.jpg'),
(39, 2, 'PC Gaming Boltgun, AMD Ryzen 5 5500 3.6GHz, 16GB DDR4, 500GB SSD, Radeon RX 6600 8GB GDDR6', 'test', 3199.00, '34.jpg', '35.jpg', '36.jpg'),
(40, 3, 'Placa video PowerColor Radeon RX 6600 Fighter 8GB GDDR6 1‎28-bit', 'test', 1079.00, '37.jpg', '38.jpg', '39.jpg'),
(41, 3, 'Procesor Intel Raptor Lake, Core i7 13700K 3.4GHz box', 'test', 2259.00, '44.jpg', '45.jpg', '47.jpg'),
(42, 4, 'Monitor LED Apple Studio Display 27 inch 5K 60 Hz Webcam Standard Glass Tilt Adjustable Stand', 'test', 7998.00, '64.jpg', '65.jpg', '69.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `admin` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `admin`) VALUES
(15, '123', '123@123', '202cb962ac59075b964b07152d234b70', 0),
(16, '1234', '1234@1234', '81dc9bdb52d04dc20036dbd8313ed055', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

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
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
