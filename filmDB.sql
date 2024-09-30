DROP DATABASE IF EXISTS GhiblifilmsDB;
CREATE DATABASE GhiblifilmsDB;
USE GhiblifilmsDB;

-- user
CREATE TABLE User (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
  username VARCHAR(50) NOT NULL,                        
  pass VARCHAR(255) NOT NULL,                       
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FirstName VARCHAR(50) NOT NULL,
  LastName VARCHAR(50) NOT NULL,
  Email VARCHAR(63) NOT NULL,
  PhoneNumber VARCHAR(20) NOT NULL,
  Address VARCHAR(255) NOT NULL
);


-- reservation
CREATE TABLE Reservation (
  ReservationID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Date date,
  Time time,
  Auditorium varchar(5)
);


-- movie
CREATE TABLE Movie (
  MovieID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Name varchar(100),
  Description text,
  ReleaseDate date,
  Duration time,
  ScreenFormat varchar(2),
  MovieImg varchar(255),
  GenreID INT, 
  FOREIGN KEY (GenreID) REFERENCES Genre(GenreID)
);


-- genre
CREATE TABLE Genre (
  GenreID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Name varchar(30),
  ParentOf int,
  FOREIGN KEY (ParentOf) REFERENCES Genre(GenreID)
);


-- seat
CREATE TABLE Seat (
  SeatID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  SeatNumber int(2),
  SeatRow int(1)
);


-- seat reservation
CREATE TABLE SeatReservation (
  SeatReservationID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  SeatNumber int(2),
  SeatRow int(1),
  NumberOfSeatsBooked int(2) 
);


-- voice actor
CREATE TABLE VoiceActor (
  VoiceActorID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FirstName varchar(50),
  LastName varchar(50)
);


-- movie voice actor
CREATE TABLE MovieVoiceActor (
  MovieVoiceActorID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  MovieID INT NOT NULL,
  VoiceActorID INT NOT NULL,
  FOREIGN KEY (MovieID) REFERENCES Movie(MovieID),
  FOREIGN KEY (VoiceActorID) REFERENCES VoiceActor(VoiceActorID)
);


-- production
CREATE TABLE Production (
  ProductionID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FirstName varchar(50),
  LastName varchar(50),
  Role varchar(50)
);


-- movie production actor
CREATE TABLE MovieProduction (
  MovieProductionID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  MovieID INT NOT NULL,
  ProductionID INT NOT NULL,
  FOREIGN KEY (MovieID) REFERENCES Movie(MovieID),
  FOREIGN KEY (ProductionID) REFERENCES Production(ProductionID)
);


-- postal code
CREATE TABLE PostalCode (
  PostalCodeID varchar(20) NOT NULL PRIMARY KEY,
  City varchar(168)
);


-- news
CREATE TABLE News (
  NewsID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Headline varchar(168),
  SubHeadline varchar(168),
  TextOfNews text,
  NewsImage varchar(255)
);


-- company information
CREATE TABLE CompanyInformation (
  CompanyInformationID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  NameOfCompany varchar(11),
  CompanyDescription text,
  Email varchar(63),
  PhoneNumber varchar(20),
  AddressOfCompany varchar(255)
);


-- contact form
CREATE TABLE ContactForm (
  ContactFormID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FirstName varchar(50),
  LastName varchar(50),
  Email varchar(63),
  PhoneNumber varchar(20),
  MessageText text
);


-- opening hours
CREATE TABLE OpeningHour (
  OpeningHourID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Day varchar(9),
  Time TIME  
);


-- payment
CREATE TABLE Payment (
  PaymentID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  PaymentType varchar(9)
);
