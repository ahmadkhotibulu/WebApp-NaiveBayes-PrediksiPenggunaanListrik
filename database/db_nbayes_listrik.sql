-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 08, 2023 at 02:51 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_nbayes_listrik`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_04_20_043710_create_users_table', 1),
(3, '2023_05_12_012232_create_users_tracks_table', 1),
(4, '2023_05_26_001302_create_training_data_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_data`
--

CREATE TABLE `training_data` (
  `id_training_data` bigint(20) UNSIGNED NOT NULL,
  `jumlah_tanggungan` enum('BANYAK','SEDANG','SEDIKIT') NOT NULL,
  `luas_rumah` enum('BESAR','STANDAR','KECIL') NOT NULL,
  `pendapatan` enum('BESAR','SEDANG','KECIL') NOT NULL,
  `daya_listrik` enum('TINGGI','SEDANG','RENDAH') NOT NULL,
  `perlengkapan` enum('BANYAK','SEDANG','SEDIKIT') NOT NULL,
  `penggunaan_listrik` enum('TINGGI','SEDANG','RENDAH') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_data`
--

INSERT INTO `training_data` (`id_training_data`, `jumlah_tanggungan`, `luas_rumah`, `pendapatan`, `daya_listrik`, `perlengkapan`, `penggunaan_listrik`, `created_at`, `updated_at`) VALUES
(1, 'BANYAK', 'BESAR', 'BESAR', 'SEDANG', 'BANYAK', 'TINGGI', '2023-06-07 17:14:48', '2023-06-07 17:14:48'),
(2, 'BANYAK', 'BESAR', 'BESAR', 'SEDANG', 'BANYAK', 'TINGGI', '2023-06-07 17:14:48', '2023-06-07 17:14:48'),
(3, 'BANYAK', 'BESAR', 'BESAR', 'SEDANG', 'BANYAK', 'TINGGI', '2023-06-07 17:14:48', '2023-06-07 17:14:48'),
(4, 'BANYAK', 'BESAR', 'BESAR', 'SEDANG', 'BANYAK', 'TINGGI', '2023-06-07 17:14:48', '2023-06-07 17:14:48'),
(5, 'SEDIKIT', 'STANDAR', 'BESAR', 'RENDAH', 'SEDANG', 'SEDANG', '2023-06-07 17:14:49', '2023-06-07 17:14:49'),
(6, 'SEDIKIT', 'BESAR', 'BESAR', 'SEDANG', 'SEDANG', 'SEDANG', '2023-06-07 17:14:49', '2023-06-07 17:14:49'),
(7, 'SEDIKIT', 'KECIL', 'BESAR', 'SEDANG', 'SEDANG', 'SEDANG', '2023-06-07 17:14:49', '2023-06-07 17:14:49'),
(8, 'SEDANG', 'BESAR', 'BESAR', 'SEDANG', 'BANYAK', 'SEDANG', '2023-06-07 17:14:49', '2023-06-07 17:14:49'),
(9, 'SEDANG', 'BESAR', 'BESAR', 'SEDANG', 'BANYAK', 'SEDANG', '2023-06-07 17:14:49', '2023-06-07 17:14:49'),
(10, 'SEDANG', 'STANDAR', 'BESAR', 'SEDANG', 'BANYAK', 'SEDANG', '2023-06-07 17:14:49', '2023-06-07 17:14:49'),
(11, 'SEDANG', 'STANDAR', 'BESAR', 'SEDANG', 'BANYAK', 'SEDANG', '2023-06-07 17:14:49', '2023-06-07 17:14:49'),
(12, 'SEDANG', 'STANDAR', 'BESAR', 'SEDANG', 'BANYAK', 'TINGGI', '2023-06-07 17:14:49', '2023-06-07 17:14:49'),
(13, 'SEDANG', 'STANDAR', 'BESAR', 'SEDANG', 'BANYAK', 'TINGGI', '2023-06-07 17:14:49', '2023-06-07 17:14:49'),
(14, 'SEDANG', 'STANDAR', 'BESAR', 'SEDANG', 'BANYAK', 'TINGGI', '2023-06-07 17:14:49', '2023-06-07 17:14:49'),
(15, 'BANYAK', 'STANDAR', 'KECIL', 'SEDANG', 'BANYAK', 'SEDANG', '2023-06-07 17:14:49', '2023-06-07 17:14:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `tipe_user` enum('ADMINISTRATOR','USER') NOT NULL,
  `username` varchar(18) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto_user` varchar(125) DEFAULT NULL,
  `nama_depan` varchar(24) NOT NULL,
  `nama_belakang` varchar(64) NOT NULL,
  `provinsi` varchar(48) NOT NULL,
  `kabupaten` varchar(64) NOT NULL,
  `kecamatan` varchar(64) NOT NULL,
  `kelurahan` varchar(80) NOT NULL,
  `alamat` varchar(128) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `tipe_user`, `username`, `password`, `foto_user`, `nama_depan`, `nama_belakang`, `provinsi`, `kabupaten`, `kecamatan`, `kelurahan`, `alamat`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ADMINISTRATOR', 'admin', '$argon2id$v=19$m=65536,t=4,p=1$akUyMnBVZ1Z0Yzh1RVkuVQ$A6DBj/gqbWdGX3Us4ZYTmPLx935CVpE5wv4uQeM+Edo', NULL, 'Administrator', '', '34,DI YOGYAKARTA', '3404,KABUPATEN SLEMAN', '3404080,BERBAH', '3404080001,SENDANG TIRTO', NULL, NULL, '2023-06-07 17:14:44', '2023-06-07 17:14:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_tracks`
--

CREATE TABLE `users_tracks` (
  `id_user_track` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `address_type` varchar(32) DEFAULT NULL,
  `address` varchar(32) DEFAULT NULL,
  `method` varchar(8) DEFAULT NULL,
  `prompt` varchar(32) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `training_data`
--
ALTER TABLE `training_data`
  ADD PRIMARY KEY (`id_training_data`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_username_unique` (`username`);
ALTER TABLE `users` ADD FULLTEXT KEY `users_nama_depan_fulltext` (`nama_depan`);
ALTER TABLE `users` ADD FULLTEXT KEY `users_nama_belakang_fulltext` (`nama_belakang`);

--
-- Indexes for table `users_tracks`
--
ALTER TABLE `users_tracks`
  ADD PRIMARY KEY (`id_user_track`),
  ADD KEY `users_tracks_id_user_index` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_data`
--
ALTER TABLE `training_data`
  MODIFY `id_training_data` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_tracks`
--
ALTER TABLE `users_tracks`
  MODIFY `id_user_track` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_tracks`
--
ALTER TABLE `users_tracks`
  ADD CONSTRAINT `users_tracks_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
