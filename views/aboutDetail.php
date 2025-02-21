<?php require_once("controllers/companyController.php"); ?>

<section>
    <div class="fifteen-percent">
        <div class="flex justify-center align-center">
            <img src="img/logo.png" alt="Studio Ghibli logo" class="h-350">
        </div>
    
        <!-- About Section -->
        <div class="flex flex-col pb-20 mx-auto text-center">
            <?php foreach ($getAboutCompany as $about): ?>
                <div>
                    <h1 class="pb-2">About Ghiblifilms</h1>
                </div>
                <div>
                    <p><?= htmlspecialchars(trim($about['CompanyDescription'])) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    
        <!-- divider -->
        <hr class="dark-hr">
    
        <!-- stats -->
        <div class="pt-20 pb-20">
            <div class="flex justify-evenly company-stats">
                <?php foreach ($everythingCompany as $company): ?>
                    <div class="text-center">
                        <h4 class="text-4xl"><?php echo htmlspecialchars(trim($company['TotalMovies'])); ?></h4>
                        <p>Movies</p>
                    </div>
                    <div class="text-center">
                        <h4 class="text-4xl"><?php echo htmlspecialchars(trim($company['TotalYears'])); ?></h4>
                        <p>Years</p>
                    </div>
                    <div class="text-center">
                        <h4 class="text-4xl">+<?php echo htmlspecialchars(trim($company['TotalAwards'])); ?></h4>
                        <p>Awards</p>
                    </div>
                    <div class="text-center">
                        <h4 class="text-4xl">+<?php echo htmlspecialchars(trim($company['TotalVisitors'])); ?></h4>
                        <p>Visitors</p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


    <div class="about-banner"></div>
</section>