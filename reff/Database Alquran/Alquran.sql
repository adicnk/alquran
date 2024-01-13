-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.0.17-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for alquran
CREATE DATABASE IF NOT EXISTS `alquran` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `alquran`;

-- Dumping structure for table alquran.ayat
CREATE TABLE IF NOT EXISTS `ayat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surah_id` int(11) DEFAULT NULL,
  `ayat_index` int(11) DEFAULT NULL,
  `arabic` text,
  `latin` text,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table alquran.ayat: ~7 rows (approximately)
/*!40000 ALTER TABLE `ayat` DISABLE KEYS */;
INSERT INTO `ayat` (`id`, `surah_id`, `ayat_index`, `arabic`, `latin`, `count`) VALUES
	(1, 1, 1, 'بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ', 'bismillāhir-raḥmānir-raḥīm', NULL),
	(2, 1, 2, 'اَلْحَمْدُ لِلّٰهِ رَبِّ الْعٰلَمِيْنَۙ', 'al-ḥamdu lillāhi rabbil-ālamīn', NULL),
	(3, 1, 3, 'الرَّحْمٰنِ الرَّحِيْمِۙ', 'ar-raḥmānir-raḥīm', NULL),
	(4, 1, 4, 'مٰلِكِ يَوْمِ الدِّيْنِۗ', 'māliki yaumid-dīn', NULL),
	(5, 1, 5, 'اِيَّاكَ نَعْبُدُ وَاِيَّاكَ نَسْتَعِيْنُۗ', 'iyyāka nabudu wa iyyāka nastaīn', NULL),
	(6, 1, 6, 'اِهْدِنَا الصِّرَاطَ الْمُسْتَقِيْمَ ۙ', 'ihdinaṣ-ṣirāṭal-mustaqīm', NULL),
	(7, 1, 7, 'صِرَاطَ الَّذِيْنَ اَنْعَمْتَ عَلَيْهِمْ ەۙ غَيْرِ الْمَغْضُوْبِ عَلَيْهِمْ وَلَا الضَّاۤلِّيْنَ', 'ṣirāṭallażīna anamta alaihim gairil-magḍụbi alaihim wa laḍ-ḍāllīn', NULL);
/*!40000 ALTER TABLE `ayat` ENABLE KEYS */;

-- Dumping structure for table alquran.ayat_translate
CREATE TABLE IF NOT EXISTS `ayat_translate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surah_id` int(11) DEFAULT NULL,
  `tafsir_id` int(11) DEFAULT NULL,
  `ayat_index` int(11) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table alquran.ayat_translate: ~7 rows (approximately)
/*!40000 ALTER TABLE `ayat_translate` DISABLE KEYS */;
INSERT INTO `ayat_translate` (`id`, `surah_id`, `tafsir_id`, `ayat_index`, `content`) VALUES
	(1, 1, 1, 1, 'Dengan nama Allah Yang Maha Pengasih, Maha Penyayang.'),
	(2, 1, 1, 2, 'Segala puji bagi Allah, Tuhan seluruh alam,'),
	(3, 1, 1, 3, 'Yang Maha Pengasih, Maha Penyayang,'),
	(4, 1, 1, 4, 'Pemilik hari pembalasan.'),
	(5, 1, 1, 5, 'Hanya kepada Engkaulah kami menyembah dan hanya kepada Engkaulah kami mohon pertolongan.'),
	(6, 1, 1, 6, 'Tunjukilah kami jalan yang lurus,'),
	(7, 1, 1, 7, '(yaitu) jalan orang-orang yang telah Engkau beri nikmat kepadanya; bukan (jalan) mereka yang dimurkai, dan bukan (pula jalan) mereka yang sesat.');
/*!40000 ALTER TABLE `ayat_translate` ENABLE KEYS */;

-- Dumping structure for table alquran.language
CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table alquran.language: ~1 rows (approximately)
/*!40000 ALTER TABLE `language` DISABLE KEYS */;
INSERT INTO `language` (`id`, `name`) VALUES
	(1, 'Indonesia');
