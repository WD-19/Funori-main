-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 21, 2025 at 12:29 AM
-- Server version: 8.0.42
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `funori_base`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `receiver_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ward` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `receiver_name`, `receiver_phone`, `street_address`, `province`, `district`, `ward`, `address_type`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 2, 'Bác. Bảo Liên Quân', '0964631411', '154 Phố Nữ', NULL, NULL, NULL, NULL, 1, '2025-07-09 06:27:25', '2025-07-09 06:27:25'),
(2, 3, 'Bác. Kiều Chiêu Toàn', '0985733935', '391 Phố Khuyên', NULL, NULL, NULL, NULL, 1, '2025-07-09 06:27:26', '2025-07-09 06:27:26'),
(3, 4, 'Phùng Họa Quyên', '0975039752', '1073 Phố Đới', NULL, NULL, NULL, NULL, 1, '2025-07-09 06:27:26', '2025-07-09 06:27:26'),
(4, 5, 'Ông. Lục Hùng Trung', '0912355543', '1 Phố Giang Phú Đào', NULL, NULL, NULL, NULL, 1, '2025-07-09 06:27:27', '2025-07-09 06:27:27'),
(5, 6, 'Khưu Lương', '0935043416', '7 Phố Thái Kiên Ngôn', NULL, NULL, NULL, NULL, 1, '2025-07-09 06:27:27', '2025-07-09 06:27:27'),
(6, 7, 'Bác. Cam Thoại', '0911858411', '2837 Phố Ngân Trúc Uyên', NULL, NULL, NULL, NULL, 1, '2025-07-09 06:27:28', '2025-07-09 06:27:28'),
(7, 8, 'Yên Hùng Hành', '0943762677', '1 Phố Kim Siêu Thoại', NULL, NULL, NULL, NULL, 1, '2025-07-09 06:27:28', '2025-07-09 06:27:28'),
(8, 9, 'Tiêu Hạc Cầm', '0911560601', '9930 Phố Nông Hảo Đạo', NULL, NULL, NULL, NULL, 1, '2025-07-09 06:27:29', '2025-07-09 06:27:29'),
(9, 10, 'Lô Cường Thạch', '0950060766', '308 Phố Việt', NULL, NULL, NULL, NULL, 1, '2025-07-09 06:27:29', '2025-07-09 06:27:29'),
(10, 11, 'Phương Chấn', '0978486702', '44 Phố Thuần', NULL, NULL, NULL, NULL, 1, '2025-07-09 06:27:30', '2025-07-09 06:27:30'),
(11, 12, 'Nguyễn Tiến Thuận', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội', 'Thành phố Hà Nội', 'Thị xã Sơn Tây', 'Xã Kim Sơn', NULL, 0, '2025-07-26 03:58:27', '2025-07-26 03:58:27'),
(12, 12, 'Nguyễn Tiến Thuận45', '0373607862', 'Thôn 1', 'Thành phố Hà Nội', 'Quận Nam Từ Liêm', 'Phường Phương Canh', NULL, 0, '2025-08-01 05:50:27', '2025-08-01 05:50:27');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Chất liệu', '2025-07-09 06:27:30', '2025-07-09 06:27:30');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint UNSIGNED NOT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL,
  `value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'Gỗ', '2025-07-09 06:27:30', '2025-07-09 06:27:30'),
(2, 1, 'Kim loại', '2025-07-09 06:27:30', '2025-07-09 06:27:30'),
(3, 1, 'Da', '2025-07-09 06:27:30', '2025-07-09 06:27:30'),
(4, 1, 'Vải', '2025-07-09 06:27:30', '2025-07-09 06:27:30'),
(5, 1, 'Nhựa', '2025-07-09 06:27:30', '2025-07-09 06:27:30'),
(6, 1, 'Kính', '2025-07-10 01:01:42', '2025-07-10 01:01:42'),
(8, 1, 'Đá thạch anh', '2025-07-10 01:04:47', '2025-07-10 01:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `position` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `image_url`, `link_url`, `description`, `position`, `order`, `start_date`, `end_date`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Giường', 'banners/qxqJ9wBJ9rcOwWAl5XgZHGSU0IL22WUdW5Nek3zE.jpg', 'http://127.0.0.1:8000/shop?category_id=20', 'Est laboriosam dolores quia placeat modi laborum odio ipsum sed quaerat mollitia ipsum eligendi.', 'banner_category', 3, '2025-06-19 19:07:57', NULL, 1, '2025-02-23 20:09:51', '2025-07-26 01:53:15'),
(4, 'Et qui excepturi doloribus.', 'https://via.placeholder.com/1200x400.png/008855?text=abstract+quam', NULL, 'Est distinctio aperiam qui eveniet itaque perferendis.', 'sidebar', 1, '2025-04-19 23:48:27', '2025-07-30 20:29:21', 0, '2025-04-13 17:34:02', '2025-07-26 02:01:23'),
(5, 'Iure officia facere quia.', 'https://via.placeholder.com/1200x400.png/0077ff?text=abstract+neque', 'http://www.damore.org/suscipit-et-magnam-autem-aliquam-iusto-non-cumque.html', 'Quia ipsum deserunt quis autem quae fugit autem enim qui unde quo maiores ipsam qui.', 'sidebar', 4, '2025-06-27 01:00:02', '2025-09-15 23:45:05', 0, '2025-07-03 18:30:02', '2025-07-26 02:01:37'),
(6, 'Autem itaque tempore porro.', 'https://via.placeholder.com/1200x400.png/009955?text=abstract+facilis', 'http://kulas.org/quia-sequi-possimus-qui-rerum-non-odit', 'Placeat assumenda non sint impedit odio sed dolore.', 'sidebar', 3, '2025-05-03 21:34:23', NULL, 0, '2025-02-15 12:39:27', '2025-07-26 02:01:32'),
(7, 'Sint ut voluptas consequatur aut.', 'https://via.placeholder.com/1200x400.png/00cc55?text=abstract+neque', 'http://www.willms.com/sed-eaque-quisquam-provident-et-id-sint', 'At saepe nostrum qui nulla corrupti unde facere ex.', 'sidebar', 4, '2025-04-21 06:46:08', '2025-10-01 14:41:24', 0, '2025-04-06 16:20:16', '2025-07-26 02:01:38'),
(8, 'Praesentium aut minima mollitia laudantium.', 'https://via.placeholder.com/1200x400.png/0011aa?text=abstract+excepturi', 'http://www.bruen.com/ut-dicta-illo-rerum-reprehenderit-veritatis-dolorum-doloribus', 'Provident eum sapiente commodi temporibus quam numquam quia consequuntur consectetur.', 'product_page_banner', 2, '2025-05-11 18:08:40', NULL, 0, '2025-05-11 09:53:06', '2025-07-26 02:01:27'),
(9, 'Maxime repellat ipsam sit assumenda possimus.', 'https://via.placeholder.com/1200x400.png/008866?text=abstract+dicta', NULL, 'Voluptas vitae est excepturi voluptatem dolore qui error maxime aut quas.', 'product_page_banner', 8, '2025-04-18 20:25:38', '2025-09-28 01:56:48', 0, '2025-05-05 14:33:00', '2025-07-26 02:01:45'),
(10, 'Doloribus quod eos soluta.', 'https://via.placeholder.com/1200x400.png/005533?text=abstract+molestias', 'http://www.crooks.com/quas-et-in-soluta-ipsa-id-dolore-autem-corporis', 'Qui corporis nobis accusamus fugiat repellat aut quia ab.', 'homepage_slider', 10, '2025-07-05 20:35:30', NULL, 0, '2025-04-26 03:35:00', '2025-07-26 02:01:45'),
(11, 'sofa', 'banners/6wj35qovOF6q10F84BH8AGagzgGY3cwlSNG7AsJj.jpg', 'http://127.0.0.1:8000/shop?category_id=16', NULL, 'banner_category', 1, '2025-07-01 16:56:00', '2025-07-24 16:56:00', 1, '2025-07-15 02:04:48', '2025-07-26 02:29:53'),
(12, 'Bàn', 'banners/UhxyqQNto3UPXMz7glAXk2QnA06y6yLRV3lrSiIG.jpg', 'http://127.0.0.1:8000/shop?category_id=14', NULL, 'banner_category', 3, '2025-07-20 09:06:00', '2025-07-31 09:06:00', 1, '2025-07-16 19:06:41', '2025-07-26 02:30:53'),
(13, '1', 'banners/WvjN3bXerEd4FvdJYg9rSiJIP39U0xbnwl1NJYxF.jpg', NULL, NULL, 'banner_home', 1, NULL, NULL, 1, '2025-07-26 02:26:48', '2025-07-26 02:26:48'),
(14, '2', 'banners/FlepCWyS2akBlFqLxCNHB7xHIzg3E3h7UHtNJe4B.jpg', NULL, NULL, 'banner_home', 1, NULL, NULL, 1, '2025-07-26 02:33:33', '2025-07-26 02:33:33'),
(15, '3', 'banners/8u5kQyDVlh980f2RjYXyTLARN7HiRKcptGc0KyxS.jpg', NULL, NULL, 'banner_home', 3, NULL, NULL, 1, '2025-07-26 02:33:57', '2025-07-26 02:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `logo_url`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'Nội thất Funi', 'noi-that-funi', 'logos/vQWBFNHGaJjFYx1ntJw9MF51PWnzNSCdb9oqO6gU.jpg', NULL, 1, '2025-07-09 06:27:30', '2025-07-26 02:48:08'),
(7, 'Nội thất Minh Khôi', 'noi-that-minh-khoi', 'logos/49RaLsu6ojXZWRsYuGY8Lao2VyauZgKySoU8gmMo.jpg', NULL, 1, '2025-07-09 06:27:30', '2025-07-26 02:48:18'),
(8, 'Nội thất Nhà Xinh', 'noi-that-nha-xinh', 'logos/gMnldTY5JyJW9YciXaqXcUgMNrAVFtVJbx8dVhHY.jpg', NULL, 1, '2025-07-09 06:27:30', '2025-07-26 02:48:27'),
(9, 'Nội thất Phố Xinh', 'noi-that-pho-xinh', 'logos/XSJmlAwGs5kCz4JfhxBqEKQ7qtIrL9CPcCmYzhoO.jpg', NULL, 1, '2025-07-09 06:27:30', '2025-07-26 02:48:36'),
(10, 'Nội thất Vina', 'noi-that-vina', 'logos/nvt69swsHM8lq5ri84CdKwaSJH64lHR5OG3qXsir.jpg', NULL, 1, '2025-07-09 06:27:30', '2025-07-26 02:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 13, '2025-07-24 22:52:16', '2025-07-24 22:52:16'),
(5, 12, '2025-07-26 15:26:42', '2025-07-26 15:26:42'),
(6, 14, '2025-08-01 00:45:50', '2025-08-01 00:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint UNSIGNED NOT NULL,
  `cart_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_variant_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `price_at_addition` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `product_variant_id`, `quantity`, `price_at_addition`, `created_at`, `updated_at`) VALUES
