-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2022 at 09:54 AM
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
-- Database: `finance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ifsc_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_balance` decimal(18,2) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `name`, `ifsc_code`, `account_no`, `other_detail`, `opening_balance`, `status`, `created_at`, `updated_at`) VALUES
(1, 'State Bank Of India', 'SBIN0010973', '39238765008', 'no', '254000.00', 1, '2022-06-29 07:15:28', '2022-07-04 07:52:52'),
(2, 'Cash', '00000000000', '0000000000000', 'no', '1000000.00', 1, '2022-07-04 05:27:14', '2022-07-04 05:27:14');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `batch_mode_id` int(10) UNSIGNED NOT NULL,
  `trainer_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `batch_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_type_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `course_id`, `batch_mode_id`, `trainer_id`, `name`, `start`, `status`, `batch_status`, `batch_type_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 'Linux', '07-2022', 1, 'close', 2, '2022-06-28 00:05:55', '2022-07-16 00:37:32'),
(2, 2, 1, 2, 'Test', '07-2022', 1, 'open', 1, '2022-06-30 02:23:19', '2022-06-30 02:29:55'),
(3, 1, 1, 1, 'AWS', '08-2022', 1, 'open', 1, '2022-07-16 00:38:17', '2022-07-16 00:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `batch_modes`
--

CREATE TABLE `batch_modes` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batch_modes`
--