/*!40000 ALTER TABLE `language` ENABLE KEYS */;

-- Dumping structure for table alquran.surah
CREATE TABLE IF NOT EXISTS `surah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arabic` varchar(255) DEFAULT NULL,
  `latin` varchar(255) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;

-- Dumping data for table alquran.surah: ~114 rows (approximately)
/*!40000 ALTER TABLE `surah` DISABLE KEYS */;
INSERT INTO `surah` (`id`, `arabic`, `latin`, `count`) VALUES
	(1, '﻿لفاتحة', 'Al-Fatihah', 7),
	(2, 'البقرة', 'Al-Baqarah', NULL),
	(3, 'آل عمران', 'Ali Imran', NULL),
	(4, 'النّساء', 'An-Nisa\'', NULL),
	(5, 'المآئدة', 'Al-Ma\'idah', NULL),
	(6, 'الانعام', 'Al-An\'am', NULL),
	(7, 'الأعراف', 'Al-A\'raf', NULL),
	(8, 'الأنفال', 'Al-Anfal', NULL),
	(9, 'التوبة‎‎', 'At-Taubah', NULL),
	(10, 'ينوس', 'Yunus', NULL),
	(11, 'هود', 'Hud', NULL),
	(12, 'يسوف', 'Yusuf', NULL),
	(13, 'الرّعد', 'Ar-Ra\'d', NULL),
	(14, 'إبراهيم', 'Ibrahim', NULL),
	(15, 'الحجر', 'Al-Hijr', NULL),
	(16, 'النّحل', 'An-Nahl', NULL),
	(17, 'الإسرا', 'Al-Isra\'', NULL),
	(18, 'الكهف', 'Al-Kahf', NULL),
	(19, 'مريم', 'Maryam', NULL),
	(20, 'طه', 'Thaha', NULL),
	(21, 'الأنبياء', 'Al-Anbiya', NULL),
	(22, 'الحجّ', 'Al-Hajj (22)', NULL),
	(23, 'المؤمنون', 'Al-Mu\'minun (23)', NULL),
	(24, 'النّور', 'An-Nur (24)', NULL),
	(25, 'الفرقان', 'Al-Furqan (25)', NULL),
	(26, 'الشّعراء', 'Asy-Syu\'ara\' (26)', NULL),
	(27, 'النّمل', 'An-Naml (27)', NULL),
	(28, 'القصص', 'Al-Qasas (28) ', NULL),
	(29, 'العنكبوت', 'Al-\'Ankabut (29)', NULL),
	(30, 'الرّوم', 'Ar-Rum (30)', NULL),
	(31, 'لقمان', 'Luqman (31)', NULL),
	(32, 'السّجدة', 'As-Sajdah (32)', NULL),
	(33, 'الْأحزاب', 'Al-Ahzab (33)', NULL),
	(34, 'سبا', 'Saba (34)', NULL),
	(35, 'فاطر', 'Fatir (35)', NULL),
	(36, 'يس', 'Ya Sin (36)', NULL),
	(37, 'الصّافات', 'As-Saffat (37)', NULL),
	(38, 'ص', 'Sad (38)', NULL),
	(39, 'الزّمر', 'Az-Zumar (39)', NULL),
	(40, 'غافر', 'Gafir (40)', NULL),
	(41, 'فصّلت', 'Fussilat (41)', NULL),
	(42, 'الشّورى', 'Asy-Syura (42)', NULL),
	(43, 'الزّخرف', 'Az-Zukhruf (43)', NULL),
	(44, 'الدّخان', 'Ad-Dukhan (44)', NULL),
	(45, 'الجاثية', 'Al-Jasiyah (45)', NULL),
	(46, 'الَأحقاف', 'Al-Ahqaf (46)', NULL),
	(47, 'محمّد', 'Muhammad (47)', NULL),
	(48, 'الفتح', 'Al-Fath (48)', NULL),
	(49, 'الحجرات', 'Al-Hujurat (49)', NULL),
	(50, 'ق', 'Qaf (50)', NULL),
	(51, 'الذّاريات', 'Az-Zariyat (51)', NULL),
	(52, 'الطّور', 'At-Tur (52)', NULL),
	(53, 'النّجْم', 'An-Najm (53)', NULL),
	(54, 'القمر', 'Al-Qamar (54)', NULL),
	(55, 'الرّحْمن', 'Ar-Rahman (55)', NULL),
	(56, 'الواقعة', 'Al-Waqi\'ah (56)', NULL),
	(57, 'الحديد', 'Al-Hadid (57)', NULL),
	(58, 'المجادلة', 'Al-Mujadalah (58)', NULL),
	(59, 'الحشْر', 'Al-Hasyr (59)', NULL),
	(60, 'الممتحنة', 'Al-Mumtahanah (60)', NULL),
	(61, 'الصّفّ', 'As-Saff (61)', NULL),
	(62, 'الجمعة', 'Al-Jumu\'ah (62)', NULL),
	(63, 'المنافقون', 'Al-Munafiqun (63)', NULL),
	(64, 'التّغابن', 'At-Tagabun (64)', NULL),
	(65, 'الطّلاق', 'At-Talaq (65)', NULL),
	(66, 'التّحريم', 'At-Tahrim (66)', NULL),
	(67, 'الملك', 'Al-Mulk (67)', NULL),
	(68, 'القلم', 'Al-Qalam (68)', NULL),
	(69, 'الحآقّة', 'Al-Haqqah (69)', NULL),
	(70, 'المعارج', 'Al-Ma\'arij (70)', NULL),
	(71, 'نوح', 'Nuh (71)', NULL),
	(72, 'الجنّ', 'Al-Jinn (72)', NULL),
	(73, 'المزمّل', 'Al-Muzzammil (73)', NULL),
	(74, 'المدثر', 'Al-Muddatstsir (74)', NULL),
	(75, 'القيامة', 'Al-Qiyamah (75)', NULL),
	(76, 'الْاٍنسان', 'Al-Insan (76)', NULL),
	(77, 'المرسلات', 'Al-Mursalat (77)', NULL),
	(78, 'النباء', 'An-Naba (78)', NULL),
	(79, 'النّازعات', 'An-Nazi\'at (79)', NULL),
	(80, 'عبس', '\'Abasa (80)', NULL),
	(81, 'التّكوير', 'At-Takwir (81)', NULL),
	(82, 'الانفطار', 'Al-Infitar (82)', NULL),
	(83, 'المطفّفين', 'Al-Muthaffifin (83)', NULL),
	(84, 'الانشقاق', 'Al-Insyiqaq (84)', NULL),
	(85, 'البروج', 'Al-Buruj (85)', NULL),
	(86, 'الطّارق', 'At-Tariq (86)', NULL),
	(87, 'الْأعلى', 'Al-A\'la (87)', NULL),
	(88, 'الغاشية', 'Al-Gasyiyah (88)', NULL),
	(89, 'الفجر', 'Al-Fajr (89)', NULL),
	(90, 'البلد', 'Al-Balad (90)', NULL),
	(91, 'الشّمس', 'Asy-Syams (91)', NULL),
	(92, 'الّيل', 'Al-Lail (92)', NULL),
	(93, 'الضحى‎‎', 'Ad-Duha (93)', NULL),
	(94, 'الشرح', 'Asy-syarh (94)', NULL),
	(95, 'التِّينِ', 'At-Tin (95)', NULL),
	(96, 'العَلَق', 'Al-\'Alaq (96)', NULL),
	(97, 'الْقَدْرِ', 'Al-Qadr (97)', NULL),
	(98, 'الْبَيِّنَةُ', 'Al-Bayyinah (98)', NULL),
	(99, 'الزلزلة‎‎', 'Az-Zalzalah (99)', NULL),
	(100, 'العاديات‎‎', 'Al-\'Adiyat (100)', NULL),
	(101, 'القارعة‎‎', 'Al-Qari\'ah (101)', NULL),
	(102, 'التكاثر‎‎', 'At-Takasur (102)', NULL),
	(103, 'العصر', 'Al-\'Asr (103)', NULL),
	(104, 'الهُمَزة‎‎', 'Al-Humazah (104)', NULL),
	(105, 'الْفِيلِ', 'Al-Fil (105)', NULL),
	(106, 'قُرَيْشٍ', 'Quraisy (106)', NULL),
	(107, 'الْمَاعُونَ', 'Al-Ma\'un (107)', NULL),
	(108, 'الكوثر', 'Al-Kausar (108)', NULL),
	(109, 'الْكَافِرُونَ', 'Al-Kafirun (109)', NULL),
	(110, 'النصر‎‎', 'An-Nasr (110)', NULL),
	(111, 'الّلهب', 'Al-Lahab (111)', NULL),
	(112, 'الإخلاص‎‎', 'Al-Ikhlas (112)', NULL),
	(113, 'الْفَلَقِ', 'Al-Falaq (113)', NULL),
	(114, 'النَّاسِ', 'An-Nas (114)', NULL);
