<?php
// Connect to db
$dbCon = dbCon($user, $pass);

// get user reservations
$queryUserReservations = $dbCon->prepare("SELECT * FROM UserReservationView ORDER BY UserID");
$queryUserReservations->execute();
$getUserReservations = $queryUserReservations->fetchAll();
?>

<!-- Opening Hours -->
<div class="container">
    <h2>All Reservations sorted by user ID</h2>
    
    <?php
    if (!$getUserReservations) {
        echo "There are no bookings";
    } else {
        echo '<table class="highlight">';
        echo '<thead>';
            echo '<tr class="secondary-color">';
                echo '<th>Users name</th>';
                echo '<th>Movie</th>';
                echo '<th>Date</th>';
                echo '<th>Time</th>';
                echo '<th>Total</th>';
                echo '<th>Payment date</th>';
                echo '<th>Payment type</th>';
            echo '</tr>';
        echo '</thead>';
        echo '<tbody class="secondary-color">';

        foreach ($getUserReservations as $reservation) {
            echo "<tr>";
                echo "<td>" . htmlspecialchars(trim($reservation['FirstName'])) . " " . htmlspecialchars(trim($reservation['LastName'])) . "</td>";
                echo "<td>" . htmlspecialchars(trim($reservation['MovieName'])) . "</td>";
                echo "<td>" . htmlspecialchars(trim($reservation['ShowingDate'])) . "</td>";
                echo "<td>" . htmlspecialchars(trim($reservation['ShowingTime'])) . "</td>";
                echo "<td>" . htmlspecialchars(trim($reservation['Amount'])) . "</td>";
                echo "<td>" . htmlspecialchars(trim($reservation['PaymentDate'])) . "</td>";
                echo "<td>" . htmlspecialchars(trim($reservation['PaymentType'])) . "</td>";
            echo "</tr>";
        }

        echo '</tbody>';
        echo '</table>';
    }
    ?>
</div>