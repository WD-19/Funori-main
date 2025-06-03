-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 03, 2025 at 04:01 AM
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
  `receiver_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `receiver_name`, `receiver_phone`, `street_address`, `address_type`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 2, 'Khalid Parisian', '636.594.4128', '1220 Jarod Isle Suite 136\nUllrichmouth, SD 80206', 'work', 0, '2025-05-04 22:11:03', '2025-01-12 22:22:46'),
(2, 2, 'Johann Volkman', '541-498-7858', '6289 Paucek Cliff\nEast Eliasberg, WI 24672-5445', 'home', 0, '2025-04-19 13:04:42', '2025-03-21 16:58:43'),
(3, 2, 'Lucie Toy', '+1.229.381.8015', '2198 Sanford Cove\nConnershire, WI 47581-0931', 'home', 0, '2025-03-02 17:43:03', '2025-02-01 21:02:54'),
(4, 3, 'Angel Stokes', '1-575-812-1646', '112 Gutmann Mission\nGoyetteport, GA 07020', NULL, 1, '2025-01-13 01:20:23', '2025-03-19 12:35:34'),
(5, 4, 'Misty Graham PhD', '+12256783491', '522 Heathcote Pines\nNorth Vernon, AK 94562-6162', NULL, 1, '2025-02-14 21:51:59', '2025-03-31 12:33:52'),
(6, 5, 'Dr. Jennings Flatley V', '786-766-1278', '66014 Waelchi Meadows Suite 538\nJunefurt, UT 52101-6502', NULL, 0, '2025-04-13 18:47:42', '2025-05-14 01:17:05'),
(7, 6, 'Burnice Breitenberg', '+1.680.812.9972', '40184 White Views\nLake Leilani, MS 55686-0065', 'home', 0, '2025-01-31 20:53:22', '2025-03-10 09:48:36'),
(8, 6, 'Mrs. Vivianne Dibbert Sr.', '+1.531.671.9871', '392 Kessler Divide Suite 094\nJensenberg, GA 62362', 'work', 0, '2025-01-21 03:13:28', '2025-04-05 14:25:03'),
(9, 7, 'Johnnie Turcotte', '+1-832-256-3283', '560 Maryjane Summit\nLake Demarcoberg, TX 32510-1587', 'work', 0, '2025-02-13 22:27:06', '2024-12-03 08:01:45'),
(10, 7, 'Damion Lockman Sr.', '1-925-305-9210', '38524 Lyda Villages Suite 426\nEast Amirport, UT 37541-8272', 'work', 0, '2025-04-01 21:13:07', '2025-05-17 10:27:10'),
(11, 7, 'Dr. Brook Hudson', '317-909-8304', '6987 Langosh Lodge\nHattiechester, TX 72977', 'home', 0, '2025-02-10 15:57:05', '2025-05-11 07:27:52'),
(12, 8, 'Laney Jacobi', '425.984.5332', '10013 Runte Mission Apt. 816\nEphraimville, AL 79052-7615', NULL, 0, '2025-03-10 18:27:15', '2025-02-03 19:12:41'),
(13, 8, 'Miss Destini Turcotte', '1-941-513-6725', '43956 Noemy Courts\nShainaside, UT 75899', 'home', 0, '2025-05-24 08:14:29', '2025-01-19 06:34:52'),
(14, 8, 'Mr. Sammy Kuhlman', '+1-920-881-7024', '187 Lemke Meadow\nLemkeborough, DC 09523', 'home', 0, '2025-01-31 12:09:50', '2025-03-21 16:42:10'),
(15, 9, 'Ms. Trisha Baumbach IV', '678-725-8887', '889 Morgan Vista Apt. 204\nAmberfurt, ID 17248-0673', 'work', 0, '2025-05-20 06:09:27', '2024-12-28 13:44:05'),
(16, 10, 'Shanel Olson', '(925) 905-8865', '75715 Koss Square Apt. 535\nColemouth, DE 83741-1539', 'work', 0, '2025-02-23 19:46:02', '2025-03-24 12:37:05'),
(17, 11, 'Cleve Swift', '828.213.6522', '934 Dean Corners\nAglaefurt, SD 01228', 'home', 1, '2024-12-31 05:38:06', '2025-01-11 04:44:42'),
(18, 11, 'Dr. Leonard Kuhn', '940.379.5963', '388 Stracke Cliffs\nDurganside, HI 16913', NULL, 0, '2025-03-04 01:07:45', '2024-12-15 18:49:34');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Color', '2024-06-27 14:07:38', '2025-01-21 15:02:46'),
(2, 'Size', '2025-01-27 00:53:35', '2025-03-05 13:03:40'),
(3, 'Material', '2024-08-05 05:10:38', '2024-11-16 13:34:08');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint UNSIGNED NOT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL,
  `value` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'LightCyan', '2025-01-13 23:03:25', '2025-06-02 20:56:34'),
(2, 1, 'LightCoral', '2025-06-02 17:23:28', '2025-06-02 20:56:34'),
(3, 1, 'GreenYellow', '2025-03-24 12:24:24', '2025-06-02 20:56:34'),
(4, 1, 'DarkOrchid', '2025-03-11 23:51:57', '2025-06-02 20:56:34'),
(5, 1, 'DeepSkyBlue', '2025-04-27 16:32:03', '2025-06-02 20:56:34'),
(6, 2, 'Small', '2025-03-07 20:17:08', '2025-06-02 20:56:34'),
(7, 2, 'Medium', '2025-05-09 21:51:28', '2025-06-02 20:56:34'),
(8, 2, 'Small', '2025-03-31 09:26:26', '2025-06-02 20:56:34'),
(9, 2, 'XL', '2024-12-13 21:38:09', '2025-06-02 20:56:34'),
(10, 2, 'XXL', '2025-02-20 21:25:27', '2025-06-02 20:56:34'),
(11, 3, 'Wood', '2024-12-18 23:37:24', '2025-06-02 20:56:34'),
(12, 3, 'Wood', '2025-05-06 02:14:13', '2025-06-02 20:56:34'),
(13, 3, 'Fabric', '2025-02-01 03:12:08', '2025-06-02 20:56:34'),
(14, 3, 'Leather', '2024-12-18 23:40:15', '2025-06-02 20:56:34'),
(15, 3, 'Fabric', '2025-03-27 13:02:35', '2025-06-02 20:56:34');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `position` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 'Sed ut ducimus earum voluptate.', 'https://via.placeholder.com/1200x400.png/004477?text=abstract+ratione', NULL, 'Fuga placeat molestiae nisi consequatur odio ipsa adipisci doloremque et odit qui et.', 'homepage_slider', 8, '2025-03-24 13:03:07', '2025-03-31 20:44:05', 1, '2025-03-10 02:26:33', '2025-05-26 08:57:44'),
(2, 'Fuga non vitae omnis neque.', 'https://via.placeholder.com/1200x400.png/007777?text=abstract+est', NULL, 'Quod assumenda iusto occaecati ut numquam sed aut dolor esse nobis aut odio consequatur.', 'sidebar', 8, '2025-04-14 23:59:10', '2025-04-26 04:33:50', 1, '2025-02-21 09:02:15', '2025-05-07 23:23:28'),
(3, 'Atque natus tempora eos minima.', 'https://via.placeholder.com/1200x400.png/007733?text=abstract+quaerat', 'http://www.hodkiewicz.com/maiores-et-quia-perspiciatis-a-temporibus-quam-deserunt-error', 'Dicta hic rerum minima aut officiis nobis aspernatur ea aut inventore neque aspernatur voluptatem et.', 'product_page_banner', 9, '2025-04-03 15:05:35', '2025-08-06 06:43:55', 1, '2025-03-13 16:21:45', '2025-01-05 21:37:39'),
(4, 'Rerum ad quos qui.', 'https://via.placeholder.com/1200x400.png/00ee44?text=abstract+aut', NULL, 'Error sed harum dolor sunt ut aliquid aliquid harum eos quo vel.', 'product_page_banner', 5, '2025-03-27 21:35:32', '2025-08-06 03:49:26', 0, '2025-05-14 19:03:10', '2025-02-09 19:45:00'),
(5, 'Et qui non.', 'https://via.placeholder.com/1200x400.png/00aaee?text=abstract+ea', 'http://www.kilback.org/', 'Dignissimos nisi sit delectus commodi aliquam fugit cumque aut.', 'homepage_slider', 10, '2025-04-05 13:05:48', '2025-07-05 16:50:19', 1, '2025-03-24 10:50:01', '2025-01-19 12:19:11'),
(6, 'Vitae sequi repellat qui.', 'https://via.placeholder.com/1200x400.png/00ccaa?text=abstract+fugit', NULL, 'Earum voluptas veritatis pariatur eveniet et optio.', 'sidebar', 3, '2025-05-11 12:09:26', NULL, 1, '2025-02-25 07:39:02', '2025-02-06 16:15:14'),
(7, 'A dolores dolorem.', 'https://via.placeholder.com/1200x400.png/001133?text=abstract+facere', NULL, 'Ducimus officiis vitae placeat ut at exercitationem.', 'product_page_banner', 2, '2025-06-01 02:19:26', '2025-08-13 08:12:28', 1, '2025-01-03 17:12:10', '2025-02-08 12:58:17'),
(8, 'Impedit aut a molestias eum.', 'https://via.placeholder.com/1200x400.png/0011dd?text=abstract+ea', NULL, 'Consequatur voluptatum eum quis neque in autem incidunt aliquid.', 'homepage_slider', 2, '2025-05-19 03:18:55', '2025-07-12 09:58:58', 1, '2024-12-06 16:53:44', '2024-12-09 17:41:40'),
(9, 'At architecto vitae sit quia qui.', 'https://via.placeholder.com/1200x400.png/0077aa?text=abstract+commodi', NULL, NULL, 'homepage_slider', 6, '2025-03-03 20:16:52', '2025-05-02 20:30:21', 1, '2025-05-22 22:18:54', '2024-12-26 06:44:20'),
(10, 'Corrupti voluptas maxime perspiciatis commodi.', 'https://via.placeholder.com/1200x400.png/00aa00?text=abstract+aut', 'http://www.zulauf.com/quaerat-nostrum-est-eos-voluptatibus-iure.html', 'Sunt sint impedit veritatis ipsam commodi soluta.', 'sidebar', 5, '2025-05-06 21:02:50', '2025-07-31 17:08:43', 1, '2025-03-24 22:23:33', '2025-01-29 13:20:56');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `logo_url`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Grady, Lockman and Flatley Brand', 'grady-lockman-and-flatley-brand', 'https://via.placeholder.com/300x150.png/00bb22?text=business+exercitationem', 'Voluptatem commodi id esse debitis et. Voluptatem ut impedit a. Aut corrupti numquam deserunt aliquam ipsam neque. Voluptatem maiores rerum hic autem cum incidunt quam.', 0, '2024-07-07 07:39:44', '2024-07-17 15:33:07'),
(2, 'Walsh-Armstrong Brand', 'walsh-armstrong-brand', 'https://via.placeholder.com/300x150.png/001177?text=business+fuga', 'Ut sint possimus earum accusantium hic. Possimus ut eveniet assumenda nemo quibusdam quaerat excepturi. Sequi autem magnam magnam suscipit. Aut dolorum expedita quisquam dolor sint. Reiciendis voluptatem in quasi nisi voluptatem.', 1, '2024-10-27 18:38:52', '2025-02-20 09:37:29'),
(3, 'Sporer PLC Brand', 'sporer-plc-brand', 'https://via.placeholder.com/300x150.png/0022ee?text=business+omnis', 'Quis temporibus cum nisi dolorum repudiandae facilis possimus dicta. Maiores cumque cum a consequatur dicta. Nihil quo nesciunt excepturi placeat id eos. Laudantium officiis cumque est voluptatem hic.', 1, '2024-09-04 04:45:15', '2024-12-19 19:18:46'),
(4, 'Becker Group Brand', 'becker-group-brand', 'https://via.placeholder.com/300x150.png/00bbee?text=business+culpa', 'Totam vitae quo ipsum tempore est. Dolore quia magnam dolore impedit provident eligendi. Libero aut ullam repellat sed et error similique quis. Et animi eius unde perferendis magni eius.', 1, '2025-02-07 12:30:27', '2024-11-26 06:34:25'),
(5, 'Christiansen Group Brand', 'christiansen-group-brand', 'https://via.placeholder.com/300x150.png/0088aa?text=business+impedit', 'Itaque repellat dicta commodi sit fugit. Error iste ut sed est. Ad rerum ut delectus quasi explicabo velit et.', 1, '2024-07-20 00:26:49', '2024-08-01 16:34:41'),
(6, 'Bergnaum, Wiegand and Howell Brand', 'bergnaum-wiegand-and-howell-brand', 'https://via.placeholder.com/300x150.png/00cc22?text=business+quia', 'Minima ducimus deleniti qui sunt sint nihil quis. Quaerat et voluptatum quae et deserunt minima vel. Ipsa quae aspernatur id qui porro odit harum quo.', 0, '2025-01-18 06:08:30', '2024-12-18 04:23:47'),
(7, 'Hodkiewicz, Krajcik and Flatley Brand', 'hodkiewicz-krajcik-and-flatley-brand', 'https://via.placeholder.com/300x150.png/00ddaa?text=business+nostrum', 'Aliquid enim nulla non nesciunt corporis consequatur in. Eum ut quaerat explicabo inventore explicabo qui rem. Non quasi in et fugiat porro unde voluptatem. Necessitatibus natus ab ipsum qui a.', 1, '2024-12-18 09:22:39', '2025-04-18 11:47:37'),
(8, 'Wilderman, Mitchell and Jerde Brand', 'wilderman-mitchell-and-jerde-brand', 'https://via.placeholder.com/300x150.png/00bb55?text=business+aut', 'Ea incidunt rerum et enim sed tempora quaerat rem. Fuga ipsum quia aut quod ex corrupti. Ut quibusdam rerum quia quis explicabo distinctio neque. Voluptatem et doloremque eos pariatur quisquam.', 1, '2025-04-03 21:57:18', '2025-02-05 17:28:18'),
(9, 'Hegmann, Parker and Abernathy Brand', 'hegmann-parker-and-abernathy-brand', 'https://via.placeholder.com/300x150.png/0044aa?text=business+quidem', 'Officiis alias occaecati reiciendis aut consequatur voluptatem est. Quis velit nostrum deleniti et.', 1, '2025-03-26 23:03:12', '2024-07-15 19:44:00'),
(10, 'Kub, Bednar and Prosacco Brand', 'kub-bednar-and-prosacco-brand', 'https://via.placeholder.com/300x150.png/003355?text=business+a', 'Aut molestiae voluptas dolore ipsam id. Perspiciatis tempora iure unde. Necessitatibus eos molestiae suscipit velit nulla. Commodi nostrum laudantium minus nemo rerum.', 1, '2025-02-03 13:17:23', '2024-10-12 05:42:10');

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

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `description`, `image_url`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'eum Category', 'eum-category', NULL, 'Quo aut qui nam magni ex libero omnis.', 'https://via.placeholder.com/640x480.png/0055ee?text=furniture+nesciunt', 1, '2025-05-27 01:31:51', '2025-03-13 15:48:39'),
(2, 'suscipit Category', 'suscipit-category', NULL, 'Doloremque nam quod dolor est.', 'https://via.placeholder.com/640x480.png/00dd99?text=furniture+adipisci', 1, '2024-08-30 14:26:43', '2025-01-30 04:45:04'),
(3, 'neque Category', 'neque-category', NULL, 'Eos vero non inventore est placeat.', 'https://via.placeholder.com/640x480.png/00aaaa?text=furniture+in', 1, '2025-03-28 20:18:16', '2025-03-29 03:55:11'),
(4, 'et Category', 'et-category', NULL, 'Esse quo fugiat quia cum quam voluptatibus rerum.', 'https://via.placeholder.com/640x480.png/003322?text=furniture+et', 1, '2024-11-19 12:21:13', '2025-02-09 07:21:31'),
(5, 'ut Category', 'ut-category', NULL, 'Qui autem eligendi consectetur aspernatur vel nihil est rerum.', 'https://via.placeholder.com/640x480.png/00ee22?text=furniture+voluptatem', 1, '2024-09-05 14:31:00', '2025-04-29 12:25:46'),
(6, 'officiis Category', 'officiis-category', 1, 'Autem dolorum ex quia laboriosam et voluptas.', 'https://via.placeholder.com/640x480.png/00ffff?text=furniture+ut', 1, '2025-03-15 12:26:12', '2024-11-22 03:39:18'),
(7, 'accusantium Category', 'accusantium-category', 1, 'Ad modi doloribus porro iusto voluptatem voluptatum.', 'https://via.placeholder.com/640x480.png/00aa11?text=furniture+vitae', 0, '2024-08-07 14:14:52', '2024-07-04 07:46:47'),
(8, 'harum Category', 'harum-category', 1, 'Placeat et non facere hic rerum quo officiis.', 'https://via.placeholder.com/640x480.png/007799?text=furniture+quae', 1, '2024-08-11 01:42:26', '2025-01-10 23:56:09'),
(9, 'nulla Category', 'nulla-category', 1, 'Sint alias accusamus est repudiandae inventore.', 'https://via.placeholder.com/640x480.png/004411?text=furniture+nihil', 1, '2025-05-22 14:33:10', '2024-09-12 14:29:40'),
(10, 'facere Category', 'facere-category', 7, 'Consequatur aut mollitia quo a ut repudiandae et.', 'https://via.placeholder.com/640x480.png/0099ee?text=furniture+id', 1, '2025-01-12 01:17:37', '2025-02-16 18:42:11'),
(11, 'doloremque Category', 'doloremque-category', 2, 'Et reprehenderit maxime aspernatur quo.', 'https://via.placeholder.com/640x480.png/0088aa?text=furniture+et', 1, '2024-07-04 03:05:01', '2024-11-04 11:49:00'),
(12, 'rerum Category', 'rerum-category', 2, 'Corrupti sed voluptatibus esse quis soluta maxime voluptas aut.', 'https://via.placeholder.com/640x480.png/005577?text=furniture+facilis', 1, '2025-03-29 12:59:45', '2024-06-11 23:45:04'),
(13, 'veritatis Category', 'veritatis-category', 2, 'Ut praesentium fugit aut sunt iusto accusantium.', 'https://via.placeholder.com/640x480.png/0077aa?text=furniture+aut', 1, '2024-06-11 09:55:57', '2024-08-26 09:44:47'),
(14, 'sed Category', 'sed-category', 11, 'Tempore et id necessitatibus earum nemo vel.', 'https://via.placeholder.com/640x480.png/009977?text=furniture+repudiandae', 1, '2025-02-12 08:38:05', '2024-12-04 06:57:35'),
(15, 'sit Category', 'sit-category', 11, 'Quia molestiae debitis voluptatem recusandae est debitis quis.', 'https://via.placeholder.com/640x480.png/009955?text=furniture+incidunt', 1, '2024-06-09 15:10:22', '2024-11-26 16:17:09'),
(16, 'quia Category', 'quia-category', 12, 'Molestiae nihil voluptatem et ratione velit et in exercitationem.', 'https://via.placeholder.com/640x480.png/008866?text=furniture+porro', 1, '2024-12-05 13:20:53', '2024-07-31 15:00:47'),
(17, 'ex Category', 'ex-category', 12, 'Maiores non iste aut omnis asperiores.', 'https://via.placeholder.com/640x480.png/0055ff?text=furniture+enim', 1, '2024-09-01 21:23:44', '2024-11-25 12:19:02'),
(18, 'mollitia Category', 'mollitia-category', 3, 'Saepe numquam enim omnis consequuntur id.', 'https://via.placeholder.com/640x480.png/0022ee?text=furniture+nihil', 1, '2024-11-28 16:01:23', '2025-02-09 15:37:13'),
(19, 'quod Category', 'quod-category', 3, 'Ipsa dicta a unde sint incidunt fuga sed.', 'https://via.placeholder.com/640x480.png/00eebb?text=furniture+minima', 0, '2025-02-16 13:04:39', '2025-03-30 13:40:04'),
(20, 'delectus Category', 'delectus-category', 3, 'Ipsam est quidem soluta ex.', 'https://via.placeholder.com/640x480.png/003311?text=furniture+quo', 1, '2025-01-01 00:12:43', '2025-01-22 16:40:27'),
(21, 'pariatur Category', 'pariatur-category', 20, 'Enim quas eaque itaque consequatur corporis velit aut non.', 'https://via.placeholder.com/640x480.png/002299?text=furniture+perspiciatis', 1, '2024-09-21 01:25:22', '2024-09-08 19:34:00'),
(22, 'deleniti Category', 'deleniti-category', 4, 'Eligendi molestiae et nam.', 'https://via.placeholder.com/640x480.png/00aa44?text=furniture+ullam', 1, '2024-08-15 19:42:01', '2025-05-26 08:52:03'),
(23, 'nisi Category', 'nisi-category', 4, 'Esse odio explicabo id voluptas est esse.', 'https://via.placeholder.com/640x480.png/001100?text=furniture+ut', 1, '2024-07-30 06:56:36', '2025-02-13 01:47:05'),
(24, 'dolores Category', 'dolores-category', 22, 'Ut blanditiis ea beatae alias a vel consectetur totam.', 'https://via.placeholder.com/640x480.png/005577?text=furniture+harum', 1, '2024-11-12 17:39:14', '2024-10-01 06:25:47'),
(25, 'quis Category', 'quis-category', 22, 'Est sint in sint nulla eaque.', 'https://via.placeholder.com/640x480.png/00bbdd?text=furniture+amet', 1, '2024-11-04 11:26:23', '2025-01-31 11:49:31'),
(26, 'non Category', 'non-category', 5, 'Deleniti iste aspernatur rerum qui vel cumque et.', 'https://via.placeholder.com/640x480.png/002200?text=furniture+animi', 1, '2024-12-14 09:10:58', '2024-09-27 15:50:29'),
(27, 'voluptas Category', 'voluptas-category', 5, 'Voluptas autem sit aut dolorem earum vel adipisci.', 'https://via.placeholder.com/640x480.png/002211?text=furniture+ea', 1, '2024-07-03 09:11:13', '2025-03-04 02:12:37'),
(28, 'ipsam Category', 'ipsam-category', 5, 'Ut et esse aut aliquid.', 'https://via.placeholder.com/640x480.png/00ee55?text=furniture+fugiat', 1, '2025-02-17 04:05:02', '2024-11-26 05:32:45'),
(29, 'sapiente Category', 'sapiente-category', 27, 'Sequi sit ducimus laboriosam quia eaque.', 'https://via.placeholder.com/640x480.png/002222?text=furniture+magni', 1, '2025-03-23 06:20:57', '2025-02-27 01:16:25'),
(30, 'quo Category', 'quo-category', 27, 'Rem tenetur id libero ut ut.', 'https://via.placeholder.com/640x480.png/007755?text=furniture+laboriosam', 1, '2025-04-04 15:32:05', '2024-06-09 22:53:48');

-- --------------------------------------------------------

--
-- Table structure for table `contact_submissions`
--

CREATE TABLE `contact_submissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('new','read','replied','resolved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `admin_reply` text COLLATE utf8mb4_unicode_ci,
  `replied_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_submissions`
--

INSERT INTO `contact_submissions` (`id`, `name`, `email`, `phone`, `subject`, `message`, `status`, `admin_reply`, `replied_by`, `created_at`, `updated_at`) VALUES
(1, 'Niko Frami', 'dturner@example.net', NULL, 'Est sequi iure libero.', 'Qui deleniti quod ipsa molestias. Expedita voluptas eaque ex qui ipsa.', 'read', NULL, NULL, '2025-05-22 00:59:37', '2025-02-10 13:02:05'),
(2, 'Jayda Hagenes', 'xromaguera@example.net', '313.880.9868', 'Officia at est voluptas.', 'Est voluptatem quia dolorem. Quo sapiente dolore eligendi vero perspiciatis et voluptatem.', 'new', NULL, NULL, '2025-01-01 13:24:24', '2024-12-09 10:58:04'),
(3, 'Harrison Durgan', 'aliya.grant@example.com', '+1 (979) 747-7075', 'Est et nisi iste.', 'Eius dolores libero cupiditate a neque nesciunt. Accusantium voluptas dolor perferendis consequuntur.', 'resolved', 'Quo iure quaerat iusto fuga. Ullam rem est delectus et quod.', 8, '2025-02-01 19:47:57', '2025-05-17 20:59:57'),
(4, 'Reba Abernathy', 'qlang@example.org', '+1-479-620-7189', 'Nulla voluptatem reiciendis nostrum doloribus.', 'Harum ipsam qui sed commodi quia labore. In aliquam sed non eum repellendus. Dolor rerum possimus accusamus eum facilis.', 'new', NULL, NULL, '2025-02-13 23:23:39', '2025-03-02 13:25:38'),
(5, 'Gladyce Roberts', 'macejkovic.edwardo@example.org', '845-837-5501', 'Incidunt facere nam eum sunt illo minima.', 'Quia omnis quae nesciunt blanditiis alias. Sed impedit aspernatur nesciunt hic nemo nam expedita. Et neque est quia aut tenetur repellat. Iste consequatur eaque illum perspiciatis placeat perspiciatis consequatur.', 'resolved', 'Magni quos sint id quibusdam nesciunt aspernatur excepturi. Voluptatem eum eum error modi praesentium placeat quasi. Voluptatem atque ex iure fugit molestias a. Totam occaecati enim velit maiores.', 1, '2025-04-29 16:05:13', '2025-04-07 16:00:43'),
(6, 'Jettie Heidenreich', 'howe.kathryne@example.com', '+1.678.301.7492', 'Tenetur voluptas in recusandae tempora.', 'Sed voluptatem cum accusantium in. Eum et laudantium dolorem autem et. Ipsum impedit pariatur nemo.', 'replied', 'Harum impedit autem ipsa distinctio quae molestiae asperiores. Omnis aut aliquid esse odio nihil perferendis rerum. Sit reprehenderit ea soluta voluptatum placeat sunt quidem. Et est voluptatem minima eaque omnis laborum eveniet.', 6, '2025-02-20 18:30:01', '2025-01-25 12:46:00'),
(7, 'Ena Fisher DDS', 'dibbert.darrick@example.net', '1-585-308-0420', 'Quibusdam eos possimus laborum ut vel.', 'Rerum iure est voluptatibus neque. Voluptatem sed eum explicabo voluptatem veniam dolores.', 'replied', 'Rerum pariatur quis atque qui nulla quo harum. Facere voluptatem deserunt accusamus totam est laboriosam.', 11, '2025-01-26 05:46:06', '2025-03-04 07:27:11'),
(8, 'Miss Danyka Vandervort', 'maureen60@example.net', '704-976-6856', 'Id ad dolor reprehenderit praesentium.', 'Occaecati veritatis praesentium autem optio quo et. Recusandae voluptatem qui eum vitae qui dolorem deserunt voluptatem. Distinctio ratione qui harum deserunt fuga nam.', 'resolved', 'Quis voluptatem beatae accusamus repellendus. Impedit qui qui et quis sed. Odio corporis reprehenderit iusto.', 11, '2025-02-27 10:17:52', '2025-02-10 13:54:57'),
(9, 'Litzy Mann', 'turner.dariana@example.net', '+1-984-600-9374', 'Ut odit perferendis et iusto est.', 'Quos deserunt eos doloremque ratione atque. Deserunt fuga natus sequi quia. Placeat quis et fugit illo totam.', 'replied', 'Eligendi eligendi nemo sapiente reprehenderit. Excepturi totam eos dolorem alias. Omnis modi dignissimos voluptas. Saepe excepturi soluta quo perspiciatis porro voluptatem.', 10, '2025-02-27 09:12:48', '2024-12-13 13:24:56'),
(10, 'Marcelina Littel', 'qweber@example.com', NULL, 'Veniam eligendi facilis natus.', 'Magni tempore totam est deleniti quae nam. Ratione delectus earum adipisci nulla aut rerum sint aut. Rem quis voluptate dolores molestiae minus et aut. Et accusamus expedita doloribus sequi eum quaerat veniam rerum.', 'resolved', 'Aut quos blanditiis occaecati culpa ut laborum et. Facere quo eius sit est ipsa quo non libero. Id id consequatur aliquid fugit mollitia qui officia.', 11, '2024-12-05 08:26:17', '2025-06-02 17:10:48'),
(11, 'Berneice Stoltenberg', 'iframi@example.org', NULL, 'Ipsam fuga ea qui.', 'Omnis tenetur harum et optio impedit dolore voluptatem. Et voluptatem qui sint sapiente itaque. Ipsum sapiente soluta laudantium excepturi rerum placeat magnam. Nihil natus et sit cumque eos voluptate culpa.', 'read', NULL, NULL, '2025-03-05 15:59:49', '2025-03-08 00:01:26'),
(12, 'Baby Nikolaus PhD', 'federico.ortiz@example.com', '248-875-1908', 'Ad consequuntur occaecati et expedita quaerat delectus.', 'Consequatur reiciendis aperiam quia rerum. Vel quaerat reiciendis in. Odio reprehenderit fugit suscipit possimus voluptatem qui rerum. Possimus explicabo fuga repellat.', 'resolved', 'Enim qui ab assumenda odit. Est voluptas omnis voluptatibus eius. Autem at dolor et et possimus dolores. Est sint repellat doloremque eos sint quae sed.', 11, '2025-01-04 19:13:13', '2025-04-07 09:16:33'),
(13, 'Prof. Reynold Zemlak DVM', 'uhaag@example.com', NULL, 'Ullam reprehenderit et enim.', 'Nisi voluptates eaque distinctio beatae esse voluptatem accusantium. Accusamus maxime enim quia porro quo nostrum non.', 'resolved', 'Occaecati ut in omnis dolor ut aut deserunt. Odio dicta et excepturi dolorum dolores. Ea ea suscipit explicabo numquam.', 8, '2025-03-26 09:15:28', '2025-02-19 12:04:49'),
(14, 'Owen Yundt', 'rebeca.lesch@example.com', NULL, 'Dolorem et aperiam et dolores consequatur ut.', 'Sit porro qui tenetur perferendis voluptatum nostrum. Unde quis quia non ex blanditiis laudantium eaque tempora. Vel corporis quia vel dicta sit dolores. Illo sint velit aut consequuntur ut occaecati quia.', 'resolved', 'Deserunt voluptatibus laudantium provident eveniet. Sequi eveniet porro saepe adipisci repellat aut aut saepe. Et dolore et expedita debitis illo in ab. Soluta et explicabo cumque harum sit non.', 10, '2025-02-23 23:48:58', '2025-05-29 02:52:41'),
(15, 'Dr. Diego Treutel DVM', 'xdare@example.org', '586.576.6275', 'Sed ut explicabo rerum perspiciatis repellat.', 'Qui libero corrupti id est commodi asperiores. Quae et aliquam consequatur qui qui. Vitae voluptatum debitis expedita quod non ducimus accusamus. Facilis dolores sint sunt dicta et ut distinctio.', 'read', NULL, NULL, '2025-04-21 11:46:11', '2025-02-25 22:46:56'),
(16, 'Prof. Lila Abernathy DDS', 'zjohnston@example.net', NULL, 'Qui excepturi quam quia sit eos aperiam.', 'Et explicabo soluta suscipit ab nulla et aut. Et architecto perspiciatis libero nam aut ab accusamus. Iure accusamus iure in et beatae. Sunt impedit ut quo maxime.', 'resolved', 'Nostrum occaecati ab et. Quam deleniti facilis atque in id. Libero pariatur ut esse quo quibusdam exercitationem ut nulla. Atque debitis eos odit molestias porro consequatur voluptatem.', 7, '2025-05-13 13:08:02', '2025-03-20 18:32:43'),
(17, 'Elmo Waters', 'brenner@example.org', NULL, 'Distinctio enim reprehenderit ut eos.', 'Quis fugiat est reprehenderit autem quod doloribus. Illum quo qui beatae consequuntur.', 'resolved', 'Molestiae qui perspiciatis exercitationem est. Molestiae veritatis quia tenetur et quidem.', 8, '2024-12-05 12:16:41', '2025-05-21 08:05:24'),
(18, 'Wyatt Daniel', 'pgibson@example.com', '270-444-3463', 'Quidem at ipsam deserunt et tenetur consequatur.', 'Dignissimos recusandae voluptatem adipisci voluptas aspernatur rerum necessitatibus necessitatibus. Modi possimus fuga aut voluptatem est at beatae.', 'read', NULL, NULL, '2025-03-03 13:56:28', '2025-04-26 10:29:27'),
(19, 'Walter Jacobi', 'eula59@example.net', '316-384-0216', 'Earum architecto eligendi et ea.', 'Eius corporis optio ut fugiat cumque autem. Maxime modi omnis fuga quod accusantium dicta. Et voluptas aut nostrum eum asperiores. Qui praesentium cum vel laborum.', 'replied', 'Veritatis cumque facere molestias saepe soluta cum facilis debitis. Nihil odio excepturi quis nihil autem. Qui voluptatibus quidem nisi ducimus.', 6, '2024-12-29 21:57:00', '2025-01-21 16:04:26'),
(20, 'Courtney Powlowski', 'will.alvera@example.org', '+15596871270', 'Aut qui nesciunt numquam perspiciatis non.', 'Perspiciatis quibusdam beatae voluptatem omnis perferendis pariatur. Et et praesentium qui rerum repellendus incidunt. Earum in vero officiis aut. Suscipit consectetur minima aspernatur placeat iusto magnam ut adipisci.', 'replied', 'Molestias alias qui facilis vel unde. Qui et quam iusto hic autem. Tenetur praesentium tempora omnis et fuga. Autem fugit accusamus eos optio provident omnis voluptatibus repellendus.', 1, '2025-01-25 12:40:39', '2024-12-06 13:58:37');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_05_30_025801_create_users_table', 1),
(2, '2025_05_30_025822_create_addresses_table', 1),
(3, '2025_05_30_025846_create_categories_table', 1),
(4, '2025_05_30_025907_create_brands_table', 1),
(5, '2025_05_30_030043_create_products_table', 1),
(6, '2025_05_30_030104_create_product_images_table', 1),
(7, '2025_05_30_030115_create_attributes_table', 1),
(8, '2025_05_30_030127_create_attribute_values_table', 1),
(9, '2025_05_30_030143_create_product_variants_table', 1),
(10, '2025_05_30_030153_create_product_variant_attribute_values_table', 1),
(11, '2025_05_30_030203_create_carts_table', 1),
(12, '2025_05_30_030213_create_cart_items_table', 1),
(13, '2025_05_30_030225_create_payment_methods_table', 1),
(14, '2025_05_30_030301_create_shipping_methods_table', 1),
(15, '2025_05_30_030318_create_orders_table', 1),
(16, '2025_05_30_030330_create_order_items_table', 1),
(17, '2025_05_30_030340_create_reviews_table', 1),
(18, '2025_05_30_030352_create_wishlists_table', 1),
(19, '2025_05_30_030400_create_wishlist_items_table', 1),
(20, '2025_05_30_030410_create_promotions_table', 1),
(21, '2025_05_30_030417_create_promotion_product_table', 1),
(22, '2025_05_30_030427_create_promotion_category_table', 1),
(23, '2025_05_30_030442_create_order_promotion_table', 1),
(24, '2025_05_30_030453_create_banners_table', 1),
(25, '2025_05_30_030503_create_pages_table', 1),
(26, '2025_05_30_030514_create_contact_submissions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `order_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal_amount` decimal(15,2) NOT NULL,
  `shipping_fee` decimal(10,2) NOT NULL,
  `discount_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `tax_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(15,2) NOT NULL,
  `payment_method_id` bigint UNSIGNED NOT NULL,
  `payment_status` enum('pending','paid','failed','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `shipping_method_id` bigint UNSIGNED NOT NULL,
  `order_status` enum('pending_confirmation','processing','shipped','delivered','cancelled','returned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending_confirmation',
  `customer_note` text COLLATE utf8mb4_unicode_ci,
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `ordered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `cancellation_reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_code`, `customer_name`, `customer_email`, `customer_phone`, `shipping_address`, `subtotal_amount`, `shipping_fee`, `discount_amount`, `tax_amount`, `total_amount`, `payment_method_id`, `payment_status`, `shipping_method_id`, `order_status`, `customer_note`, `admin_note`, `ordered_at`, `delivered_at`, `cancelled_at`, `cancellation_reason`, `created_at`, `updated_at`) VALUES
(1, 1, 'ORD-VT4O3YCJ', 'Admin User', 'admin@example.com', '(267) 751-1346', '4717 Merritt Pine\nSouth Emanuelton, FL 67853-9904', '13671.61', '16.81', '0.00', '397.52', '14085.94', 4, 'paid', 3, 'shipped', NULL, NULL, '2025-03-05 22:49:12', NULL, NULL, NULL, '2025-03-05 22:49:12', '2025-06-02 20:56:34'),
(2, 5, 'ORD-JNQVUWPW', 'Favian Schinner', 'bstroman@example.org', '+1 (551) 976-0879', '37745 Denesik Mission\nDurganland, NH 22404-1009', '2583.37', '35.82', '0.00', '245.73', '2864.92', 2, 'pending', 2, 'shipped', NULL, NULL, '2024-12-04 19:32:33', NULL, NULL, NULL, '2024-12-04 19:32:33', '2025-06-02 20:56:34'),
(3, 9, 'ORD-XJD6TGSZ', 'Imogene Huel', 'gutkowski.alexandre@example.org', '1-580-755-0254', '7228 Don Shore Apt. 410\nFaheymouth, RI 67887', '13766.85', '13.49', '0.00', '393.00', '14173.34', 4, 'pending', 1, 'shipped', NULL, NULL, '2025-03-29 09:31:36', NULL, NULL, NULL, '2025-03-29 09:31:36', '2025-06-02 20:56:34'),
(4, 5, 'ORD-SDUZIQJT', 'Favian Schinner', 'bstroman@example.org', '+1 (551) 976-0879', '85626 Zella Ville Suite 610\nPort Cordie, AR 10657', '29261.78', '16.81', '0.00', '21.62', '29300.21', 3, 'failed', 3, 'shipped', 'Debitis vero dolores natus.', NULL, '2025-05-27 17:15:51', NULL, NULL, NULL, '2025-05-27 17:15:51', '2025-06-02 20:56:34'),
(5, 7, 'ORD-BF0SAUSC', 'Brendan Gusikowski', 'dandre.jacobs@example.org', '1-681-218-4638', '82023 Schaden Circle Apt. 407\nHayesview, GA 06979-3701', '7727.88', '16.81', '0.00', '83.99', '7828.68', 4, 'pending', 3, 'delivered', NULL, NULL, '2025-05-26 12:51:49', '2025-06-02 20:40:45', NULL, NULL, '2025-05-26 12:51:49', '2025-06-02 20:56:34'),
(6, 2, 'ORD-WY392ACC', 'Antonina Kautzer', 'ydeckow@example.org', '(716) 467-4836', '317 Williamson Ridges Apt. 338\nSouth Trevion, SD 64672', '20688.57', '35.82', '0.00', '171.75', '20896.14', 5, 'refunded', 2, 'returned', NULL, NULL, '2025-03-05 14:03:47', NULL, '2025-04-09 21:55:31', 'Ipsam et eum quae.', '2025-03-05 14:03:47', '2025-06-02 20:56:34'),
(7, 3, 'ORD-0I7S0UCC', 'Marilou Weimann III', 'wcassin@example.com', '(678) 671-6189', '18348 Malachi Port Apt. 418\nDeonstad, AL 67964-3046', '19283.01', '13.49', '0.00', '280.07', '19576.57', 3, 'pending', 1, 'returned', NULL, 'Nulla veritatis saepe et voluptas velit error est.', '2025-03-07 05:14:29', NULL, '2025-04-09 21:23:42', 'Non dolores eum aliquam sed.', '2025-03-07 05:14:29', '2025-06-02 20:56:34'),
(8, 11, 'ORD-EURI2ZHJ', 'Prof. Sheridan Satterfield', 'nhyatt@example.org', '+1 (445) 680-3730', '81829 Elsie Centers\nNorth Giuseppeville, LA 83821-3302', '11492.82', '13.49', '0.00', '23.23', '11529.54', 5, 'refunded', 1, 'cancelled', NULL, NULL, '2025-05-04 00:39:17', NULL, '2025-05-30 06:25:44', 'Sed maiores est autem.', '2025-05-04 00:39:17', '2025-06-02 20:56:34'),
(9, 9, 'ORD-HD9BINUG', 'Imogene Huel', 'gutkowski.alexandre@example.org', '1-580-755-0254', '307 Kautzer Parkway\nManteton, KS 06927', '7309.81', '35.82', '0.00', '351.86', '7697.49', 4, 'refunded', 2, 'shipped', 'Quae quia voluptatem et animi ut.', NULL, '2024-12-24 18:45:56', NULL, NULL, NULL, '2024-12-24 18:45:56', '2025-06-02 20:56:34'),
(10, 5, 'ORD-A8PDYNOV', 'Favian Schinner', 'bstroman@example.org', '+1 (551) 976-0879', '491 Filomena Points Apt. 688\nPort Kayli, ME 17185-7635', '31158.20', '35.82', '0.00', '396.50', '31590.52', 1, 'failed', 2, 'processing', NULL, NULL, '2025-02-19 20:00:53', NULL, NULL, NULL, '2025-02-19 20:00:53', '2025-06-02 20:56:34'),
(11, 2, 'ORD-JCIQJXKM', 'Antonina Kautzer', 'ydeckow@example.org', '(716) 467-4836', '3817 Natasha Pines\nWest Dustinside, MT 37736-9890', '16114.74', '16.81', '0.00', '378.19', '16509.74', 1, 'paid', 3, 'processing', NULL, NULL, '2025-04-07 10:10:35', NULL, NULL, NULL, '2025-04-07 10:10:35', '2025-06-02 20:56:34'),
(12, 1, 'ORD-TG0MHFJ4', 'Admin User', 'admin@example.com', '(267) 751-1346', '3336 Boehm Park\nEast Tyshawn, NY 46933-8364', '14180.13', '35.82', '0.00', '67.40', '14283.35', 1, 'paid', 2, 'processing', NULL, NULL, '2025-03-21 22:49:56', NULL, NULL, NULL, '2025-03-21 22:49:56', '2025-06-02 20:56:34'),
(13, 7, 'ORD-NIYNWII2', 'Brendan Gusikowski', 'dandre.jacobs@example.org', '1-681-218-4638', '10663 Landen Flats Apt. 096\nWest Naomibury, TX 03365-8526', '21210.37', '13.49', '0.00', '143.92', '21367.78', 1, 'refunded', 1, 'shipped', 'Autem necessitatibus aut autem accusamus nam nisi.', NULL, '2025-03-31 06:53:15', NULL, NULL, NULL, '2025-03-31 06:53:15', '2025-06-02 20:56:34'),
(14, 5, 'ORD-H7YA9ZSX', 'Favian Schinner', 'bstroman@example.org', '+1 (551) 976-0879', '127 Zane Walks Apt. 823\nEast Nelle, VT 60887-1054', '22744.45', '16.81', '0.00', '360.76', '23122.02', 5, 'refunded', 3, 'delivered', NULL, NULL, '2025-03-20 14:45:28', '2025-04-15 03:24:22', NULL, NULL, '2025-03-20 14:45:28', '2025-06-02 20:56:34'),
(15, 2, 'ORD-XDRA0WX2', 'Antonina Kautzer', 'ydeckow@example.org', '(716) 467-4836', '8002 Turcotte Green Apt. 060\nSouth Dillon, CT 52060', '24890.49', '13.49', '0.00', '347.64', '25251.62', 5, 'refunded', 1, 'processing', 'Beatae nesciunt natus placeat nam quis.', NULL, '2025-01-17 05:13:59', NULL, NULL, NULL, '2025-01-17 05:13:59', '2025-06-02 20:56:34'),
(16, 10, 'ORD-SGL7CHKZ', 'Easter Gleason', 'marlene.gerhold@example.net', '956-406-7822', '4850 Casper Flats\nMelliefurt, OK 22947', '27919.43', '13.49', '0.00', '161.89', '28094.81', 4, 'paid', 1, 'pending_confirmation', 'Fugiat non qui necessitatibus repudiandae.', NULL, '2024-12-28 06:10:14', NULL, NULL, NULL, '2024-12-28 06:10:14', '2025-06-02 20:56:34'),
(17, 3, 'ORD-W2MG4GGV', 'Marilou Weimann III', 'wcassin@example.com', '(678) 671-6189', '11303 Osinski Fork Apt. 525\nWillland, MI 35991', '22283.98', '16.81', '0.00', '227.59', '22528.38', 2, 'refunded', 3, 'returned', NULL, NULL, '2025-03-31 23:39:17', NULL, '2025-04-22 12:50:10', 'Nostrum dolor culpa voluptatem.', '2025-03-31 23:39:17', '2025-06-02 20:56:35'),
(18, 7, 'ORD-DWMPTFJE', 'Brendan Gusikowski', 'dandre.jacobs@example.org', '1-681-218-4638', '991 Jordi Run Apt. 841\nHansenview, MI 40595', '26220.38', '35.82', '0.00', '299.98', '26556.18', 1, 'paid', 2, 'pending_confirmation', NULL, NULL, '2025-04-02 06:23:59', NULL, NULL, NULL, '2025-04-02 06:23:59', '2025-06-02 20:56:35'),
(19, 6, 'ORD-DAK9KRQQ', 'Idell Deckow MD', 'omcdermott@example.net', '314-717-6596', '3790 O\'Conner Hollow\nIkeview, MN 17439-6052', '13189.83', '16.81', '0.00', '269.99', '13476.63', 4, 'failed', 3, 'delivered', NULL, NULL, '2025-05-19 08:48:27', '2025-05-20 14:32:08', NULL, NULL, '2025-05-19 08:48:27', '2025-06-02 20:56:35'),
(20, 1, 'ORD-CPRLAS0W', 'Admin User', 'admin@example.com', '(267) 751-1346', '53518 Cooper Station Apt. 561\nWest Kaelaland, VT 50725-8790', '22849.05', '16.81', '0.00', '78.55', '22944.41', 3, 'refunded', 3, 'returned', NULL, NULL, '2024-12-06 23:11:51', NULL, '2025-03-09 20:00:20', 'Atque modi ut laudantium placeat possimus.', '2024-12-06 23:11:51', '2025-06-02 20:56:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_variant_id` bigint UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 1, 45, 48, 'aperiam pariatur non Chair', '[]', 2, '2282.68', '2025-04-17 16:42:28', '2025-01-26 09:34:32'),
(2, 1, 33, 43, 'est alias odio Bed', '[]', 3, '11388.93', '2025-04-06 20:06:19', '2025-03-06 07:10:35'),
(3, 2, 29, NULL, 'aperiam velit sit Table', NULL, 1, '2583.37', '2025-01-05 07:34:05', '2025-05-25 10:07:43'),
(4, 3, 47, 51, 'ut porro ea Bed', '[]', 3, '10504.38', '2025-05-21 23:31:24', '2025-04-23 06:10:47'),
(5, 3, 38, NULL, 'repellat et rerum Table', NULL, 1, '3131.37', '2025-04-24 20:25:16', '2025-01-18 15:54:43'),
(6, 3, 37, NULL, 'voluptatem eaque autem Chair', NULL, 1, '131.10', '2025-02-11 00:39:43', '2025-04-27 18:12:02'),
(7, 4, 17, NULL, 'enim iusto laboriosam Table', NULL, 3, '14677.08', '2025-05-01 23:31:34', '2025-02-02 04:34:34'),
(8, 4, 35, NULL, 'adipisci sint maxime Chair', NULL, 2, '4450.70', '2025-05-29 08:28:00', '2025-01-18 17:11:09'),
(9, 4, 10, NULL, 'aut blanditiis sed Sofa', NULL, 3, '10134.00', '2025-03-11 08:30:37', '2025-05-30 04:03:44'),
(10, 5, 28, 38, 'itaque deleniti temporibus Table', '[]', 2, '7727.88', '2025-05-31 18:45:32', '2025-03-05 15:19:51'),
(11, 6, 30, 41, 'ratione asperiores magnam Bed', '[]', 3, '6288.75', '2025-03-15 11:15:29', '2025-04-08 13:41:44'),
(12, 6, 50, NULL, 'et consequatur sed Chair', NULL, 1, '1422.36', '2025-02-17 08:11:14', '2025-03-06 04:19:12'),
(13, 6, 25, 36, 'sed facilis repellendus Table', '[]', 3, '12977.46', '2025-01-14 17:30:32', '2025-04-29 19:10:02'),
(14, 7, 43, NULL, 'distinctio delectus totam Chair', NULL, 1, '4519.18', '2025-02-22 18:42:50', '2025-06-02 05:26:48'),
(15, 7, 6, 9, 'et repudiandae ad Bed', '[]', 1, '4700.66', '2025-01-27 23:54:26', '2025-01-22 13:01:05'),
(16, 7, 25, 36, 'sed facilis repellendus Table', '[]', 1, '4325.82', '2025-04-17 11:04:08', '2025-05-20 17:24:21'),
(17, 7, 14, 18, 'inventore aspernatur aut Bed', '[]', 1, '2176.38', '2025-01-22 20:37:02', '2025-01-17 09:22:55'),
(18, 7, 4, 5, 'aliquam consectetur consequatur Chair', '[]', 1, '3560.97', '2025-05-03 12:12:56', '2025-03-08 23:17:38'),
(19, 8, 27, NULL, 'vel ut ullam Table', NULL, 3, '8114.82', '2025-05-20 00:23:18', '2025-04-07 01:52:10'),
(20, 8, 10, NULL, 'aut blanditiis sed Sofa', NULL, 1, '3378.00', '2025-01-26 05:28:28', '2025-02-19 13:51:50'),
(21, 9, 19, 27, 'omnis eum repudiandae Cabinet', '[]', 2, '4557.44', '2025-04-06 19:48:02', '2025-02-05 18:43:16'),
(22, 9, 35, NULL, 'adipisci sint maxime Chair', NULL, 1, '2225.35', '2025-05-09 23:48:33', '2025-01-14 09:12:40'),
(23, 9, 8, 10, 'quaerat corporis autem Bed', '[]', 2, '527.02', '2025-04-17 02:31:00', '2025-02-17 00:42:54'),
(24, 10, 39, NULL, 'atque quia ipsa Table', NULL, 3, '2712.24', '2025-03-21 13:18:21', '2025-04-26 05:25:34'),
(25, 10, 29, NULL, 'aperiam velit sit Table', NULL, 3, '7750.11', '2025-03-29 05:40:38', '2025-01-23 10:26:19'),
(26, 10, 2, NULL, 'velit est est Table', NULL, 3, '10615.53', '2025-02-06 12:30:10', '2025-02-23 22:59:56'),
(27, 10, 40, 45, 'aut mollitia atque Table', '[]', 3, '1369.32', '2025-02-07 03:05:50', '2025-05-30 12:37:46'),
(28, 10, 25, 37, 'sed facilis repellendus Table', '[]', 2, '8711.00', '2025-02-08 11:57:51', '2025-02-02 15:17:50'),
(29, 11, 1, 2, 'minima dolor neque Chair', '[]', 3, '1648.77', '2025-01-07 06:06:25', '2025-03-06 00:29:58'),
(30, 11, 3, 3, 'doloremque nostrum aliquam Chair', '[]', 2, '3291.84', '2025-03-28 01:22:28', '2025-03-16 19:25:06'),
(31, 11, 45, 48, 'aperiam pariatur non Chair', '[]', 3, '3424.02', '2025-05-17 04:27:31', '2025-04-25 21:28:46'),
(32, 11, 29, NULL, 'aperiam velit sit Table', NULL, 3, '7750.11', '2025-03-25 10:30:52', '2025-05-27 19:23:05'),
(33, 12, 23, 33, 'culpa optio non Bed', '[]', 3, '3239.34', '2025-03-31 03:27:05', '2025-05-14 00:07:48'),
(34, 12, 4, 6, 'aliquam consectetur consequatur Chair', '[]', 3, '10547.49', '2025-05-16 04:10:25', '2025-05-24 19:42:04'),
(35, 12, 37, NULL, 'voluptatem eaque autem Chair', NULL, 3, '393.30', '2025-05-11 22:59:07', '2025-02-02 20:43:37'),
(36, 13, 35, NULL, 'adipisci sint maxime Chair', NULL, 1, '2225.35', '2025-05-17 19:11:02', '2025-05-18 07:02:08'),
(37, 13, 48, 52, 'voluptatem animi molestiae Cabinet', '[]', 2, '8480.64', '2025-03-28 03:30:12', '2025-05-09 00:09:35'),
(38, 13, 47, 51, 'ut porro ea Bed', '[]', 3, '10504.38', '2025-03-13 05:05:42', '2025-03-20 11:13:46'),
(39, 14, 9, 15, 'et dolorem exercitationem Sofa', '[]', 3, '8744.04', '2025-01-19 12:13:17', '2025-05-03 17:07:01'),
(40, 14, 18, 24, 'natus et adipisci Cabinet', '[]', 1, '4235.83', '2025-02-02 12:14:06', '2025-01-26 03:15:16'),
(41, 14, 34, NULL, 'optio quo repudiandae Cabinet', NULL, 3, '3751.32', '2025-02-09 14:55:57', '2025-06-02 01:01:22'),
(42, 14, 3, 3, 'doloremque nostrum aliquam Chair', '[]', 2, '3291.84', '2025-01-13 04:37:19', '2025-01-18 10:21:05'),
(43, 14, 24, 34, 'perspiciatis sit et Cabinet', '[]', 2, '2721.42', '2025-05-10 00:00:45', '2025-02-03 13:05:48'),
(44, 15, 20, 28, 'sed eum sint Bed', '[]', 3, '9667.95', '2025-01-19 10:32:09', '2025-02-10 03:43:50'),
(45, 15, 8, 10, 'quaerat corporis autem Bed', '[]', 1, '263.51', '2025-04-11 19:05:10', '2025-05-16 11:29:10'),
(46, 15, 21, 30, 'a exercitationem quidem Chair', '[]', 1, '4010.73', '2025-05-20 01:31:45', '2025-02-11 20:00:37'),
(47, 15, 28, 38, 'itaque deleniti temporibus Table', '[]', 1, '3863.94', '2025-03-12 10:04:02', '2025-04-22 19:56:21'),
(48, 15, 4, 7, 'aliquam consectetur consequatur Chair', '[]', 2, '7084.36', '2025-02-24 15:35:28', '2025-05-17 02:11:59'),
(49, 16, 3, 3, 'doloremque nostrum aliquam Chair', '[]', 1, '1645.92', '2025-01-04 14:02:16', '2025-02-01 12:12:48'),
(50, 16, 11, 16, 'cum dicta iusto Bed', '[]', 3, '8140.08', '2025-03-19 09:37:15', '2025-03-07 20:35:30'),
(51, 16, 42, NULL, 'molestiae nihil nobis Sofa', NULL, 3, '12510.15', '2025-02-13 05:55:54', '2025-01-21 03:15:53'),
(52, 16, 15, 19, 'magni autem dolor Bed', '[]', 1, '1382.96', '2025-05-30 01:30:46', '2025-04-22 22:16:12'),
(53, 16, 48, 52, 'voluptatem animi molestiae Cabinet', '[]', 1, '4240.32', '2025-05-08 04:35:12', '2025-02-17 21:54:18'),
(54, 17, 32, NULL, 'maiores voluptas eos Table', NULL, 3, '6373.47', '2025-05-02 03:27:22', '2025-03-02 12:53:10'),
(55, 17, 26, NULL, 'ipsum distinctio illum Sofa', NULL, 3, '9038.01', '2025-04-22 19:08:54', '2025-05-12 17:43:20'),
(56, 17, 36, NULL, 'ea nihil ipsa Cabinet', NULL, 1, '4163.11', '2025-03-01 22:47:44', '2025-02-07 08:58:36'),
(57, 17, 31, NULL, 'consectetur aut esse Cabinet', NULL, 3, '2709.39', '2025-04-01 09:12:52', '2025-02-01 16:35:24'),
(58, 18, 20, 28, 'sed eum sint Bed', '[]', 3, '9667.95', '2025-05-15 08:00:03', '2025-01-26 10:42:42'),
(59, 18, 2, NULL, 'velit est est Table', NULL, 3, '10615.53', '2025-05-24 12:45:13', '2025-05-30 10:10:13'),
(60, 18, 27, NULL, 'vel ut ullam Table', NULL, 2, '5409.88', '2025-01-13 07:49:33', '2025-05-16 18:55:15'),
(61, 18, 8, 10, 'quaerat corporis autem Bed', '[]', 2, '527.02', '2025-05-11 18:20:48', '2025-02-22 06:30:42'),
(62, 19, 20, 28, 'sed eum sint Bed', '[]', 2, '6445.30', '2025-01-27 08:57:04', '2025-01-26 04:21:00'),
(63, 19, 35, NULL, 'adipisci sint maxime Chair', NULL, 1, '2225.35', '2025-05-24 19:20:36', '2025-05-26 12:48:13'),
(64, 19, 43, NULL, 'distinctio delectus totam Chair', NULL, 1, '4519.18', '2025-04-12 13:54:18', '2025-05-29 21:27:31'),
(65, 20, 29, NULL, 'aperiam velit sit Table', NULL, 3, '7750.11', '2025-04-27 14:16:21', '2025-04-17 12:23:38'),
(66, 20, 7, NULL, 'ut tempora totam Cabinet', NULL, 3, '11967.57', '2025-03-10 18:30:28', '2025-04-20 09:15:52'),
(67, 20, 38, NULL, 'repellat et rerum Table', NULL, 1, '3131.37', '2025-05-19 13:53:52', '2025-03-05 04:41:51');

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
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint UNSIGNED DEFAULT NULL,
  `page_type` enum('page','blog_post') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'page',
  `status` enum('published','draft') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `featured_image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `author_id`, `page_type`, `status`, `meta_title`, `meta_description`, `featured_image_url`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Praesentium quae dolorem accusantium.', 'praesentium-quae-dolorem-accusantium-khha3', 'Sed molestiae minus aperiam ut voluptas. Maxime facilis quam dolores autem error quas. Maiores cum quidem debitis hic. Alias natus dolor reprehenderit aut praesentium sed.\n\nIn eum amet libero occaecati ratione esse. Repudiandae autem explicabo consequuntur similique ratione soluta commodi. In ex qui corporis qui maiores.\n\nDoloribus quas est suscipit. Omnis fugit omnis sed quia quia.\n\nEt consequatur cupiditate dolor reiciendis. Voluptas sit cupiditate tenetur occaecati odio. Ut labore sint dolorem id qui. Ab explicabo ipsum exercitationem laborum consequuntur. Ipsa ipsam quisquam voluptatum similique dolorem omnis ut aut.\n\nAssumenda excepturi quibusdam est id aut deleniti. Corporis ratione quibusdam voluptatem voluptas. Quae quaerat autem culpa explicabo dolorum aliquam neque. Ut nulla deserunt distinctio eos distinctio.', 8, 'page', 'draft', NULL, NULL, NULL, NULL, '2025-03-26 03:50:12', '2025-04-14 02:21:09'),
(2, 'Eaque deleniti dolorem et consequatur.', 'eaque-deleniti-dolorem-et-consequatur-rrxHB', 'Et totam doloremque aliquam magni iusto quaerat. Quia cumque reprehenderit mollitia mollitia reiciendis magnam illum. Amet vitae aut dolor. At nisi quas quod ut.\n\nQuisquam ab ipsa molestiae at rerum rerum est. Et debitis odit deserunt aut explicabo omnis sit corrupti. Delectus incidunt odit illo corporis aut odio. Unde voluptatem ad ea quia non in. Voluptates possimus dolorem nemo error nemo.\n\nIusto architecto accusamus autem iure neque pariatur magnam quia. Neque distinctio incidunt numquam illo. Cupiditate voluptatem ut autem reiciendis cumque magnam repudiandae quas.\n\nEligendi dolor deleniti autem aspernatur aut. Repellat fuga qui et saepe eum id fugit. Qui temporibus commodi et error.\n\nNam libero voluptatem qui magni animi sunt. Ea magnam nihil repellendus asperiores nostrum dolor aut. Nihil molestiae illo perspiciatis dolores. Deleniti quas non facilis voluptas.', 3, 'blog_post', 'published', 'Est repellendus laborum recusandae explicabo assumenda omnis vero pariatur eveniet.', 'Sed est quidem incidunt. Et vel consequuntur mollitia possimus rerum et. Quia hic maxime magni eligendi.', 'https://via.placeholder.com/800x400.png/004466?text=text+vitae', '2025-05-14 23:02:19', '2024-06-25 07:00:52', '2024-11-11 17:19:53'),
(3, 'Ratione reprehenderit nihil tempore rerum dolore iure.', 'ratione-reprehenderit-nihil-tempore-rerum-dolore-iure-NQzfn', 'Tempore sed earum quas blanditiis. Modi praesentium facere reprehenderit sed quia. Accusantium voluptatibus quia voluptas qui beatae ab eos.\n\nAssumenda provident voluptates optio autem qui maxime occaecati. Nemo molestiae similique ab unde optio dolore consectetur. Pariatur dolores exercitationem quia voluptatem occaecati tempore et expedita.\n\nUt accusantium voluptas enim aut nihil ratione illum. Impedit quasi qui sint.\n\nOdio numquam velit cum incidunt eligendi. Cum sequi voluptates accusantium quis. Hic autem voluptate necessitatibus et ea labore.\n\nEst neque est perspiciatis mollitia dolorem alias sunt enim. Nihil dolorum et molestiae dolores totam.', 11, 'page', 'published', 'Accusamus cupiditate qui rerum aut molestiae fugiat.', 'Dolores maxime aliquid assumenda molestiae non doloribus laborum voluptatem. Ullam amet possimus eligendi accusamus unde. Cumque ipsam delectus eligendi qui occaecati recusandae iste.', NULL, '2024-06-22 14:59:29', '2025-04-11 00:47:23', '2024-12-07 18:55:07'),
(4, 'Omnis accusamus fuga voluptatem explicabo in unde.', 'omnis-accusamus-fuga-voluptatem-explicabo-in-unde-Irl4s', 'Quam ut possimus facilis. Qui aut distinctio et modi veritatis modi qui. Rerum qui saepe at ullam ratione rerum officia.\n\nNobis asperiores quis incidunt officia. Autem maiores et esse repudiandae omnis fuga fuga. Ipsa maxime accusamus reiciendis nostrum ad. Numquam temporibus est autem at iste iure tempore.\n\nBlanditiis veniam voluptates corporis explicabo. Et rerum accusantium unde perferendis est.\n\nQuos architecto necessitatibus voluptate aut in. Sit vero harum saepe totam voluptas voluptate excepturi. Quia suscipit vel mollitia asperiores nesciunt. Iste reiciendis praesentium et velit veniam.\n\nEt et earum quia. Perferendis qui quos id omnis. Officia tenetur recusandae labore aperiam.', 4, 'blog_post', 'published', 'Consequatur architecto consequatur quidem qui dolore ullam molestiae ipsa porro.', 'Nobis iusto soluta ut laborum dicta sint ad. Possimus voluptas ex suscipit voluptatem debitis nostrum nihil ab.', 'https://via.placeholder.com/800x400.png/0044aa?text=text+consequuntur', '2024-09-17 11:22:26', '2024-08-05 19:52:02', '2024-07-30 15:25:27'),
(5, 'Officiis corporis nemo et qui est laudantium debitis.', 'officiis-corporis-nemo-et-qui-est-laudantium-debitis-KLtYj', 'Velit vel asperiores expedita enim cupiditate. Voluptas et laborum ipsam esse neque aspernatur. Dolorum enim rerum quia.\n\nReiciendis deleniti non accusamus praesentium ea cumque. Hic id placeat consequuntur incidunt quo voluptatem. Architecto ipsa quisquam cumque reiciendis hic dolor est adipisci.\n\nArchitecto qui aut hic eos. Inventore architecto nam nam sequi voluptate enim iusto. Nobis quis facilis harum quibusdam beatae velit.\n\nIllo error facilis qui repellendus aspernatur. Est officia velit eos. Beatae ad impedit eaque occaecati.\n\nExercitationem quia similique est distinctio rerum aut. Rerum vero est quis tempora dolorem non officiis consectetur. Dolores odio saepe laudantium officia.', 11, 'page', 'draft', 'Et quis exercitationem voluptatem expedita.', 'Labore eos vel eos cupiditate suscipit sunt. Blanditiis asperiores blanditiis odio dolor.', NULL, NULL, '2024-07-03 10:20:06', '2025-03-14 07:47:37'),
(6, 'Porro voluptatum quibusdam expedita reprehenderit sed ratione.', 'porro-voluptatum-quibusdam-expedita-reprehenderit-sed-ratione-TiuFM', 'Fugiat assumenda dolores quia et. Quia praesentium earum sapiente eligendi neque. At voluptatem quam et excepturi.\n\nAut ut molestiae maxime suscipit molestias dolores. Laudantium cum minima perspiciatis quia. Ducimus labore veniam voluptate recusandae. Perferendis cumque aut et quisquam eos quam.\n\nHic recusandae at natus voluptas recusandae. Iste placeat sunt et enim sint. Natus dolore voluptatem omnis omnis sunt. Labore qui qui est eius. Corrupti qui aut quos hic velit.\n\nLibero molestias dignissimos incidunt doloremque iste. A id est itaque reprehenderit explicabo dolorem quasi. Aut harum dignissimos architecto omnis mollitia voluptatem.\n\nSit voluptates sequi reprehenderit est cum veniam quisquam beatae. Possimus explicabo et earum et reprehenderit ipsa molestiae. Aliquam reprehenderit velit quis nostrum et voluptatem.', 4, 'blog_post', 'draft', 'Sed animi exercitationem cupiditate ut.', NULL, 'https://via.placeholder.com/800x400.png/00bb11?text=text+dicta', NULL, '2024-12-09 12:19:24', '2025-03-28 08:24:02'),
(7, 'Omnis unde fugit aut.', 'omnis-unde-fugit-aut-ifb8D', 'Provident ab est aliquid. Et voluptatem maiores dolores et. Facere totam et expedita consequatur consectetur sed. Sint culpa nam aut molestiae delectus autem qui.\n\nSequi qui ex atque quo pariatur est. Itaque sapiente rem et optio odit vero tenetur. Laudantium et reprehenderit alias et qui dignissimos suscipit. Quis similique voluptatem sequi laudantium ut suscipit et optio. Voluptas sapiente est quam quae iste.\n\nVoluptatem impedit similique commodi aut omnis similique magni. At laboriosam voluptates quis eveniet. Blanditiis aliquam aliquam delectus laborum beatae. Sed et culpa quo est ut sed quidem.\n\nEt harum rerum sint ut voluptas non dolore. Debitis iure error corrupti consequatur est eum. Aliquid quisquam aut id possimus ut.\n\nDeleniti magnam enim id eum est ut qui omnis. Quo in nihil nemo et neque fugiat voluptatem. Et autem consequatur qui fugiat sint omnis.', 1, 'blog_post', 'draft', NULL, 'Qui ut ex minus aut sit laboriosam suscipit vero. Cum voluptates nihil impedit consequatur deleniti dolorum. Rerum et est voluptatem qui.', NULL, NULL, '2024-06-14 07:00:46', '2024-06-08 10:07:04'),
(8, 'At vitae fugit minus iure consequuntur.', 'at-vitae-fugit-minus-iure-consequuntur-AAJUf', 'Sequi aliquam necessitatibus perferendis eaque est aut provident. Voluptatem voluptatem nam dicta numquam non dignissimos in. Repellat nisi labore reiciendis ullam amet. Mollitia eligendi quibusdam fugit doloribus.\n\nVelit aut eligendi qui et ut. Exercitationem illo est ullam modi. Adipisci quibusdam ex facere ratione dolores et. Nulla accusantium et reiciendis iste odio iusto.\n\nEum minima vero commodi tempore nihil non. Amet facilis ea officiis at facere aspernatur temporibus. Sapiente quaerat at sit dicta ea unde.\n\nHic quas est aut eum. Et ut voluptatem minus magni consectetur qui delectus. Quis saepe et nemo animi odio.\n\nNostrum id maxime dolorem dicta. Esse at in sequi qui et ex deleniti et. Nostrum qui facere iure.', 1, 'page', 'draft', 'Doloribus laudantium rerum autem optio itaque omnis dolores.', 'Voluptas doloremque voluptatem voluptate alias. Cum tenetur voluptatem odio.', NULL, NULL, '2024-12-19 19:29:13', '2025-05-05 11:47:11'),
(9, 'Ut praesentium corrupti dolor voluptas.', 'ut-praesentium-corrupti-dolor-voluptas-nExVX', 'Neque fugit corrupti nulla sit ut quis. Et asperiores sequi ratione quo vel voluptate repellat.\n\nOmnis quis dolor iusto autem omnis. Modi qui est consequuntur. Veritatis et quia exercitationem sequi sunt. Et ducimus unde dicta cupiditate ab eveniet.\n\nNumquam quaerat qui dignissimos assumenda laborum repudiandae voluptate. Omnis earum asperiores nisi. Eum vitae quos expedita.\n\nCulpa impedit nihil et provident quos. Voluptatum temporibus officiis adipisci laborum totam tenetur id. Mollitia qui id nostrum velit soluta. Dolor quo quia tempora maiores occaecati rem fuga.\n\nA repellat sit ad. Est autem consequatur non blanditiis. Voluptas ipsum nam maiores aut voluptas voluptas voluptas. Iste rerum ea fugiat. Et expedita voluptates omnis id.', 3, 'blog_post', 'published', 'Libero deserunt veniam nulla velit animi tenetur quis et.', 'Omnis eos quisquam dignissimos sapiente optio sint. Sequi distinctio est rerum a. Voluptas facilis suscipit aut tempore rerum laudantium reiciendis.', NULL, '2024-07-07 00:18:49', '2025-05-30 12:49:29', '2024-10-11 02:26:27'),
(10, 'Consequuntur deserunt est quia iste.', 'consequuntur-deserunt-est-quia-iste-35Rx0', 'Velit eligendi odit architecto repellendus. Atque nesciunt provident laborum placeat voluptas aliquid. Rem rerum aut sit voluptas dignissimos beatae officia. Perferendis voluptatem quis sunt ratione laborum id.\n\nNecessitatibus quia voluptatem est assumenda labore aut aspernatur. Atque itaque consequatur maxime quisquam. Et atque quis aperiam autem. Quidem et occaecati expedita quisquam blanditiis cumque sit.\n\nOmnis nam ratione qui dignissimos molestias. Voluptatem totam est assumenda eos. Officiis non dicta voluptates et nulla. Nulla ut rerum voluptatem maxime cupiditate quod voluptatem.\n\nAlias qui sapiente tempore et voluptas ea. Quia dolore quaerat ullam praesentium voluptas est ut. Facilis ipsum quis et voluptate et ea. Ipsa sunt consequatur ut ut cumque voluptate.\n\nVel reiciendis vero maiores est. Necessitatibus id qui pariatur odit culpa maxime sint. Inventore amet commodi iure laborum sed. Ad perspiciatis illum in quos est corrupti laudantium accusantium.', 5, 'page', 'published', 'Accusamus delectus itaque quo quae iusto fugit dolorem enim.', 'At ut qui ut sunt aliquam. Labore aut ut repellat vel qui excepturi ut.', NULL, '2025-04-30 04:32:45', '2025-01-14 02:53:19', '2024-11-08 08:26:02'),
(11, 'Optio fuga ea aut eos qui.', 'optio-fuga-ea-aut-eos-qui-maNau', 'Voluptatum natus iure unde nemo veritatis. Iste ut aliquid molestiae assumenda accusantium cum enim. Architecto eligendi quas ut.\n\nReprehenderit inventore distinctio deserunt magni numquam. Fuga porro voluptatum et modi cumque qui.\n\nMollitia atque sequi nesciunt nesciunt laborum autem earum. Omnis perspiciatis alias assumenda qui et dignissimos alias ratione. Voluptatem necessitatibus velit blanditiis tempore.\n\nUt sunt natus quia et ea cupiditate. A dolore distinctio fugiat aut et dignissimos aut laudantium. Fuga pariatur accusamus deserunt aut. Ut unde aliquam consequuntur qui quod dolores.\n\nEst dolores laudantium maiores est est. Eum ducimus eius omnis voluptatibus similique qui provident. Vitae voluptas ducimus quo id nesciunt. Dolor dolor voluptatibus in vero consequuntur corporis alias blanditiis. Quis commodi nisi a.', 5, 'page', 'draft', NULL, NULL, NULL, NULL, '2024-12-26 07:01:00', '2024-09-13 16:48:40'),
(12, 'Sequi sint et dolores.', 'sequi-sint-et-dolores-dwYV4', 'Quam facilis sed impedit nisi. Aut qui voluptatem molestiae quisquam non necessitatibus cupiditate. Adipisci deserunt ab dolor accusamus totam.\n\nEt voluptas nihil voluptatem. Omnis reprehenderit enim eligendi. Quas illum adipisci veniam aut.\n\nEarum quisquam unde ut odit et. Minus maiores aliquam libero repellendus. Eum veniam dolor recusandae fugiat eos iusto.\n\nSed voluptatem veniam repellat architecto. Assumenda sunt distinctio soluta occaecati dolores nisi aut suscipit. Possimus dolores eos debitis molestias dolores. Est dolorem in minus quos eum consectetur.\n\nDistinctio architecto voluptatem aut necessitatibus illum voluptatum. Cupiditate omnis tempore quas officiis soluta. Rerum consequatur distinctio quibusdam aut cum repudiandae. Qui asperiores asperiores possimus id sit expedita.', 7, 'blog_post', 'published', 'Qui et illum expedita veniam repellat qui veritatis.', 'Adipisci animi similique recusandae molestiae dolores. Quis consequatur velit id error et repellat.', 'https://via.placeholder.com/800x400.png/0011aa?text=text+quia', '2024-07-15 11:57:00', '2024-06-04 16:54:37', '2024-10-08 00:27:01'),
(13, 'Voluptatem exercitationem sint repellendus nihil.', 'voluptatem-exercitationem-sint-repellendus-nihil-LvEi8', 'Omnis non voluptatem nobis tempora animi veritatis nam est. Quae qui aliquid odit nemo laboriosam ipsa similique. Vitae dolores minima saepe id est harum temporibus. Corrupti asperiores aliquid earum voluptatem eum.\n\nAut omnis veniam sunt earum itaque illo. Sunt animi numquam est totam. Repellat deleniti qui molestiae sit dolorem veniam dolor.\n\nEst fugiat vel et dolores quos. Modi unde qui non aliquam sed dolorem. At rerum autem ipsum odio qui ut.\n\nRepudiandae in quaerat necessitatibus doloribus. Dolores quis saepe impedit tempore labore ipsum. Alias aliquam impedit et fugit sit quia iure. Iste et voluptas itaque explicabo laboriosam.\n\nQuam porro voluptatibus dolores minus dicta. Quis doloribus provident et alias illum. Eos at nihil fuga ab.', 7, 'blog_post', 'published', 'Praesentium omnis debitis id est labore et.', 'Molestias in animi minus natus eum. Odio assumenda expedita in ut nihil quia ipsa.', 'https://via.placeholder.com/800x400.png/003377?text=text+veritatis', '2025-04-25 12:59:15', '2025-04-09 23:07:39', '2025-06-01 21:21:16'),
(14, 'Est occaecati est sequi tempore similique nemo.', 'est-occaecati-est-sequi-tempore-similique-nemo-4XoNp', 'Eius illum praesentium nihil esse velit distinctio qui. Ea consequatur quis adipisci et qui nobis vel beatae.\n\nLibero est ad est dolores rerum omnis tempora. Voluptas et enim nam quibusdam quos ut. Illo laborum recusandae vitae sunt ut quisquam. Id enim quam sed consequatur iusto eligendi beatae.\n\nAspernatur dolores quia fugiat cupiditate vero nihil. Quasi adipisci omnis natus exercitationem.\n\nTempore qui quia consequatur eos eveniet mollitia. Totam et et voluptatum facilis saepe.\n\nIn error magnam aut libero et ea. Quia voluptas ut debitis. Doloribus occaecati et eveniet sed at. Rerum eligendi distinctio voluptatem voluptatem dignissimos animi.', NULL, 'blog_post', 'draft', 'Assumenda natus sunt totam accusamus facere.', 'Quae doloremque voluptates tenetur velit voluptatem. Velit repellendus architecto qui praesentium.', NULL, NULL, '2025-05-27 17:38:31', '2025-02-25 05:17:49'),
(15, 'Accusantium quis magnam sed odit aperiam.', 'accusantium-quis-magnam-sed-odit-aperiam-l4GIF', 'Alias neque aut ex omnis beatae est eos. Repellendus numquam et neque officiis qui exercitationem rem. Consequuntur et eos in. Sed qui dolorum nihil quia quae labore velit.\n\nRecusandae veritatis aut modi sequi fugit recusandae dolores. Dolor qui sit est neque illo debitis. Sunt laboriosam quia dolorem corrupti quia alias ducimus.\n\nVelit commodi in omnis nostrum labore quia ut. In aut optio et qui ut. Repellat tempore reiciendis sunt nihil occaecati necessitatibus rem.\n\nMagni consectetur cumque atque sint sed voluptatem. Omnis rem aut aliquid ut. Exercitationem itaque quo distinctio iste earum esse cupiditate.\n\nEligendi fugiat esse qui odio. Saepe aspernatur recusandae itaque id. Qui sunt natus asperiores ad perspiciatis. Voluptas aliquid consequatur veritatis illo et rerum dolores. Voluptatem officiis consectetur id et eius hic.', 8, 'blog_post', 'published', 'Eveniet dolores ea mollitia pariatur consequatur hic.', 'Similique aliquid iusto voluptatem et eaque animi itaque labore. Soluta ut sequi laudantium autem facilis eum sit inventore.', 'https://via.placeholder.com/800x400.png/00aa55?text=text+aut', '2024-08-21 20:59:37', '2024-12-02 00:58:57', '2024-07-18 17:39:32');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `instructions` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `code`, `description`, `instructions`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'VNPay', 'vnpay', 'Deserunt a quia sed autem modi ut perferendis.', 'Eius placeat magnam blanditiis quasi aspernatur. Corporis totam deleniti rerum assumenda doloribus velit eum. Nihil perspiciatis sit quia laboriosam aut deleniti. Dolor sed quidem corporis aut culpa qui odio et.', 1, '2024-09-29 18:46:18', '2025-05-26 10:11:23'),
(2, 'Bank Transfer', 'bank_transfer', 'Tempore laudantium vel fugiat cum reprehenderit quo aut.', NULL, 1, '2024-10-04 19:33:07', '2024-08-09 06:44:44'),
(3, 'Cash On Delivery', 'cash_on_delivery', 'Odit amet laboriosam cum voluptates.', 'Delectus quia deserunt dignissimos voluptatem ut. Vel aut et voluptatem atque dolor. Nulla nisi minus sapiente consectetur nostrum. Est dolor nostrum architecto sequi sed libero.', 0, '2024-10-01 11:27:01', '2025-04-14 20:23:49'),
(4, 'Credit Card', 'credit_card', 'Quas enim fuga facere laborum et aut commodi.', 'Provident culpa optio ex placeat itaque. In mollitia provident optio. Velit deserunt quis ratione quis suscipit enim nisi.', 1, '2025-03-31 01:10:44', '2024-07-18 08:20:43'),
(5, 'ZaloPay', 'zalopay', 'Natus eius ut enim hic illo.', 'Eos rerum sunt itaque ut. Porro voluptates in consequatur corporis. Repellendus sapiente dignissimos repudiandae eum necessitatibus rerum. Asperiores alias corrupti amet sed sit.', 1, '2024-08-08 23:54:43', '2025-05-26 01:33:18');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `regular_price` decimal(15,2) NOT NULL,
  `stock_quantity` int UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('published','draft','archived','out_of_stock') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `view_count` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `short_description`, `description`, `regular_price`, `stock_quantity`, `category_id`, `brand_id`, `status`, `is_featured`, `view_count`, `created_at`, `updated_at`) VALUES
(1, 'minima dolor neque Chair', 'minima-dolor-neque-chair-bxABh', 'Dolorum ea laudantium non esse voluptatem autem.', 'Rerum voluptate qui voluptatem molestiae. Nemo dolorum ducimus impedit veniam voluptatibus itaque voluptas. Quaerat aliquid delectus corrupti eum ab.\n\nQuo magni voluptatibus et vero vel. Maxime temporibus quaerat quasi dolorem. Non qui quia at autem. Pariatur occaecati iusto atque.\n\nQuaerat provident voluptates vero rerum. Deleniti dolores aut eius dignissimos voluptate. Provident voluptatibus esse similique excepturi libero quidem est ratione. Ut rem corporis dolorem officia omnis quas.', '504.08', 68, 3, 3, 'draft', 0, 5093, '2025-02-10 21:36:26', '2024-06-10 13:08:20'),
(2, 'velit est est Table', 'velit-est-est-table-sNFIy', 'Veritatis accusantium iste rerum blanditiis in quasi autem dolor possimus.', 'Sit est sit est temporibus itaque saepe. Distinctio recusandae laboriosam ex magnam suscipit odit. Blanditiis molestias eaque quibusdam sed perspiciatis. Et placeat voluptatum dolore sed totam et aspernatur.\n\nEt id esse nobis qui vel qui. Autem recusandae dolorem doloribus aut sint voluptates nihil minima. Tempora expedita debitis id illo enim sint corrupti.\n\nDelectus et soluta ut molestias. Ea eos ab natus blanditiis. Dolor ab cum et eos quo cumque illum. A sequi autem neque cumque natus sunt.', '3538.51', 161, 3, 3, 'archived', 1, 1989, '2024-11-05 19:37:41', '2024-11-27 03:09:24'),
(3, 'doloremque nostrum aliquam Chair', 'doloremque-nostrum-aliquam-chair-jvuvC', 'Illum enim inventore ipsam aspernatur id vero dolor voluptate ratione temporibus ut expedita nobis.', 'Sed sit sunt non repellendus. Reiciendis temporibus aut dicta nesciunt consectetur quod. Et et itaque sint hic accusantium. Ducimus doloribus at autem eum voluptate.\n\nEt sed perferendis quam non. Maxime consequuntur voluptatem eum incidunt harum cumque aperiam voluptatum. Asperiores aspernatur et qui in perspiciatis ipsam impedit. Rem eum expedita sequi sit est aspernatur aut.\n\nAspernatur dolores illo dignissimos provident. Deserunt sint aut eum exercitationem est eius nemo velit. Repellendus ab sed dolorem aut nostrum et eius.', '1614.63', 42, 3, 3, 'draft', 1, 708, '2024-09-03 18:33:40', '2024-06-23 13:44:50'),
(4, 'aliquam consectetur consequatur Chair', 'aliquam-consectetur-consequatur-chair-93zZM', 'Voluptatibus fugiat ipsa impedit consequatur quod repellat voluptas.', 'Consequatur earum alias excepturi. Vitae qui dolores sunt eaque nemo veniam. Ut sint harum saepe. Qui ab reprehenderit natus cupiditate quibusdam sint accusantium.\n\nLaudantium vitae consequatur consequatur non. Delectus qui est dolores quia et. Quas laboriosam nemo ullam ut est.\n\nNon illum eveniet quasi sit molestiae perspiciatis. Quas deleniti enim error nisi assumenda voluptatem debitis. Qui deserunt ipsa consequatur minima consequatur amet quo.', '3563.18', 195, 3, 3, 'out_of_stock', 1, 1148, '2025-01-02 13:03:08', '2024-09-17 15:47:06'),
(5, 'aut suscipit distinctio Table', 'aut-suscipit-distinctio-table-1LXPo', 'Et quis sint et est sequi atque et tempora qui maiores.', 'Enim aperiam eius voluptatibus vel omnis eos. Sit sed facere tenetur debitis ipsum ad et id. Veniam alias ea id repudiandae qui rerum. Cum ducimus et eos vel reiciendis saepe voluptatem. Fuga sit ut aliquam quis et quaerat.\n\nEt beatae modi consequatur tempore est perspiciatis. Quibusdam laboriosam quisquam odit aut unde. Est velit quo consequuntur quam blanditiis. Explicabo quae praesentium reiciendis perspiciatis facilis ab.\n\nConsectetur fugit tempore assumenda qui aut voluptatum. Hic quia dolores dolore eum. Rerum sint officiis rerum non.', '4537.86', 35, 3, 3, 'published', 0, 7929, '2024-11-29 14:55:32', '2024-06-19 15:30:46'),
(6, 'et repudiandae ad Bed', 'et-repudiandae-ad-bed-N6wXO', 'Quisquam qui quia vitae est porro dolorem dolore deleniti cupiditate qui saepe.', 'Iste aspernatur placeat ea et natus. Natus occaecati sit deserunt rem facere dolorem. Aliquam eum assumenda debitis nam.\n\nDeserunt non et architecto quisquam id. Vero nesciunt iusto laborum autem quia nostrum dolorem. Nam porro omnis nihil molestiae dolor.\n\nTempore soluta cumque est sint enim reprehenderit rerum. Eveniet et labore tempore. Laborum quia qui eveniet ullam ipsa et reiciendis et. Voluptatem ipsa sed illum ut.', '4601.99', 151, 3, 3, 'out_of_stock', 0, 8074, '2025-03-16 05:15:51', '2024-06-10 03:08:59'),
(7, 'ut tempora totam Cabinet', 'ut-tempora-totam-cabinet-ugBxl', 'Voluptatem debitis reprehenderit quisquam et ipsa molestias.', 'Iure qui quidem iure earum error. Porro a natus voluptas fugit adipisci accusamus. Expedita voluptatum animi voluptas quia natus cupiditate rem. Architecto autem et repellat ullam quae.\n\nArchitecto quidem quasi nam ea autem et. Veritatis repudiandae reiciendis animi eum modi facere quisquam. Expedita occaecati praesentium quos eveniet omnis. Adipisci ullam eius aut sit praesentium.\n\nPlaceat commodi reprehenderit qui quae nisi asperiores. Dolores ad recusandae repellat in et perspiciatis consequuntur ullam. Perspiciatis aperiam et dicta expedita aut quod.', '3989.19', 106, 3, 3, 'archived', 0, 7791, '2025-03-28 12:37:51', '2024-06-09 13:12:09'),
(8, 'quaerat corporis autem Bed', 'quaerat-corporis-autem-bed-5KaTY', 'Perspiciatis harum enim iure ut animi voluptatem sit repudiandae nesciunt ab aut.', 'Eius ratione aut et aut sed amet voluptatibus. Et in velit est non esse. Enim corporis reprehenderit aliquam sint omnis quis quia. Praesentium voluptas accusamus voluptatum non dolores voluptatem vero.\n\nSed soluta molestiae non quam quae. Sed recusandae accusamus aut ducimus in iste omnis. Ea autem nisi quidem possimus neque omnis. Quae nobis expedita voluptatem in.\n\nOfficiis quasi error placeat modi accusamus tempora ratione. Reprehenderit expedita aut neque quas nihil iste porro nesciunt. Voluptatem est minima voluptate ut facere. Velit quo esse rem qui et nisi.', '207.21', 59, 3, 3, 'draft', 0, 6104, '2024-07-01 01:33:09', '2024-11-11 16:22:43'),
(9, 'et dolorem exercitationem Sofa', 'et-dolorem-exercitationem-sofa-aAKAq', 'Quia ea provident sint dolor vel praesentium nulla.', 'Deserunt doloremque quaerat porro libero voluptatem qui et. Explicabo excepturi atque est rem dolorum. Quasi nulla earum rerum voluptatem. Vel sequi possimus laboriosam recusandae.\n\nError consequatur accusantium provident voluptas itaque id eius. Et unde et ullam ipsum rerum minus. Molestiae voluptas est sit quisquam. Doloremque hic voluptatem eius.\n\nQuo quam omnis placeat amet sit voluptatem aliquid molestias. Consectetur enim odit tenetur repellendus quidem velit. Esse eos consequatur eum eveniet eveniet expedita. Provident dicta odio eum.', '2927.24', 152, 3, 3, 'out_of_stock', 0, 9894, '2025-06-01 19:03:25', '2024-12-24 18:48:34'),
(10, 'aut blanditiis sed Sofa', 'aut-blanditiis-sed-sofa-FZgM6', 'Perspiciatis aut autem est et beatae quasi hic eum dolorem dicta adipisci sunt corrupti.', 'Suscipit quaerat cum beatae ratione est ut. Numquam aut ex incidunt error. Dolores consequuntur inventore velit dolores doloremque impedit.\n\nAnimi eveniet qui sint aut sint et error. Perferendis dolores vel aspernatur quam. Deleniti debitis exercitationem sit ut omnis reprehenderit. A nemo dicta ad minus.\n\nLaudantium consectetur beatae tenetur unde similique et. Rerum quam quasi sed quidem. Voluptas iure maxime eligendi perferendis ut quod aut.', '3378.00', 39, 3, 3, 'draft', 0, 3991, '2025-05-26 20:47:10', '2024-07-12 01:56:37'),
(11, 'cum dicta iusto Bed', 'cum-dicta-iusto-bed-hppUR', 'Accusamus velit distinctio quia corrupti sed quia.', 'Doloribus quia eum quia minima quibusdam qui. Molestias et cumque voluptas fugiat ea qui. Alias velit nisi ducimus est quos dolor quas. Aut porro ex vero et qui.\n\nMaxime illo nemo laudantium distinctio atque. Voluptatum et ipsa sunt. Impedit rerum aut non eos libero beatae quia. Vel autem nam perferendis.\n\nVoluptatem pariatur voluptates adipisci dolor voluptas soluta minima nostrum. Corrupti unde commodi consequatur. Eos non atque quo molestias.', '2634.88', 109, 3, 3, 'published', 0, 5197, '2024-10-23 00:44:04', '2024-11-01 09:17:52'),
(12, 'voluptas minima molestiae Bed', 'voluptas-minima-molestiae-bed-2Hhbf', 'Ut quia sit est sunt qui dolores ratione.', 'Et ullam ut debitis consectetur porro voluptate aliquid. Est soluta amet laborum ut occaecati neque. Ut animi nostrum aliquid quas voluptatem officiis iure error. Iste quo ut vero dolor.\n\nAtque quam iste odio libero. Assumenda tempora voluptas doloribus adipisci fuga et occaecati. Sapiente non et est odit et repudiandae. Provident atque veniam cumque sunt.\n\nAperiam commodi hic placeat velit quo. A atque et molestias fugit nihil molestiae. Itaque voluptatem voluptas eaque impedit.', '3593.38', 155, 3, 3, 'draft', 0, 3895, '2025-02-24 22:35:52', '2024-06-12 00:57:52'),
(13, 'est dolorem odio Chair', 'est-dolorem-odio-chair-Zb0Xk', 'Occaecati esse minima velit nam accusamus ut officiis quo vero qui illum ea quas.', 'Eum non rem cum velit sequi ipsa. Omnis nam rerum quos voluptas. Voluptatibus nulla ab aut quae et maxime ea.\n\nRepellendus sapiente ut ex cum earum. Vero mollitia autem et eaque. Est enim officiis vero nemo.\n\nEveniet sint iusto nisi neque sed itaque ipsa quam. Veniam incidunt est et est sed itaque. Modi consequatur odio sed saepe inventore adipisci in. Ea minima ipsum aspernatur officia et ipsam neque.', '4879.34', 46, 3, 3, 'out_of_stock', 0, 8059, '2024-10-16 02:06:15', '2025-03-26 16:42:38'),
(14, 'inventore aspernatur aut Bed', 'inventore-aspernatur-aut-bed-B4fHi', 'Non voluptas amet facilis et ab qui veritatis quia.', 'Omnis facilis rerum ullam blanditiis. Quia dignissimos inventore ipsa repudiandae neque sint ad quis. Aut nihil blanditiis et.\n\nCorporis illum modi quam non. Aut quisquam enim deleniti velit hic maxime corporis. Architecto non est nostrum ipsa exercitationem quia voluptatem. Nostrum quaerat fuga illum consequatur voluptate eaque dolor fugiat.\n\nFuga voluptatum consequatur porro doloremque. Et sed est tenetur qui. Ratione nostrum facilis dolorem et quibusdam doloremque sit doloribus.', '2223.98', 0, 3, 3, 'draft', 0, 2416, '2024-12-12 18:05:28', '2025-03-14 07:44:38'),
(15, 'magni autem dolor Bed', 'magni-autem-dolor-bed-hDVHO', 'Rerum qui provident sint itaque voluptas ipsa est omnis.', 'Officiis praesentium illum dignissimos officiis corporis vero. Itaque corrupti necessitatibus voluptate sint facere minus quos fugit. Velit repellat voluptas incidunt repellendus eveniet.\n\nEx quae voluptas omnis aperiam eum natus est. Ad recusandae eos aut officiis magnam. Enim natus aspernatur sit corporis pariatur explicabo. Odit aut totam iusto vitae illum ex.\n\nUllam quo sed quas sequi distinctio rem in. Vel commodi voluptate et et consectetur. Dignissimos illum est impedit illum quis aut deserunt. Fugit dolorum libero inventore.', '1424.77', 69, 3, 3, 'draft', 1, 8910, '2024-06-21 03:55:42', '2024-07-28 16:36:31'),
(16, 'quam necessitatibus fuga Sofa', 'quam-necessitatibus-fuga-sofa-SPSUR', 'Maxime eveniet autem nihil cupiditate et ipsam ducimus.', 'Voluptatem beatae enim occaecati placeat sed vitae ex. Soluta reprehenderit harum et ipsam rerum occaecati quibusdam officia. Voluptas voluptatem repudiandae excepturi provident.\n\nModi exercitationem tempore enim quas ab. Vero et inventore vel. Atque autem fuga inventore excepturi. Vitae est consequatur quo ipsum non rerum.\n\nSimilique corrupti sit porro enim ullam. Voluptatem dolores deserunt nam voluptatem numquam iure veniam. Earum voluptatum ratione nemo. Odit quas et suscipit illo rerum.', '4279.76', 167, 3, 3, 'archived', 1, 2847, '2024-11-06 00:07:03', '2024-09-08 23:29:22'),
(17, 'enim iusto laboriosam Table', 'enim-iusto-laboriosam-table-pz0Ev', 'Omnis maxime expedita corrupti et at dolores iure facere provident ducimus.', 'Ut omnis sit et odio aut qui. Ullam adipisci ad facere a error vel a.\n\nVoluptas est repellat aut quis. Eum voluptate recusandae odio quisquam natus. Sequi maxime dolores voluptatum maxime.\n\nAut eum assumenda ut magnam molestias. Nihil sint molestiae occaecati quaerat officiis quibusdam. Quis consequatur repudiandae vel cum eos voluptas.', '4892.36', 27, 3, 3, 'out_of_stock', 0, 4704, '2025-03-16 00:05:03', '2025-05-15 22:26:47'),
(18, 'natus et adipisci Cabinet', 'natus-et-adipisci-cabinet-mMefS', 'Vero tenetur molestiae omnis rerum eveniet sed omnis.', 'Nihil saepe beatae sit itaque voluptatem et unde. Commodi deserunt quas doloremque ut officia sint. Blanditiis id blanditiis eum deserunt. Quasi aliquid quod voluptates est nisi.\n\nAut nihil accusantium adipisci nihil ab sint recusandae. Veritatis assumenda culpa quasi modi consequatur. Architecto est modi molestiae nihil amet.\n\nIllum et aliquid maxime in eos provident quia. Provident asperiores qui suscipit corporis animi illum nobis dolor. Et unde distinctio rerum sit quo perferendis qui sit. Libero non dolor saepe est saepe deleniti.', '4245.10', 87, 3, 3, 'archived', 0, 6330, '2025-05-29 07:11:43', '2025-01-31 10:15:33'),
(19, 'omnis eum repudiandae Cabinet', 'omnis-eum-repudiandae-cabinet-9ZlOv', 'Voluptatem dolore non et explicabo illum quisquam reiciendis ut voluptas architecto quas.', 'Qui sint aspernatur aut et aut eveniet. Id libero repudiandae nostrum sunt possimus ut recusandae consequuntur.\n\nId accusantium magni accusamus consequatur necessitatibus consequatur quo. Ut quaerat nostrum magni error nulla quibusdam ab ut.\n\nIste dolorem est dolorem magni. Ut et rerum temporibus nostrum. Temporibus odit quae voluptatem est.', '2299.34', 18, 3, 3, 'draft', 1, 790, '2024-11-25 11:48:49', '2025-04-19 09:34:41'),
(20, 'sed eum sint Bed', 'sed-eum-sint-bed-TYR1V', 'Totam nesciunt doloribus veniam reprehenderit neque error omnis perferendis quo voluptatem officiis et.', 'Et delectus neque a vel. Neque officiis odio ea amet recusandae nihil illo. Impedit officia blanditiis debitis nam ut voluptas sunt. Ut et qui ipsa corrupti doloremque.\n\nDolorum et optio eos dolorem qui veniam. Voluptatem excepturi nostrum error voluptatem. Maiores amet ipsam et eaque.\n\nDoloremque vel sint qui. Possimus velit molestias et sint velit voluptatem laboriosam. Voluptatem libero sit provident.', '3206.93', 5, 3, 3, 'published', 0, 6898, '2024-08-21 21:50:54', '2024-08-16 15:59:12'),
(21, 'a exercitationem quidem Chair', 'a-exercitationem-quidem-chair-VE96K', 'Enim numquam exercitationem sint optio laborum quis quasi dolores accusamus quaerat harum.', 'Rem exercitationem voluptatem ad modi ipsa. Nihil aut similique saepe aut. Veniam sed tenetur ullam voluptates quos praesentium. Id placeat delectus iste eos et perspiciatis est.\n\nReprehenderit atque quis id iusto illo. Rerum ullam quos laboriosam qui rerum enim numquam sed. Et animi voluptas aperiam perferendis quibusdam nam.\n\nEst aut possimus consectetur doloremque sed nisi. Veritatis dicta est enim expedita rem nemo nesciunt. Eveniet ab odit repellat officiis sunt. Necessitatibus error ipsam error quam inventore consequatur.', '4051.75', 112, 3, 3, 'out_of_stock', 1, 7900, '2024-06-25 06:06:09', '2024-12-10 04:01:30'),
(22, 'maiores ab dolores Sofa', 'maiores-ab-dolores-sofa-o7AxW', 'Et odio amet velit ut est beatae doloribus blanditiis.', 'Omnis in quisquam voluptatem magni. Et debitis similique quasi explicabo. Quia mollitia nihil occaecati qui ducimus doloribus repellendus.\n\nNeque quis est dicta laboriosam totam pariatur. Ea doloribus vel est reprehenderit. Ut asperiores quos tempora iste. Reiciendis autem beatae ex nostrum voluptatum.\n\nItaque quia aut veritatis expedita asperiores quis. Soluta quia pariatur non maiores maiores expedita. Quia delectus deleniti laborum id autem libero.', '3325.90', 200, 3, 3, 'draft', 1, 860, '2025-04-22 11:34:47', '2025-04-12 03:41:09'),
(23, 'culpa optio non Bed', 'culpa-optio-non-bed-FfnYj', 'Est vero autem dolor rerum sed cupiditate.', 'Eos aliquid et voluptate. Enim alias ea quo saepe totam sit. Est amet aut et nesciunt quia. Voluptatum perferendis neque enim impedit sapiente eaque iusto.\n\nRerum ut ipsum quia et. Enim animi consequatur fugit et. Itaque neque fugit expedita quae nostrum rerum pariatur. Deserunt nemo eius sed rerum quod vitae.\n\nEt incidunt enim eos doloremque nihil tempore pariatur. Suscipit sed perferendis occaecati ad voluptas.', '1000.91', 104, 3, 3, 'draft', 0, 3895, '2024-08-06 09:25:06', '2025-03-07 18:34:17'),
(24, 'perspiciatis sit et Cabinet', 'perspiciatis-sit-et-cabinet-gaOPM', 'Nesciunt ducimus facere odio eos veritatis vero deserunt hic qui.', 'Eum repudiandae natus iste sit et. Officia reiciendis pariatur a distinctio eligendi quos et aspernatur. Quam accusamus voluptatem qui ut.\n\nEt reiciendis laudantium id. Rerum fugit assumenda harum qui eius. Consequatur rem excepturi quia qui officia nobis rerum.\n\nSint maxime voluptatem repellendus voluptates quidem mollitia. Voluptatem numquam voluptatem laboriosam quisquam sed iste.', '1284.73', 54, 3, 3, 'out_of_stock', 0, 3241, '2024-07-18 14:59:21', '2024-06-16 06:11:02'),
(25, 'sed facilis repellendus Table', 'sed-facilis-repellendus-table-PzD2E', 'Et soluta voluptatem consequatur nesciunt id et.', 'Explicabo iusto quo qui necessitatibus enim adipisci enim sit. Inventore eos minima quia maxime aut tempore fuga.\n\nDoloremque aut odit ipsa itaque hic qui. Recusandae corrupti et autem corrupti molestiae aut et culpa. Quos assumenda dolorem voluptatem id quidem cum. Voluptatibus enim consequatur omnis doloribus aliquam dolorum.\n\nFuga ipsum aut beatae corrupti qui repellat. Possimus perspiciatis qui voluptatem iure tempore. Quibusdam temporibus eveniet delectus laboriosam natus.', '4304.51', 115, 3, 3, 'draft', 0, 5645, '2024-10-21 15:22:36', '2025-04-27 11:26:21'),
(26, 'ipsum distinctio illum Sofa', 'ipsum-distinctio-illum-sofa-N9WnR', 'Fugit dolor fuga quia illo recusandae minus omnis nostrum nihil.', 'Eaque soluta soluta dolore rem. Voluptatem dolorem iure sequi distinctio. Rerum optio soluta corporis aperiam soluta excepturi. Qui enim odio quo dolores excepturi. Aut possimus libero molestiae.\n\nDolorem expedita qui incidunt voluptatem. Officiis dolor odit dolore unde. Ab cumque qui aut cum delectus sed. Ipsa sed est omnis sed voluptas reprehenderit quae nostrum. Placeat voluptatem recusandae assumenda aut a.\n\nQuia consectetur aperiam aspernatur iste cupiditate excepturi. Necessitatibus rerum deleniti aut. Rerum earum inventore sed quia repudiandae non in.', '3012.67', 182, 3, 3, 'draft', 0, 5013, '2024-06-29 04:48:17', '2024-06-03 16:43:56'),
(27, 'vel ut ullam Table', 'vel-ut-ullam-table-LJaUA', 'Voluptas aliquid et et numquam enim facere illum ex.', 'Eum vero accusantium ipsam quisquam dignissimos. Velit esse voluptatem et qui omnis.\n\nRepellendus iste praesentium minima atque voluptatum necessitatibus cumque hic. Omnis praesentium nemo animi enim distinctio. Facilis quisquam architecto voluptate ea aspernatur qui est. Sed perferendis ea labore sapiente maxime.\n\nVoluptas distinctio perspiciatis quidem dicta dolore veniam sint molestiae. Facere quidem quis quis aut.', '2704.94', 19, 3, 3, 'published', 0, 1199, '2025-02-05 01:49:54', '2025-03-27 16:08:47'),
(28, 'itaque deleniti temporibus Table', 'itaque-deleniti-temporibus-table-o0n5h', 'Voluptatem dignissimos minima quis aut reprehenderit consequatur qui ab cumque aut unde esse enim.', 'Nobis saepe fuga nihil nobis adipisci quia sed nisi. Esse nemo et modi dolorem debitis error. Velit commodi id sit voluptas illum aut sit eum. Cupiditate reprehenderit at dicta fugiat odio dicta cum esse.\n\nProvident eos autem tempore consequatur. Possimus exercitationem tenetur quis ea velit. Est quia nihil quisquam voluptas et enim iusto.\n\nNon quo qui reprehenderit amet. Aut itaque laborum nemo et. Dolorum quisquam accusantium molestias quibusdam ratione facilis sint. Sit et est qui est sit dignissimos.', '3859.37', 138, 3, 3, 'archived', 1, 348, '2025-03-02 18:41:52', '2025-02-12 18:59:45'),
(29, 'aperiam velit sit Table', 'aperiam-velit-sit-table-jpyAc', 'Enim enim consequatur distinctio dolores omnis tempore.', 'Molestiae aut id occaecati et assumenda alias eaque. In nihil doloremque enim ad et consequatur minima. Inventore adipisci dolor quo in sunt qui. Temporibus quod quam molestiae.\n\nDignissimos est aut explicabo minima nam. Provident earum aliquid non doloremque et provident minus. Impedit voluptates ea aut perspiciatis quia in laboriosam.\n\nEt alias consequuntur tempora recusandae eum veniam aspernatur. Qui nobis mollitia adipisci laudantium voluptatem ad magni. Fuga eligendi qui sunt.', '2583.37', 87, 3, 3, 'archived', 0, 6369, '2025-01-15 08:53:45', '2025-05-10 01:43:11'),
(30, 'ratione asperiores magnam Bed', 'ratione-asperiores-magnam-bed-ycKhg', 'Accusantium laudantium deleniti laborum et et alias.', 'Reiciendis aspernatur tempora in saepe quia quia. Ipsa commodi ex exercitationem quo.\n\nNesciunt possimus ratione iure sint rerum. Omnis accusamus accusantium sed nihil voluptas dignissimos. Sint autem laudantium nihil quae et in. Et eveniet soluta earum consequatur accusamus.\n\nVoluptatem autem quo dolor et laborum voluptas. Ea possimus ut quos nam aut odio. Delectus sit saepe similique ut. Est sit voluptatem eaque qui nesciunt. Ab velit magni enim excepturi ea nisi.', '2082.15', 174, 3, 3, 'published', 0, 3376, '2024-06-26 04:02:12', '2024-12-19 13:21:38'),
(31, 'consectetur aut esse Cabinet', 'consectetur-aut-esse-cabinet-oqEgt', 'Repellendus quia enim mollitia consectetur laboriosam voluptatem quod praesentium pariatur.', 'Ex accusantium est explicabo ea doloremque quod nesciunt. Ut asperiores ipsum ipsa et quos. Temporibus laborum in reiciendis et maiores mollitia dolorem quasi.\n\nQuidem ipsum magni quibusdam voluptas quidem veritatis qui debitis. Optio voluptas eum et. Atque magnam dolor animi aperiam molestiae.\n\nAlias blanditiis ut porro sed architecto. Adipisci sequi dolores aut cumque et repellat.', '903.13', 10, 3, 3, 'out_of_stock', 0, 7433, '2024-09-22 17:06:43', '2024-10-20 23:35:37'),
(32, 'maiores voluptas eos Table', 'maiores-voluptas-eos-table-nkLOp', 'Accusantium praesentium aut et odio repellat ratione veritatis iure qui quisquam sapiente et.', 'Voluptatem accusamus doloribus rerum commodi non porro aut. Veniam exercitationem reprehenderit neque dolor non ipsa iusto dicta.\n\nCupiditate quasi cum corporis natus ab hic. Ut ex aliquam vero expedita excepturi. Ipsa fugiat illo necessitatibus perspiciatis. Ut non voluptatem sit labore.\n\nOptio perspiciatis quisquam corrupti perferendis et quia. Eaque qui et quasi saepe perferendis sequi. Quam quo id sunt quibusdam.', '2124.49', 0, 3, 3, 'published', 1, 8820, '2025-05-24 18:00:57', '2024-11-11 11:07:09'),
(33, 'est alias odio Bed', 'est-alias-odio-bed-BL5Ld', 'Dolore placeat ut explicabo et fugit rerum.', 'Eum delectus placeat consequatur aliquid. Voluptatem eos fuga fugiat unde dolores. Iste quae et ut dolor quo. Corporis quia quasi soluta dolorem quia nisi.\n\nQui consequatur molestias non iusto id aspernatur quo. Ut maxime perspiciatis sapiente esse. Dignissimos error deleniti accusamus quia sed quia. Consectetur vel sed aut blanditiis.\n\nDebitis eum ut saepe. Eos assumenda voluptatem qui magnam ut rerum.', '3752.76', 138, 3, 3, 'published', 0, 3147, '2025-04-30 13:49:18', '2024-11-24 21:29:44'),
(34, 'optio quo repudiandae Cabinet', 'optio-quo-repudiandae-cabinet-eF9tQ', 'Adipisci rerum voluptatem aperiam recusandae libero eaque voluptatem dolorum ea id.', 'Officiis aut error autem recusandae id iusto. Enim occaecati maiores nemo adipisci minima.\n\nCulpa sapiente sed architecto voluptatem dolorum. Perferendis blanditiis dolorem omnis neque quam. Qui consequatur necessitatibus dolorum explicabo in expedita excepturi molestiae.\n\nConsequatur sed dicta aperiam occaecati. Officiis quo et corrupti aut totam.', '1250.44', 81, 3, 3, 'archived', 1, 7127, '2025-03-14 10:52:09', '2025-02-04 10:53:46'),
(35, 'adipisci sint maxime Chair', 'adipisci-sint-maxime-chair-CgGxd', 'Impedit voluptates nihil perspiciatis sequi iure optio voluptatum inventore earum numquam laudantium delectus.', 'Rerum est dolorem enim soluta. Neque et nihil temporibus est nihil aut sunt. Itaque voluptas eaque pariatur vel dignissimos provident quia.\n\nVelit voluptatem adipisci itaque qui. Debitis esse dolor voluptate sunt. Aut quo natus aut itaque quo provident. Est quae excepturi quod in recusandae accusantium eum.\n\nCommodi voluptas ut sint accusamus ut suscipit veritatis sint. Corporis nobis sit deleniti molestiae. Corrupti sed qui cum est. Tenetur natus ipsam tempore voluptatem facilis aut sed.', '2225.35', 103, 3, 3, 'out_of_stock', 0, 8279, '2024-09-19 10:46:03', '2024-09-30 02:00:09'),
(36, 'ea nihil ipsa Cabinet', 'ea-nihil-ipsa-cabinet-yvljB', 'Maiores enim corrupti ratione et distinctio aut iste.', 'Dolores dolore et voluptas ipsa eos aut. Placeat voluptatem repellendus voluptatibus facilis ut dolores non. Omnis reprehenderit eum reprehenderit.\n\nOfficia quos vel deleniti consequatur consequuntur. Voluptatibus omnis voluptatem voluptatem voluptas quia sunt in. Repudiandae qui consequuntur vero consequuntur doloribus.\n\nEt ea enim quia. Dolore beatae quia ab corporis doloremque. Est sit illum magni minus. Omnis error nisi dolores eligendi.', '4163.11', 160, 3, 3, 'out_of_stock', 0, 4327, '2024-09-23 10:43:11', '2025-06-02 10:18:19'),
(37, 'voluptatem eaque autem Chair', 'voluptatem-eaque-autem-chair-n0skr', 'Aut esse maxime autem sit odit harum id voluptatum aliquid praesentium.', 'Ipsam iusto natus quia. Quo ipsam sint unde odio odit.\n\nQui quam inventore aperiam fugit recusandae. Eveniet aut nihil amet occaecati enim laudantium sapiente aut. Deserunt debitis aut et exercitationem id.\n\nEt voluptatem eos dolorem eum perspiciatis. Non sunt natus magni voluptatem animi et magni. Maxime qui ratione ut. Eum voluptas repellat ut consequatur.', '131.10', 82, 3, 3, 'published', 1, 1833, '2024-06-23 02:42:19', '2025-04-06 22:07:01'),
(38, 'repellat et rerum Table', 'repellat-et-rerum-table-kDqZc', 'Neque et debitis incidunt inventore veniam aliquam voluptatem quae.', 'In sit earum magnam velit quisquam reprehenderit non. Deleniti veritatis quo temporibus animi. Sunt consequatur cupiditate dolorem cupiditate eum nulla dolorem.\n\nMinus nemo quisquam sit enim occaecati quaerat sequi. Mollitia maxime explicabo molestiae atque est. Ea nulla repellat sunt. Rem maiores vitae nihil ipsa sit.\n\nMollitia qui quis qui soluta quam sed. Recusandae in saepe quasi quod pariatur quo. Quidem molestiae id ut ut reprehenderit voluptatem. Animi qui id repellat molestias et pariatur.', '3131.37', 92, 3, 3, 'out_of_stock', 0, 9593, '2025-05-26 09:09:33', '2024-10-05 06:58:19'),
(39, 'atque quia ipsa Table', 'atque-quia-ipsa-table-Uxusm', 'Quam nulla eius ipsum provident et autem.', 'Non nihil molestias sed veritatis voluptas praesentium. Perspiciatis provident eius debitis delectus laudantium et. Velit eius doloribus cumque facere iure omnis. Voluptatem iste debitis consequatur est omnis quibusdam sint.\n\nPorro numquam ratione cupiditate quis nostrum voluptas officiis. Accusantium voluptatem perspiciatis velit optio id. Voluptas dicta molestias repellat mollitia perferendis dolorem. Rerum aut vel ad repellendus voluptatem.\n\nMaiores maxime illum veritatis accusantium ea. Ut est ut est qui vero nostrum cumque voluptatem. Molestiae voluptas quasi officia et animi autem.', '904.08', 18, 3, 3, 'out_of_stock', 1, 3844, '2025-05-01 08:18:06', '2024-10-18 23:18:27'),
(40, 'aut mollitia atque Table', 'aut-mollitia-atque-table-GPnf6', 'Laudantium eius aspernatur labore cum cupiditate officia fuga possimus nobis quia quos consequatur.', 'Cupiditate minus voluptas reprehenderit tempora. Dignissimos nulla voluptatem molestiae ut reprehenderit aliquam sequi. Aut sunt provident saepe aut. Eum nemo provident est itaque.\n\nSint sit repudiandae dolorem voluptas placeat nisi. Aut illo quaerat in sapiente sed cupiditate.\n\nEt ut architecto similique beatae magni. Ut alias et debitis iste numquam. Occaecati neque ut sit vero omnis beatae.', '494.80', 188, 3, 3, 'out_of_stock', 0, 6003, '2025-02-13 00:26:43', '2025-05-18 08:33:29'),
(41, 'soluta qui quisquam Bed', 'soluta-qui-quisquam-bed-42UTS', 'Aliquid mollitia et accusamus omnis est hic odit repellendus eos rerum veniam blanditiis libero.', 'Facere expedita sint voluptatem dolores facilis. Pariatur sint sint laboriosam quia at distinctio debitis. Impedit odit vel ipsum totam et beatae provident. Explicabo ratione consequatur facere est autem ea dolor.\n\nMollitia fuga dolor et autem facilis. Et nemo doloribus dolores molestias voluptatem et. Repudiandae sit vel reiciendis ducimus.\n\nDoloremque repudiandae optio voluptas vel molestiae. Dolorem enim sed fugiat sed quae suscipit. Libero quo laudantium reiciendis saepe dolor est.', '2463.92', 154, 3, 3, 'published', 0, 6868, '2025-03-24 04:53:03', '2024-08-01 12:53:35'),
(42, 'molestiae nihil nobis Sofa', 'molestiae-nihil-nobis-sofa-9Woor', 'Qui cupiditate sunt et totam minus et eos.', 'Sunt eligendi nihil aliquid et architecto blanditiis. Sed iste a ipsam quidem quisquam commodi. Recusandae magni dolorem reprehenderit ab.\n\nSed enim neque omnis quos inventore. Id quo rerum quam qui exercitationem tempora. Tempore quidem veritatis quia ut non est omnis. In natus maxime labore et non harum.\n\nVoluptatum aut voluptatem in ad ex deleniti. Eaque qui odio aut aspernatur eos qui. Tempora unde aperiam alias voluptatem a. Harum nobis iure ex odio minima.', '4170.05', 136, 3, 3, 'archived', 1, 6952, '2025-02-04 18:09:57', '2024-12-04 08:24:58'),
(43, 'distinctio delectus totam Chair', 'distinctio-delectus-totam-chair-B5lOY', 'Necessitatibus sequi eum est itaque consectetur praesentium aut atque sint.', 'Et qui suscipit vel placeat minima debitis suscipit assumenda. Vero sed consequatur odio asperiores placeat aliquid repudiandae. Voluptatem eius cumque eligendi quia rerum facilis.\n\nProvident omnis necessitatibus ab reprehenderit recusandae. Reiciendis enim sed ipsum delectus.\n\nMinima et qui qui harum dolor et inventore. Eum facilis dolore veritatis et et. Quia omnis doloremque voluptatibus ipsam deleniti.', '4519.18', 113, 3, 3, 'archived', 0, 9186, '2025-03-25 12:54:10', '2025-02-08 23:19:41'),
(44, 'illum minus quae Chair', 'illum-minus-quae-chair-8nlmY', 'Dignissimos mollitia cum distinctio velit magni quam veritatis mollitia sit omnis itaque explicabo.', 'Magni fugiat aspernatur iure neque. Minus voluptatem qui velit voluptatem quam. In quis nihil quasi suscipit.\n\nPerspiciatis voluptatem illum voluptas perferendis tenetur rem consectetur laudantium. Molestiae sint tempore qui explicabo accusantium doloribus aut ut. Atque animi autem rem velit ullam voluptas accusantium. Culpa velit dolore quia.\n\nSunt autem qui et perferendis architecto voluptate minima. Vero recusandae autem consequatur asperiores. Voluptas consectetur possimus nihil vel enim culpa.', '2761.23', 122, 3, 3, 'archived', 0, 6587, '2025-01-26 17:55:40', '2024-08-03 03:32:42'),
(45, 'aperiam pariatur non Chair', 'aperiam-pariatur-non-chair-YE5j4', 'Culpa quis ex exercitationem maxime exercitationem maiores mollitia autem pariatur quo reprehenderit mollitia.', 'Ratione explicabo sunt et enim soluta est ipsam. Quis quis doloremque aut quia est molestiae ut. Sequi saepe dolor exercitationem enim. Cumque voluptatem quasi consequatur enim rerum inventore fuga.\n\nEsse qui libero consequatur optio. Aut odio magnam corrupti dolorum et ab occaecati. Tempora nihil eveniet et pariatur qui.\n\nOccaecati quisquam accusamus incidunt est quam id neque voluptatem. Vero est quia saepe enim et qui aliquam. Nostrum odit iusto aliquam officia est repellendus illo.', '1047.56', 73, 3, 3, 'archived', 1, 9667, '2024-12-26 15:20:54', '2025-01-04 09:10:54'),
(46, 'omnis sint placeat Sofa', 'omnis-sint-placeat-sofa-cL8zT', 'Maxime ex magnam provident voluptate aut mollitia labore.', 'Possimus ut porro reiciendis doloremque possimus itaque. Eos autem aut cum ut fuga temporibus non.\n\nOdio pariatur ut quod odit ut. Mollitia ea excepturi voluptate et et sunt eum. Soluta cumque ratione voluptatem perspiciatis cum inventore. Nostrum ut neque non dolor reiciendis. Deleniti dolores commodi cupiditate.\n\nQuidem quia cum accusantium sunt. Aut consectetur eveniet et qui est enim. Est ex atque reiciendis nihil quo rerum pariatur.', '4204.55', 109, 3, 3, 'draft', 0, 7626, '2025-02-16 08:28:17', '2025-01-07 10:20:38'),
(47, 'ut porro ea Bed', 'ut-porro-ea-bed-TuctZ', 'Esse tempore autem qui perspiciatis illo tempore qui.', 'Minima rerum nesciunt quam perferendis. Tenetur enim blanditiis natus sint. Quia mollitia quasi aut beatae rerum. Quos est ut voluptate fugit quo. Aut fugiat quas quos.\n\nTotam voluptas doloribus laboriosam vel dignissimos impedit beatae. Reiciendis vero distinctio est nesciunt est ut. Totam vel praesentium adipisci et hic. Aliquid eum quia ad sequi ipsum ut non modi.\n\nAutem optio ad dolores eveniet. Voluptate quisquam totam qui dolorum consequatur doloribus voluptas occaecati. Rerum totam aut quo cumque. Necessitatibus molestiae quo fugiat veniam et quas.', '3426.58', 53, 3, 3, 'archived', 0, 3862, '2024-10-29 19:54:57', '2025-01-24 16:29:53'),
(48, 'voluptatem animi molestiae Cabinet', 'voluptatem-animi-molestiae-cabinet-TUniG', 'Ad accusamus in sit illo consequatur in rem similique pariatur provident rem.', 'Repellendus autem rerum autem et iure odit ullam. Eos veniam odio dolores et aperiam voluptas velit. Incidunt suscipit illo hic et eos totam. Deserunt voluptas nemo fugit voluptas sint dolore iusto.\n\nOmnis et et ipsam velit nesciunt. Ullam sit delectus iusto similique vero ut fugiat. Optio occaecati qui excepturi provident non vel rerum. Dolore sed aut cupiditate nulla sunt aut nihil.\n\nLibero ipsam mollitia quis numquam. Exercitationem omnis eligendi perferendis sit eum deserunt autem. Et voluptas non non eveniet.', '4160.81', 3, 3, 3, 'draft', 0, 2609, '2024-09-28 14:43:29', '2025-01-22 05:23:03'),
(49, 'ut sapiente vel Bed', 'ut-sapiente-vel-bed-Vkqmk', 'Enim in illo veritatis quam excepturi ut placeat.', 'Reiciendis veniam dolore cumque sed facilis. In molestias blanditiis qui veniam sint numquam laborum. Repudiandae ipsam praesentium velit sit quia. Ut est id velit culpa a.\n\nLaboriosam dolor neque deleniti aliquam. Voluptatibus perferendis architecto ut at. Quidem magnam dolor ex rerum ut. Est voluptas ut natus accusantium incidunt distinctio. Repellendus sit aspernatur deserunt sint est similique quas.\n\nAut atque id quasi deleniti tenetur quaerat. Autem porro veritatis dolor eum. Vel enim quibusdam voluptas porro alias.', '2296.20', 171, 3, 3, 'draft', 0, 1586, '2025-02-13 05:25:32', '2024-07-10 16:47:00'),
(50, 'et consequatur sed Chair', 'et-consequatur-sed-chair-Dmzzu', 'Ut vel qui repellat et optio voluptas eos deleniti ab sint architecto explicabo.', 'Odio quis optio iusto tempore deserunt fuga. Ratione voluptas et perferendis vero ad. Impedit occaecati asperiores iste id nam ducimus. Officiis sequi nam nemo.\n\nEx voluptatem ipsam praesentium temporibus. Quibusdam ut officiis itaque reiciendis et dolorum non repellat. Rerum vel fugiat reprehenderit aut qui consectetur fugiat.\n\nVoluptatibus soluta et deserunt error occaecati veniam. Quo aut perferendis omnis qui sunt quia accusamus saepe. Autem ut nam suscipit quas harum sit. Repellat consequatur nihil et.', '1422.36', 66, 3, 3, 'draft', 0, 6844, '2025-05-21 12:07:03', '2025-02-06 05:14:27');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_thumbnail` tinyint(1) NOT NULL DEFAULT '0',
  `order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_url`, `alt_text`, `is_thumbnail`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 'https://via.placeholder.com/800x600.png/0000ee?text=furniture+vel', 'Quis sed aut laborum.', 1, 4, '2025-05-21 13:30:30', '2025-06-02 20:56:34'),
(2, 1, 'https://via.placeholder.com/800x600.png/001188?text=furniture+incidunt', 'Explicabo omnis sed aut iusto aperiam necessitatibus.', 1, 4, '2025-05-20 18:12:03', '2025-04-20 09:30:16'),
(3, 1, 'https://via.placeholder.com/800x600.png/004499?text=furniture+ut', 'Et consequatur porro est expedita quasi.', 0, 3, '2024-12-24 12:17:03', '2025-01-14 07:08:37'),
(4, 1, 'https://via.placeholder.com/800x600.png/005599?text=furniture+unde', 'Deleniti et ab et quia.', 0, 1, '2025-05-12 11:07:40', '2024-12-11 14:38:36'),
(5, 1, 'https://via.placeholder.com/800x600.png/00bbaa?text=furniture+vel', 'Nisi laudantium dolor ea quo.', 1, 1, '2025-03-16 08:25:25', '2025-02-03 16:06:24'),
(6, 2, 'https://via.placeholder.com/800x600.png/0044ee?text=furniture+qui', 'Corrupti illo tenetur provident qui aut.', 1, 3, '2024-12-28 11:42:38', '2025-06-02 20:56:34'),
(7, 2, 'https://via.placeholder.com/800x600.png/003355?text=furniture+molestiae', 'Dolorem aliquam corporis esse ut praesentium.', 0, 4, '2025-01-06 03:23:45', '2024-12-11 04:51:05'),
(8, 2, 'https://via.placeholder.com/800x600.png/0077ff?text=furniture+magnam', 'Quia soluta occaecati accusantium quis.', 0, 3, '2024-12-03 15:52:28', '2025-02-24 09:02:36'),
(9, 2, 'https://via.placeholder.com/800x600.png/00eeaa?text=furniture+eligendi', 'Vitae iure unde cumque sed.', 0, 4, '2025-03-01 08:55:33', '2025-05-16 00:48:25'),
(10, 3, 'https://via.placeholder.com/800x600.png/00aa22?text=furniture+facilis', 'Ut cumque sapiente minima voluptatibus porro.', 1, 2, '2025-01-17 04:05:51', '2025-06-02 20:56:34'),
(11, 3, 'https://via.placeholder.com/800x600.png/0055cc?text=furniture+sit', 'Amet sit aspernatur exercitationem voluptas assumenda.', 0, 5, '2025-03-04 10:36:38', '2025-05-31 19:44:12'),
(12, 3, 'https://via.placeholder.com/800x600.png/005500?text=furniture+sint', 'Quos sit illum ea.', 1, 2, '2024-12-11 05:17:49', '2025-02-17 18:39:20'),
(13, 3, 'https://via.placeholder.com/800x600.png/009988?text=furniture+dicta', 'Aspernatur voluptas ut aut excepturi maxime.', 0, 1, '2025-03-01 03:21:32', '2025-04-09 08:18:07'),
(14, 4, 'https://via.placeholder.com/800x600.png/006655?text=furniture+ea', 'Dolores molestiae quia ipsa veniam.', 1, 2, '2025-03-26 17:53:17', '2025-06-02 20:56:34'),
(15, 4, 'https://via.placeholder.com/800x600.png/00cc99?text=furniture+sed', 'Et enim modi ut provident eveniet.', 0, 1, '2025-03-07 09:49:19', '2024-12-07 08:11:24'),
(16, 4, 'https://via.placeholder.com/800x600.png/006688?text=furniture+vitae', 'Aut omnis et est minima.', 1, 5, '2025-04-02 14:57:44', '2025-05-24 19:49:29'),
(17, 4, 'https://via.placeholder.com/800x600.png/00ee22?text=furniture+corporis', 'Molestiae laudantium laboriosam et.', 0, 2, '2025-04-24 12:26:34', '2025-03-11 18:34:12'),
(18, 4, 'https://via.placeholder.com/800x600.png/00bbbb?text=furniture+error', 'Tempora eveniet et dolorem.', 0, 2, '2025-05-24 05:46:56', '2025-02-09 09:33:20'),
(19, 5, 'https://via.placeholder.com/800x600.png/0011cc?text=furniture+et', 'Suscipit similique qui quos.', 1, 4, '2025-04-11 22:34:55', '2025-06-02 20:56:34'),
(20, 5, 'https://via.placeholder.com/800x600.png/00aa11?text=furniture+sunt', 'Dignissimos libero modi sit vel.', 0, 4, '2025-05-29 14:54:59', '2025-04-24 10:52:24'),
(21, 5, 'https://via.placeholder.com/800x600.png/002211?text=furniture+numquam', 'Nam qui consequatur omnis consequatur.', 0, 2, '2025-01-28 00:34:36', '2025-03-20 18:44:33'),
(22, 5, 'https://via.placeholder.com/800x600.png/00ee00?text=furniture+enim', 'Magnam dolores consequatur fuga voluptas officiis asperiores.', 0, 5, '2024-12-05 15:35:43', '2024-12-10 20:32:01'),
(23, 6, 'https://via.placeholder.com/800x600.png/0000dd?text=furniture+fugiat', 'Nostrum tempore dolorum et delectus.', 1, 4, '2025-03-23 04:00:07', '2025-06-02 20:56:34'),
(24, 6, 'https://via.placeholder.com/800x600.png/00bb66?text=furniture+magni', 'Quidem culpa aut fuga itaque non ut.', 0, 5, '2025-02-21 10:52:08', '2025-04-02 11:42:25'),
(25, 6, 'https://via.placeholder.com/800x600.png/001144?text=furniture+et', 'Sed earum veniam dolorem et.', 0, 1, '2025-04-12 13:18:29', '2025-04-12 00:47:44'),
(26, 6, 'https://via.placeholder.com/800x600.png/008888?text=furniture+iure', 'Ullam et ut nobis odio vel laborum.', 0, 2, '2025-02-03 10:51:30', '2024-12-05 09:22:20'),
(27, 6, 'https://via.placeholder.com/800x600.png/007755?text=furniture+delectus', 'Dicta et cum quae.', 1, 5, '2025-01-09 14:32:10', '2025-05-16 09:02:15'),
(28, 7, 'https://via.placeholder.com/800x600.png/00bb22?text=furniture+voluptates', 'Expedita facilis sit et voluptatem.', 1, 5, '2025-03-15 08:06:13', '2025-06-02 20:56:34'),
(29, 7, 'https://via.placeholder.com/800x600.png/00ff99?text=furniture+et', 'Aut eaque perferendis quasi.', 0, 1, '2025-05-22 19:05:19', '2025-02-09 03:46:10'),
(30, 7, 'https://via.placeholder.com/800x600.png/00aaff?text=furniture+explicabo', 'Ut eos omnis amet molestias vitae voluptatibus.', 1, 5, '2025-05-11 04:46:03', '2025-02-23 08:33:03'),
(31, 7, 'https://via.placeholder.com/800x600.png/003300?text=furniture+dolores', 'Ut eligendi omnis quas.', 0, 3, '2025-05-16 10:05:43', '2025-05-04 14:01:42'),
(32, 8, 'https://via.placeholder.com/800x600.png/00cc00?text=furniture+asperiores', 'Doloribus ratione atque qui dolor et.', 1, 4, '2025-01-01 10:05:59', '2025-06-02 20:56:34'),
(33, 8, 'https://via.placeholder.com/800x600.png/002244?text=furniture+dolor', 'At iusto sequi omnis nesciunt voluptas.', 1, 3, '2025-01-18 02:08:22', '2025-01-09 21:24:11'),
(34, 9, 'https://via.placeholder.com/800x600.png/00bbcc?text=furniture+architecto', 'Est iste expedita aut.', 1, 5, '2025-05-23 12:02:57', '2025-06-02 20:56:34'),
(35, 9, 'https://via.placeholder.com/800x600.png/00ffaa?text=furniture+enim', 'Maiores ut qui rerum et.', 0, 2, '2025-03-16 13:01:19', '2025-01-08 10:49:07'),
(36, 10, 'https://via.placeholder.com/800x600.png/007700?text=furniture+omnis', 'Nemo qui magnam eum voluptatibus ipsam quis.', 1, 2, '2025-01-14 06:03:48', '2025-06-02 20:56:34'),
(37, 10, 'https://via.placeholder.com/800x600.png/003377?text=furniture+itaque', 'Atque neque aliquam molestias itaque.', 0, 4, '2025-03-26 13:06:18', '2025-05-30 12:13:59'),
(38, 10, 'https://via.placeholder.com/800x600.png/00ccbb?text=furniture+voluptas', 'Harum qui debitis quis.', 0, 5, '2025-04-08 21:49:07', '2024-12-21 04:37:30'),
(39, 10, 'https://via.placeholder.com/800x600.png/0077bb?text=furniture+quia', 'Sunt commodi sed sint odio similique.', 0, 4, '2025-05-27 06:36:52', '2024-12-18 23:38:16'),
(40, 11, 'https://via.placeholder.com/800x600.png/008855?text=furniture+illo', 'Omnis consequatur non quos expedita.', 1, 2, '2025-02-01 12:00:26', '2025-06-02 20:56:34'),
(41, 11, 'https://via.placeholder.com/800x600.png/00cc44?text=furniture+reiciendis', 'Doloremque quaerat vel rerum quibusdam omnis magnam.', 0, 1, '2025-05-05 23:37:25', '2025-05-19 01:43:09'),
(42, 11, 'https://via.placeholder.com/800x600.png/007755?text=furniture+omnis', 'Et corrupti error reprehenderit nisi.', 0, 1, '2025-05-26 02:57:55', '2025-03-14 03:07:01'),
(43, 11, 'https://via.placeholder.com/800x600.png/00ddbb?text=furniture+eius', 'Sint adipisci voluptates voluptas.', 0, 2, '2025-04-02 04:01:08', '2025-05-08 14:45:21'),
(44, 12, 'https://via.placeholder.com/800x600.png/009922?text=furniture+sequi', 'Eum quasi doloremque eum soluta ut ut.', 1, 2, '2025-02-21 01:13:24', '2025-06-02 20:56:34'),
(45, 12, 'https://via.placeholder.com/800x600.png/007711?text=furniture+harum', 'Blanditiis animi voluptas qui eos perferendis.', 0, 5, '2025-05-13 20:47:57', '2025-05-17 03:15:12'),
(46, 12, 'https://via.placeholder.com/800x600.png/00aa33?text=furniture+rerum', 'Totam dolorem ipsa nihil.', 1, 5, '2025-04-09 11:46:32', '2025-05-23 04:00:12'),
(47, 12, 'https://via.placeholder.com/800x600.png/00aaaa?text=furniture+nulla', 'Odit maxime ut et aut.', 0, 4, '2025-04-12 08:01:17', '2025-03-21 03:56:23'),
(48, 13, 'https://via.placeholder.com/800x600.png/001122?text=furniture+id', 'Dicta sed ullam molestiae.', 1, 1, '2025-01-24 14:07:48', '2025-06-02 20:56:34'),
(49, 13, 'https://via.placeholder.com/800x600.png/00ddff?text=furniture+explicabo', 'Quibusdam saepe non facere.', 0, 4, '2025-05-03 10:26:19', '2025-01-10 02:12:50'),
(50, 13, 'https://via.placeholder.com/800x600.png/005544?text=furniture+sunt', 'Voluptas odio voluptatem sed veritatis.', 0, 1, '2025-04-09 01:26:41', '2025-05-26 09:14:36'),
(51, 13, 'https://via.placeholder.com/800x600.png/001100?text=furniture+aliquam', 'Eos aut error consequatur et et.', 0, 5, '2025-04-21 00:26:16', '2025-05-15 23:32:17'),
(52, 14, 'https://via.placeholder.com/800x600.png/003388?text=furniture+expedita', 'Eos rerum incidunt nesciunt veniam alias.', 1, 1, '2025-02-23 14:31:08', '2025-06-02 20:56:34'),
(53, 14, 'https://via.placeholder.com/800x600.png/008888?text=furniture+molestias', 'Quo quo vel maiores consectetur eum.', 1, 1, '2025-03-01 23:55:20', '2025-03-02 16:19:08'),
(54, 14, 'https://via.placeholder.com/800x600.png/0022dd?text=furniture+harum', 'Eligendi architecto reiciendis et eum officia.', 0, 1, '2024-12-08 08:36:06', '2024-12-26 19:55:55'),
(55, 15, 'https://via.placeholder.com/800x600.png/007711?text=furniture+ipsa', 'Natus quia nulla eius voluptatibus ullam porro sit.', 1, 5, '2025-02-19 07:29:23', '2025-06-02 20:56:34'),
(56, 15, 'https://via.placeholder.com/800x600.png/000066?text=furniture+tenetur', 'Impedit ipsam qui rerum est deserunt.', 0, 5, '2025-04-27 22:08:32', '2024-12-03 23:14:03'),
(57, 15, 'https://via.placeholder.com/800x600.png/004455?text=furniture+eveniet', 'Fuga aut officiis necessitatibus voluptatum aliquam nemo.', 0, 3, '2025-01-16 23:55:30', '2025-04-03 18:08:55'),
(58, 15, 'https://via.placeholder.com/800x600.png/00aa22?text=furniture+iure', 'Maxime autem voluptas doloribus est praesentium.', 1, 2, '2025-04-06 01:58:57', '2025-03-12 06:21:21'),
(59, 16, 'https://via.placeholder.com/800x600.png/00cc99?text=furniture+dolorum', 'Mollitia nihil est illo aperiam suscipit atque.', 1, 2, '2025-03-30 04:45:23', '2025-06-02 20:56:34'),
(60, 16, 'https://via.placeholder.com/800x600.png/008844?text=furniture+eveniet', 'Qui aperiam iste totam vel deleniti et.', 0, 3, '2025-01-24 21:40:58', '2025-05-12 20:40:50'),
(61, 16, 'https://via.placeholder.com/800x600.png/004477?text=furniture+autem', 'Delectus quod eius recusandae minima dicta.', 0, 3, '2025-05-27 22:44:40', '2025-01-31 11:31:05'),
(62, 16, 'https://via.placeholder.com/800x600.png/00aa00?text=furniture+cum', 'Quo commodi et autem.', 0, 4, '2025-02-07 17:43:51', '2024-12-05 10:43:46'),
(63, 17, 'https://via.placeholder.com/800x600.png/002244?text=furniture+expedita', 'Ut ut dolorum omnis mollitia non ea.', 1, 1, '2024-12-03 04:45:37', '2025-06-02 20:56:34'),
(64, 17, 'https://via.placeholder.com/800x600.png/0044ee?text=furniture+similique', 'Quibusdam iusto repellat consequatur dolorum blanditiis qui.', 0, 3, '2025-03-19 17:29:00', '2025-05-29 12:09:06'),
(65, 17, 'https://via.placeholder.com/800x600.png/00ee66?text=furniture+quod', 'Quia ducimus laborum ut pariatur nesciunt.', 0, 5, '2025-01-17 21:13:24', '2024-12-25 15:07:49'),
(66, 18, 'https://via.placeholder.com/800x600.png/003300?text=furniture+voluptatem', 'A provident minima earum.', 1, 2, '2025-01-05 17:20:46', '2025-06-02 20:56:34'),
(67, 18, 'https://via.placeholder.com/800x600.png/000022?text=furniture+velit', 'Omnis recusandae placeat et qui dolorem.', 0, 3, '2025-02-02 22:06:46', '2025-05-20 22:41:00'),
(68, 19, 'https://via.placeholder.com/800x600.png/004455?text=furniture+recusandae', 'Excepturi eaque similique rerum quas est.', 1, 1, '2025-06-01 20:45:43', '2025-06-02 20:56:34'),
(69, 19, 'https://via.placeholder.com/800x600.png/004499?text=furniture+corporis', 'Dolorum dolorem quia quo explicabo autem.', 0, 2, '2025-04-22 17:50:01', '2025-01-07 16:05:08'),
(70, 19, 'https://via.placeholder.com/800x600.png/00bbee?text=furniture+nobis', 'Aut impedit hic molestias.', 0, 4, '2025-04-10 12:27:32', '2025-02-02 04:23:15'),
(71, 20, 'https://via.placeholder.com/800x600.png/003377?text=furniture+nesciunt', 'Qui molestiae totam eveniet minus.', 1, 3, '2025-02-04 06:49:03', '2025-06-02 20:56:34'),
(72, 20, 'https://via.placeholder.com/800x600.png/00ffdd?text=furniture+et', 'Et perspiciatis atque dolorum.', 0, 2, '2025-03-17 17:11:47', '2025-02-18 09:21:19'),
(73, 20, 'https://via.placeholder.com/800x600.png/001111?text=furniture+assumenda', 'Qui at et vel placeat.', 0, 2, '2025-03-09 05:19:16', '2025-04-09 16:13:38'),
(74, 20, 'https://via.placeholder.com/800x600.png/003344?text=furniture+nulla', 'Voluptatem quasi sed assumenda voluptatem est aliquid.', 0, 5, '2024-12-24 19:00:29', '2025-01-02 06:06:15'),
(75, 20, 'https://via.placeholder.com/800x600.png/0099dd?text=furniture+at', 'Sed minus quia blanditiis et consequatur asperiores.', 1, 5, '2024-12-16 13:04:08', '2025-03-24 00:50:41'),
(76, 21, 'https://via.placeholder.com/800x600.png/000088?text=furniture+accusamus', 'Amet excepturi nihil voluptate odio ab atque.', 1, 2, '2025-01-16 10:49:49', '2025-01-04 01:34:00'),
(77, 21, 'https://via.placeholder.com/800x600.png/0044dd?text=furniture+perspiciatis', 'Et quis distinctio temporibus.', 0, 2, '2025-03-09 12:04:02', '2025-03-05 03:20:09'),
(78, 21, 'https://via.placeholder.com/800x600.png/0088aa?text=furniture+temporibus', 'Dolores corrupti et minima.', 0, 3, '2024-12-04 08:50:00', '2025-02-23 00:18:45'),
(79, 21, 'https://via.placeholder.com/800x600.png/00ffcc?text=furniture+nulla', 'Sed dolorum quaerat sed ipsam.', 0, 4, '2024-12-04 20:28:12', '2025-04-23 07:15:32'),
(80, 21, 'https://via.placeholder.com/800x600.png/00bbee?text=furniture+inventore', 'Laboriosam rem blanditiis provident et.', 0, 5, '2025-03-07 22:41:51', '2024-12-18 14:19:33'),
(81, 22, 'https://via.placeholder.com/800x600.png/006688?text=furniture+molestiae', 'Aut illo natus quibusdam.', 1, 1, '2025-03-12 08:45:16', '2025-06-02 20:56:34'),
(82, 22, 'https://via.placeholder.com/800x600.png/00aacc?text=furniture+voluptas', 'Consequatur ipsum dolor est.', 0, 4, '2024-12-10 07:58:13', '2024-12-24 07:52:21'),
(83, 23, 'https://via.placeholder.com/800x600.png/003355?text=furniture+nisi', 'Consequatur dolores doloribus voluptas.', 1, 2, '2025-03-17 06:43:30', '2025-01-20 03:32:39'),
(84, 23, 'https://via.placeholder.com/800x600.png/0088bb?text=furniture+laboriosam', 'Sapiente eum et voluptatem nihil.', 0, 1, '2025-01-20 00:25:48', '2025-05-11 21:08:04'),
(85, 24, 'https://via.placeholder.com/800x600.png/005566?text=furniture+sunt', 'Pariatur quia dolore voluptate similique maxime.', 1, 3, '2025-04-20 10:46:52', '2025-02-03 20:55:04'),
(86, 24, 'https://via.placeholder.com/800x600.png/00cccc?text=furniture+iste', 'Molestiae possimus rerum hic quo.', 0, 3, '2025-03-15 21:33:59', '2025-01-14 09:24:52'),
(87, 25, 'https://via.placeholder.com/800x600.png/008899?text=furniture+quia', 'Expedita illo vel quia molestiae.', 1, 4, '2024-12-21 21:26:35', '2025-06-02 20:56:34'),
(88, 25, 'https://via.placeholder.com/800x600.png/003399?text=furniture+consequatur', 'Eum est expedita quo suscipit qui labore.', 0, 5, '2025-04-05 04:58:42', '2025-03-26 11:00:56'),
(89, 25, 'https://via.placeholder.com/800x600.png/003322?text=furniture+necessitatibus', 'Commodi sint aliquam animi.', 0, 4, '2025-03-16 08:52:48', '2024-12-23 18:31:18'),
(90, 25, 'https://via.placeholder.com/800x600.png/00dddd?text=furniture+eos', 'Veniam voluptas eaque aut.', 0, 5, '2025-05-20 02:32:56', '2025-04-14 04:34:01'),
(91, 25, 'https://via.placeholder.com/800x600.png/00ffff?text=furniture+qui', 'Excepturi praesentium suscipit dolores repellat recusandae.', 0, 3, '2025-02-23 17:13:40', '2025-06-01 23:12:31'),
(92, 26, 'https://via.placeholder.com/800x600.png/00cc88?text=furniture+et', 'Eos et neque quo qui explicabo autem.', 1, 5, '2025-02-03 12:00:10', '2025-06-02 20:56:34'),
(93, 26, 'https://via.placeholder.com/800x600.png/00ccdd?text=furniture+iste', 'Suscipit et et suscipit veritatis est nihil.', 0, 4, '2025-05-25 12:23:30', '2025-04-06 19:42:12'),
(94, 26, 'https://via.placeholder.com/800x600.png/009999?text=furniture+consequatur', 'Non assumenda est laborum necessitatibus consequatur dolorem.', 0, 1, '2025-01-01 07:18:12', '2025-01-15 15:55:55'),
(95, 26, 'https://via.placeholder.com/800x600.png/00cc66?text=furniture+et', 'Autem quis ut numquam magnam.', 0, 5, '2025-03-10 13:24:11', '2024-12-17 14:01:03'),
(96, 26, 'https://via.placeholder.com/800x600.png/001166?text=furniture+blanditiis', 'Sapiente hic rerum labore.', 1, 4, '2024-12-27 09:20:39', '2025-03-23 20:00:38'),
(97, 27, 'https://via.placeholder.com/800x600.png/00aaff?text=furniture+rerum', 'Ut repudiandae et et sint omnis aut.', 1, 1, '2025-01-14 05:00:49', '2025-06-02 20:56:34'),
(98, 27, 'https://via.placeholder.com/800x600.png/0066ee?text=furniture+aut', 'Eius quis quae aut voluptatem veniam doloremque.', 0, 1, '2025-02-14 14:22:52', '2025-02-07 03:26:35'),
(99, 27, 'https://via.placeholder.com/800x600.png/004411?text=furniture+pariatur', 'Non optio harum quae ipsum.', 0, 5, '2025-04-27 02:16:52', '2025-01-11 16:44:58'),
(100, 27, 'https://via.placeholder.com/800x600.png/004422?text=furniture+amet', 'Quo debitis quam occaecati corrupti.', 0, 1, '2024-12-11 03:16:59', '2025-05-01 00:49:24'),
(101, 28, 'https://via.placeholder.com/800x600.png/004499?text=furniture+quis', 'Dolorem pariatur quia sequi iure non.', 1, 3, '2025-02-08 02:16:39', '2025-06-02 20:56:34'),
(102, 28, 'https://via.placeholder.com/800x600.png/00dddd?text=furniture+exercitationem', 'Dolorem dolorum nesciunt est reiciendis.', 0, 1, '2025-05-06 07:22:51', '2025-01-19 04:24:03'),
(103, 28, 'https://via.placeholder.com/800x600.png/0055cc?text=furniture+earum', 'Vitae consequatur eligendi cum.', 0, 2, '2025-04-20 13:27:30', '2025-05-15 07:40:37'),
(104, 29, 'https://via.placeholder.com/800x600.png/00ff33?text=furniture+quae', 'Omnis totam quibusdam consequatur expedita omnis.', 1, 1, '2024-12-12 09:06:01', '2025-06-02 20:56:34'),
(105, 29, 'https://via.placeholder.com/800x600.png/003322?text=furniture+ut', 'Aut voluptas corporis omnis et.', 0, 2, '2025-03-17 16:41:55', '2025-01-20 13:16:03'),
(106, 29, 'https://via.placeholder.com/800x600.png/003322?text=furniture+molestiae', 'Exercitationem ipsa facere aspernatur.', 0, 3, '2024-12-23 01:55:35', '2025-04-21 17:22:24'),
(107, 29, 'https://via.placeholder.com/800x600.png/002200?text=furniture+alias', 'Perspiciatis explicabo sequi occaecati numquam perferendis est.', 0, 5, '2025-05-12 23:48:31', '2025-01-23 23:36:51'),
(108, 29, 'https://via.placeholder.com/800x600.png/0011dd?text=furniture+optio', 'Hic quos ut rem.', 0, 3, '2024-12-10 14:45:59', '2025-04-15 15:21:12'),
(109, 30, 'https://via.placeholder.com/800x600.png/00ff00?text=furniture+eligendi', 'Ullam laborum voluptatem ducimus necessitatibus minus ducimus.', 1, 3, '2025-02-17 04:03:24', '2025-06-02 20:56:34'),
(110, 30, 'https://via.placeholder.com/800x600.png/000000?text=furniture+rerum', 'Nam modi rerum hic rerum dicta.', 0, 1, '2025-02-11 03:21:25', '2025-04-17 01:27:56'),
(111, 31, 'https://via.placeholder.com/800x600.png/004411?text=furniture+eius', 'Porro ea corporis quis.', 1, 3, '2025-01-17 07:56:03', '2025-06-02 20:56:34'),
(112, 31, 'https://via.placeholder.com/800x600.png/0044dd?text=furniture+neque', 'Accusamus consequatur voluptatem qui unde quam aliquid.', 0, 4, '2025-05-20 00:55:23', '2025-02-22 02:01:01'),
(113, 31, 'https://via.placeholder.com/800x600.png/00ffdd?text=furniture+dolor', 'Sequi perspiciatis delectus dignissimos exercitationem.', 0, 5, '2025-01-10 18:47:19', '2025-03-16 21:14:13'),
(114, 31, 'https://via.placeholder.com/800x600.png/002277?text=furniture+eaque', 'Nesciunt magnam incidunt dolorem.', 0, 3, '2025-05-15 16:33:04', '2025-05-29 17:55:01'),
(115, 31, 'https://via.placeholder.com/800x600.png/00cc99?text=furniture+vero', 'Voluptates dolorem quo quas sapiente a necessitatibus.', 0, 2, '2025-03-15 23:54:30', '2025-03-10 23:11:03'),
(116, 32, 'https://via.placeholder.com/800x600.png/004499?text=furniture+aperiam', 'Doloribus doloribus esse similique.', 1, 1, '2025-05-08 21:23:39', '2024-12-24 15:53:18'),
(117, 32, 'https://via.placeholder.com/800x600.png/00dd11?text=furniture+velit', 'Est minus qui dolores qui.', 0, 5, '2025-02-28 23:25:30', '2025-02-16 23:22:04'),
(118, 32, 'https://via.placeholder.com/800x600.png/00cc11?text=furniture+odit', 'Incidunt laborum ratione voluptates.', 0, 3, '2025-03-10 16:42:33', '2025-05-31 06:03:45'),
(119, 32, 'https://via.placeholder.com/800x600.png/000088?text=furniture+quis', 'Molestias eaque blanditiis alias dolorem asperiores.', 0, 2, '2025-04-20 11:39:04', '2025-02-22 15:59:47'),
(120, 32, 'https://via.placeholder.com/800x600.png/00bb66?text=furniture+laborum', 'Est ut saepe odio molestiae enim perspiciatis.', 0, 2, '2025-02-08 19:20:13', '2025-04-05 02:36:34'),
(121, 33, 'https://via.placeholder.com/800x600.png/00dd11?text=furniture+modi', 'Id et animi temporibus qui.', 1, 1, '2024-12-08 03:34:27', '2025-04-10 22:22:03'),
(122, 33, 'https://via.placeholder.com/800x600.png/00dddd?text=furniture+veritatis', 'Quam et voluptas quam.', 1, 5, '2025-01-22 02:46:31', '2025-03-04 07:02:39'),
(123, 33, 'https://via.placeholder.com/800x600.png/0088aa?text=furniture+dolore', 'Voluptate sed est assumenda est molestiae dolorem.', 0, 1, '2025-05-28 00:42:33', '2025-03-04 17:57:05'),
(124, 33, 'https://via.placeholder.com/800x600.png/005544?text=furniture+voluptas', 'Dolorem delectus itaque omnis et.', 0, 4, '2025-03-13 13:25:54', '2025-04-10 16:14:48'),
(125, 33, 'https://via.placeholder.com/800x600.png/002277?text=furniture+sapiente', 'Sit molestiae aliquam nemo.', 0, 3, '2025-05-06 22:15:53', '2025-01-15 16:07:27'),
(126, 34, 'https://via.placeholder.com/800x600.png/008844?text=furniture+iste', 'Optio adipisci officiis vero quo similique.', 1, 2, '2025-03-03 16:50:42', '2025-06-02 20:56:34'),
(127, 34, 'https://via.placeholder.com/800x600.png/00cc33?text=furniture+vel', 'Quod quia rerum qui delectus repellat.', 0, 2, '2025-05-27 04:08:59', '2025-04-03 12:15:39'),
(128, 35, 'https://via.placeholder.com/800x600.png/0055dd?text=furniture+possimus', 'Sunt beatae quibusdam error harum et.', 1, 3, '2025-02-24 01:11:53', '2025-06-02 20:56:34'),
(129, 35, 'https://via.placeholder.com/800x600.png/009944?text=furniture+ipsa', 'Beatae quo velit odit illo.', 0, 5, '2025-03-11 21:21:49', '2024-12-11 12:19:44'),
(130, 35, 'https://via.placeholder.com/800x600.png/00aa33?text=furniture+libero', 'Quaerat voluptatem saepe delectus.', 1, 1, '2025-03-16 12:05:29', '2025-03-29 21:29:43'),
(131, 35, 'https://via.placeholder.com/800x600.png/0088ee?text=furniture+repudiandae', 'Consequatur enim id ut ipsa vel quo.', 1, 1, '2025-01-02 04:04:32', '2025-01-04 08:26:39'),
(132, 35, 'https://via.placeholder.com/800x600.png/0044cc?text=furniture+ut', 'Veniam reprehenderit harum non aspernatur aperiam.', 0, 1, '2025-05-28 14:49:54', '2025-01-28 06:01:42'),
(133, 36, 'https://via.placeholder.com/800x600.png/0088ee?text=furniture+distinctio', 'Provident nihil nostrum maxime provident.', 1, 3, '2025-01-29 04:42:19', '2025-01-07 19:41:54'),
(134, 36, 'https://via.placeholder.com/800x600.png/00aa44?text=furniture+eos', 'Dolorum ducimus voluptates beatae rerum non ut consequatur.', 0, 2, '2025-04-21 03:49:06', '2025-02-06 09:45:03'),
(135, 36, 'https://via.placeholder.com/800x600.png/00bb99?text=furniture+omnis', 'Dignissimos adipisci dolor vero deleniti.', 0, 3, '2025-02-06 08:08:56', '2025-01-26 21:31:50'),
(136, 37, 'https://via.placeholder.com/800x600.png/001166?text=furniture+quidem', 'Dolorum occaecati eius nihil.', 1, 5, '2025-03-27 19:55:59', '2025-06-02 20:56:34'),
(137, 37, 'https://via.placeholder.com/800x600.png/00ff99?text=furniture+aliquam', 'Id explicabo inventore earum.', 0, 3, '2025-03-28 03:03:44', '2025-01-31 03:41:24'),
(138, 37, 'https://via.placeholder.com/800x600.png/004466?text=furniture+excepturi', 'Labore est nostrum harum.', 1, 5, '2025-05-15 00:51:02', '2025-01-09 10:49:20'),
(139, 37, 'https://via.placeholder.com/800x600.png/007788?text=furniture+iure', 'Est mollitia omnis sint est.', 0, 1, '2025-03-03 07:57:33', '2025-02-17 21:29:24'),
(140, 37, 'https://via.placeholder.com/800x600.png/0000aa?text=furniture+ab', 'Accusantium aut perspiciatis culpa.', 0, 5, '2025-04-12 07:55:55', '2025-06-01 10:21:45'),
(141, 38, 'https://via.placeholder.com/800x600.png/008899?text=furniture+debitis', 'Non ut sit sapiente vero provident.', 1, 2, '2025-05-03 14:59:46', '2025-06-02 20:56:34'),
(142, 38, 'https://via.placeholder.com/800x600.png/002277?text=furniture+eum', 'Quo qui in cupiditate necessitatibus in.', 1, 4, '2025-01-14 11:34:32', '2025-01-09 06:27:22'),
(143, 38, 'https://via.placeholder.com/800x600.png/0055ff?text=furniture+ducimus', 'Dolorem et et quibusdam fugit.', 1, 2, '2024-12-09 04:11:35', '2025-03-21 13:32:59'),
(144, 38, 'https://via.placeholder.com/800x600.png/0033bb?text=furniture+labore', 'Facilis suscipit et sint et error.', 0, 2, '2025-03-05 11:55:56', '2024-12-20 10:03:27'),
(145, 38, 'https://via.placeholder.com/800x600.png/0044ee?text=furniture+et', 'Eum illum odio velit numquam consequatur.', 0, 3, '2025-04-28 13:13:08', '2024-12-14 01:43:43'),
(146, 39, 'https://via.placeholder.com/800x600.png/006699?text=furniture+non', 'Provident totam corporis quia aliquam dignissimos beatae.', 1, 5, '2025-05-25 22:01:18', '2025-06-02 20:56:34'),
(147, 39, 'https://via.placeholder.com/800x600.png/00ee66?text=furniture+non', 'Reiciendis et non ab error aut.', 1, 2, '2025-05-01 17:45:20', '2025-01-19 12:18:56'),
(148, 39, 'https://via.placeholder.com/800x600.png/0033dd?text=furniture+quia', 'Qui aut alias ut sed.', 0, 1, '2025-02-10 06:55:34', '2024-12-23 23:50:16'),
(149, 39, 'https://via.placeholder.com/800x600.png/001155?text=furniture+enim', 'Voluptas et non similique sapiente nesciunt voluptate.', 0, 4, '2025-01-16 15:59:27', '2024-12-16 20:42:56'),
(150, 39, 'https://via.placeholder.com/800x600.png/004477?text=furniture+cupiditate', 'Enim blanditiis reiciendis error dolor deserunt.', 1, 2, '2025-05-18 02:45:54', '2025-04-02 21:02:37'),
(151, 40, 'https://via.placeholder.com/800x600.png/00eeee?text=furniture+non', 'Error omnis eum minima asperiores iure.', 1, 1, '2025-02-21 08:48:35', '2025-06-02 20:56:34'),
(152, 40, 'https://via.placeholder.com/800x600.png/009988?text=furniture+esse', 'Accusamus est voluptate qui esse occaecati.', 0, 5, '2025-05-15 20:52:38', '2025-03-23 03:10:37'),
(153, 40, 'https://via.placeholder.com/800x600.png/00cc00?text=furniture+saepe', 'Libero ratione repudiandae exercitationem non qui dolores.', 0, 4, '2024-12-26 07:46:31', '2025-05-13 19:29:29'),
(154, 40, 'https://via.placeholder.com/800x600.png/004499?text=furniture+sequi', 'Voluptas praesentium eaque deleniti minima.', 0, 1, '2025-04-27 07:55:26', '2025-04-08 01:14:07'),
(155, 41, 'https://via.placeholder.com/800x600.png/00bbbb?text=furniture+dolorum', 'Modi laudantium doloribus laborum.', 1, 5, '2025-01-12 18:54:46', '2025-02-21 09:15:19'),
(156, 41, 'https://via.placeholder.com/800x600.png/00bb22?text=furniture+ut', 'Quam laboriosam quos et.', 0, 4, '2025-05-18 09:31:51', '2025-04-10 17:06:47'),
(157, 41, 'https://via.placeholder.com/800x600.png/009955?text=furniture+eos', 'Placeat et maiores dolores eligendi vel.', 1, 5, '2025-04-04 04:28:08', '2024-12-31 21:47:04'),
(158, 41, 'https://via.placeholder.com/800x600.png/0022ee?text=furniture+temporibus', 'Occaecati maiores asperiores eum ea deserunt omnis.', 0, 5, '2025-02-27 01:45:24', '2025-04-25 21:49:32'),
(159, 42, 'https://via.placeholder.com/800x600.png/000011?text=furniture+debitis', 'Earum ratione aut molestiae sed qui.', 1, 3, '2025-02-24 15:04:34', '2025-06-02 20:56:34'),
(160, 42, 'https://via.placeholder.com/800x600.png/00aaff?text=furniture+neque', 'Incidunt beatae ea laudantium ut.', 0, 1, '2024-12-20 16:24:58', '2025-04-28 05:42:18'),
(161, 43, 'https://via.placeholder.com/800x600.png/00cc88?text=furniture+corporis', 'Sint reiciendis et aut tenetur et.', 1, 2, '2025-03-07 05:01:51', '2025-06-02 20:56:34'),
(162, 43, 'https://via.placeholder.com/800x600.png/0066ff?text=furniture+quia', 'Eius enim ex commodi ipsa.', 0, 3, '2025-02-02 04:23:38', '2025-04-19 12:12:33'),
(163, 43, 'https://via.placeholder.com/800x600.png/00ddbb?text=furniture+praesentium', 'Et dolorem fugit maiores.', 0, 4, '2025-05-07 12:41:22', '2025-04-18 18:30:35'),
(164, 43, 'https://via.placeholder.com/800x600.png/00cc44?text=furniture+alias', 'Veritatis animi voluptatem inventore nostrum tempora atque.', 0, 5, '2025-02-07 00:17:16', '2024-12-30 17:46:43'),
(165, 43, 'https://via.placeholder.com/800x600.png/00bbcc?text=furniture+excepturi', 'Nostrum doloremque aut sit sint sed molestias.', 1, 2, '2025-03-02 03:52:54', '2025-02-20 23:28:08'),
(166, 44, 'https://via.placeholder.com/800x600.png/004411?text=furniture+exercitationem', 'Laudantium quis nostrum corrupti corrupti.', 1, 4, '2025-02-11 13:46:10', '2025-06-02 20:56:34'),
(167, 44, 'https://via.placeholder.com/800x600.png/00eecc?text=furniture+dolor', 'Voluptas non qui est possimus.', 0, 1, '2025-01-26 21:54:04', '2025-03-21 21:24:33'),
(168, 44, 'https://via.placeholder.com/800x600.png/00eecc?text=furniture+temporibus', 'Dolore quibusdam quasi accusantium ut eum.', 1, 4, '2025-04-20 12:07:47', '2024-12-16 09:13:35'),
(169, 44, 'https://via.placeholder.com/800x600.png/00aa77?text=furniture+tempore', 'Vel neque non tempora est placeat accusantium.', 0, 4, '2025-05-24 22:48:45', '2025-04-13 19:17:45'),
(170, 45, 'https://via.placeholder.com/800x600.png/0022dd?text=furniture+dolores', 'Ullam assumenda culpa possimus eaque sint rerum.', 1, 2, '2025-03-06 21:52:46', '2025-06-02 20:56:34'),
(171, 45, 'https://via.placeholder.com/800x600.png/0033dd?text=furniture+debitis', 'Officia blanditiis ut rerum.', 1, 2, '2025-03-03 13:50:12', '2025-05-03 15:02:43'),
(172, 45, 'https://via.placeholder.com/800x600.png/001188?text=furniture+omnis', 'Totam hic animi eius dicta atque beatae est.', 1, 1, '2025-05-02 04:41:39', '2025-04-03 15:41:28'),
(173, 46, 'https://via.placeholder.com/800x600.png/00ccbb?text=furniture+similique', 'Ipsa perferendis corporis vitae.', 1, 4, '2025-04-04 16:02:11', '2025-06-02 20:56:34'),
(174, 46, 'https://via.placeholder.com/800x600.png/007733?text=furniture+magnam', 'Ab omnis sequi tempora veritatis totam.', 1, 3, '2024-12-10 07:13:06', '2025-05-01 21:32:28'),
(175, 46, 'https://via.placeholder.com/800x600.png/0044bb?text=furniture+accusantium', 'Facilis nobis ad voluptatem nostrum ex.', 0, 4, '2025-03-11 05:32:56', '2024-12-25 14:33:22'),
(176, 46, 'https://via.placeholder.com/800x600.png/0011cc?text=furniture+esse', 'Iure doloribus labore sequi sed sed optio.', 0, 5, '2025-03-31 07:09:50', '2025-02-03 04:22:01'),
(177, 46, 'https://via.placeholder.com/800x600.png/00cc44?text=furniture+animi', 'Aut natus molestias voluptatibus.', 0, 2, '2025-02-02 18:00:26', '2025-04-22 20:29:44'),
(178, 47, 'https://via.placeholder.com/800x600.png/0022ff?text=furniture+dolores', 'Excepturi ut aut et eius laboriosam quod.', 1, 4, '2025-05-23 05:56:47', '2025-06-02 20:56:34'),
(179, 47, 'https://via.placeholder.com/800x600.png/007744?text=furniture+nemo', 'Rerum et cumque et omnis totam.', 0, 3, '2025-03-30 12:41:14', '2025-03-17 10:19:05'),
(180, 48, 'https://via.placeholder.com/800x600.png/005522?text=furniture+vel', 'Ipsa accusamus nihil eos saepe consectetur.', 1, 1, '2025-05-17 21:27:29', '2025-06-02 20:56:34'),
(181, 48, 'https://via.placeholder.com/800x600.png/008899?text=furniture+unde', 'Deserunt laboriosam dolores ad quos ad.', 0, 4, '2025-01-15 02:05:11', '2025-01-20 08:28:48'),
(182, 49, 'https://via.placeholder.com/800x600.png/00cc00?text=furniture+occaecati', 'Est earum sequi molestias.', 1, 3, '2024-12-29 02:22:27', '2025-06-02 20:56:34'),
(183, 49, 'https://via.placeholder.com/800x600.png/006644?text=furniture+et', 'Voluptatem corrupti aut ut dolorem sint.', 0, 2, '2024-12-18 14:59:03', '2025-02-14 09:41:21'),
(184, 49, 'https://via.placeholder.com/800x600.png/00cc55?text=furniture+quia', 'Vero in dolorum ab et.', 1, 4, '2025-04-01 19:53:32', '2025-03-07 05:41:06'),
(185, 49, 'https://via.placeholder.com/800x600.png/008855?text=furniture+est', 'Occaecati occaecati omnis molestiae numquam et rem.', 0, 4, '2025-05-20 15:42:58', '2025-05-15 10:06:03'),
(186, 49, 'https://via.placeholder.com/800x600.png/0011dd?text=furniture+nostrum', 'Adipisci aspernatur laborum reprehenderit.', 0, 2, '2025-02-27 01:24:12', '2025-01-17 02:04:29'),
(187, 50, 'https://via.placeholder.com/800x600.png/005500?text=furniture+esse', 'Sit non labore reiciendis explicabo incidunt voluptatem.', 1, 1, '2024-12-05 17:09:19', '2025-06-02 20:56:34'),
(188, 50, 'https://via.placeholder.com/800x600.png/00cc22?text=furniture+repudiandae', 'Fuga et est quia.', 0, 5, '2025-03-09 22:18:10', '2025-01-31 12:39:43'),
(189, 50, 'https://via.placeholder.com/800x600.png/0033aa?text=furniture+sapiente', 'Facere molestias recusandae doloribus.', 0, 1, '2025-03-03 12:54:18', '2025-04-26 09:20:50'),
(190, 50, 'https://via.placeholder.com/800x600.png/008899?text=furniture+minima', 'Possimus dolorem praesentium commodi.', 1, 1, '2025-05-16 16:27:51', '2025-05-22 07:28:18'),
(191, 50, 'https://via.placeholder.com/800x600.png/008811?text=furniture+quibusdam', 'Sit itaque magni ut.', 1, 5, '2025-02-06 22:29:53', '2025-03-26 10:16:07');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `price_modifier` decimal(10,2) NOT NULL,
  `stock_quantity` int UNSIGNED NOT NULL,
  `image_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `price_modifier`, `stock_quantity`, `image_id`, `created_at`, `updated_at`) VALUES
(1, 1, '97.72', 59, 5, '2025-04-28 12:55:55', '2025-02-19 08:03:29'),
(2, 1, '45.51', 41, 5, '2025-03-12 14:13:26', '2025-02-24 18:00:14'),
(3, 3, '31.29', 7, 12, '2025-05-30 10:34:06', '2025-03-11 09:00:48'),
(4, 3, '33.06', 98, 12, '2025-03-06 08:55:36', '2025-04-12 16:50:22'),
(5, 4, '-2.21', 12, 17, '2025-01-07 03:45:49', '2025-04-02 01:47:21'),
(6, 4, '-47.35', 90, 17, '2025-04-05 18:19:39', '2024-12-07 10:48:15'),
(7, 4, '-21.00', 10, 17, '2025-01-06 23:29:18', '2025-04-28 10:10:11'),
(8, 5, '23.05', 95, 19, '2025-05-30 03:57:43', '2024-12-16 05:46:21'),
(9, 6, '98.67', 47, 26, '2025-03-23 08:20:28', '2025-05-08 21:52:06'),
(10, 8, '56.30', 12, 32, '2025-01-18 17:04:17', '2024-12-02 23:24:57'),
(11, 8, '14.56', 42, 32, '2025-03-01 10:50:32', '2025-05-29 17:51:58'),
(12, 8, '-19.20', 22, 32, '2025-02-21 19:39:55', '2025-01-15 20:23:32'),
(13, 9, '34.29', 66, 35, '2025-05-10 11:32:16', '2025-04-06 10:41:15'),
(14, 9, '-29.57', 5, 35, '2025-03-20 18:22:11', '2025-03-05 17:05:15'),
(15, 9, '-12.56', 19, 35, '2025-05-30 12:52:30', '2025-03-24 01:41:00'),
(16, 11, '78.48', 69, 40, '2025-03-27 08:47:53', '2025-03-27 20:43:35'),
(17, 11, '-46.88', 88, 40, '2025-01-11 22:09:22', '2025-05-23 10:25:27'),
(18, 14, '-47.60', 71, 52, '2025-03-15 12:41:23', '2025-02-15 22:05:59'),
(19, 15, '-41.81', 18, 57, '2025-03-02 19:07:42', '2025-05-27 19:34:16'),
(20, 16, '-29.52', 80, 59, '2025-03-03 09:53:14', '2025-04-05 23:54:39'),
(21, 16, '-44.59', 9, 59, '2025-05-06 04:16:16', '2024-12-12 09:52:39'),
(22, 16, '1.96', 88, 59, '2024-12-12 23:21:10', '2024-12-04 04:48:15'),
(23, 18, '-49.60', 95, 67, '2025-04-29 16:15:42', '2024-12-14 18:16:41'),
(24, 18, '-9.27', 70, 67, '2025-04-20 13:05:58', '2025-03-20 15:34:28'),
(25, 19, '77.57', 15, 69, '2025-03-08 14:04:58', '2025-05-14 04:21:43'),
(26, 19, '-18.24', 62, 69, '2025-02-20 22:19:10', '2025-03-11 16:24:38'),
(27, 19, '-20.62', 91, 69, '2025-03-11 01:56:23', '2025-05-03 08:41:24'),
(28, 20, '15.72', 98, 75, '2025-02-22 00:11:25', '2025-01-04 21:52:51'),
(29, 21, '1.80', 17, 78, '2025-02-17 05:43:52', '2025-05-15 10:53:37'),
(30, 21, '-41.02', 14, 78, '2024-12-26 13:05:29', '2025-03-25 00:41:18'),
(31, 22, '64.82', 62, 82, '2025-01-18 02:13:02', '2025-03-16 19:51:07'),
(32, 22, '42.04', 4, 82, '2025-01-17 17:33:20', '2025-04-11 10:12:30'),
(33, 23, '78.87', 5, 83, '2025-03-19 08:44:56', '2025-01-20 09:59:52'),
(34, 24, '75.98', 19, 86, '2025-03-04 11:10:29', '2025-02-13 05:31:44'),
(35, 25, '-22.50', 71, 88, '2025-02-28 03:10:39', '2025-05-11 04:10:43'),
(36, 25, '21.31', 48, 88, '2025-01-08 02:44:48', '2024-12-16 07:32:19'),
(37, 25, '50.99', 93, 88, '2025-03-27 23:00:06', '2025-02-03 21:20:50'),
(38, 28, '4.57', 51, 102, '2025-04-27 19:43:49', '2024-12-10 21:08:54'),
(39, 30, '68.56', 21, 109, '2024-12-27 23:11:58', '2024-12-23 09:11:09'),
(40, 30, '-45.22', 22, 109, '2025-05-12 07:01:35', '2025-03-08 14:36:16'),
(41, 30, '14.10', 64, 109, '2025-01-01 11:39:50', '2024-12-11 04:03:34'),
(42, 33, '32.25', 64, 122, '2025-05-10 00:43:05', '2024-12-11 06:46:07'),
(43, 33, '43.55', 31, 122, '2025-02-06 01:47:54', '2024-12-07 04:00:52'),
(44, 33, '-8.75', 10, 122, '2025-03-26 09:35:57', '2025-01-15 18:13:15'),
(45, 40, '-38.36', 63, 153, '2025-05-19 06:51:31', '2025-04-15 11:35:16'),
(46, 40, '-44.17', 5, 153, '2025-04-26 10:44:18', '2025-05-07 22:22:10'),
(47, 45, '92.84', 83, 172, '2024-12-18 06:29:52', '2025-02-06 20:57:12'),
(48, 45, '93.78', 97, 172, '2024-12-13 09:07:29', '2025-03-13 04:24:11'),
(49, 46, '31.31', 12, 176, '2025-02-25 03:36:07', '2025-02-05 18:35:00'),
(50, 46, '-21.72', 40, 176, '2025-01-12 12:02:42', '2025-02-08 19:52:28'),
(51, 47, '74.88', 20, 178, '2025-05-10 03:16:09', '2025-04-25 02:57:02'),
(52, 48, '79.51', 88, 181, '2025-03-26 19:03:39', '2025-01-14 23:51:13'),
(53, 49, '-15.47', 40, 185, '2025-03-17 21:38:22', '2025-02-22 21:23:10'),
(54, 49, '80.74', 74, 185, '2025-05-29 17:10:24', '2025-04-18 04:34:42'),
(55, 49, '-25.66', 62, 185, '2025-05-25 07:58:13', '2025-04-29 02:32:28');

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
(1, 1, 4, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(2, 1, 12, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(3, 2, 7, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(4, 2, 10, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(5, 3, 3, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(6, 4, 3, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(7, 4, 9, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(8, 5, 2, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(9, 5, 4, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(10, 6, 15, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(11, 7, 2, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(12, 7, 14, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(13, 8, 2, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(14, 9, 6, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(15, 10, 15, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(16, 11, 6, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(17, 11, 9, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(18, 12, 1, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(19, 13, 4, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(20, 13, 12, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(21, 14, 8, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(22, 14, 15, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(23, 15, 2, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(24, 15, 5, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(25, 16, 2, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(26, 17, 8, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(27, 17, 9, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(28, 18, 8, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(29, 18, 9, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(30, 19, 1, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(31, 20, 4, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(32, 20, 8, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(33, 21, 11, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(34, 22, 8, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(35, 23, 6, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(36, 24, 9, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(37, 25, 13, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(38, 25, 14, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(39, 26, 3, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(40, 26, 8, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(41, 27, 11, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(42, 28, 1, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(43, 28, 13, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(44, 29, 2, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(45, 30, 8, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(46, 30, 15, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(47, 31, 13, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(48, 32, 11, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(49, 33, 3, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(50, 33, 10, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(51, 34, 9, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(52, 35, 3, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(53, 35, 9, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(54, 36, 13, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(55, 37, 4, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(56, 38, 4, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(57, 38, 11, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(58, 39, 10, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(59, 40, 8, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(60, 40, 9, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(61, 41, 7, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(62, 41, 11, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(63, 42, 6, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(64, 42, 13, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(65, 43, 3, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(66, 44, 2, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(67, 45, 8, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(68, 46, 5, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(69, 46, 12, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(70, 47, 4, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(71, 48, 4, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(72, 49, 8, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(73, 49, 9, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(74, 50, 7, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(75, 50, 15, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(76, 51, 3, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(77, 51, 10, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(78, 52, 2, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(79, 52, 12, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(80, 53, 3, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(81, 54, 5, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(82, 55, 4, '2025-06-02 20:56:35', '2025-06-02 20:56:35'),
(83, 55, 5, '2025-06-02 20:56:35', '2025-06-02 20:56:35');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `discount_type` enum('percentage','fixed_amount') COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `max_discount_amount` decimal(15,2) DEFAULT NULL,
  `min_order_value` decimal(15,2) DEFAULT NULL,
  `usage_limit_per_voucher` int UNSIGNED DEFAULT NULL,
  `usage_limit_per_user` int UNSIGNED DEFAULT NULL,
  `times_used` int UNSIGNED NOT NULL DEFAULT '0',
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `applies_to` enum('all_products','specific_products','specific_categories') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'all_products',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `promotion_product`
--

CREATE TABLE `promotion_product` (
  `promotion_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL
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
  `comment` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `order_item_id`, `rating`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 9, 39, 1, 'Quis fugiat sed quae neque. Doloribus maxime quos vitae cupiditate laudantium itaque rerum. Magni necessitatibus at iusto deleniti. Architecto laudantium expedita minus.', 'approved', '2025-06-02 04:30:27', '2025-04-19 09:29:17'),
(2, 5, 18, 40, 4, 'Architecto nesciunt dolor maxime et. Autem dolor suscipit dicta et sint. Necessitatibus cupiditate aut quo error ratione omnis aperiam.', 'rejected', '2025-02-07 16:57:13', '2025-05-06 18:22:14'),
(3, 5, 34, 41, 2, 'Sit excepturi ut nobis quam nam. Laborum ab eaque molestias nihil pariatur ut voluptas ipsum.', 'pending', '2025-06-02 04:00:41', '2025-05-23 02:30:42'),
(4, 5, 3, 42, 3, 'Et aspernatur voluptatem perspiciatis magni numquam consequuntur. Omnis sunt a laboriosam non. Quasi ea numquam incidunt dolore id omnis maiores nobis.', 'pending', '2025-05-09 20:24:58', '2025-05-13 21:19:12'),
(5, 6, 20, 62, 3, 'Libero voluptas aspernatur laboriosam veniam. Debitis voluptatem consequatur saepe beatae omnis totam. Neque facere iste voluptatem aperiam accusamus rerum. Et dolores in vitae aperiam consequuntur rerum.', 'pending', '2025-05-31 12:54:24', '2025-05-26 08:54:39'),
(6, 6, 35, 63, 4, 'Expedita molestiae in impedit quo dignissimos voluptatum ea. Qui consequatur perspiciatis quia in modi consequatur autem quidem. Voluptatibus quae ad ut accusamus fuga ut sint. Modi velit repellat sint modi eaque beatae.', 'rejected', '2025-06-02 12:23:39', '2025-05-31 04:13:55'),
(7, 6, 43, 64, 5, NULL, 'rejected', '2025-03-19 15:47:02', '2025-01-28 16:03:38');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_methods`
--

CREATE TABLE `shipping_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cost` decimal(10,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_methods`
--

INSERT INTO `shipping_methods` (`id`, `name`, `description`, `cost`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Same Day Delivery', 'Beatae impedit sit maxime.', '13.49', 1, '2025-02-04 20:19:54', '2024-07-09 17:36:06'),
(2, 'Express Delivery', 'Autem sapiente eos amet quo voluptates.', '35.82', 1, '2024-06-09 02:13:09', '2024-12-24 16:55:06'),
(3, 'Standard Shipping', 'Aperiam possimus recusandae magni.', '16.81', 1, '2024-09-22 16:37:54', '2025-04-07 09:14:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_status` enum('active','inactive','banned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `phone_number`, `avatar_url`, `account_status`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', '$2y$12$51IcnRbNEz.pl3P8BK16Uu1Ac46qutt3.jFXD8iLvCt7dQMl8KSuW', '(267) 751-1346', 'https://via.placeholder.com/640x480.png/000077?text=people+qui', 'active', 'admin', 'U6Xme4L35w', '2024-11-18 03:44:07', '2025-04-12 19:05:32'),
(2, 'Antonina Kautzer', 'ydeckow@example.org', '$2y$12$Nqa3VQuEevbs8.eKOqlB5uGQzPFHqh.Jk.i3vaTuqEIK4ChcJUPTa', '(716) 467-4836', 'https://via.placeholder.com/640x480.png/001155?text=people+excepturi', 'banned', 'user', 'mxszGdfTsm', '2024-12-08 10:43:17', '2025-04-17 09:57:14'),
(3, 'Marilou Weimann III', 'wcassin@example.com', '$2y$12$dV7kNbY01tjy96N0e5VHb.yE9Kvv3Z4Ljsa2dvtPfci7SYKdVnwPq', '(678) 671-6189', 'https://via.placeholder.com/640x480.png/007733?text=people+a', 'banned', 'user', 'xw3QoprjlU', '2024-06-25 17:57:01', '2024-07-09 05:38:54'),
(4, 'Erling Quigley PhD', 'tohara@example.org', '$2y$12$Qe1CCUZUXLoSEsBZ0AgrD.YjKDqZg/4FP.xY5FF9Mxj/kIf/.LoZ.', '1-443-588-1194', 'https://via.placeholder.com/640x480.png/006611?text=people+esse', 'active', 'user', '0uwCnRj6d6', '2024-12-28 08:51:03', '2025-01-09 22:40:09'),
(5, 'Favian Schinner', 'bstroman@example.org', '$2y$12$GxgRsuG2EsRqT1MAg0srZem9bv69kyHyeU9JQvi0rzBBMdDC2o05y', '+1 (551) 976-0879', 'https://via.placeholder.com/640x480.png/00ffcc?text=people+minus', 'active', 'admin', '4PHsRXTzCr', '2025-02-11 09:56:42', '2024-09-17 21:13:11'),
(6, 'Idell Deckow MD', 'omcdermott@example.net', '$2y$12$Y431Cve2fWhNIbJ/6Wr3VuGJfsLH1OBs1cSSsZYeV9JRNkOOcu6gu', '314-717-6596', 'https://via.placeholder.com/640x480.png/0099aa?text=people+quisquam', 'banned', 'admin', 'WMHfSB3YIz', '2025-01-15 18:26:22', '2024-11-01 17:16:41'),
(7, 'Brendan Gusikowski', 'dandre.jacobs@example.org', '$2y$12$KqkMQlSX1JyT5ILr9wMGqes7so9PMFscer3/Xgx7ckD1USdFoX.ay', '1-681-218-4638', 'https://via.placeholder.com/640x480.png/008833?text=people+facere', 'active', 'admin', 'HbchwYupSb', '2024-12-31 15:21:13', '2024-09-06 12:20:46'),
(8, 'Nikolas Sauer', 'kellie18@example.net', '$2y$12$PBJudPzKiPFX30thu7SEUODk4iqjumaRXDfvFpPGmazvK8GV7qC2.', '1-312-701-3789', 'https://via.placeholder.com/640x480.png/005500?text=people+sapiente', 'inactive', 'admin', 'XznGaKsfQC', '2024-08-30 23:27:44', '2025-04-16 03:18:22'),
(9, 'Imogene Huel', 'gutkowski.alexandre@example.org', '$2y$12$mMh2K9l/TBw.s3hZhpylsuSpsUhLuV3k/OJjC1u7yDOGopxyVdkU6', '1-580-755-0254', 'https://via.placeholder.com/640x480.png/0011cc?text=people+quis', 'active', 'user', 'q2FTLKomVa', '2025-02-05 09:20:06', '2025-05-28 07:27:11'),
(10, 'Easter Gleason', 'marlene.gerhold@example.net', '$2y$12$x9sxdkjZ/17M/AXkUfZWderYdFk6SYFrzhRBADp.HajBLAbzWuD3i', '956-406-7822', 'https://via.placeholder.com/640x480.png/0000ff?text=people+omnis', 'inactive', 'admin', 'C3u5ENsecR', '2024-10-11 15:16:39', '2024-09-22 20:14:34'),
(11, 'Prof. Sheridan Satterfield', 'nhyatt@example.org', '$2y$12$VF0j12SjcUKeUqg0MEyVU.S1vgwGYuk4MXcgJ/n7fbDsWqDSwVxma', '+1 (445) 680-3730', 'https://via.placeholder.com/640x480.png/003388?text=people+velit', 'active', 'admin', 'vtq600oCHU', '2024-08-13 03:39:29', '2024-11-11 09:31:28');

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
(1, 2, '2024-07-05 20:33:27', '2025-04-16 05:02:45'),
(2, 3, '2024-06-07 10:50:35', '2024-06-03 12:07:49'),
(3, 4, '2025-04-01 02:04:35', '2024-11-05 04:01:04'),
(4, 5, '2024-06-08 19:07:58', '2025-03-27 08:11:03'),
(5, 6, '2025-04-11 12:30:16', '2024-11-26 10:37:01'),
(6, 7, '2024-08-23 15:25:45', '2025-05-16 16:11:38'),
(7, 8, '2024-07-10 14:29:47', '2024-10-23 00:47:34'),
(8, 9, '2025-01-03 03:17:33', '2024-10-12 05:55:03'),
(9, 10, '2025-02-03 22:24:00', '2025-04-06 22:45:37'),
(10, 11, '2024-09-01 17:56:35', '2024-09-24 02:31:12');

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_code_unique` (`order_code`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `orders_shipping_method_id_foreign` (`shipping_method_id`);

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
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`),
  ADD KEY `pages_author_id_foreign` (`author_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_methods_code_unique` (`code`);

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
-- Indexes for table `promotion_category`
--
ALTER TABLE `promotion_category`
  ADD PRIMARY KEY (`promotion_id`,`category_id`),
  ADD KEY `promotion_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `promotion_product`
--
ALTER TABLE `promotion_product`
  ADD PRIMARY KEY (`promotion_id`,`product_id`),
  ADD KEY `promotion_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_order_item_id_foreign` (`order_item_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `order_promotion`
--
ALTER TABLE `order_promotion`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `product_variant_attribute_values`
--
ALTER TABLE `product_variant_attribute_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `orders_shipping_method_id_foreign` FOREIGN KEY (`shipping_method_id`) REFERENCES `shipping_methods` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

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
-- Constraints for table `promotion_category`
--
ALTER TABLE `promotion_category`
  ADD CONSTRAINT `promotion_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `promotion_category_promotion_id_foreign` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `promotion_product`
--
ALTER TABLE `promotion_product`
  ADD CONSTRAINT `promotion_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `promotion_product_promotion_id_foreign` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`) ON DELETE CASCADE;

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
