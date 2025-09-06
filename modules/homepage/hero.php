<section class="hero-section">
    <div class="hero-content container">
        <h1 class="hero-title pb-1">All studio Ghibli movies in one cinema</h1>
        <p class="hero-description pb-4">Your one-stop destination for all Studio Ghibli movies in our 2D cinema. Explore our extensive collection of films, and find news in our cinema.</p>
        <div class="flex gap-2">
            <button class="btn-two">Explore Now</button>
            <button class="btn-one">Get Tickets</button>
        </div>
    </div>
</section>

<?php if (!empty($heroCollageViews)): ?>
    <?php 
    $movie = array_values(array_filter($heroCollageViews, fn($item) => $item['MovieID']))[0] ?? null;
    $newsItems = array_filter($heroCollageViews, fn($item) => $item['NewsID']);
    ?>

    <section class="collage-section full-width-container dark-bg">
        <div class="row container">
            <!-- Movie Section -->
            <div class="column left-column">
                <?php if ($movie): ?>
                    <a href="index.php?page=moviedetail&ID=<?php echo htmlspecialchars(trim($movie['MovieID'])); ?>" class="hero-item">
                    <div class="">
                        <img src="upload/<?php echo htmlspecialchars(trim($movie['MovieImage'])); ?>" alt="Image of movie round-corner" class="mb-4">
                        
                        <h4 class="white-headline"><?php echo htmlspecialchars(trim($movie['MovieName'])); ?></h4>
                        <!-- <p class="pb-4 white-text"><?php echo htmlspecialchars(trim($movie['ReleaseYear'])); ?></p> -->
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
                    <a href="index.php?page=newsdetail&ID=<?php echo htmlspecialchars(trim($news['NewsID'])); ?>" class="news-item hero-item pb-4">
                        <div class="pb-4">
                            <img src="upload/<?php echo htmlspecialchars(trim($news['NewsImage'])); ?>" alt="Image of news" class="mb-4">

                            <div>
                                <p class="white-text text-sm primary-font mb-1"><span class="font-bold"><?php echo htmlspecialchars(trim($news['TypeOfNews'])); ?></span> | <?php echo htmlspecialchars(trim($news['DateOfNews'])); ?></p>
                            </div>
                            
                            <h4 class="white-headline"><?php echo htmlspecialchars(trim($news['Headline'])); ?></h4>
                            <button class="btn-one">Read news</button>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php else: ?>
    <p>No news currently.</p>
<?php endif; ?>
