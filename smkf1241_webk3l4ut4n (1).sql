-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 25, 2025 at 10:24 PM
-- Server version: 10.11.10-MariaDB-log
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smkf1241_webk3l4ut4n`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `album_title` varchar(255) NOT NULL,
  `album_description` varchar(255) DEFAULT NULL,
  `album_slug` varchar(255) DEFAULT NULL,
  `album_cover` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `restored_at` datetime DEFAULT NULL,
  `created_by` bigint(20) DEFAULT 0,
  `updated_by` bigint(20) DEFAULT 0,
  `deleted_by` bigint(20) DEFAULT 0,
  `restored_by` bigint(20) DEFAULT 0,
  `is_deleted` enum('true','false') DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment_post_id` bigint(20) NOT NULL DEFAULT 0,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) DEFAULT NULL,
  `comment_url` varchar(255) DEFAULT NULL,
  `comment_ip_address` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_subject` varchar(255) DEFAULT NULL,
  `comment_reply` text DEFAULT NULL,
  `comment_status` enum('approved','unapproved','spam') DEFAULT 'approved',
  `comment_agent` varchar(255) DEFAULT NULL,
  `comment_parent_id` varchar(255) DEFAULT NULL,
  `comment_type` enum('post','message') DEFAULT 'post',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `restored_at` datetime DEFAULT NULL,
  `created_by` bigint(20) DEFAULT 0,
  `updated_by` bigint(20) DEFAULT 0,
  `deleted_by` bigint(20) DEFAULT 0,
  `restored_by` bigint(20) DEFAULT 0,
  `is_deleted` enum('true','false') DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_url`, `comment_ip_address`, `comment_content`, `comment_subject`, `comment_reply`, `comment_status`, `comment_agent`, `comment_parent_id`, `comment_type`, `created_at`, `updated_at`, `deleted_at`, `restored_at`, `created_by`, `updated_by`, `deleted_by`, `restored_by`, `is_deleted`) VALUES
