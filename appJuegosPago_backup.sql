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
) ENGINE=InnoDB AUTO_INCREMENT=17;
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
) ENGINE=InnoDB ;
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
) ENGINE=InnoDB  ;
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
  `monto_compra` decimal(10,2) DEFAULT '0.00',
  `monto_ganancia` decimal(10,2) DEFAULT '0.00',
  `monto_venta` decimal(10,2) DEFAULT '0.00',
  `userId` int NOT NULL,
  `ventaId` int NOT NULL,
  `transaccionId` int NOT NULL,
  `cantidad` int NOT NULL DEFAULT '1',
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` VALUES (1,10.00,10.00,20.00,46,1,2,1,'2025-09-14 22:23:05'),(2,10.00,10.00,20.00,46,1,6,1,'2025-09-14 22:27:43'),(3,10.00,10.00,20.00,46,1,8,1,'2025-09-14 22:29:54');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `juegos`
--

LOCK TABLES `juegos` WRITE;
/*!40000 ALTER TABLE `juegos` DISABLE KEYS */;
INSERT INTO `juegos` VALUES (1,'Rompecabezas','Rompecabezas',1,NULL),(2,'BORRADO','BORRADO',0,NULL);
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
  `ronda` int DEFAULT NULL,
  `monto_minimo_requerido` decimal(10,2) NOT NULL DEFAULT '0.00',
  `flag_todo_o_nada` tinyint(1) NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivelesjuego`
--

