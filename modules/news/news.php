<!-- if statement to show details on news -->
<?php if ($getNewsItem): ?>
    <!-- display the details of the news -->
    <section class="pt-24 pb-24 ten-percent">
        <div>
            <img src="upload/<?php echo htmlspecialchars(trim($getNewsItem['NewsImg'])); ?>" alt="Image of news" class="pb-4">
            <h2 class="pb-4"><?php echo htmlspecialchars(trim($getNewsItem['Headline'])); ?></h2>
            <h5 class="pb-2"><?php echo htmlspecialchars(trim($getNewsItem['SubHeadline'])); ?></h5>
            <p><?php echo htmlspecialchars(trim($getNewsItem['TextOfNews'])); ?></p>
        </div>
    </section>
<?php else: ?>
    <p>News item not found.</p>
<?php endif; ?>