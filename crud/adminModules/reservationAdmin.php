<?php
confirm_is_admin();
?>

<!-- Opening Hours -->
<div class="container">
    <h4>All Reservations ordered by user's first name</h4>
    
    <?php if (!$getUserReservations): ?>
        <p>There are no bookings</p>
    <?php else: ?>
        <table class="highlight">
        <thead>
            <tr class="secondary-color">
                <th>Users name</th>
                <th>Movie</th>
                <th>Date</th>
                <th>Time</th>
                <th>Total</th>
                <th>Payment date</th>
                <th>Payment type</th>
            </tr>
        </thead>

        <!-- loop through the added items -->
        <tbody class="secondary-color">
        <?php foreach ($getUserReservations as $reservation): ?>
            <tr>
                <td><?php echo htmlspecialchars(trim($reservation['FirstName'])) . " " . htmlspecialchars(trim($reservation['LastName'])); ?></td>
                <td><?php echo htmlspecialchars(trim($reservation['MovieName'])); ?></td>
                <td><?php echo htmlspecialchars(trim($reservation['ShowingDate'])); ?></td>
                <td><?php echo htmlspecialchars(trim($reservation['ShowingTime'])); ?></td>
                <td>€ <?php echo htmlspecialchars(trim($reservation['Amount']/100)); ?></td>
                <td><?php echo htmlspecialchars(trim($reservation['PaymentDate'])); ?></td>
                <td><?php echo htmlspecialchars(trim($reservation['PaymentType'])); ?></td>
            </tr>
        <?php endforeach; ?>

        </tbody>
        </table>
    <?php endif; ?>
</div>