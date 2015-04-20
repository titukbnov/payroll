-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 06, 2014 at 10:37 
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webdemo_karyawan`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE IF NOT EXISTS `absensi` (
  `id_absensi` int(10) NOT NULL AUTO_INCREMENT,
  `nip` varchar(15) DEFAULT NULL,
  `tanggal_absen` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL,
  `status_masuk` enum('Y','N') NOT NULL DEFAULT 'N',
  `status_keluar` enum('Y','N') NOT NULL DEFAULT 'N',
  `ket` char(2) NOT NULL DEFAULT 'NA',
  `terlambat` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_absensi`),
  UNIQUE KEY `nip` (`nip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `nip`, `tanggal_absen`, `jam_masuk`, `jam_keluar`, `status_masuk`, `status_keluar`, `ket`, `terlambat`) VALUES
(11, '32669954', '2014-01-05', '08:00:00', '17:00:00', 'Y', 'N', 'NA', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `nip` varchar(15) NOT NULL DEFAULT '',
  `nama` varchar(50) DEFAULT NULL,
  `jenis_kelamin` enum('Pria','Wanita','Lainnya') DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT '',
  `tanggal_lahir` date DEFAULT '0000-00-00',
  `golongan_darah` enum('A','B','AB','O','A+','B+','AB+') DEFAULT NULL,
  `agama` enum('Islam','Protestan','Katolik','Buddha','Hindu','Kong Hu Tju') DEFAULT NULL,
  `status_pernikahan` enum('Sendiri','Menikah','Duda','Janda') DEFAULT NULL,
  `alamat_lengkap` text,
  `telepon_rumah` int(15) DEFAULT NULL,
  `ponsel` int(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `hobi` varchar(100) DEFAULT NULL,
  `pendidikan` enum('SD','SMP','SMA','D1','D2','D3','D4','S1','S2','S3') DEFAULT NULL,
  `tanggal_masuk` date DEFAULT '0000-00-00',
  `status_kerja` enum('Kontrak','Honorer','Tetap','PNS','OutSource') DEFAULT NULL,
  `departemen` varchar(50) DEFAULT NULL,
  `organisasi` varchar(50) DEFAULT NULL,
  `golongan` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `no_ktp` int(50) DEFAULT NULL,
  `no_sim` int(50) DEFAULT NULL,
  `no_paspor` varchar(50) DEFAULT NULL,
  `no_npwp` int(50) DEFAULT NULL,
  `no_jamsostek` varchar(50) DEFAULT NULL,
  `no_asuransi` varchar(50) DEFAULT NULL,
  `no_pensiun` varchar(50) DEFAULT NULL,
  `pensiun` tinyint(1) unsigned DEFAULT '0',
  `tanggal_pensiun` date DEFAULT '0000-00-00',
  `foto` varchar(50) DEFAULT NULL,
  `sk_tambahan` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `id_login` int(11) NOT NULL,
  `id_pelatihan` int(11) NOT NULL,
  `id_penghasilan` int(11) NOT NULL,
  `id_penilaian` int(11) NOT NULL,
  `id_absensi` int(11) NOT NULL,
  PRIMARY KEY (`nip`),
  UNIQUE KEY `nip` (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nip`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `golongan_darah`, `agama`, `status_pernikahan`, `alamat_lengkap`, `telepon_rumah`, `ponsel`, `email`, `hobi`, `pendidikan`, `tanggal_masuk`, `status_kerja`, `departemen`, `organisasi`, `golongan`, `jabatan`, `no_ktp`, `no_sim`, `no_paspor`, `no_npwp`, `no_jamsostek`, `no_asuransi`, `no_pensiun`, `pensiun`, `tanggal_pensiun`, `foto`, `sk_tambahan`, `keterangan`, `id_login`, `id_pelatihan`, `id_penghasilan`, `id_penilaian`, `id_absensi`) VALUES
('32669954', 'Dwi', 'Pria', 'Jakarta', '1978-12-03', 'O', 'Islam', 'Menikah', 'Jakarta Selatan', 2132669954, 2147483647, 'nanto78@live.com', 'Chating', 'D1', '2013-01-01', 'OutSource', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00', NULL, NULL, NULL, 11, 11, 11, 11, 11);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id_login` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nip` bigint(20) DEFAULT NULL,
  `user_level` enum('Kontrak','Honorer','Tetap','Outsource') DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_login`),
  UNIQUE KEY `username` (`username`),
  KEY `nip` (`nip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `username`, `email`, `password`, `nip`, `user_level`, `last_login`, `last_update`, `created`) VALUES
