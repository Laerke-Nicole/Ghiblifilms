<?php
require_once("includes/dbcon.php");
require_once("includes/functions.php");
require_once("includes/session.php");

confirm_logged_in();

// Retrieve session data
$showingsID = $_SESSION['ShowingsID'] ?? null;
$selectedSeatIDs = $_SESSION['SelectedSeats'] ?? [];
if (!$showingsID || empty($selectedSeatIDs)) {
    die("No reservation details found.");
}

// Connect to the database
$dbCon = dbCon($user, $pass);

// Fetch seat numbers based on seat IDs
$seatPlaceholders = implode(", ", array_fill(0, count($selectedSeatIDs), "?"));
$querySeats = $dbCon->prepare("
    SELECT SeatNumber 
    FROM Seat 
    WHERE SeatID IN ($seatPlaceholders)
");
$querySeats->execute($selectedSeatIDs);
$seatNumbers = $querySeats->fetchAll(PDO::FETCH_COLUMN);

// Calculate the total price
$pricePerSeat = 12;
$totalPrice = count($selectedSeatIDs) * $pricePerSeat;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="modules/payment/stripe.js" defer></script>
</head>
<body>
<div class="row ten-percent grid-cols-2">
    <div>
        <h2>Order Overview</h2>
        <p><strong>Selected Seats:</strong> <?php echo implode(", ", $seatNumbers); ?></p>
        <p><strong>Total Price:</strong> €<?php echo number_format($totalPrice, 2); ?></p>
        <img src="img/seats.png" alt="Seating chart" height="100">
    </div>

    <div>
        <h2>Payment</h2>
        <form id="payment-form">
            <div id="card-element">
                <!-- Stripe.js adds fields here -->
            </div>
            <button id="submit">Pay</button>
            <div id="error-message"></div> <!-- Error display -->
        </form>
    </div>
</div>
</body>
</html>