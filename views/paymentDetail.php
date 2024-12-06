<?php
require_once("includes/dbcon.php");
require_once("includes/functions.php");
require_once("includes/session.php");
confirm_logged_in();

// check if the user is logged in
if (isset($_SESSION['UserID'])) {
    // get the logged in users id
    $userID = $_SESSION['UserID'];
} else {
    $userID = null;
}

// Retrieve session data
$showingsID = $_SESSION['ShowingsID'] ?? null;
$selectedSeatIDs = $_SESSION['SelectedSeats'] ?? [];
if (!$showingsID || empty($selectedSeatIDs)) {
    die("No reservation details found.");
}

// get showings info
$queryShowingsInfo = $dbCon->prepare("
    SELECT s.ShowingDate, s.ShowingTime, m.Name AS MovieName
    FROM Showings s
    JOIN Movie m ON s.MovieID = m.MovieID
    WHERE s.ShowingsID = :showingsID
");
$queryShowingsInfo->bindParam(':showingsID', $showingsID);
$queryShowingsInfo->execute();
$getShowingsInfo = $queryShowingsInfo->fetch();

// get user info
$queryUserInfo = $dbCon->prepare("SELECT FirstName, LastName, Email, PhoneNumber FROM User WHERE UserID = :userID");
$queryUserInfo->bindParam(':userID', $userID);
$queryUserInfo->execute();
$getUserInfo = $queryUserInfo->fetch();


// Fetch seat numbers based on seat IDs
$seatPlaceholders = implode(", ", array_fill(0, count($selectedSeatIDs), "?"));
$querySeats = $dbCon->prepare("
    SELECT SeatNumber 
    FROM Seat 
    WHERE SeatID IN ($seatPlaceholders)
");
$querySeats->execute($selectedSeatIDs);
$seatNumbers = array_column($querySeats->fetchAll(), 'SeatNumber');

// Calculate the total price
$pricePerSeat = 12;
$totalPrice = count($selectedSeatIDs) * $pricePerSeat;

// display the payment page with form
include ("modules/payment/paymentContent.php");
?>