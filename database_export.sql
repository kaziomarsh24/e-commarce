-- MySQL dump 10.13  Distrib 9.5.0, for macos26.0 (arm64)
--
-- Host: 127.0.0.1    Database: ecommerce_db
-- ------------------------------------------------------
-- Server version	9.5.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Audio & Sound','audio-sound','categories/audio-sound-category_I1icfOVrktYq.webp',NULL,1,'2026-11-07 22:52:02','2026-11-07 22:52:02',NULL),(2,'Computers & Laptops','computers-laptops','categories/57c72db77b6edb365e88b8ade451eefc_xVLq1uOaM5Cc.webp',NULL,1,'2026-11-07 23:10:43','2026-11-07 23:10:43',NULL),(3,'Smartphones & Wearables','smartphones-wearables','categories/electronics-smartphones-wearables-1_g2ebB9QVOukt.webp',NULL,1,'2026-11-07 23:26:10','2026-11-07 23:26:10',NULL),(4,'Gaming Gear','gaming-gear','categories/force-1_oyayd49QP4Sr.webp',NULL,1,'2026-11-07 23:36:18','2026-11-07 23:36:18',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_11_06_193145_create_categories_table',1),(5,'2026_11_06_193625_create_subcategories_table',1),(6,'2026_11_06_193655_create_products_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `subcategory_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_images` json DEFAULT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `new_price` decimal(10,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_subcategory_id_foreign` (`subcategory_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,2,'Sony WH-1000XM5 Wireless Headphones','sony-wh-1000xm5-wireless-headphones','Industry-leading noise canceling with two processors and 8 microphones. Up to 30-hour battery life with quick charging. Crystal clear hands-free calling with 4 beamforming microphones.','products/hero-01_AH5ZE6zEb81C.webp','[\"products/gallery/sony-headphones-gallery1_exY4rIczHneY.webp\", \"products/gallery/sony-headphones-gallery2_ivCpTOppd2Ny.webp\"]',38000.00,32500.00,1,'2026-11-07 22:55:20','2026-11-07 23:21:33',NULL),(2,1,1,'Apple AirPods Pro (2nd Gen)','apple-airpods-pro-2nd-gen','Up to 2x more Active Noise Cancellation. Transparency mode lets you hear the world around you. Personalized Spatial Audio with dynamic head tracking places sound all around you.','products/111851-sp880-airpods-pro-2nd-gen_wf94WhvSqDMd.webp','[\"products/gallery/airpods-earbuds-gallery1_XDwMwB07uCO8.webp\", \"products/gallery/airpods-earbuds-main_ZwYr5TCrsEBI.webp\"]',28500.00,22999.00,1,'2026-11-07 22:59:02','2026-11-07 23:21:24',NULL),(3,1,3,'JBL Charge 5 Portable Bluetooth Speaker','jbl-charge-5-portable-bluetooth-speaker','Take the party with you no matter what the weather. The JBL Charge 5 speaker delivers bold JBL Original Pro Sound, with an optimized long excursion driver and dual bass radiators.','products/jbl-charge5-hero-blue-01_SgAsFD6QLZEQ.webp','[\"products/gallery/jbl-charge5-front-red-0080-x2_UC0Kxuhh3zpm.webp\", \"products/gallery/jbl-charge5-hero-red-0029-x2_485Q7YA377C0.webp\"]',17500.00,15200.00,1,'2026-11-07 23:04:37','2026-11-07 23:04:37',NULL),(4,2,4,'Apple MacBook Air M3 (13-inch)','apple-macbook-air-m3-13-inch','Strikingly thin and fast MacBook Air with M3 chip. Delivers up to 18 hours of battery life and a stunning Liquid Retina display with 500 nits of brightness.','products/m3-macbook-air-13-inch-pp-header_fMkTcmVW3Iz6.webp','[\"products/gallery/macbook-air_hhl2MKsTWlA9.webp\"]',145000.00,132000.00,1,'2026-11-07 23:16:27','2026-11-07 23:16:27',NULL),(5,2,5,'Keychron K2 Wireless Mechanical Keyboard','keychron-k2-wireless-mechanical-keyboard','75% layout compact Bluetooth wireless mechanical keyboard designed for Mac and Windows. Features hot-swappable Gateron G Pro mechanical switches with RGB backlight.','products/keychron-k2-wireless-mechanical-keyboard-for-mac-windows-ios-gateron-switch-brown-with-type-c-rgb-white-backlight-53059406-af50-40d8-8566-c3b5f1e85a62_mkspdNGWvq2N.webp','[\"products/gallery/keychron-k2-wireless-mechanical-keyboard-for-mac-windows-ios-gateron-switch-red-with-type-c-rgb-white-backlight-9cb9d3e6-a5ac-4ac5-becb-079c7103ed2f_4x1ABmqrGyTp.webp\", \"products/gallery/keychron-k2-wireless-mechanical-keyboard-for-mac-windows-ios-gateron-switch-red-with-type-c-rgb-white-backlight-exclusive-color_U12YFszLP1mh.webp\"]',9500.00,8200.00,1,'2026-11-07 23:19:52','2026-11-07 23:19:52',NULL),(6,2,6,'Logitech MX Master 3S Wireless Mouse','logitech-mx-master-3s-wireless-mouse','Master series precision mouse with Quiet Clicks and an 8000 DPI track-on-glass sensor. MagSpeed electromagnetic scrolling for remarkable speed and precision.','products/mx-master-3s-bluetooth-edition-top-view-black-new-1_9Wx05T8jh22w.webp','[\"products/gallery/mx-master-3s-bluetooth-edition-rear-view-black-new-7_rblovOF0SBK3.webp\", \"products/gallery/mx-master-3s-bluetooth-edition-left-profile-view-black-new-4_adpjrxgLso77.webp\"]',12500.00,10999.00,1,'2026-11-07 23:23:59','2026-11-07 23:23:59',NULL),(7,3,7,'Samsung Galaxy S24 Ultra','samsung-galaxy-s24-ultra','Meet Galaxy S24 Ultra with Galaxy AI, a durable titanium frame, 200MP camera, and built-in S Pen. Powered by Snapdragon 8 Gen 3 for Galaxy.','products/samsung-galaxy-s24-ultra-price-in-bangladesh-titanium-orange_YPXfOFlWggwP.webp','[\"products/gallery/samsung-galaxy-s24-ultra-price-in-bangladesh-titanium-green_de7UdmDTPxAf.webp\", \"products/gallery/samsung-galaxy-s24-ultra-price-in-bangladesh-titanium-blue_035a6P3h6GGN.webp\"]',165000.00,148000.00,1,'2026-11-07 23:30:18','2026-11-07 23:30:18',NULL),(8,3,7,'Phone 18 Pro Max','phone-18-pro-max','The iPhone 18 Pro Max display has rounded corners that follow a beautiful curved design, and these corners are within a standard rectangle. When measured as a standard rectangular shape, the screen is 6.86 inches diagonally (actual viewable area is less).','products/iphone-18-pro-max_VAZWosXyt1tf.webp','[\"products/gallery/apple-iphone-18-pro-max-full-display-side-image_4m6p77bq1sfj.webp\", \"products/gallery/apple-iphone-18-pro-max-burgundy-official-color-image_OvpKrVxFiL0o.webp\"]',306000.00,239999.00,1,'2026-11-07 23:34:14','2026-11-07 23:34:14',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subcategories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subcategories_slug_unique` (`slug`),
  KEY `subcategories_category_id_foreign` (`category_id`),
  CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategories`
--

LOCK TABLES `subcategories` WRITE;
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
INSERT INTO `subcategories` VALUES (1,1,'Wireless Earbuds','wireless-earbuds',1,'2026-11-07 22:52:32','2026-11-07 22:52:32',NULL),(2,1,'Over-Ear Headphones','over-ear-headphones',1,'2026-11-07 22:52:54','2026-11-07 22:52:54',NULL),(3,1,'Bluetooth Speakers','bluetooth-speakers',1,'2026-11-07 22:53:06','2026-11-07 22:53:06',NULL),(4,2,'Gaming Laptops','gaming-laptops',1,'2026-11-07 23:11:44','2026-11-07 23:11:44',NULL),(5,2,'Mechanical Keyboards','mechanical-keyboards',1,'2026-11-07 23:11:53','2026-11-07 23:11:53',NULL),(6,2,'Ergonomic Mice','ergonomic-mice',1,'2026-11-07 23:12:04','2026-11-07 23:12:04',NULL),(7,3,'Flagship Phones','flagship-phones',1,'2026-11-07 23:26:43','2026-11-07 23:26:43',NULL),(8,3,'Smart Watches','smart-watches',1,'2026-11-07 23:27:00','2026-11-07 23:27:00',NULL),(9,3,'Power Banks & Chargers','power-banks-chargers',1,'2026-11-07 23:27:16','2026-11-07 23:27:16',NULL),(10,4,'Gaming Controllers','gaming-controllers',1,'2026-11-07 23:36:36','2026-11-07 23:36:36',NULL),(11,4,'Streaming Microphones','streaming-microphones',1,'2026-11-07 23:36:49','2026-11-07 23:36:49',NULL),(12,4,'Gaming Headsets','gaming-headsets',1,'2026-11-07 23:37:15','2026-11-07 23:37:15',NULL);
/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Kazi Omar Faruk','admin@banglapuzzle.com',NULL,'$2y$12$LdPas7KsmDPQlkqb1zNsMuHvXil2LYA2u3Du1uU9BQ84OaQfdxFki',NULL,'2026-11-07 22:44:28','2026-11-07 22:44:28');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-08 11:42:24
