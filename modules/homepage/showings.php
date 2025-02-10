<!-- showings -->
<?php if ($dailyShowingsViews): ?>
    <section class="pt-24 six-percent" id="daily-showings">
        <h2 class="text-center pb-4">Daily Showings</h2>
        <div class="items">
            <?php foreach ($dailyShowingsViews as $showings): ?>
                <div>
                    <img src='upload/<?php echo htmlspecialchars(trim($showings['MovieImg'])); ?>' alt='Image of movie'>
                    <h5 class="weight-400 pb-2"><?php echo htmlspecialchars(trim($showings['Name'])); ?></h5>
                    <button class="btn" onclick="window.location.href='index.php?page=moviedetail&ID=<?php echo htmlspecialchars(trim($showings['MovieID'])); ?>'">Get tickets</button>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>
 