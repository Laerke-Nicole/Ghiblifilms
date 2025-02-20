<section class="highlight-movie six-percent grid-cols-2 dark-bg">
    <?php if ($highlightMovie): ?>
        <div class="flex flex-col justify-center items-center">
            <h5 class="extra-light">Newest movie in Ghiblifilm</h5>
            <h3 class="text-4xl white-headline"><?php echo htmlspecialchars(trim($highlightMovie['Name'])); ?></h3>

            <div class="flex">
                <p class="pb-4 text-lg white-text"><?php echo htmlspecialchars(trim($highlightMovie['ReleaseYear'])) . ' | ' . htmlspecialchars(trim($highlightMovie['Duration'])); ?></p>
            </div>

            <p class="pb-6 text-lg white-text"><?php echo htmlspecialchars(trim($highlightMovie['Description'])); ?></p>
            
            <div>
                <button class="btn-one" onclick="window.location.href='index.php?page=moviedetail&ID=<?php echo htmlspecialchars(trim($highlightMovie['MovieID'])); ?>'">See more</button>
            </div>
        </div>

        <div class="highlight-movie-img flex justify-end items-center">
            <img src='upload/<?php echo htmlspecialchars(trim($highlightMovie['MovieImg'])); ?>' alt='Image of movie' class="round-corner">
        </div>
    <?php endif; ?>
</section>