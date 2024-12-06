<?php
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
                    
                    // display genres in an array with , between each name
                    $genreNames = array_column($genres, 'GenreName');
                    echo "<p>" . htmlspecialchars(implode(", ", $genreNames)) . "</p>";
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</section>';