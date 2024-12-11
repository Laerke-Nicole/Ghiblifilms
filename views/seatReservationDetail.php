<?php
require_once("includes/dbcon.php");
require_once("includes/functions.php");
require_once("includes/session.php"); 
require_once ("includes/csrfProtection.php");
confirm_logged_in();

// ShowingsID in URL
if (!isset($_GET['ShowingsID'])) {
    die("ShowingsID not specified.");
}

$showingsID = $_GET['ShowingsID']; 
$_SESSION['ShowingsID'] = $showingsID; // Save ShowingsID in session
if (!$showingsID) {
    die("No reservation details found.");
}

// Fetch already reserved seats for the showing
$queryReservedSeats = $dbCon->prepare("
    SELECT s.SeatNumber
    FROM Seat s
    JOIN SeatReservation sr ON s.SeatID = sr.SeatID
    WHERE sr.ShowingsID = :showingsID
");
$queryReservedSeats->bindParam(':showingsID', $showingsID);
$queryReservedSeats->execute();
$reservedSeats = $queryReservedSeats->fetchAll();

// Display reserved seats
$reservedSeatList = implode(", ", array_column($reservedSeats, 'SeatNumber'));

// Fetch available seats for the showing
$querySeats = $dbCon->prepare("
    SELECT s.SeatID, s.SeatNumber
    FROM Seat s
    LEFT JOIN SeatReservation sr ON s.SeatID = sr.SeatID AND sr.ShowingsID = :showingsID
    WHERE sr.SeatID IS NULL
    ORDER BY s.SeatNumber
");
$querySeats->bindParam(':showingsID', $showingsID);
$querySeats->execute();
$availableSeats = $querySeats->fetchAll();

// display the available seats, the seat options, and image of seats
include ("modules/seatreservation/seatReservationContent.php");