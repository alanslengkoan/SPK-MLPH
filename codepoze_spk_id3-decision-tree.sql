/*
 Navicat Premium Data Transfer

 Source Server         : Staging
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : codepoze_spk_id3-decision-tree

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 30/07/2025 22:40:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for dataset
-- ----------------------------
DROP TABLE IF EXISTS `dataset`;
CREATE TABLE `dataset`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `age` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `income` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `student` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `loan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `class` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dataset
-- ----------------------------
INSERT INTO `dataset` VALUES (1, 'Muda', 'Tinggi', 'Tidak', 'Macet', 'Tidak Beli');
INSERT INTO `dataset` VALUES (2, 'Muda', 'Tinggi', 'Tidak', 'Lancar', 'Tidak Beli');
INSERT INTO `dataset` VALUES (3, 'Tengah Baya', 'Tinggi', 'Tidak', 'Macet', 'Beli');
INSERT INTO `dataset` VALUES (4, 'Tua', 'Sedang', 'Tidak', 'Macet', 'Beli');
INSERT INTO `dataset` VALUES (5, 'Tua', 'Rendah', 'Ya', 'Macet', 'Beli');
INSERT INTO `dataset` VALUES (6, 'Tua', 'Rendah', 'Ya', 'Lancar', 'Tidak Beli');
INSERT INTO `dataset` VALUES (7, 'Tengah Baya', 'Rendah', 'Ya', 'Lancar', 'Beli');
INSERT INTO `dataset` VALUES (8, 'Muda', 'Sedang', 'Tidak', 'Macet', 'Tidak Beli');
INSERT INTO `dataset` VALUES (9, 'Muda', 'Rendah', 'Tidak', 'Macet', 'Beli');
INSERT INTO `dataset` VALUES (10, 'Tua', 'Sedang', 'Ya', 'Macet', 'Beli');
INSERT INTO `dataset` VALUES (11, 'Muda', 'Sedang', 'Ya', 'Lancar', 'Beli');
INSERT INTO `dataset` VALUES (12, 'Tengah Baya', 'Sedang', 'Tidak', 'Lancar', 'Beli');
INSERT INTO `dataset` VALUES (13, 'Tengah Baya', 'Tinggi', 'Ya', 'Macet', 'Beli');
INSERT INTO `dataset` VALUES (14, 'Tua', 'Sedang', 'Tidak', 'Lancar', 'Tidak Beli');

SET FOREIGN_KEY_CHECKS = 1;
