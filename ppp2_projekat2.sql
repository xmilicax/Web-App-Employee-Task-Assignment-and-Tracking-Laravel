-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 08:17 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppp2_projekat2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('admin@gmail.com|::1', 'i:1;', 1718253057),
('admin@gmail.com|::1:timer', 'i:1718253057;', 1718253057),
('milica.lazic@gmail.com|::1', 'i:2;', 1718232730),
('milica.lazic@gmail.com|::1:timer', 'i:1718232730;', 1718232730);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `task_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 15, 'Test komentar', '2024-06-10 23:29:45', NULL),
(2, 1, 14, 'test', '2024-06-11 14:00:10', '2024-06-11 14:00:10'),
(3, 1, 14, 'test', '2024-06-11 14:04:51', '2024-06-11 14:04:51'),
(4, 2, 14, 'test', '2024-06-11 15:23:08', '2024-06-11 15:23:08'),
(8, 1, 14, 'izmena', '2024-06-11 17:02:46', '2024-06-12 19:51:40'),
(9, 4, 1, 'Komentar preko forme', '2024-06-12 19:30:55', '2024-06-12 19:30:55'),
(12, 4, 14, 'lorem ipsum', '2024-06-12 21:57:29', '2024-06-12 21:57:29'),
(13, 2, 14, 'novi', '2024-06-12 22:00:24', '2024-06-12 22:00:24'),
(17, 2, 14, 'noviii', '2024-06-12 22:02:40', '2024-06-12 22:02:40'),
(19, 2, 14, 'noviii', '2024-06-12 22:05:15', '2024-06-12 22:05:15'),
(28, 1, 1, 'ff', '2024-06-13 01:19:40', '2024-06-13 01:19:40');

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
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '2024_06_08_143443_create_comments_table', 1),
(3, '2024_06_08_143825_create_user_types_table', 1),
(4, '2024_06_08_143853_create_task_groups_table', 1),
(5, '2024_06_08_143903_create_tasks_table', 1),
(6, '2024_06_08_164010_create_sessions_table', 1),
(8, '2024_06_08_170159_create_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext DEFAULT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8cBUV9tMrNGTeLCsAycg9W9RfoyzRd2a3w1sDnSs', 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN1Q5d1FFNEc0VWJzSmhlSGRHU0RHT3RVbXVZYXpBVVlpVEppTVlYcCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly9sb2NhbGhvc3QvcHBwMl9wcm9qZWthdDIvcHVibGljL3JvbGVzL21hbmFnZXIiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1718259437),
('Yplcks4O0UL7mF4fkmUwDs5AghvgbAnB9xOBkEHh', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNVpKN1RiaFNIemUwSEdxaGZac2o1bWVjZVVPWklobE9oM2dnOHpidSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3QvcHBwMl9wcm9qZWthdDIvcHVibGljIjt9fQ==', 1718252828);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` varchar(255) NOT NULL,
  `list_executors` varchar(255) NOT NULL,
  `manager` varchar(255) NOT NULL,
  `deadline` date NOT NULL,
  `priority` int(11) NOT NULL,
  `task_group_id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Nezavršen',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `list_executors`, `manager`, `deadline`, `priority`, `task_group_id`, `file`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Obuka praktikanata', 'Obuka praktikanata na Zlatiboru.', '14,15', '2', '2024-06-21', 10, 1, 'IMG_1645.jpg', 'Završeno', '2024-06-13 06:13:13', '2024-06-13 03:48:33'),
(2, 'Napraviti aplikaciju', 'Aplikacija za prodaju za klijenta Lilly D.O.O.', '12,14', '2', '2024-06-28', 8, 3, '0.jpg', 'Završeno', '2024-06-13 06:13:17', '2024-06-13 03:49:59'),
(4, 'Team Building 2024', 'Organizovati team building događaj', '11,12,15,16', '2', '2024-06-21', 7, 1, '4.jpg', 'Nezavršen', '2024-06-13 06:13:23', '2024-06-13 03:56:18'),
(14, 'Poslati raspored', 'Poslati raspored po grupama', '9,14', '2', '2024-06-21', 8, 1, 'it4.pdf', 'Nezavršen', '2024-06-13 06:12:15', '2024-06-13 03:40:44'),
(16, 'ddd', 'ddd', '14', '2', '2024-06-21', 2, 14, '4.png', 'Nezavršen', '2024-06-13 04:16:03', '2024-06-13 04:16:03');

-- --------------------------------------------------------

--
-- Table structure for table `task_groups`
--

CREATE TABLE `task_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_groups`
--

INSERT INTO `task_groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'HR', '2024-06-11 21:45:57', NULL),
(2, 'Marketing', '2024-06-11 21:45:57', NULL),
(3, 'IT sektor', '2024-06-12 00:15:37', '2024-06-11 22:15:37'),
(4, 'Finansije', '2024-06-11 21:45:57', NULL),
(8, 'Test Izmena', '2024-06-12 02:44:45', '2024-06-12 00:44:45'),
(12, 'izmena', '2024-06-12 16:24:07', '2024-06-12 14:24:07'),
(14, 'TEST', '2024-06-13 02:59:07', '2024-06-13 00:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_type_id` bigint(20) UNSIGNED NOT NULL DEFAULT 3,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `user_type_id`, `email_verified_at`, `phone`, `birthday`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$SoaUrIYeaE/WpgH4C4xlTO2k1EwNIMTes1frPbUzFov3AQvoomnQ6', 'admin@ppp2.com', 'Admin', 1, '2024-05-30 17:58:57', NULL, NULL, NULL, '2024-05-30 17:48:05', '2024-05-30 17:48:05'),
(2, 'marko', '$2y$12$SoaUrIYeaE/WpgH4C4xlTO2k1EwNIMTes1frPbUzFov3AQvoomnQ6', 'marko.markovic@gmail.com', 'Marko Marković', 2, '2024-06-01 16:00:51', NULL, '1999-06-28', NULL, '2024-06-01 15:55:41', '2024-06-01 15:55:41'),
(3, 'milica', '$2y$12$.Y28/.0bTQF3xIQXtIrbyeIjepWkD3rpBi8hEU84Z883Q17SfOCNm', 'lazicmilica01@gmail.com', 'Milica Lazić', 2, '2024-06-09 00:07:15', '0628211226', '2001-05-28', NULL, '2024-06-09 00:05:03', '2024-06-09 00:05:03'),
(9, 'aleksa', '$2y$12$WZBKMUCSNdarKjQChxLMgOms6KWES1PwZjg.62DNDZzaL4DNPPxFm', 'aleksa@gmail.com', 'aleksa stanković', 3, NULL, NULL, NULL, NULL, '2024-06-09 00:21:13', '2024-06-09 00:21:13'),
(11, 'djordje', '$2y$12$91m3tYYJS9HejdYMa9B69ufsiv70fg4neGHoMVFldhaDiN.Usz.g6', 'djordje@gmail.com', 'Đorđe Lazić', 3, '2024-06-09 01:09:00', NULL, NULL, NULL, '2024-06-09 01:05:02', '2024-06-09 01:09:00'),
(12, 'anastasija', '$2y$12$HgQB8AnQP5DBZuGWuPu5SO90QSsr5N/lVqo1PqwDWBi1.w.bwAVFe', 'anastasija@gmail.com', 'Anastasija Plješa', 3, NULL, NULL, NULL, 'LgUq6s2Mowt6RTAfyrCEXTpmrMz8CUKkFpPDwzuSfApW5vtVqRdXkWqWWJxc', '2024-06-09 01:19:22', '2024-06-09 02:52:34'),
(14, 'ksenija', '$2y$12$3oeWaOJfQTv..AG/FIvQDeOei9Rhc3uj4n3vTE5W0IU6ON/re1b6O', 'ksenija@gmail.com', 'Ksenija Perović', 3, '2024-06-09 01:59:59', NULL, NULL, NULL, '2024-06-09 01:54:59', '2024-06-09 01:59:59'),
(15, 'misko', '$2y$12$JNJNujTpjvqRwwGFxqmgfuW9LC4/2tWrXqP9ESDc4KDB/C9zUciby', 'miskovic@gmail.com', 'Marko Mišković', 3, '2024-06-09 16:08:39', NULL, NULL, 'EvPaM2Oto3zC5pjQuxUAuynqrXm0hbeHo93VbWO2i3byMZuvy75NSOXyjflf', '2024-06-09 02:01:28', '2024-06-09 16:08:39'),
(16, 'alex', '$2y$12$ZbbrFl3CzWWn2ZZEAnyrbeIusAh2Xf0IpzuPqNA86.4WL.6psfzG2', 'aleksandramrdjen73@gmail.com', 'Aleksandra Mrđen', 3, NULL, '0638383333', '1996-01-16', NULL, '2024-06-12 06:19:15', '2024-06-12 06:19:15'),
(17, 'aleksandar', '$2y$12$Ht9bdaumNmFr436LzVorKeMB5sUL7cBVDuVA5QhzuIB7XrWe98pq.', 'aleks@gmail.com', 'sas', 3, NULL, NULL, NULL, NULL, '2024-06-12 06:30:17', '2024-06-12 06:30:17'),
(20, 'igor', '$2y$12$m9MQx1EAH1qV8q8BpOtRz.SZG1nd9.YQGPGrRIjx4OmWVvqZy213C', 'igor@gmail.com', 'Igor Pavlica', 3, '2024-06-12 13:04:00', '0638383333', NULL, NULL, '2024-06-12 13:04:40', '2024-06-12 13:04:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2024-06-12 20:01:42', NULL),
(2, 'Rukovodilac odeljenja', '2024-06-12 20:01:42', NULL),
(3, 'Izvršilac', '2024-06-12 20:01:42', NULL),
(4, 'Gost', '2024-06-12 20:40:29', '2024-06-12 18:40:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `un_user_id` (`user_id`),
  ADD KEY `un_task_id` (`task_id`) USING BTREE;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_taskgroup_id_foreign` (`task_group_id`);

--
-- Indexes for table `task_groups`
--
ALTER TABLE `task_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_user_type_id_foreign` (`user_type_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `task_groups`
--
ALTER TABLE `task_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_taskgroup_id_foreign` FOREIGN KEY (`task_group_id`) REFERENCES `task_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_user_type_id_foreign` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
