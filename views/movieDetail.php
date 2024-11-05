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
                    echo '<img src="upload/' . $movieItem['MovieImg'] . '" alt="Image of movie" class="h-90-vh">';
                echo '</div>';
        
                // info 
                echo '<div class="pt-20 pr-4 w-half">';
                    // title and description 
                    echo '<div class="pb-12">';
                        echo '<h1 class="pb-4">Ponyo</h1>';
                        echo '<p class="pb-8">' . $movieItem['MovieDescription'] . '</p>';
                        echo '<button class="btn">See times</button>';
                    echo '</div>';
                   
                    // key info 
                    echo '<div class="flex flex-col gap-6">';
                        // duration
                        echo '<div>';
                            echo '<h4 class="text-sm">' . $movieItem['Duration'] . '</h4>';
                            echo '<p>' . $movieItem['Duration'] . '</p>';
                        echo '</div>';
        
                        // release date 
                        echo '<div>';
                            echo '<h4 class="text-sm">Release year</h4>';
                            echo '<p>' . $movieItem['ReleaseYear'] . '</p>';
                        echo '</div>';
        
                        // genre 
                        echo '<div>';
                            echo '<p>' . $movieItem['GenreName'] . '</p>';
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
        
                if ($voiceActor) { 
                    echo '<div class="flex flex-col w-half">';
                    // loop
                    foreach ($voiceActor as $voiceActor) {
                        echo '<p class="primary-font secondary-color text-lg">' . $voiceActor['FirstName'] . $voiceActor['LastName'] . '</p>';
                    }
                    echo '</div>';
                }    
            echo '</div>';
        
        
            // production team 
            echo '<div class="flex justify-between ten-percent pb-12">';
                echo '<div class="flex">';
                    echo '<h3>PRODUCTION TEAM</h3>';
                echo '</div>';
        
                echo '<div class="flex flex-col w-half">';
                    if ($production) { 
                        echo '<div class="flex justify-between gap-6">';
                        // loop
                            foreach ($production as $production) {
                                // role
                                echo '<div class="flex-1 text-right">';
                                    echo '<p class="primary-font secondary-color text-lg">PLANNING AND SCRIPT</p>';
                                echo '</div>';
                
                                // name 
                                echo '<div class="flex-1">';
                                    echo '<p class="secondary-color text-lg">' . $production['FirstName'] . $production['LastName'] . '</p>';
                                echo '</div>';
                            } 
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';
        echo '</section>';


        // display showings
        if ($showingsItem) {
            // book slots
            echo '<section class="pb-24">';
                echo '<div class="half ten-percent pb-12">';
                    // adress 
                    echo '<div class="flex">';
                        echo '<h3>' . $Item['StreetName'] . $movieItem['StreetNumber']'</h3>';
                        echo '<h3>' . $movieItem['PostalCode'] . $movieItem['Country']'</h3>';
                    echo '</div>';
        
                    echo '<div class="flex flex-col gap-4">';
                        echo '<div class="box">';
                            echo '<h4>' . $movieItem['StreetName'] . '</h4>'; // change later
                            <p>BIO 1</p>
                            <p>2D</p>
                        </div>
        
                        <div class="box">
                            <h4>MON 17/9 AT 19.30</h4>
                            <p>BIO 1</p>
                            <p>2D</p>
                        </div>
        
                        <div class="box">
                            <h4>MON 17/9 AT 19.30</h4>
                            <p>BIO 1</p>
                            <p>2D</p>
                        </div>
                    </div>
                </div>
            </section>
        }

    }else {
        echo '<p>Movie item not found.</p>';
}



?>