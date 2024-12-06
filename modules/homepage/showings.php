<?php
if ($dailyShowingsViews) {
    echo '<section class="pt-24 ten-percent" id="daily-showings">';
        echo '<h2 class="text-center pb-4">Daily Showings</h2>';
        echo '<div class="items">';
            foreach ($dailyShowingsViews as $showings) { 
                echo '<div>';
                    echo "<img src='upload/" . htmlspecialchars(trim($showings['MovieImg'])) . "' alt='Image of movie'>";
                    echo '<h5 class="weight-400 pb-2">' . htmlspecialchars(trim($showings['Name'])) . '</h5>';
                    echo '<button class="btn" onclick="window.location.href=\'index.php?page=moviedetail&ID=' . htmlspecialchars(trim($showings['MovieID'])) . '\'">Get tickets</button>';
                echo '</div>';
            }
        echo '</div>';
    echo '</section>';
}
?>  