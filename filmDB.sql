DROP DATABASE IF EXISTS GhiblifilmsDB;
CREATE DATABASE GhiblifilmsDB;
USE GhiblifilmsDB;


CREATE TABLE PostalCode (
  PostalCodeID varchar(20) NOT NULL PRIMARY KEY,
  City varchar(168)
);

CREATE TABLE User (
  UserID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FirstName varchar(50) NOT NULL,
  LastName varchar(50) NOT NULL,
  Email varchar(63) NOT NULL,
  PhoneNumber varchar(20) NOT NULL,
  Address varchar(255) NOT NULL
);

-- CREATE TABLE User (
--   UserID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
--   FirstName varchar(50) NOT NULL,
--   LastName varchar(50) NOT NULL,
--   Email varchar(63) NOT NULL,
--   PhoneNumber varchar(20) NOT NULL,
--   Address varchar(255) NOT NULL
-- );