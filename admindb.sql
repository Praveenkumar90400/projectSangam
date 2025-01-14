-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2024 at 06:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `connection_requests`
--

CREATE TABLE `connection_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `connection_id` varchar(255) DEFAULT NULL,
  `auth_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `connection_requests`
--

INSERT INTO `connection_requests` (`id`, `user_id`, `connection_id`, `auth_code`, `created_at`, `updated_at`) VALUES
(23, NULL, '78107565410077818311', NULL, NULL, NULL),
(25, 12, '78107565410077818311', '31TjQouG5kOinizGvtqN', '2024-08-05 04:15:12', '2024-08-05 04:15:12'),
(26, NULL, '80112121666990668399', NULL, NULL, NULL),
(28, NULL, '12098112109113108109', NULL, NULL, NULL),
(29, NULL, '90108116106781088668', NULL, NULL, NULL),
(30, 12, '90108116106781088668', '6PUooXsyg1t6P8ZR8AaE', '2024-08-07 06:48:43', '2024-08-07 06:48:43'),
(31, NULL, '55100112887111469112', NULL, NULL, NULL),
(32, 13, '55100112887111469112', 'u2BvLS1VPqT9cjlKULvw', '2024-08-08 23:56:03', '2024-08-08 23:56:03');

-- --------------------------------------------------------

--
-- Table structure for table `driver_kyc_details`
--

CREATE TABLE `driver_kyc_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `document_type` varchar(255) DEFAULT NULL,
  `document_number` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `care_of` varchar(255) DEFAULT NULL,
  `house` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `subdistrict` varchar(255) DEFAULT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `locality` varchar(255) DEFAULT NULL,
  `post_office` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `vtc_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kyc_status` tinyint(4) NOT NULL DEFAULT 0,
  `kyc_approval_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `driver_kyc_details`
--

INSERT INTO `driver_kyc_details` (`id`, `driver_id`, `document_type`, `document_number`, `name`, `email`, `mobile`, `image`, `date_of_birth`, `gender`, `care_of`, `house`, `street`, `district`, `subdistrict`, `landmark`, `locality`, `post_office`, `state`, `pincode`, `country`, `vtc_name`, `created_at`, `updated_at`, `kyc_status`, `kyc_approval_date`) VALUES
(1, 4, 'Aadhar', 124565324521, 'alok', 'alok@gmail.com', 9865321245, 'uploads/image.png', '2024-08-05', 'male', 'data', 'data', 'data', 'data', 'data', 'data', 'data', 'data', 'data', 253656, 'india', 'data', '2024-08-08 12:33:34', '2024-08-08 12:33:34', 0, NULL),
(7, 6, 'Aadhar', 124565324558, 'Ritik Gupta', 'alok@gmail.com', 9865321245, 'uploads/image.png', '2024-08-05', 'male', 'data', 'data', 'data', 'data', 'data', 'data', 'data', 'data', 'data', 253656, 'india', 'data', '2024-08-13 01:05:45', '2024-08-13 01:05:45', 0, NULL),
(10, 7, 'Aadhar', 124565324553, 'Karan Rana', 'alok@gmail.com', 9865321245, 'uploads/image.png', '2024-08-05', 'male', 'data', 'data', 'data', 'data', 'data', 'data', 'data', 'data', 'data', 253656, 'india', 'data', '2024-08-13 01:07:23', '2024-08-13 01:07:23', 0, NULL),
(11, 10, 'Aadhar', 124565324554, 'Akarsh Kumar', 'alok@gmail.com', 9865321245, 'uploads/image.png', '2024-08-05', 'male', 'data', 'data', 'data', 'data', 'data', 'data', 'data', 'data', 'data', 253656, 'india', 'data', '2024-08-13 03:22:40', '2024-08-13 03:22:40', 0, NULL),
(12, 11, 'Aadhar', 1245653245587, 'Akash Kumar', 'alok@gmail.com', 9865321245, 'uploads/image.png', '2024-08-05', 'male', 'data', 'data', 'data', 'data', 'data', 'data', 'data', 'data', 'data', 253656, 'india', 'data', '2024-08-13 03:25:56', '2024-08-13 03:25:56', 0, '2024-08-08');

