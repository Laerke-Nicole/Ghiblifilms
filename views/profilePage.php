<?php require_once ("includes/dbcon.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php confirm_logged_in(); ?>

<?php
// connect to db
$dbCon = dbCon($user, $pass);

// get user view
$queryUserProfileView = $dbCon->prepare("SELECT * 
                                            FROM UserProfileView");
$queryUserProfileView->execute();
$getUserProfileView = $queryUserProfileView->fetchAll();
?>


<div class="row ten-percent">
    <h2>Your information</h2>
    <br>
    <table class="highlight">
        <thead>
        <tr class="secondary-color">
            <th>FirstName</th>
            <th>LastName</th>
            <th>Email</th>
            <th>PhoneNumber</th>
            <th>StreetName</th>
            <th>StreetNumber</th>
            <th>Country</th>
            <th>PostalCode</th>
            <th>City</th>
        </tr>
        </thead>

        <tbody class="secondary-color">
        <?php
        foreach ($getUserProfileView as $userProfile) {
            echo "<tr>";
                echo "<td>". $userProfile['FirstName']."</td>";
                echo "<td>". $userProfile['LastName']."</td>";
                echo "<td>". $userProfile['Email']."</td>";
                echo "<td>". $userProfile['PhoneNumber']."</td>";
                echo "<td>". $userProfile['StreetName']."</td>";
                echo "<td>". $userProfile['StreetNumber']."</td>";
                echo "<td>". $userProfile['Country']."</td>";
                echo "<td>". $userProfile['PostalCode']."</td>";
                echo "<td>". $userProfile['City']."</td>";
                echo "<td>";

                echo "</td>";
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
            <th>NumberOfSeatsBooked</th>
            <th>MovieID</th>
            <th>SeatID</th>
            <th>AuditoriumID</th>
        </tr>
        </thead>

        <tbody class="secondary-color">
        <?php
        foreach ($getUserProfileView as $userProfile) {
            echo "<tr>";
                // echo "<td>". $userProfile['FirstName']."</td>";
                // echo "<td>". $userProfile['LastName']."</td>";
                // echo "<td>". $userProfile['Email']."</td>";
                // echo "<td>". $userProfile['PhoneNumber']."</td>";
                // echo "<td>". $userProfile['StreetName']."</td>";
                // echo "<td>". $userProfile['StreetNumber']."</td>";
                echo "<td>";

                echo "</td>";
            echo "</tr>";

        }
        ?>
        </tbody>
    </table>
</div>