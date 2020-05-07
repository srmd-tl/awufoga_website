-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: devaudiorobot
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.18.04.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `book_audios`
--

DROP TABLE IF EXISTS `book_audios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_audios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` bigint(20) unsigned NOT NULL,
  `book_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `audio_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `book_audios_book_id_foreign` (`book_id`),
  CONSTRAINT `book_audios_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_audios`
--

LOCK TABLES `book_audios` WRITE;
/*!40000 ALTER TABLE `book_audios` DISABLE KEYS */;
/*!40000 ALTER TABLE `book_audios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_pages` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `books_user_id_foreign` (`user_id`),
  CONSTRAINT `books_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapter_audios`
--

DROP TABLE IF EXISTS `chapter_audios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapter_audios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `chapter_id` bigint(20) unsigned NOT NULL,
  `chapter_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `audio_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chapter_audios_chapter_id_foreign` (`chapter_id`),
  CONSTRAINT `chapter_audios_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapter_audios`
--

LOCK TABLES `chapter_audios` WRITE;
/*!40000 ALTER TABLE `chapter_audios` DISABLE KEYS */;
/*!40000 ALTER TABLE `chapter_audios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapters`
--

DROP TABLE IF EXISTS `chapters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` bigint(20) unsigned NOT NULL,
  `page_from` bigint(20) unsigned NOT NULL,
  `page_to` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_pages` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `draft` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chapters_book_id_foreign` (`book_id`),
  KEY `chapters_page_from_foreign` (`page_from`),
  KEY `chapters_page_to_foreign` (`page_to`),
  CONSTRAINT `chapters_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `chapters_page_from_foreign` FOREIGN KEY (`page_from`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `chapters_page_to_foreign` FOREIGN KEY (`page_to`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapters`
--

LOCK TABLES `chapters` WRITE;
/*!40000 ALTER TABLE `chapters` DISABLE KEYS */;
/*!40000 ALTER TABLE `chapters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
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
-- Table structure for table `language_voices`
--

DROP TABLE IF EXISTS `language_voices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `language_voices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ssml_gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `natural_sample_rate_hertz` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `language_voices_language_id_foreign` (`language_id`),
  CONSTRAINT `language_voices_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=272 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language_voices`
--

LOCK TABLES `language_voices` WRITE;
/*!40000 ALTER TABLE `language_voices` DISABLE KEYS */;
INSERT INTO `language_voices` VALUES (259,56,'id-ID-Wavenet-D','FEMALE','2400','2020-04-20 06:52:22','2020-04-20 06:52:22'),(260,56,'id-ID-Wavenet-A','FEMALE','2400','2020-04-20 06:52:22','2020-04-20 06:52:22'),(261,56,'id-ID-Wavenet-B','MALE','2400','2020-04-20 06:52:22','2020-04-20 06:52:22'),(262,56,'id-ID-Wavenet-C','MALE','2400','2020-04-20 06:52:22','2020-04-20 06:52:22'),(263,56,'id-ID-Standard-A','FEMALE','2400','2020-04-20 06:52:22','2020-04-20 06:52:22'),(264,56,'id-ID-Standard-B','MALE','2400','2020-04-20 06:52:22','2020-04-20 06:52:22'),(265,56,'id-ID-Standard-C','MALE','2400','2020-04-20 06:52:22','2020-04-20 06:52:22'),(266,56,'id-ID-Standard-D','FEMALE','2400','2020-04-20 06:52:22','2020-04-20 06:52:22'),(267,57,'de-DE-Standard-F','FEMALE','2400','2020-04-25 21:52:40','2020-04-25 21:52:40'),(268,57,'de-DE-Standard-A','FEMALE','2400','2020-04-25 21:52:40','2020-04-25 21:52:40'),(269,57,'de-DE-Standard-B','MALE','2400','2020-04-25 21:52:40','2020-04-25 21:52:40'),(270,57,'de-DE-Standard-E','MALE','2400','2020-04-25 21:52:40','2020-04-25 21:52:40'),(271,58,'es-ES-Standard-A','FEMALE','2400','2020-04-25 21:52:40','2020-04-25 21:52:40');
/*!40000 ALTER TABLE `language_voices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `membership_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `languages_membership_id_foreign` (`membership_id`),
  CONSTRAINT `languages_membership_id_foreign` FOREIGN KEY (`membership_id`) REFERENCES `memberships` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (56,4,'Indonesian','id-ID','2020-04-20 06:52:22','2020-04-20 06:52:22'),(57,5,'German','de-DE','2020-04-25 21:52:40','2020-04-25 21:52:40'),(58,5,'Spanish','es-ES','2020-04-25 21:52:40','2020-04-25 21:52:40');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `memberships`
--

DROP TABLE IF EXISTS `memberships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `memberships` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voice_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `characters_length` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `memberships_package_id_foreign` (`package_id`),
  CONSTRAINT `memberships_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memberships`
--

LOCK TABLES `memberships` WRITE;
/*!40000 ALTER TABLE `memberships` DISABLE KEYS */;
INSERT INTO `memberships` VALUES (1,1,'s','1','11','1','11111111111111',NULL,NULL,NULL),(4,5,'xyz','1','123','Both','6000','2020-04-20 06:52:22','2020-04-20 06:52:22',NULL),(5,7,'xyz','1','123','Standard','6000','2020-04-25 21:52:40','2020-04-25 21:52:40',NULL);
/*!40000 ALTER TABLE `memberships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_07_25_101840_create_packages_table',1),(2,'2014_07_25_101850_create_memberships_table',1),(3,'2014_10_12_000000_create_users_table',1),(4,'2014_10_12_100000_create_password_resets_table',1),(5,'2019_07_24_044959_create_books_table',1),(6,'2019_07_24_050224_create_pages_table',1),(7,'2019_07_24_050745_create_chapters_table',1),(8,'2019_07_30_100029_create_jobs_table',1),(9,'2019_08_01_095039_create_voices_table',1),(10,'2019_08_01_095056_create_languages_table',1),(11,'2019_08_02_053843_create_language_voices_table',1),(12,'2019_08_07_051548_create_page_audios_table',1),(13,'2019_08_07_104830_create_chapter_audios_table',1),(14,'2019_08_07_104839_create_book_audios_table',1),(15,'2020_02_08_161645_create_subscribe_package_table',1),(16,'2020_03_10_134425_create_orders_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `membership_id` bigint(20) unsigned NOT NULL,
  `receipt_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_membership_id_foreign` (`membership_id`),
  CONSTRAINT `orders_membership_id_foreign` FOREIGN KEY (`membership_id`) REFERENCES `memberships` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,9,4,'NW9INN89','2020-04-20 06:56:57','2020-04-20 06:56:57'),(2,10,5,'PQMQU9S6','2020-04-25 21:58:13','2020-04-25 21:58:13');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `rebill_commission` int(11) NOT NULL,
  `rebill_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `packages_sku_unique` (`sku`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages`
--

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` VALUES (1,'124','Basic','Dummy Demo',200,25,205,'2020-04-15 20:58:48','2020-04-15 20:58:48',NULL),(2,'pkgGeek','PackgeGeek','PackgeGeek',100,1,150,'2020-04-16 16:43:12','2020-04-20 06:42:52','2020-04-20 06:42:52'),(3,'pkg','pkg','pkg',1,0,1,'2020-04-17 06:40:20','2020-04-20 06:42:50','2020-04-20 06:42:50'),(4,'pkr','Basic','Dumy',200,25,250,'2020-04-20 06:44:53','2020-04-20 06:45:23','2020-04-20 06:45:23'),(5,'12341234','Premiume','Dummy',600,25,300,'2020-04-20 06:50:24','2020-04-20 06:50:24',NULL),(6,'Foogle','Another','jsdkjf',600,25,300,'2020-04-20 06:51:19','2020-04-20 06:51:19',NULL),(7,'111','Standard','Dummy Description',100,25,125,'2020-04-25 21:51:29','2020-04-25 21:51:29',NULL);
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_audios`
--

DROP TABLE IF EXISTS `page_audios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_audios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` bigint(20) unsigned NOT NULL,
  `page_id` bigint(20) unsigned NOT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `audio_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `page_audios_book_id_foreign` (`book_id`),
  KEY `page_audios_page_id_foreign` (`page_id`),
  CONSTRAINT `page_audios_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `page_audios_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_audios`
--

LOCK TABLES `page_audios` WRITE;
/*!40000 ALTER TABLE `page_audios` DISABLE KEYS */;
/*!40000 ALTER TABLE `page_audios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` bigint(20) unsigned NOT NULL,
  `page_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_book_id_foreign` (`book_id`),
  CONSTRAINT `pages_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribe_package`
--

DROP TABLE IF EXISTS `subscribe_package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribe_package` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `subscribe_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `membership_id` bigint(20) unsigned NOT NULL,
  `package_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribe_package`
--

LOCK TABLES `subscribe_package` WRITE;
/*!40000 ALTER TABLE `subscribe_package` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscribe_package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `membership_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `characters_count` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `isAdmin` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_membership_id_foreign` (`membership_id`),
  CONSTRAINT `users_membership_id_foreign` FOREIGN KEY (`membership_id`) REFERENCES `memberships` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'','Admin@gmail.com',NULL,'0','$2y$10$Bl0tIhIAs89CMLPgahwRXOTcduc99pYLmQ3Vja5CD4eQ5OizqJ4Wq','1',1,NULL,NULL,NULL,NULL),(9,4,'Musa Raza','blue_eyes.1236143@yahoo.com',NULL,'0','$2y$10$O72px83CsWb.jqXfs8tkx.CqAkKF/YJmRJ99T84g2E8QAVNRItBD2','1',NULL,NULL,'2020-04-20 06:56:57','2020-04-20 06:56:57',NULL),(10,5,'Musa Raza','sra.gillani@gmail.com',NULL,'0','$2y$10$9Ngbzl2PwvmOX7mzkrA39egDSCKQOVIOJ3UGvwAUIT5V4D3PUMRb2','1',NULL,NULL,'2020-04-25 21:58:13','2020-04-25 21:58:13',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voices`
--

DROP TABLE IF EXISTS `voices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ssml_gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `natural_sample_rate_hertz` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voices`
--

LOCK TABLES `voices` WRITE;
/*!40000 ALTER TABLE `voices` DISABLE KEYS */;
INSERT INTO `voices` VALUES (1,'German','de-DE','de-DE-Wavenet-F','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(2,'Indonesian','id-ID','id-ID-Wavenet-D','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(3,'Arabic','ar-XA','ar-XA-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(4,'Arabic','ar-XA','ar-XA-Wavenet-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(5,'Arabic','ar-XA','ar-XA-Wavenet-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(6,'Mandarin Chinese','cmn-CN','cmn-CN-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(7,'Mandarin Chinese','cmn-CN','cmn-CN-Wavenet-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(8,'Mandarin Chinese','cmn-CN','cmn-CN-Wavenet-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(9,'Mandarin Chinese','cmn-CN','cmn-CN-Wavenet-D','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(10,'Taiwanese Mandarin','cmn-TW','cmn-TW-Wavenet-A-Alpha','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(11,'Taiwanese Mandarin','cmn-TW','cmn-TW-Wavenet-B-Alpha','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(12,'Taiwanese Mandarin','cmn-TW','cmn-TW-Wavenet-C-Alpha','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(13,'Czech (Czech Republic)','cs-CZ','cs-CZ-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(14,'Danish (Denmark)','da-DK','da-DK-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(15,'German','de-DE','de-DE-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(16,'German','de-DE','de-DE-Wavenet-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(17,'German','de-DE','de-DE-Wavenet-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(18,'German','de-DE','de-DE-Wavenet-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(19,'German','de-DE','de-DE-Wavenet-E','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(20,'Greek','el-GR','el-GR-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(21,'English, Australia','en-AU','en-AU-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(22,'English, Australia','en-AU','en-AU-Wavenet-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(23,'English, Australia','en-AU','en-AU-Wavenet-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(24,'English, Australia','en-AU','en-AU-Wavenet-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(25,'English, United Kingdom','en-GB','en-GB-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(26,'English, United Kingdom','en-GB','en-GB-Wavenet-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(27,'English, United Kingdom','en-GB','en-GB-Wavenet-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(28,'English, United Kingdom','en-GB','en-GB-Wavenet-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(29,'English, India','en-IN','en-IN-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(30,'English, India','en-IN','en-IN-Wavenet-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(31,'English, India','en-IN','en-IN-Wavenet-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(32,'English, United States','en-US','en-US-Wavenet-A','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(33,'English, United States','en-US','en-US-Wavenet-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(34,'English, United States','en-US','en-US-Wavenet-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(35,'English, United States','en-US','en-US-Wavenet-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(36,'English, United States','en-US','en-US-Wavenet-E','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(37,'English, United States','en-US','en-US-Wavenet-F','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(38,'Finnish (Finland)','fi-FI','fi-FI-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(39,'Filipino; Pilipino','fil-PH','fil-PH-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(40,'French, Canada','fr-CA','fr-CA-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(41,'French, Canada','fr-CA','fr-CA-Wavenet-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(42,'French, Canada','fr-CA','fr-CA-Wavenet-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(43,'French, Canada','fr-CA','fr-CA-Wavenet-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(44,'French (Standard)','fr-FR','fr-FR-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(45,'French (Standard)','fr-FR','fr-FR-Wavenet-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(46,'French (Standard)','fr-FR','fr-FR-Wavenet-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(47,'French (Standard)','fr-FR','fr-FR-Wavenet-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(48,'French (Standard)','fr-FR','fr-FR-Wavenet-E','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(49,'Hindi','hi-IN','hi-IN-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(50,'Hindi','hi-IN','hi-IN-Wavenet-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(51,'Hindi','hi-IN','hi-IN-Wavenet-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(52,'Hungarian','hu-HU','hu-HU-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(53,'Indonesian','id-ID','id-ID-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(54,'Indonesian','id-ID','id-ID-Wavenet-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(55,'Indonesian','id-ID','id-ID-Wavenet-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(56,'Italian','it-IT','it-IT-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(57,'Italian','it-IT','it-IT-Wavenet-B','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(58,'Italian','it-IT','it-IT-Wavenet-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(59,'Italian','it-IT','it-IT-Wavenet-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(60,'Japanese','ja-JP','ja-JP-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(61,'Japanese','ja-JP','ja-JP-Wavenet-B','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(62,'Japanese','ja-JP','ja-JP-Wavenet-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(63,'Japanese','ja-JP','ja-JP-Wavenet-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(64,'Korean (Korea)','ko-KR','ko-KR-Wavenet-B','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(65,'Korean (Korea)','ko-KR','ko-KR-Wavenet-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(66,'Korean (Korea)','ko-KR','ko-KR-Wavenet-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(67,'Korean (Korea)','ko-KR','ko-KR-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(68,'Norwegian Bokmal','nb-no','nb-no-Wavenet-E','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(69,'Norwegian (Bokm?l) - Norway','nb-NO','nb-NO-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(70,'Norwegian (Bokm?l) - Norway','nb-NO','nb-NO-Wavenet-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(71,'Norwegian (Bokm?l) - Norway','nb-NO','nb-NO-Wavenet-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(72,'Norwegian (Bokm?l) - Norway','nb-NO','nb-NO-Wavenet-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(73,'Dutch - The Netherlands','nl-NL','nl-NL-Wavenet-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(74,'Dutch - The Netherlands','nl-NL','nl-NL-Wavenet-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(75,'Dutch - The Netherlands','nl-NL','nl-NL-Wavenet-D','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(76,'Dutch - The Netherlands','nl-NL','nl-NL-Wavenet-E','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(77,'Dutch - The Netherlands','nl-NL','nl-NL-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(78,'Polish - Poland','pl-PL','pl-PL-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(79,'Polish - Poland','pl-PL','pl-PL-Wavenet-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(80,'Polish - Poland','pl-PL','pl-PL-Wavenet-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(81,'Polish - Poland','pl-PL','pl-PL-Wavenet-D','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(82,'Polish - Poland','pl-PL','pl-PL-Wavenet-E','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(83,'Portuguese, Brazilian','pt-BR','pt-BR-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(84,'Portuguese','pt-PT','pt-PT-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(85,'Portuguese','pt-PT','pt-PT-Wavenet-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(86,'Portuguese','pt-PT','pt-PT-Wavenet-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(87,'Portuguese','pt-PT','pt-PT-Wavenet-D','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(88,'Russian - Russia','ru-RU','ru-RU-Wavenet-E','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(89,'Russian - Russia','ru-RU','ru-RU-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(90,'Russian - Russia','ru-RU','ru-RU-Wavenet-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(91,'Russian - Russia','ru-RU','ru-RU-Wavenet-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(92,'Russian - Russia','ru-RU','ru-RU-Wavenet-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(93,'Slovak - Slovakia','sk-SK','sk-SK-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(94,'Swedish','sv-SE','sv-SE-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(95,'Turkish - Turkey','tr-TR','tr-TR-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(96,'Turkish - Turkey','tr-TR','tr-TR-Wavenet-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(97,'Turkish - Turkey','tr-TR','tr-TR-Wavenet-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(98,'Turkish - Turkey','tr-TR','tr-TR-Wavenet-D','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(99,'Turkish - Turkey','tr-TR','tr-TR-Wavenet-E','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(100,'Ukrainian - Ukraine','uk-UA','uk-UA-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(101,'Vietnamese (Viet Nam)','vi-VN','vi-VN-Wavenet-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(102,'Vietnamese (Viet Nam)','vi-VN','vi-VN-Wavenet-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(103,'Vietnamese (Viet Nam)','vi-VN','vi-VN-Wavenet-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(104,'Vietnamese (Viet Nam)','vi-VN','vi-VN-Wavenet-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(105,'German','de-DE','de-DE-Standard-F','FEMALE','22050','2020-03-11 10:18:38','2020-03-11 10:18:38'),(106,'Spanish','es-ES','es-ES-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(107,'Arabic','ar-XA','ar-XA-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(108,'Arabic','ar-XA','ar-XA-Standard-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(109,'Arabic','ar-XA','ar-XA-Standard-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(110,'Arabic','ar-XA','ar-XA-Standard-D','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(111,'French (Standard)','fr-FR','fr-FR-Standard-E','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(112,'Italian','it-IT','it-IT-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(113,'Russian - Russia','ru-RU','ru-RU-Standard-E','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(114,'Russian - Russia','ru-RU','ru-RU-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(115,'Russian - Russia','ru-RU','ru-RU-Standard-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(116,'Russian - Russia','ru-RU','ru-RU-Standard-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(117,'Russian - Russia','ru-RU','ru-RU-Standard-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(118,'Mandarin Chinese','cmn-CN','cmn-CN-Standard-D','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(119,'Mandarin Chinese','cmn-CN','cmn-CN-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(120,'Mandarin Chinese','cmn-CN','cmn-CN-Standard-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(121,'Mandarin Chinese','cmn-CN','cmn-CN-Standard-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(122,'Taiwanese Mandarin','cmn-TW','cmn-TW-Standard-A-Alpha','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(123,'Taiwanese Mandarin','cmn-TW','cmn-TW-Standard-B-Alpha','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(124,'Taiwanese Mandarin','cmn-TW','cmn-TW-Standard-C-Alpha','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(125,'Korean (Korea)','ko-KR','ko-KR-Standard-A','FEMALE','22050','2020-03-11 10:18:38','2020-03-11 10:18:38'),(126,'Korean (Korea)','ko-KR','ko-KR-Standard-B','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(127,'Korean (Korea)','ko-KR','ko-KR-Standard-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(128,'Korean (Korea)','ko-KR','ko-KR-Standard-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(129,'Japanese','ja-JP','ja-JP-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(130,'Japanese','ja-JP','ja-JP-Standard-B','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(131,'Japanese','ja-JP','ja-JP-Standard-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(132,'Japanese','ja-JP','ja-JP-Standard-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(133,'Vietnamese (Viet Nam)','vi-VN','vi-VN-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(134,'Vietnamese (Viet Nam)','vi-VN','vi-VN-Standard-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(135,'Vietnamese (Viet Nam)','vi-VN','vi-VN-Standard-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(136,'Vietnamese (Viet Nam)','vi-VN','vi-VN-Standard-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(137,'Filipino; Pilipino','fil-PH','fil-PH-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(138,'Indonesian','id-ID','id-ID-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(139,'Indonesian','id-ID','id-ID-Standard-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(140,'Indonesian','id-ID','id-ID-Standard-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(141,'Indonesian','id-ID','id-ID-Standard-D','FEMALE','22050','2020-03-11 10:18:38','2020-03-11 10:18:38'),(142,'Dutch - The Netherlands','nl-NL','nl-NL-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(143,'Dutch - The Netherlands','nl-NL','nl-NL-Standard-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(144,'Dutch - The Netherlands','nl-NL','nl-NL-Standard-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(145,'Dutch - The Netherlands','nl-NL','nl-NL-Standard-D','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(146,'Dutch - The Netherlands','nl-NL','nl-NL-Standard-E','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(147,'Czech (Czech Republic)','cs-CZ','cs-CZ-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(148,'Greek','el-GR','el-GR-Standard-A','FEMALE','22050','2020-03-11 10:18:38','2020-03-11 10:18:38'),(149,'Portuguese, Brazilian','pt-BR','pt-BR-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(150,'Hungarian','hu-HU','hu-HU-Standard-A','FEMALE','22050','2020-03-11 10:18:38','2020-03-11 10:18:38'),(151,'Polish - Poland','pl-PL','pl-PL-Standard-E','FEMALE','22050','2020-03-11 10:18:38','2020-03-11 10:18:38'),(152,'Polish - Poland','pl-PL','pl-PL-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(153,'Polish - Poland','pl-PL','pl-PL-Standard-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(154,'Polish - Poland','pl-PL','pl-PL-Standard-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(155,'Polish - Poland','pl-PL','pl-PL-Standard-D','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(156,'Slovak - Slovakia','sk-SK','sk-SK-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(157,'Turkish - Turkey','tr-TR','tr-TR-Standard-A','FEMALE','22050','2020-03-11 10:18:38','2020-03-11 10:18:38'),(158,'Turkish - Turkey','tr-TR','tr-TR-Standard-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(159,'Turkish - Turkey','tr-TR','tr-TR-Standard-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(160,'Turkish - Turkey','tr-TR','tr-TR-Standard-D','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(161,'Turkish - Turkey','tr-TR','tr-TR-Standard-E','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(162,'Ukrainian - Ukraine','uk-UA','uk-UA-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(163,'English, India','en-IN','en-IN-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(164,'English, India','en-IN','en-IN-Standard-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(165,'English, India','en-IN','en-IN-Standard-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(166,'Hindi','hi-IN','hi-IN-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(167,'Hindi','hi-IN','hi-IN-Standard-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(168,'Hindi','hi-IN','hi-IN-Standard-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(169,'Danish (Denmark)','da-DK','da-DK-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(170,'Finnish (Finland)','fi-FI','fi-FI-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(171,'Portuguese','pt-PT','pt-PT-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(172,'Portuguese','pt-PT','pt-PT-Standard-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(173,'Portuguese','pt-PT','pt-PT-Standard-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(174,'Portuguese','pt-PT','pt-PT-Standard-D','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(175,'Norwegian Bokmal','nb-no','nb-no-Standard-E','FEMALE','22050','2020-03-11 10:18:38','2020-03-11 10:18:38'),(176,'Norwegian (Bokm?l) - Norway','nb-NO','nb-NO-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(177,'Norwegian (Bokm?l) - Norway','nb-NO','nb-NO-Standard-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(178,'Norwegian (Bokm?l) - Norway','nb-NO','nb-NO-Standard-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(179,'Norwegian (Bokm?l) - Norway','nb-NO','nb-NO-Standard-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(180,'Swedish','sv-SE','sv-SE-Standard-A','FEMALE','22050','2020-03-11 10:18:38','2020-03-11 10:18:38'),(181,'English, United Kingdom','en-GB','en-GB-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(182,'English, United Kingdom','en-GB','en-GB-Standard-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(183,'English, United Kingdom','en-GB','en-GB-Standard-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(184,'English, United Kingdom','en-GB','en-GB-Standard-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(185,'English, United States','en-US','en-US-Standard-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(186,'English, United States','en-US','en-US-Standard-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(187,'English, United States','en-US','en-US-Standard-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(188,'English, United States','en-US','en-US-Standard-E','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(189,'German','de-DE','de-DE-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(190,'German','de-DE','de-DE-Standard-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(191,'German','de-DE','de-DE-Standard-E','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(192,'English, Australia','en-AU','en-AU-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(193,'English, Australia','en-AU','en-AU-Standard-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(194,'English, Australia','en-AU','en-AU-Standard-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(195,'English, Australia','en-AU','en-AU-Standard-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(196,'French, Canada','fr-CA','fr-CA-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(197,'French, Canada','fr-CA','fr-CA-Standard-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(198,'French, Canada','fr-CA','fr-CA-Standard-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(199,'French, Canada','fr-CA','fr-CA-Standard-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(200,'French (Standard)','fr-FR','fr-FR-Standard-A','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(201,'French (Standard)','fr-FR','fr-FR-Standard-B','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(202,'French (Standard)','fr-FR','fr-FR-Standard-C','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(203,'French (Standard)','fr-FR','fr-FR-Standard-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(204,'Italian','it-IT','it-IT-Standard-B','FEMALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(205,'Italian','it-IT','it-IT-Standard-C','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38'),(206,'Italian','it-IT','it-IT-Standard-D','MALE','24000','2020-03-11 10:18:38','2020-03-11 10:18:38');
/*!40000 ALTER TABLE `voices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'devaudiorobot'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-30 23:43:11
