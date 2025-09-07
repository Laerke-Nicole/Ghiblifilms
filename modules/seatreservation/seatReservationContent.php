<div class="container pt-10">
    <div class="grid grid-cols-2 gap-8">
        <div>
            <h1>Choose seats</h1>
            
            <!-- display reserved seats -->
            <div class="flex pb-4 gap-4">
                <p class="text-sm"><strong>Taken seats:</strong></p>
                <p class="text-sm"><?php echo $reservedSeatList; ?></p>
            </div>

            <div class="pb-4">
                <p class="text-xs"><span class="font-bold">Price per seat:</span> €12</p>
            </div>

            <div class="pr-12">
                <hr class="dark-hr">
            </div>

            <br/>

            <!-- seat selection form -->
            <form method="POST" action="modules/seatreservation/form.php">
                <!-- csrf protection -->
                <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">

                <div class="pb-4">
                    <label for="Seats">Select seats, up to 5:</label>
                    <div id="Seats" class="flex flex-wrap gap-3 mt-4">
                        <?php foreach ($availableSeats as $seat): ?>
                            <label class="cursor-pointer relative">
                                <input type="checkbox" name="Seats[]" value="<?php echo $seat['SeatID']; ?>" class="peer hidden">
                                <div class="px-4 py-2 border rounded-lg bg-gray-100 text-gray-800 font-medium 
                                            hover:bg-orange-950 hover:text-white transition-colors duration-200 
                                            peer-checked:bg-orange-950 peer-checked:text-white">
                                    <?php echo htmlspecialchars($seat['SeatNumber']); ?>
                                </div>
                            </label>
                        <?php endforeach; ?>
                    </div>

                </div>

                <button type="submit" class="btn-two mb-6">Choose seats</button>
            </form>
        </div>

        <div>
            <img src="img/seats.png" alt="Seating chart" class="round-corner">
        </div>
    </div>
</div>