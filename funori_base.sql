-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 25, 2025 at 05:32 PM
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

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_location_update_2', 'i:1;', 1756136586),
('laravel_cache_location_update_2:timer', 'i:1756136586;', 1756136586);

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
(6, 14, '2025-08-01 00:45:50', '2025-08-01 00:45:50'),
(7, 156, '2025-08-25 14:50:29', '2025-08-25 14:50:29');

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
(32, 5, 43, 77, 1, '11000000.00', '2025-08-03 11:58:06', '2025-08-03 11:58:06'),
(33, 5, 73, 118, 1, '14000000.00', '2025-08-04 04:03:27', '2025-08-04 04:03:27'),
(55, 7, 26, 28, 1, '22000000.00', '2025-08-25 16:44:14', '2025-08-25 16:44:14'),
(57, 2, 77, 128, 1, '32000000.00', '2025-08-25 16:58:51', '2025-08-25 16:58:51');

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
-- Table structure for table `chat_suggestions`
--

CREATE TABLE `chat_suggestions` (
  `id` bigint UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_suggestions`
--

INSERT INTO `chat_suggestions` (`id`, `content`, `created_at`, `updated_at`) VALUES
(3, 'Địa chỉ của shop ở đâu ?', '2025-08-22 09:42:21', '2025-08-25 14:04:32'),
(4, 'Có chương trình khuyến mãi nào hôm nay không?', '2025-08-25 14:03:57', '2025-08-25 14:03:57'),
(7, 'Cửa hàng có hỗ trợ giao hàng tận nơi không?', '2025-08-25 14:05:01', '2025-08-25 14:05:01'),
(9, 'Có thể thanh toán qua VNPAY/MOMO không?', '2025-08-25 14:05:30', '2025-08-25 14:05:30'),
(10, 'Xin chào! Tôi có thể được tư vấn chọn nội thất phòng khách không?', '2025-08-25 14:05:46', '2025-08-25 14:05:46');

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
(1, 12, NULL, '2025-08-22 10:21:24', '2025-08-03 11:54:34', '2025-08-22 10:21:24'),
(2, 13, NULL, '2025-08-25 14:45:27', '2025-08-22 10:22:40', '2025-08-25 14:45:27'),
(3, 14, NULL, '2025-08-24 15:43:50', '2025-08-24 15:42:50', '2025-08-24 15:43:50'),
(4, 156, NULL, '2025-08-25 16:05:22', '2025-08-25 15:06:18', '2025-08-25 16:05:22');

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
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `files` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_id`, `admin_id`, `content`, `is_admin`, `created_at`, `updated_at`, `files`) VALUES
(1, 1, 12, NULL, 'alo', 0, '2025-08-03 11:57:23', '2025-08-03 11:57:23', '[]'),
(2, 1, 12, 12, 'hehe', 1, '2025-08-03 11:57:37', '2025-08-03 11:57:37', NULL),
(3, 1, 12, NULL, '/strong', 0, '2025-08-22 09:21:50', '2025-08-22 09:21:50', '[]'),
(4, 1, 12, NULL, 'Xin Chao', 0, '2025-08-22 10:08:58', '2025-08-22 10:08:58', '[]'),
(5, 1, 12, NULL, '/strong', 0, '2025-08-22 10:13:22', '2025-08-22 10:13:22', '[]'),
(6, 1, 12, NULL, 'Dia chi cua shop o dau', 0, '2025-08-22 10:21:16', '2025-08-22 10:21:16', '[]'),
(7, 1, 12, NULL, '🙏', 0, '2025-08-22 10:21:18', '2025-08-22 10:21:18', '[]'),
(8, 1, 12, NULL, '👍', 0, '2025-08-22 10:21:21', '2025-08-22 10:21:21', '[]'),
(9, 1, 12, NULL, '😘', 0, '2025-08-22 10:21:24', '2025-08-22 10:21:24', '[]'),
(10, 2, 13, NULL, '🙏', 0, '2025-08-22 10:22:40', '2025-08-22 10:22:40', '[]'),
(11, 2, 13, NULL, 'Xin Chao', 0, '2025-08-22 10:33:09', '2025-08-22 10:33:09', '[]'),
(12, 2, 13, NULL, 'Xin Chao', 0, '2025-08-22 10:33:14', '2025-08-22 10:33:14', '[]'),
(13, 2, 12, 12, 'adadada', 1, '2025-08-22 10:33:28', '2025-08-22 10:33:28', NULL),
(14, 2, 13, NULL, 'Dia chi cua shop o dau', 0, '2025-08-22 10:33:32', '2025-08-22 10:33:32', '[]'),
(15, 2, 13, NULL, 'Dia chi cua shop o dau', 0, '2025-08-22 10:33:44', '2025-08-22 10:33:44', '[]'),
(16, 2, 13, NULL, 'Dia chi cua shop o dau', 0, '2025-08-22 10:34:22', '2025-08-22 10:34:22', '[]'),
(17, 2, 12, 12, 'dâdada', 1, '2025-08-22 10:47:41', '2025-08-22 10:47:41', NULL),
(18, 2, 12, 12, 'toi co the giup gi cho ba', 1, '2025-08-22 10:48:53', '2025-08-22 10:48:53', NULL),
(19, 2, 13, NULL, 'adada', 0, '2025-08-22 10:52:41', '2025-08-22 10:52:41', '[]'),
(20, 2, 13, NULL, 'adad', 0, '2025-08-22 10:55:34', '2025-08-22 10:55:34', '[]'),
(21, 2, 13, NULL, 'Dia chi cua shop o dau', 0, '2025-08-22 10:56:06', '2025-08-22 10:56:06', '[]'),
(22, 2, 13, NULL, '🙏🙏🎉🎉', 0, '2025-08-22 11:15:41', '2025-08-22 11:15:41', '[]'),
(23, 2, 13, NULL, '😀😃😄😄😁😆🙂🤣😅😅😙', 0, '2025-08-22 11:25:03', '2025-08-22 11:25:03', '[]'),
(24, 2, 13, NULL, 'Dia chi cua shop o dau', 0, '2025-08-22 12:00:59', '2025-08-22 12:00:59', '[]'),
(25, 2, 13, NULL, 'Xin Chao', 0, '2025-08-22 12:14:59', '2025-08-22 12:14:59', '[]'),
(26, 2, 13, NULL, 'Dia chi cua shop o dau', 0, '2025-08-22 12:17:47', '2025-08-22 12:17:47', '[]'),
(27, 2, 13, NULL, 'Xin Chao', 0, '2025-08-22 12:40:36', '2025-08-22 12:40:36', '[]'),
(28, 2, 13, NULL, 'Dia chi cua shop o dau', 0, '2025-08-22 12:40:38', '2025-08-22 12:40:38', '[]'),
(29, 2, 13, NULL, 'Dia chi cua shop o dau', 0, '2025-08-23 16:01:11', '2025-08-23 16:01:11', '[]'),
(30, 2, 12, 12, 'adada', 1, '2025-08-23 16:08:18', '2025-08-23 16:08:18', NULL),
(31, 2, 12, 12, 'adada', 1, '2025-08-23 16:11:02', '2025-08-23 16:11:02', NULL),
(32, 2, 12, 12, '/strong', 1, '2025-08-23 16:11:15', '2025-08-23 16:11:15', NULL),
(33, 2, 12, 12, '/strong', 1, '2025-08-23 16:11:16', '2025-08-23 16:11:16', NULL),
(34, 2, 13, NULL, '😛', 0, '2025-08-23 16:13:01', '2025-08-23 16:13:01', '[]'),
(35, 2, 13, NULL, '👍', 0, '2025-08-23 16:13:12', '2025-08-23 16:13:12', '[]'),
(36, 2, 13, NULL, '', 0, '2025-08-23 16:15:49', '2025-08-23 16:15:49', '[\"\\/chat_files\\/68a9e9351a29e_image.png\"]'),
(37, 2, 12, 12, '', 1, '2025-08-23 16:26:26', '2025-08-23 16:26:26', '[\"http:\\/\\/127.0.0.1:8000\\/chat_files\\/68a9ebb2bde98_imgi_2882_nha-xinh-phong-ngu-giuong-ngu-go-hien-dai-pop-5.jpg\"]'),
(38, 2, 13, NULL, 'Dia chi cua shop o dau', 0, '2025-08-23 16:27:56', '2025-08-23 16:27:56', '[]'),
(39, 2, 13, NULL, '😔', 0, '2025-08-23 16:27:59', '2025-08-23 16:27:59', '[]'),
(40, 2, 13, NULL, 'Xin Chao', 0, '2025-08-23 16:30:04', '2025-08-23 16:30:04', '[]'),
(41, 2, 13, NULL, 'Dia chi cua shop o dau', 0, '2025-08-23 16:30:24', '2025-08-23 16:30:24', '[]'),
(42, 2, 13, NULL, 'Xin Chao', 0, '2025-08-23 16:36:35', '2025-08-23 16:36:35', '[]'),
(43, 2, 13, NULL, '', 0, '2025-08-23 16:36:44', '2025-08-23 16:36:44', '[\"\\/chat_files\\/68a9ee1c02717_bg.jpg\"]'),
(44, 2, 12, 12, '😍', 1, '2025-08-23 16:42:33', '2025-08-23 16:42:33', NULL),
(45, 2, 12, 12, '🎵', 1, '2025-08-23 16:47:42', '2025-08-23 16:47:42', NULL),
(46, 2, 13, NULL, '', 0, '2025-08-23 17:27:34', '2025-08-23 17:27:34', '[\"\\/chat_files\\/68a9fa06a11ce_bg.jpg\"]'),
(47, 2, 12, 12, '', 1, '2025-08-23 17:27:42', '2025-08-23 17:27:42', '[\"http:\\/\\/127.0.0.1:8000\\/chat_files\\/68a9fa0e788c6_imgi_3339_Sofa-Wave-da-L1U-3-1536x1536.jpg\"]'),
(48, 3, 14, NULL, 'Xin Chao', 0, '2025-08-24 15:42:50', '2025-08-24 15:42:50', '[]'),
(49, 3, 12, 12, 'toi co the giup gi cho ban', 1, '2025-08-24 15:43:06', '2025-08-24 15:43:06', NULL),
(50, 3, 14, NULL, 'Dia chi cua shop o dau', 0, '2025-08-24 15:43:23', '2025-08-24 15:43:23', '[]'),
(51, 3, 14, NULL, '😔', 0, '2025-08-24 15:43:29', '2025-08-24 15:43:29', '[\"\\/chat_files\\/68ab33217a33c_slider-3.jpg\"]'),
(52, 3, 14, NULL, '', 0, '2025-08-24 15:43:50', '2025-08-24 15:43:50', '[\"\\/chat_files\\/68ab33366cf37_bg.jpg\"]'),
(53, 3, 12, 12, '😍', 1, '2025-08-24 15:44:27', '2025-08-24 15:44:27', '[\"http:\\/\\/127.0.0.1:8000\\/chat_files\\/68ab335b68637_imgi_2882_nha-xinh-phong-ngu-giuong-ngu-go-hien-dai-pop-5.jpg\"]'),
(54, 2, 12, 12, 'a', 1, '2025-08-25 14:02:30', '2025-08-25 14:02:30', NULL),
(55, 2, 13, NULL, 'a', 0, '2025-08-25 14:09:22', '2025-08-25 14:09:22', '[]'),
(56, 2, 13, NULL, 'Xin chào! Tôi có thể được tư vấn chọn nội thất phòng khách không?', 0, '2025-08-25 14:45:27', '2025-08-25 14:45:27', '[]'),
(57, 4, 156, NULL, 'Xin chào! Tôi có thể được tư vấn chọn nội thất phòng khách không?                🤩', 0, '2025-08-25 15:06:18', '2025-08-25 15:06:18', '[]'),
(58, 4, 12, 12, 'co a😄', 1, '2025-08-25 15:06:31', '2025-08-25 15:06:31', NULL),
(59, 4, 156, NULL, 'Địa chỉ của shop ở đâu ?', 0, '2025-08-25 16:05:15', '2025-08-25 16:05:15', '[]'),
(60, 4, 156, NULL, '😔', 0, '2025-08-25 16:05:22', '2025-08-25 16:05:22', '[]'),
(61, 4, 12, 12, 'fpt poly', 1, '2025-08-25 16:05:35', '2025-08-25 16:05:35', NULL);

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
(50, '2025_08_11_230542_create_jobs_table', 6),
(51, '2024_12_19_000000_create_refunds_table', 7),
(52, '2025_01_15_000000_add_pending_refund_to_orders_table', 7),
(53, '2025_08_19_091515_add_vnp_transaction_date_to_orders_table', 7),
(54, '2025_08_19_095707_add_transaction_id_to_orders_table', 7),
(55, '2025_08_22_162534_chat_suggestions', 7),
(56, '2025_08_22_174139_add_admin_id_to_messages_table', 8);

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
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `pending_refund` tinyint(1) NOT NULL DEFAULT '0',
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
  `delivery_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vnp_transaction_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vnp_transaction_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `shipper_id`, `received_at`, `in_delivery_at`, `failed_at`, `delivery_notes`, `failure_reason`, `delivery_images`, `order_code`, `transaction_id`, `customer_name`, `customer_email`, `customer_phone`, `shipping_address`, `buyer_name`, `buyer_email`, `buyer_phone`, `buyer_address`, `subtotal_amount`, `shipping_fee`, `discount_amount`, `discount_code`, `tax_amount`, `total_amount`, `payment_method_id`, `payment_status`, `payment_details`, `shipping_method_id`, `order_status`, `customer_note`, `admin_note`, `ordered_at`, `processing_at`, `shipped_at`, `delivered_at`, `cancelled_at`, `returned_at`, `cancellation_reason`, `pending_refund`, `previous_status`, `created_at`, `updated_at`, `shipping_name`, `shipping_phone`, `shipping_email`, `shipping_lat`, `shipping_lng`, `delivery_lat`, `delivery_lng`, `delivery_started_at`, `delivery_completed_at`, `delivery_address`, `vnp_transaction_no`, `vnp_transaction_date`) VALUES
(21, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-686FC9ED8AA61', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '3rwr34534534535, Phường Gia Thụy, Quận Long Biên, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '3rwr34534534535, Phường Gia Thụy, Quận Long Biên, Thành phố Hà Nội', '139500000.00', '60000.00', '0.00', NULL, '0.00', '139560000.00', 1, 'pending', NULL, 2, 'pending_confirmation', 'safs', NULL, '2025-07-10 07:10:53', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-10 07:10:53', '2025-07-10 07:10:53', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-686FCF60B918B', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'rada, Xã Mê Linh, Huyện Mê Linh, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'rada, Xã Mê Linh, Huyện Mê Linh, Thành phố Hà Nội', '64000000.00', '0.00', '0.00', NULL, '0.00', '64000000.00', 1, 'pending', NULL, 3, 'delivered', NULL, NULL, '2025-07-10 07:34:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-10 07:34:08', '2025-07-10 07:34:08', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6870DAED30FE1', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '34567ytgrf, Phường Tứ Liên, Quận Tây Hồ, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '34567ytgrf, Phường Tứ Liên, Quận Tây Hồ, Thành phố Hà Nội', '52000000.00', '60000.00', '0.00', NULL, '0.00', '52060000.00', 1, 'pending', NULL, 2, 'delivered', NULL, NULL, '2025-07-11 02:35:41', '2025-07-14 19:13:20', '2025-07-14 19:13:27', NULL, NULL, NULL, NULL, 0, NULL, '2025-07-11 02:35:41', '2025-07-14 19:13:27', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6870DB635BDDC', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '34565, Xã Mê Linh, Huyện Mê Linh, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '3rwr34534534535, Phường Quảng An, Quận Tây Hồ, Thành phố Hà Nội', '59999997.00', '60000.00', '0.00', NULL, '0.00', '60059997.00', 2, 'pending', NULL, 2, 'delivered', NULL, NULL, '2025-07-11 02:37:39', '2025-07-14 19:33:06', '2025-07-14 19:33:11', NULL, NULL, NULL, NULL, 0, NULL, '2025-07-11 02:37:39', '2025-07-14 19:33:11', 'THuan', '0373607863', 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6870DC38A8F80', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '3rwr34534534535, Phường Xuân Tảo, Quận Bắc Từ Liêm, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '3rwr34534534535, Phường Xuân Tảo, Quận Bắc Từ Liêm, Thành phố Hà Nội', '51000000.00', '60000.00', '0.00', NULL, '0.00', '51060000.00', 2, 'pending', NULL, 2, 'delivered', NULL, NULL, '2025-07-11 02:41:12', '2025-07-14 19:06:25', '2025-07-14 19:06:28', '2025-07-14 19:11:31', NULL, '2025-07-14 19:13:07', NULL, 0, NULL, '2025-07-11 02:41:12', '2025-07-14 19:13:07', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6870DD1F33D73', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'e3rwrfw, Phường Đức Giang, Quận Long Biên, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'e3rwrfw, Phường Đức Giang, Quận Long Biên, Thành phố Hà Nội', '90000000.00', '60000.00', '0.00', NULL, '0.00', '90060000.00', 2, 'pending', NULL, 2, 'delivered', NULL, NULL, '2025-07-11 02:45:03', '2025-07-14 19:03:58', '2025-07-14 19:04:10', '2025-07-14 19:06:02', NULL, NULL, NULL, 0, NULL, '2025-07-11 02:45:03', '2025-07-14 19:06:02', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6881915CA922A', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '3rwr34534534535, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '3rwr34534534535, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '39999998.00', '30000.00', '0.00', NULL, '0.00', '40029998.00', 1, 'pending', NULL, 1, 'delivered', NULL, NULL, '2025-07-23 18:50:20', '2025-07-23 18:50:50', '2025-07-23 18:50:53', '2025-07-23 18:50:54', NULL, NULL, NULL, 0, NULL, '2025-07-23 18:50:20', '2025-07-23 19:06:23', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6881915CB72E7', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '3rwr34534534535, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', '3rwr34534534535, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '39999998.00', '30000.00', '0.00', NULL, '0.00', '40029998.00', 1, 'pending', NULL, 1, 'delivered', NULL, NULL, '2025-07-23 18:50:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-23 18:50:20', '2025-07-23 18:50:20', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884BEEB4F001', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '47000000.00', '60000.00', '100000.00', '4D8V4Q', '0.00', '46960000.00', 5, 'pending', NULL, 2, 'pending_confirmation', NULL, NULL, '2025-07-26 04:41:31', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-26 04:41:31', '2025-07-26 04:41:31', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884BF3EA9653', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '47000000.00', '60000.00', '0.00', NULL, '0.00', '47060000.00', 5, 'pending', NULL, 2, 'pending_confirmation', NULL, NULL, '2025-07-26 04:42:54', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-26 04:42:54', '2025-07-26 04:42:54', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884BF504523D', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '47000000.00', '60000.00', '0.00', NULL, '0.00', '47060000.00', 1, 'pending', NULL, 2, 'pending_confirmation', NULL, NULL, '2025-07-26 04:43:12', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-26 04:43:12', '2025-07-26 04:43:12', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884BF91A3DC1', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '15000000.00', '60000.00', '0.00', NULL, '0.00', '15060000.00', 5, 'pending', NULL, 2, 'pending_confirmation', NULL, NULL, '2025-07-26 04:44:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-26 04:44:17', '2025-07-26 04:44:17', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884C11E8CA7F', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '15000000.00', '30000.00', '0.00', NULL, '0.00', '15030000.00', 5, 'pending', NULL, 1, 'pending_confirmation', NULL, NULL, '2025-07-26 04:50:54', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-26 04:50:54', '2025-07-26 04:50:54', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884C7335FB39', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '11000000.00', '30000.00', '0.00', NULL, '0.00', '11030000.00', 3, 'paid', '{\"amount\": \"11030000\", \"message\": \"Thành công.\", \"orderId\": \"ORD-6884C7335FB39\", \"payType\": \"aio_qr\", \"transId\": \"4552118473\", \"extraData\": null, \"orderInfo\": \"Thanh toán đơn hàng Funori #ORD-6884C7335FB39\", \"orderType\": \"momo_wallet\", \"requestId\": \"momo_6884c73364fa2\", \"signature\": \"788a9a05db3f7ca3683483ee51420d48756b4e22fbcaae4d4e3488be828670e7\", \"resultCode\": \"0\", \"partnerCode\": \"MOMOBKUN20180529\", \"responseTime\": \"1753532243694\"}', 1, 'processing', NULL, NULL, '2025-07-26 05:16:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-26 05:16:51', '2025-07-26 05:17:21', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884D76BDDE91', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '17300000.00', '30000.00', '0.00', NULL, '0.00', '17330000.00', 5, 'paid', '{\"vnp_Amount\": \"1733000000\", \"vnp_TxnRef\": \"ORD-6884D76BDDE91\", \"vnp_PayDate\": \"20250726202833\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15101387\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15101387\", \"vnp_TransactionStatus\": \"00\"}', 1, 'processing', NULL, NULL, '2025-07-26 06:26:03', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-26 06:26:03', '2025-07-26 06:27:36', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884D80E8ED8B', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '17300000.00', '60000.00', '0.00', NULL, '0.00', '17360000.00', 3, 'paid', '{\"amount\": \"17360000\", \"message\": \"Thành công.\", \"orderId\": \"ORD-6884D80E8ED8B\", \"payType\": \"aio_qr\", \"transId\": \"4552143564\", \"extraData\": null, \"orderInfo\": \"Thanh toán đơn hàng Funori #ORD-6884D80E8ED8B\", \"orderType\": \"momo_wallet\", \"requestId\": \"momo_6884d80e93563\", \"signature\": \"0ec2f197e7e92479de3c9278936327e2732999fc0a617051e29ab5941d2baa97\", \"resultCode\": \"0\", \"partnerCode\": \"MOMOBKUN20180529\", \"responseTime\": \"1753536595354\"}', 2, 'processing', NULL, NULL, '2025-07-26 06:28:46', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-26 06:28:46', '2025-07-26 06:29:53', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884D89730FD8', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '4300000.00', '30000.00', '0.00', NULL, '0.00', '4330000.00', 1, 'pending', NULL, 1, 'pending_confirmation', NULL, NULL, '2025-07-26 06:31:03', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-26 06:31:03', '2025-07-26 06:31:03', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884F1D5D6A57', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '12000000.00', '30000.00', '500000.00', '3D4JD5', '0.00', '11530000.00', 5, 'paid', '{\"vnp_Amount\": \"1153000000\", \"vnp_TxnRef\": \"ORD-6884F1D5D6A57\", \"vnp_PayDate\": \"20250726222019\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15101468\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15101468\", \"vnp_TransactionStatus\": \"00\"}', 1, 'delivered', NULL, NULL, '2025-07-26 08:18:45', NULL, '2025-07-26 15:31:17', '2025-07-26 15:35:21', NULL, NULL, NULL, 0, NULL, '2025-07-26 08:18:45', '2025-07-26 15:35:21', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884F2EF48536', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '12000000.00', '30000.00', '0.00', NULL, '0.00', '12030000.00', 3, 'paid', '{\"amount\": \"12030000\", \"message\": \"Thành công.\", \"orderId\": \"ORD-6884F2EF48536\", \"payType\": \"aio_qr\", \"transId\": \"4552184128\", \"extraData\": null, \"orderInfo\": \"Thanh toán đơn hàng Funori #ORD-6884F2EF48536\", \"orderType\": \"momo_wallet\", \"requestId\": \"momo_6884f2ef4d7ef\", \"signature\": \"8193d883ded6a22ab415a7cb4dddb821ce0eb5a64cf585367e602e063f399c14\", \"resultCode\": \"0\", \"partnerCode\": \"MOMOBKUN20180529\", \"responseTime\": \"1753543430254\"}', 1, 'processing', NULL, NULL, '2025-07-26 15:23:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-26 15:23:27', '2025-07-26 15:23:48', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884F3C663206', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '27000000.00', '60000.00', '0.00', NULL, '0.00', '27060000.00', 5, 'pending', NULL, 2, 'pending_confirmation', NULL, NULL, '2025-07-26 15:27:02', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-26 15:27:02', '2025-07-26 15:27:02', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884F3ECCF536', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '27000000.00', '60000.00', '0.00', NULL, '0.00', '27060000.00', 1, 'pending', NULL, 2, 'pending_confirmation', NULL, NULL, '2025-07-26 15:27:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-26 15:27:40', '2025-07-26 15:27:40', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 12, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-6884F4443C14B', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Xã Kim Sơn, Thị xã Sơn Tây, Thành phố Hà Nội', '17000000.00', '60000.00', '0.00', NULL, '0.00', '17060000.00', 5, 'paid', '{\"vnp_Amount\": \"1706000000\", \"vnp_TxnRef\": \"ORD-6884F4443C14B\", \"vnp_PayDate\": \"20250726223030\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15101474\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15101474\", \"vnp_TransactionStatus\": \"00\"}', 2, 'processing', NULL, NULL, '2025-07-26 15:29:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-26 15:29:08', '2025-08-24 15:30:27', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-688C0FA9D61A7', NULL, 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Phường Minh Khai, Quận Bắc Từ Liêm, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Phường Minh Khai, Quận Bắc Từ Liêm, Thành phố Hà Nội', '61000000.00', '30000.00', '1000000.00', 'VNPAY123', '0.00', '60030000.00', 5, 'failed', '{\"vnp_Amount\": \"6003000000\", \"vnp_TxnRef\": \"ORD-688C0FA9D61A7\", \"vnp_PayDate\": \"20250801075258\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"VNPAY\", \"vnp_CardType\": \"QRCODE\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_ResponseCode\": \"24\", \"vnp_TransactionNo\": \"0\", \"vnp_TransactionStatus\": \"02\"}', 1, 'cancelled', NULL, NULL, '2025-08-01 00:51:53', NULL, NULL, NULL, '2025-08-01 00:52:23', NULL, 'Thanh toán VNPAY thất bại. Mã lỗi: 24', 0, NULL, '2025-08-01 00:51:53', '2025-08-01 00:52:23', 'Nguyễn Tiến Thuận', '0373607863', 'nguyentienthuan4@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-688C0FEEDCE71', NULL, 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Phường Cổ Nhuế 2, Quận Bắc Từ Liêm, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Phường Cổ Nhuế 2, Quận Bắc Từ Liêm, Thành phố Hà Nội', '61000000.00', '60000.00', '0.00', 'VNPAY123', '0.00', '61060000.00', 5, 'paid', '{\"vnp_Amount\": \"6106000000\", \"vnp_TxnRef\": \"ORD-688C0FEEDCE71\", \"vnp_PayDate\": \"20250801075443\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15110876\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15110876\", \"vnp_TransactionStatus\": \"00\"}', 2, 'cancelled', NULL, NULL, '2025-08-01 00:53:02', NULL, NULL, NULL, '2025-08-01 00:54:03', NULL, 'Không còn nhu cầu sử dụng sản phẩm', 0, NULL, '2025-08-01 00:53:02', '2025-08-01 00:54:03', 'Nguyễn Tiến Thuận', '0373607863', 'nguyentienthuan4@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-688C2990A14BB', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Phường Đức Giang, Quận Long Biên, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Phường Đức Giang, Quận Long Biên, Thành phố Hà Nội', '19999999.00', '60000.00', '0.00', NULL, '0.00', '20059999.00', 5, 'failed', '{\"vnp_Amount\": \"2005999900\", \"vnp_TxnRef\": \"ORD-688C2990A14BB\", \"vnp_PayDate\": \"20250801094329\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"VNPAY\", \"vnp_CardType\": \"QRCODE\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_ResponseCode\": \"24\", \"vnp_TransactionNo\": \"0\", \"vnp_TransactionStatus\": \"02\"}', 2, 'cancelled', NULL, NULL, '2025-08-01 02:42:24', NULL, NULL, NULL, '2025-08-01 02:42:42', NULL, 'Thanh toán VNPAY thất bại. Mã lỗi: 24', 0, NULL, '2025-08-01 02:42:24', '2025-08-01 02:42:42', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 12, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-688C29B20979D', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Phường Phú Lương, Quận Hà Đông, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Phường Phú Lương, Quận Hà Đông, Thành phố Hà Nội', '19999999.00', '60000.00', '0.00', NULL, '0.00', '20059999.00', 5, 'paid', '{\"vnp_Amount\": \"2005999900\", \"vnp_TxnRef\": \"ORD-688C29B20979D\", \"vnp_PayDate\": \"20250801094416\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15111016\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15111016\", \"vnp_TransactionStatus\": \"00\"}', 2, 'cancelled', NULL, NULL, '2025-08-01 02:42:58', NULL, NULL, NULL, '2025-08-23 02:12:02', NULL, NULL, 0, NULL, '2025-08-01 02:42:58', '2025-08-23 02:12:02', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 12, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-688C2AF3E3168', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'dadadadadad, Phường Hàng Buồm, Quận Hoàn Kiếm, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'dadadadadad, Phường Hàng Buồm, Quận Hoàn Kiếm, Thành phố Hà Nội', '15000000.00', '60000.00', '1000000.00', 'VNPAY123', '0.00', '14060000.00', 5, 'paid', '{\"vnp_Amount\": \"1406000000\", \"vnp_TxnRef\": \"ORD-688C2AF3E3168\", \"vnp_PayDate\": \"20250801094938\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15111025\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15111025\", \"vnp_TransactionStatus\": \"00\"}', 2, 'cancelled', NULL, NULL, '2025-08-01 02:48:19', NULL, NULL, NULL, '2025-08-23 02:12:44', NULL, NULL, 0, NULL, '2025-08-01 02:48:19', '2025-08-23 02:12:44', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 12, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-688C54228597F', NULL, 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Phường Dịch Vọng, Thị xã Sơn Tây, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'z@gmail.com', '0373607863', 'Thôn 1, Yên Sở, Hoài Đức, Hà Nội, Phường Dịch Vọng, Thị xã Sơn Tây, Thành phố Hà Nội', '26000000.00', '30000.00', '0.00', NULL, '0.00', '26030000.00', 5, 'paid', '{\"vnp_Amount\": \"2603000000\", \"vnp_TxnRef\": \"ORD-688C54228597F\", \"vnp_PayDate\": \"20250801124539\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15111316\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15111316\", \"vnp_TransactionStatus\": \"00\"}', 1, 'processing', NULL, NULL, '2025-08-01 05:44:02', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-01 05:44:02', '2025-08-23 02:01:21', 'Nguyễn Tiến Thuận', '0373607863', 'z@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 13, 2, NULL, NULL, NULL, 'h', NULL, NULL, 'ORD-68A91C0DCEB8C', '15143739', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607863', 'nhà sô 2, Phường Hoàn Kiếm, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607863', 'Số 1, Đường ABC, Phường Hoàn Kiếm, Thành phố Hà Nội', '115999998.00', '60000.00', '2000000.00', 'MOMO123', '0.00', '114059998.00', 5, 'paid', '{\"vnp_Amount\": \"11405999800\", \"vnp_TxnRef\": \"ORD-68A91C0DCEB8C\", \"vnp_PayDate\": \"20250823084240\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15143739\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15143739\", \"vnp_TransactionStatus\": \"00\"}', 2, 'delivered', NULL, NULL, '2025-08-23 01:40:29', NULL, NULL, '2025-08-23 02:03:19', NULL, NULL, NULL, 0, NULL, '2025-08-23 01:40:29', '2025-08-23 02:03:19', 'Nguyễn Văn A', '0564758680', 'h@gmail.com', NULL, NULL, '21.04408827', '105.67404643', NULL, NULL, NULL, '15143739', '20250823084240'),
(50, 13, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-68A922DE03009', '15143761', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607863', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607863', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', '26000000.00', '60000.00', '2000000.00', 'MOMO123', '0.00', '24060000.00', 5, 'paid', '{\"vnp_Amount\": \"2406000000\", \"vnp_TxnRef\": \"ORD-68A922DE03009\", \"vnp_PayDate\": \"20250823091110\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15143761\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15143761\", \"vnp_TransactionStatus\": \"00\"}', 2, 'cancelled', NULL, NULL, '2025-08-23 02:09:34', NULL, NULL, NULL, '2025-08-23 08:57:41', NULL, 'Thay đổi địa chỉ hoặc thông tin nhận hàng', 1, NULL, '2025-08-23 02:09:34', '2025-08-23 08:57:41', 'Nguyễn Tiến Thuận', '0373607863', 'b@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15143761', '20250823091110'),
(51, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-68A98034381DF', '15144315', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607863', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607863', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', '26000000.00', '0.00', '0.00', NULL, '0.00', '26000000.00', 5, 'paid', '{\"vnp_Amount\": \"2600000000\", \"vnp_TxnRef\": \"ORD-68A98034381DF\", \"vnp_PayDate\": \"20250823154956\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15144315\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15144315\", \"vnp_TransactionStatus\": \"00\"}', 3, 'cancelled', NULL, NULL, '2025-08-23 08:47:48', NULL, NULL, NULL, '2025-08-23 08:51:20', NULL, 'Không còn nhu cầu sử dụng sản phẩm', 1, NULL, '2025-08-23 08:47:48', '2025-08-23 08:51:20', 'Nguyễn Tiến Thuận', '0373607863', 'b@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15144315', '20250823154956'),
(52, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-68A9838F6DDE2', NULL, 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607863', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607863', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', '24000000.00', '30000.00', '0.00', NULL, '0.00', '24030000.00', 1, 'pending', NULL, 1, 'cancelled', NULL, NULL, '2025-08-23 09:02:07', NULL, NULL, NULL, '2025-08-23 09:02:54', NULL, 'Tìm thấy sản phẩm tương tự với giá tốt hơn', 0, NULL, '2025-08-23 09:02:07', '2025-08-23 09:02:54', 'Nguyễn Tiến Thuận', '0373607863', 'b@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-68A984693F53F', '15144337', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607863', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607863', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', '18999999.00', '30000.00', '0.00', NULL, '0.00', '19029999.00', 5, 'paid', '{\"vnp_Amount\": \"1902999900\", \"vnp_TxnRef\": \"ORD-68A984693F53F\", \"vnp_PayDate\": \"20250823160756\", \"vnp_TmnCode\": \"I7RJJOXP\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15144337\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15144337\", \"vnp_TransactionStatus\": \"00\"}', 1, 'cancelled', NULL, NULL, '2025-08-23 09:05:45', NULL, NULL, NULL, '2025-08-23 09:10:14', NULL, 'Thời gian giao hàng quá lâu', 1, NULL, '2025-08-23 09:05:45', '2025-08-23 09:10:14', 'Nguyễn Tiến Thuận', '0373607863', 'b@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15144337', '20250823160756'),
(54, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-68A9F1B89FE23', '15144763', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607867', '34565, Phường Hoàn Kiếm, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607867', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', '39999998.00', '60000.00', '2000000.00', 'MOMO123', '0.00', '38059998.00', 5, 'paid', '{\"vnp_Amount\": \"3805999800\", \"vnp_TxnRef\": \"ORD-68A9F1B89FE23\", \"vnp_PayDate\": \"20250823235346\", \"vnp_TmnCode\": \"KUSIX1J4\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15144763\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15144763\", \"vnp_TransactionStatus\": \"00\"}', 2, 'cancelled', 'asasss', NULL, '2025-08-23 16:52:08', NULL, NULL, NULL, '2025-08-23 16:55:48', NULL, 'Customer cancelled - Refund processed', 0, NULL, '2025-08-23 16:52:08', '2025-08-23 16:55:48', 'THuan', '0373607863', 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15144763', '20250823235346'),
(55, 13, 2, NULL, NULL, NULL, 'ws', NULL, NULL, 'ORD-68A9F21E6EAEB', '4565884128', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607867', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607867', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', '24000000.00', '60000.00', '0.00', NULL, '0.00', '24060000.00', 3, 'paid', '{\"amount\": \"24060000\", \"message\": \"Thành công.\", \"orderId\": \"ORD-68A9F21E6EAEB\", \"payType\": \"aio_qr\", \"transId\": \"4565884128\", \"extraData\": null, \"orderInfo\": \"Thanh toán đơn hàng Funori #ORD-68A9F21E6EAEB\", \"orderType\": \"momo_wallet\", \"requestId\": \"momo_68a9f21e7a0ba\", \"signature\": \"09dbb0ee690c273e8982d178e71067a24eace1152b772a5beeb114f4f36a68bb\", \"resultCode\": \"0\", \"partnerCode\": \"MOMOBKUN20180529\", \"responseTime\": \"1755968068655\"}', 2, 'delivered', NULL, NULL, '2025-08-23 16:53:50', NULL, NULL, '2025-08-23 16:57:44', NULL, NULL, NULL, 0, NULL, '2025-08-23 16:53:50', '2025-08-23 16:57:44', 'Nguyễn Tiến Thuận', '0373607867', 'b@gmail.com', NULL, NULL, '21.04407192', '105.67362956', NULL, NULL, NULL, NULL, NULL),
(56, 13, 2, NULL, NULL, NULL, 'Đã hoàn trả hàng về kho do giao thất bại', NULL, NULL, 'ORD-68A9FA693D149', '4565884569', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607867', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607867', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', '11000000.00', '60000.00', '0.00', NULL, '0.00', '11060000.00', 3, 'paid', '{\"amount\": \"11060000\", \"message\": \"Thành công.\", \"orderId\": \"ORD-68A9FA693D149\", \"payType\": \"aio_qr\", \"transId\": \"4565884569\", \"extraData\": null, \"orderInfo\": \"Thanh toán đơn hàng Funori #ORD-68A9FA693D149\", \"orderType\": \"momo_wallet\", \"requestId\": \"momo_68a9fa6a3800f\", \"signature\": \"14ef1a6efef5d3dcb039dd69c90886ed0c826f8b4d86c26215fcc8b112bf45b5\", \"resultCode\": \"0\", \"partnerCode\": \"MOMOBKUN20180529\", \"responseTime\": \"1755970179565\"}', 2, 'returned', NULL, NULL, '2025-08-23 17:29:13', NULL, NULL, NULL, '2025-08-23 17:30:38', NULL, NULL, 0, NULL, '2025-08-23 17:29:13', '2025-08-23 17:34:55', 'Nguyễn Tiến Thuận', '0373607867', 'b@gmail.com', NULL, NULL, '21.04393362', '105.67419412', NULL, NULL, NULL, NULL, NULL),
(57, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241154133660', NULL, 'Cecelia Carroll', 'meda54@example.org', '740-938-7003', '361 Hintz Cliff Apt. 702\nFunkville, OR 19665', NULL, NULL, NULL, NULL, '0.00', '28776.00', '0.00', NULL, '0.00', '0.00', 1, 'pending', NULL, 1, 'delivered', NULL, 'Et qui consequatur atque.', '2025-07-26 04:54:13', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-25 04:54:13', '2025-08-24 04:54:13', 'Tracey Sporer', '+1-310-426-9295', 'skiles.hipolito@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241154488970', NULL, 'Ms. Dolly Rempel IV', 'federico.gulgowski@example.net', '1-458-240-8417', '1793 Smith Ports Suite 980\nWest Morganburgh, IA 95756', NULL, NULL, NULL, NULL, '95400000.00', '22331.00', '0.00', NULL, '0.00', '95422331.00', 1, 'refunded', NULL, 1, 'delivered', NULL, NULL, '2025-08-13 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-15 04:54:48', '2025-08-24 04:54:48', 'Miss Kailey Stanton', '412.867.2116', 'javier.jacobs@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241154488221', NULL, 'Forrest Strosin', 'dorian62@example.com', '240-341-6319', '85072 Aliyah Skyway\nRomainefurt, AK 73932', NULL, NULL, NULL, NULL, '7000000.00', '16539.00', '0.00', NULL, '0.00', '7016539.00', 2, 'pending', NULL, 2, 'delivered', NULL, 'Ipsum aut dolores voluptatum doloremque.', '2025-08-08 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-09 04:54:48', '2025-08-24 04:54:48', 'Mr. Travis Kulas', '+1 (319) 609-1663', 'akling@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241154481762', NULL, 'Reinhold Legros', 'edwina.rowe@example.net', '443.419.5385', '7245 Giuseppe Light\nOralland, MD 57600', NULL, NULL, NULL, NULL, '105000000.00', '24083.00', '0.00', NULL, '0.00', '105024083.00', 2, 'pending', NULL, 1, 'delivered', NULL, 'Rerum ut recusandae qui cumque quas placeat.', '2025-08-06 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-02 04:54:48', '2025-08-24 04:54:48', 'Jena Eichmann', '+1-575-220-4172', 'rowan54@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241154482243', NULL, 'Luis Schultz', 'braun.rudy@example.net', '+16787344384', '1260 Roscoe Crescent Suite 865\nSouth Prince, WA 63959-7777', NULL, NULL, NULL, NULL, '48000000.00', '29642.00', '0.00', NULL, '0.00', '48029642.00', 2, 'failed', NULL, 2, 'delivered', NULL, NULL, '2025-07-29 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-12 04:54:48', '2025-08-24 04:54:48', 'Ms. Erica Legros V', '+12834846782', 'ukiehn@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241154488704', NULL, 'Kiarra Hammes', 'nikolaus.karl@example.org', '865-613-6661', '78509 Bosco Station\nNorth Helmerberg, CO 04108-7021', NULL, NULL, NULL, NULL, '87000000.00', '23193.00', '0.00', NULL, '0.00', '87023193.00', 1, 'paid', NULL, 2, 'delivered', NULL, NULL, '2025-07-29 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-22 04:54:48', '2025-08-24 04:54:48', 'Kyra Ruecker IV', '+1 (838) 797-0358', 'reichert.nella@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241154483445', NULL, 'Dr. Amir Breitenberg', 'schulist.mekhi@example.com', '281-644-8306', '96239 Reinger Mall\nJimmieview, RI 09927-2345', NULL, NULL, NULL, NULL, '39000000.00', '28585.00', '0.00', NULL, '0.00', '39028585.00', 2, 'pending', NULL, 2, 'delivered', NULL, NULL, '2025-07-29 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-21 04:54:48', '2025-08-24 04:54:48', 'Ms. Burdette Mann', '+15806482456', 'gussie.prosacco@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241154482706', NULL, 'Alysa Gutkowski V', 'zachariah04@example.com', '+1-612-210-2031', '385 Powlowski Station Apt. 662\nEast Rubie, MS 54117', NULL, NULL, NULL, NULL, '148500000.00', '18677.00', '0.00', NULL, '0.00', '148518677.00', 1, 'failed', NULL, 1, 'delivered', NULL, NULL, '2025-08-11 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-30 04:54:48', '2025-08-24 04:54:48', 'Dr. Lilian Okuneva Sr.', '(458) 860-7377', 'jprice@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241154485717', NULL, 'Mrs. River Sauer', 'judge02@example.com', '(901) 885-6675', '2080 Stehr Crest\nNew Geomouth, MD 18492-1734', NULL, NULL, NULL, NULL, '24000000.00', '24727.00', '0.00', NULL, '0.00', '24024727.00', 1, 'pending', NULL, 1, 'delivered', 'Est vitae asperiores rerum enim.', NULL, '2025-08-03 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-12 04:54:48', '2025-08-24 04:54:48', 'Prof. Mara Kuphal III', '+14787249841', 'mante.wilson@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241154482248', NULL, 'Mr. Andre Russel DVM', 'fharris@example.org', '269-422-8178', '394 Rogahn Square\nRosarioborough, LA 22087-8546', NULL, NULL, NULL, NULL, '35000000.00', '15539.00', '0.00', NULL, '0.00', '35015539.00', 1, 'pending', NULL, 1, 'delivered', NULL, NULL, '2025-08-10 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-18 04:54:48', '2025-08-24 04:54:48', 'Dustin Murray', '878-271-5953', 'eleazar53@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241154487599', NULL, 'Henry Bergstrom', 'jhyatt@example.com', '+1.701.515.4553', '75345 Alanna Terrace\nPort Sydneestad, MI 55350-4843', NULL, NULL, NULL, NULL, '113400000.00', '14840.00', '0.00', NULL, '0.00', '113414840.00', 1, 'pending', NULL, 2, 'delivered', NULL, NULL, '2025-07-29 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-09 04:54:48', '2025-08-24 04:54:48', 'Arnulfo Leannon', '740-501-8672', 'barton.millie@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544868010', NULL, 'Nick Keebler', 'fpowlowski@example.com', '(479) 296-5729', '74056 Bryon Tunnel Apt. 345\nSonnyside, ME 23777', NULL, NULL, NULL, NULL, '17400000.00', '10564.00', '0.00', NULL, '0.00', '17410564.00', 2, 'refunded', NULL, 1, 'delivered', 'Sunt eveniet accusantium quos qui repellendus.', 'Quis totam aut eos amet ut.', '2025-08-17 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-27 04:54:48', '2025-08-24 04:54:48', 'Allie Schinner', '+1.281.219.2070', 'alene56@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544899411', NULL, 'Hershel Daniel', 'bpredovic@example.net', '913.367.1704', '6693 Napoleon Stravenue\nReneeville, NE 65942-6467', NULL, NULL, NULL, NULL, '32400000.00', '10291.00', '0.00', NULL, '0.00', '32410291.00', 2, 'failed', NULL, 2, 'delivered', 'Nemo quis ut deserunt.', 'Et voluptas beatae praesentium inventore itaque excepturi.', '2025-08-24 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-11 04:54:48', '2025-08-24 04:54:48', 'Ada Hirthe Jr.', '+1-612-607-7532', 'lukas.veum@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544830012', NULL, 'Guido Sawayn', 'miles.dubuque@example.org', '+1-774-425-5363', '624 Fabiola Springs\nSmithammouth, CA 41670', NULL, NULL, NULL, NULL, '34000000.00', '23888.00', '0.00', NULL, '0.00', '34023888.00', 1, 'paid', NULL, 1, 'delivered', 'Aut dolores reiciendis aut facilis quod.', NULL, '2025-08-19 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-07 04:54:48', '2025-08-24 04:54:48', 'Lina Abshire V', '+1-518-470-0478', 'rnolan@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544874613', NULL, 'Durward Rodriguez', 'rogers.jerde@example.net', '863.288.9264', '3390 Connelly Springs\nLangworthmouth, UT 83943', NULL, NULL, NULL, NULL, '162000000.00', '12217.00', '0.00', NULL, '0.00', '162012217.00', 1, 'paid', NULL, 1, 'delivered', NULL, NULL, '2025-08-01 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-28 04:54:48', '2025-08-24 04:54:48', 'Celine Skiles Sr.', '+1-813-393-8237', 'mschneider@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544812914', NULL, 'Prof. Rhea Hahn MD', 'hessel.scot@example.org', '+1 (760) 757-8390', '4553 Wiegand Cliffs Apt. 565\nSouth Celestinefurt, NH 93988-8940', NULL, NULL, NULL, NULL, '14000000.00', '27416.00', '0.00', NULL, '0.00', '14027416.00', 1, 'pending', NULL, 1, 'delivered', NULL, 'Autem qui et delectus.', '2025-08-12 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-09 04:54:48', '2025-08-24 04:54:48', 'Jordan Rice', '216-765-7639', 'walter.alford@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544866015', NULL, 'Rudolph Hermann', 'yasmeen03@example.com', '1-838-688-4337', '7687 Vesta Common\nTristonbury, MO 10745-1327', NULL, NULL, NULL, NULL, '132000000.00', '13924.00', '0.00', NULL, '0.00', '132013924.00', 1, 'pending', NULL, 1, 'delivered', 'Harum quaerat blanditiis qui et eos vitae.', NULL, '2025-08-19 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-26 04:54:48', '2025-08-24 04:54:48', 'Arianna Nader V', '1-330-510-9763', 'ruecker.freeman@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544824416', NULL, 'Prof. Jillian Williamson', 'angeline94@example.net', '(848) 367-9503', '82730 Ethyl Extensions\nEast Yolanda, SD 86569', NULL, NULL, NULL, NULL, '99000000.00', '12610.00', '0.00', NULL, '0.00', '99012610.00', 2, 'failed', NULL, 1, 'delivered', 'Ea autem illo ut illo.', 'Ut sunt omnis et tempora consectetur consequatur hic.', '2025-07-31 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-15 04:54:48', '2025-08-24 04:54:48', 'Ms. Eldora Sauer III', '(360) 947-1538', 'paucek.ardella@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544822217', NULL, 'Prof. Austin Wilkinson', 'brando.huel@example.org', '+1-463-207-3052', '4165 Adams River Suite 307\nPort Joaquinside, NY 36921-4860', NULL, NULL, NULL, NULL, '171400000.00', '11844.00', '0.00', NULL, '0.00', '171411844.00', 2, 'pending', NULL, 1, 'delivered', NULL, NULL, '2025-07-28 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-04 04:54:48', '2025-08-24 04:54:48', 'Lily Keeling', '+1-414-364-2455', 'ywalter@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544844718', NULL, 'Dr. Viviane Williamson Sr.', 'gabriel43@example.org', '+17732397599', '8618 Calista Locks\nGislasonchester, RI 45742-0789', NULL, NULL, NULL, NULL, '124000000.00', '23998.00', '0.00', NULL, '0.00', '124023998.00', 2, 'paid', NULL, 2, 'delivered', NULL, 'Inventore qui excepturi et adipisci a cupiditate voluptas.', '2025-07-29 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-15 04:54:48', '2025-08-24 04:54:48', 'Jeramie Vandervort', '(351) 234-9080', 'rafaela.hodkiewicz@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544818619', NULL, 'Abraham Schmeler', 'brooks15@example.org', '262.316.0184', '354 Haag Stravenue Apt. 470\nLake Dillanburgh, WA 20760-4756', NULL, NULL, NULL, NULL, '108000000.00', '18023.00', '0.00', NULL, '0.00', '108018023.00', 1, 'failed', NULL, 2, 'delivered', NULL, NULL, '2025-08-07 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-20 04:54:48', '2025-08-24 04:54:48', 'Zelma Durgan', '+13473015945', 'parker.davon@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544831720', NULL, 'Nicolette Romaguera DDS', 'ubaldo07@example.com', '+1.820.888.5960', '9435 Renner Lock Apt. 682\nTerryshire, NV 11455-2365', NULL, NULL, NULL, NULL, '93000000.00', '18599.00', '0.00', NULL, '0.00', '93018599.00', 2, 'refunded', NULL, 2, 'delivered', NULL, 'Ea aut vero expedita fugit quia.', '2025-07-28 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-27 04:54:48', '2025-08-24 04:54:48', 'Alyson Dibbert II', '385-993-1868', 'cordia.hoppe@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544880221', NULL, 'Nathanael Kshlerin', 'jayde19@example.net', '+17738596208', '92648 Torrance Fords Suite 452\nWest Jalon, SC 32843', NULL, NULL, NULL, NULL, '100000000.00', '17386.00', '0.00', NULL, '0.00', '100017386.00', 2, 'pending', NULL, 1, 'delivered', NULL, NULL, '2025-08-23 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-17 04:54:48', '2025-08-24 04:54:48', 'Mrs. Sandrine Lakin', '661.431.3473', 'dariana.jacobson@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544895422', NULL, 'Dr. Nikita Ferry III', 'malvina.wilkinson@example.org', '480.908.1696', '6673 Crooks Ways Apt. 895\nNew Emeliaberg, UT 58534-6512', NULL, NULL, NULL, NULL, '86000000.00', '10043.00', '0.00', NULL, '0.00', '86010043.00', 2, 'paid', NULL, 2, 'delivered', 'Consequatur dicta suscipit in.', 'Ut molestiae dolor dicta incidunt dolorem accusamus quam et.', '2025-07-25 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-12 04:54:48', '2025-08-24 04:54:48', 'Isaiah Ullrich', '+1.304.325.1199', 'kobe.veum@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544882423', NULL, 'Lincoln Rohan II', 'zboncak.emmanuelle@example.net', '(479) 838-7487', '4995 O\'Connell Grove\nLake Drake, WV 90746', NULL, NULL, NULL, NULL, '70000000.00', '10589.00', '0.00', NULL, '0.00', '70010589.00', 2, 'failed', NULL, 1, 'delivered', 'Consequatur ea et enim et inventore.', NULL, '2025-07-27 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-19 04:54:48', '2025-08-24 04:54:48', 'Enola Schoen', '(248) 633-7845', 'cmraz@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544847424', NULL, 'Mrs. Brandi Lehner V', 'edgar96@example.com', '(283) 886-1757', '1811 Bosco Run Suite 340\nSabrynahaven, TX 60279', NULL, NULL, NULL, NULL, '143700000.00', '23922.00', '0.00', NULL, '0.00', '143723922.00', 2, 'refunded', NULL, 1, 'delivered', 'Iure optio tenetur incidunt unde accusamus repudiandae ad.', 'Officiis dolorem sunt facere voluptates consequatur.', '2025-08-19 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-21 04:54:48', '2025-08-24 04:54:48', 'Prof. Roxane Cassin DDS', '(267) 930-3757', 'walton78@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544893125', NULL, 'Elvera Wintheiser', 'gutmann.olin@example.net', '650.864.2831', '3519 Huel Ferry\nMarinaville, OR 67539', NULL, NULL, NULL, NULL, '24000000.00', '26099.00', '0.00', NULL, '0.00', '24026099.00', 2, 'refunded', NULL, 2, 'delivered', 'Amet voluptatibus porro corporis cumque.', 'Ut adipisci aut qui.', '2025-08-06 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-23 04:54:48', '2025-08-24 04:54:48', 'Brain Osinski', '872-631-6045', 'rachelle.kessler@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `orders` (`id`, `user_id`, `shipper_id`, `received_at`, `in_delivery_at`, `failed_at`, `delivery_notes`, `failure_reason`, `delivery_images`, `order_code`, `transaction_id`, `customer_name`, `customer_email`, `customer_phone`, `shipping_address`, `buyer_name`, `buyer_email`, `buyer_phone`, `buyer_address`, `subtotal_amount`, `shipping_fee`, `discount_amount`, `discount_code`, `tax_amount`, `total_amount`, `payment_method_id`, `payment_status`, `payment_details`, `shipping_method_id`, `order_status`, `customer_note`, `admin_note`, `ordered_at`, `processing_at`, `shipped_at`, `delivered_at`, `cancelled_at`, `returned_at`, `cancellation_reason`, `pending_refund`, `previous_status`, `created_at`, `updated_at`, `shipping_name`, `shipping_phone`, `shipping_email`, `shipping_lat`, `shipping_lng`, `delivery_lat`, `delivery_lng`, `delivery_started_at`, `delivery_completed_at`, `delivery_address`, `vnp_transaction_no`, `vnp_transaction_date`) VALUES
(84, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544886326', NULL, 'Rick Lindgren', 'zwalsh@example.org', '+1.872.975.8844', '870 Weimann Crossroad Suite 814\nRautown, SC 90971', NULL, NULL, NULL, NULL, '39000000.00', '16159.00', '0.00', NULL, '0.00', '39016159.00', 2, 'paid', NULL, 2, 'delivered', NULL, NULL, '2025-08-18 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-01 04:54:48', '2025-08-24 04:54:48', 'Tiffany Maggio', '+1-810-901-2582', 'jesus.collier@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544894927', NULL, 'Benedict Connelly', 'lschmitt@example.net', '(838) 240-6930', '88930 Ines Circle Suite 463\nAntonetteborough, KS 49528-6800', NULL, NULL, NULL, NULL, '34000000.00', '10147.00', '0.00', NULL, '0.00', '34010147.00', 1, 'pending', NULL, 1, 'delivered', 'Eum sit sunt similique ex alias.', 'Dolor iure et est minima quisquam repudiandae quia.', '2025-08-10 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-29 04:54:48', '2025-08-24 04:54:48', 'Ms. Bettie Kuhn II', '424-556-3757', 'joe.bernier@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544828728', NULL, 'Prof. Emmett Kassulke', 'nathan79@example.com', '+1.820.661.2069', '8896 Dietrich Camp\nNorth Natashabury, NJ 06899-5650', NULL, NULL, NULL, NULL, '84600000.00', '14230.00', '0.00', NULL, '0.00', '84614230.00', 2, 'refunded', NULL, 1, 'delivered', 'Repellat totam dolor repellendus voluptatem vel.', 'Impedit molestiae iure distinctio dolores est officiis occaecati.', '2025-08-01 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-30 04:54:48', '2025-08-24 04:54:48', 'Jace Funk', '+1.504.549.8881', 'boehm.nash@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544887329', NULL, 'Caden Beahan', 'hermiston.nikita@example.org', '757.848.7213', '6116 Emilie Mountain\nSouth Shannyville, FL 52801-8829', NULL, NULL, NULL, NULL, '122000000.00', '14608.00', '0.00', NULL, '0.00', '122014608.00', 1, 'refunded', NULL, 1, 'delivered', NULL, 'Consequatur et voluptates et voluptatem quia voluptatem et.', '2025-08-10 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-22 04:54:48', '2025-08-24 04:54:48', 'Loma Kuhn', '(704) 213-6223', 'elna24@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544890430', NULL, 'Mr. Barton Shields', 'susie22@example.net', '775-760-6122', '314 Watson Gardens\nNorth Loren, MI 35431', NULL, NULL, NULL, NULL, '71700000.00', '16607.00', '0.00', NULL, '0.00', '71716607.00', 1, 'pending', NULL, 1, 'delivered', NULL, NULL, '2025-08-02 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-11 04:54:48', '2025-08-24 04:54:48', 'Dr. Eda Boyle', '954-363-2362', 'feeney.belle@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544877031', NULL, 'Dr. Veda Block', 'schimmel.rogers@example.com', '872-940-4025', '30229 Antonio Roads Suite 029\nO\'Haraside, MA 86645-7153', NULL, NULL, NULL, NULL, '114000000.00', '25683.00', '0.00', NULL, '0.00', '114025683.00', 1, 'paid', NULL, 2, 'delivered', 'Non et accusantium vitae enim et laboriosam.', NULL, '2025-08-16 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-07 04:54:48', '2025-08-24 04:54:48', 'Jody Wilderman DDS', '478.208.3188', 'hhayes@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544884632', NULL, 'Myah Beahan', 'terry.ruthe@example.net', '+1.432.670.2854', '23744 Raheem Union Suite 485\nDibberttown, WI 85047-2850', NULL, NULL, NULL, NULL, '153000000.00', '14146.00', '0.00', NULL, '0.00', '153014146.00', 1, 'pending', NULL, 2, 'delivered', NULL, 'Non itaque quia ipsa.', '2025-08-13 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-03 04:54:48', '2025-08-24 04:54:48', 'Lottie Weissnat', '1-689-570-7572', 'mattie13@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544859733', NULL, 'Dr. Elias Lockman Jr.', 'trantow.shanel@example.net', '+1-351-959-6946', '301 Gleichner Prairie Suite 162\nJarvisstad, NV 73010', NULL, NULL, NULL, NULL, '45000000.00', '17998.00', '0.00', NULL, '0.00', '45017998.00', 2, 'failed', NULL, 1, 'delivered', 'Ea soluta sapiente a perspiciatis aliquid omnis autem.', NULL, '2025-08-08 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-06 04:54:48', '2025-08-24 04:54:48', 'Ms. Chaya Crona DVM', '+1 (828) 677-4343', 'jordane79@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544877734', NULL, 'Harmon Parisian', 'rempel.aryanna@example.net', '220.734.9118', '823 Pfeffer Stravenue\nKautzerton, MT 22118-7080', NULL, NULL, NULL, NULL, '105000000.00', '26204.00', '0.00', NULL, '0.00', '105026204.00', 1, 'failed', NULL, 2, 'delivered', 'Ad sed aut fugit ad.', 'Est et et ipsam.', '2025-08-14 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-08 04:54:48', '2025-08-24 04:54:48', 'Gunnar Stanton DVM', '+1-832-772-9992', 'rogahn.arden@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544879935', NULL, 'Mateo Schneider IV', 'ella.miller@example.org', '(260) 604-6231', '668 Beer Spurs Apt. 985\nMorarton, MS 28994-1087', NULL, NULL, NULL, NULL, '171000000.00', '17104.00', '0.00', NULL, '0.00', '171017104.00', 2, 'paid', NULL, 1, 'delivered', 'Laudantium esse quia cupiditate ut.', 'Aut laboriosam laboriosam ratione unde.', '2025-08-11 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-31 04:54:48', '2025-08-24 04:54:48', 'Mr. Orin Abbott DDS', '269.334.7562', 'clabadie@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544885436', NULL, 'Jamaal Auer', 'hildegard01@example.org', '+1 (512) 942-6208', '7802 Priscilla Ridges Suite 370\nLake Alvisborough, IL 03166', NULL, NULL, NULL, NULL, '72000000.00', '15396.00', '0.00', NULL, '0.00', '72015396.00', 2, 'paid', NULL, 1, 'delivered', NULL, 'Est itaque alias totam exercitationem dolorum nihil.', '2025-08-12 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-14 04:54:48', '2025-08-24 04:54:48', 'Samson Sawayn', '315.300.2204', 'xschumm@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544894637', NULL, 'Shany Littel', 'sonia.oreilly@example.org', '+1-818-621-5479', '9155 Maggie Valleys\nSouth Wadeville, FL 25395', NULL, NULL, NULL, NULL, '95000000.00', '16207.00', '0.00', NULL, '0.00', '95016207.00', 2, 'refunded', NULL, 1, 'delivered', NULL, 'Aspernatur voluptates quam exercitationem sit in aut exercitationem.', '2025-07-26 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-20 04:54:48', '2025-08-24 04:54:48', 'David Toy', '+1 (954) 510-5103', 'aracely70@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544873338', NULL, 'Rhoda Morissette', 'louie.paucek@example.net', '+13608050531', '39863 Shields Fields\nParisianland, RI 46274-3216', NULL, NULL, NULL, NULL, '138000000.00', '26274.00', '0.00', NULL, '0.00', '138026274.00', 1, 'pending', NULL, 1, 'delivered', NULL, NULL, '2025-08-17 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-17 04:54:48', '2025-08-24 04:54:48', 'Prof. Dessie Feest', '+1.385.303.0062', 'vivien70@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544837739', NULL, 'Miss Carli Rogahn III', 'ukling@example.org', '+1 (360) 749-5944', '573 Vinnie Roads\nNorth Jalon, LA 97712', NULL, NULL, NULL, NULL, '89000000.00', '15273.00', '0.00', NULL, '0.00', '89015273.00', 2, 'failed', NULL, 1, 'delivered', NULL, 'Qui quaerat non ut iste.', '2025-07-26 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-22 04:54:48', '2025-08-24 04:54:48', 'Mr. Nat Hayes IV', '+1 (407) 208-5968', 'magnus.monahan@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544876940', NULL, 'Millie Sanford', 'veum.laura@example.com', '1-539-273-4232', '938 Tommie Place Apt. 464\nNew Destinyfort, SC 68882-6478', NULL, NULL, NULL, NULL, '198000000.00', '16973.00', '0.00', NULL, '0.00', '198016973.00', 1, 'refunded', NULL, 1, 'delivered', NULL, 'Veritatis quisquam nihil tempora reiciendis.', '2025-08-08 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-07 04:54:48', '2025-08-24 04:54:48', 'Kenny Lueilwitz', '1-352-355-4822', 'elisabeth.rice@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544860941', NULL, 'Prof. Jaida Nienow', 'sid97@example.com', '+12797832753', '2459 Brando Neck\nSouth Brycen, CA 44682', NULL, NULL, NULL, NULL, '63400000.00', '21057.00', '0.00', NULL, '0.00', '63421057.00', 2, 'refunded', NULL, 2, 'delivered', NULL, NULL, '2025-08-23 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-05 04:54:48', '2025-08-24 04:54:48', 'Mortimer Christiansen', '804.357.9322', 'ronaldo.roob@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544867742', NULL, 'Nolan Aufderhar', 'armstrong.nicholaus@example.com', '660.638.6991', '208 Terence Square\nOralfort, MI 15316', NULL, NULL, NULL, NULL, '5000000.00', '10863.00', '0.00', NULL, '0.00', '5010863.00', 1, 'pending', NULL, 2, 'delivered', 'Eligendi quisquam accusamus commodi sed reprehenderit itaque voluptas id.', NULL, '2025-07-28 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-18 04:54:48', '2025-08-24 04:54:48', 'Nelle Kub', '1-830-328-5635', 'rodriguez.dewayne@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(101, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544813443', NULL, 'Dr. Neva Bartoletti I', 'shaylee.bogisich@example.com', '972-740-9335', '480 Murphy Heights Suite 194\nWest Lynn, MS 65330-6074', NULL, NULL, NULL, NULL, '80000000.00', '20225.00', '0.00', NULL, '0.00', '80020225.00', 2, 'paid', NULL, 1, 'delivered', 'Non a quos qui ea expedita.', NULL, '2025-07-27 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-06 04:54:48', '2025-08-24 04:54:48', 'Miss Dejah Boyle', '+12836861814', 'raynor.ibrahim@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544899144', NULL, 'Mrs. Malvina Hahn III', 'russel.mckenna@example.org', '+13027694867', '147 Corrine Centers\nNew Janicktown, ID 38594-3103', NULL, NULL, NULL, NULL, '75000000.00', '26118.00', '0.00', NULL, '0.00', '75026118.00', 1, 'failed', NULL, 1, 'delivered', 'Eos dolor qui molestiae ducimus.', NULL, '2025-08-23 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-04 04:54:48', '2025-08-24 04:54:48', 'King Mitchell', '+13645004440', 'august.pollich@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(103, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544855045', NULL, 'Dr. Eldon Ondricka DVM', 'vjerde@example.net', '+1 (701) 813-0221', '335 Hand Manors\nJenkinsport, NH 12005', NULL, NULL, NULL, NULL, '24000000.00', '24520.00', '0.00', NULL, '0.00', '24024520.00', 2, 'failed', NULL, 1, 'delivered', NULL, 'Quia maiores assumenda sed tenetur porro.', '2025-08-14 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-08 04:54:48', '2025-08-24 04:54:48', 'Prof. Abdiel Zemlak', '1-857-319-6597', 'iturner@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(104, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544865146', NULL, 'Lexie Ankunding IV', 'ijacobi@example.net', '1-585-637-4314', '65606 Jacobson Cape\nHayesmouth, ME 49014-1916', NULL, NULL, NULL, NULL, '30400000.00', '13059.00', '0.00', NULL, '0.00', '30413059.00', 2, 'failed', NULL, 1, 'delivered', NULL, NULL, '2025-08-23 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-13 04:54:48', '2025-08-24 04:54:48', 'Prof. Nicolette Deckow V', '567-853-6893', 'weimann.sofia@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(105, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544887847', NULL, 'Miss Katlyn Nader', 'lorn@example.net', '+1-480-561-0325', '867 Malcolm Mountain Apt. 001\nNew Brennon, IN 88778-4459', NULL, NULL, NULL, NULL, '58100000.00', '26407.00', '0.00', NULL, '0.00', '58126407.00', 1, 'failed', NULL, 1, 'delivered', 'Dolorem velit ullam est accusantium excepturi molestiae sit.', 'Praesentium laborum aperiam animi et natus.', '2025-08-17 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-20 04:54:48', '2025-08-24 04:54:48', 'Mr. Jessy Zemlak PhD', '+1-574-986-7066', 'rashad.waters@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(106, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544828048', NULL, 'Isabelle Carter I', 'treutel.mona@example.net', '1-534-542-9502', '885 Madelyn Turnpike\nSouth Berta, RI 66287', NULL, NULL, NULL, NULL, '26000000.00', '27827.00', '0.00', NULL, '0.00', '26027827.00', 2, 'paid', NULL, 1, 'delivered', 'Harum amet eveniet et.', NULL, '2025-08-21 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-10 04:54:48', '2025-08-24 04:54:48', 'Oliver Kiehn', '+1.220.693.3270', 'bernier.imani@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(107, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411544829049', NULL, 'Murl Gaylord', 'hintz.zakary@example.org', '1-270-442-6875', '757 Pacocha Rue\nArliebury, PA 42712', NULL, NULL, NULL, NULL, '99400000.00', '18691.00', '0.00', NULL, '0.00', '99418691.00', 2, 'failed', NULL, 2, 'delivered', 'Aut et velit enim et aut eum.', 'Et animi deleniti ut hic ea hic mollitia.', '2025-08-24 04:54:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-11 04:54:48', '2025-08-24 04:54:48', 'Mr. Denis Stroman MD', '+1 (228) 766-9055', 'vern.sauer@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(108, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241158272810', NULL, 'Annabel Thiel', 'wilmer50@example.org', '1-228-393-1834', '53676 Susana Lights Suite 602\nPort Jason, VT 26043-0414', NULL, NULL, NULL, NULL, '15000000.00', '29365.00', '0.00', NULL, '0.00', '15029365.00', 1, 'failed', NULL, 1, 'delivered', 'Sint aliquam fugiat similique atque ut commodi.', NULL, '2024-10-05 04:58:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-05 04:58:27', '2025-08-24 04:58:27', 'Prof. Brannon Funk IV', '+1-534-563-3987', 'ogulgowski@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(109, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241158273281', NULL, 'Dr. Everardo Klein V', 'schaefer.gabe@example.net', '+1 (740) 415-9383', '5933 Leuschke Views Suite 536\nSouth Darwinside, MT 91453-9481', NULL, NULL, NULL, NULL, '53399999.00', '12508.00', '0.00', NULL, '0.00', '53412507.00', 2, 'refunded', NULL, 2, 'delivered', 'Eum suscipit omnis possimus veritatis et est.', 'Cupiditate rerum et sit qui perferendis.', '2025-02-11 04:58:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-02-11 04:58:27', '2025-08-24 04:58:27', 'Prof. Graciela Klein', '+1.904.428.8746', 'llabadie@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(110, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241158277562', NULL, 'Dr. Norwood Hills PhD', 'stamm.mateo@example.com', '1-775-814-4516', '26113 Goodwin Island Apt. 082\nLake Adrianafort, RI 28721', NULL, NULL, NULL, NULL, '17000000.00', '26571.00', '0.00', NULL, '0.00', '17026571.00', 2, 'paid', NULL, 1, 'delivered', NULL, NULL, '2024-12-26 04:58:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-26 04:58:27', '2025-08-24 04:58:27', 'Foster Greenholt', '+1-931-840-2077', 'claud.ohara@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241158275933', NULL, 'Dominique Bednar MD', 'jbernier@example.org', '283-867-0677', '609 Brayan Prairie Suite 541\nWest Rhettfurt, IN 10269', NULL, NULL, NULL, NULL, '35999999.97', '18940.00', '0.00', NULL, '0.00', '36018939.97', 2, 'paid', NULL, 2, 'delivered', NULL, 'Eos porro velit ipsum numquam asperiores.', '2025-02-12 04:58:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-02-12 04:58:27', '2025-08-24 04:58:27', 'Alexanne Langworth', '(540) 903-0659', 'akihn@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(112, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241158274944', NULL, 'Eleanore Zieme', 'wyatt20@example.org', '+1-908-587-6647', '3163 Mosciski Walk Apt. 703\nAlexandrealand, IN 70262-6192', NULL, NULL, NULL, NULL, '15500000.00', '16980.00', '0.00', NULL, '0.00', '15516980.00', 1, 'refunded', NULL, 2, 'delivered', 'Qui molestiae sed perspiciatis perspiciatis quas consequatur in.', NULL, '2025-01-03 04:58:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-03 04:58:27', '2025-08-24 04:58:27', 'Victoria Hane', '(725) 342-9529', 'bernadine.moen@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(113, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241158273485', NULL, 'Prof. Monte Corkery', 'citlalli48@example.com', '+1.808.806.7121', '2241 Keebler Avenue Suite 851\nSouth Freeman, OH 06884-6559', NULL, NULL, NULL, NULL, '19999999.00', '15969.00', '0.00', NULL, '0.00', '20015968.00', 1, 'paid', NULL, 2, 'delivered', NULL, 'Non saepe voluptas possimus eum officiis.', '2024-10-08 04:58:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-08 04:58:27', '2025-08-24 04:58:27', 'Shayna Brekke', '279-353-9638', 'schowalter.patricia@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(114, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241158275366', NULL, 'Hiram Ebert', 'deion.erdman@example.org', '1-912-738-8057', '6637 Stehr Junctions Suite 259\nPort Eunice, AZ 16104-8987', NULL, NULL, NULL, NULL, '33999999.00', '22294.00', '0.00', NULL, '0.00', '34022293.00', 2, 'paid', NULL, 1, 'delivered', NULL, NULL, '2024-09-25 04:58:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-25 04:58:27', '2025-08-24 04:58:27', 'Perry O\'Reilly', '808-693-8753', 'xpowlowski@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(115, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241158275797', NULL, 'Jacquelyn Hammes PhD', 'shad62@example.com', '1-832-446-0844', '3983 Mozell Village Suite 718\nPort Blazeton, NH 15750', NULL, NULL, NULL, NULL, '50500000.00', '23622.00', '0.00', NULL, '0.00', '50523622.00', 1, 'failed', NULL, 2, 'delivered', 'Ad eius id fugiat sequi magnam.', 'Reprehenderit illo eveniet velit numquam quo eius.', '2025-01-24 04:58:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-24 04:58:27', '2025-08-24 04:58:27', 'Shaylee Wisoky', '+1.860.214.5005', 'fmaggio@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(116, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241158274778', NULL, 'Vernice Donnelly PhD', 'hermiston.simone@example.net', '+1-254-777-4619', '84192 Mertz Estates\nDickensview, CT 06118', NULL, NULL, NULL, NULL, '110000000.00', '21374.00', '0.00', NULL, '0.00', '110021374.00', 1, 'paid', NULL, 2, 'delivered', NULL, NULL, '2024-11-13 04:58:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-13 04:58:27', '2025-08-24 04:58:27', 'Mr. Alex Cummerata Sr.', '551-528-8616', 'qnitzsche@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(117, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241158274189', NULL, 'Frances Kub', 'fkoepp@example.com', '+1 (651) 266-7752', '2011 Jamarcus Field Suite 319\nSpencertown, RI 38104', NULL, NULL, NULL, NULL, '50999999.00', '16963.00', '0.00', NULL, '0.00', '51016962.00', 2, 'failed', NULL, 1, 'delivered', NULL, 'Eum voluptatem nostrum veniam et minima.', '2024-12-30 04:58:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-30 04:58:27', '2025-08-24 04:58:27', 'Kristoffer Erdman', '785-939-6869', 'feeney.laron@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(118, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582718310', NULL, 'Josefina McGlynn', 'calista59@example.org', '+14198814375', '5374 Chasity Estates\nLeliamouth, NM 13156-2261', NULL, NULL, NULL, NULL, '36999999.00', '10555.00', '0.00', NULL, '0.00', '37010554.00', 2, 'paid', NULL, 2, 'delivered', 'Assumenda autem animi quia enim est.', NULL, '2025-03-05 04:58:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-05 04:58:27', '2025-08-24 04:58:28', 'Bianka Pollich', '1-940-256-4623', 'roxane.denesik@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(119, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582842011', NULL, 'Floyd Rosenbaum', 'abernathy.jaleel@example.net', '(283) 866-4137', '353 Lauryn Divide\nEast Vladimir, IA 06483-2709', NULL, NULL, NULL, NULL, '88999996.97', '13224.00', '0.00', NULL, '0.00', '89013220.97', 1, 'refunded', NULL, 1, 'delivered', NULL, 'Facilis aliquam asperiores voluptatem impedit quia pariatur sed sint.', '2024-08-29 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-08-29 04:58:28', '2025-08-24 04:58:28', 'Dudley Becker', '+1.908.257.3281', 'jtoy@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582837712', NULL, 'Jimmie Ratke', 'bartoletti.maya@example.org', '+1-669-266-7411', '910 Carey Mall\nPort Markusberg, WA 21965-6658', NULL, NULL, NULL, NULL, '41399999.98', '24935.00', '0.00', NULL, '0.00', '41424934.98', 1, 'refunded', NULL, 2, 'delivered', 'Est voluptate veritatis animi sunt voluptas ut aut id.', 'Et accusamus ipsa omnis.', '2025-04-17 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-17 04:58:28', '2025-08-24 04:58:28', 'Amya Torp', '+14589751633', 'haylie.schowalter@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(121, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582848213', NULL, 'Ruben Smith Sr.', 'ellis.howell@example.net', '989-924-6798', '99088 Farrell Brooks Apt. 759\nSouth Mariam, RI 64662-2285', NULL, NULL, NULL, NULL, '28499999.00', '11553.00', '0.00', NULL, '0.00', '28511552.00', 2, 'failed', NULL, 2, 'delivered', NULL, NULL, '2025-03-12 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-12 04:58:28', '2025-08-24 04:58:28', 'Francisco Bahringer', '703.466.4405', 'barbara.harber@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(122, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582870914', NULL, 'Oral Fritsch II', 'johnathon04@example.net', '+17438885774', '608 Marcellus Run Suite 549\nWest Clevelandmouth, MS 17579', NULL, NULL, NULL, NULL, '96999995.00', '10107.00', '0.00', NULL, '0.00', '97010102.00', 2, 'pending', NULL, 1, 'delivered', NULL, NULL, '2024-08-30 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-08-30 04:58:28', '2025-08-24 04:58:28', 'Prof. Liam Ullrich', '636.453.9147', 'beatty.jazmyn@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(123, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582893715', NULL, 'Emmitt Cummings', 'brock69@example.org', '906.214.4464', '971 Kertzmann Street Suite 113\nSchmittshire, NC 81443-0670', NULL, NULL, NULL, NULL, '101999999.00', '18269.00', '0.00', NULL, '0.00', '102018268.00', 1, 'paid', NULL, 2, 'delivered', NULL, NULL, '2025-03-11 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-11 04:58:28', '2025-08-24 04:58:28', 'Madelyn Mayert', '+1.302.384.1597', 'dstamm@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(124, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582850216', NULL, 'Miss Leanna McGlynn II', 'miguel.kulas@example.net', '+1-667-301-4607', '61053 Heidenreich Ranch\nLake Raheem, MT 68459-7144', NULL, NULL, NULL, NULL, '86099997.00', '25895.00', '0.00', NULL, '0.00', '86125892.00', 2, 'failed', NULL, 1, 'delivered', 'Magnam est consequatur itaque voluptatum porro.', NULL, '2025-01-10 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-10 04:58:28', '2025-08-24 04:58:28', 'Elijah Abernathy V', '+1.571.448.3030', 'janelle69@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(125, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582817017', NULL, 'Lilian Feeney IV', 'aiyana.schaefer@example.com', '+12317287145', '5132 DuBuque Burg\nMcKenzieville, WY 45129-6061', NULL, NULL, NULL, NULL, '110499999.00', '21420.00', '0.00', NULL, '0.00', '110521419.00', 1, 'refunded', NULL, 1, 'delivered', 'Et expedita atque deserunt.', NULL, '2024-12-28 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-28 04:58:28', '2025-08-24 04:58:28', 'Retta Labadie', '+17345722189', 'ratke.micaela@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(126, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582897718', NULL, 'Ressie Funk', 'sarmstrong@example.org', '(410) 356-0686', '968 Rosella Meadow\nRyderstad, NV 71692', NULL, NULL, NULL, NULL, '26100000.00', '15221.00', '0.00', NULL, '0.00', '26115221.00', 1, 'paid', NULL, 1, 'delivered', NULL, NULL, '2025-04-16 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-16 04:58:28', '2025-08-24 04:58:28', 'Mr. Deron Bayer', '+1 (504) 464-6008', 'demetrius64@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(127, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582844919', NULL, 'Ena Muller', 'rosenbaum.damion@example.org', '520.702.8678', '2842 Tromp Isle Apt. 340\nMcGlynnfort, WV 76250', NULL, NULL, NULL, NULL, '52999998.00', '23660.00', '0.00', NULL, '0.00', '53023658.00', 2, 'refunded', NULL, 2, 'delivered', NULL, 'Veritatis omnis voluptatibus sint nesciunt non id ut nam.', '2025-05-19 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-19 04:58:28', '2025-08-24 04:58:28', 'Larissa Breitenberg IV', '1-435-788-0947', 'estell41@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(128, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582852120', NULL, 'Bennie Herman', 'shyann.ernser@example.org', '318-713-5067', '578 Ryan Spurs\nNorth Eddie, AK 17020-3910', NULL, NULL, NULL, NULL, '67999997.00', '14254.00', '0.00', NULL, '0.00', '68014251.00', 1, 'failed', NULL, 1, 'delivered', NULL, 'Accusamus qui molestiae et aliquam exercitationem quia.', '2024-11-20 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-20 04:58:28', '2025-08-24 04:58:28', 'Prof. Zion Hackett Jr.', '380.901.4495', 'milford.harber@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(129, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582841521', NULL, 'Linnie Pfeffer', 'schneider.daphne@example.com', '(440) 376-4390', '4344 Witting Meadows Suite 019\nWest Laron, RI 60863-9984', NULL, NULL, NULL, NULL, '53199999.99', '11938.00', '0.00', NULL, '0.00', '53211937.99', 2, 'paid', NULL, 2, 'delivered', 'Nemo magnam maiores eos accusantium.', NULL, '2024-09-08 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-08 04:58:28', '2025-08-24 04:58:28', 'Carlee Kessler', '+1-351-327-6582', 'ellsworth.mcdermott@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(130, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582818922', NULL, 'Marquise Bradtke', 'bfarrell@example.org', '(847) 658-2395', '9722 Haag Ford Suite 396\nRosalindaview, HI 60512-6763', NULL, NULL, NULL, NULL, '22000000.00', '21946.00', '0.00', NULL, '0.00', '22021946.00', 2, 'paid', NULL, 2, 'delivered', NULL, 'Fugiat laboriosam architecto sunt quaerat enim nobis eaque.', '2025-01-12 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-12 04:58:28', '2025-08-24 04:58:28', 'Hobart Daugherty', '551-335-1864', 'letitia88@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(131, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582866623', NULL, 'Gino Klocko', 'lue.denesik@example.org', '+1.831.206.9911', '89489 Ebert Lakes\nNeomaborough, ID 50657-0280', NULL, NULL, NULL, NULL, '73999996.99', '15256.00', '0.00', NULL, '0.00', '74015252.99', 1, 'pending', NULL, 2, 'delivered', 'Odio corporis occaecati similique dicta illum.', 'Asperiores voluptatem libero nulla at minus consequuntur sit.', '2024-11-23 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-23 04:58:28', '2025-08-24 04:58:28', 'Velva Stark Jr.', '320-851-7823', 'kshlerin.catalina@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(132, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582848424', NULL, 'Louie Hilpert', 'vdickens@example.org', '+1-339-588-6324', '554 Konopelski Unions\nCarrollton, ME 94159-7767', NULL, NULL, NULL, NULL, '109999998.00', '23646.00', '0.00', NULL, '0.00', '110023644.00', 1, 'paid', NULL, 2, 'delivered', 'Est quia dolore delectus et.', NULL, '2025-07-24 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-24 04:58:28', '2025-08-24 04:58:28', 'Abbigail Gleason', '586.782.5526', 'thelma.hettinger@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(133, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582847325', NULL, 'Krista Frami', 'arch.ryan@example.com', '+1.385.868.6453', '810 Alexzander Green\nGoodwinville, NE 35655', NULL, NULL, NULL, NULL, '64999999.98', '28829.00', '0.00', NULL, '0.00', '65028828.98', 2, 'refunded', NULL, 1, 'delivered', NULL, NULL, '2025-05-13 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-13 04:58:28', '2025-08-24 04:58:28', 'Myrtie Rowe', '+1.747.440.0196', 'uhaley@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(134, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582875626', NULL, 'Annamae Murazik', 'junior.schuster@example.org', '(223) 406-3415', '7238 Batz Motorway\nWoodrowburgh, AK 37519', NULL, NULL, NULL, NULL, '37999998.00', '24554.00', '0.00', NULL, '0.00', '38024552.00', 1, 'pending', NULL, 1, 'delivered', 'Iusto quo aut fuga vitae sed.', NULL, '2024-10-22 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-22 04:58:28', '2025-08-24 04:58:28', 'Herbert Anderson', '424.597.3514', 'ichristiansen@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(135, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582892927', NULL, 'Shanie Senger', 'khoeger@example.net', '+1 (407) 656-4060', '3987 Runolfsdottir Pass Suite 158\nPort Corinehaven, RI 36879', NULL, NULL, NULL, NULL, '18999999.00', '28697.00', '0.00', NULL, '0.00', '19028696.00', 1, 'refunded', NULL, 1, 'delivered', NULL, NULL, '2025-07-04 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-04 04:58:28', '2025-08-24 04:58:28', 'Vernie Terry', '1-719-969-5255', 'hayes.kellie@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(136, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582812028', NULL, 'Abigayle Wiza', 'margarette.mohr@example.com', '330-793-1209', '498 Sanford Mall Suite 987\nEast Lorifurt, MA 21288', NULL, NULL, NULL, NULL, '38099999.98', '15723.00', '0.00', NULL, '0.00', '38115722.98', 2, 'paid', NULL, 1, 'delivered', NULL, NULL, '2025-01-31 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-31 04:58:28', '2025-08-24 04:58:28', 'Mrs. Margie Becker', '+1 (681) 653-1236', 'harrison94@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(137, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582865929', NULL, 'Virginia Stamm', 'theresa.labadie@example.net', '+1-208-349-9683', '2033 Ryan Trail Suite 586\nLake Wallace, MT 62371', NULL, NULL, NULL, NULL, '18999999.00', '18708.00', '0.00', NULL, '0.00', '19018707.00', 2, 'refunded', NULL, 2, 'delivered', NULL, NULL, '2025-03-22 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-22 04:58:28', '2025-08-24 04:58:28', 'Donna Feil', '+1 (364) 693-7741', 'ocole@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(138, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582874530', NULL, 'Fredrick Lynch', 'cory86@example.com', '+1 (570) 307-7849', '825 Geo Motorway Suite 015\nSouth Grantfort, AR 03110', NULL, NULL, NULL, NULL, '58999999.98', '16586.00', '0.00', NULL, '0.00', '59016585.98', 1, 'failed', NULL, 2, 'delivered', 'Quaerat iusto explicabo quia maiores.', NULL, '2025-05-18 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-18 04:58:28', '2025-08-24 04:58:28', 'Prof. Lane Nitzsche', '281-678-4069', 'clarabelle.friesen@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(139, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582869331', NULL, 'Prof. Darrin McLaughlin', 'tate27@example.com', '+1 (423) 351-0704', '681 Schaefer Valleys\nMarcshire, IA 47688', NULL, NULL, NULL, NULL, '5000000.00', '16472.00', '0.00', NULL, '0.00', '5016472.00', 1, 'failed', NULL, 2, 'delivered', NULL, NULL, '2024-09-08 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-08 04:58:28', '2025-08-24 04:58:28', 'Paul Leffler', '1-856-667-4370', 'sean65@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(140, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582890732', NULL, 'Mrs. Magdalen Runte', 'uschaden@example.net', '+1-505-660-1350', '79439 Anna Ports Apt. 770\nShannachester, UT 40748', NULL, NULL, NULL, NULL, '47099998.99', '17480.00', '0.00', NULL, '0.00', '47117478.99', 1, 'refunded', NULL, 2, 'delivered', 'Nesciunt fuga cupiditate officiis molestiae impedit.', NULL, '2025-01-27 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-27 04:58:28', '2025-08-24 04:58:28', 'Matilda Ullrich', '+1-217-564-3832', 'katarina67@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(141, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582885733', NULL, 'Mr. Alexie Graham', 'vwaters@example.com', '704.399.1021', '897 Kihn Mall Suite 441\nLaurenville, WA 90781', NULL, NULL, NULL, NULL, '94699996.96', '23946.00', '0.00', NULL, '0.00', '94723942.96', 1, 'refunded', NULL, 1, 'delivered', NULL, 'Sit excepturi id earum nobis.', '2024-09-30 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-30 04:58:28', '2025-08-24 04:58:28', 'Sydney Gulgowski', '(478) 262-1985', 'jmurphy@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(142, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582897934', NULL, 'Miss Ettie Macejkovic', 'meghan53@example.net', '1-559-925-6276', '712 Jaskolski Street Apt. 106\nJenningsland, AL 70555-0113', NULL, NULL, NULL, NULL, '18999999.00', '14399.00', '0.00', NULL, '0.00', '19014398.00', 1, 'refunded', NULL, 2, 'delivered', 'Cumque nisi voluptatibus et eius sint ab.', NULL, '2025-01-19 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-19 04:58:28', '2025-08-24 04:58:28', 'Prof. Iva Metz', '+16466999847', 'leffler.bella@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(143, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582885735', NULL, 'Maye Conn', 'imani90@example.net', '(731) 454-0805', '6686 Rosendo Orchard\nWelchbury, RI 10471', NULL, NULL, NULL, NULL, '52999999.97', '10173.00', '0.00', NULL, '0.00', '53010172.97', 2, 'refunded', NULL, 1, 'delivered', NULL, NULL, '2025-06-01 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-01 04:58:28', '2025-08-24 04:58:28', 'Prof. Retta Balistreri MD', '(979) 267-8030', 'lizzie66@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(144, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582889936', NULL, 'Myrl Funk Sr.', 'ken49@example.com', '1-346-936-2249', '13885 Jaime Port Apt. 505\nDeckowfurt, AL 97628', NULL, NULL, NULL, NULL, '145199997.99', '26734.00', '0.00', NULL, '0.00', '145226731.99', 2, 'paid', NULL, 1, 'delivered', 'Et eius officiis mollitia porro recusandae.', NULL, '2024-10-05 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-05 04:58:28', '2025-08-24 04:58:28', 'Lia Ward', '+1.469.355.5801', 'murray.fannie@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(145, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582840037', NULL, 'Vida Medhurst Sr.', 'elody.tillman@example.com', '(480) 647-7536', '3783 Cassin Drives\nAveryfort, LA 21827-6223', NULL, NULL, NULL, NULL, '62499999.00', '17326.00', '0.00', NULL, '0.00', '62517325.00', 2, 'refunded', NULL, 2, 'delivered', NULL, NULL, '2025-05-23 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-23 04:58:28', '2025-08-24 04:58:28', 'Augustus Aufderhar', '562-318-1763', 'ava.terry@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(146, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582851538', NULL, 'Ms. Hailie Ankunding DVM', 'weimann.savanah@example.org', '1-715-537-4019', '279 Effertz Alley\nHellermouth, WI 37696-9181', NULL, NULL, NULL, NULL, '73399997.99', '22416.00', '0.00', NULL, '0.00', '73422413.99', 1, 'paid', NULL, 2, 'delivered', 'Facere magni rerum blanditiis qui doloribus alias deserunt sed.', 'Numquam similique rerum consequatur ut qui quae.', '2024-09-21 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-21 04:58:28', '2025-08-24 04:58:28', 'Lilla Lakin', '404-520-0482', 'connie.schinner@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(147, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582852739', NULL, 'Elsie Casper', 'rjones@example.com', '(623) 386-1418', '2317 Leif Heights\nEast Marjolaine, NV 47045-7790', NULL, NULL, NULL, NULL, '19999999.00', '19023.00', '0.00', NULL, '0.00', '20019022.00', 1, 'paid', NULL, 2, 'delivered', 'Consequatur quam ducimus veritatis commodi et.', NULL, '2025-02-17 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-02-17 04:58:28', '2025-08-24 04:58:28', 'Dr. Nico Paucek PhD', '+1.534.791.8518', 'janae94@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(148, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582847940', NULL, 'Ray Conroy', 'vincent.wisoky@example.org', '(814) 676-4781', '302 Labadie Ways\nDoylestad, VA 71596-7576', NULL, NULL, NULL, NULL, '38400000.00', '17311.00', '0.00', NULL, '0.00', '38417311.00', 2, 'pending', NULL, 1, 'delivered', 'Totam pariatur perspiciatis facilis rerum reprehenderit optio.', 'Voluptas maxime voluptatum occaecati.', '2024-09-04 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-04 04:58:28', '2025-08-24 04:58:28', 'Mrs. Adela Sanford', '1-786-788-8681', 'francisco10@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(149, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582874041', NULL, 'Gerson Grant MD', 'goodwin.jayne@example.com', '501-670-0011', '64746 Darrion Circles Apt. 535\nMarciaville, OK 08880-4855', NULL, NULL, NULL, NULL, '40699999.99', '12811.00', '0.00', NULL, '0.00', '40712810.99', 1, 'failed', NULL, 1, 'delivered', NULL, 'Ipsam vero quod sit explicabo.', '2024-11-18 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-18 04:58:28', '2025-08-24 04:58:28', 'Ayden Yost', '1-341-220-1702', 'cwilliamson@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(150, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582880442', NULL, 'Elliot Gerhold', 'conner39@example.com', '+1-770-576-9699', '3938 Gutmann Street Suite 587\nMcKenziemouth, IL 17042-4178', NULL, NULL, NULL, NULL, '101999997.97', '29012.00', '0.00', NULL, '0.00', '102029009.97', 2, 'pending', NULL, 2, 'delivered', 'Ut repellat saepe praesentium impedit commodi consectetur ut.', 'Porro quo ea et quam veniam sit quis laudantium.', '2024-10-22 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-22 04:58:28', '2025-08-24 04:58:28', 'Thelma Haag', '+1.301.577.6454', 'quinn.ondricka@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(151, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582818643', NULL, 'Gaston McLaughlin Jr.', 'turner.nicholaus@example.com', '423-849-3125', '61565 Little Road\nBrakusside, RI 52030-5621', NULL, NULL, NULL, NULL, '15000000.00', '11760.00', '0.00', NULL, '0.00', '15011760.00', 1, 'refunded', NULL, 1, 'delivered', 'Ut dignissimos quia quia non assumenda ducimus.', 'Iste voluptatum possimus sit et magni distinctio illo.', '2024-12-27 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-27 04:58:28', '2025-08-24 04:58:28', 'Mr. Jaleel Weimann I', '(413) 861-3510', 'queenie.cole@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(152, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582855144', NULL, 'Ms. Athena Wolff', 'mavis22@example.net', '1-520-865-2507', '1788 Marion Junction Apt. 767\nNew Karenmouth, MD 79715-1561', NULL, NULL, NULL, NULL, '71099997.99', '22148.00', '0.00', NULL, '0.00', '71122145.99', 2, 'failed', NULL, 1, 'delivered', NULL, 'Doloremque velit consequatur est velit accusamus quisquam sunt.', '2024-11-07 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-07 04:58:28', '2025-08-24 04:58:28', 'Alda Green MD', '(213) 789-3563', 'lizeth.thompson@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(153, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582813045', NULL, 'Prof. Macey McCullough', 'herta.hegmann@example.com', '+13809777142', '40712 Liana Dale Apt. 413\nNorth Shaynechester, IN 78269', NULL, NULL, NULL, NULL, '39999998.97', '12772.00', '0.00', NULL, '0.00', '40012770.97', 2, 'refunded', NULL, 2, 'delivered', NULL, NULL, '2025-07-30 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-30 04:58:28', '2025-08-24 04:58:28', 'Vita Krajcik', '240-213-0700', 'strosin.estell@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(154, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582876346', NULL, 'Celia Altenwerth II', 'lcormier@example.com', '+14423972799', '53995 Jazmin Drive Suite 347\nGabrielleside, WY 54788-6832', NULL, NULL, NULL, NULL, '15000000.00', '27362.00', '0.00', NULL, '0.00', '15027362.00', 2, 'pending', NULL, 2, 'delivered', 'Consectetur porro fuga molestias soluta autem.', NULL, '2024-11-13 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-13 04:58:28', '2025-08-24 04:58:28', 'Norma Olson', '1-717-925-8892', 'bennett.shields@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(155, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582840747', NULL, 'Benny Senger', 'dena16@example.org', '857.944.7941', '35963 Lee Drives\nOletaview, MO 14527', NULL, NULL, NULL, NULL, '89999996.96', '21880.00', '0.00', NULL, '0.00', '90021876.96', 1, 'refunded', NULL, 1, 'delivered', NULL, NULL, '2024-12-14 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-14 04:58:28', '2025-08-24 04:58:28', 'Asa Blanda', '(979) 861-4439', 'nicolas05@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(156, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582874048', NULL, 'Mrs. Rubye Funk IV', 'bcummerata@example.org', '518-652-4581', '34604 Frami Fall\nWest Murl, ME 40937', NULL, NULL, NULL, NULL, '6999999.99', '25150.00', '0.00', NULL, '0.00', '7025149.99', 2, 'paid', NULL, 2, 'delivered', 'Voluptatem earum mollitia labore eveniet voluptatem consequatur.', 'Est et aspernatur corporis.', '2025-06-18 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-18 04:58:28', '2025-08-24 04:58:28', 'Shad Halvorson DVM', '505-637-1528', 'ahuel@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(157, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582870549', NULL, 'Adonis Connelly IV', 'buckridge.cleo@example.net', '864-697-0604', '41913 Tommie Trafficway Suite 735\nQuigleybury, MO 77610-1378', NULL, NULL, NULL, NULL, '101099999.97', '28014.00', '0.00', NULL, '0.00', '101128013.97', 1, 'paid', NULL, 2, 'delivered', NULL, 'Placeat et consectetur itaque aliquam.', '2024-09-03 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-03 04:58:28', '2025-08-24 04:58:28', 'Pedro Tromp DDS', '(458) 421-6938', 'laury.runolfsdottir@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(158, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582812450', NULL, 'Karley Kerluke', 'neoma51@example.org', '469.375.3235', '538 Nia Ranch Suite 960\nNew Roslyntown, NJ 67242-1537', NULL, NULL, NULL, NULL, '13999999.98', '17001.00', '0.00', NULL, '0.00', '14017000.98', 1, 'pending', NULL, 1, 'delivered', 'Vel earum officia rerum delectus ipsam.', NULL, '2024-08-26 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-08-26 04:58:28', '2025-08-24 04:58:28', 'Anahi Considine', '1-305-344-5134', 'walsh.alessandro@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(159, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582825251', NULL, 'Graciela Lueilwitz', 'vbrown@example.org', '(734) 840-4586', '320 Ken Mall Suite 037\nBeahanberg, NJ 12935', NULL, NULL, NULL, NULL, '23999999.98', '27938.00', '0.00', NULL, '0.00', '24027937.98', 2, 'failed', NULL, 1, 'delivered', 'Nihil cupiditate odio ratione optio ab fugit.', NULL, '2025-08-20 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-20 04:58:28', '2025-08-24 04:58:28', 'Bertha Stehr', '+1 (434) 886-1168', 'opal93@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(160, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582882652', NULL, 'Prof. Albin Jakubowski II', 'inader@example.com', '+1 (331) 453-7220', '423 Murphy Estates Apt. 268\nJordanberg, AK 92132', NULL, NULL, NULL, NULL, '5000000.00', '12508.00', '0.00', NULL, '0.00', '5012508.00', 2, 'refunded', NULL, 1, 'delivered', 'Aut porro velit est esse rerum et omnis ut.', NULL, '2025-07-10 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-10 04:58:28', '2025-08-24 04:58:28', 'Allan Kuphal', '1-220-613-8554', 'mohr.angelina@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(161, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582899253', NULL, 'Mr. Vernon Langworth DVM', 'leuschke.pansy@example.net', '(567) 300-3880', '119 Jaylin Villages Suite 533\nHaskellview, HI 95439-2564', NULL, NULL, NULL, NULL, '90999999.99', '18319.00', '0.00', NULL, '0.00', '91018318.99', 2, 'refunded', NULL, 2, 'delivered', NULL, NULL, '2025-02-21 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-02-21 04:58:28', '2025-08-24 04:58:28', 'Laurel Green', '(225) 435-4997', 'emie.lindgren@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(162, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582881654', NULL, 'Zachery Willms', 'tromp.rosario@example.com', '912.802.5098', '358 Odie Village\nLake Georgettefurt, NE 29519-0201', NULL, NULL, NULL, NULL, '43100000.00', '19689.00', '0.00', NULL, '0.00', '43119689.00', 2, 'refunded', NULL, 1, 'delivered', NULL, NULL, '2025-07-03 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-03 04:58:28', '2025-08-24 04:58:28', 'Prof. Cleo Maggio Sr.', '854.685.2890', 'cordell.conn@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(163, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582866655', NULL, 'Breana Luettgen', 'lpurdy@example.com', '409-724-0126', '800 Yasmine Drives\nPort Milo, MA 61018', NULL, NULL, NULL, NULL, '44400000.00', '12260.00', '0.00', NULL, '0.00', '44412260.00', 1, 'failed', NULL, 1, 'delivered', 'In quia et omnis est blanditiis qui quia nemo.', NULL, '2024-09-01 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-01 04:58:28', '2025-08-24 04:58:28', 'Magdalen Bayer Jr.', '781.913.0316', 'torp.josefina@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(164, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582828756', NULL, 'Anibal Blanda', 'francesca.thompson@example.com', '+1-520-415-3599', '8085 Tromp Glen Suite 579\nVioletfurt, NH 16525', NULL, NULL, NULL, NULL, '112999996.00', '19928.00', '0.00', NULL, '0.00', '113019924.00', 1, 'failed', NULL, 1, 'delivered', 'Nobis dolorum suscipit modi.', 'Harum temporibus aliquam et est porro ipsum velit qui.', '2025-06-15 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-15 04:58:28', '2025-08-24 04:58:28', 'Summer Cole Sr.', '+1 (820) 546-6464', 'bgrant@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `orders` (`id`, `user_id`, `shipper_id`, `received_at`, `in_delivery_at`, `failed_at`, `delivery_notes`, `failure_reason`, `delivery_images`, `order_code`, `transaction_id`, `customer_name`, `customer_email`, `customer_phone`, `shipping_address`, `buyer_name`, `buyer_email`, `buyer_phone`, `buyer_address`, `subtotal_amount`, `shipping_fee`, `discount_amount`, `discount_code`, `tax_amount`, `total_amount`, `payment_method_id`, `payment_status`, `payment_details`, `shipping_method_id`, `order_status`, `customer_note`, `admin_note`, `ordered_at`, `processing_at`, `shipped_at`, `delivered_at`, `cancelled_at`, `returned_at`, `cancellation_reason`, `pending_refund`, `previous_status`, `created_at`, `updated_at`, `shipping_name`, `shipping_phone`, `shipping_email`, `shipping_lat`, `shipping_lng`, `delivery_lat`, `delivery_lng`, `delivery_started_at`, `delivery_completed_at`, `delivery_address`, `vnp_transaction_no`, `vnp_transaction_date`) VALUES
(165, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582834357', NULL, 'Darrin Lind', 'mosciski.rashawn@example.org', '1-283-642-5523', '3735 Cordell Extensions\nWest Camron, VA 34679-1372', NULL, NULL, NULL, NULL, '80999996.00', '19369.00', '0.00', NULL, '0.00', '81019365.00', 2, 'refunded', NULL, 1, 'delivered', NULL, 'Corporis harum eveniet accusantium exercitationem dolorum est illum.', '2025-08-06 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-06 04:58:28', '2025-08-24 04:58:28', 'Christina Beatty', '+18316346131', 'issac.shanahan@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(166, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582875658', NULL, 'Vince Bosco IV', 'hadley.walter@example.com', '+1-940-447-1417', '470 Wilkinson Square\nNorth Brionna, KS 12044-3560', NULL, NULL, NULL, NULL, '86099996.97', '12931.00', '0.00', NULL, '0.00', '86112927.97', 1, 'pending', NULL, 2, 'delivered', NULL, 'Corrupti laudantium qui est nam.', '2024-10-31 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-31 04:58:28', '2025-08-24 04:58:28', 'Mr. Casey Homenick', '815-860-1919', 'levi61@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(167, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582871459', NULL, 'Hector Hodkiewicz I', 'nedra49@example.com', '1-478-851-0727', '94440 May Roads Suite 911\nClovisbury, CA 21191-9232', NULL, NULL, NULL, NULL, '30699999.96', '19724.00', '0.00', NULL, '0.00', '30719723.96', 1, 'paid', NULL, 2, 'delivered', 'Odit rerum ducimus perferendis.', NULL, '2025-04-12 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-12 04:58:28', '2025-08-24 04:58:28', 'Dr. Jayson Considine PhD', '530.368.4378', 'archibald51@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(168, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582824760', NULL, 'Haleigh Bins', 'isabella.batz@example.org', '(763) 951-8534', '985 Adalberto Corners\nAvamouth, MT 39307-9320', NULL, NULL, NULL, NULL, '48999999.93', '23003.00', '0.00', NULL, '0.00', '49023002.93', 1, 'pending', NULL, 2, 'delivered', NULL, 'Vitae dolore nulla voluptatem ipsam consectetur.', '2024-10-16 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-16 04:58:28', '2025-08-24 04:58:28', 'Miss Precious Ullrich', '682-441-9400', 'armstrong.nathanial@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(169, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582814561', NULL, 'Mr. Norval Koelpin', 'audrey.kling@example.org', '262-203-0766', '697 O\'Keefe Drive Suite 683\nNorth Brett, CA 27000-9752', NULL, NULL, NULL, NULL, '104999999.97', '24871.00', '0.00', NULL, '0.00', '105024870.97', 1, 'refunded', NULL, 1, 'delivered', 'Et reiciendis ut repellendus.', NULL, '2024-10-07 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-07 04:58:28', '2025-08-24 04:58:28', 'Prof. Osborne Macejkovic Sr.', '+17379539412', 'odeckow@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(170, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582841462', NULL, 'Mr. Ross Stamm Jr.', 'becker.vickie@example.net', '657-970-9666', '2346 Emile Circles\nNew Felicity, MI 44025-1612', NULL, NULL, NULL, NULL, '5000000.00', '18045.00', '0.00', NULL, '0.00', '5018045.00', 2, 'failed', NULL, 2, 'delivered', 'Minima aspernatur animi qui nostrum.', 'Quia modi et aut facilis.', '2025-01-03 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-03 04:58:28', '2025-08-24 04:58:28', 'Jakob Johns', '(332) 988-4345', 'hipolito65@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(171, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582870163', NULL, 'Noemie Hirthe', 'hirthe.rafaela@example.net', '785.595.8861', '699 Constance Rapids Suite 336\nNorth Pansy, SC 14201', NULL, NULL, NULL, NULL, '13999999.98', '14496.00', '0.00', NULL, '0.00', '14014495.98', 2, 'paid', NULL, 2, 'delivered', 'Cum delectus porro voluptas hic blanditiis non.', NULL, '2024-10-01 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-01 04:58:28', '2025-08-24 04:58:28', 'Johanna Upton', '+1-520-308-9045', 'stephen97@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(172, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582888564', NULL, 'Dr. Corine Huels', 'arvid61@example.org', '(986) 924-8976', '491 Ayla Isle\nNorth Faye, FL 10041-1995', NULL, NULL, NULL, NULL, '14699999.99', '26919.00', '0.00', NULL, '0.00', '14726918.99', 1, 'refunded', NULL, 2, 'delivered', 'Beatae rerum voluptatem dolor nesciunt.', NULL, '2025-06-27 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-27 04:58:28', '2025-08-24 04:58:28', 'Robert Terry V', '+1-678-345-6189', 'ashton34@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(173, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582897565', NULL, 'Lucas Kassulke IV', 'lthiel@example.org', '1-283-677-5330', '7814 Lourdes Valley\nShieldsshire, RI 76923', NULL, NULL, NULL, NULL, '62899999.00', '10109.00', '0.00', NULL, '0.00', '62910108.00', 2, 'paid', NULL, 2, 'delivered', NULL, NULL, '2025-04-14 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-14 04:58:28', '2025-08-24 04:58:28', 'Dr. German Hudson V', '1-210-678-4935', 'hhartmann@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(174, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582870666', NULL, 'Santiago Luettgen', 'zechariah.runte@example.org', '+14125068960', '343 Nicolas Villages Suite 119\nErnserberg, IN 86941-0034', NULL, NULL, NULL, NULL, '88699996.00', '27396.00', '0.00', NULL, '0.00', '88727392.00', 1, 'refunded', NULL, 2, 'delivered', NULL, NULL, '2024-11-06 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-06 04:58:28', '2025-08-24 04:58:28', 'Ms. Delores Cronin II', '631-360-4693', 'oreilly.kenna@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(175, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582852167', NULL, 'Johanna Cummerata', 'ykuphal@example.net', '781.715.4770', '56865 Lew Shoals\nWest Herthafort, MS 53383', NULL, NULL, NULL, NULL, '70099999.95', '13625.00', '0.00', NULL, '0.00', '70113624.95', 1, 'failed', NULL, 1, 'delivered', NULL, 'Veritatis quasi dolorum eum sunt saepe expedita vel.', '2024-08-29 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-08-29 04:58:28', '2025-08-24 04:58:28', 'Delphine Moen', '+1 (717) 624-8323', 'haag.raul@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(176, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582867668', NULL, 'Aletha Monahan DVM', 'block.bria@example.org', '1-657-360-6050', '934 Dion Brook Apt. 837\nPort Dustinbury, DC 88568-3970', NULL, NULL, NULL, NULL, '68999996.99', '28076.00', '0.00', NULL, '0.00', '69028072.99', 1, 'refunded', NULL, 1, 'delivered', NULL, NULL, '2024-10-12 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-12 04:58:28', '2025-08-24 04:58:28', 'Davonte Brekke III', '+1.339.828.4798', 'lesch.kariane@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(177, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582879669', NULL, 'Koby Hettinger', 'prosacco.isabella@example.org', '216.506.2539', '45140 Eliezer Shoal Suite 256\nNew Soledadstad, NH 47895-1168', NULL, NULL, NULL, NULL, '128999999.97', '19646.00', '0.00', NULL, '0.00', '129019645.97', 2, 'failed', NULL, 1, 'delivered', NULL, 'Id vel officiis ut atque corporis.', '2025-08-04 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-04 04:58:28', '2025-08-24 04:58:28', 'Prof. Cordelia Jacobson DDS', '+1 (657) 759-1988', 'jcummerata@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(178, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582895170', NULL, 'Mr. Nels Yost', 'urunte@example.com', '727-799-1827', '78637 Janae Vista Apt. 106\nSouth Antwanfort, IL 37082-5362', NULL, NULL, NULL, NULL, '107099998.97', '29458.00', '0.00', NULL, '0.00', '107129456.97', 1, 'refunded', NULL, 2, 'delivered', 'Tempora expedita fugiat autem repudiandae laborum.', NULL, '2025-03-15 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-15 04:58:28', '2025-08-24 04:58:28', 'Sebastian Jacobson', '(732) 557-8123', 'ona.baumbach@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(179, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582874671', NULL, 'Dr. Gabriel Konopelski', 'hirthe.lempi@example.net', '+15045622038', '65721 Wilmer Points Suite 434\nWest Carmelo, AL 87154', NULL, NULL, NULL, NULL, '35999999.98', '13866.00', '0.00', NULL, '0.00', '36013865.98', 1, 'refunded', NULL, 2, 'delivered', NULL, NULL, '2025-06-27 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-27 04:58:28', '2025-08-24 04:58:28', 'Guy Kunde', '1-828-396-3492', 'demetris03@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(180, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582874672', NULL, 'Mr. Samir Ernser DVM', 'shayna62@example.net', '+19849784741', '240 Gibson Turnpike\nPort Alexysmouth, CO 46934', NULL, NULL, NULL, NULL, '79999996.00', '23897.00', '0.00', NULL, '0.00', '80023893.00', 2, 'refunded', NULL, 2, 'delivered', NULL, NULL, '2024-10-18 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-18 04:58:28', '2025-08-24 04:58:28', 'Dave Barton V', '+1-321-874-7000', 'juana.hansen@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(181, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582880573', NULL, 'Macey Boyer II', 'bernardo.reichert@example.net', '610-797-2596', '15131 Spinka Expressway Apt. 589\nPort Dianna, OK 93913', NULL, NULL, NULL, NULL, '116999994.00', '17063.00', '0.00', NULL, '0.00', '117017057.00', 2, 'failed', NULL, 2, 'delivered', 'Eius tenetur in laudantium quia iusto.', 'Ut tenetur aut soluta beatae nisi rem occaecati.', '2025-05-09 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-09 04:58:28', '2025-08-24 04:58:28', 'Tyrel Kemmer', '803.793.9785', 'kris44@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(182, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582876374', NULL, 'Mrs. Anastasia Walter DVM', 'wilbert49@example.org', '+1-972-636-8426', '56063 Schimmel Mills\nNew Serena, MI 89024-8904', NULL, NULL, NULL, NULL, '20999999.97', '10813.00', '0.00', NULL, '0.00', '21010812.97', 1, 'pending', NULL, 1, 'delivered', NULL, 'Eveniet deleniti blanditiis aut fuga provident.', '2024-09-15 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-15 04:58:28', '2025-08-24 04:58:28', 'Miss Gisselle Zieme Jr.', '+1 (623) 278-5594', 'bettie.hoeger@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(183, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582818775', NULL, 'Arielle Steuber Jr.', 'aylin01@example.net', '+1-272-468-1497', '598 Rau Common\nSouth Dedricfort, WV 48163', NULL, NULL, NULL, NULL, '80999997.00', '17303.00', '0.00', NULL, '0.00', '81017300.00', 2, 'pending', NULL, 1, 'delivered', 'Delectus illum consectetur veritatis sint esse consequatur laboriosam.', NULL, '2025-07-06 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-06 04:58:28', '2025-08-24 04:58:28', 'Alba Wolff', '(562) 203-9178', 'sim62@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(184, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582861876', NULL, 'Dr. Kendall Ratke II', 'mayra14@example.net', '+18727729369', '445 Ayla Row\nWest Gussieside, CA 86819', NULL, NULL, NULL, NULL, '17000000.00', '20856.00', '0.00', NULL, '0.00', '17020856.00', 1, 'failed', NULL, 2, 'delivered', NULL, NULL, '2025-06-25 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-25 04:58:28', '2025-08-24 04:58:28', 'Dr. Deondre Anderson', '1-602-306-5302', 'mschimmel@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(185, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582844577', NULL, 'Dr. Gabriel Skiles', 'sincere78@example.org', '406.253.5604', '9905 Elisha Creek\nLake Orrinside, MN 01378', NULL, NULL, NULL, NULL, '17400000.00', '20701.00', '0.00', NULL, '0.00', '17420701.00', 1, 'paid', NULL, 1, 'delivered', NULL, NULL, '2024-09-28 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-28 04:58:28', '2025-08-24 04:58:28', 'Ubaldo Hartmann', '925.585.3393', 'goyette.hailey@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(186, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582833978', NULL, 'Prof. Adrianna Huels Sr.', 'knikolaus@example.net', '+1-814-948-8115', '2443 Jasen Springs Apt. 998\nTorpfort, RI 09628', NULL, NULL, NULL, NULL, '101099999.95', '23648.00', '0.00', NULL, '0.00', '101123647.95', 1, 'pending', NULL, 2, 'delivered', 'Dolorem iure ut impedit.', NULL, '2025-02-20 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-02-20 04:58:28', '2025-08-24 04:58:28', 'Prof. Wayne Wolff', '+1-661-920-7294', 'schultz.bradford@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(187, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582850879', NULL, 'Prof. Delpha Price', 'astrid.wolff@example.org', '+1 (754) 850-2728', '74460 Berenice Garden\nLake Josieburgh, SD 21063-4361', NULL, NULL, NULL, NULL, '32400000.00', '20161.00', '0.00', NULL, '0.00', '32420161.00', 2, 'pending', NULL, 2, 'delivered', 'Esse optio voluptate itaque qui libero.', NULL, '2025-06-11 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-11 04:58:28', '2025-08-24 04:58:28', 'Armani West', '+1 (701) 695-1847', 'jacobi.alexie@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(188, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582811680', NULL, 'Allison Grady', 'yoshiko.yundt@example.org', '(805) 753-6736', '188 Mraz Alley\nNorth Alfredaport, RI 18931-8724', NULL, NULL, NULL, NULL, '161699995.99', '17556.00', '0.00', NULL, '0.00', '161717551.99', 2, 'failed', NULL, 2, 'delivered', 'Ipsam dolores aut ut assumenda nihil architecto aliquid.', NULL, '2024-11-08 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-08 04:58:28', '2025-08-24 04:58:28', 'Marilie Toy', '803.459.7475', 'boris.ebert@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(189, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582845781', NULL, 'Marietta Cormier', 'emile.kassulke@example.com', '+13516243756', '156 Grant Loop\nPfefferburgh, DE 91532', NULL, NULL, NULL, NULL, '99699995.99', '15476.00', '0.00', NULL, '0.00', '99715471.99', 1, 'paid', NULL, 2, 'delivered', NULL, NULL, '2024-10-16 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-16 04:58:28', '2025-08-24 04:58:28', 'Stefanie Rath PhD', '1-667-328-7567', 'astrid.jenkins@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(190, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582866382', NULL, 'Dr. Angeline Kohler I', 'rahsaan46@example.com', '+15857291490', '7130 Green Flat\nAnyafort, MS 31593', NULL, NULL, NULL, NULL, '89999997.97', '27040.00', '0.00', NULL, '0.00', '90027037.97', 1, 'refunded', NULL, 1, 'delivered', NULL, NULL, '2025-03-23 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-23 04:58:28', '2025-08-24 04:58:28', 'Nicole Bergnaum', '+1-952-880-8020', 'oconner.lukas@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(191, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582837583', NULL, 'Delphine Cartwright', 'otis34@example.net', '(801) 767-3011', '904 Santina Branch\nNorth Maxiemouth, ME 97445-6570', NULL, NULL, NULL, NULL, '42399999.00', '26854.00', '0.00', NULL, '0.00', '42426853.00', 1, 'refunded', NULL, 1, 'delivered', NULL, 'Ut dolores quia aut incidunt.', '2024-09-24 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-24 04:58:28', '2025-08-24 04:58:28', 'Leif Thiel', '+1 (315) 256-8929', 'simonis.keira@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(192, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582888284', NULL, 'Coralie Blick III', 'hollie76@example.net', '(941) 855-9809', '78478 Earlene Landing\nHoegerfort, NH 58649-5785', NULL, NULL, NULL, NULL, '20999999.97', '24414.00', '0.00', NULL, '0.00', '21024413.97', 1, 'pending', NULL, 2, 'delivered', 'Accusantium similique provident necessitatibus harum optio sed.', 'Molestias assumenda fugit et omnis illum quo sequi.', '2024-11-17 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-17 04:58:28', '2025-08-24 04:58:28', 'Myah Batz', '+1-240-568-7113', 'oleta58@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(193, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582866885', NULL, 'Layne Bechtelar PhD', 'meta.wilkinson@example.org', '1-973-875-4492', '590 Doyle Fall Apt. 908\nRippinstad, WY 91314', NULL, NULL, NULL, NULL, '5000000.00', '23314.00', '0.00', NULL, '0.00', '5023314.00', 1, 'refunded', NULL, 1, 'delivered', NULL, NULL, '2024-10-25 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-25 04:58:28', '2025-08-24 04:58:28', 'Ceasar Hahn', '+1-248-803-1605', 'kip.toy@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(194, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582822086', NULL, 'Dr. Lacy Marvin', 'towne.nona@example.org', '+1-708-499-9596', '209 Greenfelder Islands\nPort Andreaneberg, GA 29514', NULL, NULL, NULL, NULL, '34000000.00', '13207.00', '0.00', NULL, '0.00', '34013207.00', 2, 'refunded', NULL, 1, 'delivered', NULL, 'Totam quibusdam dolor accusantium ex quia.', '2024-10-14 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-14 04:58:28', '2025-08-24 04:58:28', 'Prof. Kyle Eichmann DDS', '1-870-982-5427', 'armstrong.ramiro@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(195, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582835887', NULL, 'Bo Runte', 'tracey07@example.org', '(919) 392-0557', '34989 Jewell Ranch Apt. 122\nEast Sigridborough, NV 81053', NULL, NULL, NULL, NULL, '125999998.98', '27876.00', '0.00', NULL, '0.00', '126027874.98', 2, 'refunded', NULL, 2, 'delivered', NULL, NULL, '2025-04-02 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-02 04:58:28', '2025-08-24 04:58:28', 'Lew Hayes Sr.', '1-213-738-2178', 'qgrimes@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(196, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582823488', NULL, 'Charles Nader', 'junior.green@example.com', '414.476.2072', '93221 Hammes Islands Apt. 109\nKeeblerfurt, OH 94551-9079', NULL, NULL, NULL, NULL, '83099999.94', '20738.00', '0.00', NULL, '0.00', '83120737.94', 2, 'pending', NULL, 1, 'delivered', NULL, 'Laborum sapiente asperiores corrupti dolorem incidunt suscipit.', '2025-06-03 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-03 04:58:28', '2025-08-24 04:58:28', 'Lue Becker', '410.400.6705', 'miracle61@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(197, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582822089', NULL, 'Dr. Domenic Koepp', 'betsy29@example.com', '940.489.0889', '232 Murray Common Apt. 838\nLake Dexterborough, IN 46565-4888', NULL, NULL, NULL, NULL, '56399999.99', '18376.00', '0.00', NULL, '0.00', '56418375.99', 2, 'refunded', NULL, 1, 'delivered', NULL, 'Atque est autem illo expedita.', '2025-01-16 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-16 04:58:28', '2025-08-24 04:58:28', 'Prof. Roosevelt Bruen', '+1.947.599.4002', 'kohler.dana@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(198, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582897490', NULL, 'Joe Spencer IV', 'rziemann@example.com', '364.883.3694', '91324 Bednar Roads\nMisaelborough, ND 03073-8335', NULL, NULL, NULL, NULL, '98499997.96', '12382.00', '0.00', NULL, '0.00', '98512379.96', 1, 'refunded', NULL, 1, 'delivered', 'Id inventore cumque consequatur qui natus deleniti rerum.', NULL, '2025-01-13 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-13 04:58:28', '2025-08-24 04:58:28', 'Prof. Broderick Nienow', '+1-757-746-3008', 'eschinner@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(199, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582876391', NULL, 'Mrs. Sandy Kuphal', 'lesch.cortez@example.net', '+1-603-380-4306', '2271 Ullrich Motorway Apt. 879\nNew Christyberg, WA 65953-1527', NULL, NULL, NULL, NULL, '102499999.99', '16747.00', '0.00', NULL, '0.00', '102516746.99', 2, 'refunded', NULL, 1, 'delivered', 'Placeat ut explicabo consequatur sapiente in esse et.', NULL, '2025-05-15 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-15 04:58:28', '2025-08-24 04:58:28', 'Ms. Kaci Adams Sr.', '404.513.6084', 'isipes@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(200, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582890992', NULL, 'Keagan Berge', 'alisa.wintheiser@example.net', '+1.854.374.5778', '7353 Satterfield Plaza Apt. 729\nWest Tayashire, TN 95947', NULL, NULL, NULL, NULL, '48000000.00', '25956.00', '0.00', NULL, '0.00', '48025956.00', 1, 'paid', NULL, 2, 'delivered', NULL, NULL, '2025-07-28 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-28 04:58:28', '2025-08-24 04:58:28', 'Dr. Mayra Harvey', '+12409449696', 'prippin@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(201, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582875493', NULL, 'Eladio Upton', 'bednar.janessa@example.org', '+1-534-779-9766', '22737 Thiel Rest\nSouth Aleenton, NV 91411', NULL, NULL, NULL, NULL, '43499999.98', '21240.00', '0.00', NULL, '0.00', '43521239.98', 2, 'failed', NULL, 1, 'delivered', NULL, NULL, '2024-11-23 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-23 04:58:28', '2025-08-24 04:58:28', 'Della Hodkiewicz', '864.635.5023', 'berniece.olson@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(202, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582812894', NULL, 'Nia Aufderhar', 'matilde73@example.com', '+1.774.389.1713', '3512 Koch Trace\nSouth Heaven, VT 17721-5299', NULL, NULL, NULL, NULL, '5000000.00', '25236.00', '0.00', NULL, '0.00', '5025236.00', 1, 'refunded', NULL, 2, 'delivered', 'Natus est modi atque dolore eligendi.', 'Voluptas nulla perferendis dolor aspernatur similique dolorem.', '2025-08-18 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-18 04:58:28', '2025-08-24 04:58:28', 'Jacklyn Halvorson', '1-614-313-3954', 'dchamplin@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(203, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582824795', NULL, 'Kristina Davis Jr.', 'billy00@example.org', '458-472-6314', '63426 Okuneva Ridge Suite 977\nCruickshankbury, VT 01833', NULL, NULL, NULL, NULL, '28499999.00', '27395.00', '0.00', NULL, '0.00', '28527394.00', 2, 'pending', NULL, 2, 'delivered', 'Ab aliquid et nobis beatae.', NULL, '2025-07-10 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-10 04:58:28', '2025-08-24 04:58:28', 'Terrell Baumbach', '847-414-4190', 'erich02@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(204, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582877496', NULL, 'Lou Hane', 'chanel.wisozk@example.org', '+1 (661) 668-7832', '793 Aida Run\nEvemouth, ME 45271-1928', NULL, NULL, NULL, NULL, '45000000.00', '26942.00', '0.00', NULL, '0.00', '45026942.00', 1, 'failed', NULL, 1, 'delivered', NULL, 'Sit voluptatum cupiditate qui ut deleniti sint.', '2024-11-09 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-09 04:58:28', '2025-08-24 04:58:28', 'Joana Bradtke', '(650) 248-4897', 'dcasper@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(205, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582889797', NULL, 'Dr. Idella McDermott', 'oconner.crystel@example.com', '626.214.6496', '183 O\'Keefe Village\nGerardburgh, UT 25593', NULL, NULL, NULL, NULL, '10000000.00', '25533.00', '0.00', NULL, '0.00', '10025533.00', 2, 'refunded', NULL, 1, 'delivered', 'Aut in porro quo placeat quaerat adipisci.', NULL, '2025-03-25 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-25 04:58:28', '2025-08-24 04:58:28', 'Santiago Hill', '907-415-2678', 'stefan90@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(206, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582867298', NULL, 'Evan Dach', 'hswaniawski@example.com', '+1.973.712.6555', '71143 Gleason Field Apt. 127\nPresleybury, NY 02596-2433', NULL, NULL, NULL, NULL, '37399999.00', '25258.00', '0.00', NULL, '0.00', '37425257.00', 1, 'failed', NULL, 2, 'delivered', NULL, 'Quo dolore totam in soluta.', '2024-10-14 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-14 04:58:28', '2025-08-24 04:58:28', 'Dr. Chet Reynolds', '713.719.3776', 'dhyatt@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(207, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082411582884299', NULL, 'Rosalinda Beer', 'ostreich@example.net', '1-248-866-4320', '892 Elena Corners Apt. 450\nPaigefurt, ND 60585-2228', NULL, NULL, NULL, NULL, '18999999.00', '12791.00', '0.00', NULL, '0.00', '19012790.00', 2, 'failed', NULL, 2, 'delivered', NULL, NULL, '2024-12-30 04:58:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-30 04:58:28', '2025-08-24 04:58:28', 'Barbara Stokes', '310.798.7100', 'ward.emmett@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(208, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241317073000', NULL, 'Ms. Phoebe Wintheiser', 'dkunde@example.com', '701.535.9452', '194 Hodkiewicz Ways\nWest Nia, NM 23697-1516', NULL, NULL, NULL, NULL, '75500000.02', '23393.00', '0.00', NULL, '0.00', '75523393.02', 1, 'paid', NULL, 2, 'delivered', NULL, NULL, '2025-06-03 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-03 06:17:07', '2025-08-24 06:17:07', 'Eve Bauch', '+1 (415) 478-2888', 'braun.damian@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(209, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241317075411', NULL, 'Vern Hagenes', 'milton91@example.com', '+1-463-720-6336', '9292 Haley Manor\nWest Kaceyberg, VA 54824-0753', NULL, NULL, NULL, NULL, '114000000.00', '10953.00', '0.00', NULL, '0.00', '114010953.00', 2, 'refunded', NULL, 2, 'delivered', 'Animi soluta deleniti et autem.', NULL, '2025-04-26 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-26 06:17:07', '2025-08-24 06:17:07', 'Jayme Hammes', '+1.434.417.5407', 'fauer@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(210, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241317078702', NULL, 'Cierra Kris', 'bernhard.arely@example.com', '430.456.1331', '7732 Alexandro Center Apt. 217\nWest Friedrichchester, MO 46506-1127', NULL, NULL, NULL, NULL, '66200000.03', '18372.00', '0.00', NULL, '0.00', '66218372.03', 2, 'paid', NULL, 2, 'delivered', 'Soluta cumque officia libero neque veritatis voluptas.', NULL, '2024-11-16 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-16 06:17:07', '2025-08-24 06:17:07', 'Dr. Brandi Prosacco IV', '(260) 759-5032', 'piper99@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(211, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241317079093', NULL, 'Lee Lesch', 'adams.flavie@example.com', '386-789-6720', '7628 Annette Loop Apt. 065\nEast Deonteside, NH 87187', NULL, NULL, NULL, NULL, '130000000.00', '18616.00', '0.00', NULL, '0.00', '130018616.00', 2, 'pending', NULL, 1, 'delivered', 'Et laboriosam ad ea rerum quibusdam.', NULL, '2024-10-25 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-25 06:17:07', '2025-08-24 06:17:07', 'Brennon Stracke', '(337) 658-3528', 'hessel.enid@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(212, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241317071784', NULL, 'Marcel Barton', 'mlang@example.com', '(712) 983-2649', '635 Rogahn Falls Apt. 842\nWolfland, MD 32480', NULL, NULL, NULL, NULL, '6000000.00', '22620.00', '0.00', NULL, '0.00', '6022620.00', 2, 'paid', NULL, 1, 'delivered', 'Enim aut provident recusandae inventore reiciendis quia explicabo aspernatur.', 'Inventore vel aut ratione tempore id.', '2024-10-22 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-22 06:17:07', '2025-08-24 06:17:07', 'Jada Ferry', '223-524-6412', 'miracle15@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(213, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241317074525', NULL, 'Sierra Collins', 'langworth.lonnie@example.org', '+1 (339) 309-5491', '555 Rice Square\nPort Percival, NC 78146', NULL, NULL, NULL, NULL, '66000000.00', '23386.00', '0.00', NULL, '0.00', '66023386.00', 1, 'paid', NULL, 2, 'delivered', 'Aut eos asperiores optio illo soluta.', NULL, '2024-12-11 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-11 06:17:07', '2025-08-24 06:17:07', 'Bernhard Dickinson', '+1-667-602-0603', 'vance.walsh@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(214, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241317079736', NULL, 'Rachael Doyle', 'addison.lang@example.org', '+1.904.732.0691', '30479 Jackie Shore Suite 654\nEast Albertoborough, AK 00663-7278', NULL, NULL, NULL, NULL, '128000000.00', '20579.00', '0.00', NULL, '0.00', '128020579.00', 2, 'paid', NULL, 1, 'delivered', NULL, 'Totam consequatur non explicabo molestiae esse neque.', '2024-10-19 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-19 06:17:07', '2025-08-24 06:17:07', 'Virginia Wisoky III', '347.822.5392', 'betsy.buckridge@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(215, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241317078677', NULL, 'Augustine Hoeger', 'general.stoltenberg@example.com', '+1.228.227.0874', '2308 Abshire Coves\nFaheyport, MI 74228-5630', NULL, NULL, NULL, NULL, '131500000.03', '23974.00', '0.00', NULL, '0.00', '131523974.03', 2, 'refunded', NULL, 1, 'delivered', NULL, 'Quibusdam aut minus mollitia.', '2025-05-10 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-10 06:17:07', '2025-08-24 06:17:07', 'Tanya Jaskolski', '(574) 471-0924', 'areynolds@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(216, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241317078158', NULL, 'Prof. Monica Williamson', 'maryam.oberbrunner@example.org', '(484) 375-5891', '33761 Barton Summit Suite 573\nWest Josefa, AK 99468-7694', NULL, NULL, NULL, NULL, '87200000.03', '20389.00', '0.00', NULL, '0.00', '87220389.03', 2, 'failed', NULL, 1, 'delivered', NULL, NULL, '2025-02-20 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-02-20 06:17:07', '2025-08-24 06:17:07', 'Ed Torp', '(716) 621-4261', 'celine53@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(217, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241317077749', NULL, 'Naomi Bergstrom', 'shanna70@example.com', '+1-918-427-1095', '789 Bergnaum Field Suite 233\nEast Lyricton, CT 61571-0982', NULL, NULL, NULL, NULL, '138000000.00', '11035.00', '0.00', NULL, '0.00', '138011035.00', 1, 'paid', NULL, 1, 'delivered', NULL, 'Ratione voluptas exercitationem placeat impedit.', '2024-09-04 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-04 06:17:07', '2025-08-24 06:17:07', 'Krystina Kessler', '309.787.9484', 'nathanial.okeefe@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(218, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170726110', NULL, 'Adella VonRueden', 'schuster.carmela@example.net', '+19529870158', '132 Rau Union Suite 556\nNamechester, AR 09306', NULL, NULL, NULL, NULL, '155700000.00', '12418.00', '0.00', NULL, '0.00', '155712418.00', 2, 'refunded', NULL, 2, 'delivered', 'Repellat quaerat rem velit.', NULL, '2024-09-14 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-14 06:17:07', '2025-08-24 06:17:07', 'Claudine Botsford', '+1-319-299-6039', 'hessel.axel@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(219, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170752011', NULL, 'Dr. Chandler Kerluke', 'wisoky.nora@example.com', '(737) 878-4784', '902 Samanta Mill Suite 763\nAnikaburgh, SC 56442', NULL, NULL, NULL, NULL, '8500000.01', '19438.00', '0.00', NULL, '0.00', '8519438.01', 1, 'refunded', NULL, 2, 'delivered', NULL, NULL, '2025-03-06 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-06 06:17:07', '2025-08-24 06:17:07', 'Elmore D\'Amore', '802.794.7154', 'watsica.giuseppe@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(220, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170754712', NULL, 'Camden Brown IV', 'cheyanne12@example.org', '+1-865-758-9683', '9603 Jody Mountains\nSouth Cathrinehaven, OK 78012', NULL, NULL, NULL, NULL, '12000000.00', '28990.00', '0.00', NULL, '0.00', '12028990.00', 2, 'refunded', NULL, 1, 'delivered', 'Enim natus ea magni voluptatibus mollitia adipisci.', 'At ex ipsam non aspernatur modi dignissimos.', '2025-07-29 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-29 06:17:07', '2025-08-24 06:17:07', 'Dr. Julio Goyette', '+1.843.326.9166', 'vluettgen@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(221, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170747513', NULL, 'Prof. Destin Macejkovic III', 'weissnat.rod@example.net', '1-330-512-4798', '4915 Dominic Mountain Suite 289\nWest Theodoraborough, GA 72308', NULL, NULL, NULL, NULL, '133999999.97', '10463.00', '0.00', NULL, '0.00', '134010462.97', 2, 'failed', NULL, 2, 'delivered', NULL, 'Quod dolores maiores rerum et voluptate itaque porro.', '2025-04-02 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-02 06:17:07', '2025-08-24 06:17:07', 'Jettie Fadel', '+1-979-426-3810', 'sauer.cathy@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(222, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170710214', NULL, 'Aileen Osinski', 'huels.hassie@example.com', '(832) 857-8283', '80064 Tyreek Corner Apt. 155\nLake Wilford, VA 56040-4737', NULL, NULL, NULL, NULL, '42000000.00', '25353.00', '0.00', NULL, '0.00', '42025353.00', 1, 'paid', NULL, 1, 'delivered', 'Magni nisi dolore qui voluptatum nobis modi eaque.', NULL, '2025-04-13 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-13 06:17:07', '2025-08-24 06:17:07', 'Mr. Gabriel Turner PhD', '+1 (573) 950-1875', 'morris07@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(223, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170767915', NULL, 'Frederik Deckow', 'parisian.harvey@example.org', '+12524666586', '81916 Monica Hollow Suite 706\nWolfborough, NV 37031-6025', NULL, NULL, NULL, NULL, '53900000.00', '10166.00', '0.00', NULL, '0.00', '53910166.00', 2, 'refunded', NULL, 2, 'delivered', 'Impedit sequi animi sed odio.', NULL, '2024-12-06 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-06 06:17:07', '2025-08-24 06:17:07', 'Prof. Karley Konopelski IV', '+1 (458) 704-6042', 'nolan.nellie@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(224, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170780916', NULL, 'Lia Wyman V', 'keyshawn.bayer@example.net', '1-239-366-3781', '43150 Florine Cove\nAmayaburgh, RI 24361', NULL, NULL, NULL, NULL, '96000000.00', '23150.00', '0.00', NULL, '0.00', '96023150.00', 1, 'pending', NULL, 1, 'delivered', 'Enim hic accusamus cum qui officiis rem.', NULL, '2025-03-24 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-24 06:17:07', '2025-08-24 06:17:07', 'Dr. Solon Lebsack DDS', '364-240-5000', 'cbogan@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(225, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170754917', NULL, 'Cornelius Simonis', 'elfrieda48@example.com', '+1-469-617-7540', '122 Zetta Ports\nJohnpaulburgh, MD 31923', NULL, NULL, NULL, NULL, '111999999.97', '21797.00', '0.00', NULL, '0.00', '112021796.97', 2, 'refunded', NULL, 2, 'delivered', 'Similique earum quo mollitia ad voluptates odio.', NULL, '2024-10-15 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-15 06:17:07', '2025-08-24 06:17:07', 'Camille Flatley', '563-360-0763', 'balistreri.waldo@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(226, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170771418', NULL, 'Sherwood Dibbert', 'celine95@example.org', '+1 (518) 920-5298', '467 Bella Courts\nWest Alan, SC 80512', NULL, NULL, NULL, NULL, '59500000.01', '29871.00', '0.00', NULL, '0.00', '59529871.01', 1, 'refunded', NULL, 1, 'delivered', NULL, 'Saepe qui quia mollitia perferendis.', '2025-04-03 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-03 06:17:07', '2025-08-24 06:17:07', 'Prof. Ernesto Kling', '616-621-0106', 'kacie30@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(227, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170752319', NULL, 'Elsa O\'Kon PhD', 'gbradtke@example.com', '1-520-329-7774', '9572 Margret Loaf\nSouth Dallinburgh, NC 74946', NULL, NULL, NULL, NULL, '59000000.00', '11300.00', '0.00', NULL, '0.00', '59011300.00', 2, 'refunded', NULL, 1, 'delivered', 'Eligendi sit autem voluptatem sed praesentium quia.', NULL, '2024-12-30 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-30 06:17:07', '2025-08-24 06:17:07', 'Savanna Schneider', '207-612-4597', 'tom.medhurst@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(228, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170745820', NULL, 'Mrs. Tyra Kertzmann', 'flatley.leonor@example.org', '1-380-284-9120', '221 Lane Throughway Apt. 301\nNew Lisa, ME 31945', NULL, NULL, NULL, NULL, '66000000.00', '13221.00', '0.00', NULL, '0.00', '66013221.00', 1, 'pending', NULL, 1, 'delivered', 'Voluptatem dolores est cum optio beatae.', 'Qui ducimus ipsa dolores nesciunt suscipit.', '2025-06-19 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-19 06:17:07', '2025-08-24 06:17:07', 'Prof. Jessica Carroll', '+1-417-923-2091', 'ashly.littel@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(229, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170718221', NULL, 'Reinhold Crona', 'erowe@example.com', '541.404.7162', '15367 Jenkins Centers Apt. 613\nSouth Loraineside, MS 72699', NULL, NULL, NULL, NULL, '89700000.00', '29062.00', '0.00', NULL, '0.00', '89729062.00', 1, 'refunded', NULL, 1, 'delivered', 'Et officiis ea vitae at quod aut.', 'Ex sed ut aspernatur quia dolores repellendus.', '2024-10-04 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-04 06:17:07', '2025-08-24 06:17:07', 'Johan Schoen PhD', '+1 (417) 598-2221', 'eichmann.charles@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(230, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170755722', NULL, 'Ella Eichmann III', 'qcorkery@example.org', '+1-276-889-5099', '7478 Alysha Gateway Suite 434\nJerodborough, NY 68206', NULL, NULL, NULL, NULL, '101000000.02', '23228.00', '0.00', NULL, '0.00', '101023228.02', 1, 'refunded', NULL, 1, 'delivered', 'Laudantium officia qui quia rem vel alias.', 'Delectus a exercitationem nisi.', '2025-03-23 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-23 06:17:07', '2025-08-24 06:17:07', 'Irwin Schmitt', '1-901-228-9797', 'weimann.idell@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(231, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170783223', NULL, 'Prof. Damon D\'Amore', 'fadel.wilma@example.org', '+1-469-272-4874', '2834 Elliott Trafficway\nNorth Yvette, CO 10241-9451', NULL, NULL, NULL, NULL, '64000000.00', '17156.00', '0.00', NULL, '0.00', '64017156.00', 1, 'pending', NULL, 1, 'delivered', 'Officiis sint ducimus consequatur blanditiis ut qui est qui.', NULL, '2025-04-04 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-04 06:17:07', '2025-08-24 06:17:07', 'Olin Lueilwitz I', '+1-330-831-2551', 'ihuels@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(232, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170713024', NULL, 'Mr. Osvaldo Effertz MD', 'abe.schulist@example.net', '+1-817-822-1100', '8273 Goodwin Spurs\nEast Jordonshire, RI 08945-4629', NULL, NULL, NULL, NULL, '81999999.97', '19218.00', '0.00', NULL, '0.00', '82019217.97', 2, 'failed', NULL, 1, 'delivered', NULL, 'At vero fugit cum quia eos eos iusto.', '2025-03-25 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-25 06:17:07', '2025-08-24 06:17:07', 'Mrs. Destinee Dickens I', '+1.661.865.9575', 'ydaugherty@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(233, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170762725', NULL, 'Mr. Collin Miller PhD', 'murazik.jalyn@example.net', '+1 (470) 953-7493', '29979 Krajcik Village\nMyrtleburgh, TX 72187', NULL, NULL, NULL, NULL, '171000000.00', '23243.00', '0.00', NULL, '0.00', '171023243.00', 2, 'pending', NULL, 2, 'delivered', 'Voluptatem nemo in porro dolores.', NULL, '2025-04-18 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-18 06:17:07', '2025-08-24 06:17:07', 'Anjali Hessel', '+14198260675', 'casper.gibson@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(234, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170732626', NULL, 'Efrain Runolfsson', 'schneider.dulce@example.net', '1-330-630-0049', '880 Emilie Locks\nSouth Lucieside, SD 65556', NULL, NULL, NULL, NULL, '101000000.00', '15875.00', '0.00', NULL, '0.00', '101015875.00', 1, 'failed', NULL, 2, 'delivered', NULL, 'Commodi maxime accusantium incidunt quos magnam fugiat.', '2025-06-15 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-15 06:17:07', '2025-08-24 06:17:07', 'Jewel Murphy', '1-708-843-8306', 'nitzsche.helga@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(235, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170754227', NULL, 'Jonatan Kohler', 'sabina.blick@example.org', '623.828.9234', '72945 Jamison Motorway\nFayfort, MI 95118-4530', NULL, NULL, NULL, NULL, '30000000.00', '18784.00', '0.00', NULL, '0.00', '30018784.00', 1, 'refunded', NULL, 2, 'delivered', NULL, NULL, '2024-10-21 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-21 06:17:07', '2025-08-24 06:17:07', 'Mack Senger V', '(540) 488-4484', 'lola68@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(236, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170747428', NULL, 'Mrs. Cleta Sipes IV', 'tre.jerde@example.org', '+16819287919', '6566 Letha Lane Apt. 627\nPort Korbin, MD 46108-8949', NULL, NULL, NULL, NULL, '28000000.00', '27861.00', '0.00', NULL, '0.00', '28027861.00', 2, 'refunded', NULL, 1, 'delivered', 'Nisi sed beatae repellendus nesciunt rem.', NULL, '2025-05-17 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-17 06:17:07', '2025-08-24 06:17:07', 'Ms. Sierra Emard DDS', '1-757-382-9216', 'cluettgen@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(237, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170789629', NULL, 'Price Lynch', 'casper.gladyce@example.org', '432-619-6626', '54624 Runolfsson Cliff\nPort Maddisonmouth, CT 61460', NULL, NULL, NULL, NULL, '16000000.00', '15739.00', '0.00', NULL, '0.00', '16015739.00', 1, 'pending', NULL, 1, 'delivered', 'Doloremque rerum ex quibusdam est.', 'Repudiandae praesentium fuga nemo iure nulla rem rem.', '2024-12-10 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-10 06:17:07', '2025-08-24 06:17:07', 'Zechariah Jones', '425-801-0504', 'alexis44@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(238, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170754930', NULL, 'Providenci Fahey', 'wokuneva@example.net', '+1.415.647.3538', '578 Wiegand Tunnel\nNew Brenda, PA 98442', NULL, NULL, NULL, NULL, '64000000.00', '22659.00', '0.00', NULL, '0.00', '64022659.00', 2, 'failed', NULL, 2, 'delivered', 'Ex sit magnam minima officiis id nisi qui.', NULL, '2025-06-29 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-29 06:17:07', '2025-08-24 06:17:07', 'Olen Sporer', '+18102146489', 'purdy.alta@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(239, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170748631', NULL, 'Natalia Towne', 'jo44@example.net', '+1 (831) 582-7535', '482 Hansen Walk Suite 853\nLake Lillianaville, SC 86453', NULL, NULL, NULL, NULL, '100000000.00', '22135.00', '0.00', NULL, '0.00', '100022135.00', 2, 'failed', NULL, 1, 'delivered', NULL, NULL, '2025-01-01 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-01 06:17:07', '2025-08-24 06:17:07', 'Miss Kattie Wolff DVM', '+1 (619) 250-7458', 'vicente64@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(240, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170723032', NULL, 'Bernard Carter', 'edd37@example.com', '+19034307794', '25210 Destiny Villages Apt. 341\nWest Alexzander, OR 78227-2938', NULL, NULL, NULL, NULL, '227800000.00', '28939.00', '0.00', NULL, '0.00', '227828939.00', 1, 'failed', NULL, 1, 'delivered', NULL, 'Aut qui eos tempore quis error a omnis.', '2025-03-13 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-13 06:17:07', '2025-08-24 06:17:07', 'Prof. Gianni Larkin', '+1-928-506-8681', 'hhaag@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(241, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170710133', NULL, 'Aniyah Hills', 'ebert.nathanial@example.net', '(650) 513-4368', '5263 Gladyce Extensions Apt. 815\nWildermanchester, WI 55248', NULL, NULL, NULL, NULL, '96000000.00', '15393.00', '0.00', NULL, '0.00', '96015393.00', 1, 'pending', NULL, 1, 'delivered', 'Omnis ex ea sed.', NULL, '2024-12-19 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-19 06:17:07', '2025-08-24 06:17:07', 'Cornelius Lakin', '805.990.7768', 'demetris.howell@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(242, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170744834', NULL, 'Modesta Torp IV', 'kassandra54@example.com', '618-669-0068', '148 Sibyl Lights\nHilariochester, NH 59930', NULL, NULL, NULL, NULL, '48800000.00', '15626.00', '0.00', NULL, '0.00', '48815626.00', 2, 'refunded', NULL, 2, 'delivered', 'Ut ut et at soluta esse aut quisquam.', 'Tempore ut aliquam recusandae qui facere.', '2025-03-16 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-16 06:17:07', '2025-08-24 06:17:07', 'Greta Wisoky', '+1.662.593.4579', 'heathcote.darryl@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(243, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170780135', NULL, 'Prof. Travis Halvorson', 'toy.dudley@example.org', '1-708-757-0031', '60204 Cruickshank Squares\nSouth Bertram, AZ 95917', NULL, NULL, NULL, NULL, '203500000.03', '14059.00', '0.00', NULL, '0.00', '203514059.03', 2, 'refunded', NULL, 1, 'delivered', 'Quod voluptatem qui repudiandae ab.', NULL, '2024-12-25 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-25 06:17:07', '2025-08-24 06:17:07', 'Margot Quigley Jr.', '+1.862.386.1962', 'reuben.hyatt@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(244, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170791136', NULL, 'Leonel Hagenes', 'ldibbert@example.com', '1-956-569-7434', '2285 Jasmin Mount Apt. 504\nRyanfort, NY 59442', NULL, NULL, NULL, NULL, '121199999.99', '29091.00', '0.00', NULL, '0.00', '121229090.99', 2, 'failed', NULL, 2, 'delivered', 'Ratione rerum eaque cum amet quia est porro.', NULL, '2025-01-20 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-20 06:17:07', '2025-08-24 06:17:07', 'Suzanne Kunde DVM', '(606) 771-4681', 'xstanton@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(245, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170790637', NULL, 'Renee O\'Conner', 'retha46@example.org', '814-847-0493', '832 Jones Parkways\nWuckertshire, MT 53166', NULL, NULL, NULL, NULL, '63500000.03', '29706.00', '0.00', NULL, '0.00', '63529706.03', 1, 'paid', NULL, 1, 'delivered', 'Adipisci sapiente qui autem adipisci animi incidunt.', 'Sed ut et est repellendus eveniet nihil odio.', '2024-11-14 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-14 06:17:07', '2025-08-24 06:17:07', 'Prof. Nora Fisher Sr.', '(612) 209-3221', 'tracey.parker@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `orders` (`id`, `user_id`, `shipper_id`, `received_at`, `in_delivery_at`, `failed_at`, `delivery_notes`, `failure_reason`, `delivery_images`, `order_code`, `transaction_id`, `customer_name`, `customer_email`, `customer_phone`, `shipping_address`, `buyer_name`, `buyer_email`, `buyer_phone`, `buyer_address`, `subtotal_amount`, `shipping_fee`, `discount_amount`, `discount_code`, `tax_amount`, `total_amount`, `payment_method_id`, `payment_status`, `payment_details`, `shipping_method_id`, `order_status`, `customer_note`, `admin_note`, `ordered_at`, `processing_at`, `shipped_at`, `delivered_at`, `cancelled_at`, `returned_at`, `cancellation_reason`, `pending_refund`, `previous_status`, `created_at`, `updated_at`, `shipping_name`, `shipping_phone`, `shipping_email`, `shipping_lat`, `shipping_lng`, `delivery_lat`, `delivery_lng`, `delivery_started_at`, `delivery_completed_at`, `delivery_address`, `vnp_transaction_no`, `vnp_transaction_date`) VALUES
(246, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170789838', NULL, 'Kelton Gerhold', 'welch.favian@example.com', '(617) 344-8929', '754 Weber Summit\nNew Willis, NE 81657-7293', NULL, NULL, NULL, NULL, '78800000.00', '22439.00', '0.00', NULL, '0.00', '78822439.00', 2, 'paid', NULL, 2, 'delivered', NULL, 'Incidunt fuga expedita aut asperiores ex voluptas.', '2025-07-31 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-31 06:17:07', '2025-08-24 06:17:07', 'Dr. Derrick Daniel II', '(320) 708-2486', 'teresa89@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(247, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170763639', NULL, 'Alex O\'Conner', 'esmeralda.harvey@example.com', '351-943-1282', '52947 Reinger Via Apt. 583\nBahringermouth, NE 87585-7797', NULL, NULL, NULL, NULL, '97200000.01', '28630.00', '0.00', NULL, '0.00', '97228630.01', 1, 'pending', NULL, 1, 'delivered', 'Inventore optio quam maiores saepe.', NULL, '2024-11-23 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-23 06:17:07', '2025-08-24 06:17:07', 'Maritza Hoeger', '913-578-5980', 'ziemann.trenton@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(248, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170736140', NULL, 'Hermann Lind Jr.', 'haley.abraham@example.org', '1-272-417-5785', '526 Jerome Mountain\nSpinkastad, FL 97766-9931', NULL, NULL, NULL, NULL, '47999999.97', '28791.00', '0.00', NULL, '0.00', '48028790.97', 2, 'pending', NULL, 1, 'delivered', 'Ipsa ut ut necessitatibus debitis laboriosam.', NULL, '2025-05-29 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-29 06:17:07', '2025-08-24 06:17:07', 'Drake Koch', '+1 (763) 695-7350', 'dwolf@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(249, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170731041', NULL, 'Annalise Schuppe', 'heathcote.guiseppe@example.org', '234.858.6854', '30301 Cummings Trail\nKeelingmouth, MT 12487', NULL, NULL, NULL, NULL, '54000000.00', '18938.00', '0.00', NULL, '0.00', '54018938.00', 2, 'failed', NULL, 2, 'delivered', NULL, 'Laudantium temporibus delectus ut blanditiis sit nihil.', '2025-04-11 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-11 06:17:07', '2025-08-24 06:17:07', 'Dr. Itzel Friesen DVM', '614-741-4049', 'gbarrows@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(250, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170736042', NULL, 'Barrett Runolfsson', 'omarks@example.com', '281.657.1800', '4543 Rowe Valley Suite 641\nGleichnerland, SC 28515', NULL, NULL, NULL, NULL, '62700000.00', '24157.00', '0.00', NULL, '0.00', '62724157.00', 1, 'failed', NULL, 2, 'delivered', NULL, NULL, '2024-11-01 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-01 06:17:07', '2025-08-24 06:17:07', 'Hattie Huels I', '442.354.3490', 'mohr.lamont@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(251, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170739243', NULL, 'Flavie Considine', 'coty37@example.com', '408.241.2322', '5083 Jorge Brook Apt. 679\nNikolausview, HI 54568-3865', NULL, NULL, NULL, NULL, '196000000.00', '11384.00', '0.00', NULL, '0.00', '196011384.00', 1, 'failed', NULL, 2, 'delivered', NULL, NULL, '2024-08-28 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-08-28 06:17:07', '2025-08-24 06:17:07', 'Dr. Garland Wunsch', '510-308-0774', 'princess87@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(252, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170720044', NULL, 'Colin Haag', 'schimmel.bud@example.org', '+1-615-949-4224', '300 Jordyn Ranch\nPort Roel, MD 18601', NULL, NULL, NULL, NULL, '138500000.03', '29161.00', '0.00', NULL, '0.00', '138529161.03', 2, 'failed', NULL, 1, 'delivered', NULL, NULL, '2024-08-25 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-08-25 06:17:07', '2025-08-24 06:17:07', 'Dr. Taylor Simonis', '+1-205-259-9511', 'wruecker@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(253, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170748145', NULL, 'Tara Gulgowski', 'verla.beer@example.net', '+19063685769', '76739 Evangeline Union\nLake Helmer, OR 57312', NULL, NULL, NULL, NULL, '130000000.00', '14383.00', '0.00', NULL, '0.00', '130014383.00', 2, 'pending', NULL, 2, 'delivered', 'Aut aut est sed inventore et.', 'Et est optio magnam inventore qui.', '2025-01-15 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-15 06:17:07', '2025-08-24 06:17:07', 'Dr. Orval Rodriguez III', '475-386-8761', 'umurazik@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(254, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170735446', NULL, 'Oceane Hessel', 'oohara@example.org', '1-417-697-4693', '3257 Lakin Corner\nSchulistview, LA 00416', NULL, NULL, NULL, NULL, '60000000.00', '12656.00', '0.00', NULL, '0.00', '60012656.00', 2, 'paid', NULL, 1, 'delivered', NULL, 'Omnis voluptatibus molestiae quaerat dignissimos.', '2025-01-28 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-28 06:17:07', '2025-08-24 06:17:07', 'Prof. Austyn Denesik V', '276.799.9561', 'tianna42@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(255, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170727347', NULL, 'Vada Grady', 'bernier.zoe@example.com', '(214) 215-2529', '12180 Sophia Pass\nEast Joanaborough, KS 87135-9432', NULL, NULL, NULL, NULL, '54000000.00', '22106.00', '0.00', NULL, '0.00', '54022106.00', 2, 'refunded', NULL, 2, 'delivered', NULL, NULL, '2025-02-23 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-02-23 06:17:07', '2025-08-24 06:17:07', 'Gideon Hessel', '(413) 651-7421', 'elliott.king@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(256, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170766348', NULL, 'Hillary Bode', 'wilkinson.cielo@example.org', '985.352.4156', '42613 Wuckert Fall\nWest Lilyport, KS 79962-8226', NULL, NULL, NULL, NULL, '87700000.00', '22667.00', '0.00', NULL, '0.00', '87722667.00', 2, 'paid', NULL, 1, 'delivered', NULL, NULL, '2025-08-19 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-19 06:17:07', '2025-08-24 06:17:07', 'Mr. Sonny Douglas', '1-551-301-0141', 'tyra.hills@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(257, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170799849', NULL, 'Prof. Stanton McCullough', 'ramon31@example.net', '(458) 788-7435', '5492 Labadie Drive\nNorth Garland, SC 43033-0810', NULL, NULL, NULL, NULL, '40500000.01', '11780.00', '0.00', NULL, '0.00', '40511780.01', 1, 'paid', NULL, 2, 'delivered', 'Consequatur et magnam adipisci veritatis.', NULL, '2025-03-15 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-15 06:17:07', '2025-08-24 06:17:07', 'Nya Schulist', '+1 (323) 321-8042', 'harris.louisa@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(258, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170765750', NULL, 'Dr. Chris Wilkinson I', 'renner.gilberto@example.org', '+1 (616) 871-7171', '6015 Hansen Rue Suite 761\nFosterside, HI 57795-8455', NULL, NULL, NULL, NULL, '92000000.00', '13298.00', '0.00', NULL, '0.00', '92013298.00', 2, 'failed', NULL, 1, 'delivered', NULL, 'Expedita et natus voluptates voluptatem veritatis harum dolorem est.', '2025-02-25 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-02-25 06:17:07', '2025-08-24 06:17:07', 'Dr. Ashtyn Feest DVM', '1-814-376-3156', 'isaac.turner@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(259, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170770351', NULL, 'Waldo Wintheiser', 'jaylin41@example.com', '+1.331.481.1797', '785 Hayes Canyon Apt. 052\nPort Alden, CA 01192-5462', NULL, NULL, NULL, NULL, '89999999.97', '14477.00', '0.00', NULL, '0.00', '90014476.97', 1, 'pending', NULL, 1, 'delivered', 'Eveniet voluptatem maiores voluptate placeat voluptatem natus.', NULL, '2025-06-28 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-28 06:17:07', '2025-08-24 06:17:07', 'Susan Kulas', '+1 (484) 628-9355', 'dubuque.marina@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(260, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170712452', NULL, 'Keith Krajcik', 'dfeeney@example.org', '385.750.4363', '64717 Berniece Key Apt. 264\nLarkinside, RI 60260', NULL, NULL, NULL, NULL, '122900000.00', '29327.00', '0.00', NULL, '0.00', '122929327.00', 2, 'pending', NULL, 2, 'delivered', NULL, NULL, '2024-10-08 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-08 06:17:07', '2025-08-24 06:17:07', 'Krystina Dicki', '224.285.0784', 'aliya30@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(261, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170711553', NULL, 'Prof. Giuseppe Beier', 'cathrine.hauck@example.org', '1-657-824-2543', '494 Kertzmann Ports Apt. 712\nNew Rhettside, FL 38082-2331', NULL, NULL, NULL, NULL, '32000000.00', '17847.00', '0.00', NULL, '0.00', '32017847.00', 1, 'paid', NULL, 2, 'delivered', 'Voluptates culpa aspernatur id ab.', NULL, '2025-07-04 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-04 06:17:07', '2025-08-24 06:17:07', 'Hoyt Hilpert', '+1 (810) 742-2549', 'gsteuber@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(262, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170768154', NULL, 'Kennith Bergstrom', 'alexie.russel@example.org', '1-530-752-2050', '67835 Hiram Locks\nNorth Magnoliaberg, PA 06864', NULL, NULL, NULL, NULL, '159000000.02', '12978.00', '0.00', NULL, '0.00', '159012978.02', 2, 'failed', NULL, 2, 'delivered', 'Ipsa mollitia voluptatum officiis libero.', NULL, '2025-08-24 06:17:07', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-24 06:17:07', '2025-08-24 06:17:08', 'Edward Crist', '+1 (475) 300-8314', 'qemard@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(263, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170814055', NULL, 'Dr. Jayson Kihn', 'lauren.reynolds@example.org', '+1-520-558-7433', '7767 Douglas Roads Apt. 246\nEast Kailee, GA 66503-9125', NULL, NULL, NULL, NULL, '93000000.00', '23419.00', '0.00', NULL, '0.00', '93023419.00', 2, 'pending', NULL, 2, 'delivered', 'Praesentium ducimus et inventore repellendus.', NULL, '2024-08-29 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-08-29 06:17:08', '2025-08-24 06:17:08', 'Hollie O\'Keefe', '(678) 524-6473', 'bill.jenkins@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(264, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170817256', NULL, 'Mr. Jarrod Glover', 'ortiz.trey@example.com', '+19133442693', '6871 Kohler Turnpike Apt. 370\nLake Preciousside, TN 58736-5183', NULL, NULL, NULL, NULL, '130999999.97', '24716.00', '0.00', NULL, '0.00', '131024715.97', 1, 'pending', NULL, 1, 'delivered', 'Possimus beatae esse quia aut.', 'Laborum est natus et placeat qui velit.', '2024-12-29 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-29 06:17:08', '2025-08-24 06:17:08', 'Mr. Waino Ortiz', '(435) 478-0319', 'xwyman@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(265, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170817657', NULL, 'Mr. Colin Oberbrunner', 'klocko.lucius@example.org', '1-501-741-1871', '849 Brakus Forest\nNew Hanna, MI 36885', NULL, NULL, NULL, NULL, '59000000.00', '12596.00', '0.00', NULL, '0.00', '59012596.00', 1, 'failed', NULL, 1, 'delivered', 'Esse veritatis sapiente unde unde.', 'Atque vitae in vel voluptatum numquam.', '2025-05-05 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-05 06:17:08', '2025-08-24 06:17:08', 'Angelica Corwin', '952-822-5119', 'alex.abshire@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(266, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170826858', NULL, 'Colton Hackett', 'hermiston.pierre@example.org', '+1-541-795-4948', '20458 Layla Meadow Apt. 420\nLake Anaisfort, TN 63146-8434', NULL, NULL, NULL, NULL, '105000000.00', '26656.00', '0.00', NULL, '0.00', '105026656.00', 2, 'pending', NULL, 2, 'delivered', NULL, 'Dolorem et ex rem veritatis.', '2025-05-20 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-20 06:17:08', '2025-08-24 06:17:08', 'Elenor Cummerata', '1-731-232-4014', 'bsipes@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(267, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170857859', NULL, 'Casimer Bednar', 'jennings.dicki@example.net', '(351) 348-2803', '43127 Heber Viaduct\nLake Rosie, KS 05824', NULL, NULL, NULL, NULL, '90500000.01', '19028.00', '0.00', NULL, '0.00', '90519028.01', 2, 'refunded', NULL, 2, 'delivered', 'Sapiente quibusdam autem impedit non.', 'Dicta eos quisquam itaque et.', '2025-07-16 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-16 06:17:08', '2025-08-24 06:17:08', 'Lexi Ferry', '(803) 775-9422', 'lorine27@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(268, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170840860', NULL, 'Prof. Tyrell Stoltenberg', 'mertie.champlin@example.org', '208-333-4433', '98419 Gilda Manor Apt. 659\nLake Cassandre, MS 78807-7428', NULL, NULL, NULL, NULL, '160500000.03', '16358.00', '0.00', NULL, '0.00', '160516358.03', 2, 'failed', NULL, 1, 'delivered', 'Qui enim nihil eum rerum quia est.', NULL, '2025-08-04 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-04 06:17:08', '2025-08-24 06:17:08', 'Flossie Hill', '1-216-875-1572', 'alberto.crooks@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(269, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170814361', NULL, 'Breanne Tillman', 'irenner@example.net', '(831) 867-3110', '4438 Glover Plaza\nJoannemouth, OK 18182-5957', NULL, NULL, NULL, NULL, '33000000.00', '27240.00', '0.00', NULL, '0.00', '33027240.00', 1, 'failed', NULL, 2, 'delivered', NULL, NULL, '2024-11-08 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-08 06:17:08', '2025-08-24 06:17:08', 'Daniella Fisher PhD', '413-272-5647', 'bmaggio@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(270, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170830162', NULL, 'Alexa Douglas', 'eraynor@example.com', '(818) 441-1535', '858 Paige Road\nBenniemouth, VA 41116', NULL, NULL, NULL, NULL, '53999999.99', '27260.00', '0.00', NULL, '0.00', '54027259.99', 2, 'pending', NULL, 2, 'delivered', 'Quas nostrum ad ratione ex eveniet iure commodi.', 'Quia deleniti dolores consectetur quia voluptatem cupiditate sint.', '2025-06-09 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-09 06:17:08', '2025-08-24 06:17:08', 'Royal Kessler V', '+17189506761', 'qupton@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(271, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170827463', NULL, 'Prof. Emmet Hirthe', 'cole08@example.com', '380.756.7222', '66030 Hintz Path\nGarretstad, ME 94879', NULL, NULL, NULL, NULL, '50000000.00', '29874.00', '0.00', NULL, '0.00', '50029874.00', 2, 'paid', NULL, 2, 'delivered', NULL, 'Repudiandae eum rem aut.', '2025-07-05 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-05 06:17:08', '2025-08-24 06:17:08', 'Belle Koepp', '940-830-2655', 'rupert.hamill@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(272, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170821664', NULL, 'Adelbert Nienow', 'sim11@example.com', '1-469-939-5162', '36186 Candido Circles Suite 069\nWest Easterberg, SC 55423-7090', NULL, NULL, NULL, NULL, '80000000.00', '24760.00', '0.00', NULL, '0.00', '80024760.00', 1, 'pending', NULL, 2, 'delivered', NULL, NULL, '2025-01-03 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-03 06:17:08', '2025-08-24 06:17:08', 'Annalise Prosacco PhD', '(661) 942-8745', 'arlo54@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(273, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170896865', NULL, 'Dr. Lamar Brown', 'winnifred.haley@example.org', '520.279.6579', '78479 Lang Mall Apt. 294\nRodgershire, KY 24927', NULL, NULL, NULL, NULL, '14000000.00', '28035.00', '0.00', NULL, '0.00', '14028035.00', 1, 'pending', NULL, 2, 'delivered', NULL, NULL, '2024-10-23 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-23 06:17:08', '2025-08-24 06:17:08', 'Mr. Terrance Hane', '1-628-944-9961', 'daisy75@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(274, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170872466', NULL, 'Ignacio Morar DDS', 'rlittle@example.net', '1-859-829-1575', '5543 Sporer Mill Apt. 418\nDeckowmouth, IN 67615', NULL, NULL, NULL, NULL, '157699999.98', '29380.00', '0.00', NULL, '0.00', '157729379.98', 1, 'pending', NULL, 1, 'delivered', 'Non eum commodi asperiores rem autem.', NULL, '2024-11-25 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-25 06:17:08', '2025-08-24 06:17:08', 'Hazle Friesen', '+1 (475) 244-3085', 'kirsten89@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(275, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170869767', NULL, 'Sarai Kreiger', 'lowe.jovanny@example.net', '678-587-1132', '748 Wendell Curve Apt. 399\nParisianborough, NJ 20328', NULL, NULL, NULL, NULL, '22000000.00', '19963.00', '0.00', NULL, '0.00', '22019963.00', 2, 'refunded', NULL, 1, 'delivered', NULL, NULL, '2025-05-08 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-08 06:17:08', '2025-08-24 06:17:08', 'Prof. River Emard', '+19133866473', 'sfeeney@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(276, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170852068', NULL, 'Prof. Joshua Turner', 'citlalli.lakin@example.com', '351.554.7511', '71596 Zemlak Forest Suite 263\nSawaynport, DE 71316-9570', NULL, NULL, NULL, NULL, '93799999.98', '13981.00', '0.00', NULL, '0.00', '93813980.98', 2, 'failed', NULL, 2, 'delivered', 'Aliquid aliquid ut dolorem excepturi est consequuntur odio voluptate.', 'Iusto enim nesciunt asperiores autem reiciendis necessitatibus et.', '2025-02-06 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-02-06 06:17:08', '2025-08-24 06:17:08', 'Herman Dicki', '1-928-576-6400', 'estella62@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(277, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170877169', NULL, 'Hailey Williamson', 'keebler.hallie@example.org', '(386) 540-1682', '13678 Cody Spurs\nSouth Amayamouth, IL 28415', NULL, NULL, NULL, NULL, '61999999.99', '21399.00', '0.00', NULL, '0.00', '62021398.99', 2, 'failed', NULL, 1, 'delivered', 'Aliquid ea et cumque officia.', NULL, '2024-10-20 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-20 06:17:08', '2025-08-24 06:17:08', 'Felicia Herzog', '+1 (272) 325-0447', 'anderson.einar@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(278, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170849370', NULL, 'Baron Koch DDS', 'stamm.kiel@example.net', '1-423-663-1087', '57040 Alexandria Freeway Suite 364\nNorth Judge, ME 46860-1105', NULL, NULL, NULL, NULL, '114000000.00', '25740.00', '0.00', NULL, '0.00', '114025740.00', 2, 'refunded', NULL, 2, 'delivered', NULL, 'Nihil quod voluptate eos qui suscipit.', '2024-10-02 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-02 06:17:08', '2025-08-24 06:17:08', 'Carley Casper', '334.622.6845', 'hackett.velva@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(279, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170897571', NULL, 'Don Bogan', 'dbraun@example.org', '+1-680-821-2697', '4484 Olin Fort Suite 717\nImafurt, NJ 83196-3544', NULL, NULL, NULL, NULL, '18000000.00', '19941.00', '0.00', NULL, '0.00', '18019941.00', 1, 'paid', NULL, 1, 'delivered', NULL, 'Explicabo delectus praesentium reiciendis esse qui in.', '2024-11-07 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-07 06:17:08', '2025-08-24 06:17:08', 'Ryleigh Yundt', '(843) 258-7370', 'gino10@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(280, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170846972', NULL, 'Hailie Von', 'valentin.kris@example.com', '(260) 204-5267', '41501 Judah Mount Apt. 741\nPort Walter, WV 59686', NULL, NULL, NULL, NULL, '48000000.00', '17996.00', '0.00', NULL, '0.00', '48017996.00', 2, 'pending', NULL, 2, 'delivered', NULL, NULL, '2024-10-11 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-11 06:17:08', '2025-08-24 06:17:08', 'Dr. Dereck Kuhic', '+16576875822', 'hcremin@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(281, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170899873', NULL, 'Robb Bruen III', 'ceffertz@example.com', '(405) 873-9220', '809 Crona Forge\nSouth Katrine, UT 25646-2419', NULL, NULL, NULL, NULL, '147000000.00', '10952.00', '0.00', NULL, '0.00', '147010952.00', 1, 'failed', NULL, 1, 'delivered', NULL, NULL, '2025-03-03 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-03 06:17:08', '2025-08-24 06:17:08', 'Amie Bartoletti', '+15518587650', 'kpouros@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(282, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170816374', NULL, 'Marques Fritsch', 'maybell68@example.com', '+1-534-593-5215', '45465 Lulu Pike\nBatzchester, NY 30291-2897', NULL, NULL, NULL, NULL, '263700000.00', '27209.00', '0.00', NULL, '0.00', '263727209.00', 2, 'failed', NULL, 1, 'delivered', NULL, 'Est aliquam esse nisi sit.', '2024-10-28 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-28 06:17:08', '2025-08-24 06:17:08', 'Omer Tromp', '+1-267-952-6880', 'ikihn@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(283, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170859075', NULL, 'Prof. Aaliyah Schumm Jr.', 'verdie.trantow@example.com', '640-571-2107', '900 Alvera Walks\nNew Kyra, UT 19334-0544', NULL, NULL, NULL, NULL, '114000000.00', '17972.00', '0.00', NULL, '0.00', '114017972.00', 1, 'pending', NULL, 1, 'delivered', NULL, NULL, '2025-02-12 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-02-12 06:17:08', '2025-08-24 06:17:08', 'Morris Jast', '+1.678.901.8124', 'breitenberg.spencer@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(284, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170826876', NULL, 'John Kovacek', 'beryl.beer@example.org', '240-585-2420', '3642 Sydnee Ways Suite 505\nCraigchester, UT 71462-3560', NULL, NULL, NULL, NULL, '71000000.00', '15970.00', '0.00', NULL, '0.00', '71015970.00', 2, 'refunded', NULL, 2, 'delivered', NULL, 'Quia rerum repellat nostrum quibusdam porro architecto dicta.', '2024-09-12 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-12 06:17:08', '2025-08-24 06:17:08', 'Deion Schoen', '1-223-842-3653', 'frami.estrella@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(285, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170886377', NULL, 'Lilyan Cummerata', 'flavie48@example.com', '412.881.3620', '81130 Zella Isle Apt. 216\nWatersfurt, NY 60827-0517', NULL, NULL, NULL, NULL, '125700000.00', '25708.00', '0.00', NULL, '0.00', '125725708.00', 1, 'pending', NULL, 1, 'delivered', NULL, 'Ipsa ut suscipit voluptatem et et architecto asperiores.', '2025-05-06 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-06 06:17:08', '2025-08-24 06:17:08', 'Dr. Claire Walsh', '708-617-1604', 'considine.emmitt@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(286, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170823778', NULL, 'Dr. Werner Kertzmann', 'krystel56@example.net', '+1.757.504.5929', '62862 Destinee Grove Suite 625\nEmmieland, CA 94876', NULL, NULL, NULL, NULL, '56000000.00', '21958.00', '0.00', NULL, '0.00', '56021958.00', 2, 'pending', NULL, 2, 'delivered', 'Dolorem qui non ducimus officiis consequatur et sint.', NULL, '2024-09-26 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-26 06:17:08', '2025-08-24 06:17:08', 'Dr. Caden Blick IV', '+1.980.442.0082', 'mnader@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(287, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170860179', NULL, 'Ms. Romaine Botsford Sr.', 'lakin.karianne@example.net', '229-828-9836', '4065 Bartoletti Shoals Suite 944\nYostfort, TX 64143', NULL, NULL, NULL, NULL, '69500000.03', '23180.00', '0.00', NULL, '0.00', '69523180.03', 1, 'failed', NULL, 1, 'delivered', 'Libero consequatur quis tempora magni expedita.', NULL, '2025-05-31 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-31 06:17:08', '2025-08-24 06:17:08', 'Dejuan Schaefer', '(332) 355-9689', 'rachael49@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(288, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170879080', NULL, 'Oma Harvey', 'keebler.mckenna@example.org', '1-269-958-0271', '44730 Claudie Stravenue\nLake Reggie, TN 39403-1623', NULL, NULL, NULL, NULL, '71900000.00', '29953.00', '0.00', NULL, '0.00', '71929953.00', 1, 'paid', NULL, 2, 'delivered', 'Et quia ut doloribus fuga sint autem voluptas.', NULL, '2025-08-19 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-19 06:17:08', '2025-08-24 06:17:08', 'Mrs. Shany Parker', '803-323-1368', 'rau.sunny@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(289, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170849281', NULL, 'Shanelle Kozey', 'janis.kihn@example.com', '812.659.4751', '1808 Mack Passage Apt. 300\nNorth Mittieberg, DE 28880', NULL, NULL, NULL, NULL, '195999999.97', '19769.00', '0.00', NULL, '0.00', '196019768.97', 1, 'paid', NULL, 2, 'delivered', NULL, 'Veniam ullam incidunt unde.', '2025-02-27 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-02-27 06:17:08', '2025-08-24 06:17:08', 'Mckenna Mosciski', '+15059720170', 'gregg20@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(290, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170840982', NULL, 'Dianna Nicolas', 'janessa.predovic@example.com', '(551) 820-2603', '40188 Welch Rue\nLupeside, AZ 78298-7705', NULL, NULL, NULL, NULL, '64999999.99', '27497.00', '0.00', NULL, '0.00', '65027496.99', 1, 'paid', NULL, 1, 'delivered', NULL, NULL, '2024-10-17 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-17 06:17:08', '2025-08-24 06:17:08', 'Abigail Durgan', '+1-678-438-3280', 'brett31@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(291, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170848783', NULL, 'Madyson Herzog', 'moises.runolfsson@example.org', '+1.760.671.7844', '2178 Trantow Shoals\nNicolasstad, NV 76378-5502', NULL, NULL, NULL, NULL, '201500000.00', '28179.00', '0.00', NULL, '0.00', '201528179.00', 2, 'failed', NULL, 2, 'delivered', 'Tempora nostrum voluptas sequi provident illo ipsum.', NULL, '2024-12-11 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-11 06:17:08', '2025-08-24 06:17:08', 'Mr. Dorthy Bosco PhD', '785-997-3255', 'hoppe.vernice@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(292, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170852784', NULL, 'Mrs. Neoma Jones IV', 'willms.doug@example.com', '+1 (651) 631-2717', '4967 Willy Estates\nEast Linnea, AL 26805-4402', NULL, NULL, NULL, NULL, '137500000.02', '23205.00', '0.00', NULL, '0.00', '137523205.02', 1, 'failed', NULL, 1, 'delivered', NULL, NULL, '2024-11-11 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-11 06:17:08', '2025-08-24 06:17:08', 'Prof. Judson Schoen DDS', '864.214.8813', 'spinka.roxanne@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(293, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170810385', NULL, 'Mr. Conrad Goyette V', 'gilda77@example.com', '+1-435-919-8967', '153 Jared Gateway Apt. 528\nTodton, ND 42779-6246', NULL, NULL, NULL, NULL, '89500000.01', '14794.00', '0.00', NULL, '0.00', '89514794.01', 1, 'failed', NULL, 1, 'delivered', 'Libero et ea velit mollitia.', NULL, '2024-09-22 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-22 06:17:08', '2025-08-24 06:17:08', 'Samir Hackett III', '+1-571-398-0320', 'stanton.collier@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(294, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170874386', NULL, 'Trisha Leannon', 'hackett.buster@example.com', '831.686.7231', '810 Ryan Crossing\nReingerchester, KS 23829', NULL, NULL, NULL, NULL, '34000000.00', '14806.00', '0.00', NULL, '0.00', '34014806.00', 1, 'failed', NULL, 2, 'delivered', 'Esse autem deleniti quia voluptate sunt corporis.', 'Rem ea quia eligendi molestiae.', '2024-11-08 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-08 06:17:08', '2025-08-24 06:17:08', 'Dr. Webster Hermann Sr.', '1-850-327-5771', 'osinski.jody@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(295, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170831787', NULL, 'Edmund Weissnat', 'eva90@example.org', '+1 (303) 415-2591', '447 Lexie Land Suite 707\nNorth Eula, HI 46978-1820', NULL, NULL, NULL, NULL, '6000000.00', '16478.00', '0.00', NULL, '0.00', '6016478.00', 2, 'paid', NULL, 2, 'delivered', 'Est est illum error amet non et nostrum.', NULL, '2025-03-24 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-24 06:17:08', '2025-08-24 06:17:08', 'Cordie Heathcote', '+1-703-363-5988', 'lyundt@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(296, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170897188', NULL, 'Alfonso Lubowitz', 'dylan.pollich@example.org', '+19312998420', '3376 Winston Roads\nNorth Zacharyport, MA 48620-8027', NULL, NULL, NULL, NULL, '114700000.00', '21295.00', '0.00', NULL, '0.00', '114721295.00', 2, 'pending', NULL, 2, 'delivered', NULL, 'Dolores reiciendis voluptas autem expedita.', '2024-12-23 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-23 06:17:08', '2025-08-24 06:17:08', 'Esther Dach I', '(661) 330-7649', 'elmo.homenick@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(297, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170838989', NULL, 'Dr. Zachariah Heller', 'shyanne.conn@example.net', '+19206540974', '731 Celine Tunnel\nSamsonton, HI 16881-4014', NULL, NULL, NULL, NULL, '160000000.00', '27510.00', '0.00', NULL, '0.00', '160027510.00', 2, 'refunded', NULL, 1, 'delivered', 'Accusamus magni autem eos vero eos.', NULL, '2024-12-25 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-25 06:17:08', '2025-08-24 06:17:08', 'Stanford Skiles', '(832) 502-5333', 'oconnell.marina@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(298, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170821290', NULL, 'Brionna Haley V', 'stephon.mitchell@example.org', '+1.610.709.4683', '601 Mosciski Island Suite 171\nNorth Jocelyn, WI 78905', NULL, NULL, NULL, NULL, '49500000.00', '19524.00', '0.00', NULL, '0.00', '49519524.00', 1, 'failed', NULL, 1, 'delivered', 'In aliquam id eligendi hic corporis aut sed.', 'Deleniti eaque enim ea et nostrum.', '2025-07-16 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-16 06:17:08', '2025-08-24 06:17:08', 'Mr. Ralph Beier', '1-609-897-8210', 'reed81@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(299, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170824591', NULL, 'Tyree Murazik III', 'stamm.brycen@example.org', '725-553-0350', '433 Mollie Bypass\nWest Tannerstad, CO 70643', NULL, NULL, NULL, NULL, '111999999.99', '25622.00', '0.00', NULL, '0.00', '112025621.99', 2, 'refunded', NULL, 1, 'delivered', NULL, 'Aut sit dolor quasi dignissimos.', '2025-03-31 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-31 06:17:08', '2025-08-24 06:17:08', 'Mr. Victor Emard DVM', '1-513-249-4589', 'gisselle.boyer@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(300, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170827192', NULL, 'Clemens Upton', 'dkassulke@example.net', '(385) 903-9476', '3899 Ed Forge\nLynchside, NV 21807-3717', NULL, NULL, NULL, NULL, '80999999.99', '15182.00', '0.00', NULL, '0.00', '81015181.99', 1, 'paid', NULL, 1, 'delivered', 'Voluptatem corporis sint enim non.', 'Quos qui architecto quod voluptate dolore similique.', '2024-11-08 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-08 06:17:08', '2025-08-24 06:17:08', 'Mr. Trenton Bechtelar I', '+12704544260', 'barton.abbey@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(301, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170825693', NULL, 'Tristin Witting', 'erussel@example.com', '785.446.3887', '29084 Spencer Road Apt. 492\nSouth Norene, IN 79262', NULL, NULL, NULL, NULL, '163500000.01', '10400.00', '0.00', NULL, '0.00', '163510400.01', 2, 'refunded', NULL, 1, 'delivered', 'Laudantium voluptatibus libero ut vero sed dolor dolorum et.', NULL, '2025-05-17 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-17 06:17:08', '2025-08-24 06:17:08', 'Stuart Williamson', '(364) 700-5587', 'leopoldo.rice@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(302, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170837594', NULL, 'Ms. Sallie Mraz III', 'malvina.rippin@example.org', '1-662-209-2048', '5657 Cormier Cove\nHarberberg, MD 88976-7222', NULL, NULL, NULL, NULL, '25500000.03', '20345.00', '0.00', NULL, '0.00', '25520345.03', 2, 'paid', NULL, 2, 'delivered', 'Ipsam id officiis eveniet occaecati.', 'Voluptatibus et iusto repellendus ipsa recusandae et voluptatem.', '2024-09-30 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-30 06:17:08', '2025-08-24 06:17:08', 'Quentin Satterfield', '559-922-1553', 'geovanny.wehner@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(303, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170864495', NULL, 'Zelda Fritsch', 'demarcus23@example.net', '+1-303-400-3790', '6413 Brakus Vista\nWest Chetfort, MO 06802', NULL, NULL, NULL, NULL, '44000000.00', '17783.00', '0.00', NULL, '0.00', '44017783.00', 2, 'pending', NULL, 1, 'delivered', 'Minima nobis est sunt et amet.', NULL, '2024-11-07 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-07 06:17:08', '2025-08-24 06:17:08', 'Eldred Prosacco', '601-353-4426', 'mchristiansen@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(304, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170862696', NULL, 'Virginia Abbott', 'rreilly@example.org', '1-484-685-4392', '9284 Lyda Extensions\nLake Kris, KS 99306', NULL, NULL, NULL, NULL, '47999999.97', '23158.00', '0.00', NULL, '0.00', '48023157.97', 2, 'paid', NULL, 1, 'delivered', 'Sed facere ullam nostrum corporis.', NULL, '2024-11-30 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-30 06:17:08', '2025-08-24 06:17:08', 'Annamarie Kilback', '+1-408-617-3183', 'callie36@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(305, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170822897', NULL, 'Torrance Kutch MD', 'gwuckert@example.org', '1-270-734-2896', '8575 Reagan Ports\nNorth Ebbashire, SD 35978', NULL, NULL, NULL, NULL, '65999999.98', '15345.00', '0.00', NULL, '0.00', '66015344.98', 2, 'paid', NULL, 2, 'delivered', 'Maiores eum et rerum nisi repellendus accusantium et.', NULL, '2025-08-19 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-19 06:17:08', '2025-08-24 06:17:08', 'Vance Jerde', '+1.813.200.6008', 'fritz.grimes@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(306, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170816198', NULL, 'Ms. Angeline O\'Hara PhD', 'hrice@example.org', '+1 (941) 562-6938', '1447 Weston Burg\nEast Merlfort, RI 11285', NULL, NULL, NULL, NULL, '77999999.98', '19823.00', '0.00', NULL, '0.00', '78019822.98', 1, 'refunded', NULL, 1, 'delivered', NULL, NULL, '2025-04-12 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-12 06:17:08', '2025-08-24 06:17:08', 'Benton Dickens II', '+14842727379', 'alford.mcclure@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(307, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413170831099', NULL, 'Preston Bogisich', 'jalyn.kassulke@example.net', '+1-404-610-5763', '339 Tyrell Squares\nWinstonbury, VT 08198', NULL, NULL, NULL, NULL, '43999999.98', '12048.00', '0.00', NULL, '0.00', '44012047.98', 1, 'refunded', NULL, 1, 'delivered', 'Assumenda accusamus molestiae omnis repellendus porro.', NULL, '2025-07-13 06:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-13 06:17:08', '2025-08-24 06:17:08', 'Wendell Mante DDS', '(769) 903-1940', 'hoeger.carmela@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(308, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241318466690', NULL, 'Carmine King', 'lesch.cayla@example.com', '+16579630687', '227 Roob Walks\nSouth Efrenstad, WY 62980-0429', NULL, NULL, NULL, NULL, '64399999.98', '17791.00', '0.00', NULL, '0.00', '64417790.98', 2, 'failed', NULL, 1, 'delivered', 'Accusamus rem maiores excepturi dicta.', NULL, '2025-06-05 06:18:46', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-05 06:18:46', '2025-08-24 06:18:46', 'Jasper Krajcik Sr.', '940.987.9645', 'stiedemann.armani@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(309, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241318467511', NULL, 'Clarabelle Douglas DDS', 'obie21@example.net', '1-915-876-8067', '189 Norval Plains Apt. 725\nWest Lila, FL 43172-3611', NULL, NULL, NULL, NULL, '123999998.00', '27704.00', '0.00', NULL, '0.00', '124027702.00', 1, 'pending', NULL, 1, 'delivered', 'Quasi rerum quo magni est harum quis.', NULL, '2025-03-23 06:18:46', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-23 06:18:46', '2025-08-24 06:18:46', 'Liam Rodriguez DDS', '+1-828-352-8920', 'heaney.gilda@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(310, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241318466322', NULL, 'Mr. Woodrow VonRueden MD', 'meghan88@example.com', '+1-930-532-0547', '97252 Carley Pines Suite 950\nLake Elianeshire, OK 66611-7404', NULL, NULL, NULL, NULL, '67499999.94', '28580.00', '0.00', NULL, '0.00', '67528579.94', 2, 'refunded', NULL, 1, 'delivered', 'Voluptate nostrum recusandae quasi consequatur consectetur officiis est alias.', NULL, '2025-04-08 06:18:46', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-08 06:18:46', '2025-08-24 06:18:46', 'Ms. Simone Swift III', '678.257.1296', 'nhilpert@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(311, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241318467853', NULL, 'Alexandrine Schaden IV', 'bogisich.amely@example.com', '+1.725.769.7084', '31814 Sim Harbor Suite 541\nDewaynemouth, ND 61337', NULL, NULL, NULL, NULL, '69099999.97', '15830.00', '0.00', NULL, '0.00', '69115829.97', 1, 'paid', NULL, 1, 'delivered', 'Pariatur numquam quis id mollitia praesentium doloribus.', 'Omnis ut facilis expedita veniam.', '2025-08-15 06:18:46', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-15 06:18:46', '2025-08-24 06:18:46', 'Ocie Crooks', '+17126215109', 'carlo25@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(312, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241318469864', NULL, 'Meggie Labadie', 'prosenbaum@example.net', '1-731-474-9947', '102 Kurt Roads\nOtiliafort, GA 36091', NULL, NULL, NULL, NULL, '31399999.98', '20960.00', '0.00', NULL, '0.00', '31420959.98', 2, 'refunded', NULL, 2, 'delivered', 'Earum ut at ducimus aliquid delectus quam.', NULL, '2025-08-04 06:18:46', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-04 06:18:46', '2025-08-24 06:18:46', 'Prof. Jordan Hessel', '+1.731.444.9870', 'stewart.hintz@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(313, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241318465135', NULL, 'Mr. Coty Block V', 'hazel.simonis@example.org', '484.460.9776', '49587 Effertz Path Suite 739\nHahnfort, OH 64505', NULL, NULL, NULL, NULL, '70600000.00', '16976.00', '0.00', NULL, '0.00', '70616976.00', 1, 'paid', NULL, 2, 'delivered', NULL, 'Quia aliquid rem aut et eos et veniam.', '2024-12-10 06:18:46', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-10 06:18:46', '2025-08-24 06:18:46', 'Donna Hettinger III', '(334) 923-8987', 'vicente.jerde@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(314, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241318461696', NULL, 'Hilario Keeling', 'ocrooks@example.org', '361.917.9304', '71941 Vandervort Green Apt. 234\nCummeratamouth, SC 09957', NULL, NULL, NULL, NULL, '26100000.00', '23147.00', '0.00', NULL, '0.00', '26123147.00', 2, 'refunded', NULL, 2, 'delivered', NULL, 'Aut autem et repellendus enim possimus modi ducimus.', '2025-05-17 06:18:46', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-17 06:18:46', '2025-08-24 06:18:46', 'Esther Parker I', '(820) 970-8580', 'solon.cummings@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(315, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241318468887', NULL, 'Stanford Effertz', 'metz.dan@example.com', '689-913-6005', '84073 Macejkovic Drive Apt. 230\nEast Elwinport, MD 08265-1275', NULL, NULL, NULL, NULL, '76499999.99', '24675.00', '0.00', NULL, '0.00', '76524674.99', 2, 'paid', NULL, 1, 'delivered', NULL, NULL, '2025-07-28 06:18:46', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-28 06:18:46', '2025-08-24 06:18:46', 'Dr. Andy Shanahan IV', '1-475-599-6063', 'prohaska.vivianne@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(316, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241318461438', NULL, 'Louie Deckow IV', 'marilie23@example.com', '775.691.7663', '44914 Wisozk Unions Suite 777\nO\'Reillyberg, WA 78792-7585', NULL, NULL, NULL, NULL, '30000000.00', '21624.00', '0.00', NULL, '0.00', '30021624.00', 1, 'paid', NULL, 1, 'delivered', NULL, 'Suscipit praesentium voluptas ea ut similique iste consequatur.', '2024-11-16 06:18:46', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-16 06:18:46', '2025-08-24 06:18:46', 'Jennings Hagenes', '(480) 636-4280', 'murazik.fausto@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(317, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD2508241318469349', NULL, 'Prof. Garrett Franecki IV', 'dolly43@example.com', '856-574-8095', '8770 Nola Oval\nLednerchester, AL 70715', NULL, NULL, NULL, NULL, '152999997.99', '17677.00', '0.00', NULL, '0.00', '153017674.99', 2, 'pending', NULL, 2, 'delivered', NULL, NULL, '2025-01-05 06:18:46', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-05 06:18:46', '2025-08-24 06:18:46', 'Maximillia Lubowitz', '+12812188901', 'jody83@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(318, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184626310', NULL, 'Mr. Dejuan Kshlerin MD', 'zgulgowski@example.org', '1-385-573-5040', '7976 Gorczany Port\nWatersfort, VT 38727', NULL, NULL, NULL, NULL, '93999999.99', '21444.00', '0.00', NULL, '0.00', '94021443.99', 2, 'failed', NULL, 1, 'delivered', NULL, 'Fugit rerum nihil deserunt quibusdam ea qui sit.', '2025-04-22 06:18:46', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-22 06:18:46', '2025-08-24 06:18:46', 'Genesis Gulgowski', '+1.346.696.4760', 'runolfsson.elta@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(319, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184645211', NULL, 'Mr. Christophe Kreiger DVM', 'anderson.domingo@example.org', '458-593-2194', '10227 Claire Rapid\nSouth Enola, WY 64773', NULL, NULL, NULL, NULL, '135400000.00', '10408.00', '0.00', NULL, '0.00', '135410408.00', 1, 'refunded', NULL, 1, 'delivered', NULL, 'Enim nesciunt cupiditate nemo.', '2024-09-09 06:18:46', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-09 06:18:46', '2025-08-24 06:18:46', 'Prof. Pearlie Bailey', '1-732-857-2812', 'rempel.paris@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(320, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184686412', NULL, 'Milo Hirthe DDS', 'hildegard89@example.com', '(707) 988-9504', '4327 Lauretta Points Apt. 042\nWhitneyburgh, ND 03067', NULL, NULL, NULL, NULL, '81100000.00', '24185.00', '0.00', NULL, '0.00', '81124185.00', 1, 'pending', NULL, 2, 'delivered', 'Aliquam iure ut aliquam ad vel deleniti.', NULL, '2025-05-12 06:18:46', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-12 06:18:46', '2025-08-24 06:18:46', 'Providenci Hoppe Sr.', '661-907-8511', 'kbashirian@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(321, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184619513', NULL, 'Mr. Schuyler Paucek Sr.', 'gpaucek@example.com', '1-626-390-1058', '42227 Kautzer Shoals\nChamplinfurt, FL 38492', NULL, NULL, NULL, NULL, '142999994.98', '28460.00', '0.00', NULL, '0.00', '143028454.98', 2, 'failed', NULL, 1, 'delivered', 'Incidunt repellat dolorem dolorem quo totam.', NULL, '2025-03-09 06:18:46', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-09 06:18:46', '2025-08-24 06:18:47', 'Sim Zieme', '786.981.9268', 'litzy98@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(322, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184790114', NULL, 'Dr. Jerrell Green Jr.', 'zula.homenick@example.org', '1-781-957-4238', '4217 McLaughlin Spurs\nSouth Osvaldo, NM 80107', NULL, NULL, NULL, NULL, '5000000.00', '24866.00', '0.00', NULL, '0.00', '5024866.00', 2, 'failed', NULL, 1, 'delivered', NULL, NULL, '2025-05-20 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-20 06:18:47', '2025-08-24 06:18:47', 'Troy Grady', '559.619.5778', 'watsica.beverly@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(323, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184777715', NULL, 'Dr. Noemi Lesch', 'liam.fadel@example.com', '+1 (781) 971-7871', '625 Missouri Harbors\nEast Dannybury, NM 50802-7474', NULL, NULL, NULL, NULL, '47600000.00', '25052.00', '0.00', NULL, '0.00', '47625052.00', 1, 'paid', NULL, 2, 'delivered', 'Provident suscipit ut nihil et qui nulla sapiente.', NULL, '2025-01-08 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-08 06:18:47', '2025-08-24 06:18:47', 'Prof. Travon Swaniawski DDS', '1-725-435-0381', 'moconnell@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(324, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184718816', NULL, 'Sydnee Rippin II', 'schowalter.gilbert@example.org', '351-227-3546', '12108 Verner Estate Suite 498\nFelicityshire, MT 08344', NULL, NULL, NULL, NULL, '49999999.98', '26376.00', '0.00', NULL, '0.00', '50026375.98', 2, 'refunded', NULL, 2, 'delivered', 'Et aut est praesentium eum numquam excepturi doloribus.', NULL, '2025-02-24 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-02-24 06:18:47', '2025-08-24 06:18:47', 'Dean Schneider', '+15747171150', 'hildegard.jacobson@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(325, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184719417', NULL, 'Damion Gottlieb I', 'dmcdermott@example.org', '507-262-6036', '1532 Ubaldo Isle Suite 742\nCaspermouth, IA 68151-9232', NULL, NULL, NULL, NULL, '197899998.00', '15734.00', '0.00', NULL, '0.00', '197915732.00', 2, 'failed', NULL, 1, 'delivered', 'Qui nihil inventore dolorem enim.', NULL, '2024-12-26 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-26 06:18:47', '2025-08-24 06:18:47', 'Ms. Adriana Goldner', '1-281-599-7323', 'drodriguez@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(326, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184716918', NULL, 'Bernadette Swaniawski', 'dedrick.koelpin@example.net', '+1 (253) 969-9808', '13826 Hester Cove Apt. 065\nPort Eriktown, NV 75634', NULL, NULL, NULL, NULL, '37999998.00', '24456.00', '0.00', NULL, '0.00', '38024454.00', 1, 'failed', NULL, 2, 'delivered', NULL, 'Sed quia assumenda unde voluptatem.', '2024-10-02 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-02 06:18:47', '2025-08-24 06:18:47', 'Ewald Daniel III', '+1.229.723.5110', 'schinner.khalil@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `orders` (`id`, `user_id`, `shipper_id`, `received_at`, `in_delivery_at`, `failed_at`, `delivery_notes`, `failure_reason`, `delivery_images`, `order_code`, `transaction_id`, `customer_name`, `customer_email`, `customer_phone`, `shipping_address`, `buyer_name`, `buyer_email`, `buyer_phone`, `buyer_address`, `subtotal_amount`, `shipping_fee`, `discount_amount`, `discount_code`, `tax_amount`, `total_amount`, `payment_method_id`, `payment_status`, `payment_details`, `shipping_method_id`, `order_status`, `customer_note`, `admin_note`, `ordered_at`, `processing_at`, `shipped_at`, `delivered_at`, `cancelled_at`, `returned_at`, `cancellation_reason`, `pending_refund`, `previous_status`, `created_at`, `updated_at`, `shipping_name`, `shipping_phone`, `shipping_email`, `shipping_lat`, `shipping_lng`, `delivery_lat`, `delivery_lng`, `delivery_started_at`, `delivery_completed_at`, `delivery_address`, `vnp_transaction_no`, `vnp_transaction_date`) VALUES
(327, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184742519', NULL, 'Kobe Wyman', 'kariane19@example.com', '860.508.8162', '551 Braun Rapid Apt. 211\nLake Jessyside, OK 99438-1967', NULL, NULL, NULL, NULL, '33700000.00', '23775.00', '0.00', NULL, '0.00', '33723775.00', 1, 'failed', NULL, 2, 'delivered', NULL, NULL, '2025-01-06 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-06 06:18:47', '2025-08-24 06:18:47', 'Shaina Brown Sr.', '+1-404-376-5456', 'schroeder.myrtie@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(328, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184765320', NULL, 'Margie Beer', 'ghagenes@example.net', '+14584008942', '9626 Moriah Falls Apt. 865\nNew Schuylerview, MS 88170', NULL, NULL, NULL, NULL, '84300000.00', '13736.00', '0.00', NULL, '0.00', '84313736.00', 2, 'pending', NULL, 2, 'delivered', NULL, NULL, '2025-04-27 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-27 06:18:47', '2025-08-24 06:18:47', 'Kamren Cummerata', '+1 (253) 849-0756', 'cluettgen@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(329, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184757821', NULL, 'Mac Ziemann', 'rempel.imogene@example.com', '303.476.7873', '534 Wisozk Harbors Suite 010\nJustynstad, VA 84480-1666', NULL, NULL, NULL, NULL, '36000000.00', '10285.00', '0.00', NULL, '0.00', '36010285.00', 2, 'failed', NULL, 2, 'delivered', 'Magni rerum esse laborum.', 'Debitis nostrum temporibus qui libero magni harum exercitationem.', '2025-01-08 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-08 06:18:47', '2025-08-24 06:18:47', 'Miss Odessa Dach V', '240.806.3120', 'emilia.gulgowski@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(330, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184799622', NULL, 'Prof. Theo Davis', 'ofisher@example.org', '+1-520-858-5288', '1901 Jena Track\nMartychester, KY 52921', NULL, NULL, NULL, NULL, '73899999.97', '15128.00', '0.00', NULL, '0.00', '73915127.97', 2, 'failed', NULL, 1, 'delivered', 'Natus laborum aut quidem ut nam assumenda.', NULL, '2024-12-01 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-01 06:18:47', '2025-08-24 06:18:47', 'Brice Nader', '+1 (938) 578-8666', 'qkoss@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(331, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184716823', NULL, 'Miss Lela Legros', 'bmorissette@example.net', '1-640-752-9565', '764 Lenora Rue Suite 203\nCalistastad, KY 47183-6386', NULL, NULL, NULL, NULL, '149000000.00', '23801.00', '0.00', NULL, '0.00', '149023801.00', 2, 'failed', NULL, 1, 'delivered', 'Aut et ut consectetur molestiae commodi natus.', NULL, '2024-10-14 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-14 06:18:47', '2025-08-24 06:18:47', 'Prof. Nikko Hayes', '1-843-555-0848', 'rosenbaum.fanny@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(332, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184750324', NULL, 'Joelle Mertz Sr.', 'emanuel.bailey@example.org', '1-770-917-5864', '51539 Stamm Locks\nDerrickstad, OH 88222', NULL, NULL, NULL, NULL, '48000000.00', '13363.00', '0.00', NULL, '0.00', '48013363.00', 1, 'pending', NULL, 1, 'delivered', 'Officia sit veritatis voluptate iste qui.', 'Sapiente minima et aut.', '2024-12-20 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-20 06:18:47', '2025-08-24 06:18:47', 'Skylar Kuhn', '+1 (985) 362-5592', 'dylan85@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(333, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184788925', NULL, 'Serena Heathcote', 'alex.jacobson@example.com', '657.351.5032', '292 Gutmann Valleys Apt. 772\nLaneton, SD 31986-7753', NULL, NULL, NULL, NULL, '102099996.00', '21026.00', '0.00', NULL, '0.00', '102121022.00', 2, 'refunded', NULL, 1, 'delivered', 'Sed dolor veritatis illo labore dolore vel.', 'Laborum molestiae repudiandae facere exercitationem molestiae.', '2024-11-28 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-28 06:18:47', '2025-08-24 06:18:47', 'Rodolfo Gibson DDS', '+1-223-508-7423', 'kristian54@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(334, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184784426', NULL, 'Roxane Boehm', 'clara42@example.net', '+1.435.457.8978', '831 Daugherty Road Apt. 464\nLake Dionport, NJ 77509-1429', NULL, NULL, NULL, NULL, '120400000.00', '16381.00', '0.00', NULL, '0.00', '120416381.00', 2, 'refunded', NULL, 2, 'delivered', 'Quam possimus enim voluptatem voluptatem iste soluta sed.', NULL, '2025-07-26 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-26 06:18:47', '2025-08-24 06:18:47', 'Hayley Kiehn', '+1-757-274-8251', 'bo.schuster@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(335, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184744427', NULL, 'Dante Corwin Jr.', 'haley.foster@example.com', '1-864-896-9841', '98594 Langworth Plains\nEast Lilyside, TN 20550-9785', NULL, NULL, NULL, NULL, '128999999.97', '13652.00', '0.00', NULL, '0.00', '129013651.97', 2, 'failed', NULL, 2, 'delivered', 'Consequatur quidem enim animi sint suscipit consequatur.', 'Consequatur dolorem et eum aut.', '2025-06-08 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-08 06:18:47', '2025-08-24 06:18:47', 'Alanis Ratke', '762-731-5802', 'vlakin@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(336, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184711128', NULL, 'Zoie Jacobson', 'dkoelpin@example.net', '1-864-662-0811', '420 Anais Plaza Suite 591\nWest Gusbury, MN 94762', NULL, NULL, NULL, NULL, '56999997.00', '23718.00', '0.00', NULL, '0.00', '57023715.00', 1, 'refunded', NULL, 2, 'delivered', 'Omnis sunt deleniti perferendis aut rem deserunt et.', 'Et eligendi rerum sed dicta culpa animi dicta.', '2025-08-22 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-22 06:18:47', '2025-08-24 06:18:47', 'Allan Hickle', '+1 (508) 950-4398', 'madge.harber@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(337, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184742129', NULL, 'Henri Stroman', 'idella.turcotte@example.com', '+14067544848', '4409 Alexandro Camp Suite 783\nEulahside, MT 98699-1522', NULL, NULL, NULL, NULL, '51000000.00', '20545.00', '0.00', NULL, '0.00', '51020545.00', 2, 'paid', NULL, 2, 'delivered', 'Nesciunt cumque autem eum dicta voluptatem quia autem.', 'Ipsam est doloribus laborum eaque voluptas dolor totam omnis.', '2024-09-18 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-18 06:18:47', '2025-08-24 06:18:47', 'Josefina Kuhn', '+1 (831) 792-6121', 'denesik.shana@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(338, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184772630', NULL, 'Mrs. Claudie Runolfsdottir DDS', 'roma.halvorson@example.org', '+1.907.738.1989', '89566 Effertz Forest Suite 083\nEast Brendonmouth, NJ 78472', NULL, NULL, NULL, NULL, '113499999.00', '22029.00', '0.00', NULL, '0.00', '113522028.00', 2, 'failed', NULL, 2, 'delivered', 'Minus perferendis sunt et sint optio.', NULL, '2025-05-01 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-01 06:18:47', '2025-08-24 06:18:47', 'Ms. Maeve Gleichner II', '272.367.2643', 'dosinski@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(339, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184780731', NULL, 'Miss Clemmie Price', 'gaetano.schuppe@example.org', '1-539-977-4268', '481 Orn Square\nPort Makaylaburgh, UT 80945-5613', NULL, NULL, NULL, NULL, '114600000.00', '23587.00', '0.00', NULL, '0.00', '114623587.00', 2, 'refunded', NULL, 2, 'delivered', 'Sequi consequuntur ducimus ducimus corrupti et molestiae nihil ab.', NULL, '2025-03-09 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-09 06:18:47', '2025-08-24 06:18:47', 'Amara Greenfelder', '901.454.9209', 'paula.gusikowski@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(340, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184748732', NULL, 'Shane Walker', 'zstreich@example.org', '+1-541-560-1120', '1426 Lenora Ferry Suite 020\nNew Rozella, CO 14765', NULL, NULL, NULL, NULL, '91999996.95', '27158.00', '0.00', NULL, '0.00', '92027154.95', 2, 'refunded', NULL, 2, 'delivered', NULL, NULL, '2024-09-21 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-21 06:18:47', '2025-08-24 06:18:47', 'Haven DuBuque', '(207) 656-6124', 'maximillia.daugherty@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(341, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184716733', NULL, 'Tracy Bogan DVM', 'rhoppe@example.org', '+16074003481', '5030 Katelyn Viaduct\nAydenhaven, MN 05324', NULL, NULL, NULL, NULL, '34600000.00', '29038.00', '0.00', NULL, '0.00', '34629038.00', 2, 'paid', NULL, 1, 'delivered', 'Ullam numquam dignissimos necessitatibus possimus iste.', NULL, '2025-02-18 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-02-18 06:18:47', '2025-08-24 06:18:47', 'Ben Lowe', '502.289.2613', 'jaltenwerth@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(342, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184784034', NULL, 'Miss Kelly Pfannerstill', 'oconnell.greyson@example.com', '(571) 806-7383', '671 Deborah Point Apt. 922\nMaymieberg, IL 90360', NULL, NULL, NULL, NULL, '71999997.00', '17225.00', '0.00', NULL, '0.00', '72017222.00', 1, 'paid', NULL, 1, 'delivered', NULL, 'Et sint fuga omnis quam est.', '2025-06-02 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-02 06:18:47', '2025-08-24 06:18:47', 'Nya Corkery', '+1-281-755-3106', 'henderson.mertz@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(343, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184728135', NULL, 'Nellie Orn', 'floy.leannon@example.com', '+1 (419) 598-7031', '29103 Block Road\nPort Kayley, LA 53524-1787', NULL, NULL, NULL, NULL, '108000000.00', '16509.00', '0.00', NULL, '0.00', '108016509.00', 2, 'paid', NULL, 1, 'delivered', NULL, 'Et nobis quae necessitatibus et in.', '2025-06-09 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-09 06:18:47', '2025-08-24 06:18:47', 'Pearlie Schmidt', '+1.830.999.9970', 'alvah76@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(344, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184738536', NULL, 'Jailyn Schmitt', 'nondricka@example.com', '+1 (516) 327-1008', '38080 Harvey Lane Apt. 220\nPort Rashad, AR 03854-2042', NULL, NULL, NULL, NULL, '13999999.98', '21053.00', '0.00', NULL, '0.00', '14021052.98', 2, 'failed', NULL, 2, 'delivered', 'Dignissimos aliquid voluptate velit.', 'Provident fugiat sunt eius et reiciendis ex et.', '2025-06-28 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-28 06:18:47', '2025-08-24 06:18:47', 'Miss Amie Jenkins Jr.', '+1-828-417-9387', 'joy.kerluke@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(345, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184783537', NULL, 'Mr. Christ Bahringer I', 'ustamm@example.com', '231-217-6506', '5088 Considine Summit Suite 498\nNorth Raymondmouth, AR 07415-3401', NULL, NULL, NULL, NULL, '68999999.98', '18065.00', '0.00', NULL, '0.00', '69018064.98', 2, 'paid', NULL, 1, 'delivered', NULL, NULL, '2025-06-13 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-13 06:18:47', '2025-08-24 06:18:47', 'Linnie Grimes', '+1 (252) 874-9341', 'amira.bauch@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(346, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184742538', NULL, 'Bradley Heller', 'webster.mccullough@example.com', '(747) 668-4910', '527 Rice Court\nEast Kelli, ID 75024-0316', NULL, NULL, NULL, NULL, '72000000.00', '27741.00', '0.00', NULL, '0.00', '72027741.00', 2, 'refunded', NULL, 1, 'delivered', 'Dolores laudantium voluptatem corporis consequatur aut.', 'Voluptatum optio qui qui est nihil.', '2025-04-20 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-20 06:18:47', '2025-08-24 06:18:47', 'Mekhi Gutkowski IV', '+1.971.272.7730', 'tiara63@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(347, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184785439', NULL, 'Madeline Cartwright', 'madison.feil@example.net', '1-636-685-6609', '7854 Legros Village Suite 104\nLake Haliemouth, HI 72109-8170', NULL, NULL, NULL, NULL, '93999999.99', '16660.00', '0.00', NULL, '0.00', '94016659.99', 1, 'pending', NULL, 2, 'delivered', NULL, NULL, '2025-06-15 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-15 06:18:47', '2025-08-24 06:18:47', 'Nicolette Moore', '+1.330.446.5589', 'abdiel12@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(348, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184742140', NULL, 'Reva Grant', 'norene.waelchi@example.org', '+1-513-724-5105', '132 Mayra Way Apt. 999\nReichelfurt, NY 81417', NULL, NULL, NULL, NULL, '28999999.00', '14386.00', '0.00', NULL, '0.00', '29014385.00', 2, 'failed', NULL, 2, 'delivered', NULL, NULL, '2025-05-09 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-09 06:18:47', '2025-08-24 06:18:47', 'Cara Schaefer II', '1-951-914-9201', 'kihn.rhett@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(349, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184751641', NULL, 'Evans Emard', 'emard.maggie@example.org', '(986) 395-8832', '833 Jonathan Fork Apt. 294\nPort Elijah, OH 11156-7357', NULL, NULL, NULL, NULL, '108999999.99', '14158.00', '0.00', NULL, '0.00', '109014157.99', 1, 'failed', NULL, 1, 'delivered', NULL, 'Fugit in qui officia minima est harum.', '2024-12-27 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-27 06:18:47', '2025-08-24 06:18:47', 'Delphia Russel', '1-281-546-0163', 'sleffler@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(350, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184755842', NULL, 'Bailey Friesen', 'hessel.charles@example.net', '1-424-847-5868', '15358 McKenzie Flat Suite 799\nLake Favian, MD 87267', NULL, NULL, NULL, NULL, '115100000.00', '18169.00', '0.00', NULL, '0.00', '115118169.00', 2, 'pending', NULL, 1, 'delivered', NULL, 'Nesciunt odit iusto quis rerum dolor incidunt.', '2025-01-17 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-17 06:18:47', '2025-08-24 06:18:47', 'Prof. Laurel Bailey V', '(832) 549-5497', 'philip51@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(351, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184747543', NULL, 'Mariano Walker II', 'scarlett85@example.com', '+1-870-836-3209', '518 Waelchi Valley\nPort Favianborough, ID 14592-0124', NULL, NULL, NULL, NULL, '69999999.00', '27193.00', '0.00', NULL, '0.00', '70027192.00', 1, 'refunded', NULL, 2, 'delivered', 'Animi sit sit veniam.', 'Natus a magnam neque itaque.', '2025-04-02 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-02 06:18:47', '2025-08-24 06:18:47', 'Lauretta Lesch MD', '+1-520-216-0311', 'jaida08@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(352, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184744944', NULL, 'Francisca Schultz', 'jermey21@example.org', '+1 (253) 563-5228', '39705 Hackett Divide\nNorth Merrittton, VA 25983-3668', NULL, NULL, NULL, NULL, '188699999.97', '29684.00', '0.00', NULL, '0.00', '188729683.97', 2, 'pending', NULL, 2, 'delivered', NULL, 'Fugiat ea voluptates porro provident molestiae.', '2025-05-23 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-23 06:18:47', '2025-08-24 06:18:47', 'Cristina Parisian', '+1.315.822.8782', 'gkuhic@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(353, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184751245', NULL, 'Carolanne Muller', 'ralph.nikolaus@example.org', '762.969.5336', '83508 Precious Wall Apt. 855\nNorth Annetteport, KS 91914-8489', NULL, NULL, NULL, NULL, '75000000.00', '17062.00', '0.00', NULL, '0.00', '75017062.00', 1, 'failed', NULL, 1, 'delivered', 'Illum et delectus est cupiditate.', NULL, '2025-05-01 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-01 06:18:47', '2025-08-24 06:18:47', 'Furman Erdman', '351.849.4894', 'malika64@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(354, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184770146', NULL, 'Garret Senger V', 'bonita.homenick@example.com', '708-638-1965', '405 Zemlak Keys\nKeelingbury, MT 45427-4424', NULL, NULL, NULL, NULL, '81299999.97', '11208.00', '0.00', NULL, '0.00', '81311207.97', 1, 'failed', NULL, 1, 'delivered', NULL, 'Id excepturi sed natus ducimus accusantium officiis sit.', '2025-07-25 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-25 06:18:47', '2025-08-24 06:18:47', 'Sedrick Hahn', '+1.585.827.1387', 'keebler.shane@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(355, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184736247', NULL, 'Mike Keebler DDS', 'jerde.kareem@example.com', '+1-872-298-5418', '3212 Samanta Loaf\nItzelburgh, CA 39949', NULL, NULL, NULL, NULL, '94400000.00', '18912.00', '0.00', NULL, '0.00', '94418912.00', 1, 'pending', NULL, 1, 'delivered', 'Dolorem corporis quam molestiae qui et omnis.', 'Consectetur ducimus ab aut commodi neque quasi ab.', '2024-12-18 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-18 06:18:47', '2025-08-24 06:18:47', 'Connie Zieme', '1-209-592-4717', 'blaze.adams@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(356, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184797848', NULL, 'Garland Bartoletti', 'vivienne27@example.com', '539-434-2591', '373 Maiya Knolls\nKeelingport, ID 65262', NULL, NULL, NULL, NULL, '30000000.00', '21573.00', '0.00', NULL, '0.00', '30021573.00', 1, 'refunded', NULL, 2, 'delivered', NULL, 'Optio tenetur est incidunt officia.', '2025-02-03 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-02-03 06:18:47', '2025-08-24 06:18:47', 'Furman Vandervort', '(872) 692-5692', 'kariane.buckridge@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(357, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184760249', NULL, 'Marc Price', 'lebsack.maye@example.net', '561-404-2101', '16318 Herman Expressway Suite 721\nKrisfort, HI 20989', NULL, NULL, NULL, NULL, '102199998.98', '10062.00', '0.00', NULL, '0.00', '102210060.98', 2, 'refunded', NULL, 2, 'delivered', NULL, 'Non porro commodi possimus perspiciatis facere.', '2024-08-30 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-08-30 06:18:47', '2025-08-24 06:18:47', 'Robert Osinski', '+12672532367', 'benedict.botsford@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(358, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184735450', NULL, 'Prof. Nadia Goodwin', 'vboyer@example.net', '321-526-7713', '8348 Schamberger Mountains\nWest Fausto, HI 87375-9075', NULL, NULL, NULL, NULL, '47400000.00', '14868.00', '0.00', NULL, '0.00', '47414868.00', 2, 'refunded', NULL, 2, 'delivered', 'Esse molestiae qui sed optio eum reiciendis possimus nisi.', NULL, '2025-07-27 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-27 06:18:47', '2025-08-24 06:18:47', 'Janick Stamm', '+1-469-490-9704', 'alfred18@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(359, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184753351', NULL, 'Keenan Cummings', 'ismael.reichel@example.org', '820.854.1706', '6318 Lakin Overpass\nPricefurt, AK 95234', NULL, NULL, NULL, NULL, '37999998.00', '25821.00', '0.00', NULL, '0.00', '38025819.00', 1, 'failed', NULL, 2, 'delivered', 'Non exercitationem dolores nihil adipisci.', 'Dignissimos sed voluptas et.', '2025-05-25 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-25 06:18:47', '2025-08-24 06:18:47', 'Julia Schulist', '+12835615524', 'volkman.kathleen@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(360, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184799552', NULL, 'Prof. Alisa Predovic Jr.', 'ladarius.prohaska@example.org', '1-801-488-7769', '2855 Crona Village Suite 049\nWelchstad, NJ 58643-4187', NULL, NULL, NULL, NULL, '19999999.99', '24770.00', '0.00', NULL, '0.00', '20024769.99', 2, 'refunded', NULL, 1, 'delivered', NULL, 'Reiciendis temporibus porro harum aliquid tempore sit libero.', '2025-05-25 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-25 06:18:47', '2025-08-24 06:18:47', 'Dr. Tom Nader II', '563.757.0445', 'ruby97@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(361, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184750053', NULL, 'Mr. Delaney Yost DVM', 'kerluke.jarrell@example.org', '1-848-909-1129', '62078 Stiedemann Forest\nPourostown, AK 68688-2108', NULL, NULL, NULL, NULL, '92699997.00', '19789.00', '0.00', NULL, '0.00', '92719786.00', 1, 'paid', NULL, 1, 'delivered', NULL, 'Eum rem itaque quidem eum sit.', '2025-05-27 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-27 06:18:47', '2025-08-24 06:18:47', 'Natasha Botsford', '+1 (410) 251-6079', 'ike.langosh@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(362, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184761854', NULL, 'Trystan Daniel Jr.', 'runolfsdottir.rylan@example.org', '(979) 334-2970', '30350 Sadye Freeway Apt. 505\nKreigerfort, MO 03452-5098', NULL, NULL, NULL, NULL, '15000000.00', '27802.00', '0.00', NULL, '0.00', '15027802.00', 2, 'paid', NULL, 1, 'delivered', NULL, NULL, '2025-05-30 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-30 06:18:47', '2025-08-24 06:18:47', 'Novella Shields', '(463) 979-4798', 'greenfelder.gerry@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(363, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184775455', NULL, 'Dr. Lance Franecki DVM', 'lincoln.schneider@example.com', '870.753.6012', '453 Joseph Road Suite 488\nNew Jeremiebury, WV 88572', NULL, NULL, NULL, NULL, '51000000.00', '28446.00', '0.00', NULL, '0.00', '51028446.00', 1, 'pending', NULL, 2, 'delivered', NULL, NULL, '2025-06-11 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-11 06:18:47', '2025-08-24 06:18:47', 'Ms. Teresa Mueller', '830.431.8894', 'qoberbrunner@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(364, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184794556', NULL, 'Adaline Goodwin', 'qtorp@example.net', '(781) 833-7046', '590 Schoen Estate\nO\'Connellville, HI 03393', NULL, NULL, NULL, NULL, '56999997.00', '15199.00', '0.00', NULL, '0.00', '57015196.00', 1, 'failed', NULL, 1, 'delivered', NULL, 'Rerum beatae exercitationem consequuntur perferendis asperiores amet.', '2025-05-25 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-25 06:18:47', '2025-08-24 06:18:47', 'Elna Zieme', '515-209-4492', 'alfreda.feeney@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(365, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184723957', NULL, 'Enola Morissette IV', 'xbernhard@example.net', '1-661-308-4536', '54687 Zulauf Club\nLake Roosevelt, MA 62061-5388', NULL, NULL, NULL, NULL, '68699997.96', '24365.00', '0.00', NULL, '0.00', '68724362.96', 1, 'refunded', NULL, 2, 'delivered', NULL, 'Facilis eaque delectus officiis perspiciatis.', '2025-07-22 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-22 06:18:47', '2025-08-24 06:18:47', 'Lily Sipes', '(715) 436-3282', 'xkoelpin@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(366, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184757658', NULL, 'Prof. Rigoberto Bauch DVM', 'miller.samara@example.com', '+1-930-206-5197', '66953 Buster Heights Suite 028\nSouth Rosalinda, NV 36357', NULL, NULL, NULL, NULL, '26100000.00', '12172.00', '0.00', NULL, '0.00', '26112172.00', 2, 'refunded', NULL, 1, 'delivered', NULL, NULL, '2025-01-02 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-02 06:18:47', '2025-08-24 06:18:47', 'Christina Rowe', '559-309-3610', 'igoldner@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(367, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184786859', NULL, 'Kristofer Lesch', 'itromp@example.net', '(458) 855-3905', '463 Alfonso Oval Suite 605\nBernadetteberg, NM 68396-0567', NULL, NULL, NULL, NULL, '33999999.00', '16432.00', '0.00', NULL, '0.00', '34016431.00', 2, 'paid', NULL, 2, 'delivered', NULL, 'Non facere consequatur in excepturi earum.', '2025-07-23 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-23 06:18:47', '2025-08-24 06:18:47', 'Ms. Caitlyn Roob', '(629) 538-8816', 'margaretta.harris@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(368, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184758160', NULL, 'Sammie Hane', 'elias.boyer@example.com', '+1-843-416-6890', '7869 Nolan Lodge\nWest Lewisview, NE 00451-4100', NULL, NULL, NULL, NULL, '132999993.00', '11679.00', '0.00', NULL, '0.00', '133011672.00', 1, 'paid', NULL, 2, 'delivered', 'Enim a quo eum non eos et.', 'Quibusdam qui deleniti cupiditate cumque sed deleniti velit.', '2024-12-25 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-25 06:18:47', '2025-08-24 06:18:47', 'Prof. Arjun Pacocha I', '704.427.4366', 'satterfield.russel@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(369, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184729561', NULL, 'Mr. Evert Walsh I', 'freida.emard@example.org', '763-705-6720', '136 Connelly Turnpike Suite 106\nWest Gina, FL 65523', NULL, NULL, NULL, NULL, '74600000.00', '25217.00', '0.00', NULL, '0.00', '74625217.00', 1, 'failed', NULL, 2, 'delivered', NULL, NULL, '2024-10-04 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-04 06:18:47', '2025-08-24 06:18:47', 'Bethel Orn DDS', '+1.845.613.9625', 'amraz@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(370, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184796362', NULL, 'Santino Conn', 'iebert@example.net', '(872) 586-6617', '68346 Adriel Hills\nNew Emilefurt, IN 30818', NULL, NULL, NULL, NULL, '85900000.00', '13998.00', '0.00', NULL, '0.00', '85913998.00', 2, 'failed', NULL, 2, 'delivered', NULL, NULL, '2024-11-25 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-25 06:18:47', '2025-08-24 06:18:47', 'Elton Sporer', '+18727799604', 'whirthe@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(371, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184761563', NULL, 'Mrs. Jannie Littel IV', 'nemard@example.org', '+1.463.504.7230', '721 Annabell Highway\nWest Amalia, OK 65537-6818', NULL, NULL, NULL, NULL, '129199999.95', '16657.00', '0.00', NULL, '0.00', '129216656.95', 2, 'paid', NULL, 2, 'delivered', 'Sit dolorem voluptatem tenetur porro voluptatem dolor est.', NULL, '2024-10-31 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-31 06:18:47', '2025-08-24 06:18:47', 'Cierra Jacobi', '+1-302-368-4066', 'reba.veum@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(372, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184780864', NULL, 'Brigitte Crooks DVM', 'maya.denesik@example.com', '+1.713.948.3981', '20116 Volkman Ranch\nNorth Melyssastad, LA 03310', NULL, NULL, NULL, NULL, '60000000.00', '19711.00', '0.00', NULL, '0.00', '60019711.00', 2, 'paid', NULL, 2, 'delivered', 'Et omnis et accusamus.', NULL, '2025-07-15 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-15 06:18:47', '2025-08-24 06:18:47', 'Prof. Romaine Cummerata', '1-934-338-3067', 'duncan.howell@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(373, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184780165', NULL, 'Antonette Cremin', 'sally08@example.com', '765.579.0626', '92258 Zboncak Pine\nGutkowskimouth, IN 10774', NULL, NULL, NULL, NULL, '88999999.98', '10952.00', '0.00', NULL, '0.00', '89010951.98', 2, 'failed', NULL, 2, 'delivered', 'Non minima consequuntur voluptas.', 'Dolorum quibusdam accusantium quasi soluta possimus.', '2024-12-14 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-14 06:18:47', '2025-08-24 06:18:47', 'Casandra Schmidt', '(341) 324-5184', 'joannie96@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(374, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184749766', NULL, 'Agnes Hackett', 'joy24@example.com', '785-458-6722', '422 Rice Rapid Apt. 675\nLake Alison, AZ 06973-1436', NULL, NULL, NULL, NULL, '17300000.00', '15477.00', '0.00', NULL, '0.00', '17315477.00', 1, 'pending', NULL, 1, 'delivered', NULL, NULL, '2024-10-06 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-06 06:18:47', '2025-08-24 06:18:47', 'Eusebio Lehner', '+1 (321) 788-8134', 'augustine.borer@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(375, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184786567', NULL, 'Liam Schamberger DVM', 'stone.hoeger@example.net', '(347) 903-7987', '9270 Lockman Groves Apt. 799\nPort Pattie, CT 44824-7729', NULL, NULL, NULL, NULL, '108399997.98', '12278.00', '0.00', NULL, '0.00', '108412275.98', 1, 'refunded', NULL, 1, 'delivered', NULL, 'Eaque at veniam tempora quod distinctio.', '2025-07-25 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-25 06:18:47', '2025-08-24 06:18:47', 'Talia Lemke', '281-893-0310', 'abagail39@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(376, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184720968', NULL, 'Dr. Joanie Quigley Sr.', 'fiona.nitzsche@example.com', '661.419.6800', '2519 Tillman Groves\nNorth Davin, AK 83054-8918', NULL, NULL, NULL, NULL, '134200000.00', '17668.00', '0.00', NULL, '0.00', '134217668.00', 1, 'pending', NULL, 2, 'delivered', NULL, NULL, '2025-01-18 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-18 06:18:47', '2025-08-24 06:18:47', 'Sarah Fay', '+1-423-440-4852', 'cormier.thaddeus@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(377, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184797169', NULL, 'Leif Gleason', 'jany44@example.net', '+14346618963', '4265 Shanna Groves\nLennyfurt, HI 00250', NULL, NULL, NULL, NULL, '51000000.00', '27040.00', '0.00', NULL, '0.00', '51027040.00', 1, 'refunded', NULL, 2, 'delivered', NULL, NULL, '2025-08-11 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-11 06:18:47', '2025-08-24 06:18:47', 'Dr. Aylin Friesen III', '+1-562-384-2304', 'mireya.considine@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(378, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184757270', NULL, 'Deja Lindgren', 'smith.nellie@example.com', '(856) 843-9256', '210 Ullrich Canyon\nDickensport, OR 43948-2038', NULL, NULL, NULL, NULL, '17300000.00', '13633.00', '0.00', NULL, '0.00', '17313633.00', 1, 'pending', NULL, 1, 'delivered', 'Vel et perspiciatis cupiditate soluta vel non voluptatem.', NULL, '2025-04-09 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-09 06:18:47', '2025-08-24 06:18:47', 'Dr. Nico Hill IV', '+14759805579', 'darrel.tillman@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(379, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184718871', NULL, 'Jessy Runte', 'zcassin@example.org', '740.404.0897', '6145 Cicero Cliffs Suite 890\nMuellerville, KS 09100', NULL, NULL, NULL, NULL, '17000000.00', '20163.00', '0.00', NULL, '0.00', '17020163.00', 2, 'failed', NULL, 2, 'delivered', NULL, 'Dignissimos eligendi omnis sed deleniti sunt.', '2025-03-24 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-24 06:18:47', '2025-08-24 06:18:47', 'Royce Hegmann', '(712) 469-8351', 'obergnaum@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(380, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184755372', NULL, 'Zion Mraz', 'spinka.ezekiel@example.net', '562.581.2391', '8406 Osinski Extension Suite 136\nHowetown, NM 62233', NULL, NULL, NULL, NULL, '30000000.00', '25582.00', '0.00', NULL, '0.00', '30025582.00', 2, 'refunded', NULL, 2, 'delivered', 'Consequuntur aut quos ut repudiandae voluptatem minima tempore illo.', 'Quia corrupti nam ex quae ipsum est.', '2024-11-01 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-01 06:18:47', '2025-08-24 06:18:47', 'Myron Renner', '+13347486319', 'schmidt.zoey@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(381, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184762773', NULL, 'Josiah Quitzon', 'cali93@example.com', '+1 (757) 272-7144', '259 Koby Row\nFriesenfort, ME 89859', NULL, NULL, NULL, NULL, '52100000.00', '27926.00', '0.00', NULL, '0.00', '52127926.00', 2, 'pending', NULL, 1, 'delivered', NULL, 'Qui vel dignissimos quos ipsum.', '2025-08-02 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-02 06:18:47', '2025-08-24 06:18:47', 'Kenyon Daugherty', '+1 (480) 763-0143', 'matilde.abbott@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(382, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184774574', NULL, 'Gina Gutkowski', 'stefanie.metz@example.net', '+13177352678', '5251 Cristopher Place Suite 057\nVickyfort, HI 94597', NULL, NULL, NULL, NULL, '120699999.99', '24820.00', '0.00', NULL, '0.00', '120724819.99', 2, 'failed', NULL, 2, 'delivered', NULL, NULL, '2025-01-29 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-01-29 06:18:47', '2025-08-24 06:18:47', 'Mr. Jaren Huels', '586.474.5764', 'gisselle95@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(383, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184766675', NULL, 'Dr. Baylee Ondricka', 'hayes.valentina@example.com', '+1.754.512.2825', '149 Shaniya Roads\nLake Nicklaus, MN 36323', NULL, NULL, NULL, NULL, '124400000.00', '12720.00', '0.00', NULL, '0.00', '124412720.00', 1, 'paid', NULL, 2, 'delivered', NULL, NULL, '2024-12-25 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-25 06:18:47', '2025-08-24 06:18:47', 'Caroline Smitham', '607-817-9305', 'awillms@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(384, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184731476', NULL, 'Dolores Kassulke', 'ullrich.jakob@example.com', '781.865.6710', '9158 Carissa Mountains\nEast Fidelbury, VT 17383-8433', NULL, NULL, NULL, NULL, '53999999.97', '18861.00', '0.00', NULL, '0.00', '54018860.97', 2, 'paid', NULL, 2, 'delivered', NULL, NULL, '2024-12-30 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-30 06:18:47', '2025-08-24 06:18:47', 'Alvera Schneider', '1-364-220-4343', 'eliseo25@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(385, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184788977', NULL, 'Cara O\'Hara', 'jayson.hermann@example.org', '1-253-734-9341', '6610 Baumbach Pine Apt. 403\nSouth Nathan, MA 53515-5615', NULL, NULL, NULL, NULL, '162900000.00', '25907.00', '0.00', NULL, '0.00', '162925907.00', 1, 'failed', NULL, 2, 'delivered', NULL, NULL, '2025-02-20 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-02-20 06:18:47', '2025-08-24 06:18:47', 'Alejandra Grady I', '+1.310.913.1503', 'swift.mariana@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(386, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184783878', NULL, 'Miss Sallie Ortiz I', 'uleffler@example.com', '283-313-9643', '318 Jedediah Pines Suite 353\nWest Moisesshire, MO 89327-6184', NULL, NULL, NULL, NULL, '34300000.00', '12613.00', '0.00', NULL, '0.00', '34312613.00', 1, 'failed', NULL, 1, 'delivered', 'Voluptates sapiente explicabo est aliquid quae nam.', NULL, '2025-04-02 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-02 06:18:47', '2025-08-24 06:18:47', 'Mrs. Mertie Dach', '+1 (640) 687-2760', 'flehner@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(387, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184784379', NULL, 'Karolann Cassin', 'lloyd59@example.org', '+1 (908) 630-9971', '72141 Hackett Lakes\nCordieburgh, HI 37596', NULL, NULL, NULL, NULL, '17000000.00', '17397.00', '0.00', NULL, '0.00', '17017397.00', 2, 'refunded', NULL, 1, 'delivered', NULL, 'Nobis atque ratione quia vel sed minus qui adipisci.', '2025-02-06 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-02-06 06:18:47', '2025-08-24 06:18:47', 'Nichole Robel', '234-412-7999', 'bwillms@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(388, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184789380', NULL, 'Dolores Ritchie', 'aking@example.com', '302.398.3894', '81455 Burdette Forks\nPort Abdiel, IL 17592', NULL, NULL, NULL, NULL, '33999999.99', '18220.00', '0.00', NULL, '0.00', '34018219.99', 2, 'refunded', NULL, 2, 'delivered', 'Voluptates eveniet quae doloribus et.', NULL, '2024-12-26 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-26 06:18:47', '2025-08-24 06:18:47', 'Ellie Hettinger', '1-920-212-3333', 'pstark@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(389, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184786981', NULL, 'Franco Quigley', 'hahn.nola@example.org', '(412) 927-5328', '47799 Santa Lakes Apt. 696\nNorth Pasqualefort, AZ 29520', NULL, NULL, NULL, NULL, '17300000.00', '14797.00', '0.00', NULL, '0.00', '17314797.00', 2, 'pending', NULL, 2, 'delivered', 'Odio officia officiis qui dolor.', 'Ducimus eveniet nihil rerum error soluta sed sapiente quidem.', '2025-03-02 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-03-02 06:18:47', '2025-08-24 06:18:47', 'Miller Donnelly', '+1-820-251-4768', 'rstehr@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(390, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184780082', NULL, 'Rebeka Batz I', 'tyson10@example.com', '1-725-862-8237', '303 Effie Fort\nVenamouth, SC 77177-0314', NULL, NULL, NULL, NULL, '126999999.00', '15251.00', '0.00', NULL, '0.00', '127015250.00', 2, 'pending', NULL, 1, 'delivered', NULL, 'At quo at aut veniam aut et quas.', '2025-08-02 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-02 06:18:47', '2025-08-24 06:18:47', 'Daniela Beatty', '+16263150825', 'idicki@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(391, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184784883', NULL, 'Carolyn Breitenberg', 'brekke.myrl@example.org', '1-629-893-8057', '4658 Marilyne Hollow\nNorth Anabelle, RI 84355', NULL, NULL, NULL, NULL, '74399998.98', '15081.00', '0.00', NULL, '0.00', '74415079.98', 2, 'failed', NULL, 1, 'delivered', 'Eius rerum dolorem porro exercitationem maxime omnis doloribus.', NULL, '2024-08-26 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-08-26 06:18:47', '2025-08-24 06:18:47', 'Prof. Bobbie Bashirian', '+1.614.294.3223', 'trent.schneider@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(392, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184750784', NULL, 'Miss Arianna Ferry', 'tillman.janelle@example.net', '551.405.9968', '89138 Emard Circles Suite 824\nJakubowskiville, WY 31242-7378', NULL, NULL, NULL, NULL, '64700000.00', '17109.00', '0.00', NULL, '0.00', '64717109.00', 2, 'pending', NULL, 2, 'delivered', 'Dolor omnis repellat quia quod saepe animi deserunt.', 'Qui corrupti dicta nihil harum nisi sit cupiditate laudantium.', '2025-02-25 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-02-25 06:18:47', '2025-08-24 06:18:47', 'Mrs. Heather McGlynn', '(920) 850-6780', 'jeff76@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(393, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184784385', NULL, 'Keith Jacobson', 'caden.leffler@example.com', '+1.479.845.1950', '893 Mraz Loaf Apt. 011\nPort Meaganmouth, TN 03832-9781', NULL, NULL, NULL, NULL, '89400000.00', '11664.00', '0.00', NULL, '0.00', '89411664.00', 1, 'pending', NULL, 2, 'delivered', 'Minima esse nemo reiciendis delectus tempora dolorem.', 'Exercitationem natus dolorum ad quibusdam voluptas temporibus nulla.', '2025-04-26 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-26 06:18:47', '2025-08-24 06:18:47', 'Telly King', '1-628-702-1617', 'berniece39@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(394, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184743886', NULL, 'Paxton Lockman', 'keebler.luther@example.net', '747-984-6471', '1611 Novella Meadows\nNorth Jameyshire, AL 30056', NULL, NULL, NULL, NULL, '44699999.94', '23929.00', '0.00', NULL, '0.00', '44723928.94', 2, 'pending', NULL, 1, 'delivered', NULL, 'Voluptate quisquam optio optio voluptatem et illum molestias.', '2025-05-16 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-16 06:18:47', '2025-08-24 06:18:47', 'Alexandrea McGlynn', '1-364-517-1854', 'natalia66@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(395, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184735487', NULL, 'Pink Murazik', 'yconn@example.net', '1-262-514-8682', '4780 Ziemann Landing\nJamalfurt, MA 58971', NULL, NULL, NULL, NULL, '73999997.97', '13363.00', '0.00', NULL, '0.00', '74013360.97', 2, 'pending', NULL, 1, 'delivered', 'Consequatur explicabo placeat magnam est provident.', 'Et sapiente nemo aspernatur cumque sapiente et nihil.', '2024-11-14 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-11-14 06:18:47', '2025-08-24 06:18:47', 'Miss Dejah Klocko', '+1-616-690-2651', 'ifeeney@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(396, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184722788', NULL, 'Lexus Herman', 'keeling.chadd@example.org', '+1.772.200.3123', '93646 Swift Mountains\nCraigshire, CA 32136', NULL, NULL, NULL, NULL, '120999999.00', '18485.00', '0.00', NULL, '0.00', '121018484.00', 1, 'failed', NULL, 2, 'delivered', NULL, 'Est eum voluptatem nemo qui esse.', '2025-04-17 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-17 06:18:47', '2025-08-24 06:18:47', 'Dr. Enid Crooks', '(442) 457-8547', 'jessy.schroeder@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(397, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184747089', NULL, 'Geraldine Kunde', 'shields.anissa@example.com', '484.252.1736', '34760 Celine Corners Suite 962\nPort Velda, MI 67150', NULL, NULL, NULL, NULL, '31399999.99', '25237.00', '0.00', NULL, '0.00', '31425236.99', 2, 'refunded', NULL, 2, 'delivered', NULL, NULL, '2024-12-11 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-11 06:18:47', '2025-08-24 06:18:47', 'Eugenia Reinger', '+1-484-959-9921', 'vicenta.williamson@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(398, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184733490', NULL, 'Joanie Ruecker Jr.', 'elza44@example.org', '+1-628-253-9689', '341 Connelly Lodge Apt. 393\nKeyshawnton, AR 17357', NULL, NULL, NULL, NULL, '265600000.00', '25603.00', '0.00', NULL, '0.00', '265625603.00', 2, 'failed', NULL, 1, 'delivered', 'Tempora accusantium cumque voluptatem non.', NULL, '2025-02-12 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-02-12 06:18:47', '2025-08-24 06:18:47', 'Grace Harris', '+1-229-295-0530', 'satterfield.ahmad@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(399, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184776791', NULL, 'Elmore Kilback V', 'ycasper@example.net', '458.235.7687', '1522 Hubert Drive Suite 137\nOswaldoland, NM 46911-9806', NULL, NULL, NULL, NULL, '157600000.00', '12272.00', '0.00', NULL, '0.00', '157612272.00', 2, 'failed', NULL, 1, 'delivered', NULL, NULL, '2024-09-27 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-09-27 06:18:47', '2025-08-24 06:18:47', 'Kailyn Marquardt', '+1.585.914.2424', 'maiya24@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(400, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184764792', NULL, 'Prof. Madie Gulgowski', 'eddie.funk@example.net', '(603) 322-8929', '7876 Jackeline Summit\nHowellville, KY 51957-3281', NULL, NULL, NULL, NULL, '49999999.98', '16639.00', '0.00', NULL, '0.00', '50016638.98', 1, 'pending', NULL, 1, 'delivered', NULL, 'Quam sunt non minima magni rerum et.', '2025-08-23 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-23 06:18:47', '2025-08-24 06:18:47', 'Mrs. Susana Howell Jr.', '+1 (325) 445-9648', 'paucek.clara@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(401, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184766893', NULL, 'Dr. Margarete Green PhD', 'judge.jenkins@example.org', '1-262-489-2726', '96562 Johnston Lodge Apt. 947\nPort Tateton, KS 65534', NULL, NULL, NULL, NULL, '120999999.98', '21488.00', '0.00', NULL, '0.00', '121021487.98', 1, 'failed', NULL, 1, 'delivered', NULL, 'Nostrum et expedita ipsa ab numquam sed.', '2025-04-09 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-09 06:18:47', '2025-08-24 06:18:47', 'Ms. Effie McCullough', '+1-425-785-5517', 'sierra85@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(402, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184748294', NULL, 'Ms. Juliet McCullough', 'amani.hayes@example.com', '531-781-5212', '42492 Balistreri Shores Apt. 043\nHesselbury, ND 86505-5623', NULL, NULL, NULL, NULL, '45099999.00', '20263.00', '0.00', NULL, '0.00', '45120262.00', 1, 'refunded', NULL, 1, 'delivered', NULL, 'Aut impedit sint debitis quia repellendus eos.', '2024-10-31 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-10-31 06:18:47', '2025-08-24 06:18:47', 'Stacy Lubowitz', '1-818-848-6801', 'adriana.ward@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(403, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184758695', NULL, 'Mr. Marcelo Skiles Jr.', 'zlakin@example.net', '(978) 243-7372', '831 Hilton Mill\nPort Lonnie, MS 19117-0892', NULL, NULL, NULL, NULL, '122999999.97', '13614.00', '0.00', NULL, '0.00', '123013613.97', 1, 'failed', NULL, 2, 'delivered', NULL, NULL, '2025-05-23 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-05-23 06:18:47', '2025-08-24 06:18:47', 'Emmett Gutmann', '1-408-914-3271', 'craynor@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(404, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184716996', NULL, 'Stephen Jakubowski', 'freida04@example.com', '+1.352.648.0067', '45006 Waelchi Terrace Suite 607\nTristianport, TN 07897-6007', NULL, NULL, NULL, NULL, '96199999.98', '26160.00', '0.00', NULL, '0.00', '96226159.98', 1, 'paid', NULL, 1, 'delivered', 'Voluptates quam perspiciatis incidunt et dolorem suscipit voluptate cumque.', 'Itaque ut eius blanditiis vel aliquam natus.', '2025-04-09 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-04-09 06:18:47', '2025-08-24 06:18:47', 'Dave Paucek', '+1.415.490.1913', 'ybosco@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(405, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184739797', NULL, 'Prof. Otis Beer', 'ispencer@example.net', '1-848-341-4314', '6788 Hazel Pines Suite 246\nSwiftville, MA 71466', NULL, NULL, NULL, NULL, '223300000.00', '11613.00', '0.00', NULL, '0.00', '223311613.00', 1, 'paid', NULL, 2, 'delivered', NULL, 'Veniam eligendi ipsam enim eos tempore.', '2025-07-29 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-29 06:18:47', '2025-08-24 06:18:47', 'Dr. Aliya Schuster', '+1.262.657.3772', 'hattie67@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(406, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184743898', NULL, 'Korey Harris', 'wpollich@example.com', '+1-628-933-5540', '920 Hane Bridge Suite 046\nSouth Adalberto, KY 22347-2500', NULL, NULL, NULL, NULL, '34000000.00', '13221.00', '0.00', NULL, '0.00', '34013221.00', 1, 'paid', NULL, 1, 'delivered', 'Eligendi aliquid et dolores enim.', 'Sapiente doloribus qui veritatis.', '2024-12-14 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-12-14 06:18:47', '2025-08-24 06:18:47', 'Howell Hauck', '856.632.4168', 'ghaag@example.org', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `orders` (`id`, `user_id`, `shipper_id`, `received_at`, `in_delivery_at`, `failed_at`, `delivery_notes`, `failure_reason`, `delivery_images`, `order_code`, `transaction_id`, `customer_name`, `customer_email`, `customer_phone`, `shipping_address`, `buyer_name`, `buyer_email`, `buyer_phone`, `buyer_address`, `subtotal_amount`, `shipping_fee`, `discount_amount`, `discount_code`, `tax_amount`, `total_amount`, `payment_method_id`, `payment_status`, `payment_details`, `shipping_method_id`, `order_status`, `customer_note`, `admin_note`, `ordered_at`, `processing_at`, `shipped_at`, `delivered_at`, `cancelled_at`, `returned_at`, `cancellation_reason`, `pending_refund`, `previous_status`, `created_at`, `updated_at`, `shipping_name`, `shipping_phone`, `shipping_email`, `shipping_lat`, `shipping_lng`, `delivery_lat`, `delivery_lng`, `delivery_started_at`, `delivery_completed_at`, `delivery_address`, `vnp_transaction_no`, `vnp_transaction_date`) VALUES
(407, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OD25082413184714699', NULL, 'Prof. Arvid Bergstrom PhD', 'alexandro.littel@example.org', '+1-231-551-8479', '13490 Kasandra Plains Suite 423\nNew Filibertohaven, MA 95095-1487', NULL, NULL, NULL, NULL, '47400000.00', '22415.00', '0.00', NULL, '0.00', '47422415.00', 2, 'paid', NULL, 1, 'delivered', NULL, 'Fugit autem dolores accusantium.', '2025-06-19 06:18:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-06-19 06:18:47', '2025-08-24 06:18:47', 'Marilie Waelchi', '(803) 521-9743', 'xblick@example.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(408, 14, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-68AB1C6975B1A', '15145567', 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', '0373607863', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', '0373607863', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', '17300000.00', '60000.00', '0.00', NULL, '0.00', '17360000.00', 5, 'paid', '{\"vnp_Amount\": \"1736000000\", \"vnp_TxnRef\": \"ORD-68AB1C6975B1A\", \"vnp_PayDate\": \"20250824210813\", \"vnp_TmnCode\": \"KUSIX1J4\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15145567\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15145567\", \"vnp_TransactionStatus\": \"00\"}', 2, 'processing', NULL, NULL, '2025-08-24 14:06:33', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-24 14:06:33', '2025-08-24 15:30:27', 'Nguyễn Tiến Thuận', '0373607863', 'nguyentienthuan4@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15145567', '20250824210813'),
(409, 14, 2, NULL, NULL, NULL, 'adad', NULL, NULL, 'ORD-68AB2F2ECA468', '15145697', 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', '0373607863', '34565, Phường Hoàn Kiếm, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', '0373607863', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', '69000000.00', '60000.00', '2000000.00', 'MOMO123', '0.00', '67060000.00', 5, 'paid', '{\"vnp_Amount\": \"6706000000\", \"vnp_TxnRef\": \"ORD-68AB2F2ECA468\", \"vnp_PayDate\": \"20250824222815\", \"vnp_TmnCode\": \"KUSIX1J4\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15145697\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15145697\", \"vnp_TransactionStatus\": \"00\"}', 2, 'delivered', 'ứdgf', NULL, '2025-08-24 15:26:38', NULL, NULL, '2025-08-24 15:37:47', NULL, NULL, NULL, 0, NULL, '2025-08-24 15:26:38', '2025-08-24 15:37:47', 'THuan', '0373607863', 'a@gmail.com', NULL, NULL, '21.04407243', '105.67408499', NULL, NULL, NULL, '15145697', '20250824222815'),
(410, 156, 2, NULL, NULL, NULL, 'da giao hang', NULL, NULL, 'ORD-68AC79520542D', '15148023', 'huy nguyễn', 'huy20079@gmail.com', '0373607863', '34565, Phường Hoàn Kiếm, Thành phố Hà Nội', 'huy nguyễn', 'huy20079@gmail.com', '0373607863', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', '35000000.00', '60000.00', '2000000.00', 'MOMO123', '0.00', '33060000.00', 5, 'paid', '{\"vnp_Amount\": \"3306000000\", \"vnp_TxnRef\": \"ORD-68AC79520542D\", \"vnp_PayDate\": \"20250825215649\", \"vnp_TmnCode\": \"KUSIX1J4\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15148023\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15148023\", \"vnp_TransactionStatus\": \"00\"}', 2, 'delivered', NULL, NULL, '2025-08-25 14:55:14', NULL, NULL, '2025-08-25 15:01:38', NULL, NULL, NULL, 0, NULL, '2025-08-25 14:55:14', '2025-08-25 15:01:38', 'THuan', '0373607863', 'a@gmail.com', NULL, NULL, '21.04408785', '105.67406525', NULL, NULL, NULL, '15148023', '20250825215649'),
(411, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-68AC82C11AFAA', NULL, 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', '0373607863', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', '0373607863', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', '26000000.00', '60000.00', '0.00', NULL, '0.00', '26060000.00', 1, 'pending', NULL, 2, 'cancelled', NULL, NULL, '2025-08-25 15:35:29', NULL, NULL, NULL, '2025-08-25 15:35:40', NULL, 'Thay đổi địa chỉ hoặc thông tin nhận hàng', 0, NULL, '2025-08-25 15:35:29', '2025-08-25 15:35:40', 'Nguyễn Tiến Thuận', '0373607863', 'nguyentienthuan4@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(412, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-68AC830614E9D', '15148113', 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', '0373607863', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', '0373607863', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', '16000000.00', '30000.00', '0.00', NULL, '0.00', '16030000.00', 5, 'paid', '{\"vnp_Amount\": \"1603000000\", \"vnp_TxnRef\": \"ORD-68AC830614E9D\", \"vnp_PayDate\": \"20250825223813\", \"vnp_TmnCode\": \"KUSIX1J4\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15148113\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15148113\", \"vnp_TransactionStatus\": \"00\"}', 1, 'cancelled', NULL, NULL, '2025-08-25 15:36:38', NULL, NULL, NULL, '2025-08-25 15:37:29', NULL, 'Customer cancelled - Refund processed', 0, NULL, '2025-08-25 15:36:38', '2025-08-25 15:37:29', 'Nguyễn Tiến Thuận', '0373607863', 'nguyentienthuan4@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15148113', '20250825223813'),
(413, 13, 2, NULL, NULL, NULL, 'a', NULL, NULL, 'ORD-68AC83B541F92', '15148123', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607867', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607867', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', '14000000.00', '30000.00', '0.00', NULL, '0.00', '14030000.00', 5, 'paid', '{\"vnp_Amount\": \"1403000000\", \"vnp_TxnRef\": \"ORD-68AC83B541F92\", \"vnp_PayDate\": \"20250825224123\", \"vnp_TmnCode\": \"KUSIX1J4\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15148123\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15148123\", \"vnp_TransactionStatus\": \"00\"}', 1, 'shipped', NULL, NULL, '2025-08-25 15:39:33', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-25 15:39:33', '2025-08-25 15:40:56', 'Nguyễn Tiến Thuận', '0373607867', 'b@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15148123', '20250825224123'),
(414, 156, 2, NULL, NULL, NULL, 'da giao hang', NULL, NULL, 'ORD-68AC87AED3A0F', '15148158', 'huy nguyễn', 'huy20079@gmail.com', '0373607863', '34565, Phường Cửa Nam, Thành phố Hà Nội', 'huy nguyễn', 'huy20079@gmail.com', '0373607863', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', '28000000.00', '60000.00', '2000000.00', 'MOMO123', '0.00', '26060000.00', 5, 'paid', '{\"vnp_Amount\": \"2606000000\", \"vnp_TxnRef\": \"ORD-68AC87AED3A0F\", \"vnp_PayDate\": \"20250825225803\", \"vnp_TmnCode\": \"KUSIX1J4\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15148158\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15148158\", \"vnp_TransactionStatus\": \"00\"}', 2, 'delivered', NULL, NULL, '2025-08-25 15:56:30', NULL, NULL, '2025-08-25 16:02:51', NULL, NULL, NULL, 0, NULL, '2025-08-25 15:56:30', '2025-08-25 16:02:51', 'THuan', '0373607863', 'a@gmail.com', NULL, NULL, '21.04415896', '105.67353821', NULL, NULL, NULL, '15148158', '20250825225803'),
(415, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ORD-68AC9662CFFC6', '15148263', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607867', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', 'Nguyễn Tiến Thuận', 'b@gmail.com', '0373607867', 'Số 1, Đường ABC, Ba Đình, Thành phố Hà Nội', '32000000.00', '60000.00', '2000000.00', 'MOMO123', '0.00', '30060000.00', 5, 'paid', '{\"vnp_Amount\": \"3006000000\", \"vnp_TxnRef\": \"ORD-68AC9662CFFC6\", \"vnp_PayDate\": \"20250826000047\", \"vnp_TmnCode\": \"KUSIX1J4\", \"vnp_BankCode\": \"NCB\", \"vnp_CardType\": \"ATM\", \"vnp_OrderInfo\": \"Thanh toán đơn hàng Funori\", \"vnp_BankTranNo\": \"VNP15148263\", \"vnp_ResponseCode\": \"00\", \"vnp_TransactionNo\": \"15148263\", \"vnp_TransactionStatus\": \"00\"}', 2, 'processing', NULL, NULL, '2025-08-25 16:59:14', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-08-25 16:59:14', '2025-08-25 16:59:37', 'Nguyễn Tiến Thuận', '0373607867', 'b@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15148263', '20250826000047');

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
(90, 48, 76, 124, 'Giường ngủ bọc vải Softly 1m8', NULL, 1, '26000000.00', '2025-08-01 05:44:02', '2025-08-01 05:44:02'),
(91, 49, 63, 106, 'Bàn ăn Kent FR160', NULL, 1, '12000000.00', '2025-08-23 01:40:30', '2025-08-23 01:40:30'),
(92, 49, 75, 122, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-23 01:40:30', '2025-08-23 01:40:30'),
(93, 49, 75, 123, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-23 01:40:30', '2025-08-23 01:40:30'),
(94, 49, 77, 127, 'Giường ngủ Wynn 1m8', NULL, 2, '64000000.00', '2025-08-23 01:40:30', '2025-08-23 01:40:30'),
(95, 50, 76, 124, 'Giường ngủ bọc vải Softly 1m8', NULL, 1, '26000000.00', '2025-08-23 02:09:34', '2025-08-23 02:09:34'),
(96, 51, 76, 124, 'Giường ngủ bọc vải Softly 1m8', NULL, 1, '26000000.00', '2025-08-23 08:47:48', '2025-08-23 08:47:48'),
(97, 52, 66, 109, 'Tủ Tivi Hùng King', NULL, 1, '24000000.00', '2025-08-23 09:02:07', '2025-08-23 09:02:07'),
(98, 53, 71, 115, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-23 09:05:45', '2025-08-23 09:05:45'),
(99, 54, 75, 122, 'Giường Ona Him 1m8', NULL, 2, '39999998.00', '2025-08-23 16:52:10', '2025-08-23 16:52:10'),
(100, 55, 66, 109, 'Tủ Tivi Hùng King', NULL, 1, '24000000.00', '2025-08-23 16:53:50', '2025-08-23 16:53:50'),
(101, 56, 65, 108, 'Bàn ăn Mây 10 chỗ', NULL, 1, '11000000.00', '2025-08-23 17:29:14', '2025-08-23 17:29:14'),
(102, 58, 47, NULL, 'Bàn nước mặt đá Ogami', NULL, 2, '26000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(103, 58, 31, NULL, 'Armchair Dark', NULL, 1, '7000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(104, 58, 67, NULL, 'Tủ TV mặt đá Ogami', NULL, 3, '45000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(105, 58, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(106, 59, 31, NULL, 'Armchair Dark', NULL, 1, '7000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(107, 60, 26, NULL, 'Sofa 3 chỗ BOLERO 2m2', NULL, 2, '44000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(108, 60, 47, NULL, 'Bàn nước mặt đá Ogami', NULL, 2, '26000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(109, 60, 27, NULL, 'Sofa 3 Chỗ NEST 2m8', NULL, 1, '35000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(110, 61, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 2, '26000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(111, 61, 26, NULL, 'Sofa 3 chỗ BOLERO 2m2', NULL, 1, '22000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(112, 62, 67, NULL, 'Tủ TV mặt đá Ogami', NULL, 1, '15000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(113, 62, 30, NULL, 'Sofa 3 Chỗ PENNY 2m4', NULL, 3, '72000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(114, 63, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 3, '39000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(115, 64, 32, NULL, 'Armchair dream', NULL, 3, '26100000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(116, 64, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(117, 64, 27, NULL, 'Sofa 3 Chỗ NEST 2m8', NULL, 3, '105000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(118, 65, 30, NULL, 'Sofa 3 Chỗ PENNY 2m4', NULL, 1, '24000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(119, 66, 27, NULL, 'Sofa 3 Chỗ NEST 2m8', NULL, 1, '35000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(120, 67, 68, NULL, 'Tủ tivi Valente', NULL, 3, '48000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(121, 67, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(122, 67, 30, NULL, 'Sofa 3 Chỗ PENNY 2m4', NULL, 2, '48000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(123, 68, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(124, 69, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(125, 69, 67, NULL, 'Tủ TV mặt đá Ogami', NULL, 1, '15000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(126, 70, 31, NULL, 'Armchair Dark', NULL, 2, '14000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(127, 70, 31, NULL, 'Armchair Dark', NULL, 1, '7000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(128, 70, 47, NULL, 'Bàn nước mặt đá Ogami', NULL, 1, '13000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(129, 71, 30, NULL, 'Sofa 3 Chỗ PENNY 2m4', NULL, 3, '72000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(130, 71, 31, NULL, 'Armchair Dark', NULL, 1, '7000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(131, 71, 27, NULL, 'Sofa 3 Chỗ NEST 2m8', NULL, 1, '35000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(132, 71, 68, NULL, 'Tủ tivi Valente', NULL, 3, '48000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(133, 72, 31, NULL, 'Armchair Dark', NULL, 2, '14000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(134, 73, 68, NULL, 'Tủ tivi Valente', NULL, 3, '48000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(135, 73, 67, NULL, 'Tủ TV mặt đá Ogami', NULL, 2, '30000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(136, 73, 26, NULL, 'Sofa 3 chỗ BOLERO 2m2', NULL, 1, '22000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(137, 73, 68, NULL, 'Tủ tivi Valente', NULL, 2, '32000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(138, 74, 68, NULL, 'Tủ tivi Valente', NULL, 1, '16000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(139, 74, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 1, '13000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(140, 74, 27, NULL, 'Sofa 3 Chỗ NEST 2m8', NULL, 2, '70000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(141, 75, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(142, 75, 30, NULL, 'Sofa 3 Chỗ PENNY 2m4', NULL, 3, '72000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(143, 75, 30, NULL, 'Sofa 3 Chỗ PENNY 2m4', NULL, 3, '72000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(144, 75, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(145, 76, 30, NULL, 'Sofa 3 Chỗ PENNY 2m4', NULL, 2, '48000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(146, 76, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(147, 76, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(148, 76, 26, NULL, 'Sofa 3 chỗ BOLERO 2m2', NULL, 3, '66000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(149, 77, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 1, '13000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(150, 77, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(151, 77, 30, NULL, 'Sofa 3 Chỗ PENNY 2m4', NULL, 3, '72000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(152, 77, 47, NULL, 'Bàn nước mặt đá Ogami', NULL, 1, '13000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(153, 78, 68, NULL, 'Tủ tivi Valente', NULL, 2, '32000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(154, 78, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 3, '39000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(155, 78, 26, NULL, 'Sofa 3 chỗ BOLERO 2m2', NULL, 1, '22000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(156, 79, 27, NULL, 'Sofa 3 Chỗ NEST 2m8', NULL, 2, '70000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(157, 79, 67, NULL, 'Tủ TV mặt đá Ogami', NULL, 2, '30000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(158, 80, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 3, '39000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(159, 80, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 2, '26000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(160, 80, 31, NULL, 'Armchair Dark', NULL, 3, '21000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(161, 81, 27, NULL, 'Sofa 3 Chỗ NEST 2m8', NULL, 2, '70000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(162, 82, 32, NULL, 'Armchair dream', NULL, 1, '8700000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(163, 82, 67, NULL, 'Tủ TV mặt đá Ogami', NULL, 3, '45000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(164, 82, 26, NULL, 'Sofa 3 chỗ BOLERO 2m2', NULL, 3, '66000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(165, 82, 30, NULL, 'Sofa 3 Chỗ PENNY 2m4', NULL, 1, '24000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(166, 83, 30, NULL, 'Sofa 3 Chỗ PENNY 2m4', NULL, 1, '24000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(167, 84, 47, NULL, 'Bàn nước mặt đá Ogami', NULL, 3, '39000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(168, 85, 31, NULL, 'Armchair Dark', NULL, 2, '14000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(169, 85, 67, NULL, 'Tủ TV mặt đá Ogami', NULL, 1, '15000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(170, 85, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(171, 86, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(172, 86, 32, NULL, 'Armchair dream', NULL, 3, '26100000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(173, 86, 32, NULL, 'Armchair dream', NULL, 3, '26100000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(174, 86, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(175, 87, 31, NULL, 'Armchair Dark', NULL, 3, '21000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(176, 87, 27, NULL, 'Sofa 3 Chỗ NEST 2m8', NULL, 1, '35000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(177, 87, 26, NULL, 'Sofa 3 chỗ BOLERO 2m2', NULL, 3, '66000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(178, 88, 30, NULL, 'Sofa 3 Chỗ PENNY 2m4', NULL, 1, '24000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(179, 88, 32, NULL, 'Armchair dream', NULL, 1, '8700000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(180, 88, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 3, '39000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(181, 89, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(182, 89, 26, NULL, 'Sofa 3 chỗ BOLERO 2m2', NULL, 1, '22000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(183, 89, 26, NULL, 'Sofa 3 chỗ BOLERO 2m2', NULL, 3, '66000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(184, 89, 68, NULL, 'Tủ tivi Valente', NULL, 1, '16000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(185, 90, 27, NULL, 'Sofa 3 Chỗ NEST 2m8', NULL, 3, '105000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(186, 90, 30, NULL, 'Sofa 3 Chỗ PENNY 2m4', NULL, 2, '48000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(187, 91, 67, NULL, 'Tủ TV mặt đá Ogami', NULL, 3, '45000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(188, 92, 68, NULL, 'Tủ tivi Valente', NULL, 3, '48000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(189, 92, 47, NULL, 'Bàn nước mặt đá Ogami', NULL, 1, '13000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(190, 92, 26, NULL, 'Sofa 3 chỗ BOLERO 2m2', NULL, 2, '44000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(191, 93, 67, NULL, 'Tủ TV mặt đá Ogami', NULL, 1, '15000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(192, 93, 67, NULL, 'Tủ TV mặt đá Ogami', NULL, 3, '45000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(193, 93, 26, NULL, 'Sofa 3 chỗ BOLERO 2m2', NULL, 3, '66000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(194, 93, 67, NULL, 'Tủ TV mặt đá Ogami', NULL, 3, '45000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(195, 94, 30, NULL, 'Sofa 3 Chỗ PENNY 2m4', NULL, 3, '72000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(196, 95, 31, NULL, 'Armchair Dark', NULL, 3, '21000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(197, 95, 26, NULL, 'Sofa 3 chỗ BOLERO 2m2', NULL, 2, '44000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(198, 95, 67, NULL, 'Tủ TV mặt đá Ogami', NULL, 2, '30000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(199, 96, 31, NULL, 'Armchair Dark', NULL, 3, '21000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(200, 96, 67, NULL, 'Tủ TV mặt đá Ogami', NULL, 1, '15000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(201, 96, 68, NULL, 'Tủ tivi Valente', NULL, 2, '32000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(202, 96, 27, NULL, 'Sofa 3 Chỗ NEST 2m8', NULL, 2, '70000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(203, 97, 31, NULL, 'Armchair Dark', NULL, 3, '21000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(204, 97, 31, NULL, 'Armchair Dark', NULL, 1, '7000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(205, 97, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 3, '39000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(206, 97, 26, NULL, 'Sofa 3 chỗ BOLERO 2m2', NULL, 1, '22000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(207, 98, 27, NULL, 'Sofa 3 Chỗ NEST 2m8', NULL, 3, '105000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(208, 98, 30, NULL, 'Sofa 3 Chỗ PENNY 2m4', NULL, 2, '48000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(209, 98, 67, NULL, 'Tủ TV mặt đá Ogami', NULL, 3, '45000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(210, 99, 31, NULL, 'Armchair Dark', NULL, 1, '7000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(211, 99, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 3, '39000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(212, 99, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(213, 100, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(214, 101, 30, NULL, 'Sofa 3 Chỗ PENNY 2m4', NULL, 1, '24000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(215, 101, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(216, 101, 47, NULL, 'Bàn nước mặt đá Ogami', NULL, 2, '26000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(217, 101, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(218, 102, 68, NULL, 'Tủ tivi Valente', NULL, 2, '32000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(219, 102, 67, NULL, 'Tủ TV mặt đá Ogami', NULL, 1, '15000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(220, 102, 47, NULL, 'Bàn nước mặt đá Ogami', NULL, 1, '13000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(221, 102, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(222, 103, 30, NULL, 'Sofa 3 Chỗ PENNY 2m4', NULL, 1, '24000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(223, 104, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 1, '13000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(224, 104, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(225, 105, 68, NULL, 'Tủ tivi Valente', NULL, 2, '32000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(226, 105, 32, NULL, 'Armchair dream', NULL, 3, '26100000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(227, 106, 47, NULL, 'Bàn nước mặt đá Ogami', NULL, 2, '26000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(228, 107, 31, NULL, 'Armchair Dark', NULL, 3, '21000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(229, 107, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(230, 107, 26, NULL, 'Sofa 3 chỗ BOLERO 2m2', NULL, 1, '22000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(231, 107, 47, NULL, 'Bàn nước mặt đá Ogami', NULL, 3, '39000000.00', '2025-08-24 04:54:48', '2025-08-24 04:54:48'),
(232, 108, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(233, 109, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 2, '17000000.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(234, 109, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(235, 109, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 2, '17400000.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(236, 110, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 2, '17000000.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(237, 111, 34, NULL, 'Armchair xoay Iris', NULL, 3, '35999999.97', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(238, 112, 31, NULL, 'Armchair Dark', NULL, 1, '7000000.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(239, 112, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 1, '8500000.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(240, 113, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(241, 114, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(242, 114, 31, NULL, 'Armchair Dark', NULL, 2, '14000000.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(243, 115, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 3, '26100000.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(244, 115, 31, NULL, 'Armchair Dark', NULL, 1, '7000000.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(245, 115, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 2, '17400000.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(246, 116, 31, NULL, 'Armchair Dark', NULL, 3, '21000000.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(247, 116, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 3, '72000000.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(248, 116, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 2, '17000000.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(249, 117, 31, NULL, 'Armchair Dark', NULL, 1, '7000000.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(250, 117, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 1, '24000000.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(251, 117, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:27', '2025-08-24 04:58:27'),
(252, 118, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 2, '17000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(253, 118, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(254, 119, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(255, 119, 34, NULL, 'Armchair xoay Iris', NULL, 2, '23999999.98', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(256, 119, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(257, 119, 44, NULL, 'Bàn bên Rise Walnut', NULL, 1, '6999999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(258, 120, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(259, 120, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(260, 120, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 2, '17400000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(261, 121, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(262, 121, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 1, '8500000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(263, 122, 75, NULL, 'Giường Ona Him 1m8', NULL, 2, '39999998.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(264, 122, 71, NULL, 'Tủ tivi Bridge', NULL, 3, '56999997.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(265, 123, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 2, '48000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(266, 123, 31, NULL, 'Armchair Dark', NULL, 2, '14000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(267, 123, 31, NULL, 'Armchair Dark', NULL, 3, '21000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(268, 123, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(269, 124, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 3, '26100000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(270, 124, 75, NULL, 'Giường Ona Him 1m8', NULL, 3, '59999997.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(271, 125, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 3, '26100000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(272, 125, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(273, 125, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 2, '48000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(274, 125, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 2, '17400000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(275, 126, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 3, '26100000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(276, 127, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(277, 127, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(278, 128, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(279, 128, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(280, 128, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(281, 129, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 3, '26100000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(282, 129, 54, NULL, 'Ghế ăn Moretti', NULL, 1, '9699999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(283, 129, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 2, '17400000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(284, 130, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 2, '17000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(285, 130, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(286, 131, 71, NULL, 'Tủ tivi Bridge', NULL, 3, '56999997.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(287, 131, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(288, 131, 44, NULL, 'Bàn bên Rise Walnut', NULL, 1, '6999999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(289, 131, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(290, 132, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 3, '72000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(291, 132, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(292, 133, 34, NULL, 'Armchair xoay Iris', NULL, 1, '11999999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(293, 133, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 2, '17000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(294, 133, 34, NULL, 'Armchair xoay Iris', NULL, 1, '11999999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(295, 133, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 1, '24000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(296, 134, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(297, 135, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(298, 136, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 1, '8700000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(299, 136, 54, NULL, 'Ghế ăn Moretti', NULL, 2, '19399999.98', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(300, 136, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(301, 137, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(302, 138, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 1, '24000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(303, 138, 31, NULL, 'Armchair Dark', NULL, 3, '21000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(304, 138, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(305, 139, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(306, 140, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 2, '17400000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(307, 140, 54, NULL, 'Ghế ăn Moretti', NULL, 1, '9699999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(308, 140, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(309, 141, 71, NULL, 'Tủ tivi Bridge', NULL, 3, '56999997.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(310, 141, 54, NULL, 'Ghế ăn Moretti', NULL, 1, '9699999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(311, 141, 31, NULL, 'Armchair Dark', NULL, 1, '7000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(312, 141, 44, NULL, 'Bàn bên Rise Walnut', NULL, 3, '20999999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(313, 142, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(314, 143, 44, NULL, 'Bàn bên Rise Walnut', NULL, 1, '6999999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(315, 143, 34, NULL, 'Armchair xoay Iris', NULL, 2, '23999999.98', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(316, 143, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 2, '17000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(317, 143, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(318, 144, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 3, '25500000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(319, 144, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(320, 144, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 3, '72000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(321, 144, 54, NULL, 'Ghế ăn Moretti', NULL, 1, '9699999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(322, 145, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(323, 145, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(324, 145, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 3, '25500000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(325, 145, 31, NULL, 'Armchair Dark', NULL, 1, '7000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(326, 146, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 1, '8700000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(327, 146, 75, NULL, 'Giường Ona Him 1m8', NULL, 2, '39999998.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(328, 146, 54, NULL, 'Ghế ăn Moretti', NULL, 1, '9699999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(329, 146, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(330, 147, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(331, 148, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 2, '17400000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(332, 148, 31, NULL, 'Armchair Dark', NULL, 3, '21000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(333, 149, 31, NULL, 'Armchair Dark', NULL, 1, '7000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(334, 149, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 1, '24000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(335, 149, 54, NULL, 'Ghế ăn Moretti', NULL, 1, '9699999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(336, 150, 34, NULL, 'Armchair xoay Iris', NULL, 3, '35999999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(337, 150, 75, NULL, 'Giường Ona Him 1m8', NULL, 2, '39999998.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(338, 150, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(339, 150, 31, NULL, 'Armchair Dark', NULL, 3, '21000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(340, 151, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(341, 152, 44, NULL, 'Bàn bên Rise Walnut', NULL, 1, '6999999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(342, 152, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 3, '26100000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(343, 152, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(344, 153, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(345, 153, 44, NULL, 'Bàn bên Rise Walnut', NULL, 3, '20999999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(346, 154, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(347, 155, 71, NULL, 'Tủ tivi Bridge', NULL, 3, '56999997.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(348, 155, 44, NULL, 'Bàn bên Rise Walnut', NULL, 3, '20999999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(349, 155, 34, NULL, 'Armchair xoay Iris', NULL, 1, '11999999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(350, 156, 44, NULL, 'Bàn bên Rise Walnut', NULL, 1, '6999999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(351, 157, 54, NULL, 'Ghế ăn Moretti', NULL, 3, '29099999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(352, 157, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 3, '72000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(353, 158, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(354, 159, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(355, 159, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(356, 160, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(357, 161, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 2, '48000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(358, 161, 31, NULL, 'Armchair Dark', NULL, 1, '7000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(359, 161, 34, NULL, 'Armchair xoay Iris', NULL, 1, '11999999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(360, 161, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 1, '24000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(361, 162, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 3, '26100000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(362, 162, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 2, '17000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(363, 163, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(364, 163, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 2, '17400000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(365, 163, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(366, 163, 31, NULL, 'Armchair Dark', NULL, 1, '7000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(367, 164, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(368, 164, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(369, 164, 31, NULL, 'Armchair Dark', NULL, 3, '21000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(370, 164, 71, NULL, 'Tủ tivi Bridge', NULL, 3, '56999997.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(371, 165, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(372, 165, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(373, 165, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(374, 166, 71, NULL, 'Tủ tivi Bridge', NULL, 3, '56999997.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(375, 166, 54, NULL, 'Ghế ăn Moretti', NULL, 3, '29099999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(376, 167, 44, NULL, 'Bàn bên Rise Walnut', NULL, 3, '20999999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(377, 167, 54, NULL, 'Ghế ăn Moretti', NULL, 1, '9699999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(378, 168, 44, NULL, 'Bàn bên Rise Walnut', NULL, 3, '20999999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(379, 168, 44, NULL, 'Bàn bên Rise Walnut', NULL, 1, '6999999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(380, 168, 44, NULL, 'Bàn bên Rise Walnut', NULL, 3, '20999999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(381, 169, 31, NULL, 'Armchair Dark', NULL, 3, '21000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(382, 169, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 2, '48000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(383, 169, 34, NULL, 'Armchair xoay Iris', NULL, 3, '35999999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(384, 170, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(385, 171, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(386, 172, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(387, 172, 54, NULL, 'Ghế ăn Moretti', NULL, 1, '9699999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(388, 173, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(389, 173, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 3, '25500000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(390, 173, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 1, '8700000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(391, 173, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 1, '8700000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(392, 174, 75, NULL, 'Giường Ona Him 1m8', NULL, 3, '59999997.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(393, 174, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(394, 174, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 1, '8700000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(395, 175, 34, NULL, 'Armchair xoay Iris', NULL, 2, '23999999.98', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(396, 175, 54, NULL, 'Ghế ăn Moretti', NULL, 3, '29099999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(397, 175, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 2, '17000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(398, 176, 34, NULL, 'Armchair xoay Iris', NULL, 1, '11999999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(399, 176, 71, NULL, 'Tủ tivi Bridge', NULL, 3, '56999997.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(400, 177, 34, NULL, 'Armchair xoay Iris', NULL, 3, '35999999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(401, 177, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 3, '72000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(402, 177, 31, NULL, 'Armchair Dark', NULL, 2, '14000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(403, 177, 31, NULL, 'Armchair Dark', NULL, 1, '7000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(404, 178, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(405, 178, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(406, 178, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 2, '48000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(407, 178, 54, NULL, 'Ghế ăn Moretti', NULL, 3, '29099999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(408, 179, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(409, 179, 31, NULL, 'Armchair Dark', NULL, 1, '7000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(410, 179, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(411, 180, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(412, 180, 75, NULL, 'Giường Ona Him 1m8', NULL, 3, '59999997.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(413, 181, 75, NULL, 'Giường Ona Him 1m8', NULL, 3, '59999997.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(414, 181, 71, NULL, 'Tủ tivi Bridge', NULL, 3, '56999997.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(415, 182, 44, NULL, 'Bàn bên Rise Walnut', NULL, 3, '20999999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(416, 183, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 1, '24000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(417, 183, 71, NULL, 'Tủ tivi Bridge', NULL, 3, '56999997.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(418, 184, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 2, '17000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(419, 185, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 2, '17400000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(420, 186, 54, NULL, 'Ghế ăn Moretti', NULL, 3, '29099999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(421, 186, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(422, 186, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 2, '48000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(423, 186, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(424, 187, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 2, '17400000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(425, 187, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(426, 188, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(427, 188, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 3, '72000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(428, 188, 75, NULL, 'Giường Ona Him 1m8', NULL, 3, '59999997.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(429, 188, 54, NULL, 'Ghế ăn Moretti', NULL, 1, '9699999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(430, 189, 75, NULL, 'Giường Ona Him 1m8', NULL, 3, '59999997.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(431, 189, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(432, 189, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 1, '8700000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(433, 189, 34, NULL, 'Armchair xoay Iris', NULL, 1, '11999999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(434, 190, 75, NULL, 'Giường Ona Him 1m8', NULL, 2, '39999998.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(435, 190, 34, NULL, 'Armchair xoay Iris', NULL, 3, '35999999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(436, 190, 31, NULL, 'Armchair Dark', NULL, 2, '14000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(437, 191, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(438, 191, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 2, '17400000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(439, 191, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(440, 192, 44, NULL, 'Bàn bên Rise Walnut', NULL, 3, '20999999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(441, 193, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(442, 194, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 3, '25500000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(443, 194, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 1, '8500000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(444, 195, 34, NULL, 'Armchair xoay Iris', NULL, 2, '23999999.98', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(445, 195, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 3, '72000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(446, 195, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(447, 195, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(448, 196, 34, NULL, 'Armchair xoay Iris', NULL, 3, '35999999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(449, 196, 44, NULL, 'Bàn bên Rise Walnut', NULL, 3, '20999999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(450, 196, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 3, '26100000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(451, 197, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 2, '17400000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(452, 197, 34, NULL, 'Armchair xoay Iris', NULL, 1, '11999999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(453, 197, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 2, '17000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(454, 197, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(455, 198, 54, NULL, 'Ghế ăn Moretti', NULL, 3, '29099999.97', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(456, 198, 34, NULL, 'Armchair xoay Iris', NULL, 1, '11999999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(457, 198, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 2, '17400000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(458, 198, 75, NULL, 'Giường Ona Him 1m8', NULL, 2, '39999998.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(459, 199, 34, NULL, 'Armchair xoay Iris', NULL, 1, '11999999.99', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(460, 199, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 3, '72000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(461, 199, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(462, 199, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 1, '8500000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(463, 200, 40, NULL, 'Đôn con công cherry 32cm 86354K', NULL, 2, '48000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(464, 201, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(465, 201, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 1, '8500000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(466, 201, 31, NULL, 'Armchair Dark', NULL, 3, '21000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(467, 202, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(468, 203, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(469, 203, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 1, '8500000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(470, 204, 31, NULL, 'Armchair Dark', NULL, 1, '7000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(471, 204, 55, NULL, 'Ghế ăn TAURA Eponji', NULL, 2, '17000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(472, 204, 31, NULL, 'Armchair Dark', NULL, 2, '14000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(473, 204, 31, NULL, 'Armchair Dark', NULL, 1, '7000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(474, 205, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(475, 206, 75, NULL, 'Giường Ona Him 1m8', NULL, 1, '19999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(476, 206, 22, NULL, 'Sofa 2 Chỗ HÀ NỘI 1m8', NULL, 2, '17400000.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(477, 207, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 04:58:28', '2025-08-24 04:58:28'),
(478, 208, 46, NULL, 'Bàn nước Hùng King', NULL, 1, '15999999.99', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(479, 208, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(480, 208, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 3, '25500000.03', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(481, 209, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 3, '18000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(482, 209, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 2, '32000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(483, 209, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 2, '64000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(484, 210, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 3, '25500000.03', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(485, 210, 43, NULL, 'Bàn bên Endless Vegas', NULL, 1, '11000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(486, 210, 38, NULL, 'Đôn dream vuông', NULL, 1, '9900000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(487, 210, 38, NULL, 'Đôn dream vuông', NULL, 2, '19800000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(488, 211, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 3, '96000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(489, 211, 43, NULL, 'Bàn bên Endless Vegas', NULL, 1, '11000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(490, 211, 43, NULL, 'Bàn bên Endless Vegas', NULL, 1, '11000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(491, 211, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 2, '12000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(492, 212, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 1, '6000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(493, 213, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(494, 213, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 1, '32000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(495, 214, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 2, '64000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(496, 214, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 2, '32000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(497, 214, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 2, '32000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(498, 215, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 2, '64000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(499, 215, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 3, '42000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(500, 215, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 3, '25500000.03', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(501, 216, 38, NULL, 'Đôn dream vuông', NULL, 3, '29700000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_variant_id`, `product_name`, `variant_attributes`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
(502, 216, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 3, '25500000.03', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(503, 216, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 2, '32000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(504, 217, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 3, '42000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(505, 217, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 3, '96000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(506, 218, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 2, '64000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(507, 218, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 1, '14000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(508, 218, 38, NULL, 'Đôn dream vuông', NULL, 3, '29700000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(509, 218, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 3, '48000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(510, 219, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 1, '8500000.01', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(511, 220, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 2, '12000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(512, 221, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 2, '64000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(513, 221, 46, NULL, 'Bàn nước Hùng King', NULL, 3, '47999999.97', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(514, 221, 43, NULL, 'Bàn bên Endless Vegas', NULL, 2, '22000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(515, 222, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 3, '42000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(516, 223, 43, NULL, 'Bàn bên Endless Vegas', NULL, 1, '11000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(517, 223, 43, NULL, 'Bàn bên Endless Vegas', NULL, 3, '33000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(518, 223, 38, NULL, 'Đôn dream vuông', NULL, 1, '9900000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(519, 224, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 3, '96000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(520, 225, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 2, '64000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(521, 225, 46, NULL, 'Bàn nước Hùng King', NULL, 1, '15999999.99', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(522, 225, 46, NULL, 'Bàn nước Hùng King', NULL, 2, '31999999.98', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(523, 226, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 1, '8500000.01', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(524, 226, 43, NULL, 'Bàn bên Endless Vegas', NULL, 1, '11000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(525, 226, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 2, '28000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(526, 226, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 2, '12000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(527, 227, 43, NULL, 'Bàn bên Endless Vegas', NULL, 1, '11000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(528, 227, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 1, '14000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(529, 227, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 1, '6000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(530, 227, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 2, '28000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(531, 228, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 1, '32000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(532, 228, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(533, 229, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 3, '48000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(534, 229, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 2, '12000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(535, 229, 38, NULL, 'Đôn dream vuông', NULL, 3, '29700000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(536, 230, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 2, '64000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(537, 230, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 2, '17000000.02', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(538, 230, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 1, '6000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(539, 230, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 1, '14000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(540, 231, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 2, '64000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(541, 232, 46, NULL, 'Bàn nước Hùng King', NULL, 3, '47999999.97', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(542, 232, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(543, 233, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 3, '42000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(544, 233, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 3, '96000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(545, 233, 43, NULL, 'Bàn bên Endless Vegas', NULL, 3, '33000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(546, 234, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 2, '28000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(547, 234, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 2, '28000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(548, 234, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 2, '12000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(549, 234, 43, NULL, 'Bàn bên Endless Vegas', NULL, 3, '33000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(550, 235, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 3, '18000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(551, 235, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 2, '12000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(552, 236, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 2, '28000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(553, 237, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 1, '16000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(554, 238, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 2, '64000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(555, 239, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 1, '6000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(556, 239, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 3, '48000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(557, 239, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 1, '32000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(558, 239, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 1, '14000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(559, 240, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 3, '96000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(560, 240, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 3, '96000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(561, 240, 38, NULL, 'Đôn dream vuông', NULL, 2, '19800000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(562, 240, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 1, '16000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(563, 241, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 3, '48000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(564, 241, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 3, '42000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(565, 241, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 1, '6000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(566, 242, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 2, '12000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(567, 242, 43, NULL, 'Bàn bên Endless Vegas', NULL, 1, '11000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(568, 242, 38, NULL, 'Đôn dream vuông', NULL, 2, '19800000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(569, 242, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 1, '6000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(570, 243, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 2, '64000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(571, 243, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 3, '18000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(572, 243, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 3, '96000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(573, 243, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 3, '25500000.03', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(574, 244, 74, NULL, 'Giường Leman 1m82', NULL, 3, '51000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(575, 244, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 1, '8500000.01', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(576, 244, 46, NULL, 'Bàn nước Hùng King', NULL, 2, '31999999.98', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(577, 244, 38, NULL, 'Đôn dream vuông', NULL, 3, '29700000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(578, 245, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 3, '25500000.03', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(579, 245, 43, NULL, 'Bàn bên Endless Vegas', NULL, 2, '22000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(580, 245, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 1, '16000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(581, 246, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 3, '48000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(582, 246, 38, NULL, 'Đôn dream vuông', NULL, 2, '19800000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(583, 246, 43, NULL, 'Bàn bên Endless Vegas', NULL, 1, '11000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(584, 247, 38, NULL, 'Đôn dream vuông', NULL, 3, '29700000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(585, 247, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 1, '8500000.01', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(586, 247, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 3, '48000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(587, 247, 43, NULL, 'Bàn bên Endless Vegas', NULL, 1, '11000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(588, 248, 46, NULL, 'Bàn nước Hùng King', NULL, 1, '15999999.99', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(589, 248, 46, NULL, 'Bàn nước Hùng King', NULL, 2, '31999999.98', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(590, 249, 43, NULL, 'Bàn bên Endless Vegas', NULL, 1, '11000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(591, 249, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 1, '32000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(592, 249, 43, NULL, 'Bàn bên Endless Vegas', NULL, 1, '11000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(593, 250, 43, NULL, 'Bàn bên Endless Vegas', NULL, 3, '33000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(594, 250, 38, NULL, 'Đôn dream vuông', NULL, 3, '29700000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(595, 251, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 3, '96000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(596, 251, 74, NULL, 'Giường Leman 1m82', NULL, 3, '51000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(597, 251, 43, NULL, 'Bàn bên Endless Vegas', NULL, 3, '33000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(598, 251, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 1, '16000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(599, 252, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 1, '14000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(600, 252, 74, NULL, 'Giường Leman 1m82', NULL, 3, '51000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(601, 252, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 3, '48000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(602, 252, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 3, '25500000.03', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(603, 253, 43, NULL, 'Bàn bên Endless Vegas', NULL, 2, '22000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(604, 253, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 1, '32000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(605, 253, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 2, '64000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(606, 253, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 2, '12000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(607, 254, 43, NULL, 'Bàn bên Endless Vegas', NULL, 1, '11000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(608, 254, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 1, '16000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(609, 254, 43, NULL, 'Bàn bên Endless Vegas', NULL, 3, '33000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(610, 255, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 2, '12000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(611, 255, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 3, '42000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(612, 256, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 1, '14000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(613, 256, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 2, '32000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(614, 256, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 2, '12000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(615, 256, 38, NULL, 'Đôn dream vuông', NULL, 3, '29700000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(616, 257, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 1, '14000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(617, 257, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 1, '8500000.01', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(618, 257, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 3, '18000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(619, 258, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 2, '64000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(620, 258, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 2, '28000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(621, 259, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 3, '42000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(622, 259, 46, NULL, 'Bàn nước Hùng King', NULL, 3, '47999999.97', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(623, 260, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 2, '64000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(624, 260, 38, NULL, 'Đôn dream vuông', NULL, 1, '9900000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(625, 260, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 1, '16000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(626, 260, 43, NULL, 'Bàn bên Endless Vegas', NULL, 3, '33000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(627, 261, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 1, '32000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(628, 262, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 2, '17000000.02', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(629, 262, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 3, '96000000.00', '2025-08-24 06:17:07', '2025-08-24 06:17:07'),
(630, 262, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 3, '18000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(631, 262, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 2, '28000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(632, 263, 43, NULL, 'Bàn bên Endless Vegas', NULL, 1, '11000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(633, 263, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 2, '64000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(634, 263, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 3, '18000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(635, 264, 46, NULL, 'Bàn nước Hùng King', NULL, 3, '47999999.97', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(636, 264, 74, NULL, 'Giường Leman 1m82', NULL, 3, '51000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(637, 264, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 1, '32000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(638, 265, 43, NULL, 'Bàn bên Endless Vegas', NULL, 1, '11000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(639, 265, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 2, '32000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(640, 265, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 1, '16000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(641, 266, 43, NULL, 'Bàn bên Endless Vegas', NULL, 2, '22000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(642, 266, 74, NULL, 'Giường Leman 1m82', NULL, 3, '51000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(643, 266, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 2, '32000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(644, 267, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 3, '48000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(645, 267, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 1, '8500000.01', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(646, 267, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(647, 268, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 3, '96000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(648, 268, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 3, '25500000.03', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(649, 268, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 1, '6000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(650, 268, 43, NULL, 'Bàn bên Endless Vegas', NULL, 3, '33000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(651, 269, 43, NULL, 'Bàn bên Endless Vegas', NULL, 3, '33000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(652, 270, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 1, '6000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(653, 270, 46, NULL, 'Bàn nước Hùng King', NULL, 1, '15999999.99', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(654, 270, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 1, '32000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(655, 271, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 1, '16000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(656, 271, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(657, 272, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 2, '32000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(658, 272, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 3, '48000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(659, 273, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 1, '14000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(660, 274, 38, NULL, 'Đôn dream vuông', NULL, 3, '29700000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(661, 274, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 3, '96000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(662, 274, 46, NULL, 'Bàn nước Hùng King', NULL, 2, '31999999.98', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(663, 275, 43, NULL, 'Bàn bên Endless Vegas', NULL, 2, '22000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(664, 276, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 3, '42000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(665, 276, 46, NULL, 'Bàn nước Hùng King', NULL, 2, '31999999.98', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(666, 276, 38, NULL, 'Đôn dream vuông', NULL, 1, '9900000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(667, 276, 38, NULL, 'Đôn dream vuông', NULL, 1, '9900000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(668, 277, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 1, '14000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(669, 277, 46, NULL, 'Bàn nước Hùng King', NULL, 1, '15999999.99', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(670, 277, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 2, '32000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(671, 278, 46, NULL, 'Bàn nước Hùng King', NULL, 2, '31999999.98', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(672, 278, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 3, '48000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(673, 278, 74, NULL, 'Giường Leman 1m82', NULL, 1, '17000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(674, 278, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 2, '17000000.02', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(675, 279, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 3, '18000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(676, 280, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 3, '48000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(677, 281, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 3, '96000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(678, 281, 74, NULL, 'Giường Leman 1m82', NULL, 3, '51000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(679, 282, 38, NULL, 'Đôn dream vuông', NULL, 3, '29700000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(680, 282, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 3, '42000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(681, 282, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 3, '96000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(682, 282, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 3, '96000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(683, 283, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 3, '96000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(684, 283, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 3, '18000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(685, 284, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 2, '17000000.02', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(686, 284, 46, NULL, 'Bàn nước Hùng King', NULL, 2, '31999999.98', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(687, 284, 43, NULL, 'Bàn bên Endless Vegas', NULL, 2, '22000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(688, 285, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 3, '96000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(689, 285, 38, NULL, 'Đôn dream vuông', NULL, 3, '29700000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(690, 286, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 1, '6000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(691, 286, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 3, '18000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(692, 286, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 1, '32000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(693, 287, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 1, '16000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(694, 287, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 2, '28000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(695, 287, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 3, '25500000.03', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(696, 288, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 2, '28000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(697, 288, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(698, 288, 38, NULL, 'Đôn dream vuông', NULL, 1, '9900000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(699, 289, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 3, '96000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(700, 289, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 3, '18000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(701, 289, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(702, 289, 46, NULL, 'Bàn nước Hùng King', NULL, 3, '47999999.97', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(703, 290, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 2, '17000000.02', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(704, 290, 46, NULL, 'Bàn nước Hùng King', NULL, 3, '47999999.97', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(705, 291, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 1, '32000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(706, 291, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 3, '96000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(707, 291, 46, NULL, 'Bàn nước Hùng King', NULL, 3, '47999999.97', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(708, 291, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 3, '25500000.03', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(709, 292, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 2, '64000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(710, 292, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 2, '32000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(711, 292, 46, NULL, 'Bàn nước Hùng King', NULL, 1, '15999999.99', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(712, 292, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 3, '25500000.03', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(713, 293, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 2, '64000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(714, 293, 74, NULL, 'Giường Leman 1m82', NULL, 1, '17000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(715, 293, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 1, '8500000.01', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(716, 294, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(717, 295, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 1, '6000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(718, 296, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(719, 296, 74, NULL, 'Giường Leman 1m82', NULL, 3, '51000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(720, 296, 38, NULL, 'Đôn dream vuông', NULL, 3, '29700000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(721, 297, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 2, '64000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(722, 297, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 3, '96000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(723, 298, 38, NULL, 'Đôn dream vuông', NULL, 2, '19800000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(724, 298, 38, NULL, 'Đôn dream vuông', NULL, 3, '29700000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(725, 299, 46, NULL, 'Bàn nước Hùng King', NULL, 1, '15999999.99', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(726, 299, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 2, '64000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(727, 299, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 1, '32000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(728, 300, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 3, '48000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(729, 300, 46, NULL, 'Bàn nước Hùng King', NULL, 1, '15999999.99', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(730, 300, 74, NULL, 'Giường Leman 1m82', NULL, 1, '17000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(731, 301, 39, NULL, 'Đôn Cherry jungle tiger', NULL, 3, '48000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(732, 301, 43, NULL, 'Bàn bên Endless Vegas', NULL, 1, '11000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(733, 301, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 1, '8500000.01', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(734, 301, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 3, '96000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(735, 302, 58, NULL, 'Bàn ăn 8 chỗ Moretti', NULL, 3, '25500000.03', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(736, 303, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 2, '12000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(737, 303, 29, NULL, 'Sofa 3 Chỗ CABO 2m2', NULL, 1, '32000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(738, 304, 46, NULL, 'Bàn nước Hùng King', NULL, 3, '47999999.97', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(739, 305, 46, NULL, 'Bàn nước Hùng King', NULL, 2, '31999999.98', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(740, 305, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(741, 306, 42, NULL, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 1, '14000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(742, 306, 77, NULL, 'Giường ngủ Wynn 1m8', NULL, 1, '32000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(743, 306, 46, NULL, 'Bàn nước Hùng King', NULL, 2, '31999999.98', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(744, 307, 46, NULL, 'Bàn nước Hùng King', NULL, 2, '31999999.98', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(745, 307, 51, NULL, 'Ghế ăn Bolero ACC001', NULL, 2, '12000000.00', '2025-08-24 06:17:08', '2025-08-24 06:17:08'),
(746, 308, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 3, '45000000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(747, 308, 54, NULL, 'Ghế ăn Moretti', NULL, 2, '19399999.98', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(748, 309, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 2, '26000000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(749, 309, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 3, '45000000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(750, 309, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(751, 309, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(752, 310, 54, NULL, 'Ghế ăn Moretti', NULL, 3, '29099999.97', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(753, 310, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(754, 310, 44, NULL, 'Bàn bên Rise Walnut', NULL, 1, '6999999.99', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(755, 310, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(756, 311, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(757, 311, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 2, '30000000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(758, 311, 54, NULL, 'Ghế ăn Moretti', NULL, 3, '29099999.97', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(759, 312, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(760, 312, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(761, 313, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 3, '51900000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(762, 313, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(763, 313, 32, NULL, 'Armchair dream', NULL, 1, '8700000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(764, 314, 32, NULL, 'Armchair dream', NULL, 3, '26100000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(765, 315, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 2, '26000000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(766, 315, 32, NULL, 'Armchair dream', NULL, 3, '26100000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(767, 315, 44, NULL, 'Bàn bên Rise Walnut', NULL, 1, '6999999.99', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(768, 315, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(769, 316, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 2, '30000000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(770, 317, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 3, '108000000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(771, 317, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(772, 317, 44, NULL, 'Bàn bên Rise Walnut', NULL, 1, '6999999.99', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(773, 318, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 1, '36000000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(774, 318, 44, NULL, 'Bàn bên Rise Walnut', NULL, 1, '6999999.99', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(775, 318, 74, NULL, 'Giường Leman 1m82', NULL, 3, '51000000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(776, 319, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 3, '108000000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(777, 319, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(778, 319, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(779, 319, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(780, 320, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 3, '45000000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(781, 320, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(782, 320, 32, NULL, 'Armchair dream', NULL, 3, '26100000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(783, 321, 71, NULL, 'Tủ tivi Bridge', NULL, 3, '56999997.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(784, 321, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(785, 321, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:18:46', '2025-08-24 06:18:46'),
(786, 321, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(787, 322, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(788, 323, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 1, '17300000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(789, 323, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 1, '13000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(790, 323, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 1, '17300000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(791, 324, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 1, '36000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(792, 324, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(793, 325, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 1, '36000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(794, 325, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 2, '72000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(795, 325, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 3, '51900000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(796, 325, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(797, 326, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(798, 327, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(799, 327, 32, NULL, 'Armchair dream', NULL, 1, '8700000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(800, 327, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(801, 328, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 1, '17300000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(802, 328, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 3, '39000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(803, 328, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 1, '13000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(804, 328, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(805, 329, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 1, '36000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(806, 330, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(807, 330, 54, NULL, 'Ghế ăn Moretti', NULL, 3, '29099999.97', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(808, 330, 32, NULL, 'Armchair dream', NULL, 1, '8700000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(809, 330, 32, NULL, 'Armchair dream', NULL, 3, '26100000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(810, 331, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 2, '26000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(811, 331, 74, NULL, 'Giường Leman 1m82', NULL, 1, '17000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(812, 331, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(813, 331, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 2, '72000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(814, 332, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 2, '26000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(815, 332, 74, NULL, 'Giường Leman 1m82', NULL, 1, '17000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(816, 332, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(817, 333, 32, NULL, 'Armchair dream', NULL, 3, '26100000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(818, 333, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(819, 333, 71, NULL, 'Tủ tivi Bridge', NULL, 3, '56999997.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(820, 334, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 2, '26000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(821, 334, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(822, 334, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(823, 334, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 2, '72000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(824, 335, 44, NULL, 'Bàn bên Rise Walnut', NULL, 3, '20999999.97', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(825, 335, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 3, '108000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(826, 336, 71, NULL, 'Tủ tivi Bridge', NULL, 3, '56999997.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(827, 337, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(828, 337, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 1, '36000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(829, 338, 74, NULL, 'Giường Leman 1m82', NULL, 3, '51000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(830, 338, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(831, 338, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(832, 338, 32, NULL, 'Armchair dream', NULL, 3, '26100000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(833, 339, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(834, 339, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 1, '36000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(835, 339, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 2, '34600000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(836, 339, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(837, 340, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(838, 340, 44, NULL, 'Bàn bên Rise Walnut', NULL, 3, '20999999.97', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(839, 340, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(840, 340, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(841, 341, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 2, '34600000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(842, 342, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(843, 342, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 1, '15000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(844, 342, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(845, 343, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 3, '108000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(846, 344, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(847, 345, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(848, 345, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(849, 345, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(850, 345, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 2, '30000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(851, 346, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 2, '72000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(852, 347, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 1, '15000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(853, 347, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 2, '72000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(854, 347, 44, NULL, 'Bàn bên Rise Walnut', NULL, 1, '6999999.99', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(855, 348, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(856, 348, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(857, 349, 44, NULL, 'Bàn bên Rise Walnut', NULL, 1, '6999999.99', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(858, 349, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 1, '13000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(859, 349, 74, NULL, 'Giường Leman 1m82', NULL, 1, '17000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(860, 349, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 2, '72000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(861, 350, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 3, '45000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(862, 350, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 3, '39000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(863, 350, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(864, 350, 32, NULL, 'Armchair dream', NULL, 3, '26100000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(865, 351, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(866, 351, 74, NULL, 'Giường Leman 1m82', NULL, 3, '51000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(867, 352, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 2, '34600000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(868, 352, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 3, '108000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(869, 352, 54, NULL, 'Ghế ăn Moretti', NULL, 3, '29099999.97', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(870, 352, 74, NULL, 'Giường Leman 1m82', NULL, 1, '17000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(871, 353, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 2, '30000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(872, 353, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(873, 353, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 2, '30000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(874, 354, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 2, '30000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(875, 354, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 1, '17300000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(876, 354, 44, NULL, 'Bàn bên Rise Walnut', NULL, 3, '20999999.97', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(877, 354, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 1, '13000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(878, 355, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(879, 355, 74, NULL, 'Giường Leman 1m82', NULL, 3, '51000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(880, 355, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 1, '13000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(881, 355, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 1, '13000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(882, 356, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 2, '30000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(883, 357, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(884, 357, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(885, 357, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 2, '34600000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(886, 357, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 2, '34600000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(887, 358, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(888, 358, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 1, '15000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(889, 358, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 1, '15000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(890, 359, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(891, 360, 44, NULL, 'Bàn bên Rise Walnut', NULL, 1, '6999999.99', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(892, 360, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 1, '13000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(893, 361, 71, NULL, 'Tủ tivi Bridge', NULL, 3, '56999997.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(894, 361, 74, NULL, 'Giường Leman 1m82', NULL, 1, '17000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(895, 361, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(896, 361, 32, NULL, 'Armchair dream', NULL, 1, '8700000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(897, 362, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(898, 363, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(899, 363, 74, NULL, 'Giường Leman 1m82', NULL, 1, '17000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(900, 364, 71, NULL, 'Tủ tivi Bridge', NULL, 3, '56999997.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(901, 365, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(902, 365, 44, NULL, 'Bàn bên Rise Walnut', NULL, 3, '20999999.97', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(903, 365, 54, NULL, 'Ghế ăn Moretti', NULL, 1, '9699999.99', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(904, 366, 32, NULL, 'Armchair dream', NULL, 3, '26100000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(905, 367, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(906, 367, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(907, 368, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(908, 368, 71, NULL, 'Tủ tivi Bridge', NULL, 3, '56999997.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(909, 368, 71, NULL, 'Tủ tivi Bridge', NULL, 3, '56999997.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(910, 369, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 2, '30000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(911, 369, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(912, 369, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 2, '34600000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(913, 370, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 2, '34600000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(914, 370, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 1, '17300000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(915, 370, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(916, 371, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 2, '72000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(917, 371, 54, NULL, 'Ghế ăn Moretti', NULL, 3, '29099999.97', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(918, 371, 32, NULL, 'Armchair dream', NULL, 1, '8700000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(919, 371, 54, NULL, 'Ghế ăn Moretti', NULL, 2, '19399999.98', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(920, 372, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 3, '45000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(921, 372, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(922, 373, 32, NULL, 'Armchair dream', NULL, 3, '26100000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(923, 373, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(924, 373, 54, NULL, 'Ghế ăn Moretti', NULL, 2, '19399999.98', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(925, 373, 32, NULL, 'Armchair dream', NULL, 3, '26100000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(926, 374, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 1, '17300000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(927, 375, 74, NULL, 'Giường Leman 1m82', NULL, 3, '51000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(928, 375, 54, NULL, 'Ghế ăn Moretti', NULL, 1, '9699999.99', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(929, 375, 54, NULL, 'Ghế ăn Moretti', NULL, 1, '9699999.99', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(930, 375, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(931, 376, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 2, '26000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(932, 376, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 2, '34600000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(933, 376, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 3, '39000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(934, 376, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 2, '34600000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(935, 377, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_variant_id`, `product_name`, `variant_attributes`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
(936, 377, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 1, '36000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(937, 378, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 1, '17300000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(938, 379, 74, NULL, 'Giường Leman 1m82', NULL, 1, '17000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(939, 380, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 1, '15000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(940, 380, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 1, '15000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(941, 381, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(942, 381, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 1, '17300000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(943, 381, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(944, 382, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 2, '30000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(945, 382, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 1, '36000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(946, 382, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 3, '45000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(947, 382, 54, NULL, 'Ghế ăn Moretti', NULL, 1, '9699999.99', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(948, 383, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 3, '39000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(949, 383, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(950, 383, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(951, 383, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(952, 384, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 1, '13000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(953, 384, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(954, 384, 44, NULL, 'Bàn bên Rise Walnut', NULL, 3, '20999999.97', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(955, 384, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(956, 385, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 2, '72000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(957, 385, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 3, '39000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(958, 385, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 1, '17300000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(959, 385, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 2, '34600000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(960, 386, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 1, '17300000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(961, 386, 74, NULL, 'Giường Leman 1m82', NULL, 1, '17000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(962, 387, 74, NULL, 'Giường Leman 1m82', NULL, 1, '17000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(963, 388, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 2, '10000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(964, 388, 74, NULL, 'Giường Leman 1m82', NULL, 1, '17000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(965, 388, 44, NULL, 'Bàn bên Rise Walnut', NULL, 1, '6999999.99', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(966, 389, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 1, '17300000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(967, 390, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 3, '108000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(968, 390, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(969, 391, 54, NULL, 'Ghế ăn Moretti', NULL, 2, '19399999.98', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(970, 391, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 1, '36000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(971, 391, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(972, 392, 74, NULL, 'Giường Leman 1m82', NULL, 1, '17000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(973, 392, 32, NULL, 'Armchair dream', NULL, 1, '8700000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(974, 392, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 3, '39000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(975, 393, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(976, 393, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 2, '72000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(977, 394, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(978, 394, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(979, 394, 44, NULL, 'Bàn bên Rise Walnut', NULL, 1, '6999999.99', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(980, 394, 54, NULL, 'Ghế ăn Moretti', NULL, 1, '9699999.99', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(981, 395, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 1, '15000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(982, 395, 44, NULL, 'Bàn bên Rise Walnut', NULL, 3, '20999999.97', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(983, 395, 71, NULL, 'Tủ tivi Bridge', NULL, 2, '37999998.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(984, 396, 74, NULL, 'Giường Leman 1m82', NULL, 3, '51000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(985, 396, 74, NULL, 'Giường Leman 1m82', NULL, 3, '51000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(986, 396, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(987, 397, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 1, '13000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(988, 397, 32, NULL, 'Armchair dream', NULL, 1, '8700000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(989, 397, 54, NULL, 'Ghế ăn Moretti', NULL, 1, '9699999.99', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(990, 398, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 3, '108000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(991, 398, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 3, '108000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(992, 398, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 2, '34600000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(993, 398, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 3, '15000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(994, 399, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 2, '72000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(995, 399, 74, NULL, 'Giường Leman 1m82', NULL, 3, '51000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(996, 399, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 2, '34600000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(997, 400, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 1, '36000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(998, 400, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(999, 401, 45, NULL, 'Bàn bên tròn Mây mới', NULL, 1, '5000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1000, 401, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1001, 401, 74, NULL, 'Giường Leman 1m82', NULL, 3, '51000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1002, 401, 74, NULL, 'Giường Leman 1m82', NULL, 3, '51000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1003, 402, 71, NULL, 'Tủ tivi Bridge', NULL, 1, '18999999.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1004, 402, 32, NULL, 'Armchair dream', NULL, 3, '26100000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1005, 403, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 2, '30000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1006, 403, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 2, '72000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1007, 403, 44, NULL, 'Bàn bên Rise Walnut', NULL, 3, '20999999.97', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1008, 404, 44, NULL, 'Bàn bên Rise Walnut', NULL, 2, '13999999.98', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1009, 404, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 1, '13000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1010, 404, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 2, '34600000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1011, 404, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 2, '34600000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1012, 405, 28, NULL, 'Sofa 2 Chỗ OGAMI 1m4', NULL, 2, '26000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1013, 405, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 2, '72000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1014, 405, 72, NULL, 'Tủ Tivi Miami 210004', NULL, 1, '17300000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1015, 405, 62, NULL, 'Bàn ăn Peak hiện đại mặt Ceramic vân mây', NULL, 3, '108000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1016, 406, 74, NULL, 'Giường Leman 1m82', NULL, 2, '34000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1017, 407, 64, NULL, 'Bàn ăn Cartesio ceramic P2C', NULL, 2, '30000000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1018, 407, 32, NULL, 'Armchair dream', NULL, 2, '17400000.00', '2025-08-24 06:18:47', '2025-08-24 06:18:47'),
(1019, 408, 72, 117, 'Tủ Tivi Miami 210004', NULL, 1, '17300000.00', '2025-08-24 14:06:33', '2025-08-24 14:06:33'),
(1020, 409, 55, 95, 'Ghế ăn TAURA Eponji', NULL, 2, '17000000.00', '2025-08-24 15:26:40', '2025-08-24 15:26:40'),
(1021, 409, 76, 124, 'Giường ngủ bọc vải Softly 1m8', NULL, 2, '52000000.00', '2025-08-24 15:26:40', '2025-08-24 15:26:40'),
(1022, 410, 69, 112, 'Tủ TV Moretti', NULL, 1, '35000000.00', '2025-08-25 14:55:15', '2025-08-25 14:55:15'),
(1023, 411, 76, 125, 'Giường ngủ bọc vải Softly 1m8', NULL, 1, '26000000.00', '2025-08-25 15:35:29', '2025-08-25 15:35:29'),
(1024, 412, 63, 105, 'Bàn ăn Kent FR160', NULL, 1, '16000000.00', '2025-08-25 15:36:38', '2025-08-25 15:36:38'),
(1025, 413, 73, 118, 'Tủ tivi Pio', NULL, 1, '14000000.00', '2025-08-25 15:39:33', '2025-08-25 15:39:33'),
(1026, 414, 42, 76, 'Bàn bên Luxury Triangle Champ 84156K', NULL, 2, '28000000.00', '2025-08-25 15:56:30', '2025-08-25 15:56:30'),
(1027, 415, 29, 34, 'Sofa 3 Chỗ CABO 2m2', NULL, 1, '32000000.00', '2025-08-25 16:59:16', '2025-08-25 16:59:16');

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
(19, 38, 'delivered', NULL, NULL, '2025-07-26 15:35:21', '2025-07-26 15:35:21'),
(20, 49, 'shipped', 'a', 'order_images/1755913447_imgi_2882_nha-xinh-phong-ngu-giuong-ngu-go-hien-dai-pop-5.jpg', '2025-08-23 01:44:08', '2025-08-23 01:44:08'),
(21, 49, 'delivered', 'h', 'order_images/1755914599_imgi_3340_Sofa-Wave-da-L1U-3-2048x2048.jpg', '2025-08-23 02:03:19', '2025-08-23 02:03:19'),
(22, 46, 'cancelled', NULL, NULL, '2025-08-23 02:12:02', '2025-08-23 02:12:02'),
(23, 47, 'cancelled', NULL, NULL, '2025-08-23 02:12:44', '2025-08-23 02:12:44'),
(24, 55, 'shipped', 'hay', 'order_images/1755968219_imgi_2882_nha-xinh-phong-ngu-giuong-ngu-go-hien-dai-pop-5.jpg', '2025-08-23 16:57:00', '2025-08-23 16:57:00'),
(25, 55, 'delivered', 'ws', 'order_images/1755968264_imgi_3340_Sofa-Wave-da-L1U-3-2048x2048.jpg', '2025-08-23 16:57:44', '2025-08-23 16:57:44'),
(26, 56, 'cancelled', NULL, NULL, '2025-08-23 17:30:38', '2025-08-23 17:30:38'),
(27, 56, 'cancelled', NULL, NULL, '2025-08-23 17:33:06', '2025-08-23 17:33:06'),
(28, 56, 'shipped', 'sfsfa', 'order_images/1755970465_imgi_2882_nha-xinh-phong-ngu-giuong-ngu-go-hien-dai-pop-5.jpg', '2025-08-23 17:34:26', '2025-08-23 17:34:26'),
(29, 56, 'returned', 'Đã hoàn trả hàng về kho do giao thất bại', NULL, '2025-08-23 17:34:55', '2025-08-23 17:34:55'),
(30, 409, 'shipped', 'chuan bi giao', 'order_images/1756049634_imgi_4076_ban-dau-giuong-skagen-768x511.png', '2025-08-24 15:33:55', '2025-08-24 15:33:55'),
(31, 409, 'delivered', 'adad', 'order_images/1756049867_imgi_2882_nha-xinh-phong-ngu-giuong-ngu-go-hien-dai-pop-5.jpg', '2025-08-24 15:37:47', '2025-08-24 15:37:47'),
(32, 410, 'shipped', 'da lay hang', 'order_images/1756134050_imgi_2882_nha-xinh-phong-ngu-giuong-ngu-go-hien-dai-pop-5.jpg', '2025-08-25 15:00:51', '2025-08-25 15:00:51'),
(33, 410, 'delivered', 'da giao hang', 'order_images/1756134098_imgi_3340_Sofa-Wave-da-L1U-3-2048x2048.jpg', '2025-08-25 15:01:38', '2025-08-25 15:01:38'),
(34, 413, 'shipped', 'a', 'order_images/1756136456_imgi_2882_nha-xinh-phong-ngu-giuong-ngu-go-hien-dai-pop-5.jpg', '2025-08-25 15:40:56', '2025-08-25 15:40:56'),
(35, 414, 'shipped', 'da nhan hang', 'order_images/1756137732_imgi_3340_Sofa-Wave-da-L1U-3-2048x2048.jpg', '2025-08-25 16:02:12', '2025-08-25 16:02:12'),
(36, 414, 'delivered', 'da giao hang', 'order_images/1756137771_imgi_2882_nha-xinh-phong-ngu-giuong-ngu-go-hien-dai-pop-5.jpg', '2025-08-25 16:02:51', '2025-08-25 16:02:51');

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
(2, 'Hic voluptas velit possimus.', 'hic-voluptas-velit-possimus-2g8JW', '<p>Qui sed nostrum et fugit architecto. Necessitatibus eaque sit quo modi ullam libero. Nihil eveniet vitae fugit expedita vel pariatur. Modi a odio assumenda numquam ut non in. Accusamus ducimus consequatur ut molestiae esse. Aut mollitia ratione possimus nostrum sit omnis. Eius porro libero totam. Nesciunt possimus accusantium rerum ipsum. Assumenda unde omnis nisi fugiat quasi quasi accusantium. Quaerat velit est et labore repudiandae qui. Alias quae eligendi aliquid consequatur. Ut consequatur occaecati dolor vel reprehenderit. Quis deserunt voluptatem consequatur excepturi. Eligendi quia sit excepturi aliquid aut ipsa ratione quia.</p>', 12, 'blog_post', 'draft', 'Ex architecto recusandae aut voluptatibus eos officia ducimus.', 'Vel repudiandae consequatur aut quis magni. Sint et et nemo voluptatem sed sint sed.', NULL, '2025-01-09 16:29:00', '2024-10-08 20:18:12', '2025-08-25 17:23:51'),
(3, '“Mây” – Tựa Như Gió Thoảng Qua Miền Quê', 'may-tua-nhu-gio-thoang-qua-mien-que', '<div id=\"text-4091440283\" class=\"text\">\r\n<h2 class=\"uppercase\">&nbsp;</h2>\r\n<p>Nhẹ nh&agrave;ng, thư th&aacute;i, v&agrave; gần gũi với thi&ecirc;n nhi&ecirc;n &ndash; đ&oacute; l&agrave; cảm gi&aacute;c m&agrave; bạn sẽ cảm nhận được ngay khi chạm mắt đến Bộ sưu tập M&acirc;y &ndash; một s&aacute;ng tạo mới nhất từ Funori, lấy cảm hứng từ vẻ đẹp mộc mạc, b&igrave;nh dị của hồn qu&ecirc; Việt Nam.</p>\r\n</div>\r\n<div id=\"row-1080266024\" class=\"row\">\r\n<div id=\"col-1509455744\" class=\"col medium-7 small-12 large-7\">\r\n<div class=\"col-inner text-center\">\r\n<div id=\"image_979969532\" class=\"img has-hover x md-x lg-x y md-y lg-y\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/06/DETAL-MAY.webp\" sizes=\"(max-width: 700px) 100vw, 700px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/06/DETAL-MAY.webp 700w, https://nhaxinh.com/wp-content/uploads/2025/06/DETAL-MAY-600x400.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/06/DETAL-MAY-300x200.webp 300w\" alt=\"\" width=\"700\" height=\"467\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/06/DETAL-MAY.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/06/DETAL-MAY.webp 700w, https://nhaxinh.com/wp-content/uploads/2025/06/DETAL-MAY-600x400.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/06/DETAL-MAY-300x200.webp 300w\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"col-635512996\" class=\"col medium-5 small-12 large-5\">\r\n<div class=\"col-inner text-left\">\r\n<div id=\"text-1559245718\" class=\"text\">\r\n<h1><strong>Nơi Vật Liệu L&ecirc;n Tiếng Bằng Đường Cong</strong></h1>\r\n<p>Những sợi m&acirc;y được đan tay tỉ mỉ, tạo n&ecirc;n c&aacute;c đường cong mềm mại, uyển chuyển, vừa tạo cảm gi&aacute;c thoải m&aacute;i khi sử dụng, vừa giữ vững yếu tố thẩm mỹ cao cấp. C&aacute;c nghệ nh&acirc;n đ&atilde; kh&eacute;o l&eacute;o đan tay từng sợi m&acirc;y, tạo n&ecirc;n cấu tr&uacute;c nhẹ nh&agrave;ng, mềm mại nhưng kh&ocirc;ng k&eacute;m phần vững chắc. Phần viền khung gỗ beech được xử l&yacute; mượt m&agrave;, định h&igrave;nh c&aacute; t&iacute;nh cho kh&ocirc;ng gian sống hiện đại.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"text-1255454184\" class=\"text\">\r\n<p><em>Kh&ocirc;ng đơn thuần l&agrave; một m&oacute;n đồ nội thất, mỗi sản phẩm M&acirc;y l&agrave; một thanh &acirc;m dịu d&agrave;ng trong bản giao hưởng, nơi sự&nbsp; truyền thống kh&ocirc;ng bị l&atilde;ng qu&ecirc;n m&agrave; được thổi v&agrave;o hơi thở hiện đại đầy tinh tế.</em></p>\r\n</div>\r\n<div id=\"row-1310756959\" class=\"row\">\r\n<div id=\"col-496466930\" class=\"col medium-6 small-12 large-6\">\r\n<div class=\"col-inner text-center\">\r\n<div id=\"image_1129853003\" class=\"img has-hover x md-x lg-x y md-y lg-y\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/06/ARMCHAIR-MAY-728x800.webp\" sizes=\"(max-width: 728px) 100vw, 728px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/06/ARMCHAIR-MAY-728x800.webp 728w, https://nhaxinh.com/wp-content/uploads/2025/06/ARMCHAIR-MAY-364x400.webp 364w, https://nhaxinh.com/wp-content/uploads/2025/06/ARMCHAIR-MAY-768x844.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/06/ARMCHAIR-MAY-300x330.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/06/ARMCHAIR-MAY-600x659.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/06/ARMCHAIR-MAY.webp 800w\" alt=\"\" width=\"728\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/06/ARMCHAIR-MAY-728x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/06/ARMCHAIR-MAY-728x800.webp 728w, https://nhaxinh.com/wp-content/uploads/2025/06/ARMCHAIR-MAY-364x400.webp 364w, https://nhaxinh.com/wp-content/uploads/2025/06/ARMCHAIR-MAY-768x844.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/06/ARMCHAIR-MAY-300x330.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/06/ARMCHAIR-MAY-600x659.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/06/ARMCHAIR-MAY.webp 800w\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"col-1181163079\" class=\"col medium-6 small-12 large-6\">\r\n<div class=\"col-inner text-center\">\r\n<div id=\"image_180812517\" class=\"img has-hover x md-x lg-x y md-y lg-y\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/06/GHE-AN-MAY-636x800.webp\" sizes=\"(max-width: 636px) 100vw, 636px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/06/GHE-AN-MAY-636x800.webp 636w, https://nhaxinh.com/wp-content/uploads/2025/06/GHE-AN-MAY-318x400.webp 318w, https://nhaxinh.com/wp-content/uploads/2025/06/GHE-AN-MAY-768x967.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/06/GHE-AN-MAY-300x378.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/06/GHE-AN-MAY-600x755.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/06/GHE-AN-MAY.webp 800w\" alt=\"\" width=\"636\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/06/GHE-AN-MAY-636x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/06/GHE-AN-MAY-636x800.webp 636w, https://nhaxinh.com/wp-content/uploads/2025/06/GHE-AN-MAY-318x400.webp 318w, https://nhaxinh.com/wp-content/uploads/2025/06/GHE-AN-MAY-768x967.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/06/GHE-AN-MAY-300x378.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/06/GHE-AN-MAY-600x755.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/06/GHE-AN-MAY.webp 800w\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"row-1377470865\" class=\"row\">\r\n<div id=\"col-1553830533\" class=\"col medium-6 small-12 large-6\">\r\n<div class=\"col-inner\">\r\n<div id=\"text-4282224634\" class=\"text\">\r\n<h1><strong>Về Lại Chốn B&igrave;nh Y&ecirc;n Giữa Đ&ocirc; Thị</strong></h1>\r\n<p>Mỗi chiếc ghế ăn, armchair hay b&agrave;n ăn kh&ocirc;ng chỉ đ&oacute;ng vai tr&ograve; chức năng, m&agrave; c&ograve;n khơi gợi h&igrave;nh ảnh hi&ecirc;n nh&agrave; xưa, nơi c&oacute; tiếng v&otilde;ng đung đưa, l&agrave;n gi&oacute; nhẹ xuy&ecirc;n qua v&ograve;m l&aacute;.&nbsp;</p>\r\n<p>Với M&acirc;y, bạn kh&ocirc;ng chỉ b&agrave;y tr&iacute; một căn ph&ograve;ng, m&agrave; đang thổi v&agrave;o kh&ocirc;ng gian sống của m&igrave;nh một t&acirc;m hồn Việt &ndash; &ecirc;m dịu, hiền h&ograve;a v&agrave; đầy chiều s&acirc;u.</p>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"col-1808188115\" class=\"col medium-6 small-12 large-6\">\r\n<div class=\"col-inner\">\r\n<div id=\"image_13508425\" class=\"img has-hover x md-x lg-x y md-y lg-y\">\r\n<div class=\"img-inner image-zoom box-shadow-5 dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/06/BAN-AN-MAY-627x800.webp\" sizes=\"(max-width: 627px) 100vw, 627px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/06/BAN-AN-MAY-627x800.webp 627w, https://nhaxinh.com/wp-content/uploads/2025/06/BAN-AN-MAY-314x400.webp 314w, https://nhaxinh.com/wp-content/uploads/2025/06/BAN-AN-MAY-768x979.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/06/BAN-AN-MAY-300x383.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/06/BAN-AN-MAY-600x765.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/06/BAN-AN-MAY.webp 1000w\" alt=\"\" width=\"627\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/06/BAN-AN-MAY-627x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/06/BAN-AN-MAY-627x800.webp 627w, https://nhaxinh.com/wp-content/uploads/2025/06/BAN-AN-MAY-314x400.webp 314w, https://nhaxinh.com/wp-content/uploads/2025/06/BAN-AN-MAY-768x979.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/06/BAN-AN-MAY-300x383.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/06/BAN-AN-MAY-600x765.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/06/BAN-AN-MAY.webp 1000w\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"text-3549617545\" class=\"text\">\r\n<h1><strong>M&acirc;y &ndash; Nơi T&acirc;m Hồn T&igrave;m Về</strong></h1>\r\n<p>Bộ sưu tập M&acirc;y l&agrave; gợi &yacute; ho&agrave;n hảo cho những ai y&ecirc;u th&iacute;ch kh&ocirc;ng gian sống tối giản, hiện đại m&agrave; vẫn c&oacute; chiều s&acirc;u văn h&oacute;a. Kh&ocirc;ng ph&ocirc; trương, kh&ocirc;ng cầu kỳ, M&acirc;y tinh tế trong từng chất liệu, đường n&eacute;t v&agrave; cảm x&uacute;c m&agrave; n&oacute; mang lại.</p>\r\n</div>\r\n<div id=\"image_1288976575\" class=\"img has-hover x md-x lg-x y md-y lg-y\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/06/SOFAMAY.webp\" sizes=\"(max-width: 1020px) 100vw, 1020px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/06/SOFAMAY.webp 1200w, https://nhaxinh.com/wp-content/uploads/2025/06/SOFAMAY-606x400.webp 606w, https://nhaxinh.com/wp-content/uploads/2025/06/SOFAMAY-768x507.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/06/SOFAMAY-300x198.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/06/SOFAMAY-600x396.webp 600w\" alt=\"\" width=\"1020\" height=\"673\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/06/SOFAMAY.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/06/SOFAMAY.webp 1200w, https://nhaxinh.com/wp-content/uploads/2025/06/SOFAMAY-606x400.webp 606w, https://nhaxinh.com/wp-content/uploads/2025/06/SOFAMAY-768x507.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/06/SOFAMAY-300x198.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/06/SOFAMAY-600x396.webp 600w\"></div>\r\n</div>\r\n<div id=\"text-2209142139\" class=\"text\">\r\n<p>H&atilde;y để Funori gi&uacute;p mỗi ng&agrave;y của bạn trở th&agrave;nh một h&agrave;nh tr&igrave;nh sống chậm, sống xanh, v&agrave; sống s&acirc;u &ndash; ngay tại ch&iacute;nh tổ ấm của m&igrave;nh, c&ugrave;ng M&acirc;y.</p>\r\n</div>', 12, 'blog_post', 'published', '“Mây” – Tựa Như Gió Thoảng Qua Miền Quê', '“Mây” – Tựa Như Gió Thoảng Qua Miền Quê', 'pages/TbFiDXmF8KhL4lUr5AH9Xkv1JavfwM2KZzlwTLzy.jpg', '2024-12-07 16:28:00', '2025-01-15 05:36:34', '2025-08-25 17:22:30'),
(4, 'Possimus nam corrupti quia.', 'possimus-nam-corrupti-quia-h6peI', 'Eos culpa labore veniam dolorem labore aut. Recusandae itaque autem doloribus explicabo et corrupti. Voluptas mollitia nobis quasi harum dolorum molestiae tempora. Consequatur deserunt natus laborum. Architecto ut omnis sit est architecto doloribus atque.\n\nTenetur repudiandae vel distinctio tenetur. Alias earum quia odio.\n\nPerspiciatis in iure beatae tempora. Autem est facere sunt perspiciatis qui autem.\n\nEa ab corporis sequi eum aut at. Sapiente at repellat officiis blanditiis ab eius consectetur. Est ut aut beatae fuga sapiente asperiores eos.\n\nOmnis perspiciatis et sequi sequi eos libero aut. Amet officia doloribus nostrum eos. Temporibus nulla ut quibusdam fugit mollitia quidem.', NULL, 'page', 'draft', 'Inventore autem dignissimos aut sit aliquid maxime id dolorem et.', NULL, NULL, NULL, '2025-01-03 14:11:20', '2025-01-30 16:04:32'),
(5, 'Aut voluptatibus quam et blanditiis qui dolores.', 'aut-voluptatibus-quam-et-blanditiis-qui-dolores-UOYvQ', '<p>Mollitia corporis voluptas officia. Laboriosam accusantium earum consectetur vel. Sed neque natus id enim tempora. Facere nobis dolor rerum et minima consequatur est. Quis similique eum tempora. Sunt incidunt voluptates unde quam et sed iste omnis. Earum et aut aut aliquid. Cupiditate quis et dolorum maxime corrupti quam. Est voluptatem alias ducimus autem qui rerum id in. Vitae sit et nihil autem modi. Est et eum earum eos quo id quos. Delectus recusandae consequuntur qui. Ducimus ut ut culpa fuga doloribus quis officia. Est vero aut fugiat molestiae. Perferendis aspernatur facere error adipisci ut.</p>', 12, 'blog_post', 'published', 'Sequi et quia aut possimus quia nostrum.', 'Ut voluptatum repellat corporis. Excepturi cupiditate voluptas libero vel qui. Aut laudantium esse ipsum pariatur consequuntur voluptas nostrum.', 'pages/3gx9iO3fFLoV3WZgXfzbY0hZwgwLbm0r1RtiTX2p.jpg', '2025-05-22 00:48:00', '2025-01-08 17:01:33', '2025-08-01 04:01:20'),
(6, 'Voluptas et nesciunt possimus quaerat.', 'voluptas-et-nesciunt-possimus-quaerat-QN3gq', 'Voluptate nemo aliquid vel quasi eveniet. Expedita vero provident nulla illum. Facilis fugit nesciunt et et facere. Dolor voluptatem porro quaerat illum nisi. A ad sit mollitia consectetur ex.\n\nDolor molestiae nihil nisi ut enim officia est ut. Soluta atque qui doloremque ut.\n\nPerspiciatis voluptas illo molestiae eum magni necessitatibus. Voluptas quibusdam pariatur ut provident provident aut. Reprehenderit consectetur sequi quae. Numquam voluptatem iusto cum sequi.\n\nRerum repudiandae et molestiae dolores consequatur rem. Eum qui quas molestiae porro at. Et ea aut ea accusamus magnam itaque minus. Consequatur libero at quaerat reprehenderit hic.\n\nSapiente non numquam saepe. Odit nesciunt distinctio est aut. Praesentium fugit non eum fugit vitae pariatur dolorum.', 5, 'page', 'draft', 'Aut rem dolores ut animi voluptatem et aut ipsam.', NULL, NULL, NULL, '2024-08-25 03:35:57', '2024-12-19 14:05:21'),
(7, 'Soluta magni asperiores nesciunt accusamus ipsa.', 'soluta-magni-asperiores-nesciunt-accusamus-ipsa-D7qjd', 'Similique repellendus rem officia cupiditate molestias ut. Quod soluta numquam consequatur repellendus sapiente id. Recusandae molestias voluptas quasi voluptas facilis. Voluptas atque quaerat qui excepturi et sapiente.\n\nAutem deleniti ut recusandae possimus ea ea. Fugiat velit tenetur molestias eos cupiditate ducimus nobis. Et ex libero ut aliquam voluptate.\n\nEt reprehenderit et adipisci consequatur. Dolore et quibusdam impedit et nihil magnam. Et qui ut tempora voluptas et. Error sit suscipit aut error.\n\nEst perferendis nam unde facere exercitationem. Accusamus fugit magnam voluptatibus unde quasi iure. Eligendi qui eum cumque ratione commodi. Est dolore at repudiandae eius cupiditate nam quos.\n\nTenetur exercitationem laborum expedita aspernatur nisi est. Accusamus nihil nihil laboriosam sunt illo adipisci at. Id non et harum eaque ut.', 4, 'page', 'draft', NULL, NULL, NULL, NULL, '2025-02-25 03:37:59', '2025-06-01 23:13:05'),
(8, 'Góc cảm hứng', 'goc-cam-hung', '<p>Voluptatem molestiae cum soluta repudiandae impedit. Quos quia eum unde sint dignissimos cupiditate culpa neque. Reiciendis eum ducimus veniam alias dolores nobis sunt quia. Architecto rerum architecto ipsa tempore. Saepe corporis laboriosam culpa itaque magnam dolor enim enim. Qui adipisci omnis aut quia. Corrupti necessitatibus ut omnis nulla architecto. Eum ipsam impedit quia fugit quia eius rerum incidunt. Voluptatem porro aperiam voluptate. Rem dicta repellendus omnis quae sint. Et tempore voluptates commodi. Sequi ad est velit quo repellat. Ad voluptas eius aliquid est laboriosam error et. Tempora sit veniam ea ea inventore fugiat hic. Animi ad dolorem omnis dolor facilis nam. Cupiditate aut voluptatem optio sit fugit. Qui doloribus quia accusamus voluptas aut et. Facilis aliquam ut enim velit. Et harum atque fugiat incidunt et omnis atque.</p>', 15, 'page', 'draft', 'Góc cảm hứng', 'Góc cảm hứng', NULL, '2025-08-25 17:16:00', '2025-03-25 19:25:55', '2025-08-25 17:16:55'),
(9, 'Qui magnam quaerat asperiores natus delectus vel.', 'qui-magnam-quaerat-asperiores-natus-delectus-vel-t8Vbs', 'Maxime quia pariatur distinctio ut. Quo nihil corporis eaque ab debitis autem. Tempora non impedit quia soluta ratione consectetur sed accusantium.\n\nEnim quis quod ipsa culpa non aut quia dolor. Nesciunt cum alias sunt accusamus. Possimus repudiandae recusandae iure laborum deserunt occaecati. Hic sunt ut ut.\n\nDeserunt rerum possimus enim qui est et omnis placeat. Recusandae ut aut est consequatur voluptatem quis et. Vel inventore aut in nobis qui in. Adipisci quas cum omnis ratione.\n\nNam doloremque in ea voluptatem. Quos voluptatem qui nobis id eos assumenda necessitatibus.\n\nSit nesciunt soluta aspernatur earum ea. Sit rerum et vitae impedit quia voluptatem eos. Doloremque eos ut natus nam magnam quaerat quaerat. Impedit voluptatibus reiciendis commodi nihil molestiae nulla et.', NULL, 'page', 'draft', 'Labore illum aut recusandae aut ut.', 'Officiis quidem in cum voluptas excepturi rerum aut et. Autem temporibus sequi et ipsa ut eos ea ut.', NULL, NULL, '2024-10-18 16:23:40', '2024-09-04 15:47:30'),
(10, 'CHIÊM NGƯỠNG CÁC DÒNG SẢN PHẨM CHO MÙA MỚI TẠI NHÀ XINH', 'chiem-nguong-cac-dong-san-pham-cho-mua-moi-tai-nha-xinh', '<h1 style=\"text-align: center;\"><strong>CHI&Ecirc;M NGƯỠNG C&Aacute;C D&Ograve;NG SẢN PHẨM CHO M&Ugrave;A MỚI TẠI NH&Agrave; XINH</strong></h1>\r\n<p style=\"text-align: center;\">B&ecirc;n cạnh việc tiếp tục l&agrave;m mới kh&ocirc;ng gian cửa h&agrave;ng, mang đến trải nghiệm độc đ&aacute;o cho kh&aacute;ch h&agrave;ng, Nh&agrave; Xinh sẽ giới thiệu những d&ograve;ng sản phẩm mới với thiết kế hợp thời, kiểu d&aacute;ng đa dạng c&ugrave;ng chất lượng cao. H&atilde;y c&ugrave;ng kh&aacute;m ph&aacute; c&aacute;c sản phẩm mới sẽ c&oacute; mặt tại c&aacute;c cửa h&agrave;ng Nh&agrave; Xinh.</p>\r\n<div id=\"image_446114840\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04.jpg\" sizes=\"(max-width: 1000px) 100vw, 1000px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04.jpg 1000w, https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04-601x400.jpg 601w, https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04-768x511.jpg 768w, https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04-300x200.jpg 300w, https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04-600x400.jpg 600w\" alt=\"\" width=\"1000\" height=\"666\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04.jpg\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04.jpg 1000w, https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04-601x400.jpg 601w, https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04-768x511.jpg 768w, https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04-300x200.jpg 300w, https://nhaxinh.com/wp-content/uploads/2025/04/Ban-Nuoc-Valencia-Mat-Da-04-600x400.jpg 600w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\"><strong>Valencia &ndash; bộ sản phẩm cho ph&ograve;ng kh&aacute;ch sang trọng, thanh lịch</strong></p>\r\n<p style=\"text-align: center;\">Lấy cảm hứng từ th&agrave;nh phố Valencia, miền Đ&ocirc;ng Nam T&acirc;y Ban Nha, nơi nổi tiếng với sự giao thoa độc đ&aacute;o giữa kiến tr&uacute;c hiện đại v&agrave; cổ k&iacute;nh. Thiết kế của Valencia tập trung v&agrave;o việc gợi l&ecirc;n cảm gi&aacute;c ấm &aacute;p v&agrave; linh hoạt, đ&aacute;p ứng nhu cầu của cuộc sống hiện đại trong khi vẫn t&ocirc;n vinh những di sản văn h&oacute;a l&acirc;u đời.&nbsp;</p>\r\n<div id=\"image_715003591\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-1200x800.webp\" sizes=\"(max-width: 1020px) 100vw, 1020px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-1200x800.webp 1200w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-600x400.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-768x512.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-1536x1024.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-300x200.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2.webp 1700w\" alt=\"\" width=\"1020\" height=\"680\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-1200x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-1200x800.webp 1200w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-600x400.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-768x512.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-1536x1024.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2-300x200.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/sofa-Valencia-2.webp 1700w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\">Sofa Valencia c&oacute; phần ch&acirc;n kim loại thanh mảnh kết hợp với kiểu d&aacute;ng m&ocirc;-đun hiện đại, với phần hộc gỗ t&iacute;ch hợp b&ecirc;n h&ocirc;ng như một chiếc b&agrave;n b&ecirc;n tiện dụng.&nbsp;</p>\r\n<div id=\"image_2127821004\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-533x800.webp\" sizes=\"(max-width: 533px) 100vw, 533px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-533x800.webp 533w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-267x400.webp 267w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-768x1152.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-1024x1536.webp 1024w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-1365x2048.webp 1365w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-300x450.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-600x900.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1.webp 1600w\" alt=\"\" width=\"533\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-533x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-533x800.webp 533w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-267x400.webp 267w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-768x1152.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-1024x1536.webp 1024w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-1365x2048.webp 1365w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-300x450.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1-600x900.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/armchair-Valencia-1.webp 1600w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\">Th&ecirc;m v&agrave;o đ&oacute;, sản phẩm sử dụng da aniline l&agrave; loại da thuộc cao cấp nhất, được l&agrave;m từ lớp da ngo&agrave;i c&ugrave;ng, giữ lại trọn vẹn vẻ đẹp tự nhi&ecirc;n với những đường v&acirc;n c&ugrave;ng c&aacute;c dấu hiệu tự nhi&ecirc;n kh&aacute;c. Ch&iacute;nh sự &ldquo;ho&agrave;n hảo kh&ocirc;ng ho&agrave;n hảo&rdquo; n&agrave;y tạo n&ecirc;n vẻ độc đ&aacute;o v&agrave; sang trọng cho sản phẩm.</p>\r\n<div id=\"image_1150149185\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-572x800.webp\" sizes=\"(max-width: 572px) 100vw, 572px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-572x800.webp 572w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-286x400.webp 286w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-768x1074.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-1098x1536.webp 1098w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-1464x2048.webp 1464w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-300x420.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-600x839.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2.webp 1700w\" alt=\"\" width=\"572\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-572x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-572x800.webp 572w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-286x400.webp 286w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-768x1074.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-1098x1536.webp 1098w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-1464x2048.webp 1464w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-300x420.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2-600x839.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-2.webp 1700w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\">B&agrave;n b&ecirc;n Valencia l&agrave; sự kết hợp ấn tượng giữa chất liệu gỗ v&agrave; đ&aacute;, phần ch&acirc;n b&agrave;n tối giản tiết kiệm tối đa kh&ocirc;ng gian c&ugrave;ng c&aacute;c đường bo tr&ograve;n tạo cảm gi&aacute;c nhẹ nh&agrave;ng, h&agrave;i h&ograve;a. Valencia c&ograve;n c&oacute; th&ecirc;m ghế armchair v&agrave; b&agrave;n b&ecirc;n được l&agrave;m từ c&aacute;c chất liệu cao cấp, ho&agrave;n thiện kh&ocirc;ng gian ph&ograve;ng kh&aacute;ch đẳng cấp.</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><strong>Napoli &ndash; tạo n&ecirc;n vẻ đẹp ấm c&uacute;ng cho kh&ocirc;ng gian ph&ograve;ng ăn</strong></p>\r\n<p style=\"text-align: center;\">Napoli ra đời từ sự h&ograve;a quyện độc đ&aacute;o giữa vẻ đẹp tự nhi&ecirc;n của c&aacute;c h&igrave;nh khối organic, sự tỉ mỉ trong từng chi tiết ho&agrave;n thiện v&agrave; nguồn cảm hứng mạnh mẽ từ kiến tr&uacute;c hiện đại. &Yacute; tưởng thiết kế của Napoli tập trung v&agrave;o việc tạo ra một sự c&acirc;n bằng thị gi&aacute;c ấn tượng th&ocirc;ng qua c&aacute;c h&igrave;nh khối mang t&iacute;nh kiến tr&uacute;c.&nbsp;</p>\r\n<div id=\"image_249575917\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-1206x800.webp\" sizes=\"(max-width: 1020px) 100vw, 1020px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-1206x800.webp 1206w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-603x400.webp 603w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-768x510.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-1536x1019.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-300x199.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-600x398.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia.webp 1700w\" alt=\"\" width=\"1020\" height=\"677\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-1206x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-1206x800.webp 1206w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-603x400.webp 603w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-768x510.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-1536x1019.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-300x199.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia-600x398.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/ban-an-Valencia.webp 1700w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\">Thay v&igrave; những đường n&eacute;t vu&ocirc;ng vức, cứng nhắc, Napoli ưu ti&ecirc;n c&aacute;c đường cong mềm mại, uyển chuyển, gợi nhớ đến vẻ đẹp tự nhi&ecirc;n, tạo cảm gi&aacute;c gần gũi v&agrave; thư th&aacute;i. Đồng thời, sự chỉn chu trong từng chi tiết nhỏ nhất, từ đường n&eacute;t bo cạnh tinh tế đến bề mặt vật liệu được xử l&yacute; tỉ mỉ, khẳng định gi&aacute; trị cao cấp v&agrave; sự đầu tư nghi&ecirc;m t&uacute;c v&agrave;o chất lượng sản phẩm.</p>\r\n<div id=\"image_1047694612\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-544x800.webp\" sizes=\"(max-width: 544px) 100vw, 544px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-544x800.webp 544w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-272x400.webp 272w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-768x1129.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-1045x1536.webp 1045w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-1394x2048.webp 1394w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-300x441.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-600x882.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia.webp 1700w\" alt=\"\" width=\"544\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-544x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-544x800.webp 544w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-272x400.webp 272w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-768x1129.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-1045x1536.webp 1045w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-1394x2048.webp 1394w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-300x441.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia-600x882.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/ghe-an-Valencia.webp 1700w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\">Sự kết hợp ho&agrave;n hảo giữa gỗ sồi đặc nguy&ecirc;n khối v&agrave; veneer gỗ sồi cao cấp mang đến cho mặt b&agrave;n Napoli vẻ đẹp hiện đại, sang trọng đồng thời đảm bảo độ bền vượt trội. Thiết kế th&ocirc;ng minh của ch&acirc;n b&agrave;n kh&ocirc;ng chỉ tạo ấn tượng về mặt thị gi&aacute;c m&agrave; c&ograve;n tối ưu h&oacute;a kh&ocirc;ng gian sử dụng. Đi c&ugrave;ng chiếc b&agrave;n Napoli sẽ l&agrave; ghế ăn Napoli bọc da b&ograve; tự nhi&ecirc;n cao cấp. Lớp đệm ngồi bọc da đ&ograve;i hỏi người thợ may l&agrave;nh nghề v&agrave; gi&agrave;u kinh nghiệm để đảm bảo độ căng l&yacute; tưởng, đường may đều đặn v&agrave; sắc sảo tr&ecirc;n to&agrave;n bộ bề mặt sản phẩm, t&ocirc;n l&ecirc;n vẻ đẹp sang trọng v&agrave; đẳng cấp.</p>\r\n<div id=\"image_1848863481\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-598x800.webp\" sizes=\"(max-width: 598px) 100vw, 598px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-598x800.webp 598w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-299x400.webp 299w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-768x1027.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-1149x1536.webp 1149w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-1532x2048.webp 1532w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-300x401.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-600x802.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia.webp 1700w\" alt=\"\" width=\"598\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-598x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-598x800.webp 598w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-299x400.webp 299w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-768x1027.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-1149x1536.webp 1149w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-1532x2048.webp 1532w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-300x401.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia-600x802.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/tuly-Valencia.webp 1700w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\">Th&ecirc;m một sản phẩm nữa Nh&agrave; Xinh muốn giới thiệu, ch&iacute;nh l&agrave; tủ ly Napoli, được tạo ra với mong muốn mang đến một giải ph&aacute;p lưu trữ kh&ocirc;ng chỉ tối ưu về c&ocirc;ng năng m&agrave; c&ograve;n sở hữu vẻ đẹp hiện đại, tinh tế, g&oacute;p phần ho&agrave;n thiện kh&ocirc;ng gian sống đẳng cấp. Sự tỉ mỉ trong từng chi tiết thiết kế, đặc biệt l&agrave; những đường n&eacute;t CNC phức tạp tr&ecirc;n c&aacute;nh tủ, sẽ tạo n&ecirc;n điểm nhấn ấn tượng, khẳng định gu thẩm mỹ tinh tế của gia chủ.</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><strong>Nest &ndash; ấm &aacute;p v&agrave; hiện đại</strong></p>\r\n<p style=\"text-align: center;\">Đ&uacute;ng như c&aacute;i t&ecirc;n mang &yacute; nghĩa &ldquo;chiếc tổ&rdquo;, Nest mang vẻ ngo&agrave;i ấm c&uacute;ng, mềm mại v&agrave; thư th&aacute;i. Thiết kế của d&ograve;ng sản phẩm Nest mang đến một diện mạo trẻ trung, hợp thời v&agrave; tươi s&aacute;ng cho kh&ocirc;ng gian.</p>\r\n<div id=\"slider-85254289\" class=\"slider-wrapper relative\" style=\"text-align: center;\">\r\n<div class=\"slider slider-nav-circle slider-nav-large slider-nav-light slider-style-normal slider-lazy-load-active is-draggable flickity-enabled\" tabindex=\"0\" data-flickity-options=\"{\r\n            &quot;cellAlign&quot;: &quot;center&quot;,\r\n            &quot;imagesLoaded&quot;: true,\r\n            &quot;lazyLoad&quot;: 1,\r\n            &quot;freeScroll&quot;: false,\r\n            &quot;wrapAround&quot;: true,\r\n            &quot;autoPlay&quot;: 6000,\r\n            &quot;pauseAutoPlayOnHover&quot; : true,\r\n            &quot;prevNextButtons&quot;: true,\r\n            &quot;contain&quot; : true,\r\n            &quot;adaptiveHeight&quot; : true,\r\n            &quot;dragThreshold&quot; : 10,\r\n            &quot;percentPosition&quot;: true,\r\n            &quot;pageDots&quot;: true,\r\n            &quot;rightToLeft&quot;: false,\r\n            &quot;draggable&quot;: true,\r\n            &quot;selectedAttraction&quot;: 0.1,\r\n            &quot;parallax&quot; : 0,\r\n            &quot;friction&quot;: 0.6        }\">\r\n<div class=\"flickity-viewport\">\r\n<div class=\"flickity-slider\">\r\n<div id=\"image_601929453\" class=\"img has-hover x md-x lg-x y md-y lg-y is-selected\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-1200x800.webp\" sizes=\"(max-width: 1020px) 100vw, 1020px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-1200x800.webp 1200w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-600x400.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-768x512.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-1536x1024.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-300x200.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4.webp 1700w\" alt=\"\" width=\"1020\" height=\"680\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-1200x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-1200x800.webp 1200w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-600x400.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-768x512.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-1536x1024.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4-300x200.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-4.webp 1700w\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<button class=\"flickity-button flickity-prev-next-button previous\" disabled=\"disabled\" type=\"button\" aria-label=\"Previous\"></button><button class=\"flickity-button flickity-prev-next-button next\" disabled=\"disabled\" type=\"button\" aria-label=\"Next\"></button></div>\r\n</div>\r\n<p style=\"text-align: center;\">Lấy cảm hứng từ h&igrave;nh ảnh ấm &aacute;p v&agrave; mềm mại của một chiếc tổ chim, Nest mang đến một thiết kế sofa tr&agrave;n đầy sự thoải m&aacute;i v&agrave; gần gũi. Đường cong uyển chuyển ở phần tựa lưng v&agrave; đường may nhấn tinh tế tr&ecirc;n tay vịn kh&ocirc;ng chỉ tạo điểm nhấn thẩm mỹ m&agrave; c&ograve;n gợi l&ecirc;n cảm gi&aacute;c được bao bọc, an y&ecirc;n.</p>\r\n<div id=\"image_1573078374\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-533x800.webp\" sizes=\"(max-width: 533px) 100vw, 533px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-533x800.webp 533w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-267x400.webp 267w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-768x1152.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-1024x1536.webp 1024w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-1365x2048.webp 1365w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-300x450.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-600x900.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3.webp 1700w\" alt=\"\" width=\"533\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-533x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-533x800.webp 533w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-267x400.webp 267w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-768x1152.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-1024x1536.webp 1024w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-1365x2048.webp 1365w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-300x450.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3-600x900.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-3.webp 1700w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\">Mang một ng&ocirc;n ngữ thiết kế tươi mới, hiện đại v&agrave; kh&aacute;c biệt so với c&aacute;c sản phẩm hiện c&oacute; của Nh&agrave; Xinh. Những đường cong mềm mại kết hợp với c&aacute;c chi tiết độc đ&aacute;o tạo n&ecirc;n một chiếc armchair Nest c&aacute; t&iacute;nh, nổi bật v&agrave; thu h&uacute;t mọi &aacute;nh nh&igrave;n. Sản phẩm c&oacute; thể kết hợp c&ugrave;ng b&agrave;n nước Nest mang vẻ đẹp nguy&ecirc;n bản của đ&aacute; marble tự nhi&ecirc;n, thiết kế nhỏ gọn, tạo n&ecirc;n sự thư th&aacute;i cho kh&ocirc;ng gian sống.</p>\r\n<div id=\"image_1498471374\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-533x800.webp\" sizes=\"(max-width: 533px) 100vw, 533px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-533x800.webp 533w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-267x400.webp 267w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-768x1152.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-1024x1536.webp 1024w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-1365x2048.webp 1365w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-300x450.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-600x900.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia.webp 1700w\" alt=\"\" width=\"533\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-533x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-533x800.webp 533w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-267x400.webp 267w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-768x1152.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-1024x1536.webp 1024w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-1365x2048.webp 1365w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-300x450.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia-600x900.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/04/goc-cam-hung-Valencia.webp 1700w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\">Gh&eacute; thăm c&aacute;c cửa h&agrave;ng Nh&agrave; Xinh tr&ecirc;n to&agrave;n quốc để trải nghiệm c&aacute;c sản phẩm mới c&ugrave;ng kh&ocirc;ng gian trưng b&agrave;y đầy cảm hứng.&nbsp;</p>', 12, 'blog_post', 'published', 'CHIÊM NGƯỠNG CÁC DÒNG SẢN PHẨM CHO MÙA MỚI TẠI NHÀ XINH', 'Bên cạnh việc tiếp tục làm mới không gian cửa hàng, mang đến trải nghiệm độc đáo cho khách hàng, Nhà Xinh sẽ giới thiệu những dòng sản phẩm mới với thiết kế hợp thời, kiểu dáng đa dạng cùng chất lượng cao. Hãy cùng khám phá các sản phẩm mới sẽ có mặt tại các cửa hàng Nhà Xinh.', 'pages/pJV726mtOzXIN51TfHTaFYIGytu7pXqzdUXpcCew.jpg', '2025-05-04 11:56:00', '2025-02-01 13:56:39', '2025-07-26 06:58:32');
INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `author_id`, `page_type`, `status`, `meta_title`, `meta_description`, `featured_image_url`, `published_at`, `created_at`, `updated_at`) VALUES
(11, 'Vẻ đẹp của những chiếc giường ngủ mây', 've-ep-cua-nhung-chiec-giuong-ngu-may', '<div id=\"row-1165811263\" class=\"row\">\r\n<div id=\"col-727771576\" class=\"col small-12 large-12\">\r\n<div class=\"col-inner\">\r\n<h1><strong>PH&Ograve;NG NGỦ M&Acirc;Y &ndash; VẺ ĐẸP BỀN VỮNG TỪ CHẤT LIỆU TH&Acirc;N QUEN</strong></h1>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"row-1418675357\" class=\"row\">\r\n<div id=\"col-378003564\" class=\"col small-12 large-12\">\r\n<div class=\"col-inner\">\r\n<p>Một trong những niềm tự h&agrave;o của&nbsp;<strong><a href=\"https://nhaxinh.com/\">Nh&agrave; Xinh</a></strong>&nbsp;ch&iacute;nh l&agrave;&nbsp;<a href=\"https://nhaxinh.com/bo-suu-tap-may/\"><strong>bộ sưu tập M&acirc;y</strong></a>, với những thiết kế mang vẻ đẹp thuần Việt thanh lịch. M&agrave; giường ngủ M&acirc;y ch&iacute;nh l&agrave; minh chứng r&otilde; r&agrave;ng nhất cho gu thẩm mỹ tinh tế hiện đại m&agrave; Nh&agrave; Xinh muốn mang đến cho từng tổ ấm.</p>\r\n<p>Từ l&acirc;u nay, chất liệu m&acirc;y tre đan đ&atilde; l&agrave; một phần quen thuộc gắn với những l&agrave;ng qu&ecirc; Việt. Nhằm t&ocirc;n vinh n&eacute;t đẹp thuần Việt, Nh&agrave; Xinh đ&atilde; thiết kế n&ecirc;n chiếc&nbsp;<a href=\"https://nhaxinh.com/danh-muc/phong-ngu/giuong/\"><strong>giường ngủ</strong></a>&nbsp;M&acirc;y mang đến cảm gi&aacute;c gần gũi m&agrave; thanh lịch, hiện đại. Sự h&ograve;a quyện những gam m&agrave;u đặc biệt: sắc m&agrave;u n&acirc;u đỏ sang trọng, m&agrave;u da kem thời thượng c&ugrave;ng tone v&agrave;ng tự nhi&ecirc;n từ những sợi m&acirc;y đan mang đến cảm gi&aacute;c dịu nhẹ hơn bao giờ hết.</p>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"row-661146949\" class=\"row\">\r\n<div id=\"col-735967760\" class=\"col medium-4 small-12 large-4\">\r\n<div class=\"col-inner\">\r\n<div id=\"image_1893689019\" class=\"img has-hover x md-x lg-x y md-y lg-y\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-original size-original lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-2.jpg\" sizes=\"(max-width: 698px) 100vw, 698px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-2.jpg 698w, https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-2-279x400.jpg 279w, https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-2-558x800.jpg 558w, https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-2-300x430.jpg 300w, https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-2-600x860.jpg 600w\" alt=\"\" width=\"698\" height=\"1000\" data-src=\"https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-2.jpg\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-2.jpg 698w, https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-2-279x400.jpg 279w, https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-2-558x800.jpg 558w, https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-2-300x430.jpg 300w, https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-2-600x860.jpg 600w\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"col-5362941\" class=\"col medium-4 small-12 large-4\">\r\n<div class=\"col-inner\">\r\n<p>Tr&ecirc;n&nbsp;<a href=\"https://nhaxinh.com/danh-muc/phong-ngu/ban-dau-giuong/\"><strong>b&agrave;n đầu giường</strong></a>&nbsp;c&oacute; thể đặt th&ecirc;m hai chiếc&nbsp;<a href=\"https://nhaxinh.com/danh-muc/hang-trang-tri/binh-trang-tri/\"><strong>b&igrave;nh trang tr&iacute;</strong></a>&nbsp;được cắm v&agrave;i c&agrave;nh&nbsp;<a href=\"https://nhaxinh.com/danh-muc/hang-trang-tri/hoa-cay/\"><strong>hoa v&agrave; l&aacute;</strong></a>&nbsp;gi&uacute;p cho kh&ocirc;ng gian th&ecirc;m mềm mại. Ngo&agrave;i ra, bức&nbsp;<a href=\"https://nhaxinh.com/danh-muc/hang-trang-tri/tranh/\"><strong>tranh</strong></a>&nbsp;gắn ph&iacute;a tr&ecirc;n đầu giường với nhiều chủ đề sẽ tiếp th&ecirc;m năng lượng cho&nbsp;<a href=\"https://nhaxinh.com/phong-ngu/\"><strong>ph&ograve;ng ngủ</strong></a>, đưa gia chủ v&agrave;o giấc ngủ ngon.</p>\r\n<p>Giường M&acirc;y khi kết hợp c&ugrave;ng những sản phẩm kh&aacute;c trong&nbsp;<a href=\"https://nhaxinh.com/bo-suu-tap/\"><strong>bộ sưu tập</strong></a>&nbsp;sẽ tạo n&ecirc;n một bản h&ograve;a thanh, nổi bật từ đường n&eacute;t cho đến chất liệu, được trau chuốt từng chi tiết nhỏ. Để c&oacute; thể thưởng thức vẻ đẹp của M&acirc;y, kh&ocirc;ng g&igrave; tuyệt vời hơn việc gh&eacute; thăm trải nghiệm ngay tại c&aacute;c cửa h&agrave;ng&nbsp;<a href=\"https://nhaxinh.com/\"><strong>Nh&agrave; Xinh</strong></a>.</p>\r\n</div>\r\n</div>\r\n<div id=\"col-507465453\" class=\"col medium-4 small-12 large-4\">\r\n<div class=\"col-inner\">\r\n<div id=\"image_1115230166\" class=\"img has-hover x md-x lg-x y md-y lg-y\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-original size-original lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-1.jpg\" sizes=\"(max-width: 667px) 100vw, 667px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-1.jpg 667w, https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-1-267x400.jpg 267w, https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-1-534x800.jpg 534w, https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-1-300x450.jpg 300w, https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-1-600x900.jpg 600w\" alt=\"\" width=\"667\" height=\"1000\" data-src=\"https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-1.jpg\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-1.jpg 667w, https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-1-267x400.jpg 267w, https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-1-534x800.jpg 534w, https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-1-300x450.jpg 300w, https://nhaxinh.com/wp-content/uploads/2023/08/giuong-ngu-May-1-600x900.jpg 600w\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', 12, 'blog_post', 'published', 'PHÒNG NGỦ MÂY – VẺ ĐẸP BỀN VỮNG TỪ CHẤT LIỆU THÂN QUEN', 'PHÒNG NGỦ MÂY – VẺ ĐẸP BỀN VỮNG TỪ CHẤT LIỆU THÂN QUEN', 'pages/Y9gHU1ffln26DZj484pZQYYG7d9COJZSskuLTvts.jpg', '2024-10-13 17:44:00', '2024-09-22 18:48:04', '2025-08-25 17:25:45'),
(12, 'Điểm tô sắc màu cho không gian sống', 'iem-to-sac-mau-cho-khong-gian-song', '<p>Dolorum minus iure dicta id explicabo tempore. Nihil repellat rem dolores vel aliquam. Expedita sed perferendis voluptatem eum id. Facilis qui quasi aspernatur. Voluptatibus deleniti quo qui tenetur perferendis excepturi perspiciatis. Debitis qui eveniet et enim qui eligendi. Est ab voluptates est dolor numquam. Consequuntur similique sed rerum quisquam voluptatum sunt. Unde nihil similique quo veniam. Voluptatem laudantium fugiat dolorem sunt dicta sint id. Perferendis ut error porro delectus et esse ipsam dolores. Hic ipsum enim soluta sed sed voluptatem ut. Libero quia pariatur voluptatem repellendus similique dolor voluptatem iure. Quia atque et iure aliquam. Et quaerat repudiandae repellendus dolores voluptate rerum enim eos. Vel nisi eos eos et hic. Et ducimus et unde. Pariatur quidem molestiae possimus. Nobis impedit ad aliquam nostrum omnis.</p>', 15, 'blog_post', 'published', 'Điểm tô sắc màu cho không gian sống', 'Điểm tô sắc màu cho không gian sống', 'pages/70zh3jOpcXqfGl9JKOKKGYXLTrbHMYFcFJcLg0pW.jpg', '2024-09-27 01:20:00', '2024-10-30 02:15:14', '2025-08-25 17:23:20'),
(13, 'Top 5 Sofa Da Tại Nhà Xinh Cho Mọi Không Gian Hiện Đại', 'top-5-sofa-da-tai-nha-xinh-cho-moi-khong-gian-hien-ai', '<p>Accusantium enim quia autem quam. Praesentium rem id esse itaque quam. Dolorem voluptatem eius et aspernatur voluptatum distinctio officiis. Officiis molestiae facere asperiores inventore blanditiis numquam. Illum minus dicta quibusdam optio aliquam. Est sed illo quos repellat laborum qui aspernatur. Vel ullam ea consequuntur quis molestiae sit occaecati. Et odit praesentium rem dolores tenetur mollitia nesciunt. Provident laboriosam cum sint aut aut. Asperiores omnis expedita nobis alias laborum hic omnis. Qui labore amet quia molestiae libero recusandae laborum. Minima rem animi dolorem ea. Ut aut nostrum et distinctio est. Omnis voluptas est eos corrupti. Fugiat non qui laborum voluptatem laborum fugiat. Ex nihil omnis assumenda praesentium nemo impedit dolores. Perferendis ad et nihil vel ut nemo voluptate.</p>', 12, 'blog_post', 'published', 'Top 5 Sofa Da Tại Nhà Xinh Cho Mọi Không Gian Hiện Đại', 'Top 5 Sofa Da Tại Nhà Xinh Cho Mọi Không Gian Hiện Đại', 'pages/rkRl7uTZWoxuPE5Fga2x1Q6gOQDpn9nNjaH1kUJg.jpg', '2025-02-21 10:21:00', '2024-09-25 09:51:46', '2025-08-25 17:24:21'),
(14, 'Qui consequatur et ut.', 'qui-consequatur-et-ut-xCsRe', 'Labore at sit molestiae harum tenetur. Esse ipsum sint et facilis et et. Nobis consequatur officiis harum expedita. Nihil est vitae consequuntur commodi asperiores ut. Illo facilis quia doloremque ut illum maiores praesentium et.\n\nCupiditate omnis sed exercitationem quis qui harum placeat. Qui occaecati ut sint adipisci excepturi dolores. Quisquam ea qui facere animi. Qui quam hic reprehenderit illo.\n\nEos aut odio id consequatur laudantium. Labore et nihil soluta aut. Voluptatem aut accusantium magni rem possimus facilis laudantium quidem. Rerum rerum earum tenetur ea beatae.\n\nUt at eum suscipit nihil minima qui voluptatum temporibus. Repellendus occaecati nostrum quia eos quod vel et. Harum ut laboriosam a. Eos blanditiis aliquid temporibus alias voluptatem non aliquid non.\n\nQuo et magni consequuntur dolorum maiores eos et. Tempore similique libero nihil. Vel perspiciatis non quis quos dicta eaque natus. Reiciendis ut corporis dolor id quod.', 7, 'blog_post', 'draft', NULL, 'Et maiores ut cumque magni unde consequatur neque ut. Et quidem voluptatibus est labore vitae recusandae nemo quidem.', NULL, NULL, '2025-01-21 23:12:19', '2024-11-28 13:30:58'),
(15, 'CHƯƠNG TRÌNH MEMBERSHIP', 'chuong-trinh-membership', '<div id=\"text-1736945768\" class=\"text\">\r\n<p style=\"text-align: center;\"><strong>CHƯƠNG TR&Igrave;NH MEMBERSHIP</strong></p>\r\n<p style=\"text-align: center;\">Ưu đ&atilde;i độc quyền | Trải nghiệm c&aacute; nh&acirc;n h&oacute;a</p>\r\n</div>\r\n<div id=\"image_681908090\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/07/membership-1400x788.webp\" sizes=\"(max-width: 1020px) 100vw, 1020px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/membership-1400x788.webp 1400w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-711x400.webp 711w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-768x432.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-1536x864.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-300x169.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-600x338.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/membership.webp 2000w\" alt=\"\" width=\"1020\" height=\"574\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/07/membership-1400x788.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/membership-1400x788.webp 1400w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-711x400.webp 711w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-768x432.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-1536x864.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-300x169.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/membership-600x338.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/membership.webp 2000w\"></div>\r\n</div>\r\n<div id=\"image_467306814\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\">&nbsp;</div>\r\n</div>\r\n<div id=\"text-465319644\" class=\"text\" style=\"text-align: center;\">\r\n<p><strong>Nh&agrave; Xinh h&acirc;n hạnh giới thiệu Chương tr&igrave;nh Membership &ndash; cầu nối d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng tinh tế, nơi ưu đ&atilde;i độc quyền gặp gỡ trải nghiệm c&aacute; nh&acirc;n h&oacute;a đẳng cấp.</strong></p>\r\n<p>🎁&nbsp;<strong>Ưu Đ&atilde;i Đặc Quyền &ndash; Trải Nghiệm Kh&aacute;c Biệt</strong><strong><br></strong>Trở th&agrave;nh th&agrave;nh vi&ecirc;n, bạn sẽ tận hưởng ngay mức giảm đặc biệt từ&nbsp;5-25% cho tất cả sản phẩm. Đ&acirc;y l&agrave; cơ hội tuyệt vời để n&acirc;ng tầm kh&ocirc;ng gian sống của bạn.</p>\r\n<p>✨&nbsp;<strong>Dịch Vụ C&aacute; Nh&acirc;n H&oacute;a Ri&ecirc;ng Biệt</strong><strong><br></strong>Membership kh&ocirc;ng chỉ mang đến ưu đ&atilde;i vượt trội, m&agrave; c&ograve;n mở ra trải nghiệm trọn vẹn &ndash; từ tư vấn thiết kế, lựa chọn chất liệu đến những gợi &yacute; tinh tế, ph&ugrave; hợp với phong c&aacute;ch sống của ri&ecirc;ng bạn.</p>\r\n<p><strong>Đăng K&yacute; Th&agrave;nh Vi&ecirc;n &ndash; Nhận Ngay Ưu Đ&atilde;i</strong></p>\r\n</div>\r\n<p style=\"text-align: center;\"><a class=\"button success box-shadow-2\" href=\"https://akacompany.com.vn/en/contactus-nhaxinh\">Đăng k&yacute;</a></p>\r\n<div id=\"text-1585945835\" class=\"text\" style=\"text-align: center;\">\r\n<p><strong>Ngo&agrave;i việc ưu đ&atilde;i tr&ecirc;n &ndash; Ri&ecirc;ng với d&ograve;ng sản phẩm Coastal sẽ c&oacute; mức ưu đ&atilde;i hấp dẫn chưa từng c&oacute;!</strong></p>\r\n</div>\r\n<div id=\"image_716715260\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-1267x800.webp\" sizes=\"(max-width: 1020px) 100vw, 1020px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-1267x800.webp 1267w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-634x400.webp 634w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-768x485.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-300x189.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-600x379.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1.webp 1500w\" alt=\"\" width=\"1020\" height=\"644\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-1267x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-1267x800.webp 1267w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-634x400.webp 634w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-768x485.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-300x189.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1-600x379.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal1.webp 1500w\"></div>\r\n</div>\r\n<div id=\"text-3956838908\" class=\"text\" style=\"text-align: center;\">\r\n<p><em>Sofa g&oacute;c phải Coastal&nbsp;</em></p>\r\n</div>\r\n<div id=\"text-3599828596\" class=\"text\" style=\"text-align: center;\">\r\n<p>Chạm đường n&eacute;t &amp; Cảm chiều s&acirc;u từ Bộ sưu tập Coastal &ndash; Với ưu đ&atilde;i đặc quyền khi đăng k&yacute; Th&agrave;nh Vi&ecirc;n</p>\r\n</div>\r\n<div id=\"row-916176260\" class=\"row\" style=\"text-align: center;\">\r\n<div id=\"col-1989195561\" class=\"col medium-6 small-12 large-6\">\r\n<div class=\"col-inner text-right\">\r\n<div id=\"image_372043925\" class=\"img has-hover x md-x lg-x y md-y lg-y\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-472x800.webp\" sizes=\"(max-width: 472px) 100vw, 472px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-472x800.webp 472w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-236x400.webp 236w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-768x1302.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-906x1536.webp 906w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-300x509.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-600x1017.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7.webp 1200w\" alt=\"\" width=\"472\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-472x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-472x800.webp 472w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-236x400.webp 236w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-768x1302.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-906x1536.webp 906w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-300x509.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-600x1017.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7.webp 1200w\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"col-1595323255\" class=\"col medium-6 small-12 large-6\">\r\n<div class=\"col-inner text-left\">\r\n<div id=\"image_2076661734\" class=\"img has-hover x md-x lg-x y md-y lg-y\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-472x800.webp\" sizes=\"(max-width: 472px) 100vw, 472px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-472x800.webp 472w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-236x400.webp 236w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-768x1302.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-906x1536.webp 906w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-300x509.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-600x1017.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1.webp 1100w\" alt=\"\" width=\"472\" height=\"800\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-472x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-472x800.webp 472w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-236x400.webp 236w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-768x1302.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-906x1536.webp 906w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-300x509.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1-600x1017.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal7-1.webp 1100w\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"text-178451524\" class=\"text\" style=\"text-align: center;\">\r\n<p>Với thiết kế mềm mại, t&ocirc;ng vải dịu m&aacute;t chi tiết trau chuốt tỉ mỉ nhằm n&acirc;ng đỡ gia chủ một c&aacute;ch &ecirc;m &aacute;i, Coastal tạo n&ecirc;n sự tương phản h&agrave;i h&ograve;a &ndash; vừa gần gũi, vừa sang trọng.</p>\r\n<p><br><br></p>\r\n</div>\r\n<div id=\"image_365130778\" class=\"img has-hover x md-x lg-x y md-y lg-y\" style=\"text-align: center;\">\r\n<div class=\"img-inner dark\"><img class=\"attachment-large size-large lazy-load-active\" src=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-1116x800.webp\" sizes=\"(max-width: 1020px) 100vw, 1020px\" srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-1116x800.webp 1116w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-558x400.webp 558w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-768x551.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-1536x1101.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-300x215.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-600x430.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8.webp 1700w\" alt=\"\" width=\"1020\" height=\"731\" data-src=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-1116x800.webp\" data-srcset=\"https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-1116x800.webp 1116w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-558x400.webp 558w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-768x551.webp 768w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-1536x1101.webp 1536w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-300x215.webp 300w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8-600x430.webp 600w, https://nhaxinh.com/wp-content/uploads/2025/07/Bo-suu-tap-Coastal8.webp 1700w\"></div>\r\n</div>\r\n<p style=\"text-align: center;\"><strong>Sofa COASTAL G&oacute;c Phải 2m9 &ndash; VACT 4251&nbsp;</strong></p>\r\n<p style=\"text-align: center;\"><strong>GI&aacute; ni&ecirc;m yết:</strong>&nbsp;44.900.000&nbsp;<strong>Giảm c&ograve;n:</strong>&nbsp;20.410.000</p>\r\n<p style=\"text-align: center;\">Chỉ &aacute;p dụng cho th&agrave;nh vi&ecirc;n.</p>', 12, 'blog_post', 'published', 'CHƯƠNG TRÌNH MEMBERSHIP', 'Ưu đãi độc quyền | Trải nghiệm cá nhân hóa', 'pages/lBbAyswjYraLGckD6D4l4UCn0iyq17oYFxdC9nYn.jpg', '2024-07-19 05:10:00', '2025-06-28 19:21:29', '2025-07-26 06:56:26'),
(16, 'CHÍNH SÁCH ĐỔI TRẢ HÀNG', 'chinh-sach-oi-tra-hang', '<p><strong>1. C&Aacute;C TRƯỜNG HỢP ĐƯỢC TRẢ H&Agrave;NG, ĐỔI H&Agrave;NG</strong></p>\r\n<ul>\r\n<li>Sản phẩm kh&ocirc;ng thể đưa v&agrave;o nh&agrave; được (do cầu thang hẹp, cửa hẹp,&hellip;)</li>\r\n<li>Kh&ocirc;ng đủ số lượng, kh&ocirc;ng đủ bộ như trong đơn h&agrave;ng.</li>\r\n<li>H&agrave;ng bị lỗi, kh&ocirc;ng đạt chất lượng.</li>\r\n</ul>\r\n<p><strong>2. C&Aacute;C TRƯỜNG HỢP KH&Ocirc;NG ĐƯỢC ĐỔI HOẶC TRẢ</strong></p>\r\n<ul>\r\n<li>H&agrave;ng đ&atilde; sử dụng, dơ, cũ hoặc hư hại.</li>\r\n<li>Kh&ocirc;ng c&oacute; đầy đủ c&aacute;c h&oacute;a đơn, chứng từ.</li>\r\n<li>H&agrave;ng b&aacute;n khuyến mại.</li>\r\n</ul>\r\n<p><strong>3. THỜI GIAN V&Agrave; THỦ TỤC ĐỔI, TRẢ H&Agrave;NG</strong></p>\r\n<p>Thời gian được ph&eacute;p đổi, trả h&agrave;ng: trong v&ograve;ng 3 ng&agrave;y kể từ ng&agrave;y giao h&agrave;ng, trước khi xuất h&oacute;a đơn.</p>\r\n<p>Thủ tục đổi, trả h&agrave;ng:</p>\r\n<ul>\r\n<li>Khi c&oacute; y&ecirc;u cầu đổi, trả h&agrave;ng, xin qu&yacute; kh&aacute;ch vui l&ograve;ng li&ecirc;n hệ với cửa h&agrave;ng Funori đ&atilde; giao dịch.</li>\r\n<li>Funori chịu chi ph&iacute; ph&aacute;t sinh dịch vụ đổi, trả h&agrave;ng.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://nhaxinh.com/wp-content/uploads/2022/04/1-1-533x800.jpg\" alt=\"Armchair Tudor m&agrave;u hồng nhạt kiểu d&aacute;ng thanh nh&atilde;\"></p>', 12, 'blog_post', 'published', 'CHÍNH SÁCH ĐỔI TRẢ HÀNG', 'Với mong muốn đảm bảo quyền lợi cho khách hàng và nâng cao chất lượng dịch vụ, quý khách có thể trả hoặc đổi hàng để có được sự thoải mái và hài lòng nhất tại Funori.', 'pages/ojIGJTtxMJWcXqBZvbyfZC9XfLiZSK0WMA6qrqxX.jpg', '2025-08-25 17:08:00', '2025-08-25 17:08:51', '2025-08-25 17:15:14');

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
(4, 'App\\Models\\Shipper', 2, 'shipper-app-token', 'a6c5dd89b9abcecf9e37b4a28b46fb28f14bcf2ccb93f3a0fa938333b74cd07e', '[\"*\"]', '2025-08-25 17:20:28', NULL, '2025-08-23 15:43:53', '2025-08-25 17:20:28');

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
(74, 'Giường Leman 1m82', 'giuong-leman-1m82', 'Giường ngủ thiết kế hiện đại, khung chắc chắn, mang lại cảm giác êm ái và thư giãn tối đa.', 'Giường ngủ là trung tâm của không gian phòng ngủ, nơi bạn nghỉ ngơi sau một ngày dài làm việc. Với thiết kế chú trọng đến sự thoải mái và thẩm mỹ, giường được chế tác từ chất liệu cao cấp như gỗ tự nhiên, MDF phủ melamine, hoặc khung kim loại sơn tĩnh điện, đảm bảo độ bền và chắc chắn. Đệm giường có thể tùy chọn theo nhu cầu, kết hợp với vạt giường chắc khỏe giúp nâng đỡ cơ thể tối ưu. Nhiều mẫu giường tích hợp hộc kéo hoặc ngăn chứa đồ tiện lợi, giúp tối ưu diện tích không gian. Thiết kế đầu giường êm ái, kiểu dáng từ tối giản đến sang trọng phù hợp với nhiều phong cách nội thất. Giường ngủ không chỉ là nơi thư giãn mà còn thể hiện gu thẩm mỹ và cá tính riêng của chủ nhân.', '17000000.00', NULL, 20, 8, 'draft', 0, 0, '2025-07-10 02:13:19', '2025-08-23 17:21:56'),
(75, 'Giường Ona Him 1m8', 'giuong-ona-him-1m8', 'Giường ngủ thiết kế hiện đại, khung chắc chắn, mang lại cảm giác êm ái và thư giãn tối đa.', 'Giường ngủ là trung tâm của không gian phòng ngủ, nơi bạn nghỉ ngơi sau một ngày dài làm việc. Với thiết kế chú trọng đến sự thoải mái và thẩm mỹ, giường được chế tác từ chất liệu cao cấp như gỗ tự nhiên, MDF phủ melamine, hoặc khung kim loại sơn tĩnh điện, đảm bảo độ bền và chắc chắn. Đệm giường có thể tùy chọn theo nhu cầu, kết hợp với vạt giường chắc khỏe giúp nâng đỡ cơ thể tối ưu. Nhiều mẫu giường tích hợp hộc kéo hoặc ngăn chứa đồ tiện lợi, giúp tối ưu diện tích không gian. Thiết kế đầu giường êm ái, kiểu dáng từ tối giản đến sang trọng phù hợp với nhiều phong cách nội thất. Giường ngủ không chỉ là nơi thư giãn mà còn thể hiện gu thẩm mỹ và cá tính riêng của chủ nhân.', '19999999.00', NULL, 20, 7, 'published', 0, 0, '2025-07-10 02:14:42', '2025-07-10 02:14:42'),
(76, 'Giường ngủ bọc vải Softly 1m8', 'giuong-ngu-boc-vai-softly-1m8', 'Giường ngủ thiết kế hiện đại, khung chắc chắn, mang lại cảm giác êm ái và thư giãn tối đa.', 'Giường ngủ là trung tâm của không gian phòng ngủ, nơi bạn nghỉ ngơi sau một ngày dài làm việc. Với thiết kế chú trọng đến sự thoải mái và thẩm mỹ, giường được chế tác từ chất liệu cao cấp như gỗ tự nhiên, MDF phủ melamine, hoặc khung kim loại sơn tĩnh điện, đảm bảo độ bền và chắc chắn. Đệm giường có thể tùy chọn theo nhu cầu, kết hợp với vạt giường chắc khỏe giúp nâng đỡ cơ thể tối ưu. Nhiều mẫu giường tích hợp hộc kéo hoặc ngăn chứa đồ tiện lợi, giúp tối ưu diện tích không gian. Thiết kế đầu giường êm ái, kiểu dáng từ tối giản đến sang trọng phù hợp với nhiều phong cách nội thất. Giường ngủ không chỉ là nơi thư giãn mà còn thể hiện gu thẩm mỹ và cá tính riêng của chủ nhân.', '26000000.00', NULL, 20, 9, 'published', 0, 0, '2025-07-10 02:17:05', '2025-07-31 15:12:34'),
(77, 'Giường ngủ Wynn 1m8', 'giuong-ngu-wynn-1m8', 'Giường ngủ thiết kế hiện đại, khung chắc chắn, mang lại cảm giác êm ái và thư giãn tối đa.', 'Giường ngủ là trung tâm của không gian phòng ngủ, nơi bạn nghỉ ngơi sau một ngày dài làm việc. Với thiết kế chú trọng đến sự thoải mái và thẩm mỹ, giường được chế tác từ chất liệu cao cấp như gỗ tự nhiên, MDF phủ melamine, hoặc khung kim loại sơn tĩnh điện, đảm bảo độ bền và chắc chắn. Đệm giường có thể tùy chọn theo nhu cầu, kết hợp với vạt giường chắc khỏe giúp nâng đỡ cơ thể tối ưu. Nhiều mẫu giường tích hợp hộc kéo hoặc ngăn chứa đồ tiện lợi, giúp tối ưu diện tích không gian. Thiết kế đầu giường êm ái, kiểu dáng từ tối giản đến sang trọng phù hợp với nhiều phong cách nội thất. Giường ngủ không chỉ là nơi thư giãn mà còn thể hiện gu thẩm mỹ và cá tính riêng của chủ nhân.', '32000000.00', NULL, 20, 8, 'published', 0, 0, '2025-07-10 02:18:23', '2025-07-10 02:18:23'),
(80, 'Sofa Leman 1m883', 'sofa-leman-1m883', 'zSofa hiện đại, thiết kế tinh tế, chất liệu cao cấp, mang đến sự thoải mái và sang trọng cho không gian sống.', 'Mang đến sự kết hợp hoàn hảo giữa phong cách và tiện nghi, bộ sofa cao cấp được thiết kế theo xu hướng hiện đại, phù hợp với nhiều không gian như phòng khách, văn phòng hoặc căn hộ chung cư. Khung ghế chắc chắn, được làm từ gỗ tự nhiên chống mối mọt, kết hợp với đệm ngồi êm ái và vải bọc chất lượng cao giúp tăng độ bền và tạo cảm giác thoải mái khi sử dụng. Đường may tinh xảo, màu sắc trang nhã, dễ dàng phối hợp với nhiều phong cách nội thất. Đây không chỉ là nơi thư giãn mà còn là điểm nhấn thẩm mỹ cho ngôi nhà của bạn.', '17000000.00', NULL, 16, 8, 'published', 0, 0, '2025-08-25 16:31:40', '2025-08-25 16:41:33');

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
(360, 80, 'images/products/68ac8fec832fe_1756139500.jpg', NULL, 0, 0, '2025-08-25 16:31:40', '2025-08-25 16:31:40'),
(361, 80, 'images/products/68ac8fec85b3c_1756139500.png', NULL, 0, 0, '2025-08-25 16:31:40', '2025-08-25 16:31:40'),
(362, 80, 'images/products/68ac8fec86a4f_1756139500.jpg', NULL, 0, 0, '2025-08-25 16:31:40', '2025-08-25 16:31:40'),
(363, 80, 'images/products/68ac8fec875de_1756139500.jpg', NULL, 0, 0, '2025-08-25 16:31:40', '2025-08-25 16:31:40');

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
(34, 'Vải Xám MB2041-17', 29, '0.00', 13, 70, 'D2200 - R950 - C750 mm', '2025-07-09 18:26:41', '2025-08-25 16:59:16'),
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
(76, NULL, 42, '0.00', 12, 160, 'D320 - R320 - C535 mm', '2025-07-10 01:02:55', '2025-08-25 15:56:30'),
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
(95, 'ĐEN', 55, '0.00', 22, 226, 'D572 - R552 - C730mm', '2025-07-10 01:28:09', '2025-08-24 15:26:40'),
(96, 'Gỗ nâu Da cognac', 56, '0.00', 22, 233, 'D560 - R480 - C770mm', '2025-07-10 01:31:19', '2025-07-10 01:31:19'),
(97, 'Gỗ màu Tự nhiên Da đen', 56, '0.00', 33, 234, 'D560 - R480 - C770mm', '2025-07-10 01:31:19', '2025-07-10 01:31:19'),
(98, 'Có tay Gỗ nâu Da cognac', 56, '0.00', 11, 235, 'D560 - R480 - C770mm', '2025-07-10 01:31:19', '2025-07-10 01:31:19'),
(99, NULL, 57, '0.00', 13, 239, 'D1600 - R800 - C755 mm', '2025-07-10 01:35:00', '2025-07-26 06:31:03'),
(100, NULL, 58, '0.00', 12, 243, 'D2250 - R950 - C750 mm', '2025-07-10 01:42:30', '2025-07-10 01:42:30'),
(101, NULL, 59, '0.00', 35, 250, 'D2300 - R950 - C750 mm', '2025-07-10 01:43:33', '2025-07-10 01:43:33'),
(102, NULL, 60, '0.00', 11, 256, 'D3000 - R1000 - C770mm', '2025-07-10 01:44:55', '2025-07-10 01:44:55'),
(103, NULL, 61, '0.00', 34, 263, 'D1400- R800- C750 mm', '2025-07-10 01:46:28', '2025-07-10 01:46:28'),
(104, NULL, 62, '0.00', 13, 267, 'D2000 - R1000 - C750 mm', '2025-07-10 01:47:33', '2025-07-10 01:47:33'),
(105, 'Đá thạch anh', 63, '4000000.00', 13, 272, 'D1600-R900-C750', '2025-07-10 01:50:13', '2025-08-25 15:36:38'),
(106, 'Kính', 63, '0.00', 21, 273, 'D1600-R900-C750', '2025-07-10 01:50:13', '2025-08-23 01:40:30'),
(107, NULL, 64, '0.00', 9, 277, 'D2000 - R1000 - C755 mm', '2025-07-10 01:51:16', '2025-08-23 02:12:44'),
(108, 'mẫu 2', 65, '0.00', 14, 281, 'D2200- R900- C740 mm', '2025-07-10 01:52:23', '2025-08-23 17:34:55'),
(109, NULL, 66, '0.00', 9, 287, 'D2000 - R550 - C562 mm', '2025-07-10 02:02:03', '2025-08-23 16:53:50'),
(110, NULL, 67, '0.00', 0, 291, 'D1800 - R450 - C510 mm', '2025-07-10 02:02:57', '2025-07-26 04:50:54'),
(111, NULL, 68, '0.00', 0, 294, 'D1800 - R450 - C568 mm', '2025-07-10 02:03:44', '2025-07-10 02:03:44'),
(112, NULL, 69, '0.00', 3, 300, 'D1800 - R420 - C560 mm', '2025-07-10 02:04:32', '2025-08-25 14:55:15'),
(113, 'Màu nâu', 70, '0.00', 14, 305, 'D1745 - R420 - C430 mm', '2025-07-10 02:05:53', '2025-07-10 02:05:53'),
(114, 'Màu tự nhiên', 70, '0.00', 13, 306, 'D1745 - R420 - C430 mm', '2025-07-10 02:05:53', '2025-07-10 02:05:53'),
(115, 'Màu nâu', 71, '0.00', 5, 312, 'D1800 - R450 - C450 mm', '2025-07-10 02:07:28', '2025-08-23 09:05:45'),
(116, 'Màu gỗ tự nhiên', 71, '0.00', 5, 313, 'D1800 - R450 - C450 mm', '2025-07-10 02:07:28', '2025-07-10 02:07:28'),
(117, NULL, 72, '0.00', 1, 318, 'D1700-R450-C500mm', '2025-07-10 02:08:50', '2025-08-24 14:06:33'),
(118, NULL, 73, '0.00', 14, 324, 'D1850-R450-C480 mm', '2025-07-10 02:09:46', '2025-08-25 15:39:33'),
(119, 'VACT4328', 74, '0.00', 5, 328, 'D2000 - R1800 - C1070 (mm)', '2025-07-10 02:13:19', '2025-07-10 02:13:19'),
(120, 'VACT4334', 74, '0.00', 0, 329, 'D2000 - R1800 - C1070 (mm)', '2025-07-10 02:13:19', '2025-07-10 02:13:19'),
(121, 'VACT43564', 74, '0.00', 10, 330, 'D2000 - R1800 - C1070 (mm)', '2025-07-10 02:13:19', '2025-07-26 15:29:08'),
(122, 'da nâu S3', 75, '0.00', 4, 335, 'D2000 - R1800 - C940 mm', '2025-07-10 02:14:42', '2025-08-23 16:52:10'),
(123, 'da xanh S4', 75, '0.00', 5, 336, 'D2000 - R1800 - C940 mm', '2025-07-10 02:14:42', '2025-08-23 01:40:30'),
(124, 'Blue S9C', 76, '0.00', 1, 341, 'D2000-R1600-C1070 mm', '2025-07-10 02:17:05', '2025-08-24 15:26:40'),
(125, 'Blue S9C', 76, '0.00', 1, 342, 'D2000-R1600-C1070 mm', '2025-07-10 02:17:05', '2025-08-25 15:35:29'),
(126, 'mint', 76, '1000000.00', 0, 343, 'D2000-R1600-C1070 mm', '2025-07-10 02:17:05', '2025-07-26 15:27:02'),
(127, 'MB515', 77, '0.00', 0, 346, 'D2000- R1800- C1140 mm', '2025-07-10 02:18:23', '2025-08-23 01:40:30'),
(128, 'MB520 sand', 77, '0.00', 2, 347, 'D2000- R1800- C1140 mm', '2025-07-10 02:18:23', '2025-07-26 04:43:12'),
(131, 'Xanh Navi', 80, '0.00', 34, 363, 'D2000 - R1800 - C1070 (mm)', '2025-08-25 16:31:40', '2025-08-25 16:31:40');

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
(132, 131, 4, NULL, NULL);

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
(4, 'MOMO12332252', 'MOMO123', 'dFESRGTHYTGRFDAFRG', 'percentage', '50.00', '2000000.00', '20000000.00', 24, 2, 0, '2025-07-27 00:00:00', '2025-08-28 00:00:00', 1, 'all_products', '2025-08-01 05:47:08', '2025-08-01 05:47:08'),
(5, 'VNPAY', 'VNPAY1234', 'VNPAY', 'percentage', '50.00', '2000000.00', '15000000.00', 25, 1, 0, '2025-08-18 00:00:00', '2025-09-02 00:00:00', 1, 'specific_brands', '2025-08-25 16:33:35', '2025-08-25 16:33:35'),
(6, 'VNPAYVIP', 'VNPAY999', 'VIP', 'percentage', '40.00', '5000000.00', '25000000.00', 25, 1, 0, '2025-08-18 00:00:00', '2025-09-02 00:00:00', 1, 'specific_brands', '2025-08-25 16:39:39', '2025-08-25 16:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `promotion_brand`
--

CREATE TABLE `promotion_brand` (
  `promotion_id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promotion_brand`
--

INSERT INTO `promotion_brand` (`promotion_id`, `brand_id`) VALUES
(6, 3),
(5, 8);

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
-- Table structure for table `refunds`
--

CREATE TABLE `refunds` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `gateway` enum('momo','vnpay','manual') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `status` enum('pending','success','failed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refund_transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_response` text COLLATE utf8mb4_unicode_ci,
  `error_message` text COLLATE utf8mb4_unicode_ci,
  `refunded_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `refunds`
--

INSERT INTO `refunds` (`id`, `order_id`, `gateway`, `amount`, `status`, `transaction_id`, `refund_transaction_id`, `gateway_response`, `error_message`, `refunded_at`, `created_at`, `updated_at`) VALUES
(1, 51, 'vnpay', '26000000.00', 'failed', '15144315', NULL, '{\"reason\":\"Kh\\u00f4ng c\\u00f2n nhu c\\u1ea7u s\\u1eed d\\u1ee5ng s\\u1ea3n ph\\u1ea9m\",\"type\":\"pending_refund\",\"note\":\"Ch\\u1edd admin x\\u1eed l\\u00fd ho\\u00e0n ti\\u1ec1n\",\"admin_attempted\":true,\"attempted_by\":12,\"attempted_at\":\"2025-08-23T08:53:49.251358Z\",\"admin_note\":null,\"error\":\"HTTP 404: <!DOCTYPE html PUBLIC \\\"-\\/\\/W3C\\/\\/DTD XHTML 1.0 Strict\\/\\/EN\\\" \\\"http:\\/\\/www.w3.org\\/TR\\/xhtml1\\/DTD\\/xhtml1-strict.dtd\\\">\\r\\n<html xmlns=\\\"http:\\/\\/www.w3.org\\/1999\\/xhtml\\\">\\r\\n<head>\\r\\n<meta http-equiv=\\\"Content-Type\\\" content=\\\"text\\/html; charset=iso-8859-1\\\"\\/>\\r\\n<title>404 - File or directory not found.<\\/title>\\r\\n<style type=\\\"text\\/css\\\">\\r\\n<!--\\r\\nbody{margin:0;font-size:.7em;font-family:Verdana, Arial, Helvetica, sans-serif;background:#EEEEEE;}\\r\\nfieldset{padding:0 15px 10px 15px;} \\r\\nh1{font-size:2.4em;margin:0;color:#FFF;}\\r\\nh2{font-size:1.7em;margin:0;color:#CC0000;} \\r\\nh3{font-size:1.2em;margin:10px 0 0 0;color:#000000;} \\r\\n#header{width:96%;margin:0 0 0 0;padding:6px 2% 6px 2%;font-family:\\\"trebuchet MS\\\", Verdana, sans-serif;color:#FFF;\\r\\nbackground-color:#555555;}\\r\\n#content{margin:0 0 0 2%;position:relative;}\\r\\n.content-container{background:#FFF;width:96%;margin-top:8px;padding:10px;position:relative;}\\r\\n-->\\r\\n<\\/style>\\r\\n<\\/head>\\r\\n<body>\\r\\n<div id=\\\"header\\\"><h1>Server Error<\\/h1><\\/div>\\r\\n<div id=\\\"content\\\">\\r\\n <div class=\\\"content-container\\\"><fieldset>\\r\\n  <h2>404 - File or directory not found.<\\/h2>\\r\\n  <h3>The resource you are looking for might have been removed, had its name changed, or is temporarily unavailable.<\\/h3>\\r\\n <\\/fieldset><\\/div>\\r\\n<\\/div>\\r\\n<\\/body>\\r\\n<\\/html>\\r\\n\"}', 'HTTP 404: <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"/>\r\n<title>404 - File or directory not found.</title>\r\n<style type=\"text/css\">\r\n<!--\r\nbody{margin:0;font-size:.7em;font-family:Verdana, Arial, Helvetica, sans-serif;background:#EEEEEE;}\r\nfieldset{padding:0 15px 10px 15px;} \r\nh1{font-size:2.4em;margin:0;color:#FFF;}\r\nh2{font-size:1.7em;margin:0;color:#CC0000;} \r\nh3{font-size:1.2em;margin:10px 0 0 0;color:#000000;} \r\n#header{width:96%;margin:0 0 0 0;padding:6px 2% 6px 2%;font-family:\"trebuchet MS\", Verdana, sans-serif;color:#FFF;\r\nbackground-color:#555555;}\r\n#content{margin:0 0 0 2%;position:relative;}\r\n.content-container{background:#FFF;width:96%;margin-top:8px;padding:10px;position:relative;}\r\n-->\r\n</style>\r\n</head>\r\n<body>\r\n<div id=\"header\"><h1>Server Error</h1></div>\r\n<div id=\"content\">\r\n <div class=\"content-container\"><fieldset>\r\n  <h2>404 - File or directory not found.</h2>\r\n  <h3>The resource you are looking for might have been removed, had its name changed, or is temporarily unavailable.</h3>\r\n </fieldset></div>\r\n</div>\r\n</body>\r\n</html>\r\n', NULL, '2025-08-23 08:51:20', '2025-08-23 08:53:49'),
(2, 50, 'vnpay', '24060000.00', 'failed', '15143761', NULL, '{\"reason\":\"Thay \\u0111\\u1ed5i \\u0111\\u1ecba ch\\u1ec9 ho\\u1eb7c th\\u00f4ng tin nh\\u1eadn h\\u00e0ng\",\"type\":\"pending_refund\",\"note\":\"Ch\\u1edd admin x\\u1eed l\\u00fd ho\\u00e0n ti\\u1ec1n\",\"admin_attempted\":true,\"attempted_by\":12,\"attempted_at\":\"2025-08-23T08:58:31.266158Z\",\"admin_note\":\"yyyy\",\"error\":\"HTTP 404: <!DOCTYPE html PUBLIC \\\"-\\/\\/W3C\\/\\/DTD XHTML 1.0 Strict\\/\\/EN\\\" \\\"http:\\/\\/www.w3.org\\/TR\\/xhtml1\\/DTD\\/xhtml1-strict.dtd\\\">\\r\\n<html xmlns=\\\"http:\\/\\/www.w3.org\\/1999\\/xhtml\\\">\\r\\n<head>\\r\\n<meta http-equiv=\\\"Content-Type\\\" content=\\\"text\\/html; charset=iso-8859-1\\\"\\/>\\r\\n<title>404 - File or directory not found.<\\/title>\\r\\n<style type=\\\"text\\/css\\\">\\r\\n<!--\\r\\nbody{margin:0;font-size:.7em;font-family:Verdana, Arial, Helvetica, sans-serif;background:#EEEEEE;}\\r\\nfieldset{padding:0 15px 10px 15px;} \\r\\nh1{font-size:2.4em;margin:0;color:#FFF;}\\r\\nh2{font-size:1.7em;margin:0;color:#CC0000;} \\r\\nh3{font-size:1.2em;margin:10px 0 0 0;color:#000000;} \\r\\n#header{width:96%;margin:0 0 0 0;padding:6px 2% 6px 2%;font-family:\\\"trebuchet MS\\\", Verdana, sans-serif;color:#FFF;\\r\\nbackground-color:#555555;}\\r\\n#content{margin:0 0 0 2%;position:relative;}\\r\\n.content-container{background:#FFF;width:96%;margin-top:8px;padding:10px;position:relative;}\\r\\n-->\\r\\n<\\/style>\\r\\n<\\/head>\\r\\n<body>\\r\\n<div id=\\\"header\\\"><h1>Server Error<\\/h1><\\/div>\\r\\n<div id=\\\"content\\\">\\r\\n <div class=\\\"content-container\\\"><fieldset>\\r\\n  <h2>404 - File or directory not found.<\\/h2>\\r\\n  <h3>The resource you are looking for might have been removed, had its name changed, or is temporarily unavailable.<\\/h3>\\r\\n <\\/fieldset><\\/div>\\r\\n<\\/div>\\r\\n<\\/body>\\r\\n<\\/html>\\r\\n\"}', 'HTTP 404: <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"/>\r\n<title>404 - File or directory not found.</title>\r\n<style type=\"text/css\">\r\n<!--\r\nbody{margin:0;font-size:.7em;font-family:Verdana, Arial, Helvetica, sans-serif;background:#EEEEEE;}\r\nfieldset{padding:0 15px 10px 15px;} \r\nh1{font-size:2.4em;margin:0;color:#FFF;}\r\nh2{font-size:1.7em;margin:0;color:#CC0000;} \r\nh3{font-size:1.2em;margin:10px 0 0 0;color:#000000;} \r\n#header{width:96%;margin:0 0 0 0;padding:6px 2% 6px 2%;font-family:\"trebuchet MS\", Verdana, sans-serif;color:#FFF;\r\nbackground-color:#555555;}\r\n#content{margin:0 0 0 2%;position:relative;}\r\n.content-container{background:#FFF;width:96%;margin-top:8px;padding:10px;position:relative;}\r\n-->\r\n</style>\r\n</head>\r\n<body>\r\n<div id=\"header\"><h1>Server Error</h1></div>\r\n<div id=\"content\">\r\n <div class=\"content-container\"><fieldset>\r\n  <h2>404 - File or directory not found.</h2>\r\n  <h3>The resource you are looking for might have been removed, had its name changed, or is temporarily unavailable.</h3>\r\n </fieldset></div>\r\n</div>\r\n</body>\r\n</html>\r\n', NULL, '2025-08-23 08:57:41', '2025-08-23 08:58:31'),
(3, 52, 'manual', '0.00', 'cancelled', NULL, NULL, '{\"reason\":\"T\\u00ecm th\\u1ea5y s\\u1ea3n ph\\u1ea9m t\\u01b0\\u01a1ng t\\u1ef1 v\\u1edbi gi\\u00e1 t\\u1ed1t h\\u01a1n\",\"type\":\"order_cancellation\"}', NULL, NULL, '2025-08-23 09:02:54', '2025-08-23 09:02:54'),
(5, 53, 'vnpay', '19029999.00', 'failed', '15144337', NULL, '{\"reason\":\"Th\\u1eddi gian giao h\\u00e0ng qu\\u00e1 l\\u00e2u\",\"type\":\"pending_refund\",\"note\":\"Ch\\u1edd admin x\\u1eed l\\u00fd ho\\u00e0n ti\\u1ec1n\",\"admin_attempted\":true,\"attempted_by\":12,\"attempted_at\":\"2025-08-23T09:10:53.594240Z\",\"admin_note\":null,\"error\":\"HTTP 404: <!DOCTYPE html PUBLIC \\\"-\\/\\/W3C\\/\\/DTD XHTML 1.0 Strict\\/\\/EN\\\" \\\"http:\\/\\/www.w3.org\\/TR\\/xhtml1\\/DTD\\/xhtml1-strict.dtd\\\">\\r\\n<html xmlns=\\\"http:\\/\\/www.w3.org\\/1999\\/xhtml\\\">\\r\\n<head>\\r\\n<meta http-equiv=\\\"Content-Type\\\" content=\\\"text\\/html; charset=iso-8859-1\\\"\\/>\\r\\n<title>404 - File or directory not found.<\\/title>\\r\\n<style type=\\\"text\\/css\\\">\\r\\n<!--\\r\\nbody{margin:0;font-size:.7em;font-family:Verdana, Arial, Helvetica, sans-serif;background:#EEEEEE;}\\r\\nfieldset{padding:0 15px 10px 15px;} \\r\\nh1{font-size:2.4em;margin:0;color:#FFF;}\\r\\nh2{font-size:1.7em;margin:0;color:#CC0000;} \\r\\nh3{font-size:1.2em;margin:10px 0 0 0;color:#000000;} \\r\\n#header{width:96%;margin:0 0 0 0;padding:6px 2% 6px 2%;font-family:\\\"trebuchet MS\\\", Verdana, sans-serif;color:#FFF;\\r\\nbackground-color:#555555;}\\r\\n#content{margin:0 0 0 2%;position:relative;}\\r\\n.content-container{background:#FFF;width:96%;margin-top:8px;padding:10px;position:relative;}\\r\\n-->\\r\\n<\\/style>\\r\\n<\\/head>\\r\\n<body>\\r\\n<div id=\\\"header\\\"><h1>Server Error<\\/h1><\\/div>\\r\\n<div id=\\\"content\\\">\\r\\n <div class=\\\"content-container\\\"><fieldset>\\r\\n  <h2>404 - File or directory not found.<\\/h2>\\r\\n  <h3>The resource you are looking for might have been removed, had its name changed, or is temporarily unavailable.<\\/h3>\\r\\n <\\/fieldset><\\/div>\\r\\n<\\/div>\\r\\n<\\/body>\\r\\n<\\/html>\\r\\n\"}', 'HTTP 404: <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"/>\r\n<title>404 - File or directory not found.</title>\r\n<style type=\"text/css\">\r\n<!--\r\nbody{margin:0;font-size:.7em;font-family:Verdana, Arial, Helvetica, sans-serif;background:#EEEEEE;}\r\nfieldset{padding:0 15px 10px 15px;} \r\nh1{font-size:2.4em;margin:0;color:#FFF;}\r\nh2{font-size:1.7em;margin:0;color:#CC0000;} \r\nh3{font-size:1.2em;margin:10px 0 0 0;color:#000000;} \r\n#header{width:96%;margin:0 0 0 0;padding:6px 2% 6px 2%;font-family:\"trebuchet MS\", Verdana, sans-serif;color:#FFF;\r\nbackground-color:#555555;}\r\n#content{margin:0 0 0 2%;position:relative;}\r\n.content-container{background:#FFF;width:96%;margin-top:8px;padding:10px;position:relative;}\r\n-->\r\n</style>\r\n</head>\r\n<body>\r\n<div id=\"header\"><h1>Server Error</h1></div>\r\n<div id=\"content\">\r\n <div class=\"content-container\"><fieldset>\r\n  <h2>404 - File or directory not found.</h2>\r\n  <h3>The resource you are looking for might have been removed, had its name changed, or is temporarily unavailable.</h3>\r\n </fieldset></div>\r\n</div>\r\n</body>\r\n</html>\r\n', NULL, '2025-08-23 09:10:14', '2025-08-23 09:10:53'),
(6, 54, 'vnpay', '38059998.00', 'success', '15144763', NULL, '{\"vnp_ResponseId\":\"1825287eb0854667aaaa3e92e7aeb279\",\"vnp_Command\":\"refund\",\"vnp_ResponseCode\":\"00\",\"vnp_Message\":\"Refund success\",\"vnp_TmnCode\":\"KUSIX1J4\",\"vnp_TxnRef\":\"ORD-68A9F1B89FE23\",\"vnp_Amount\":\"3805999800\",\"vnp_OrderInfo\":\"Ho\\u00e0n ti\\u1ec1n \\u0111\\u01a1n h\\u00e0ng ORD-68A9F1B89FE23\",\"vnp_BankCode\":\"NCB\",\"vnp_PayDate\":\"20250823235543\",\"vnp_TransactionNo\":\"15144767\",\"vnp_TransactionType\":\"02\",\"vnp_TransactionStatus\":\"05\",\"vnp_SecureHash\":\"b6f55a727714da4eeed1e19827ddb473ec935ae462ea924f94fd24e52088ee4dffd7f60adaff6b10a28f4667e5a1f5979646e78f29e101a37510b9ca5ef3faca\",\"admin_processed\":true,\"processed_by\":12,\"processed_at\":\"2025-08-23T16:55:48.485005Z\",\"admin_note\":\"ngu\"}', NULL, '2025-08-23 16:55:48', '2025-08-23 16:55:13', '2025-08-23 16:55:48'),
(7, 411, 'manual', '0.00', 'cancelled', NULL, NULL, '{\"reason\":\"Thay \\u0111\\u1ed5i \\u0111\\u1ecba ch\\u1ec9 ho\\u1eb7c th\\u00f4ng tin nh\\u1eadn h\\u00e0ng\",\"type\":\"order_cancellation\"}', NULL, NULL, '2025-08-25 15:35:40', '2025-08-25 15:35:40'),
(8, 412, 'vnpay', '16030000.00', 'success', '15148113', NULL, '{\"vnp_ResponseId\":\"f833b11fbffd4cd8b9640c26cdbf50ea\",\"vnp_Command\":\"refund\",\"vnp_ResponseCode\":\"00\",\"vnp_Message\":\"Refund success\",\"vnp_TmnCode\":\"KUSIX1J4\",\"vnp_TxnRef\":\"ORD-68AC830614E9D\",\"vnp_Amount\":\"1603000000\",\"vnp_OrderInfo\":\"Ho\\u00e0n ti\\u1ec1n \\u0111\\u01a1n h\\u00e0ng ORD-68AC830614E9D\",\"vnp_BankCode\":\"NCB\",\"vnp_PayDate\":\"20250825223727\",\"vnp_TransactionNo\":\"15148115\",\"vnp_TransactionType\":\"02\",\"vnp_TransactionStatus\":\"05\",\"vnp_SecureHash\":\"c869c99668370bd076d63d5f2eacd1492f5c3887e62bb4ab7cc4f8fe422457591e491a2231d8698f745575729b4574c6daded947d870dd5ba07ecff6af9f8534\",\"admin_processed\":true,\"processed_by\":12,\"processed_at\":\"2025-08-25T15:37:29.212650Z\",\"admin_note\":\"z\"}', NULL, '2025-08-25 15:37:29', '2025-08-25 15:37:13', '2025-08-25 15:37:29');

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
(31, 12, 75, 61, 4, 'aaaaaaa', 'approved', NULL, NULL, '2025-07-26 05:20:35', '2025-07-26 05:20:58', NULL),
(32, 13, 66, 100, 2, 'sp hay vcl', 'approved', NULL, NULL, '2025-08-23 16:58:40', '2025-08-23 16:59:20', NULL),
(33, 5, 42, 741, 4, 'Perferendis ab quisquam possimus esse accusantium enim id cupiditate aut aut.', 'approved', NULL, NULL, '2025-08-18 20:38:20', '2025-08-24 06:18:58', NULL),
(34, 6, 45, 289, 4, 'Id dolores omnis rerum dignissimos ut eos et tempore.', 'approved', NULL, NULL, '2024-10-17 09:56:23', '2025-08-24 06:18:58', NULL),
(35, 5, 31, 409, 5, 'In consequatur quia qui ut amet eligendi.', 'rejected', NULL, NULL, '2025-03-05 03:31:28', '2025-08-24 06:18:58', NULL),
(36, 50, 62, 1006, 3, 'Tempora ipsum quia explicabo sunt voluptas qui nihil quis molestias voluptatem rerum qui.', 'approved', NULL, NULL, '2024-09-16 04:43:06', '2025-08-24 06:18:58', NULL),
(37, 5, 39, 657, 1, 'Nesciunt eius libero amet voluptates est inventore officiis vitae quibusdam eaque.', 'pending', NULL, NULL, '2024-11-01 10:34:00', '2025-08-24 06:18:58', NULL),
(38, 13, 71, 98, 5, 'Et quis sunt voluptatem nesciunt excepturi et unde libero blanditiis et expedita rerum sapiente.', 'pending', NULL, NULL, '2025-04-02 01:22:44', '2025-08-24 06:18:58', NULL),
(39, 5, 51, 630, 2, 'Voluptatibus omnis dolor qui voluptas in praesentium est nihil et autem ullam dolorum quasi.', 'rejected', NULL, NULL, '2024-11-01 22:42:58', '2025-08-24 06:18:58', NULL),
(40, 4, 26, 206, 1, 'Dignissimos dolores numquam quia voluptas laudantium aut.', 'approved', NULL, NULL, '2024-09-19 14:52:13', '2025-08-24 06:18:58', NULL),
(41, 50, 32, 864, 5, 'Quae assumenda ad deserunt occaecati ad et deleniti temporibus suscipit mollitia aspernatur aliquid voluptatem.', 'rejected', NULL, NULL, '2025-05-05 12:41:52', '2025-08-24 06:18:58', NULL),
(42, 5, 43, 516, 5, 'Sit adipisci sed sunt rerum quidem neque accusantium aut ullam possimus eum.', 'approved', NULL, NULL, '2024-12-11 23:24:24', '2025-08-24 06:18:58', NULL),
(43, 3, 74, 600, 1, 'Suscipit architecto cupiditate quia accusantium nostrum est enim quos provident molestiae minima quae libero.', 'rejected', NULL, NULL, '2025-01-12 03:41:38', '2025-08-24 06:18:58', NULL),
(44, 12, 74, 740, 3, 'Omnis adipisci vitae officiis molestiae sunt perspiciatis saepe aliquid eos cumque quae temporibus consequatur.', 'pending', NULL, NULL, '2025-01-25 23:28:16', '2025-08-24 06:18:58', NULL),
(45, 10, 39, 625, 4, 'Veritatis aut non magnam debitis voluptas vitae dolores cum eos perspiciatis.', 'pending', NULL, NULL, '2025-03-10 20:10:18', '2025-08-24 06:18:58', NULL),
(46, 22, 64, 1017, 2, 'Corrupti unde nisi architecto dolorem porro maxime non in.', 'rejected', NULL, NULL, '2025-04-02 05:19:53', '2025-08-24 06:18:58', NULL),
(47, 3, 29, 604, 2, 'Et aut aut voluptas et dolores optio exercitationem asperiores ut.', 'rejected', NULL, NULL, '2025-01-18 19:59:52', '2025-08-24 06:18:58', NULL),
(48, 22, 62, 994, 1, 'At excepturi fugit accusantium ullam autem eum exercitationem dolor.', 'rejected', NULL, NULL, '2025-06-19 17:40:37', '2025-08-24 06:18:58', NULL),
(49, 62, 72, 1014, 2, 'Sit magni ad vitae et nemo ut quo sed porro voluptatem.', 'rejected', NULL, NULL, '2024-08-28 13:21:51', '2025-08-24 06:18:58', NULL),
(50, 8, 45, 215, 5, 'Soluta dicta labore odio pariatur fugit sunt sunt facilis nisi maiores.', 'approved', NULL, NULL, '2025-05-28 04:26:29', '2025-08-24 06:18:58', NULL),
(51, 4, 58, 645, 1, 'Hic est debitis exercitationem quos quia id error expedita perferendis culpa ut quo saepe non.', 'approved', NULL, NULL, '2024-09-04 23:42:30', '2025-08-24 06:18:58', NULL),
(52, 6, 54, 375, 4, 'Debitis iure enim in distinctio et esse sed nihil et et possimus.', 'rejected', NULL, NULL, '2025-06-24 22:41:34', '2025-08-24 06:18:58', NULL),
(53, 6, 45, 232, 2, 'Ut odit necessitatibus officia itaque veniam rerum ut illo sit perspiciatis dolorem atque.', 'pending', NULL, NULL, '2024-11-26 01:50:12', '2025-08-24 06:18:58', NULL),
(54, 6, 71, 374, 3, 'Et eligendi quod odit quae repellendus odio qui alias dolorum.', 'approved', NULL, NULL, '2024-11-19 21:42:03', '2025-08-24 06:18:58', NULL),
(55, 3, 77, 619, 5, 'Dicta perferendis tempora sint illo consectetur sint est molestiae excepturi facilis nulla unde aliquam.', 'rejected', NULL, NULL, '2025-08-02 07:29:34', '2025-08-24 06:18:58', NULL),
(56, 4, 46, 686, 5, 'Qui nihil ipsa unde rerum distinctio ullam magni eos maxime ut.', 'rejected', NULL, NULL, '2025-02-22 16:47:37', '2025-08-24 06:18:58', NULL),
(57, 8, 75, 327, 3, 'Deserunt laborum qui nostrum saepe ratione delectus est qui.', 'approved', NULL, NULL, '2025-07-12 03:54:40', '2025-08-24 06:18:58', NULL),
(58, 10, 46, 522, 3, 'Inventore aut mollitia fugiat facilis eius sunt quae quidem quisquam quam ad.', 'pending', NULL, NULL, '2025-03-10 06:49:05', '2025-08-24 06:18:58', NULL),
(59, 8, 45, 365, 3, 'Et facere fugit voluptatem tenetur est consequuntur repellendus veniam velit dolores qui.', 'approved', NULL, NULL, '2025-01-22 07:27:14', '2025-08-24 06:18:58', NULL),
(60, 62, 71, 1003, 4, 'Neque debitis qui harum quam non sed minima doloremque corporis dicta voluptatibus quibusdam.', 'pending', NULL, NULL, '2024-12-07 20:48:11', '2025-08-24 06:18:58', NULL),
(61, 22, 71, 901, 1, 'Earum reiciendis sequi vel beatae aspernatur quos earum aut est ut officia.', 'rejected', NULL, NULL, '2025-06-02 03:06:42', '2025-08-24 06:18:58', NULL),
(62, 6, 45, 289, 5, 'Dicta assumenda et perferendis assumenda et mollitia sed animi et voluptates aspernatur occaecati.', 'pending', NULL, NULL, '2025-05-31 19:31:25', '2025-08-24 06:18:58', NULL),
(63, 50, 62, 860, 1, 'Amet nihil commodi quia praesentium et aut cum totam modi fugiat.', 'approved', NULL, NULL, '2025-07-01 19:29:37', '2025-08-24 06:18:58', NULL),
(64, 22, 64, 1017, 4, 'Eos magni quae porro rem accusamus aut quidem assumenda.', 'approved', NULL, NULL, '2025-01-30 03:33:12', '2025-08-24 06:18:58', NULL),
(65, 10, 55, 443, 3, 'Eligendi quo qui tempora sed sunt qui minima.', 'pending', NULL, NULL, '2024-10-28 11:05:30', '2025-08-24 06:18:58', NULL),
(66, 6, 32, 174, 3, 'Ullam eos possimus deleniti eveniet sunt necessitatibus amet voluptatem dolorum excepturi neque voluptas.', 'approved', NULL, NULL, '2025-03-11 05:29:48', '2025-08-24 06:18:58', NULL),
(67, 5, 39, 657, 5, 'Saepe nesciunt iusto doloremque quam qui magnam ut non sit sint.', 'rejected', NULL, NULL, '2024-10-25 00:44:11', '2025-08-24 06:18:58', NULL),
(68, 4, 58, 712, 4, 'Animi aperiam enim hic sapiente ipsa dicta quia et et dolore inventore.', 'rejected', NULL, NULL, '2025-01-30 23:01:51', '2025-08-24 06:18:58', NULL),
(69, 48, 44, 754, 5, 'Saepe dicta laborum assumenda esse molestiae aut omnis doloremque.', 'approved', NULL, NULL, '2025-01-27 09:23:50', '2025-08-24 06:18:58', NULL),
(70, 62, 62, 773, 4, 'Molestias vel quos nesciunt temporibus excepturi illum natus et molestiae.', 'pending', NULL, NULL, '2025-07-11 10:43:02', '2025-08-24 06:18:58', NULL),
(71, 62, 62, 1013, 4, 'Esse dignissimos voluptas earum voluptatem quaerat esse necessitatibus id.', 'rejected', NULL, NULL, '2025-05-07 13:29:53', '2025-08-24 06:18:58', NULL),
(72, 8, 22, 269, 3, 'Laudantium alias ex aliquam ipsam totam impedit dolore cum fuga.', 'approved', NULL, NULL, '2024-11-28 04:16:51', '2025-08-24 06:18:58', NULL),
(73, 12, 51, 550, 2, 'Non beatae totam molestiae nihil ut praesentium amet et earum tempora ut eos velit.', 'pending', NULL, NULL, '2024-12-14 01:51:50', '2025-08-24 06:18:58', NULL),
(74, 62, 44, 965, 2, 'Magni quis aliquam illo aut et incidunt fuga sequi fuga non.', 'rejected', NULL, NULL, '2025-05-25 02:27:24', '2025-08-24 06:18:58', NULL),
(75, 22, 28, 933, 4, 'Fuga molestias eveniet et beatae saepe quibusdam non laborum dolorum.', 'approved', NULL, NULL, '2025-03-14 17:08:32', '2025-08-24 06:18:58', NULL),
(76, 10, 39, 482, 3, 'Eos ex similique minus iure vel libero dolor nemo.', 'approved', NULL, NULL, '2025-08-23 01:00:04', '2025-08-24 06:18:58', NULL),
(77, 22, 71, 844, 1, 'Quaerat nostrum rerum iste explicabo provident ea ea adipisci aperiam.', 'rejected', NULL, NULL, '2025-07-17 17:51:18', '2025-08-24 06:18:58', NULL),
(78, 22, 64, 871, 3, 'Placeat vero asperiores at tempora et et neque non reprehenderit commodi vitae explicabo.', 'pending', NULL, NULL, '2025-01-14 19:53:14', '2025-08-24 06:18:58', NULL),
(79, 14, 47, 189, 2, 'Officiis accusamus a sed debitis amet cumque ut sed molestiae.', 'pending', NULL, NULL, '2025-06-29 07:51:38', '2025-08-24 06:18:58', NULL),
(80, 8, 40, 422, 4, 'Molestias et fuga sit doloremque nesciunt suscipit quas corrupti.', 'rejected', NULL, NULL, '2025-04-24 15:05:45', '2025-08-24 06:18:58', NULL),
(81, 2, 55, 262, 5, 'Explicabo nobis iure numquam repellendus quia ipsam magni ea est corporis quibusdam.', 'approved', NULL, NULL, '2025-01-13 07:45:18', '2025-08-24 06:18:58', NULL),
(82, 50, 62, 793, 4, 'Non facere id et aut et quia.', 'rejected', NULL, NULL, '2025-03-15 11:14:26', '2025-08-24 06:18:58', NULL),
(83, 8, 34, 383, 1, 'Ipsam fuga nesciunt totam omnis dolor deleniti repudiandae sint ut temporibus voluptatem enim.', 'approved', NULL, NULL, '2025-08-10 05:58:44', '2025-08-24 06:18:58', NULL),
(84, 8, 72, 885, 1, 'Iste molestias placeat eum consectetur sit nihil ut saepe laboriosam.', 'rejected', NULL, NULL, '2025-02-10 10:01:44', '2025-08-24 06:18:58', NULL),
(85, 8, 30, 142, 4, 'Laborum neque illum eum saepe ab laudantium nisi corrupti aut.', 'approved', NULL, NULL, '2025-06-01 14:50:53', '2025-08-24 06:18:58', NULL),
(86, 50, 74, 811, 5, 'Dolores ea nihil nulla quasi voluptate amet.', 'approved', NULL, NULL, '2025-03-25 09:51:22', '2025-08-24 06:18:58', NULL),
(87, 5, 40, 290, 3, 'Accusantium numquam qui consequatur qui eum maxime libero dolores qui aut placeat.', 'approved', NULL, NULL, '2025-06-28 13:18:29', '2025-08-24 06:18:58', NULL),
(88, 8, 27, 161, 4, 'Voluptas iure eligendi sunt ipsum aut sit accusantium fuga.', 'approved', NULL, NULL, '2024-09-14 13:05:25', '2025-08-24 06:18:58', NULL),
(89, 12, 77, 58, 5, 'Perspiciatis vel magni quae consequatur quo quo eius aliquid quia numquam rem ipsam.', 'rejected', NULL, NULL, '2025-08-18 14:23:55', '2025-08-24 06:18:58', NULL),
(90, 13, 77, 94, 1, 'Similique reiciendis quisquam unde quasi odio atque unde adipisci.', 'pending', NULL, NULL, '2024-11-26 16:17:06', '2025-08-24 06:18:58', NULL),
(91, 50, 44, 982, 4, 'Aut in ratione dolores doloribus officia voluptas vel odio suscipit repellendus.', 'pending', NULL, NULL, '2025-03-15 07:57:15', '2025-08-24 06:18:58', NULL),
(92, 50, 74, 812, 2, 'Quis voluptatem recusandae dolores quis modi fugit.', 'pending', NULL, NULL, '2025-08-19 05:14:09', '2025-08-24 06:18:58', NULL),
(93, 6, 40, 250, 4, 'Odit velit ut magnam temporibus neque quasi consequuntur fuga.', 'approved', NULL, NULL, '2024-09-30 18:30:00', '2025-08-24 06:18:58', NULL),
(94, 12, 38, 698, 5, 'Tempore inventore alias quas accusantium laboriosam quisquam distinctio possimus atque.', 'pending', NULL, NULL, '2025-02-28 17:50:35', '2025-08-24 06:18:58', NULL),
(95, 6, 71, 286, 2, 'Dignissimos eum distinctio quaerat distinctio vero sit laboriosam laudantium.', 'approved', NULL, NULL, '2025-07-13 21:23:55', '2025-08-24 06:18:58', NULL),
(96, 3, 74, 479, 5, 'Labore praesentium a sequi nesciunt iusto nihil maiores culpa dolorem vel sapiente maxime labore.', 'rejected', NULL, NULL, '2025-08-21 23:12:33', '2025-08-24 06:18:58', NULL),
(97, 62, 62, 1015, 3, 'Cumque nulla nisi aperiam dicta non dolores natus mollitia rem commodi dolorum quidem.', 'pending', NULL, NULL, '2024-09-11 11:16:33', '2025-08-24 06:18:58', NULL),
(98, 8, 67, 192, 3, 'Nulla accusamus explicabo qui earum consectetur sed est maiores eaque est ullam.', 'rejected', NULL, NULL, '2024-10-06 22:32:31', '2025-08-24 06:18:58', NULL),
(99, 5, 22, 438, 5, 'Explicabo dolore saepe sit mollitia impedit et quo hic quia corporis soluta.', 'approved', NULL, NULL, '2025-05-19 18:26:51', '2025-08-24 06:18:58', NULL),
(100, 8, 54, 328, 5, 'Voluptas modi iure explicabo sit neque unde cupiditate enim iure.', 'pending', NULL, NULL, '2024-11-18 05:09:04', '2025-08-24 06:18:58', NULL),
(101, 6, 34, 433, 1, 'Ipsam voluptatem aut quae aliquid quis repellat omnis tempore.', 'approved', NULL, NULL, '2025-08-05 00:47:50', '2025-08-24 06:18:58', NULL),
(102, 3, 39, 640, 5, 'Quo sint nisi qui voluptatum est minus cumque natus consequatur.', 'pending', NULL, NULL, '2025-08-03 07:27:57', '2025-08-24 06:18:58', NULL),
(103, 5, 38, 615, 1, 'Tempora aut sunt animi odit nostrum autem consectetur sunt voluptatem at.', 'pending', NULL, NULL, '2025-01-22 07:19:04', '2025-08-24 06:18:58', NULL),
(104, 12, 75, 61, 2, 'Deleniti assumenda quibusdam et et eos temporibus odio.', 'rejected', NULL, NULL, '2024-09-19 02:20:44', '2025-08-24 06:18:58', NULL),
(105, 6, 40, 357, 2, 'Doloribus libero repudiandae iusto ad provident ab et cupiditate laborum voluptatum et nihil in.', 'rejected', NULL, NULL, '2024-12-13 18:16:11', '2025-08-24 06:18:58', NULL),
(106, 4, 38, 594, 3, 'Dolore ea est quibusdam eum porro earum harum mollitia cumque in.', 'approved', NULL, NULL, '2025-05-15 07:22:39', '2025-08-24 06:18:58', NULL),
(107, 8, 71, 930, 2, 'At et dolores incidunt inventore culpa qui harum ad corrupti enim nisi dolorem omnis.', 'approved', NULL, NULL, '2025-02-28 19:48:59', '2025-08-24 06:18:58', NULL),
(108, 8, 32, 896, 5, 'Nam doloribus assumenda veritatis quis qui aspernatur.', 'approved', NULL, NULL, '2025-05-08 00:52:52', '2025-08-24 06:18:58', NULL),
(109, 4, 58, 575, 1, 'Atque commodi et dolor omnis sapiente sed quia in.', 'rejected', NULL, NULL, '2024-10-04 18:34:48', '2025-08-24 06:18:58', NULL),
(110, 8, 47, 216, 4, 'Unde aut sed eos quis cumque quaerat doloribus expedita praesentium voluptas.', 'pending', NULL, NULL, '2025-03-04 17:15:33', '2025-08-24 06:18:58', NULL),
(111, 6, 31, 126, 1, 'Rerum vero aut aut suscipit nulla incidunt sit ut perspiciatis nostrum minus iusto.', 'rejected', NULL, NULL, '2025-07-13 13:14:30', '2025-08-24 06:18:58', NULL),
(112, 10, 29, 559, 2, 'Aut perspiciatis quam beatae error molestiae ea.', 'pending', NULL, NULL, '2024-11-23 17:29:30', '2025-08-24 06:18:58', NULL),
(113, 14, 31, 175, 3, 'Quaerat asperiores debitis excepturi voluptatum blanditiis eum totam est aspernatur sapiente voluptatem quas.', 'rejected', NULL, NULL, '2024-11-08 17:24:27', '2025-08-24 06:18:58', NULL),
(114, 4, 67, 135, 2, 'Omnis est rerum accusantium quam maiores at sed.', 'pending', NULL, NULL, '2025-07-31 06:20:11', '2025-08-24 06:18:58', NULL),
(115, 50, 45, 921, 1, 'Consequuntur temporibus et nemo quia voluptas sed repellendus vero asperiores itaque et quia et.', 'pending', NULL, NULL, '2024-11-08 22:53:52', '2025-08-24 06:18:58', NULL),
(116, 12, 77, 69, 2, 'Quasi cupiditate quod praesentium reprehenderit voluptates alias exercitationem aperiam.', 'pending', NULL, NULL, '2025-01-28 10:22:47', '2025-08-24 06:18:58', NULL),
(117, 50, 64, 850, 3, 'Ut et laborum corrupti officia blanditiis tempora voluptates.', 'rejected', NULL, NULL, '2025-02-23 06:04:24', '2025-08-24 06:18:58', NULL),
(118, 62, 62, 851, 4, 'Consequuntur quis iusto ut ipsum porro aut et sunt veniam debitis earum.', 'rejected', NULL, NULL, '2025-04-16 05:56:11', '2025-08-24 06:18:58', NULL),
(119, 12, 74, 656, 4, 'Veritatis esse adipisci soluta vel nam aut ut atque quia est totam.', 'pending', NULL, NULL, '2024-08-25 00:49:02', '2025-08-24 06:18:58', NULL),
(120, 10, 42, 530, 3, 'Id consequatur nihil maiores natus accusantium exercitationem dolor quam recusandae.', 'rejected', NULL, NULL, '2025-04-19 13:22:02', '2025-08-24 06:18:58', NULL),
(121, 48, 62, 936, 3, 'Qui odio voluptatem eligendi minima est autem laudantium corporis vel aliquam alias nostrum excepturi.', 'rejected', NULL, NULL, '2025-08-09 13:18:06', '2025-08-24 06:18:58', NULL),
(122, 48, 32, 753, 2, 'Saepe dolores sint facere voluptatem omnis totam corrupti sit voluptas placeat minus.', 'pending', NULL, NULL, '2025-03-13 14:12:40', '2025-08-24 06:18:58', NULL),
(123, 6, 45, 340, 5, 'Laborum possimus dolores amet quae omnis at est necessitatibus quae temporibus.', 'pending', NULL, NULL, '2024-09-15 16:02:18', '2025-08-24 06:18:58', NULL),
(124, 9, 28, 180, 4, 'Nam molestias voluptas id sit nihil magnam aut sit quae earum.', 'pending', NULL, NULL, '2025-03-03 14:48:15', '2025-08-24 06:18:58', NULL),
(125, 22, 72, 937, 5, 'Quaerat itaque voluptas sint ut veniam deleniti.', 'rejected', NULL, NULL, '2024-11-12 08:13:40', '2025-08-24 06:18:58', NULL),
(126, 6, 45, 355, 1, 'Magni aut impedit et explicabo ipsum ratione aut fugiat non.', 'approved', NULL, NULL, '2025-08-14 17:17:53', '2025-08-24 06:18:58', NULL),
(127, 50, 74, 899, 4, 'Sed sit aut a ipsum dicta quis accusantium tempora rerum eos.', 'rejected', NULL, NULL, '2024-12-04 21:57:59', '2025-08-24 06:18:58', NULL),
(128, 2, 75, 279, 3, 'Voluptatem beatae adipisci quia voluptas neque qui.', 'approved', NULL, NULL, '2025-01-07 13:09:42', '2025-08-24 06:18:58', NULL),
(129, 10, 22, 450, 5, 'Aut sunt deleniti in occaecati ut facere dolores.', 'approved', NULL, NULL, '2025-07-12 16:50:36', '2025-08-24 06:18:58', NULL),
(130, 5, 75, 439, 5, 'Voluptate voluptatibus voluptatibus mollitia laboriosam consequatur consequatur et voluptatem quis qui.', 'rejected', NULL, NULL, '2025-01-24 23:49:43', '2025-08-24 06:18:58', NULL),
(131, 3, 51, 606, 5, 'Velit numquam tempora odit beatae et sed temporibus voluptatem a deserunt officiis voluptatem.', 'rejected', NULL, NULL, '2025-03-04 00:58:20', '2025-08-24 06:18:58', NULL),
(132, 13, 63, 91, 1, 'Velit voluptatem itaque et quod id voluptatem.', 'pending', NULL, NULL, '2025-07-18 03:41:38', '2025-08-24 06:18:58', NULL),
(133, 8, 40, 265, 4, 'Dolore pariatur magnam non atque eligendi consectetur fuga distinctio impedit porro soluta.', 'rejected', NULL, NULL, '2025-07-25 20:11:11', '2025-08-24 06:18:58', NULL),
(134, 12, 42, 504, 3, 'Nihil ducimus labore et sunt aut officiis error.', 'approved', NULL, NULL, '2024-11-10 15:51:04', '2025-08-24 06:18:58', NULL),
(135, 8, 45, 217, 2, 'Temporibus et eum reprehenderit veniam nobis mollitia quia expedita inventore voluptatibus.', 'pending', NULL, NULL, '2024-10-22 05:32:19', '2025-08-24 06:18:58', NULL),
(136, 12, 29, 681, 1, 'Et iusto repellendus non ea sed enim assumenda eligendi qui quaerat expedita.', 'rejected', NULL, NULL, '2024-09-06 02:00:59', '2025-08-24 06:18:58', NULL),
(137, 6, 45, 221, 1, 'Quod quo id vel et enim nesciunt nulla voluptas soluta.', 'pending', NULL, NULL, '2024-12-08 05:17:19', '2025-08-24 06:18:58', NULL),
(138, 48, 32, 753, 1, 'Quo accusamus velit quasi veniam soluta inventore aut eos ab tempora doloremque aut qui.', 'approved', NULL, NULL, '2025-07-23 19:40:47', '2025-08-24 06:18:58', NULL),
(139, 3, 74, 642, 5, 'Aspernatur amet excepturi et eos adipisci qui vitae consequatur quia vero.', 'pending', NULL, NULL, '2025-02-05 07:45:51', '2025-08-24 06:18:58', NULL),
(140, 2, 22, 419, 4, 'Sunt officiis beatae est animi beatae non voluptas odit nostrum dolores.', 'approved', NULL, NULL, '2025-01-26 09:43:44', '2025-08-24 06:18:58', NULL),
(141, 10, 74, 673, 3, 'Quae qui laudantium ipsam aut nulla quidem officia rerum omnis consequatur.', 'approved', NULL, NULL, '2024-12-16 16:31:44', '2025-08-24 06:18:58', NULL),
(142, 48, 62, 770, 5, 'Repellat dolore dolores quo ullam ut quibusdam corrupti officia vitae eligendi laboriosam.', 'approved', NULL, NULL, '2025-05-05 01:35:13', '2025-08-24 06:18:58', NULL),
(143, 3, 43, 549, 5, 'Nam impedit omnis alias quaerat voluptatem vitae cupiditate maiores ipsum ab.', 'pending', NULL, NULL, '2025-07-31 08:01:36', '2025-08-24 06:18:58', NULL),
(144, 62, 32, 763, 2, 'Inventore et quia iusto ut asperiores vero autem sunt ut.', 'pending', NULL, NULL, '2024-11-25 02:34:06', '2025-08-24 06:18:58', NULL),
(145, 62, 45, 762, 3, 'Velit doloribus et rerum dolor occaecati harum praesentium.', 'approved', NULL, NULL, '2024-11-23 15:47:08', '2025-08-24 06:18:58', NULL),
(146, 10, 22, 394, 4, 'Nihil voluptatem quam recusandae unde sed dolores molestiae esse ut ut ipsa quam.', 'approved', NULL, NULL, '2024-09-03 14:08:05', '2025-08-24 06:18:58', NULL),
(147, 50, 71, 796, 4, 'Explicabo autem et non ab cupiditate exercitationem ut iste.', 'rejected', NULL, NULL, '2024-11-08 13:30:10', '2025-08-24 06:18:58', NULL),
(148, 62, 71, 890, 5, 'Mollitia vitae perspiciatis voluptate aliquid eos dolorem omnis accusamus.', 'rejected', NULL, NULL, '2024-11-13 00:37:59', '2025-08-24 06:18:58', NULL),
(149, 12, 77, 71, 1, 'Eius doloribus explicabo possimus nostrum explicabo aut architecto aliquid voluptas quam quo quia.', 'pending', NULL, NULL, '2025-03-21 16:12:14', '2025-08-24 06:18:58', NULL),
(150, 5, 51, 717, 5, 'Non facilis aut provident sit corporis dolorum.', 'pending', NULL, NULL, '2025-05-27 18:07:16', '2025-08-24 06:18:58', NULL),
(151, 8, 40, 460, 2, 'Et reiciendis qui libero recusandae quibusdam aut minima vel nulla quo libero.', 'pending', NULL, NULL, '2025-08-15 12:27:39', '2025-08-24 06:18:58', NULL),
(152, 12, 74, 656, 5, 'Fugit error consequuntur incidunt quod quia hic dolor id dolores beatae.', 'pending', NULL, NULL, '2025-04-26 14:20:38', '2025-08-24 06:18:58', NULL),
(153, 3, 29, 605, 2, 'Ex repellendus consequatur ea aut consequatur quod dolor officiis et aut cumque hic dignissimos.', 'pending', NULL, NULL, '2024-11-08 11:16:52', '2025-08-24 06:18:58', NULL),
(154, 3, 74, 600, 3, 'Doloribus est et inventore dolorum quis culpa dignissimos alias sit.', 'pending', NULL, NULL, '2025-01-06 21:26:16', '2025-08-24 06:18:58', NULL),
(155, 12, 42, 696, 1, 'Quo assumenda beatae reiciendis et earum tempore quia soluta.', 'rejected', NULL, NULL, '2025-03-24 16:21:06', '2025-08-24 06:18:58', NULL),
(156, 62, 44, 891, 2, 'Dolores quam qui velit et quo molestiae autem aliquid non aut et.', 'approved', NULL, NULL, '2024-10-12 20:24:48', '2025-08-24 06:18:58', NULL),
(157, 62, 28, 948, 2, 'Dolorem quo recusandae porro aut deleniti corrupti sit vero et.', 'rejected', NULL, NULL, '2025-03-11 17:27:02', '2025-08-24 06:18:58', NULL),
(158, 22, 32, 1018, 5, 'Fuga in culpa voluptatem et consequatur accusantium debitis vero.', 'pending', NULL, NULL, '2025-02-13 00:29:46', '2025-08-24 06:18:58', NULL),
(159, 48, 64, 888, 1, 'Natus et autem laudantium ratione libero sint ea nisi.', 'approved', NULL, NULL, '2025-04-01 17:30:28', '2025-08-24 06:18:58', NULL),
(160, 9, 32, 179, 2, 'Eaque molestias sed dolor sit accusantium nesciunt sequi nesciunt a.', 'rejected', NULL, NULL, '2025-01-26 14:07:15', '2025-08-24 06:18:58', NULL),
(161, 14, 32, 226, 1, 'Neque harum et et ut error et sint perspiciatis voluptas.', 'approved', NULL, NULL, '2024-12-20 14:01:52', '2025-08-24 06:18:58', NULL),
(162, 8, 27, 207, 1, 'In rerum at rerum qui temporibus quidem enim non natus laborum aut rerum nesciunt.', 'approved', NULL, NULL, '2024-11-28 10:08:19', '2025-08-24 06:18:58', NULL),
(163, 3, 42, 599, 3, 'Corrupti rerum voluptas quos neque ut perspiciatis.', 'pending', NULL, NULL, '2025-05-30 01:06:00', '2025-08-24 06:18:58', NULL),
(164, 10, 43, 651, 5, 'Odio similique harum reprehenderit iure quisquam inventore delectus totam.', 'approved', NULL, NULL, '2025-04-06 17:32:55', '2025-08-24 06:18:58', NULL),
(165, 50, 64, 920, 4, 'Porro veniam est voluptatum blanditiis voluptas sed ex nihil dolore.', 'approved', NULL, NULL, '2025-03-07 06:59:47', '2025-08-24 06:18:58', NULL),
(166, 14, 28, 149, 3, 'Ut magni quia doloremque minima sequi eos esse vel.', 'rejected', NULL, NULL, '2025-07-02 16:13:44', '2025-08-24 06:18:58', NULL),
(167, 8, 40, 463, 2, 'Architecto vel voluptas qui natus assumenda ducimus tempore unde aut autem sed.', 'pending', NULL, NULL, '2024-10-28 16:05:58', '2025-08-24 06:18:58', NULL),
(168, 5, 51, 700, 2, 'Quia molestiae ipsam unde officia qui in.', 'rejected', NULL, NULL, '2025-04-04 22:54:07', '2025-08-24 06:18:58', NULL),
(169, 22, 64, 871, 4, 'Porro perferendis ducimus nihil hic ratione debitis ut est qui.', 'pending', NULL, NULL, '2024-10-15 12:06:55', '2025-08-24 06:18:58', NULL),
(170, 8, 40, 460, 1, 'Repellat rem assumenda qui at quas quos rem neque vel.', 'rejected', NULL, NULL, '2025-07-26 01:58:58', '2025-08-24 06:18:58', NULL),
(171, 6, 71, 431, 2, 'Et similique rerum quia consequuntur ut doloribus sed dolorem et quis reprehenderit molestias non.', 'pending', NULL, NULL, '2025-07-20 15:49:44', '2025-08-24 06:18:58', NULL),
(172, 10, 38, 720, 5, 'Nesciunt accusamus voluptatem ipsum totam laboriosam ullam.', 'approved', NULL, NULL, '2025-07-23 03:28:09', '2025-08-24 06:18:58', NULL),
(173, 48, 72, 942, 5, 'Ipsa fuga sit ratione voluptates dolorum inventore cumque totam qui ut necessitatibus alias ut.', 'rejected', NULL, NULL, '2025-06-25 00:31:59', '2025-08-24 06:18:58', NULL),
(174, 6, 31, 242, 2, 'Officiis occaecati velit qui ea veniam quos.', 'pending', NULL, NULL, '2025-01-20 04:04:45', '2025-08-24 06:18:58', NULL),
(175, 10, 43, 651, 2, 'Similique amet et sit molestias ut a.', 'pending', NULL, NULL, '2025-05-21 16:37:46', '2025-08-24 06:18:58', NULL),
(176, 6, 32, 172, 4, 'Rerum sunt deserunt eveniet et cumque illum aut ipsam.', 'rejected', NULL, NULL, '2024-10-01 16:25:21', '2025-08-24 06:18:58', NULL),
(177, 12, 58, 708, 1, 'Aut vero maxime ea temporibus inventore qui.', 'rejected', NULL, NULL, '2025-05-25 16:11:32', '2025-08-24 06:18:58', NULL),
(178, 10, 39, 533, 3, 'Non maxime aut expedita et labore dolores aut.', 'approved', NULL, NULL, '2025-04-13 09:35:50', '2025-08-24 06:18:58', NULL),
(179, 4, 31, 204, 5, 'Officia doloribus voluptatem in iste eveniet ut est.', 'rejected', NULL, NULL, '2024-12-05 18:42:12', '2025-08-24 06:18:58', NULL),
(180, 8, 75, 323, 2, 'Eum voluptatem voluptatem saepe vitae eos eligendi.', 'approved', NULL, NULL, '2024-12-31 16:29:07', '2025-08-24 06:18:58', NULL),
(181, 12, 58, 500, 1, 'Nisi consequuntur veritatis qui rerum ipsam totam explicabo rerum voluptatum eos laborum quisquam.', 'rejected', NULL, NULL, '2024-11-30 12:21:13', '2025-08-24 06:18:58', NULL),
(182, 50, 64, 850, 5, 'Nihil in praesentium ut consequatur aut odio quasi magnam dolorum quibusdam mollitia autem.', 'pending', NULL, NULL, '2025-02-23 23:26:50', '2025-08-24 06:18:58', NULL),
(183, 22, 72, 932, 5, 'Molestiae qui nostrum reiciendis voluptatem natus praesentium.', 'approved', NULL, NULL, '2025-08-09 10:33:23', '2025-08-24 06:18:58', NULL),
(184, 4, 26, 164, 4, 'Fugiat voluptatibus ut quia quia quasi placeat explicabo.', 'approved', NULL, NULL, '2025-04-12 03:50:43', '2025-08-24 06:18:58', NULL),
(185, 22, 32, 768, 2, 'Velit accusamus ex laboriosam esse voluptate consequatur optio asperiores molestiae consequatur in.', 'pending', NULL, NULL, '2024-12-07 08:12:08', '2025-08-24 06:18:58', NULL),
(186, 6, 55, 453, 3, 'In quae labore rerum dolorem quia laborum ab.', 'pending', NULL, NULL, '2025-05-02 10:49:29', '2025-08-24 06:18:58', NULL),
(187, 4, 39, 644, 1, 'Velit dolores est autem cupiditate soluta corrupti minus possimus explicabo in velit voluptas.', 'rejected', NULL, NULL, '2024-09-04 08:10:43', '2025-08-24 06:18:58', NULL),
(188, 62, 62, 991, 3, 'Laboriosam nobis ut maiores esse voluptas ipsa quod omnis temporibus pariatur quibusdam.', 'approved', NULL, NULL, '2024-11-20 19:04:16', '2025-08-24 06:18:58', NULL),
(189, 5, 44, 464, 5, 'Natus delectus deserunt culpa enim eveniet perspiciatis qui excepturi nihil velit quia voluptatem.', 'rejected', NULL, NULL, '2025-01-23 23:26:49', '2025-08-24 06:18:58', NULL),
(190, 4, 38, 508, 4, 'Corporis et possimus praesentium corrupti dolores sapiente autem et.', 'rejected', NULL, NULL, '2025-06-21 06:39:37', '2025-08-24 06:18:58', NULL),
(191, 3, 39, 643, 2, 'Tenetur reiciendis aut fugit iste quos ut eum blanditiis est.', 'rejected', NULL, NULL, '2025-01-26 01:16:51', '2025-08-24 06:18:58', NULL),
(192, 4, 67, 163, 2, 'Quasi totam sunt odio ut amet unde non optio adipisci velit non minima.', 'pending', NULL, NULL, '2025-03-24 04:20:32', '2025-08-24 06:18:58', NULL),
(193, 10, 29, 483, 3, 'Id maxime eveniet beatae veniam aut eveniet.', 'approved', NULL, NULL, '2025-04-15 06:14:19', '2025-08-24 06:18:58', NULL),
(194, 10, 38, 724, 5, 'Voluptas libero iure provident a voluptatem tenetur reprehenderit ipsa vel quae eligendi.', 'pending', NULL, NULL, '2025-01-25 05:18:01', '2025-08-24 06:18:58', NULL),
(195, 5, 77, 519, 1, 'Sed cumque veniam quibusdam quibusdam omnis assumenda maiores consequatur.', 'approved', NULL, NULL, '2025-04-03 05:45:43', '2025-08-24 06:18:58', NULL),
(196, 3, 39, 586, 5, 'Autem iure sed itaque commodi ex sit soluta eaque porro vel ut inventore ut.', 'pending', NULL, NULL, '2025-03-13 21:43:19', '2025-08-24 06:18:58', NULL),
(197, 12, 51, 550, 2, 'Et molestiae maiores exercitationem sit optio suscipit omnis.', 'rejected', NULL, NULL, '2025-02-08 06:14:31', '2025-08-24 06:18:58', NULL),
(198, 22, 72, 996, 1, 'Suscipit provident nostrum sit et est voluptas magnam.', 'rejected', NULL, NULL, '2024-09-06 20:23:44', '2025-08-24 06:18:58', NULL),
(199, 12, 77, 557, 4, 'Perspiciatis dolor nam aut aut nulla sed ipsa repellat.', 'pending', NULL, NULL, '2024-11-18 20:57:50', '2025-08-24 06:18:58', NULL),
(200, 50, 44, 982, 4, 'Error minima officiis molestiae voluptas ea debitis earum molestiae eius.', 'approved', NULL, NULL, '2025-05-12 18:37:04', '2025-08-24 06:18:58', NULL),
(201, 12, 29, 677, 5, 'At excepturi ea consequatur nam sint architecto.', 'pending', NULL, NULL, '2024-09-19 12:41:11', '2025-08-24 06:18:58', NULL),
(202, 13, 76, 96, 4, 'Ipsum dolor ab temporibus esse libero illo aut.', 'pending', NULL, NULL, '2024-09-03 20:24:22', '2025-08-24 06:18:58', NULL),
(203, 62, 32, 1004, 1, 'Dignissimos cum laudantium dolorem temporibus est officiis.', 'pending', NULL, NULL, '2025-03-30 02:52:44', '2025-08-24 06:18:58', NULL),
(204, 14, 31, 175, 2, 'Qui tenetur rem culpa tenetur neque eaque neque expedita aut enim ducimus earum.', 'approved', NULL, NULL, '2025-03-10 08:18:53', '2025-08-24 06:18:58', NULL),
(205, 6, 34, 452, 5, 'Deleniti et quis occaecati aut quo dolores velit laborum cumque omnis.', 'approved', NULL, NULL, '2024-12-09 12:15:38', '2025-08-24 06:18:58', NULL),
(206, 48, 32, 808, 3, 'Et repudiandae aut voluptatum iusto repudiandae explicabo similique.', 'approved', NULL, NULL, '2025-04-23 08:49:19', '2025-08-24 06:18:58', NULL),
(207, 5, 34, 456, 1, 'Quia et voluptas earum perferendis inventore molestiae vel facere accusantium soluta voluptatem.', 'pending', NULL, NULL, '2025-03-06 21:17:47', '2025-08-24 06:18:58', NULL),
(208, 8, 45, 259, 2, 'Ullam perspiciatis pariatur est molestiae est saepe qui a magnam optio.', 'approved', NULL, NULL, '2025-04-12 08:16:06', '2025-08-24 06:18:58', NULL),
(209, 10, 34, 237, 1, 'Et nemo omnis minima suscipit possimus maxime sunt.', 'pending', NULL, NULL, '2024-12-17 17:29:40', '2025-08-24 06:18:58', NULL),
(210, 4, 39, 731, 4, 'Voluptas dolore placeat ipsam sunt in praesentium omnis est nostrum ipsam aut quae enim.', 'rejected', NULL, NULL, '2024-12-02 02:17:39', '2025-08-24 06:18:58', NULL),
(211, 5, 40, 247, 5, 'Eos est ad aut id nostrum dolor nobis iure.', 'rejected', NULL, NULL, '2024-09-04 00:42:54', '2025-08-24 06:18:58', NULL),
(212, 3, 43, 641, 2, 'Et qui fuga asperiores est quis sapiente ducimus adipisci atque quo pariatur.', 'pending', NULL, NULL, '2025-03-09 08:49:46', '2025-08-24 06:18:58', NULL),
(213, 6, 30, 186, 2, 'Est sit placeat ipsam impedit fuga qui labore aspernatur.', 'pending', NULL, NULL, '2025-05-15 12:03:48', '2025-08-24 06:18:58', NULL),
(214, 3, 39, 586, 1, 'Quaerat nihil possimus sint natus quos similique eum quae quia officiis est voluptate deserunt.', 'rejected', NULL, NULL, '2025-04-04 22:57:33', '2025-08-24 06:18:58', NULL),
(215, 10, 44, 345, 5, 'Incidunt nemo qui nostrum deserunt ullam suscipit ad consequatur molestiae sint enim.', 'approved', NULL, NULL, '2024-08-25 08:55:15', '2025-08-24 06:18:58', NULL),
(216, 12, 75, 61, 1, 'Asperiores ducimus est qui alias doloribus maxime et quam.', 'pending', NULL, NULL, '2024-10-14 03:13:02', '2025-08-24 06:18:58', NULL),
(217, 62, 45, 798, 2, 'A doloremque laboriosam dignissimos ex sed esse quas voluptas voluptatum accusantium id aperiam.', 'rejected', NULL, NULL, '2025-04-09 20:36:19', '2025-08-24 06:18:58', NULL),
(218, 6, 45, 373, 5, 'Fugiat earum unde et sit quam et facilis fugiat.', 'pending', NULL, NULL, '2025-06-04 16:23:32', '2025-08-24 06:18:58', NULL),
(219, 62, 32, 763, 5, 'Rerum eos non nesciunt est ullam minus exercitationem ipsum dolorem voluptates.', 'rejected', NULL, NULL, '2025-03-17 07:44:15', '2025-08-24 06:18:58', NULL),
(220, 62, 44, 977, 3, 'Cumque deleniti cum ipsa tenetur consequuntur et nihil dolore et voluptate.', 'approved', NULL, NULL, '2025-01-28 00:16:26', '2025-08-24 06:18:58', NULL),
(221, 8, 45, 421, 4, 'Est architecto ducimus sed in rem ullam culpa inventore molestiae magnam nisi repellendus.', 'rejected', NULL, NULL, '2024-09-02 16:30:56', '2025-08-24 06:18:58', NULL),
(222, 5, 22, 438, 3, 'Consequatur dolorem alias a rerum blanditiis a non est qui.', 'approved', NULL, NULL, '2025-04-30 12:52:42', '2025-08-24 06:18:58', NULL),
(223, 14, 26, 190, 4, 'Inventore ut consectetur aut beatae aut aut est amet.', 'approved', NULL, NULL, '2025-02-03 02:01:55', '2025-08-24 06:18:58', NULL),
(224, 3, 42, 552, 3, 'Possimus sint ad consequatur qui et quis quos est quia perferendis.', 'pending', NULL, NULL, '2024-09-09 12:17:10', '2025-08-24 06:18:58', NULL),
(225, 22, 72, 934, 4, 'Ex qui natus sint porro voluptate sint perferendis nulla vero assumenda.', 'rejected', NULL, NULL, '2025-05-02 12:59:32', '2025-08-24 06:18:58', NULL),
(226, 4, 26, 136, 5, 'Doloremque aut praesentium mollitia consequuntur et molestiae omnis dicta saepe delectus.', 'approved', NULL, NULL, '2024-10-27 03:41:30', '2025-08-24 06:18:58', NULL),
(227, 10, 46, 522, 1, 'Quam aut quis ea et molestiae expedita est voluptates.', 'rejected', NULL, NULL, '2025-07-13 05:55:05', '2025-08-24 06:18:58', NULL),
(228, 4, 39, 598, 2, 'Aut qui fugiat molestiae porro autem ut.', 'pending', NULL, NULL, '2024-12-06 13:29:34', '2025-08-24 06:18:58', NULL),
(229, 8, 45, 144, 1, 'Alias autem libero accusantium expedita placeat voluptatibus minima animi deleniti possimus.', 'rejected', NULL, NULL, '2025-03-23 20:03:45', '2025-08-24 06:18:58', NULL),
(230, 62, 32, 764, 5, 'Minus quaerat asperiores incidunt error aut sint dolorem voluptas molestiae repudiandae.', 'approved', NULL, NULL, '2025-03-30 22:13:40', '2025-08-24 06:18:58', NULL),
(231, 5, 45, 300, 2, 'Doloremque ipsa praesentium dignissimos dignissimos alias at dolores omnis eos porro qui eos.', 'approved', NULL, NULL, '2024-12-14 13:19:57', '2025-08-24 06:18:58', NULL),
(232, 22, 72, 1010, 4, 'Minima exercitationem quia itaque est autem quis corrupti quo.', 'pending', NULL, NULL, '2025-01-07 10:45:48', '2025-08-24 06:18:58', NULL),
(233, 62, 71, 890, 2, 'Optio officia a rem id officia ut tempore incidunt hic laudantium totam magni.', 'approved', NULL, NULL, '2025-07-22 10:20:22', '2025-08-24 06:26:30', NULL),
(234, 5, 58, 578, 2, 'Voluptates dolor sunt provident vel harum rerum doloribus eos tempore voluptatem.', 'rejected', NULL, NULL, '2025-01-26 04:34:43', '2025-08-24 06:26:30', NULL),
(235, 9, 28, 114, 5, 'Sit saepe id aliquid aut voluptatibus quos voluptatem delectus facere.', 'rejected', NULL, NULL, '2025-05-25 09:21:54', '2025-08-24 06:26:30', NULL),
(236, 62, 44, 979, 2, 'Architecto amet blanditiis consequatur possimus assumenda repudiandae ducimus quos.', 'rejected', NULL, NULL, '2025-03-08 06:01:20', '2025-08-24 06:26:30', NULL),
(237, 8, 40, 406, 3, 'Ipsum id inventore earum nemo dolor et dolor incidunt cum nihil qui fuga vero.', 'pending', NULL, NULL, '2025-03-25 02:55:35', '2025-08-24 06:26:30', NULL),
(238, 62, 72, 835, 4, 'Dolor tempora quia ut reiciendis reiciendis assumenda dignissimos doloremque autem ipsam quisquam omnis.', 'approved', NULL, NULL, '2025-04-29 10:26:52', '2025-08-24 06:26:30', NULL),
(239, 3, 42, 564, 3, 'Laudantium nam iure reprehenderit vero id ea laudantium.', 'rejected', NULL, NULL, '2025-07-03 20:31:07', '2025-08-24 06:26:30', NULL),
(240, 8, 34, 383, 2, 'Quis magnam odit non aut pariatur accusamus blanditiis tempora aut libero eligendi blanditiis.', 'pending', NULL, NULL, '2024-12-02 11:21:43', '2025-08-24 06:26:30', NULL),
(241, 22, 28, 765, 4, 'Rerum ab beatae quis quia dolore inventore et aut perspiciatis qui non dolore ea aliquid.', 'approved', NULL, NULL, '2024-10-13 12:45:15', '2025-08-24 06:26:30', NULL),
(242, 48, 62, 825, 4, 'Non a adipisci omnis iusto aperiam voluptate consequuntur modi aperiam et.', 'pending', NULL, NULL, '2024-10-18 08:40:05', '2025-08-24 06:26:30', NULL),
(243, 50, 71, 830, 3, 'Quasi reiciendis ut consequatur at ex et.', 'pending', NULL, NULL, '2024-09-20 13:49:35', '2025-08-24 06:26:30', NULL),
(244, 10, 38, 720, 1, 'Id voluptate delectus in eius repellat adipisci est velit modi.', 'pending', NULL, NULL, '2025-02-04 00:57:10', '2025-08-24 06:26:30', NULL),
(245, 3, 77, 495, 4, 'Fuga doloribus nostrum quos rerum est possimus eligendi vel fugit maxime quis repellendus aut eaque.', 'pending', NULL, NULL, '2025-04-07 12:18:31', '2025-08-24 06:26:30', NULL),
(246, 2, 44, 379, 2, 'Qui sit sapiente expedita amet pariatur rerum sequi consectetur dolorem.', 'rejected', NULL, NULL, '2024-12-23 11:57:42', '2025-08-24 06:26:30', NULL),
(247, 8, 67, 157, 2, 'Quae alias minima vel vero quia debitis dolores.', 'pending', NULL, NULL, '2024-12-11 18:47:06', '2025-08-24 06:26:30', NULL),
(248, 10, 71, 319, 4, 'Quam et temporibus suscipit et exercitationem sit enim eos eum.', 'pending', NULL, NULL, '2025-07-06 17:01:00', '2025-08-24 06:26:30', NULL),
(249, 5, 43, 650, 2, 'Est eligendi architecto doloremque sed modi temporibus est numquam iste omnis suscipit nobis autem.', 'approved', NULL, NULL, '2025-03-08 09:34:46', '2025-08-24 06:26:30', NULL),
(250, 22, 45, 872, 1, 'Quia culpa aut veniam ratione et commodi maxime et tenetur ut.', 'pending', NULL, NULL, '2025-04-16 04:37:34', '2025-08-24 06:26:30', NULL),
(251, 5, 29, 699, 5, 'Ea reprehenderit consectetur a voluptatem ea laudantium.', 'pending', NULL, NULL, '2025-02-23 15:31:18', '2025-08-24 06:26:30', NULL),
(252, 10, 55, 443, 2, 'Neque dolore quisquam vitae vel exercitationem doloremque laborum.', 'pending', NULL, NULL, '2025-01-23 00:41:05', '2025-08-24 06:26:30', NULL),
(253, 2, 34, 395, 1, 'Inventore omnis aut consequatur ipsum id minima et laboriosam in repellat facere.', 'pending', NULL, NULL, '2025-07-29 20:32:04', '2025-08-24 06:26:30', NULL),
(254, 62, 32, 949, 3, 'Amet qui qui est nihil eaque vitae dignissimos nulla similique consequatur.', 'rejected', NULL, NULL, '2025-05-22 10:44:08', '2025-08-24 06:26:30', NULL),
(255, 4, 39, 644, 3, 'Ipsum enim iste aut error deleniti ut rerum quod id quis quod quos.', 'rejected', NULL, NULL, '2025-04-01 12:29:12', '2025-08-24 06:26:30', NULL),
(256, 2, 34, 395, 4, 'Minima laboriosam et quis qui quia illo reiciendis explicabo enim ab.', 'pending', NULL, NULL, '2025-02-10 03:41:55', '2025-08-24 06:26:30', NULL),
(257, 5, 77, 629, 5, 'Voluptas ipsam consequuntur repellendus sapiente veritatis reprehenderit voluptas iusto maiores et voluptas est.', 'approved', NULL, NULL, '2024-09-23 11:46:55', '2025-08-24 06:26:30', NULL),
(258, 8, 34, 459, 3, 'Laboriosam deserunt sint non veniam consectetur quaerat provident recusandae.', 'approved', NULL, NULL, '2024-12-10 16:22:12', '2025-08-24 06:26:30', NULL),
(259, 12, 64, 89, 5, 'Sapiente aut beatae quisquam qui nemo dolores.', 'approved', NULL, NULL, '2025-02-25 22:27:34', '2025-08-24 06:26:30', NULL),
(260, 50, 62, 828, 2, 'Numquam in assumenda est placeat quo blanditiis.', 'pending', NULL, NULL, '2024-10-30 08:16:29', '2025-08-24 06:26:30', NULL),
(261, 48, 62, 936, 4, 'Molestiae nisi quae laudantium tempora doloribus delectus impedit labore sed alias.', 'pending', NULL, NULL, '2024-11-20 18:32:49', '2025-08-24 06:26:30', NULL),
(262, 5, 38, 615, 2, 'Repudiandae voluptatibus deleniti vel dignissimos dolores et dolores nulla.', 'rejected', NULL, NULL, '2024-11-15 00:08:29', '2025-08-24 06:26:30', NULL),
(263, 62, 28, 881, 2, 'Et ea molestiae voluptatem optio nisi numquam provident blanditiis eligendi sunt laboriosam.', 'rejected', NULL, NULL, '2025-03-05 19:45:53', '2025-08-24 06:26:30', NULL),
(264, 12, 75, 88, 1, 'Est consequatur vel sit aliquam qui ab magni a quae sed maiores magnam est.', 'pending', NULL, NULL, '2024-10-07 09:39:35', '2025-08-24 06:26:30', NULL),
(265, 50, 62, 1006, 2, 'Dicta est corrupti quae dolore architecto dolor velit.', 'rejected', NULL, NULL, '2025-03-06 01:39:50', '2025-08-24 06:26:30', NULL),
(266, 50, 62, 945, 5, 'Nihil inventore et aut voluptas ea consequatur mollitia illo magnam nobis.', 'pending', NULL, NULL, '2025-06-08 09:59:42', '2025-08-24 06:26:30', NULL),
(267, 8, 44, 423, 2, 'Nam assumenda cupiditate quod suscipit sit inventore eos quia.', 'rejected', NULL, NULL, '2024-12-31 14:28:25', '2025-08-24 06:26:30', NULL),
(268, 5, 71, 272, 2, 'Ullam harum ullam magnam nulla voluptatum molestiae eius eaque modi repellat et.', 'pending', NULL, NULL, '2025-06-26 18:08:13', '2025-08-24 06:26:30', NULL),
(269, 8, 22, 326, 5, 'Voluptatum rerum reprehenderit voluptatem aut qui ex ea quasi et facere.', 'rejected', NULL, NULL, '2025-03-04 19:30:07', '2025-08-24 06:26:30', NULL),
(270, 50, 62, 794, 1, 'Enim eligendi impedit omnis itaque sit ab laborum.', 'approved', NULL, NULL, '2024-11-17 20:18:32', '2025-08-24 06:26:30', NULL),
(271, 3, 43, 490, 5, 'Ea quos occaecati enim rem corporis dolores id consequatur et.', 'approved', NULL, NULL, '2024-08-24 07:51:59', '2025-08-24 06:26:30', NULL),
(272, 10, 29, 483, 5, 'Et est quia aut aperiam sequi omnis minima ut suscipit inventore reiciendis sint ab.', 'approved', NULL, NULL, '2025-07-19 11:12:18', '2025-08-24 06:26:30', NULL),
(273, 12, 74, 62, 5, 'Porro similique sed veniam pariatur ullam tempora ea maiores vel architecto suscipit.', 'rejected', NULL, NULL, '2025-02-06 20:29:27', '2025-08-24 06:26:30', NULL),
(274, 3, 39, 639, 1, 'Ea animi temporibus ad nulla officiis non asperiores quia recusandae cumque et aliquam.', 'approved', NULL, NULL, '2025-05-20 04:59:21', '2025-08-24 06:26:30', NULL),
(275, 5, 75, 458, 1, 'Accusantium quisquam blanditiis ut sed rem dicta voluptatem qui perferendis quis.', 'rejected', NULL, NULL, '2025-07-13 08:17:32', '2025-08-24 06:26:30', NULL),
(276, 8, 45, 322, 4, 'Dolorum voluptates autem qui libero dolor voluptatem excepturi in.', 'rejected', NULL, NULL, '2025-08-14 10:31:44', '2025-08-24 06:26:30', NULL),
(277, 12, 51, 551, 1, 'Mollitia doloremque debitis ut maxime incidunt vero labore earum rerum.', 'pending', NULL, NULL, '2025-06-11 12:21:50', '2025-08-24 06:26:30', NULL),
(278, 8, 30, 143, 1, 'Veniam eligendi repudiandae omnis id maiores non pariatur rerum fuga atque quisquam.', 'approved', NULL, NULL, '2025-07-02 02:08:42', '2025-08-24 06:26:30', NULL),
(279, 62, 45, 953, 1, 'Unde qui in corrupti voluptate culpa dolores neque corporis.', 'pending', NULL, NULL, '2025-04-25 23:22:56', '2025-08-24 06:26:30', NULL),
(280, 4, 31, 199, 3, 'Laborum sed deserunt quis officia doloremque placeat fugiat non laboriosam delectus ullam.', 'pending', NULL, NULL, '2024-12-21 16:38:18', '2025-08-24 06:26:30', NULL),
(281, 13, 77, 94, 5, 'Illo voluptate vel architecto dolorem commodi quae unde et accusamus natus.', 'rejected', NULL, NULL, '2025-06-10 16:33:22', '2025-08-24 06:26:30', NULL),
(282, 4, 58, 573, 3, 'Neque quae eos et voluptatem aut nulla ea.', 'approved', NULL, NULL, '2025-01-07 01:06:54', '2025-08-24 06:26:30', NULL),
(283, 62, 71, 1003, 2, 'Sunt autem est distinctio voluptas provident pariatur non.', 'approved', NULL, NULL, '2025-04-28 09:25:28', '2025-08-24 06:26:30', NULL),
(284, 12, 67, 68, 4, 'Quaerat quia qui in qui impedit non voluptatem aliquam quis.', 'pending', NULL, NULL, '2025-03-02 06:59:20', '2025-08-24 06:26:30', NULL),
(285, 13, 77, 94, 2, 'Impedit nulla repudiandae dolor et dolor cum voluptas sint et placeat rerum cupiditate inventore.', 'pending', NULL, NULL, '2024-11-14 05:23:15', '2025-08-24 06:26:30', NULL),
(286, 50, 64, 944, 5, 'Quidem rem repudiandae perspiciatis aliquid ad architecto consequatur est deleniti aut.', 'rejected', NULL, NULL, '2025-07-07 01:13:19', '2025-08-24 06:26:30', NULL),
(287, 5, 55, 418, 2, 'Voluptas quo omnis quod omnis et qui cum molestias vero temporibus.', 'rejected', NULL, NULL, '2025-03-16 20:45:03', '2025-08-24 06:26:30', NULL),
(288, 8, 54, 407, 5, 'Quam ut exercitationem ab rem dolor error accusantium et rem et.', 'pending', NULL, NULL, '2024-12-14 00:35:03', '2025-08-24 06:26:30', NULL),
(289, 12, 74, 62, 1, 'Et omnis veritatis nesciunt fuga ab rerum reiciendis rerum.', 'rejected', NULL, NULL, '2024-09-17 09:13:36', '2025-08-24 06:26:30', NULL),
(290, 3, 58, 480, 1, 'Sunt molestiae consequatur explicabo est rerum neque voluptate.', 'pending', NULL, NULL, '2024-10-26 00:49:13', '2025-08-24 06:26:30', NULL),
(291, 48, 44, 846, 2, 'Necessitatibus omnis quia est voluptatibus aspernatur expedita voluptate aut magni voluptatibus vel aut cumque.', 'rejected', NULL, NULL, '2025-01-06 16:05:44', '2025-08-24 06:26:30', NULL),
(292, 10, 43, 626, 4, 'Molestiae ratione et dolorum repellat alias voluptas adipisci exercitationem nostrum aspernatur iste esse.', 'rejected', NULL, NULL, '2024-09-07 08:06:03', '2025-08-24 06:26:30', NULL),
(293, 50, 62, 967, 1, 'Voluptate repellendus iusto earum neque voluptatibus nostrum molestias qui fugiat necessitatibus consequatur nihil.', 'pending', NULL, NULL, '2024-10-25 15:09:26', '2025-08-24 06:26:30', NULL),
(294, 6, 45, 289, 2, 'Quae eos hic voluptatibus esse et non molestias explicabo rem unde.', 'approved', NULL, NULL, '2025-01-25 16:42:07', '2025-08-24 06:26:30', NULL),
(295, 12, 74, 656, 5, 'Quasi nobis sunt dolores voluptas culpa eos excepturi possimus dolores ut et voluptates.', 'rejected', NULL, NULL, '2025-03-21 18:13:03', '2025-08-24 06:26:30', NULL),
(296, 12, 37, 79, 3, 'Incidunt incidunt consequatur quam possimus rem dolore ex earum et est iure nesciunt velit.', 'rejected', NULL, NULL, '2024-12-14 04:28:56', '2025-08-24 06:26:30', NULL),
(297, 8, 54, 989, 5, 'Accusamus rerum autem in maiores explicabo est consequuntur aut sequi quia sunt et.', 'pending', NULL, NULL, '2024-10-14 23:51:43', '2025-08-24 06:26:30', NULL),
(298, 10, 34, 400, 3, 'Vero autem magnam vero repudiandae ducimus unde eum dolorum.', 'rejected', NULL, NULL, '2024-11-23 08:17:56', '2025-08-24 06:26:30', NULL),
(299, 10, 22, 394, 5, 'Corrupti veritatis exercitationem recusandae impedit aut recusandae illo.', 'approved', NULL, NULL, '2025-04-23 18:50:00', '2025-08-24 06:26:30', NULL),
(300, 3, 74, 730, 4, 'Maxime quia enim iusto enim dicta fuga doloremque tempora occaecati dicta qui rerum.', 'approved', NULL, NULL, '2025-08-08 15:20:33', '2025-08-24 06:26:30', NULL),
(301, 50, 32, 923, 5, 'Quos dolore dolores ullam quae fuga est vero amet atque rerum culpa facere.', 'rejected', NULL, NULL, '2025-02-15 21:27:26', '2025-08-24 06:26:30', NULL),
(302, 8, 54, 310, 1, 'Dolore sit minus ut aut et ipsa ut possimus at tempore aspernatur ut eligendi.', 'approved', NULL, NULL, '2025-01-12 08:26:31', '2025-08-24 06:26:30', NULL),
(303, 4, 32, 123, 1, 'Qui deserunt quis vel aut aspernatur non recusandae omnis qui minus eveniet est asperiores.', 'rejected', NULL, NULL, '2024-10-28 05:09:18', '2025-08-24 06:26:30', NULL),
(304, 10, 39, 562, 4, 'Consequatur voluptate voluptatem veritatis odit aliquid perferendis.', 'approved', NULL, NULL, '2025-05-10 17:23:57', '2025-08-24 06:26:30', NULL),
(305, 4, 29, 688, 3, 'Quasi saepe rerum aut et voluptatum blanditiis.', 'pending', NULL, NULL, '2025-07-29 12:44:13', '2025-08-24 06:26:30', NULL),
(306, 8, 45, 895, 5, 'Aliquid suscipit numquam doloremque veniam laudantium neque asperiores et.', 'pending', NULL, NULL, '2025-07-03 10:02:38', '2025-08-24 06:26:30', NULL),
(307, 5, 22, 298, 4, 'Dolorem accusantium molestias praesentium nisi numquam dolorem adipisci.', 'pending', NULL, NULL, '2025-02-19 04:49:44', '2025-08-24 06:26:30', NULL),
(308, 48, 62, 936, 1, 'Maiores ut rerum et est facilis aut qui ipsam omnis rerum laudantium itaque quos.', 'pending', NULL, NULL, '2025-01-10 13:09:29', '2025-08-24 06:26:30', NULL),
(309, 5, 51, 649, 3, 'Culpa temporibus voluptatem ut consequuntur fuga temporibus ut et neque eos inventore dolor.', 'approved', NULL, NULL, '2025-08-21 08:40:34', '2025-08-24 06:26:30', NULL),
(310, 50, 44, 839, 2, 'Ut molestias rerum voluptatem est recusandae sed occaecati perferendis consequuntur ea.', 'rejected', NULL, NULL, '2025-01-31 21:33:53', '2025-08-24 06:26:30', NULL),
(311, 8, 31, 470, 1, 'Veniam tempore rerum assumenda hic necessitatibus repellat aut vitae eos repudiandae.', 'rejected', NULL, NULL, '2024-11-13 18:43:48', '2025-08-24 06:26:30', NULL),
(312, 3, 46, 478, 1, 'Similique animi error sed rerum consequatur sapiente.', 'rejected', NULL, NULL, '2024-11-29 23:37:48', '2025-08-24 06:26:30', NULL),
(313, 12, 74, 82, 1, 'Esse incidunt corporis quia itaque nesciunt non rerum impedit et cupiditate.', 'pending', NULL, NULL, '2025-04-05 16:35:23', '2025-08-24 06:26:30', NULL),
(314, 4, 26, 136, 3, 'Ipsa nobis et iure eum soluta sit est illum omnis quam harum quos error.', 'approved', NULL, NULL, '2025-01-16 08:10:57', '2025-08-24 06:26:30', NULL),
(315, 10, 46, 521, 4, 'Dolorem qui cum qui fuga repellat tempora cumque hic mollitia optio.', 'approved', NULL, NULL, '2025-04-03 10:08:54', '2025-08-24 06:26:30', NULL),
(316, 5, 39, 553, 3, 'Voluptatum optio hic ut rerum amet aut ex nemo labore quisquam.', 'pending', NULL, NULL, '2025-02-01 16:50:49', '2025-08-24 06:26:30', NULL),
(317, 12, 76, 80, 5, 'Ratione facere iste ut molestiae est debitis deleniti nemo sapiente eos ipsa.', 'approved', NULL, NULL, '2024-12-20 02:27:56', '2025-08-24 06:26:30', NULL),
(318, 8, 72, 886, 2, 'Blanditiis repellat et consectetur similique sint accusantium et modi porro nulla eos architecto id.', 'rejected', NULL, NULL, '2025-03-08 18:50:40', '2025-08-24 06:26:30', NULL),
(319, 6, 47, 220, 1, 'Porro qui provident voluptatem ipsam magnam dolores maxime sed autem dolorum.', 'approved', NULL, NULL, '2024-10-11 05:29:09', '2025-08-24 06:26:30', NULL),
(320, 8, 31, 366, 4, 'Aperiam quia est consequatur qui nemo architecto corrupti enim enim.', 'pending', NULL, NULL, '2024-11-22 04:06:16', '2025-08-24 06:26:30', NULL);
INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `order_item_id`, `rating`, `comment`, `status`, `admin_reply`, `admin_reply_created_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(321, 50, 64, 944, 2, 'Quaerat minus perferendis quis labore omnis quod harum.', 'approved', NULL, NULL, '2024-12-06 03:39:22', '2025-08-24 06:26:30', NULL),
(322, 12, 67, 73, 2, 'Laudantium dolores ut quidem fugit ex excepturi quidem assumenda nesciunt voluptatem quis architecto.', 'rejected', NULL, NULL, '2025-07-17 01:16:32', '2025-08-24 06:26:30', NULL),
(323, 5, 46, 743, 4, 'Minus ad reprehenderit enim mollitia eligendi veniam eveniet pariatur suscipit accusamus est laborum.', 'pending', NULL, NULL, '2024-10-27 00:06:33', '2025-08-24 06:26:30', NULL),
(324, 4, 77, 654, 1, 'Enim distinctio perferendis soluta et omnis et iusto omnis commodi quia.', 'pending', NULL, NULL, '2024-10-10 04:13:38', '2025-08-24 06:26:30', NULL),
(325, 8, 71, 865, 1, 'Sed sunt maiores cum maxime quo iste et cumque dolorem exercitationem aut veritatis voluptas.', 'approved', NULL, NULL, '2025-02-19 22:32:37', '2025-08-24 06:26:30', NULL),
(326, 5, 29, 647, 4, 'Facilis nobis ad quibusdam necessitatibus corrupti explicabo voluptate incidunt.', 'approved', NULL, NULL, '2024-09-07 00:27:02', '2025-08-24 06:26:30', NULL),
(327, 12, 77, 557, 2, 'Temporibus doloremque nulla voluptatum earum voluptatibus eaque quidem facilis quis incidunt et.', 'pending', NULL, NULL, '2024-10-27 14:00:38', '2025-08-24 06:26:30', NULL),
(328, 14, 69, 83, 3, 'Fugit labore maxime ducimus eaque qui ipsam blanditiis.', 'rejected', NULL, NULL, '2024-12-01 00:09:54', '2025-08-24 06:26:30', NULL),
(329, 13, 63, 91, 2, 'Tempore autem aut expedita cumque qui eligendi.', 'pending', NULL, NULL, '2025-02-23 17:03:05', '2025-08-24 06:26:30', NULL),
(330, 22, 28, 931, 2, 'At facilis sit et sit doloremque qui.', 'pending', NULL, NULL, '2024-11-21 21:51:44', '2025-08-24 06:26:30', NULL),
(331, 5, 58, 578, 3, 'Cumque placeat nulla excepturi dolor a animi.', 'rejected', NULL, NULL, '2024-12-18 21:28:36', '2025-08-24 06:26:30', NULL),
(332, 8, 32, 229, 1, 'Ipsa accusantium tempore molestiae tenetur repudiandae qui et.', 'pending', NULL, NULL, '2025-05-21 06:07:14', '2025-08-24 06:26:30', NULL),
(333, 13, 75, 99, 1, 'Eaque in cupiditate et iure sed quis omnis hic.', 'approved', NULL, NULL, '2025-06-17 16:04:10', '2025-08-24 06:26:30', NULL),
(334, 13, 66, 100, 2, 'Nam odio commodi voluptatum consequatur est non tenetur tenetur illum voluptatem architecto.', 'pending', NULL, NULL, '2024-09-20 11:20:54', '2025-08-24 06:26:30', NULL),
(335, 14, 47, 189, 1, 'Dolor incidunt consequatur eos rerum eos repellendus delectus vel voluptas fugiat rerum qui dicta.', 'pending', NULL, NULL, '2025-03-06 02:22:42', '2025-08-24 06:26:30', NULL),
(336, 14, 27, 117, 2, 'Ea accusamus nemo est ea est fuga voluptas.', 'pending', NULL, NULL, '2024-12-30 05:17:18', '2025-08-24 06:26:30', NULL),
(337, 22, 28, 931, 3, 'Ipsam eligendi velit corrupti ad et illo iusto eos dolore dolore autem.', 'pending', NULL, NULL, '2024-12-21 23:13:46', '2025-08-24 06:26:30', NULL),
(338, 5, 55, 248, 2, 'Omnis quos officia quasi eos commodi sit est sed delectus architecto harum.', 'approved', NULL, NULL, '2024-12-26 03:39:56', '2025-08-24 06:26:30', NULL),
(339, 5, 22, 438, 2, 'Dignissimos quo minima ut quae reiciendis amet dolore quaerat numquam qui.', 'pending', NULL, NULL, '2025-07-26 18:09:46', '2025-08-24 06:26:30', NULL),
(340, 4, 43, 597, 1, 'Officia et eos accusamus dolorum error debitis sunt cum.', 'pending', NULL, NULL, '2024-10-02 16:51:35', '2025-08-24 06:26:30', NULL),
(341, 50, 71, 837, 1, 'Sapiente explicabo aut molestiae ut architecto facilis eos quo.', 'approved', NULL, NULL, '2024-10-10 12:35:51', '2025-08-24 06:26:30', NULL),
(342, 3, 39, 728, 2, 'Consectetur perferendis nostrum enim ut exercitationem est est modi non voluptatibus.', 'rejected', NULL, NULL, '2024-10-20 17:47:00', '2025-08-24 06:26:30', NULL),
(343, 12, 77, 59, 1, 'Saepe blanditiis autem quia corporis dolorem error sit eligendi quam sit velit at.', 'rejected', NULL, NULL, '2024-12-10 23:51:32', '2025-08-24 06:26:30', NULL),
(344, 12, 64, 89, 4, 'Ad praesentium optio deserunt porro sunt perspiciatis ut neque doloremque et.', 'approved', NULL, NULL, '2025-05-25 20:25:26', '2025-08-24 06:26:30', NULL),
(345, 8, 64, 780, 3, 'Ad aut quo autem eos ut vero asperiores.', 'approved', NULL, NULL, '2025-03-08 18:16:06', '2025-08-24 06:26:30', NULL),
(346, 10, 43, 626, 2, 'Itaque non maxime sed qui voluptatum enim.', 'approved', NULL, NULL, '2024-11-06 14:35:04', '2025-08-24 06:26:30', NULL),
(347, 8, 45, 363, 3, 'Quam et quis sit aut explicabo incidunt ea reprehenderit libero nihil.', 'pending', NULL, NULL, '2024-11-19 01:37:37', '2025-08-24 06:26:30', NULL),
(348, 3, 42, 547, 2, 'Et quia ea eveniet omnis ipsam laboriosam omnis aut amet.', 'pending', NULL, NULL, '2025-01-13 16:22:37', '2025-08-24 06:26:30', NULL),
(349, 8, 71, 971, 5, 'Sit repudiandae nam sit et autem corrupti modi et.', 'approved', NULL, NULL, '2025-07-08 19:00:06', '2025-08-24 06:26:30', NULL),
(350, 4, 31, 196, 5, 'Quia dolores et quis illum voluptatem nobis fuga numquam molestiae explicabo numquam.', 'pending', NULL, NULL, '2024-11-13 13:09:00', '2025-08-24 06:26:30', NULL),
(351, 4, 74, 493, 1, 'Distinctio eligendi explicabo tempore repudiandae aspernatur et aut.', 'approved', NULL, NULL, '2025-08-11 13:49:28', '2025-08-24 06:26:30', NULL),
(352, 4, 58, 575, 5, 'Vitae accusantium perferendis ab voluptatibus reprehenderit in natus ipsum pariatur ullam.', 'rejected', NULL, NULL, '2025-05-07 17:57:57', '2025-08-24 06:26:30', NULL),
(353, 22, 71, 844, 1, 'Saepe dolorem a eum velit provident perferendis eius ab.', 'rejected', NULL, NULL, '2025-01-08 10:00:23', '2025-08-24 06:26:30', NULL),
(354, 6, 75, 251, 3, 'Sit mollitia unde sunt aut neque vero consequatur dolor aperiam.', 'approved', NULL, NULL, '2024-08-25 20:40:23', '2025-08-24 06:26:30', NULL),
(355, 8, 32, 988, 2, 'Saepe aut dicta omnis dignissimos qui consequatur est.', 'pending', NULL, NULL, '2024-09-06 05:10:08', '2025-08-24 06:26:30', NULL),
(356, 5, 51, 649, 4, 'Et debitis eaque modi quis et animi in qui officia numquam alias voluptatem.', 'approved', NULL, NULL, '2025-03-31 17:59:07', '2025-08-24 06:26:30', NULL),
(357, 3, 42, 621, 2, 'Culpa nobis odit voluptates eum minus perferendis sunt odio suscipit sit error.', 'approved', NULL, NULL, '2025-02-24 00:43:26', '2025-08-24 06:26:30', NULL),
(358, 3, 51, 491, 3, 'Inventore dolorem blanditiis ut sunt dolor quo accusamus delectus beatae temporibus.', 'pending', NULL, NULL, '2025-02-05 06:33:46', '2025-08-24 06:26:30', NULL),
(359, 14, 47, 167, 2, 'Excepturi quo reprehenderit atque sint praesentium dolor quaerat.', 'pending', NULL, NULL, '2025-04-15 02:26:08', '2025-08-24 06:26:30', NULL),
(360, 8, 22, 260, 2, 'Assumenda est sed et fuga non necessitatibus pariatur aspernatur quam corrupti nostrum atque aperiam.', 'rejected', NULL, NULL, '2024-09-23 16:59:36', '2025-08-24 06:26:30', NULL),
(361, 8, 45, 215, 4, 'Voluptatum tenetur rerum qui veniam officiis ea sit ut.', 'rejected', NULL, NULL, '2024-11-30 00:41:24', '2025-08-24 06:26:30', NULL),
(362, 6, 22, 275, 3, 'Minima dolor qui aut aut omnis eligendi officia aut odio fugiat.', 'rejected', NULL, NULL, '2025-06-11 03:37:23', '2025-08-24 06:26:30', NULL),
(363, 2, 71, 280, 5, 'Voluptas nisi voluptatem dolorem accusantium sapiente qui aperiam maxime voluptas odio sapiente maxime.', 'approved', NULL, NULL, '2024-10-10 06:49:48', '2025-08-24 06:26:30', NULL),
(364, 3, 51, 492, 3, 'Laboriosam et reiciendis et labore quia est fugit molestiae iure tempora nulla et.', 'pending', NULL, NULL, '2025-06-03 16:57:02', '2025-08-24 06:26:30', NULL),
(365, 4, 29, 595, 2, 'Tempora aliquid perspiciatis ratione recusandae assumenda numquam odit fugiat enim eos voluptatem.', 'pending', NULL, NULL, '2025-06-07 11:35:16', '2025-08-24 06:26:30', NULL),
(366, 3, 43, 490, 2, 'Ex quae magnam qui sed explicabo ea explicabo exercitationem et fuga nulla veritatis.', 'pending', NULL, NULL, '2024-11-08 16:47:27', '2025-08-24 06:26:30', NULL),
(367, 4, 39, 710, 3, 'Non est ullam blanditiis exercitationem incidunt odio odit blanditiis porro qui rerum molestias deserunt.', 'rejected', NULL, NULL, '2025-07-27 15:02:29', '2025-08-24 06:26:30', NULL),
(368, 8, 47, 231, 1, 'Minima autem id perspiciatis quia possimus harum.', 'rejected', NULL, NULL, '2025-02-08 23:05:19', '2025-08-24 06:26:30', NULL),
(369, 8, 54, 969, 1, 'Sequi perferendis quaerat rerum aperiam laudantium voluptatem qui vitae debitis in vel et sequi.', 'rejected', NULL, NULL, '2025-08-06 18:08:34', '2025-08-24 06:26:30', NULL),
(370, 22, 64, 940, 3, 'Est omnis veritatis vel excepturi et quibusdam qui eius labore neque pariatur reprehenderit ea.', 'pending', NULL, NULL, '2024-09-08 10:37:24', '2025-08-24 06:26:30', NULL),
(371, 8, 30, 143, 2, 'Incidunt sit quas qui qui doloremque ut aliquam.', 'pending', NULL, NULL, '2025-08-17 17:08:59', '2025-08-24 06:26:30', NULL),
(372, 6, 32, 173, 1, 'Asperiores officiis delectus et et sequi quod.', 'approved', NULL, NULL, '2025-02-11 03:09:41', '2025-08-24 06:26:30', NULL),
(373, 4, 67, 198, 5, 'Excepturi nisi autem qui explicabo nobis debitis doloribus ut fugit perferendis eligendi.', 'pending', NULL, NULL, '2025-07-18 02:01:45', '2025-08-24 06:26:30', NULL),
(374, 8, 54, 429, 1, 'In nulla aut quo rerum aut inventore quis ut.', 'approved', NULL, NULL, '2025-02-20 00:58:31', '2025-08-24 06:26:30', NULL),
(375, 62, 45, 762, 3, 'Consectetur ea modi magni repellat delectus nulla esse.', 'approved', NULL, NULL, '2024-11-01 13:35:44', '2025-08-24 06:26:30', NULL),
(376, 13, 76, 95, 5, 'Sit perspiciatis libero delectus consequuntur dolores suscipit ullam quisquam sint aut aperiam quasi.', 'approved', NULL, NULL, '2024-11-16 18:20:19', '2025-08-24 06:26:30', NULL),
(377, 62, 45, 955, 3, 'Et voluptas veniam labore aut quo fugiat vitae voluptas.', 'rejected', NULL, NULL, '2025-03-29 02:27:44', '2025-08-24 06:26:30', NULL),
(378, 48, 32, 943, 5, 'Expedita sed quia inventore qui et aut velit reiciendis nihil perferendis est.', 'pending', NULL, NULL, '2025-08-17 21:48:20', '2025-08-24 06:26:30', NULL),
(379, 48, 62, 770, 4, 'Autem atque ea error quidem nihil id numquam mollitia voluptates ratione quis.', 'approved', NULL, NULL, '2025-02-23 19:28:33', '2025-08-24 06:26:30', NULL),
(380, 6, 45, 287, 2, 'Provident excepturi aut est hic veritatis dolor earum aliquid.', 'approved', NULL, NULL, '2024-09-04 18:39:09', '2025-08-24 06:26:30', NULL),
(381, 62, 62, 1015, 3, 'Ullam quibusdam maxime vero et quam beatae est quod.', 'approved', NULL, NULL, '2024-12-01 13:55:07', '2025-08-24 06:26:30', NULL),
(382, 3, 46, 541, 5, 'Repellat ipsam occaecati deserunt ut vel sunt id quod error ut expedita.', 'pending', NULL, NULL, '2025-02-23 22:55:15', '2025-08-24 06:26:30', NULL),
(383, 22, 72, 960, 2, 'Quia ut non quae animi magni amet exercitationem magni eos ut molestiae et sit.', 'rejected', NULL, NULL, '2025-04-15 19:29:32', '2025-08-24 06:26:30', NULL),
(384, 12, 42, 680, 1, 'Maiores sequi laboriosam aut odio ab ut exercitationem dolor eligendi rerum ut odio molestias.', 'rejected', NULL, NULL, '2025-03-28 18:12:13', '2025-08-24 06:26:30', NULL),
(385, 14, 26, 177, 4, 'Quibusdam ex sed sit est perspiciatis saepe excepturi asperiores atque consequuntur aperiam.', 'approved', NULL, NULL, '2024-12-02 17:16:44', '2025-08-24 06:26:30', NULL),
(386, 8, 71, 477, 3, 'Facere quo ex non atque rem molestiae aut dolor mollitia nobis velit est.', 'approved', NULL, NULL, '2025-02-27 14:11:30', '2025-08-24 06:26:30', NULL),
(387, 48, 28, 803, 2, 'Illo ducimus eaque sed consectetur molestias eos qui cumque consectetur et tempora in porro.', 'rejected', NULL, NULL, '2025-07-11 16:39:08', '2025-08-24 06:26:30', NULL),
(388, 2, 71, 343, 3, 'Sit est corporis sunt aspernatur tenetur velit quo rerum.', 'approved', NULL, NULL, '2025-03-21 12:59:27', '2025-08-24 06:26:30', NULL),
(389, 22, 28, 933, 1, 'Tempora ratione doloremque ratione sed qui nihil voluptatem deleniti autem eos alias minus.', 'approved', NULL, NULL, '2025-03-16 00:30:22', '2025-08-24 06:26:30', NULL),
(390, 6, 31, 339, 1, 'Natus aut odit eos delectus officiis ullam veniam modi.', 'pending', NULL, NULL, '2025-07-11 01:38:47', '2025-08-24 06:26:30', NULL),
(391, 8, 45, 259, 1, 'Exercitationem molestiae autem et sit nihil suscipit ducimus veniam explicabo voluptatem facere voluptas eum.', 'pending', NULL, NULL, '2024-11-07 20:33:40', '2025-08-24 06:26:30', NULL),
(392, 3, 39, 496, 3, 'Exercitationem quidem ipsum non eveniet aut ratione.', 'approved', NULL, NULL, '2025-01-04 11:13:18', '2025-08-24 06:26:30', NULL),
(393, 3, 74, 479, 2, 'Quo velit id provident nulla dolorum natus inventore aut quia quisquam dolorem.', 'pending', NULL, NULL, '2025-02-24 21:28:48', '2025-08-24 06:26:30', NULL),
(394, 10, 46, 513, 4, 'Atque quia earum sint sint doloribus provident deserunt cum est asperiores.', 'approved', NULL, NULL, '2024-12-20 09:35:12', '2025-08-24 06:26:30', NULL),
(395, 10, 34, 448, 5, 'Velit laborum beatae aspernatur dignissimos officiis ducimus quis laudantium voluptatum illo.', 'pending', NULL, NULL, '2025-04-09 10:16:09', '2025-08-24 06:26:30', NULL),
(396, 4, 51, 634, 3, 'Excepturi ab minima non dicta excepturi nulla illo.', 'pending', NULL, NULL, '2025-05-25 20:37:03', '2025-08-24 06:26:30', NULL),
(397, 3, 42, 659, 4, 'Possimus vel occaecati tenetur aliquid impedit ex voluptatum atque accusantium id libero officiis nam.', 'rejected', NULL, NULL, '2024-11-13 16:49:42', '2025-08-24 06:26:30', NULL),
(398, 6, 28, 159, 4, 'Rerum deleniti aut voluptatum ea molestiae qui autem alias.', 'rejected', NULL, NULL, '2025-03-18 08:28:37', '2025-08-24 06:26:30', NULL),
(399, 12, 65, 74, 5, 'Animi ut qui illo provident est et vel enim perspiciatis molestiae doloribus.', 'rejected', NULL, NULL, '2025-04-05 18:13:30', '2025-08-24 06:26:30', NULL),
(400, 12, 38, 679, 4, 'Voluptate aut nesciunt mollitia incidunt cum voluptates ullam voluptatem.', 'approved', NULL, NULL, '2024-11-25 17:05:11', '2025-08-24 06:26:30', NULL),
(401, 22, 74, 870, 5, 'Velit nulla iusto alias ducimus est sed facere nihil.', 'rejected', NULL, NULL, '2025-06-22 10:52:57', '2025-08-24 06:26:30', NULL),
(402, 62, 72, 835, 2, 'Maxime et possimus earum est ut dolorum modi nisi aliquid.', 'approved', NULL, NULL, '2024-09-08 12:17:22', '2025-08-24 06:26:30', NULL),
(403, 2, 44, 379, 5, 'Et tenetur quae omnis nemo architecto iste.', 'rejected', NULL, NULL, '2024-11-25 01:23:28', '2025-08-24 06:26:30', NULL),
(404, 8, 31, 473, 3, 'Velit esse aliquam voluptatem rerum corrupti sed quis laboriosam ut ut consequuntur ab ut.', 'approved', NULL, NULL, '2024-09-03 20:23:19', '2025-08-24 06:26:30', NULL),
(405, 48, 44, 772, 3, 'Perferendis omnis quam quae et aut aspernatur doloribus perspiciatis et placeat.', 'pending', NULL, NULL, '2025-07-30 21:49:51', '2025-08-24 06:26:30', NULL),
(406, 6, 22, 235, 3, 'Omnis debitis ad provident expedita qui magnam.', 'rejected', NULL, NULL, '2025-05-06 10:43:18', '2025-08-24 06:26:30', NULL),
(407, 8, 45, 368, 5, 'Tenetur qui cum non doloribus doloribus nisi qui.', 'pending', NULL, NULL, '2025-01-24 15:15:52', '2025-08-24 06:26:30', NULL),
(408, 10, 38, 624, 5, 'Voluptatem et et iste quia aut molestias eaque consequuntur est quod alias facere totam.', 'approved', NULL, NULL, '2025-06-19 23:10:31', '2025-08-24 06:26:30', NULL),
(409, 8, 31, 238, 1, 'Quasi sed quisquam accusamus similique quia autem qui dolores saepe porro.', 'pending', NULL, NULL, '2025-07-15 02:06:57', '2025-08-24 06:26:30', NULL),
(410, 14, 45, 213, 5, 'Nesciunt rerum et aut eius iusto suscipit.', 'approved', NULL, NULL, '2024-11-04 17:29:33', '2025-08-24 06:26:30', NULL),
(411, 8, 45, 170, 2, 'Optio iste a soluta assumenda et aut totam earum quia culpa commodi consectetur.', 'rejected', NULL, NULL, '2025-07-06 08:10:38', '2025-08-24 06:26:30', NULL),
(412, 6, 75, 430, 5, 'Corporis perspiciatis omnis sunt nisi aut tempora nisi eum perspiciatis.', 'approved', NULL, NULL, '2025-04-17 08:48:18', '2025-08-24 06:26:30', NULL),
(413, 5, 58, 648, 3, 'Laudantium sint esse sapiente sint vero ducimus nesciunt eum earum.', 'rejected', NULL, NULL, '2024-09-03 10:39:34', '2025-08-24 06:26:30', NULL),
(414, 12, 64, 89, 4, 'Incidunt velit voluptates rerum quia voluptas esse odit in non et enim sit impedit nulla.', 'approved', NULL, NULL, '2025-05-02 02:31:36', '2025-08-24 06:26:30', NULL),
(415, 3, 74, 542, 2, 'Molestiae laudantium aut molestiae id dolor consequatur qui a.', 'rejected', NULL, NULL, '2025-07-25 23:21:06', '2025-08-24 06:26:30', NULL),
(416, 12, 58, 500, 2, 'Rerum voluptatem dolorum libero rem et voluptatem blanditiis perferendis omnis.', 'pending', NULL, NULL, '2024-10-29 16:46:19', '2025-08-24 06:26:30', NULL),
(417, 5, 38, 615, 5, 'Rerum ipsam molestiae natus veritatis mollitia facilis eveniet qui exercitationem.', 'pending', NULL, NULL, '2024-09-23 19:51:10', '2025-08-24 06:26:30', NULL),
(418, 8, 55, 239, 2, 'Quo sit repellat esse non aut ipsum nobis quia et fugiat commodi.', 'approved', NULL, NULL, '2024-09-02 23:55:24', '2025-08-24 06:26:30', NULL),
(419, 4, 31, 204, 1, 'Architecto enim sed rerum voluptatibus consectetur molestias sunt nam aliquid rerum ut at.', 'pending', NULL, NULL, '2025-06-02 18:21:25', '2025-08-24 06:26:30', NULL),
(420, 14, 45, 147, 4, 'Et voluptatem amet culpa molestiae reprehenderit et ex accusamus aut quam eum qui qui.', 'approved', NULL, NULL, '2024-12-29 02:54:47', '2025-08-24 06:26:30', NULL),
(421, 12, 77, 706, 5, 'Non aut harum earum ut doloribus in dignissimos dolor provident ullam.', 'pending', NULL, NULL, '2025-05-04 06:56:51', '2025-08-24 06:26:30', NULL),
(422, 6, 34, 336, 4, 'Excepturi perferendis cumque ratione iusto dignissimos odio.', 'rejected', NULL, NULL, '2025-02-13 03:44:59', '2025-08-24 06:26:30', NULL),
(423, 8, 22, 269, 4, 'Provident quae et ad cupiditate voluptates distinctio illo culpa optio itaque totam modi voluptas.', 'pending', NULL, NULL, '2025-01-20 04:27:03', '2025-08-24 06:26:30', NULL),
(424, 2, 22, 331, 5, 'Cum odit est cumque nulla vel velit itaque inventore minima nemo delectus voluptas qui.', 'approved', NULL, NULL, '2025-06-21 11:02:13', '2025-08-24 06:26:30', NULL),
(425, 8, 47, 227, 4, 'Non libero minima nostrum molestiae sunt molestias reiciendis dolores vel quos perspiciatis praesentium nostrum.', 'approved', NULL, NULL, '2025-08-11 17:15:13', '2025-08-24 06:26:30', NULL),
(426, 5, 29, 692, 1, 'Veniam ut optio ducimus ut aperiam dolore sed sunt assumenda.', 'rejected', NULL, NULL, '2025-06-10 06:41:32', '2025-08-24 06:26:30', NULL),
(427, 12, 76, 80, 2, 'Explicabo magnam quae saepe sit possimus voluptas fugit officiis amet.', 'approved', NULL, NULL, '2025-07-18 22:08:28', '2025-08-24 06:26:30', NULL),
(428, 14, 68, 225, 5, 'Aut iusto et dolor maxime mollitia sit magnam quia.', 'approved', NULL, NULL, '2025-07-24 23:29:38', '2025-08-24 06:26:30', NULL),
(429, 5, 39, 580, 4, 'Itaque dolor est reiciendis sint aut consequatur velit ut laudantium quam soluta.', 'rejected', NULL, NULL, '2024-12-01 12:09:31', '2025-08-24 06:26:30', NULL),
(430, 8, 31, 103, 3, 'Quia aperiam et labore aliquam aut minima quis quas quia impedit explicabo dolorem eos.', 'pending', NULL, NULL, '2025-04-08 10:37:07', '2025-08-24 06:26:30', NULL),
(431, 10, 74, 719, 5, 'Dolorem sequi aperiam culpa repellat et temporibus voluptatibus deserunt dolorum.', 'rejected', NULL, NULL, '2024-11-27 03:53:38', '2025-08-24 06:26:30', NULL),
(432, 6, 40, 357, 2, 'Accusantium consectetur dolor numquam autem ad assumenda unde quia quidem repellendus temporibus officiis.', 'approved', NULL, NULL, '2024-11-15 03:53:12', '2025-08-24 06:26:30', NULL),
(433, 14, 55, 1020, 5, 'hẹ hẹ hgej hẹ', 'pending', NULL, NULL, '2025-08-24 15:39:12', '2025-08-24 15:39:12', NULL),
(434, 14, 76, 1021, 5, 'san pơham dep', 'approved', NULL, NULL, '2025-08-24 15:40:36', '2025-08-24 15:41:51', NULL),
(435, 156, 69, 1022, 5, 'san pham rat dep', 'approved', NULL, NULL, '2025-08-25 15:03:08', '2025-08-25 15:03:42', NULL),
(436, 156, 42, 1026, 5, 'san pham rat dep', 'approved', NULL, NULL, '2025-08-25 16:04:11', '2025-08-25 16:04:42', NULL);

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
('2dPiSBZiih8KbeMV9Y2xCpy1mfRuQoSsDgSvgHsX', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNlo0OEs3cEthYXp6QjBKNUY1MGg0S24zQ0liSHluNUZxZGpmZ0Z0VCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9pbWFnZXMvYmctbWVudS9tb3JlLnBuZyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEyO30=', 1756142892),
('7gD5l8gHVz3VF2lNhm4fd6r3hRzXEEqrDheIPOWU', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZk5HRVFobEJkVGZ0N3pxTEhPc3RabTBzZVlOc2Zra2pEalFzNWF0eSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tZXNzYWdlcyI7fXM6NToic3RhdGUiO3M6NDA6InNHUGJ3YkEwU1lBYkZSSjMzTW90SHh5RHlhemxiYU5zREl2SkIyVU0iO3M6ODoiY2hlY2tvdXQiO2E6NDp7czo1OiJpdGVtcyI7YToxOntpOjA7YTo5OntzOjI6ImlkIjtzOjU6IjI5XzM0IjtzOjEwOiJwcm9kdWN0X2lkIjtpOjI5O3M6MTg6InByb2R1Y3RfdmFyaWFudF9pZCI7aTozNDtzOjg6InF1YW50aXR5IjtpOjE7czoxNzoicHJpY2VfYXRfYWRkaXRpb24iO3M6MTE6IjMyMDAwMDAwLjAwIjtzOjk6ImltYWdlX3VybCI7czo0NDoiaW1hZ2VzL3Byb2R1Y3RzLzY4NmYxNmQxYjhiOTBfMTc1MjExMDgwMS5qcGciO3M6NzoicHJvZHVjdCI7YToxNTp7czoyOiJpZCI7aToyOTtzOjQ6Im5hbWUiO3M6MjE6IlNvZmEgMyBDaOG7lyBDQUJPIDJtMiI7czo0OiJzbHVnIjtzOjE5OiJzb2ZhLTMtY2hvLWNhYm8tMm0yIjtzOjE3OiJzaG9ydF9kZXNjcmlwdGlvbiI7czoxMzk6IlNvZmEgaGnhu4duIMSR4bqhaSwgdGhp4bq/dCBr4bq/IHRpbmggdOG6vywgY2jhuqV0IGxp4buHdSBjYW8gY+G6pXAsIG1hbmcgxJHhur9uIHPhu7EgdGhv4bqjaSBtw6FpIHbDoCBzYW5nIHRy4buNbmcgY2hvIGtow7RuZyBnaWFuIHPhu5FuZy4iO3M6MTE6ImRlc2NyaXB0aW9uIjtzOjcwMzoiTWFuZyDEkeG6v24gc+G7sSBr4bq/dCBo4bujcCBob8OgbiBo4bqjbyBnaeG7r2EgcGhvbmcgY8OhY2ggdsOgIHRp4buHbiBuZ2hpLCBi4buZIHNvZmEgY2FvIGPhuqVwIMSRxrDhu6NjIHRoaeG6v3Qga+G6vyB0aGVvIHh1IGjGsOG7m25nIGhp4buHbiDEkeG6oWksIHBow7kgaOG7o3AgduG7m2kgbmhp4buBdSBraMO0bmcgZ2lhbiBuaMawIHBow7JuZyBraMOhY2gsIHbEg24gcGjDsm5nIGhv4bq3YyBjxINuIGjhu5kgY2h1bmcgY8awLiBLaHVuZyBnaOG6vyBjaOG6r2MgY2jhuq9uLCDEkcaw4bujYyBsw6BtIHThu6sgZ+G7lyB04buxIG5oacOqbiBjaOG7kW5nIG3hu5FpIG3hu410LCBr4bq/dCBo4bujcCB24bubaSDEkeG7h20gbmfhu5NpIMOqbSDDoWkgdsOgIHbhuqNpIGLhu41jIGNo4bqldCBsxrDhu6NuZyBjYW8gZ2nDunAgdMSDbmcgxJHhu5kgYuG7gW4gdsOgIHThuqFvIGPhuqNtIGdpw6FjIHRob+G6o2kgbcOhaSBraGkgc+G7rSBk4bulbmcuIMSQxrDhu51uZyBtYXkgdGluaCB44bqjbywgbcOgdSBz4bqvYyB0cmFuZyBuaMOjLCBk4buFIGTDoG5nIHBo4buRaSBo4bujcCB24bubaSBuaGnhu4F1IHBob25nIGPDoWNoIG7hu5lpIHRo4bqldC4gxJDDonkga2jDtG5nIGNo4buJIGzDoCBuxqFpIHRoxrAgZ2nDo24gbcOgIGPDsm4gbMOgIMSRaeG7g20gbmjhuqVuIHRo4bqpbSBt4bu5IGNobyBuZ8O0aSBuaMOgIGPhu6dhIGLhuqFuLiI7czoxMzoicmVndWxhcl9wcmljZSI7czoxMToiMzIwMDAwMDAuMDAiO3M6MTQ6InN0b2NrX3F1YW50aXR5IjtOO3M6MTE6ImNhdGVnb3J5X2lkIjtpOjE2O3M6ODoiYnJhbmRfaWQiO2k6ODtzOjY6InN0YXR1cyI7czo5OiJwdWJsaXNoZWQiO3M6MTE6ImlzX2ZlYXR1cmVkIjtiOjA7czoxMDoidmlld19jb3VudCI7aTowO3M6MTA6ImNyZWF0ZWRfYXQiO3M6Mjc6IjIwMjUtMDctMDlUMTg6MjY6NDEuMDAwMDAwWiI7czoxMDoidXBkYXRlZF9hdCI7czoyNzoiMjAyNS0wNy0wOVQxODoyNjo0MS4wMDAwMDBaIjtzOjY6ImltYWdlcyI7YTo2OntpOjA7YTo4OntzOjI6ImlkIjtpOjY2O3M6MTA6InByb2R1Y3RfaWQiO2k6Mjk7czo5OiJpbWFnZV91cmwiO3M6NDQ6ImltYWdlcy9wcm9kdWN0cy82ODZmMTZkMWI2MDQyXzE3NTIxMTA4MDEuanBnIjtzOjg6ImFsdF90ZXh0IjtOO3M6MTI6ImlzX3RodW1ibmFpbCI7YjowO3M6NToib3JkZXIiO2k6MDtzOjEwOiJjcmVhdGVkX2F0IjtzOjI3OiIyMDI1LTA3LTA5VDE4OjI2OjQxLjAwMDAwMFoiO3M6MTA6InVwZGF0ZWRfYXQiO3M6Mjc6IjIwMjUtMDctMDlUMTg6MjY6NDEuMDAwMDAwWiI7fWk6MTthOjg6e3M6MjoiaWQiO2k6Njc7czoxMDoicHJvZHVjdF9pZCI7aToyOTtzOjk6ImltYWdlX3VybCI7czo0NDoiaW1hZ2VzL3Byb2R1Y3RzLzY4NmYxNmQxYjZmNWZfMTc1MjExMDgwMS5qcGciO3M6ODoiYWx0X3RleHQiO047czoxMjoiaXNfdGh1bWJuYWlsIjtiOjA7czo1OiJvcmRlciI7aTowO3M6MTA6ImNyZWF0ZWRfYXQiO3M6Mjc6IjIwMjUtMDctMDlUMTg6MjY6NDEuMDAwMDAwWiI7czoxMDoidXBkYXRlZF9hdCI7czoyNzoiMjAyNS0wNy0wOVQxODoyNjo0MS4wMDAwMDBaIjt9aToyO2E6ODp7czoyOiJpZCI7aTo2ODtzOjEwOiJwcm9kdWN0X2lkIjtpOjI5O3M6OToiaW1hZ2VfdXJsIjtzOjQ0OiJpbWFnZXMvcHJvZHVjdHMvNjg2ZjE2ZDFiNzkxMl8xNzUyMTEwODAxLmpwZyI7czo4OiJhbHRfdGV4dCI7TjtzOjEyOiJpc190aHVtYm5haWwiO2I6MDtzOjU6Im9yZGVyIjtpOjA7czoxMDoiY3JlYXRlZF9hdCI7czoyNzoiMjAyNS0wNy0wOVQxODoyNjo0MS4wMDAwMDBaIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjI3OiIyMDI1LTA3LTA5VDE4OjI2OjQxLjAwMDAwMFoiO31pOjM7YTo4OntzOjI6ImlkIjtpOjY5O3M6MTA6InByb2R1Y3RfaWQiO2k6Mjk7czo5OiJpbWFnZV91cmwiO3M6NDQ6ImltYWdlcy9wcm9kdWN0cy82ODZmMTZkMWI4MWI5XzE3NTIxMTA4MDEuanBnIjtzOjg6ImFsdF90ZXh0IjtOO3M6MTI6ImlzX3RodW1ibmFpbCI7YjowO3M6NToib3JkZXIiO2k6MDtzOjEwOiJjcmVhdGVkX2F0IjtzOjI3OiIyMDI1LTA3LTA5VDE4OjI2OjQxLjAwMDAwMFoiO3M6MTA6InVwZGF0ZWRfYXQiO3M6Mjc6IjIwMjUtMDctMDlUMTg6MjY6NDEuMDAwMDAwWiI7fWk6NDthOjg6e3M6MjoiaWQiO2k6NzA7czoxMDoicHJvZHVjdF9pZCI7aToyOTtzOjk6ImltYWdlX3VybCI7czo0NDoiaW1hZ2VzL3Byb2R1Y3RzLzY4NmYxNmQxYjhiOTBfMTc1MjExMDgwMS5qcGciO3M6ODoiYWx0X3RleHQiO047czoxMjoiaXNfdGh1bWJuYWlsIjtiOjA7czo1OiJvcmRlciI7aTowO3M6MTA6ImNyZWF0ZWRfYXQiO3M6Mjc6IjIwMjUtMDctMDlUMTg6MjY6NDEuMDAwMDAwWiI7czoxMDoidXBkYXRlZF9hdCI7czoyNzoiMjAyNS0wNy0wOVQxODoyNjo0MS4wMDAwMDBaIjt9aTo1O2E6ODp7czoyOiJpZCI7aTo3MTtzOjEwOiJwcm9kdWN0X2lkIjtpOjI5O3M6OToiaW1hZ2VfdXJsIjtzOjQ0OiJpbWFnZXMvcHJvZHVjdHMvNjg2ZjE2ZDFiYTM5ZV8xNzUyMTEwODAxLmpwZyI7czo4OiJhbHRfdGV4dCI7TjtzOjEyOiJpc190aHVtYm5haWwiO2I6MDtzOjU6Im9yZGVyIjtpOjA7czoxMDoiY3JlYXRlZF9hdCI7czoyNzoiMjAyNS0wNy0wOVQxODoyNjo0MS4wMDAwMDBaIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjI3OiIyMDI1LTA3LTA5VDE4OjI2OjQxLjAwMDAwMFoiO319fXM6MTg6InZhcmlhbnRfYXR0cmlidXRlcyI7YToxOntpOjA7czoyMDoiQ2jhuqV0IGxp4buHdTogVuG6o2kiO31zOjc6InZhcmlhbnQiO2E6MTE6e3M6MjoiaWQiO2k6MzQ7czoxMjoibmFtZV92YXJpYW50IjtzOjIwOiJW4bqjaSBYw6FtIE1CMjA0MS0xNyI7czoxMDoicHJvZHVjdF9pZCI7aToyOTtzOjE0OiJwcmljZV9tb2RpZmllciI7czo0OiIwLjAwIjtzOjE0OiJzdG9ja19xdWFudGl0eSI7aToxNDtzOjg6ImltYWdlX2lkIjtpOjcwO3M6NDoic2l6ZSI7czoyMjoiRDIyMDAgLSBSOTUwIC0gQzc1MCBtbSI7czoxMDoiY3JlYXRlZF9hdCI7czoyNzoiMjAyNS0wNy0wOVQxODoyNjo0MS4wMDAwMDBaIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjI3OiIyMDI1LTA3LTA5VDE4OjI2OjQxLjAwMDAwMFoiO3M6NToiaW1hZ2UiO2E6ODp7czoyOiJpZCI7aTo3MDtzOjEwOiJwcm9kdWN0X2lkIjtpOjI5O3M6OToiaW1hZ2VfdXJsIjtzOjQ0OiJpbWFnZXMvcHJvZHVjdHMvNjg2ZjE2ZDFiOGI5MF8xNzUyMTEwODAxLmpwZyI7czo4OiJhbHRfdGV4dCI7TjtzOjEyOiJpc190aHVtYm5haWwiO2I6MDtzOjU6Im9yZGVyIjtpOjA7czoxMDoiY3JlYXRlZF9hdCI7czoyNzoiMjAyNS0wNy0wOVQxODoyNjo0MS4wMDAwMDBaIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjI3OiIyMDI1LTA3LTA5VDE4OjI2OjQxLjAwMDAwMFoiO31zOjE2OiJhdHRyaWJ1dGVfdmFsdWVzIjthOjE6e2k6MDthOjc6e3M6MjoiaWQiO2k6NDtzOjEyOiJhdHRyaWJ1dGVfaWQiO2k6MTtzOjU6InZhbHVlIjtzOjU6IlbhuqNpIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjI3OiIyMDI1LTA3LTA5VDA2OjI3OjMwLjAwMDAwMFoiO3M6MTA6InVwZGF0ZWRfYXQiO3M6Mjc6IjIwMjUtMDctMDlUMDY6Mjc6MzAuMDAwMDAwWiI7czo1OiJwaXZvdCI7YToyOntzOjE4OiJwcm9kdWN0X3ZhcmlhbnRfaWQiO2k6MzQ7czoxODoiYXR0cmlidXRlX3ZhbHVlX2lkIjtpOjQ7fXM6OToiYXR0cmlidXRlIjthOjQ6e3M6MjoiaWQiO2k6MTtzOjQ6Im5hbWUiO3M6MTM6IkNo4bqldCBsaeG7h3UiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6Mjc6IjIwMjUtMDctMDlUMDY6Mjc6MzAuMDAwMDAwWiI7czoxMDoidXBkYXRlZF9hdCI7czoyNzoiMjAyNS0wNy0wOVQwNjoyNzozMC4wMDAwMDBaIjt9fX19fX1zOjU6InRvdGFsIjtkOjMyMDAwMDAwO3M6ODoiZGlzY291bnQiO2Q6MjAwMDAwMDtzOjEzOiJkaXNjb3VudF9jb2RlIjtzOjc6Ik1PTU8xMjMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMzt9', 1756142924),
('bvPdiIQ8zjrzAPLn7Eq7O3yk5oEYu8QUloOUpGOA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTjN3c1RzVDJkSnc5QjZyMjYwdnU0aFJsd2Z6cEdickNiM1JpTThkViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9tZXNzYWdlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1756136268),
('HfAEm7o8vrIt0sXFDtBvBd26ReDyVAeaSLNlwpXf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieTc3azJDSXZyZ2dzT1lYdXNiOUVQdVNjeG14cUJzVG9UbXgyNjhodSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fX0=', 1756140330);

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
(1, 'Nguyễn Ngọc Duy', 'h@gmail.com', NULL, '$2y$12$cHHMTi439coRY/Qh1oxsLeFsC35e3yx5OB3OkClERetw.L6yslLAy', '3252352335235', 'fadadar3we25423', 'active', NULL, '2025-08-20 15:52:17', '2025-08-25 17:19:36', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(2, 'Nguyễn Ngọc Hiếu', 'z@gmail.com', NULL, '$2y$12$YfMz6yt7xn.LpYfNSIeKzuGJdPYyuFb8rNxYu45mCeVTCqfIs99he', '3252352335235', 'fadadar3we25423', 'active', NULL, '2025-08-20 15:53:11', '2025-08-25 17:19:13', '21.04420355', '105.67309902', NULL, 0, NULL, '2025-08-23 15:43:53', NULL, NULL),
(3, 'Phạm Minh Quân', 'quan@gmail.com', NULL, '$2y$12$7y0k/eYAx8mwk40v9OwRfeewcUGEwCwVrrNXmm1Ga9edXEqbKTuZe', '0564758680', 's1 hoang mai ha noi', 'active', NULL, '2025-08-25 17:20:21', '2025-08-25 17:20:21', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL);

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
(13, 'Nguyễn Tiến Thuận', 'b@gmail.com', NULL, '$2y$12$1kK931Y2dezVVK8HkKsPye46j0D3VuA8csQMG3KXEbKD5eJhvDRcW', NULL, NULL, NULL, '0373607867', 'images/avatar/A8al1Oz02FYrDMTZXTJJPa1bdzGw3PfzhJEL2w2k.jpg', 'active', 'user', NULL, '2025-07-11 02:11:23', '2025-08-23 15:48:41', NULL),
(14, 'Nguyễn Tiến Thuận', 'nguyentienthuan4@gmail.com', NULL, '$2y$12$nIl3JZxSgj4asPVcSui4BuiTluTMBUs8VkYcXBWvx7NK6lQiSRiAe', NULL, NULL, NULL, '0373607863', NULL, 'active', 'user', NULL, '2025-07-16 19:44:27', '2025-07-26 07:36:35', '117797978250199695573'),
(15, 'Nguyễn Tiến Thuận', 'c@gmail.com', NULL, '$2y$12$/KO8nivdAcDSFjKhIeMStOdWgq8C/dlz.D9V4eoxtIpNWQpLhgnK2', NULL, NULL, NULL, '0373607863', NULL, 'active', 'admin', NULL, '2025-07-26 07:38:30', '2025-07-26 07:38:30', NULL),
(16, 'Dr. Sheldon Eichmann DVM', 'oconner.ross@example.org', NULL, '$2y$12$L2ONhsg3PK1dKo8ZMoS99uBMtExVxH7npUlOGMvpM8HRQtw4qf5Ra', NULL, NULL, NULL, '954-933-7368', 'https://via.placeholder.com/200x200.png/00cc55?text=people+saepe', 'banned', 'user', 'qM0VZstHlU', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(17, 'Ms. Edythe Nienow Sr.', 'grant.wilmer@example.org', NULL, '$2y$12$v90zQFKS1kd61vBh9mvpHeQ1gsQ/DTXiGlvY1tUBkGItKBK/gJw/a', NULL, NULL, NULL, '1-520-679-9247', 'https://via.placeholder.com/200x200.png/008833?text=people+id', 'inactive', 'admin', 'Mzsvxoot2p', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(18, 'Prof. Karlee Larson Sr.', 'sanford69@example.com', NULL, '$2y$12$hVEA.d4zCgNy4cI4KvWWluVWHFwhqIM.8eCp4NcqiPLd.bbZYnkLi', NULL, NULL, NULL, '(419) 891-3695', 'https://via.placeholder.com/200x200.png/0088cc?text=people+qui', 'active', 'admin', 'y6b0O6UT1O', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(19, 'Teresa Jakubowski', 'ewisoky@example.com', NULL, '$2y$12$0WNWDDlxFrM0rtf2yMvfxOPMXFEE6r08HcevKJvUNyfxFdaa.Tppq', NULL, NULL, NULL, '+1.901.476.8831', 'https://via.placeholder.com/200x200.png/0033bb?text=people+officia', 'inactive', 'user', 'tRTR7Y9Wwl', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(20, 'Darron Homenick Sr.', 'devante.feil@example.org', NULL, '$2y$12$zoC.0a0C9lo.y2qnJWZkSOZdahZD/8F4O2/bZgtLInJda1CkiaW26', NULL, NULL, NULL, '+1-239-507-9972', 'https://via.placeholder.com/200x200.png/0044cc?text=people+ex', 'inactive', 'admin', '23AToBSc9S', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(21, 'Precious Jenkins', 'boehm.karen@example.com', NULL, '$2y$12$jih1Mo29FxPTUcbjtUs6Ven310L6GSg.5RSETXsZS7LBQfOQgG6O.', NULL, NULL, NULL, '1-856-307-3023', 'https://via.placeholder.com/200x200.png/0077ff?text=people+quibusdam', 'active', 'user', 'WILa1PyQni', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(22, 'Mr. Jordan Langworth V', 'mokuneva@example.com', NULL, '$2y$12$IUckKKSb8o3OnleWe2rjbOordqPj2oRauGdxpOQPp.kj7zkhyKLEC', NULL, NULL, NULL, '314-238-1096', 'https://via.placeholder.com/200x200.png/00dd22?text=people+est', 'inactive', 'admin', '8eqdNA2T5C', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(23, 'Ricardo Cole', 'lesley88@example.net', NULL, '$2y$12$UoJ2qscTdjUTnPXY8VCD8.uQQGfatBpcmrWbun/9LOfGqLtnMjSvm', NULL, NULL, NULL, '+1-534-404-1936', 'https://via.placeholder.com/200x200.png/00dd77?text=people+debitis', 'active', 'admin', '4SW3CNlRiZ', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(24, 'Fabiola Ryan', 'gisselle06@example.net', NULL, '$2y$12$T9ecA3Lik.28Nz8mO8ZSmOmNQ3q.Am7Wi0LWV.pdH3qbBI1.8h362', NULL, NULL, NULL, '1-385-577-1539', 'https://via.placeholder.com/200x200.png/003322?text=people+necessitatibus', 'inactive', 'user', 'zmu2uXvozg', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(25, 'Bridie Kiehn', 'megane53@example.net', NULL, '$2y$12$srxfgbzX8av/TZh8MhJJoOothEy9eP4MeE327kp0EkiYCvrmPjKGW', NULL, NULL, NULL, '775.755.5108', 'https://via.placeholder.com/200x200.png/007733?text=people+illum', 'inactive', 'user', '5EHtMJHf3L', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(26, 'Prof. Palma Klein', 'qeichmann@example.net', NULL, '$2y$12$OWnXoN0SAlC9m/8MTzZQRezUWHuFdsGg/wuBtQ8mz8iniKFx76ogW', NULL, NULL, NULL, '820-685-8515', 'https://via.placeholder.com/200x200.png/0022aa?text=people+et', 'banned', 'user', 'ErcCCgcaeG', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(27, 'Dr. Johnathon Nicolas Sr.', 'kshlerin.astrid@example.net', NULL, '$2y$12$hPTm9BUnbvErS8OAg9Yq.OchONxS9NPzo6JlgQLT3FGgxPnl656Q2', NULL, NULL, NULL, '1-605-791-0926', 'https://via.placeholder.com/200x200.png/000011?text=people+modi', 'inactive', 'admin', 'mSVHC2dA8l', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(28, 'Lorenzo Bauch', 'tamara79@example.net', NULL, '$2y$12$1GjrqJr9EneT6G7JbfTC2uWcRoCZSkYErcP7lHwS9NXfBRS0AcJwa', NULL, NULL, NULL, '928.915.6962', 'https://via.placeholder.com/200x200.png/005522?text=people+laboriosam', 'banned', 'user', 'qVO0D5nEBI', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(29, 'Tyrell Kris V', 'dewayne.bruen@example.com', NULL, '$2y$12$i3UHzvCgrBoPk/43G9KjhOq7w572USPevPQ8OaRRJRYRWEKL8jUnK', NULL, NULL, NULL, '+1 (480) 283-4076', 'https://via.placeholder.com/200x200.png/00cc33?text=people+dolorem', 'active', 'user', 'RFBoyTW6yR', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(30, 'Ms. Dixie Streich', 'sabryna.dickens@example.com', NULL, '$2y$12$K2oSKGlhhd.3Owp0euA.0uNRj4lMA5HqYo0qj5l2YIwmlKQ.pyTTi', NULL, NULL, NULL, '312.798.7562', 'https://via.placeholder.com/200x200.png/00bb99?text=people+autem', 'banned', 'admin', 'Qjy94rZ9Aj', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(31, 'Alta Ratke IV', 'obie70@example.org', NULL, '$2y$12$sAhS6qOyDjfN5kZD13ogbOusbH2sw6vzVyNWbhPlxLgyrjP55Pvhe', NULL, NULL, NULL, '445-801-4451', 'https://via.placeholder.com/200x200.png/00ff88?text=people+maxime', 'active', 'admin', 'LmRH4qKCXN', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(32, 'Dr. Jess Bergnaum DVM', 'yjohns@example.org', NULL, '$2y$12$pD8r.i0Ide6SiONUCeGK.Of/vHFMHhN1.9sQA93cttEc0OQGn.zGy', NULL, NULL, NULL, '+19157698945', 'https://via.placeholder.com/200x200.png/00dd55?text=people+nobis', 'active', 'user', 'NqIizoa5Ox', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(33, 'Nathan McClure', 'braeden.schowalter@example.net', NULL, '$2y$12$ujUZXkkeAR817ckUwipite5UdIseQcLypkL0JQMmoRV.PZ2LfVkby', NULL, NULL, NULL, '954.374.6656', 'https://via.placeholder.com/200x200.png/00cc11?text=people+eligendi', 'inactive', 'admin', 'tw605XGKBM', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(34, 'Dr. Frederick Runte DDS', 'fdouglas@example.net', NULL, '$2y$12$Fh1gHXVancG7a2QX.k7mwOyFuDhExSOYlbZggJ695549Aoa4QEY9.', NULL, NULL, NULL, '458-648-7100', 'https://via.placeholder.com/200x200.png/0022ff?text=people+rem', 'inactive', 'admin', 'H3VnfCidAx', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(35, 'Lennie Konopelski', 'bret38@example.net', NULL, '$2y$12$3cHqBs.rf.dW2zeDW94o2.2ytCVPt8C9kw6XLeEgw1qk7jRn42iwW', NULL, NULL, NULL, '832-824-0502', 'https://via.placeholder.com/200x200.png/0077ff?text=people+minima', 'inactive', 'admin', 'tOxNx4wJeR', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(36, 'Eli Schinner', 'ressie.terry@example.org', NULL, '$2y$12$atK/YMEhFxSuv98IBLmJM.YOKKXatw7vLLohHPdjJ0AHBiWxc6szu', NULL, NULL, NULL, '+14143281072', 'https://via.placeholder.com/200x200.png/0000aa?text=people+atque', 'banned', 'user', 'eIMOZfrVZ1', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(37, 'Kayleigh Mueller', 'tflatley@example.net', NULL, '$2y$12$WCx6fGG.3muPzt5hjM0r2.YzLPl7OoJWdavqtd6X/jqgtOnjCJ1PO', NULL, NULL, NULL, '863.724.2835', 'https://via.placeholder.com/200x200.png/004455?text=people+non', 'active', 'user', 'gjyFWjhHxm', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(38, 'Monroe Nolan PhD', 'llebsack@example.net', NULL, '$2y$12$n2tS48r55jpADwFuUWDrpuOY8mOC1Wui6HL0GNsv9i3JraXmASySO', NULL, NULL, NULL, '907.975.0235', 'https://via.placeholder.com/200x200.png/00aa44?text=people+autem', 'active', 'user', 'Ui7H93rAIW', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(39, 'Florence Bashirian', 'domenica65@example.org', NULL, '$2y$12$tDZ4QSekaCFurCedP74QLemUug6MzNZDKHrP3/.T3SJ1F7nKMlnX.', NULL, NULL, NULL, '+1-475-481-7962', 'https://via.placeholder.com/200x200.png/008800?text=people+quae', 'inactive', 'admin', 'xCJvoROKQl', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(40, 'Dr. Emelia Huels I', 'qschowalter@example.com', NULL, '$2y$12$Q44XDikqt/ifguXBGAzl2e98CtOJKlY5soNdx7HPL.6PzINgs2h62', NULL, NULL, NULL, '949-687-4939', 'https://via.placeholder.com/200x200.png/003333?text=people+qui', 'banned', 'admin', 'PgbPDbSh0Q', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(41, 'Dr. April Kreiger II', 'friesen.kiley@example.net', NULL, '$2y$12$jkjsK3lkaeDaxM30wV/ie.8sbZu9/YEl.Tn7d9DzQE6KNGyvP6Mk2', NULL, NULL, NULL, '(757) 369-0201', 'https://via.placeholder.com/200x200.png/00dd22?text=people+perspiciatis', 'banned', 'user', 'KqQXMuPczX', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(42, 'Rhoda Ryan V', 'andy41@example.net', NULL, '$2y$12$.esDWv.9KE6/5tjA5/7Diuhq1bhYyY0FSsNDS0JwJDU397AyrPFnK', NULL, NULL, NULL, '814-745-1828', 'https://via.placeholder.com/200x200.png/0000bb?text=people+neque', 'inactive', 'user', 'xbMwnhuWZ9', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(43, 'Dr. Brandon Armstrong', 'lindgren.laura@example.net', NULL, '$2y$12$KBezAHo9UgnkPthYq76/c.5THJ4AYSWL5hSC7g2mfMOgOvSvPMne2', NULL, NULL, NULL, '(508) 780-2628', 'https://via.placeholder.com/200x200.png/006644?text=people+non', 'inactive', 'admin', 'WtpmPbqG7g', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(44, 'Nona Abernathy', 'gleichner.andrew@example.net', NULL, '$2y$12$h6bmbZrQgQ5n03S0b7oCOehya8Zf2L47P.eelVyS7OpPKggDnktRW', NULL, NULL, NULL, '541.213.9118', 'https://via.placeholder.com/200x200.png/002277?text=people+nihil', 'active', 'user', 'GlxH0IqKZS', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(45, 'Ms. Shawna Wintheiser', 'kristin21@example.org', NULL, '$2y$12$UxFnD.gfdcOkE71k/fua0uzyZxHzkM8X.9dyHAXWbQzaLSlORTezm', NULL, NULL, NULL, '279.858.3566', 'https://via.placeholder.com/200x200.png/007711?text=people+ea', 'active', 'user', 'Lq9Sx1JZzV', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(46, 'Diego Howe', 'wherman@example.org', NULL, '$2y$12$yOVxLXl8JjUA1jsKzqRCYecylnGF/lFnDj9wSVNvRA5kmug0c5h0a', NULL, NULL, NULL, '225.494.8357', 'https://via.placeholder.com/200x200.png/005599?text=people+officiis', 'inactive', 'admin', 'PeEax4rUGt', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(47, 'Matteo Brakus', 'damore.malvina@example.org', NULL, '$2y$12$loo8qGEt411j2GuGIsU6FuvztwfXxTuaZajfqhMEON1zNdg7A.OWW', NULL, NULL, NULL, '+1.479.628.6179', 'https://via.placeholder.com/200x200.png/001199?text=people+sapiente', 'banned', 'admin', '9vbBwfnUgn', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(48, 'Miss Christa Goyette DDS', 'kavon14@example.net', NULL, '$2y$12$hhf1DQvtxT2L7qADzVpX/OLBWS2PtcMttAaJZCLqY5W4c73VWS8Ry', NULL, NULL, NULL, '831.385.4697', 'https://via.placeholder.com/200x200.png/0099aa?text=people+qui', 'banned', 'user', '631CqTKPIq', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(49, 'Reynold Ondricka', 'pollich.johnathan@example.net', NULL, '$2y$12$oDiJ9ui9JoXbC4L5COWaA.4SF6zoElKSS9A3C4RFWyMo/PnT06Ylu', NULL, NULL, NULL, '+1-310-767-2916', 'https://via.placeholder.com/200x200.png/0077ff?text=people+et', 'inactive', 'admin', '99Z6dDAUck', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(50, 'Marion Stracke', 'orenner@example.net', NULL, '$2y$12$SZ1vFJOug.VLhcguE1l9w.8EjcVDoXCv3wY3jHRGC5sCLpQu208Xm', NULL, NULL, NULL, '(636) 315-7052', 'https://via.placeholder.com/200x200.png/0011ff?text=people+cupiditate', 'active', 'admin', 'pJ92rdwiCE', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(51, 'Ethyl Maggio', 'derick.cormier@example.com', NULL, '$2y$12$6xNAD4iC4e8E9AW.6o85nuiLosg8IuqmDCelXy1cPyjtaCiCtxcqu', NULL, NULL, NULL, '+1-985-674-4529', 'https://via.placeholder.com/200x200.png/0044ff?text=people+itaque', 'banned', 'user', 'E1frM01Ege', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(52, 'Ms. Wanda Lowe DVM', 'becker.noemi@example.net', NULL, '$2y$12$AB97OalQctxQj.y59xq2AOQ0tz4nf26sLXWyieWSAPaXFr7zL8VMa', NULL, NULL, NULL, '+13474396153', 'https://via.placeholder.com/200x200.png/000055?text=people+esse', 'inactive', 'user', 'dPSfna6GAN', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(53, 'Lourdes Mitchell', 'sherman.farrell@example.net', NULL, '$2y$12$jIxnL/NkikShWV2KTn/kB.Mz2XLOv2Uo8wSSwq7BIS8v3pWMkXXly', NULL, NULL, NULL, '+13518069610', 'https://via.placeholder.com/200x200.png/00ee55?text=people+quis', 'active', 'admin', 'QTMwYtuiTd', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(54, 'Judah Weimann', 'oscar39@example.com', NULL, '$2y$12$qrkjk8rIuZ3.v2wkqVwVKut4L9pBI.rImcoM5GZw744dETe2p1yEi', NULL, NULL, NULL, '+1.352.606.3266', 'https://via.placeholder.com/200x200.png/004433?text=people+dicta', 'active', 'user', '7Rspl6KW0R', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(55, 'Nakia Funk DVM', 'cierra35@example.org', NULL, '$2y$12$4e3UMxwoNL6TeRtIYXGaq.g5IkMGTphjlGuoTqeTJ6G.C5GPvEGnu', NULL, NULL, NULL, '+1-754-286-2807', 'https://via.placeholder.com/200x200.png/0000cc?text=people+a', 'banned', 'admin', 'muzpSNjFt5', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(56, 'Mallie Veum', 'darius.okon@example.com', NULL, '$2y$12$rYBbCbW8vp6FkINpty7Qy.OgY6ltMXInNRUlTOmezzj0wYldv8tLi', NULL, NULL, NULL, '681-267-1937', 'https://via.placeholder.com/200x200.png/002299?text=people+ut', 'active', 'user', '2Dfq1fYoT8', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(57, 'Herminia Towne', 'ahartmann@example.org', NULL, '$2y$12$hCNupEtAPGLRknbP2dwa9eWClK322CA//NewrXd6EQ/iZZO6NSW7m', NULL, NULL, NULL, '1-321-583-8827', 'https://via.placeholder.com/200x200.png/0055bb?text=people+et', 'banned', 'user', '9d5Lag1MMb', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(58, 'Tyler Effertz', 'serenity.reinger@example.com', NULL, '$2y$12$Mn7lcT5zcdP.v1eM3JmkO.PgccWXRh6h57QFKcekUDJ0jKxzHa5d6', NULL, NULL, NULL, '442-793-5675', 'https://via.placeholder.com/200x200.png/008822?text=people+et', 'banned', 'admin', 'EnKCBLkpBl', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(59, 'Stacey Donnelly', 'vbarton@example.net', NULL, '$2y$12$x4MX70Xfhyadq0Q55JMfFecUHhvlCHtq5/Y0QUT7e2sBPpyVapb/e', NULL, NULL, NULL, '847.553.9371', 'https://via.placeholder.com/200x200.png/00cc77?text=people+dicta', 'banned', 'admin', 'EhXsLpoLD8', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(60, 'Tavares Cummings', 'jovan71@example.com', NULL, '$2y$12$0WjaDlbFtOmBQneupi8yKeO8g3XDSlDRt3zwiLtA5nFSBEQOmKTzO', NULL, NULL, NULL, '1-385-287-9574', 'https://via.placeholder.com/200x200.png/0077ee?text=people+praesentium', 'active', 'user', 'UZNUFSxb0b', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(61, 'Ilene Gibson II', 'littel.florine@example.net', NULL, '$2y$12$h04syoWZ8hTy6EnaFosNRuizcIZrHW8DITOOL/hZoh4hRkxDvy0TO', NULL, NULL, NULL, '785.201.8922', 'https://via.placeholder.com/200x200.png/006622?text=people+aut', 'active', 'user', '9TN8bPEvW3', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(62, 'Jazmin Bednar', 'tcartwright@example.com', NULL, '$2y$12$MHII70PsblnZYnUOANG0DuNd6CGT.6/WhZtSQ7vd4Rt3JYzcPoJDC', NULL, NULL, NULL, '628-676-5018', 'https://via.placeholder.com/200x200.png/002288?text=people+vel', 'inactive', 'user', 'r8oH5u0ml8', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(63, 'Ollie Gorczany', 'elza.tremblay@example.org', NULL, '$2y$12$oqC3LN6m1INQo2g5OO3PNu3BscZxnvxnflvxDdHpl1FJy9rHl9TNK', NULL, NULL, NULL, '323-203-8836', 'https://via.placeholder.com/200x200.png/0055aa?text=people+dolorem', 'banned', 'admin', 'x6AVUNTgsL', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(64, 'Elroy Schuster', 'rquigley@example.org', NULL, '$2y$12$6uqXnGfHjo91dAgyvKt.o.OeE2auImmtvhg58RjUFw82bl0k5smzm', NULL, NULL, NULL, '+1-781-454-4544', 'https://via.placeholder.com/200x200.png/00bb00?text=people+dicta', 'inactive', 'user', 'zrttXPOl5q', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(65, 'Elvis Stehr', 'dennis.carter@example.org', NULL, '$2y$12$sJAv33GlFb9eCxp1AXHPYuHuq686kQC4cipqy6gsVi4QyuVCqUbHK', NULL, NULL, NULL, '(463) 547-3160', 'https://via.placeholder.com/200x200.png/0011aa?text=people+et', 'inactive', 'user', 'EXgLVEo0aS', '2025-08-24 06:17:18', '2025-08-24 06:17:18', NULL),
(66, 'Mr. Demarco Powlowski', 'block.lora@example.net', NULL, '$2y$12$nXOPHtLpez/oyrA2UicscuWOIVh9cGkJgfo0qRM8zGjts.4AQYE8G', NULL, NULL, NULL, '1-701-870-4256', 'https://via.placeholder.com/200x200.png/0022aa?text=people+architecto', 'inactive', 'admin', '6nQnzr8XSr', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(67, 'Ariane Kiehn', 'aniya.bosco@example.net', NULL, '$2y$12$UmB3RPh3fwJP78hYcRglfuyvWnIYlYUE2kSuM1pQKzV2N7TqBZSVq', NULL, NULL, NULL, '1-985-333-1110', 'https://via.placeholder.com/200x200.png/002255?text=people+qui', 'active', 'admin', 'y6q0TpVnNU', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(68, 'June Yundt', 'mertz.wade@example.net', NULL, '$2y$12$DhooQo3C6/b8JVVSSrs.U.e913pC61wpmKokU9ix1qifid6Rql/da', NULL, NULL, NULL, '1-531-358-2850', 'https://via.placeholder.com/200x200.png/00ffaa?text=people+eaque', 'banned', 'admin', 'zdjWCAsYJH', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(69, 'Elisha Hermiston', 'tbruen@example.net', NULL, '$2y$12$ekdyFOnDxw4UDf91a465q.xFYUZv.8kHbdJJ2s3HlAj2IJoSpelh.', NULL, NULL, NULL, '+1 (469) 814-6082', 'https://via.placeholder.com/200x200.png/005555?text=people+fugit', 'banned', 'admin', 'C2KxHnIToh', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(70, 'Anissa Macejkovic', 'ruby.schmitt@example.net', NULL, '$2y$12$uJZh69piY8L2LMXJl1QUROPZo4TVSB.fnc9/FzJjYsPQCKkgNn0e.', NULL, NULL, NULL, '216.602.9182', 'https://via.placeholder.com/200x200.png/00ee11?text=people+cum', 'active', 'admin', 'o0gtvczFfh', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(71, 'Bernhard Bechtelar', 'brayan43@example.net', NULL, '$2y$12$clIE/z9K1AODSltoGjkNQ.d4A9Vw4/fbxPe89uiZOS0OZD/y8Ub8S', NULL, NULL, NULL, '+1.820.825.0311', 'https://via.placeholder.com/200x200.png/006688?text=people+itaque', 'active', 'user', 'P9355UvFn2', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(72, 'Noemi Eichmann MD', 'schroeder.alden@example.org', NULL, '$2y$12$MB5xJGwsMrULaUj3fVJfEuToIQXVyDWX32ylkE2W5DF3BXMIBi2MW', NULL, NULL, NULL, '213.303.6366', 'https://via.placeholder.com/200x200.png/00ffdd?text=people+aspernatur', 'inactive', 'admin', 'oHp24sphCY', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(73, 'Jerrod Bechtelar', 'christiana.bauch@example.org', NULL, '$2y$12$wdwqKm/U/Gr1K5DrCIqBLeurVO2M2x0vyLmpSHI/HsTVSgkqsNNQq', NULL, NULL, NULL, '+1-928-844-4810', 'https://via.placeholder.com/200x200.png/00ff33?text=people+aperiam', 'inactive', 'admin', 'Nht6yLRy7M', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(74, 'Alexzander Heller', 'faye.sawayn@example.com', NULL, '$2y$12$tApNgFj5CptUVjZXUq66COW4uh1CMG.NKXsBnlTVZxj7lMKF5KLti', NULL, NULL, NULL, '801-494-9065', 'https://via.placeholder.com/200x200.png/006688?text=people+velit', 'active', 'user', 'nxtwW1ahcj', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(75, 'Wayne Thiel', 'freddie41@example.org', NULL, '$2y$12$7HcIo43YPlcqlLrGtrhpBuY0iD7s2KtVDv.wFniWTrHg72q6dpfSK', NULL, NULL, NULL, '+1.980.960.7014', 'https://via.placeholder.com/200x200.png/0088dd?text=people+magnam', 'banned', 'user', '5SCRLh1bei', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(76, 'Miss Karina Metz', 'eriberto.weimann@example.net', NULL, '$2y$12$A0gu8cz.Dv5iDsgKcuS73u8HTxORu43aPT8ocALqHMIgCO1UVZSx.', NULL, NULL, NULL, '1-430-400-1140', 'https://via.placeholder.com/200x200.png/0044cc?text=people+nobis', 'active', 'admin', '25fpooD6bL', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(77, 'Leann Cassin', 'veum.wade@example.org', NULL, '$2y$12$iDayoR.Xco4sI0HcTGMPV.krU044T4x5USPLXPt9DL7vtHJ6Z3eYq', NULL, NULL, NULL, '+18289012372', 'https://via.placeholder.com/200x200.png/00dd55?text=people+sequi', 'active', 'user', 'SJnmKxlLCT', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(78, 'Mr. Hoyt Green DDS', 'purdy.clyde@example.com', NULL, '$2y$12$UtTvBG7FtxuRhp6JHc8uWugZ537l5va5LZy4cidTGNi/TzmNEPyS2', NULL, NULL, NULL, '979.846.9085', 'https://via.placeholder.com/200x200.png/0099dd?text=people+minus', 'banned', 'admin', 'Gaut83yIp6', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(79, 'Amely Heller', 'mack.wiza@example.com', NULL, '$2y$12$kWrmCa34iFT7Vu5Utq6Up.W/Vit7/bNyy2arayH3zKEb3rxe50zD6', NULL, NULL, NULL, '1-323-967-3352', 'https://via.placeholder.com/200x200.png/00aa99?text=people+ea', 'banned', 'user', 'RekkVIQFZB', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(80, 'Matteo McCullough', 'garrison58@example.com', NULL, '$2y$12$PlZWeZ/lG6.XgRAt.kpJoety844ia.i5rUld32IOfsmzMCa7rj9oC', NULL, NULL, NULL, '+1-430-786-2448', 'https://via.placeholder.com/200x200.png/005500?text=people+modi', 'banned', 'admin', 'DW0pGbZVht', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(81, 'Seth Adams', 'runolfsdottir.ines@example.net', NULL, '$2y$12$6V.RXYsPKcGPoX3..6SSue8Ez/F5.lY0zwD4At6TxlWaFMaxoF3Y6', NULL, NULL, NULL, '480-846-4121', 'https://via.placeholder.com/200x200.png/00aa11?text=people+qui', 'banned', 'user', 'WAdNtTvYGx', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(82, 'Prof. Nicola Smith PhD', 'ubeer@example.org', NULL, '$2y$12$GRnohW5tRg535RcwxhcDpum24lrnByUe5ZKuAb2GnDFsS3tgXzBQu', NULL, NULL, NULL, '+1.414.805.8867', 'https://via.placeholder.com/200x200.png/00ee55?text=people+autem', 'inactive', 'user', 'l1sWqTUcDE', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(83, 'Miss Jennyfer Rowe MD', 'zkertzmann@example.com', NULL, '$2y$12$C0NbdQSxLvZobdN8uZq3ueET.kfVJmk65fuA5L610je6y39e8wslK', NULL, NULL, NULL, '+1-220-394-7113', 'https://via.placeholder.com/200x200.png/00ff44?text=people+quia', 'banned', 'admin', 'TTIb2Xp3pN', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(84, 'Prof. Candelario Hoeger DDS', 'dale40@example.org', NULL, '$2y$12$xA3D3eGIegh9P5spQkvZ9OzcHZRhuY5h3NOcKX5k4ySK1.KAYTiq6', NULL, NULL, NULL, '+1-603-650-4834', 'https://via.placeholder.com/200x200.png/00cc22?text=people+fugit', 'inactive', 'admin', 'WKpnkyYcpZ', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(85, 'Cali Nader', 'kiana.kessler@example.org', NULL, '$2y$12$nFC87lKsvGV4ePyc6dJWb.jI3TiSBeE4UVoStIbLSk7UpAB3ePe4m', NULL, NULL, NULL, '1-702-479-5068', 'https://via.placeholder.com/200x200.png/00ff00?text=people+porro', 'banned', 'user', 'pIWvOKfZN6', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(86, 'Kendall Sporer', 'rempel.vern@example.net', NULL, '$2y$12$DK0pQitBA6mw2thvSpDvCucLvHY0juhnXuhGrWO41k4AT3RcAqwm6', NULL, NULL, NULL, '+1-564-571-9225', 'https://via.placeholder.com/200x200.png/00ee99?text=people+quo', 'active', 'admin', 'dTl6ARsRKy', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(87, 'Prof. Jayme Wolf V', 'julius.mills@example.net', NULL, '$2y$12$eDaDzxfQxeOX3oMeOY9yBuB.HIjHHBR7mv9ogpR4iNrD9X5kmj26.', NULL, NULL, NULL, '+1.661.430.8518', 'https://via.placeholder.com/200x200.png/00aa33?text=people+ipsa', 'active', 'admin', '3qXvkMbY7B', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(88, 'Rowland Kuphal', 'clifford50@example.net', NULL, '$2y$12$K8.5lkdiWRYTbppp2aW2q.erOCqGAvx3eNhfW/EIwhPGCAmjo2RNW', NULL, NULL, NULL, '480-840-3286', 'https://via.placeholder.com/200x200.png/000000?text=people+quae', 'banned', 'user', 'txEmxmctIJ', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(89, 'Dr. Alana Adams', 'candace.howell@example.net', NULL, '$2y$12$SkIdmvfrtsqO2kT39xzFx.853KGwplNRq.DwIW/y5Mjeuml4F9yJW', NULL, NULL, NULL, '+1 (463) 801-2512', 'https://via.placeholder.com/200x200.png/000066?text=people+et', 'active', 'admin', 'atHBfz9noI', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(90, 'Lauryn Mertz', 'katlyn.casper@example.com', NULL, '$2y$12$MuBu7vuLCzTD3dLNhlKXCek9vUeqMhlbfUxWzho/3INRusxn6e2S.', NULL, NULL, NULL, '518-529-9619', 'https://via.placeholder.com/200x200.png/0011bb?text=people+eligendi', 'inactive', 'admin', 'g73FOI5YIS', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(91, 'Tyson Williamson Sr.', 'judy.daniel@example.net', NULL, '$2y$12$ZAWwtsJXDPWf2i2Q9s6y9.RE6ZHh4bfHaRhmbczUYdzmuV39j.5Om', NULL, NULL, NULL, '+1 (925) 870-9937', 'https://via.placeholder.com/200x200.png/005544?text=people+atque', 'inactive', 'admin', 'AGMTXR1wuP', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(92, 'Ms. Mozelle Mills Sr.', 'devyn82@example.net', NULL, '$2y$12$hIFZ9pHJOKyfuhz9OckQH.IBkst1kuk.L37.oBJwR2TdLT3ZrnJ1K', NULL, NULL, NULL, '689.599.9650', 'https://via.placeholder.com/200x200.png/00cc99?text=people+ratione', 'active', 'admin', 'XmHXaZqo4k', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(93, 'Agustina Rolfson', 'jon.osinski@example.org', NULL, '$2y$12$XeSiZtVHieX0ot92EfjhKeAs9r2zLe9kjKyU188kL037Q0ZfD4OhO', NULL, NULL, NULL, '+1.445.307.5959', 'https://via.placeholder.com/200x200.png/002222?text=people+velit', 'active', 'user', 'HRZ6Pueaj8', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(94, 'Dr. Roma Hartmann MD', 'reese.boehm@example.com', NULL, '$2y$12$T9w5u5LNfdBUi3JLmASLt.IGNvG/cqiFlkyP6MgSe8nU6evBjCyqu', NULL, NULL, NULL, '208-386-0370', 'https://via.placeholder.com/200x200.png/005588?text=people+atque', 'inactive', 'user', 'IrWaeHAzNp', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(95, 'Otha Medhurst I', 'salvador.ullrich@example.org', NULL, '$2y$12$trVxuzl3eNJwOw2K/4lPi.xTTMV1OnfsljuMyN.FquEcfx0dDr1sm', NULL, NULL, NULL, '+18438217564', 'https://via.placeholder.com/200x200.png/0033dd?text=people+voluptas', 'active', 'user', 'jr6wMgs4Sc', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(96, 'Dr. Toby Hackett V', 'malinda17@example.org', NULL, '$2y$12$OY6AEYXFpvNOeCHqCTalw.Rqhc43kJOhuz6o5fWsJerPxf.ma57yy', NULL, NULL, NULL, '1-559-904-6057', 'https://via.placeholder.com/200x200.png/003311?text=people+consequuntur', 'banned', 'admin', 'ZrCn9BeI6W', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(97, 'Yvette Quitzon Jr.', 'luigi68@example.org', NULL, '$2y$12$QuIWQ/wRmxRo66s4uqjr.eddPcGV4wIjUZtuEYkUoz0g1p024Uccq', NULL, NULL, NULL, '(316) 727-1686', 'https://via.placeholder.com/200x200.png/007799?text=people+ad', 'inactive', 'admin', 'UsE9X3Rm3F', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(98, 'Braulio Bernier', 'brice77@example.org', NULL, '$2y$12$1qE5EqWUvot59jnxLfK6rOsUswcMvwFjjEmshkSOln2ZROtCKz0F.', NULL, NULL, NULL, '1-458-878-8971', 'https://via.placeholder.com/200x200.png/008800?text=people+quia', 'banned', 'user', 'Jxdos9Av9g', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(99, 'Sterling Berge MD', 'schamberger.wallace@example.com', NULL, '$2y$12$TAQ1Di.hk.HVOzGBAz9E8O3basrF5qbncb66xmhMYskZzbmTJk/oS', NULL, NULL, NULL, '+1.567.324.6286', 'https://via.placeholder.com/200x200.png/00ee44?text=people+cupiditate', 'banned', 'admin', 'dAx9wLM8Is', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(100, 'Adella Hoppe PhD', 'keon.wolf@example.net', NULL, '$2y$12$FRYScSfkOOu2qNswoeHlaunrGLeW18GIQAS88KvaVzyyeqxKNzi.a', NULL, NULL, NULL, '+1-916-784-0626', 'https://via.placeholder.com/200x200.png/001133?text=people+eaque', 'active', 'user', 'ckDvGvrmYj', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(101, 'Ms. Daniella Kassulke Jr.', 'wward@example.com', NULL, '$2y$12$wdWB69Zxw3C5YMQWK3qba.JaSnp8GnRrjfy4yhlhpuzplX9v5LoYS', NULL, NULL, NULL, '+1.541.962.2157', 'https://via.placeholder.com/200x200.png/003399?text=people+qui', 'inactive', 'user', '0HK366BC5d', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(102, 'Tiara Schroeder', 'dfahey@example.org', NULL, '$2y$12$0rB4gFWa97f/AA6tefUzv.BxKxS63M.6v50dFWOpT/Ays.o/9CVea', NULL, NULL, NULL, '+1.757.466.1220', 'https://via.placeholder.com/200x200.png/007744?text=people+voluptatem', 'banned', 'admin', 'qsuFYeNaBg', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(103, 'Brenda Torp', 'earlene.mann@example.net', NULL, '$2y$12$8yRlm4Hqh0Y87Hw4hiU4eOLsEV9dYYkDR2OtB2UTMcjHrVgdhhs6C', NULL, NULL, NULL, '+1-484-661-8984', 'https://via.placeholder.com/200x200.png/0055cc?text=people+provident', 'inactive', 'admin', 'Xe6Lv3u56W', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(104, 'Vito O\'Kon', 'jed04@example.com', NULL, '$2y$12$ryC7p7vmtwrf5lCgZLYPROPYE.0tNV/oLGrwIcExFO1uzrkFDuQQm', NULL, NULL, NULL, '(806) 349-8502', 'https://via.placeholder.com/200x200.png/0000dd?text=people+consequuntur', 'inactive', 'user', 'ij9BPZwMTy', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(105, 'Coty Morar', 'wyman.kathryn@example.com', NULL, '$2y$12$Kf/R3EeGKc6cQkuKxTlY9.UbJi/wNzGybW9Lyfu.JOQa59Odr0b2a', NULL, NULL, NULL, '253.763.9961', 'https://via.placeholder.com/200x200.png/006699?text=people+id', 'inactive', 'admin', 'R4caMfLZva', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(106, 'Hunter Altenwerth', 'armani54@example.net', NULL, '$2y$12$REQXbQvyhPP5JcsneQ4C5ONYfz2/9silFuWvfyfMkKzxNqJX9KRfu', NULL, NULL, NULL, '276-393-3684', 'https://via.placeholder.com/200x200.png/00bbdd?text=people+quo', 'inactive', 'user', 'yeZu17MULz', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(107, 'Wilma Wisoky', 'huels.theresa@example.com', NULL, '$2y$12$AydvOk3bBW/YuwvF/sQSO.Y5pr8p9DaBrzwBwn9gTdoyagyLKY1mi', NULL, NULL, NULL, '(504) 938-1503', 'https://via.placeholder.com/200x200.png/00aa88?text=people+non', 'banned', 'admin', 'yaOoZrTJgc', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(108, 'Kassandra Monahan', 'deangelo.pfannerstill@example.com', NULL, '$2y$12$NMm.pMU8LnVKXZROT5rp9ON/FWF6UkPgbuHN.Fs7RPhb0tNWGBSi6', NULL, NULL, NULL, '+1.603.760.4942', 'https://via.placeholder.com/200x200.png/008899?text=people+facere', 'inactive', 'admin', '2dTj2HYsPW', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(109, 'Mr. Brayan Dickinson', 'rachael.bins@example.org', NULL, '$2y$12$HpbgkJkMURIYOFJ/pG9i8Ok1GJ.tDhLqXLQzyuGu4lFTXJKETEnSa', NULL, NULL, NULL, '+1 (858) 517-1931', 'https://via.placeholder.com/200x200.png/00ff22?text=people+minus', 'inactive', 'user', 'BlYGNcLDSh', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(110, 'Gilberto Larkin', 'stacy.prohaska@example.com', NULL, '$2y$12$mqWHXiae/chrJAd46CJNyuDdTKUZIBvfStl4M5ttjg5GkNMfIVXE.', NULL, NULL, NULL, '+1-510-355-2536', 'https://via.placeholder.com/200x200.png/0066aa?text=people+quas', 'inactive', 'admin', 'sThyIx3uqh', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(111, 'Miss Kathleen Bogisich II', 'daugherty.joyce@example.com', NULL, '$2y$12$0aceKyf.duCr.vkM3SfrUuQZtmAWELNFq/3ZbyRDr8k1.iaFPTg5K', NULL, NULL, NULL, '+1-602-206-4289', 'https://via.placeholder.com/200x200.png/007700?text=people+in', 'banned', 'user', 'IcRfGgKmXP', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(112, 'Shanny Conn', 'xhermiston@example.org', NULL, '$2y$12$mPM6I8fi0eA8tZwQnwCWxOcbUz.6xFapbGHo0e/xejdY.8XvLDfym', NULL, NULL, NULL, '661.615.7556', 'https://via.placeholder.com/200x200.png/00bb00?text=people+cupiditate', 'active', 'user', 'eGUCDbRgpi', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(113, 'Dasia Beier', 'skihn@example.net', NULL, '$2y$12$/b4APWY4F05O0qI1oeNPC.v9BP51t16xZDSfQmS7KP8Z0DfQWECR6', NULL, NULL, NULL, '(986) 558-8183', 'https://via.placeholder.com/200x200.png/0022cc?text=people+quos', 'banned', 'user', 'Bk9iONRkBa', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(114, 'Miss Destinee Ledner II', 'ankunding.johanna@example.com', NULL, '$2y$12$j0HFkVfMjs6XLN1TmblIAOArlh3TdIluQPXAtTx.Xe1HHsc5Bvnpe', NULL, NULL, NULL, '+1-669-258-3483', 'https://via.placeholder.com/200x200.png/002277?text=people+illum', 'active', 'user', 'N7CBZjukOl', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(115, 'Liliane Huel', 'riley.gaylord@example.com', NULL, '$2y$12$jKZxx/IqyRVPtr57KI6L9ecACvaKvrerftwAEPAiUeotsphnsIdCC', NULL, NULL, NULL, '+1 (986) 242-4909', 'https://via.placeholder.com/200x200.png/00aa11?text=people+enim', 'active', 'user', '4Iu2f5wnD2', '2025-08-24 06:18:57', '2025-08-24 06:18:57', NULL),
(116, 'Sadye Kunze', 'quinten38@example.com', NULL, '$2y$12$.w9MuSnLQnuCobNYpRqxCOXNljziA7TdF0U8yMTKdpBi3Y1HP4kMm', NULL, NULL, NULL, '+1-425-792-7845', 'https://via.placeholder.com/200x200.png/00dd55?text=people+officia', 'active', 'user', 'G1BYLnt0XH', '2025-07-19 12:04:18', '2025-07-19 12:04:18', NULL),
(117, 'Dr. Will Kutch', 'catherine.jacobs@example.net', NULL, '$2y$12$8//IpOpOF.XuiU8erRPAD.vT1I/yS1Yc7b67x1qtr4czcHZADswOq', NULL, NULL, NULL, '651.294.7950', 'https://via.placeholder.com/200x200.png/00aa55?text=people+repellendus', 'inactive', 'admin', 'Zl94YAUkvL', '2024-09-06 00:55:22', '2024-09-06 00:55:22', NULL),
(118, 'Prof. Seth Pacocha', 'uhirthe@example.com', NULL, '$2y$12$IoFGABRlIWxYZ4Fvk5lyAOY/XZixrprdq6YD6Ws4pN4ClhmiOC.DO', NULL, NULL, NULL, '+1-651-448-9854', 'https://via.placeholder.com/200x200.png/008888?text=people+natus', 'active', 'admin', 'q0Yq71YVI7', '2025-08-11 19:54:31', '2025-08-11 19:54:31', NULL),
(119, 'Ambrose Champlin', 'halvorson.reagan@example.com', NULL, '$2y$12$.nrd4TLo9bBsp2ilz32fqenNDyXHok8oIiD/sC7XYhp3UT5L8/K9O', NULL, NULL, NULL, '734-896-6905', 'https://via.placeholder.com/200x200.png/00ff44?text=people+pariatur', 'banned', 'user', 'F3vepdDctE', '2025-05-10 23:58:03', '2025-05-10 23:58:03', NULL),
(120, 'Dr. Keshawn Okuneva', 'stephanie58@example.com', NULL, '$2y$12$sMBFY6hDeqV4vz/PJ4Hb2O45ccd3UypxPSNyU6n9SMUupMlQl.w9K', NULL, NULL, NULL, '+1.281.207.4728', 'https://via.placeholder.com/200x200.png/001122?text=people+nesciunt', 'active', 'user', 'orBqiN8Dzd', '2025-04-25 23:42:14', '2025-04-25 23:42:14', NULL),
(121, 'Jenifer Block', 'konopelski.sabina@example.net', NULL, '$2y$12$Ulz5sDpp6AvVbQA1CbE8JObVgvebVucZX/CunWGtGeppcBTax.zLi', NULL, NULL, NULL, '1-434-371-8525', 'https://via.placeholder.com/200x200.png/0055cc?text=people+minima', 'inactive', 'admin', '1ncyEIZD03', '2025-03-03 13:51:11', '2025-03-03 13:51:11', NULL),
(122, 'Bethany Rutherford', 'emann@example.net', NULL, '$2y$12$eEjOTwrP6s2vbZXExJCvk.Ug5eVoaX.UqOVf8Rv6zdwKemNi6mJO.', NULL, NULL, NULL, '562-829-8315', 'https://via.placeholder.com/200x200.png/006600?text=people+sequi', 'inactive', 'admin', 'JeaslGiUVK', '2025-06-15 03:19:32', '2025-06-15 03:19:32', NULL),
(123, 'Mr. Maxwell Conn', 'rosemarie.kunde@example.com', NULL, '$2y$12$DoWHWrGdxXAY18DldEudQ.22Aa5hH6KxiNGzpdAw6aTOu335yAAVi', NULL, NULL, NULL, '1-657-433-7813', 'https://via.placeholder.com/200x200.png/00aacc?text=people+ratione', 'active', 'user', '6VhwGpbWll', '2025-01-21 07:57:09', '2025-01-21 07:57:09', NULL),
(124, 'Ofelia Sanford', 'warren09@example.org', NULL, '$2y$12$XUtFmfk1yvmIoU3ltMVJieC0rzj72H58x/vS7kj4z8hJANExM54Fy', NULL, NULL, NULL, '1-832-615-7806', 'https://via.placeholder.com/200x200.png/00aa33?text=people+rerum', 'inactive', 'admin', 'n3Sgsx673I', '2024-09-24 19:21:38', '2024-09-24 19:21:38', NULL),
(125, 'Candelario Borer', 'rosenbaum.devante@example.com', NULL, '$2y$12$JR9bWoR4HE4JcXAPUoljB.op96bKGWoW8YGusYTH91.DO0kBKzkJ2', NULL, NULL, NULL, '1-240-214-8796', 'https://via.placeholder.com/200x200.png/006600?text=people+maxime', 'inactive', 'user', '4tbUOnD85G', '2024-09-23 12:32:51', '2024-09-23 12:32:51', NULL),
(126, 'Reed Brekke Jr.', 'cshanahan@example.net', NULL, '$2y$12$8.uJcQy56hpSCO.uJzOnXeWIlUv/gnsHi8RVWueTwEuOqFetLcuxS', NULL, NULL, NULL, '260.601.4631', 'https://via.placeholder.com/200x200.png/0066cc?text=people+dolorem', 'inactive', 'admin', 'mntAb9vAqi', '2024-12-04 21:33:59', '2024-12-04 21:33:59', NULL),
(127, 'Marion Wolf', 'hettinger.glenda@example.org', NULL, '$2y$12$uumkFdgFqMEGQFG6mbPwcOzaRRDzKCxQNAt67GnP.n4lYIvAR7oMC', NULL, NULL, NULL, '+13379469930', 'https://via.placeholder.com/200x200.png/0033cc?text=people+ab', 'banned', 'admin', 'FIvm9kzaxk', '2025-05-07 11:21:33', '2025-05-07 11:21:33', NULL),
(128, 'Jacquelyn Littel', 'zfeeney@example.com', NULL, '$2y$12$tMmHf1Mb1/rjT0Jjsv10yO2k8PGvcdTesN9v.FHK/H0XBnLh1qmdq', NULL, NULL, NULL, '+13865189586', 'https://via.placeholder.com/200x200.png/008888?text=people+voluptatibus', 'inactive', 'user', 'vvIf07zclp', '2024-11-01 07:59:08', '2024-11-01 07:59:08', NULL),
(129, 'Darron Daugherty', 'bmayer@example.net', NULL, '$2y$12$6N16Zp0OwUEIPOOaF0LEGORVFQCUmk9XqojTk.bItHXBumvS5sVCe', NULL, NULL, NULL, '+1 (623) 319-4145', 'https://via.placeholder.com/200x200.png/00ee33?text=people+vitae', 'inactive', 'admin', 'rGd26xKucA', '2025-04-30 09:55:48', '2025-04-30 09:55:48', NULL),
(130, 'Mrs. Tania Witting', 'vonrueden.estell@example.com', NULL, '$2y$12$a1ePDRRXQQUVS.CNU1IGe.2Zkkl0K2INfG3Fq2VQXOB9G55h.nav6', NULL, NULL, NULL, '1-484-380-3290', 'https://via.placeholder.com/200x200.png/004477?text=people+ratione', 'inactive', 'user', 'bBLtARivCU', '2024-12-13 21:24:07', '2024-12-13 21:24:07', NULL),
(131, 'Prof. Carroll Hyatt', 'rogahn.tiana@example.org', NULL, '$2y$12$qtNMi7XwzaVlgv.CAWNJqu3B0GstdUyaBhTgesQ/U6nJ/zF6WTG36', NULL, NULL, NULL, '678-221-9483', 'https://via.placeholder.com/200x200.png/00aabb?text=people+molestias', 'banned', 'admin', 'vBY4Bbmolv', '2024-11-26 01:44:19', '2024-11-26 01:44:19', NULL),
(132, 'Mr. Ashton Zemlak MD', 'twaelchi@example.org', NULL, '$2y$12$W8b12F7yuQg.tHdCL0nik.TXBkqDx/I9pN6DHMFhgrZE8cCD1aIxO', NULL, NULL, NULL, '1-531-866-6859', 'https://via.placeholder.com/200x200.png/00eedd?text=people+enim', 'banned', 'admin', 'fgQBfpA0gT', '2025-03-18 08:22:56', '2025-03-18 08:22:56', NULL),
(133, 'Abraham Jacobson', 'hsauer@example.org', NULL, '$2y$12$7etC4NGwa2fxDjMdMKCAMe2cJAKwQ/IkAEblI3dmwDNTcqeToXGvO', NULL, NULL, NULL, '(858) 402-8206', 'https://via.placeholder.com/200x200.png/0055ee?text=people+non', 'banned', 'user', 'vmqYJDetc1', '2024-09-02 15:01:30', '2024-09-02 15:01:30', NULL),
(134, 'Prof. Monserrate Hoppe IV', 'jimmy70@example.org', NULL, '$2y$12$QDtK3QxbNt6xjzTylNiIW.qO64SdD0FNa/W1x/9lV6jbIKDEdRCHe', NULL, NULL, NULL, '+12236398916', 'https://via.placeholder.com/200x200.png/00aa22?text=people+alias', 'inactive', 'admin', 'Nsss5oh78M', '2025-06-04 21:58:03', '2025-06-04 21:58:03', NULL),
(135, 'Annetta Kemmer', 'akrajcik@example.org', NULL, '$2y$12$gqDSPiG6ffeIViDXEb2QMuPSQEgNLpdaIIC9fLxHWBdZGxQ2R6qRe', NULL, NULL, NULL, '+1.843.694.4778', 'https://via.placeholder.com/200x200.png/00bb88?text=people+velit', 'inactive', 'user', 'bIww0N9lrY', '2025-06-14 21:13:17', '2025-06-14 21:13:17', NULL),
(136, 'Elias Anderson', 'reuben.hayes@example.com', NULL, '$2y$12$1n6NaHo1ysgO3bcf8dIdGODRS2fll0Wi3E84vO6fNrNT.ioGnMeJW', NULL, NULL, NULL, '+18069815978', 'https://via.placeholder.com/200x200.png/000055?text=people+delectus', 'inactive', 'admin', 'vGjKIHQ31R', '2025-04-04 05:55:10', '2025-04-04 05:55:10', NULL),
(137, 'Myrtice Reinger', 'jarvis43@example.net', NULL, '$2y$12$5sXA3wlVgAI1T2zIldepIOsb3NR4k/XVLjOSe.HhVYqfLMq4bwO6W', NULL, NULL, NULL, '1-341-256-4888', 'https://via.placeholder.com/200x200.png/000077?text=people+impedit', 'inactive', 'user', 'UdJ1HPEHtH', '2025-05-06 18:15:07', '2025-05-06 18:15:07', NULL),
(138, 'Prof. Omari Hirthe', 'quinn70@example.net', NULL, '$2y$12$Hyu0LB7BzL4OwR2OIQ0HyOOBOarPrisQFpBUMjSpJpBJb76DV9xX6', NULL, NULL, NULL, '272-899-6292', 'https://via.placeholder.com/200x200.png/00aabb?text=people+iste', 'banned', 'user', 'G9Xd3jGzmo', '2025-05-17 13:38:54', '2025-05-17 13:38:54', NULL),
(139, 'Kailee Abbott', 'yasmeen76@example.com', NULL, '$2y$12$vDAi5/gw/Rzg801ppSTWrOFQ69UGT5XcS0kiCWXvCATwPmXO5mP.K', NULL, NULL, NULL, '678.786.0724', 'https://via.placeholder.com/200x200.png/00ee88?text=people+illo', 'active', 'user', 'csy9TDa5vC', '2025-02-28 13:55:26', '2025-02-28 13:55:26', NULL),
(140, 'Prof. Kayli Brekke DVM', 'stroman.porter@example.org', NULL, '$2y$12$j7OhNIbtsmoVyBGie0.C0O3Bw04rlts6dPBGG9dLQdyl4nTq4MvYW', NULL, NULL, NULL, '+1-726-417-9618', 'https://via.placeholder.com/200x200.png/001144?text=people+consequatur', 'inactive', 'admin', 'Wz7GwDWTED', '2025-07-25 03:44:38', '2025-07-25 03:44:38', NULL),
(141, 'Hilario Christiansen DDS', 'alvah.cruickshank@example.org', NULL, '$2y$12$XO55JyZMS1dwj5RkYzjcZuq8SzXXd24jPusioQAGFfcOGq61LMrUi', NULL, NULL, NULL, '239.484.8637', 'https://via.placeholder.com/200x200.png/0066ff?text=people+sit', 'inactive', 'admin', 'c9lPlWCYqu', '2024-10-23 00:30:28', '2024-10-23 00:30:28', NULL),
(142, 'Prof. Modesto Willms', 'hand.julian@example.com', NULL, '$2y$12$f1GcSPVNjDHjbUibFlJ53e.a/7Pqs22fWJ/xfcQqGdR23g7.ui2i2', NULL, NULL, NULL, '1-571-293-0491', 'https://via.placeholder.com/200x200.png/008888?text=people+est', 'inactive', 'admin', 'KWPjKJixTK', '2024-12-07 14:33:26', '2024-12-07 14:33:26', NULL),
(143, 'Elissa O\'Hara', 'merle90@example.org', NULL, '$2y$12$OLvQj9cHI5P9ih/JoL/XkO3yDzR17WNmwNxu6uQy8pX7Ym9yDdXay', NULL, NULL, NULL, '1-445-582-4011', 'https://via.placeholder.com/200x200.png/0077ee?text=people+ea', 'banned', 'admin', '7e1TzpENJO', '2025-05-11 04:01:02', '2025-05-11 04:01:02', NULL),
(144, 'Nathen Rowe', 'jacobs.jackie@example.net', NULL, '$2y$12$WEu9fUW1lYq3GDzfz5QL0.A1b5iysY32xsJVkRoMeUCOKPb/sfYgK', NULL, NULL, NULL, '+12318952787', 'https://via.placeholder.com/200x200.png/00eecc?text=people+repellendus', 'inactive', 'admin', 'vgEun2DtCn', '2025-01-30 01:10:06', '2025-01-30 01:10:06', NULL),
(145, 'Letitia Goodwin', 'uriel.robel@example.net', NULL, '$2y$12$lqN81bhXHkCijfbKz3MS4ezIoH0nFsmhQIeSuo4yD8uVc.rCZ5EC2', NULL, NULL, NULL, '352.349.5765', 'https://via.placeholder.com/200x200.png/004433?text=people+id', 'banned', 'user', 'ZsghhckoKx', '2025-06-02 00:09:46', '2025-06-02 00:09:46', NULL),
(146, 'Dr. Nestor Gerhold', 'maddison.ernser@example.com', NULL, '$2y$12$g2bZrLsa8IciAey9DuvBCeZ8wZn9RrgaJz21vrs3qtihLv3hO6P5G', NULL, NULL, NULL, '+1-949-365-8315', 'https://via.placeholder.com/200x200.png/005544?text=people+ipsam', 'active', 'user', 'nNsZiSuDO7', '2025-01-13 10:24:59', '2025-01-13 10:24:59', NULL),
(147, 'Reba Smith DDS', 'stroman.reilly@example.org', NULL, '$2y$12$mdcPGv/jhNqe8QcBFjbiCeah8oSOQf1TEPW4I65JQ2O8mcAy8gfrG', NULL, NULL, NULL, '726.635.4608', 'https://via.placeholder.com/200x200.png/004477?text=people+et', 'banned', 'admin', 'D22jMixUbK', '2025-02-06 21:25:02', '2025-02-06 21:25:02', NULL),
(148, 'Braeden Zboncak', 'hassan30@example.com', NULL, '$2y$12$weGHSQWrF8wkI8I3DWxiTOyi.rdtPFy3w0S46pB0Vex1AfWo7KkHe', NULL, NULL, NULL, '(828) 398-4428', 'https://via.placeholder.com/200x200.png/0088ff?text=people+aliquam', 'banned', 'user', 'IS3Mu0BwZH', '2025-07-27 09:13:58', '2025-07-27 09:13:58', NULL),
(149, 'Golden Kozey', 'jboyer@example.net', NULL, '$2y$12$eS45zE6Xejx/ievgVzlxBe47/vx33SAeQbQ6bM.PpXYCwDTIDVC6e', NULL, NULL, NULL, '(878) 251-2239', 'https://via.placeholder.com/200x200.png/008877?text=people+ab', 'inactive', 'admin', 'vJ2Icdgl4i', '2025-06-22 03:29:56', '2025-06-22 03:29:56', NULL),
(150, 'Bettye Murphy', 'nitzsche.sid@example.net', NULL, '$2y$12$fziM4IoZ4godWUHHJGzOMuCv32U.kq9E26Fap.m8qvli5ZJ/FYoti', NULL, NULL, NULL, '(630) 563-6361', 'https://via.placeholder.com/200x200.png/0077bb?text=people+numquam', 'inactive', 'admin', '9Kjlk96Md3', '2025-05-02 06:38:17', '2025-05-02 06:38:17', NULL),
(151, 'Dr. Maymie Grimes', 'rpagac@example.net', NULL, '$2y$12$qKt1Gp3u3zg.fgemDxs2Suf2mGgA.i95bS.9lxDUOWXiRTx29kLSa', NULL, NULL, NULL, '+1.757.391.8062', 'https://via.placeholder.com/200x200.png/003366?text=people+dolorum', 'inactive', 'user', 'o4e71sgRfU', '2024-10-22 11:00:01', '2024-10-22 11:00:01', NULL),
(152, 'Colby Boyer', 'burnice.carter@example.net', NULL, '$2y$12$cEr.ELk1klli9EmFJ0YJUOY9hBLQHemSE5DXQBd2JTxlThs/5ywYm', NULL, NULL, NULL, '+1-661-275-3574', 'https://via.placeholder.com/200x200.png/00bbaa?text=people+accusantium', 'inactive', 'admin', 'CH0AgCy8FP', '2025-03-31 23:23:45', '2025-03-31 23:23:45', NULL),
(153, 'Dominique Kling', 'trantow.frida@example.com', NULL, '$2y$12$05H1i4GNYqAKvt/C2GqN3eFZKhE9HvsbqPIvjMczMtAp9NKBpGrJm', NULL, NULL, NULL, '+1-906-246-5876', 'https://via.placeholder.com/200x200.png/007711?text=people+sed', 'active', 'user', '2j5LAYpX5E', '2025-03-05 02:05:30', '2025-03-05 02:05:30', NULL),
(154, 'Dahlia Dach', 'zetta38@example.com', NULL, '$2y$12$5HuDff3jNU4a3gQJxObdoOtMaJ7GO/nBYqJLoF.88Ljl./knrAqsW', NULL, NULL, NULL, '+1-818-854-2413', 'https://via.placeholder.com/200x200.png/007799?text=people+aut', 'active', 'user', 'vuLB5kSXyN', '2024-12-27 05:19:11', '2024-12-27 05:19:11', NULL),
(155, 'Prof. Isabel Moen II', 'maxie20@example.com', NULL, '$2y$12$7gLrRuUuG8zb6rs6h1OrAuuJgYJsQSe7lPwa086KBVSChy.XrUX0q', NULL, NULL, NULL, '+1.586.534.7193', 'https://via.placeholder.com/200x200.png/003399?text=people+aut', 'inactive', 'admin', '3L1bTpmG0C', '2025-08-19 06:50:51', '2025-08-19 06:50:51', NULL),
(156, 'huy nguyễn', 'huy20079@gmail.com', NULL, '$2y$12$Z9uRIw46AhwHuPShYel5BOCqYWx0HkMJhse3AMLwFLsUYyskpoWp2', NULL, NULL, NULL, NULL, NULL, 'active', 'user', NULL, '2025-08-25 14:49:17', '2025-08-25 14:49:17', '110785042197613422679');

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
(11, 12, '2025-07-10 07:31:27', '2025-07-10 07:31:27'),
(12, 13, '2025-08-23 08:36:13', '2025-08-23 08:36:13'),
(13, 14, '2025-08-24 07:03:24', '2025-08-24 07:03:24'),
(14, 156, '2025-08-25 14:49:59', '2025-08-25 14:49:59');

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
(14, 11, 73, '2025-08-04 04:03:36'),
(18, 12, 77, '2025-08-23 17:18:58'),
(20, 12, 76, '2025-08-23 17:20:45'),
(21, 12, 72, '2025-08-23 17:22:27'),
(25, 13, 66, '2025-08-24 15:20:35'),
(26, 13, 76, '2025-08-24 15:44:44'),
(27, 14, 67, '2025-08-25 14:49:59'),
(28, 14, 69, '2025-08-25 14:52:33');

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
-- Indexes for table `chat_suggestions`
--
ALTER TABLE `chat_suggestions`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `messages_conversation_id_foreign` (`conversation_id`),
  ADD KEY `messages_admin_id_foreign` (`admin_id`);

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
-- Indexes for table `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refunds_order_id_status_index` (`order_id`,`status`),
  ADD KEY `refunds_gateway_status_index` (`gateway`,`status`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `chat_suggestions`
--
ALTER TABLE `chat_suggestions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=416;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1028;

--
-- AUTO_INCREMENT for table `order_promotion`
--
ALTER TABLE `order_promotion`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_status_histories`
--
ALTER TABLE `order_status_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=364;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `product_variant_attribute_values`
--
ALTER TABLE `product_variant_attribute_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `refunds`
--
ALTER TABLE `refunds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=437;

--
-- AUTO_INCREMENT for table `shippers`
--
ALTER TABLE `shippers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
  ADD CONSTRAINT `messages_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
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
-- Constraints for table `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `refunds_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

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
