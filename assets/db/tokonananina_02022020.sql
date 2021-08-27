-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 02, 2020 at 03:12 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokonananina`
--

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` varchar(20) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `harga_beli` bigint(20) NOT NULL,
  `vendor` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `harga_beli`, `vendor`, `status`, `created_at`) VALUES
('PROD0001', 'CASING ACER', 2000000, 1, 1, '2019-08-07 17:30:22'),
('PROD0002', 'headset SONY', 550000, 2, 2, '2019-08-07 17:35:34'),
('PROD0003', 'LAPTOP ACER', 1000000, 1, 1, '2019-08-07 17:29:20'),
('PROD0004', 'CHARGER ACER', 400000, 2, 1, '2019-08-07 17:19:29'),
('PROD0005', 'LCD ASUS', 2500000, 2, 1, '2019-05-30 00:00:00'),
('PROD0006', 'MOUSE LOGITECH', 250000, 1, 1, '2019-05-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` varchar(20) NOT NULL,
  `nama_vendor` varchar(50) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `nama_vendor`, `telp`, `alamat`) VALUES
('1', 'GARUDA', '085643242654', 'MAGELANG'),
('2', 'TOPCER', '085643242655', 'JOGJA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
