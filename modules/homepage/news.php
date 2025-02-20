<section class="pt-24 pb-24 six-percent" id="news">
    <div>
        <h2 class="pb-6">News in Ghiblifilms</h2>
    </div>
    
    <!-- loop with news  -->
    <div class="grid-cols-3">
    <?php foreach ($getNews as $news): ?>
        <a href="index.php?page=newsdetail&ID=<?php echo htmlspecialchars(trim($news['NewsID'])); ?>" class="news-item">
            <div>
                <img src='upload/<?php echo htmlspecialchars(trim($news['NewsImg'])); ?>' alt='Image of news' class="round-corner news-img w-full pb-2">

                <div>
                    <p class="black-text"><?php echo htmlspecialchars(trim($news['TypeOfNews'])) . ' | ' . htmlspecialchars(trim($news['DateOfNews'])); ?></p>
                </div>

                <h4 class="pb-4"><?php echo htmlspecialchars(trim($news['Headline'])); ?></h4>
                <button class="btn-two">Read more</button>
            </div>
        </a>
    <?php endforeach; ?>
</div>


</section>