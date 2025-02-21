<!-- work on display the users bookings  -->
<div class="ten-percent pb-20">
    <h3 class="pb-4">Your bookings</h3>

    <!-- if the user has no bookings yet -->
    <?php if (!$getUserReservations): ?>
        You have no bookings.
    <?php else: 
        // show the booking list in a foreach
        foreach ($getUserReservations as $reservation): ?>
            <div>
                <p><strong">Movie: </strong><?php echo htmlspecialchars($reservation['MovieName']); ?></p>
                <p><strong">Date: </strong><?php echo htmlspecialchars($reservation['ShowingDate']); ?></p>
                <p><strong">Time: </strong><?php echo htmlspecialchars($reservation['ShowingTime']); ?></p>
                <p><strong>Total: </strong> € <?php echo number_format($reservation['Amount'] / 100, 2); ?></p>
                <p><strong">Payment Date: </strong><?php echo htmlspecialchars($reservation['PaymentDate']); ?></p>
                <p><strong">Payment Type: </strong><?php echo htmlspecialchars($reservation['PaymentType']); ?></p>

                <br/>
                <td><a href="index.php?page=controllerdelete&table=Reservation&primaryKey=ReservationID&primaryKeyValue=<?php echo htmlspecialchars(trim($reservation['ReservationID'])) . '&UserID=' . $userID; ?>&redirect=userprofile"class="waves-effect waves-light btn red" onclick="return confirm('Cancel! Are you sure?')">Cancel booking</a></td>
                <br/>
                <br/>
                <br/>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>