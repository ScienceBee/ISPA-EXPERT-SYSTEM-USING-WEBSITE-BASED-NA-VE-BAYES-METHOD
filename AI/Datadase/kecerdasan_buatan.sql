-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 07 Des 2022 pada 23.27
-- Versi server: 8.0.28
-- Versi PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kecerdasan_buatan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `no` int NOT NULL,
  `id_gejala` varchar(25) NOT NULL,
  `nama_gejala` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`no`, `id_gejala`, `nama_gejala`) VALUES
(1, 'G1', 'Demam'),
(2, 'G2', 'Batuk'),
(3, 'G3', 'Sesak nafas tiba - tiba'),
(4, 'G4', 'Intensitas sesak nafas yang berat'),
(5, 'G5', 'Dada terasa berat'),
(6, 'G6', 'Gelisah'),
(7, 'G7', 'Hidung tersumbat/pilek'),
(8, 'G8', 'Suara nafas kasar'),
(9, 'G9', 'Sakit tenggorokan atau susah menelan'),
(10, 'G10', 'Sakit kepala/pusing'),
(11, 'G11', 'Mengalami pembengkakan/warna merah pada amandel');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyakit`
--

CREATE TABLE `penyakit` (
  `no` int NOT NULL,
  `id_penyakit` varchar(50) NOT NULL,
  `nama_penyakit` varchar(50) NOT NULL,
  `id_gejala` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `penyakit`
--

INSERT INTO `penyakit` (`no`, `id_penyakit`, `nama_penyakit`, `id_gejala`) VALUES
(1, 'P1', 'ISPA Akut', 'G3, G6, G9'),
(2, 'P2', 'ISPA Kronis', 'G1, G4, G7, G11'),
(3, 'P3', 'ISPA Periodik', 'G2, G5, G8, G10');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gejala`
--
ALTER TABLE `gejala`
  MODIFY `no` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `no` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
