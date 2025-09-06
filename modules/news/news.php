<section class="container container-smaller pt-10 flex justify-between gap-6 news-details-container">
    <!-- left column: main news -->
    <div class="flex-1">
        <?php if ($getFirstNews): ?>
        <a href="index.php?page=newsdetail&ID=<?php echo htmlspecialchars(trim($getFirstNews['NewsID'])); ?>" class="flex flex-col justify-between">
            <div>
                <img src='upload/<?php echo htmlspecialchars(trim($getFirstNews['NewsImg'])); ?>' alt='Image of news' class="round-corner news-img w-full mb-4">
                <p class="black-text text-sm primary-font mb-1">
                    <span class="font-bold"><?php echo htmlspecialchars(trim($getFirstNews['TypeOfNews'])); ?></span> | <?php echo htmlspecialchars(trim($getFirstNews['DateOfNews'])); ?>
                </p>
                <h4><?php echo htmlspecialchars(trim($getFirstNews['Headline'])); ?></h4>
                <p><?php echo htmlspecialchars(trim($getFirstNews['TextOfNews'])); ?></p>
            </div>
        </a>
    <?php endif; ?>

    </div>

    <!-- right column: other news -->
    <div class="w-64 flex-shrink-0">
        <h5 class="mb-4">Other news</h5>
        <?php foreach ($getOtherNews as $news): ?>
            <div class="mb-6">
                <a href="index.php?page=newsdetail&ID=<?php echo htmlspecialchars($news['NewsID']); ?>" class="flex flex-col justify-between">
                    <div>
                        <img src="upload/<?php echo htmlspecialchars($news['NewsImg']); ?>" alt="Image of news" class="round-corner news-img w-full mb-2">
                        <h5 class="text-sm font-medium"><?php echo htmlspecialchars($news['Headline']); ?></h5>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>
