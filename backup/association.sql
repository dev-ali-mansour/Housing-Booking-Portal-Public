-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2019 at 09:27 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `association`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_get_max_deposit_id` ()  SELECT MAX(`id`) FROM `deposits`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_deposit` (IN `depositId` INT, IN `memberId` INT, IN `projectId` INT, IN `currentDate` DATE, IN `bankDate` DATE, IN `bankNo` VARCHAR(250), IN `pre` DECIMAL(10,2), IN `monthly` DECIMAL(10,2), IN `quarterly` DECIMAL(10,2), IN `semi_annual` DECIMAL(10,2), IN `annual` DECIMAL(10,2), IN `contract` DECIMAL(10,2), IN `allocation` DECIMAL(10,2), IN `receipt` DECIMAL(10,2), IN `description` TEXT CHARSET utf8)  INSERT INTO `deposits`(`id`, `member_id`, `project_id`, `date`, `bank_receipt_date`,`bank_receipt_no`, `pre`, `monthly`, `quarterly`, `semi_annual`, `annual`, `contract`, `allocation`, `receipt`, `description`) VALUES (depositId,memberId,projectId,currentDate,bankDate,bankNo,pre,monthly,quarterly,semi_annual,annual,contract,allocation,receipt,description)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_member` (IN `fullName` VARCHAR(150) CHARSET utf8, IN `nationalId` VARCHAR(14) CHARSET utf8, IN `membership` INT(1), IN `telephone` VARCHAR(11) CHARSET utf8, IN `notes` TEXT CHARSET utf8)  INSERT INTO `members`(`full_name`, `national_id`, `membership`, `telephone`, `notes`) VALUES (fullName,nationalId,membership,telephone,notes)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_project` (IN `projectName` VARCHAR(150) CHARSET utf8, IN `description` TEXT CHARSET utf8, IN `flatCount` INT)  INSERT INTO `projects`(`name`, `description`, `flat_count`)
VALUES (projectName, description, flatCount)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_reservation` (IN `memberId` INT, IN `projectId` INT, IN `buildingNo` VARCHAR(5) CHARSET utf8, IN `floorNo` INT, IN `flatNo` INT, IN `area` DECIMAL(10), IN `notes` TEXT CHARSET utf8)  INSERT INTO `reservation`(`member_id`, `project_id`, `building_no`, `floor_no`, `flat_no`, `area`, `notes`) VALUES (memberId, projectId, buildingNo, floorNo, flatNo, area, notes)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_user` (IN `fullName` VARCHAR(150) CHARSET utf8, IN `userName` VARCHAR(60) CHARSET utf8, IN `userPass` VARCHAR(60) CHARSET utf8, IN `email` VARCHAR(120) CHARSET utf8, IN `groupId` INT, IN `isDisabled` TINYINT, IN `notes` TEXT CHARSET utf8)  INSERT INTO `users`(full_name, user_name, user_pass,email , group_id, is_disabled, notes)
VALUES (fullName,userName,md5(userPass),email,groupId,isDisabled,notes)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_users_group` (IN `groupName` VARCHAR(60) CHARSET utf8, IN `adminPermission` TINYINT, IN `addPermission` TINYINT, IN `updatePermission` TINYINT, IN `viewPermission` TINYINT, IN `notes` TEXT CHARSET utf8)  INSERT INTO `users_groups`(`name`, `admin_permission`, `add_permission`, `update_permission`, `view_permission`, `notes`) VALUES (groupName, adminPermission, addPermission, updatePermission, viewPermission, notes)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_count_active_users` ()  SELECT COUNT(*) FROM `users` WHERE `is_disabled` = false AND `is_locked` = false$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_count_all_deposits` ()  SELECT COUNT(*) FROM `deposits`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_count_all_flats` ()  SELECT SUM(`flat_count`) FROM `projects`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_count_all_members` ()  SELECT COUNT(*) FROM `members`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_count_all_projects` ()  SELECT COUNT(*) FROM `projects`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_count_all_reservations` ()  SELECT COUNT(*) FROM `reservation`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_count_all_users` ()  SELECT COUNT(*) FROM `users`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_count_all_users_groups` ()  SELECT COUNT(*) FROM `users_groups`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_count_founder_members` ()  SELECT COUNT(*) FROM `members` WHERE `membership`=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_count_group_users` (IN `groupId` INT)  SELECT COUNT(*)FROM `users` WHERE group_id = groupId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_count_inactive_users` ()  SELECT COUNT(*) FROM `users` WHERE `is_disabled` = true OR `is_locked` = true$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_count_project_reservations` (IN `projectId` INT)  SELECT COUNT(*) FROM `reservation` WHERE `project_id`=projectId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_count_project_unreserved_flats` (IN `projectId` INT)  SELECT ((SELECT `flat_count` FROM `projects` WHERE `id`=projectId) - (SELECT COUNT(*) FROM `reservation` WHERE `project_id`=projectId)) as unreserved$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_count_reserved_flats` ()  SELECT COUNT(*) FROM `reservation`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_count_unreserved_flats` ()  SELECT ((SELECT SUM(`flat_count`) FROM `projects`) - (SELECT COUNT(*) FROM `reservation`)) as unreserved$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_count_worker_members` ()  SELECT COUNT(*) FROM `members` WHERE `membership`=2$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_delete_deposit` (IN `depositId` INT)  DELETE FROM `deposits` WHERE `id`=depositId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_delete_member` (IN `userId` INT(11))  DELETE FROM `members` WHERE `id`=userId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_delete_project` (IN `projectId` INT)  DELETE FROM `projects` WHERE `id`=projectId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_delete_reservation` (IN `reservationId` INT)  DELETE FROM `reservation` WHERE `id`=reservationId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_delete_user` (IN `userId` INT)  DELETE FROM `users` WHERE `id` =userId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_delete_users_group` (IN `groupId` INT)  DELETE FROM `users_groups` WHERE `id` =groupId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_find_all_deposits` ()  SELECT `deposits`.`id`,`deposits`.`member_id`, DATE_FORMAT(`deposits`.`date`, '%Y-%m-%d')AS'date', `deposits`.`bank_receipt_date`, `deposits`.`bank_receipt_no`, `members`.`full_name`, `deposits`.`pre`, `deposits`.`monthly`, `deposits`.`quarterly`, `deposits`.`semi_annual`, `deposits`.`annual`, `deposits`.`contract`, `deposits`.`allocation`, `deposits`.`receipt`, SUM(`deposits`.`pre`+`deposits`.`monthly`+`deposits`.`quarterly`+`deposits`.`semi_annual`+`deposits`.`annual`+`deposits`.`contract`+`deposits`.`allocation`+`deposits`.`receipt`) AS 'total',`deposits`.`description`
FROM `deposits` INNER JOIN `members`
ON `deposits`.`member_id` = `members`.`id`
GROUP BY `deposits`.`id`
ORDER BY `deposits`.`id`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_find_all_members` ()  SELECT `id`, `full_name`, `national_id`, `membership`, `telephone`, `notes`
FROM `members`
ORDER BY `members`.`id`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_find_all_projects` ()  SELECT `id`, `name`, `description`, `flat_count` FROM `projects`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_find_all_reservations` ()  SELECT `reservation`.`id`, `members`.`full_name`, `projects`.`name`, `reservation`.`building_no`, `reservation`.`floor_no`, `reservation`.`flat_no`, `reservation`.`area`, `reservation`.`notes` FROM `reservation`
INNER JOIN `members`
ON `reservation`.`member_id` = `members`.`id`
INNER JOIN `projects`
ON `reservation`.`project_id`=`projects`.`id`
ORDER BY `reservation`.`id`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_find_all_users` ()  SELECT `users`.`id`,`users`.`full_name`, `users`.`user_name`, `users`.`email`, `users_groups`.`name`, `users`.`is_disabled`
FROM `users` INNER JOIN `users_groups`
ON `users`.`group_id` = `users_groups`.`id`
ORDER BY `users`.`id`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_find_all_users_groups` ()  SELECT `id`, `name`, `admin_permission`, `add_permission`, `update_permission`, `view_permission`, `notes` FROM `users_groups` ORDER BY `id`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_find_deposit_by_id` (IN `depositId` INT)  SELECT `deposits`.`member_id`, `deposits`.`project_id`, DATE_FORMAT(`deposits`.`date`, '%Y-%m-%d')AS'date', `deposits`.`bank_receipt_date`, `deposits`.`bank_receipt_no`, `members`.`full_name`, `deposits`.`pre`, `deposits`.`monthly`, `deposits`.`quarterly`, `deposits`.`semi_annual`, `deposits`.`annual`, `deposits`.`contract`, `deposits`.`allocation`, `deposits`.`receipt`, SUM(`deposits`.`pre`+`deposits`.`monthly`+`deposits`.`quarterly`+`deposits`.`semi_annual`+`deposits`.`annual`+`deposits`.`contract`+`deposits`.`allocation`+`deposits`.`receipt`) AS 'total',`deposits`.`description`
FROM `deposits`
INNER JOIN `members`
ON `deposits`.`member_id` = `members`.`id`
WHERE `deposits`.`id`=depositId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_find_member_by_id` (IN `userId` INT)  SELECT `id`, `full_name`, `national_id`, `membership`, `telephone`, `notes`
FROM `members`
WHERE `id`=userId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_find_project_by_id` (IN `projectId` INT)  SELECT `id`, `name`, `description`, `flat_count` FROM `projects` WHERE `id`=projectId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_find_reservation_by_id` (IN `reservationId` INT)  SELECT `id`, `member_id`, `project_id`, `building_no`, `floor_no`, `flat_no`, `area`, `notes` FROM `reservation`
WHERE `id`=reservationId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_find_users_group_by_id` (IN `groupId` INT)  SELECT `name`, `admin_permission`, `add_permission`, `update_permission`, `view_permission`, `notes` FROM `users_groups` WHERE `id`=groupId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_find_user_by_id` (IN `userId` INT)  SELECT `full_name`, `user_name`, `user_pass`, `users`.`email`, `group_id`, `is_disabled`, `is_locked`, `notes` FROM `users`
WHERE `id`=userId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_deposits_statistics` ()  SELECT SUM(`pre`) AS `pre`, SUM(`monthly`) AS `monthly`, SUM(`quarterly`) AS `quarterly`, SUM(`semi_annual`) AS `semi_annual`, SUM(`annual`) AS `annual`, SUM(`contract`) AS `contract`, SUM(`allocation`)AS`allocation`, SUM(`receipt`) AS `receipt`,  SUM(`pre`+`monthly`+`quarterly`+`semi_annual`+`annual`+`contract`+`allocation`+`receipt`) AS 'total'
FROM `deposits`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_member_deposits` (IN `memberId` INT)  SELECT `deposits`.`id`, DATE_FORMAT(`deposits`.`date`, '%Y-%m-%d')AS'date', `deposits`.`bank_receipt_date`, `deposits`.`bank_receipt_no`, SUM(`deposits`.`pre`+`deposits`.`monthly`+`deposits`.`quarterly`+`deposits`.`semi_annual`+`deposits`.`annual`+`deposits`.`contract`+`deposits`.`receipt`) AS 'total',`deposits`.`description`
FROM `deposits` INNER JOIN `members`
ON `deposits`.`member_id` = `members`.`id`
WHERE `deposits`.`member_id`=memberId
GROUP BY `deposits`.`id`
ORDER BY `deposits`.`id`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_member_deposits_statistics` (IN `memberId` INT)  SELECT `members`.`full_name`, SUM(`pre`) AS `pre`, SUM(`monthly`) AS `monthly`, SUM(`quarterly`) AS `quarterly`, SUM(`semi_annual`) AS `semi_annual`, SUM(`annual`) AS `annual`, SUM(`contract`) AS `contract`,SUM(`allocation`)AS `allocation` , SUM(`receipt`) AS `receipt`, SUM(`pre`+`monthly`+`quarterly`+`semi_annual`+`annual`+`contract`+`allocation`+`receipt`) AS 'total'
 FROM `deposits` INNER JOIN `members`
