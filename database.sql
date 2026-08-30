-- MySQL dump 10.13  Distrib 8.4.7, for Win64 (x86_64)
--
-- Host: localhost    Database: video_center_cedric_db
-- ------------------------------------------------------
-- Server version	8.4.7

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
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20260725074341','2026-07-25 07:47:40',37),('DoctrineMigrations\\Version20260725133012','2026-07-25 13:32:15',73),('DoctrineMigrations\\Version20260725134824','2026-07-25 13:53:25',131),('DoctrineMigrations\\Version20260725164914','2026-07-25 16:50:37',21),('DoctrineMigrations\\Version20260725182410','2026-07-25 18:24:46',138),('DoctrineMigrations\\Version20260725184108','2026-07-25 18:43:17',17),('DoctrineMigrations\\Version20260726071432','2026-07-26 07:17:17',99);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750` (`queue_name`,`available_at`,`delivered_at`,`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
INSERT INTO `messenger_messages` VALUES (1,'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":5:{i:0;s:41:\\\"registration/confirmation_email.html.twig\\\";i:1;N;i:2;a:3:{s:9:\\\"signedUrl\\\";s:167:\\\"https://127.0.0.1:8000/verify/email?expires=1785003168&signature=zE508kPtCL441boU4DSoyqqLUzONjkX5aTGbISmFQ0k&token=TWN7VPe%2FDO%2FUciG%2BVZ8kA6hMmgAbCU1rQgJfboAgrv0%3D\\\";s:19:\\\"expiresAtMessageKey\\\";s:26:\\\"%count% hour|%count% hours\\\";s:20:\\\"expiresAtMessageData\\\";a:1:{s:7:\\\"%count%\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:24:\\\"no-reply@videocenter.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:12:\\\"Video Center\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:15:\\\"test1@test1.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:25:\\\"Please Confirm your Email\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}i:4;N;}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}','[]','default','2026-07-25 17:12:48','2026-07-25 17:12:48',NULL),(2,'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":5:{i:0;s:41:\\\"registration/confirmation_email.html.twig\\\";i:1;N;i:2;a:3:{s:9:\\\"signedUrl\\\";s:163:\\\"https://127.0.0.1:8000/verify/email?expires=1785003507&signature=rTOCSz6OCd2bQqr4DZ-mFvlrnANvyATS097muYYXicM&token=XMikYX1bwWmzSmiseyBfoBd%2BHpkJ1S7Sp0O2jSL1Q3Q%3D\\\";s:19:\\\"expiresAtMessageKey\\\";s:26:\\\"%count% hour|%count% hours\\\";s:20:\\\"expiresAtMessageData\\\";a:1:{s:7:\\\"%count%\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:24:\\\"no-reply@videocenter.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:12:\\\"Video Center\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:14:\\\"test2@test.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:25:\\\"Please Confirm your Email\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}i:4;N;}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}','[]','default','2026-07-25 17:18:27','2026-07-25 17:18:27',NULL);
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reset_password_requests`
--

DROP TABLE IF EXISTS `reset_password_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reset_password_requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `selector` varchar(20) NOT NULL,
  `hashed_token` varchar(100) NOT NULL,
  `requested_at` datetime NOT NULL,
  `expires_at` datetime NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_16646B41A76ED395` (`user_id`),
  CONSTRAINT `FK_16646B41A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reset_password_requests`
--

LOCK TABLES `reset_password_requests` WRITE;
/*!40000 ALTER TABLE `reset_password_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `reset_password_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_verified` tinyint NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'goku@test.com','[]','$2y$13$C0UoQfI3cMYtmb0Ai/SOQupM3ELLEq1h/zzo/bNbN4J32PDZpJsHC','Goku','Son','2026-07-27 16:01:42','2026-07-27 16:01:42',1,'default.png'),(2,'seiya@test.com','[]','$2y$13$5BvNflrsVI5BZn0AlrVy/e8l/kdNb2KI7o4lgP18aB5AMGmNdi8nW','Seiya','Pegasus','2026-07-27 16:01:43','2026-07-27 16:01:43',1,'default.png'),(3,'simba@test.com','[]','$2y$13$/rwisY/Iu7sp11ooFe13NONGmJEl7eBqiE7dhPLFYmfhQofznZHpu','Simba','Roi Lion','2026-07-27 16:01:43','2026-07-27 16:01:43',1,'default.png'),(4,'test@test.com','[]','$2y$13$tQ4NkKZJpyAS8BFbUMa4h.gzccK/R6zfZ808CUroNUlYJ2.9duk0G','Test','Utilisateur','2026-07-27 16:01:44','2026-07-27 16:01:44',0,'default.png'),(5,'test414@test.com','[]','$2y$13$rhgwWxACsHS.q8tl4I/Sa.QVFLXpmJfyZOKRYsKHST1FP6go0msju','test414','test414','2026-08-27 21:31:20','2026-08-27 21:44:44',1,'default.png'),(6,'test44000@test.com','[]','$2y$13$90c0fVdbH0EVtphL2IWvI.kavXcckQT67M0tcYz3HDA6YNIqwQTeu','test','test','2026-08-30 15:10:12','2026-08-30 22:35:51',1,'favicon-agc-6a94b047e1c25119234679.png'),(7,'test44001@test.com','[]','$2y$13$7lz3LzYbd8A3Wwje9t9Xn.W7suz6RavcCBffTncPsvk35mDqZTklu','test','test','2026-08-30 15:20:03','2026-08-30 15:20:03',0,'default.png');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `videos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `video_link` varchar(500) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `auteur_id` int NOT NULL,
  `premium_video` tinyint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29AA643260BB6FE6` (`auteur_id`),
  CONSTRAINT `FK_29AA643260BB6FE6` FOREIGN KEY (`auteur_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` VALUES (1,'Vice Versa','https://www.youtube.com/embed/8n-cJDFQELA','Vice Versa','2026-07-27 16:01:44','2026-07-27 16:01:44',1,0),(2,'Le Roi Lion (2019)','https://www.youtube.com/embed/tvvQitXftGk','Le Roi Lion (2019)','2026-07-27 16:01:44','2026-07-27 16:01:44',2,0),(3,'Aladdin (1992)','https://www.youtube.com/embed/NZqFRTbi7IE','Aladdin (1992)','2026-07-27 16:01:44','2026-07-27 16:01:44',3,0),(4,'Toy Story (1995)','https://www.youtube.com/embed/q_1wTx-qIpk','Toy Story (1995)','2026-07-27 16:01:44','2026-07-27 16:01:44',1,0),(5,'Toy Story 2 (1999)','https://www.youtube.com/embed/FBkecaF2Jtg','Toy Story 2 (1999)','2026-07-27 16:01:44','2026-07-27 16:01:44',2,0),(6,'Shrek (2001)','https://www.youtube.com/embed/Qz2Xklx9vIQ','Shrek (2001)','2026-07-27 16:01:44','2026-07-27 16:01:44',3,0),(7,'Shrek 2 (2004)','https://www.youtube.com/embed/gUmvgMUC3Wg','Shrek 2 (2004)','2026-07-27 16:01:44','2026-07-27 16:01:44',3,0),(8,'Le Monde de Narnia : Chapitre 1 (2005)','https://www.youtube.com/embed/ztFix1KQmSI','Le Monde de Narnia : Chapitre 1 (2005)','2026-07-27 16:01:44','2026-07-27 16:01:44',3,0),(9,'Small Soldiers (1998)','https://www.youtube.com/embed/I5wBxwnQzYA','Small Soldiers (1998)','2026-07-27 16:01:44','2026-07-27 16:01:44',1,0),(10,'Jumanji (1995)','https://www.youtube.com/embed/9P6TZcCk0MM','Jumanji (1995)','2026-07-27 16:01:44','2026-07-27 16:01:44',1,0),(11,'Hook (1991)','https://www.youtube.com/embed/9CO9Ax9SUto','Hook (1991)','2026-07-27 16:01:44','2026-07-27 16:01:44',2,0),(12,'Karaté Kid (1984)','https://www.youtube.com/embed/r_8Rw16uscg','Karaté Kid (1984)','2026-07-27 16:01:44','2026-07-27 16:01:44',2,0),(13,'Les 3 Ninjas (1992)','https://www.youtube.com/embed/wACe6uzBNeo','Les 3 Ninjas (1992)','2026-07-27 16:01:44','2026-07-27 16:01:44',3,0),(14,'Chérie, j\'ai rétréci les gosses (1989)','https://www.youtube.com/embed/hwmHwx5kZ8A','Chérie, j\'ai rétréci les gosses (1989)','2026-07-27 16:01:44','2026-07-27 16:01:44',1,0),(15,'Les Goonies (1985)','https://www.youtube.com/embed/VWo5MKznBwM','Les Goonies (1985)','2026-07-27 16:01:44','2026-07-27 16:01:44',3,0),(16,'Vice Versa - Bande-annonce bonus','https://www.youtube.com/embed/Ppli1jdJ2wE','Vice Versa - Bande-annonce bonus','2026-07-27 16:01:44','2026-07-27 16:01:44',1,1),(17,'Le Roi Lion (2019) - Teaser officiel VF','https://www.youtube.com/embed/gQVnhLGdS6c','Le Roi Lion (2019) - Teaser officiel VF','2026-07-27 16:01:44','2026-07-27 16:01:44',2,1),(18,'Toy Story (1995) - Spot 30 ans du film','https://www.youtube.com/embed/zSM0HVks_xo','Toy Story (1995) - Spot 30 ans du film','2026-07-27 16:01:44','2026-07-27 16:01:44',3,1),(19,'Toy Story 2 (1999) - Bande-annonce alternative','https://www.youtube.com/embed/2FlAUxq1MUU','Toy Story 2 (1999) - Bande-annonce alternative','2026-07-27 16:01:44','2026-07-27 16:01:44',2,1),(20,'Shrek (2001) - Bande-annonce DVD VF','https://www.youtube.com/embed/q67Dtb7fKmI','Shrek (2001) - Bande-annonce DVD VF','2026-07-27 16:01:44','2026-07-27 16:01:44',3,1),(21,'Le Monde de Narnia (2005) - VOST','https://www.youtube.com/embed/ICJ52dYwtns','Le Monde de Narnia (2005) - VOST','2026-07-27 16:01:44','2026-07-27 16:01:44',3,1),(22,'Jumanji (1995) - VOST','https://www.youtube.com/embed/cU5qiliNWBU','Jumanji (1995) - VOST','2026-07-27 16:01:44','2026-07-27 16:01:44',1,1),(23,'Hook (1991) - VOSTFR','https://www.youtube.com/embed/pX__DhWO3g4','Hook (1991) - VOSTFR','2026-07-27 16:01:44','2026-07-27 16:01:44',1,1),(24,'Les Goonies (1985) - VOST','https://www.youtube.com/embed/nZYjDoxeyvo','Les Goonies (1985) - VOST','2026-07-27 16:01:44','2026-07-27 16:01:44',2,1),(27,'test','https://test.com','loooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooong','2026-08-30 19:31:12','2026-08-30 19:31:12',6,0),(28,'Test44','https://test.com','looooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooong','2026-08-30 19:32:34','2026-08-30 21:35:51',6,0);
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-31  1:16:24
