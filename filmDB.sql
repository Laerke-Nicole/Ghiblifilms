DROP DATABASE IF EXISTS GhiblifilmsDB;
CREATE DATABASE GhiblifilmsDB;
USE GhiblifilmsDB;

-- Table with postal code
CREATE TABLE PostalCode (
  PostalCode varchar(20) NOT NULL PRIMARY KEY,
  City varchar(168)
) ENGINE=InnoDB;


-- user
CREATE TABLE User (
  UserID int NOT NULL AUTO_INCREMENT PRIMARY KEY,  
  Username VARCHAR(50) NOT NULL,                        
  Pass VARCHAR(255) NOT NULL,                       
  FirstName VARCHAR(50) NOT NULL,
  LastName VARCHAR(50) NOT NULL,
  Email VARCHAR(63) NOT NULL,
  PhoneNumber VARCHAR(20) NOT NULL,
  `Address` VARCHAR(255) NOT NULL,
  PostalCode varchar(20),
  FOREIGN KEY (PostalCode) REFERENCES PostalCode(PostalCode)
) ENGINE=InnoDB;


-- auditorium
CREATE TABLE Auditorium (
  AuditoriumID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  AuditoriumNumber varchar(5)
) ENGINE=InnoDB;


-- seat
CREATE TABLE Seat (
  SeatID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  SeatNumber varchar(3)
) ENGINE=InnoDB;


-- genre
CREATE TABLE Genre (
  GenreID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  GenreName varchar(30)
) ENGINE=InnoDB;


-- screen format
CREATE TABLE ScreenFormat (
  ScreenFormatID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ScreenFormat varchar(2)
) ENGINE=InnoDB;


-- role in production
CREATE TABLE RoleInProduction (
  RoleInProductionID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  NameOfRole varchar(50)
) ENGINE=InnoDB;


-- production
CREATE TABLE Production (
  ProductionID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FirstName varchar(50),
  LastName varchar(50),
  RoleInProductionID INT NOT NULL,
  FOREIGN KEY (RoleInProductionID) REFERENCES RoleInProduction(RoleInProductionID)
) ENGINE=InnoDB;


-- voice actor
CREATE TABLE VoiceActor (
  VoiceActorID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FirstName varchar(50),
  LastName varchar(50)
) ENGINE=InnoDB;


-- movie
CREATE TABLE Movie (
  MovieID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Name` varchar(100),
  `Description` text,
  ReleaseDate date,
  Duration varchar(11),
  MovieImg varchar(255),
  GenreID INT NOT NULL,
  ScreenFormatID INT NOT NULL,
  VoiceActorID INT NOT NULL,
  ProductionID INT NOT NULL,
  FOREIGN KEY (GenreID) REFERENCES Genre(GenreID),
  FOREIGN KEY (ScreenFormatID) REFERENCES ScreenFormat(ScreenFormatID),
  FOREIGN KEY (VoiceActorID) REFERENCES VoiceActor(VoiceActorID),
  FOREIGN KEY (ProductionID) REFERENCES Production(ProductionID)
) ENGINE=InnoDB;


-- movie production actor
CREATE TABLE MovieProduction (
  MovieID INT NOT NULL,
  ProductionID INT NOT NULL,
  PRIMARY KEY (MovieID, ProductionID),
  FOREIGN KEY (MovieID) REFERENCES Movie(MovieID),
  FOREIGN KEY (ProductionID) REFERENCES Production(ProductionID)
) ENGINE=InnoDB;


-- movie voice actor
CREATE TABLE MovieVoiceActor (
  MovieID INT NOT NULL,
  VoiceActorID INT NOT NULL,
  PRIMARY KEY (MovieID, VoiceActorID),
  FOREIGN KEY (MovieID) REFERENCES Movie(MovieID),
  FOREIGN KEY (VoiceActorID) REFERENCES VoiceActor(VoiceActorID)
) ENGINE=InnoDB;


-- reservation
CREATE TABLE Reservation (
  ReservationID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Date` date,
  `Time` varchar(8),
  NumberOfSeatsBooked tinyint(2),
  UserID int NOT NULL,
  MovieID int NOT NULL,
  SeatID int NOT NULL,
  AuditoriumID int NOT NULL,
  FOREIGN KEY (UserID) REFERENCES User(UserID),
  FOREIGN KEY (MovieID) REFERENCES Movie(MovieID),
  FOREIGN KEY (SeatID) REFERENCES Seat(SeatID),
  FOREIGN KEY (AuditoriumID) REFERENCES Auditorium(AuditoriumID)
) ENGINE=InnoDB;