INSERT INTO `batch_modes` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Online', 1, '2022-06-27 05:13:12', '2022-06-27 05:13:12'),
(2, 'Offline', 1, '2022-06-27 05:13:27', '2022-06-27 05:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `batch_types`
--

CREATE TABLE `batch_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batch_types`
--

INSERT INTO `batch_types` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Retail', 1, '2022-06-27 05:04:13', '2022-06-27 05:04:13'),
(2, 'Corporate', 1, '2022-06-27 05:04:25', '2022-06-27 05:04:25');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Branch 1', 1, '2022-06-30 04:06:04', '2022-06-30 04:06:04'),
(2, 'Branch 2', 1, '2022-06-30 04:06:44', '2022-06-30 04:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `corporates`
--

CREATE TABLE `corporates` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web_site` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `batch_id` int(10) UNSIGNED NOT NULL,
  `trainer_amount` decimal(8,2) NOT NULL,
  `agreed_amount` decimal(8,2) NOT NULL,
  `gst_amount` decimal(8,2) DEFAULT NULL,
  `reg_for_month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enquiry_type_id` int(10) UNSIGNED NOT NULL,
  `lead_source_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `corporates`
--

INSERT INTO `corporates` (`id`, `company_name`, `contact_no`, `email`, `web_site`, `address`, `state`, `city`, `status`, `branch_id`, `trainer_id`, `batch_id`, `trainer_amount`, `agreed_amount`, `gst_amount`, `reg_for_month`, `remark`, `enquiry_type_id`, `lead_source_id`, `created_at`, `updated_at`) VALUES
(1, 'AVC', '9685748596', 'avc@gmail.com', 'www.avc.com', 'deesa', 'Gujarat', 'Deesa', 1, 1, 0, 1, '2000.00', '20000.00', '1200.00', '3month', 'labour summary', 1, 1, '2022-06-30 07:08:30', '2022-06-30 07:08:30'),
(2, 'GreatIdeas', '9685874214', 'gi@gmail.com', 'www.greatideas.com', 'asdsa', 'Gujarat', 'deesa', 1, 1, 0, 2, '10000.00', '20000.00', NULL, '1month', NULL, 1, 1, '2022-07-08 00:07:29', '2022-07-08 00:07:29'),
(3, 'Honda', '9685635252', 'honda@gmail.com', 'www.honda.com', 'palanpur', 'Gujarat', 'palanpur', 1, 1, 0, 2, '10000.00', '30000.00', NULL, '4month', NULL, 1, 1, '2022-07-08 00:49:04', '2022-07-08 00:49:04'),
(4, 'XYZ', '8596759563', 'xyz@gmail.com', 'www.xyz.com', 'palanpur', 'Gujarat', 'palanpur', 1, 1, 0, 2, '10000.00', '30000.00', NULL, '5month', NULL, 1, 2, '2022-07-08 00:56:38', '2022-07-08 00:56:38');

-- --------------------------------------------------------

--
-- Table structure for table `corporate_fees_collections`
--

CREATE TABLE `corporate_fees_collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `corporate_id` int(10) UNSIGNED NOT NULL,
  `batch_id` int(10) UNSIGNED NOT NULL,
  `gst` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `income_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `branch_id`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Cloud Computing', 1, 'this course available for free', 1, NULL, 5, '2022-06-27 07:43:21', '2022-07-16 00:36:59'),
(2, 'MCA', 2, 'Master Of computer  science', 1, NULL, 5, '2022-06-30 02:29:43', '2022-06-30 04:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_types`
--

CREATE TABLE `enquiry_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiry_types`
--

INSERT INTO `enquiry_types` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'General', 1, '2022-06-27 04:42:32', '2022-06-27 04:42:32'),
(2, 'Other', 1, '2022-06-27 04:42:48', '2022-06-27 04:42:48');

-- --------------------------------------------------------

--
-- Table structure for table `expence_masters`
--

CREATE TABLE `expence_masters` (
  `id` int(10) UNSIGNED NOT NULL,
  `expence_type_id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `bank_ac_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `date` date NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expence_masters`
--

INSERT INTO `expence_masters` (`id`, `expence_type_id`, `branch_id`, `bank_ac_id`, `amount`, `date`, `remark`, `created_at`, `updated_at`) VALUES
(3, 2, 2, 1, '2000.00', '2022-07-05', 'labour summary', '2022-07-03 23:54:44', '2022-07-03 23:54:44');

-- --------------------------------------------------------

--
-- Table structure for table `expense_types`
--

CREATE TABLE `expense_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_types`
--

INSERT INTO `expense_types` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Salary', '1', '2022-06-27 04:43:21', '2022-06-27 04:43:21'),
(2, 'Bills', '1', '2022-06-27 04:43:38', '2022-06-27 04:43:38'),
(3, 'Trainer fees', '1', '2022-06-27 04:43:49', '2022-06-27 04:43:49'),
(4, 'Marketing', '1', '2022-06-27 04:44:03', '2022-06-27 04:44:03'),
(5, 'Office Rent', '1', '2022-06-27 04:44:14', '2022-06-27 04:44:14'),
(6, 'Staff welfare', '1', '2022-06-27 04:44:26', '2022-06-27 04:44:26'),
(7, 'Repair & Office Maintainance', '1', '2022-06-27 04:44:38', '2022-06-27 04:44:38'),
(8, 'Incentives', '1', '2022-06-27 04:44:49', '2022-06-27 04:44:49'),
(9, 'Director expenses', '1', '2022-06-27 04:45:01', '2022-06-27 04:45:01'),
(10, 'Accounting charges', '1', '2022-06-27 04:45:11', '2022-06-27 04:45:11'),
(11, 'Website & Training Maintainance Cost', '1', '2022-06-27 04:45:23', '2022-06-27 04:45:23'),
(12, 'New purchases', '1', '2022-06-27 04:45:33', '2022-06-27 04:45:33'),
(13, 'New project cost', '1', '2022-06-27 04:45:46', '2022-06-27 04:45:46'),
(14, 'TDS', '1', '2022-06-27 04:45:59', '2022-06-27 04:45:59'),
(15, 'GST', '1', '2022-06-27 04:46:11', '2022-06-27 04:46:11'),
(16, 'Credit Card bill', '1', '2022-06-27 04:46:22', '2022-06-27 04:46:22'),
(17, 'Hiring Cost', '1', '2022-06-27 04:46:31', '2022-06-27 04:46:31'),
(18, 'Student Refund', '1', '2022-06-27 04:46:44', '2022-06-27 04:46:44'),
(19, 'Other Expenses', '1', '2022-06-27 04:46:56', '2022-06-27 04:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `franchises`
--

CREATE TABLE `franchises` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `franchises`
--

INSERT INTO `franchises` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Apponix', 1, '2022-06-27 04:57:11', '2022-06-27 04:57:11'),
(2, 'Webtech-Evolution', 1, '2022-06-27 04:57:29', '2022-06-27 04:57:29');

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` int(10) UNSIGNED NOT NULL,
  `income_type_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `bank_acc_id` int(11) NOT NULL,
  `trainer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paying_amount` decimal(8,2) NOT NULL,
  `register_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_taken_by` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `franchises_id` int(10) UNSIGNED DEFAULT NULL,
  `gst` decimal(18,2) DEFAULT NULL,
  `description` int(11) DEFAULT NULL,
  `mode_of_payment` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `income_type_id`, `course_id`, `branch_id`, `bank_acc_id`, `trainer_name`, `paying_amount`, `register_date`, `registration_taken_by`, `comment`, `status`, `created_at`, `updated_at`, `franchises_id`, `gst`, `description`, `mode_of_payment`) VALUES
(98, 1, 1, 1, 3, NULL, '8474.58', '2022-07-16 12:21:19', 5, NULL, 1, '2022-07-16 06:51:19', '2022-07-16 06:51:19', NULL, NULL, NULL, NULL),
(99, 1, 2, 1, 4, NULL, '4237.29', '2022-07-16 12:21:19', 5, NULL, 1, '2022-07-16 06:51:19', '2022-07-16 06:51:19', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `income_types`
--

CREATE TABLE `income_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `income_types`
--

INSERT INTO `income_types` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Retail Training', 1, '2022-06-27 04:50:21', '2022-06-27 04:50:21'),
(2, 'Corporate Training', 1, '2022-06-27 04:50:33', '2022-06-27 04:50:33'),
(3, 'Franchise Royalty', 1, '2022-06-27 04:50:50', '2022-06-27 04:50:50'),
(4, 'HR Consultancy', 1, '2022-06-27 04:51:07', '2022-06-27 04:51:07'),
(5, 'Digital Marketing', 1, '2022-06-27 04:51:19', '2022-06-27 04:51:19'),
(6, 'Others', 1, '2022-06-27 04:51:34', '2022-06-27 04:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `lead_sources`
--

CREATE TABLE `lead_sources` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lead_sources`
--

INSERT INTO `lead_sources` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Email Marketing', 1, '2022-06-27 04:17:34', '2022-06-27 04:17:34'),
(2, 'Cold Calling', 1, '2022-06-27 04:18:09', '2022-06-27 04:18:09');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_06_24_073319_add_col_to_users_table', 2),
(5, '2022_06_24_111226_create_permission_tables', 3),
(6, '2022_06_27_094601_create_lead_sources_table', 4),
(8, '2022_06_27_095316_create_expense_types_table', 6),
(9, '2022_06_27_100619_create_enquiry_types_table', 7),
(10, '2022_06_27_101916_create_income_types_table', 8),
(11, '2022_06_27_102259_create_student_types_table', 9),
(12, '2022_06_27_102616_create_franchises_table', 10),
(13, '2022_06_27_102842_create_branches_table', 11),
(14, '2022_06_27_103028_create_mode_of_payments_table', 12),
(15, '2022_06_27_103312_create_batch_types_table', 13),
(16, '2022_06_27_103532_create_revenue_types_table', 14),
(17, '2022_06_27_104211_create_batch_modes_table', 15),
(18, '2022_06_27_113316_create_students_table', 16),
(19, '2022_06_27_130732_create_courses_table', 17),
(20, '2022_06_28_045256_create_trainers_table', 18),
(21, '2022_06_28_051722_create_batches_table', 19),
(22, '2022_06_28_080519_create_incomes_table', 20),
(23, '2022_06_29_115003_create_settings_table', 21),
(24, '2022_06_29_123343_create_bank_accounts_table', 22),
(25, '2022_06_30_050000_create_trainer_free_slabs_table', 23),
(27, '2022_06_30_054605_add_col_to_trainers_table', 25),
(28, '2022_06_30_073849_add_col_to_batches_table', 26),
(30, '2022_06_30_052534_add_col_to_courses_table', 27),
(31, '2022_06_30_090558_add_branch_id_to_courses_table', 27),
(33, '2022_06_30_115745_create_corporates_table', 28),
(34, '2022_06_30_125530_add_col_to_students_table', 29),
(35, '2022_07_01_050940_add_status_to_users_table', 30),
(36, '2022_07_01_091426_add_column_to_incomes_table', 31),
(37, '2022_07_01_103849_create_student_fees_collections_table', 32),
(38, '2022_07_02_080442_create_corporate_fees_collections_table', 33),
(39, '2022_07_02_111105_create_expence_masters_table', 34),
(40, '2022_07_04_101706_add_col_to_incomes_table', 35),
(41, '2022_07_05_064536_add_branch_id_to_users_table', 36),
(42, '2022_07_05_070207_add_mix_bank_to_mode_of_payments_table', 37),
(43, '2022_07_08_113943_create_student_detail_table', 38),
(45, '2022_07_15_050250_create_batch_trainer_detail_table', 40),
(46, '2022_07_14_053558_create_student_batch_detail_table', 41);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(6, 'App\\Models\\User', 8),
(6, 'App\\Models\\User', 9),
(6, 'App\\Models\\User', 10);

-- --------------------------------------------------------

--
-- Table structure for table `mode_of_payments`
--

CREATE TABLE `mode_of_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ifsc_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_balance` decimal(8,2) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mode_of_payments`
--

INSERT INTO `mode_of_payments` (`id`, `title`, `name`, `ifsc_code`, `account_no`, `other_detail`, `opening_balance`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Cash', 'Bank Of India', 'BOI1234', '392387650012', 'no', '110000.00', 1, '2022-07-05 01:35:49', '2022-07-16 06:51:19'),
(4, 'Cheque', 'State Bank Of India', 'SBIN0010973', '39238765008', 'no', '105000.00', 1, '2022-07-06 03:26:14', '2022-07-16 06:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'branch_view', 'web', '2022-06-27 01:00:55', '2022-06-27 01:00:55'),
(2, 'branch_create', 'web', '2022-06-27 01:12:46', '2022-06-27 01:12:46'),
(3, 'branch_edit', 'web', '2022-06-27 01:13:08', '2022-06-27 02:44:59'),
(4, 'branch_delete', 'web', '2022-06-27 01:13:28', '2022-06-27 01:13:28');

-- --------------------------------------------------------

--
-- Table structure for table `revenue_types`
--

CREATE TABLE `revenue_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `revenue_types`
--

INSERT INTO `revenue_types` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Retail Training', 1, '2022-06-27 05:08:43', '2022-06-27 05:08:43'),
(2, 'Corporate Training', 1, '2022-06-27 05:10:17', '2022-06-27 05:10:17'),
(3, 'Franchise Royalty', 1, '2022-06-27 05:10:28', '2022-06-27 05:10:28'),
(4, 'HR Consultancy', 1, '2022-06-27 05:10:41', '2022-06-27 05:10:41'),
(5, 'Digital Marketing', 1, '2022-06-27 05:10:55', '2022-06-27 05:10:55'),
(6, 'Others', 1, '2022-06-27 05:11:10', '2022-06-27 05:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'web', '2022-06-26 06:59:11', '2022-06-26 06:59:11'),
(2, 'admin', 'web', '2022-06-27 00:54:04', '2022-06-27 02:44:00'),
(3, 'branch_manager', 'web', '2022-06-27 00:55:04', '2022-06-27 00:55:04'),
(4, 'counsellor', 'web', '2022-06-27 00:55:32', '2022-06-27 00:55:32'),
(5, 'internal_auditor', 'web', '2022-06-27 00:56:25', '2022-06-27 00:56:25'),
(6, 'student_co-ordinator', 'web', '2022-06-27 00:57:06', '2022-06-27 00:57:06');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(2, 4),
(3, 1),
(4, 1),
(4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gst_per` decimal(8,2) NOT NULL,
  `tds_per` decimal(8,2) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gst_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `app_logo`, `app_title`, `gst_per`, `tds_per`, `email`, `website`, `phone_1`, `phone_2`, `gst_no`) VALUES
(1, 'IzitlqTaBYOkOrAKuqTR8tm5dmKzTV5CEeiQYpgt.png', 'APPONIX', '18.00', '10.00', 'apponix', 'http://uk.aellontech.com/', '9685874214', '9664882740', '5645526363524512');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enquiry_type` int(10) UNSIGNED NOT NULL,
  `student_type` int(10) UNSIGNED NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `mobile_no`, `enquiry_type`, `student_type`, `state`, `status`, `remark`, `created_at`, `updated_at`) VALUES
(44, 'paresh khorwal', 'paresh', '9687807505', 1, 1, 'Madhya Pradesh', 1, NULL, '2022-07-16 06:51:19', '2022-07-16 06:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `student_batch_detail`
--

CREATE TABLE `student_batch_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_detail_id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` int(10) UNSIGNED NOT NULL,
  `trainer_id` int(10) UNSIGNED NOT NULL,
  `trainer_fees` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_batch_detail`
--

INSERT INTO `student_batch_detail` (`id`, `student_detail_id`, `batch_id`, `trainer_id`, `trainer_fees`, `created_at`, `updated_at`) VALUES
(1, 33, 1, 2, '3000.00', '2022-07-16 06:51:19', '2022-07-16 06:51:19'),
(2, 33, 3, 1, '2000.00', '2022-07-16 06:51:19', '2022-07-16 06:51:19'),
(3, 34, 2, 2, '3000.00', '2022-07-16 06:51:19', '2022-07-16 06:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `student_detail`
--

CREATE TABLE `student_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `lead_source_id` int(10) UNSIGNED DEFAULT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `reg_taken_id` int(10) UNSIGNED NOT NULL,
  `agreed_amount` decimal(8,2) NOT NULL,
  `placement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reg_for_month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_detail`
--

INSERT INTO `student_detail` (`id`, `student_id`, `course_id`, `lead_source_id`, `branch_id`, `reg_taken_id`, `agreed_amount`, `placement`, `reg_for_month`, `created_at`, `updated_at`) VALUES
(33, 44, 1, NULL, 1, 5, '20000.00', 'yes', NULL, '2022-07-16 06:51:19', '2022-07-16 06:51:19'),
(34, 44, 2, NULL, 1, 5, '10000.00', 'yes', NULL, '2022-07-16 06:51:19', '2022-07-16 06:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `student_fees_collections`
--

CREATE TABLE `student_fees_collections` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `income_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) DEFAULT NULL,
  `gst` decimal(18,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_fees_collections`
--

INSERT INTO `student_fees_collections` (`id`, `student_id`, `income_id`, `course_id`, `gst`, `created_at`, `updated_at`) VALUES
(50, 44, 98, 1, '1525.42', '2022-07-16 06:51:19', '2022-07-16 06:51:19'),
(51, 44, 99, 2, '762.71', '2022-07-16 06:51:19', '2022-07-16 06:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `student_types`
--

CREATE TABLE `student_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_types`
--

INSERT INTO `student_types` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Fresher', 1, '2022-06-27 04:54:05', '2022-06-27 04:54:32'),
(2, 'Professional', 1, '2022-06-27 04:54:46', '2022-06-27 04:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` int(10) UNSIGNED NOT NULL,
  `trainer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `trainer_name`, `email`, `status`, `profile_pic`, `contact_no`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Harish', 'harish@gmail.com', 1, 'Mp1jTjWFDR5O4Pquptmvs2AL6WGz8xZfzAF7Hvjz.jpg', '9685874214', 2, NULL, 5, '2022-06-27 23:24:38', '2022-07-05 03:45:28'),
(2, 'Naresh', 'naresh@gmail.com', 1, 'D6ghPjtD9gR74Oy3qj6Mvfd1CPkE9mokm92Dy4Vg.png', '9664882740', 1, NULL, 5, '2022-06-27 23:31:34', '2022-06-30 01:59:05'),
(3, 'Rakesh', 'rakesh@gmail.com', 1, 'g2RUvQsHhKpgk6jU6A4nh1eipyWdumRtEhieMdfD.jpg', '9685745263', 1, NULL, 5, '2022-06-27 23:34:02', '2022-06-30 01:58:46'),
(4, 'Uday', 'uday@gmail.com', 1, '0XpsCK67xt8S1eNM3427hr3ATaeUcgtmL579NPUQ.jpg', '6352418596', 2, NULL, 5, '2022-06-30 01:49:08', '2022-07-05 03:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `trainer_free_slabs`
--

CREATE TABLE `trainer_free_slabs` (
  `id` int(10) UNSIGNED NOT NULL,
  `trainer_id` int(10) UNSIGNED NOT NULL,
  `min_std` int(11) NOT NULL,
  `max_std` int(11) NOT NULL,
  `fees` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainer_free_slabs`
--

INSERT INTO `trainer_free_slabs` (`id`, `trainer_id`, `min_std`, `max_std`, `fees`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 5, '5000.00', '2022-06-29 23:39:02', '2022-07-04 01:59:16'),
(2, 3, 0, 5, '4000.00', '2022-07-04 01:59:09', '2022-07-04 01:59:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `branch_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile_no`, `status`, `role_id`, `branch_id`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'Super Admin', 'supAdmin@gmail.com', '9685744525', 1, 0, NULL, NULL, NULL, '$2y$10$T3k5mSZX5HrUuvTdQPy.TeqUYMtSq2ecH4DpYs6EQI8NtPONo7nVi', NULL, '2022-06-27 01:50:56', '2022-06-27 03:50:49'),
(6, 'john', 'john@gmail.com', '9685748596', 1, 3, '[\"2\"]', NULL, NULL, '$2y$10$uF4Ich8x600j8luygnGS.ecWObdQgko8.wnAaiVDLOMrmosOsg/vW', NULL, '2022-07-01 00:56:29', '2022-07-05 03:56:56'),
(8, 'Sanjay', 'sanjay@gmail.com', '9658574855', 1, 6, '[\"1\"]', NULL, NULL, '$2y$10$GJfE1Sn2zb.07PK2jr7Yeeevmt8FnkSQyDrLpyw3f0zpxdWE5Fol2', NULL, '2022-07-01 02:00:46', '2022-07-05 03:57:02'),
(9, 'Parth', 'parth@gmail.com', '9685748596', 1, 6, '[\"2\"]', NULL, NULL, '$2y$10$rJAlsK8innxlm.ecW0RgqeraHRNjcIoIWgq.uNmcg2hwZ2eVZhBz.', NULL, '2022-07-01 02:01:29', '2022-07-05 03:57:10'),
(10, 'naresh', 'naresh2@gmail.com', '04152637896', 1, 6, '[\"1\",\"2\"]', NULL, NULL, '$2y$10$jU97f2Dfj4IMSuEDWBDXleDYuHD4zac6nJ55OS4iLGBAd222Z76c.', NULL, '2022-07-05 01:20:19', '2022-07-05 01:20:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batches_course_id_foreign` (`course_id`),
  ADD KEY `batches_batch_mode_id_foreign` (`batch_mode_id`),
  ADD KEY `batches_trainer_id_foreign` (`trainer_id`);

--
-- Indexes for table `batch_modes`
--
ALTER TABLE `batch_modes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch_types`
--
ALTER TABLE `batch_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corporates`
--
ALTER TABLE `corporates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `corporates_branch_id_foreign` (`branch_id`),
  ADD KEY `corporates_batch_id_foreign` (`batch_id`),
  ADD KEY `corporates_enquiry_type_id_foreign` (`enquiry_type_id`),
  ADD KEY `corporates_lead_source_id_foreign` (`lead_source_id`);

--
-- Indexes for table `corporate_fees_collections`
--
ALTER TABLE `corporate_fees_collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `corporate_fees_collections_corporate_id_foreign` (`corporate_id`),
  ADD KEY `corporate_fees_collections_batch_id_foreign` (`batch_id`),
  ADD KEY `corporate_fees_collections_income_id_foreign` (`income_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry_types`
--
ALTER TABLE `enquiry_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expence_masters`
--
ALTER TABLE `expence_masters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expence_masters_expence_type_id_foreign` (`expence_type_id`),
  ADD KEY `expence_masters_branch_id_foreign` (`branch_id`),
  ADD KEY `expence_masters_bank_ac_id_foreign` (`bank_ac_id`);

--
-- Indexes for table `expense_types`
--
ALTER TABLE `expense_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `franchises`
--
ALTER TABLE `franchises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incomes_income_type_id_foreign` (`income_type_id`),
  ADD KEY `incomes_course_id_foreign` (`course_id`),
  ADD KEY `incomes_franchises_id_foreign` (`franchises_id`);

--
-- Indexes for table `income_types`
--
ALTER TABLE `income_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_sources`
--
ALTER TABLE `lead_sources`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `mode_of_payments`
--
ALTER TABLE `mode_of_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `revenue_types`
--
ALTER TABLE `revenue_types`
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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_enquiry_type_foreign` (`enquiry_type`),
  ADD KEY `students_student_type_foreign` (`student_type`);

--
-- Indexes for table `student_batch_detail`
--
ALTER TABLE `student_batch_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_batch_detail_student_detail_id_foreign` (`student_detail_id`),
  ADD KEY `student_batch_detail_batch_id_foreign` (`batch_id`),
  ADD KEY `student_batch_detail_trainer_id_foreign` (`trainer_id`);

--
-- Indexes for table `student_detail`
--
ALTER TABLE `student_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_detail_student_id_foreign` (`student_id`),
  ADD KEY `student_detail_course_id_foreign` (`course_id`),
  ADD KEY `student_detail_lead_source_id_foreign` (`lead_source_id`),
  ADD KEY `student_detail_branch_id_foreign` (`branch_id`),
  ADD KEY `student_detail_reg_taken_id_foreign` (`reg_taken_id`);

--
-- Indexes for table `student_fees_collections`
--
ALTER TABLE `student_fees_collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_fees_collections_income_id_foreign` (`income_id`),
  ADD KEY `student_fees_collections_student_id_foreign` (`student_id`);

--
-- Indexes for table `student_types`
--
ALTER TABLE `student_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainer_free_slabs`
--
ALTER TABLE `trainer_free_slabs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainer_free_slabs_trainer_id_foreign` (`trainer_id`);

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
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `batch_modes`
--
ALTER TABLE `batch_modes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `batch_types`
--
ALTER TABLE `batch_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `corporates`
--
ALTER TABLE `corporates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `corporate_fees_collections`
--
ALTER TABLE `corporate_fees_collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enquiry_types`
--
ALTER TABLE `enquiry_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expence_masters`
--
ALTER TABLE `expence_masters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expense_types`
--
ALTER TABLE `expense_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `franchises`
--
ALTER TABLE `franchises`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `income_types`
--
ALTER TABLE `income_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lead_sources`
--
ALTER TABLE `lead_sources`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `mode_of_payments`
--
ALTER TABLE `mode_of_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `revenue_types`
--
ALTER TABLE `revenue_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `student_batch_detail`
--
ALTER TABLE `student_batch_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_detail`
--
ALTER TABLE `student_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `student_fees_collections`
--
ALTER TABLE `student_fees_collections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `student_types`
--
ALTER TABLE `student_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trainer_free_slabs`
--
ALTER TABLE `trainer_free_slabs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batches`
--
ALTER TABLE `batches`
  ADD CONSTRAINT `batches_batch_mode_id_foreign` FOREIGN KEY (`batch_mode_id`) REFERENCES `batch_modes` (`id`),
  ADD CONSTRAINT `batches_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `batches_trainer_id_foreign` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`);

--
-- Constraints for table `corporates`
--
ALTER TABLE `corporates`
  ADD CONSTRAINT `corporates_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`),
  ADD CONSTRAINT `corporates_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `corporates_enquiry_type_id_foreign` FOREIGN KEY (`enquiry_type_id`) REFERENCES `enquiry_types` (`id`),
  ADD CONSTRAINT `corporates_lead_source_id_foreign` FOREIGN KEY (`lead_source_id`) REFERENCES `lead_sources` (`id`);

--
-- Constraints for table `corporate_fees_collections`
--
ALTER TABLE `corporate_fees_collections`
  ADD CONSTRAINT `corporate_fees_collections_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `corporate_fees_collections_corporate_id_foreign` FOREIGN KEY (`corporate_id`) REFERENCES `corporates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `corporate_fees_collections_income_id_foreign` FOREIGN KEY (`income_id`) REFERENCES `incomes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expence_masters`
--
ALTER TABLE `expence_masters`
  ADD CONSTRAINT `expence_masters_bank_ac_id_foreign` FOREIGN KEY (`bank_ac_id`) REFERENCES `bank_accounts` (`id`),
  ADD CONSTRAINT `expence_masters_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `expence_masters_expence_type_id_foreign` FOREIGN KEY (`expence_type_id`) REFERENCES `expense_types` (`id`);

--
-- Constraints for table `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `incomes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `incomes_franchises_id_foreign` FOREIGN KEY (`franchises_id`) REFERENCES `franchises` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `incomes_income_type_id_foreign` FOREIGN KEY (`income_type_id`) REFERENCES `income_types` (`id`);

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_enquiry_type_foreign` FOREIGN KEY (`enquiry_type`) REFERENCES `enquiry_types` (`id`),
  ADD CONSTRAINT `students_student_type_foreign` FOREIGN KEY (`student_type`) REFERENCES `student_types` (`id`);

--
-- Constraints for table `student_batch_detail`
--
ALTER TABLE `student_batch_detail`
  ADD CONSTRAINT `student_batch_detail_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_batch_detail_student_detail_id_foreign` FOREIGN KEY (`student_detail_id`) REFERENCES `student_detail` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_batch_detail_trainer_id_foreign` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_detail`
--
ALTER TABLE `student_detail`
  ADD CONSTRAINT `student_detail_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_detail_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_detail_lead_source_id_foreign` FOREIGN KEY (`lead_source_id`) REFERENCES `lead_sources` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_detail_reg_taken_id_foreign` FOREIGN KEY (`reg_taken_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_detail_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_fees_collections`
--
ALTER TABLE `student_fees_collections`
  ADD CONSTRAINT `student_fees_collections_income_id_foreign` FOREIGN KEY (`income_id`) REFERENCES `incomes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_fees_collections_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trainer_free_slabs`
--
ALTER TABLE `trainer_free_slabs`
  ADD CONSTRAINT `trainer_free_slabs_trainer_id_foreign` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
