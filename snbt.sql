/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP DATABASE IF EXISTS `snbt`;
CREATE DATABASE IF NOT EXISTS `snbt` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `snbt`;

DROP PROCEDURE IF EXISTS `colVal`;
DELIMITER //
CREATE PROCEDURE `colVal`(
	IN `rep` INT,
	IN `val` INT
)
BEGIN
SET @X=1;
repeat
UPDATE `snbt`.`soal` SET `is_tp`= val WHERE  `idx`= @x;
SET @X = @X +1;
until @X > rep
END repeat;
END//
DELIMITER ;

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total_soal` int(11) DEFAULT NULL,
  `total_soal_demo` int(11) DEFAULT NULL,
  `total_soal_bronze` int(11) DEFAULT NULL,
  `total_soal_silver` int(11) DEFAULT NULL,
  `total_soal_diamond` int(11) DEFAULT NULL,
  `total_soal_premium` int(11) DEFAULT NULL,
  `nilai_min` int(11) DEFAULT NULL,
  `tingkat_kesulitan` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `config` (`id`, `total_soal`, `total_soal_demo`, `total_soal_bronze`, `total_soal_silver`, `total_soal_diamond`, `total_soal_premium`, `nilai_min`, `tingkat_kesulitan`, `created_at`, `updated_at`) VALUES
	(1, 41, 25, 10, 15, 20, 25, 60, NULL, '2022-04-14 08:20:48', '2023-07-17 08:50:05');

DROP TABLE IF EXISTS `jawaban`;
CREATE TABLE IF NOT EXISTS `jawaban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `soal_id` int(11) DEFAULT NULL,
  `jawabanA` text DEFAULT NULL,
  `jawabanB` text DEFAULT NULL,
  `jawabanC` text DEFAULT NULL,
  `jawabanD` text DEFAULT NULL,
  `jawabanE` text DEFAULT NULL,
  `jawaban_benar` int(11) DEFAULT NULL,
  `pilihan` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4;

