-- MySQL dump 10.19  Distrib 10.3.29-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: dbsimdik
-- ------------------------------------------------------
-- Server version	10.3.29-MariaDB-0ubuntu0.20.04.1

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
-- Table structure for table `ref_jnsregistrasi`
--

DROP TABLE IF EXISTS `ref_jnsregistrasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_jnsregistrasi` (
  `idjreg` int(11) NOT NULL AUTO_INCREMENT,
  `jnsregistrasi` varchar(200) NOT NULL,
  PRIMARY KEY (`idjreg`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_jnsregistrasi`
--

LOCK TABLES `ref_jnsregistrasi` WRITE;
/*!40000 ALTER TABLE `ref_jnsregistrasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_jnsregistrasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_pekerjaan`
--

DROP TABLE IF EXISTS `ref_pekerjaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_pekerjaan` (
  `idkerja` int(11) NOT NULL AUTO_INCREMENT,
  `pekerjaan` varchar(255) NOT NULL,
  PRIMARY KEY (`idkerja`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_pekerjaan`
--

LOCK TABLES `ref_pekerjaan` WRITE;
/*!40000 ALTER TABLE `ref_pekerjaan` DISABLE KEYS */;
INSERT INTO `ref_pekerjaan` VALUES (0,'Tidak Bekerja'),(1,'Aparatur Sipil Negara'),(2,'Karyawan Swasta'),(3,'Wiraswasta'),(4,'Pedagang'),(5,'Petani / Pekebun'),(6,'Buruh'),(7,'Mengurus Rumah Tangga'),(8,'Sudah Meninggal');
/*!40000 ALTER TABLE `ref_pekerjaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_pendidikan`
--

DROP TABLE IF EXISTS `ref_pendidikan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_pendidikan` (
  `idpddk` int(11) NOT NULL AUTO_INCREMENT,
  `pendidikan` varchar(250) NOT NULL,
  PRIMARY KEY (`idpddk`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_pendidikan`
--

LOCK TABLES `ref_pendidikan` WRITE;
/*!40000 ALTER TABLE `ref_pendidikan` DISABLE KEYS */;
INSERT INTO `ref_pendidikan` VALUES (1,'Tidak Sekolah'),(2,'SD Sederajat'),(3,'SMP Sederajat'),(4,'SMA Sederajat'),(5,'Diploma I (D-1)'),(6,'Diploma II (D-2)'),(7,'Diploma III (D-3)'),(8,'Sarjana (S-1)'),(9,'Magister (S-2)'),(10,'Doktoral (S-3)');
/*!40000 ALTER TABLE `ref_pendidikan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_penghasilan`
--

DROP TABLE IF EXISTS `ref_penghasilan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_penghasilan` (
  `idhsl` int(11) NOT NULL AUTO_INCREMENT,
  `penghasilan` varchar(255) NOT NULL,
  PRIMARY KEY (`idhsl`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_penghasilan`
--

LOCK TABLES `ref_penghasilan` WRITE;
/*!40000 ALTER TABLE `ref_penghasilan` DISABLE KEYS */;
INSERT INTO `ref_penghasilan` VALUES (0,'Tidak Berpenghasilan'),(1,'Kurang Dari Rp 1.000.000'),(2,'Antara Rp 1.000.000 s/d Rp 3.000.000'),(3,'Antara Rp 3.0000.000 s/d Rp 5.000.000'),(4,'Lebih Dari Rp 5.000.000');
/*!40000 ALTER TABLE `ref_penghasilan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_skulmitra`
--

DROP TABLE IF EXISTS `ref_skulmitra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_skulmitra` (
  `idmitra` int(11) NOT NULL AUTO_INCREMENT,
  `nmmitra` varchar(255) NOT NULL,
  `idjenjang` int(11) NOT NULL,
  `npsn` char(10) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  PRIMARY KEY (`idmitra`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_skulmitra`
--

LOCK TABLES `ref_skulmitra` WRITE;
/*!40000 ALTER TABLE `ref_skulmitra` DISABLE KEYS */;
INSERT INTO `ref_skulmitra` VALUES (1,'SD Negeri 180/II Mulia Bhakti',1,'10500764','Jalan Bakti Husada, Desa Mulia Bhakti, Kecamatan Pelepat, Kabupaten Bungo, Provinsi Jambi'),(2,'SD Negeri 181/II Cilodang',1,'10500765','Jalan Bukit Telago, Desa Cilodang, Kecamatan Pelepat, Kabupaten Bungo, Provinsi Jambi');
/*!40000 ALTER TABLE `ref_skulmitra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_teknik`
--

DROP TABLE IF EXISTS `ref_teknik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_teknik` (
  `idteknik` int(11) NOT NULL,
  `nmteknik` int(11) NOT NULL,
  `aspek` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_teknik`
--

LOCK TABLES `ref_teknik` WRITE;
/*!40000 ALTER TABLE `ref_teknik` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_teknik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbbobot`
--

DROP TABLE IF EXISTS `tbbobot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbbobot` (
  `idbobot` int(11) NOT NULL AUTO_INCREMENT,
  `idrombel` int(11) NOT NULL,
  `idmapel` int(11) NOT NULL,
  `idthpel` int(11) NOT NULL,
  `nph` int(11) NOT NULL,
  `pts` int(11) NOT NULL,
  `npas` int(11) NOT NULL,
  PRIMARY KEY (`idbobot`),
  KEY `idrombel` (`idrombel`,`idmapel`,`idthpel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbbobot`
--

LOCK TABLES `tbbobot` WRITE;
/*!40000 ALTER TABLE `tbbobot` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbbobot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbekskul`
--

DROP TABLE IF EXISTS `tbekskul`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbekskul` (
  `idekskul` int(11) NOT NULL,
  `nmekskul` varchar(50) NOT NULL,
  PRIMARY KEY (`idekskul`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbekskul`
--

LOCK TABLES `tbekskul` WRITE;
/*!40000 ALTER TABLE `tbekskul` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbekskul` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbgtk`
--

DROP TABLE IF EXISTS `tbgtk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbgtk` (
  `idgtk` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(250) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nik` char(20) DEFAULT NULL,
  `kepeg` enum('1','2','3') NOT NULL,
  `jbtdinas` enum('1','2','3','4') NOT NULL,
  `tmplahir` varchar(200) NOT NULL,
  `tgllahir` date NOT NULL,
  `agama` char(1) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `alamat` mediumtext NOT NULL,
  `desa` varchar(50) NOT NULL,
  `kec` varchar(50) NOT NULL,
  `kab` varchar(50) NOT NULL,
  `prov` varchar(50) NOT NULL,
  `kdpos` char(5) NOT NULL,
  `nohp` char(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `idskul` int(11) NOT NULL,
  `username` char(20) DEFAULT NULL,
  PRIMARY KEY (`idgtk`),
  KEY `kdskul` (`idskul`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbgtk`
--

LOCK TABLES `tbgtk` WRITE;
/*!40000 ALTER TABLE `tbgtk` DISABLE KEYS */;
INSERT INTO `tbgtk` VALUES (1,'Muhamad, S.Pt','197407302007011003','150806307740001','1','1','Batanghari','1974-07-30','A','L','Komplek Pasar Kuamang Kuning X','Mulya Bhakti','Pelepat','Bungo','Jambi','37252','083','abimuhamad8@gmail.com','755d25bfa8273291b6e90cf5f15e505c14e20373.jpg',1,'G10040036001'),(2,'Ali Mudhofir, S.Ag.','197708302014071001','1508093008770001','1','1','Banyuwangi','1977-08-30','A','L','Jalan Batanghari','Purwasari','Pelepat Ilir','Bungo','Jambi','37252','0813','alimudhofir8@gmail.com','4e218ea5d45c2b6b4bc44fe3528cbab39dd46d6f.jpg',1,'G10040036002'),(3,'Hot Ranjo Siburian, S.Pd.','196503011984121001','','1','1','Lumban Sialaman','1965-03-01','B','L','Jalan Taman Siswa','Manggis','Bathin III','Bungo','Jambi','37261','','','da39a3ee5e6b4b0d3255bfef95601890afd80709.jpg',1,'G10040036003'),(4,'Rina Effrina, S.Pd.','198205132006042011','','1','1','Sarolangun','1982-05-13','A','P','Jalan Singasari','Lembah Kuamang','Pelepat Ilir','Bungo','Jambi','37252','','','',1,'G10040036004'),(5,'Jubaidah Nurhasanah, S.Pt.','197505042014072001','','1','1','Cipaku','1975-05-04','A','P','Komplek Pasar Kuamang Kuning X','Mulia Bhakti','Pelepat','Bungo','Jambi','37252','','','',1,'G10040036005'),(6,'Umi Munzidah, S.Pd.I','198001012014072001','','1','1','Jombang','1980-01-01','A','P','Jalan Kusuma','Mulia Bhakti','Pelepat','Bungo','Jambi','37252','','','da39a3ee5e6b4b0d3255bfef95601890afd80709.jpg',1,'G10040036006'),(7,'Triyadi Susanto, S.Pd.','198412312014071003','','1','1','Banyuwangi','1984-12-31','A','L','Jalan Singasari','Lembah Kuamang','Pelepat Ilir','Bungo','Jambi','37252','','','',1,'G10040036007'),(8,'Ida Susanti, S.Pd.','198312252019042001','','1','1','Kediri','1983-12-25','A','P','','','','','','','','','',1,'G10040036008'),(9,'Leni Eflin Juniwati, S.Pd.','198704042019042001','','1','1','Muara Madras','1987-04-04','A','P','','','','','','','','','',1,'G10040036009'),(10,'Sriulina Siahaan, S.Pd.I','Non PNS','','1','1','Aek Botik','1986-11-16','A','P','Jalan Damar','Mulya Jaya','Pelepat','Bungo','Jambi','37252','','','',1,'G10040036010'),(11,'Andri Setiawan, S.Pd.','Non PNS','','1','1','Mulia Bhakti','1988-09-01','A','L','Jalan Makarti','Mulia Bhakti','Pelepat','Bungo','Jambi','37252','','','b05d9f85f3caae9cd0a3525be4b145c302679151.jpg',1,'G10040036011'),(12,'Iskandar Dinata, S.Pd.','Non PNS','','1','1','Sungai Duren','1987-01-07','A','L','Jalan Bhakti Husada','Mulia Bhakti','','','','','','','',1,'G10040036012'),(13,'Teguh Pribadi, S.Pd','Non PNS','','1','1','Mulia Bhakti','1988-03-08','A','L','Jalan Ekatama','','','','','','','','',1,'G10040036013'),(14,'Titin Rohayati, S.Pd.','Non PNS','','1','1','Mulia Bhakti','1993-02-23','A','P','','','','','','','','','',1,'G10040036014'),(15,'Marhaley Umanatun Isnaini, S.Pd.','Non PNS','','1','1','Mulia Bhakti','1992-03-01','A','P','','','','','','','','','',1,'G10040036015'),(16,'Aris Qiani Khorina, S.Psi.','Non PNS','','1','1','Mulia Bhakti','1995-04-01','A','P','Jalan Kusuma','Mulia Bhakti','Pelepat','Bungo','Jambi','37252','','','',1,'G10040036016'),(17,'Kasworo Wardani','Non PNS','','1','1','Purwasari','1984-06-02','A','L','Jalan Setia Bhakti RT 05','Mulya Bakti','Pelepat','Bungo','Jambi','37252','08136940047','kasworo.st@gmail.com','4e7afebcfbae000b22c7c85e5560f89a2a0280b4.jpg',1,'G10040036017');
/*!40000 ALTER TABLE `tbgtk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbjenjang`
--

DROP TABLE IF EXISTS `tbjenjang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbjenjang` (
  `idjenjang` int(11) NOT NULL AUTO_INCREMENT,
  `akjenjang` char(3) NOT NULL,
  `nmjenjang` varchar(50) NOT NULL,
  PRIMARY KEY (`idjenjang`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbjenjang`
--

LOCK TABLES `tbjenjang` WRITE;
/*!40000 ALTER TABLE `tbjenjang` DISABLE KEYS */;
INSERT INTO `tbjenjang` VALUES (1,'SD','SD/MI Sederajat'),(2,'SMP','SMP/MTs Sederajat'),(3,'SMA','SMA/MA Sederajat'),(4,'SMK','SMK/MAK Sederajat');
/*!40000 ALTER TABLE `tbjenjang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbkelas`
--

DROP TABLE IF EXISTS `tbkelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbkelas` (
  `idkelas` int(11) NOT NULL AUTO_INCREMENT,
  `nmkelas` varchar(30) NOT NULL,
  `idjenjang` int(11) NOT NULL,
  PRIMARY KEY (`idkelas`),
  KEY `idjenjang` (`idjenjang`),
  CONSTRAINT `tbkelas_ibfk_1` FOREIGN KEY (`idjenjang`) REFERENCES `tbjenjang` (`idjenjang`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbkelas`
--

LOCK TABLES `tbkelas` WRITE;
/*!40000 ALTER TABLE `tbkelas` DISABLE KEYS */;
INSERT INTO `tbkelas` VALUES (1,'Kelas 1',1),(2,'Kelas 2',1),(3,'Kelas 3',1),(4,'Kelas 4',1),(5,'Kelas 5',1),(6,'Kelas 6',1),(7,'Kelas 7',2),(8,'Kelas 8',2),(9,'Kelas 9',2),(10,'Kelas 10',3),(11,'Kelas 11',3),(12,'Kelas 12',3),(13,'Kelas 10',4),(14,'Kelas 11',4),(15,'Kelas 12',4);
/*!40000 ALTER TABLE `tbkelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbkkm`
--

DROP TABLE IF EXISTS `tbkkm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbkkm` (
  `idkkm` int(11) NOT NULL AUTO_INCREMENT,
  `idthpel` int(11) NOT NULL,
  `idkelas` int(11) NOT NULL,
  `idmapel` int(11) NOT NULL,
  `kkm` int(11) NOT NULL,
  PRIMARY KEY (`idkkm`),
  KEY `idthpel` (`idthpel`),
  KEY `idkelas` (`idkelas`),
  KEY `idmapel` (`idmapel`),
  CONSTRAINT `tbkkm_ibfk_1` FOREIGN KEY (`idkelas`) REFERENCES `tbkelas` (`idkelas`),
  CONSTRAINT `tbkkm_ibfk_2` FOREIGN KEY (`idmapel`) REFERENCES `tbmapel` (`idmapel`),
  CONSTRAINT `tbkkm_ibfk_3` FOREIGN KEY (`idthpel`) REFERENCES `tbthpel` (`idthpel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbkkm`
--

LOCK TABLES `tbkkm` WRITE;
/*!40000 ALTER TABLE `tbkkm` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbkkm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbkompetensi`
--

DROP TABLE IF EXISTS `tbkompetensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbkompetensi` (
  `idkd` int(11) NOT NULL AUTO_INCREMENT,
  `kodekd` char(15) NOT NULL,
  `idmapel` int(11) NOT NULL,
  `idkelas` int(11) NOT NULL,
  `aspek` enum('1','2','3','4') NOT NULL,
  `kdlengkap` varchar(250) NOT NULL,
  `kdringkas` varchar(50) NOT NULL,
  `semester` enum('1','2') NOT NULL,
  `aktif` enum('0','1') NOT NULL,
  PRIMARY KEY (`idkd`),
  KEY `idmapel` (`idmapel`),
  KEY `idkelas` (`idkelas`),
  CONSTRAINT `tbkompetensi_ibfk_1` FOREIGN KEY (`idmapel`) REFERENCES `tbmapel` (`idmapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbkompetensi_ibfk_2` FOREIGN KEY (`idkelas`) REFERENCES `tbkelas` (`idkelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbkompetensi`
--

LOCK TABLES `tbkompetensi` WRITE;
/*!40000 ALTER TABLE `tbkompetensi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbkompetensi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbkurikulum`
--

DROP TABLE IF EXISTS `tbkurikulum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbkurikulum` (
  `idkur` int(11) NOT NULL AUTO_INCREMENT,
  `akkur` char(5) NOT NULL,
  `nmkur` varchar(50) NOT NULL,
  `aktif` enum('1','0') NOT NULL,
  PRIMARY KEY (`idkur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbkurikulum`
--

LOCK TABLES `tbkurikulum` WRITE;
/*!40000 ALTER TABLE `tbkurikulum` DISABLE KEYS */;
INSERT INTO `tbkurikulum` VALUES (1,'2006','Kurikulum 2006','0'),(2,'2013','Kurikulum 2013','1');
/*!40000 ALTER TABLE `tbkurikulum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbmapel`
--

DROP TABLE IF EXISTS `tbmapel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbmapel` (
  `idmapel` int(11) NOT NULL AUTO_INCREMENT,
  `idkur` int(11) NOT NULL,
  `akmapel` char(5) NOT NULL,
  `nmmapel` varchar(50) NOT NULL,
  PRIMARY KEY (`idmapel`),
  KEY `idkur` (`idkur`),
  CONSTRAINT `tbmapel_ibfk_1` FOREIGN KEY (`idkur`) REFERENCES `tbkurikulum` (`idkur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbmapel`
--

LOCK TABLES `tbmapel` WRITE;
/*!40000 ALTER TABLE `tbmapel` DISABLE KEYS */;
INSERT INTO `tbmapel` VALUES (1,2,'PABP','Pendidikan Agama dan Budi Pekerti'),(2,2,'PPKn','Pendidikan Pancasila dan Kewarganegaraan'),(3,2,'BIND','Bahasa Indonesia'),(4,2,'MAT','Matematika'),(5,2,'IPA','Ilmu Pengetahuan Alam'),(6,2,'IPS','Ilmu Pengetahuan Sosial'),(7,2,'BING','Bahasa Inggris'),(8,2,'SBD','Seni Budaya'),(9,2,'PJOK','Pendidikan Jasmani Olahraga dan Kesehatan'),(10,2,'PRK','Prakarya');
/*!40000 ALTER TABLE `tbmapel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbmutasidari`
--

DROP TABLE IF EXISTS `tbmutasidari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbmutasidari` (
  `idmutasi` int(11) NOT NULL AUTO_INCREMENT,
  `idsiswa` int(11) NOT NULL,
  `idmitra` int(11) NOT NULL,
  `nosurat` char(50) NOT NULL,
  `tglsurat` date NOT NULL,
  `alasan` varchar(250) NOT NULL,
  PRIMARY KEY (`idmutasi`),
  KEY `idsiswa` (`idsiswa`),
  KEY `idjreg` (`idmitra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbmutasidari`
--

LOCK TABLES `tbmutasidari` WRITE;
/*!40000 ALTER TABLE `tbmutasidari` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbmutasidari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbnilaiharian`
--

DROP TABLE IF EXISTS `tbnilaiharian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbnilaiharian` (
  `idnph` int(11) NOT NULL AUTO_INCREMENT,
  `idthpel` int(11) NOT NULL,
  `idkd` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `nilaiharian` int(11) NOT NULL,
  `idteknik` int(11) NOT NULL,
  `tglinput` datetime NOT NULL,
  PRIMARY KEY (`idnph`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbnilaiharian`
--

LOCK TABLES `tbnilaiharian` WRITE;
/*!40000 ALTER TABLE `tbnilaiharian` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbnilaiharian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbnilaipas`
--

DROP TABLE IF EXISTS `tbnilaipas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbnilaipas` (
  `idnpas` int(11) NOT NULL AUTO_INCREMENT,
  `idthpel` int(11) NOT NULL,
  `idmapel` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `nilaipas` int(11) NOT NULL,
  `tglinput` datetime NOT NULL,
  PRIMARY KEY (`idnpas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbnilaipas`
--

LOCK TABLES `tbnilaipas` WRITE;
/*!40000 ALTER TABLE `tbnilaipas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbnilaipas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbnilaipts`
--

DROP TABLE IF EXISTS `tbnilaipts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbnilaipts` (
  `idnpts` int(11) NOT NULL AUTO_INCREMENT,
  `idthpel` int(11) NOT NULL,
  `idmapel` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `nilaipts` int(11) NOT NULL,
  `tglinput` datetime NOT NULL,
  PRIMARY KEY (`idnpts`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbnilaipts`
--

LOCK TABLES `tbnilaipts` WRITE;
/*!40000 ALTER TABLE `tbnilaipts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbnilaipts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbnilairapor`
--

DROP TABLE IF EXISTS `tbnilairapor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbnilairapor` (
  `idnrapor` int(11) NOT NULL AUTO_INCREMENT,
  `idsiswa` int(11) NOT NULL,
  `idmapel` int(11) NOT NULL,
  `idthpel` int(11) NOT NULL,
  `aspek` enum('1','2','3','4') NOT NULL,
  `nilairapor` int(11) NOT NULL,
  `predikat` char(1) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `tglinput` datetime NOT NULL,
  PRIMARY KEY (`idnrapor`),
  KEY `idsiswa` (`idsiswa`,`idmapel`,`idthpel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbnilairapor`
--

LOCK TABLES `tbnilairapor` WRITE;
/*!40000 ALTER TABLE `tbnilairapor` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbnilairapor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbnilaisikap`
--

DROP TABLE IF EXISTS `tbnilaisikap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbnilaisikap` (
  `idnrapor` int(11) NOT NULL AUTO_INCREMENT,
  `idsiswa` int(11) NOT NULL,
  `idthpel` int(11) NOT NULL,
  `aspek` enum('1','2') NOT NULL,
  `nilaisikap` int(11) NOT NULL,
  `predikat` char(1) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `tglinput` datetime NOT NULL,
  PRIMARY KEY (`idnrapor`),
  KEY `idsiswa` (`idsiswa`,`idthpel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbnilaisikap`
--

LOCK TABLES `tbnilaisikap` WRITE;
/*!40000 ALTER TABLE `tbnilaisikap` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbnilaisikap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbortu`
--

DROP TABLE IF EXISTS `tbortu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbortu` (
  `idortu` int(11) NOT NULL AUTO_INCREMENT,
  `idsiswa` int(11) NOT NULL,
  `nik` char(18) DEFAULT NULL,
  `nmortu` varchar(255) DEFAULT NULL,
  `tmplahir` varchar(255) DEFAULT NULL,
  `tgllahir` date DEFAULT NULL,
  `idagama` char(1) DEFAULT NULL,
  `hidup` enum('0','1') NOT NULL,
  `alamat` mediumtext DEFAULT NULL,
  `desa` mediumtext DEFAULT NULL,
  `kec` mediumtext DEFAULT NULL,
  `kab` mediumtext DEFAULT NULL,
  `prov` mediumtext DEFAULT NULL,
  `nohp` char(15) DEFAULT NULL,
  `kdpos` char(5) DEFAULT NULL,
  `hubkel` enum('1','2','3','4','5','6') NOT NULL,
  `idhsl` int(11) DEFAULT NULL,
  `idkerja` int(11) DEFAULT NULL,
  `idpddk` int(11) DEFAULT NULL,
  PRIMARY KEY (`idortu`),
  KEY `idsiswa` (`idsiswa`),
  KEY `idhsl` (`idhsl`,`idkerja`,`idpddk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbortu`
--

LOCK TABLES `tbortu` WRITE;
/*!40000 ALTER TABLE `tbortu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbortu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbpengampu`
--

DROP TABLE IF EXISTS `tbpengampu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbpengampu` (
  `idampu` int(11) NOT NULL AUTO_INCREMENT,
  `idgtk` int(11) NOT NULL,
  `idmapel` int(11) NOT NULL,
  `idrombel` int(11) NOT NULL,
  `idthpel` int(11) NOT NULL,
  PRIMARY KEY (`idampu`),
  KEY `idmapel` (`idmapel`),
  KEY `username` (`idgtk`),
  KEY `idrombel` (`idrombel`),
  CONSTRAINT `tbpengampu_ibfk_1` FOREIGN KEY (`idmapel`) REFERENCES `tbmapel` (`idmapel`),
  CONSTRAINT `tbpengampu_ibfk_2` FOREIGN KEY (`idrombel`) REFERENCES `tbrombel` (`idrombel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbpengampu`
--

LOCK TABLES `tbpengampu` WRITE;
/*!40000 ALTER TABLE `tbpengampu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbpengampu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbprov`
--

DROP TABLE IF EXISTS `tbprov`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbprov` (
  `idprov` char(2) CHARACTER SET utf8mb4 NOT NULL,
  `nmprov` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  PRIMARY KEY (`idprov`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbprov`
--

LOCK TABLES `tbprov` WRITE;
/*!40000 ALTER TABLE `tbprov` DISABLE KEYS */;
INSERT INTO `tbprov` VALUES ('01','DKI Jakarta'),('02','Jawa Barat'),('03','Jawa Tengah'),('04','DI Yogyakarta'),('05','Jawa Timur'),('06','Nanggroe Aceh Darussalaam'),('07','Sumatera Utara'),('08','Sumatera Barat'),('09','Riau'),('10','Jambi'),('11','Sumatera Selatan'),('12','Lampung'),('13','Kalimantan Barat'),('14','Kalimantan Tengah'),('15','Kalimantan Selatan'),('16','Kalimantan Timur'),('17','Sulawesi Utara'),('18','Sulawesi Tengah'),('19','Sulawesi Selatan'),('20','Sulawesi Tenggara'),('21','Maluku'),('22','Bali'),('23','Nusa Tenggara Barat'),('24','Nusa Tenggara Timur'),('25','Papua'),('26','Bengkulu'),('27','Maluku Utara'),('28','Kepulauan Bangka Belitung'),('29','Gorontalo'),('30','Banten'),('31','Kepulauan Riau'),('32','Sulawesi Barat'),('33','Papua Barat'),('34','Kalimantan Utara');
/*!40000 ALTER TABLE `tbprov` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbrayon`
--

DROP TABLE IF EXISTS `tbrayon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbrayon` (
  `idrayon` char(4) NOT NULL,
  `idprov` char(2) DEFAULT NULL,
  `nmrayon` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idrayon`),
  KEY `idprov` (`idprov`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbrayon`
--

LOCK TABLES `tbrayon` WRITE;
/*!40000 ALTER TABLE `tbrayon` DISABLE KEYS */;
INSERT INTO `tbrayon` VALUES ('0101','01','Kota Jakarta Pusat'),('0102','01','Kota Jakarta Utara'),('0103','01','Kota Jakarta Barat'),('0104','01','Kota Jakarta Selatan'),('0105','01','Kota Jakarta Timur'),('0106','01','Kabupaten Adm. Kepulauan Seribu'),('0201','02','Kota Bandung'),('0202','02','Kota Banjar'),('0203','02','Kota Bekasi'),('0204','02','Kota Bogor'),('0205','02','Kota Cimahi'),('0206','02','Kota Cirebon'),('0207','02','Kota Depok'),('0208','02','Kota Sukabumi'),('0209','02','Kota Tasikmalaya'),('0210','02','Kabupaten Bandung'),('0211','02','Kabupaten Bandung Barat'),('0212','02','Kabupaten Bekasi'),('0213','02','Kabupaten Bogor'),('0214','02','Kabupaten Ciamis'),('0215','02','Kabupaten Cianjur'),('0216','02','Kabupaten Cirebon'),('0217','02','Kabupaten Garut'),('0218','02','Kabupaten Indramayu'),('0219','02','Kabupaten Karawang'),('0220','02','Kabupaten Kuningan'),('0221','02','Kabupaten Majalengka'),('0222','02','Kabupaten Purwakarta'),('0223','02','Kabupaten Subang'),('0224','02','Kabupaten Sukabumi'),('0225','02','Kabupaten Sumedang'),('0226','02','Kabupaten Tasikmalaya'),('0227','02','Kabupaten Pangandaran'),('0301','03','Kota Semarang'),('0302','03','Kota Surakarta'),('0303','03','Kota Tegal'),('0304','03','Kota Pekalongan'),('0305','03','Kota Salatiga'),('0306','03','Kota Magelang'),('0307','03','Kabupaten Banyumas'),('0308','03','Kabupaten Banjarnegara'),('0309','03','Kabupaten Cilacap'),('0310','03','Kabupaten Purbalingga'),('0311','03','Kabupaten Kebumen'),('0312','03','Kabupaten Magelang'),('0313','03','Kabupaten Purworejo'),('0314','03','Kabupaten Temanggung'),('0315','03','Kabupaten Wonosobo'),('0316','03','Kabupaten Boyolali'),('0317','03','Kabupaten Karanganyar'),('0318','03','Kabupaten Klaten'),('0319','03','Kabupaten Sragen'),('0320','03','Kabupaten Sukoharjo'),('0321','03','Kabupaten Wonogiri'),('0322','03','Kabupaten Blora'),('0323','03','Kabupaten Jepara'),('0324','03','Kabupaten Kudus'),('0325','03','Kabupaten Pati'),('0326','03','Kabupaten Rembang'),('0327','03','Kabupaten Demak'),('0328','03','Kabupaten Grobogan'),('0329','03','Kabupaten Kendal'),('0330','03','Kabupaten Semarang'),('0331','03','Kabupaten Batang'),('0332','03','Kabupaten Brebes'),('0333','03','Kabupaten Pekalongan'),('0334','03','Kabupaten Pemalang'),('0335','03','Kabupaten Tegal'),('0401','04','Kota Yogyakarta'),('0402','04','Kabupaten Bantul'),('0403','04','Kabupaten Kulon Progo'),('0404','04','Kabupaten Sleman'),('0405','04','Kabupaten Gunungkidul'),('0501','05','Kota Surabaya'),('0502','05','Kota Malang'),('0503','05','Kota Madiun'),('0504','05','Kota Kediri'),('0505','05','Kota Mojokerto'),('0506','05','Kota Blitar'),('0507','05','Kota Pasuruan'),('0508','05','Kota Probolinggo'),('0509','05','Kota Batu'),('0510','05','Kabupaten Gresik'),('0511','05','Kabupaten Sidoarjo'),('0512','05','Kabupaten Mojokerto'),('0513','05','Kabupaten Jombang'),('0514','05','Kabupaten Bojonegoro'),('0515','05','Kabupaten Tuban'),('0516','05','Kabupaten Lamongan'),('0517','05','Kabupaten Madiun'),('0518','05','Kabupaten Ngawi'),('0519','05','Kabupaten Magetan'),('0520','05','Kabupaten Ponorogo'),('0521','05','Kabupaten Pacitan'),('0522','05','Kabupaten Kediri'),('0523','05','Kabupaten Nganjuk'),('0524','05','Kabupaten Blitar'),('0525','05','Kabupaten Tulungagung'),('0526','05','Kabupaten Trenggalek'),('0527','05','Kabupaten Malang'),('0528','05','Kabupaten Pasuruan'),('0529','05','Kabupaten Probolinggo'),('0530','05','Kabupaten Lumajang'),('0531','05','Kabupaten Bondowoso'),('0532','05','Kabupaten Situbondo'),('0533','05','Kabupaten Jember'),('0534','05','Kabupaten Banyuwangi'),('0535','05','Kabupaten Pamekasan'),('0536','05','Kabupaten Sampang'),('0537','05','Kabupaten Sumenep'),('0538','05','Kabupaten Bangkalan'),('0601','06','Kota Banda Aceh'),('0602','06','Kota Sabang'),('0603','06','Kota Lhokseumawe'),('0604','06','Kota Langsa'),('0605','06','Kota Subulussalam'),('0606','06','Kabupaten Aceh Besar'),('0607','06','Kabupaten Pidie'),('0608','06','Kabupaten Pidie Jaya'),('0609','06','Kabupaten Bireuen'),('0610','06','Kabupaten Aceh Tengah'),('0611','06','Kabupaten Bener Meriah'),('0612','06','Kabupaten Aceh Utara'),('0613','06','Kabupaten Aceh Timur'),('0614','06','Kabupaten Aceh Tamiang'),('0615','06','Kabupaten Aceh Singkil'),('0616','06','Kabupaten Aceh Jaya'),('0617','06','Kabupaten Aceh Barat'),('0618','06','Kabupaten Nagan Raya'),('0619','06','Kabupaten Simeulue'),('0620','06','Kabupaten Aceh Barat Daya'),('0621','06','Kabupaten Aceh Selatan'),('0622','06','Kabupaten Aceh Tenggara'),('0623','06','Kabupaten Gayo Lues'),('0701','07','Kota Medan'),('0702','07','Kota Pematangsiantar'),('0703','07','Kota Binjai'),('0704','07','Kota Tebing Tinggi'),('0705','07','Kota Tanjung Balai'),('0706','07','Kota Sibolga'),('0707','07','Kota Padangsidimpuan'),('0708','07','Kota Gunungsitoli'),('0709','07','Kabupaten Deliserdang'),('0710','07','Kabupaten Langkat'),('0711','07','Kabupaten Simalungun'),('0712','07','Kabupaten Karo'),('0713','07','Kabupaten Dairi'),('0714','07','Kabupaten Asahan'),('0715','07','Kabupaten Labuhanbatu'),('0716','07','Kabupaten Tapanuli Utara'),('0717','07','Kabupaten Tapanuli Tengah'),('0718','07','Kabupaten Tapanuli Selatan'),('0719','07','Kabupaten Nias'),('0720','07','Kabupaten Toba Samosir'),('0721','07','Kabupaten Mandailing Natal'),('0722','07','Kabupaten Humbang Hasundutan'),('0723','07','Kabupaten Pakpak Bharat'),('0724','07','Kabupaten Nias Selatan'),('0725','07','Kabupaten Samosir'),('0726','07','Kabupaten Serdang Bedagai'),('0727','07','Kabupaten Batubara'),('0728','07','Kabupaten Padanglawas Utara'),('0729','07','Kabupaten Padanglawas'),('0730','07','Kabupaten Labuhanbatu Utara'),('0731','07','Kabupaten Labuhanbatu Selatan'),('0732','07','Kabupaten Nias Utara'),('0733','07','Kabupaten Nias Barat'),('0801','08','Kota Padang'),('0802','08','Kota Bukittinggi'),('0803','08','Kota Padang Panjang'),('0804','08','Kota Sawahlunto'),('0805','08','Kota Solok'),('0806','08','Kota Payakumbuh'),('0807','08','Kota Pariaman'),('0808','08','Kabupaten Agam'),('0809','08','Kabupaten Pasaman'),('0810','08','Kabupaten Lima Puluh Kota'),('0811','08','Kabupaten Solok'),('0812','08','Kabupaten Padang Pariaman'),('0813','08','Kabupaten Pesisir Selatan'),('0814','08','Kabupaten Tanah Datar'),('0815','08','Kabupaten Sijunjung'),('0816','08','Kabupaten Kepulauan Mentawai'),('0817','08','Kabupaten Pasaman Barat'),('0818','08','Kabupaten Solok Selatan'),('0819','08','Kabupaten Dharmasraya'),('1001','10','Kota Jambi'),('1002','10','Kota Sungai Penuh'),('1003','10','Kabupaten Batanghari'),('1004','10','Kabupaten Bungo'),('1005','10','Kabupaten Kerinci'),('1006','10','Kabupaten Tanjung Jabung Barat'),('1007','10','Kabupaten Merangin'),('1008','10','Kabupaten Sarolangun'),('1009','10','Kabupaten Tebo'),('1010','10','Kabupaten Muaro Jambi'),('1011','10','Kabupaten Tanjung Jabung Timur'),('1101','11','Kota Palembang'),('1102','11','Kota Lubuklinggau'),('1103','11','Kota Pagaralam'),('1104','11','Kota Prabumulih'),('1105','11','Kabupaten Ogan Komering Ulu'),('1106','11','Kabupaten Ogan Komering Ilir'),('1107','11','Kabupaten Muara Enim'),('1108','11','Kabupatenlahat'),('1109','11','Kabupaten Musi Rawas'),('1110','11','Kabupaten Musi Banyuasin'),('1111','11','Kabupaten Banyuasin'),('1112','11','Kabupaten Ogan Ilir'),('1113','11','Kabupaten Ogan Komering Ulu Timur'),('1114','11','Kabupaten Ogan Komering Ulu Selatan'),('1115','11','Kabupaten Empat Lawang'),('1116','11','Kabupaten Penukal Abab Lematang Ilir'),('1117','11','Kabupaten Musi Rawas Utara'),('1201','12','Kota Bandar Lampung'),('1202','12','Kota Metro'),('1203','12','Kabupaten Lampung Tengah'),('1204','12','Kabupaten Lampung Utara'),('1205','12','Kabupaten Lampung Barat'),('1206','12','Kabupaten Tulang Bawang'),('1207','12','Kabupaten Tanggamus'),('1208','12','Kabupaten Lampung Timur'),('1209','12','Kabupaten Lampung Selatan'),('1210','12','Kabupaten Way Kanan'),('1211','12','Kabupaten Pesawaran'),('1212','12','Kabupaten Pringsewu'),('1213','12','Kabupaten Tulang Bawang Barat'),('1214','12','Kabupaten Mesuji'),('1215','12','Kabupaten Pesisir Barat'),('1301','13','Kota Pontianak'),('1302','13','Kota Singkawang'),('1303','13','Kabupaten Mempawah'),('1304','13','Kabupaten Sambas'),('1305','13','Kabupaten Sanggau'),('1306','13','Kabupaten Sintang'),('1307','13','Kabupaten Kapuas Hulu'),('1308','13','Kabupaten Ketapang'),('1309','13','Kabupaten Bengkayang'),('1310','13','Kabupaten Landak'),('1311','13','Kabupaten Sekadau'),('1312','13','Kabupaten Melawi'),('1313','13','Kabupaten Kayong Utara'),('1314','13','Kabupaten Kubu Raya'),('1401','14','Kota Palangka Raya'),('1402','14','Kabupaten Kotawaringin Barat'),('1403','14','Kabupaten Kotawaringin Timur'),('1404','14','Kabupaten Kapuas'),('1405','14','Kabupaten Barito Selatan'),('1406','14','Kabupaten Barito Utara'),('1407','14','Kabupaten Sukamara'),('1408','14','Kabupaten Lamandau'),('1409','14','Kabupaten Seruyan'),('1410','14','Kabupaten Katingan'),('1411','14','Kabupaten Gunung Mas'),('1412','14','Kabupaten Pulang Pisau'),('1413','14','Kabupaten Barito Timur'),('1414','14','Kabupaten Murung Raya'),('1501','15','Kota Banjarmasin'),('1502','15','Kota Banjarbaru'),('1503','15','Kabupaten Kotabaru'),('1504','15','Kabupaten Banjar'),('1505','15','Kabupaten Barito Kuala'),('1506','15','Kabupaten Tapin'),('1507','15','Kabupaten Hulu Sungai Selatan'),('1508','15','Kabupaten Hulu Sungai Tengah'),('1509','15','Kabupaten Hulu Sungai Utara'),('1510','15','Kabupaten Tabalong'),('1511','15','Kabupaten Tanah Laut'),('1512','15','Kabupaten Balangan'),('1513','15','Kabupaten Tanah Bumbu'),('1601','16','Kota Samarinda'),('1602','16','Kota Balikpapan'),('1603','16','Kota Bontang'),('1604','16','Kabupaten Kutai Kartanegara'),('1605','16','Kabupaten Kutai Timur'),('1606','16','Kabupaten Kutai Barat'),('1607','16','Kabupaten Paser'),('1608','16','Kabupaten Penajam Paser Utara'),('1609','16','Kabupaten Berau'),('1610','16','Kabupaten Mahakam Ulu'),('1701','17','Kota Manado'),('1702','17','Kota Bitung'),('1703','17','Kota Tomohon'),('1704','17','Kota Kotamobagu'),('1705','17','Kabupaten Kepulauan Talaud'),('1706','17','Kabupaten Kepulauan Sangihe'),('1707','17','Kabupaten Minahasa'),('1708','17','Kabupaten Bolaang Mongondow'),('1709','17','Kabupaten Minahasa Selatan'),('1710','17','Kabupaten Minahasa Utara'),('1711','17','Kabupaten Kep. Sitaro'),('1712','17','Kabupaten Minahasa Tenggara'),('1713','17','Kabupaten Bolaang Mongondow Utara'),('1714','17','Kabupaten Bolaang Mongondow Timur'),('1715','17','Kabupaten Bolaang Mongondow Selatan'),('1801','18','Kota Palu'),('1802','18','Kabupaten Donggala'),('1803','18','Kabupaten Poso'),('1804','18','Kabupaten Morowali'),('1805','18','Kabupaten Banggai'),('1806','18','Kabupaten Banggai Kepulauan'),('1807','18','Kabupaten Toli-Toli'),('1808','18','Kabupaten Buol'),('1809','18','Kabupaten Parigi Moutong'),('1810','18','Kabupaten Tojo Una-Una'),('1811','18','Kabupaten Sigi'),('1812','18','Kabupaten Banggai Laut'),('1813','18','Kabupaten Morowali Utara'),('1901','19','Kota Makassar'),('1902','19','Kota Palopo'),('1903','19','Kota Parepare'),('1904','19','Kabupaten Maros'),('1905','19','Kabupaten Pangkajene Kepulauan'),('1906','19','Kabupaten Gowa'),('1907','19','Kabupaten Takalar'),('1908','19','Kabupaten Jeneponto'),('1909','19','Kabupaten Barru'),('1910','19','Kabupaten Bone'),('1911','19','Kabupaten Wajo'),('1912','19','Kabupaten Soppeng'),('1913','19','Kabupaten Bantaeng'),('1914','19','Kabupaten Bulukumba'),('1915','19','Kabupaten Sinjai'),('1916','19','Kabupaten Kepulauan Selayar'),('1917','19','Kabupaten Pinrang'),('1918','19','Kabupaten Sidenreng Rappang'),('1919','19','Kabupaten Enrekang'),('1920','19','Kabupaten Luwu'),('1921','19','Kabupaten Luwu Utara'),('1922','19','Kabupaten Tana Toraja'),('1923','19','Kabupaten Luwu Timur'),('1924','19','Kabupaten Toraja Utara'),('2001','20','Kota Kendari'),('2002','20','Kota Baubau'),('2003','20','Kabupaten Konawe'),('2004','20','Kabupaten Muna'),('2005','20','Kabupaten Buton'),('2006','20','Kabupaten Kolaka'),('2007','20','Kabupaten Konawe Selatan'),('2008','20','Kabupaten Wakatobi'),('2009','20','Kabupaten Bombana'),('2010','20','Kabupaten Kolaka Utara'),('2011','20','Kabupaten Konawe Utara'),('2012','20','Kabupaten Buton Utara'),('2013','20','Kabupaten Kolaka Timur'),('2014','20','Kabupaten Konawe Kepulauan'),('2015','20','Kabupaten Buton Tengah'),('2016','20','Kabupaten Buton Selatan'),('2017','20','Kabupaten Muna Barat'),('2101','21','Kota Ambon'),('2102','21','Kota Tual'),('2103','21','Kabupaten Maluku Tengah'),('2104','21','Kabupaten Buru'),('2105','21','Kabupaten Maluku Tenggara'),('2106','21','Kabupaten Maluku Tenggara Barat'),('2107','21','Kabupaten Seram Bagian Timur'),('2108','21','Kabupaten Seram Bagian Barat'),('2109','21','Kabupatenkepulauan Aru'),('2110','21','Kabupaten Buru Selatan'),('2111','21','Kabupaten Maluku Barat Daya'),('2201','22','Kota Denpasar'),('2202','22','Kabupaten Gianyar'),('2203','22','Kabupaten Bangli'),('2204','22','Kabupaten Klungkung'),('2205','22','Kabupaten Karangasem'),('2206','22','Kabupaten Buleleng'),('2207','22','Kabupaten Jembrana'),('2208','22','Kabupaten Tabanan'),('2209','22','Kabupaten Badung'),('2301','23','Kota Mataram'),('2302','23','Kota Bima'),('2303','23','Kabupaten Lombok Barat'),('2304','23','Kabupaten Lombok Utara'),('2305','23','Kabupaten Lombok Tengah'),('2306','23','Kabupaten Lombok Timur'),('2307','23','Kabupaten Sumbawa Barat'),('2308','23','Kabupaten Sumbawa'),('2309','23','Kabupaten Dompu'),('2310','23','Kabupaten Bima'),('2401','24','Kota Kupang'),('2402','24','Kabupaten Kupang'),('2403','24','Kabupaten Timor Tengah Selatan'),('2404','24','Kabupaten Timor Tengah Utara'),('2405','24','Kabupaten Belu'),('2406','24','Kabupaten Alor'),('2407','24','Kabupaten Flores Timur'),('2408','24','Kabupaten Sikka'),('2409','24','Kabupaten Ende'),('2410','24','Kabupaten Ngada'),('2411','24','Kabupaten Manggarai'),('2412','24','Kabupaten Sumba Timur'),('2413','24','Kabupaten Sumba Barat'),('2414','24','Kabupaten Lembata'),('2415','24','Kabupaten Rote Ndao'),('2416','24','Kabupaten Manggarai Barat'),('2417','24','Kabupaten Nagekeo'),('2418','24','Kabupaten Sumba Tengah'),('2419','24','Kabupaten Sumba Barat Daya'),('2420','24','Kabupaten Manggarai Timur'),('2421','24','Kabupaten Sabu Raijua'),('2422','24','Kabupaten Malaka'),('2501','25','Kota Jayapura'),('2502','25','Kabupaten Jayapura'),('2503','25','Kabupaten Biak Numfor'),('2504','25','Kabupaten Kepulauan Yapen'),('2505','25','Kabupaten Merauke'),('2506','25','Kabupaten Jayawijaya'),('2507','25','Kabupaten Nabire'),('2508','25','Kabupaten Paniai'),('2509','25','Kabupaten Puncak Jaya'),('2510','25','Kabupaten Mimika'),('2511','25','Kabupaten Keerom'),('2512','25','Kabupaten Sarmi'),('2513','25','Kabupaten Supiori'),('2514','25','Kabupaten Waropen'),('2515','25','Kabupaten Boven Digoel'),('2516','25','Kabupaten Asmat'),('2517','25','Kabupaten Mappi'),('2518','25','Kabupaten Yahukimo'),('2519','25','Kabupaten Pegunungan Bintang'),('2520','25','Kabupaten Tolikara'),('2521','25','Kabupaten Mamberamo Raya'),('2522','25','Kabupaten Mamberamo Tengah'),('2523','25','Kabupaten Nduga'),('2524','25','Kabupaten Lanny Jaya'),('2525','25','Kabupaten Puncak'),('2526','25','Kabupaten Dogiyai'),('2527','25','Kabupaten Yalimo'),('2528','25','Kabupaten Intan Jaya'),('2529','25','Kabupaten Deiyai'),('2601','26','Kota Bengkulu'),('2602','26','Kabupaten Bengkulu Utara'),('2603','26','Kabupaten Rejang Lebong'),('2604','26','Kabupaten Bengkulu Selatan'),('2605','26','Kabupaten Seluma'),('2606','26','Kabupaten Kaur'),('2607','26','Kabupaten Mukomuko'),('2608','26','Kabupaten Lebong'),('2609','26','Kabupaten Kepahiang'),('2610','26','Kabupaten Bengkulu Tengah'),('2701','27','Kota Ternate'),('2702','27','Kota Tidore Kepulauan'),('2703','27','Kabupaten Halmahera Barat'),('2704','27','Kabupaten Halmahera Utara'),('2705','27','Kabupaten Halmahera Selatan'),('2706','27','Kabupaten Halmahera Tengah'),('2707','27','Kabupaten Halmahera Timur'),('2708','27','Kabupaten Kepulauan Sula'),('2709','27','Kabupaten Pulau Morotai'),('2710','27','Kabupaten Pulau Taliabu'),('2801','28','Kota Pangkalpinang'),('2802','28','Kabupaten Bangka'),('2803','28','Kabupaten Bangka Barat'),('2804','28','Kabupaten Bangka Tengah'),('2805','28','Kabupaten Bangka Selatan'),('2806','28','Kabupaten Belitung'),('2807','28','Kabupaten Belitung Timur'),('2901','29','Kota Gorontalo'),('2902','29','Kabupaten Gorontalo'),('2903','29','Kabupaten Boalemo'),('2904','29','Kabupaten Pohuwato'),('2905','29','Kabupaten Bone Bolango'),('2906','29','Kabupaten Gorontalo Utara'),('3001','30','Kota Serang'),('3002','30','Kota Tangerang'),('3003','30','Kota Cilegon'),('3004','30','Kota Tangerang Selatan'),('3005','30','Kabupaten Serang'),('3006','30','Kabupaten Pandeglang'),('3007','30','Kabupaten Lebak'),('3008','30','Kabupaten Tangerang'),('3101','31','Kota Tanjungpinang'),('3102','31','Kota Batam'),('3103','31','Kabupaten Bintan'),('3104','31','Kabupaten Karimun'),('3105','31','Kabupaten Natuna'),('3106','31','Kabupaten Lingga'),('3107','31','Kabupaten Kepulauan Anambas'),('3201','32','Kabupaten Mamuju'),('3202','32','Kabupaten Majene'),('3203','32','Kabupaten Polewali Mandar'),('3204','32','Kabupaten Mamasa'),('3205','32','Kabupaten Pasangkayu'),('3206','32','Kabupaten Mamuju Tengah'),('3301','33','Kabupaten Manokwari'),('3302','33','Kota Sorong'),('3303','33','Kabupaten Sorong'),('3304','33','Kabupaten Fakfak'),('3305','33','Kabupaten Teluk Wondama'),('3306','33','Kabupaten Teluk Bintuni'),('3307','33','Kabupaten Raja Ampat'),('3308','33','Kabupaten Sorong Selatan'),('3309','33','Kabupaten Kaimana'),('3310','33','Kabupaten Tambrauw'),('3311','33','Kabupaten Maybrat'),('3312','33','Kabupaten Manokwari Selatan'),('3313','33','Kabupaten Pegunungan Arfak'),('3401','34','Kabupaten Bulungan'),('3402','34','Kota Tarakan'),('3403','34','Kabupaten Nunukan'),('3404','34','Kabupaten Malinau'),('3405','34','Kabupaten Tana Tidung');
/*!40000 ALTER TABLE `tbrayon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbregistrasi`
--

DROP TABLE IF EXISTS `tbregistrasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbregistrasi` (
  `idset` int(11) NOT NULL AUTO_INCREMENT,
  `idsiswa` int(11) NOT NULL,
  `idjreg` int(11) NOT NULL,
  `idrombel` int(11) NOT NULL,
  `tglreg` date NOT NULL,
  PRIMARY KEY (`idset`),
  KEY `idsiswa` (`idsiswa`,`idjreg`),
  KEY `idrombel` (`idrombel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbregistrasi`
--

LOCK TABLES `tbregistrasi` WRITE;
/*!40000 ALTER TABLE `tbregistrasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbregistrasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbriwayatskul`
--

DROP TABLE IF EXISTS `tbriwayatskul`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbriwayatskul` (
  `idrwy` int(11) NOT NULL AUTO_INCREMENT,
  `idjreg` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `aslsd` varchar(250) NOT NULL,
  `noijazah` char(20) NOT NULL,
  `tglijazah` date NOT NULL,
  `lama` int(11) NOT NULL,
  `aslsmp` varchar(250) DEFAULT NULL,
  `nosurat` varchar(100) DEFAULT NULL,
  `tglsurat` date DEFAULT NULL,
  `alasan` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idrwy`),
  KEY `idsiswa` (`idsiswa`),
  CONSTRAINT `tbriwayatskul_ibfk_2` FOREIGN KEY (`idsiswa`) REFERENCES `tbsiswa` (`idsiswa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbriwayatskul`
--

LOCK TABLES `tbriwayatskul` WRITE;
/*!40000 ALTER TABLE `tbriwayatskul` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbriwayatskul` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbrombel`
--

DROP TABLE IF EXISTS `tbrombel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbrombel` (
  `idrombel` int(11) NOT NULL AUTO_INCREMENT,
  `idkelas` int(11) DEFAULT NULL,
  `nmrombel` varchar(50) NOT NULL,
  `idthpel` int(11) NOT NULL,
  `idkur` int(11) NOT NULL,
  `idgtk` int(11) NOT NULL,
  PRIMARY KEY (`idrombel`),
  KEY `idkelas` (`idkelas`),
  KEY `idthpel` (`idthpel`),
  KEY `idkur` (`idkur`),
  KEY `username` (`idgtk`),
  CONSTRAINT `tbrombel_ibfk_1` FOREIGN KEY (`idkelas`) REFERENCES `tbkelas` (`idkelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbrombel_ibfk_2` FOREIGN KEY (`idkur`) REFERENCES `tbkurikulum` (`idkur`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbrombel_ibfk_3` FOREIGN KEY (`idthpel`) REFERENCES `tbthpel` (`idthpel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbrombel`
--

LOCK TABLES `tbrombel` WRITE;
/*!40000 ALTER TABLE `tbrombel` DISABLE KEYS */;
INSERT INTO `tbrombel` VALUES (1,7,'7A',1,2,4),(2,7,'7B',1,2,11),(3,7,'7A',2,2,4),(4,7,'7B',2,2,11),(5,7,'7A',3,2,4),(6,7,'7B',3,2,11),(7,8,'8A',3,2,5),(8,8,'8B',3,2,10),(9,7,'7A',4,2,4),(10,7,'7B',4,2,11),(11,8,'8A',4,2,5),(12,8,'8B',4,2,10),(13,7,'7A',5,2,6),(14,7,'7B',5,2,8),(15,8,'8A',5,2,4),(16,8,'8B',5,2,11),(17,9,'9A',5,2,9),(18,9,'9B',5,2,5),(19,7,'7A',6,2,6),(20,7,'7B',6,2,8),(21,8,'8A',6,2,4),(22,8,'8B',6,2,11),(23,9,'9A',6,2,9),(24,9,'9B',6,2,5);
/*!40000 ALTER TABLE `tbrombel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbsiswa`
--

DROP TABLE IF EXISTS `tbsiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbsiswa` (
  `idsiswa` int(11) NOT NULL AUTO_INCREMENT,
  `nik` char(18) DEFAULT NULL,
  `nis` varchar(10) DEFAULT NULL,
  `nisn` varchar(10) DEFAULT NULL,
  `nmsiswa` varchar(255) DEFAULT NULL,
  `tmplahir` varchar(255) DEFAULT NULL,
  `tgllahir` date DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `idagama` char(1) DEFAULT NULL,
  `warganegara` enum('1','2') DEFAULT NULL,
  `anake` char(10) DEFAULT NULL,
  `sdr` char(11) NOT NULL,
  `goldarah` enum('0','1','2','3','4') DEFAULT NULL,
  `kebkhusus` enum('0','1','2','3','4','5','6','7') DEFAULT NULL,
  `rwysakit` enum('0','1','2','3','4','5','6','7','8') DEFAULT NULL,
  `ikuts` enum('1','2','3','4') NOT NULL,
  `jarak` int(11) DEFAULT NULL,
  `waktu` int(11) DEFAULT NULL,
  `transpr` enum('1','2','3','4','5','6') DEFAULT NULL,
  `alamat` mediumtext DEFAULT NULL,
  `desa` mediumtext DEFAULT NULL,
  `kec` mediumtext DEFAULT NULL,
  `kab` mediumtext DEFAULT NULL,
  `prov` mediumtext DEFAULT NULL,
  `nohp` char(15) DEFAULT NULL,
  `kdpos` char(5) DEFAULT NULL,
  `lintang` char(11) DEFAULT NULL,
  `bujur` char(11) DEFAULT NULL,
  `hobi1` varchar(200) DEFAULT NULL,
  `hobi2` varchar(200) DEFAULT NULL,
  `hobi3` varchar(200) DEFAULT NULL,
  `hobi4` varchar(200) DEFAULT NULL,
  `fotosiswa` varchar(255) DEFAULT NULL,
  `idskul` int(11) DEFAULT NULL,
  `deleted` enum('1','0') DEFAULT NULL,
  `username` char(20) DEFAULT NULL,
  PRIMARY KEY (`idsiswa`),
  KEY `idskul` (`idskul`),
  KEY `username` (`username`),
  CONSTRAINT `tbsiswa_ibfk_1` FOREIGN KEY (`idskul`) REFERENCES `tbskul` (`idskul`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbsiswa`
--

LOCK TABLES `tbsiswa` WRITE;
/*!40000 ALTER TABLE `tbsiswa` DISABLE KEYS */;
INSERT INTO `tbsiswa` VALUES (45,'1404050306070001','1008','0074452373','Adril Tegar Raimonda','Cilodang','2007-06-03','L','A','1','1','1','0','0','0','1',0,0,'1','Jalan Bukit Kemuning','Cilodang','Pelepat','Bungo','Jambi','083180973024','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(46,'1508061301050001','1009','0051011570','AZIZ MAULANA','CILODANG','2005-01-13','L','A','1','1','1','0','0','0','1',0,0,'1','Jalan Bukit Tinggi','Cilodang','Pelepat','Bungo','Jambi','082177508619','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(47,'1508062312060002','1010','0069872684','Aji Meldisa Setya Hadi','Mulia Bhakti','2006-12-23','L','A','1','1','1','0','0','0','1',0,0,'1','Jl. Ajipurna','Mulia Bhakti','Pelepat','Bungo','Jambi','085709946881','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(48,'1508060308050002','1011','0054062399','BAGAS MEGA DULIMA','CILODANG','2005-08-03','L','A','1','2','2','0','0','0','1',0,0,'1','Jalan Bukit Kemuning','Cilodang','Pelepat','Bungo','Jambi','081287176113','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(49,'1508061309070001','1012','0076533353','Ardiyan Welly Ramadhan Sitompul','Muara Bungo','2007-09-13','L','A','1','2','2','0','0','0','1',0,0,'1','Komp. Pasar X','Mulia Bhakti','Pelepat','Bungo','Jambi','085229729126','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(50,'1508065203070003','1013','0073489997','Bilqish Ashley Milanisti','Muara Bungo','2007-03-12','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Kencana','Mulia Bhakti','Pelepat','Bungo','Jambi','085783529104','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(51,'1508062501070001','1014','0074226049','Bimo Ambar Kurniawan','Muara Bungo','2007-01-25','L','A','1','1','1','0','0','0','1',0,0,'1','Jl Bukit Apit','Cilodang','Pelepat','Bungo','Jambi','082363878219','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(52,'1608061308060002','1015','0061404239','Cholid lesmana putra','Mulia Bhakti','2006-08-13','L','A','1','3','3','0','0','0','1',0,0,'1','Kusuma','Mulia Bhakti','Pelepat','Bungo','Jambi','085783525961','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(53,'1508064912060002','1016','0069925353','Chika Destia Winne','Mulia Bhakti','2006-12-09','P','A','1','2','2','0','0','0','1',0,0,'1','Dasa Purwa','Mulia Bhakti','Pelepat','Bungo','Jambi','082372642720','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(54,'1508066606070001','1017','0074173996','Cicilia Ayu Salsya','Muara Bungo','2007-06-26','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Dasa Purwa','Mulia Bhakti','Pelepat','Bungo','Jambi','081377520575','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(55,'2102020810060001','1018','0062878427','Dava Sadewo Pama Berliyanto Simanjuntak','Kundur Karimun','2006-10-08','L','A','1','5','5','0','0','0','1',0,0,'1','Jl. Bhakti Husada','Mulia Bhakti','Pelepat','Bungo','Jambi','082249919608','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(56,'1508062404060002','1019','0065708423','Dani Afriyadi','Muara Bungo','2006-04-24','L','A','1','2','2','0','0','0','1',0,0,'1','Jalan Bukit Kemuning','Cilodang','Pelepat','Bungo','Jambi','082280459191','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(57,'1508065201070001','1020','0068830422','Desi Adinda Sari','Muara Bungo','2006-12-11','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan','Mulia Bhakti','Pelepat','Bungo','Jambi','085709663476','37252','-1.6977','102.3128','','','','',NULL,1,'0',NULL),(58,'1508066311060002','1021','0062830375','Dewi Nurhidayanti','Mulia Bhakti','2006-11-23','P','A','1','2','2','0','0','0','1',0,0,'1','Jl. Ekatama','Mulia  Bhakti','Pelepat','Bungo','Jambi','085709582258','37252','-1.6977','102.3128','','','','',NULL,1,'0',NULL),(59,'1508064101060003','1022','0063987808','Dhea Salsabilla Putri','Muara Bungo','2006-01-01','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Bukit Luncuk','Cilodang','Pelepat','Bungo','Jambi','082246540626','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(60,'1508066307070001','1023','0076396595','Diah Ayu Ernita','Muara Bungo','2007-07-23','P','A','1','2','2','0','0','0','1',0,0,'1','Kusuma','Mulia Bhakti','Pelepat','Bungo','Jambi','085783524176','37252','-1.6977','102.3128','','','','',NULL,1,'0',NULL),(61,'1508062604070002','1024','0075932930','Diaz Rangga Saputra','Mulia Bhakti','2007-04-26','L','A','1','3','3','0','0','0','1',0,0,'1','Jl. Kusuma','Mulia Bhakti','Pelepat','Bungo','Jambi','085664636040','37252','-1.6977','102.3128','','','','',NULL,1,'0',NULL),(62,'1508062110050003','1025','0051488117','Dian Tri Mulyana','Cilodang','2005-10-21','L','A','1','3','3','0','0','0','1',0,0,'1','Jalan Bukit Asam','Cilodang','Pelepat','Bungo','Jambi','085381047198','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(63,'1508065909060001','1026','0067395065','Dinda Yolanda Putri','Kuamang Kuning','2006-09-19','P','A','1','1','1','0','0','0','1',0,0,'1','Jalan Bulian','Mulya Jaya','Pelepat','Bungo','Jambi','082289298573','37252','-1.7099','102.1737','','','','',NULL,1,'0',NULL),(64,'1508065312060001','1027','0066759039','Diana Putri Siska','Mulia Bhakti','2006-12-13','P','A','1','4','4','0','0','0','1',0,0,'1','Jalan Ajipurna','Mulia Bhakti','Pelepat','Bungo','Jambi','083121628956','37252','-1.6977','102.3128','','','','',NULL,1,'0',NULL),(65,'1508060601070002','1028','0079061759','Eris Nurwanda','Cilodang','2007-01-06','L','A','1','1','1','0','0','0','1',0,0,'1','Jalan Bukit Kemuning','Cilodang','Pelepat','Bungo','Jambi','082278964408','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(66,'1508061606070002','1029','0079905882','Firdayanto','Maryke','2007-06-16','L','A','1','2','2','0','0','0','1',0,0,'1','Jl. Setia Bhakti','Mulia Bhakti','Pelepat','Bungo','Jambi','083172407273','37252','-1.6977','102.3128','','','','',NULL,1,'0',NULL),(67,'1508066409050002','1030','0055038182','HOLIL HALIMIN','CILODANG','2005-08-18','L','A','1','1','1','0','0','0','1',0,0,'1','Jalan Bukit Telago','Cilodang','Pelepat','Bungo','Jambi','082346362231','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(68,'1508061001070001','1031','0077766857','HILMAN KHOERUDIN','MA. BUNGO','2007-01-10','L','A','1','3','3','0','0','0','1',0,0,'1','Jalan Bukit Kemuning','Cilodang','Pelepat','Bungo','Jambi','082183100674','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(69,'1508061211040003','1032','0055881869','JEJEN','CILODANG','2005-01-18','L','A','1','2','2','0','0','0','1',0,0,'1','Jalan Bukit Telago','Cilodang','Pelepat','Bungo','Jambi','087819799365','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(70,'1508061209060001','1033','0068630121','IKHSAN MAULANA','CILODANG','2006-09-12','L','A','1','2','2','0','0','0','1',0,0,'1','Jalan Bukit Siguntang','Cilodang','Pelepat','Bungo','Jambi','081271318369','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(71,'1508064504070003','1034','0079235786','Karina April Liony','Muara Bungo','2007-04-05','P','A','1','1','1','0','0','0','1',0,0,'1','Kencana','Mulia Bhakti','Pelepat','Bungo','Jambi','083802832385','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(72,'1508060804060003','1035','0065200425','Jujun Nur Hidayat','Cilodang','2006-04-08','L','A','1','3','3','0','0','0','1',0,0,'1','Jalan Bukit Luncuk','CILODANG','Pelepat','Bungo','Jambi','085273289394','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(73,'1508062005070002','1036','0078253682','Lutfi Daniansah Azizi','Muara Bungo','2007-05-20','L','A','1','2','2','0','0','0','1',0,0,'1','Jl. Kencana','Mulia Bhakti','Pelepat','Bungo','Jambi','085783529037','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(74,'1508061002070002','1037','0071018494','Michael Edward H.S','Kuamang Kuning','2007-02-10','L','B','1','2','2','0','0','0','1',0,0,'1','Dasa Purwa','Mulia Bhakti','Pelepat','Bungo','Jambi','085609792885','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(75,'1508060606070002','1038','0078058410','Muhammad Fajri','Muara Bungo','2007-06-11','L','A','1','2','2','0','0','0','1',0,0,'1','Jl. kusuma','Mulia Bhakti','Pelepat','Bungo','Jambi','085768904904','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(76,'1508062205070003','1039','0077682808','Mudzacky Rakha Kusuma','Muara Bungo','2007-05-22','L','A','1','1','1','0','0','0','1',0,0,'1','Jalan Kusuma','Mulya Bakti','Pelepat','Bungo','Jambi','081218218501','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(77,'1508062707070003','1040','0073088481','Naufal Alib Rafadzaky','Mulia Bhakti','2007-07-27','L','A','1','2','2','0','0','0','1',0,0,'1','Jalan Bhakti Husada','Mulia Bhakti','Pelepat','Bungo','Jambi','085609936502','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(78,'1508063107060002','1041','0061936507','RAMDANI AKBAR','CILODANG','2006-07-31','L','A','1','2','2','0','0','0','1',0,0,'1','Jalan Bukit Tinggi','Cilodang','Pelepat','Bungo','Jambi','082345082764','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(79,'1508066708060001','1042','0069791009','NIA NATASYA','Cilodang','2006-08-27','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Bukit Kemuning','Cilodang','Pelepat','Bungo','Jambi','082278938732','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(80,'1508062409060003','1043','0061186666','Revaldo Firmansyah','Mulia Bhakti','2006-09-22','L','A','1','3','3','0','0','0','1',0,0,'1','Komp. Pasar X','Mulia Bhakti','Pelepat','Bungo','Jambi','082281188176','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(81,'1508066209060001','1044','0065542333','REVITA WULANDARI','CILODANG','2006-09-22','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Bukit Kemuning','Cilodang','Pelepat','Bungo','Jambi','082298994728','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(82,'1508064608060001','1045','0069386183','Reza Marliska Khuril Miftahul Janah','Muara Bungo','2006-08-06','P','A','1','6','6','0','0','0','1',0,0,'1','Jalan Aji Purna','Mulia Bhakti','Pelepat','Bungo','Jambi','081366706150','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(83,'1105023012080002','1046','0061306646','Ria Puji Lestari','Mulia Bhakti','2006-05-02','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Ekatama','Mulia  Bhakti','Pelepat','Bungo','Jambi','085840907252','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(84,'1508062406060003','1048','0051813572','Ridho Wahyu. M','Mulia Bhakti','2005-07-29','L','A','1','2','2','0','0','0','1',0,0,'1','Jalan Kusuma','Mulia Bhakti','Pelepat','Bungo','Jambi','085217001643','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(85,'1508062511060001','1049','0063686263','Rifadhli Nur Wahid','Cilodang','2006-11-25','L','A','1','1','1','0','0','0','1',0,0,'1','Jalan Bukit Kemuning','Cilodang','Pelepat','Bungo','Jambi','082246521719','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(86,'1508065903060003','1050','0069354530','Risma Nurlatifah','Cilodang','2006-03-19','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Bukit Luncuk','Cilodang','Pelepat','Bungo','Jambi','085281850828','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(87,'1508060811060001','1051','0066816889','RISKY BIMA SAPUTRA','CILODANG','2006-11-08','L','A','1','1','1','0','0','0','1',0,0,'1','Jalan Bukit Luncuk','Cilodang','Pelepat','Bungo','Jambi','085274777437','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(88,'1508065303050001','1052','0051242200','Riva Ariska','Muaro Bungo','2005-03-13','P','A','1','1','1','0','0','0','1',0,0,'1','Sidolego','Sidolego','Tabir Lintas','Bungo','Jambi','082281400391','37252','-1.8817','102.3033','','','','',NULL,1,'0',NULL),(89,'1508062910060001','1053','0069473708','Sabela Abdul Aziz','Mulia Bhakti','2006-10-29','L','A','1','6','6','0','0','0','1',0,0,'1','Jalan Ajipurna','Mulia Bhakti','Pelepat','Bungo','Jambi','085709347791','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(90,'1508060302060002','1054','0063009451','Rohmat Fatur Febriadi Pratama','Mulia Bhakti','2006-02-03','L','A','1','1','1','0','0','0','1',0,0,'1','Jalan Ekatama','Mulia Bhakti','Pelepat','Bungo','Jambi','085709663477','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(91,'1508066312060001','1055','0064357038','Sagita Mega Aulia','Muara Bungo','2006-12-23','P','A','1','3','3','0','0','0','1',0,0,'1','Jalan Kusuma','Mulia Bhakti','Pelepat','Bungo','Jambi','081245673991','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(92,'1508066311060001','1056','0061858049','Sasta Novaliany','Mulia Bhakti','2006-11-23','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Ekatama','Mulia Bhakti','Pelepat','Bungo','Jambi','085709341752','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(93,'1508066409060001','1057','0062970631','Sheptia Ramadhani','Muara Bungo','2006-09-24','P','A','1','3','3','0','0','0','1',0,0,'1','Jalan Ajipurna','Mulia Bhakti','Pelepat','Bungo','Jambi','083171723955','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(94,'1508062711060001','1058','0063343419','Satrio Dwi Cipta Raharja','Muara Bungo','2006-11-27','L','A','1','2','2','0','0','0','1',0,0,'1','Jalan Kusuma','Mulia Bhakti','Pelepat','Bungo','Jambi','085709582160','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(95,'1503035001070003','1059','0074254452','Sri Lestari Ningsih','Batang Merangin','2007-01-10','P','A','1','2','2','0','0','0','1',0,0,'1','JL. BATU JAJAR','AIR BATU','Tabir Ilir','Bungo','Jambi','082376592143','37252','-1.7221','102.2879','','','','',NULL,1,'0',NULL),(96,'1508061006060001','1060','0066543353','Suwanda Pangeran Saputra','Mulia Bhakti','2006-06-10','L','A','1','1','1','0','0','0','1',0,0,'1','Jalan Ajipurna','Mulia Bhakti','Pelepat','Bungo','Jambi','085766627609','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(97,'1508064406070001','1061','0077991251','Trianist Bunga Puri','Kuamang Kuning','2007-06-04','P','A','1','2','2','0','0','0','1',0,0,'1','Dasa Purwa','Mulia Bhakti','Pelepat','Bungo','Jambi','083171791292','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(98,'1508066009060003','1062','0063339968','TIARA PUJAKESUMA','Kuamang Kuning','2006-09-20','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Bukit Telago','Cilodang','Pelepat','Bungo','Jambi','082289276911','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(99,'1508065207070004','1063','0074003312','Viona Julita Saputri','Mulya Jaya','2007-07-12','P','A','1','2','2','0','0','0','1',0,0,'1','Jln Jati','Mulya Jaya','Pelepat','Bungo','Jambi','082251369148','37252','-1.7099','102.1737','','','','',NULL,1,'0',NULL),(100,'1508060510060001','1064','0067555390','Wawan Rama Setiya Danni','Mulia Bhakti','2006-10-05','L','A','1','2','2','0','0','0','1',0,0,'1','Ekatama','Mulia Bhakti','Pelepat','Bungo','Jambi','085766630541','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(101,'1508065807070002','1066','0075272106','Wima Dwi Suranti','Mulia Bhakti','2007-07-18','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Kusuma','Mulia Bhakti','Pelepat','Bungo','Jambi','085709582013','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(102,'1508064606060005','1068','0069684179','Zahra Salsabila','Ma. Bungo','2006-06-06','P','A','1','1','1','0','0','0','1',0,0,'1','Jalan Bukit Apit','CILODANG','Pelepat','Bungo','Jambi','081214188267','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(103,'1508061507070002','1069','0078833299','Yoga Wahyu Pratama','Muara Bungo','2007-07-15','L','A','1','1','1','0','0','0','1',0,0,'1','Komp. Pasar unit X','Mulia Bhakti','Pelepat','Bungo','Jambi','081270621940','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(104,'1508065907070001','1070','0073088492','Zulia Nur Cahyati','Muara Bungo','2007-07-19','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Ciptasari','Mulia Bhakti','Pelepat','Bungo','Jambi','085609936480','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(105,'1502145904060001','1072','0061419598','Khusnul Khotimah','Desa Tanjung Gedang','2006-04-19','P','A','1','1','1','0','0','0','1',0,0,'1','Jalan Batu Pahat','Air Batu','Tabir Ilir','Merangin','Jambi','081271319124','37252','-1,6873','102,3123','','','','',NULL,1,'0',NULL),(106,'1508061504040001','1073','0042810743','HARIS YASIN','SUMEDANG','2004-04-15','L','A','1','2','2','0','0','0','1',0,0,'1','Jalan Bukit Telago','Cilodang','Pelepat','Bungo','Jambi','085283428157','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(107,'1508061807070001','1075','0075355974','Abdul Hadi','Muara Bungo','2007-07-18','L','A','1','1','1','0','0','0','1',0,0,'1','Jalan Bukit Tinggi','Cilodang','Pelepat','Bungo','Jambi','085378955631','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(108,'1508064208080001','1076','0073510908','Adinda Wulan Dwi Agustin','Bandung','2007-08-02','P','A','1','3','3','0','0','0','1',0,0,'1','Jalan Kusuma','Mulia Bhakti','Pelepat','Bungo','Jambi','085709333328','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(109,'1508065006070001','1078','0077372206','Agnes Putri Budiasih','Mulia Bhakti','2007-06-10','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Ajipurna','Mulia Bhakti','Pelepat','Bungo','Jambi','085709347790','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(110,'1508060308070002','1079','0072749467','Agung Rivaldi','Muara Bungo','2007-08-03','L','A','1','1','1','0','0','0','1',0,0,'1','Ciptasari','Mulia Bhakti','Pelepat','Bungo','Jambi','085709661698','37252','-1.6977','102.3128','','','','',NULL,1,'0',NULL),(111,'1508060901080001','1080','0082072806','Ahmad Ari Prasetyo','Muara Bungo','2008-01-09','L','A','1','3','3','0','0','0','1',0,0,'1','Jalan Kusuma','Mulia Bhakti','Pelepat','Bungo','Jambi','082210976834','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(112,'1508060704080004','1081','0085805202','Akhyar Habibullah','Muara Bungo','2008-04-07','L','A','1','2','2','0','0','0','1',0,0,'1','Jl. Kencana','Mulia BHakti','Pelepat','Bungo','Jambi','083121671740','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(113,'1508062307070004','1082','0074023645','Alando Muhamad Sadewo','Muara Bungo','2007-07-23','L','A','1','4','4','0','0','0','1',0,0,'1','Jalan Wijaya Kusuma','Gapura Suci','Pelepat','Bungo','Jambi','081366168769','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(114,'1508062303060001','1083','0066770829','Aldi Jani Puldas Made','Kuamang Kuning','2006-03-23','L','A','1','2','2','0','0','0','1',0,0,'1','Jalan Bukit Luncuk','Cilodang','Pelepat','Bungo','Jambi','082387353035','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(115,'1508064912070002','1084','0075769354','Amelia Dewi Safitri','Bungo','2007-12-09','P','A','1','1','1','0','0','0','1',0,0,'1','Dharma','Mulia Bhakti','Pelepat','Bungo','Jambi','085709332598','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(116,'1508065110070001','1085','0079288833','Ananda Safitri','Muara Bungo','2007-10-11','P','A','1','1','1','0','0','0','1',0,0,'1','Komp. Pasar X','Mulia Bhakti','Pelepat','Bungo','Jambi','083121624997','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(117,'1508062612070001','1086','0078023557','Angga Fadilla Tambunan','Muara Bungo','2007-12-26','L','A','1','3','3','0','0','0','1',0,0,'1','Ekatama','Mulia Bhakti','Pelepat','Bungo','Jambi','085783524033','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(118,'1508060109070001','1087','0078625495','Arbai Nur Septiano','Muara Bungo','2007-09-01','L','A','1','2','2','0','0','0','1',0,0,'1','Jalan Dasa Purwa','Mulia Bhakti','Pelepat','Bungo','Jambi','085789483588','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(119,'1508062208070003','1088','0075998526','Ardi Arwana','Muara Bungo','2007-08-22','L','A','1','2','2','0','0','0','1',0,0,'1','Kusuma','Mulia Bhakti','Pelepat','Bungo','Jambi','085783529114','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(120,'1508062604070001','1089','0071754743','Ardi Nurwahyu','Sekadau Kalbar','2007-04-26','L','A','1','1','1','0','0','0','1',0,0,'1','ASAM','CILODANG','Pelepat','Bungo','Jambi','083121964332','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(121,'1508090505080001','1090','0089026170','Ardiyan Saputra','Muara Bungo','2008-05-05','L','A','1','1','1','0','0','0','1',0,0,'1','Rimbo Bujang','Bangun Harjo','Pelepat Ilir','Bungo','Jambi','085282867893','37252','-1,5807','102,3323','','','','',NULL,1,'0',NULL),(122,'1508060910070002','1091','0079296278','Cahya Ramadani','Muara Bungo','2007-10-09','L','A','1','2','2','0','0','0','1',0,0,'1','Jalan Kusuma','Mulia Bhakti','Pelepat','Bungo','Jambi','085609819015','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(123,'1508065411070001','1092','0071527388','Cantika Laras Sati','Muara Bungo','2007-11-14','P','A','1','2','2','0','0','0','1',0,0,'1','Jl. Ekatama','Mulia Bhakti','Pelepat','Bungo','Jambi','085609091387','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(124,'1508095305080001','1093','0082293037','Dea Naura Asyifa','Merangin','2008-05-13','P','A','1','1','1','0','0','0','1',0,0,'1','Batu Raden','Air Batu','Tabir Ilir','Bungo','Jambi','082377542837','37252','-1.7356','102.2974','','','','',NULL,1,'0',NULL),(125,'1508065101070002','1094','0074088723','Diana Cantika Noviyanti','Muara Bungo','2007-01-11','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Bukit Luncuk','Cilodang','Pelepat','Bungo','Jambi','082361935143','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(126,'1508060411070001','1095','0078735841','Dimas Maulana','Mulia Bhakti','2007-11-04','L','A','1','1','1','0','0','0','1',0,0,'1','Setia Bhakti','Mulia Bhakti','Pelepat','Bungo','Jambi','083803185154','37252','-1.6977','102.3128','','','','',NULL,1,'0',NULL),(127,'1508065101070003','1096','0073872850','Dina Novita','Muara Bungo','2007-01-11','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Bukit Luncuk','CILODANG','Pelepat','Bungo','Jambi','082361935133','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(128,'1502146706080001','1097','0081892104','Dina Zhahratul Aulia','Merangin','2008-06-27','P','A','1','1','1','0','0','0','1',0,0,'1','Pasar','Air Batu','Tabir Ilir','Bungo','Jambi','083121834772','37252','-1.7356','102.2974','','','','',NULL,1,'0',NULL),(129,'1508064709070002','1098','0075267471','Dine Rohdyanawati','Muara Bungo','2007-09-07','P','A','1','2','2','0','0','0','1',0,0,'1','Ciptasari','Mulia Bhakti','Pelepat','Bungo','Jambi','085609802585','37252','-1.6977','102.3128','','','','',NULL,1,'0',NULL),(130,'1508066004070001','1099','0079649877','Dwi Amelia Saputri','Muara Bungo','2007-04-20','P','A','1','1','1','0','0','0','1',0,0,'1','Jalan Bukit Tinggi','Cilodang','Pelepat','Bungo','Jambi','082283005438','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(131,'1508066907080002','1100','0086377795','Elviana Maizatu Saufia','Muara Bungo','2008-07-29','P','A','1','2','2','0','0','0','1',0,0,'1','Ekatama','Mulia Bakti','Pelepat','Bungo','Jambi','081273711426','37252','-1.6977','102.3128','','','','',NULL,1,'0',NULL),(132,'1508064808070001','1101','0076184046','Erviana Dwi Lestari','Muara Bungo','2007-08-08','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Setia Bhakti','Mulia Bhakti','Pelepat','Bungo','Jambi','085783010067','37252','-1.2003','101.302','','','','',NULL,1,'0',NULL),(133,'1508062904060002','1102','0067558016','Ferdi Yansen Manuel','Muara Bungo','2006-04-29','L','B','1','2','2','0','0','0','1',0,0,'1','Perum PT SAL','Cilodang','Pelepat','Bungo','Jambi','081311956080','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(134,'1508066212070002','1103','0078399259','Firdiani Shofiyatul Jauza','Sumedang','2007-12-22','P','A','1','1','1','0','0','0','1',0,0,'1','JL BUKIT TELAGO','CILODANG','Pelepat','Bungo','Jambi','081274297043','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(135,'1508066611070002','1104','0074135075','Gea Anastacia','Mulya Bhakti','2007-11-26','P','A','1','1','1','0','0','0','1',0,0,'1','Dasa Purwa','Mulia Bhakti','Pelepat','Bungo','Jambi','085783524543','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(136,'1508061912080001','1105','0082083691','Hendrik Sijabat','Muara Bungo','2008-03-29','L','B','1','1','1','0','0','0','1',0,0,'1','Lintas Jaya','Dwi Karya Bhakti','Pelepat','Bungo','Jambi','082372257625','37252','-1.7193','102.1917','','','','',NULL,1,'0',NULL),(137,'1508066501080004','1106','0088040728','Indah Fuji Lestari','Muara Bungo','2008-01-25','P','A','1','2','2','0','0','0','1',0,0,'1','BUKIT TINNGI','CILODANG','Pelepat','Bungo','Jambi','083172019576','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(138,'1508066611070003','1107','0079664710','Intan Novita Sari','Muara Bungo','2007-11-26','P','A','1','4','4','0','0','0','1',0,0,'1','Kusuma','Mulia Bhakti','Pelepat','Bungo','Jambi','085709347823','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(139,'1508066704080002','1108','0082145546','Kasih Aulia Imanesuci','Muara Bungo','2008-04-27','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Prasetia','Mulia Bhakti','Pelepat','Bungo','Jambi','082180059446','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(140,'1508066008070001','1109','0078986316','Lisa Agus Rahma Wati','Muara Bungo','2007-08-20','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Ekatama','Mulia Bhakti','Pelepat','Bungo','Jambi','085333291387','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(141,'1508065511080002','1110','0076075947','Margareta Sari Br Siallagan','Muara Bungo','2008-11-15','P','C','1','4','4','0','0','0','1',0,0,'1','Dasa Purwa','Mulia Bhakti','Pelepat','Bungo','Jambi','082285253372','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(142,'1502144405080001','1111','0085663378','Meila Restu Ayu Ningsih','Muara Bungo','2008-05-04','P','A','1','1','1','0','0','0','1',0,0,'1','Jalan Setia Bhakti','Mulia Bhakti','Pelepat','Bungo','Jambi','083121282970','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(143,'1508061210070001','1112','0071383247','Muhammad Akbar','Mulia Bhakti','2007-10-12','L','A','1','2','2','0','0','0','1',0,0,'1','Jalan Ajipurna','Mullia Bhakti','Pelepat','Bungo','Jambi','082279814825','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(144,'1502142505080001','1113','0086592235','Muhammad Hafit Saputra','Merangin','2008-05-25','L','A','1','1','1','0','0','0','1',0,0,'1','Banyu Wangi','Air Batu','Tabir Ilir','Merangin','Jambi','083121611307','37252','-1.7356','102.2974','','','','',NULL,1,'0',NULL),(145,'1508064601080001','1114','0082501802','Nabila Zahwa Dewi','Muara Bungo','2008-01-06','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Prasetia','Mulia Bhakti','Pelepat','Bungo','Jambi','083171266468','37252','-1.6977','102.3128','','','','',NULL,1,'0',NULL),(146,'1508062307070003','1115','0071057628','Nanda Nurdian Kelana','Bukit Kemang','2007-07-23','L','A','1','2','2','0','0','0','1',0,0,'1','Jalan Kusuma','Mulia  Bhakti','Pelepat','Bungo','Jambi','085789484547','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(147,'1508065609070001','1116','0076061164','NISSA RAMADHANI ','SUMEDANG','2007-09-16','P','A','1','1','1','0','0','0','1',0,0,'1','BUKIT KEMUNING','CILODANG','Pelepat','Bungo','Jambi','082289550506','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(148,'1508062509070002','1117','0078271055','Nur Ammar Ramadhan','Muara Bungo','2007-09-25','L','A','1','2','2','0','0','0','1',0,0,'1','BUKIT KEMUNING','CILODANG','Pelepat','Bungo','Jambi','082237620907','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(149,'1508065806070001','1118','0077122481','Nurul Elisah','Cilodang','2007-06-18','P','A','1','1','1','0','0','0','1',0,0,'1','BUKIT KEMUNING','CILODANG','Pelepat','Bungo','Jambi','083177209709','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(150,'1508064107080003','1119','0081409163','Putri Agustina Rizki','Muara Bungo','2008-07-01','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Kencana','Mulia Bhakti','Pelepat','Bungo','Jambi','083121628866','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(151,'1508060912070003','1120','0075463968','Raffi Alfarizzi','Muara Bungo','2007-12-09','L','A','1','1','1','0','0','0','1',0,0,'1','Jalan Makarti','Mulia Bhakti','Pelepat','Bungo','Jambi','082268219803','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(152,'1508064808080002','1121','0089718430','Rahmawati Agustin','Muara Bungo','2008-08-08','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Ekatama','Mulia Bhakti','Pelepat','Bungo','Jambi','082281040494','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(153,'1508062907070004','1122','0075765760','Rangga Kurniawan','Muara Bungo','2007-07-29','L','A','1','1','1','0','0','0','1',0,0,'1','BUKIT ASAM','CILODANG','Pelepat','Bungo','Jambi','082246652671','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(154,'1508066406070001','1123','0076607412','Reni Nurmalasari','Muara Bungo','2007-06-24','P','A','1','3','3','0','0','0','1',0,0,'1','BUKIT TELAGO','CILODANG','Pelepat','Bungo','Jambi','085381626092','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(155,'1508064810070001','1124','0075530479','Reva Aryanti','Jambi','2007-10-08','P','A','1','1','1','0','0','0','1',0,0,'1','Dsn. Arnih Barat','Cilodang','Pelepat','Bungo','Jambi','081273389231','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(156,'1508060811070002','1125','0077785874','Ridwan Dimas Sartono Sihombing','Muara Bungo','2007-11-08','L','A','1','2','2','0','0','0','1',0,0,'1','Jalan Ajipurna','Mulia Bhakti','Pelepat','Bungo','Jambi','081532674449','37252','-1.6977','102.3128','','','','',NULL,1,'0',NULL),(157,'1508065309070002','1127','0073319338','Rissa Azzahra Ramadhani','Muara Bungo','2007-09-13','P','A','1','1','1','0','0','0','1',0,0,'1','BUKIT ASAM','CILODANG','Pelepat','Bungo','Jambi','085379044784','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(158,'1508064701080002','1128','0087780185','RUCY HARIYANTI','BLITAR','2008-01-07','P','A','1','1','1','0','0','0','1',0,0,'1','BUKIT ASAM','CILODANG','Pelepat','Bungo','Jambi','082180717356','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(159,'1508064904080002','1129','0087744920','Salma Dzakiyyah','Muara Bungo','2008-04-09','P','A','1','2','2','0','0','0','1',0,0,'1','Ekatama','Mulia Bhakti','Pelepat','Bungo','Jambi','085669317367','37252','-1.7142','102.2006','','','','',NULL,1,'0',NULL),(160,'1508065012060002','1130','0069518171','Sukma Ayu Purwanti','Cilodang','2006-12-10','P','A','1','2','2','0','0','0','1',0,0,'1','Jalan Bukit Luncuk','Cilodang','Pelepat','Bungo','Jambi','083121966080','37252','-1.7203','102.2003','','','','',NULL,1,'0',NULL),(161,'1508062905050001','1134','0058122538','Johan Tanijar Manurung','Pematangsiantar','2005-05-29','L','B','1','2','2','0','0','0','1',0,0,'1','Perum PT.SAL 2','Cilodang','Pelepat','Bungo','Jambi','085245804900','37252','-1,6453','102,3049','','','','',NULL,1,'0',NULL);
/*!40000 ALTER TABLE `tbsiswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbskul`
--

DROP TABLE IF EXISTS `tbskul`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbskul` (
  `idskul` int(11) NOT NULL AUTO_INCREMENT,
  `idrayon` char(4) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kdskul` char(10) CHARACTER SET utf8mb4 DEFAULT NULL,
  `nmskul` varchar(250) CHARACTER SET utf8mb4 DEFAULT NULL,
  `idjenjang` int(3) DEFAULT NULL,
  `nss` char(15) CHARACTER SET utf8mb4 NOT NULL,
  `npsn` varchar(15) CHARACTER SET utf8mb4 DEFAULT NULL,
  `nmskpd` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `alamat` mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
  `desa` mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
  `kec` mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
  `kab` mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
  `prov` mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
  `kdpos` char(5) CHARACTER SET utf8mb4 DEFAULT NULL,
  `telp` char(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `email` varchar(250) CHARACTER SET utf8mb4 DEFAULT NULL,
  `website` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `logoskul` mediumtext CHARACTER SET utf8mb4 DEFAULT NULL,
  `logoskpd` varchar(250) CHARACTER SET utf8mb4 DEFAULT NULL,
  PRIMARY KEY (`idskul`),
  KEY `idrayon` (`idrayon`),
  KEY `idjenjang` (`idjenjang`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbskul`
--

LOCK TABLES `tbskul` WRITE;
/*!40000 ALTER TABLE `tbskul` DISABLE KEYS */;
INSERT INTO `tbskul` VALUES (1,'1004','P10040036','SMP Negeri 5 Pelepat',2,'201100201036','10500708','Dinas Pendidikan Dan Kebudayaan','Jalan Dasa Purwa','Mulia Bhakti','Pelepat','Bungo','Jambi','37252','','info@smpnlipat.sch.id','https://www.smpnlipat.sch.id','logo.png','bungo.png');
/*!40000 ALTER TABLE `tbskul` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbthpel`
--

DROP TABLE IF EXISTS `tbthpel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbthpel` (
  `idthpel` int(11) NOT NULL AUTO_INCREMENT,
  `nmthpel` char(5) NOT NULL,
  `desthpel` varchar(50) NOT NULL DEFAULT '0',
  `awal` varchar(50) DEFAULT NULL,
  `aktif` enum('1','0') DEFAULT NULL,
  PRIMARY KEY (`idthpel`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbthpel`
--

LOCK TABLES `tbthpel` WRITE;
/*!40000 ALTER TABLE `tbthpel` DISABLE KEYS */;
INSERT INTO `tbthpel` VALUES (1,'20181','2018/2019-Ganjil','2018-07-01','0'),(2,'20182','2018/2019-Genap','2019-01-01','0'),(3,'20191','2019/2020-Ganjil','2019-07-01','0'),(4,'20192','2019/2020-Genap','2020-01-01','0'),(5,'20201','2020/2021-Ganjil','2020-07-01','0'),(6,'20202','2020/2021-Genap','2021-01-01','0'),(7,'20211','2021/2022-Ganjil','2021-07-01','1');
/*!40000 ALTER TABLE `tbthpel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbuser`
--

DROP TABLE IF EXISTS `tbuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbuser` (
  `username` char(20) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `level` enum('1','2','3') NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `aktif` enum('0','1') NOT NULL,
  `xlog` datetime DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbuser`
--

LOCK TABLES `tbuser` WRITE;
/*!40000 ALTER TABLE `tbuser` DISABLE KEYS */;
INSERT INTO `tbuser` VALUES ('Admin','Kasworo Wardani','1','$2y$10$zHD0t.8WDf/8vHTJ7uRpEO4a/ciy11uB/X5tiTV46yx7gIGvP5LlS','1',NULL);
/*!40000 ALTER TABLE `tbuser` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-08  7:15:39
