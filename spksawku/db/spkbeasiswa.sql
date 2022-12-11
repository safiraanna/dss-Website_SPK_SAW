-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2022 at 01:27 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spkbeasiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `kdKriteria` int(11) NOT NULL,
  `kriteria` varchar(100) NOT NULL,
  `atribut` varchar(15) DEFAULT NULL,
  `bobot` decimal(2,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`kdKriteria`, `kriteria`, `atribut`, `bobot`) VALUES
(1, 'Jumlah KIP dari Pemerintah', 'cost', '0.3'),
(2, 'Jumlah Siswa Miskin yang Tidak Bersekolah', 'benefit', '0.4'),
(3, 'Jumlah Sekolah per Kecamatan', 'benefit', '0.3');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `kdKecamatan` int(11) NOT NULL,
  `namaKecamatan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`kdKecamatan`, `namaKecamatan`) VALUES
(1, 'Kec. Buahdua'),
(2, 'Kec. Cibugel'),
(3, 'Kec. Cimalaka'),
(4, 'Kec. Cimanggung'),
(5, 'Kec. Cisarua'),
(6, 'Kec. Cisitu'),
(7, 'Kec. Darmaraja'),
(8, 'Kec. Ganeas'),
(9, 'Kec. Conggeang'),
(10, 'Kec. Jatigede'),
(11, 'Kec. Jatinangor'),
(12, 'Kec. Jatinunggal'),
(13, 'Kec. Pamulihan'),
(14, 'Kec. Paseh'),
(15, 'Kec. Rancakalong'),
(16, 'Kec. Situraja'),
(17, 'Kec. Sukasari'),
(18, 'Kec. Sumedang Selatan'),
(19, 'Kec. Sumedang Utara'),
(21, 'Kec. Tanjungkerta'),
(22, 'Kec. Tanjungmedar'),
(23, 'Kec. Tanjungsari'),
(24, 'Kec. Tomo'),
(25, 'Kec. Ujungjaya'),
(26, 'Kec. Wado');

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `kdKecamatan` int(11) NOT NULL,
  `kdKriteria` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluations`
--

INSERT INTO `evaluations` (`kdKecamatan`, `kdKriteria`, `nilai`) VALUES
(1, 1, 1075),
(1, 2, 795),
(1, 3, 6),
(2, 1, 124),
(2, 2, 754),
(2, 3, 9),
(3, 1, 253),
(3, 2, 1325),
(3, 3, 8),
(4, 1, 1674),
(4, 2, 3507),
(4, 3, 25),
(5, 1, 1147),
(5, 2, 605),
(5, 3, 4),
(6, 1, 788),
(6, 2, 1355),
(6, 3, 3),
(7, 1, 806),
(7, 2, 1746),
(7, 3, 8),
(8, 1, 1054),
(8, 2, 881),
(8, 3, 6),
(9, 1, 527),
(9, 2, 400),
(9, 3, 4),
(10, 1, 456),
(10, 2, 502),
(10, 3, 2),
(11, 1, 2519),
(11, 2, 2181),
(11, 3, 13),
(12, 1, 551),
(12, 2, 1919),
(12, 3, 11),
(13, 1, 903),
(13, 2, 1834),
(13, 3, 13),
(14, 1, 202),
(14, 2, 558),
(14, 3, 3),
(15, 1, 395),
(15, 2, 1070),
(15, 3, 7),
(16, 1, 353),
(16, 2, 1413),
(16, 3, 3),
(17, 1, 1054),
(17, 2, 870),
(17, 3, 15),
(18, 1, 391),
(18, 2, 2175),
(18, 3, 10),
(19, 1, 919),
(19, 2, 2614),
(19, 3, 1),
(21, 1, 271),
(21, 2, 778),
(21, 3, 2),
(22, 1, 233),
(22, 2, 592),
(22, 3, 1),
(23, 1, 655),
(23, 2, 1895),
(23, 3, 9),
(24, 1, 671),
(24, 2, 608),
(24, 3, 2),
(25, 1, 456),
(25, 2, 633),
(25, 3, 10),
(26, 1, 320),
(26, 2, 1903),
(26, 3, 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`kdKriteria`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`kdKecamatan`);

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD UNIQUE KEY `indexNilai` (`kdKecamatan`,`kdKriteria`) USING BTREE,
  ADD KEY `kdKriteria` (`kdKriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `kdKriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_ibfk_1` FOREIGN KEY (`kdKecamatan`) REFERENCES `districts` (`kdKecamatan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluations_ibfk_2` FOREIGN KEY (`kdKriteria`) REFERENCES `criteria` (`kdKriteria`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
