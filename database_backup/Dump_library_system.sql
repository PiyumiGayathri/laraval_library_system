-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: library_system
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `book_category`
--

DROP TABLE IF EXISTS `book_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `book_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_category`
--

LOCK TABLES `book_category` WRITE;
/*!40000 ALTER TABLE `book_category` DISABLE KEYS */;
INSERT INTO `book_category` VALUES (1,'Science','2025-10-13 14:49:46','2025-10-13 14:49:48'),(2,'Horror','2025-10-13 14:49:59','2025-10-13 14:50:00'),(3,'Fiction','2025-10-13 14:51:10','2025-10-13 14:51:12'),(4,'Historical','2025-10-13 14:51:30','2025-10-13 14:51:31'),(5,'Autobiography','2025-10-13 15:31:55','2025-10-13 15:31:56'),(6,'Fantacy','2025-10-13 15:34:35','2025-10-13 15:34:36');
/*!40000 ALTER TABLE `book_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `author` varchar(45) NOT NULL,
  `price` double NOT NULL,
  `stock` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `book_category_id` int NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_books_book_category_idx` (`book_category_id`),
  CONSTRAINT `fk_books_book_category` FOREIGN KEY (`book_category_id`) REFERENCES `book_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'A Brief History of Time','Stephan Howking',3500,3,'2025-10-13 14:52:56','2025-10-14 13:04:57',1,1),(2,'Harry Potter and the Sorcere\'s Stone','J.K Rowling',2800,6,'2025-10-13 14:54:10','2025-10-13 14:54:11',3,0),(3,'1776','David McCullough',1650,11,'2025-10-13 14:55:27','2025-10-14 12:47:59',4,1),(4,'The Diary of a Young Girl','Anne Frank',2100,3,'2025-10-13 15:33:20','2025-10-13 15:33:21',5,0),(5,'Alice\'s Adventures in Wonderland','Lewis Carrol',1230,12,'2025-10-13 15:34:53','2025-10-14 13:35:28',6,1),(6,'Frankestein','Mary Shelley',2400,9,'2025-10-13 10:30:20','2025-10-14 16:17:22',2,0),(7,'To Kill a Moking Bird','Harper Lee',2050,4,'2025-10-14 07:01:06','2025-11-14 07:01:15',3,0),(8,'Animal Farm','George Orwell and Christoper Hitchens',2100,15,'2025-10-14 07:05:26','2025-11-14 07:05:27',3,0),(9,'Open','Andre Agassi',2000,2,'2025-10-14 07:07:56','2025-10-14 16:27:16',5,0),(11,'1984','George Orwell',3285,2,'2025-10-14 05:16:03','2025-10-14 05:16:03',3,1),(12,'On the Origin of Species','Charled Davin',2560,4,'2025-10-14 16:03:29','2025-10-14 16:03:29',1,0);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `borrows`
--

DROP TABLE IF EXISTS `borrows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `borrows` (
  `id` int NOT NULL AUTO_INCREMENT,
  `users_id` int NOT NULL,
  `books_id` int NOT NULL,
  `borrowed_at` timestamp NOT NULL,
  `returned_at` timestamp NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_borrows_users1_idx` (`users_id`),
  KEY `fk_borrows_books1_idx` (`books_id`),
  CONSTRAINT `fk_borrows_books1` FOREIGN KEY (`books_id`) REFERENCES `books` (`id`),
  CONSTRAINT `fk_borrows_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `borrows`
--

LOCK TABLES `borrows` WRITE;
/*!40000 ALTER TABLE `borrows` DISABLE KEYS */;
INSERT INTO `borrows` VALUES (1,1,3,'2025-09-13 18:06:38','2025-10-18 18:06:38',1),(2,2,5,'2025-09-13 18:06:51','2025-11-13 04:06:38',0),(3,3,6,'2025-10-13 18:07:03','2025-10-14 16:17:22',1),(4,2,2,'2025-10-14 00:39:53','2025-11-14 06:10:20',0),(5,3,7,'2025-10-14 07:08:59','2025-11-14 07:09:00',0),(6,1,8,'2025-08-14 07:09:44','2025-11-14 07:09:45',0),(7,3,2,'2025-07-14 07:10:28','2025-10-14 07:10:29',0),(8,2,5,'2025-07-14 07:11:01','2025-10-14 07:11:03',0),(9,2,2,'2025-10-14 15:39:50','2025-11-26 18:30:00',0),(10,5,9,'2025-10-14 16:27:16','2025-10-29 18:30:00',0);
/*!40000 ALTER TABLE `borrows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nic` varchar(15) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `registered_at` timestamp NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'567832678v','Lakshitha','Gayan','2025-10-13 18:03:00','0712223331','lakshitha@yahoo.com'),(2,'200645377865','Ridmi','Sewmini','2025-10-13 18:03:00','0743335556','ridmi2004@gmail.com'),(3,'200587654907','Mihiran','Madhawa','2025-10-13 18:03:00','0754446667','madawa.mihiran@gmail.com'),(4,'20004003562','Sadaru','Dhanushka','2025-10-14 10:57:37','0754443332','sadaru@yahoo.com'),(5,'743567899v','Dharmasena','Hettiarachchi','2025-10-14 11:02:21','0768906765','dharmasena@yahoo.com');
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

-- Dump completed on 2025-10-15 13:04:48
