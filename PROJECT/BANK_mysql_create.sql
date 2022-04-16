DROP DATABASE IF EXISTS THE_BANKING_SYSTEM;
CREATE DATABASE IF NOT EXISTS THE_BANKING_SYSTEM;
USE THE_BANKING_SYSTEM;

CREATE TABLE `BRANCH` (
	`BRANCH_ID` INT  NOT NULL AUTO_INCREMENT,
	`BRANCH_NAME` varchar(25) NOT NULL,
	`BRANCH_COUNTRY` VARCHAR(25) NOT NULL,
	`BRANH_CITY` VARCHAR(25) NOT NULL,`
	STREET_NO` INT NOT NULL,
	`BANK_CODE` INT(4) NOT NULL,
	PRIMARY KEY (`BRANCH_ID`)
);

CREATE TABLE `BANK` (
	`BANK_CODE` INT(4)  NOT NULL AUTO_INCREMENT,
	`BANK_NAME` varchar(25) NOT NULL,
	`BANK_INFO` TEXT NOT NULL,
	`BANK_COUNTRY` VARCHAR(25) NOT NULL,
	`BANK CITY` VARCHAR(25) NOT NULL,
	`STREET_NO` INT NOT NULL,
	PRIMARY KEY (`BANK_CODE`)
   );

CREATE TABLE `EMPLOYEES` (
	`EMP_ID` INT  NOT NULL AUTO_INCREMENT,
	`EMP_FNAME` varchar(25) NOT NULL,
	`EMP_LNAME` varchar(25) NOT NULL,
	`EMP_CITY` varchar(25) NOT NULL,
	`EMP_COUNTRY` varchar(25) NOT NULL,
	`STREET_NO`  INT NOT NULL,
	`EMP_GENDER` ENUM ('MALE','FEMALE') DEFAULT 'MALE',
	`EMP_SALARY` INT NOT NULL,
	`EMP_PHONE` INT(11) NOT NULL,
	`BANK_CODE` INT(4) NOT NULL,
	`BRANCH_NAME` varchar(25) NOT NULL,
	PRIMARY KEY (`EMP_ID`)
);

CREATE TABLE `EMPLOYEE_LOGIN` (
	`EMP_ID` INT NOT NULL,
	`EMP_EMAIL` varchar(25) NOT NULL,
	`PASSWORD` VARCHAR(25) NOT NULL
);

CREATE TABLE `CUSTOMERS` (
	`CUSTOMER_ID` INT  NOT NULL AUTO_INCREMENT,
	`CUST_FNAME` varchar(25) NOT NULL,
	`CUST_LNAME` varchar(25) NOT NULL,
	`CUST_CITY` varchar(25) NOT NULL,
	`CUST_COUNTRY` varchar(25) NOT NULL,
	`STREET_NO`   INT NOT NULL,
	`CUST_GENDER` ENUM ('MALE','FEMALE') DEFAULT 'MALE',
	`CUST_EMAIL` varchar(25) NOT NULL UNIQUE,
	`BANK_CODE` INT(4) NOT NULL,
	`BRANCH_NAME` varchar(25) NOT NULL,
	PRIMARY KEY (`CUSTOMER_ID`)

);

CREATE TABLE `ACCOUNT` (
	`CUSTOMER_ID` INT NOT NULL,
	`ACCOUNT_NO` INT(16)  NOT NULL AUTO_INCREMENT,
	`ACCOUNT_BALANCE` INT NOT NULL,
	PRIMARY KEY (`ACCOUNT_NO`)
);

CREATE TABLE `CARD` (
	`CARD_NUMBER` INT(16)  NOT NULL AUTO_INCREMENT,
	`START_date` DATE NOT NULL,
	`END_DATE` DATE NOT NULL,
	`CUSTOMER_ID` INT NOT NULL,
	`ACCOUNT_NO` INT(16) NOT NULL,
	PRIMARY KEY (`CARD_NUMBER`)
);