INSERT INTO `jawaban` (`id`, `soal_id`, `jawabanA`, `jawabanB`, `jawabanC`, `jawabanD`, `jawabanE`, `jawaban_benar`, `pilihan`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2023-06-30 13:40:30', '2023-07-07 11:57:39'),
	(2, 2, NULL, NULL, NULL, NULL, NULL, 4, NULL, '2023-06-30 13:59:32', '2023-07-07 11:57:55'),
	(3, 3, '8', '16', '18', '25', '35', 3, NULL, '2023-07-01 04:34:20', '2023-07-07 11:58:12'),
	(4, 4, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-01 04:35:26', '2023-07-07 11:59:27'),
	(10, 7, '15°', '30°', '45°', '60°', '75°', 2, NULL, '2023-07-07 13:16:06', '2023-07-07 17:12:31'),
	(11, 10, NULL, NULL, NULL, NULL, NULL, 5, NULL, '2023-07-07 13:20:56', '2023-07-08 05:28:55'),
	(12, 11, '1 : 1', '1 : 2', '1 : 3', '2 : 3', '1 : 4', 2, NULL, '2023-07-07 13:24:12', '2023-07-07 14:16:22'),
	(13, 12, 'Gambar A', 'Gambar B', 'Gambar C', 'Gambar D', 'Gambar E', 4, NULL, '2023-07-07 17:25:11', '2023-07-07 17:26:28'),
	(14, 13, 'Gambar A', 'Gambar B', 'Gambar C', 'Gambar D', 'Gambar E', 2, NULL, '2023-07-07 17:31:28', '2023-07-07 17:31:28'),
	(15, 14, '3 jam 25 menit', '4 jam', '6 jam', '6 jam 25 menit', '6 jam 30 menit', 5, NULL, '2023-07-07 17:36:41', '2023-07-07 17:36:41'),
	(16, 15, '4', '8', '12', '16', '20', 4, NULL, '2023-07-07 17:40:23', '2023-07-07 17:40:23'),
	(17, 16, ' (1). (2), dan (3) SAJA yang benar.', ' (1) dan (3) SAJA yang benar.', ' (2) dan (4) SAJA yang benar.', ' HANYA (4) yang benar.', 'SEMUA pilihan benar.', 1, NULL, '2023-07-07 17:48:05', '2023-07-07 17:56:09'),
	(18, 17, 'P > Q', 'Q > P', 'P = Q', 'Informasi yang diberikan tidak cukup memutuskan salah satu dari 3 pilihan di atas.', 'Tidak tahu', 4, NULL, '2023-07-07 18:08:21', '2023-07-07 18:31:53'),
	(19, 18, 'P > Q', 'Q > P', 'P = Q', 'Informasi yang diberikan tidak cukup untuk memutuskan salah satu dari tiga pilihan diatas', 'Tidak tahu', 1, NULL, '2023-07-07 18:18:30', '2023-07-07 18:32:27'),
	(20, 19, 'P > Q', 'Q > P', 'P = Q', 'Informasi yang dberikan tidak cukup untuk memutuskan salah satu dari tiga pilihan di atas.', 'Tidak Tahu', 2, NULL, '2023-07-08 06:05:59', '2023-07-08 06:05:59'),
	(21, 20, 'pernyataan (I) SAJA cukup untuk menjawab pertanyaan, tetapi pernyataan (2) SAJA tidak\r\ncukup.', 'pernyataan (2) SAJA cukup untuk menjawab pertanyaan, tetapi pernyataan (I) SAJA tidak сukuр.', 'pernyataan (I) SAJA cukup untuk menjawab pertanyaan dan pernyataan (2) SAJA cukup.', 'pernyataan (1) dan pernyataan (2) tidak cukup untuk menjawab pertanyaan.', 'Tidak tahu', 1, NULL, '2023-07-08 06:23:14', '2023-07-08 06:23:14'),
	(22, 21, '57', '54', '38', '21', '19', 1, NULL, '2023-07-08 06:28:13', '2023-07-08 06:28:13'),
	(23, 22, '1 dan 80', '1 dan 81', '2 dan 81', '3 dan 156', '4 dan 156', 2, NULL, '2023-07-08 06:33:10', '2023-07-08 06:33:10'),
	(24, 23, '40', '42', '44', '50', '55', 4, NULL, '2023-07-08 06:40:55', '2023-07-08 06:40:55'),
	(25, 24, '7 cm²', '10 cm²', '12 cm²', '14 cm²', '20 cm²', 4, NULL, '2023-07-08 06:49:05', '2023-07-08 06:49:05'),
	(26, 25, NULL, '7', '10', '13', '26', 1, NULL, '2023-07-08 06:54:49', '2023-07-08 06:55:43'),
	(27, 26, 'a = b', 'a = 2b', 'a = b + 10°', 'a + b = 90°', 'a + b = 180°', 2, NULL, '2023-07-08 07:05:54', '2023-07-08 07:05:54'),
	(28, 27, NULL, NULL, NULL, NULL, NULL, 3, NULL, '2023-07-08 07:08:55', '2023-07-08 07:08:55'),
	(29, 28, '2', '3', '4', '5', '6', 2, NULL, '2023-07-08 09:16:42', '2023-07-08 09:16:42'),
	(30, 29, '(1), (2) dan (3)', '(1) dan (2)', '(2) dan (3)', '(2) saja', '(3) saja', 2, NULL, '2023-07-08 13:49:22', '2023-07-08 13:49:22'),
	(31, 30, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-16 20:11:42', '2023-07-16 20:11:42'),
	(32, 31, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-16 20:17:58', '2023-07-16 20:17:58'),
	(33, 32, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-16 20:19:43', '2023-07-16 20:19:43'),
	(34, 33, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-16 20:22:24', '2023-07-16 20:22:24'),
	(35, 34, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-16 20:23:22', '2023-07-16 20:23:22'),
	(36, 35, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-16 20:25:31', '2023-07-16 20:25:31'),
	(37, 36, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-16 20:26:16', '2023-07-16 20:26:16'),
	(38, 37, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-16 20:30:23', '2023-07-16 20:30:23'),
	(39, 38, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-16 20:37:48', '2023-07-16 20:37:48'),
	(40, 39, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-16 20:48:36', '2023-07-16 20:48:36'),
	(41, 40, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-16 20:50:34', '2023-07-16 20:50:34'),
	(42, 41, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-16 21:01:26', '2023-07-16 21:01:26'),
	(43, 42, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-16 21:03:01', '2023-07-16 21:03:01'),
	(44, 43, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-16 21:03:41', '2023-07-16 21:03:41'),
	(45, 44, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-16 21:04:24', '2023-07-16 21:04:24'),
	(46, 45, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 05:20:01', '2023-07-17 05:20:01'),
	(47, 46, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 05:21:40', '2023-07-17 05:21:40'),
	(48, 47, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 05:21:50', '2023-07-17 05:21:50'),
	(49, 48, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 05:23:20', '2023-07-17 05:23:20'),
	(50, 49, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 05:26:10', '2023-07-17 05:26:10'),
	(51, 50, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 05:34:02', '2023-07-17 05:34:02'),
	(52, 51, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 05:39:01', '2023-07-17 05:39:01'),
	(53, 52, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 05:51:52', '2023-07-17 05:51:52'),
	(54, 53, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 06:01:57', '2023-07-17 06:01:57'),
	(55, 54, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 06:05:26', '2023-07-17 06:05:26'),
	(56, 55, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 06:07:02', '2023-07-17 06:07:02'),
	(57, 56, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 06:29:46', '2023-07-17 06:29:46'),
	(58, 57, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 06:31:39', '2023-07-17 06:31:39'),
	(59, 58, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 06:35:15', '2023-07-17 06:35:15'),
	(60, 59, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 06:39:33', '2023-07-17 06:39:33'),
	(61, 60, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 06:59:30', '2023-07-17 06:59:30'),
	(62, 61, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 07:07:45', '2023-07-17 07:07:45'),
	(63, 62, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 07:12:49', '2023-07-17 07:12:49'),
	(64, 63, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 07:15:10', '2023-07-17 07:15:10'),
	(65, 64, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 07:16:46', '2023-07-17 07:16:46'),
	(66, 65, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 07:17:45', '2023-07-17 07:17:45'),
	(67, 66, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 07:22:01', '2023-07-17 07:22:01'),
	(68, 67, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 07:22:02', '2023-07-17 07:22:02'),
	(69, 68, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 07:22:36', '2023-07-17 07:22:36'),
	(70, 69, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 08:35:57', '2023-07-17 08:35:57'),
	(71, 70, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 08:36:23', '2023-07-17 08:36:23'),
	(72, 71, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 08:40:12', '2023-07-17 08:40:12'),
	(73, 72, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 08:40:24', '2023-07-17 08:40:24'),
	(74, 73, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 08:41:15', '2023-07-17 08:41:15'),
	(75, 74, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 08:43:18', '2023-07-17 08:43:18'),
	(76, 75, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 08:49:15', '2023-07-17 08:49:15'),
	(77, 76, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-07-17 08:50:05', '2023-07-17 08:50:05');

DROP TABLE IF EXISTS `jurusan`;
CREATE TABLE IF NOT EXISTS `jurusan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jname` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO `jurusan` (`id`, `jname`, `created_at`, `updated_at`) VALUES
	(1, 'IPA', '2022-04-04 23:42:35', '2022-04-04 23:42:37'),
	(2, 'IPS', '2022-04-04 23:43:05', '2022-04-04 23:43:06');

DROP TABLE IF EXISTS `kategori_soal`;
CREATE TABLE IF NOT EXISTS `kategori_soal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kname` varchar(100) DEFAULT NULL,
  `jumlah_soal` int(11) DEFAULT NULL,
  `is_tp` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO `kategori_soal` (`id`, `kname`, `jumlah_soal`, `is_tp`, `created_at`, `updated_at`) VALUES
	(1, 'Pengetahuan Kuantitatif', 41, 1, '2023-06-28 14:50:17', '2023-07-17 08:50:05'),
	(2, 'Tes Kemampuan & Potensi Akaddemik', 0, NULL, '2023-07-13 15:38:52', '2023-07-17 08:50:05');

DROP TABLE IF EXISTS `latihan`;
CREATE TABLE IF NOT EXISTS `latihan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `benar` int(11) DEFAULT NULL,
  `salah` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `latihan` (`id`, `user_id`, `date`, `benar`, `salah`, `score`, `created_at`, `updated_at`) VALUES
	(1, 2, '2023-07-29 14:15:43', 0, 5, 0, '2023-07-29 14:15:43', '2023-07-29 14:15:44');

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `is_start` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO `login` (`id`, `role_id`, `user_id`, `username`, `password`, `is_active`, `is_start`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'admin', 'admin', 1, NULL, '2022-05-30 06:45:36', '2022-05-30 06:45:36'),
	(2, 2, 3, 'bronze', 'bronze', 1, NULL, '2023-06-16 05:58:25', '2023-06-16 06:02:55'),
	(3, 2, 4, 'silver', 'silver', 1, NULL, '2023-06-16 05:59:16', '2023-06-16 06:03:23'),
	(4, 2, 7, 'premium', 'premium', 1, NULL, '2023-06-16 06:50:17', '2023-06-29 07:19:25');

DROP TABLE IF EXISTS `modul_soal`;
CREATE TABLE IF NOT EXISTS `modul_soal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mname` varchar(100) DEFAULT NULL,
  `jumlah_soal` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

INSERT INTO `modul_soal` (`id`, `mname`, `jumlah_soal`, `created_at`, `updated_at`) VALUES
	(1, 'Sinonim', NULL, '2023-06-27 19:36:51', '2023-06-27 19:36:54'),
	(2, 'Antonim', NULL, '2023-06-27 19:37:46', '2023-06-27 19:37:50'),
	(3, 'Analogi', NULL, '2023-06-27 19:38:23', '2023-06-27 19:38:25'),
	(4, 'Logika Deduksi', NULL, '2023-06-27 19:39:04', '2023-06-27 19:39:07'),
	(5, 'Logika Analisis', NULL, '2023-06-27 19:41:33', '2023-06-27 19:41:39'),
	(6, 'Pernyataan Sebab Akibat', NULL, '2023-06-27 19:41:42', '2023-06-27 19:41:44');

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO `role` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', '2022-04-14 08:19:35', '2022-04-14 08:19:36'),
	(2, 'Member', '2022-04-14 08:19:38', '2022-04-14 08:19:39');

DROP TABLE IF EXISTS `soal`;
CREATE TABLE IF NOT EXISTS `soal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idx` int(11) DEFAULT NULL,
  `kategori_soal_id` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `is_picture` tinyint(1) DEFAULT NULL,
  `picture_url` varchar(100) DEFAULT NULL,
  `is_audio` tinyint(1) DEFAULT NULL,
  `audio_url` varchar(100) DEFAULT NULL,
  `is_choosen` tinyint(1) DEFAULT NULL,
  `is_tp` tinyint(1) DEFAULT NULL COMMENT 'tanpa pembahasan',
  `is_dp` tinyint(1) DEFAULT NULL COMMENT 'dengan pembahasan',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4;

INSERT INTO `soal` (`id`, `idx`, `kategori_soal_id`, `name`, `is_picture`, `picture_url`, `is_audio`, `audio_url`, `is_choosen`, `is_tp`, `is_dp`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '', 1, '1.png', NULL, NULL, 1, 1, NULL, '2023-06-30 13:40:30', '2023-07-07 11:57:39'),
	(2, 2, 1, '', 1, '2.png', NULL, NULL, 1, 1, NULL, '2023-06-30 13:59:32', '2023-07-07 11:57:55'),
	(3, 3, 1, 'Angka di tengah lingkaran M diperoleh dari pola aritmatika angka-angka di sekelilingnya. Jika pola aritmetika pada bangun M dan N sama, maka nilai z adalah:', 1, '3.png', NULL, NULL, 1, 1, NULL, '2023-07-01 04:34:20', '2023-07-07 11:58:12'),
	(4, 4, 1, '', 1, '4.png', NULL, NULL, 1, 1, NULL, '2023-07-01 04:35:26', '2023-07-07 11:59:27'),
	(7, 5, 1, 'Titik P adalah pusat lingkaran dan panjang\r\nAC = 2AB. Besar sudut PBC adalah:', 1, '7.png', NULL, NULL, 1, 1, NULL, '2023-07-03 09:47:24', '2023-07-07 17:12:31'),
	(10, 6, 1, '', 1, '5.png', NULL, NULL, 1, 1, NULL, '2023-07-07 13:20:56', '2023-07-08 05:28:55'),
	(11, 7, 1, 'Jika AB - 2BC, maka perbandingan luas daerah yang diarsir dan tidak diarsir adalah', 1, '6.png', NULL, NULL, 1, 1, NULL, '2023-07-07 13:24:12', '2023-07-07 14:16:22'),
	(12, 8, 1, 'Manakah di antara garis berikut yang bukan\r\nmerupakan fungsi y = I(x)?', 1, '8.png', NULL, NULL, 1, 1, NULL, '2023-07-07 17:25:10', '2023-07-07 17:26:28'),
	(13, 9, 1, 'Diketahui sistem pertidaksamaan sebagai berikut:\r\ny>x +2\r\n2x + 3y < 6\r\nDaerah yang merupakan penyelesaian sistem pertidaksamaan tersebut adalah:', 1, '9.png', NULL, NULL, 1, 1, NULL, '2023-07-07 17:31:28', '2023-07-07 17:31:28'),
	(14, 10, 1, 'Ayah dapat menyelesaikan suatu pekerjaan dalam waktu 8 jam, sedangkan paman dapat menyelesaikan pekerjaan yang sama dalam waktu 6 jam. Awalnya pekerjaan tersebut dikerjakan oleh ayah, dan selesai ¼ bagian saja. Jika sisa pekerjaan dilimpahkan ke paman, maka waktu total yang dibutuhkan untuk menyelesaikan pekerjaan tersebut adalah', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-07 17:36:41', '2023-07-07 17:36:41'),
	(15, 11, 1, 'Perbandingan banyaknya harimau dan orang utan di sebuah kebun binatang adalah 3 : 5. Karena 4 ekor orang utan mati, maka perbandingan harimau dan orang utan berubah menjadi 3 : 4. Banyaknya orang utan sekarang adalah', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-07 17:40:23', '2023-07-07 17:40:23'),
	(16, 12, 1, 'Diketahui × adalah bilangan ganjil positif dan y adalah bilangan genap positif\r\n(1) (x + 2) (y + 1)\r\n(2) x + 2y\r\n(3) 3(x+y)\r\n(4) 7xy\r\nManakah di antara pilihan tersebut yang merupakan bilangan ganjil?', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-07 17:48:05', '2023-07-07 17:56:09'),
	(17, 13, 1, 'Diketahui x +  y < z, manakah hubungan yang benar antara P dan Q berikut berdasarkan informasi yang diberikan?', 1, '10.png', NULL, NULL, 1, 1, NULL, '2023-07-07 18:08:21', '2023-07-07 18:31:53'),
	(18, 14, 1, 'Sebuah barang seharga Rp500.000,00 akan mendapakan diskon 20% jika dibeli di toko A. Sedangkan toko B menawarkan diskon 10%, dengan tambahan diskon 10%. Seorang pembeli akan membeli barang dari salah satu toko tersebut.\r\n\r\nManakah hubungan yang benar antara kuantitas P dan Q berkut berdasarkan informasi yang diberikan?\r\n', 1, '11.png', NULL, NULL, 1, 1, NULL, '2023-07-07 18:18:30', '2023-07-07 18:32:27'),
	(19, 15, 1, 'Ibu membeli mie instan dengan harga eceran Rp3.000,00 per buah. Tapi jika ibu membeli satu dus yang terdiri dari 40 buah, maka harganya adalah Rp100.000.00.\r\nManakah hubungan yang benar antara kuantitas P dan Q berikut berdasarkan Informasi yang diberikan?', 1, '12.png', NULL, NULL, 1, 1, NULL, '2023-07-08 06:05:59', '2023-07-08 06:05:59'),
	(20, 16, 1, 'Nilai dari a° + b° adalah ? Putuskan apakah pernyataan (I) dan (2) berikut\r\ncukup untuk menjawab pertanyaan tersebut\r\n(1) d° + h° = c° + f°\r\n(2) e° + h° = d° + g°', 1, '13.png', NULL, NULL, 1, 1, NULL, '2023-07-08 06:23:14', '2023-07-08 06:23:14'),
	(21, 17, 1, 'y, 19, 16, 8, 5, 5, 8\r\nNilai y adalah', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-08 06:28:13', '2023-07-08 06:28:13'),
	(22, 18, 1, 'x. 5, 6, 24, 26, 78, y\r\nNilai x dan y berturut-turut adalah', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-08 06:33:10', '2023-07-08 06:33:10'),
	(23, 19, 1, 'Angka di tengah segitiga P dibentuk dari bilangan-bilangan yang berada di tiap sudut dengan menggunakan pola aritmetik. Jika pola aritmetik pada bangun P dan Q identik, maka nilai y adalah', 1, '14.png', NULL, NULL, 1, 1, NULL, '2023-07-08 06:40:55', '2023-07-08 06:40:55'),
	(24, 20, 1, 'Bangun PQRS adalah sebuah persegi panjang dengan luas 24 cm². Jika Panjang PT = QU = RU, maka Luas bangun STQU adalah', 1, '15.png', NULL, NULL, 1, 1, NULL, '2023-07-08 06:49:04', '2023-07-08 06:49:04'),
	(25, 21, 1, 'Nilai z adalah', 1, '16.png', NULL, NULL, 1, 1, NULL, '2023-07-08 06:54:49', '2023-07-08 06:55:42'),
	(26, 22, 1, 'Hubungan yang tepat antara a dan b adalah', 1, '17.png', NULL, NULL, 1, 1, NULL, '2023-07-08 07:05:54', '2023-07-08 07:05:54'),
	(27, 23, 1, '', 1, '18.png', NULL, NULL, 1, 1, NULL, '2023-07-08 07:08:55', '2023-07-08 07:08:55'),
	(28, 24, 1, 'Untuk setiap x bilangan positif, Operas ȹx didefinisikan sebagai x(x-1). Nilai m yang memenuhi ȹ(ȹm) = 30 adalah', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-08 09:16:41', '2023-07-08 09:16:41'),
	(29, 25, 1, 'Manakah di antara tabel ini yang merupakan y fungsi x?', 1, '19.png', NULL, NULL, 1, 1, NULL, '2023-07-08 13:49:22', '2023-07-08 13:49:22'),
	(61, 26, 1, '', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-17 07:07:45', '2023-07-17 07:07:45'),
	(62, 27, 1, '', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-17 07:12:49', '2023-07-17 07:12:49'),
	(63, 28, 1, '', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-17 07:15:10', '2023-07-17 07:15:10'),
	(64, 29, 1, '', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-17 07:16:46', '2023-07-17 07:16:46'),
	(65, 30, 1, '', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-17 07:17:45', '2023-07-17 07:17:45'),
	(66, 31, 1, '', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-17 07:22:01', '2023-07-17 07:22:01'),
	(67, 32, 1, '', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-17 07:22:01', '2023-07-17 07:22:01'),
	(68, 1, 2, '', NULL, NULL, NULL, NULL, 1, NULL, 1, '2023-07-17 07:22:36', '2023-07-17 07:22:36'),
	(69, 2, 2, '', NULL, NULL, NULL, NULL, 1, NULL, 1, '2023-07-17 08:35:56', '2023-07-17 08:35:56'),
	(70, 3, 2, '', NULL, NULL, NULL, NULL, 1, NULL, 1, '2023-07-17 08:36:23', '2023-07-17 08:36:23'),
	(71, 4, 2, '', NULL, NULL, NULL, NULL, 1, NULL, 1, '2023-07-17 08:40:12', '2023-07-17 08:40:12'),
	(72, 33, 1, '', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-17 08:40:24', '2023-07-17 08:40:24'),
	(73, 5, 2, '', NULL, NULL, NULL, NULL, 1, NULL, 1, '2023-07-17 08:41:14', '2023-07-17 08:41:14'),
	(74, 34, 1, '', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-17 08:43:18', '2023-07-17 08:43:18'),
	(75, 35, 1, '', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-17 08:49:15', '2023-07-17 08:49:15'),
	(76, 36, 1, '', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-17 08:50:05', '2023-07-17 08:50:05');

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sname` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO `status` (`id`, `sname`, `created_at`, `updated_at`) VALUES
	(1, 'Mahasiswa', '2022-04-08 17:10:59', '2022-04-08 17:11:01'),
	(2, 'Staff', '2022-04-08 17:11:14', '2022-04-08 17:11:16');

DROP TABLE IF EXISTS `subcribe`;
CREATE TABLE IF NOT EXISTS `subcribe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO `subcribe` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Demo', 'demo', '2023-07-18 16:29:32', '2023-07-18 16:29:40'),
	(2, 'Bronze', 'bronze', '2023-07-18 16:30:08', '2023-07-18 16:30:10'),
	(3, 'Silver', 'silver', '2023-07-18 16:30:33', '2023-07-18 16:30:36'),
	(4, 'Diamond', 'diamond', '2023-07-18 16:31:04', '2023-07-18 16:31:31'),
	(5, 'Premium', 'premium', '2023-07-18 16:31:27', '2023-07-18 16:31:29');

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idx` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `jurusan_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `paket` varchar(50) DEFAULT NULL,
  `asal` varchar(50) DEFAULT NULL,
  `pilihan` varchar(50) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `hp` varchar(25) DEFAULT NULL,
  `tujuan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`id`, `idx`, `role_id`, `status_id`, `jurusan_id`, `name`, `slug`, `email`, `nim`, `nip`, `username`, `password`, `created_at`, `updated_at`, `paket`, `asal`, `pilihan`, `jurusan`, `alamat`, `hp`, `tujuan`) VALUES
	(1, 1, 1, 2, NULL, 'Administrator', 'administrator', '', NULL, '', NULL, NULL, '2022-05-30 06:45:36', '2022-05-30 06:45:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 2, 2, 1, 1, 'Demo', 'demo', '', '', '', 'demo', 'demo', '2022-05-30 06:47:26', '2023-06-16 05:56:17', 'demo', NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 3, 2, 1, 1, 'Bronze', 'bronze', '', '', '', 'bronze', 'bronze', '2023-06-16 05:58:25', '2023-06-16 06:02:55', 'bronze', NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 4, 2, 1, 1, 'Silver', 'silver', '', '', '', 'silver', 'silver', '2023-06-16 05:59:16', '2023-06-16 06:03:23', 'silver', NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 6, 2, 1, 1, 'Gold', 'gold', '', '', NULL, 'gold', 'gold', '2023-06-16 06:00:11', '2023-06-16 06:00:11', 'gold', NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 7, 2, 1, 1, 'Premium', 'premium', NULL, NULL, NULL, 'premium', 'premium', '2023-06-28 04:37:55', '2023-06-28 04:37:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

DROP TABLE IF EXISTS `user_subcribe`;
CREATE TABLE IF NOT EXISTS `user_subcribe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `subcribe_id` int(11) DEFAULT NULL,
  `kategori_soal_id` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO `user_subcribe` (`id`, `user_id`, `subcribe_id`, `kategori_soal_id`, `total`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 1, 5, '2023-07-18 16:35:31', '2023-07-18 16:35:34'),
	(2, 0, 1, 2, 5, '2023-07-18 17:12:08', '2023-07-18 17:12:10');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
