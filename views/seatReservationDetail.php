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

// get ShowingsID from URL
$showingsID = $_GET['ShowingsID']; 
// store ShowingsID in session
$_SESSION['ShowingsID'] = $showingsID;

// if showingsID is empty
if (!$showingsID) {
    die("No reservation details found.");
}

include ("controllers/seatReservationController.php");

// display reserved seats
$reservedSeatList = implode(", ", array_column($reservedSeats, 'SeatNumber'));

// display the available seats, the seat options, and image of seats
include ("modules/seatreservation/seatReservationContent.php");