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

<?php include("modules/userprofile/userInfo.php") ?>

<br>
<br>
<br>
<br>

<?php include("modules/userprofile/userBookings.php") ?>