(11, '32669954', 'nanto78@live.com', '123456', 32669954, 'Outsource', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pelatihan`
--

CREATE TABLE IF NOT EXISTS `pelatihan` (
  `id_pelatihan` int(4) NOT NULL AUTO_INCREMENT,
  `nip` varchar(15) DEFAULT NULL,
  `tgl_pelatihan` date DEFAULT NULL,
  `sk_pelatihan` varchar(100) DEFAULT NULL,
  `topik_pelatihan` varchar(100) DEFAULT NULL,
  `penyelenggara` varchar(100) DEFAULT NULL,
  `hasil_pelatihan` enum('Memuaskan','Baik Sekali','Baik','Cukup','Kurang') DEFAULT NULL,
  PRIMARY KEY (`id_pelatihan`),
  UNIQUE KEY `nip` (`nip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `pelatihan`
--

INSERT INTO `pelatihan` (`id_pelatihan`, `nip`, `tgl_pelatihan`, `sk_pelatihan`, `topik_pelatihan`, `penyelenggara`, `hasil_pelatihan`) VALUES
(11, '32669954', '2014-01-01', NULL, 'ISO 9001', 'Sucofindo', 'Baik');

-- --------------------------------------------------------

--
-- Table structure for table `penghasilan`
--

CREATE TABLE IF NOT EXISTS `penghasilan` (
  `id_penghasilan` int(4) NOT NULL AUTO_INCREMENT,
  `nip` varchar(15) DEFAULT NULL,
  `gaji_pokok` int(10) DEFAULT '0',
  `tunjangan` int(10) DEFAULT '0',
  `insentif` int(10) DEFAULT '0',
  `bonus` int(10) DEFAULT '0',
  `thr` int(10) DEFAULT '0',
  `pajak` int(10) DEFAULT '0',
  `pinjaman` int(10) DEFAULT '0',
  `gaji_bersih` int(10) DEFAULT '0',
  `cara_bayar` enum('Transfer','Tunai') DEFAULT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `tanggal_transfer` date DEFAULT NULL,
  `nama_bank` varchar(50) DEFAULT '',
  `nama_rekening` varchar(50) DEFAULT '',
  `no_rekening` varchar(50) DEFAULT '',
  `sk_penghasilan` varchar(50) DEFAULT '',
  PRIMARY KEY (`id_penghasilan`),
  UNIQUE KEY `nip` (`nip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `penghasilan`
--

INSERT INTO `penghasilan` (`id_penghasilan`, `nip`, `gaji_pokok`, `tunjangan`, `insentif`, `bonus`, `thr`, `pajak`, `pinjaman`, `gaji_bersih`, `cara_bayar`, `tanggal_bayar`, `tanggal_transfer`, `nama_bank`, `nama_rekening`, `no_rekening`, `sk_penghasilan`) VALUES
(11, '32669954', 2500000, 500000, 500000, 0, 0, 0, 0, 3500000, 'Transfer', '2014-01-30', '2014-01-29', 'BCA', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE IF NOT EXISTS `penilaian` (
  `id_penilaian` int(4) NOT NULL AUTO_INCREMENT,
  `nip` varchar(15) DEFAULT NULL,
  `sk_penilaian` varchar(50) DEFAULT '',
  `periode_penilaian` date DEFAULT NULL,
  `judul_penilaian` varchar(50) DEFAULT NULL,
  `indikator_a` text,
  `indikator_b` text,
  `indikator_c` text,
  `indikator_d` text,
  `indikator_e` text,
  `satuan` varchar(10) DEFAULT NULL,
  `sasaran` varchar(10) DEFAULT NULL,
  `pencapaian` varchar(10) DEFAULT NULL,
  `hasil_penilaian` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_penilaian`),
  UNIQUE KEY `nip` (`nip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `nip`, `sk_penilaian`, `periode_penilaian`, `judul_penilaian`, `indikator_a`, `indikator_b`, `indikator_c`, `indikator_d`, `indikator_e`, `satuan`, `sasaran`, `pencapaian`, `hasil_penilaian`) VALUES
(11, '32669954', NULL, '2014-01-01', 'Ketrampilan', 'Indikator Ketrampilan A', 'Indikator Ketrampilan B', 'Indikator Ketrampilan C', 'Indikator Ketrampilan D', 'Indikator Ketrampilan E', '100', '100', '100', 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_level` enum('Admin','Karyawan') DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `user_level`, `last_login`, `last_update`, `created`) VALUES
(1, 'admin', 'admin@email.aku', 'admin', 'Admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'staff', 'staff@email.aku', '123456', 'Karyawan', '2014-01-01 00:00:00', '2014-01-01 00:00:00', '2014-01-01 00:00:00'),
(3, 'staff1', 'staff1@email.aku', '123456', 'Karyawan', '2014-01-01 00:00:00', '2014-01-01 00:00:00', '2014-01-01 00:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `karyawan` (`nip`);

--
-- Constraints for table `pelatihan`
--
ALTER TABLE `pelatihan`
  ADD CONSTRAINT `pelatihan_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `karyawan` (`nip`);

--
-- Constraints for table `penghasilan`
--
ALTER TABLE `penghasilan`
  ADD CONSTRAINT `penghasilan_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `karyawan` (`nip`);

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `karyawan` (`nip`);
