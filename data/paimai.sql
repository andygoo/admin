/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : paimai

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2016-07-28 16:18:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `auction`
-- ----------------------------
DROP TABLE IF EXISTS `auction`;
CREATE TABLE `auction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '拍品名称',
  `pic` text NOT NULL COMMENT '拍品图',
  `desc` text NOT NULL COMMENT '拍品描述',
  `start_time` int(11) NOT NULL DEFAULT '0' COMMENT '开拍时间',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '结束时间',
  `start_price` int(11) NOT NULL DEFAULT '0' COMMENT '起拍价',
  `step_price` int(11) NOT NULL DEFAULT '0' COMMENT '加价幅度',
  `reserve_price` int(11) NOT NULL DEFAULT '0' COMMENT '底价',
  `curr_price` int(11) NOT NULL DEFAULT '0' COMMENT '当前价',
  `bid_num` int(11) NOT NULL DEFAULT '0' COMMENT '出价次数',
  `delay_num` int(11) NOT NULL DEFAULT '0' COMMENT '延时次数',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auction
-- ----------------------------
INSERT INTO `auction` VALUES ('4', '', '[\"http:\\/\\/7xkkhh.com1.z0.glb.clouddn.com\\/2016\\/06\\/11\\/14656335468760.jpg?802x599\",\"2016\\/06\\/09\\/14654460029698.jpg?802x608\",\"2016\\/06\\/09\\/14654460025608.jpg?802x421\",\"2016\\/06\\/09\\/14654460028432.jpg?559x802\"]', '贾又福，1965年毕业于中央美术学院，后潜心山水画创作并进修人物画。现为中央美院国画系教授，中国美术家协会理事，中央美术学院学术', '1469499840', '1469545860', '3', '3', '3', '219', '1', '0', '0');
INSERT INTO `auction` VALUES ('5', '', '[\"2016\\/06\\/09\\/14654460401932.jpg?802x599\",\"2016\\/06\\/09\\/14654460410069.jpg?3732x2592\",\"2016\\/06\\/09\\/14654460408913.jpg?3369x2592\",\"2016\\/06\\/09\\/14654460404265.jpg?775x802\"]', '作者: 刘金凯\n创作时间/年代: 不详\n尺寸: 69*69\n装裱方式: 未装裱\n材质工艺: 纸本\n字体: 行书\n字画性质: 原稿\n品相: 十品\n书法类型: 毛笔\n书法形式: 斗方', '1465430400', '1465484400', '2', '3', '4', '576', '0', '0', '0');
INSERT INTO `auction` VALUES ('6', '', '[\"2016\\/06\\/09\\/14654460688867.jpg?2376x2355\",\"2016\\/06\\/09\\/14654460672583.jpg?3474x2592\",\"2016\\/06\\/09\\/14654460673317.jpg?3414x1686\",\"2016\\/06\\/09\\/14654460662515.jpg?2592x3888\",\"2016\\/06\\/09\\/14654460661239.jpg?3420x2592\"]', '徐乐乐，现为江苏省国画院一级美术师。作品曾获第七届全国美术展览金奖，并参加过“深圳国际水墨画展”、“中国新文人画展”、“中国女画', '1465430400', '1465430400', '3', '34', '34', '0', '0', '0', '0');
INSERT INTO `auction` VALUES ('7', '', '[\"2016\\/06\\/09\\/14654460825248.jpg?3726x2592\",\"2016\\/06\\/09\\/14654460820047.jpg?3840x2593\",\"2016\\/06\\/09\\/14654460811065.jpg?3888x2592\"]', '作者: 刘金凯\n创作时间/年代: 不详\n尺寸: 69*69\n装裱方式: 未装裱\n材质工艺: 纸本\n字体: 行书\n字画性质: 原稿\n品相: 十品\n书法类型: 毛笔\n书法形式: 斗方', '1465430400', '1465487700', '0', '30', '500', '7685555', '0', '0', '0');
INSERT INTO `auction` VALUES ('8', '', '[\"2016\\/06\\/09\\/14654486178958.jpg?802x792\",\"2016\\/06\\/09\\/14654486173385.jpg?794x802\"]', '', '1465430400', '1465430400', '1', '2', '3', '60', '0', '0', '0');
INSERT INTO `auction` VALUES ('9', '', '[\"2016\\/06\\/09\\/14654486458920.jpg?880x630\",\"2016\\/06\\/09\\/14654486453121.jpg?880x1733\"]', '', '1465430400', '1465430400', '3', '4', '5', '0', '0', '0', '0');
INSERT INTO `auction` VALUES ('10', '', '[\"2016\\/06\\/09\\/14654515334034.jpg?880x1733\"]', '', '1465430400', '1465430400', '6', '7', '8', '20', '0', '0', '0');

-- ----------------------------
-- Table structure for `bidlog`
-- ----------------------------
DROP TABLE IF EXISTS `bidlog`;
CREATE TABLE `bidlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL DEFAULT '0' COMMENT '拍品id',
  `user_id` varchar(50) NOT NULL DEFAULT '0' COMMENT '竞买人id',
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '竞买人名',
  `user_avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '竞买人头像',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '出价',
  `time` int(11) NOT NULL DEFAULT '0' COMMENT '出价时间',
  `type` tinyint(4) NOT NULL COMMENT '出价方式：代理，正常',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bidlog
-- ----------------------------
INSERT INTO `bidlog` VALUES ('1', '5', '0', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '20', '1465442143', '0');
INSERT INTO `bidlog` VALUES ('2', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '20', '1465442264', '0');
INSERT INTO `bidlog` VALUES ('3', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '20', '1465442669', '0');
INSERT INTO `bidlog` VALUES ('4', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '20', '1465443794', '0');
INSERT INTO `bidlog` VALUES ('5', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '20', '1465443795', '0');
INSERT INTO `bidlog` VALUES ('6', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '20', '1465443796', '0');
INSERT INTO `bidlog` VALUES ('7', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '20', '1465443797', '0');
INSERT INTO `bidlog` VALUES ('8', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '20', '1465443798', '0');
INSERT INTO `bidlog` VALUES ('9', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '20', '1465443799', '0');
INSERT INTO `bidlog` VALUES ('10', '9', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '20', '1465449544', '0');
INSERT INTO `bidlog` VALUES ('11', '10', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '20', '1465449552', '0');
INSERT INTO `bidlog` VALUES ('12', '8', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '20', '1465451833', '0');
INSERT INTO `bidlog` VALUES ('13', '8', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '20', '1465451843', '0');
INSERT INTO `bidlog` VALUES ('14', '8', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '20', '1465451924', '0');
INSERT INTO `bidlog` VALUES ('15', '8', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '40', '1465451926', '0');
INSERT INTO `bidlog` VALUES ('16', '8', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '60', '1465451930', '0');
INSERT INTO `bidlog` VALUES ('17', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '20', '1465452029', '0');
INSERT INTO `bidlog` VALUES ('18', '10', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '20', '1465452510', '0');
INSERT INTO `bidlog` VALUES ('19', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '20', '1465455983', '0');
INSERT INTO `bidlog` VALUES ('20', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '40', '1465456405', '0');
INSERT INTO `bidlog` VALUES ('21', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '40', '1465469086', '0');
INSERT INTO `bidlog` VALUES ('22', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '60', '1465469087', '0');
INSERT INTO `bidlog` VALUES ('23', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '80', '1465469088', '0');
INSERT INTO `bidlog` VALUES ('24', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '100', '1465469089', '0');
INSERT INTO `bidlog` VALUES ('25', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '120', '1465469090', '0');
INSERT INTO `bidlog` VALUES ('26', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '140', '1465469091', '0');
INSERT INTO `bidlog` VALUES ('27', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '160', '1465469091', '0');
INSERT INTO `bidlog` VALUES ('28', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '180', '1465469092', '0');
INSERT INTO `bidlog` VALUES ('29', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '200', '1465469093', '0');
INSERT INTO `bidlog` VALUES ('30', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '220', '1465469094', '0');
INSERT INTO `bidlog` VALUES ('31', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '240', '1465469095', '0');
INSERT INTO `bidlog` VALUES ('32', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '260', '1465469096', '0');
INSERT INTO `bidlog` VALUES ('33', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '280', '1465469750', '0');
INSERT INTO `bidlog` VALUES ('34', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '300', '1465469833', '0');
INSERT INTO `bidlog` VALUES ('35', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '20', '1465469877', '0');
INSERT INTO `bidlog` VALUES ('36', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '40', '1465469879', '0');
INSERT INTO `bidlog` VALUES ('37', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '60', '1465469880', '0');
INSERT INTO `bidlog` VALUES ('38', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '80', '1465469883', '0');
INSERT INTO `bidlog` VALUES ('39', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '100', '1465469891', '0');
INSERT INTO `bidlog` VALUES ('40', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '320', '1465469936', '0');
INSERT INTO `bidlog` VALUES ('41', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '340', '1465469988', '0');
INSERT INTO `bidlog` VALUES ('42', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '360', '1465470018', '0');
INSERT INTO `bidlog` VALUES ('43', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '380', '1465470084', '0');
INSERT INTO `bidlog` VALUES ('44', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '400', '1465470160', '0');
INSERT INTO `bidlog` VALUES ('45', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '420', '1465470178', '0');
INSERT INTO `bidlog` VALUES ('46', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '120', '1465470240', '0');
INSERT INTO `bidlog` VALUES ('47', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '440', '1465470286', '0');
INSERT INTO `bidlog` VALUES ('48', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '460', '1465470392', '0');
INSERT INTO `bidlog` VALUES ('49', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '480', '1465470441', '0');
INSERT INTO `bidlog` VALUES ('50', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '500', '1465470460', '0');
INSERT INTO `bidlog` VALUES ('51', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '520', '1465470492', '0');
INSERT INTO `bidlog` VALUES ('52', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '540', '1465470668', '0');
INSERT INTO `bidlog` VALUES ('53', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '560', '1465470686', '0');
INSERT INTO `bidlog` VALUES ('54', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '580', '1465470809', '0');
INSERT INTO `bidlog` VALUES ('55', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '600', '1465470813', '0');
INSERT INTO `bidlog` VALUES ('56', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '620', '1465470862', '0');
INSERT INTO `bidlog` VALUES ('57', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '640', '1465470920', '0');
INSERT INTO `bidlog` VALUES ('58', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '660', '1465470931', '0');
INSERT INTO `bidlog` VALUES ('59', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '140', '1465470980', '0');
INSERT INTO `bidlog` VALUES ('60', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '680', '1465471137', '0');
INSERT INTO `bidlog` VALUES ('61', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '700', '1465471151', '0');
INSERT INTO `bidlog` VALUES ('62', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '720', '1465471160', '0');
INSERT INTO `bidlog` VALUES ('63', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '740', '1465471178', '0');
INSERT INTO `bidlog` VALUES ('64', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '760', '1465471296', '0');
INSERT INTO `bidlog` VALUES ('65', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '160', '1465471390', '0');
INSERT INTO `bidlog` VALUES ('66', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '180', '1465471396', '0');
INSERT INTO `bidlog` VALUES ('67', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '780', '1465471440', '0');
INSERT INTO `bidlog` VALUES ('68', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '200', '1465471448', '0');
INSERT INTO `bidlog` VALUES ('69', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '800', '1465471568', '0');
INSERT INTO `bidlog` VALUES ('70', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '820', '1465471617', '0');
INSERT INTO `bidlog` VALUES ('71', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '840', '1465471677', '0');
INSERT INTO `bidlog` VALUES ('72', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '860', '1465471745', '0');
INSERT INTO `bidlog` VALUES ('73', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '880', '1465471802', '0');
INSERT INTO `bidlog` VALUES ('74', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '900', '1465471899', '0');
INSERT INTO `bidlog` VALUES ('75', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '220', '1465471907', '0');
INSERT INTO `bidlog` VALUES ('76', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '240', '1465471913', '0');
INSERT INTO `bidlog` VALUES ('77', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '920', '1465472024', '0');
INSERT INTO `bidlog` VALUES ('78', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '940', '1465472074', '0');
INSERT INTO `bidlog` VALUES ('79', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '960', '1465472109', '0');
INSERT INTO `bidlog` VALUES ('80', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '980', '1465472173', '0');
INSERT INTO `bidlog` VALUES ('81', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '1000', '1465472229', '0');
INSERT INTO `bidlog` VALUES ('82', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '1020', '1465472257', '0');
INSERT INTO `bidlog` VALUES ('83', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '260', '1465472293', '0');
INSERT INTO `bidlog` VALUES ('84', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '280', '1465472360', '0');
INSERT INTO `bidlog` VALUES ('85', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '1040', '1465472499', '0');
INSERT INTO `bidlog` VALUES ('86', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '300', '1465472592', '0');
INSERT INTO `bidlog` VALUES ('87', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '1060', '1465472635', '0');
INSERT INTO `bidlog` VALUES ('88', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '1080', '1465472683', '0');
INSERT INTO `bidlog` VALUES ('89', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '320', '1465472688', '0');
INSERT INTO `bidlog` VALUES ('90', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '1100', '1465472735', '0');
INSERT INTO `bidlog` VALUES ('91', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '1120', '1465472755', '0');
INSERT INTO `bidlog` VALUES ('92', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '340', '1465472798', '0');
INSERT INTO `bidlog` VALUES ('93', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '1140', '1465472888', '0');
INSERT INTO `bidlog` VALUES ('94', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '360', '1465472913', '0');
INSERT INTO `bidlog` VALUES ('95', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '1160', '1465473083', '0');
INSERT INTO `bidlog` VALUES ('96', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '1180', '1465473100', '0');
INSERT INTO `bidlog` VALUES ('97', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '1200', '1465473102', '0');
INSERT INTO `bidlog` VALUES ('98', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '1220', '1465473118', '0');
INSERT INTO `bidlog` VALUES ('99', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '1240', '1465473167', '0');
INSERT INTO `bidlog` VALUES ('100', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '380', '1465473288', '0');
INSERT INTO `bidlog` VALUES ('101', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '1260', '1465473296', '0');
INSERT INTO `bidlog` VALUES ('102', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '400', '1465473361', '0');
INSERT INTO `bidlog` VALUES ('103', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '1280', '1465473388', '0');
INSERT INTO `bidlog` VALUES ('104', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '1300', '1465473404', '0');
INSERT INTO `bidlog` VALUES ('105', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '420', '1465473411', '0');
INSERT INTO `bidlog` VALUES ('106', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '440', '1465473447', '0');
INSERT INTO `bidlog` VALUES ('107', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '460', '1465473477', '0');
INSERT INTO `bidlog` VALUES ('108', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '480', '1465473477', '0');
INSERT INTO `bidlog` VALUES ('109', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '500', '1465473490', '0');
INSERT INTO `bidlog` VALUES ('110', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '520', '1465473490', '0');
INSERT INTO `bidlog` VALUES ('111', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '540', '1465473589', '0');
INSERT INTO `bidlog` VALUES ('112', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '60', '1465475856', '0');
INSERT INTO `bidlog` VALUES ('113', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '2630', '1465477315', '0');
INSERT INTO `bidlog` VALUES ('114', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '2660', '1465477364', '0');
INSERT INTO `bidlog` VALUES ('115', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '2699', '1465477376', '0');
INSERT INTO `bidlog` VALUES ('116', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '2729', '1465477624', '0');
INSERT INTO `bidlog` VALUES ('117', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '2759', '1465477737', '0');
INSERT INTO `bidlog` VALUES ('118', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '2789', '1465477791', '0');
INSERT INTO `bidlog` VALUES ('119', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '2819', '1465477951', '0');
INSERT INTO `bidlog` VALUES ('120', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '2849', '1465478069', '0');
INSERT INTO `bidlog` VALUES ('121', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '2879', '1465478156', '0');
INSERT INTO `bidlog` VALUES ('122', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '2909', '1465478239', '0');
INSERT INTO `bidlog` VALUES ('123', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '2939', '1465478657', '0');
INSERT INTO `bidlog` VALUES ('124', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '296', '1465479241', '0');
INSERT INTO `bidlog` VALUES ('125', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '326', '1465480615', '0');
INSERT INTO `bidlog` VALUES ('126', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '326', '1465480622', '0');
INSERT INTO `bidlog` VALUES ('127', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '356', '1465480638', '0');
INSERT INTO `bidlog` VALUES ('128', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '386', '1465480674', '0');
INSERT INTO `bidlog` VALUES ('129', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '386', '1465480677', '0');
INSERT INTO `bidlog` VALUES ('130', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '38', '1465480681', '0');
INSERT INTO `bidlog` VALUES ('131', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '68', '1465480819', '0');
INSERT INTO `bidlog` VALUES ('132', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '98', '1465481797', '0');
INSERT INTO `bidlog` VALUES ('133', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '128', '1465481832', '0');
INSERT INTO `bidlog` VALUES ('134', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '158', '1465481880', '0');
INSERT INTO `bidlog` VALUES ('135', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '188', '1465481923', '0');
INSERT INTO `bidlog` VALUES ('136', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '228', '1465482044', '0');
INSERT INTO `bidlog` VALUES ('137', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '543', '1465482725', '0');
INSERT INTO `bidlog` VALUES ('138', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '258', '1465482767', '0');
INSERT INTO `bidlog` VALUES ('139', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '546', '1465482776', '0');
INSERT INTO `bidlog` VALUES ('140', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '549', '1465482834', '0');
INSERT INTO `bidlog` VALUES ('141', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '288', '1465483044', '0');
INSERT INTO `bidlog` VALUES ('142', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '318', '1465483107', '0');
INSERT INTO `bidlog` VALUES ('143', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '348', '1465483717', '0');
INSERT INTO `bidlog` VALUES ('144', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '378', '1465483748', '0');
INSERT INTO `bidlog` VALUES ('145', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '408', '1465484278', '0');
INSERT INTO `bidlog` VALUES ('146', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '552', '1465484379', '0');
INSERT INTO `bidlog` VALUES ('147', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '555', '1465484384', '0');
INSERT INTO `bidlog` VALUES ('148', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '558', '1465484389', '0');
INSERT INTO `bidlog` VALUES ('149', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '561', '1465484397', '0');
INSERT INTO `bidlog` VALUES ('150', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '564', '1465484401', '0');
INSERT INTO `bidlog` VALUES ('151', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '567', '1465484406', '0');
INSERT INTO `bidlog` VALUES ('152', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '570', '1465484417', '0');
INSERT INTO `bidlog` VALUES ('153', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '573', '1465484423', '0');
INSERT INTO `bidlog` VALUES ('154', '5', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '576', '1465484435', '0');
INSERT INTO `bidlog` VALUES ('155', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '438', '1465485145', '0');
INSERT INTO `bidlog` VALUES ('156', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '468', '1465485577', '0');
INSERT INTO `bidlog` VALUES ('157', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '498', '1465485588', '0');
INSERT INTO `bidlog` VALUES ('158', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '528', '1465485598', '0');
INSERT INTO `bidlog` VALUES ('159', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '558', '1465485701', '0');
INSERT INTO `bidlog` VALUES ('160', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '588', '1465485705', '0');
INSERT INTO `bidlog` VALUES ('161', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '618', '1465485708', '0');
INSERT INTO `bidlog` VALUES ('162', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '648', '1465485711', '0');
INSERT INTO `bidlog` VALUES ('163', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '678', '1465486953', '0');
INSERT INTO `bidlog` VALUES ('164', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '708', '1465486959', '0');
INSERT INTO `bidlog` VALUES ('165', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '738', '1465486969', '0');
INSERT INTO `bidlog` VALUES ('166', '7', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '7685555', '1465486977', '0');
INSERT INTO `bidlog` VALUES ('167', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '63', '1465524163', '0');
INSERT INTO `bidlog` VALUES ('168', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '66', '1465524214', '0');
INSERT INTO `bidlog` VALUES ('169', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '69', '1465524296', '0');
INSERT INTO `bidlog` VALUES ('170', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '72', '1465524347', '0');
INSERT INTO `bidlog` VALUES ('171', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '75', '1465534118', '0');
INSERT INTO `bidlog` VALUES ('172', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '78', '1465534125', '0');
INSERT INTO `bidlog` VALUES ('173', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '81', '1465534129', '0');
INSERT INTO `bidlog` VALUES ('174', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '84', '1465534134', '0');
INSERT INTO `bidlog` VALUES ('175', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '87', '1465534150', '0');
INSERT INTO `bidlog` VALUES ('176', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '90', '1465535168', '0');
INSERT INTO `bidlog` VALUES ('177', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '93', '1465535277', '0');
INSERT INTO `bidlog` VALUES ('178', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '96', '1465535421', '0');
INSERT INTO `bidlog` VALUES ('179', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '99', '1465535429', '0');
INSERT INTO `bidlog` VALUES ('180', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '102', '1465535434', '0');
INSERT INTO `bidlog` VALUES ('181', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '105', '1465535445', '0');
INSERT INTO `bidlog` VALUES ('182', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '108', '1465535473', '0');
INSERT INTO `bidlog` VALUES ('183', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '111', '1465535486', '0');
INSERT INTO `bidlog` VALUES ('184', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '114', '1465535537', '0');
INSERT INTO `bidlog` VALUES ('185', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '117', '1465535546', '0');
INSERT INTO `bidlog` VALUES ('186', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '120', '1465535555', '0');
INSERT INTO `bidlog` VALUES ('187', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '123', '1465535566', '0');
INSERT INTO `bidlog` VALUES ('188', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '126', '1465535836', '0');
INSERT INTO `bidlog` VALUES ('189', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '129', '1465535852', '0');
INSERT INTO `bidlog` VALUES ('190', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '132', '1465535856', '0');
INSERT INTO `bidlog` VALUES ('191', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '135', '1465535860', '0');
INSERT INTO `bidlog` VALUES ('192', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '138', '1465536130', '0');
INSERT INTO `bidlog` VALUES ('193', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '141', '1465536263', '0');
INSERT INTO `bidlog` VALUES ('194', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '144', '1465536302', '0');
INSERT INTO `bidlog` VALUES ('195', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '147', '1465536721', '0');
INSERT INTO `bidlog` VALUES ('196', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '150', '1465537260', '0');
INSERT INTO `bidlog` VALUES ('197', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '153', '1465537560', '0');
INSERT INTO `bidlog` VALUES ('198', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '156', '1465537679', '0');
INSERT INTO `bidlog` VALUES ('199', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '159', '1465537740', '0');
INSERT INTO `bidlog` VALUES ('200', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '162', '1465538280', '0');
INSERT INTO `bidlog` VALUES ('201', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '165', '1465538340', '0');
INSERT INTO `bidlog` VALUES ('202', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '168', '1465538520', '0');
INSERT INTO `bidlog` VALUES ('203', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '171', '1465538700', '0');
INSERT INTO `bidlog` VALUES ('204', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '174', '1465538820', '0');
INSERT INTO `bidlog` VALUES ('205', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '177', '1465538880', '0');
INSERT INTO `bidlog` VALUES ('206', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '180', '1465539000', '0');
INSERT INTO `bidlog` VALUES ('207', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '183', '1465548616', '0');
INSERT INTO `bidlog` VALUES ('208', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '186', '1465548646', '0');
INSERT INTO `bidlog` VALUES ('209', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '189', '1465548667', '0');
INSERT INTO `bidlog` VALUES ('210', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '192', '1465548987', '0');
INSERT INTO `bidlog` VALUES ('211', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '195', '1465548992', '0');
INSERT INTO `bidlog` VALUES ('212', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '198', '1465549121', '0');
INSERT INTO `bidlog` VALUES ('213', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '201', '1465549135', '0');
INSERT INTO `bidlog` VALUES ('214', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '204', '1465549207', '0');
INSERT INTO `bidlog` VALUES ('215', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '207', '1465549528', '0');
INSERT INTO `bidlog` VALUES ('216', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '210', '1465549547', '0');
INSERT INTO `bidlog` VALUES ('217', '4', 'oUcKEtwIP8_0VlA2VsKd7dATujGQ', '文杰', 'http://wx.qlogo.cn/mmopen/CttmTaYSYkS3fyWVgtngxRqQ8VC0XAUvRGQevIYzPS19pcW3D6EyhQx5LCHQj8Wo1vyDBmNaJm89J4ggvRwuOw/0', '213', '1465629856', '0');
INSERT INTO `bidlog` VALUES ('218', '4', 'openid11111111111', '清明上河图', 'http://static.oschina.net/uploads/user/33/66764_100.jpg', '216', '1465630164', '0');
INSERT INTO `bidlog` VALUES ('219', '4', '1', 'aaa', '', '219', '1469524749', '0');
