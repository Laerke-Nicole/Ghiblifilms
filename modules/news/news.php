<!-- if statement to show details on news -->
<?php if ($getNewsItem): ?>
    <!-- display the details of the news -->
    <section class="pt-24 pb-24 fifteen-percent flex flex-col justify-center align-center news-detail-container">
        <div>
            <div class="text-center pb-16">
                <img src="upload/<?php echo htmlspecialchars(trim($getNewsItem['NewsImg'])); ?>" alt="Image of news" class="pb-4 round-corner news-page-img">

                <h2 class=""><?php echo htmlspecialchars(trim($getNewsItem['Headline'])); ?></h2>
                <h4 class="pb-6"><?php echo htmlspecialchars(trim($getNewsItem['SubHeadline'])); ?></h4>
                <p class="pb-6"><?php echo htmlspecialchars(trim($getNewsItem['TypeOfNews'])) . ' | ' . htmlspecialchars(trim($getNewsItem['Author'])) . ' | ' . htmlspecialchars(trim($getNewsItem['DateOfNews'])); ?></p>

                <hr class="dark-hr">

            </div>

            <p class="news-text"><?php echo htmlspecialchars(trim($getNewsItem['TextOfNews'])); ?></p>
        </div>
    </section>
<?php else: ?>
    <p>News item not found.</p>
<?php endif; ?>