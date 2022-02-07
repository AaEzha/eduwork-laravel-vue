-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07 Feb 2022 pada 05.33
-- Versi Server: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_apotek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jenis_obat`
--

CREATE TABLE `data_jenis_obat` (
  `id_jenis_obat` char(10) NOT NULL,
  `jenis_obat` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_jenis_obat`
--

INSERT INTO `data_jenis_obat` (`id_jenis_obat`, `jenis_obat`) VALUES
('1', 'pulvis'),
('2', 'tablet'),
('3', 'pil'),
('4', 'kapsul'),
('5', 'larutan'),
('6', 'salep');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_obat`
--

CREATE TABLE `data_obat` (
  `id_obat` char(10) NOT NULL,
  `nama_obat` varchar(20) NOT NULL,
  `harga` decimal(15,0) NOT NULL,
  `stok` varchar(20) NOT NULL,
  `id_jenis_obat` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_obat`
--

INSERT INTO `data_obat` (`id_obat`, `nama_obat`, `harga`, `stok`, `id_jenis_obat`) VALUES
('bo01', 'bodrex', '1000', '5 pack', '2'),
('bo02', 'bodrexin', '10000', '9 botol', '5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `id_pegawai` char(10) NOT NULL,
  `nama_pegawai` varchar(30) NOT NULL,
  `jenis_kelamin` char(10) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `telepon` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_pegawai`
--

INSERT INTO `data_pegawai` (`id_pegawai`, `nama_pegawai`, `jenis_kelamin`, `alamat`, `tanggal_lahir`, `telepon`) VALUES
('1', 'aditiya', 'laki-laki', 'graha walantaka', '1998-05-01', '087773773142');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pelanggan`
--

CREATE TABLE `data_pelanggan` (
  `id_pelanggan` char(10) NOT NULL,
  `nama_pelanggan` varchar(30) NOT NULL,
  `jenis_kelamin` char(10) NOT NULL,
  `alamat` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_pelanggan`
--

INSERT INTO `data_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `jenis_kelamin`, `alamat`) VALUES
('11', 'agung', 'laki-laki', 'graha walantaka');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_penjualan`
--

CREATE TABLE `data_penjualan` (
  `kode_transaksi` char(10) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pelanggan` char(10) NOT NULL,
  `id_pegawai` char(10) NOT NULL,
  `id_obat` char(10) NOT NULL,
  `id_jenis_obat` char(10) NOT NULL,
  `jumlah_obat` decimal(15,0) NOT NULL,
  `total` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_penjualan`
--

INSERT INTO `data_penjualan` (`kode_transaksi`, `tanggal`, `id_pelanggan`, `id_pegawai`, `id_obat`, `id_jenis_obat`, `jumlah_obat`, `total`) VALUES
('21', '2022-02-07', '11', '1', 'bo02', '5', '1', '10000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_jenis_obat`
--
ALTER TABLE `data_jenis_obat`
  ADD PRIMARY KEY (`id_jenis_obat`);

--
-- Indexes for table `data_obat`
--
ALTER TABLE `data_obat`
  ADD PRIMARY KEY (`id_obat`),
  ADD KEY `fk_jenis_obat` (`id_jenis_obat`);

--
-- Indexes for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `data_pelanggan`
--
ALTER TABLE `data_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD PRIMARY KEY (`kode_transaksi`),
  ADD KEY `fk_obat` (`id_obat`),
  ADD KEY `fk_pegawai` (`id_pegawai`),
  ADD KEY `fk_jenis_obat2` (`id_jenis_obat`),
  ADD KEY `fk_pelanggan` (`id_pelanggan`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_obat`
--
ALTER TABLE `data_obat`
  ADD CONSTRAINT `fk_jenis_obat` FOREIGN KEY (`id_jenis_obat`) REFERENCES `data_jenis_obat` (`id_jenis_obat`);

--
-- Ketidakleluasaan untuk tabel `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD CONSTRAINT `fk_jenis_obat2` FOREIGN KEY (`id_jenis_obat`) REFERENCES `data_jenis_obat` (`id_jenis_obat`),
  ADD CONSTRAINT `fk_obat` FOREIGN KEY (`id_obat`) REFERENCES `data_obat` (`id_obat`),
  ADD CONSTRAINT `fk_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `data_pegawai` (`id_pegawai`),
  ADD CONSTRAINT `fk_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `data_pelanggan` (`id_pelanggan`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
