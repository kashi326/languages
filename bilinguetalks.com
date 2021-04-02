-- MariaDB dump 10.17  Distrib 10.4.12-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: LanguagesApp
-- ------------------------------------------------------
-- Server version	10.4.12-MariaDB-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comments_on_teacher`
--

DROP TABLE IF EXISTS `comments_on_teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments_on_teacher` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `star` tinyint(4) NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_on_teacher_teacher_id_foreign` (`teacher_id`),
  KEY `comments_on_teacher_user_id_foreign` (`user_id`),
  CONSTRAINT `comments_on_teacher_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`),
  CONSTRAINT `comments_on_teacher_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments_on_teacher`
--

LOCK TABLES `comments_on_teacher` WRITE;
/*!40000 ALTER TABLE `comments_on_teacher` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments_on_teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discussions`
--

DROP TABLE IF EXISTS `discussions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discussions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upvote` int(11) NOT NULL DEFAULT 0,
  `downvote` int(11) NOT NULL DEFAULT 0,
  `language_id` bigint(20) unsigned NOT NULL,
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discussions`
--

LOCK TABLES `discussions` WRITE;
/*!40000 ALTER TABLE `discussions` DISABLE KEYS */;
INSERT INTO `discussions` VALUES (6,2,'this is some long heading. which is actually short 1','shdfjkashdkfhaskdhfakjsdhfkashdfkahsdkfjhaskdjfhkasjdfhiehahfjkasdhfkahsdkjfhalkhdfklasdhfjasdhfjsadhfjkahsdkfhasdjfahsdfbnmcbvmbfkjsfhkEIO;jslajsdfksdhfkjsdhfkajdhfkjahd',NULL,5,3,0,'','2020-09-27 12:28:27','2020-09-27 12:28:27'),(7,2,'this is some long heading. which is actually short 2','shdfjkashdkfhaskdhfakjsdhfkashdfkahsdkfjhaskdjfhkasjdfhiehahfjkasdhfkahsdkjfhalkhdfklasdhfjasdhfjsadhfjkahsdkfhasdjfahsdfbnmcbvmbfkjsfhkEIO;jslajsdfksdhfkjsdhfkajdhfkjahd',NULL,10,2,0,'','2020-09-27 12:30:27','2020-09-27 12:28:27'),(8,2,'this is some long heading. which is actually short 3','shdfjkashdkfhaskdhfakjsdhfkashdfkahsdkfjhaskdjfhkasjdfhiehahfjkasdhfkahsdkjfhalkhdfklasdhfjasdhfjsadhfjkahsdkfhasdjfahsdfbnmcbvmbfkjsfhkEIO;jslajsdfksdhfkjsdhfkajdhfkjahd',NULL,15,3,0,'','2020-09-27 12:35:27','2020-09-27 12:28:27'),(9,2,'this is some long heading. which is actually short 4','shdfjkashdkfhaskdhfakjsdhfkashdfkahsdkfjhaskdjfhkasjdfhiehahfjkasdhfkahsdkjfhalkhdfklasdhfjasdhfjsadhfjkahsdkfhasdjfahsdfbnmcbvmbfkjsfhkEIO;jslajsdfksdhfkjsdhfkajdhfkjahd',NULL,5,20,15,'','2020-09-27 12:28:27','2020-09-27 12:28:27'),(11,2,'this is some long heading. which is actually short5','shdfjkashdkfhaskdhfakjsdhfkashdfkahsdkfjhaskdjfhkasjdfhiehahfjkasdhfkahsdkjfhalkhdfklasdhfjasdhfjsadhfjkahsdkfhasdjfahsdfbnmcbvmbfkjsfhkEIO;jslajsdfksdhfkjsdhfkajdhfkjahd',NULL,5,10,15,'','2020-09-27 12:28:27','2020-09-27 12:28:27'),(12,2,'this is some long heading. which is actually short 6','shdfjkashdkfhaskdhfakjsdhfkashdfkahsdkfjhaskdjfhkasjdfhiehahfjkasdhfkahsdkjfhalkhdfklasdhfjasdhfjsadhfjkahsdkfhasdjfahsdfbnmcbvmbfkjsfhkEIO;jslajsdfksdhfkjsdhfkajdhfkjahd',NULL,5,3,0,'','2020-09-27 12:28:27','2020-09-27 12:28:27'),(13,2,'this is some long heading. which is actually short 7','shdfjkashdkfhaskdhfakjsdhfkashdfkahsdkfjhaskdjfhkasjdfhiehahfjkasdhfkahsdkjfhalkhdfklasdhfjasdhfjsadhfjkahsdkfhasdjfahsdfbnmcbvmbfkjsfhkEIO;jslajsdfksdhfkjsdhfkajdhfkjahd',NULL,5,3,0,'','2020-09-27 12:28:27','2020-09-27 12:28:27'),(14,2,'this is some long heading. which is actually short 14','shdfjkashdkfhaskdhfakjsdhfkashdfkahsdkfjhaskdjfhkasjdfhiehahfjkasdhfkahsdkjfhalkhdfklasdhfjasdhfjsadhfjkahsdkfhasdjfahsdfbnmcbvmbfkjsfhkEIO;jslajsdfksdhfkjsdhfkajdhfkjahd',NULL,5,3,0,'','2020-09-27 12:28:27','2020-09-27 12:28:27'),(18,2,'this is some long heading. which is actually short 18','shdfjkashdkfhaskdhfakjsdhfkashdfkahsdkfjhaskdjfhkasjdfhiehahfjkasdhfkahsdkjfhalkhdfklasdhfjasdhfjsadhfjkahsdkfhasdjfahsdfbnmcbvmbfkjsfhkEIO;jslajsdfksdhfkjsdhfkajdhfkjahd',NULL,5,3,0,'','2020-09-27 12:28:27','2020-09-27 12:28:27'),(19,2,'this is some long heading. which is actually short19 ','shdfjkashdkfhaskdhfakjsdhfkashdfkahsdkfjhaskdjfhkasjdfhiehahfjkasdhfkahsdkjfhalkhdfklasdhfjasdhfjsadhfjkahsdkfhasdjfahsdfbnmcbvmbfkjsfhkEIO;jslajsdfksdhfkjsdhfkajdhfkjahd',NULL,5,3,0,'','2020-09-27 12:28:27','2020-09-27 12:28:27'),(20,2,'this is some long heading. which is actually short 20','shdfjkashdkfhaskdhfakjsdhfkashdfkahsdkfjhaskdjfhkasjdfhiehahfjkasdhfkahsdkjfhalkhdfklasdhfjasdhfjsadhfjkahsdkfhasdjfahsdfbnmcbvmbfkjsfhkEIO;jslajsdfksdhfkjsdhfkajdhfkjahd',NULL,5,3,0,'','2020-09-27 12:28:27','2020-09-27 12:28:27'),(33,11,'safsdaf','<p>adfasdfasdfdadfadf</p>','',0,0,4,'',NULL,NULL);
/*!40000 ALTER TABLE `discussions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enterprises`
--

DROP TABLE IF EXISTS `enterprises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enterprises` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `enterprises_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enterprises`
--

LOCK TABLES `enterprises` WRITE;
/*!40000 ALTER TABLE `enterprises` DISABLE KEYS */;
/*!40000 ALTER TABLE `enterprises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
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
-- Table structure for table `gifts`
--

DROP TABLE IF EXISTS `gifts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gifts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `reciever_id` bigint(20) unsigned NOT NULL,
  `reciever_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gifts_user_id_foreign` (`user_id`),
  KEY `gifts_reciever_id_foreign` (`reciever_id`),
  CONSTRAINT `gifts_reciever_id_foreign` FOREIGN KEY (`reciever_id`) REFERENCES `users` (`id`),
  CONSTRAINT `gifts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gifts`
--

LOCK TABLES `gifts` WRITE;
/*!40000 ALTER TABLE `gifts` DISABLE KEYS */;
/*!40000 ALTER TABLE `gifts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'Afrikaans','AF',' ',NULL,NULL,NULL),(2,'Albanian','SQ',' ',NULL,NULL,NULL),(3,'Arabic','AR',' ',NULL,NULL,NULL),(4,'Armenian','HY',' ',NULL,NULL,NULL),(5,'Basque','EU',' ',NULL,NULL,NULL),(6,'Bengali','BN',' ',NULL,NULL,NULL),(7,'Bulgarian','BG',' ',NULL,NULL,NULL),(8,'Catalan','CA',' ',NULL,NULL,NULL),(9,'Cambodian','KM',' ',NULL,NULL,NULL),(10,'Chinese (Mandarin)','ZH',' ',NULL,NULL,NULL),(11,'Croatian','HR',' ',NULL,NULL,NULL),(12,'Czech','CS',' ',NULL,NULL,NULL),(13,'Danish','DA',' ',NULL,NULL,NULL),(14,'Dutch','NL',' ',NULL,NULL,NULL),(15,'English','EN',' ',NULL,NULL,NULL),(16,'Estonian','ET',' ',NULL,NULL,NULL),(17,'Fiji','FJ',' ',NULL,NULL,NULL),(18,'Finnish','FI',' ',NULL,NULL,NULL),(19,'French','FR',' ',NULL,NULL,NULL),(20,'Georgian','KA',' ',NULL,NULL,NULL),(21,'German','DE',' ',NULL,NULL,NULL),(22,'Greek','EL',' ',NULL,NULL,NULL),(23,'Gujarati','GU',' ',NULL,NULL,NULL),(24,'Hebrew','HE',' ',NULL,NULL,NULL),(25,'Hindi','HI',' ',NULL,NULL,NULL),(26,'Hungarian','HU',' ',NULL,NULL,NULL),(27,'Icelandic','IS',' ',NULL,NULL,NULL),(28,'Indonesian','ID',' ',NULL,NULL,NULL),(29,'Irish','GA',' ',NULL,NULL,NULL),(30,'Italian','IT',' ',NULL,NULL,NULL),(31,'Japanese','JA',' ',NULL,NULL,NULL),(32,'Javanese','JW',' ',NULL,NULL,NULL),(33,'Korean','KO',' ',NULL,NULL,NULL),(34,'Latin','LA',' ',NULL,NULL,NULL),(35,'Latvian','LV',' ',NULL,NULL,NULL),(36,'Lithuanian','LT',' ',NULL,NULL,NULL),(37,'Macedonian','MK',' ',NULL,NULL,NULL),(38,'Malay','MS',' ',NULL,NULL,NULL),(39,'Malayalam','ML',' ',NULL,NULL,NULL),(40,'Maltese','MT',' ',NULL,NULL,NULL),(41,'Maori','MI',' ',NULL,NULL,NULL),(42,'Marathi','MR',' ',NULL,NULL,NULL),(43,'Mongolian','MN',' ',NULL,NULL,NULL),(44,'Nepali','NE',' ',NULL,NULL,NULL),(45,'Norwegian','NO',' ',NULL,NULL,NULL),(46,'Persian','FA',' ',NULL,NULL,NULL),(47,'Polish','PL',' ',NULL,NULL,NULL),(48,'Portuguese','PT',' ',NULL,NULL,NULL),(49,'Punjabi','PA',' ',NULL,NULL,NULL),(50,'Quechua','QU',' ',NULL,NULL,NULL),(51,'Romanian','RO',' ',NULL,NULL,NULL),(52,'Russian','RU',' ',NULL,NULL,NULL),(53,'Samoan','SM',' ',NULL,NULL,NULL),(54,'Serbian','SR',' ',NULL,NULL,NULL),(55,'Slovak','SK',' ',NULL,NULL,NULL),(56,'Slovenian','SL',' ',NULL,NULL,NULL),(57,'Spanish','ES',' ',NULL,NULL,NULL),(58,'Swahili','SW',' ',NULL,NULL,NULL),(59,'Swedish ','SV',' ',NULL,NULL,NULL),(60,'Tamil','TA',' ',NULL,NULL,NULL),(61,'Tatar','TT',' ',NULL,NULL,NULL),(62,'Telugu','TE',' ',NULL,NULL,NULL),(63,'Thai','TH',' ',NULL,NULL,NULL),(64,'Tibetan','BO',' ',NULL,NULL,NULL),(65,'Tonga','TO',' ',NULL,NULL,NULL),(66,'Turkish','TR',' ',NULL,NULL,NULL),(67,'Ukrainian','UK',' ',NULL,NULL,NULL),(68,'Urdu','UR',' ',NULL,NULL,NULL),(69,'Uzbek','UZ',' ',NULL,NULL,NULL),(70,'Vietnamese','VI',' ',NULL,NULL,NULL),(71,'Welsh','CY',' ',NULL,NULL,NULL),(72,'Xhosa','XH',' ',NULL,NULL,NULL);
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (122,'2014_10_12_000000_create_users_table',5),(105,'2014_10_12_100000_create_password_resets_table',1),(106,'2019_08_19_000000_create_failed_jobs_table',1),(107,'2020_07_08_084726_create_languages_table',1),(108,'2020_07_12_082522_add_fields_to_users',1),(109,'2020_08_05_165829_create_teachers_table',1),(110,'2020_08_05_165909_create_teacher_timings_table',1),(111,'2020_08_05_170357_create_other_langs_table',1),(112,'2020_09_20_190704_create_comments_on_teacher_table',1),(119,'2020_09_21_183656_create_teacher_resume_table',2),(114,'2020_09_24_185341_create_discussion_table',1),(115,'2020_09_25_194651_create_user_vote_discussion_table',1),(116,'2020_09_30_175102_create_user_register_with_teacher_table',1),(117,'2020_10_01_150448_create_user_speaks_table',1),(120,'2020_10_06_182708_create_user_favourite_teacher_table',3),(121,'2020_10_12_164810_create_enterprises_table',4),(123,'2020_10_19_204708_create_gifts_table',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `other_langs`
--

DROP TABLE IF EXISTS `other_langs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `other_langs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint(20) unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `other_langs_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `other_langs_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `other_langs`
--

LOCK TABLES `other_langs` WRITE;
/*!40000 ALTER TABLE `other_langs` DISABLE KEYS */;
/*!40000 ALTER TABLE `other_langs` ENABLE KEYS */;
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
INSERT INTO `password_resets` VALUES ('sohail@sohail.com','$2y$10$kb6z6SBsNn6ZOppL75pF8.18Wt3nNWZce5oFtKFVncQFBFDzKaWba','2020-10-08 12:30:19');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher_resume`
--

DROP TABLE IF EXISTS `teacher_resume`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher_resume` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint(20) unsigned NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subdescription` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_resume_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `teacher_resume_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher_resume`
--

LOCK TABLES `teacher_resume` WRITE;
/*!40000 ALTER TABLE `teacher_resume` DISABLE KEYS */;
/*!40000 ALTER TABLE `teacher_resume` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher_timings`
--

