<?php require_once("controllers/companyController.php"); ?>

<section>
    <div class="container pt-10">
        <h2>See all our news</h2>
    
        <div class="grid grid-cols-2 gap-12">
            <?php if ($getFirstNews): ?>
                <div>
                    <img src='upload/<?php echo htmlspecialchars($getFirstNews['NewsImg']); ?>' alt='Image of news' class="round-corner w-full object-cover">
                </div>
    
                <div class="flex flex-col">
                    <p class="black-text text-sm primary-font mb-1">
                    <span class="font-bold"><?php echo htmlspecialchars($getFirstNews['TypeOfNews']); ?></span> | <?php echo htmlspecialchars($getFirstNews['DateOfNews']); ?>
                    </p>
                    <h4><?php echo htmlspecialchars($getFirstNews['Headline']); ?></h4>
                    <p class="pb-4"><?php echo htmlspecialchars($getFirstNews['TextOfNews']); ?></p>
    
                    <div>
                        <a href="index.php?page=newsdetail&ID=<?php echo htmlspecialchars($getFirstNews['NewsID']); ?>">
                            <button class="btn-two">Read news</button>
                        </a>
                    </div>
                </div>
                
            <?php endif; ?>
    
        </div>
    </div>

    <div class="container news-list grid grid-cols-3 gap-4">
        <?php foreach ($getNewsAdmin as $news): ?>
            <a href="index.php?page=newsdetail&ID=<?php echo htmlspecialchars(trim($news['NewsID'])); ?>" class="flex flex-col justify-between">
                <div>
                    <img src='upload/<?php echo htmlspecialchars(trim($news['NewsImg'])); ?>' alt='Image of news' class="round-corner news-img w-full mb-4 object-cover">
    
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
</section>