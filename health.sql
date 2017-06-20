/*
Navicat MySQL Data Transfer

Source Server         : homestead
Source Server Version : 50718
Source Host           : 192.168.10.10:3306
Source Database       : health

Target Server Type    : MYSQL
Target Server Version : 50718
File Encoding         : 65001

Date: 2017-06-20 17:59:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for h_blood
-- ----------------------------
DROP TABLE IF EXISTS `h_blood`;
CREATE TABLE `h_blood` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `white` decimal(5,2) NOT NULL DEFAULT '0.00',
  `red` decimal(5,2) NOT NULL DEFAULT '0.00',
  `platelet` int(5) NOT NULL DEFAULT '0',
  `neutrophils` decimal(5,2) NOT NULL DEFAULT '0.00',
  `member_id` int(20) NOT NULL DEFAULT '0',
  `date_check` date DEFAULT NULL,
  `date_add` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_edit` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_blood
-- ----------------------------
INSERT INTO `h_blood` VALUES ('1', '7.54', '3.57', '157', '4.70', '1', '2017-06-11', '2017-06-20 06:06:37', '2017-06-20 06:06:37', '1');
INSERT INTO `h_blood` VALUES ('2', '1.00', '2.00', '3', '4.00', '1', '2017-06-12', '2017-06-20 14:06:30', null, '1');

-- ----------------------------
-- Table structure for h_member
-- ----------------------------
DROP TABLE IF EXISTS `h_member`;
CREATE TABLE `h_member` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name_real` varchar(20) NOT NULL COMMENT '姓名',
  `name_nick` varchar(20) NOT NULL COMMENT '昵称',
  `password` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '0',
  `weixin` varchar(50) NOT NULL COMMENT '微信号',
  `weixin_id` varchar(50) NOT NULL COMMENT '微信openid',
  `qq` varchar(50) NOT NULL,
  `email_check` tinyint(1) NOT NULL DEFAULT '0' COMMENT '邮箱验证',
  `integral` int(20) NOT NULL DEFAULT '0' COMMENT '积分',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别',
  `birthday` date DEFAULT NULL COMMENT '生日',
  `headpic` varchar(100) NOT NULL,
  `date_add` datetime DEFAULT NULL,
  `date_edit` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_member
-- ----------------------------
INSERT INTO `h_member` VALUES ('1', 'jojo', 'jojo', 'edbbf7a5afd220a65983229ed6496ed9', '13665119187', '723528197@qq.com', '123', '', '123', '1', '0', '2', '2016-06-28', '', '2015-12-23 14:51:03', '2016-08-18 10:10:02', '1');
INSERT INTO `h_member` VALUES ('2', 'jin', '张3', 'edbbf7a5afd220a65983229ed6496ed9', '13665119181', '7235281971@qq.com', '', '', '', '0', '0', '1', '1988-03-19', '12.png', '2016-07-25 18:02:58', '2016-12-05 09:38:04', '1');

-- ----------------------------
-- Table structure for h_role
-- ----------------------------
DROP TABLE IF EXISTS `h_role`;
CREATE TABLE `h_role` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `remark` varchar(50) DEFAULT NULL,
  `parent_id` int(20) DEFAULT '0',
  `date_add` datetime DEFAULT NULL,
  `date_edit` datetime DEFAULT NULL,
  `status` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_role
-- ----------------------------
INSERT INTO `h_role` VALUES ('1', '超级管理员', '超级管理员', '0', null, null, '1');
INSERT INTO `h_role` VALUES ('2', '总管理员', '普通管理员', '0', null, null, '1');
INSERT INTO `h_role` VALUES ('3', '普通管理员', '普通管理员12', '2', null, '2016-07-14 14:16:19', '1');

-- ----------------------------
-- Table structure for h_role_access
-- ----------------------------
DROP TABLE IF EXISTS `h_role_access`;
CREATE TABLE `h_role_access` (
  `role_id` int(20) NOT NULL DEFAULT '0',
  `key` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_role_access
-- ----------------------------
INSERT INTO `h_role_access` VALUES ('2', 'user');
INSERT INTO `h_role_access` VALUES ('2', 'user/my_list');
INSERT INTO `h_role_access` VALUES ('2', 'user/my_del');
INSERT INTO `h_role_access` VALUES ('2', 'user/change_pwd');

-- ----------------------------
-- Table structure for h_setting
-- ----------------------------
DROP TABLE IF EXISTS `h_setting`;
CREATE TABLE `h_setting` (
  `s_key` varchar(50) NOT NULL DEFAULT '',
  `s_value` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`s_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_setting
-- ----------------------------
INSERT INTO `h_setting` VALUES ('logo_name', '15746184e67a7bff0654a67d9a7ae4ba.jpg');
INSERT INTO `h_setting` VALUES ('page_number', '10');
INSERT INTO `h_setting` VALUES ('shipping_free', '80');
INSERT INTO `h_setting` VALUES ('shipping_jzh', '10');
INSERT INTO `h_setting` VALUES ('shipping_other', '20');
INSERT INTO `h_setting` VALUES ('station_name', '7蓝');
INSERT INTO `h_setting` VALUES ('user_error_times', '5');
INSERT INTO `h_setting` VALUES ('use_captcha', '0');
INSERT INTO `h_setting` VALUES ('wx_app_id', 'wx1c495f279a2d6216');
INSERT INTO `h_setting` VALUES ('wx_app_secret', '10581dd598abe83687e1cbd5e4c02276');

-- ----------------------------
-- Table structure for h_treatment
-- ----------------------------
DROP TABLE IF EXISTS `h_treatment`;
CREATE TABLE `h_treatment` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` int(5) NOT NULL DEFAULT '1',
  `remark` varchar(255) DEFAULT NULL,
  `member_id` int(20) NOT NULL DEFAULT '0',
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `date_add` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `date_edit` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_treatment
-- ----------------------------
INSERT INTO `h_treatment` VALUES ('1', '一疗', '5', '', '1', '2017-06-01', '2017-06-14', '2017-06-20 17:40:31', null, '1');

-- ----------------------------
-- Table structure for h_user
-- ----------------------------
DROP TABLE IF EXISTS `h_user`;
CREATE TABLE `h_user` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `name_real` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role` int(20) DEFAULT '0',
  `date_add` datetime DEFAULT NULL,
  `date_edit` datetime DEFAULT NULL,
  `password_times` tinyint(2) NOT NULL DEFAULT '0' COMMENT '密码错误尝试次数',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1有效，2锁定，3注销',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_user
-- ----------------------------
INSERT INTO `h_user` VALUES ('100', 'admin', 'Ming.King', 'edbbf7a5afd220a65983229ed6496ed9', '13665119187', '723528197@qq.com', '1', '2015-11-05 00:00:00', '2016-07-14 10:05:37', '0', '1');
INSERT INTO `h_user` VALUES ('102', 'jojo', 'jojo1', 'edbbf7a5afd220a65983229ed6496ed9', '', '', '2', null, '2016-08-18 13:50:25', '0', '1');
SET FOREIGN_KEY_CHECKS=1;
