/*
Navicat MySQL Data Transfer

Source Server         : 555
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-04-06 23:24:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for guest_books
-- ----------------------------
DROP TABLE IF EXISTS `guest_books`;
CREATE TABLE `guest_books` (
  `guest_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comments` varchar(255) NOT NULL,
  `last_visitor` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`guest_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of guest_books
-- ----------------------------
INSERT INTO `guest_books` VALUES ('1', 'good', '张三', 'zhangsan');
INSERT INTO `guest_books` VALUES ('2', 'laji', '李四', 'lisi');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `sites` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'zhangsan', '123456', 'zhangsan');
INSERT INTO `user` VALUES ('2', 'lishi', '123456', 'lishi');