-- --------------------------------------------------------

--
-- Table structure for table `driving_license_details`
--

CREATE TABLE `driving_license_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `license_number` varchar(255) DEFAULT NULL,
  `license_holder` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rto_name` varchar(255) DEFAULT NULL,
  `transport_from` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `hill_valid_till` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `transport_to` varchar(255) DEFAULT NULL,
  `last_endorsed_date` date DEFAULT NULL,
  `non_transport_from` date DEFAULT NULL,
  `non_transport_to` date DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `dependent_name` varchar(255) DEFAULT NULL,
  `old_new_di_number` varchar(255) DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL,
  `last_endorsed_office` varchar(255) DEFAULT NULL,
  `last_transaction` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cov_category` varchar(255) DEFAULT NULL,
  `cov_issue_date` date DEFAULT NULL,
  `class_of_vehicle` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `hazardous_valid_till` date DEFAULT NULL,
  `initial_issuing_office` varchar(255) DEFAULT NULL,
  `kyc_completed` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `driving_license_details`
--

INSERT INTO `driving_license_details` (`id`, `license_number`, `license_holder`, `date_of_birth`, `image`, `rto_name`, `transport_from`, `address`, `hill_valid_till`, `status`, `transport_to`, `last_endorsed_date`, `non_transport_from`, `non_transport_to`, `source`, `blood_group`, `dependent_name`, `old_new_di_number`, `pincode`, `last_endorsed_office`, `last_transaction`, `created_at`, `updated_at`, `cov_category`, `cov_issue_date`, `class_of_vehicle`, `state`, `issue_date`, `hazardous_valid_till`, `initial_issuing_office`, `kyc_completed`) VALUES
(4, 'HP4545464666781', 'Komal Gupta', '2024-08-05', 'uploads/image.jpg', 'data', 'data', 'data', '2024-08-05', 1, 'data', '2024-08-05', '2024-08-05', '2024-08-05', 'data', 'a+', 'data', '9985556565', 123256, 'data', 'data', '2024-08-08 01:52:57', '2024-08-08 01:52:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(5, 'HP4545464666787', 'Anurag Jain', '2024-08-05', 'uploads/image.jpg', 'data', 'data', 'data', '2024-08-05', 1, 'data', '2024-08-05', '2024-08-05', '2024-08-05', 'data', 'a+', 'data', '9985556565', 123256, 'data', 'data', '2024-08-13 01:41:05', '2024-08-13 01:41:05', 'data', '2024-08-05', 'data', 'data', '2024-08-05', '2024-08-05', 'data', 0);

-- --------------------------------------------------------

--
-- Table structure for table `factories`
--

CREATE TABLE `factories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` bigint(20) UNSIGNED DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `factory_gates`
--

CREATE TABLE `factory_gates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gate_number` int(11) DEFAULT NULL,
  `factory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `factory_gate_logs`
--

CREATE TABLE `factory_gate_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `factory_id` int(11) DEFAULT NULL,
  `gate_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vehicle_id` bigint(20) UNSIGNED DEFAULT NULL,
  `driver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `in_time` timestamp NULL DEFAULT NULL,
  `out_time` timestamp NULL DEFAULT NULL,
  `exit_gate` int(11) DEFAULT NULL,
  `exit_driver_id` int(11) DEFAULT NULL,
  `exit_user_id` int(11) DEFAULT NULL,
  `entry_remark` text DEFAULT NULL,
  `exit_remark` text DEFAULT NULL,
  `entry_weight` decimal(10,2) DEFAULT NULL,
  `exit_weight` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `financing_details`
--

CREATE TABLE `financing_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `financier` varchar(255) DEFAULT NULL,
  `rc_details_id` bigint(20) UNSIGNED DEFAULT NULL,
  `financed` varchar(255) DEFAULT NULL,
  `financing_status_as_on` date DEFAULT NULL,
  `pucc_number` varchar(255) DEFAULT NULL,
  `pucc_upto` date DEFAULT NULL,
  `mobile_number` bigint(20) UNSIGNED DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL,
  `vehicle_tax_upto` date DEFAULT NULL,
  `rc_standard_cap` varchar(255) DEFAULT NULL,
  `non_use_status` tinyint(1) NOT NULL DEFAULT 0,
  `non_use_from` date DEFAULT NULL,
  `non_use_to` date DEFAULT NULL,
  `is_commercial` tinyint(1) NOT NULL DEFAULT 0,
  `registered_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `financing_details`
