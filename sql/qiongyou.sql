/*
Navicat MySQL Data Transfer

Source Server         : php
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : qiongyou

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2018-07-19 12:51:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `city`
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_gps` text COMMENT '城市所在gps坐标',
  `city_name` varchar(255) DEFAULT NULL COMMENT '城市名称',
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of city
-- ----------------------------
INSERT INTO `city` VALUES ('1', null, '哈尔滨');
INSERT INTO `city` VALUES ('2', null, '北京');

-- ----------------------------
-- Table structure for `colection`
-- ----------------------------
DROP TABLE IF EXISTS `colection`;
CREATE TABLE `colection` (
  `colection_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '收藏id或者点赞id',
  `region_id` int(11) DEFAULT NULL COMMENT '对应区域的id',
  `colection_user_id` int(11) DEFAULT NULL COMMENT '收藏的人的id',
  `travel_note_id` int(11) DEFAULT NULL COMMENT '游记id',
  `colection_type` int(11) DEFAULT NULL COMMENT '收藏类型，1是点赞，0是收藏',
  PRIMARY KEY (`colection_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of colection
-- ----------------------------

-- ----------------------------
-- Table structure for `cpartner`
-- ----------------------------
DROP TABLE IF EXISTS `cpartner`;
CREATE TABLE `cpartner` (
  `cpartner_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '结伴id',
  `cpartner_type` varchar(255) DEFAULT NULL COMMENT '结伴类型，A男女不限，B男生专区，C女生专区',
  `cpartner_title` varchar(255) DEFAULT NULL COMMENT '结伴标题',
  `cpartner_content` text COMMENT '结伴内容',
  `cpartner_user_id` int(11) DEFAULT NULL COMMENT '结伴发起人的id',
  `cpartner_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '结伴发起时间',
  PRIMARY KEY (`cpartner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpartner
-- ----------------------------
INSERT INTO `cpartner` VALUES ('1', 'A', '测试A', 'aaa', '3', '2018-07-17 11:41:02');
INSERT INTO `cpartner` VALUES ('2', 'B', '测试B', 'bbb', '3', '2018-07-17 11:41:03');

-- ----------------------------
-- Table structure for `cpartnerlist`
-- ----------------------------
DROP TABLE IF EXISTS `cpartnerlist`;
CREATE TABLE `cpartnerlist` (
  `cpartnerlist_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '结伴列表id',
  `cpartner_id` int(11) DEFAULT NULL COMMENT '对应的那一条结伴信息id',
  `cpartnerlist_user_id` int(11) DEFAULT NULL COMMENT '报名结伴的人的userid',
  `cpartnerlist_type` varchar(255) DEFAULT NULL COMMENT '结伴类型，A男女并不限，B男生专区，C女生专区',
  `cpartnerlist_success` int(11) DEFAULT '0' COMMENT '结伴成功状态，1为成功，0为不成功',
  PRIMARY KEY (`cpartnerlist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpartnerlist
-- ----------------------------
INSERT INTO `cpartnerlist` VALUES ('5', '1', '3', 'A', '0');
INSERT INTO `cpartnerlist` VALUES ('6', '1', '3', 'A', '0');
INSERT INTO `cpartnerlist` VALUES ('7', '1', '3', 'A', '0');
INSERT INTO `cpartnerlist` VALUES ('8', '1', '3', 'A', '0');

-- ----------------------------
-- Table structure for `cpartner_reply`
-- ----------------------------
DROP TABLE IF EXISTS `cpartner_reply`;
CREATE TABLE `cpartner_reply` (
  `cpartner_reply_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '结伴回复id',
  `cpartner_reply_user_id` int(11) DEFAULT NULL COMMENT '回复的人的id',
  `cpartner_reply_content` varchar(255) DEFAULT NULL COMMENT '回复内容',
  `cpartner_reply_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '回复的时间',
  `cpartner_reply_type` varchar(255) DEFAULT NULL COMMENT 'A男女不限，B男生专区，C女生专区',
  `cpartner_id` int(11) DEFAULT NULL COMMENT '回复对应的结伴id',
  PRIMARY KEY (`cpartner_reply_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpartner_reply
-- ----------------------------
INSERT INTO `cpartner_reply` VALUES ('9', '3', '测试内容', '2018-07-12 16:28:06', 'A', '1');
INSERT INTO `cpartner_reply` VALUES ('10', '3', '测试内容', '2018-07-12 16:28:06', 'A', '1');
INSERT INTO `cpartner_reply` VALUES ('11', '3', '测试内容', '2018-07-12 16:28:06', 'A', '1');
INSERT INTO `cpartner_reply` VALUES ('12', '3', '测试内容', '2018-07-12 16:28:06', 'A', '1');
INSERT INTO `cpartner_reply` VALUES ('13', '3', '测试内容', '2018-07-12 16:28:06', 'A', '1');
INSERT INTO `cpartner_reply` VALUES ('14', '3', '测试内容', '2018-07-12 16:28:06', 'A', '1');
INSERT INTO `cpartner_reply` VALUES ('15', '3', '测试内容', '2018-07-12 16:28:06', 'A', '1');
INSERT INTO `cpartner_reply` VALUES ('16', '3', '测试内容', '2018-07-12 16:28:06', 'A', '1');
INSERT INTO `cpartner_reply` VALUES ('17', '3', '测试内容', '2018-07-17 11:21:22', 'A', '1');
INSERT INTO `cpartner_reply` VALUES ('18', '3', '测试内容', '2018-07-17 11:37:59', 'A', '1');
INSERT INTO `cpartner_reply` VALUES ('19', '3', '测试内容', '2018-07-17 13:42:24', 'A', '1');

-- ----------------------------
-- Table structure for `deeptrip`
-- ----------------------------
DROP TABLE IF EXISTS `deeptrip`;
CREATE TABLE `deeptrip` (
  `deeptrip_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '深度旅行id',
  `user_id` int(11) DEFAULT NULL COMMENT '发布管理员的user_id',
  `deeptrip_city` varchar(255) DEFAULT NULL COMMENT '属于那个城市，A中国，B日本，C西班牙，D法国，E美国',
  `deeptrip_title` varchar(255) DEFAULT NULL COMMENT '深度旅行标题',
  `deeptrip_price` int(11) DEFAULT NULL COMMENT '深度旅行价格',
  `deeptrip_views` int(11) DEFAULT '0' COMMENT '深度旅行浏览量',
  `deeptrip_buy_num` int(11) DEFAULT NULL COMMENT '已经售出多少',
  `deeptrip_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '深度旅行开始时间',
  `deeptrip_info` text COMMENT '深度旅行介绍',
  `deeptrip_line_info` text COMMENT '深度旅行线路介绍',
  `deeptrip_message` text COMMENT '深度旅行购买须知',
  `deeptrip_photo` text,
  `deeptrip_conimg` text,
  PRIMARY KEY (`deeptrip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of deeptrip
-- ----------------------------
INSERT INTO `deeptrip` VALUES ('5', '3', '', 'xxx', '0', '0', null, '0000-00-00 00:00:00', '', '', '', '00906a4ebb7b292f30306cea92827618.jpg', 'undefined====b9f1a8fc89112317627ef8f3bd157914.jpg==d2726f4509655f042a6bc55a476b3476.jpg');

-- ----------------------------
-- Table structure for `insurance`
-- ----------------------------
DROP TABLE IF EXISTS `insurance`;
CREATE TABLE `insurance` (
  `insurance_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '保险id',
  `user_id` int(11) DEFAULT '1' COMMENT '发布者的id',
  `insurance_name` varchar(255) DEFAULT NULL COMMENT '保险内容',
  `insurance_price` int(11) DEFAULT '0' COMMENT '保险价格',
  `insurance_type` varchar(255) DEFAULT NULL COMMENT '保险类型，A旅游人身意外伤害险，B旅游意外伤害险，C旅游求援险',
  `insurance_views` int(11) DEFAULT '0' COMMENT '保险浏览数',
  `insurance_nums` int(11) DEFAULT '0' COMMENT '售出数量，默认为0',
  `insurance_phone` varchar(255) DEFAULT NULL,
  `insurance_content` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`insurance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of insurance
-- ----------------------------
INSERT INTO `insurance` VALUES ('1', '1', 'bbb', '123', 'A', '0', '0', 'asd', 'asdasd');
INSERT INTO `insurance` VALUES ('2', '1', 'asd', '123', 'A', '0', '0', '123', '123');

-- ----------------------------
-- Table structure for `letter`
-- ----------------------------
DROP TABLE IF EXISTS `letter`;
CREATE TABLE `letter` (
  `letter_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '私信id',
  `letter_content` text COMMENT '私信内容',
  `letter_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '私信时间',
  `letter_sid` int(11) DEFAULT NULL COMMENT '发送的人的id',
  `letter_rid` int(11) DEFAULT NULL COMMENT '接收人的id',
  PRIMARY KEY (`letter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of letter
-- ----------------------------

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订购id',
  `region_id` int(11) DEFAULT NULL COMMENT '对应区域的id',
  `deeptrip_id` int(11) DEFAULT NULL COMMENT '深度旅行id',
  `insurance_id` int(11) DEFAULT NULL COMMENT '保险id',
  `plane_ticket_id` int(11) DEFAULT NULL COMMENT '机票id',
  `order_user_id` int(11) DEFAULT NULL COMMENT '订购的人的用户id',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for `plane_route`
-- ----------------------------
DROP TABLE IF EXISTS `plane_route`;
CREATE TABLE `plane_route` (
  `plane_route_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '飞机线路id',
  `user_id` int(11) DEFAULT NULL COMMENT '发布者的id',
  `plane_route_start` varchar(255) DEFAULT NULL COMMENT '飞机线路起始城市',
  `plane_route_end` varchar(255) DEFAULT NULL COMMENT '飞机线路终止城市',
  PRIMARY KEY (`plane_route_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of plane_route
-- ----------------------------

-- ----------------------------
-- Table structure for `plane_ticket`
-- ----------------------------
DROP TABLE IF EXISTS `plane_ticket`;
CREATE TABLE `plane_ticket` (
  `plane_ticket_id` int(11) NOT NULL COMMENT '飞机票id',
  `plane_ticket_user_id` int(11) DEFAULT NULL COMMENT '购买票的人的id',
  `plane_ticket_price` int(11) DEFAULT NULL COMMENT '飞机票价格',
  `plane_ticket_route_id` int(11) DEFAULT NULL COMMENT '机票所属线路的id',
  `plane_ticket_starttime` varchar(255) DEFAULT NULL COMMENT '机票开始时间',
  `plane_ticket_num` int(11) DEFAULT '100' COMMENT '剩余机票数，默认100张',
  `plane_ticket_views` int(11) DEFAULT NULL COMMENT '该机票浏览次数',
  PRIMARY KEY (`plane_ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of plane_ticket
-- ----------------------------

-- ----------------------------
-- Table structure for `region`
-- ----------------------------
DROP TABLE IF EXISTS `region`;
CREATE TABLE `region` (
  `region_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '区域id',
  `city_id` int(11) DEFAULT NULL COMMENT '所属城市的id',
  `user_id` int(11) DEFAULT NULL COMMENT '发布者id',
  `region_type` varchar(255) DEFAULT NULL COMMENT '区域类型，A表示酒店，B表示餐厅，C景点玩乐',
  `region_name` varchar(255) DEFAULT NULL COMMENT '区域标题',
  `region_price` int(11) DEFAULT '0' COMMENT '如果区域内包含商品价格，则显示价格，否则为NUll',
  `region_cover` varchar(255) DEFAULT NULL COMMENT '区域封面',
  `region_pics` text COMMENT '多张相关图片',
  `region_info` text COMMENT '关于内容的介绍，如果没有为Null',
  `region_scrore` int(11) DEFAULT '5' COMMENT '评分',
  `region_type_ceil` int(255) DEFAULT '0' COMMENT '这个字段是给景点准备的，如果是热门景点则为1，普通为0，默认为0',
  PRIMARY KEY (`region_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of region
-- ----------------------------
INSERT INTO `region` VALUES ('1', '3', '3', 'C', 'asd', '123', 'ca8befa4ea2eaa850b84423c625b93c6.jpg', '==b07c63444e3ed758d031d7f5db65ca9c.jpg==963a0cbbf56c74e22c82b10ce86a8545.jpg==2f0620caf056dcf7ab3951c7576245d0.jpg', 'asd', '5', '0');
INSERT INTO `region` VALUES ('2', '3', '3', 'C', 'asd', '123', 'ca8befa4ea2eaa850b84423c625b93c6.jpg', '==b07c63444e3ed758d031d7f5db65ca9c.jpg==963a0cbbf56c74e22c82b10ce86a8545.jpg==2f0620caf056dcf7ab3951c7576245d0.jpg', 'asd', null, '0');
INSERT INTO `region` VALUES ('3', '3', '3', 'C', 'asd', '123', 'ca8befa4ea2eaa850b84423c625b93c6.jpg', '==b07c63444e3ed758d031d7f5db65ca9c.jpg==963a0cbbf56c74e22c82b10ce86a8545.jpg==2f0620caf056dcf7ab3951c7576245d0.jpg', 'asd', null, '0');
INSERT INTO `region` VALUES ('4', '3', '3', 'C', 'asd', '123', 'ca8befa4ea2eaa850b84423c625b93c6.jpg', '==b07c63444e3ed758d031d7f5db65ca9c.jpg==963a0cbbf56c74e22c82b10ce86a8545.jpg==2f0620caf056dcf7ab3951c7576245d0.jpg', 'asd', null, '0');
INSERT INTO `region` VALUES ('6', '0', '3', '', '', '0', '008d051329c471204430f63e8c1290f0.jpg', '==f185aeeca98225bba97be90daca10fb8.jpg', '', null, '0');
INSERT INTO `region` VALUES ('7', '0', '3', '', '', '0', '', '', '', null, '0');
INSERT INTO `region` VALUES ('9', '0', '3', '', '', '0', 'fb425d2fc753fce26ed8dd4898394907.jpg', '==35c3157efcc7b2c3d07d44ffcbd1c0b3.jpg', '', '5', '0');
INSERT INTO `region` VALUES ('10', '0', '3', '', '', '0', 'faeddddbdbf7ad72b9f98e83beba4c42.jpg', '==f62b309143214359f4c90261838bcb15.jpg', '', '5', '0');
INSERT INTO `region` VALUES ('14', '0', '3', '', '', '0', '7b5a54e55d890404bdda9bcb78858edb.jpg', '', '', '5', '0');
INSERT INTO `region` VALUES ('23', '0', '3', '', '', '0', '44d823d77c6784ec14e4f6053dff5800.jpg', '==d56e7f09881b5e387f4d3d04cebdc46f.jpg', '', '5', '0');
INSERT INTO `region` VALUES ('24', '0', '3', '', '', '0', '98084a97860cac76e879a291a89f03fb.jpg', '==838f2b5fbed47be175a384e43673f490.jpg', '', '5', '0');
INSERT INTO `region` VALUES ('25', '0', '3', '', '', '0', '', '==a81d354b3e31847ca72d03ee801d1d81.jpg==f8bec7b403595fbe8cf7b7c333918e20.jpg==e8eab748ee927034b00c4ae17f87ad6a.jpg', '', '5', '0');
INSERT INTO `region` VALUES ('26', '0', '3', '', '', '0', '0d6b902a7c4b7edd7dfbd8de93df7c21.jpg', '==97735d8a3ae1f78aa3efe7f81b88260c.jpg', '', '5', '0');
INSERT INTO `region` VALUES ('27', '0', '3', '', '', '0', '67064e8c488b082e26f73799fe3598a9.jpg', '==aca16ab16b1db0db830d53d383e505a4.jpg', '', '5', '0');
INSERT INTO `region` VALUES ('28', '0', '3', '', '', '0', '54a2e1eea16a84ef7ce8dac903bef923.jpg', '==8df0dae940b7918c0db80e5c855d2f26.jpg==e1c1b2d74cbad150e6ddcdbbe66ecae9.jpg', '', '5', '0');
INSERT INTO `region` VALUES ('29', '0', '3', '', '', '0', '19e0d743b0e6836bea8a11650fae414a.jpg', '', '', '5', '0');
INSERT INTO `region` VALUES ('30', '0', '3', '', '', '0', '88661cf1804f7a7d163447c401abe6b3.jpg', '==7de8967882abd46256bd4210fcc59094.jpg==a9455ddd6e9b0dd18bcc03d297b2db92.jpg==dd69a1c024668441124cd7339e17ba02.jpg', '', '5', '0');
INSERT INTO `region` VALUES ('31', '0', '3', '', '', '0', '4d900f635ecc579899277204d1b0988f.jpg', '', '', '5', '0');
INSERT INTO `region` VALUES ('32', '0', '3', '', '', '0', 'b49d9f424bcbd94dc05bc5f701dddd42.jpg', '', '', '5', '0');
INSERT INTO `region` VALUES ('33', '0', '3', '', '', '0', '751d7d155759f521b84ed9ab0f0cd865.jpg', '', '', '5', '0');
INSERT INTO `region` VALUES ('34', '0', '3', '', '', '0', '41fcd97bab0daadc55f3b986598fd747.jpg', '', '', '5', '0');
INSERT INTO `region` VALUES ('35', '0', '3', '', '', '0', 'abaceb7b2739362826cdc4ed3b6dec7e.jpg', '', '', '5', '0');
INSERT INTO `region` VALUES ('36', '0', '3', '', '', '0', '6f9e9d296078ab08339ce5ac7a6297b4.jpg', '', '', '5', '0');
INSERT INTO `region` VALUES ('37', '0', '3', '', '', '0', '736a573fb69a3e6eacd2cf5a76ff75ba.jpg', '', '', '5', '0');
INSERT INTO `region` VALUES ('38', '0', '3', '', '', '0', 'e4d10fd0fc443731ebe2ab7ea4f1589d.jpg', '', '', '5', '0');
INSERT INTO `region` VALUES ('39', '0', '3', '', '', '0', '9156f24b88a52760448cdad88365af06.jpg', '', '', '5', '0');
INSERT INTO `region` VALUES ('42', '2', '3', 'B', 'asd', '123', '', '', '', '5', '0');
INSERT INTO `region` VALUES ('43', '2', '3', 'B', 'asd', '123', '', '', '', '5', '0');
INSERT INTO `region` VALUES ('44', '2', '3', 'B', 'asd', '123', '', '', '', '5', '0');
INSERT INTO `region` VALUES ('45', '2', '3', 'B', 'asd', '123', '', '', '', '5', '0');
INSERT INTO `region` VALUES ('46', '1', '3', 'A', 'asd', '211', 'b740322207fcaafbaf7acac934560bd3.jpg', '==e7dfd3e12a730b3f175c4ab07213683e.jpg==40922f016b96c5b8f5f0158f5edea672.jpg==51a9f01f31e8f809204db3252262c154.jpg==7f80798e82158b13ce7a96b332847c2d.jpg', '', '5', '0');
INSERT INTO `region` VALUES ('47', '2', '3', 'A', 'asdmm', '211', '58d63bbb83f45a15d186fd7edbaf77c8.jpg', '==cf33f352cb7729d5c1d5d5441afdc130.jpg', '', '5', '0');
INSERT INTO `region` VALUES ('48', '1', '3', 'A', '', '0', '', '', '', '5', '0');
INSERT INTO `region` VALUES ('49', '2', '3', 'A', 'asd', '22', '3ec430db12998cebd9343019cc00e9a7.jpg', '==1c1c6c251722b6d3dc2e0770537bdf8e.jpg==7461261c50e9acb97a69413d066838f6.jpg', 'asdasd', '5', '0');
INSERT INTO `region` VALUES ('50', '1', '3', 'A', 'kjask', '0', '51e230b050be4dad69a1c923aa553f3f.jpg', '==bff453e40b3dc8504cfce30bf41349e5.jpg==35aa26be2dcdccdc7378ada35f9d5490.jpg==97bd41f6351cf53ca39b70504b5e33e9.jpg==9d1310af24f20f45fdc73214b965e9ce.jpg==4436adb491cd8ccbab1f1fe25ad7dfcc.jpg==7f74ebe81ae6ed3c83ec0bc6463a3a99.jpg==83bfaea737b9b1fdec7673741b1748bb.jpg', 'aksjdkjasd', '5', '0');
INSERT INTO `region` VALUES ('51', '1', '3', 'A', 'asd', '0', '3fafd317f4a894c5146e5e6682ad195d.jpg', '', 'asd', '5', '0');
INSERT INTO `region` VALUES ('52', '0', '3', '', '', '0', '0a13eb3ad1e081d1b40cbfa99eec3302.jpg', '', '', '5', '0');
INSERT INTO `region` VALUES ('53', '0', '3', '', '', '0', '6551e0fdd18c832c8cc6584fcceb5e1b.jpg', '==0120efe4ee967b8bb7ed0f5cbdbe705c.jpg==d319c54c643e7be37106edee244a7cd3.jpg==ebc0bedb39e24bb46017ecd0e3b23f8c.jpg', '', '5', '0');
INSERT INTO `region` VALUES ('54', '1', '3', 'A', 'asdasd', '0', '', '==8d7ba77a06fbca586eed52d068f43bc6.jpg==68198637eb8168e7c96dfaa84b63402d.jpg==9d8ae27805437179148a1ff66ba0f382.jpg', '', '5', '0');

-- ----------------------------
-- Table structure for `region_reply`
-- ----------------------------
DROP TABLE IF EXISTS `region_reply`;
CREATE TABLE `region_reply` (
  `region_reply_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论id',
  `region_id` int(11) DEFAULT NULL COMMENT '对应区域的id',
  `region_reply_user_id` int(11) DEFAULT NULL,
  `region_reply_type` varchar(255) DEFAULT NULL COMMENT 'A为酒店评论，B为餐厅评论，C为景点评论',
  `region_reply_content` text COMMENT '评论内容',
  `region_reply_time` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT '评论时间，这里存的是具体时间，2018-7-1',
  `region_reply_score` int(11) DEFAULT NULL COMMENT '评论时带过来的分数',
  PRIMARY KEY (`region_reply_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of region_reply
-- ----------------------------
INSERT INTO `region_reply` VALUES ('1', '1', '3', 'C', '测试评论内容', '2018-07-17 00:00:00', '5');
INSERT INTO `region_reply` VALUES ('2', '1', '3', 'C', 'ASD', '2018-07-17 00:00:00', '3');
INSERT INTO `region_reply` VALUES ('3', '1', '4', 'C', 'asd', '0000-00-00 00:00:00', '5');

-- ----------------------------
-- Table structure for `strategy`
-- ----------------------------
DROP TABLE IF EXISTS `strategy`;
CREATE TABLE `strategy` (
  `strategy_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '攻略id',
  `user_id` int(11) DEFAULT NULL COMMENT '发布者的id',
  `strategy_title` varchar(255) DEFAULT NULL COMMENT '攻略标题',
  `strategy_content` text COMMENT '攻略内容',
  `strategy_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '攻略时间',
  `strategy_cover` text COMMENT '攻略封面',
  `strategy_type` varchar(255) DEFAULT NULL COMMENT 'A国内,B国外',
  PRIMARY KEY (`strategy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of strategy
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `user_tel` varchar(255) DEFAULT NULL COMMENT '用户电话',
  `user_cover` text COMMENT '用户头像',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('3', 'vin', '202cb962ac59075b964b07152d234b70', null, null);
INSERT INTO `user` VALUES ('4', 'vins', '202cb962ac59075b964b07152d234b70', null, null);
INSERT INTO `user` VALUES ('5', 'haha', '202cb962ac59075b964b07152d234b70', null, null);
INSERT INTO `user` VALUES ('6', 'hahas', '202cb962ac59075b964b07152d234b70', null, null);
INSERT INTO `user` VALUES ('7', 'hahasb', '202cb962ac59075b964b07152d234b70', null, null);
INSERT INTO `user` VALUES ('8', 'asd', '7815696ecbf1c96e6894b779456d330e', null, null);
INSERT INTO `user` VALUES ('9', 'a;lskdl;', '6aeddf578fd2932f7e9fd8a34abe5571', null, null);
INSERT INTO `user` VALUES ('10', 'kaka', '7f6ffaa6bb0b408017b62254211691b5', null, null);
INSERT INTO `user` VALUES ('11', 'kaka', '202cb962ac59075b964b07152d234b70', null, null);
INSERT INTO `user` VALUES ('12', 'kaka', '552effa0980dcec34d29ca4ad27a11e0', null, null);
INSERT INTO `user` VALUES ('13', 'asdklj', '24da0454b807374c7a77b817841017a1', null, null);
INSERT INTO `user` VALUES ('14', 'a;lsdlkj', 'bb67ccab5e1ec10266f249237ce84ea3', null, null);
INSERT INTO `user` VALUES ('15', 'lasdlj', '6a9f5fa874beb16a33f5dc6d274332d8', null, null);
INSERT INTO `user` VALUES ('16', 'lkajsdlkjaklsjd', 'a8f5f167f44f4964e6c998dee827110c', null, null);
INSERT INTO `user` VALUES ('17', 'lkajsdkljkl', '30f30916ee0686b44f23a516c5be0a49', null, null);
INSERT INTO `user` VALUES ('18', 'ppp', '202cb962ac59075b964b07152d234b70', null, null);
INSERT INTO `user` VALUES ('19', 'asdasd', 'd25db4ce54b60b49dfd7b32c52ed8d26', null, null);