(1, 0, 'Komarudin', 'komarudinbtay@gmail.com', '', '172.70.189.78', 'Mau daftarin anak masuk sekolah', NULL, NULL, 'approved', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Mobile Safari/537.36', NULL, 'message', '2023-06-05 12:31:06', '2023-06-05 05:31:06', NULL, NULL, NULL, 0, 0, 0, 'false'),
(2, 14, 'Fauzi Rokhman', 'dhelik84@gmail.com', '', '103.131.105.150', 'Semoga bermanfaat bagi bangsa dan negara', NULL, NULL, 'approved', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36', NULL, 'post', '2023-12-07 14:13:28', '2023-12-07 07:13:28', NULL, NULL, NULL, 0, 0, 0, 'false'),
(3, 0, 'sudibyo', 'ojikdibyo@gmail.com', '', '180.246.217.72', 'mau tanya soal biaya2 kl misal sekolah di smkn temon', NULL, NULL, 'approved', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Mobile Safari/537.36', NULL, 'message', '2024-06-07 09:43:59', '2024-06-07 02:43:59', NULL, NULL, NULL, 0, 0, 0, 'false'),
(4, 0, 'Arsavin', 'yanilele523@gmail.com', '', '103.222.255.184', 'Menfaftar', NULL, NULL, 'approved', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Mobile Safari/537.36', NULL, 'post', '2024-06-12 16:50:40', '2024-06-12 09:50:40', NULL, NULL, NULL, 0, 0, 0, 'false'),
(5, 0, 'Arsavin', 'yanilele523@gmail.com', '', '103.222.255.184', 'Mendaftar', NULL, NULL, 'approved', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Mobile Safari/537.36', NULL, 'post', '2024-06-12 16:51:38', '2024-06-12 09:51:38', NULL, NULL, NULL, 0, 0, 0, 'false'),
(6, 0, 'Arsavin', 'yanilele523@gmail.com', 'Sekolah', '103.222.255.184', 'Mendaftar', NULL, NULL, 'approved', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Mobile Safari/537.36', NULL, 'post', '2024-06-12 16:52:53', '2024-06-12 09:52:53', NULL, NULL, NULL, 0, 0, 0, 'false'),
(7, 0, 'Arsavin', 'yanilele523@gmail.com', '', '114.10.150.239', 'Mendaftar', NULL, NULL, 'approved', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Mobile Safari/537.36', NULL, 'post', '2024-06-12 19:07:28', '2024-06-12 12:07:28', NULL, NULL, NULL, 0, 0, 0, 'false'),
(8, 0, 'Watulintang Media', 'info@watulintang.com', 'https://smkn1temon.sch.id/hubungi-kami', '36.80.231.2', 'Mas webnya bagus harganya berapa ya siapa pengembangnya', 'Web Watulintang Media', 'Terimakasih pak, ini web kami modifikasi dari cms gratisan :-D', 'approved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', NULL, 'message', '2024-08-02 11:15:28', '2024-08-03 15:08:48', NULL, NULL, NULL, 101, 0, 0, 'false'),
(9, 0, 'Muhammad Sabikul Khoir', '24050754096@mhs.unesa.ac.id', 'https://mesin.ft.unesa.ac.id/', '182.253.50.73', 'ini salah satu contoh penerapan mesin di bidang pendidikan', NULL, NULL, 'unapproved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', NULL, 'post', '2024-08-31 17:12:06', '2024-08-31 10:12:06', NULL, NULL, NULL, 0, 0, 0, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `image_sliders`
--

CREATE TABLE `image_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text DEFAULT NULL,
  `caption` varchar(255) NOT NULL,
  `link` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `restored_at` datetime DEFAULT NULL,
  `created_by` bigint(20) DEFAULT 0,
  `updated_by` bigint(20) DEFAULT 0,
  `deleted_by` bigint(20) DEFAULT 0,
  `restored_by` bigint(20) DEFAULT 0,
  `is_deleted` enum('true','false') DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `image_sliders`
--

INSERT INTO `image_sliders` (`id`, `title`, `caption`, `link`, `image`, `created_at`, `updated_at`, `deleted_at`, `restored_at`, `created_by`, `updated_by`, `deleted_by`, `restored_by`, `is_deleted`) VALUES
(1, 'SMKN 1 Temon', 'SMK Negeri 1 Temon adalah salah satu sekolah berbasis ketarunaan, Sekolah Menengah Kejuruan yang ada di Kabupaten Kulon Progo, dengan berbagai keahlian seperti Nautika Kapal Penangkap Ikan (NKPI),Teknika Kapal Penangkap Ikan (TKPI), Agribisnis Pengolahan ', NULL, 'e840eae987d98a9148a57cdf478d5ced.png', '2023-03-28 23:15:45', '2024-01-01 07:00:23', NULL, NULL, 1, 1, 0, 0, 'false'),
(2, 'Tahun Baru 2024', 'SMKN 1 Temon mengucapkan Selamat tahun Baru 2024\r\n\r\n\"Tahun baru boleh jadi ajang berpesta, tetapi jangan larut dalam euforia. Tetap belajar, bekerja dan diiringi doa.\"', '', '98dde9edca5e9f75a66f9fdf52f1861b.png', '2023-03-01 21:57:45', '2024-04-30 15:31:42', '2024-04-30 22:31:42', NULL, 1, 102, 101, 0, 'true'),
(5, 'SMKN 1 Temon Jogja Smart School', 'SMKN 1 Temon telah resmi menjadi sekolah model berbasis Teknologi Informasi dan Komunikasi binaan Balai Tekkomdik Dinas Dikpora DIY', '', '76e379fd8a2dc4df5b79b671b372b742.png', '2024-04-30 22:01:15', '2024-04-30 15:22:11', NULL, NULL, 101, 101, 0, 0, 'false'),
(6, 'Gabung dan Raih Prestasi di SMKN 1 Temon!', 'Berbagai prestasi membanggakan diraih oleh taruna SMKN 1 Temon.\r\n\r\nSegera daftarkan dirimu di PPDB SMKN 1 Temon Tahun 2024/2025.', 'https://smkn1temon.sch.id/read/55/ppdb', 'cde927dcb9331ba1585fa8984b99531a.png', '2024-04-30 22:31:34', '2024-04-30 15:32:07', NULL, NULL, 101, 0, 0, 0, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link_title` varchar(255) NOT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `link_target` enum('_blank','_self','_parent','_top') DEFAULT '_blank',
  `link_image` varchar(100) DEFAULT NULL,
  `link_type` enum('link','banner') DEFAULT 'link',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `restored_at` datetime DEFAULT NULL,
  `created_by` bigint(20) DEFAULT 0,
  `updated_by` bigint(20) DEFAULT 0,
  `deleted_by` bigint(20) DEFAULT 0,
  `restored_by` bigint(20) DEFAULT 0,
  `is_deleted` enum('true','false') DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `link_title`, `link_url`, `link_target`, `link_image`, `link_type`, `created_at`, `updated_at`, `deleted_at`, `restored_at`, `created_by`, `updated_by`, `deleted_by`, `restored_by`, `is_deleted`) VALUES
(1, 'CMS Sekolahku', 'https://sekolahku.web.id', '_blank', NULL, 'link', '2023-01-15 21:23:22', '2024-08-03 11:59:14', NULL, NULL, 1, 0, 0, 0, 'false'),
(2, 'CMS Sekolahku', 'https://sekolahku.web.id', '_blank', '1.png', 'banner', '2023-01-15 21:23:22', '2023-03-27 00:53:15', '2023-03-27 07:53:15', NULL, 0, 0, 1, 0, 'true'),
(3, 'Sinau Matematika', 'https://www.sinmat.my.id', '_blank', NULL, 'link', '2023-11-09 16:25:26', '2023-11-09 09:25:26', NULL, NULL, 1, 0, 0, 0, 'false'),
(4, 'Jogja Belajar', 'https://jogjabelajar.org/', '_blank', NULL, 'link', '2024-05-01 18:52:22', '2024-05-01 11:52:22', NULL, NULL, 101, 0, 0, 0, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo_album_id` bigint(20) DEFAULT 0,
  `photo_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `restored_at` datetime DEFAULT NULL,
  `created_by` bigint(20) DEFAULT 0,
  `updated_by` bigint(20) DEFAULT 0,
  `deleted_by` bigint(20) DEFAULT 0,
  `restored_by` bigint(20) DEFAULT 0,
  `is_deleted` enum('true','false') DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quote` varchar(255) DEFAULT NULL,
  `quote_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `restored_at` datetime DEFAULT NULL,
  `created_by` bigint(20) DEFAULT 0,
  `updated_by` bigint(20) DEFAULT 0,
  `deleted_by` bigint(20) DEFAULT 0,
  `restored_by` bigint(20) DEFAULT 0,
  `is_deleted` enum('true','false') DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `quote`, `quote_by`, `created_at`, `updated_at`, `deleted_at`, `restored_at`, `created_by`, `updated_by`, `deleted_by`, `restored_by`, `is_deleted`) VALUES
(1, 'Pendidikan merupakan tiket untuk masa depan. Hari esok untuk orang-orang yang telah mempersiapkan dirinya hari ini', 'Anonim', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 1, 0, 0, 0, 'false'),
(2, 'Agama tanpa ilmu pengetahuan adalah buta. Dan ilmu pengetahuan tanpa agama adalah lumpuh', 'Anonim', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 1, 0, 0, 0, 'false'),
(3, 'Hiduplah seakan-akan kau akan mati besok. Belajarlah seakan-akan kau akan hidup selamanya', 'Anonim', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 1, 0, 0, 0, 'false');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`,`comment_post_id`);

--
-- Indexes for table `image_sliders`
--
ALTER TABLE `image_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `image_sliders`
--
ALTER TABLE `image_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
