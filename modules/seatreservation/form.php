<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Seats'])) {
    $selectedSeats = $_POST['Seats'];
    $showingsID = $_SESSION['ShowingsID'];

    if (!is_array($selectedSeats) || count($selectedSeats) > 5) {
        die("<p style='color: red;'>You can select up to 5 seats.</p>"
        . "<a href='index.php?page=seatreservationdetail&ShowingsID=$showingsID'>Go back</a>");
    }

    // Store selected seats in session
    $_SESSION['SelectedSeats'] = $selectedSeats;

    // Redirect to the payment page
    header("Location: index.php?page=paymentdetail");
    exit;
}
?>