CREATE TABLE `CUSTOMERS_LOGIN` (
	`CARD_NUMBER` INT(16) NOT NULL,
	`PASSWORD` varchar(25) NOT NULL,
	`CUSTOMER_ID` INT NOT NULL
);

CREATE TABLE `WITHDRAW` (
	`DATE` DATE NOT NULL,
	`ACCOUNT_NO` INT(16) NOT NULL,
	`CARD_NO` INT(16) NOT NULL,
	`AMOUNT` INT NOT NULL,
	`CUSTOMER_NAME` varchar(25) NOT NULL
);

CREATE TABLE `DEPOSIT` (
	`DATE` DATE NOT NULL,
	`ACCOUNT_NO` INT(16) NOT NULL,
	`CARD_NO` INT(16) NOT NULL,
	`AMOUNT` INT NOT NULL,
	`CUSTOMER_NAME` varchar(25) NOT NULL
);

CREATE TABLE `ATM` (
	`ATM NAME` varchar(25) NOT NULL, 
	`ATM_ID` INT  NOT NULL AUTO_INCREMENT,
	`CARD_NUMBER` INT(4) NOT NULL ,
	`BANK_CODE` INT(4) NOT NULL,
	PRIMARY KEY (`ATM_ID`)
);

ALTER TABLE `BRANCH` ADD CONSTRAINT `BRANCH_fk0` FOREIGN KEY (`BANK_CODE`) REFERENCES `BANK`(`BANK_CODE`) on delete cascade;

ALTER TABLE `EMPLOYEES` ADD CONSTRAINT `EMPLOYEES_fk0` FOREIGN KEY (`BANK_CODE`) REFERENCES `BANK`(`BANK_CODE`) on delete cascade;

ALTER TABLE `EMPLOYEE_LOGIN` ADD CONSTRAINT `EMPLOYEE_LOGIN_fk0` FOREIGN KEY (`EMP_ID`) REFERENCES `EMPLOYEES`(`EMP_ID`) on delete cascade;

ALTER TABLE `CUSTOMERS` ADD CONSTRAINT `CUSTOMERS_fk0` FOREIGN KEY (`BANK_CODE`) REFERENCES `BANK`(`BANK_CODE`) on delete cascade;



ALTER TABLE `ACCOUNT` ADD CONSTRAINT `ACCOUNT_fk0` FOREIGN KEY (`CUSTOMER_ID`) REFERENCES `CUSTOMERS`(`CUSTOMER_ID`) on delete cascade;

ALTER TABLE `CARD` ADD CONSTRAINT `CARD_fk0` FOREIGN KEY (`CUSTOMER_ID`) REFERENCES `CUSTOMERS`(`CUSTOMER_ID`) on delete cascade;

ALTER TABLE `CARD` ADD CONSTRAINT `CARD_fk1` FOREIGN KEY (`ACCOUNT_NO`) REFERENCES `ACCOUNT`(`ACCOUNT_NO`) on delete cascade;

ALTER TABLE `CUSTOMERS_LOGIN` ADD CONSTRAINT `CUSTOMERS_LOGIN_fk0` FOREIGN KEY (`CARD_NUMBER`) REFERENCES `CARD`(`CARD_NUMBER`) on delete cascade;

ALTER TABLE `CUSTOMERS_LOGIN` ADD CONSTRAINT `CUSTOMERS_LOGIN_fk1` FOREIGN KEY (`CUSTOMER_ID`) REFERENCES `CUSTOMERS`(`CUSTOMER_ID`) on delete cascade;

ALTER TABLE `WITHDRAW` ADD CONSTRAINT `WITHDRAW_fk0` FOREIGN KEY (`ACCOUNT_NO`) REFERENCES `ACCOUNT`(`ACCOUNT_NO`) on delete cascade;

