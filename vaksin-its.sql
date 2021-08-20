/*
 Navicat Premium Data Transfer

 Source Server         : local-mysql
 Source Server Type    : MySQL
 Source Server Version : 100413
 Source Host           : localhost:3306
 Source Schema         : vaksin-its

 Target Server Type    : MySQL
 Target Server Version : 100413
 File Encoding         : 65001

 Date: 20/08/2021 15:08:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_aktif` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES (1, 'superadmin', '$2y$10$0cWHu9M4qPU/emcLC0/kI.TOWDIkSEwCeGRWlWwbOFi.zNkD3VUSC', 'superadmin', 1, '2021-08-20 14:20:33', NULL, NULL, 'Riski Yuanda', '2021-15-3196');

-- ----------------------------
-- Table structure for t_kipi
-- ----------------------------
DROP TABLE IF EXISTS `t_kipi`;
CREATE TABLE `t_kipi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pendaftaran` int(11) NULL DEFAULT NULL,
  `id_vaksinasi` int(11) NULL DEFAULT NULL,
  `tanggal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `gejala` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tindakan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_hub_dokter` int(1) NULL DEFAULT 0,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_kipi
-- ----------------------------
INSERT INTO `t_kipi` VALUES (1, 1, 3, '2021-08-20', 'Batuk', 'Operasi Tenggorokan', 1, '2021-08-20 13:27:08', '2021-08-20 14:03:40', '2021-08-20 14:03:40');
INSERT INTO `t_kipi` VALUES (2, 3, 3, '2021-08-21', 'Kepala Pening', 'Sarapan', 0, '2021-08-20 13:43:51', '2021-08-20 14:03:33', '2021-08-20 14:03:33');
INSERT INTO `t_kipi` VALUES (3, 1, 3, '2021-08-20', 'Pusing', 'Sarapan', 0, '2021-08-20 14:04:25', '2021-08-20 14:04:25', NULL);

-- ----------------------------
-- Table structure for t_pendaftaran
-- ----------------------------
DROP TABLE IF EXISTS `t_pendaftaran`;
CREATE TABLE `t_pendaftaran`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `usia` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat_domisili` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat_ktp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pekerjaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `id_vaksinasi` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_pendaftaran
-- ----------------------------
INSERT INTO `t_pendaftaran` VALUES (1, 'Mas Bambang', '35781212121212', '39', 'Jalan abc no 2', 'jalan xyz no 1', 'Laki-Laki', 'Swasta', '2021-08-20 10:21:55', NULL, NULL, 1);
INSERT INTO `t_pendaftaran` VALUES (2, 'a', 'as', 'as', 'as', 'as', 'Perempuan', 's', '2021-08-20 12:11:26', '2021-08-20 12:11:26', NULL, 1);
INSERT INTO `t_pendaftaran` VALUES (3, 'jk', '12', 'k', 'as', 'as', 'Laki-Laki', 'as', '2021-08-20 12:11:56', '2021-08-20 12:11:56', NULL, 1);
INSERT INTO `t_pendaftaran` VALUES (4, 'oke', '12121212', '31', 's', 's', 'Perempuan', '1s', '2021-08-20 13:57:43', '2021-08-20 13:57:43', NULL, 1);
INSERT INTO `t_pendaftaran` VALUES (5, 'oke', '12121212', '31', 's', 's', 'Perempuan', '1s', '2021-08-20 13:57:49', '2021-08-20 13:57:49', NULL, 1);
INSERT INTO `t_pendaftaran` VALUES (6, 'oke', '12121212', '31', 's', 's', 'Perempuan', '1s', '2021-08-20 13:58:22', '2021-08-20 13:58:22', NULL, 1);
INSERT INTO `t_pendaftaran` VALUES (7, 'sasas', '12121212', '133', 'asa', 'asa', 'Laki-Laki', 'aksk', '2021-08-20 13:59:53', '2021-08-20 13:59:53', NULL, 1);
INSERT INTO `t_pendaftaran` VALUES (8, 'asas', 'asa', '12', 'as', 'as', 'Laki-Laki', 'asa', '2021-08-20 14:50:05', '2021-08-20 14:50:05', NULL, 1);
INSERT INTO `t_pendaftaran` VALUES (9, 'asa', 'ase', 'as', 's', NULL, 'Laki-Laki', 'q', '2021-08-20 14:50:19', '2021-08-20 14:50:19', '2021-08-20 14:59:04', 1);
INSERT INTO `t_pendaftaran` VALUES (10, 'as', 'aaeea', 'a', 'as', 'as', 'Perempuan', NULL, '2021-08-20 14:50:35', '2021-08-20 14:50:35', '2021-08-20 14:59:04', 1);
INSERT INTO `t_pendaftaran` VALUES (11, 'm. anton', '102910291029', '21', '212', 'sas', 'Laki-Laki', '121', '2021-08-20 15:03:43', '2021-08-20 15:03:43', '2021-08-20 14:59:04', 1);

-- ----------------------------
-- Table structure for t_vaksinasi
-- ----------------------------
DROP TABLE IF EXISTS `t_vaksinasi`;
CREATE TABLE `t_vaksinasi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_pelaksanaan` date NULL DEFAULT NULL,
  `jam_pelaksanaan_mulai` time(0) NULL DEFAULT NULL,
  `jam_pelaksanaan_akhir` time(0) NULL DEFAULT NULL,
  `vaksinator` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jenis_vaksin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_pendaftaran_mulai` date NULL DEFAULT NULL,
  `tgl_pendaftaran_akhir` date NULL DEFAULT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kuota` int(8) NULL DEFAULT NULL,
  `vaksinasi_ke` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_vaksinasi
-- ----------------------------
INSERT INTO `t_vaksinasi` VALUES (1, '2021-08-21', '07:00:00', '16:00:00', 'RSUD Haji', 'Sinovac', '2021-08-16', '2021-08-21', 'Surabaya', 10, 1, '2021-08-20 10:18:15', '2021-08-20 10:18:15', NULL);
INSERT INTO `t_vaksinasi` VALUES (2, '2021-08-27', '07:00:00', '16:00:00', 'RSUD Haji', 'Antangin', '2021-08-23', '2021-08-26', 'Surabaya', 14, 2, '2021-08-20 10:18:15', '2021-08-20 10:18:15', NULL);
INSERT INTO `t_vaksinasi` VALUES (3, '2021-08-01', '07:00:00', '16:00:00', 'RSUD Haji', 'Alkaline', '2021-07-29', '2021-07-31', 'Surabaya', 8, 2, '2021-08-20 10:18:15', '2021-08-20 10:18:15', NULL);

SET FOREIGN_KEY_CHECKS = 1;
