<div class="ten-percent">
    <div class="grid-cols-2">
        <div>
            <h1>Choose seats</h1>
            
            <!-- Display reserved seats -->
            <div class="flex pb-4 gap-4">
                <p><strong>Taken seats:</strong></p>
                <p><?php echo $reservedSeatList; ?></p>
            </div>

            <div>
                <p>Price per seat: 12 euros</p>
            </div>

            <br/>

            <!-- seat selection form -->
            <form method="POST" action="modules/seatreservation/form.php">
                <!-- csrf protection -->
                <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">

                <div class="pb-4">
                    <label for="Seats">Select seats, up to 5:</label>
                    <div id="Seats">
                        <?php foreach ($availableSeats as $seat): ?>
                            <label>
                                <input type="checkbox" name="Seats[]" value="<?php echo $seat['SeatID']; ?>">
                                <?php echo htmlspecialchars($seat['SeatNumber']); ?>
                            </label><br>
                        <?php endforeach; ?>
                    </div>
                </div>

                <button type="submit" class="btn">Choose seats</button>
            </form>
        </div>

        <div>
            <img src="img/seats.png" alt="Seating chart">
        </div>
    </div>
</div>