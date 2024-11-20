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
                    echo '<img src="upload/' . $movieItem['MovieImg'] . '" alt="Image of movie" class="h-full-vh pl-12">';
                echo '</div>';
        
                // info 
                echo '<div class="pt-20 pr-4 w-half">';
                    // title and description 
                    echo '<div class="pb-12">';
                        echo '<h1 class="pb-4">Ponyo</h1>';
                        echo '<p class="pb-8">' . $movieItem['Description'] . '</p>';
                        echo '<a href="#showings"><button class="btn">See times</button></a>';
                    echo '</div>';
                   
                    // key info 
                    echo '<div class="flex flex-col gap-6">';
                        // duration
                        echo '<div>';
                            echo '<h4 class="text-sm">Duration</h4>';
                            echo '<p>' . $movieItem['Duration'] . '</p>';
                        echo '</div>';
        
                        // release date 
                        echo '<div>';
                            echo '<h4 class="text-sm">Release year</h4>';
                            echo '<p>' . $movieItem['ReleaseYear'] . '</p>';
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
                            echo "<p>" . implode(", ", $genres) . "</p>";
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
                                                    ");

                    $voiceActorQuery->execute([$movieItem['MovieID']]);
                    $voiceActor = $voiceActorQuery->fetchAll(PDO::FETCH_ASSOC);
        
                    echo '<div class="flex flex-col w-half">';
                        // loop with voice actors
                        foreach ($voiceActor as $voiceActor) {
                            echo '<p class="primary-font secondary-color text-lg">' . $voiceActor['FirstName'] . ' ' . $voiceActor['LastName'] . '</p>';
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
                    SELECT RoleInProduction.NameOfRole, Production.FirstName, Production.LastName
                    FROM Production
                    INNER JOIN MovieProduction ON Production.ProductionID = MovieProduction.ProductionID
                    INNER JOIN RoleInProduction ON Production.RoleInProductionID = RoleInProduction.RoleInProductionID
                    WHERE MovieProduction.MovieID = ?
                ");

                $productionQuery->execute([$movieItem['MovieID']]);
                $production = $productionQuery->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($production as $prod) {
                    echo '<div class="flex items-center justify-between gap-6 pb-2">'; 
                        // role
                        echo '<div class="flex-shrink-0 w-33 text-right">';
                            echo '<p class="primary-font secondary-color text-lg">' . $prod['NameOfRole'] . '</p>';
                        echo '</div>';
                        
                        // first and last name
                        echo '<div class="flex-1">';
                            echo '<p class="secondary-color text-lg">' . $prod['FirstName'] . ' ' . $prod['LastName'] . '</p>';
                        echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            echo '</div>';

        echo '</section>';

        
        // display showings
        if ($showingsItem) { 
            echo '<div class="flex gap-8 p-4 pb-16">';
                // left side with address
                echo '<div class="w-33">';
                    echo '<h3>CHOOSE WHEN YOU WOULD LIKE TO WATCH THE MOVIE</h3>';
                    echo '<div>';
                        echo '<p>' . $companyAddress['StreetName']. '</p>';
                        echo '<p>' . $companyAddress['StreetNumber']. '</p>';
                    echo '</div>';
                    echo '<div>';
                        echo '<p>' . $companyAddress['Country']. '</p>';
                        echo '<p>' . $companyAddress['PostalCode']. '</p>';
                        echo '<p>' . $companyAddress['City']. '</p>';
                    echo '</div>';
                echo '</div>';

                // right side with showings
                // book slots
                echo '<div class="flex gap-8 w-66">';
                    echo '<div>';
                        echo '<h3>Ons, 20/11</h3>';

                        echo '<div class="time s-bg p-4">';
                            echo '<p class="primary-color"><strong>Bio 2</strong></p>';
                            echo '<p class="primary-color">18.00</p>';
                            echo '<p class="primary-color">2D, Engelsk tale, Forpremiere</p>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
        

    } else {
        echo '<p>Movie item not found.</p>';
    }
}
?>