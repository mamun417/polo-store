-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 24, 2021 at 08:09 AM
-- Server version: 5.7.23-23
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devxh2dl_polo-store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'if you need in future add to role',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@test.com', NULL, '$2y$10$n98fwbdDsyerz96i.LmO5OPeqxul49Vv0BRu8dTO1jSLI9HwVzO7.', NULL, NULL, '2021-01-17 08:14:49', '2021-01-17 08:14:49');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `web_url`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Gucchi', 'gucchi', NULL, 'lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem <br>', 1, 1, 1, '2021-01-17 18:12:44', '2021-01-19 17:57:31'),
(2, 'Lotto', 'lotto', NULL, 'lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem <br>', 1, 1, 1, '2021-01-17 18:13:20', '2021-01-19 17:57:10'),
(3, 'POLO', 'polo', NULL, 'lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem <br>', 1, 1, 1, '2021-01-17 18:13:47', '2021-01-19 17:56:55');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 0, 'Shirt', 'shirt', NULL, 1, 1, 1, '2021-01-17 18:10:15', '2021-01-17 18:10:15'),
(2, 0, 'Pant', 'pant', NULL, 1, 1, 1, '2021-01-17 18:10:26', '2021-01-17 18:10:26'),
(3, 0, 'Bengal', 'bengal', NULL, 1, 1, 1, '2021-01-17 18:10:41', '2021-01-17 18:10:41'),
(4, 0, 'Man', 'man', NULL, 1, 1, 1, '2021-01-17 18:11:15', '2021-01-17 18:11:15'),
(5, 0, 'women', 'women', NULL, 1, 1, 1, '2021-01-17 18:11:34', '2021-01-17 18:11:34'),
(6, 0, 'kids', 'kids', NULL, 1, 1, 1, '2021-01-17 18:11:43', '2021-01-17 18:32:48'),
(7, 5, 'Workout', 'workout', NULL, 1, 1, 1, '2021-01-17 18:15:45', '2021-01-17 18:15:45'),
(8, 5, 'T-Shirts & Tops', 't-shirts-&-tops', NULL, 1, 1, 1, '2021-01-17 18:16:16', '2021-01-17 18:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `usable_quantity` int(11) DEFAULT NULL COMMENT 'how many time you can use it',
  `count` int(11) DEFAULT NULL COMMENT 'how many time this coupon is used',
  `started_at` date NOT NULL,
  `expired_at` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'you can save location of image',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imageable_id` int(11) NOT NULL,
  `imageable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `url`, `base_path`, `type`, `imageable_id`, `imageable_type`, `created_at`, `updated_at`) VALUES
