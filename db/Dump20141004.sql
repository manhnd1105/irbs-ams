CREATE DATABASE  IF NOT EXISTS `irbs` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `irbs`;
-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: irbs
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.12.04.1

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(50) DEFAULT NULL,
  `staff_name` varchar(80) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (8,'manhnd','Nguyễn Đức Mạnh','123456'),(31,'bb1','bb','bb'),(32,'ccc','sadsad','123sad'),(64,'manh','asdfds','dfsgfdg'),(66,'fdg','dsg','fdg');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inkiu_account`
--

DROP TABLE IF EXISTS `inkiu_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inkiu_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(300) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `parent_id` varchar(45) DEFAULT NULL,
  `path` varchar(500) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `depth` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_InkiuAccount_Account` FOREIGN KEY (`id`) REFERENCES `account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inkiu_account`
--

LOCK TABLES `inkiu_account` WRITE;
/*!40000 ALTER TABLE `inkiu_account` DISABLE KEYS */;
INSERT INTO `inkiu_account` VALUES (8,'fdg',0,9,NULL,'/','fd',1),(31,'dsf',1,4,'8','/manhnd','bbb',2),(32,'sdf',2,3,'31','/manhnd/bbb','sadf',3),(64,'dump',7,8,'33','manhnd/manhnd1/manh/','1111',3),(66,'dump',5,6,'33','manhnd/manhnd1/fdg/','dfg',3);
/*!40000 ALTER TABLE `inkiu_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inkiu_order`
--

DROP TABLE IF EXISTS `inkiu_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inkiu_order` (
  `id` int(11) NOT NULL,
  `creator` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_inkiu_order_order1` FOREIGN KEY (`id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inkiu_order`
--

LOCK TABLES `inkiu_order` WRITE;
/*!40000 ALTER TABLE `inkiu_order` DISABLE KEYS */;
INSERT INTO `inkiu_order` VALUES (1,'dfds'),(2,'dsfdsf');
/*!40000 ALTER TABLE `inkiu_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(500) DEFAULT NULL,
  `creation_date` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (1,'fds','dsfs'),(2,'sdf','e33');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_component`
--

DROP TABLE IF EXISTS `order_component`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_component` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_component`
--

LOCK TABLES `order_component` WRITE;
/*!40000 ALTER TABLE `order_component` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_component` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_component_feedback`
--

DROP TABLE IF EXISTS `order_component_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_component_feedback` (
  `id` int(11) NOT NULL,
  `feedback_creation_date` datetime DEFAULT NULL,
  `feedback_content` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_order_component_feedback_order_component1` FOREIGN KEY (`id`) REFERENCES `order_component` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_component_feedback`
--

LOCK TABLES `order_component_feedback` WRITE;
/*!40000 ALTER TABLE `order_component_feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_component_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_component_image`
--

DROP TABLE IF EXISTS `order_component_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_component_image` (
  `id` int(11) NOT NULL,
  `image_link` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_order_component_image_order_component1` FOREIGN KEY (`id`) REFERENCES `order_component` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_component_image`
--

LOCK TABLES `order_component_image` WRITE;
/*!40000 ALTER TABLE `order_component_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_component_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_component_level`
--

DROP TABLE IF EXISTS `order_component_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_component_level` (
  `id` int(11) NOT NULL,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_order_component_level_order_component1` FOREIGN KEY (`id`) REFERENCES `order_component` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_component_level`
--

LOCK TABLES `order_component_level` WRITE;
/*!40000 ALTER TABLE `order_component_level` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_component_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_component_status`
--

DROP TABLE IF EXISTS `order_component_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_component_status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(45) DEFAULT NULL,
  `status_description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_order_component_status_order_component1` FOREIGN KEY (`id`) REFERENCES `order_component` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_component_status`
--

LOCK TABLES `order_component_status` WRITE;
/*!40000 ALTER TABLE `order_component_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_component_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_has_component`
--

DROP TABLE IF EXISTS `order_has_component`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_has_component` (
  `order_id` int(11) NOT NULL,
  `order_component_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`,`order_component_id`),
  KEY `fk_order_has_order_component_order_component1_idx` (`order_component_id`),
  KEY `fk_order_has_order_component_order1_idx` (`order_id`),
  CONSTRAINT `fk_order_has_order_component_order1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_order_has_order_component_order_component1` FOREIGN KEY (`order_component_id`) REFERENCES `order_component` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_has_component`
--

LOCK TABLES `order_has_component` WRITE;
/*!40000 ALTER TABLE `order_has_component` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_has_component` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rbac_permissions`
--

DROP TABLE IF EXISTS `rbac_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rbac_permissions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Lft` int(11) NOT NULL,
  `Rght` int(11) NOT NULL,
  `Title` varchar(64) DEFAULT NULL,
  `Description` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rbac_permissions`
--

LOCK TABLES `rbac_permissions` WRITE;
/*!40000 ALTER TABLE `rbac_permissions` DISABLE KEYS */;
INSERT INTO `rbac_permissions` VALUES (1,0,99,'root','root'),(2,1,98,'irbs',''),(3,2,19,'account',''),(4,3,18,'account_controller',''),(5,4,5,'index',''),(6,6,7,'create',''),(7,8,9,'update',''),(8,10,11,'delete',''),(9,12,13,'view_create',''),(10,14,15,'view_update',''),(11,16,17,'list_roles',''),(12,20,25,'home',''),(13,21,24,'home_controller',''),(14,22,23,'index',''),(15,26,31,'template',''),(16,27,30,'template_controller',''),(17,28,29,'demo_template',''),(18,32,45,'authentication',''),(19,33,44,'authentication_controller',''),(20,34,35,'index',''),(21,36,37,'login',''),(22,38,39,'logout',''),(23,40,41,'view_main',''),(24,42,43,'view_login',''),(25,46,97,'rbac',''),(26,47,62,'rbac_controller',''),(27,48,49,'index',''),(28,50,51,'assign_role_perm',''),(29,52,53,'unassign_role_perm',''),(30,54,55,'view_assign_role_perm',''),(31,56,57,'assign_acc_role',''),(32,58,59,'unassign_acc_role',''),(33,60,61,'view_assign_acc_role',''),(34,63,76,'role_controller',''),(35,64,65,'index',''),(36,66,67,'create',''),(37,68,69,'update',''),(38,70,71,'delete',''),(39,72,73,'view_create',''),(40,74,75,'view_update',''),(41,77,96,'perm_controller',''),(42,78,79,'index',''),(43,80,83,'create',''),(44,84,85,'update',''),(45,86,87,'delete',''),(46,88,89,'view_create',''),(47,90,91,'view_update',''),(48,92,93,'assign_perm_role',''),(49,94,95,'assign_perm_roles',''),(50,81,82,'dsfd','dsf');
/*!40000 ALTER TABLE `rbac_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rbac_rolepermissions`
--

DROP TABLE IF EXISTS `rbac_rolepermissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rbac_rolepermissions` (
  `RoleID` int(11) NOT NULL,
  `PermissionID` int(11) NOT NULL,
  `AssignmentDate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rbac_rolepermissions`
--

LOCK TABLES `rbac_rolepermissions` WRITE;
/*!40000 ALTER TABLE `rbac_rolepermissions` DISABLE KEYS */;
INSERT INTO `rbac_rolepermissions` VALUES (8,12,1410145306),(8,13,1410145306),(8,14,1410145306),(8,15,1410145306),(8,16,1410145306),(8,17,1410145306),(8,18,1410145306),(8,19,1410145306),(8,20,1410145306),(8,21,1410145306),(8,22,1410145306),(8,23,1410145306),(8,24,1410145306),(3,2,1410145638),(3,3,1410145638),(3,4,1410145638),(3,42,1410145638),(3,43,1410145638),(3,44,1410145638),(3,45,1410145638),(3,46,1410145638),(3,47,1410145638),(3,11,1410145638),(3,12,1410145638),(3,13,1410145638),(3,15,1410145638),(3,16,1410145638),(3,17,1410145638),(3,18,1410145638),(3,19,1410145638),(3,21,1410145638),(3,22,1410145638),(3,23,1410145638),(3,24,1410145638),(3,25,1410145638),(3,26,1410145638),(3,28,1410145638),(3,29,1410145639),(3,30,1410145639),(3,31,1410145639),(3,32,1410145639),(3,33,1410145639),(3,34,1410145639),(3,41,1410145639),(3,48,1410145639),(3,49,1410145639);
/*!40000 ALTER TABLE `rbac_rolepermissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rbac_roles`
--

DROP TABLE IF EXISTS `rbac_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rbac_roles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Lft` int(11) NOT NULL,
  `Rght` int(11) NOT NULL,
  `Title` varchar(128) NOT NULL,
  `Description` text,
  `Path` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rbac_roles`
--

LOCK TABLES `rbac_roles` WRITE;
/*!40000 ALTER TABLE `rbac_roles` DISABLE KEYS */;
INSERT INTO `rbac_roles` VALUES (1,0,15,'root','root',NULL),(2,1,14,'irbs','',NULL),(3,2,7,'admin','',NULL),(4,3,4,'local-admin','',NULL),(5,5,6,'remote-admin','',NULL),(6,8,9,'member','',NULL),(7,10,11,'guest','',NULL),(8,12,13,'unauthorized','',NULL);
/*!40000 ALTER TABLE `rbac_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rbac_userroles`
--

DROP TABLE IF EXISTS `rbac_userroles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rbac_userroles` (
  `UserID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `AssignmentDate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rbac_userroles`
--

LOCK TABLES `rbac_userroles` WRITE;
/*!40000 ALTER TABLE `rbac_userroles` DISABLE KEYS */;
INSERT INTO `rbac_userroles` VALUES (0,8,1410144906),(0,8,1410145271),(0,8,1410145306),(3,8,1410145659),(3,8,1410145870),(8,3,1410146103);
/*!40000 ALTER TABLE `rbac_userroles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-04 10:05:19
