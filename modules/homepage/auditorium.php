<?php 
echo '<section>';
    // display info 
    echo '<div class="ten-percent pb-24">';
           
        echo '<h5>All our venues:</h5>';
        echo '<div>';
            foreach ($getAuditorium as $auditorium) {
                echo '<p>'. htmlspecialchars(trim($auditorium['AuditoriumNumber'])) . '</p>';
            }
        echo '</div>';

    echo '</div>';
echo '</section>';