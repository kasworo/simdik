-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2022 at 04:04 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsimdik`
--

-- --------------------------------------------------------

--
-- Table structure for table `ref_jnsregistrasi`
--

CREATE TABLE `ref_jnsregistrasi` (
  `idjreg` int(11) NOT NULL,
  `jnsregistrasi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_jnsregistrasi`
--

INSERT INTO `ref_jnsregistrasi` (`idjreg`, `jnsregistrasi`) VALUES
(1, 'Siswa Baru'),
(2, 'Pindahan'),
(3, 'Naik Kelas'),
(4, 'Lanjutan Semester'),
(5, 'Mengulang'),
(6, 'Mutasi'),
(7, 'Keluar'),
(8, 'Lulus');

-- --------------------------------------------------------

--
-- Table structure for table `ref_pekerjaan`
--

CREATE TABLE `ref_pekerjaan` (
  `idkerja` int(11) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_pekerjaan`
--

INSERT INTO `ref_pekerjaan` (`idkerja`, `pekerjaan`) VALUES
(0, 'Tidak Bekerja'),
(1, 'Aparatur Sipil Negara'),
(2, 'Karyawan Swasta'),
(3, 'Wiraswasta'),
(4, 'Pedagang'),
(5, 'Petani / Pekebun'),
(6, 'Buruh'),
(7, 'Mengurus Rumah Tangga'),
(8, 'Sudah Meninggal');

-- --------------------------------------------------------

--
-- Table structure for table `ref_pendidikan`
--

