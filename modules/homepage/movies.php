<?php
echo '<section class="pb-24 ten-percent" id="movies">';
    echo '<div>';
        echo '<h2 class="text-center pb-4">All of our movies</h2>';
    echo '</div>';
    
    // loop with movies
    echo '<div class="items">';
        
        foreach ($getMovies as $getMovie) { 
            echo '<div>';
            echo "<img src='upload/" . htmlspecialchars(trim($getMovie['MovieImg'])) . "' alt='Image of movie'>";
            echo '<h5 class="weight-400 pb-2">' . htmlspecialchars(trim($getMovie['Name'])) . '</h5>';
            echo '<button class="btn" onclick="window.location.href=\'index.php?page=moviedetail&ID=' . htmlspecialchars(trim($getMovie['MovieID'])) . '\'">Get tickets</button>';
            echo '</div>';
        }
    echo '</div>';

echo '</section>';