<section class="container" id="news">
    <h2>Latest news</h2>
    
    <!-- loop with news  -->
    <div class="news-list grid grid-cols-3 gap-4">
        <?php foreach (array_slice($getNews, 0, 3) as $news): ?>
            <a href="index.php?page=newsdetail&ID=<?php echo htmlspecialchars(trim($news['NewsID'])); ?>" class="flex flex-col justify-between">
                <div>
                    <img src='upload/<?php echo htmlspecialchars(trim($news['NewsImg'])); ?>' alt='Image of news' class="round-corner object-cover news-img w-full mb-4">

                    <div>
                        <p class="black-text text-sm primary-font mb-1"><span class="font-bold"><?php echo htmlspecialchars(trim($news['TypeOfNews'])); ?></span> | <?php echo htmlspecialchars(trim($news['DateOfNews'])); ?></p>
                    </div>

                    <h4><?php echo htmlspecialchars(trim($news['Headline'])); ?></h4>
                </div>
                <div>
                    <p class="underline text-sm">Read more</p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="flex pt-8">
        <a href="index.php?page=newslist" class="flex flex-col justify-between">
            <button class="btn-one">See more news</button>
        </a>
    </div>
</section>