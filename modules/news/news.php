<!-- if statement to show details on news -->
<?php if ($getNewsItem): ?>
    <!-- display the details of the news -->
    <section class="pt-24 pb-24 ten-percent flex flex-col justify-center align-center ">
        <div>
            <div class="text-center pb-16">
                <img src="upload/<?php echo htmlspecialchars(trim($getNewsItem['NewsImg'])); ?>" alt="Image of news" class="pb-4 round-corner">
                <h2 class="pb-4"><?php echo htmlspecialchars(trim($getNewsItem['Headline'])); ?></h2>
                <h5 class="pb-2"><?php echo htmlspecialchars(trim($getNewsItem['SubHeadline'])); ?></h5>
                <p>type | author | date</p>
            </div>

            <p><?php echo htmlspecialchars(trim($getNewsItem['TextOfNews'])); ?></p>
            <img src="" alt="">
        </div>
    </section>
<?php else: ?>
    <p>News item not found.</p>
<?php endif; ?>