<?php
echo '<section>';
    echo '<div class="ten-percent pb-24">';
               
        echo '<h5>Opening hours:</h5>';
        foreach ($getOpeningHour as $openingHour) {
            echo '<div>';
                echo '<p class="text-sm">' . htmlspecialchars(trim($openingHour['Day'])) . '</p>';
                echo '<p class="pb-4 text-sm">' . htmlspecialchars(trim($openingHour['Time'])) . '</p>';
            echo '</div>';
        }
        
    echo '</div>';
echo '</section>';