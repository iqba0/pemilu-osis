-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 10 Mar 2024 pada 04.57
-- Versi server: 5.7.44-log
-- Versi PHP: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rplsmksumatra40m_osis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `vision` text NOT NULL,
  `mission` text NOT NULL,
  `motto` varchar(100) NOT NULL,
  `photo` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `vision`, `mission`, `motto`, `photo`) VALUES
(4, 'Azriel Christian Salomo Pelle', 'Mewujudkan OSIS sebagai suatu organisasi yang bisa membangun siswa yang bertanggung jawab dan beretika baik.', 'Menjadikan OSIS sebagai suatu organisasi yang bisa menjadikan tempat untuk menyuarakan aspirasi siswa dan memperbaiki kedisiplinan dengan patuh pada peraturan yang berlaku.', 'Kesuksesan hanya didapat oleh mereka yang beraniÂ danÂ bertindak.', 'Azriel Christian Salomo Pelle1.jpg'),
(5, 'Devan Raksadipa Adiana', 'Menjadikan organisasi intra sekolah yang bergerak secara dinamis dan koperatif dalam menjalankan tugas dan fungsi pengurus OSIS sehingga dapat membentuk kesinergian antara komponen OSIS di SMK Sumatra 40 Bandung.', 'Mengutamakan ketuhanan yang maha Esa menciptakan lapangan kerja yang nyaman dan komunikatif dan berkoordinasi dengan sesama komponen OSIS di SMK Sumatra 40 Bandung. Menjalankan program kerja atau kegiatan dengan adaptif, kolabotatif, dan inovatif.', 'Kesuksesan tidak akan bertahan jika dicapai denganÂ jalanÂ pintas.', 'Devan Raksadipa Adiana.jpg'),
(6, 'Hassya Nadindra Lesmana', 'Menumbuhkan sikap tanggung jawab kepada siswa siswi SMK Sumatra 40 yang berdasarkan ketuhanan yang maha Esa, dan menjunjung tinggi sikap toleransi dan kebersamaan. Lalu menjadikan OSIS organisasi yang aktif dan menjadi tempat para siswa menyalurkan pendapatnya.', 'Mengadakan acara keagamaan, membuat satu wadah para siswa untuk menyampaikan pendapatnya, menciptakan lingkungan yang bertoleransi dan saling menghargai.', 'Tidak ada yang bisa membuat Anda rendah diri tanpa persetujuanÂ anda.', 'Hassya Nadindra Lesmana.jpg'),
(7, 'Tenissya Dheta Rosalia', 'Membentuk sikap dan kepribadian siswa siswi SMK Sumatra 40 yang peduli, inisiatif, nasionalis, terampil, amanah, dan berjiwa kepemimpinan.', 'Mengaktifkan serta meningkatkan kinerja organisasi dan ekstrakurikuler serta kepengurusannya, menjalin hubungan harmonis antar warga sekolah, meningkatkan kreativitas siswa, dinamis dan bertakwa, menanamkan budaya 5S (senyum,salam,sapa,sopan, dan santun).', 'Jangan takut & ragu untuk gagal karena kegagalan kita menjadi kuat dan tangguh.', 'Tenissya Dheta Rosalia.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `password`, `role`) VALUES
(1, 'admin', 'adm', '123123', 'admin'),
(8, 'Ghani Khairulloh', 'Ghani', '123', 'user'),
(9, 'Jihan Jenita', 'Jihan', '123', 'user'),
(10, 'Marcel Julian Saputra', 'Marcel', '123', 'user'),
(11, 'Mika Raivata Sofyan', 'Mika', '123', 'user'),
(12, 'Mochamad Ridwan Anwar', 'Ridwan', '123', 'user'),
(13, 'Moreno Triko Aziz', 'Moreno', '123', 'user'),
(14, 'Muhamad Daffa Apta Pratama', 'Daffa', '123', 'user'),
(15, 'Muhamad Rendie Firmansyah', 'Rendie', '123', 'user'),
(16, 'Muhammad Arifin Ihsan', 'Arifin', '123', 'user'),
(17, 'Muhammad Dypha Maulana', 'Dypha', '123', 'user'),
(18, 'Muhammad Rizky F. N', 'Rizky', '123', 'user'),
(19, 'Rafly Andika', 'Rafly', '123', 'user'),
(20, 'Revalina Maharani Ambia', 'Revalina', '123', 'user'),
(21, 'Rizki Maulana Hakim', 'Rizki', '123', 'user'),
(22, 'Rizky Zakariyya Hermanda', 'Rizky', '123', 'user'),
(23, 'Salma Azka Zahira', 'Salma', '123', 'user'),
(24, 'Aderesta Chelseana Aprilia', 'Aderesta', '123', 'user'),
(25, 'Ayu Tri Hartanti Kusnadi', 'Ayu', '123', 'user'),
(26, 'Bilqis Zahra Aziziyyah', 'Bilqis', '123', 'user'),
(28, 'Dwi Assyifa', 'Dwi', '123', 'user'),
(29, 'Friska Alzahra Zalianti', 'Friska', '123', 'user'),
(30, 'Naila Octavia Ramadhani', 'Naila', '123', 'user'),
(31, 'Natali Angelica Rahayu D', 'Natali', '123', 'user'),
(32, 'Nuna Salsabil Zalfaa', 'Nuna', '123', 'user'),
(33, 'Regina Aulia Rahayu', 'Regina', '123', 'user'),
(34, 'Salma Fauziyyah Firdaus', 'Salma', '123', 'user'),
(35, 'Saskia Nur Bella', 'Saskia', '123', 'user'),
(36, 'Sherly Anditya', 'Sherly', '123', 'user'),
(37, 'Tias Rizaldi', 'Tias', '123', 'user'),
(38, 'Adella Salwa Salsabila', 'Adella', '123', 'user'),
(40, 'Anggi Nugraha', 'Anggi ', '123', 'user'),
(41, 'Azriel Christian Salomo Pelle', 'Azriel', '123', 'user'),
(42, 'Badai Poetra Anugerah', 'Badai ', '123', 'user'),
(43, 'Dimas Rajbani Bagus Tiansyah', 'Dimas', '123', 'user'),
(44, 'Fadlika Lalinsya Putra', 'Fadlika', '123', 'user'),
(45, 'Gestian Falsha Dwiyana P', 'Gestian', '123', 'user'),
(46, 'Hassya Nadindra Lesmana', 'Hassya', '123', 'user'),
(47, 'Ilham Pratama Putra', 'Ilham', '123', 'user'),
(48, 'Ilhan Muhamad Rizky', 'Ilhan', '123', 'user'),
(49, 'Kelvin Putra Pradika', 'Kelvin', '123', 'user'),
(50, 'Maikel Jordan Samuel T', 'Maikel', '123', 'user'),
(51, 'Melisa Gustiani', 'Melisa ', '123', 'user'),
(52, 'Mochamad Rify Dermawan', 'Rify', '123', 'user'),
(53, 'Muhamad Aditiya Jayusman', 'Aditiya', '123', 'user'),
(54, 'Muhamad Syamil', 'Syamil', '123', 'user'),
(55, 'Nicolas Candra Adi Witono', 'Nicolas', '123', 'user'),
(56, 'Raya Galang Basae', 'Raya', '123', 'user'),
(57, 'Razka Putra Hendrata', 'Razka', '123', 'user'),
(58, 'Rijki Muhamad', 'Rijki', '123', 'user'),
(59, 'Ruben Andria', 'RubenAndria', '123', 'user'),
(60, 'Tania Risqia Zalva', 'Tania', '123', 'user'),
(61, 'Tobias Elbert Nevan Tarigan', 'Tobias', '123', 'user'),
(62, 'Yosep Fernandes Tri Setiawan', 'Yosep', '123', 'user'),
(63, 'Yosi Nuraisyah', 'Yosi', '123', 'user'),
(64, 'Zein Assegaf Arianto', 'Zein', '123', 'user'),
(65, 'Alika Raya Rizkina', 'Alika', '123', 'user'),
(66, 'Alzalia Alarthur Darussalam', 'Alzalia', '123', 'user'),
(67, 'Angelina Dinda Dwi Purwanti', 'Angelina', '123', 'user'),
(68, 'Ara Sabila', 'Ara', '123', 'user'),
(69, 'Bening Kasih Jelita', 'Bening', '123', 'user'),
(70, 'Filia Rahmawati', 'Filia ', '123', 'user'),
(71, 'Hana Novelia Charlie', 'Hana ', '123', 'user'),
(72, 'Jalianti Nabila P', 'Jalianti ', '123', 'user'),
(73, 'Keisa Zahra Umaya', 'Keisa', '123', 'user'),
(74, 'Lanny Febriyanti', 'Lanny', '123', 'user'),
(75, 'Lingga Anggi Gustiara', 'Lingga ', '123', 'user'),
(76, 'Maulwy Rasdi Sherali', 'Maulwy', '123', 'user'),
(77, 'Salsabila Karima Zahra', 'Salsabila', '123', 'user'),
(78, 'Salwa Nabila Syahia', 'Salwa ', '123', 'user'),
(79, 'Shifa Aulia', 'Shifa ', '123', 'user'),
(80, 'Syifa Pebriana Putri', 'Syifa ', '123', 'user'),
(81, 'Tiara Pratiwi', 'Tiara', '123', 'user'),
(82, 'Visty Auliya Setiawan', 'Visty', '123', 'user'),
(83, 'Algis Saputra Sulaeman', 'Algis ', '123', 'user'),
(85, 'Arsila Villa Rosyada', 'Arsila ', '123', 'user'),
(86, 'Bintang Adi Putra', 'Bintang ', '123', 'user'),
(87, 'Dafa Apriliani Putri', 'Dafa ', '123', 'user'),
(88, 'Deril Lintang Apriliawan', 'Deril ', '123', 'user'),
(89, 'Devan Raksadipa Adiana', 'Devan ', '123', 'user'),
(90, 'Farrel Febrian Pratama', 'Farrel ', '123', 'user'),
(91, 'Helmi Adhiansyah Ramdhani', 'Helmi ', '123', 'user'),
(92, 'Kasdila Nandan Saputra', 'Kasdila ', '123', 'user'),
(93, 'Muhamad Fauzan Rasya F', 'Fauzan', '123', 'user'),
(94, 'Muhammad Abdul Rojak', 'Abdul ', '123', 'user'),
(95, 'Nabil Ramdani', 'Nabil', '123', 'user'),
(96, 'Novi Anggraeni', 'Novi ', '123', 'user'),
(97, 'Radella Febriyani', 'Radella ', '123', 'user'),
(98, 'Rafi Firdaus', 'Rafi ', '123', 'user'),
(99, 'Rahmat Kurniawan', 'Rahmat', '123', 'user'),
(100, 'Raka Nadiv Riandi', 'Raka ', '123', 'user'),
(101, 'Renjiro Iswantoro', 'Renjiro', '123', 'user'),
(102, 'Rey Janvilian Firmansyah', 'Rey ', '123', 'user'),
(103, 'Riska Aulia Ramadhani', 'Riska', '123', 'user'),
(104, 'Ruben Wilbert Agustinus H', 'Ruben', '123', 'user'),
(105, 'Sony Fathurachman Abdullah', 'Sony', '123', 'user'),
(106, 'Surya Fajar Loka', 'Surya ', '123', 'user'),
(107, 'Tenissya Dheta Rosalia', 'Tenissya ', '123', 'user'),
(108, 'Willi Epiphanias Sinaga', 'Willi ', '123', 'user'),
(109, 'Almira Shakila Fitalaiqa Zahara', 'Almira', '123', 'user'),
(110, 'Annisya Nur Vadilla', 'Annisya ', '123', 'user'),
(111, 'Arimbi Kayla Ramayadi', 'Arimbi ', '123', 'user'),
(112, 'Irtifa Aura Asari Putri', 'Irtifa ', '123', 'user'),
(113, 'Joan Fatima Hendrianto', 'Joan ', '123', 'user'),
(114, 'Keyla Putri Darmansyah', 'Keyla', '123', 'user'),
(115, 'Marcella Zalyanti Siburian', 'Marcella', '123', 'user'),
(116, 'Marisha Herdiani Faudzi', 'Marisha ', '123', 'user'),
(117, 'Meisha Putri Hamdani', 'Meisha', '123', 'user'),
(118, 'Meyla Aulia', 'Meyla ', '123', 'user'),
(119, 'Natasya Chantika Khoirunnisa', 'Natasya ', '123', 'user'),
(120, 'Naura Adlia Putri', 'Naura ', '123', 'user'),
(121, 'Nazwa Salva Avishya', 'Nazwa', '123', 'user'),
(123, 'Yesica Simbolon', 'Yesica ', '123', 'user'),
(130, 'Diah Lestari, S.Pd', 'Diah', '123', 'user'),
(131, 'Frans Ngadilan, S.Ag', 'Frans', '123', 'user'),
(132, 'Alex Irawan, S.Si. T.', 'Alex ', '123', 'user'),
(133, 'Joliasih Swiwuryo, S.Pd', 'Joliasih', '123', 'user'),
(134, 'Dra. Esti Saptarini, S.Kom, MM', ' Esti ', '123', 'user'),
(135, 'Dra Agustina Dwi Susanti, S.Pd', 'Agustina ', '123', 'user'),
(136, 'Muhammad Fauzi, S.Pd', 'Fauzi', '123', 'user'),
(137, 'Resti Rosita, S.Pd', 'Resti ', '123', 'user'),
(138, 'Ardi Zohar Asiqin, S.Pd', 'Ardi', '123', 'user'),
(139, 'Aprian Sauri Ramadan, S.Pd', 'Aprian', '123', 'user'),
(140, 'Alfy Rizqy Rahmat F, S.Hum', 'Alfy ', '123', 'user'),
(141, 'Nanik Rahmani, S.Pd', 'Nanik ', '123', 'user'),
(142, 'Riyadi, S.Kom', 'Riyadi', '123', 'user'),
(143, 'Wati Cintawati, S.Pd', 'Cintawati', '123', 'user'),
(144, 'Dwini Agustyn, S. Pd. ', 'Dwini ', '123', 'user'),
(145, 'M. Iqbal Nursyahid Saroni, ST', 'Iqbal ', '123', 'user'),
(146, 'Tiwan Tapiyana, S.Kom, M.Ko', 'Tiwan', '123', 'user'),
(147, 'Dra. Suwartini', 'Tini', '123', 'user'),
(148, 'Dian Sundari, S.Pd', 'Dian', '123', 'user'),
(149, 'Yudi Kurniadi, S. Kom', 'Yudi ', '123', 'user'),
(150, 'Putri Annisa Nurhannah, S. Psi', 'Putri', '123', 'user'),
(151, 'Yuliawati, A.Md', 'Yulia', '123', 'user'),
(152, 'Yuni Siti Wahyuni', 'Yuni ', '123', 'user'),
(153, 'Agung Priyo Sambodo', 'Djarot', '123', 'user'),
(154, 'Trubus Widyaka, S.T', 'Trubus', '123', 'user'),
(155, 'Suprayogi Wibowo', 'Yogi', '123', 'user'),
(156, 'Ajang Sanusi', 'Ajang', '123', 'user'),
(157, 'Syarifudin', 'Didin', '123', 'user'),
(158, 'Randy Agung', 'Randy', '123', 'user'),
(160, 'Fauzan Syabani Dayat', 'FauzanSyabani', '123', 'user'),
(165, 'Andika Satya Kurniawan', 'Andika', '123', 'user'),
(166, 'Andika Satya Kurniawan', 'Andika', '123', 'user'),
(167, 'Fikri Rizky Herdiansyah', 'Fikri', '123', 'user'),
(168, 'Galang Ramadhan', 'Galang', '123', 'user'),
(169, 'Rina Purwati', 'Rina', '123', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voter_id` int(11) DEFAULT NULL,
  `candidate_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `votes`
--

INSERT INTO `votes` (`id`, `voter_id`, `candidate_id`) VALUES
(3, 10, 6),
(4, 14, 6),
(5, 31, 6),
(6, 15, 6),
(7, 32, 6),
(8, 53, 6),
(9, 104, 6),
(10, 93, 6),
(11, 112, 6),
(12, 18, 6),
(13, 101, 6),
(14, 113, 6),
(15, 123, 6),
(16, 12, 7),
(17, 109, 6),
(18, 121, 4),
(19, 67, 6),
(20, 65, 6),
(21, 11, 6),
(22, 37, 6),
(23, 8, 6),
(24, 19, 6),
(25, 165, 6),
(26, 91, 6),
(27, 23, 6),
(28, 24, 4),
(29, 33, 7),
(30, 20, 5),
(31, 36, 6),
(32, 17, 5),
(33, 25, 6),
(34, 52, 6),
(35, 29, 6),
(36, 104, 6),
(37, 9, 6),
(38, 97, 6),
(39, 102, 5),
(40, 97, 6),
(41, 45, 6),
(42, 85, 5),
(43, 94, 6),
(44, 88, 5),
(45, 93, 4),
(46, 154, 4),
(47, 96, 6),
(48, 87, 7),
(49, 167, 4),
(50, 105, 6),
(51, 108, 4),
(52, 106, 4),
(53, 99, 5),
(54, 169, 4),
(55, 120, 6),
(56, 92, 5),
(57, 153, 6),
(58, 144, 5),
(59, 92, 5),
(60, 110, 6),
(61, 117, 6),
(62, 111, 6),
(63, 62, 6),
(64, 118, 6),
(65, 143, 4),
(66, 141, 4),
(67, 151, 5),
(68, 133, 4),
(69, 140, 7),
(70, 83, 6),
(71, 42, 6),
(72, 60, 6),
(73, 58, 6),
(74, 56, 6),
(75, 38, 6),
(76, 80, 6),
(77, 66, 6),
(78, 13, 6),
(79, 82, 6),
(80, 69, 6),
(81, 68, 4),
(82, 79, 6),
(83, 43, 4),
(84, 77, 6),
(85, 74, 6),
(86, 71, 6),
(87, 55, 6),
(88, 48, 6),
(89, 95, 6),
(90, 73, 4),
(91, 103, 6),
(92, 64, 4),
(93, 50, 4),
(94, 44, 4),
(95, 57, 6),
(96, 78, 6),
(97, 72, 6),
(98, 23, 6),
(99, 28, 6),
(100, 150, 4),
(101, 130, 4),
(102, 51, 6),
(103, 63, 6),
(104, 131, 7),
(105, 26, 6),
(106, 152, 5),
(107, 115, 6),
(108, 136, 7),
(109, 35, 6),
(110, 142, 6),
(111, 104, 6),
(112, 16, 5),
(113, 70, 4),
(114, 137, 4),
(115, 138, 4),
(116, 135, 6);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voter_id` (`voter_id`),
  ADD KEY `candidate_id` (`candidate_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT untuk tabel `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`voter_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
