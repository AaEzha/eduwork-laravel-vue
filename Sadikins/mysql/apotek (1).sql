-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Feb 2022 pada 10.43
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.8

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
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(2, 'kasir1', 'kasir1@gmail.com', '874c0ac75f323057fe3b7fb3f5a8a41df2b94b1d'),
(3, 'kasir2', 'kasir2@gmail.com', '08dfc5f04f9704943a423ea5732b98d3567cbd49'),
(4, 'kasir3', 'kasir3@gmail.com', 'dd4fab4a0925326b97aeb5435b0016b1f4ad9863'),
(5, 'kasir4', 'kasir4@gmail.com', '5db85626fdf0bbfafe45e77eeba3efdd26c8985b'),
(6, 'kasir5', 'kasir5@gmail.com', '2f43d15e05befd6b20ebb07f8a270ed6423818c9'),
(7, 'manager', 'manager@gmail.com', '1a8565a9dc72048ba03b4156be3e569f22771f23'),
(8, 'apoteker1', 'apoteker1@gmail.com', 'f993a976b1d5a02f7b3b92e0405a71a167082367'),
(9, 'apoteker2', 'apoteker2@gmail.com', '30778e2dc72b401d95a4f9d35824ad5837f6c9dd'),
(10, 'dokter', 'dokter@gmail.com', '9d2878abdd504d16fe6262f17c80dae5cec34440');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(64) NOT NULL,
  `kategori_obat` enum('Obat Bebas','Obat Keras','Obat Herbal','') NOT NULL,
  `harga_obat` int(11) NOT NULL,
  `stok_obat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `kategori_obat`, `harga_obat`, `stok_obat`) VALUES
(1, 'Antasida Doen 60ML', 'Obat Bebas', 5000, 20),
(2, 'Bintang Toedjoe Obat Maag Waisan', 'Obat Herbal', 48000, 12),
(3, 'Herbal Ace-Max\'s 350 ml', 'Obat Herbal', 153000, 40),
(4, 'Tolak Angin Cair Plus Madu 15 ml', 'Obat Herbal', 14200, 60),
(5, 'Antidia 2 mg', 'Obat Keras', 70000, 200),
(6, 'Interlac Drops 5 ml', 'Obat Bebas', 303800, 50),
(7, 'Rhinos SR 10 Kapsul', 'Obat Keras', 54000, 300),
(8, 'Acetylcysteine 200 mg', 'Obat Keras', 35000, 70),
(9, 'Tremenza Sirup 60 ml', 'Obat Bebas', 35000, 40),
(10, 'Acetylcysteine 200 mg 10 Kapsul', 'Obat Keras', 35000, 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `jk_pelanggan` enum('Laki-laki','Perempuan','','') NOT NULL,
  `no_telepon` varchar(13) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama_pelanggan`, `jk_pelanggan`, `no_telepon`, `alamat`) VALUES
(1, 'Bayu Sugara', 'Laki-laki', '08788653', 'Jl. Kembang Selatan No. 5 Rt.001/006 Jakarta'),
(2, 'Bandi Alam Syah', 'Laki-laki', '089967231', 'Jl. Pondok Nangka, Rt.009/05 Jakarta'),
(3, 'Anton Sulaiman', 'Laki-laki', '086523125', 'Jl. Pasar Sari 1, RT003/005 Bantul'),
(4, 'Sari Indriyani', 'Perempuan', '089612512', 'Jl. Palang Merah III No.4 Rt.009/05 Kabupaten Bogor'),
(5, 'Sayuti Kurniawan', 'Laki-laki', '085162537', 'Jl. Kabembem V no.8 RT.001/03 Rawa Sari, Cinere'),
(6, 'Lambang Adil W', 'Laki-laki', '087128616', 'Perum Jati Bening RT.001/005 Depok'),
(7, 'Oki Prastyo', 'Laki-laki', '0836172638', 'Dapur Susu III No. 9 Pondok Labu Jakarta Selatan'),
(8, 'Novita Putri Laksmiadi', 'Perempuan', '086512316', 'Jl. Bojong sari No.4 Gunung Putri Kab. Bogor'),
(9, 'Niar Indriani', 'Perempuan', '0809796767', 'Jl. Kebayoran baru jakarta Selatan'),
(10, 'Danar lukito', 'Laki-laki', '08576786876', 'Jl. Bandung No.12 Cinere, Depok');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `jabatan_petugas` enum('Admin','Dokter','Apoteker','Kasir','Manager') NOT NULL,
  `jk_petugas` enum('Laka-laki','Perempuan') NOT NULL,
  `alamat_petugas` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id`, `nama_petugas`, `jabatan_petugas`, `jk_petugas`, `alamat_petugas`, `id_user`) VALUES
(1, 'Maman Abdurahman', 'Admin', 'Laka-laki', 'Jl. Keramat Watu Jakarta', 1),
(2, 'Nila Sofyawati', 'Apoteker', 'Perempuan', 'Jl. Mangga Raya no. 8 Depok', 8),
(3, 'Yurike ', 'Kasir', 'Perempuan', 'Jl. Perangai I no.8 Depok', 3),
(4, 'Budiman Jatmiko', 'Dokter', 'Laka-laki', 'Jl. Lemah Abang', 10),
(5, 'Sarifah Ragoan', 'Apoteker', 'Perempuan', 'Jl. Brigif Raya', 9),
(6, 'Sasa mariska', 'Kasir', 'Perempuan', 'Jl. Garuda', 4),
(7, 'Noni Palmbudi', 'Kasir', 'Perempuan', 'Jl. Bojong', 5),
(8, 'Kevin Endrian', 'Kasir', 'Laka-laki', 'Jl. Pesona Kayangan', 6),
(9, 'Riko Pambudi', 'Kasir', 'Laka-laki', 'Jl. Perairan I No.8', 2),
(10, 'Pramuda Wardhana', 'Manager', 'Laka-laki', 'Jl. Kemanggis Raya no.1', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_user`, `id_obat`, `id_pelanggan`, `tanggal_transaksi`, `jumlah_beli`, `harga_beli`) VALUES
(1, 2, 8, 3, '2022-02-08', 2, 70000),
(2, 3, 2, 9, '2022-02-10', 1, 48000),
(3, 3, 5, 6, '2022-02-09', 3, 210000),
(4, 4, 3, 8, '2022-02-09', 1, 153000),
(5, 5, 6, 1, '2022-02-11', 1, 303800),
(6, 3, 7, 2, '2022-02-11', 1, 54000),
(7, 2, 3, 10, '2022-02-11', 1, 153000),
(8, 4, 1, 3, '2022-02-11', 1, 70000),
(9, 3, 9, 10, '2022-02-12', 1, 35000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_obat` (`id_obat`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `login` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
