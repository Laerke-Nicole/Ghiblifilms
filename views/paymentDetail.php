<?php require_once("includes/dbcon.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php confirm_logged_in(); ?>

<?php
// Ensure user is logged in
if (!isset($_SESSION['UserID'])) {
    die("User not logged in.");
}

$userID = $_SESSION['UserID'];

// Connect to the database
$dbCon = dbCon($user, $pass);

// Fetch reservation details for the logged-in user
$queryReservationDetails = $dbCon->prepare("
    SELECT * FROM ReservationDetails WHERE UserID = :userID
");
$queryReservationDetails->bindParam(':userID', $userID);
$queryReservationDetails->execute();
$getReservationDetails = $queryReservationDetails->fetchAll(PDO::FETCH_ASSOC);

// Calculate the total price
$pricePerSeat = 12;
$totalPrice = 0;

if (!empty($getReservationDetails)) {
    $Reservation = $getReservationDetails[0];
    $totalPrice = $Reservation['TotalSeats'] * $pricePerSeat;
}
?>


<div class="row ten-percent grid-cols-2">
    <div>
        <h2>Order overview</h2>
        <?php if (!empty($Reservation)): ?>
            <p><strong>Your details:</strong></p>
            <p><?php echo htmlspecialchars($Reservation['FirstName']) . " " . htmlspecialchars($Reservation['LastName']); ?></p>
            <p><?php echo htmlspecialchars($Reservation['Email']); ?></p>

            <br><br>

            <p><strong>Booking for:</strong></p>
            <p><?php echo htmlspecialchars($Reservation['MovieName']); ?></p>
            <p>Date: <?php echo htmlspecialchars($Reservation['ShowingDate']); ?></p>
            <p>Time: <?php echo htmlspecialchars($Reservation['ShowingTime']); ?></p>
            <p>Seats chosen: <?php echo htmlspecialchars($Reservation['SeatNumbers']); ?></p>
            <p>Total seats chosen: <?php echo htmlspecialchars($Reservation['TotalSeats']); ?></p>

            <br/>
            <img src="img/seats.png" alt="Seating chart" height="200">
        <?php else: ?>
            <p>No reservations found.</p>
        <?php endif; ?>
    </div>

    <div>
        <h2>Payment</h2>

        <!-- Display total price -->
        <p><strong>Total Price: €<?php echo number_format($totalPrice, 2); ?></strong></p>

        <br/>
        <br/>
        <p>Please fill in your payment details</p>
        <form action="payment.php" method="post">
            <label for="CardNumber">Card number</label>
            <input type="text" id="CardNumber" name="CardNumber" required>
            <br>
            <label for="ExpiryDate">Expiry date</label>
            <input type="text" id="ExpiryDate" name="ExpiryDate" required>
            <br>
            <label for="CVV">CVV</label>
            <input type="text" id="CVV" name="CVV" required>
            <br>
            <label for="CardHolder">Card holder</label>
            <input type="text" id="CardHolder" name="CardHolder" required>
            <br>
            <input type="hidden" name="Amount" value="<?php echo $totalPrice; ?>">

            <br/>
            
            <input type="hidden" name="ReservationID" value="<?php echo $Reservation['ReservationID']; ?>">
            <button type="submit" class="btn">Pay</button>
        </form>
    </div>

    <br/>
    <br/>
</div>