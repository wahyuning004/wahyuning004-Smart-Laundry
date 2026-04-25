-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Apr 2026 pada 10.37
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk_laundry`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_laundry` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `pemilik` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `id_user`, `nama_laundry`, `alamat`, `keterangan`, `pemilik`) VALUES
(1, 1, 'Bekasi Laundry Premium', 'Jl. Ahmad Yani No.10, Bekasi Selatan', 'Spesialis pakaian satuan dan jas', 'Budi Santoso'),
(2, 1, 'Clean & Fresh Bekasi Jaya', 'Jl. Agus Salim No.45, Bekasi Timur', 'Cuci kiloan express 24 jam', 'Siti Aminah'),
(3, 1, 'Harapan Baru Laundry', 'Kawasan Harapan Indah, Medan Satria', 'Layanan antar jemput gratis', 'Joko Susilo'),
(4, 1, 'Wangi Barokah Rawalumbu', 'Jl. Jembatan Nol, Rawalumbu', 'Menggunakan parfum kualitas ekspor', 'Hj. Fatimah'),
(5, 1, 'Smart Wash Galaxy', 'Grand Galaxy City Blok R, Bekasi Selatan', 'Self-service laundry modern', 'Andi Wijaya'),
(6, 1, 'Summarecon Clean', 'Ruko Emerald, Summarecon Bekasi', 'Pencucian dry cleaning karpet', 'Robert Chen'),
(7, 1, 'Tambun Jaya Laundry', 'Jl. Sultan Hasanudin, Tambun Selatan', 'Cuci sepatu dan tas', 'Eko Prasetyo'),
(8, 1, 'Kranji Express Laundry', 'Dekat Stasiun Kranji, Bekasi Barat', 'Harga ekonomis untuk mahasiswa', 'Dewi Lestari'),
(9, 1, 'Cikarang Utama Clean', 'Kawasan Jababeka II, Cikarang', 'Melayani laundry industri dan mess', 'H. Mansur'),
(10, 1, 'Mustika Jaya Wash', 'Perumahan Grand Wisata, Mustika Jaya', 'Pencucian perlengkapan bayi (baby spa)', 'Linda Sari'),
(11, 1, 'Jatiasih Eco Wash', 'Jl. Cikunir Raya, Jatiasih', 'Ramah lingkungan & deterjen bayi', 'Herman Yudha'),
(12, 1, 'Bantar Gebang Jaya', 'Jl. Raya Narogong, Bantar Gebang', 'Spesialis karpet dan bed cover', 'Agus Prayitno'),
(13, 1, 'Pondok Gede Express', 'Dekat Pasar Pondok Gede', 'Cuci kilat 3 jam jadi', 'Siska Putri'),
(14, 1, 'Medansatria Clean', 'Perumahan Pejuang Pratama', 'Layanan laundry sepatu & tas', 'Fandi Ahmad'),
(15, 1, 'Bintara Fresh Laundry', 'Jl. Bintara Jaya, Bekasi Barat', 'Parfum aroma kopi & sakura', 'Rina Melati'),
(16, 1, 'Grand Wisata Premium', 'Cluster Celebration, Mustika Jaya', 'Mesin standar Eropa (Electrolux)', 'Kevin Sanjaya'),
(17, 1, 'Cibitung Central Wash', 'Dekat Stasiun Cibitung', 'Harga promo khusus buruh pabrik', 'M. Ridwan'),
(18, 1, 'Jatimakmur Laundry', 'Jl. Wisma Ratu, Pondok Gede', 'Gratis lipat setrika rapi', 'Dewi Sartika'),
(19, 1, 'Pekayon Indah Laundry', 'Jl. Ketapang, Pekayon Jaya', 'Menerima cuci boneka raksasa', 'Anton Wijaya'),
(20, 1, 'Rawalumbu Kiloan Plus', 'Jl. Lumbu Timur, Rawalumbu', 'Diskon hari Jumat berkah', 'Hj. Rohmah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(10) DEFAULT NULL,
  `nama_kriteria` varchar(100) DEFAULT NULL,
  `bobot` float DEFAULT NULL,
  `jenis` enum('benefit','cost') NOT NULL,
  `sifat` enum('benefit','cost') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `bobot`, `jenis`, `sifat`) VALUES