ON `deposits`.`member_id` = `members`.`id`
WHERE `deposits`.`member_id`=memberId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_old_password` (IN `userId` INT)  SELECT  `user_pass`FROM `users` WHERE `id`=userId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_settings` ()  SELECT `site_name`, `description`, `keywords`, `email`,`site_status` FROM settings LIMIT 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_user_details` (IN `userName` VARCHAR(60) CHARSET utf8, IN `userPass` VARCHAR(60) CHARSET utf8)  SELECT `users`.`id`, `users`.`full_name`, `users`.`is_disabled`,`users`.`is_locked`,
                      `users_groups`.`admin_permission`, `users_groups`.`add_permission`,`users_groups`.`update_permission`,
                      `users_groups`.`view_permission`
                      FROM `users` INNER JOIN `users_groups` ON `users`.`group_id` = `users_groups`.`id`
                      WHERE `user_name`=userName AND `user_pass` = md5(userPass) LIMIT 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_user_id` (IN `userName` VARCHAR(60) CHARSET utf8)  SELECT `id` FROM `users` WHERE `user_name`=userName$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_lock_user` (IN `userName` VARCHAR(60) CHARSET utf8)  UPDATE `users` SET `is_locked`=1 WHERE `user_name`=userName$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_paginate_deposits` (IN `perPage` INT, IN `depOffset` INT)  SELECT `deposits`.`id`,`deposits`.`member_id`, DATE_FORMAT(`deposits`.`date`, '%Y-%m-%d')AS'date', `deposits`.`bank_receipt_date`, `deposits`.`bank_receipt_no`, `members`.`full_name`, `deposits`.`pre`, `deposits`.`monthly`, `deposits`.`quarterly`, `deposits`.`semi_annual`, `deposits`.`annual`, `deposits`.`contract`, `deposits`.`allocation`, `deposits`.`receipt`, SUM(`deposits`.`pre`+`deposits`.`monthly`+`deposits`.`quarterly`+`deposits`.`semi_annual`+`deposits`.`annual`+`deposits`.`contract`+`deposits`.`allocation`+`deposits`.`receipt`) AS 'total',`deposits`.`description`
