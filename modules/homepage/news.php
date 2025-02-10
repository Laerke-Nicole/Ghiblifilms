<section class="pt-24 pb-24 six-percent" id="news">
    <div>
        <h2 class="pb-6 text-3xl">News in our cinema</h2>
    </div>
    
    <!-- loop with news  -->
    <div class="items-two-col">
        <?php foreach ($getNews as $news): ?>
            <div>
                <img src='upload/<?php echo htmlspecialchars(trim($news['NewsImg'])); ?>' alt='Image of news' class="round-corner">
                <div>
                    Type | 05. feb 2025
                </div>
                <h5 class="pb-2"><?php echo htmlspecialchars(trim($news['Headline'])); ?></h5>
                <p>short text</p>
                <button class="btn-two" onclick="window.location.href='index.php?page=newsdetail&ID=<?php echo htmlspecialchars(trim($news['NewsID'])); ?>'">Read more</button>
            </div>
        <?php endforeach; ?>
    </div>

</section>