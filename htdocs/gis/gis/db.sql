/*
SQLyog Ultimate v8.55 
MySQL - 5.5.16 : Database - engineering
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`engineering` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `engineering`;

/*Table structure for table `m_lokasi_pit` */

DROP TABLE IF EXISTS `m_lokasi_pit`;

CREATE TABLE `m_lokasi_pit` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LOKASI_PIT` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `m_lokasi_pit` */

insert  into `m_lokasi_pit`(`ID`,`LOKASI_PIT`) values (1,'PIT Tawahan');

/*Table structure for table `m_parameter` */

DROP TABLE IF EXISTS `m_parameter`;

CREATE TABLE `m_parameter` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PARAMETER` varchar(50) DEFAULT NULL,
  `ID_SATUAN` int(11) DEFAULT NULL,
  `JENIS` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `m_parameter` */

insert  into `m_parameter`(`ID`,`PARAMETER`,`ID_SATUAN`,`JENIS`) values (1,'Jumlah',1,'Pengupasan OB'),(2,'Berat Jenis Material',3,'Pengupasan OB'),(3,'Metode Pemberaian',0,'Pengupasan OB'),(4,'Alat Gali-Muat/ Alat Muat',4,'Pengupasan OB'),(5,'Alat Angkut',4,'Pengupasan OB'),(6,'Jarak Angkut',5,'Pengupasan OB'),(7,'Jumlah OB/Komoditas',1,'Peledakan OB'),(8,'Diamater Hole',7,'Peledakan OB'),(9,'Spasi',5,'Peledakan OB'),(10,'Burden',5,'Peledakan OB'),(11,'Kedalaman Lubang',5,'Peledakan OB'),(12,'Stemming',5,'Peledakan OB'),(13,'Subdrill',5,'Peledakan OB'),(14,'Jumlah Lubang',8,'Peledakan OB'),(15,'Powder Charge',6,'Peledakan OB');

/*Table structure for table `m_satuan` */

DROP TABLE IF EXISTS `m_satuan`;

CREATE TABLE `m_satuan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SATUAN` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `m_satuan` */

insert  into `m_satuan`(`ID`,`SATUAN`) values (1,'BCM'),(2,'Ton'),(3,'Ton/m3'),(4,'Unit'),(5,'Meter'),(6,'Kg/m'),(7,'mm'),(8,'Buah');

/*Table structure for table `m_tahun` */

DROP TABLE IF EXISTS `m_tahun`;

CREATE TABLE `m_tahun` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TAHUN` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `m_tahun` */

insert  into `m_tahun`(`ID`,`TAHUN`) values (1,2019),(2,2020),(3,2021);

/*Table structure for table `vw_parameter` */

DROP TABLE IF EXISTS `vw_parameter`;

/*!50001 DROP VIEW IF EXISTS `vw_parameter` */;
/*!50001 DROP TABLE IF EXISTS `vw_parameter` */;

/*!50001 CREATE TABLE  `vw_parameter`(
 `ID` int(11) ,
 `PARAMETER` varchar(50) ,
 `ID_SATUAN` int(11) ,
 `SATUAN` varchar(20) ,
 `JENIS` varchar(50) 
)*/;

/*View structure for view vw_parameter */

/*!50001 DROP TABLE IF EXISTS `vw_parameter` */;
/*!50001 DROP VIEW IF EXISTS `vw_parameter` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_parameter` AS (select `a0`.`ID` AS `ID`,`a0`.`PARAMETER` AS `PARAMETER`,`a0`.`ID_SATUAN` AS `ID_SATUAN`,`b0`.`SATUAN` AS `SATUAN`,`a0`.`JENIS` AS `JENIS` from (`m_parameter` `a0` left join `m_satuan` `b0` on((`b0`.`ID` = `a0`.`ID_SATUAN`)))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
