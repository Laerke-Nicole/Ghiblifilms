<head>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/library.css">
</head>

<?php
require_once("includes/dbcon.php"); 

if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
    $movieID = $_GET['ID'];

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("SELECT * FROM Movie WHERE MovieID = :movieID");
    $query->bindParam(':movieID', $movieID);
    $query->execute();
    $movieItem = $query->fetch();


    // if statement to show details on movie
    if ($movieItem) {
        // display the details of the movie
        // movie overall info 
        echo '<section>';
            echo '<div class="half">';
                // img of movie 
                echo '<div class="h-full-vh">';
                    echo '<img src="upload/' . htmlspecialchars(trim($movieItem['MovieImg'])) . '" alt="Image of movie" class="h-full-vh pl-12">';
                echo '</div>';
        
                // info 
                echo '<div class="pt-20 pr-4 w-half">';
                    // title and description 
                    echo '<div class="pb-12">';
                        echo '<h1 class="pb-4">' . htmlspecialchars(trim($movieItem['Name'])) . '</h1>';
                        echo '<p class="pb-8">' . htmlspecialchars(trim($movieItem['Description'])) . '</p>';
                        echo '<a href="#showings"><button class="btn">See times</button></a>';
                    echo '</div>';
                   
                    // key info 
                    echo '<div class="flex flex-col gap-6">';
                        // duration
                        echo '<div>';
                            echo '<h4 class="text-sm">Duration</h4>';
                            echo '<p>' . htmlspecialchars(trim($movieItem['Duration'])) . '</p>';
                        echo '</div>';
        
                        // release date 
                        echo '<div>';
                            echo '<h4 class="text-sm">Release year</h4>';
                            echo '<p>' . htmlspecialchars(trim($movieItem['ReleaseYear'])) . '</p>';
                        echo '</div>';
        
                        // genre 
                        echo '<div>';
                            echo '<h4 class="text-sm">Genre</h4>';
                            $genreQuery = $dbCon->prepare("SELECT GenreName 
                                                            FROM Genre 
                                                            INNER JOIN MovieGenre 
                                                            ON Genre.GenreID = MovieGenre.GenreID 
                                                            WHERE MovieGenre.MovieID = ?
                                                            ");

                            $genreQuery->execute([$movieItem['MovieID']]);
                            $genres = $genreQuery->fetchAll(PDO::FETCH_COLUMN);
                            echo "<p>" . implode(", ", ($genres)) . "</p>";
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</section>';
        
        // cast
        echo '<section class="pt-24 pb-24">';
            // voice actors 
            echo '<div class="half ten-percent pb-24">';
                echo '<div class="flex">';
                    echo '<h3>VOICE ACTORS</h3>';
                echo '</div>';
                    // inner join to get the first and last name of the voice actor
                    $voiceActorQuery = $dbCon->prepare("SELECT FirstName, LastName
                                                    FROM VoiceActor 
                                                    INNER JOIN MovieVoiceActor 
                                                    ON VoiceActor.VoiceActorID = MovieVoiceActor.VoiceActorID 
                                                    WHERE MovieVoiceActor.MovieID = ?
                                                    ORDER BY FirstName");

                    $voiceActorQuery->execute([$movieItem['MovieID']]);
                    $voiceActor = $voiceActorQuery->fetchAll(PDO::FETCH_ASSOC);
        
                    echo '<div class="flex flex-col w-half">';
                        // loop with voice actors
                        foreach ($voiceActor as $voiceActor) {
                            echo '<p class="primary-font secondary-color text-lg">' . htmlspecialchars(trim($voiceActor['FirstName'])) . ' ' . htmlspecialchars(trim($voiceActor['LastName'])) . '</p>';
                        }
                    echo '</div>'; 
            echo '</div>';
        
        
            // production team 
            echo '<div class="flex justify-between ten-percent pb-12">';
                echo '<div class="flex">';
                    echo '<h3>PRODUCTION TEAM</h3>';
                echo '</div>';
                
            // list of production team 
            echo '<div>';
                echo '<div class="flex flex-col w-full">'; 

                // inner join to get the role in production
                $productionQuery = $dbCon->prepare("
                    SELECT RoleInProduction.RoleInProductionID, RoleInProduction.NameOfRole, Production.FirstName, Production.LastName
                    FROM Production
                    INNER JOIN MovieProduction ON Production.ProductionID = MovieProduction.ProductionID
                    INNER JOIN RoleInProduction ON Production.RoleInProductionID = RoleInProduction.RoleInProductionID
                    WHERE MovieProduction.MovieID = ?
                    ORDER BY RoleInProduction.RoleInProductionID");

                $productionQuery->execute([$movieItem['MovieID']]);
                $production = $productionQuery->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($production as $prod) {
                    echo '<div class="flex items-center justify-between gap-6 pb-2">'; 
                        // role
                        echo '<div class="flex-shrink-0 w-33 text-right">';
                            echo '<p class="primary-font secondary-color text-lg">' . htmlspecialchars(trim($prod['NameOfRole'])) . '</p>';
                        echo '</div>';
                        
                        // first and last name
                        echo '<div class="flex-1">';
                            echo '<p class="secondary-color text-lg">' . htmlspecialchars(trim($prod['FirstName'])) . ' ' . htmlspecialchars(trim($prod['LastName'])) . '</p>';
                        echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            echo '</div>';

        echo '</section>';


        
        // display showings
        echo '<div class="flex gap-8 p-4 pb-16 ten-percent" id="showings">';
            // left side with address
            echo '<div class="w-33">';
                echo '<h3>CHOOSE WHEN YOU WOULD LIKE TO WATCH THE MOVIE</h3>';
            echo '</div>';

            // right side with showings
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
            

            // book slots
            echo '<div class="flex flex-col gap-8 w-66">';
                foreach ($getShowings as $showings) {
                    echo '<a href="index.php?page=seatreservationdetail&ShowingsID=' . htmlspecialchars(trim($showings['ShowingsID'])) . '" class="time s-bg p-6 w-full">';
                        echo '<h4 class="primary-color"><strong>' . htmlspecialchars(trim($showings['ShowingDate'])) . ' ' . 'at' . ' ' . htmlspecialchars(trim($showings['ShowingTime'])) . '</strong></h4>';
                        echo '<p class="primary-color">' . htmlspecialchars(trim($showings['AuditoriumNumber'])) . '</p>';
                        echo '<p class="primary-color">' . htmlspecialchars(trim($showings['ScreenFormat'])) . '</p>';
                    echo '</a>';
                }
            echo '</div>';
        echo '</div>';   


    } else {
        echo '<p>Movie item not found.</p>';
    }
}
?>