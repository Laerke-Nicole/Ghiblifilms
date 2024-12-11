<?php 
require_once ("includes/dbcon.php"); 
require_once("includes/functions.php"); 
require_once("includes/session.php"); 
require_once("includes/connection.php"); 
require_once("controllers/userController.php"); 
confirm_logged_in(); 


// UserID from session
$userID = $_SESSION['UserID']; 

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