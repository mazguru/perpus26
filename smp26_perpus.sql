-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 31, 2025 at 03:56 AM
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
-- Database: `smp26_perpus`
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
  `image_cover` varchar(100) DEFAULT NULL,
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
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `album_title`, `album_description`, `album_slug`, `image_cover`, `created_at`, `updated_at`, `deleted_at`, `restored_at`, `created_by`, `updated_by`, `deleted_by`, `restored_by`, `is_deleted`) VALUES
(1, 'prestasi', 'prestasiku', 'prestasi', '1753550986_a1908004b20027cc55b1.jpg', '2025-07-26 16:50:26', '2025-07-26 10:29:46', NULL, NULL, 101, 101, 0, 0, ''),
(2, 'Prestai kedua', 'ini hanya prestasi kedua yaa siap ndan', 'prestai-kedua', '1753551107_38d552ce481b122b822d.jpg', '2025-07-26 16:52:24', '2025-07-26 10:31:47', NULL, NULL, 101, 101, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `penulis` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `slug`, `isi`, `penulis`, `created_at`, `updated_at`, `gambar`) VALUES
(1, 'Judul Artikel Pertama', 'judul-artikel-pertama', 'Isi lengkap artikel pertama...', 'Admin', '2025-07-13 12:40:16', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) DEFAULT NULL,
  `category_description` varchar(255) DEFAULT NULL,
  `category_type` enum('post','file','page') DEFAULT 'post',
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
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `category_description`, `category_type`, `created_at`, `updated_at`, `deleted_at`, `restored_at`, `created_by`, `updated_by`, `deleted_by`, `restored_by`, `is_deleted`) VALUES
(1, 'Berita', 'berita', 'Berita', 'post', '2023-01-15 21:23:22', '2023-03-05 03:06:23', NULL, NULL, 0, 1, 0, 0, 'false'),
(2, 'Diktat', 'diktat', 'Diktat/Modul Mata Pelajaran', 'file', '2023-01-15 21:23:22', '2023-03-05 08:23:18', NULL, NULL, 0, 1, 0, 0, 'false'),
(3, 'Artikel', 'artikel', 'Artikel', 'post', NULL, '2023-03-05 03:06:30', NULL, NULL, 1, 1, 0, 0, 'false'),
(4, 'Pengumuman', 'pengumuman', 'Pengumuman & Info Karir', 'post', NULL, '2024-01-01 16:05:36', NULL, NULL, 1, 102, 0, 0, 'false'),
(5, 'Agenda', 'agenda', 'Agenda', 'post', NULL, '2024-01-01 16:05:46', NULL, NULL, 102, 0, 0, 0, 'false'),
(6, 'foto', 'foto', 'aset untuk gambar', 'file', '2025-02-11 17:23:49', '2025-02-11 10:23:49', NULL, NULL, 101, 0, 0, 0, 'false'),
(7, 'Layanan', 'layanan', 'layanan', 'page', NULL, '2025-07-31 02:22:27', NULL, NULL, 0, 0, 0, 0, 'false'),
(8, 'Profil', 'profil', 'profil', 'page', NULL, '2025-07-31 02:22:59', NULL, NULL, 0, 0, 0, 0, 'false');

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
(1, 0, 'Komarudin', 'komarudinbtay@gmail.com', '', '172.70.189.78', 'Mau daftarin anak masuk sekolah', NULL, NULL, 'approved', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Mobile Safari/537.36', NULL, 'message', '2023-06-05 12:31:06', '2023-06-04 22:31:06', NULL, NULL, NULL, 0, 0, 0, 'false'),
(2, 14, 'Fauzi Rokhman', 'dhelik84@gmail.com', '', '103.131.105.150', 'Semoga bermanfaat bagi bangsa dan negara', NULL, NULL, 'approved', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36', NULL, 'post', '2023-12-07 14:13:28', '2023-12-07 00:13:28', NULL, NULL, NULL, 0, 0, 0, 'false'),
(3, 9, 'sudibyo', 'ojikdibyo@gmail.com', '', '180.246.217.72', 'mau tanya soal biaya2 kl misal sekolah di smkn temon', NULL, NULL, 'approved', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Mobile Safari/537.36', NULL, 'message', '2024-06-07 09:43:59', '2025-07-29 03:08:01', NULL, NULL, NULL, 0, 0, 0, 'false'),
(4, 0, 'Arsavin', 'yanilele523@gmail.com', '', '103.222.255.184', 'Menfaftar', NULL, NULL, 'approved', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Mobile Safari/537.36', NULL, 'post', '2024-06-12 16:50:40', '2024-06-12 02:50:40', NULL, NULL, NULL, 0, 0, 0, 'false'),
(5, 0, 'Arsavin', 'yanilele523@gmail.com', '', '103.222.255.184', 'Mendaftar', NULL, NULL, 'approved', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Mobile Safari/537.36', NULL, 'post', '2024-06-12 16:51:38', '2024-06-12 02:51:38', NULL, NULL, NULL, 0, 0, 0, 'false'),
(6, 0, 'Arsavin', 'yanilele523@gmail.com', 'Sekolah', '103.222.255.184', 'Mendaftar', NULL, NULL, 'approved', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Mobile Safari/537.36', NULL, 'post', '2024-06-12 16:52:53', '2024-06-12 02:52:53', NULL, NULL, NULL, 0, 0, 0, 'false'),
(7, 0, 'Arsavin', 'yanilele523@gmail.com', '', '114.10.150.239', 'Mendaftar', NULL, NULL, 'approved', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Mobile Safari/537.36', NULL, 'post', '2024-06-12 19:07:28', '2024-06-12 05:07:28', NULL, NULL, NULL, 0, 0, 0, 'false'),
(8, 0, 'Watulintang Media', 'info@watulintang.com', 'https://smkn1temon.sch.id/hubungi-kami', '36.80.231.2', 'Mas webnya bagus harganya berapa ya siapa pengembangnya', 'Web Watulintang Media', 'Terimakasih pak, ini web kami modifikasi dari cms gratisan :-D', 'approved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', NULL, 'message', '2024-08-02 11:15:28', '2024-08-03 08:08:48', NULL, NULL, NULL, 101, 0, 0, 'false'),
(9, 0, 'Muhammad Sabikul Khoir', '24050754096@mhs.unesa.ac.id', 'https://mesin.ft.unesa.ac.id/', '182.253.50.73', 'ini salah satu contoh penerapan mesin di bidang pendidikan', NULL, NULL, 'unapproved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', NULL, 'post', '2024-08-31 17:12:06', '2024-08-31 03:12:06', NULL, NULL, NULL, 0, 0, 0, 'false'),
(10, 9, 'df', 'tes@gmial.con', NULL, '::1', 'tes', NULL, NULL, 'approved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'post', '2025-07-29 07:26:19', '2025-07-29 00:26:19', NULL, NULL, 0, 0, 0, 0, ''),
(11, 9, 'tes', 'Tes@gmail.com', NULL, '::1', 'haha', NULL, NULL, 'approved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'post', '2025-07-29 07:28:18', '2025-07-29 00:28:18', NULL, NULL, 0, 0, 0, 0, ''),
(12, 9, 'tes', 'Tes@gmail.com', NULL, '::1', 'haha', NULL, NULL, 'approved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'post', '2025-07-29 07:29:27', '2025-07-29 00:29:27', NULL, NULL, 0, 0, 0, 0, 'false'),
(13, 9, 'tes', 'Tes@gmail.com', NULL, '::1', 'haha', NULL, NULL, 'unapproved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'post', '2025-07-29 07:30:05', '2025-07-29 00:30:05', NULL, NULL, 0, 0, 0, 0, 'false'),
(14, 9, 'Guest', 'guest@example.com', NULL, '::1', 'oke', NULL, NULL, 'approved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '12', 'post', '2025-07-29 07:37:17', '2025-07-29 07:41:57', NULL, NULL, 0, 0, 0, 0, 'false'),
(15, 9, '', '', NULL, '::1', '', NULL, NULL, 'unapproved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'post', '2025-07-29 08:10:57', '2025-07-29 01:10:57', NULL, NULL, 0, 0, 0, 0, 'false'),
(16, 9, '', '', NULL, '::1', '', NULL, NULL, 'unapproved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'post', '2025-07-29 08:11:16', '2025-07-29 01:11:16', NULL, NULL, 0, 0, 0, 0, 'false'),
(17, 9, 'bakhtiar', 'ahmad@smk.net', NULL, '::1', 'Tes ya gess', NULL, NULL, 'unapproved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'post', '2025-07-29 08:16:23', '2025-07-29 01:16:23', NULL, NULL, 0, 0, 0, 0, 'false'),
(18, 9, 'hus', 'd@y.net', NULL, '::1', 'hai', NULL, NULL, 'unapproved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'post', '2025-07-29 08:23:42', '2025-07-29 01:23:42', NULL, NULL, 0, 0, 0, 0, 'false'),
(19, 9, 'ahmad', 'a@n.net', NULL, '::1', 'yeye', NULL, NULL, 'unapproved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'post', '2025-07-29 08:24:48', '2025-07-29 01:24:48', NULL, NULL, 0, 0, 0, 0, 'false');

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
(1, 'SMKN 1 Temon', 'SMK Negeri 1 Temon adalah salah satu sekolah berbasis ketarunaan, Sekolah Menengah Kejuruan yang ada di Kabupaten Kulon Progo, dengan berbagai keahlian seperti Nautika Kapal Penangkap Ikan (NKPI),Teknika Kapal Penangkap Ikan (TKPI), Agribisnis Pengolahan ', NULL, 'e840eae987d98a9148a57cdf478d5ced.png', '2023-03-28 23:15:45', '2024-01-01 00:00:23', NULL, NULL, 1, 1, 0, 0, 'false'),
(2, 'Tahun Baru 2024', 'SMKN 1 Temon mengucapkan Selamat tahun Baru 2024\r\n\r\n\"Tahun baru boleh jadi ajang berpesta, tetapi jangan larut dalam euforia. Tetap belajar, bekerja dan diiringi doa.\"', '', '98dde9edca5e9f75a66f9fdf52f1861b.png', '2023-03-01 21:57:45', '2024-04-30 08:31:42', '2024-04-30 22:31:42', NULL, 1, 102, 101, 0, 'true'),
(5, 'SMKN 1 Temon Jogja Smart School', 'SMKN 1 Temon telah resmi menjadi sekolah model berbasis Teknologi Informasi dan Komunikasi binaan Balai Tekkomdik Dinas Dikpora DIY', '', '76e379fd8a2dc4df5b79b671b372b742.png', '2024-04-30 22:01:15', '2024-04-30 08:22:11', NULL, NULL, 101, 101, 0, 0, 'false'),
(6, 'Gabung dan Raih Prestasi di SMKN 1 Temon!', 'Berbagai prestasi membanggakan diraih oleh taruna SMKN 1 Temon.\r\n\r\nSegera daftarkan dirimu di PPDB SMKN 1 Temon Tahun 2024/2025.', 'https://smkn1temon.sch.id/read/55/ppdb', 'cde927dcb9331ba1585fa8984b99531a.png', '2024-04-30 22:31:34', '2024-04-30 08:32:07', NULL, NULL, 101, 0, 0, 0, 'false');

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
(1, 'CMS Sekolahku', 'https://sekolahku.web.id', '_blank', NULL, 'link', '2023-01-15 21:23:22', '2024-08-03 04:59:14', NULL, NULL, 1, 0, 0, 0, 'false'),
(2, 'CMS Sekolahku', 'https://sekolahku.web.id', '_blank', '1.png', 'banner', '2023-01-15 21:23:22', '2023-03-26 17:53:15', '2023-03-27 07:53:15', NULL, 0, 0, 1, 0, 'true'),
(3, 'Sinau Matematika', 'https://www.sinmat.my.id', '_blank', NULL, 'link', '2023-11-09 16:25:26', '2023-11-09 02:25:26', NULL, NULL, 1, 0, 0, 0, 'false'),
(4, 'Jogja Belajar', 'https://jogjabelajar.org/', '_blank', NULL, 'link', '2024-05-01 18:52:22', '2024-05-01 04:52:22', NULL, NULL, 101, 0, 0, 0, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `status` enum('success','fail') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `user_name`, `ip_address`, `user_agent`, `status`, `created_at`, `updated_at`) VALUES
(25, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-14 19:24:34', '2025-07-14 19:24:34'),
(26, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-14 19:34:15', '2025-07-14 19:34:15'),
(27, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-14 19:55:01', '2025-07-14 19:55:01'),
(28, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-14 19:59:28', '2025-07-14 19:59:28'),
(29, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-17 15:50:58', '2025-07-17 15:50:58'),
(30, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-17 16:05:29', '2025-07-17 16:05:29'),
(31, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-21 11:34:54', '2025-07-21 11:34:54'),
(32, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-21 23:02:55', '2025-07-21 23:02:55'),
(33, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-22 08:53:37', '2025-07-22 08:53:37'),
(34, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-22 10:31:41', '2025-07-22 10:31:41'),
(35, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-22 10:36:40', '2025-07-22 10:36:40'),
(36, 'admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'fail', '2025-07-22 11:15:32', '2025-07-22 11:15:32'),
(37, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-22 11:15:37', '2025-07-22 11:15:37'),
(38, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-22 22:21:36', '2025-07-22 22:21:36'),
(39, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-23 10:37:14', '2025-07-23 10:37:14'),
(40, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-23 14:10:50', '2025-07-23 14:10:50'),
(41, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-23 22:30:23', '2025-07-23 22:30:23'),
(42, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-24 11:42:38', '2025-07-24 11:42:38'),
(43, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-24 22:16:41', '2025-07-24 22:16:41'),
(44, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-25 17:03:38', '2025-07-25 17:03:38'),
(45, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-26 12:42:25', '2025-07-26 12:42:25'),
(46, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-27 03:47:57', '2025-07-27 03:47:57'),
(47, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-28 01:33:00', '2025-07-28 01:33:00'),
(48, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-29 01:06:18', '2025-07-29 01:06:18'),
(49, 'admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'fail', '2025-07-30 03:31:43', '2025-07-30 03:31:43'),
(50, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-30 03:31:51', '2025-07-30 03:31:51'),
(51, 'admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'fail', '2025-07-31 01:03:17', '2025-07-31 01:03:17'),
(52, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-31 01:03:32', '2025-07-31 01:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `order_num` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `url`, `icon`, `order_num`, `is_active`) VALUES
(4, 'Opac-Slims', 'opac', NULL, 5, 1),
(5, 'Profil', '#', NULL, 2, 1),
(6, 'Galeri', '#', NULL, 4, 1),
(7, 'Informasi', '#', NULL, 3, 1),
(9, 'Hubungi Kami', 'hubungi', NULL, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-07-29-013119', 'App\\Database\\Migrations\\AddPathToVisitors', 'default', 'App', 1753752727, 1),
(2, '2025-07-29-014112', 'App\\Database\\Migrations\\AddPathToVisitors', 'default', 'App', 1753753291, 2);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_group` varchar(100) NOT NULL,
  `option_name` varchar(255) DEFAULT NULL,
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
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_group`, `option_name`, `created_at`, `updated_at`, `deleted_at`, `restored_at`, `created_by`, `updated_by`, `deleted_by`, `restored_by`, `is_deleted`) VALUES
(1, 'student_status', 'Aktif', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(2, 'student_status', 'Lulus', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(3, 'student_status', 'Mutasi', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(4, 'student_status', 'Dikeluarkan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(5, 'student_status', 'Mengundurkan Diri', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(6, 'student_status', 'Putus Sekolah', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(7, 'student_status', 'Meninggal', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(8, 'student_status', 'Hilang', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(9, 'student_status', 'Lainnya', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(10, 'employments', 'Tidak bekerja', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(11, 'employments', 'Nelayan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(12, 'employments', 'Petani', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(13, 'employments', 'Peternak', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(14, 'employments', 'PNS/TNI/POLRI', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(15, 'employments', 'Karyawan Swasta', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(16, 'employments', 'Pedagang Kecil', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(17, 'employments', 'Pedagang Besar', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(18, 'employments', 'Wiraswasta', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(19, 'employments', 'Wirausaha', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(20, 'employments', 'Buruh', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(21, 'employments', 'Pensiunan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(22, 'employments', 'Lain-lain', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(23, 'special_needs', 'Tidak', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(24, 'special_needs', 'Tuna Netra', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(25, 'special_needs', 'Tuna Rungu', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(26, 'special_needs', 'Tuna Grahita ringan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(27, 'special_needs', 'Tuna Grahita Sedang', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(28, 'special_needs', 'Tuna Daksa Ringan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(29, 'special_needs', 'Tuna Daksa Sedang', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(30, 'special_needs', 'Tuna Laras', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(31, 'special_needs', 'Tuna Wicara', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(32, 'special_needs', 'Tuna ganda', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(33, 'special_needs', 'Hiper aktif', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(34, 'special_needs', 'Cerdas Istimewa', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(35, 'special_needs', 'Bakat Istimewa', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(36, 'special_needs', 'Kesulitan Belajar', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(37, 'special_needs', 'Narkoba', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(38, 'special_needs', 'Indigo', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(39, 'special_needs', 'Down Sindrome', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(40, 'special_needs', 'Autis', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(41, 'special_needs', 'Lainnya', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(42, 'educations', 'Tidak sekolah', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(43, 'educations', 'Putus SD', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(44, 'educations', 'SD Sederajat', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(45, 'educations', 'SMP Sederajat', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(46, 'educations', 'SMA Sederajat', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(47, 'educations', 'D1', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(48, 'educations', 'D2', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(49, 'educations', 'D3', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(50, 'educations', 'D4/S1', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(51, 'educations', 'S2', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(52, 'educations', 'S3', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(53, 'scholarships', 'Anak berprestasi', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(54, 'scholarships', 'Anak Miskin', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(55, 'scholarships', 'Pendidikan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(56, 'scholarships', 'Unggulan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(57, 'scholarships', 'Lain-lain', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(58, 'achievement_types', 'Sains', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(59, 'achievement_types', 'Seni', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(60, 'achievement_types', 'Olahraga', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(61, 'achievement_types', 'Lain-lain', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(62, 'achievement_levels', 'Sekolah', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(63, 'achievement_levels', 'Kecamatan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(64, 'achievement_levels', 'Kota/Kabupaten', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(65, 'achievement_levels', 'Propinsi', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(66, 'achievement_levels', 'Nasional', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(67, 'achievement_levels', 'Internasional', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(68, 'monthly_incomes', 'Kurang dari 500,000', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(69, 'monthly_incomes', '500.000 - 999.9999', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(70, 'monthly_incomes', '1 Juta - 1.999.999', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(71, 'monthly_incomes', '2 Juta - 4.999.999', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(72, 'monthly_incomes', '5 Juta - 20 Juta', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(73, 'monthly_incomes', 'Lebih dari 20 Juta', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(74, 'residences', 'Bersama orang tua', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(75, 'residences', 'Wali', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(76, 'residences', 'Kos', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(77, 'residences', 'Asrama', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(78, 'residences', 'Panti Asuhan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(79, 'residences', 'Lainnya', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(80, 'transportations', 'Jalan kaki', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(81, 'transportations', 'Kendaraan pribadi', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(82, 'transportations', 'Kendaraan Umum / angkot / Pete-pete', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(83, 'transportations', 'Jemputan Sekolah', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(84, 'transportations', 'Kereta Api', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(85, 'transportations', 'Ojek', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(86, 'transportations', 'Andong / Bendi / Sado / Dokar / Delman / Beca', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(87, 'transportations', 'Perahu penyebrangan / Rakit / Getek', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(88, 'transportations', 'Lainnya', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(89, 'religions', 'Islam', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(90, 'religions', 'Kristen / protestan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(91, 'religions', 'Katholik', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(92, 'religions', 'Hindu', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(93, 'religions', 'Budha', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(94, 'religions', 'Khong Hu Chu', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(95, 'religions', 'Lainnya', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(96, 'school_levels', '1 - Sekolah Dasar (SD) / Sederajat', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(97, 'school_levels', '2 - Sekolah Menengah Pertama (SMP) / Sederajat', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(98, 'school_levels', '3 - Sekolah Menengah Atas (SMA) / Aliyah', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(99, 'school_levels', '4 - Sekolah Menengah Kejuruan (SMK)', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(100, 'school_levels', '5 - Universitas', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(101, 'school_levels', '6 - Sekolah Tinggi', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(102, 'school_levels', '7 - Politeknik', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(103, 'marriage_status', 'Kawin', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(104, 'marriage_status', 'Belum Kawin', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(105, 'marriage_status', 'Berpisah', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(106, 'institution_lifters', 'Pemerintah Pusat', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(107, 'institution_lifters', 'Pemerintah Provinsi', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(108, 'institution_lifters', 'Pemerintah Kab/Kota', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(109, 'institution_lifters', 'Ketua yayasan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(110, 'institution_lifters', 'Kepala Sekolah', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(111, 'institution_lifters', 'Komite Sekolah', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(112, 'institution_lifters', 'Lainnya', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(113, 'employment_status', 'PNS ', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(114, 'employment_status', 'PNS Diperbantukan ', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(115, 'employment_status', 'PNS DEPAG ', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(116, 'employment_status', 'GTY/PTY ', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(117, 'employment_status', 'GTT/PTT Provinsi ', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(118, 'employment_status', 'GTT/PTT Kota/Kabupaten', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(119, 'employment_status', 'Guru Bantu Pusat ', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(120, 'employment_status', 'Guru Honor Sekolah ', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(121, 'employment_status', 'Tenaga Honor Sekolah ', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(135, 'ranks', 'I/A', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(136, 'ranks', 'I/B', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(137, 'ranks', 'I/C', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(138, 'ranks', 'I/D', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(139, 'ranks', 'II/A', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(140, 'ranks', 'II/B', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(141, 'ranks', 'II/C', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(142, 'ranks', 'II/D', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(143, 'ranks', 'III/A', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(144, 'ranks', 'III/B', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(145, 'ranks', 'III/C', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(146, 'ranks', 'III/D', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(147, 'ranks', 'IV/A', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(148, 'ranks', 'IV/B', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(149, 'ranks', 'IV/C', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(150, 'ranks', 'IV/D', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(151, 'ranks', 'IV/E', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(152, 'salary_sources', 'APBN', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(153, 'salary_sources', 'APBD Provinsi', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(154, 'salary_sources', 'APBD Kab/Kota', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(155, 'salary_sources', 'Yayasan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(156, 'salary_sources', 'Sekolah', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(157, 'salary_sources', 'Lembaga Donor', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(158, 'salary_sources', 'Lainnya', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(159, 'laboratory_skills', 'Lab IPA', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(160, 'laboratory_skills', 'Lab Fisika', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(161, 'laboratory_skills', 'Lab Biologi', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(162, 'laboratory_skills', 'Lab Kimia', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(163, 'laboratory_skills', 'Lab Bahasa', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(164, 'laboratory_skills', 'Lab Komputer', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(165, 'laboratory_skills', 'Teknik Bangunan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(166, 'laboratory_skills', 'Teknik Survei & Pemetaan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(167, 'laboratory_skills', 'Teknik Ketenagakerjaan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(168, 'laboratory_skills', 'Teknik Pendinginan & Tata Udara', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(169, 'laboratory_skills', 'Teknik Mesin', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(170, 'employment_types', 'Kepala Sekolah', '2023-01-15 21:23:22', '2025-01-18 04:02:27', NULL, NULL, 0, 1, 0, 0, 'false'),
(171, 'employment_types', 'Kepala Tata Usaha', '2025-01-18 10:22:22', '2025-01-18 04:02:33', NULL, NULL, 101, 0, 0, 0, 'false'),
(172, 'employment_types', 'Guru Mata Pelajaran', '2023-01-15 21:23:22', '2025-01-18 04:02:51', NULL, NULL, 0, 0, 0, 0, 'false'),
(173, 'employment_types', 'Guru BK', '2023-01-15 21:23:22', '2025-01-18 04:02:58', NULL, NULL, 0, 0, 0, 0, 'false'),
(174, 'employment_types', 'Guru Produktif NKPI', '2025-01-18 09:51:37', '2025-01-18 02:51:37', NULL, NULL, 101, 0, 0, 0, 'false'),
(175, 'employment_types', 'Guru Produktif TKPI', '2025-01-18 09:51:48', '2025-01-18 02:51:48', NULL, NULL, 101, 0, 0, 0, 'false'),
(176, 'employment_types', 'Guru Produktif TPM', '2025-01-18 09:51:57', '2025-01-18 02:51:57', NULL, NULL, 101, 0, 0, 0, 'false'),
(177, 'employment_types', 'Guru Produktif APHP', '2025-01-18 09:52:07', '2025-01-18 02:52:07', NULL, NULL, 101, 0, 0, 0, 'false'),
(178, 'employment_types', 'Guru Produktif GP', '2025-01-18 09:52:15', '2025-01-18 02:52:15', NULL, NULL, 101, 0, 0, 0, 'false'),
(179, 'employment_types', 'Guru Produktif', '2025-01-18 09:52:23', '2025-01-18 02:52:23', NULL, NULL, 101, 0, 0, 0, 'false'),
(180, 'employment_types', 'Pengolah Data dan Informasi', '2025-01-18 09:46:59', '2025-01-18 04:01:19', NULL, NULL, 101, 0, 0, 0, 'false'),
(181, 'employment_types', 'Pengadministrasi Perkantoran', '2025-01-18 09:47:11', '2025-01-18 04:01:49', NULL, NULL, 101, 0, 0, 0, 'false'),
(182, 'employment_types', 'Operator Layanan Operasional', '2025-01-18 09:47:31', '2025-01-18 04:01:56', NULL, NULL, 101, 0, 0, 0, 'false'),
(183, 'employment_types', 'Pamong', '2025-01-18 09:46:23', '2025-01-18 04:02:07', NULL, NULL, 101, 0, 0, 0, 'false'),
(185, 'employment_types', 'Tenaga Administrasi Sekolah', '2025-01-18 11:24:07', '2025-01-18 04:24:07', NULL, NULL, 101, 0, 0, 0, 'false');

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

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `photo_album_id`, `photo_name`, `created_at`, `updated_at`, `deleted_at`, `restored_at`, `created_by`, `updated_by`, `deleted_by`, `restored_by`, `is_deleted`) VALUES
(3, 1, '1753553091_38054428e81342f9f80f.jpg', '2025-07-26 18:04:51', '2025-07-26 18:04:51', NULL, NULL, 101, 0, 0, 0, 'false'),
(4, 1, '1753553091_6d1f46da50efad6764c3.jpg', '2025-07-26 18:04:51', '2025-07-26 18:04:51', NULL, NULL, 101, 0, 0, 0, 'false'),
(5, 1, '1753553091_6a02291048561dd2857e.jpg', '2025-07-26 18:04:51', '2025-07-26 18:04:51', NULL, NULL, 101, 0, 0, 0, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `post_content` longtext DEFAULT NULL,
  `post_image` varchar(100) DEFAULT NULL,
  `post_author` bigint(20) DEFAULT 0,
  `post_categories` varchar(255) DEFAULT NULL,
  `post_type` varchar(50) NOT NULL DEFAULT 'post',
  `post_status` enum('publish','draft') DEFAULT 'publish',
  `post_visibility` enum('public','private') DEFAULT 'public',
  `post_comment_status` enum('open','close') DEFAULT 'open',
  `post_slug` varchar(255) DEFAULT NULL,
  `post_tags` varchar(255) DEFAULT NULL,
  `post_counter` bigint(20) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `restored_by` bigint(20) DEFAULT NULL,
  `is_deleted` enum('true','false') DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 CHECKSUM=1 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_title`, `post_content`, `post_image`, `post_author`, `post_categories`, `post_type`, `post_status`, `post_visibility`, `post_comment_status`, `post_slug`, `post_tags`, `post_counter`, `created_at`, `updated_at`, `deleted_at`, `restored_at`, `created_by`, `updated_by`, `deleted_by`, `restored_by`, `is_deleted`) VALUES
(1, 'Tes Posting Awal', '<p>ini hanya untuk tess</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"http://localhost:8080/media_library/posts/1753289290_5928a079e1cc01812eb9.png\" width=\"30%\" /></p>', 'tes-posting-awal.png', 101, '1', 'post', 'publish', 'public', 'open', 'tes-posting-awal', NULL, 0, '2025-07-23 10:12:00', '2025-07-23 10:12:00', NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(4, 'tesss', '<p>ds</p>\r\n<p><img src=\"http://localhost:8080/media_library/posts/1753288783_37760f4b444f50c014e3.png\" width=\"100%\" height=\"100%\" /></p>', 'tesss.png', 101, '1', 'post', 'publish', 'public', 'open', 'tesss', NULL, 0, '2025-07-27 18:34:18', '2025-07-27 18:34:18', NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(9, 'Visi Misi Perpustakaan', '<p><strong>VISI</strong></p>\r\n<p>Terwujudnya Perpustakaan Sekolah Sebagai Pengembangan Minat dan Gemar Membaca serta Pusat Layanan Informasi Bagi Warga Sekolah</p>\r\n<p>&nbsp;</p>\r\n<p><strong>MISI</strong></p>\r\n<ol>\r\n<li>Meningkatkan minat baca guna mewujudkan generasi yang kreatif menggali ilmu dengan membudayakan membaca</li>\r\n<li>Menyediakan berbagai koleksi bacaan untuk mengembangkan pengetahuan</li>\r\n<li>Menjadikan perpustakaan sebagai jantungnya sekolah</li>\r\n<li>Mengembangkan perpustakaan berbasis teknologi informasi</li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<p><strong>TUJUAN</strong></p>\r\n<ol>\r\n<li>Menumbuhkan minat baca siswa melalui kegiatan literasi informasi</li>\r\n<li>Mengembangkan potensi siswa melalui kegiatan kreativitas yang dapat menumbuhkan jiwa ingin tahu terhadap budaya dan keterampilan khusus</li>\r\n<li>Membangun budaya belajar sesama siswa melalui kegiatan pembiasaan membaca dan menulis</li>\r\n<li>Berperan sebagai pusat informasi yang mampu menyediakan berbagai sumber informasi bagi seluruh warga sekolah, baik digital maupun cetak</li>\r\n<li>Berperan sebagai jantung literasi informasi sekolah dengan menyediakan wadah bagi warga sekolah dalam memupuk dan meningkatkan minat dan baka</li>\r\n<li>Mengintegrasikan literasi dasar (baca-tulis, numerasi, sauns, digital, finansial, budaya dan kewargaan) dalam kegiatan belajar mengajar</li>\r\n</ol>', NULL, 101, '', 'page', 'publish', 'public', 'open', 'visi-misi-perpustakaan', NULL, 0, '2025-07-26 07:32:43', '2025-07-26 07:32:43', NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(10, 'Sejarah Perpustakaan', '<p>isi sejarah</p>', NULL, 101, '', 'page', 'publish', 'public', 'open', 'sejarah-perpustakaan', NULL, 0, '2025-07-26 07:33:50', '2025-07-26 07:33:50', NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(11, 'Struktur Organisasi', '<p><img src=\"http://localhost:8080/media_library/posts/1753540477_22b7a2ea2953459fe135.png\" /></p>', NULL, 101, '', 'page', 'publish', 'public', 'open', 'struktur-organisasi', NULL, 0, '2025-07-26 07:34:50', '2025-07-26 07:34:50', NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(12, 'Tenaga Perpustakaan', '<p>Jumlah tenaga kerja perpustakaan berjumlah 9 orang (termasuk kepala perpustakaan) dengan kualifikasi pendidikan sebagai berikut:</p>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td width=\"200\">\r\n<p><strong>Posisi/Kedudukan</strong></p>\r\n</td>\r\n<td width=\"73\">\r\n<p><strong>Jumlah</strong></p>\r\n</td>\r\n<td width=\"327\">\r\n<p><strong>Kualifikasi Pendidikan</strong></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"200\">\r\n<p>Kepala Perpustakaan</p>\r\n</td>\r\n<td width=\"73\">\r\n<p>1</p>\r\n</td>\r\n<td width=\"327\">\r\n<p>S1 Sarjana Sains Informasi</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"200\">\r\n<p>Pustakawan Fungsional</p>\r\n</td>\r\n<td width=\"73\">\r\n<p>3</p>\r\n</td>\r\n<td width=\"327\">\r\n<p>S1 Sarjanan Sains Informasi (1 orang)</p>\r\n<p>S1 Sarjanan Ilmu Perpustakaan (2 orang)</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"200\">\r\n<p>Pelayanan Teknis</p>\r\n</td>\r\n<td width=\"73\">\r\n<p>4</p>\r\n</td>\r\n<td width=\"327\">\r\n<p>S1 Sarjanan Pendidikan (2 orang)</p>\r\n<p>S2 Magister Pendidikan (1 orang)</p>\r\n<p>S1 Sarjana Akuntansi (1 orang)</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"200\">\r\n<p>Pelayanan Pembaca (Sirkulasi)</p>\r\n</td>\r\n<td width=\"73\">\r\n<p>3</p>\r\n</td>\r\n<td width=\"327\">\r\n<p>S1 Sarjanan Sains Informasi (1 orang)</p>\r\n<p>S1 Sarjanan Ilmu Perpustakaan (1 orang)</p>\r\n<p>S1 Sarjana Pendidikan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"200\">\r\n<p>Pelayanan Pustaka Maya (TIK)</p>\r\n</td>\r\n<td width=\"73\">\r\n<p>2</p>\r\n</td>\r\n<td width=\"327\">\r\n<p>S1 Sarjana Komputer (1 orang)</p>\r\n<p>D3 Ilmu Perpustakaan (1 orang)</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', NULL, 101, '', 'page', 'publish', 'public', 'open', 'tenaga-perpustakaan', NULL, 0, '2025-07-26 07:35:30', '2025-07-26 07:35:30', NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(13, 'Layanan Perpustakaan', '<p>Pada tahun 2025, perpustakaan SMP Islam Al Azhar 26 Yogyakarta merancang kegiatan layan perpustakaan yang ditujukan kepada pemustaka. Tedapat 6 jenis layanan yang dapat dimanfaatkan oleh pemustaka, yaitu:</p>\r\n<table width=\"633\">\r\n<tbody>\r\n<tr>\r\n<td width=\"47\">\r\n<p><strong>No.</strong></p>\r\n</td>\r\n<td width=\"274\">\r\n<p><strong>Nama Barang</strong></p>\r\n</td>\r\n<td width=\"133\">\r\n<p><strong>Lokasi</strong></p>\r\n</td>\r\n<td width=\"179\">\r\n<p><strong>Target Pemustaka</strong></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>1</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan Baca di Tempat</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Anggota perpustakaan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>2</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan Sirkulasi</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Anggota perpustakaan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>3</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan Referensi</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Anggota perpustakaan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>4</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan Penelusuran Informasi</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Anggota perpustakaan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>5</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan Silang Layan</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Umum</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>6</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan Bimbingan Literasi Informasi</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Anggota perpustakaan</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li><strong>Layanan baca di tempat </strong>adalah penyediaan sarana dan prasarana bagi pemustaka untuk melakukan kegiatan literasi terhadap koleksi pustaka, khususnya koleksi referensi, di dalam ruang perpustakaan.</li>\r\n<li><strong>Layanan sirkulasi</strong> adalah layanan peminjaman, pengembalian, serta perpanjangan koleksi pustaka oleh anggota perpustakaan. Layanan ini juga meliputi kegiatan yang berkaitan dengan administrasi perpustakaan seperti pendaftaran anggota perpustakaan, pencatatan serta pembayaran denda keterlambatan.&nbsp; Perpustakaan Adyatama SMP Islam Al Azhar 26 Yogyakarta menggunakan sistem otomatis dengan layanan terbuka dalam menunjang layanan ini.</li>\r\n<li><strong>Layanan referensi </strong>adalah penyediaan bahan rujukan informasi pustaka bagi pemustaka untuk di baca di tempat. Adapun bahan pustaka yang disediakan oleh Perpustakaan Adyatama SMP Islam Al Azhar 26 Yogyakarta antara lain kamus, ensiklopedia, atlas, globe, biografi, dan lain-lain.</li>\r\n<li><strong>Layanan penelusuran informasi </strong>adalah penyediaan sarana bagi pemustaka untuk mencari informasi di luar lingkup koleksi perpustakaan. Adapun sarana yang disediakan berupa perangkat yang terhubung dengan internet seperti komputer dan <em>ipad.</em></li>\r\n<li><strong>Layanan silang layan </strong>adalah pemberian fasilitas koleksi perpustakaan ke perpustakaan lain sesuai kebutuhan atau permintaan secara gratis dan rutin. Penerima dari layanan silang layan diantaranya adalah unit perpustakaan sekolah lain dan perpustakaan masyarakat.</li>\r\n</ul>\r\n<p><strong>Layanan bimbingan literasi informasi </strong>adalah layanan yang membantu pemustaka untuk memahami dan menggunakan informasi secara lebih efektif. Layanan ini dapat dilaksanakan bersamaan dengan layanan sirkulasi.</p>', NULL, 101, '', 'page', 'publish', 'public', 'open', 'layanan-perpustakaan', NULL, 0, '2025-07-26 07:36:21', '2025-07-26 07:36:21', NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(14, 'Layanan Referensi Perpustakaan', '<p>Pada tahun 2025, perpustakaan SMP Islam Al Azhar 26 Yogyakarta merancang kegiatan layan referensi perpustakaan yang ditujukan kepada pemustaka. Tedapat 4 jenis layanan referensi yang dapat dimanfaatkan oleh pemustaka, yaitu:</p>\r\n<table width=\"633\">\r\n<tbody>\r\n<tr>\r\n<td width=\"47\">\r\n<p><strong>No.</strong></p>\r\n</td>\r\n<td width=\"274\">\r\n<p><strong>Nama Barang</strong></p>\r\n</td>\r\n<td width=\"133\">\r\n<p><strong>Lokasi</strong></p>\r\n</td>\r\n<td width=\"179\">\r\n<p><strong>Target Pemustaka</strong></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>1</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan meja informasi (reference desk)</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Anggota perpustakaan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>2</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan penelusuran</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Anggota perpustakaan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>3</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan bimbingan penggunaan koleksi referensi</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Anggota perpustakaan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>4</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan kesiagaan informasi</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Anggota perpustakaan</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li><strong>Layanan meja informasi (<em>reference desk</em>) </strong>adalah fasilitas perpustakaan yang memiliki fungsi memberikan informasi tentang produk, layanan dan fasilitas Perpustakaan Adyatama SMP Islam Al Azhar 26 Yogyakarta kepada pemustaka.</li>\r\n<li><strong>Layanan penelusuran </strong>adalah layanan yang disediakan oleh perpustakaan untuk membantu pemustaka menemukan informasi yang mereka butuhkan. Layanan ini didukung dengan sistem OPAC (<em>Online Public Access Catalogue</em>) atau dengan bantuan pustakawan</li>\r\n<li><strong>Layanan bimbingan pengguna koleksi referensi </strong>adalah layanan yang bertujuan untuk membantu pemustaka dalam menemukan dan menggunakan sumber referensi yang tepat, seperti kamus, ensiklopedia, dan direktori.</li>\r\n<li><strong>Layanan kesiagaan informasi </strong>adalah layanan yang memberikan informasi terbaru kepada pemustaka berupa daftar koleksi baru yang dimiliki oleh perpustakaan. Layanan ini memungkinkan pemustaka untuk tetap relevan dengan perkembangan informasi yang menjadi minat mereka.</li>\r\n</ul>', NULL, 101, '', 'page', 'publish', 'public', 'open', 'layanan-referensi-perpustakaan', NULL, 0, '2025-07-26 07:36:50', '2025-07-26 07:36:50', NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(15, 'Program Perpustakaan', '<p><strong>Gerakan Literasi Sekolah</strong></p>\r\n<p>Bertujuan untuk meningkatkan minat baca peserta didik, kegiatan ini dilaksanakan satu minggu sekali oleh setiap kelas pada hari P5. Kegiatan ini akan berisi serangkaian agenda seperti <em>game, </em>membaca bersama, menggambar, membuat resensi, dan agenda lainnya yang didampingi oleh guru/tenaga perpustakaan yang sedang bertugas.&nbsp; Dari kegiatan ini diharapkan murid dapat membuat sebuah karya literasi pada akhir tahun ajaran baru yang akan menjadi inventarisasi perpustakaan.</p>\r\n<p><strong>Lomba Pojok Literasi</strong></p>\r\n<p>Kegiatan ini bertujuan untuk meningkatkan minat baca murid dengan menghias dan merawat pojok literasi di titik yang akan ditentukan oleh tenaga perpustakaan. Setiap murid diminta membawa buku dari rumah untuk dipajang di rak pojok literasi, sehingga murid bertambah referensi membacanya. Kegiatan ini dimulai awal tahun pelajaran dan akan dinilai ketika bulan bahasa. Dari kegiatan ini diharapkan murid dapat memperluas referensi dalam membaca dengan bertukar buku di pojok literasi.</p>\r\n<p><strong>Pengadaan Koleksi Baru</strong></p>\r\n<p>Kegiatan ini bertujuan agar memudahkan semua warga sekolah mudah dalam mengakses buku digital. Buku digital bisa diakses melalui komputer yang ada di PSB atau perangkat pribadi yang dimiliki oleh pengunjung.&nbsp;</p>\r\n<p><strong>Studi Banding Perpustakaan</strong></p>\r\n<p>Kegiatan ini akan di laksanakan sebanyak 2 kali dalam setahun yang bertujuan untuk mengembangkan perpustakaan ke arah yang lebih baik dengan belajar dari perpustakaan-perpustakaan sekolah terbaik di sekitar D.I. Yogyakarta</p>', NULL, 101, '', 'page', 'publish', 'public', 'open', 'program-perpustakaan', NULL, 0, '2025-07-26 07:37:31', '2025-07-26 07:37:31', NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(16, 'Fasilitas Perpustakaan', '<p>ini isi fasilitas</p>', NULL, 101, '7', 'page', 'publish', 'public', 'open', 'fasilitas-perpustakaan', NULL, 0, '2025-07-26 07:37:57', '2025-07-30 19:23:20', NULL, NULL, NULL, 101, NULL, NULL, 'false'),
(17, 'tes saja', '<p>oke bos</p>', NULL, 101, '1', 'post', 'publish', 'public', 'open', 'tes-saja', NULL, 0, '2025-07-29 20:32:13', '2025-07-29 20:32:13', NULL, NULL, 101, NULL, NULL, NULL, 'false'),
(18, 'uyee lahh', '<p>cek</p>', NULL, 101, '4', 'post', 'publish', 'public', 'open', 'uyee-lahh', NULL, 0, '2025-07-29 20:32:30', '2025-07-29 20:32:30', NULL, NULL, 101, NULL, NULL, NULL, 'false'),
(19, 'Artikel 1', 'Konten artikel ke-1 lorem ipsum dolor sit amet.', 'artikel-1.jpg', 101, '1', 'post', 'publish', 'public', 'open', 'artikel-1', 'tag1,tag2', 5, '2025-07-30 03:35:37', '2025-07-30 18:48:21', NULL, NULL, 1, 101, NULL, NULL, 'false'),
(20, 'Artikel 2', 'Konten artikel ke-2 lorem ipsum dolor sit amet.', 'artikel-2.jpg', 1, '2', 'post', 'publish', 'public', 'open', 'artikel-2', 'tag1,tag3', 8, '2025-07-30 03:35:37', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'false'),
(21, 'Artikel 3', 'Konten artikel ke-3 lorem ipsum dolor sit amet.', 'artikel-3.jpg', 1, '3', 'post', 'draft', 'private', 'close', 'artikel-3', 'tag2,tag3', 3, '2025-07-30 03:35:37', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'false'),
(22, 'Artikel 4', 'Konten artikel ke-4 lorem ipsum dolor sit amet.', 'artikel-4.jpg', 2, '2', 'post', 'publish', 'public', 'open', 'artikel-4', 'tag4', 10, '2025-07-30 03:35:37', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'false'),
(23, 'Artikel 5', 'Konten artikel ke-5 lorem ipsum dolor sit amet.', 'artikel-5.jpg', 2, '1', 'post', 'publish', 'public', 'open', 'artikel-5', 'tag1', 15, '2025-07-30 03:35:37', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'false'),
(24, 'Artikel 6', 'Konten artikel ke-6 lorem ipsum dolor sit amet.', 'artikel-6.jpg', 3, '3', 'post', 'draft', 'private', 'close', 'artikel-6', 'tag5', 0, '2025-07-30 03:35:37', NULL, NULL, NULL, 3, NULL, NULL, NULL, 'false'),
(25, 'Artikel 7', 'Konten artikel ke-7 lorem ipsum dolor sit amet.', 'artikel-7.jpg', 3, '1', 'post', 'publish', 'public', 'open', 'artikel-7', 'tag6', 7, '2025-07-30 03:35:37', NULL, NULL, NULL, 3, NULL, NULL, NULL, 'false'),
(26, 'Artikel 8', 'Konten artikel ke-8 lorem ipsum dolor sit amet.', 'artikel-8.jpg', 1, '2', 'post', 'publish', 'public', 'open', 'artikel-8', 'tag1,tag7', 22, '2025-07-30 03:35:37', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'false'),
(27, 'Artikel 9', 'Konten artikel ke-9 lorem ipsum dolor sit amet.', 'artikel-9.jpg', 2, '1', 'post', 'publish', 'public', 'open', 'artikel-9', 'tag8', 30, '2025-07-30 03:35:37', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'false'),
(28, 'Artikel 10', 'Konten artikel ke-10 lorem ipsum dolor sit amet.', 'artikel-10.jpg', 2, '3', 'post', 'draft', 'private', 'close', 'artikel-10', 'tag9', 4, '2025-07-30 03:35:37', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'false'),
(29, 'Artikel 11', 'Konten artikel ke-11 lorem ipsum dolor sit amet.', 'artikel-11.jpg', 1, '1', 'post', 'publish', 'public', 'open', 'artikel-11', 'tag10', 2, '2025-07-30 03:35:37', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'false'),
(30, 'Artikel 12', 'Konten artikel ke-12 lorem ipsum dolor sit amet.', 'artikel-12.jpg', 1, '2', 'post', 'publish', 'public', 'open', 'artikel-12', 'tag11', 19, '2025-07-30 03:35:37', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'false'),
(31, 'Artikel 13', 'Konten artikel ke-13 lorem ipsum dolor sit amet.', 'artikel-13.jpg', 3, '3', 'post', 'publish', 'public', 'open', 'artikel-13', 'tag12', 6, '2025-07-30 03:35:37', NULL, NULL, NULL, 3, NULL, NULL, NULL, 'false'),
(32, 'Artikel 14', 'Konten artikel ke-14 lorem ipsum dolor sit amet.', 'artikel-14.jpg', 2, '1', 'post', 'draft', 'private', 'close', 'artikel-14', 'tag2,tag13', 1, '2025-07-30 03:35:37', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'false'),
(33, 'Artikel 15', 'Konten artikel ke-15 lorem ipsum dolor sit amet.', 'artikel-15.jpg', 2, '2', 'post', 'publish', 'public', 'open', 'artikel-15', 'tag3,tag14', 17, '2025-07-30 03:35:37', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'false'),
(34, 'Artikel 16', 'Konten artikel ke-16 lorem ipsum dolor sit amet.', 'artikel-16.jpg', 1, '2', 'post', 'publish', 'public', 'open', 'artikel-16', 'tag15', 12, '2025-07-30 03:35:37', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'false'),
(35, 'Artikel 17', 'Konten artikel ke-17 lorem ipsum dolor sit amet.', 'artikel-17.jpg', 3, '3', 'post', 'publish', 'public', 'open', 'artikel-17', 'tag5,tag16', 9, '2025-07-30 03:35:37', NULL, NULL, NULL, 3, NULL, NULL, NULL, 'false'),
(36, 'Artikel 18', 'Konten artikel ke-18 lorem ipsum dolor sit amet.', 'artikel-18.jpg', 2, '1', 'post', 'draft', 'private', 'close', 'artikel-18', 'tag17', 0, '2025-07-30 03:35:37', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'false'),
(37, 'Artikel 19', 'Konten artikel ke-19 lorem ipsum dolor sit amet.', 'artikel-19.jpg', 2, '2', 'post', 'publish', 'public', 'open', 'artikel-19', 'tag18', 13, '2025-07-30 03:35:37', NULL, NULL, NULL, 2, NULL, NULL, NULL, 'false'),
(38, 'Artikel 20', 'Konten artikel ke-20 lorem ipsum dolor sit amet.', 'artikel-20.jpg', 1, '1', 'post', 'publish', 'public', 'open', 'artikel-20', 'tag19', 25, '2025-07-30 03:35:37', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'false');

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
(1, 'Pendidikan merupakan tiket untuk masa depan. Hari esok untuk orang-orang yang telah mempersiapkan dirinya hari ini', 'Anonim', '2023-01-15 21:23:22', '2023-01-15 07:23:22', NULL, NULL, 1, 0, 0, 0, 'false'),
(2, 'Agama tanpa ilmu pengetahuan adalah buta. Dan ilmu pengetahuan tanpa agama adalah lumpuh', 'Anonim', '2023-01-15 21:23:22', '2023-01-15 07:23:22', NULL, NULL, 1, 0, 0, 0, 'false'),
(3, 'Hiduplah seakan-akan kau akan mati besok. Belajarlah seakan-akan kau akan hidup selamanya', 'Anonim', '2023-01-15 21:23:22', '2023-01-15 07:23:22', NULL, NULL, 1, 0, 0, 0, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `setting_group` varchar(100) NOT NULL,
  `setting_variable` varchar(255) DEFAULT NULL,
  `setting_value` text DEFAULT NULL,
  `setting_default_value` text DEFAULT NULL,
  `setting_access_group` varchar(255) DEFAULT NULL,
  `setting_description` varchar(255) DEFAULT NULL,
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
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_group`, `setting_variable`, `setting_value`, `setting_default_value`, `setting_access_group`, `setting_description`, `created_at`, `updated_at`, `deleted_at`, `restored_at`, `created_by`, `updated_by`, `deleted_by`, `restored_by`, `is_deleted`) VALUES
(1, 'general', 'site_maintenance', 'false', 'false', 'public', 'Pemeliharaan situs', '2023-01-15 21:23:22', '2025-07-22 13:45:33', NULL, NULL, 0, 101, 0, 0, 'false'),
(2, 'general', 'site_maintenance_end_date', '2025-07-27', '2022-01-01', 'public', 'Tanggal Berakhir Pemeliharaan Situs', '2023-01-15 21:23:22', '2025-07-22 13:50:33', NULL, NULL, 0, 101, 0, 0, 'false'),
(3, 'general', 'site_cache', 'false', 'false', 'public', 'Cache situs', '2023-01-15 21:23:22', '2024-11-30 12:02:18', NULL, NULL, 0, 101, 0, 0, 'false'),
(4, 'general', 'site_cache_time', '0', '10', 'public', 'Lama Cache Situs', '2023-01-15 21:23:22', '2024-11-30 12:02:10', NULL, NULL, 0, 101, 0, 0, 'false'),
(5, 'general', 'meta_description', 'Perpustakaan Adyatama adalah pusat literasi SMP Islam Al Azhar 26 Yogyakarta, yang menyediakan koleksi buku dan layanan informasi bagi siswa, guru, dan masyarakat.', 'CMS Sekolahku adalah Content Management System dan PPDB Online gratis untuk SD SMP/Sederajat SMA/Sederajat', 'public', 'Deskripsi Meta', '2023-01-15 21:23:22', '2025-07-31 01:14:23', NULL, NULL, 0, 101, 0, 0, 'false'),
(6, 'general', 'meta_keywords', 'SMP Islam Al Azhar 26 Yogyakarta', 'CMS, Website Sekolah Gratis, Cara Membuat Website Sekolah, membuat web sekolah, contoh website sekolah, fitur website sekolah, Sekolah, Website, Internet,Situs, CMS Sekolah, Web Sekolah, Website Sekolah Gratis, Website Sekolah, Aplikasi Sekolah, PPDB Online, PSB Online, PSB Online Gratis, Penerimaan Siswa Baru Online, Raport Online, Kurikulum 2013, SD, SMP, SMA, Aliyah, MTs, SMK', 'public', 'Kata Kunci Meta', '2023-01-15 21:23:22', '2025-07-21 23:16:33', NULL, NULL, 0, 1, 0, 0, 'false'),
(7, 'general', 'map_location', '--', '', 'public', 'Lokasi di Google Maps', '2023-01-15 21:23:22', '2025-07-22 11:28:25', NULL, NULL, 0, 1, 0, 0, 'false'),
(8, 'general', 'favicon', '1753184660_bd4542e35a1873b6a4ef.png', '740c0d7117e7d95b8d0491536aa12989.png', 'public', 'Favicon', '2023-01-15 21:23:22', '2025-07-22 11:44:20', NULL, NULL, 0, 0, 0, 0, 'false'),
(9, 'general', 'header', '1753185010_e3b1fec0a4dc946a443e.png', 'header.png', 'public', 'Gambar Header', '2023-01-15 21:23:22', '2025-07-22 11:50:10', NULL, NULL, 0, 0, 0, 0, 'false'),
(10, 'general', 'recaptcha_status', 'disable', 'disable', 'public', 'reCAPTCHA Status', '2023-01-15 21:23:22', '2025-07-22 13:48:05', NULL, NULL, 0, 1, 0, 0, 'false'),
(11, 'general', 'recaptcha_site_key', '6LcGFMkkAAAAAOvsTcA_Ie--CcuCCxqMnjXIcxrs', '6LeNCTAUAAAAAADTbL1rDw8GT1DF2DUjVtEXzdMu', 'public', 'Recaptcha Site Key', '2023-01-15 21:23:22', '2023-03-02 17:00:49', NULL, NULL, 0, 1, 0, 0, 'false'),
(12, 'general', 'recaptcha_secret_key', '6LcGFMkkAAAAAGMnRODvrFMZbyz2hfLj2FPpl8r0', '6LeNCTAUAAAAAGq8O0ItkzG8fsA9KeJ7mFMMFF1s', 'public', 'Recaptcha Secret Key', '2023-01-15 21:23:22', '2023-03-02 17:01:06', NULL, NULL, 0, 1, 0, 0, 'false'),
(13, 'general', 'timezone', 'Asia/Jakarta', 'Asia/Jakarta', 'public', 'Time Zone', '2023-01-15 21:23:22', '2025-07-22 13:48:35', NULL, NULL, 0, 0, 0, 0, 'false'),
(14, 'media', 'file_allowed_types', 'jpg, jpeg, png, gif, svg', 'jpg, jpeg, png, gif', 'public', 'Tipe file yang diizinkan', '2023-01-15 21:23:22', '2024-01-01 16:19:04', NULL, NULL, 0, 102, 0, 0, 'false'),
(15, 'media', 'upload_max_filesize', NULL, '0', 'public', 'Maksimal Ukuran File yang Diupload', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(16, 'media', 'thumbnail_size_height', NULL, '100', 'public', 'Tinggi Gambar Thumbnail', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(17, 'media', 'thumbnail_size_width', NULL, '150', 'public', 'Lebar Gambar Thumbnail', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(18, 'media', 'medium_size_height', NULL, '308', 'public', 'Tinggi Gambar Sedang', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(19, 'media', 'medium_size_width', NULL, '460', 'public', 'Lebar Gambar Sedang', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(20, 'media', 'large_size_height', NULL, '600', 'public', 'Tinggi Gambar Besar', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(21, 'media', 'large_size_width', NULL, '800', 'public', 'Lebar Gambar Besar', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(22, 'media', 'album_cover_height', NULL, '250', 'public', 'Tinggi Cover Album Foto', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(23, 'media', 'album_cover_width', NULL, '400', 'public', 'Lebar Cover Album Foto', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(24, 'media', 'banner_height', NULL, '81', 'public', 'Tinggi Iklan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(25, 'media', 'banner_width', NULL, '245', 'public', 'Lebar Iklan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(26, 'media', 'image_slider_height', '400', '400', 'public', 'Tinggi Gambar Slide', '2023-01-15 21:23:22', '2024-04-30 15:08:31', NULL, NULL, 0, 101, 0, 0, 'false'),
(27, 'media', 'image_slider_width', '800', '900', 'public', 'Lebar Gambar Slide', '2023-01-15 21:23:22', '2024-01-01 15:33:14', NULL, NULL, 0, 102, 0, 0, 'false'),
(28, 'media', 'student_photo_height', NULL, '400', 'public', 'Tinggi Photo Peserta Didik', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(29, 'media', 'student_photo_width', NULL, '300', 'public', 'Lebar Photo Peserta Didik', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(30, 'media', 'employee_photo_height', NULL, '400', 'public', 'Tinggi Photo Guru dan Tenaga Kependidikan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(31, 'media', 'employee_photo_width', NULL, '300', 'public', 'Lebar Photo Guru dan Tenaga Kependidikan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(32, 'media', 'headmaster_photo_height', NULL, '400', 'public', 'Tinggi Photo Kepala Sekolah', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(33, 'media', 'headmaster_photo_width', NULL, '300', 'public', 'Lebar Photo Kepala Sekolah', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(34, 'media', 'header_height', NULL, '80', 'public', 'Tinggi Gambar Header', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(35, 'media', 'header_width', NULL, '200', 'public', 'Lebar Gambar Header', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(36, 'media', 'logo_height', '192', '120', 'public', 'Tinggi Logo Sekolah', '2023-01-15 21:23:22', '2024-01-01 16:23:12', NULL, NULL, 0, 102, 0, 0, 'false'),
(37, 'media', 'logo_width', '200', '120', 'public', 'Lebar Logo Sekolah', '2023-01-15 21:23:22', '2024-01-01 16:22:32', NULL, NULL, 0, 102, 0, 0, 'false'),
(38, 'writing', 'default_post_category', NULL, '1', 'public', 'Default Kategori Tulisan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(39, 'writing', 'default_post_status', 'draft', 'publish', 'public', 'Default Status Tulisan', '2023-01-15 21:23:22', '2024-08-10 15:50:46', NULL, NULL, 0, 101, 0, 0, 'false'),
(40, 'writing', 'default_post_visibility', 'private', 'public', 'public', 'Default Akses Tulisan', '2023-01-15 21:23:22', '2024-08-10 15:50:52', NULL, NULL, 0, 101, 0, 0, 'false'),
(41, 'writing', 'default_post_discussion', 'open', 'open', 'public', 'Default Komentar Tulisan', '2023-01-15 21:23:22', '2024-08-10 15:50:59', NULL, NULL, 0, 101, 0, 0, 'false'),
(42, 'writing', 'post_image_thumbnail_height', NULL, '100', 'public', 'Tinggi Gambar Kecil', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(43, 'writing', 'post_image_thumbnail_width', NULL, '150', 'public', 'Lebar Gambar Kecil', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(44, 'writing', 'post_image_medium_height', NULL, '250', 'public', 'Tinggi Gambar Sedang', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(45, 'writing', 'post_image_medium_width', NULL, '400', 'public', 'Lebar Gambar Sedang', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(46, 'writing', 'post_image_large_height', NULL, '450', 'public', 'Tinggi Gambar Besar', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(47, 'writing', 'post_image_large_width', NULL, '840', 'public', 'Lebar Gambar Besar', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(48, 'reading', 'post_per_page', '6', '10', 'public', 'Tulisan per halaman', '2023-01-15 21:23:22', '2025-07-30 03:36:50', NULL, NULL, 0, 101, 0, 0, 'false'),
(49, 'reading', 'post_rss_count', '100', '10', 'public', 'Jumlah RSS', '2023-01-15 21:23:22', '2024-08-04 13:35:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(50, 'reading', 'post_related_count', '5', '10', 'public', 'Jumlah Tulisan Terkait', '2023-01-15 21:23:22', '2023-03-05 03:31:59', NULL, NULL, 0, 1, 0, 0, 'false'),
(51, 'reading', 'comment_per_page', NULL, '10', 'public', 'Komentar per halaman', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(52, 'discussion', 'comment_moderation', 'true', 'false', 'public', 'Komentar harus disetujui secara manual', '2023-01-15 21:23:22', '2024-08-04 14:24:49', NULL, NULL, 0, 101, 0, 0, 'false'),
(53, 'discussion', 'comment_registration', NULL, 'false', 'public', 'Pengguna harus terdaftar dan login untuk komentar', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(54, 'discussion', 'comment_blacklist', NULL, 'kampret', 'public', 'Komentar disaring', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(55, 'discussion', 'comment_order', NULL, 'asc', 'public', 'Urutan Komentar', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(56, 'social_account', 'facebook', 'https://www.facebook.com/profile.php?id=61564945235765', '', 'public', 'Facebook', '2023-01-15 21:23:22', '2025-02-15 23:27:15', NULL, NULL, 0, 101, 0, 0, 'false'),
(57, 'social_account', 'twitter', NULL, '', 'public', 'Twitter', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(58, 'social_account', 'tiktok', 'https://www.tiktok.com/@smkn1temon.official', '', 'public', 'Tiktok', '2023-01-15 21:23:22', '2025-06-25 13:49:47', NULL, NULL, 0, 101, 0, 0, 'false'),
(59, 'social_account', 'youtube', 'https://www.youtube.com/@smkn1temon.official', '', 'public', 'Youtube', '2023-01-15 21:23:22', '2024-05-01 11:49:25', NULL, NULL, 0, 101, 0, 0, 'false'),
(60, 'social_account', 'instagram', 'https://www.instagram.com/smkn1temon.official/', '', 'public', 'Instagram', '2023-01-15 21:23:22', '2023-03-01 17:38:33', NULL, NULL, 0, 1, 0, 0, 'false'),
(61, 'mail_server', 'smtp_host', 'smtp.gmail.com', '', 'private', 'SMTP Server Address', '2023-01-15 21:23:22', '2024-08-03 15:06:57', NULL, NULL, 0, 101, 0, 0, 'false'),
(62, 'mail_server', 'smtp_user', 'humas@smkn1temon.sch.id', '', 'private', 'SMTP Username', '2023-01-15 21:23:22', '2024-08-03 15:07:09', NULL, NULL, 0, 101, 0, 0, 'false'),
(63, 'mail_server', 'smtp_pass', 'k3l4ut4n', '', 'private', 'SMTP Password', '2023-01-15 21:23:22', '2024-08-03 15:07:17', NULL, NULL, 0, 101, 0, 0, 'false'),
(64, 'mail_server', 'smtp_port', '465', '', 'public', 'SMTP Port', '2023-01-15 21:23:22', '2024-08-03 15:07:34', NULL, NULL, 0, 101, 0, 0, 'false'),
(65, 'school_profile', 'npsn', '20402816', '123', 'public', 'NPSN', '2023-01-15 21:23:22', '2023-02-28 15:41:20', NULL, NULL, 0, 1, 0, 0, 'false'),
(66, 'school_profile', 'school_name', 'SMK Negeri 1 Temon', 'SMKN 1 Temon', 'public', 'Nama Sekolah', '2023-01-15 21:23:22', '2025-07-22 12:13:25', NULL, NULL, 0, 1, 0, 0, 'false'),
(67, 'school_profile', 'nama_perpus', 'Perpustakaan Adiayatama', 'Perpustakaan', 'public', 'Nama Perpustakaan', NULL, '2025-07-22 12:14:00', NULL, NULL, 0, 0, 0, 0, 'false'),
(68, 'school_profile', 'npp', '01234', '0123456789', 'public', 'NPP', NULL, '2025-07-22 12:14:54', NULL, NULL, 0, 0, 0, 0, 'false'),
(74, 'school_profile', 'tagline', 'Jalan Glagah, Kalidengen, Temon, Kulon Progo, D.I. Yogyakarta', 'Kompeten, Berprestasi', 'public', 'Slogan', '2023-01-15 21:23:22', '2025-07-22 12:13:40', NULL, NULL, 0, 1, 0, 0, 'false'),
(75, 'school_profile', 'rt', '0', '12', 'public', 'RT', '2023-01-15 21:23:22', '2023-02-28 15:42:04', NULL, NULL, 0, 1, 0, 0, 'false'),
(76, 'school_profile', 'rw', '0', '06', 'public', 'RW', '2023-01-15 21:23:22', '2023-02-28 15:42:08', NULL, NULL, 0, 1, 0, 0, 'false'),
(77, 'school_profile', 'sub_village', 'Glagah', 'Wage', 'public', 'Dusun', '2023-01-15 21:23:22', '2023-02-28 15:43:13', NULL, NULL, 0, 1, 0, 0, 'false'),
(78, 'school_profile', 'village', 'Kalidengen', 'Kadugede', 'public', 'Kelurahan / Desa', '2023-01-15 21:23:22', '2023-02-28 15:44:06', NULL, NULL, 0, 1, 0, 0, 'false'),
(79, 'school_profile', 'sub_district', 'Temon', 'Kadugede', 'public', 'Kecamatan', '2023-01-15 21:23:22', '2025-01-18 09:50:50', NULL, NULL, 0, 101, 0, 0, 'false'),
(80, 'school_profile', 'district', 'Kulon Progo', 'Kuningan', 'public', 'Kota/Kabupaten', '2023-01-15 21:23:22', '2023-02-28 15:40:54', NULL, NULL, 0, 1, 0, 0, 'false'),
(81, 'school_profile', 'postal_code', '55654', '45561', 'public', 'Kode Pos', '2023-01-15 21:23:22', '2023-02-28 15:41:57', NULL, NULL, 0, 1, 0, 0, 'false'),
(82, 'school_profile', 'street_address', 'Jalan Glagah', 'Jalan Raya Kadugede No. 11', 'public', 'Alamat Jalan', '2023-01-15 21:23:22', '2025-01-18 09:50:59', NULL, NULL, 0, 101, 0, 0, 'false'),
(83, 'school_profile', 'phone', '-', '0232123456', 'public', 'Telepon', '2023-01-15 21:23:22', '2025-01-18 09:51:27', NULL, NULL, 0, 101, 0, 0, 'false'),
(84, 'school_profile', 'fax', '-', '0232123456', 'public', 'Fax', '2023-01-15 21:23:22', '2023-02-28 15:41:10', NULL, NULL, 0, 1, 0, 0, 'false'),
(85, 'school_profile', 'email', 'smkn1temon@yahoo.com', 'info@sman9kuningan.sch.id', 'public', 'Email', '2023-01-15 21:23:22', '2025-01-18 09:51:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(86, 'school_profile', 'website', 'https://smkn1temon.sch.id/', 'http://www.sman9kuningan.sch.id', 'public', 'Website', '2023-01-15 21:23:22', '2024-01-01 16:18:33', NULL, NULL, 0, 102, 0, 0, 'false'),
(87, 'school_profile', 'logo', '1753185705_3072a4a125b8be4786b6.png', 'logo.png', 'public', 'Logo', '2023-01-15 21:23:22', '2025-07-22 12:01:45', NULL, NULL, 0, 0, 0, 0, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `submenus`
--

CREATE TABLE `submenus` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `order_num` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `submenus`
--

INSERT INTO `submenus` (`id`, `menu_id`, `title`, `url`, `order_num`, `is_active`) VALUES
(7, 7, 'Informasi Perpustakaan', 'categories/informasi', 1, 1),
(8, 7, 'Berita Perpustakaan', 'categories/berita', 2, 1),
(9, 6, 'Galeri Foto', 'galeri-foto', 1, 1),
(10, 6, 'Galeri Video', 'galeri-video', 2, 1),
(19, 5, 'Visi Misi Perpustakaan', 'page/visi-misi-perpustakaan', 1, 1),
(20, 5, 'Sejarah Perpustakaan', 'page/sejarah-perpustakaan', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_full_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_url` varchar(100) DEFAULT NULL,
  `user_bio` varchar(200) DEFAULT NULL,
  `user_contact` varchar(100) DEFAULT NULL,
  `user_group_id` bigint(20) DEFAULT 0,
  `user_type` enum('super_user','administrator','employee','student') NOT NULL DEFAULT 'administrator',
  `user_profile_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'student_id OR employee_id',
  `user_biography` text DEFAULT NULL,
  `user_forgot_password_key` varchar(100) DEFAULT NULL,
  `user_forgot_password_request_date` date DEFAULT NULL,
  `has_login` enum('true','false') DEFAULT 'false',
  `last_logged_in` datetime DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_password`, `user_full_name`, `user_email`, `user_url`, `user_bio`, `user_contact`, `user_group_id`, `user_type`, `user_profile_id`, `user_biography`, `user_forgot_password_key`, `user_forgot_password_request_date`, `has_login`, `last_logged_in`, `ip_address`, `created_at`, `updated_at`, `deleted_at`, `restored_at`, `created_by`, `updated_by`, `deleted_by`, `restored_by`, `is_deleted`) VALUES
(2, 'rutiani', '$2y$10$4F.UwRhQM1ipecB47I3hmOj8.ZoB/JwsMxNe6rwGjzyutPj4cLhdG', 'Rutiani, S.Pd.', 'rutiani58@guru.smk.belajar.id', NULL, '', '', 1, 'administrator', NULL, '', NULL, NULL, 'true', '2024-08-03 19:05:45', '125.163.149.96', '2023-10-16 21:08:47', '2024-08-03 12:05:45', NULL, NULL, 1, 0, 0, 0, 'false'),
(101, 'smkn1temon', '$2y$10$4F.UwRhQM1ipecB47I3hmOj8.ZoB/JwsMxNe6rwGjzyutPj4cLhdG', 'Administrator', 'admin@admin.com', 'sekolahku.web.id', '', '', 0, 'super_user', NULL, NULL, NULL, NULL, 'true', '2025-07-31 01:03:32', '::1', '2023-01-15 21:23:22', '2025-07-30 18:03:32', NULL, NULL, 0, 1, 0, 0, 'false'),
(102, 'humaskelautan', '$2y$10$4F.UwRhQM1ipecB47I3hmOj8.ZoB/JwsMxNe6rwGjzyutPj4cLhdG', 'Humas SMKN 1 Temon', 'humassmkntemon@gmail.com', NULL, '', '', 1, 'super_user', NULL, '', NULL, NULL, 'true', '2024-08-14 19:24:04', '36.80.221.120', '2023-12-21 13:22:54', '2024-08-14 12:24:04', NULL, NULL, 101, 0, 0, 0, 'false'),
(104, 'hanagri', '$2y$10$3q8O6LrBcoPnrGYTk8fpg.Kg5Xk6Wdm5urNTHM6K/sTGnEZvpFb8u', 'Hanagri Gantyan Wangi, S.Pd.', 'hanagri@smkn1temon.sch.id', NULL, '', '', 1, 'administrator', NULL, '', NULL, NULL, 'true', '2024-08-03 23:01:43', '125.163.149.96', '2024-08-03 23:01:10', '2024-08-03 16:01:43', NULL, NULL, 101, 0, 0, 0, 'false'),
(105, 'rezamahardika', '$2y$10$qKz24iqzy0wdXGHd0Cat3.AP1x4zSLPclqUM88OOwjR1L9C9a.nQy', 'REZA MERDHIKAWATI, S.Pd.', 'rezamahardika@smkn1temon.sch.id', 'https://smkn1temon.sch.id/media_library/employees/110a840e144ae7cba2dc467a16b58c5b.jpg', '', '', 1, 'employee', 104, NULL, NULL, NULL, 'true', '2024-11-26 10:17:19', '103.210.35.120', '2024-08-10 21:08:22', '2024-11-26 03:17:19', NULL, NULL, 101, 101, 0, 0, 'false'),
(106, '197702072006042003', '$2y$10$WXzxYA9BNmP67h6eo//dcOvUwrtuKDF9QBA7ZQERWTZOZRH4t6Vom', 'ANTI UKI NUSANTARI, S.Th', '197702072006042003@smkn1temon.sch.id', NULL, '', '', 0, 'employee', 64, NULL, NULL, NULL, 'false', NULL, NULL, '2025-02-22 08:07:07', '2025-02-22 01:07:07', NULL, NULL, 101, 0, 0, 0, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text NOT NULL,
  `visited_at` datetime NOT NULL,
  `path_visited` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip_address`, `user_agent`, `visited_at`, `path_visited`, `created_at`, `updated_at`) VALUES
(12, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-29 00:00:00', NULL, '2025-07-29 02:20:57', '2025-07-29 02:20:57'),
(13, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-30 02:33:41', NULL, '2025-07-30 02:33:41', '2025-07-30 02:33:41'),
(14, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-31 00:34:10', NULL, '2025-07-31 00:34:10', '2025-07-31 00:34:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
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
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submenus`
--
ALTER TABLE `submenus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `submenus`
--
ALTER TABLE `submenus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `submenus`
--
ALTER TABLE `submenus`
  ADD CONSTRAINT `submenus_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