CREATE TABLE `ref_pendidikan` (
  `idpddk` int(11) NOT NULL,
  `pendidikan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_pendidikan`
--

INSERT INTO `ref_pendidikan` (`idpddk`, `pendidikan`) VALUES
(1, 'Tidak Sekolah'),
(2, 'SD Sederajat'),
(3, 'SMP Sederajat'),
(4, 'SMA Sederajat'),
(5, 'Diploma I (D-1)'),
(6, 'Diploma II (D-2)'),
(7, 'Diploma III (D-3)'),
(8, 'Sarjana (S-1)'),
(9, 'Magister (S-2)'),
(10, 'Doktoral (S-3)');

-- --------------------------------------------------------

--
-- Table structure for table `ref_penghasilan`
--

CREATE TABLE `ref_penghasilan` (
  `idhsl` int(11) NOT NULL,
  `penghasilan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_penghasilan`
--

INSERT INTO `ref_penghasilan` (`idhsl`, `penghasilan`) VALUES
(0, 'Tidak Berpenghasilan'),
(1, 'Kurang Dari Rp 1.000.000'),
(2, 'Antara Rp 1.000.000 s/d Rp 3.000.000'),
(3, 'Antara Rp 3.0000.000 s/d Rp 5.000.000'),
(4, 'Lebih Dari Rp 5.000.000');

-- --------------------------------------------------------

--
-- Table structure for table `ref_skulmitra`
--

CREATE TABLE `ref_skulmitra` (
  `idmitra` int(11) NOT NULL,
  `nmmitra` varchar(255) NOT NULL,
  `idjenjang` int(11) NOT NULL,
  `npsn` char(10) NOT NULL,
  `alamat` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ref_teknik`
--

CREATE TABLE `ref_teknik` (
  `idteknik` int(11) NOT NULL,
  `nmteknik` int(11) NOT NULL,
  `aspek` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbabsensi`
--

CREATE TABLE `tbabsensi` (
  `idabsensi` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `idthpel` int(11) NOT NULL,
  `sakit` int(11) DEFAULT NULL,
  `izin` int(11) DEFAULT NULL,
  `alpa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbakhirskul`
--

CREATE TABLE `tbakhirskul` (
  `idakhir` int(11) NOT NULL,
  `idjreg` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `tglakhir` date NOT NULL,
  `noijazah` varchar(40) NOT NULL,
  `tglijazah` date NOT NULL,
  `lanjut` enum('1','0') NOT NULL,
  `nosurat` varchar(100) DEFAULT NULL,
  `tglsurat` date DEFAULT NULL,
  `alasan` varchar(250) DEFAULT NULL,
  `skulbaru` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbasalsd`
--

CREATE TABLE `tbasalsd` (
  `id` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `aslsd` varchar(250) NOT NULL,
  `noijazah` varchar(40) NOT NULL,
  `tglijazah` date NOT NULL,
  `lama` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbbobot`
--

CREATE TABLE `tbbobot` (
  `idbobot` int(11) NOT NULL,
  `idrombel` int(11) NOT NULL,
  `idmapel` int(11) NOT NULL,
  `idthpel` int(11) NOT NULL,
  `nph` int(11) NOT NULL,
  `pts` int(11) NOT NULL,
  `npas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbekskul`
--

CREATE TABLE `tbekskul` (
  `idekskul` int(11) NOT NULL,
  `akekskul` char(5) NOT NULL,
  `nmekskul` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbgtk`
--

CREATE TABLE `tbgtk` (
  `idgtk` int(11) NOT NULL,
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
  `deleted` enum('0','1') DEFAULT NULL,
  `username` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbjenjang`
--

CREATE TABLE `tbjenjang` (
  `idjenjang` int(11) NOT NULL,
  `akjenjang` char(3) NOT NULL,
  `nmjenjang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbkelas`
--

CREATE TABLE `tbkelas` (
  `idkelas` int(11) NOT NULL,
  `nmkelas` varchar(30) NOT NULL,
  `idjenjang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbkkm`
--

CREATE TABLE `tbkkm` (
  `idkkm` int(11) NOT NULL,
  `idthpel` int(11) NOT NULL,
  `idkelas` int(11) NOT NULL,
  `idmapel` int(11) NOT NULL,
  `kkm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbkompetensi`
--

CREATE TABLE `tbkompetensi` (
  `idkd` int(11) NOT NULL,
  `kodekd` char(15) NOT NULL,
  `idmapel` int(11) NOT NULL,
  `idkelas` int(11) NOT NULL,
  `aspek` enum('1','2','3','4') NOT NULL,
  `kdlengkap` varchar(250) NOT NULL,
  `kdringkas` varchar(50) NOT NULL,
  `semester` enum('1','2') NOT NULL,
  `aktif` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbkurikulum`
--

CREATE TABLE `tbkurikulum` (
  `idkur` int(11) NOT NULL,
  `akkur` char(5) NOT NULL,
  `nmkur` varchar(50) NOT NULL,
  `aktif` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbmapel`
--

CREATE TABLE `tbmapel` (
  `idmapel` int(11) NOT NULL,
  `idkur` int(11) NOT NULL,
  `akmapel` char(5) NOT NULL,
  `nmmapel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbmutasi`
--

CREATE TABLE `tbmutasi` (
  `idm` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `jnsmutasi` enum('1','2') NOT NULL,
  `aslkesmp` varchar(250) DEFAULT NULL,
  `nosurat` varchar(100) DEFAULT NULL,
  `tglsurat` date DEFAULT NULL,
  `alasan` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbnilaiekskul`
--

CREATE TABLE `tbnilaiekskul` (
  `idneks` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `idthpel` int(11) NOT NULL,
  `idekskul` int(11) NOT NULL,
  `nilaieks` int(11) NOT NULL,
  `deskripsi` mediumtext DEFAULT NULL,
  `tglinput` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbnilaiharian`
--

CREATE TABLE `tbnilaiharian` (
  `idnph` int(11) NOT NULL,
  `idthpel` int(11) NOT NULL,
  `idkd` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `nilaiharian` int(11) NOT NULL,
  `idteknik` int(11) NOT NULL,
  `tglinput` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbnilaiijz`
--

CREATE TABLE `tbnilaiijz` (
  `idnijz` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `idmapel` int(11) NOT NULL,
  `idthpel` int(11) NOT NULL,
  `nilaiijz` int(11) NOT NULL,
  `tglinput` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbnilaipas`
--

CREATE TABLE `tbnilaipas` (
  `idnpas` int(11) NOT NULL,
  `idthpel` int(11) NOT NULL,
  `idmapel` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `nilaipas` int(11) NOT NULL,
  `tglinput` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbnilaipts`
--

CREATE TABLE `tbnilaipts` (
  `idnpts` int(11) NOT NULL,
  `idthpel` int(11) NOT NULL,
  `idmapel` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `nilaipts` int(11) NOT NULL,
  `tglinput` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbnilairapor`
--

CREATE TABLE `tbnilairapor` (
  `idnrapor` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `idmapel` int(11) NOT NULL,
  `idthpel` int(11) NOT NULL,
  `aspek` enum('3','4') NOT NULL,
  `nilairapor` int(11) NOT NULL,
  `predikat` char(1) DEFAULT NULL,
  `deskripsi` mediumtext DEFAULT NULL,
  `tglinput` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbnilaisikap`
--

CREATE TABLE `tbnilaisikap` (
  `idnsikap` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `idthpel` int(11) NOT NULL,
  `aspek` enum('1','2') NOT NULL,
  `nilaisikap` int(11) NOT NULL,
  `deskripsi` mediumtext DEFAULT NULL,
  `tglinput` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbnilaius`
--

CREATE TABLE `tbnilaius` (
  `idnijz` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `idmapel` int(11) NOT NULL,
  `idthpel` int(11) NOT NULL,
  `aspek` enum('3','4') NOT NULL,
  `nilaiijz` int(11) NOT NULL,
  `tglinput` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbortu`
--

CREATE TABLE `tbortu` (
  `idortu` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `nmortu` varchar(255) DEFAULT NULL,
  `nik` char(18) DEFAULT NULL,
  `idagama` char(1) DEFAULT NULL,
  `hidup` enum('0','1') DEFAULT NULL,
  `alamat` mediumtext DEFAULT NULL,
  `desa` mediumtext DEFAULT NULL,
  `kec` mediumtext DEFAULT NULL,
  `kab` mediumtext DEFAULT NULL,
  `prov` mediumtext DEFAULT NULL,
  `nohp` char(15) DEFAULT NULL,
  `kdpos` char(5) DEFAULT NULL,
  `hubkel` enum('1','2','3','4','5','6') DEFAULT NULL,
  `idhsl` int(11) DEFAULT NULL,
  `idkerja` int(11) DEFAULT NULL,
  `idpddk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbpengampu`
--

CREATE TABLE `tbpengampu` (
  `idampu` int(11) NOT NULL,
  `idgtk` int(11) NOT NULL,
  `idmapel` int(11) NOT NULL,
  `idrombel` int(11) NOT NULL,
  `idthpel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbprov`
--

CREATE TABLE `tbprov` (
  `idprov` char(2) CHARACTER SET utf8mb4 NOT NULL,
  `nmprov` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbrayon`
--

CREATE TABLE `tbrayon` (
  `idrayon` char(4) NOT NULL,
  `idprov` char(2) DEFAULT NULL,
  `nmrayon` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbregistrasi`
--

CREATE TABLE `tbregistrasi` (
  `idreg` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `idjreg` int(11) NOT NULL,
  `idkelas` int(11) NOT NULL,
  `idthpel` int(11) DEFAULT NULL,
  `tglreg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbsiswa`
--

CREATE TABLE `tbsiswa` (
  `idsiswa` int(11) NOT NULL,
  `nik` char(18) DEFAULT NULL,
  `nis` int(5) UNSIGNED ZEROFILL DEFAULT NULL,
  `nisn` varchar(10) DEFAULT NULL,
  `nmsiswa` varchar(255) DEFAULT NULL,
  `tmplahir` varchar(255) DEFAULT NULL,
  `tgllahir` date DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `idagama` char(1) DEFAULT NULL,
  `warganegara` enum('1','2') DEFAULT NULL,
  `anake` char(10) DEFAULT NULL,
  `sdr` char(11) DEFAULT NULL,
  `goldarah` enum('0','1','2','3','4') DEFAULT NULL,
  `kebkhusus` enum('0','1','2','3','4','5','6','7') DEFAULT NULL,
  `rwysakit` enum('0','1','2','3','4','5','6','7','8') DEFAULT NULL,
  `ikuts` enum('1','2','3','4') DEFAULT '1',
  `jarak` int(11) DEFAULT 0,
  `waktu` int(11) DEFAULT 0,
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
  `username` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbskul`
--

CREATE TABLE `tbskul` (
  `idskul` int(11) NOT NULL,
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
  `logoskpd` varchar(250) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbthpel`
--

CREATE TABLE `tbthpel` (
  `idthpel` int(11) NOT NULL,
  `nmthpel` char(5) NOT NULL,
  `desthpel` varchar(50) NOT NULL DEFAULT '0',
  `awal` varchar(50) DEFAULT NULL,
  `aktif` enum('1','0') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `username` char(20) NOT NULL,
  `namatmp` varchar(250) NOT NULL,
  `level` enum('1','2','3') NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `aktif` enum('0','1') NOT NULL,
  `xlog` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ref_jnsregistrasi`
--
ALTER TABLE `ref_jnsregistrasi`
  ADD PRIMARY KEY (`idjreg`);

--
-- Indexes for table `ref_pekerjaan`
--
ALTER TABLE `ref_pekerjaan`
  ADD PRIMARY KEY (`idkerja`);

--
-- Indexes for table `ref_pendidikan`
--
ALTER TABLE `ref_pendidikan`
  ADD PRIMARY KEY (`idpddk`);

--
-- Indexes for table `ref_penghasilan`
--
ALTER TABLE `ref_penghasilan`
  ADD PRIMARY KEY (`idhsl`);

--
-- Indexes for table `ref_skulmitra`
--
ALTER TABLE `ref_skulmitra`
  ADD PRIMARY KEY (`idmitra`);

--
-- Indexes for table `tbabsensi`
--
ALTER TABLE `tbabsensi`
  ADD PRIMARY KEY (`idabsensi`);

--
-- Indexes for table `tbakhirskul`
--
ALTER TABLE `tbakhirskul`
  ADD PRIMARY KEY (`idakhir`),
  ADD KEY `idsiswa` (`idsiswa`);

--
-- Indexes for table `tbasalsd`
--
ALTER TABLE `tbasalsd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idsiswa` (`idsiswa`);

--
-- Indexes for table `tbbobot`
--
ALTER TABLE `tbbobot`
  ADD PRIMARY KEY (`idbobot`),
  ADD KEY `idrombel` (`idrombel`,`idmapel`,`idthpel`);

--
-- Indexes for table `tbekskul`
--
ALTER TABLE `tbekskul`
  ADD PRIMARY KEY (`idekskul`);

--
-- Indexes for table `tbgtk`
--
ALTER TABLE `tbgtk`
  ADD PRIMARY KEY (`idgtk`),
  ADD KEY `kdskul` (`idskul`);

--
-- Indexes for table `tbjenjang`
--
ALTER TABLE `tbjenjang`
  ADD PRIMARY KEY (`idjenjang`);

--
-- Indexes for table `tbkelas`
--
ALTER TABLE `tbkelas`
  ADD PRIMARY KEY (`idkelas`),
  ADD KEY `idjenjang` (`idjenjang`);

--
-- Indexes for table `tbkkm`
--
ALTER TABLE `tbkkm`
  ADD PRIMARY KEY (`idkkm`),
  ADD KEY `idthpel` (`idthpel`),
  ADD KEY `idkelas` (`idkelas`),
  ADD KEY `idmapel` (`idmapel`);

--
-- Indexes for table `tbkompetensi`
--
ALTER TABLE `tbkompetensi`
  ADD PRIMARY KEY (`idkd`),
  ADD KEY `idmapel` (`idmapel`),
  ADD KEY `idkelas` (`idkelas`);

--
-- Indexes for table `tbkurikulum`
--
ALTER TABLE `tbkurikulum`
  ADD PRIMARY KEY (`idkur`);

--
-- Indexes for table `tbmapel`
--
ALTER TABLE `tbmapel`
  ADD PRIMARY KEY (`idmapel`),
  ADD KEY `idkur` (`idkur`);

--
-- Indexes for table `tbmutasi`
--
ALTER TABLE `tbmutasi`
  ADD PRIMARY KEY (`idm`),
  ADD KEY `idsiswa` (`idsiswa`);

--
-- Indexes for table `tbnilaiekskul`
--
ALTER TABLE `tbnilaiekskul`
  ADD PRIMARY KEY (`idneks`),
  ADD KEY `idsiswa` (`idsiswa`,`idthpel`);

--
-- Indexes for table `tbnilaiharian`
--
ALTER TABLE `tbnilaiharian`
  ADD PRIMARY KEY (`idnph`);

--
-- Indexes for table `tbnilaiijz`
--
ALTER TABLE `tbnilaiijz`
  ADD PRIMARY KEY (`idnijz`),
  ADD KEY `idsiswa` (`idsiswa`,`idmapel`,`idthpel`);

--
-- Indexes for table `tbnilaipas`
--
ALTER TABLE `tbnilaipas`
  ADD PRIMARY KEY (`idnpas`);

--
-- Indexes for table `tbnilaipts`
--
ALTER TABLE `tbnilaipts`
  ADD PRIMARY KEY (`idnpts`);

--
-- Indexes for table `tbnilairapor`
--
ALTER TABLE `tbnilairapor`
  ADD PRIMARY KEY (`idnrapor`),
  ADD KEY `idsiswa` (`idsiswa`,`idmapel`,`idthpel`);

--
-- Indexes for table `tbnilaisikap`
--
ALTER TABLE `tbnilaisikap`
  ADD PRIMARY KEY (`idnsikap`),
  ADD KEY `idsiswa` (`idsiswa`,`idthpel`);

--
-- Indexes for table `tbnilaius`
--
ALTER TABLE `tbnilaius`
  ADD PRIMARY KEY (`idnijz`),
  ADD KEY `idsiswa` (`idsiswa`,`idmapel`,`idthpel`);

--
-- Indexes for table `tbortu`
--
ALTER TABLE `tbortu`
  ADD PRIMARY KEY (`idortu`),
  ADD KEY `idsiswa` (`idsiswa`),
  ADD KEY `idhsl` (`idhsl`,`idkerja`,`idpddk`);

--
-- Indexes for table `tbpengampu`
--
ALTER TABLE `tbpengampu`
  ADD PRIMARY KEY (`idampu`),
  ADD KEY `idmapel` (`idmapel`),
  ADD KEY `username` (`idgtk`),
  ADD KEY `idrombel` (`idrombel`);

--
-- Indexes for table `tbprov`
--
ALTER TABLE `tbprov`
  ADD PRIMARY KEY (`idprov`);

--
-- Indexes for table `tbrayon`
--
ALTER TABLE `tbrayon`
  ADD PRIMARY KEY (`idrayon`),
  ADD KEY `idprov` (`idprov`);

--
-- Indexes for table `tbregistrasi`
--
ALTER TABLE `tbregistrasi`
  ADD PRIMARY KEY (`idreg`),
  ADD KEY `idsiswa` (`idsiswa`,`idjreg`),
  ADD KEY `idrombel` (`idkelas`);

--
-- Indexes for table `tbsiswa`
--
ALTER TABLE `tbsiswa`
  ADD PRIMARY KEY (`idsiswa`),
  ADD KEY `idskul` (`idskul`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `tbskul`
--
ALTER TABLE `tbskul`
  ADD PRIMARY KEY (`idskul`),
  ADD KEY `idrayon` (`idrayon`),
  ADD KEY `idjenjang` (`idjenjang`);

--
-- Indexes for table `tbthpel`
--
ALTER TABLE `tbthpel`
  ADD PRIMARY KEY (`idthpel`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ref_jnsregistrasi`
--
ALTER TABLE `ref_jnsregistrasi`
  MODIFY `idjreg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ref_pekerjaan`
--
ALTER TABLE `ref_pekerjaan`
  MODIFY `idkerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ref_pendidikan`
--
ALTER TABLE `ref_pendidikan`
  MODIFY `idpddk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ref_penghasilan`
--
ALTER TABLE `ref_penghasilan`
  MODIFY `idhsl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ref_skulmitra`
--
ALTER TABLE `ref_skulmitra`
  MODIFY `idmitra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbabsensi`
--
ALTER TABLE `tbabsensi`
  MODIFY `idabsensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbakhirskul`
--
ALTER TABLE `tbakhirskul`
  MODIFY `idakhir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbasalsd`
--
ALTER TABLE `tbasalsd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbbobot`
--
ALTER TABLE `tbbobot`
  MODIFY `idbobot` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbekskul`
--
ALTER TABLE `tbekskul`
  MODIFY `idekskul` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbgtk`
--
ALTER TABLE `tbgtk`
  MODIFY `idgtk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbjenjang`
--
ALTER TABLE `tbjenjang`
  MODIFY `idjenjang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbkelas`
--
ALTER TABLE `tbkelas`
  MODIFY `idkelas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbkkm`
--
ALTER TABLE `tbkkm`
  MODIFY `idkkm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbkompetensi`
--
ALTER TABLE `tbkompetensi`
  MODIFY `idkd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbkurikulum`
--
ALTER TABLE `tbkurikulum`
  MODIFY `idkur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbmapel`
--
ALTER TABLE `tbmapel`
  MODIFY `idmapel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbmutasi`
--
ALTER TABLE `tbmutasi`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbnilaiekskul`
--
ALTER TABLE `tbnilaiekskul`
  MODIFY `idneks` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbnilaiharian`
--
ALTER TABLE `tbnilaiharian`
  MODIFY `idnph` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbnilaiijz`
--
ALTER TABLE `tbnilaiijz`
  MODIFY `idnijz` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbnilaipas`
--
ALTER TABLE `tbnilaipas`
  MODIFY `idnpas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbnilaipts`
--
ALTER TABLE `tbnilaipts`
  MODIFY `idnpts` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbnilairapor`
--
ALTER TABLE `tbnilairapor`
  MODIFY `idnrapor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbnilaisikap`
--
ALTER TABLE `tbnilaisikap`
  MODIFY `idnsikap` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbnilaius`
--
ALTER TABLE `tbnilaius`
  MODIFY `idnijz` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbortu`
--
ALTER TABLE `tbortu`
  MODIFY `idortu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbpengampu`
--
ALTER TABLE `tbpengampu`
  MODIFY `idampu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbregistrasi`
--
ALTER TABLE `tbregistrasi`
  MODIFY `idreg` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbsiswa`
--
ALTER TABLE `tbsiswa`
  MODIFY `idsiswa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbskul`
--
ALTER TABLE `tbskul`
  MODIFY `idskul` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbthpel`
--
ALTER TABLE `tbthpel`
  MODIFY `idthpel` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbakhirskul`
--
ALTER TABLE `tbakhirskul`
  ADD CONSTRAINT `tbakhirskul_ibfk_2` FOREIGN KEY (`idsiswa`) REFERENCES `tbsiswa` (`idsiswa`);

--
-- Constraints for table `tbkelas`
--
ALTER TABLE `tbkelas`
  ADD CONSTRAINT `tbkelas_ibfk_1` FOREIGN KEY (`idjenjang`) REFERENCES `tbjenjang` (`idjenjang`) ON UPDATE CASCADE;

--
-- Constraints for table `tbkkm`
--
ALTER TABLE `tbkkm`
  ADD CONSTRAINT `tbkkm_ibfk_1` FOREIGN KEY (`idkelas`) REFERENCES `tbkelas` (`idkelas`),
  ADD CONSTRAINT `tbkkm_ibfk_2` FOREIGN KEY (`idmapel`) REFERENCES `tbmapel` (`idmapel`),
  ADD CONSTRAINT `tbkkm_ibfk_3` FOREIGN KEY (`idthpel`) REFERENCES `tbthpel` (`idthpel`);

--
-- Constraints for table `tbkompetensi`
--
ALTER TABLE `tbkompetensi`
  ADD CONSTRAINT `tbkompetensi_ibfk_1` FOREIGN KEY (`idmapel`) REFERENCES `tbmapel` (`idmapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbkompetensi_ibfk_2` FOREIGN KEY (`idkelas`) REFERENCES `tbkelas` (`idkelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbmapel`
--
ALTER TABLE `tbmapel`
  ADD CONSTRAINT `tbmapel_ibfk_1` FOREIGN KEY (`idkur`) REFERENCES `tbkurikulum` (`idkur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbregistrasi`
--
ALTER TABLE `tbregistrasi`
  ADD CONSTRAINT `tbregistrasi_ibfk_1` FOREIGN KEY (`idkelas`) REFERENCES `tbkelas` (`idkelas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
