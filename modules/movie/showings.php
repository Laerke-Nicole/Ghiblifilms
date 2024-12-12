<!-- display showings -->
<div class="flex gap-8 p-4 pb-16 ten-percent" id="showings">
    <!-- left side with address -->
    <div class="w-33">
        <h3>CHOOSE WHEN YOU WOULD LIKE TO WATCH THE MOVIE</h3>
    </div>

    <!-- right side with showings -->
    <!-- book slots -->
    <?php if (!$getShowings): ?>
        <p>No showings right now.</p>
    <?php else: ?>
        <div class="flex flex-col gap-8 w-66">
            <?php foreach ($getShowings as $showings): ?>
                <a href="index.php?page=seatreservationdetail&ShowingsID=<?php echo htmlspecialchars(trim($showings['ShowingsID'])); ?>" class="time s-bg p-6 w-full">
                    <h4 class="primary-color"><strong><?php echo htmlspecialchars(trim($showings['ShowingDate'])) . ' at ' . htmlspecialchars(trim($showings['ShowingTime'])); ?></strong></h4>
                    <p class="primary-color"><?php echo htmlspecialchars(trim($showings['AuditoriumNumber'])); ?></p>
                    <p class="primary-color"><?php echo htmlspecialchars(trim($showings['ScreenFormat'])); ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>