<section class="container">
    <div class="flex flex-col pt-10 pb-10 px-6 dark-bg showings-container round-corner" id="showings">
        <div>
            <h3 class="white-headline pb-2">Screenings available</h3>
        </div>
    
        <?php if (!$getShowings): ?>
            <p class="white-text">No screenings available.</p>
        <?php else: ?>
            <div>
                <div class="flex gap-8 showing round-corner">
                    <?php foreach ($getShowings as $showings): ?>
                        <a href="index.php?page=seatreservationdetail&ShowingsID=<?php echo htmlspecialchars(trim($showings['ShowingsID'])); ?>" class="time">
                            <h5 class="black-headline"><strong><?php echo htmlspecialchars(trim($showings['ShowingDate'])); ?></strong></h5>
                            <p class="black-text text-sm">Time: <span class="font-bold"><?php echo htmlspecialchars(trim($showings['ShowingTime'])); ?></span></p>
                            <p class="black-text text-sm">Screen format: <span class="font-bold"><?php echo htmlspecialchars(trim($showings['ScreenFormat'])); ?></span></p>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>