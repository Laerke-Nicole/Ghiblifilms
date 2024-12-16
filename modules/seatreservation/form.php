<?php
// require_once("includes/dbcon.php");
require_once(__DIR__ . "/../../includes/dbcon.php");
require_once(__DIR__ . "/../../includes/functions.php");
require_once(__DIR__ . "/../../includes/session.php");
confirm_logged_in();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Seats'])) {
    $selectedSeats = $_POST['Seats'];
    $showingsID = $_SESSION['ShowingsID'];

    if (!is_array($selectedSeats) || count($selectedSeats) > 5) {
        die("<p'>You can select up to 5 seats.</p>"
        . "<a href='index.php?page=seatreservationdetail&ShowingsID=$showingsID'><button>Go back</button></a>");
    }

    // Store selected seats in session
    $_SESSION['SelectedSeats'] = $selectedSeats;

    // Redirect to the payment page
    header("Location: /index.php?page=paymentdetail");
    exit;
}
?>