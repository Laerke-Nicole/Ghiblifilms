<!-- work on display the users bookings  -->
<div class="row ten-percent">
    <h2>Your bookings</h2>
    <br>
    <?php if (!$getUserReservations): ?>
        You have no bookings.
    <?php else: 
        foreach ($getUserReservations as $reservation): ?>
            <div>
                <p><strong">Movie:</strong><?php echo htmlspecialchars($reservation['MovieName']); ?></p>
                <p><strong">Date:</strong><?php echo htmlspecialchars($reservation['ShowingDate']); ?></p>
                <p><strong">Time:</strong><?php echo htmlspecialchars($reservation['ShowingTime']); ?></p>
                <p><strong>Total:</strong> € <?php echo number_format($reservation['Amount'] / 100, 2); ?></p>
                <p><strong">Payment Date:</strong><?php echo htmlspecialchars($reservation['PaymentDate']); ?></p>
                <p><strong">Payment Type:</strong><?php echo htmlspecialchars($reservation['PaymentType']); ?></p>

                <br/>
                    <a href="index.php?page=deleteuserprofile&ReservationID=<?php echo $reservation['ReservationID'] . '&UserID=' . $userID; ?>" class="waves-effect waves-light btn red" onclick="return confirm('Delete! Are you sure?')">Cancel booking</a>
                <br/>
                <br/>
                <br/>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>