LOCK TABLES `nivelesjuego` WRITE;
/*!40000 ALTER TABLE `nivelesjuego` DISABLE KEYS */;
INSERT INTO `nivelesjuego` VALUES (1,1,1,1.20,1,NULL,180,1,0.00,0),(2,1,1,1.40,1,NULL,180,2,0.00,0),(3,1,2,1.60,1,NULL,180,2,0.00,0),(4,1,3,1.80,1,NULL,180,2,0.00,0),(5,1,4,2.00,1,NULL,180,2,20.00,1),(6,1,1,2.00,1,NULL,180,3,0.00,0),(7,1,2,2.00,1,NULL,180,3,0.00,0);
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
) ENGINE=InnoDB;
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
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\Userss',8,'auth_token','0367f66ed5a5b9f58a69aec2772eb2abb89608bb70fe4ea26735601183884850','[\"*\"]',NULL,NULL,'2025-08-14 18:55:21','2025-08-14 18:55:21'),(2,'App\\Models\\Userss',8,'auth_token','be9b2ce27826c20b43a3dd8ebd2040ffb8c616a923c277219f7ff4a21450cac0','[\"*\"]',NULL,NULL,'2025-08-14 18:55:24','2025-08-14 18:55:24'),(3,'App\\Models\\Userss',8,'auth_token','b4a6e3d21531874d05b049f8fc04db5bd3a68afc325d6bdf2d6c100460566eca','[\"*\"]','2025-08-15 01:24:48',NULL,'2025-08-14 19:20:29','2025-08-15 01:24:48'),(4,'App\\Models\\Userss',8,'auth_token','289ab48588eaef14f34a8a90d6c922df7bfcace7be6b536dd14b36af0588753e','[\"*\"]','2025-08-27 19:22:22',NULL,'2025-08-15 00:55:03','2025-08-27 19:22:22'),(5,'App\\Models\\Userss',9,'auth_token','d1814ca11ee9c2e22b2591b0c91c5cc3253980f0b789568e525889f835ccbccd','[\"*\"]',NULL,NULL,'2025-08-15 18:59:43','2025-08-15 18:59:43'),(6,'App\\Models\\Userss',9,'auth_token','6bb36e4de0a7c431d0076eb9829882096a1f8f86afcad8cb5c60e4414f499865','[\"*\"]',NULL,NULL,'2025-08-15 19:05:38','2025-08-15 19:05:38'),(7,'App\\Models\\Userss',9,'auth_token','92cab2200376f0c88712bb1821415a62b6b8f42fc157f4f800144d054dc18339','[\"*\"]','2025-08-27 19:22:05',NULL,'2025-08-15 21:45:45','2025-08-27 19:22:05'),(8,'App\\Models\\Userss',9,'auth_token','ab2cd2db6f868195e1d40360a46599d821b2f2675814ac65dc4780d50bb81f42','[\"*\"]',NULL,NULL,'2025-08-16 05:37:06','2025-08-16 05:37:06'),(9,'App\\Models\\Userss',11,'auth_token','82f04b1560fa0ff958d372be8130d5966c38c57ecb6722f516baf98b3f000343','[\"*\"]','2025-08-27 20:05:18',NULL,'2025-08-27 20:03:47','2025-08-27 20:05:18'),(10,'App\\Models\\Userss',11,'auth_token','c55d20822c65da287d8b988b405e0e9c6dcd2c1c59b98d4a4303b29ff0023eba','[\"*\"]','2025-08-27 20:07:13',NULL,'2025-08-27 20:05:46','2025-08-27 20:07:13'),(11,'App\\Models\\Userss',11,'auth_token','03d4187747b318f7ab4be7786bfad98f1c4b0cb67bed2de08a1c421218e335ca','[\"*\"]','2025-09-01 18:03:29',NULL,'2025-09-01 16:21:56','2025-09-01 18:03:29'),(12,'App\\Models\\Userss',12,'auth_token','58a6d0699272401d04424007f49942c74081af65dbc984bd2c8cda81b3d7dcb4','[\"*\"]',NULL,NULL,'2025-09-01 16:37:14','2025-09-01 16:37:14'),(13,'App\\Models\\Userss',12,'auth_token','c00084bbcf86120356990aee73a7c3d4530ebe8fe68227d754ea9662d124b40e','[\"*\"]','2025-09-14 12:27:32',NULL,'2025-09-01 16:37:22','2025-09-14 12:27:32'),(14,'App\\Models\\Userss',13,'auth_token','0d121a4aa308ca5b6b14a22a1a045442be499f46092607fc5ba437660c1a7add','[\"*\"]',NULL,NULL,'2025-09-01 18:15:05','2025-09-01 18:15:05'),(15,'App\\Models\\Userss',12,'auth_token','f6465b6d1de47afbeae72cae3be5023cf945709a81ac2c3d4ca60da47ac3ae5f','[\"*\"]','2025-09-14 12:20:29',NULL,'2025-09-08 11:37:51','2025-09-14 12:20:29'),(16,'App\\Models\\Userss',14,'auth_token','8ca9e4829d8bf82ca3de43ba290f001d3bcbec4b1018473654c28d388f41eb46','[\"*\"]',NULL,NULL,'2025-09-14 04:42:08','2025-09-14 04:42:08'),(17,'App\\Models\\Userss',15,'auth_token','0f84c144e0ea0b1292d6f44761eaec830377684c9bcd4886a4eed881c7bbcda8','[\"*\"]',NULL,NULL,'2025-09-14 05:15:41','2025-09-14 05:15:41'),(18,'App\\Models\\Userss',15,'auth_token','8a0fe1e9217d2fd591977ffe13f2293cdfb34d01ad3c44932c4331ebdcc81213','[\"*\"]','2025-09-14 10:41:43',NULL,'2025-09-14 05:16:06','2025-09-14 10:41:43'),(19,'App\\Models\\Userss',15,'auth_token','0660c555b93e201487843be76f03e617f360f4e69501f94eb0dfa2f56af06eb8','[\"*\"]',NULL,NULL,'2025-09-14 05:18:21','2025-09-14 05:18:21'),(20,'App\\Models\\Userss',15,'auth_token','519102237652721831e3a4c37985326ed008dd8a6eef8aa81b9d1fef77acb854','[\"*\"]','2025-09-14 12:29:02',NULL,'2025-09-14 10:34:26','2025-09-14 12:29:02'),(21,'App\\Models\\Userss',15,'auth_token','fee67235950a0b628439a82e004b54265429be21e7100392d8c9ca8b0a738048','[\"*\"]',NULL,NULL,'2025-09-14 10:39:55','2025-09-14 10:39:55'),(22,'App\\Models\\Userss',15,'auth_token','6eaf7edd4257493deb790918262ea23500f019a0447b3166b0bf5d750e4b3077','[\"*\"]',NULL,NULL,'2025-09-14 10:41:50','2025-09-14 10:41:50'),(23,'App\\Models\\Userss',15,'auth_token','459fbbd879b83c76b388f332489686bdb071f3545d8564611eee9de761ef2942','[\"*\"]',NULL,NULL,'2025-09-14 10:42:35','2025-09-14 10:42:35'),(24,'App\\Models\\Userss',15,'auth_token','82e5df2b2d5317433b9d5d051d98538887da4fa4a4ea99dcd9979d841ff086d7','[\"*\"]','2025-09-14 12:51:55',NULL,'2025-09-14 10:42:55','2025-09-14 12:51:55'),(25,'App\\Models\\Userss',16,'auth_token','d75fd9d3a2972566449b7920844a2d3056c66a308834680d7610c41ca4aa5388','[\"*\"]','2025-09-14 12:54:04',NULL,'2025-09-14 12:53:19','2025-09-14 12:54:04'),(26,'App\\Models\\Userss',16,'auth_token','c1405d975995dc19cc810b11736841fa8c56c778d6b1e58d0be8cbafcfa7e19e','[\"*\"]',NULL,NULL,'2025-09-14 12:53:37','2025-09-14 12:53:37'),(27,'App\\Models\\Userss',16,'auth_token','5d42168303379bf405f0719a28ed4a487d0d611880427e252be6f5ff1dfa7bdd','[\"*\"]',NULL,NULL,'2025-09-14 12:54:14','2025-09-14 12:54:14'),(28,'App\\Models\\Userss',17,'auth_token','df471d3a3ce6393f95d7bf792e12218741bdca8d55f7cdb5d7c80e9b9126b48a','[\"*\"]',NULL,NULL,'2025-09-14 13:07:58','2025-09-14 13:07:58'),(29,'App\\Models\\Userss',17,'auth_token','62889fad268c0076e1a2707f7e1c7d43afe8a09bfa9bd906b91dae56d56b9be3','[\"*\"]','2025-09-14 13:09:43',NULL,'2025-09-14 13:08:03','2025-09-14 13:09:43'),(30,'App\\Models\\Userss',18,'auth_token','93ef6f38fa6eab846818a008366d486e671740f816f684a527ef1ec5f0a18bec','[\"*\"]',NULL,NULL,'2025-09-14 13:12:58','2025-09-14 13:12:58'),(31,'App\\Models\\Userss',18,'auth_token','1dbc1944c91bdb32d3b443357638795462bd80d053b5654cc0427892aafb3bdd','[\"*\"]','2025-09-14 13:14:29',NULL,'2025-09-14 13:13:05','2025-09-14 13:14:29'),(32,'App\\Models\\Userss',18,'auth_token','348d1a4149abb8e5b7bc150d08cad2818504bcffff8beb916efb45fa16267246','[\"*\"]',NULL,NULL,'2025-09-14 13:13:09','2025-09-14 13:13:09'),(33,'App\\Models\\Userss',18,'auth_token','d6bb02d562a949d7e8c91e7cada54f7087ba7bdf5a3fe339ae9f5756ab627f6f','[\"*\"]',NULL,NULL,'2025-09-14 13:14:33','2025-09-14 13:14:33'),(34,'App\\Models\\Userss',19,'auth_token','eacd42a21557fc1e7b848713f8d7ca5bfa25a04fe19a834db553b59f8f8f0f97','[\"*\"]',NULL,NULL,'2025-09-14 13:30:41','2025-09-14 13:30:41'),(35,'App\\Models\\Userss',19,'auth_token','ad11c38b15506187e7425327ce2974feb9f25f63075ae377979d9e310c304738','[\"*\"]','2025-09-14 13:35:33',NULL,'2025-09-14 13:30:50','2025-09-14 13:35:33'),(36,'App\\Models\\Userss',20,'auth_token','39595c3282d89a56368db629f3f85a018394d9afe2cf9aba10adec8c64939322','[\"*\"]',NULL,NULL,'2025-09-14 13:37:57','2025-09-14 13:37:57'),(37,'App\\Models\\Userss',20,'auth_token','5c9fe144c4c33b4bbdec4baac974bedfaf22877c166626e524d7ac7313fe98e1','[\"*\"]','2025-09-14 13:39:36',NULL,'2025-09-14 13:38:01','2025-09-14 13:39:36'),(38,'App\\Models\\Userss',21,'auth_token','4ae835eef826de37819fd0b0dcacfeaefbaa76a94d845fae36cd2719b4dcb12f','[\"*\"]',NULL,NULL,'2025-09-14 13:40:12','2025-09-14 13:40:12'),(39,'App\\Models\\Userss',21,'auth_token','52dbb6cd6ea61f96da1e0438d321507845ef27d3401598a1cd6507cbe103c9b6','[\"*\"]','2025-09-14 13:40:46',NULL,'2025-09-14 13:40:14','2025-09-14 13:40:46'),(40,'App\\Models\\Userss',22,'auth_token','e382e9c02bc61df833ce4363d8a20ce838b75d86d72c53a130e1922c2a5f06a1','[\"*\"]',NULL,NULL,'2025-09-14 13:43:19','2025-09-14 13:43:19'),(41,'App\\Models\\Userss',22,'auth_token','2c48534afa26d7dce004fe72f51ebf92efaa552b9926e863be65f97933ba51a2','[\"*\"]','2025-09-14 13:46:04',NULL,'2025-09-14 13:43:22','2025-09-14 13:46:04'),(42,'App\\Models\\Userss',22,'auth_token','40a9930bb617e8f3e49bcda34e0c556fc89f0500ca890b00327ba7f5a4594557','[\"*\"]','2025-09-14 13:46:00',NULL,'2025-09-14 13:44:36','2025-09-14 13:46:00'),(43,'App\\Models\\Userss',22,'auth_token','2dba601d3c52395f1bb3ac79949b63c2e07990a388b21f93054fc9c00b8cfbb6','[\"*\"]',NULL,NULL,'2025-09-14 13:45:11','2025-09-14 13:45:11'),(44,'App\\Models\\Userss',23,'auth_token','252521effbb28e025594504466239016aea99ab29c8f80a1ba3b54c4b0143a4c','[\"*\"]',NULL,NULL,'2025-09-14 13:46:47','2025-09-14 13:46:47'),(45,'App\\Models\\Userss',23,'auth_token','5e50fb25c6d1a979fa58534712c8dbb3134288ecb1df103452ddefb9d1d658a2','[\"*\"]','2025-09-14 13:47:39',NULL,'2025-09-14 13:46:49','2025-09-14 13:47:39'),(46,'App\\Models\\Userss',23,'auth_token','bc00e75ce0b40ef6ae61c3517378899cacf60e4739ea6142e2f108d0c16a6f16','[\"*\"]',NULL,NULL,'2025-09-14 13:47:51','2025-09-14 13:47:51'),(47,'App\\Models\\Userss',24,'auth_token','cc53267a7ad29ea2429343982fd33bb955087bef39107c0c4d9a7fa379d0777d','[\"*\"]',NULL,NULL,'2025-09-14 19:23:56','2025-09-14 19:23:56'),(48,'App\\Models\\Userss',24,'auth_token','9cc498937b9d45efd6c9c1bd7a2b220ab7b492dcdbb699f1ce74d524dc13f035','[\"*\"]','2025-09-14 19:25:46',NULL,'2025-09-14 19:23:59','2025-09-14 19:25:46'),(49,'App\\Models\\Userss',24,'auth_token','5530ca9704dbf3a7539bb88063964f22b37a5a1d5147a89ba6ef0dbf0b16fe2d','[\"*\"]',NULL,NULL,'2025-09-14 19:25:27','2025-09-14 19:25:27'),(50,'App\\Models\\Userss',24,'auth_token','4cec4d7826ecbcf12efaacfae1422ff812b2ba11ce974f42f155a90eb1f137bd','[\"*\"]',NULL,NULL,'2025-09-14 19:25:54','2025-09-14 19:25:54'),(51,'App\\Models\\Userss',25,'auth_token','cad72ee3926b4761e7e6ddee3de669cf743f12506463e570b2f75de13f624047','[\"*\"]',NULL,NULL,'2025-09-14 19:26:51','2025-09-14 19:26:51'),(52,'App\\Models\\Userss',25,'auth_token','f8f7b4d59a201ce741e72c450344b5de93a2ce72256c34d59271f703e3c2b531','[\"*\"]','2025-09-14 19:28:09',NULL,'2025-09-14 19:26:54','2025-09-14 19:28:09'),(53,'App\\Models\\Userss',25,'auth_token','a5d1f998c7edc70b792c1ab8d8d5b8ff8d66f7a73df105a6c6604610822b057d','[\"*\"]',NULL,NULL,'2025-09-14 19:28:13','2025-09-14 19:28:13'),(54,'App\\Models\\Userss',26,'auth_token','3ccc83475db85606049d3092db364aa7de87db85af1a2917dd6c5c9bbc0dbea4','[\"*\"]',NULL,NULL,'2025-09-14 19:53:36','2025-09-14 19:53:36'),(55,'App\\Models\\Userss',26,'auth_token','739076ff10edf2b84eea78048a632d9d2a4c8238f61e2e9c231f72d0bd714dbc','[\"*\"]','2025-09-14 19:54:58',NULL,'2025-09-14 19:53:39','2025-09-14 19:54:58'),(56,'App\\Models\\Userss',27,'auth_token','cb7ef55988b639d21a24ea1eda011df03e33aa80b2ee29ce1fa2afc4cf07bd5c','[\"*\"]',NULL,NULL,'2025-09-14 20:02:37','2025-09-14 20:02:37'),(57,'App\\Models\\Userss',27,'auth_token','30c024c031d729d1ae0573011f4c835932dc76e81cd0d6123eacbf68313593db','[\"*\"]','2025-09-14 20:07:55',NULL,'2025-09-14 20:06:13','2025-09-14 20:07:55'),(58,'App\\Models\\Userss',27,'auth_token','bc4710ca0395df20ad1cc3971877b79da3b7bd02980ed73059330caf017c36c3','[\"*\"]',NULL,NULL,'2025-09-14 20:06:33','2025-09-14 20:06:33'),(59,'App\\Models\\Userss',27,'auth_token','f9ac67bfab130d47f3fcb19e19aea1e0d20e8225e302aaabbfc057f48ab60e30','[\"*\"]',NULL,NULL,'2025-09-14 20:07:15','2025-09-14 20:07:15'),(60,'App\\Models\\Userss',28,'auth_token','a52df123d2e37e6ace5405f6729bd9606cdcccf1c023f747c91382a327901a26','[\"*\"]',NULL,NULL,'2025-09-14 20:08:28','2025-09-14 20:08:28'),(61,'App\\Models\\Userss',28,'auth_token','9297e4cc2239aa8e1db2d02842a349028f64c25a19564c27bca0d16d2e9a178c','[\"*\"]','2025-09-14 20:09:09',NULL,'2025-09-14 20:08:30','2025-09-14 20:09:09'),(62,'App\\Models\\Userss',29,'auth_token','e3162d50555b3fc33cc1af11434010f4c087c0b8abcbe186d498094c50a6cd37','[\"*\"]','2025-09-14 20:21:02',NULL,'2025-09-14 20:20:38','2025-09-14 20:21:02'),(63,'App\\Models\\Userss',29,'auth_token','0d070fa0ec8cbdcbe854e1dabbebec1ded14737d27eab6e2497b9eb07bb97333','[\"*\"]',NULL,NULL,'2025-09-14 20:20:46','2025-09-14 20:20:46'),(64,'App\\Models\\Userss',29,'auth_token','66426397603d3e4c994c07f433cb03c8c66ed97f4a9920ec6b17cd18c869e9e7','[\"*\"]','2025-09-14 20:32:12',NULL,'2025-09-14 20:21:12','2025-09-14 20:32:12'),(65,'App\\Models\\Userss',30,'auth_token','5c77b485f06b852bb75827cad73496bd0446a92d686f768fc8b3a0086a93be5c','[\"*\"]',NULL,NULL,'2025-09-14 20:35:50','2025-09-14 20:35:50'),(66,'App\\Models\\Userss',30,'auth_token','056e199d574458d6dd12a43a422feb3181adec474d3f6b4773133c3af3d9012c','[\"*\"]',NULL,NULL,'2025-09-14 20:35:53','2025-09-14 20:35:53'),(67,'App\\Models\\Userss',30,'auth_token','00cf08775b6f294dec53eb9ed26a339feea030ed6d4e7d2fa0a199ab5db52888','[\"*\"]','2025-09-14 20:37:40',NULL,'2025-09-14 20:36:26','2025-09-14 20:37:40'),(68,'App\\Models\\Userss',30,'auth_token','da448ae2b524ac1a35edac7b03c0dd62a4440ac593354757b738bb4f88c31fa8','[\"*\"]',NULL,NULL,'2025-09-14 20:37:18','2025-09-14 20:37:18'),(69,'App\\Models\\Userss',31,'auth_token','ad40ccf8c51071165d2b98b8ab394d42d579e07c4e17229e06583a4021126168','[\"*\"]',NULL,NULL,'2025-09-14 20:48:13','2025-09-14 20:48:13'),(70,'App\\Models\\Userss',31,'auth_token','00366e7365a7993c906322b9a2cb7eefb624eceba508980d6ff0da851e435922','[\"*\"]','2025-09-14 20:48:49',NULL,'2025-09-14 20:48:17','2025-09-14 20:48:49'),(71,'App\\Models\\Userss',31,'auth_token','9a542f44e9ceef65e9c971808e91f003e4964e5193b30f967fc920ac3543571b','[\"*\"]',NULL,NULL,'2025-09-14 20:48:57','2025-09-14 20:48:57'),(72,'App\\Models\\Userss',32,'auth_token','5145dadac8ebe47e117926fd84706dfedc424bd5712393df6adcbfc909c30b4f','[\"*\"]',NULL,NULL,'2025-09-14 20:49:45','2025-09-14 20:49:45'),(73,'App\\Models\\Userss',32,'auth_token','6ce2456113b45cbd97058f27c391a3616f71fcb0c9ce6e441a333f39b1ae3ff7','[\"*\"]','2025-09-14 20:53:31',NULL,'2025-09-14 20:49:46','2025-09-14 20:53:31'),(74,'App\\Models\\Userss',33,'auth_token','a902a6729ff209e3b0cd49dad6873edbb7450f01648d3c8375f1c476d885938f','[\"*\"]',NULL,NULL,'2025-09-14 20:56:02','2025-09-14 20:56:02'),(75,'App\\Models\\Userss',33,'auth_token','58104786998cc0789e651178f02b307cd8094db6a917419334f5dc48e10ddef9','[\"*\"]','2025-09-14 21:00:26',NULL,'2025-09-14 20:56:05','2025-09-14 21:00:26'),(76,'App\\Models\\Userss',33,'auth_token','53c34db185155d78655f0acc4fe8841aa4814395b4a6b98572b9c570d8f06802','[\"*\"]',NULL,NULL,'2025-09-14 20:56:57','2025-09-14 20:56:57'),(77,'App\\Models\\Userss',33,'auth_token','66f558760dae616f8f76f515b8ccd8b434d1ff45a0a64b6c448d158b2144d092','[\"*\"]',NULL,NULL,'2025-09-14 20:57:54','2025-09-14 20:57:54'),(78,'App\\Models\\Userss',33,'auth_token','89e148ce1ed773bff4233d60c35c1cc2623c1bdaa07834eb115c31d2aa88a406','[\"*\"]',NULL,NULL,'2025-09-14 20:59:54','2025-09-14 20:59:54'),(79,'App\\Models\\Userss',33,'auth_token','a51c34d98876882adea1baa14041e7d9ae6cb887672f82da662956edcce00570','[\"*\"]',NULL,NULL,'2025-09-14 21:00:29','2025-09-14 21:00:29'),(80,'App\\Models\\Userss',34,'auth_token','8842bd25feb7efd32c448e0d8eb9d7e0c7e05b4d5d3658ef3e3cc00146234538','[\"*\"]','2025-09-14 21:08:26',NULL,'2025-09-14 21:06:08','2025-09-14 21:08:26'),(81,'App\\Models\\Userss',34,'auth_token','4f7e89d95ea0bbfd1986f4655a6f7c2639c72bdf55ed0e86d2bdde4e190cafb8','[\"*\"]',NULL,NULL,'2025-09-14 21:06:19','2025-09-14 21:06:19'),(82,'App\\Models\\Userss',34,'auth_token','a70c6803e30e4febb29f205aa2c46fe00ed3ff6971e8ddd886a21f5eb83d1ec7','[\"*\"]',NULL,NULL,'2025-09-14 21:07:02','2025-09-14 21:07:02'),(83,'App\\Models\\Userss',34,'auth_token','4484602d236342b94ef2c3417939c77bc9c95af67ebb1a1f90dc947421f67579','[\"*\"]',NULL,NULL,'2025-09-14 21:07:18','2025-09-14 21:07:18'),(84,'App\\Models\\Userss',35,'auth_token','9ecae3c87617e1da34971a7e98b7e7014a023bad681fe2365d6e645a6d0674ec','[\"*\"]',NULL,NULL,'2025-09-14 22:51:52','2025-09-14 22:51:52'),(85,'App\\Models\\Userss',35,'auth_token','5d26ac2a3b7b60f7935b2764ef470d67f8541fa2caa49e02cf9b3599a2797034','[\"*\"]','2025-09-14 22:53:34',NULL,'2025-09-14 22:51:56','2025-09-14 22:53:34'),(86,'App\\Models\\Userss',35,'auth_token','71385aae26fa79141de50f356e7c6355388c7d6ba430c5d60596e5e7a05b009c','[\"*\"]','2025-09-14 22:54:51',NULL,'2025-09-14 22:52:49','2025-09-14 22:54:51'),(87,'App\\Models\\Userss',35,'auth_token','72cda1bb8f5e15cb79903d5460d5bf5417afa36a18319d41b12842a660a7a9a0','[\"*\"]',NULL,NULL,'2025-09-14 22:53:15','2025-09-14 22:53:15'),(88,'App\\Models\\Userss',35,'auth_token','1f27889e597872175d0efa690bc04b8b91b329c121219c2753eacaaa254e3fc4','[\"*\"]',NULL,NULL,'2025-09-14 22:53:43','2025-09-14 22:53:43'),(89,'App\\Models\\Userss',35,'auth_token','73b25205b772be402bfed531e33b4df769627fceddc50b0bf8a6fe92bd3ac8db','[\"*\"]',NULL,NULL,'2025-09-14 22:54:12','2025-09-14 22:54:12'),(90,'App\\Models\\Userss',36,'auth_token','e35b4f8c004912389386f6070c6493f94671be6958da6c56c52e7076268240c0','[\"*\"]',NULL,NULL,'2025-09-14 22:56:10','2025-09-14 22:56:10'),(91,'App\\Models\\Userss',36,'auth_token','0b295ff89e60975f5e270af8f1235dd6476878c4eb201695509fff75cdae8e31','[\"*\"]','2025-09-14 23:43:54',NULL,'2025-09-14 22:56:14','2025-09-14 23:43:54'),(92,'App\\Models\\Userss',36,'auth_token','3667b107e735ea9b927299bafa8e8ed2e384eacde9f6cbbd836085ea7d40210b','[\"*\"]','2025-09-14 23:00:00',NULL,'2025-09-14 22:56:33','2025-09-14 23:00:00'),(93,'App\\Models\\Userss',36,'auth_token','8e7e16f5df628e6b357b9f9a0434a37dabcf01c7d9f1f51ae3bdbbbd6581d6f4','[\"*\"]',NULL,NULL,'2025-09-14 23:00:03','2025-09-14 23:00:03'),(94,'App\\Models\\Userss',36,'auth_token','f24144d0848f2315576fa5a6a8e3eeea63de9b8a950b28b4cb78ebf87225ab35','[\"*\"]','2025-09-14 23:43:59',NULL,'2025-09-14 23:10:39','2025-09-14 23:43:59'),(95,'App\\Models\\Userss',36,'auth_token','881e5964d59dd2b67f4700584d6bec52ef456d9fc06b36a128717a09abf19325','[\"*\"]','2025-09-14 23:43:46',NULL,'2025-09-14 23:37:19','2025-09-14 23:43:46'),(96,'App\\Models\\Userss',37,'auth_token','8f6fc2ee6df2bc7b3e55a71c5dea909b581a118404e95a886a637bb8ad5a35e2','[\"*\"]',NULL,NULL,'2025-09-15 00:09:25','2025-09-15 00:09:25'),(97,'App\\Models\\Userss',37,'auth_token','7ab5d56396a747752789a6e76cedd4a101eaa4d12653205e891904ab3f35e92c','[\"*\"]','2025-09-15 00:09:51',NULL,'2025-09-15 00:09:28','2025-09-15 00:09:51'),(98,'App\\Models\\Userss',37,'auth_token','64c0dfc45fb7e940482507c603f9eb82653ae1b585332dc10b4669b146649144','[\"*\"]',NULL,NULL,'2025-09-15 00:09:59','2025-09-15 00:09:59'),(99,'App\\Models\\Userss',38,'auth_token','c3b292c5d07c0604469f6d4e5b0d08f1045f469e7280c34983d1a44a41dc1b0a','[\"*\"]',NULL,NULL,'2025-09-15 00:10:28','2025-09-15 00:10:28'),(100,'App\\Models\\Userss',38,'auth_token','b888404f4606de863bfe580e0aa3951c092caae14893eea76fe068303ba7ffdc','[\"*\"]','2025-09-15 00:19:40',NULL,'2025-09-15 00:10:35','2025-09-15 00:19:40'),(101,'App\\Models\\Userss',38,'auth_token','e92dfd23355191dc0cd6708155b2db2030540c104f1ce8d0d6ae8ac1fec16413','[\"*\"]',NULL,NULL,'2025-09-15 00:12:08','2025-09-15 00:12:08'),(102,'App\\Models\\Userss',38,'auth_token','1392465a27b184a6ba0f4ab7ba2d21fc4b94d3ee066ad99d6ade4a1dab1bd508','[\"*\"]',NULL,NULL,'2025-09-15 00:14:55','2025-09-15 00:14:55'),(103,'App\\Models\\Userss',38,'auth_token','734a56f807e172489bdef8cf8841a6e7ecef0ec2206301d7c5df18ad370987fd','[\"*\"]',NULL,NULL,'2025-09-15 00:15:32','2025-09-15 00:15:32'),(104,'App\\Models\\Userss',38,'auth_token','a809fc3b0ad83aa5c4fd81d22f5468499e35dbe9d20cf66269d5b8b0349a1561','[\"*\"]',NULL,NULL,'2025-09-15 00:16:14','2025-09-15 00:16:14'),(105,'App\\Models\\Userss',38,'auth_token','2f0d6c61e885f9d247786f4fdd492f9a872acaff5811efceb4fc2860b065bd2c','[\"*\"]',NULL,NULL,'2025-09-15 00:16:39','2025-09-15 00:16:39'),(106,'App\\Models\\Userss',38,'auth_token','56e48acba2939c7af50d4e235f1f4b381522dcb8561842d5dde9d58d96a0ad0c','[\"*\"]',NULL,NULL,'2025-09-15 00:19:18','2025-09-15 00:19:18'),(107,'App\\Models\\Userss',39,'auth_token','5e99fa9e09a67c9b124e17671dcee89354af7e3207fc01e51af3020a1c0237e1','[\"*\"]',NULL,NULL,'2025-09-15 01:15:08','2025-09-15 01:15:08'),(108,'App\\Models\\Userss',39,'auth_token','fc2613710882dcdee28fa9cfe64443883617120d1d5a064637a5684d3716337a','[\"*\"]','2025-09-15 01:19:11',NULL,'2025-09-15 01:15:13','2025-09-15 01:19:11'),(109,'App\\Models\\Userss',39,'auth_token','d007f5c97aa884de86d9904f9858dfa441e25ce7057386973d15fffd164cb8a6','[\"*\"]',NULL,NULL,'2025-09-15 01:15:50','2025-09-15 01:15:50'),(110,'App\\Models\\Userss',39,'auth_token','c1fac70c562455a9d6fa88c22179dbd36c27ae91d9d67eb98b69ca947e1d4d5e','[\"*\"]',NULL,NULL,'2025-09-15 01:18:38','2025-09-15 01:18:38'),(111,'App\\Models\\Userss',40,'auth_token','ebae70524a89436ac965a2bad2d42bcf6cde4407dadecb0f983aa7afe2339e1b','[\"*\"]',NULL,NULL,'2025-09-15 01:19:44','2025-09-15 01:19:44'),(112,'App\\Models\\Userss',40,'auth_token','d85295c8cc708305e897328135b2c22f039df6938fe3c51265837a49f087d9fb','[\"*\"]','2025-09-15 01:21:06',NULL,'2025-09-15 01:19:46','2025-09-15 01:21:06'),(113,'App\\Models\\Userss',41,'auth_token','04b1ff4904f3d9722d83d920af79a8b464f747462970d5385e690a4053425b24','[\"*\"]',NULL,NULL,'2025-09-15 01:23:20','2025-09-15 01:23:20'),(114,'App\\Models\\Userss',41,'auth_token','7895f4494757afbb908f36d12db16f33e1958ac8ce0b6dca71a66a92f11286df','[\"*\"]','2025-09-15 01:24:48',NULL,'2025-09-15 01:23:24','2025-09-15 01:24:48'),(115,'App\\Models\\Userss',42,'auth_token','fade96b5a60c5dbf6ac99ec8a15755eb6b29e3ebc695ed859a572e52859f4557','[\"*\"]',NULL,NULL,'2025-09-15 01:27:59','2025-09-15 01:27:59'),(116,'App\\Models\\Userss',42,'auth_token','d02afbf564ccf2ca200d7a5a90905d7dcf779b829a396eeea7baa8665541cf00','[\"*\"]','2025-09-15 01:30:55',NULL,'2025-09-15 01:28:02','2025-09-15 01:30:55'),(117,'App\\Models\\Userss',42,'auth_token','6cef12cc4459492e32f71834c39e916217916857668dd477454bae9d673a0e7e','[\"*\"]',NULL,NULL,'2025-09-15 01:28:46','2025-09-15 01:28:46'),(118,'App\\Models\\Userss',43,'auth_token','7a6ad8bcd9119de57ecf27bfbcf50c781560ac7339211f0f7a8b7e43bdfaaa85','[\"*\"]',NULL,NULL,'2025-09-15 01:43:09','2025-09-15 01:43:09'),(119,'App\\Models\\Userss',43,'auth_token','d268c0f2f4f9deeb5612d5aa3182d50ef9c4189e5be2707ac1d762dac141415b','[\"*\"]','2025-09-15 01:45:19',NULL,'2025-09-15 01:43:12','2025-09-15 01:45:19'),(120,'App\\Models\\Userss',44,'auth_token','892fbe6834c5108cbc1813e079377e111a51d715f4c5e160cd8be40ada2faff4','[\"*\"]',NULL,NULL,'2025-09-15 01:45:42','2025-09-15 01:45:42'),(121,'App\\Models\\Userss',44,'auth_token','b95ef5fea847a6f2082190052897223feec820fefd43d85cb62bac4ad0176692','[\"*\"]','2025-09-15 02:44:04',NULL,'2025-09-15 01:45:48','2025-09-15 02:44:04'),(122,'App\\Models\\Userss',44,'auth_token','56928e303d3a1b118cdb8ebdb8aa682489e0b3e40b612ab40411d56a7aadbc7b','[\"*\"]',NULL,NULL,'2025-09-15 01:47:34','2025-09-15 01:47:34'),(123,'App\\Models\\Userss',45,'auth_token','f23eccf81b231d4d9e83eaaaeef9522aa4785ef7ab7bf702388f117319bd7dcf','[\"*\"]',NULL,NULL,'2025-09-15 02:50:53','2025-09-15 02:50:53'),(124,'App\\Models\\Userss',45,'auth_token','9fdee14bcea0890a89b9665d055dcf4dfe483ba8db41addd237f86acc5556976','[\"*\"]','2025-09-15 02:57:02',NULL,'2025-09-15 02:50:58','2025-09-15 02:57:02'),(125,'App\\Models\\Userss',45,'auth_token','02a965dc2309011769d8f9403b25a6d5f9413d87c77f8ca5c0fcef0d85f04808','[\"*\"]',NULL,NULL,'2025-09-15 02:52:44','2025-09-15 02:52:44'),(126,'App\\Models\\Userss',45,'auth_token','935c2da17223e3a65ac0a62b6f134fe5ae26fa99439ac6d8c2ca11d4a0da403f','[\"*\"]',NULL,NULL,'2025-09-15 02:55:14','2025-09-15 02:55:14'),(127,'App\\Models\\Userss',45,'auth_token','35bf461e07ba9fba2b7534759be1d936b3cb7134207038ae6691dd09ea397138','[\"*\"]',NULL,NULL,'2025-09-15 02:56:39','2025-09-15 02:56:39'),(128,'App\\Models\\Userss',46,'auth_token','9e230f865d54683c786acac8b10d34a677660f85e822785e8d48a1775574fa1c','[\"*\"]',NULL,NULL,'2025-09-15 03:19:58','2025-09-15 03:19:58'),(129,'App\\Models\\Userss',46,'auth_token','0cabe123276e9a2ffcf00361458a5ece6d0a9c2169c96abb38bc82c5fde4eb7d','[\"*\"]','2025-09-15 03:33:56',NULL,'2025-09-15 03:20:08','2025-09-15 03:33:56'),(130,'App\\Models\\Userss',46,'auth_token','c9c898a9a9166931c346619b044c2900e0b1b287ab519f6088c927574f3b0e9b','[\"*\"]',NULL,NULL,'2025-09-15 03:26:11','2025-09-15 03:26:11'),(131,'App\\Models\\Userss',46,'auth_token','71adf6637f198e393569505c480f2d0752c9b0dc2784529d0bfc5fd4b66c55d0','[\"*\"]',NULL,NULL,'2025-09-15 03:28:11','2025-09-15 03:28:11'),(132,'App\\Models\\Userss',46,'auth_token','0ba6c26683227b5776f9d40aff2ebbe4cb671db68c7a0209db0817515033e17f','[\"*\"]','2025-09-15 04:45:49',NULL,'2025-09-15 04:45:29','2025-09-15 04:45:49');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saldousuarios`
--

DROP TABLE IF EXISTS `saldousuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `saldousuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `saldo` DECIMAL(10,2) NOT NULL DEFAULT '0.00',
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `userId` INT NOT NULL,
  `updatedAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userId` (`userId`),
  CONSTRAINT `saldousuarios_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `userss` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB ;

/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saldousuarios`
--

LOCK TABLES `saldousuarios` WRITE;
/*!40000 ALTER TABLE `saldousuarios` DISABLE KEYS */;
INSERT INTO `saldousuarios` VALUES (1,50.00,NULL,46,'2025-09-14 22:33:53');
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
) ENGINE=InnoDB ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('9pTMDpT2WGzjWq472WNYTjb6R3q0kLfVyOhqorzS',NULL,'127.0.0.1','PostmanRuntime/7.46.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNUgyaHpIamlJcktTaElyNTJ2b1RYeGw5U0lORUtoeWs5VWIxSE5WTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1757893535),('P6Jr0UIUvnCu7QGtqkbkvewQLfTZANJXLwmhdvCE',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZnRrUE4zN2ZvNHBBWnhJMTU1U0d4STBTMkVQWkdNdnVla1AzR2xuSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1757889991),('RjjZD2CkzJOWUKdej7lFhTNZsyhhsQLdRsYN8d8K',NULL,'127.0.0.1','PostmanRuntime/7.46.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2oya3VxUDNsaXg0ektpUXYzVkoxeE1GRUFOZUpJckhvbFA2bHFDcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1757839654),('V05T7bf2nVFb3eJeu7zcL5EW1NpwkiWLZektf2HD',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUGplcEtRb2UxQzFsRnFDbE1ESFVyMXlqMXRQeVhjN3VPSnJMSk5NQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1757806471),('VLyD0jmFMW66ECS7Y7UuQ70galFpHEZS6VGc4Qxo',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFBqU2E0dDd2VlZNU0NUcFVIZGczTmVKUWI5Q21UemNHbEg1aXo5VCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1757836307),('xsOOuCAIoDmTF5IrXo35uGsQjPfCjdgebY55Pel5',11,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWGRoOExjN1F4bHlUV1d0TlM1SFlTUDh1bHh5OWVUNUhGRWRNeVdPTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC90aWVuZGEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMTt9',1757806540),('ZYmWT3P9cCmXSTnnXx7bchaJukp4K5neyQUCrgEa',11,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWXFtamY1OHZYMTluOGNlazV0b3NPaGhMT3JBVGZybXBqeXdFd3F2YSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC90aWVuZGEvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7fQ==',1757833645);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaccions`
--

DROP TABLE IF EXISTS `transaccions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaccions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` ENUM('DEPOSITO','RETIRO') NOT NULL,
  `monto` DECIMAL(10,2) NOT NULL,
  `estado` ENUM('PENDIENTE','APROBADO','RECHAZADO') DEFAULT 'PENDIENTE',
  `flag_transaccion` INT DEFAULT '0',
  `metodo_pago` VARCHAR(255) DEFAULT NULL,
  `referencia` VARCHAR(255) DEFAULT NULL,
  `observacion` TEXT,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `userId` INT DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  CONSTRAINT `transaccions_ibfk_1` FOREIGN KEY (`userId`)
      REFERENCES `userss` (`id`)
      ON DELETE SET NULL
      ON UPDATE CASCADE
) ENGINE=InnoDB ;

/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaccions`
--

