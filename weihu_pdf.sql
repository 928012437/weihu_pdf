/*
Navicat MySQL Data Transfer

Source Server         : 微狐2019
Source Server Version : 50642
Source Host           : 47.94.0.228:3306
Source Database       : we7_20190709

Target Server Type    : MYSQL
Target Server Version : 50642
File Encoding         : 65001

Date: 2020-06-28 16:59:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ims_weihu_pdf_list`
-- ----------------------------
DROP TABLE IF EXISTS `ims_weihu_pdf_list`;
CREATE TABLE `ims_weihu_pdf_list` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `uniacid` int(9) DEFAULT NULL,
  `name` varchar(125) COLLATE utf8_bin DEFAULT NULL,
  `mobile` varchar(125) COLLATE utf8_bin DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `age` varchar(125) COLLATE utf8_bin DEFAULT NULL,
  `pdfurl` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `idcard` varchar(125) COLLATE utf8_bin DEFAULT NULL,
  `xmname` varchar(125) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of ims_weihu_pdf_list
-- ----------------------------
INSERT INTO `ims_weihu_pdf_list` VALUES ('1', '133', '刘向泽', '15253379480', '1', '26', 'https://20190709.jnweishangjia.com/addons/weihu_pdf/pdffile/if1291592011469.pdf', '43645735425636563', 'a42项目');

-- ----------------------------
-- Table structure for `ims_weihu_pdf_set`
-- ----------------------------
DROP TABLE IF EXISTS `ims_weihu_pdf_set`;
CREATE TABLE `ims_weihu_pdf_set` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `uniacid` int(9) DEFAULT NULL,
  `check1` tinyint(1) DEFAULT NULL,
  `check2` tinyint(1) DEFAULT NULL,
  `check3` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of ims_weihu_pdf_set
-- ----------------------------
INSERT INTO `ims_weihu_pdf_set` VALUES ('1', '133', '1', '1', '1');