(1, 'https://polo-store.devxhub.com//storage/uploads/admin_profile_images/1611080780-84x84-33b869f90619e81763dbf1fccc896d8d.jpg', 'uploads/admin_profile_images/1611080780-84x84-33b869f90619e81763dbf1fccc896d8d.jpg', 'sm', 1, 'App\\Models\\Admin', '2021-01-17 08:14:49', '2021-01-19 18:26:20'),
(2, 'https://polo-store.devxhub.com//storage/uploads/sliders/1611219886-1200x500-slider-111.jpg', 'uploads/sliders/1611219886-1200x500-slider-111.jpg', 'lg', 1, 'App\\Models\\Slider', '2021-01-17 18:18:38', '2021-01-21 09:04:46'),
(7, 'https://polo-store.devxhub.com//storage/uploads/products/1610908481-716x930-7277_fl.jpg', 'uploads/products/1610908481-716x930-7277_fl.jpg', 'lg', 3, 'App\\Models\\Product', '2021-01-17 18:34:41', '2021-01-17 18:34:41'),
(8, 'https://polo-store.devxhub.com//storage/uploads/products/1610908481-716x930-74623_b_fl.jpg', 'uploads/products/1610908481-716x930-74623_b_fl.jpg', 'lg', 3, 'App\\Models\\Product', '2021-01-17 18:34:41', '2021-01-17 18:34:41'),
(9, 'https://polo-store.devxhub.com//storage/uploads/products/1610908496-716x930-4.jpeg', 'uploads/products/1610908496-716x930-4.jpeg', 'lg', 2, 'App\\Models\\Product', '2021-01-17 18:34:56', '2021-01-17 18:34:56'),
(10, 'https://polo-store.devxhub.com//storage/uploads/products/1610908496-716x930-3.jpeg', 'uploads/products/1610908496-716x930-3.jpeg', 'lg', 2, 'App\\Models\\Product', '2021-01-17 18:34:56', '2021-01-17 18:34:56'),
(11, 'https://polo-store.devxhub.com//storage/uploads/sliders/1611218735-1200x500-food-drink01_1280x.jpg', 'uploads/sliders/1611218735-1200x500-food-drink01_1280x.jpg', 'lg', 2, 'App\\Models\\Slider', '2021-01-17 18:36:15', '2021-01-21 08:45:36'),
(12, 'https://polo-store.devxhub.com//storage/uploads/sliders/1611218896-1200x500-alphacolor-r6RCPk1X91c-unsplash.jpg', 'uploads/sliders/1611218896-1200x500-alphacolor-r6RCPk1X91c-unsplash.jpg', 'lg', 3, 'App\\Models\\Slider', '2021-01-17 18:37:21', '2021-01-21 08:48:19'),
(13, 'https://polo-store.devxhub.com//storage/uploads/products/1610908725-716x930-3464_fl.jpg', 'uploads/products/1610908725-716x930-3464_fl.jpg', 'lg', 4, 'App\\Models\\Product', '2021-01-17 18:38:45', '2021-01-17 18:38:45'),
(14, 'https://polo-store.devxhub.com//storage/uploads/products/1610908725-716x930-42677_b_fl.jpg', 'uploads/products/1610908725-716x930-42677_b_fl.jpg', 'lg', 4, 'App\\Models\\Product', '2021-01-17 18:38:45', '2021-01-17 18:38:45'),
(15, 'https://polo-store.devxhub.com//storage/uploads/products/1610908725-716x930-42677_fl.jpg', 'uploads/products/1610908725-716x930-42677_fl.jpg', 'lg', 4, 'App\\Models\\Product', '2021-01-17 18:38:45', '2021-01-17 18:38:45'),
(16, 'https://polo-store.devxhub.com//storage/uploads/products/1610908787-716x930-2.png', 'uploads/products/1610908787-716x930-2.png', 'lg', 2, 'App\\Models\\Product', '2021-01-17 18:39:48', '2021-01-17 18:39:48'),
(17, 'https://polo-store.devxhub.com//storage/uploads/products/1610908788-716x930-1.jpeg', 'uploads/products/1610908788-716x930-1.jpeg', 'lg', 2, 'App\\Models\\Product', '2021-01-17 18:39:48', '2021-01-17 18:39:48'),
(18, 'https://polo-store.devxhub.com//storage/uploads/sliders/1611218843-1200x500-c-d-x-PDX_a_82obo-unsplash.jpg', 'uploads/sliders/1611218843-1200x500-c-d-x-PDX_a_82obo-unsplash.jpg', 'lg', 4, 'App\\Models\\Slider', '2021-01-17 18:40:24', '2021-01-21 08:47:25'),
(19, 'https://polo-store.devxhub.com//storage/uploads/sliders/1611219037-1200x500-shiwa-id-Bajw65b3mXo-unsplash.jpg', 'uploads/sliders/1611219037-1200x500-shiwa-id-Bajw65b3mXo-unsplash.jpg', 'lg', 5, 'App\\Models\\Slider', '2021-01-17 18:40:44', '2021-01-21 08:50:38'),
(20, 'https://polo-store.devxhub.com//storage/uploads/products/1610908875-716x930-6.jpeg', 'uploads/products/1610908875-716x930-6.jpeg', 'lg', 1, 'App\\Models\\Product', '2021-01-17 18:41:15', '2021-01-17 18:41:15'),
(21, 'https://polo-store.devxhub.com//storage/uploads/products/1610908875-716x930-5.jpeg', 'uploads/products/1610908875-716x930-5.jpeg', 'lg', 1, 'App\\Models\\Product', '2021-01-17 18:41:15', '2021-01-17 18:41:15'),
(22, 'https://polo-store.devxhub.com//storage/uploads/products/1610908875-716x930-4.jpeg', 'uploads/products/1610908875-716x930-4.jpeg', 'lg', 1, 'App\\Models\\Product', '2021-01-17 18:41:15', '2021-01-17 18:41:15'),
(23, 'https://polo-store.devxhub.com//storage/uploads/products/1610908875-716x930-3.jpeg', 'uploads/products/1610908875-716x930-3.jpeg', 'lg', 1, 'App\\Models\\Product', '2021-01-17 18:41:15', '2021-01-17 18:41:15'),
(24, 'https://polo-store.devxhub.com//storage/uploads/logos/1610909506-350x89-logo.png', 'uploads/logos/1610909506-350x89-logo.png', 'logo', 1, 'App\\Models\\Setting', '2021-01-17 18:51:46', '2021-01-17 18:51:46'),
(25, 'https://polo-store.devxhub.com//storage/uploads/logos/1610909506-350x89-footer-logo.png', 'uploads/logos/1610909506-350x89-footer-logo.png', 'footer_logo', 1, 'App\\Models\\Setting', '2021-01-17 18:51:46', '2021-01-17 18:51:46'),
(28, 'https://polo-store.devxhub.com//storage/uploads/users/1610910961-96x96-baby-cart.png', 'uploads/users/1610910961-96x96-baby-cart.png', 'user_pic', 3, 'App\\Models\\User', '2021-01-17 19:16:01', '2021-01-17 19:16:01'),
(29, 'https://polo-store.devxhub.com//storage/uploads/users/1610910977-96x96-7277_fl.jpg', 'uploads/users/1610910977-96x96-7277_fl.jpg', 'user_pic', 6, 'App\\Models\\User', '2021-01-17 19:16:17', '2021-01-17 19:16:17'),
(30, 'https://polo-store.devxhub.com//storage/uploads/products/1610911208-716x930-i1.png', 'uploads/products/1610911208-716x930-i1.png', 'lg', 5, 'App\\Models\\Product', '2021-01-17 19:20:08', '2021-01-17 19:20:08'),
(31, 'https://polo-store.devxhub.com//storage/uploads/products/1610911208-716x930-i2.png', 'uploads/products/1610911208-716x930-i2.png', 'lg', 5, 'App\\Models\\Product', '2021-01-17 19:20:09', '2021-01-17 19:20:09'),
(32, 'https://polo-store.devxhub.com//storage/uploads/products/1610911209-716x930-i3.png', 'uploads/products/1610911209-716x930-i3.png', 'lg', 5, 'App\\Models\\Product', '2021-01-17 19:20:09', '2021-01-17 19:20:09'),
(39, 'https://polo-store.devxhub.com//storage/uploads/users/1611065282-96x96-83-838381_html-wallpaper-background-code-coding-tags.jpg', 'uploads/users/1611065282-96x96-83-838381_html-wallpaper-background-code-coding-tags.jpg', 'user_pic', 1, 'App\\Models\\User', '2021-01-19 14:08:03', '2021-01-19 14:08:03'),
(53, 'https://polo-store.devxhub.com//storage/uploads/products/1611217551-716x930-sneakers_16_2.jpg', 'uploads/products/1611217551-716x930-sneakers_16_2.jpg', 'lg', 17, 'App\\Models\\Product', '2021-01-21 08:25:52', '2021-01-21 08:25:52'),
(54, 'https://polo-store.devxhub.com//storage/uploads/products/1611217658-716x930-c-d-x-5qT09yIbROk-unsplash.jpg', 'uploads/products/1611217658-716x930-c-d-x-5qT09yIbROk-unsplash.jpg', 'lg', 15, 'App\\Models\\Product', '2021-01-21 08:27:40', '2021-01-21 08:27:40'),
(55, 'https://polo-store.devxhub.com//storage/uploads/products/1611217706-716x930-alphacolor-r6RCPk1X91c-unsplash.jpg', 'uploads/products/1611217706-716x930-alphacolor-r6RCPk1X91c-unsplash.jpg', 'lg', 14, 'App\\Models\\Product', '2021-01-21 08:28:27', '2021-01-21 08:28:27'),
(56, 'https://polo-store.devxhub.com//storage/uploads/products/1611217749-716x930-daniel-korpai-t6nSa5loyMA-unsplash.jpg', 'uploads/products/1611217749-716x930-daniel-korpai-t6nSa5loyMA-unsplash.jpg', 'lg', 13, 'App\\Models\\Product', '2021-01-21 08:29:10', '2021-01-21 08:29:10'),
(57, 'https://polo-store.devxhub.com//storage/uploads/products/1611217774-716x930-garvit-jagga-3IyjBegTXLA-unsplash.jpg', 'uploads/products/1611217774-716x930-garvit-jagga-3IyjBegTXLA-unsplash.jpg', 'lg', 12, 'App\\Models\\Product', '2021-01-21 08:29:36', '2021-01-21 08:29:36'),
(58, 'https://polo-store.devxhub.com//storage/uploads/products/1611217805-716x930-brightness-KbpjCGIcfbo-unsplash.jpg', 'uploads/products/1611217805-716x930-brightness-KbpjCGIcfbo-unsplash.jpg', 'lg', 11, 'App\\Models\\Product', '2021-01-21 08:30:06', '2021-01-21 08:30:06'),
(59, 'https://polo-store.devxhub.com//storage/uploads/products/1611217860-716x930-c-d-x-Ay1195BoYK0-unsplash.jpg', 'uploads/products/1611217860-716x930-c-d-x-Ay1195BoYK0-unsplash.jpg', 'lg', 10, 'App\\Models\\Product', '2021-01-21 08:31:02', '2021-01-21 08:31:02'),
(60, 'https://polo-store.devxhub.com//storage/uploads/products/1611217919-716x930-daniel-korpai-o1utz9Neufo-unsplash.jpg', 'uploads/products/1611217919-716x930-daniel-korpai-o1utz9Neufo-unsplash.jpg', 'lg', 9, 'App\\Models\\Product', '2021-01-21 08:32:00', '2021-01-21 08:32:00'),
(61, 'https://polo-store.devxhub.com//storage/uploads/products/1611217958-716x930-alphacolor-r6RCPk1X91c-unsplash.jpg', 'uploads/products/1611217958-716x930-alphacolor-r6RCPk1X91c-unsplash.jpg', 'lg', 9, 'App\\Models\\Product', '2021-01-21 08:32:39', '2021-01-21 08:32:39'),
(62, 'https://polo-store.devxhub.com//storage/uploads/products/1611217959-716x930-c-d-x-5qT09yIbROk-unsplash.jpg', 'uploads/products/1611217959-716x930-c-d-x-5qT09yIbROk-unsplash.jpg', 'lg', 9, 'App\\Models\\Product', '2021-01-21 08:32:41', '2021-01-21 08:32:41'),
(63, 'https://polo-store.devxhub.com//storage/uploads/products/1611217961-716x930-c-d-x-PDX_a_82obo-unsplash.jpg', 'uploads/products/1611217961-716x930-c-d-x-PDX_a_82obo-unsplash.jpg', 'lg', 9, 'App\\Models\\Product', '2021-01-21 08:32:42', '2021-01-21 08:32:42'),
(64, 'https://polo-store.devxhub.com//storage/uploads/products/1611217962-716x930-d33f7183eaf950c11053bbeb23cd6f7b.jpg', 'uploads/products/1611217962-716x930-d33f7183eaf950c11053bbeb23cd6f7b.jpg', 'lg', 9, 'App\\Models\\Product', '2021-01-21 08:32:42', '2021-01-21 08:32:42'),
(65, 'https://polo-store.devxhub.com//storage/uploads/products/1611218025-716x930-daniel-korpai-t6nSa5loyMA-unsplash.jpg', 'uploads/products/1611218025-716x930-daniel-korpai-t6nSa5loyMA-unsplash.jpg', 'lg', 8, 'App\\Models\\Product', '2021-01-21 08:33:46', '2021-01-21 08:33:46'),
(66, 'https://polo-store.devxhub.com//storage/uploads/products/1611218026-716x930-luke-chesser-vCF5sB7QecM-unsplash.jpg', 'uploads/products/1611218026-716x930-luke-chesser-vCF5sB7QecM-unsplash.jpg', 'lg', 8, 'App\\Models\\Product', '2021-01-21 08:33:47', '2021-01-21 08:33:47'),
(67, 'https://polo-store.devxhub.com//storage/uploads/products/1611218027-716x930-rachit-tank-2cFZ_FB08UM-unsplash.jpg', 'uploads/products/1611218027-716x930-rachit-tank-2cFZ_FB08UM-unsplash.jpg', 'lg', 8, 'App\\Models\\Product', '2021-01-21 08:33:48', '2021-01-21 08:33:48'),
(68, 'https://polo-store.devxhub.com//storage/uploads/products/1611218028-716x930-simon-daoudi-2wFoa040m8g-unsplash.jpg', 'uploads/products/1611218028-716x930-simon-daoudi-2wFoa040m8g-unsplash.jpg', 'lg', 8, 'App\\Models\\Product', '2021-01-21 08:33:49', '2021-01-21 08:33:49'),
(69, 'https://polo-store.devxhub.com//storage/uploads/products/1611218126-716x930-alphacolor-r6RCPk1X91c-unsplash.jpg', 'uploads/products/1611218126-716x930-alphacolor-r6RCPk1X91c-unsplash.jpg', 'lg', 7, 'App\\Models\\Product', '2021-01-21 08:35:27', '2021-01-21 08:35:27'),
(70, 'https://polo-store.devxhub.com//storage/uploads/products/1611218127-716x930-c-d-x-PDX_a_82obo-unsplash.jpg', 'uploads/products/1611218127-716x930-c-d-x-PDX_a_82obo-unsplash.jpg', 'lg', 7, 'App\\Models\\Product', '2021-01-21 08:35:29', '2021-01-21 08:35:29'),
(71, 'https://polo-store.devxhub.com//storage/uploads/products/1611218129-716x930-sebastian-banasiewcz-oXXc-s5nNy8-unsplash.jpg', 'uploads/products/1611218129-716x930-sebastian-banasiewcz-oXXc-s5nNy8-unsplash.jpg', 'lg', 7, 'App\\Models\\Product', '2021-01-21 08:35:30', '2021-01-21 08:35:30'),
(72, 'https://polo-store.devxhub.com//storage/uploads/products/1611218240-716x930-52-523845_hd-background-yamaha-yzf-r1-sport-bike-black.jpg', 'uploads/products/1611218240-716x930-52-523845_hd-background-yamaha-yzf-r1-sport-bike-black.jpg', 'lg', 6, 'App\\Models\\Product', '2021-01-21 08:37:20', '2021-01-21 08:37:20'),
(73, 'https://polo-store.devxhub.com//storage/uploads/products/1611218240-716x930-photo-1558981403-c5f9899a28bc.jpg', 'uploads/products/1611218240-716x930-photo-1558981403-c5f9899a28bc.jpg', 'lg', 6, 'App\\Models\\Product', '2021-01-21 08:37:21', '2021-01-21 08:37:21'),
(74, 'https://polo-store.devxhub.com//storage/uploads/products/1611218375-716x930-165-1654093_14-inch-laptop.jpg', 'uploads/products/1611218375-716x930-165-1654093_14-inch-laptop.jpg', 'lg', 18, 'App\\Models\\Product', '2021-01-21 08:39:36', '2021-01-21 08:39:36'),
(75, 'https://polo-store.devxhub.com//storage/uploads/products/1611218376-716x930-323-3231808_laptop-wallpaper-download-apple-laptop-pictures-download.jpg', 'uploads/products/1611218376-716x930-323-3231808_laptop-wallpaper-download-apple-laptop-pictures-download.jpg', 'lg', 18, 'App\\Models\\Product', '2021-01-21 08:39:37', '2021-01-21 08:39:37'),
(76, 'https://polo-store.devxhub.com//storage/uploads/products/1611218377-716x930-d33f7183eaf950c11053bbeb23cd6f7b.jpg', 'uploads/products/1611218377-716x930-d33f7183eaf950c11053bbeb23cd6f7b.jpg', 'lg', 18, 'App\\Models\\Product', '2021-01-21 08:39:37', '2021-01-21 08:39:37'),
(77, 'https://polo-store.devxhub.com//storage/uploads/products/1611218377-716x930-daniel-korpai-o1utz9Neufo-unsplash.jpg', 'uploads/products/1611218377-716x930-daniel-korpai-o1utz9Neufo-unsplash.jpg', 'lg', 18, 'App\\Models\\Product', '2021-01-21 08:39:38', '2021-01-21 08:39:38'),
(78, 'https://polo-store.devxhub.com//storage/uploads/products/1611218448-716x930-image.jpg', 'uploads/products/1611218448-716x930-image.jpg', 'lg', 19, 'App\\Models\\Product', '2021-01-21 08:40:48', '2021-01-21 08:40:48'),
(79, 'https://polo-store.devxhub.com//storage/uploads/products/1611218448-716x930-imani-bahati-LxVxPA1LOVM-unsplash.jpg', 'uploads/products/1611218448-716x930-imani-bahati-LxVxPA1LOVM-unsplash.jpg', 'lg', 19, 'App\\Models\\Product', '2021-01-21 08:40:48', '2021-01-21 08:40:48'),
(80, 'https://polo-store.devxhub.com//storage/uploads/products/1611218448-716x930-photo-1542291026-7eec264c27ff.jpg', 'uploads/products/1611218448-716x930-photo-1542291026-7eec264c27ff.jpg', 'lg', 19, 'App\\Models\\Product', '2021-01-21 08:40:49', '2021-01-21 08:40:49'),
(82, 'https://polo-store.devxhub.com//storage/uploads/products/1611219151-716x930-shiwa-id-Bajw65b3mXo-unsplash.jpg', 'uploads/products/1611219151-716x930-shiwa-id-Bajw65b3mXo-unsplash.jpg', 'lg', 20, 'App\\Models\\Product', '2021-01-21 08:52:32', '2021-01-21 08:52:32'),
(83, 'https://polo-store.devxhub.com//storage/uploads/products/1611219229-716x930-imani-bahati-LxVxPA1LOVM-unsplash.jpg', 'uploads/products/1611219229-716x930-imani-bahati-LxVxPA1LOVM-unsplash.jpg', 'lg', 21, 'App\\Models\\Product', '2021-01-21 08:53:50', '2021-01-21 08:53:50'),
(84, 'https://polo-store.devxhub.com//storage/uploads/products/1611219230-716x930-photo-1542291026-7eec264c27ff.jpg', 'uploads/products/1611219230-716x930-photo-1542291026-7eec264c27ff.jpg', 'lg', 21, 'App\\Models\\Product', '2021-01-21 08:53:50', '2021-01-21 08:53:50'),
(85, 'https://polo-store.devxhub.com//storage/uploads/products/1611219325-716x930-brightness-KbpjCGIcfbo-unsplash.jpg', 'uploads/products/1611219325-716x930-brightness-KbpjCGIcfbo-unsplash.jpg', 'lg', 20, 'App\\Models\\Product', '2021-01-21 08:55:26', '2021-01-21 08:55:26'),
(86, 'https://polo-store.devxhub.com//storage/uploads/products/1611219326-716x930-istockphoto-1226916207-1024x1024.jpg', 'uploads/products/1611219326-716x930-istockphoto-1226916207-1024x1024.jpg', 'lg', 20, 'App\\Models\\Product', '2021-01-21 08:55:26', '2021-01-21 08:55:26'),
(87, 'https://polo-store.devxhub.com//storage/uploads/products/1611219326-716x930-shiwa-id-Bajw65b3mXo-unsplash.jpg', 'uploads/products/1611219326-716x930-shiwa-id-Bajw65b3mXo-unsplash.jpg', 'lg', 20, 'App\\Models\\Product', '2021-01-21 08:55:27', '2021-01-21 08:55:27'),
(88, 'https://polo-store.devxhub.com//storage/uploads/products/1611219327-716x930-toma-areno-sqMRerhE6go-unsplash.jpg', 'uploads/products/1611219327-716x930-toma-areno-sqMRerhE6go-unsplash.jpg', 'lg', 20, 'App\\Models\\Product', '2021-01-21 08:55:28', '2021-01-21 08:55:28'),
(89, 'https://polo-store.devxhub.com//storage/uploads/sliders/1611219917-1200x500-slider-333.jpg', 'uploads/sliders/1611219917-1200x500-slider-333.jpg', 'lg', 6, 'App\\Models\\Slider', '2021-01-21 09:05:17', '2021-01-21 09:05:17'),
(90, 'https://polo-store.devxhub.com//storage/uploads/sliders/1611219937-1200x500-slider-222.jpg', 'uploads/sliders/1611219937-1200x500-slider-222.jpg', 'lg', 7, 'App\\Models\\Slider', '2021-01-21 09:05:37', '2021-01-21 09:05:37');

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
(4, '2020_12_21_101640_create_brands_table', 1),
(5, '2020_12_21_101652_create_categories_table', 1),
(6, '2020_12_21_101740_create_coupons_table', 1),
(7, '2021_01_03_070319_create_admins_table', 1),
(8, '2021_01_03_070331_create_sliders_table', 1),
(9, '2021_01_03_070417_create_products_table', 1),
(10, '2021_01_03_070441_create_product_prices_table', 1),
(11, '2021_01_03_070500_create_settings_table', 1),
(12, '2021_01_03_071912_create_socials_table', 1),
(13, '2021_01_03_071922_create_images_table', 1),
(14, '2021_01_03_071936_create_orders_table', 1),
(15, '2021_01_03_071947_create_order_details_table', 1),
(16, '2021_01_03_072000_create_shipping_addresses_table', 1),
(17, '2021_01_03_072012_create_shipping_methods_table', 1),
(18, '2021_01_03_072021_create_payments_logs_table', 1),
(19, '2021_01_08_161320_create_taxes_table', 1),
(20, '2021_01_21_153250_create_offers_table', 2),
(21, '2021_01_22_183450_create_offer_user_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1 = Percentages 2 = Dollar/Solid',
  `amount` double(8,2) NOT NULL COMMENT 'offer amount',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `start_at` datetime DEFAULT NULL,
  `expire_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offer_user`
--

CREATE TABLE `offer_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shipping_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_charge` double(8,2) DEFAULT NULL,
  `tax` double(8,2) DEFAULT NULL,
  `sub_total` double(8,2) NOT NULL,
  `grand_total` double(8,2) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 => unpaid, 1 => paid',
  `order_status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `shipping_method_id`, `coupon_id`, `payment_method`, `shipping_charge`, `tax`, `sub_total`, `grand_total`, `payment_status`, `order_status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL, 20.00, 20.00, 100.00, 140.00, 0, 0, '2021-01-17 18:54:05', '2021-01-17 18:54:05'),
