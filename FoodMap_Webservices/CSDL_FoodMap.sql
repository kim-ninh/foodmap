﻿CREATE DATABASE FOODMAPSERVER
GO

USE FOODMAPSERVER
GO

CREATE TABLE ACCOUNT
(
	USERNAME VARCHAR(20) PRIMARY KEY,
	PASSWORD VARCHAR(20),
	NAME NVARCHAR(40),
	PHONE_NUMBER VARCHAR(11),
	EMAIL VARCHAR(20) UNIQUE
)
GO

CREATE TABLE GUESTACCOUNT
(
	EMAIL VARCHAR(30) PRIMARY KEY,
	NAME NVARCHAR(40)
)
GO

CREATE TABLE RESTAURANT
(
	ID INT IDENTITY PRIMARY KEY,
	ID_USER VARCHAR(20),
	NAME NVARCHAR(100) NOT NULL,
	ADDRESS NVARCHAR(50) NOT NULL,
	PHONE_NUMBER VARCHAR(11),
	DESCRIBE_TEXT TEXT,
	URL_IMAGE NVARCHAR(200), -- LINK IMAGE
	TIMEOPEN TIME NOT NULL,
	TIMECLOSE TIME NOT NULL
)
GO

CREATE TABLE LOCATION
(
	ID_REST INT NOT NULL,
	LAT FLOAT NOT NULL, -- latitude
	LON FLOAT NOT NULL,	-- longitude
	PRIMARY KEY(LAT, LON)
)
GO

CREATE TABLE DISH
(
	NAME NVARCHAR(50) NOT NULL,
	ID_REST INT,
	PRICE INT,
	URL_IMAGE NVARCHAR(200), -- LINK IMAGE
	ID_CATALOG INT,
	PRIMARY KEY(NAME, ID_REST)
)
GO

CREATE TABLE CATALOGS
(
	ID INT IDENTITY PRIMARY KEY,
	NAME NVARCHAR(30) UNIQUE NOT NULL
)
GO

CREATE TABLE TAGS
(
	ID_REST INT,
	ID_CATALOG INT,
	PRIMARY KEY(ID_REST, ID_CATALOG)
)
GO

CREATE TABLE COMMENTS
(
	DATE_TIME DATE NOT NULL, -- ngày comment
	ID_REST INT NOT NULL,
	GUEST_EMAIL VARCHAR(30) NULL, -- người dùng bình thường
	OWNER_EMAIL VARCHAR(20) NULL, -- là chủ quán ăn comment
	COMMENT NVARCHAR(200) NOT NULL,
	PRIMARY KEY (DATE_TIME, ID_REST)
)
GO

CREATE TABLE RANK
(
	ID_REST INT NOT NULL,
	GUEST_EMAIL VARCHAR(30),
	STAR INT NOT NULL, -- 1 tới 5
	PRIMARY KEY(ID_REST, GUEST_EMAIL)
)
GO

-- SET FOREIGN KEY
ALTER TABLE dbo.RESTAURANT ADD CONSTRAINT FK_RESTAURANT_ACCOUNT FOREIGN KEY(ID_USER) REFERENCES dbo.ACCOUNT(USERNAME)
GO

ALTER TABLE dbo.DISH ADD CONSTRAINT FK_DISH_RESTAURANT FOREIGN KEY(ID_REST) REFERENCES dbo.RESTAURANT(ID)
GO

ALTER TABLE dbo.DISH ADD CONSTRAINT FK_DISH_CATALOGS FOREIGN KEY(ID_CATALOG) REFERENCES dbo.CATALOGS(ID)
GO

ALTER TABLE dbo.TAGS ADD CONSTRAINT FK_TAGS_RESTAURANT FOREIGN KEY(ID_REST) REFERENCES dbo.RESTAURANT(ID)
GO

ALTER TABLE dbo.TAGS ADD CONSTRAINT FK_TAGS_CATALOGS FOREIGN KEY(ID_CATALOG) REFERENCES dbo.CATALOGS(ID)
GO

ALTER TABLE dbo.COMMENTS ADD CONSTRAINT FK_COMMENTS_RESTAURANT FOREIGN KEY(ID_REST) REFERENCES dbo.RESTAURANT(ID)
GO

ALTER TABLE dbo.COMMENTS ADD CONSTRAINT FK_COMMENTS_GUESTACCOUNT FOREIGN KEY(GUEST_EMAIL) REFERENCES dbo.GUESTACCOUNT(EMAIL)
GO

ALTER TABLE dbo.COMMENTS ADD CONSTRAINT FK_COMMENTS_ACCOUNT FOREIGN KEY(OWNER_EMAIL) REFERENCES dbo.ACCOUNT(EMAIL)
GO

ALTER TABLE dbo.RANK ADD CONSTRAINT FK_RANK_RESTAURANT FOREIGN KEY(ID_REST) REFERENCES dbo.RESTAURANT(ID)
GO

ALTER TABLE dbo.RANK ADD CONSTRAINT FK_RANK_GUESTACCOUNT FOREIGN KEY(GUEST_EMAIL) REFERENCES dbo.GUESTACCOUNT(EMAIL)
GO

ALTER TABLE dbo.LOCATION ADD CONSTRAINT FK_LOCATION_RESTAURANT FOREIGN KEY(ID_REST) REFERENCES dbo.RESTAURANT(ID)
GO

-- SET RULES
ALTER TABLE dbo.ACCOUNT ADD CONSTRAINT C_ACCOUNT_PHONENUMBER CHECK(LEN(PHONE_NUMBER) IN (10,11))
GO

ALTER TABLE dbo.RESTAURANT ADD CONSTRAINT C_RESTAURANT_PHONENUMBER CHECK(LEN(PHONE_NUMBER) IN (10,11))
GO

ALTER TABLE dbo.RANK ADD CONSTRAINT C_RANK_STAR CHECK(STAR >= 1 AND STAR <= 5)
GO

CREATE PROCEDURE LOGIN @USERNAME VARCHAR(20), @PASSWORD VARCHAR(20)
AS
	SELECT * FROM ACCOUNT WHERE USERNAME = @USERNAME AND PASSWORD = @PASSWORD