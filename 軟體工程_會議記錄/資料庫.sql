CREATE DATABASE `DB`;
SHOW DATABASES;
USE `DB`;
SET SQL_SAFE_UPDATES = 0;

insert into `與會人員` values('E123456789','任宣螢','女','0980175290','a1085518@mail.nuk.edu.tw','a1085518','0000','學生代表');
insert into `學生代表` values('E123456789','A1085518','學士',3);
insert into `與會人員` values('N123456780','塗峻翔','男','0910382139','a1085541@mail.nuk.edu.tw','a1085541','123','學生代表');
insert into `學生代表` values('N123456780','a1085541','學士',3);
insert into `與會人員` values('A111111111','淑珍姐','女','0911111111','a1111111@mail.nuk.edu.tw','a1111111','1111','系助理');
insert into `系助理` values('A111111111','071111111');

CREATE TABLE `與會人員`(
	`身分證字號` VARCHAR(15) PRIMARY KEY,
    `姓名` VARCHAR(10),
    `性別` VARCHAR(2),
    `手機` VARCHAR(10),
    `Email` VARCHAR(50),
    `帳號` VARCHAR(100) UNIQUE,
    `密碼` VARCHAR(100),
    `身分` VARCHAR(5)
)DEFAULT CHARSET=utf8;
CREATE TABLE `系助理`(
	`身分證字號` VARCHAR(15) PRIMARY KEY,
    `辦公室電話` VARCHAR(10),
    FOREIGN KEY(`身分證字號`) REFERENCES `與會人員`(`身分證字號`) ON DELETE CASCADE
)DEFAULT CHARSET=utf8;
CREATE TABLE `學生代表`(
	`身分證字號` VARCHAR(15) PRIMARY KEY,
    `學號` VARCHAR(10),
    `學制` VARCHAR(10),
    `年級` INT,
    FOREIGN KEY(`身分證字號`) REFERENCES `與會人員`(`身分證字號`) ON DELETE CASCADE
)DEFAULT CHARSET=utf8;
CREATE TABLE `系上老師`(
	`身分證字號` VARCHAR(15) PRIMARY KEY,
    `職級` VARCHAR(10),
    `辦公室電話` VARCHAR(10),
    FOREIGN KEY(`身分證字號`) REFERENCES `與會人員`(`身分證字號`) ON DELETE CASCADE
)DEFAULT CHARSET=utf8;
CREATE TABLE `業界專家`(
	`身分證字號` VARCHAR(15) PRIMARY KEY,
    `任職公司` VARCHAR(20),
    `職稱` VARCHAR(10),
    `辦公室電話` VARCHAR(10),
    `聯絡地址` VARCHAR(50),
    `銀行帳號` VARCHAR(20),
    FOREIGN KEY(`身分證字號`) REFERENCES `與會人員`(`身分證字號`) ON DELETE CASCADE
)DEFAULT CHARSET=utf8;
CREATE TABLE `校外老師`(
	`身分證字號` VARCHAR(15) PRIMARY KEY,
    `任職學校` VARCHAR(20),
    `系所` VARCHAR(20),
    `職稱` VARCHAR(10),
    `辦公室電話` VARCHAR(10),
    `聯絡地址` VARCHAR(50),
    `銀行帳號` VARCHAR(20),
    FOREIGN KEY(`身分證字號`) REFERENCES `與會人員`(`身分證字號`) ON DELETE CASCADE
)DEFAULT CHARSET=utf8;
CREATE TABLE `會議記錄`(
	`會議名稱` VARCHAR(20) PRIMARY KEY,
    `會議種類` VARCHAR(20),
    `開會時間` DATETIME,
	`開會地點` VARCHAR(20),
    `主席` VARCHAR(10),
    `記錄人員` VARCHAR(10),
    `主席致詞` VARCHAR(1000),
    `臨時動議` VARCHAR(10000)
)DEFAULT CHARSET=utf8;
CREATE TABLE `討論事項`(
	`會議名稱` VARCHAR(20),
    `提案編號` VARCHAR(20),
    `案由` VARCHAR(100),
    `說明` VARCHAR(1000),
    `決議` VARCHAR(100),
    FOREIGN KEY (`會議名稱`) REFERENCES `會議記錄`(`會議名稱`) ON DELETE CASCADE,
    CONSTRAINT `討論事項_PK` PRIMARY KEY (`會議名稱`,`提案編號`)
)DEFAULT CHARSET=utf8;
DELETE FROM `會議記錄`
WHERE `會議名稱` = '測試新增會議1';
SELECT * FROM `會議記錄`;