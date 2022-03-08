-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Mar 2022 pada 15.03
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.10

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
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `id_transaksi`, `harga`) VALUES
(1, 7, 20000),
(2, 1, 30000),
(3, 2, 300000),
(4, 5, 25000),
(5, 9, 350000),
(6, 8, 320000),
(7, 3, 220000),
(8, 6, 210000),
(9, 10, 580000),
(10, 7, 230000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `nama_pembuat` varchar(25) NOT NULL,
  `stok` text NOT NULL,
  `tgl_kadaluwarsa` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `nama_pembuat`, `stok`, `tgl_kadaluwarsa`) VALUES
(2, 'PARAMEX', 'Romi', '20', '2024-03-07'),
(3, 'BODREX', 'Irwan', '30', '2022-03-31'),
(4, 'PARACETAMOL', 'Firdaus', '50', '2031-03-06'),
(5, 'RECOK', 'Sepudin', '23', '2022-03-24'),
(6, 'PROMAG', 'Rina', '5', '2024-03-23'),
(7, 'OBAT KUAT', 'Wendi', '14', '2025-03-13'),
(8, 'OBAT NYAMUK', 'Irna', '21', '2022-03-31'),
(9, 'OBAT TANAMAN', 'Wati', '22', '2022-03-31'),
(10, 'KONTREKSIN', 'Sari', '7', '2022-03-24'),
(11, 'OBAT CACING', 'Cagur', '41', '2022-03-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembeli`
--

CREATE TABLE `pembeli` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembeli`
--

INSERT INTO `pembeli` (`id`, `nama`, `alamat`, `no_telp`) VALUES
(1, 'Agung', 'Bekasi', '97955759889'),
(2, 'Ronal', 'Bekasi Selatan', '9795575989'),
(3, 'Linda', 'Jakarta Pusat', '08757846487'),
(4, 'Arif', 'Jati Asih', '979555989'),
(5, 'Kaldu', 'Bekasi Kota', '08757848487'),
(6, 'Waldi', 'Bandung', '0897955759'),
(7, 'Wijna', 'Bogor', '08757840487'),
(8, 'Wanggai', 'Depok', '0897955753'),
(9, 'Sandi', 'Sukabumi', '08757846481'),
(10, 'Anggi', 'Depok Barat', '0897955754');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembuat_obat`
--

CREATE TABLE `pembuat_obat` (
  `id` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembuat_obat`
--

INSERT INTO `pembuat_obat` (`id`, `nama`, `tanggal_lahir`, `alamat`, `no_tlp`) VALUES
(1, 'Irwan', '2012-03-01', 'Bekasi Selatan', '08685977367'),
(2, 'firdaus', '2014-03-06', 'Bekasi Kota', '9786757568'),
(3, 'Romi', '2013-03-14', 'Bekasi Barat', '08685977360'),
(4, 'Saepudin', '2014-03-20', 'Bekasi Timur', '08685977369'),
(5, 'Rina', '2000-10-05', 'Jakarta Pusat', '9786759567'),
(6, 'Wati', '2000-02-29', 'Jakarta Selatan', '08685977367'),
(7, 'Irna', '2013-03-13', 'Jakarta Barat', '0786757567'),
(8, 'Sari', '2022-03-02', 'Jakarta Timur', '08685877367'),
(9, 'Wendi', '2012-03-21', 'Jakarta Barat', '0786797567'),
(10, 'Cagur', '2022-03-03', 'Bandung', '08685977361');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transkasi`
--

CREATE TABLE `transkasi` (
  `id_transaksi` int(11) NOT NULL,
  `nama_pasien` varchar(25) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah_transaksi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transkasi`
--

INSERT INTO `transkasi` (`id_transaksi`, `nama_pasien`, `id_obat`, `jumlah_transaksi`) VALUES
(1, 'Irwan', 2, '100000'),
(2, 'Semi', 3, '50000'),
(3, 'Tono', 7, '20000'),
(4, 'Sandi', 2, '40000'),
(5, 'Landi', 5, '100000'),
(6, 'Tanda', 11, '15000'),
(7, 'Aldo', 5, '210000'),
(8, 'Ferdi', 7, '51000'),
(9, 'Hoer', 7, '200000'),
(10, 'Kalta', 4, '100000');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembuat_obat`
--
ALTER TABLE `pembuat_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transkasi`
--
ALTER TABLE `transkasi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_obat` (`id_obat`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pembuat_obat`
--
ALTER TABLE `pembuat_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transkasi`
--
ALTER TABLE `transkasi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transkasi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transkasi`
--
ALTER TABLE `transkasi`
  ADD CONSTRAINT `fk_obat` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
