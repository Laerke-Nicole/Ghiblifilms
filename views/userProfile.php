<?php require_once ("includes/dbcon.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php confirm_logged_in(); ?>

<?php
// userID in URL
if (!isset($_GET['UserID'])) {
    die("UserID not specified.");
}

$userID = $_GET['UserID']; 


?>

<?php
// connect to db
$dbCon = dbCon($user, $pass);

// get user view
$queryUserProfileView = $dbCon->prepare("SELECT * FROM UserProfileView WHERE UserID = :userID");
$queryUserProfileView->bindParam(':userID', $userID);
$queryUserProfileView->execute();
$getUserProfileView = $queryUserProfileView->fetchAll();


// get user reservations
$queryUserReservations = $dbCon->prepare("SELECT * FROM Reservation WHERE UserID = :userID");
$queryUserReservations->bindParam(':userID', $userID);
$queryUserReservations->execute();
$getUserReservations = $queryUserReservations->fetchAll();
?>


<div class="row ten-percent">
    <h2>Your information</h2>
    <br>
    <table class="highlight">
        <thead>
        <tr class="secondary-color">
            <th>Username</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Email</th>
            <th>PhoneNumber</th>
            <th>StreetName</th>
            <th>StreetNumber</th>
            <th>Country</th>
            <th>PostalCode</th>
            <th>City</th>

            <th>Edit</th>
        </tr>
        </thead>

        <tbody class="secondary-color">
        <?php
        if ($userProfile = $getUserProfileView[0]) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars(trim($userProfile['Username'])) . "</td>";
            echo "<td>" . htmlspecialchars(trim($userProfile['FirstName'])) . "</td>";
            echo "<td>" . htmlspecialchars(trim($userProfile['LastName'])) . "</td>";
            echo "<td>" . htmlspecialchars(trim($userProfile['Email'])) . "</td>";
            echo "<td>" . htmlspecialchars(trim($userProfile['PhoneNumber'])) . "</td>";
            echo "<td>" . htmlspecialchars(trim($userProfile['StreetName'])) . "</td>";
            echo "<td>" . htmlspecialchars(trim($userProfile['StreetNumber'])) . "</td>";
            echo "<td>" . htmlspecialchars(trim($userProfile['Country'])) . "</td>";
            echo "<td>" . htmlspecialchars(trim($userProfile['PostalCode'])) . "</td>";
            echo "<td>" . htmlspecialchars(trim($userProfile['City'])) . "</td>";
            echo "<td>";

            echo "</td>";
            echo '<td><a href="index.php?page=edituserprofile&ID='.$userProfile['UserID'].'" class="btn">Edit</a></td>';
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<br>
<br>
<br>
<br>


<!-- work on display the users bookings -->
<div class="row ten-percent">
    <h2>Your bookings</h2>
    <br>
    <table class="highlight">
        <thead>
        <tr class="secondary-color">
            <th>Date</th>
            <th>Time</th>
            <th>MovieID</th>
        </tr>
        </thead>

        <tbody class="secondary-color">
        <?php
        foreach ($getUserReservations as $reservation) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars(trim($reservation['Date'])) . "</td>";
            echo "<td>" . htmlspecialchars(trim($reservation['Time'])) . "</td>";
            echo "<td>" . htmlspecialchars(trim($reservation['MovieID'])) . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>