DROP TABLE IF EXISTS `teacher_timings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher_timings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isOpen` tinyint(4) NOT NULL,
  `open` time NOT NULL,
  `close` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_timings_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `teacher_timings_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher_timings`
--

LOCK TABLES `teacher_timings` WRITE;
/*!40000 ALTER TABLE `teacher_timings` DISABLE KEYS */;
INSERT INTO `teacher_timings` VALUES (2,2,'asd',0,'18:17:59','19:17:59',NULL,NULL);
/*!40000 ALTER TABLE `teacher_timings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teachers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(4) NOT NULL,
  `intro_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teachers_language_id_foreign` (`language_id`),
  KEY `teachers_user_id_foreign` (`user_id`),
  CONSTRAINT `teachers_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`),
  CONSTRAINT `teachers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachers`
--

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` VALUES (2,1,6,'Tanveer ahmad','03349072627','male','pakistan',1,NULL,'Lorem ipsum dolor sit amet consectetur adipisicing elit. In excepturi, placeat,\r\n                nulla adipisci libero sunt beatae voluptate provident labore suscipit nesciunt alias pariatur odio\r\n                repudiandae officia incidunt commodi minima! Expedita blanditiis omnis deleniti possimus? Sunt\r\n                praesentium rem modi porro ab!Lorem ipsum dolor sit amet consectetur adipisicing elit. In excepturi, placeat,\r\n                nulla adipisci libero sunt beatae voluptate provident labore suscipit nesciunt alias pariatur odio\r\n                repudiandae officia incidunt commodi minima! Expedita blanditiis omnis deleniti possimus? Sunt\r\n                praesentium rem modi porro ab!',1,'2020-08-25 13:51:14','2020-08-25 13:51:14'),(3,1,6,'Tanveer Ali','03349072627','male','USA',1,NULL,'Lorem ipsum dolor sit amet consectetur adipisicing elit. In excepturi, placeat,\r\n                nulla adipisci libero sunt beatae voluptate provident labore suscipit nesciunt alias pariatur odio\r\n                repudiandae officia incidunt commodi minima! Expedita blanditiis omnis deleniti possimus? Sunt\r\n                praesentium rem modi porro ab!Lorem ipsum dolor sit amet consectetur adipisicing elit. In excepturi, placeat,\r\n                nulla adipisci libero sunt beatae voluptate provident labore suscipit nesciunt alias pariatur odio\r\n                repudiandae officia incidunt commodi minima! Expedita blanditiis omnis deleniti possimus? Sunt\r\n                praesentium rem modi porro ab!',0,'2020-08-25 13:51:35','2020-08-25 13:51:35');
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_favourite_teacher`
--

DROP TABLE IF EXISTS `user_favourite_teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_favourite_teacher` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `teacher_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_favourite_teacher_user_id_foreign` (`user_id`),
  KEY `user_favourite_teacher_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `user_favourite_teacher_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`),
  CONSTRAINT `user_favourite_teacher_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_favourite_teacher`
--

LOCK TABLES `user_favourite_teacher` WRITE;
/*!40000 ALTER TABLE `user_favourite_teacher` DISABLE KEYS */;
INSERT INTO `user_favourite_teacher` VALUES (1,11,3,'2020-10-06 18:31:22','2020-10-06 18:31:22'),(2,11,2,'2020-10-06 18:31:22','2020-10-06 18:31:22');
/*!40000 ALTER TABLE `user_favourite_teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_register_with_teacher`
--

DROP TABLE IF EXISTS `user_register_with_teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_register_with_teacher` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `teacher_id` bigint(20) unsigned NOT NULL,
  `timing_id` bigint(20) unsigned NOT NULL,
  `scheduled_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `isAttended` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_register_with_teacher_user_id_foreign` (`user_id`),
  KEY `user_register_with_teacher_timing_id_foreign` (`timing_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_register_with_teacher`
--

LOCK TABLES `user_register_with_teacher` WRITE;
/*!40000 ALTER TABLE `user_register_with_teacher` DISABLE KEYS */;
INSERT INTO `user_register_with_teacher` VALUES (10,11,3,2,'2020-10-05 15:46:46',0,'2020-10-03 18:30:17','2020-10-03 18:30:30'),(11,11,3,2,'2020-10-05 15:46:46',0,'2020-09-28 18:30:17','2020-10-03 18:30:17'),(12,11,3,2,'2020-10-03 16:46:07',1,'2020-10-02 18:30:30','2020-10-02 18:30:30'),(13,11,3,2,'2020-11-05 15:46:46',0,'2020-10-03 18:30:17','2020-10-03 18:30:17'),(15,11,3,2,'2020-10-05 15:46:46',0,'2020-10-02 18:30:30','2020-10-02 18:30:30'),(16,11,2,2,'2020-10-11 18:43:16',0,'2020-10-07 18:43:16','2020-10-07 18:43:16');
/*!40000 ALTER TABLE `user_register_with_teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_speaks`
--

DROP TABLE IF EXISTS `user_speaks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_speaks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `language_id` bigint(20) unsigned NOT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Beginner, intermediate, advanced',
  `motivation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currently_learning` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=>NO 1=>YES',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_speaks_user_id_foreign` (`user_id`),
  KEY `user_speaks_language_id_foreign` (`language_id`),
  CONSTRAINT `user_speaks_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`),
  CONSTRAINT `user_speaks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_speaks`
--

LOCK TABLES `user_speaks` WRITE;
/*!40000 ALTER TABLE `user_speaks` DISABLE KEYS */;
INSERT INTO `user_speaks` VALUES (1,11,2,'beginner','',0,'2020-10-06 11:50:39','2020-10-06 11:50:39'),(2,11,4,'totalintermediate','',1,'2020-10-06 11:50:39','2020-10-06 11:50:39'),(3,11,2,'beginner','',0,'2020-10-06 11:50:39','2020-10-06 11:50:39'),(4,11,4,'totalintermediate','',1,'2020-10-06 11:50:39','2020-10-06 11:50:39'),(6,11,2,'beginner','',0,'2020-10-06 11:50:39','2020-10-06 11:50:39'),(7,11,4,'totalintermediate','',1,'2020-10-06 11:50:39','2020-10-06 11:50:39'),(8,11,2,'beginner','',0,'2020-10-06 11:50:39','2020-10-06 11:50:39'),(9,11,4,'totalintermediate','',1,'2020-10-06 11:50:39','2020-10-06 11:50:39');
/*!40000 ALTER TABLE `user_speaks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_vote_discussion`
--

DROP TABLE IF EXISTS `user_vote_discussion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_vote_discussion` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `discussion_id` bigint(20) unsigned NOT NULL,
  `vote` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `discussion_id` (`discussion_id`),
  CONSTRAINT `user_vote_discussion_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_vote_discussion`
--

LOCK TABLES `user_vote_discussion` WRITE;
/*!40000 ALTER TABLE `user_vote_discussion` DISABLE KEYS */;
INSERT INTO `user_vote_discussion` VALUES (3,11,1,'upvote',NULL,NULL);
/*!40000 ALTER TABLE `user_vote_discussion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Musawer Shah','musawershah1598@gmail.com',NULL,NULL,'profilepicture/linkedin.png',NULL,'2020-07-11 19:59:06','$2y$10$if69Uvnc5F5ynUWhFiObRusKX7gZBIgXyIqS5NzkfXuR3EGMsr2cW','admin',NULL,'2020-07-11 14:49:07','2020-07-11 14:49:07',NULL),(3,'Musawer Shah','musawershah2016@yahoo.com',NULL,NULL,'profilepicture/linkedin.png',NULL,NULL,'$2y$10$.b3SPny4F4unOen1PcYhNeoGq4fY.w4Qtp1iybu5jkrwf7JlHBeT.','teacher',NULL,'2020-08-17 20:42:33','2020-08-17 21:02:26',NULL),(6,'Tanveer Ali','alitanveer841@gmail.com',NULL,NULL,'profilepicture/linkedin.png',NULL,NULL,'$2y$10$QSAIA45fgeQurV41Jsc20uAbKPrIcWxnqsGetLpXqrAWj8xryfa12','user',NULL,'2020-08-18 11:12:33','2020-08-18 11:12:33',NULL),(7,'Obaidullah','baheer.fr@gmail.com',NULL,NULL,'profilepicture/linkedin.png',NULL,NULL,'$2y$10$lDhhIpkdit0uQQ.zdeKAGOKWNEhE238tiRIfAXwLkztiNxa6T1VyW','user',NULL,'2020-08-29 09:25:48','2020-08-29 09:25:48',NULL),(8,'Carmel Collier DDS','9892541775@vtext.com',NULL,NULL,'profilepicture/linkedin.png',NULL,NULL,'$2y$10$KbhKzhAycj99ExapDZqC4u5nMogRaNpIPzylA2W8.0v9BeYPMTeXK','user',NULL,'2020-09-13 09:34:57','2020-09-13 09:34:57',NULL),(9,'Jany Dietrich','hjcranstonjr@msn.com',NULL,NULL,'profilepicture/linkedin.png',NULL,NULL,'$2y$10$5nTIb0v.HTnD0RgruWML8u4vmm9wP6JVGLgGc0aMXD4V67a/ASNfG','user',NULL,'2020-09-14 15:11:46','2020-09-14 15:11:46',NULL),(10,'Earnest Rempel','info@amashen.com',NULL,NULL,'profilepicture/linkedin.png',NULL,NULL,'$2y$10$WceNzk1j3Zm46mh0ipgrVusqyc0FqwlKmiLkwHTU.CmpLO4pZELau','user',NULL,'2020-09-15 05:46:28','2020-09-15 05:46:28',NULL),(11,'Sohail Ahmad','sohail@sohail.com','+03439262326','male','profilepicture/linkedin.png','Pakistan',NULL,'$2y$10$QSAIA45fgeQurV41Jsc20uAbKPrIcWxnqsGetLpXqrAWj8xryfa12','user','G7aI3nC8J03eU8fMo6mP0y8GNpZBAo1v2ABZR3RF0Ae2CWwJ8JRwtC36epda','2020-10-01 15:52:06','2020-10-14 17:23:51',NULL),(16,'kashif','kashif@kashif.com',NULL,NULL,'profilepicture/linkedin.png',NULL,NULL,'$2y$10$bQ/tggY0f8YIXBl63/r8zOYQ57l.miDqN7Ulsifn7sw3OfVkxbqxm','user',NULL,'2020-10-07 14:39:33','2020-10-07 14:39:33',NULL);
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

-- Dump completed on 2020-10-27 19:58:53
