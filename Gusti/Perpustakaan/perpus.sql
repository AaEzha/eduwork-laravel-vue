-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2022 at 07:10 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `sex` char(1) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tgl_entry` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` varchar(12) NOT NULL DEFAULT 'USER'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama`, `username`, `password`, `sex`, `telp`, `alamat`, `email`, `tgl_entry`, `role`) VALUES
(1, 'Administrator', 'admin', 'admin', 'P', '0891281111', 'Bandung', 'admin@gmail.com', '2022-01-19 06:10:23', 'ADMIN'),
(2, 'Pelita', 'pelita', 'pelita', 'P', '087821505412', 'Gunung Batu, Bandung', 'pelita@gmail.com', '2022-01-19 06:10:23', 'USER'),
(3, 'Ayu', 'ayu', 'ayu', 'P', '08112121222', 'Sukawarna, Bandung', 'ayu@gmail.com', '2022-01-19 06:10:23', 'USER'),
(4, 'Fadhli', 'fadhli', 'fadhli', 'L', '08133613111', 'Cilandak, Jakarta', 'fadhli@gmail.com', '2022-01-19 06:10:23', 'USER'),
(5, 'Nur', 'nur', 'nur', 'P', '08212221311', 'Sunter, Jakarta', 'nur@gmail.com', '2022-01-19 06:10:23', 'USER'),
(6, 'Bagus', 'bagus', 'bagus', 'L', '0827379111', 'Sarijadi, Bandung', 'bagus@gmail.com\r\n', '2022-01-19 06:10:23', 'USER'),
(7, 'Mahendra', 'mahendra', 'mahendra', 'P', '08772191811', 'Sariwangi, Bandung', 'mahendra@gmail.com', '2022-01-19 06:10:23', 'USER'),
(8, 'Najmin', 'najmin', 'najmin', 'P', '08712911991', 'Sukaraja, Bandung', 'najmina@gmail.com', '2022-01-19 06:10:23', 'USER'),
(9, 'Putri', 'putri', 'putri', 'P', '0827191811', 'Cimahi', 'putri@gmail.com', '2022-01-19 06:10:23', 'USER'),
(10, 'Ridwan', 'ridwan', 'ridwan', 'L', '0898188191', 'Baros, Cimahi', 'ridwan@gmail.com', '2022-01-19 06:10:23', 'USER'),
(11, 'Feby', 'feby', 'feby', 'P', '08991717711', 'Sukajadi, Bandung', 'feby@gmail.com\r\n', '2022-01-19 06:10:23', 'USER'),
(12, 'Cindy', 'cindy', 'cindy', 'P', '08272772791', 'Sentral, Cimahi', 'cindy@gmail.com', '2022-01-19 06:10:23', 'USER'),
(13, 'Farid', 'farid', 'farid', 'P', '0876637911', 'Buah Batu, Bandung', 'farid@gmail.com', '2022-01-19 06:10:23', 'USER'),
(14, 'Bayu', 'bayu', 'bayu', 'L', '0887639199', 'Sunter, Jakarta', 'bayu@gmail.com', '2022-01-19 06:10:23', 'USER'),
(15, 'Deni', 'deni', 'deni', 'L', '0876619111', 'Cikutra, Subang', 'deni@gmail.com', '2022-01-19 06:10:23', 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `isbn` varchar(25) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `id_penerbit` varchar(8) DEFAULT NULL,
  `id_pengarang` varchar(8) DEFAULT NULL,
  `id_katalog` varchar(3) DEFAULT NULL,
  `qty_stok` int(11) DEFAULT 0,
  `harga_pinjam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`isbn`, `judul`, `tahun`, `id_penerbit`, `id_pengarang`, `id_katalog`, `qty_stok`, `harga_pinjam`) VALUES
('002-291', 'Lancar Javascript', 2018, 'PN02', 'PG05', 'KG2', 8, 5000),
('009-281', 'Basic PHP', 2021, 'PN04', 'PG01', 'KG1', 19, 7500),
('092-111', 'Belajar PHP', 2010, 'PN01', 'PG01', 'KG0', 12, 12000),
('377-482', 'MySQL Dasar', 2020, 'PN04', 'PG04', 'KG0', 20, 4000),
('381-561', 'Basic Vue.js', 2014, 'PN03', 'PG01', 'KG2', 5, 5000),
('774-210', 'Laravel Master', 2021, 'PN03', 'PG05', 'KG1', 7, 6500),
('774-211', 'Laravel Part 1', 2018, 'PN03', 'PG05', 'KG1', 5, 4500),
('777-380', 'Mongo DB Lanjut', 2020, 'PN01', 'PG03', 'KG2', 7, 10000),
('777-381', 'MySQL Lanjut', 2021, 'PN01', 'PG04', 'KG0', 9, 8000),
('882-191', 'Belajar CSS', 2020, 'PN03', 'PG05', 'KG0', 8, 12000),
('882-291', 'Belajar Laravel', 2020, 'PN03', 'PG05', 'KG1', 3, 11500),
('902-191', 'CSS Part 2', 2020, 'PN04', 'PG05', 'KG0', 8, 15000),
('929-181', 'Basic JQuery', 2019, NULL, 'PG05', 'KG0', 11, 5500),
('977-381', 'CSS Part 1', 2018, 'PN01', 'PG01', 'KG0', 9, 8000),
('999-281', 'Laravel Part 2', 2020, 'PN04', 'PG05', 'KG1', 11, 13000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id_pinjam` int(11) NOT NULL DEFAULT 0,
  `isbn` varchar(25) NOT NULL DEFAULT '',
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id_pinjam`, `isbn`, `qty`) VALUES
(1, '092-111', 1),
(1, '777-381', 3),
(1, '999-281', 1),
(2, '777-381', 1),
(3, '009-281', 1),
(3, '381-561', 1),
(3, '777-381', 2),
(3, '882-291', 1),
(4, '009-281', 1),
(4, '377-482', 1),
(5, '381-561', 1),
(5, '999-281', 2),
(6, '002-291', 1),
(6, '377-482', 2),
(6, '777-381', 1),
(6, '902-191', 1),
(7, '882-291', 1),
(8, '777-380', 2),
(8, '929-181', 1),
(9, '009-281', 1),
(9, '377-482', 1),
(9, '929-181', 1),
(10, '381-561', 1),
(10, '882-291', 1),
(10, '902-191', 1),
(10, '977-381', 2);

