-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-12 19:51:54
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 8.1.6
CREATE DATABASE `MMS_DB`;
SHOW DATABASES;
USE `MMS_DB`;
SET SQL_SAFE_UPDATES = 0;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

insert into `account` values('test','任宣螢','1','高雄市某區某路某號','0980175290','女','a1085518@mail.nuk.edu.tw','2001/02/08',00000000);
insert into `student representative` values('A1085518','學士',3,1);
SELECT * FROM  `extempore`;
DELETE FROM `meeting`;

CREATE TABLE `account` (
  `Permission` varchar(20) NOT NULL,
  `Name` varchar(60) NOT NULL,
  `Account_ID` int UNSIGNED NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Telephone` varchar(20) NOT NULL,
  `Gender` varchar(5) NOT NULL,
  `E-mail` varchar(100) NOT NULL,
  `Birth Date` date DEFAULT NULL,
  `Remittance_Number` int UNSIGNED NOT NULL
) DEFAULT CHARSET=utf8mb4;


CREATE TABLE `agenda` (
  `Meeting_ID` int UNSIGNED NOT NULL,
  `Content` text NOT NULL,
  `proposer` int UNSIGNED NOT NULL,
  `Description` text NOT NULL,
  `agenda_number` int UNSIGNED NOT NULL,
  `Decision` text NOT NULL
) DEFAULT CHARSET=utf8mb4;


CREATE TABLE `announcement` (
  `announcement_number` int UNSIGNED NOT NULL,
  `Meeting_ID` int UNSIGNED NOT NULL,
  `content` text NOT NULL
)DEFAULT CHARSET=utf8mb4;


CREATE TABLE `assistant` (
  `office_phone` int UNSIGNED NOT NULL,
  `Account_ID` int UNSIGNED NOT NULL
)DEFAULT CHARSET=utf8mb4;


CREATE TABLE `attendee` (
  `Meeting_ID` int UNSIGNED NOT NULL,
  `Account_ID` int UNSIGNED NOT NULL,
  `Absence` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `extempore` (
  `extempore_number` int UNSIGNED NOT NULL,
  `Meeting_ID` int UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `description` text NOT NULL,
  `decision` text NOT NULL,
  `proposer` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `industry experts` (
  `company` varchar(200) NOT NULL,
  `job_title` varchar(200) NOT NULL,
  `office_phone` int UNSIGNED NOT NULL,
  `address` varchar(300) NOT NULL,
  `remittance number` int UNSIGNED NOT NULL,
  `Account_ID` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `meeting` (
  `Name` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  `Archive` tinyint NOT NULL,
  `Description/Decision` text NOT NULL,
  `Meeting_ID` int UNSIGNED NOT NULL,
  `type` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `Chairperson` varchar(100) NOT NULL,
  `note_taker` varchar(100) NOT NULL,
  `chairperson_speech` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `message` (
  `MessageID` int UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `MessageTime` datetime NOT NULL,
  `Sender` int UNSIGNED NOT NULL,
  `Accept` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `off-campus teacher` (
  `School` varchar(100) NOT NULL,
  `Department` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `office_phone` int UNSIGNED NOT NULL,
  `address` varchar(100) NOT NULL,
  `remittance_number` int UNSIGNED NOT NULL,
  `Account_ID` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `readingordelete` (
  `Message_ID` int UNSIGNED NOT NULL,
  `SenderDelete` tinyint NOT NULL,
  `AcceptDelete` tinyint NOT NULL,
  `SenderRead` tinyint NOT NULL,
  `AcceptRead` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `student representative` (
  `student_id` varchar(100) NOT NULL,
  `academic_system` varchar(100) NOT NULL,
  `Grade` int UNSIGNED NOT NULL,
  `Account_ID` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `teacher` (
  `rank` varchar(100) NOT NULL,
  `office_phone` int UNSIGNED NOT NULL,
  `Account_ID` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `account`
  ADD PRIMARY KEY (`Account_ID`);

ALTER TABLE `agenda`
  ADD PRIMARY KEY (`Meeting_ID`,`agenda_number`);

ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_number`,`Meeting_ID`);