FROM `deposits` INNER JOIN `members`
ON `deposits`.`member_id` = `members`.`id`
GROUP BY `deposits`.`id`
ORDER BY `deposits`.`id`DESC
LIMIT perPage OFFSET depOffset$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_paginate_members` (IN `perPage` INT, IN `userOffset` INT)  SELECT `id`, `full_name`, `national_id`, `membership`, `telephone`, `notes`
FROM `members`
ORDER BY `members`.`id`
LIMIT perPage
OFFSET userOffset$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_paginate_projects` (IN `perPage` INT, IN `gOffset` INT)  SELECT `id`, `name`, `description`, `flat_count`
FROM `projects`
ORDER BY `id`
LIMIT perPage OFFSET gOffset$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_paginate_reservations` (IN `perPage` INT, IN `resOffset` INT)  SELECT `reservation`.`id`, `members`.`full_name`, `projects`.`name`, `reservation`.`building_no`, `reservation`.`floor_no`, `reservation`.`flat_no`, `reservation`.`area`, `reservation`.`notes` FROM `reservation`
INNER JOIN `members`
ON `reservation`.`member_id` = `members`.`id`
INNER JOIN `projects`
ON `reservation`.`project_id`=`projects`.`id`
ORDER BY `reservation`.`id`
LIMIT perPage
OFFSET resOffset$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_paginate_users` (IN `perPage` INT, IN `userOffset` INT)  SELECT `users`.`id`,`users`.`full_name`, `users`.`user_name`, `users`.`email`, `users_groups`.`name`, `users`.`is_disabled`
FROM `users`
INNER JOIN `users_groups`
ON `users`.`group_id` = `users_groups`.`id`
ORDER BY `users`.`id`
LIMIT perPage
OFFSET userOffset$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_paginate_users_groups` (IN `perPage` INT, IN `gOffset` INT)  SELECT `id`, `name`, `admin_permission`, `add_permission`, `update_permission`, `view_permission`, `notes` FROM `users_groups` ORDER BY `id` LIMIT perPage OFFSET gOffset$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_deposit` (IN `depositId` INT, IN `memberId` INT, IN `projectId` INT, IN `currentDate` DATE, IN `bankDate` DATE, IN `bankNo` VARCHAR(250), IN `pre` DECIMAL(10,2), IN `monthly` DECIMAL(10,2), IN `quarterly` DECIMAL(10,2), IN `semi_annual` DECIMAL(10,2), IN `annual` DECIMAL(10,2), IN `contract` DECIMAL(10,2), IN `allocation` DECIMAL(10,2), IN `receipt` DECIMAL(10,2), IN `description` TEXT CHARSET utf8)  UPDATE `deposits`
SET  `member_id`=memberId, `deposits`.`project_id`=projectId, `deposits`.`date`=currentDate,`bank_receipt_date`=bankDate, `bank_receipt_no`=bankNo, `pre`=pre, `monthly`=monthly, `quarterly`=quarterly, `semi_annual`=semi_annual, `annual`=annual, `contract`=contract, `allocation`=allocation, `receipt`=receipt, `description`=description
WHERE `id`=depositId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_member` (IN `fullName` VARCHAR(150) CHARSET utf8, IN `nationalId` VARCHAR(14) CHARSET utf8, IN `membership` INT(1), IN `telephone` VARCHAR(11) CHARSET utf8, IN `notes` TEXT CHARSET utf8, IN `userId` INT(11))  UPDATE `members`
SET `full_name`=fullName,`national_id`=nationalId,`membership`=membership,`telephone`=telephone,`notes`=notes
WHERE `id`=userId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_project` (IN `name` VARCHAR(150) CHARSET utf8, IN `description` TEXT CHARSET utf8, IN `flatCount` INT, IN `projectId` INT)  UPDATE `projects`
SET `name`=name,`description`=description,`flat_count`=flatCount
WHERE `id`=projectId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_reservation` (IN `reservationId` INT, IN `memberId` INT, IN `projectId` INT, IN `buildingNo` VARCHAR(5) CHARSET utf8, IN `floorNo` INT, IN `flatNo` INT, IN `area` DECIMAL(10), IN `notes` TEXT CHARSET utf8)  UPDATE `reservation` SET
`member_id`=memberId,`project_id`=projectId,`building_no`=buildingNo,`floor_no`=floorNo,`flat_no`=flatNo,`area`=area,`notes`=notes WHERE `id`=reservationId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_settings` (IN `siteName` VARCHAR(160) CHARSET utf8, IN `description` TEXT CHARSET utf8, IN `keywords` VARCHAR(250) CHARSET utf8, IN `email` VARCHAR(120) CHARSET utf8, IN `siteStatus` INT)  UPDATE `settings` SET `site_name`=site_name,`description`=description,`keywords`=keywords,`email`=email,`site_status`=siteStatus$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_user` (IN `fullName` VARCHAR(150) CHARSET utf8, IN `userName` VARCHAR(60) CHARSET utf8, IN `userPass` VARCHAR(60) CHARSET utf8, IN `email` VARCHAR(120) CHARSET utf8, IN `groupId` INT, IN `isDisabled` TINYINT, IN `notes` TEXT CHARSET utf8, IN `userId` INT)  UPDATE `users` SET `full_name`=fullName,`user_name`=userName,`user_pass`=userPass,`users`.`email`=email,`group_id`=groupId,`is_disabled`=isDisabled, `notes`=notes
WHERE `id`=userId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_users_group` (IN `groupName` VARCHAR(60) CHARSET utf8, IN `adminPermission` TINYINT, IN `addPermission` TINYINT, IN `updatePermission` TINYINT, IN `viewPermission` TINYINT, IN `notes` TEXT CHARSET utf8, IN `groupId` INT)  UPDATE `users_groups` SET
 `name`=groupName,`admin_permission`=adminPermission,`add_permission`=addPermission,`update_permission`=updatePermission, `view_permission`=viewPermission,`notes`=notes WHERE `id`=groupId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_authentication` (IN `userName` VARCHAR(60) CHARSET utf8, IN `userPass` VARCHAR(60) CHARSET utf8)  SELECT COUNT(*)FROM `users`
WHERE `user_name`=userName AND `user_pass` = md5(userPass) LIMIT 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_view_deposit_by_id` (IN `depositId` INT)  SELECT `deposits`.`member_id`, `projects`.`name` AS `project_name`, DATE_FORMAT(`deposits`.`date`, '%Y-%m-%d')AS'date', `deposits`.`bank_receipt_date`, `deposits`.`bank_receipt_no`, `members`.`full_name`, `deposits`.`pre`, `deposits`.`monthly`, `deposits`.`quarterly`, `deposits`.`semi_annual`, `deposits`.`annual`, `deposits`.`contract`, `deposits`.`allocation`, `deposits`.`receipt`, SUM(`deposits`.`pre`+`deposits`.`monthly`+`deposits`.`quarterly`+`deposits`.`semi_annual`+`deposits`.`annual`+`deposits`.`contract`+`deposits`.`allocation`+`deposits`.`receipt`) AS 'total',`deposits`.`description`
FROM `deposits`
INNER JOIN `members`
ON `deposits`.`member_id` = `members`.`id`
INNER JOIN `projects`
ON `deposits`.`project_id` = `projects`.`id`
WHERE `deposits`.`id`=depositId$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `bank_receipt_date` date NOT NULL,
  `bank_receipt_no` varchar(250) COLLATE utf8_bin NOT NULL,
  `pre` decimal(10,2) NOT NULL DEFAULT '0.00',
  `monthly` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quarterly` decimal(10,2) NOT NULL DEFAULT '0.00',
  `semi_annual` decimal(10,2) NOT NULL DEFAULT '0.00',
  `annual` decimal(10,2) NOT NULL DEFAULT '0.00',
  `contract` decimal(10,2) NOT NULL DEFAULT '0.00',
  `allocation` decimal(10,2) NOT NULL,
  `receipt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `member_id`, `project_id`, `date`, `bank_receipt_date`, `bank_receipt_no`, `pre`, `monthly`, `quarterly`, `semi_annual`, `annual`, `contract`, `allocation`, `receipt`, `description`) VALUES
