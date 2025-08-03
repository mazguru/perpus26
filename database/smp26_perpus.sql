-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 03, 2025 at 05:20 PM
-- Server version: 10.11.11-MariaDB-log
-- PHP Version: 8.3.20

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
(1, 'Prestasi', 'Menampilkan foto Prestasi Siswa', 'prestasi', '1753970563_5dcec381ff8016b84beb.jpg', '2025-01-18 16:57:04', '2025-08-03 15:05:57', '2025-07-27 10:58:00', '2025-07-27 12:26:53', 101, 110, 101, 101, 'false');

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
  `category_type` enum('post','file','page','profil','layanan') DEFAULT 'post',
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
(3, 'Artikel', 'artikel', 'Artikel', 'post', NULL, '2023-03-05 03:06:30', NULL, NULL, 1, 1, 0, 0, 'false'),
(4, 'Pengumuman', 'pengumuman', 'Pengumuman dan Agenda', 'post', NULL, '2025-07-31 11:21:40', NULL, NULL, 1, 102, 0, 0, 'false'),
(5, 'Agenda', 'agenda', 'Agenda', 'post', NULL, '2024-01-01 16:05:46', NULL, NULL, 102, 0, 0, 0, 'false'),
(7, 'Profil', 'profil', 'Profil Perpustakaan Adyatama', 'page', NULL, '2025-07-31 14:03:50', NULL, NULL, 0, 0, 0, 0, 'false'),
(10, 'Layanan', 'layanan', 'Layanan Perpustakaan', 'page', NULL, '2025-07-31 14:03:38', NULL, NULL, 0, 0, 0, 0, 'false');

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
(12, 57, 'bakhtiar', 'humas@info.net', 'null', '::1', 'mantap al azhar', NULL, 'oke', 'approved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'post', '2025-08-02 05:05:54', '2025-08-02 01:23:28', NULL, NULL, 0, 108, 0, 0, 'false'),
(17, 57, 'tes komen', 'a@a.net', 'null', '::1', 'Tes Komentar', NULL, 'null', 'spam', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'post', '2025-08-02 05:13:55', '2025-08-02 01:26:28', NULL, NULL, 0, 108, 0, 0, 'false'),
(18, 57, 'Guest', 'guest@example.com', NULL, '::1', 'tes', NULL, NULL, 'unapproved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '17', 'post', '2025-08-02 05:22:30', '2025-08-01 22:22:30', NULL, NULL, 0, 0, 0, 0, 'false'),
(23, 57, 'ds', 'hh@mail.net', NULL, '::1', 'dsds', NULL, NULL, 'approved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'post', '2025-08-02 07:11:42', '2025-08-02 00:11:42', NULL, NULL, 0, 0, 0, 0, 'false'),
(30, 57, 'ahmad', 'ds@mail.net', NULL, '::1', 'tes', NULL, NULL, 'approved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'post', '2025-08-02 07:34:27', '2025-08-02 00:34:27', NULL, NULL, 0, 0, 0, 0, 'false'),
(31, 57, 'aa', 'tes@m.net', 'null', '::1', 'tes', NULL, 'null', 'spam', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'post', '2025-08-02 07:42:21', '2025-08-02 01:26:34', NULL, NULL, 0, 108, 0, 0, 'false'),
(32, 57, 'ahmad', 'ss@d.net', NULL, '::1', 'tes lagi', NULL, NULL, 'unapproved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'post', '2025-08-02 07:45:56', '2025-08-02 00:45:56', NULL, NULL, 0, 0, 0, 0, 'false'),
(33, 57, 'Guest', 'guest@example.com', NULL, '::1', 'oyee', NULL, NULL, 'unapproved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '31', 'post', '2025-08-02 07:51:15', '2025-08-02 00:51:15', NULL, NULL, 0, 0, 0, 0, 'false'),
(34, 57, 'dsd', 'bb@miall.net', NULL, '::1', 'lagi', NULL, NULL, 'unapproved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'post', '2025-08-02 07:52:32', '2025-08-02 00:52:32', NULL, NULL, 0, 0, 0, 0, 'false'),
(35, 57, 'rty', 'mail@m.net', NULL, '::1', 'rtty', NULL, NULL, 'unapproved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'post', '2025-08-02 07:52:45', '2025-08-02 00:52:45', NULL, NULL, 0, 0, 0, 0, 'false'),
(38, 0, 'cyberpanel', 'humas@smkn1temon.sch.id', '', '::1', 'haksueahkbvds kjshdjldjfkl;jsbhdkjdjfjlkjbjbjbfkdf', 'g', NULL, 'unapproved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'message', '2025-08-02 11:05:36', '2025-08-02 04:05:36', NULL, NULL, 0, 0, 0, 0, 'false'),
(39, 0, 'fgfgf', 'humas@smkn1temon.sch.id', 'http://localhost:8080/', '::1', 'coba kirim pesan saja sih ini ya pokonya kirimcoba kirim pesan saja sih ini ya pokonya kirimcoba kirim pesan saja sih ini ya pokonya kirim', 'fg', NULL, 'unapproved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'message', '2025-08-02 11:39:54', '2025-08-02 04:39:54', NULL, NULL, 0, 0, 0, 0, 'false'),
(40, 0, 'fgfgf', 'datacenter@smkn1temon.sch.id', 'http://localhost:8080/', '::1', 'flex items-center space-x-3flex items-center space-x-3flex items-center space-x-3flex items-center space-x-3flex items-center space-x-3', 'g', NULL, 'unapproved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'message', '2025-08-02 11:46:12', '2025-08-02 04:46:12', NULL, NULL, 0, 0, 0, 0, 'false'),
(41, 42, 'bakhtiar', 'bakhtiarsma@gmail.com', NULL, '::1', 'ike gess', NULL, NULL, 'unapproved', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', NULL, 'post', '2025-08-03 04:07:37', '2025-08-02 21:07:37', NULL, NULL, 0, 0, 0, 0, 'false');

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
(44, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-27 08:58:00', '2025-07-27 08:58:00'),
(45, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-27 21:25:01', '2025-07-27 21:25:01'),
(46, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'fail', '2025-07-28 06:34:31', '2025-07-28 06:34:31'),
(47, 'smkn1temon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-28 06:34:37', '2025-07-28 06:34:37'),
(48, 'admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-28 23:03:15', '2025-07-28 23:03:15'),
(49, 'admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-29 09:09:13', '2025-07-29 09:09:13'),
(50, 'admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-30 07:40:24', '2025-07-30 07:40:24'),
(51, 'admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-30 16:18:56', '2025-07-30 16:18:56'),
(52, 'admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-30 16:28:43', '2025-07-30 16:28:43'),
(53, 'admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-07-31 09:32:27', '2025-07-31 09:32:27'),
(54, 'admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'fail', '2025-08-01 12:39:54', '2025-08-01 12:39:54'),
(55, 'admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-08-01 12:39:59', '2025-08-01 12:39:59'),
(56, 'admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-08-01 14:56:38', '2025-08-01 14:56:38'),
(57, 'admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-08-02 03:48:22', '2025-08-02 03:48:22'),
(58, 'admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-08-02 11:46:46', '2025-08-02 11:46:46'),
(59, 'admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-08-02 15:33:25', '2025-08-02 15:33:25'),
(60, 'ruri', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-08-02 18:21:48', '2025-08-02 18:21:48'),
(61, 'admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-08-03 04:10:19', '2025-08-03 04:10:19'),
(62, 'ruri', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'success', '2025-08-03 04:11:06', '2025-08-03 04:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_title` varchar(150) NOT NULL,
  `menu_url` varchar(150) NOT NULL,
  `menu_target` enum('_blank','_self','_parent','_top') DEFAULT '_self',
  `menu_type` varchar(100) NOT NULL DEFAULT 'pages',
  `menu_parent_id` bigint(20) DEFAULT 0,
  `menu_position` bigint(20) DEFAULT 0,
  `is_actived` bigint(20) NOT NULL DEFAULT 1,
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
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_title`, `menu_url`, `menu_target`, `menu_type`, `menu_parent_id`, `menu_position`, `is_actived`, `created_at`, `updated_at`, `deleted_at`, `restored_at`, `created_by`, `updated_by`, `deleted_by`, `restored_by`, `is_deleted`) VALUES
(45, 'Beranda', '/', '_self', 'pages', 0, 1, 1, '2025-08-03 17:44:17', '2025-08-03 10:44:17', NULL, NULL, 0, 0, 0, 0, 'false'),
(46, 'Profil', '#', '_self', 'pages', 0, 2, 1, '2025-08-03 17:46:43', '2025-08-03 10:46:43', NULL, NULL, 0, 0, 0, 0, 'false'),
(47, 'Visi Misi Perpustakaan', 'page/visi-misi-perpustakaan', '_self', 'pages', 46, 0, 1, '2025-08-03 17:54:03', '2025-08-03 10:54:03', NULL, NULL, 0, 0, 0, 0, 'false'),
(48, 'Galeri', '#', '_self', 'pages', 0, 5, 1, '2025-08-03 19:40:02', '2025-08-03 12:40:02', NULL, NULL, 0, 0, 0, 0, 'false'),
(49, 'Informasi', '#', '_self', 'pages', 0, 6, 1, '2025-08-03 19:40:25', '2025-08-03 12:40:25', NULL, NULL, 0, 0, 0, 0, 'false'),
(50, 'AKREVA', '#', '_self', 'pages', 0, 7, 1, '2025-08-03 19:40:53', '2025-08-03 12:40:53', NULL, NULL, 0, 0, 0, 0, 'false'),
(51, 'Slims ', 'https://perpustakaan.smkn1temon.sch.id/slims', '_blank', 'link', 0, 8, 1, '2025-08-03 19:41:50', '2025-08-03 12:41:50', NULL, NULL, 0, 0, 0, 0, 'false'),
(52, 'Hubungi Kami', 'hubungi-kami', '_self', 'pages', 0, 9, 1, '2025-08-03 19:42:29', '2025-08-03 16:41:41', NULL, NULL, 0, 0, 0, 0, 'false'),
(54, 'Struktur Organisasi Perpustakaan', 'page/struktur-organisasi-perpustakaan', '_self', 'pages', 46, 3, 1, '2025-08-03 21:29:15', '2025-08-03 14:29:15', NULL, NULL, 0, 0, 0, 0, 'false'),
(55, 'Tenaga Perpustakaan', 'page/tenaga-perpustakaan', '_self', 'pages', 46, 4, 1, '2025-08-03 21:29:23', '2025-08-03 14:29:23', NULL, NULL, 0, 0, 0, 0, 'false'),
(56, 'Program & Layanan', '#', '_self', 'pages', 0, 3, 1, '2025-08-03 21:29:45', '2025-08-03 14:29:45', NULL, NULL, 0, 0, 0, 0, 'false'),
(57, 'Layanan Perpustakaan', 'page/layanan-perpustakaan', '_self', 'pages', 56, 1, 1, '2025-08-03 21:29:53', '2025-08-03 14:29:53', NULL, NULL, 0, 0, 0, 0, 'false'),
(58, 'Layanan Referensi', 'page/layanan-referensi', '_self', 'pages', 56, 2, 1, '2025-08-03 21:30:03', '2025-08-03 14:30:03', NULL, NULL, 0, 0, 0, 0, 'false'),
(59, 'Program Perpustakaan', 'page/program-perpustakaan', '_self', 'pages', 56, 3, 1, '2025-08-03 21:30:12', '2025-08-03 14:30:12', NULL, NULL, 0, 0, 0, 0, 'false'),
(60, 'Galeri Foto', 'galeri-foto', '_self', 'pages', 48, 1, 1, '2025-08-03 21:44:22', '2025-08-03 15:25:45', NULL, NULL, 0, 0, 0, 0, 'false'),
(61, 'Galeri Video', 'galeri-video', '_self', 'pages', 48, 2, 1, '2025-08-03 21:44:44', '2025-08-03 15:25:51', NULL, NULL, 0, 0, 0, 0, 'false'),
(62, 'Informasi Perpustakaan', 'categories/informasi', '_self', 'pages', 49, 1, 1, '2025-08-04 00:19:19', '2025-08-03 17:19:19', NULL, NULL, 0, 0, 0, 0, 'false'),
(63, 'Berita Perpustakaan', 'categories/berita', '_self', 'pages', 49, 2, 1, '2025-08-04 00:19:41', '2025-08-03 17:19:41', NULL, NULL, 0, 0, 0, 0, 'false');

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
  `photo_album_id` bigint(20) UNSIGNED DEFAULT NULL,
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
(1, 1, '1754069344_a5e7923a0a09c5bc41b8.jpg', '2025-08-01 17:29:04', '2025-08-01 17:29:04', NULL, NULL, 108, 0, 0, 0, 'false'),
(2, 1, '1754069356_b03b9ce0529e0e56ee47.jpg', '2025-08-01 17:29:16', '2025-08-01 17:29:16', NULL, NULL, 108, 0, 0, 0, 'false');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 CHECKSUM=1 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_title`, `post_content`, `post_image`, `post_author`, `post_categories`, `post_type`, `post_status`, `post_visibility`, `post_comment_status`, `post_slug`, `post_tags`, `post_counter`, `created_at`, `updated_at`, `deleted_at`, `restored_at`, `created_by`, `updated_by`, `deleted_by`, `restored_by`, `is_deleted`) VALUES
(53, 'Hiraeth Graduation angkatan 10', 'ia5U5LEBoyg', NULL, 108, NULL, 'video', NULL, NULL, NULL, 'hiraeth-graduation-angkatan-10', NULL, 0, '2025-08-01 10:07:13', '2025-08-01 10:07:13', NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(54, 'Pelajar Pancasila', 'prcqRwylov4', NULL, 108, NULL, 'video', NULL, NULL, NULL, 'pelajar-pancasila', NULL, 0, '2025-08-01 10:08:27', '2025-08-01 10:08:27', NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(55, 'Pring Pring Pringisan SMP Islam Al Azhar 26 Yogyakarta', 'XU7Y6j15zQM', NULL, 108, NULL, 'video', NULL, NULL, NULL, 'pring-pring-pringisan-smp-islam-al-azhar-26-yogyakarta', NULL, 0, '2025-08-01 10:09:36', '2025-08-01 10:09:36', NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(57, 'Visi Misi Perpustakaan', '<h2><strong>VISI</strong></h2>\r\n<p>Terwujudnya Perpustakaan Sekolah Sebagai Pengembangan Minat dan Gemar Membaca serta Pusat Layanan Informasi Bagi Warga Sekolah</p>\r\n<p>&nbsp;</p>\r\n<h2><strong>MISI</strong></h2>\r\n<ol>\r\n<li>Meningkatkan minat baca guna mewujudkan generasi yang kreatif menggali ilmu dengan membudayakan membaca</li>\r\n<li>Menyediakan berbagai koleksi bacaan untuk mengembangkan pengetahuan</li>\r\n<li>Menjadikan perpustakaan sebagai jantungnya sekolah</li>\r\n<li>Mengembangkan perpustakaan berbasis teknologi informasi</li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<h2><strong>TUJUAN</strong></h2>\r\n<ol>\r\n<li>Menumbuhkan minat baca siswa melalui kegiatan literasi informasi</li>\r\n<li>Mengembangkan potensi siswa melalui kegiatan kreativitas yang dapat menumbuhkan jiwa ingin tahu terhadap budaya dan keterampilan khusus</li>\r\n<li>Membangun budaya belajar sesama siswa melalui kegiatan pembiasaan membaca dan menulis</li>\r\n<li>Berperan sebagai pusat informasi yang mampu menyediakan berbagai sumber informasi bagi seluruh warga sekolah, baik digital maupun cetak</li>\r\n<li>Berperan sebagai jantung literasi informasi sekolah dengan menyediakan wadah bagi warga sekolah dalam memupuk dan meningkatkan minat dan baka</li>\r\n<li>Mengintegrasikan literasi dasar (baca-tulis, numerasi, sauns, digital, finansial, budaya dan kewargaan) dalam kegiatan belajar mengajar</li>\r\n</ol>', NULL, 108, '7', 'page', 'publish', 'public', 'open', 'visi-misi-perpustakaan', NULL, 0, '2025-08-01 21:57:26', '2025-08-01 21:57:26', NULL, NULL, 108, NULL, NULL, NULL, 'false'),
(58, 'Pentingnya Perpustakaan Sekolah sebagai Pusat Literasi', '<p data-start=\"164\" data-end=\"393\">Perpustakaan sekolah memiliki peran yang sangat penting dalam mendukung proses belajar mengajar. Lebih dari sekadar tempat menyimpan buku, perpustakaan menjadi pusat literasi, kreativitas, dan pengembangan karakter peserta didik.</p>\r\n<p data-start=\"395\" data-end=\"654\">Di era digital ini, perpustakaan tidak hanya menyediakan koleksi buku cetak, tetapi juga akses ke berbagai sumber informasi daring, jurnal, dan e-book. Hal ini memungkinkan siswa untuk memperluas wawasan dan berpikir kritis dalam menyikapi berbagai informasi.</p>\r\n<p data-start=\"656\" data-end=\"882\">Selain itu, berbagai kegiatan seperti <strong data-start=\"694\" data-end=\"722\">Gerakan Literasi Sekolah</strong>, <strong data-start=\"724\" data-end=\"740\">resensi buku</strong>, <strong data-start=\"742\" data-end=\"759\">lomba menulis</strong>, dan <strong data-start=\"765\" data-end=\"782\">kelas kreatif</strong> yang diadakan oleh perpustakaan dapat menumbuhkan minat baca serta keterampilan literasi informasi.</p>\r\n<p data-start=\"884\" data-end=\"1031\">Peran pustakawan pun sangat vital sebagai fasilitator, mentor literasi, dan pembimbing siswa dalam mencari serta mengevaluasi informasi yang valid.</p>\r\n<p data-start=\"1033\" data-end=\"1172\">Dengan memaksimalkan fungsi perpustakaan sebagai <em data-start=\"1082\" data-end=\"1099\">learning center</em>, sekolah dapat mencetak generasi yang cerdas, kritis, dan cinta membaca.</p>', NULL, 110, '3', 'post', 'publish', 'public', 'open', 'pentingnya-perpustakaan-sekolah', NULL, 0, '2025-08-03 06:15:00', '2025-08-03 06:19:59', NULL, NULL, 110, 110, NULL, NULL, 'false'),
(59, 'Apa Itu Coding?', '<h3 data-start=\"123\" data-end=\"188\">💡 <strong data-start=\"130\" data-end=\"188\">Apa Itu Coding? Yuk, Kenalan dengan Dunia Pemrograman!</strong></h3>\r\n<p data-start=\"190\" data-end=\"375\">Hai teman-teman SMP! Pernah nggak kamu berpikir bagaimana sih game di HP, aplikasi belajar, atau website seperti YouTube itu dibuat? Nah, semuanya dibuat dengan yang namanya <strong data-start=\"364\" data-end=\"374\">coding</strong>!</p>\r\n<h4 data-start=\"377\" data-end=\"407\">🧑&zwj;💻 Coding Itu Apa Sih?</h4>\r\n<p data-start=\"409\" data-end=\"512\">Coding adalah cara kita memberi perintah ke komputer atau HP supaya mereka melakukan sesuatu. Misalnya:</p>\r\n<ul data-start=\"513\" data-end=\"630\">\r\n<li data-start=\"513\" data-end=\"569\">\r\n<p data-start=\"515\" data-end=\"569\">Saat kamu klik tombol &ldquo;play&rdquo; di game, itu ada kodenya.</p>\r\n</li>\r\n<li data-start=\"570\" data-end=\"630\">\r\n<p data-start=\"572\" data-end=\"630\">Saat kamu isi formulir online, itu juga hasil dari coding.</p>\r\n</li>\r\n</ul>\r\n<p data-start=\"632\" data-end=\"694\">Bahasa yang digunakan disebut <strong data-start=\"662\" data-end=\"684\">bahasa pemrograman</strong>, seperti:</p>\r\n<ul data-start=\"695\" data-end=\"848\">\r\n<li data-start=\"695\" data-end=\"740\">\r\n<p data-start=\"697\" data-end=\"740\">HTML, CSS &rarr; untuk membuat tampilan website.</p>\r\n</li>\r\n<li data-start=\"741\" data-end=\"792\">\r\n<p data-start=\"743\" data-end=\"792\">JavaScript &rarr; untuk bikin website jadi interaktif.</p>\r\n</li>\r\n<li data-start=\"793\" data-end=\"848\">\r\n<p data-start=\"795\" data-end=\"848\">Scratch &rarr; cocok banget untuk pemula dan anak sekolah.</p>\r\n</li>\r\n</ul>\r\n<h4 data-start=\"850\" data-end=\"890\">✨ Kenapa Kita Perlu Belajar Coding?</h4>\r\n<ol data-start=\"892\" data-end=\"1275\">\r\n<li data-start=\"892\" data-end=\"989\">\r\n<p data-start=\"895\" data-end=\"989\"><strong data-start=\"895\" data-end=\"929\">Melatih logika dan kreativitas</strong><br data-start=\"929\" data-end=\"932\" /> Kamu belajar menyusun perintah dan memecahkan masalah.</p>\r\n</li>\r\n<li data-start=\"991\" data-end=\"1079\">\r\n<p data-start=\"994\" data-end=\"1079\"><strong data-start=\"994\" data-end=\"1033\">Bisa buat game atau animasi sendiri</strong><br data-start=\"1033\" data-end=\"1036\" /> Seru kan, bikin karya digitalmu sendiri?</p>\r\n</li>\r\n<li data-start=\"1081\" data-end=\"1170\">\r\n<p data-start=\"1084\" data-end=\"1170\"><strong data-start=\"1084\" data-end=\"1108\">Persiapan masa depan</strong><br data-start=\"1108\" data-end=\"1111\" /> Banyak pekerjaan di masa depan yang butuh kemampuan ini.</p>\r\n</li>\r\n<li data-start=\"1172\" data-end=\"1275\">\r\n<p data-start=\"1175\" data-end=\"1275\"><strong data-start=\"1175\" data-end=\"1204\">Bisa jadi hobi yang keren</strong><br data-start=\"1204\" data-end=\"1207\" /> Banyak anak SMP yang sudah bisa bikin aplikasi dan ikut lomba IT!</p>\r\n</li>\r\n</ol>\r\n<h4 data-start=\"1277\" data-end=\"1311\">📚 Belajar Coding Itu Gampang</h4>\r\n<p data-start=\"1313\" data-end=\"1336\">Kamu bisa mulai dengan:</p>\r\n<ul data-start=\"1337\" data-end=\"1548\">\r\n<li data-start=\"1337\" data-end=\"1425\">\r\n<p data-start=\"1339\" data-end=\"1425\"><strong data-start=\"1339\" data-end=\"1350\">Scratch</strong> di <a class=\"cursor-pointer\" target=\"_new\" rel=\"noopener\" data-start=\"1354\" data-end=\"1396\">scratch.mit.edu</a> &rarr; cocok banget untuk pemula!</p>\r\n</li>\r\n<li data-start=\"1426\" data-end=\"1475\">\r\n<p data-start=\"1428\" data-end=\"1475\"><strong data-start=\"1428\" data-end=\"1440\">Code.org</strong> &rarr; belajar coding sambil main game.</p>\r\n</li>\r\n<li data-start=\"1476\" data-end=\"1548\">\r\n<p data-start=\"1478\" data-end=\"1548\"><strong data-start=\"1478\" data-end=\"1517\">Buku Coding di Perpustakaan Sekolah</strong> &rarr; minta bantuan pustakawan ya!</p>\r\n</li>\r\n</ul>\r\n<h4 data-start=\"1550\" data-end=\"1582\">🔍 Apa yang Bisa Kamu Coba?</h4>\r\n<ul data-start=\"1584\" data-end=\"1725\">\r\n<li data-start=\"1584\" data-end=\"1627\">\r\n<p data-start=\"1586\" data-end=\"1627\">Membuat <strong data-start=\"1594\" data-end=\"1612\">game sederhana</strong> pakai Scratch.</p>\r\n</li>\r\n<li data-start=\"1628\" data-end=\"1677\">\r\n<p data-start=\"1630\" data-end=\"1677\">Mendesain <strong data-start=\"1640\" data-end=\"1659\">web profil diri</strong> pakai HTML &amp; CSS.</p>\r\n</li>\r\n<li data-start=\"1678\" data-end=\"1725\">\r\n<p data-start=\"1680\" data-end=\"1725\">Membuat <strong data-start=\"1688\" data-end=\"1707\">kalkulator mini</strong> pakai JavaScript.</p>\r\n</li>\r\n</ul>\r\n<hr data-start=\"1727\" data-end=\"1730\" />\r\n<blockquote data-start=\"1732\" data-end=\"1804\">\r\n<p data-start=\"1734\" data-end=\"1804\"><strong data-start=\"1734\" data-end=\"1804\">\"Kalau kamu bisa bermain game, kamu juga bisa belajar membuatnya!\"</strong></p>\r\n</blockquote>\r\n<hr data-start=\"1806\" data-end=\"1809\" />\r\n<p data-start=\"1811\" data-end=\"1951\">Jika sekolah kamu punya klub TIK atau coding, jangan ragu untuk bergabung ya. Dan buat yang belum ada, siapa tahu kamu bisa jadi pelopornya!</p>', NULL, 110, '3', 'post', 'publish', 'public', 'open', 'apa-itu-coding', 'teknologi, coding', 12, '2025-08-03 06:21:00', '2025-08-03 06:53:32', NULL, NULL, 110, 110, NULL, NULL, 'false'),
(41, 'Launching Pojok Baca Digital di Perpustakaan Adyatama', 'Perpustakaan Adyatama resmi meluncurkan Pojok Baca Digital untuk mendukung literasi digital siswa.', 'launching-pojok-baca-digital.jpg', 110, '1', 'post', 'publish', 'public', 'open', 'launching-pojok-baca-digital', NULL, 0, '2025-07-27 08:23:00', '2025-08-02 21:40:01', NULL, NULL, NULL, 110, NULL, NULL, 'false'),
(42, 'Kunjungan Dinas Perpustakaan Daerah DIY ke Perpustakaan Adyatama', 'Kegiatan kunjungan dan pembinaan dari Dinas Perpustakaan DIY sebagai bentuk dukungan peningkatan layanan literasi sekolah.', NULL, 108, '1', 'post', 'publish', 'public', 'open', 'kunjungan-dinas-perpustakaan-diy', NULL, 0, '2025-07-31 15:23:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(43, 'Lomba Resensi Buku Tingkat SMP Digelar di Perpustakaan', 'Sebanyak 30 peserta mengikuti lomba resensi buku yang diadakan oleh Perpustakaan Adyatama.', NULL, 108, '1', 'post', 'publish', 'public', 'open', 'lomba-resensi-buku-tingkat-smp', NULL, 0, '2025-07-31 15:23:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(44, 'Pelatihan Literasi Informasi untuk Guru dan Siswa', 'Kegiatan pelatihan literasi informasi diselenggarakan untuk meningkatkan kemampuan mencari dan mengevaluasi informasi.', NULL, 108, '1', 'post', 'publish', 'public', 'open', 'pelatihan-literasi-informasi', NULL, 0, '2025-07-31 15:23:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(45, 'Pengadaan Buku Baru Tahun Ajaran 2025/2026', 'Sebanyak 250 judul buku baru masuk dalam koleksi Perpustakaan Adyatama tahun ajaran 2025/2026.', NULL, 108, '1', 'post', 'publish', 'public', 'open', 'pengadaan-buku-baru-2025', NULL, 3, '2025-07-31 15:23:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(46, 'Perpustakaan Adyatama Terapkan Sistem Peminjaman Online', 'Kini siswa dapat meminjam buku secara daring melalui sistem manajemen perpustakaan yang terintegrasi.', NULL, 108, '1', 'post', 'publish', 'public', 'open', 'sistem-peminjaman-online', NULL, 1, '2025-07-31 15:23:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(47, 'Kegiatan Baca Buku Bareng Setiap Jumat Pagi', 'Program “Jumat Literasi” rutin dilaksanakan setiap minggu untuk membudayakan membaca bersama.', NULL, 108, '1', 'post', 'publish', 'public', 'open', 'kegiatan-baca-buku-jumat', NULL, 0, '2025-07-31 15:23:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(48, 'Sosialisasi Gerakan Literasi Sekolah kepada Orang Tua', 'Orang tua siswa turut diberi pemahaman mengenai pentingnya literasi di rumah melalui kegiatan sosialisasi.', NULL, 108, '1', 'post', 'publish', 'public', 'open', 'sosialisasi-literasi-orangtua', NULL, 0, '2025-07-31 15:23:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(49, 'Perpustakaan Sediakan Koleksi Buku Braille untuk Siswa Berkebutuhan Khusus', 'Fasilitas inklusif ditingkatkan dengan hadirnya buku braille bagi siswa tunanetra.', NULL, 108, '1', 'post', 'publish', 'public', 'open', 'koleksi-buku-braille', NULL, 0, '2025-07-31 15:23:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(50, 'Perpustakaan Adyatama Masuk Nominasi Sekolah Literasi Nasional', 'Berita membanggakan, Perpustakaan Adyatama masuk dalam daftar nominasi Sekolah Literasi Nasional 2025.', NULL, 108, '1', 'post', 'publish', 'public', 'open', 'nominasi-sekolah-literasi', NULL, 0, '2025-07-31 15:23:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(56, 'PUNCAK MIMPI (Official Video)', 'R71PjeI_-0s', NULL, 108, NULL, 'video', NULL, NULL, NULL, 'puncak-mimpi-official-video', NULL, 0, '2025-08-01 10:12:02', '2025-08-01 10:12:02', NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(52, 'Jelajahi Minat dan Bakatmu', 'Ohq7X3yHKLE', NULL, 108, NULL, 'video', NULL, NULL, NULL, 'jelajahi-minat-dan-bakatmu', NULL, 0, '2025-08-01 09:17:24', '2025-08-01 09:17:24', NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(34, 'Pengumuman', '<p>Pengumuman bahwa ini website Perpustakaan</p>', NULL, 108, '4', 'post', 'publish', 'public', 'open', 'pengumuman', NULL, 0, '2025-07-31 07:50:01', '2025-07-31 07:50:01', NULL, NULL, 108, NULL, NULL, NULL, 'false'),
(35, 'Agenda Hari Ini', '<p>Agendanya apa yaaa</p>', NULL, 108, '5', 'post', 'publish', 'public', 'open', 'agenda-hari-ini', NULL, 0, '2025-07-31 08:11:41', '2025-07-31 08:11:41', NULL, NULL, 108, NULL, NULL, NULL, 'false'),
(36, 'Meningkatkan Minat Baca Siswa Lewat Literasi Digital', 'Artikel ini membahas bagaimana perpustakaan sekolah dapat memanfaatkan teknologi untuk menumbuhkan minat baca siswa.', 'meningkatkan-minat-baca-siswa.jpg', 108, '3', 'post', 'publish', 'public', 'open', 'meningkatkan-minat-baca-siswa', NULL, 0, '2025-07-31 15:17:45', '2025-07-31 08:40:29', NULL, NULL, NULL, 108, NULL, NULL, 'false'),
(37, 'Rekomendasi Buku Fiksi Islami untuk Remaja', 'Daftar buku fiksi Islami yang cocok untuk siswa SMP dan membantu menanamkan nilai moral serta spiritual.', NULL, 108, '3', 'post', 'publish', 'public', 'open', 'rekomendasi-buku-fiksi-islami', NULL, 0, '2025-07-31 15:17:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(38, 'Tips Efektif Membaca di Tengah Kesibukan Belajar', 'Beberapa tips sederhana agar siswa tetap bisa membaca walau memiliki jadwal belajar yang padat.', NULL, 108, '3', 'post', 'publish', 'public', 'open', 'tips-efektif-membaca', NULL, 0, '2025-07-31 15:17:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(39, 'Pentingnya Membaca Buku Nonteks bagi Pelajar', 'Membaca tidak harus dari buku pelajaran, tetapi juga dari buku-buku nonteks seperti biografi, sejarah, dan novel inspiratif.', NULL, 108, '3', 'post', 'publish', 'public', 'open', 'pentingnya-membaca-buku-nonteks', NULL, 0, '2025-07-31 15:17:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(40, 'Kegiatan Literasi Rutin di Perpustakaan Adyatama', 'Laporan kegiatan mingguan dan bulanan literasi yang diadakan oleh Perpustakaan Adyatama SMP Islam Al Azhar 26 Yogyakarta.', NULL, 108, '3', 'post', 'publish', 'public', 'open', 'kegiatan-literasi-rutin', NULL, 0, '2025-07-31 15:17:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'false'),
(60, 'Struktur Organisasi Perpustakaan', '<p><img src=\"http://localhost:8080/media_library/posts/1754229597_0bf4613ac1106b358d0d.png\" /></p>', NULL, 110, '7', 'page', 'publish', 'public', 'open', 'struktur-organisasi-perpustakaan', NULL, 0, '2025-08-03 14:00:24', '2025-08-03 14:00:24', NULL, NULL, 110, NULL, NULL, NULL, 'false'),
(61, 'Tenaga Perpustakaan', '<p>Jumlah tenaga kerja perpustakaan berjumlah 9 orang (termasuk kepala perpustakaan) dengan kualifikasi pendidikan sebagai berikut:</p>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td width=\"200\">\r\n<p><strong>Posisi/Kedudukan</strong></p>\r\n</td>\r\n<td width=\"73\">\r\n<p><strong>Jumlah</strong></p>\r\n</td>\r\n<td width=\"327\">\r\n<p><strong>Kualifikasi Pendidikan</strong></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"200\">\r\n<p>Kepala Perpustakaan</p>\r\n</td>\r\n<td width=\"73\">\r\n<p>1</p>\r\n</td>\r\n<td width=\"327\">\r\n<p>S1 Sarjana Sains Informasi</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"200\">\r\n<p>Pustakawan Fungsional</p>\r\n</td>\r\n<td width=\"73\">\r\n<p>3</p>\r\n</td>\r\n<td width=\"327\">\r\n<p>S1 Sarjanan Sains Informasi (1 orang)</p>\r\n<p>S1 Sarjanan Ilmu Perpustakaan (2 orang)</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"200\">\r\n<p>Pelayanan Teknis</p>\r\n</td>\r\n<td width=\"73\">\r\n<p>4</p>\r\n</td>\r\n<td width=\"327\">\r\n<p>S1 Sarjanan Pendidikan (2 orang)</p>\r\n<p>S2 Magister Pendidikan (1 orang)</p>\r\n<p>S1 Sarjana Akuntansi (1 orang)</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"200\">\r\n<p>Pelayanan Pembaca (Sirkulasi)</p>\r\n</td>\r\n<td width=\"73\">\r\n<p>3</p>\r\n</td>\r\n<td width=\"327\">\r\n<p>S1 Sarjanan Sains Informasi (1 orang)</p>\r\n<p>S1 Sarjanan Ilmu Perpustakaan (1 orang)</p>\r\n<p>S1 Sarjana Pendidikan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"200\">\r\n<p>Pelayanan Pustaka Maya (TIK)</p>\r\n</td>\r\n<td width=\"73\">\r\n<p>2</p>\r\n</td>\r\n<td width=\"327\">\r\n<p>S1 Sarjana Komputer (1 orang)</p>\r\n<p>D3 Ilmu Perpustakaan (1 orang)</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', NULL, 110, '7', 'page', 'publish', 'public', 'open', 'tenaga-perpustakaan', '', 0, '2025-08-03 14:06:03', '2025-08-03 14:06:03', NULL, NULL, 110, NULL, NULL, NULL, 'false'),
(62, 'Layanan Perpustakaan', '<p>Pada tahun 2025, perpustakaan SMP Islam Al Azhar 26 Yogyakarta merancang kegiatan layan perpustakaan yang ditujukan kepada pemustaka. Tedapat 6 jenis layanan yang dapat dimanfaatkan oleh pemustaka, yaitu:</p>\r\n<table width=\"633\">\r\n<tbody>\r\n<tr>\r\n<td width=\"47\">\r\n<p><strong>No.</strong></p>\r\n</td>\r\n<td width=\"274\">\r\n<p><strong>Nama Barang</strong></p>\r\n</td>\r\n<td width=\"133\">\r\n<p><strong>Lokasi</strong></p>\r\n</td>\r\n<td width=\"179\">\r\n<p><strong>Target Pemustaka</strong></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>1</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan Baca di Tempat</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Anggota perpustakaan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>2</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan Sirkulasi</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Anggota perpustakaan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>3</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan Referensi</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Anggota perpustakaan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>4</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan Penelusuran Informasi</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Anggota perpustakaan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>5</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan Silang Layan</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Umum</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>6</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan Bimbingan Literasi Informasi</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Anggota perpustakaan</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li><strong>Layanan baca di tempat </strong>adalah penyediaan sarana dan prasarana bagi pemustaka untuk melakukan kegiatan literasi terhadap koleksi pustaka, khususnya koleksi referensi, di dalam ruang perpustakaan.</li>\r\n<li><strong>Layanan sirkulasi</strong> adalah layanan peminjaman, pengembalian, serta perpanjangan koleksi pustaka oleh anggota perpustakaan. Layanan ini juga meliputi kegiatan yang berkaitan dengan administrasi perpustakaan seperti pendaftaran anggota perpustakaan, pencatatan serta pembayaran denda keterlambatan.&nbsp; Perpustakaan Adyatama SMP Islam Al Azhar 26 Yogyakarta menggunakan sistem otomatis dengan layanan terbuka dalam menunjang layanan ini.</li>\r\n<li><strong>Layanan referensi </strong>adalah penyediaan bahan rujukan informasi pustaka bagi pemustaka untuk di baca di tempat. Adapun bahan pustaka yang disediakan oleh Perpustakaan Adyatama SMP Islam Al Azhar 26 Yogyakarta antara lain kamus, ensiklopedia, atlas, globe, biografi, dan lain-lain.</li>\r\n<li><strong>Layanan penelusuran informasi </strong>adalah penyediaan sarana bagi pemustaka untuk mencari informasi di luar lingkup koleksi perpustakaan. Adapun sarana yang disediakan berupa perangkat yang terhubung dengan internet seperti komputer dan <em>ipad.</em></li>\r\n<li><strong>Layanan silang layan </strong>adalah pemberian fasilitas koleksi perpustakaan ke perpustakaan lain sesuai kebutuhan atau permintaan secara gratis dan rutin. Penerima dari layanan silang layan diantaranya adalah unit perpustakaan sekolah lain dan perpustakaan masyarakat.</li>\r\n<li><strong>Layanan bimbingan literasi informasi </strong>adalah layanan yang membantu pemustaka untuk memahami dan menggunakan informasi secara lebih efektif. Layanan ini dapat dilaksanakan bersamaan dengan layanan sirkulasi.</li>\r\n</ul>', NULL, 110, '10', 'page', 'publish', 'public', 'open', 'layanan-perpustakaan', '', 0, '2025-08-03 14:06:54', '2025-08-03 14:06:54', NULL, NULL, 110, NULL, NULL, NULL, 'false'),
(63, 'Layanan Referensi', '<p>Pada tahun 2025, perpustakaan SMP Islam Al Azhar 26 Yogyakarta merancang kegiatan layan referensi perpustakaan yang ditujukan kepada pemustaka. Tedapat 4 jenis layanan referensi yang dapat dimanfaatkan oleh pemustaka, yaitu:</p>\r\n<table width=\"633\">\r\n<tbody>\r\n<tr>\r\n<td width=\"47\">\r\n<p><strong>No.</strong></p>\r\n</td>\r\n<td width=\"274\">\r\n<p><strong>Nama Barang</strong></p>\r\n</td>\r\n<td width=\"133\">\r\n<p><strong>Lokasi</strong></p>\r\n</td>\r\n<td width=\"179\">\r\n<p><strong>Target Pemustaka</strong></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>1</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan meja informasi (reference desk)</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Anggota perpustakaan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>2</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan penelusuran</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Anggota perpustakaan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>3</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan bimbingan penggunaan koleksi referensi</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Anggota perpustakaan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"47\">\r\n<p>4</p>\r\n</td>\r\n<td width=\"274\">\r\n<p>Layanan kesiagaan informasi</p>\r\n</td>\r\n<td width=\"133\">\r\n<p>PSB</p>\r\n</td>\r\n<td width=\"179\">\r\n<p>Anggota perpustakaan</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li><strong>Layanan meja informasi (<em>reference desk</em>) </strong>adalah fasilitas perpustakaan yang memiliki fungsi memberikan informasi tentang produk, layanan dan fasilitas Perpustakaan Adyatama SMP Islam Al Azhar 26 Yogyakarta kepada pemustaka.</li>\r\n<li><strong>Layanan penelusuran </strong>adalah layanan yang disediakan oleh perpustakaan untuk membantu pemustaka menemukan informasi yang mereka butuhkan. Layanan ini didukung dengan sistem OPAC (<em>Online Public Access Catalogue</em>) atau dengan bantuan pustakawan</li>\r\n<li><strong>Layanan bimbingan pengguna koleksi referensi </strong>adalah layanan yang bertujuan untuk membantu pemustaka dalam menemukan dan menggunakan sumber referensi yang tepat, seperti kamus, ensiklopedia, dan direktori.</li>\r\n<li><strong>Layanan kesiagaan informasi </strong>adalah layanan yang memberikan informasi terbaru kepada pemustaka berupa daftar koleksi baru yang dimiliki oleh perpustakaan. Layanan ini memungkinkan pemustaka untuk tetap relevan dengan perkembangan informasi yang menjadi minat mereka.</li>\r\n</ul>', NULL, 110, '10', 'page', 'publish', 'public', 'open', 'layanan-referensi', '', 0, '2025-08-03 14:07:22', '2025-08-03 14:07:22', NULL, NULL, 110, NULL, NULL, NULL, 'false'),
(64, 'Program Perpustakaan', '<p><strong>Gerakan Literasi Sekolah</strong></p>\r\n<p>Bertujuan untuk meningkatkan minat baca peserta didik, kegiatan ini dilaksanakan satu minggu sekali oleh setiap kelas pada hari P5. Kegiatan ini akan berisi serangkaian agenda seperti <em>game, </em>membaca bersama, menggambar, membuat resensi, dan agenda lainnya yang didampingi oleh guru/tenaga perpustakaan yang sedang bertugas.&nbsp; Dari kegiatan ini diharapkan murid dapat membuat sebuah karya literasi pada akhir tahun ajaran baru yang akan menjadi inventarisasi perpustakaan.</p>\r\n<p><strong>Lomba Pojok Literasi</strong></p>\r\n<p>Kegiatan ini bertujuan untuk meningkatkan minat baca murid dengan menghias dan merawat pojok literasi di titik yang akan ditentukan oleh tenaga perpustakaan. Setiap murid diminta membawa buku dari rumah untuk dipajang di rak pojok literasi, sehingga murid bertambah referensi membacanya. Kegiatan ini dimulai awal tahun pelajaran dan akan dinilai ketika bulan bahasa. Dari kegiatan ini diharapkan murid dapat memperluas referensi dalam membaca dengan bertukar buku di pojok literasi.</p>\r\n<p><strong>Pengadaan Koleksi Baru</strong></p>\r\n<p>Kegiatan ini bertujuan agar memudahkan semua warga sekolah mudah dalam mengakses buku digital. Buku digital bisa diakses melalui komputer yang ada di PSB atau perangkat pribadi yang dimiliki oleh pengunjung.&nbsp;</p>\r\n<p><strong>Studi Banding Perpustakaan</strong></p>\r\n<p>Kegiatan ini akan di laksanakan sebanyak 2 kali dalam setahun yang bertujuan untuk mengembangkan perpustakaan ke arah yang lebih baik dengan belajar dari perpustakaan-perpustakaan sekolah terbaik di sekitar D.I. Yogyakarta</p>', NULL, 110, '10', 'page', 'publish', 'public', 'open', 'program-perpustakaan', '', 0, '2025-08-03 14:07:52', '2025-08-03 14:07:52', NULL, NULL, 110, NULL, NULL, NULL, 'false');

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
(1, 'general', 'site_maintenance', NULL, 'false', 'public', 'Pemeliharaan situs', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(2, 'general', 'site_maintenance_end_date', NULL, '2022-01-01', 'public', 'Tanggal Berakhir Pemeliharaan Situs', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(3, 'general', 'site_cache', NULL, 'false', 'public', 'Cache situs', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(4, 'general', 'site_cache_time', NULL, '10', 'public', 'Lama Cache Situs', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(5, 'general', 'meta_description', 'Perpustakaan Adyatama SMP Islam Al Azhar 26 Yogyakarta adalah pusat literasi dan informasi yang menyediakan koleksi buku berkualitas, layanan digital, dan ruang baca nyaman untuk mendukung budaya baca siswa.', 'CMS Sinau Matematika dikembangkan untuk Manajemen Konten Pendidikan', 'public', 'Deskripsi Meta', '2023-01-15 21:23:22', '2025-07-31 14:41:04', NULL, NULL, 0, 101, 0, 0, 'false'),
(6, 'general', 'meta_keywords', 'Perpustakaan Adyatama, SMP Islam Al Azhar 26 Yogyakarta, perpustakaan sekolah, literasi, koleksi buku, layanan perpustakaan digital, ruang baca, budaya membaca, edukasi Islam, pendidikan Yogyakarta', 'CMS Sinau Matematika, Manajemen Konten Pendidikan, CMS Pendidikan Matematika, Sistem Informasi Pembelajaran Matematika, Aplikasi Manajemen Pembelajaran Matematika, Platform Digital Matematika Sekolah, Konten Digital Matematika SMP, Konten Digital Matematika SMA, Sistem E-Learning Matematika, Modul Interaktif Matematika, Aplikasi Guru Matematika, CMS Sekolah Gratis, Sistem Manajemen Pembelajaran Matematika, Media Pembelajaran Matematika Online, Pengelolaan Konten Edukasi Digital, Website Pembelajaran Matematika, Pengembangan CMS untuk Sekolah, Publikasi Materi Matematika, Manajemen Soal dan Latihan Matematika, Admin Konten Pendidikan, Upload Video Pembelajaran, Sistem Tugas dan Evaluasi Online, Dashboard Guru dan Siswa Matematika, CMS Kelas Digital, CMS Matematika Indonesia, CMS Matematika Kurikulum Merdeka, Sinau Matematika untuk Sekolah di Indonesia, Platform Belajar Matematika Kurikulum 2013, Aplikasi Sekolah Berbasis Web', 'public', 'Kata Kunci Meta', '2023-01-15 21:23:22', '2025-07-31 14:41:21', NULL, NULL, 0, 1, 0, 0, 'false'),
(7, 'general', 'map_location', NULL, '', 'public', 'Lokasi di Google Maps', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 1, 0, 0, 'false'),
(8, 'general', 'favicon', '1754106810_9773207bd521dfec99b8.png', 'favicon.png', 'public', 'Favicon', '2023-01-15 21:23:22', '2025-08-02 03:53:30', NULL, NULL, 0, 0, 0, 0, 'false'),
(9, 'general', 'header', NULL, 'banner.png', 'public', 'Gambar Header', '2023-01-15 21:23:22', '2025-07-31 13:41:33', NULL, NULL, 0, 0, 0, 0, 'false'),
(10, 'general', 'recaptcha_status', NULL, 'disable', 'public', 'reCAPTCHA Status', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 1, 0, 0, 'false'),
(11, 'general', 'recaptcha_site_key', NULL, '6LeNCTAUAAAAAADTbL1rDw8GT1DF2DUjVtEXzdMu', 'public', 'Recaptcha Site Key', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 1, 0, 0, 'false'),
(12, 'general', 'recaptcha_secret_key', NULL, '6LeNCTAUAAAAAGq8O0ItkzG8fsA9KeJ7mFMMFF1s', 'public', 'Recaptcha Secret Key', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 1, 0, 0, 'false'),
(13, 'general', 'timezone', NULL, 'Asia/Jakarta', 'public', 'Time Zone', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 0, 0, 0, 'false'),
(14, 'media', 'file_allowed_types', NULL, 'jpg, jpeg, png, gif', 'public', 'Tipe file yang diizinkan', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 102, 0, 0, 'false'),
(15, 'media', 'upload_max_filesize', NULL, '0', 'public', 'Maksimal Ukuran File yang Diupload', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(16, 'media', 'thumbnail_size_height', '225', '100', 'public', 'Tinggi Gambar Thumbnail', '2023-01-15 21:23:22', '2025-08-01 12:40:36', NULL, NULL, 0, 0, 0, 0, 'false'),
(17, 'media', 'thumbnail_size_width', '400', '150', 'public', 'Lebar Gambar Thumbnail', '2023-01-15 21:23:22', '2025-08-01 12:40:28', NULL, NULL, 0, 0, 0, 0, 'false'),
(18, 'media', 'medium_size_height', NULL, '308', 'public', 'Tinggi Gambar Sedang', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(19, 'media', 'medium_size_width', NULL, '460', 'public', 'Lebar Gambar Sedang', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(20, 'media', 'large_size_height', NULL, '600', 'public', 'Tinggi Gambar Besar', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(21, 'media', 'large_size_width', NULL, '800', 'public', 'Lebar Gambar Besar', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(22, 'media', 'album_cover_height', '400', '250', 'public', 'Tinggi Cover Album Foto', '2023-01-15 21:23:22', '2025-08-01 12:40:50', NULL, NULL, 0, 0, 0, 0, 'false'),
(23, 'media', 'album_cover_width', NULL, '400', 'public', 'Lebar Cover Album Foto', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(26, 'media', 'image_slider_height', NULL, '400', 'public', 'Tinggi Gambar Slide', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(27, 'media', 'image_slider_width', NULL, '900', 'public', 'Lebar Gambar Slide', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 102, 0, 0, 'false'),
(34, 'media', 'header_height', NULL, '80', 'public', 'Tinggi Gambar Header', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(35, 'media', 'header_width', NULL, '200', 'public', 'Lebar Gambar Header', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(36, 'media', 'logo_height', NULL, '120', 'public', 'Tinggi Logo Sekolah', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 102, 0, 0, 'false'),
(37, 'media', 'logo_width', NULL, '120', 'public', 'Lebar Logo Sekolah', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 102, 0, 0, 'false'),
(38, 'writing', 'default_post_category', NULL, '1', 'public', 'Default Kategori Tulisan', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(39, 'writing', 'default_post_status', NULL, 'publish', 'public', 'Default Status Tulisan', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(40, 'writing', 'default_post_visibility', NULL, 'public', 'public', 'Default Akses Tulisan', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(41, 'writing', 'default_post_discussion', NULL, 'open', 'public', 'Default Komentar Tulisan', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(42, 'writing', 'post_image_thumbnail_height', NULL, '100', 'public', 'Tinggi Gambar Kecil', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(43, 'writing', 'post_image_thumbnail_width', NULL, '150', 'public', 'Lebar Gambar Kecil', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(44, 'writing', 'post_image_medium_height', NULL, '250', 'public', 'Tinggi Gambar Sedang', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(45, 'writing', 'post_image_medium_width', NULL, '400', 'public', 'Lebar Gambar Sedang', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(46, 'writing', 'post_image_large_height', NULL, '450', 'public', 'Tinggi Gambar Besar', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(47, 'writing', 'post_image_large_width', NULL, '840', 'public', 'Lebar Gambar Besar', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(48, 'reading', 'post_per_page', NULL, '10', 'public', 'Tulisan per halaman', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(49, 'reading', 'post_rss_count', NULL, '10', 'public', 'Jumlah RSS', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(50, 'reading', 'post_related_count', '3', '10', 'public', 'Jumlah Tulisan Terkait', '2023-01-15 21:23:22', '2025-08-02 04:19:26', NULL, NULL, 0, 1, 0, 0, 'false'),
(51, 'reading', 'comment_per_page', NULL, '10', 'public', 'Komentar per halaman', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(52, 'discussion', 'comment_moderation', NULL, 'false', 'public', 'Komentar harus disetujui secara manual', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(53, 'discussion', 'comment_registration', NULL, 'false', 'public', 'Pengguna harus terdaftar dan login untuk komentar', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(54, 'discussion', 'comment_blacklist', NULL, 'kampret', 'public', 'Komentar disaring', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(55, 'discussion', 'comment_order', NULL, 'asc', 'public', 'Urutan Komentar', '2023-01-15 21:23:22', '2023-01-15 14:23:22', NULL, NULL, 0, 0, 0, 0, 'false'),
(56, 'social_account', 'facebook', NULL, '', 'public', 'Facebook', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(57, 'social_account', 'twitter', NULL, '', 'public', 'Twitter', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 0, 0, 0, 'false'),
(58, 'social_account', 'tiktok', NULL, '', 'public', 'Tiktok', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(59, 'social_account', 'youtube', NULL, '', 'public', 'Youtube', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(60, 'social_account', 'instagram', NULL, '', 'public', 'Instagram', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 1, 0, 0, 'false'),
(61, 'mail_server', 'smtp_host', NULL, '', 'private', 'SMTP Server Address', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(62, 'mail_server', 'smtp_user', NULL, '', 'private', 'SMTP Username', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(63, 'mail_server', 'smtp_pass', NULL, '', 'private', 'SMTP Password', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(64, 'mail_server', 'smtp_port', NULL, '', 'public', 'SMTP Port', '2023-01-15 21:23:22', '2025-07-31 13:09:20', NULL, NULL, 0, 101, 0, 0, 'false'),
(65, 'school_profile', 'npsn', '20724857', '123', 'public', 'NPSN', '2023-01-15 21:23:22', '2025-07-31 13:29:51', NULL, NULL, 0, 1, 0, 0, 'false'),
(66, 'school_profile', 'school_name', 'SMP Islam Al-Azhar 26 Yogyakarta', 'SMKN 1 Temon', 'public', 'Nama Sekolah', '2023-01-15 21:23:22', '2025-07-31 13:29:10', NULL, NULL, 0, 1, 0, 0, 'false'),
(67, 'school_profile', 'nama_perpus', 'Perpustakaan Adyatama', 'Perpustakaan', 'public', 'Nama Perpustakaan', NULL, '2025-07-31 14:40:00', NULL, NULL, 0, 0, 0, 0, 'false'),
(68, 'school_profile', 'npp', '3404061D0100001', '0123456789', 'public', 'NPP', NULL, '2025-07-31 13:58:57', NULL, NULL, 0, 0, 0, 0, 'false'),
(74, 'school_profile', 'tagline', NULL, 'Berakhlak, Kompeten, Berbudaya dan Berwawasan Global', 'public', 'Slogan', '2023-01-15 21:23:22', '2025-07-31 13:11:06', NULL, NULL, 0, 1, 0, 0, 'false'),
(75, 'school_profile', 'rt', NULL, NULL, 'public', 'RT', '2023-01-15 21:23:22', '2025-07-31 13:11:18', NULL, NULL, 0, 1, 0, 0, 'false'),
(76, 'school_profile', 'rw', NULL, NULL, 'public', 'RW', '2023-01-15 21:23:22', '2025-07-31 13:11:22', NULL, NULL, 0, 1, 0, 0, 'false'),
(77, 'school_profile', 'sub_village', NULL, NULL, 'public', 'Dusun', '2023-01-15 21:23:22', '2025-07-31 13:11:34', NULL, NULL, 0, 1, 0, 0, 'false'),
(78, 'school_profile', 'village', 'Sinduadi', 'Kalidengen', 'public', 'Kelurahan / Desa', '2023-01-15 21:23:22', '2025-07-31 13:27:35', NULL, NULL, 0, 1, 0, 0, 'false'),
(79, 'school_profile', 'sub_district', 'Mlati', 'Temon', 'public', 'Kecamatan', '2023-01-15 21:23:22', '2025-07-31 13:27:41', NULL, NULL, 0, 101, 0, 0, 'false'),
(80, 'school_profile', 'district', 'Sleman', 'Kulon Progo', 'public', 'Kota/Kabupaten', '2023-01-15 21:23:22', '2025-07-31 13:27:48', NULL, NULL, 0, 1, 0, 0, 'false'),
(81, 'school_profile', 'postal_code', '55284', '55654', 'public', 'Kode Pos', '2023-01-15 21:23:22', '2025-07-31 14:00:48', NULL, NULL, 0, 1, 0, 0, 'false'),
(82, 'school_profile', 'street_address', 'Jl Padjajaran', 'Jalan Glagah', 'public', 'Alamat Jalan', '2023-01-15 21:23:22', '2025-07-31 13:27:23', NULL, NULL, 0, 101, 0, 0, 'false'),
(83, 'school_profile', 'phone', '(0274) 8722323', NULL, 'public', 'Telepon', '2023-01-15 21:23:22', '2025-07-31 13:31:24', NULL, NULL, 0, 101, 0, 0, 'false'),
(84, 'school_profile', 'fax', NULL, NULL, 'public', 'Fax', '2023-01-15 21:23:22', '2025-07-31 13:12:25', NULL, NULL, 0, 1, 0, 0, 'false'),
(85, 'school_profile', 'email', 'smpislamalazhar26yk@gmail.com', 'humas@smkn1temon.sch.id', 'public', 'Email', '2023-01-15 21:23:22', '2025-07-31 13:31:09', NULL, NULL, 0, 101, 0, 0, 'false'),
(86, 'school_profile', 'website', 'https://www.ayws.sch.id', 'https://smkn1temon.sch.id', 'public', 'Website', '2023-01-15 21:23:22', '2025-07-31 13:30:11', NULL, NULL, 0, 102, 0, 0, 'false'),
(87, 'school_profile', 'logo', NULL, 'logo2.png', 'public', 'Logo', '2023-01-15 21:23:22', '2025-07-31 13:56:04', NULL, NULL, 0, 0, 0, 0, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
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
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag`, `slug`, `created_at`, `updated_at`, `deleted_at`, `restored_at`, `created_by`, `updated_by`, `deleted_by`, `restored_by`, `is_deleted`) VALUES
(1, 'teknologi', 'teknologi', '2025-08-03 13:53:32', '2025-08-03 06:53:32', NULL, NULL, 110, 0, 0, 0, 'false'),
(2, 'coding', 'coding', '2025-08-03 13:53:32', '2025-08-03 06:53:32', NULL, NULL, 110, 0, 0, 0, 'false');

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
  `user_bio` text DEFAULT NULL,
  `user_jabatan` varchar(100) DEFAULT NULL,
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

INSERT INTO `users` (`id`, `user_name`, `user_password`, `user_full_name`, `user_email`, `user_url`, `user_bio`, `user_jabatan`, `user_contact`, `user_group_id`, `user_type`, `user_profile_id`, `user_biography`, `user_forgot_password_key`, `user_forgot_password_request_date`, `has_login`, `last_logged_in`, `ip_address`, `created_at`, `updated_at`, `deleted_at`, `restored_at`, `created_by`, `updated_by`, `deleted_by`, `restored_by`, `is_deleted`) VALUES
(108, 'admin', '$2y$10$Gc0WfyqD2zkj3cJFiuYPXefrQgqzxnHP5l0NG6zrCkiDl4x3LAny6', 'Bakhtiar Rifai', 'bakhtiarsma@gmail.com', NULL, 'seorang praktisi dalam dunia web dan merupakan guru matematika', 'Web Development', '085643160797', 0, 'super_user', NULL, NULL, NULL, NULL, 'true', '2025-08-03 04:10:19', '::1', '2025-07-28 09:35:28', '2025-08-02 21:11:21', NULL, NULL, 0, 0, 0, 0, 'false'),
(110, 'ruri', '$2y$10$fbTvuAKTX.9PYwzvCuHMxeT16OkrGkk4mQfjngYyr2WVgOvj5Lf3C', 'Ruri', 'ruri@alazhar.sch.id', NULL, '', 'Tenaga Perpustakaan', NULL, 0, 'super_user', NULL, NULL, NULL, NULL, 'true', '2025-08-03 04:11:06', '::1', '2025-08-02 18:21:33', '2025-08-02 21:11:06', NULL, NULL, 108, 0, 0, 0, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text NOT NULL,
  `visited_at` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip_address`, `user_agent`, `visited_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-29 09:07:27', '2025-07-29 09:07:27', '2025-07-29 09:07:27', NULL),
(2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-30 06:48:22', '2025-07-30 06:48:22', '2025-07-30 06:48:22', NULL),
(3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-30 14:56:52', '2025-07-30 14:56:52', '2025-07-30 14:56:52', NULL),
(4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-07-31 08:47:11', '2025-07-31 08:47:11', '2025-07-31 08:47:11', NULL),
(5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-01 04:25:42', '2025-08-01 04:25:42', '2025-08-01 04:25:42', NULL),
(6, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-02 02:53:04', '2025-08-02 02:53:04', '2025-08-02 02:53:04', NULL),
(7, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '2025-08-03 02:54:48', '2025-08-03 02:54:48', '2025-08-03 02:54:48', NULL);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_photo_album` (`photo_album_id`);

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
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `fk_photo_album` FOREIGN KEY (`photo_album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
