-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jul 2022 pada 13.45
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_learning_sd`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_admin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`, `nama_admin`) VALUES
(1, 'tes', '1234', 'Admin Rifqi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_kelas`
--

CREATE TABLE `tb_detail_kelas` (
  `id_detail_kelas` int(10) NOT NULL,
  `id_kelas` int(10) NOT NULL,
  `id_guru` int(10) DEFAULT NULL,
  `id_mapel` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_detail_kelas`
--

INSERT INTO `tb_detail_kelas` (`id_detail_kelas`, `id_kelas`, `id_guru`, `id_mapel`) VALUES
(6, 10, 4, NULL),
(7, 11, 1, NULL),
(32, 12, 4, NULL),
(50, 9, 1, 2),
(56, 1, 1, 2),
(59, 1, 1, 1),
(60, 12, 4, 2),
(61, 12, 5, 4),
(62, 1, 4, 4),
(63, 12, NULL, 1),
(64, 13, 5, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_kuis`
--

CREATE TABLE `tb_detail_kuis` (
  `id_detail_kuis` int(11) NOT NULL,
  `id_kuis` int(11) NOT NULL,
  `soal_kuis` varchar(125) NOT NULL,
  `jawaban1` varchar(125) NOT NULL,
  `jawaban2` varchar(125) NOT NULL,
  `jawaban3` varchar(125) NOT NULL,
  `kunci_jawaban` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_detail_kuis`
--

INSERT INTO `tb_detail_kuis` (`id_detail_kuis`, `id_kuis`, `soal_kuis`, `jawaban1`, `jawaban2`, `jawaban3`, `kunci_jawaban`) VALUES
(1, 1, 'rukun islam ada ….', '4', '5', '6', 'b'),
(2, 1, 'Mengimani malaikat Allah hukumnya . . . bagi umat islam', 'wajib', 'makruh', 'sunah', 'a'),
(3, 1, 'Makhluk Allah yang tidak diberi hawa nafsu namun selalu ta’at kepada perintah Allah adalah ..', 'manusia', 'syaitan', 'malaikat', 'c'),
(5, 3, 'Membuang sampah sebaiknya di', '2', 'Halaman', 'Tempatnya', 'a'),
(6, 3, 'Membuang sampah sebaiknya di', 'asda', 'dddsa', 'asdas', 'a'),
(8, 4, 'antonim dari luar', 'masuk', 'pergi', 'dalam', 'c');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int(10) NOT NULL,
  `nip` varchar(128) NOT NULL,
  `nama_guru` varchar(125) NOT NULL,
  `pass` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nip`, `nama_guru`, `pass`) VALUES
(1, '20180803091', 'Rifqi', '1234'),
(4, '20180801103', 'ARYA', 'LGBWD'),
(5, '20001204', 'Irul', '1234');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(10) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `id_guru` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `kelas`, `id_guru`) VALUES
(1, '4B', 4),
(9, '5C', 1),
(12, '6CD', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kuis`
--

CREATE TABLE `tb_kuis` (
  `id_kuis` int(11) NOT NULL,
  `judul` varchar(125) NOT NULL,
  `id_materi` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kuis`
--

INSERT INTO `tb_kuis` (`id_kuis`, `judul`, `id_materi`) VALUES
(1, 'Kuis Sholawat', 5),
(3, 'Kuis Rukun Iman', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `id_mapel` int(10) NOT NULL,
  `mata_pelajaran` varchar(255) NOT NULL,
  `tipe_mapel` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_mapel`
--

INSERT INTO `tb_mapel` (`id_mapel`, `mata_pelajaran`, `tipe_mapel`) VALUES
(1, 'Bahasa Indonesia', 1),
(2, 'Agama Islam', 2),
(4, 'Bahasa Inggris', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_materi`
--

CREATE TABLE `tb_materi` (
  `id_materi` int(10) NOT NULL,
  `judul_materi` varchar(255) NOT NULL,
  `isi_materi` text NOT NULL,
  `link_video` varchar(255) NOT NULL,
  `file_uploads` varchar(255) NOT NULL,
  `id_detail_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_materi`
--

INSERT INTO `tb_materi` (`id_materi`, `judul_materi`, `isi_materi`, `link_video`, `file_uploads`, `id_detail_kelas`) VALUES
(3, 'Reproduksi', '<ol>\r\n	<li>pertemuan antara sel telur</li>\r\n	<li>asdasd</li>\r\n	<li>asdas</li>\r\n	<li>dadsa</li>\r\n	<li>da</li>\r\n</ol>\r\n', 'kIiT2aYjCKo', 'Akun Penting.txt', 51),
(5, 'Sholawat', '<p>Sholawat membuat hati sangat tenang sekali dan menambah pahala</p>\r\n', 'sCLug8IVzTk', 'kkhig.txt', 56),
(6, 'Asmaul Husna', 'ada 99 Asmaul Husna', 't_TB1PxkVU0', 'Surat pengantar_1.jpg', 56),
(7, 'asdasd', 'fnfbnf fhjfjf jfjfjfbnf n', '', 'Akun Penting_1.txt', 51),
(8, 'Asmaul Husna', 'asdljhas 1. asdasda 2. askdjasda 3. askdgasa', '', '', 51),
(9, 'Rukun Iman', 'asdljhas\r\n1. asdasda\r\n2. askdjasda\r\n3. askdgasa', 'dp9MHiI6d2g', 'kop (1).docx', 53),
(12, 'Peribahasa', '<p>Contoh peribahasa :&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Bagai air di daun talas</li>\r\n	<li>Serigala berbulu domba</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n', 'ApoKPVaCM_U', '5092-14990-2-PB.pdf', 59),
(13, 'Tes', '<p>asdas</p>\r\n', 'asad', '', 50),
(14, 'Antonim', '<p>Contoh Lawan kata :</p>\r\n\r\n<ol>\r\n	<li>Baik --&gt; Buruk</li>\r\n</ol>\r\n', 'eWZ8cZM32n8', 'Flowchart_Sistem_berjalan.drawio.png', 59);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nilai_kuis`
--

CREATE TABLE `tb_nilai_kuis` (
  `id_nilai_kuis` int(10) NOT NULL,
  `id_siswa` int(10) NOT NULL,
  `id_kuis` int(10) NOT NULL,
  `jumlah_benar` int(5) NOT NULL,
  `jumlah_salah` int(5) NOT NULL,
  `nilai` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_nilai_kuis`
--

INSERT INTO `tb_nilai_kuis` (`id_nilai_kuis`, `id_siswa`, `id_kuis`, `jumlah_benar`, `jumlah_salah`, `nilai`) VALUES
(3, 9, 1, 3, 0, 100),
(4, 10, 1, 2, 1, 66),
(5, 9, 3, 0, 2, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(10) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama_siswa` varchar(125) NOT NULL,
  `tempat_lahir_siswa` varchar(125) NOT NULL,
  `tanggal_lahir_siswa` varchar(125) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `jk` varchar(30) NOT NULL,
  `no_telp` varchar(30) NOT NULL,
  `id_kelas` int(10) NOT NULL,
  `pass` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nis`, `nama_siswa`, `tempat_lahir_siswa`, `tanggal_lahir_siswa`, `agama`, `jk`, `no_telp`, `id_kelas`, `pass`) VALUES
(9, '1234', 'Rifqi D', 'Wonogiri', '2022-01-08', 'Islam', 'L', '81285400663', 1, '1234'),
(10, '243242', 'Khoirul', 'Jakarta', '2009-04-05', 'Islam', 'L', '85780560899', 1, 'MWS9L'),
(11, '54678', 'Ardiyan', 'Jakarta', '2022-07-12', 'Islam', 'L', '81381430442', 1, 'GJL71');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tugas`
--

CREATE TABLE `tb_tugas` (
  `id_tugas` int(10) NOT NULL,
  `judul_tugas` varchar(255) NOT NULL,
  `isi_tugas` text NOT NULL,
  `file_tugas` varchar(255) NOT NULL,
  `tanggal_buat` date NOT NULL,
  `tanggal_kumpul` date NOT NULL,
  `id_materi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_tugas`
--

INSERT INTO `tb_tugas` (`id_tugas`, `judul_tugas`, `isi_tugas`, `file_tugas`, `tanggal_buat`, `tanggal_kumpul`, `id_materi`) VALUES
(8, 'Tugas 1 Agama Islam', '<p>asdasdasad</p>\r\n', 'UTS-IMK Jumat_1.pdf', '2006-06-22', '2022-06-30', 6),
(9, 'Tugas 1 Agama Islam', '<p><strong>1. Berikan contoh sikap jujur yang kamu ketahui!</strong></p>\r\n\r\n<p><em>Jawaban :</em></p>\r\n\r\n<p><em>Mau mengakui kesalahan jika berbuat salah dan senantiasa mengatakan hal yang sebenarnya kepada orang lain.</em></p>\r\n\r\n<p><strong>2. Bagaimana bersikap Amanah itu? Jelaskan pendapatmu!</strong></p>\r\n\r\n<p><em>Jawaban :</em></p>\r\n\r\n<p><em>Amanah pada dasarnya merupakan sebuah perbuatan berupa&nbsp;<a href=\"https://portalpekalongan.pikiran-rakyat.com/tag/sifat\">sifat</a>&nbsp;jujur dan dapat dipercaya oleh orang lain. Contoh&nbsp;<a href=\"https://portalpekalongan.pikiran-rakyat.com/tag/sifat\">sifat</a>&nbsp;Amanah adalah, menyampaikan sesuatu yang dititipkan oleh orang lain.</em></p>\r\n', 'contoh tugas.png', '2009-06-22', '2022-06-07', 5),
(12, 'Rukun Islam', '<p>rukun islam ada &hellip;.</p>\r\n\r\n<ol>\r\n	<li>empat</li>\r\n	<li>lima</li>\r\n	<li>enam</li>\r\n</ol>\r\n', '', '2012-06-22', '2022-06-12', 5),
(44, 'Contoh Peribahasa', '<p>Sebutkan 5 peribahasa beserta dengan artinya</p>\r\n', '', '2015-07-22', '2022-07-20', 12),
(45, 'Tugas 1 Agama Islam', '', '', '2015-07-22', '1969-12-31', 5),
(51, 'Tugas 1 Agama Islam', '', '', '2015-07-22', '1969-12-31', 13),
(52, 'Tugas 1 Agama Islam', '', '', '2015-07-22', '1969-12-31', 13),
(53, 'Tugas 1 Agama Islam', '', '', '2015-07-22', '1969-12-31', 13),
(54, 'Tulis 5 contoh antonim', '<p>Tulis 5 contoh antonim :</p>\r\n\r\n<p>1.</p>\r\n\r\n<p>2.</p>\r\n\r\n<p>3.</p>\r\n', 'Flowchart_Sistem_berjalan.png', '2016-07-22', '2022-07-22', 14),
(55, 'Tugas 1 Agama Islam', '<p>adsada</p>\r\n', '', '2016-07-22', '1969-12-31', 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tugas_siswa`
--

CREATE TABLE `tb_tugas_siswa` (
  `id_tugas_siswa` int(11) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `isi_tugas_siswa` varchar(255) NOT NULL,
  `file_tugas_siswa` varchar(255) NOT NULL,
  `tanggal_kumpul_siswa` date NOT NULL,
  `nilai_tugas_siswa` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_tugas_siswa`
--

INSERT INTO `tb_tugas_siswa` (`id_tugas_siswa`, `id_tugas`, `id_siswa`, `isi_tugas_siswa`, `file_tugas_siswa`, `tanggal_kumpul_siswa`, `nilai_tugas_siswa`) VALUES
(2, 9, 10, '', 'arab-man-avatar-isolated-faceless-male-cartoon-vector-21453396.jpg', '0000-00-00', 90),
(3, 9, 9, '<p><em>Jawaban :</em></p>\r\n\r\n<p><em>Mau mengakui kesalahan jika berbuat salah dan senantiasa mengatakan hal yang sebenarnya kepada orang lain.</em></p>\r\n\r\n<p><strong>2. Bagaimana bersikap Amanah itu? Jelaskan pendapatmu!</strong></p>\r\n\r\n<p><em>Jawaban :</', 'SILOAM_1.jpeg', '2022-06-11', 90),
(4, 12, 9, '<p>asdadasbdhjasdhjasdbhjasdasdhasdsdasd</p>\r\n\r\n<p>asd`1</p>\r\n\r\n<ol>\r\n	<li>asdadadad</li>\r\n	<li>asdadas</li>\r\n	<li>dasda</li>\r\n	<li>dsad</li>\r\n	<li>ads</li>\r\n</ol>\r\n', 'IMG_20220217_210440.jpg', '2022-06-12', 78),
(5, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(6, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(7, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(8, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(9, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(10, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(11, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(12, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(13, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(14, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(15, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(16, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(17, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(18, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(19, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(20, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(21, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(22, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(23, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(24, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(25, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(26, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(27, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(28, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(29, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(30, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(31, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(32, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(33, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(34, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(35, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(36, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(37, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(38, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(39, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(40, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(41, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(42, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(43, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(44, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(45, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(46, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(47, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(48, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(49, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(50, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(51, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(52, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(53, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(54, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(55, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(56, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0),
(57, 9, 10, '<p>Tes Tugas</p>', '', '0000-00-00', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_detail_kelas`
--
ALTER TABLE `tb_detail_kelas`
  ADD PRIMARY KEY (`id_detail_kelas`);

--
-- Indeks untuk tabel `tb_detail_kuis`
--
ALTER TABLE `tb_detail_kuis`
  ADD PRIMARY KEY (`id_detail_kuis`);

--
-- Indeks untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `tb_kuis`
--
ALTER TABLE `tb_kuis`
  ADD PRIMARY KEY (`id_kuis`);

--
-- Indeks untuk tabel `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indeks untuk tabel `tb_materi`
--
ALTER TABLE `tb_materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indeks untuk tabel `tb_nilai_kuis`
--
ALTER TABLE `tb_nilai_kuis`
  ADD PRIMARY KEY (`id_nilai_kuis`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `tb_tugas`
--
ALTER TABLE `tb_tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indeks untuk tabel `tb_tugas_siswa`
--
ALTER TABLE `tb_tugas_siswa`
  ADD PRIMARY KEY (`id_tugas_siswa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_detail_kelas`
--
ALTER TABLE `tb_detail_kelas`
  MODIFY `id_detail_kelas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `tb_detail_kuis`
--
ALTER TABLE `tb_detail_kuis`
  MODIFY `id_detail_kuis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_kuis`
--
ALTER TABLE `tb_kuis`
  MODIFY `id_kuis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_mapel`
--
ALTER TABLE `tb_mapel`
  MODIFY `id_mapel` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_materi`
--
ALTER TABLE `tb_materi`
  MODIFY `id_materi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_nilai_kuis`
--
ALTER TABLE `tb_nilai_kuis`
  MODIFY `id_nilai_kuis` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_tugas`
--
ALTER TABLE `tb_tugas`
  MODIFY `id_tugas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `tb_tugas_siswa`
--
ALTER TABLE `tb_tugas_siswa`
  MODIFY `id_tugas_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
