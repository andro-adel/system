-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2021 at 06:12 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `building_number` int(11) NOT NULL,
  `floor_number` int(11) NOT NULL,
  `apartment_number` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 -> Active 0 -> Inactive',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `address`, `region`, `street`, `building_number`, `floor_number`, `apartment_number`, `city`, `country`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'shobra', 'khorshed', 12, 5, 9, 'Cairo', 'Egypt', 0, 1, '2021-02-27 09:44:49', '2021-02-27 13:28:08');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `imageable_type`, `imageable_id`, `created_at`, `updated_at`) VALUES
(2, 'students/FFdHS6Ya776yW4RXNLuc90X8PDRlkiY3gj5HMuby.jpg', 'App\\Models\\students', 3, '2021-02-26 18:11:24', '2021-02-26 18:11:24'),
(3, 'users/ZtftttTDHPScRSjjjlR0mrSWV4zl5zqBb5JWMi0l.jpg', 'App\\Models\\users', 2, '2021-02-26 18:16:38', '2021-02-26 18:16:38'),
(4, 'users/JMDo7tAAw3HpPzWfagVVrxuW9n2j5Gf0kIS1zQ05.jpg', 'App\\Models\\users', 3, '2021-02-26 18:19:32', '2021-02-26 18:19:32'),
(5, 'students/5oM0E9qcBg7IlElidB5xP6cihcYPRjpdS4bNhjN7.jpg', 'App\\Models\\students', 4, '2021-02-26 18:27:35', '2021-02-26 18:27:35'),
(6, 'students/vOhL1Ny1Qz1WQ0AQdRKnZMnTRux4dG9Zrytpa1FN.jpg', 'App\\Models\\students', 5, '2021-02-26 18:30:18', '2021-02-26 18:30:18'),
(7, 'students/SJBITsHI1HC55PTyivanyPh5I1LNHMo5KgRywY5c.jpg', 'App\\Models\\students', 6, '2021-02-26 18:32:25', '2021-02-26 18:32:25'),
(8, 'students/34mLtlELw2iWohErhUKy7gbrDJRl46y6gPwzX62q.jpg', 'App\\Models\\students', 7, '2021-02-26 18:34:39', '2021-02-26 18:34:39'),
(9, 'users/2vK4HYF2JmlMJcxB2mas7PknNXhhE4CSVHSdIDVq.jpg', 'App\\Models\\users', 4, '2021-02-27 09:24:22', '2021-02-27 09:24:22'),
(10, 'users/HlacSetr3Bsx5vELdKL7wcxxSTzxPBIYCxkaJWu6.jpg', 'App\\Models\\users', 1, '2021-02-27 09:25:32', '2021-02-27 09:25:32');

-- --------------------------------------------------------

--
-- Table structure for table `materiales`
--

CREATE TABLE `materiales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `materialname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materialgrade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 -> Active 0 -> Inactive',
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materiales`
--

INSERT INTO `materiales` (`id`, `materialname`, `materialgrade`, `status`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 'English', 'Excellent', 1, 7, '2021-02-27 13:19:10', '2021-02-27 13:31:40'),
(2, 'Math', 'Good', 1, 7, '2021-02-27 14:29:12', '2021-02-27 14:29:12');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_02_10_121647_users', 1),
(2, '2021_02_10_121649_images', 1),
(3, '2021_02_10_121651_students', 1),
(4, '2021_02_10_121652_materiales', 1),
(5, '2021_02_10_121653_address', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 -> Active 0 -> Inactive',
  `studentclass` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dateofbirth` datetime DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nameofschool` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `phonenumber`, `status`, `studentclass`, `marital_status`, `gender`, `nationality`, `dateofbirth`, `religion`, `nameofschool`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'andro adel', 'androadel284@gmail.com', '0120139549', 1, 'Secondary School', 'Single', 'Male', 'Egyptian', '2021-02-04 00:00:00', 'Christian', 'school', NULL, '2021-02-26 18:34:39', '2021-02-27 10:12:49'),
(8, 'andro adel', 'androa2654@gmail.com', '0120139564', 1, 'Secondary School', 'married', 'Male', 'Egyptian', '2021-02-01 00:00:00', 'Christian', 'شبرا', NULL, '2021-02-27 15:08:44', '2021-02-27 15:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` smallint(6) NOT NULL DEFAULT 2 COMMENT '0 -> admin 1 -> user 2 -> student',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 -> Active 0 -> Inactive',
  `social_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phonenumber`, `type`, `status`, `social_id`, `social_img`, `reset_key`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'andro adel', 'andro@gmail.com', '$2y$10$Hi4kzvSlQv4enFq4uHHlMu1ar3FkotKJ.AzIqpcJ7mSN9zzBY0lBW', '012365489', 0, 1, NULL, NULL, NULL, 'J9XFycObZalrJQlUVHsja4p35VIDmyB2qmod2vHgbclddV03z2dzxGnQUT1g', '2021-02-26 16:46:37', '2021-02-27 09:25:32'),
(4, 'androadel699', 'androadel284@gmail.com', '$2y$10$PRLp8aVJIa7zzttIlBiGbeHbtxDV0Xzvor.KiRHsMXbnyNPr/isDy', '01201398457', 1, 1, NULL, NULL, NULL, NULL, '2021-02-27 09:24:22', '2021-02-27 13:42:09'),
(5, 'androadel333', 'androadel256@gmail.com', '$2y$10$hGL4apP1MwKLHzAVpo3qsujgorlzdSONg.2ikXsy.F1cMM5AOht/O', '01201356', 1, 1, NULL, NULL, NULL, NULL, '2021-02-27 14:42:36', '2021-02-27 14:42:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_user_id_foreign` (`user_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materiales_student_id_foreign` (`student_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD UNIQUE KEY `students_phonenumber_unique` (`phonenumber`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phonenumber_unique` (`phonenumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `materiales`
--
ALTER TABLE `materiales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `materiales`
--
ALTER TABLE `materiales`
  ADD CONSTRAINT `materiales_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
