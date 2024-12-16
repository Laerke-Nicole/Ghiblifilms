<?php
require_once("includes/dbcon.php");
require_once("includes/functions.php");
require_once("includes/session.php");
require_once ("includes/csrfProtection.php");
confirm_logged_in();

// check if the user is logged in
if (isset($_SESSION['UserID'])) {
    // get the logged in users id
    $userID = $_SESSION['UserID'];
} else {
    $userID = null;
}

// get session data
$showingsID = $_SESSION['ShowingsID'] ?? null;

// get selected seats
$selectedSeatIDs = $_SESSION['SelectedSeats'] ?? [];

// if showingsID or selectedseatid is empty
if (!$showingsID || empty($selectedSeatIDs)) {
    die("No reservation details found.");
}

include ("controllers/paymentController.php");

// calculate the total price
$pricePerSeat = 12;
$totalPrice = count($selectedSeatIDs) * $pricePerSeat;

// display the payment page with form
include ("modules/payment/paymentContent.php");
?>