-- seat reservation
CREATE TABLE SeatReservation (
  ReservationID int NOT NULL,
  SeatID int NOT NULL,
  PRIMARY KEY (ReservationID, SeatID),
  FOREIGN KEY (ReservationID) REFERENCES Reservation(ReservationID),
  FOREIGN KEY (SeatID) REFERENCES Seat(SeatID)
) ENGINE=InnoDB;


-- news
CREATE TABLE News (
  NewsID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Headline varchar(168),
  SubHeadline varchar(168),
  TextOfNews text,
  NewsImage varchar(255)
) ENGINE=InnoDB;


-- company information
CREATE TABLE CompanyInformation (
  CompanyInformationID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  NameOfCompany varchar(11),
  CompanyDescription text,
  Email varchar(63),
  PhoneNumber varchar(20),
  AddressOfCompany varchar(255),
  PostalCode varchar(20),
  FOREIGN KEY (PostalCode) REFERENCES PostalCode(PostalCode)
) ENGINE=InnoDB;


-- contact form
CREATE TABLE ContactForm (
  ContactFormID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FirstName varchar(50),
  LastName varchar(50),
  Email varchar(63),
  PhoneNumber varchar(20),
  MessageText text
) ENGINE=InnoDB;


-- opening hours
CREATE TABLE OpeningHour (
  OpeningHourID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Day` varchar(9),
  `Time` varchar(8)
) ENGINE=InnoDB;


-- payment
CREATE TABLE Payment (
  PaymentID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  PaymentType varchar(9)
) ENGINE=InnoDB;






-- data to insert


-- postal code 
insert into PostalCode (PostalCode, City) values ('696 13', 'Kvasy');
insert into PostalCode (PostalCode, City) values ('P75', 'Alto de la Estancia');
insert into PostalCode (PostalCode, City) values ('252437', 'Girardot');
insert into PostalCode (PostalCode, City) values ('58550-000', 'Prata');
insert into PostalCode (PostalCode, City) values ('M5T', 'Pueblo Nuevo');
insert into PostalCode (PostalCode, City) values ('925-0215', 'Keyinhe');
insert into PostalCode (PostalCode, City) values ('352720', 'Tulung');
insert into PostalCode (PostalCode, City) values ('2140', 'Mzuzu');
insert into PostalCode (PostalCode, City) values ('57-343', 'Guohe');
insert into PostalCode (PostalCode, City) values ('66-008', 'Świdnica');
insert into PostalCode (PostalCode, City) values ('95100', 'Zhujiang');
insert into PostalCode (PostalCode, City) values ('4663', 'Kristiansand S');
insert into PostalCode (PostalCode, City) values ('788 32', 'Kakanj');
insert into PostalCode (PostalCode, City) values ('364 61', 'Město');
insert into PostalCode (PostalCode, City) values ('59-852', 'As Sawdā');
insert into PostalCode (PostalCode, City) values ('2383', 'Baiyushan');
insert into PostalCode (PostalCode, City) values ('358015', 'Shapaja');
insert into PostalCode (PostalCode, City) values ('369-0137', 'Gyōda');
insert into PostalCode (PostalCode, City) values ('6340', 'Doljo');
insert into PostalCode (PostalCode, City) values ('53401', 'Maubara');
insert into PostalCode (PostalCode, City) values ('9021', 'Butuan');
insert into PostalCode (PostalCode, City) values ('763029', 'Tuluá');
insert into PostalCode (PostalCode, City) values ('64058 CEDEX 9', 'Longtian');
insert into PostalCode (PostalCode, City) values ('188838', 'Il’ichëvo');
insert into PostalCode (PostalCode, City) values ('67137 CEDEX', 'Charlestown');
insert into PostalCode (PostalCode, City) values ('861-2236', 'Maoyang');
insert into PostalCode (PostalCode, City) values ('V1Z', 'Chao');
insert into PostalCode (PostalCode, City) values ('93610', 'Sadar');
insert into PostalCode (PostalCode, City) values ('813 27', 'Hofors');
insert into PostalCode (PostalCode, City) values ('6337', 'Gocoton');
insert into PostalCode (PostalCode, City) values ('9420', 'Río Grande');
insert into PostalCode (PostalCode, City) values ('18010', 'Granada');
insert into PostalCode (PostalCode, City) values ('2808', 'Embu');
insert into PostalCode (PostalCode, City) values ('62-602', 'Jingdang');
insert into PostalCode (PostalCode, City) values ('4821', 'Flagstaff');
insert into PostalCode (PostalCode, City) values ('851 88', 'Jantake');
insert into PostalCode (PostalCode, City) values ('4415-708', 'Masons Bay');
insert into PostalCode (PostalCode, City) values ('633224', 'Listvyanskiy');
insert into PostalCode (PostalCode, City) values ('36019 CEDEX', 'Châteauroux');
insert into PostalCode (PostalCode, City) values ('665689', 'Banjar Budakeling');
insert into PostalCode (PostalCode, City) values ('692327', 'Zhuli');
insert into PostalCode (PostalCode, City) values ('88-306', 'Dąbrowa');
insert into PostalCode (PostalCode, City) values ('06721', 'Watuweri');
insert into PostalCode (PostalCode, City) values ('8608', 'Lamak');
insert into PostalCode (PostalCode, City) values ('665670', 'Listvyanka');
insert into PostalCode (PostalCode, City) values ('959-1146', 'Tegalsari');
insert into PostalCode (PostalCode, City) values ('29193 ', 'Sapeken');
insert into PostalCode (PostalCode, City) values ('45700-000', 'Hŭngnam');
insert into PostalCode (PostalCode, City) values ('44880-000', 'Xindong');
insert into PostalCode (PostalCode, City) values ('7005-724', 'São Manços');


-- auditorium
insert into Auditorium (AuditoriumID, AuditoriumNumber) values (1, 'Bio 1');
insert into Auditorium (AuditoriumID, AuditoriumNumber) values (2, 'Bio 2');
insert into Auditorium (AuditoriumID, AuditoriumNumber) values (3, 'Bio 3');
insert into Auditorium (AuditoriumID, AuditoriumNumber) values (4, 'Bio 4');
insert into Auditorium (AuditoriumID, AuditoriumNumber) values (5, 'Bio 5');


-- seat
insert into Seat (SeatID, SeatNumber) values (1, 'A1');
insert into Seat (SeatID, SeatNumber) values (2, 'A2');
insert into Seat (SeatID, SeatNumber) values (3, 'A3');
insert into Seat (SeatID, SeatNumber) values (4, 'A4');
insert into Seat (SeatID, SeatNumber) values (5, 'A5');
insert into Seat (SeatID, SeatNumber) values (6, 'A6');
insert into Seat (SeatID, SeatNumber) values (7, 'A7');
insert into Seat (SeatID, SeatNumber) values (8, 'A8');
insert into Seat (SeatID, SeatNumber) values (9, 'A9');
insert into Seat (SeatID, SeatNumber) values (10, 'A10');
insert into Seat (SeatID, SeatNumber) values (11, 'B1');
insert into Seat (SeatID, SeatNumber) values (12, 'B2');
insert into Seat (SeatID, SeatNumber) values (13, 'B3');
insert into Seat (SeatID, SeatNumber) values (14, 'B4');
insert into Seat (SeatID, SeatNumber) values (15, 'B5');
insert into Seat (SeatID, SeatNumber) values (16, 'B6');
insert into Seat (SeatID, SeatNumber) values (17, 'B7');
insert into Seat (SeatID, SeatNumber) values (18, 'B8');
insert into Seat (SeatID, SeatNumber) values (19, 'B9');
insert into Seat (SeatID, SeatNumber) values (20, 'B10');
insert into Seat (SeatID, SeatNumber) values (21, 'C1');
insert into Seat (SeatID, SeatNumber) values (22, 'C2');
insert into Seat (SeatID, SeatNumber) values (23, 'C3');
insert into Seat (SeatID, SeatNumber) values (24, 'C4');
insert into Seat (SeatID, SeatNumber) values (25, 'C5');
insert into Seat (SeatID, SeatNumber) values (26, 'C6');
insert into Seat (SeatID, SeatNumber) values (27, 'C7');
insert into Seat (SeatID, SeatNumber) values (28, 'C8');
insert into Seat (SeatID, SeatNumber) values (29, 'C9');
insert into Seat (SeatID, SeatNumber) values (30, 'C10');
insert into Seat (SeatID, SeatNumber) values (31, 'D1');
insert into Seat (SeatID, SeatNumber) values (32, 'D2');
insert into Seat (SeatID, SeatNumber) values (33, 'D3');
insert into Seat (SeatID, SeatNumber) values (34, 'D4');
insert into Seat (SeatID, SeatNumber) values (35, 'D5');
insert into Seat (SeatID, SeatNumber) values (36, 'D6');
insert into Seat (SeatID, SeatNumber) values (37, 'D7');
insert into Seat (SeatID, SeatNumber) values (38, 'D8');
insert into Seat (SeatID, SeatNumber) values (39, 'D9');
insert into Seat (SeatID, SeatNumber) values (40, 'D10');
insert into Seat (SeatID, SeatNumber) values (41, 'E1');
insert into Seat (SeatID, SeatNumber) values (42, 'E2');
insert into Seat (SeatID, SeatNumber) values (43, 'E3');
insert into Seat (SeatID, SeatNumber) values (44, 'E4');
insert into Seat (SeatID, SeatNumber) values (45, 'E5');
insert into Seat (SeatID, SeatNumber) values (46, 'E6');
insert into Seat (SeatID, SeatNumber) values (47, 'E7');
insert into Seat (SeatID, SeatNumber) values (48, 'E8');
insert into Seat (SeatID, SeatNumber) values (49, 'E9');
insert into Seat (SeatID, SeatNumber) values (50, 'E10');


-- genre
insert into Genre (GenreID, GenreName) values (1, 'Romance');
insert into Genre (GenreID, GenreName) values (2, 'Adventure');
insert into Genre (GenreID, GenreName) values (3, 'Drama');
insert into Genre (GenreID, GenreName) values (4, 'Fantasy');
insert into Genre (GenreID, GenreName) values (5, 'Science Fiction');
insert into Genre (GenreID, GenreName) values (6, 'Mystery');
insert into Genre (GenreID, GenreName) values (7, 'Family');
insert into Genre (GenreID, GenreName) values (8, 'Slice of Life');
insert into Genre (GenreID, GenreName) values (9, 'Historical');
insert into Genre (GenreID, GenreName) values (10, 'Coming-of-Age');
insert into Genre (GenreID, GenreName) values (11, 'Comedy');


-- screen format
insert into ScreenFormat (ScreenFormatID, ScreenFormat) values (1, '2D');
insert into ScreenFormat (ScreenFormatID, ScreenFormat) values (2, '3D');
insert into ScreenFormat (ScreenFormatID, ScreenFormat) values (3, '4D');


-- role in production
insert into RoleInProduction (RoleInProductionID, NameOfRole) values (1, 'Director');
insert into RoleInProduction (RoleInProductionID, NameOfRole) values (2, 'Producer');
insert into RoleInProduction (RoleInProductionID, NameOfRole) values (3, 'Screenwriter');
insert into RoleInProduction (RoleInProductionID, NameOfRole) values (4, 'Art Director');
insert into RoleInProduction (RoleInProductionID, NameOfRole) values (5, 'Character Designer');
insert into RoleInProduction (RoleInProductionID, NameOfRole) values (6, 'Animation Director');
insert into RoleInProduction (RoleInProductionID, NameOfRole) values (7, 'Music Composer');
insert into RoleInProduction (RoleInProductionID, NameOfRole) values (8, 'Sound Director');
insert into RoleInProduction (RoleInProductionID, NameOfRole) values (9, 'Key Animator');
insert into RoleInProduction (RoleInProductionID, NameOfRole) values (10, 'Background Artist');


-- production
insert into Production (ProductionID, FirstName, LastName) values (1, 'Hayao', 'Miyazaki');
insert into Production (ProductionID, FirstName, LastName) values (2, 'Toshio', 'Suzuki');
insert into Production (ProductionID, FirstName, LastName) values (3, 'Joe', 'Hisaishi');
insert into Production (ProductionID, FirstName, LastName) values (4, 'Yasuyoshi', 'Tokuma');
insert into Production (ProductionID, FirstName, LastName) values (5, 'Isao', 'Takahata');
insert into Production (ProductionID, FirstName, LastName) values (6, 'Yoshiaki', 'Nishimura');
insert into Production (ProductionID, FirstName, LastName) values (7, 'Kazuo', 'Oga');
insert into Production (ProductionID, FirstName, LastName) values (8, 'Yoshiyuki', 'Momose');
insert into Production (ProductionID, FirstName, LastName) values (9, 'Kazuo', 'Komatsubara');
insert into Production (ProductionID, FirstName, LastName) values (10, 'Yoshiyuki', 'Kasuga');