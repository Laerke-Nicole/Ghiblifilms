<?php require_once("controllers/companyController.php"); ?>

<section>
    <div>
        <div class="flex justify-center align-center container about-company-logo">
            <img src="img/logo.png" alt="Studio Ghibli logo" class="h-80 bg-cover">
        </div>
    
        <!-- About Section -->
        <div class="flex flex-col grid grid-cols-2 container gap-4">
            <?php foreach ($getAboutCompany as $about): ?>
                <div>
                    <h1>About Ghiblifilms</h1>
                </div>

                <div>
                    <p><?= htmlspecialchars(trim($about['CompanyDescription'])) ?></p>
                </div>
                
            <?php endforeach; ?>
        </div>

    
        <!-- stats -->
        <div class="flex justify-evenly company-stats container">
            <?php foreach ($everythingCompany as $company): ?>
                <div class="text-center">
                    <h2><?php echo htmlspecialchars(trim($company['TotalMovies'])); ?></h2>
                    <p>Movies</p>
                </div>
                <div class="text-center">
                    <h2><?php echo htmlspecialchars(trim($company['TotalYears'])); ?></h2>
                    <p>Years</p>
                </div>
                <div class="text-center">
                    <h2>+<?php echo htmlspecialchars(trim($company['TotalAwards'])); ?></h2>
                    <p>Awards</p>
                </div>
                <div class="text-center">
                    <h2>+<?php echo htmlspecialchars(trim($company['TotalVisitors'])); ?></h2>
                    <p>Visitors</p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <div class="about-banner"></div>
</section>