<?php 
require_once ("includes/dbcon.php"); 
require_once("includes/functions.php"); 
require_once("includes/session.php"); 
require_once("includes/connection.php"); 
require_once("controllers/userController.php"); 
confirm_logged_in(); 


// UserID from session
$userID = $_SESSION['UserID']; 

include ("controllers/userController.php");

// if the userprofileview is empty 
if (!$getUserProfileView) {
    die("No profile found.");
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