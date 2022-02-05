-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2022 at 03:02 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(5) NOT NULL,
  `nama_obat` varchar(30) NOT NULL,
  `jenis_obat` varchar(10) NOT NULL,
  `harga` int(20) NOT NULL,
  `stok` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `jenis_obat`, `harga`, `stok`) VALUES
(1, 'Panadol', 'tablet', 10000, 100),
(2, 'delcogen', 'tablet', 5000, 50),
(3, 'Dulcolax', 'kapsul', 5000, 100),
(4, 'Paramex', 'kapsul', 7000, 50),
(5, 'Panadol Hijau', 'Tablet', 8000, 30),
(6, 'Panadol Merah', 'Tablet', 8000, 42),
(7, 'Tolak Angin', 'Cair', 12000, 50),
(8, 'OBH', 'Cair', 12000, 20),
(9, 'Laserin', 'Cair', 15000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `umur` int(3) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `jenkel_pelanggan` enum('Laki - Laki','Perempuan','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `umur`, `alamat`, `jenkel_pelanggan`) VALUES
(1, 'Uti', 25, 'mampang', 'Laki - Laki'),
(2, 'Echi', 22, 'depok', 'Perempuan'),
(3, 'Ace', 26, 'Tebet', 'Laki - Laki'),
(4, 'Wadud', 22, 'Bangka', 'Laki - Laki'),
(5, 'Sarah', 20, 'Kalibata', 'Perempuan'),
(6, 'Novi', 26, 'Buncit', 'Perempuan'),
(7, 'Bima', 27, 'Tendean', 'Laki - Laki'),
(8, 'Dion', 19, 'Kemang', 'Laki - Laki'),
(9, 'Joey', 23, 'Kalibata', 'Laki - Laki'),
(10, 'Siska', 24, 'Bangka', 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tgl_transaksi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_transaksi`, `id_pelanggan`, `tgl_transaksi`) VALUES
(2002, 9, '2022-02-02'),
(2003, 4, '2022-01-11'),
(2004, 8, '2022-02-03'),
(2005, 7, '2022-01-31'),
(2006, 10, '2022-01-26'),
(2007, 3, '2022-02-02'),
(2008, 5, '2022-02-01'),
(2009, 1, '2022-01-30'),
(2010, 2, '2022-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_obat` int(5) NOT NULL,
  `jmlh_obat` int(10) DEFAULT NULL,
  `harga_obat` int(10) DEFAULT NULL,
  `total_bayar` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id`, `id_transaksi`, `id_obat`, `jmlh_obat`, `harga_obat`, `total_bayar`) VALUES
(2, 2002, 8, 1, 15000, 15000),
(3, 2003, 5, 2, 8000, 16000),
(4, 2004, 4, 1, 7000, 7000),
(5, 2005, 7, 3, 4000, 12000),
(6, 2006, 8, 1, 15000, 15000),
(7, 2007, 4, 2, 7000, 14000),
(8, 2008, 9, 1, 15000, 15000),
(9, 2009, 1, 1, 10000, 10000),
(10, 2010, 3, 2, 5000, 10000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_obat` (`id_obat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Constraints for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD CONSTRAINT `penjualan_detail_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `penjualan` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_detail_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
