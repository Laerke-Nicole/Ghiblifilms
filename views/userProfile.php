<?php 
require_once ("includes/dbcon.php"); 
require_once("includes/functions.php"); 
require_once("includes/session.php"); 
require_once("includes/connection.php"); 
confirm_logged_in(); 


// userID in URL
if (!isset($_GET['UserID'])) {
    die("UserID not specified.");
}

$userID = $_GET['UserID']; 


// get user view
$queryUserProfileView = $dbCon->prepare("SELECT * FROM UserProfileView WHERE UserID = :userID");
$queryUserProfileView->bindParam(':userID', $userID);
$queryUserProfileView->execute();
$getUserProfileView = $queryUserProfileView->fetchAll();


// get user reservations
$queryUserReservations = $dbCon->prepare("SELECT * FROM UserReservationView WHERE UserID = :userID");
$queryUserReservations->bindParam(':userID', $userID);
$queryUserReservations->execute();
$getUserReservations = $queryUserReservations->fetchAll();
?>


<div class="row ten-percent">
    <h2>Your information</h2>
    <br>
    <?php
    if ($userProfile = $getUserProfileView[0]) {
        echo "<div>";
            echo '<p><strong>Username: </strong>' . htmlspecialchars(trim($userProfile['Username'])) . '</p>';
            echo '<p><strong>Name: </strong>' . htmlspecialchars(trim($userProfile['FirstName'])) . " "  . htmlspecialchars(trim($userProfile['LastName'])) .  '</p>';
            echo '<p><strong>Email: </strong>' . htmlspecialchars(trim($userProfile['Email'])) . '</p>';
            echo '<p><strong>Phone number: </strong>' . htmlspecialchars(trim($userProfile['PhoneNumber'])) . '</p>';
            echo '<p><strong>Address: </strong>' . htmlspecialchars(trim($userProfile['StreetName'])) . " " . htmlspecialchars(trim($userProfile['StreetNumber'])) . '</p>';
            echo '<p><strong>Country: </strong>' . htmlspecialchars(trim($userProfile['Country'])) . '</p>';
            echo '<p><strong>Postal code: </strong>' . htmlspecialchars(trim($userProfile['PostalCode'])) . '</p>';
            echo '<p><strong>City: </strong>' . htmlspecialchars(trim($userProfile['City'])) . '</p>';
                
            echo "<br/>";
            echo '<a href="index.php?page=edituserprofile&ID='.$userProfile['UserID'].'" class="btn">Edit your info</a></div>';
        echo "</div>";
    }
    ?>
</div>

<br>
<br>
<br>
<br>


<!-- work on display the users bookings -->
<div class="row ten-percent">
    <h2>Your bookings</h2>
    <br>
    <?php
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
    ?>
</div>