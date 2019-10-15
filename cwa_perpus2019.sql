-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2019 at 09:06 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cwa_perpus2019`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_baju`
--

CREATE TABLE `tb_baju` (
  `id_baju` int(11) NOT NULL,
  `nama_baju` varchar(50) DEFAULT NULL,
  `uk` enum('S','M','L','XL') DEFAULT NULL,
  `jml` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_baju`
--

INSERT INTO `tb_baju` (`id_baju`, `nama_baju`, `uk`, `jml`) VALUES
(6, 'HITAM', 'M', '7'),
(7, 'HITAM', 'L', '32'),
(8, 'HITAM', 'XL', '5'),
(9, 'MERAH', 'M', '23'),
(10, 'MERAH', 'L', '24'),
(11, 'MERAH', 'XL', '8'),
(12, 'BIRU', 'M', '13'),
(13, 'BIRU', 'L', '25'),
(14, 'BIRU', 'XL', '16'),
(15, 'ABU-ABU', 'M', '16'),
(16, 'ABU-ABU', 'L', '16'),
(17, 'ABU-ABU', 'XL', '11'),
(18, 'KUNING', 'M', '0'),
(19, 'KUNING', 'L', '22'),
(20, 'KUNING', 'XL', '48'),
(21, 'KUNING LAMA', 'XL', '4'),
(22, 'JAKET', 'XL', '18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id_buku` int(11) NOT NULL,
  `kode_buku` varchar(20) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `pengarang` varchar(50) DEFAULT NULL,
  `penerbit` varchar(50) DEFAULT NULL,
  `jml` varchar(10) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_buku`
--

INSERT INTO `tb_buku` (`id_buku`, `kode_buku`, `judul`, `gambar`, `pengarang`, `penerbit`, `jml`, `keterangan`) VALUES
(2, '001-019,101', 'Being Happy', '5c9c3187ae8ab.jpg', 'ANDREW MATTHEWS', 'PT Gramedia Pustaka Utama, Jakarta', '3', '-'),
(3, '020-032', 'HOW TO WIN FRIENDS & INFLUENCE PEOPLE', '5c9c3572303f2.jpg', 'DALE CARNEGIE', 'PT Gramedia Pustaka Utama, Jakarta', '13', 'JUDUL BAHASA INGGRIS'),
(4, 'o67-086', 'BAGAIMANA MENCARI KAWAN DAN MEMENGARUHI ORANG LAIN', '5c9c370c7fa04.jpg', 'DALE CARNEGIE', 'Karisma Inti Ilmu', '4', 'JUDUL BAHASA INDONESIA'),
(5, '033-047', 'BAHAGIA SEKARANG', '5c9c38aa0474c.jpg', 'ANDREW MATTHEWS', 'KHARISMA Publishing Group', '15', '-'),
(6, '048-066', 'IKUTI KATA HATIMU', '5c9c3a4775e4d.jpg', 'ANDREW MATTHEWS', 'CHANGE PUBLICATION', '2', '-'),
(7, '087-090,100', 'Si Cacing Dan Kotoran Kesayangannya', '5cd0eda819348.jpg', 'Ajahn Brahm', 'Awareness Publication', '5', '-'),
(8, '091', 'PSYCHOLOGY QUIS', '5cda6941f190e.jpeg', 'ERIKA EVIS MURRAY', 'PSYCHOPEDIA', '1', '-'),
(9, '092,093', 'Empowerment Takes More Than a Minute', '5cf74bdc56219.jpg', 'Ken Blanchard', '-', '2', '-'),
(10, '094-099', 'Law of Attraction', '5cf74cab2117a.jpg', 'MICHAEL J.LOSIER', '-', '6', '-'),
(11, '102', 'The One-Time On-Target Manager', '5cf74e2e1de9d.jpg', 'Ken Blanchard Stave Gottry', '-', '1', '-'),
(12, '103', 'Manufacturing Hope Bisa', '5cf74ea58f85c.jpg', 'DAHLAN ISKAN', '-', '1', '-'),
(13, '104', 'Badan Penyelenggara Jaminan Sosial', 'default.png', '-', 'Citra Umbara Bandung', '1', '-'),
(14, '105', '7 habits of highly effective people', '5cf750580c63f.jpg', 'Warren Bennis', '-', '1', '-'),
(15, '106', 'Keajaiban Otak Kanan', '5cf750b202da2.jpg', 'Dr. SHIGEO HARUYAMA', '-', '1', '-'),
(16, '107', 'Manajemen Logistik', '5cfef13ac662b.jpg', 'Ricky Martono', '-', '1', '-'),
(17, '108', 'Manajemen Hubungan Industrial', '5cfef20a23f8f.jpg', 'Prof. Dr. Payaman J,Simanjuntak', 'Fakultas Ekonomi Universitas Indonesia', '1', '-'),
(18, '109', 'The 3 Keys to Empowerment', '5cfef2963cd7c.jpg', 'Ken Blanchard', '-', '1', '-'),
(19, '110', 'build the best of your life', '5cfef47e1ca37.jpg', 'Hermanto Kosasih', '-', '1', '-'),
(20, '111', 'One Page Management', 'default.png', 'Riaz Khadem, Ph.D.,', '-', '1', '-'),
(21, '112', 'Fit For Success', '5cfef5ba8b97b.jpg', 'Phaidon L. Toruan', '-', '1', '-'),
(22, '113', 'The Speed Of Trust', '5cfef6192242d.jpg', 'Stephen M.R Covey', '-', '1', '-'),
(23, '114', 'Che Guevara', '5cfef6af21f8a.jpg', '-', '-', '1', '-'),
(24, '115', 'Jawab Job Interwiew', 'default.png', 'Martin J. Yate', '-', '1', '-'),
(25, '116', 'New Consumer Behavior', 'default.png', '-', '-', '1', '-'),
(26, '117', 'Jurus Kilat Sukses Psikotes', '5cfef869986bd.jpg', 'Emilia Darmawati S.Psi', '-', '1', '-'),
(27, '118', 'Marketing Kebal Lesu', '5cfef8b8a8f61.jpg', '-', '-', '1', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hilang`
--

CREATE TABLE `tb_hilang` (
  `id_hilang` int(11) NOT NULL,
  `id_pinjam` int(11) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `jml` varchar(6) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `departemen` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id_karyawan`, `nama`, `departemen`) VALUES
(1, 'Putri Yuliati', 'CW 1'),
(2, 'Agus Cahyono', 'CW 1'),
(3, 'Fani Fajar Zulvi', 'CW 1'),
(4, 'Ni Kadek Okta Viani', 'CW 1'),
(5, 'Redar Niaman Harefa', 'CW 1'),
(6, 'Riyanti', 'CW 2'),
(7, 'Leonardus MPangur', 'CW 2'),
(8, 'Ni Wayan Aristiana Wati', 'CW 2'),
(9, 'Sugeng Candra Pangestu', 'CW 2'),
(10, 'Martinianus Mardin', 'CW 2'),
(11, 'Muhamad Malik Aziz Alkutri', 'CW 2'),
(12, 'Made Suparka', 'CW 3'),
(13, 'Selviana S. Ledi', 'CW 3'),
(14, 'Komang Ayu Yuliantari', 'CW 3'),
(15, 'Hardianto', 'CW 3'),
(16, 'Ramdani', 'CW 3'),
(17, 'Ahmad Sulaiman', 'CW 3'),
(18, 'Imam Wahyu Utomo', 'CW 3'),
(19, 'Maudilla Anwar Putri', 'CW 3'),
(20, 'Novi Indriawan', 'CW 4'),
(21, 'Indah Yusmawati', 'CW 4'),
(22, 'Ni Putu Yuliana Dewi', 'CW 4'),
(23, 'I Made Adi Pramudita', 'CW 4'),
(24, 'I Komang Semara Dana Putra', 'CW 4'),
(25, 'Anggi Pradana', 'CW 4'),
(26, 'Agung', 'CW 5'),
(27, 'Riska Elvandri', 'CW 5'),
(28, 'I Komang Ariana', 'CW 5'),
(29, 'I Putu Eka Gunawan Martha', 'CW 5'),
(30, 'Wahfiudin Wabarok Alim', 'CW 5'),
(31, 'Ni Luh Putu Ana Antarini', 'CW 5'),
(32, 'Galih Suganda', 'CW 5'),
(33, 'Husni Mubarok', 'CW 6'),
(34, 'Ni Nyoman Sarniti Adnyani', 'CW 6'),
(35, 'Muhammad Abdul Aziz', 'CW 6'),
(36, 'M. Kadri Ramdhan', 'CW 6'),
(37, 'Dyah Putri Lestari', 'CW 6'),
(38, 'Sri Rahayu', 'CW 7'),
(39, 'Ginik Susiati', 'CW 7'),
(40, 'Ni Kadek Dodi Wariski', 'CW 7'),
(41, 'I Kadek Yoin Hendrawan', 'CW 7'),
(42, 'Ni Kadek Ayu Chelsea', 'CW 7'),
(43, 'Ibnu Syafiq Abdulah', 'CW 7'),
(44, 'Gede Sudarma', 'CW 8'),
(45, 'Ni Made Suwi Maheni', 'CW 8'),
(46, 'I Gede Supa ', 'CW 8'),
(47, 'I Wayan Ade Suartana Gunawan', 'CW 8'),
(48, 'I Gst. Ngr. Agung Kesumadewa', 'CW 8'),
(49, 'Ni Komang Ayu Sugiari', 'CW 8'),
(50, 'Mohamad Saifudin', 'CW 9'),
(51, 'Munaam', 'CW 9'),
(52, 'Elizabeth P. Elu', 'CW 9'),
(53, 'Tokip', 'CW 9'),
(54, 'Natalia Stiman', 'CW 9'),
(55, 'Hasan Abdillah', 'CW 9'),
(56, 'Muhammad Khuzairi', 'CW 9'),
(57, 'I Nyoman Perdana', 'CW 10'),
(58, 'Ni Wayan Puspahadi', 'CW 10'),
(59, 'I Made Ardana ', 'CW 10'),
(60, 'I Nyoman Febrianto Wisnu Wardhana', 'CW 10'),
(61, 'Andik Eko Hermanto', 'CW 10'),
(62, 'Ahmad Nur Wahid', 'CW 11'),
(63, 'I Dewa Gede Suradityawan', 'CW 11'),
(64, 'I Wayan Sugiana', 'CW 11'),
(65, 'Ni Ketut Sriati', 'CW 11'),
(66, 'I Gusti Ngurah Agung Wirawan Sudewa', 'CW 11'),
(67, 'Mohamad Hanaki', 'CW 12'),
(68, 'Ni Putu Kendida Sekariani S.', 'CW 12'),
(69, 'Muhammad Junaidi', 'CW 12'),
(70, 'Sahdi', 'CW 13'),
(71, 'Kholifah', 'CW 13'),
(72, 'I Putu Suartana', 'CW 13'),
(73, 'Komang Arnaya', 'CW 13'),
(74, 'Niluh Ayu Putu Maitrayani', 'CW 14'),
(75, 'Achmad Azhar Firdaus', 'CW 14'),
(76, 'Ricky Fernando Urip Pratama', 'CW 14'),
(77, 'I Komang Putra Pratangkas', 'CW 14'),
(78, 'Komang Rudi Adnyana', 'CW 14'),
(79, 'Cristian Pratama Tanaya', 'CW 15'),
(80, 'Ni Made Sudarmini', 'CW 15'),
(81, 'Kadek Joni Indrawan', 'CW 15'),
(82, 'I Gusti Agung Dodi Adnyana', 'CW 15'),
(83, 'Kadek Widiasa', 'CW 15'),
(84, 'Imam Busyairi', 'CW 15'),
(85, 'Intan Fania', 'CW 15'),
(86, 'Ida Bagus Gede Jaya Giri', 'CW 16'),
(87, 'Mohammad Jayadi', 'CW 16'),
(88, 'Ni Made Hadi Utami', 'CW 16'),
(89, 'Ni Wayan Ekayani', 'CW 16'),
(90, 'Dimas Pratama', 'CW 16'),
(91, 'I Dewa Gede Wiratama', 'CW 17'),
(92, 'Faisol Fanani', 'CW 17'),
(93, 'Fatoni Hidayatulloh', 'CW 17'),
(94, 'Dian Septiana Thalia', 'CW 17'),
(95, 'Candra Asmara', 'CW 17'),
(96, 'Ni Kadek Ayu Puspayanti', 'CW 17'),
(97, 'Gusti Putu Eka Mara Adi', 'CW 18'),
(98, 'Fredy Aryadi', 'CW 18'),
(99, 'Muhammad Romdan Afandi', 'CW Lombok'),
(100, 'Wayan Sudarta', 'CW Lombok'),
(101, 'Alya Gaitsha', 'CW Lombok'),
(102, 'Evi Kurniati', 'ACCOUNTING'),
(103, 'Luh Putri Wardani', 'ACCOUNTING'),
(104, 'Ni Putu Ida Febriyanti ', 'ACCOUNTING'),
(105, 'Ayu Icha Rahmana Sari', 'ACCOUNTING'),
(106, 'Ni Made Indri Raditya Oviani', 'ACCOUNTING'),
(107, 'Triposa Sudamia', 'FINANCE'),
(108, 'Ni Nyoman Merry Astarini', 'FINANCE'),
(109, 'Nur Aini', 'FINANCE'),
(110, 'Ni Putu Laksmi Purna Wijayanti', 'FINANCE'),
(111, 'Johanes Ari Agung Seno Sinduro', 'GA'),
(112, 'Wahyu Noviya Ningsih', 'GA'),
(113, 'Andika Putra Hartana', 'GA'),
(114, 'Iqbal Maulana', 'GA'),
(115, 'Nazula Agustin', 'GUDANG'),
(116, 'Marthinus Kendu', 'GUDANG'),
(117, 'I Nyoman Adi Sugiantara', 'GUDANG'),
(118, 'I Gede Suwanta', 'GUDANG'),
(119, 'Rini Idayanti', 'GUDANG'),
(120, 'Nia Ruliantari', 'GUDANG'),
(121, 'Ni Luh Komang Tri Adnyani', 'GUDANG'),
(122, 'Bayu Purnomo', 'GUDANG'),
(123, 'I Made Ariawan', 'GUDANG'),
(124, 'I Kadek Susanto', 'GUDANG'),
(125, 'I Putu Diana Eka Putra', 'GUDANG'),
(126, 'I Gusti Bagus Ardiana', 'GUDANG'),
(127, 'Nyoman Adi Merta', 'GUDANG'),
(128, 'Putu Darsana', 'GUDANG'),
(129, 'Made Gunawan', 'GUDANG'),
(130, 'Indah Mawarni', 'GUDANG'),
(131, 'Moh. Mukhlisin', 'GUDANG'),
(132, 'Muh. Sofian Zain Khul', 'GUDANG'),
(133, 'Agus Supriadi', 'GUDANG'),
(134, 'Agus Andika', 'GUDANG'),
(135, 'Ahmad Arif Sutikno', 'GUDANG'),
(136, 'Fatah Abdor Rohman', 'GUDANG'),
(137, 'Yusansius Janggu', 'GUDANG'),
(138, 'Baihaqi Alkaf', 'GUDANG'),
(139, 'Vitalis Agung', 'GUDANG'),
(140, 'Raymundus Pe Grahono', 'GUDANG'),
(141, 'Daud Andi Lolo', 'GUDANG'),
(142, 'Gede Angga Septiadi', 'HRD'),
(143, 'Katania Prasetya', 'HRD'),
(144, 'Gede Agus Surya Arta', 'IT'),
(145, 'Kadek Bayu Arimbawa', 'IT'),
(146, 'Deby Raditya Prasetyo', 'IT'),
(147, 'Christin Erika Rumagit', 'MT'),
(148, 'Gusti KM Sudiartawan', 'MT'),
(149, 'Rizal Kusnayadi Saputra', 'MT'),
(150, 'Hendri', 'OFFICE'),
(151, 'I Nyoman Nesa', 'OFFICE'),
(152, 'Ni Komang Sudiantari', 'OFFICE'),
(153, 'Ni Kadek Wulandari', 'OFFICE'),
(154, 'Adrianus Arianto', 'OFFICE'),
(155, 'I Made Adiyana', 'OFFICE'),
(156, 'Gusti Putu Teddy Hartady', 'OFFICE'),
(157, 'Awaludin ', 'OFFICE'),
(158, 'Ni Putu Ria Yuliantini', 'QA'),
(159, 'Sultoni Firmansyah', 'QA'),
(160, 'I.A Pt Cintya Dewi Anggreni', 'SCM'),
(161, 'Ni Made Sukari', 'SCM'),
(162, 'Reni Anjarsari', 'SCM'),
(163, 'Ni Luh Wayan Mira Septiari', 'SCM'),
(164, 'Asrul Abadi', 'SCM'),
(165, 'A.A Istri Dian Indra Sukmaningsih', 'SCM'),
(166, 'Ni Luh Gede Rustina Dewi', 'SCM'),
(167, 'Ni Made Febby Cahaya Ningsih', 'SCM'),
(168, 'Kadek Agus Rieskie Suparta Negara Dwipayana ', 'SCM'),
(169, 'Dian Rahman', 'SCM'),
(170, 'I Made Surya Gunawan', 'GA'),
(171, 'Ida Ayu Komang Sri Suastini', 'SCM'),
(172, 'Dewa Ayu Putu Eka Kardani', 'Gudang');

-- --------------------------------------------------------

--
-- Table structure for table `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `kd_pinjam` varchar(20) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `qty` varchar(6) DEFAULT NULL,
  `no_buku` varchar(20) NOT NULL,
  `stat` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_peminjaman`
--

INSERT INTO `tb_peminjaman` (`id_pinjam`, `id_buku`, `id_karyawan`, `kd_pinjam`, `tgl`, `qty`, `no_buku`, `stat`) VALUES
(1, 2, 143, 'P1', '2019-03-28', '1', '', 'kembali'),
(2, 4, 157, 'P2', '2019-04-06', '1', '', 'kembali'),
(3, 2, 112, 'P3', '2019-04-08', '1', '005', 'pinjam'),
(4, 6, 112, 'P3', '2019-04-08', '1', '052', 'pinjam'),
(5, 4, 112, 'P3', '2019-04-08', '1', '068', 'pinjam'),
(7, 4, 111, 'P4', '2019-04-08', '1', '015', 'pinjam'),
(8, 2, 111, 'P4', '2019-04-08', '1', '063', 'pinjam'),
(9, 6, 111, 'P4', '2019-04-08', '1', '081', 'pinjam'),
(10, 4, 157, 'P5', '2019-04-08', '1', '013', 'kembali'),
(11, 2, 157, 'P5', '2019-04-08', '1', '062', 'pinjam'),
(12, 6, 157, 'P5', '2019-04-08', '1', '071', 'pinjam'),
(13, 4, 26, 'P6', '2019-04-08', '1', '017', 'pinjam'),
(14, 2, 26, 'P6', '2019-04-08', '1', '064', 'pinjam'),
(15, 6, 26, 'P6', '2019-04-08', '1', '083', 'pinjam'),
(16, 4, 149, 'P7', '2019-04-08', '1', '054', 'pinjam'),
(17, 2, 149, 'P7', '2019-04-08', '1', '069', 'pinjam'),
(18, 6, 149, 'P7', '2019-04-08', '1', '066', 'pinjam'),
(19, 4, 39, 'P8', '2019-04-08', '1', '049', 'pinjam'),
(20, 2, 39, 'P8', '2019-04-08', '1', '075', 'pinjam'),
(21, 6, 39, 'P8', '2019-04-08', '1', '010', 'pinjam'),
(22, 2, 33, 'P9', '2019-04-08', '1', '050', 'pinjam'),
(23, 4, 33, 'P9', '2019-04-08', '1', '076', 'pinjam'),
(24, 6, 33, 'P9', '2019-04-08', '1', '003', 'pinjam'),
(25, 4, 99, 'P10', '2019-04-08', '1', '082', 'pinjam'),
(26, 6, 99, 'P10', '2019-04-08', '1', '016', 'pinjam'),
(27, 2, 99, 'P10', '2019-04-08', '1', '065', 'pinjam'),
(28, 4, 50, 'P11', '2019-04-08', '1', '059', 'pinjam'),
(29, 2, 50, 'P11', '2019-04-08', '1', '079', 'pinjam'),
(30, 6, 50, 'P11', '2019-04-08', '1', '002', 'pinjam'),
(31, 4, 57, 'P12', '2019-04-08', '1', '058', 'pinjam'),
(32, 2, 57, 'P12', '2019-04-08', '1', '072', 'pinjam'),
(33, 6, 57, 'P12', '2019-04-08', '1', '009', 'pinjam'),
(34, 4, 76, 'P13', '2019-04-08', '1', '051', 'pinjam'),
(35, 2, 76, 'P13', '2019-04-08', '1', '077', 'pinjam'),
(36, 6, 76, 'P13', '2019-04-08', '1', '004', 'pinjam'),
(37, 4, 86, 'P14', '2019-04-08', '1', '061', 'pinjam'),
(38, 2, 86, 'P14', '2019-04-08', '1', '079', 'pinjam'),
(39, 6, 86, 'P14', '2019-04-08', '1', '014', 'pinjam'),
(40, 4, 143, 'P15', '2019-04-08', '1', '055', 'pinjam'),
(41, 2, 143, 'P15', '2019-04-08', '1', '086', 'pinjam'),
(42, 6, 143, 'P15', '2019-04-08', '1', '018', 'pinjam'),
(43, 4, 144, 'P16', '2019-04-08', '1', '084', 'pinjam'),
(44, 2, 144, 'P16', '2019-04-08', '1', '001', 'pinjam'),
(45, 6, 144, 'P16', '2019-04-08', '1', '057', 'pinjam'),
(46, 4, 161, 'P17', '2019-04-08', '1', '053', 'pinjam'),
(47, 2, 161, 'P17', '2019-04-08', '1', '076', 'pinjam'),
(48, 6, 161, 'P17', '2019-04-08', '1', '007', 'pinjam'),
(49, 6, 63, 'P18', '2019-04-25', '1', '060,062', 'kembali'),
(50, 2, 63, 'P18', '2019-04-25', '1', '078,080', 'kembali'),
(51, 4, 63, 'P18', '2019-04-25', '1', '011,012', 'kembali'),
(52, 6, 63, 'P19', '2019-04-25', '2', '060,062', 'pinjam'),
(53, 4, 63, 'P19', '2019-04-25', '2', '011,012', 'pinjam'),
(54, 2, 63, 'P19', '2019-04-25', '2', '078,080', 'pinjam'),
(55, 8, 159, 'P20', '2019-05-14', '1', '091', 'kembali');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengembalian`
--

CREATE TABLE `tb_pengembalian` (
  `id_kembali` int(11) NOT NULL,
  `id_pinjam` int(11) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `denda` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengembalian`
--

INSERT INTO `tb_pengembalian` (`id_kembali`, `id_pinjam`, `tgl`, `denda`) VALUES
(1, 1, '2019-03-28', 0),
(2, 2, '2019-04-06', 0),
(3, 10, '2019-04-23', 16000),
(4, 50, '2019-04-25', 0),
(5, 51, '2019-04-25', 0),
(6, 49, '2019-04-25', 0),
(7, 55, '2019-05-25', 8000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_ambil`
--

CREATE TABLE `tb_transaksi_ambil` (
  `id_ta` int(11) NOT NULL,
  `kd_transaksi` varchar(10) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `id_baju` int(11) DEFAULT NULL,
  `qty` varchar(10) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi_ambil`
--

INSERT INTO `tb_transaksi_ambil` (`id_ta`, `kd_transaksi`, `tgl`, `id_baju`, `qty`, `keterangan`) VALUES
(13, 'TA1', '2019-06-12', 6, '1', '-'),
(14, 'TA2', '2019-06-12', 10, '1', '-'),
(15, 'TA3', '2019-06-12', 22, '1', '-'),
(16, 'TA4', '2019-06-17', 19, '2', 'ANAK GUDANG KURANG DAPET BAJU SEWAKTU NAIK TRAINING'),
(17, 'TA5', '2019-06-27', 19, '8', 'naik training'),
(18, 'TA6', '2019-06-27', 21, '4', 'naik training'),
(21, 'TA9', '2019-06-27', 6, '1', 'naik training'),
(22, 'TA10', '2019-06-27', 9, '1', 'naik training'),
(23, 'TA10', '2019-06-27', 19, '1', 'naik training'),
(24, 'TA10', '2019-06-27', 16, '1', 'naik training'),
(25, 'TA10', '2019-06-27', 13, '1', 'naik training'),
(26, 'TA10', '2019-06-27', 7, '1', 'naik training'),
(27, 'TA10', '2019-06-27', 10, '1', 'naik training'),
(28, 'TA10', '2019-06-27', 16, '1', 'naik training'),
(29, 'TA10', '2019-06-27', 13, '1', 'naik training'),
(30, 'TA10', '2019-06-27', 7, '1', 'naik training'),
(31, 'TA10', '2019-06-27', 10, '1', 'naik training'),
(33, 'TA10', '2019-06-27', 14, '2', 'naik training'),
(34, 'TA10', '2019-06-27', 8, '2', 'naik training'),
(35, 'TA10', '2019-06-27', 11, '2', 'naik training'),
(37, 'TA10', '2019-06-27', 12, '1', 'naik training'),
(39, 'TA10', '2019-06-27', 9, '1', 'naik training'),
(40, 'TA10', '2019-06-27', 16, '1', 'naik training'),
(41, 'TA10', '2019-06-27', 13, '1', 'naik training'),
(42, 'TA10', '2019-06-27', 7, '1', 'naik training'),
(43, 'TA10', '2019-06-27', 10, '1', 'naik training'),
(45, 'TA10', '2019-06-27', 12, '1', 'naik training'),
(46, 'TA10', '2019-06-27', 7, '1', 'naik training'),
(47, 'TA10', '2019-06-27', 6, '1', 'naik training'),
(48, 'TA10', '2019-06-27', 9, '1', 'naik training'),
(49, 'TA10', '2019-06-27', 16, '1', 'naik training'),
(50, 'TA10', '2019-06-27', 13, '1', 'naik training'),
(51, 'TA10', '2019-06-27', 10, '1', 'naik training'),
(52, 'TA10', '2019-06-28', 19, '1', 'cw12'),
(59, 'TA8', '2019-07-04', 15, '1', 'naik training'),
(60, 'TA10', '2019-07-04', 9, '1', 'naik training'),
(61, 'TA10', '2019-07-04', 12, '1', 'naik training'),
(62, 'TA7', '2019-07-04', 12, '1', 'naik training'),
(63, 'TA10', '2019-07-04', 12, '1', 'naik training'),
(64, 'TA10', '2019-07-05', 15, '1', 'naik training'),
(65, 'TA10', '2019-07-05', 15, '1', 'naik training');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_tukar`
--

CREATE TABLE `tb_transaksi_tukar` (
  `id_tt` int(11) NOT NULL,
  `kd_transaksi` varchar(10) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `id_baju` int(11) DEFAULT NULL,
  `qty` varchar(10) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi_tukar`
--

INSERT INTO `tb_transaksi_tukar` (`id_tt`, `kd_transaksi`, `tgl`, `id_baju`, `qty`, `keterangan`) VALUES
(3, 'TT1', '2019-06-12', 6, '1', '-'),
(4, 'TT2', '2019-06-12', 8, '2', '-'),
(5, 'TT3', '2019-06-12', 7, '2', '-'),
(6, 'TT4', '2019-06-12', 9, '1', '-'),
(7, 'TT5', '2019-06-12', 13, '1', '-'),
(8, 'TT6', '2019-06-12', 14, '1', '-'),
(9, 'TT7', '2019-06-12', 16, '2', '-'),
(10, 'TT8', '2019-06-12', 17, '1', '-'),
(11, 'TT9', '2019-06-12', 18, '7', '-'),
(12, 'TT10', '2019-06-12', 19, '5', '-'),
(13, 'TT10', '2019-06-12', 20, '2', '-'),
(14, 'TT10', '2019-06-15', 21, '1', '-'),
(15, 'TT10', '2019-06-15', 17, '1', '-'),
(16, 'TT10', '2019-06-18', 13, '1', '-'),
(17, 'TT10', '2019-06-18', 10, '1', '-'),
(18, 'TT10', '2019-06-20', 11, '1', 'DARI UK L'),
(19, 'TT10', '2019-06-25', 12, '1', 'cw12'),
(20, 'TT10', '2019-06-27', 21, '1', '-'),
(21, 'TT10', '2019-06-28', 9, '1', 'cw12'),
(22, 'TT10', '2019-06-28', 16, '1', 'cw12'),
(23, 'TT10', '2019-07-01', 7, '1', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `stat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `pwd`, `stat`) VALUES
(1, 'PIPIK', 'pikbear', '96b05b756f7bff668d094acf4de387a97e875da9', 1),
(2, 'GA', 'GA', '034523520971f9c5df34e0d563d3093d30a284ce', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_baju`
--
ALTER TABLE `tb_baju`
  ADD PRIMARY KEY (`id_baju`);

--
-- Indexes for table `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `tb_hilang`
--
ALTER TABLE `tb_hilang`
  ADD PRIMARY KEY (`id_hilang`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indexes for table `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  ADD PRIMARY KEY (`id_kembali`);

--
-- Indexes for table `tb_transaksi_ambil`
--
ALTER TABLE `tb_transaksi_ambil`
  ADD PRIMARY KEY (`id_ta`);

--
-- Indexes for table `tb_transaksi_tukar`
--
ALTER TABLE `tb_transaksi_tukar`
  ADD PRIMARY KEY (`id_tt`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_baju`
--
ALTER TABLE `tb_baju`
  MODIFY `id_baju` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tb_hilang`
--
ALTER TABLE `tb_hilang`
  MODIFY `id_hilang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;
--
-- AUTO_INCREMENT for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  MODIFY `id_kembali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_transaksi_ambil`
--
ALTER TABLE `tb_transaksi_ambil`
  MODIFY `id_ta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `tb_transaksi_tukar`
--
ALTER TABLE `tb_transaksi_tukar`
  MODIFY `id_tt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
