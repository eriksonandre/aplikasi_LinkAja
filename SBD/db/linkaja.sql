-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2021 at 05:26 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `linkaja`
--

-- --------------------------------------------------------

--
-- Table structure for table `minta`
--

CREATE TABLE `minta` (
  `id_minta` int(11) NOT NULL,
  `nama_pengirim` varchar(100) NOT NULL,
  `nohp_pengirim` varchar(15) NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `nohp_penerima` varchar(15) NOT NULL,
  `jumlah_saldo` int(20) NOT NULL,
  `antrian` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `saldo` int(20) NOT NULL,
  `bank` varchar(11) NOT NULL,
  `saldo_bank` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `nohp`, `email`, `password`, `saldo`, `bank`, `saldo_bank`) VALUES
(1, 'Erikson', '081888885888', 'andre@andre.com', 'a', 575000, '', 0),
(2, 'Sayid Farhan', '082165365523', 'sayid@gmail.com', 'sayid', 100000, '', 0),
(3, 'Hilda Safira', '082108467280', 'hilda@hilda.com', 'hilda', 100000, '', 0),
(4, 'Taufiq Purba', '081322167323', 'taufiq@taufiq.com', 'taufiq', 200000, '', 0),
(5, 'Garuda', '081361642734', 'garuda@gmail.com', 'garuda', 100000, '', 0),
(6, 'Fauzan Azhari', '081361786345', 'fauzan@fauzan.com', 'fauzan', 100000, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pulsa`
--

CREATE TABLE `pulsa` (
  `id_pulsa` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `no.hp` int(11) NOT NULL,
  `jumlah_pengisian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `id_tagihan` int(11) NOT NULL,
  `nama_tagihan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `minta`
--
ALTER TABLE `minta`
  ADD PRIMARY KEY (`id_minta`),
  ADD UNIQUE KEY `nohp_pengirim` (`nohp_pengirim`),
  ADD UNIQUE KEY `nohp_penerima` (`nohp_penerima`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nohp` (`nohp`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `pulsa`
--
ALTER TABLE `pulsa`
  ADD PRIMARY KEY (`id_pulsa`),
  ADD UNIQUE KEY `id_pengguna` (`id_pengguna`),
  ADD UNIQUE KEY `no.hp` (`no.hp`),
  ADD KEY `id_pulsa` (`id_pulsa`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id_tagihan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `minta`
--
ALTER TABLE `minta`
  MODIFY `id_minta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pulsa`
--
ALTER TABLE `pulsa`
  MODIFY `id_pulsa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id_tagihan` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `minta`
--
ALTER TABLE `minta`
  ADD CONSTRAINT `minta_ibfk_1` FOREIGN KEY (`nohp_pengirim`) REFERENCES `pengguna` (`nohp`);

--
-- Constraints for table `pulsa`
--
ALTER TABLE `pulsa`
  ADD CONSTRAINT `pulsa_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`),
  ADD CONSTRAINT `pulsa_ibfk_2` FOREIGN KEY (`id_pulsa`) REFERENCES `tagihan` (`id_tagihan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
