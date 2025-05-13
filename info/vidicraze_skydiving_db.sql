-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 09, 2025 at 08:15 PM
-- Server version: 10.6.22-MariaDB
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vidicraze_skydiving_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `image`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'skydiving@gmail.com', '$2y$10$zh4yh8oz4jTxI9Lxtn6fV.gQFDdUkKoOE9CROeA9cgnbljYc/D2VW', 'admin_images/2UfMetqSlHLuCuY3bkXPM71drBQ8XK7EQWRJHfhe.png', '2025-04-22 01:31:29', '2025-05-03 19:38:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2025_04_14_223403_create_products_table', 1),
(5, '2025_04_15_224530_create_otps_table', 1),
(6, '2025_04_16_020459_create_users_table', 1),
(7, '2025_04_21_175457_create_admins_table', 1),
(8, '2025_04_25_002945_create_user_awardeds_table', 1),
(9, '2025_04_25_205651_create_user_referrals_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('shahbazmushir@gmail.com', '$2y$10$o0TZc.9rGFFiFmkZX077uelm.hKRvrNntfLKXLxf2k2/69M2.HVc2', '2025-05-08 23:43:48'),
('shahbazvidicraze@gmail.com', '$2y$10$Y9SEm05zlQ9/aB0nBxSwZuF1kEoE4qxgiSfFcohGhWrs0jIO3LK42', '2025-05-07 18:59:54');

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'mobile', 'acacf4716db572ba4ee6774a07860196b13601860c967880e709f795455c8134', '[\"*\"]', NULL, NULL, '2025-05-02 21:22:31', '2025-05-02 21:22:31'),
(2, 'App\\Models\\User', 1, 'mobile', '6c015daf706cb05a12d50669de9978453efcf5e5bcc7ab1c84b287cde2dd78c0', '[\"*\"]', NULL, NULL, '2025-05-02 21:23:08', '2025-05-02 21:23:08'),
(3, 'App\\Models\\User', 1, 'mobile', 'f8d7793a6c05f3f20c51b67426c632241dd270c180f0d38a25135e80c9e3a2f1', '[\"*\"]', NULL, NULL, '2025-05-02 21:27:27', '2025-05-02 21:27:27'),
(4, 'App\\Models\\User', 2, 'mobile', '914432cc6313a0130b6262ec755d6663ad480853f441b2ce9b87a38fa1deb4d3', '[\"*\"]', NULL, NULL, '2025-05-02 21:33:58', '2025-05-02 21:33:58'),
(5, 'App\\Models\\User', 3, 'mobile', 'b176d0aae01cff1ff312d4690b2a2f2058652aee89ad08a7cf764596ffa759ea', '[\"*\"]', NULL, NULL, '2025-05-02 21:36:05', '2025-05-02 21:36:05'),
(6, 'App\\Models\\User', 4, 'mobile', '6cfa05be836d5ac30cb0d947a478c85586f52f0eb5dbf35ea1a80a740060a061', '[\"*\"]', NULL, NULL, '2025-05-02 21:44:19', '2025-05-02 21:44:19'),
(7, 'App\\Models\\User', 1, 'mobile', 'f3c65452d0a3c890af2a4487261fd979e517e2321b65e7e3be463493c3105be6', '[\"*\"]', NULL, NULL, '2025-05-02 22:27:56', '2025-05-02 22:27:56'),
(8, 'App\\Models\\User', 1, 'mobile', '422f16f6ecb6aedea1cc59aa3e6851735d6e20798e6e36914cf54cd61361b659', '[\"*\"]', '2025-05-02 23:31:15', NULL, '2025-05-02 22:41:17', '2025-05-02 23:31:15'),
(9, 'App\\Models\\User', 4, 'mobile', 'e600a2e18ff6fea05a055dfdfd08940847fbf84c6b2ab7061b04226e81ecc7c1', '[\"*\"]', '2025-05-03 00:39:23', NULL, '2025-05-02 23:33:45', '2025-05-03 00:39:23'),
(10, 'App\\Models\\User', 4, 'mobile', 'f214d46e97919a89504fbbfbd242d927afeb012b3665d8fb14af76d24b3a8d84', '[\"*\"]', '2025-05-03 00:44:32', NULL, '2025-05-03 00:40:05', '2025-05-03 00:44:32'),
(11, 'App\\Models\\User', 4, 'mobile', 'eddb2e8e18825af35ce5705168ba8bf521869ca8a66bcaa83d742539b85879ba', '[\"*\"]', '2025-05-03 00:53:52', NULL, '2025-05-03 00:45:30', '2025-05-03 00:53:52'),
(12, 'App\\Models\\User', 5, 'mobile', '471f07b9d8f0a5d4e553ad376cb9cdf8005ea27f2742fea636f2e11ca0cee365', '[\"*\"]', NULL, NULL, '2025-05-03 00:50:45', '2025-05-03 00:50:45'),
(13, 'App\\Models\\User', 6, 'mobile', 'a3723ebcec11f968fb8119b51665b078674c4c5f15b3768ac649a33458544228', '[\"*\"]', '2025-05-03 00:58:44', NULL, '2025-05-03 00:52:43', '2025-05-03 00:58:44'),
(14, 'App\\Models\\User', 6, 'mobile', '195452eba77c0219e8bdaf475aab19e916ccca206184eefa7fe72d242c4daa6c', '[\"*\"]', '2025-05-03 00:57:41', NULL, '2025-05-03 00:54:00', '2025-05-03 00:57:41'),
(15, 'App\\Models\\User', 4, 'mobile', '6a6200e8c596cdc40e63b81f0bbca19ec71bd56e292b5d6d261854d651df9c07', '[\"*\"]', '2025-05-03 01:07:33', NULL, '2025-05-03 00:57:53', '2025-05-03 01:07:33'),
(16, 'App\\Models\\User', 6, 'mobile', '0b537c60e1a8e97fa6ddd0609d223d04a6b146f5a085151052e4f492284a015b', '[\"*\"]', '2025-05-03 01:17:35', NULL, '2025-05-03 01:07:30', '2025-05-03 01:17:35'),
(17, 'App\\Models\\User', 4, 'mobile', 'ccb210ba36b5ec0619f9b817d55e249db0054b3e745dab4c36d915ff9fb67746', '[\"*\"]', '2025-05-03 01:14:38', NULL, '2025-05-03 01:07:37', '2025-05-03 01:14:38'),
(18, 'App\\Models\\User', 4, 'mobile', '53c29aa8e2e018b0fa068b1db3eac23a1b1dbdd04916b528a313a92e5421e313', '[\"*\"]', '2025-05-03 01:14:50', NULL, '2025-05-03 01:14:49', '2025-05-03 01:14:50'),
(19, 'App\\Models\\User', 4, 'mobile', '13ea21739ff754d91eb28e7900cbaca9671e38fc7a37fc9f9f58f3a7ebd83adf', '[\"*\"]', '2025-05-03 01:18:00', NULL, '2025-05-03 01:14:59', '2025-05-03 01:18:00'),
(20, 'App\\Models\\User', 6, 'mobile', '9db8816e5c8d7b845fc3d088c5bd72f9df15dbfca84e33af25e2e83b6958c879', '[\"*\"]', '2025-05-03 01:18:23', NULL, '2025-05-03 01:18:12', '2025-05-03 01:18:23'),
(21, 'App\\Models\\User', 4, 'mobile', 'a1cfc78d201ce00304f5f73c1ac7af67bcca4628bdd523a4d7f4c0e6495e470b', '[\"*\"]', '2025-05-03 01:21:56', NULL, '2025-05-03 01:18:26', '2025-05-03 01:21:56'),
(22, 'App\\Models\\User', 4, 'mobile', 'f31c204509e774994acf3c14793a1beccb11af33f6c615a2441865522f63ba2e', '[\"*\"]', '2025-05-03 01:23:00', NULL, '2025-05-03 01:22:06', '2025-05-03 01:23:00'),
(23, 'App\\Models\\User', 4, 'mobile', '4bf9a50b3823848512fc73b9c77dbcfd8bb4de36392e88089625efdfcc076c8c', '[\"*\"]', '2025-05-03 01:24:49', NULL, '2025-05-03 01:23:08', '2025-05-03 01:24:49'),
(24, 'App\\Models\\User', 6, 'mobile', '74c3a03f1a5873a0d296b097e83d1dee6681e7d702724b1982c6b66c0692ca00', '[\"*\"]', '2025-05-03 01:50:07', NULL, '2025-05-03 01:45:28', '2025-05-03 01:50:07'),
(25, 'App\\Models\\User', 6, 'mobile', 'af3408ef06b9ee07c928f1e9c4cb3c6f761d4b5fcdada1263ee16b69b3d9e5e2', '[\"*\"]', '2025-05-03 01:52:55', NULL, '2025-05-03 01:50:32', '2025-05-03 01:52:55'),
(26, 'App\\Models\\User', 6, 'mobile', '069ae27df9145a0de83e244ed26f9f40ff64e33ec587a341d9efdf4ddfb02326', '[\"*\"]', '2025-05-03 01:53:55', NULL, '2025-05-03 01:53:41', '2025-05-03 01:53:55'),
(27, 'App\\Models\\User', 6, 'mobile', '917bdb465ce657980b3f383fc271e5ff3258ca6753cf1e2445e811a51e708c32', '[\"*\"]', '2025-05-03 01:55:58', NULL, '2025-05-03 01:55:16', '2025-05-03 01:55:58'),
(28, 'App\\Models\\User', 7, 'mobile', 'a9263e3253613c8e054170fc767208516aa02baff74c0a390fc82ca47654df07', '[\"*\"]', '2025-05-03 02:09:26', NULL, '2025-05-03 02:08:27', '2025-05-03 02:09:26'),
(29, 'App\\Models\\User', 8, 'mobile', 'a0668f7fc733398a7db2f493db24eaed714583602756c4989e195afe82c1751b', '[\"*\"]', '2025-05-03 02:17:59', NULL, '2025-05-03 02:17:48', '2025-05-03 02:17:59'),
(30, 'App\\Models\\User', 9, 'mobile', '89b49d3b3b43296aaf9e6d8967fcce14c4e846ab7f5f81eaf471ce987f460ff8', '[\"*\"]', '2025-05-03 02:28:29', NULL, '2025-05-03 02:26:06', '2025-05-03 02:28:29'),
(31, 'App\\Models\\User', 10, 'mobile', '142f7bdda25c339c66be704c465bf9605f7db691dc5ea359d9f1aa550ff1f6e2', '[\"*\"]', '2025-05-03 02:38:00', NULL, '2025-05-03 02:34:35', '2025-05-03 02:38:00'),
(32, 'App\\Models\\User', 12, 'mobile', 'ac9b6492ab8ce9419ee47c434bff8b83745a5d5f6a795616a3c68c7f823a68bf', '[\"*\"]', NULL, NULL, '2025-05-03 02:35:32', '2025-05-03 02:35:32'),
(33, 'App\\Models\\User', 13, 'mobile', '19bb9b21ed21718239002cd7748541b56bff7cca829e83bbfab1db7a57b2b1b4', '[\"*\"]', NULL, NULL, '2025-05-03 02:37:12', '2025-05-03 02:37:12'),
(34, 'App\\Models\\User', 14, 'mobile', 'c8452b8fb501129558a6c15cf3fd58b3978476b316b5a39d88dc8fec35932b26', '[\"*\"]', NULL, NULL, '2025-05-03 02:38:01', '2025-05-03 02:38:01'),
(35, 'App\\Models\\User', 6, 'mobile', '01ffc3c6445e090c58cec5e4b8e162cf17ae778a73e186302ea6537b060c3a2b', '[\"*\"]', '2025-05-03 02:48:03', NULL, '2025-05-03 02:47:52', '2025-05-03 02:48:03'),
(36, 'App\\Models\\User', 6, 'mobile', '8cce9fdc4f32f6ef7c9479df3dbbd32824698e00c5cc1bf7934b1aad437fb8d7', '[\"*\"]', '2025-05-03 03:01:51', NULL, '2025-05-03 02:57:41', '2025-05-03 03:01:51'),
(37, 'App\\Models\\User', 6, 'mobile', '53f8ec477550e4ffac31c525135cd1f9c1e142af8f615a2d69ff9e6221dc78a3', '[\"*\"]', '2025-05-03 03:05:32', NULL, '2025-05-03 03:04:49', '2025-05-03 03:05:32'),
(38, 'App\\Models\\User', 6, 'mobile', 'ace57180218b7581e5227d35f672310735dff09f87e4276ea44ac2a3615c5b09', '[\"*\"]', '2025-05-03 03:15:13', NULL, '2025-05-03 03:10:50', '2025-05-03 03:15:13'),
(39, 'App\\Models\\User', 6, 'mobile', '5c75e05b4c90598c6a39def65430de0595f6ec054f34ce0a726e2e04a822840e', '[\"*\"]', '2025-05-03 03:19:40', NULL, '2025-05-03 03:16:37', '2025-05-03 03:19:40'),
(40, 'App\\Models\\User', 24, 'mobile', '65d0e0b7e5d456d38c8d1316a8670f466fdf7f5ad75d97cc70740ab8346c8cb9', '[\"*\"]', NULL, NULL, '2025-05-03 03:18:16', '2025-05-03 03:18:16'),
(41, 'App\\Models\\User', 4, 'mobile', 'fa97aaf71c1d3c0b44e7a2d8d7b364cabdde1b1fa40464d82a65ae9c989971d2', '[\"*\"]', '2025-05-03 06:54:40', NULL, '2025-05-03 06:15:31', '2025-05-03 06:54:40'),
(42, 'App\\Models\\User', 4, 'mobile', '14a2580c4711b141e3660e7e92569041834c2fc7da91bcb06e24d676b03f651a', '[\"*\"]', NULL, NULL, '2025-05-03 17:10:47', '2025-05-03 17:10:47'),
(43, 'App\\Models\\User', 4, 'mobile', '967b2b06fb151ef00047b7c7e29298d06d228c71b94f25edada09691da79becd', '[\"*\"]', '2025-05-03 17:17:52', NULL, '2025-05-03 17:15:34', '2025-05-03 17:17:52'),
(44, 'App\\Models\\User', 4, 'mobile', 'db37fa09ee5a6111f6706d45c8e2cb37823e41221018c4e7c67b4e61ab125984', '[\"*\"]', '2025-05-03 18:51:40', NULL, '2025-05-03 17:20:04', '2025-05-03 18:51:40'),
(45, 'App\\Models\\User', 1, 'mobile', '4ff7b733ba19d67feb98160c0e32d90d9380818d6f177596f4a8897d8030335d', '[\"*\"]', '2025-05-03 21:55:08', NULL, '2025-05-03 17:35:45', '2025-05-03 21:55:08'),
(46, 'App\\Models\\User', 4, 'mobile', '3ed1ae62758b94309871aa5bcf41cd4ee508b67eec910d4520d1ca7b225bbcd8', '[\"*\"]', '2025-05-03 18:55:01', NULL, '2025-05-03 18:54:59', '2025-05-03 18:55:01'),
(47, 'App\\Models\\User', 4, 'mobile', '1dcc4ec02a976507dd64e6be7532e83b98c78612d3c4471f8e43ab5ba60fda59', '[\"*\"]', '2025-05-03 19:14:23', NULL, '2025-05-03 19:05:01', '2025-05-03 19:14:23'),
(48, 'App\\Models\\User', 4, 'mobile', '36589623574e26d74642ac7f3cf653b4cf9bdee028fec6aad20e4dc67dd78a1b', '[\"*\"]', '2025-05-03 19:32:15', NULL, '2025-05-03 19:17:41', '2025-05-03 19:32:15'),
(49, 'App\\Models\\User', 4, 'mobile', 'ed27942deefbfe0bf82d2a5396ec08d356055ab8f1cbe99b5c8148b3c2c2c86d', '[\"*\"]', '2025-05-03 19:34:41', NULL, '2025-05-03 19:33:20', '2025-05-03 19:34:41'),
(50, 'App\\Models\\User', 4, 'mobile', 'c0a068a8cc5b631e21b1e8e4c4282ef7f4c9e528c64b429a77b3554b5d1aead6', '[\"*\"]', '2025-05-03 19:35:26', NULL, '2025-05-03 19:35:24', '2025-05-03 19:35:26'),
(51, 'App\\Models\\User', 4, 'mobile', '8e860e14a9586326d12ecf34b9fe3ba0ff3dfba413444703f7c82dd2c349b689', '[\"*\"]', '2025-05-04 01:34:34', NULL, '2025-05-03 19:38:00', '2025-05-04 01:34:34'),
(52, 'App\\Models\\User', 4, 'mobile', '6cf6c0c51417755752b5b95c2356d0abef90558384b242e519c27f6700903426', '[\"*\"]', '2025-05-03 19:45:49', NULL, '2025-05-03 19:43:34', '2025-05-03 19:45:49'),
(53, 'App\\Models\\User', 4, 'mobile', 'f7b2e9ad45623a8a442a2d791be82b25dcb193e244996455847b8048b9ac30e6', '[\"*\"]', '2025-05-03 21:17:13', NULL, '2025-05-03 21:14:31', '2025-05-03 21:17:13'),
(54, 'App\\Models\\User', 4, 'mobile', '7bb0cb55a2e747125d6de80948ecd2d1f57381b0f82432d1e6bcf1feb13f6505', '[\"*\"]', '2025-05-04 01:21:57', NULL, '2025-05-03 23:58:55', '2025-05-04 01:21:57'),
(55, 'App\\Models\\User', 4, 'mobile', '189a338a4ffe960f58b4e82456c9f2c15f64f0030dbbd3668704630a1d3b8165', '[\"*\"]', '2025-05-05 17:00:28', NULL, '2025-05-05 16:58:43', '2025-05-05 17:00:28'),
(56, 'App\\Models\\User', 4, 'mobile', '4cc346829386afd5f79de888b46f08b89c9c2ff73dbf64085e563aa95e7e9bb2', '[\"*\"]', NULL, NULL, '2025-05-05 17:15:17', '2025-05-05 17:15:17'),
(57, 'App\\Models\\User', 4, 'mobile', 'fa6d9b34a89cc29216692ff479b9c2d03bae25bdffde4d66f3c239bfec0fb2a3', '[\"*\"]', '2025-05-05 17:25:19', NULL, '2025-05-05 17:25:18', '2025-05-05 17:25:19'),
(58, 'App\\Models\\User', 4, 'mobile', '6446f43af130c22965a2f7e3ef963f772e9874cb35faa548ec6591bcdf1c75b6', '[\"*\"]', NULL, NULL, '2025-05-05 17:37:34', '2025-05-05 17:37:34'),
(59, 'App\\Models\\User', 4, 'mobile', 'eb3fe640f30d4d8ecbe8b8316a70fbe60d350778dc368c4e9c0fa4089b2efe1e', '[\"*\"]', '2025-05-05 17:54:49', NULL, '2025-05-05 17:54:28', '2025-05-05 17:54:49'),
(60, 'App\\Models\\User', 4, 'mobile', '0ae54719974cf3f802f4ecfe1f72b65a3bb7c1a6e44ea526f5a9def1a18baaf7', '[\"*\"]', '2025-05-05 18:38:17', NULL, '2025-05-05 17:54:55', '2025-05-05 18:38:17'),
(61, 'App\\Models\\User', 4, 'mobile', 'caf2daf9cd2fb34b0993f5b9a78f6e919dd50fd74c8ba4c3a58d1fd2b06bf5cd', '[\"*\"]', '2025-05-05 23:15:29', NULL, '2025-05-05 18:21:52', '2025-05-05 23:15:29'),
(62, 'App\\Models\\User', 4, 'mobile', '379c68d947684206dd6208b519b442f4fbe6318d7e2f948ea70378f0db5b06b5', '[\"*\"]', '2025-05-05 18:38:26', NULL, '2025-05-05 18:38:25', '2025-05-05 18:38:26'),
(63, 'App\\Models\\User', 4, 'mobile', '2629359026011329b885d43c5d322145e3877149f80dc7ffea653a9c55010d98', '[\"*\"]', '2025-05-05 18:38:39', NULL, '2025-05-05 18:38:38', '2025-05-05 18:38:39'),
(64, 'App\\Models\\User', 4, 'mobile', '5e14faf0007c5a6aea94a92ba515838c1f0159a26c87b3919a9db6d7cea836ad', '[\"*\"]', '2025-05-05 18:39:29', NULL, '2025-05-05 18:39:28', '2025-05-05 18:39:29'),
(65, 'App\\Models\\User', 4, 'mobile', '038a038613feb70dc829e27ea81572199fecfb7655bc62d33526eaf23c164b07', '[\"*\"]', '2025-05-05 18:41:38', NULL, '2025-05-05 18:41:37', '2025-05-05 18:41:38'),
(66, 'App\\Models\\User', 4, 'mobile', '7f980ec3607f46c5591428ba0c6c3a33c5554859ecc9c8079b54c558397121f2', '[\"*\"]', '2025-05-05 18:42:36', NULL, '2025-05-05 18:42:34', '2025-05-05 18:42:36'),
(67, 'App\\Models\\User', 4, 'mobile', 'fe8d61b833032fc783438df784493a8c08c9ba3801c1761f0b5868543ee9810d', '[\"*\"]', '2025-05-06 02:43:36', NULL, '2025-05-05 18:49:38', '2025-05-06 02:43:36'),
(68, 'App\\Models\\User', 4, 'mobile', 'c600dc2cac253d8c6804356c010559713ab591ac38e2496faab592b59e61b72c', '[\"*\"]', NULL, NULL, '2025-05-06 00:13:33', '2025-05-06 00:13:33'),
(69, 'App\\Models\\User', 4, 'mobile', '1c36666ef0dd2f851e7fe1ef66a8c6e296475695e756e24425728676ee783343', '[\"*\"]', '2025-05-06 01:24:50', NULL, '2025-05-06 01:24:48', '2025-05-06 01:24:50'),
(70, 'App\\Models\\User', 4, 'mobile', '40024e328af8bb5e20d7d3bd000eba6cee53ca9d5f20a67a7b7e4e4f6db5ba34', '[\"*\"]', '2025-05-06 01:33:05', NULL, '2025-05-06 01:33:04', '2025-05-06 01:33:05'),
(71, 'App\\Models\\User', 4, 'mobile', '957351b38a0a93a7a624c940323b61f9e5d1e312a3d064c9045052a7be200f33', '[\"*\"]', '2025-05-06 01:38:17', NULL, '2025-05-06 01:38:15', '2025-05-06 01:38:17'),
(72, 'App\\Models\\User', 4, 'mobile', '7e2c947a30b6d146aee0ad91708ead6cd801a90fe0a46ce72e28fff703eba04c', '[\"*\"]', '2025-05-06 01:45:15', NULL, '2025-05-06 01:45:13', '2025-05-06 01:45:15'),
(73, 'App\\Models\\User', 4, 'mobile', '54b17905eea7419b791c0cec57e237cbf352af8d18528a4bf5657446578c467c', '[\"*\"]', '2025-05-06 01:49:31', NULL, '2025-05-06 01:49:27', '2025-05-06 01:49:31'),
(74, 'App\\Models\\User', 4, 'mobile', 'bb0635de29188517138513c00d7791b89a4183b20b0016302103ccabf10c574a', '[\"*\"]', NULL, NULL, '2025-05-06 01:54:58', '2025-05-06 01:54:58'),
(75, 'App\\Models\\User', 4, 'mobile', '17496461e8ca077fce16ad588e67a67b0b3b731bec5030e513a2e7ecb68767c6', '[\"*\"]', '2025-05-06 01:58:07', NULL, '2025-05-06 01:58:05', '2025-05-06 01:58:07'),
(76, 'App\\Models\\User', 4, 'mobile', '665d5cf6d1089f7f3f14b90385abd2d946e5e9d4ca1e018ce9c6160cecf74c98', '[\"*\"]', '2025-05-06 02:48:08', NULL, '2025-05-06 02:43:46', '2025-05-06 02:48:08'),
(77, 'App\\Models\\User', 4, 'mobile', 'b405958ae6d92248b5c4cb090a4f7b8c9904aaaf514020b649740418cbd4b8fa', '[\"*\"]', '2025-05-06 05:33:20', NULL, '2025-05-06 05:30:21', '2025-05-06 05:33:20'),
(78, 'App\\Models\\User', 4, 'mobile', 'efde868609cc0cf9982e83de9da467a3230224f1c4c8958b6bd425a33df83a9e', '[\"*\"]', '2025-05-06 05:37:01', NULL, '2025-05-06 05:34:33', '2025-05-06 05:37:01'),
(79, 'App\\Models\\User', 25, 'mobile', '886d49034ca6868413e313ee305a244c011121567f4785a92e8a63524211ff0b', '[\"*\"]', '2025-05-06 19:14:35', NULL, '2025-05-06 17:00:46', '2025-05-06 19:14:35'),
(80, 'App\\Models\\User', 4, 'mobile', 'b12c4adbcbbc7d54d5f8e644bc0e2ff86cc8f13ea57b39bd53bea38ac0411e0f', '[\"*\"]', '2025-05-06 18:30:24', NULL, '2025-05-06 18:30:22', '2025-05-06 18:30:24'),
(81, 'App\\Models\\User', 26, 'mobile', '226369eef24b1ed91aaf62b6daaf72f944597eb36af5b831f818b58ce8696b78', '[\"*\"]', '2025-05-06 18:54:38', NULL, '2025-05-06 18:40:58', '2025-05-06 18:54:38'),
(82, 'App\\Models\\User', 4, 'mobile', 'a24f15c71436a14d9682e843279cade49ab975fa0c292c1d903729ab4b551c0c', '[\"*\"]', '2025-05-06 22:15:56', NULL, '2025-05-06 18:54:55', '2025-05-06 22:15:56'),
(83, 'App\\Models\\User', 25, 'mobile', 'c3fff9d869d21d5858bf8829b2890de8703da6b5c6e617e34f2710c8bc93a79a', '[\"*\"]', '2025-05-08 18:35:12', NULL, '2025-05-06 19:20:03', '2025-05-08 18:35:12'),
(84, 'App\\Models\\User', 4, 'mobile', '13ac61e52bb3fbd2d848063754b4897cfd088afffa482f6fc9cf87d2ce5444fe', '[\"*\"]', NULL, NULL, '2025-05-06 20:18:35', '2025-05-06 20:18:35'),
(85, 'App\\Models\\User', 27, 'mobile', '6a7c40a32656f6f09134a361a5682917e403eba3c7f406d78456922c14278d9c', '[\"*\"]', NULL, NULL, '2025-05-06 21:12:13', '2025-05-06 21:12:13'),
(86, 'App\\Models\\User', 27, 'mobile', '9074084cc0f997cca97c3c520a375ca2b12df3e3ee55b8d40b47341ef96e15f5', '[\"*\"]', NULL, NULL, '2025-05-06 21:23:02', '2025-05-06 21:23:02'),
(87, 'App\\Models\\User', 4, 'mobile', 'dc993e48845011fbefcb6834f7b941c3dc149c5df40240bc0cbbd325f32ce5ee', '[\"*\"]', '2025-05-07 16:51:51', NULL, '2025-05-06 22:26:39', '2025-05-07 16:51:51'),
(88, 'App\\Models\\User', 4, 'mobile', '07d790d14375096da0f68a05d4cc49d75919f8abcb2d7b2607f1d4ec042cbbae', '[\"*\"]', '2025-05-07 01:58:17', NULL, '2025-05-06 22:30:10', '2025-05-07 01:58:17'),
(89, 'App\\Models\\User', 4, 'mobile', '781d1087ee4ef7fa96586c49de7146c5b59efcadf75f5232a0f3ae6ca582f36a', '[\"*\"]', '2025-05-07 01:59:21', NULL, '2025-05-07 01:58:39', '2025-05-07 01:59:21'),
(90, 'App\\Models\\User', 4, 'mobile', 'f5be03615f850322a13692ec737bde429925330fc9cca36fa49ef8d112785a4c', '[\"*\"]', '2025-05-07 02:00:04', NULL, '2025-05-07 02:00:01', '2025-05-07 02:00:04'),
(91, 'App\\Models\\User', 4, 'mobile', '9786bc2b9ac39db7478fa4ccc1ebe92156c1720f1cbd5e698ce4a38bd03845dd', '[\"*\"]', '2025-05-07 03:51:00', NULL, '2025-05-07 02:05:16', '2025-05-07 03:51:00'),
(92, 'App\\Models\\User', 4, 'mobile', 'bb2a588d4ddd92ca1f48e8460a09e80f187b86617dd426ee21e411c04b07d068', '[\"*\"]', '2025-05-07 04:14:29', NULL, '2025-05-07 03:51:20', '2025-05-07 04:14:29'),
(93, 'App\\Models\\User', 4, 'mobile', 'dbc78e0e2e0db5dae1e0a8f0a0f8062a1552fd9023e739ac75b7003b1ae585f3', '[\"*\"]', '2025-05-07 17:33:07', NULL, '2025-05-07 04:17:26', '2025-05-07 17:33:07'),
(94, 'App\\Models\\User', 4, 'mobile', '15f8b551e61467ff689543a0c63aabc5ab3999e282d63e8dad681e0f9fb591d5', '[\"*\"]', '2025-05-07 17:33:39', NULL, '2025-05-07 17:33:37', '2025-05-07 17:33:39'),
(95, 'App\\Models\\User', 4, 'mobile', '975a9aa1d3807d31d7b274236f838e2982529488f5d8ba4f84cb64d5cf57e923', '[\"*\"]', '2025-05-07 22:32:24', NULL, '2025-05-07 17:34:01', '2025-05-07 22:32:24'),
(96, 'App\\Models\\User', 28, 'mobile', 'a15bec419e6d00d6ee25785151f7e530e08dedbdf2a4c9e7dd45d2ab5f5a0888', '[\"*\"]', NULL, NULL, '2025-05-07 18:39:23', '2025-05-07 18:39:23'),
(97, 'App\\Models\\User', 4, 'mobile', '441e44417222d4d167fee538514a5335a7cd49efea96c25987e991931e1bff3b', '[\"*\"]', '2025-05-07 23:12:55', NULL, '2025-05-07 22:33:08', '2025-05-07 23:12:55'),
(98, 'App\\Models\\User', 4, 'mobile', '4e4b6f8e232fc2f51fce13202020fa0c65643145742f3e47ad4f3666305cf06b', '[\"*\"]', '2025-05-07 22:33:58', NULL, '2025-05-07 22:33:56', '2025-05-07 22:33:58'),
(99, 'App\\Models\\User', 4, 'mobile', '51aa377083cbb6b1ad1a7d08e5249f95d3bd540d0bc7d39d3f7549d18af81d57', '[\"*\"]', NULL, NULL, '2025-05-07 22:49:37', '2025-05-07 22:49:37'),
(100, 'App\\Models\\User', 4, 'mobile', 'bc9c7881e0252de4c19eae215e4b836e996070ae975a293b0a4c2d4d30dd7398', '[\"*\"]', NULL, NULL, '2025-05-07 22:50:35', '2025-05-07 22:50:35'),
(101, 'App\\Models\\User', 4, 'mobile', 'dcfd9afe230b386ff67123fee0ddd825f3ac42beec97482eda6c4e4ed058277b', '[\"*\"]', NULL, NULL, '2025-05-07 22:50:59', '2025-05-07 22:50:59'),
(102, 'App\\Models\\User', 4, 'mobile', 'e25df60d0db64e798f3fa5a249f70e6040cffd3371d6cc640ca2886979ca241a', '[\"*\"]', '2025-05-07 22:54:26', NULL, '2025-05-07 22:54:24', '2025-05-07 22:54:26'),
(103, 'App\\Models\\User', 4, 'mobile', '513c373cafc881c2e7e9dabb66492dba04e40121aff59702fc632b71f6391f12', '[\"*\"]', '2025-05-07 23:03:15', NULL, '2025-05-07 23:03:13', '2025-05-07 23:03:15'),
(104, 'App\\Models\\User', 4, 'mobile', 'e1f44e43e7c54122830f443a73d969c14e6f2a1490ad7f223e1ec5c94632014d', '[\"*\"]', '2025-05-07 23:21:34', NULL, '2025-05-07 23:21:31', '2025-05-07 23:21:34'),
(105, 'App\\Models\\User', 4, 'mobile', 'a7a1d049e312be80ef3ebaf5564955bbd9ebe02d840a7d92c00be0120da64739', '[\"*\"]', '2025-05-07 23:31:34', NULL, '2025-05-07 23:31:31', '2025-05-07 23:31:34'),
(106, 'App\\Models\\User', 4, 'mobile', 'b33dcabe1562c471e01061bb1385ee6e26fcea55ea6ec6f6ec48ae718b52a922', '[\"*\"]', '2025-05-07 23:45:50', NULL, '2025-05-07 23:45:47', '2025-05-07 23:45:50'),
(107, 'App\\Models\\User', 4, 'mobile', '8acba6875bdfd7c84948de62e4843f62cb62447ec304462498992d42b11da2c1', '[\"*\"]', NULL, NULL, '2025-05-07 23:51:15', '2025-05-07 23:51:15'),
(108, 'App\\Models\\User', 4, 'mobile', 'ab5c99c2f8d099fd78e1ab8d9345e68ba54dc3590ac10b9b143ab0b9a6a05d54', '[\"*\"]', NULL, NULL, '2025-05-07 23:51:22', '2025-05-07 23:51:22'),
(109, 'App\\Models\\User', 4, 'mobile', '900551e245171ce201134968158ba962f4e91adfedd5e39c0092f810c90fd882', '[\"*\"]', NULL, NULL, '2025-05-07 23:51:25', '2025-05-07 23:51:25'),
(110, 'App\\Models\\User', 4, 'mobile', 'c3325e32b7da4ec6334aef3ffbfe9f57f66be50a19f251fdf3e66e6e75a9e91d', '[\"*\"]', NULL, NULL, '2025-05-07 23:51:27', '2025-05-07 23:51:27'),
(111, 'App\\Models\\User', 4, 'mobile', '10b85e8d887baae0b7514df3367f3431d322436c8ee1918a3a0331de6b95bfc2', '[\"*\"]', NULL, NULL, '2025-05-07 23:51:45', '2025-05-07 23:51:45'),
(112, 'App\\Models\\User', 4, 'mobile', 'b05b23acaf35a18aaa1ba30f2e748e59cbbfe8ef9a32c26be6669273a7060d8d', '[\"*\"]', NULL, NULL, '2025-05-07 23:51:46', '2025-05-07 23:51:46'),
(113, 'App\\Models\\User', 4, 'mobile', '6f0b33c8f6010a856fc749fbd3c47ba48f92cde6f48ad9206081f1675786640e', '[\"*\"]', NULL, NULL, '2025-05-07 23:51:48', '2025-05-07 23:51:48'),
(114, 'App\\Models\\User', 4, 'mobile', '2bc2a34571fec0b8e5ac6d986a568cf78a10019ad97bc0760385ae337be40262', '[\"*\"]', NULL, NULL, '2025-05-07 23:52:03', '2025-05-07 23:52:03'),
(115, 'App\\Models\\User', 4, 'mobile', '1825f05efce4ff263804202ac42b1dadbcf3d997ab51733b48664b459077e5a3', '[\"*\"]', NULL, NULL, '2025-05-07 23:52:08', '2025-05-07 23:52:08'),
(116, 'App\\Models\\User', 4, 'mobile', '4b54812d454b926077253f3ef7e8fb18f680b88f7ab3dcba5d534f3c343abae5', '[\"*\"]', NULL, NULL, '2025-05-07 23:52:11', '2025-05-07 23:52:11'),
(117, 'App\\Models\\User', 4, 'mobile', 'd875678bf2227485ffebcef7c2bd0b6bf9dfcb4b13f123bd1f8a6ad1046b1e55', '[\"*\"]', '2025-05-08 00:03:25', NULL, '2025-05-07 23:52:24', '2025-05-08 00:03:25'),
(118, 'App\\Models\\User', 4, 'mobile', '9543e38f6e2e2f258d7f47f0ad251215e858f08f542add30906af43d64ccbabb', '[\"*\"]', '2025-05-08 00:01:36', NULL, '2025-05-07 23:58:19', '2025-05-08 00:01:36'),
(119, 'App\\Models\\User', 4, 'mobile', 'a054b79a9ecd6f09d6e3bd100156b7e709ef8a462822fc9dfb5c0b21f4f88aab', '[\"*\"]', '2025-05-08 00:03:10', NULL, '2025-05-08 00:01:01', '2025-05-08 00:03:10'),
(120, 'App\\Models\\User', 4, 'mobile', '73fe67799fef0b476862bc617d1fcba453a787061551510d742a590328497fce', '[\"*\"]', NULL, NULL, '2025-05-08 00:03:48', '2025-05-08 00:03:48'),
(121, 'App\\Models\\User', 4, 'mobile', 'f88aba9c650a5a9d67fcc356faee7d9352c3f17ae85c9dcafbbe6cd5a0bddd5f', '[\"*\"]', '2025-05-08 00:04:05', NULL, '2025-05-08 00:04:03', '2025-05-08 00:04:05'),
(122, 'App\\Models\\User', 4, 'mobile', '3e7e35423ec1534e8d4c143c08d2cc1ef0332534853a8fca6a5ebd82f24db386', '[\"*\"]', '2025-05-08 00:05:21', NULL, '2025-05-08 00:05:18', '2025-05-08 00:05:21'),
(123, 'App\\Models\\User', 4, 'mobile', '91152ceae892c3ab9e44759266172e781f47e49b023e05ebd4002378bf5cf24e', '[\"*\"]', NULL, NULL, '2025-05-08 00:14:10', '2025-05-08 00:14:10'),
(124, 'App\\Models\\User', 4, 'mobile', '3e78f38d761a34760a159e4a2c5fafe053d18c37aea50bef4eeb6fd811d7abfb', '[\"*\"]', '2025-05-08 00:17:42', NULL, '2025-05-08 00:17:39', '2025-05-08 00:17:42'),
(125, 'App\\Models\\User', 4, 'mobile', '03c8366ebe8fe483d21be3df9dbcc15e2b00c0597d2063f991d2d0725f7d6c7e', '[\"*\"]', '2025-05-08 00:22:54', NULL, '2025-05-08 00:22:52', '2025-05-08 00:22:54'),
(126, 'App\\Models\\User', 4, 'mobile', '9691d800dc7765a46cf9c5108766559abce2010d40a6facd4c92fd7fa657fb91', '[\"*\"]', '2025-05-08 00:23:34', NULL, '2025-05-08 00:23:32', '2025-05-08 00:23:34'),
(127, 'App\\Models\\User', 4, 'mobile', '7e4a60275285d5165672ae085d327a9e32286c9f7204cb737090815bbb4f5d34', '[\"*\"]', '2025-05-08 00:23:45', NULL, '2025-05-08 00:23:43', '2025-05-08 00:23:45'),
(128, 'App\\Models\\User', 4, 'mobile', '9fab8abb2269af76b8a92113249baf2ea2219f1ccad9f3c1c716649ba755e2cd', '[\"*\"]', '2025-05-08 00:23:56', NULL, '2025-05-08 00:23:54', '2025-05-08 00:23:56'),
(129, 'App\\Models\\User', 4, 'mobile', 'a0245a475b0be1b0609be3cfbaf3e3c8a0d6663b5dd89433ecc7c6e13eeece15', '[\"*\"]', '2025-05-08 00:24:44', NULL, '2025-05-08 00:24:41', '2025-05-08 00:24:44'),
(130, 'App\\Models\\User', 4, 'mobile', '75421bd04d953a8cce16d5e47413627033a5caca153ca8a2327e775393ac23ba', '[\"*\"]', '2025-05-08 00:49:43', NULL, '2025-05-08 00:31:21', '2025-05-08 00:49:43'),
(131, 'App\\Models\\User', 4, 'mobile', 'bd59b5c0dbd97fc23453dee3e6b68050b9642c6b3082daccd67dc5a1ae0d1fa5', '[\"*\"]', '2025-05-08 00:48:54', NULL, '2025-05-08 00:47:28', '2025-05-08 00:48:54'),
(132, 'App\\Models\\User', 4, 'mobile', '6b78504113bb11cdeb040f0c1740c082b82a588380e274559fc2fcf2eed07b2e', '[\"*\"]', '2025-05-08 00:50:17', NULL, '2025-05-08 00:50:15', '2025-05-08 00:50:17'),
(133, 'App\\Models\\User', 4, 'mobile', '7c2326313715f748927589aaad9d1f1213143e9bdcbdbf3284a511fddc93024c', '[\"*\"]', '2025-05-08 00:50:43', NULL, '2025-05-08 00:50:41', '2025-05-08 00:50:43'),
(134, 'App\\Models\\User', 4, 'mobile', 'ad7707002acb3de1011712b3b9c74201b68ee94cf8441ed7366126a01fd85b3f', '[\"*\"]', '2025-05-08 00:51:02', NULL, '2025-05-08 00:51:00', '2025-05-08 00:51:02'),
(135, 'App\\Models\\User', 4, 'mobile', '3953dc119c3c02afcfdb159b61aa0d151789016c6fef336b438627d36548dab3', '[\"*\"]', '2025-05-08 01:17:15', NULL, '2025-05-08 00:51:42', '2025-05-08 01:17:15'),
(136, 'App\\Models\\User', 4, 'mobile', '13c75e521679b264ce6c4df33017c4f0ab725eb423b95a397c3ffa0ae96ca78e', '[\"*\"]', '2025-05-08 00:52:42', NULL, '2025-05-08 00:52:41', '2025-05-08 00:52:42'),
(137, 'App\\Models\\User', 29, 'mobile', '3c5ae72344d715dbb52ac6b3d9f9566f8d4cf03edd163287da3c37097d55958c', '[\"*\"]', '2025-05-08 01:06:54', NULL, '2025-05-08 01:03:28', '2025-05-08 01:06:54'),
(138, 'App\\Models\\User', 4, 'mobile', 'cc4c787c4af36842ce9a434480284ed17a47537ef47374f94e1c74fb925e9e0a', '[\"*\"]', '2025-05-08 01:24:27', NULL, '2025-05-08 01:24:24', '2025-05-08 01:24:27'),
(139, 'App\\Models\\User', 4, 'mobile', 'a0a0fd1812255cb56ed36de443e53b0f89c769cae764ccf7fadc88bfd431e9c6', '[\"*\"]', '2025-05-08 02:54:13', NULL, '2025-05-08 02:54:11', '2025-05-08 02:54:13'),
(140, 'App\\Models\\User', 4, 'mobile', 'ccd58cd893d8b4a01abac40ca9964af5c33d2885779fe1675f2602bfe5c28c3f', '[\"*\"]', '2025-05-08 17:32:37', NULL, '2025-05-08 04:44:30', '2025-05-08 17:32:37'),
(141, 'App\\Models\\User', 30, 'mobile', 'b39832b549f31e70b32bc44da31e9b2b528589376f7b2240bccd588f85cb08ba', '[\"*\"]', NULL, NULL, '2025-05-08 16:15:33', '2025-05-08 16:15:33'),
(142, 'App\\Models\\User', 30, 'mobile', '3aa6ae9791092bc580fb9e429c30ee373902785537dc75e50a06d85cb3cdf458', '[\"*\"]', '2025-05-08 16:19:33', NULL, '2025-05-08 16:16:33', '2025-05-08 16:19:33'),
(143, 'App\\Models\\User', 30, 'mobile', '12de3bef2f5a70bf302e9c05a211dfb7704f3e7aa6bffb1de46af50f1406df86', '[\"*\"]', '2025-05-08 16:53:23', NULL, '2025-05-08 16:51:24', '2025-05-08 16:53:23'),
(144, 'App\\Models\\User', 4, 'mobile', 'fe738b810c9738d9f00ebffc4971e133fe4af1847d29eefd1046a19acb87a564', '[\"*\"]', '2025-05-08 17:09:45', NULL, '2025-05-08 17:08:43', '2025-05-08 17:09:45'),
(145, 'App\\Models\\User', 8, 'mobile', '2ed1c9c570fb8ba0b938d850aaf604ca51c740f387e4d7fb8a6952c023292fff', '[\"*\"]', '2025-05-08 17:40:00', NULL, '2025-05-08 17:39:15', '2025-05-08 17:40:00'),
(146, 'App\\Models\\User', 10, 'mobile', 'd0364a56f640e5f89ad15bdc4fd56dfa63cc19aa234d6b5ebbbd76cc50be1bd4', '[\"*\"]', '2025-05-08 17:41:18', NULL, '2025-05-08 17:40:58', '2025-05-08 17:41:18'),
(147, 'App\\Models\\User', 31, 'mobile', '9bdd2c8da5d319afda4c0731351e8e9a231ea2ee4ffc565902a24388236cbaea', '[\"*\"]', '2025-05-08 18:31:03', NULL, '2025-05-08 17:45:56', '2025-05-08 18:31:03'),
(148, 'App\\Models\\User', 4, 'mobile', '3e5c6231facbadcc8baceeab929f7a5e9b83e8879068069e59a0e0a8f787d759', '[\"*\"]', '2025-05-08 17:58:59', NULL, '2025-05-08 17:58:56', '2025-05-08 17:58:59'),
(149, 'App\\Models\\User', 4, 'mobile', 'aeef57632cc1e76f6926353509d78fdf71fa43080f2315637962b966f14caf31', '[\"*\"]', '2025-05-08 18:26:17', NULL, '2025-05-08 18:26:14', '2025-05-08 18:26:17'),
(150, 'App\\Models\\User', 4, 'mobile', 'd45f20f217a26a4fb78ea59f85d9f5b531ca0865927462143f36da71c2348bb8', '[\"*\"]', '2025-05-08 18:27:42', NULL, '2025-05-08 18:27:40', '2025-05-08 18:27:42'),
(151, 'App\\Models\\User', 4, 'mobile', '9527abd4609cf45393bd30b9b1b3dc8f45f65c8739b2b9a72f5a2a2bc3971550', '[\"*\"]', '2025-05-08 18:28:45', NULL, '2025-05-08 18:28:43', '2025-05-08 18:28:45'),
(152, 'App\\Models\\User', 4, 'mobile', 'ee9434a76d9eb10182e4ebf38107ef6eab3787c2334d728640a8d7124d086521', '[\"*\"]', '2025-05-08 18:29:47', NULL, '2025-05-08 18:29:27', '2025-05-08 18:29:47'),
(153, 'App\\Models\\User', 4, 'mobile', '2b115593da6cc1d48855d5cd7b151c8b28f9283b75eaf7d9fd09c1cc8e79dd75', '[\"*\"]', '2025-05-08 18:30:17', NULL, '2025-05-08 18:30:15', '2025-05-08 18:30:17'),
(154, 'App\\Models\\User', 4, 'mobile', '951a682987b42f232fce83b1a729ac02aa00c58341cc1edf932b64d822bbe7cd', '[\"*\"]', '2025-05-08 18:30:46', NULL, '2025-05-08 18:30:44', '2025-05-08 18:30:46'),
(155, 'App\\Models\\User', 4, 'mobile', '0313de5bb75f955d2837e81296fecbdcca64293f991c4590265ca212da619ef6', '[\"*\"]', '2025-05-08 18:31:26', NULL, '2025-05-08 18:31:23', '2025-05-08 18:31:26'),
(156, 'App\\Models\\User', 4, 'mobile', 'c76256be72f213267867f9c3aba0eb77391b27e0d8054d3275d379ed12ea1a65', '[\"*\"]', '2025-05-08 18:32:35', NULL, '2025-05-08 18:32:31', '2025-05-08 18:32:35'),
(157, 'App\\Models\\User', 4, 'mobile', 'c196721579424881a33f27119ee90d741c232e944a83fefce4c0f91674826635', '[\"*\"]', NULL, NULL, '2025-05-08 18:44:15', '2025-05-08 18:44:15'),
(158, 'App\\Models\\User', 4, 'mobile', '0bb9a4fa5b3492fcaf89402bb4431779065174ff5871f4fd15eb3d2aeecd2d50', '[\"*\"]', '2025-05-08 18:44:46', NULL, '2025-05-08 18:44:44', '2025-05-08 18:44:46'),
(159, 'App\\Models\\User', 32, 'mobile', '823e290e1e1b0e17ae56b0319a10432826de0a8957db376983be3d574ff7b0d4', '[\"*\"]', '2025-05-08 18:45:38', NULL, '2025-05-08 18:45:38', '2025-05-08 18:45:38'),
(160, 'App\\Models\\User', 4, 'mobile', '4f1fae518461e86f76064c1ab09b55dd916bdfdc3e307a6803f5bb5ef78e9621', '[\"*\"]', '2025-05-08 18:46:48', NULL, '2025-05-08 18:46:47', '2025-05-08 18:46:48'),
(161, 'App\\Models\\User', 4, 'mobile', 'f7f6af83bd57558bf43cca3eef80449fae2669594b27bf760d1f1ccf7da6e6f5', '[\"*\"]', '2025-05-08 18:46:59', NULL, '2025-05-08 18:46:57', '2025-05-08 18:46:59'),
(162, 'App\\Models\\User', 4, 'mobile', 'f5a35ba59e609c350d42f06f0c20d1d948bb33f96f2a5ac96f1e8b59be8ba310', '[\"*\"]', '2025-05-08 18:47:13', NULL, '2025-05-08 18:47:11', '2025-05-08 18:47:13'),
(163, 'App\\Models\\User', 4, 'mobile', '55e5a08ffcf1588624989571f099627c9406fc5795bff114dd3cc3aad6599d7b', '[\"*\"]', '2025-05-08 18:47:41', NULL, '2025-05-08 18:47:39', '2025-05-08 18:47:41'),
(164, 'App\\Models\\User', 4, 'mobile', '96fbe1e4f35c53b2bc40215738da71fc0c800f5c68ca650e6ca584fb5996e0d8', '[\"*\"]', '2025-05-09 01:37:47', NULL, '2025-05-08 18:47:52', '2025-05-09 01:37:47'),
(165, 'App\\Models\\User', 4, 'mobile', '816d60726273daec11b0a4042fb694701335ad5b9b96f32b94f42509379da4e7', '[\"*\"]', '2025-05-08 18:47:55', NULL, '2025-05-08 18:47:54', '2025-05-08 18:47:55'),
(166, 'App\\Models\\User', 4, 'mobile', '9d85764af4f6309fb486b6abb369129759d440fcae7a94f2de1a3d087764f1a9', '[\"*\"]', '2025-05-08 18:53:10', NULL, '2025-05-08 18:53:07', '2025-05-08 18:53:10'),
(167, 'App\\Models\\User', 4, 'mobile', 'ebfc2b91668225015cbaf160fbbdfbfa8fb0f99b28f38f6fe3903be0949a0bb8', '[\"*\"]', '2025-05-08 18:54:10', NULL, '2025-05-08 18:54:08', '2025-05-08 18:54:10'),
(168, 'App\\Models\\User', 4, 'mobile', '18db4a9437c5239294f5c941239f786adf3a574fa872741141dd3436a8c8821b', '[\"*\"]', '2025-05-08 18:56:24', NULL, '2025-05-08 18:56:23', '2025-05-08 18:56:24'),
(169, 'App\\Models\\User', 4, 'mobile', '554dfd3c1397848a2ed13214105360c7abad914a815c6593910fb2e0c8d06451', '[\"*\"]', '2025-05-08 18:56:36', NULL, '2025-05-08 18:56:34', '2025-05-08 18:56:36'),
(170, 'App\\Models\\User', 4, 'mobile', '333ca8cc05160b661e98b62c45aff8961d20fe96f0284c75d0d0db5d89985610', '[\"*\"]', '2025-05-08 18:56:47', NULL, '2025-05-08 18:56:45', '2025-05-08 18:56:47'),
(171, 'App\\Models\\User', 4, 'mobile', '8508d4263ea50b56da1efa372d02189484a73dd9c85cbb0da9fecc01ff3890fa', '[\"*\"]', '2025-05-08 18:56:55', NULL, '2025-05-08 18:56:53', '2025-05-08 18:56:55'),
(172, 'App\\Models\\User', 4, 'mobile', '0a5c5c3539f44ac5dbcd19eacaffe3e1f31913853ab86595d01f78d2643c761e', '[\"*\"]', '2025-05-08 18:57:07', NULL, '2025-05-08 18:57:05', '2025-05-08 18:57:07'),
(173, 'App\\Models\\User', 4, 'mobile', 'ccd8d1d83de44edf4dc10844fe62f3acfa44b944a0fe2e60d22a8a0cf2f93a32', '[\"*\"]', '2025-05-08 23:18:26', NULL, '2025-05-08 18:57:30', '2025-05-08 23:18:26'),
(174, 'App\\Models\\User', 4, 'mobile', '2a9b100a71cda77becf5887a2577ddd66b41dc140d01396ba219ef6ba94fed9d', '[\"*\"]', '2025-05-09 00:05:55', NULL, '2025-05-08 18:58:52', '2025-05-09 00:05:55'),
(175, 'App\\Models\\User', 4, 'mobile', '141dc16958b89736836186cc5ba95c95c436dd8ab187c269d27f918727b1be1c', '[\"*\"]', '2025-05-08 19:04:26', NULL, '2025-05-08 19:04:16', '2025-05-08 19:04:26'),
(176, 'App\\Models\\User', 4, 'mobile', '9bcef8fa75fea794a16cf2935658550313cf10e6afda11bfd62ca184e2c199cb', '[\"*\"]', '2025-05-08 19:04:44', NULL, '2025-05-08 19:04:42', '2025-05-08 19:04:44'),
(177, 'App\\Models\\User', 4, 'mobile', '21048c0e751515a931716fe989dc239a14bb249871d2e860d6d3f7aa385d715e', '[\"*\"]', '2025-05-08 20:30:20', NULL, '2025-05-08 19:05:18', '2025-05-08 20:30:20'),
(178, 'App\\Models\\User', 32, 'mobile', '630f79cb224b0133c284d4e8538df4582dbb1ad3d6a805b25502e699ced28e18', '[\"*\"]', '2025-05-09 06:28:30', NULL, '2025-05-08 19:07:23', '2025-05-09 06:28:30'),
(179, 'App\\Models\\User', 4, 'mobile', '8faccfee4c8ed39c60735f7bbac14009f95975b6c2716e2108a7107eeb2e7040', '[\"*\"]', '2025-05-08 20:30:44', NULL, '2025-05-08 20:30:41', '2025-05-08 20:30:44'),
(180, 'App\\Models\\User', 4, 'mobile', '40f9565713f4220afc74b1eed831068ccc43e8ff764b46ff846011ba7e6808b8', '[\"*\"]', '2025-05-08 20:31:17', NULL, '2025-05-08 20:31:14', '2025-05-08 20:31:17'),
(181, 'App\\Models\\User', 4, 'mobile', '55bd843985e35454766d21ad2191ccbe95806ecf0d1591beb6f40b32bce47b88', '[\"*\"]', '2025-05-08 20:32:44', NULL, '2025-05-08 20:32:39', '2025-05-08 20:32:44'),
(182, 'App\\Models\\User', 4, 'mobile', 'cc4b3bd190776a65c13827016cbc4ade2a271a782cae88881874d5fff4e6c9e5', '[\"*\"]', '2025-05-08 20:41:49', NULL, '2025-05-08 20:41:47', '2025-05-08 20:41:49'),
(183, 'App\\Models\\User', 4, 'mobile', '66b75d0671e060931fe76264a864085c348669ce26974c2471428e00d4fa95d6', '[\"*\"]', '2025-05-08 20:42:06', NULL, '2025-05-08 20:42:04', '2025-05-08 20:42:06'),
(184, 'App\\Models\\User', 4, 'mobile', 'f423645bc83490473f91d5139d6fe469de260cc290121c8e2d4de49c0d5bc732', '[\"*\"]', '2025-05-08 20:42:35', NULL, '2025-05-08 20:42:31', '2025-05-08 20:42:35'),
(185, 'App\\Models\\User', 4, 'mobile', '5c20a99b9dcf28668deda786416d542a568c604345b6efe6021fe4c545894973', '[\"*\"]', '2025-05-08 20:46:36', NULL, '2025-05-08 20:46:34', '2025-05-08 20:46:36'),
(186, 'App\\Models\\User', 4, 'mobile', '4b68af4019ea131b5287355a4ea9023164c60c783a99c9a6cbbadea5eebb523f', '[\"*\"]', '2025-05-08 21:02:00', NULL, '2025-05-08 21:01:58', '2025-05-08 21:02:00'),
(187, 'App\\Models\\User', 4, 'mobile', 'f46877cd009d941b7a4f54a505f77394f88f13ffedeba62f80534812ae08174a', '[\"*\"]', '2025-05-08 21:02:24', NULL, '2025-05-08 21:02:17', '2025-05-08 21:02:24'),
(188, 'App\\Models\\User', 31, 'mobile', 'ce0ccb1270683f404151f82bc1e3471210307e2e0cc52e345191c593fb42b26a', '[\"*\"]', '2025-05-08 21:03:13', NULL, '2025-05-08 21:03:10', '2025-05-08 21:03:13'),
(189, 'App\\Models\\User', 31, 'mobile', '60c84702b7966bd7e102d01a0612ef218868bf5674d1b3b2642e310f2e1952a7', '[\"*\"]', '2025-05-08 21:04:06', NULL, '2025-05-08 21:04:02', '2025-05-08 21:04:06'),
(190, 'App\\Models\\User', 4, 'mobile', '12379b964ec5072daf187908d4b5fcff48a019f34b940aa8709f60930f40f23a', '[\"*\"]', '2025-05-08 21:06:17', NULL, '2025-05-08 21:04:48', '2025-05-08 21:06:17'),
(191, 'App\\Models\\User', 31, 'mobile', '3a35e209267b06a93e0bd94cd253c0b10fbb2d8d856d5eafec2570071dfe9586', '[\"*\"]', '2025-05-08 21:06:40', NULL, '2025-05-08 21:06:35', '2025-05-08 21:06:40'),
(192, 'App\\Models\\User', 31, 'mobile', 'c6a161306bce9b718c10d59fefeb0811e75acad4dd7744cca5c8f3894653ca42', '[\"*\"]', '2025-05-08 21:07:08', NULL, '2025-05-08 21:07:06', '2025-05-08 21:07:08'),
(193, 'App\\Models\\User', 4, 'mobile', '9deb7e853871d984b65471e3a607a541a38793109d24540a5673b84d381cf3b4', '[\"*\"]', '2025-05-08 21:07:34', NULL, '2025-05-08 21:07:31', '2025-05-08 21:07:34'),
(194, 'App\\Models\\User', 4, 'mobile', 'c798f58b9992a516ece6b8236ca031a19f0cf07e7c8ff5a0a3a51ffdbe55010d', '[\"*\"]', '2025-05-08 21:07:52', NULL, '2025-05-08 21:07:50', '2025-05-08 21:07:52'),
(195, 'App\\Models\\User', 4, 'mobile', '3618c7ff5513a1395567bf754e15add6977fe92e015030a611390652440db368', '[\"*\"]', '2025-05-08 21:09:44', NULL, '2025-05-08 21:09:39', '2025-05-08 21:09:44'),
(196, 'App\\Models\\User', 4, 'mobile', 'f42899ba95dd738cd35c0f577dcd15620142a165c532de3807a615a7567ae865', '[\"*\"]', '2025-05-08 21:26:53', NULL, '2025-05-08 21:10:21', '2025-05-08 21:26:53'),
(197, 'App\\Models\\User', 31, 'mobile', '12aecfe64b91a45b804462b960678c5c0c811b8899d53b0a57b601eb73f1588b', '[\"*\"]', '2025-05-08 22:00:26', NULL, '2025-05-08 21:27:05', '2025-05-08 22:00:26'),
(198, 'App\\Models\\User', 4, 'mobile', '338ff8bd3ca95718daa541c2b67b427af8367229b07f41f1ff7ca762d443d8f9', '[\"*\"]', NULL, NULL, '2025-05-08 21:41:20', '2025-05-08 21:41:20'),
(199, 'App\\Models\\User', 27, 'mobile', '9bd29c19ff78cc1233e4786c621466d6e040a1a8349deec422cc0ba6e11218f8', '[\"*\"]', '2025-05-08 22:39:54', NULL, '2025-05-08 21:44:39', '2025-05-08 22:39:54'),
(200, 'App\\Models\\User', 4, 'mobile', '7ea6ff70faac2cc5f89f8e3aa53416542b4bb12e8b67964588077e4c5216eb8e', '[\"*\"]', '2025-05-08 22:28:30', NULL, '2025-05-08 22:00:45', '2025-05-08 22:28:30'),
(201, 'App\\Models\\User', 31, 'mobile', '8be0ab5b0023e5cd6a206fb78fb6a52e89c13dad10a5f14b72a668abaf8cc301', '[\"*\"]', '2025-05-08 22:28:46', NULL, '2025-05-08 22:28:44', '2025-05-08 22:28:46'),
(202, 'App\\Models\\User', 31, 'mobile', 'b4fd55e636ffaef247444b4a7738addb337305c8b503c179c0c1f0d046891ea3', '[\"*\"]', '2025-05-08 23:27:32', NULL, '2025-05-08 22:42:07', '2025-05-08 23:27:32'),
(203, 'App\\Models\\User', 31, 'mobile', '3803523414983c8bc186c6b60a4d261f2253123cad03c311b384798a64d17961', '[\"*\"]', '2025-05-08 23:49:50', NULL, '2025-05-08 23:27:43', '2025-05-08 23:49:50'),
(204, 'App\\Models\\User', 31, 'mobile', '7c1dba0b37f5782509c413ce407d437cf6a22aae0f91da4e2107d02a09b4510c', '[\"*\"]', '2025-05-08 23:56:21', NULL, '2025-05-08 23:56:14', '2025-05-08 23:56:21'),
(205, 'App\\Models\\User', 4, 'mobile', '2ea32030c24e8117840b26cfb7fda7b44ad9844786c218d8603466bdb1614781', '[\"*\"]', '2025-05-08 23:58:36', NULL, '2025-05-08 23:58:34', '2025-05-08 23:58:36'),
(206, 'App\\Models\\User', 4, 'mobile', '606ee69353a0f9ba8aa34b47d7d883f19d6192f66848de2ba8b4f4c533b49420', '[\"*\"]', NULL, NULL, '2025-05-09 00:00:28', '2025-05-09 00:00:28'),
(207, 'App\\Models\\User', 4, 'mobile', 'd4ce911e4b43a216aa2023cb46836b6ab2886c3ed72ce3ecbf8ad57e9768e84f', '[\"*\"]', NULL, NULL, '2025-05-09 00:00:31', '2025-05-09 00:00:31'),
(208, 'App\\Models\\User', 4, 'mobile', 'cbec05bddc8fd57aedfbe372ccc37c706feb971ece229763cb088eec632c82e9', '[\"*\"]', NULL, NULL, '2025-05-09 00:00:32', '2025-05-09 00:00:32'),
(209, 'App\\Models\\User', 4, 'mobile', '129ffe5e864162e5ebef0f8348a55a8d56d07486590e2d998ccea90697a8bf3b', '[\"*\"]', NULL, NULL, '2025-05-09 00:00:34', '2025-05-09 00:00:34'),
(210, 'App\\Models\\User', 4, 'mobile', '7440896cd3e66b5354b4a7084425f99fb217178849063164833ae7ff701b50de', '[\"*\"]', NULL, NULL, '2025-05-09 00:00:36', '2025-05-09 00:00:36'),
(211, 'App\\Models\\User', 4, 'mobile', '1e992b2af8197a887312050255185daf1e16f4b9a4eb8792768e97398528d50e', '[\"*\"]', NULL, NULL, '2025-05-09 00:00:38', '2025-05-09 00:00:38'),
(212, 'App\\Models\\User', 4, 'mobile', '3c8da174397675d00a3488e075eee75e134c564be6daa49f74a52855f10fc2f0', '[\"*\"]', NULL, NULL, '2025-05-09 00:00:39', '2025-05-09 00:00:39'),
(213, 'App\\Models\\User', 4, 'mobile', '0af3ad0a2b1500c59238fefc4aa93dbbf630260eb21ded5045728c5684303e7e', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:09', '2025-05-09 00:01:09'),
(214, 'App\\Models\\User', 4, 'mobile', '486d6a45f8777fa0c2bce7de3bcb82b2d7832c21c3c519b14de07cc6aa2ee572', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:11', '2025-05-09 00:01:11'),
(215, 'App\\Models\\User', 4, 'mobile', 'ce91d0969a2e767064990cdfd05bede3acde2d30137696ad450bf1e02894bf9b', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:14', '2025-05-09 00:01:14'),
(216, 'App\\Models\\User', 4, 'mobile', '27db17417e9bbbf1c2b6c33e11d46be200d149f14554e7bc9fb9b8a09afc7c49', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:16', '2025-05-09 00:01:16'),
(217, 'App\\Models\\User', 4, 'mobile', '110f8a0438854f15aa30fd553b6d669a85f7e35e426c26cd14ed880503eae955', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:17', '2025-05-09 00:01:17'),
(218, 'App\\Models\\User', 4, 'mobile', '6eb6c0e83faac86f321e68bacd8174045f587b98c75acae4a5d3be5c959ab034', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:18', '2025-05-09 00:01:18'),
(219, 'App\\Models\\User', 4, 'mobile', '9c7c159e9119b67e0f7ac67d1420de86ffcf313da207209f0b1ba944f51be0b6', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:20', '2025-05-09 00:01:20'),
(220, 'App\\Models\\User', 4, 'mobile', 'fc84f52a5599b71ade2c0b2a17646c5a0b457ff736f77ed38b02cd799a243542', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:21', '2025-05-09 00:01:21'),
(221, 'App\\Models\\User', 4, 'mobile', '98d42d9205bddeced289e23ae7b2a18811740227489522db135326fb795e6f32', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:22', '2025-05-09 00:01:22'),
(222, 'App\\Models\\User', 4, 'mobile', '95d73bd8b7eb26bcb05bdb45be69f411667662e7bc4531cdb6dd7bfa8744f9cc', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:24', '2025-05-09 00:01:24'),
(223, 'App\\Models\\User', 4, 'mobile', 'beb2fed012e586379f6bcd47f0e40a34fb69a259e9a840f3c5a14221d5ccb82a', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:25', '2025-05-09 00:01:25'),
(224, 'App\\Models\\User', 4, 'mobile', '5a987fe7ad68b84c846e68b8362d2aef9800b2e77291f08ad2eeeaf27e5d8397', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:27', '2025-05-09 00:01:27'),
(225, 'App\\Models\\User', 4, 'mobile', '27ab52b0380b3b3af484b5d9fe4921788e8fa1a0e01c35395bfe798caf1828f2', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:28', '2025-05-09 00:01:28'),
(226, 'App\\Models\\User', 4, 'mobile', 'ee30584cb5e208be0927ff5eae35c26895d5f06d73377627e6293bf9d65a8f95', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:29', '2025-05-09 00:01:29'),
(227, 'App\\Models\\User', 4, 'mobile', 'f7955e4be666fd9f4f2b528e78fe1b9368c2977d52bd1a8ea3e1c8129ce546dc', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:30', '2025-05-09 00:01:30'),
(228, 'App\\Models\\User', 4, 'mobile', 'b1e55cd9f469d425d8cdcb8f5574c76b8f57b4287ec0d9c66cbc8184afa0adc5', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:32', '2025-05-09 00:01:32'),
(229, 'App\\Models\\User', 4, 'mobile', 'cc5ca6346a67e8a7aa383c30d066762970e912562d634ae40720b0fb974be32b', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:33', '2025-05-09 00:01:33'),
(230, 'App\\Models\\User', 4, 'mobile', 'a8a7c48f7f1886467dff1e04fcb2b79f9533028de2b44bd1415b6f0a53500ee0', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:35', '2025-05-09 00:01:35'),
(231, 'App\\Models\\User', 4, 'mobile', '369637302d610a0cf35db1806aa6837e7525f0686999f2e08717827300dffe5f', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:44', '2025-05-09 00:01:44'),
(232, 'App\\Models\\User', 4, 'mobile', '693b76e0ab689500fd54bc3ccef980c43d587f018c2e3ba43724d36c5b81fa96', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:46', '2025-05-09 00:01:46'),
(233, 'App\\Models\\User', 4, 'mobile', '773dbf6d1f14f7a213fdac98e8b5ea1f5f48c7046f3b86338f2a363f3b9abc75', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:47', '2025-05-09 00:01:47'),
(234, 'App\\Models\\User', 4, 'mobile', 'fef4dd20fcfee35b435b7b5e968fb34e6a99fddcdecd67c8224294211dc75bdb', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:48', '2025-05-09 00:01:48'),
(235, 'App\\Models\\User', 4, 'mobile', '48cd2e44bb351bf774d427edbba92cf36160b790b8516a5b42823152c4b30afa', '[\"*\"]', NULL, NULL, '2025-05-09 00:01:50', '2025-05-09 00:01:50'),
(236, 'App\\Models\\User', 4, 'mobile', '854b5540bb5ae5d25de743a1c01be06981737252c36e945d87d1ebe723ae4596', '[\"*\"]', NULL, NULL, '2025-05-09 00:05:53', '2025-05-09 00:05:53'),
(237, 'App\\Models\\User', 4, 'mobile', '760ef3f87ce21ac2083400764e00bc0c3668588b82eec2b19b2e2cf327df73e5', '[\"*\"]', NULL, NULL, '2025-05-09 00:06:15', '2025-05-09 00:06:15'),
(238, 'App\\Models\\User', 4, 'mobile', '599b29cb9fcd32851c3a81dc49fe19a5d4d344d5d32997333956b9a95e68cd42', '[\"*\"]', NULL, NULL, '2025-05-09 00:06:17', '2025-05-09 00:06:17'),
(239, 'App\\Models\\User', 4, 'mobile', '858ef2daf8d70086541994603b1f3fd235c3312d54f1ed1f5652190a05adaabb', '[\"*\"]', NULL, NULL, '2025-05-09 00:06:18', '2025-05-09 00:06:18'),
(240, 'App\\Models\\User', 4, 'mobile', 'c29092d651461c98b79d66e7a38b615719da4c2ea4ac85ae2280e7e343a446c1', '[\"*\"]', '2025-05-09 00:09:20', NULL, '2025-05-09 00:06:20', '2025-05-09 00:09:20'),
(241, 'App\\Models\\User', 4, 'mobile', 'd099ced68c2897f0e34b7ce306f765c3bbc4c0c5f745874c19f5e923bab13c6c', '[\"*\"]', NULL, NULL, '2025-05-09 00:06:22', '2025-05-09 00:06:22'),
(242, 'App\\Models\\User', 4, 'mobile', '4aa0def3ad17a427f44fb0a4975aeb1b9be682efbbe2385693a0ff58be78ff5f', '[\"*\"]', NULL, NULL, '2025-05-09 00:09:08', '2025-05-09 00:09:08'),
(243, 'App\\Models\\User', 4, 'mobile', '9f48fff4144fabafb3f091d1e36ead84684acfd7ebb4e6c619bc37ee4715c9f2', '[\"*\"]', NULL, NULL, '2025-05-09 00:09:15', '2025-05-09 00:09:15'),
(244, 'App\\Models\\User', 4, 'mobile', '91da3fa0163cdacf21e45dfcd5997b6ff382a89f270ce70c76d31556da5baddf', '[\"*\"]', '2025-05-09 01:16:28', NULL, '2025-05-09 00:18:35', '2025-05-09 01:16:28'),
(245, 'App\\Models\\User', 4, 'mobile', '6fff51e7f5e5f983259c6ace00e7b88c24234afa7b8d013b582adfa5321015d1', '[\"*\"]', '2025-05-09 00:23:17', NULL, '2025-05-09 00:23:16', '2025-05-09 00:23:17'),
(246, 'App\\Models\\User', 4, 'mobile', 'cfc3681a75d7819cbeea8b60945029d2f4727d4c0831ee1350f4040aaade55d3', '[\"*\"]', '2025-05-09 00:23:41', NULL, '2025-05-09 00:23:39', '2025-05-09 00:23:41'),
(247, 'App\\Models\\User', 4, 'mobile', '15ed0122a150dbd7bcd5c128f9ad84b3a494007761502632b68a154e1beba884', '[\"*\"]', '2025-05-09 00:23:53', NULL, '2025-05-09 00:23:51', '2025-05-09 00:23:53'),
(248, 'App\\Models\\User', 4, 'mobile', '16be8d2704afb38c388160c1b0fc7a0050e42bb7577b33f443d8dd03720f8fa5', '[\"*\"]', '2025-05-09 00:24:01', NULL, '2025-05-09 00:23:59', '2025-05-09 00:24:01'),
(249, 'App\\Models\\User', 4, 'mobile', 'ef66bbb2123183d6b26cbdc598d2fd6aa4f78f43db93dd50ec699e5fcb023ee2', '[\"*\"]', '2025-05-09 00:24:10', NULL, '2025-05-09 00:24:08', '2025-05-09 00:24:10'),
(250, 'App\\Models\\User', 4, 'mobile', '37c1abb6e135755252dd1f94a1b92dc2e883ac9fc6369711272c82cd74ef683e', '[\"*\"]', '2025-05-09 00:24:18', NULL, '2025-05-09 00:24:16', '2025-05-09 00:24:18'),
(251, 'App\\Models\\User', 4, 'mobile', 'f0cee1e024966d793c4eb02bfc6af2350502f54495dff490c7ef41b24a2554f1', '[\"*\"]', '2025-05-09 00:24:26', NULL, '2025-05-09 00:24:24', '2025-05-09 00:24:26'),
(252, 'App\\Models\\User', 4, 'mobile', 'df148d58d7790fe806635e18d53b769d3e034d9c61f79131d3fa55000daf1831', '[\"*\"]', '2025-05-09 00:24:37', NULL, '2025-05-09 00:24:35', '2025-05-09 00:24:37'),
(253, 'App\\Models\\User', 4, 'mobile', 'b94f3ba8a203ea5db04aaccd2c28bad29aba55e4827eed2f064f231d125ac112', '[\"*\"]', '2025-05-09 00:24:46', NULL, '2025-05-09 00:24:44', '2025-05-09 00:24:46'),
(254, 'App\\Models\\User', 4, 'mobile', '3efedbfe5d375681c1675e03a049c74563d30b945b4837d540d8391cddbcbdbd', '[\"*\"]', '2025-05-09 00:24:53', NULL, '2025-05-09 00:24:51', '2025-05-09 00:24:53'),
(255, 'App\\Models\\User', 4, 'mobile', '3d5549c52e2aa09f75abf5605e76296bc89880588130e42b54367b3f5cc16924', '[\"*\"]', '2025-05-09 00:25:01', NULL, '2025-05-09 00:24:59', '2025-05-09 00:25:01'),
(256, 'App\\Models\\User', 31, 'mobile', '8d73ff16aecba2832ab37a0714de0c299e54db5c91b22d786d2fe6ae4802a6e7', '[\"*\"]', '2025-05-09 00:25:19', NULL, '2025-05-09 00:25:17', '2025-05-09 00:25:19'),
(257, 'App\\Models\\User', 4, 'mobile', '190bfc0731eac9b3b4ec3cac4e8e801e6c9cc873ec2481fe3c6e791af8ec10c0', '[\"*\"]', '2025-05-09 00:25:34', NULL, '2025-05-09 00:25:32', '2025-05-09 00:25:34'),
(258, 'App\\Models\\User', 4, 'mobile', 'a0e89c0e857f95b977624b3aeb356e08290091bc3d175b4fa8371ad6a10c69a8', '[\"*\"]', '2025-05-09 00:25:45', NULL, '2025-05-09 00:25:43', '2025-05-09 00:25:45'),
(259, 'App\\Models\\User', 4, 'mobile', '743576a94f7850b6e6a4cb667d31d5e336d15f4f0357cf48464675742e86dcdf', '[\"*\"]', '2025-05-09 00:25:50', NULL, '2025-05-09 00:25:48', '2025-05-09 00:25:50'),
(260, 'App\\Models\\User', 4, 'mobile', '8d7fecf9950b6b653fbe573188764165f19395df66b2ca32064fcef997e93083', '[\"*\"]', '2025-05-09 00:25:56', NULL, '2025-05-09 00:25:54', '2025-05-09 00:25:56'),
(261, 'App\\Models\\User', 31, 'mobile', '93228f0f554c4c01b3db40773141b50061fda603b43a4c1cfa98d23493396e86', '[\"*\"]', '2025-05-09 00:26:06', NULL, '2025-05-09 00:26:04', '2025-05-09 00:26:06'),
(262, 'App\\Models\\User', 4, 'mobile', '9abb72af3e2e565bb3f836348797c9afc2f2b744539b0f78c920450bf64cab42', '[\"*\"]', '2025-05-09 00:26:24', NULL, '2025-05-09 00:26:22', '2025-05-09 00:26:24'),
(263, 'App\\Models\\User', 4, 'mobile', 'd158fb538b09e0ca2d3dcaef9e632ee8baa2cb4bcbfd25f39791517609f43076', '[\"*\"]', '2025-05-09 00:26:32', NULL, '2025-05-09 00:26:30', '2025-05-09 00:26:32'),
(264, 'App\\Models\\User', 4, 'mobile', '9a2f9b6734d9fcd10c00ff57110231eaf52e77b613f771d99ea56f0f27644a41', '[\"*\"]', '2025-05-09 00:26:44', NULL, '2025-05-09 00:26:42', '2025-05-09 00:26:44'),
(265, 'App\\Models\\User', 4, 'mobile', '971b25305714bfe5897f495472be8d518beae0f8cbb51d7a2ac15689a5332f36', '[\"*\"]', '2025-05-09 00:26:53', NULL, '2025-05-09 00:26:51', '2025-05-09 00:26:53');
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(266, 'App\\Models\\User', 4, 'mobile', 'feeefc3a9392b62608b0f89cbf090d971f52f5c756e8849899c8da75e25d2258', '[\"*\"]', '2025-05-09 00:27:04', NULL, '2025-05-09 00:27:02', '2025-05-09 00:27:04'),
(267, 'App\\Models\\User', 4, 'mobile', '2e409a4a31dbb89279eac4dbba08854efe17109822d34eefadc5117fd0bf8522', '[\"*\"]', '2025-05-09 01:27:48', NULL, '2025-05-09 01:17:30', '2025-05-09 01:27:48'),
(268, 'App\\Models\\User', 4, 'mobile', '28510ef1300963b6ff4b297192046e7525bedf7af847fafd4a3f2df39de00ea1', '[\"*\"]', NULL, NULL, '2025-05-09 01:19:00', '2025-05-09 01:19:00'),
(269, 'App\\Models\\User', 4, 'mobile', '212a9fe230cff4fb593b87790c1094e25c38ab8bd2b779b050462f0e6bf36293', '[\"*\"]', NULL, NULL, '2025-05-09 01:26:07', '2025-05-09 01:26:07'),
(270, 'App\\Models\\User', 4, 'mobile', '734688b20a4f370dd7190594bd32d7475932205c317961404d70d33b5f1f2cd2', '[\"*\"]', '2025-05-09 17:25:21', NULL, '2025-05-09 01:27:53', '2025-05-09 17:25:21'),
(271, 'App\\Models\\User', 27, 'mobile', '9358bdff6da9aebbdff2f0a99843b4c84da50c7b8b52ee3da9288772be2a4b96', '[\"*\"]', NULL, NULL, '2025-05-09 17:02:23', '2025-05-09 17:02:23'),
(272, 'App\\Models\\User', 4, 'mobile', '84b6dc7ce718afd1f947c5ba0e6898448ffad7fbb43813a8a0a44056cb6b6248', '[\"*\"]', NULL, NULL, '2025-05-09 17:10:57', '2025-05-09 17:10:57'),
(273, 'App\\Models\\User', 4, 'mobile', '7c18896aacd6d339c9816929c028a2562d1fc8e7f5e89bd66b5b9d61afbd7b2f', '[\"*\"]', '2025-05-09 17:42:27', NULL, '2025-05-09 17:30:53', '2025-05-09 17:42:27'),
(274, 'App\\Models\\User', 4, 'mobile', 'bbf39876d4bc8cf37254b10c1e2ac1463c4efe30d4043b4ec225ab4c6fe9ebf6', '[\"*\"]', NULL, NULL, '2025-05-09 17:36:00', '2025-05-09 17:36:00'),
(275, 'App\\Models\\User', 4, 'mobile', '98b504e50a778aec00fd2103dfbb5e39934d0f46dcb60d15f21c2bd04450d30e', '[\"*\"]', '2025-05-09 17:42:43', NULL, '2025-05-09 17:42:41', '2025-05-09 17:42:43'),
(276, 'App\\Models\\User', 4, 'mobile', '7d7230034abf74d90c7500fbd95d79538f6ebffa5cfaf9d8173a7c5d527f290b', '[\"*\"]', '2025-05-09 18:01:17', NULL, '2025-05-09 17:45:36', '2025-05-09 18:01:17'),
(277, 'App\\Models\\User', 4, 'mobile', 'a7d564ea5d25104a8f6fafccbbc913be97d1f0b893bf56c730c027ac2095cb19', '[\"*\"]', NULL, NULL, '2025-05-09 18:00:13', '2025-05-09 18:00:13'),
(278, 'App\\Models\\User', 4, 'mobile', '19efdcf578c9b04ab9338d3572ea458a26b4fe18a434878010ee7d75f88e232b', '[\"*\"]', NULL, NULL, '2025-05-09 18:00:58', '2025-05-09 18:00:58'),
(279, 'App\\Models\\User', 4, 'mobile', 'ff178df114c423c0e4fe36565f0a7e297286a54f3599929fa4abc8409b4ca600', '[\"*\"]', NULL, NULL, '2025-05-09 18:01:20', '2025-05-09 18:01:20'),
(280, 'App\\Models\\User', 4, 'mobile', '985f47bbaf9dfba88418eee0f6f5585fa68d4083600a90cc5e84fcccc922a685', '[\"*\"]', '2025-05-09 18:10:05', NULL, '2025-05-09 18:09:43', '2025-05-09 18:10:05'),
(281, 'App\\Models\\User', 38, 'mobile', '9c0024bb0dcc59f7f683df0c6b16882557cda1a6b10009782992fb1b129aae56', '[\"*\"]', NULL, NULL, '2025-05-09 18:18:57', '2025-05-09 18:18:57'),
(282, 'App\\Models\\User', 31, 'mobile', '4650b0bc87a55669e9ca53b5e526698e677ab6bd0a8e13b518aee62459f5df50', '[\"*\"]', '2025-05-09 18:24:37', NULL, '2025-05-09 18:23:27', '2025-05-09 18:24:37'),
(283, 'App\\Models\\User', 39, 'mobile', 'b4f03063093fc7def3a777d27e67a54840eaea82811200775a9bff92d96218c7', '[\"*\"]', '2025-05-09 18:24:53', NULL, '2025-05-09 18:24:52', '2025-05-09 18:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `square_user_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` text DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` text DEFAULT NULL,
  `ref_id` varchar(255) NOT NULL,
  `invited_ref_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`invited_ref_ids`)),
  `status` varchar(255) DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `square_user_id`, `name`, `first_name`, `last_name`, `email`, `avatar`, `phone_number`, `password`, `remember_token`, `ref_id`, `invited_ref_ids`, `status`, `created_at`, `updated_at`) VALUES
(1, '63FPMPDEHG3BWF7RXZTGQ29PY4', 'Testerold', '', '', 'tester285@example.com', NULL, '+17787646674', '$2y$10$b2fL3kg8MYptUFfNtnFgYOI4kZxCvEw/Rrt23sM7D0iQCGynfkq1i', NULL, 'ref-223697', '\"[]\"', 'active', '2025-05-02 21:22:31', '2025-05-02 21:22:31'),
(2, 'Y0891M5WEFYW8W4XPDEMX6YQ1G', 'naveed', '', '', 'tester12345@example.com', NULL, '+17787646179', '$2y$10$Nn/w7JwEeRpVKOmUmQMCMevP3I4uC1TOkWZRk.f0vSR/2jzJrKayC', NULL, 'ref-141368', '\"[]\"', 'active', '2025-05-02 21:33:58', '2025-05-02 21:33:58'),
(3, 'ADH5F0QBKNW6T9BMKB8P7GM2FC', 'naveed', '', '', 'tester1235@example.com', NULL, '+17787648179', '$2y$10$M.ygw9k.IZ0cs1cddMlOPOUTnpKfjD7tspmAbYK3R.0sttUnJjgD6', NULL, 'ref-860092', '\"[\\\"ref-570509\\\"]\"', 'active', '2025-05-02 21:36:04', '2025-05-02 21:44:19'),
(5, 'E6DBFWGAXMX2ED7KN0CNB0HPXR', 'Testerold', '', '', 'tester289@example.com', NULL, '+17782646674', '$2y$10$jPuScpIBIucjuTjS4D5f3ua75b4u81EYC616sBfCSWN7OeXy0SRiy', NULL, 'ref-162689', '\"[]\"', 'active', '2025-05-03 00:50:44', '2025-05-03 00:50:45'),
(6, 'JCF1ZBSH4V9YEM4101EF8ZSFK0', 'kkj', '', '', 'kkkk@gmail.com', NULL, '+923103443529', '$2y$10$9bd5LY2AgDAwQH7aQegijuXW9bc4sWQoYQge1opj7Ld1LO8itwN.W', NULL, 'ref-200806', '\"[]\"', 'active', '2025-05-03 00:52:42', '2025-05-03 00:52:43'),
(7, '0X207KQHNR1J557J0KVQJ8E3KM', 'nai', '', '', 'navi@gmail.com', NULL, '+923422179918', '$2y$10$WCIaq5ePyJ3sT8sv187BEOaaUXnhaG19CUxeAiIyghj86Cd5Cutne', NULL, 'ref-630027', '\"[]\"', 'active', '2025-05-03 02:08:27', '2025-05-03 02:08:27'),
(9, 'WCJEXG00QEP13MBXS6G6AM2KGW', 'naviii', '', '', 'kkakberr@gmail.com', NULL, '+19724218407', '$2y$10$Qv2iq3nnbq9ikfzcuYbL6eCtyCllaINjx8oVy..jh7EEX/wj1bwP.', NULL, 'ref-896023', '\"[]\"', 'active', '2025-05-03 02:26:05', '2025-05-03 02:26:06'),
(12, 'VJFKS88K5M6YB5102PP7GB96M8', 'faq', '', '', 'faizantester22@gmail.com', NULL, '+17787646178', '$2y$10$PU6XxE2G1y1Nvi8aA4A7pOuZaBJY2pgHahT9ZrP7oUWrX6zD6DRCG', NULL, 'ref-218711', '\"[\\\"ref-814953\\\",\\\"ref-853409\\\"]\"', 'active', '2025-05-03 02:35:31', '2025-05-03 02:38:01'),
(13, 'W1238BY0E9348ZXE25G5YPFX3M', 'awais', '', '', 'awiastester22@gmail.com', NULL, '+17787646199', '$2y$10$rPf6/Ex/GplFJo7T8Au8y.ipBuVUeFfgZclZLo0mETQwoj.B2qdvS', NULL, 'ref-814953', '\"[]\"', 'active', '2025-05-03 02:37:12', '2025-05-03 02:37:12'),
(14, '4WF3BBFK66E46101ETHY5BRV30', 'absaar', '', '', 'absaartester22@gmail.com', NULL, '+17787646449', '$2y$10$iAPROuISuv2vXUn/qNVDC.WpKu.dX0/gm4yuiZwX4worRrKG.tAoG', NULL, 'ref-853409', '\"[]\"', 'active', '2025-05-03 02:38:01', '2025-05-03 02:38:01'),
(24, 'VFZJW2Z99PG075W1NHSB7B2GR8', 'Testerold', '', '', 'kknaveed@example.com', NULL, '+923105553528', '$2y$10$VTaJ9Fz3JNTrNVHEBk23Pe5Ms7VZf4dXvPcpvWscPh4XVu6RmmEZW', NULL, 'ref-720277', '\"[]\"', 'active', '2025-05-03 03:18:16', '2025-05-03 03:18:16'),
(25, '3G4PGQVF7K56BNPCWEXB77C3MG', 'David Billings', 'David', 'Billings', 'greenswooper@gmail.com', NULL, '+17203522151', '$2y$10$C7umc/v0vqlwxv/FaumUou6ZizMZzET7nAcK8CcglUv/0m4Se7ixW', NULL, 'ref-139438', '\"[]\"', 'active', '2025-05-06 17:00:46', '2025-05-06 17:00:46'),
(26, 'WSVB47KM57WKE8QZJZ0MW64RSW', 'nn', '', '', 'kkkhan123@gmail.com', NULL, '+923199306634', '$2y$10$9hVnRO8HEbvHwaTW/knBGu/STGopUpD05a.YKsRRXImhudQ05ChMq', NULL, 'ref-403333', '\"[]\"', 'active', '2025-05-06 18:40:58', '2025-05-06 18:40:58'),
(27, 'SFG01ZAP2TXT2FG8FDM9YP89GW', 'Shahbaz Musheer', 'Shahbaz', 'Musheer', 'shahbazmushir@gmail.com', NULL, '+92303-5515123', '$2y$10$0W7k6egGw9RAaYUcW9D9Beg7bQNb2fUKYXTI46gb7Q8W7OwWOc0wq', 'szoxb5s5ueXlm8J1HtLadaQVIVdxW4pQqSNh4iFX781ns5MLfJjeVk16luRE', 'ref-416176', '\"[]\"', 'active', '2025-05-06 21:12:12', '2025-05-06 21:21:59'),
(28, 'EDY058XHDDE4YCTMF8GDCHJ9KR', 'Shahbaz Vidicraze', '', '', 'shahbazvidicraze@gmail.com', NULL, '+923334353545', '$2y$10$3OOnk96H6tVgJJNBXocTXe.cD1iefpM//VNeaTI/CP.bycgDCcv.2', NULL, 'ref-353884', '\"[]\"', 'active', '2025-05-07 18:39:22', '2025-05-07 18:39:23'),
(29, 'C7AGAHT2J6N9YBAVE3YWC39GW0', 'nav qk', 'nav', 'qk', 'qkk@gmail.com', NULL, '+923166571908', '$2y$10$DWVIvmDtngbVpRNLJhkn6OuFF8lwP/IwZmAVi1HnV/8D/kX0EQVNu', NULL, 'ref-401145', '\"[]\"', 'active', '2025-05-08 01:03:28', '2025-05-08 01:03:28'),
(32, 'SGNV2BRC52H01W2N4AVC31ER6C', 'David Billings', 'David', 'Billings', 'skydivingrental@gmail.com', NULL, '+13033568628', '$2y$10$OVvtUjtgwxkH3PJBE0DOOu8M5/3QvX8Pz8aq7Ud/U3u7yEX7HZcmK', NULL, 'ref-422266', '\"[]\"', 'active', '2025-05-08 18:45:37', '2025-05-08 18:45:38'),
(38, '86ECVENN0ZD98MASQCPYH2GBRR', 'messi khan', 'messi', 'khan', 'mesikhan@gmail.com', NULL, '+17759833306', '$2y$10$Nb20nT2xXzk9uNmolEYb/.EL1IOwFAvPZlQm9eDFk05LV6FB5Th2W', NULL, 'ref-491918', '\"[]\"', 'active', '2025-05-09 18:18:56', '2025-05-09 18:18:57'),
(39, 'NAQ1ZB0PBNQ75SSKNA18EKGZT8', 'kk khan', 'kk', 'khan', 'kkkhan@gmail.com', NULL, '+923103443527', '$2y$10$oFpV7guMSqLeub38fd7IWuH20VjhazFFQ/iLv2i2dDSbZgwT8GM0a', NULL, 'ref-580933', '\"[]\"', 'active', '2025-05-09 18:24:51', '2025-05-09 18:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_awardeds`
--

CREATE TABLE `user_awardeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `points` int(11) NOT NULL,
  `discount` double(8,2) NOT NULL,
  `coupon_value` double(8,2) NOT NULL,
  `square_discount_id` varchar(255) DEFAULT NULL,
  `status` enum('active','used','expired') NOT NULL DEFAULT 'active',
  `expiry_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_awardeds`
--

INSERT INTO `user_awardeds` (`id`, `coupon_code`, `user_id`, `points`, `discount`, `coupon_value`, `square_discount_id`, `status`, `expiry_date`, `created_at`, `updated_at`) VALUES
(1, 'OSCGJV92', 3, 22, 3.00, 0.66, NULL, 'active', '2025-06-02 19:41:53', '2025-05-03 19:41:53', '2025-05-03 19:41:53'),
(2, 'FMCNHU2E', 4, 1200, 30.00, 360.00, NULL, 'active', '2025-06-02 21:17:06', '2025-05-03 21:17:06', '2025-05-03 21:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_referrals`
--

CREATE TABLE `user_referrals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `referral_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_referrals`
--

INSERT INTO `user_referrals` (`id`, `user_id`, `referral_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 13, 12, 'approved', '2025-05-03 02:37:12', '2025-05-03 21:54:49'),
(4, 14, 12, 'pending', '2025-05-03 02:38:01', '2025-05-03 02:38:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_square_user_id_unique` (`square_user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`),
  ADD UNIQUE KEY `users_ref_id_unique` (`ref_id`);

--
-- Indexes for table `user_awardeds`
--
ALTER TABLE `user_awardeds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_coupon_code_unique` (`coupon_code`);

--
-- Indexes for table `user_referrals`
--
ALTER TABLE `user_referrals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_referrals_user_id_foreign` (`user_id`),
  ADD KEY `user_referrals_referral_id_foreign` (`referral_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user_awardeds`
--
ALTER TABLE `user_awardeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_referrals`
--
ALTER TABLE `user_referrals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_referrals`
--
ALTER TABLE `user_referrals`
  ADD CONSTRAINT `user_referrals_referral_id_foreign` FOREIGN KEY (`referral_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_referrals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
