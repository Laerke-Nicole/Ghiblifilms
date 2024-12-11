<?php 
require_once ("includes/dbcon.php"); 
require_once("includes/functions.php"); 
require_once("includes/session.php"); 
require_once("includes/connection.php"); 
confirm_logged_in(); 


// UserID from session
$userID = $_SESSION['UserID']; 


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

if (!$getUserProfileView) {
    die("Not found.");
}

// user info 
include("modules/userprofile/userInfo.php"); ?>

<br>
<br>
<br>
<br>

<?php
// list of bookings the user has made 
include("modules/userprofile/userBookings.php"); 