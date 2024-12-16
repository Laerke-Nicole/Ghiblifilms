<?php
require_once(__DIR__ . "/../../includes/dbcon.php");
require_once(__DIR__ . "/../../includes/functions.php");
require_once(__DIR__ . "/../../includes/session.php");
confirm_logged_in();

// if the seats were chosen in the form and seats are chosen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Seats'])) {
    // get the seats and showingsid
    $selectedSeats = $_POST['Seats'];
    $showingsID = $_SESSION['ShowingsID'];

    // check if the selected seats are an array and the user chose less than 5 seats
    if (!is_array($selectedSeats) || count($selectedSeats) > 5) {
        die("<p'>You can select up to 5 seats.</p>"
        . "<a href='index.php?page=seatreservationdetail&ShowingsID=$showingsID'><button>Go back</button></a>");
    }

    // store selected seats in session
    $_SESSION['SelectedSeats'] = $selectedSeats;

    // redirect to the payment page
    header("Location: /index.php?page=paymentdetail");
    exit;
}
?>