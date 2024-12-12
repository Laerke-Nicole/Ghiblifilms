<section class="pt-24 pb-24 ten-percent" id="news">
    <div>
        <h2 class="text-center pb-4">NEWS</h2>
    </div>
    
    <!-- loop with news  -->
    <div class="items">
        <?php foreach ($getNews as $news): ?>
            <div>
                <img src='upload/<?php echo htmlspecialchars(trim($news['NewsImg'])); ?>' alt='Image of news'>
                <h5 class="weight-400 pb-2"><?php echo htmlspecialchars(trim($news['Headline'])); ?></h5>
                <button class="btn" onclick="window.location.href='index.php?page=newsdetail&ID=<?php echo htmlspecialchars(trim($news['NewsID'])); ?>'">See more</button>
            </div>
        <?php endforeach; ?>
    </div>

</section>