(2, 1, 2, NULL, NULL, 20.00, 60.00, 300.00, 380.00, 0, 0, '2021-01-17 18:57:15', '2021-01-17 18:57:15'),
(3, 3, 1, NULL, NULL, 5.00, 88.00, 440.00, 533.00, 0, 0, '2021-01-17 19:03:33', '2021-01-17 19:03:33'),
(4, 1, 1, NULL, NULL, 5.00, 72.00, 396.00, 473.00, 0, 0, '2021-01-19 12:54:45', '2021-01-19 12:54:45'),
(5, 1, 2, NULL, NULL, 20.00, 12.00, 60.00, 92.00, 0, 0, '2021-01-19 13:11:42', '2021-01-19 13:11:42');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` double(8,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_size`, `product_color`, `product_price`, `product_quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '', 'black', 100.00, 1, '2021-01-17 18:54:05', '2021-01-17 18:54:05'),
(2, 2, 1, '', 'green', 60.00, 5, '2021-01-17 18:57:15', '2021-01-17 18:57:15'),
(3, 3, 1, '', 'blue', 60.00, 4, '2021-01-17 19:03:33', '2021-01-17 19:03:33'),
(4, 3, 2, '', 'black', 100.00, 2, '2021-01-17 19:03:33', '2021-01-17 19:03:33'),
(5, 4, 1, '', 'green', 60.00, 1, '2021-01-19 12:54:45', '2021-01-19 12:54:45'),
(6, 4, 4, 'sm', 'bule', 12.00, 3, '2021-01-19 12:54:45', '2021-01-19 12:54:45'),
(7, 4, 3, '', '', 100.00, 3, '2021-01-19 12:54:45', '2021-01-19 12:54:45'),
(8, 5, 1, '', 'green', 60.00, 1, '2021-01-19 13:11:42', '2021-01-19 13:11:42');

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
-- Table structure for table `payments_logs`
--

CREATE TABLE `payments_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `tax_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci,
  `weight` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `feature` tinyint(1) NOT NULL DEFAULT '0',
  `on_sale` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `tax_id`, `name`, `slug`, `price`, `discount_price`, `stock`, `code`, `color`, `details`, `weight`, `status`, `feature`, `on_sale`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 5, 2, 1, 'Product B', 'product-b', '100', '60', 50, '454545', '[\"green\",\"red\",\"blue\"]', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem \r\naccusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab\r\n illo inventore veritatis et quasi architecto beatae vitae dicta sunt \r\nexplicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut \r\nodit aut fugit, sed quia consequuntur magni dolores eos qui ratione \r\nvoluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum \r\nquia dolor sit amet, consectetur, adipisci velit, sed quia non numquam \r\neius modi tempora incidunt ut labore et dolore magnam aliquam quaerat \r\nvoluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam \r\ncorporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?\r\n Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse \r\nquam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo \r\nvoluptas nulla pariatur?\"', NULL, 1, 1, 1, 1, 1, '2021-01-17 18:20:20', '2021-01-17 19:13:34'),
(2, 3, 1, 1, 'Product A', 'product-a', '200', '100', 50, '12121212', '[\"black\",\"white\"]', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem \r\naccusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab\r\n illo inventore veritatis et quasi architecto beatae vitae dicta sunt \r\nexplicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut \r\nodit aut fugit, sed quia consequuntur magni dolores eos qui ratione \r\nvoluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum \r\nquia dolor sit amet, consectetur, adipisci velit, sed quia non numquam \r\neius modi tempora incidunt ut labore et dolore magnam aliquam quaerat \r\nvoluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam \r\ncorporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?\r\n Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse \r\nquam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo \r\nvoluptas nulla pariatur?\"', NULL, 1, 1, 1, 1, 1, '2021-01-17 18:23:08', '2021-01-20 13:08:18'),
(3, 8, 2, 1, 'Women\'s Double Shirt', 'women\'s-double-shirt', '121', '100', 12, 'testcode', NULL, '<ul style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 10px; padding: 10px 10px 5px; list-style-position: initial; list-style-image: initial; clear: left; line-height: 19.5px; color: rgb(87, 87, 87); font-family: Lato, Arial, sans-serif;\"><li style=\"outline: none; padding: 0px 0px 5px; clear: both; list-style: disc !important;\">6.6 oz.(US) 11 oz.(CA), 100% pre-shrunk combed ringspun cotton double piqué knit</li><li style=\"outline: none; padding: 0px 0px 5px; clear: both; list-style: disc !important;\">Dark Heather: 50/50 Cotton/Polyester</li><li style=\"outline: none; padding: 0px 0px 5px; clear: both; list-style: disc !important;\">Sport Grey: 90/10 Cotton/Polyester</li><li style=\"outline: none; padding: 0px 0px 5px; clear: both; list-style: disc !important;\">Semi-fitted contoured silhouette<br style=\"outline: none;\"></li><li style=\"outline: none; padding: 0px 0px 5px; clear: both; list-style: disc !important;\">Side seams with vents</li><li style=\"outline: none; padding: 0px 0px 5px; clear: both; list-style: disc !important;\">Contoured welt collar and cuffs</li><li style=\"outline: none; padding: 0px 0px 5px; clear: both; list-style: disc !important;\">Rolled forward topstitched shoulders</li><li style=\"outline: none; padding: 0px 0px 5px; clear: both; list-style: disc !important;\">Clean-finished placket with reinforced bottom box</li><li style=\"outline: none; padding: 0px 0px 5px; clear: both; list-style: disc !important;\">Three color-matched buttons</li><li style=\"outline: none; padding: 0px 0px 5px; clear: both; list-style: disc !important;\">Double-needle stitched bottom hem</li></ul>', NULL, 1, 1, 1, 1, 1, '2021-01-17 18:34:41', '2021-01-17 18:52:10'),
(4, 3, 3, NULL, 'Women\'s Sport Shirt', 'women\'s-sport-shirt', NULL, NULL, NULL, 'code22', '[\"red\",\"bule\",\"black\"]', '<ul style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 10px; padding: 10px 10px 5px; list-style-position: initial; list-style-image: initial; clear: left; line-height: 19.5px; color: rgb(87, 87, 87); font-family: Lato, Arial, sans-serif;\"><li style=\"outline: none; padding: 0px 0px 5px; clear: both; list-style: disc !important;\">3.8 oz., 100% polyester</li><li style=\"outline: none; padding: 0px 0px 5px; clear: both; list-style: disc !important;\">Hydrophilic finish</li><li style=\"outline: none; padding: 0px 0px 5px; clear: both; list-style: disc !important;\">Full heathered body</li><li style=\"outline: none; padding: 0px 0px 5px; clear: both; list-style: disc !important;\">Self-fabric collar</li><li style=\"outline: none; padding: 0px 0px 5px; clear: both; list-style: disc !important;\">Three-button placket</li><li style=\"outline: none; padding: 0px 0px 5px; clear: both; list-style: disc !important;\">UPF 30 protection</li><li style=\"outline: none; padding: 0px 0px 5px; clear: both; list-style: disc !important;\">Silver heat-transfer logo on right hip</li></ul>', NULL, 1, 1, 1, 1, 1, '2021-01-17 18:38:45', '2021-01-20 13:07:32'),
(5, 3, 1, 1, 'Nichole Vaughn', 'nichole-vaughn', NULL, NULL, NULL, 'd3f1g65df', '[\"Red\",\"Black\",\"Blue\"]', 'Necessitatibus commo. sdgdgdf df', NULL, 1, 1, 1, 1, 1, '2021-01-17 19:20:08', '2021-01-17 19:20:08'),
(6, 4, 1, 1, 'Khass Food Mariyum Dates', 'khass-food-mariyum-dates', '550', NULL, 10, '55663', NULL, '<span style=\"color: rgb(97, 94, 88); font-family: \"Segoe UI\", Helvetica, \"Droid Sans\", Arial, \"lucida grande\", tahoma, verdana, arial, sans-serif; font-size: 16px; background-color: rgb(247, 247, 247);\">Chaldal.com is an online shop in Dhaka, Bangladesh. We believe time is valuable to our fellow Dhaka residents, and that they should not have to waste hours in traffic, brave bad weather and wait in line just to buy basic necessities like eggs! This is why Chaldal delivers everything you need right at your door-step and at no additional cost.</span>', NULL, 1, 1, 1, 1, 1, '2021-01-20 13:28:27', '2021-01-21 08:37:20'),
(7, 8, 2, 1, 'Black & Ass Cotton Full Sleeve Casual T-shirt For Men-', 'black-&-ass-cotton-full-sleeve-casual-t-shirt-for-men-', '799', '143', 20, 'Excepturi commodi qu', '[\"Red\",\"Black\"]', '<ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px; color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Product Type: full Sleeve Tshirt</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Main Material: Cotton</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Soft and smooth fabric</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Comfortable to wear</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Fashionable and smart design</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">M Chest - 36 \", Length - 28\"</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">L Chest - 38 \",Length - 29\"</li><li class=\"\" data-spm-anchor-id=\"a2a0e.pdp.product_detail.i1.68551c58i1Z2No\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">XL Chest - 40 \", Length – 30\"....</li></ul><p style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\"><br></p><p style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\"><br></p><div class=\"html-content detail-content\" style=\"margin: 16px 0px 0px; padding: 0px 0px 16px; word-break: break-word; position: relative; height: auto; line-height: 19px; overflow-y: hidden; border-bottom: 1px solid rgb(239, 240, 245); color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><div style=\"margin: 0px; padding: 8px 0px; white-space: pre-wrap;\"><div style=\"margin: 0px; padding: 8px 0px;\"><div style=\"margin: 0px; padding: 8px 0px;\"><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 10px; padding: 0px; list-style-position: initial; list-style-image: initial;\">Product Type: full Sleeve TshirtMain Material: CottonSoft and smooth fabricComfortable to wearFashionable and smart designM Chest - 36 \", Length - 28\"L Chest - 38 \",Length - 29\"XL Chest - 40 \", Length – 30\"....</ul></div></div></div></div><div class=\"pdp-mod-specification\" style=\"margin: 16px 0px 0px; padding: 0px 0px 10px; border-bottom: 1px solid rgb(239, 240, 245); font-size: 14px; color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif;\"><h2 class=\"pdp-mod-section-title \" style=\"margin: 0px; padding: 0px; font-family: Roboto-Medium; font-size: 16px; line-height: 19px; color: rgb(33, 33, 33); letter-spacing: 0px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;\">Specifications of Black & Ass Cotton Full Sleeve Casual T-shirt For Men-</h2><div class=\"pdp-general-features\" style=\"margin: 0px; padding: 0px;\"><ul class=\"specification-keys\" style=\"margin: 16px -15px 0px; padding: 0px; list-style: none; height: auto;\"><li class=\"key-li\" style=\"margin: 0px 0px 8px; padding: 0px 15px; display: inline-block; width: 490px; vertical-align: top; line-height: 18px;\"><span class=\"key-title\" style=\"margin: 0px 18px 0px 0px; padding: 0px; display: inline-block; width: 140px; vertical-align: top; color: rgb(117, 117, 117); word-break: break-word;\">Brand</span><div class=\"html-content key-value\" style=\"margin: 0px; padding: 0px; word-break: break-word; display: inline-block; width: 306px;\">Dynamic Style</div></li><li class=\"key-li\" style=\"margin: 0px 0px 8px; padding: 0px 15px; display: inline-block; width: 490px; vertical-align: top; line-height: 18px;\"><span class=\"key-title\" style=\"margin: 0px 18px 0px 0px; padding: 0px; display: inline-block; width: 140px; vertical-align: top; color: rgb(117, 117, 117); word-break: break-word;\">SKU</span><div class=\"html-content key-value\" style=\"margin: 0px; padding: 0px; word-break: break-word; display: inline-block; width: 306px;\">162846410_BD-1095076810</div></li><li class=\"key-li\" style=\"margin: 0px 0px 8px; padding: 0px 15px; display: inline-block; width: 490px; vertical-align: top; line-height: 18px;\"><span class=\"key-title\" style=\"margin: 0px 18px 0px 0px; padding: 0px; display: inline-block; width: 140px; vertical-align: top; color: rgb(117, 117, 117); word-break: break-word;\">Main Material</span><div class=\"html-content key-value\" style=\"margin: 0px; padding: 0px; word-break: break-word; display: inline-block; width: 306px;\">Cotton</div></li></ul></div><div class=\"box-content\" data-spm-anchor-id=\"a2a0e.pdp.product_detail.i0.68551c58i1Z2No\" style=\"margin: 28px 0px 0px; padding: 0px;\"><span class=\"key-title\" style=\"margin: 0px; padding: 0px; display: table-cell; width: 140px; color: rgb(117, 117, 117); word-break: break-word;\">What’s in the box</span><div class=\"html-content box-content-html\" data-spm-anchor-id=\"a2a0e.pdp.product_detail.i2.68551c58i1Z2No\" style=\"margin: 0px; padding: 0px 0px 0px 18px; word-break: break-word; display: table-cell;\">Black & Ass Cotton Full Sleeve Casual T-shirt For Men</div></div></div>', NULL, 1, 1, 1, 1, 1, '2021-01-20 13:32:20', '2021-01-21 08:35:26'),
(8, 4, 2, 1, 'VOGUE New Stylish Hoodie For MEN-', 'vogue-new-stylish-hoodie-for-men-', NULL, NULL, NULL, '786578', '[\"red\"]', '<div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden; color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Product Type: Hoodies</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Main Material: Cotton</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Smart and fashionable look</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Soft and comfortable</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">A perfect casual wear</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Quality:Export Quaality</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Fabrics:Phillies</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Size: M, L, XL,</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">M=Long-28, Chest-38</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">L=Long-29, Chest-40</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">XL=Long-30, Chest-42..</li></ul></div><div class=\"html-content detail-content\" style=\"margin: 16px 0px 0px; padding: 0px 0px 16px; word-break: break-word; position: relative; height: auto; line-height: 19px; overflow-y: hidden; border-bottom: 1px solid rgb(239, 240, 245); color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 8px 0px; font-size: 14px; font-family: none; white-space: pre-wrap;\">Product details of VOGUE New Stylish Hoodie For MEN</p><div style=\"margin: 0px; padding: 8px 0px; white-space: pre-wrap;\"><div style=\"margin: 0px; padding: 8px 0px;\"><div style=\"margin: 0px; padding: 8px 0px;\"><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 10px; padding: 0px; list-style-position: initial; list-style-image: initial;\">Product Type: HoodiesMain Material: CottonSmart and fashionable lookSoft and comfortableA perfect casual wearQuality:Export QuaalityFabrics:PhilliesSize: M, L, XL,M=Long-28, Chest-38L=Long-29, Chest-40XL=Long-30, Chest-42</ul></div></div></div></div><div class=\"pdp-mod-specification\" style=\"margin: 16px 0px 0px; padding: 0px 0px 10px; border-bottom: 1px solid rgb(239, 240, 245); font-size: 14px; color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif;\"><h2 class=\"pdp-mod-section-title \" style=\"margin: 0px; padding: 0px; font-family: Roboto-Medium; font-size: 16px; line-height: 19px; color: rgb(33, 33, 33); letter-spacing: 0px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;\">Specifications of VOGUE New Stylish Hoodie For MEN-</h2><div class=\"pdp-general-features\" style=\"margin: 0px; padding: 0px;\"><ul class=\"specification-keys\" style=\"margin: 16px -15px 0px; padding: 0px; list-style: none; height: auto;\"><li class=\"key-li\" style=\"margin: 0px 0px 8px; padding: 0px 15px; display: inline-block; width: 490px; vertical-align: top; line-height: 18px;\"><span class=\"key-title\" style=\"margin: 0px 18px 0px 0px; padding: 0px; display: inline-block; width: 140px; vertical-align: top; color: rgb(117, 117, 117); word-break: break-word;\">Brand</span><div class=\"html-content key-value\" style=\"margin: 0px; padding: 0px; word-break: break-word; display: inline-block; width: 306px;\">Dynamic Style</div></li><li class=\"key-li\" style=\"margin: 0px 0px 8px; padding: 0px 15px; display: inline-block; width: 490px; vertical-align: top; line-height: 18px;\"><span class=\"key-title\" style=\"margin: 0px 18px 0px 0px; padding: 0px; display: inline-block; width: 140px; vertical-align: top; color: rgb(117, 117, 117); word-break: break-word;\">SKU</span><div class=\"html-content key-value\" style=\"margin: 0px; padding: 0px; word-break: break-word; display: inline-block; width: 306px;\">162842362_BD-1095066880</div></li><li class=\"key-li\" style=\"margin: 0px 0px 8px; padding: 0px 15px; display: inline-block; width: 490px; vertical-align: top; line-height: 18px;\"><span class=\"key-title\" style=\"margin: 0px 18px 0px 0px; padding: 0px; display: inline-block; width: 140px; vertical-align: top; color: rgb(117, 117, 117); word-break: break-word;\">Main Material</span><div class=\"html-content key-value\" style=\"margin: 0px; padding: 0px; word-break: break-word; display: inline-block; width: 306px;\">Cotton</div></li></ul></div><div class=\"box-content\" data-spm-anchor-id=\"a2a0e.pdp.product_detail.i0.20b378e7rvwfls\" style=\"margin: 28px 0px 0px; padding: 0px;\"><span class=\"key-title\" style=\"margin: 0px; padding: 0px; display: table-cell; width: 140px; color: rgb(117, 117, 117); word-break: break-word;\">What’s in the box</span><div class=\"html-content box-content-html\" style=\"margin: 0px; padding: 0px 0px 0px 18px; word-break: break-word; display: table-cell;\">VOGUE New Stylish Hoodie For MEN-</div></div></div>', NULL, 1, 1, 1, 1, 1, '2021-01-20 13:36:43', '2021-01-21 08:33:45'),
(9, 4, 1, 1, 'UGLY FISH Cap Winter Hat And Neck Warmer For Men', 'ugly-fish-cap-winter-hat-and-neck-warmer-for-men', '69999', '3', 78, '678', '[\"red\"]', '<ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px; color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Product Type: full Sleeve Tshirt</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Main Material: Cotton</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Soft and smooth fabric</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Comfortable to wear</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Fashionable and smart design</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">M Chest - 36 \", Length - 28\"</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">L Chest - 38 \",Length - 29\"</li><li class=\"\" data-spm-anchor-id=\"a2a0e.pdp.product_detail.i0.6ac21c583JrCzW\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">XL Chest - 40 \", Length – 30\"....</li></ul>', NULL, 1, 1, 1, 1, 1, '2021-01-20 13:37:18', '2021-01-21 08:32:38'),
(10, 4, 2, 1, 'Trendy Men\'s Full & Long Sleeve T-Shirt', 'trendy-men\'s-full-&-long-sleeve-t-shirt', '8909', '69', 78, '678', '[\"red\"]', '<div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden; color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Band Name : Cosmic Mart</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Type : Full Sleeve</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Fabric : 100 % Cotton</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Type : Round Neck</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">GSM: 170</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Main Material: Cotton</li></ul></div><div class=\"html-content detail-content\" data-spm-anchor-id=\"a2a0e.pdp.product_detail.i1.407613526Aq5Wf\" style=\"margin: 16px 0px 0px; padding: 0px 0px 16px; word-break: break-word; position: relative; height: auto; line-height: 19px; overflow-y: hidden; border-bottom: 1px solid rgb(239, 240, 245); color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><span style=\"margin: 0px; padding: 0px; font-size: 12pt;\">Cosmic Mart is a trusted and reliable source for all your garment related needs from Bangladesh We manufacture and supplies quality products in all categories at a competitive price range from their own and sister production facility. It\'s a 100%cotton t-shirt with a premium finishing goods.</span><p data-spm-anchor-id=\"a2a0e.pdp.product_detail.i0.407613526Aq5Wf\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 8px 0px; font-size: 14px; white-space: pre-wrap;\"><span style=\"margin: 0px; padding: 0px; font-size: 12pt;\">Measurement in inches</span></p></div>', NULL, 1, 1, 1, 1, 1, '2021-01-20 13:39:50', '2021-01-21 08:31:00'),
(11, 8, 1, 1, 'Long Sleev Stylish T-Shirt For Men', 'long-sleev-stylish-t-shirt-for-men', '5600', '5', 78, '678', '[\"red\"]', '<div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden; color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Product Type: Shirt</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Color;Black</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Main Material: Cotton</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Stylish and fashionable</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Gender: Men</li></ul></div><div class=\"html-content detail-content\" style=\"margin: 16px 0px 0px; padding: 0px 0px 16px; word-break: break-word; position: relative; height: auto; line-height: 19px; overflow-y: hidden; border-bottom: 1px solid rgb(239, 240, 245); color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 8px 0px; font-size: 14px; white-space: pre-wrap;\"><span style=\"margin: 0px; padding: 0px;\">Men\'s Long Sleeves T-Shirt</span></p><p data-spm-anchor-id=\"a2a0e.pdp.product_detail.i0.5c6435e8MJ39xP\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 8px 0px; font-size: 14px; white-space: pre-wrap;\"><span style=\"margin: 0px; padding: 0px;\">Long sleeves T- shirts is a cloth garment for the upper body. It is normally associated with long sleeves, a round neckline with collar. T-Shirts are generally made of a light, great quality fabric, and are easy to clean. T-Shirts with convertible long sleeves means you can roll up your sleeves when the weather gets warm and roll them back down again as the night</span></p></div>', NULL, 1, 1, 1, 1, 1, '2021-01-20 13:41:08', '2021-01-21 08:30:05'),
(12, 8, 1, 1, 'Long Sleev Stylish T-Shirt For Men g', 'long-sleev-stylish-t-shirt-for-men-g', '8909', '45', 987, '678', '[\"red\"]', '<div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden; color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Product Type: Shirt</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Color;Maroon</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Main Material: Cotton</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Stylish and fashionable</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Gender: Men</li></ul></div><div class=\"html-content detail-content\" style=\"margin: 16px 0px 0px; padding: 0px 0px 16px; word-break: break-word; position: relative; height: auto; line-height: 19px; overflow-y: hidden; border-bottom: 1px solid rgb(239, 240, 245); color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 8px 0px; font-size: 14px; white-space: pre-wrap;\"><span style=\"margin: 0px; padding: 0px;\">Men\'s Long Sleeves T-Shirt</span></p><p data-spm-anchor-id=\"a2a0e.pdp.product_detail.i0.18ff35e8Of6BXJ\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 8px 0px; font-size: 14px; white-space: pre-wrap;\"><span style=\"margin: 0px; padding: 0px;\">Long sleeves T- shirts is a cloth garment for the upper body. It is normally associated with long sleeves, a round neckline with collar. T-Shirts are generally made of a light, great quality fabric, and are easy to clean. T-Shirts with convertible long sleeves means you can roll up your sleeves when the weather gets warm and roll them back down again as the night</span></p></div>', NULL, 1, 1, 1, 1, 1, '2021-01-20 13:43:29', '2021-01-21 08:29:34'),
(13, 4, 3, 1, 'Black Cotton Long Sleeve Hoodie For Men', 'black-cotton-long-sleeve-hoodie-for-men', '699', '6', 988, '56436', '[\"red\"]', '<div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden; color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Product Type: Hoodie</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Color: Black</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Main Material: Cotton</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Gender: Men</li></ul></div><div class=\"html-content detail-content\" style=\"margin: 16px 0px 0px; padding: 0px 0px 16px; word-break: break-word; position: relative; height: auto; line-height: 19px; overflow-y: hidden; border-bottom: 1px solid rgb(239, 240, 245); color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><p data-spm-anchor-id=\"a2a0e.pdp.product_detail.i0.70a317f77aoamK\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 8px 0px; font-size: 14px; font-family: none; white-space: pre-wrap;\">A hoodie is a cloth garment for the upper body, especially bought and worn during winter. Originally, hoodies are such a garment worn exclusively by men but it has become popular among women too. It comes with a stylish head-cover, short or long sleeves, and an optionalvertical opening (half or full) with buttons or zipper. To keep pace with trends and fashion there is a very rare option for the young without stylish and great hoodies in winter.The seller, UpdateFashion, offers a wide selection of products from renowned brands in Bangladesh with a promise of fast, safe and easy online shopping experience through Daraz. The seller comes closer to the huge customers on this leading online shopping platform of all over Bangladesh and serving to the greater extent for achieving higher customer satisfaction. The brands working with Daraz are not only serving top class products but also are dedicated to acquiring brand loyalty.</p></div>', NULL, 1, 1, 1, 1, 1, '2021-01-20 13:44:39', '2021-01-21 08:29:09'),
(14, 6, 3, 1, 'Men\'s Fashion - Stylish Black Cotton Full Sleeve T-Shirt For Men', 'men\'s-fashion---stylish-black-cotton-full-sleeve-t-shirt-for-men', NULL, NULL, NULL, '56436', '[\"red\"]', '<div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden; color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Export Quality: Black Cotton Full Sleeve T Shirt For Men</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Fabric: 100% cotton</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Fabrication: 170+GSM</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Color: Black</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Size: M, L, XL</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">L :( chest-40 \'\', length-29 \")</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">XL: ( chest -42 \", length-30\")</li></ul></div><div class=\"html-content detail-content\" style=\"margin: 16px 0px 0px; padding: 0px 0px 16px; word-break: break-word; position: relative; height: auto; line-height: 19px; overflow-y: hidden; border-bottom: 1px solid rgb(239, 240, 245); color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><p data-spm-anchor-id=\"a2a0e.pdp.product_detail.i0.640e78101iQ89s\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 8px 0px; font-size: 14px; white-space: pre-wrap; font-family: none;\"><strong style=\"margin: 0px; padding: 0px; font-weight: bold;\"><em style=\"margin: 0px; padding: 0px;\">This full T-Shirt for Men\'s comfortable and can be worn for regular use. It is a perfect wear for men like you. You will love to wear this luxurious and colorful full shirt just for its versatile usability and diversified fashion sense. It is generally made of a light, great quality cotton fabrics and is easy to clean. It is perfect to wear with jeans and gabardine pant . Full </em></strong><strong style=\"margin: 0px; padding: 0px; font-weight: bold;\">Sleeve </strong><strong style=\"margin: 0px; padding: 0px; font-weight: bold;\"><em style=\"margin: 0px; padding: 0px;\">design with a regular fit for men. It is very versatile because it is useful on formal as well as casual occasion. It is designed to be comfortable and durable.</em></strong></p></div>', NULL, 1, 1, 1, 1, 1, '2021-01-20 13:46:06', '2021-01-21 08:28:26'),
(15, 8, 1, 1, 'Men\'s Fashion - Cotton Long Sleeve Hoodie For Men', 'men\'s-fashion---cotton-long-sleeve-hoodie-for-men', '5600', '3', 987, '678', '[\"red\"]', '<h2 class=\"pdp-mod-section-title outer-title\" style=\"margin: 0px; padding: 0px 24px; font-family: Roboto-Medium; font-size: 16px; line-height: 52px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 52px; background: rgb(250, 250, 250);\">Product details of Men\'s Fashion - Cotton Long Sleeve Hoodie For Men</h2><div class=\"pdp-product-detail\" data-spm=\"product_detail\" style=\"margin: 0px; padding: 0px; position: relative; color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><div class=\"pdp-product-desc \" style=\"margin: 0px; padding: 5px 14px 5px 24px; height: auto; overflow-y: hidden;\"><div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">High Quality</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Product : Men\'s Hoodie</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Comfortable Regular Fit</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Pattern: Solids</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Occasion: Classy Casual and Daily Wear.</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Fitted: Slim Fit</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Color: Ass Geven Picture</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Fabric : 100 % Cotton</li><li class=\"\" data-spm-anchor-id=\"a2a0e.pdp.product_detail.i0.351799d6XYF2MW\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Fabrication : 240 GSM</li></ul></div></div></div>', NULL, 1, 1, 1, 1, 1, '2021-01-20 13:47:28', '2021-01-21 08:27:38'),
(17, 8, 3, 1, 'Long Sleev Stylish T-Shirt For Men gussi', 'long-sleev-stylish-t-shirt-for-men-gussi', '560', '69', 988, '56436', '[\"black\"]', '<div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden; color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Export Quality: Black Cotton Full Sleeve T Shirt For Men</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Fabric: 100% cotton</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Fabrication: 170+GSM</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Color: Black</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Size: M, L, XL</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">L :( chest-40 \'\', length-29 \")</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; font-size: 14px; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">XL: ( chest -42 \", length-30\")</li></ul></div><div class=\"html-content detail-content\" style=\"margin: 16px 0px 0px; padding: 0px 0px 16px; word-break: break-word; position: relative; height: auto; line-height: 19px; overflow-y: hidden; border-bottom: 1px solid rgb(239, 240, 245); color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><p data-spm-anchor-id=\"a2a0e.pdp.product_detail.i0.726e7810Mi5XLo\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 8px 0px; font-size: 14px; white-space: pre-wrap; font-family: none;\"><strong style=\"margin: 0px; padding: 0px; font-weight: bold;\"><em style=\"margin: 0px; padding: 0px;\">This full T-Shirt for Men\'s comfortable and can be worn for regular use. It is a perfect wear for men like you. You will love to wear this luxurious and colorful full shirt just for its versatile usability and diversified fashion sense. It is generally made of a light, great quality cotton fabrics and is easy to clean. It is perfect to wear with jeans and gabardine pant . Full </em></strong><strong style=\"margin: 0px; padding: 0px; font-weight: bold;\">Sleeve </strong><strong style=\"margin: 0px; padding: 0px; font-weight: bold;\"><em style=\"margin: 0px; padding: 0px;\">design with a regular fit for men. It is very versatile because it is useful on formal as well as casual occasion. It is designed to be comfortable and durable.</em></strong></p></div>', NULL, 1, 1, 1, 1, 1, '2021-01-20 13:52:40', '2021-01-21 08:25:51'),
(18, 6, 3, 1, 'Long Sleev Stylish T-Shirt For Men fd', 'long-sleev-stylish-t-shirt-for-men-fd', '8909', '6', 988, '678', '[\"black\"]', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis ipsum tempor, semper nisl vel, ornare justo. Nulla porta eget mi gravida ullamcorper. Proin consectetur mollis nulla sed faucibus. Maecenas nec est nisl. Vestibulum malesuada, velit tincidunt molestie tempor, turpis elit mattis nulla, sed pellentesque lacus arcu ut leo. Integer maximus ac purus vitae hendrerit.&nbsp;</span>', NULL, 1, 1, 1, 1, 1, '2021-01-21 08:39:35', '2021-01-21 08:39:35'),
(19, 4, 1, 1, 'Men\'s Fashion - Stylish Black Cotton Full Sleeve T-Shirt For Men df', 'men\'s-fashion---stylish-black-cotton-full-sleeve-t-shirt-for-men-df', '69999', '69', 987, '678', '[\"red\"]', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis ipsum tempor, semper nisl vel, ornare justo. Nulla porta eget mi gravida ullamcorper. Proin consectetur mollis nulla sed faucibus. Maecenas nec est nisl. Vestibulum malesuada, velit tincidunt molestie tempor, turpis elit mattis nulla, sed pellentesque lacus arcu ut leo. Integer maximus ac purus vitae hendrerit.&nbsp;</span>', NULL, 1, 1, 1, 1, 1, '2021-01-21 08:40:48', '2021-01-21 08:40:48'),
(20, 4, 3, 1, 'Men\'s Fashion - Stylish Black Cotton Full Sleeve T-Shirt For Men drt', 'men\'s-fashion---stylish-black-cotton-full-sleeve-t-shirt-for-men-drt', '69999', '69', 987, '678', '[\"black\"]', '<hr style=\"margin: 0px; padding: 0px; clear: both; border-top: 0px; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0)); color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: center;\"><div id=\"Content\" style=\"margin: 0px; padding: 0px; position: relative; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: center;\"><div id=\"bannerL\" style=\"margin: 0px 0px 0px -160px; padding: 0px; position: sticky; top: 20px; width: 160px; height: 10px; float: left; text-align: right;\"></div><div id=\"bannerR\" style=\"margin: 0px -160px 0px 0px; padding: 0px; position: sticky; top: 20px; width: 160px; height: 10px; float: right; text-align: left;\"></div><div class=\"boxed\" style=\"margin: 10px 28.7969px; padding: 0px; clear: both;\"><div id=\"lipsum\" style=\"margin: 0px; padding: 0px; text-align: justify;\"><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis ipsum tempor, semper nisl vel, ornare justo. Nulla porta eget mi gravida ullamcorper. Proin consectetur mollis nulla sed faucibus. Maecenas nec est nisl. Vestibulum malesuada, velit tincidunt molestie</p></div></div></div>', NULL, 1, 1, 1, 1, 1, '2021-01-21 08:52:31', '2021-01-21 08:55:25');
INSERT INTO `products` (`id`, `category_id`, `brand_id`, `tax_id`, `name`, `slug`, `price`, `discount_price`, `stock`, `code`, `color`, `details`, `weight`, `status`, `feature`, `on_sale`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(21, 6, 2, 1, 'Long Sleev Stylish T-Shirt For Men ser', 'long-sleev-stylish-t-shirt-for-men-ser', '69999', '6', 987, '678', '[\"black\"]', '<hr style=\"margin: 0px; padding: 0px; clear: both; border-top: 0px; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0)); color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: center;\"><div id=\"Content\" style=\"margin: 0px; padding: 0px; position: relative; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: center;\"><div id=\"bannerL\" style=\"margin: 0px 0px 0px -160px; padding: 0px; position: sticky; top: 20px; width: 160px; height: 10px; float: left; text-align: right;\"></div><div id=\"bannerR\" style=\"margin: 0px -160px 0px 0px; padding: 0px; position: sticky; top: 20px; width: 160px; height: 10px; float: right; text-align: left;\"></div><div class=\"boxed\" style=\"margin: 10px 28.7969px; padding: 0px; clear: both;\"><div id=\"lipsum\" style=\"margin: 0px; padding: 0px; text-align: justify;\"><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis ipsum tempor, semper nisl vel, ornare justo. Nulla porta eget mi gravida ullamcorper. Proin consectetur mollis nulla sed faucibus. Maecenas nec est nisl. Vestibulum malesuada, velit tincidunt molestie</p></div></div></div>', NULL, 1, 1, 1, 1, 1, '2021-01-21 08:53:49', '2021-01-21 08:53:49');

-- --------------------------------------------------------

--
-- Table structure for table `product_prices`
--

CREATE TABLE `product_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `discount_price` double(8,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_prices`
--

INSERT INTO `product_prices` (`id`, `product_id`, `size`, `price`, `discount_price`, `stock`, `created_at`, `updated_at`) VALUES
(3, 5, 'SM', 936.00, NULL, 29, '2021-01-17 19:20:08', '2021-01-17 19:20:08'),
(4, 5, 'XL', 681.00, 500.00, 10, '2021-01-17 19:20:08', '2021-01-17 19:20:08'),
(5, 5, 'XLL', 544.00, 400.00, 40, '2021-01-17 19:20:08', '2021-01-17 19:20:08'),
(6, 4, 'sm', 100.00, 12.00, 12, '2021-01-20 13:07:33', '2021-01-20 13:07:33'),
(12, 14, '4', 209999.00, 10.00, 300, '2021-01-21 08:28:26', '2021-01-21 08:28:26'),
(13, 8, 'SM', 681.00, 500.00, 10, '2021-01-21 08:33:45', '2021-01-21 08:33:45'),
(14, 8, 'ML', 774.00, 450.00, 40, '2021-01-21 08:33:45', '2021-01-21 08:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header_top_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_one` text COLLATE utf8mb4_unicode_ci,
  `description_two` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `header_top_title`, `description_one`, `description_two`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'FREE SHIPPING ON ORDERS $75+ (EXCLUDES CANADA) U.S. POLO ASSN. COVID-19 STATEMENT', 'About Us Careers Affiliate Program International Store Locator Contact Us FAQs Shipping Information Return Information Privacy Policy Size Guides Shop Wish Lists My Account Preference Center Search Student Discount Military Discount', '© 2021 U.S. Polo Assn.. All Rights Reserved.<br>NOT AFFILIATED WITH POLO RALPH LAUREN CORP.<br>Address: 206 Webb Smith Drive Colfax, LA 71417<br>Phone Number: (855) 361-5553 Powered by Shopify', 1, 1, 1, '2021-01-17 18:51:46', '2021-01-22 11:20:02');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

