-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2026 at 04:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_manhwa`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(11) NOT NULL,
  `manhwa_id` int(11) NOT NULL,
  `nomor_chapter` int(11) NOT NULL,
  `judul_chapter` varchar(255) NOT NULL,
  `konten_gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `manhwa_id`, `nomor_chapter`, `judul_chapter`, `konten_gambar`) VALUES
(4, 7, 1, 'Mr Kim', 'manager_kim_ch1_1.jpg'),
(5, 7, 2, 'Pahlawan perang', 'ch1_1.jpg, ch1_2.jpg'),
(6, 8, 1, 'Park Jonggun', 'jonggun.jpg, park jonggun.jpg'),
(7, 6, 1, 'Seong Taehoon', 'chp 1.jpg, chp 2.jpg'),
(8, 5, 1, 'Peter Farming Aura', 'peter 1.jpg, peter 2.jpg'),
(9, 4, 1, 'Na Hwajin', 'na hwajin 1.jpg, na hwajin 2.jpg'),
(10, 2, 1, 'Shadow Monarch', 'jinwo 1.jpg, jinwo 2.jpg'),
(11, 3, 1, 'Sabbath', 'wb 1.jpg, wb 2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `manhwa`
--

CREATE TABLE `manhwa` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `sinopsis` text NOT NULL,
  `cover` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manhwa`
--

INSERT INTO `manhwa` (`id`, `judul`, `genre`, `sinopsis`, `cover`, `status`) VALUES
(2, 'Solo Leveling', 'Drama, Fantasi, Tindakan, Shounen, Petualangan, Kekuatan Super', 'Manhwa Solo Leveling yang dibuat oleh komikus bernama Chugong 추공 ini bercerita tentang 10 tahun yang lalu, setelah \"Gerbang\" yang menghubungkan dunia nyata dengan dunia monster terbuka, beberapa orang biasa, setiap hari menerima kekuatan untuk berburu monster di dalam Gerbang. Mereka dikenal sebagai \"Pemburu\". Namun, tidak semua Pemburu kuat. Nama saya Sung Jin-Woo, seorang Pemburu peringkat-E. Saya seseorang yang harus mempertaruhkan nyawanya di ruang bawah tanah paling rendah, \"Terlemah di Dunia\". Tidak memiliki keterampilan apa pun untuk ditampilkan, saya hampir tidak mendapatkan uang yang dibutuhkan dengan pertarungan di ruang bawah tanah berlevel rendah… setidaknya sampai saya menemukan ruang bawah tanah tersembunyi dengan kesulitan tersulit dalam ruang bawah tanah peringkat-D! Pada akhirnya, saat aku menerima kematian, tiba-tiba aku menerima kekuatan aneh, log pencarian yang hanya bisa kulihat, rahasia untuk naik level yang hanya aku yang tahu! Jika saya berlatih sesuai dengan pencarian saya dan monster yang diburu, level saya akan naik. Berubah dari Hunter terlemah menjadi Hunter S-rank terkuat! Baca Solo Leveling Ragnarok di sini', 'solo_leveling.jpg', 'Tamat'),
(3, 'Wind Breaker', 'Drama, Tindakan, Shounen, Olahraga', 'Jay adalah murid yang sempurna. Dia mendapat nilai A dan dia adalah ketua organisasi mahasiswa. Tapi setelah dipaksa untuk bergabung dengan tim bersepeda sekolah, Kru Hummingbird, ia menemukan dunia baru di luar belajar. Petualangan apa baru yang akan dia hadapi di luar kenyamanan buku pelajarannya?', 'wind_breaker.jpg', 'Ongoing'),
(4, 'The Real Leason', 'Aksi, Tinju, Perundungan', 'Setelah undang-undang larangan memukul para siswa disahkan, semakin banyak siswa yang seperti preman.\r\nSuatu hari, seorang laki-laki yang kuat muncul dan menghajar para preman sekolah tersebut.\r\n\r\nSebenarnya siapa laki-laki itu...?!', 'the_real_leason.jpg', 'Ongoing'),
(5, 'Killer Peter', 'Drama, Bertarung, Assassin', 'Killer legendaris bernama Peter yang kini sudah tua dan sakit-sakitan diincar mati-matian! Setelah tertangkap oleh salah satu kelompok yang mengincarnya, dia menghilang entah kemana. Ternyata...setelah terluka parah, Peter kembali ke wujudnya saat masih remaja yang lebih kuat dengan raga muda dan sehat. Apa rencana peter setelah perubahan hidupnya yang tak masuk akal ini?', 'killer_peter.jpg', 'Ongoing'),
(6, 'How to Fight', 'Aksi, Perundungan, Kejahatan', 'Hobin, pecundang di sekolah, tidak sengaja menemukan suatu channel lama di Newtube dan sejak hari itu hidupnya berubah.\r\nApakah Hobin bisa belajar cara berkelahi dan membuat konten yang bagus?', 'how_to_fight.jpg', 'Tamat'),
(7, 'Manager Kim', 'Aksi, Balas Dendam, Kejahatan', 'Berhati-hatilah terhadap paman berkacamata itu...!\r\nManager Kim, seorang ayah yang melepas pekerjaannnya sebagai agen khusus dan memilih kehidupan biasa untuk memberikan kehidupan normal kepada putrinya Minji. Namun suatu hari Minji menghilang jejak, sehingga Manager Kim harus turun tangan untuk mencari putrinya!', 'manager_kim.jpg', 'Ongoing'),
(8, 'Lookism', 'Aksi, Perundungan, Bertarung', 'Park Hyungseok, orang yang gendut dan jelek, dirundung oleh orang-orang di lingkungan sekolahnya setiap hari. Namun, sebuah keajaiban akan segera terjadi. Dia bangun di sebuah tubuh yang berbeda. Kini, dia menjadi tinggi, tampan, dan lebih keren di tubuhnya yang sekarang. Daniel bertujuan untuk mencapai semua yang tidak dapat dia capai sebelumnya. Seberapa jauh tubuhnya ini akan dibawa pergi...?', 'lookism.jpg', 'Ongoing');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manhwa`
--
ALTER TABLE `manhwa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `manhwa`
--
ALTER TABLE `manhwa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
