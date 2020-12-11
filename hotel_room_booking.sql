-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2020 at 05:45 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_room_booking`
--
CREATE DATABASE IF NOT EXISTS `hotel_room_booking` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hotel_room_booking`;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_login`
--

CREATE TABLE `hotel_login` (
  `hotel_id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_login`
--

INSERT INTO `hotel_login` (`hotel_id`, `name`, `email`, `phone_number`, `password`, `role`, `created_at`) VALUES
(1, 'Three Sea ', 'threesea@gmail.com', '8220506519', '$2y$10$sreFWcSwE0o./L099jT5iOs3cWTdmGFXPDmnBc4M.dXHxjMD9akTq', '0', '2020-12-10 07:01:51');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2020_12_09_131454_create_hotel_login_table', 1),
(3, '2020_12_09_131548_create_rooms_table', 1),
(4, '2020_12_09_131608_create_rooms_available_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(10) UNSIGNED NOT NULL,
  `room_number` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `floor` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `beds` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `record_status` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_number`, `floor`, `beds`, `record_status`, `created_at`) VALUES
(1, 'A234', '34', '2', '1', '2020-12-10 04:52:52.000000'),
(2, 'A456', '2', '1', '1', '2020-12-10 04:53:14.000000'),
(3, 'A235', '34', '6', '1', '2020-12-10 05:17:31.000000'),
(4, 'A236', '34', '78', '1', '2020-12-10 07:58:15.000000');

-- --------------------------------------------------------

--
-- Table structure for table `rooms_available`
--

CREATE TABLE `rooms_available` (
  `booking_id` int(10) UNSIGNED NOT NULL,
  `room_number` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `avail_date` date NOT NULL,
  `book_status` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `booked_by` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `booked_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms_available`
--

INSERT INTO `rooms_available` (`booking_id`, `room_number`, `avail_date`, `book_status`, `booked_by`, `booked_time`, `created_at`) VALUES
(1, 'A234', '2020-12-11', '1', '1', '2020-12-10 10:06:54', '2020-12-10 11:50:32'),
(2, 'A456', '2020-12-14', '1', '1', '2020-12-10 10:06:37', '2020-12-10 06:46:32'),
(3, 'A235', '2020-12-15', '1', '3', '2020-12-10 23:08:25', '2020-12-10 23:07:20'),
(4, 'A236', '2020-12-30', '1', '3', '2020-12-10 23:08:51', '2020-12-10 23:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `phone_number`, `password`, `address`, `role`, `created_at`) VALUES
(1, 'Ahamed', 'admin@gmail.com', '8220506519', '$2y$10$sreFWcSwE0o./L099jT5iOs3cWTdmGFXPDmnBc4M.dXHxjMD9akTq', 'Aloor', '1', '2020-12-09 23:52:36'),
(2, 'Nadheem', 'nadheem@gmail.com', '8552654139', '$2y$10$mqPC3R42lOjjBzsRICcQIur4jlqrVo9qmBr35RDqgKh6YUybhN8Q6', 'Aloor', '1', '2020-12-09 23:55:08'),
(3, 'Ahamed Nad', 'nad@gmail.com', '8965423231', '$2y$10$Sr/j00UfGEaDSWLaXgvGIOOSrJGeZAX5IEX2Z.SB.IORH.VBybUpm', 'Aloor', '1', '2020-12-10 00:02:36'),
(4, 'Ahamed', 'admin1@gmail.com', '8220506518', '$2y$10$sjUpaTKPtQ8WO6k9nqo.x.BIppGpc.tqXeZLu3eUsWF0DhgbUibj6', 'Aloor', '1', '2020-12-10 00:52:56'),
(5, 'Ahamed', 'admin22@gmail.com', '8220506517', '$2y$10$heMXKZBc3InVr89/aUpmCOgQdxQz5zHwQpINoveyuGPJR.uBSZcnq', 'Aloor', '1', '2020-12-10 01:10:23'),
(6, 'Nadheem', 'nadh@gmail.com', '8974652513', '$2y$10$V9ooxoRhfsR3yUXHzSb/u.A6coi/CRLs0yJv8XcZu7AHa1ZU28a7O', 'Aloor', '1', '2020-12-10 01:15:37'),
(7, 'Ahamed', 'admin21@gmail.com', '8220506514', '$2y$10$fPIllLYqpzH9JzUHBCM.dOzgqHJgJD1kCWK57eclXJ/y7pxNDEeCG', 'Aloor', '1', '2020-12-10 07:42:10'),
(8, 'Ahamed', 'admin221@gmail.com', '8220506515', '$2y$10$9DQzyDy9TvfsFzlkOVz7iuqZZHm2UuCNaxLEzGwKYowA5I1VkURY.', 'Aloor', '1', '2020-12-10 07:42:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotel_login`
--
ALTER TABLE `hotel_login`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `rooms_available`
--
ALTER TABLE `rooms_available`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotel_login`
--
ALTER TABLE `hotel_login`
  MODIFY `hotel_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms_available`
--
ALTER TABLE `rooms_available`
  MODIFY `booking_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