-- --------------------------------------------------------

--
-- Table structure for table `katalog`
--

CREATE TABLE `katalog` (
  `id_katalog` varchar(3) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `katalog`
--

INSERT INTO `katalog` (`id_katalog`, `nama`) VALUES
('KG0', 'Buku Dewasa'),
('KG1', 'Buku Anak'),
('KG2', 'Buku Belajar'),
('KG3', 'Buku Belajar Agama'),
('KG4', 'Buku Kesehatan');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `id_anggota`, `tgl_pinjam`, `tgl_kembali`) VALUES
(1, 4, '2021-05-26', '2021-05-31'),
(2, 2, '2021-05-27', '2021-05-29'),
(3, 3, '2021-05-10', '2021-05-12'),
(4, 7, '2021-05-27', '2021-05-31'),
(5, 5, '2021-06-01', '2021-06-05'),
(6, 10, '2021-06-01', '2021-06-03'),
(7, 3, '2021-05-04', '2021-05-06'),
(8, 4, '2021-06-03', '2021-06-09'),
(9, 11, '2021-06-02', '2021-06-08'),
(10, 5, '2021-05-25', '2021-06-02');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` varchar(8) NOT NULL,
  `nama_penerbit` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `email`, `telp`, `alamat`) VALUES
('PN01', 'Penerbit 01', 'penerbit@perpus.co.id', '0219999333', 'Surabaya'),
('PN02', 'Penerbit 02', 'penerbit2@gmail.com', '08765158111', 'Bandung'),
('PN03', 'Penerbit 03', 'penerbit3@gmail.com', NULL, 'Jakarta Barat'),
('PN04', 'Penerbit 04', 'penerbit4@gmail.com', '08972017209', 'Jakarta Selatan'),
('PN05', 'Penerbit 05', 'penerbit5@gmail.com', '08972187209', 'Jakarta Selatan'),
('PN06', 'Penerbit 06', 'penerbit6@gmail.com', '08112187209', 'Jakarta Barat');

-- --------------------------------------------------------

--
-- Table structure for table `pengarang`
--

CREATE TABLE `pengarang` (
  `id_pengarang` varchar(8) NOT NULL,
  `nama_pengarang` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengarang`
--

INSERT INTO `pengarang` (`id_pengarang`, `nama_pengarang`, `email`, `telp`, `alamat`) VALUES
('PG01', 'Pengarang 01', 'pengarang1@perpus.co.id', '0929211', 'Bandung'),
('PG02', 'Pengarang 02', 'pengarang2@perpus.co.id', '0929211222', 'Yogyakarta'),
('PG03', 'Pengarang 03', 'pengarang3@perpus.co.id', '092921199', 'Banten'),
('PG04', 'Pengarang 04', 'pengarang4@perpus.co.id', '93938199', 'Jakarta'),
('PG05', 'Pengarang 05', 'pengarang5@perpus.co.id', '93938199', 'Cimahi'),
('PG06', 'Pengarang 06', 'pengarang6@perpus.co.id', '0818176111', 'Cimahi'),
('PG07', 'Pengarang 07', 'pengarang7@perpus.co.id', '08181762291', 'Semarang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `penerbit` (`id_penerbit`),
  ADD KEY `pengarang` (`id_pengarang`),
  ADD KEY `katalog` (`id_katalog`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id_pinjam`,`isbn`),
  ADD KEY `id_pinjam` (`id_pinjam`),
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `katalog`
--
ALTER TABLE `katalog`
  ADD PRIMARY KEY (`id_katalog`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `anggota` (`id_anggota`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `pengarang`
--
ALTER TABLE `pengarang`
  ADD PRIMARY KEY (`id_pengarang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `katalog` FOREIGN KEY (`id_katalog`) REFERENCES `katalog` (`id_katalog`),
  ADD CONSTRAINT `penerbit` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`),
  ADD CONSTRAINT `pengarang` FOREIGN KEY (`id_pengarang`) REFERENCES `pengarang` (`id_pengarang`);

--
-- Constraints for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD CONSTRAINT `id_pinjam` FOREIGN KEY (`id_pinjam`) REFERENCES `peminjaman` (`id_pinjam`),
  ADD CONSTRAINT `isbn` FOREIGN KEY (`isbn`) REFERENCES `buku` (`isbn`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `anggota` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
