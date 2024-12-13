<?php
// company info
$query = $dbCon->prepare("SELECT C.*, A.StreetName, A.StreetNumber, A.PostalCode, A.Country 
                           FROM CompanyInformation C 
                           LEFT JOIN Address A ON C.AddressID = A.AddressID 
                           WHERE C.CompanyInformationID = :CompanyInformationID");
$query->bindParam(':CompanyInformationID', $companyInformationID);
$query->execute();
$getCompanyInformation = $query->fetchAll();


// genre
$query = $dbCon->prepare("SELECT * FROM Genre WHERE GenreID = :genreID");
$query->bindParam(':genreID', $genreID);
$query->execute();
$getGenre = $query->fetchAll();


// movie
$query = $dbCon->prepare("SELECT * FROM Movie WHERE MovieID = :movieID");
$query->bindParam(':movieID', $movieID);
$query->execute();
$getMovie = $query->fetchAll();

// movie genre
$query = $dbCon->prepare("SELECT * FROM MovieGenre WHERE MovieID = :movieID AND GenreID = :genreID");
$query->bindParam(':movieID', $movieID);
$query->bindParam(':genreID', $genreID);
$query->execute();
$getMovieGenre = $query->fetchAll();

// movie production
$query = $dbCon->prepare("SELECT * FROM MovieProduction WHERE MovieID = :movieID AND ProductionID = :productionID");
$query->bindParam(':movieID', $movieID);
$query->bindParam(':productionID', $productionID);
$query->execute();
$getMovieProduction = $query->fetchAll();

// movie voice actor
$query = $dbCon->prepare("SELECT * FROM MovieVoiceActor WHERE MovieID = :movieID AND VoiceActorID = :voiceActorID");
$query->bindParam(':movieID', $movieID);
$query->bindParam(':voiceActorID', $voiceActorID);
$query->execute();
$getMovieVoiceActor = $query->fetchAll();

// news
$query = $dbCon->prepare("SELECT * FROM News WHERE NewsID = :newsID");
$query->bindParam(':newsID', $newsID);
$query->execute();
$getNews = $query->fetchAll();

// opening hour
$query = $dbCon->prepare("SELECT * FROM OpeningHour WHERE OpeningHourID = :openingHourID");
$query->bindParam(':openingHourID', $openingHourID);
$query->execute();
$getOpeningHours = $query->fetchAll();


// postal code
$query = $dbCon->prepare("SELECT * FROM PostalCode WHERE PostalCode = :postalCode");
$query->bindParam(':postalCode', $postalCode);
$query->execute();
$getPostalCode = $query->fetchAll();


// production
$query = $dbCon->prepare("SELECT * FROM Production WHERE ProductionID = :productionID");
$query->bindParam(':productionID', $productionID);
$query->execute();
$getProduction = $query->fetchAll();


// role in production
$query = $dbCon->prepare("SELECT * FROM RoleInProduction WHERE RoleInProductionID = :roleInProductionID");
$query->bindParam(':roleInProductionID', $roleInProductionID);
$query->execute();
$getRoleInProduction = $query->fetchAll();


// showings
$query = $dbCon->prepare("SELECT * FROM Showings WHERE ShowingsID = :showingsID");
$query->bindParam(':showingsID', $showingsID);
$query->execute();
$getShowings = $query->fetchAll();


// user
$query = $dbCon->prepare("SELECT U.*, A.StreetName, A.StreetNumber, A.PostalCode, A.Country 
                           FROM User U 
                           LEFT JOIN Address A ON U.AddressID = A.AddressID 
                           WHERE U.UserID = :userID");
$query->bindParam(':userID', $userID);
$query->execute();
$getUsers = $query->fetchAll(); 


// voice actor
$query = $dbCon->prepare("SELECT * FROM VoiceActor WHERE VoiceActorID = :voiceActorID");
$query->bindParam(':voiceActorID', $voiceActorID);
$query->execute();
$getVoiceActor = $query->fetchAll();