/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.22-MariaDB : Database - batak_shop
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`batak_shop` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `batak_shop`;

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kategori` */

insert  into `kategori`(`id`,`nama`) values 
(3,'Ulos'),
(17,'Gantungan kunci'),
(18,'Pakaian'),
(19,'Aksesoris'),
(20,'Alat musik'),
(21,'Kacamata');

/*Table structure for table `pesanan` */

DROP TABLE IF EXISTS `pesanan`;

CREATE TABLE `pesanan` (
  `id_pesanan` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `kode_pos` int(10) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `nama_rek` varchar(30) NOT NULL,
  `no_rek` int(12) NOT NULL,
  `bank` varchar(20) NOT NULL,
  `jenis_produk` varchar(100) NOT NULL,
  `harga_produk` int(20) DEFAULT NULL,
  `jumlah_produk` int(20) NOT NULL,
  `total_harga` int(20) DEFAULT NULL,
  `status` enum('Diproses','Dikirim','Diterima','Belum Dibayar','Sudah Dibayar','Ditolak') DEFAULT 'Belum Dibayar',
  `bukti_bayar` text DEFAULT NULL,
  PRIMARY KEY (`id_pesanan`),
  KEY `id_users` (`id_user`),
  KEY `id_produk` (`id_produk`),
  CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `pesanan` */

insert  into `pesanan`(`id_pesanan`,`id_user`,`id_produk`,`kode_pos`,`kota`,`nama_rek`,`no_rek`,`bank`,`jenis_produk`,`harga_produk`,`jumlah_produk`,`total_harga`,`status`,`bukti_bayar`) values 
(14,60,11,234,'balige','aa',123321,'Mandiri','Kemeja pantai',50000,20,1000000,'Belum Dibayar',NULL),
(15,60,13,123,'weq','qweqe',0,'Bank Sumut','Kaos Lake Toba',20000,11,220000,'Sudah Dibayar','image/bukti_pembayaran/Screenshot (3).png'),
(16,60,16,123,'parmaksian','aa',123123123,'BNI','Tandok',40000,2,80000,'Diproses','image/bukti_pembayaran/WhatsApp Image 2021-07-07 at 09.50.10.jpeg'),
(17,60,13,232,'sad','aa',21313,'BRI','Kaos Lake Toba',20000,4,80000,'Dikirim','image/bukti_pembayaran/Screenshot (3).png'),
(18,65,21,32424,'gsdfgfd','cc',21313131,'Bank Sumut','Sulim',35000,5,175000,'Diproses','image/bukti_pembayaran/Screenshot (3).png'),
(19,60,13,2384,'porsea','naek',890632527,'BRI','Kaos Lake Toba',20000,2,40000,'Belum Dibayar',NULL);

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` double NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `detail` text DEFAULT NULL,
  `stok` enum('habis','tersedia') DEFAULT 'tersedia',
  PRIMARY KEY (`id`),
  KEY `nama` (`nama`),
  KEY `produk_kategori` (`id_kategori`),
  CONSTRAINT `produk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

/*Data for the table `produk` */

insert  into `produk`(`id`,`id_kategori`,`nama`,`harga`,`gambar`,`detail`,`stok`) values 
(11,18,'Kemeja pantai',50000,'ZwcDYDMC2Eai4suWwQaJ.jpeg','','tersedia'),
(12,17,'Gantungan kunci rumah batak',10000,'jzhQp1jWZ5N52GwH5jsY.jpeg','','tersedia'),
(13,18,'Kaos Lake Toba',20000,'nBgPVbEFL3zZ7uMid6Md.jpeg','','tersedia'),
(15,3,'Ulos Sibolang dsds',90000,'wuO1jymeaAKNrZqswh7C.jpg','aaaa','tersedia'),
(16,19,'Tandok',40000,'DeGyWiyp9NOnRVKXviTD.jpeg','','tersedia'),
(17,19,'Sortali',20000,'EszYSs5HlIo2ylV1IxKq.jfif','','tersedia'),
(18,3,'Ulos Ragi Hotang Lama',90000,'Fh3qR6lsC2nZP3i6LszN.jpg','','tersedia'),
(19,18,'Daster Corak Batak',50000,'6sPNP5lqtxHio410Ny1d.jpeg','','tersedia'),
(20,20,'Sarune',60000,'gm2e9qRlwr5FcVhqJYcW.jpeg','','tersedia'),
(21,20,'Sulim',35000,'Q467eWN2vNPjvXGstrKy.jpeg','','tersedia'),
(22,19,'Kalung',15000,'NUbNCGlebLuKJEEiApp9.jfif','','tersedia');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nomor_telepon` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `foto_profil` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`id`,`nama`,`username`,`email`,`password`,`nomor_telepon`,`alamat`,`foto_profil`,`status`) values 
(1,'admin','admin','admin','admin','123456789','admin',NULL,'admin'),
(60,'aa','aa','aa','aa','1241355','aa',NULL,'user'),
(62,'Be Be','bb','bb','bb','0987654321','jalan jalan','image/default_picture.jpg','user'),
(63,'','bb','','bb','','','image/default_picture.jpg','user'),
(64,'','bb','','bb','','','image/default_picture.jpg','user'),
(65,'Ce Ce','cc','cc','cc','1231312','sadadsadas','image/default_picture.jpg','user');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
