<?php
// display showings
echo '<div class="flex gap-8 p-4 pb-16 ten-percent" id="showings">';
    // left side with address
    echo '<div class="w-33">';
        echo '<h3>CHOOSE WHEN YOU WOULD LIKE TO WATCH THE MOVIE</h3>';
    echo '</div>';

    // right side with showings
    // book slots
    if (!$getShowings) {
        echo '<p>No showings right now.</p>';
    }

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