CREATE TABLE `shipping_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_addresses`
--

INSERT INTO `shipping_addresses` (`id`, `user_id`, `first_name`, `last_name`, `email`, `country`, `state`, `city`, `zipcode`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, 'September', 'Mccray', 'cimudo@mailinator.com', NULL, 'Et lorem reprehender', 'Et amet animi nihi', NULL, '+1 (861) 663-7227', 'Accusamus sunt aliqu', '2021-01-17 18:53:49', '2021-01-19 12:54:34'),
(2, 3, 'Lynn', 'Avery', 'zezok@mailinator.com', NULL, 'Vel nulla cupidatat', 'Et reiciendis non ni', NULL, '+1 (274) 149-9326', 'Vitae dicta eu itaqu', '2021-01-17 19:01:23', '2021-01-17 19:01:23');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_methods`
--

CREATE TABLE `shipping_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applicable_amount` int(11) DEFAULT NULL,
  `charge` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_methods`
--

INSERT INTO `shipping_methods` (`id`, `title`, `slug`, `applicable_amount`, `charge`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Architecto ipsam cup', '', 20, 5, 1, 1, 1, '2021-01-17 18:20:27', '2021-01-17 18:20:27'),
(2, 'Repellendus Cillum', '', 1, 20, 1, 1, 1, '2021-01-17 18:20:42', '2021-01-17 18:20:42'),
(3, 'Air shipping', '', 2000, 200, 1, 1, 1, '2021-01-17 18:21:16', '2021-01-17 18:21:16'),
(4, 'ship', '', 1000, 500, 1, 1, 1, '2021-01-17 18:21:31', '2021-01-17 18:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Slider title one', 'slider-title-one', 1, 1, 1, '2021-01-17 18:18:38', '2021-01-21 09:04:46'),
(2, 'Slider title two', 'slider-title-two', 1, 1, 1, '2021-01-17 18:36:15', '2021-01-21 08:45:35'),
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'lorem-ipsum-dolor-sit-amet,-consectetur-adipiscing-elit.', 1, 1, 1, '2021-01-17 18:37:20', '2021-01-21 08:48:16'),
(4, 'Slider title Four', 'slider-title-four', 1, 1, 1, '2021-01-17 18:40:24', '2021-01-21 08:47:23'),
(5, 'slider title five5', 'slider-title-five5', 1, 1, 1, '2021-01-17 18:40:44', '2021-01-21 08:50:37'),
(6, 'slider-7', 'slider-7', 1, 1, 1, '2021-01-21 09:05:17', '2021-01-21 09:05:17'),
(7, 'Provident amet dol', 'provident-amet-dol', 1, 1, 1, '2021-01-21 09:05:37', '2021-01-21 09:05:37');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`id`, `name`, `slug`, `icon`, `link`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Facbook', 'facbook', 'fa fa-facebook', 'https://www.facebook.com/', 1, 1, 1, '2021-01-17 18:42:00', '2021-01-17 18:43:20'),
(2, 'Youtube', 'youtube', 'fa fa-youtube', 'https://www.youtube.com/', 1, 1, 1, '2021-01-17 18:42:32', '2021-01-17 18:43:43'),
(3, 'twitter', 'twitter', 'fa  fa-twitter', 'https://twitter.com/?lang=en', 1, 1, 1, '2021-01-17 18:46:16', '2021-01-17 18:48:20'),
(4, 'whatsapp', 'whatsapp', 'fa fa-whatsapp', 'https://www.whatsapp.com/?lang=en', 1, 1, 1, '2021-01-17 18:54:21', '2021-01-17 18:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax` double(8,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `name`, `slug`, `type`, `tax`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'DB', 'db', '1', 20.00, 1, 1, 1, '2021-01-17 18:15:02', '2021-01-17 18:22:30'),
(2, 'F.T', 'f.t', '1', 15.00, 1, 1, 1, '2021-01-17 18:15:16', '2021-01-22 11:20:51'),
(3, 'fifty', 'fifty', '2', 34.00, 1, 1, 1, '2021-01-22 11:21:41', '2021-01-22 11:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Iqbal3 dsfg', 'marta60@example.org', '45454555454', 'dahak mohakali', NULL, '$2y$10$MXB85pgafc2kQb4BGKx3jO.fLKKmRYomI0p5es9cfJwSLyY6QUgbi', NULL, '2021-01-17 18:29:56', '2021-01-19 13:06:09'),
(2, 'Iqbal', 'jarrell69@example.org', NULL, NULL, NULL, '$2y$10$3mncEfg9njTQatZtcXmNZ.bWDg9gZQRZ2.1zqGt/omD.ofPlPq5Ni', NULL, '2021-01-17 18:59:05', '2021-01-17 18:59:05'),
(3, 'Victor Joyce', 'hari@mailinator.com', '+1 (506) 725-2775', 'Facere consequatur', NULL, '$2y$10$Z8GZ7f7Tip6TVV/.fEqBsOp3no/KsuoQAeDvucVDOacU4wyEQJVO6', NULL, '2021-01-17 19:00:34', '2021-01-17 19:16:01'),
(4, 'Alfreda Todd', 'xalihapoke@mailinator.com', NULL, NULL, NULL, '$2y$10$Gb1Fmy8YhgiRCoQPUpjeD.7j4skj89iWE8o2aJYPnkykJYzgl6bZS', NULL, '2021-01-17 19:04:14', '2021-01-17 19:04:14'),
(5, 'Kim Velazquez', 'deduji@mailinator.com', NULL, NULL, NULL, '$2y$10$8SwCjE2v.l1/eDKOhzufle04DxchJUILPOaTWtn23xe7c7TniYN3.', NULL, '2021-01-17 19:04:38', '2021-01-17 19:04:38'),
(6, 'Lionel Cantu', 'cexofanity@mailinator.com', '2342423432432', 'Dhaka', NULL, '$2y$10$Ahs7/BHlHQm4Js696GUl5OaHfF5TXyvoYcghLg8FyRwMgh0pyjqr6', NULL, '2021-01-17 19:05:00', '2021-01-17 19:16:17'),
(7, 'Nina Mccray', 'dytahevicu@mailinator.com', NULL, NULL, NULL, '$2y$10$vz/b.Ed/CXwS9dDtUGMXU.ncN9ZztCGPqCMWo2Qq8eMFPx15Lkmly', NULL, '2021-01-19 14:45:22', '2021-01-19 14:45:22'),
(8, 'Yen Moss', 'satyfyfuxu@mailinator.com', NULL, NULL, NULL, '$2y$10$v4cxK5IOSCVxogRdo1lVYehzIPIabViWNnlNQO1k5ZtBGMJfPsSYe', NULL, '2021-01-19 18:26:22', '2021-01-19 18:26:22'),
(9, 'Cailin Mcdaniel', 'sawaquna@mailinator.com', NULL, NULL, NULL, '$2y$10$BLrFSgr6YIr1BGoA2LCOqOFKKIavtT/wpGlmrHPwbaxxQuKk93eSO', NULL, '2021-01-19 18:28:16', '2021-01-19 18:28:16'),
(10, 'Hadisur Rahman', 'hudacse6@gmail.com', NULL, NULL, NULL, '$2y$10$Nmw3sGuoV4UzSM5cW8yqG.PYRDSuZJxzGK9xRQthuwyRen09qgskO', NULL, '2021-01-22 03:45:07', '2021-01-22 03:45:07');

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
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_product_id_foreign` (`product_id`);

--
-- Indexes for table `offer_user`
--
ALTER TABLE `offer_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments_logs`
--
ALTER TABLE `payments_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shipping_methods_title_unique` (`title`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sliders_title_unique` (`title`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `socials_name_unique` (`name`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `taxes_name_unique` (`name`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offer_user`
--
ALTER TABLE `offer_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments_logs`
--
ALTER TABLE `payments_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