ALTER TABLE `WITHDRAW` ADD CONSTRAINT `WITHDRAW_fk1` FOREIGN KEY (`CARD_NO`) REFERENCES `CARD`(`CARD_NUMBER`) on delete cascade;

ALTER TABLE `DEPOSIT` ADD CONSTRAINT `DEPSOIT_fk0` FOREIGN KEY (`ACCOUNT_NO`) REFERENCES `ACCOUNT`(`ACCOUNT_NO`) on delete cascade;

ALTER TABLE `DEPOSIT` ADD CONSTRAINT `DEPSOIT_fk1` FOREIGN KEY (`CARD_NO`) REFERENCES `CARD`(`CARD_NUMBER`) on delete cascade;

ALTER TABLE `ATM` ADD CONSTRAINT `ATM_fk0` FOREIGN KEY (`CARD_NUMBER`) REFERENCES `CARD`(`CARD_NUMBER`) on delete cascade;

ALTER TABLE `ATM` ADD CONSTRAINT `ATM_fk1` FOREIGN KEY (`BANK_CODE`) REFERENCES `BANK`(`BANK_CODE`) on delete cascade;
delimiter &
create trigger card after INSERT on ACCOUNT FOR EACH ROW BEGIN
declare cus int;
DECLARE ACC INT;
DECLARE CO INT;
set cus =( select customer_id from customers order by customer_id desc limit 1);
SET ACC=(SELECT account_NO FROM account ORDER BY account_NO DESC LIMIT 1);
SET CO=(select count(*) from CARD);

if CO = 0 THEN
INSERT INTO CARD VALUES(1238294789,CURRENT_DATE,'2025-10-09 22:43:24',CUS,ACC);      
ELSE 
INSERT INTO CARD VALUES(NULL,CURRENT_DATE,'2025-10-09 22:43:24',CUS,ACC);
END IF;      
end &
delimiter ;


INSERT INTO BANK VALUES(4200,'THE BANKING SYSTEM','THE BANKING SYSTEM IS OUR DATABASE PROOJECT.THIS PROJECT FULLFILS ALOMOST ALL THE CRITERIA OF DATABASE','PAKSITAN','LAHORE',12);
INSERT INTO BRANCH VALUES(1,'TULIP','PAKISTAN','KARACHI',2,4200);
INSERT INTO EMPLOYEES VALUES(NULL,'CALEB','CARREY','VAHKEND','PAKISTAN',12,'MALE',12000,038485739,4200,'TULIP');
INSERT INTO EMPLOYEES VALUES(NULL,'BEN','STOKES','PESHAWER','PAKISTAN',11,'MALE',21000,0384930239,4200,'TULIP');
INSERT INTO EMPLOYEE_LOGIN VALUES(1,'CALEB@GMAIL.COM','CALEB123');
INSERT INTO EMPLOYEE_LOGIN VALUES (2,'BEN@YAHOO.COM','BEN321');
INSERT INTO CUSTOMERS VALUES (NULL,'MUHAMMAD','USMAN','LAHORE','PAKISTAN','12','MALE','usman@gmail.com',4200,'TULIP');
INSERT INTO ACCOUNT VALUES(1,293240,6000);
INSERT INTO CUSTOMERS_LOGIN VALUES(1238294789,12345,1);
INSERT INTO CUSTOMERS VALUES (NULL,'ABUZAR','ZULFIQAR','LAHORE','PAKISTAN','12','MALE','ABUZAR@gmail.com',4200,'TULIP');
INSERT INTO ACCOUNT VALUES(2,293241,6000);
INSERT INTO CUSTOMERS_LOGIN VALUES(1238294790,12346,2);
INSERT INTO CUSTOMERS VALUES (NULL,'MUHAMMMAD','UMAR','LAHORE','PAKISTAN','12','MALE','umar@gmail.com',4200,'TULIP');
INSERT INTO ACCOUNT VALUES(3,293242,6000);
INSERT INTO CUSTOMERS_LOGIN VALUES(1238294791,1234,3);