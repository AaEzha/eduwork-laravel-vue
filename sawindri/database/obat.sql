-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Apr 2022 pada 23.08
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

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
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(128) NOT NULL,
  `pembuat_obat` varchar(128) NOT NULL,
  `stok_obat` int(11) NOT NULL,
  `harga` char(128) NOT NULL,
  `tanggal_kadaluarsa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `pembuat_obat`, `stok_obat`, `harga`, `tanggal_kadaluarsa`) VALUES
(1, 'Acarbose', 'Diana', 29, '15000', '2022-03-26'),
(2, 'Acetylcysteine', 'Anis Supr', 13, '50000', '2022-03-31'),
(3, 'panadol', 'agung', 100, '100000', '2022-05-18'),
(4, 'Tafluprost', 'arif muhammad', 201, '60000', '2025-04-16'),
(5, 'Ambroxol', 'Indriyani saputri', 230, '15000', '2022-04-30'),
(6, 'Dexchlorpheniramine', 'siska', 456, '55000', '2022-04-21'),
(7, 'Vaksin BCG', 'sawindri', 34, '35000', '2024-07-25'),
(8, 'Calcium Acetate', 'kinan', 78, '50000', '2022-04-14'),
(9, 'Carvedilol', 'intan', 87, '70000', '2022-12-17');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
