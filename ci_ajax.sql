/*
Navicat MySQL Data Transfer

Source Server         : xampp
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : ci_ajax

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-06-27 10:30:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `01_users`
-- ----------------------------
DROP TABLE IF EXISTS `01_users`;
CREATE TABLE `01_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name_bn` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `user_type` varchar(30) NOT NULL,
  `table_id` int(11) NOT NULL DEFAULT '0',
  `user_group_id` int(11) NOT NULL,
  `campus` tinyint(4) NOT NULL DEFAULT '0',
  `template_id` tinyint(4) NOT NULL DEFAULT '1',
  `language_id` tinyint(4) DEFAULT '1',
  `designation` varchar(255) DEFAULT '0',
  `gender` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `office_phone` varchar(30) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `national_id_no` varchar(30) NOT NULL,
  `present_address` text NOT NULL,
  `permanent_address` text NOT NULL,
  `picture_alt` varchar(100) NOT NULL,
  `picture_name` varchar(200) NOT NULL,
  `notifiacation` tinyint(4) DEFAULT NULL,
  `create_by` int(11) NOT NULL,
  `dob` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_date` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 01_users
-- ----------------------------
INSERT INTO `01_users` VALUES ('1', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'পরিচালক', 'Super Admin', '', '0', '1', '0', '1', '2', '0', 'male', '00000000000', '', '', 'islambuet@gmail.com', '', '', '', '', '', null, '0', '0', '0', '0', '0', '1');

-- ----------------------------
-- Table structure for `02_user_group`
-- ----------------------------
DROP TABLE IF EXISTS `02_user_group`;
CREATE TABLE `02_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_bn` varchar(300) NOT NULL,
  `name_en` varchar(300) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` int(150) NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_date` int(150) NOT NULL,
  `ordering` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 02_user_group
-- ----------------------------
INSERT INTO `02_user_group` VALUES ('1', 'সিস্টেম পরিচালক', 'Super Admin', '0', '0', '0', '0', '1', '1');
INSERT INTO `02_user_group` VALUES ('2', 'admin bn', 'Admin', '0', '0', '1', '1425475138', '2', '1');

-- ----------------------------
-- Table structure for `03_component`
-- ----------------------------
DROP TABLE IF EXISTS `03_component`;
CREATE TABLE `03_component` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(300) NOT NULL,
  `name_bn` varchar(400) NOT NULL,
  `icon` varchar(400) NOT NULL DEFAULT 'tasks fa-fw',
  `description` varchar(400) NOT NULL,
  `ordering` int(11) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` int(150) NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_date` int(150) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 03_component
-- ----------------------------
INSERT INTO `03_component` VALUES ('1', 'System', 'সিষ্টেম', 'glyphicon glyphicon-asterisk', 'system dis', '1', '0', '0', '1', '1425367278', '1');
INSERT INTO `03_component` VALUES ('2', 'User', 'ইউজার', 'fa fa-user fa-fw', '', '2', '1', '1426053662', '1', '1426055286', '1');

-- ----------------------------
-- Table structure for `04_module`
-- ----------------------------
DROP TABLE IF EXISTS `04_module`;
CREATE TABLE `04_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component_id` int(30) NOT NULL,
  `name_en` varchar(400) NOT NULL,
  `name_bn` varchar(400) NOT NULL,
  `icon` varchar(255) DEFAULT 'fa fa-tasks fa-fw',
  `description` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` int(150) NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_date` int(150) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 04_module
-- ----------------------------
INSERT INTO `04_module` VALUES ('1', '1', 'System Settings', 'সেটিং', 'glyphicon glyphicon-cog', 'setup module', '1', '0', '0', '1', '1425367432', '1');
INSERT INTO `04_module` VALUES ('2', '1', 'Institue Settings', 'প্রতিষ্ঠান ব্যবস্থাপনা', 'fa fa-university', '', '2', '1', '1426054131', '1', '1426055350', '1');
INSERT INTO `04_module` VALUES ('4', '2', 'User Management', 'ব্যাবহারকারী ব্যাবস্থাপনা', 'fa fa-user-plus', '', '1', '1', '1426054276', '0', '0', '1');
INSERT INTO `04_module` VALUES ('5', '2', 'User Group', 'ইউজার গ্রুপ', 'fa fa-archive', '', '2', '1', '1426054526', '1', '1426055367', '1');

-- ----------------------------
-- Table structure for `05_task`
-- ----------------------------
DROP TABLE IF EXISTS `05_task`;
CREATE TABLE `05_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component_id` int(15) NOT NULL,
  `module_id` int(15) NOT NULL,
  `name_en` varchar(300) NOT NULL,
  `name_bn` varchar(400) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(400) NOT NULL DEFAULT 'fa fa-tasks fa-fw',
  `controller` varchar(400) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '999',
  `position_left_01` tinyint(4) NOT NULL,
  `position_top_01` tinyint(4) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` int(150) NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_date` int(150) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 05_task
-- ----------------------------
INSERT INTO `05_task` VALUES ('1', '1', '1', 'Component', 'কম্পোনেন্ট', 'tast component', 'fa fa-star', 'system_setup/Component', '1', '1', '0', '0', '0', '1', '1427779727', '1');
INSERT INTO `05_task` VALUES ('2', '1', '1', 'Module', 'মডিউল', 'TASK MODULE', 'fa fa-chain-broken', 'system_setup/Module', '2', '1', '0', '0', '0', '1', '1427779757', '1');
INSERT INTO `05_task` VALUES ('3', '1', '1', 'Task', 'টাস্ক', 'TASK task', 'fa fa-text-height ', 'system_setup/Task', '3', '1', '0', '0', '0', '1', '1427785365', '1');
INSERT INTO `05_task` VALUES ('4', '2', '4', 'Logout ', 'লগ আউট ', '', 'fa fa-exclamation-triangle', 'Home/logout', '1', '0', '1', '1', '1426055156', '1', '1427779895', '1');
INSERT INTO `05_task` VALUES ('6', '2', '5', 'User Group Management', 'User Group Management', '', 'fa fa-cubes', 'user_group/User_group_management', '1', '1', '0', '1', '1426055504', '1', '1434788429', '1');
INSERT INTO `05_task` VALUES ('7', '2', '5', 'User Role Assignment ', 'User Role Assignment ', '', 'fa fa-unlock-alt', 'user_group/User_role', '1', '1', '0', '1', '1426055541', '1', '1427780054', '1');
INSERT INTO `05_task` VALUES ('8', '2', '4', 'User Create', 'User Create', '', 'fa fa-users', 'user_management/User_create', '2', '1', '0', '1', '1434779168', '0', '0', '1');

-- ----------------------------
-- Table structure for `06_user_group_role`
-- ----------------------------
DROP TABLE IF EXISTS `06_user_group_role`;
CREATE TABLE `06_user_group_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `list` tinyint(4) NOT NULL DEFAULT '0',
  `view` tinyint(4) NOT NULL DEFAULT '0',
  `add` tinyint(4) NOT NULL DEFAULT '0',
  `edit` tinyint(4) NOT NULL DEFAULT '0',
  `delete` tinyint(4) NOT NULL DEFAULT '0',
  `report` tinyint(4) NOT NULL DEFAULT '0',
  `print` tinyint(4) NOT NULL DEFAULT '0',
  `create_by` int(11) NOT NULL,
  `create_date` int(150) NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_date` int(150) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of 06_user_group_role
-- ----------------------------
INSERT INTO `06_user_group_role` VALUES ('1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('2', '1', '1', '1', '2', '1', '1', '1', '1', '1', '1', '1', '0', '0', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('3', '1', '1', '1', '3', '1', '1', '1', '1', '1', '1', '1', '0', '0', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('4', '1', '2', '2', '7', '1', '1', '1', '1', '1', '1', '1', '0', '0', '0', '0', '1');
INSERT INTO `06_user_group_role` VALUES ('5', '1', '1', '1', '4', '1', '1', '1', '1', '1', '1', '1', '1', '1426055776', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('6', '1', '2', '4', '5', '1', '1', '1', '1', '1', '1', '1', '1', '1426055776', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('7', '1', '2', '5', '6', '1', '1', '1', '1', '1', '1', '1', '1', '1426055776', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('8', '1', '3', '6', '8', '1', '1', '1', '1', '1', '1', '1', '1', '1426057325', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('9', '1', '3', '6', '9', '1', '1', '1', '1', '1', '1', '1', '1', '1426057325', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('10', '1', '3', '6', '10', '1', '1', '1', '1', '1', '1', '1', '1', '1426057325', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('11', '1', '3', '6', '11', '1', '1', '1', '1', '1', '1', '1', '1', '1426057325', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('12', '1', '3', '6', '12', '1', '1', '1', '1', '1', '1', '1', '1', '1426057325', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('13', '1', '3', '7', '13', '1', '1', '1', '1', '1', '1', '1', '1', '1426057325', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('14', '1', '3', '7', '14', '1', '1', '1', '1', '1', '1', '1', '1', '1426057325', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('15', '1', '3', '7', '15', '1', '1', '1', '1', '1', '1', '1', '1', '1426057325', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('16', '1', '3', '8', '16', '1', '1', '1', '1', '1', '1', '1', '1', '1426057325', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('17', '1', '3', '8', '17', '1', '1', '1', '1', '1', '1', '1', '1', '1426057325', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('18', '1', '4', '9', '18', '1', '1', '1', '1', '1', '1', '1', '1', '1426057325', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('19', '1', '5', '10', '19', '1', '1', '1', '1', '1', '1', '1', '1', '1426057325', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('20', '1', '6', '11', '20', '1', '1', '1', '1', '1', '1', '1', '1', '1426057325', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('21', '1', '6', '11', '21', '1', '1', '1', '1', '1', '1', '1', '1', '1426057325', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('22', '1', '6', '11', '22', '1', '1', '1', '1', '1', '1', '1', '1', '1426057325', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('23', '1', '2', '4', '23', '1', '1', '1', '1', '1', '1', '1', '1', '1426076401', '1', '1433746297', '1');
INSERT INTO `06_user_group_role` VALUES ('24', '1', '5', '12', '24', '1', '1', '1', '1', '1', '1', '1', '1', '1426333253', '1', '1433746297', '1');

-- ----------------------------
-- Table structure for `sys_01_language`
-- ----------------------------
DROP TABLE IF EXISTS `sys_01_language`;
CREATE TABLE `sys_01_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `language_code` varchar(15) NOT NULL,
  `create_ by` int(11) NOT NULL,
  `create_date` int(150) NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_date` int(150) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_01_language
-- ----------------------------
INSERT INTO `sys_01_language` VALUES ('1', 'bangla', 'bn', '0', '0', '0', '0', '1');
INSERT INTO `sys_01_language` VALUES ('2', 'english', 'en', '1', '0', '0', '0', '1');

-- ----------------------------
-- Table structure for `sys_02_template`
-- ----------------------------
DROP TABLE IF EXISTS `sys_02_template`;
CREATE TABLE `sys_02_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` int(150) NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_date` int(150) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_02_template
-- ----------------------------
INSERT INTO `sys_02_template` VALUES ('1', 'default', '0', '0', '0', '0', '1');
INSERT INTO `sys_02_template` VALUES ('2', 'mazba', '1', '0', '0', '0', '1');

-- ----------------------------
-- Table structure for `sys_03_session`
-- ----------------------------
DROP TABLE IF EXISTS `sys_03_session`;
CREATE TABLE `sys_03_session` (
  `id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  PRIMARY KEY (`id`,`ip_address`,`user_agent`),
  KEY `last_activity_idx` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_03_session
-- ----------------------------
INSERT INTO `sys_03_session` VALUES ('1d28924ef4fc0874f1ed9b09409a9af6a9c6ca3b', '::1', '', '1434788699', '__ci_last_regenerate|i:1434788461;system_user_id|s:1:\"1\";');
INSERT INTO `sys_03_session` VALUES ('21234166bf7b65a1bcfe4eba961eda782d1d93f6', '::1', '', '1434782139', '__ci_last_regenerate|i:1434780883;desk_user_id|s:1:\"1\";');
INSERT INTO `sys_03_session` VALUES ('5391199eea008c8afd0d944fb31279ef55d2506b', '::1', '', '1434788444', '__ci_last_regenerate|i:1434788376;system_user_id|s:1:\"1\";');
INSERT INTO `sys_03_session` VALUES ('6fb79e53362f86fcfd8170db800624f9268e780c', '::1', '', '1434779177', '__ci_last_regenerate|i:1434778967;desk_user_id|s:1:\"1\";');
INSERT INTO `sys_03_session` VALUES ('7a7ef441c5d335af3260961757c07856eaf880d3', '::1', '', '1434780291', '__ci_last_regenerate|i:1434779327;desk_user_id|s:1:\"1\";');
INSERT INTO `sys_03_session` VALUES ('8575fac7331ae66bb3ccc110a59245c07c2bc857', '::1', '', '1434787738', '__ci_last_regenerate|i:1434787104;system_user_id|s:1:\"1\";');
INSERT INTO `sys_03_session` VALUES ('874d78942d036bb2bfa3bd097d38cb039340b3dd', '::1', '', '1434784905', '__ci_last_regenerate|i:1434782227;desk_user_id|s:1:\"1\";');
INSERT INTO `sys_03_session` VALUES ('a6cfc41a2bd2d3735e8c195d8b52cfcd12a142e3', '::1', '', '1434778958', '__ci_last_regenerate|i:1434778650;desk_user_id|s:1:\"1\";');
INSERT INTO `sys_03_session` VALUES ('c1154979b1127be4d132fd61a337cb535e8255d1', '::1', '', '1434789395', '__ci_last_regenerate|i:1434789381;system_user_id|s:1:\"1\";');
INSERT INTO `sys_03_session` VALUES ('cc99921a4e52c78431d72f567ee0e420270fb38c', '::1', '', '1434787808', '__ci_last_regenerate|i:1434787740;system_user_id|s:1:\"1\";');
INSERT INTO `sys_03_session` VALUES ('d332b6caf4be99ca3bf1170d0439beee6fbf2957', '::1', '', '1434778601', '__ci_last_regenerate|i:1434778601;');
INSERT INTO `sys_03_session` VALUES ('e3465a80dfc4b53375aaa8f5778656efda1be831', '::1', '', '1434780881', '__ci_last_regenerate|i:1434780293;desk_user_id|s:1:\"1\";');

-- ----------------------------
-- Table structure for `sys_04_history`
-- ----------------------------
DROP TABLE IF EXISTS `sys_04_history`;
CREATE TABLE `sys_04_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `data` varchar(255) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `action` varchar(20) NOT NULL,
  `query` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_04_history
-- ----------------------------
INSERT INTO `sys_04_history` VALUES ('1', '8', 'desk_05_task', '{\"name_en\":\"User Create\",\"name_bn\":\"User Create\",\"component_id\":\"2\",\"module_id\":\"4\",\"controller\":\"user_management\\/User_create\",\"icon\":\"fa fa-users\",\"position_left_01\":1,\"position_top_01\":0,\"description\":\"\",\"status\":\"1\",\"ordering\":\"2\",\"create_by\":\"1\",\"cre', '1', 'INSERT', 'INSERT INTO `desk_05_task` (`name_en`, `name_bn`, `component_id`, `module_id`, `controller`, `icon`, `position_left_01`, `position_top_01`, `description`, `status`, `ordering`, `create_by`, `create_date`) VALUES (\'User Create\', \'User Create\', \'2\', \'4\', \'u', '0', '1434779168');
INSERT INTO `sys_04_history` VALUES ('2', '3', '03_component', '{\"name_en\":\"TEST component\",\"name_bn\":\"TEST component\",\"icon\":\"sdfs\",\"description\":\"fds\",\"ordering\":\"1\",\"status\":\"1\",\"create_by\":\"1\",\"create_date\":1434788376}', '1', 'INSERT', 'INSERT INTO `03_component` (`name_en`, `name_bn`, `icon`, `description`, `ordering`, `status`, `create_by`, `create_date`) VALUES (\'TEST component\', \'TEST component\', \'sdfs\', \'fds\', \'1\', \'1\', \'1\', 1434788376)', '0', '1434788376');
INSERT INTO `sys_04_history` VALUES ('3', '3', '03_component', '{\"status\":99,\"update_by\":\"1\",\"update_date\":1434788382}', '1', 'UPDATE', 'UPDATE `03_component` SET `status` = 99, `update_by` = \'1\', `update_date` = 1434788382\nWHERE `id` = 3', '0', '1434788382');
INSERT INTO `sys_04_history` VALUES ('4', '6', '05_task', '{\"name_en\":\"User Group Management_\",\"name_bn\":\"User Group Management\",\"component_id\":\"2\",\"module_id\":\"5\",\"controller\":\"user_group\\/User_group_management\",\"icon\":\"fa fa-cubes\",\"position_left_01\":1,\"position_top_01\":0,\"description\":\"\",\"status\":\"1\",\"ordering', '1', 'UPDATE', 'UPDATE `05_task` SET `name_en` = \'User Group Management_\', `name_bn` = \'User Group Management\', `component_id` = \'2\', `module_id` = \'5\', `controller` = \'user_group/User_group_management\', `icon` = \'fa fa-cubes\', `position_left_01` = 1, `position_top_01` =', '0', '1434788425');
INSERT INTO `sys_04_history` VALUES ('5', '6', '05_task', '{\"name_en\":\"User Group Management\",\"name_bn\":\"User Group Management\",\"component_id\":\"2\",\"module_id\":\"5\",\"controller\":\"user_group\\/User_group_management\",\"icon\":\"fa fa-cubes\",\"position_left_01\":1,\"position_top_01\":0,\"description\":\"\",\"status\":\"1\",\"ordering\"', '1', 'UPDATE', 'UPDATE `05_task` SET `name_en` = \'User Group Management\', `name_bn` = \'User Group Management\', `component_id` = \'2\', `module_id` = \'5\', `controller` = \'user_group/User_group_management\', `icon` = \'fa fa-cubes\', `position_left_01` = 1, `position_top_01` = ', '0', '1434788429');