--

INSERT INTO `financing_details` (`id`, `financier`, `rc_details_id`, `financed`, `financing_status_as_on`, `pucc_number`, `pucc_upto`, `mobile_number`, `pincode`, `vehicle_tax_upto`, `rc_standard_cap`, `non_use_status`, `non_use_from`, `non_use_to`, `is_commercial`, `registered_at`, `created_at`, `updated_at`) VALUES
(21, 'Kalyan Kumar', 36, 'data', '2024-08-05', '656566998', '2024-08-05', 9865325632, 236523, '2024-08-05', 'data', 1, '2024-08-05', '2024-08-05', 1, 'lucknow', '2024-08-13 04:18:44', '2024-08-13 04:18:44'),
(22, 'Kalyan Kumar', 38, 'data', '2024-08-05', '656566998', '2024-08-05', 9865325632, 236523, '2024-08-05', 'data', 1, '2024-08-05', '2024-08-05', 1, 'lucknow', '2024-08-13 04:19:58', '2024-08-13 04:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_rc_insurance_details`
--

CREATE TABLE `kyc_rc_insurance_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `policy_number` varchar(255) DEFAULT NULL,
  `rc_details_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `kyc_vehicle_challan_details` text DEFAULT NULL,
  `kyc_vehicle_black_list_details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kyc_rc_insurance_details`
--

INSERT INTO `kyc_rc_insurance_details` (`id`, `policy_number`, `rc_details_id`, `company`, `expiry_date`, `kyc_vehicle_challan_details`, `kyc_vehicle_black_list_details`, `created_at`, `updated_at`) VALUES
(16, '124563', 36, 'inventics', '2024-08-05', 'data', 'data', '2024-08-13 04:18:44', '2024-08-13 04:18:44'),
(17, '124563', 38, 'inventics', '2024-08-05', 'data', 'data', '2024-08-13 04:19:58', '2024-08-13 04:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_rc_national_permits`
--

CREATE TABLE `kyc_rc_national_permits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `issue_by` varchar(255) DEFAULT NULL,
  `kyc_rc_permit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `permit_number` varchar(255) DEFAULT NULL,
  `national_permit_number` varchar(255) DEFAULT NULL,
  `national_permit_upto` date DEFAULT NULL,
  `national_permit_issued_by` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kyc_rc_national_permits`
--

INSERT INTO `kyc_rc_national_permits` (`id`, `issue_by`, `kyc_rc_permit_id`, `permit_number`, `national_permit_number`, `national_permit_upto`, `national_permit_issued_by`, `expiry_date`, `created_at`, `updated_at`) VALUES
(19, 'data', 20, '214565', '653256', '2024-08-05', 'data', '2024-08-05', '2024-08-13 04:18:44', '2024-08-13 04:18:44'),
(20, 'data', 21, '214565', '653256', '2024-08-05', 'data', '2024-08-05', '2024-08-13 04:19:58', '2024-08-13 04:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_rc_permits`
--

CREATE TABLE `kyc_rc_permits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `issue_date` date DEFAULT NULL,
  `rc_details_id` bigint(20) UNSIGNED DEFAULT NULL,
  `permit_number` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `permit_valid_from` date DEFAULT NULL,
  `permit_valid_upto` date DEFAULT NULL,
  `kyc_rc_permit_data` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kyc_rc_permits`
--

INSERT INTO `kyc_rc_permits` (`id`, `issue_date`, `rc_details_id`, `permit_number`, `expiry_date`, `type`, `permit_valid_from`, `permit_valid_upto`, `kyc_rc_permit_data`, `created_at`, `updated_at`) VALUES
(20, '2024-08-05', 36, '214565', '2024-08-05', 'datatype', '2024-08-05', '2024-08-05', 'data', '2024-08-13 04:18:44', '2024-08-13 04:18:44'),
(21, '2024-08-05', 38, '214565', '2024-08-05', 'datatype', '2024-08-05', '2024-08-05', 'data', '2024-08-13 04:19:58', '2024-08-13 04:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_rc_vehicle_details`
--

CREATE TABLE `kyc_rc_vehicle_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `manufactured_date` date DEFAULT NULL,
  `rc_details_id` bigint(20) UNSIGNED DEFAULT NULL,
  `variant` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `category_description` text DEFAULT NULL,
  `chassis_number` varchar(255) DEFAULT NULL,
  `engine_number` varchar(255) DEFAULT NULL,
  `maker_description` text DEFAULT NULL,
  `maker_model` varchar(255) DEFAULT NULL,
  `body_type` varchar(255) DEFAULT NULL,
  `fuel_type` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `cubic_capacity` int(11) DEFAULT NULL,
  `gross_weight` int(11) DEFAULT NULL,
  `number_of_cylinders` int(11) DEFAULT NULL,
  `seating_capacity` int(11) DEFAULT NULL,
  `wheelbase` int(11) DEFAULT NULL,
  `unladen_weight` int(11) DEFAULT NULL,
  `standing_capacity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kyc_rc_vehicle_details`
--

INSERT INTO `kyc_rc_vehicle_details` (`id`, `manufactured_date`, `rc_details_id`, `variant`, `category`, `category_description`, `chassis_number`, `engine_number`, `maker_description`, `maker_model`, `body_type`, `fuel_type`, `color`, `cubic_capacity`, `gross_weight`, `number_of_cylinders`, `seating_capacity`, `wheelbase`, `unladen_weight`, `standing_capacity`, `created_at`, `updated_at`) VALUES
(17, '2024-08-05', 36, 'data', 'data', 'data', '656565', '656565', 'data', 'data', 'data', 'data', 'blue', 10, 10, 10, 10, 10, 10, 10, '2024-08-13 04:18:44', '2024-08-13 04:18:44'),
(18, '2024-08-05', 38, 'data', 'data', 'data', '656565', '656565', 'data', 'data', 'data', 'data', 'blue', 10, 10, 10, 10, 10, 10, 10, '2024-08-13 04:19:58', '2024-08-13 04:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2014_10_12_200000_add_two_factor_columns_to_users_table', 2),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(11, '2022_11_01_162600_create_sessions_table', 2),
(12, '2024_08_02_043026_create_roles_table', 3),
(13, '2024_08_02_043636_user_roles_add_column_to_users', 4),
(14, '2024_08_05_051314_create_connection_requests_table', 5),
(15, '2024_08_06_060848_create_rc_details_table', 6),
(16, '2024_08_06_063234_create_owner_details_table', 7),
(17, '2024_08_06_064318_create_financing_details_table', 8),
(18, '2024_08_06_070624_create_kyc_rc_permits_table', 9),
(19, '2024_08_06_071529_create_kyc_rc_national_permits_table', 10),
(20, '2024_08_06_072254_create_kyc_rc_vehicle_details_table', 11),
(21, '2024_08_06_085315_create_kyc_rc_insurance_details_table', 12),
(23, '2024_08_06_095844_create_rc_complete_details_table', 13),
(24, '2024_08_06_120957_create_driving_license_details_table', 14),
(25, '2024_08_07_050442_create_class_of_vehicle_details_table', 15),
(26, '2024_08_07_085659_create_driver_kyc_details_table', 16),
(27, '2024_08_07_102909_create_factories_table', 17),
(28, '2024_08_07_103645_create_vehicle_tracking_table', 18),
(29, '2024_08_13_062653_driving_license_complete_details_add_column_to_driving_license_details', 19),
(30, '2024_08_13_072900_driver_kyc_complete_details_add_column_to_driver_kyc_details', 20),
(31, '2024_08_14_042652_create_factory_gates_table', 21),
(32, '2024_08_14_043636_create_staff_attendances_table', 22);

-- --------------------------------------------------------

--
-- Table structure for table `owner_details`
--

CREATE TABLE `owner_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `owner_name` varchar(255) DEFAULT NULL,
  `rc_details_id` bigint(20) UNSIGNED DEFAULT NULL,
  `care_of` varchar(255) DEFAULT NULL,
  `present_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `black_list_status` tinyint(4) NOT NULL DEFAULT 0,
  `tax_end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `owner_details`
--

INSERT INTO `owner_details` (`id`, `owner_name`, `rc_details_id`, `care_of`, `present_address`, `permanent_address`, `black_list_status`, `tax_end_date`, `created_at`, `updated_at`) VALUES
(27, 'Kishor Kumar', 36, 'Pramod Kumar', 'lucknow', 'lucknow', 1, '2024-08-05', '2024-08-13 04:18:44', '2024-08-13 04:18:44'),
(28, 'Kishor Kumar', 38, 'Pramod Kumar', 'lucknow', 'lucknow', 1, '2024-08-05', '2024-08-13 04:19:58', '2024-08-13 04:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rc_details`
--

CREATE TABLE `rc_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_code` varchar(100) DEFAULT NULL,
  `district_code` int(100) DEFAULT NULL,
  `serial_code` varchar(100) DEFAULT NULL,
  `unique_code` int(150) NOT NULL,
  `rc_issue_date` date DEFAULT NULL,
  `vehicle_image` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `rc_status` varchar(255) DEFAULT NULL,
  `emission_norms_type` varchar(255) DEFAULT NULL,
  `serial` varchar(255) DEFAULT NULL,
  `rc_category` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rc_details`
--

INSERT INTO `rc_details` (`id`, `state_code`, `district_code`, `serial_code`, `unique_code`, `rc_issue_date`, `vehicle_image`, `expiry_date`, `rc_status`, `emission_norms_type`, `serial`, `rc_category`, `created_at`, `updated_at`, `deleted_at`) VALUES
(36, 'up', 32, 'ks', 4591, '2024-08-05', 'uploads/image.png', '2024-08-05', '1', 'data', '1', 'data', '2024-08-13 04:18:44', '2024-08-13 04:18:44', NULL),
(38, 'up', 32, 'ks', 4592, '2024-08-05', 'uploads/image.png', '2024-08-05', '1', 'data', '1', 'data', '2024-08-13 04:19:58', '2024-08-13 04:19:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2024-08-02 05:20:34', '2024-08-02 05:20:34'),
(2, 'Security Staff', '2024-08-02 05:22:16', '2024-08-02 05:22:16');

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('AxS1pus7KlZM9BjEDuMruTxVyg8BWxh4Y2mAtIpC', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiN2FJRVZLTHdiTGgyMDh1ZEE4SUJ2M25yTjd6N3VEa29saTZIUXNJcSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdmVoaWNsZS9pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEyO30=', 1723141392),
('ffYB1sYTZmWQbgPArgWvVMYTfcUxJbZIbvYRLjFs', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaGtiUHhOSWZseWY5Z2c5b3ozT0dEdGJPbllzUmt2SGZIVHl0VEhWViI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvc3RhZmYvaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMjt9', 1723526262),
('mKgs6fIbFc4PKa1dXZ1GpV1S09cLJnHd2GAQfpNt', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUVVvQmtFak9VRFlERWtVUmltQlpqblFzcGFKRWR3blhWcEE1c3NQSCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvc3RhZmYvaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMjt9', 1723176777),
('nr9N7nBUki4GOyXUS2qa0QUPdaDzuD2YlhrSUxIv', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibFRCdE5vOWl6MlpJUEVsdjBsY0FsQ2RjMUdEUm1tcDBUQzY2a3J0ZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMzt9', 1723031620),
('nRq4JaJa98oa5h4gZyiCDui1FjHztP7wdj5imVPn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmRKTm55Q294YWpPdHZmVE5nWkQ1em1lVlViVDNqUzR3NVhUR3RjMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdGFmZi9pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1723193748),
('pkjJAJWAvtgXRb6JU2dhgJwBOiC575CsS04s2FOJ', NULL, '127.0.0.1', 'PostmanRuntime/7.41.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRjZMYzIxYklyTUIxWUJETmI3cUlzOUlobW1lOHJzcWVoRmJIYnV5WSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1723111561),
('Sh9M6nIKpCoOcQLaiKkb7K6xW2nsN4udXlha2sdX', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRU9rb2YxUGZocmkxUW1RYWZOcUM5RzJVR2k2c2NEOVBaWXdOQTZ1NiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1723117674),
('zz86uvHPVQsXuCSRddQN7h7MHRvFjD1skXTN557f', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHl5UWhwN3A5elpZZDF2YUJSRDI3UDUwTjZPNUZ2cVlyTW1NMm1sUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdGFmZi9pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1723011738);

-- --------------------------------------------------------

--
-- Table structure for table `staff_attendances`
--

CREATE TABLE `staff_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `gate_id` int(11) DEFAULT NULL,
  `punchin` timestamp NULL DEFAULT NULL,
  `punchout` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '''0:inactive'',''1:active''',
  `gender` enum('male','female','other') DEFAULT 'male',
  `phone` bigint(20) UNSIGNED DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `api_token` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `role_id`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `status`, `gender`, `phone`, `city`, `state`, `pincode`, `address`, `api_token`) VALUES
(1, 'Dixit', 'pd@dixit.com', NULL, NULL, NULL, '$2y$10$bN/W3p8hU665ylFDNSBypOT.Mi0MctN/scg4MI9NQj80VrA/sZuvy', NULL, NULL, NULL, NULL, '2021-03-19 06:10:03', '2021-03-19 06:10:03', 0, NULL, 9865321245, 'lucknow', 'uttar pradesh', 226010, 'uttar pradesh', NULL),
(2, '1', '1@2', NULL, NULL, NULL, '$2y$10$Hr8WOAbA22Kj/X7icjiPLuoX5HOY08V6AC5cO5f53fRqrpVsYaaO6', NULL, NULL, NULL, NULL, '2021-03-23 05:06:37', '2021-03-23 05:06:37', 0, NULL, 9865321245, 'kanpur', 'uttar pradesh', 226010, 'uttar pradesh', NULL),
(4, 'Akarsh Kumar', 'akarsh@gmail.com', 'user-profile.jpg', 2, NULL, '$2y$10$BREwGA8sANKhNtpnp/xPH.UFm1pPjxZILLI/Keo6mmO1dDXryucpW', NULL, NULL, NULL, NULL, '2024-08-02 01:25:55', '2024-08-05 22:32:59', 0, NULL, 9865324512, 'lucknow', 'uttar pradesh', 226010, 'uttar pradesh', '9cIXKMLjaXTcRqR7NU2uItvGUrSbAJZ8BxyC5tHYAFTbt4JwDVTpDWLwXABp'),
(13, 'Ashish Yadav', 'ashish@gmail.com', 'user-profile.jpg', 2, NULL, '$2y$10$BREwGA8sANKhNtpnp/xPH.UFm1pPjxZILLI/Keo6mmO1dDXryucpW', NULL, NULL, NULL, NULL, NULL, '2024-08-08 23:56:03', 1, NULL, 9369865451, 'Lucknow', 'Kerala', 226010, 'pallasio, lucknow', 'PDr77aEaYLVmZYRqyesD40t2k8giPsIWM15Y9kUfgFae5HP7EYDPHXxSKL7C'),
(6, 'Dan Brown', 'dan@gmail.com', 'user-profile.jpg', 2, NULL, '$2y$10$wzI26o4veHOwMW1JrOJn3uaoJiSzTvv/pfg7GHKp6SNLkbKCu2MRC', NULL, NULL, NULL, NULL, NULL, '2024-08-05 22:44:36', 1, NULL, 8965326598, 'kanpur', NULL, 226010, 'kanpur', NULL),
(7, 'Alok Singh Rana', 'alok@gmail.com', 'user-profile.jpg', 2, NULL, '$2y$10$jb1CyjJMJz2cc2Gt8iRngu.1yTFjTeZay2omoADTfYODtkaEQCiyO', NULL, NULL, NULL, NULL, NULL, '2024-08-05 22:41:15', 1, NULL, 8965325618, 'lucknow', 'Arunachal Pradesh', 226060, 'lucknow', NULL),
(8, 'Anmol Singh', 'anmol@gmail.com', 'user-profile.jpg', 2, NULL, '$2y$10$v/wrtFxDqETXCku.EF29qOE5RI4E3PVqkFYaSCo1RU5EULtQCgOr2', NULL, NULL, NULL, NULL, NULL, '2024-08-05 22:41:22', 1, NULL, 9865324512, 'lucknow', 'Kerala', 226010, 'lucknow', NULL),
(12, 'Omshiva Rana', 'omshivarana@gmail.com', 'user-profile.jpg', 2, NULL, '$2y$10$XUWcuRgJAqsxNFAL24Nys.oDRqOXfNLCTIor7GVPTGXkrKYdTvPuC', NULL, NULL, NULL, NULL, '2024-08-02 05:51:38', '2024-08-13 03:53:01', 1, NULL, 9369349744, 'lucknow', 'up', 226010, 'lucknow', 'oexU7yslRzGeGgY4coYpjSaozgrrkjNAVMZaZ3ZxrvYw9TeeVPgh7mdeY6EO'),
(10, 'Kamal Jain', 'kamal@gmail.com', 'user-profile.jpg', 2, NULL, '$2y$10$y5k8mfwXG3ilMlb.W9Rp8eOPX7kEZseKRFpcOJwBmpHiotRMTp1CG', NULL, NULL, NULL, NULL, NULL, '2024-08-05 22:44:43', 1, NULL, 9865326589, 'banaras', 'Jharkhand', 226010, 'banaras', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_tracking`
--

CREATE TABLE `vehicle_tracking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED DEFAULT NULL,
  `driver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `factory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `gate_number` int(11) DEFAULT NULL,
  `in_time` timestamp NULL DEFAULT NULL,
  `out_time` timestamp NULL DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `connection_requests`
--
ALTER TABLE `connection_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_kyc_details`
--
ALTER TABLE `driver_kyc_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aadhar_number` (`document_number`),
  ADD UNIQUE KEY `driver_id` (`driver_id`);

--
-- Indexes for table `driving_license_details`
--
ALTER TABLE `driving_license_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `license_number` (`license_number`);

--
-- Indexes for table `factories`
--
ALTER TABLE `factories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `factory_gates`
--
ALTER TABLE `factory_gates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factory_gates_factory_id_foreign` (`factory_id`);

--
-- Indexes for table `factory_gate_logs`
--
ALTER TABLE `factory_gate_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factory_gate_logs_gate_id_foreign` (`gate_id`),
  ADD KEY `factory_gate_logs_vehicle_id_foreign` (`vehicle_id`),
  ADD KEY `factory_gate_logs_driver_id_foreign` (`driver_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `financing_details`
--
ALTER TABLE `financing_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `financing_details_rc_details_id_foreign` (`rc_details_id`);

--
-- Indexes for table `kyc_rc_insurance_details`
--
ALTER TABLE `kyc_rc_insurance_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kyc_rc_insurance_details_rc_details_id_foreign` (`rc_details_id`);

--
-- Indexes for table `kyc_rc_national_permits`
--
ALTER TABLE `kyc_rc_national_permits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kyc_rc_national_permits_kyc_rc_permit_id_foreign` (`kyc_rc_permit_id`);

--
-- Indexes for table `kyc_rc_permits`
--
ALTER TABLE `kyc_rc_permits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kyc_rc_permits_rc_details_id_foreign` (`rc_details_id`);

--
-- Indexes for table `kyc_rc_vehicle_details`
--
ALTER TABLE `kyc_rc_vehicle_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kyc_rc_vehicle_details_rc_details_id_foreign` (`rc_details_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owner_details`
--
ALTER TABLE `owner_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_details_rc_details_id_foreign` (`rc_details_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rc_details`
--
ALTER TABLE `rc_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_code` (`unique_code`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `staff_attendances`
--
ALTER TABLE `staff_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `vehicle_tracking`
--
ALTER TABLE `vehicle_tracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_tracking_vehicle_id_foreign` (`vehicle_id`),
  ADD KEY `vehicle_tracking_driver_id_foreign` (`driver_id`),
  ADD KEY `vehicle_tracking_factory_id_foreign` (`factory_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `connection_requests`
--
ALTER TABLE `connection_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `driver_kyc_details`
--
ALTER TABLE `driver_kyc_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `driving_license_details`
--
ALTER TABLE `driving_license_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `factories`
--
ALTER TABLE `factories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `factory_gates`
--
ALTER TABLE `factory_gates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `factory_gate_logs`
--
ALTER TABLE `factory_gate_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financing_details`
--
ALTER TABLE `financing_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `kyc_rc_insurance_details`
--
ALTER TABLE `kyc_rc_insurance_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kyc_rc_national_permits`
--
ALTER TABLE `kyc_rc_national_permits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kyc_rc_permits`
--
ALTER TABLE `kyc_rc_permits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `kyc_rc_vehicle_details`
--
ALTER TABLE `kyc_rc_vehicle_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `owner_details`
--
ALTER TABLE `owner_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rc_details`
--
ALTER TABLE `rc_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff_attendances`
--
ALTER TABLE `staff_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vehicle_tracking`
--
ALTER TABLE `vehicle_tracking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `factory_gates`
--
ALTER TABLE `factory_gates`
  ADD CONSTRAINT `factory_gates_factory_id_foreign` FOREIGN KEY (`factory_id`) REFERENCES `factories` (`id`);

--
-- Constraints for table `factory_gate_logs`
--
ALTER TABLE `factory_gate_logs`
  ADD CONSTRAINT `factory_gate_logs_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `driving_license_details` (`id`),
  ADD CONSTRAINT `factory_gate_logs_gate_id_foreign` FOREIGN KEY (`gate_id`) REFERENCES `factory_gates` (`id`),
  ADD CONSTRAINT `factory_gate_logs_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `rc_details` (`id`);

--
-- Constraints for table `financing_details`
--
ALTER TABLE `financing_details`
  ADD CONSTRAINT `financing_details_rc_details_id_foreign` FOREIGN KEY (`rc_details_id`) REFERENCES `rc_details` (`id`);

--
-- Constraints for table `kyc_rc_insurance_details`
--
ALTER TABLE `kyc_rc_insurance_details`
  ADD CONSTRAINT `kyc_rc_insurance_details_rc_details_id_foreign` FOREIGN KEY (`rc_details_id`) REFERENCES `rc_details` (`id`);

--
-- Constraints for table `kyc_rc_national_permits`
--
ALTER TABLE `kyc_rc_national_permits`
  ADD CONSTRAINT `kyc_rc_national_permits_kyc_rc_permit_id_foreign` FOREIGN KEY (`kyc_rc_permit_id`) REFERENCES `kyc_rc_permits` (`id`);

--
-- Constraints for table `kyc_rc_permits`
--
ALTER TABLE `kyc_rc_permits`
  ADD CONSTRAINT `kyc_rc_permits_rc_details_id_foreign` FOREIGN KEY (`rc_details_id`) REFERENCES `rc_details` (`id`);

--
-- Constraints for table `kyc_rc_vehicle_details`
--
ALTER TABLE `kyc_rc_vehicle_details`
  ADD CONSTRAINT `kyc_rc_vehicle_details_rc_details_id_foreign` FOREIGN KEY (`rc_details_id`) REFERENCES `rc_details` (`id`);

--
-- Constraints for table `owner_details`
--
ALTER TABLE `owner_details`
  ADD CONSTRAINT `owner_details_rc_details_id_foreign` FOREIGN KEY (`rc_details_id`) REFERENCES `rc_details` (`id`);

--
-- Constraints for table `vehicle_tracking`
--
ALTER TABLE `vehicle_tracking`
  ADD CONSTRAINT `vehicle_tracking_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `driving_license_details` (`id`),
  ADD CONSTRAINT `vehicle_tracking_factory_id_foreign` FOREIGN KEY (`factory_id`) REFERENCES `factories` (`id`),
  ADD CONSTRAINT `vehicle_tracking_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `rc_details` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
