-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 03, 2026 at 05:59 PM
-- Server version: 8.0.46
-- PHP Version: 8.3.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET FOREIGN_KEY_CHECKS = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `binsult1_datatraders`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int UNSIGNED NOT NULL,
  `head_id` bigint UNSIGNED NOT NULL,
  `account_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Debit','Credit') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_balance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `head_id`, `account_code`, `title`, `type`, `opening_balance`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '12', 'Cash', 'Debit', 1420970.00, 1, '2026-06-30 23:32:28', '2026-07-02 19:14:28'),
(2, 1, '01', 'Hbl Bank', 'Debit', 183316.00, 1, '2026-06-30 23:33:27', '2026-06-30 23:33:27'),
(3, 1, '02', 'Alhb Al Awais p/s', 'Debit', 50400.00, 1, '2026-06-30 23:34:29', '2026-06-30 23:34:29'),
(4, 1, '03', 'Meezan', 'Debit', 86961.00, 1, '2026-06-30 23:35:09', '2026-06-30 23:35:09'),
(5, 1, '04', 'Mcb Al awais P/s', 'Debit', 40325.00, 1, '2026-06-30 23:36:17', '2026-06-30 23:36:17'),
(6, 1, '07', 'Ubl Al Awais p/s', 'Debit', 1402430.00, 1, '2026-06-30 23:37:36', '2026-07-01 23:38:23');

-- --------------------------------------------------------

--
-- Table structure for table `account_heads`
--

CREATE TABLE `account_heads` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_heads`
--

