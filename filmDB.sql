DROP DATABASE IF EXISTS GhiblifilmsDB;
CREATE DATABASE GhiblifilmsDB;
USE GhiblifilmsDB;


-- postal code
CREATE TABLE PostalCode (
  PostalCode VARCHAR(10) NOT NULL PRIMARY KEY,
  City VARCHAR(168) NOT NULL
) ENGINE=InnoDB;


-- address
CREATE TABLE Address (
  AddressID INT AUTO_INCREMENT PRIMARY KEY,
  StreetName VARCHAR(255) NOT NULL,
  StreetNumber VARCHAR(10) NOT NULL,
  PostalCode varchar(10) NOT NULL,
  Country VARCHAR(150) NOT NULL,
  FOREIGN KEY (PostalCode) REFERENCES PostalCode(PostalCode)
) ENGINE=InnoDB; 


-- user 
CREATE TABLE User (
  UserID INT AUTO_INCREMENT PRIMARY KEY,
  FirstName VARCHAR(255) NOT NULL,
  LastName VARCHAR(255) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  PhoneNumber VARCHAR(255) NOT NULL,
  AddressID INT,
  FOREIGN KEY (AddressID) REFERENCES Address(AddressID)
) ENGINE=InnoDB;


-- user login
CREATE TABLE UserLogin (
  UserLoginID int NOT NULL AUTO_INCREMENT PRIMARY KEY,  
  Username VARCHAR(50) NOT NULL,                        
  Pass VARCHAR(255) NOT NULL
) ENGINE=InnoDB;


-- auditorium
CREATE TABLE Auditorium (
  AuditoriumID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  AuditoriumNumber varchar(5) NOT NULL
) ENGINE=InnoDB;


-- seat
CREATE TABLE Seat (
  SeatID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  SeatNumber varchar(3) NOT NULL
) ENGINE=InnoDB;


-- genre
CREATE TABLE Genre (
  GenreID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  GenreName varchar(30) NOT NULL
) ENGINE=InnoDB;


-- screen format
CREATE TABLE ScreenFormat (
  ScreenFormatID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ScreenFormat varchar(2) NOT NULL
) ENGINE=InnoDB;


-- role in production
CREATE TABLE RoleInProduction (
  RoleInProductionID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  NameOfRole varchar(50) NOT NULL
) ENGINE=InnoDB;


-- production
CREATE TABLE Production (
  ProductionID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FirstName varchar(50) NOT NULL,
  LastName varchar(50) NOT NULL,
  RoleInProductionID INT NOT NULL,
  FOREIGN KEY (RoleInProductionID) REFERENCES RoleInProduction(RoleInProductionID)
) ENGINE=InnoDB;


-- voice actor
CREATE TABLE VoiceActor (
  VoiceActorID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FirstName varchar(50) NOT NULL,
  LastName varchar(50) NOT NULL
) ENGINE=InnoDB;


-- movie
CREATE TABLE Movie (
  MovieID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Name` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  ReleaseYear int (4) NOT NULL,
  Duration varchar(7) NOT NULL,
  MovieImg varchar(255) NOT NULL,
  ScreenFormatID INT NOT NULL,
  FOREIGN KEY (ScreenFormatID) REFERENCES ScreenFormat(ScreenFormatID)
) ENGINE=InnoDB;


-- movie genres
CREATE TABLE MovieGenre (
  MovieID INT NOT NULL,
  GenreID INT NOT NULL,
  CONSTRAINT PK_MovieGenre PRIMARY KEY (MovieID, GenreID),
  FOREIGN KEY (MovieID) REFERENCES Movie(MovieID),
  FOREIGN KEY (GenreID) REFERENCES Genre(GenreID)
) ENGINE=InnoDB;


-- movie production actor
CREATE TABLE MovieProduction (
  MovieID INT NOT NULL,
  ProductionID INT NOT NULL,
  CONSTRAINT PK_MovieProduction PRIMARY KEY (MovieID, ProductionID),
  FOREIGN KEY (MovieID) REFERENCES Movie(MovieID),
  FOREIGN KEY (ProductionID) REFERENCES Production(ProductionID)
) ENGINE=InnoDB;


-- movie voice actor
CREATE TABLE MovieVoiceActor (
  MovieID INT NOT NULL,
  VoiceActorID INT NOT NULL,
  CONSTRAINT PK_MovieVoiceActor PRIMARY KEY (MovieID, VoiceActorID),
  FOREIGN KEY (MovieID) REFERENCES Movie(MovieID),
  FOREIGN KEY (VoiceActorID) REFERENCES VoiceActor(VoiceActorID)
) ENGINE=InnoDB;


-- reservation
CREATE TABLE Reservation (
  ReservationID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Date` date NOT NULL,
  `Time` varchar(8) NOT NULL,
  NumberOfSeatsBooked int(1) NOT NULL,
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
  CONSTRAINT PK_SeatReservation PRIMARY KEY (ReservationID, SeatID),
  FOREIGN KEY (ReservationID) REFERENCES Reservation(ReservationID),
  FOREIGN KEY (SeatID) REFERENCES Seat(SeatID)
) ENGINE=InnoDB;


