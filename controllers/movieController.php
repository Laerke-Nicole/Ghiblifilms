<?php
// Get everything from movie table
$queryMovie = $dbCon->prepare("SELECT * 
                                FROM Movie");
$queryMovie->execute();
$getMovies = $queryMovie->fetchAll();


// get everything from the movie table
$query = $dbCon->prepare("SELECT * FROM Movie 
                            WHERE MovieID = :movieID");
$query->bindParam(':movieID', $movieID);
$query->execute();
$movieItem = $query->fetch();

if ($movieItem) {
// get genres for the movie table
$genreQuery = $dbCon->prepare("SELECT GenreName 
                                FROM Genre 
                                INNER JOIN MovieGenre 
                                ON Genre.GenreID = MovieGenre.GenreID 
                                WHERE MovieGenre.MovieID = ?
                                ");
$genreQuery->execute([$movieItem['MovieID']]);
$genres = $genreQuery->fetchAll();


// inner join to get the first and last name of the voice actor
$voiceActorQuery = $dbCon->prepare("SELECT FirstName, LastName
                                    FROM VoiceActor 
                                    INNER JOIN MovieVoiceActor 
                                    ON VoiceActor.VoiceActorID = MovieVoiceActor.VoiceActorID 
                                    WHERE MovieVoiceActor.MovieID = ?
                                    ORDER BY FirstName");
$voiceActorQuery->execute([$movieItem['MovieID']]);
$voiceActor = $voiceActorQuery->fetchAll();


// inner join to get the role in production
$productionQuery = $dbCon->prepare(" SELECT RoleInProduction.RoleInProductionID, RoleInProduction.NameOfRole, Production.FirstName, Production.LastName
                                    FROM Production
                                    INNER JOIN MovieProduction ON Production.ProductionID = MovieProduction.ProductionID
                                    INNER JOIN RoleInProduction ON Production.RoleInProductionID = RoleInProduction.RoleInProductionID
                                    WHERE MovieProduction.MovieID = ?
                                    ORDER BY RoleInProduction.RoleInProductionID");
$productionQuery->execute([$movieItem['MovieID']]);
$production = $productionQuery->fetchAll();


// get showings sorted by date and time on movie detail page
$queryShowings = $dbCon->prepare("SELECT s.*, a.AuditoriumNumber, sf.ScreenFormat
                                    FROM Showings s
                                    JOIN Auditorium a ON s.AuditoriumID = a.AuditoriumID
                                    JOIN ScreenFormat sf ON s.ScreenFormatID = sf.ScreenFormatID
                                    WHERE s.MovieID = :movieID
                                    ORDER BY s.ShowingDate, s.ShowingTime");
$queryShowings->bindParam(':movieID', $movieID);
$queryShowings->execute();
$getShowings = $queryShowings->fetchAll();

}


// Get everything from showings
$queryShowings = $dbCon->prepare("SELECT * FROM Showings");
$queryShowings->execute();
$showings = $queryShowings->fetchAll();


// get everything from daily showings
$queryShowings = $dbCon->prepare("SELECT * FROM DailyShowingsView");
$queryShowings->execute();
$dailyShowingsViews = $queryShowings->fetchAll();


// get auditorium/venues from db
$queryAuditorium = $dbCon->prepare("SELECT AuditoriumNumber
                                    FROM Auditorium");
$queryAuditorium->execute();
$getAuditorium = $queryAuditorium->fetchAll();


// Get everything from genres
$queryGenre = $dbCon->prepare("SELECT * FROM Genre");
$queryGenre->execute();
$getGenre = $queryGenre->fetchAll();

// Get everything from Movie Genre
$queryMovieGenre = $dbCon->prepare("SELECT * FROM MovieGenre");
$queryMovieGenre->execute();
$getMovieGenre = $queryMovieGenre->fetchAll();


// Get everything from Movie Production
$queryMovieProduction = $dbCon->prepare("SELECT * FROM MovieProduction");
$queryMovieProduction->execute();
$getMovieProduction = $queryMovieProduction->fetchAll();


// Get everything from movie voice actor
$queryMovieVoiceActor = $dbCon->prepare("SELECT * FROM MovieVoiceActor");
$queryMovieVoiceActor->execute();
$getMovieVoiceActor = $queryMovieVoiceActor->fetchAll();


// Get everything from production
$queryProduction = $dbCon->prepare("SELECT * FROM Production");
$queryProduction->execute();
$getProduction = $queryProduction->fetchAll();


// Get everything from role in production
$queryRoleInProduction = $dbCon->prepare("SELECT * FROM RoleInProduction");
$queryRoleInProduction->execute();
$getRoleInProduction = $queryRoleInProduction->fetchAll();


// Get everything from voice actor
$queryVoiceActor = $dbCon->prepare("SELECT * FROM VoiceActor");
$queryVoiceActor->execute();
$getVoiceActor = $queryVoiceActor->fetchAll();