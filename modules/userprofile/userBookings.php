<?php
// work on display the users bookings 
echo '<div class="row ten-percent">';
    echo '<h2>Your bookings</h2>';
    echo '<br>';
    if (!$getUserReservations) {
        echo "You have no bookings.";
    } else {
        foreach ($getUserReservations as $reservation) {
            echo '<div>';
                echo '<p><strong">Movie:</strong> ' . htmlspecialchars($reservation['MovieName']) . '</p>';
                echo '<p><strong">Date:</strong> ' . htmlspecialchars($reservation['ShowingDate']) . '</p>';
                echo '<p><strong">Time:</strong> ' . htmlspecialchars($reservation['ShowingTime']) . '</p>';
                echo '<p><strong>Total:</strong> €' . number_format($reservation['Amount'] / 100, 2) . '</p>';
                echo '<p><strong">Payment Date:</strong> ' . htmlspecialchars($reservation['PaymentDate']) . '</p>';
                echo '<p><strong">Payment Type:</strong> ' . htmlspecialchars($reservation['PaymentType']) . '</p>';

                echo "<br/>";
                echo '<a href="index.php?page=deleteuserprofile&ReservationID=' . $reservation['ReservationID'] . '&UserID=' . $userID . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! Are you sure?\')">Cancel booking</a>';
                echo "<br/>";
                echo "<br/>";
                echo "<br/>";
            echo '</div>';
        }
    }
echo '</div>';