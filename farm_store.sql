-- MySQL dump 10.13  Distrib 5.7.19, for Win64 (x86_64)
--
-- Host: localhost    Database: farm_store
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `date_add` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'LIVESTOCK','2019-06-13'),(2,'CEREALS','2019-06-13'),(3,'FRUIT','2019-06-13'),(4,'VEGETABLES','2019-06-13'),(5,'TUBES','2019-06-13');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_cart`
--

DROP TABLE IF EXISTS `customer_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_cart` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `prdID` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `date_add` varchar(120) DEFAULT NULL,
  `customerNumber` varchar(13) DEFAULT NULL,
  `customerAddress` varchar(225) DEFAULT NULL,
  `customerName` varchar(225) DEFAULT NULL,
  `transcationID` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_cart`
--

LOCK TABLES `customer_cart` WRITE;
/*!40000 ALTER TABLE `customer_cart` DISABLE KEYS */;
INSERT INTO `customer_cart` VALUES (29,6,4,'2019-05-30','08060451456','Gidan Igwa','Olamide','ae474'),(30,7,4,'2019-05-30','08060451456','Gidan Igwa','Olamide','ae474'),(31,6,10,'2019-05-30','090871234567','Opposite Police Quarters ','Olamide Abdulraheem','4ff65c70a'),(32,7,4,'2019-05-30','090871234567','Opposite Police Quarters ','Olamide Abdulraheem','4ff65c70a'),(33,4,2,'2019-05-30','090871234567','Opposite Police Quarters ','Olamide Abdulraheem','4ff65c70a'),(34,6,1,'2019-05-30','234567890','fcghbjklm,','Olamide Abdulraheem','35f5bf3af'),(35,6,1,'2019-05-30','123567','dcvbnfgnbbvv','Olamide Abdulraheema AA','1586da71e'),(36,6,1,'2019-05-30','1111','qqqqq','Olamide Abdulraheema AA','dc48b40e5'),(37,6,1,'2019-05-30','11','qq','Olamide Abdulraheema AA','2fb5aa9d2'),(38,6,1,'2019-05-30','11','qqqs','Olamide Abdulraheema AA','2581c4677'),(39,6,3,'2019-05-30','090900000','Lautch','Mudassir Adili','ca3372219'),(40,7,4,'2019-05-30','090900000','Lautch','Mudassir Adili','ca3372219'),(41,5,10,'2019-05-30','090900000','Lautch','Mudassir Adili','ca3372219'),(42,4,10,'2019-05-30','090900000','Lautch','Mudassir Adili','ca3372219'),(43,6,1,'2019-05-30','111','aaa','Mudassir Adili','786c4fc26'),(44,5,1,'2019-05-30','111','aaa','Mudassir Adili','786c4fc26'),(45,6,2,'2019-05-30','111','aa','Olamide Abdulraheema AA','c8d77e734'),(46,7,1,'2019-05-30','111','aa','Olamide Abdulraheema AA','c8d77e734'),(47,4,4,'2019-05-30','0900','aaa','Mudassir Adili Ahmed','66a2d886e'),(48,7,2,'2019-05-30','0900','aaa','Mudassir Adili Ahmed','66a2d886e'),(49,5,3,'2019-05-30','0900','aaa','Mudassir Adili Ahmed','66a2d886e'),(50,6,3,'2019-06-13','77','ggggg','Olamide Abdulraheema AA','79c0c84e8'),(51,7,4,'2019-06-13','77','ggggg','Olamide Abdulraheema AA','79c0c84e8'),(52,5,1,'2019-06-13','77','ggggg','Olamide Abdulraheema AA','79c0c84e8'),(53,4,2,'2019-06-13','77','ggggg','Olamide Abdulraheema AA','79c0c84e8'),(54,3,10,'2019-06-13','11','aa','aa','e2642771c'),(55,5,10,'2019-06-13','11','aa','aa','e2642771c'),(56,4,10,'2019-06-13','11','aa','aa','e2642771c'),(57,2,10,'2019-06-13','11','aa','aa','e2642771c');
/*!40000 ALTER TABLE `customer_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(255) NOT NULL,
  `phoneNo` varchar(13) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `date_add` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Abdulrasheed Abdulraheem','08060415146','Gidan area Sokoto','2019-05-17','binraheem01@gmail.com'),(2,'Abdullahi Rasheed','09067892113','Gidan Igwai sokoto','2019-05-17','abdul@gmail.com'),(3,'Abdulrasheed Abdulraheem A','08012345678','jos','2019-05-17','hhh@gmai.com'),(4,'Abdullahi Rasheed B','99999','Sokoto','2019-05-17','olamide@gmail.com'),(5,'Abdullahi Rasheed B','99999','Sokoto','2019-05-17','olamide@gmail.com'),(6,'Abdullahi Rasheed B','99999','Sokoto','2019-05-17','olamide@gmail.com'),(7,'Abdullahi Rasheed C','08123456709','Kebbi','2019-05-17','olu@gmail.com');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productName` varchar(100) NOT NULL,
  `productPrice` varchar(100) NOT NULL,
  `date_create` varchar(100) NOT NULL,
  `quantity` int(120) NOT NULL,
  `productCategory` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'RICE','15000','2019-06-13',200,2),(2,'FISH','9000','2019-06-13',810,1),(3,'YAM','200000','2019-06-13',210,5),(4,'MANGO','800','2019-06-13',120,3),(5,'PEPPER','300','2019-06-13',1200,4);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-13 12:03:36
