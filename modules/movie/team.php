<?php
// cast
echo '<section class="pt-24 pb-24">';
    // voice actors 
    echo '<div class="half ten-percent pb-24">';
        echo '<div class="flex">';
            echo '<h3>VOICE ACTORS</h3>';
        echo '</div>';
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