(1, 'C1', 'Harga', 0.25, 'cost', 'cost'),
(2, 'C2', 'Kualitas Kebersihan', 0.3, 'benefit', 'benefit'),
(3, 'C3', 'Kecepatan Pelayanan', 0.2, 'benefit', 'benefit'),
(4, 'C4', 'Keramahan Staff', 0.15, 'benefit', 'benefit'),
(5, 'C5', 'Fasilitas Antar Jemput', 0.1, 'benefit', 'benefit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_alternatif` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nilai` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_alternatif`, `id_kriteria`, `nilai`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 5),
(3, 1, 3, 5),
(4, 1, 4, 5),
(5, 1, 5, 4),
(6, 2, 1, 5),
(7, 2, 2, 3),
(8, 2, 3, 5),
(9, 2, 4, 4),
(10, 2, 5, 2),
(11, 3, 1, 4),
(12, 3, 2, 4),
(13, 3, 3, 3),
(14, 3, 4, 4),
(15, 3, 5, 5),
(16, 4, 1, 3),
(17, 4, 2, 5),
(18, 4, 3, 4),
(19, 4, 4, 5),
(20, 4, 5, 3),
(21, 5, 1, 4),
(22, 5, 2, 4),
(23, 5, 3, 5),
(24, 5, 4, 3),
(25, 5, 5, 1),
(26, 6, 1, 1),
(27, 6, 2, 5),
(28, 6, 3, 4),
(29, 6, 4, 5),
(30, 6, 5, 4),
(31, 7, 1, 4),
(32, 7, 2, 3),
(33, 7, 3, 3),
(34, 7, 4, 3),
(35, 7, 5, 3),
(36, 8, 1, 4),
(37, 8, 2, 3),
(38, 8, 3, 5),
(39, 8, 4, 4),
(40, 8, 5, 2),
(41, 9, 1, 3),
(42, 9, 2, 5),
(43, 9, 3, 3),
(44, 9, 4, 4),
(45, 9, 5, 4),
(46, 10, 1, 5),
(47, 10, 2, 3),
(48, 10, 3, 3),
(49, 10, 4, 4),
(50, 10, 5, 3),
(51, 11, 1, 4),
(52, 11, 2, 4),
(53, 11, 3, 3),
(54, 11, 4, 5),
(55, 11, 5, 4),
(56, 12, 1, 5),
(57, 12, 2, 3),
(58, 12, 3, 4),
(59, 12, 4, 3),
(60, 12, 5, 3),
(61, 13, 1, 3),
(62, 13, 2, 4),
(63, 13, 3, 5),
(64, 13, 4, 4),
(65, 13, 5, 2),
(66, 14, 1, 4),
(67, 14, 2, 5),
(68, 14, 3, 3),
(69, 14, 4, 4),
(70, 14, 5, 4),
(71, 15, 1, 5),
(72, 15, 2, 4),
(73, 15, 3, 4),
(74, 15, 4, 4),
(75, 15, 5, 3),
(76, 16, 1, 2),
(77, 16, 2, 5),
(78, 16, 3, 5),
(79, 16, 4, 5),
(80, 16, 5, 5),
(81, 17, 1, 5),
(82, 17, 2, 3),
(83, 17, 3, 3),
(84, 17, 4, 4),
(85, 17, 5, 3),
(86, 18, 1, 4),
(87, 18, 2, 4),
(88, 18, 3, 4),
(89, 18, 4, 4),
(90, 18, 5, 4),
(91, 19, 1, 3),
(92, 19, 2, 4),
(93, 19, 3, 4),
(94, 19, 4, 5),
(95, 19, 5, 3),
(96, 20, 1, 5),
(97, 20, 2, 4),
(98, 20, 3, 4),
(99, 20, 4, 5),
(100, 20, 5, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `level` enum('admin','petugas') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`, `level`) VALUES
(1, 'admin', 'admin123', 'Eka Wahyuning Tiyasa', 'admin'),
(2, 'bekasipremium', 'petugas123', 'Bekasi Laundry Premium', 'petugas'),
(3, 'cleanfresh', 'petugas123', 'Clean & Fresh Bekasi Jaya', 'petugas'),
(4, 'harapanbaru', 'petugas123', 'Harapan Baru Laundry', 'petugas'),
(5, 'wangibarokah', 'petugas123', 'Wangi Barokah Rawalumbu', 'petugas'),
(6, 'smartwash', 'petugas123', 'Smart Wash Galaxy', 'petugas'),
(7, 'summareconclean', 'petugas123', 'Summarecon Clean', 'petugas'),
(8, 'tambunjaya', 'petugas123', 'Tambun Jaya Laundry', 'petugas'),
(9, 'kranjiexpress', 'petugas123', 'Kranji Express', 'petugas'),
(10, 'cikarangutama', 'petugas123', 'Cikarang Utama Wash', 'petugas'),
(11, 'mustikajaya', 'petugas123', 'Mustika Jaya Laundry', 'petugas'),
(12, 'jatiasiheco', 'petugas123', 'Jatiasih Eco Wash', 'petugas'),
(13, 'bantargebang', 'petugas123', 'Bantar Gebang Jaya', 'petugas'),
(14, 'pondokgede', 'petugas123', 'Pondok Gede Express', 'petugas'),
(15, 'medansatria', 'petugas123', 'Medansatria Clean', 'petugas'),
(16, 'bintarafresh', 'petugas123', 'Bintara Fresh Laundry', 'petugas'),
(17, 'grandwisata', 'petugas123', 'Grand Wisata Premium', 'petugas'),
(18, 'cibitungwash', 'petugas123', 'Cibitung Central Wash', 'petugas'),
(19, 'jatimakmur', 'petugas123', 'Jatimakmur Laundry', 'petugas'),
(20, 'pekayonindah', 'petugas123', 'Pekayon Indah Laundry', 'petugas'),
(21, 'rawalumbukiloan', 'petugas123', 'Rawalumbu Kiloan Plus', 'petugas');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD CONSTRAINT `alternatif_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`),
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
