-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 23, 2026 at 08:58 PM
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
-- Database: `devices`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `asset_id` bigint(20) UNSIGNED DEFAULT NULL,
  `old_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`old_values`)),
  `new_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`new_values`)),
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `event`, `user_id`, `asset_id`, `old_values`, `new_values`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 'asset.created', 1, 14, NULL, '{\"status\":\"current\"}', '192.168.1.96', '2025-10-14 09:56:22', '2025-10-14 09:56:22'),
(2, 'asset.created', 1, 51, NULL, '{\"status\":\"current\"}', '192.168.1.160', '2025-12-09 03:56:22', '2025-12-09 03:56:22'),
(3, 'asset.created', 1, 55, NULL, '{\"status\":\"current\"}', '192.168.1.176', '2025-10-31 08:56:22', '2025-10-31 08:56:22'),
(4, 'asset.created', 1, 46, NULL, '{\"status\":\"current\"}', '192.168.1.4', '2025-09-08 18:56:22', '2025-09-08 18:56:22'),
(5, 'asset.created', 1, 78, NULL, '{\"status\":\"current\"}', '192.168.1.118', '2025-11-18 06:56:22', '2025-11-18 06:56:22'),
(6, 'asset.created', 1, 14, NULL, '{\"status\":\"current\"}', '192.168.1.235', '2025-11-16 07:56:22', '2025-11-16 07:56:22'),
(7, 'asset.created', 1, 52, NULL, '{\"status\":\"current\"}', '192.168.1.89', '2025-11-19 15:56:22', '2025-11-19 15:56:22'),
(8, 'asset.created', 1, 61, NULL, '{\"status\":\"current\"}', '192.168.1.163', '2026-02-02 20:56:22', '2026-02-02 20:56:22'),
(9, 'asset.created', 1, 79, NULL, '{\"status\":\"current\"}', '192.168.1.136', '2025-12-17 04:56:22', '2025-12-17 04:56:22'),
(10, 'asset.created', 1, 16, NULL, '{\"status\":\"current\"}', '192.168.1.148', '2025-09-23 09:56:22', '2025-09-23 09:56:22'),
(11, 'asset.created', 1, 34, NULL, '{\"status\":\"current\"}', '192.168.1.226', '2025-09-24 16:56:22', '2025-09-24 16:56:22'),
(12, 'asset.created', 1, 30, NULL, '{\"status\":\"current\"}', '192.168.1.109', '2025-11-04 07:56:22', '2025-11-04 07:56:22'),
(13, 'asset.created', 1, 72, NULL, '{\"status\":\"current\"}', '192.168.1.10', '2025-09-09 11:56:22', '2025-09-09 11:56:22'),
(14, 'asset.created', 1, 7, NULL, '{\"status\":\"current\"}', '192.168.1.130', '2026-01-30 11:56:22', '2026-01-30 11:56:22'),
(15, 'asset.created', 1, 54, NULL, '{\"status\":\"current\"}', '192.168.1.161', '2025-11-08 10:56:22', '2025-11-08 10:56:22'),
(16, 'asset.created', 1, 25, NULL, '{\"status\":\"current\"}', '192.168.1.146', '2026-02-08 02:56:22', '2026-02-08 02:56:22'),
(17, 'asset.created', 1, 3, NULL, '{\"status\":\"current\"}', '192.168.1.106', '2025-09-17 04:56:22', '2025-09-17 04:56:22'),
(18, 'asset.created', 1, 60, NULL, '{\"status\":\"current\"}', '192.168.1.176', '2025-08-29 06:56:22', '2025-08-29 06:56:22'),
(19, 'asset.created', 1, 15, NULL, '{\"status\":\"current\"}', '192.168.1.228', '2025-12-05 09:56:22', '2025-12-05 09:56:22'),
(20, 'asset.created', 1, 48, NULL, '{\"status\":\"current\"}', '192.168.1.119', '2025-09-23 05:56:22', '2025-09-23 05:56:22'),
(21, 'asset.created', 1, 6, NULL, '{\"status\":\"current\"}', '192.168.1.228', '2025-09-30 09:56:22', '2025-09-30 09:56:22'),
(22, 'asset.created', 1, 15, NULL, '{\"status\":\"current\"}', '192.168.1.57', '2025-09-29 17:56:22', '2025-09-29 17:56:22'),
(23, 'asset.created', 1, 25, NULL, '{\"status\":\"current\"}', '192.168.1.26', '2026-01-23 17:56:22', '2026-01-23 17:56:22'),
(24, 'asset.created', 1, 23, NULL, '{\"status\":\"current\"}', '192.168.1.115', '2025-11-18 04:56:22', '2025-11-18 04:56:22'),
(25, 'asset.created', 1, 34, NULL, '{\"status\":\"current\"}', '192.168.1.210', '2025-11-01 01:56:22', '2025-11-01 01:56:22'),
(26, 'asset.updated', 1, 48, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.27', '2025-12-20 15:56:22', '2025-12-20 15:56:22'),
(27, 'asset.updated', 1, 65, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.97', '2025-09-27 15:56:22', '2025-09-27 15:56:22'),
(28, 'asset.updated', 1, 65, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.31', '2026-01-12 09:56:22', '2026-01-12 09:56:22'),
(29, 'asset.updated', 1, 9, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.227', '2025-09-24 10:56:22', '2025-09-24 10:56:22'),
(30, 'asset.updated', 1, 46, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.164', '2025-10-22 18:56:22', '2025-10-22 18:56:22'),
(31, 'asset.updated', 1, 77, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.108', '2025-11-16 23:56:22', '2025-11-16 23:56:22'),
(32, 'asset.updated', 1, 5, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.15', '2025-10-01 05:56:22', '2025-10-01 05:56:22'),
(33, 'asset.updated', 1, 46, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.149', '2025-12-11 11:56:22', '2025-12-11 11:56:22'),
(34, 'asset.updated', 1, 74, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.232', '2025-11-26 18:56:22', '2025-11-26 18:56:22'),
(35, 'asset.updated', 1, 11, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.201', '2026-02-17 11:56:22', '2026-02-17 11:56:22'),
(36, 'asset.updated', 1, 16, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.219', '2025-12-21 07:56:22', '2025-12-21 07:56:22'),
(37, 'asset.updated', 1, 13, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.33', '2025-10-29 23:56:22', '2025-10-29 23:56:22'),
(38, 'asset.updated', 1, 50, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.81', '2025-12-07 22:56:22', '2025-12-07 22:56:22'),
(39, 'asset.updated', 1, 17, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.211', '2025-10-24 02:56:22', '2025-10-24 02:56:22'),
(40, 'asset.updated', 1, 71, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.141', '2026-02-02 04:56:22', '2026-02-02 04:56:22'),
(41, 'asset.updated', 1, 29, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.109', '2026-01-30 23:56:22', '2026-01-30 23:56:22'),
(42, 'asset.updated', 1, 5, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.196', '2025-11-18 17:56:22', '2025-11-18 17:56:22'),
(43, 'asset.updated', 1, 54, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.231', '2025-11-12 07:56:22', '2025-11-12 07:56:22'),
(44, 'asset.updated', 1, 15, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.170', '2025-12-21 09:56:22', '2025-12-21 09:56:22'),
(45, 'asset.updated', 1, 11, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.79', '2025-12-30 00:56:22', '2025-12-30 00:56:22'),
(46, 'asset.updated', 1, 63, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.215', '2025-08-27 11:56:22', '2025-08-27 11:56:22'),
(47, 'asset.updated', 1, 46, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.132', '2026-01-06 16:56:22', '2026-01-06 16:56:22'),
(48, 'asset.updated', 1, 27, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.205', '2026-01-21 13:56:22', '2026-01-21 13:56:22'),
(49, 'asset.updated', 1, 15, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.98', '2026-01-24 23:56:22', '2026-01-24 23:56:22'),
(50, 'asset.updated', 1, 12, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.63', '2026-01-31 04:56:22', '2026-01-31 04:56:22'),
(51, 'asset.updated', 1, 72, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.27', '2025-10-26 08:56:22', '2025-10-26 08:56:22'),
(52, 'asset.updated', 1, 79, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.220', '2025-12-30 01:56:22', '2025-12-30 01:56:22'),
(53, 'asset.updated', 1, 22, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.143', '2025-12-08 11:56:22', '2025-12-08 11:56:22'),
(54, 'asset.updated', 1, 79, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.113', '2025-09-15 02:56:22', '2025-09-15 02:56:22'),
(55, 'asset.updated', 1, 79, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.4', '2025-09-08 13:56:22', '2025-09-08 13:56:22'),
(56, 'asset.updated', 1, 17, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.129', '2025-10-25 22:56:22', '2025-10-25 22:56:22'),
(57, 'asset.updated', 1, 8, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.161', '2025-12-02 03:56:22', '2025-12-02 03:56:22'),
(58, 'asset.updated', 1, 37, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.30', '2025-12-23 19:56:22', '2025-12-23 19:56:22'),
(59, 'asset.updated', 1, 28, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.161', '2026-01-28 20:56:22', '2026-01-28 20:56:22'),
(60, 'asset.updated', 1, 36, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.112', '2026-01-29 22:56:22', '2026-01-29 22:56:22'),
(61, 'asset.updated', 1, 42, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.150', '2025-12-05 14:56:22', '2025-12-05 14:56:22'),
(62, 'asset.updated', 1, 2, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.152', '2026-01-29 02:56:22', '2026-01-29 02:56:22'),
(63, 'asset.updated', 1, 74, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.226', '2025-11-22 11:56:22', '2025-11-22 11:56:22'),
(64, 'asset.updated', 1, 78, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.107', '2026-01-06 18:56:22', '2026-01-06 18:56:22'),
(65, 'asset.updated', 1, 38, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.252', '2025-11-28 08:56:22', '2025-11-28 08:56:22'),
(66, 'assignment.checked_out', 1, 78, NULL, '{\"status\":\"current\"}', '192.168.1.73', '2025-12-02 18:56:22', '2025-12-02 18:56:22'),
(67, 'assignment.checked_out', 1, 38, NULL, '{\"status\":\"current\"}', '192.168.1.115', '2025-12-21 10:56:22', '2025-12-21 10:56:22'),
(68, 'assignment.checked_out', 1, 68, NULL, '{\"status\":\"current\"}', '192.168.1.191', '2025-08-26 12:56:22', '2025-08-26 12:56:22'),
(69, 'assignment.checked_out', 1, 68, NULL, '{\"status\":\"current\"}', '192.168.1.152', '2025-12-26 00:56:22', '2025-12-26 00:56:22'),
(70, 'assignment.checked_out', 1, 41, NULL, '{\"status\":\"current\"}', '192.168.1.111', '2025-08-27 11:56:22', '2025-08-27 11:56:22'),
(71, 'assignment.checked_out', 1, 37, NULL, '{\"status\":\"current\"}', '192.168.1.125', '2026-01-10 17:56:22', '2026-01-10 17:56:22'),
(72, 'assignment.checked_out', 1, 53, NULL, '{\"status\":\"current\"}', '192.168.1.166', '2025-09-04 17:56:22', '2025-09-04 17:56:22'),
(73, 'assignment.checked_out', 1, 25, NULL, '{\"status\":\"current\"}', '192.168.1.96', '2025-11-04 20:56:22', '2025-11-04 20:56:22'),
(74, 'assignment.checked_out', 1, 57, NULL, '{\"status\":\"current\"}', '192.168.1.227', '2025-11-15 07:56:22', '2025-11-15 07:56:22'),
(75, 'assignment.checked_out', 1, 13, NULL, '{\"status\":\"current\"}', '192.168.1.36', '2026-01-07 00:56:22', '2026-01-07 00:56:22'),
(76, 'assignment.checked_out', 1, 49, NULL, '{\"status\":\"current\"}', '192.168.1.220', '2025-12-10 19:56:22', '2025-12-10 19:56:22'),
(77, 'assignment.checked_out', 1, 57, NULL, '{\"status\":\"current\"}', '192.168.1.159', '2025-11-26 03:56:22', '2025-11-26 03:56:22'),
(78, 'assignment.checked_out', 1, 55, NULL, '{\"status\":\"current\"}', '192.168.1.74', '2025-12-02 20:56:22', '2025-12-02 20:56:22'),
(79, 'assignment.checked_out', 1, 60, NULL, '{\"status\":\"current\"}', '192.168.1.141', '2025-09-04 22:56:22', '2025-09-04 22:56:22'),
(80, 'assignment.checked_out', 1, 29, NULL, '{\"status\":\"current\"}', '192.168.1.20', '2025-09-20 10:56:22', '2025-09-20 10:56:22'),
(81, 'assignment.checked_out', 1, 50, NULL, '{\"status\":\"current\"}', '192.168.1.144', '2026-01-23 03:56:22', '2026-01-23 03:56:22'),
(82, 'assignment.checked_out', 1, 20, NULL, '{\"status\":\"current\"}', '192.168.1.140', '2025-12-24 05:56:22', '2025-12-24 05:56:22'),
(83, 'assignment.checked_out', 1, 55, NULL, '{\"status\":\"current\"}', '192.168.1.177', '2025-08-28 12:56:22', '2025-08-28 12:56:22'),
(84, 'assignment.checked_out', 1, 8, NULL, '{\"status\":\"current\"}', '192.168.1.213', '2025-12-08 04:56:22', '2025-12-08 04:56:22'),
(85, 'assignment.checked_out', 1, 61, NULL, '{\"status\":\"current\"}', '192.168.1.68', '2025-12-27 12:56:22', '2025-12-27 12:56:22'),
(86, 'assignment.checked_out', 1, 80, NULL, '{\"status\":\"current\"}', '192.168.1.146', '2025-12-12 17:56:22', '2025-12-12 17:56:22'),
(87, 'assignment.checked_out', 1, 71, NULL, '{\"status\":\"current\"}', '192.168.1.148', '2025-11-21 10:56:22', '2025-11-21 10:56:22'),
(88, 'assignment.checked_out', 1, 9, NULL, '{\"status\":\"current\"}', '192.168.1.81', '2026-01-13 22:56:22', '2026-01-13 22:56:22'),
(89, 'assignment.checked_out', 1, 57, NULL, '{\"status\":\"current\"}', '192.168.1.119', '2026-02-06 16:56:22', '2026-02-06 16:56:22'),
(90, 'assignment.checked_out', 1, 19, NULL, '{\"status\":\"current\"}', '192.168.1.4', '2026-01-09 21:56:22', '2026-01-09 21:56:22'),
(91, 'assignment.checked_out', 1, 56, NULL, '{\"status\":\"current\"}', '192.168.1.66', '2025-09-18 22:56:22', '2025-09-18 22:56:22'),
(92, 'assignment.checked_out', 1, 48, NULL, '{\"status\":\"current\"}', '192.168.1.188', '2026-01-14 16:56:22', '2026-01-14 16:56:22'),
(93, 'assignment.checked_out', 1, 50, NULL, '{\"status\":\"current\"}', '192.168.1.27', '2025-11-21 10:56:22', '2025-11-21 10:56:22'),
(94, 'assignment.checked_out', 1, 78, NULL, '{\"status\":\"current\"}', '192.168.1.103', '2025-11-22 14:56:22', '2025-11-22 14:56:22'),
(95, 'assignment.checked_out', 1, 25, NULL, '{\"status\":\"current\"}', '192.168.1.192', '2025-11-27 07:56:22', '2025-11-27 07:56:22'),
(96, 'assignment.checked_in', 1, 47, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.45', '2025-10-07 08:56:22', '2025-10-07 08:56:22'),
(97, 'assignment.checked_in', 1, 32, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.44', '2025-12-23 01:56:22', '2025-12-23 01:56:22'),
(98, 'assignment.checked_in', 1, 70, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.205', '2025-10-07 09:56:22', '2025-10-07 09:56:22'),
(99, 'assignment.checked_in', 1, 81, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.185', '2025-10-09 21:56:22', '2025-10-09 21:56:22'),
(100, 'assignment.checked_in', 1, 66, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.219', '2025-11-27 23:56:22', '2025-11-27 23:56:22'),
(101, 'assignment.checked_in', 1, 13, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.137', '2025-12-07 10:56:22', '2025-12-07 10:56:22'),
(102, 'assignment.checked_in', 1, 11, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.35', '2026-02-01 18:56:22', '2026-02-01 18:56:22'),
(103, 'assignment.checked_in', 1, 78, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.162', '2025-12-01 20:56:22', '2025-12-01 20:56:22'),
(104, 'assignment.checked_in', 1, 60, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.13', '2025-10-31 22:56:22', '2025-10-31 22:56:22'),
(105, 'assignment.checked_in', 1, 78, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.52', '2025-11-13 10:56:22', '2025-11-13 10:56:22'),
(106, 'assignment.checked_in', 1, 78, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.151', '2025-12-24 12:56:22', '2025-12-24 12:56:22'),
(107, 'assignment.checked_in', 1, 73, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.164', '2025-11-15 19:56:22', '2025-11-15 19:56:22'),
(108, 'assignment.checked_in', 1, 4, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.71', '2025-12-15 14:56:22', '2025-12-15 14:56:22'),
(109, 'assignment.checked_in', 1, 1, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.190', '2026-01-19 16:56:22', '2026-01-19 16:56:22'),
(110, 'assignment.checked_in', 1, 24, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.156', '2025-10-31 17:56:22', '2025-10-31 17:56:22'),
(111, 'assignment.checked_in', 1, 74, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.58', '2025-10-31 05:56:22', '2025-10-31 05:56:22'),
(112, 'assignment.checked_in', 1, 75, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.118', '2025-10-26 09:56:22', '2025-10-26 09:56:22'),
(113, 'assignment.checked_in', 1, 16, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.150', '2025-09-13 13:56:22', '2025-09-13 13:56:22'),
(114, 'assignment.checked_in', 1, 2, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.70', '2025-10-02 01:56:22', '2025-10-02 01:56:22'),
(115, 'assignment.checked_in', 1, 73, '{\"status\":\"previous\"}', '{\"status\":\"current\"}', '192.168.1.61', '2025-08-30 20:56:22', '2025-08-30 20:56:22'),
(116, 'maintenance.added', 1, 45, NULL, '{\"status\":\"current\"}', '192.168.1.184', '2025-12-07 05:56:22', '2025-12-07 05:56:22'),
(117, 'maintenance.added', 1, 77, NULL, '{\"status\":\"current\"}', '192.168.1.34', '2025-11-24 02:56:22', '2025-11-24 02:56:22'),
(118, 'maintenance.added', 1, 78, NULL, '{\"status\":\"current\"}', '192.168.1.198', '2025-09-16 18:56:22', '2025-09-16 18:56:22'),
(119, 'maintenance.added', 1, 64, NULL, '{\"status\":\"current\"}', '192.168.1.138', '2025-09-02 00:56:22', '2025-09-02 00:56:22'),
(120, 'maintenance.added', 1, 68, NULL, '{\"status\":\"current\"}', '192.168.1.235', '2025-11-03 10:56:22', '2025-11-03 10:56:22'),
(121, 'maintenance.added', 1, 41, NULL, '{\"status\":\"current\"}', '192.168.1.200', '2026-01-29 14:56:22', '2026-01-29 14:56:22'),
(122, 'maintenance.added', 1, 41, NULL, '{\"status\":\"current\"}', '192.168.1.249', '2025-09-19 01:56:22', '2025-09-19 01:56:22'),
(123, 'maintenance.added', 1, 52, NULL, '{\"status\":\"current\"}', '192.168.1.153', '2025-09-18 07:56:22', '2025-09-18 07:56:22'),
(124, 'maintenance.added', 1, 29, NULL, '{\"status\":\"current\"}', '192.168.1.16', '2026-01-02 10:56:22', '2026-01-02 10:56:22'),
(125, 'maintenance.added', 1, 65, NULL, '{\"status\":\"current\"}', '192.168.1.200', '2025-12-31 21:56:22', '2025-12-31 21:56:22'),
(126, 'maintenance.added', 1, 74, NULL, '{\"status\":\"current\"}', '192.168.1.35', '2025-10-13 03:56:22', '2025-10-13 03:56:22'),
(127, 'maintenance.added', 1, 36, NULL, '{\"status\":\"current\"}', '192.168.1.215', '2025-08-29 01:56:22', '2025-08-29 01:56:22'),
(128, 'maintenance.added', 1, 51, NULL, '{\"status\":\"current\"}', '192.168.1.115', '2026-02-20 23:56:22', '2026-02-20 23:56:22'),
(129, 'maintenance.added', 1, 34, NULL, '{\"status\":\"current\"}', '192.168.1.161', '2025-09-11 21:56:22', '2025-09-11 21:56:22'),
(130, 'maintenance.added', 1, 38, NULL, '{\"status\":\"current\"}', '192.168.1.21', '2026-01-08 15:56:22', '2026-01-08 15:56:22');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_tag` varchar(255) NOT NULL,
  `asset_category_id` bigint(20) UNSIGNED NOT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `make` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `vendor` varchar(255) DEFAULT NULL,
  `cost` decimal(12,2) DEFAULT NULL,
  `warranty_expiry` date DEFAULT NULL,
  `status` enum('in_use','in_stock','in_repair','retired','lost') NOT NULL DEFAULT 'in_stock',
  `condition` varchar(255) DEFAULT NULL,
  `room_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assigned_employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `asset_tag`, `asset_category_id`, `serial_number`, `make`, `model`, `purchase_date`, `vendor`, `cost`, `warranty_expiry`, `status`, `condition`, `room_id`, `assigned_employee_id`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PC-001', 1, 'CN0E06E3049', 'Dell', 'OptiPlex 7090', '2023-11-14', 'Amazon Business', 1264.36, '2025-01-25', 'in_use', 'Excellent', 1, 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(2, 'PC-002', 1, 'CN0EA085002', 'Dell', 'OptiPlex 7090', '2024-02-06', 'HP Store', 1032.61, '2025-05-19', 'in_use', 'Good', 2, 5, 'Minor wear. ', '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(3, 'PC-003', 1, 'CN05060460A', 'Dell', 'OptiPlex 7090', '2022-05-30', 'HP Store', 602.66, '2026-01-03', 'lost', 'Excellent', NULL, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(4, 'PC-004', 1, 'CN0805DA72D', 'Dell', 'OptiPlex 7090', '2022-10-28', 'SHI', 1937.40, '2026-03-30', 'in_stock', 'Good', 6, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(5, 'PC-005', 1, 'PFD7CDF5EF', 'Lenovo', 'ThinkCentre M90q', '2024-06-26', 'Insight', 1095.21, '2026-01-04', 'in_stock', 'Excellent', 10, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(6, 'PC-006', 1, 'PF1AC19113', 'Lenovo', 'ThinkCentre M90q', '2024-08-06', 'Amazon Business', 613.31, '2025-07-23', 'in_use', 'Good', 11, 19, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(7, 'PC-007', 1, 'PFDCE94040', 'Lenovo', 'ThinkCentre M90q', '2022-10-18', 'HP Store', 1471.82, '2026-01-22', 'in_use', 'Excellent', 8, 15, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(8, 'PC-008', 1, 'PFF4160FB4', 'Lenovo', 'ThinkCentre M720q', '2023-10-20', 'Amazon Business', 1951.81, '2025-03-13', 'in_stock', 'Excellent', 2, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(9, 'PC-009', 1, 'CN0CE63BD81', 'Dell', 'OptiPlex 7090', '2022-08-24', 'Insight', 573.38, '2025-08-23', 'in_repair', 'Fair', 1, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(10, 'PC-010', 1, 'PFFB344712', 'Lenovo', 'ThinkCentre M90q', '2022-07-31', 'SHI', 2201.38, '2025-03-19', 'in_use', 'Excellent', 8, 11, 'Minor wear. ', '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(11, 'PC-011', 1, 'PFDCA14157', 'Lenovo', 'ThinkCentre M90q', '2023-01-26', 'Dell Direct', 438.15, '2027-01-29', 'in_use', 'Excellent', 1, 4, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(12, 'PC-012', 1, 'PF115A57DE', 'Lenovo', 'ThinkCentre M720q', '2024-01-12', 'Amazon Business', 1563.34, '2025-02-18', 'in_use', 'Excellent', 1, 5, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(13, 'LAP-013', 2, 'PFC7A60C9F', 'Lenovo', 'ThinkPad X1 Carbon Gen 9', '2022-11-09', 'Amazon Business', 706.79, '2025-12-30', 'in_stock', 'Excellent', 12, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(14, 'LAP-014', 2, 'C02F4AA7473', 'Apple', 'MacBook Pro 14\" M1 Pro', '2025-09-27', 'CDW', 1371.06, '2026-01-27', 'in_stock', 'Good', 4, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(15, 'LAP-015', 2, 'C020D88067D', 'Apple', 'MacBook Air M2', '2024-12-11', 'SHI', 761.81, '2025-12-01', 'in_stock', 'Good', 8, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(16, 'LAP-016', 2, '9VBE1869D33', 'Dell', 'XPS 15 9510', '2026-02-06', 'Amazon Business', 1827.05, '2025-12-15', 'in_use', 'Fair', 11, 18, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(17, 'LAP-017', 2, 'PF50D9606C', 'Lenovo', 'ThinkPad T14 Gen 2', '2024-05-02', 'Insight', 2255.72, '2025-11-02', 'in_stock', 'Good', 11, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(18, 'LAP-018', 2, 'PF6B5DDD65', 'Lenovo', 'ThinkPad X1 Carbon Gen 9', '2025-09-20', 'CDW', 2499.50, '2025-12-23', 'in_repair', 'Good', 4, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(19, 'LAP-019', 2, '5CD033A75E4', 'HP', 'EliteBook 840 G8', '2022-06-05', 'Dell Direct', 1618.93, '2026-12-07', 'in_use', 'Excellent', 2, 3, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(20, 'LAP-020', 2, 'C027E1F1206', 'Apple', 'MacBook Air M2', '2023-10-10', 'Insight', 1888.23, '2026-08-10', 'in_use', 'Good', 11, 7, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(21, 'LAP-021', 2, 'PFC99BC913', 'Lenovo', 'ThinkPad T14 Gen 2', '2024-06-02', 'Insight', 2168.21, '2025-12-17', 'in_stock', 'Fair', 12, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(22, 'LAP-022', 2, 'C02358BB61C', 'Apple', 'MacBook Pro 14\" M1 Pro', '2023-01-29', 'Dell Direct', 645.13, '2027-06-24', 'in_use', 'Good', 12, 5, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(23, 'LAP-023', 2, 'PF6048AEA9', 'Lenovo', 'ThinkPad T14 Gen 2', '2023-05-14', 'Dell Direct', 1572.02, '2025-11-24', 'retired', 'Good', NULL, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(24, 'LAP-024', 2, '8VBB1D252E7', 'Dell', 'Latitude 5520', '2026-01-10', 'CDW', 2480.13, '2027-01-09', 'in_stock', 'Excellent', 4, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(25, 'LAP-025', 2, 'PF9C274330', 'Lenovo', 'ThinkPad T14 Gen 2', '2026-02-05', 'Insight', 2267.46, '2027-01-12', 'lost', 'Excellent', NULL, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(26, 'LAP-026', 2, 'PFE7F55050', 'Lenovo', 'ThinkPad T14 Gen 2', '2023-12-20', 'HP Store', 1685.52, '2025-10-21', 'in_repair', 'Good', 9, NULL, 'Minor wear. ', '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(27, 'MON-027', 3, 'CN0585167F4', 'Dell', 'U2720Q', '2024-10-20', 'Dell Direct', 1532.84, '2027-11-18', 'in_use', 'Good', 3, 14, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(28, 'MON-028', 3, 'LGE82A4C5B', 'LG', '24MP88HV-S', '2024-02-23', 'Amazon Business', 747.98, '2026-06-26', 'in_stock', 'Good', 14, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(29, 'MON-029', 3, 'LG3BBADF32', 'LG', '24MP88HV-S', '2025-01-15', 'Insight', 1851.98, '2028-02-04', 'lost', 'Fair', NULL, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(30, 'MON-030', 3, '5CD07C2DCB0', 'HP', 'E24 G4', '2022-04-03', 'SHI', 2338.59, '2023-04-17', 'in_stock', 'Fair', 14, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(31, 'MON-031', 3, 'BNQ6D1D15BB', 'BenQ', 'GW2480', '2021-10-18', 'Insight', 310.18, '2024-01-16', 'in_repair', 'Fair', 8, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(32, 'MON-032', 3, 'CN051D46720', 'Dell', 'U2720Q', '2021-06-08', 'HP Store', 1809.41, '2023-07-18', 'in_stock', 'Excellent', 13, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(33, 'MON-033', 3, '5CDE091CD7E', 'HP', 'E24 G4', '2021-04-03', 'Insight', 1975.90, '2023-08-03', 'in_use', 'Fair', 11, 19, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(34, 'MON-034', 3, 'BNQCFF636D8', 'BenQ', 'GW2480', '2021-08-03', 'SHI', 1970.30, '2024-12-18', 'in_use', 'Good', 12, 17, 'Minor wear. ', '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(35, 'MON-035', 3, 'LGDD846136', 'LG', '24MP88HV-S', '2022-12-12', 'Dell Direct', 1658.87, '2025-01-20', 'retired', 'Good', NULL, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(36, 'MON-036', 3, '5CD542F6EEA', 'HP', 'E24 G4', '2021-03-20', 'Insight', 1680.51, '2022-05-14', 'retired', 'Excellent', NULL, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(37, 'MON-037', 3, '5CDEB5EC0CD', 'HP', 'E24 G4', '2021-04-21', 'Dell Direct', 1632.91, '2022-08-29', 'in_use', 'Excellent', 8, 10, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(38, 'MON-038', 3, 'BNQ09B3F69E', 'BenQ', 'GW2480', '2021-06-12', 'Dell Direct', 512.92, '2024-08-06', 'in_use', 'Fair', 1, 4, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(39, 'MON-039', 3, '5CD9D25E189', 'HP', 'E24 G4', '2022-08-14', 'Amazon Business', 1768.39, '2026-01-22', 'in_use', 'Excellent', 2, 20, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(40, 'MON-040', 3, 'CN0D5A088A6', 'Dell', 'U2720Q', '2023-10-19', 'Amazon Business', 1862.95, '2024-12-12', 'in_use', 'Good', 3, 17, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(41, 'MON-041', 3, 'CN07AC72CA0', 'Dell', 'P2422H', '2022-01-23', 'Amazon Business', 2422.11, '2024-02-01', 'in_stock', 'Excellent', 13, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(42, 'PRN-042', 4, 'GAR949EE420', 'Canon', 'imageCLASS MF445dw', '2022-11-07', 'CDW', 2392.91, '2026-02-08', 'in_use', 'Good', 8, 2, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(43, 'PRN-043', 4, 'VNB4042CB19', 'HP', 'OfficeJet Pro 9015e', '2021-03-27', 'CDW', 797.88, '2024-04-29', 'in_stock', 'Excellent', 7, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(44, 'PRN-044', 4, 'VNB042661E5', 'HP', 'OfficeJet Pro 9015e', '2023-02-20', 'Amazon Business', 1328.81, '2025-03-06', 'in_repair', 'Excellent', 13, NULL, 'Minor wear. ', '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(45, 'PRN-045', 4, 'VNB773D1FC0', 'HP', 'LaserJet Pro M404dn', '2023-06-27', 'CDW', 1701.19, '2026-11-12', 'in_stock', 'Excellent', 10, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(46, 'PRN-046', 4, 'VNB2FB5D7B1', 'HP', 'OfficeJet Pro 9015e', '2022-05-05', 'Dell Direct', 1653.50, '2025-07-13', 'in_use', 'Good', 3, 19, 'Minor wear. ', '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(47, 'PRN-047', 4, 'E6J83E60EF6', 'Brother', 'HL-L2350DW', '2022-08-05', 'SHI', 1098.71, '2023-12-09', 'in_repair', 'Good', 14, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(48, 'TV-048', 5, 'LGA9C6B803', 'LG', '55\" 4K UHD', '2023-09-20', 'Amazon Business', 741.73, '2025-10-09', 'in_use', 'Good', 11, 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(49, 'TV-049', 5, 'Z4A234269DF', 'Samsung', '65\" QLED Q60A', '2023-04-06', 'SHI', 1665.57, '2026-08-21', 'in_stock', 'Excellent', 9, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(50, 'TV-050', 5, 'LG619FFF8B', 'LG', '55\" 4K UHD', '2024-08-24', 'CDW', 1726.86, '2028-01-23', 'in_use', 'Good', 12, 14, 'Minor wear. ', '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(51, 'TV-051', 5, 'Z4A41952BD1', 'Samsung', '65\" QLED Q60A', '2023-05-18', 'Insight', 842.97, '2026-07-06', 'in_use', 'Excellent', 8, 5, 'Minor wear. ', '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(52, 'PHN-052', 8, 'POLD373A8A0', 'Poly', 'VVX 401', '2021-05-17', 'SHI', 313.05, '2024-06-13', 'in_stock', 'Good', 13, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(53, 'PHN-053', 8, 'POL92E6D697', 'Poly', 'VVX 401', '2021-07-21', 'Dell Direct', 1561.16, '2024-12-20', 'in_use', 'Excellent', 1, 18, 'Minor wear. ', '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(54, 'PHN-054', 8, 'FCW10F22705', 'Cisco', 'IP Phone 8845', '2021-06-22', 'Insight', 866.63, '2023-11-25', 'in_use', 'Excellent', 2, 18, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(55, 'PHN-055', 8, 'YEAFA5AEBD6', 'Yealink', 'T54W', '2023-05-19', 'CDW', 2399.63, '2025-05-30', 'in_stock', 'Good', 12, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(56, 'PHN-056', 8, 'POL2E021179', 'Poly', 'VVX 401', '2022-05-21', 'Dell Direct', 2150.22, '2025-05-24', 'in_stock', 'Excellent', 1, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(57, 'PHN-057', 8, 'POL7AF77329', 'Poly', 'VVX 401', '2023-11-04', 'HP Store', 1221.63, '2026-02-05', 'in_use', 'Excellent', 3, 15, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(58, 'PHN-058', 8, 'YEAD8EA9D66', 'Yealink', 'T54W', '2021-05-26', 'Amazon Business', 1286.62, '2023-10-19', 'in_repair', 'Fair', 3, NULL, 'Minor wear. ', '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(59, 'PHN-059', 8, 'POLCE66A93D', 'Poly', 'VVX 401', '2021-06-10', 'Insight', 917.62, '2023-06-19', 'in_use', 'Fair', 11, 19, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(60, 'PHN-060', 8, 'POLEE4562C0', 'Poly', 'VVX 401', '2025-02-21', 'SHI', 2481.82, '2026-06-23', 'in_stock', 'Good', 2, NULL, 'Minor wear. ', '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(61, 'PHN-061', 8, 'YEA5331DFA1', 'Yealink', 'T54W', '2021-03-05', 'Insight', 2156.78, '2023-08-15', 'in_use', 'Good', 3, 8, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(62, 'TAB-062', 9, 'SFGB2B9EB6A', 'Microsoft', 'Surface Go 3', '2021-10-22', 'SHI', 1751.31, '2023-11-29', 'in_use', 'Good', 3, 14, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(63, 'TAB-063', 9, 'R5CDCBFAC9F', 'Samsung', 'Galaxy Tab S8', '2022-11-05', 'Insight', 774.94, '2025-11-15', 'in_stock', 'Good', 9, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(64, 'TAB-064', 9, 'R5C19E1B7A6', 'Samsung', 'Galaxy Tab S8', '2024-03-29', 'Amazon Business', 427.90, '2027-04-23', 'in_stock', 'Fair', 9, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(65, 'TAB-065', 9, 'R5CAF9775B6', 'Samsung', 'Galaxy Tab S8', '2021-12-19', 'CDW', 2437.94, '2024-04-02', 'in_stock', 'Fair', 5, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(66, 'TAB-066', 9, 'R5C471E4090', 'Samsung', 'Galaxy Tab S8', '2024-12-11', 'Insight', 1495.01, '2028-03-09', 'in_use', 'Excellent', 12, 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(67, 'NET-067', 7, 'FCW4F1ECA14', 'Cisco', 'Catalyst 2960', '2022-06-10', 'SHI', 851.56, '2024-08-04', 'in_stock', 'Fair', 4, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(68, 'NET-068', 7, 'NGF3C104B4', 'Netgear', 'GS324TP', '2023-08-03', 'Insight', 646.93, '2025-01-17', 'in_stock', 'Excellent', 6, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(69, 'NET-069', 7, 'NG491F5587', 'Netgear', 'GS324TP', '2022-08-06', 'SHI', 1299.14, '2023-12-30', 'retired', 'Good', NULL, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(70, 'NET-070', 7, 'UBNT280CD436', 'Ubiquiti', 'UniFi Switch 24', '2024-03-11', 'Insight', 2309.21, '2026-05-02', 'in_use', 'Excellent', 12, 16, 'Minor wear. ', '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(71, 'PER-071', 10, 'CN0FD40B3A4', 'Dell', 'KB216', '2023-09-04', 'Dell Direct', 2369.38, '2027-02-21', 'in_repair', 'Fair', 13, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(72, 'PER-072', 10, 'LOG625BF826', 'Logitech', 'MX Master 3', '2024-02-22', 'SHI', 2399.49, '2027-03-05', 'in_use', 'Fair', 8, 15, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(73, 'PER-073', 10, 'MS914CDDF4', 'Microsoft', 'Surface Keyboard', '2024-04-24', 'CDW', 864.54, '2027-06-25', 'in_use', 'Excellent', 1, 7, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(74, 'PER-074', 10, 'LOG9C8F44B3', 'Logitech', 'MX Master 3', '2023-05-07', 'SHI', 1331.78, '2025-10-04', 'in_stock', 'Excellent', 6, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(75, 'PER-075', 10, 'MSD47B306E', 'Microsoft', 'Surface Keyboard', '2024-08-13', 'CDW', 1687.13, '2025-11-11', 'in_use', 'Good', 2, 9, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(76, 'PER-076', 10, 'CN043D2F729', 'Dell', 'KB216', '2024-12-30', 'SHI', 926.89, '2028-05-19', 'in_use', 'Good', 1, 20, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(77, 'PER-077', 10, 'LOGF1743FDD', 'Logitech', 'MX Master 3', '2024-09-15', 'CDW', 573.15, '2026-01-01', 'retired', 'Good', NULL, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(78, 'PER-078', 10, 'MSCB287833', 'Microsoft', 'Surface Keyboard', '2023-09-16', 'SHI', 703.20, '2024-10-25', 'in_use', 'Good', 3, 6, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(79, 'SPK-079', 6, 'JBL8750508E', 'JBL', 'Professional 305P', '2023-11-07', 'HP Store', 2467.02, '2026-02-03', 'lost', 'Good', NULL, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(80, 'SPK-080', 6, 'JBLB33199FD', 'JBL', 'Professional 305P', '2022-08-19', 'Insight', 993.60, '2023-10-14', 'in_stock', 'Excellent', 3, NULL, 'Minor wear. ', '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(81, 'SPK-081', 6, 'JBL5CBCBBFD', 'JBL', 'Professional 305P', '2024-06-18', 'HP Store', 761.57, '2027-08-14', 'in_use', 'Excellent', 12, 16, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL),
(82, 'SPK-082', 6, 'LOG930F68F8', 'Logitech', 'Z207', '2022-05-12', 'Dell Direct', 2269.25, '2024-10-13', 'in_stock', 'Excellent', 4, NULL, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `asset_assignments`
--

CREATE TABLE `asset_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `checked_out_at` datetime NOT NULL,
  `checked_in_at` datetime DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'checked_out',
  `performed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asset_assignments`
--

INSERT INTO `asset_assignments` (`id`, `asset_id`, `employee_id`, `checked_out_at`, `checked_in_at`, `status`, `performed_by`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-11-05 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(2, 2, 5, '2026-01-25 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(3, 6, 19, '2026-01-13 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(4, 7, 15, '2025-11-05 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(5, 10, 11, '2026-01-31 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(6, 11, 4, '2025-10-28 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(7, 12, 5, '2026-02-10 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(8, 16, 18, '2025-10-26 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(9, 19, 3, '2026-01-12 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(10, 20, 7, '2025-11-20 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(11, 22, 5, '2025-12-08 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(12, 27, 14, '2026-01-13 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(13, 33, 19, '2025-11-16 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(14, 34, 17, '2026-02-18 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(15, 37, 10, '2026-01-20 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(16, 38, 4, '2026-01-09 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(17, 39, 20, '2025-12-20 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(18, 40, 17, '2025-12-08 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(19, 42, 2, '2025-11-14 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(20, 46, 19, '2026-01-28 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(21, 48, 1, '2025-11-24 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(22, 50, 14, '2026-01-30 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(23, 51, 5, '2025-12-07 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(24, 53, 18, '2025-10-29 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(25, 54, 18, '2025-11-08 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(26, 57, 15, '2025-11-03 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(27, 59, 19, '2025-12-02 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(28, 61, 8, '2026-02-18 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(29, 62, 14, '2025-12-07 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(30, 66, 1, '2026-01-05 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(31, 70, 16, '2025-10-28 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(32, 72, 15, '2025-12-10 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(33, 73, 7, '2026-02-10 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(34, 75, 9, '2026-01-07 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(35, 76, 20, '2025-12-26 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(36, 78, 6, '2025-11-27 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(37, 81, 16, '2025-12-16 01:56:22', NULL, 'checked_out', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(38, 72, 7, '2025-04-12 01:56:22', '2025-12-27 01:56:22', 'checked_in', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(39, 81, 19, '2025-06-13 01:56:22', '2026-01-20 01:56:22', 'checked_in', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(40, 24, 4, '2025-11-06 01:56:22', '2026-01-14 01:56:22', 'checked_in', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(41, 12, 2, '2025-04-30 01:56:22', '2026-01-01 01:56:22', 'checked_in', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(42, 57, 18, '2025-03-10 01:56:22', '2025-12-24 01:56:22', 'checked_in', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(43, 51, 12, '2025-08-08 01:56:22', '2025-12-09 01:56:22', 'checked_in', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(44, 6, 2, '2025-07-19 01:56:22', '2025-12-31 01:56:22', 'checked_in', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(45, 46, 19, '2025-03-26 01:56:22', '2025-12-09 01:56:22', 'checked_in', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(46, 70, 13, '2025-06-19 01:56:22', '2026-01-21 01:56:22', 'checked_in', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(47, 43, 4, '2025-10-14 01:56:22', '2026-01-22 01:56:22', 'checked_in', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(48, 4, 9, '2025-06-03 01:56:22', '2026-01-24 01:56:22', 'checked_in', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(49, 2, 19, '2025-09-09 01:56:22', '2026-01-06 01:56:22', 'checked_in', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(50, 78, 8, '2025-06-28 01:56:22', '2026-01-23 01:56:22', 'checked_in', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(51, 5, 10, '2025-06-24 01:56:22', '2026-01-24 01:56:22', 'checked_in', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(52, 54, 5, '2025-01-28 01:56:22', '2025-12-22 01:56:22', 'checked_in', 1, NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22');

-- --------------------------------------------------------

--
-- Table structure for table `asset_categories`
--

CREATE TABLE `asset_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(64) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asset_categories`
--

INSERT INTO `asset_categories` (`id`, `name`, `slug`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Computer', 'computer', 'desktop', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(2, 'Laptop', 'laptop', 'laptop', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(3, 'Monitor', 'monitor', 'monitor', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(4, 'Printer', 'printer', 'printer', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(5, 'TV', 'tv', 'tv', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(6, 'Speaker', 'speaker', 'speaker', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(7, 'Network Equipment', 'networking', 'router', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(8, 'Phone', 'phone', 'phone', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(9, 'Tablet', 'tablet', 'tablet', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(10, 'Peripheral', 'peripheral', 'keyboard', '2026-02-23 06:56:22', '2026-02-23 06:56:22');

-- --------------------------------------------------------

--
-- Table structure for table `asset_fields`
--

CREATE TABLE `asset_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `input_type` varchar(255) NOT NULL DEFAULT 'text',
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `is_required` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asset_fields`
--

INSERT INTO `asset_fields` (`id`, `asset_category_id`, `name`, `key`, `input_type`, `options`, `is_required`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'CPU', 'cpu', 'text', NULL, 0, 0, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(2, 1, 'RAM', 'ram', 'text', NULL, 0, 1, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(3, 1, 'Storage', 'storage', 'text', NULL, 0, 2, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(4, 1, 'OS', 'os', 'text', NULL, 0, 3, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(5, 1, 'IP Address', 'ip', 'text', NULL, 0, 4, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(6, 1, 'MAC Address', 'mac', 'text', NULL, 0, 5, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(7, 2, 'CPU', 'cpu', 'text', NULL, 0, 0, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(8, 2, 'RAM', 'ram', 'text', NULL, 0, 1, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(9, 2, 'Storage', 'storage', 'text', NULL, 0, 2, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(10, 2, 'OS', 'os', 'text', NULL, 0, 3, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(11, 4, 'IP Address', 'ip', 'text', NULL, 0, 0, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(12, 4, 'Toner model', 'toner_model', 'text', NULL, 0, 1, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(13, 4, 'Type', 'type', 'select', '[\"Laser\",\"Inkjet\",\"Multifunction\"]', 0, 2, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(14, 5, 'Size (inches)', 'size', 'number', NULL, 0, 0, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(15, 5, 'HDMI ports', 'hdmi_ports', 'number', NULL, 0, 1, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(16, 6, 'Wattage', 'wattage', 'text', NULL, 0, 0, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(17, 3, 'Size (inches)', 'size', 'number', NULL, 0, 0, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(18, 3, 'Panel type', 'panel_type', 'text', NULL, 0, 1, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(19, 3, 'Resolution', 'resolution', 'text', NULL, 0, 2, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(20, 9, 'Screen size (inches)', 'screen_size', 'number', NULL, 0, 0, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(21, 9, 'OS', 'os', 'text', NULL, 0, 1, '2026-02-23 06:56:22', '2026-02-23 06:56:22');

-- --------------------------------------------------------

--
-- Table structure for table `asset_field_values`
--

CREATE TABLE `asset_field_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` bigint(20) UNSIGNED NOT NULL,
  `asset_field_id` bigint(20) UNSIGNED NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asset_field_values`
--

INSERT INTO `asset_field_values` (`id`, `asset_id`, `asset_field_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Intel Core i5-10400', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(2, 1, 5, '10.0.10.218', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(3, 1, 6, 'f0:9d:19:17:95:d1', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(4, 1, 4, 'Windows 11 Pro', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(5, 1, 2, '16 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(6, 1, 3, '1 TB SSD', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(7, 2, 1, 'Apple M2', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(8, 2, 5, '10.0.11.205', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(9, 2, 6, '35:79:16:ec:03:6d', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(10, 2, 4, 'macOS Sonoma', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(11, 2, 2, '16 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(12, 2, 3, '512 GB SSD', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(13, 3, 1, 'Intel Core i7-12700', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(14, 3, 5, '10.0.3.74', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(15, 3, 6, '45:6f:dc:5a:4a:09', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(16, 3, 4, 'Windows 10 Pro', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(17, 3, 2, '16 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(18, 3, 3, '1 TB SSD', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(19, 4, 1, 'AMD Ryzen 5 5600G', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(20, 4, 5, '10.0.16.158', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(21, 4, 6, 'fa:01:0c:9b:3b:c4', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(22, 4, 4, 'Windows 11 Pro', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(23, 4, 2, '32 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(24, 4, 3, '1 TB SSD', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(25, 5, 1, 'Apple M2', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(26, 5, 5, '10.0.36.11', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(27, 5, 6, '7a:24:d8:94:7b:fe', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(28, 5, 4, 'Windows 11 Pro', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(29, 5, 2, '64 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(30, 5, 3, '512 GB NVMe', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(31, 6, 1, 'Intel Core i7-12700', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(32, 6, 5, '10.0.40.147', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(33, 6, 6, '44:6a:62:5c:f8:d9', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(34, 6, 4, 'macOS Sonoma', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(35, 6, 2, '8 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(36, 6, 3, '1 TB SSD', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(37, 7, 1, 'Intel Core i5-10400', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(38, 7, 5, '10.0.37.230', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(39, 7, 6, '74:73:18:ec:d1:cf', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(40, 7, 4, 'macOS Ventura', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(41, 7, 2, '8 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(42, 7, 3, '512 GB NVMe', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(43, 8, 1, 'Intel Core i5-12500', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(44, 8, 5, '10.0.44.15', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(45, 8, 6, '71:36:c6:d3:35:a7', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(46, 8, 4, 'macOS Sonoma', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(47, 8, 2, '32 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(48, 8, 3, '512 GB NVMe', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(49, 9, 1, 'Intel Core i5-12500', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(50, 9, 5, '10.0.8.161', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(51, 9, 6, '10:59:c2:ee:a9:8b', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(52, 9, 4, 'Windows 11 Pro', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(53, 9, 2, '64 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(54, 9, 3, '256 GB SSD', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(55, 10, 1, 'Intel Core i5-10400', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(56, 10, 5, '10.0.41.192', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(57, 10, 6, '53:d8:be:a0:b4:25', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(58, 10, 4, 'macOS Ventura', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(59, 10, 2, '8 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(60, 10, 3, '256 GB NVMe', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(61, 11, 1, 'Apple M2', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(62, 11, 5, '10.0.47.161', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(63, 11, 6, '17:80:d8:17:bf:dc', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(64, 11, 4, 'Windows 10 Pro', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(65, 11, 2, '16 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(66, 11, 3, '512 GB NVMe', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(67, 12, 1, 'Intel Core i7-12700', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(68, 12, 5, '10.0.14.197', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(69, 12, 6, '27:8d:19:c3:ba:0e', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(70, 12, 4, 'macOS Sonoma', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(71, 12, 2, '32 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(72, 12, 3, '512 GB NVMe', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(73, 13, 7, 'Apple M2', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(74, 13, 10, 'Windows 11 Pro', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(75, 13, 8, '16 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(76, 13, 9, '256 GB SSD', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(77, 14, 7, 'Intel Core i7-12700', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(78, 14, 10, 'Windows 11 Pro', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(79, 14, 8, '64 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(80, 14, 9, '512 GB SSD', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(81, 15, 7, 'Intel Core i5-10400', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(82, 15, 10, 'Windows 10 Pro', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(83, 15, 8, '32 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(84, 15, 9, '1 TB SSD', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(85, 16, 7, 'AMD Ryzen 5 5600G', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(86, 16, 10, 'macOS Sonoma', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(87, 16, 8, '16 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(88, 16, 9, '256 GB SSD', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(89, 17, 7, 'Intel Core i5-12500', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(90, 17, 10, 'Windows 11 Pro', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(91, 17, 8, '32 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(92, 17, 9, '512 GB NVMe', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(93, 18, 7, 'Intel Core i7-12700', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(94, 18, 10, 'macOS Sonoma', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(95, 18, 8, '32 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(96, 18, 9, '256 GB NVMe', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(97, 19, 7, 'Intel Core i7-12700', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(98, 19, 10, 'Windows 10 Pro', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(99, 19, 8, '16 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(100, 19, 9, '1 TB SSD', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(101, 20, 7, 'Intel Core i7-12700', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(102, 20, 10, 'macOS Sonoma', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(103, 20, 8, '64 GB', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(104, 20, 9, '512 GB NVMe', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(105, 42, 11, '10.0.22.206', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(106, 42, 12, 'CE278A', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(107, 42, 13, 'Multifunction', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(108, 43, 11, '10.0.3.14', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(109, 43, 12, 'TN660', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(110, 43, 13, 'Multifunction', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(111, 44, 11, '10.0.13.46', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(112, 44, 12, 'CE278A', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(113, 44, 13, 'Multifunction', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(114, 45, 11, '10.0.41.219', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(115, 45, 12, 'TN660', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(116, 45, 13, 'Multifunction', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(117, 27, 18, 'IPS', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(118, 27, 19, '1920x1080', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(119, 27, 17, '24', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(120, 28, 18, 'IPS', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(121, 28, 19, '1920x1080', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(122, 28, 17, '27', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(123, 29, 18, 'IPS', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(124, 29, 19, '1920x1080', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(125, 29, 17, '24', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(126, 30, 18, 'IPS', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(127, 30, 19, '1920x1080', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(128, 30, 17, '27', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(129, 31, 18, 'IPS', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(130, 31, 19, '1920x1080', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(131, 31, 17, '32', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(132, 32, 18, 'IPS', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(133, 32, 19, '1920x1080', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(134, 32, 17, '32', '2026-02-23 06:56:22', '2026-02-23 06:56:22');

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `size` bigint(20) UNSIGNED DEFAULT NULL,
  `uploaded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'IT', 'IT', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(2, 'HR', 'HR', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(3, 'Operations', 'OPS', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(4, 'Finance', 'FIN', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(5, 'Engineering', 'ENG', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(6, 'Marketing', 'MKT', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(7, 'Sales', 'SAL', '2026-02-23 06:56:22', '2026-02-23 06:56:22');

-- --------------------------------------------------------

--
-- Table structure for table `digital_assets`
--

CREATE TABLE `digital_assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'subscription',
  `vendor` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `license_key_reference` varchar(255) DEFAULT NULL COMMENT 'Masked key or reference ID',
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `renewal_date` date DEFAULT NULL,
  `next_billing_date` date DEFAULT NULL,
  `billing_cycle` varchar(255) DEFAULT NULL,
  `cost` decimal(12,2) DEFAULT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Total seats/users/licenses',
  `auto_renew` tinyint(1) NOT NULL DEFAULT 0,
  `terms_url` varchar(255) DEFAULT NULL,
  `portal_url` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL COMMENT 'e.g. Productivity, Security, Development',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `digital_assets`
--

INSERT INTO `digital_assets` (`id`, `name`, `type`, `vendor`, `product_name`, `sku`, `description`, `license_key_reference`, `status`, `start_date`, `end_date`, `renewal_date`, `next_billing_date`, `billing_cycle`, `cost`, `currency`, `quantity`, `auto_renew`, `terms_url`, `portal_url`, `category`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Microsoft 365 E3', 'subscription', 'Microsoft', 'Microsoft 365 E3', 'SPE_E3', 'Office apps, Exchange, Teams, OneDrive, SharePoint. Per-user subscription.', NULL, 'active', '2025-01-23', NULL, '2027-02-23', '2026-03-23', 'monthly', 36.00, 'USD', 50, 1, 'https://www.microsoft.com/en-us/licensing/docs', 'https://admin.microsoft.com', 'Productivity', 'Annual commitment; monthly billing. Includes Windows 10/11 upgrade.', '2026-02-23 19:26:03', '2026-02-23 21:40:51'),
(2, 'Adobe Creative Cloud Teams', 'subscription', 'Adobe', 'Creative Cloud All Apps', 'CC-TEAMS', 'Full Creative Cloud: Photoshop, Illustrator, InDesign, Premiere, etc.', NULL, 'active', '2025-11-23', NULL, '2026-05-23', '2026-03-23', 'annually', 599.00, 'USD', 10, 1, 'https://www.adobe.com/legal/terms.html', 'https://adminconsole.adobe.com', 'Creative', 'Per-seat annual. Billed upfront.', '2026-02-23 19:26:03', '2026-02-23 19:26:03'),
(3, 'Windows 10 Pro (Volume)', 'license', 'Microsoft', 'Windows 10 Pro', 'WIN10-PRO-VL', 'Volume license for Windows 10 Pro. Upgrade from OEM.', 'XXXXX-XXXXX-XXXXX-XXXXX-XXXXX', 'active', '2024-02-23', NULL, NULL, NULL, 'one_time', 189.00, 'USD', 100, 0, NULL, 'https://vlsc.microsoft.com', 'Operating system', 'Perpetual. Software Assurance not included.', '2026-02-23 19:26:03', '2026-02-23 19:26:03'),
(4, 'Slack Business+', 'saas', 'Slack', 'Slack Business+', NULL, 'Team messaging, channels, integrations, SSO, compliance exports.', NULL, 'active', '2026-01-23', NULL, '2026-03-23', '2026-03-23', 'monthly', 12.50, 'USD', 25, 1, 'https://slack.com/terms-of-service', 'https://my.slack.com/admin', 'Productivity', 'Billed monthly. Per active user.', '2026-02-23 19:26:03', '2026-02-23 19:26:03'),
(5, 'Cisco AnyConnect (100 users)', 'license', 'Cisco', 'AnyConnect Secure Mobility Client', 'AC-SEC-100', 'VPN client licenses. 100 concurrent users.', 'AC-REF-****-****', 'active', '2025-02-23', '2027-02-23', '2026-02-28', NULL, 'annually', 1200.00, 'USD', 100, 0, NULL, 'https://software.cisco.com', 'Security', 'Smart license. Renewal due in 12 months.', '2026-02-23 19:26:03', '2026-02-23 21:45:46'),
(6, 'Zoom Pro', 'subscription', 'Zoom', 'Zoom Pro', NULL, 'Meeting hosting, recording, 30h limit, 100 participants.', NULL, 'trial', '2026-02-09', '2026-02-22', NULL, NULL, 'monthly', 14.99, 'USD', 5, 0, 'https://zoom.us/terms', 'https://zoom.us/account', 'Productivity', '30-day trial. Convert to paid before end date.', '2026-02-23 19:26:03', '2026-02-23 22:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `digital_asset_assignments`
--

CREATE TABLE `digital_asset_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `digital_asset_id` bigint(20) UNSIGNED NOT NULL,
  `assignable_type` varchar(255) NOT NULL,
  `assignable_id` bigint(20) UNSIGNED NOT NULL,
  `assigned_at` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `digital_asset_assignments`
--

INSERT INTO `digital_asset_assignments` (`id`, `digital_asset_id`, `assignable_type`, `assignable_id`, `assigned_at`, `notes`, `created_at`, `updated_at`) VALUES
(1, 6, 'App\\Models\\Employee', 12, '2026-02-23', NULL, '2026-02-23 22:03:56', '2026-02-23 22:03:56'),
(2, 6, 'App\\Models\\Employee', 19, '2026-02-23', NULL, '2026-02-23 22:04:01', '2026-02-23 22:04:01'),
(3, 6, 'App\\Models\\Employee', 7, '2026-02-23', NULL, '2026-02-23 22:04:04', '2026-02-23 22:04:04'),
(4, 6, 'App\\Models\\Employee', 3, '2026-02-23', NULL, '2026-02-23 22:04:07', '2026-02-23 22:04:07'),
(5, 6, 'App\\Models\\Employee', 17, '2026-02-23', NULL, '2026-02-23 22:04:12', '2026-02-23 22:04:12');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `department_id`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 1, 'john.doe@company.com', '+1 555-0101', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(2, 'Jane Smith', 2, 'jane.smith@company.com', '+1 555-0102', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(3, 'Bob Wilson', 3, 'bob.wilson@company.com', '+1 555-0103', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(4, 'Maria Garcia', 4, 'maria.garcia@company.com', '+1 555-0104', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(5, 'David Kim', 5, 'david.kim@company.com', '+1 555-0105', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(6, 'Sarah Johnson', 6, 'sarah.johnson@company.com', '+1 555-0106', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(7, 'James Wright', 1, 'james.wright@company.com', '+1 555-0107', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(8, 'Emily Davis', 7, 'emily.davis@company.com', '+1 555-0108', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(9, 'Michael Brown', 5, 'michael.brown@company.com', '+1 555-0109', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(10, 'Lisa Anderson', 2, 'lisa.anderson@company.com', '+1 555-0110', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(11, 'Chris Taylor', 3, 'chris.taylor@company.com', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(12, 'Amanda Martinez', 4, 'amanda.martinez@company.com', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(13, 'Ryan Cooper', 1, 'ryan.cooper@company.com', '+1 555-0111', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(14, 'Nicole Foster', 7, 'nicole.foster@company.com', '+1 555-0112', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(15, 'Kevin Nguyen', 5, 'kevin.nguyen@company.com', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(16, 'Rachel Green', 6, 'rachel.green@company.com', '+1 555-0114', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(17, 'Tom Harris', 1, 'tom.harris@company.com', '+1 555-0115', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(18, 'Olivia White', 2, 'olivia.white@company.com', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(19, 'Daniel Clark', 3, 'daniel.clark@company.com', '+1 555-0117', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(20, 'Sophie Lewis', 4, 'sophie.lewis@company.com', '+1 555-0118', '2026-02-23 06:56:22', '2026-02-23 06:56:22');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_logs`
--

CREATE TABLE `maintenance_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `performed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('repair','upgrade','inspection') NOT NULL,
  `notes` text DEFAULT NULL,
  `attachment_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `maintenance_logs`
--

INSERT INTO `maintenance_logs` (`id`, `asset_id`, `date`, `performed_by`, `type`, `notes`, `attachment_path`, `created_at`, `updated_at`) VALUES
(1, 7, '2025-11-24', 1, 'upgrade', 'SSD upgrade to 1 TB.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(2, 65, '2025-06-28', 1, 'upgrade', 'SSD upgrade to 1 TB.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(3, 44, '2025-08-15', 1, 'inspection', 'Firmware update applied.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(4, 28, '2025-11-01', 1, 'inspection', 'No issues found.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(5, 50, '2025-03-13', 1, 'upgrade', 'RAM upgraded to 32 GB.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(6, 71, '2025-06-17', 1, 'inspection', 'Firmware update applied.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(7, 4, '2025-09-09', 1, 'repair', 'RAM reseated.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(8, 19, '2025-08-29', 1, 'inspection', 'No issues found.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(9, 10, '2025-06-10', 1, 'upgrade', 'SSD upgrade to 1 TB.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(10, 25, '2025-03-09', 1, 'upgrade', 'SSD upgrade to 1 TB.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(11, 80, '2025-12-20', 1, 'inspection', 'No issues found.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(12, 58, '2025-04-29', 1, 'upgrade', 'RAM upgraded to 32 GB.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(13, 27, '2025-04-03', 1, 'inspection', 'Annual hardware check – passed.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(14, 50, '2025-08-24', 1, 'upgrade', 'OS upgrade to Windows 11.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(15, 5, '2025-12-13', 1, 'upgrade', 'RAM upgraded to 32 GB.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(16, 72, '2025-06-21', 1, 'repair', 'Replaced faulty power supply.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(17, 18, '2025-12-25', 1, 'inspection', 'Firmware update applied.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(18, 1, '2025-05-02', 1, 'upgrade', 'SSD upgrade to 1 TB.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(19, 68, '2025-07-02', 1, 'repair', 'RAM reseated.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(20, 11, '2026-01-04', 1, 'inspection', 'No issues found.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(21, 43, '2025-12-16', 1, 'repair', 'HDD replaced with SSD.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(22, 72, '2025-10-15', 1, 'inspection', 'No issues found.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(23, 30, '2025-02-24', 1, 'upgrade', 'SSD upgrade to 1 TB.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(24, 62, '2025-10-26', 1, 'upgrade', 'SSD upgrade to 1 TB.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(25, 26, '2026-02-10', 1, 'upgrade', 'SSD upgrade to 1 TB.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(26, 60, '2025-08-04', 1, 'upgrade', 'RAM upgraded to 32 GB.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(27, 64, '2025-08-03', 1, 'inspection', 'No issues found.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(28, 60, '2025-05-02', 1, 'repair', 'RAM reseated.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(29, 38, '2025-07-31', 1, 'upgrade', 'OS upgrade to Windows 11.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(30, 40, '2025-03-25', 1, 'repair', 'RAM reseated.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(31, 46, '2025-08-01', 1, 'inspection', 'Annual hardware check – passed.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(32, 24, '2025-11-17', 1, 'repair', 'Replaced faulty power supply.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(33, 20, '2025-11-05', 1, 'repair', 'Display cable replaced.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(34, 33, '2026-01-31', 1, 'repair', 'Display cable replaced.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(35, 6, '2025-04-18', 1, 'upgrade', 'SSD upgrade to 1 TB.', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22');

-- --------------------------------------------------------

--
-- Table structure for table `map_placements`
--

CREATE TABLE `map_placements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` bigint(20) UNSIGNED NOT NULL,
  `x` int(11) NOT NULL DEFAULT 0,
  `y` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `map_rooms`
--

CREATE TABLE `map_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED DEFAULT NULL,
  `x` int(11) NOT NULL DEFAULT 0,
  `y` int(11) NOT NULL DEFAULT 0,
  `width` int(10) UNSIGNED NOT NULL DEFAULT 100,
  `height` int(10) UNSIGNED NOT NULL DEFAULT 80,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_password_reset_tokens_table', 1),
(3, '0001_01_01_000002_create_sessions_table', 1),
(4, '2024_01_01_000003_create_roles_tables', 1),
(5, '2024_01_01_000004_create_asset_categories_table', 1),
(6, '2024_01_01_000005_create_rooms_table', 1),
(7, '2024_01_01_000006_create_employees_table', 1),
(8, '2024_01_01_000007_create_assets_table', 1),
(9, '2024_01_01_000008_create_asset_fields_table', 1),
(10, '2024_01_01_000009_create_asset_field_values_table', 1),
(11, '2024_01_01_000010_create_asset_assignments_table', 1),
(12, '2024_01_01_000011_create_maintenance_logs_table', 1),
(13, '2024_01_01_000012_create_activity_logs_table', 1),
(14, '2024_01_01_000013_create_attachments_table', 1),
(15, '2024_01_01_000014_create_departments_table', 1),
(16, '2024_01_01_000015_add_department_id_to_employees_table', 1),
(17, '2024_01_01_000016_add_permissions_to_roles_and_role_id_to_users', 1),
(18, '2025_02_12_000001_add_password_to_assets_table', 1),
(19, '2025_02_12_000002_remove_password_from_assets_table', 1),
(20, '2025_02_22_000001_add_icon_to_asset_categories_table', 1),
(21, '2025_02_22_000002_create_map_rooms_table', 1),
(22, '2025_02_22_000003_create_map_placements_table', 1),
(23, '2025_02_23_000001_create_work_stations_table', 1),
(24, '2025_02_23_000002_add_work_station_id_to_assets_table', 1),
(25, '2025_02_24_000001_remove_work_stations', 2),
(26, '2025_02_25_000001_create_digital_assets_table', 2),
(27, '2025_02_25_000002_create_digital_asset_assignments_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `label`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '[\"*\"]', '2026-02-23 06:56:21', '2026-02-23 06:56:21'),
(2, 'technician', 'Technician', '[\"dashboard.view\",\"assets.view\",\"assets.create\",\"assets.update\",\"assets.delete\",\"assets.assign\",\"assets.upload_attachment\",\"assets.delete_attachment\",\"assets.maintenance\",\"assets.bulk\",\"assets.export\",\"assets.import\",\"employees.view\",\"employees.create\",\"employees.update\",\"employees.delete\",\"departments.view\",\"departments.create\",\"departments.update\",\"departments.delete\",\"rooms.view\",\"rooms.create\",\"rooms.update\",\"rooms.delete\",\"categories.view\",\"categories.create\",\"categories.update\",\"categories.delete\",\"digital_assets.view\",\"digital_assets.create\",\"digital_assets.update\",\"digital_assets.delete\",\"digital_assets.assign\",\"users.view\",\"roles.view\",\"reports.view\"]', '2026-02-23 06:56:21', '2026-02-23 19:26:09'),
(3, 'viewer', 'Viewer', '[\"dashboard.view\",\"assets.view\",\"employees.view\",\"departments.view\",\"rooms.view\",\"categories.view\",\"digital_assets.view\",\"users.view\",\"roles.view\",\"reports.view\"]', '2026-02-23 06:56:21', '2026-02-23 19:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `location`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Office A', 'Building 1, Floor 2', 'B1-2A', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(2, 'Office B', 'Building 1, Floor 2', 'B1-2B', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(3, 'Office C', 'Building 1, Floor 2', 'B1-2C', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(4, 'Conference Room Alpha', 'Building 1, Floor 2', 'B1-2CF', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(5, 'Server Room', 'Building 1, Basement', 'B1-SR', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(6, 'IT Storage', 'Building 1, Basement', 'B1-ST', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(7, 'Reception', 'Building 1, Floor 1', 'B1-1R', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(8, 'HR Suite', 'Building 1, Floor 3', 'B1-3HR', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(9, 'Meeting Room 1', 'Building 2', 'B2-M1', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(10, 'Meeting Room 2', 'Building 2', 'B2-M2', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(11, 'Open Space West', 'Building 1, Floor 2', 'B1-2OW', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(12, 'Open Space East', 'Building 1, Floor 2', 'B1-2OE', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(13, 'Break Room', 'Building 1, Floor 1', 'B1-1BR', '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(14, 'Print Room', 'Building 1, Floor 2', 'B1-2PR', '2026-02-23 06:56:22', '2026-02-23 06:56:22');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Alex Rivera', 'admin@example.com', NULL, '$2y$12$rFC1mTCs7GRAQiwHUG9wJ.VKjl7vpsXxDk6f9exwUpjPixHcT5.c6', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(2, 2, 'Sam Chen', 'technician@example.com', NULL, '$2y$12$4Wj2GAbFpAXOhRs9v1ojg.2s6Nj/OMRlTFCjOho/717whBxYfjXtm', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22'),
(3, 3, 'Jordan Lee', 'viewer@example.com', NULL, '$2y$12$uX7yPa5otCB8uUdyREJFeO94C3CBlpAs9cUHCK4Qp9XAG3PeKeROi', NULL, '2026-02-23 06:56:22', '2026-02-23 06:56:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`),
  ADD KEY `activity_logs_asset_id_foreign` (`asset_id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `assets_asset_tag_unique` (`asset_tag`),
  ADD KEY `assets_asset_category_id_foreign` (`asset_category_id`),
  ADD KEY `assets_room_id_foreign` (`room_id`),
  ADD KEY `assets_assigned_employee_id_foreign` (`assigned_employee_id`),
  ADD KEY `assets_serial_number_index` (`serial_number`);

--
-- Indexes for table `asset_assignments`
--
ALTER TABLE `asset_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asset_assignments_asset_id_foreign` (`asset_id`),
  ADD KEY `asset_assignments_employee_id_foreign` (`employee_id`),
  ADD KEY `asset_assignments_performed_by_foreign` (`performed_by`);

--
-- Indexes for table `asset_categories`
--
ALTER TABLE `asset_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asset_categories_name_unique` (`name`),
  ADD UNIQUE KEY `asset_categories_slug_unique` (`slug`);

--
-- Indexes for table `asset_fields`
--
ALTER TABLE `asset_fields`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asset_fields_asset_category_id_key_unique` (`asset_category_id`,`key`);

--
-- Indexes for table `asset_field_values`
--
ALTER TABLE `asset_field_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asset_field_values_asset_id_asset_field_id_unique` (`asset_id`,`asset_field_id`),
  ADD KEY `asset_field_values_asset_field_id_foreign` (`asset_field_id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachments_asset_id_foreign` (`asset_id`),
  ADD KEY `attachments_uploaded_by_foreign` (`uploaded_by`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`);

--
-- Indexes for table `digital_assets`
--
ALTER TABLE `digital_assets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `digital_assets_sku_index` (`sku`);

--
-- Indexes for table `digital_asset_assignments`
--
ALTER TABLE `digital_asset_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `digital_asset_assignments_digital_asset_id_foreign` (`digital_asset_id`),
  ADD KEY `digital_asset_assignments_assignable_type_assignable_id_index` (`assignable_type`,`assignable_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_department_id_foreign` (`department_id`);

--
-- Indexes for table `maintenance_logs`
--
ALTER TABLE `maintenance_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenance_logs_asset_id_foreign` (`asset_id`),
  ADD KEY `maintenance_logs_performed_by_foreign` (`performed_by`);

--
-- Indexes for table `map_placements`
--
ALTER TABLE `map_placements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `map_placements_asset_id_unique` (`asset_id`);

--
-- Indexes for table `map_rooms`
--
ALTER TABLE `map_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `map_rooms_room_id_foreign` (`room_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `asset_assignments`
--
ALTER TABLE `asset_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `asset_categories`
--
ALTER TABLE `asset_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `asset_fields`
--
ALTER TABLE `asset_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `asset_field_values`
--
ALTER TABLE `asset_field_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `digital_assets`
--
ALTER TABLE `digital_assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `digital_asset_assignments`
--
ALTER TABLE `digital_asset_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `maintenance_logs`
--
ALTER TABLE `maintenance_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `map_placements`
--
ALTER TABLE `map_placements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `map_rooms`
--
ALTER TABLE `map_rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `assets_asset_category_id_foreign` FOREIGN KEY (`asset_category_id`) REFERENCES `asset_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assets_assigned_employee_id_foreign` FOREIGN KEY (`assigned_employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `assets_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `asset_assignments`
--
ALTER TABLE `asset_assignments`
  ADD CONSTRAINT `asset_assignments_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asset_assignments_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asset_assignments_performed_by_foreign` FOREIGN KEY (`performed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `asset_fields`
--
ALTER TABLE `asset_fields`
  ADD CONSTRAINT `asset_fields_asset_category_id_foreign` FOREIGN KEY (`asset_category_id`) REFERENCES `asset_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `asset_field_values`
--
ALTER TABLE `asset_field_values`
  ADD CONSTRAINT `asset_field_values_asset_field_id_foreign` FOREIGN KEY (`asset_field_id`) REFERENCES `asset_fields` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asset_field_values_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attachments_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `digital_asset_assignments`
--
ALTER TABLE `digital_asset_assignments`
  ADD CONSTRAINT `digital_asset_assignments_digital_asset_id_foreign` FOREIGN KEY (`digital_asset_id`) REFERENCES `digital_assets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `maintenance_logs`
--
ALTER TABLE `maintenance_logs`
  ADD CONSTRAINT `maintenance_logs_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `maintenance_logs_performed_by_foreign` FOREIGN KEY (`performed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `map_placements`
--
ALTER TABLE `map_placements`
  ADD CONSTRAINT `map_placements_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `map_rooms`
--
ALTER TABLE `map_rooms`
  ADD CONSTRAINT `map_rooms_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
