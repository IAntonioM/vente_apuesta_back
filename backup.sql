-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: appJuegosPago
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `bancos`
--

DROP TABLE IF EXISTS `bancos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bancos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancos`
--

LOCK TABLES `bancos` WRITE;
/*!40000 ALTER TABLE `bancos` DISABLE KEYS */;
INSERT INTO `bancos` VALUES (1,'Banco de Crédito del Perú (BCP)',1,'2025-07-27 01:24:34','2025-07-27 01:24:34'),(2,'BBVA Perú',1,'2025-07-27 01:24:34','2025-07-27 01:24:34'),(3,'Interbank',1,'2025-07-27 01:24:34','2025-07-27 01:24:34'),(4,'Scotiabank Perú',1,'2025-07-27 01:24:34','2025-07-27 01:24:34'),(5,'Banco Interamericano de Finanzas (BanBif)',1,'2025-07-27 01:24:34','2025-07-27 01:24:34'),(6,'Mibanco',1,'2025-07-27 01:24:34','2025-07-27 01:24:34'),(7,'Banco Pichincha',1,'2025-07-27 01:24:34','2025-07-27 01:24:34'),(8,'Banco Santander Perú',1,'2025-07-27 01:24:34','2025-07-27 01:24:34'),(9,'Banco Falabella Perú',1,'2025-07-27 01:24:34','2025-07-27 01:24:34'),(10,'Citibank del Perú',1,'2025-07-27 01:24:34','2025-07-27 01:24:34'),(11,'Banco GNB Perú',1,'2025-07-27 01:24:34','2025-07-27 01:24:34'),(12,'Banco de la Nación',1,'2025-07-27 01:24:34','2025-07-27 01:24:34'),(13,'Banco Agropecuario (Agrobanco)',1,'2025-07-27 01:24:34','2025-07-27 01:24:34'),(14,'Banco de Comercio',1,'2025-07-27 01:24:34','2025-07-27 01:24:34'),(15,'Banco ICBC Perú',1,'2025-07-27 01:24:34','2025-07-27 01:24:34'),(16,'Bank of China',1,'2025-07-27 01:24:34','2025-07-27 01:24:34');
/*!40000 ALTER TABLE `bancos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
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
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
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
-- Table structure for table `compra`
--

DROP TABLE IF EXISTS `compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compra` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `ventaId` int NOT NULL,
  `transaccionId` int NOT NULL,
  `cantidad` int NOT NULL DEFAULT '1',
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra`
--

LOCK TABLES `compra` WRITE;
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compras` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `ventaId` int NOT NULL,
  `transaccionId` int NOT NULL,
  `cantidad` int NOT NULL DEFAULT '1',
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` VALUES (1,3,3,7,11,'2025-08-11 13:54:36'),(2,3,3,8,10,'2025-08-11 13:59:12'),(3,3,3,9,1,'2025-08-11 14:37:22'),(4,8,3,18,1,'2025-08-14 20:17:35');
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;
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
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
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
  `attempts` tinyint unsigned NOT NULL,
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
-- Table structure for table `juegos`
--

DROP TABLE IF EXISTS `juegos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `juegos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text,
  `estado` tinyint(1) DEFAULT '1',
  `createdAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `juegos`
--

LOCK TABLES `juegos` WRITE;
/*!40000 ALTER TABLE `juegos` DISABLE KEYS */;
INSERT INTO `juegos` VALUES (1,'Buscaminas','Busca los espacios vacíos sin explotar minas',1,NULL),(2,'Rompecabezas','Rompecabezas',1,NULL);
/*!40000 ALTER TABLE `juegos` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_08_14_133610_create_personal_access_tokens_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivelesjuego`
--

DROP TABLE IF EXISTS `nivelesjuego`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nivelesjuego` (
  `id` int NOT NULL AUTO_INCREMENT,
  `juegoId` int NOT NULL,
  `nivel` int NOT NULL,
  `multiplicador` decimal(5,2) NOT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `createdAt` datetime DEFAULT NULL,
  `tiempo` int NOT NULL DEFAULT '60',
  PRIMARY KEY (`id`),
  KEY `juegoId` (`juegoId`),
  CONSTRAINT `nivelesjuego_ibfk_1` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_10` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_11` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_12` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_13` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_14` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_15` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_16` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_17` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_18` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_19` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_2` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_20` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_21` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_22` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_23` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_24` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_25` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_26` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_27` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_28` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_29` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_3` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_30` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_31` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_32` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_33` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_34` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_35` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_36` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_37` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_38` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_39` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_4` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_40` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_41` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_42` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_43` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_44` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_45` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_46` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_47` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_48` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_49` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_5` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_50` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_51` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_52` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_53` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_6` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_7` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_8` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nivelesjuego_ibfk_9` FOREIGN KEY (`juegoId`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivelesjuego`
--

LOCK TABLES `nivelesjuego` WRITE;
/*!40000 ALTER TABLE `nivelesjuego` DISABLE KEYS */;
INSERT INTO `nivelesjuego` VALUES (1,1,1,1.20,1,NULL,180),(2,1,2,1.40,1,NULL,180),(3,1,3,1.60,1,NULL,180),(4,1,4,1.80,1,NULL,180),(5,1,5,2.00,1,NULL,180);
/*!40000 ALTER TABLE `nivelesjuego` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partidas`
--

DROP TABLE IF EXISTS `partidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `partidas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `juegoId` int NOT NULL,
  `nivelJuegoId` int NOT NULL,
  `monto_apostado` decimal(10,2) NOT NULL,
  `resultado` enum('PENDIENTE','GANADO','PERDIDO') DEFAULT 'PENDIENTE',
  `ganancia` decimal(10,2) DEFAULT '0.00',
  `tiempo_inicio` datetime DEFAULT NULL,
  `tiempo_fin` datetime DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partidas`
--

LOCK TABLES `partidas` WRITE;
/*!40000 ALTER TABLE `partidas` DISABLE KEYS */;
/*!40000 ALTER TABLE `partidas` ENABLE KEYS */;
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
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\Userss',8,'auth_token','0367f66ed5a5b9f58a69aec2772eb2abb89608bb70fe4ea26735601183884850','[\"*\"]',NULL,NULL,'2025-08-14 18:55:21','2025-08-14 18:55:21'),(2,'App\\Models\\Userss',8,'auth_token','be9b2ce27826c20b43a3dd8ebd2040ffb8c616a923c277219f7ff4a21450cac0','[\"*\"]',NULL,NULL,'2025-08-14 18:55:24','2025-08-14 18:55:24'),(3,'App\\Models\\Userss',8,'auth_token','b4a6e3d21531874d05b049f8fc04db5bd3a68afc325d6bdf2d6c100460566eca','[\"*\"]','2025-08-15 01:24:48',NULL,'2025-08-14 19:20:29','2025-08-15 01:24:48'),(4,'App\\Models\\Userss',8,'auth_token','289ab48588eaef14f34a8a90d6c922df7bfcace7be6b536dd14b36af0588753e','[\"*\"]','2025-08-27 19:22:22',NULL,'2025-08-15 00:55:03','2025-08-27 19:22:22'),(5,'App\\Models\\Userss',9,'auth_token','d1814ca11ee9c2e22b2591b0c91c5cc3253980f0b789568e525889f835ccbccd','[\"*\"]',NULL,NULL,'2025-08-15 18:59:43','2025-08-15 18:59:43'),(6,'App\\Models\\Userss',9,'auth_token','6bb36e4de0a7c431d0076eb9829882096a1f8f86afcad8cb5c60e4414f499865','[\"*\"]',NULL,NULL,'2025-08-15 19:05:38','2025-08-15 19:05:38'),(7,'App\\Models\\Userss',9,'auth_token','92cab2200376f0c88712bb1821415a62b6b8f42fc157f4f800144d054dc18339','[\"*\"]','2025-08-27 19:22:05',NULL,'2025-08-15 21:45:45','2025-08-27 19:22:05'),(8,'App\\Models\\Userss',9,'auth_token','ab2cd2db6f868195e1d40360a46599d821b2f2675814ac65dc4780d50bb81f42','[\"*\"]',NULL,NULL,'2025-08-16 05:37:06','2025-08-16 05:37:06');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saldousuarios`
--

DROP TABLE IF EXISTS `saldousuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `saldousuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `saldo` decimal(10,2) NOT NULL DEFAULT '0.00',
  `updated_at` timestamp NULL DEFAULT NULL,
  `userId` int NOT NULL,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userId` (`userId`),
  CONSTRAINT `saldousuarios_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_10` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_11` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_12` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_13` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_14` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_15` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_16` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_17` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_18` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_19` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_20` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_21` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_22` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_23` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_24` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_25` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_26` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_27` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_28` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_29` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_30` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_31` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_32` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_33` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_34` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_35` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_36` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_37` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_38` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_39` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_4` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_40` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_41` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_42` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_43` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_44` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_45` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_46` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_47` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_48` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_49` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_5` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_50` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_51` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_52` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_53` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_54` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_55` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_56` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_57` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_58` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_59` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_6` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_60` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_61` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_62` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_63` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_64` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_65` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_66` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_7` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_8` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `saldousuarios_ibfk_9` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saldousuarios`
--

LOCK TABLES `saldousuarios` WRITE;
/*!40000 ALTER TABLE `saldousuarios` DISABLE KEYS */;
INSERT INTO `saldousuarios` VALUES (1,160.00,'2025-07-27 20:02:44',1,'2025-08-14 13:44:31'),(2,7.00,'2025-08-11 19:37:22',3,'2025-08-14 13:44:31'),(3,30.00,NULL,6,'2025-08-14 13:44:39'),(4,30.00,NULL,7,'2025-08-14 13:45:19'),(5,168.00,NULL,8,'2025-08-14 20:24:30'),(6,170.00,NULL,9,'2025-08-15 16:47:38');
/*!40000 ALTER TABLE `saldousuarios` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('4eaKqtfH6QMLRPgGiAiRgImN0E1cKZYI04Ste0Lc',9,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRW5TQWNZaWxzWkVxQ2p3RUpKdVFPWnZZNEhoZXNaVTRCUXRRQ1huVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC90aWVuZGEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo5O30=',1755351922),('byKT1Z66xcsFMAiZKX3dQvQDsQmbiMRkTWLP1rnv',9,'192.168.18.11','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMm9pTUhVVXZoMDAwR2FoZmE5VDBmRlM3ZGRKd3h2R093WGl0dVN3cSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xOTIuMTY4LjE4LjExOjgwMDAvdGllbmRhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6OTt9',1755278847),('i8bxLlLeGnYqXouBcEfOsACTxa29hPstsMknVe9P',9,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY0xCeElrUXpjZGp2YVJlUXhuSk42cTBkTG1NVEIzU0Z4THhzZmptNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC91c3VhcmlvcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk7fQ==',1756304519),('iNeobzDKDINbP4UvMGSCFLLHTfgzC8owm7BE72v2',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQnl5UlJubld2YTNoSVEzazI2Q2ZSdTRscUxueU1kQW54dUp3WEVCZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1755266166),('N22rrsSB7GfPFyczpr2QApHi4T5QomBuJG2jOXcF',9,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUklTekJIYVBLT3paUlowczJHa3VrdllKNkk1cXBCeklHZ3lSUmdvSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC90aWVuZGEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo5O30=',1755305034),('Sr9SrGTKxVv5NYou60uuhS5Mo0bGP3MLE878iRWV',9,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoidXBVeUhrU2JOQmlqUFpzc3pNUnNZZXd2S1ZOb2NqS3dQNW1nQmlCdCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI4OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvdGllbmRhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6OTt9',1755285374),('tV5ec8c47wf2fjR0d8OMZ6Lay4VWwHGJKwiPgTP8',9,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoibzk0UWhKdGhkT1FYaGhRcFFERFAxb1lTajF2VU1FTVJFSUdtcDRycyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo5O30=',1755266880),('wOiArm2qazNa1bqhcpgTls9mp7lOI05Ng7ZkkHXs',10,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoic0FNVjUzbTRnbXB0T0NkU1BRZG5PalNoMktIeEpSUU92UXhoblRXciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90aWVuZGEiO31zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTA7fQ==',1755278442),('ZPtnWGEes4smjGxBct14evnmeWGEdqZHxPRZWKIT',NULL,'127.0.0.1','PostmanRuntime/7.45.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRDl0THdHcUZNNURIZmE2WVRPU3owSDE1OHFVSWhpcGd3ZUJaZFRGcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1756304699);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaccions`
--

DROP TABLE IF EXISTS `transaccions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaccions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` enum('DEPOSITO','RETIRO') NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `estado` enum('PENDIENTE','APROBADO','RECHAZADO') DEFAULT 'PENDIENTE',
  `flag_transaccion` int DEFAULT '0',
  `metodo_pago` varchar(255) DEFAULT NULL,
  `referencia` varchar(255) DEFAULT NULL,
  `observacion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `userId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  CONSTRAINT `transaccions_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_10` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_11` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_12` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_13` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_14` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_15` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_16` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_17` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_18` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_19` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_20` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_21` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_22` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_23` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_24` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_25` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_26` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_27` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_28` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_29` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_30` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_31` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_32` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_33` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_34` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_35` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_36` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_37` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_38` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_39` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_4` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_40` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_41` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_42` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_43` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_44` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_45` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_46` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_47` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_48` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_49` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_5` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_50` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_51` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_52` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_53` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_54` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_55` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_56` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_57` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_58` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_59` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_6` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_60` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_61` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_62` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_63` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_64` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_65` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_66` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_67` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_68` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_7` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_8` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaccions_ibfk_9` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaccions`
--

LOCK TABLES `transaccions` WRITE;
/*!40000 ALTER TABLE `transaccions` DISABLE KEYS */;
INSERT INTO `transaccions` VALUES (2,'DEPOSITO',50.00,'APROBADO',1,'Yape','OP-123456','Recarga desde celular','2025-07-27 13:43:07','2025-07-27 13:43:07',1),(3,'DEPOSITO',150.00,'APROBADO',1,'Yape','OP-123456','Recarga desde celular','2025-07-27 13:43:24','2025-07-27 13:43:24',1),(4,'RETIRO',30.00,'APROBADO',1,'Plin',NULL,'Retiro para usuario','2025-07-27 13:43:32','2025-07-27 13:43:32',1),(5,'RETIRO',10.00,'APROBADO',1,'Plin',NULL,'Retiro para usuario','2025-07-27 20:02:44','2025-07-27 20:02:44',1),(6,'DEPOSITO',30.00,'APROBADO',0,'BONO_REGISTRO','Registro inicial','Bono de bienvenida por registro','2025-08-11 09:19:27','2025-08-11 09:19:27',3),(7,'RETIRO',11.00,'APROBADO',0,'COMPRA','Compra de Zapatos','Compra de 11 unidad(es) de Zapatos','2025-08-11 18:54:36','2025-08-11 18:54:36',3),(8,'RETIRO',10.00,'APROBADO',0,'COMPRA','Compra de Zapatos','Compra de 10 unidad(es) de Zapatos - Total: $10','2025-08-11 18:59:12','2025-08-11 18:59:12',3),(9,'RETIRO',2.00,'APROBADO',0,'COMPRA','Compra de Zapatos','Compra de 1 unidad(es) de Zapatos - Total: $2','2025-08-11 19:37:22','2025-08-11 19:37:22',3),(10,'DEPOSITO',30.00,'APROBADO',0,'BONO_REGISTRO','Registro inicial','Bono de bienvenida por registro','2025-08-14 18:47:00','2025-08-14 18:47:00',8),(11,'DEPOSITO',30.00,'APROBADO',0,'BONO_REGISTRO','Registro inicial','Bono de bienvenida por registro','2025-08-14 19:06:16','2025-08-14 19:06:16',9),(18,'RETIRO',2.00,'APROBADO',0,'COMPRA','Compra de Zapatos','Compra de 1 unidad(es) de Zapatos - Total: $2','2025-08-15 01:17:35','2025-08-15 01:17:35',8),(19,'DEPOSITO',150.00,'APROBADO',1,'Yape','OP-123456','Recarga desde celular','2025-08-15 01:21:42','2025-08-15 01:21:42',8),(20,'RETIRO',10.00,'APROBADO',1,'Plin','','Retiro para usuario','2025-08-15 01:24:30','2025-08-15 01:24:30',8),(21,'RETIRO',10.00,'APROBADO',0,'Plin',NULL,'Retiro para usuario','2025-08-15 21:47:22','2025-08-15 21:47:22',9),(22,'DEPOSITO',150.00,'APROBADO',0,'Yape','OP-123456','Recarga desde celular','2025-08-15 21:47:38','2025-08-15 21:47:38',9);
/*!40000 ALTER TABLE `transaccions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userjuegos`
--

DROP TABLE IF EXISTS `userjuegos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userjuegos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nivel_actual` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `user_id` int DEFAULT NULL,
  `juego_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `juego_id` (`juego_id`),
  CONSTRAINT `userjuegos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_10` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_11` FOREIGN KEY (`user_id`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_12` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_13` FOREIGN KEY (`user_id`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_14` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_15` FOREIGN KEY (`user_id`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_16` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_17` FOREIGN KEY (`user_id`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_18` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_19` FOREIGN KEY (`user_id`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_2` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_20` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_21` FOREIGN KEY (`user_id`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_22` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_23` FOREIGN KEY (`user_id`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_24` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_25` FOREIGN KEY (`user_id`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_26` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_27` FOREIGN KEY (`user_id`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_28` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_29` FOREIGN KEY (`user_id`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_30` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_4` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_6` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_7` FOREIGN KEY (`user_id`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_8` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `userjuegos_ibfk_9` FOREIGN KEY (`user_id`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userjuegos`
--

LOCK TABLES `userjuegos` WRITE;
/*!40000 ALTER TABLE `userjuegos` DISABLE KEYS */;
INSERT INTO `userjuegos` VALUES (2,4,'2025-08-11 14:07:53','2025-08-11 14:09:20',3,1),(3,4,'2025-08-14 20:19:51','2025-08-14 20:19:51',8,1);
/*!40000 ALTER TABLE `userjuegos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres_apellidos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nro_cuenta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `bancoId` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bancoId` (`bancoId`),
  CONSTRAINT `Users_bancoId_foreign_idx` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userss`
--

DROP TABLE IF EXISTS `userss`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userss` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombres_apellidos` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `nro_cuenta` varchar(255) NOT NULL,
  `cel` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` tinyint NOT NULL DEFAULT '1' COMMENT '1 = Usuario, 2 = Admin, etc.',
  `bancoId` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo` (`correo`),
  KEY `bancoId` (`bancoId`),
  CONSTRAINT `userss_ibfk_1` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_10` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_11` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_12` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_13` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_14` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_15` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_16` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_17` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_18` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_19` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_2` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_20` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_21` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_22` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_23` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_24` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_25` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_26` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_27` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_28` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_29` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_3` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_30` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_31` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_32` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_33` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_34` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_35` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_36` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_37` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_38` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_39` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_4` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_40` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_41` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_42` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_43` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_44` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_45` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_46` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_47` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_48` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_49` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_5` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_50` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_51` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_52` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_53` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_54` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_55` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_56` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_57` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_58` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_59` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_6` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_60` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_61` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_62` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_63` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_64` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_65` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_66` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_67` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_68` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_69` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_7` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_70` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_71` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_72` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_73` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_74` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_75` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_76` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_77` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_78` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_79` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_8` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_80` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_81` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_82` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_83` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_84` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_85` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_86` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_87` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_88` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_89` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_9` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_90` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_91` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_92` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_93` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_94` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_95` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_96` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_97` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `userss_ibfk_98` FOREIGN KEY (`bancoId`) REFERENCES `bancos` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userss`
--

LOCK TABLES `userss` WRITE;
/*!40000 ALTER TABLE `userss` DISABLE KEYS */;
INSERT INTO `userss` VALUES (1,'María García','maria@correo.com','123456789','987654321','$2b$10$/4snfQbcxo.VcgDOcexYSOM00ZwsEvOSX3emEtlK81yeXll9dNG3G',1,1,NULL,NULL),(2,'María García','maria2@correo.com','1234567892','987654321','$2b$10$RhjUYjCUDMmTUW0GT9S1R.aOAtPpxx67jgTbapNZ8Yz5rAOpzTEia',1,1,NULL,NULL),(3,'Antonio','antonio@correo.com','1234567892','987654321','$2b$10$By8gLWBRvyVCFnr8vwrUg.qX8gCuz7Zm.x/YdWRj5bkEX37Fb6tmu',1,1,NULL,NULL),(4,'Antonio','antonio22@correo.com','1234567892','987654321','$2y$12$jfFjt/8XdBOxW53yr7dNP.6E1rShXB3VOz3qOJozltQX3XAbSqcii',1,1,'2025-08-14 18:41:51','2025-08-14 18:41:51'),(5,'Antonio','antonio222@correo.com','1234567892','987654321','$2y$12$v9AOE.aQao.zTNgeaCNK2eD77B8sM6.YPkKB5pWC0I5DA2uGM8MxS',1,1,'2025-08-14 18:43:20','2025-08-14 18:43:20'),(6,'Antonio','antonio3@correo.com','1234567892','987654321','$2y$12$MkFc.EkCzWgetDpQTwzG0OsBWb2iucNUdLDr9k0.AkxjubwY3VGi2',1,1,'2025-08-14 18:44:39','2025-08-14 18:44:39'),(7,'Antonio','antonio13@correo.com','1234567892','987654321','$2y$12$PEGWT/2gR8iqkV4Oxe1PtOL4UZqlQa2n.uZNAlR45bsiJX4RO3sQG',1,1,'2025-08-14 18:45:19','2025-08-14 18:45:19'),(8,'Antonio','antonio137@correo.com','1234567892','987654321','$2y$12$yYe9Fv31HUleX0Q5dv19RO8n2t.G5ZB5d3Rxr4b1HDwkofcjkUuQu',1,16,'2025-08-14 18:46:59','2025-08-15 21:05:52'),(9,'admin','admin@correo.com','1234567892','987654321','$2y$12$M92QWPyTRMaLZOFspsigwO1jhgJniVIOVADkb8SiI66fqb843S/1q',2,1,'2025-08-14 19:06:16','2025-08-14 19:06:16'),(10,'PRUEBA BORRAR','borrar@gmacil.com','12312312312313123','12313123123','$2y$12$bL0a31pzN/tluNxqljdeTewouiDo.RYoWDljdDpKTIJvwJtdpfnzu',2,12,'2025-08-15 21:11:24','2025-08-15 21:11:24');
/*!40000 ALTER TABLE `userss` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `venta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `cantidad` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` VALUES (1,'Camisa',60.00,'/images/1755271853_car.png',20,'2025-08-10 23:56:53','2025-08-15 15:30:53'),(2,'Pantalón',40.00,'/images/1755274579_pantalon.png',15,'2025-08-10 23:56:53','2025-08-15 16:16:19'),(3,'Zapatos',30.00,'/images/casaca.jpg',18,'2025-08-10 23:56:53','2025-08-14 20:17:35'),(4,'Carro',100.00,'/images/1755271922_carro prueba (1).jpg',20,'2025-08-15 15:32:02','2025-08-15 15:32:02'),(5,'FORTIS',22.00,'images/hIbTgvSVXwpm6fhFj4vZWXBgvmJLwLThfuTKs0Vr.png',22,'2025-08-16 00:42:00','2025-08-16 00:43:27');
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-27  9:31:18
