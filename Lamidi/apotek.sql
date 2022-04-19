-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Feb 2022 pada 06.44
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
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(32) NOT NULL,
  `pembuat` varchar(32) NOT NULL,
  `stock` int(11) NOT NULL,
  `tgl_kadaluwarsa` date NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `pembuat`, `stock`, `tgl_kadaluwarsa`, `harga`) VALUES
(1, 'VITACIMIN', 'TAKEDA', 100, '2022-11-25', 2000),
(2, 'OSKADON TABLET', 'PT. SUPRA FERBINDO ', 100, '2022-09-13', 3000),
(3, 'MIXAGRIP FLU & BATUK TABLET', 'KALBE', 10, '2022-10-21', 3000),
(4, 'MIXAGRIP STRIP', 'KALBE', 20, '2023-01-25', 3000),
(5, 'BODREX FLU&BATUK BERDAHAK PE KAP', 'PT. TEMPO SCAN PASIFIC TBK', 50, '2023-10-12', 4000),
(6, 'BODREX FLU DAN BATUK KERING PE K', 'PT. TEMPO SCAN PASIFIC TBK', 15, '2022-08-12', 4000),
(7, 'BODREX MIGRA KAPLET', 'PT. TEMPO SCAN PASIFIC TBK', 12, '2022-05-22', 4000),
(8, 'BODREX FLU DAN BATUK BERDAHAK SI', 'PT. TEMPO SCAN PASIFIC TBK', 13, '2022-03-23', 12000),
(9, 'BODREX TABLET', 'PT. TEMPO SCAN PASIFIC TBK', 15, '2022-05-12', 3000),
(10, 'BODREXIN 80MG TABLET', 'PT. TEMPO SCAN PASIFIC TBK', 12, '2022-10-11', 2000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama_pasien` varchar(32) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_tlp` char(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `tanggal_lahir`, `alamat`, `no_tlp`) VALUES
(1, 'KARIM', '2000-05-01', 'MALANG', '0811345963102'),
(2, 'AZIZ', '1980-03-12', 'MAKASSAR', '0822345964351'),
(3, 'RULY', '1976-02-13', 'BANYUWANGI', '082142123455'),
(4, 'ANDIKA', '1992-01-23', 'PALEMBANG', '083304950110'),
(5, 'BARIL', '1993-04-24', 'SURABAYA', '082334512354'),
(6, 'RICARD', '2000-06-26', 'PROBOLINGGO', '084531246332'),
(7, 'LAYLY', '2005-07-16', 'MOJOKERTO', '081245611124'),
(8, 'JOKO', '1999-09-09', 'NGAWI', '0824569019201'),
(9, 'CITRA', '2010-10-19', 'SIDOARJO', '0854930192093'),
(10, 'DONY', '2008-12-20', 'LUMAJANG', '085609381083');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pasien`, `id_obat`, `jumlah_bayar`) VALUES
(1, 4, 8, 12000),
(2, 3, 1, 2000),
(3, 5, 2, 3000),
(4, 6, 3, 6000),
(5, 7, 4, 8000),
(6, 8, 5, 3000),
(7, 9, 6, 4000),
(8, 10, 7, 5000),
(9, 2, 9, 6000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_obat` (`id_obat`),
  ADD KEY `fk_pasien` (`id_pasien`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_obat` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`),
  ADD CONSTRAINT `fk_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
