-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2022 at 06:04 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vyaparidb`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `id` int(11) NOT NULL,
  `publishing_start_time` datetime NOT NULL DEFAULT current_timestamp(),
  `publishing_end_time` datetime NOT NULL DEFAULT current_timestamp(),
  `icon` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `business_category`
--

CREATE TABLE `business_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `active_status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business_category`
--

INSERT INTO `business_category` (`id`, `name`, `description`, `image`, `user_id`, `active_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'iron and steel', 'iron and steel', 'images/business_category/633693ec90e03.jpeg', 39, 1, '2022-10-03 05:10:25', '2022-10-03 05:10:25', NULL),
(4, 'plastics & polymers', 'plastics & polymers', 'images/business_category/633693ec90e03.jpeg', 39, 1, '2022-10-03 05:12:09', '2022-10-03 05:12:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `business_sub_category`
--

CREATE TABLE `business_sub_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `active_status` tinyint(4) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `business_category_id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business_sub_category`
--

INSERT INTO `business_sub_category` (`id`, `name`, `description`, `image`, `active_status`, `created_at`, `updated_at`, `business_category_id`, `deleted_at`) VALUES
(1, 'cloth', 'Hello', 'images\\/business_sub_category\\/633a855384abc.jpeg', 1, '2022-10-03 06:55:07', '2022-10-03 06:55:07', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `active_status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `business_sub_category_id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `connection_request`
--

CREATE TABLE `connection_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `connection_id` varchar(50) NOT NULL,
  `auth_code` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `connection_request`
--

INSERT INTO `connection_request` (`id`, `user_id`, `connection_id`, `auth_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, NULL, '10CJ#8P9TF', 'VDU162KE19', '2022-08-09 06:48:43', '2022-08-26 06:49:06', NULL),
(21, 39, 'USL922C#M5', '$JTCV2ZMQO', '2022-08-26 07:07:23', '2022-09-23 04:29:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `educational_material`
--

CREATE TABLE `educational_material` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `decsription` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `locality` varchar(150) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `business_category` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `lattitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `venue`, `locality`, `city`, `state`, `date`, `start_time`, `end_time`, `business_category`, `description`, `image`, `lattitude`, `longitude`, `created_at`, `updated_at`, `deleted_at`, `created_by`) VALUES
(6, 'happy navratry', 'Indira nagar', 'block B', 'lucknow', 'Uttar pradesh', '2022-09-12', '2022-09-12 10:00:00', '2022-09-12 02:00:00', NULL, NULL, 'images/events/632da5e12847d.jpeg', NULL, NULL, '2022-09-23 10:15:33', '2022-09-26 04:11:42', NULL, 39);

-- --------------------------------------------------------

--
-- Table structure for table `government_scheme`
--

CREATE TABLE `government_scheme` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `government_scheme_category`
--

CREATE TABLE `government_scheme_category` (
  `id` int(11) NOT NULL,
  `scheme_category` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `government_scheme_category`
--

INSERT INTO `government_scheme_category` (`id`, `scheme_category`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'scheme2', 39, '2022-09-29 01:41:42', '2022-09-29 03:23:54', NULL),
(2, 'scheme2', 39, '2022-09-29 04:46:14', '2022-09-29 04:46:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `quantity` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `price` float NOT NULL,
  `sku_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `offer_price` float DEFAULT NULL,
  `offer_start_time` datetime DEFAULT NULL,
  `offer_end_time` datetime DEFAULT NULL,
  `shipping_weight` float DEFAULT NULL,
  `free_shipping` tinyint(4) DEFAULT NULL,
  `available_from` datetime NOT NULL DEFAULT current_timestamp(),
  `min_order_quantity` int(11) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` varchar(45) DEFAULT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `second_name` varchar(45) NOT NULL,
  `gender` enum('M','F','O') NOT NULL DEFAULT 'O',
  `business_type` varchar(100) NOT NULL,
  `registration_date` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `first_name`, `second_name`, `gender`, `business_type`, `registration_date`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 'singh', 'singh', 'O', 'bossgiri', '2022-08-17 11:25:40', 39, '2022-08-26 17:02:16', '2022-08-26 17:08:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `membership_details`
--

CREATE TABLE `membership_details` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `business_state` varchar(100) NOT NULL,
  `home_state` varchar(100) NOT NULL,
  `enrollment_category_id` int(11) NOT NULL,
  `reference_name` varchar(100) DEFAULT NULL,
  `reference_country_code` varchar(10) DEFAULT NULL,
  `reference_mobile_number` varchar(10) DEFAULT NULL,
  `start_date` datetime NOT NULL DEFAULT current_timestamp(),
  `end_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `membership_details`
--

INSERT INTO `membership_details` (`id`, `member_id`, `business_state`, `home_state`, `enrollment_category_id`, `reference_name`, `reference_country_code`, `reference_mobile_number`, `start_date`, `end_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 10, 'Maharashtra', 'Washington PC', 2, 'Sona', '+21', '8544833822', '2022-09-08 00:00:00', '1970-07-01 00:00:00', '2022-09-07 07:08:18', '2022-09-08 06:14:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `membership_plan`
--

CREATE TABLE `membership_plan` (
  `id` int(11) NOT NULL,
  `plan_name` varchar(100) NOT NULL,
  `duration_months` int(11) NOT NULL,
  `contribution_amount` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `membership_plan`
--

INSERT INTO `membership_plan` (`id`, `plan_name`, `duration_months`, `contribution_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Promoter', 6, 12000, '2022-09-05 16:08:28', '2022-09-05 16:08:28', NULL),
(2, 'Co Promoter', 6, 9000, '2022-09-05 16:09:09', '2022-09-05 16:09:09', NULL),
(3, 'Chief Patron', 6, 18000, '2022-09-05 16:09:41', '2022-09-05 16:09:41', NULL),
(4, 'Patron', 6, 15000, '2022-09-05 16:10:06', '2022-09-05 16:10:06', NULL),
(5, 'General', 6, 3000, '2022-09-05 16:10:37', '2022-09-05 16:10:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `membership_plan_old`
--

CREATE TABLE `membership_plan_old` (
  `id` int(11) NOT NULL,
  `plan_name` varchar(100) NOT NULL,
  `duration_months` int(11) NOT NULL,
  `contribution_amount` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `membership_plan_old`
--

INSERT INTO `membership_plan_old` (`id`, `plan_name`, `duration_months`, `contribution_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Co Promoter', 6, 9000, '2022-09-05 16:09:09', '2022-09-05 16:09:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_event`
--

CREATE TABLE `member_event` (
  `member_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `member_offer`
--

CREATE TABLE `member_offer` (
  `member_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `member_personal_detail`
--

CREATE TABLE `member_personal_detail` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `father_first_name` varchar(100) NOT NULL,
  `father_second_name` varchar(100) DEFAULT NULL,
  `marital_status` enum('Yes','No') DEFAULT NULL COMMENT '//0 - unmarried\r\n//1 - married',
  `spouse_first_name` varchar(100) DEFAULT NULL,
  `spouse_second_name` varchar(100) DEFAULT NULL,
  `vaish_ghatak` varchar(100) DEFAULT NULL,
  `Gotra_name` varchar(100) DEFAULT NULL,
  `date_of_Birth` date NOT NULL,
  `date_of_marriage` date DEFAULT NULL,
  `spouse_date_of_Birth` date DEFAULT NULL,
  `pan_card` varchar(10) DEFAULT NULL,
  `aadhar_number` varchar(12) NOT NULL,
  `member_pic` tinytext NOT NULL,
  `aadhar_pic` tinytext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member_personal_detail`
--

INSERT INTO `member_personal_detail` (`id`, `member_id`, `father_first_name`, `father_second_name`, `marital_status`, `spouse_first_name`, `spouse_second_name`, `vaish_ghatak`, `Gotra_name`, `date_of_Birth`, `date_of_marriage`, `spouse_date_of_Birth`, `pan_card`, `aadhar_number`, `member_pic`, `aadhar_pic`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 10, 'Piyo', 'baba', 'Yes', 'Conditional', 'Joshi', 'blahblah', 'bluhbluh', '2022-08-15', '2022-08-17', '2022-08-16', 'DDKPH5489K', '123456789012', 'profile/63318ba968996.jpeg', '//path/aadhar_pic', '2022-08-27 02:51:02', '2022-09-26 17:05:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_professional_detail`
--

CREATE TABLE `member_professional_detail` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `educational_qualification` varchar(100) NOT NULL,
  `work_category` varchar(100) NOT NULL,
  `job_designation` varchar(100) DEFAULT NULL,
  `firm_name` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member_professional_detail`
--

INSERT INTO `member_professional_detail` (`id`, `member_id`, `educational_qualification`, `work_category`, `job_designation`, `firm_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10, 'B. A. Pass', 'Piye Jao', 'Babudom', 'Theka', '2022-08-27 04:58:05', '2022-08-27 05:04:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `amount_off` float DEFAULT NULL,
  `percentage_off` float DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `coupon_code` varchar(100) DEFAULT NULL,
  `require_coupon` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `min_total_order_amt` int(11) DEFAULT 0 COMMENT '//min amount of order for shipping or free shipping'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` int(11) NOT NULL,
  `country_code` varchar(10) NOT NULL DEFAULT '+91',
  `mobile` varchar(10) NOT NULL,
  `otp` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `country_code`, `mobile`, `otp`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, '+91', '9650268561', 3153, '2022-08-09 11:36:51', '2022-08-26 07:07:58', NULL),
(7, '+91', '7379612146', 2592, '2022-08-17 05:57:17', '2022-08-17 05:57:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `permission` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated-at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `model_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'visitor', '2022-08-09 15:28:23', '2022-08-09 15:28:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permission_module`
--

CREATE TABLE `role_permission_module` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `software_category`
--

CREATE TABLE `software_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `software_category`
--

INSERT INTO `software_category` (`id`, `category_name`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Accounting software', 39, '2022-09-27 04:17:21', '2022-09-27 04:17:21', NULL),
(2, 'HRMS softwares', 39, '2022-09-27 04:17:43', '2022-09-27 04:18:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `software_tool`
--

CREATE TABLE `software_tool` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `software_tool`
--

INSERT INTO `software_tool` (`id`, `category_id`, `owner`, `name`, `image`, `description`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Vandana', 'vandana yadav', 'images/software_tool/6333d81f602cd.jpeg', 'Hello', 39, '2022-09-27 11:50:36', '2022-09-28 06:08:18', NULL),
(2, 2, 'Puneet', 'Abcd', 'images/software_tool/6333d81f602cd.jpeg', 'jnfjrsbgjr sdjngkd dskfnsdkn dskfnskdnf skdfnksdnf', 39, '2022-09-28 06:05:44', '2022-09-28 06:05:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `country_code` varchar(10) NOT NULL DEFAULT '+91',
  `mobile_number` varchar(10) NOT NULL,
  `email` varchar(150) NOT NULL COMMENT '//null - window shopper dont need email',
  `user_role` int(11) NOT NULL DEFAULT 1 COMMENT '//1 - window shopper',
  `password` varchar(255) DEFAULT NULL COMMENT '//null - window shopper dont need password',
  `user_name` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `country_code`, `mobile_number`, `email`, `user_role`, `password`, `user_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, '+91', '7379612146', 'divya@choudhary', 1, 'qwerty', 'asdf', '2022-08-17 11:25:40', '2022-08-17 11:25:40', NULL),
(39, '+91', '9650268521', 'dgfdsk@erof', 1, NULL, NULL, '2022-08-26 07:09:56', '2022-08-26 07:09:56', NULL),
(40, '+91', '4324434546', '5457@rteuori', 1, NULL, NULL, '2022-09-15 11:57:58', '2022-09-15 11:57:58', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `business_category`
--
ALTER TABLE `business_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `business_sub_category`
--
ALTER TABLE `business_sub_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_category_id` (`business_category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_sub_category_id` (`business_sub_category_id`);

--
-- Indexes for table `connection_request`
--
ALTER TABLE `connection_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `educational_material`
--
ALTER TABLE `educational_material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `government_scheme`
--
ALTER TABLE `government_scheme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`),
  ADD KEY `user_id_3` (`user_id`),
  ADD KEY `category` (`category_id`);

--
-- Indexes for table `government_scheme_category`
--
ALTER TABLE `government_scheme_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `membership_details`
--
ALTER TABLE `membership_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollment_category_id` (`enrollment_category_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `membership_plan`
--
ALTER TABLE `membership_plan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plan_uniqueness` (`plan_name`,`duration_months`,`contribution_amount`) USING BTREE;

--
-- Indexes for table `membership_plan_old`
--
ALTER TABLE `membership_plan_old`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plan_uniqueness` (`plan_name`,`duration_months`,`contribution_amount`) USING BTREE;

--
-- Indexes for table `member_event`
--
ALTER TABLE `member_event`
  ADD PRIMARY KEY (`member_id`,`event_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `member_offer`
--
ALTER TABLE `member_offer`
  ADD PRIMARY KEY (`member_id`,`offer_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `offer_id` (`offer_id`);

--
-- Indexes for table `member_personal_detail`
--
ALTER TABLE `member_personal_detail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `member_id_2` (`member_id`),
  ADD UNIQUE KEY `aadhar_number` (`aadhar_number`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `member_professional_detail`
--
ALTER TABLE `member_professional_detail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `member_id_2` (`member_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permission_module`
--
ALTER TABLE `role_permission_module`
  ADD PRIMARY KEY (`permission_id`,`role_id`,`module_id`),
  ADD KEY `mm_role_fk` (`role_id`),
  ADD KEY `mm_module` (`module_id`);

--
-- Indexes for table `software_category`
--
ALTER TABLE `software_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `software_tool`
--
ALTER TABLE `software_tool`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile_number` (`mobile_number`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD KEY `user_role` (`user_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business_category`
--
ALTER TABLE `business_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `business_sub_category`
--
ALTER TABLE `business_sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `connection_request`
--
ALTER TABLE `connection_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `educational_material`
--
ALTER TABLE `educational_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `government_scheme`
--
ALTER TABLE `government_scheme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `government_scheme_category`
--
ALTER TABLE `government_scheme_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `membership_details`
--
ALTER TABLE `membership_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `membership_plan`
--
ALTER TABLE `membership_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `membership_plan_old`
--
ALTER TABLE `membership_plan_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `member_personal_detail`
--
ALTER TABLE `member_personal_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `member_professional_detail`
--
ALTER TABLE `member_professional_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `software_category`
--
ALTER TABLE `software_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `software_tool`
--
ALTER TABLE `software_tool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD CONSTRAINT `ad_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `business_category`
--
ALTER TABLE `business_category`
  ADD CONSTRAINT `business_category_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `business_sub_category`
--
ALTER TABLE `business_sub_category`
  ADD CONSTRAINT `Buss_cat_fk` FOREIGN KEY (`business_category_id`) REFERENCES `business_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `Buss_sub_cat_fk` FOREIGN KEY (`business_sub_category_id`) REFERENCES `business_sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `connection_request`
--
ALTER TABLE `connection_request`
  ADD CONSTRAINT `conn_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `educational_material`
--
ALTER TABLE `educational_material`
  ADD CONSTRAINT `edu_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `government_scheme`
--
ALTER TABLE `government_scheme`
  ADD CONSTRAINT `gs_gschemecat_fk` FOREIGN KEY (`category_id`) REFERENCES `government_scheme_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `gs_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inv_member_fk` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inv_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `memb_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `membership_details`
--
ALTER TABLE `membership_details`
  ADD CONSTRAINT `membship_enroll_id` FOREIGN KEY (`enrollment_category_id`) REFERENCES `membership_plan_old` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `membship_memb_id` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `member_event`
--
ALTER TABLE `member_event`
  ADD CONSTRAINT `mm_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mm_member_id` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `member_offer`
--
ALTER TABLE `member_offer`
  ADD CONSTRAINT `mm_member_fk` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mm_offer_fk` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `member_personal_detail`
--
ALTER TABLE `member_personal_detail`
  ADD CONSTRAINT `pd_member_fk` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `member_professional_detail`
--
ALTER TABLE `member_professional_detail`
  ADD CONSTRAINT `prd_member_fk` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `mm_category_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mm_product_fk` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `role_permission_module`
--
ALTER TABLE `role_permission_module`
  ADD CONSTRAINT `mm_module` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mm_permission_fk` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mm_role_fk` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `software_tool`
--
ALTER TABLE `software_tool`
  ADD CONSTRAINT `cat_fk` FOREIGN KEY (`category_id`) REFERENCES `software_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `swt_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_role_fk` FOREIGN KEY (`user_role`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
