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
  ReleaseYear int (4),
  Duration varchar(7),
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


-- movie genre
CREATE TABLE MovieGenre (
  MovieID INT NOT NULL,
  GenreID INT NOT NULL,
  CONSTRAINT PK_MovieGenre PRIMARY KEY (MovieID, GenreID),
  FOREIGN KEY (MovieID) REFERENCES Movie(MovieID),
  FOREIGN KEY (GenreID) REFERENCES Genre(GenreID)
) ENGINE=InnoDB;


-- reservation
CREATE TABLE Reservation (
  ReservationID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Date` date,
  `Time` varchar(8),
  NumberOfSeatsBooked int(1),
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
insert into PostalCode (PostalCode, City) values ('188838', 'Ilichëvo');
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
insert into Genre (GenreID, GenreName) values (NULL, 'Romance');
insert into Genre (GenreID, GenreName) values (NULL, 'Adventure');
insert into Genre (GenreID, GenreName) values (NULL, 'Drama');
insert into Genre (GenreID, GenreName) values (NULL, 'Fantasy');
insert into Genre (GenreID, GenreName) values (NULL, 'Science Fiction');
insert into Genre (GenreID, GenreName) values (NULL, 'Mystery');
insert into Genre (GenreID, GenreName) values (NULL, 'Family');
insert into Genre (GenreID, GenreName) values (NULL, 'Slice of Life');
insert into Genre (GenreID, GenreName) values (NULL, 'Historical');
insert into Genre (GenreID, GenreName) values (NULL, 'Coming-of-Age');
insert into Genre (GenreID, GenreName) values (NULL, 'Comedy');


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
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Rumi', 'Hiiragi');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Miyu', 'Irino');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Mari', 'Natsuki');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Takashi', 'Naito');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Yasuko', 'Sawaguchi');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Sumi', 'Shimamoto');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Keiko', 'Yokozawa');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Yuriko', 'Ishida');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Yuko', 'Tanaka');
insert into VoiceActor (VoiceActorID, FirstName, LastName) values (NULL, 'Kazuo', 'Kumakura');
-- MORE


-- movie
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, GenreID, ScreenFormatID, VoiceActorID, ProductionID) values (NULL, 'The boy and the heron', 'In the wake of his mothers death and his fathers remarriage, a headstrong boy named Mahito ventures into a dreamlike world shared by both the living and the dead.', 2023, '2h 4m', 'imglink', 4, 3, 2, 1);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, GenreID, ScreenFormatID, VoiceActorID, ProductionID) values (NULL, 'Spirited away', 'During her familys move to the suburbs, a sullen 10-year-old girl wanders into a world ruled by gods, witches and spirits, and where humans are changed into beasts.', 2001, '2h 4m', 'imglink', 6, 1, 3, 1);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, GenreID, ScreenFormatID, VoiceActorID, ProductionID) values (NULL, 'Howls moving castle', 'When an unconfident young woman is cursed with an old body by a spiteful witch, her only chance of breaking the spell lies with a self-indulgent yet insecure young wizard and his companions in his legged, walking castle.', 2004, '1h 59m', 'imglink', 4, 2, 2, 3);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, GenreID, ScreenFormatID, VoiceActorID, ProductionID) values (NULL, 'Princess Mononoke', 'On a journey to find the cure for a Tatarigamis curse, Ashitaka finds himself in the middle of a war between the forest gods and Tatara, a mining colony. In this quest he also meets San, the Mononoke Hime.', 1997, '2h 13m', 'img link', 7, 1, 3, 1);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, GenreID, ScreenFormatID, VoiceActorID, ProductionID) values (NULL, 'My neighbour Totoro', 'When two girls move to the country to be near their ailing mother, they have adventures with the wondrous forest spirits who live nearby.', 1988, '1h 26m', 'imglink', 9, 1, 2, 1);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, GenreID, ScreenFormatID, VoiceActorID, ProductionID) values (NULL, 'Ponyo', 'A five-year-old boy develops a relationship with Ponyo, a young goldfish princess who longs to become a human after falling in love with him.', 2008, '1h 41m', 'imglink', 5, 3, 1, 1);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, GenreID, ScreenFormatID, VoiceActorID, ProductionID) values (NULL, 'Kikis delivery service', 'Along with her black cat Jiji, Kiki settles in a seaside town and starts a high-flying delivery service. Here begins her magical encounter with independence and responsibility, making lifelong friends and finding her place in the world.', 1989, '1h 43m', 'imglink', 1, 1, 3, 2);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, GenreID, ScreenFormatID, VoiceActorID, ProductionID) values (NULL, 'Tales from Earthsea', 'In a mythical land, a man and a young boy investigate a series of unusual occurrences.', 2006, '1h 55m', 'imglink', 6, 1, 2, 3);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, GenreID, ScreenFormatID, VoiceActorID, ProductionID) values (NULL, 'The tale of the princess Kaguya', 'Kaguya is a beautiful young woman coveted by five nobles. To try to avoid marrying a stranger she doesnt love, she sends her suitors on seemingly impossible tasks. But she will have to face her fate and punishment for her choices.', 2013, '2h 17m', 'imglink', 9, 3, 2, 3);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, GenreID, ScreenFormatID, VoiceActorID, ProductionID) values (NULL, 'The secret world of Arrietty', 'The Clock family are four-inch-tall people who live anonymously in another familys residence, borrowing simple items to make their home. Life changes for the Clocks when their teenage daughter Arrietty is discovered.', 2010, '1h 34m', 'imglink', 7, 3, 2, 1);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, GenreID, ScreenFormatID, VoiceActorID, ProductionID) values (NULL, 'The wind rises', 'Jiro Horikoshi studies assiduously to fulfill his aim of becoming an aeronautical engineer. As WWII begins, fighter aircraft designed by him end up getting used by the Japanese Empire against its foes.', 2013, '2h 6m', 'imglink', 8, 1, 3, 3);
insert into Movie (MovieID, `Name`, `Description`, ReleaseYear, Duration, MovieImg, GenreID, ScreenFormatID, VoiceActorID, ProductionID) values (NULL, 'From up on Poppy Hill', 'A group of Yokohama teens look to save their schools clubhouse from the wrecking ball in preparations for the 1964 Tokyo Olympics.', 2011, '1h 31m', 'imglink', 1, 2, 3, 3);


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

