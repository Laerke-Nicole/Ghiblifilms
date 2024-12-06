
<?php
require_once("includes/dbcon.php"); 

if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
    $movieID = $_GET['ID'];

    // get everything from the movie table
    $query = $dbCon->prepare("SELECT * FROM Movie WHERE MovieID = :movieID");
    $query->bindParam(':movieID', $movieID);
    $query->execute();
    $movieItem = $query->fetch();

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

    // get showings sorted by date and time
    $queryShowings = $dbCon->prepare("SELECT s.*, a.AuditoriumNumber, sf.ScreenFormat
                                        FROM Showings s
                                        JOIN Auditorium a ON s.AuditoriumID = a.AuditoriumID
                                        JOIN ScreenFormat sf ON s.ScreenFormatID = sf.ScreenFormatID
                                        WHERE s.MovieID = :movieID
                                        ORDER BY s.ShowingDate, s.ShowingTime");

    $queryShowings->bindParam(':movieID', $movieID);

    $queryShowings->execute();
    $getShowings = $queryShowings->fetchAll();

    
    // if statement to show details on movie
    if ($movieItem) {
        // display the details of the movie
        // movie overall info 
        echo include ("modules/movie/moviedetails.php");
        
        // display the team of the movie
        echo include ("modules/movie/team.php");

        // display showings
        echo include ("modules/movie/showings.php");


    } else {
        echo '<p>Movie item not found.</p>';
    }
}
?>