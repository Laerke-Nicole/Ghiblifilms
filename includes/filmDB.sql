DROP DATABASE IF EXISTS cb26w5b3u_ghiblifilmsdb;
CREATE DATABASE cb26w5b3u_ghiblifilmsdb;
USE cb26w5b3u_ghiblifilmsdb;



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
  PostalCode VARCHAR(10) NOT NULL,
  Country VARCHAR(150) NOT NULL,
  FOREIGN KEY (PostalCode) REFERENCES PostalCode(PostalCode) ON DELETE CASCADE
) ENGINE=InnoDB; 


-- user 
CREATE TABLE User (
  UserID INT AUTO_INCREMENT PRIMARY KEY,
  Username VARCHAR(50) NOT NULL UNIQUE,                        
  Pass VARCHAR(255) NOT NULL,
  FirstName VARCHAR(50) NOT NULL,
  LastName VARCHAR(50) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  PhoneNumber VARCHAR(20) NOT NULL,
  AddressID INT,
  Role ENUM('User', 'Admin') NOT NULL DEFAULT 'User',
  FOREIGN KEY (AddressID) REFERENCES Address(AddressID) ON DELETE CASCADE
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
  FOREIGN KEY (RoleInProductionID) REFERENCES RoleInProduction(RoleInProductionID) ON DELETE CASCADE
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
  ReleaseYear YEAR NOT NULL,
  Duration varchar(6) NOT NULL,
  MovieImg varchar(255) NOT NULL
) ENGINE=InnoDB;


-- movie genres junction table
CREATE TABLE MovieGenre (
  MovieID INT NOT NULL,
  GenreID INT NOT NULL,
  CONSTRAINT PK_MovieGenre PRIMARY KEY (MovieID, GenreID),
  FOREIGN KEY (MovieID) REFERENCES Movie(MovieID) ON DELETE CASCADE,
  FOREIGN KEY (GenreID) REFERENCES Genre(GenreID) ON DELETE CASCADE
) ENGINE=InnoDB;


-- movie production actor junction table
CREATE TABLE MovieProduction (
  MovieID INT NOT NULL,
  ProductionID INT NOT NULL,
  CONSTRAINT PK_MovieProduction PRIMARY KEY (MovieID, ProductionID),
  FOREIGN KEY (MovieID) REFERENCES Movie(MovieID) ON DELETE CASCADE,
  FOREIGN KEY (ProductionID) REFERENCES Production(ProductionID) ON DELETE CASCADE
) ENGINE=InnoDB;


-- movie voice actor junction table
CREATE TABLE MovieVoiceActor (
  MovieID INT NOT NULL,
  VoiceActorID INT NOT NULL,
  CONSTRAINT PK_MovieVoiceActor PRIMARY KEY (MovieID, VoiceActorID),
  FOREIGN KEY (MovieID) REFERENCES Movie(MovieID) ON DELETE CASCADE,
  FOREIGN KEY (VoiceActorID) REFERENCES VoiceActor(VoiceActorID) ON DELETE CASCADE
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
  FOREIGN KEY (AddressID) REFERENCES Address(AddressID) ON DELETE CASCADE
) ENGINE=InnoDB;