/*!40000 ALTER TABLE `surah` ENABLE KEYS */;

-- Dumping structure for table alquran.surah_translate
CREATE TABLE IF NOT EXISTS `surah_translate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;

-- Dumping data for table alquran.surah_translate: ~114 rows (approximately)
/*!40000 ALTER TABLE `surah_translate` DISABLE KEYS */;
INSERT INTO `surah_translate` (`id`, `language_id`, `content`) VALUES
	(1, 1, 'Pembukaan'),
	(2, 1, 'Sapi'),
	(3, 1, 'Keluarga \'Imran'),
	(4, 1, 'Wanita'),
	(5, 1, 'Jamuan (hidangan makanan)'),
	(6, 1, 'Hewan Ternak'),
	(7, 1, 'Tempat yang tertinggi'),
	(8, 1, 'Harta rampasan perang'),
	(9, 1, 'Pengampunan'),
	(10, 1, 'Nabi Yunus'),
	(11, 1, 'Nabi Hud'),
	(12, 1, 'Nabi Yusuf'),
	(13, 1, 'Guruh (petir)'),
	(14, 1, 'Nabi Ibrahim'),
	(15, 1, 'Gunung Al Hijr'),
	(16, 1, 'Lebah'),
	(17, 1, 'Perjalanan Malam'),
	(18, 1, 'Penghuni-penghuni Gua'),
	(19, 1, 'Maryam (Maria)'),
	(20, 1, 'Ta Ha'),
	(21, 1, 'Nabi-Nabi'),
	(22, 1, 'Haji'),
	(23, 1, 'Orang-orang mukmin'),
	(24, 1, 'Cahaya'),
	(25, 1, 'Pembeda'),
	(26, 1, 'Penyair'),
	(27, 1, 'Semut'),
	(28, 1, 'Kisah'),
	(29, 1, 'Laba-laba'),
	(30, 1, 'Bangsa Romawi'),
	(31, 1, 'Keluarga Luqman'),
	(32, 1, 'Sajdah'),
	(33, 1, 'Golongan-Golongan yang bersekutu'),
	(34, 1, 'Kaum Saba\''),
	(35, 1, 'Pencipta'),
	(36, 1, 'Yaasiin'),
	(37, 1, 'Barisan-barisan'),
	(38, 1, 'Shaad'),
	(39, 1, 'Rombongan-rombongan'),
	(40, 1, 'Maha Pengampun'),
	(41, 1, 'Yang dijelaskan'),
	(42, 1, 'Musyawarah'),
	(43, 1, 'Perhiasan'),
	(44, 1, 'Kabut'),
	(45, 1, 'Yang bertekuk lutut'),
	(46, 1, 'Bukit-bukit pasir'),
	(47, 1, 'Nabi Muhammad'),
	(48, 1, 'Kemenangan'),
	(49, 1, 'Kamar-kamar'),
	(50, 1, 'Qaaf'),
	(51, 1, 'Angin yang menerbangkan'),
	(52, 1, 'Bukit'),
	(53, 1, 'Bintang'),
	(54, 1, 'Bulan'),
	(55, 1, 'Yang Maha Pemurah'),
	(56, 1, 'Hari Kiamat'),
	(57, 1, 'Besi'),
	(58, 1, 'Wanita yang mengajukan gugatan'),
	(59, 1, 'Pengusiran'),
	(60, 1, 'Wanita yang diuji'),
	(61, 1, 'Satu barisan'),
	(62, 1, 'Hari Jum’at'),
	(63, 1, 'Orang-orang yang munafik'),
	(64, 1, 'Hari dinampakkan kesalahan-kesalahan'),
	(65, 1, 'Talak'),
	(66, 1, 'Mengharamkan'),
	(67, 1, 'Kerajaan'),
	(68, 1, 'Pena'),
	(69, 1, 'Hari kiamat'),
	(70, 1, 'Tempat naik'),
	(71, 1, 'Nabi Nuh'),
	(72, 1, 'Jin'),
	(73, 1, 'Orang yang berselimut'),
	(74, 1, 'Orang yang berkemul'),
	(75, 1, 'Kiamat'),
	(76, 1, 'Manusia'),
	(77, 1, 'Malaikat-Malaikat Yang Diutus'),
	(78, 1, 'Berita besar'),
	(79, 1, 'Malaikat-Malaikat Yang Mencabut'),
	(80, 1, 'Ia Bermuka masam'),
	(81, 1, 'Menggulung'),
	(82, 1, 'Terbelah'),
	(83, 1, 'Orang-orang yang curang'),
	(84, 1, 'Terbelah'),
	(85, 1, 'Gugusan bintang'),
	(86, 1, 'Yang datang di malam hari'),
	(87, 1, 'Yang paling tinggi'),
	(88, 1, 'Hari Pembalasan'),
	(89, 1, 'Fajar'),
	(90, 1, 'Negeri'),
	(91, 1, 'Matahari'),
	(92, 1, 'Malam'),
	(93, 1, 'Waktu matahari sepenggalahan naik (Dhuha)'),
	(94, 1, 'Melapangkan'),
	(95, 1, 'Buah Tin'),
	(96, 1, 'Segumpal Darah'),
	(97, 1, 'Kemuliaan'),
	(98, 1, 'Pembuktian'),
	(99, 1, 'Kegoncangan'),
	(100, 1, 'Berlari kencang'),
	(101, 1, 'Hari Kiamat'),
	(102, 1, 'Bermegah-megahan'),
	(103, 1, 'Masa/Waktu'),
	(104, 1, 'Pengumpat'),
	(105, 1, 'Gajah'),
	(106, 1, 'Suku Quraisy'),
	(107, 1, 'Barang-barang yang berguna'),
	(108, 1, 'Nikmat yang berlimpah'),
	(109, 1, 'Orang-orang kafir'),
	(110, 1, 'Pertolongan'),
	(111, 1, 'Gejolak Api/ Sabut'),
	(112, 1, 'Ikhlas'),
	(113, 1, 'Waktu Subuh'),
	(114, 1, 'Umat Manusia');
/*!40000 ALTER TABLE `surah_translate` ENABLE KEYS */;

-- Dumping structure for table alquran.tafsir
CREATE TABLE IF NOT EXISTS `tafsir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table alquran.tafsir: ~1 rows (approximately)
/*!40000 ALTER TABLE `tafsir` DISABLE KEYS */;
INSERT INTO `tafsir` (`id`, `name`) VALUES
	(1, 'Departemen Agama RI');
/*!40000 ALTER TABLE `tafsir` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
