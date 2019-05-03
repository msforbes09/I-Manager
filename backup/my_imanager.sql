-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2019 at 01:11 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_imanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `subject` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `amount` decimal(8,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `user_id`, `date`, `subject`, `details`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-04-30', 'Bayad Utang', 'Sir Revin', '200.00', '2019-05-03 03:02:15', '2019-05-03 03:02:15'),
(2, 1, '2019-04-30', 'Dinner', 'Shakeys', '281.00', '2019-05-03 03:02:57', '2019-05-03 03:02:57'),
(3, 1, '2019-04-30', 'Load', 'Mommy', '33.00', '2019-05-03 03:03:24', '2019-05-03 03:03:24'),
(4, 1, '2019-04-30', 'Fare', 'Jeepney', '10.00', '2019-05-03 03:03:49', '2019-05-03 03:03:49'),
(5, 1, '2019-05-01', 'Laundry', NULL, '84.00', '2019-05-03 03:04:16', '2019-05-03 03:04:16'),
(6, 1, '2019-04-30', 'Lunch', NULL, '70.00', '2019-05-03 03:05:05', '2019-05-03 03:05:05'),
(7, 1, '2019-05-01', 'Lunch', 'Mcdo', '149.00', '2019-05-03 03:05:39', '2019-05-03 03:05:39'),
(8, 1, '2019-05-01', 'Dinner', NULL, '79.00', '2019-05-03 03:06:26', '2019-05-03 03:06:26'),
(9, 1, '2019-05-01', 'Load', 'Mommy & Daddy', '84.00', '2019-05-03 03:06:51', '2019-05-03 03:06:51'),
(10, 1, '2019-05-01', 'Kopiko', NULL, '12.00', '2019-05-03 03:07:22', '2019-05-03 03:07:22'),
(11, 1, '2019-05-02', 'Paluwagan', NULL, '2100.00', '2019-05-03 03:07:48', '2019-05-03 03:07:48'),
(12, 1, '2019-05-02', 'Fare', 'Jeepney', '9.00', '2019-05-03 03:08:05', '2019-05-03 03:08:05'),
(13, 1, '2019-05-02', 'Morning Snack', 'Kutsinta', '20.00', '2019-05-03 03:08:40', '2019-05-03 03:08:40'),
(14, 1, '2019-05-02', 'Lunch', NULL, '70.00', '2019-05-03 03:08:58', '2019-05-03 03:08:58'),
(15, 1, '2019-05-02', 'Fare', 'Jeepney', '10.00', '2019-05-03 03:09:15', '2019-05-03 03:09:15'),
(16, 1, '2019-05-02', 'Dinner', NULL, '45.00', '2019-05-03 03:09:27', '2019-05-03 03:09:27'),
(17, 1, '2019-05-02', 'Milk', NULL, '13.00', '2019-05-03 03:09:43', '2019-05-03 03:09:43'),
(18, 1, '2019-05-03', 'Lunch', NULL, '70.00', '2019-05-03 03:10:01', '2019-05-03 03:10:01');

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `subject` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `amount` decimal(8,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `user_id`, `date`, `subject`, `details`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-04-30', 'Initial Balance', NULL, '181.00', '2019-05-03 03:01:20', '2019-05-03 03:01:20'),
(2, 1, '2019-04-30', 'Salary', NULL, '11200.00', '2019-05-03 03:01:42', '2019-05-03 03:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2019_05_01_080800_create_incomes_table', 2),
(8, '2019_05_02_061220_create_expenses_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Arnel Forbes', 'forbesarnel09@gmail.com', NULL, '$2y$10$t4/j8R7xwfu7iMqL3TavTeHsYTTbPsiruIt1KXTFQ5pf2AXcSsO4O', NULL, '2019-04-30 22:07:27', '2019-04-30 22:07:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_user_id_foreign` (`user_id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incomes_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `incomes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
