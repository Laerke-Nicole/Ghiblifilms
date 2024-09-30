DROP DATABASE IF EXISTS GhiblifilmsDB;
CREATE DATABASE GhiblifilmsDB;
USE GhiblifilmsDB;

-- user
CREATE TABLE User (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
  user VARCHAR(50) NOT NULL,                       
  pass VARCHAR(255) NOT NULL,                      
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UserID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FirstName varchar(50) NOT NULL,
  LastName varchar(50) NOT NULL,
  Email varchar(63) NOT NULL,
  PhoneNumber varchar(20) NOT NULL,
  Address varchar(255) NOT NULL
);



CREATE TABLE PostalCode (
  PostalCodeID varchar(20) NOT NULL PRIMARY KEY,
  City varchar(168)
);
