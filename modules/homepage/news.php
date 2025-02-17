<section class="pt-24 pb-24 six-percent" id="news">
    <div>
        <h2 class="pb-6 text-3xl">News in our cinema</h2>
    </div>
    
    <!-- loop with news  -->
    <div class="items-two-col">
    <?php foreach ($getNews as $news): ?>
        <a href="index.php?page=newsdetail&ID=<?php echo htmlspecialchars(trim($news['NewsID'])); ?>" class="news-item">
            <div>
                <div class="img-zoom-container round-corner pb-2">
                    <img src='upload/<?php echo htmlspecialchars(trim($news['NewsImg'])); ?>' alt='Image of news' class="round-corner img-zoom">
                </div>

                <div>
                    <p><?php echo htmlspecialchars(trim($news['TypeOfNews'])) . ' | ' . htmlspecialchars(trim($news['DateOfNews'])); ?></p>
                </div>

                <h5 class="pb-2"><?php echo htmlspecialchars(trim($news['Headline'])); ?></h5>
                <button class="btn-two">Read more</button>
            </div>
        </a>
    <?php endforeach; ?>
</div>


</section>