LOCK TABLES `transaccions` WRITE;
/*!40000 ALTER TABLE `transaccions` DISABLE KEYS */;
INSERT INTO `transaccions` VALUES (1,'DEPOSITO',30.00,'APROBADO',0,'BONO_REGISTRO','Registro inicial','Bono de bienvenida por registro','2025-09-15 03:19:58','2025-09-15 03:19:58',46),(2,'RETIRO',10.00,'APROBADO',0,'COMPRA','Compra de Camisa','Compra de 1 unidad(es) de Camisa - Total: $10','2025-09-15 03:23:05','2025-09-15 03:23:05',46),(3,'DEPOSITO',10.00,'APROBADO',0,'',NULL,NULL,'2025-09-15 03:25:13','2025-09-15 03:25:13',46),(4,'RETIRO',20.00,'APROBADO',1,'Plin',NULL,'Retiro para usuario','2025-09-15 03:25:50','2025-09-15 03:25:50',46),(5,'DEPOSITO',20.00,'APROBADO',1,'Yape','OP-123456','Recarga desde celular','2025-09-15 03:26:56','2025-09-15 03:26:56',46),(6,'RETIRO',10.00,'APROBADO',0,'COMPRA','Compra de Camisa','Compra de 1 unidad(es) de Camisa - Total: $10','2025-09-15 03:27:43','2025-09-15 03:27:43',46),(7,'DEPOSITO',10.00,'APROBADO',0,'',NULL,NULL,'2025-09-15 03:28:29','2025-09-15 03:28:29',46),(8,'RETIRO',10.00,'APROBADO',0,'COMPRA','Compra de Camisa','Compra de 1 unidad(es) de Camisa - Total: $10','2025-09-15 03:29:54','2025-09-15 03:29:54',46),(9,'DEPOSITO',10.00,'APROBADO',0,'',NULL,NULL,'2025-09-15 03:30:17','2025-09-15 03:30:17',46),(10,'DEPOSITO',10.00,'APROBADO',0,'',NULL,NULL,'2025-09-15 03:32:46','2025-09-15 03:32:46',46),(11,'RETIRO',20.00,'APROBADO',1,'Plin',NULL,'Retiro para usuario','2025-09-15 03:33:41','2025-09-15 03:33:41',46),(12,'DEPOSITO',20.00,'APROBADO',1,'Yape','OP-123456','Recarga desde celular','2025-09-15 03:33:53','2025-09-15 03:33:53',46);
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
  `ronda_actual` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `juego_id` (`juego_id`),
  CONSTRAINT `fk_userjuegos_user` FOREIGN KEY (`user_id`) REFERENCES `userss` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_userjuegos_juego` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB ;

/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userjuegos`
--