INSERT INTO `account_heads` (`id`, `name`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bank', NULL, 1, '2026-06-30 23:31:05', '2026-06-30 23:31:05'),
(2, 'Cash', NULL, 1, '2026-06-30 23:31:13', '2026-06-30 23:31:13');

-- --------------------------------------------------------

--
-- Table structure for table `account_transfers`
--

CREATE TABLE `account_transfers` (
  `id` bigint UNSIGNED NOT NULL,
  `atvid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `transfer_date` date NOT NULL,
  `from_account_id` bigint UNSIGNED NOT NULL,
  `to_account_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_transfers`
--

INSERT INTO `account_transfers` (`id`, `atvid`, `transfer_date`, `from_account_id`, `to_account_id`, `amount`, `remarks`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'ATV-001', '2026-07-01', 6, 1, 100000.00, 'Cash withdrawal', 7, '2026-07-01 23:38:23', '2026-07-01 23:38:23');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Petroleum', '2026-07-02 19:18:35', '2026-07-02 19:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name_ur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filer_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_address_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_balance` decimal(15,2) DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_id`, `customer_name`, `customer_name_ur`, `cnic`, `filer_type`, `zone`, `contact_person`, `mobile`, `email_address`, `contact_person_2`, `mobile_2`, `email_address_2`, `customer_type`, `opening_balance`, `address`, `created_at`, `updated_at`, `status`) VALUES
(1, 'CUST-0001', 'Munir Bhai', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 20834430.00, NULL, '2026-06-30 22:47:40', '2026-06-30 22:47:40', 'active'),
(2, 'CUST-0002', 'Allah Bux Bhai', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 16648611.00, NULL, '2026-06-30 22:48:17', '2026-06-30 22:48:17', 'active'),
(3, 'CUST-0003', 'Qadir Bux Bhai', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 15443803.00, NULL, '2026-06-30 22:50:41', '2026-06-30 22:50:41', 'active'),
(4, 'CUST-0004', 'Nasarpur Pump', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 10047314.00, NULL, '2026-06-30 22:51:04', '2026-06-30 22:51:04', 'active'),
(5, 'CUST-0005', 'Noor Hassan', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 8181498.00, NULL, '2026-06-30 22:52:48', '2026-06-30 22:52:48', 'active'),
(6, 'CUST-0006', 'Nasir Pump', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 7601896.00, NULL, '2026-06-30 22:53:09', '2026-06-30 22:53:09', 'active'),
(7, 'CUST-0007', 'Noor Ahmed', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 5727872.00, NULL, '2026-06-30 22:53:39', '2026-06-30 22:53:39', 'active'),
(8, 'CUST-0008', 'Ashok Samaro', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 5443426.00, NULL, '2026-06-30 22:54:07', '2026-06-30 22:54:07', 'active'),
(9, 'CUST-0009', 'Abdul Majeed Jarwar', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 5308237.00, NULL, '2026-06-30 22:54:30', '2026-06-30 22:54:30', 'active'),
(10, 'CUST-0010', 'Aqeel Bhai', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 4904388.00, NULL, '2026-06-30 22:54:52', '2026-06-30 22:54:52', 'active'),
(11, 'CUST-0011', 'Mr Shakeel Ahmed Bajwa', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 4814286.00, NULL, '2026-06-30 22:55:21', '2026-06-30 22:55:21', 'active'),
(12, 'CUST-0012', 'Mushtaq Kunri', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 4456615.00, NULL, '2026-06-30 22:55:44', '2026-06-30 22:55:44', 'active'),
(13, 'CUST-0013', 'Mr Ameer Hassan', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 3482851.00, NULL, '2026-06-30 22:56:14', '2026-06-30 22:56:14', 'active'),
(14, 'CUST-0014', 'Al Awais Pump', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 3181924.00, NULL, '2026-06-30 22:56:36', '2026-06-30 22:56:36', 'active'),
(15, 'CUST-0015', 'Imran Bashirabad', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 2776556.00, NULL, '2026-06-30 22:57:05', '2026-06-30 22:57:05', 'active'),
(16, 'CUST-0016', 'Piyarlund Pump', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 2289616.00, NULL, '2026-06-30 22:57:26', '2026-06-30 22:57:26', 'active'),
(17, 'CUST-0017', 'Imran Nabisar', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 2117012.00, NULL, '2026-06-30 22:57:42', '2026-06-30 22:57:42', 'active'),
(18, 'CUST-0018', 'Shabir Ahmed', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 1983442.00, NULL, '2026-06-30 22:58:01', '2026-06-30 22:58:01', 'active'),
(19, 'CUST-0019', 'Molla Bux Brohi', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 1961137.00, NULL, '2026-06-30 22:58:29', '2026-06-30 22:58:29', 'active'),
(20, 'CUST-0020', 'Altaf Rind Chachro', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 1895000.00, NULL, '2026-06-30 22:58:53', '2026-06-30 22:58:53', 'active'),
(21, 'CUST-0021', 'Rasool Bux Lal Shak', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 1879556.00, NULL, '2026-06-30 22:59:20', '2026-06-30 22:59:20', 'active'),
(22, 'CUST-0022', 'Belaro Pump', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 1824946.00, NULL, '2026-06-30 22:59:41', '2026-06-30 22:59:41', 'active'),
(23, 'CUST-0023', 'Shakeel Bhai', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 1803402.00, NULL, '2026-06-30 23:00:00', '2026-06-30 23:00:00', 'active'),
(24, 'CUST-0024', 'Zameen Karch', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 1742252.00, NULL, '2026-06-30 23:00:21', '2026-06-30 23:00:21', 'active'),
(25, 'CUST-0025', 'Soomar Taj Mori', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 1653705.00, NULL, '2026-06-30 23:00:44', '2026-06-30 23:00:44', 'active'),
(26, 'CUST-0026', 'Zaheer Sanjarchang', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 1425465.00, NULL, '2026-06-30 23:01:20', '2026-06-30 23:01:20', 'active'),
(27, 'CUST-0027', 'Dsp Mujahid Shah', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 1360000.00, NULL, '2026-06-30 23:01:47', '2026-06-30 23:01:47', 'active'),
(28, 'CUST-0028', 'Muhammad Khan Dumbalo', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 1350000.00, NULL, '2026-06-30 23:02:16', '2026-06-30 23:02:16', 'active'),
(29, 'CUST-0029', 'Nawaz Rahimo', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 1268278.00, NULL, '2026-06-30 23:02:47', '2026-06-30 23:02:47', 'active'),
(30, 'CUST-0030', 'Muhammad Khan Rajar', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 1173565.00, NULL, '2026-06-30 23:03:10', '2026-06-30 23:03:10', 'active'),
(31, 'CUST-0031', 'Shakeel Jarwar', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 1100488.00, NULL, '2026-06-30 23:03:34', '2026-06-30 23:03:34', 'active'),
(32, 'CUST-0032', 'Ashfaq Shah', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 1100000.00, NULL, '2026-06-30 23:03:49', '2026-06-30 23:03:49', 'active'),
(33, 'CUST-0033', 'Muneer sehto', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 1004048.00, NULL, '2026-06-30 23:04:08', '2026-06-30 23:04:08', 'active'),
(34, 'CUST-0034', 'Asif Karachi', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 1003097.00, NULL, '2026-06-30 23:04:40', '2026-06-30 23:04:40', 'active'),
(35, 'CUST-0035', 'Imtiaz kiryo', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 823460.00, NULL, '2026-06-30 23:04:57', '2026-06-30 23:04:57', 'active'),
(36, 'CUST-0036', 'Javed Mps', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 816076.00, NULL, '2026-06-30 23:05:15', '2026-06-30 23:05:15', 'active'),
(37, 'CUST-0037', 'Jabbar Baloch', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 783983.00, NULL, '2026-06-30 23:05:34', '2026-06-30 23:05:34', 'active'),
(38, 'CUST-0038', 'Asif Mureed Mori', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 650474.00, NULL, '2026-06-30 23:05:50', '2026-06-30 23:05:50', 'active'),
(39, 'CUST-0039', 'Azam Pump Kunri', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 637000.00, NULL, '2026-06-30 23:06:05', '2026-06-30 23:06:05', 'active'),
(40, 'CUST-0040', 'Al Deen Petroleum', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 585160.00, NULL, '2026-06-30 23:06:27', '2026-06-30 23:06:27', 'active'),
(41, 'CUST-0041', 'Haji Muzafar', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 542707.00, NULL, '2026-06-30 23:06:42', '2026-06-30 23:06:42', 'active'),
(42, 'CUST-0042', 'Ameen Chachro', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 382633.00, NULL, '2026-06-30 23:07:15', '2026-06-30 23:07:15', 'active'),
(43, 'CUST-0043', 'Asif Taalhi', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 381595.00, NULL, '2026-06-30 23:07:32', '2026-06-30 23:07:32', 'active'),
(44, 'CUST-0044', 'Aziz Mureed Mori', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 359971.00, NULL, '2026-06-30 23:07:56', '2026-06-30 23:07:56', 'active'),
(45, 'CUST-0045', 'Jan Ali', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 350000.00, NULL, '2026-06-30 23:08:11', '2026-06-30 23:08:11', 'active'),
(46, 'CUST-0046', 'Mushtaq Chachro', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 332352.00, NULL, '2026-06-30 23:08:29', '2026-06-30 23:08:29', 'active'),
(47, 'CUST-0047', 'Badin Pump', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 267426.00, NULL, '2026-06-30 23:08:46', '2026-06-30 23:08:46', 'active'),
(48, 'CUST-0048', 'Subhan Chachro', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 216410.00, NULL, '2026-06-30 23:09:17', '2026-06-30 23:09:17', 'active'),
(49, 'CUST-0049', 'Hakum Nabisar', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 204926.00, NULL, '2026-06-30 23:09:33', '2026-06-30 23:09:33', 'active'),
(50, 'CUST-0050', 'Uncle Habib', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 200000.00, NULL, '2026-06-30 23:09:44', '2026-06-30 23:09:44', 'active'),
(51, 'CUST-0051', 'Siddiq Qisar Sehro', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 189813.00, NULL, '2026-06-30 23:10:09', '2026-06-30 23:10:09', 'active'),
(52, 'CUST-0052', 'Uncle Ishaq', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 175000.00, NULL, '2026-06-30 23:10:22', '2026-06-30 23:10:22', 'active'),
(53, 'CUST-0053', 'Mazhar deshak', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 157950.00, NULL, '2026-06-30 23:10:42', '2026-06-30 23:10:42', 'active'),
(54, 'CUST-0054', 'Haji Murtaza Baloch', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 150000.00, NULL, '2026-06-30 23:11:01', '2026-06-30 23:11:01', 'active'),
(55, 'CUST-0055', 'Hashum Rahimo', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 148184.00, NULL, '2026-06-30 23:11:19', '2026-06-30 23:11:19', 'active'),
(56, 'CUST-0056', 'Ali Haji Bashir Arain', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 132500.00, NULL, '2026-06-30 23:11:37', '2026-06-30 23:11:37', 'active'),
(57, 'CUST-0057', 'Manzoor Khambo', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 124000.00, NULL, '2026-06-30 23:11:54', '2026-06-30 23:11:54', 'active'),
(58, 'CUST-0058', 'Mihar Dars Pump', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 115175.00, NULL, '2026-06-30 23:12:16', '2026-06-30 23:12:16', 'active'),
(59, 'CUST-0059', 'Yousuf Muhammad Yaqoob', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 110470.00, NULL, '2026-06-30 23:12:41', '2026-06-30 23:12:41', 'active'),
(60, 'CUST-0060', 'Sain Karim', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 100200.00, NULL, '2026-06-30 23:12:55', '2026-06-30 23:12:55', 'active'),
(61, 'CUST-0061', 'Rizwan Malla', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 95225.00, NULL, '2026-06-30 23:13:12', '2026-06-30 23:13:12', 'active'),
(62, 'CUST-0062', 'Yaqoob Rahimo', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 81750.00, NULL, '2026-06-30 23:13:27', '2026-06-30 23:13:27', 'active'),
(63, 'CUST-0063', 'DM Danish', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 66000.00, NULL, '2026-06-30 23:13:40', '2026-06-30 23:13:40', 'active'),
(64, 'CUST-0064', 'Shireen Asad', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 60000.00, NULL, '2026-06-30 23:13:55', '2026-06-30 23:13:55', 'active'),
(65, 'CUST-0065', 'Murtaza Huri Pump', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 53750.00, NULL, '2026-06-30 23:14:14', '2026-06-30 23:14:14', 'active'),
(66, 'CUST-0066', 'Riyaz Staff', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 41000.00, NULL, '2026-06-30 23:14:30', '2026-06-30 23:14:30', 'active'),
(67, 'CUST-0067', 'Abdul Ghafoor Dasori', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 35000.00, NULL, '2026-06-30 23:14:47', '2026-06-30 23:14:47', 'active'),
(68, 'CUST-0068', 'Diya Ram', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 30000.00, NULL, '2026-06-30 23:14:59', '2026-06-30 23:14:59', 'active'),
(69, 'CUST-0069', 'Imran Nazeer', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 30000.00, NULL, '2026-06-30 23:15:13', '2026-06-30 23:15:13', 'active'),
(70, 'CUST-0070', 'Lal Muhammad Arain', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 30000.00, NULL, '2026-06-30 23:15:26', '2026-06-30 23:15:26', 'active'),
(71, 'CUST-0071', 'Noor Nabib Baloch', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 30000.00, NULL, '2026-06-30 23:15:45', '2026-06-30 23:15:45', 'active'),
(72, 'CUST-0072', 'Zakria Laghari', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 30000.00, NULL, '2026-06-30 23:16:01', '2026-06-30 23:16:01', 'active'),
(73, 'CUST-0073', 'Majna Driver', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 20000.00, NULL, '2026-06-30 23:16:17', '2026-06-30 23:16:17', 'active'),
(74, 'CUST-0074', 'Sain Musa Jarwar', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 20000.00, NULL, '2026-06-30 23:16:34', '2026-06-30 23:16:34', 'active'),
(75, 'CUST-0075', 'Eijaz Staff', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 17130.00, NULL, '2026-06-30 23:17:15', '2026-06-30 23:17:15', 'active'),
(76, 'CUST-0076', 'Khadam Staff', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 14000.00, NULL, '2026-06-30 23:21:11', '2026-06-30 23:21:11', 'active'),
(77, 'CUST-0077', 'Naeem Staff', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 11000.00, NULL, '2026-06-30 23:21:28', '2026-06-30 23:21:28', 'active'),
(78, 'CUST-0078', 'Salman Aslam', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 11000.00, NULL, '2026-06-30 23:21:46', '2026-06-30 23:21:46', 'active'),
(79, 'CUST-0079', 'Afzal Staff', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', 9000.00, NULL, '2026-06-30 23:21:59', '2026-06-30 23:21:59', 'active'),
(80, 'CUST-0080', 'Qadir Bhai Amanat', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', -11375950.00, NULL, '2026-06-30 23:24:17', '2026-06-30 23:24:17', 'active'),
(81, 'CUST-0081', 'Aqeel Amanat', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', -10200000.00, NULL, '2026-06-30 23:24:35', '2026-06-30 23:24:35', 'active'),
(82, 'CUST-0082', 'AG Company', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', -1910000.00, NULL, '2026-06-30 23:24:56', '2026-06-30 23:24:56', 'active'),
(83, 'CUST-0083', 'Pending Amount', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', -1791746.00, NULL, '2026-06-30 23:25:18', '2026-06-30 23:25:18', 'active'),
(84, 'CUST-0084', 'Fasal Amad', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', -700000.00, NULL, '2026-06-30 23:25:40', '2026-06-30 23:25:40', 'active'),
(85, 'CUST-0085', 'Halo Pump Bheero', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', -350000.00, NULL, '2026-06-30 23:26:04', '2026-06-30 23:26:04', 'active'),
(86, 'CUST-0086', 'Abdul Haq', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', -9600.00, NULL, '2026-06-30 23:26:48', '2026-06-30 23:26:48', 'active'),
(87, 'CUST-0087', 'Shehzad Jarwar', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', -6906.00, NULL, '2026-06-30 23:27:08', '2026-06-30 23:27:08', 'active'),
(88, 'CUST-0088', 'Waseem Kk', NULL, NULL, 'filer', 'Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 'Main Customer', -5000.00, NULL, '2026-06-30 23:27:22', '2026-06-30 23:27:22', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `customer_ledgers`
--

CREATE TABLE `customer_ledgers` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `admin_or_user_id` bigint UNSIGNED NOT NULL,
  `previous_balance` decimal(12,2) NOT NULL,
  `closing_balance` decimal(12,2) NOT NULL,
  `opening_balance` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_ledgers`
--

INSERT INTO `customer_ledgers` (`id`, `customer_id`, `admin_or_user_id`, `previous_balance`, `closing_balance`, `opening_balance`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 20844430.00, 20881430.00, 20834430.00, '2026-06-30 22:47:40', '2026-07-01 23:31:37'),
(2, 2, 7, 16659611.00, 16675611.00, 16648611.00, '2026-06-30 22:48:17', '2026-07-01 23:30:20'),
(3, 3, 7, 15443803.00, 15462803.00, 15443803.00, '2026-06-30 22:50:41', '2026-07-02 00:01:01'),
(4, 4, 7, 9612569.00, 9612569.00, 10047314.00, '2026-06-30 22:51:04', '2026-07-01 23:14:07'),
(5, 5, 7, 0.00, 8181498.00, 8181498.00, '2026-06-30 22:52:48', '2026-06-30 22:52:48'),
(6, 6, 7, 0.00, 7601896.00, 7601896.00, '2026-06-30 22:53:09', '2026-06-30 22:53:09'),
(7, 7, 7, 0.00, 5727872.00, 5727872.00, '2026-06-30 22:53:39', '2026-06-30 22:53:39'),
(8, 8, 7, 0.00, 5443426.00, 5443426.00, '2026-06-30 22:54:07', '2026-06-30 22:54:07'),
(9, 9, 7, 5308237.00, 4808237.00, 5308237.00, '2026-06-30 22:54:30', '2026-07-02 19:14:28'),
(10, 10, 7, 4904388.00, 4954388.00, 4904388.00, '2026-06-30 22:54:52', '2026-07-01 23:32:56'),
(11, 11, 7, 0.00, 4814286.00, 4814286.00, '2026-06-30 22:55:21', '2026-06-30 22:55:21'),
(12, 12, 7, 4456615.00, 4206615.00, 4456615.00, '2026-06-30 22:55:44', '2026-07-02 19:07:06'),
(13, 13, 7, 0.00, 3482851.00, 3482851.00, '2026-06-30 22:56:14', '2026-06-30 22:56:14'),
(14, 14, 7, 0.00, 3181924.00, 3181924.00, '2026-06-30 22:56:36', '2026-06-30 22:56:36'),
(15, 15, 7, 0.00, 2776556.00, 2776556.00, '2026-06-30 22:57:05', '2026-06-30 22:57:05'),
(16, 16, 7, 0.00, 2289616.00, 2289616.00, '2026-06-30 22:57:26', '2026-06-30 22:57:26'),
(17, 17, 7, 0.00, 2117012.00, 2117012.00, '2026-06-30 22:57:42', '2026-06-30 22:57:42'),
(18, 18, 7, 1983442.00, 1990442.00, 1983442.00, '2026-06-30 22:58:01', '2026-07-01 23:32:27'),
(19, 19, 7, 1961137.00, 2011137.00, 1961137.00, '2026-06-30 22:58:29', '2026-07-01 23:36:40'),
(20, 20, 7, 0.00, 1895000.00, 1895000.00, '2026-06-30 22:58:53', '2026-06-30 22:58:53'),
(21, 21, 7, 0.00, 1879556.00, 1879556.00, '2026-06-30 22:59:20', '2026-06-30 22:59:20'),
(22, 22, 7, 0.00, 1824946.00, 1824946.00, '2026-06-30 22:59:41', '2026-06-30 22:59:41'),
(23, 23, 7, 0.00, 1803402.00, 1803402.00, '2026-06-30 23:00:00', '2026-06-30 23:00:00'),
(24, 24, 7, 0.00, 1742252.00, 1742252.00, '2026-06-30 23:00:21', '2026-06-30 23:00:21'),
(25, 25, 7, 0.00, 1653705.00, 1653705.00, '2026-06-30 23:00:44', '2026-06-30 23:00:44'),
(26, 26, 7, 0.00, 1425465.00, 1425465.00, '2026-06-30 23:01:20', '2026-06-30 23:01:20'),
(27, 27, 7, 0.00, 1360000.00, 1360000.00, '2026-06-30 23:01:47', '2026-06-30 23:01:47'),
(28, 28, 7, 0.00, 1350000.00, 1350000.00, '2026-06-30 23:02:16', '2026-06-30 23:02:16'),
(29, 29, 7, 0.00, 1268278.00, 1268278.00, '2026-06-30 23:02:47', '2026-06-30 23:02:47'),
(30, 30, 7, 0.00, 1173565.00, 1173565.00, '2026-06-30 23:03:10', '2026-06-30 23:03:10'),
(31, 31, 7, 0.00, 1100488.00, 1100488.00, '2026-06-30 23:03:34', '2026-06-30 23:03:34'),
(32, 32, 7, 0.00, 1100000.00, 1100000.00, '2026-06-30 23:03:49', '2026-06-30 23:03:49'),
(33, 33, 7, 0.00, 1004048.00, 1004048.00, '2026-06-30 23:04:08', '2026-06-30 23:04:08'),
(34, 34, 7, 1003097.00, 1027597.00, 1003097.00, '2026-06-30 23:04:40', '2026-07-01 23:34:41'),
(35, 35, 7, 0.00, 823460.00, 823460.00, '2026-06-30 23:04:57', '2026-06-30 23:04:57'),
(36, 36, 7, 816076.00, 366076.00, 816076.00, '2026-06-30 23:05:15', '2026-07-02 19:13:35'),
(37, 37, 7, 0.00, 783983.00, 783983.00, '2026-06-30 23:05:34', '2026-06-30 23:05:34'),
(38, 38, 7, 0.00, 650474.00, 650474.00, '2026-06-30 23:05:50', '2026-06-30 23:05:50'),
(39, 39, 7, 0.00, 637000.00, 637000.00, '2026-06-30 23:06:05', '2026-06-30 23:06:05'),
(40, 40, 7, 0.00, 585160.00, 585160.00, '2026-06-30 23:06:27', '2026-06-30 23:06:27'),
(41, 41, 7, 0.00, 542707.00, 542707.00, '2026-06-30 23:06:42', '2026-06-30 23:06:42'),
(42, 42, 7, 0.00, 382633.00, 382633.00, '2026-06-30 23:07:15', '2026-06-30 23:07:15'),
(43, 43, 7, 0.00, 381595.00, 381595.00, '2026-06-30 23:07:32', '2026-06-30 23:07:32'),
(44, 44, 7, 0.00, 359971.00, 359971.00, '2026-06-30 23:07:56', '2026-06-30 23:07:56'),
(45, 45, 7, 0.00, 350000.00, 350000.00, '2026-06-30 23:08:11', '2026-06-30 23:08:11'),
(46, 46, 7, 0.00, 332352.00, 332352.00, '2026-06-30 23:08:29', '2026-06-30 23:08:29'),
(47, 47, 7, 0.00, 267426.00, 267426.00, '2026-06-30 23:08:46', '2026-06-30 23:08:46'),
(48, 48, 7, 0.00, 216410.00, 216410.00, '2026-06-30 23:09:17', '2026-06-30 23:09:17'),
(49, 49, 7, 0.00, 204926.00, 204926.00, '2026-06-30 23:09:33', '2026-06-30 23:09:33'),
(50, 50, 7, 0.00, 200000.00, 200000.00, '2026-06-30 23:09:44', '2026-06-30 23:09:44'),
(51, 51, 7, 0.00, 189813.00, 189813.00, '2026-06-30 23:10:09', '2026-06-30 23:10:09'),
(52, 52, 7, 0.00, 175000.00, 175000.00, '2026-06-30 23:10:22', '2026-06-30 23:10:22'),
(53, 53, 7, 0.00, 157950.00, 157950.00, '2026-06-30 23:10:42', '2026-06-30 23:10:42'),
(54, 54, 7, 0.00, 150000.00, 150000.00, '2026-06-30 23:11:01', '2026-06-30 23:11:01'),
(55, 55, 7, 0.00, 148184.00, 148184.00, '2026-06-30 23:11:19', '2026-06-30 23:11:19'),
(56, 56, 7, 0.00, 132500.00, 132500.00, '2026-06-30 23:11:37', '2026-06-30 23:11:37'),
(57, 57, 7, 0.00, 124000.00, 124000.00, '2026-06-30 23:11:54', '2026-06-30 23:11:54'),
(58, 58, 7, 0.00, 115175.00, 115175.00, '2026-06-30 23:12:16', '2026-06-30 23:12:16'),
(59, 59, 7, 0.00, 110470.00, 110470.00, '2026-06-30 23:12:41', '2026-06-30 23:12:41'),
(60, 60, 7, 0.00, 100200.00, 100200.00, '2026-06-30 23:12:55', '2026-06-30 23:12:55'),
(61, 61, 7, 0.00, 95225.00, 95225.00, '2026-06-30 23:13:12', '2026-06-30 23:13:12'),
(62, 62, 7, 0.00, 81750.00, 81750.00, '2026-06-30 23:13:27', '2026-06-30 23:13:27'),
(63, 63, 7, 0.00, 66000.00, 66000.00, '2026-06-30 23:13:40', '2026-06-30 23:13:40'),
(64, 64, 7, 0.00, 60000.00, 60000.00, '2026-06-30 23:13:55', '2026-06-30 23:13:55'),
(65, 65, 7, 0.00, 53750.00, 53750.00, '2026-06-30 23:14:14', '2026-06-30 23:14:14'),
(66, 66, 7, 0.00, 41000.00, 41000.00, '2026-06-30 23:14:30', '2026-06-30 23:14:30'),
(67, 67, 7, 0.00, 35000.00, 35000.00, '2026-06-30 23:14:47', '2026-06-30 23:14:47'),
(68, 68, 7, 0.00, 30000.00, 30000.00, '2026-06-30 23:14:59', '2026-06-30 23:14:59'),
(69, 69, 7, 0.00, 30000.00, 30000.00, '2026-06-30 23:15:13', '2026-06-30 23:15:13'),
(70, 70, 7, 0.00, 30000.00, 30000.00, '2026-06-30 23:15:26', '2026-06-30 23:15:26'),
(71, 71, 7, 0.00, 30000.00, 30000.00, '2026-06-30 23:15:45', '2026-06-30 23:15:45'),
(72, 72, 7, 0.00, 30000.00, 30000.00, '2026-06-30 23:16:01', '2026-06-30 23:16:01'),
(73, 73, 7, 0.00, 20000.00, 20000.00, '2026-06-30 23:16:17', '2026-06-30 23:16:17'),
(74, 74, 7, 0.00, 20000.00, 20000.00, '2026-06-30 23:16:34', '2026-06-30 23:16:34'),
(75, 75, 7, 0.00, 17130.00, 17130.00, '2026-06-30 23:17:15', '2026-06-30 23:17:15'),
(76, 76, 7, 0.00, 14000.00, 14000.00, '2026-06-30 23:21:11', '2026-06-30 23:21:11'),
(77, 77, 7, 0.00, 11000.00, 11000.00, '2026-06-30 23:21:28', '2026-06-30 23:21:28'),
(78, 78, 7, 0.00, 11000.00, 11000.00, '2026-06-30 23:21:46', '2026-06-30 23:21:46'),
(79, 79, 7, 0.00, 9000.00, 9000.00, '2026-06-30 23:21:59', '2026-06-30 23:21:59'),
(80, 80, 7, 0.00, 0.00, 0.00, '2026-07-01 21:16:24', '2026-07-01 23:14:34'),
(81, 82, 7, 0.00, 0.00, 0.00, '2026-07-01 21:16:24', '2026-07-01 23:14:34'),
(82, 80, 7, 0.00, 0.00, 0.00, '2026-07-01 23:14:34', '2026-07-01 23:16:12'),
(83, 82, 7, 0.00, 0.00, 0.00, '2026-07-01 23:14:34', '2026-07-01 23:16:12'),
(84, 82, 7, 0.00, -1484000.00, 0.00, '2026-07-01 23:16:12', '2026-07-01 23:16:12'),
(85, 80, 7, 0.00, 1484000.00, 0.00, '2026-07-01 23:16:12', '2026-07-01 23:16:12'),
(86, 4, 7, 9612569.00, 8907569.00, 0.00, '2026-07-02 19:09:41', '2026-07-02 19:09:41'),
(87, 17, 7, 2117012.00, 2017012.00, 0.00, '2026-07-02 19:10:30', '2026-07-02 19:10:30'),
(88, 11, 7, 4814286.00, 4664286.00, 0.00, '2026-07-02 19:11:31', '2026-07-02 19:11:31'),
(89, 13, 7, 3482851.00, 2482851.00, 0.00, '2026-07-02 19:12:21', '2026-07-02 19:12:21'),
(90, 17, 7, 2017012.00, 1917012.00, 0.00, '2026-07-02 19:15:57', '2026-07-02 19:15:57'),
(91, 5, 7, 8181498.00, 6431498.00, 0.00, '2026-07-02 19:16:47', '2026-07-02 19:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `customer_payments`
--

CREATE TABLE `customer_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `admin_or_user_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `account_id` bigint UNSIGNED DEFAULT NULL,
  `adjustment_type` enum('plus','minus') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'minus',
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_payments`
--

INSERT INTO `customer_payments` (`id`, `customer_id`, `admin_or_user_id`, `amount`, `account_id`, `adjustment_type`, `payment_method`, `payment_date`, `note`, `created_at`, `updated_at`) VALUES
(1, 4, 7, 50000.00, 1, 'minus', 'Account', '2026-07-01', 'Rashid Mughal se Cash', '2026-07-01 21:17:04', '2026-07-01 23:13:40'),
(2, 4, 7, 34745.00, 1, 'minus', 'Account', '2026-07-01', 'June Pump Loss', '2026-07-01 21:17:56', '2026-07-01 23:13:54'),
(3, 4, 7, 350000.00, 1, 'minus', 'Account', '2026-07-01', 'Cash', '2026-07-01 21:18:26', '2026-07-01 23:14:07'),
(4, 2, 7, 11000.00, 1, 'plus', 'Account', '2026-07-01', 'Car Oil filter Naseer', '2026-07-01 23:21:35', '2026-07-01 23:21:35'),
(5, 1, 7, 10000.00, 1, 'plus', 'Account', '2026-07-01', 'Tuition fees advance', '2026-07-01 23:22:29', '2026-07-01 23:22:29'),
(6, 2, 7, 16000.00, 1, 'plus', 'Account', '2026-07-01', 'Allah bux Petrol bill', '2026-07-01 23:30:20', '2026-07-01 23:30:20'),
(8, 1, 7, 37000.00, 1, 'plus', 'Account', '2026-07-01', 'Petrol bill', '2026-07-01 23:31:37', '2026-07-01 23:31:37'),
(9, 18, 7, 7000.00, 1, 'plus', 'Account', '2026-07-01', 'Petrol bill', '2026-07-01 23:32:27', '2026-07-01 23:32:27'),
(10, 10, 7, 50000.00, 1, 'plus', 'Account', '2026-07-01', 'Petrol bill', '2026-07-01 23:32:56', '2026-07-01 23:32:56'),
(11, 34, 7, 24500.00, 1, 'plus', 'Account', '2026-07-01', 'Ghar keraya', '2026-07-01 23:34:41', '2026-07-01 23:34:41'),
(12, 19, 7, 50000.00, 1, 'plus', 'Account', '2026-07-01', 'Cash Latif ko', '2026-07-01 23:36:40', '2026-07-01 23:36:40'),
(13, 3, 7, 19000.00, 1, 'plus', 'Account', '2026-07-01', 'Petrol bill', '2026-07-02 00:01:01', '2026-07-02 00:01:01'),
(14, 12, 7, 250000.00, 1, 'minus', 'Account', '2026-07-02', 'Ubl@Shabir', '2026-07-02 19:07:06', '2026-07-02 19:07:06'),
(15, 36, 7, 450000.00, 1, 'minus', 'Account', '2026-07-02', 'Ubl@ 3/1.5', '2026-07-02 19:13:35', '2026-07-02 19:13:35'),
(16, 9, 7, 500000.00, 1, 'minus', 'Account', '2026-07-02', 'CAsh 2 Alhb Chq 3', '2026-07-02 19:14:28', '2026-07-02 19:14:28');

-- --------------------------------------------------------

--
-- Table structure for table `day_closings`
--

CREATE TABLE `day_closings` (
  `id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `opening_balance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_in` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_out` decimal(15,2) NOT NULL DEFAULT '0.00',
  `closing_balance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `is_closed` tinyint(1) NOT NULL DEFAULT '0',
  `closed_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_amount` decimal(15,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `title`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 'Office Expenses', 1100.00, '2026-07-01 21:18:57', '2026-07-01 23:14:46'),
(2, 'Transportation Expenses', 29700.00, '2026-07-01 23:23:20', '2026-07-01 23:34:03'),
(3, 'Office Expenses', 2000.00, '2026-07-01 23:25:11', '2026-07-01 23:26:01'),
(4, 'Utility bills', 3000.00, '2026-07-01 23:26:20', '2026-07-01 23:27:06'),
(5, 'Company Joint Expenses', 6000.00, '2026-07-01 23:27:41', '2026-07-01 23:29:34'),
(6, 'Pump Loss', 34745.00, '2026-07-01 23:35:10', '2026-07-01 23:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `expense_vouchers`
--

CREATE TABLE `expense_vouchers` (
  `id` bigint UNSIGNED NOT NULL,
  `evid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `entry_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `party_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tel` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `narration_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `row_account_head` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `row_account_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `amount` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total_amount` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_vouchers`
--

INSERT INTO `expense_vouchers` (`id`, `evid`, `entry_date`, `type`, `party_id`, `tel`, `remarks`, `narration_id`, `row_account_head`, `row_account_id`, `amount`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 'EVID-001', '2026-07-01', 'account', '1', NULL, 'Hotel Bill or NAseer', '\"[]\"', '[2]', '[\"1\"]', '[1100]', '1100', '2026-07-01 21:19:53', '2026-07-01 23:14:46'),
(2, 'EVID-002', '2026-07-01', 'account', '1', NULL, 'Khadam Bike petrol', '\"[]\"', '\"[1]\"', '\"[\\\"2\\\"]\"', '\"[1000]\"', '1000', '2026-07-01 23:24:36', '2026-07-01 23:24:36'),
(3, 'EVID-003', '2026-07-01', 'account', '1', NULL, 'Roznamcha file or pen', '\"[]\"', '\"[1]\"', '\"[\\\"3\\\"]\"', '\"[2000]\"', '2000', '2026-07-01 23:26:01', '2026-07-01 23:26:01'),
(4, 'EVID-004', '2026-07-01', 'account', '1', NULL, 'Riyaz or Khadam balance', '\"[]\"', '\"[1]\"', '\"[\\\"4\\\"]\"', '\"[3000]\"', '3000', '2026-07-01 23:27:06', '2026-07-01 23:27:06'),
(5, 'EVID-005', '2026-07-01', 'account', '1', NULL, 'Rafeeq ko Bandooq Babat Cash diya', '\"[]\"', '\"[1]\"', '\"[\\\"5\\\"]\"', '\"[5000]\"', '5000', '2026-07-01 23:28:30', '2026-07-01 23:28:30'),
(6, 'EVID-006', '2026-07-01', 'account', '1', NULL, 'Masjid Ameen', '\"[]\"', '\"[1]\"', '\"[\\\"5\\\"]\"', '\"[1000]\"', '1000', '2026-07-01 23:29:34', '2026-07-01 23:29:34'),
(7, 'EVID-007', '2026-07-01', 'account', '1', NULL, 'Petrol bill', '\"[]\"', '\"[1]\"', '\"[\\\"2\\\"]\"', '\"[28700]\"', '28700', '2026-07-01 23:34:03', '2026-07-01 23:34:03'),
(8, 'EVID-008', '2026-07-01', 'account', '1', NULL, 'Nasarpur June loss', '\"[]\"', '\"[1]\"', '\"[\\\"6\\\"]\"', '\"[34745]\"', '34745', '2026-07-01 23:36:10', '2026-07-01 23:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_products`
--

CREATE TABLE `group_products` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `quantity_produced` int NOT NULL,
  `total_cost` decimal(15,2) NOT NULL,
  `cost_per_unit` decimal(15,2) NOT NULL,
  `sale_price` decimal(15,2) NOT NULL,
  `current_stock` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_product_components`
--

CREATE TABLE `group_product_components` (
  `id` bigint UNSIGNED NOT NULL,
  `group_product_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity_used` int NOT NULL,
  `unit_cost` decimal(15,2) NOT NULL,
  `total_cost` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inward_gatepasses`
--

CREATE TABLE `inward_gatepasses` (
  `id` bigint UNSIGNED NOT NULL,
  `item_discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `transport_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `warehouse_id` bigint UNSIGNED DEFAULT NULL,
  `vendor_id` bigint UNSIGNED DEFAULT NULL,
  `purchase_id` bigint UNSIGNED DEFAULT NULL,
  `gatepass_date` date DEFAULT NULL,
  `gatepass_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `receive_type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `subtotal` decimal(15,2) DEFAULT NULL,
  `discount` decimal(15,2) DEFAULT NULL,
  `extra_cost` decimal(15,2) DEFAULT NULL,
  `net_amount` decimal(15,2) DEFAULT NULL,
  `paid_amount` decimal(15,2) DEFAULT NULL,
  `due_amount` decimal(15,2) DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','linked','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `bill_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unbilled',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inward_gatepass_items`
--

CREATE TABLE `inward_gatepass_items` (
  `id` bigint UNSIGNED NOT NULL,
  `inward_gatepass_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `qty` decimal(10,2) DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `discount_type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `discount_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 4),
(1, 'App\\Models\\User', 5),
(6, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- Table structure for table `narrations`
--

CREATE TABLE `narrations` (
  `id` bigint UNSIGNED NOT NULL,
  `expense_head` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `narration` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `other_incomes`
--

CREATE TABLE `other_incomes` (
  `id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `party_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'account',
  `vendor_id` bigint UNSIGNED DEFAULT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `account_id` bigint UNSIGNED DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `admin_or_user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_vouchers`
--

CREATE TABLE `payment_vouchers` (
  `id` bigint UNSIGNED NOT NULL,
  `pvid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `receipt_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `entry_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `party_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tel` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `narration_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `reference_no` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `row_account_head` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `row_account_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `discount_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `rate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `amount` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total_amount` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `creater_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `category_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sub_category_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `brand_id` bigint UNSIGNED DEFAULT NULL,
  `item_code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `unit_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `item_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `color` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `alert_quantity` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `barcode_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initial_stock` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `wholesale_price` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `creater_id`, `category_id`, `sub_category_id`, `brand_id`, `item_code`, `unit_id`, `item_name`, `color`, `price`, `alert_quantity`, `created_at`, `updated_at`, `deleted_at`, `barcode_path`, `initial_stock`, `wholesale_price`, `image`, `note`) VALUES
(1, '7', '1', '1', NULL, 'ITEM-0001', 'LTR', 'HSD', NULL, '0', 0, '2026-07-03 20:22:12', '2026-07-03 20:22:12', NULL, '372520771026', '0', '0', NULL, NULL),
(2, '7', '1', '2', NULL, 'ITEM-0002', 'LTR', 'PMG', NULL, '0', 0, '2026-07-03 20:22:30', '2026-07-03 20:22:30', NULL, '546730391112', '0', '0', NULL, NULL),
(3, '7', '1', '3', NULL, 'ITEM-0003', 'LTR', 'Solvent', NULL, '0', 0, '2026-07-03 20:23:23', '2026-07-03 20:23:23', NULL, '720914241046', '0', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_bookings`
--

CREATE TABLE `product_bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `customer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `product` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `per_price` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `per_discount` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `per_total` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount_Words` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_bill_amount` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_extradiscount` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_net` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `advance_payment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cash` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `card` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `change` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_items` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_pieces` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total_yard` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total_meter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `booking_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sale_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_discounts`
--

CREATE TABLE `product_discounts` (
  `id` bigint UNSIGNED NOT NULL,
  `discount_code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `product_id` bigint UNSIGNED NOT NULL,
  `actual_price` decimal(10,2) DEFAULT NULL,
  `discount_percentage` decimal(5,2) DEFAULT NULL,
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `final_price` decimal(10,2) NOT NULL,
  `total_discount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `warehouse_id` bigint UNSIGNED DEFAULT NULL,
  `purchase_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` bigint UNSIGNED DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `invoice_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `subtotal` decimal(12,2) DEFAULT '0.00',
  `discount` decimal(12,2) DEFAULT '0.00',
  `extra_cost` decimal(12,2) DEFAULT '0.00',
  `net_amount` decimal(12,2) DEFAULT '0.00',
  `paid_amount` decimal(12,2) DEFAULT '0.00',
  `due_amount` decimal(12,2) DEFAULT '0.00',
  `status_purchase` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `branch_id`, `warehouse_id`, `purchase_to`, `vendor_id`, `purchase_date`, `invoice_no`, `note`, `subtotal`, `discount`, `extra_cost`, `net_amount`, `paid_amount`, `due_amount`, `status_purchase`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7, NULL, 'shop', 2, '2026-07-02', 'PUR-001', NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, '2026-07-02 07:48:17', '2026-07-02 07:48:17', NULL),
(2, 7, NULL, 'shop', 2, '2026-07-04', 'PUR-002', NULL, 13824000.00, 0.00, 0.00, 13824000.00, 0.00, 13824000.00, NULL, '2026-07-03 20:32:39', '2026-07-03 20:32:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` bigint UNSIGNED NOT NULL,
  `purchase_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `item_discount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `qty` int NOT NULL DEFAULT '0',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `line_total` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`id`, `purchase_id`, `product_id`, `unit`, `price`, `item_discount`, `qty`, `note`, `line_total`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'LTR', 288.00, 0.00, 48000, NULL, 13824000.00, '2026-07-03 20:32:39', '2026-07-03 20:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_returns`
--

CREATE TABLE `purchase_returns` (
  `id` bigint UNSIGNED NOT NULL,
  `purchase_id` bigint DEFAULT NULL,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `return_invoice` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_date` date NOT NULL,
  `return_reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `transport` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_person` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_id` bigint UNSIGNED DEFAULT NULL,
  `bill_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `item_discount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `extra_discount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `net_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `paid` decimal(12,2) NOT NULL DEFAULT '0.00',
  `balance` decimal(12,2) NOT NULL DEFAULT '0.00',
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_returns`
--

INSERT INTO `purchase_returns` (`id`, `purchase_id`, `vendor_id`, `return_invoice`, `return_date`, `return_reason`, `transport`, `vehicle_no`, `driver_name`, `delivery_person`, `warehouse_id`, `bill_amount`, `item_discount`, `extra_discount`, `net_amount`, `paid`, `balance`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'RTN-00001', '2026-07-04', NULL, NULL, NULL, NULL, NULL, NULL, 288.00, 0.00, 0.00, 288.00, 0.00, 288.00, NULL, '2026-07-03 20:35:09', '2026-07-03 20:35:09');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_items`
--

CREATE TABLE `purchase_return_items` (
  `id` bigint UNSIGNED NOT NULL,
  `purchase_return_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int NOT NULL DEFAULT '0',
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `item_discount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `line_total` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_return_items`
--

INSERT INTO `purchase_return_items` (`id`, `purchase_return_id`, `product_id`, `unit`, `qty`, `note`, `price`, `item_discount`, `line_total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'LTR', 1, NULL, 288.00, 0.00, 288.00, '2026-07-03 20:35:09', '2026-07-03 20:35:09');

-- --------------------------------------------------------

--
-- Table structure for table `receipts_vouchers`
--

CREATE TABLE `receipts_vouchers` (
  `id` bigint UNSIGNED NOT NULL,
  `rvid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `receipt_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `entry_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `party_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tel` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `narration_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `reference_no` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `row_account_head` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `row_account_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `discount_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `rate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `amount` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total_amount` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2025-12-16 10:14:16', '2025-12-16 10:14:16'),
(2, 'Accountant', 'web', '2025-12-16 10:14:27', '2025-12-16 10:14:27'),
(3, 'Manager', 'web', '2025-12-20 22:58:48', '2025-12-20 22:58:48'),
(4, 'Assistant accountant', 'web', '2025-12-20 22:58:59', '2025-12-20 22:58:59'),
(5, 'Cashier', 'web', '2025-12-20 22:59:08', '2025-12-20 22:59:08'),
(6, 'Super Admin', 'web', '2026-02-17 00:02:52', '2026-02-17 00:02:52');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(12, 2),
(13, 2),
(22, 2),
(25, 2),
(26, 2),
(29, 2),
(1, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(19, 3),
(20, 3),
(25, 3),
(26, 3),
(29, 3),
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(8, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(19, 4),
(20, 4),
(21, 4),
(25, 4),
(26, 4),
(29, 4),
(2, 5),
(14, 5),
(15, 5),
(16, 5),
(17, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `reference` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `product` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `per_price` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `per_discount` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `per_total` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount_Words` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_bill_amount` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_extradiscount` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_net` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `labour_charges` decimal(10,2) DEFAULT '0.00',
  `cash` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `card` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `change` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_items` decimal(10,2) DEFAULT NULL,
  `total_pieces` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total_yard` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total_meter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sale_status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `account_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_officers`
--

CREATE TABLE `sales_officers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_urdu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `mobile` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_returns`
--

CREATE TABLE `sales_returns` (
  `id` bigint UNSIGNED NOT NULL,
  `sale_id` bigint UNSIGNED NOT NULL,
  `customer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `reference` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `product` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `product_code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `brand` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `unit` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `per_price` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `per_discount` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `qty` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `per_total` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total_amount_Words` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total_bill_amount` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total_extradiscount` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total_net` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cash` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `card` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `change` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `color` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total_items` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `return_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `warehouse_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `qty` decimal(10,2) DEFAULT NULL,
  `reserved_qty` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `branch_id`, `warehouse_id`, `product_id`, `qty`, `reserved_qty`, `created_at`, `updated_at`) VALUES
(1, 7, NULL, 1, 47999.00, 0, '2026-07-03 20:32:39', '2026-07-03 20:35:09');

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfers`
--

CREATE TABLE `stock_transfers` (
  `id` bigint UNSIGNED NOT NULL,
  `from_warehouse_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transfer_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_warehouse_id` bigint UNSIGNED DEFAULT NULL,
  `to_shop` tinyint(1) NOT NULL DEFAULT '0',
  `product_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `quantity` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'HSD', 1, '2026-07-02 19:18:53', '2026-07-02 19:18:53'),
(2, 'PMG', 1, '2026-07-02 19:19:06', '2026-07-02 19:19:06'),
(3, 'Solvent', 1, '2026-07-03 20:22:57', '2026-07-03 20:22:57');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_vouchers`
--

CREATE TABLE `transfer_vouchers` (
  `id` bigint UNSIGNED NOT NULL,
  `tvid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transfer_date` date NOT NULL,
  `source_party_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_party_id` bigint DEFAULT NULL,
  `destination_party_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination_party_id` bigint DEFAULT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `vendor_id` bigint UNSIGNED DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transfer_vouchers`
--

INSERT INTO `transfer_vouchers` (`id`, `tvid`, `transfer_date`, `source_party_type`, `source_party_id`, `destination_party_type`, `destination_party_id`, `customer_id`, `vendor_id`, `amount`, `remarks`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'TVID-001', '2026-07-01', 'customer', 82, 'customer', 80, 82, NULL, 1484000.00, 'Dubai Me Hanif Ko Sona Banane k liye diya', 7, '2026-07-01 21:16:24', '2026-07-01 23:16:12'),
(2, 'TVID-002', '2026-07-02', 'customer', 4, 'vendor', 3, 4, 3, 705000.00, 'Alhb@Reliance 430/275', 7, '2026-07-02 19:09:41', '2026-07-02 19:09:41'),
(3, 'TVID-003', '2026-07-02', 'customer', 17, 'vendor', 2, 17, 2, 100000.00, 'Alhb@Wali', 7, '2026-07-02 19:10:30', '2026-07-02 19:10:30'),
(4, 'TVID-004', '2026-07-02', 'customer', 11, 'vendor', 2, 11, 2, 150000.00, 'Ubl@Wahid', 7, '2026-07-02 19:11:31', '2026-07-02 19:11:31'),
(5, 'TVID-005', '2026-07-02', 'customer', 13, 'vendor', 2, 13, 2, 1000000.00, 'Alhb@Wali', 7, '2026-07-02 19:12:21', '2026-07-02 19:12:21'),
(6, 'TVID-006', '2026-07-02', 'customer', 17, 'vendor', 2, 17, 2, 100000.00, 'Mcb@Wahid', 7, '2026-07-02 19:15:57', '2026-07-02 19:15:57'),
(7, 'TVID-007', '2026-07-02', 'customer', 5, 'vendor', 2, 5, 2, 1750000.00, 'Alhb@wali', 7, '2026-07-02 19:16:47', '2026-07-02 19:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `transports`
--

CREATE TABLE `transports` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_or_user_id` bigint UNSIGNED DEFAULT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `address_ur` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint UNSIGNED NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `usertype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `usertype`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, 'admin', '$2y$10$h98HpO12w5S70cNl7oHdx.0RqfQeIbvqIN3k4XBWMpO7U3UEHHu4.', NULL, '2025-09-07 16:07:28', '2026-01-22 08:25:32'),
(2, 'Talib', 'Talib@wijdanstore.pk', NULL, 'admin', '$2y$10$aFkS8R7j0MofZtTGEchWJukVNFDw9FTePemT8.ZvZFk9szyBEHNQy', NULL, '2025-09-11 16:30:55', '2026-01-22 08:16:04'),
(4, 'Danish', 'danish@wijdanstore.pk', NULL, 'admin', '$2y$10$i7ueWB70EytWvGEjbXvl6.44voW9JZ8fL/AwqAa6QHVmty.C9ClXC', NULL, '2025-12-16 13:18:03', '2026-01-22 08:19:28'),
(5, 'usama naskani', 'usamamnaskani@wijdanstore.pk', NULL, 'admin', '$2y$10$7EyP.MO.ODM4EDxhma4u1OUfx8z8qFBQUAKSOeVNwoF16PCwo933y', NULL, '2025-12-28 10:05:40', '2026-01-22 08:18:18'),
(6, 'test@gmail.com', 'test@gmail.com', NULL, 'admin', '$2y$10$HRQI/irX60Gpw0tvk2lDIOotk6lpwU3DZmlkPaBA05fYdELeLqft6', NULL, NULL, NULL),
(7, 'Super Admin', 'superadmin@example.com', NULL, 'admin', '$2y$12$uja/K8QRPfxQ86Ohvm6CTeoDfYQsD3kBIUeuGLOC9CLLh04hyUnka', NULL, '2026-02-17 00:02:52', '2026-02-17 00:02:52'),
(8, 'soban', 'soban@soban.com', NULL, 'admin', '$2y$10$RH//pIhD9Fxpt2pY1pHEWuHnKi5o9WOOAxhoiWf5FxPiSqNhtByoS', NULL, '2026-02-19 22:56:42', '2026-02-19 22:56:42'),
(11, 'xgyhuac', 'q5ofqzkrip@dakum6.com', NULL, 'admin', '$2y$10$TiytL30UOGkiYDHrbFBKbekY88YGsvZL/vwZVM6uyeg4rNmyMs8l2', NULL, '2026-10-17 13:39:16', '2026-10-17 13:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_balance` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `email`, `phone`, `address`, `opening_balance`, `created_at`, `updated_at`) VALUES
(1, 'Byco Company', NULL, NULL, NULL, '16056', '2026-06-30 23:18:22', '2026-06-30 23:18:22'),
(2, 'Manzoor Pathan', NULL, NULL, NULL, '15892459', '2026-06-30 23:19:10', '2026-06-30 23:19:10'),
(3, 'Zamreen Pathan', NULL, NULL, NULL, '1000000', '2026-06-30 23:19:52', '2026-06-30 23:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_bilties`
--

CREATE TABLE `vendor_bilties` (
  `id` bigint UNSIGNED NOT NULL,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `purchase_id` bigint UNSIGNED DEFAULT NULL,
  `bilty_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transporter_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_ledgers`
--

CREATE TABLE `vendor_ledgers` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_or_user_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `opening_balance` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `previous_balance` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `closing_balance` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_ledgers`
--

INSERT INTO `vendor_ledgers` (`id`, `admin_or_user_id`, `vendor_id`, `opening_balance`, `previous_balance`, `closing_balance`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '7', 1, '16056', '0', '16056', '2026-06-30 23:18:22', '2026-06-30 23:18:22', NULL),
(2, '7', 2, '29716459', '29716459', '29716171', '2026-06-30 23:19:10', '2026-07-03 20:35:09', NULL),
(3, '7', 3, '1000000', '0', '1000000', '2026-06-30 23:19:52', '2026-06-30 23:19:52', NULL),
(4, '7', 3, '0', '1000000', '295000', '2026-07-02 19:09:41', '2026-07-02 19:09:41', NULL),
(5, '7', 2, '0', '15892459', '15792459', '2026-07-02 19:10:30', '2026-07-02 19:10:30', NULL),
(6, '7', 2, '0', '15792459', '15642459', '2026-07-02 19:11:31', '2026-07-02 19:11:31', NULL),
(7, '7', 2, '0', '15642459', '14642459', '2026-07-02 19:12:21', '2026-07-02 19:12:21', NULL),
(8, '7', 2, '0', '14642459', '14542459', '2026-07-02 19:15:57', '2026-07-02 19:15:57', NULL),
(9, '7', 2, '0', '14542459', '12792459', '2026-07-02 19:16:47', '2026-07-02 19:16:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_payments`
--

CREATE TABLE `vendor_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `admin_or_user_id` bigint UNSIGNED NOT NULL,
  `payment_date` date DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `adjustment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'minus',
  `account_id` bigint UNSIGNED DEFAULT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` bigint UNSIGNED NOT NULL,
  `voucher_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_officer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `person` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_head` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `narration` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `amount` decimal(15,2) NOT NULL,
  `status` enum('draft','posted') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `warehouse_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creater_id` bigint UNSIGNED DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_stocks`
--

CREATE TABLE `warehouse_stocks` (
  `id` bigint UNSIGNED NOT NULL,
  `warehouse_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE `zones` (
  `id` bigint UNSIGNED NOT NULL,
  `zone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_heads`
--
ALTER TABLE `account_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_transfers`
--
ALTER TABLE `account_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branches_user_id_unique` (`user_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_customer_id_unique` (`customer_id`);

--
-- Indexes for table `customer_ledgers`
--
ALTER TABLE `customer_ledgers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_ledgers_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_payments_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `day_closings`
--
ALTER TABLE `day_closings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `day_closings_date_unique` (`date`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_vouchers`
--
ALTER TABLE `expense_vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `group_products`
--
ALTER TABLE `group_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_products_created_by_foreign` (`created_by`),
  ADD KEY `group_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `group_product_components`
--
ALTER TABLE `group_product_components`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_product_components_group_product_id_foreign` (`group_product_id`),
  ADD KEY `group_product_components_product_id_foreign` (`product_id`);

--
-- Indexes for table `inward_gatepasses`
--
ALTER TABLE `inward_gatepasses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inward_gatepass_items`
--
ALTER TABLE `inward_gatepass_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inward_gatepass_items_inward_gatepass_id_foreign` (`inward_gatepass_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `narrations`
--
ALTER TABLE `narrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_incomes`
--
ALTER TABLE `other_incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_vouchers`
--
ALTER TABLE `payment_vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_bookings`
--
ALTER TABLE `product_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_discounts`
--
ALTER TABLE `product_discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_discounts_product_id_foreign` (`product_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_items_product_id_index` (`product_id`);

--
-- Indexes for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchase_returns_return_invoice_unique` (`return_invoice`),
  ADD KEY `purchase_returns_vendor_id_foreign` (`vendor_id`),
  ADD KEY `purchase_returns_warehouse_id_foreign` (`warehouse_id`);

--
-- Indexes for table `purchase_return_items`
--
ALTER TABLE `purchase_return_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_return_items_purchase_return_id_foreign` (`purchase_return_id`),
  ADD KEY `purchase_return_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `receipts_vouchers`
--
ALTER TABLE `receipts_vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_officers`
--
ALTER TABLE `sales_officers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_returns`
--
ALTER TABLE `sales_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_returns_sale_id_foreign` (`sale_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stocks_unique_triplet` (`branch_id`,`warehouse_id`,`product_id`);

--
-- Indexes for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_transfers_from_warehouse_id_foreign` (`from_warehouse_id`),
  ADD KEY `stock_transfers_to_warehouse_id_foreign` (`to_warehouse_id`),
  ADD KEY `stock_transfers_product_id_foreign` (`product_id`(768));

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

--
-- Indexes for table `transfer_vouchers`
--
ALTER TABLE `transfer_vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transfer_vouchers_tvid_unique` (`tvid`);

--
-- Indexes for table `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_bilties`
--
ALTER TABLE `vendor_bilties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_bilties_vendor_id_foreign` (`vendor_id`),
  ADD KEY `vendor_bilties_purchase_id_foreign` (`purchase_id`);

--
-- Indexes for table `vendor_ledgers`
--
ALTER TABLE `vendor_ledgers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_ledgers_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `vendor_payments`
--
ALTER TABLE `vendor_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_payments_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehouses_creater_id_index` (`creater_id`);

--
-- Indexes for table `warehouse_stocks`
--
ALTER TABLE `warehouse_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehouse_stocks_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `warehouse_stocks_product_id_foreign` (`product_id`);

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `account_heads`
--
ALTER TABLE `account_heads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `account_transfers`
--
ALTER TABLE `account_transfers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `customer_ledgers`
--
ALTER TABLE `customer_ledgers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `customer_payments`
--
ALTER TABLE `customer_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `day_closings`
--
ALTER TABLE `day_closings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expense_vouchers`
--
ALTER TABLE `expense_vouchers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_products`
--
ALTER TABLE `group_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_product_components`
--
ALTER TABLE `group_product_components`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inward_gatepasses`
--
ALTER TABLE `inward_gatepasses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inward_gatepass_items`
--
ALTER TABLE `inward_gatepass_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `narrations`
--
ALTER TABLE `narrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `other_incomes`
--
ALTER TABLE `other_incomes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_vouchers`
--
ALTER TABLE `payment_vouchers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_bookings`
--
ALTER TABLE `product_bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_discounts`
--
ALTER TABLE `product_discounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_return_items`
--
ALTER TABLE `purchase_return_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `receipts_vouchers`
--
ALTER TABLE `receipts_vouchers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_officers`
--
ALTER TABLE `sales_officers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_returns`
--
ALTER TABLE `sales_returns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transfer_vouchers`
--
ALTER TABLE `transfer_vouchers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transports`
--
ALTER TABLE `transports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor_bilties`
--
ALTER TABLE `vendor_bilties`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_ledgers`
--
ALTER TABLE `vendor_ledgers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vendor_payments`
--
ALTER TABLE `vendor_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouse_stocks`
--
ALTER TABLE `warehouse_stocks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_ledgers`
--
ALTER TABLE `customer_ledgers`
  ADD CONSTRAINT `customer_ledgers_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD CONSTRAINT `customer_payments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_products`
--
ALTER TABLE `group_products`
  ADD CONSTRAINT `group_products_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `group_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `group_product_components`
--
ALTER TABLE `group_product_components`
  ADD CONSTRAINT `group_product_components_group_product_id_foreign` FOREIGN KEY (`group_product_id`) REFERENCES `group_products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_product_components_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inward_gatepass_items`
--
ALTER TABLE `inward_gatepass_items`
  ADD CONSTRAINT `inward_gatepass_items_inward_gatepass_id_foreign` FOREIGN KEY (`inward_gatepass_id`) REFERENCES `inward_gatepasses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_discounts`
--
ALTER TABLE `product_discounts`
  ADD CONSTRAINT `product_discounts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD CONSTRAINT `purchase_returns_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_returns_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `purchase_return_items`
--
ALTER TABLE `purchase_return_items`
  ADD CONSTRAINT `purchase_return_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_return_items_purchase_return_id_foreign` FOREIGN KEY (`purchase_return_id`) REFERENCES `purchase_returns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_returns`
--
ALTER TABLE `sales_returns`
  ADD CONSTRAINT `sales_returns_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;
COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