(1, 2, 1, '2017-12-20', '2017-12-20', '', '25000.00', '5000.00', '0.00', '22500.00', '0.00', '0.00', '0.00', '0.00', ''),
(2, 4, 1, '2018-01-16', '2017-12-20', '', '25000.00', '20000.00', '0.00', '37500.00', '0.00', '0.00', '0.00', '0.00', ''),
(3, 5, 1, '2019-01-21', '2019-01-14', '3213215132132161321321', '5000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) COLLATE utf8_bin NOT NULL,
  `national_id` varchar(14) COLLATE utf8_bin NOT NULL,
  `membership` int(1) NOT NULL,
  `telephone` varchar(11) COLLATE utf8_bin NOT NULL,
  `notes` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `full_name`, `national_id`, `membership`, `telephone`, `notes`) VALUES
(1, 'عضو رقم 1', '25225255252525', 1, '', 'رئيس مجلس ادارة الجمعيه'),
(2, 'عضو رقم 2', '28032561701138', 1, '', 'سكرتير الجمعيه'),
(3, 'عضو رقم 3', '27114652402294', 1, '', 'المرلقب المالي'),
(4, 'عضو رقم 4', '27909082503917', 1, '', ''),
(5, 'عضو رقم 5', '28609282564235', 1, '', ''),
(619, 'عضو رقم 6', '23132156321321', 2, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `flat_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `flat_count`) VALUES
(1, 'لؤلؤة أكتوبر', 'مشروع لؤاؤة أكتوبر لإسكان العاملين بمدينة 6 أكتوير.', 240);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `building_no` varchar(5) COLLATE utf8_bin NOT NULL,
  `floor_no` int(11) NOT NULL,
  `flat_no` int(11) NOT NULL,
  `area` decimal(10,0) NOT NULL,
  `notes` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `member_id`, `project_id`, `building_no`, `floor_no`, `flat_no`, `area`, `notes`) VALUES
(1, 2, 1, '5', 2, 10, '150', ''),
(2, 5, 1, '6', 5, 15, '150', '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `site_name` varchar(160) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `keywords` varchar(250) COLLATE utf8_bin NOT NULL,
  `email` varchar(120) COLLATE utf8_bin NOT NULL,
  `site_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`site_name`, `description`, `keywords`, `email`, `site_status`) VALUES
