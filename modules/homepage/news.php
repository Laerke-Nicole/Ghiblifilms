<section class="pt-16 pb-16 six-percent" id="news">
    <div>
        <h2 class="pb-6">Latest news</h2>
    </div>
    
    <!-- loop with news  -->
    <div class="grid-cols-3">
    <?php foreach ($getNews as $news): ?>
        <a href="index.php?page=newsdetail&ID=<?php echo htmlspecialchars(trim($news['NewsID'])); ?>" class="flex flex-col justify-between">
            <div>
                <img src='upload/<?php echo htmlspecialchars(trim($news['NewsImg'])); ?>' alt='Image of news' class="round-corner news-img w-full">

                <div>
                    <p class="black-text text-sm"><span class="font-bold"><?php echo htmlspecialchars(trim($news['TypeOfNews'])); ?></span> | <?php echo htmlspecialchars(trim($news['DateOfNews'])); ?></p>
                </div>

                <h4 class="pb-4 text-xl"><?php echo htmlspecialchars(trim($news['Headline'])); ?></h4>
            </div>
            <div>
                <button class="btn-two">Read more</button>
            </div>
        </a>
    <?php endforeach; ?>
</div>


</section>