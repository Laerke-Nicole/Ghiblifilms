<?php if (!empty($heroCollageViews)): ?>
    <?php 
    $movie = array_values(array_filter($heroCollageViews, fn($item) => $item['MovieID']))[0] ?? null;
    $newsItems = array_filter($heroCollageViews, fn($item) => $item['NewsID']);
    ?>

    <section class="collage-section six-percent dark-bg pt-6 pb-20">
        <div class="row">
            <!-- Movie Section -->
            <div class="column left-column">
                <?php if ($movie): ?>
                    <a href="index.php?page=moviedetail&ID=<?php echo htmlspecialchars(trim($movie['MovieID'])); ?>">
                    <div class="">
                        <img src="upload/<?php echo htmlspecialchars(trim($movie['MovieImage'])); ?>" alt="Image of movie round-corner">
                        
                        <h5 class="pt-2 white-headline"><?php echo htmlspecialchars(trim($movie['MovieName'])); ?></h5>
                        <p class="pb-4 white-text"><?php echo htmlspecialchars(trim($movie['ReleaseYear'])); ?></p>
                        <button class="btn-one" onclick="window.location.href='index.php?page=moviedetail&ID=<?php echo htmlspecialchars(trim($movie['MovieID'])); ?>'">
                            Get tickets
                    </button>
                    </div>
                <?php else: ?>
                    <p>No upcoming screenings available.</p>
                    </a>
                <?php endif; ?>
            </div>

            <!-- News Section -->
            <div class="column right-column">
                <?php foreach ($newsItems as $news): ?>
                    <a href="index.php?page=newsdetail&ID=<?php echo htmlspecialchars(trim($news['NewsID'])); ?>" class="news-item">
                        <div>
                            <img src="upload/<?php echo htmlspecialchars(trim($news['NewsImage'])); ?>" alt="Image of news">

                            <div>
                                <p class="white-text text-sm pt-2"><span class="font-bold"><?php echo htmlspecialchars(trim($news['TypeOfNews'])); ?></span> | <?php echo htmlspecialchars(trim($news['DateOfNews'])); ?></p>
                            </div>
                            
                            <h4 class="white-headline pb-4"><?php echo htmlspecialchars(trim($news['Headline'])); ?></h4>
                            <button class="btn-one">Read more</button>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php else: ?>
    <p>No news currently.</p>
<?php endif; ?>