('الجمعية التعاونية للبناء و الإسكان', 'موقع إدارة جمعية البناء والإسكان للعاملين بشركة جنوب القاهرة لتوزيع الكهرباء. الموقع من تصميم و تطوير طيبة ديف للبرمجيات.', 'موقع, جمعية, الاسكان, البناء, شركة, جنوب القاهرة, توزيع, كهرباء, طيبة ديف, برمجيات', 'tibadev.com@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) COLLATE utf8_bin NOT NULL,
  `user_name` varchar(60) COLLATE utf8_bin NOT NULL,
  `user_pass` varchar(60) COLLATE utf8_bin NOT NULL,
  `email` varchar(120) COLLATE utf8_bin NOT NULL,
  `group_id` int(11) NOT NULL,
  `is_disabled` tinyint(1) NOT NULL,
  `is_locked` tinyint(1) NOT NULL,
  `notes` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `user_name`, `user_pass`, `email`, `group_id`, `is_disabled`, `is_locked`, `notes`) VALUES
(1, 'علي منصور محمد', 'ali.mansour', '21232f297a57a5a743894a0e4a801fc3', 'dev.ali.mansour@hotmail.com', 1, 0, 0, 'هذا الحساب خاص بمطور الموقع يستخدم للدعم الفني و محمي من قبل النظام لا يمكن حذفه أو تعطيله.'),
(2, 'مدير الموقع', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 2, 0, 0, 'هذا الحساب خاص بمدير الموقع و محمي من قبل النظام لا يمكن حذفه أو تعطيله.'),
(3, 'مستخدم عادي', 'user', '21232f297a57a5a743894a0e4a801fc3', 'user', 3, 1, 0, ''),
(4, 'عرفات أحمد', 'عرفات', 'd585d095b00cd2f5b50acb64add23834', 'reporter', 4, 0, 0, ''),
(5, 'عصام شريف', 'عصام', '5665489bf52e79893a074f494dc9ecab', 'esam', 2, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_bin NOT NULL,
  `admin_permission` tinyint(1) NOT NULL,
  `add_permission` tinyint(1) NOT NULL,
  `update_permission` tinyint(1) NOT NULL,
  `view_permission` tinyint(1) NOT NULL,
  `notes` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `name`, `admin_permission`, `add_permission`, `update_permission`, `view_permission`, `notes`) VALUES
(1, 'الدعم الفني', 1, 1, 1, 1, 'هذه المجموعة خاصة بالدعم الفني للموقع تمنح أعضائها كافة الصلاحيات ولا يمكن حذفها.'),
(2, 'الإدارة', 1, 1, 1, 1, ''),
(3, 'المستخدمين', 0, 1, 1, 1, ''),
(4, 'العرض فقط', 0, 0, 0, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=620;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `deposits_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `users_groups` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
