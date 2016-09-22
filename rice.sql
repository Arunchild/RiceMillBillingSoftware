-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2016 at 02:30 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rice`
--

-- --------------------------------------------------------

--
-- Table structure for table `billings`
--

CREATE TABLE IF NOT EXISTS `billings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bill_number` int(11) NOT NULL,
  `product_code` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kg` int(11) NOT NULL,
  `selling_price` decimal(20,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `sale_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `billings`
--

INSERT INTO `billings` (`id`, `bill_number`, `product_code`, `product_name`, `kg`, `selling_price`, `quantity`, `total`, `sale_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 1, 1, 'seval', 10, 1200.00, 3, 3600.00, '2016-03-14', '2016-03-14 04:19:54', '2016-03-14 04:19:54', NULL),
(10, 1, 2, 'kokku', 50, 5660.00, 2, 11320.00, '2016-03-14', '2016-03-14 04:20:02', '2016-03-14 04:20:02', NULL),
(11, 2, 1, 'seval', 10, 1200.00, 8, 9600.00, '2016-03-14', '2016-03-14 04:20:15', '2016-03-14 04:20:15', NULL),
(12, 2, 2, 'kokku', 50, 5660.00, 2, 11320.00, '2016-03-14', '2016-03-14 04:20:21', '2016-03-14 04:20:21', NULL),
(13, 3, 2, 'kokku', 50, 5660.00, 3, 16980.00, '2016-03-15', '2016-03-15 11:38:53', '2016-03-15 11:38:53', NULL),
(14, 3, 1, 'seval', 10, 1200.00, 2, 2400.00, '2016-03-15', '2016-03-15 11:39:42', '2016-03-15 11:39:42', NULL),
(15, 4, 1, 'seval', 10, 1200.00, 1, 1200.00, '2016-03-15', '2016-03-15 11:39:51', '2016-03-15 11:39:51', NULL),
(16, 5, 1, 'seval', 10, 1200.00, 1, 1200.00, '2016-03-15', '2016-03-15 12:09:04', '2016-03-15 12:09:04', NULL),
(17, 6, 1, 'seval', 10, 1200.00, 2, 2400.00, '2016-03-15', '2016-03-15 12:09:59', '2016-03-15 12:09:59', NULL),
(18, 7, 3, 'rice product', 20, 1200.00, 2, 2400.00, '2016-03-16', '2016-03-16 03:18:49', '2016-03-16 03:18:49', NULL),
(19, 7, 3, 'rice product', 20, 1200.00, 3, 3600.00, '2016-03-16', '2016-03-16 03:20:30', '2016-03-16 03:20:30', NULL),
(20, 7, 3, 'rice product', 20, 1200.00, 2, 2400.00, '2016-03-16', '2016-03-16 03:38:04', '2016-03-16 03:38:04', NULL),
(21, 7, 3, 'rice product', 20, 1200.00, 2, 2400.00, '2016-03-16', '2016-03-16 04:29:33', '2016-03-16 04:29:33', NULL),
(22, 8, 3, 'rice product', 20, 1200.00, 1, 1200.00, '2016-03-16', '2016-03-16 04:29:58', '2016-03-16 04:29:58', NULL),
(23, 8, 3, 'rice product', 20, 1200.00, 1, 1200.00, '2016-03-16', '2016-03-16 04:30:19', '2016-03-16 04:30:19', NULL),
(24, 8, 4, 'other product', 1, 20.00, 1, 20.00, '2016-03-16', '2016-03-16 04:31:36', '2016-03-16 04:31:36', NULL),
(25, 8, 2, 'kokku', 50, 5660.00, 1, 5660.00, '2016-03-16', '2016-03-16 04:31:56', '2016-03-16 04:31:56', NULL),
(26, 8, 2, 'kokku', 50, 5660.00, 2, 11320.00, '2016-03-16', '2016-03-16 04:45:07', '2016-03-16 04:45:07', NULL),
(27, 8, 1, 'seval', 10, 1200.00, 2, 2400.00, '2016-03-16', '2016-03-16 04:45:16', '2016-03-16 04:45:16', NULL),
(28, 9, 1, 'seval', 10, 1200.00, 1, 1200.00, '2016-03-16', '2016-03-16 04:47:51', '2016-03-16 04:47:51', NULL),
(29, 10, 3, 'rice product', 20, 1200.00, 1, 1200.00, '2016-03-16', '2016-03-16 04:48:06', '2016-03-16 04:48:26', '2016-03-16 04:48:26'),
(30, 11, 2, 'kokku', 50, 5660.00, 20, 113200.00, '2016-03-16', '2016-03-16 04:50:06', '2016-03-16 04:50:06', NULL),
(31, 12, 3, 'rice product', 20, 1200.00, 3, 3600.00, '2016-03-16', '2016-03-16 06:34:20', '2016-03-16 06:34:20', NULL),
(33, 13, 1, 'seval', 10, 1200.00, 1, 1200.00, '2016-03-16', '2016-03-16 06:35:23', '2016-03-16 06:35:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `billing_finals`
--

CREATE TABLE IF NOT EXISTS `billing_finals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bill_number` int(11) NOT NULL,
  `total_kg` int(11) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `net_amount` decimal(10,2) NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sale_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `billing_finals`
--

INSERT INTO `billing_finals` (`id`, `bill_number`, `total_kg`, `grand_total`, `discount`, `net_amount`, `customer_name`, `customer_phone`, `address`, `sale_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 1, 130, 14920.00, 0.00, 0.00, '', '', '', '2016-03-14', '2016-03-14 04:20:06', '2016-03-14 04:20:06', NULL),
(8, 2, 180, 20920.00, 0.00, 0.00, '', '', '', '2016-03-14', '2016-03-14 04:20:27', '2016-03-14 04:20:27', NULL),
(9, 3, 150, 16980.00, 0.00, 0.00, '', '', '', '2016-03-15', '2016-03-15 11:38:57', '2016-03-15 11:38:57', NULL),
(10, 4, 10, 1200.00, 0.00, 0.00, '', '', '', '2016-03-15', '2016-03-15 11:39:55', '2016-03-15 11:39:55', NULL),
(11, 4, 10, 1200.00, 0.00, 0.00, '', '', '', '2016-03-15', '2016-03-15 11:41:18', '2016-03-15 11:41:18', NULL),
(12, 5, 10, 1200.00, 0.00, 0.00, '', '', '', '2016-03-15', '2016-03-15 12:09:07', '2016-03-15 12:09:07', NULL),
(13, 6, 20, 2400.00, 0.00, 0.00, '', '', '', '2016-03-15', '2016-03-15 12:10:02', '2016-03-15 12:10:02', NULL),
(14, 7, 180, 10800.00, 0.00, 0.00, '', '', '', '2016-03-16', '2016-03-16 04:29:38', '2016-03-16 04:29:38', NULL),
(15, 8, 211, 21800.00, 0.00, 0.00, '', '', '', '2016-03-16', '2016-03-16 04:45:22', '2016-03-16 04:45:22', NULL),
(16, 9, 10, 1200.00, 0.00, 0.00, '', '', '', '2016-03-16', '2016-03-16 04:47:56', '2016-03-16 04:47:56', NULL),
(17, 10, 20, 1200.00, 0.00, 0.00, '', '', '', '2016-03-16', '2016-03-16 04:48:10', '2016-03-16 04:48:10', NULL),
(18, 10, 20, 1200.00, 0.00, 0.00, '', '', '', '2016-03-16', '2016-03-16 04:48:10', '2016-03-16 04:48:26', '2016-03-16 04:48:26'),
(19, 11, 1000, 113200.00, 0.00, 0.00, '', '', '', '2016-03-16', '2016-03-16 04:50:11', '2016-03-16 04:50:11', NULL),
(20, 11, 1000, 113200.00, 0.00, 0.00, '', '', '', '2016-03-16', '2016-03-16 04:50:11', '2016-03-16 04:50:11', NULL),
(21, 12, 60, 3600.00, 0.00, 0.00, '', '', '', '2016-03-16', '2016-03-16 06:34:26', '2016-03-16 06:34:26', NULL),
(22, 13, 10, 1200.00, 0.00, 0.00, '', '', '', '2016-03-16', '2016-03-16 06:35:27', '2016-03-16 06:35:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `billing_final_others`
--

CREATE TABLE IF NOT EXISTS `billing_final_others` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bill_number` int(11) NOT NULL,
  `total_kg` int(11) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `net_amount` decimal(10,2) NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sale_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `billing_final_others`
--

INSERT INTO `billing_final_others` (`id`, `bill_number`, `total_kg`, `grand_total`, `discount`, `net_amount`, `customer_name`, `customer_phone`, `address`, `sale_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 6, 160.00, 0.00, 0.00, '', '', '', '2016-03-16', '2016-03-16 01:00:00', '2016-03-16 01:00:18', '2016-03-16 01:00:18'),
(2, 1, 6, 160.00, 0.00, 0.00, '', '', '', '2016-03-16', '2016-03-16 01:00:08', '2016-03-16 01:00:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `billing_others`
--

CREATE TABLE IF NOT EXISTS `billing_others` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bill_number` int(11) NOT NULL,
  `product_code` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kg` int(11) NOT NULL,
  `selling_price` decimal(20,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `sale_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `billing_others`
--

INSERT INTO `billing_others` (`id`, `bill_number`, `product_code`, `product_name`, `kg`, `selling_price`, `quantity`, `total`, `sale_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 'spl sugar', 1, 60.00, 1, 60.00, '2016-03-16', '2016-03-16 00:55:46', '2016-03-16 01:00:18', '2016-03-16 01:00:18'),
(2, 1, 3, 'name', 1, 20.00, 5, 100.00, '2016-03-16', '2016-03-16 00:59:57', '2016-03-16 01:00:18', '2016-03-16 01:00:18'),
(3, 2, 3, 'name', 1, 20.00, 1, 20.00, '2016-03-16', '2016-03-16 04:36:05', '2016-03-16 04:36:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE IF NOT EXISTS `company_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cst` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `companyname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billingname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `addressline1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `addressline2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `terms_and_conditions` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`id`, `tin`, `cst`, `companyname`, `billingname`, `phone`, `addressline1`, `addressline2`, `terms_and_conditions`, `created_at`, `updated_at`) VALUES
(1, '2151654654tin', '564654csr', 'VINAYAGA MODERN RICE MILL', 'VINAYAGA MODERN RICE MILL', 'ph 85267201569  cal:honey', 'KANGAYAM,', 'TIRUPUR', 'GOODS ONCE SOLD CANNOT BE TAKEN BACK', '2016-03-16 07:14:20', '2016-03-16 07:32:47');

-- --------------------------------------------------------

--
-- Table structure for table `date_setings`
--

CREATE TABLE IF NOT EXISTS `date_setings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_masters`
--

CREATE TABLE IF NOT EXISTS `group_masters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax_percentage` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kaiirupus`
--

CREATE TABLE IF NOT EXISTS `kaiirupus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_12_12_023450_create_company_details_table', 1),
('2016_02_12_104442_create_product_masters_table', 1),
('2016_02_12_112757_create_group_masters_table', 1),
('2016_02_12_120642_create_billings_table', 1),
('2016_02_13_110536_create_billing_finals_table', 1),
('2016_02_15_070700_create_reports_table', 1),
('2016_02_26_080323_create_purchases_table', 1),
('2016_02_26_091316_create_purchase_finals_table', 1),
('2016_02_27_063551_create_date_setings_table', 1),
('2016_03_09_044332_create_settings_table', 1),
('2016_03_10_132140_create_kaiirupus_table', 1),
('2016_03_16_043133_create_product_master_others_table', 2),
('2016_03_16_044522_create_purchase_final_others_table', 3),
('2016_03_16_044601_create_purchase_others_table', 3),
('2016_03_16_061519_create_billing_others_table', 4),
('2016_03_16_061529_create_billing_final_others_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_masters`
--

CREATE TABLE IF NOT EXISTS `product_masters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kg` int(11) NOT NULL,
  `selling_price` decimal(20,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `in_stock` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `product_masters`
--

INSERT INTO `product_masters` (`id`, `product_name`, `kg`, `selling_price`, `created_at`, `updated_at`, `in_stock`) VALUES
(1, 'seval', 10, 1200.00, '2016-03-14 03:55:05', '2016-03-16 06:35:24', 2),
(2, 'kokku', 50, 5660.00, '2016-03-14 03:55:15', '2016-03-16 06:34:53', 2),
(3, 'rice product', 20, 1200.00, '2016-03-15 11:36:28', '2016-03-16 06:34:22', 6),
(4, 'other product', 1, 20.00, '2016-03-15 11:36:38', '2016-03-16 04:31:38', -1),
(5, 'SUGAR', 1, 50.00, '2016-03-15 23:06:57', '2016-03-15 23:06:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_master_others`
--

CREATE TABLE IF NOT EXISTS `product_master_others` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kg` int(11) NOT NULL,
  `selling_price` decimal(20,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `in_stock` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `product_master_others`
--

INSERT INTO `product_master_others` (`id`, `product_name`, `kg`, `selling_price`, `created_at`, `updated_at`, `in_stock`) VALUES
(2, 'spl sugar', 1, 60.00, '2016-03-15 23:10:18', '2016-03-15 23:10:18', 0),
(3, 'name', 1, 20.00, '2016-03-15 23:11:11', '2016-03-16 04:36:06', 5);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `purchase_number` int(11) NOT NULL,
  `product_code` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `selling_price` decimal(20,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `sale_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `type`, `purchase_number`, `product_code`, `product_name`, `selling_price`, `quantity`, `total`, `sale_date`, `created_at`, `updated_at`) VALUES
(1, '', 1, 1, 'seval', 1200.00, 20, 24000.00, '2016-03-14', '2016-03-14 03:55:25', '2016-03-14 03:55:25'),
(2, '', 1, 2, 'kokku', 5660.00, 30, 169800.00, '2016-03-14', '2016-03-14 03:55:31', '2016-03-14 03:55:31'),
(3, '', 2, 3, 'rice product', 1200.00, 20, 24000.00, '2016-03-16', '2016-03-16 03:18:33', '2016-03-16 03:18:33'),
(4, '', 3, 1, 'seval', 1200.00, 3, 3600.00, '2016-03-16', '2016-03-16 06:34:39', '2016-03-16 06:34:39'),
(5, '', 3, 2, 'kokku', 5660.00, 2, 11320.00, '2016-03-16', '2016-03-16 06:34:44', '2016-03-16 06:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_finals`
--

CREATE TABLE IF NOT EXISTS `purchase_finals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_number` int(11) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `net_amount` decimal(10,2) NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sale_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `purchase_finals`
--

INSERT INTO `purchase_finals` (`id`, `purchase_number`, `grand_total`, `discount`, `net_amount`, `customer_name`, `customer_phone`, `address`, `sale_date`, `created_at`, `updated_at`) VALUES
(1, 1, 193800.00, 0.00, 0.00, '', '', '', '2016-03-14', '2016-03-14 03:55:36', '2016-03-14 03:55:36'),
(2, 2, 24000.00, 0.00, 0.00, '', '', '', '2016-03-16', '2016-03-16 03:18:37', '2016-03-16 03:18:37'),
(3, 3, 14920.00, 0.00, 0.00, '', '', '', '2016-03-16', '2016-03-16 06:34:48', '2016-03-16 06:34:48');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_final_others`
--

CREATE TABLE IF NOT EXISTS `purchase_final_others` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_number` int(11) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `net_amount` decimal(10,2) NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sale_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `purchase_final_others`
--

INSERT INTO `purchase_final_others` (`id`, `purchase_number`, `grand_total`, `discount`, `net_amount`, `customer_name`, `customer_phone`, `address`, `sale_date`, `created_at`, `updated_at`) VALUES
(1, 1, 24000.00, 0.00, 0.00, '', '', '', '2016-03-16', '2016-03-15 23:31:21', '2016-03-15 23:31:21'),
(2, 2, 250.00, 0.00, 0.00, '', '', '', '2016-03-16', '2016-03-15 23:32:36', '2016-03-15 23:32:36'),
(3, 3, 7200.00, 0.00, 0.00, '', '', '', '2016-03-16', '2016-03-15 23:32:58', '2016-03-15 23:32:58'),
(4, 4, 300.00, 0.00, 0.00, '', '', '', '2016-03-16', '2016-03-15 23:33:57', '2016-03-15 23:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_others`
--

CREATE TABLE IF NOT EXISTS `purchase_others` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `purchase_number` int(11) NOT NULL,
  `product_code` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `selling_price` decimal(20,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `sale_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `purchase_others`
--

INSERT INTO `purchase_others` (`id`, `type`, `purchase_number`, `product_code`, `product_name`, `selling_price`, `quantity`, `total`, `sale_date`, `created_at`, `updated_at`) VALUES
(1, '', 1, 1, 'seval', 1200.00, 20, 24000.00, '2016-03-16', '2016-03-15 23:31:17', '2016-03-15 23:31:17'),
(2, '', 2, 5, 'SUGAR', 50.00, 5, 250.00, '2016-03-16', '2016-03-15 23:32:31', '2016-03-15 23:32:31'),
(3, '', 3, 3, 'rice product', 1200.00, 6, 7200.00, '2016-03-16', '2016-03-15 23:32:52', '2016-03-15 23:32:52'),
(4, '', 4, 5, 'SUGAR', 50.00, 6, 300.00, '2016-03-16', '2016-03-15 23:33:53', '2016-03-15 23:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `printer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `copy` int(11) NOT NULL,
  `preprint_space` int(11) NOT NULL,
  `bill_paper` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `printer_name`, `copy`, `preprint_space`, `bill_paper`, `created_at`, `updated_at`) VALUES
(1, 'TVS MSP 250 Star', 1, 0, 'HALF', '2016-03-14 05:32:38', '2016-03-14 05:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