(26, 2, 77, 127, 2, '32000000.00', '2025-08-01 04:14:06', '2025-08-01 04:14:06'),
(27, 2, 75, 123, 1, '19999999.00', '2025-08-01 04:14:34', '2025-08-01 04:14:34'),
(28, 2, 75, 122, 1, '19999999.00', '2025-08-01 04:14:40', '2025-08-01 04:14:40'),
(29, 6, 77, 127, 1, '32000000.00', '2025-08-01 04:17:12', '2025-08-01 04:17:12'),
(30, 6, 55, 95, 1, '8500000.00', '2025-08-01 04:17:21', '2025-08-01 04:17:21'),
(32, 5, 43, 77, 1, '11000000.00', '2025-08-03 11:58:06', '2025-08-03 11:58:06'),
(33, 5, 73, 118, 1, '14000000.00', '2025-08-04 04:03:27', '2025-08-04 04:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `description`, `image_url`, `is_active`, `created_at`, `updated_at`) VALUES
(16, 'Sofa', 'sofa', NULL, NULL, 'categories/4ZjhLpg01Ni14SbUN05NwdZnEJhOGWj0EULZ5u8H.jpg', 1, '2025-07-09 06:37:43', '2025-07-26 02:37:22'),
(17, 'Ghế', 'ghe', NULL, NULL, 'categories/aNz3IqyQ2mAwyMNQnxhiEdBAXdMvxrqMnV0u13eY.jpg', 1, '2025-07-09 18:35:59', '2025-07-26 02:37:11'),
(18, 'Ghế bành', 'ghe-banh', 17, 'Ghế bành', 'categories/CC65aYZDDvQovgsU1cCS1pvuBzrkz8Kgli6k10Ey.jpg', 1, '2025-07-09 18:36:12', '2025-07-09 18:36:12'),
(19, 'Bàn', 'ban', NULL, NULL, 'categories/ldst0Puj130FWNL4KIHw8fHdH8ubvZ5boQfysT0w.jpg', 1, '2025-07-09 18:36:32', '2025-07-26 02:36:42'),
(20, 'Giường', 'giuong', NULL, NULL, 'categories/s9zUyCimrObZLyu4rXbpUJnJzca9Aspel7nO9kZM.jpg', 1, '2025-07-09 18:37:01', '2025-07-26 02:36:24'),
(21, 'Bàn bên', 'ban-ben', 19, NULL, 'categories/Vt4NDs5E8Cf48BZzTDLwTmMQWntrIPONaLc593Iy.jpg', 1, '2025-07-09 18:37:25', '2025-07-09 18:37:25'),
(22, 'Bàn nước', 'ban-nuoc', 19, NULL, 'categories/VE41lkPInkHOOW0guoymMX3ApLqoKjxtAf18CNd2.jpg', 1, '2025-07-09 18:37:41', '2025-07-09 18:37:41'),
(23, 'Đôn', 'on', 17, NULL, 'categories/DLXqzazjrYH4jYloSe5ajvoiCOj7ezghw8ByKfKH.jpg', 1, '2025-07-09 20:02:27', '2025-07-09 20:02:27'),
(24, 'Ghế ăn', 'ghe-an', 17, NULL, 'categories/DQVaVLHGJ2mRcM6U0zLHAF5aY8QoFz6dA3j6bX63.jpg', 1, '2025-07-10 01:18:26', '2025-07-10 01:18:26'),
(25, 'Bàn ăn', 'ban-an', 19, NULL, 'categories/0v5C2n6zSOrLxJ57gNk4eB0CkXh3voa2KRVGsoqK.jpg', 1, '2025-07-10 01:32:18', '2025-07-10 01:32:18'),
(26, 'Tủ', 'tu', NULL, NULL, 'categories/IZw3ApNdZeuttb1YjihtVugD1C5hJAXN5wD0BsB1.jpg', 1, '2025-07-10 01:59:59', '2025-07-26 02:36:11'),
(27, 'Tủ tivi', 'tu-tivi', 26, NULL, 'categories/fhgJJZByNSGBsQF8DLJG1xZwp8opBV53Jx0LjGZl.jpg', 1, '2025-07-10 02:00:19', '2025-07-10 02:00:19');

-- --------------------------------------------------------

--
-- Table structure for table `contact_submissions`
--

CREATE TABLE `contact_submissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('new','read','replied','resolved') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `admin_reply` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `replied_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_submissions`
--

INSERT INTO `contact_submissions` (`id`, `name`, `email`, `message`, `status`, `admin_reply`, `replied_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Marcellus Will', 'sauer.joanne@example.net', 'Error quis consequatur magni nulla aut vel. Delectus quo voluptatibus atque unde nostrum vel sequi. Deleniti commodi veritatis excepturi possimus quibusdam voluptas sequi.', 'resolved', 'Aliquid animi architecto facilis asperiores. Est cumque sit qui expedita eaque labore eum. Et iure perspiciatis iste esse distinctio ea distinctio vel.', 1, '2025-02-03 07:48:08', '2025-04-08 12:23:55', NULL),
(2, 'Reva Mayer Sr.', 'rylee.rogahn@example.org', 'Eveniet nobis laborum similique et reiciendis. Incidunt et at excepturi praesentium nulla. In aut impedit modi maxime voluptatum.', 'replied', 'Sit ipsum ut voluptas atque. Nam error deserunt consectetur fugit soluta voluptas. Ipsum id officiis voluptatem nihil corrupti saepe omnis. Quisquam sit omnis voluptatum et.', 1, '2025-03-03 21:27:34', '2025-03-05 03:31:54', NULL),
(3, 'Grayson Mitchell', 'ohaley@example.org', 'Ipsum optio provident cum ipsum. Ut itaque beatae autem velit et ut ut corrupti. Eveniet temporibus blanditiis dolores consequatur ea perferendis magnam aut. Ipsa similique inventore nemo earum animi consequuntur sed.', 'read', NULL, NULL, '2025-03-05 15:40:50', '2025-05-05 11:45:15', NULL),
(4, 'Dr. Amber Grady', 'hirthe.margarette@example.net', 'Saepe sed officia consectetur et. Qui sed sint dolore totam. Voluptatem voluptas laborum voluptatibus maxime.', 'replied', 'Alias sit error velit voluptatem eaque. Odio nisi suscipit aut vel officia fuga cumque. Aspernatur qui dolore et dolores et.', 1, '2025-04-01 01:41:53', '2025-06-14 21:29:44', NULL),
(5, 'Prof. Diamond Gleichner', 'wuckert.sammy@example.com', 'Ullam ad repellendus qui. Esse veniam illum suscipit sed error omnis. Maiores voluptatum nisi nam. Reprehenderit doloribus qui ipsum consequuntur et accusantium.', 'resolved', 'At veritatis odit a ab animi accusamus. Eos earum dolore at consequatur et officiis voluptas. Aut voluptatibus enim quo. Quos non ab voluptatem.', 1, '2025-04-04 23:59:24', '2025-04-29 00:07:10', NULL),
(6, 'Ms. Tiffany Lubowitz', 'lemke.amari@example.com', 'Atque totam exercitationem quibusdam ut quia consequatur. Suscipit consequuntur sit ullam rerum eos quidem a. Dolores dolorem consequatur neque et illo tempora.', 'replied', 'Deserunt tempore debitis aperiam saepe. Molestiae molestiae error in.', 1, '2025-03-08 01:20:12', '2025-05-04 03:32:32', NULL),
(7, 'Ms. Katelin Glover V', 'breanna73@example.net', 'In in aut mollitia est dolorem. Labore laborum et enim odit. Aliquam veniam dolorem aliquam similique fugit voluptatum. Quo maiores illum reprehenderit est praesentium et.', 'replied', 'Nihil laborum dolores cumque enim nobis. Quos enim nihil hic et. Occaecati nobis rerum qui harum qui.', 1, '2025-05-22 14:11:01', '2025-05-21 18:29:13', NULL),
(8, 'Eula Reichel', 'rjenkins@example.com', 'Voluptatem est velit fugiat ea laboriosam. Corporis voluptate exercitationem voluptas. Numquam est et quo quisquam cupiditate expedita a. Labore et veniam officia non. Debitis corporis asperiores aut beatae perferendis inventore.', 'replied', 'Quisquam modi in et exercitationem a. Fugit sunt quas eaque dolore. Eaque cupiditate culpa alias ipsum omnis optio voluptatem. Quasi quia praesentium quis sit molestiae odio.', 1, '2025-04-01 07:34:44', '2025-05-10 15:17:42', NULL),
(9, 'Miss Kristina Boehm I', 'anita19@example.net', 'Suscipit ut eum omnis ut quia. Aut asperiores esse qui doloremque. Et minus et possimus reiciendis cupiditate iusto laborum laborum. Odit esse ullam voluptatum labore quidem aspernatur saepe.', 'replied', 'Rem voluptatem dolorem maiores ipsa rerum. Rerum voluptatem assumenda recusandae quae. Aut blanditiis magni et est amet laboriosam.', 1, '2025-03-19 18:24:07', '2025-05-09 06:33:24', NULL),
(10, 'Matilde Zemlak', 'adams.alisha@example.net', 'Quis et nobis aut et sint vel eos nesciunt. Iste vel quia blanditiis ipsa voluptatem. Quasi corrupti et est magni. Quia dolores eius quasi aliquam voluptas iure enim pariatur.', 'resolved', 'Reiciendis commodi hic rerum possimus hic dolore. Repellat alias vel repudiandae qui id. Fugiat perferendis quis ex rem ea vel. Unde nisi autem animi ut totam nostrum corporis. Aliquam nobis inventore tempore molestiae quia.', 1, '2025-01-18 13:03:03', '2025-02-12 12:55:27', NULL),
(11, 'Prof. Preston Graham V', 'concepcion.waters@example.net', 'Laboriosam repudiandae eos rerum voluptatum et sunt. Natus neque provident numquam omnis quia. Eaque culpa sit illum. Asperiores quaerat pariatur et rerum mollitia ad nihil.', 'new', NULL, NULL, '2025-02-14 08:25:03', '2025-03-05 21:00:47', NULL),
(12, 'Prof. Freeda Rice', 'bartholome70@example.org', 'Excepturi quia in quis sint maiores itaque. Ipsa eum repudiandae quos necessitatibus eos qui totam quo. Ullam et tempora non ullam quam.', 'new', NULL, NULL, '2025-04-11 20:01:29', '2025-06-09 17:39:09', NULL),
(13, 'Mr. Kiel Kuphal V', 'cielo00@example.org', 'Reiciendis repellendus asperiores nulla omnis nisi qui. Id saepe mollitia et quia est iste. Dolorem est et unde odio quod occaecati at. Quia quia natus perferendis culpa pariatur possimus asperiores.', 'new', NULL, NULL, '2025-05-13 10:56:28', '2025-05-17 00:07:03', NULL),
(14, 'Theresia Harris', 'cklocko@example.org', 'Nostrum eum voluptatum ut. Maxime molestias et non quod nam nostrum.', 'resolved', 'Neque aspernatur cum aut omnis. Dolor velit dolores rerum earum.', 1, '2025-05-17 15:58:27', '2025-06-12 22:13:28', NULL),
(15, 'Prof. Patsy Bruen', 'rodolfo.schaden@example.com', 'Sequi rerum temporibus modi dolorem accusantium. Temporibus alias aliquam corporis porro. Aut ad voluptatem impedit.', 'new', NULL, NULL, '2025-01-21 08:47:04', '2025-02-08 11:10:13', NULL),
(16, 'Clarissa Kihn', 'feest.corine@example.org', 'Nesciunt dolor fugiat et hic et. Omnis voluptas aut eveniet et ratione sunt dolores. Neque consequatur rerum consectetur exercitationem placeat. Unde soluta asperiores quidem cumque rem aut doloribus. Molestias ea et voluptates doloremque.', 'replied', 'Aut et odit voluptatibus sint corporis et est sunt. Ut totam magnam veniam voluptate sint aliquid doloremque. Ratione eos iure nam cum dolor unde vel. Odio deserunt eos occaecati provident.', 1, '2025-06-19 13:44:37', '2025-02-21 17:20:56', NULL),
(17, 'Mrs. Kylee Strosin', 'isporer@example.org', 'Necessitatibus sit nihil quia molestiae aut. Consectetur perferendis est nihil saepe ipsa autem atque.', 'read', NULL, NULL, '2025-06-08 09:13:15', '2025-02-16 01:28:37', NULL),
(18, 'Kaden Shields', 'fern28@example.net', 'Aspernatur quo sit aut placeat voluptatem et cumque harum. Explicabo sequi laudantium molestias consectetur. Voluptatum consequatur laborum quidem sint quisquam harum id. Consectetur sed illum ut aut est odit eligendi. Deleniti autem alias praesentium quae in fugiat cumque.', 'replied', 'Pariatur dolor excepturi eius expedita placeat. Dicta ipsam veritatis occaecati. Pariatur totam consectetur omnis quo facilis ex.', 1, '2025-03-06 19:42:17', '2025-02-07 17:02:10', NULL),
(19, 'Hailee Erdman', 'anika31@example.net', 'Optio itaque nostrum corporis facere aspernatur sunt ipsum velit. Enim aliquam est omnis hic iste iste minima. Velit aperiam ullam maxime est aut non qui dolorem. Rerum sed veniam omnis et molestias.', 'resolved', 'Perspiciatis doloribus nemo earum explicabo totam nam odio dolore. Placeat est ipsa eaque nisi. Qui nostrum non quia. Cumque consequatur ut quia molestiae suscipit reiciendis ducimus iusto.', 1, '2025-04-26 03:07:37', '2025-05-04 02:32:42', NULL),
(20, 'Jazmin Blanda', 'stamm.duane@example.net', 'Esse explicabo est consequatur est ea accusantium modi. Eum eveniet non saepe quo maiores. Molestiae qui veniam sequi doloremque aperiam. Asperiores magnam non minus natus.', 'resolved', 'Doloribus cupiditate a assumenda facere velit natus soluta sint. Aperiam in illum suscipit est dolor nemo maiores velit.', 1, '2025-03-25 07:11:22', '2025-02-04 23:11:42', NULL),
(21, 'Nguyễn Tiến Thuận', 'b@gmail.com', 'ầedfadada', 'new', 'dfgsrhtjhgbfvdcsdfg', 12, '2025-07-10 19:50:42', '2025-07-10 19:51:34', NULL),
(22, 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', 'alooooooooooooooooo', 'new', 'hiiii', 12, '2025-07-16 19:44:56', '2025-07-16 19:45:21', NULL),
(23, 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', 'abc', 'replied', 'hiiiiiiiiiiiiiiiiiiiii', 12, '2025-07-26 03:57:04', '2025-07-26 03:57:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `last_message_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `user_id`, `admin_id`, `last_message_at`, `created_at`, `updated_at`) VALUES
(1, 12, NULL, '2025-08-03 11:57:23', '2025-08-03 11:54:34', '2025-08-03 11:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `conversation_id` bigint UNSIGNED NOT NULL,
  `sender_id` bigint UNSIGNED DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `files` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_id`, `content`, `is_admin`, `created_at`, `updated_at`, `files`) VALUES
(1, 1, 12, 'alo', 0, '2025-08-03 11:57:23', '2025-08-03 11:57:23', '[]'),
(2, 1, 12, 'hehe', 1, '2025-08-03 11:57:37', '2025-08-03 11:57:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_06_01_000000_create_orders_table', 1),
(2, '2024_06_05_000002_add_status_timestamps_to_orders_table', 1),
(3, '2024_06_10_000000_add_buyer_info_to_orders_table', 1),
(4, '2025_05_30_025801_create_users_table', 1),
(5, '2025_05_30_025822_create_addresses_table', 1),
(6, '2025_05_30_025846_create_categories_table', 1),
(7, '2025_05_30_025907_create_brands_table', 1),
(8, '2025_05_30_030043_create_products_table', 1),
(9, '2025_05_30_030104_create_product_images_table', 1),
(10, '2025_05_30_030115_create_attributes_table', 1),
(11, '2025_05_30_030127_create_attribute_values_table', 1),
(12, '2025_05_30_030143_create_product_variants_table', 1),
(13, '2025_05_30_030153_create_product_variant_attribute_values_table', 1),
(14, '2025_05_30_030203_create_carts_table', 1),
(15, '2025_05_30_030213_create_cart_items_table', 1),
(16, '2025_05_30_030225_create_payment_methods_table', 1),
(17, '2025_05_30_030301_create_shipping_methods_table', 1),
(18, '2025_05_30_030330_create_order_items_table', 1),
(19, '2025_05_30_030340_create_reviews_table', 1),
(20, '2025_05_30_030352_create_wishlists_table', 1),
(21, '2025_05_30_030400_create_wishlist_items_table', 1),
(22, '2025_05_30_030410_create_promotions_table', 1),
(23, '2025_05_30_030417_create_promotion_brand_table', 1),
(24, '2025_05_30_030427_create_promotion_category_table', 1),
(25, '2025_05_30_030442_create_order_promotion_table', 1),
(26, '2025_05_30_030453_create_banners_table', 1),
(27, '2025_05_30_030503_create_pages_table', 1),
(28, '2025_05_30_030514_create_contact_submissions_table', 1),
(29, '2025_06_11_055410_create_personal_access_tokens_table', 1),
(30, '2025_06_15_022108_create_cache_table', 1),
(31, '2025_06_25_083014_create_order_status_histories_table', 1),
(32, '2025_07_10_075953_add_structured_address_to_addresses_table', 2),
(33, '2025_07_10_092353_add_phone_to_users_table', 2),
(34, '2025_07_15_152038_add_two_factor_columns_to_users_table', 2),
(35, '2025_07_16_022109_create_password_reset_tokens_table', 2),
(36, '2025_07_17_033049_add_google_id_to_users_table', 2),
(37, '2024_07_10_000001_add_discount_code_to_orders_table', 3),
(38, '2025_07_18_083255_add_payment_details_to_orders_table', 3),
(39, '2025_08_02_000331_create_messages_table', 4),
(40, '2025_08_02_180322_add_files_to_messages_table', 5),
(41, '2025_08_05_174318_create_shippers_table', 6),
(42, '2025_08_05_174410_add_shipper_id_to_orders_table', 6),
(43, '2025_08_05_214758_add_delivery_tracking_to_orders_table', 6),
(44, '2025_08_05_221247_create_sessions_table', 6),
(45, '2025_08_06_123546_add_location_fields_to_shippers_table', 6),
(46, '2025_08_06_123825_add_gps_fields_to_orders_table', 6),
(47, '2025_08_07_162343_create_notifications_table', 6),
(48, '2025_08_07_201707_add_image_path_to_status_histories_table', 6),
(49, '2025_08_08_000100_update_order_status_enum_add_returned', 6),
(50, '2025_08_11_230542_create_jobs_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `shipper_id` bigint UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` json DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `shipper_id` bigint UNSIGNED DEFAULT NULL,
  `received_at` timestamp NULL DEFAULT NULL,
  `in_delivery_at` timestamp NULL DEFAULT NULL,
  `failed_at` timestamp NULL DEFAULT NULL,
  `delivery_notes` text COLLATE utf8mb4_unicode_ci,
  `failure_reason` text COLLATE utf8mb4_unicode_ci,
  `delivery_images` json DEFAULT NULL,
  `order_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer_phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `subtotal_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `discount_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `payment_method_id` bigint UNSIGNED NOT NULL,
  `payment_status` enum('pending','paid','failed','refunded') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_details` json DEFAULT NULL,
  `shipping_method_id` bigint UNSIGNED NOT NULL,
  `order_status` enum('pending_confirmation','confirmed','pending','processing','assigned','received','in_delivery','shipped','delivered','failed','cancelled','returned','pending_cancellation') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending_confirmation',
  `customer_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `admin_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `ordered_at` timestamp NULL DEFAULT NULL,
  `processing_at` timestamp NULL DEFAULT NULL,
  `shipped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `returned_at` timestamp NULL DEFAULT NULL,
  `cancellation_reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `previous_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shipping_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_lat` decimal(10,8) DEFAULT NULL,
  `shipping_lng` decimal(11,8) DEFAULT NULL,
  `delivery_lat` decimal(10,8) DEFAULT NULL,
  `delivery_lng` decimal(11,8) DEFAULT NULL,
  `delivery_started_at` timestamp NULL DEFAULT NULL,
  `delivery_completed_at` timestamp NULL DEFAULT NULL,
  `delivery_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `shipper_id`, `received_at`, `in_delivery_at`, `failed_at`, `delivery_notes`, `failure_reason`, `delivery_images`, `order_code`, `customer_name`, `customer_email`, `customer_phone`, `shipping_address`, `buyer_name`, `buyer_email`, `buyer_phone`, `buyer_address`, `subtotal_amount`, `shipping_fee`, `discount_amount`, `discount_code`, `tax_amount`, `total_amount`, `payment_method_id`, `payment_status`, `payment_details`, `shipping_method_id`, `order_status`, `customer_note`, `admin_note`, `ordered_at`, `processing_at`, `shipped_at`, `delivered_at`, `cancelled_at`, `returned_at`, `cancellation_reason`, `previous_status`, `created_at`, `updated_at`, `shipping_name`, `shipping_phone`, `shipping_email`, `shipping_lat`, `shipping_lng`, `delivery_lat`, `delivery_lng`, `delivery_started_at`, `delivery_completed_at`, `delivery_address`) VALUES
(21, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-686FC9ED8AA61', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '3rwr34534534535, Phường Gia Thụy, Quận Long Biên, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '3rwr34534534535, Phường Gia Thụy, Quận Long Biên, Thành phố Hà Nội', '139500000.00', '60000.00', '0.00', NULL, '0.00', '139560000.00', 1, 'pending', NULL, 2, 'pending_confirmation', 'safs', NULL, '2025-07-10 07:10:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-10 07:10:53', '2025-07-10 07:10:53', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-686FCF60B918B', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'rada, Xã Mê Linh, Huyện Mê Linh, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'rada, Xã Mê Linh, Huyện Mê Linh, Thành phố Hà Nội', '64000000.00', '0.00', '0.00', NULL, '0.00', '64000000.00', 1, 'pending', NULL, 3, 'delivered', NULL, NULL, '2025-07-10 07:34:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-10 07:34:08', '2025-07-10 07:34:08', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6870DAED30FE1', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '34567ytgrf, Phường Tứ Liên, Quận Tây Hồ, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '34567ytgrf, Phường Tứ Liên, Quận Tây Hồ, Thành phố Hà Nội', '52000000.00', '60000.00', '0.00', NULL, '0.00', '52060000.00', 1, 'pending', NULL, 2, 'delivered', NULL, NULL, '2025-07-11 02:35:41', '2025-07-14 19:13:20', '2025-07-14 19:13:27', NULL, NULL, NULL, NULL, NULL, '2025-07-11 02:35:41', '2025-07-14 19:13:27', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6870DB635BDDC', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '34565, Xã Mê Linh, Huyện Mê Linh, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '3rwr34534534535, Phường Quảng An, Quận Tây Hồ, Thành phố Hà Nội', '59999997.00', '60000.00', '0.00', NULL, '0.00', '60059997.00', 2, 'pending', NULL, 2, 'delivered', NULL, NULL, '2025-07-11 02:37:39', '2025-07-14 19:33:06', '2025-07-14 19:33:11', NULL, NULL, NULL, NULL, NULL, '2025-07-11 02:37:39', '2025-07-14 19:33:11', 'THuan', '0373607863', 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6870DC38A8F80', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '3rwr34534534535, Phường Xuân Tảo, Quận Bắc Từ Liêm, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '3rwr34534534535, Phường Xuân Tảo, Quận Bắc Từ Liêm, Thành phố Hà Nội', '51000000.00', '60000.00', '0.00', NULL, '0.00', '51060000.00', 2, 'pending', NULL, 2, 'delivered', NULL, NULL, '2025-07-11 02:41:12', '2025-07-14 19:06:25', '2025-07-14 19:06:28', '2025-07-14 19:11:31', NULL, '2025-07-14 19:13:07', NULL, NULL, '2025-07-11 02:41:12', '2025-07-14 19:13:07', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6870DD1F33D73', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'e3rwrfw, Phường Đức Giang, Quận Long Biên, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'e3rwrfw, Phường Đức Giang, Quận Long Biên, Thành phố Hà Nội', '90000000.00', '60000.00', '0.00', NULL, '0.00', '90060000.00', 2, 'pending', NULL, 2, 'delivered', NULL, NULL, '2025-07-11 02:45:03', '2025-07-14 19:03:58', '2025-07-14 19:04:10', '2025-07-14 19:06:02', NULL, NULL, NULL, NULL, '2025-07-11 02:45:03', '2025-07-14 19:06:02', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6881915CA922A', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '3rwr34534534535, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '3rwr34534534535, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '39999998.00', '30000.00', '0.00', NULL, '0.00', '40029998.00', 1, 'pending', NULL, 1, 'delivered', NULL, NULL, '2025-07-23 18:50:20', '2025-07-23 18:50:50', '2025-07-23 18:50:53', '2025-07-23 18:50:54', NULL, NULL, NULL, NULL, '2025-07-23 18:50:20', '2025-07-23 19:06:23', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6881915CB72E7', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '3rwr34534534535, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '3rwr34534534535, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '39999998.00', '30000.00', '0.00', NULL, '0.00', '40029998.00', 1, 'pending', NULL, 1, 'delivered', NULL, NULL, '2025-07-23 18:50:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-23 18:50:20', '2025-07-23 18:50:20', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884BEEB4F001', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '47000000.00', '60000.00', '100000.00', '4D8V4Q', '0.00', '46960000.00', 5, 'pending', NULL, 2, 'pending_confirmation', NULL, NULL, '2025-07-26 04:41:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-26 04:41:31', '2025-07-26 04:41:31', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884BF3EA9653', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '47000000.00', '60000.00', '0.00', NULL, '0.00', '47060000.00', 5, 'pending', NULL, 2, 'pending_confirmation', NULL, NULL, '2025-07-26 04:42:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-26 04:42:54', '2025-07-26 04:42:54', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884BF504523D', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '47000000.00', '60000.00', '0.00', NULL, '0.00', '47060000.00', 1, 'pending', NULL, 2, 'pending_confirmation', NULL, NULL, '2025-07-26 04:43:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-26 04:43:12', '2025-07-26 04:43:12', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884BF91A3DC1', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '15000000.00', '60000.00', '0.00', NULL, '0.00', '15060000.00', 5, 'pending', NULL, 2, 'pending_confirmation', NULL, NULL, '2025-07-26 04:44:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-26 04:44:17', '2025-07-26 04:44:17', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884C11E8CA7F', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '15000000.00', '30000.00', '0.00', NULL, '0.00', '15030000.00', 5, 'pending', NULL, 1, 'pending_confirmation', NULL, NULL, '2025-07-26 04:50:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-26 04:50:54', '2025-07-26 04:50:54', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884C7335FB39', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '11000000.00', '30000.00', '0.00', NULL, '0.00', '11030000.00', 3, 'paid', '{\"amount\": \"11030000\", \"message\": \"Thành công.\", \"orderId\": \"ORD-6884C7335FB39\", \"payType\": \"aio_qr\", \"transId\": \"4552118473\", \"extraData\": null, \"orderInfo\": \"Thanh toán đơn hàng Funori #ORD-6884C7335FB39\", \"orderType\": \"momo_wallet\", \"requestId\": \"momo_6884c73364fa2\", \"signature\": \"788a9a05db3f7ca3683483ee51420d48756b4e22fbcaae4d4e3488be828670e7\", \"resultCode\": \"0\", \"partnerCode\": \"MOMOBKUN20180529\", \"responseTime\": \"1753532243694\"}', 1, 'processing', NULL, NULL, '2025-07-26 05:16:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-26 05:16:51', '2025-07-26 05:17:21', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884D76BDDE91', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '17300000.00', '30000.00', '0.00', NULL, '0.00', '17330000.00', 5, 'paid', '{\"vnp_Amount\": \"1733000000\", \"vnp_TxnRef\": \"ORD-6884D76BDDE91\", \"vnp_PayDate\": \"20250726202833\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15101387\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15101387\", \"vnp_TransactionStatus\": \"00\"}', 1, 'processing', NULL, NULL, '2025-07-26 06:26:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-26 06:26:03', '2025-07-26 06:27:36', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884D80E8ED8B', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '17300000.00', '60000.00', '0.00', NULL, '0.00', '17360000.00', 3, 'paid', '{\"amount\": \"17360000\", \"message\": \"Thành công.\", \"orderId\": \"ORD-6884D80E8ED8B\", \"payType\": \"aio_qr\", \"transId\": \"4552143564\", \"extraData\": null, \"orderInfo\": \"Thanh toán đơn hàng Funori #ORD-6884D80E8ED8B\", \"orderType\": \"momo_wallet\", \"requestId\": \"momo_6884d80e93563\", \"signature\": \"0ec2f197e7e92479de3c9278936327e2732999fc0a617051e29ab5941d2baa97\", \"resultCode\": \"0\", \"partnerCode\": \"MOMOBKUN20180529\", \"responseTime\": \"1753536595354\"}', 2, 'processing', NULL, NULL, '2025-07-26 06:28:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-26 06:28:46', '2025-07-26 06:29:53', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884D89730FD8', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '4300000.00', '30000.00', '0.00', NULL, '0.00', '4330000.00', 1, 'pending', NULL, 1, 'pending_confirmation', NULL, NULL, '2025-07-26 06:31:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-26 06:31:03', '2025-07-26 06:31:03', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884F1D5D6A57', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '12000000.00', '30000.00', '500000.00', '3D4JD5', '0.00', '11530000.00', 5, 'paid', '{\"vnp_Amount\": \"1153000000\", \"vnp_TxnRef\": \"ORD-6884F1D5D6A57\", \"vnp_PayDate\": \"20250726222019\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15101468\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15101468\", \"vnp_TransactionStatus\": \"00\"}', 1, 'delivered', NULL, NULL, '2025-07-26 08:18:45', NULL, '2025-07-26 15:31:17', '2025-07-26 15:35:21', NULL, NULL, NULL, NULL, '2025-07-26 08:18:45', '2025-07-26 15:35:21', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884F2EF48536', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '12000000.00', '30000.00', '0.00', NULL, '0.00', '12030000.00', 3, 'paid', '{\"amount\": \"12030000\", \"message\": \"Thành công.\", \"orderId\": \"ORD-6884F2EF48536\", \"payType\": \"aio_qr\", \"transId\": \"4552184128\", \"extraData\": null, \"orderInfo\": \"Thanh toán đơn hàng Funori #ORD-6884F2EF48536\", \"orderType\": \"momo_wallet\", \"requestId\": \"momo_6884f2ef4d7ef\", \"signature\": \"8193d883ded6a22ab415a7cb4dddb821ce0eb5a64cf585367e602e063f399c14\", \"resultCode\": \"0\", \"partnerCode\": \"MOMOBKUN20180529\", \"responseTime\": \"1753543430254\"}', 1, 'processing', NULL, NULL, '2025-07-26 15:23:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-26 15:23:27', '2025-07-26 15:23:48', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884F3C663206', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '27000000.00', '60000.00', '0.00', NULL, '0.00', '27060000.00', 5, 'pending', NULL, 2, 'pending_confirmation', NULL, NULL, '2025-07-26 15:27:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-26 15:27:02', '2025-07-26 15:27:02', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884F3ECCF536', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '27000000.00', '60000.00', '0.00', NULL, '0.00', '27060000.00', 1, 'pending', NULL, 2, 'pending_confirmation', NULL, NULL, '2025-07-26 15:27:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-26 15:27:40', '2025-07-26 15:27:40', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884F4443C14B', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '17000000.00', '60000.00', '0.00', NULL, '0.00', '17060000.00', 5, 'paid', '{\"vnp_Amount\": \"1706000000\", \"vnp_TxnRef\": \"ORD-6884F4443C14B\", \"vnp_PayDate\": \"20250726223030\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15101474\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15101474\", \"vnp_TransactionStatus\": \"00\"}', 2, 'processing', NULL, NULL, '2025-07-26 15:29:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-26 15:29:08', '2025-07-26 15:29:33', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-688C0FA9D61A7', 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Phường Minh Khai, Quận Bắc Từ Liêm, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Phường Minh Khai, Quận Bắc Từ Liêm, Thành phố Hà Nội', '61000000.00', '30000.00', '1000000.00', 'VNPAY123', '0.00', '60030000.00', 5, 'failed', '{\"vnp_Amount\": \"6003000000\", \"vnp_TxnRef\": \"ORD-688C0FA9D61A7\", \"vnp_PayDate\": \"20250801075258\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"VNPAY\", \"vnp_CardType\": \"QRCODE\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_ResponseCode\": \"24\", \"vnp_TransactionNo\": \"0\", \"vnp_TransactionStatus\": \"02\"}', 1, 'cancelled', NULL, NULL, '2025-08-01 00:51:53', NULL, NULL, NULL, '2025-08-01 00:52:23', NULL, 'Thanh toán VNPAY thất bại. Mã lỗi: 24', NULL, '2025-08-01 00:51:53', '2025-08-01 00:52:23', 'Nguyễn Tiến Thuận', '0373607863', 'nguyentienthuan4@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-688C0FEEDCE71', 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Phường Cổ Nhuế 2, Quận Bắc Từ Liêm, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Phường Cổ Nhuế 2, Quận Bắc Từ Liêm, Thành phố Hà Nội', '61000000.00', '60000.00', '0.00', 'VNPAY123', '0.00', '61060000.00', 5, 'paid', '{\"vnp_Amount\": \"6106000000\", \"vnp_TxnRef\": \"ORD-688C0FEEDCE71\", \"vnp_PayDate\": \"20250801075443\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15110876\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15110876\", \"vnp_TransactionStatus\": \"00\"}', 2, 'cancelled', NULL, NULL, '2025-08-01 00:53:02', NULL, NULL, NULL, '2025-08-01 00:54:03', NULL, 'Không còn nhu cầu sử dụng sản phẩm', NULL, '2025-08-01 00:53:02', '2025-08-01 00:54:03', 'Nguyễn Tiến Thuận', '0373607863', 'nguyentienthuan4@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-688C2990A14BB', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Phường Đức Giang, Quận Long Biên, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Phường Đức Giang, Quận Long Biên, Thành phố Hà Nội', '19999999.00', '60000.00', '0.00', NULL, '0.00', '20059999.00', 5, 'failed', '{\"vnp_Amount\": \"2005999900\", \"vnp_TxnRef\": \"ORD-688C2990A14BB\", \"vnp_PayDate\": \"20250801094329\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"VNPAY\", \"vnp_CardType\": \"QRCODE\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_ResponseCode\": \"24\", \"vnp_TransactionNo\": \"0\", \"vnp_TransactionStatus\": \"02\"}', 2, 'cancelled', NULL, NULL, '2025-08-01 02:42:24', NULL, NULL, NULL, '2025-08-01 02:42:42', NULL, 'Thanh toán VNPAY thất bại. Mã lỗi: 24', NULL, '2025-08-01 02:42:24', '2025-08-01 02:42:42', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-688C29B20979D', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Phường Phú Lương, Quận Hà Đông, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Phường Phú Lương, Quận Hà Đông, Thành phố Hà Nội', '19999999.00', '60000.00', '0.00', NULL, '0.00', '20059999.00', 5, 'paid', '{\"vnp_Amount\": \"2005999900\", \"vnp_TxnRef\": \"ORD-688C29B20979D\", \"vnp_PayDate\": \"20250801094416\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15111016\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15111016\", \"vnp_TransactionStatus\": \"00\"}', 2, 'processing', NULL, NULL, '2025-08-01 02:42:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-01 02:42:58', '2025-08-01 02:43:17', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-688C2AF3E3168', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'dadadadadad, Phường Hàng Buồm, Quận Hoàn Kiếm, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'dadadadadad, Phường Hàng Buồm, Quận Hoàn Kiếm, Thành phố Hà Nội', '15000000.00', '60000.00', '1000000.00', 'VNPAY123', '0.00', '14060000.00', 5, 'paid', '{\"vnp_Amount\": \"1406000000\", \"vnp_TxnRef\": \"ORD-688C2AF3E3168\", \"vnp_PayDate\": \"20250801094938\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15111025\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15111025\", \"vnp_TransactionStatus\": \"00\"}', 2, 'processing', NULL, NULL, '2025-08-01 02:48:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-01 02:48:19', '2025-08-01 02:48:39', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-688C54228597F', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Phường Dịch Vọng, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Phường Dịch Vọng, Thị xã Sơn Tây, Thành phố Hà Nội', '26000000.00', '30000.00', '0.00', NULL, '0.00', '26030000.00', 5, 'paid', '{\"vnp_Amount\": \"2603000000\", \"vnp_TxnRef\": \"ORD-688C54228597F\", \"vnp_PayDate\": \"20250801124539\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15111316\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15111316\", \"vnp_TransactionStatus\": \"00\"}', 1, 'processing', NULL, NULL, '2025-08-01 05:44:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-01 05:44:02', '2025-08-01 05:44:40', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_variant_id` bigint UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `variant_attributes` json DEFAULT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_variant_id`, `product_name`, `variant_attributes`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
(57, 21, 22, 22, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 5, '43500000.00', '2025-07-10 07:10:53', '2025-07-10 07:10:53'),
(58, 21, 77, 127, 'Giường ngủ Wynn 1m8', NULL, 3, '96000000.00', '2025-07-10 07:10:53', '2025-07-10 07:10:53'),
(59, 22, 77, 128, 'Giường ngủ Wynn 1m8', NULL, 2, '64000000.00', '2025-07-10 07:34:08', '2025-07-10 07:34:08'),
(60, 23, 76, 125, 'Giường ngủ bọc vải Softly 1m8', NULL, 2, '52000000.00', '2025-07-11 02:35:41', '2025-07-11 02:35:41'),
(61, 24, 75, 122, 'Giường Ona Him 1m8', NULL, 3, '59999997.00', '2025-07-11 02:37:39', '2025-07-11 02:37:39'),
(62, 25, 74, 121, 'Giường Leman 1m8', NULL, 3, '51000000.00', '2025-07-11 02:41:12', '2025-07-11 02:41:12'),
(63, 26, 67, 110, 'Tủ TV mặt đá Ogami', NULL, 6, '90000000.00', '2025-07-11 02:45:03', '2025-07-11 02:45:03'),
(64, 27, 75, 122, 'Giường Ona Him 1m8', NULL, 2, '39999998.00', '2025-07-23 18:50:20', '2025-07-23 18:50:20'),
(65, 28, 75, 122, 'Giường Ona Him 1m8', NULL, 2, '39999998.00', '2025-07-23 18:50:20', '2025-07-23 18:50:20'),
(66, 29, 67, 110, 'Tủ TV mặt đá Ogami', NULL, 1, '15000000.00', '2025-07-26 04:41:31', '2025-07-26 04:41:31'),
(67, 29, 77, 128, 'Giường ngủ Wynn 1m8', NULL, 1, '32000000.00', '2025-07-26 04:41:31', '2025-07-26 04:41:31'),
(68, 30, 67, 110, 'Tủ TV mặt đá Ogami', NULL, 1, '15000000.00', '2025-07-26 04:42:54', '2025-07-26 04:42:54'),
(69, 30, 77, 128, 'Giường ngủ Wynn 1m8', NULL, 1, '32000000.00', '2025-07-26 04:42:54', '2025-07-26 04:42:54'),
(70, 31, 67, 110, 'Tủ TV mặt đá Ogami', NULL, 1, '15000000.00', '2025-07-26 04:43:12', '2025-07-26 04:43:12'),
(71, 31, 77, 128, 'Giường ngủ Wynn 1m8', NULL, 1, '32000000.00', '2025-07-26 04:43:12', '2025-07-26 04:43:12'),
(72, 32, 67, 110, 'Tủ TV mặt đá Ogami', NULL, 1, '15000000.00', '2025-07-26 04:44:17', '2025-07-26 04:44:17'),
(73, 33, 67, 110, 'Tủ TV mặt đá Ogami', NULL, 1, '15000000.00', '2025-07-26 04:50:54', '2025-07-26 04:50:54'),
(74, 34, 65, 108, 'Bàn ăn Mây 10 chỗ', NULL, 1, '11000000.00', '2025-07-26 05:16:51', '2025-07-26 05:16:51'),
(75, 35, 72, 117, 'Tủ Tivi Miami 210004', NULL, 1, '17300000.00', '2025-07-26 06:26:03', '2025-07-26 06:26:03'),
(76, 36, 72, 117, 'Tủ Tivi Miami 210004', NULL, 1, '17300000.00', '2025-07-26 06:28:46', '2025-07-26 06:28:46'),
(77, 37, 57, 99, 'Bàn ăn 6 chỗ Coastal', NULL, 1, '4300000.00', '2025-07-26 06:31:03', '2025-07-26 06:31:03'),
(78, 38, 37, 62, 'Đôn Dream tròn', NULL, 2, '12000000.00', '2025-07-26 08:18:45', '2025-07-26 08:18:45'),
(79, 39, 37, 62, 'Đôn Dream tròn', NULL, 2, '12000000.00', '2025-07-26 15:23:27', '2025-07-26 15:23:27'),
(80, 40, 76, 126, 'Giường ngủ bọc vải Softly 1m8', NULL, 1, '27000000.00', '2025-07-26 15:27:02', '2025-07-26 15:27:02'),
(81, 41, 76, 126, 'Giường ngủ bọc vải Softly 1m8', NULL, 1, '27000000.00', '2025-07-26 15:27:40', '2025-07-26 15:27:40'),
(82, 42, 74, 121, 'Giường Leman 1m8', NULL, 1, '17000000.00', '2025-07-26 15:29:08', '2025-07-26 15:29:08'),
(83, 43, 69, 112, 'Tủ TV Moretti', NULL, 1, '35000000.00', '2025-08-01 00:51:53', '2025-08-01 00:51:53'),
(84, 43, 76, 125, 'Giường ngủ bọc vải Softly 1m8', NULL, 1, '26000000.00', '2025-08-01 00:51:53', '2025-08-01 00:51:53'),
(85, 44, 69, 112, 'Tủ TV Moretti', NULL, 1, '35000000.00', '2025-08-01 00:53:02', '2025-08-01 00:53:02'),
(86, 44, 76, 125, 'Giường ngủ bọc vải Softly 1m8', NULL, 1, '26000000.00', '2025-08-01 00:53:02', '2025-08-01 00:53:02'),
(87, 45, 75, 122, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-01 02:42:24', '2025-08-01 02:42:24'),
(88, 46, 75, 122, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-01 02:42:58', '2025-08-01 02:42:58'),
(89, 47, 64, 107, 'Bàn ăn Cartesio ceramic P2C', NULL, 1, '15000000.00', '2025-08-01 02:48:19', '2025-08-01 02:48:19'),
(90, 48, 76, 124, 'Giường ngủ bọc vải Softly 1m8', NULL, 1, '26000000.00', '2025-08-01 05:44:02', '2025-08-01 05:44:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_promotion`
--

CREATE TABLE `order_promotion` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `promotion_id` bigint UNSIGNED NOT NULL,
  `discount_applied` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_status_histories`
--

CREATE TABLE `order_status_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending_confirmation','processing','shipped','delivered','cancelled','returned','pending_cancellation') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_status_histories`
--

INSERT INTO `order_status_histories` (`id`, `order_id`, `status`, `admin_note`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 26, 'processing', NULL, NULL, '2025-07-14 19:03:58', '2025-07-14 19:03:58'),
(2, 26, 'shipped', NULL, NULL, '2025-07-14 19:04:10', '2025-07-14 19:04:10'),
(3, 26, 'delivered', NULL, NULL, '2025-07-14 19:06:02', '2025-07-14 19:06:02'),
(4, 25, 'processing', NULL, NULL, '2025-07-14 19:06:25', '2025-07-14 19:06:25'),
(5, 25, 'shipped', NULL, NULL, '2025-07-14 19:06:28', '2025-07-14 19:06:28'),
(6, 25, 'delivered', NULL, NULL, '2025-07-14 19:11:31', '2025-07-14 19:11:31'),
(7, 25, 'returned', NULL, NULL, '2025-07-14 19:13:07', '2025-07-14 19:13:07'),
(8, 23, 'processing', NULL, NULL, '2025-07-14 19:13:20', '2025-07-14 19:13:20'),
(9, 23, 'shipped', NULL, NULL, '2025-07-14 19:13:27', '2025-07-14 19:13:27'),
(10, 24, 'processing', NULL, NULL, '2025-07-14 19:33:06', '2025-07-14 19:33:06'),
(11, 24, 'shipped', NULL, NULL, '2025-07-14 19:33:11', '2025-07-14 19:33:11'),
(12, 27, 'processing', NULL, NULL, '2025-07-23 18:50:50', '2025-07-23 18:50:50'),
(13, 27, 'shipped', NULL, NULL, '2025-07-23 18:50:53', '2025-07-23 18:50:53'),
(14, 27, 'delivered', NULL, NULL, '2025-07-23 18:50:54', '2025-07-23 18:50:54'),
(15, 27, 'processing', NULL, NULL, '2025-07-23 19:06:21', '2025-07-23 19:06:21'),
(16, 27, 'shipped', NULL, NULL, '2025-07-23 19:06:22', '2025-07-23 19:06:22'),
(17, 27, 'delivered', NULL, NULL, '2025-07-23 19:06:23', '2025-07-23 19:06:23'),
(18, 38, 'shipped', NULL, NULL, '2025-07-26 15:31:17', '2025-07-26 15:31:17'),
(19, 38, 'delivered', NULL, NULL, '2025-07-26 15:35:21', '2025-07-26 15:35:21');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint UNSIGNED DEFAULT NULL,
  `page_type` enum('page','blog_post') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'page',
  `status` enum('published','draft') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `featured_image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `author_id`, `page_type`, `status`, `meta_title`, `meta_description`, `featured_image_url`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Iusto architecto fugit nisi sapiente velit magni.', 'iusto-architecto-fugit-nisi-sapiente-velit-magni-0I6Rw', 'Fugit sed non eligendi nihil ut excepturi. Id velit dolor sunt est. Cumque atque aut officia. Eos officiis dolorum quam et nihil.\n\nUt blanditiis accusantium expedita omnis. Quia sit et est mollitia ut nesciunt voluptatem accusamus. Velit blanditiis et in id minus sed odio. Odit rem ullam veritatis. Et est ut ducimus autem culpa dolor.\n\nMolestias qui porro officia doloremque cumque. Aut eos et sint. Cumque laboriosam consequatur minus ducimus.\n\nVoluptate voluptas ad aut unde est. Alias autem impedit provident qui voluptas qui eum quae. Cum voluptatibus voluptatibus aut aut eum non.\n\nCommodi voluptatem nesciunt iusto non sequi quos labore nulla. Nemo velit dolores et aut at. Est modi velit quisquam ipsum.', 4, 'blog_post', 'draft', NULL, NULL, 'https://via.placeholder.com/800x400.png/004444?text=text+beatae', NULL, '2024-08-06 00:27:37', '2024-12-21 12:09:03'),
(2, 'Hic voluptas velit possimus.', 'hic-voluptas-velit-possimus-2g8JW', 'Qui sed nostrum et fugit architecto. Necessitatibus eaque sit quo modi ullam libero. Nihil eveniet vitae fugit expedita vel pariatur.\n\nModi a odio assumenda numquam ut non in. Accusamus ducimus consequatur ut molestiae esse. Aut mollitia ratione possimus nostrum sit omnis.\n\nEius porro libero totam. Nesciunt possimus accusantium rerum ipsum.\n\nAssumenda unde omnis nisi fugiat quasi quasi accusantium. Quaerat velit est et labore repudiandae qui.\n\nAlias quae eligendi aliquid consequatur. Ut consequatur occaecati dolor vel reprehenderit. Quis deserunt voluptatem consequatur excepturi. Eligendi quia sit excepturi aliquid aut ipsa ratione quia.', NULL, 'blog_post', 'published', 'Ex architecto recusandae aut voluptatibus eos officia ducimus.', 'Vel repudiandae consequatur aut quis magni. Sint et et nemo voluptatem sed sint sed.', NULL, '2025-01-09 16:29:53', '2024-10-08 20:18:12', '2025-04-12 00:23:29'),
(3, 'Numquam neque et consequatur porro molestiae sit.', 'numquam-neque-et-consequatur-porro-molestiae-sit-5lcid', 'Delectus aut aperiam nisi et nobis. Sapiente incidunt quis eaque animi sed adipisci et incidunt. Aperiam architecto sit at laudantium dolorem natus. Aut qui officia rerum.\n\nAmet voluptas soluta necessitatibus. Qui pariatur est et qui minima qui. Nesciunt id illo quia omnis.\n\nEius cum aliquid rem perspiciatis nam aliquam autem. Est nobis et illum neque dicta corrupti. Assumenda rerum doloremque facere numquam porro in fugit distinctio. Nulla sunt quis sunt placeat.\n\nRem cumque libero delectus occaecati velit ratione doloremque. Et eius et quasi ut. Nostrum sit vel et aliquam quaerat autem. Incidunt est et et. Soluta officia possimus quasi eum cupiditate qui aut.\n\nSequi quo vel eius eveniet quod nisi vero. Qui nam odit impedit illum placeat necessitatibus incidunt.', NULL, 'blog_post', 'published', 'Id maxime vel aut voluptas dolorem quia optio quis.', 'Dolorem rerum id voluptatem libero placeat enim dolores. Rerum nesciunt vero amet. Ipsam corrupti nostrum aliquam.', 'https://via.placeholder.com/800x400.png/0066ff?text=text+aut', '2024-12-07 16:28:18', '2025-01-15 05:36:34', '2024-07-14 00:52:29'),
(4, 'Possimus nam corrupti quia.', 'possimus-nam-corrupti-quia-h6peI', 'Eos culpa labore veniam dolorem labore aut. Recusandae itaque autem doloribus explicabo et corrupti. Voluptas mollitia nobis quasi harum dolorum molestiae tempora. Consequatur deserunt natus laborum. Architecto ut omnis sit est architecto doloribus atque.\n\nTenetur repudiandae vel distinctio tenetur. Alias earum quia odio.\n\nPerspiciatis in iure beatae tempora. Autem est facere sunt perspiciatis qui autem.\n\nEa ab corporis sequi eum aut at. Sapiente at repellat officiis blanditiis ab eius consectetur. Est ut aut beatae fuga sapiente asperiores eos.\n\nOmnis perspiciatis et sequi sequi eos libero aut. Amet officia doloribus nostrum eos. Temporibus nulla ut quibusdam fugit mollitia quidem.', NULL, 'page', 'draft', 'Inventore autem dignissimos aut sit aliquid maxime id dolorem et.', NULL, NULL, NULL, '2025-01-03 14:11:20', '2025-01-30 16:04:32'),
(5, 'Aut voluptatibus quam et blanditiis qui dolores.', 'aut-voluptatibus-quam-et-blanditiis-qui-dolores-UOYvQ', '<p>Mollitia corporis voluptas officia. Laboriosam accusantium earum consectetur vel. Sed neque natus id enim tempora. Facere nobis dolor rerum et minima consequatur est. Quis similique eum tempora. Sunt incidunt voluptates unde quam et sed iste omnis. Earum et aut aut aliquid. Cupiditate quis et dolorum maxime corrupti quam. Est voluptatem alias ducimus autem qui rerum id in. Vitae sit et nihil autem modi. Est et eum earum eos quo id quos. Delectus recusandae consequuntur qui. Ducimus ut ut culpa fuga doloribus quis officia. Est vero aut fugiat molestiae. Perferendis aspernatur facere error adipisci ut.</p>', 12, 'blog_post', 'published', 'Sequi et quia aut possimus quia nostrum.', 'Ut voluptatum repellat corporis. Excepturi cupiditate voluptas libero vel qui. Aut laudantium esse ipsum pariatur consequuntur voluptas nostrum.', 'pages/3gx9iO3fFLoV3WZgXfzbY0hZwgwLbm0r1RtiTX2p.jpg', '2025-05-22 00:48:00', '2025-01-08 17:01:33', '2025-08-01 04:01:20'),
(6, 'Voluptas et nesciunt possimus quaerat.', 'voluptas-et-nesciunt-possimus-quaerat-QN3gq', 'Voluptate nemo aliquid vel quasi eveniet. Expedita vero provident nulla illum. Facilis fugit nesciunt et et facere. Dolor voluptatem porro quaerat illum nisi. A ad sit mollitia consectetur ex.\n\nDolor molestiae nihil nisi ut enim officia est ut. Soluta atque qui doloremque ut.\n\nPerspiciatis voluptas illo molestiae eum magni necessitatibus. Voluptas quibusdam pariatur ut provident provident aut. Reprehenderit consectetur sequi quae. Numquam voluptatem iusto cum sequi.\n\nRerum repudiandae et molestiae dolores consequatur rem. Eum qui quas molestiae porro at. Et ea aut ea accusamus magnam itaque minus. Consequatur libero at quaerat reprehenderit hic.\n\nSapiente non numquam saepe. Odit nesciunt distinctio est aut. Praesentium fugit non eum fugit vitae pariatur dolorum.', 5, 'page', 'draft', 'Aut rem dolores ut animi voluptatem et aut ipsam.', NULL, NULL, NULL, '2024-08-25 03:35:57', '2024-12-19 14:05:21'),
(7, 'Soluta magni asperiores nesciunt accusamus ipsa.', 'soluta-magni-asperiores-nesciunt-accusamus-ipsa-D7qjd', 'Similique repellendus rem officia cupiditate molestias ut. Quod soluta numquam consequatur repellendus sapiente id. Recusandae molestias voluptas quasi voluptas facilis. Voluptas atque quaerat qui excepturi et sapiente.\n\nAutem deleniti ut recusandae possimus ea ea. Fugiat velit tenetur molestias eos cupiditate ducimus nobis. Et ex libero ut aliquam voluptate.\n\nEt reprehenderit et adipisci consequatur. Dolore et quibusdam impedit et nihil magnam. Et qui ut tempora voluptas et. Error sit suscipit aut error.\n\nEst perferendis nam unde facere exercitationem. Accusamus fugit magnam voluptatibus unde quasi iure. Eligendi qui eum cumque ratione commodi. Est dolore at repudiandae eius cupiditate nam quos.\n\nTenetur exercitationem laborum expedita aspernatur nisi est. Accusamus nihil nihil laboriosam sunt illo adipisci at. Id non et harum eaque ut.', 4, 'page', 'draft', NULL, NULL, NULL, NULL, '2025-02-25 03:37:59', '2025-06-01 23:13:05'),
(8, 'Provident nostrum id fuga adipisci reiciendis facere.', 'provident-nostrum-id-fuga-adipisci-reiciendis-facere-Lul18', 'Voluptatem molestiae cum soluta repudiandae impedit. Quos quia eum unde sint dignissimos cupiditate culpa neque. Reiciendis eum ducimus veniam alias dolores nobis sunt quia. Architecto rerum architecto ipsa tempore. Saepe corporis laboriosam culpa itaque magnam dolor enim enim.\n\nQui adipisci omnis aut quia. Corrupti necessitatibus ut omnis nulla architecto. Eum ipsam impedit quia fugit quia eius rerum incidunt.\n\nVoluptatem porro aperiam voluptate. Rem dicta repellendus omnis quae sint. Et tempore voluptates commodi.\n\nSequi ad est velit quo repellat. Ad voluptas eius aliquid est laboriosam error et. Tempora sit veniam ea ea inventore fugiat hic. Animi ad dolorem omnis dolor facilis nam.\n\nCupiditate aut voluptatem optio sit fugit. Qui doloribus quia accusamus voluptas aut et. Facilis aliquam ut enim velit. Et harum atque fugiat incidunt et omnis atque.', 7, 'page', 'draft', NULL, NULL, NULL, NULL, '2025-03-25 19:25:55', '2024-11-07 09:57:44'),
(9, 'Qui magnam quaerat asperiores natus delectus vel.', 'qui-magnam-quaerat-asperiores-natus-delectus-vel-t8Vbs', 'Maxime quia pariatur distinctio ut. Quo nihil corporis eaque ab debitis autem. Tempora non impedit quia soluta ratione consectetur sed accusantium.\n\nEnim quis quod ipsa culpa non aut quia dolor. Nesciunt cum alias sunt accusamus. Possimus repudiandae recusandae iure laborum deserunt occaecati. Hic sunt ut ut.\n\nDeserunt rerum possimus enim qui est et omnis placeat. Recusandae ut aut est consequatur voluptatem quis et. Vel inventore aut in nobis qui in. Adipisci quas cum omnis ratione.\n\nNam doloremque in ea voluptatem. Quos voluptatem qui nobis id eos assumenda necessitatibus.\n\nSit nesciunt soluta aspernatur earum ea. Sit rerum et vitae impedit quia voluptatem eos. Doloremque eos ut natus nam magnam quaerat quaerat. Impedit voluptatibus reiciendis commodi nihil molestiae nulla et.', NULL, 'page', 'draft', 'Labore illum aut recusandae aut ut.', 'Officiis quidem in cum voluptas excepturi rerum aut et. Autem temporibus sequi et ipsa ut eos ea ut.', NULL, NULL, '2024-10-18 16:23:40', '2024-09-04 15:47:30'),
(10, 'CHIÊM NGƯỠNG CÁC DÒNG SẢN PHẨM CHO MÙA MỚI TẠI NHÀ XINH', 'chiem-nguong-cac-dong-san-pham-cho-mua-moi-tai-nha-xinh', '<h1 style=\"text-align: center;\"><strong>CHI&Ecirc;M NGƯỠNG C&Aacute;C D&Ograve;NG SẢN PHẨM CHO M&Ugrave;A MỚI TẠI NH&Agrave; XINH</strong></h1>\r\n<p style=\"text-align: center;\">B&ecirc;n cạnh việc tiếp tục l&agrave;m mới kh&ocirc;ng gian cửa h&agrave;ng, mang đến trải nghiệm độc đ&aacute;o cho kh&aacute;ch h&agrave;ng, Nh&agrave; Xinh sẽ giới thiệu những d&ograve;ng sản phẩm mới với thiết kế hợp thời, kiểu d&aacute;ng đa dạng c&ugrave;ng chất lượng cao. H&atilde;y c&ugrave;ng kh&aacute;m ph&aacute; c&aacute;c sản phẩm mới sẽ c&oacute; mặt tại c&aacute;c cửa h&agrave;ng Nh&agrave; Xinh.</p>\r\n<div id=\"image_446114840\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04.jpg\" sizes=\"(max-width: 1000px) 100vw, 1000px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04.jpg 1000w, https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04-601x400.jpg 601w, https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04-768x511.jpg 768w, https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04-300x200.jpg 300w, https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04-600x400.jpg 600w\" alt=\"\" width=\"1000\" height=\"666\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04.jpg\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04.jpg 1000w, https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04-601x400.jpg 601w, https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04-768x511.jpg 768w, https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04-300x200.jpg 300w, https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04-600x400.jpg 600w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\"><strong>Valencia &ndash; bộ sản phẩm cho ph&ograve;ng kh&aacute;ch sang trọng, thanh lịch</strong></p>\r\n<p style=\"text-align: center;\">Lấy cảm hứng từ th&agrave;nh phố Valencia, miền Đ&ocirc;ng Nam T&acirc;y Ban Nha, nơi nổi tiếng với sự giao thoa độc đ&aacute;o giữa kiến tr&uacute;c hiện đại v&agrave; cổ k&iacute;nh. Thiết kế của Valencia tập trung v&agrave;o việc gợi l&ecirc;n cảm gi&aacute;c ấm &aacute;p v&agrave; linh hoạt, đ&aacute;p ứng nhu cầu của cuộc sống hiện đại trong khi vẫn t&ocirc;n vinh những di sản văn h&oacute;a l&acirc;u đời.&nbsp;</p>\r\n<div id=\"image_715003591\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-1200x800.webp\" sizes=\"(max-width: 1020px) 100vw, 1020px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-1200x800.webp 1200w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-600x400.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-768x512.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-1536x1024.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-300x200.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2.webp 1700w\" alt=\"\" width=\"1020\" height=\"680\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-1200x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-1200x800.webp 1200w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-600x400.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-768x512.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-1536x1024.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-300x200.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2.webp 1700w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\">Sofa Valencia c&oacute; phần ch&acirc;n kim loại thanh mảnh kết hợp với kiểu d&aacute;ng m&ocirc;-đun hiện đại, với phần hộc gỗ t&iacute;ch hợp b&ecirc;n h&ocirc;ng như một chiếc b&agrave;n b&ecirc;n tiện dụng.&nbsp;</p>\r\n<div id=\"image_2127821004\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-533x800.webp\" sizes=\"(max-width: 533px) 100vw, 533px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-533x800.webp 533w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-267x400.webp 267w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-768x1152.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-1024x1536.webp 1024w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-1365x2048.webp 1365w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-300x450.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-600x900.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1.webp 1600w\" alt=\"\" width=\"533\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-533x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-533x800.webp 533w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-267x400.webp 267w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-768x1152.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-1024x1536.webp 1024w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-1365x2048.webp 1365w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-300x450.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-600x900.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1.webp 1600w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\">Th&ecirc;m v&agrave;o đ&oacute;, sản phẩm sử dụng da aniline l&agrave; loại da thuộc cao cấp nhất, được l&agrave;m từ lớp da ngo&agrave;i c&ugrave;ng, giữ lại trọn vẹn vẻ đẹp tự nhi&ecirc;n với những đường v&acirc;n c&ugrave;ng c&aacute;c dấu hiệu tự nhi&ecirc;n kh&aacute;c. Ch&iacute;nh sự &ldquo;ho&agrave;n hảo kh&ocirc;ng ho&agrave;n hảo&rdquo; n&agrave;y tạo n&ecirc;n vẻ độc đ&aacute;o v&agrave; sang trọng cho sản phẩm.</p>\r\n<div id=\"image_1150149185\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-572x800.webp\" sizes=\"(max-width: 572px) 100vw, 572px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-572x800.webp 572w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-286x400.webp 286w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-768x1074.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-1098x1536.webp 1098w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-1464x2048.webp 1464w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-300x420.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-600x839.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2.webp 1700w\" alt=\"\" width=\"572\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-572x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-572x800.webp 572w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-286x400.webp 286w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-768x1074.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-1098x1536.webp 1098w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-1464x2048.webp 1464w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-300x420.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-600x839.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2.webp 1700w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\">B&agrave;n b&ecirc;n Valencia l&agrave; sự kết hợp ấn tượng giữa chất liệu gỗ v&agrave; đ&aacute;, phần ch&acirc;n b&agrave;n tối giản tiết kiệm tối đa kh&ocirc;ng gian c&ugrave;ng c&aacute;c đường bo tr&ograve;n tạo cảm gi&aacute;c nhẹ nh&agrave;ng, h&agrave;i h&ograve;a. Valencia c&ograve;n c&oacute; th&ecirc;m ghế armchair v&agrave; b&agrave;n b&ecirc;n được l&agrave;m từ c&aacute;c chất liệu cao cấp, ho&agrave;n thiện kh&ocirc;ng gian ph&ograve;ng kh&aacute;ch đẳng cấp.</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><strong>Napoli &ndash; tạo n&ecirc;n vẻ đẹp ấm c&uacute;ng cho kh&ocirc;ng gian ph&ograve;ng ăn</strong></p>\r\n<p style=\"text-align: center;\">Napoli ra đời từ sự h&ograve;a quyện độc đ&aacute;o giữa vẻ đẹp tự nhi&ecirc;n của c&aacute;c h&igrave;nh khối organic, sự tỉ mỉ trong từng chi tiết ho&agrave;n thiện v&agrave; nguồn cảm hứng mạnh mẽ từ kiến tr&uacute;c hiện đại. &Yacute; tưởng thiết kế của Napoli tập trung v&agrave;o việc tạo ra một sự c&acirc;n bằng thị gi&aacute;c ấn tượng th&ocirc;ng qua c&aacute;c h&igrave;nh khối mang t&iacute;nh kiến tr&uacute;c.&nbsp;</p>\r\n<div id=\"image_249575917\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-1206x800.webp\" sizes=\"(max-width: 1020px) 100vw, 1020px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-1206x800.webp 1206w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-603x400.webp 603w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-768x510.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-1536x1019.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-300x199.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-600x398.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia.webp 1700w\" alt=\"\" width=\"1020\" height=\"677\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-1206x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-1206x800.webp 1206w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-603x400.webp 603w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-768x510.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-1536x1019.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-300x199.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-600x398.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia.webp 1700w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\">Thay v&igrave; những đường n&eacute;t vu&ocirc;ng vức, cứng nhắc, Napoli ưu ti&ecirc;n c&aacute;c đường cong mềm mại, uyển chuyển, gợi nhớ đến vẻ đẹp tự nhi&ecirc;n, tạo cảm gi&aacute;c gần gũi v&agrave; thư th&aacute;i. Đồng thời, sự chỉn chu trong từng chi tiết nhỏ nhất, từ đường n&eacute;t bo cạnh tinh tế đến bề mặt vật liệu được xử l&yacute; tỉ mỉ, khẳng định gi&aacute; trị cao cấp v&agrave; sự đầu tư nghi&ecirc;m t&uacute;c v&agrave;o chất lượng sản phẩm.</p>\r\n<div id=\"image_1047694612\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-544x800.webp\" sizes=\"(max-width: 544px) 100vw, 544px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-544x800.webp 544w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-272x400.webp 272w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-768x1129.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-1045x1536.webp 1045w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-1394x2048.webp 1394w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-300x441.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-600x882.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia.webp 1700w\" alt=\"\" width=\"544\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-544x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-544x800.webp 544w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-272x400.webp 272w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-768x1129.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-1045x1536.webp 1045w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-1394x2048.webp 1394w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-300x441.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-600x882.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia.webp 1700w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\">Sự kết hợp ho&agrave;n hảo giữa gỗ sồi đặc nguy&ecirc;n khối v&agrave; veneer gỗ sồi cao cấp mang đến cho mặt b&agrave;n Napoli vẻ đẹp hiện đại, sang trọng đồng thời đảm bảo độ bền vượt trội. Thiết kế th&ocirc;ng minh của ch&acirc;n b&agrave;n kh&ocirc;ng chỉ tạo ấn tượng về mặt thị gi&aacute;c m&agrave; c&ograve;n tối ưu h&oacute;a kh&ocirc;ng gian sử dụng. Đi c&ugrave;ng chiếc b&agrave;n Napoli sẽ l&agrave; ghế ăn Napoli bọc da b&ograve; tự nhi&ecirc;n cao cấp. Lớp đệm ngồi bọc da đ&ograve;i hỏi người thợ may l&agrave;nh nghề v&agrave; gi&agrave;u kinh nghiệm để đảm bảo độ căng l&yacute; tưởng, đường may đều đặn v&agrave; sắc sảo tr&ecirc;n to&agrave;n bộ bề mặt sản phẩm, t&ocirc;n l&ecirc;n vẻ đẹp sang trọng v&agrave; đẳng cấp.</p>\r\n<div id=\"image_1848863481\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-598x800.webp\" sizes=\"(max-width: 598px) 100vw, 598px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-598x800.webp 598w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-299x400.webp 299w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-768x1027.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-1149x1536.webp 1149w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-1532x2048.webp 1532w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-300x401.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-600x802.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia.webp 1700w\" alt=\"\" width=\"598\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-598x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-598x800.webp 598w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-299x400.webp 299w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-768x1027.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-1149x1536.webp 1149w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-1532x2048.webp 1532w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-300x401.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-600x802.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia.webp 1700w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\">Th&ecirc;m một sản phẩm nữa Nh&agrave; Xinh muốn giới thiệu, ch&iacute;nh l&agrave; tủ ly Napoli, được tạo ra với mong muốn mang đến một giải ph&aacute;p lưu trữ kh&ocirc;ng chỉ tối ưu về c&ocirc;ng năng m&agrave; c&ograve;n sở hữu vẻ đẹp hiện đại, tinh tế, g&oacute;p phần ho&agrave;n thiện kh&ocirc;ng gian sống đẳng cấp. Sự tỉ mỉ trong từng chi tiết thiết kế, đặc biệt l&agrave; những đường n&eacute;t CNC phức tạp tr&ecirc;n c&aacute;nh tủ, sẽ tạo n&ecirc;n điểm nhấn ấn tượng, khẳng định gu thẩm mỹ tinh tế của gia chủ.</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><strong>Nest &ndash; ấm &aacute;p v&agrave; hiện đại</strong></p>\r\n<p style=\"text-align: center;\">Đ&uacute;ng như c&aacute;i t&ecirc;n mang &yacute; nghĩa &ldquo;chiếc tổ&rdquo;, Nest mang vẻ ngo&agrave;i ấm c&uacute;ng, mềm mại v&agrave; thư th&aacute;i. Thiết kế của d&ograve;ng sản phẩm Nest mang đến một diện mạo trẻ trung, hợp thời v&agrave; tươi s&aacute;ng cho kh&ocirc;ng gian.</p>\r\n<div id=\"slider-85254289\" class=\"slider-wrapper relative\" style=\"text-align: center;\">\r\n<div class=\"slider slider-nav-circle slider-nav-large slider-nav-light slider-style-normal slider-lazy-load-active is-draggable flickity-enabled\" tabindex=\"0\" data-flickity-options=\"{\r\n            &quot;cellAlign&quot;: &quot;center&quot;,\r\n            &quot;imagesLoaded&quot;: true,\r\n            &quot;lazyLoad&quot;: 1,\r\n            &quot;freeScroll&quot;: false,\r\n            &quot;wrapAround&quot;: true,\r\n            &quot;autoPlay&quot;: 6000,\r\n            &quot;pauseAutoPlayOnHover&quot; : true,\r\n            &quot;prevNextButtons&quot;: true,\r\n            &quot;contain&quot; : true,\r\n            &quot;adaptiveHeight&quot; : true,\r\n            &quot;dragThreshold&quot; : 10,\r\n            &quot;percentPosition&quot;: true,\r\n            &quot;pageDots&quot;: true,\r\n            &quot;rightToLeft&quot;: false,\r\n            &quot;draggable&quot;: true,\r\n            &quot;selectedAttraction&quot;: 0.1,\r\n            &quot;parallax&quot; : 0,\r\n            &quot;friction&quot;: 0.6        }\">\r\n<div class=\"flickity-viewport\">\r\n<div class=\"flickity-slider\">\r\n<div id=\"image_601929453\" class=\"img has-hover x md-x lg-x y md-y lg-y is-selected\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-1200x800.webp\" sizes=\"(max-width: 1020px) 100vw, 1020px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-1200x800.webp 1200w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-600x400.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-768x512.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-1536x1024.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-300x200.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4.webp 1700w\" alt=\"\" width=\"1020\" height=\"680\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-1200x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-1200x800.webp 1200w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-600x400.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-768x512.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-1536x1024.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-300x200.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4.webp 1700w\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<button class=\"flickity-button flickity-prev-next-button previous\" disabled=\"disabled\" type=\"button\" aria-label=\"Previous\"></button><button class=\"flickity-button flickity-prev-next-button next\" disabled=\"disabled\" type=\"button\" aria-label=\"Next\"></button></div>\r\n</div>\r\n<p style=\"text-align: center;\">Lấy cảm hứng từ h&igrave;nh ảnh ấm &aacute;p v&agrave; mềm mại của một chiếc tổ chim, Nest mang đến một thiết kế sofa tr&agrave;n đầy sự thoải m&aacute;i v&agrave; gần gũi. Đường cong uyển chuyển ở phần tựa lưng v&agrave; đường may nhấn tinh tế tr&ecirc;n tay vịn kh&ocirc;ng chỉ tạo điểm nhấn thẩm mỹ m&agrave; c&ograve;n gợi l&ecirc;n cảm gi&aacute;c được bao bọc, an y&ecirc;n.</p>\r\n<div id=\"image_1573078374\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-533x800.webp\" sizes=\"(max-width: 533px) 100vw, 533px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-533x800.webp 533w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-267x400.webp 267w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-768x1152.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-1024x1536.webp 1024w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-1365x2048.webp 1365w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-300x450.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-600x900.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3.webp 1700w\" alt=\"\" width=\"533\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-533x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-533x800.webp 533w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-267x400.webp 267w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-768x1152.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-1024x1536.webp 1024w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-1365x2048.webp 1365w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-300x450.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-600x900.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3.webp 1700w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\">Mang một ng&ocirc;n ngữ thiết kế tươi mới, hiện đại v&agrave; kh&aacute;c biệt so với c&aacute;c sản phẩm hiện c&oacute; của Nh&agrave; Xinh. Những đường cong mềm mại kết hợp với c&aacute;c chi tiết độc đ&aacute;o tạo n&ecirc;n một chiếc armchair Nest c&aacute; t&iacute;nh, nổi bật v&agrave; thu h&uacute;t mọi &aacute;nh nh&igrave;n. Sản phẩm c&oacute; thể kết hợp c&ugrave;ng b&agrave;n nước Nest mang vẻ đẹp nguy&ecirc;n bản của đ&aacute; marble tự nhi&ecirc;n, thiết kế nhỏ gọn, tạo n&ecirc;n sự thư th&aacute;i cho kh&ocirc;ng gian sống.</p>\r\n<div id=\"image_1498471374\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-533x800.webp\" sizes=\"(max-width: 533px) 100vw, 533px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-533x800.webp 533w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-267x400.webp 267w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-768x1152.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-1024x1536.webp 1024w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-1365x2048.webp 1365w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-300x450.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-600x900.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia.webp 1700w\" alt=\"\" width=\"533\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-533x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-533x800.webp 533w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-267x400.webp 267w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-768x1152.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-1024x1536.webp 1024w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-1365x2048.webp 1365w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-300x450.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-600x900.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia.webp 1700w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\">Gh&eacute; thăm c&aacute;c cửa h&agrave;ng Nh&agrave; Xinh tr&ecirc;n to&agrave;n quốc để trải nghiệm c&aacute;c sản phẩm mới c&ugrave;ng kh&ocirc;ng gian trưng b&agrave;y đầy cảm hứng.&nbsp;</p>', 12, 'blog_post', 'published', 'CHIÊM NGƯỠNG CÁC DÒNG SẢN PHẨM CHO MÙA MỚI TẠI NHÀ XINH', 'Bên cạnh việc tiếp tục làm mới không gian cửa hàng, mang đến trải nghiệm độc đáo cho khách hàng, Nhà Xinh sẽ giới thiệu những dòng sản phẩm mới với thiết kế hợp thời, kiểu dáng đa dạng cùng chất lượng cao. Hãy cùng khám phá các sản phẩm mới sẽ có mặt tại các cửa hàng Nhà Xinh.', 'pages/pJV726mtOzXIN51TfHTaFYIGytu7pXqzdUXpcCew.jpg', '2025-05-04 11:56:00', '2025-02-01 13:56:39', '2025-07-26 06:58:32'),
(11, 'Et a aperiam nulla.', 'et-a-aperiam-nulla-Ga8cS', 'Illo numquam maxime expedita quia quam molestiae est. Quia est voluptatem officia illo odio sed nostrum eos. Velit sed consequatur distinctio. Cum nulla non sint aut quae sed.\n\nLibero ipsam consectetur enim veniam culpa dicta. Voluptate excepturi et nemo quibusdam assumenda sequi et. Voluptatem assumenda ducimus est et quasi dolorum sequi.\n\nMaxime corporis ab fuga fugit quia dolorem. Commodi possimus quia sit deserunt esse laudantium. Id delectus modi laborum assumenda cumque ea qui ab.\n\nFacilis nostrum et id quam. Et labore aliquam repudiandae aut aspernatur. Optio ratione corporis ducimus recusandae corporis magnam. Non distinctio quia quae dolorem omnis.\n\nEst sed fuga voluptatum exercitationem aut sit aut. Accusantium atque iusto excepturi architecto tempora magni. Ratione aperiam sit sed et aperiam omnis autem. Cupiditate laudantium aut numquam ad in voluptatibus voluptas nam.', 4, 'blog_post', 'published', 'Suscipit quaerat dolorem eaque magni optio quia.', 'Ex quis maiores cumque omnis laboriosam. Voluptates delectus repellat est modi ut eligendi quia.', NULL, '2024-10-13 17:44:04', '2024-09-22 18:48:04', '2025-01-24 16:23:28'),
(12, 'Est dolores molestias iste eum consequatur.', 'est-dolores-molestias-iste-eum-consequatur-L0UnZ', 'Dolorum minus iure dicta id explicabo tempore. Nihil repellat rem dolores vel aliquam. Expedita sed perferendis voluptatem eum id. Facilis qui quasi aspernatur. Voluptatibus deleniti quo qui tenetur perferendis excepturi perspiciatis.\n\nDebitis qui eveniet et enim qui eligendi. Est ab voluptates est dolor numquam. Consequuntur similique sed rerum quisquam voluptatum sunt. Unde nihil similique quo veniam.\n\nVoluptatem laudantium fugiat dolorem sunt dicta sint id. Perferendis ut error porro delectus et esse ipsam dolores. Hic ipsum enim soluta sed sed voluptatem ut.\n\nLibero quia pariatur voluptatem repellendus similique dolor voluptatem iure. Quia atque et iure aliquam. Et quaerat repudiandae repellendus dolores voluptate rerum enim eos.\n\nVel nisi eos eos et hic. Et ducimus et unde. Pariatur quidem molestiae possimus. Nobis impedit ad aliquam nostrum omnis.', 5, 'blog_post', 'published', 'Quisquam eligendi labore facilis dolores non.', NULL, 'https://via.placeholder.com/800x400.png/00bbaa?text=text+officiis', '2024-09-27 01:20:51', '2024-10-30 02:15:14', '2025-05-30 20:00:38'),
(13, 'Vel accusantium atque placeat.', 'vel-accusantium-atque-placeat-uFDzk', 'Accusantium enim quia autem quam. Praesentium rem id esse itaque quam. Dolorem voluptatem eius et aspernatur voluptatum distinctio officiis.\n\nOfficiis molestiae facere asperiores inventore blanditiis numquam. Illum minus dicta quibusdam optio aliquam. Est sed illo quos repellat laborum qui aspernatur.\n\nVel ullam ea consequuntur quis molestiae sit occaecati. Et odit praesentium rem dolores tenetur mollitia nesciunt. Provident laboriosam cum sint aut aut. Asperiores omnis expedita nobis alias laborum hic omnis.\n\nQui labore amet quia molestiae libero recusandae laborum. Minima rem animi dolorem ea. Ut aut nostrum et distinctio est.\n\nOmnis voluptas est eos corrupti. Fugiat non qui laborum voluptatem laborum fugiat. Ex nihil omnis assumenda praesentium nemo impedit dolores. Perferendis ad et nihil vel ut nemo voluptate.', 4, 'blog_post', 'published', 'Repudiandae consequatur quis laudantium animi aut voluptas minus sit.', NULL, NULL, '2025-02-21 10:21:06', '2024-09-25 09:51:46', '2025-06-04 18:01:22'),
(14, 'Qui consequatur et ut.', 'qui-consequatur-et-ut-xCsRe', 'Labore at sit molestiae harum tenetur. Esse ipsum sint et facilis et et. Nobis consequatur officiis harum expedita. Nihil est vitae consequuntur commodi asperiores ut. Illo facilis quia doloremque ut illum maiores praesentium et.\n\nCupiditate omnis sed exercitationem quis qui harum placeat. Qui occaecati ut sint adipisci excepturi dolores. Quisquam ea qui facere animi. Qui quam hic reprehenderit illo.\n\nEos aut odio id consequatur laudantium. Labore et nihil soluta aut. Voluptatem aut accusantium magni rem possimus facilis laudantium quidem. Rerum rerum earum tenetur ea beatae.\n\nUt at eum suscipit nihil minima qui voluptatum temporibus. Repellendus occaecati nostrum quia eos quod vel et. Harum ut laboriosam a. Eos blanditiis aliquid temporibus alias voluptatem non aliquid non.\n\nQuo et magni consequuntur dolorum maiores eos et. Tempore similique libero nihil. Vel perspiciatis non quis quos dicta eaque natus. Reiciendis ut corporis dolor id quod.', 7, 'blog_post', 'draft', NULL, 'Et maiores ut cumque magni unde consequatur neque ut. Et quidem voluptatibus est labore vitae recusandae nemo quidem.', NULL, NULL, '2025-01-21 23:12:19', '2024-11-28 13:30:58');
INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `author_id`, `page_type`, `status`, `meta_title`, `meta_description`, `featured_image_url`, `published_at`, `created_at`, `updated_at`) VALUES
(15, 'CHƯƠNG TRÌNH MEMBERSHIP', 'chuong-trinh-membership', '<div id=\"text-1736945768\" class=\"text\">\r\n<p style=\"text-align: center;\"><strong>CHƯƠNG TR&Igrave;NH MEMBERSHIP</strong></p>\r\n<p style=\"text-align: center;\">Ưu đ&atilde;i độc quyền | Trải nghiệm c&aacute; nh&acirc;n h&oacute;a</p>\r\n</div>\r\n<div id=\"image_681908090\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/07/membership-1400x788.webp\" sizes=\"(max-width: 1020px) 100vw, 1020px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/membership-1400x788.webp 1400w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-711x400.webp 711w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-768x432.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-1536x864.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-300x169.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-600x338.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/membership.webp 2000w\" alt=\"\" width=\"1020\" height=\"574\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/07/membership-1400x788.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/membership-1400x788.webp 1400w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-711x400.webp 711w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-768x432.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-1536x864.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-300x169.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-600x338.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/membership.webp 2000w\"></div>\r\n</div>\r\n<div id=\"image_467306814\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\">&nbsp;</div>\r\n</div>\r\n<div id=\"text-465319644\" class=\"text\" style=\"text-align: center;\">\r\n<p><strong>Nh&agrave; Xinh h&acirc;n hạnh giới thiệu Chương tr&igrave;nh Membership &ndash; cầu nối d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng tinh tế, nơi ưu đ&atilde;i độc quyền gặp gỡ trải nghiệm c&aacute; nh&acirc;n h&oacute;a đẳng cấp.</strong></p>\r\n<p>🎁&nbsp;<strong>Ưu Đ&atilde;i Đặc Quyền &ndash; Trải Nghiệm Kh&aacute;c Biệt</strong><strong><br></strong>Trở th&agrave;nh th&agrave;nh vi&ecirc;n, bạn sẽ tận hưởng ngay mức giảm đặc biệt từ&nbsp;5-25% cho tất cả sản phẩm. Đ&acirc;y l&agrave; cơ hội tuyệt vời để n&acirc;ng tầm kh&ocirc;ng gian sống của bạn.</p>\r\n<p>✨&nbsp;<strong>Dịch Vụ C&aacute; Nh&acirc;n H&oacute;a Ri&ecirc;ng Biệt</strong><strong><br></strong>Membership kh&ocirc;ng chỉ mang đến ưu đ&atilde;i vượt trội, m&agrave; c&ograve;n mở ra trải nghiệm trọn vẹn &ndash; từ tư vấn thiết kế, lựa chọn chất liệu đến những gợi &yacute; tinh tế, ph&ugrave; hợp với phong c&aacute;ch sống của ri&ecirc;ng bạn.</p>\r\n<p><strong>Đăng K&yacute; Th&agrave;nh Vi&ecirc;n &ndash; Nhận Ngay Ưu Đ&atilde;i</strong></p>\r\n</div>\r\n<p style=\"text-align: center;\"><a class=\"button success box-shadow-2\" href=\"https://akacompany.com.vn/en/contactus-nhaxinh\">Đăng k&yacute;</a></p>\r\n<div id=\"text-1585945835\" class=\"text\" style=\"text-align: center;\">\r\n<p><strong>Ngo&agrave;i việc ưu đ&atilde;i tr&ecirc;n &ndash; Ri&ecirc;ng với d&ograve;ng sản phẩm Coastal sẽ c&oacute; mức ưu đ&atilde;i hấp dẫn chưa từng c&oacute;!</strong></p>\r\n</div>\r\n<div id=\"image_716715260\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-1267x800.webp\" sizes=\"(max-width: 1020px) 100vw, 1020px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-1267x800.webp 1267w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-634x400.webp 634w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-768x485.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-300x189.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-600x379.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1.webp 1500w\" alt=\"\" width=\"1020\" height=\"644\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-1267x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-1267x800.webp 1267w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-634x400.webp 634w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-768x485.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-300x189.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-600x379.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1.webp 1500w\"></div>\r\n</div>\r\n<div id=\"text-3956838908\" class=\"text\" style=\"text-align: center;\">\r\n<p><em>Sofa g&oacute;c phải Coastal&nbsp;</em></p>\r\n</div>\r\n<div id=\"text-3599828596\" class=\"text\" style=\"text-align: center;\">\r\n<p>Chạm đường n&eacute;t &amp; Cảm chiều s&acirc;u từ Bộ sưu tập Coastal &ndash; Với ưu đ&atilde;i đặc quyền khi đăng k&yacute; Th&agrave;nh Vi&ecirc;n</p>\r\n</div>\r\n<div id=\"row-916176260\" class=\"row\" style=\"text-align: center;\">\r\n<div id=\"col-1989195561\" class=\"col medium-6 small-12 large-6\">\r\n<div class=\"col-inner text-right\">\r\n<div id=\"image_372043925\" class=\"img has-hover x md-x lg-x y md-y lg-y\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-472x800.webp\" sizes=\"(max-width: 472px) 100vw, 472px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-472x800.webp 472w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-236x400.webp 236w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-768x1302.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-906x1536.webp 906w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-300x509.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-600x1017.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7.webp 1200w\" alt=\"\" width=\"472\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-472x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-472x800.webp 472w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-236x400.webp 236w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-768x1302.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-906x1536.webp 906w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-300x509.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-600x1017.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7.webp 1200w\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"col-1595323255\" class=\"col medium-6 small-12 large-6\">\r\n<div class=\"col-inner text-left\">\r\n<div id=\"image_2076661734\" class=\"img has-hover x md-x lg-x y md-y lg-y\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-472x800.webp\" sizes=\"(max-width: 472px) 100vw, 472px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-472x800.webp 472w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-236x400.webp 236w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-768x1302.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-906x1536.webp 906w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-300x509.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-600x1017.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1.webp 1100w\" alt=\"\" width=\"472\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-472x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-472x800.webp 472w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-236x400.webp 236w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-768x1302.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-906x1536.webp 906w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-300x509.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-600x1017.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1.webp 1100w\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"text-178451524\" class=\"text\" style=\"text-align: center;\">\r\n<p>Với thiết kế mềm mại, t&ocirc;ng vải dịu m&aacute;t chi tiết trau chuốt tỉ mỉ nhằm n&acirc;ng đỡ gia chủ một c&aacute;ch &ecirc;m &aacute;i, Coastal tạo n&ecirc;n sự tương phản h&agrave;i h&ograve;a &ndash; vừa gần gũi, vừa sang trọng.</p>\r\n<p><br><br></p>\r\n</div>\r\n<div id=\"image_365130778\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-1116x800.webp\" sizes=\"(max-width: 1020px) 100vw, 1020px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-1116x800.webp 1116w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-558x400.webp 558w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-768x551.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-1536x1101.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-300x215.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-600x430.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8.webp 1700w\" alt=\"\" width=\"1020\" height=\"731\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-1116x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-1116x800.webp 1116w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-558x400.webp 558w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-768x551.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-1536x1101.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-300x215.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-600x430.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8.webp 1700w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\"><strong>Sofa COASTAL G&oacute;c Phải 2m9 &ndash; VACT 4251&nbsp;</strong></p>\r\n<p style=\"text-align: center;\"><strong>GI&aacute; ni&ecirc;m yết:</strong>&nbsp;44.900.000&nbsp;<strong>Giảm c&ograve;n:</strong>&nbsp;20.410.000</p>\r\n<p style=\"text-align: center;\">Chỉ &aacute;p dụng cho th&agrave;nh vi&ecirc;n.</p>', 12, 'blog_post', 'published', 'CHƯƠNG TRÌNH MEMBERSHIP', 'Ưu đãi độc quyền | Trải nghiệm cá nhân hóa', 'pages/lBbAyswjYraLGckD6D4l4UCn0iyq17oYFxdC9nYn.jpg', '2024-07-19 05:10:00', '2025-06-28 19:21:29', '2025-07-26 06:56:26');

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
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `instructions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `code`, `description`, `instructions`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Thanh toán khi nhận hàng', 'cod', 'Thanh toán trực tiếp khi nhận hàng', NULL, 1, '2025-07-09 06:27:30', '2025-07-09 06:27:30'),
(2, 'Chuyển khoản ngân hàng', 'bank', 'Chuyển khoản qua tài khoản ngân hàng', NULL, 1, '2025-07-09 06:27:30', '2025-07-09 06:27:30'),
(3, 'MOMO', 'MOMO', 'Thanh toán bằng ví điện tử Momo', NULL, 1, '2025-07-09 06:27:30', '2025-07-26 05:16:25'),
(4, 'PayPal', 'paypal', 'Thanh toán bằng ví điện tử Paypal', 'Paypallllllllll', 1, '2025-07-24 22:53:12', '2025-08-06 14:37:11'),
(5, 'VNPAY', 'VNPAY', 'Thanh toán bằng ví điện tử VNPAY', 'VNPAY', 1, '2025-07-26 04:40:00', '2025-08-06 14:36:55');

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Shipper', 2, 'shipper-app-token', 'a65a7c5851f33f452a057c8c3e831e7abde0b163cacab71779b0730f32389e92', '[\"*\"]', '2025-08-20 17:20:41', NULL, '2025-08-20 15:53:18', '2025-08-20 17:20:41');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `regular_price` decimal(15,2) NOT NULL,
  `stock_quantity` int UNSIGNED DEFAULT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('published','draft','archived','out_of_stock') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `view_count` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `short_description`, `description`, `regular_price`, `stock_quantity`, `category_id`, `brand_id`, `status`, `is_featured`, `view_count`, `created_at`, `updated_at`) VALUES
(21, 'Sofa 2 Chỗ COASTAL 2m2', 'sofa-2-cho-coastal-2m2', 'Sofa hiện đại, thiết kế tinh tế, chất liệu cao cấp, mang đến sự thoải mái và sang trọng cho không gian sống.', 'Mang đến sự kết hợp hoàn hảo giữa phong cách và tiện nghi, bộ sofa cao cấp được thiết kế theo xu hướng hiện đại, phù hợp với nhiều không gian như phòng khách, văn phòng hoặc căn hộ chung cư. Khung ghế chắc chắn, được làm từ gỗ tự nhiên chống mối mọt, kết hợp với đệm ngồi êm ái và vải bọc chất lượng cao giúp tăng độ bền và tạo cảm giác thoải mái khi sử dụng. Đường may tinh xảo, màu sắc trang nhã, dễ dàng phối hợp với nhiều phong cách nội thất. Đây không chỉ là nơi thư giãn mà còn là điểm nhấn thẩm mỹ cho ngôi nhà của bạn.', '3200000.00', NULL, 16, 8, 'published', 1, 0, '2025-07-09 06:39:44', '2025-07-09 06:39:44'),
(22, 'Sofa 2 Chỗ HÀ NỘI 1m8', 'sofa-2-cho-ha-noi-1m8', 'Sofa hiện đại, thiết kế tinh tế, chất liệu cao cấp, mang đến sự thoải mái và sang trọng cho không gian sống.', 'Mang đến sự kết hợp hoàn hảo giữa phong cách và tiện nghi, bộ sofa cao cấp được thiết kế theo xu hướng hiện đại, phù hợp với nhiều không gian như phòng khách, văn phòng hoặc căn hộ chung cư. Khung ghế chắc chắn, được làm từ gỗ tự nhiên chống mối mọt, kết hợp với đệm ngồi êm ái và vải bọc chất lượng cao giúp tăng độ bền và tạo cảm giác thoải mái khi sử dụng. Đường may tinh xảo, màu sắc trang nhã, dễ dàng phối hợp với nhiều phong cách nội thất. Đây không chỉ là nơi thư giãn mà còn là điểm nhấn thẩm mỹ cho ngôi nhà của bạn.', '8700000.00', NULL, 16, 8, 'published', 1, 0, '2025-07-09 06:43:31', '2025-07-09 06:43:31'),
(23, 'Sofa 2 Chỗ MIAMI 1m8', 'sofa-2-cho-miami-1m8', 'Sofa hiện đại, thiết kế tinh tế, chất liệu cao cấp, mang đến sự thoải mái và sang trọng cho không gian sống.', 'Mang đến sự kết hợp hoàn hảo giữa phong cách và tiện nghi, bộ sofa cao cấp được thiết kế theo xu hướng hiện đại, phù hợp với nhiều không gian như phòng khách, văn phòng hoặc căn hộ chung cư. Khung ghế chắc chắn, được làm từ gỗ tự nhiên chống mối mọt, kết hợp với đệm ngồi êm ái và vải bọc chất lượng cao giúp tăng độ bền và tạo cảm giác thoải mái khi sử dụng. Đường may tinh xảo, màu sắc trang nhã, dễ dàng phối hợp với nhiều phong cách nội thất. Đây không chỉ là nơi thư giãn mà còn là điểm nhấn thẩm mỹ cho ngôi nhà của bạn.', '15200000.00', NULL, 16, 8, 'published', 1, 0, '2025-07-09 18:06:26', '2025-07-09 18:06:26'),
(24, 'Sofa 2 Chỗ MOON 1m5', 'sofa-2-cho-moon-1m5', 'Sofa hiện đại, thiết kế tinh tế, chất liệu cao cấp, mang đến sự thoải mái và sang trọng cho không gian sống.', 'Mang đến sự kết hợp hoàn hảo giữa phong cách và tiện nghi, bộ sofa cao cấp được thiết kế theo xu hướng hiện đại, phù hợp với nhiều không gian như phòng khách, văn phòng hoặc căn hộ chung cư. Khung ghế chắc chắn, được làm từ gỗ tự nhiên chống mối mọt, kết hợp với đệm ngồi êm ái và vải bọc chất lượng cao giúp tăng độ bền và tạo cảm giác thoải mái khi sử dụng. Đường may tinh xảo, màu sắc trang nhã, dễ dàng phối hợp với nhiều phong cách nội thất. Đây không chỉ là nơi thư giãn mà còn là điểm nhấn thẩm mỹ cho ngôi nhà của bạn.', '11000000.00', NULL, 16, 8, 'published', 1, 0, '2025-07-09 18:07:36', '2025-07-09 18:07:36'),
(25, 'Sofa 2 chỗ NANCY 1m6', 'sofa-2-cho-nancy-1m6', 'Sofa hiện đại, thiết kế tinh tế, chất liệu cao cấp, mang đến sự thoải mái và sang trọng cho không gian sống.', 'Mang đến sự kết hợp hoàn hảo giữa phong cách và tiện nghi, bộ sofa cao cấp được thiết kế theo xu hướng hiện đại, phù hợp với nhiều không gian như phòng khách, văn phòng hoặc căn hộ chung cư. Khung ghế chắc chắn, được làm từ gỗ tự nhiên chống mối mọt, kết hợp với đệm ngồi êm ái và vải bọc chất lượng cao giúp tăng độ bền và tạo cảm giác thoải mái khi sử dụng. Đường may tinh xảo, màu sắc trang nhã, dễ dàng phối hợp với nhiều phong cách nội thất. Đây không chỉ là nơi thư giãn mà còn là điểm nhấn thẩm mỹ cho ngôi nhà của bạn.', '14000000.00', NULL, 16, 8, 'published', 1, 0, '2025-07-09 18:11:56', '2025-07-09 18:11:56'),
(26, 'Sofa 3 chỗ BOLERO 2m2', 'sofa-3-cho-bolero-2m2', 'Sofa hiện đại, thiết kế tinh tế, chất liệu cao cấp, mang đến sự thoải mái và sang trọng cho không gian sống.', 'Mang đến sự kết hợp hoàn hảo giữa phong cách và tiện nghi, bộ sofa cao cấp được thiết kế theo xu hướng hiện đại, phù hợp với nhiều không gian như phòng khách, văn phòng hoặc căn hộ chung cư. Khung ghế chắc chắn, được làm từ gỗ tự nhiên chống mối mọt, kết hợp với đệm ngồi êm ái và vải bọc chất lượng cao giúp tăng độ bền và tạo cảm giác thoải mái khi sử dụng. Đường may tinh xảo, màu sắc trang nhã, dễ dàng phối hợp với nhiều phong cách nội thất. Đây không chỉ là nơi thư giãn mà còn là điểm nhấn thẩm mỹ cho ngôi nhà của bạn.', '22000000.00', NULL, 16, 9, 'published', 0, 0, '2025-07-09 18:15:20', '2025-07-09 18:15:20'),
(27, 'Sofa 3 Chỗ NEST 2m8', 'sofa-3-cho-nest-2m8', 'Sofa hiện đại, thiết kế tinh tế, chất liệu cao cấp, mang đến sự thoải mái và sang trọng cho không gian sống.', 'Mang đến sự kết hợp hoàn hảo giữa phong cách và tiện nghi, bộ sofa cao cấp được thiết kế theo xu hướng hiện đại, phù hợp với nhiều không gian như phòng khách, văn phòng hoặc căn hộ chung cư. Khung ghế chắc chắn, được làm từ gỗ tự nhiên chống mối mọt, kết hợp với đệm ngồi êm ái và vải bọc chất lượng cao giúp tăng độ bền và tạo cảm giác thoải mái khi sử dụng. Đường may tinh xảo, màu sắc trang nhã, dễ dàng phối hợp với nhiều phong cách nội thất. Đây không chỉ là nơi thư giãn mà còn là điểm nhấn thẩm mỹ cho ngôi nhà của bạn.', '35000000.00', NULL, 16, 9, 'published', 0, 0, '2025-07-09 18:18:41', '2025-07-09 18:18:41'),
(28, 'Sofa 2 Chỗ OGAMI 1m4', 'sofa-2-cho-ogami-1m4', 'Sofa hiện đại, thiết kế tinh tế, chất liệu cao cấp, mang đến sự thoải mái và sang trọng cho không gian sống.', 'Mang đến sự kết hợp hoàn hảo giữa phong cách và tiện nghi, bộ sofa cao cấp được thiết kế theo xu hướng hiện đại, phù hợp với nhiều không gian như phòng khách, văn phòng hoặc căn hộ chung cư. Khung ghế chắc chắn, được làm từ gỗ tự nhiên chống mối mọt, kết hợp với đệm ngồi êm ái và vải bọc chất lượng cao giúp tăng độ bền và tạo cảm giác thoải mái khi sử dụng. Đường may tinh xảo, màu sắc trang nhã, dễ dàng phối hợp với nhiều phong cách nội thất. Đây không chỉ là nơi thư giãn mà còn là điểm nhấn thẩm mỹ cho ngôi nhà của bạn.', '13000000.00', NULL, 16, 8, 'published', 0, 0, '2025-07-09 18:24:20', '2025-07-09 18:24:20'),
(29, 'Sofa 3 Chỗ CABO 2m2', 'sofa-3-cho-cabo-2m2', 'Sofa hiện đại, thiết kế tinh tế, chất liệu cao cấp, mang đến sự thoải mái và sang trọng cho không gian sống.', 'Mang đến sự kết hợp hoàn hảo giữa phong cách và tiện nghi, bộ sofa cao cấp được thiết kế theo xu hướng hiện đại, phù hợp với nhiều không gian như phòng khách, văn phòng hoặc căn hộ chung cư. Khung ghế chắc chắn, được làm từ gỗ tự nhiên chống mối mọt, kết hợp với đệm ngồi êm ái và vải bọc chất lượng cao giúp tăng độ bền và tạo cảm giác thoải mái khi sử dụng. Đường may tinh xảo, màu sắc trang nhã, dễ dàng phối hợp với nhiều phong cách nội thất. Đây không chỉ là nơi thư giãn mà còn là điểm nhấn thẩm mỹ cho ngôi nhà của bạn.', '32000000.00', NULL, 16, 8, 'published', 0, 0, '2025-07-09 18:26:41', '2025-07-09 18:26:41'),
(30, 'Sofa 3 Chỗ PENNY 2m4', 'sofa-3-cho-penny-2m4', 'Sofa hiện đại, thiết kế tinh tế, chất liệu cao cấp, mang đến sự thoải mái và sang trọng cho không gian sống.', 'Mang đến sự kết hợp hoàn hảo giữa phong cách và tiện nghi, bộ sofa cao cấp được thiết kế theo xu hướng hiện đại, phù hợp với nhiều không gian như phòng khách, văn phòng hoặc căn hộ chung cư. Khung ghế chắc chắn, được làm từ gỗ tự nhiên chống mối mọt, kết hợp với đệm ngồi êm ái và vải bọc chất lượng cao giúp tăng độ bền và tạo cảm giác thoải mái khi sử dụng. Đường may tinh xảo, màu sắc trang nhã, dễ dàng phối hợp với nhiều phong cách nội thất. Đây không chỉ là nơi thư giãn mà còn là điểm nhấn thẩm mỹ cho ngôi nhà của bạn.', '24000000.00', NULL, 16, 8, 'published', 0, 0, '2025-07-09 18:33:46', '2025-07-09 18:33:46'),
(31, 'Armchair Dark', 'armchair-dark', 'Ghế bành êm ái, thiết kế hiện đại, lý tưởng cho thư giãn và trang trí không gian sống thêm sang trọng.', 'Ghế bành (Armchair) là lựa chọn hoàn hảo để tạo nên một góc thư giãn riêng biệt trong ngôi nhà bạn. Với thiết kế tựa lưng cao, tay vịn rộng và đệm ngồi dày dặn, sản phẩm mang lại cảm giác thoải mái tối đa cho người dùng. Chất liệu vải hoặc da cao cấp, kết hợp với khung gỗ chắc chắn, giúp ghế bền đẹp theo thời gian và dễ dàng vệ sinh. Dù đặt ở phòng khách, phòng ngủ hay góc đọc sách, armchair luôn là điểm nhấn tinh tế, mang đến vẻ đẹp hiện đại và sự ấm cúng cho không gian sống.', '7000000.00', NULL, 18, 9, 'published', 0, 0, '2025-07-09 19:40:00', '2025-07-09 19:40:00'),
(32, 'Armchair dream', 'armchair-dream', 'Ghế bành êm ái, thiết kế hiện đại, lý tưởng cho thư giãn và trang trí không gian sống thêm sang trọng.', 'Ghế bành (Armchair) là lựa chọn hoàn hảo để tạo nên một góc thư giãn riêng biệt trong ngôi nhà bạn. Với thiết kế tựa lưng cao, tay vịn rộng và đệm ngồi dày dặn, sản phẩm mang lại cảm giác thoải mái tối đa cho người dùng. Chất liệu vải hoặc da cao cấp, kết hợp với khung gỗ chắc chắn, giúp ghế bền đẹp theo thời gian và dễ dàng vệ sinh. Dù đặt ở phòng khách, phòng ngủ hay góc đọc sách, armchair luôn là điểm nhấn tinh tế, mang đến vẻ đẹp hiện đại và sự ấm cúng cho không gian sống.', '8700000.00', NULL, 18, 9, 'published', 0, 0, '2025-07-09 19:43:02', '2025-07-09 19:43:02'),
(33, 'Armchair Nancy', 'armchair-nancy', 'Ghế bành êm ái, thiết kế hiện đại, lý tưởng cho thư giãn và trang trí không gian sống thêm sang trọng.', 'Ghế bành (Armchair) là lựa chọn hoàn hảo để tạo nên một góc thư giãn riêng biệt trong ngôi nhà bạn. Với thiết kế tựa lưng cao, tay vịn rộng và đệm ngồi dày dặn, sản phẩm mang lại cảm giác thoải mái tối đa cho người dùng. Chất liệu vải hoặc da cao cấp, kết hợp với khung gỗ chắc chắn, giúp ghế bền đẹp theo thời gian và dễ dàng vệ sinh. Dù đặt ở phòng khách, phòng ngủ hay góc đọc sách, armchair luôn là điểm nhấn tinh tế, mang đến vẻ đẹp hiện đại và sự ấm cúng cho không gian sống.', '30900000.00', NULL, 18, 8, 'published', 0, 0, '2025-07-09 19:45:16', '2025-07-09 19:45:16'),
(34, 'Armchair xoay Iris', 'armchair-xoay-iris', 'Ghế bành êm ái, thiết kế hiện đại, lý tưởng cho thư giãn và trang trí không gian sống thêm sang trọng.', 'Ghế bành (Armchair) là lựa chọn hoàn hảo để tạo nên một góc thư giãn riêng biệt trong ngôi nhà bạn. Với thiết kế tựa lưng cao, tay vịn rộng và đệm ngồi dày dặn, sản phẩm mang lại cảm giác thoải mái tối đa cho người dùng. Chất liệu vải hoặc da cao cấp, kết hợp với khung gỗ chắc chắn, giúp ghế bền đẹp theo thời gian và dễ dàng vệ sinh. Dù đặt ở phòng khách, phòng ngủ hay góc đọc sách, armchair luôn là điểm nhấn tinh tế, mang đến vẻ đẹp hiện đại và sự ấm cúng cho không gian sống.', '11999999.99', NULL, 18, 7, 'published', 0, 0, '2025-07-09 19:52:31', '2025-07-09 19:52:31'),
(35, 'Armchair xoay Jadora', 'armchair-xoay-jadora', 'Ghế bành êm ái, thiết kế hiện đại, lý tưởng cho thư giãn và trang trí không gian sống thêm sang trọng.', 'Ghế bành (Armchair) là lựa chọn hoàn hảo để tạo nên một góc thư giãn riêng biệt trong ngôi nhà bạn. Với thiết kế tựa lưng cao, tay vịn rộng và đệm ngồi dày dặn, sản phẩm mang lại cảm giác thoải mái tối đa cho người dùng. Chất liệu vải hoặc da cao cấp, kết hợp với khung gỗ chắc chắn, giúp ghế bền đẹp theo thời gian và dễ dàng vệ sinh. Dù đặt ở phòng khách, phòng ngủ hay góc đọc sách, armchair luôn là điểm nhấn tinh tế, mang đến vẻ đẹp hiện đại và sự ấm cúng cho không gian sống.', '9900000.00', NULL, 18, 7, 'published', 0, 0, '2025-07-09 19:56:30', '2025-07-09 19:56:30'),
(36, 'Armchair Bristol', 'armchair-bristol', 'Ghế bành êm ái, thiết kế hiện đại, lý tưởng cho thư giãn và trang trí không gian sống thêm sang trọng.', 'Ghế bành (Armchair) là lựa chọn hoàn hảo để tạo nên một góc thư giãn riêng biệt trong ngôi nhà bạn. Với thiết kế tựa lưng cao, tay vịn rộng và đệm ngồi dày dặn, sản phẩm mang lại cảm giác thoải mái tối đa cho người dùng. Chất liệu vải hoặc da cao cấp, kết hợp với khung gỗ chắc chắn, giúp ghế bền đẹp theo thời gian và dễ dàng vệ sinh. Dù đặt ở phòng khách, phòng ngủ hay góc đọc sách, armchair luôn là điểm nhấn tinh tế, mang đến vẻ đẹp hiện đại và sự ấm cúng cho không gian sống.', '13000000.00', NULL, 18, 3, 'published', 0, 0, '2025-07-09 19:59:56', '2025-07-09 19:59:56'),
(37, 'Đôn Dream tròn', 'don-dream-tron', 'Ghế đôn nhỏ gọn, tiện lợi, dễ di chuyển, phù hợp mọi không gian nội thất hiện đại.', 'Ghế đôn là món nội thất đa năng không thể thiếu trong không gian sống hiện đại. Với thiết kế nhỏ gọn, không tựa lưng, đôn có thể dùng làm ghế phụ, gác chân, bàn trà mini hoặc vật trang trí cho phòng khách, phòng ngủ. Sản phẩm được bọc vải/da cao cấp, đệm mút êm ái cùng khung gỗ hoặc kim loại chắc chắn, đảm bảo độ bền và khả năng chịu lực tốt. Dễ dàng kết hợp với sofa, armchair hoặc dùng độc lập, ghế đôn là giải pháp linh hoạt cho những ai yêu thích sự tiện nghi và thẩm mỹ tối giản.', '6000000.00', NULL, 23, 8, 'published', 0, 0, '2025-07-10 00:51:54', '2025-07-10 00:51:54'),
(38, 'Đôn dream vuông', 'don-dream-vuong', 'Ghế đôn nhỏ gọn, tiện lợi, dễ di chuyển, phù hợp mọi không gian nội thất hiện đại.', 'Ghế đôn là món nội thất đa năng không thể thiếu trong không gian sống hiện đại. Với thiết kế nhỏ gọn, không tựa lưng, đôn có thể dùng làm ghế phụ, gác chân, bàn trà mini hoặc vật trang trí cho phòng khách, phòng ngủ. Sản phẩm được bọc vải/da cao cấp, đệm mút êm ái cùng khung gỗ hoặc kim loại chắc chắn, đảm bảo độ bền và khả năng chịu lực tốt. Dễ dàng kết hợp với sofa, armchair hoặc dùng độc lập, ghế đôn là giải pháp linh hoạt cho những ai yêu thích sự tiện nghi và thẩm mỹ tối giản.', '9900000.00', NULL, 23, 8, 'published', 0, 0, '2025-07-10 00:57:03', '2025-07-10 00:57:03'),
(39, 'Đôn Cherry jungle tiger', 'don-cherry-jungle-tiger', 'Ghế đôn nhỏ gọn, tiện lợi, dễ di chuyển, phù hợp mọi không gian nội thất hiện đại.', 'Ghế đôn là món nội thất đa năng không thể thiếu trong không gian sống hiện đại. Với thiết kế nhỏ gọn, không tựa lưng, đôn có thể dùng làm ghế phụ, gác chân, bàn trà mini hoặc vật trang trí cho phòng khách, phòng ngủ. Sản phẩm được bọc vải/da cao cấp, đệm mút êm ái cùng khung gỗ hoặc kim loại chắc chắn, đảm bảo độ bền và khả năng chịu lực tốt. Dễ dàng kết hợp với sofa, armchair hoặc dùng độc lập, ghế đôn là giải pháp linh hoạt cho những ai yêu thích sự tiện nghi và thẩm mỹ tối giản.', '16000000.00', NULL, 23, 7, 'published', 0, 0, '2025-07-10 00:58:26', '2025-07-10 00:58:26'),
(40, 'Đôn con công cherry 32cm 86354K', 'don-con-cong-cherry-32cm-86354k', 'Ghế đôn nhỏ gọn, tiện lợi, dễ di chuyển, phù hợp mọi không gian nội thất hiện đại.', 'Ghế đôn là món nội thất đa năng không thể thiếu trong không gian sống hiện đại. Với thiết kế nhỏ gọn, không tựa lưng, đôn có thể dùng làm ghế phụ, gác chân, bàn trà mini hoặc vật trang trí cho phòng khách, phòng ngủ. Sản phẩm được bọc vải/da cao cấp, đệm mút êm ái cùng khung gỗ hoặc kim loại chắc chắn, đảm bảo độ bền và khả năng chịu lực tốt. Dễ dàng kết hợp với sofa, armchair hoặc dùng độc lập, ghế đôn là giải pháp linh hoạt cho những ai yêu thích sự tiện nghi và thẩm mỹ tối giản.', '24000000.00', NULL, 23, 9, 'published', 0, 0, '2025-07-10 00:59:44', '2025-07-10 00:59:44'),
(41, 'Đôn hoa hồng cherry 32cm 86351K', 'don-hoa-hong-cherry-32cm-86351k', 'Ghế đôn nhỏ gọn, tiện lợi, dễ di chuyển, phù hợp mọi không gian nội thất hiện đại.', 'Ghế đôn là món nội thất đa năng không thể thiếu trong không gian sống hiện đại. Với thiết kế nhỏ gọn, không tựa lưng, đôn có thể dùng làm ghế phụ, gác chân, bàn trà mini hoặc vật trang trí cho phòng khách, phòng ngủ. Sản phẩm được bọc vải/da cao cấp, đệm mút êm ái cùng khung gỗ hoặc kim loại chắc chắn, đảm bảo độ bền và khả năng chịu lực tốt. Dễ dàng kết hợp với sofa, armchair hoặc dùng độc lập, ghế đôn là giải pháp linh hoạt cho những ai yêu thích sự tiện nghi và thẩm mỹ tối giản.', '14000000.00', NULL, 23, 9, 'published', 0, 0, '2025-07-10 01:00:45', '2025-07-10 01:00:45'),
(42, 'Bàn bên Luxury Triangle Champ 84156K', 'ban-ben-luxury-triangle-champ-84156k', 'Bàn bên nhỏ gọn, thiết kế tinh tế, hoàn hảo để đặt đèn, sách hoặc đồ trang trí trong mọi không gian.', 'Bàn bên (Side Table) là món nội thất không thể thiếu trong không gian hiện đại, vừa tiện dụng vừa tăng tính thẩm mỹ. Với thiết kế nhỏ gọn, dễ dàng di chuyển, bàn bên thích hợp đặt cạnh sofa, ghế bành hoặc giường ngủ để đặt đèn ngủ, tách cà phê, sách báo hoặc đồ trang trí. Chất liệu phong phú như gỗ tự nhiên, kim loại sơn tĩnh điện hay mặt kính cao cấp mang lại vẻ sang trọng và độ bền cao. Dù ở phòng khách, phòng ngủ hay góc thư giãn, bàn bên luôn tạo điểm nhấn tinh tế và tiện lợi cho người dùng.', '14000000.00', NULL, 21, 9, 'published', 0, 0, '2025-07-10 01:02:55', '2025-07-10 01:02:55'),
(43, 'Bàn bên Endless Vegas', 'ban-ben-endless-vegas', 'Bàn bên nhỏ gọn, thiết kế tinh tế, hoàn hảo để đặt đèn, sách hoặc đồ trang trí trong mọi không gian.', 'Bàn bên (Side Table) là món nội thất không thể thiếu trong không gian hiện đại, vừa tiện dụng vừa tăng tính thẩm mỹ. Với thiết kế nhỏ gọn, dễ dàng di chuyển, bàn bên thích hợp đặt cạnh sofa, ghế bành hoặc giường ngủ để đặt đèn ngủ, tách cà phê, sách báo hoặc đồ trang trí. Chất liệu phong phú như gỗ tự nhiên, kim loại sơn tĩnh điện hay mặt kính cao cấp mang lại vẻ sang trọng và độ bền cao. Dù ở phòng khách, phòng ngủ hay góc thư giãn, bàn bên luôn tạo điểm nhấn tinh tế và tiện lợi cho người dùng.', '11000000.00', NULL, 21, 8, 'published', 0, 0, '2025-07-10 01:07:55', '2025-07-10 01:07:55'),
(44, 'Bàn bên Rise Walnut', 'ban-ben-rise-walnut', 'Bàn bên nhỏ gọn, thiết kế tinh tế, hoàn hảo để đặt đèn, sách hoặc đồ trang trí trong mọi không gian.', 'Bàn bên (Side Table) là món nội thất không thể thiếu trong không gian hiện đại, vừa tiện dụng vừa tăng tính thẩm mỹ. Với thiết kế nhỏ gọn, dễ dàng di chuyển, bàn bên thích hợp đặt cạnh sofa, ghế bành hoặc giường ngủ để đặt đèn ngủ, tách cà phê, sách báo hoặc đồ trang trí. Chất liệu phong phú như gỗ tự nhiên, kim loại sơn tĩnh điện hay mặt kính cao cấp mang lại vẻ sang trọng và độ bền cao. Dù ở phòng khách, phòng ngủ hay góc thư giãn, bàn bên luôn tạo điểm nhấn tinh tế và tiện lợi cho người dùng.', '6999999.99', NULL, 21, 7, 'published', 0, 0, '2025-07-10 01:08:56', '2025-07-10 01:08:56'),
(45, 'Bàn bên tròn Mây mới', 'ban-ben-tron-may-moi', 'Bàn bên nhỏ gọn, thiết kế tinh tế, hoàn hảo để đặt đèn, sách hoặc đồ trang trí trong mọi không gian.', 'Bàn bên (Side Table) là món nội thất không thể thiếu trong không gian hiện đại, vừa tiện dụng vừa tăng tính thẩm mỹ. Với thiết kế nhỏ gọn, dễ dàng di chuyển, bàn bên thích hợp đặt cạnh sofa, ghế bành hoặc giường ngủ để đặt đèn ngủ, tách cà phê, sách báo hoặc đồ trang trí. Chất liệu phong phú như gỗ tự nhiên, kim loại sơn tĩnh điện hay mặt kính cao cấp mang lại vẻ sang trọng và độ bền cao. Dù ở phòng khách, phòng ngủ hay góc thư giãn, bàn bên luôn tạo điểm nhấn tinh tế và tiện lợi cho người dùng.', '5000000.00', NULL, 21, 7, 'published', 0, 0, '2025-07-10 01:10:00', '2025-07-10 01:10:00'),
(46, 'Bàn nước Hùng King', 'ban-nuoc-hung-king', 'Bàn nước thiết kế hiện đại, tiện dụng, là điểm nhấn trung tâm cho không gian phòng khách sang trọng.', 'Bàn nước (coffee table) là món nội thất trung tâm, góp phần hoàn thiện và nâng tầm không gian phòng khách. Với thiết kế đa dạng từ hiện đại tối giản đến cổ điển sang trọng, bàn nước không chỉ dùng để đặt tách trà, sách báo hay đồ trang trí mà còn thể hiện phong cách sống tinh tế của gia chủ. Sản phẩm được làm từ các chất liệu như gỗ tự nhiên, mặt kính cường lực, đá nhân tạo hoặc kim loại sơn tĩnh điện, đảm bảo độ bền chắc và dễ vệ sinh. Nhiều mẫu còn tích hợp ngăn kéo hoặc kệ dưới tiện lợi để lưu trữ đồ dùng. Bàn nước là sự lựa chọn hoàn hảo để tạo điểm nhấn hài hòa trong không gian tiếp khách.', '15999999.99', NULL, 22, 9, 'published', 0, 0, '2025-07-10 01:11:09', '2025-07-10 01:11:09'),
(47, 'Bàn nước mặt đá Ogami', 'ban-nuoc-mat-da-ogami', 'Bàn nước thiết kế hiện đại, tiện dụng, là điểm nhấn trung tâm cho không gian phòng khách sang trọng.', 'Bàn nước (coffee table) là món nội thất trung tâm, góp phần hoàn thiện và nâng tầm không gian phòng khách. Với thiết kế đa dạng từ hiện đại tối giản đến cổ điển sang trọng, bàn nước không chỉ dùng để đặt tách trà, sách báo hay đồ trang trí mà còn thể hiện phong cách sống tinh tế của gia chủ. Sản phẩm được làm từ các chất liệu như gỗ tự nhiên, mặt kính cường lực, đá nhân tạo hoặc kim loại sơn tĩnh điện, đảm bảo độ bền chắc và dễ vệ sinh. Nhiều mẫu còn tích hợp ngăn kéo hoặc kệ dưới tiện lợi để lưu trữ đồ dùng. Bàn nước là sự lựa chọn hoàn hảo để tạo điểm nhấn hài hòa trong không gian tiếp khách.', '13000000.00', NULL, 22, 9, 'published', 0, 0, '2025-07-10 01:13:06', '2025-07-10 01:13:06'),
(48, 'Bàn nước Valente chữ nhật', 'ban-nuoc-valente-chu-nhat', 'Bàn nước thiết kế hiện đại, tiện dụng, là điểm nhấn trung tâm cho không gian phòng khách sang trọng.', 'Bàn nước (coffee table) là món nội thất trung tâm, góp phần hoàn thiện và nâng tầm không gian phòng khách. Với thiết kế đa dạng từ hiện đại tối giản đến cổ điển sang trọng, bàn nước không chỉ dùng để đặt tách trà, sách báo hay đồ trang trí mà còn thể hiện phong cách sống tinh tế của gia chủ. Sản phẩm được làm từ các chất liệu như gỗ tự nhiên, mặt kính cường lực, đá nhân tạo hoặc kim loại sơn tĩnh điện, đảm bảo độ bền chắc và dễ vệ sinh. Nhiều mẫu còn tích hợp ngăn kéo hoặc kệ dưới tiện lợi để lưu trữ đồ dùng. Bàn nước là sự lựa chọn hoàn hảo để tạo điểm nhấn hài hòa trong không gian tiếp khách.', '22999999.99', NULL, 22, 10, 'published', 0, 0, '2025-07-10 01:14:31', '2025-07-10 01:14:31'),
(49, 'Bàn nước Bridge mặt Marble trắng 120cm', 'ban-nuoc-bridge-mat-marble-trang-120cm', 'Bàn nước thiết kế hiện đại, tiện dụng, là điểm nhấn trung tâm cho không gian phòng khách sang trọng.', 'Bàn nước (coffee table) là món nội thất trung tâm, góp phần hoàn thiện và nâng tầm không gian phòng khách. Với thiết kế đa dạng từ hiện đại tối giản đến cổ điển sang trọng, bàn nước không chỉ dùng để đặt tách trà, sách báo hay đồ trang trí mà còn thể hiện phong cách sống tinh tế của gia chủ. Sản phẩm được làm từ các chất liệu như gỗ tự nhiên, mặt kính cường lực, đá nhân tạo hoặc kim loại sơn tĩnh điện, đảm bảo độ bền chắc và dễ vệ sinh. Nhiều mẫu còn tích hợp ngăn kéo hoặc kệ dưới tiện lợi để lưu trữ đồ dùng. Bàn nước là sự lựa chọn hoàn hảo để tạo điểm nhấn hài hòa trong không gian tiếp khách.', '11999999.99', NULL, 22, 10, 'published', 0, 0, '2025-07-10 01:15:27', '2025-07-10 01:15:27'),
(50, 'Bàn nước Around', 'ban-nuoc-around', 'Bàn nước thiết kế hiện đại, tiện dụng, là điểm nhấn trung tâm cho không gian phòng khách sang trọng.', 'Bàn nước (coffee table) là món nội thất trung tâm, góp phần hoàn thiện và nâng tầm không gian phòng khách. Với thiết kế đa dạng từ hiện đại tối giản đến cổ điển sang trọng, bàn nước không chỉ dùng để đặt tách trà, sách báo hay đồ trang trí mà còn thể hiện phong cách sống tinh tế của gia chủ. Sản phẩm được làm từ các chất liệu như gỗ tự nhiên, mặt kính cường lực, đá nhân tạo hoặc kim loại sơn tĩnh điện, đảm bảo độ bền chắc và dễ vệ sinh. Nhiều mẫu còn tích hợp ngăn kéo hoặc kệ dưới tiện lợi để lưu trữ đồ dùng. Bàn nước là sự lựa chọn hoàn hảo để tạo điểm nhấn hài hòa trong không gian tiếp khách.', '14000000.00', NULL, 22, 10, 'published', 0, 0, '2025-07-10 01:16:59', '2025-07-10 01:16:59'),
(51, 'Ghế ăn Bolero ACC001', 'ghe-an-bolero-acc001', 'Ghế ăn thiết kế thanh lịch, khung chắc chắn, mang đến sự thoải mái và thẩm mỹ cho không gian bàn ăn.', 'Ghế ăn là món nội thất thiết yếu góp phần hoàn thiện không gian bếp hoặc phòng ăn gia đình. Với thiết kế chú trọng đến sự thoải mái và độ bền, ghế được làm từ các chất liệu như gỗ tự nhiên, kim loại sơn tĩnh điện, hoặc nhựa cao cấp, kết hợp với đệm ngồi bọc vải hoặc da sang trọng. Tựa lưng cong nhẹ nâng đỡ cột sống, giúp người dùng có tư thế ngồi dễ chịu trong suốt bữa ăn. Kiểu dáng đa dạng từ cổ điển đến hiện đại, dễ dàng phối hợp với nhiều loại bàn ăn khác nhau. Ghế ăn không chỉ phục vụ nhu cầu sử dụng hằng ngày mà còn nâng tầm vẻ đẹp thẩm mỹ cho không gian sống.', '6000000.00', NULL, 24, 10, 'published', 0, 0, '2025-07-10 01:20:07', '2025-07-10 01:20:07'),
(52, 'Ghế ăn có tay Ogami', 'ghe-an-co-tay-ogami', 'Ghế ăn thiết kế thanh lịch, khung chắc chắn, mang đến sự thoải mái và thẩm mỹ cho không gian bàn ăn.', 'Ghế ăn là món nội thất thiết yếu góp phần hoàn thiện không gian bếp hoặc phòng ăn gia đình. Với thiết kế chú trọng đến sự thoải mái và độ bền, ghế được làm từ các chất liệu như gỗ tự nhiên, kim loại sơn tĩnh điện, hoặc nhựa cao cấp, kết hợp với đệm ngồi bọc vải hoặc da sang trọng. Tựa lưng cong nhẹ nâng đỡ cột sống, giúp người dùng có tư thế ngồi dễ chịu trong suốt bữa ăn. Kiểu dáng đa dạng từ cổ điển đến hiện đại, dễ dàng phối hợp với nhiều loại bàn ăn khác nhau. Ghế ăn không chỉ phục vụ nhu cầu sử dụng hằng ngày mà còn nâng tầm vẻ đẹp thẩm mỹ cho không gian sống.', '4500000.00', NULL, 24, 8, 'published', 0, 0, '2025-07-10 01:21:24', '2025-07-10 01:21:24'),
(53, 'Ghế ăn Coastal', 'ghe-an-coastal', 'Ghế ăn thiết kế thanh lịch, khung chắc chắn, mang đến sự thoải mái và thẩm mỹ cho không gian bàn ăn.', 'Ghế ăn là món nội thất thiết yếu góp phần hoàn thiện không gian bếp hoặc phòng ăn gia đình. Với thiết kế chú trọng đến sự thoải mái và độ bền, ghế được làm từ các chất liệu như gỗ tự nhiên, kim loại sơn tĩnh điện, hoặc nhựa cao cấp, kết hợp với đệm ngồi bọc vải hoặc da sang trọng. Tựa lưng cong nhẹ nâng đỡ cột sống, giúp người dùng có tư thế ngồi dễ chịu trong suốt bữa ăn. Kiểu dáng đa dạng từ cổ điển đến hiện đại, dễ dàng phối hợp với nhiều loại bàn ăn khác nhau. Ghế ăn không chỉ phục vụ nhu cầu sử dụng hằng ngày mà còn nâng tầm vẻ đẹp thẩm mỹ cho không gian sống.', '4299999.99', NULL, 24, 7, 'published', 0, 0, '2025-07-10 01:24:47', '2025-07-10 01:24:47'),
(54, 'Ghế ăn Moretti', 'ghe-an-moretti', 'Ghế ăn thiết kế thanh lịch, khung chắc chắn, mang đến sự thoải mái và thẩm mỹ cho không gian bàn ăn.', 'Ghế ăn là món nội thất thiết yếu góp phần hoàn thiện không gian bếp hoặc phòng ăn gia đình. Với thiết kế chú trọng đến sự thoải mái và độ bền, ghế được làm từ các chất liệu như gỗ tự nhiên, kim loại sơn tĩnh điện, hoặc nhựa cao cấp, kết hợp với đệm ngồi bọc vải hoặc da sang trọng. Tựa lưng cong nhẹ nâng đỡ cột sống, giúp người dùng có tư thế ngồi dễ chịu trong suốt bữa ăn. Kiểu dáng đa dạng từ cổ điển đến hiện đại, dễ dàng phối hợp với nhiều loại bàn ăn khác nhau. Ghế ăn không chỉ phục vụ nhu cầu sử dụng hằng ngày mà còn nâng tầm vẻ đẹp thẩm mỹ cho không gian sống.', '9699999.99', NULL, 24, 3, 'published', 0, 0, '2025-07-10 01:26:17', '2025-07-10 01:26:17'),
(55, 'Ghế ăn TAURA Eponji', 'ghe-an-taura-eponji', 'Ghế ăn thiết kế thanh lịch, khung chắc chắn, mang đến sự thoải mái và thẩm mỹ cho không gian bàn ăn.', 'Ghế ăn là món nội thất thiết yếu góp phần hoàn thiện không gian bếp hoặc phòng ăn gia đình. Với thiết kế chú trọng đến sự thoải mái và độ bền, ghế được làm từ các chất liệu như gỗ tự nhiên, kim loại sơn tĩnh điện, hoặc nhựa cao cấp, kết hợp với đệm ngồi bọc vải hoặc da sang trọng. Tựa lưng cong nhẹ nâng đỡ cột sống, giúp người dùng có tư thế ngồi dễ chịu trong suốt bữa ăn. Kiểu dáng đa dạng từ cổ điển đến hiện đại, dễ dàng phối hợp với nhiều loại bàn ăn khác nhau. Ghế ăn không chỉ phục vụ nhu cầu sử dụng hằng ngày mà còn nâng tầm vẻ đẹp thẩm mỹ cho không gian sống.', '8500000.00', NULL, 24, 8, 'published', 0, 0, '2025-07-10 01:28:09', '2025-07-10 01:28:09'),
(56, 'Ghế Bridge', 'ghe-bridge', 'Ghế ăn thiết kế thanh lịch, khung chắc chắn, mang đến sự thoải mái và thẩm mỹ cho không gian bàn ăn.', 'Ghế ăn là món nội thất thiết yếu góp phần hoàn thiện không gian bếp hoặc phòng ăn gia đình. Với thiết kế chú trọng đến sự thoải mái và độ bền, ghế được làm từ các chất liệu như gỗ tự nhiên, kim loại sơn tĩnh điện, hoặc nhựa cao cấp, kết hợp với đệm ngồi bọc vải hoặc da sang trọng. Tựa lưng cong nhẹ nâng đỡ cột sống, giúp người dùng có tư thế ngồi dễ chịu trong suốt bữa ăn. Kiểu dáng đa dạng từ cổ điển đến hiện đại, dễ dàng phối hợp với nhiều loại bàn ăn khác nhau. Ghế ăn không chỉ phục vụ nhu cầu sử dụng hằng ngày mà còn nâng tầm vẻ đẹp thẩm mỹ cho không gian sống.', '9400000.00', NULL, 24, 9, 'published', 0, 0, '2025-07-10 01:31:19', '2025-07-10 01:31:19'),
(57, 'Bàn ăn 6 chỗ Coastal', 'ban-an-6-cho-coastal', 'Bàn ăn rộng rãi, thiết kế hiện đại, chất liệu cao cấp – mang đến không gian ấm cúng cho mọi bữa cơm gia đình.', 'Bàn ăn là điểm nhấn trung tâm trong không gian bếp hoặc phòng ăn, nơi các thành viên quây quần bên nhau trong những bữa ăn ấm cúng. Với thiết kế chú trọng tính thẩm mỹ và công năng, bàn ăn được làm từ các chất liệu cao cấp như gỗ tự nhiên, MDF phủ veneer, mặt đá nhân tạo hoặc kính cường lực, mang lại độ bền cao và dễ dàng vệ sinh. Kiểu dáng đa dạng – từ bàn tròn, bàn chữ nhật đến bàn mở rộng – phù hợp với mọi diện tích và phong cách nội thất. Chân bàn chắc chắn, kết cấu vững chãi, đảm bảo sự ổn định và an toàn khi sử dụng. Bàn ăn không chỉ là nơi dùng bữa mà còn là nơi gắn kết tình cảm gia đình trong từng khoảnh khắc đời thường.', '4300000.00', NULL, 25, 7, 'published', 0, 0, '2025-07-10 01:35:00', '2025-07-10 01:35:00'),
(58, 'Bàn ăn 8 chỗ Moretti', 'ban-an-8-cho-moretti', 'Bàn ăn rộng rãi, thiết kế hiện đại, chất liệu cao cấp – mang đến không gian ấm cúng cho mọi bữa cơm gia đình.', 'Bàn ăn là điểm nhấn trung tâm trong không gian bếp hoặc phòng ăn, nơi các thành viên quây quần bên nhau trong những bữa ăn ấm cúng. Với thiết kế chú trọng tính thẩm mỹ và công năng, bàn ăn được làm từ các chất liệu cao cấp như gỗ tự nhiên, MDF phủ veneer, mặt đá nhân tạo hoặc kính cường lực, mang lại độ bền cao và dễ dàng vệ sinh. Kiểu dáng đa dạng – từ bàn tròn, bàn chữ nhật đến bàn mở rộng – phù hợp với mọi diện tích và phong cách nội thất. Chân bàn chắc chắn, kết cấu vững chãi, đảm bảo sự ổn định và an toàn khi sử dụng. Bàn ăn không chỉ là nơi dùng bữa mà còn là nơi gắn kết tình cảm gia đình trong từng khoảnh khắc đời thường.', '8500000.01', NULL, 25, 9, 'published', 0, 0, '2025-07-10 01:42:30', '2025-07-10 01:42:30'),
(59, 'Bàn ăn 8 chỗ Orientale Walnut', 'ban-an-8-cho-orientale-walnut', 'Bàn ăn rộng rãi, thiết kế hiện đại, chất liệu cao cấp – mang đến không gian ấm cúng cho mọi bữa cơm gia đình.', 'Bàn ăn là điểm nhấn trung tâm trong không gian bếp hoặc phòng ăn, nơi các thành viên quây quần bên nhau trong những bữa ăn ấm cúng. Với thiết kế chú trọng tính thẩm mỹ và công năng, bàn ăn được làm từ các chất liệu cao cấp như gỗ tự nhiên, MDF phủ veneer, mặt đá nhân tạo hoặc kính cường lực, mang lại độ bền cao và dễ dàng vệ sinh. Kiểu dáng đa dạng – từ bàn tròn, bàn chữ nhật đến bàn mở rộng – phù hợp với mọi diện tích và phong cách nội thất. Chân bàn chắc chắn, kết cấu vững chãi, đảm bảo sự ổn định và an toàn khi sử dụng. Bàn ăn không chỉ là nơi dùng bữa mà còn là nơi gắn kết tình cảm gia đình trong từng khoảnh khắc đời thường.', '9500000.00', NULL, 25, 8, 'published', 0, 0, '2025-07-10 01:43:33', '2025-07-10 01:43:33'),
(60, 'Bàn ăn ICARO', 'ban-an-icaro', 'Bàn ăn rộng rãi, thiết kế hiện đại, chất liệu cao cấp – mang đến không gian ấm cúng cho mọi bữa cơm gia đình.', 'Bàn ăn là điểm nhấn trung tâm trong không gian bếp hoặc phòng ăn, nơi các thành viên quây quần bên nhau trong những bữa ăn ấm cúng. Với thiết kế chú trọng tính thẩm mỹ và công năng, bàn ăn được làm từ các chất liệu cao cấp như gỗ tự nhiên, MDF phủ veneer, mặt đá nhân tạo hoặc kính cường lực, mang lại độ bền cao và dễ dàng vệ sinh. Kiểu dáng đa dạng – từ bàn tròn, bàn chữ nhật đến bàn mở rộng – phù hợp với mọi diện tích và phong cách nội thất. Chân bàn chắc chắn, kết cấu vững chãi, đảm bảo sự ổn định và an toàn khi sử dụng. Bàn ăn không chỉ là nơi dùng bữa mà còn là nơi gắn kết tình cảm gia đình trong từng khoảnh khắc đời thường.', '8499999.99', NULL, 25, 10, 'published', 0, 0, '2025-07-10 01:44:55', '2025-07-10 01:44:55'),
(61, 'Bàn ăn Cult 6 chỗ', 'ban-an-cult-6-cho', 'Bàn ăn rộng rãi, thiết kế hiện đại, chất liệu cao cấp – mang đến không gian ấm cúng cho mọi bữa cơm gia đình.', 'Bàn ăn là điểm nhấn trung tâm trong không gian bếp hoặc phòng ăn, nơi các thành viên quây quần bên nhau trong những bữa ăn ấm cúng. Với thiết kế chú trọng tính thẩm mỹ và công năng, bàn ăn được làm từ các chất liệu cao cấp như gỗ tự nhiên, MDF phủ veneer, mặt đá nhân tạo hoặc kính cường lực, mang lại độ bền cao và dễ dàng vệ sinh. Kiểu dáng đa dạng – từ bàn tròn, bàn chữ nhật đến bàn mở rộng – phù hợp với mọi diện tích và phong cách nội thất. Chân bàn chắc chắn, kết cấu vững chãi, đảm bảo sự ổn định và an toàn khi sử dụng. Bàn ăn không chỉ là nơi dùng bữa mà còn là nơi gắn kết tình cảm gia đình trong từng khoảnh khắc đời thường.', '6500000.00', NULL, 25, 3, 'published', 0, 0, '2025-07-10 01:46:28', '2025-07-10 01:46:28'),
(62, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', 'ban-an-peak-hien-dai-mat-ceramic-van-may', 'Bàn ăn rộng rãi, thiết kế hiện đại, chất liệu cao cấp – mang đến không gian ấm cúng cho mọi bữa cơm gia đình.', 'Bàn ăn là điểm nhấn trung tâm trong không gian bếp hoặc phòng ăn, nơi các thành viên quây quần bên nhau trong những bữa ăn ấm cúng. Với thiết kế chú trọng tính thẩm mỹ và công năng, bàn ăn được làm từ các chất liệu cao cấp như gỗ tự nhiên, MDF phủ veneer, mặt đá nhân tạo hoặc kính cường lực, mang lại độ bền cao và dễ dàng vệ sinh. Kiểu dáng đa dạng – từ bàn tròn, bàn chữ nhật đến bàn mở rộng – phù hợp với mọi diện tích và phong cách nội thất. Chân bàn chắc chắn, kết cấu vững chãi, đảm bảo sự ổn định và an toàn khi sử dụng. Bàn ăn không chỉ là nơi dùng bữa mà còn là nơi gắn kết tình cảm gia đình trong từng khoảnh khắc đời thường.', '36000000.00', NULL, 25, 9, 'published', 0, 0, '2025-07-10 01:47:33', '2025-07-10 01:47:33'),
(63, 'Bàn ăn Kent FR160', 'ban-an-kent-fr160', 'Bàn ăn rộng rãi, thiết kế hiện đại, chất liệu cao cấp – mang đến không gian ấm cúng cho mọi bữa cơm gia đình.', 'Bàn ăn là điểm nhấn trung tâm trong không gian bếp hoặc phòng ăn, nơi các thành viên quây quần bên nhau trong những bữa ăn ấm cúng. Với thiết kế chú trọng tính thẩm mỹ và công năng, bàn ăn được làm từ các chất liệu cao cấp như gỗ tự nhiên, MDF phủ veneer, mặt đá nhân tạo hoặc kính cường lực, mang lại độ bền cao và dễ dàng vệ sinh. Kiểu dáng đa dạng – từ bàn tròn, bàn chữ nhật đến bàn mở rộng – phù hợp với mọi diện tích và phong cách nội thất. Chân bàn chắc chắn, kết cấu vững chãi, đảm bảo sự ổn định và an toàn khi sử dụng. Bàn ăn không chỉ là nơi dùng bữa mà còn là nơi gắn kết tình cảm gia đình trong từng khoảnh khắc đời thường.', '12000000.00', NULL, 25, 8, 'published', 0, 0, '2025-07-10 01:50:13', '2025-07-10 01:50:13'),
(64, 'Bàn ăn Cartesio ceramic P2C', 'ban-an-cartesio-ceramic-p2c', 'Bàn ăn rộng rãi, thiết kế hiện đại, chất liệu cao cấp – mang đến không gian ấm cúng cho mọi bữa cơm gia đình.', 'Bàn ăn là điểm nhấn trung tâm trong không gian bếp hoặc phòng ăn, nơi các thành viên quây quần bên nhau trong những bữa ăn ấm cúng. Với thiết kế chú trọng tính thẩm mỹ và công năng, bàn ăn được làm từ các chất liệu cao cấp như gỗ tự nhiên, MDF phủ veneer, mặt đá nhân tạo hoặc kính cường lực, mang lại độ bền cao và dễ dàng vệ sinh. Kiểu dáng đa dạng – từ bàn tròn, bàn chữ nhật đến bàn mở rộng – phù hợp với mọi diện tích và phong cách nội thất. Chân bàn chắc chắn, kết cấu vững chãi, đảm bảo sự ổn định và an toàn khi sử dụng. Bàn ăn không chỉ là nơi dùng bữa mà còn là nơi gắn kết tình cảm gia đình trong từng khoảnh khắc đời thường.', '15000000.00', NULL, 25, 10, 'published', 0, 0, '2025-07-10 01:51:16', '2025-07-10 01:51:16'),
(65, 'Bàn ăn Mây 10 chỗ', 'ban-an-may-10-cho', 'Bàn ăn rộng rãi, thiết kế hiện đại, chất liệu cao cấp – mang đến không gian ấm cúng cho mọi bữa cơm gia đình.', 'Bàn ăn là điểm nhấn trung tâm trong không gian bếp hoặc phòng ăn, nơi các thành viên quây quần bên nhau trong những bữa ăn ấm cúng. Với thiết kế chú trọng tính thẩm mỹ và công năng, bàn ăn được làm từ các chất liệu cao cấp như gỗ tự nhiên, MDF phủ veneer, mặt đá nhân tạo hoặc kính cường lực, mang lại độ bền cao và dễ dàng vệ sinh. Kiểu dáng đa dạng – từ bàn tròn, bàn chữ nhật đến bàn mở rộng – phù hợp với mọi diện tích và phong cách nội thất. Chân bàn chắc chắn, kết cấu vững chãi, đảm bảo sự ổn định và an toàn khi sử dụng. Bàn ăn không chỉ là nơi dùng bữa mà còn là nơi gắn kết tình cảm gia đình trong từng khoảnh khắc đời thường.', '11000000.00', NULL, 25, 3, 'published', 0, 0, '2025-07-10 01:52:23', '2025-07-10 01:52:23'),
(66, 'Tủ Tivi Hùng King', 'tu-tivi-hung-king', 'Tủ tivi hiện đại, thiết kế tinh tế, kết hợp lưu trữ tiện lợi và làm nổi bật không gian giải trí.', 'Tủ tivi là món nội thất không thể thiếu trong phòng khách, vừa là nơi đặt tivi vừa giúp sắp xếp không gian sống gọn gàng và thẩm mỹ hơn. Với thiết kế đa dạng từ hiện đại tối giản đến cổ điển sang trọng, tủ tivi thường được làm từ gỗ tự nhiên, MDF phủ melamine, hoặc kết hợp kim loại sơn tĩnh điện, mang đến sự chắc chắn và độ bền cao. Nhiều mẫu có ngăn kéo, hộc tủ hoặc kệ mở giúp lưu trữ đầu thu, loa, điều khiển và các vật dụng trang trí một cách tiện lợi. Kiểu dáng ngang gọn gàng, dễ kết hợp với sofa, bàn nước và các món nội thất khác. Tủ tivi không chỉ là nơi đặt thiết bị điện tử mà còn là điểm nhấn trang trí giúp nâng tầm không gian sống của bạn.', '24000000.00', NULL, 27, 9, 'published', 0, 0, '2025-07-10 02:02:03', '2025-07-10 02:02:03'),
(67, 'Tủ TV mặt đá Ogami', 'tu-tv-mat-da-ogami', 'Tủ tivi hiện đại, thiết kế tinh tế, kết hợp lưu trữ tiện lợi và làm nổi bật không gian giải trí.', 'Tủ tivi là món nội thất không thể thiếu trong phòng khách, vừa là nơi đặt tivi vừa giúp sắp xếp không gian sống gọn gàng và thẩm mỹ hơn. Với thiết kế đa dạng từ hiện đại tối giản đến cổ điển sang trọng, tủ tivi thường được làm từ gỗ tự nhiên, MDF phủ melamine, hoặc kết hợp kim loại sơn tĩnh điện, mang đến sự chắc chắn và độ bền cao. Nhiều mẫu có ngăn kéo, hộc tủ hoặc kệ mở giúp lưu trữ đầu thu, loa, điều khiển và các vật dụng trang trí một cách tiện lợi. Kiểu dáng ngang gọn gàng, dễ kết hợp với sofa, bàn nước và các món nội thất khác. Tủ tivi không chỉ là nơi đặt thiết bị điện tử mà còn là điểm nhấn trang trí giúp nâng tầm không gian sống của bạn.', '15000000.00', NULL, 27, 9, 'published', 0, 0, '2025-07-10 02:02:57', '2025-07-10 02:02:57'),
(68, 'Tủ tivi Valente', 'tu-tivi-valente', 'Tủ tivi hiện đại, thiết kế tinh tế, kết hợp lưu trữ tiện lợi và làm nổi bật không gian giải trí.', 'Tủ tivi là món nội thất không thể thiếu trong phòng khách, vừa là nơi đặt tivi vừa giúp sắp xếp không gian sống gọn gàng và thẩm mỹ hơn. Với thiết kế đa dạng từ hiện đại tối giản đến cổ điển sang trọng, tủ tivi thường được làm từ gỗ tự nhiên, MDF phủ melamine, hoặc kết hợp kim loại sơn tĩnh điện, mang đến sự chắc chắn và độ bền cao. Nhiều mẫu có ngăn kéo, hộc tủ hoặc kệ mở giúp lưu trữ đầu thu, loa, điều khiển và các vật dụng trang trí một cách tiện lợi. Kiểu dáng ngang gọn gàng, dễ kết hợp với sofa, bàn nước và các món nội thất khác. Tủ tivi không chỉ là nơi đặt thiết bị điện tử mà còn là điểm nhấn trang trí giúp nâng tầm không gian sống của bạn.', '16000000.00', NULL, 27, 9, 'published', 0, 0, '2025-07-10 02:03:44', '2025-07-10 02:03:44'),
(69, 'Tủ TV Moretti', 'tu-tv-moretti', 'Tủ tivi hiện đại, thiết kế tinh tế, kết hợp lưu trữ tiện lợi và làm nổi bật không gian giải trí.', 'Tủ tivi là món nội thất không thể thiếu trong phòng khách, vừa là nơi đặt tivi vừa giúp sắp xếp không gian sống gọn gàng và thẩm mỹ hơn. Với thiết kế đa dạng từ hiện đại tối giản đến cổ điển sang trọng, tủ tivi thường được làm từ gỗ tự nhiên, MDF phủ melamine, hoặc kết hợp kim loại sơn tĩnh điện, mang đến sự chắc chắn và độ bền cao. Nhiều mẫu có ngăn kéo, hộc tủ hoặc kệ mở giúp lưu trữ đầu thu, loa, điều khiển và các vật dụng trang trí một cách tiện lợi. Kiểu dáng ngang gọn gàng, dễ kết hợp với sofa, bàn nước và các món nội thất khác. Tủ tivi không chỉ là nơi đặt thiết bị điện tử mà còn là điểm nhấn trang trí giúp nâng tầm không gian sống của bạn.', '35000000.00', NULL, 27, 9, 'published', 0, 0, '2025-07-10 02:04:32', '2025-07-10 02:04:32'),
(70, 'Tủ tivi Elegance', 'tu-tivi-elegance', 'Tủ tivi hiện đại, thiết kế tinh tế, kết hợp lưu trữ tiện lợi và làm nổi bật không gian giải trí.', 'Tủ tivi là món nội thất không thể thiếu trong phòng khách, vừa là nơi đặt tivi vừa giúp sắp xếp không gian sống gọn gàng và thẩm mỹ hơn. Với thiết kế đa dạng từ hiện đại tối giản đến cổ điển sang trọng, tủ tivi thường được làm từ gỗ tự nhiên, MDF phủ melamine, hoặc kết hợp kim loại sơn tĩnh điện, mang đến sự chắc chắn và độ bền cao. Nhiều mẫu có ngăn kéo, hộc tủ hoặc kệ mở giúp lưu trữ đầu thu, loa, điều khiển và các vật dụng trang trí một cách tiện lợi. Kiểu dáng ngang gọn gàng, dễ kết hợp với sofa, bàn nước và các món nội thất khác. Tủ tivi không chỉ là nơi đặt thiết bị điện tử mà còn là điểm nhấn trang trí giúp nâng tầm không gian sống của bạn.', '16000000.00', NULL, 27, 7, 'published', 0, 0, '2025-07-10 02:05:53', '2025-07-10 02:05:53'),
(71, 'Tủ tivi Bridge', 'tu-tivi-bridge', 'Tủ tivi hiện đại, thiết kế tinh tế, kết hợp lưu trữ tiện lợi và làm nổi bật không gian giải trí.', 'Tủ tivi là món nội thất không thể thiếu trong phòng khách, vừa là nơi đặt tivi vừa giúp sắp xếp không gian sống gọn gàng và thẩm mỹ hơn. Với thiết kế đa dạng từ hiện đại tối giản đến cổ điển sang trọng, tủ tivi thường được làm từ gỗ tự nhiên, MDF phủ melamine, hoặc kết hợp kim loại sơn tĩnh điện, mang đến sự chắc chắn và độ bền cao. Nhiều mẫu có ngăn kéo, hộc tủ hoặc kệ mở giúp lưu trữ đầu thu, loa, điều khiển và các vật dụng trang trí một cách tiện lợi. Kiểu dáng ngang gọn gàng, dễ kết hợp với sofa, bàn nước và các món nội thất khác. Tủ tivi không chỉ là nơi đặt thiết bị điện tử mà còn là điểm nhấn trang trí giúp nâng tầm không gian sống của bạn.', '18999999.00', NULL, 27, 3, 'published', 0, 0, '2025-07-10 02:07:28', '2025-07-10 02:07:28'),
(72, 'Tủ Tivi Miami 210004', 'tu-tivi-miami-210004', 'Tủ tivi hiện đại, thiết kế tinh tế, kết hợp lưu trữ tiện lợi và làm nổi bật không gian giải trí.', 'Tủ tivi là món nội thất không thể thiếu trong phòng khách, vừa là nơi đặt tivi vừa giúp sắp xếp không gian sống gọn gàng và thẩm mỹ hơn. Với thiết kế đa dạng từ hiện đại tối giản đến cổ điển sang trọng, tủ tivi thường được làm từ gỗ tự nhiên, MDF phủ melamine, hoặc kết hợp kim loại sơn tĩnh điện, mang đến sự chắc chắn và độ bền cao. Nhiều mẫu có ngăn kéo, hộc tủ hoặc kệ mở giúp lưu trữ đầu thu, loa, điều khiển và các vật dụng trang trí một cách tiện lợi. Kiểu dáng ngang gọn gàng, dễ kết hợp với sofa, bàn nước và các món nội thất khác. Tủ tivi không chỉ là nơi đặt thiết bị điện tử mà còn là điểm nhấn trang trí giúp nâng tầm không gian sống của bạn.', '17300000.00', NULL, 27, 10, 'published', 0, 0, '2025-07-10 02:08:50', '2025-07-10 02:08:50'),
(73, 'Tủ tivi Pio', 'tu-tivi-pio', 'Tủ tivi hiện đại, thiết kế tinh tế, kết hợp lưu trữ tiện lợi và làm nổi bật không gian giải trí.', 'Tủ tivi là món nội thất không thể thiếu trong phòng khách, vừa là nơi đặt tivi vừa giúp sắp xếp không gian sống gọn gàng và thẩm mỹ hơn. Với thiết kế đa dạng từ hiện đại tối giản đến cổ điển sang trọng, tủ tivi thường được làm từ gỗ tự nhiên, MDF phủ melamine, hoặc kết hợp kim loại sơn tĩnh điện, mang đến sự chắc chắn và độ bền cao. Nhiều mẫu có ngăn kéo, hộc tủ hoặc kệ mở giúp lưu trữ đầu thu, loa, điều khiển và các vật dụng trang trí một cách tiện lợi. Kiểu dáng ngang gọn gàng, dễ kết hợp với sofa, bàn nước và các món nội thất khác. Tủ tivi không chỉ là nơi đặt thiết bị điện tử mà còn là điểm nhấn trang trí giúp nâng tầm không gian sống của bạn.', '14000000.00', NULL, 27, 7, 'published', 0, 0, '2025-07-10 02:09:46', '2025-07-10 02:09:46'),
(74, 'Giường Leman 1m8', 'giuong-leman-1m8', 'Giường ngủ thiết kế hiện đại, khung chắc chắn, mang lại cảm giác êm ái và thư giãn tối đa.', 'Giường ngủ là trung tâm của không gian phòng ngủ, nơi bạn nghỉ ngơi sau một ngày dài làm việc. Với thiết kế chú trọng đến sự thoải mái và thẩm mỹ, giường được chế tác từ chất liệu cao cấp như gỗ tự nhiên, MDF phủ melamine, hoặc khung kim loại sơn tĩnh điện, đảm bảo độ bền và chắc chắn. Đệm giường có thể tùy chọn theo nhu cầu, kết hợp với vạt giường chắc khỏe giúp nâng đỡ cơ thể tối ưu. Nhiều mẫu giường tích hợp hộc kéo hoặc ngăn chứa đồ tiện lợi, giúp tối ưu diện tích không gian. Thiết kế đầu giường êm ái, kiểu dáng từ tối giản đến sang trọng phù hợp với nhiều phong cách nội thất. Giường ngủ không chỉ là nơi thư giãn mà còn thể hiện gu thẩm mỹ và cá tính riêng của chủ nhân.', '17000000.00', NULL, 20, 8, 'published', 0, 0, '2025-07-10 02:13:19', '2025-07-10 02:13:19'),
(75, 'Giường Ona Him 1m8', 'giuong-ona-him-1m8', 'Giường ngủ thiết kế hiện đại, khung chắc chắn, mang lại cảm giác êm ái và thư giãn tối đa.', 'Giường ngủ là trung tâm của không gian phòng ngủ, nơi bạn nghỉ ngơi sau một ngày dài làm việc. Với thiết kế chú trọng đến sự thoải mái và thẩm mỹ, giường được chế tác từ chất liệu cao cấp như gỗ tự nhiên, MDF phủ melamine, hoặc khung kim loại sơn tĩnh điện, đảm bảo độ bền và chắc chắn. Đệm giường có thể tùy chọn theo nhu cầu, kết hợp với vạt giường chắc khỏe giúp nâng đỡ cơ thể tối ưu. Nhiều mẫu giường tích hợp hộc kéo hoặc ngăn chứa đồ tiện lợi, giúp tối ưu diện tích không gian. Thiết kế đầu giường êm ái, kiểu dáng từ tối giản đến sang trọng phù hợp với nhiều phong cách nội thất. Giường ngủ không chỉ là nơi thư giãn mà còn thể hiện gu thẩm mỹ và cá tính riêng của chủ nhân.', '19999999.00', NULL, 20, 7, 'published', 0, 0, '2025-07-10 02:14:42', '2025-07-10 02:14:42'),
(76, 'Giường ngủ bọc vải Softly 1m8', 'giuong-ngu-boc-vai-softly-1m8', 'Giường ngủ thiết kế hiện đại, khung chắc chắn, mang lại cảm giác êm ái và thư giãn tối đa.', 'Giường ngủ là trung tâm của không gian phòng ngủ, nơi bạn nghỉ ngơi sau một ngày dài làm việc. Với thiết kế chú trọng đến sự thoải mái và thẩm mỹ, giường được chế tác từ chất liệu cao cấp như gỗ tự nhiên, MDF phủ melamine, hoặc khung kim loại sơn tĩnh điện, đảm bảo độ bền và chắc chắn. Đệm giường có thể tùy chọn theo nhu cầu, kết hợp với vạt giường chắc khỏe giúp nâng đỡ cơ thể tối ưu. Nhiều mẫu giường tích hợp hộc kéo hoặc ngăn chứa đồ tiện lợi, giúp tối ưu diện tích không gian. Thiết kế đầu giường êm ái, kiểu dáng từ tối giản đến sang trọng phù hợp với nhiều phong cách nội thất. Giường ngủ không chỉ là nơi thư giãn mà còn thể hiện gu thẩm mỹ và cá tính riêng của chủ nhân.', '26000000.00', NULL, 20, 9, 'published', 0, 0, '2025-07-10 02:17:05', '2025-07-31 15:12:34'),
(77, 'Giường ngủ Wynn 1m8', 'giuong-ngu-wynn-1m8', 'Giường ngủ thiết kế hiện đại, khung chắc chắn, mang lại cảm giác êm ái và thư giãn tối đa.', 'Giường ngủ là trung tâm của không gian phòng ngủ, nơi bạn nghỉ ngơi sau một ngày dài làm việc. Với thiết kế chú trọng đến sự thoải mái và thẩm mỹ, giường được chế tác từ chất liệu cao cấp như gỗ tự nhiên, MDF phủ melamine, hoặc khung kim loại sơn tĩnh điện, đảm bảo độ bền và chắc chắn. Đệm giường có thể tùy chọn theo nhu cầu, kết hợp với vạt giường chắc khỏe giúp nâng đỡ cơ thể tối ưu. Nhiều mẫu giường tích hợp hộc kéo hoặc ngăn chứa đồ tiện lợi, giúp tối ưu diện tích không gian. Thiết kế đầu giường êm ái, kiểu dáng từ tối giản đến sang trọng phù hợp với nhiều phong cách nội thất. Giường ngủ không chỉ là nơi thư giãn mà còn thể hiện gu thẩm mỹ và cá tính riêng của chủ nhân.', '32000000.00', NULL, 20, 8, 'published', 0, 0, '2025-07-10 02:18:23', '2025-07-10 02:18:23'),
(79, 'NGUYEN4', 'nguyen4', 'shftghdrgs', 'shftghdrgsshftghdrgsshftghdrgsshftghdrgsshftghdrgs', '26000000.00', NULL, 24, 7, 'published', 0, 0, '2025-08-19 14:35:38', '2025-08-19 14:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_thumbnail` tinyint(1) NOT NULL DEFAULT '0',
  `order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_url`, `alt_text`, `is_thumbnail`, `order`, `created_at`, `updated_at`) VALUES
(21, 21, 'images/products/686e712072fdc_1752068384.jxl', NULL, 0, 0, '2025-07-09 06:39:44', '2025-07-09 06:39:44'),
(22, 21, 'images/products/686e712075466_1752068384.jpg', NULL, 0, 0, '2025-07-09 06:39:44', '2025-07-09 06:39:44'),
(23, 21, 'images/products/686e7120765ec_1752068384.jpg', NULL, 0, 0, '2025-07-09 06:39:44', '2025-07-09 06:39:44'),
(24, 21, 'images/products/686e712077651_1752068384.jpg', NULL, 0, 0, '2025-07-09 06:39:44', '2025-07-09 06:39:44'),
(25, 21, 'images/products/686e712078637_1752068384.jxl', NULL, 0, 0, '2025-07-09 06:39:44', '2025-07-09 06:39:44'),
(26, 22, 'images/products/686e7203e5808_1752068611.jpg', NULL, 0, 0, '2025-07-09 06:43:31', '2025-07-09 06:43:31'),
(27, 22, 'images/products/686e7203e76cd_1752068611.jpg', NULL, 0, 0, '2025-07-09 06:43:31', '2025-07-09 06:43:31'),
(28, 22, 'images/products/686e7203e8a41_1752068611.jpg', NULL, 0, 0, '2025-07-09 06:43:31', '2025-07-09 06:43:31'),
(29, 22, 'images/products/686e7203e9851_1752068611.jpg', NULL, 0, 0, '2025-07-09 06:43:31', '2025-07-09 06:43:31'),
(30, 22, 'images/products/686e7203ea6bf_1752068611.jpg', NULL, 0, 0, '2025-07-09 06:43:31', '2025-07-09 06:43:31'),
(31, 22, 'images/products/686e7203edc1a_1752068611.jpg', NULL, 0, 0, '2025-07-09 06:43:31', '2025-07-09 06:43:31'),
(32, 23, 'images/products/686f12127b7de_1752109586.jpg', NULL, 0, 0, '2025-07-09 18:06:26', '2025-07-09 18:06:26'),
(33, 23, 'images/products/686f12127d04c_1752109586.jpg', NULL, 0, 0, '2025-07-09 18:06:26', '2025-07-09 18:06:26'),
(34, 23, 'images/products/686f12127dfb2_1752109586.jpg', NULL, 0, 0, '2025-07-09 18:06:26', '2025-07-09 18:06:26'),
(35, 23, 'images/products/686f12127eb44_1752109586.jpg', NULL, 0, 0, '2025-07-09 18:06:26', '2025-07-09 18:06:26'),
(36, 24, 'images/products/686f125844cd2_1752109656.jpg', NULL, 0, 0, '2025-07-09 18:07:36', '2025-07-09 18:07:36'),
(37, 24, 'images/products/686f125845c4e_1752109656.jpg', NULL, 0, 0, '2025-07-09 18:07:36', '2025-07-09 18:07:36'),
(38, 24, 'images/products/686f125846711_1752109656.jpg', NULL, 0, 0, '2025-07-09 18:07:36', '2025-07-09 18:07:36'),
(39, 24, 'images/products/686f125846e83_1752109656.jpg', NULL, 0, 0, '2025-07-09 18:07:36', '2025-07-09 18:07:36'),
(40, 24, 'images/products/686f12584781e_1752109656.jpg', NULL, 0, 0, '2025-07-09 18:07:36', '2025-07-09 18:07:36'),
(41, 25, 'images/products/686f135c13a1a_1752109916.jpg', NULL, 0, 0, '2025-07-09 18:11:56', '2025-07-09 18:11:56'),
(42, 25, 'images/products/686f135c14da0_1752109916.jpg', NULL, 0, 0, '2025-07-09 18:11:56', '2025-07-09 18:11:56'),
(43, 25, 'images/products/686f135c15774_1752109916.jpg', NULL, 0, 0, '2025-07-09 18:11:56', '2025-07-09 18:11:56'),
(44, 25, 'images/products/686f135c1601d_1752109916.jpg', NULL, 0, 0, '2025-07-09 18:11:56', '2025-07-09 18:11:56'),
(45, 25, 'images/products/686f135c16a81_1752109916.jpg', NULL, 0, 0, '2025-07-09 18:11:56', '2025-07-09 18:11:56'),
(46, 25, 'images/products/686f135c1732a_1752109916.jpg', NULL, 0, 0, '2025-07-09 18:11:56', '2025-07-09 18:11:56'),
(47, 25, 'images/products/686f135c193fd_1752109916.jpg', NULL, 0, 0, '2025-07-09 18:11:56', '2025-07-09 18:11:56'),
(48, 26, 'images/products/686f14286721c_1752110120.jpg', NULL, 0, 0, '2025-07-09 18:15:20', '2025-07-09 18:15:20'),
(49, 26, 'images/products/686f1428683c8_1752110120.jpg', NULL, 0, 0, '2025-07-09 18:15:20', '2025-07-09 18:15:20'),
(50, 26, 'images/products/686f142868e24_1752110120.jpg', NULL, 0, 0, '2025-07-09 18:15:20', '2025-07-09 18:15:20'),
(51, 26, 'images/products/686f1428696df_1752110120.jpg', NULL, 0, 0, '2025-07-09 18:15:20', '2025-07-09 18:15:20'),
(52, 26, 'images/products/686f14286a130_1752110120.jpg', NULL, 0, 0, '2025-07-09 18:15:20', '2025-07-09 18:15:20'),
(53, 26, 'images/products/686f14286abf4_1752110120.jpg', NULL, 0, 0, '2025-07-09 18:15:20', '2025-07-09 18:15:20'),
(54, 26, 'images/products/686f14286c84e_1752110120.jpg', NULL, 0, 0, '2025-07-09 18:15:20', '2025-07-09 18:15:20'),
(55, 26, 'images/products/686f14286d9bc_1752110120.jpg', NULL, 0, 0, '2025-07-09 18:15:20', '2025-07-09 18:15:20'),
(56, 27, 'images/products/686f14f1c98b3_1752110321.jpg', NULL, 0, 0, '2025-07-09 18:18:41', '2025-07-09 18:18:41'),
(57, 27, 'images/products/686f14f1caba0_1752110321.jpg', NULL, 0, 0, '2025-07-09 18:18:41', '2025-07-09 18:18:41'),
(58, 27, 'images/products/686f14f1cb5ae_1752110321.jpg', NULL, 0, 0, '2025-07-09 18:18:41', '2025-07-09 18:18:41'),
(59, 27, 'images/products/686f14f1cbd77_1752110321.jpg', NULL, 0, 0, '2025-07-09 18:18:41', '2025-07-09 18:18:41'),
(60, 27, 'images/products/686f14f1cc650_1752110321.jpg', NULL, 0, 0, '2025-07-09 18:18:41', '2025-07-09 18:18:41'),
(61, 28, 'images/products/686f16446712f_1752110660.jpg', NULL, 0, 0, '2025-07-09 18:24:20', '2025-07-09 18:24:20'),
(62, 28, 'images/products/686f16446826d_1752110660.jpg', NULL, 0, 0, '2025-07-09 18:24:20', '2025-07-09 18:24:20'),
(63, 28, 'images/products/686f164468c60_1752110660.jpg', NULL, 0, 0, '2025-07-09 18:24:20', '2025-07-09 18:24:20'),
(64, 28, 'images/products/686f164469685_1752110660.jpg', NULL, 0, 0, '2025-07-09 18:24:20', '2025-07-09 18:24:20'),
(65, 28, 'images/products/686f16446b075_1752110660.jpg', NULL, 0, 0, '2025-07-09 18:24:20', '2025-07-09 18:24:20'),
(66, 29, 'images/products/686f16d1b6042_1752110801.jpg', NULL, 0, 0, '2025-07-09 18:26:41', '2025-07-09 18:26:41'),
(67, 29, 'images/products/686f16d1b6f5f_1752110801.jpg', NULL, 0, 0, '2025-07-09 18:26:41', '2025-07-09 18:26:41'),
(68, 29, 'images/products/686f16d1b7912_1752110801.jpg', NULL, 0, 0, '2025-07-09 18:26:41', '2025-07-09 18:26:41'),
(69, 29, 'images/products/686f16d1b81b9_1752110801.jpg', NULL, 0, 0, '2025-07-09 18:26:41', '2025-07-09 18:26:41'),
(70, 29, 'images/products/686f16d1b8b90_1752110801.jpg', NULL, 0, 0, '2025-07-09 18:26:41', '2025-07-09 18:26:41'),
(71, 29, 'images/products/686f16d1ba39e_1752110801.jpg', NULL, 0, 0, '2025-07-09 18:26:41', '2025-07-09 18:26:41'),
(72, 30, 'images/products/686f187a3c82a_1752111226.jpg', NULL, 0, 0, '2025-07-09 18:33:46', '2025-07-09 18:33:46'),
(73, 30, 'images/products/686f187a3d884_1752111226.jpg', NULL, 0, 0, '2025-07-09 18:33:46', '2025-07-09 18:33:46'),
(74, 30, 'images/products/686f187a3e2bd_1752111226.jpg', NULL, 0, 0, '2025-07-09 18:33:46', '2025-07-09 18:33:46'),
(75, 30, 'images/products/686f187a3ec41_1752111226.jpg', NULL, 0, 0, '2025-07-09 18:33:46', '2025-07-09 18:33:46'),
(76, 30, 'images/products/686f187a3f40d_1752111226.jpg', NULL, 0, 0, '2025-07-09 18:33:46', '2025-07-09 18:33:46'),
(77, 30, 'images/products/686f187a3fcb9_1752111226.jpg', NULL, 0, 0, '2025-07-09 18:33:46', '2025-07-09 18:33:46'),
(78, 30, 'images/products/686f187a40579_1752111226.jpg', NULL, 0, 0, '2025-07-09 18:33:46', '2025-07-09 18:33:46'),
(79, 30, 'images/products/686f187a40de2_1752111226.jpg', NULL, 0, 0, '2025-07-09 18:33:46', '2025-07-09 18:33:46'),
(80, 30, 'images/products/686f187a426f2_1752111226.jpg', NULL, 0, 0, '2025-07-09 18:33:46', '2025-07-09 18:33:46'),
(81, 30, 'images/products/686f187a436fc_1752111226.jpg', NULL, 0, 0, '2025-07-09 18:33:46', '2025-07-09 18:33:46'),
(82, 30, 'images/products/686f187a4481f_1752111226.jpg', NULL, 0, 0, '2025-07-09 18:33:46', '2025-07-09 18:33:46'),
(83, 31, 'images/products/686f28002542c_1752115200.jpg', NULL, 0, 0, '2025-07-09 19:40:00', '2025-07-09 19:40:00'),
(84, 31, 'images/products/686f28002682a_1752115200.jpg', NULL, 0, 0, '2025-07-09 19:40:00', '2025-07-09 19:40:00'),
(85, 31, 'images/products/686f2800272cc_1752115200.jpg', NULL, 0, 0, '2025-07-09 19:40:00', '2025-07-09 19:40:00'),
(86, 31, 'images/products/686f280027d7d_1752115200.jpg', NULL, 0, 0, '2025-07-09 19:40:00', '2025-07-09 19:40:00'),
(87, 31, 'images/products/686f28002a011_1752115200.jpg', NULL, 0, 0, '2025-07-09 19:40:00', '2025-07-09 19:40:00'),
(88, 31, 'images/products/686f28002b18e_1752115200.jpg', NULL, 0, 0, '2025-07-09 19:40:00', '2025-07-09 19:40:00'),
(89, 31, 'images/products/686f28002c96a_1752115200.jpg', NULL, 0, 0, '2025-07-09 19:40:00', '2025-07-09 19:40:00'),
(90, 32, 'images/products/686f28b640469_1752115382.jpg', NULL, 0, 0, '2025-07-09 19:43:02', '2025-07-09 19:43:02'),
(91, 32, 'images/products/686f28b641bc5_1752115382.jpg', NULL, 0, 0, '2025-07-09 19:43:02', '2025-07-09 19:43:02'),
(92, 32, 'images/products/686f28b64288a_1752115382.jpg', NULL, 0, 0, '2025-07-09 19:43:02', '2025-07-09 19:43:02'),
(93, 32, 'images/products/686f28b64331a_1752115382.jpg', NULL, 0, 0, '2025-07-09 19:43:02', '2025-07-09 19:43:02'),
(94, 32, 'images/products/686f28b643f9f_1752115382.jpg', NULL, 0, 0, '2025-07-09 19:43:02', '2025-07-09 19:43:02'),
(95, 32, 'images/products/686f28b646d32_1752115382.jpg', NULL, 0, 0, '2025-07-09 19:43:02', '2025-07-09 19:43:02'),
(96, 32, 'images/products/686f28b6489b6_1752115382.jpg', NULL, 0, 0, '2025-07-09 19:43:02', '2025-07-09 19:43:02'),
(97, 32, 'images/products/686f28b64a1e3_1752115382.jpg', NULL, 0, 0, '2025-07-09 19:43:02', '2025-07-09 19:43:02'),
(98, 32, 'images/products/686f28b64b8b2_1752115382.jpg', NULL, 0, 0, '2025-07-09 19:43:02', '2025-07-09 19:43:02'),
(99, 32, 'images/products/686f28b64d85a_1752115382.jpg', NULL, 0, 0, '2025-07-09 19:43:02', '2025-07-09 19:43:02'),
(100, 33, 'images/products/686f293cb2013_1752115516.jpg', NULL, 0, 0, '2025-07-09 19:45:16', '2025-07-09 19:45:16'),
(101, 33, 'images/products/686f293cb3730_1752115516.jpg', NULL, 0, 0, '2025-07-09 19:45:16', '2025-07-09 19:45:16'),
(102, 33, 'images/products/686f293cb4399_1752115516.jpg', NULL, 0, 0, '2025-07-09 19:45:16', '2025-07-09 19:45:16'),
(103, 33, 'images/products/686f293cb51fd_1752115516.jpg', NULL, 0, 0, '2025-07-09 19:45:16', '2025-07-09 19:45:16'),
(104, 33, 'images/products/686f293cb5d12_1752115516.jpg', NULL, 0, 0, '2025-07-09 19:45:16', '2025-07-09 19:45:16'),
(105, 33, 'images/products/686f293cb6645_1752115516.jpg', NULL, 0, 0, '2025-07-09 19:45:16', '2025-07-09 19:45:16'),
(106, 33, 'images/products/686f293cb8a6b_1752115516.jpg', NULL, 0, 0, '2025-07-09 19:45:16', '2025-07-09 19:45:16'),
(107, 34, 'images/products/686f2aef4008f_1752115951.jpg', NULL, 0, 0, '2025-07-09 19:52:31', '2025-07-09 19:52:31'),
(108, 34, 'images/products/686f2aef41713_1752115951.jpg', NULL, 0, 0, '2025-07-09 19:52:31', '2025-07-09 19:52:31'),
(109, 34, 'images/products/686f2aef46925_1752115951.jpg', NULL, 0, 0, '2025-07-09 19:52:31', '2025-07-09 19:52:31'),
(110, 34, 'images/products/686f2aef488e6_1752115951.jpg', NULL, 0, 0, '2025-07-09 19:52:31', '2025-07-09 19:52:31'),
(111, 35, 'images/products/686f2bde58e87_1752116190.jpg', NULL, 0, 0, '2025-07-09 19:56:30', '2025-07-09 19:56:30'),
(112, 35, 'images/products/686f2bde5a1d0_1752116190.jpg', NULL, 0, 0, '2025-07-09 19:56:30', '2025-07-09 19:56:30'),
(113, 35, 'images/products/686f2bde5c39c_1752116190.jpg', NULL, 0, 0, '2025-07-09 19:56:30', '2025-07-09 19:56:30'),
(114, 35, 'images/products/686f2bde5d7fa_1752116190.jpg', NULL, 0, 0, '2025-07-09 19:56:30', '2025-07-09 19:56:30'),
(115, 35, 'images/products/686f2bde5eb39_1752116190.jpg', NULL, 0, 0, '2025-07-09 19:56:30', '2025-07-09 19:56:30'),
(116, 36, 'images/products/686f2cacaa0ba_1752116396.jpg', NULL, 0, 0, '2025-07-09 19:59:56', '2025-07-09 19:59:56'),
(117, 36, 'images/products/686f2cacab5c6_1752116396.jpg', NULL, 0, 0, '2025-07-09 19:59:56', '2025-07-09 19:59:56'),
(118, 36, 'images/products/686f2cacac229_1752116396.jpg', NULL, 0, 0, '2025-07-09 19:59:56', '2025-07-09 19:59:56'),
(119, 36, 'images/products/686f2cacacb60_1752116396.jpg', NULL, 0, 0, '2025-07-09 19:59:56', '2025-07-09 19:59:56'),
(120, 36, 'images/products/686f2cacad448_1752116396.jpg', NULL, 0, 0, '2025-07-09 19:59:56', '2025-07-09 19:59:56'),
(121, 36, 'images/products/686f2cacadc13_1752116396.jpg', NULL, 0, 0, '2025-07-09 19:59:56', '2025-07-09 19:59:56'),
(122, 36, 'images/products/686f2cacae5a9_1752116396.jpg', NULL, 0, 0, '2025-07-09 19:59:56', '2025-07-09 19:59:56'),
(123, 36, 'images/products/686f2cacaf162_1752116396.jpg', NULL, 0, 0, '2025-07-09 19:59:56', '2025-07-09 19:59:56'),
(124, 36, 'images/products/686f2cacb0f10_1752116396.jpg', NULL, 0, 0, '2025-07-09 19:59:56', '2025-07-09 19:59:56'),
(125, 37, 'images/products/686f711a2cec1_1752133914.jpg', NULL, 0, 0, '2025-07-10 00:51:54', '2025-07-10 00:51:54'),
(126, 37, 'images/products/686f711a2e21b_1752133914.jpg', NULL, 0, 0, '2025-07-10 00:51:54', '2025-07-10 00:51:54'),
(127, 37, 'images/products/686f711a3002d_1752133914.jpg', NULL, 0, 0, '2025-07-10 00:51:54', '2025-07-10 00:51:54'),
(128, 37, 'images/products/686f711a30e1d_1752133914.jpg', NULL, 0, 0, '2025-07-10 00:51:54', '2025-07-10 00:51:54'),
(129, 37, 'images/products/686f711a31cf9_1752133914.jpg', NULL, 0, 0, '2025-07-10 00:51:54', '2025-07-10 00:51:54'),
(130, 37, 'images/products/686f711a32c1f_1752133914.jpg', NULL, 0, 0, '2025-07-10 00:51:54', '2025-07-10 00:51:54'),
(131, 38, 'images/products/686f724f86c9e_1752134223.jpg', NULL, 0, 0, '2025-07-10 00:57:03', '2025-07-10 00:57:03'),
(132, 38, 'images/products/686f724f882b8_1752134223.jpg', NULL, 0, 0, '2025-07-10 00:57:03', '2025-07-10 00:57:03'),
(133, 38, 'images/products/686f724f88b2a_1752134223.jpg', NULL, 0, 0, '2025-07-10 00:57:03', '2025-07-10 00:57:03'),
(134, 38, 'images/products/686f724f8a893_1752134223.jpg', NULL, 0, 0, '2025-07-10 00:57:03', '2025-07-10 00:57:03'),
(135, 38, 'images/products/686f724f8bb97_1752134223.jpg', NULL, 0, 0, '2025-07-10 00:57:03', '2025-07-10 00:57:03'),
(136, 38, 'images/products/686f724f8c94d_1752134223.jpg', NULL, 0, 0, '2025-07-10 00:57:03', '2025-07-10 00:57:03'),
(137, 38, 'images/products/686f724f8dc5b_1752134223.jpg', NULL, 0, 0, '2025-07-10 00:57:03', '2025-07-10 00:57:03'),
(138, 38, 'images/products/686f724f8ee6c_1752134223.jpg', NULL, 0, 0, '2025-07-10 00:57:03', '2025-07-10 00:57:03'),
(139, 38, 'images/products/686f724f9000e_1752134223.jpg', NULL, 0, 0, '2025-07-10 00:57:03', '2025-07-10 00:57:03'),
(140, 39, 'images/products/686f72a2beac9_1752134306.jpg', NULL, 0, 0, '2025-07-10 00:58:26', '2025-07-10 00:58:26'),
(141, 39, 'images/products/686f72a2bf8a3_1752134306.jpg', NULL, 0, 0, '2025-07-10 00:58:26', '2025-07-10 00:58:26'),
(142, 39, 'images/products/686f72a2c020f_1752134306.jpg', NULL, 0, 0, '2025-07-10 00:58:26', '2025-07-10 00:58:26'),
(143, 39, 'images/products/686f72a2c0892_1752134306.jpg', NULL, 0, 0, '2025-07-10 00:58:26', '2025-07-10 00:58:26'),
(144, 39, 'images/products/686f72a2c0eb6_1752134306.jpg', NULL, 0, 0, '2025-07-10 00:58:26', '2025-07-10 00:58:26'),
(145, 40, 'images/products/686f72f09882e_1752134384.jpg', NULL, 0, 0, '2025-07-10 00:59:44', '2025-07-10 00:59:44'),
(146, 40, 'images/products/686f72f09972b_1752134384.jpg', NULL, 0, 0, '2025-07-10 00:59:44', '2025-07-10 00:59:44'),
(147, 40, 'images/products/686f72f09a06b_1752134384.jpg', NULL, 0, 0, '2025-07-10 00:59:44', '2025-07-10 00:59:44'),
(148, 40, 'images/products/686f72f09a9ea_1752134384.jpg', NULL, 0, 0, '2025-07-10 00:59:44', '2025-07-10 00:59:44'),
(149, 40, 'images/products/686f72f09b14b_1752134384.jpg', NULL, 0, 0, '2025-07-10 00:59:44', '2025-07-10 00:59:44'),
(150, 41, 'images/products/686f732d4d42c_1752134445.jpg', NULL, 0, 0, '2025-07-10 01:00:45', '2025-07-10 01:00:45'),
(151, 41, 'images/products/686f732d4e1fa_1752134445.jpg', NULL, 0, 0, '2025-07-10 01:00:45', '2025-07-10 01:00:45'),
(152, 41, 'images/products/686f732d4e966_1752134445.jpg', NULL, 0, 0, '2025-07-10 01:00:45', '2025-07-10 01:00:45'),
(153, 41, 'images/products/686f732d4f0a1_1752134445.jpg', NULL, 0, 0, '2025-07-10 01:00:45', '2025-07-10 01:00:45'),
(154, 41, 'images/products/686f732d4fb10_1752134445.jpg', NULL, 0, 0, '2025-07-10 01:00:45', '2025-07-10 01:00:45'),
(155, 42, 'images/products/686f73af6be5d_1752134575.jpg', NULL, 0, 0, '2025-07-10 01:02:55', '2025-07-10 01:02:55'),
(156, 42, 'images/products/686f73af6d0b8_1752134575.jpg', NULL, 0, 0, '2025-07-10 01:02:55', '2025-07-10 01:02:55'),
(157, 42, 'images/products/686f73af6d98b_1752134575.jpg', NULL, 0, 0, '2025-07-10 01:02:55', '2025-07-10 01:02:55'),
(158, 42, 'images/products/686f73af6e27f_1752134575.jpg', NULL, 0, 0, '2025-07-10 01:02:55', '2025-07-10 01:02:55'),
(159, 42, 'images/products/686f73af6ecb3_1752134575.jpg', NULL, 0, 0, '2025-07-10 01:02:55', '2025-07-10 01:02:55'),
(160, 42, 'images/products/686f73af6f478_1752134575.jpg', NULL, 0, 0, '2025-07-10 01:02:55', '2025-07-10 01:02:55'),
(161, 43, 'images/products/686f74dbeb13f_1752134875.jpg', NULL, 0, 0, '2025-07-10 01:07:55', '2025-07-10 01:07:55'),
(162, 43, 'images/products/686f74dbebf26_1752134875.jpg', NULL, 0, 0, '2025-07-10 01:07:55', '2025-07-10 01:07:55'),
(163, 43, 'images/products/686f74dbec7ab_1752134875.jpg', NULL, 0, 0, '2025-07-10 01:07:55', '2025-07-10 01:07:55'),
(164, 43, 'images/products/686f74dbed078_1752134875.jpg', NULL, 0, 0, '2025-07-10 01:07:55', '2025-07-10 01:07:55'),
(165, 43, 'images/products/686f74dbed976_1752134875.jpg', NULL, 0, 0, '2025-07-10 01:07:55', '2025-07-10 01:07:55'),
(166, 43, 'images/products/686f74dbee0a7_1752134875.jpg', NULL, 0, 0, '2025-07-10 01:07:55', '2025-07-10 01:07:55'),
(167, 43, 'images/products/686f74dbee7da_1752134875.jpg', NULL, 0, 0, '2025-07-10 01:07:55', '2025-07-10 01:07:55'),
(168, 44, 'images/products/686f7518b037f_1752134936.jpg', NULL, 0, 0, '2025-07-10 01:08:56', '2025-07-10 01:08:56'),
(169, 44, 'images/products/686f7518b1363_1752134936.jpg', NULL, 0, 0, '2025-07-10 01:08:56', '2025-07-10 01:08:56'),
(170, 44, 'images/products/686f7518b1c6c_1752134936.jpg', NULL, 0, 0, '2025-07-10 01:08:56', '2025-07-10 01:08:56'),
(171, 44, 'images/products/686f7518b2655_1752134936.jpg', NULL, 0, 0, '2025-07-10 01:08:56', '2025-07-10 01:08:56'),
(172, 44, 'images/products/686f7518b2d3f_1752134936.jpg', NULL, 0, 0, '2025-07-10 01:08:56', '2025-07-10 01:08:56'),
(173, 45, 'images/products/686f7558e2b3e_1752135000.jpg', NULL, 0, 0, '2025-07-10 01:10:00', '2025-07-10 01:10:00'),
(174, 45, 'images/products/686f7558e3b55_1752135000.jpg', NULL, 0, 0, '2025-07-10 01:10:00', '2025-07-10 01:10:00'),
(175, 45, 'images/products/686f7558e4282_1752135000.jpg', NULL, 0, 0, '2025-07-10 01:10:00', '2025-07-10 01:10:00'),
(176, 45, 'images/products/686f7558e4a81_1752135000.jpg', NULL, 0, 0, '2025-07-10 01:10:00', '2025-07-10 01:10:00'),
(177, 46, 'images/products/686f759d71db5_1752135069.jpg', NULL, 0, 0, '2025-07-10 01:11:09', '2025-07-10 01:11:09'),
(178, 46, 'images/products/686f759d72c87_1752135069.jpg', NULL, 0, 0, '2025-07-10 01:11:09', '2025-07-10 01:11:09'),
(179, 46, 'images/products/686f759d733d0_1752135069.jpg', NULL, 0, 0, '2025-07-10 01:11:09', '2025-07-10 01:11:09'),
(180, 46, 'images/products/686f759d73b42_1752135069.jpg', NULL, 0, 0, '2025-07-10 01:11:09', '2025-07-10 01:11:09'),
(181, 46, 'images/products/686f759d74317_1752135069.jpg', NULL, 0, 0, '2025-07-10 01:11:09', '2025-07-10 01:11:09'),
(182, 46, 'images/products/686f759d74955_1752135069.jpg', NULL, 0, 0, '2025-07-10 01:11:09', '2025-07-10 01:11:09'),
(183, 47, 'images/products/686f7612d3c73_1752135186.jpg', NULL, 0, 0, '2025-07-10 01:13:06', '2025-07-10 01:13:06'),
(184, 47, 'images/products/686f7612d4e5f_1752135186.jpg', NULL, 0, 0, '2025-07-10 01:13:06', '2025-07-10 01:13:06'),
(185, 47, 'images/products/686f7612d5866_1752135186.jpg', NULL, 0, 0, '2025-07-10 01:13:06', '2025-07-10 01:13:06'),
(186, 47, 'images/products/686f7612d60b4_1752135186.jpg', NULL, 0, 0, '2025-07-10 01:13:06', '2025-07-10 01:13:06'),
(187, 48, 'images/products/686f76673a5cc_1752135271.jpg', NULL, 0, 0, '2025-07-10 01:14:31', '2025-07-10 01:14:31'),
(188, 48, 'images/products/686f76673b6ed_1752135271.jpg', NULL, 0, 0, '2025-07-10 01:14:31', '2025-07-10 01:14:31'),
(189, 48, 'images/products/686f76673bffb_1752135271.jpg', NULL, 0, 0, '2025-07-10 01:14:31', '2025-07-10 01:14:31'),
(190, 48, 'images/products/686f76673c70c_1752135271.jpg', NULL, 0, 0, '2025-07-10 01:14:31', '2025-07-10 01:14:31'),
(191, 48, 'images/products/686f76673ce66_1752135271.jpg', NULL, 0, 0, '2025-07-10 01:14:31', '2025-07-10 01:14:31'),
(192, 49, 'images/products/686f769fb88ba_1752135327.jpg', NULL, 0, 0, '2025-07-10 01:15:27', '2025-07-10 01:15:27'),
(193, 49, 'images/products/686f769fb9a8d_1752135327.jpg', NULL, 0, 0, '2025-07-10 01:15:27', '2025-07-10 01:15:27'),
(194, 49, 'images/products/686f769fba71a_1752135327.jpg', NULL, 0, 0, '2025-07-10 01:15:27', '2025-07-10 01:15:27'),
(195, 50, 'images/products/686f76fb2329e_1752135419.jpg', NULL, 0, 0, '2025-07-10 01:16:59', '2025-07-10 01:16:59'),
(196, 50, 'images/products/686f76fb2410d_1752135419.jpg', NULL, 0, 0, '2025-07-10 01:16:59', '2025-07-10 01:16:59'),
(197, 50, 'images/products/686f76fb24a59_1752135419.jpg', NULL, 0, 0, '2025-07-10 01:16:59', '2025-07-10 01:16:59'),
(198, 50, 'images/products/686f76fb25223_1752135419.jpg', NULL, 0, 0, '2025-07-10 01:16:59', '2025-07-10 01:16:59'),
(199, 51, 'images/products/686f77b7a864f_1752135607.jpg', NULL, 0, 0, '2025-07-10 01:20:07', '2025-07-10 01:20:07'),
(200, 51, 'images/products/686f77b7a984b_1752135607.jpg', NULL, 0, 0, '2025-07-10 01:20:07', '2025-07-10 01:20:07'),
(201, 51, 'images/products/686f77b7aa067_1752135607.jpg', NULL, 0, 0, '2025-07-10 01:20:07', '2025-07-10 01:20:07'),
(202, 51, 'images/products/686f77b7aa7e5_1752135607.jpg', NULL, 0, 0, '2025-07-10 01:20:07', '2025-07-10 01:20:07'),
(203, 51, 'images/products/686f77b7ac061_1752135607.jpg', NULL, 0, 0, '2025-07-10 01:20:07', '2025-07-10 01:20:07'),
(204, 52, 'images/products/686f7804438b7_1752135684.jpg', NULL, 0, 0, '2025-07-10 01:21:24', '2025-07-10 01:21:24'),
(205, 52, 'images/products/686f780444847_1752135684.jpg', NULL, 0, 0, '2025-07-10 01:21:24', '2025-07-10 01:21:24'),
(206, 52, 'images/products/686f780445121_1752135684.jpg', NULL, 0, 0, '2025-07-10 01:21:24', '2025-07-10 01:21:24'),
(207, 52, 'images/products/686f7804468a1_1752135684.jpg', NULL, 0, 0, '2025-07-10 01:21:24', '2025-07-10 01:21:24'),
(208, 53, 'images/products/686f78cf01de1_1752135887.jpg', NULL, 0, 0, '2025-07-10 01:24:47', '2025-07-10 01:24:47'),
(209, 53, 'images/products/686f78cf02c2f_1752135887.jpg', NULL, 0, 0, '2025-07-10 01:24:47', '2025-07-10 01:24:47'),
(210, 53, 'images/products/686f78cf03390_1752135887.jpg', NULL, 0, 0, '2025-07-10 01:24:47', '2025-07-10 01:24:47'),
(211, 53, 'images/products/686f78cf03bae_1752135887.jpg', NULL, 0, 0, '2025-07-10 01:24:47', '2025-07-10 01:24:47'),
(212, 53, 'images/products/686f78cf0442c_1752135887.jpg', NULL, 0, 0, '2025-07-10 01:24:47', '2025-07-10 01:24:47'),
(213, 53, 'images/products/686f78cf05f95_1752135887.jpg', NULL, 0, 0, '2025-07-10 01:24:47', '2025-07-10 01:24:47'),
(214, 53, 'images/products/686f78cf06d70_1752135887.jpg', NULL, 0, 0, '2025-07-10 01:24:47', '2025-07-10 01:24:47'),
(215, 54, 'images/products/686f792985c0c_1752135977.jpg', NULL, 0, 0, '2025-07-10 01:26:17', '2025-07-10 01:26:17'),
(216, 54, 'images/products/686f792986bf9_1752135977.jpg', NULL, 0, 0, '2025-07-10 01:26:17', '2025-07-10 01:26:17'),
(217, 54, 'images/products/686f7929872ba_1752135977.jpg', NULL, 0, 0, '2025-07-10 01:26:17', '2025-07-10 01:26:17'),
(218, 54, 'images/products/686f7929879d1_1752135977.jpg', NULL, 0, 0, '2025-07-10 01:26:17', '2025-07-10 01:26:17'),
(219, 54, 'images/products/686f7929891af_1752135977.jpg', NULL, 0, 0, '2025-07-10 01:26:17', '2025-07-10 01:26:17'),
(220, 55, 'images/products/686f7999c786e_1752136089.jpg', NULL, 0, 0, '2025-07-10 01:28:09', '2025-07-10 01:28:09'),
(221, 55, 'images/products/686f7999c88e7_1752136089.jpg', NULL, 0, 0, '2025-07-10 01:28:09', '2025-07-10 01:28:09'),
(222, 55, 'images/products/686f7999c9172_1752136089.jpg', NULL, 0, 0, '2025-07-10 01:28:09', '2025-07-10 01:28:09'),
(223, 55, 'images/products/686f7999c9907_1752136089.jpg', NULL, 0, 0, '2025-07-10 01:28:09', '2025-07-10 01:28:09'),
(224, 55, 'images/products/686f7999caa4a_1752136089.jpg', NULL, 0, 0, '2025-07-10 01:28:09', '2025-07-10 01:28:09'),
(225, 55, 'images/products/686f7999cb1db_1752136089.jpg', NULL, 0, 0, '2025-07-10 01:28:09', '2025-07-10 01:28:09'),
(226, 55, 'images/products/686f7999ccb0a_1752136089.jpg', NULL, 0, 0, '2025-07-10 01:28:09', '2025-07-10 01:28:09'),
(227, 56, 'images/products/686f7a57bc937_1752136279.jpg', NULL, 0, 0, '2025-07-10 01:31:19', '2025-07-10 01:31:19'),
(228, 56, 'images/products/686f7a57bd7fc_1752136279.jpg', NULL, 0, 0, '2025-07-10 01:31:19', '2025-07-10 01:31:19'),
(229, 56, 'images/products/686f7a57bde9e_1752136279.jpg', NULL, 0, 0, '2025-07-10 01:31:19', '2025-07-10 01:31:19'),
(230, 56, 'images/products/686f7a57be53e_1752136279.jpg', NULL, 0, 0, '2025-07-10 01:31:19', '2025-07-10 01:31:19'),
(231, 56, 'images/products/686f7a57bf0ab_1752136279.jpg', NULL, 0, 0, '2025-07-10 01:31:19', '2025-07-10 01:31:19'),
(232, 56, 'images/products/686f7a57bf995_1752136279.jpg', NULL, 0, 0, '2025-07-10 01:31:19', '2025-07-10 01:31:19'),
(233, 56, 'images/products/686f7a57c00b5_1752136279.jpg', NULL, 0, 0, '2025-07-10 01:31:19', '2025-07-10 01:31:19'),
(234, 56, 'images/products/686f7a57c1970_1752136279.jpg', NULL, 0, 0, '2025-07-10 01:31:19', '2025-07-10 01:31:19'),
(235, 56, 'images/products/686f7a57c2923_1752136279.jpg', NULL, 0, 0, '2025-07-10 01:31:19', '2025-07-10 01:31:19'),
(236, 57, 'images/products/686f7b340ffb2_1752136500.jpg', NULL, 0, 0, '2025-07-10 01:35:00', '2025-07-10 01:35:00'),
(237, 57, 'images/products/686f7b3410fa2_1752136500.jpg', NULL, 0, 0, '2025-07-10 01:35:00', '2025-07-10 01:35:00'),
(238, 57, 'images/products/686f7b34117b3_1752136500.jpg', NULL, 0, 0, '2025-07-10 01:35:00', '2025-07-10 01:35:00'),
(239, 57, 'images/products/686f7b3412391_1752136500.jpg', NULL, 0, 0, '2025-07-10 01:35:00', '2025-07-10 01:35:00'),
(240, 58, 'images/products/686f7cf64366e_1752136950.jpg', NULL, 0, 0, '2025-07-10 01:42:30', '2025-07-10 01:42:30'),
(241, 58, 'images/products/686f7cf6447ba_1752136950.jpg', NULL, 0, 0, '2025-07-10 01:42:30', '2025-07-10 01:42:30'),
(242, 58, 'images/products/686f7cf64506b_1752136950.jpg', NULL, 0, 0, '2025-07-10 01:42:30', '2025-07-10 01:42:30'),
(243, 58, 'images/products/686f7cf645aae_1752136950.jpg', NULL, 0, 0, '2025-07-10 01:42:30', '2025-07-10 01:42:30'),
(244, 59, 'images/products/686f7d359e5e2_1752137013.jpg', NULL, 0, 0, '2025-07-10 01:43:33', '2025-07-10 01:43:33'),
(245, 59, 'images/products/686f7d359f520_1752137013.jpg', NULL, 0, 0, '2025-07-10 01:43:33', '2025-07-10 01:43:33'),
(246, 59, 'images/products/686f7d359fd91_1752137013.jpg', NULL, 0, 0, '2025-07-10 01:43:33', '2025-07-10 01:43:33'),
(247, 59, 'images/products/686f7d35a0a76_1752137013.jpg', NULL, 0, 0, '2025-07-10 01:43:33', '2025-07-10 01:43:33'),
(248, 59, 'images/products/686f7d35a144b_1752137013.jpg', NULL, 0, 0, '2025-07-10 01:43:33', '2025-07-10 01:43:33'),
(249, 59, 'images/products/686f7d35a1bac_1752137013.jpg', NULL, 0, 0, '2025-07-10 01:43:33', '2025-07-10 01:43:33'),
(250, 59, 'images/products/686f7d35a2474_1752137013.jpg', NULL, 0, 0, '2025-07-10 01:43:33', '2025-07-10 01:43:33'),
(251, 60, 'images/products/686f7d8759375_1752137095.jpg', NULL, 0, 0, '2025-07-10 01:44:55', '2025-07-10 01:44:55'),
(252, 60, 'images/products/686f7d875a62c_1752137095.jpg', NULL, 0, 0, '2025-07-10 01:44:55', '2025-07-10 01:44:55'),
(253, 60, 'images/products/686f7d875b067_1752137095.jpg', NULL, 0, 0, '2025-07-10 01:44:55', '2025-07-10 01:44:55'),
(254, 60, 'images/products/686f7d875ba26_1752137095.jpg', NULL, 0, 0, '2025-07-10 01:44:55', '2025-07-10 01:44:55'),
(255, 60, 'images/products/686f7d875c26c_1752137095.jpg', NULL, 0, 0, '2025-07-10 01:44:55', '2025-07-10 01:44:55'),
(256, 60, 'images/products/686f7d875cad4_1752137095.jpg', NULL, 0, 0, '2025-07-10 01:44:55', '2025-07-10 01:44:55'),
(257, 61, 'images/products/686f7de4967e6_1752137188.jpg', NULL, 0, 0, '2025-07-10 01:46:28', '2025-07-10 01:46:28'),
(258, 61, 'images/products/686f7de497a4a_1752137188.jpg', NULL, 0, 0, '2025-07-10 01:46:28', '2025-07-10 01:46:28'),
(259, 61, 'images/products/686f7de498251_1752137188.jpg', NULL, 0, 0, '2025-07-10 01:46:28', '2025-07-10 01:46:28'),
(260, 61, 'images/products/686f7de498b8e_1752137188.jpg', NULL, 0, 0, '2025-07-10 01:46:28', '2025-07-10 01:46:28'),
(261, 61, 'images/products/686f7de4994b8_1752137188.jpg', NULL, 0, 0, '2025-07-10 01:46:28', '2025-07-10 01:46:28'),
(262, 61, 'images/products/686f7de499ec2_1752137188.jpg', NULL, 0, 0, '2025-07-10 01:46:28', '2025-07-10 01:46:28'),
(263, 61, 'images/products/686f7de49a829_1752137188.jpg', NULL, 0, 0, '2025-07-10 01:46:28', '2025-07-10 01:46:28'),
(264, 62, 'images/products/686f7e25b8b0f_1752137253.jpg', NULL, 0, 0, '2025-07-10 01:47:33', '2025-07-10 01:47:33'),
(265, 62, 'images/products/686f7e25b9dae_1752137253.jpg', NULL, 0, 0, '2025-07-10 01:47:33', '2025-07-10 01:47:33'),
(266, 62, 'images/products/686f7e25ba672_1752137253.jpg', NULL, 0, 0, '2025-07-10 01:47:33', '2025-07-10 01:47:33'),
(267, 62, 'images/products/686f7e25bae66_1752137253.jpg', NULL, 0, 0, '2025-07-10 01:47:33', '2025-07-10 01:47:33'),
(268, 63, 'images/products/686f7ec5d939f_1752137413.jpg', NULL, 0, 0, '2025-07-10 01:50:13', '2025-07-10 01:50:13'),
(269, 63, 'images/products/686f7ec5da2f9_1752137413.jpg', NULL, 0, 0, '2025-07-10 01:50:13', '2025-07-10 01:50:13'),
(270, 63, 'images/products/686f7ec5daac5_1752137413.jpg', NULL, 0, 0, '2025-07-10 01:50:13', '2025-07-10 01:50:13'),
(271, 63, 'images/products/686f7ec5db1d7_1752137413.jpg', NULL, 0, 0, '2025-07-10 01:50:13', '2025-07-10 01:50:13'),
(272, 63, 'images/products/686f7ec5dba11_1752137413.jpg', NULL, 0, 0, '2025-07-10 01:50:13', '2025-07-10 01:50:13'),
(273, 63, 'images/products/686f7ec5dd11c_1752137413.jpg', NULL, 0, 0, '2025-07-10 01:50:13', '2025-07-10 01:50:13'),
(274, 64, 'images/products/686f7f041328d_1752137476.jpg', NULL, 0, 0, '2025-07-10 01:51:16', '2025-07-10 01:51:16'),
(275, 64, 'images/products/686f7f04141bc_1752137476.jpg', NULL, 0, 0, '2025-07-10 01:51:16', '2025-07-10 01:51:16'),
(276, 64, 'images/products/686f7f0414c5d_1752137476.jpg', NULL, 0, 0, '2025-07-10 01:51:16', '2025-07-10 01:51:16'),
(277, 64, 'images/products/686f7f041563d_1752137476.jpg', NULL, 0, 0, '2025-07-10 01:51:16', '2025-07-10 01:51:16'),
(278, 65, 'images/products/686f7f477fb73_1752137543.jpg', NULL, 0, 0, '2025-07-10 01:52:23', '2025-07-10 01:52:23'),
(279, 65, 'images/products/686f7f4780bb0_1752137543.jpg', NULL, 0, 0, '2025-07-10 01:52:23', '2025-07-10 01:52:23'),
(280, 65, 'images/products/686f7f478161c_1752137543.jpg', NULL, 0, 0, '2025-07-10 01:52:23', '2025-07-10 01:52:23'),
(281, 65, 'images/products/686f7f4781dca_1752137543.jpg', NULL, 0, 0, '2025-07-10 01:52:23', '2025-07-10 01:52:23'),
(282, 66, 'images/products/686f818b1aab4_1752138123.jpg', NULL, 0, 0, '2025-07-10 02:02:03', '2025-07-10 02:02:03'),
(283, 66, 'images/products/686f818b1ba3e_1752138123.jpg', NULL, 0, 0, '2025-07-10 02:02:03', '2025-07-10 02:02:03'),
(284, 66, 'images/products/686f818b1c2ae_1752138123.jpg', NULL, 0, 0, '2025-07-10 02:02:03', '2025-07-10 02:02:03'),
(285, 66, 'images/products/686f818b1ca27_1752138123.jpg', NULL, 0, 0, '2025-07-10 02:02:03', '2025-07-10 02:02:03'),
(286, 66, 'images/products/686f818b1d2ee_1752138123.jpg', NULL, 0, 0, '2025-07-10 02:02:03', '2025-07-10 02:02:03'),
(287, 66, 'images/products/686f818b1da94_1752138123.jpg', NULL, 0, 0, '2025-07-10 02:02:03', '2025-07-10 02:02:03'),
(288, 67, 'images/products/686f81c124610_1752138177.jpg', NULL, 0, 0, '2025-07-10 02:02:57', '2025-07-10 02:02:57'),
(289, 67, 'images/products/686f81c1254c1_1752138177.jpg', NULL, 0, 0, '2025-07-10 02:02:57', '2025-07-10 02:02:57'),
(290, 67, 'images/products/686f81c125e5f_1752138177.jpg', NULL, 0, 0, '2025-07-10 02:02:57', '2025-07-10 02:02:57'),
(291, 67, 'images/products/686f81c126587_1752138177.jpg', NULL, 0, 0, '2025-07-10 02:02:57', '2025-07-10 02:02:57'),
(292, 68, 'images/products/686f81f0def1d_1752138224.jpg', NULL, 0, 0, '2025-07-10 02:03:44', '2025-07-10 02:03:44'),
(293, 68, 'images/products/686f81f0dffa5_1752138224.jpg', NULL, 0, 0, '2025-07-10 02:03:44', '2025-07-10 02:03:44'),
(294, 68, 'images/products/686f81f0e092d_1752138224.jpg', NULL, 0, 0, '2025-07-10 02:03:44', '2025-07-10 02:03:44'),
(295, 69, 'images/products/686f8220706e9_1752138272.jpg', NULL, 0, 0, '2025-07-10 02:04:32', '2025-07-10 02:04:32'),
(296, 69, 'images/products/686f822071636_1752138272.jpg', NULL, 0, 0, '2025-07-10 02:04:32', '2025-07-10 02:04:32'),
(297, 69, 'images/products/686f8220720ee_1752138272.jpg', NULL, 0, 0, '2025-07-10 02:04:32', '2025-07-10 02:04:32'),
(298, 69, 'images/products/686f822072a27_1752138272.jpg', NULL, 0, 0, '2025-07-10 02:04:32', '2025-07-10 02:04:32'),
(299, 69, 'images/products/686f822073401_1752138272.jpg', NULL, 0, 0, '2025-07-10 02:04:32', '2025-07-10 02:04:32'),
(300, 69, 'images/products/686f822073da7_1752138272.jpg', NULL, 0, 0, '2025-07-10 02:04:32', '2025-07-10 02:04:32'),
(301, 70, 'images/products/686f827171cdf_1752138353.jpg', NULL, 0, 0, '2025-07-10 02:05:53', '2025-07-10 02:05:53'),
(302, 70, 'images/products/686f827172e2f_1752138353.jpg', NULL, 0, 0, '2025-07-10 02:05:53', '2025-07-10 02:05:53'),
(303, 70, 'images/products/686f827173850_1752138353.jpg', NULL, 0, 0, '2025-07-10 02:05:53', '2025-07-10 02:05:53'),
(304, 70, 'images/products/686f8271740ad_1752138353.jpg', NULL, 0, 0, '2025-07-10 02:05:53', '2025-07-10 02:05:53'),
(305, 70, 'images/products/686f8271748f8_1752138353.jpg', NULL, 0, 0, '2025-07-10 02:05:53', '2025-07-10 02:05:53'),
(306, 70, 'images/products/686f8271765f4_1752138353.jpg', NULL, 0, 0, '2025-07-10 02:05:53', '2025-07-10 02:05:53'),
(307, 71, 'images/products/686f82d0d2cd4_1752138448.jpg', NULL, 0, 0, '2025-07-10 02:07:28', '2025-07-10 02:07:28'),
(308, 71, 'images/products/686f82d0d407d_1752138448.jpg', NULL, 0, 0, '2025-07-10 02:07:28', '2025-07-10 02:07:28'),
(309, 71, 'images/products/686f82d0d4a62_1752138448.jpg', NULL, 0, 0, '2025-07-10 02:07:28', '2025-07-10 02:07:28'),
(310, 71, 'images/products/686f82d0d5472_1752138448.jpg', NULL, 0, 0, '2025-07-10 02:07:28', '2025-07-10 02:07:28'),
(311, 71, 'images/products/686f82d0d5c72_1752138448.jpg', NULL, 0, 0, '2025-07-10 02:07:28', '2025-07-10 02:07:28'),
(312, 71, 'images/products/686f82d0d63ef_1752138448.jpg', NULL, 0, 0, '2025-07-10 02:07:28', '2025-07-10 02:07:28'),
(313, 71, 'images/products/686f82d0d80c8_1752138448.jpg', NULL, 0, 0, '2025-07-10 02:07:28', '2025-07-10 02:07:28'),
(314, 72, 'images/products/686f83221fa12_1752138530.jpg', NULL, 0, 0, '2025-07-10 02:08:50', '2025-07-10 02:08:50'),
(315, 72, 'images/products/686f832220aaf_1752138530.jpg', NULL, 0, 0, '2025-07-10 02:08:50', '2025-07-10 02:08:50'),
(316, 72, 'images/products/686f8322212bc_1752138530.jpg', NULL, 0, 0, '2025-07-10 02:08:50', '2025-07-10 02:08:50'),
(317, 72, 'images/products/686f832221a80_1752138530.jpg', NULL, 0, 0, '2025-07-10 02:08:50', '2025-07-10 02:08:50'),
(318, 72, 'images/products/686f8322222c5_1752138530.jpg', NULL, 0, 0, '2025-07-10 02:08:50', '2025-07-10 02:08:50'),
(319, 73, 'images/products/686f835ac4dae_1752138586.jpg', NULL, 0, 0, '2025-07-10 02:09:46', '2025-07-10 02:09:46'),
(320, 73, 'images/products/686f835ac5db2_1752138586.jpg', NULL, 0, 0, '2025-07-10 02:09:46', '2025-07-10 02:09:46'),
(321, 73, 'images/products/686f835ac66af_1752138586.jpg', NULL, 0, 0, '2025-07-10 02:09:46', '2025-07-10 02:09:46'),
(322, 73, 'images/products/686f835ac703b_1752138586.jpg', NULL, 0, 0, '2025-07-10 02:09:46', '2025-07-10 02:09:46'),
(323, 73, 'images/products/686f835ac77f0_1752138586.jpg', NULL, 0, 0, '2025-07-10 02:09:46', '2025-07-10 02:09:46'),
(324, 73, 'images/products/686f835ac81ed_1752138586.jpg', NULL, 0, 0, '2025-07-10 02:09:46', '2025-07-10 02:09:46'),
(325, 74, 'images/products/686f842f6b2d2_1752138799.jpg', NULL, 0, 0, '2025-07-10 02:13:19', '2025-07-10 02:13:19'),
(326, 74, 'images/products/686f842f6c57e_1752138799.jpg', NULL, 0, 0, '2025-07-10 02:13:19', '2025-07-10 02:13:19'),
(327, 74, 'images/products/686f842f6cdcc_1752138799.jpg', NULL, 0, 0, '2025-07-10 02:13:19', '2025-07-10 02:13:19'),
(328, 74, 'images/products/686f842f6d791_1752138799.jpg', NULL, 0, 0, '2025-07-10 02:13:19', '2025-07-10 02:13:19'),
(329, 74, 'images/products/686f842f6ef61_1752138799.jpg', NULL, 0, 0, '2025-07-10 02:13:19', '2025-07-10 02:13:19'),
(330, 74, 'images/products/686f842f6ff5e_1752138799.jpg', NULL, 0, 0, '2025-07-10 02:13:19', '2025-07-10 02:13:19'),
(331, 75, 'images/products/686f848213d15_1752138882.jpg', NULL, 0, 0, '2025-07-10 02:14:42', '2025-07-10 02:14:42'),
(332, 75, 'images/products/686f848214d2a_1752138882.jpg', NULL, 0, 0, '2025-07-10 02:14:42', '2025-07-10 02:14:42'),
(333, 75, 'images/products/686f84821569a_1752138882.jpg', NULL, 0, 0, '2025-07-10 02:14:42', '2025-07-10 02:14:42'),
(334, 75, 'images/products/686f8482161c5_1752138882.jpg', NULL, 0, 0, '2025-07-10 02:14:42', '2025-07-10 02:14:42'),
(335, 75, 'images/products/686f848216984_1752138882.jpg', NULL, 0, 0, '2025-07-10 02:14:42', '2025-07-10 02:14:42'),
(336, 75, 'images/products/686f8482180e7_1752138882.jpg', NULL, 0, 0, '2025-07-10 02:14:42', '2025-07-10 02:14:42'),
(337, 76, 'images/products/686f851114de4_1752139025.jpg', NULL, 0, 0, '2025-07-10 02:17:05', '2025-07-10 02:17:05'),
(338, 76, 'images/products/686f8511161b0_1752139025.jpg', NULL, 0, 0, '2025-07-10 02:17:05', '2025-07-10 02:17:05'),
(339, 76, 'images/products/686f851116ac9_1752139025.jpg', NULL, 0, 0, '2025-07-10 02:17:05', '2025-07-10 02:17:05'),
(340, 76, 'images/products/686f85111721f_1752139025.jpg', NULL, 0, 0, '2025-07-10 02:17:05', '2025-07-10 02:17:05'),
(341, 76, 'images/products/686f851117a19_1752139025.jpg', NULL, 0, 0, '2025-07-10 02:17:05', '2025-07-10 02:17:05'),
(342, 76, 'images/products/686f851119652_1752139025.jpg', NULL, 0, 0, '2025-07-10 02:17:05', '2025-07-10 02:17:05'),
(343, 76, 'images/products/686f85111a688_1752139025.jpg', NULL, 0, 0, '2025-07-10 02:17:05', '2025-07-10 02:17:05'),
(344, 77, 'images/products/686f855fd6a09_1752139103.jpg', NULL, 0, 0, '2025-07-10 02:18:23', '2025-07-10 02:18:23'),
(345, 77, 'images/products/686f855fd796c_1752139103.jpg', NULL, 0, 0, '2025-07-10 02:18:23', '2025-07-10 02:18:23'),
(346, 77, 'images/products/686f855fd8279_1752139103.jpg', NULL, 0, 0, '2025-07-10 02:18:23', '2025-07-10 02:18:23'),
(347, 77, 'images/products/686f855fd99fc_1752139103.jpg', NULL, 0, 0, '2025-07-10 02:18:23', '2025-07-10 02:18:23'),
(354, 79, 'images/products/68a48bba72e04_1755614138.jpg', NULL, 0, 0, '2025-08-19 14:35:38', '2025-08-19 14:35:38'),
(355, 79, 'images/products/68a48bbaac97b_1755614138.jpg', NULL, 0, 0, '2025-08-19 14:35:38', '2025-08-19 14:35:38'),
(356, 79, 'images/products/68a48bbaadd5b_1755614138.jpg', NULL, 0, 0, '2025-08-19 14:35:38', '2025-08-19 14:35:38'),
(357, 79, 'images/products/68a48bbaaf182_1755614138.jpg', NULL, 0, 0, '2025-08-19 14:35:38', '2025-08-19 14:35:38'),
(359, 79, 'images/products/68a48c921cedf_1755614354.png', NULL, 0, 0, '2025-08-19 14:39:14', '2025-08-19 14:39:14');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint UNSIGNED NOT NULL,
  `name_variant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `price_modifier` decimal(10,2) NOT NULL,
  `stock_quantity` int UNSIGNED NOT NULL,
  `image_id` bigint UNSIGNED DEFAULT NULL,
  `size` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `name_variant`, `product_id`, `price_modifier`, `stock_quantity`, `image_id`, `size`, `created_at`, `updated_at`) VALUES
(21, 'Xám VACT 9699', 21, '0.00', 14, 25, 'D2200 - R850 _C760', '2025-07-09 06:39:44', '2025-07-09 06:39:44'),
(22, 'Ghi Madeira / Sand', 22, '0.00', 10, 30, 'D1800 - R840 - C800 mm', '2025-07-09 06:43:31', '2025-07-10 07:10:53'),
(23, 'Xám Madrid KD1214-05', 22, '200000.00', 0, 31, 'D1800 - R840 - C800 mm', '2025-07-09 06:43:31', '2025-07-09 06:43:31'),
(24, 'Vải Light Grey', 23, '0.00', 11, 35, 'D1800 - R850 - C830 mm', '2025-07-09 18:06:26', '2025-07-09 18:06:26'),
(25, 'Vải MB Hồng L1-14', 24, '0.00', 24, 40, 'D1500 - R700 - C750mm', '2025-07-09 18:07:36', '2025-07-09 18:07:36'),
(26, 'Vải màu Cam', 25, '0.00', 13, 46, 'D1600 - R800 - C800 mm', '2025-07-09 18:11:56', '2025-07-09 18:11:56'),
(27, 'Vải Xám VACT10500', 25, '0.00', 23, 47, 'D1600 - R800 - C800 mm', '2025-07-09 18:11:56', '2025-07-09 18:11:56'),
(28, 'Vải Xám (Kèm Đôn)', 26, '0.00', 12, 53, 'D2250 - R900 - C790 mm', '2025-07-09 18:15:20', '2025-07-09 18:15:20'),
(29, 'Vải MB16 (Kèm Đôn)', 26, '0.00', 0, 54, 'D2250 - R900 - C790 mm', '2025-07-09 18:15:20', '2025-07-09 18:15:20'),
(30, 'Vải Xanh (Kèm Đôn)', 26, '0.00', 11, 55, 'D2250 - R900 - C790 mm', '2025-07-09 18:15:20', '2025-07-09 18:15:20'),
(31, 'Vải Vact3444 (Kèm Đôn)', 27, '0.00', 13, 60, 'D2870 - R1770 - C710 mm', '2025-07-09 18:18:41', '2025-07-09 18:18:41'),
(32, 'Vải Nâu vact10499', 28, '0.00', 14, 64, 'D1440 - R720 - C730 mm', '2025-07-09 18:24:20', '2025-07-09 18:24:20'),
(33, 'Vải Xám vact10504', 28, '1000000.00', 9, 65, 'D1440 - R720 - C730 mm', '2025-07-09 18:24:20', '2025-07-09 18:24:20'),
(34, 'Vải Xám MB2041-17', 29, '0.00', 14, 70, 'D2200 - R950 - C750 mm', '2025-07-09 18:26:41', '2025-07-09 18:26:41'),
(35, 'Vải Rose MB2041-9', 29, '2000000.00', 4, 71, 'D2200 - R950 - C750 mm', '2025-07-09 18:26:41', '2025-07-09 18:26:41'),
(36, 'Da 509MB', 30, '11000000.00', 13, 79, 'D2400 - R880 - C850', '2025-07-09 18:33:46', '2025-07-09 18:33:46'),
(37, 'Da 515MB', 30, '11000000.00', 15, 80, 'D2400 - R880 - C850', '2025-07-09 18:33:46', '2025-07-09 18:33:46'),
(38, 'vải MB2032-21', 30, '0.00', 35, 81, 'D2400 - R880 - C850', '2025-07-09 18:33:46', '2025-07-09 18:33:46'),
(39, 'Vải xanh MB 08', 30, '0.00', 16, 82, 'D2400 - R880 - C850', '2025-07-09 18:33:46', '2025-07-09 18:33:46'),
(40, 'Đỏ 405-1', 31, '0.00', 25, 86, 'D770 - R770 - C800 mm', '2025-07-09 19:40:00', '2025-07-09 19:40:00'),
(41, 'Xanh ngọc VACT6461', 31, '0.00', 35, 87, 'D770 - R770 - C800 mm', '2025-07-09 19:40:00', '2025-07-09 19:40:00'),
(42, 'Cam  VATC 1569', 31, '0.00', 0, 88, 'D770 - R770 - C800 mm', '2025-07-09 19:40:00', '2025-07-09 19:40:00'),
(43, 'Trắng  VATC 1569', 31, '0.00', 11, 89, 'D770 - R770 - C800 mm', '2025-07-09 19:40:00', '2025-07-09 19:40:00'),
(44, '01 Navy', 32, '100000.00', 34, 94, 'D690 - R700 - C700 mm', '2025-07-09 19:43:02', '2025-07-09 19:43:02'),
(45, '04 Beige', 32, '100000.00', 15, 95, 'D690 - R700 - C700 mm', '2025-07-09 19:43:02', '2025-07-09 19:43:02'),
(46, '02 mint', 32, '100000.00', 24, 96, 'D690 - R700 - C700 mm', '2025-07-09 19:43:02', '2025-07-09 19:43:02'),
(47, 'Màu Brown', 32, '0.00', 12, 97, 'D690 - R700 - C700 mm', '2025-07-09 19:43:02', '2025-07-09 19:43:02'),
(48, 'Màu Đỏ', 32, '0.00', 0, 98, 'D690 - R700 - C700 mm', '2025-07-09 19:43:02', '2025-07-09 19:43:02'),
(49, 'màu vàng', 32, '0.00', 0, 99, 'D690 - R700 - C700 mm', '2025-07-09 19:43:02', '2025-07-09 19:43:02'),
(50, 'VACT11475 A', 33, '0.00', 42, 105, 'D1000 - R750 - C900 mm', '2025-07-09 19:45:16', '2025-07-09 19:45:16'),
(51, 'VACT10500', 33, '0.00', 23, 106, 'D1000 - R750 - C900 mm', '2025-07-09 19:45:16', '2025-07-09 19:45:16'),
(52, 'VACT4103', 34, '0.00', 12, 108, 'D860 - R800 - C1040 mm', '2025-07-09 19:52:31', '2025-07-09 19:52:31'),
(53, 'VACT5606', 34, '0.00', 0, 109, 'D860 - R800 - C1040 mm', '2025-07-09 19:52:31', '2025-07-09 19:52:31'),
(54, 'VACT8088', 34, '0.00', 24, 110, 'D860 - R800 - C1040 mm', '2025-07-09 19:52:31', '2025-07-09 19:52:31'),
(55, 'VACT3532 + Gối', 35, '0.00', 11, 112, 'D800 - R800 - C670 mm', '2025-07-09 19:56:30', '2025-07-09 19:56:30'),
(56, 'Gối VACT4103', 35, '0.00', 12, 113, 'D800 - R800 - C670 mm', '2025-07-09 19:56:30', '2025-07-09 19:56:30'),
(57, 'VACT4251 + Gối', 35, '0.00', 31, 114, 'D800 - R800 - C670 mm', '2025-07-09 19:56:30', '2025-07-09 19:56:30'),
(58, 'VACT4103/Gối', 35, '0.00', 21, 115, 'D800 - R800 - C670 mm', '2025-07-09 19:56:30', '2025-07-09 19:56:30'),
(59, 'vàng', 36, '0.00', 13, 123, 'D830 - R760 - C790 mm', '2025-07-09 19:59:56', '2025-07-09 19:59:56'),
(60, 'đỏ gạch', 36, '0.00', 11, 124, 'D830 - R760 - C790 mm', '2025-07-09 19:59:56', '2025-07-09 19:59:56'),
(61, '01 NAVY', 37, '0.00', 31, 126, 'D350 - R350 - C400 mm', '2025-07-10 00:51:54', '2025-07-10 00:51:54'),
(62, '02 DARK BLUE VACT 6461', 37, '0.00', 10, 127, 'D350 - R350 - C400 mm', '2025-07-10 00:51:54', '2025-07-26 15:23:27'),
(63, '04 PINK', 37, '0.00', 25, 128, 'D350 - R350 - C400 mm', '2025-07-10 00:51:54', '2025-07-10 00:51:54'),
(64, 'BEIGE', 37, '0.00', 0, 129, 'D350 - R350 - C400 mm', '2025-07-10 00:51:54', '2025-07-10 00:51:54'),
(65, 'RED', 37, '0.00', 24, 130, 'D350 - R350 - C400 mm', '2025-07-10 00:51:54', '2025-07-10 00:51:54'),
(66, 'YELLOW', 38, '0.00', 23, 133, 'D500 - R500 - C500 mm', '2025-07-10 00:57:03', '2025-07-10 00:57:03'),
(67, '07 navy', 38, '300000.00', 45, 134, 'D500 - R500 - C500 mm', '2025-07-10 00:57:03', '2025-07-10 00:57:03'),
(68, '08 Mint', 38, '100000.00', 25, 135, 'D500 - R500 - C500 mm', '2025-07-10 00:57:03', '2025-07-10 00:57:03'),
(69, 'BLUE', 38, '288888.00', 0, 136, 'D500 - R500 - C500 mm', '2025-07-10 00:57:03', '2025-07-10 00:57:03'),
(70, '11 PINK', 38, '0.00', 245, 137, 'D500 - R500 - C500 mm', '2025-07-10 00:57:03', '2025-07-10 00:57:03'),
(71, 'Beige', 38, '0.00', 55, 138, 'D500 - R500 - C500 mm', '2025-07-10 00:57:03', '2025-07-10 00:57:03'),
(72, 'RED', 38, '0.00', 42, 139, 'D500 - R500 - C500 mm', '2025-07-10 00:57:03', '2025-07-10 00:57:03'),
(73, NULL, 39, '0.00', 13, 144, 'D350 - R350 - C420 mm', '2025-07-10 00:58:26', '2025-07-10 00:58:26'),
(74, NULL, 40, '0.00', 16, 149, 'Ø320 - C380 mm', '2025-07-10 00:59:44', '2025-07-10 00:59:44'),
(75, NULL, 41, '0.00', 14, 154, 'Ø320 - C380 mm', '2025-07-10 01:00:45', '2025-07-10 01:00:45'),
(76, NULL, 42, '0.00', 14, 160, 'D320 - R320 - C535 mm', '2025-07-10 01:02:55', '2025-07-10 01:02:55'),
(77, 'ORANGE', 43, '0.00', 12, 167, 'D470 - R470 - C490 mm', '2025-07-10 01:07:55', '2025-07-10 01:07:55'),
(78, NULL, 44, '0.00', 13, 172, 'D400 - R500 - C550mm', '2025-07-10 01:08:56', '2025-07-10 01:08:56'),
(79, NULL, 45, '0.00', 0, 176, 'D500 - R500 - C465 mm', '2025-07-10 01:10:00', '2025-07-10 01:10:00'),
(80, NULL, 46, '0.00', 25, 182, 'D1150 - R650 - C408 mm', '2025-07-10 01:11:09', '2025-07-10 01:11:09'),
(81, NULL, 47, '0.00', 11, 186, 'D720 - R720 - C360 mm', '2025-07-10 01:13:06', '2025-07-10 01:13:06'),
(82, NULL, 48, '0.00', 12, 191, 'D1400 - R680 - C280 mm', '2025-07-10 01:14:31', '2025-07-10 01:14:31'),
(83, NULL, 49, '0.00', 14, 194, 'D1200 - R700 - C350 mm', '2025-07-10 01:15:27', '2025-07-10 01:15:27'),
(84, NULL, 50, '0.00', 13, 198, 'D1100 - R600 - C350/500', '2025-07-10 01:16:59', '2025-07-10 01:16:59'),
(85, 'Da DAAB 1011', 51, '0.00', 13, 202, 'D470 - R570 - C860', '2025-07-10 01:20:07', '2025-07-10 01:20:07'),
(86, 'Da AB1142', 51, '0.00', 43, 203, 'D470 - R570 - C860', '2025-07-10 01:20:07', '2025-07-10 01:20:07'),
(87, 'vải vact10504', 52, '0.00', 13, 206, 'D580 - R575 - C785 mm', '2025-07-10 01:21:24', '2025-07-10 01:21:24'),
(88, 'vải vact10499', 52, '0.00', 14, 207, 'D580 - R575 - C785 mm', '2025-07-10 01:21:24', '2025-07-10 01:21:24'),
(89, 'KD1085-18', 53, '0.00', 12, 212, 'D435 - R525 - C840 mm', '2025-07-10 01:24:47', '2025-07-10 01:24:47'),
(90, 'xanh', 53, '0.00', 31, 213, 'D435 - R525 - C840 mm', '2025-07-10 01:24:47', '2025-07-10 01:24:47'),
(91, 'VACT5805', 53, '0.00', 14, 214, 'D435 - R525 - C840 mm', '2025-07-10 01:24:47', '2025-07-10 01:24:47'),
(92, 'VACT10635', 54, '0.00', 13, 218, 'D600 - R540 - C745 mm', '2025-07-10 01:26:17', '2025-07-10 01:26:17'),
(93, 'Vact4251', 54, '0.00', 14, 219, 'D600 - R540 - C745 mm', '2025-07-10 01:26:17', '2025-07-10 01:26:17'),
(94, 'BE', 55, '0.00', 14, 225, 'D572 - R552 - C730mm', '2025-07-10 01:28:09', '2025-07-10 01:28:09'),
(95, 'ĐEN', 55, '0.00', 24, 226, 'D572 - R552 - C730mm', '2025-07-10 01:28:09', '2025-07-10 01:28:09'),
(96, 'Gỗ nâu Da cognac', 56, '0.00', 22, 233, 'D560 - R480 - C770mm', '2025-07-10 01:31:19', '2025-07-10 01:31:19'),
(97, 'Gỗ màu Tự nhiên Da đen', 56, '0.00', 33, 234, 'D560 - R480 - C770mm', '2025-07-10 01:31:19', '2025-07-10 01:31:19'),
(98, 'Có tay Gỗ nâu Da cognac', 56, '0.00', 11, 235, 'D560 - R480 - C770mm', '2025-07-10 01:31:19', '2025-07-10 01:31:19'),
(99, NULL, 57, '0.00', 13, 239, 'D1600 - R800 - C755 mm', '2025-07-10 01:35:00', '2025-07-26 06:31:03'),
(100, NULL, 58, '0.00', 12, 243, 'D2250 - R950 - C750 mm', '2025-07-10 01:42:30', '2025-07-10 01:42:30'),
(101, NULL, 59, '0.00', 35, 250, 'D2300 - R950 - C750 mm', '2025-07-10 01:43:33', '2025-07-10 01:43:33'),
(102, NULL, 60, '0.00', 11, 256, 'D3000 - R1000 - C770mm', '2025-07-10 01:44:55', '2025-07-10 01:44:55'),
(103, NULL, 61, '0.00', 34, 263, 'D1400- R800- C750 mm', '2025-07-10 01:46:28', '2025-07-10 01:46:28'),
(104, NULL, 62, '0.00', 13, 267, 'D2000 - R1000 - C750 mm', '2025-07-10 01:47:33', '2025-07-10 01:47:33'),
(105, 'Đá thạch anh', 63, '4000000.00', 14, 272, 'D1600-R900-C750', '2025-07-10 01:50:13', '2025-07-10 01:50:13'),
(106, 'Kính', 63, '0.00', 22, 273, 'D1600-R900-C750', '2025-07-10 01:50:13', '2025-07-10 01:50:13'),
(107, NULL, 64, '0.00', 8, 277, 'D2000 - R1000 - C755 mm', '2025-07-10 01:51:16', '2025-08-01 02:48:19'),
(108, 'mẫu 2', 65, '0.00', 13, 281, 'D2200- R900- C740 mm', '2025-07-10 01:52:23', '2025-07-26 05:16:51'),
(109, NULL, 66, '0.00', 11, 287, 'D2000 - R550 - C562 mm', '2025-07-10 02:02:03', '2025-07-10 02:02:03'),
(110, NULL, 67, '0.00', 0, 291, 'D1800 - R450 - C510 mm', '2025-07-10 02:02:57', '2025-07-26 04:50:54'),
(111, NULL, 68, '0.00', 0, 294, 'D1800 - R450 - C568 mm', '2025-07-10 02:03:44', '2025-07-10 02:03:44'),
(112, NULL, 69, '0.00', 4, 300, 'D1800 - R420 - C560 mm', '2025-07-10 02:04:32', '2025-08-01 00:53:02'),
(113, 'Màu nâu', 70, '0.00', 14, 305, 'D1745 - R420 - C430 mm', '2025-07-10 02:05:53', '2025-07-10 02:05:53'),
(114, 'Màu tự nhiên', 70, '0.00', 13, 306, 'D1745 - R420 - C430 mm', '2025-07-10 02:05:53', '2025-07-10 02:05:53'),
(115, 'Màu nâu', 71, '0.00', 6, 312, 'D1800 - R450 - C450 mm', '2025-07-10 02:07:28', '2025-07-10 02:07:28'),
(116, 'Màu gỗ tự nhiên', 71, '0.00', 5, 313, 'D1800 - R450 - C450 mm', '2025-07-10 02:07:28', '2025-07-10 02:07:28'),
(117, NULL, 72, '0.00', 2, 318, 'D1700-R450-C500mm', '2025-07-10 02:08:50', '2025-07-26 06:28:46'),
(118, NULL, 73, '0.00', 15, 324, 'D1850-R450-C480 mm', '2025-07-10 02:09:46', '2025-07-10 02:09:46'),
(119, 'VACT4328', 74, '0.00', 5, 328, 'D2000 - R1800 - C1070 (mm)', '2025-07-10 02:13:19', '2025-07-10 02:13:19'),
(120, 'VACT4334', 74, '0.00', 0, 329, 'D2000 - R1800 - C1070 (mm)', '2025-07-10 02:13:19', '2025-07-10 02:13:19'),
(121, 'VACT43564', 74, '0.00', 10, 330, 'D2000 - R1800 - C1070 (mm)', '2025-07-10 02:13:19', '2025-07-26 15:29:08'),
(122, 'da nâu S3', 75, '0.00', 6, 335, 'D2000 - R1800 - C940 mm', '2025-07-10 02:14:42', '2025-08-01 02:42:58'),
(123, 'da xanh S4', 75, '0.00', 6, 336, 'D2000 - R1800 - C940 mm', '2025-07-10 02:14:42', '2025-07-10 02:14:42'),
(124, 'Blue S9C', 76, '0.00', 5, 341, 'D2000-R1600-C1070 mm', '2025-07-10 02:17:05', '2025-08-01 05:44:02'),
(125, 'Blue S9C', 76, '0.00', 2, 342, 'D2000-R1600-C1070 mm', '2025-07-10 02:17:05', '2025-08-01 00:53:02'),
(126, 'mint', 76, '1000000.00', 0, 343, 'D2000-R1600-C1070 mm', '2025-07-10 02:17:05', '2025-07-26 15:27:02'),
(127, 'MB515', 77, '0.00', 2, 346, 'D2000- R1800- C1140 mm', '2025-07-10 02:18:23', '2025-07-10 07:10:53'),
(128, 'MB520 sand', 77, '0.00', 2, 347, 'D2000- R1800- C1140 mm', '2025-07-10 02:18:23', '2025-07-26 04:43:12'),
(130, 'Vải màu Cam', 79, '0.00', 34, 359, 'D320 - R320 - C535 mm', '2025-08-19 14:35:38', '2025-08-19 14:39:14');

-- --------------------------------------------------------

--
-- Table structure for table `product_variant_attribute_values`
--

CREATE TABLE `product_variant_attribute_values` (
  `id` bigint UNSIGNED NOT NULL,
  `product_variant_id` bigint UNSIGNED NOT NULL,
  `attribute_value_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variant_attribute_values`
--

INSERT INTO `product_variant_attribute_values` (`id`, `product_variant_id`, `attribute_value_id`, `created_at`, `updated_at`) VALUES
(21, 21, 4, NULL, NULL),
(22, 22, 4, NULL, NULL),
(23, 23, 4, NULL, NULL),
(24, 24, 4, NULL, NULL),
(25, 25, 4, NULL, NULL),
(26, 26, 4, NULL, NULL),
(27, 27, 4, NULL, NULL),
(28, 28, 4, NULL, NULL),
(29, 29, 4, NULL, NULL),
(30, 30, 4, NULL, NULL),
(31, 31, 4, NULL, NULL),
(32, 32, 4, NULL, NULL),
(33, 33, 4, NULL, NULL),
(34, 34, 4, NULL, NULL),
(35, 35, 4, NULL, NULL),
(36, 36, 3, NULL, NULL),
(37, 37, 3, NULL, NULL),
(38, 38, 4, NULL, NULL),
(39, 39, 4, NULL, NULL),
(40, 40, 4, NULL, NULL),
(41, 41, 4, NULL, NULL),
(42, 42, 4, NULL, NULL),
(43, 43, 4, NULL, NULL),
(44, 44, 4, NULL, NULL),
(45, 45, 4, NULL, NULL),
(46, 46, 4, NULL, NULL),
(47, 47, 4, NULL, NULL),
(48, 48, 4, NULL, NULL),
(49, 49, 4, NULL, NULL),
(50, 50, 4, NULL, NULL),
(51, 51, 4, NULL, NULL),
(52, 52, 4, NULL, NULL),
(53, 53, 4, NULL, NULL),
(54, 54, 4, NULL, NULL),
(55, 55, 4, NULL, NULL),
(56, 56, 4, NULL, NULL),
(57, 57, 4, NULL, NULL),
(58, 58, 4, NULL, NULL),
(59, 59, 4, NULL, NULL),
(60, 60, 4, NULL, NULL),
(61, 61, 4, NULL, NULL),
(62, 62, 4, NULL, NULL),
(63, 63, 4, NULL, NULL),
(64, 64, 4, NULL, NULL),
(65, 65, 4, NULL, NULL),
(66, 66, 4, NULL, NULL),
(67, 67, 4, NULL, NULL),
(68, 68, 4, NULL, NULL),
(69, 69, 4, NULL, NULL),
(70, 70, 4, NULL, NULL),
(71, 71, 4, NULL, NULL),
(72, 72, 4, NULL, NULL),
(73, 73, 4, NULL, NULL),
(74, 74, 4, NULL, NULL),
(75, 75, 4, NULL, NULL),
(76, 76, 6, NULL, NULL),
(77, 77, 8, NULL, NULL),
(78, 78, 1, NULL, NULL),
(79, 79, 1, NULL, NULL),
(80, 80, 1, NULL, NULL),
(81, 81, 8, NULL, NULL),
(82, 82, 2, NULL, NULL),
(83, 83, 8, NULL, NULL),
(84, 84, 8, NULL, NULL),
(85, 85, 3, NULL, NULL),
(86, 86, 3, NULL, NULL),
(87, 87, 4, NULL, NULL),
(88, 88, 4, NULL, NULL),
(89, 89, 4, NULL, NULL),
(90, 90, 4, NULL, NULL),
(91, 91, 4, NULL, NULL),
(92, 92, 4, NULL, NULL),
(93, 93, 4, NULL, NULL),
(94, 94, 4, NULL, NULL),
(95, 95, 4, NULL, NULL),
(96, 96, 1, NULL, NULL),
(97, 97, 1, NULL, NULL),
(98, 98, 1, NULL, NULL),
(99, 99, 1, NULL, NULL),
(100, 100, 8, NULL, NULL),
(101, 101, 1, NULL, NULL),
(102, 102, 2, NULL, NULL),
(103, 103, 1, NULL, NULL),
(104, 104, 8, NULL, NULL),
(105, 105, 8, NULL, NULL),
(106, 106, 6, NULL, NULL),
(107, 107, 8, NULL, NULL),
(108, 108, 1, NULL, NULL),
(109, 109, 1, NULL, NULL),
(110, 110, 1, NULL, NULL),
(111, 111, 1, NULL, NULL),
(112, 112, 1, NULL, NULL),
(113, 113, 1, NULL, NULL),
(114, 114, 1, NULL, NULL),
(115, 115, 1, NULL, NULL),
(116, 116, 1, NULL, NULL),
(117, 117, 1, NULL, NULL),
(118, 118, 1, NULL, NULL),
(119, 119, 4, NULL, NULL),
(120, 120, 4, NULL, NULL),
(121, 121, 4, NULL, NULL),
(122, 122, 3, NULL, NULL),
(123, 123, 3, NULL, NULL),
(124, 124, 4, NULL, NULL),
(125, 125, 4, NULL, NULL),
(127, 127, 3, NULL, NULL),
(128, 128, 3, NULL, NULL),
(130, 126, 3, NULL, NULL),
(131, 130, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `discount_type` enum('percentage','fixed_amount') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `max_discount_amount` decimal(15,2) DEFAULT NULL,
  `min_order_value` decimal(15,2) DEFAULT NULL,
  `usage_limit_per_voucher` int UNSIGNED DEFAULT NULL,
  `usage_limit_per_user` int UNSIGNED DEFAULT NULL,
  `times_used` int UNSIGNED NOT NULL DEFAULT '0',
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `applies_to` enum('all_products','specific_brands','specific_categories') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'all_products',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `name`, `code`, `description`, `discount_type`, `discount_value`, `max_discount_amount`, `min_order_value`, `usage_limit_per_voucher`, `usage_limit_per_user`, `times_used`, `start_date`, `end_date`, `is_active`, `applies_to`, `created_at`, `updated_at`) VALUES
(1, 'di theo anh mat troi', '4D8V4Q', 'hehe', 'percentage', '25.00', '100000.00', '0.00', 10, 1, 0, '2025-07-22 00:00:00', '2025-08-09 00:00:00', 1, 'all_products', '2025-07-23 18:45:24', '2025-07-31 15:13:49'),
(2, 'Short Skirt', '3D4JD5', 'adawdwdawd', 'fixed_amount', '500000.00', NULL, '10000000.00', 42, 1, 0, '2025-07-22 00:00:00', '2025-08-10 00:00:00', 1, 'all_products', '2025-07-26 06:41:22', '2025-07-26 06:41:22'),
(3, 'Nguyễn Tiến Thuận', 'VNPAY123', 'sqwfgh', 'percentage', '40.00', '1000000.00', '10000000.00', 130, 2, 0, '2025-07-23 00:00:00', '2025-08-10 00:00:00', 1, 'all_products', '2025-07-31 15:15:11', '2025-07-31 15:15:11'),
(4, 'MOMO12332252', 'MOMO123', 'dFESRGTHYTGRFDAFRG', 'percentage', '50.00', '2000000.00', '20000000.00', 24, 2, 0, '2025-07-27 00:00:00', '2025-08-28 00:00:00', 1, 'all_products', '2025-08-01 05:47:08', '2025-08-01 05:47:08');

-- --------------------------------------------------------

--
-- Table structure for table `promotion_brand`
--

CREATE TABLE `promotion_brand` (
  `promotion_id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotion_category`
--

CREATE TABLE `promotion_category` (
  `promotion_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `order_item_id` bigint UNSIGNED NOT NULL,
  `rating` tinyint UNSIGNED NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `admin_reply` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `admin_reply_created_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `order_item_id`, `rating`, `comment`, `status`, `admin_reply`, `admin_reply_created_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(31, 12, 75, 61, 4, 'aaaaaaa', 'approved', NULL, NULL, '2025-07-26 05:20:35', '2025-07-26 05:20:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1aDDQYOHcHkoO1i4uyUvwNNyfWQ85qI1aNut0vh3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid2Q2MHdsTGJYSGVodjdvelBwVjJ0Rjl6aXdmWGZFajZwZllxb2NGMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8ud2VsbC1rbm93bi9hcHBzcGVjaWZpYy9jb20uY2hyb21lLmRldnRvb2xzLmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1755705414),
('27DqXut3I5MA6t8rsH3mKIQtxOZV1f1DFrFrSfIz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYmpTQ00wRThsSFRGdTBsU1BkSXdENHZFMWdpSnFVVTU1WFV4ekphNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbWFnZXMvcHJvZHVjdHMvNjhhNDhiYmE3MmUwNF8xNzU1NjE0MTM4LmpwZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755707992),
('4g82rmnscyOGDYYrADnw0FgUcI0zFvhQXoEuUax4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ1JGZlA3cVc0N0tId0Zub0FLeThMZVF1S3B4YXE3SVRUTEdVckV4NSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755707983),
('5TmeyGRHoLZ4vN5yxO262drAW9jr6ba9LLcGn5Xd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZU1vTWpoVDJhNEhCMFF5dnljSFdST2tHQTV3bTBHRVc4eGZORE9WOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaGlwcGVyLWFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755709970),
('7eb1HbOf4lUlBnut9dnPJVP6JfFxw2bnzDoW0lQX', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoidVl4R0NVQ3FwUEcyS3JqTVVqa2pQMXFJOEt6YW5pc055cVgyaHY1ViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1755708067),
('7vGeBBUowOf2R4aRv6G9BvpFhEAqgk0qiGZCikBH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRk4zZEROWnFNZXpraGprRjFlVUJSalpiam1BYUFTajdsdHhJc3BkVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8ud2VsbC1rbm93bi9hcHBzcGVjaWZpYy9jb20uY2hyb21lLmRldnRvb2xzLmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1755705447),
('9HkmrFKp1TyvEZW7jb3bbyq4HH4S2gxoj6OU5oIC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib3JQWFhWV0RaUjVJZWRaQ0JSQ0NJdzJBZlBTRjFhMm5VTlpmcnUyNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8ud2VsbC1rbm93bi9hcHBzcGVjaWZpYy9jb20uY2hyb21lLmRldnRvb2xzLmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1755705565),
('Ab8b2ItV35orSO02LJUtURKAAKZ3t59JJG2Y7ndN', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMWJkWGlSZGllWVZNeDRPTllRU28ySTB6V0tZbUVnZnh0Nk9abGFMQSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9tZXNzYWdlcyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEyO30=', 1755710450),
('aLMXLodBX53vAteMYFx6h07ibo1Y0fBPLhoeDGdy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUhTeHowVm55VURFSjdsTzAyWU1NT3VhQlpvQUJIQU9OSDZTQ0libyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaGlwcGVyLWFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755705414),
('AVRA5gHhCTpSz5WEDCBVpgaOQn0UcOJLXW8AIcTS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaERmZ1R5Sk95N2RpTUNZa0Nja1ZhWk9udkZxdmk5d3FpZ05QVURJOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaGlwcGVyLWFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755705559),
('bIMPWplfP6h9npw7DWgu8oVtJKXQZ2cfHYzsn7Vw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidzk2c3A5QWhiRFBWcmhuUVNqbHYzUXVycmd4Rlc5UTFXWjlqVXZTMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaGlwcGVyLWFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755710235),
('E2z3hkwoSBjC1Eqzy8HyEjByURndaLBg1bWA8MqI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieWpsa2hIT3NvWHdlanhHUkJDVzd0YlRVUzNFR0dHQVlDd3l6YncyRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaGlwcGVyLWFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755705564),
('ECWkeRgaezNM0jqWArjjbZ5Amse1snQwiLFLLJQo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMENhM3JBNUpmSEVLV2pZenk5U1lSVVd4V082NmJzV2FDc1F4dXVVTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaGlwcGVyLWFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755709970),
('fvqSonQFTGLQjrQdN2FnPzuQDAkRdCaVrHAbyVm3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZURKUFV0OTY5UENhMkpBSmFMSTFPY0Vua0FsOWJaWG10ZTNmUzVXdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaGlwcGVyLWFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755705577),
('glKm6lXSyXTRvZHqc5F7Ejc8ICBAffcf4XMiBvUG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoidW5hU25CbHB2WXc4eVI4d05FZlV3eXdWVXJZWlpwVnFwZkpLTGhvMCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1755708032),
('HGTFbLqI5gOHh3DVm4QAubZLVTsgOsTOIs1EOhjL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoialJhN0VrSXJ0eEh1QzhPcXFSdU1rT3VkTFZYcUwybmFnR2wxeWxkSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755708039),
('HTHuMwF7vHcCeGNHPlVz13m7XfZ1nJTGhc2eNK1N', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS25VVXJLOFVQbkNYSTZXU1RVNkU2VlI4cTc2OWZtQ2twcTJESjdITSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755707960),
('in4dUEuktIoRjdm5lXJ7MrzZmbSaQMfiQJK3r0Fm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoicHlZZEd2d0lvVjNUdE5xMnBYYzJ4ZW9rTERjcFRTak9aZnNhcjJuZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1755707967),
('InE3v98NiEh9XbTHocw9L6tpNzz9ajtYTRNR60nu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoialZXd25IUWJlUlMwTUY3MUpSancxM2Nld2NSNXdSbWFmWUNWYzdxdCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1755708069),
('iOYTOovgfXLluuWLXQJucwSUkT0OtgE6bsFhWPGl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib3h5bmQxTTJVVXZGNGpBcjVoZHdQbm5kcElTQVhzcENQVDFTUXduSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaGlwcGVyLWFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755709969),
('jC8ZwD9xmwXmPAwETodV9FmdvP32HeZBTqoKGXxP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiZERGZHFjaVFZaTVvcWJxcFBoNzNVY3pxbXpoVE5kVEMzbWx4MnQ1ZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1755708012),
('lGSOUbkXCKPm7Ql4R091Ow1zsrVGqjZHjGPUK21d', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiMU1JUmQzeTdSeWxXRXJiVDhmZkNoUk5QUGhZY0lJbzY0a0dwSVVGTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1755708040),
('lo2u06D6iBwiTQni6OMsRLSd9VGPNIyHLQmyOC4D', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWpMbnhvUXVhS1o0eDc4ZzhETzNtZTczczZQUWM4WnRQUDRtbWJlUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755708006),
('M9txqkJT9q4GAVREQjk9hZ1YrnK7DgJpkMV11ycX', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSngwYnJkN2VyWjQwVENRcHE4dno2a2RmN09VMFBtY09mcVBGODhoZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9qcy9yYW5nbGUtc2xpZGVyLmpzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1755707991),
('MuE0muhIscxactYFfx4WPMgZegzcojuZ7xmDBkiC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2xMRmlxUGdINDQwbmM3T3RYMzU2UEtCd2tTUERGbTBPbmE0RnlUMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaGlwcGVyLWFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755709968),
('mvmAxt3OTw2fiiPls3EHGCXI8dKFZRU7sBGrd8CZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiWTB6NWc3Qm5sRTN0R2l1TU5VbThldmx3VDdQNFpDVHVQMnBROWlDVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1755708008),
('n1XLt6uqThXQEy9sd2uzfYpDjUgKVUgea5QfFtHQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMXBKMmlRS3BPREMwUVFLTDVKblBpZUxJOGNOWGZmMlF0M0syNkN6UiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaGlwcGVyLWFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755707921),
('oCvFtdxtEq4TA1t80a9sjV4uDinzEHDEdJ48wWws', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoicElZRXNySEVBZFZmd1BxR2ZJSW9nMklZZ1RkeHVXQUY1cU9pblJpZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1755707984),
('OVoYOjTyejmoQDaitHzGP5JgIsvBBRVFU5s5CyDi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYWloZGVadmY0RW9wSG11UUxrajlkMUt4a2xBdkE3VkQ5NFJWQ29hSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8ud2VsbC1rbm93bi9hcHBzcGVjaWZpYy9jb20uY2hyb21lLmRldnRvb2xzLmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1755705693),
('plgPn7JD44YX6Jfm6pC1fZeVlz2qonbRKJn1tBOp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTXgyODR1andKRmt2eVRhVmN4Zm5BVThLVnljUXFzU0hOVDZHVlgyUCI7czo1OiJzdGF0ZSI7czo0MDoiODZpT1d0aUFVRzZpdDBCYzFyMzVURHZXZXBaWE5sYzNxZk0zNkxBQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hdXRoL2dvb2dsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755708087),
('PLV1oejmxLCzVEZGhxyhSNn5d5OWDXtbRzv5EJJg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOEd1YzdFOUxNUEpKSW1NN0Vwb0NrTWx4cDBWb2FHRnlKWnI5ZkJrbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8ud2VsbC1rbm93bi9hcHBzcGVjaWZpYy9jb20uY2hyb21lLmRldnRvb2xzLmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1755705569),
('QrcpZTZaMqKBGd2e3ugZu0D8Jn39Ak4Pi8NwYx0d', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNWJPbUFUV1BIamVIbGZhNHRLYXFOTmNpUkdFMzM3MnI2SmF1ZGkzbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaGlwcGVyLWFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755709975),
('RAhpHnz795ZQnevyClMQVXqlcHTDsKHjM6XGKd2B', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHN5M0Nwa2dtcFhYemR1dTJzVXA1Y0g5WHhCUXNjVHpaU1dXVERIQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaGlwcGVyLWFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755705692),
('ReDL1eZHTNxQ7fI14fHRT14Ztc2cxopZ0kV2kEUu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUlJGeFBuS0kxb3hqYm1SclFZaDlYVWowaWthU2lobjZEY2h0Nmp5SiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755707983),
('Rz8Jaq7A0MWTS6vzK0pALKhYZNHTKmpV5TB3135q', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVGlzRTF3bDhyRTZWY3czd3lmMm85UTBzZTQ4TWRnR1FyS0xHZGtBdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8ud2VsbC1rbm93bi9hcHBzcGVjaWZpYy9jb20uY2hyb21lLmRldnRvb2xzLmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1755705560),
('SiqPeisA5t6kVFIBPnr9SWwOVjiAF6d1vzqCMqO1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiY2ttdVBEWk9jaGRhTGxzTmtkTmxwbHdHRTFBVGtHOTk4WlJldkxCViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1755707962),
('thdQ5gLT4css1qKmLidHMJZ7UZOpSwdPDxO5ATcJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVMzWElzYWFFQ1YxRzVIaXROYTloS05RZnNvY2ZqWlhQMkdUQ0F1NiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755708038),
('twwPJvHIeSMCSkyowOxhLOP8rX9dzFpFYEYU0f2w', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTldTN21RSXdQNjNxbGk1NkFIWDkzQVNCUDA2OWhjYUJyZmY1VEJTNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8ud2VsbC1rbm93bi9hcHBzcGVjaWZpYy9jb20uY2hyb21lLmRldnRvb2xzLmpzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1755705578),
('uCKvD7cCdIb1PiWGctj1VtR97FwM2O6pohXvo04d', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNXkxclRNazRnWVVoWjAyallzQmtibmwxWHFYa2NmNng2NlBQWW10QiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaGlwcGVyLWFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755705569),
('vCiWPNXbcZK5ooLJFv7bfKWqOP54sStZRdQiFSCz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR2lQM0k5U0w5YzdWNjhMNkV3UUlZV3JiVk96SHlISG82bmpzTWs5bSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaGlwcGVyLWFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755705446),
('Vn3WXCAVDNgavh3QcbawKzLiOTA64vVm22EjDjF6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUG5KdTV2NFVaRWpHd1o0anRRQ2MwSnFteXVpdUw2SUs3VVU3dElSZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755707990),
('VvujLz7avNHvr65c0xAtPNm9USzkRNYKXbftxNcc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOHMxUmg0NGFyV2dIdFlsamhVRGVTM056bWlEdThkbE52aDQzRzRsciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaGlwcGVyLWFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755710349),
('XdTlo3O1i8ozpMTi6szvXDpkPy75vZK5O4tJ2qiz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUDBta0JYcndCcFFoY3A1RVBxNDdJZlBXNGhGb2xDbkdoNVFJWTFIaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755707961),
('xVhW4lEtj2LoYIJleV4SXLUXFFvV1OZ0XFqrWf9O', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWFNnbHlkY3d0UzllcG5vNFpPV2dGN0lVRGZYTEJHV1JZeFVhcWFhRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaGlwcGVyLWFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755709974),
('ynd8dqGsq2soe6iu862OTMtOuSinNzfIcsyrNdaD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNHg4YU9aR1A2dE9EUk9jVlNkc3pRY1ExcGVlNnpuc093dWE1TXV0RyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaGlwcGVyLWFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755707936),
('z4LpUCSqSZAOPizGsQTWHOxIPImYVdww7wyZYqtg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNERzU0I2V1lrejVBS0VQUUkwVmpnQlo4Q0lKVGxzdlVTM0FFTFhGSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaGlwcGVyLWFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755709976);

-- --------------------------------------------------------

--
-- Table structure for table `shippers`
--

CREATE TABLE `shippers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `current_lat` decimal(10,8) DEFAULT NULL,
  `current_lng` decimal(11,8) DEFAULT NULL,
  `location_updated_at` timestamp NULL DEFAULT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT '0',
  `last_online_at` timestamp NULL DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `current_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accuracy` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippers`
--

INSERT INTO `shippers` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `status`, `remember_token`, `created_at`, `updated_at`, `current_lat`, `current_lng`, `location_updated_at`, `is_online`, `last_online_at`, `last_login_at`, `current_address`, `accuracy`) VALUES
(1, 'HoaCoLau3', 'h@gmail.com', NULL, '$2y$12$cHHMTi439coRY/Qh1oxsLeFsC35e3yx5OB3OkClERetw.L6yslLAy', '3252352335235', 'fadadar3we25423', 'active', NULL, '2025-08-20 15:52:17', '2025-08-20 15:52:17', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(2, 'HoaCoLau4', 'z@gmail.com', NULL, '$2y$12$qRtZ7nnRtl9bWQF5lRkhfOLwVwOTXlOnAfYcorNtDRgc.7hne0GDK', '3252352335235', 'fadadar3we25423', 'active', NULL, '2025-08-20 15:53:11', '2025-08-20 15:53:18', NULL, NULL, NULL, 0, NULL, '2025-08-20 15:53:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_methods`
--

CREATE TABLE `shipping_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cost` decimal(10,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_methods`
--

INSERT INTO `shipping_methods` (`id`, `name`, `description`, `cost`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Giao hàng tiêu chuẩn', 'Giao hàng trong 3-5 ngày làm việc', '30000.00', 1, '2025-07-09 06:27:30', '2025-07-09 06:27:30'),
(2, 'Giao hàng nhanh', 'Giao hàng trong 24h', '60000.00', 1, '2025-07-09 06:27:30', '2025-07-09 06:27:30'),
(3, 'Nhận tại cửa hàng', 'Nhận hàng trực tiếp tại cửa hàng', '0.00', 1, '2025-07-09 06:27:30', '2025-07-09 06:27:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_status` enum('active','inactive','banned') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `role` enum('user','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `phone_number`, `avatar_url`, `account_status`, `role`, `remember_token`, `created_at`, `updated_at`, `google_id`) VALUES
(1, 'Quản trị viên', 'admin@gmail.com', NULL, '$2y$12$h/t4WaDlt0xprgVuE6KyruoL95KjYRJUTwzopomFAJQFkJXZj9iQm', NULL, NULL, NULL, NULL, NULL, 'active', 'admin', NULL, '2025-07-09 06:27:25', '2025-07-09 06:27:25', NULL),
(2, 'Bác. Bảo Liên Quân', 'tong.huynh@example.net', NULL, '$2y$12$27pah4ger0R1EV2Rnng2AOClBe.rcTkDYppWw8MQqV//G1vMtO0vi', NULL, NULL, NULL, NULL, NULL, 'active', 'user', NULL, '2025-07-09 06:27:25', '2025-07-09 06:27:25', NULL),
(3, 'Bác. Kiều Chiêu Toàn', 'gbien@example.org', NULL, '$2y$12$QayhadOqfNSGz9xlIGG/wenZbO86F7rnAiS0j3os4jTJ4dZYjSxCi', NULL, NULL, NULL, NULL, NULL, 'active', 'user', NULL, '2025-07-09 06:27:26', '2025-07-09 06:27:26', NULL),
(4, 'Phùng Họa Quyên', 'tra54@example.org', NULL, '$2y$12$blVjJR1LHaO6HxrU1fMpFe3MzhXC9VBNVTkF7PzA5iEFCENm0BEvK', NULL, NULL, NULL, NULL, NULL, 'active', 'user', NULL, '2025-07-09 06:27:26', '2025-07-09 06:27:26', NULL),
(5, 'Ông. Lục Hùng Trung', 'dao20@example.org', NULL, '$2y$12$9tlB37ezQKSkYiqMO7Vhuen4Ue//mhyVPYxVoZm/CCcIRxC047un2', NULL, NULL, NULL, NULL, NULL, 'active', 'user', NULL, '2025-07-09 06:27:27', '2025-07-09 06:27:27', NULL),
(6, 'Khưu Lương', 'dieu07@example.org', NULL, '$2y$12$3luA/eSdHXUhMQcjg1hWC.FQ.fytPujyTygcyhfVSP7yi4.U92nli', NULL, NULL, NULL, NULL, NULL, 'active', 'user', NULL, '2025-07-09 06:27:27', '2025-07-09 06:27:27', NULL),
(7, 'Bác. Cam Thoại', 'elai@example.org', NULL, '$2y$12$8H8xV6zKOLJz/Ln2OYIXF.69dNddpUMIjze7rrRPoYd/RozsGhgkG', NULL, NULL, NULL, NULL, NULL, 'active', 'user', NULL, '2025-07-09 06:27:28', '2025-07-09 06:27:28', NULL),
(8, 'Yên Hùng Hành', 'udan@example.com', NULL, '$2y$12$cVT7tzJKXROeGXSvotrRK.Xwu6kmDp4zyVAx8k8Ii1xHrMIpUA0m.', NULL, NULL, NULL, NULL, NULL, 'active', 'user', NULL, '2025-07-09 06:27:28', '2025-07-09 06:27:28', NULL),
(9, 'Tiêu Hạc Cầm', 'nhien63@example.net', NULL, '$2y$12$U6bVt/mAtmE200Wy/7T0y.QM7TjVafWo0JH8z2oikhfEbaxZaWcYm', NULL, NULL, NULL, NULL, NULL, 'active', 'user', NULL, '2025-07-09 06:27:29', '2025-07-09 06:27:29', NULL),
(10, 'Lô Cường Thạch', 'abui@example.net', NULL, '$2y$12$X8/ygdfqY8E6pxKgzVtDc.CymEx/N9o3XHPpQx58cB6K5ZqdMiErO', NULL, NULL, NULL, NULL, NULL, 'active', 'user', NULL, '2025-07-09 06:27:29', '2025-07-09 06:27:29', NULL),
(11, 'Phương Chấn', 'giap.khanh@example.org', NULL, '$2y$12$.xZCJAQoqOELlREJYmtTKOznJ60Vz09R2D1PQZjnUdYvQbF0mrYYq', NULL, NULL, NULL, NULL, NULL, 'active', 'user', NULL, '2025-07-09 06:27:30', '2025-07-09 06:27:30', NULL),
(12, 'Nguyễn Tiến Thuận', 'z@gmail.com', NULL, '$2y$12$Ae3k.o4eXqQb0WkyCazCWOqkSiZPsu50wRia1Z/xTVHCWf.ajtnUa', NULL, NULL, NULL, '0373607863', NULL, 'active', 'admin', NULL, '2025-07-09 06:28:21', '2025-07-09 06:28:21', NULL),
(13, 'Nguyễn Tiến Thuận', 'b@gmail.com', NULL, '$2y$12$1kK931Y2dezVVK8HkKsPye46j0D3VuA8csQMG3KXEbKD5eJhvDRcW', NULL, NULL, NULL, '0373607863', NULL, 'active', 'user', NULL, '2025-07-11 02:11:23', '2025-07-11 02:11:23', NULL),
(14, 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', NULL, '$2y$12$nIl3JZxSgj4asPVcSui4BuiTluTMBUs8VkYcXBWvx7NK6lQiSRiAe', NULL, NULL, NULL, '0373607863', NULL, 'active', 'user', NULL, '2025-07-16 19:44:27', '2025-07-26 07:36:35', '117797978250199695573'),
(15, 'Nguyễn Tiến Thuận', 'c@gmail.com', NULL, '$2y$12$/KO8nivdAcDSFjKhIeMStOdWgq8C/dlz.D9V4eoxtIpNWQpLhgnK2', NULL, NULL, NULL, '0373607863', NULL, 'active', 'admin', NULL, '2025-07-26 07:38:30', '2025-07-26 07:38:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-07-09 06:27:25', '2025-07-09 06:27:25'),
(2, 3, '2025-07-09 06:27:26', '2025-07-09 06:27:26'),
(3, 4, '2025-07-09 06:27:26', '2025-07-09 06:27:26'),
(4, 5, '2025-07-09 06:27:27', '2025-07-09 06:27:27'),
(5, 6, '2025-07-09 06:27:27', '2025-07-09 06:27:27'),
(6, 7, '2025-07-09 06:27:28', '2025-07-09 06:27:28'),
(7, 8, '2025-07-09 06:27:28', '2025-07-09 06:27:28'),
(8, 9, '2025-07-09 06:27:29', '2025-07-09 06:27:29'),
(9, 10, '2025-07-09 06:27:29', '2025-07-09 06:27:29'),
(10, 11, '2025-07-09 06:27:30', '2025-07-09 06:27:30'),
(11, 12, '2025-07-10 07:31:27', '2025-07-10 07:31:27');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_items`
--

CREATE TABLE `wishlist_items` (
  `id` bigint UNSIGNED NOT NULL,
  `wishlist_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlist_items`
--

INSERT INTO `wishlist_items` (`id`, `wishlist_id`, `product_id`, `created_at`) VALUES
(10, 11, 76, '2025-07-11 13:42:46'),
(14, 11, 73, '2025-08-04 04:03:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cart_items_cart_id_product_id_product_variant_id_unique` (`cart_id`,`product_id`,`product_variant_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`),
  ADD KEY `cart_items_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_submissions_replied_by_foreign` (`replied_by`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_conversation_id_foreign` (`conversation_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_read_at_index` (`user_id`,`read_at`),
  ADD KEY `notifications_shipper_id_read_at_index` (`shipper_id`,`read_at`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_code_unique` (`order_code`),
  ADD KEY `orders_shipper_id_foreign` (`shipper_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `order_promotion`
--
ALTER TABLE `order_promotion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_promotion_order_id_foreign` (`order_id`),
  ADD KEY `order_promotion_promotion_id_foreign` (`promotion_id`);

--
-- Indexes for table `order_status_histories`
--
ALTER TABLE `order_status_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_status_histories_order_id_foreign` (`order_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`),
  ADD KEY `pages_author_id_foreign` (`author_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD KEY `password_reset_tokens_email_index` (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_methods_code_unique` (`code`);

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
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`),
  ADD KEY `product_variants_image_id_foreign` (`image_id`);

--
-- Indexes for table `product_variant_attribute_values`
--
ALTER TABLE `product_variant_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pvav_variant_value_unique` (`product_variant_id`,`attribute_value_id`),
  ADD KEY `product_variant_attribute_values_attribute_value_id_foreign` (`attribute_value_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `promotions_code_unique` (`code`);

--
-- Indexes for table `promotion_brand`
--
ALTER TABLE `promotion_brand`
  ADD PRIMARY KEY (`promotion_id`,`brand_id`),
  ADD KEY `promotion_brand_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `promotion_category`
--
ALTER TABLE `promotion_category`
  ADD PRIMARY KEY (`promotion_id`,`category_id`),
  ADD KEY `promotion_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_order_item_id_foreign` (`order_item_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shippers`
--
ALTER TABLE `shippers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shippers_email_unique` (`email`);

--
-- Indexes for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_google_id_unique` (`google_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_unique` (`user_id`);

--
-- Indexes for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlist_items_wishlist_id_product_id_unique` (`wishlist_id`,`product_id`),
  ADD KEY `wishlist_items_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `order_promotion`
--
ALTER TABLE `order_promotion`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_status_histories`
--
ALTER TABLE `order_status_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `product_variant_attribute_values`
--
ALTER TABLE `product_variant_attribute_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `shippers`
--
ALTER TABLE `shippers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  ADD CONSTRAINT `contact_submissions_replied_by_foreign` FOREIGN KEY (`replied_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_shipper_id_foreign` FOREIGN KEY (`shipper_id`) REFERENCES `shippers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_shipper_id_foreign` FOREIGN KEY (`shipper_id`) REFERENCES `shippers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `order_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `order_promotion`
--
ALTER TABLE `order_promotion`
  ADD CONSTRAINT `order_promotion_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_promotion_promotion_id_foreign` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `order_status_histories`
--
ALTER TABLE `order_status_histories`
  ADD CONSTRAINT `order_status_histories_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `product_images` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variant_attribute_values`
--
ALTER TABLE `product_variant_attribute_values`
  ADD CONSTRAINT `product_variant_attribute_values_attribute_value_id_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variant_attribute_values_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `promotion_brand`
--
ALTER TABLE `promotion_brand`
  ADD CONSTRAINT `promotion_brand_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `promotion_brand_promotion_id_foreign` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `promotion_category`
--
ALTER TABLE `promotion_category`
  ADD CONSTRAINT `promotion_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `promotion_category_promotion_id_foreign` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  ADD CONSTRAINT `wishlist_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_items_wishlist_id_foreign` FOREIGN KEY (`wishlist_id`) REFERENCES `wishlists` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