ALTER TABLE `assistant`
  ADD PRIMARY KEY (`Account_ID`);

ALTER TABLE `attendee`
  ADD PRIMARY KEY (`Meeting_ID`,`Account_ID`);

ALTER TABLE `extempore`
  ADD PRIMARY KEY (`extempore_number`,`Meeting_ID`);

ALTER TABLE `industry experts`
  ADD PRIMARY KEY (`Account_ID`);

ALTER TABLE `meeting`
  ADD PRIMARY KEY (`Meeting_ID`);

ALTER TABLE `message`
  ADD PRIMARY KEY (`MessageID`),
  ADD KEY `message_ibfk_1` (`Accept`),
  ADD KEY `message_ibfk_2` (`Sender`);

ALTER TABLE `off-campus teacher`
  ADD PRIMARY KEY (`Account_ID`);

ALTER TABLE `readingordelete`
  ADD PRIMARY KEY (`Message_ID`);

ALTER TABLE `student representative`
  ADD PRIMARY KEY (`Account_ID`);

ALTER TABLE `teacher`
  ADD PRIMARY KEY (`Account_ID`);

ALTER TABLE `account`
  MODIFY `Account_ID` int UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `meeting`
  MODIFY `Meeting_ID` int UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `message`
  MODIFY `MessageID` int UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`proposer`) REFERENCES `account` (`Account_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `agenda_ibfk_2` FOREIGN KEY (`Meeting_ID`) REFERENCES `meeting` (`Meeting_ID`) ON UPDATE CASCADE;

ALTER TABLE `announcement`
  ADD CONSTRAINT `announcement_ibfk_1` FOREIGN KEY (`Meeting_ID`) REFERENCES `meeting` (`Meeting_ID`) ON UPDATE CASCADE;

ALTER TABLE `assistant`
  ADD CONSTRAINT `assistant_ibfk_1` FOREIGN KEY (`Account_ID`) REFERENCES `account` (`Account_ID`) ON UPDATE CASCADE;
  
ALTER TABLE `attendee`
  ADD CONSTRAINT `attendee_ibfk_1` FOREIGN KEY (`Account_ID`) REFERENCES `account` (`Account_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `attendee_ibfk_2` FOREIGN KEY (`Meeting_ID`) REFERENCES `meeting` (`Meeting_ID`) ON UPDATE CASCADE;

ALTER TABLE `extempore`
  ADD CONSTRAINT `extempore_ibfk_2` FOREIGN KEY (`Meeting_ID`) REFERENCES `meeting` (`Meeting_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `extempore_ibfk_3` FOREIGN KEY (`proposer`) REFERENCES `account` (`Account_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `industry experts`
  ADD CONSTRAINT `industry experts_ibfk_1` FOREIGN KEY (`Account_ID`) REFERENCES `account` (`Account_ID`) ON UPDATE CASCADE;

ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`Accept`) REFERENCES `account` (`Account_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`Sender`) REFERENCES `account` (`Account_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `off-campus teacher`
  ADD CONSTRAINT `off-campus teacher_ibfk_1` FOREIGN KEY (`Account_ID`) REFERENCES `account` (`Account_ID`) ON UPDATE CASCADE;

ALTER TABLE `readingordelete`
  ADD CONSTRAINT `readingordelete_ibfk_1` FOREIGN KEY (`Message_ID`) REFERENCES `message` (`MessageID`) ON UPDATE CASCADE;

ALTER TABLE `student representative`
  ADD CONSTRAINT FOREIGN KEY (`Account_ID`) REFERENCES `account` (`Account_ID`) ON UPDATE CASCADE;

ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`Account_ID`) REFERENCES `account` (`Account_ID`) ON UPDATE CASCADE;
  
INSERT INTO `attendee`(`Meeting_ID`,`Account_ID`) VALUES(90,1);
SELECT `account`.`Account_ID` FROM `attendee` JOIN `account` ON `attendee`.`Account_ID` = `account`.`Account_ID` WHERE `Name`='任宣螢';