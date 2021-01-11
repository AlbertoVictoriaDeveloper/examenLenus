/*
 Navicat Premium Data Transfer

 Source Server         : MiConexionLocal
 Source Server Type    : MySQL
 Source Server Version : 50731
 Source Host           : localhost:3306
 Source Schema         : test_exam

 Target Server Type    : MySQL
 Target Server Version : 50731
 File Encoding         : 65001

 Date: 11/01/2021 16:06:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for equipos
-- ----------------------------
DROP TABLE IF EXISTS `equipos`;
CREATE TABLE `equipos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_equipo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_usuario` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of equipos
-- ----------------------------

-- ----------------------------
-- Table structure for token
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_usuarios` int(11) NULL DEFAULT NULL,
  `fecha_inicio_conexion` datetime(0) NULL DEFAULT NULL,
  `fecha_cierre_session` datetime(0) NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of token
-- ----------------------------
INSERT INTO `token` VALUES (1, 'a7ce96a49ce3fc3e572a909c5849c8d0', 9, '2021-01-11 20:33:54', '2021-01-11 21:07:47', 0);
INSERT INTO `token` VALUES (2, '49f0c7f2c517775514d3b4c3d432257a', 9, '2021-01-11 21:08:00', '2021-01-11 21:08:16', 0);
INSERT INTO `token` VALUES (3, 'eb310f87a17ca97d7686a76d2213ee61', 9, '2021-01-11 21:08:24', '2021-01-11 21:13:17', 0);
INSERT INTO `token` VALUES (4, '4e0e542af86f9b8a6d21748a72812b37', 9, '2021-01-11 21:30:39', '2021-01-11 21:32:38', 0);
INSERT INTO `token` VALUES (5, 'e50f504ad3160fe6c3b99080c4d79432', 9, '2021-01-11 21:32:51', '2021-01-11 21:35:33', 0);
INSERT INTO `token` VALUES (6, '0b47866a5c29ad4a45790f3363ed3a38', 9, '2021-01-11 21:37:25', '2021-01-11 21:38:19', 0);
INSERT INTO `token` VALUES (7, 'b5857eabf6cadc7e83ba1e71436c435f', 9, '2021-01-11 21:38:23', '2021-01-11 21:38:27', 0);
INSERT INTO `token` VALUES (8, 'ca5cf524b18ddbca493d3c24a9c3136f', 10, '2021-01-11 21:38:47', '2021-01-11 21:41:41', 0);
INSERT INTO `token` VALUES (9, 'e27f3a0f574e4ed9c39134e8a8c0133a', 10, '2021-01-11 21:51:51', '2021-01-11 21:51:55', 0);
INSERT INTO `token` VALUES (10, '03503b5863c52f52f58f93e414e88631', 12, '2021-01-11 21:55:10', '2021-01-11 21:55:19', 0);
INSERT INTO `token` VALUES (11, '018248f57d993b8330f410b26380322e', 12, '2021-01-11 21:59:17', '2021-01-11 22:03:53', 0);
INSERT INTO `token` VALUES (12, '3425a0fa72d9605d00b2035798ff55bb', 12, '2021-01-11 22:03:56', NULL, 1);

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `apellido_paterno` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `apellido_materno` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `update_register` datetime(0) NULL DEFAULT NULL,
  `activo` int(11) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (12, 'albertovictorialopez93@gmail.com', 'Alberto', 'victori', 'Lopez', '202cb962ac59075b964b07152d234b70', NULL, 1);

SET FOREIGN_KEY_CHECKS = 1;
