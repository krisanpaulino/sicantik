-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 16, 2021 at 05:37 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dinkesttu`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `id` int(11) NOT NULL,
  `nama_bulan` int(11) NOT NULL,
  `kelompok_triwulan` varchar(5) NOT NULL,
  `angka_bulan` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `nama_data` varchar(255) NOT NULL,
  `punya_elemen_data` int(1) NOT NULL,
  `is_stp` int(1) NOT NULL,
  `kategori_data` varchar(255) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_obat`
--

CREATE TABLE `data_obat` (
  `id` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `id_puskesmas` int(11) NOT NULL,
  `stok_awal` int(11) NOT NULL,
  `diterima` int(11) NOT NULL,
  `ketersediaan` int(11) NOT NULL,
  `sisa_stok` int(11) NOT NULL,
  `jumlah_pemakaian_obat` int(11) NOT NULL,
  `satuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_elemen_data`
--

CREATE TABLE `detail_elemen_data` (
  `id` int(11) NOT NULL,
  `id_elemen_data` int(11) NOT NULL,
  `id_sesi` int(11) NOT NULL,
  `l_lama` int(11) NOT NULL,
  `l_baru` int(11) NOT NULL,
  `p_lama` int(11) NOT NULL,
  `p_baru` int(11) NOT NULL,
  `jumlah_p` int(11) NOT NULL,
  `jumlah_l` int(11) NOT NULL,
  `tanggal_isi` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_puskesmas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_elemen_data_apotik`
--

CREATE TABLE `detail_elemen_data_apotik` (
  `id` int(11) NOT NULL,
  `id_elemen_data_apotik` int(11) NOT NULL,
  `id_puskesmas` int(11) NOT NULL,
  `jumlah_pemakaian_obat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_elemen_data_usia`
--

CREATE TABLE `detail_elemen_data_usia` (
  `id` int(11) NOT NULL,
  `id_elemen_data_usia` int(11) NOT NULL,
  `id_sesi` int(11) NOT NULL,
  `l_baru` int(11) NOT NULL,
  `l_lama` int(11) NOT NULL,
  `p_lama` int(11) NOT NULL,
  `p_baru` int(11) NOT NULL,
  `jumlah_p` int(11) NOT NULL,
  `jumlah_l` int(11) NOT NULL,
  `jumlah_kunjungan` int(11) NOT NULL,
  `jumlah_meninggal` int(11) NOT NULL,
  `id_puskesmas` int(11) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `elemen_data`
--

CREATE TABLE `elemen_data` (
  `id` int(11) NOT NULL,
  `id_data` int(11) NOT NULL,
  `id_kategori_elemen_data` int(11) NOT NULL,
  `nama_elemen_data` varchar(255) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `elemen_data_apotik`
--

CREATE TABLE `elemen_data_apotik` (
  `id` int(11) NOT NULL,
  `id_kategori_data_apotik` int(11) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `elemen_data_usia`
--

CREATE TABLE `elemen_data_usia` (
  `id` int(11) NOT NULL,
  `id_usia` int(11) NOT NULL,
  `id_data` int(11) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten_kota`
--

CREATE TABLE `kabupaten_kota` (
  `id` int(11) NOT NULL,
  `nama_kabupaten_kota` varchar(255) NOT NULL,
  `jenis` enum('Kota','Kabupaten') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kabupaten_kota`
--

INSERT INTO `kabupaten_kota` (`id`, `nama_kabupaten_kota`, `jenis`) VALUES
(1, 'Timor Tengah Utara', 'Kota');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_elemen_data`
--

CREATE TABLE `kategori_elemen_data` (
  `id` int(11) NOT NULL,
  `nama_kategori` int(11) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` int(11) NOT NULL,
  `nama_kecamatan` varchar(255) NOT NULL,
  `id_kabupaten_kota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `nama_kecamatan`, `id_kabupaten_kota`) VALUES
(1, 'Biboki', 1);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_puskesmas` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `foto` varchar(11) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `tempat_lahir` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `puskesmas`
--

CREATE TABLE `puskesmas` (
  `id` int(11) NOT NULL,
  `nama_puskesmas` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `puskesmas`
--

INSERT INTO `puskesmas` (`id`, `nama_puskesmas`, `alamat`, `no_telp`, `foto`) VALUES
(1, 'noelbaki', 'jl.asm', '97896756586', 'aytyaty.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sesi`
--

CREATE TABLE `sesi` (
  `id` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `id_bulan` int(11) NOT NULL,
  `is_open` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tahun`
--

CREATE TABLE `tahun` (
  `id` int(11) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `password`, `email`, `role_id`, `is_active`) VALUES
(1, 'Handry kali', 123, 'kali27@gmail.com', 1, 1),
(2, 'kristo tpoy', 123, 'kristo15@gmail.com', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'operator'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `usia`
--

CREATE TABLE `usia` (
  `id` int(11) NOT NULL,
  `rentang_usia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_obat`
--
ALTER TABLE `data_obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_obat` (`id_obat`),
  ADD KEY `id_puskesmas` (`id_puskesmas`);

--
-- Indexes for table `detail_elemen_data`
--
ALTER TABLE `detail_elemen_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_elemen_data` (`id_elemen_data`),
  ADD KEY `id_sesi` (`id_sesi`),
  ADD KEY `id_puskesmas` (`id_puskesmas`);

--
-- Indexes for table `detail_elemen_data_apotik`
--
ALTER TABLE `detail_elemen_data_apotik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_elemen_data_apotik` (`id_elemen_data_apotik`),
  ADD KEY `id_puskesmas` (`id_puskesmas`);

--
-- Indexes for table `detail_elemen_data_usia`
--
ALTER TABLE `detail_elemen_data_usia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_elemen_data_usia` (`id_elemen_data_usia`),
  ADD KEY `id_sesi` (`id_sesi`);

--
-- Indexes for table `elemen_data`
--
ALTER TABLE `elemen_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_data` (`id_data`),
  ADD KEY `id_kategori_elemen_data` (`id_kategori_elemen_data`);

--
-- Indexes for table `elemen_data_apotik`
--
ALTER TABLE `elemen_data_apotik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori_data_apotik` (`id_kategori_data_apotik`);

--
-- Indexes for table `elemen_data_usia`
--
ALTER TABLE `elemen_data_usia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usia` (`id_usia`),
  ADD KEY `id_data` (`id_data`);

--
-- Indexes for table `kabupaten_kota`
--
ALTER TABLE `kabupaten_kota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_elemen_data`
--
ALTER TABLE `kategori_elemen_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kabupaten_kota` (`id_kabupaten_kota`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_puskesmas` (`id_puskesmas`);

--
-- Indexes for table `puskesmas`
--
ALTER TABLE `puskesmas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sesi`
--
ALTER TABLE `sesi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tahun` (`id_tahun`),
  ADD KEY `id_bulan` (`id_bulan`);

--
-- Indexes for table `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipe` (`role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usia`
--
ALTER TABLE `usia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_obat`
--
ALTER TABLE `data_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_elemen_data`
--
ALTER TABLE `detail_elemen_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_elemen_data_apotik`
--
ALTER TABLE `detail_elemen_data_apotik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_elemen_data_usia`
--
ALTER TABLE `detail_elemen_data_usia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elemen_data`
--
ALTER TABLE `elemen_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elemen_data_apotik`
--
ALTER TABLE `elemen_data_apotik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elemen_data_usia`
--
ALTER TABLE `elemen_data_usia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kabupaten_kota`
--
ALTER TABLE `kabupaten_kota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori_elemen_data`
--
ALTER TABLE `kategori_elemen_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `puskesmas`
--
ALTER TABLE `puskesmas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sesi`
--
ALTER TABLE `sesi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahun`
--
ALTER TABLE `tahun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usia`
--
ALTER TABLE `usia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `elemen_data_usia`
--
ALTER TABLE `elemen_data_usia`
  ADD CONSTRAINT `elemen_data_usia_ibfk_1` FOREIGN KEY (`id_data`) REFERENCES `data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `elemen_data_usia_ibfk_2` FOREIGN KEY (`id_usia`) REFERENCES `usia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD CONSTRAINT `kecamatan_ibfk_1` FOREIGN KEY (`id_kabupaten_kota`) REFERENCES `kabupaten_kota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `operator`
--
ALTER TABLE `operator`
  ADD CONSTRAINT `operator_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
