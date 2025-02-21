<div class="flex flex-col pt-12 pb-12 ten-percent dark-bg showings-container round-corner-right" id="showings">
    <div>
        <h3 class="white-headline pb-6 text-center">Screenings available</h3>
    </div>

    <?php if (!$getShowings): ?>
        <p class="white-text">No screenings available.</p>
    <?php else: ?>
        <div>
            <div class="flex gap-8 showing round-corner">
                <?php foreach ($getShowings as $showings): ?>
                    <a href="index.php?page=seatreservationdetail&ShowingsID=<?php echo htmlspecialchars(trim($showings['ShowingsID'])); ?>" class="time">
                        <h5 class="black-headline pb-2"><strong><?php echo htmlspecialchars(trim($showings['ShowingDate'])); ?></strong></h5>
                        <p class="black-text text-sm"><?php echo htmlspecialchars(trim($showings['ShowingTime'])); ?></p>
                        <p class="black-text text-sm"><?php echo htmlspecialchars(trim($showings['AuditoriumNumber'])); ?></p>
                        <p class="black-text text-sm"><?php echo htmlspecialchars(trim($showings['ScreenFormat'])); ?></p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>