-- news
CREATE TABLE News (
  NewsID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Headline varchar(168) NOT NULL,
  SubHeadline varchar(168) NOT NULL,
  TextOfNews text NOT NULL,
  NewsImg varchar(255) NOT NULL
) ENGINE=InnoDB;


-- company information
CREATE TABLE CompanyInformation (
  CompanyInformationID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  NameOfCompany varchar(11) NOT NULL,
  CompanyDescription text NOT NULL,
  CompanyEmail varchar(255) NOT NULL,
  CompanyPhoneNumber varchar(20) NOT NULL,
  AddressID INT,
  FOREIGN KEY (AddressID) REFERENCES Address(AddressID)
) ENGINE=InnoDB;


-- contact form
CREATE TABLE ContactForm (
  ContactFormID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FirstName varchar(50) NOT NULL,
  LastName varchar(50) NOT NULL,
  Email varchar(255) NOT NULL,
  PhoneNumber varchar(20) NOT NULL,
  MessageText text
) ENGINE=InnoDB;


-- opening hours
CREATE TABLE OpeningHour (
  OpeningHourID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Day` varchar(9) NOT NULL,
  `Time` varchar(13) NOT NULL
) ENGINE=InnoDB;


-- payment
CREATE TABLE Payment (
  PaymentID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  PaymentType varchar(9) NOT NULL
) ENGINE=InnoDB;


-- showings
CREATE TABLE Showings (
  ShowingID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  MovieID INT NOT NULL,
  AuditoriumID INT NOT NULL,
  ScreenFormatID INT NOT NULL,
  ShowingDate DATE NOT NULL,
  ShowingTime TIME NOT NULL,
  SeatsAvailable INT NOT NULL,
  FOREIGN KEY (MovieID) REFERENCES Movie(MovieID),
  FOREIGN KEY (AuditoriumID) REFERENCES Auditorium(AuditoriumID),
  FOREIGN KEY (ScreenFormatID) REFERENCES ScreenFormat(ScreenFormatID)
) ENGINE=InnoDB;


-- views
-- user + address view
CREATE VIEW UserAddressView AS
SELECT U.*, A.StreetName, A.StreetNumber, A.Country, A.PostalCode 
FROM User U 
LEFT JOIN Address A ON U.AddressID = A.AddressID;


-- company + address view
CREATE VIEW CompanyAddressView AS
SELECT C.*, A.StreetName, A.StreetNumber, A.Country, A.PostalCode 
FROM CompanyInformation C 
LEFT JOIN Address A ON C.AddressID = A.AddressID;


-- data to insert

-- postal code 
INSERT INTO PostalCode (PostalCode, City) VALUES (6500, 'Vojens');
INSERT INTO PostalCode (PostalCode, City) VALUES (6700, 'Esbjerg');
INSERT INTO PostalCode (PostalCode, City) VALUES (6800, 'Varde');

-- auditorium
insert into Auditorium (AuditoriumID, AuditoriumNumber) values (NULL, 'Bio 1');
insert into Auditorium (AuditoriumID, AuditoriumNumber) values (NULL, 'Bio 2');
insert into Auditorium (AuditoriumID, AuditoriumNumber) values (NULL, 'Bio 3');
insert into Auditorium (AuditoriumID, AuditoriumNumber) values (NULL, 'Bio 4');
insert into Auditorium (AuditoriumID, AuditoriumNumber) values (NULL, 'Bio 5');


-- seat
insert into Seat (SeatID, SeatNumber) values (NULL, 'A1');
insert into Seat (SeatID, SeatNumber) values (NULL, 'A2');
insert into Seat (SeatID, SeatNumber) values (NULL, 'A3');
insert into Seat (SeatID, SeatNumber) values (NULL, 'A4');
insert into Seat (SeatID, SeatNumber) values (NULL, 'A5');
insert into Seat (SeatID, SeatNumber) values (NULL, 'A6');
insert into Seat (SeatID, SeatNumber) values (NULL, 'A7');
insert into Seat (SeatID, SeatNumber) values (NULL, 'A8');
insert into Seat (SeatID, SeatNumber) values (NULL, 'A9');
insert into Seat (SeatID, SeatNumber) values (NULL, 'A10');
insert into Seat (SeatID, SeatNumber) values (NULL, 'B1');
insert into Seat (SeatID, SeatNumber) values (NULL, 'B2');
insert into Seat (SeatID, SeatNumber) values (NULL, 'B3');
insert into Seat (SeatID, SeatNumber) values (NULL, 'B4');
insert into Seat (SeatID, SeatNumber) values (NULL, 'B5');
insert into Seat (SeatID, SeatNumber) values (NULL, 'B6');
insert into Seat (SeatID, SeatNumber) values (NULL, 'B7');
insert into Seat (SeatID, SeatNumber) values (NULL, 'B8');
insert into Seat (SeatID, SeatNumber) values (NULL, 'B9');
insert into Seat (SeatID, SeatNumber) values (NULL, 'B10');
insert into Seat (SeatID, SeatNumber) values (NULL, 'C1');
insert into Seat (SeatID, SeatNumber) values (NULL, 'C2');
insert into Seat (SeatID, SeatNumber) values (NULL, 'C3');
insert into Seat (SeatID, SeatNumber) values (NULL, 'C4');
insert into Seat (SeatID, SeatNumber) values (NULL, 'C5');
insert into Seat (SeatID, SeatNumber) values (NULL, 'C6');
insert into Seat (SeatID, SeatNumber) values (NULL, 'C7');
insert into Seat (SeatID, SeatNumber) values (NULL, 'C8');
insert into Seat (SeatID, SeatNumber) values (NULL, 'C9');
insert into Seat (SeatID, SeatNumber) values (NULL, 'C10');
insert into Seat (SeatID, SeatNumber) values (NULL, 'D1');
insert into Seat (SeatID, SeatNumber) values (NULL, 'D2');
insert into Seat (SeatID, SeatNumber) values (NULL, 'D3');
insert into Seat (SeatID, SeatNumber) values (NULL, 'D4');
insert into Seat (SeatID, SeatNumber) values (NULL, 'D5');
insert into Seat (SeatID, SeatNumber) values (NULL, 'D6');
insert into Seat (SeatID, SeatNumber) values (NULL, 'D7');
insert into Seat (SeatID, SeatNumber) values (NULL, 'D8');
insert into Seat (SeatID, SeatNumber) values (NULL, 'D9');
insert into Seat (SeatID, SeatNumber) values (NULL, 'D10');
insert into Seat (SeatID, SeatNumber) values (NULL, 'E1');
insert into Seat (SeatID, SeatNumber) values (NULL, 'E2');
insert into Seat (SeatID, SeatNumber) values (NULL, 'E3');
insert into Seat (SeatID, SeatNumber) values (NULL, 'E4');
insert into Seat (SeatID, SeatNumber) values (NULL, 'E5');
insert into Seat (SeatID, SeatNumber) values (NULL, 'E6');
insert into Seat (SeatID, SeatNumber) values (NULL, 'E7');
insert into Seat (SeatID, SeatNumber) values (NULL, 'E8');
insert into Seat (SeatID, SeatNumber) values (NULL, 'E9');
insert into Seat (SeatID, SeatNumber) values (NULL, 'E10');


-- genre
insert into Genre (GenreID, GenreName) values (1, 'Romance');
insert into Genre (GenreID, GenreName) values (2, 'Adventure');
insert into Genre (GenreID, GenreName) values (3, 'Drama');
insert into Genre (GenreID, GenreName) values (4, 'Fantasy');
insert into Genre (GenreID, GenreName) values (5, 'Dark fantasy');
insert into Genre (GenreID, GenreName) values (6, 'Mystery');
insert into Genre (GenreID, GenreName) values (7, 'Family');
insert into Genre (GenreID, GenreName) values (8, 'Slice of Life');
insert into Genre (GenreID, GenreName) values (9, 'Historical');
insert into Genre (GenreID, GenreName) values (10, 'Coming-of-Age');
insert into Genre (GenreID, GenreName) values (11, 'Comedy');
insert into Genre (GenreID, GenreName) values (12, 'Tragedy');


-- screen format
insert into ScreenFormat (ScreenFormatID, ScreenFormat) values (NULL, '2D');
insert into ScreenFormat (ScreenFormatID, ScreenFormat) values (NULL, '3D');
insert into ScreenFormat (ScreenFormatID, ScreenFormat) values (NULL, '4D');


-- role in production
insert into RoleInProduction (RoleInProductionID, NameOfRole) values (NULL, 'Director');
insert into RoleInProduction (RoleInProductionID, NameOfRole) values (NULL, 'Producer');
insert into RoleInProduction (RoleInProductionID, NameOfRole) values (NULL, 'Art Director');
insert into RoleInProduction (RoleInProductionID, NameOfRole) values (NULL, 'Animation Director');
insert into RoleInProduction (RoleInProductionID, NameOfRole) values (NULL, 'Music Composer');
insert into RoleInProduction (RoleInProductionID, NameOfRole) values (NULL, 'Sound Director');
insert into RoleInProduction (RoleInProductionID, NameOfRole) values (NULL, 'Editor');


-- production
-- the boy and the heron
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (1, 'Hayao', 'Miyazaki', 1);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (2, 'Toshio', 'Suzuki', 2);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (3, 'Yôji', 'Takeshige', 3);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (4, 'Takeshi', 'Honda', 4);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (5, 'Joe', 'Hisaishi', 5);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (6, 'Kôji', 'Kasamatsu', 6);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (7, 'Rie', 'Matsubara', 7);

-- spirited away
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (8, 'Hironori', 'Aihara', 2);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (9, 'Masashi', 'Andô', 4);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (10, 'Toshiaki', 'Abe', 6);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (11, 'Takeshi', 'Seyama', 7);

-- Howls moving castle
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (12, 'Rick', 'Dempsey', 2);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (13, 'Akihiko', 'Adachi', 4);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (14, 'Suminobu', 'Hamada', 6);

-- princess mononoke
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (15, 'Tsutomu', 'Asakura', 6);

-- My neighbour Totoro 
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (16, 'Nobuko', 'Mizuta', 3);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (17, 'Junko', 'Adachi', 4);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (18, 'Kaiulani', 'Kidani', 5);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (19, 'Shigeharu', 'Shiba', 6);

-- Ponyo
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (20, 'Noboru', 'Yoshida', 3);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (21, 'Tsutomu', 'Awada', 4);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (22, 'Atsushi', 'Aikawa', 6);

-- Kikis delivery service
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (23, 'Tôru', 'Hara', 2);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (24, 'Hiroshi', 'Ôno', 3);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (25, 'Naoko', 'Asari', 6);

-- Tales from Earthsea
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (26, 'Gorô', 'Miyazaki', 1);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (27, 'Rie', 'Kojô', 3);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (28, 'Takahiko', 'Abiru', 4);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (29, 'Tamiya', 'Terashima', 5);

-- The tale of the princess Kaguya
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (30, 'Isao', 'Takahata', 1);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (31, 'Geoffrey', 'Wexler', 2);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (32, 'Kazuo', 'Oga', 3);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (33, 'Misato', 'Aida', 4);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (34, 'Mikio', 'Mori', 6);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (35, 'Toshihiko', 'Kojima', 7);

-- The secret world of Arrietty
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (36, 'Hiromasa', 'Yonebayashi', 1);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (37, 'Shigeo', 'Akahori', 4);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (38, 'Cécile', 'Corbel', 5);

-- The wind rises
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (39, 'Hiroyuki', 'Aoyama', 4);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (40, 'Marco', 'Alicea', 6);

-- From up on Poppy Hill
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (41, 'Tetsurô', 'Sayama', 2);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (42, 'Satoko', 'Nakamura', 3);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (43, 'Kazuyuki', 'Abe', 4);
insert into Production (ProductionID, FirstName, LastName, RoleInProductionID) values (44, 'Satoshi', 'Takebe', 5);


-- voice actor
-- The boy and the heron
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Soma', 'Santoki');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Masaki', 'Suda');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Kô', 'Shibasaki');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Aimyon', 'Himi');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Yoshino', 'Kimura');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Takuya', 'Kimura');

-- spirited away
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Miyu', 'Irino');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Rumi', 'Hiiragi');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Mari', 'Natsuki');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Takashi', 'Naitô');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Yasuko', 'Sawaguchi');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Tatsuya', 'Gashûin');

-- howls moving castle
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Chieko', 'Baishô');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Akihiro', 'Miwa');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Ryunosuke', 'Kamiki');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Mitsunori', 'Isaki');

-- princess mononoke
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Yôji', 'Matsuda');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Yuriko', 'Ishida');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Yûko', 'Tanaka');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Kei', 'Iinuma');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Michiko', 'Yamamoto');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Shirô', 'Saitô');

-- my neighbour Totoro
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Hitoshi', 'Takagi');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Noriko', 'Hidaka');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Chika', 'Sakamoto');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Shigesato', 'Itoi');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Sumi', 'Shimamoto');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Tanie', 'Kitabayashi');

-- ponyo
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Tomoko', 'Yamaguchi');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Kazushige', 'Nagashima');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Yûki', 'Amami');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'George', 'Tokoro');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Yuria', 'Nara');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Hiroki', 'Doi');

-- kikis delivery service
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Minami', 'Takayama');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Rei', 'Sakuma');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Kappei', 'Yamaguchi');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Keiko', 'Toda');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Mieko', 'Nobusawa');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Kôichi', 'Miura');

-- tales from Earthsea
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Aoi', 'Teshima');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Bunta', 'Sugawara');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Teruyuki', 'Kagawa');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Jun', 'Fubuki');

-- the tale of the princess Kaguya
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Aki', 'Asakura');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Kengo', 'Kôra');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Takeo', 'Chii');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Nobuko', 'Miyamoto');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Atsuko', 'Takahata');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Tomoko', 'Tabata');

-- the secret world of Arrietty
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Mirai', 'Shida');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Tatsuya', 'Fujiwara');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Tomokazu', 'Miura');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Shinobu', 'Ôtake');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Keiko', 'Takeshita');

-- the wind rises
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Hideaki', 'Anno');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Hidetoshi', 'Nishijima');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Miori', 'Takimoto');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Masahiko', 'Nishimura');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Mansai', 'Nomura');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Jun', 'Kunimura');

-- from up on Poppy Hill
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Masami', 'Nagasawa');


-- movie
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, ScreenFormatID) values (NULL, 'The boy and the heron', 'In the wake of his mothers death and his fathers remarriage, a headstrong boy named Mahito ventures into a dreamlike world shared by both the living and the dead.', 2023, '2h 4m', 'imglink', 3);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, ScreenFormatID) values (NULL, 'Spirited away', 'During her familys move to the suburbs, a sullen 10-year-old girl wanders into a world ruled by gods, witches and spirits, and where humans are changed into beasts.', 2001, '2h 4m', 'imglink', 1);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, ScreenFormatID) values (NULL, 'Howls moving castle', 'When an unconfident young woman is cursed with an old body by a spiteful witch, her only chance of breaking the spell lies with a self-indulgent yet insecure young wizard and his companions in his legged, walking castle.', 2004, '1h 59m', 'imglink', 2);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, ScreenFormatID) values (NULL, 'Princess Mononoke', 'On a journey to find the cure for a Tatarigamis curse, Ashitaka finds himself in the middle of a war between the forest gods and Tatara, a mining colony. In this quest he also meets San, the Mononoke Hime.', 1997, '2h 13m', 'img link', 1);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, ScreenFormatID) values (NULL, 'My neighbour Totoro', 'When two girls move to the country to be near their ailing mother, they have adventures with the wondrous forest spirits who live nearby.', 1988, '1h 26m', 'imglink', 1);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, ScreenFormatID) values (NULL, 'Ponyo', 'A five-year-old boy develops a relationship with Ponyo, a young goldfish princess who longs to become a human after falling in love with him.', 2008, '1h 41m', 'imglink', 3);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, ScreenFormatID) values (NULL, 'Kikis delivery service', 'Along with her black cat Jiji, Kiki settles in a seaside town and starts a high-flying delivery service. Here begins her magical encounter with independence and responsibility, making lifelong friends and finding her place in the world.', 1989, '1h 43m', 'imglink', 1);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, ScreenFormatID) values (NULL, 'Tales from Earthsea', 'In a mythical land, a man and a young boy investigate a series of unusual occurrences.', 2006, '1h 55m', 'imglink', 1);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, ScreenFormatID) values (NULL, 'The tale of the princess Kaguya', 'Kaguya is a beautiful young woman coveted by five nobles. To try to avoid marrying a stranger she doesnt love, she sends her suitors on seemingly impossible tasks. But she will have to face her fate and punishment for her choices.', 2013, '2h 17m', 'imglink', 3);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, ScreenFormatID) values (NULL, 'The secret world of Arrietty', 'The Clock family are four-inch-tall people who live anonymously in another familys residence, borrowing simple items to make their home. Life changes for the Clocks when their teenage daughter Arrietty is discovered.', 2010, '1h 34m', 'imglink', 3);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, ScreenFormatID) values (NULL, 'The wind rises', 'Jiro Horikoshi studies assiduously to fulfill his aim of becoming an aeronautical engineer. As WWII begins, fighter aircraft designed by him end up getting used by the Japanese Empire against its foes.', 2013, '2h 6m', 'imglink', 1);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, ScreenFormatID) values (NULL, 'From up on Poppy Hill', 'A group of Yokohama teens look to save their schools clubhouse from the wrecking ball in preparations for the 1964 Tokyo Olympics.', 2011, '1h 31m', 'imglink', 2);


-- movie genres
-- the boy and the heron
insert into MovieGenre (MovieID, GenreID) values (1, 2);
insert into MovieGenre (MovieID, GenreID) values (1, 3);
insert into MovieGenre (MovieID, GenreID) values (1, 4);

-- spirited away
insert into MovieGenre (MovieID, GenreID) values (2, 2);
insert into MovieGenre (MovieID, GenreID) values (2, 4);
insert into MovieGenre (MovieID, GenreID) values (2, 6);
insert into MovieGenre (MovieID, GenreID) values (2, 7);
insert into MovieGenre (MovieID, GenreID) values (2, 10);

-- howls moving castle
insert into MovieGenre (MovieID, GenreID) values (3, 2);
insert into MovieGenre (MovieID, GenreID) values (3, 4);
insert into MovieGenre (MovieID, GenreID) values (3, 7);

-- princess mononoke
insert into MovieGenre (MovieID, GenreID) values (4, 2);
insert into MovieGenre (MovieID, GenreID) values (4, 4);
insert into MovieGenre (MovieID, GenreID) values (4, 5);

-- my neighbour Totoro
insert into MovieGenre (MovieID, GenreID) values (5, 4);
insert into MovieGenre (MovieID, GenreID) values (5, 7);
insert into MovieGenre (MovieID, GenreID) values (5, 11);

-- ponyo
insert into MovieGenre (MovieID, GenreID) values (6, 2);
insert into MovieGenre (MovieID, GenreID) values (6, 4);
insert into MovieGenre (MovieID, GenreID) values (6, 7);
insert into MovieGenre (MovieID, GenreID) values (6, 11);

-- kikis delivery service
insert into MovieGenre (MovieID, GenreID) values (7, 4);
insert into MovieGenre (MovieID, GenreID) values (7, 7);

-- tales from Earthsea
insert into MovieGenre (MovieID, GenreID) values (8, 2);
insert into MovieGenre (MovieID, GenreID) values (8, 4);

-- the tale of the princess kaguya
insert into MovieGenre (MovieID, GenreID) values (9, 3);
insert into MovieGenre (MovieID, GenreID) values (9, 10);
insert into MovieGenre (MovieID, GenreID) values (9, 12);

-- the secret world of arrietty
insert into MovieGenre (MovieID, GenreID) values (10, 2);
insert into MovieGenre (MovieID, GenreID) values (10, 3);
insert into MovieGenre (MovieID, GenreID) values (10, 4);
insert into MovieGenre (MovieID, GenreID) values (10, 7);

-- the wind rises
insert into MovieGenre (MovieID, GenreID) values (11, 8);
insert into MovieGenre (MovieID, GenreID) values (11, 12);

-- from up on poppy hill
insert into MovieGenre (MovieID, GenreID) values (12, 1);
insert into MovieGenre (MovieID, GenreID) values (12, 3);
insert into MovieGenre (MovieID, GenreID) values (12, 8);
insert into MovieGenre (MovieID, GenreID) values (12, 11);


-- movie production actor
-- the boy and the heron
insert into MovieProduction (MovieID, ProductionID) values (1, 1);
insert into MovieProduction (MovieID, ProductionID) values (1, 2);
insert into MovieProduction (MovieID, ProductionID) values (1, 3);
insert into MovieProduction (MovieID, ProductionID) values (1, 4);
insert into MovieProduction (MovieID, ProductionID) values (1, 5);
insert into MovieProduction (MovieID, ProductionID) values (1, 6);
insert into MovieProduction (MovieID, ProductionID) values (1, 7);

-- spirited away
insert into MovieProduction (MovieID, ProductionID) values (2, 1);
insert into MovieProduction (MovieID, ProductionID) values (2, 8);
insert into MovieProduction (MovieID, ProductionID) values (2, 3);
insert into MovieProduction (MovieID, ProductionID) values (2, 9);
insert into MovieProduction (MovieID, ProductionID) values (2, 5);
insert into MovieProduction (MovieID, ProductionID) values (2, 10);
insert into MovieProduction (MovieID, ProductionID) values (2, 11);

-- Howls moving castle
insert into MovieProduction (MovieID, ProductionID) values (3, 1);
insert into MovieProduction (MovieID, ProductionID) values (3, 12);
insert into MovieProduction (MovieID, ProductionID) values (3, 3);
insert into MovieProduction (MovieID, ProductionID) values (3, 13);
insert into MovieProduction (MovieID, ProductionID) values (3, 5);
insert into MovieProduction (MovieID, ProductionID) values (3, 14);
insert into MovieProduction (MovieID, ProductionID) values (3, 11);

-- princess mononoke
insert into MovieProduction (MovieID, ProductionID) values (4, 1); 
insert into MovieProduction (MovieID, ProductionID) values (4, 2);
insert into MovieProduction (MovieID, ProductionID) values (4, 3);
insert into MovieProduction (MovieID, ProductionID) values (4, 13);
insert into MovieProduction (MovieID, ProductionID) values (4, 5);
insert into MovieProduction (MovieID, ProductionID) values (4, 15);
insert into MovieProduction (MovieID, ProductionID) values (4, 11);

-- My neighbour Totoro
insert into MovieProduction (MovieID, ProductionID) values (5, 1);
insert into MovieProduction (MovieID, ProductionID) values (5, 12);
insert into MovieProduction (MovieID, ProductionID) values (5, 16);
insert into MovieProduction (MovieID, ProductionID) values (5, 17);
insert into MovieProduction (MovieID, ProductionID) values (5, 18);
insert into MovieProduction (MovieID, ProductionID) values (5, 19);
insert into MovieProduction (MovieID, ProductionID) values (5, 11);

-- Ponyo
insert into MovieProduction (MovieID, ProductionID) values (6, 1);
insert into MovieProduction (MovieID, ProductionID) values (6, 2);
insert into MovieProduction (MovieID, ProductionID) values (6, 20);
insert into MovieProduction (MovieID, ProductionID) values (6, 21);
insert into MovieProduction (MovieID, ProductionID) values (6, 5);
insert into MovieProduction (MovieID, ProductionID) values (6, 22);
insert into MovieProduction (MovieID, ProductionID) values (6, 11);

-- Kikis delivery service
insert into MovieProduction (MovieID, ProductionID) values (7, 1);
insert into MovieProduction (MovieID, ProductionID) values (7, 23);
insert into MovieProduction (MovieID, ProductionID) values (7, 24);
insert into MovieProduction (MovieID, ProductionID) values (7, 17);
insert into MovieProduction (MovieID, ProductionID) values (7, 5);
insert into MovieProduction (MovieID, ProductionID) values (7, 25);
insert into MovieProduction (MovieID, ProductionID) values (7, 11);

-- Tales from Earthsea
insert into MovieProduction (MovieID, ProductionID) values (8, 26);
insert into MovieProduction (MovieID, ProductionID) values (8, 2);
insert into MovieProduction (MovieID, ProductionID) values (8, 27);
insert into MovieProduction (MovieID, ProductionID) values (8, 28);
insert into MovieProduction (MovieID, ProductionID) values (8, 29);
insert into MovieProduction (MovieID, ProductionID) values (8, 22);
insert into MovieProduction (MovieID, ProductionID) values (8, 11);

-- The tale of the princess Kaguya
insert into MovieProduction (MovieID, ProductionID) values (9, 30);
insert into MovieProduction (MovieID, ProductionID) values (9, 31);
insert into MovieProduction (MovieID, ProductionID) values (9, 32);
insert into MovieProduction (MovieID, ProductionID) values (9, 33);
insert into MovieProduction (MovieID, ProductionID) values (9, 5);
insert into MovieProduction (MovieID, ProductionID) values (9, 34);
insert into MovieProduction (MovieID, ProductionID) values (9, 35);

-- The secret world of Arrietty
insert into MovieProduction (MovieID, ProductionID) values (10, 36);
insert into MovieProduction (MovieID, ProductionID) values (10, 2);
insert into MovieProduction (MovieID, ProductionID) values (10, 3);
insert into MovieProduction (MovieID, ProductionID) values (10, 37);
insert into MovieProduction (MovieID, ProductionID) values (10, 38);
insert into MovieProduction (MovieID, ProductionID) values (10, 22);
insert into MovieProduction (MovieID, ProductionID) values (10, 7);

-- The wind rises
insert into MovieProduction (MovieID, ProductionID) values (11, 1);
insert into MovieProduction (MovieID, ProductionID) values (11, 2);
insert into MovieProduction (MovieID, ProductionID) values (11, 3);
insert into MovieProduction (MovieID, ProductionID) values (11, 39);
insert into MovieProduction (MovieID, ProductionID) values (11, 5);
insert into MovieProduction (MovieID, ProductionID) values (11, 40);
insert into MovieProduction (MovieID, ProductionID) values (11, 11);

-- From up on Poppy Hill
insert into MovieProduction (MovieID, ProductionID) values (12, 26);
insert into MovieProduction (MovieID, ProductionID) values (12, 41);
insert into MovieProduction (MovieID, ProductionID) values (12, 42);
insert into MovieProduction (MovieID, ProductionID) values (12, 43);
insert into MovieProduction (MovieID, ProductionID) values (12, 44);
insert into MovieProduction (MovieID, ProductionID) values (12, 22);
insert into MovieProduction (MovieID, ProductionID) values (12, 11);


-- MovieVoiceActor here
-- the boy and the heron
insert into MovieVoiceActor (MovieID, VoiceActorID) values (1, 1);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (1, 2);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (1, 3);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (1, 4);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (1, 5);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (1, 6);

-- spirited away
insert into MovieVoiceActor (MovieID, VoiceActorID) values (2, 7);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (2, 8);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (2, 9);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (2, 10);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (2, 11);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (2, 12);

-- howls moving castle
insert into MovieVoiceActor (MovieID, VoiceActorID) values (3, 13);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (3, 6);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (3, 12);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (3, 14);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (3, 15);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (3, 16);

-- princess mononoke
insert into MovieVoiceActor (MovieID, VoiceActorID) values (4, 17);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (4, 18);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (4, 19);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (4, 20);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (4, 21);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (4, 22);

-- my neighbour Totoro
insert into MovieVoiceActor (MovieID, VoiceActorID) values (5, 23);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (5, 24);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (5, 25);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (5, 26);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (5, 27);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (5, 28);

-- ponyo
insert into MovieVoiceActor (MovieID, VoiceActorID) values (6, 29);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (6, 30);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (6, 31);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (6, 32);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (6, 33);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (6, 34);

-- kikis delivery service
insert into MovieVoiceActor (MovieID, VoiceActorID) values (7, 35);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (7, 36);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (7, 37);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (7, 38);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (7, 39);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (7, 40);

-- tales from Earthsea
insert into MovieVoiceActor (MovieID, VoiceActorID) values (8, 41);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (8, 42);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (8, 19);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (8, 43);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (8, 44);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (8, 10);

-- the tale of the princess Kaguya
insert into MovieVoiceActor (MovieID, VoiceActorID) values (9, 45);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (9, 46);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (9, 47);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (9, 48);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (9, 49);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (9, 50);

-- the secret world of Arrietty
insert into MovieVoiceActor (MovieID, VoiceActorID) values (10, 51);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (10, 15);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (10, 52);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (10, 53);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (10, 54);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (10, 10);

-- the wind rises
insert into MovieVoiceActor (MovieID, VoiceActorID) values (11, 55);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (11, 56);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (11, 57);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (11, 58);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (11, 59);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (11, 60);

-- from up on Poppy Hill
insert into MovieVoiceActor (MovieID, VoiceActorID) values (12, 61);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (12, 54);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (12, 18);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (12, 8);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (12, 44);
insert into MovieVoiceActor (MovieID, VoiceActorID) values (12, 10);



-- opening hours
insert into OpeningHour (OpeningHourID, `Day`, `Time`) values (1, 'Monday', '17.00 - 22.00');
insert into OpeningHour (OpeningHourID, `Day`, `Time`) values (2, 'Tuesday', '17.00 - 22.00');
insert into OpeningHour (OpeningHourID, `Day`, `Time`) values (3, 'Wednesday', '17.00 - 22.00');
insert into OpeningHour (OpeningHourID, `Day`, `Time`) values (4, 'Thursday', '17.00 - 22.00');
insert into OpeningHour (OpeningHourID, `Day`, `Time`) values (5, 'Friday', '17.00 - 22.00');
insert into OpeningHour (OpeningHourID, `Day`, `Time`) values (6, 'Saturday', '12.00 - 22.00');
insert into OpeningHour (OpeningHourID, `Day`, `Time`) values (7, 'Sunday', '12.00 - 22.00');