-- opening hours
CREATE TABLE OpeningHour (
  OpeningHourID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Day` varchar(100) NOT NULL,
  `Time` varchar(13) NOT NULL
) ENGINE=InnoDB;


-- showings
CREATE TABLE Showings (
  ShowingsID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  MovieID INT NOT NULL,
  AuditoriumID INT NOT NULL,
  ScreenFormatID INT NOT NULL,
  ShowingDate DATE NOT NULL,
  ShowingTime TIME NOT NULL,
  FOREIGN KEY (MovieID) REFERENCES Movie(MovieID) ON DELETE CASCADE,
  FOREIGN KEY (AuditoriumID) REFERENCES Auditorium(AuditoriumID) ON DELETE CASCADE,
  FOREIGN KEY (ScreenFormatID) REFERENCES ScreenFormat(ScreenFormatID) ON DELETE CASCADE
) ENGINE=InnoDB;


-- reservation
CREATE TABLE Reservation (
  ReservationID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  UserID int NOT NULL,
  ShowingsID int NOT NULL,
  ReservationDate DATETIME NOT NULL DEFAULT NOW(),
  PaymentStatus VARCHAR(4),
  FOREIGN KEY (UserID) REFERENCES User(UserID) ON DELETE CASCADE,
  FOREIGN KEY (ShowingsID) REFERENCES Showings(ShowingsID) ON DELETE CASCADE
) ENGINE=InnoDB;


-- seat reservation
CREATE TABLE SeatReservation (
  SeatReservationID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ReservationID INT NOT NULL,
  ShowingsID INT NOT NULL,
  SeatID INT NOT NULL,
  FOREIGN KEY (ReservationID) REFERENCES Reservation(ReservationID) ON DELETE CASCADE,
  FOREIGN KEY (ShowingsID) REFERENCES Showings(ShowingsID) ON DELETE CASCADE,
  FOREIGN KEY (SeatID) REFERENCES Seat(SeatID) ON DELETE CASCADE
) ENGINE=InnoDB;


-- payment
CREATE TABLE Payment (
  PaymentID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ReservationID INT NOT NULL,
  PaymentType VARCHAR(100) NOT NULL,
  PaymentDate DATETIME NOT NULL DEFAULT NOW(),
  Amount DECIMAL(8, 2) NOT NULL,
  FOREIGN KEY (ReservationID) REFERENCES Reservation(ReservationID) ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE BankAccount
(
  AccountID INT NOT NULL PRIMARY KEY,
  Description VARCHAR(200),
  Balance DECIMAL(8,2) -- 999999.99 to -999999.99 
);


-- views
-- daily showings view
CREATE VIEW DailyShowingsView AS
SELECT 
  m.MovieID, 
  m.`Name`, 
  m.MovieImg,
  s.ShowingTime,
  ShowingDate
FROM Movie m
INNER JOIN Showings s ON m.MovieID = s.MovieID
WHERE s.ShowingDate = CURDATE()
GROUP BY s.ShowingTime, m.`Name`;


-- user + address view
CREATE VIEW UserProfileView AS
SELECT U.UserID, U.Username, U.FirstName, U.LastName, U.Email, U.PhoneNumber, A.StreetName, A.StreetNumber, A.Country, A.PostalCode, P.City
FROM User U 
LEFT JOIN Address A ON U.AddressID = A.AddressID
LEFT JOIN PostalCode P ON A.PostalCode = P.PostalCode;


-- company + address view
CREATE VIEW CompanyAddressView AS
SELECT C.NameOfCompany, A.StreetName, A.StreetNumber, A.Country, A.PostalCode, P.City 
FROM CompanyInformation C 
LEFT JOIN Address A ON C.AddressID = A.AddressID
LEFT JOIN PostalCode P ON A.PostalCode = P.PostalCode;


-- user reservation 
CREATE VIEW UserReservationView AS
SELECT R.UserID, U.FirstName, U.LastName, R.ReservationID, S.ShowingDate, S.ShowingTime, M.Name as MovieName, P.PaymentType, P.Amount, P.PaymentDate
FROM Reservation R
LEFT JOIN Showings S ON R.ShowingsID = S.ShowingsID
LEFT JOIN Movie M ON S.MovieID = M.MovieID
LEFT JOIN Payment P ON R.ReservationID = P.ReservationID
LEFT JOIN User U ON R.UserID = U.UserID;


-- movie genre view
CREATE VIEW MovieGenreView AS
SELECT M.MovieID, M.`Name`, GROUP_CONCAT(DISTINCT G.GenreName ORDER BY G.GenreName) AS Genres
FROM Movie M
LEFT JOIN MovieGenre MG ON M.MovieID = MG.MovieID
LEFT JOIN Genre G ON MG.GenreID = G.GenreID


-- triggers
-- update bankaccount balance after payment
DELIMITER //

CREATE TRIGGER AfterPaymentInsert 
AFTER INSERT ON Payment
FOR EACH ROW
BEGIN
  UPDATE BankAccount
  SET Balance = Balance + NEW.Amount
  WHERE AccountID = 1; 
END //

DELIMITER ;


-- update bankaccount balance after delete booking
DELIMITER //

CREATE TRIGGER AfterCancelDelete
AFTER DELETE ON Reservation
FOR EACH ROW
BEGIN
    -- declare amount variable
    DECLARE amount DECIMAL(8, 2);

    -- get amount from payment where reservationid matches old reservationid
    SELECT Amount
    INTO amount
    FROM Payment
    WHERE ReservationID = OLD.ReservationID;

    -- check if amount is NULL
    IF amount IS NOT NULL THEN
        -- minus the amount from the bankaccount balance
        UPDATE BankAccount
        SET Balance = Balance - amount
        WHERE AccountID = 1;
    END IF;
END //

DELIMITER ;


-- static data to insert

-- postal code
insert into PostalCode (PostalCode, City) values ('6800', 'Varde');

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


-- screen format
insert into ScreenFormat (ScreenFormatID, ScreenFormat) values (NULL, '2D');
insert into ScreenFormat (ScreenFormatID, ScreenFormat) values (NULL, '3D');
insert into ScreenFormat (ScreenFormatID, ScreenFormat) values (NULL, '4D');


-- bank account
INSERT INTO BankAccount (AccountID, Description, Balance) VALUES (1, 'Money balance', 0.00);

-- admin
INSERT INTO User (UserID, Username, Pass, FirstName, LastName, Email, PhoneNumber, AddressID, Role) VALUES (NULL, 'admin', '$2y$10$w5.j3nGeOiUAHLDdHJM.2eTAV.whkaCZSAibhHABRO8IGMf6pQVUa', 'Lærke', 'Nielsen', 'laerke@laerkenicole.dk', '12345678', NULL, 'Admin');