LOCK TABLES `userjuegos` WRITE;
/*!40000 ALTER TABLE `userjuegos` DISABLE KEYS */;
INSERT INTO `userjuegos` VALUES (1,1,'2025-09-14 22:25:13','2025-09-14 22:32:46',46,1,3);
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
  `nro_cuenta` varchar(50) DEFAULT NULL,
  `cel` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` tinyint NOT NULL DEFAULT '1' COMMENT '1 = Usuario, 2 = Admin, etc.',
  `bancoId` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `flag_ronda_1` tinyint(1) NOT NULL DEFAULT '0',
  `flag_puede_retirar` tinyint(1) NOT NULL DEFAULT '0',
  `menu_actual` int DEFAULT '1',
  `ultimo_retiro` decimal(10,2) DEFAULT NULL,
  `estado_partida_comodin` int NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=47 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userss`
--

LOCK TABLES `userss` WRITE;
/*!40000 ALTER TABLE `userss` DISABLE KEYS */;
INSERT INTO `userss` VALUES (46,'Prueba 22','prueba22@correo.com',NULL,'987654321','$2y$12$i.Z.ju4fwLeETL1EHpXhEejvb0XjFsu9sRIZA0wNNHHQ16Xlyvssu',1,NULL,'2025-09-15 03:19:58','2025-09-15 03:33:53',0,0,1,0.00,2);
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
  `n_ronda` int DEFAULT NULL,
  `flag_mayor` tinyint(1) NOT NULL DEFAULT '0',
  `ganancia` decimal(10,2) DEFAULT NULL,
  `nivel` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;

INSERT INTO `venta` VALUES (1,'Camisa',10.00,'/images/1755271853_car.png',66,'2025-08-10 23:56:53','2025-09-14 22:29:54',1,0,10.00,1),(2,'Pantalón',30.00,'/images/1755274579_pantalon.png',99,'2025-08-10 23:56:53','2025-08-15 16:16:19',2,0,30.00,2),(3,'Zapatos',20.00,'/images/casaca.jpg',99,'2025-08-10 23:56:53','2025-09-14 07:54:04',2,0,20.00,1),(4,'Carro',50.00,'/images/1755271922_carro prueba (1).jpg',99,'2025-08-15 15:32:02','2025-08-15 15:32:02',3,0,50.00,1),(5,'FORTIS',66.00,'images/hIbTgvSVXwpm6fhFj4vZWXBgvmJLwLThfuTKs0Vr.png',99,'2025-08-16 00:42:00','2025-08-16 00:43:27',3,0,66.00,2),(6,'Chompa',40.00,'images/vVFhkalCgibhXncSSRik7cHkGw97kQuT99zzqtxV.jpg',99,'2025-09-04 13:43:06','2025-09-04 13:43:21',2,0,40.00,3);

UNLOCK TABLES;
